<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/MyGenealogy
*/
class MyGenealogy extends Common_Controller 
{
	private $userId;
	private $moduleName;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		affiliate_auth();
		$this->load->helper("layout_helper");
		$this->load->model("network_model");
		$this->load->model("member_model");
		$this->load->model("package_model");
		$this->load->model("unilevel_tree_model");
		$this->userId=$this->session->userdata('user_id');
		$this->moduleName=$this->router->fetch_module();
	} 
	/*
	@Desc: It's used to display the team view in binary format
	*/
	public function myTeamTree($user_id=null)
	{
         /*$data=$this->network_model->getGenealogyTreeChildElement($this->userId);
		 $user_details=get_user_details($this->userId);
		 $data['username']=$user_details->username;
         $data['module_name']=$this->moduleName;*/
         if($user_id)
		{
		    // get level from main user
		    
		}
		else
    	{
    	    $user_id=$this->userId;
    	}
         $binarylistleft=$this->network_model->getBinaryTreeChildElement($user_id,'left');
         //echo $this->db->last_query();
		 $data['binarylistleft']=$binarylistleft;
		 $binarylistright=$this->network_model->getBinaryTreeChildElement($user_id,'right');
		 $data['binarylistright']=$binarylistright;
		 $user_details=get_user_details($user_id);
		 $data['user_details']=$user_details;
		 $data['username']=$user_details->username;
         $data['module_name']=$this->moduleName;
         $data['callfun']=$this;
		_userLayout("network-mgmt/binary-tree",$data);
	}
	public function getleveltree($user_id,$leg)
	{
	    $binarylist=$this->network_model->getBinaryTreeChildElement($user_id,$leg);
	    return $binarylist;
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
      $user_details=get_user_details($this->userId);
	  $data['username']=$user_details->username;
	  $data['module_name']=$this->moduleName;
      $this->load->view("network-mgmt/genealogy-ajax-tree",$data);
	}//end method
	/*
	@Desc: It's used to display the team view in unilevel/direct member tree format
	*/
	public function directReferralTree($user_id=null)
	{
		//$user_id=$this->session->userdata('user_id');
		//echo $user_id;
		if($user_id)
		{
		    // get level from main user
		    $uinfo=$this->db->select('*')->from('direct_matrix_downline')->where(array('down_id'=>$user_id,'income_id'=>$this->userId))->get()->row();;
		    //pr($uinfo);
		    $level=$uinfo->level+1;
		}
		else
    	{
    	    $user_id=$this->userId;
    	    $level=1;
    	    
    	}
	    $data['level']=$level;
        $data['title']="Direct Referral Tree";
        $data['breadcrumb']='<li class="active">Direct Referral Tree</li>';
        $data['root']=$this->unilevel_tree_model->getUserDetails($user_id);
        $data['all_direct_member']=$this->unilevel_tree_model->getAllDirectUser($user_id);
        $data['main_user_id']=$this->userId;
        $data['main_username']=get_user_name($this->userId);
        $data['show_user_id']=$user_id;
        $data['show_username']=get_user_name($user_id);
	    _userLayout("network-mgmt/direct-tree",$data);	
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
	public function tabularTree()
	{
        $this->load->helper('tabular_tree');
        $data['title']="Tabular Tree";
        $data['user_id']=$this->userId;
        $data['breadcrumb']='<li class="active">Upgrade Package</li>';
	   _userLayout("my-genealogy-mgmt/tabular-tree",$data);	
	}
	
	/*
	@Desc:It's used to display the feeder stage tree
	*/
	public function feederStageTree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    $level1_info=$this->db->select(array('u.*'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1'))->get()->result();
		

	    $data['title']="Stage1 Tree";
	    $data['breadcrumb']='<li class="active">Stage1 Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;

		$data['title']="Prinicipal Tree";
		$data['callfun']=$this;
		$data['level1_info']=$level1_info;
		$data['level2_info']=$level2_info;
		$data['level3_info']=$level3_info;
		$data['level4_info']=$level4_info;
		//$data['level2_info'][1]=$level2_info_2;
		_userLayout("network-mgmt/affiliate-tree",$data);	
	}//end method
	public function getlevelusers($user_id,$level)
	{
	    $level2_info=$this->db->select(array('u.*'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>$level))->get()->result();
		return $level2_info;
	}
	public function getDirectlevelusers($user_id,$level)
	{
	    $level2_info=$this->db->select(array('u.*'))->from('direct_matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>$level))->get()->result();
		return $level2_info;
	}
	/*
	@Desc:It's used to display the stage1 tree
	*/
	public function stage1Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    $level1_info=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1'))->get()->result();
	    //pr($level1_info);
		/*----2nd level data-----*/
		if(!empty($level1_info[0]->user_id))
		{
	        $level2_info_1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[0]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[1]->user_id))
		{
		    $level2_info_2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[1]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[2]->user_id))
		{
		    $level2_info_3=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[2]->user_id, 'level'=>'1'))->get()->result();
		}
		
	    $data['title']="1 Star Tree";
	    $data['breadcrumb']='<li class="active">Supervisor Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		///level 1 data
		
		//_userLayout("network-mgmt/tree_stage1",$data);
		
		$data['controller']=$this;
		$data['table']='matrix_stage1';
		$data['action']='stage1Tree';
		$data['level1_info']=$level1_info;
		$data['level2_info'][0]=$level2_info_1;
		$data['level2_info'][1]=$level2_info_2;
		$data['level2_info'][2]=$level2_info_3;
		_userLayout("network-mgmt/supervisor-tree",$data);	
	}//end method


    public function showusers($user_id,$table)
    {
        $level1_info=$this->db->select(array('u.username','u.user_id'))->from($table.' as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1'))->get()->result();
	    return $level1_info;
    }
	/*
	@Desc:It's used to display the stage2 tree
	*/
	public function stage2Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    $level1_info=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1'))->get()->result();
	    //pr($level1_info);
		/*----2nd level data-----*/
		if(!empty($level1_info[0]->user_id))
		{
	        $level2_info_1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[0]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[1]->user_id))
		{
		    $level2_info_2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[1]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[2]->user_id))
		{
		    $level2_info_3=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[2]->user_id, 'level'=>'1'))->get()->result();
		}
	    $data['title']="2 Star Tree";
	    $data['breadcrumb']='<li class="active">Manager Tree</li>';
		/////
		$data['action']='stage2Tree';
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		///level 1 data
		
		
		$data['controller']=$this;
		$data['table']='matrix_stage2';
		$data['level1_info']=$level1_info;
		$data['level2_info'][0]=$level2_info_1;
		$data['level2_info'][1]=$level2_info_2;
		$data['level2_info'][2]=$level2_info_3;
		
		_userLayout("network-mgmt/supervisor-tree",$data);	
	}//end method

	/*
	@Desc:It's used to display the stage2 tree
	*/
	public function stage3Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    $level1_info=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1'))->get()->result();
	    //pr($level1_info);
		/*----2nd level data-----*/
		if(!empty($level1_info[0]->user_id))
		{
	        $level2_info_1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[0]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[1]->user_id))
		{
		    $level2_info_2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[1]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[2]->user_id))
		{
		    $level2_info_3=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[2]->user_id, 'level'=>'1'))->get()->result();
		}
	    
	    $data['breadcrumb']='<li class="active">Senior Manager Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		///level 1 data
		
		//_userLayout("network-mgmt/tree_stage1",$data);
		$data['title']="3 Star Stage";
		$data['controller']=$this;
		$data['table']='matrix_stage3';
		$data['level1_info']=$level1_info;
		$data['level2_info'][0]=$level2_info_1;
		$data['level2_info'][1]=$level2_info_2;
		$data['level2_info'][2]=$level2_info_3;
		$data['action']='stage3Tree';
		//$data['level3_info'][0]=$level3_info_1;
		//$data['level3_info'][1]=$level3_info_2;
		//$data['level3_info'][2]=$level3_info_3;
		//$data['level3_info'][3]=$level3_info_4;
		_userLayout("network-mgmt/supervisor-tree",$data);	
	}//end method
	/*
	@Desc:It's used to display the stage2 tree
	*/
	public function stage4Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    $level1_info=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1'))->get()->result();
	    //pr($level1_info);
		/*----2nd level data-----*/
		if(!empty($level1_info[0]->user_id))
		{
	        $level2_info_1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[0]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[1]->user_id))
		{
		    $level2_info_2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[1]->user_id, 'level'=>'1'))->get()->result();
		}
		
	    $data['title']="4 Star Tree";
	    $data['breadcrumb']='<li class="active">General Manager Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	   
		$data['controller']=$this;
		$data['table']='matrix_stage4';
		$data['level1_info']=$level1_info;
		$data['level2_info'][0]=$level2_info_1;
		$data['level2_info'][1]=$level2_info_2;
		$data['action']='stage4Tree';
		//$data['level3_info'][0]=$level3_info_1;
		//$data['level3_info'][1]=$level3_info_2;
		//$data['level3_info'][2]=$level3_info_3;
		//$data['level3_info'][3]=$level3_info_4;
		_userLayout("network-mgmt/supervisor-tree",$data);	
	}//end method


	/*
	@Desc:It's used to display the stage2 tree
	*/
	public function stage5Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    $level1_info=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1'))->get()->result();
	    //pr($level1_info);
		/*----2nd level data-----*/
		if(!empty($level1_info[0]->user_id))
		{
	        $level2_info_1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[0]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[1]->user_id))
		{
		    $level2_info_2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[1]->user_id, 'level'=>'1'))->get()->result();
		}
		
	    $data['title']="5 STar Tree";
	    $data['breadcrumb']='<li class="active">Director Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    
		$data['controller']=$this;
		$data['table']='matrix_stage5';
		$data['level1_info']=$level1_info;
		$data['level2_info'][0]=$level2_info_1;
		$data['level2_info'][1]=$level2_info_2;
		$data['action']='stage5Tree';
		//$data['level3_info'][0]=$level3_info_1;
		//$data['level3_info'][1]=$level3_info_2;
		//$data['level3_info'][2]=$level3_info_3;
		//$data['level3_info'][3]=$level3_info_4;
		_userLayout("network-mgmt/supervisor-tree",$data);	
	}//end method
	/*
	@Desc:It's used to display the stage6 tree
	*/
	public function stage6Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    $level1_info=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1'))->get()->result();
		/*----2nd level data-----*/
		if(!empty($level1_info[0]->user_id))
		{
		    $level2_info_1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[0]->user_id, 'level'=>'1'))->get()->result();

		}
		if(!empty($level1_info[1]->user_id))
		{
		    $level2_info_2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[1]->user_id, 'level'=>'1'))->get()->result();
		}
		if(!empty($level1_info[2]->user_id))
		{
	    $level2_info_3=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info[2]->user_id, 'level'=>'1'))->get()->result();
		}


	    $data['title']="TITANIUM TREE";
	    $data['breadcrumb']='<li class="active">TITANIUM TREE</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		///level 1 data
		if(!empty($level1_info) && count($level1_info)>0)
		{
			if(!empty($level1_info[0]))
			{
				$data['level1_username1']=$level1_info[0]->username;
				$data['level1_user_id1']=$level1_info[0]->user_id;
			}
			//
			if(!empty($level1_info[1]))
			{
				$data['level1_username2']=$level1_info[1]->username;
				$data['level1_user_id2']=$level1_info[1]->user_id;
			}
			///
			if(!empty($level1_info[2]))
			{
				$data['level1_username3']=$level1_info[2]->username;
				$data['level1_user_id3']=$level1_info[2]->user_id;
			}
		}//end level1 if here!
	    ///level 2 data
		if(!empty($level2_info_1) && count($level2_info_1)>0)
		{
			if(!empty($level2_info_1[0]))
			{
				$data['level2_username1']=$level2_info_1[0]->username;
				$data['level2_user_id1']=$level2_info_1[0]->user_id;
			}
			//
			if(!empty($level2_info_1[1]))
			{
				$data['level2_username2']=$level2_info_1[1]->username;
				$data['level2_user_id2']=$level2_info_1[1]->user_id;
			}
			if(!empty($level2_info_1[2]))
			{
				$data['level2_username3']=$level2_info_1[2]->username;
				$data['level2_user_id3']=$level2_info_1[2]->user_id;
			}
		}
		if(!empty($level2_info_2) && count($level2_info_2)>0)
		{	
			//
			if(!empty($level2_info_2[0]))
			{
				$data['level2_username4']=$level2_info_2[0]->username;
				$data['level2_user_id4']=$level2_info_2[0]->user_id;
			}
			//
			if(!empty($level2_info_2[1]))
			{
				$data['level2_username5']=$level2_info_2[1]->username;
				$data['level2_user_id5']=$level2_info_2[1]->user_id;			
			}
			//
			if(!empty($level2_info_2[2]))
			{
				$data['level2_username6']=$level2_info_2[2]->username;
				$data['level2_user_id6']=$level2_info_2[2]->user_id;			
			}
		}//end level2 if here!
		///
		if(!empty($level2_info_3) && count($level2_info_3)>0)
		{	
			//
			if(!empty($level2_info_3[0]))
			{
				$data['level2_username7']=$level2_info_3[0]->username;
				$data['level2_user_id7']=$level2_info_3[0]->user_id;
			}
			//
			if(!empty($level2_info_3[1]))
			{
				$data['level2_username8']=$level2_info_3[1]->username;
				$data['level2_user_id8']=$level2_info_3[1]->user_id;			
			}
			//
			if(!empty($level2_info_3[2]))
			{
				$data['level2_username9']=$level2_info_3[2]->username;
				$data['level2_user_id9']=$level2_info_3[2]->user_id;			
			}
		}//end level2 if here!
		_userLayout("network-mgmt/tree_stage6",$data);	
	}//end method
	public function SearcUser()
	{
	    //pr($_POST); exit;
	    $username=$this->input->post('username');
	    $action=$this->input->post('stage');
	    $userid=$this->input->post('userid');
	    // check user
	    $count=$this->db->select('id')->from('user_registration')->where('username',$username)->or_where('user_id',$username)->get()->num_rows();
	    if($count)
	    {
	        $userinfo=$this->db->select('user_id')->from('user_registration')->where('username',$username)->or_where('user_id',$username)->get()->row();
	        $userid=$userinfo->user_id;
	    }
	    
	    if($userid)
	    {
	     redirect(base_url().'Affiliate/MyGenealogy/'.$action.'/'.ID_encode($userid)); exit;   
	    }
	}
}//end class
