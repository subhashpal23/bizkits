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
      'l.leg',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('level_income_binary as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
   /*
   @Desc:It's used to return the total dirrect/referral member on the basis of user_id
   */
   public function getTotalDirectMember($user_id)
   {
    $total_direct_member=$this->db->select('id')->from('user_registration')->where('ref_id',$user_id)->get()->num_rows();
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
}//end class
?>