<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/user
*/
class School extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		school_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		$this->load->model('dashboard_model');
		$this->load->model('ewallet_model');
		
		$this->load->model('TeamReport_model','team_report');
		$this->load->model('IncomeReport_Model','income_report');

	} 
	/*
	@Desc:It's used to render the userbackoffice dashboard page
	*/
	public function index()
	{
	    //echo "akjskas"; exit;
		/*************************/
		$user_details=$this->dashboard_model->getUserDetails($this->user_id);
        $data['referral_link']=base_url().'join-us/'.$this->user_id;
        

		$data['user_details']=$user_details;

		$data['sponsor_details']=$this->dashboard_model->getSponsorDetails($this->user_id);
		$data['students']=$this->db->select('id')->from('user_registration')->where('parent_id',$this->user_id)->get()->num_rows();
		$data['products']=$this->db->select('id')->from('eshop_products')->where('user_id',$this->user_id)->get()->num_rows();
		$finalprice=$this->db->select_sum('final_price')->from('eshop_orders')->where('user_id',$this->user_id)->get()->row();
        $data['final_price']=$finalprice->final_price;
		$data['ewallet_balance']=$this->ewallet_model->getEwalletBalance($this->user_id);
		
		
        $data['callfunc']=$this;
        //echo $this->user_id;
        $doccount=$this->db->select('*')->from('user_school_docs')->where(array('user_id'=>$this->user_id))->get()->num_rows();
        $data['doccount']=$doccount;
        if($doccount>0)
        {
            $user_info=$this->db->select('*')->from('user_school_docs')->where(array('user_id'=>$this->user_id))->get()->row();
    	    $data['documents_list']=json_decode($user_info->documents_list);
    	    $data['verify_status']=$user_info->verify_status;
    	    if($user_info->verify_status){$data['verify_date']=$user_info->verify_date;}
    	    else{$data['verify_date']=$user_info->request_date;}
        }
		_userLayout("dashboard",$data);
	}
	
	public function allDocuments()
	{
	    if(!empty($this->input->post('btn')))
	    {
	        //pr($_FILES);
	        $image_upload_path='/schooldocuments/';
		    $nin_doc=adImageUpload($_FILES['nin_doc'],1, $image_upload_path);
		    $registration_doc=adImageUpload($_FILES['registration_doc'],1, $image_upload_path);
		    $agreement_doc=adImageUpload($_FILES['agreement_doc'],1, $image_upload_path);
		    $campus_photo=adImageUpload($_FILES['campus_photo'],1, $image_upload_path);
		    $this->user_id;
		    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$this->user_id,
    		 'nin_doc'=>$nin_doc,
    		 'registration_doc'=>$registration_doc,
    		 'agreement_doc'=>$agreement_doc,
    		 'campus_photo'=>$campus_photo,
    	     'document_upload_date'=>date('Y-m-d H:i:s')
    		);
    		$array=array(
    		    'documents_list'=>json_encode($user_registration_data),
    		    'user_id'=>$this->user_id
    		    );
    		    
    		 $user_count=$this->db->select('*')->from('user_school_docs')->where(array('user_id'=>$this->user_id))->get()->num_rows();
			
			if($user_count==1)
			{
				$this->db->update('user_school_docs',$array,array('user_id'=>$this->user_id));
			}
			else
			{
			    $this->db->insert('user_school_docs',$array);
			}
            
            $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Documents uploaded successfully.');
			redirect(ci_site_url().'School/allDocuments');
			exit;
	    }
	    $doccount=$this->db->select('*')->from('user_school_docs')->where(array('user_id'=>$this->user_id))->get()->num_rows();
        $data['doccount']=$doccount;
        if($doccount>0)
        {
            $user_info=$this->db->select('*')->from('user_school_docs')->where(array('user_id'=>$this->user_id))->get()->row();
    	    $data['documents_list']=json_decode($user_info->documents_list);
    	    $data['verify_status']=$user_info->verify_status;
    	    if($user_info->verify_status){$data['verify_date']=$user_info->verify_date;}
    	    else{$data['verify_date']=$user_info->request_date;}
        }
	    _userLayout("document",$data);
	}
	
	public function getROIStatus($deposit_id,$request_date)
	{
	    //echo "select id from credit_debit_investment where reason='3' and deposit_id='".$deposit_id."' and receive_date='".$request_date."'";
	    $incomeinfo=$this->db->query("select id from credit_debit_investment where reason='3' and deposit_id='".$deposit_id."' and receive_date='".$request_date."'")->num_rows();
	    return $incomeinfo;
	}
}//end class
