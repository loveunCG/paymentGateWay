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
class Finance extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('settings_model');
         // $this->load->model('mailbox_model');
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
        $data['title'] = "Gateway Manage"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_gateway_info(1);
        $data['subview'] = $this->load->view('admin/gateway/basic_info', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function Issued()
    {
        $withdraw_count = $this->settings_model->withdraw_counts_emp();
        $today = date("Y-m-d")." 00:00:00";
        if (!empty($withdraw_count)) {
           foreach ($withdraw_count as $count_into) {
               if ($count_into->time_time!=$today) {
                   if ($count_into->time_count > 0) {
                       $data_count['time_time'] = $today;
                       $data_count['time_count'] = $count_into->time_count-1;
                   }else{
                        $data_count['time_state'] = 1;
                        $data_count['create_time'] = date("Y-m-d H:i:s");
                   }
                $this->settings_model->_table_name = "tbl_delivery"; // table name
                $this->settings_model->_primary_key = "id"; // $id
                $this->settings_model->save($data_count, $count_into->id); 
               }
           }
        }


        $data['title'] = "Issued Application List"; //Page title
        $bankstatus = $this->input->post('bank_status', TRUE);
        $data['bankstatus'] = $bankstatus;
        $data['cinfo'] = $this->settings_model->get_employee_withdraw_info(0, $bankstatus);

        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['delivery_mount'];
        }
        $data['total'] =  $mount ;        
        $data['subview'] = $this->load->view('admin/finance/financeissued', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    } 

    public function send_finance() {
        // get sellected id into inbox email page
        $selected_inbox_id = $this->input->post('selected_send_id', TRUE);
        if (empty($selected_inbox_id)) {
            redirect('admin/finance/Issued');
        }
        $totalprice = 0;
        if (!empty($selected_inbox_id)) { // check selected message is empty or not
            foreach ($selected_inbox_id as $v_inbox_id) {
                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_order_by = "id";
                $total =  $this->settings_model->get_by(array('id' => $v_inbox_id), true);               
                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_primary_key = "id";
                $this->settings_model->save(array('delivery_status' => 1,'complete_time'=>date("Y-m-d H:i:s")), $v_inbox_id);            
                $totalprice = $totalprice +  $total->delivery_mount; 
            }
        } else {
            exit;
        }

        $type = "success";
        $message = "总量 : ".$totalprice."元  加工!!!";
        set_message($type, $message);
        redirect('admin/finance/delivery');

    }

    public function complete_req() {
        // get sellected id into inbox email page
        $selected_inbox_id = $this->input->post('selected_send_id', TRUE);
        if (empty($selected_inbox_id)) {
            redirect('admin/finance/Issued');
        }
        $totalprice = 0;
        if (!empty($selected_inbox_id)) { // check selected message is empty or not
            foreach ($selected_inbox_id as $v_inbox_id) {
                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_order_by = "id";
                $total =  $this->settings_model->get_by(array('id' => $v_inbox_id), true);               
                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_primary_key = "id";
                $this->settings_model->save(array('delivery_status' => 2,'complete_time'=>date("Y-m-d H:i:s")), $v_inbox_id);            
                $totalprice = $totalprice +  $total->delivery_mount; 
            }
        } else {
            exit;
        }

        $this->settings_model->_table_name = 'tbl_admin_order';
        $P_OrderId = date("YmdHis")."".rand(1000000,9999999);
        $data['admin_order_id'] = $P_OrderId;
        $data['admin_total_price'] = $totalprice;
        $data['create_time'] = date("Y-m-d H:i:s");
        $this->settings_model->save($data);

        $type = "success";
        $message = "总量 : ".$totalprice."元  加工!!!";
        set_message($type, $message);
        redirect('admin/finance/success');

    }

    public function success_accept($id) {

        if (empty($id)) {
            redirect('admin/finance/Issued');
        }
        $totalprice = 0;
        if (!empty($id)) { // check selected message is empty or not

                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_order_by = "id";
                $total =  $this->settings_model->get_by(array('id' => $id), true);               
                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_primary_key = "id";
                $this->settings_model->save(array('delivery_status' => 2,'complete_time'=>date("Y-m-d H:i:s")), $id);            
                $totalprice = $totalprice +  $total->delivery_mount; 

        } else {
            exit;
        }

        $this->settings_model->_table_name = 'tbl_admin_order';
        $P_OrderId = date("YmdHis")."".rand(1000000,9999999);
        $data['admin_order_id'] = $P_OrderId;
        $data['admin_total_price'] = $totalprice;
        $data['create_time'] = date("Y-m-d H:i:s");
        $this->settings_model->save($data);

        $type = "success";
        $message = "总量 : ".$totalprice."元  加工!!!";
        set_message($type, $message);
        redirect('admin/finance/success');

    }          

    public function request_accept($id) {

        if (empty($id)) {
            redirect('admin/finance/Issued');
        }
        $totalprice = 0;
        if (!empty($id)) { 
                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_order_by = "id";
                $total =  $this->settings_model->get_by(array('id' => $id), true);               
                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_primary_key = "id";
                $this->settings_model->save(array('delivery_status' => 1,'complete_time'=>date("Y-m-d H:i:s")), $id);            
                $totalprice = $totalprice +  $total->delivery_mount; 

        } else {
            exit;
        }

        $type = "success";
        $message = "总量 : ".$totalprice."元  加工!!!";
        set_message($type, $message);
        redirect('admin/finance/delivery');

    }    

    public function reject_request() {
        $id = $this->input->post('std', TRUE);
        $reason = $this->input->post('reason', TRUE);
        $pay_mode = $this->input->post('pay_mode', TRUE);
        if (empty($id)) {
            redirect('admin/finance/Issued');
        }
        $totalprice = 0 ; 
        if (!empty($id)) { // check selected message is empty or not

                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_order_by = "id";
                $total =  $this->settings_model->get_by(array('id' => $id), true);               
                $this->settings_model->_table_name = 'tbl_delivery';
                $this->settings_model->_primary_key = "id";
                $this->settings_model->save(array('delivery_status' => 3, 'pay_mode' => $pay_mode,'complete_time'=>date("Y-m-d H:i:s"),'reason'=>$reason), $id);            
                $totalprice = $totalprice +  $total->delivery_mount+$total->fee; 

        } else {
            exit;
        }
        if ($pay_mode==1) {
            $this->settings_model->_table_name = 'tbl_employee';
            $this->settings_model->_order_by = "employee_id";
            $emp_info =  $this->settings_model->get_by(array('employee_id' => $total->employee_id), true); 
            $re_amount = $emp_info->usr_amount + $totalprice;
            $ji_amount = $emp_info->jisuan_jine + $totalprice;
            $this->settings_model->_table_name = 'tbl_employee';
            $this->settings_model->_primary_key = "employee_id";
            $data['usr_amount'] = $re_amount;
            $data['jisuan_jine'] = $ji_amount;
            $this->settings_model->save($data ,$total->employee_id);
            $type = "success";
            $message = "直接拒绝 : ".$totalprice."元 拒绝!!!";
            set_message($type, $message);
            redirect('admin/finance/reject');
        }else{
            $type = "success";
            $message = "拒绝并不退款 : ".$totalprice."元 拒绝!!!";
            set_message($type, $message);
            redirect('admin/finance/reject');
        }




    }    

    public function payment_callback_url()
    {
        $P_UserId = "27641"; //商户ID
        $SalfStr = "1234567890"; //商户key
        $OrderId = $_REQUEST["ordernumber"];
        //$notic = $_REQUEST["attach"];
        $ErrCode = $_REQUEST["orderstatus"];
        $PostKey = $_REQUEST["sign"];
        $payMoney = $_REQUEST["paymoney"];
        $preEncodeStr = "partner=".$P_UserId."&ordernumber=".$OrderId."&orderstatus=".$ErrCode."&paymoney=".$payMoney.$SalfStr;
        $encodeStr = md5($preEncodeStr);
        if($PostKey == $encodeStr)
        {
            if($ErrCode == "1") //success
            {
                $this->settings_model->_table_name = 'tbl_finance';
                $this->settings_model->_primary_key = "finance_operation";
                $this->settings_model->save(array('finance_operation' => 4, 'finance_admin_order' => $OrderId), 6);
            }
            else //failed
            {
                $this->settings_model->_table_name = 'tbl_finance';
                $this->settings_model->_primary_key = "finance_operation";
                $this->settings_model->save(array('finance_operation' => 3, 'finance_admin_order' => $OrderId), 6);
                exit;
            }
        }
        else
        {
            exit;
        }
        echo "ok";
    }

    public function payment_hrefback_url()
    {
        redirect('admin/finance/Issued');
    }

    public function delivery()
    {
        $data['title'] = "Issued Application List"; //Page title
        $bankstatus = $this->input->post('bank_status', TRUE);
        $data['bankstatus'] = $bankstatus;
        $data['cinfo'] = $this->settings_model->get_employee_withdraw_info(1, $bankstatus);
        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['delivery_mount'];
        }
        $data['total'] =  $mount ;         
        $data['subview'] = $this->load->view('admin/finance/delivery', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function reject_view($id)
    {
        $data['title'] = "Issued Application List"; //Page title        
        $data['std'] = $id;
        $data['subview'] = $this->load->view('admin/finance/reject_view', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    } 

    public function reject_agent_view($id)
    {
        $data['title'] = "Issued Application List"; //Page title        
        $data['std'] = $id;
        $data['subview'] = $this->load->view('admin/finance/reject_agent_view', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }     

    public function agent_reason($id)
    {
        $data['title'] = "Issued Application List"; //Page title        
            $this->settings_model->_table_name = 'tbl_agent_withdraw';
            $this->settings_model->_order_by = "id";
            $data['with_info'] =  $this->settings_model->get_by(array('id' => $id), true); 
        $data['subview'] = $this->load->view('admin/finance/agent_reason_view', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    } 

    public function emp_reason($id)
    {
        $data['title'] = "Issued Application List"; //Page title        
            $this->settings_model->_table_name = 'tbl_delivery';
            $this->settings_model->_order_by = "id";
            $data['with_info'] =  $this->settings_model->get_by(array('id' => $id), true); 
        $data['subview'] = $this->load->view('admin/finance/emp_reason_view', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    } 

    public function success()
    {
        $data['title'] = "Issued Application List"; //Page title
         $data['employee_id'] = $this->input->post('employee_id');
         $data['start_date'] = $this->input->post('start_date');
         $data['end_date'] = $this->input->post('end_date');
         $data['bank_name'] = $this->input->post('bank_name');
        if ($this->input->post('state')) {
            $data['cinfo'] = $this->settings_model->search_employee_withdraw_info(2);
        }else{
            $data['cinfo'] = $this->settings_model->get_employee_withdraw_info(2); 
        }
        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['delivery_mount'];
        }
        $data['total'] =  $mount ;
        $data['subview'] = $this->load->view('admin/finance/success', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    } 

    public function reject()
    {
         $data['employee_id'] = $this->input->post('employee_id');
         $data['start_date'] = $this->input->post('start_date');
         $data['end_date'] = $this->input->post('end_date');
         $data['bank_name'] = $this->input->post('bank_name');
        if ($this->input->post('state')) {
            $data['cinfo'] = $this->settings_model->search_employee_withdraw_info(3);
        }else{
            $data['cinfo'] = $this->settings_model->get_employee_withdraw_info(3); 
        }
        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['delivery_mount'];
        }
        $data['total'] =  $mount ;
        $data['subview'] = $this->load->view('admin/finance/reject', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }     

    public function paylist()
    {
        $data['title'] = "Issued Application List"; //Page title
        
        $data['cinfo'] = $this->settings_model->get_issued_info();
        $data['subview'] = $this->load->view('admin/finance/paylist', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    } 

    public function merchant($all_final)
    {   
         $data['employee_id'] = $this->input->post('employee_id');
         $data['request_mount'] = $this->input->post('request_mount');
         $data['able_mount'] = $this->input->post('able_mount');

        $data['cinfo'] = $this->settings_model->employee_withdraw_sear_com(1);

        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['jisuan_jine'];
        }
        $data['total'] =  $mount ;
        

        $data['subview'] = $this->load->view('admin/finance/merchant', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function merchant_all($all_final)
    { 
        $selected_inbox_id = $this->input->post('selected_send_id', TRUE);

        if (!empty($selected_inbox_id)) { // check selected message is empty or not
            foreach ($selected_inbox_id as $v_inbox_id) {               
                $total_info =  $this->settings_model->get_employee_pay($v_inbox_id);
                if (!empty($total_info)) {
                    if ($total_info->usr_amount>100) {
                         $pay_amount =  $total_info->usr_amount * $total_info->group_fee/100;
                         if ($pay_amount>5 && $pay_amount<50) {
                             
                         }elseif($pay_amount<5){
                            $pay_amount = 5 ;
                         }elseif ($pay_amount>50) {
                            $pay_amount = 50;
                         }
                         $save_amount = $total_info->usr_amount - $pay_amount;

                        $this->settings_model->_table_name = "tbl_employee"; //table name
                        $this->settings_model->_primary_key = "employee_id";
                        $datal['usr_amount'] = 0;
                        $val = $this->settings_model->save($datal, $v_inbox_id);

                        $this->settings_model->_table_name = "tbl_delivery"; //table name
                        $this->settings_model->_primary_key = "id";
                        $datat['employee_id'] = $v_inbox_id;
                        $datat['delivery_mount'] = $save_amount;
                        $datat['fee'] = $pay_amount;
                        $datat['delivery_bank_name'] = $total_info->usr_bank_name;
                        $datat['delivery_bankbrach_name'] = $total_info->usr_address_1.$total_info->usr_address_2;
                        $datat['delivery_bank_card'] =  $total_info->usr_bank_num;
                        $datat['user_name'] = $total_info->usr_law_name; 
                        $datat['create_time'] = date("Y-m-d H:i:s");
                        $datat['complete_time'] = date("Y-m-d H:i:s"); 
                        $datat['delivery_status'] = 1;                                                                       
                        $val = $this->settings_model->save($datat, $finance_serial);
                    }else{
                            $type = "error";
                            $message = $v_inbox_id."的金额空白，提现不了！！";
                            set_message($type, $message);
                            redirect('admin/finance/merchant');
                    }

                }else{
                    $type = "error";
                    $message = $v_inbox_id."的不在了！！";
                    set_message($type, $message);
                    redirect('admin/finance/merchant');
                }
            }
        } else {
               $type = "error";
                $message = "失败！！";
                set_message($type, $message);
                redirect('admin/finance/merchant');
        }
        $type = "success";
        $message = "信息成功更新！";
        set_message($type, $message);
        redirect('admin/finance/merchant');        
    }  


    public function agent_with_all(){ 

        $selected_inbox_id = $this->input->post('selected_send_id', TRUE);

        if (!empty($selected_inbox_id)) { // check selected message is empty or not
            foreach ($selected_inbox_id as $v_inbox_id) {
                $total_info =  $this->settings_model->get_agent_pay($v_inbox_id);
                if (!empty($total_info->with_able_mount)) {
                    if ($total_info->with_able_mount>$total_info->low_with_amount) {
                            $pay_amount =  $total_info->with_able_mount * $total_info->default_rate/100;
                            if ($pay_amount>5 && $pay_amount<50) {
                             
                            }elseif($pay_amount<5){
                                $pay_amount = 5 ;
                            }elseif ($pay_amount>50) {
                                $pay_amount = 50;
                            }
                            $save_amount = $total_info->with_able_mount - $pay_amount;

                            $this->settings_model->_table_name = 'tbl_agent_withdraw';
                            $this->settings_model->_primary_key = "id";

                            $dataee['withdraw_mount'] =  $save_amount;
                            $dataee['agent_id'] =  $v_inbox_id;
                            $dataee['withdraw_time'] =  date("Y-m-d H:i:s");
                            $dataee['pay_time'] =  date("Y-m-d H:i:s");
                            $dataee['pay_state'] =  1;
                            $dataee['fee'] =  $pay_amount;
                            $this->settings_model->save($dataee, $value_id); 
                            $user_re_amount = $total_info->account_amount - $total_info->with_able_mount;
                            $this->settings_model->_table_name = 'tbl_proxy';
                            $this->settings_model->_primary_key = "proxy_id";
                            $this->settings_model->save(array('account_amount' =>$user_re_amount, 'with_able_mount'=>0 ), $v_inbox_id); 
                    }else{
                        $type = "error";
                        $message = $v_inbox_id."的金额空白，提现不了！！";
                        set_message($type, $message);
                        redirect('admin/finance/agent_withdraw_ready');
                    }

                }else{
                        $type = "error";
                        $message = $v_inbox_id."的不在了！！";
                        set_message($type, $message);
                        redirect('admin/finance/agent_withdraw_ready');
                    }
            }
        } else {
               $type = "error";
                $message = "提现失败！！";
                set_message($type, $message);
                redirect('admin/finance/agent_withdraw_ready');
        }
        $type = "success";
        $message = "提现成功！！！";
        set_message($type, $message);
        redirect('admin/finance/agent_withdraw_ready');
    }                              

    public function add_gateway($id = NULL) {// this function is to create get monthy recap report 
         $data['title'] = "Add New Channel";

        for ($i = 1; $i < 4; $i++) { // query for months
             $chid[$i] = $i; 
        } 
        $data['gateid']  = $chid ;   

        if (!empty($id)) 
        {
            // retrive data from db by id            
            
            $this->settings_model->_table_name = "tbl_channel"; //table name
            $this->settings_model->_order_by = "id";
            $val = $this->settings_model->get_by(array('id' => $id), TRUE);

            // $this->settings_model->_table_name = "countries"; //table name
            // $this->settings_model->_order_by = "countryName";
            // $data['all_country'] = $this->settings_model->get();
            if ($val) { // get general info by id
                $data['ginfo'] = $val; // assign value from db    
            }
            $data['cinfo'] = $this->settings_model->get_gateway_info($id);
            // retrive country
            // $this->settings_model->_table_name = "currency"; //table name
            // $this->settings_model->_order_by = "currency_id";
            // $data['all_currency'] = $this->settings_model->get(); // get result
        }
        
        $data['subview'] = $this->load->view('admin/gateway/gatewayadd', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function view_gateway($id = NULL) {// this function is to create get monthy recap report 
         $data['title'] = "Channel Settings";

        $data['cinfo'] = $this->settings_model->get_gatewaychannel_info();
        $data['subview'] = $this->load->view('admin/gateway/gatewayview', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function rate_setting() {// this function is to create get monthy recap report 
        $data['title'] = "Channel Rate Settings";
        $this->settings_model->_table_name = "tbl_channel_rate"; //table name
        $this->settings_model->_order_by = "id";
        $data['ginfo'] = $this->settings_model->get_by(array('id' => 1), TRUE);       
        $data['subview'] = $this->load->view('admin/gateway/channelrate', $data, TRUE);
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
        $message = "Card Information Successfully Update!";
        set_message($type, $message);
        redirect('admin/card/card');
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
        // messages for user
        $type = "success";
        $message = "频道信息成功删除！";
        set_message($type, $message);
        redirect('admin/gateway/gateway');
        
    } 

    public function agent_withdrawlist() {// agent withdraws list
        $withdraw_count = $this->settings_model->withdraw_counts();
        $today = date("Y-m-d")." 00:00:00";
        if (!empty($withdraw_count)) {
           foreach ($withdraw_count as $count_into) {
               if ($count_into->time_time!=$today) {
                   if ($count_into->time_count > 0) {
                       $data_count['time_time'] = $today;
                       $data_count['time_count'] = $count_into->time_count-1;
                   }else{
                        $data_count['time_state'] = 1;
                        $data_count['withdraw_time'] = date("Y-m-d H:i:s");
                   }
                $this->settings_model->_table_name = "tbl_agent_withdraw"; // table name
                $this->settings_model->_primary_key = "id"; // $id
                $this->settings_model->save($data_count, $count_into->id); 
               }
           }
        }

        $data['title'] = "Channel Rate Settings";
        $bankstatus = $this->input->post('bank_status', TRUE);
        $data['bankstatus'] = $bankstatus;
        $data['cinfo'] = $this->settings_model->get_agentwithdraw_info(0, $bankstatus);
        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['withdraw_mount'];
        }
        $data['total'] =  $mount ;
        $data['subview'] = $this->load->view('admin/finance/agent_withdrawlist', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function wait_withdrawlist() {// agent withdraws list
        $data['title'] = "Channel Rate Settings";
        $bankstatus = $this->input->post('bank_status', TRUE);
        $data['bankstatus'] = $bankstatus;
        $data['cinfo'] = $this->settings_model->get_agentwithdraw_info(1, $bankstatus);

        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['withdraw_mount'];
        }
        $data['total'] =  $mount ;        
        $data['subview'] = $this->load->view('admin/finance/wait_withdrawlist', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    } 

    public function success_withdrawlist() {// agent withdraws list
        $data['title'] = "Channel Rate Settings";
         $data['employee_id'] = $this->input->post('employee_id');
         $data['start_date'] = $this->input->post('start_date');
         $data['end_date'] = $this->input->post('end_date');
         $data['bank_name'] = $this->input->post('bank_name'); 

        if ($this->input->post('state')) {
            $data['cinfo'] = $this->settings_model->get_agentwithdraw_search_info(2);
        }else{
            $data['cinfo'] = $this->settings_model->get_agentwithdraw_info(2);
        }
        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['withdraw_mount'];
        }
        $data['total'] =  $mount ;
        $data['subview'] = $this->load->view('admin/finance/success_withdrawlist', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    } 

    public function reject_withdrawlist() {// agent withdraws list
        $data['title'] = "Channel Rate Settings";
         $data['employee_id'] = $this->input->post('employee_id');
         $data['start_date'] = $this->input->post('start_date');
         $data['end_date'] = $this->input->post('end_date');
         $data['bank_name'] = $this->input->post('bank_name');        
        if ($this->input->post('state')) {
            $data['cinfo'] = $this->settings_model->get_agentwithdraw_search_info(3);
        }else{
            $data['cinfo'] = $this->settings_model->get_agentwithdraw_info(3);
        }
        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['withdraw_mount'];
        }
        $data['total'] =  $mount ;

        $data['subview'] = $this->load->view('admin/finance/reject_withdrawlist', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function agent_withdraw_ready() {// agent withdraws list
        $data['title'] = "Channel Rate Settings";
         $data['employee_id'] = $this->input->post('employee_id');
         $data['request_mount'] = $this->input->post('request_mount');
         $data['able_mount'] = $this->input->post('able_mount');
         if ($this->input->post('state')) {
        $data['cinfo'] = $this->settings_model->get_agentwithdraw_search_ready();
         }else{
        $data['cinfo'] = $this->settings_model->get_agentwithdraw_search_ready();
         }

        
        $mount = 0;
        foreach ($data['cinfo'] as $price) {
           $mount = $mount + $price['final_price'];
        }
        $data['total'] =  $mount ;         
        $data['subview'] = $this->load->view('admin/finance/ready_withdrawlist', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }                          

    public function accept_agent_withdraw($id = NULL) {
        $totalprice = 0;
        if($id){
                $this->settings_model->_table_name = 'tbl_agent_withdraw';
                $this->settings_model->_order_by = "id";
                $total =  $this->settings_model->get_by(array('id' => $id), true);               
                $this->settings_model->_table_name = 'tbl_agent_withdraw';
                $this->settings_model->_primary_key = "id";
                $this->settings_model->save(array('pay_state' => 1,'pay_time'=>date("Y-m-d H:i:s")), $id);            
                $totalprice = $totalprice +  $total->withdraw_mount; 
            }else{
        $selected_inbox_id = $this->input->post('selected_send_id', TRUE);
        if (empty($selected_inbox_id)) {
            redirect('admin/finance/agent_withdrawlist');
        }

        if (!empty($selected_inbox_id)) { // check selected message is empty or not
            foreach ($selected_inbox_id as $v_inbox_id) {
                $this->settings_model->_table_name = 'tbl_agent_withdraw';
                $this->settings_model->_order_by = "id";
                $total =  $this->settings_model->get_by(array('id' => $v_inbox_id), true);               
                $this->settings_model->_table_name = 'tbl_agent_withdraw';
                $this->settings_model->_primary_key = "id";
                $this->settings_model->save(array('pay_state' => 1,'pay_time'=>date("Y-m-d H:i:s")), $v_inbox_id);            
                $totalprice = $totalprice +  $total->withdraw_mount; 
            }
        } else {
            exit;
        }
    }

        $type = "success";
        $message = "总量 : ".$totalprice."元  加工!!!";
        set_message($type, $message);
        redirect('admin/finance/wait_withdrawlist');

    }

    public function success_agent_withdraw($id = NULL) {

        $this->settings_model->_table_name = "tbl_agent_withdraw"; // table name
        $this->settings_model->_primary_key = "id"; // $id
        $data['pay_state'] = 2;
        $this->settings_model->save($data, $id);        
 
        $type = "success";
        $message = "撤回接受成功更新！";
        set_message($type, $message);
        redirect('admin/finance/success_withdrawlist');
    }    

    public function reject_agent_withdraw() {
        $id = $this->input->post('std', TRUE);
        $reason = $this->input->post('reason', TRUE);
        $pay_mode = $this->input->post('pay_mode', TRUE);
        $this->settings_model->_table_name = "tbl_agent_withdraw"; // table name
        $this->settings_model->_primary_key = "id"; // $id
        $data['pay_state'] = 3;
        $data['reason'] = $reason;
        $data['pay_mode'] = $pay_mode;
        $data['pay_time'] = date("Y-m-d H:i:s");
        
        $this->settings_model->save($data, $id);
        if ($pay_mode==1) {
            $this->settings_model->_table_name = 'tbl_agent_withdraw';
            $this->settings_model->_order_by = "id";
            $with_info =  $this->settings_model->get_by(array('id' => $id), true);

            $this->settings_model->_table_name = 'tbl_proxy';
            $this->settings_model->_order_by = "proxy_id";
            $agent_info =  $this->settings_model->get_by(array('proxy_id' => $with_info->agent_id), true);          
            
            $this->settings_model->_table_name = "tbl_proxy"; // table name
            $this->settings_model->_primary_key = "proxy_id"; // $id
            $dataww['account_amount'] = $agent_info->account_amount +$with_info->withdraw_mount+$with_info->fee;
            $this->settings_model->save($dataww, $with_info->agent_id); 
        }
        
        $type = "success";
        $message = "撤回拒绝成功更新！";
        set_message($type, $message);
        redirect('admin/finance/reject_withdrawlist');
    }  

    public function refund_agent_view($id) {

        $this->settings_model->_table_name = "tbl_agent_withdraw"; // table name
        $this->settings_model->_primary_key = "id"; // $id
        $data['pay_state'] = 0;
        $data['withdraw_time'] = date("Y-m-d H:i:s");
        
        $this->settings_model->save($data, $id);
        $type = "success";
        $message = "撤回拒绝成功更新！";
        set_message($type, $message);
        redirect('admin/finance/reject_withdrawlist');
    }  

    public function refund_emp_view($id) {

        $this->settings_model->_table_name = "tbl_delivery"; // table name
        $this->settings_model->_primary_key = "id"; // $id
        $data['delivery_status'] = 0;
        $data['create_time'] = date("Y-m-d H:i:s");
        
        $this->settings_model->save($data, $id);
        $type = "success";
        $message = "撤回拒绝成功更新！";
        set_message($type, $message);
        redirect('admin/finance/reject');
    }                    

}
