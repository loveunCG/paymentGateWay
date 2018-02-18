<?php

class Dashboard extends Agent_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('agent_model');
        $this->load->model('global_model');
        $this->load->model('mailbox_model');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => "Full",
                'width' => "100%",
                'height' => "350px"
            )
        );
    }

    public function index() {
        $data['menu'] = array("index" => 1);
        $data['title'] = "九优付网站";
        $agent_id = $this->session->userdata('proxy_id');
		    $data['recent_time'] = date("Y-m-d H:i:s");
        $data['agent_details'] = $this->agent_model->agent_info($agent_id);
        $data['finance'] = $this->agent_model->get_jin_finance($agent_id);
        $data['agent_channel_rate'] = $this->agent_model->agent_channel($agent_id);
        $data['subview'] = $this->load->view('agent/main_content', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }
    public function send_sms(){
        $this->agent_model->_table_name = "tbl_sdl";// table name
        $this->agent_model->_order_by ="id";
        $gsetting =  $this->agent_model->get_by(array('id' => '1'), true);
        $sms_user_name = $gsetting->sms_gatewayid;
        $sms_pass_word = $gsetting->sms_gatewaykey;
        $curl_send="http://api.smsbao.com/sms?u=".$sms_user_name."&p=".$sms_pass_word;
        $agent_id = $this->session->userdata('proxy_id');
        $this->agent_model->_table_name = "tbl_proxy";// table name
        $this->agent_model->_order_by ="proxy_id";
        $agent_info =  $this->agent_model->get_by(array('proxy_id' => $agent_id), true);
        $phone_number = $agent_info->contact_number;
        $mobile = $phone_number;
        $code = $this->sms_content();
        $content = "【九优付】账号".$employee_id."的提现验证码为:".$code;
        $curl_send.="&m=".$mobile;
        $curl_send.="&c=".$content;
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $curl_send,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        if($resp == '0'){
            $data['sms_content'] = $code;
            $this->session->set_userdata($data);
            echo $resp;
        }else{
            echo $resp;
        }
        // Close request to clear up some resources
        curl_close($curl);
        return $resp;
        }
    public function sms_content(){
        $length = 6;
        $chars = '0123456789';
        $chars_length = (strlen($chars) - 1);
        $string = $chars{rand(0, $chars_length)};
        for ($i = 1; $i < $length; $i = strlen($string)){
            $r = $chars{rand(0, $chars_length)};
            if ($r != $string{$i - 1}) $string .=  $r;
        }
        return $string;
    }

    public function agentview() {
        $data['menu'] = array("index" => 1,"agentview" => 1);
        $data['title'] = "九优付网站";

        $agent_id = $this->session->userdata('proxy_id');
        $data['agent_details'] = $this->agent_model->agent_info($agent_id);
        $data['subview'] = $this->load->view('agent/agentview', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

    public function withdraws() {
        $data['menu'] = array("withdraws" => 1,"index" => 1);
        $data['title'] = "九优付网站";
		$agent_id = $this->session->userdata('proxy_id');

        $data['cinfo'] = $this->agent_model->agent_withdraw_info($agent_id);
		$data['all_withdraw_amount'] = $this->agent_model->agent_withdraw_money_info();
        $data['subview'] = $this->load->view('agent/withdraws', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

    public function AgentWithdraw() {
        $data['menu'] = array("AgentWithdraw" => 1);
        $data['title'] = "九优付网站";
        $agent_id = $this->session->userdata('proxy_id');
        $agent_fee_in = $this->agent_model->agent_fee_infomation($agent_id);
        $data['agnet_fee'] = $agent_fee_in;
        $data['agent_jisuan'] = $this->agent_model->get_jisuan_jine($agent_id);
        $data['agent_details'] = $this->agent_model->agent_info($agent_id);
        $data['withdraw_amount'] = $this->agent_model->agent_withdraw_money_info();
        $data['withdraw_request'] = $this->agent_model->agent_withdraw_request();

        $total_mount = $this->agent_model->agent_withdraw_limit_amount($agent_id , $agent_fee_in->mode);
        $mount = 0.00;
        foreach ($total_mount as $price) {
           $mount = $mount + $price['final_price'];
        }

        $data['withdraw_limit'] = $mount;
        $data['order_info'] = $this->agent_model->get_order_info($agent_id);
        $data['subview'] = $this->load->view('agent/AgentWithdraw', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

	function passive_order(){
        $order_id = $this->input->post('order_id');
    	if($order_id){
            if ($order_id=="") {
                    $type = "error";
                    $message = "手动补单处理失败！";
                    set_message($type, $message);
                    redirect('agent/dashboard/passive_order');
            }
                $this->agent_model->_table_name = 'tbl_order';
                $this->agent_model->_order_by = "id";
                $check_order_id =  $this->agent_model->get_by(array('order_id' => $order_id), true);
            if ($check_order_id) {
                    $type = "error";
                    $message = "手动补单处理失败！";
                    set_message($type, $message);
                    redirect('agent/dashboard/passive_order');
            }
    	        $data = $this->agent_model->array_from_post(array('order_id', 'employee_id',  'pay_mode', 'banktype', 'real_amount' ));

    			$data['submit_time'] = date("Y-m-d h:i:s");
    			$data['order_status'] = '5';
                $this->agent_model->_table_name = "tbl_order"; //table name
                $this->agent_model->_primary_key = "id";
                $this->agent_model->save($data, $id);

    				$type = "success";
                    $message = "手动补单处理成功！";
                    set_message($type, $message);
    				redirect('agent/dashboard/passive_order');

    	}

        $this->agent_model->_table_name = "tbl_channel"; // table name
        $this->agent_model->_order_by = "id"; // $id
        $data['all_channel'] = $this->agent_model->get();
        //var_dump($data['all_channel']);

        $agent_id = $this->session->userdata('proxy_id');
        $data['cinfo'] = $this->agent_model->agent_user_info($agent_id);


		$data['title'] = "九优付网站";
		$data['subview'] = $this->load->view('agent/passive_order', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
	}

    public function save_pay_withdraw() {
        $agent_id = $this->session->userdata('proxy_id');
        $agnet_fee = $this->agent_model->agent_fee_infomation($agent_id);
        $agentinfo = $this->agent_model->agent_info($agent_id);
        $request_amount = $this->input->post('withdraw_mount');
        $withdraw_limit = $this->input->post('withdraw_limit');
        $this->agent_model->_table_name = "tbl_agent_withdraw"; // table name
        $this->agent_model->_primary_key = "id"; // $id
        $sms_content = $this->input->post('sms_content');
        $sms_sent = $this->session->userdata('sms_content');
        if($sms_content != $sms_sent ){
          $type = "error";
          $message = "验证马错误。";
          set_message($type, $message);
          redirect('agent/dashboard/AgentWithdraw');
        }

        if($withdraw_limit > $request_amount ){
          $type = "error";
          $message = "因为短信验证码错了， 提现不了！！！";
          set_message($type, $message);
          redirect('agent/dashboard/AgentWithdraw');
        }

        if ($agentinfo->account_amount < $agnet_fee->low_with_amount) {
                $type = "error";
                $message = "因为您的金额太小， 提现不了！！！";
                set_message($type, $message);
                redirect('agent/dashboard/AgentWithdraw');
        }
        $data['withdraw_time'] = date("Y-m-d H:i:s");
        $time_with = $this->agent_model->agent_fee_info();
        $start_time = date("Y-m-d")." ".$time_with->open_time;
        $end_time = date("Y-m-d")." ".$time_with->close_time;
        if ($data['withdraw_time']>$start_time && $data['withdraw_time'] < $end_time) {

        }else{
                $type = "error";
                $message = " 提现不了！！！";
                set_message($type, $message);
                redirect('agent/dashboard/AgentWithdraw');
        }


        $data['agent_id'] = $agent_id;
        $data['withdraw_time'] = date("Y-m-d H:i:s");
        $data['pay_state'] = 0;
        $data['time_time'] = date("Y-m-d")." 00:00:00";
        $time_info= $agnet_fee->mode;
        $data['time_count'] = $time_info;
        $data['time_state'] = 0;
        if ($request_amount<$agnet_fee->low_with_amount) {
                $type = "error";
                $message = "您的提现金额过低";
                set_message($type, $message);
                redirect('agent/dashboard/AgentWithdraw');
        }
        $fee_mount= $request_amount*$agnet_fee->default_rate/100;
        if ($fee_mount>5 && $fee_mount<50 ) {

        }elseif ($fee_mount<$agnet_fee->fee_low_limit) {
            $fee_mount = $agnet_fee->fee_low_limit;
        }elseif ($fee_mount > $agnet_fee->fee_limit) {
           $fee_mount = $agnet_fee->fee_limit;
        }
        $data['fee'] = $fee_mount;
        $data['withdraw_mount'] = $request_amount-$fee_mount ;
        if (($request_amount) > $agentinfo->account_amount) {
                $type = "error";
                $message = "您的提现金额过低";
                set_message($type, $message);
                redirect('agent/dashboard/AgentWithdraw');
        }
        $setting_id = $this->agent_model->save($data, $id);
        $ldata['account_amount'] =  $agentinfo->account_amount - $request_amount;
        $this->agent_model->_table_name = "tbl_proxy"; // table name
        $this->agent_model->_primary_key = "proxy_id"; // $id
        $setting_id = $this->agent_model->save($ldata, $agent_id);

        $type = "success";
        $message = "成功了！";
        set_message($type, $message);
        redirect('agent/dashboard/AgentWithdraw');
    }

    public function order_view($id){
        $data['title'] = "九优付网站";
        $data['detail_order']=$this->agent_model->get_order_view($id);
        $data['subview'] = $this->load->view('agent/order_detail', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }
    public function ordermanage() {
        $data['menu'] = array("ordermanage" => 1);
        $data['title'] = "九优付网站";
        $agent_id = $this->session->userdata('proxy_id');
        $this->agent_model->_table_name = 'tbl_gateway_type';
        $this->agent_model->_order_by ='id';
        $data['gateway'] = $this->agent_model->get();

        $this->agent_model->_table_name = 'tbl_channel';
        $this->agent_model->_order_by = "id";
        $data['channel_info'] =  $this->agent_model->get();

        $data['cinfo'] = $this->agent_model->agent_orderinfo($agent_id);
        $data['channel'] = $this ->agent_model->get_channel_rate();
        $totalpay = $this->agent_model->search_orderinfo_pay();
        $data['total'] = $totalpay;
        $data['subview'] = $this->load->view('agent/ordermanage', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

    public function search_orderinfo() {
        $info = $this->agent_model->search_orderinfo();
        $totalpay = $this->agent_model->search_orderinfo_pay();
        $this->agent_model->_table_name = 'tbl_gateway_type';
        $this->agent_model->_order_by ='id';
        $data['gateway'] = $this->agent_model->get();

        $this->agent_model->_table_name = 'tbl_channel';
        $this->agent_model->_order_by = "id";
        $data['channel_info'] =  $this->agent_model->get();

        $data['cinfo'] = $info;
        $data['total'] = $totalpay;
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $partner = $this->input->post('partner');
        $order_state = $this->input->post('order_state');
        $order_number = $this->input->post('order_number');
        $user_number = $this->input->post('user_number');
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['partner'] = $partner;
        $data['order_state'] = $order_state;
        $data['order_number'] = $order_number;
        $data['user_number'] = $user_number;
        $data['pay_method'] = $this->input->post('pay_method');
        $data['menu'] = array("ordermanage" => 1);
        $data['title'] = "代理面板";
        $data['subview'] = $this->load->view('agent/ordermanage', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

	public function passive_proc($order_id){

		$sdata = array('order_status'=>'5');
        $where = array('order_id'=>$order_id);
        $this->agent_model->set_action($where, $sdata,  'tbl_order');
		$data['menu'] = array("ordermanage" => 1);
        $data['title'] = "九优付网站";
        $agent_id = $this->session->userdata('proxy_id');
        $data['cinfo'] = $this->agent_model->agent_orderinfo($agent_id);
        $data['channel'] = $this ->agent_model->get_channel_rate();
        $totalpay = $this->agent_model->search_orderinfo_pay();
        $data['total'] = $totalpay;
        $data['subview'] = $this->load->view('agent/ordermanage', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
	}

    public function usermanage() {
        $data['menu'] = array("usermanage" => 1);
        $data['title'] = "九优付网站";
        $agent_id = $this->session->userdata('proxy_id');
        $data['orderinfo'] = $this->agent_model->agent_order_data($agent_id);
        $data['cinfo'] = $this->agent_model->agent_user_info($agent_id);
        $data['order_zinfo'] = $this->agent_model->agent_user_info_zuo($agent_id);
        $data['subview'] = $this->load->view('agent/usermanage', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

    public function pubinfo() {
        $data['menu'] = array("pubinfo" => 1);
        $data['title'] = "九优付网站";

        $data['cinfo'] = $this->agent_model->agent_info();
        $data['subview'] = $this->load->view('agent/pubinfo', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

    public function agentfinancelist() {
        $data['menu'] = array("agentfinancelist" => 1);
        $data['title'] = "九优付网站";

        $this->agent_model->_table_name = 'tbl_delivery';
        $this->agent_model->_order_by = "id";
        $employee =  $this->agent_model->get();


        $this->agent_model->_table_name = 'tbl_order';
        $this->agent_model->_order_by = "id";
        $order =  $this->agent_model->get();

        $i=1;foreach ($employee as $v_employee) {
            if ($v_employee->delivery_status==2) {
                $em_state = "成功了！";
            }elseif($v_employee->delivery_status==3){
                $em_state = "已拒绝";
            }else{
                $em_state = "处理中";
            }
                $data['all_info'][$i] = array(
                    'finance_time' => $v_employee->create_time,
                    'finance_id' => $v_employee->employee_id,
                    'finance_amount' => ($v_employee->delivery_mount + $v_employee->fee),
                    'finance_submit' => "商户提现",
                    'finance_type' => "支出",
                    'finance_balance' => $v_employee->delivery_mount,
                    'finance_remarks' => $em_state
                );
                $i++;
        }
        $i=$i+1;foreach ($order as $v_order) {
            if ($v_order->order_status==1) {
                $em_state = "成功了！";
            }elseif($v_order->order_status==2){
                $em_state = "失败！！";
            }else{
                $em_state = "处理中";
            }
        $data['all_info'][$i] = array(
            'finance_time' => $v_order->submit_time,
            'finance_id' => $v_order->proxy_id,
            'finance_amount' => $v_order->real_amount,
            'finance_submit' => "订单",
            'finance_type' => "收益",
            'finance_balance' => $v_order->final_price,
            'finance_remarks' => $em_state
        );
         $i++;
        }
        $mount = 0;
        foreach ($data['all_info'] as $price) {
           $mount = $mount + $price['finance_amount'];
        }
        $data['totalprice'] = $mount ;

        $data['subview'] = $this->load->view('agent/agentfinancelist', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

    public function change_password() {
        $data['menu'] = array("profile" => 1, "change_password" => 1);
        $data['title'] = "九优付网站";
        $data['subview'] = $this->load->view('agent/change_password', $data, TRUE);
        $this->load->view('agent/_layout_main', $data);
    }

    public function set_password() {
        $proxy_id = $this->session->userdata('proxy_id');
        $data['proxy_password'] = $this->hash($this->input->post('new_password'));
        $this->agent_model->_table_name = 'tbl_proxy';
        $this->agent_model->_primary_key = 'proxy_id';
        $this->agent_model->save($data, $proxy_id);
        $type = "success";
        $message = "密码修改成功！";
        set_message($type, $message);
        redirect('agent/dashboard/logout'); //redirect page
    }

    public function withdraw_reason($id){
      $this->agent_model->_table_name = "tbl_agent_withdraw";// table name
      $this->agent_model->_order_by ="id";
      $data['detail_order'] =  $this->agent_model->get_by(array('id' => $id), true);
      $data['title'] = "九优付网站";

      $data['subview'] = $this->load->view('agent/withdraw_reason', $data, TRUE);
      $this->load->view('agent/_layout_main', $data);

    }


    public function check_agent_password($val) {
        $password = $this->hash($val);
        $check_dupliaction_id = $this->agent_model->check_by(array('proxy_password' => $password), 'tbl_proxy');
        if (empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:10px">您输入的密码不匹配 !<small>';
        } else {
            $result = NULL;
        }
        echo $result;
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }
    public function logout() {
        $this->login_model->logout();
        redirect('agentlogin');
    }



}
