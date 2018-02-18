<?php
session_start();

/**
 * Description of Admin_Controller
 *
 * @author pc mart ltd
 */
class Admin_Controller extends MY_Controller
{
    function __construct()
    {
        
        
        
        parent::__construct();
        $this->load->model('global_model');
        $this->load->model('admin_model');


        $type = $this->session->userdata('user_type');

        if ($type == 1) {
            $this->admin_model->_table_name = "tbl_menu"; //table name
            $this->admin_model->_order_by = "menu_id";
            $_SESSION["user_roll"] = $this->admin_model->get();

        } else {
            $employee_login_id = $this->session->userdata('employee_login_id');
            $_SESSION["user_roll"] = $this->global_model->select_user_roll($employee_login_id);
        }


        // Login check
        $user_type = $this->session->userdata('user_type');
        if ($user_type != 1) {
            $exception_uris = array(
                'admin/user',
                'admin/user/user_list'
            );
            if (in_array(uri_string(), $exception_uris) == TRUE) {
                redirect('admin/dashboard');
            }
        }

//        $url = $this->session->userdata('url');
//        $user_type = $this->session->userdata('user_type');
//        if ($user_type != 1) {
//            redirect($url);
//        }
        // $employee_login_id = $this->session->userdata('employee_login_id');


        //$val = $this->session->userdata('user_roll');


//        foreach($val as $v_val){
//            $exception_uris[] = $v_val->slug;
//        }
//        $exception_uris[]='admin/dashboard';
//
//        if (in_array(uri_string(), $exception_uris) != TRUE) {
//            redirect($url);
//        }


    }
}