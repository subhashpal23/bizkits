<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/MyGenealogy
*/
class MyGenealogy extends Common_Controller 
{
	private $userId;
	private $moduleName;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("network_model");
		$this->load->model("member_model");
		$this->load->model("unilevel_tree_model");
		$this->userId=$this->session->userdata('user_id');
		$this->moduleName=$this->router->fetch_module();
	} 
	/*
	@Desc: It's used to display the team view in binary format
	*/
	public function myTeamTree($user_id=null)
	{
         $user_id=(!empty($user_id))?ID_decode($user_id):COMP_USER_ID;
         $data=$this->network_model-> getGenealogyTreeChildElement($user_id);
         $data['module_name']=$this->moduleName;
		_adminLayout("network-mgmt/genealogy-tree",$data);
	}
	/*
	@author   : Aditya
    @param    : int(parent_id or root_id)
    @desc     : It's used to get all the child memeber on ajax request
    @signature: genealogy_ajax_tree(int)
    @return   :none
	*/
	public function genealogy_ajax_tree($parent_id=null)
	{
      $data=$this->network_model->getGenealogyTreeChildElement($parent_id);
      $data['module_name']=$this->moduleName;
      $this->load->view("network-mgmt/genealogy-ajax-tree.php",$data);
	}//end method
	/*
	@Desc: It's used to display the team view in unilevel/direct member tree format
	*/
	public function directReferralTree()
	{
		//$user_id=$this->session->userdata('user_id');
        $data['title']="Direct Referral Tree";
        $data['breadcrumb']='<li class="active">Direct Referral Tree</li>';
        $data['root']=$this->unilevel_tree_model->getUserDetails($this->userId);
        $data['all_direct_member']=$this->unilevel_tree_model->getAllDirectUser($this->userId);
	    $this->load->view("my-genealogy-mgmt/direct-referral-tree",$data);	
	}
	/*
    @desc: It's used to get all the child (direct member/unilevel tree) member on ajax request
	*/
	public function directAjaxTree($parent_id=null)
	{
        $data['root']=$this->unilevel_tree_model->getUserDetails($parent_id);
        $data['all_direct_member']=$this->unilevel_tree_model->getAllDirectUser($parent_id);
	    $this->load->view("my-genealogy-mgmt/direct_ajax_tree",$data);	

	}//end method
	/*
    @desc: It's used to get all the unilevel tree popup member info on ajax request
	*/
	public function directTreeAjaxPopupInfo($user_id)
	{
        $data['parent']=$this->unilevel_tree_model->getParentDetails($user_id);
        $data['sponsor']=$this->unilevel_tree_model->getSponsorDetails($user_id);
        $data['total_direct_downline_member']=$this->unilevel_tree_model->getTotalDirectDownline($user_id);
        $data['total_downline_member']=$this->unilevel_tree_model->getTotalDownlineMembers($user_id);
	    $this->load->view("my-genealogy-mgmt/unilevel-tree-ajax-popup-info",$data);	
	}
}//end class
