<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/CommissionReport
*/
class CommissionReport extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("commission_report_model");
		$this->load->helper("commission_helper");
		$this->load->library('pagination'); 
		$this->perPage = 200;
	}//end constructor 
	public function allCommission()
	{
		$data=array();
		$data = $conditions = array(); 
        $uriSegment = 5;
        $reason = $this->uri->segment(4);
         
        // Get record count 
        $conditions['returnType'] = 'count'; 
        //$totalRec = $this->post->getRows($conditions); 
        $totalRec=$all_members=$this->commission_report_model->getAllCommission($conditions,$reason);
         
        // Pagination configuration 
        $config['base_url']    = base_url().'Admin/CommissionReport/allCommission/'.$reason.'/'; 
        //$config['use_page_numbers'] = TRUE;
        //$config['page_query_string'] = TRUE;
        $config['uri_segment'] = $uriSegment; 
        $config['total_rows']  = $totalRec; 
        $config['per_page']    = $this->perPage; 
        
        
        // Initialize pagination library 
        $this->pagination->initialize($config); 
         
        // Define offset 
        $page = $this->uri->segment($uriSegment); 
        $offset = !$page?0:$page; 
         
        // Get records 
        $conditions = array( 
            'start' => $offset, 
            'limit' => $this->perPage 
        ); 
		//$data['type']=$type;
		$data['direct_referral_income']=$this->commission_report_model->getAllCommission($conditions,$reason);
		$data['start'] = $offset;
		$data['reason'] = $reason;
		$data['report_type']=$this->db->query("select reason,ttype from credit_debit group by reason")->result();
		_adminLayout("commission-report-mgmt/all-commission",$data);
	}
	
	public function faststartCommission()
	{
		$data=array();
		$data = $conditions = array(); 
        $uriSegment = 4;
        $reason = $this->uri->segment(4);
         
        // Get record count 
        $conditions['returnType'] = 'count'; 
        //$totalRec = $this->post->getRows($conditions); 
        $totalRec=$all_members=$this->commission_report_model->getFastStartCommission($conditions,$reason);
         
        // Pagination configuration 
        $config['base_url']    = base_url().'Admin/CommissionReport/faststartCommission/'.$reason.'/'; 
        //$config['use_page_numbers'] = TRUE;
        //$config['page_query_string'] = TRUE;
        $config['uri_segment'] = $uriSegment; 
        $config['total_rows']  = $totalRec; 
        $config['per_page']    = $this->perPage; 
        
        
        // Initialize pagination library 
        $this->pagination->initialize($config); 
         
        // Define offset 
        $page = $this->uri->segment($uriSegment); 
        $offset = !$page?0:$page; 
         
        // Get records 
        $conditions = array( 
            'start' => $offset, 
            'limit' => $this->perPage 
        ); 
		//$data['type']=$type;
		$data['direct_referral_income']=$this->commission_report_model->getFastStartCommission($conditions,$reason);
		$data['start'] = $offset;
		$data['reason'] = $reason;
		//$data['report_type']=$this->db->query("select reason,ttype from credit_debit group by reason")->result();
		_adminLayout("commission-report-mgmt/faststart-commission",$data);
	}
	public function dailyCommission()
	{
		$data=array();
		$data['direct_referral_income']=$this->commission_report_model->getDailyCommission();
		_adminLayout("commission-report-mgmt/daily-commission",$data);
	}
	public function directReferralCommission()
	{
		$data=array();
		$data['direct_referral_income']=$this->commission_report_model->getDirectReferralCommission();
		_adminLayout("commission-report-mgmt/direct-referral-commission",$data);
	}
	public function unilevelCommission()
	{
		$data=array();
		$data['level_income']=$this->commission_report_model->getUnilevelCommission();
		_adminLayout("commission-report-mgmt/unilevel-commission",$data);
	}
	public function binaryCommission()
	{
		$data=array();
		$data['binary_commission']=$this->commission_report_model->getBinaryCommission();
		_adminLayout("commission-report-mgmt/binary-commission",$data);
	}
	public function matchingCommission()
	{
		$data=array();
		$data['matching_commission']=$this->commission_report_model->getMatchingCommission();
		_adminLayout("commission-report-mgmt/matching-commission",$data);
	}
	/*
	@Desc: It's used to credit binary commission manually
	*/
	public function creditBinaryCommission()
	{
		/*
		@call to creditBinaryCommission() of commission_helper
		*/
		$credit_status=creditBinaryCommission();
		if($credit_status==0)
		{
			$flash_msg='<span class="text-semibold">Well done!</span> Sorry no more binary commission is left to be credited';

		}
		else if($credit_status==1)
		{
			$flash_msg='<span class="text-semibold">Well done!</span> Binary commission is credited successfully';
		}
		$this->session->set_flashdata("flash_msg",$flash_msg);
		redirect(ci_site_url()."admin/CommissionReport/binaryCommission");
		exit;
	}
	/*
	@Desc: It's used to credit matching commission manually
	*/
	public function creditMatchingCommission()
	{
		/*
		@call to creditMatchingCommission() of commission_helper
		*/
		$credit_status=creditMatchingCommission();
		if($credit_status==0)
		{
		 $flash_msg='<span class="text-semibold">Well done!</span> Sorry no more matching commission is left to be credited';
		}
		else if($credit_status==1)
		{
		 $flash_msg='<span class="text-semibold">Well done!</span> Matching commission is credited successfully';
		}
		$this->session->set_flashdata("flash_msg",$flash_msg);
		redirect(ci_site_url()."admin/CommissionReport/matchingCommission");
		exit;
	}	
	public function rankBonus()
	{
		$data=array();
		$data['rank_bonus']=$this->commission_report_model->getRankBonus();
		_adminLayout("commission-report-mgmt/rank-bonus",$data);
	}

	public function rankAchieverReport($user_id=null)
	{
		$data=array();
		//$data['rank_achiever_report']=$this->commission_report_model->getRankAchieverReport($user_id);
		//echo $this->db->last_query();
		//pr($data['rank_achiever_report']);
		$data['rank_list']=$this->db->select('*')->from('rank')->get()->result();
		if($user_id)
		{
		    $where="where r.nextrank_id='".$user_id."'";
		}
		else
		{
		    $where='';
		}
		$data['rank_achiever_report']=$this->db->query("SELECT r.*,rank_name FROM `rank_bonus` as r inner join rank as rr on r.nextrank_id=rr.id ".$where." GROUP by nextrank_id,user_id order by bonus_date desc;")->result();
		$data['callfunc']=$this;
		_adminLayout("commission-report-mgmt/rank-achiever-report",$data);
	}
	
	public function getrankbonus($user_id)
	{
	    $this->db->select_sum('*')->from('rank_bonus')->where('user_id',$user_id)->get()->row();
	}

	public function topEarnerReport()
	{
		$data=array();
		$data['top_earner_report']=$this->commission_report_model->getTopEarnerReport();
		$data['callfunc']=$this;
		_adminLayout("commission-report-mgmt/top-earner-report",$data);
	}

	public function topRecruiterReport()
	{
		$data=array();
		$data['top_recruiter_report']=$this->commission_report_model->getTopRecuriterReport();
		$data['callfunc']=$this;
		_adminLayout("commission-report-mgmt/top-recruiter-report",$data);
	}
	public function get_total_team_members($user_id)
	{
	    $res=$this->db->select('down_id')->from('level_income_binary')->where('income_id',$user_id)->get()->num_rows();
	    //echo $this->db->last_query();
	    return $res;
	}
	public function get_total_direct_members($user_id)
	{
	    $res=$this->db->select('down_id')->from('direct_matrix_downline')->where(array('income_id'=>$user_id,'level'=>'1'))->get()->num_rows();
	    //echo $this->db->last_query();
	    return $res;
	}
}//end class