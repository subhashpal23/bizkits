<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/IncomeReport_Model
*/
class IncomeReport_Model extends Common_Model
{
    public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    
    public function getAllPVList($user_id,$status)
    {
        return $this->db->select(array(
        'cd.income_id',
        'cd.pv',
        'cd.status',
        'cd.leg',
        'cd.l_date',
        'cd.level',
        'cd.down_id',
        'cd.type',
        ))->from('matrix_downline_pv as cd')
      ->join('user_registration as u','u.user_id=cd.income_id')
      ->order_by('cd.level','desc')
      ->where(array('cd.income_id'=>$user_id,'cd.status'=>$status))
      ->get()->result();
    }
    
    public function getFSPVList($income_id)
    {
        //echo $income_id; exit;
        //echo $new_date; // Output: 2024-03-17 (One month subtracted)
    	
    	$pkg_obj=$this->db->select('pkg_id,auto_registration_date')->from('user_registration')->where('user_id',$income_id)->get()->row();
        $pkgid=$pkg_obj->pkg_id;
        $l_date = date('Y-m-d',strtotime($pkg_obj->auto_registration_date)); // Your initial date
        $date = date('Y-m-d', strtotime($date . ' +1 month'));
        
        //echo $pkgid;
        if($pkgid>1)
        {
            $query=$this->db->query("SELECT down_id FROM `direct_matrix_downline` where income_id='".$income_id."' and l_date>='".$l_date." 00:00:00' and l_date<='".$date." 23:59:59' and level=1 limit 2");
        	//echo $this->db->last_query();
        	$all_downlines=$query->result_array();
        	$count=$query->num_rows();
        	if($query->num_rows()>1)
        	{
        	    //pr($all_downlines);exit;
        	    foreach($all_downlines as $key=>$val)
        	    {
        	        //pr($val['down_id']);
        	        $array1['down_id']=$val['down_id'];
        	        $array1['income_id']=$income_id;
        	        $array[]=$array1;
        	        $query1=$this->db->query("SELECT down_id FROM `direct_matrix_downline` where income_id='".$val['down_id']."' and l_date>='".$l_date." 00:00:00' and l_date<='".$date." 23:59:59' and level=1 limit 2");
        	        $all_downlines1=$query1->result_array();
        	        //echo $this->db->last_query(); echo "<br>";
        	        //pr($all_downlines1);
        	        foreach($all_downlines1 as $key1=>$val1)
        	        {
        	            //$array[]=$val1['down_id'];
        	            $array1['down_id']=$val1['down_id'];
        	            $array1['income_id']=$val['down_id'];
        	            $array[]=$array1;
        	        }
        	        $count=$count+$query1->num_rows();
        	    }
        	    //echo "Total Count:".$count;
        	    //pr($array);
        	    /*if($count>=6)
        	    {*/
        	        $pv=0;
        	        foreach($array as $key2=>$val2)
        	        {
        	            $val2;
        	            //$user_obj=$this->db->select('pkg_id')->from('user_package_log')->where('user_id',$val2)->get()->row();
        	            $user_obj=$this->db->query("SELECT new_package_id as pkg_id FROM `user_package_log`  where user_id='".$val2['down_id']."' and old_package_id is NULL order by id asc limit 1")->row();
        	
        	            
        	            $pkg_id=$user_obj->pkg_id;
        	            $pv_obj=$this->db->select('pv')->from('package')->where('id',$pkg_id)->get()->row();
        	            $pv=$pv+$pv_obj->pv;
        	            $result1['user_id']=$val2['down_id'];
        	            $result1['ref_id']=$val2['income_id'];
        	            $result1['pv']=$pv_obj->pv;
        	            $result[]=$result1;
        	        }
        	        // get total pv of users
        	        
        	    /*}*/
        	    
            }
        }
        //pr($result);
        return $result;
    }
     public function getDirectReferralCommission($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.tranDescription',
        'cd.create_date',
        'cd.level',
        'cd.status',
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.reason'=>'5'))
      ->get()->result();
    }
     public function getSelfCommission($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.tranDescription',
        'cd.create_date',
        'cd.level',
        'cd.status',
        'cd.payment_method',
        ))->from('credit_debit_cash as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.sender_id'=>$user_id,'cd.reason'=>'10'))
      ->get()->result();
    }
    public function getUnilvelCommission($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.tranDescription',
        'cd.create_date',
        'cd.level',
        'cd.status',
        'cd.payment_method',
        ))->from('credit_debit_cash as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.sender_id <>'=>$user_id,'cd.reason'=>'10'))
      ->get()->result();
    }
    public function getRankCommission($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.tranDescription',
        'cd.create_date',
        'cd.level',
        'cd.status',
        'cd.payment_method',
       
        ))->from('credit_debit_reward as cd')
        
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.reason'=>'13','cd.ttype'=>'Rank Bonus'))
      ->get()->result();
    }
    public function getDirectMatchingCommission($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.tranDescription',
        'cd.create_date',
        'cd.level',
        'cd.status',
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.reason'=>'9'))
      ->get()->result();
    }
    public function getFastStartCommission($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.tranDescription',
        'cd.create_date',
        'cd.level',
        'cd.status',
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.reason'=>'8'))
      ->get()->result();
    }
    public function getStockistCommission($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.tranDescription',
        'cd.create_date',
        'cd.level',
        'cd.status',
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.reason'=>'18'))
      ->get()->result();
    }
    /*
    @Desc: It's used to get the unilevel commission
    */
    public function getDailyIncome($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.level',
        'cd.create_date',
		'cd.pkg_id'
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.reason'=>'4'))
      ->get()->result();
    }
    public function getLevelCommission($user_id)
    {
      return $this->db->select(array(
        'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.level',
        'cd.create_date',
		'cd.pkg_id'
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.user_id'=>$user_id,'cd.reason'=>'9'))
      ->get()->result();
    }  
    /*
    @Desc: It's used to get the binary commission
    */
    public function getBinaryCommission($user_id)
    {
      return $this->db->select(array(
        'u.user_id',
        'u.username',
        'cd.*'
        ))->from('credit_debit as cd')->join('user_registration as u','u.user_id=cd.user_id')->order_by('cd.id','desc')->where(array('cd.user_id'=>$user_id,'cd.reason'=>'6'))->get()->result();
    }
    /*
    @Desc: It's used to get the matching commission
    */
    public function getMatchingCommission($user_id)
    {
      return $this->db->select(array(
        'u.user_id',
        'u.username',
        'cd.credit_amt',
        'cd.ttype',
        'cd.create_date',
		'cd.transaction_no',
        ))->from('credit_debit as cd')->join('user_registration as u','u.user_id=cd.user_id')->order_by('cd.id','desc')->where(array('cd.user_id'=>$user_id,'cd.reason'=>'7'))->get()->result();
    }
    /*
    @Desc: It's used to get the rank bonus
    */
    public function getRankUpdateBonus($user_id)
    {
      return $this->db->select(array(
        'u.user_id',
        'u.username',
        'cd.credit_amt',
        'cd.ttype',
        'cd.Remark',
        'cd.create_date',
        ))->from('credit_debit as cd')->join('user_registration as u','u.user_id=cd.user_id')->order_by('cd.id','desc')->where(array('cd.user_id'=>$user_id,'cd.reason'=>'10'))->get()->result();

    }
   /*
   @Desc:It's used to return the total commision on the basis of user_id
   */
   public function getTotalCommission($user_id)
   {
    /*
    '5'=>credit for direct commission, 
    '6'=>credit for binary commission, 
    '7'=>credit for matching commission, '
     9'=>credit for unilevel commission, 
    //'10'=>credit for rank bonus update,
    */
    $total_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        ))
        ->where_in('cd.reason',array('5','6','7','9'))
        ->get()
        ->row();
    $total_commission=$total_commission->credit_amt;
    return $total_commission;    
   }
   /*
   @Desc:It's used to return the total direct commision on the basis of user_id
   */
   public function getTotalDirectCommission($user_id)
   {
    $total_direct_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        'cd.reason'=>'5'
        ))
        ->get()
        ->row();
    return $total_direct_commission->credit_amt;
   }
   /*
   @Desc:It's used to return the total unilevel commision on the basis of user_id
   */
   public function getTotalUnilevelCommission($user_id)
   {
    $total_unilevel_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        'cd.reason'=>'9'
        ))
        ->get()
        ->row();
    return $total_unilevel_commission->credit_amt;
   }
   /*
   @Desc:It's used to return the total binary commision on the basis of user_id
   */
   public function getTotalBinaryCommission($user_id)
   {
    $total_binary_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        'cd.reason'=>'6'
        ))
        ->get()
        ->row();
    return $total_binary_commission->credit_amt;
   }
   /*
   @Desc:It's used to return the total matching commision on the basis of user_id
   */
   public function getTotalMatchingCommission($user_id)
   {
    $total_matching_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        'cd.reason'=>'7'
        ))
        ->get()
        ->row();
    return $total_matching_commission->credit_amt;
   }    
}//end class
?>