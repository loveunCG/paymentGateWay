<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of department
 *
 * @author NaYeM
 */
class Department extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('department_model');
    }

    public function add_department($id = NULL) {
		//$id=5;
		//die("hiii");
			 $this->department_model->_table_name = "tbl_department"; //table name
			$this->department_model->_order_by = "department_id";
			$data['title'] = "Add Department";
		
			$this->department_model->_table_name = "tbl_department"; //table name
			$this->department_model->_order_by = "department_id";
			$data['title'] = "Add Department";
			 // get all 
             

        if ($id) { // retrive data from db by id
            // get all department by id
            $data['department_info'] = $this->department_model->get_by(array('department_id' => $id,'id_gsettings' => $this->session->userdata('id_gsettings')), TRUE);
            // get all designation by department id
            $this->department_model->_table_name = "tbl_designations"; //table name
            $data['designation_info'] = $this->department_model->get_by(array('department_id' => $id,'id_gsettings' => $this->session->userdata('id_gsettings')), FALSE);
            $data['quickbooks_classes_info'] = $this->department_model->get();
           
            if (empty($data['department_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/department/add_department');
            }
        }		//@pank 13-8-2016 for retrive quickbooks_class_name
			$this->department_model->_table_name = "quickbooks_classes"; //table name
			$this->department_model->_order_by = "quickbooks_class_id";
			$data['title'] = "Quickbooks_classes";
			$data['quickbooks_classes_info'] = $this->department_model->get();
           
            //@pank 13-8-2016 end 

        //page load
        $data['subview'] = $this->load->view('admin/department/add_department', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function save_department($id = NULL) {
		//print_r($_POST);

        $this->department_model->_table_name = "tbl_department"; // table name
        $this->department_model->_primary_key = "department_id"; // $id

        $data = $this->department_model->array_from_post(array('department_name','quickbooks_class_id')); //input post  //@pank      
		
		$data['id_gsettings'] = $this->session->userdata('id_gsettings');
		
        $where = array('department_name' => $data['department_name'],'id_gsettings' => $this->session->userdata('id_gsettings'));
        // check department by department_name
        // if not empty return this id else save
        
        $check_department = $this->department_model->check_by($where, 'tbl_department');
        
        if (!empty($check_department)) {
            $department_id = $check_department->department_id;
           $this->department_model->save($data, $id);
        } else {
			
            $department_id = $this->department_model->save($data, $id);
        }
        // input data
        $designations = $this->input->post('designations', TRUE);
        // update input data designations_id
        $designations_id = $this->input->post('designations_id', TRUE);

        foreach ($designations as $key => $v_designations) {
            $check_designations = $this->check_designations($department_id, $v_designations);

            if (empty($check_designations)) {
                $this->department_model->_table_name = "tbl_designations"; // table name
                $this->department_model->_primary_key = "designations_id"; // $id
                $desi_data['designations'] = $v_designations;
                $desi_data['department_id'] = $department_id;
				$desi_data['id_gsettings'] = $this->session->userdata('id_gsettings');
                if (!empty($designations_id[$key])) { // if designations_id is not empty then update else save
                    $id = $designations_id[$key];
                    $this->department_model->save($desi_data, $id);
                } else {
                    $this->department_model->save($desi_data);
                }
            }
        }
        $type = "success";
        $message = "Department Information Successfully Saved!";
        set_message($type, $message);
        redirect('admin/department/department_list'); //redirect page
    }

    public function delete_department($id) {

        $where = array('department_id' => $id,'id_gsettings' => $this->session->userdata('id_gsettings'));

        //get designation id by dept id 
        // check into designation table
        // if data exist do not delete the department
        // else delete the department 
        $get_designations_id = $this->department_model->check_by($where, 'tbl_designations');
		
		$or_where = array('designations_id' => $get_designations_id->designations_id);
        $get_existing_id = $this->department_model->check_by($or_where, 'tbl_employee');
        if (!empty($get_existing_id)) {
            $type = "error";
            $message = "Department Information Already Used !";
        } else {
            // delete all department by id
            $this->department_model->_table_name = "tbl_department"; // table name
            $this->department_model->_primary_key = "department_id"; // $id
            $this->department_model->delete($id);

            // delete all designation by  department id
            $this->department_model->_table_name = "tbl_designations"; // table name                
            $this->department_model->delete_multiple($where);
            $type = "success";
            $message = "Department Information Successfully Delete!";
        }
        set_message($type, $message);
        redirect('admin/department/department_list'); //redirect page
    }

    public function delete_designation($dept_id, $id) {         
        // check into designation table by id
        // if data exist do not delete the department
        // else delete the department 
        
        $or_where = array('designations_id' => $id,'id_gsettings' => $this->session->userdata('id_gsettings'));
        $get_existing_id = $this->department_model->check_by($or_where, 'tbl_employee');
        if (!empty($get_existing_id)) {
            $type = "error";
            $message = "Designation Information Already Used !";
        } else {
            // delete all designations by id
            $this->department_model->_table_name = "tbl_designations"; // table name
            $this->department_model->_primary_key = "designations_id"; // $id
            $this->department_model->delete($id);
            $type = "success";
            $message = "Designation Information Successfully Delete!";
        }
        set_message($type, $message);
        redirect('admin/department/add_department/' . $dept_id); //redirect page
    }

    public function check_designations($department_id, $v_designations) { // check_designations by id and designation
        $where = array('department_id' => $department_id, 'designations' => $v_designations);
        return $this->department_model->check_by($where, 'tbl_designations');
    }

    public function department_list() {

        $data['title'] = "Department List";
        $this->department_model->_table_name = "tbl_department"; //table name
        $this->department_model->_order_by = "department_id";
        $data['all_dept_info'] = $this->department_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
        // get all department info and designation info
        foreach ($data['all_dept_info'] as $v_dept_info) {
            $data['all_department_info'][] = $this->department_model->get_add_department_by_id($v_dept_info->department_id);
        }
        $data['subview'] = $this->load->view('admin/department/department_list', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

}
