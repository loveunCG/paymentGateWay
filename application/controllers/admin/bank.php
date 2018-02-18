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
class Bank extends Admin_Controller {

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
        $data['title'] = "Bank Manage"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_bank_info();
        $data['subview'] = $this->load->view('admin/bank/bank', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function add_bank($id = NULL) {// this function is to create get monthy recap report 
         $data['title'] = "Add New Bank";

        
        if (!empty($id)) 
        {
            // retrive data from db by id            
            
            $this->settings_model->_table_name = "tbl_card_type"; //table name
            $this->settings_model->_order_by = "id";
            $val = $this->settings_model->get_by(array('id' => $id), TRUE);

            if ($val) { // get general info by id
                $data['ginfo'] = $val; // assign value from db    
            }
            $data['cinfo'] = $this->settings_model->get_bank_info();
            // retrive country
            // $this->settings_model->_table_name = "currency"; //table name
            // $this->settings_model->_order_by = "currency_id";
            // $data['all_currency'] = $this->settings_model->get(); // get result
        }
        
        $data['subview'] = $this->load->view('admin/bank/addbank', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function save_cinfo($id = NULL) {
    
        //echo "<pre>";print_r($_POST);die;
        $this->settings_model->_table_name = "tbl_channel_rate"; // table name
        $this->settings_model->_primary_key = "id"; // $id

        $data = $this->settings_model->array_from_post(array('channel_name', 'channel_code'));
        $data['use_online'] = 1;

            $setting_id = $this->settings_model->save($data, $id);
        

        $type = "success";
        $message = "银行信息成功更新！";
        set_message($type, $message);
        redirect('admin/bank/bank');
    }
    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }  

    public function delete_bank($id = NULL)
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
        $message = "银行信息成功删除！";
        set_message($type, $message);
        redirect('admin/bank/bank');
        
    }      

}
