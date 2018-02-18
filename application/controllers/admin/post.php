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
class Post extends Admin_Controller {

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

    public function add_post($id = NULL) {// this function is to create get monthy recap report 
         $data['title'] = "Add New Post";
        // echo  "hi"; die;
        //page load
        //Query from DB
        //retrieve country
        // $this->settings_model->_table_name = "countries"; //table name
        // $this->settings_model->_order_by = "countryName";
        // $data['all_country'] = $this->settings_model->get();
        // retrive currency
        // $this->settings_model->_table_name = "currency"; //table name
        // $this->settings_model->_order_by = "currency_id";
        // $data['all_currency'] = $this->settings_model->get(); // get result
        
        if (!empty($id)) 
        {
            // retrive data from db by id            
            
            $this->settings_model->_table_name = "tbl_card_type"; //table name
            $this->settings_model->_order_by = "id";
            $val = $this->settings_model->get_by(array('id' => $id), TRUE);

            // $this->settings_model->_table_name = "countries"; //table name
            // $this->settings_model->_order_by = "countryName";
            // $data['all_country'] = $this->settings_model->get();
            if ($val) { // get general info by id
                $data['ginfo'] = $val; // assign value from db    
            }
            $data['cinfo'] = $this->settings_model->get_card_info();
            // retrive country
            // $this->settings_model->_table_name = "currency"; //table name
            // $this->settings_model->_order_by = "currency_id";
            // $data['all_currency'] = $this->settings_model->get(); // get result
        }
        
        $data['subview'] = $this->load->view('admin/post/addpost', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function save_cinfo($id = NULL) {
    
        //echo "<pre>";print_r($_POST);die;
        $this->settings_model->_table_name = "tbl_card_type"; // table name
        $this->settings_model->_primary_key = "id"; // $id

        $data = $this->settings_model->array_from_post(array('pay_type', 'pay_price_type','pay_type_status'));
        
        /*$check_existing_user = $this->settings_model->check_by(array('email' => $data['email']), 'tbl_gsettings');
        
        if(!empty($check_existing_user))
        {
            // messages for user
            $type = "error";
            $message = "Company Information Already Stored!";
            set_message($type, $message);
            redirect('admin/company/company');
        }
        else*/
        {
            //image Process
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
        
        }
        // save into tbl employee login 
        // $this->settings_model->_table_name = "tbl_user"; // table name
        // $this->settings_model->_primary_key = "user_id"; // $id
        
        // check company login details exsist or not 
        // if existing do not save 
        // else save the login details
        // $check_existing_data = $this->settings_model->check_by(array('id_gsettings' => $setting_id), 'tbl_user');
        
        

        // if (!empty($check_existing_data)) {
            
        //     $ldata['id_gsettings'] = $setting_id;
        //     $ldata['first_name'] = $data['name'];
        //     $ldata['user_name'] = $data['email'];
        //     $ldata['user_type_id'] = 3;
        //     $this->settings_model->save($ldata, $check_existing_data->user_id);
        
        // } else {
        //     $ldata['id_gsettings'] = $setting_id;
        //     $ldata['first_name'] = $data['name'];
        //     $ldata['user_name'] = $data['email'];
        //     $ldata['password'] = $this->hash('companyadmin');
        //     $ldata['user_type_id'] = 3;
        //     $this->settings_model->save($ldata);
        // }
        
        // messages for user
        $type = "success";
        $message = "Card Information Successfully Update!";
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
