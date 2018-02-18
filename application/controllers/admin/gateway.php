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
class Gateway extends Admin_Controller {

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

    public function index($id = null)
    {
        $data['title'] = "Gateway Manage"; //Page title
        // $id = 1;

        $data['ginfo'] = $this->settings_model->get_gateway_info();
        
        $data['subview'] = $this->load->view('admin/gateway/gateway_list', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function online($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(1);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(1);

        $data['subview'] = $this->load->view('admin/gateway/online', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    } 

    public function wapalipay($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(6);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(6);




        $data['subview'] = $this->load->view('admin/gateway/wapalipay', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }   

    public function wapqq($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(8);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(8);




        $data['subview'] = $this->load->view('admin/gateway/wapqq', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }  
    public function waptenpay($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(7);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(7);




        $data['subview'] = $this->load->view('admin/gateway/waptenpay', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }             

    public function alipay($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(3);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(3);




        $data['subview'] = $this->load->view('admin/gateway/alipay', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }  
    public function tenpay($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(4);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(4);




        $data['subview'] = $this->load->view('admin/gateway/tenpay', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }  

    public function weixin($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(5);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(5);




        $data['subview'] = $this->load->view('admin/gateway/weixin', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }  

    public function daifu($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(10);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(10);




        $data['subview'] = $this->load->view('admin/gateway/daifu', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }   

    public function wapweixin($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(9);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(9);
        $data['subview'] = $this->load->view('admin/gateway/wapweixin', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }    

    public function card($id = null)
    {
        $data['title'] = "Basic information Setting"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(2);   //alipay channel 2 select 
            

        $data['allinfo'] = $this->settings_model->get_gateway_list(2);

        $data['subview'] = $this->load->view('admin/gateway/card', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }                             

    public function add_gateway($id = NULL) {// this function is to create get monthy recap report 
         $data['title'] = "Add New Channel";

            $this->settings_model->_table_name = "tbl_gateway_type"; //table name
            $this->settings_model->_order_by = "id";
            $data['typeinfo'] = $this->settings_model->get();

        if (!empty($id)) 
        {
            // retrive data from db by id            
            
            $this->settings_model->_table_name = "tbl_channel"; //table name
            $this->settings_model->_order_by = "id";
            $val = $this->settings_model->get_by(array('id' => $id), TRUE);

            if ($val) { // get general info by id
                $data['ginfo'] = $val; // assign value from db    
            }
            $data['cinfo'] = $this->settings_model->get_gateway_info($id);

        }
        
        $data['subview'] = $this->load->view('admin/gateway/gatewayadd', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function add_channel($id = NULL, $gateway=null) {
            $data['title'] = "Add New Channel";

            $this->settings_model->_table_name = "tbl_gateway_type"; //table name
            $this->settings_model->_order_by = "id";
            $data['typeinfo'] = $this->settings_model->get();

        if (!empty($id)) 
        {                    
            
            $this->settings_model->_table_name = "tbl_channel"; //table name
            $this->settings_model->_order_by = "id";
            $val = $this->settings_model->get_by(array('id' => $id), TRUE);

            if ($val) { // get general info by id
                $data['ginfo'] = $val; // assign value from db    
            }
            $data['cinfo'] = $this->settings_model->get_gateway_list($gateway);
        } 

        $data['cinfo'] = $this->settings_model->get_gateway_all_list();
        
        $data['subview'] = $this->load->view('admin/gateway/add_channel', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function view_channel($id = NULL, $gateway=null) {
        $data['title'] = "Add New Channel";

        $this->settings_model->_table_name = "tbl_gateway_type"; //table name
        $this->settings_model->_order_by = "id";
        $data['typeinfo'] = $this->settings_model->get();
        $data['gatenum'] = $id ;    
        $data['cinfo'] = $this->settings_model->get_gateway_view_info($gateway); //tbl_gateway_type.id = tbl_channel.gateway_type
        $this->settings_model->_table_name = "tbl_channel"; //table name
        $this->settings_model->_order_by = "id";
        $val = $this->settings_model->get_by(array('id' => $id), TRUE);     

        if ($val) { // get general info by id
            $data['ginfo'] = $val; // assign value from db    
        }

        $data['gateway_info'] = $this->settings_model->get_gatewayinfo($gateway);          
        
        $data['subview'] = $this->load->view('admin/gateway/view_channel', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }    

     public function on_select(){
       $gatewayID = $this->input->post('getid');
        $data = $this->settings_model->get_gateway_list_json($gatewayID);
        echo json_encode($data);
     } 
     
     public function get_basic(){
        $id = $this->input->post('getid');
        $info = $this->settings_model->get_basic_list_json($id);
        echo json_encode($info);
     }

    public function add_gateway_account($id = NULL,$emp=null) {
        $data['title'] = "Add New Channel";
        $data['gateway_id'] = $id;


        if (!empty($emp)) 
        {
            // retrive data from db by id            
            
            $this->settings_model->_table_name = "tbl_gateway_account"; //table name
            $this->settings_model->_order_by = "id";
            $val = $this->settings_model->get_by(array('id' => $emp), TRUE);

            if ($val) { // get general info by id
                $data['ginfo'] = $val; // assign value from db    
            }
            $data['cinfo'] = $this->settings_model->get_gateway_list($emp);
        }
        
        $data['subview'] = $this->load->view('admin/gateway/add_gateway_account', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }          

    public function gateway_account($id = NULL) {// this function is to create get monthy recap report 
        $data['title'] = "Channel Settings";
        $data['gateway_id'] = $id;
        $data['cinfo'] = $this->settings_model->get_gateway_account_info($id);
        $data['subview'] = $this->load->view('admin/gateway/gateway_account', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function rate_setting() {// this function is to create get monthy recap report 
        $data['title'] = "Channel Rate Settings";
        $this->settings_model->_table_name = "tbl_channel_rate"; //table name
        $this->settings_model->_order_by = "id";
        $data['ginfo'] = $this->settings_model->get();       
        $data['subview'] = $this->load->view('admin/gateway/channelrate', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }    

    public function save_cinfo($id = NULL) {   
        
        $this->settings_model->_table_name = "tbl_channel"; // table name
        $this->settings_model->_primary_key = "id"; // $id

        $data = $this->settings_model->array_from_post(array('gateway_name', 'gateway_type','gateway_mark','gateway_mail','gateway_access_address','gateway_product_name','gateway_product_description','gateway_company','gateway_cycle_amount','gateway_notes','gateway_rate_basic'));
        $data['parent'] = 1;
        $setting_id = $this->settings_model->save($data, $id);
        $type = "success";
        $message = "网关信息成功更新！";
        set_message($type, $message);
        redirect('admin/gateway/gateway');
    }

    public function save_gateway_account($id = NULL) {   
        
        $this->settings_model->_table_name = "tbl_gateway_account"; // table name
        $this->settings_model->_primary_key = "id"; // $id

        $data = $this->settings_model->array_from_post(array('gateway_id', 'account_name','account_id','account_key','account_email','jump_state','jump_address','loop_state','sort_id'));
        $setting_id = $this->settings_model->save($data, $id);
        $type = "success";
        $message = "网关账户信息成功更新！";
        set_message($type, $message);
        redirect('admin/gateway/gateway_account/'.$data['gateway_id']);
    }    

    public function save_channel($id = NULL) {   
        
        $this->settings_model->_table_name = "tbl_channel"; // table name
        $this->settings_model->_primary_key = "id"; // $id
        $goto = $this->input->post('channel_type', TRUE);
        if($_POST['channel_status']){
            $data = $this->settings_model->array_from_post(array('channel_name', 'channel_type','channel_gateway','channel_code','channel_cost_ratio','channel_status'));
        }else{
            $data = $this->settings_model->array_from_post(array('channel_name', 'channel_type','channel_gateway','channel_code','channel_cost_ratio'));
        }
        $setting_id = $this->settings_model->save($data, $id);
        $type = "success";
        $message = "通道信息成功更新！";
        set_message($type, $message);
        if ($goto==1) {
           redirect('admin/gateway/online');
        }elseif ($goto==2) {
           redirect('admin/gateway/card');
        }elseif ($goto==3) {
           redirect('admin/gateway/alipay');
        }elseif ($goto==4) {
           redirect('admin/gateway/tenpay');
        }elseif ($goto==5) {
           redirect('admin/gateway/weixin');
        }elseif ($goto==6) {
           redirect('admin/gateway/wapalipay');
        }elseif ($goto==7) {
           redirect('admin/gateway/waptenpay');
        }elseif ($goto==8) {
           redirect('admin/gateway/wapqq');
        }elseif ($goto==9) {
           redirect('admin/gateway/wapweixin');
        }elseif ($goto==10) {
           redirect('admin/gateway/daifu');
        }
    }    

    public function save_rate($id = NULL) {

        $this->settings_model->_table_name = "tbl_channel_rate"; //table name
        $this->settings_model->_order_by = "id";
        $saveinfo = $this->settings_model->get();  

        foreach ($saveinfo as $value) {
            $this->settings_model->_table_name = "tbl_channel_rate"; //table name
            $this->settings_model->_primary_key = "id";
            if (!empty($this->input->post($value->channel_code, TRUE))) {
                $data['cost_rate'] = $this->input->post($value->channel_code, TRUE);
                $this->settings_model->save($data,$value->id);
            }

        } 

        $this->settings_model->_table_name = "tbl_channel_rate"; //table name
        $this->settings_model->_primary_key = "use_online";
        $datal['cost_rate'] = $this->input->post('ONLINE', TRUE);

        $this->settings_model->save($datal, 1);

        $online = $this->input->post('ONLINE', TRUE);
        $tenpay = $this->input->post('TENPAY', TRUE);
        $weixin = $this->input->post('WEIXIN', TRUE);
        $alipay = $this->input->post('ALIPAY', TRUE);
        $wapalipay = $this->input->post('ALIPAYWAP', TRUE);
        $wapweixin = $this->input->post('WEIXINWAP', TRUE);
        $daifu = $this->input->post('DAIFU', TRUE);

        $datae = array('ONLINE' => $online,'TENPAY'=>$tenpay,'WEIXIN'=>$weixin,'ALIPAY'=>$alipay,'ALIPAYWAP'=>$wapalipay,'WEIXINWAP'=>$wapweixin,'DAIFU'=>$daifu);
        $wheree = array('rate_status'=>0);
        $this->settings_model->set_action($wheree, $datae, 'tbl_employee');


        $dataeg = array('ONLINE' => $online,'TENPAY'=>$tenpay,'WEIXIN'=>$weixin,'ALIPAY'=>$alipay,'ALIPAYWAP'=>$wapalipay,'WEIXINWAP'=>$wapweixin,'DAIFU'=>$daifu);
        $whereeg = array('user_rate_limit_set'=>0);
        $this->settings_model->set_action($whereeg, $dataeg, 'tbl_employee_group');

        $dataag = array('ONLINE' => $online,'TENPAY'=>$tenpay,'WEIXIN'=>$weixin,'ALIPAY'=>$alipay,'ALIPAYWAP'=>$wapalipay,'WEIXINWAP'=>$wapweixin,'DAIFU'=>$daifu);
        $whereag = array('agent_limit_set'=>0);
        $this->settings_model->set_action($whereag, $dataag, 'tbl_agent_group');          

        $type = "success";
        $message = "通道费率设置成功更新！";
        set_message($type, $message);
        redirect('admin/gateway/rate_setting');
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }  

    public function delete_gateway($id = NULL) 
    {
        // ************* Delete into Company Table 
        $this->settings_model->_table_name = "tbl_channel"; // table name
        $this->settings_model->_primary_key = "id"; // $id
        $this->settings_model->delete($id);        
        
        $type = "success";
        $message = "频道信息成功删除！";
        set_message($type, $message);
        redirect('admin/gateway/gateway');
        
    }      

}
