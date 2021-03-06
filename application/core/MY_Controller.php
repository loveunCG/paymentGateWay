<?php

session_start();

/**
 * Description of MY_Controller
 *
 * @author Zaman
 */
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();


        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('admin_model');
        $this->load->model('global_model');

        //********single domain multiple DB according to company *********
       // $this->user = $this->auth->get_user($this->input->post('username'), $this->input->post('password'));
        //$this->company = $this->company->get($this->input->post('company_id'));

        // check email notification status
        $g_id = $this->session->userdata('id_gsettings');

		if ($this->login_model->loggedin() != FALSE && !empty($g_id))
		{


			$this->admin_model->_table_name = 'tbl_gsettings';
			$this->admin_model->_order_by = 'id_gsettings';
			$where = array('id_gsettings' => $g_id);

			$company = $this->admin_model->get_by($where, FALSE);
			$company=$company[0];

			//(16sep2016)

			//$config['hostname'] = $this->db->hostname;
			/*$config['username'] = $this->db->username;
			$config['password'] = $this->db->password;*/
			$config['hostname'] = $company->database_host;
			$config['username'] = $company->database_user_name;
			$config['password'] = $company->database_user_password;
			$config['database'] = $company->database_name;//"pappiean_payrolltemp_tryonesolution";//
			$config['dbdriver'] = "mysql";
			$config['dbprefix'] = "";
			$config['pconnect'] = FALSE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = "";
			$config['char_set'] = "utf8";
			$config['dbcollat'] = "utf8_general_ci";

			$this->db = $this->load->database($config, TRUE);
		}
        //********ends here***********

        //echo $uriSegment = $this->uri->uri_string();
        $uri1 = $this->uri->segment(1);
        $uri2 = $this->uri->segment(2);
        $uri3 = $this->uri->segment(3);

        if ($uri3) {
            $uri3 = '/' . $uri3;
        }

        $uriSegment = $uri1 . '/' . $uri2 . $uri3;
        $menu_uri['menu_active_id'] = $this->admin_model->select_menu_by_uri($uriSegment);
        $menu_uri['menu_active_id'] == false || $this->session->set_userdata($menu_uri);

        // Login check
        $exception_uris = array(
            'login',
            'login/logout'
        );
        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if ($this->login_model->loggedin() == FALSE) {
                redirect('login');
            }
        }

        // check notififation status by where
        $where = array('notify_me' => '1', 'view_status' => '2');
        // check email notification status
        // $this->admin_model->_table_name = 'tbl_inbox';
        // $this->admin_model->_order_by = 'inbox_id';
        // $data['total_email_notification'] = count($this->admin_model->get_by($where, FALSE));
        // $data['email_notification'] = $this->admin_model->get_by($where, FALSE);

        // check notice notification status
        $this->admin_model->_table_name = 'tbl_notice';
        $this->admin_model->_order_by = 'notice_id';
        $data['total_notice_notification'] = count($this->admin_model->get_by($where, FALSE));

        $data['notice_notification'] = $this->admin_model->get_by($where, FALSE);

        // check leave notification status
        // $this->admin_model->_table_name = 'tbl_application_list';
        // $this->admin_model->_order_by = 'application_list_id';
        // $data['total_leave_notifation'] = count($this->admin_model->get_by($where, FALSE));
        // $data['leave_notification'] = $this->admin_model->get_emp_leave_info();
        // set all data into session
        $_SESSION['notify'] = $data;

        // get all general settings info
        $this->admin_model->_table_name = "tbl_gsettings"; //table name
        $this->admin_model->_order_by = "id_gsettings";
		$g_id = $this->session->userdata('id_gsettings');
		if(empty($g_id))
		{
			$this->session->set_userdata('id_gsettings',1);
		}
        $info['genaral_info'] = $this->admin_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		$this->session->set_userdata($info);
    }

}
