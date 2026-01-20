<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/commission_report_model
*/
class Commission_Report_Model extends Common_Model
{
	public function __construct()
	{
		//@call to parent CI_Model constructor
		parent::__construct();
	}
	public function getAllCommission($params = array(),$type=false)
  	{
	    /*return $this->db->select(array(
        'cd.*',
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where_in('cd.reason ', ['5','6','8','9','13'])
      ->get()->result();*/
      if($type)
      {
          
          $where=$type;
      }
      else
      {
          $where="['5','6','8','9','13']";
      }
      
      if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
		    $sql2=$this->db->select('cd.*')
			->from('credit_debit as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
              ->order_by('cd.id','desc')
              ->where_in('cd.reason ', $where) ;
             //$sql->order_by('u.id', 'desc'); 
			//$sql1 = clone $sql2;
            
			$totalData = $totalFiltered = $sql2->get()->num_rows();
			return $totalData; exit;
		}
		else
		{
		    $query=$this->db->select('cd.*')
			->from('credit_debit as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
              ->order_by('cd.id','desc')
              ->where_in('cd.reason ', $where)->get()->result();
		    $totalData = $totalFiltered = $this->db->select('cd.*')
			->from('credit_debit as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
              ->order_by('cd.id','desc')
              ->where_in('cd.reason ', $where)->get()->num_rows();
		
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $query=$this->db->select('cd.*')
			->from('credit_debit as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
              ->order_by('cd.id','desc')
              ->where_in('cd.reason ', $where)->limit($params['limit'],$params['start'])->get()->result(); 
                    $totalData = $totalFiltered = $this->db->select('cd.*')
			->from('credit_debit as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
              ->order_by('cd.id','desc')
              ->where_in('cd.reason ', $where)->limit($params['limit'],$params['start'])->get()->num_rows();
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $query=$this->db->select('cd.*')
			->from('credit_debit as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
              ->order_by('cd.id','desc')
              ->where_in('cd.reason ', $where)->limit($params['limit'])->get()->result(); 
                    $totalData = $totalFiltered = $this->db->select('cd.*')
			->from('credit_debit as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
              ->order_by('cd.id','desc')
              ->where_in('cd.reason ', $where)->limit($params['limit'])->get()->num_rows();
                } 
            //$query = $sql->get()->result();
            //echo $this->db->last_query();
            return $query;
			             
        }
  	}//end method 
  	
  	public function getFastStartCommission($params = array(),$type=false)
  	{
	   
      
      if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
		    $sql2=$this->db->select('cd.*')
			->from('faststart_bonus as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
		     ->where('cd.amount >', '0')
              ->order_by('cd.id','desc')
              ;
             //$sql->order_by('u.id', 'desc'); 
			//$sql1 = clone $sql2;
            
			$totalData = $totalFiltered = $sql2->get()->num_rows();
			return $totalData; exit;
		}
		else
		{
		    $query=$this->db->select('cd.*')
			->from('faststart_bonus as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
		     ->where('cd.amount >', '0')
              ->order_by('cd.id','desc')
              ->get()->result();
		    $totalData = $totalFiltered = $this->db->select('cd.*')
			->from('faststart_bonus as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
		     ->where('cd.amount >', '0')
              ->order_by('cd.id','desc')
              ->get()->num_rows();
		
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $query=$this->db->select('cd.*')
			->from('faststart_bonus as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
		     ->where('cd.amount >', '0')
              ->order_by('cd.id','desc')
              ->limit($params['limit'],$params['start'])->get()->result(); 
                    $totalData = $totalFiltered = $this->db->select('cd.*')
			->from('faststart_bonus as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
		     ->where('cd.amount >', '0')
              ->order_by('cd.id','desc')
              ->limit($params['limit'],$params['start'])->get()->num_rows();
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $query=$this->db->select('cd.*')
			->from('faststart_bonus as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
		     ->where('cd.amount >', '0')
              ->order_by('cd.id','desc')
              ->limit($params['limit'])->get()->result(); 
                    $totalData = $totalFiltered = $this->db->select('cd.*')
			->from('faststart_bonus as cd')
		     ->join('user_registration as u','u.user_id=cd.user_id')
              ->order_by('cd.id','desc')
              ->where('cd.amount >', '0')->limit($params['limit'])->get()->num_rows();
                } 
            //$query = $sql->get()->result();
            //echo $this->db->last_query();
            return $query;
			             
        }
  	}//end method 
	public function getDailyCommission()
  	{
	    return $this->db->select(array(
        'cd.receiver_id',
		'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
		'cd.deposit_type',
		'cd.deposit_id',
        'cd.tranDescription',
        'cd.create_date',
        ))->from('credit_debit_investment as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->get()->result();
  	}//end method  
  	public function getDirectReferralCommission()
  	{
	    return $this->db->select(array(
        'cd.receiver_id',
		'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.tranDescription',
        'cd.create_date',
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.reason'=>'5'))
      ->get()->result();
  	}//end method  

  	public function getUnilevelCommission()
  	{
	    return $this->db->select(array(
        'cd.receiver_id',
		'cd.sender_id',
        'cd.credit_amt',
        'cd.ttype',
        'cd.level',
        'cd.create_date',
        ))->from('credit_debit as cd')
      ->join('user_registration as u','u.user_id=cd.user_id')
      ->order_by('cd.id','desc')
      ->where(array('cd.reason'=>'9'))
      ->get()->result();
  	}//end method  
  	public function getBinaryCommission($user_id=null)
  	{
	    if(!empty($user_id))
	    {
	    	$where=array('u.user_id =' =>'$user_id', 'cd.reason =' =>'6');
	    }
	    else 
	    {
	    	$where=array('cd.reason =' =>'6');
	    }
	    $binaryCommissionQuery=$this->db->select('cd.credit_amt as amount, cd.ttype , cd.TranDescription as description,cd.create_date, u.username, u.user_id')->from('credit_debit as cd')
	    ->join('user_registration as u', 'u.user_id=cd.user_id')
	    ->order_by('cd.id','DESC')
	    ->where($where)
	    ->get();
	    $result=($binaryCommissionQuery->num_rows()>0)?$binaryCommissionQuery->result():array();
	    return $result;
  	}//end method  

  	public function getMatchingCommission($user_id=null)
  	{
	    if(!empty($user_id))
	    {
	    	$where=array('u.user_id =' =>'$user_id', 'cd.reason =' =>'7');
	    }
	    else 
	    {
	    	$where=array('cd.reason =' =>'7');
	    }
	    $matchingCommissionQuery=$this->db->select('cd.credit_amt as amount, cd.ttype , cd.TranDescription as description,cd.create_date, u.username,u.user_id')->from('credit_debit as cd')
	    ->join('user_registration as u', 'u.user_id=cd.user_id')
	    ->order_by('cd.id','DESC')
	    ->where($where)
	    ->get();
	    $result=($matchingCommissionQuery->num_rows()>0)?$matchingCommissionQuery->result():array();
	    return $result;
  	}//end method
  	
  public function getRankBonus($user_id=null)
  {
	    if(!empty($user_id))
	    {
	    	$where=array('u.user_id =' =>'$user_id', 'cd.reason =' =>'13','cd.ttype =' =>'Rank Bonus');
	    }
	    else 
	    {
	    	$where=array('cd.reason =' =>'13','cd.ttype =' =>'Rank Bonus');
	    }
	    $rankBonusQuery=$this->db->select('cd.credit_amt as amount, cd.ttype , cd.TranDescription as description,cd.create_date, u.username, u.user_id')
	    ->from('rank_bonus as r')
	    ->join('credit_debit as cd', 'r.user_id=cd.user_id')
	    ->join('user_registration as u', 'u.user_id=cd.user_id')
	    
	    ->order_by('cd.id','DESC')
	    ->where($where)
	    ->group_by('user_id')
	    ->get();
	    $result=($rankBonusQuery->num_rows()>0)?$rankBonusQuery->result():array();
	    return $result;
    //echo $this->db->last_query();
  }//end method
  
  public function getRankAchieverReport($user_id=null)
  {
  	//SELECT * FROM rank_log where id in (SELECT max(id) FROM rank_log GROUP BY user_id ) order by id desc
  	//SELECT * FROM rank_log where id in (SELECT max(id) FROM rank_log where user_id='123456' GROUP BY user_id )
  	if(!empty($user_id))
  	{
  		$sql="SELECT * FROM rank_log where id in (SELECT max(id) FROM rank_log where user_id='$user_id' GROUP BY user_id )";
  	}
  	else 
  	{
  		/*$sql="select rl.id, rl.user_id, u.username,u.active_status,rl.rank_id, rl.rank_name, cr.bonus as credit_amt, rl.transaction_no, rl.updated_date 
			from (SELECT * FROM rank_log where id in (SELECT max(id) FROM rank_log GROUP BY user_id)) as rl 
			join user_registration as u on rl.user_id=u.user_id
			inner join rank_bonus as cr on cr.rank_id=rl.rank_id 
			group by user_id;";*/
			
			$sql="select u.*,cr.bonus as credit_amt, rl.transaction_no, rl.updated_date  from user_registration as u  
			inner join rank_bonus as cr on cr.user_id=u.user_id and cr.rank_id=u.rank_id
			inner join rank_log as rl on rl.user_id=u.user_id where u.rank_id is not NULL 
			group by u.user_id;";

  	}
  	$query=$this->db->query($sql);
  	//pr($query->result());
    return $query->result();
  }
  public function getTopEarnerReport($user_id=null)
  {
  	$data=$this->db->query("SELECT round(sum(credit_amt),2) as amount,user_id FROM `credit_debit` where reason in ('5','6','8','13','9') and ttype in ('Binary Income','Direct Matching Bonus','Fast Start Bonus','Rank Bonus','Referral Bonus','Upgrade Referral Bonus') group by user_id order by sum(credit_amt) desc limit 20;")
      ->result_array();
     return $data;
  }//end method
  public function getTopRecuriterReport()
  {
      $data=$this->db->query("SELECT count(id) as total_direct_member,income_id as user_id,l_date as create_date FROM `direct_matrix_downline` where level=1 group by income_id order by count(id) desc limit 20;")
      ->result_array();
      //note reason =6 is taken for binary commission
      /*if(!empty($user_id))
      {
        $sql="SELECT cd.transaction_no, cd.user_id, u.username, u.active_status, sum(cd.credit_amt) as total_commission, cd.create_date FROM `credit_debit` as cd 
          join user_registration as u on u.user_id=cd.user_id 
          WHERE cd.reason='6' and cd.user_id='$user_id'  group by create_date,cd.user_id";
      }
      else 
      {
        $sql="SELECT cd.transaction_no, cd.user_id, u.username, u.active_status, sum(cd.credit_amt) as total_commission, cd.create_date FROM `credit_debit` as cd 
          join user_registration as u on u.user_id=cd.user_id 
          WHERE cd.reason='6'  group by create_date,cd.user_id";
          //echo $sql;
      }
      $query=$this->db->query($sql);
      $data=$query->result_array();
      //pr($data);
      for($i=0;$i<count($data);$i++)
      {
        $j=$i-1;
        $ref_id=$data[$i]['user_id'];
        if($i==0)
        {
          $date=$data[$i]['create_date'];
          $result=$this->db->query("select * from user_registration where ref_id='$ref_id' and auto_registration_date<='$date'")->result();
          $total_direct_member=count($result);
        }
        else 
        {
          $start_date=$data[$j]['create_date'];
          $end_date=$data[$i]['create_date'];

          $result=$this->db->query("select * from user_registration where ref_id='$ref_id' and auto_registration_date>='$start_date' and auto_registration_date<='$end_date'")->result();
          $total_direct_member=count($result);
        }
        $data[$i]['total_direct_member']=$total_direct_member;
      }
      //pr($data);

      for($i=0;$i<count($data);$i++)
      {
        $j=$i-1;
        $income_id=$data[$i]['user_id'];
        if($i==0)
        {
          $date=$data[$i]['create_date'];
          $result=$this->db->query("select * from matrix_downline where income_id='$income_id' and l_date<='$date'")->result();
          $total_team_member=count($result);
        }
        else 
        {
          $start_date=$data[$j]['create_date'];
          $end_date=$data[$i]['create_date'];
          $result=$this->db->query("select * from matrix_downline where income_id='$income_id' and l_date>='$start_date' and l_date<='$end_date'")->result();
          $total_team_member=count($result);
        }
        $data[$i]['total_team_member']=$total_team_member;
      }
      for($i=0;$i<count($data);$i++)
      {
        for($j=0;$j<count($data);$j++)
        {
          if(!empty($data[$i]['create_date']) && !empty($data[$j]['create_date']) && $data[$i]['create_date']==$data[$j]['create_date'])
          {
            if($data[$i]['total_team_member']+$data[$i]['total_direct_member']>$data[$j]['total_team_member']+$data[$j]['total_direct_member'])
            {
              unset($data[$j]);
            }
            else if($data[$i]['total_team_member']+$data[$i]['total_direct_member']<$data[$j]['total_team_member']+$data[$j]['total_direct_member'])
            {
              unset($data[$i]);
            }
          }
        }
      }*///end for loop here
      //pr($data);
      //die;
     return $data;  	
  }//end method
}//end class
?>