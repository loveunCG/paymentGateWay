<?php

class User_Model extends MY_Model {
    public $_table_name;
    public $_order_by;
    public $_primary_key;
    public function all_emplyee() {
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('tbl_employee_login.employee_login_id, tbl_employee_login.activate, tbl_employee_login.user_name  ', FALSE);
        $this->db->from('tbl_employee');
        $this->db->join('tbl_department', 'tbl_employee.department_id = tbl_department.department_id', 'left');
        $this->db->join('tbl_employee_login', 'tbl_employee.employee_id  = tbl_employee_login.employee_id', 'left');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function select_user_roll_by_employee_id($employee_login_id) {
        $this->db->select('tbl_user_roll.*', FALSE);
        $this->db->select('menu.label', FALSE);
        $this->db->from('tbl_user_roll');
        $this->db->join('menu', 'tbl_user_roll.menu_id = menu.id', 'left');
        $this->db->where('tbl_user_roll.employee_login_id', $employee_login_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_new_user() {
        $post = new stdClass();
        $post->user_name = '';
        $post->password = '';
        $post->employee_login_id = '';
        return $post;
    }	
	public function get_user_type() {
        $this->db->select('tbl_user.*', FALSE);
        $this->db->select('tbl_user_type.user_type', FALSE);
        $this->db->from('tbl_user');
        $this->db->join('tbl_user_type', 'tbl_user.user_type_id = tbl_user_type.user_type_id', 'left');
		$this->db->where('tbl_user.id_gsettings', $this->session->userdata('id_gsettings'));
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }	
	function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }
        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }
      return $password;
    }

}