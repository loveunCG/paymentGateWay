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
class Card extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('settings_model');

        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => "Full",
                'width' => "90%",
                'height' => "400px"
            )
        );
    }

    public function index()
    {
        $data['title'] = "Card Manage"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_card_info();
        $data['subview'] = $this->load->view('admin/card/card', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function add_card($id = NULL) {// this function is to create get monthy recap report 
         $data['title'] = "Add New Card";

        
        if (!empty($id)) 
        {
            // retrive data from db by id            
            
            $this->settings_model->_table_name = "tbl_card_type"; //table name
            $this->settings_model->_order_by = "id";
            $val = $this->settings_model->get_by(array('id' => $id), TRUE);


            if ($val) { // get general info by id
                $data['ginfo'] = $val; // assign value from db    
            }
            $data['cinfo'] = $this->settings_model->get_card_info();

        }
        
        $data['subview'] = $this->load->view('admin/card/cardadd', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function save_cinfo($id = NULL) {
    
        //echo "<pre>";print_r($_POST);die;
        $this->settings_model->_table_name = "tbl_card_type"; // table name
        $this->settings_model->_primary_key = "id"; // $id

        $data = $this->settings_model->array_from_post(array('pay_type', 'pay_price_type','pay_type_status'));
        


            if (!empty($_FILES['logo']['name'])) {
                $old_path = $this->input->post('old_path');
                if ($old_path) {
                    unlink($old_path);
                }
                $val = $this->settings_model->uploadImage('logo');
                $val == TRUE || redirect('admin/card/card');
                $data['logo'] = $val['path'];
                $data['full_path'] = $val['fullPath'];
            }
            $setting_id = $this->settings_model->save($data, $id);


        $type = "success";
        $message = "卡片信息成功更新！";
        set_message($type, $message);
        redirect('admin/card/card');
    }
    
    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }  

    public function delete_card($id = NULL) 
    {
        // ************* Delete into Company Table 
        $this->settings_model->_table_name = "tbl_card_type"; // table name
        $this->settings_model->_primary_key = "id"; // $id
        $this->settings_model->delete($id);
        
        // ************* Delete into Company Table 
        // $this->settings_model->_table_name = "tbl_user"; // table name
        // $this->settings_model->_primary_key = "user_id"; // $id
        
        // $check_existing_data = $this->settings_model->check_by(array('id_gsettings' => $id), 'tbl_user');
        
        // $this->settings_model->delete($check_existing_data->user_id);
        
        
        // messages for user
        $type = "success";
        $message = "Employee Information Successfully Delete!";
        set_message($type, $message);
        redirect('admin/card/card');
        
    }      

}
