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
class Order extends Admin_Controller {

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

    public function index(){
        unset($data);
        if(!empty($_POST)){
        if($this->input->post('employee_id')&&$this->input->post('employee_id')!=''){
            $data['tbl_order.employee_id'] = $this->input->post('employee_id');
        }
        if($this->input->post('partner')&&$this->input->post('partner')!=''){
            $data['partner'] = $this->input->post('partner');

        }
         if($this->input->post('client_ip')&&$this->input->post('client_ip')!=''){
            $data['client_ip'] = $this->input->post('client_ip');

        }
         if($this->input->post('pay_mode')&&$this->input->post('pay_mode')!=''){
            $data['pay_mode'] = $this->input->post('pay_mode');

        }
         if($this->input->post('channel_id')&&$this->input->post('channel_id')!='-1'){
            $data['channel_id'] = $this->input->post('channel_id');

        }
			if($this->input->post('cost_rate')&&$this->input->post('cost_rate')!=''){
            $data['cost_rate'] = $this->input->post('cost_rate');

        }
         if($this->input->post('order_id')&&$this->input->post('order_id')!=''){
            $data['order_id'] = $this->input->post('order_id');

        }
          if($this->input->post('agent_account')&&$this->input->post('agent_account')!=''){
            $data['agent_account'] = $this->input->post('agent_account');

        }
          if($this->input->post('gourp_id')&&$this->input->post('gourp_id')!=''){
            $data['gourp_id'] = $this->input->post('gourp_id');
        }
        if($this->input->post('start_time')&&$this->input->post('start_time')!=''){
           $data['submit_time >='] = $this->input->post('start_time');
        }
        if($this->input->post('end_time')&&$this->input->post('end_time')!=''){
           $data['submit_time <'] = $this->input->post('end_time');
        }
        if($this->input->post('start_price')&&$this->input->post('start_price')!=''){
           $data['real_amount >='] = $this->input->post('start_price');
        }
        if($this->input->post('end_price')&&$this->input->post('end_price')!=''){
           $data['real_amount <='] = $this->input->post('end_price');
        }
        if($this->input->post('order_status')!=''){
            $data['order_status'] = $this->input->post('order_status');
        }
         if($this->input->post('use_online')&&$this->input->post('use_online')!='-1'){
            $data['use_online'] = $this->input->post('use_online');
        }
         if($this->input->post('pay_method')&&$this->input->post('pay_method')!='-1'){
            $data['pay_method'] = $this->input->post('pay_method');
            if ($this->input->post('pay_method')=="ONLINE") {
                $data['pay_method'] = "ICBC";
            }
        }
        }else{
             unset($data);
        }
        $data['orderinfo'] = $this->settings_model->all_get_order($data);
        $data['sum_succes_price'] = 0;
        foreach ($data['orderinfo'] as $row){
            $data['sum_succes_price'] += $row['ok_real_amount'];
        }
        $data['employee_id'] = $this->input->post('employee_id');
        $data['start_date'] = $this->input->post('start_time');
        $data['end_date'] = $this->input->post('end_time');
        $data['start_price'] = $this->input->post('start_price');
        $data['end_price'] = $this->input->post('end_price');
        $data['order_type'] = $this->input->post('order_type');
        $data['channel_id'] = $this->input->post('channel_id');
        $data['channel_status'] = $this->input->post('channel_status');
        $data['title'] = "订单管理"; //Page title
        $this->settings_model->_table_name = "tbl_channel"; // table name
        $this->settings_model->_order_by = "id"; // $id
        $data['all_channel'] = $this->settings_model->get();
        $this->settings_model->_table_name = "tbl_channel_rate"; // table name
        $this->settings_model->_order_by = "id"; // $id
        $data['all_leave_category'] = $this->settings_model->get();
        $data['orderinfo1'] = $this->settings_model->all_get_order_info();
        $data['subview'] = $this->load->view('admin/order/order', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function ordertracking($id = NULL) {
        unset($data);
        if(!empty($_POST)){
            if($this->input->post('employee_id')&&$this->input->post('employee_id')!=''){
                $data['tbl_order.employee_id'] = $this->input->post('employee_id');
            }
            if($this->input->post('partner')&&$this->input->post('partner')!=''){
                $data['partner'] = $this->input->post('partner');

            }
            if($this->input->post('client_ip')&&$this->input->post('client_ip')!=''){
                $data['client_ip'] = $this->input->post('client_ip');

            }
            if($this->input->post('pay_mode')&&$this->input->post('pay_mode')!=''){
                $data['pay_mode'] = $this->input->post('pay_mode');

            }
            if($this->input->post('use_online')&&$this->input->post('use_online')!='-1'){
            $data['use_online'] = $this->input->post('use_online');
            }
            if($this->input->post('cost_rate')&&$this->input->post('cost_rate')!=''){
                $data['cost_rate'] = $this->input->post('cost_rate');

            }

            if($this->input->post('order_id')&&$this->input->post('order_id')!=''){
                $data['order_id'] = $this->input->post('order_id');

            }
            if($this->input->post('agent_account')&&$this->input->post('agent_account')!=''){
                $data['agent_account'] = $this->input->post('agent_account');

            }
            if($this->input->post('gourp_id')&&$this->input->post('gourp_id')!=''){
                $data['gourp_id'] = $this->input->post('gourp_id');
            }

            if($this->input->post('start_time')&&$this->input->post('start_time')!=''){
                $data['submit_time >='] = $this->input->post('start_time');
            }
            if($this->input->post('end_time')&&$this->input->post('end_time')!=''){
                $data['submit_time <'] = $this->input->post('end_time');
            }
            if($this->input->post('order_status')&&$this->input->post('order_status')!='4'){
                $data['order_status'] = $this->input->post('order_status');
            }
             if($this->input->post('banktype')&&$this->input->post('banktype')!=''){
                $data['banktype'] = $this->input->post('banktype');
            }
        }else{
            unset($data);
        }
        //$data['orderinfo'] = $this->settings_model->all_get_order_info($data);
        //$data['employee_id'] = $data['orderinfo']->employee_id;

        $data['orderinfo'] = $this->settings_model->all_get_order($data);

        $data['start_date'] = $this->input->post('start_time');
        $data['end_date'] = $this->input->post('end_time');
        $data['title'] = "订单管理"; //Page title
        $this->settings_model->_table_name = "tbl_channel"; // table name
        $this->settings_model->_order_by = "id"; // $id
        $data['all_channel'] = $this->settings_model->get();
        $this->settings_model->_table_name = "tbl_channel_rate"; // table name
        $this->settings_model->_order_by = "id"; // $id
        $data['all_leave_category'] = $this->settings_model->get();
        $data['subview'] = $this->load->view('admin/order/ordertracking', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

     public function order_view($id = NULL) {
        $data['subview'] = $this->load->view('admin/order/ordertracking', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
     public function order_edit($id) {
        $data['title'] = "订单编辑"; //Page title
        $data['order_info'] = $this->settings_model->get_order_info($id);
        $data['subview'] = $this->load->view('admin/order/order_edit', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function order_detail($id) {
        $data['title'] = "订单编辑"; //Page title
        $data['order_info'] = $this->settings_model->get_order_info($id);
        $data['subview'] = $this->load->view('admin/order/order_detail', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function order_freeze($id , $emp_mon, $agent){

        $data = array('order_status' => 4, 'release_time'=>date("Y-m-d H:i:s"));
        $where = array('id'=>$id);
        $this->settings_model->set_action($where, $data, 'tbl_order');

        $this->settings_model->_table_name = 'tbl_order';
        $this->settings_model->_order_by = 'id';
        $order_data = $this->settings_model->get_by(array('id' => $id), TRUE);

        $this->settings_model->_table_name = 'tbl_employee';
        $this->settings_model->_order_by = 'employment_id';
        $emp_data = $this->settings_model->get_by(array('employee_id' => $order_data->employee_id), TRUE);

        $usr_amount = $emp_data->jisuan_jine-$emp_mon;
        $data = array('jisuan_jine' => $usr_amount);
        $where = array('employee_id'=>$order_data->employee_id);
        $this->settings_model->set_action($where, $data, 'tbl_employee');


        $type = "success";
        $message = "成功了";
        set_message($type, $message);
        redirect('admin/order/order');
    }
     public function order_delect($id) {
        $data['title'] = "订单编辑"; //Page title

        // $this->settings_model->_table_name = "tbl_order"; // table name
        // $this->settings_model->_primary_key = "order_id"; // $id
        // $this->settings_model->delete($id);
        $this->db->delete("tbl_order", array('order_id' => $id));

       redirect('admin/order');
    }
    function passive_proc($id){
//        $time = date("Y-m-d H:m:s", time());
//        $data = array('order_status' => 1,'release_time'=>$time);
//        $where = array('order_id'=>$id);
        //$this->settings_model->update( 'tbl_order', $data,$where);
        $this->settings_model->update_status($id,1);
        redirect('admin/order/order');
//        $this->settings_model->_table_name = 'tbl_order';
//        $this->settings_model->_order_by = 'id';
//        $order_data = $this->settings_model->get_by(array('order_id' => $id), TRUE);
//        $order_price =  $order_data->success_price;
//        $employee_id = $order_data->employee_id;
//        $this->settings_model->_table_name = 'tbl_employee';
//        $this->settings_model->_order_by = 'employment_id';
//        $emp_data = $this->settings_model->get_by(array('employee_id' => $employee_id), TRUE);
//        $usr_amount = $emp_data->usr_amount;
//        $usr_amount = $usr_amount + $order_price;
//        $data = array('usr_amount' => $usr_amount);
//        $where = array('employee_id'=>$employee_id);
//        $this->settings_model->set_action($where, $data, 'tbl_employee');
//        $data['title'] = "订单管理"; //Page title
//        $data['orderinfo'] = $this->settings_model->all_get_order_info();
//        $data['subview'] = $this->load->view('admin/order/order', $data, TRUE);
//        $this->load->view('admin/_layout_main', $data); //page load

    }
     public function order_proc($id) {

        $data['subview'] = $this->load->view('admin/order/order_edit', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

     public function order_accept($id ,$pingtai ,$agent) {
        $this->settings_model->_table_name = "tbl_order";
        $this->settings_model->_order_by = "id";
        $order_data = $this->settings_model->get_by(array('id' => $id), TRUE);

        $save['order_status'] = '7';
        $save['release_time'] = date("Y-m-d H:i:s");
        $where = array('id'=>$id);
        $this->settings_model->set_action($where, $save, 'tbl_order');


        $this->settings_model->_table_name = "tbl_gateway_account";
        $this->settings_model->_order_by = "id";
        $pingtai_data = $this->settings_model->get_by(array('account_email' => $order_data->proxy_mail), TRUE);
        $pingtai_mount = $pingtai_data->account_amount-$pingtai;
        $savep['account_amount'] = $pingtai_mount;
        $wherep = array('account_email'=>$order_data->proxy_mail);
        $this->settings_model->set_action($wherep, $savep, 'tbl_gateway_account');

        $this->settings_model->_table_name = "tbl_proxy";
        $this->settings_model->_order_by = "proxy_id";
        $agent_data = $this->settings_model->get_by(array('mail_address' => $order_data->proxy_mail), TRUE);
        $agent_mount = $agent_data->account_amount-$agent;
        $agent_with_mount = $agent_data->with_able_mount-$agent;
        $savea['account_amount'] = $agent_mount;
        $savea['with_able_mount'] = $agent_with_mount;
        $wherea = array('mail_address'=>$order_data->proxy_mail);
        $this->settings_model->set_action($wherea, $savea, 'tbl_proxy');

        $this->settings_model->_table_name = "tbl_employee";
        $this->settings_model->_order_by = "employee_id";
        $emp_data = $this->settings_model->get_by(array('employee_id' => $order_data->employee_id), TRUE);
        $real_mount = $emp_data->usr_amount + $pingtai + $agent;
        $real_with_mount = $emp_data->jisuan_jine + $pingtai + $agent;
        $emp_save['usr_amount'] = $real_mount;
        $emp_save['jisuan_jine'] = $real_with_mount;
        $wherew = array('employee_id'=>$order_data->employee_id);
        $this->settings_model->set_action($wherew, $emp_save, 'tbl_employee');

        $type = "success";
        $message = "成功了";
        set_message($type, $message);
        redirect('admin/order/order');
    }

     public function order_retry($id) {
        $data = array('order_status' => 1, 'release_time'=>date("Y-m-d H:i:s"));
        $where = array('id'=>$id);
        $this->settings_model->set_action($where, $data, 'tbl_order');

        $this->settings_model->_table_name = 'tbl_order';
        $this->settings_model->_order_by = 'id';
        $order_data = $this->settings_model->get_by(array('id' => $id), TRUE);

        $this->settings_model->_table_name = 'tbl_employee';
        $this->settings_model->_order_by = 'employment_id';
        $emp_data = $this->settings_model->get_by(array('employee_id' => $order_data->employee_id), TRUE);

        $usr_amount = $emp_data->jisuan_jine+$emp_mon;
        $data = array('jisuan_jine' => $usr_amount);
        $where = array('employee_id'=>$order_data->employee_id);
        $this->settings_model->set_action($where, $data, 'tbl_employee');

        $type = "success";
        $message = "成功了";
        set_message($type, $message);
        redirect('admin/order/order');
    }

<<<<<<< .mine
||||||| .r91
function passive_order(){
    $sys_order = $this->input->post('sys_serial_num');
        if($sys_order){
            if ($sys_order=="") {
                    $type = "error";
                    $message = "手动补单处理失败！";
                    set_message($type, $message);
                    redirect('admin/order/ordertracking');
            }
            $this->settings_model->_table_name = 'tbl_order';
            $this->settings_model->_order_by = "id";
            $check_order_id =  $this->settings_model->get_by(array('sys_serial_num' => $sys_order), true);
            if ($check_order_id) {
                    $type = "error";
                    $message = "手动补单处理失败！";
                    set_message($type, $message);
                    redirect('admin/order/ordertracking');
            }

        $employee_id = $this->input->post('employee_id');
        $banktype = $this->input->post('pay_method');
        if ($banktype=="") {
                $type = "error";
                $message = "手动补单处理失败！";
                set_message($type, $message);
                redirect('admin/order/ordertracking');
        }
        $chanel_name = '';
         if($banktype == 'ALIPAY'){
           $chanel_name = 'channel_alipay';
           $chanel_limit = "alipay_limit";
        }elseif($banktype == 'ALIPAYWAP'){
           $chanel_name = 'channel_wapalipay';
           $chanel_limit = "wapalipay_limit";
        }elseif($banktype == 'TENPAY'){
           $chanel_name = 'channel_tenpay';
           $chanel_limit = "tenpay_limit";
        }
        elseif($banktype == "WEIXIN"){
           $chanel_name = 'channel_weixin';
           $chanel_limit = "weixin_limit";
        }
        elseif($banktype == 'WEIXINWAP'){
           $chanel_name = 'channel_wapweixin';
           $chanel_limit = "weixin_limit";
        }  elseif($banktype == 'DAIFU'){
           $chanel_name = 'channel_daifu';
           $chanel_limit = "online_limit";
        } else{
           $chanel_name = 'channel_online';
           $chanel_limit = "online_limit";
           $banktype_clone = "ONLINE";
           $banktype = 'ICBC';
        }
        $employee_info =  $this->settings_model->get_order_data($employee_id, $banktype);

        if ($employee_info->status!=1) {
            $type = "error";
            $message = "你的账面价值被冻结。";
            set_message($type, $message);
            redirect('admin/order/ordertracking');
        }

        $paymoney = $this->input->post('real_amount');


        if ($paymoney < $employee_info->$chanel_limit) {
            $type = "error";
            $message = "你提交的金额太低了。";
            set_message($type, $message);
            redirect('admin/order/ordertracking');
        }


        $this->settings_model->_table_name = "tbl_employee"; //table name
        $this->settings_model->_order_by = "employee_id";
        $emp_all_info = $this->settings_model->get_by(array('employee_id' => $employee_id), TRUE); //employee_all info
        if ($banktype_clone) {
            $submit_info =  $this->settings_model->get_gateway_hao_info($employee_id, $chanel_name, $banktype_clone);
        }else{
            $submit_info =  $this->settings_model->get_gateway_hao_info($employee_id, $chanel_name, $banktype);
        }
             //channel agent
        $submit_all_info =  $this->settings_model->get_gateway_jangfu_info($submit_info[0]['num'], $submit_info[0]['email']); //gateway account

        $this->settings_model->_table_name = "tbl_channel"; //table name
        $this->settings_model->_order_by = "id";
        $emp_all_info_fee = $this->settings_model->get_by(array('id' => $emp_all_info->$chanel_name), TRUE); //employee_all info


        if (empty($submit_all_info)) {
            $type = "error";
            $message = "没有注册的账号!!!";
            set_message($type, $message);
            redirect('admin/order/ordertracking');
        }

        if ($submit_all_info->loop_state!=1) {
            $type = "error";
            $message = "账号冻结!!!";
            set_message($type, $message);
            redirect('admin/order/ordertracking');
        }
/////////////////////////////
       $order_id = date("YmdHis")."".rand(10000000,99999999);

        $data['banktype'] = $submit_info[0]['num'];
        $userid = $submit_all_info->account_id;
        $userkey = $submit_all_info->account_key;
        $gateway = $emp_all_info_fee->gateway_access_address;
        $ourcall = base_url().'employee/dashboard/check_state';
        $ourhref = base_url().'employee/dashboard/check_call_state';
        $data['callbackurl'] = $ourcall;
        $data['hrefbackurl'] = $ourhref;
        $data['partner'] = $userid;
        $data['sys_serial_num'] = $sys_order;
      //receive form input by post

        $order_type = intval($this->input->post('subtype'));

        $ordernumber = $employee_id."_".$order_id;

        $this->settings_model->_table_name = "tbl_order"; // table name
        $this->settings_model->_primary_key = "id";

        $data['employee_id'] = $employee_id;
        $data['pay_method'] = $banktype;
        $data['real_amount'] = $paymoney;
        // $data['recharge_card_pass'] = $this->input->post('recharge_card_pass');
        $data['submit_time'] = date("Y-m-d h:i:s");
        $data['tixian_status'] = '0';
        $data['client_ip'] =$this->getUserIP();
        $data['order_id'] = $ordernumber;
        $data['sys_serial_num'] = $order_id;
        $data['status']=1;
        $data['pay_mode']=$emp_all_info->$chanel_name;
        $data['order_status']=2;
        $data['proxy_fee']=$submit_info[0]['agent_fee'];
        $data['proxy_mail']=$submit_info[0]['email'];
        $data['proxy_id']=$submit_info[0]['proxy_num'];
        $data['cost_ratio'] = $emp_all_info_fee->channel_cost_ratio;
        if ($banktype_clone) {
            $data['employee_fee'] = $emp_all_info->$banktype_clone;
        }else{
            $data['employee_fee'] = $emp_all_info->$banktype;
        }
        $data['gateway_id'] = $submit_info[0]['num'];
        $this->settings_model->save($data);


        $this->settings_model->_table_name = 'tbl_order';
        $this->settings_model->_order_by = 'id';
        $info =  $this->settings_model->get_by(array('order_id' => $ordernumber), true);
        $employee_id = $info->employee_id;
        $employee_fee = $paymoney*$info->employee_fee/100;
        $agent_fee = $paymoney*($info->proxy_fee-$info->employee_fee)/100;
        $pingtai_fee = $paymoney*$info->cost_ratio/100 - $employee_fee - $agent_fee;

        $data['final_price'] = $employee_fee+$pingtai_fee+$agent_fee;

            $this->settings_model->_table_name = 'tbl_employee';
            $this->settings_model->_order_by = 'employment_id';
            $emp_data = $this->settings_model->get_by(array('employee_id' => $employee_id), TRUE);
            $usr_amount = $emp_data->usr_amount;
            $usr_amount = $usr_amount + $employee_fee;
            $datae = array('usr_amount' => $usr_amount);
            $wheree = array('employee_id'=>$employee_id);
            $this->settings_model->set_action($wheree, $datae, 'tbl_employee');

            $submit_all_info_fe =  $this->settings_model->get_gateway_jangfu_info($info->gateway_id, $info->proxy_mail);
            $pingtai_mount = $submit_all_info_fe->account_amount + $paymoney ;
            $datag = array('account_amount' => $pingtai_mount);
            $whereg = array('gateway_id'=>$info->gateway_id);
            $this->settings_model->set_action($whereg, $datag, 'tbl_gateway_account');



            $this->settings_model->_table_name = 'tbl_proxy';
            $this->settings_model->_order_by = 'proxy_id';
            $agent_data = $this->settings_model->get_by(array('mail_address' => $info->proxy_mail), TRUE);

            $agent_amount = $agent_data->account_amount + $agent_fee;
            $datap = array('account_amount' => $agent_amount);
            $wherep = array('mail_address'=>$info->proxy_mail);
            $this->settings_model->set_action($wherep, $datap, 'tbl_proxy');

            
            ////////////////////////////////////

            $type = "success";
            $message = "手动补单处理成功！";
            set_message($type, $message);
            redirect('admin/order/ordertracking');

            ////////////////////////////////

        }

        $this->settings_model->_table_name = "tbl_employee"; // table name
        $this->settings_model->_order_by = "employee_id"; // $id
        $data['cinfo'] = $this->settings_model->get();// get result

        $data['title'] = "九优付网站";
        $data['subview'] = $this->load->view('admin/order/passive_order', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
}    

    function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

=======
function passive_order(){
    $sys_order = $this->input->post('sys_serial_num');
        if($sys_order){
            if ($sys_order=="") {
                    $type = "error";
                    $message = "手动补单处理失败！";
                    set_message($type, $message);
                    redirect('admin/order/ordertracking');
            }
            $this->settings_model->_table_name = 'tbl_order';
            $this->settings_model->_order_by = "id";
            $check_order_id =  $this->settings_model->get_by(array('sys_serial_num' => $sys_order), true);
            if ($check_order_id) {
                    $type = "error";
                    $message = "手动补单处理失败！";
                    set_message($type, $message);
                    redirect('admin/order/ordertracking');
            }

        $employee_id = $this->input->post('employee_id');
        $banktype = $this->input->post('pay_method');
        if ($banktype=="") {
                $type = "error";
                $message = "手动补单处理失败！";
                set_message($type, $message);
                redirect('admin/order/ordertracking');
        }
        $chanel_name = '';
         if($banktype == 'ALIPAY'){
           $chanel_name = 'channel_alipay';
           $chanel_limit = "alipay_limit";
        }elseif($banktype == 'ALIPAYWAP'){
           $chanel_name = 'channel_wapalipay';
           $chanel_limit = "wapalipay_limit";
        }elseif($banktype == 'TENPAY'){
           $chanel_name = 'channel_tenpay';
           $chanel_limit = "tenpay_limit";
        }
        elseif($banktype == "WEIXIN"){
           $chanel_name = 'channel_weixin';
           $chanel_limit = "weixin_limit";
        }
        elseif($banktype == 'WEIXINWAP'){
           $chanel_name = 'channel_wapweixin';
           $chanel_limit = "weixin_limit";
        }  elseif($banktype == 'DAIFU'){
           $chanel_name = 'channel_daifu';
           $chanel_limit = "online_limit";
        } else{
           $chanel_name = 'channel_online';
           $chanel_limit = "online_limit";
           $banktype_clone = "ONLINE";
           $banktype = 'ICBC';
        }
        $employee_info =  $this->settings_model->get_order_data($employee_id, $banktype);

        if ($employee_info->status!=1) {
            $type = "error";
            $message = "你的账面价值被冻结。";
            set_message($type, $message);
            redirect('admin/order/ordertracking');
        }

        $paymoney = $this->input->post('real_amount');


        if ($paymoney < $employee_info->$chanel_limit) {
            $type = "error";
            $message = "你提交的金额太低了。";
            set_message($type, $message);
            redirect('admin/order/ordertracking');
        }


        $this->settings_model->_table_name = "tbl_employee"; //table name
        $this->settings_model->_order_by = "employee_id";
        $emp_all_info = $this->settings_model->get_by(array('employee_id' => $employee_id), TRUE); //employee_all info
        if ($banktype_clone) {
            $submit_info =  $this->settings_model->get_gateway_hao_info($employee_id, $chanel_name, $banktype_clone);
        }else{
            $submit_info =  $this->settings_model->get_gateway_hao_info($employee_id, $chanel_name, $banktype);
        }
             //channel agent
        $submit_all_info =  $this->settings_model->get_gateway_jangfu_info($submit_info[0]['num'], $submit_info[0]['email']); //gateway account

        $this->settings_model->_table_name = "tbl_channel"; //table name
        $this->settings_model->_order_by = "id";
        $emp_all_info_fee = $this->settings_model->get_by(array('id' => $emp_all_info->$chanel_name), TRUE); //employee_all info


        if (empty($submit_all_info)) {
            $type = "error";
            $message = "没有注册的账号!!!";
            set_message($type, $message);
            redirect('admin/order/ordertracking');
        }

        if ($submit_all_info->loop_state!=1) {
            $type = "error";
            $message = "账号冻结!!!";
            set_message($type, $message);
            redirect('admin/order/ordertracking');
        }
/////////////////////////////
       $order_id = date("YmdHis")."".rand(10000000,99999999);

        $data['banktype'] = $submit_info[0]['num'];
        $userid = $submit_all_info->account_id;
        $userkey = $submit_all_info->account_key;
        $gateway = $emp_all_info_fee->gateway_access_address;
        $ourcall = base_url().'employee/dashboard/check_state';
        $ourhref = base_url().'employee/dashboard/check_call_state';
        $data['callbackurl'] = $ourcall;
        $data['hrefbackurl'] = $ourhref;
        $data['partner'] = $userid;
        $data['sys_serial_num'] = $sys_order;
      //receive form input by post

        $order_type = intval($this->input->post('subtype'));

        $ordernumber = $employee_id."_".$order_id;

        $this->settings_model->_table_name = "tbl_order"; // table name
        $this->settings_model->_primary_key = "id";

        $data['employee_id'] = $employee_id;
        $data['pay_method'] = $banktype;
        $data['real_amount'] = $paymoney;
        // $data['recharge_card_pass'] = $this->input->post('recharge_card_pass');
        $data['submit_time'] = date("Y-m-d h:i:s");
        $data['tixian_status'] = '0';
        $data['client_ip'] =$this->getUserIP();
        $data['order_id'] = $ordernumber;
        $data['sys_serial_num'] = $order_id;
        $data['status']=1;
        $data['pay_mode']=$emp_all_info->$chanel_name;
        $data['order_status']=2;
        $data['proxy_fee']=$submit_info[0]['agent_fee'];
        $data['proxy_mail']=$submit_info[0]['email'];
        $data['proxy_id']=$submit_info[0]['proxy_num'];
        $data['cost_ratio'] = $emp_all_info_fee->channel_cost_ratio;
        if ($banktype_clone) {
            $data['employee_fee'] = $emp_all_info->$banktype_clone;
        }else{
            $data['employee_fee'] = $emp_all_info->$banktype;
        }
        $data['gateway_id'] = $submit_info[0]['num'];
        $this->settings_model->save($data);


        $this->settings_model->_table_name = 'tbl_order';
        $this->settings_model->_order_by = 'id';
        $info =  $this->settings_model->get_by(array('order_id' => $ordernumber), true);
        $employee_id = $info->employee_id;
        $employee_fee = $paymoney*$info->employee_fee/100;
        $agent_fee = $paymoney*($info->proxy_fee-$info->employee_fee)/100;
        $pingtai_fee = $paymoney*$info->cost_ratio/100 - $employee_fee - $agent_fee;

        $data['final_price'] = $employee_fee+$pingtai_fee+$agent_fee;

            $this->settings_model->_table_name = 'tbl_employee';
            $this->settings_model->_order_by = 'employment_id';
            $emp_data = $this->settings_model->get_by(array('employee_id' => $employee_id), TRUE);
            $usr_amount = $emp_data->usr_amount;
            $usr_amount = $usr_amount + $employee_fee;
            $datae = array('usr_amount' => $usr_amount);
            $wheree = array('employee_id'=>$employee_id);
            $this->settings_model->set_action($wheree, $datae, 'tbl_employee');

            $submit_all_info_fe =  $this->settings_model->get_gateway_jangfu_info($info->gateway_id, $info->proxy_mail);
            $pingtai_mount = $submit_all_info_fe->account_amount + $paymoney ;
            $datag = array('account_amount' => $pingtai_mount);
            $whereg = array('gateway_id'=>$info->gateway_id);
            $this->settings_model->set_action($whereg, $datag, 'tbl_gateway_account');



            $this->settings_model->_table_name = 'tbl_proxy';
            $this->settings_model->_order_by = 'proxy_id';
            $agent_data = $this->settings_model->get_by(array('mail_address' => $info->proxy_mail), TRUE);

            $agent_amount = $agent_data->account_amount + $agent_fee;
            $datap = array('account_amount' => $agent_amount);
            $wherep = array('mail_address'=>$info->proxy_mail);
            $this->settings_model->set_action($wherep, $datap, 'tbl_proxy');


            ////////////////////////////////////

            $type = "success";
            $message = "手动补单处理成功！";
            set_message($type, $message);
            redirect('admin/order/ordertracking');

            ////////////////////////////////

        }

        $this->settings_model->_table_name = "tbl_employee"; // table name
        $this->settings_model->_order_by = "employee_id"; // $id
        $data['cinfo'] = $this->settings_model->get();// get result
        $this->settings_model->_table_name = "tbl_channel"; // table name
        $this->settings_model->_order_by = "id"; // $id
        $data['tongdao'] = $this->settings_model->get();// get result


        $data['title'] = "九优付网站";
        $data['subview'] = $this->load->view('admin/order/passive_order', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
}

    function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

>>>>>>> .r94
}
