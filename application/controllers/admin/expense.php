<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of expense
 *
 * @author NaYeM
 */
class Expense extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('expense_model');
    }

    public function add_expense($id = NULL) {
        $this->expense_model->_table_name = "tbl_expense"; //table name
        $this->expense_model->_order_by = "expense_id";
        if ($id) { // retrive data from db by id
            // get all expense_info by id
            $data['expense_info'] = $this->expense_model->get_by(array('expense_id' => $id), TRUE);

            if (empty($data['expense_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/expense/add_expense');
            }
        }        
        // get all employee info
        $this->expense_model->_table_name = 'tbl_employee';
        $this->expense_model->_order_by = 'employee_id';
        $data['employee_info'] = $this->expense_model->get();
        $data['title'] = "Add Expense";
        $data['subview'] = $this->load->view('admin/expense/add_expense', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function save_expense($id = NULL) {
        // input data
        $data = $this->expense_model->array_from_post(array('item_name', 'purchase_from', 'purchase_date', 'amount', 'employee_id')); //input post  
        //upload bill info
        if (!empty($_FILES['bill_copy']['name'])) {
            $old_path = $this->input->post('bill_copy_path');
            if ($old_path) {
                unlink($old_path);
            }
            $val = $this->expense_model->uploadAllType('bill_copy');
            $val == TRUE || redirect('admin/settings/general_settings');
            $data['bill_copy'] = $val['path'];
            $data['bill_copy_filename'] = $val['fileName'];
            $data['bill_copy_path'] = $val['fullPath'];
        }
        // get employee id from session

        $this->expense_model->_table_name = "tbl_expense"; // table name
        $this->expense_model->_primary_key = "expense_id"; // $id
        $this->expense_model->save($data, $id);
        $type = "success";
        $message = "Expense Information Successfully Saved!";
        set_message($type, $message);
        redirect('admin/expense/expense_report'); //redirect page
    }

    public function delete_expense($id) {
        // delete all expense by id
        $this->expense_model->_table_name = "tbl_expense"; // table name
        $this->expense_model->_primary_key = "expense_id"; // $id
        $this->expense_model->delete($id);

        $type = "success";
        $message = "Expense Information Successfully Delete!";
        set_message($type, $message);
        redirect('admin/expense/add_expense'); //redirect page
    }

    public function expense_report() {
        $data['title'] = "Expense Report";

        // active check with current month
        $data['current_month'] = date('m');

        if ($this->input->post('year', TRUE)) { // if input year 
            $data['year'] = $this->input->post('year', TRUE);
        } else { // else current year
            $data['year'] = date('Y'); // get current year
        }
        // get all expense list by year and month
        $data['all_expense_list'] = $this->get_expense_list($data['year']);

        $data['subview'] = $this->load->view('admin/expense/expense_report', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function get_expense_list($year, $month = NULL) {// this function is to create get monthy recap report 
        if (!empty($month)) {
            if ($month >= 1 && $month <= 9) { // if i<=9 concate with Mysql.becuase on Mysql query fast in two digit like 01.
                $start_date = $year . "-" . '0' . $month . '-' . '01';
                $end_date = $year . "-" . '0' . $month . '-' . '31';
            } else {
                $start_date = $year . "-" . $month . '-' . '01';
                $end_date = $year . "-" . $month . '-' . '31';
            }
            $get_expense_list = $this->expense_model->get_expense_list_by_date($start_date, $end_date); // get all report by start date and in date 
        } else {
            for ($i = 1; $i <= 12; $i++) { // query for months
                if ($i >= 1 && $i <= 9) { // if i<=9 concate with Mysql.becuase on Mysql query fast in two digit like 01.
                    $start_date = $year . "-" . '0' . $i . '-' . '01';
                    $end_date = $year . "-" . '0' . $i . '-' . '31';
                } else {
                    $start_date = $year . "-" . $i . '-' . '01';
                    $end_date = $year . "-" . $i . '-' . '31';
                }
                $get_expense_list[$i] = $this->expense_model->get_expense_list_by_date($start_date, $end_date); // get all report by start date and in date 
            }
        }
        return $get_expense_list; // return the result
    }

    public function report_pdf($year, $month) {
        $data['expense_list'] = $this->get_expense_list($year, $month);
        $month_name = date('F', strtotime($year . '-' . $month)); // get full name of month by date query                
        $data['monthyaer'] = $month_name . '  ' . $year;

        $this->load->helper('dompdf');
        $viewfile = $this->load->view('admin/expense/expense_report_pdf', $data, TRUE);
        pdf_create($viewfile, 'Expense Report  - ' . $data['monthyaer']);        
    }

}
