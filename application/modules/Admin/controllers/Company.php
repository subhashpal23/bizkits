<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Common_controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
    }

    public function index()
    {
        $data['company'] = $this->Company_model->get_company();
		_adminLayout("company_form",$data);
    }

    public function save()
    {
        $data = [
            'company_name' => $this->input->post('company_name'),
			'gst_number'   => $this->input->post('gst_number'),
            'email'        => $this->input->post('email'),
            'phone'        => $this->input->post('phone'),
            'address'      => $this->input->post('address')
        ];

        $this->Company_model->save_company($data);
		$this->session->set_flashdata(
			'success',
			'Company details saved successfully!'
		);
        redirect('Admin/company');
    }
}
