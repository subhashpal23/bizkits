<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/teamreport_model
*/
class TeamReport_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  /*
  @Desc: It's used to get all the direct referral member
  */
  public function getDirectReferralMemberList($user_id)
  {
    return $this->db->select('*')->from('user_registration')->where('ref_id',$user_id)->order_by('id','desc')->get()->result();
  }
  /*
  @Desc: It's used to get all the team member
  */
  public function getTeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_downline as l')->join('user_registration as u', 'u.user_id=l.down_id')->where(array('l.income_id'=>$user_id,'level <'=>5))->order_by('l.level','asc')->get()->result();
  }
  
  public function getBinaryMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'l.leg',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('level_income_binary as l')->join('user_registration as u', 'u.user_id=l.down_id')->where(array('l.income_id'=>$user_id))->order_by('l.level','asc')->get()->result();
  }
   /*
   @Desc:It's used to return the total dirrect/referral member on the basis of user_id
   */
   public function getTotalDirectMember($user_id)
   {
    $total_direct_member=$this->db->select('id')->from('user_registration')->where('ref_id',$user_id)->get()->num_rows();
    return $total_direct_member;
   }
   public function getTotalMember($user_id,$type)
   {
    $total_direct_member=$this->db->select('id')->from('user_registration')->where(array('ref_id'=>$user_id,'member_type'=>$type))->get()->num_rows();
    //echo $this->db->last_query();
    return $total_direct_member;
   }
   /*
   @Desc:It's used to return the total team member on the basis of user_id
   */
   public function getTotalTeamMember($user_id)
   {
    $total_team_member=$this->db->select('id')->from('level_income_binary')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
   }
   public function getTeamMember($user_id,$pos)
   {
    $total_team_member=$this->db->select('id')->from('level_income_binary')->where(array('income_id'=>$user_id,'leg'=>$pos))->get()->num_rows();
    return $total_team_member;
   }
   public function getTotalPv($user_id,$status)
   {
    $total_team_member=$this->db->select_sum('pv')->from('matrix_downline_pv')->where(array('income_id'=>$user_id,'status'=>$status))->get()->row();
    return $total_team_member->pv;
   }
   public function getTotalPosPv($user_id,$pos,$status)
   {
    $total_team_member=$this->db->select_sum('pv')->from('matrix_downline_pv')->where(array('income_id'=>$user_id,'leg'=>$pos,'status'=>$status))->get()->row();
    return $total_team_member->pv;
   }
   public function getTotalRankPv($user_id,$pos)
   {
    $total_team_member=$this->db->select_sum('pv')->from('matrix_downline_pv')->where(array('income_id'=>$user_id,'leg'=>$pos,'type <>'=>'Carry Forward PV'))->get()->row();
    return $total_team_member->pv;
   }
}//end class
?>