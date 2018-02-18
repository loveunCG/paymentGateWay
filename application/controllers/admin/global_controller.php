<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model');
        $this->load->model('admin_model');
    }

    public function get_employee_by_designations_id($designation_id) {
        $HTML = NULL;
        $this->admin_model->_table_name = 'tbl_employee';
        $this->admin_model->_order_by = 'designations_id';
        $employee_info = $this->admin_model->get_by(array('designations_id' => $designation_id, 'status' => '1'), FALSE);
        if (!empty($employee_info)) {
            foreach ($employee_info as $v_employee_info) {
                $HTML.="<option value='" . $v_employee_info->employee_id . "'>" . $v_employee_info->first_name . ' ' . $v_employee_info->last_name . "</option>";
            }
        }
        echo $HTML;
    }

    public function check_duplicate_emp_id($val) {
        $check_dupliaction_id = $this->admin_model->check_by(array('employment_id' => $val), 'tbl_employee');

        if (!empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:10px">商户ID 已存在!<small>';
        } else {
            $result = NULL;
        }
        echo $result;
    }

    public function check_current_password($val) {
        $password = $this->hash($val);
        $check_dupliaction_id = $this->admin_model->check_by(array('password' => $password), 'tbl_user');
        if (empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:10px">您输入的密码不符合 !<small>';
        } else {
            $result = NULL;
        }
        echo $result;
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

}
