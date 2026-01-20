<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package Front/Front
*/
class Cron extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		$this->load->library('session');
		$this->load->helper("registration_helper");
		$this->load->helper("commission_helper");
	}
	
	
	public function index()
	{
	    
	}
	
	public function runmatching()
	{
	    $date=date('Y-m-d');
        $current_timestamp=date("Y-m-d H:i:s");
	    $this->db->insert('cron',
        	   array(
        	       'name'=>'runmatching',
        	       'start_date'=>date('Y-m-d H:i:s')
        	       )
        	   );
        $id=$this->db->insert_id();
	    $info=$this->db->select('user_id,username')->from('user_registration')->get()->result();
	    //echo count($info); exit;
	    $pairpv=28;
	    foreach($info as $key=>$val)
	    {
	        // check if user have pending pv
	        $user_id=$val->user_id;
	        $username=$val->username;
	        $total_left_amount_query=$this->db->query("select sum(pv) as total_left_amount from matrix_downline_pv where status='0'  and income_id='$user_id' and leg='Left' and date(l_date)<='$date'");
	 
	        $total_left_amount_query_res=$total_left_amount_query->result();
            $leftamt=$total_left_amount_query_res[0]->total_left_amount;
    
	        /////////////
	        $total_right_amount_query=$this->db->query("select sum(pv) as total_right_amount from matrix_downline_pv where status='0'  and income_id='$user_id' and leg='Right' and date(l_date)<='$date'");
	        $total_right_amount_query_res=$total_right_amount_query->result();
            $rightamt=$total_right_amount_query_res[0]->total_right_amount;
            
            if(($leftamt>=$pairpv) && ($rightamt>=$pairpv))
            {
                //echo $leftamt.'=='.$rightamt.'=='.$user_id.'=='.$username.'<br>';
                creditBinaryLevelCommissionAuto($val->user_id,$date,$current_timestamp);
    	        //echo $val->user_id." Matching Given<br>";
    	        $this->db->insert('matching_schedule',
            	   array(
            	       'user_id'=>$val->user_id,
            	       'bonus_date'=>$date,
            	       'run_date'=>date('Y-m-d H:i:s')
            	       )
            	   );
            }
            else
            {
                //echo "Less than pair pv ".$leftamt.'=='.$rightamt.'=='.$user_id.'=='.$username.'<br>';
            }
	        
	    }
	     $this->db->update('cron',
        	   array(
        	       'end_date'=>date('Y-m-d H:i:s')
        	       ),array('id'=>$id)
        	   );
	}
	public function runbinarycommission($username)
	{
	    $info=$this->db->select('user_id')->from('user_registration')->where('username',$username)->get()->row();
	    creditBinaryLevelCommissionAuto($info->user_id);
	    echo $username." Matching Given";
	}
	public function faststartbonus()
	{
	    
    	//$l_date = date('Y-m-d'); // Your initial date
        //$date = date('Y-m-d', strtotime($date . ' +1 month'));
        //echo $new_date; // Output: 2024-03-17 (One month subtracted)
        
        $date=date('Y-m-d');
        $current_timestamp=date("Y-m-d H:i:s");
	    $this->db->insert('cron',
        	   array(
        	       'name'=>'faststartbonus',
        	       'start_date'=>date('Y-m-d H:i:s')
        	       )
        	   );
    	$cronid=$this->db->insert_id();
    	$sql="SELECT COUNT(id),income_id FROM `direct_matrix_downline` where level=2 and income_id in (SELECT income_id FROM `direct_matrix_downline` where level=1 group by income_id having count(id)>=2) group by income_id having count(id)>=4;";
    	//echo $sql; echo "<br>";
    	$result=$this->db->query($sql)->result();
    	foreach($result as $keyr=>$valr)
    	{
    	   $income_id=$valr->income_id;
    	   // check fast start already there or not
    	   $check=$this->db->select('*')->from('faststart_bonus')->where('user_id',$income_id)->get()->num_rows();
    	   //echo $this->db->last_query(); echo "<br>";
    	   if(!$check)
    	   {
        	   $this->db->insert('faststart_bonus',
        	   array(
        	       'user_id'=>$income_id,
        	       'add_date'=>date('Y-m-d')
        	       )
        	   );
    	   }
    	}
    	
    	$this->db->update('cron',
        	   array(
        	       'end_date'=>date('Y-m-d H:i:s')
        	       ),array('id'=>$cronid)
        	   );
	}
	
	public function payfaststartbonus()
	{
	    $result=$this->db->select('*')->from('faststart_bonus')->where(array('status'=>0))->get()->result(); //'user_id'=>'1478266',
	    //pr($result); exit;
	    foreach($result as $keyr=>$valr)
	    {
	        $income_id=$valr->user_id;
	        $pkg_obj=$this->db->select('pkg_id,auto_registration_date,idno')->from('user_registration')->where('user_id',$income_id)->get()->row();
            $pkgid=$pkg_obj->pkg_id;
            $l_date = date('Y-m-d',strtotime($pkg_obj->auto_registration_date)); // Your initial date
            $date = date('Y-m-d', strtotime($date . ' +1 month'));
            //echo $pkg_obj->idno.'=='.$pkgid; echo "<br>";
            if($pkgid>1 && $pkg_obj->idno<>'Free')
            {
                $query=$this->db->query("SELECT down_id FROM `direct_matrix_downline` where income_id='".$income_id."' and l_date>='".$l_date." 00:00:00' and l_date<='".$date." 23:59:59' and level=1 limit 2");
            	//echo $this->db->last_query();
            	$all_downlines=$query->result_array();
            	$count=$query->num_rows();
            	if($query->num_rows()>1)
            	{
            	    //pr($all_downlines);exit;
            	    $array=array();
            	    foreach($all_downlines as $key=>$val)
            	    {
            	        //pr($val['down_id']);
            	        $array[]=$val['down_id'];
            	        $query1=$this->db->query("SELECT down_id FROM `direct_matrix_downline` where income_id='".$val['down_id']."' and l_date>='".$l_date." 00:00:00' and l_date<='".$date." 23:59:59' and level=1 limit 2");
            	        $all_downlines1=$query1->result_array();
            	        //echo $this->db->last_query(); echo "<br>";
            	        //pr($all_downlines1);
            	        foreach($all_downlines1 as $key1=>$val1)
            	        {
            	            $array[]=$val1['down_id'];
            	        }
            	        $count=$count+$query1->num_rows();
            	    }
            	    echo "Total Count:".$count; echo "<br>";;
            	    //pr($array);
            	    if($count>=6)
            	    {
            	        $pv=0;
            	        $main_com_amount=0;
            	        foreach($array as $key2=>$val2)
            	        {
            	            $val2;
            	            //$user_obj=$this->db->select('pkg_id')->from('user_package_log')->where('user_id',$val2)->get()->row();
            	            $user_obj=$this->db->query("SELECT new_package_id as pkg_id FROM `user_package_log`  where user_id='".$val2."' and old_package_id is NULL order by id asc limit 1")->row();
            	
            	            
            	            $pkg_id=$user_obj->pkg_id;
            	            $pv_obj=$this->db->select('pv')->from('package')->where('id',$pkg_id)->get()->row();
            	            $pv=$pv+$pv_obj->pv;
            	            
            	        }
            	        // get total pv of users
            	        $main_com_amount=(($pv*5)/100);
            	        
            	        $main_com_amount=$main_com_amount*500;
            	        echo $main_com_amount; echo "<br>";
            	        /*$this->db->update('faststart_bonus',
            							array(
            							    'amount'=>$main_com_amount,
            							    'update_date'=>date('Y-m-d')
            							    ),array('user_id'=>$income_id));*/
            	        //echo $keyr."-------------".$main_com_amount.'================='.$income_id."------".get_user_name($income_id); echo "<br>";
            							$query_obj=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$income_id)->get()->row();
            							$balance=$query_obj->amount+$main_com_amount;
            							$this->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$income_id));
            							$this->db->insert('credit_debit',array(
            							'transaction_no'=>generateUniqueTranNo(),
            							'user_id'=>$income_id,
            							'credit_amt'=>$main_com_amount,
            							'debit_amt'=>'0',
            							'balance'=>$balance,
            							'admin_charge'=>0,
            							'receiver_id'=>$income_id,
            							'sender_id'=>$income_id,
            							'receive_date'=>date('Y-m-d'),
            							'ttype'=>'Fast Start Bonus',
            							'TranDescription'=>'Fast Start Bonus',
            							'Cause'=>'Fast Start Bonus',
            							'Remark'=>'Fast Start Bonus',
            							'invoice_no'=>'',
            							'product_name'=>'main',
            							'deposit_id'=>'1',
            							'status'=>'1',
            							'pkg_id'=>$pkg_id,
            							'ewallet_used_by'=>'Withdrawal Wallet',
            							'current_url'=>site_url(),
            							'reason'=>'8', //credit for matrix commission
            							));
            							
            							$this->db->update('faststart_bonus',
            							array(
            							    'amount'=>$main_com_amount,
            							    'update_date'=>date('Y-m-d'),
            							    'status'=>1
            							    ),array('user_id'=>$income_id));
            	    }
            	    
                }
            }
	    }
	}
}

?>