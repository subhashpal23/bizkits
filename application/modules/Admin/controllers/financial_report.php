<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/financial_report
*/
class Financial_Report extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("financial_report_model");
	}
	public function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d' ) 
	{
                $dates = array();
                $current = strtotime($first);
                $last = strtotime($last);

                while( $current <= $last ) {    
                    $dates[] = date($format, $current);
                    $current = strtotime($step, $current);
                }
                return $dates;
    }	
	public function index()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$start_date=date('Y-m-d',strtotime($this->input->post('start_date')));
			$end_date=date('Y-m-d',strtotime($this->input->post('end_date')));
			////////////////////////////////////////////////////////////////////
			$all_date=$this->dateRange($start_date,$end_date);
			$finacial_report_array=array();
			foreach($all_date as $date)
			{
			 $details=$this->financial_report_model->financial_reports($date);	
			 $finacial_report_array[]=(object)$details;
			}
			$data['finacial_report_array']=$finacial_report_array;
			$data['start_date']=date('m/d/Y',strtotime($start_date));
			$data['end_date']=date('m/d/Y',strtotime($end_date));

		}
		else if(!empty($this->input->post('download_csv')))
		{
			$start_date=date('Y-m-d',strtotime($this->input->post('start_date')));
			$end_date=date('Y-m-d',strtotime($this->input->post('end_date')));
			////////////////////////////////////////////////////////////////////
			$all_date=$this->dateRange($start_date,$end_date);
			$finacial_report_array=array();
			foreach($all_date as $date)
			{
			 $details=$this->financial_report_model->financial_reports($date);	
			 $finacial_report_array[]=(object)$details;
			}
			$this->export_multiple_payoutdata($finacial_report_array);
			exit;
		}
		/*else 
		{
			$end_date=date('Y-m-d');
			$start_date=date('Y-m-d',strtotime($end_date. '-7 day'));
			$all_date=$this->dateRange($start_date,$end_date);
			$finacial_report_array=array();
			foreach($all_date as $date)
			{
			 $details=$this->financial_report_model->financial_reports($date);	
			 $finacial_report_array[]=(object)$details;
			}
			$data['finacial_report_array']=$finacial_report_array;
			
			$data['start_date']=date('m/d/Y',strtotime($start_date));
			$data['end_date']=date('m/d/Y',strtotime($end_date));
			
		}*/
		//pr($data);
		_adminLayout("financial_report_mgmt/financial_report",$data);
	}//end method 
	public function export_multiple_payoutdata($finacial_report_array=null)  
	{  
	   header("Content-type: text/csv");   
	   header("Content-Disposition: attachment; filename=financial_report.csv");  
	   header("Pragma: no-cache");    
	   header("Expires: 0");     
	   $content = '';     
	   $title   = '';    
	   $ii      = 1;   
	   foreach ($finacial_report_array as $report)
	   {        
		   $content .= $ii . ",";   
		   $content .= $report->create_date . ",";     
		   $content .= $report->total_registered_user . ",";      
		   $content .= $report->package_sold_amount . ",";      
		   $content .= $report->total_paid_commission . ",";     
		   $content .= $report->payout_amount . ",";    
		   $content .= $report->profit . ",";     
		   $content .= "\n";      
		   $ii++;      
	   }       
	   $title .= "Sr.No ,Date,Total Registration,Total Package Sold,Total Commission,Total Paid Payout,Total Profit " . "\n";    
	   echo $title;      
	   echo $content;   
	   $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout request is approved successfully');  
	}
}//end class
