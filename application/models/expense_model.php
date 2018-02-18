<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of expense_model
 *
 * @author NaYeM
 */
class Expense_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_expense_list_by_date($start_date, $end_date) {

        $this->db->select('tbl_expense.*', FALSE);
        $this->db->select('tbl_employee.first_name,tbl_employee.last_name', FALSE);
        $this->db->from('tbl_expense');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_expense.employee_id', 'left');
        $this->db->where('purchase_date >=', $start_date);
        $this->db->where('purchase_date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

}
