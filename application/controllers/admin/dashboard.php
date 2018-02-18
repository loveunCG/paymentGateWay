<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admistrator
 *
 * @author pc mart ltd
 */
class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index() 
	{		
        $data['title'] = "Clients Management System";
        $employee_id = $this->session->userdata('employee_id');

  //       $data['get_result'] = $this->admin_model->get_event_by_id($employee_id);
		// $data['get_event'] = $this->admin_model->get_event_display($employee_id);
  //       $data['get_holiday'] = $this->admin_model->check_holiday_by_date();
  //       $data['recent_application'] = $this->admin_model->get_recent_application();

        // get absent employee         
        // $data['absent_employee'] = $this->admin_model->get_absent_employee();
        $data['total_request_count'] = count($this->admin_model->get_all_request());
        $data['total_requestlist'] = $this->admin_model->get_all_requestlist();
        $data['request_count'] = count($this->admin_model->get_all_request(1));
        $data['requestlist'] = $this->admin_model->get_all_requestlist(1);
        $data['procrequest_count'] = count($this->admin_model->get_all_requestlist(5));
        $data['procrequestlist'] = $this->admin_model->get_all_requestlist(5);
        $data['employee_id'] = $employee_id;



        //total award count
        // $this->admin_model->_table_name = "tbl_employee_award"; //table name
        // $this->admin_model->_order_by = "employee_award_id"; // order by 
        // $data['total_award'] = count($this->admin_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')))); // get result
        //total expense count
        // $this->admin_model->_table_name = "tbl_expense"; //table name
        // $this->admin_model->_order_by = "expense_id"; // order by 
        // $total_expense = $this->admin_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings'))); // get result

        // $total = 0;
        // foreach ($total_expense as $v_expense) {
        //     $total+=$v_expense->amount;
        // }
        // $data['total_expense'] = $total;
        // //
        // //total employee count
        $this->admin_model->_table_name = "tbl_user"; //table name
        $this->admin_model->_order_by = "user_id"; // order by
        $data['admin'] = $this->admin_model->get_by(array('status' => 1,'user_id' => $employee_id)); // get resutl

        // $data['total_employee'] = count($this->admin_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')))); // get resutl 
        // //
        // // active check with current month
        // $data['current_month'] = date('m');

        // if ($this->input->post('year', TRUE)) { // if input year 
        //     $data['year'] = $this->input->post('year', TRUE);
        // } else { // else current year
        //     $data['year'] = date('Y'); // get current year
        // }

        // // get all expense list by year and month
        // $data['all_expense'] = $this->get_expense_list($data['year']);
		
        $data['subview'] = $this->load->view('admin/main_content', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    public function get_expense_list($year) {// this function is to create get monthy recap report 
        for ($i = 1; $i <= 12; $i++) { // query for months
            if ($i >= 1 && $i <= 9) { // if i<=9 concate with Mysql.becuase on Mysql query fast in two digit like 01.
                $start_date = $year . "-" . '0' . $i . '-' . '01';
                $end_date = $year . "-" . '0' . $i . '-' . '31';
            } else {
                $start_date = $year . "-" . $i . '-' . '01';
                $end_date = $year . "-" . $i . '-' . '31';
            }
            $get_expense_list[$i] = $this->admin_model->get_expense_list_by_date($start_date, $end_date); // get all report by start date and in date 
        }
        return $get_expense_list; // return the result
    }

}
