<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flogin extends CI_Controller {
    public function __construct() {
        parent::__construct();
    $this->load->model('admin_model');

    }
    public function index() {

        $data['title'] = "User Login";
        $data['category'] = 1;
        $this->load->view('intro/login_user', $data);
    }
    public function test(){
        $data['title'] = "User Login";
        $this->load->view('employee/sign_up', $data);
    }
    public function check_emp_id($val) {

        $check_dupliaction_id = $this->admin_model->check_by(array('employment_id' => $val), 'tbl_employee');
        $check_dupliaction_id1 = $this->admin_model->check_by(array('user_name' => $val), 'tbl_user');

        if (!empty($check_dupliaction_id)||!empty($check_dupliaction_id1)) {
            $result = NULL;

        } else {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">没有存在这些账户</small>';

        }
        echo $result;
    }
    public function check_current_password($val) {
        $password = $this->hash($val);
        $check_dupliaction_id = $this->admin_model->check_by(array('password' => $password), 'tbl_employee_login');
        $check_dupliaction_id1 = $this->admin_model->check_by(array('password' => $password), 'tbl_user');


        if (!empty($check_dupliaction_id)||!empty($check_dupliaction_id1)) {
            $result = NULL;


        } else {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">您输入的密码不符合!</small>';

        }
        echo $result;
    }
    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }
    public function sign() {

        $data['title'] = "User Login";
        $data['category'] = 2;
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->from('tbl_employee');
        $query_result = $this->db->get();
        $result = $query_result->result();
        $data['employee'] = $result;
        $this->load->view('intro/login_user', $data);
    }
    public function logout() {
        $this->login_model->logout();
        redirect('login');
    }

}
