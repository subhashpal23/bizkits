<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/TeamReport
*/
class TeamReport extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		affiliate_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('TeamReport_Model','team_report');
	} 
	/*
	@Desc: It's used to view the all the direct referral lis
	*/
	public function directReferralMemberList()
	{
	    $data['title']="Direct Referral Member Report";
	    $data['breadcrumb']='<li class="active">Direct Referral Member Report</li>';
		$data['direct_member']=$this->team_report->getDirectReferralMemberList($this->userId);
		$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		$data['total_team_member']=$this->team_report->getTotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/direct-referral-member-list",$data);
	}
	public function binaryMemberList()
	{
	    $data['title']="Binary Member Report";
	    $data['breadcrumb']='<li class="active">Binary Member Report</li>';
		$data['direct_member']=$this->team_report->getBinaryMemberList($this->userId);
		//$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		//$data['total_team_member']=$this->team_report->getTotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/binary-member-list",$data);
	}
	/*
	@Desc: It's used to view all the team member list/downline team member
	*/
	public function teamMemberList()
	{
	    $data['title']="Team Member Report";
	    $data['breadcrumb']='<li class="active">Team Member Report</li>';
		$team_member=$data['team_member']=$this->team_report->getTeamMemberList($this->userId);
		foreach($team_member as $key=>$val)
		{
		    if($val->level==1)
		    $array['level1'][]=$val->level;
		    if($val->level==2)
		    $array['level2'][]=$val->level;
		    if($val->level==3)
		    $array['level3'][]=$val->level;
		    if($val->level==4)
		    $array['level4'][]=$val->level;
		}
		$data['level1']=count($array['level1']);
		$data['level2']=count($array['level2']);
		$data['level3']=count($array['level3']);
		$data['level4']=count($array['level4']);
		//$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		//$data['total_team_member']=$this->team_report->getTotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/team-member-list",$data);
	}
}//end class
