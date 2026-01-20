<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package Front/Front
*/
class Api extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('layout_helper');
		$this->load->helper("feeder_stage_nom_helper");
		$this->load->helper("registration_helper");
		$this->load->helper("commission_helper");
		$this->load->model('front_model');
		$this->load->model('user/account_model');
		$this->load->model('user/package_model');
		$this->load->model('user/ewallet_model');
		$this->load->model("auth_model","auth");
		header("Access-Control-Allow-Origin: http://localhost:3000");
		header("Access-Control-Allow-Origin: http://localhost:3456");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header('Content-Type: application/json');
	}
	
	public function index()
	{
	    
	}
	public function saveToken($userId, $token, $expiry)
    {
        $data = [
            'user_id' => $userId,
            'token' => $token,
            'expires_at' => $expiry
        ];
        $this->db->insert('tokens', $data);
    }

    public function getToken($token)
    {
        return $this->db->get_where('tokens', ['token' => $token])->row_array();
    }
    public function validateToken()
    {
        // Get token from the request header
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);

        // Validate the token
        $tokenData = $this->getToken($token);

        if ($tokenData) {
            if (strtotime($tokenData['expires_at']) > time()) {
                echo json_encode(['status' => 'success', 'message' => 'Token is valid']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Token has expired']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid token']);
        }
    }
    public function getUserData()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            $user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
    
            echo json_encode(['status' => 'success', 'data' => $user]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
    }
	public function registration()
	{
	    // Get the raw POST data
        $raw_data = file_get_contents("php://input");

        // Decode the JSON data
        $json_data = json_decode($raw_data, true); // Pass `true` to get an associative array
        //pr($json_data); exit;
        if ($json_data === null) {
            // Handle JSON decoding errors
            $response = [
                'status' => false,
                'message' => 'Invalid JSON payload'
            ];
            echo json_encode($response);
            return;
        }

        // Access individual JSON values
        $name = isset($json_data['name']) ? $json_data['name'] : null;
        $email = isset($json_data['email']) ? $json_data['email'] : null;

        // Process the data (example: save to database)
        if ($name && $email) {
            // check email is exists or not
            $count=$this->db->select('id')->from('consumer_user')->where(array('email'=>$json_data['email']))->get()->num_rows();
            if($count)
            {
                $response = [
                'status' => false,
                'message' => 'Email already exist'
                ];
            }
            else
            {
                // insert data in consumer_user
                $member_id=generateUserId();
                $json_data['member_id']=$member_id;
                $this->db->insert('consumer_user',$json_data);
                $user_id=$this->db->insert_id();
                $json_data['user_id']=$user_id;
                $response = [
                    'status' => true,
                    'message' => 'Data received successfully',
                    'data' => $json_data
                ];
                $email_data['from']='noreply@demosite.name';
                $email_data['to']=$email;
                $email_data['subject']=$email;
                $email_data['email-template']='verifymail';
                $email_data['user_id']=$user_id;
                $email_data['name']=$name;
                //$email_data['linkusrl']=base_url().'Web/verifyUser/'.ID_encode($user_id);
                //_sendEmail($email_data);
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Missing required fields'
            ];
        }

        // Return the response in JSON format
        echo json_encode($response);
    }
    
    public function sendmailtest($email)
    {
        
        $info=$this->db->select('*')->from('consumer_user')->where(array('email'=>$email))->get()->row();
        $email_data['from']='info@demosite.name';
                $email_data['to']=$email;
                $email_data['subject']='Registration Successful';
                $email_data['email-template']='verifymail';
                $email_data['user_id']=$info->id;
                $email_data['name']=$info->name;
                $email_data['linkusrl']=base_url().'Web/verifyUser/'.ID_encode($info->id);
                _sendEmail($email_data);
    }
    public function login()
	{
	    // Get the raw POST data
        $raw_data = file_get_contents("php://input");

        // Decode the JSON data
        $json_data = json_decode($raw_data, true); // Pass `true` to get an associative array
        //pr($json_data); exit;
        if ($json_data === null) {
            // Handle JSON decoding errors
            $response = [
                'status' => false,
                'message' => 'Invalid JSON payload'
            ];
            echo json_encode($response);
            return;
        }

        // Access individual JSON values
        $password = isset($json_data['password']) ? $json_data['password'] : null;
        $email = isset($json_data['email']) ? $json_data['email'] : null;
        $role_type = isset($json_data['role_type']) ? $json_data['role_type'] : null;

        // Process the data (example: save to database)
        if ($password && $email) {
            // check email is exists or not
            $count=$this->db->select('id')->from('consumer_user')->where(array('email'=>$json_data['email'],'password'=>$json_data['password'],'role_type'=>$role_type))->get()->num_rows();
            
            if($count)
            {
                $count1=$this->db->select('id')->from('consumer_user')->where(array('email'=>$json_data['email'],'password'=>$json_data['password'],'role_type'=>$role_type))->get()->num_rows();
                if($count1)
                {
                    $token = bin2hex(random_bytes(32));
                    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); 
                    
                    $info=$this->db->select('*')->from('consumer_user')->where(array('email'=>$json_data['email'],'password'=>$json_data['password'],'role_type'=>$role_type))->get()->row();
                    $this->saveToken($info->id, $token, $expiry);
                    //$manufacturing_process=$this->getManufacteringProcess();
                    //pr($manufacturing_process);
                    $response = [
                        'status' => true,
                        'message' => 'Login successfully',
                        'token' => $token,
                        'expires_at' => $expiry,
                        'data' => $info,
                    ];
                }
                else
                {
                    // insert data in consumer_user
                    $response = [
                    'status' => false,
                    'message' => 'Wrong email or password'
                    ];
                }
            }
            else
            {
                // insert data in consumer_user
                $response = [
                'status' => false,
                'message' => 'Please check your inbox and verify email'
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Missing required fields'
            ];
        }

        // Return the response in JSON format
        echo json_encode($response);
    }
    
    public function getManufacteringProcess()
    {
        $res=$this->db->select('*')->from('manufacturing_process')->order_by('name','asc')->get()->result();
        foreach($res as $key=>$val)
        {
            $result['id']=$val->id;
            $result['process_name']=$val->name;
            $result1[]=$result;
        }
        return $result1;
    }
    
    public function getMySuppliers()
    {
        $headers = $this->input->get_request_header('Authorization');
        $filename = "example.txt";

// Define the content to write to the file
$content = $headers."\n"; 

// Open the file in append mode or create it if it doesn't exist
$file = fopen($filename, "w");

// Check if the file is successfully opened
if ($file) {
    // Write the content to the file
    fwrite($file, $content);
    // Close the file after writing
    fclose($file);
    //echo "Text successfully added to the file: $filename";
} else {
    //echo "Error: Unable to open or create the file.";
}


        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            $sql="select id,name,company,company_type,email,phone_number,country_code,is_validated,marketing_consent,industry from consumer_user where id in (select supplier_id from consumer_supplier_map where consumer_id='".$userId."' and assign_type='rfq')";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => true,'message'=>'Show Suppliers', 'data' => $res]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    public function getMyCustomers()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            $sql="select * from consumer_user where id in (select consumer_id from consumer_supplier_map where supplier_id='".$userId."' and assign_type='rfq')";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    public function createRFQ()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
        //pr($tokenData); exit;
        
        $raw_data = file_get_contents("php://input");

        // Decode the JSON data
        $json_data = json_decode($raw_data, true); // Pass `true` to get an associative array
        //pr($json_data); exit;
        if ($json_data === null) {
            // Handle JSON decoding errors
            $response = [
                'status' => false,
                'message' => 'Invalid JSON payload'
            ];
            echo json_encode($response);
            return;
        }
        
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            

        // Access individual JSON values
        $name = isset($json_data['name']) ? $json_data['name'] : null;
        $email = isset($json_data['email']) ? $json_data['email'] : null;
        $country_code = isset($json_data['country_code']) ? $json_data['country_code'] : null;
        $mobile = isset($json_data['mobile']) ? $json_data['mobile'] : null;
        $company_name = isset($json_data['company_name']) ? $json_data['company_name'] : null;
        $manufacturing_process_id = isset($json_data['manufacturing_process_id']) ? $json_data['manufacturing_process_id'] : null;
        $is_design_file = isset($json_data['is_design_file']) ? $json_data['is_design_file'] : null;
        $comments = isset($json_data['comments']) ? $json_data['comments'] : null;
        $add_by = $userId;
        $add_date = date('Y-m-d');
        $status = 0;
        $rfq_code=$this->generateRFQCode();
        $insert_data=array(
            'rfq_code'=>$rfq_code,
            'name'=>$name,
            'email'=>$email,
            'country_code'=>$country_code,
            'mobile'=>$mobile,
            'company_name'=>$company_name,
            'manufacturing_process_id'=>$manufacturing_process_id,
            'is_design_file'=>$is_design_file,
            'comments'=>$comments,
            'add_by'=>$add_by,
            'add_date'=>$add_date
            );
            //pr($insert_data);
        $this->db->insert('rfq',$insert_data);
        $rfq_id=$this->db->insert_id();
        $sql="select * from rfq where id='".$rfq_id."'";
            $res=$this->db->query($sql)->row();
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    public function generateRFQCode()
    {
        $rfq_code='RFQ'.rand(1000000,9999999);
        $count=$this->db->select('*')->from('rfq')->where(array('rfq_code'=>$rfq_code))->get()->num_rows();
        if($count)
        {
            $this->generateRFQCode();
        }
        else
        {
            return $rfq_code;
        }
    }
    public function getCustomerRFQList()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            $sql="select * from rfq where add_by='".$userId."'";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    public function AllRFQList()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            $sql="select * from rfq order by id desc";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    public function AllSuppliers()
    {
        $headers = $this->input->get_request_header('Authorization');
        $filename = "example.txt";

        // Define the content to write to the file
        $content = $headers."\n";
        
        // Open the file in append mode or create it if it doesn't exist
        $file = fopen($filename, "w");
        
        // Check if the file is successfully opened
        if ($file) {
            // Write the content to the file
            fwrite($file, $content);
            // Close the file after writing
            fclose($file);
            //echo "Text successfully added to the file: $filename";
        } else {
            //echo "Error: Unable to open or create the file.";
        }


        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            $sql="select id,name,company,company_type,email,phone_number,country_code,is_validated,marketing_consent,industry from consumer_user where role_type='supplier'";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => true,'message'=>'Show Suppliers', 'data' => $res]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    public function AllCustomers()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            $sql="select * from consumer_user where role_type='consumer'";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    /************************ assign rfq to supplier by admin *******************/
    
    public function assignRFQ()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
        //pr($tokenData); exit;
        
        $raw_data = file_get_contents("php://input");

        // Decode the JSON data
        $json_data = json_decode($raw_data, true); // Pass `true` to get an associative array
        //pr($json_data); exit;
        if ($json_data === null) {
            // Handle JSON decoding errors
            $response = [
                'status' => false,
                'message' => 'Invalid JSON payload'
            ];
            echo json_encode($response);
            return;
        }
        
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            

        // Access individual JSON values
        $rfq_id = isset($json_data['rfq_id']) ? $json_data['rfq_id'] : null;
        $rfq_code = isset($json_data['rfq_code']) ? $json_data['rfq_code'] : null;
        $supplier_id = isset($json_data['supplier_id']) ? $json_data['supplier_id'] : null;
        $admin_id = isset($json_data['admin_id']) ? $json_data['admin_id'] : null;
        
        $add_by = $userId;
        $add_date = date('Y-m-d');
        $status = 1;
        foreach($supplier_id as $key=>$val)
        {
             $insert_data=array(
            'rfq_id'=>$rfq_id,
            'rfq_code'=>$rfq_code,
            'supplier_id'=>$val,
            'add_by'=>'admin',
            'add_by_id'=>$add_by,
            'assign_to'=>'supplier',
            'assign_date'=>$add_date,
            'assign_type'=>'rfq',
            
            'status'=>$status
            );
            //pr($insert_data);
            $this->db->insert('consumer_supplier_map',$insert_data);
            
        }
       
        $update_data=array(
            'assign_to'=>'supplier',
            'assign_by'=>'admin',
            'assign_by_id'=>$add_by,
            'assign_date'=>$add_date,
            'status'=>$status
            );
            $this->db->update('rfq',$update_data,array('id'=>$rfq_id));
            $sql="select * from rfq where id='".$rfq_id."'";
            $res=$this->db->query($sql)->row();
            echo json_encode(['status' => true,'message' => 'RQF '.$rfq_code.' assigned successfully', 'data' => $res]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    public function changeRFQStatus()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
        //pr($tokenData); exit;
        
        $raw_data = file_get_contents("php://input");

        // Decode the JSON data
        $json_data = json_decode($raw_data, true); // Pass `true` to get an associative array
        //pr($json_data); exit;
        if ($json_data === null) {
            // Handle JSON decoding errors
            $response = [
                'status' => false,
                'message' => 'Invalid JSON payload'
            ];
            echo json_encode($response);
            return;
        }
        
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            

        // Access individual JSON values
        $rfq_id = isset($json_data['rfq_id']) ? $json_data['rfq_id'] : null;
        $rfq_code = isset($json_data['rfq_code']) ? $json_data['rfq_code'] : null;
        $supplier_id = isset($userId) ? $userId : null;
        $dstatus = isset($json_data['status']) ? $json_data['status'] : null;
        
        if($dstatus=='accept')
        {
            $status=1;
            $s='Accepted';
        }
        else if($dstatus=='reject')
        {
            $status=2;
            $s='Rejected';
        }
        
        $add_by = $userId;
        $add_date = date('Y-m-d');
       
        
       
        $update_data=array(
            'supplier_status'=>$status,
            'status_date'=>$add_date
            );
            $this->db->update('consumer_supplier_map',$update_data,array('rfq_id'=>$rfq_id,'supplier_id'=>$supplier_id));
            
            echo json_encode(['status' => true,'message' => ''.$rfq_code.' '.$s.' successfully', 'data' => $json_data]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    /**************************/
    public function getSupplierRFQList($supplier_status=null)
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            //$sql="select r.* from consumer_supplier_map as m inner join rfq as r where m.supplier_id='".$userId."'";
            if($supplier_status!='')
            {
                $sql="select r.* from consumer_supplier_map as m inner join rfq as r on m.rfq_id=r.id where m.supplier_id='".$userId."' and supplier_status='".$supplier_status."'";
            }
            else
            {
                $sql="select r.* from consumer_supplier_map as m inner join rfq as r on m.rfq_id=r.id where m.supplier_id='".$userId."' and supplier_status is NULL";
            }
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    public function getSupplierAcceptedRFQList()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            //$sql="select r.* from consumer_supplier_map as m inner join rfq as r where m.supplier_id='".$userId."'";
            $sql="select r.* from consumer_supplier_map as m inner join rfq as r on m.rfq_id=r.id where m.supplier_id='".$userId."' and supplier_status=1";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    public function getSupplierRejectedRFQList()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            //$sql="select r.* from consumer_supplier_map as m inner join rfq as r where m.supplier_id='".$userId."'";
            $sql="select r.* from consumer_supplier_map as m inner join rfq as r on m.rfq_id=r.id where m.supplier_id='".$userId."' and supplier_status=2";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
	
	public function generateQuote()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
        //pr($tokenData); exit;
        
        $raw_data = file_get_contents("php://input");

        // Decode the JSON data
        $json_data = json_decode($raw_data, true); // Pass `true` to get an associative array
        //pr($json_data); exit;
        if ($json_data === null) {
            // Handle JSON decoding errors
            $response = [
                'status' => false,
                'message' => 'Invalid JSON payload'
            ];
            echo json_encode($response);
            return;
        }
        
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            

        // Access individual JSON values
        $rfq_id = isset($json_data['rfq_id']) ? $json_data['rfq_id'] : null;
        $rfq_code = isset($json_data['rfq_code']) ? $json_data['rfq_code'] : null;
        $supplier_id = isset($userId) ? $userId : null;
        $total_cost = isset($json_data['total_cost']) ? $json_data['total_cost'] : null;
        $valid_till = isset($json_data['valid_till']) ? $json_data['valid_till'] : null;
        $duration = isset($json_data['duration']) ? $json_data['duration'] : null;
        $addcomument = isset($json_data['addcomument']) ? $json_data['addcomument'] : null;
        $payment_term = isset($json_data['payment_term']) ? $json_data['payment_term'] : null;
        $part_details = isset($json_data['part_details']) ? $json_data['part_details'] : null;
        
        
        $add_by = $userId;
        $add_date = date('Y-m-d');
        $status = 2;
        
             $insert_data=array(
            'rfq_id'=>$rfq_id,
            'rfq_code'=>$rfq_code,
            'supplier_id'=>$userId,
            'add_by'=>$userId,
            'add_date'=>$add_date,
            'total_cost'=>$total_cost,
            'valid_till'=>$valid_till,
            'duration'=>$duration,
            'payment_term'=>$payment_term,
            'addcomument'=>$addcomument,
            'part_details'=>$part_details,
            );
            //pr($insert_data);
            $this->db->insert('supplier_quotes',$insert_data);
            $quote_id=$this->db->insert_id();
       
       
        $update_data=array(
            'assign_to'=>'admin',
            'assign_type'=>'quote',
            'assign_date'=>$add_date,
            'status'=>$status,
            'quote_id'=>$quote_id
            );
            $this->db->update('consumer_supplier_map',$update_data,array('rfq_id'=>$rfq_id,'supplier_id'=>$userId));
            $sql="select * from supplier_quotes where id='".$quote_id."'";
            $res=$this->db->query($sql)->row();
            echo json_encode(['status' => true,'message' => 'Quote created successfully', 'data' => $res]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    public function getSupplierQuoteList()
    {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            // Token is valid, return user data
            $userId = $tokenData['user_id'];
            //$user = $this->db->get_where('consumer_user', ['id' => $userId])->row_array();
            //$sql="select r.* from consumer_supplier_map as m inner join rfq as r where m.supplier_id='".$userId."'";
            $sql="select * from supplier_quotes where supplier_id='".$userId."'";
            $res=$this->db->query($sql)->result();
            /*foreach($res as $key=>$val)
            {
                $result['id']=$val->id;
                $result['process_name']=$val->name;
                $result1[]=$result;
            }*/
            echo json_encode(['status' => 'success', 'data' => $res]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
        return $result1;
    }
    
    /******************************bus list*************************/
    public function getBusList($source_route,$destination_route)
    {
        $sql="select * from buses where source_route='".$source_route."' and destination_route='".$destination_route."'";
        $res=$this->db->query($sql)->result();
        
        echo json_encode(['status' => 'success', 'data' => $res]);
    }
    public function getBusDetail($bus_number)
    {
        $sql="select * from buses where bus_number='".$bus_number."' ";
        $res=$this->db->query($sql)->row();
        
        echo json_encode(['status' => 'success', 'data' => $res]);
    }
     // 1. Search Buses
    public function search() {
        $postData = json_decode(file_get_contents("php://input"), true);
        if (!isset($postData['source']) || !isset($postData['destination']) || !isset($postData['date'])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
            return;
        }

        $source = $postData['source'];
        $destination = $postData['destination'];
        $date = $postData['date'];

        $query = $this->db->query("
            SELECT b.bus_id, b.bus_name, 
                (b.total_seats - COALESCE(SUM(CASE WHEN bk.booking_status = 'confirmed' THEN 1 ELSE 0 END), 0)) AS available_seats,
                CASE 
                    WHEN (b.total_seats - COALESCE(SUM(CASE WHEN bk.booking_status = 'confirmed' THEN 1 ELSE 0 END), 0)) > 0 
                    THEN 'active' ELSE 'closed' 
                END AS booking_status
            FROM ticket_buses b
            JOIN ticket_schedules s ON b.bus_id = s.bus_id
            LEFT JOIN ticket_bookings bk ON s.schedule_id = bk.schedule_id
            WHERE s.route_id IN (SELECT route_id FROM ticket_routes WHERE source = ? AND destination = ?)
            AND DATE(s.departure_time) = ?
            GROUP BY b.bus_id
        ", array($source, $destination, $date));

        echo json_encode(['status' => 'success', 'data' => $query->result()]);
    }

    // 2. Seat Details
    public function seat_details($bus_id) {
        
        if (!$bus_id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid bus ID']);
            return;
        }

        $query = $this->db->query("
            SELECT seat_no, status FROM ticket_seats WHERE bus_id = ?
        ", array($bus_id));

        echo json_encode(['status' => 'success', 'data' => $query->result()]);
    }

    // 3. Get Current Bookings
    public function current_bookings() {
        $postData = json_decode(file_get_contents("php://input"), true);
        if (!isset($postData['latitude']) || !isset($postData['longitude']) || !isset($postData['time'])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
            return;
        }

        $latitude = $postData['latitude'];
        $longitude = $postData['longitude'];
        $time = $postData['time'];

        $query = $this->db->query("
            SELECT b.bus_id, b.bus_name, lt.latitude, lt.longitude, lt.next_stop, lt.eta
            FROM ticket_live_tracking lt
            JOIN ticket_buses b ON lt.bus_id = b.bus_id
            WHERE TIMESTAMPDIFF(MINUTE, ?, lt.eta) BETWEEN -30 AND 30
        ", array($time));

        echo json_encode(['status' => 'success', 'data' => $query->result()]);
    }

    // 4. Get Bus Full Details
    public function bus_details($bus_id) {
        if (!$bus_id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid bus ID']);
            return;
        }

        $query = $this->db->query("
            SELECT b.bus_id, b.bus_name, r.source, r.destination, lt.latitude, lt.longitude 
            FROM ticket_buses b
            JOIN ticket_schedules s ON b.bus_id = s.bus_id
            JOIN ticket_routes r ON s.route_id = r.route_id
            LEFT JOIN ticket_live_tracking lt ON b.bus_id = lt.bus_id
            WHERE b.bus_id = ?
        ", array($bus_id));

        $seats = $this->db->query("
            SELECT seat_no, status FROM ticket_seats WHERE bus_id = ?
        ", array($bus_id))->result();

        $result = $query->row();
        if ($result) {
            $result->seats = $seats;
            echo json_encode(['status' => 'success', 'data' => $result]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Bus not found']);
        }
    }

    // 5. Book Ticket
    public function book_ticket() {
        $headers = $this->input->get_request_header('Authorization');
        $token = str_replace('Bearer ', '', $headers);
    
        $tokenData = $this->getToken($token);
    
        if ($tokenData && strtotime($tokenData['expires_at']) > time()) {
            $userId = $tokenData['user_id'];
            $postData = json_decode(file_get_contents("php://input"), true);
            if (!isset($postData['schedule_id']) || !isset($postData['seat_id'])) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
                return;
            }
    
            $data = [
                'user_id' => $userId,
                'schedule_id' => $postData['schedule_id'],
                'seat_id' => $postData['seat_id'],
                'booking_status' => 'pending'
            ];
            $this->db->insert('ticket_bookings', $data);
    
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'booking_id' => $this->db->insert_id()]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Booking failed']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
        
    }
}//end class
