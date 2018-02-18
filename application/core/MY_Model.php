<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * Main Base Model MY_Model
 * Author: Zaman 
 */

class MY_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;

    function __construct() {
        parent::__construct();
    }

    // CURD FUNCTION

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function get($id = NULL, $single = FALSE) {

        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }

    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function save($data, $id = NULL) {

        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }
		/*print_r($data); echo $this->_table_name; echo $id; die();*/
        // Insert
        if ($id === NULL) {
        	
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			 
            $this->db->set($data);
            $this->db->insert($this->_table_name);
			
			
            $id = $this->db->insert_id();
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }

    public function delete($id) {
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

    /**
     * Delete Multiple rows
     */
    public function delete_multiple($where) {
        $this->db->where($where);
        $this->db->delete($this->_table_name);
    }

    function uploadImage($field) {

        $config['upload_path'] = 'img/uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '2024';
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = "error";
            $message = $error;
            set_message($type, $message);
            return FALSE;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $img_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $img_data ['fullPath'] = $fdata['full_path'];
            return $img_data;
            // uploading successfull, now do your further actions
        }
    }

    function uploadFile($field) {
        $config['upload_path'] = 'img/uploads/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = "error";
            $message = $error;
            set_message($type, $message);
            return FALSE;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $file_data ['fileName'] = $fdata['file_name'];
            $file_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $file_data ['fullPath'] = $fdata['full_path'];
            return $file_data;
            // uploading successfull, now do your further actions
        }
    }

    function uploadAllType($field) {
        $config['upload_path'] = 'img/uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = "error";
            $message = $error;
            set_message($type, $message);
            return FALSE;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $file_data ['fileName'] = $fdata['file_name'];
            $file_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $file_data ['fullPath'] = $fdata['full_path'];
            return $file_data;
            // uploading successfull, now do your further actions
        }
    }

    public function check_by($where, $tbl_name) {
        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }   
    public function check_update($table, $where, $id = Null) {
        $this->db->select('*', FALSE);
        $this->db->from($table);
        if ($id != null) {
            $this->db->where($id);
        }
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    // set actiion setting 

    public function set_action($where, $value, $tbl_name) {
        $this->db->set($value);
        $this->db->where($where);
        return $this->db->update($tbl_name);
    }
    public function all_form_language() {
        $this->db->select('tbl_form.*');
        $this->db->from('tbl_form');
        $this->db->order_by('form_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function all_menu_language() {
        $this->db->select('tbl_menu.*');
        $this->db->from('tbl_menu');        
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function all_formbody_language() {
        $this->db->select('tbl_form_body.*');
        $this->db->from('tbl_form_body');        
        $this->db->order_by('form_id','ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();        
        return $result;
    }

}
