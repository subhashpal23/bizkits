<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model {

    private $table = 'company_details';

    // get single company data
    public function get_company()
    {
        return $this->db->get_where($this->table, ['id' => 1])->row();
    }

    // insert or update company data
    public function save_company($data)
    {
        $check = $this->db->get_where($this->table, ['id' => 1])->row();

        if ($check) {
            return $this->db->where('id', 1)->update($this->table, $data);
        } else {
            $data['id'] = 1;
            return $this->db->insert($this->table, $data);
        }
    }
}
