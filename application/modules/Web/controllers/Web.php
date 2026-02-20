<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

/*
@package Front/Front
*/
class Web extends Common_Controller
{
    public function __construct()
    {
        //@call to parent CI_Controller constructor
        parent::__construct();
        session_start();
        $this->load->library('session');
        $this->load->helper('layout_helper');
        //$this->load->helper("feeder_stage_nom_helper");
        $this->load->helper('registration_helper');
        $this->load->helper('commission_helper');
        $this->load->model('front_model');
        $this->load->model('user/account_model');
        $this->load->model('user/package_model');
        $this->load->model('user/ewallet_model');
        $this->load->model('auth_model', 'auth');
        $this->load->model('member_model');
        $this->load->model('message_panel_model');
    }

    public function inbox()
    {
        $data=array();
        $login_user_id=$this->session->userdata('user_id');
        $data['all_inbox_msg']=$this->message_panel_model->getAllInboxMessage($login_user_id);
        _adminLayout("web-mgmt/inbox",$data);
    }
    function deleteInboxMessage($id)
    {
        $id=ID_decode($id);
        $this->db->delete("message",array('id'=>$id));
        $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is deleted successfully.');
        redirect(ci_site_url() . "admin/MessagePanel/inbox");
        exit;
    }
    function generateMessageId()
    {
        $random_number="M".mt_rand(100000, 999999);
        if($this->db->select('message_id')->from('message')->where('message_id',$random_number)->get()->num_rows()>0)
        {
          $this->generateMessageId();
        }
        return $random_number;
    }//end function
    public function composeMessage()
    {
        $login_user_id=$this->session->userdata('user_id');
        $login_user_name=$this->session->userdata('username');
        if(!empty($this->input->post("btn")))
        {
            $all_users=$this->input->post('users');
            //pr($all_users);
            $subject=$this->input->post('subject');
            $message=$this->input->post('message');
            $message_id=$this->generateMessageId();
            $attachment='';
            if(!empty($_FILES['attachment']))
            {
                $image_upload_path='/uploads/images/';
                $attachment=adImageUpload($_FILES['attachment'],1, $image_upload_path);
            }
            ////////////////////////////////
            foreach($all_users as $user_id)
            {
                $compose_to[]=array(
                    'message_id'=>$message_id,
                    'user_id'=>$user_id,
                    'subject'=>$subject,
                    'message'=>$message,
                    'reciever_id'=>$user_id,
                    'sender_id'=>$login_user_id,
                    'reciever_name'=>get_user_name($user_id),
                    'sender_name'=>$login_user_name,
                    'attachment'=>$attachment
                    );
            }
            $this->db->insert_batch("message",$compose_to);
            $this->db->insert("message",array(
                    'message_id'=>$message_id,
                    'user_id'=>$login_user_id,
                    'subject'=>$subject,
                    'message'=>$message,
                    'sender_id'=>$login_user_id,
                    'sender_name'=>$login_user_name,
                    'attachment'=>$attachment
                    ));
            $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is sent successfully');
            // stay on combined Messages page; open Sent tab after send
            redirect(ci_site_url() . "Web/composeMessage?tab=sent");
            exit;
        }
        $data=array();
        $data['all_active_members']=$this->db
		->select('u.*')
		->from('user_registration as u')
		->group_by('u.username')
		->order_by('u.id', 'ASC')
		->get()->result();
		// print_r($data['all_active_members']);exit;
        // NEW: for tabbed Messages page
        $data['all_inbox_msg'] = $this->message_panel_model->getAllInboxMessage($login_user_id);
        $data['all_sent_msg']  = $this->message_panel_model->getAllSentMessage($login_user_id);
		$data['all_inbox_msg']=$this->message_panel_model->getAllInboxMessage($login_user_id);
// print_r($data['all_sent_msg']);exit;

        _adminLayout("web-mgmt/compose-message",$data);
    }//end method
    public function sentMessage()
    {
        $user_id=$this->session->userdata('user_id');
        $data=array();
        $data['all_sent_msg']=$this->message_panel_model->getAllSentMessage($user_id);
        _adminLayout("web-mgmt/sent-message",$data);
    }
    function deleteSentMessage($id)
    {
        $id=ID_decode($id);
        $this->db->delete("message",array('id'=>$id));
        $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is deleted successfully.');
        redirect(ci_site_url() . "Web/composeMessage?tab=sent");
        exit;
    }
    public function readMessage($message_id=null)
    {
        $message_id=(!empty($message_id))?$message_id:$this->input->post('msg_id');
        $id=ID_decode($message_id);
        sleep(1);
        $msg=$this->db->select('m.*')->from('message as m')->where('id',$id)->get()->row();
        $this->output->set_content_type('application/json')->set_output(json_encode($msg));
    }
    public function checknom()
    {
        $upliner_id = '1932746';
        $leg_posi = '';
        if ($upliner_id != '') {
            $sponser_id123 = $upliner_id;
        } else {
            $sponser_id123 = $sponser_id;
        }
        getBinaryNom($sponser_id123, $leg_posi);
        $nom_id = $_SESSION['nom_id'];
        $nom_id1 = $nom_id;
        $nom_id2 = $nom_id;
        $leg_posi = $_SESSION['nom_leg_position'];
        unset($_SESSION['nom_id']);
        unset($_SESSION['nom_leg_position']);
        echo $nom_id;
    }

    public function checksponsorwalletdeduction()
    {
        echo '<table border=1 cellspacing=2 cellpadding=2><thead><tr><th>S.No.</th><th>User ID</th><th>Username</th><th>Ref ID</th><th>Ref Name</th><th>Amount</th><th>Wallet Amount</th><th>Status</th></tr></thead>';
        echo '<tbody>';
        $result = $this->db
            ->select('*')
            ->from('user_registration')
            ->where(['auto_registration_date >=' => '2024-06-13 00:00:00'])
            ->get()
            ->result();
        $sn = 1;
        foreach ($result as $key => $val) {
            $cc = $this->db
                ->select('*')
                ->from('credit_debit_product')
                ->where(['user_id' => $val->ref_id, 'receiver_id' => $val->user_id, 'reason' => '10'])
                ->get()
                ->num_rows();
            if ($cc) {
                // $query_obj=$this->db->select('amount')->from('final_product_wallet')->where(array('user_id'=>$sponser_id))->get()->row();
                //echo $val->user_id."==".$val->ref_id."==".$va->pkg_amount."== Amount Deducted"; echo "<br>";
                //echo "<tr><td>".$sn."</td><td>".$val->user_id."</td><td>".get_user_name($val->user_id)."</td><td>".$val->ref_id."</td><td>".get_user_name($val->ref_id)."</td><td>".$val->pkg_amount."</td><td>".$query_obj->amount."</td><td> Amount Deducted</td><tr>";
            } else {
                $sponser_id = $val->ref_id;
                $pkg_amount = $val->pkg_amount;
                $user_id = $val->user_id;
                $query_obj = $this->db
                    ->select('amount')
                    ->from('final_product_wallet')
                    ->where(['user_id' => $sponser_id])
                    ->get()
                    ->row();
                if ($query_obj->amount > 0) {
                    echo '<tr><td>' . $sn . '</td><td>' . $val->user_id . '</td><td>' . get_user_name($val->user_id) . '</td><td>' . $val->ref_id . '</td><td>' . get_user_name($val->ref_id) . '</td><td>' . $val->pkg_amount . '</td><td>' . $query_obj->amount . '</td><td> Amount Not Deducted</td><tr>';

                    $sn++;

                    $query_obj = $this->db
                        ->select('amount')
                        ->from('final_product_wallet')
                        ->where(['user_id' => $sponser_id])
                        ->get()
                        ->row();
                    $balance = $query_obj->amount - $pkg_amount;
                    $this->db->update('final_product_wallet', ['amount' => $balance], ['user_id' => $sponser_id]);
                    $this->db->insert('credit_debit_product', [
                        'transaction_no' => generateUniqueTranNo(),
                        'user_id' => $sponser_id,
                        'credit_amt' => '0',
                        'debit_amt' => $pkg_amount,
                        'balance' => $balance,
                        'receiver_id' => $user_id,
                        'sender_id' => $sponser_id,
                        'receive_date' => date('Y-m-d'),
                        'ttype' => 'Package Purchased',
                        'TranDescription' => 'Package Purchase by ' . $user_id,
                        'Cause' => 'Package Purchase by ' . $user_id,
                        'Remark' => 'Package Purchase by ' . $user_id,
                        'product_name' => 'main',
                        'deposit_id' => 1,
                        'status' => '0',
                        'ewallet_used_by' => 'Withdrawal Wallet',
                        'current_url' => ci_site_url(),
                        'reason' => '10',
                    ]);
                } else {
                    $query_obj = $this->db
                        ->select('amount')
                        ->from('final_product_wallet')
                        ->where(['user_id' => $sponser_id])
                        ->get()
                        ->row();
                    echo '<tr><td>' . $sn . '</td><td>' . $val->user_id . '</td><td>' . get_user_name($val->user_id) . '</td><td>' . $val->ref_id . '</td><td>' . get_user_name($val->ref_id) . '</td><td>' . $val->pkg_amount . '</td><td>' . $query_obj->amount . '</td><td> Amount Not Deducted</td><tr>';

                    // check sponsor last transaction
                    $query_obj = $this->db
                        ->select('*')
                        ->from('credit_debit_product')
                        ->where(['user_id' => $sponser_id])
                        ->order_by('id', 'desc')
                        ->limit(1)
                        ->get()
                        ->row();
                    echo '<tr><td>Detail ' . $sn . '</td><td>' . $query_obj->user_id . '</td><td>' . get_user_name($query_obj->user_id) . '</td><td>' . $query_obj->receiver_id . '</td><td>' . get_user_name($val->receiver_id) . '</td><td>' . $val->credit_amt . '</td><td>' . $query_obj->debit_amt . '</td><td>' . $query_obj->balance . '--' . $query_obj->ttype . '</td><tr>';

                    $query_obj = $this->db
                        ->select('*')
                        ->from('credit_debit_product')
                        ->where(['user_id' => $query_obj->receiver_id])
                        ->order_by('id', 'desc')
                        ->limit(1)
                        ->get()
                        ->row();
                    echo '<tr><td>Detail Level2 ' . $sn . '</td><td>' . $query_obj->user_id . '</td><td>' . get_user_name($query_obj->user_id) . '</td><td>' . $query_obj->receiver_id . '</td><td>' . get_user_name($val->receiver_id) . '</td><td>' . $val->credit_amt . '</td><td>' . $query_obj->debit_amt . '</td><td>' . $query_obj->balance . '--' . $query_obj->ttype . '</td><tr>';

                    $query_obj = $this->db
                        ->select('*')
                        ->from('credit_debit_product')
                        ->where(['user_id' => $query_obj->receiver_id])
                        ->order_by('id', 'desc')
                        ->limit(1)
                        ->get()
                        ->row();
                    echo '<tr><td>Detail Level3 ' . $sn . '</td><td>' . $query_obj->user_id . '</td><td>' . get_user_name($query_obj->user_id) . '</td><td>' . $query_obj->receiver_id . '</td><td>' . get_user_name($val->receiver_id) . '</td><td>' . $val->credit_amt . '</td><td>' . $query_obj->debit_amt . '</td><td>' . $query_obj->balance . '--' . $query_obj->ttype . '</td><tr>';

                    $query_obj = $this->db
                        ->select('*')
                        ->from('credit_debit_product')
                        ->where(['user_id' => $query_obj->receiver_id])
                        ->order_by('id', 'desc')
                        ->limit(1)
                        ->get()
                        ->row();
                    echo '<tr><td>Detail Level4 ' . $sn . '</td><td>' . $query_obj->user_id . '</td><td>' . get_user_name($query_obj->user_id) . '</td><td>' . $query_obj->receiver_id . '</td><td>' . get_user_name($val->receiver_id) . '</td><td>' . $val->credit_amt . '</td><td>' . $query_obj->debit_amt . '</td><td>' . $query_obj->balance . '--' . $query_obj->ttype . '</td><tr>';

                    $sn++;
                }
            }
        }
        echo '</tbody><table>';
    }
    public function amountdeductedofregistration()
    {
        $sponser_id = 8493916;
        $user_id = 9167966;
        $pkg_amount = 60000;
        $query_obj = $this->db
            ->select('amount')
            ->from('final_product_wallet')
            ->where(['user_id' => $sponser_id])
            ->get()
            ->row();
        $balance = $query_obj->amount - $pkg_amount;
        $this->db->update('final_product_wallet', ['amount' => $balance], ['user_id' => $sponser_id]);
        $this->db->insert('credit_debit_product', [
            'transaction_no' => generateUniqueTranNo(),
            'user_id' => $sponser_id,
            'credit_amt' => '0',
            'debit_amt' => $pkg_amount,
            'balance' => $balance,
            'receiver_id' => $user_id,
            'sender_id' => $sponser_id,
            'receive_date' => date('Y-m-d'),
            'ttype' => 'Package Purchased',
            'TranDescription' => 'Package Purchase by ' . $user_id,
            'Cause' => 'Package Purchase by ' . $user_id,
            'Remark' => 'Package Purchase by ' . $user_id,
            'product_name' => 'main',
            'deposit_id' => 1,
            'status' => '0',
            'ewallet_used_by' => 'Withdrawal Wallet',
            'current_url' => ci_site_url(),
            'reason' => '10',
        ]);
    }
    public function matchingbonusfasahua()
    {
        $date = date('d-m-Y');
        $res = $this->db->query("select * from user_registration where aadharno<>'matching' and registration_date='" . $date . "'")->result();
        //pr($res); exit;
        foreach ($res as $key => $val) {
            $this->db->update('user_registration', ['aadharno' => 'matching'], ['user_id' => $val->user_id]);
            creditBinaryLevelCommission($val->user_id);
        }
        //
    }
    public function matchpv()
    {
        $list = $this->db->select('*')->from('matrix_downline_pv')->get()->result();
        foreach ($list as $ley => $val) {
            echo $val->down_id . '==' . $val->income_id . '==' . $val->leg . '==' . $val->status . '==' . $val->type;
            echo '<br>';
        }
    }
    public function showStockistStateWise($state)
    {
        $state = urldecode($state);
        $aa = $this->db
            ->select('*')
            ->from('user_stockist')
            ->where(['state' => $state])
            ->get()
            ->result();
        //pr($aa);
        $str = "<option value=''>Select Stockist</option>";
        foreach ($aa as $key => $val) {
            // check stockist active or not
            $a = $this->db
                ->select('*')
                ->from('user_registration')
                ->where(['user_id' => $val->user_id, 'member_type' => '2'])
                ->get()
                ->num_rows();
            //echo $a;
            if ($a) {
                $str .= "<option value='" . $val->user_id . "'>" . $val->name . '(' . $val->state . ')</option>';
            }
        }
        echo $str;
    }
    public function showStockist($id)
    {
        $aa = $this->db
            ->select('*')
            ->from('user_stockist')
            ->where(['user_id' => $id])
            ->get()
            ->row();
        //pr($aa);
        $this->session->set_userdata('stockist_id', $id);
        $str = "<div style='color:green'><strong>Store Name : </strong>" . $aa->name . '<br>';
        $str .= '<strong>Store Address : </strong>' . $aa->address . '<br>' . $aa->city . ',' . $aa->state . ',' . $aa->country . '<br>';
        $str .= '<strong>Store Contact No : </strong>' . $aa->contact_no . '<br></div>';
        echo $str;
    }
    public function show_fast_start_bonus()
    {
        fast_start_bonus('123456');
    }

