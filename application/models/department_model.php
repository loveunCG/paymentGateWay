<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of department_model
 *
 * @author NaYeM
 */
class Department_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_add_department_by_id($department_id) {
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('quickbooks_classes.quickbooks_class_name', FALSE); //@pank selecct record from tbl_quickbooks_classes
        $this->db->from('tbl_department');
        $this->db->join('tbl_designations', 'tbl_department.department_id = tbl_designations.department_id', 'left');
        $this->db->join('quickbooks_classes', 'tbl_department.quickbooks_class_id = quickbooks_classes.quickbooks_class_id', 'left');//@pank 
        $this->db->where('tbl_department.department_id', $department_id); 
      
        $query_result = $this->db->get();
        $result = $query_result->result();
       //print_r($result);die;
        return $result;
    }

}