    public function runbinarycommission()
    {
        creditBinaryLevelCommission('1981956');
    }
    public function checkbinarycommission()
    {
        $all_user_query = $this->db
            ->select('*')
            ->from('user_registration')
            ->where(['user_id' => '9970656', 'nom_id !=' => '', 'active_status' => '1'])
            ->get();

        $date = date('Y-m-d');
        $current_timestamp = date('Y-m-d H:i:s');
        $creditStatus = 0;
        $manage_bv_history = [];
        if ($all_user_query->num_rows() > 0) {
            //echo $this->db->last_query();
            //echo "syubhahsj";
            foreach ($all_user_query->result() as $userObj) {
                $user_id = $userObj->user_id;
                $pkg_id = $userObj->pkg_id;
                if ($pkg_id > 1) {
                    $matchingcondleft = $this->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='" . $user_id . "' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='" . $user_id . "' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='" . $user_id . "' and leg='left') and ref_id='" . $user_id . "'")->num_rows();
                    $matchingcondright = $this->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='" . $user_id . "' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='" . $user_id . "' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='" . $user_id . "' and leg='right') and ref_id='" . $user_id . "'")->num_rows();

                    $commission_details = getBinaryPairingCommission($user_id, $pkg_id);
                    echo $matchingcondleft;
                    echo '<br>';
                    echo $matchingcondright;
                    pr($commission_details);
                }
            }
        }
    }
    public function leaderpool()
    {
        $date1 = date('Y-m-d 00:00:00');
        $date = date('Y-m-d 23:59:59', strtotime('- 1 month', strtotime($date1)));
        $userlist = $this->db
            ->select_sum('pv')
            ->from('matrix_direct_pv')
            ->where(['l_date >=' => $date, 'l_date <=' => $date1])
            ->get()
            ->row();
        $share_amount = (($userlist->pv * 7) / 100) * 500;
        echo $share_amount;
        echo '<br>';
        $userlist = $this->db
            ->select('*')
            ->from('rank')
            ->where(['leaderpool >' => '0'])
            ->get()
            ->result();
        foreach ($userlist as $key => $val) {
            echo $val->id;
            echo '<br>';
            $rank_id = $val->id;
            $rank_name = $val->rank_name;
            $users = $this->db
                ->select('*')
                ->from('user_registration')
                ->where(['rank_id' => $val->id])
                ->get()
                ->result();
            if (count($users) > 0) {
                $count = count($users);
                $bonus_amount = $share_amount / $count;
                foreach ($users as $keyu => $valu) {
                    $query_obj = $this->db->select('amount')->from('final_e_wallet')->where('user_id', $valu->user_id)->get()->row();
                    $balance = $query_obj->amount + $bonus_amount;
                    $this->db->update('final_e_wallet', ['amount' => $balance], ['user_id' => $valu->user_id]);
                    $this->db->insert('credit_debit', [
                        'transaction_no' => generateUniqueTranNo(),
                        'user_id' => $valu->user_id,
                        'credit_amt' => $bonus_amount,
                        'debit_amt' => '0',
                        'balance' => $balance,
                        'receiver_id' => $valu->user_id,
                        'sender_id' => $valu->user_id,
                        'receive_date' => date('Y-m-d'),
                        'ttype' => 'Leadership Pool Bonus',
                        'TranDescription' => 'Leadership Pool Bonus',
                        'Cause' => 'Leadership Pool Bonus',
                        'Remark' => 'Leadership Pool Bonus',
                        'invoice_no' => '',
                        'product_name' => 'main',
                        'deposit_id' => '1',
                        'status' => '1',
                        'rank_id' => $rank_id,
                        'rank_name' => $rank_name,
                        'ewallet_used_by' => 'Withdrawal Wallet',
                        'current_url' => site_url(),
                        'reason' => '14', //credit for matrix commission
                    ]);
                }
            }
        }
    }
    public function getrankupdate()
    {
        $userlist = $this->db
            ->select('*')
            ->from('user_registration')
            ->where(['active_status' => '1'])
            ->get()
            ->result();
        //pr($userlist);exit;
        foreach ($userlist as $key => $val) {
            //check total pv
            //$pvinfo=$this->db->select_sum('pv')->from('matrix_downline_pv')->where(array('income_id'=>$val->user_id,'type in '=>'register,upgrade''leg'=>'Left'))->get()->row();
            $pvinfo = $this->db->query("select sum(pv) as pv from matrix_downline_pv where income_id='" . $val->user_id . "' and leg='Left' and type in ('register','upgrade')")->row();
            $leftamt = $pvinfo->pv ? $pvinfo->pv : 0;
            //$pvinfo=$this->db->select_sum('pv')->from('matrix_downline_pv')->where(array('income_id'=>$val->user_id,'type in '=>'register,upgrade' and 'leg'=>'Right'))->get()->row();
            $pvinfo = $this->db->query("select sum(pv) as pv from matrix_downline_pv where income_id='" . $val->user_id . "' and leg='Right' and type in ('register','upgrade')")->row();
            $rightamt = $pvinfo->pv ? $pvinfo->pv : 0;
            //echo $leftamt.'=='.$rightamt; exit;
            if ($leftamt < $rightamt) {
                $lesser_bv = $leftamt;
                $carry_amount = $rightamt - $leftamt;
                $carry_pos = 'right';
                $total_pair = ($lesser_bv - ($lesser_bv % 28)) / 28;
            } elseif ($rightamt < $leftamt) {
                $lesser_bv = $rightamt;
                $carry_amount = $leftamt - $rightamt;
                $carry_pos = 'left';
                $total_pair = ($lesser_bv - ($lesser_bv % 28)) / 28;
            } elseif ($leftamt == $rightamt) {
                $lesser_bv = $rightamt;
                $carry_amount = 0;
                $carry_pos = null;
                $total_pair = ($lesser_bv - ($lesser_bv % 28)) / 28;
            }

            //echo $val->rank_id; echo "<br>";
            $sql = "SELECT * FROM `rank` WHERE   `team_member` BETWEEN direct_member and $lesser_bv order by id desc limit 1;";
            $rankinfo = $this->db->query($sql)->row();
            echo $this->db->last_query();
            echo '<br>'; //exit;
            $rank_id = $rankinfo->id;
            $rank_name = $rankinfo->rank_name;
            $bonus_amount = $rankinfo->bonus_amount;
            echo $val->rank_id . '==' . $rank_id . '==' . $rank_name . '==' . $bonus_amount . '==' . $lesser_bv;
            echo '<br>';
            if ($val->rank_id) {
                // get
                if ($rank_id && $rank_id > $val->rank_id) {
                    $countcheckrank = $this->db
                        ->select('id')
                        ->from('rank_bonus')
                        ->where(['user_id' => $val->user_id, 'rank_id' => $val->rank_id, 'nextrank_id' => $rank_id])
                        ->get()
                        ->num_rows();
                    if (!$countcheckrank) {
                        $user_id = $val->user_id;
                        $checnrank = $rank_id - 1;
                        echo 'Subhash User ID : ' . $val->user_id . '== Lessar PV: ' . $lesser_bv . '--' . $matchingcondleft . '==' . $matchingcondright . '==Rank ID:' . $rank_id;
                        echo '<br>';
                        $matchingcond = $this->db->query("SELECT d.id,u.user_id,u.username,rank_id,rank_name FROM `direct_matrix_downline` as d inner join user_registration as u on d.down_id=u.user_id where income_id='" . $user_id . "' and rank_id='" . $checnrank . "'")->num_rows();

                        /*$matchingcondleft=$this->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='Left') and ref_id='".$user_id."'")->num_rows();
            $matchingcondright=$this->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='Right') and ref_id='".$user_id."'")->num_rows();
            echo $matchingcondleft."==".$matchingcondright;
            if($matchingcondleft>=1 && $matchingcondright>=1)
            {
            
            // check if rank>1 and package should be empire
            
            $matchingcondleftinfo=$this->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='Left') and ref_id='".$user_id."'")->row();
            $matchingcondrightinfo=$this->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='Right') and ref_id='".$user_id."'")->row();
            $checkflag=false;
            pr($matchingcondleftinfo);
            pr($matchingcondrightinfo);
            $countuser=$this->db->select('id')->from('user_registration')->where(array('user_id'=>$matchingcondleftinfo->user_id,'rank_id >='=>$checnrank))->get()->num_rows();
            $countuser1=$this->db->select('id')->from('user_registration')->where(array('user_id'=>$matchingcondrightinfo->user_id,'rank_id >='=>$checnrank))->get()->num_rows();
            echo $countuser && $countuser1; echo "<br>";*/
                        if ($matchingcond) {
                            if ($val->pkg_id == 6) {
                                $status = 1;
                                $this->db->insert('rank_log', [
                                    'user_id' => $val->user_id,
                                    'rank_id' => $rank_id,
                                    'rank_name' => $rank_name,
                                    'updated_date' => date('Y-m-d H:i:s'),
                                ]);
                                $this->db->update(
                                    'user_registration',
                                    [
                                        'rank_id' => $rank_id,
                                        'rank_name' => $rank_name,
                                    ],
                                    ['user_id' => $val->user_id],
                                );

                                $query_obj = $this->db->select('amount')->from('final_reward_wallet')->where('user_id', $val->user_id)->get()->row();
                                $balance = $query_obj->amount + $bonus_amount;
                                $this->db->update('final_reward_wallet', ['amount' => $balance], ['user_id' => $val->user_id]);
                                $this->db->insert('credit_debit_reward', [
                                    'transaction_no' => generateUniqueTranNo(),
                                    'user_id' => $val->user_id,
                                    'credit_amt' => $bonus_amount,
                                    'debit_amt' => '0',
                                    'balance' => $balance,
                                    'receiver_id' => $val->user_id,
                                    'sender_id' => $val->user_id,
                                    'receive_date' => date('Y-m-d'),
                                    'ttype' => 'Rank Bonus',
                                    'TranDescription' => 'Rank Bonus from rank ' . $rank_name,
                                    'Cause' => 'Rank Bonus from rank ' . $rank_name,
                                    'Remark' => 'Rank Bonus from rank ' . $rank_name,
                                    'invoice_no' => '',
                                    'product_name' => 'main',
                                    'deposit_id' => '1',
                                    'status' => '1',
                                    'rank_id' => $rank_id,
                                    'rank_name' => $rank_name,
                                    'ewallet_used_by' => 'Withdrawal Wallet',
                                    'current_url' => site_url(),
                                    'reason' => '13', //credit for matrix commission
                                ]);
                            } else {
                                $status = 0;
                            }
                            $this->db->insert('rank_bonus', [
                                'user_id' => $val->user_id,
                                'bonus' => $bonus_amount,
                                'bonus_date' => date('Y-m-d'),
                                'status' => $status,
                                'nextrank_id' => $rank_id,
                                'rank_id' => $val->rank_id ? $val->rank_id : 0,
                            ]);
                        }
                        /*}*/
                    }
                }
            } else {
                echo 'User ID : ' . $val->user_id . '== Rank _name: ' . $val->rank_name . '== Lessar PV: ' . $lesser_bv;
                echo '<br>';
                // update rank and in rank log

                echo $val->user_id . '--' . $lesser_bv . '==' . $lesser_bv . '##' . $rank_id . '--' . $rank_name;
                echo '<br>';
                if ($rank_id && $rank_id > $val->rank_id) {
                    $countcheckrank = $this->db
                        ->select('id')
                        ->from('rank_bonus')
                        ->where(['user_id' => $val->user_id, 'rank_id' => $val->rank_id, 'nextrank_id' => $rank_id])
                        ->get()
                        ->num_rows();
                    //echo $this->db->last_query(); echo "<br>"; //exit;
                    echo $countcheckrank;
                    if (!$countcheckrank) {
                        if ($val->pkg_id == 6) {
                            $this->db->insert('rank_log', [
                                'user_id' => $val->user_id,
                                'rank_id' => $rank_id,
                                'rank_name' => $rank_name,
                                'updated_date' => date('Y-m-d H:i:s'),
                            ]);

                            $this->db->update(
                                'user_registration',
                                [
                                    'rank_id' => $rank_id,
                                    'rank_name' => $rank_name,
                                ],
                                ['user_id' => $val->user_id],
                            );

                            $this->db->insert('rank_bonus', [
                                'user_id' => $val->user_id,
                                'bonus' => $bonus_amount,
                                'bonus_date' => date('Y-m-d'),
                                'status' => '1',
                                'nextrank_id' => $rank_id,
                                'rank_id' => $val->rank_id ? $val->rank_id : 0,
                            ]);

                            $query_obj = $this->db->select('amount')->from('final_reward_wallet')->where('user_id', $val->user_id)->get()->row();
                            $balance = $query_obj->amount + $bonus_amount;
                            $this->db->update('final_reward_wallet', ['amount' => $balance], ['user_id' => $val->user_id]);
                            $this->db->insert('credit_debit_reward', [
                                'transaction_no' => generateUniqueTranNo(),
                                'user_id' => $val->user_id,
                                'credit_amt' => $bonus_amount,
                                'debit_amt' => '0',
                                'balance' => $balance,
                                'receiver_id' => $val->user_id,
                                'sender_id' => $val->user_id,
                                'receive_date' => date('Y-m-d'),
                                'ttype' => 'Rank Bonus',
                                'TranDescription' => 'Rank Bonus from rank ' . $rank_name,
                                'Cause' => 'Rank Bonus from rank ' . $rank_name,
                                'Remark' => 'Rank Bonus from rank ' . $rank_name,
                                'invoice_no' => '',
                                'product_name' => 'main',
                                'deposit_id' => '1',
                                'status' => '1',
                                'rank_id' => $rank_id,
                                'rank_name' => $rank_name,
                                'ewallet_used_by' => 'Withdrawal Wallet',
                                'current_url' => site_url(),
                                'reason' => '13', //credit for matrix commission
                            ]);
                        }
                    }
                }
            }
        }
    }
    public function faststartCommission()
    {
        fast_start_bonus('123456');
    }
    public function binaryCommissionNot()
    {
        creditBinaryCommission();
        /*$this->db->insert('crons',array(
        'scriptname'=>'binaryCommission',
        'createdate'=>date('Y-m-d')
        ));*/
    }
    public function directComm()
    {
        matrix_commission_direct(3878486, 'direct_matrix_downline', 2, 20000);
    }
    public function rankbonus()
    {
        $bonus_date = date('Y-m-d');
        $sqlinfo = $this->db->select('*')->from('user_registration')->where('active_status', '1')->get()->result();
        foreach ($sqlinfo as $key => $val) {
            echo $val->user_id . '==' . $val->rank_id;
            echo '<br>';
            $downlinecount = $this->db
                ->select('id')
                ->from('user_registration')
                ->where(['active_status' => '1', 'ref_id' => $val->user_id, 'rank_id' => '8'])
                ->group_by('rank_id')
                ->get()
                ->num_rows();
            if ($downlinecount >= 10) {
                //rank_id=14;
                $this->insertrankbonus($val->user_id, $val->rank_id, 14, 1200000, $bonus_date);
            } elseif ($downlinecount >= 5) {
                //rank_id=13;
                $this->insertrankbonus($val->user_id, $val->rank_id, 13, 240000, $bonus_date);
            } elseif ($downlinecount >= 4) {
                //rank_id=12;
                $this->insertrankbonus($val->user_id, $val->rank_id, 12, 120000, $bonus_date);
            } elseif ($downlinecount >= 3) {
                //rank_id=11;
                $this->insertrankbonus($val->user_id, $val->rank_id, 11, 40000, $bonus_date);
            } elseif ($downlinecount >= 2) {
                //rank_id=10;
                $this->insertrankbonus($val->user_id, $val->rank_id, 10, 20000, $bonus_date);
            } elseif ($downlinecount >= 1) {
                //rank_id=9;
                $this->insertrankbonus($val->user_id, $val->rank_id, 9, 10000, $bonus_date);
            } else {
                $downlinecount = $this->db
                    ->select('id')
                    ->from('user_registration')
                    ->where(['active_status' => '1', 'ref_id' => $val->user_id, 'rank_id' => '6'])
                    ->group_by('rank_id')
                    ->get()
                    ->num_rows();
                if ($downlinecount >= 2) {
                    //rank_id=8;
                    $this->insertrankbonus($val->user_id, $val->rank_id, 8, 5000, $bonus_date);
                } else {
                    $downlinecount = $this->db
                        ->select('id')
                        ->from('user_registration')
                        ->where(['active_status' => '1', 'ref_id' => $val->user_id, 'rank_id' => '5'])
                        ->group_by('rank_id')
                        ->get()
                        ->num_rows();
                    if ($downlinecount >= 1) {
                        //rank_id=7;
                        $this->insertrankbonus($val->user_id, $val->rank_id, 7, 2000, $bonus_date);
                    } else {
                        $downlinecount = $this->db
                            ->select('id')
                            ->from('user_registration')
                            ->where(['active_status' => '1', 'ref_id' => $val->user_id, 'rank_id' => '4'])
                            ->group_by('rank_id')
                            ->get()
                            ->num_rows();
                        if ($downlinecount >= 2) {
                            //rank_id=6;
                            $this->insertrankbonus($val->user_id, $val->rank_id, 6, 1000, $bonus_date);
                        } else {
                            $downlinecount = $this->db
                                ->select('id')
                                ->from('user_registration')
                                ->where(['active_status' => '1', 'ref_id' => $val->user_id, 'rank_id' => '3'])
                                ->group_by('rank_id')
                                ->get()
                                ->num_rows();
                            if ($downlinecount >= 2) {
                                //rank_id=5;
                                $this->insertrankbonus($val->user_id, $val->rank_id, 5, 500, $bonus_date);
                            } elseif ($downlinecount >= 1) {
                                //rank_id=4;
                                $this->insertrankbonus($val->user_id, $val->rank_id, 4, 200, $bonus_date);
                            } else {
                                $downlinecount = $this->db
                                    ->select('id')
                                    ->from('user_registration')
                                    ->where(['active_status' => '1', 'ref_id' => $val->user_id, 'rank_id' => '2'])
                                    ->group_by('rank_id')
                                    ->get()
                                    ->num_rows();
                                if ($downlinecount >= 2) {
                                    //rank_id=3;
                                    $this->insertrankbonus($val->user_id, $val->rank_id, 3, 100, $bonus_date);
                                } else {
                                    $downlinecount = $this->db
                                        ->select('id')
                                        ->from('user_registration')
                                        ->where(['active_status' => '1', 'ref_id' => $val->user_id, 'rank_id' => '1'])
                                        ->group_by('rank_id')
                                        ->get()
                                        ->num_rows();
                                    if ($downlinecount >= 1) {
                                        //rank_id=2;
                                        $this->insertrankbonus($val->user_id, $val->rank_id, 2, 0, $bonus_date);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function insertrankbonus($user_id, $prevrankid, $nextrankid, $bonus, $bonus_date)
    {
        // check if rank bonus already exits dont give again for same rank
        $count = $this->db
            ->select('id')
            ->from('rank_bonus')
            ->where(['nextrank_id' => $nextrankid])
            ->get()
            ->num_rows();
        if ($count) {
        } else {
            $this->db->update('rank_bonus', ['status' => 1], ['user_id' => $user_id]);
            $insert = [
                'user_id' => $user_id,
                'rank_id' => $prevrankid,
                'nextrank_id' => $nextrankid,
                'bonus' => $bonus,
                'bonus_date' => $bonus_date,
            ];
            $this->db->insert('rank_bonus', $insert);
            $prname = get_rank_name($prevrankid);
            $nrname = get_rank_name($nextrankid);
            if ($bonus > 0) {
                $query_obj = $this->db->select('amount')->from('final_e_wallet')->where('user_id', $user_id)->get()->row();
                $balance = $query_obj->amount + $bonus;
                $this->db->update('final_e_wallet', ['amount' => $balance], ['user_id' => $user_id]);
                $this->db->insert('credit_debit', [
                    'transaction_no' => generateUniqueTranNo(),
                    'user_id' => $user_id,
                    'credit_amt' => $bonus,
                    'debit_amt' => '0',
                    'balance' => $balance,
                    'receiver_id' => $user_id,
                    'sender_id' => $user_id,
                    'receive_date' => date('Y-m-d'),
                    'ttype' => 'Rank Bonus',
                    'TranDescription' => 'Rank Bonus of rank ' . $nrname . ' from ' . $prname,
                    'Cause' => 'Rank Bonus of rank ' . $nrname . ' from ' . $prname,
                    'Remark' => 'Rank Bonus of rank ' . $nrname . ' from ' . $prname,

                    'product_name' => 'main',
                    'deposit_id' => '1',
                    'status' => '1',

                    'ewallet_used_by' => 'Withdrawal Wallet',
                    'current_url' => site_url(),
                    'reason' => '9', //credit for matrix commission
                ]);
                //echo $this->db->last_query();
            }
            $this->db->update('user_registration', ['rank_id' => $nextrankid, 'rank_name' => $nrname], ['user_id' => $user_id]);
        }
    }
    public function error()
    {
        _frontLayout('web-mgmt/error');
    }
    public function aboutUs()
    {
        _frontLayout('web-mgmt/about-us');
    }

    public function contactUs()
    {
        _frontLayout('web-mgmt/contact-us');
    }
    public function productlist($catid = null)
    {
        //$p=$this->db->select('*')->from('eshop_products')->where('parent_category_id',$catid)->get()->result();
        $p = $this->db->select('*')->from('eshop_products')->get()->result();
        $data['products'] = $p;
        $p = $this->db->select('*')->from('eshop_category')->get()->result();
        $data['category'] = $p;
        _frontLayout('web-mgmt/productlist', $data);
    }
    public function servicelist($catid, $subcatid = null, $sub2catid = null)
    {
        $data['main_cat'] = $catid;
        if ($catid != '' && $subcatid != '' && $sub2catid != '') {
            // check sub2 category is product or services
            $c = $this->db
                ->select('*')
                ->from('eshop_sub2category')
                ->where(['id' => $sub2catid, 'active_status' => 0])
                ->get()
                ->num_rows();
            if ($c > 0) {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid, 'category_id' => $subcatid, 'subcat_id' => $sub2catid])
                    ->get()
                    ->row();

                $data['products'] = $p;
                $cp = $this->db
                    ->select('*')
                    ->from('eshop_sub2category')
                    ->where(['id' => $sub2catid, 'active_status' => 0])
                    ->get()
                    ->result();
                $data['dcategory'] = $cp;

                $data['dname'] = 'subcategory_name';
                _frontLayout('web-mgmt/servicelist', $data);
            } else {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid, 'category_id' => $subcatid, 'subcat_id' => $sub2catid])
                    ->get()
                    ->result();

                $data['products'] = $p;
                _frontLayout('web-mgmt/productlist', $data);
            }
        } elseif ($catid != '' && $subcatid != '') {
            $c = $this->db
                ->select('*')
                ->from('eshop_subcategory')
                ->where(['id' => $subcatid, 'active_status' => 0])
                ->get()
                ->num_rows();
            if ($c > 0) {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid, 'category_id' => $subcatid])
                    ->get()
                    ->row();

                $data['products'] = $p;
                $cp = $this->db
                    ->select('*')
                    ->from('eshop_subcategory')
                    ->where(['id' => $subcatid, 'active_status' => 0])
                    ->get()
                    ->result();
                $data['dcategory'] = $cp;
                $data['main_cat'] = $catid;
                $data['dname'] = 'subcategory_name';
                _frontLayout('web-mgmt/servicelist', $data);
            } else {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid, 'category_id' => $subcatid])
                    ->get()
                    ->result();

                $data['products'] = $p;

                _frontLayout('web-mgmt/productlist', $data);
            }
        } else {
            $c = $this->db
                ->select('*')
                ->from('eshop_category')
                ->where(['id' => $catid, 'active_status' => 0])
                ->get()
                ->num_rows();
            if ($c > 0) {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid])
                    ->get()
                    ->row();
                $data['products'] = $p;
                $cp = $this->db
                    ->select('*')
                    ->from('eshop_category')
                    ->where(['id' => $catid, 'active_status' => 0])
                    ->get()
                    ->result();
                $data['dcategory'] = $cp;
                $data['main_cat'] = $catid;
                $data['dname'] = 'category_name';
                _frontLayout('web-mgmt/servicelist', $data);
            } else {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid])
                    ->get()
                    ->result();
                $data['products'] = $p;
                //pr($p);
                _frontLayout('web-mgmt/productlist', $data);
            }
        }
    }
    public function servicelistbackup($catid, $subcatid = null, $sub2catid = null)
    {
        if ($catid != '' && $subcatid != '' && $sub2catid != '') {
            // check sub2 category is product or services
            $c = $this->db
                ->select('*')
                ->from('eshop_sub2category')
                ->where(['id' => $sub2catid, 'active_status' => 0])
                ->get()
                ->num_rows();
            if ($c > 0) {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid, 'category_id' => $subcatid, 'subcat_id' => $sub2catid])
                    ->get()
                    ->row();

                $data['products'] = $p;
                $cp = $this->db
                    ->select('*')
                    ->from('eshop_sub2category')
                    ->where(['id' => $sub2catid, 'active_status' => 0])
                    ->get()
                    ->result();
                $data['dcategory'] = $cp;
                $data['dname'] = 'subcategory_name';
                _frontLayout('web-mgmt/servicelist', $data);
            } else {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid])
                    ->get()
                    ->result();

                $data['products'] = $p;
                _frontLayout('web-mgmt/productlist', $data);
            }
        } elseif ($catid != '' && $subcatid != '') {
            $c = $this->db
                ->select('*')
                ->from('eshop_subcategory')
                ->where(['id' => $subcatid, 'active_status' => 0])
                ->get()
                ->num_rows();
            if ($c > 0) {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid, 'category_id' => $subcatid])
                    ->get()
                    ->row();

                $data['products'] = $p;
                $cp = $this->db
                    ->select('*')
                    ->from('eshop_subcategory')
                    ->where(['id' => $subcatid, 'active_status' => 0])
                    ->get()
                    ->result();
                $data['dcategory'] = $cp;
                $data['dname'] = 'subcategory_name';
                _frontLayout('web-mgmt/servicelist', $data);
            } else {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid])
                    ->get()
                    ->result();

                $data['products'] = $p;

                _frontLayout('web-mgmt/productlist', $data);
            }
        } else {
            $c = $this->db
                ->select('*')
                ->from('eshop_category')
                ->where(['id' => $catid, 'active_status' => 0])
                ->get()
                ->num_rows();
            if ($c > 0) {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid])
                    ->get()
                    ->row();
                $data['products'] = $p;
                $cp = $this->db
                    ->select('*')
                    ->from('eshop_category')
                    ->where(['id' => $catid, 'active_status' => 0])
                    ->get()
                    ->result();
                $data['dcategory'] = $cp;
                $data['dname'] = 'category_name';
                _frontLayout('web-mgmt/servicelist', $data);
            } else {
                $p = $this->db
                    ->select('*')
                    ->from('eshop_products')
                    ->where(['parent_category_id' => $catid])
                    ->get()
                    ->result();
                $data['products'] = $p;
                //pr($p);
                _frontLayout('web-mgmt/productlist', $data);
            }
        }
    }

    public function productDetail($pid)
    {
        $p = $this->db
            ->select('*')
            ->from('eshop_products')
            ->where(['id' => $pid])
            ->get()
            ->row();

        $data['products'] = $p;
        _frontLayout('web-mgmt/product-detail', $data);
    }
    public function contactData()
    {
        //pr($_POST); exit;
        $email_data['from'] = 'info@honelogixmlm.com';
        $email_data['to'] = $_POST['email'];
        $email_data['subject'] = $_POST['subject'];
        $email_data['phone'] = $_POST['phone'];
        $email_data['name'] = $_POST['username'];
        $email_data['message'] = $_POST['message'];
        $email_data['email-template'] = 'contact-mail';
        //_sendEmail($email_data);
        $to = 'subpal2009@gmail.com';
        $subject = 'Dream Builders Africa Enquiry';

        $message =
            "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>Thank you for contact us!</p>
<table>
<tr>
<th>Name:</th>
<th>" .
            $_POST['name'] .
            "</th>
</tr>
<tr>
<td>Email</td>
<td>" .
            $_POST['email'] .
            "</td>
</tr>
<tr>
<td>Awareness</td>
<td>" .
            $_POST['awareness'] .
            "</td>
</tr>
<tr>
<td>Phone</td>
<td>" .
            $_POST['number'] .
            "</td>
</tr>
<tr>
<td>Message</td>
<td>" .
            $_POST['message'] .
            "</td>
</tr>
</table>
</body>
</html>
";

        // Always set content-type when sending HTML email
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

        // More headers
        $headers .= 'From: Dream Builders<info@honelogixmlm.com>' . "\r\n";

        mail($to, $subject, $message, $headers);
        mail('subpal2009@gmail.com', $subject, $message, $headers);
        echo 'Thank you for connecting with us.';
    }
    public function ourProducts()
    {
        _frontLayout('web-mgmt/ourProducts');
    }
    public function blog()
    {
        _frontLayout('web-mgmt/blog');
    }
    public function WelnessProgram()
    {
        _frontLayout('web-mgmt/WelnessProgram');
    }
    public function communitySpotlight()
    {
        _frontLayout('web-mgmt/communitySpotlight');
    }
    public function sustainability()
    {
        _frontLayout('web-mgmt/sustainability');
    }
    public function FinancialFreedom()
    {
        _frontLayout('web-mgmt/FinancialFreedom');
    }

    public function Packages()
    {
        $pk_res = $this->db->query("select * from package where status='1'")->result();
        $data['package'] = $pk_res;
        _frontLayout('web-mgmt/package-list', $data);
    }
    public function Packages1()
    {
        $pk_res = $this->db->query("select * from package where status='1'")->result();
        $data['package'] = $pk_res;
        _frontLayout('web-mgmt/packages', $data);
    }
    public function compensationPlan()
    {
        _frontLayout('web-mgmt/compensation-plan');
    }
    public function isUserNameExists()
    {
        $username = $this->input->post('username');
        $requestType = $this->input->post('requestType');
        //print_r($_POST); exit;
        //sleep(1);
        if ($requestType == 'upline') {
            if ($this->account_model->isUplineUserExist($username)) {
                $user_info = $this->account_model->getUserDetails($username);
                $output = [
                    'exist' => 1,
                    'username' => $user_info->username,
                ];
                $this->output->set_content_type('application/json')->set_output(json_encode($output));
            } else {
                $output = [
                    'exist' => 0,
                ];
                $this->output->set_content_type('application/json')->set_output(json_encode($output));
            }
        } elseif ($requestType == 'sponsor') {
            if ($this->account_model->isActiveUserExist($username)) {
                $user_info = $this->account_model->getUserDetails($username);
                $output = [
                    'exist' => 1,
                    'username' => $user_info->username,
                ];
                $this->output->set_content_type('application/json')->set_output(json_encode($output));
            } else {
                $output = [
                    'exist' => 0,
                ];
                $this->output->set_content_type('application/json')->set_output(json_encode($output));
            }
        } elseif ($requestType == 'new_user') {
            if ($this->front_model->isUserExist($username)) {
                $user_info = $this->account_model->getUserDetails($username);
                $output = [
                    'exist' => 1,
                    'first_name' => $user_info->first_name,
                    'last_name' => $user_info->last_name,
                ];
                $this->output->set_content_type('application/json')->set_output(json_encode($output));
            } else {
                $output = [
                    'exist' => 0,
                ];
                $this->output->set_content_type('application/json')->set_output(json_encode($output));
            }
        }
    }
    public function index()
    {
        $p = $this->db->select('*')->from('eshop_products')->get()->result();
        $data['products'] = $p;

        /* $query = $this->db->query("
                SELECT DISTINCT
                    c.id AS category_id,
                    c.category_name,
                    sc.id AS subcategory_id,
                    sc.subcategory_name,
                    s2c.id AS sub2category_id,
                    s2c.subcategory_name AS sub2category_name,
                    sc.image AS subcategory_image,
                    s2c.image AS sub2category_image
                FROM eshop_category c
                LEFT JOIN eshop_subcategory sc ON c.id = sc.parent_id
                LEFT JOIN eshop_sub2category s2c ON sc.id = s2c.subcat_id
            ");*/
        $query = $this->db->query('SELECT * FROM eshop_category ');

        $data['category'] = $query->result();
        $data['callfunc'] = $this;
        _frontLayout('web-mgmt/home', $data);
    }
    public function getproducts($cat_id)
    {
        $p = $this->db->select('*')->from('eshop_products')->where('parent_category_id', $cat_id)->get()->result();
        return $p;
    }
    public function shopcart()
    {
        $data = [];
        _frontLayout('web-mgmt/shopcart', $data);
    }
    public function generateUniqueOrderId()
    {
        $random_number = 'OR' . mt_rand(100000, 999999);
        if ($this->db->select('order_id')->from('eshop_orders')->where('order_id', $random_number)->get()->num_rows() > 0) {
            $this->generateUniqueOrderId();
        }
        return $random_number;
    }
    public function quoteInvoice()
    {
        $data = [];
        $user_id = $this->session->userdata('user_id');
        //$center_leader=$this->session->userdata('center_leader');
        $role = $this->session->userdata('userType');
        $owner_user_id = $this->session->userdata('stockist_id');

        //pr($this->session->userdata('cart_reg')); exit;

        if (!empty($this->session->userdata('cart_reg')) && !empty($this->session->userdata('total_products')) && !empty($this->session->userdata('cart_final_price'))) {
            $cart = (object) $this->session->userdata('cart_reg');
            $order_id = $this->generateUniqueOrderId();
            //	pr($cart); exit;
            $bonus_date = date('Y-m-d');
            $total_pv = 0;
            $total_product_qty = 0;
            foreach ($cart as $product) {
                $product = (object) $product;
                $product_stock_info = $this->db
                    ->select(['qty', 'total_order', 'guest_point', 'new_price'])
                    ->from('eshop_products')
                    ->where('id', $product->product_id)
                    ->get()
                    ->row();
                $final_stock = $product_stock_info->qty - $product->qty;
                $total_product_qty = $total_product_qty + $product->qty;
                $total_order = $product_stock_info->total_order + 1;
                $guest_point = $product_stock_info->guest_point;
                $new_price = $product_stock_info->new_price;
                //$this->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product->product_id));

                $product_id = $product->product_id;
                $cart_final_price = $this->session->userdata('cart_final_price');
                $pv = $guest_point * $product->qty;
                $total_pv = $total_pv + $pv;
            }
            //exit;

            $role = $this->session->userdata('userType');
            $user_id = null;
            $guest_id = null;
            if ($role == '2') {
                $user_id = $this->session->userdata('user_id');
            } elseif ($role == '3') {
                $guest_id = $this->session->userdata('user_id');
            }

            $cart_final_price = $this->session->userdata('cart_final_price');
            $cart_total_discount = $this->session->userdata('cart_total_discount');
            $owner_user_id = $this->session->userdata('stockist_id');
            $this->db->insert('eshop_orders', [
                'order_id' => $order_id,
                'role' => (string) $role,
                'user_id' => $user_id,
                'guest_id' => $guest_id,
                'order_from' => 'eshop',
                'order_details' => json_encode($this->session->userdata('cart_reg')),
                'total_products' => $this->session->userdata('total_products'),
                'total_product_qty' => $total_product_qty,
                'discount' => $cart_total_discount,
                'final_price' => $cart_final_price,
                'final_pv' => $total_pv,
                'payment_method' => '2',
                'quote' => 1,
            ]);

            /////////////////////
            $nom_info = $this->db
                ->select('*')
                ->from('user_registration')
                ->where(['user_id' => $user_id])
                ->get()
                ->row();
            $this->db->insert('eshop_guest_delivery_address', [
                'role' => 2,
                'guest_id' => $user_id,
                'name' => $nom_info->first_name . ' ' . $nom_info->last_name,
                'mobile_no' => $nom_info->contact_no,
                'address' => $nom_info->address,
                'city' => $nom_info->city,
                'order_id' => $order_id,
                'state' => $nom_info->state,
                'crate_date' => date('Y-m-d'),
                'type' => '0',
            ]);
            $this->session->unset_userdata('cart_reg');
            $this->session->unset_userdata('total_products');
            $this->session->unset_userdata('cart_final_price');
            $this->session->unset_userdata('registration_with_cart');
            redirect(site_url() . 'Affiliate/Eshop/order_successful?order_id=' . $order_id);
            exit();
        } else {
            redirect(site_url() . 'Web');
            exit();
        }
    }

    public function billInvoice()
    {
		// 
        // pr($this->session->userdata()); exit;
        $data = [];
        $user_id = $this->session->userdata('user_id');
        // print_r($this->session->userdata()); exit;
        $auth_affiliate = $this->session->userdata('auth_affiliate');
        //$center_leader=$this->session->userdata('center_leader');
        $role = $this->session->userdata('userType');
        $owner_user_id = $this->session->userdata('stockist_id');

        // NEW: payment selection from checkout
        $selected_payment_method = (string) $this->input->post('payment_method'); // wallet|paypal|...
        $paypal_transaction_id = $this->input->post('paypal_transaction_id');

        // Only call PayPal check when PayPal selected
        $payment_response = null;
        if ($selected_payment_method === 'paypal' && !empty($paypal_transaction_id)) {
            $payment_response = $this->capture_order_check($paypal_transaction_id);
        }
        // pr($paypal_transaction_id); exit;
        //pr($payment_response); exit;
        // exit();
        if ($user_id != '' && $auth_affiliate) {
            // pr($this->session->userdata('total_products')); exit;
            if (!empty($this->session->userdata('cart_reg')) && !empty($this->session->userdata('total_products'))) {
                $cart = (object) $this->session->userdata('cart_reg');
                $order_id = $this->generateUniqueOrderId();
                // pr($cart); exit;
                $bonus_date = date('Y-m-d');
                $date = date('Y-m-d');
                $total_pv = 0;
                $total_product_qty = 0;
                $role = $this->session->userdata('userType');
                // ...existing code...

                foreach ($cart as $product) {
                    // ...existing code...
                }
                //exit;

                $cart_final_price = $this->session->userdata('cart_final_price');
                $cart_total_discount = $this->session->userdata('cart_total_discount');

                // NEW: Wallet deduction before order finalization
                if ($selected_payment_method === 'wallet') {
                    $orderTotal = (float) $cart_final_price;

                    // ensure wallet row exists
                    $walletRow = $this->db->select('amount')->from('final_e_wallet')->where('user_id', $user_id)->get()->row();
                    if (!$walletRow) {
                        $this->db->insert('final_e_wallet', ['user_id' => $user_id, 'amount' => 0]);
                        $walletRow = (object) ['amount' => 0];
                    }

                    $walletBalance = (float) $walletRow->amount;
                    if ($walletBalance < $orderTotal) {
                        $this->session->set_flashdata('error_msg', '<span class="text-semibold">Insufficient wallet balance.</span>');
                        redirect(site_url() . 'checkout');
                        exit();
                    }

                    // atomic deduction
                    $this->db->query(
                        "UPDATE final_e_wallet SET amount = amount - ? WHERE user_id = ? AND amount >= ?",
                        [$orderTotal, $user_id, $orderTotal]
                    );

                    if ($this->db->affected_rows() <= 0) {
                        $this->session->set_flashdata('error_msg', '<span class="text-semibold">Wallet deduction failed. Please try again.</span>');
                        redirect(site_url() . 'checkout');
                        exit();
                    }

                    // ledger entry (optional)
                    $walletRow2 = $this->db->select('amount')->from('final_e_wallet')->where('user_id', $user_id)->get()->row();
                    $newBalance = $walletRow2 ? (float) $walletRow2->amount : ($walletBalance - $orderTotal);

                    $tables = $this->db->list_tables();
                    if (in_array('credit_debit', $tables)) {
                        $this->db->insert('credit_debit', [
                            'transaction_no' => function_exists('generateUniqueTranNo') ? generateUniqueTranNo() : uniqid('TXN'),
                            'user_id' => $user_id,
                            'credit_amt' => 0,
                            'debit_amt' => $orderTotal,
                            'balance' => $newBalance,
                            'receiver_id' => $user_id,
                            'sender_id' => $user_id,
                            'receive_date' => date('Y-m-d'),
                            'ttype' => 'Order Payment',
                            'TranDescription' => 'Order payment via Wallet. Order ID: ' . $order_id,
                            'Cause' => 'Order payment via Wallet',
                            'Remark' => 'Wallet debit for order ' . $order_id,
                            'product_name' => 'main',
                            'deposit_id' => '1',
                            'status' => '1',
                            'ewallet_used_by' => 'Withdrawal Wallet',
                            'current_url' => current_url(),
                            'reason' => 'ESHOP_ORDER_WALLET',
                        ]);
                    }
                }

                // Determine order payment method value stored in eshop_orders
                $order_payment_method = ($selected_payment_method === 'wallet') ? 'wallet' : 'paypal';

                $owner_user_id = $this->session->userdata('stockist_id');
                $this->db->insert('eshop_orders', [
                    'order_id' => $order_id,
                    'role' => (string) $role,
                    'user_id' => $user_id,
                    'guest_id' => $guest_id,
                    'order_from' => 'eshop',
                    'order_details' => json_encode($this->session->userdata('cart_reg')),
                    'total_products' => $this->session->userdata('total_products'),
                    'total_product_qty' => $total_product_qty,
                    'discount' => $cart_total_discount,
                    'final_price' => $cart_final_price,
                    'final_pv' => $total_pv,
                    'payment_method' => $order_payment_method,
                    'confirm_date' => date('Y-m-d H:i:s'),
                    'bill' => 1,
                ]);

                $order_db_id = $this->db->insert_id(); //
                $product_ids = [];

                foreach ($cart as $item) {
                    $product_ids[] = $item['product_id'];
                }

                $product_ids = implode(',', $product_ids);

                // ...existing code... (delivery address, session unset)

                // PayPal insert only when PayPal selected
                if ($selected_payment_method === 'paypal') {
                    $response = $this->capture_order_check($paypal_transaction_id); // decoded array
                    $paypal_order_id = $response['id'];
                    $paypal_capture_id = $response['purchase_units'][0]['payments']['captures'][0]['id'];

                    $payer_email = $response['payer']['email_address'];
                    $payer_name = $response['payer']['name']['given_name'] . ' ' . $response['payer']['name']['surname'];
                    $payer_country = $response['payer']['address']['country_code'];

                    $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
                    $currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];

                    $paypal_fee = $response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['value'];
                    $net_amount = $response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['net_amount']['value'];

                    $payment_time = date('Y-m-d H:i:s', strtotime($response['purchase_units'][0]['payments']['captures'][0]['create_time']));

                    $this->db->insert('payment_paypal', [
                        'order_id' => $order_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'product_ids' => $product_ids,
                        'payment_gateway' => 'paypal',
                        'payment_method' => 'paypal',
                        'paypal_order_id' => $paypal_order_id,
                        'paypal_capture_id' => $paypal_capture_id,
                        'paypal_payer_id' => $response['payer']['payer_id'],
                        'payer_email' => $payer_email,
                        'payer_name' => $payer_name,
                        'payer_country' => $payer_country,
                        'amount' => $amount,
                        'currency' => $currency,
                        'paypal_fee' => $paypal_fee,
                        'net_amount' => $net_amount,
                        'payment_status' => 'SUCCESS',
                        'payment_time' => $payment_time,
                        'paypal_response' => json_encode($response),
                    ]);

                    $this->session->set_flashdata('payment_success', [
                        'order_id' => $order_id,
                        'payment_id' => $paypal_order_id,
                        'amount' => $amount,
                        'paid_at' => date('d M Y, h:i A'),
                    ]);
                }

                redirect(site_url() . 'invoice?order_id=' . $order_id);
                exit();
            } else {
                redirect(site_url() . 'Web');
                exit();
            }
        } else {
            redirect(site_url() . 'Web/login');
            exit();
        }
    }

    public function shop()
    {
        $data = [];
        $search_query = $this->input->get('search'); // Input name for the search box
        $category_id = $this->input->get('category_id'); // Input name for the category dropdown
        $this->db->select('*')->from('eshop_products');

        // Filter by category if category_id is provided
        if (!empty($category_id)) {
            $this->db->where('parent_category_id', $category_id);
        }

        // Search by product title if search query is provided
        if (!empty($search_query)) {
            $this->db->like('title', $search_query);
        }

        // Execute the query
        $query = $this->db->get();
        $data['products'] = $query->result();
        //echo $this->db->last_query();
        // echo '<pre>';print_r($data);

        //$p=$this->db->select('*')->from('eshop_products')->get()->result();
        // $data['products']=$p;
        _frontLayout('web-mgmt/shop', $data);
    }
    public function services()
    {
        $data = [];
        $search_query = $this->input->get('search'); // Input name for the search box
        $category_id = $this->input->get('category_id'); // Input name for the category dropdown
        $this->db->select('*')->from('eshop_products where serve_type=1');

        // Filter by category if category_id is provided
        if (!empty($category_id)) {
            $this->db->where('parent_category_id', $category_id);
        }

        // Search by product title if search query is provided
        if (!empty($search_query)) {
            $this->db->like('title', $search_query);
        }

        // Execute the query
        $query = $this->db->get();
        $data['products'] = $query->result();
        //echo $this->db->last_query();
        // echo '<pre>';print_r($data);

        //$p=$this->db->select('*')->from('eshop_products')->get()->result();
        // $data['products']=$p;
        _frontLayout('web-mgmt/service', $data);
    }
    public function singleproduct($id)
    {
        $data = [];
        $p = $this->db->select('*')->from('eshop_products')->where('id', $id)->get()->row();
        $data['products'] = $p;
        _frontLayout('web-mgmt/singleproduct', $data);
    }
    public function checkout()
    {
        $data = [];
        $data['countries'] = $this->db->get('countries')->result();
		$user_id = $this->session->userdata('user_id');
		$data['wallet'] = $this->db
			->where('user_id', $user_id)
			->get('final_e_wallet')
			->row(); 
		// print_r($data['wallet']); exit;

        _frontLayout('web-mgmt/checkout', $data);
    }

    public function get_states()
    {
        $country_name = $this->input->post('country_id');

        $country = $this->db->select('*')->from('countries')->where('name', $country_name)->get()->row();
		
        $states = $this->db->select('*')->from('states')->where('country_id', $country->id)->get()->result();
        print_r($country); exit;
        echo '<option value="">Select State</option>';
        foreach ($states as $row) {
            echo '<option value="' . $row->name . '">' . $row->name . '</option>';
        }
    }
    public function get_cities()
    {
        $state_id = $this->input->post('state_id');
        $state = $this->db->select('*')->from('states')->where('name', $state_id)->get()->row();

        $cities = $this->db->select('*')->from('cities')->where('state_id', $state->id)->get()->result();
        // print_r($state); exit;
        echo '<option value="">Select City</option>';
        foreach ($cities as $row) {
            echo '<option value="' . $row->name . '">' . $row->name . '</option>';
        }
    }
    public function affiliate()
    {
        _frontLayout('affiliate-mgmt/affiliate');
    }
    public function dashboard()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['orders_count'] = $this->db->select('*')->from('eshop_orders')->where('user_id', $user_id)->order_by('id', 'desc')->get()->num_rows();
        $paymentinfo=$this->db->select_sum('amount')->from('payment_paypal')->where('user_id', $user_id)->get()->row();
        $data['totalpayment'] = $paymentinfo->amount;
        $paymentinfo=$this->db->select_sum('amount')->from('final_e_wallet')->where('user_id', $user_id)->get()->row();
        $data['walletpayment'] = $paymentinfo->amount;
        $paymentinfo=$this->db->select('*')->from('user_calls')->where('user_id', $user_id)->get()->row();
        $data['totalcalls'] = $paymentinfo->total_calls;
        $data['usedcalls'] = $paymentinfo->used_calls;
        $data['remaining_calls'] = $paymentinfo->remaining_calls;
        $totalrequest=$this->db->select('*')->from('customer_meeting_requests')->where('customer_id', $user_id)->get()->num_rows();
        $data['totalrcalls'] = $totalrequest;
        $totalapproved=$this->db->select('*')->from('customer_meeting_requests')->where(array('customer_id'=>$user_id,'status'=>'approved'))->get()->num_rows();
        $data['totalacalls'] = $totalapproved;
        
        $data['products'] = $this->db->select('*')->from('eshop_products')->order_by('id', 'desc')->get()->result();
        $data['latesorders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->result();
        $data['customer_count'] = $this->db->from('user_registration')->where('member_type', 2)->count_all_results();
        $data['expert_count'] = $this->db->from('user_registration')->where('member_type', 1)->count_all_results();
        $date['events'] = $this->db->select('*')->from('expert_events')->where('user_id', $user_id)->get()->result();
        $data['experts'] = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('member_type', 1) // expert
            ->get()
            ->result();
        $data['expert_list'] = $this->db
            ->select('u.user_id, u.first_name, u.last_name, u.username, u.email')
            ->from('expert_events e')
            ->join('user_registration u', 'u.user_id = e.user_id')
            ->group_by('u.user_id') // duplicate experts remove
            ->get()
            ->result();
        $data['requests'] = $this->db->select('cmr.*, ur.first_name as customer_name')->from('customer_meeting_requests cmr')->join('user_registration ur', 'ur.user_id = cmr.expert_id')->where('cmr.expert_id', $user_id)->order_by('cmr.id', 'DESC')->get()->result();
        // print_r($data['requests']);
        // exit;
		$data['payments'] = $this->db
		->select('*')
		->from('payment_paypal p')
		->join('eshop_orders o', 'o.order_id = p.order_id', 'left')
		->order_by('p.id', 'DESC')
		->get()
		->result();	
		// pr($data['payments']);exit;
        _frontLayout('web-mgmt/dashboard', $data);
    }
    public function googlemeet()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['orders_count'] = $this->db->select('*')->from('eshop_orders')->where('user_id', $user_id)->order_by('id', 'desc')->get()->num_rows();
        $paymentinfo=$this->db->select_sum('amount')->from('payment_paypal')->where('user_id', $user_id)->get()->row();
        $data['totalpayment'] = $paymentinfo->amount;
        $paymentinfo=$this->db->select('*')->from('user_calls')->where('user_id', $user_id)->get()->row();
        $data['totalcalls'] = $paymentinfo->total_calls;
        $data['usedcalls'] = $paymentinfo->used_calls;
        $data['products'] = $this->db->select('*')->from('eshop_products')->order_by('id', 'desc')->get()->result();
        $data['latesorders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->result();
        $data['customer_count'] = $this->db->from('user_registration')->where('member_type', 2)->count_all_results();
        $data['expert_count'] = $this->db->from('user_registration')->where('member_type', 1)->count_all_results();
        $date['events'] = $this->db->select('*')->from('expert_events')->where('user_id', $user_id)->get()->result();
        $data['experts'] = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('member_type', 1) // expert
            ->get()
            ->result();
        $data['expert_list'] = $this->db
            ->select('u.user_id, u.first_name, u.last_name, u.username, u.email')
            ->from('expert_events e')
            ->join('user_registration u', 'u.user_id = e.user_id')
            ->group_by('u.user_id') // duplicate experts remove
            ->get()
            ->result();
        $data['requests'] = $this->db->select('cmr.*, ur.first_name as customer_name')->from('customer_meeting_requests cmr')->join('user_registration ur', 'ur.user_id = cmr.expert_id')->where('cmr.expert_id', $user_id)->order_by('cmr.id', 'DESC')->get()->result();
        // print_r($data['requests']);
        // exit;
        $data['payments'] = $this->db
        ->select('*')
        ->from('payment_paypal p')
        ->join('eshop_orders o', 'o.order_id = p.order_id', 'left')
        ->order_by('p.id', 'DESC')
        ->get()
        ->result(); 
        // pr($data['payments']);exit;
        _frontLayout('web-mgmt/googlemeet', $data);
    }
    public function payments()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['orders_count'] = $this->db->select('*')->from('eshop_orders')->where('user_id', $user_id)->order_by('id', 'desc')->get()->num_rows();
        $paymentinfo=$this->db->select_sum('amount')->from('payment_paypal')->where('user_id', $user_id)->get()->row();
        $data['totalpayment'] = $paymentinfo->amount;
        $paymentinfo=$this->db->select('*')->from('user_calls')->where('user_id', $user_id)->get()->row();
        $data['totalcalls'] = $paymentinfo->total_calls;
        $data['usedcalls'] = $paymentinfo->used_calls;
        $data['products'] = $this->db->select('*')->from('eshop_products')->order_by('id', 'desc')->get()->result();
        $data['latesorders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->result();
        $data['customer_count'] = $this->db->from('user_registration')->where('member_type', 2)->count_all_results();
        $data['expert_count'] = $this->db->from('user_registration')->where('member_type', 1)->count_all_results();
        $date['events'] = $this->db->select('*')->from('expert_events')->where('user_id', $user_id)->get()->result();
        $data['experts'] = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('member_type', 1) // expert
            ->get()
            ->result();
        $data['expert_list'] = $this->db
            ->select('u.user_id, u.first_name, u.last_name, u.username, u.email')
            ->from('expert_events e')
            ->join('user_registration u', 'u.user_id = e.user_id')
            ->group_by('u.user_id') // duplicate experts remove
            ->get()
            ->result();
        $data['requests'] = $this->db->select('cmr.*, ur.first_name as customer_name')->from('customer_meeting_requests cmr')->join('user_registration ur', 'ur.user_id = cmr.expert_id')->where('cmr.expert_id', $user_id)->order_by('cmr.id', 'DESC')->get()->result();
        // print_r($data['requests']);
        // exit;
        $data['payments'] = $this->db
        ->select('*')
        ->from('payment_paypal p')
        ->join('eshop_orders o', 'o.order_id = p.order_id', 'left')
        ->order_by('p.id', 'DESC')
        ->get()
        ->result(); 
        // pr($data['payments']);exit;
        _frontLayout('web-mgmt/payment', $data);
    }
    public function expertbooking()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        
        $date['events'] = $this->db->select('*')->from('expert_events')->where('user_id', $user_id)->get()->result();
        $data['experts'] = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('member_type', 1) // expert
            ->get()
            ->result();
        $data['expert_list'] = $this->db
            ->select('u.user_id, u.first_name, u.last_name, u.username, u.email')
            ->from('expert_events e')
            ->join('user_registration u', 'u.user_id = e.user_id')
            ->group_by('u.user_id') // duplicate experts remove
            ->get()
            ->result();
        $data['requests'] = $this->db->select('cmr.*, ur.first_name as customer_name')->from('customer_meeting_requests cmr')->join('user_registration ur', 'ur.user_id = cmr.expert_id')->where('cmr.expert_id', $user_id)->order_by('cmr.id', 'DESC')->get()->result();
		$paymentinfo=$this->db->select('*')->from('user_calls')->where('user_id', $user_id)->get()->row();
        $data['totalcalls'] = $paymentinfo->total_calls;
        // print_r($data['requests']);
        // exit;
        _frontLayout('web-mgmt/expertbooking', $data);
    }
    public function orders()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['orders'] = $this->db->select('*')->from('eshop_orders')->where('user_id', $user_id)->order_by('id', 'desc')->get()->result();
        $data['products'] = $this->db->select('*')->from('eshop_products')->order_by('id', 'desc')->get()->result();
        $data['payments'] = $this->db
			->select('*')
			->from('payment_paypal p')
			->join('eshop_orders o', 'o.order_id = p.order_id', 'left')
			->order_by('p.id', 'DESC')
			->get()
			->result(); 
        // pr($data['orders']);exit;

        _frontLayout('web-mgmt/orders', $data);
    }
    public function sessions()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['calls'] = $this->db->select('*')->from('customer_meeting_requests')->where('customer_id', $user_id)->order_by('id', 'desc')->get()->result();
        $data['products'] = $this->db->select('*')->from('eshop_products')->order_by('id', 'desc')->get()->result();
        $data['latesorders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->result();
        $data['customer_count'] = $this->db->from('user_registration')->where('member_type', 2)->count_all_results();
        $data['expert_count'] = $this->db->from('user_registration')->where('member_type', 1)->count_all_results();
        $date['events'] = $this->db->select('*')->from('expert_events')->where('user_id', $user_id)->get()->result();
        $data['experts'] = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('member_type', 1) // expert
            ->get()
            ->result();
        $data['expert_list'] = $this->db
            ->select('u.user_id, u.first_name, u.last_name, u.username, u.email')
            ->from('expert_events e')
            ->join('user_registration u', 'u.user_id = e.user_id')
            ->group_by('u.user_id') // duplicate experts remove
            ->get()
            ->result();
        $data['requests'] = $this->db->select('cmr.*, ur.first_name as customer_name')->from('customer_meeting_requests cmr')->join('user_registration ur', 'ur.user_id = cmr.expert_id')->where('cmr.expert_id', $user_id)->order_by('cmr.id', 'DESC')->get()->result();
        // print_r($data['requests']);
        // exit;
        $data['payments'] = $this->db
        ->select('*')
        ->from('payment_paypal p')
        ->join('eshop_orders o', 'o.order_id = p.order_id', 'left')
        ->order_by('p.id', 'DESC')
        ->get()
        ->result(); 
        // pr($data['payments']);exit;

        _frontLayout('web-mgmt/sessions', $data);
    }
    public function experts()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['calls'] = $this->db->select('*')->from('customer_meeting_requests')->where('customer_id', $user_id)->order_by('id', 'desc')->get()->result();
        $data['products'] = $this->db->select('*')->from('eshop_products')->order_by('id', 'desc')->get()->result();
        $data['latesorders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->result();
        $data['customer_count'] = $this->db->from('user_registration')->where('member_type', 2)->count_all_results();
        $data['expert_count'] = $this->db->from('user_registration')->where('member_type', 1)->count_all_results();
        $date['events'] = $this->db->select('*')->from('expert_events')->where('user_id', $user_id)->get()->result();
        $data['experts'] = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('member_type', 1) // expert
            ->get()
            ->result();
        $data['expert_list'] = $this->db
            ->select('u.user_id, u.first_name, u.last_name, u.username, u.email')
            ->from('expert_events e')
            ->join('user_registration u', 'u.user_id = e.user_id')
            ->group_by('u.user_id') // duplicate experts remove
            ->get()
            ->result();
        $data['requests'] = $this->db->select('cmr.*, ur.first_name as customer_name')->from('customer_meeting_requests cmr')->join('user_registration ur', 'ur.user_id = cmr.expert_id')->where('cmr.expert_id', $user_id)->order_by('cmr.id', 'DESC')->get()->result();
        // print_r($data['requests']);
        // exit;
        $data['payments'] = $this->db
        ->select('*')
        ->from('payment_paypal p')
        ->join('eshop_orders o', 'o.order_id = p.order_id', 'left')
        ->order_by('p.id', 'DESC')
        ->get()
        ->result(); 
        // pr($data['payments']);exit;

        _frontLayout('web-mgmt/experts', $data);
    }
    public function addmoney()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['calls'] = $this->db->select('*')->from('customer_meeting_requests')->where('customer_id', $user_id)->order_by('id', 'desc')->get()->result();
        $data['products'] = $this->db->select('*')->from('eshop_products')->order_by('id', 'desc')->get()->result();
        $data['latesorders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->result();
        $data['customer_count'] = $this->db->from('user_registration')->where('member_type', 2)->count_all_results();
        $data['expert_count'] = $this->db->from('user_registration')->where('member_type', 1)->count_all_results();
        $data['events'] = $this->db->select('*')->from('expert_events')->where('user_id', $user_id)->get()->result();

        // ✅ wallet data must be in $data so view can access $wallet
        $data['wallet'] = $this->db->select('*')->from('final_e_wallet')->where('user_id', $user_id)->get()->row();

        // ✅ Wallet Topup PayPal History (only logged-in user)
        $data['wallet_topups'] = $this->db
            ->select('id,user_id,paypal_order_id,paypal_capture_id,paypal_payer_id,payer_email,payer_name,payer_country,amount,currency,paypal_fee,net_amount,payment_status,payment_time,created_at,paypal_response')
            ->from('wallet_topup_paypal')
            ->where('user_id', $user_id)
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        $data['experts'] = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('member_type', 1) // expert
            ->get()
            ->result();
        $data['expert_list'] = $this->db
            ->select('u.user_id, u.first_name, u.last_name, u.username, u.email')
            ->from('expert_events e')
            ->join('user_registration u', 'u.user_id = e.user_id')
            ->group_by('u.user_id') // duplicate experts remove
            ->get()
            ->result();
        $data['requests'] = $this->db->select('cmr.*, ur.first_name as customer_name')->from('customer_meeting_requests cmr')->join('user_registration ur', 'ur.user_id = cmr.expert_id')->where('cmr.expert_id', $user_id)->order_by('cmr.id', 'DESC')->get()->result();

        $data['payments'] = $this->db
            ->select('*')
            ->from('payment_paypal p')
            ->join('eshop_orders o', 'o.order_id = p.order_id', 'left')
            ->order_by('p.id', 'DESC')
            ->get()
            ->result();

        _frontLayout('web-mgmt/addmoney', $data);
    }
    public function profile()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['orders'] = $this->db->select('*')->from('eshop_orders')->where('user_id', $user_id)->order_by('id', 'desc')->get()->result();
        $data['products'] = $this->db->select('*')->from('eshop_products')->order_by('id', 'desc')->get()->result();
        $data['latesorders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->result();
        $data['customer_count'] = $this->db->from('user_registration')->where('member_type', 2)->count_all_results();
        $data['expert_count'] = $this->db->from('user_registration')->where('member_type', 1)->count_all_results();
        $date['events'] = $this->db->select('*')->from('expert_events')->where('user_id', $user_id)->get()->result();
        $data['experts'] = $this->db
            ->select('*')
            ->from('user_registration')
            ->where('member_type', 1) // expert
            ->get()
            ->result();
        $data['expert_list'] = $this->db
            ->select('u.user_id, u.first_name, u.last_name, u.username, u.email')
            ->from('expert_events e')
            ->join('user_registration u', 'u.user_id = e.user_id')
            ->group_by('u.user_id') // duplicate experts remove
            ->get()
            ->result();
        $data['requests'] = $this->db->select('cmr.*, ur.first_name as customer_name')->from('customer_meeting_requests cmr')->join('user_registration ur', 'ur.user_id = cmr.expert_id')->where('cmr.expert_id', $user_id)->order_by('cmr.id', 'DESC')->get()->result();
        // print_r($data['requests']);
        // exit;
        $data['payments'] = $this->db
        ->select('*')
        ->from('payment_paypal p')
        ->join('eshop_orders o', 'o.order_id = p.order_id', 'left')
        ->order_by('p.id', 'DESC')
        ->get()
        ->result(); 
        // pr($data['payments']);exit;

        _frontLayout('web-mgmt/profile', $data);
    }
    public function invoice()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'login');
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $order_id = $_GET['order_id'];
        $data['user'] = $this->front_model->get_user_by_id($user_id);
        $data['orders'] = $this->db->select('*')->from('eshop_orders')->where('user_id', $user_id)->order_by('id', 'desc')->get()->result();
        $data['lates_orders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'order_id' => $order_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->row();
        $data['latesorders'] = $this->db
            ->select('*')
            ->from('eshop_orders')
            ->where(['user_id' => $user_id, 'DATE(order_date)' => date('Y-m-d')])
            ->order_by('id', 'desc')
            ->get()
            ->result();
        $data['invoice_order'] = $this->db->select('*')->from('eshop_orders')->where('order_id', $order_id)->get()->row();
        $data['company_details'] = $this->db->select('*')->from('company_details')->get()->row();
        _frontLayout('web-mgmt/invoice', $data);
    }
    public function login()
    {
        if ($this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'dashboard');
            exit();
        }
        if (!empty($this->input->post('login'))) {
            //pr($_POST); exit;
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->auth->userExists($username, $password)) {
                $userdata = [
                    'username' => $this->auth->userName,
                    'password' => $this->auth->userPassword,
                    'SD_User_Name' => $this->auth->SD_User_Name,
                    'user_id' => $this->auth->user_id,
                    'userpanel_user_id' => $this->auth->userpanel_user_id,
                    'member_type' => $this->auth->member_type,
                ];
                // pr($userdata);exit;
                $this->db->update('user_registration', ['current_login_status' => '1'], ['user_id' => $this->auth->user_id]);
                //   print_r($userdata); exit;
                $userdata['userType'] = $this->auth->member_type;
                $userdata['auth_affiliate'] = true;
                $this->session->set_userdata($userdata);
                redirect(ci_site_url() . 'dashboard');
                exit();
                exit();
            } else {
                echo $msg = '<h5 style="color:red">Sorry entered username/password is wrong</h5>';
                $this->session->set_flashdata('res', $msg);
                redirect(ci_site_url() . 'login');
                exit();
            }
        }
        _frontLayout('web-mgmt/login');
        //$this->load->view('web-mgmt/login');
    }
    public function logincheckout()
    {
        if ($this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'dashboard');
            exit();
        }
        if (!empty($this->input->post('login'))) {
            //pr($_POST); exit;
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->auth->userExists($username, $password)) {
                $userdata = [
                    'username' => $this->auth->userName,
                    'password' => $this->auth->userPassword,
                    'SD_User_Name' => $this->auth->SD_User_Name,
                    'user_id' => $this->auth->user_id,
                    'userpanel_user_id' => $this->auth->userpanel_user_id,
                    'member_type' => $this->auth->member_type,
                ];
                $this->db->update('user_registration', ['current_login_status' => '1'], ['user_id' => $this->auth->user_id]);
                //print_r($userdata); exit;
                $userdata['userType'] = $this->auth->member_type;
                $userdata['auth_affiliate'] = true;
                $this->session->set_userdata($userdata);
                redirect(ci_site_url() . 'checkout');
                exit();
                exit();
            } else {
                echo $msg = '<h5 style="color:red">Sorry entered username/password is wrong</h5>';
                $this->session->set_flashdata('res', $msg);
                redirect(ci_site_url() . 'login');
                exit();
            }
        }
        _frontLayout('web-mgmt/login');
        //$this->load->view('web-mgmt/login');
    }
    public function logout()
    {
        $this->db->update('user_registration', ['current_login_status' => '0'], ['user_id' => $this->session->userdata('user_id')]);
        $userdata = [
            'username' => '',
            'password' => '',
            'userType' => '',
            'auth_affiliate' => '',
            'SD_User_Name' => '',
            'user_id' => '',
            'userpanel_user_id' => '',
        ];
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('userType');
        $this->session->unset_userdata('auth_affiliate');
        $this->session->unset_userdata('SD_User_Name');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('userpanel_user_id');
        $this->session->unset_userdata($userdata);
        $msg = '<h5 style="color:green">you are successfully logged out</h5>';
        $this->session->set_flashdata('res', $msg);
        //$this->session->sess_destroy();
        redirect(ci_site_url() . 'Web/login');
        exit();
    } //end method
    public function forgetpassword()
    {
        if ($this->session->userdata('auth_affiliate')) {
            redirect(ci_site_url() . 'Affiliate/');
            exit();
        }

        if (!empty($this->input->post('login'))) {
            $email = $this->input->post('email');

            $user = $this->db->where('email', $email)->get('user_registration')->row();

            if ($user) {
                // Compose email
                $subject = 'Your Adminza Login Credentials';
                $message = "
                    <html>
                    <head>
                        <title>Your Adminza Login Credentials</title>
                    </head>
                    <body>
                        <p>Hello,</p>
                        <p>Here are your Adminza login credentials:</p>
                        <p><strong>Username:</strong> {$user->username}</p>
                        <p><strong>Password:</strong> {$user->password}</p>
                        <br>
                        <p>Regards,<br>Your Adminza Team</p>
                    </body>
                    </html>
                ";

                // Always set content-type when sending HTML email
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

                // More headers
                $headers .= 'From: Adminza <info@honelogixwebsolutions.com>' . "\r\n";

                if (mail($email, $subject, $message, $headers)) {
                    $msg = '<h5 style="color:green">Credentials sent successfully to your email address.</h5>';
                } else {
                    $msg = '<h5 style="color:red">Failed to send email. Please try again later.</h5>';
                }

                $this->session->set_flashdata('res', $msg);
                redirect(ci_site_url() . 'Web/forgetpassword');
                exit();
            } else {
                $msg = '<h5 style="color:red">Email address not found.</h5>';
                $this->session->set_flashdata('res', $msg);
                redirect(ci_site_url() . 'Web/forgetpassword');
                exit();
            }
        }

        _frontLayout('web-mgmt/forgetpassword');
    }

    public function checkuserlogin($username, $password)
    {
        //$username=$this->input->post("username");
        //$password=$this->input->post("password");

        if ($this->auth->userExists($username, $password)) {
            $userdata = [
                'username' => $this->auth->userName,
                'password' => $this->auth->userPassword,
                'SD_User_Name' => $this->auth->SD_User_Name,
                'user_id' => $this->auth->user_id,
                'userpanel_user_id' => $this->auth->userpanel_user_id,
                'member_type' => $this->auth->member_type,
            ];
            $this->db->update('user_registration', ['current_login_status' => '1'], ['user_id' => $this->auth->user_id]);
            //print_r($userdata); exit;
            $userdata['userType'] = 2;
            $userdata['auth_affiliate'] = true;
            $this->session->set_userdata($userdata);
            redirect(ci_site_url() . 'Affiliate/');
            exit();
            exit();
        } else {
            echo $msg = '<h5 style="color:red">Sorry entered username/password is wrong</h5>';
            $this->session->set_flashdata('res', $msg);
            redirect(ci_site_url() . 'login');
            exit();
        }

        _frontLayout('web-mgmt/login');
        //$this->load->view('web-mgmt/login');
    }
    /*
	@mandatory method for all mlm plan i.e generic method
	@desc:It's used to display the Register page
	*/
    public function register_upline($select_id = null, $position = null, $select_ref_id = null)
    {
        if (!empty($select_id)) {
            if ($this->front_model->isUserExist($select_id)) {
                $data['upline_username'] = get_user_name($select_id);
            }
        }
        if (!empty($select_ref_id)) {
            if ($this->front_model->isUserExist($select_ref_id)) {
                $data['replicated_username'] = get_user_name($select_ref_id);
            }
        }
        if (!empty($position)) {
            $data['upline_position'] = $position;
        }

        $data['registration_info'] = !empty($this->session->userdata('registration_info')) && count($this->session->userdata('registration_info')) > 0 ? $this->session->userdata('registration_info') : null;
        if (!empty($ref_id)) {
            $registration_info['sponsor_and_account_info']['ref_id'] = $ref_id;
            $ref_user_info = $this->account_model->getUserDetails($ref_id);
            $registration_info['sponsor_and_account_info']['ref_user_name'] = $ref_user_info->username;
            $data['registration_info'] = $registration_info;
        }
        if (!empty($account_type)) {
            $data['account_type'] = $account_type;
        }
        if ($_GET['pkg']) {
            $pkg = $_GET['pkg'];
            $data['all_active_package'] = $this->db->query("select * from package where status='1' and id='" . $pkg . "'")->result();
        } else {
            $data['all_active_package'] = $this->db->query("select * from package where status='1'")->result();
        }
        //$data['all_active_package']=$this->db->query("select * from package where status='1'")->result();
        $data['all_stockist'] = $this->db->query("select * from user_registration where member_type='2'")->result();
        $data['all_products'] = $this->db->query("select * from eshop_products where featured='1'")->result();
        $data['all_bank'] = $this->db->query('select * from bank_accounts')->result();
        $this->session->unset_userdata('cart_reg');
        $this->session->unset_userdata('cart_reg_final_price');
        $this->session->unset_userdata('total_products');
        //_frontLayout("web-mgmt/register",$data);
        $this->load->view('web-mgmt/register', $data);
    }
    public function register($select_id = null)
    {
        if (!empty($select_id)) {
            if ($this->front_model->isUserExist($select_id)) {
                $data['replicated_username'] = $select_id;
            }
        }
        if (!empty($this->input->post('login'))) {
             //pr($_POST);exit;
            //$this->session->set_userdata($data);
            /////sponsor and account informtaion
            $stockist = $this->input->post('stockist');
            $product = $this->input->post('product');
            $ref_id = $this->input->post('sponsor_id');
            $username = $this->input->post('username');
            $pkg_id = !empty($this->input->post('package')) ? $this->input->post('package') : 1;

            $email = $this->input->post('email');
            $username=$email;
            $password = $this->input->post('password');
            $t_code = $this->input->post('tpassword');
            /*$ref_leg_position=$this->input->post("ref_leg_position");
			
			if($ref_leg_position=='')
			{
				 $this->session->set_flashdata("error_msg", '<span class="text-semibold">Please choose valid position</span>');
				redirect(site_url()."Web/register");
				exit();
				
			}*/

            $condition = $this->input->post('con_sponsor');

            $upline_id = $this->input->post('upline_id');

            if ($condition == 1) {
                $ref_id = '123456';
            } else {
                $ref_id = $ref_id;
            }

            /*$pk_res=$this->db->query("select * from package where id='".$pkg_id."'")->row_array();
			
	     	$pkg_amount=$pk_res['amount'];
	     	
			
			
			$pkg_count=$this->db->select('*')->from('package')->where(array('id'=>$pkg_id))->get()->num_rows();
			
			if($pkg_count==0)
			{
				 $this->session->set_flashdata("error_msg", '<span class="text-semibold">Please choose valid package</span>');
				redirect(site_url()."Web/register");
				exit();
				
			}
			
			
			$sponsor_qry=$this->db->query("select * from user_registration where (username='".$ref_id."' || user_id='".$ref_id."')");
	        $sponsor_count=$sponsor_qry->num_rows();
			$sponsor_result=$sponsor_qry->row_array();
			
			if($sponsor_count==0)
			{
				 $this->session->set_flashdata("error_msg", '<span class="text-semibold">Sponsor not found</span>');
				redirect(site_url()."Web/register");
				exit();	
			}
			
			$upline_qry=$this->db->query("select * from user_registration where (username='".$upline_id."' || user_id='".$upline_id."')");
	        $upline_count=$upline_qry->num_rows();
			$upline_result=$upline_qry->row_array();
			
			if($upline_count==0)
			{
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Upline not found</span>');
				redirect(site_url()."front/register");
				exit();
			}
			
			// check upliner exists or not
			if(!$this->account_model->isUplineUserExist($upline_id))
			{
			    $this->session->set_flashdata("error_msg", '<span class="text-semibold">Wrong Upliner</span>');
				redirect(site_url()."Web/register");
				exit();
			}*/
            $user_count = $this->db
                ->select('*')
                ->from('user_registration')
                ->where(['username' => $username])
                ->get()
                ->num_rows();
            //$user_count1=$this->db->select('*')->from('bank_wired_user_registration')->where(array('username'=>$username))->get()->num_rows();
            if ($user_count == 1) {
                $this->session->set_flashdata('error_msg', '<span class="text-semibold">Username already exist</span>');
                redirect(site_url() . 'Web/register');
                exit();
            }

            $chkpkgcond = $this->db
                ->select('*')
                ->from('user_registration')
                ->where(['username' => $username])
                ->get()
                ->num_rows();

            //$ref_user_info=$this->account_model->getUserDetails($ref_id);
            //$upline_user_info=$this->account_model->getUserDetails($upline_id);

            $account_type = !empty($this->input->post('account_type')) ? $this->input->post('account_type') : '1';
            /////personal informtaion
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $contact_no = $this->input->post('contact_no');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $address_line1 = $this->input->post('address');
            $date_of_birth = $this->input->post('date_of_birth');
            /////Bank account informtaion
            $account_holder_name = !empty($this->input->post('account_holder_name')) ? $this->input->post('account_holder_name') : null;
            $account_no = !empty($this->input->post('account_no')) ? $this->input->post('account_no') : null;
            $bank_name = !empty($this->input->post('bank_name')) ? $this->input->post('bank_name') : null;
            $branch_name = !empty($this->input->post('branch_name')) ? $this->input->post('branch_name') : null;
            // get bank name from bank_id
            $bankinfo = $this->db->select('*')->from('bank_accounts')->where('id', $bank_name)->get()->row();
            $bank_name = $bankinfo->name;
            $branch_name = $bankinfo->iban;

            //////Bit Coin Information/////////////////////
            $bit_coin_id = !empty($this->input->post('bit_coin_id')) ? $this->input->post('bit_coin_id') : null;
            /////////////

            $registration_info = [];
            $registration_info['sponsor_and_account_info'] = [
                'ref_id' => $ref_user_info->user_id,
                'ref_user_name' => $ref_user_info->username,
                'upline_id' => $upline_user_info->user_id,
                'upline_user_name' => $upline_user_info->username,
                'username' => $email,
                'email' => $email,
                'pkg_id' => $pkg_id,
                'pkg_amount' => $pkg_amount,

                'ref_leg_position' => $ref_leg_position,
                'password' => $password,
                't_code' => $t_code,
                'stockist_id' => $stockist,

                'account_type' => $account_type,
                'cart_reg' => json_encode($this->session->userdata('cart_reg')),
                'cart_reg_final_price' => json_encode($this->session->userdata('cart_reg_final_price')),
                'total_products' => json_encode($this->session->userdata('total_products')),
            ];

            $registration_info['personal_info'] = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact_no' => $contact_no,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'address_line1' => $address_line1,
                'date_of_birth' => $date_of_birth,
            ];

            $registration_info['bank_account_info'] = [
                'account_holder_name' => $account_holder_name,
                'account_no' => $account_no,
                'bank_name' => $bank_name,
                'branch_name' => $branch_name,
            ];
            $registration_info['bit_coin_info'] = [
                'bit_coin_id' => $bit_coin_id,
            ];

            $this->session->set_userdata('registration_info', $registration_info);
            //pr($registration_info);exit;
            //redirect(site_url()."payment-method"); exit;
            $user_id = freeUserRegistration();
            if ($user_id) {
                $userdata = [
                    'username' => $username,
                    'password' => $password,
                    'userType' => $account_type,
                    'auth_affiliate' => true,
                    'SD_User_Name' => $username,
                    'user_id' => $user_id,
                    'userpanel_user_id' => $user_id,
                ];
                //print_r($userdata); exit;
                $this->db->update('user_registration', ['current_login_status' => '1'], ['user_id' => $user_id]);
                $this->session->set_userdata($userdata);
                redirect(site_url() . 'dashboard');
                exit();
            }
            redirect(site_url() . 'Web/register');
            exit();
        }
        $data['registration_info'] = !empty($this->session->userdata('registration_info')) && count($this->session->userdata('registration_info')) > 0 ? $this->session->userdata('registration_info') : null;
        /* if(!empty($ref_id))
	     {
	     	$registration_info['sponsor_and_account_info']['ref_id']=$ref_id;
	     	$ref_user_info=$this->account_model->getUserDetails($ref_id);
	     	$registration_info['sponsor_and_account_info']['ref_user_name']=$ref_user_info->username;
	     	$data['registration_info']=$registration_info;
	     }
	     if(!empty($account_type))
	     {
	     	$data['account_type']=$account_type;
	     }
		 if($_GET['pkg'])
		 {
		     $pkg=$_GET['pkg'];
		     $data['all_active_package']=$this->db->query("select * from package where status='1' and id='".$pkg."'")->result();
		 }
		 else
		 {
		     $data['all_active_package']=$this->db->query("select * from package where status='1'")->result();
		 }
		 //$data['all_active_package']=$this->db->query("select * from package where status='1'")->result();
		 $data['all_stockist']=$this->db->query("select * from user_registration where member_type='2'")->result();
		 $data['all_products']=$this->db->query("select * from eshop_products where featured='1'")->result();
		 $data['all_bank']=$this->db->query("select * from bank_accounts")->result();*/
        $this->session->unset_userdata('cart_reg');
        $this->session->unset_userdata('cart_reg_final_price');
        $this->session->unset_userdata('total_products');
        _frontLayout('web-mgmt/register', $data);
        //$this->load->view("web-mgmt/register",$data);
    }
    public function registercheckout($select_id = null)
    {
        if (!empty($select_id)) {
            if ($this->front_model->isUserExist($select_id)) {
                $data['replicated_username'] = $select_id;
            }
        }
        if (!empty($this->input->post('login'))) {
            //pr($_POST);exit;
            //$this->session->set_userdata($data);
            /////sponsor and account informtaion
            $stockist = $this->input->post('stockist');
            $product = $this->input->post('product');
            $ref_id = $this->input->post('sponsor_id');
            $username = $this->input->post('username');
            $pkg_id = !empty($this->input->post('package')) ? $this->input->post('package') : 1;

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $t_code = $this->input->post('tpassword');

            $condition = $this->input->post('con_sponsor');

            $upline_id = $this->input->post('upline_id');

            if ($condition == 1) {
                $ref_id = '123456';
            } else {
                $ref_id = $ref_id;
            }

            $user_count = $this->db
                ->select('*')
                ->from('user_registration')
                ->where(['username' => $username])
                ->get()
                ->num_rows();
            //$user_count1=$this->db->select('*')->from('bank_wired_user_registration')->where(array('username'=>$username))->get()->num_rows();
            if ($user_count == 1) {
                $this->session->set_flashdata('error_msg', '<span class="text-semibold">Username already exist</span>');
                redirect(site_url() . 'Web/register');
                exit();
            }

            $chkpkgcond = $this->db
                ->select('*')
                ->from('user_registration')
                ->where(['username' => $username])
                ->get()
                ->num_rows();

            $account_type = !empty($this->input->post('account_type')) ? $this->input->post('account_type') : '1';
            /////personal informtaion
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $contact_no = $this->input->post('contact_no');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $address_line1 = $this->input->post('address');
            $date_of_birth = $this->input->post('date_of_birth');
            /////Bank account informtaion
            $account_holder_name = !empty($this->input->post('account_holder_name')) ? $this->input->post('account_holder_name') : null;
            $account_no = !empty($this->input->post('account_no')) ? $this->input->post('account_no') : null;
            $bank_name = !empty($this->input->post('bank_name')) ? $this->input->post('bank_name') : null;
            $branch_name = !empty($this->input->post('branch_name')) ? $this->input->post('branch_name') : null;
            // get bank name from bank_id
            $bankinfo = $this->db->select('*')->from('bank_accounts')->where('id', $bank_name)->get()->row();
            $bank_name = $bankinfo->name;
            $branch_name = $bankinfo->iban;

            //////Bit Coin Information/////////////////////
            $bit_coin_id = !empty($this->input->post('bit_coin_id')) ? $this->input->post('bit_coin_id') : null;
            /////////////

            $registration_info = [];
            $registration_info['sponsor_and_account_info'] = [
                'ref_id' => $ref_user_info->user_id,
                'ref_user_name' => $ref_user_info->username,
                'upline_id' => $upline_user_info->user_id,
                'upline_user_name' => $upline_user_info->username,
                'username' => $username,
                'email' => $email,
                'pkg_id' => $pkg_id,
                'pkg_amount' => $pkg_amount,

                'ref_leg_position' => $ref_leg_position,
                'password' => $password,
                't_code' => $t_code,
                'stockist_id' => $stockist,

                'account_type' => $account_type,
                'cart_reg' => json_encode($this->session->userdata('cart_reg')),
                'cart_reg_final_price' => json_encode($this->session->userdata('cart_reg_final_price')),
                'total_products' => json_encode($this->session->userdata('total_products')),
            ];

            $registration_info['personal_info'] = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact_no' => $contact_no,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'address_line1' => $address_line1,
                'date_of_birth' => $date_of_birth,
            ];

            $registration_info['bank_account_info'] = [
                'account_holder_name' => $account_holder_name,
                'account_no' => $account_no,
                'bank_name' => $bank_name,
                'branch_name' => $branch_name,
            ];
            $registration_info['bit_coin_info'] = [
                'bit_coin_id' => $bit_coin_id,
            ];

            $this->session->set_userdata('registration_info', $registration_info);
            //pr($registration_info);exit;
            //redirect(site_url()."payment-method"); exit;
            $user_id = freeUserRegistration();
            if ($user_id) {
                $userdata = [
                    'username' => $username,
                    'password' => $password,
                    'userType' => $account_type,
                    'auth_affiliate' => true,
                    'SD_User_Name' => $username,
                    'user_id' => $user_id,
                    'userpanel_user_id' => $user_id,
                ];
                //print_r($userdata); exit;
                $this->db->update('user_registration', ['current_login_status' => '1'], ['user_id' => $user_id]);
                $this->session->set_userdata($userdata);
                redirect(site_url() . 'checkout');
                exit();
            }
            redirect(site_url() . 'Web/register');
            exit();
        }
        $data['registration_info'] = !empty($this->session->userdata('registration_info')) && count($this->session->userdata('registration_info')) > 0 ? $this->session->userdata('registration_info') : null;

        $this->session->unset_userdata('cart_reg');
        $this->session->unset_userdata('cart_reg_final_price');
        $this->session->unset_userdata('total_products');
        _frontLayout('web-mgmt/register', $data);
        //$this->load->view("web-mgmt/register",$data);
    }
    public function affiliate_login()
    {
        _frontLayout('affiliate-mgmt/affiliate_login');
    }
    public function affiliate_register($select_id = null)
    {
        /*if($this->session->userdata('user_id')){
	        redirect(site_url()."Affiliate");exit;
	    }*/

        if (!empty($select_id)) {
            if ($this->front_model->isUserExist($select_id)) {
                $data['replicated_username'] = $select_id;
            }
        }
        if (!empty($this->input->post('btn'))) {
            // pr($_POST);exit;
            //$this->session->set_userdata($data);
            /////sponsor and account informtaion
            $ref_id = $this->input->post('sponsor_id');
            $username = $this->input->post('username');
            $pkg_id = !empty($this->input->post('package')) ? $this->input->post('package') : 1;

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $t_code = $this->input->post('tpassword');
            $ref_leg_position = $this->input->post('ref_leg_position');

            $condition = $this->input->post('con_sponsor');

            $upline_id = $this->input->post('upline_id');

            if ($condition == 1) {
                $ref_id = '123456';
            } else {
                $ref_id = $ref_id;
            }

            $pk_res = $this->db->query("select * from package where id='" . $pkg_id . "'")->row_array();

            $pkg_amount = $pk_res['amount'];

            $pkg_count = $this->db
                ->select('*')
                ->from('package')
                ->where(['id' => $pkg_id])
                ->get()
                ->num_rows();

            if ($pkg_count == 0) {
                $this->session->set_flashdata('error_msg', '<span class="text-semibold">Please choose valid package</span>');
                redirect(site_url() . 'Web/register');
                exit();
            }

            $sponsor_qry = $this->db->query("select * from user_registration where (username='" . $ref_id . "' || user_id='" . $ref_id . "')");
            $sponsor_count = $sponsor_qry->num_rows();
            $sponsor_result = $sponsor_qry->row_array();

            if ($sponsor_count == 0) {
                $this->session->set_flashdata('error_msg', '<span class="text-semibold">Sponsor not found</span>');
                redirect(site_url() . 'Web/register');
                exit();
            }

            /*$upline_qry=$this->db->query("select * from user_registration where (username='".$upline_id."' || user_id='".$upline_id."')");
	        $upline_count=$upline_qry->num_rows();
			$upline_result=$upline_qry->row_array();
			
			if($upline_count==0)
			{
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Upline not found</span>');
				redirect(site_url()."front/register");
				exit();
			}*/

            $user_count = $this->db
                ->select('*')
                ->from('user_login')
                ->where(['username' => $username])
                ->get()
                ->num_rows();

            if ($user_count == 1) {
                $this->session->set_flashdata('error_msg', '<span class="text-semibold">Username already exist</span>');
                redirect(site_url() . 'Web/register');
                exit();
            }

            $chkpkgcond = $this->db
                ->select('*')
                ->from('user_registration')
                ->where(['username' => $username])
                ->get()
                ->num_rows();

            $ref_user_info = $this->account_model->getUserDetails($ref_id);
            //$upline_user_info=$this->account_model->getUserDetails($upline_id);

            $account_type = !empty($this->input->post('account_type')) ? $this->input->post('account_type') : '1';
            /////personal informtaion
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $contact_no = $this->input->post('contact_no');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $address_line1 = $this->input->post('address');
            $date_of_birth = $this->input->post('date_of_birth');
            /////Bank account informtaion
            $account_holder_name = !empty($this->input->post('account_holder_name')) ? $this->input->post('account_holder_name') : null;
            $account_no = !empty($this->input->post('account_no')) ? $this->input->post('account_no') : null;
            $bank_name = !empty($this->input->post('bank_name')) ? $this->input->post('bank_name') : null;
            $branch_name = !empty($this->input->post('branch_name')) ? $this->input->post('branch_name') : null;
            //////Bit Coin Information/////////////////////
            $bit_coin_id = !empty($this->input->post('bit_coin_id')) ? $this->input->post('bit_coin_id') : null;
            /////////////

            $registration_info = [];
            $registration_info['sponsor_and_account_info'] = [
                'ref_id' => $ref_user_info->user_id,
                'ref_user_name' => $ref_user_info->username,

                'username' => $username,
                'email' => $email,
                'pkg_id' => $pkg_id,
                'pkg_amount' => $pkg_amount,

                'ref_leg_position' => $ref_leg_position,
                'password' => $password,
                't_code' => $t_code,
                'account_type' => $account_type,
            ];

            $registration_info['personal_info'] = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'contact_no' => $contact_no,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'address_line1' => $address_line1,
                'date_of_birth' => $date_of_birth,
            ];

            $registration_info['bank_account_info'] = [
                'account_holder_name' => $account_holder_name,
                'account_no' => $account_no,
                'bank_name' => $bank_name,
                'branch_name' => $branch_name,
            ];
            $registration_info['bit_coin_info'] = [
                'bit_coin_id' => $bit_coin_id,
            ];

            $this->session->set_userdata('registration_info', $registration_info);
            //pr($registration_info);exit;
            //redirect(site_url()."payment-method"); exit;
            $user_id = affiliateUserRegistration();
            if ($user_id) {
                $userdata = [
                    'username' => $username,
                    'password' => $password,
                    'userType' => 2,
                    'auth_affiliate' => true,
                    'SD_User_Name' => $username,
                    'user_id' => $user_id,
                    'userpanel_user_id' => $user_id,
                    'member_type' => 1,
                ];
                //print_r($userdata); print_r($_SESSION);die;
                $this->db->update('user_registration', ['current_login_status' => '1'], ['user_id' => $user_id]);
                $this->session->set_userdata($userdata);
                redirect(site_url() . 'Affiliate');
                exit();
            }
            redirect(site_url() . 'Web/register');
            exit();
        }
        $data['registration_info'] = !empty($this->session->userdata('registration_info')) && count($this->session->userdata('registration_info')) > 0 ? $this->session->userdata('registration_info') : null;
        if (!empty($ref_id)) {
            $registration_info['sponsor_and_account_info']['ref_id'] = $ref_id;
            $ref_user_info = $this->account_model->getUserDetails($ref_id);
            $registration_info['sponsor_and_account_info']['ref_user_name'] = $ref_user_info->username;
            $data['registration_info'] = $registration_info;
        }
        if (!empty($account_type)) {
            $data['account_type'] = $account_type;
        }

        $data['all_active_package'] = $this->db->query("select * from package where status='1'")->result();

        _frontLayout('affiliate-mgmt/affiliate_register', $data);
        //$this->load->view("front-mgmt/register",$data);
    }

    public function registerUserViaEwallet()
    {
        // check sponsor password
        //pr($_POST);

        $sponsor_user_name = $this->input->post('sponsor_user_name');
        $sponsor_password = $this->input->post('sponsor_transaction_password');
        // check spsonor username and password
        $count = $this->db
            ->select('user_id')
            ->from('user_login')
            ->where(['username' => $sponsor_user_name, 't_code' => $sponsor_password])
            ->get()
            ->num_rows();
        //echo $count; exit;
        if ($count > 0) {
            // registerr user via ewallet
            $registration_info = $this->session->userdata('registration_info');
            //pr($registration_info);
            $sponser_id = !empty($registration_info['sponsor_and_account_info']['ref_id']) ? $registration_info['sponsor_and_account_info']['ref_id'] : '123456';
            $username = !empty($registration_info['sponsor_and_account_info']['username']) ? $registration_info['sponsor_and_account_info']['username'] : '123456';
            $pkg_id = !empty($registration_info['sponsor_and_account_info']['pkg_id']) ? $registration_info['sponsor_and_account_info']['pkg_id'] : 1;
            $pkg_amount = !empty($registration_info['sponsor_and_account_info']['pkg_amount']) ? $registration_info['sponsor_and_account_info']['pkg_amount'] : 10000;
            //deduct amount from sponsor wallet
            $sinfo = $this->db
                ->select('user_id')
                ->from('user_login')
                ->where(['username' => $sponsor_user_name, 't_code' => $sponsor_password])
                ->get()
                ->row();
            $sponser_id = $sinfo->user_id;

            // check username already exists or not
            $countuser = $this->db
                ->select('user_id')
                ->from('user_login')
                ->where(['username' => $username])
                ->get()
                ->num_rows();
            if ($countuser) {
                $this->session->set_flashdata('error_msg', '<span class="text-semibold">User already register</span>');
                redirect(site_url() . 'Web/register');
                exit();
            }
            // check user wallet have balance or not
            $query_obj = $this->db
                ->select('amount')
                ->from('final_product_wallet')
                ->where(['user_id' => $sponser_id])
                ->get()
                ->row();
            //echo $query_obj->amount.">=".$pkg_amount; exit;
            if ($query_obj->amount >= $pkg_amount) {
                //echo "Success"; exit;
                $query_obj = $this->db
                    ->select('amount')
                    ->from('final_product_wallet')
                    ->where(['user_id' => $sponser_id])
                    ->get()
                    ->row();
                $balance = $query_obj->amount - $pkg_amount;
                $this->db->update('final_product_wallet', ['amount' => $balance], ['user_id' => $sponser_id]);
                $this->db->insert('credit_debit_product', [
                    'transaction_no' => generateUniqueTranNo(),
                    'user_id' => $sponser_id,
                    'credit_amt' => '0',
                    'debit_amt' => $pkg_amount,
                    'balance' => $balance,
                    'receiver_id' => $username,
                    'sender_id' => $sponser_id,
                    'receive_date' => date('Y-m-d'),
                    'ttype' => 'Package Purchased',
                    'TranDescription' => 'Package Purchase by ' . $username,
                    'Cause' => 'Package Purchase by ' . $username,
                    'Remark' => 'Package Purchase by ' . $username,
                    'product_name' => 'main',
                    'deposit_id' => 1,
                    'status' => '0',
                    'ewallet_used_by' => 'Withdrawal Wallet',
                    'current_url' => ci_site_url(),
                    'reason' => '10',
                ]);
                $cdid = $this->db->insert_id();
                $user_id = affiliateUserRegistration();
                //echo $user_id; exit;
                if ($user_id) {
                    $this->db->update('credit_debit_product', ['receiver_id' => $user_id], ['id' => $cdid]);
                    $userdata = [
                        'username' => $username,
                        'password' => $password,
                        'userType' => 2,
                        'auth_affiliate' => true,
                        'SD_User_Name' => $username,
                        'user_id' => $user_id,
                        'userpanel_user_id' => $user_id,
                        'member_type' => 1,
                    ];
                    //print_r($userdata); print_r($_SESSION);die;
                    $this->db->update('user_registration', ['current_login_status' => '1'], ['user_id' => $user_id]);
                    $this->session->set_userdata($userdata);
                    redirect(site_url() . 'Affiliate');
                    echo "<script>
                        window.location.href = '" . base_url() . "Affiliate'
                    </script>";
                    exit();
                }
            } else {
                $this->session->set_flashdata('error_msg', '<span class="text-semibold">Sponsor does not have sufficient fund in transaction wallet.</span>');
                redirect(site_url() . 'ewallet-payment');
                exit();
            }
        } else {
            // error
            $this->session->set_flashdata('error_msg', '<span class="text-semibold">Please enter valid transaction password</span>');
            redirect(site_url() . 'ewallet-payment');
            exit();
        }
    }
    /*
	@Desc: It's used to upload bank wire proof
	*/
    public function uploadBankWireProof($username = null)
    {
        $data['username'] = $username;
        if (!empty($this->input->post('btn'))) {
            $username = $this->input->post('username');
            $total_rows = $this->db
                ->select('id')
                ->from('bank_wired_user_registration')
                ->where(['username' => $username, 'status !=' => '1'])
                ->get()
                ->num_rows();
            if ($total_rows > 0) {
                $image_upload_path = '/images/';
                $proof = adImageUpload($_FILES['proof'], 1, $image_upload_path);
                $this->db->update('bank_wired_user_registration', ['proof' => $proof], ['username' => $username, 'status !=' => '1']);
                $this->session->set_flashdata('flash_msg', "<h3 style='color:green;font-weight:bold'>Proof is uploaded successfully</h3>");
                redirect(site_url() . 'Web/uploadBankWireProof/' . $username);
            } else {
                redirect(site_url() . 'Web/uploadBankWireProof/' . $username);
            }
        }
        _frontLayout('web-mgmt/upload-bank-wire-proof', $data);
    }

    public function showApiKey()
    {
        $api_key = $this->getApiKey();
        echo $api_key;
    }
    public function getApiKey()
    {
        // Load the Requests library
        $this->load->library('requests');

        // Make a POST request
        $response = requests::post(
            'https://velso.thyrocare.cloud/api/Login/Login',
            [],
            [
                'username' => '9372567969',
                'password' => 'Pass@123',
                'portalType' => 'DSA',
                'userType' => 'DSA',
                'facebookId' => '',
                'mobile' => '',
            ],
        );

        // Decode the JSON response
        $responseBody = json_decode($response->body);

        // Check if the response is not null and if it has the apiKey property
        if ($responseBody && isset($responseBody->apiKey)) {
            return $responseBody->apiKey;
        } else {
            return null; // Or handle the error according to your logic
        }
    }
    public function send_email()
    {
        $this->load->library('email');

        $response = ['success' => false, 'message' => 'An error occurred.'];

        // Validate input
        $name = $this->input->post('name', true);
        $email = $this->input->post('email', true);
        $telephone = $this->input->post('telephone', true);
        $subject = $this->input->post('subject', true);
        $message = $this->input->post('message', true);

        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            $response['message'] = 'All fields are required.';
            echo json_encode($response);
            return;
        }

        // Configure email settings
        $this->email->from('info@honelogixwebsolutions.com');
        $this->email->to('info@honelogixwebsolutions.com'); // Replace with your email address
        $this->email->subject('Contact Form Submission: ' . $subject);
        $this->email->message("Name: $name\nEmail: $email\nPhone: $telephone\n\nMessage:\n$message");

        // Send email
        if ($this->email->send()) {
            $response['success'] = true;
            $response['message'] = 'Email sent successfully.';
        } else {
            $response['message'] = 'Failed to send email.';
        }

        echo json_encode($response);
    }
    public function serviceproduct($id)
    {
        $data = [];
        $p = $this->db->select('*')->from('eshop_service_products')->where('id', $id)->get()->row();
        $data['products'] = $p;
        _frontLayout('web-mgmt/serviceproduct', $data);
    }
    public function submitenquiry()
    {
        // Load form validation library
        $this->load->library('form_validation');

        // Validate form inputs
        $this->form_validation->set_rules('service', 'Service', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        if ($this->form_validation->run() == false) {
            // Validation failed
            echo json_encode([
                'success' => false,
                'message' => validation_errors(),
            ]);
            return;
        }

        // Prepare data for insertion
        $data = [
            'service_name' => $this->input->post('service'),
            'service_id' => $this->input->post('serviceid'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'message' => $this->input->post('message'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Insert into database
        if ($this->db->insert('enquiries', $data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to submit the enquiry. Please try again.',
            ]);
        }
    }
    public function fetch_products()
    {
        $query = $this->input->post('query');
        $category = $this->input->post('category');
        $this->db->select('id, title, product_image, parent_category_id,category_id,subcat_id');
        $this->db->from('eshop_products');
        //$this->db->where('status', '1'); // Only active products

        if (!empty($query)) {
            $this->db->like('title', $query);
        }
        if (!empty($category)) {
            $this->db->where('parent_category_id', $category);
        }

        $products = $this->db->get()->result();
        //echo $this->db->last_query();

        if (!empty($products)) {
            foreach ($products as $row) {
                // Initialize variables for each loop iteration
                $category_id = '';
                $subcat_id = '';

                if (!empty($row->category_id)) {
                    $category_id = '/' . $row->category_id;
                }
                if (!empty($row->subcat_id)) {
                    $subcat_id = '/' . $row->subcat_id;
                }

                // Construct URL properly
                $url = $row->parent_category_id . $category_id . $subcat_id;
                //echo $url;

                echo "<div style='padding: 10px; border-bottom: 1px solid #ccc; display: flex; align-items: center;'>
                        <img src='" .
                    base_url('product_images/' . $row->product_image) .
                    "' width='50' height='50' style='margin-right: 10px;'>
                        <a href='" .
                    base_url('Web/servicelist/') .
                    $url .
                    "'>" .
                    htmlspecialchars($row->title, ENT_QUOTES, 'UTF-8') .
                    "</a>
                      </div>";
            }
        } else {
            echo "<div style='padding: 10px;'>No data found.</div>";
        }
    }
    public function user_save_changes()
    {
        if (!$this->input->is_ajax_request()) {
            show_error('No direct access allowed');
        }

        $user_id = $this->input->post('user_id', true);

        if (empty($user_id)) {
            echo json_encode(['status' => 'error', 'message' => 'User ID missing!']);
            return;
        }

        // Get current password from DB
        $user = $this->front_model->get_user_by_id($user_id);

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'User not found!']);
            return;
        }

        $current_password_input = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        // Build update data
        $data = [
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'contact_no' => $this->input->post('contact_no', true),
            'email' => $this->input->post('email', true),
        ];

        if (!empty($current_pwd)) {
            if ($current_pwd !== $user->password) {
                echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect!']);
                return;
            }

            if ($new_pwd !== $confirm_pwd) {
                echo json_encode(['status' => 'error', 'message' => 'New and confirm password do not match!']);
                return;
            }

            $data['password'] = $new_pwd; // directly store new plain password
        }

        // Run update
        $update = $this->front_model->update_user($user_id, $data);

        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No changes made or update failed!']);
        }
    }
    public function user_update_address()
    {
        if (!$this->input->is_ajax_request()) {
            show_error('No direct access allowed');
        }

        $user_id = $this->input->post('user_id', true);

        if (empty($user_id)) {
            echo json_encode(['status' => 'error', 'message' => 'User ID missing!']);
            return;
        }

        $data = [
            'address_line1' => $this->input->post('address_line1', true),
            'address_line2' => $this->input->post('address_line2', true),
            'country' => $this->input->post('country', true),
            'state' => $this->input->post('state', true),
            'city' => $this->input->post('city', true),
            'zip_code' => $this->input->post('zip_code', true),
        ];

        $update = $this->front_model->update_user($user_id, $data);

        if ($update) {
            echo json_encode(['status' => 'success', 'message' => 'Address updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No changes made or update failed!']);
        }
    }

    public function product_add()
    {
        $data['categories'] = $this->db->get('eshop_category')->result();
        _frontLayout('web-mgmt/product_add', $data);
    }

    public function product_store()
    {
        if ($this->input->post()) {
            // IMAGE UPLOAD FUNCTION
            $basic_image = '';
            if (!empty($_FILES['basic_image']['name'])) {
                $config = [
                    'upload_path' => './uploads/products/basic/',
                    'allowed_types' => 'jpg|jpeg|png|webp',
                    'file_name' => time() . '_basic',
                ];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('basic_image')) {
                    $basic_image = $this->upload->data('file_name');
                }
            }

            // PRO IMAGE
            $pro_image = '';
            if (!empty($_FILES['pro_image']['name'])) {
                $config = [
                    'upload_path' => './uploads/products/pro/',
                    'allowed_types' => 'jpg|jpeg|png|webp',
                    'file_name' => time() . '_pro',
                ];
                $this->upload->initialize($config);

                if ($this->upload->do_upload('pro_image')) {
                    $pro_image = $this->upload->data('file_name');
                }
            }

            // ENTERPRISE IMAGE
            $enterprise_image = '';
            if (!empty($_FILES['enterprise_image']['name'])) {
                $config = [
                    'upload_path' => './uploads/products/enterprise/',
                    'allowed_types' => 'jpg|jpeg|png|webp',
                    'file_name' => time() . '_enterprise',
                ];
                $this->upload->initialize($config);

                if ($this->upload->do_upload('enterprise_image')) {
                    $enterprise_image = $this->upload->data('file_name');
                }
            }
            // INSERT DATA
            $data = [
                'category_id' => $this->input->post('category_id'),
                'title' => $this->input->post('product_name'),

                'price1' => $this->input->post('basic_price'),
                'description' => $this->input->post('basic_description'),
                'basic_image' => $basic_image,

                'price2' => $this->input->post('pro_price'),
                'description2' => $this->input->post('pro_description'),
                'product_image' => $pro_image,

                'price3' => $this->input->post('enterprise_price'),
                'long_description' => $this->input->post('enterprise_description'),
                'enterprise_image' => $enterprise_image,

                'created_date' => date('Y-m-d H:i:s'),
            ];

            $this->db->insert('eshop_products', $data);

            $this->session->set_flashdata('success', 'Product added successfully');
            redirect('dashboard#');
        }
    }
    private function getClient()
    {
        $client = new Google_Client();
		$this->config->load('google');
		$client->setClientId($this->config->item('google_client_id'));
    	$client->setClientSecret($this->config->item('google_client_secret'));

        // ⚠️ EXACT redirect URI (Google console me bhi same hona chahiye)
        $client->setRedirectUri('http://localhost/bizkits/webgooglemeet/callback');

        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        return $client;
    }

    public function index_google()
    {
        $client = $this->getClient();
        redirect($client->createAuthUrl());
    }

    public function callback()
    {
        if (!isset($_GET['code'])) {
            redirect('/');
        }

        $client = $this->getClient();
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        if (isset($token['error'])) {
            print_r($token);
            exit();
        }

        $_SESSION['access_token'] = $token;

        // 🔥 redirect back to meeting create
        $request_id = $_SESSION['request_id'];
        redirect('webgooglemeet/createMeeting/' . $request_id);
    }

    // STEP 3: Create Meet
    // public function createMeeting() {
    // 	if ($this->input->server('REQUEST_METHOD') == 'POST') {

    // 		// Form values
    // 		$date = $this->input->post('meet_date');
    // 		$start_time = $this->input->post('start_time');
    // 		$end_time = $this->input->post('end_time');

    // 		if (!$date || !$start_time || !$end_time) {
    // 			$this->session->set_flashdata('error', 'All fields are required');
    // 			redirect('webgooglemeet/form');
    // 		}

    // 		if (empty($_SESSION['access_token'])) {
    // 			redirect('webgooglemeet');
    // 		}

    // 		$client = $this->getClient();
    // 		$client->setAccessToken($_SESSION['access_token']);

    // 		if ($client->isAccessTokenExpired()) {
    // 			unset($_SESSION['access_token']);
    // 			redirect('webgooglemeet');
    // 		}

    // 		$service = new Google_Service_Calendar($client);

    // 		$startDateTime = date('c', strtotime("$date $start_time"));
    // 		$endDateTime = date('c', strtotime("$date $end_time"));

    // 		$event = new Google_Service_Calendar_Event([
    // 			'summary' => 'Bizkits Google Meet',
    // 			'description' => 'Meeting from CodeIgniter',
    // 		}

    // 		$client = $this->getClient();
    // 		$client->setAccessToken($_SESSION['access_token']);

    // 		if ($client->isAccessTokenExpired()) {
    // 			unset($_SESSION['access_token']);
    // 			redirect('webgooglemeet');
    // 		}

    // 		$service = new Google_Service_Calendar($client);

    // 		$startDateTime = date('c', strtotime("$date $start_time"));
    // 		$endDateTime = date('c', strtotime("$date $end_time"));

    // 		$event = new Google_Service_Calendar_Event([
    // 			'summary' => 'Bizkits Google Meet',
    // 			'description' => 'Meeting from CodeIgniter',
    // 			'start' => [
    // 				'dateTime' => $startDateTime,
    // 				'timeZone' => 'Asia/Kolkata',
    // 			],
    // 			'end' => [
    // 				'dateTime' => $endDateTime,
    // 				'timeZone' => 'Asia/Kolkata',
    // 			],
    // 			'attendees' => [
    // 				['email' => 'npcoder2002@gmail.com'] // Sirf host
    // 			],
    // 			'conferenceData' => [
    // 				'createRequest' => [
    // 					'requestId' => uniqid(),
    // 					'conferenceSolutionKey' => [
    // 						'type' => 'hangoutsMeet'
    // 					],
    // 				],
    // 			],
    // 		]);

    // 		$event = $service->events->insert(
    // 			'primary',
    // 			$event,
    // 			['conferenceDataVersion' => 1]
    // 		);

    // 		$data['event'] = $event;
    // 		_frontLayout("web-mgmt/google_meet",$data);

    // 	} else {
    // 		// Agar GET request hai, form dikhaye
    // 		_frontLayout("web-mgmt/google_meet_form", []);
    // 	}
    // }
    public function createMeeting($request_id)
    {
        // 1️⃣ Get meeting request
        $request = $this->db->where('id', $request_id)->get('customer_meeting_requests')->row();

        if (!$request) {
            redirect('expert/meeting_requests');
        }

        // 2️⃣ Google Auth check
        if (empty($_SESSION['access_token'])) {
            $_SESSION['request_id'] = $request_id;
            redirect('webgooglemeet/index_google');
        }

        $client = $this->getClient();
        $client->setAccessToken($_SESSION['access_token']);

        if ($client->isAccessTokenExpired()) {
            unset($_SESSION['access_token']);
            $_SESSION['request_id'] = $request_id;
            // 
            $user_id=$request->customer_id;
            $callusercount=$this->db->select('*')->from('user_calls')->where('user_id',$user_id)->get()->num_rows();
                    if($callusercount)
                    {
                        $calluser_info=$this->db->select('*')->from('user_calls')->where('user_id',$user_id)->get()->row();
                        $callid=$calluser_info->id;
                        $used_calls1=$calluser_info->used_calls-1;
                        $remaining_calls1=$calluser_info->remaining_calls-1;
                        $this->db->update('user_calls',array('used_calls'=>$used_calls1,'remaining_calls'=>$remaining_calls1),array('id'=>$callid));
                    }
            redirect('webgooglemeet/index_google');
        }

        // 3️⃣ Google Meet create
        $service = new Google_Service_Calendar($client);

        $start = date('c', strtotime($request->requested_date . ' 10:00'));
        $end = date('c', strtotime($request->requested_date . ' 11:00'));

        $event = new Google_Service_Calendar_Event([
            'summary' => $request->title,
            'description' => $request->message,
            'start' => [
                'dateTime' => $start,
                'timeZone' => 'Asia/Kolkata',
            ],
            'end' => [
                'dateTime' => $end,
                'timeZone' => 'Asia/Kolkata',
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid(),
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet',
                    ],
                ],
            ],
        ]);

        $event = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

        $meet_link = $event->getHangoutLink();

        // 4️⃣ Update DB
        $this->db->where('id', $request_id)->update('customer_meeting_requests', [
            'meet_link' => $meet_link,
            'status' => 'approved',
        ]);
        $user_id=$request->customer_id;
        //echo $user_id; exit;
            $callusercount=$this->db->select('*')->from('user_calls')->where('user_id',$user_id)->get()->num_rows();
                    if($callusercount)
                    {
                        $calluser_info=$this->db->select('*')->from('user_calls')->where('user_id',$user_id)->get()->row();
                        $callid=$calluser_info->id;
                        $used_calls1=$calluser_info->used_calls+1;
                        $remaining_calls1=$calluser_info->remaining_calls-1;
                        $this->db->update('user_calls',array('used_calls'=>$used_calls1,'remaining_calls'=>$remaining_calls1),array('id'=>$callid));
                    }
        
        // 5️⃣ Email customer
        // $this->send_meet_email($request->customer_id, $meet_link);

        redirect('dashboard#google_meet');
    }

    // 	public function approve($request_id)
    // {
    //     // 1️⃣ Get request details
    //     $request = $this->db
    //         ->where('id', $request_id)
    //         ->get('customer_meeting_requests')
    //         ->row();

    //     if(!$request) redirect('expert/meeting_requests');

    //     // 2️⃣ Google auth check
    //     if (empty($_SESSION['access_token'])) {
    //         redirect('webgooglemeet/index_google?req_id='.$request_id);
    //     }

    //     $client = $this->getClient();
    //     $client->setAccessToken($_SESSION['access_token']);

    //     if ($client->isAccessTokenExpired()) {
    //         unset($_SESSION['access_token']);
    //         redirect('webgooglemeet/index_google?req_id='.$request_id);
    //     }

    //     // 3️⃣ Create Google Meet
    //     $service = new Google_Service_Calendar($client);

    //     $start = date('c', strtotime($request->requested_date.' 10:00'));
    //     $end   = date('c', strtotime($request->requested_date.' 11:00'));

    //     $event = new Google_Service_Calendar_Event([
    //         'summary' => $request->title,
    //         'description' => $request->message,
    //         'start' => ['dateTime' => $start, 'timeZone' => 'Asia/Kolkata'],
    //         'end'   => ['dateTime' => $end,   'timeZone' => 'Asia/Kolkata'],
    //         'conferenceData' => [
    //             'createRequest' => [
    //                 'requestId' => uniqid(),
    //                 'conferenceSolutionKey' => ['type' => 'hangoutsMeet']
    //             ]
    //         ]
    //     ]);

    //     $event = $service->events->insert(
    //         'primary',
    //         $event,
    //         ['conferenceDataVersion' => 1]
    //     );

    //     $meet_link = $event->getHangoutLink();

    //     // 4️⃣ Update DB
    //     $this->db->where('id', $request_id)->update('customer_meeting_requests', [
    //         'status' => 'approved',
    //         'meet_link' => $meet_link
    //     ]);

    //     // 5️⃣ Send Email to customer
    //     $this->send_meet_email($request->customer_id, $meet_link);

    //     redirect('dashboard#google_meet');
    // }

    public function meetvideo()
    {
        $data['room'] = 'NeerajMeeting123';
        _frontLayout('web-mgmt/meet_view', $data);
    }
    public function room($room_name)
    {
        $data['room'] = $room_name;
        _frontLayout('web-mgmt/meet_view', $data);
    }

    public function save_event()
    {
        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'event_date' => $this->input->post('event_date'),
            'user_id' => $this->input->post('user_id'),
        ];

        $id = $this->input->post('id');

        if ($id) {
            $this->db->where('id', $id)->update('expert_events', $data);
        } else {
            $this->db->insert('expert_events', $data);
        }

        echo json_encode(['status' => true]);
    }
    public function get_event($id)
    {
        $event = $this->db->where('id', $id)->get('expert_events')->row();

        if ($event) {
            echo json_encode([
                'status' => true,
                'data' => $event,
            ]);
        } else {
            echo json_encode([
                'status' => false,
            ]);
        }
    }
    public function delete_event($id)
    {
        // Optional: user security
        $this->db->where('id', $id);
        $this->db->where('user_id', $_SESSION['user_id']);

        if ($this->db->delete('expert_events')) {
            echo json_encode([
                'status' => true,
                'msg' => 'Event deleted',
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg' => 'Unable to delete event',
            ]);
        }
    }

    public function fetch_events()
    {
        $expert_id = $this->session->userdata('user_id');

        // Expert ke events
        $events = $this->db->where('user_id', $expert_id)->get('expert_events')->result();

        $data = [];

        foreach ($events as $row) {
            // 🔹 Is event ke bookings
            $booked_users = $this->db->select('*')->from('customer_exper_book')->get()->result();

            $booked_users = [];
            foreach ($bookings as $b) {
                $booked_users[] = $b->name;
            }

            $data[] = [
                'id' => $row->id,
                'title' => $row->title,
                'start' => $row->event_date,
                'description' => $row->description,
                'booked_users' => $booked_users, // 👈 IMPORTANT
                'booking_count' => count($booked_users),
            ];
        }

        echo json_encode($data);
    }

    public function get_expert_events($expert_id)
    {
        $current_user = $this->session->userdata('user_id');

        $events = $this->db
            ->select(
                '
            e.id,
            e.title,
            e.description,
            e.event_date,
            b.user_id AS booked_user
        ',
            )
            ->from('expert_events e')
            ->join('customer_exper_book b', 'b.event_id = e.id', 'left')
            ->where('e.user_id', $expert_id)
            ->get()
            ->result();

        $data = [];

        foreach ($events as $e) {
            $data[] = [
                'id' => $e->id,
                'title' => $e->title,
                'description' => $e->description,
                'start' => $e->event_date,

                // 👇 booking related (IMPORTANT)
                'booked_by' => $e->booked_user, // null ya user_id
                'is_my_booking' => $e->booked_user == $current_user,
            ];
        }

        echo json_encode($data);
    }

    public function book_event()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => false, 'msg' => 'Login required']);
            return;
        }

        $event_id = $this->input->post('event_id');
        $user_id = $this->session->userdata('user_id');

        // ❌ Already booked?
        $exists = $this->db->where('event_id', $event_id)->get('customer_exper_book')->row();

        if ($exists) {
            echo json_encode(['status' => false, 'msg' => 'Already booked']);
            return;
        }

        $event = $this->db->where('id', $event_id)->get('expert_events')->row();

        $this->db->insert('customer_exper_book', [
            'event_id' => $event_id,
            'user_id' => $user_id,
            'booking_date' => $event->event_date,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        echo json_encode(['status' => true, 'msg' => 'Booking successful']);
    }
    public function cancel_booking()
    {
        // 🔐 Login check
        if (!$this->session->userdata('user_id')) {
            echo json_encode([
                'status' => false,
                'msg' => 'Login required',
            ]);
            return;
        }

        $event_id = $this->input->post('event_id');
        $user_id = $this->session->userdata('user_id');

        if (empty($event_id)) {
            echo json_encode([
                'status' => false,
                'msg' => 'Event ID missing',
            ]);
            return;
        }

        // 🗑️ DELETE booking
        $this->db->where('event_id', $event_id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('customer_exper_book');

        // ✅ Check delete hua ya nahi
        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'status' => true,
                'msg' => 'Booking cancelled successfully',
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg' => 'No booking found to cancel',
            ]);
        }
    }

    public function customer_calendar_events()
    {
        $customer_id = $this->session->userdata('user_id');

        $events = $this->db->where('customer_id', $customer_id)->get('customer_meeting_requests')->result();

        $data = [];

        foreach ($events as $e) {
            // 🎨 Status wise color
            $color = '#f0ad4e'; // pending
            if ($e->status == 'approved') {
                $color = '#5cb85c';
            }
            if ($e->status == 'rejected') {
                $color = '#d9534f';
            }
            $meetBtn = '';
            if ($e->status == 'approved' && !empty($e->meet_link)) {
                $meetBtn =
                    '
                <a href="' .
                    $e->meet_link .
                    '" 
                   target="_blank" 
                   class="btn btn-success btn-sm mt-2">
                   Join Google Meet
                </a>
            ';
            }

            $data[] = [
                'id' => $e->id,

                // 👇 Calendar title
                'title' => $e->title . ' (' . ucfirst($e->status) . ')',

                // 👇 Calendar date
                'start' => $e->requested_date,

                // 👇 Calendar color
                'color' => $color,

                // 👇 EXTRA DATA (date click me use hoga)
                'status' => $e->status,
                'message' => $e->message,
                'meet_link' => $meetBtn,
            ];
        }

        echo json_encode($data);
    }
	public function expert_calendar_events()
    {
        $customer_id = $this->session->userdata('user_id');

        $events = $this->db->where('expert_id', $customer_id)->get('customer_meeting_requests')->result();

        $data = [];

        foreach ($events as $e) {
            // 🎨 Status wise color
            $color = '#f0ad4e'; // pending
            if ($e->status == 'approved') {
                $color = '#5cb85c';
            }
            if ($e->status == 'rejected') {
                $color = '#d9534f';
            }
            $meetBtn = '';
            if ($e->status == 'approved' && !empty($e->meet_link)) {
                $meetBtn =
                    '
                <a href="' .
                    $e->meet_link .
                    '" 
                   target="_blank" 
                   class="btn btn-success btn-sm mt-2">
                   Join Google Meet
                </a>
            ';
            }

            $data[] = [
                'id' => $e->id,

                // 👇 Calendar title
                'title' => $e->title . ' (' . ucfirst($e->status) . ')',

                // 👇 Calendar date
                'start' => $e->requested_date,

                // 👇 Calendar color
                'color' => $color,

                // 👇 EXTRA DATA (date click me use hoga)
                'status' => $e->status,
                'message' => $e->message,
                'meet_link' => $meetBtn,
            ];
        }

        echo json_encode($data);
    }

    public function send_request()
    {
        $this->db->insert('customer_meeting_requests', [
            'customer_id' => $this->session->userdata('user_id'),
            'expert_id' => $this->input->post('expert_id'),
            'requested_date' => $this->input->post('date'),
            'title' => $this->input->post('title'),
            'message' => $this->input->post('message'),
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        echo json_encode([
            'status' => true,
            'msg' => 'Meeting request sent',
        ]);
    }

    public function meeting_reject($request_id)
    {
        // 🔐 expert login check
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $expert_id = $this->session->userdata('user_id');

        // ✔️ security: sirf apni request reject ho
        $request = $this->db->where('id', $request_id)->where('expert_id', $expert_id)->get('customer_meeting_requests')->row();

        if (!$request) {
            show_error('Invalid request');
        }

        // ❌ Reject request
        $this->db->where('id', $request_id)->update('customer_meeting_requests', [
            'status' => 'rejected',
            'meet_link' => null,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_flashdata('success', 'Meeting request rejected');
        redirect('dashboard#google_meet');
    }

    private function getToken()
{
    $this->config->load('paypal');

    $client_id = $this->config->item('paypal_client_id');
    $secret    = $this->config->item('paypal_secret');
    $base_url  = $this->config->item('paypal_base_url');

    $ch = curl_init($base_url . 'v1/oauth2/token');

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_USERPWD => $client_id . ':' . $secret,
        CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Accept-Language: en_US'
        ],
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        log_message('error', curl_error($ch));
        return false;
    }

    curl_close($ch);

    $result = json_decode($response, true);

    if (!isset($result['access_token'])) {
        log_message('error', json_encode($result));
        return false;
    }

    return $result['access_token'];
}

    /**
     * PayPal wrapper (do not change existing getToken())
     * Reason: future gateways or other tokens can coexist safely.
     */
    private function getPaypalAccessToken()
    {
        // call existing function (backward compatible)
        return $this->getToken();
    }

    /**
     * Wallet Topup: Create PayPal order for add money
     * URL: /paypal_wallet/create_order
     */
    public function paypal_wallet_create_order()
    {
        $token = $this->getPaypalAccessToken();
        if (!$token) {
            show_error('PayPal Token Error');
        }

        $this->config->load('paypal');
        $base_url = $this->config->item('paypal_base_url');

        $input  = json_decode(file_get_contents('php://input'), true);
        $amount = isset($input['amount']) ? number_format((float) $input['amount'], 2, '.', '') : '0.00';
        $currency = !empty($input['currency']) ? $input['currency'] : 'USD';

        // store in session to validate later
        $this->session->set_userdata('wallet_topup_amount', $amount);
        $this->session->set_userdata('wallet_topup_currency', $currency);

        $data = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => $currency,
                    'value' => $amount,
                ],
            ]],
        ];

        $ch = curl_init($base_url . 'v2/checkout/orders');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                "Authorization: Bearer $token",
            ],
        ]);

        $resp = curl_exec($ch);
        if (curl_errno($ch)) {
            log_message('error', 'PayPal wallet create order curl error: ' . curl_error($ch));
        }
        curl_close($ch);

        // return raw paypal response
        $this->output->set_content_type('application/json')->set_output($resp);
    }

    /**
     * Wallet Topup: Capture PayPal order & credit wallet
        if (!$this->session->userdata('auth_affiliate')) {
            $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => false,
                'message' => 'Unauthorized',
            ]));
            return;
        }

        $token = $this->getPaypalAccessToken();
        if (!$token) {
            show_error('PayPal Token Error');
        }

        $this->config->load('paypal');
        $base_url = $this->config->item('paypal_base_url');

        // capture
        $ch = curl_init($base_url . "v2/checkout/orders/$orderID/capture");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                "Authorization: Bearer $token",
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            log_message('error', 'PayPal wallet capture curl error: ' . curl_error($ch));
        }
        curl_close($ch);

        $decoded = json_decode($response, true);

        if ($httpCode < 200 || $httpCode >= 300 || empty($decoded)) {
            log_message('error', 'PayPal wallet capture failed: ' . $response);
            $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => false,
                'message' => 'PayPal capture failed',
                'raw' => $response,
            ]));
            return;
        }

        // Parse capture details (best effort)
        $capture = $decoded['purchase_units'][0]['payments']['captures'][0] ?? null;
        $payer = $decoded['payer'] ?? [];

        $paypal_order_id = $decoded['id'] ?? $orderID;
        $paypal_capture_id = $capture['id'] ?? null;
        $paypal_payer_id = $payer['payer_id'] ?? null;

        $payer_email = $payer['email_address'] ?? null;
        $payer_name = null;
        if (!empty($payer['name']['given_name']) || !empty($payer['name']['surname'])) {
            $payer_name = trim(($payer['name']['given_name'] ?? '') . ' ' . ($payer['name']['surname'] ?? ''));
        }
        $payer_country = $payer['address']['country_code'] ?? null;

        $amount = $capture['amount']['value'] ?? ($decoded['purchase_units'][0]['amount']['value'] ?? null);
        $currency = $capture['amount']['currency_code'] ?? ($decoded['purchase_units'][0]['amount']['currency_code'] ?? 'USD');

        $paypal_fee = $capture['seller_receivable_breakdown']['paypal_fee']['value'] ?? null;
        $net_amount = $capture['seller_receivable_breakdown']['net_amount']['value'] ?? null;

        $payment_time = !empty($capture['create_time']) ? date('Y-m-d H:i:s', strtotime($capture['create_time'])) : date('Y-m-d H:i:s');

        // Validate against session amount if available
        $expectedAmount = $this->session->userdata('wallet_topup_amount');
        if (!empty($expectedAmount) && !empty($amount)) {
            // compare with 2 decimals
            if (number_format((float) $expectedAmount, 2, '.', '') !== number_format((float) $amount, 2, '.', '')) {
                log_message('error', 'Wallet topup amount mismatch. expected=' . $expectedAmount . ' actual=' . $amount);
            }
        }

        $user_id = (int) $this->session->userdata('user_id');

        // prevent duplicate by capture id
        if (!empty($paypal_capture_id)) {
            $dupe = $this->db->where('paypal_capture_id', $paypal_capture_id)->get('wallet_topup_paypal')->num_rows();
            if ($dupe > 0) {
                $this->output->set_content_type('application/json')->set_output(json_encode([
                    'status' => true,
                    'message' => 'Already captured',
                    'data' => $decoded,
                ]));
                return;
            }
        }

        // Insert PayPal topup row
        $this->db->insert('wallet_topup_paypal', [
            'user_id' => $user_id,
            'paypal_order_id' => $paypal_order_id,
            'paypal_capture_id' => $paypal_capture_id,
            'paypal_payer_id' => $paypal_payer_id,
            'payer_email' => $payer_email,
            'payer_name' => $payer_name,
            'payer_country' => $payer_country,
            'amount' => $amount ? $amount : 0,
            'currency' => $currency,
            'paypal_fee' => $paypal_fee,
            'net_amount' => $net_amount,
            'payment_status' => 'SUCCESS',
            'payment_time' => $payment_time,
            'paypal_response' => json_encode($decoded),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Credit wallet (final_e_wallet)
        $wallet = $this->db->select('amount')->from('final_e_wallet')->where('user_id', $user_id)->get()->row();
        $currentBalance = $wallet ? (float) $wallet->amount : 0;
        $newBalance = $currentBalance + (float) $amount;

        if ($wallet) {
            $this->db->where('user_id', $user_id)->update('final_e_wallet', ['amount' => $newBalance]);
        } else {
            $this->db->insert('final_e_wallet', ['user_id' => $user_id, 'amount' => $newBalance]);
        }

        // ✅ Set flashdata so existing modal (paymentSuccessModal) can show after redirect-based flows,
        // and can also be used by any view that reads payment_success.
        $this->session->set_flashdata('payment_success', [
            'order_id' => 'WALLET_TOPUP',
            'payment_id' => $paypal_capture_id ? $paypal_capture_id : $paypal_order_id,
            'amount' => $amount,
            'paid_at' => date('d M Y, h:i A'),
        ]);

        // Optional ledger entry if credit_debit exists (no removal; best-effort)
        $tables = $this->db->list_tables();
        if (in_array('credit_debit', $tables)) {
            $this->db->insert('credit_debit', [
                'transaction_no' => function_exists('generateUniqueTranNo') ? generateUniqueTranNo() : uniqid('TXN'),
                'user_id' => $user_id,
                'credit_amt' => (float) $amount,
                'debit_amt' => 0,
                'balance' => $newBalance,
                'receiver_id' => $user_id,
                'sender_id' => $user_id,
                'receive_date' => date('Y-m-d'),
                'ttype' => 'Wallet Topup',
                'TranDescription' => 'Wallet topup via PayPal',
                'Cause' => 'Wallet topup via PayPal',
                'Remark' => 'PayPal Order: ' . $paypal_order_id,
                'product_name' => 'main',
                'deposit_id' => '1',
                'status' => '1',
                'ewallet_used_by' => 'Withdrawal Wallet',
                'current_url' => current_url(),
                'reason' => 'WALLET_TOPUP_PAYPAL',
            ]);
        }

        $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => true,
            'message' => 'Wallet credited successfully',
            'balance' => $newBalance,
            'order_id' => 'WALLET_TOPUP',
            'payment_id' => $paypal_capture_id ? $paypal_capture_id : $paypal_order_id,
            'amount' => number_format((float) $amount, 2, '.', ''),
            'paid_at' => date('d M Y, h:i A'),
            'paypal' => $decoded,
        ]));
    }

public function create_order()
{
    $token = $this->getToken();
    if (!$token) {
        show_error('PayPal Token Error');
    }

    $this->config->load('paypal');
    $base_url = $this->config->item('paypal_base_url');

    $input  = json_decode(file_get_contents('php://input'), true);
    $amount = number_format((float)$input['amount'], 2, '.', '');

    $this->session->set_userdata('paypal_amount', $amount);

    $data = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => $amount
                ]
            ]
        ]
    ];

    $ch = curl_init($base_url . 'v2/checkout/orders');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            "Authorization: Bearer $token"
        ],
    ]);

    echo curl_exec($ch);
    curl_close($ch);
}

public function capture_order($orderID)
{
    $token = $this->getToken();
    if (!$token) {
        show_error('PayPal Token Error');
    }

    $this->config->load('paypal');
    $base_url = $this->config->item('paypal_base_url');

    $ch = curl_init($base_url . "v2/checkout/orders/$orderID/capture");

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            "Authorization: Bearer $token"
        ],
    ]);

    echo curl_exec($ch);
    curl_close($ch);
}

public function capture_order_check($orderID)
{
    $token = $this->getToken();
    if (!$token) {
        return false;
    }

    $this->config->load('paypal');
    $base_url = $this->config->item('paypal_base_url');

    $ch = curl_init($base_url . "v2/checkout/orders/$orderID");

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPGET => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
            "Authorization: Bearer $token",
        ],
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_TIMEOUT => 30,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        return json_decode($response, true);
    }

    log_message('error', 'PayPal Check Error: ' . $response);
    return false;
}

    /**
     * Wallet Topup: Log PayPal cancel event (stores cancelled attempts)
     * URL: /web/paypal_wallet_cancel
     */
    public function paypal_wallet_cancel()
    {
        if (!$this->session->userdata('auth_affiliate')) {
            $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => false,
                'message' => 'Unauthorized',
            ]));
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $user_id = (int) $this->session->userdata('user_id');

        $paypal_order_id = $input['orderID'] ?? null;
        $amount = $input['amount'] ?? $this->session->userdata('wallet_topup_amount');
        $currency = $input['currency'] ?? $this->session->userdata('wallet_topup_currency') ?? 'USD';
        $reason = $input['reason'] ?? 'USER_CANCELLED';

        // If order id not present, still log a row for debugging/auditing.
        if (empty($paypal_order_id)) {
            $paypal_order_id = 'CANCELLED_' . uniqid();
        }

        // Avoid duplicate cancel rows for same order id
        $exists = $this->db
            ->where('user_id', $user_id)
            ->where('paypal_order_id', $paypal_order_id)
            ->where('payment_status', 'CANCELLED')
            ->get('wallet_topup_paypal')
            ->num_rows();

        if ($exists == 0) {
            $this->db->insert('wallet_topup_paypal', [
                'user_id' => $user_id,
                'paypal_order_id' => $paypal_order_id,
                'paypal_capture_id' => null,
                'paypal_payer_id' => null,
                'payer_email' => null,
                'payer_name' => null,
                'payer_country' => null,
                'amount' => $amount ? $amount : 0,
                'currency' => $currency,
                'paypal_fee' => 0,
                'net_amount' => 0,
                'payment_status' => 'CANCELLED',
                'payment_time' => date('Y-m-d H:i:s'),
                'paypal_response' => json_encode([
                    'type' => 'CANCEL',
                    'reason' => $reason,
                    'client_payload' => $input,
                ]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => true,
            'message' => 'Cancellation logged',
        ]));
    }

} //end class
