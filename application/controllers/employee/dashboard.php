<?php

class Dashboard extends Employee_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('emp_model');
        $this->load->model('global_model');
        $this->load->model('settings_model');
        $this->load->model('agent_model');
        $this->load->model('mailbox_model');
        $this->load->helper('ckeditor');
        $this->load->helper('download');

        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => "Full",
                'width' => "100%",
                'height' => "200px"
            )
        );
    }
    public function index() {
        $employee_status = $this->session->userdata('employee_status');
        $data['menu'] = array("index" => 1);
        $data['title'] = "九优付网站";
        $employee_id = $this->session->userdata('employee_id');
        $data['employee_details'] = $this->emp_model->all_emplyee_info($employee_id);
        $this->admin_model->_table_name = "tbl_sdl";// table name
        $this->admin_model->_order_by ="id";
        $data['gsetting'] =  $this->admin_model->get_by(array('id' => '1'), true);

        $employee_id = $this->session->userdata('employee_id');
        $sdata['tbl_delivery.employee_id'] = $employee_id;
        $withdraw_data = $this->emp_model->get_withdraw_data($sdata);
        $data['taka_money'] = 0;
        foreach ($withdraw_data as $row){
            if($row->delivery_status == 0 || $row->delivery_status == 1){
                $data['taka_money'] += $row->delivery_mount;
            }
        }
        //Total Attendance
        $data['order_data'] = $this->emp_model->all_order_table_info($employee_id);
        $this->admin_model->_table_name = "tbl_employee"; //table name
        $this->admin_model->_order_by = "employee_id"; // order by
        $data['employee'] = $this->admin_model->get_by(array('status' => 1));
        $data['emp_log'] = $this->emp_model->get_log_data($employee_id);
        $data['notice_info'] = $this->emp_model->get_all_notice(1);
        // get resutl
        // get recent email
        $this->_table_name = 'tbl_employee_login';
        $this->_order_by = 'employee_login_id';
        $data['employee_role'] = $this->admin_model->get_by(array('employee_id' => $employee_id), FALSE);
        $data['price'] = $this->emp_model->get_price_info($employee_id);
         if($employee_status == 2){
            $data['title'] = "九优付网站";
            $data['employee_details'] = $employee;
            $data['all_data'] = $this->emp_model->all_order_table_info();
            $employee_id = $this->session->userdata('employee_id');
            $data['subview'] = $this->load->view('employee/sign_up2', $data, TRUE);
            $this->load->view('employee/_layout_main', $data);
        }
        else if($employee_status==1){
            $this->sign_up($data['employee_details']);
        }
        else{
            $data['jisuan_jine'] = $this->emp_model->get_jisuan_jine($employee_id);
            $data['all_data'] = $this->emp_model->all_order_table_info();
            $data['subview'] = $this->load->view('employee/main_content', $data, TRUE);
            $this->load->view('employee/_layout_main', $data);
        }
    }

    public function total_attendace_in_month($employee_id, $flag = NULL) {
        $month = date('m');
        $year = date('Y');

        if ($month >= 1 && $month <= 9) { // if i<=9 concate with Mysql.becuase on Mysql query fast in two digit like 01.
            $start_date = $year . "-" . '0' . $month . '-' . '01';
            $end_date = $year . "-" . '0' . $month . '-' . '31';
        } else {
            $start_date = $year . "-" . $month . '-' . '01';
            $end_date = $year . "-" . $month . '-' . '31';
        }
        if (!empty($flag)) { // if flag is not empty that means get pulic holiday
            $get_public_holiday = $this->emp_model->get_public_holiday($start_date, $end_date);
            if (!empty($get_public_holiday)) { // if not empty the public holiday
                foreach ($get_public_holiday as $v_holiday) {
                    if ($v_holiday->start_date == $v_holiday->end_date) { // if start date and end date is equal return one data
                        $total_holiday[] = $v_holiday->start_date;
                    } else { // if start date and end date not equan return all date
                        for ($j = $v_holiday->start_date; $j <= $v_holiday->end_date; $j++) {
                            $total_holiday[] = $j;
                        }
                    }
                }
                return $total_holiday;
            }
        } else {
            $get_total_attendance = $this->emp_model->get_total_attendace_by_date($start_date, $end_date, $employee_id); // get all attendace by start date and in date
            return $get_total_attendance;
        }
    }


    public function basic_profile(){
        $data['menu'] = array("basic_profile" => 1);
        $data['title'] = "九优付网站";
        //get leave applied with category name
        $employee_id = $this->session->userdata('employee_id');
        $data['employee_details'] = $this->emp_model->all_emplyee_info($employee_id);

        $data['subview'] = $this->load->view('employee/basic_profile', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }
    public function account_info(){
        $data['menu'] = array("basic_profile" => 1);
        $data['title'] = "九优付网站";
        //get leave applied with category name
        $employee_id = $this->session->userdata('employee_id');

        $data['employee_details'] = $this->emp_model->all_emplyee_info($employee_id);
        $data['subview'] = $this->load->view('employee/account_info', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);

    }
    public function login_log(){
        $data['menu'] = array("login_log" => 1);
        $data['title'] = "九优付网站";
        //get leave applied with category name
        $employee_id = $this->session->userdata('employee_id');
        $data['emp_log'] = $this->emp_model->get_log_data($employee_id);
        $data['subview'] = $this->load->view('employee/login_log', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);

    }
    public function card_order() {
        $data['menu'] = array("card_order" => 1);
        $data['title'] = "九优付网站";
        //get leave applied with category name
        $employee_id = $this->session->userdata('employee_id');
        if(!empty($_POST)){
            $sdata['tbl_order.employee_id'] = $employee_id;
            if($this->input->post('start_time')!=NULL){
                $sdata['submit_time >='] = $this->input->post('start_time');
            }
            if($this->input->post('end_time')!=NULL){
                $sdata['submit_time <='] = $this->input->post('end_time');
            }
            $data['order_data'] = $this->emp_model->search_order_table_info($sdata);

        }else{
            $data['order_data'] = $this->emp_model->all_order_table_info($employee_id);

        }
        $data['start_time'] = $this->input->post('start_time');
        $data['end_time'] = $this->input->post('end_time');


        $data['subview'] = $this->load->view('employee/card_order', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function notice_manage() {
        $data['title'] = "九优付网站";
        $data['menu'] = array("notice_manage" => 1);
        //get leave applied with category name
        $employee_id = $this->session->userdata('employee_id');
        $data['order_data'] = $this->emp_model->all_order_table_info($employee_id);
        $data['subview'] = $this->load->view('employee/notice_manage', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function interface_ID_get() {
        $data['menu'] = array("interface_ID_get" => 1);
        $data['title'] = "九优付网站";

        //get leave applied with category name
        $employee_id = $this->session->userdata('employee_id');

        $data['order_data'] = $this->emp_model->all_order_table_info($employee_id);

        $data['subview'] = $this->load->view('employee/interface_id_get', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }
    public function sign_up($employee){
        $data['title'] = "九优付网站";
        $data['employee_details'] = $employee;
        $data['all_data'] = $this->emp_model->all_order_table_info();
        $employee_id = $this->session->userdata('employee_id');
        $data['bank_name'] = $this->settings_model->get_bank_all_info();
        $data['subview'] = $this->load->view('employee/sign_up', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }
    public function leave_application() {
        $data['menu'] = array("leave_application" => 1);
        $data['title'] = "九优付网站";
        //get leave applied with category name
        $employee_id = $this->session->userdata('employee_id');
        $data['order_data'] = $this->emp_model->all_order_table_info($employee_id);
        $data['subview'] = $this->load->view('employee/emp_leave_application', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }
    public function apply_leave_application() {
        $data['title'] = "九优付网站";
        //get leave category for dropdown
        $this->emp_model->_table_name = "tbl_channel_rate"; // table name
        $this->emp_model->_order_by = "id"; // $id
        $data['all_leave_category'] = $this->emp_model->get();// get result

        $data['subview'] = $this->load->view('employee/apply_new_leave_application', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function check_tixian_stauts(){
      $employee_id = $this->session->userdata('employee_id');
      $this->emp_model->_table_name = "tbl_employee";// table name
      $this->emp_model->_order_by ="employee_id";
      $data = $this->emp_model->get_by(array('employee_id' => $employee_id, 'status'=>'1'), TRUE);
      if($data){
        $result = null;
      }else{
        $result = '<small style="padding-left:10px;color:red;font-size:14px">您的状态在冻结 不能提现！！！</small>';
      }
      echo $result;
    }

    function _get_fl($obj){
        return array(
            "ONLINE" => $obj->ONLINE,
            "ALIPAY" => $obj->ALIPAY,
            "TENPAY" => $obj->TENPAY,
            "WEIXIN" => $obj->WEIXIN,
            "ALIPAYWAP" => $obj->ALIPAYWAP,
            "WEIXINWAP" => $obj->WEIXINWAP,
            "DAUFU" => $obj->DAUFU,
        );
    }

    public function save_leave_application() {
        $employee_id = $this->session->userdata('employee_id');
        $banktype = $this->input->post('leave_category_id');
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
        }
        else{
           $chanel_name = 'channel_online';
           $chanel_limit = "online_limit";
           $banktype_clone = "ONLINE";
        }

        $employee_info =  $this->emp_model->get_order_data($employee_id, $banktype);

        if ($employee_info->status!=1) {
            $type = "error";
            $message = "您的资金被冻结，不能充值。";
            set_message($type, $message);
            redirect('employee/dashboard/apply_leave_application');
        }

        $paymoney = $this->input->post('real_amount');
        if ($paymoney > $employee_info->$chanel_limit) {
            $type = "error";
            $message = "您提交的金额超出了限额。";
            set_message($type, $message);
            redirect('employee/dashboard/apply_leave_application');
        }


        $this->settings_model->_table_name = "tbl_employee"; //table name
        $this->settings_model->_order_by = "employee_id";
        $emp_all_info = $this->settings_model->get_by(array('employee_id' => $employee_id), TRUE); //employee_all info
        if ($banktype_clone) {
            $submit_info =  $this->emp_model->get_gateway_hao_info($employee_id, $chanel_name, $banktype_clone);
        }else{
            $submit_info =  $this->emp_model->get_gateway_hao_info($employee_id, $chanel_name, $banktype);
        }
             //channel agent
        $submit_all_info =  $this->emp_model->get_gateway_jangfu_info($submit_info[0]['num'], $submit_info[0]['email']); //gateway account

        $this->settings_model->_table_name = "tbl_channel"; //table name
        $this->settings_model->_order_by = "id";
        $emp_all_info_fee = $this->settings_model->get_by(array('id' => $emp_all_info->$chanel_name), TRUE); //employee_all info


        if (empty($submit_all_info)) {
            $type = "error";
            $message = "没有注册的账号!!!";
            set_message($type, $message);
            redirect('employee/dashboard/apply_leave_application');
        }

        if ($submit_all_info->loop_state!=1) {
            $type = "error";
            $message = "账号冻结!!!";
            set_message($type, $message);
            redirect('employee/dashboard/apply_leave_application');
        }

        $data['banktype'] = $submit_info[0]['num'];
        $userid = $submit_all_info->account_id;
        $userkey = $submit_all_info->account_key;
        $gateway = $emp_all_info_fee->gateway_access_address;
        $ourcall = base_url().'employee/dashboard/check_state';
        $ourhref = base_url().'employee/dashboard/check_call_state';
        $data['callbackurl'] = $ourcall;
        $data['hrefbackurl'] = $ourhref;
        $data['partner'] = $userid;
        //receive form input by post

        $order_type = intval($this->input->post('subtype'));
        $order_id = date("YmdHis")."".rand(10000000,99999999);
        $ordernumber = $order_id;
        $chsign = md5("partner=".$userid."&banktype=".$banktype."&paymoney=".$paymoney."&ordernumber=".$ordernumber."&callbackurl=".$ourcall.$userkey);
        $data['sign'] = $chsign;
        $url = $gateway."?partner=".$userid."&banktype=".$banktype."&paymoney=".$paymoney."&ordernumber=".$ordernumber."&callbackurl=".$ourcall;
        $url .= "&hrefbackurl=".$ourhref."&attach=00&sign=".$chsign;
        $data['order_url'] = $url;
        $this->emp_model->_table_name = "tbl_employee"; // table name
        $this->emp_model->_order_by = 'employee_id';
        $val = $this->emp_model->get_by(array('employee_id' => $employee_id), TRUE);
        $data['tixian_time'] = date("Y-m-d", strtotime("+".$val->group_withdraw_time.' days')).date(" h:i:s");
        $this->emp_model->_table_name = "tbl_order"; // table name
        $this->emp_model->_primary_key = "id";

        $data['employee_id'] = $employee_id;
        $data['pay_method'] = $banktype;
        $data['real_amount'] = $paymoney;
        // $data['recharge_card_pass'] = $this->input->post('recharge_card_pass');
        $data['submit_time'] = date("Y-m-d h:i:s");
        $data['tixian_status'] = '0';
        $data['client_ip'] =$this->getUserIP();
        $data['order_id'] = $order_id;
        $data['status']=1;
        $data['pay_mode']=$emp_all_info->$chanel_name;
        $data['order_status']=0;
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
        $this->emp_model->save($data);
        ob_clean();
        header('Location: ' . $url);
        exit;
    }

    public function check_state(){
		$partner = $this->input->get('partner');
		$banktype = $this->input->get('banktype');
		$orderstatus = $this->input->get('orderstatus');
		$paymoney = $this->input->get('paymoney');
		$ordernumber = $this->input->get('ordernumber');
		$sysnumber = $this->input->get('sysnumber');
		$sign = $this->input->get('sign');
		$attach = $this->input->get('attach');

        $chanel_name = '';
         if($banktype == 'ALIPAY'){
           $chanel_name = 'channel_alipay';
        }elseif($banktype == 'ALIPAYWAP'){
           $chanel_name = 'channel_wapalipay';
        }elseif($banktype == 'TENPAY'){
           $chanel_name = 'channel_tenpay';
        }
        elseif($banktype == "WEIXIN"){
           $chanel_name = 'channel_weixin';
        }
        elseif($banktype == 'WEIXINWAP'){
           $chanel_name = 'channel_wapweixin';

        }else{
           $chanel_name = 'channel_online';
        }

        $this->settings_model->_table_name = "tbl_order"; //table name
        $this->settings_model->_order_by = "order_id";
        $emp_all_info = $this->settings_model->get_by(array('order_id' => $ordernumber), TRUE); //employee_all info

        $this->settings_model->_table_name = "tbl_employee"; //table name
        $this->settings_model->_order_by = "employee_id";
        $emp_all_info = $this->settings_model->get_by(array('employee_id' => $emp_all_info->employee_id), TRUE); //employee_all info

        $submit_info =  $this->emp_model->get_gateway_hao_info($emp_all_info->employee_id, $chanel_name, $banktype);     //channel agent
        $submit_all_info =  $this->emp_model->get_gateway_jangfu_info($submit_info[0]['num'], $submit_info[0]['email']); //gateway account

        $userid = $submit_all_info[0]['account_id'];
        $userkey = $submit_all_info[0]['account_key'];

        // $userid = 27641;
        // $userkey = 1234567890;
        $this->emp_model->_table_name = 'tbl_order';
        $this->emp_model->_order_by = "id";
        $info =  $this->emp_model->get_by(array('order_id' => $ordernumber), true);
        $real_amount = $info->real_amount;
    	$preEncodeStr="partner=".$partner."&ordernumber=".$ordernumber."&orderstatus=".$orderstatus."&paymoney=".$real_amount.$userkey;
		$encodeStr=md5($preEncodeStr);
		if ($sign==$encodeStr) {
            $data = array('order_status' => 2);
            $where = array('order_id'=>$ordernumber);
            $this->settings_model->set_action($where, $data, 'tbl_order');
			echo "ok";
		}else{
			ob_clean();
			header('Location: ' . $info->hrefbackurl);
			exit;
		}
	}

    public function check_call_state(){
        $partner = $this->input->get('partner');
        $banktype = $this->input->get('banktype');
        $orderstatus = $this->input->get('orderstatus');
        $paymoney = $this->input->get('paymoney');
        $ordernumber = $this->input->get('ordernumber');
        $sysnumber = $this->input->get('sysnumber');
        $sign = $this->input->get('sign');
        $attach = $this->input->get('attach');

        $this->emp_model->_table_name = 'tbl_order';
        $this->emp_model->_order_by = 'id';
        $info =  $this->emp_model->get_by(array('order_id' => $ordernumber), true);


           $employee_fee = $paymoney*$info->employee_fee/100;
           $agent_fee = $paymoney*($info->proxy_fee-$info->employee_fee)/100;
           $pingtai_fee = $paymoney*$info->cost_ratio - $employee_fee - $agent_fee;

           $data['final_price'] = $employee_fee+$pingtai_fee+$agent_fee;


        $ordr_id = $info->id;
        $employee_id = $info->employee_id;
        $cost_rate = $info->cost_ratio;
        $data['order_status'] = $orderstatus;
        $data['sys_serial_num'] = $sysnumber;
        $data['release_time'] = date("Y-m-d H:i:s");
        $data['success_price'] = $paymoney;
        $where = array('order_id'=>$ordernumber);
        $this->emp_model->set_action($where, $data, 'tbl_order');

        $chanel_name = '';
         if($banktype == 'ALIPAY'){
           $chanel_name = 'channel_alipay';
        }elseif($banktype == 'ALIPAYWAP'){
           $chanel_name = 'channel_wapalipay';
        }elseif($banktype == 'TENPAY'){
           $chanel_name = 'channel_tenpay';
        }
        elseif($banktype == "WEIXIN"){
           $chanel_name = 'channel_weixin';
        }
        elseif($banktype == 'WEIXINWAP'){
           $chanel_name = 'channel_wapweixin';

        }else{
           $chanel_name = 'channel_online';
        }



            $this->emp_model->_table_name = 'tbl_employee';
            $this->emp_model->_order_by = 'employment_id';
            $emp_data = $this->emp_model->get_by(array('employee_id' => $employee_id), TRUE);
            $usr_amount = $emp_data->usr_amount;
            $usr_amount = $usr_amount + $employee_fee;
            $data = array('usr_amount' => $usr_amount);
            $where = array('employee_id'=>$employee_id);
            $this->emp_model->set_action($where, $data, 'tbl_employee');

            $submit_all_info =  $this->emp_model->get_gateway_jangfu_info($info->gateway_id, $info->proxy_mail);
            $pingtai_mount = $submit_all_info->account_amount + $paymoney ;
            $data = array('account_amount' => $pingtai_mount);
            $where = array('gateway_id'=>$info->gateway_id, 'account_email'=>$info->proxy_mail);
            $this->emp_model->set_action($where, $data, 'tbl_gateway_account');



                $this->emp_model->_table_name = 'tbl_proxy';
                $this->emp_model->_order_by = 'proxy_id';
                $agent_data = $this->emp_model->get_by(array('mail_address' => $info->proxy_mail), TRUE);

                $agent_amount = $agent_data->account_amount + $agent_fee;
                $data = array('account_amount' => $agent_amount);
                $where = array('mail_address'=>$info->proxy_mail);
                $this->emp_model->set_action($where, $data, 'tbl_proxy');




        ob_clean();
        header('Location: ' . $info->hrefbackurl);
        exit;
	}

    public function capcha()
    {
        $this->load->helper(array('form', 'url'));
        // load the BotDetect Captcha library and set its parameter
        $this->load->library('botdetect/BotDetectCaptcha', array(
            'captchaConfig' => 'ExampleCaptcha'
        ));
        // make Captcha Html accessible to View code
        $data['captchaHtml'] = $this->botdetectcaptcha->Html();

        // initially, the message shown to the visitor is empty
        $data['captchaValidationMessage'] = '';

        if ($_POST) {
            // validate the user-entered Captcha code when the form is submitted
            $code = $this->input->post('CaptchaCode');
            $isHuman = $this->botdetectcaptcha->Validate($code);

            if ($isHuman) {
                // Captcha validation passed
                $data['captchaValidationMessage'] = 'CAPTCHA validation passed, human visitor confirmed!';
                // TODO: continue with form processing, knowing the submission was made by a human
            } else {
                // Captcha validation failed, return an error message
                $data['captchaValidationMessage'] = 'CAPTCHA validation failed, please try again.';
            }
        }

        $this->load->view('botdetect/example', $data);
    }

    public function save_employee() {
            $data['employee_id'] = $this->session->userdata('employee_id');
            $data['usr_idcard_num'] = $this->input->post('usr_idcard_num');
            $data['usr_phone_num'] = $this->input->post('usr_phone_num');
            $data['usr_contact_qq_num'] = $this->input->post('usr_contact_qq_num');
            $data['usr_address_1'] = $this->input->post('usr_bank_branch_name');
            $data['usr_address_2'] = $this->input->post('usr_address2');
            $data['usr_bank_branch_name'] = $this->input->post('usr_bank_branch_name');
            $data['usr_bankcard_name'] = $this->input->post('usr_bankcard_name');
            $data['usr_create_time'] = date('Y-m-d H:i:s');
            $data['usr_amount'] = $this->input->post('usr_amount');
            $data['user_ip'] = $this->getUserIP();
			      $data['usr_status'] = 2;
            $res=$this->db->update('tbl_employee',$data, array('employee_id'=>$data['employee_id']));
            $activate = array('activate' => 1);
            $this->db->update('tbl_employee_login', $activate, array('employee_id'=>$data['employee_id']));
            if($res==1){
                $data['type'] = "success";
                $data['subview'] = $this->load->view('employee/alret', $data, TRUE);
                $this->load->view('employee/_layout_main', $data);
            }else{
                $data['type'] = "error";
                $data['subview'] = $this->load->view('employee/alret', $data, TRUE);
                $this->load->view('employee/_layout_main', $data);
            }
    }
    public function radom_update_code(){
        $code = $this->sms_content();
        $employee_id = $this->session->userdata('employee_id');
        $data['usr_pay_check_code'] = md5($code);
        $res = $this->db->update('tbl_employee', $data, array('employee_id'=>$employee_id));
        if($res){
            echo md5($code);
        }else{
            echo "错误!";
        }

    }

    public function save_delivery(){
      $withdraw_time = date("Y-m-d H:i:s");
      $employee_id = $this->session->userdata('employee_id');
      $this->agent_model->_table_name = "tbl_employee"; // table name
      $this->agent_model->_order_by = "employee_id";
      $agent_info = $this->agent_model->get_by(array('employee_id'=>$employee_id), TRUE);
      $data['agent_id'] = $agent_info->agent_group;
      // $id
      $time_with = $this->agent_model->agent_fee_info();
      $start_time = date("Y-m-d")." ".$time_with->open_time;
      $end_time = date("Y-m-d")." ".$time_with->close_time;
      $sms_code = $this->input->post('sms_code');
      if($sms_code != $this->session->userdata('sms_content')){
        $type = "error";
        $message = "短信验证码错误！";
        set_message($type, $message);
        redirect('employee/dashboard/immediate_delivery');
      }
      if ($withdraw_time > $start_time && $withdraw_time > $end_time) {
        $data['employee_id'] = $this->session->userdata('employee_id');
        $data['delivery_bank_name'] = $this->input->post('delivery_bank_name');
        $data['user_name'] = $this->input->post('delivery_bankbrach_name');
        $data['delivery_bankbrach_name'] = $this->input->post('delivery_bankbrach_name');
        $data['delivery_bank_card'] = $this->input->post('delivery_bank_card');
        $with_mount = $this->input->post('delivery_mount');
        $data['pay_method'] = $this->input->post('pay_method');
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['delivery_status'] = '0';
        $employeeinfo = $this->emp_model->employeeinfo($data['employee_id']);
        $employee_id = $this->session->userdata('employee_id');
        $this->emp_model->_table_name = "tbl_employee";// table name
        $this->emp_model->_order_by ="employee_id";
        $status_rr = $this->emp_model->get_by(array('employee_id' => $employee_id, 'status'=>'1'), TRUE);
        if(!$status_rr){
          $type = "error";
          $message = "提现失败！， 您的帐户被冻结。";
          set_message($type, $message);
          redirect('employee/dashboard/immediate_delivery');

        }
        if (!empty($employeeinfo->group_fee)) {
                if ($with_mount < $employeeinfo->group_amount) {   //employee_fee calculation
                $type = "error";
                $message = "账户余额不足";
                set_message($type, $message);
                redirect('employee/dashboard/immediate_delivery');
                }
                $fee_mount= $with_mount*$employeeinfo->group_fee/100;  //fee mount
                if ($fee_mount > $employeeinfo->group_low_fee && $fee_mount < $employeeinfo->group_up_fee ) {

                }elseif ($fee_mount < $employeeinfo->group_low_fee ) {
                    $fee_mount = $employeeinfo->group_low_fee;
                }elseif ($fee_mount > $employeeinfo->group_up_fee) {
                   $fee_mount = $employeeinfo->group_up_fee;
                }

                if (($with_mount+$fee_mount) > $employeeinfo->jisuan_jine) {
                $type = "error";
                $message = "账户余额不足";
                set_message($type, $message);
                redirect('employee/dashboard/immediate_delivery');
                }
                $ldata['usr_amount'] =  $employeeinfo->usr_amount - $with_mount;
                $ldata['jisuan_jine'] =  $employeeinfo->jisuan_jine - $with_mount;
                $this->agent_model->_table_name = "tbl_employee"; // table name
                $this->agent_model->_primary_key = "employee_id"; // $id
                $setting_id = $this->agent_model->save($ldata, $data['employee_id']);
                $data['delivery_mount'] = $with_mount - $fee_mount ;
                $data['fee'] = $fee_mount;
                $data['time_time'] = date("Y-m-d h:i:s");
                $time_info= $employeeinfo->group_withdraw_time;
                $data['time_count'] = $time_info;
                $data['time_state'] = 0;
                $this->emp_model->_table_name = "tbl_delivery"; // table name
                $this->emp_model->_order_by = "employee_id"; // $id
                $res = $this->emp_model->save($data, null);
//////////////////////////
                }else{
                $employee_gourpinfo = $this->emp_model->employee_groupinfo($employeeinfo->usr_gourp);
                if ($with_mount > $employeeinfo->jisuan_jine) {   //employee_fee calculation
                $type = "error";
                $message = "账户余额不足";
                set_message($type, $message);
                redirect('employee/dashboard/immediate_delivery');
                }
                $fee_mount= $with_mount*$employee_gourpinfo->group_fee/100;  //fee mount
                if ($fee_mount > $employee_gourpinfo->group_low_fee && $fee_mount < $employee_gourpinfo->group_up_fee ) {

                }elseif ($fee_mount < $employee_gourpinfo->group_low_fee ) {
                    $fee_mount = $employee_gourpinfo->group_low_fee;
                }elseif ($fee_mount > $employee_gourpinfo->group_up_fee) {
                   $fee_mount = $employee_gourpinfo->group_up_fee;
                }

                if (($with_mount+$fee_mount) > $employeeinfo->jisuan_jine) {
                $type = "error";
                $message = "账户余额不足";
                set_message($type, $message);
                redirect('employee/dashboard/immediate_delivery');
                }
                $ldata['usr_amount'] =  $employeeinfo->usr_amount - $with_mount;
                $ldata['jisuan_jine'] =  $employeeinfo->jisuan_jine - $with_mount;

                $this->agent_model->_table_name = "tbl_employee"; // table name
                $this->agent_model->_primary_key = "employee_id"; // $id
                $setting_id = $this->agent_model->save($ldata, $data['employee_id']);
                $data['delivery_mount'] = $with_mount - $fee_mount ;
                $data['fee'] = $fee_mount;
                $data['time_time'] = date("Y-m-d h:i:s");
                $time_info= $employee_gourpinfo->group_withdraw_time;
                $data['time_count'] = $time_info;
                $data['time_state'] = 0;
                $this->emp_model->_table_name = "tbl_delivery"; // table name
                $this->emp_model->_order_by = "employee_id"; // $id
                $res = $this->emp_model->save($data, null);
                }
            $type = "success";
            $message = "提交成功！";
            set_message($type, $message);
            redirect('employee/dashboard/immediate_delivery');

            }else{
                    $type = "error";
                    $message = " 现在是过账期，请稍候再试。";
                    set_message($type, $message);
                    redirect('employee/dashboard/immediate_delivery');
            }

    }

    public function all_notice() {
        $data['menu'] = array("notice" => 1);
        $data['title'] = "九优付网站";
        // get all notice by flag
        $data['notice_info'] = $this->emp_model->get_all_notice();
        $data['subview'] = $this->load->view('employee/all_notice', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function order_view($id){
        $data['title'] = "九优付网站";
        $employee_id = $this->session->userdata('employee_id');
        $data['detail_order']=$this->emp_model->order_order_view($id);
        $data['employee_details'] = $this->emp_model->all_emplyee_info($employee_id);

        $data['subview'] = $this->load->view('employee/order_detail', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function order_pro($order_id){
       $this->emp_model->_table_name = 'tbl_order';
       $this->emp_model->_order_by = "order_id";
       $this->emp_model->_primary_key = "id";

       $order_info = $this->emp_model->get_by(array('order_id' => $order_id), TRUE);
       $_id=$order_info->id;
       $idata = array('id'=>$_id);
       $sdata['release_time'] = date('Y-m-d H:i:s');
       $sdata['order_status'] = '-2';
       if($this->emp_model->save($sdata, $_id)){
           redirect('employee/dashboard/search_order');
       }
    }

    public function test() {
        $data['menu'] = array("basic_profile" => 1);
        $data['title'] = "九优付网站";
        $employee_id = $this->session->userdata('employee_id');
        $banktype = 'ALIPAY';
        $test = $this->emp_model->get_order_data($employee_id, $banktype);
        print_r($test);

    }

    public function check_value(){
        $this->emp_model->_table_name = "tbl_sdl";// table name
        $this->emp_model->_order_by ="id";
        $real_value = $this->input->post('value');
        $data = $this->emp_model->get_by(array('id' => 1,), TRUE);
        $fee = $data->fee;
        $max_price = $data->max_sdl_value;
        $min_price = $data->min_sdl_value;
        $real = $real_value*$fee/100;
        if($real<$min_price){
            $result= '<small style="padding-left:10px;color:red;font-size:14px">输入金额太小</small>';
        }elseif($real>$max_price){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">输入金额太大</small>';
        }else{
            $result = NULL;
        }
        echo $result;// get result
    }

    public function immediate_reason($id){
      $data['title'] = "九优付网站";

      $data['delivery_info'] = $this->emp_model->get_delivery_reason($id);
      $data['subview'] = $this->load->view('employee/withdraw_reason', $data, TRUE);
      $this->load->view('employee/_layout_main', $data);

    }

    public function immediate_delivery(){
        $data['menu'] = array("immediate_delivery" => 1);
        $data['title'] = "九优付网站";
        $this->emp_model->_table_name = "tbl_bank_name";// table name
        $this->emp_model->_order_by ="id";
        $data['bank_nam'] =  $this->emp_model->get();

        $employee_id = $this->session->userdata('employee_id');
        $data['employee_details'] = $this->emp_model->all_emplyee_info($employee_id);
        $data['bank_name'] = $this->settings_model->get_bank_all_info();
        $sms_content = $this->session->userdata('sms_content');
        $this->load->helper(array('form', 'url'));
        $this->admin_model->_table_name = "tbl_sdl";// table name
        $this->admin_model->_order_by ="id";
        $data['gsetting'] =  $this->admin_model->get_by(array('id' => '1'), true);
        // load the BotDetect Captcha library and set its parameter
        $this->load->library('botdetect/BotDetectCaptcha', array(
            'captchaConfig' => 'ExampleCaptcha'
        ));
        // make Captcha Html accessible to View code
        $data['captchaHtml'] = $this->botdetectcaptcha->Html();
        // initially, the message shown to the visitor is empty
        $data['captchaValidationMessage'] = '';

        if ($_POST) {
            // validate the user-entered Captcha code when the form is submitted
            $code = $this->input->post('CaptchaCode');
            $isHuman = $this->botdetectcaptcha->Validate($code);
            $sms_code = $this->input->post('sms_code');
            if ($isHuman) {
                // Captcha validation passed
                $data['captchaValidationMessage'] = '图形验证码 成功';
                if($this->save_delivery()){
                    $data['captchaValidationMessage'] = '下发成功';

                }else{
                    $data['captchaValidationMessage'] = '下发失败';
                }

                // TODO: continue with form processing, knowing the submission was made by a human
            } elseif(!$isHuman) {
                // Captcha validation failed, return an error message
                $data['captchaValidationMessage'] = '图形验证码 失败';
            }else{
                $data['captchaValidationMessage'] = 'SMS证码 失败';
            }
        }
        // get all notice by flag
        $data['employee_details'] = $this->emp_model->all_emplyee_info($employee_id);
        $data['delivery'] = $this->emp_model->get_delivery_info($employee_id);
        $data['jisuan_jine'] = $this->emp_model->get_jisuan_jine($employee_id);
        $data['subview'] = $this->load->view('employee/immediate_delivery', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);

    }

    public function withdraw(){
        $data['menu'] = array("withdraw" => 1);
        $data['title'] = "九优付网站";
        // get all notice by flag
        $employee_id = $this->session->userdata('employee_id');
        $data['subview'] = $this->load->view('employee/withdraw', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);

    }
    public function uwithdraw_log(){
        $data['menu'] = array("withdraw_log" => 1);
        $data['title'] = "九优付网站";
        // get all notice by flag
        $employee_id = $this->session->userdata('employee_id');
        $sdata = array('tbl_delivery.employee_id'=>$employee_id);
        $data['withdraw_data'] = $this->emp_model->get_withdraw_data($sdata);
        $data['subview'] = $this->load->view('employee/withdraw_log', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function save_basicpro(){
       $employee_id = $this->session->userdata('employee_id');
       //$sdata['employee_id'] = $employee_id;
       $sdata['usr_company_name'] = $this->input->post(company_name);
       $sdata['usr_site_address'] = $this->input->post(usr_site_address);
       $this->emp_model->_table_name = 'tbl_employee';
       $this->emp_model->_primary_key = 'employee_id';
       $this->emp_model->save($sdata, $employee_id);
       redirect('employee/dashboard/basic_profile');

    }

     public  function sendEmail(){
        $to_email = $this->input->post('email');
        $this->emp_model->_table_name = "tbl_gsettings";// table name
        $this->emp_model->_order_by ="id_gsettings";
        $gsetting =  $this->emp_model->get_by(array('id_gsettings' => '1'), true);
        $from_email = 'toyokumi1988@gmail.com';
        $subject = '确认你的邮件地址';
        $message = '亲爱的 商户,<br /><br />这是您的下发地址。<br /><br />'.base_url().'register/verify/' . md5($to_email).'<br /><a href="'.base_url().'register/verify/' . md5($to_email).'">点击这里</a><br /><br />谢谢您<br />168xypay.com 服务团队';
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'shddkshdvkr'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        //send mail
        $this->email->from($from_email, '九尤付');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()){
            echo "发送成功！";
        }else{
            echo "发送失败 请您在试一下！ 麻烦您";
        }

    }
    public function download(){
        $data['menu'] = array("download" => 1);
        $data['title'] = "九优付网站";
        //  $id = $this->input->post('type_doc');
        //      if($id=="1"){
        //          $url = base_url().'asset/uploads/all_employees.docx';
        //          $data = file_get_contents($url); // Read the file's contents
        //          $name = '接口文档_点卡.docx';
        //         force_download($name, $data);
         //
        //       }elseif($id=="0"){
        //          $url = base_url().'asset/uploads/all_employees.docx';
        //          $data = file_get_contents($url); // Read the file's contents
        //          $name = 'all_employees.docx';
        //          force_download($name, $data);
        //      }
        $data['subview'] = $this->load->view('employee/download', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }
    public function ajax_download(){
        $id = $this->input->post('type_doc');
             if($id=="1"){
                 $url = base_url().'asset/uploads/all_employees.doc';
                 $data = file_get_contents($url); // Read the file's contents
                 $name = '接口文档_点卡.doc';
                force_download($name, $data);

              }elseif($id=="0"){
                 $url = base_url().'asset/uploads/all_employees.doc';
                 $data = file_get_contents($url); // Read the file's contents
                 $name = '接口文档_网银&&微信.doc';
                 force_download($name, $data);
             }
    }
    public function immediate_log(){
        $data['menu'] = array("immediate_log" => 1);
        $data['title'] = "九优付网站";
        $employee_id = $this->session->userdata('employee_id');
        $sdata['tbl_delivery.employee_id'] = $employee_id;
        if(!empty($_POST)){
            if($this->input->post('start_time')!=NULL){
                $sdata['create_time >='] = $this->input->post('start_time');
                $data['start_time']=$this->input->post('start_time');
            }
            if($this->input->post('end_time')!=NULL){
                $sdata['create_time <='] = $this->input->post('end_time');
                 $data['end_time']=$this->input->post('end_time');

            }
            if($this->input->post(delivery_status)!='-1'&&$this->input->post(delivery_status)!=null){
                $sdata['delivery_status'] = $this->input->post(delivery_status);
                $data['delivery_status']=$this->input->post('delivery_status');
            }
            if($this->input->post(delivery_bank_card)!=null){
                $sdata['delivery_bank_card'] = $this->input->post(delivery_bank_card);
                $data['delivery_bank_card']=$this->input->post('delivery_bank_card');

            }

            $data['withdraw_data'] = $this->emp_model->get_withdraw_data($sdata);

        }else{
            $data['withdraw_data'] = $this->emp_model->get_withdraw_data($sdata);

        }
        $data['subview'] = $this->load->view('employee/immediate_log', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
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
    public function card_type() {
        $data['menu'] = array("notice" => 1);
        $data['title'] = "九优付网站";
        // get all notice by flag
        $data['notice_info'] = $this->emp_model->get_all_notice();
        $data['subview'] = $this->load->view('new_theme/card_status', $data, TRUE);
        $this->load->view('new_theme/layout', $data);
    }
    public function card_table() {
        $data['menu'] = array("notice" => 1);
        $data['title'] = "九优付网站";
        // get all notice by flag
        $data['card_table'] = $this->emp_model->all_get_cardtype_table();

        $data['subview'] = $this->load->view('employee/card_table', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }


    public function notice_detail($id) {
        $data['title'] = "九优付网站";

        //get leave category for dropdown
        $this->emp_model->_table_name = "tbl_notice"; // table name
        $this->emp_model->_order_by = "notice_id"; // $id
        $data['full_notice_details'] = $this->emp_model->get_by(array('notice_id' => $id,), TRUE); // get result


        $data['subview'] = $this->load->view('employee/notice_details', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function all_events() {
        $data['menu'] = array("events" => 1);
        $data['title'] = "九优付网站";

        // get all notice by flag
        $data['event_info'] = $this->emp_model->get_all_events();

        $data['subview'] = $this->load->view('employee/events', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function event_detail($id) {
        $data['title'] = "九优付网站";

        //get leave category for dropdown
        $this->emp_model->_table_name = "tbl_holiday"; // table name
        $this->emp_model->_order_by = "holiday_id"; // $id
        $data['event_details'] = $this->emp_model->get_by(array('holiday_id' => $id,), TRUE); // get result

        $data['subview'] = $this->load->view('employee/event_details', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function all_award() {
        $data['menu'] = array("channel" => 1);
        $data['title'] = "九优付网站";
        $employee_id = $this->session->userdata('employee_id');
        $data['channel_rate'] = $this->emp_model->get_employee_channel_rate($employee_id);
        $data['subview'] = $this->load->view('employee/all_awards', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }
    public function funds_flow() {
        $data['menu'] = array("funds_flow" => 1);
        $data['title'] = "九优付网站";
        $employee_id = $this->session->userdata('employee_id');
        $this->emp_model->_table_name = "tbl_delivery"; // table name
        $this->emp_model->_order_by = "id"; // $id
        $delivery = $this->emp_model->get_by(array('employee_id' => $employee_id), false);
        $this->emp_model->_table_name = "tbl_order"; // table name
        $this->emp_model->_order_by = "order_id"; // $id
        $order = $this->emp_model->get_by(array('employee_id' => $employee_id), false);
        // get all notice by flag
        $i=1;
        foreach ($delivery as $v_employee) {
                 if($v_employee->delivery_status==2){
                      $remark = '<span class="label label-success col-sm-12" >付款完成</span>';
                  }elseif($v_employee->delivery_status==0){
                      $remark = '<span class="label label-primary col-sm-12">等待审核</span>';

                  }elseif($v_employee->delivery_status==1){
                      $remark = '<span class="label label-primary col-sm-12">审核通过</span>';
                  }else{
                      $remark = '<span class="label label-danger col-sm-12">审核拒绝  </span>';
                  }
                $data['all_info'][$i] = array(
                    'finance_time' => $v_employee->create_time,
                    'finance_name' => "提现金额",
                    'finance_submit' => $v_employee->delivery_mount,
                    'finance_type' => "支出",
                    'finance_balance' => $v_employee->fee,
                    'finance_amount' => $v_employee->fee+$v_employee->delivery_mount,
                    'finance_remarks' => $remark
                );
                $i++;
        }

        $i=$i+1;
        foreach ($order as $v_order) {
           if($v_order->order_status==1){
              $remark ='<span class="label label-success col-sm-12">成功</span>';
          }elseif ($v_order->order_status== '0'){
              $remark = '<span class="label label-primary col-sm-12">处理中</span>';
          }elseif ($v_order->order_status== '2'){
              $remark = '<span class="label label-danger col-sm-12">手动处理中</span>';
          }elseif($v_order->order_status == '5'){
              $remark = '<span class="label label-danger col-sm-12">待审核</span>';
          }elseif($v_order->order_status == '4'){
              $remark = '<span class="label label-danger col-sm-12">冻结</span>';
          }elseif($v_order->order_status == '7'){
              $remark = '<span class="label label-danger col-sm-12">退款成功</span>';
          }else{
              $remark = '<span class="label label-danger col-sm-12">失败</span>';
            }
        $data['all_info'][$i] = array(
            'finance_time' => $v_order->submit_time,
            'finance_name' => "订单金额",
            'finance_submit' => $v_order->real_amount*($v_order->employee_fee)/100,
            'finance_type' => "收益",
            'finance_balance' => $v_order->real_amount -($v_order->real_amount*$v_order->employee_fee/100),
            'finance_remarks' => $remark,
            'finance_amount' => $v_order->real_amount
        );
         $i++;
        }
        $data['subview'] = $this->load->view('employee/funds_flow', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function award_detail($id) {
        $data['title'] = "九优付网站";

        //get award detail info for particular employee
        $data['employee_award_info'] = $this->emp_model->get_all_awards($id);
        $data['subview'] = $this->load->view('employee/award_details_page', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function profile() {
        $data['title'] = "九优付网站";
        $employee_id = $this->session->userdata('employee_id');

        //get employee details
        $data['employee_details'] = $this->emp_model->all_emplyee_info($employee_id);

        $data['subview'] = $this->load->view('employee/user_profile', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    /*
     * Mailbox Controllers starts ------
     */
    public function inbox() {
        $data['menu'] = array("mailbox" => 1, "inbox" => 1);
        $data['title'] = "Employee Panel";
        $employee_id = $this->session->userdata('employee_id');

        //get leave category for dropdown
        $this->emp_model->_table_name = "tbl_employee"; // table name
        $this->emp_model->_order_by = "employee_id"; // $id
        $data['employee_details'] = $this->emp_model->get_by(array('employee_id' => $employee_id,), TRUE); // get result
        $email = $data['employee_details']->email;

        // get all inbox by email
        $data['get_inbox_message'] = $this->mailbox_model->get_inbox_message($email);
        $data['unread_mail'] = count($this->mailbox_model->get_inbox_message($email, TRUE));

        $data['subview'] = $this->load->view('employee/emp_inbox', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);

    }

    public function read_inbox_mail($id) {
        $data['title'] = "Inbox";
        $this->mailbox_model->_table_name = 'tbl_inbox';
        $this->mailbox_model->_order_by = 'inbox_id';
        $data['read_mail'] = $this->mailbox_model->get_by(array('inbox_id' => $id), true);

        $this->mailbox_model->_primary_key = 'inbox_id';
        $updata['view_status'] = '1';
        $this->mailbox_model->save($updata, $id);

        $data['subview'] = $this->load->view('employee/emp_read_mail', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function delete_inbox_mail() {
        // get sellected id into inbox email page
        $selected_inbox_id = $this->input->post('selected_inbox_id', TRUE);
        if (!empty($selected_inbox_id)) { // check selected message is empty or not
            foreach ($selected_inbox_id as $v_inbox_id) {
                $this->mailbox_model->_table_name = 'tbl_inbox';
                $this->mailbox_model->delete_multiple(array('inbox_id' => $v_inbox_id));
            }
            $type = "success";
            $message = "Your message has been Deleted.";
        } else {
            $type = "error";
            $message = "Please Select a Message to Delete.";
        }
        set_message($type, $message);
        redirect('employee/dashboard/inbox');
    }

    public function sent() {
        $data['menu'] = array("mailbox" => 1, "sent" => 1);
        $data['title'] = "Send Email";
        $employee_id = $this->session->userdata('employee_id');
        $data['get_sent_message'] = $this->mailbox_model->get_sent_message($employee_id);

        $data['subview'] = $this->load->view('employee/emp_sent', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function read_send_mail($id) {
        $data['title'] = "Inbox";
        $this->mailbox_model->_table_name = 'tbl_send';
        $this->mailbox_model->_order_by = 'send_id';
        $data['read_mail'] = $this->mailbox_model->get_by(array('send_id' => $id), true);

        $data['subview'] = $this->load->view('employee/dashboard/emp_read_mail', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function delete_send_mail() {
        // get sellected id into send email page
        $selected_send_id = $this->input->post('selected_send_id', TRUE);

        if (!empty($selected_send_id)) {
            foreach ($selected_send_id as $v_send_id) {
                $this->mailbox_model->_table_name = 'tbl_send';
                $this->mailbox_model->delete_multiple(array('send_id' => $v_send_id));
            }
            $type = "success";
            $message = "Your message has been Deleted.";
        } else {
            $type = "error";
            $message = "Please Select a Message to Delete.";
        }
        set_message($type, $message);
        redirect('employee/dashboard/sent');
    }

    public function compose() {
        $data['title'] = "Inbox";
        $this->mailbox_model->_table_name = 'tbl_employee';
        $this->mailbox_model->_order_by = 'employee_id';
        $data['get_employee_email'] = $this->mailbox_model->get_by(array('status' => '1'), FALSE);
        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('employee/emp_compose_mail', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function send_mail() {

        $discard = $this->input->post('discard', TRUE);
        if ($discard) {
            redirect('employee/dashboard/inbox');
        }
        $all_email = $this->input->post('to', TRUE);

        // get all email address
        foreach ($all_email as $v_email) {
            $data = $this->mailbox_model->array_from_post(array('subject', 'message_body'));
            if (!empty($_FILES['attach_file']['name'])) {
                $old_path = $this->input->post('attach_file_path');
                if ($old_path) {
                    unlink($old_path);
                }
                $val = $this->mailbox_model->uploadAllType('attach_file');
                $val == TRUE || redirect('employee/emp_compose_mail');
                // save into send table
                $data['attach_filename'] = $val['fileName'];
                $data['attach_file'] = $val['path'];
                $data['attach_file_path'] = $val['fullPath'];
                // save into inbox table
                $idata['attach_filename'] = $val['fileName'];
                $idata['attach_file'] = $val['path'];
                $idata['attach_file_path'] = $val['fullPath'];
            } else {
                $data['attach_filename'] = NULL;
                $data['attach_file'] = NULL;
                $data['attach_file_path'] = NULL;
                // save into inbox table
                $idata['attach_filename'] = NULL;
                $idata['attach_file'] = NULL;
                $idata['attach_file_path'] = NULL;
            }
            $data['to'] = $v_email;
            /*
             * Email Configuaration
             */
            $employee_id = $this->session->userdata('employee_id');

            //get employee email address by employee id
            $this->emp_model->_table_name = "tbl_employee"; // table name
            $this->emp_model->_order_by = "employee_id"; // $id
            $employee_details = $this->emp_model->get_by(array('employee_id' => $employee_id,), TRUE); // get result

            $name = $employee_details->email;
            $info = $data['subject'];
            // set from email
            $from = array($name, $info);
            // set sender email
            $to = $v_email;
            //set subject
            $subject = $data['subject'];
            $data['employee_id'] = $employee_id;
            $data['message_time'] = date('Y-m-d H:i:s');
            // save into send
            $this->mailbox_model->_table_name = 'tbl_send';
            $this->mailbox_model->_primary_key = 'send_id';
            $send_id = $this->mailbox_model->save($data);

            // get mail info by send id to send
            $this->mailbox_model->_table_name = 'tbl_send';
            $this->mailbox_model->_order_by = 'send_id';
            $data['read_mail'] = $this->mailbox_model->get_by(array('send_id' => $send_id), true);

            // set view page
            $view_page = $this->load->view('employee/read_mail', $data, TRUE);
            $send_email = $this->mail->sendEmail($from, $to, $subject, $view_page);
            // save into inbox table procees
            $idata['to'] = $employee_details->email;
            $idata['from'] = $data['to'];
            $idata['subject'] = $data['subject'];
            $idata['message_body'] = $data['message_body'];
            $idata['message_time'] = date('Y-m-d H:i:s');
            // save into inbox
            $this->mailbox_model->_table_name = 'tbl_inbox';
            $this->mailbox_model->_primary_key = 'inbox_id';
            $this->mailbox_model->save($idata);
        }
        if ($send_email) {
            $type = "success";
            $message = "Your message has been sent.";
            set_message($type, $message);
            redirect('employee/dashboard/sent');
        } else {
            show_error($this->email->print_debugger());
        }
    }

    /*
     * Mailbox Controllers ends ------
     */

    public function change_password() {
        $data['menu'] = array("profile" => 1, "change_password" => 1);
        $data['title'] = "九优付网站";
        $data['subview'] = $this->load->view('employee/change_password', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function check_employee_password($val) {
        $password = $this->hash($val);
        $check_dupliaction_id = $this->emp_model->check_by(array('password' => $password), 'tbl_employee_login');
        if (empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:10px;"> 密码错误了</small>';
        } else {
            $result = NULL;
        }
        echo $result;
    }

    public function set_clocking($id = null)
    {
        //sate into attendance table
        $adata['employee_id'] = $this->session->userdata('employee_id');

        $clocktime = $this->input->post('clocktime', TRUE);
        $adata['date'] = $this->input->post('date', TRUE);

        if (!empty($adata['date'])) {
            // chck existing date is here or not
            $check_date = $this->emp_model->check_by(array('employee_id' => $adata['employee_id'], 'date' => $adata['date']), 'tbl_attendance');
        }
        else if (!empty($id)) {
            // chck existing id is here or not
            $check_date = $this->emp_model->check_by(array('attendance_id' => $id), 'tbl_attendance');
        }

        if(!empty($check_date)){

        } else{

            $this->emp_model->_table_name = "tbl_attendance"; // table name
            $this->emp_model->_primary_key = "attendance_id"; // $id

            $adata['time_in'] = date('h:i A');
            $adata['attendance_status'] = 1;
            $adata['id_gsettings'] = $this->session->userdata('id_gsettings');
            $adata['clocking_status'] = 1;

            //save data into attendance table
            $data['attendance_id'] = $this->emp_model->save($adata);
        }
        redirect('employee/dashboard');
    }
    public function time_history()
    {
        $data['menu'] = array("time_history" => 1);
        $data['title'] = "Time Clock History";

        $flag = $this->input->post('sbtn',TRUE);
        if($flag)
        {
            $data['month'] = $this->input->post('txtmonth',TRUE);
            $emp = $this->session->userdata('employee_id');
            $this->emp_model->_table_name = "tbl_attendance"; // table name
            $this->emp_model->_order_by = "date";

            $data['attendance_info'] = $this->emp_model->get_by(array('DATE_FORMAT(date,"%Y-%m")' => $data['month'],'employee_id' => $emp),FALSE);
            //print_r($data['attendance_info']);die;
        }
        $data['subview'] = $this->load->view('employee/time_history', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);

    }

    public function payslip() {
        $data['menu'] = array("payslip" => 1);
        $data['title'] = "Payslip Info";
        $data['subview'] = $this->load->view('employee/payslip', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function salary_payment_details($salary_payment_id) {
        $data['title'] = "Manage Salery Details";
        $data['page_header'] = "Payroll Management";
        $data['salary_payment_info'] = $this->emp_model->get_salary_payment_info($salary_payment_id);
        $data['subview'] = $this->load->view('employee/salary_payment_details', $data, FALSE);
        $this->load->view('admin/_layout_modal_lg', $data);
    }

    public function expense($id = NULL) {
        $data['title'] = 'My expense';
        $data['menu'] = array("expense" => 1);
        $this->session->userdata('employee_id');
        if (!empty($id)) {
            $data['active'] = 2;
        } else {
            $data['active'] = 1;
        }
        $data['subview'] = $this->load->view('employee/my_expense', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function save_expense($id = NULL) {
        // input data
        $data = $this->emp_model->array_from_post(array('item_name', 'purchase_from', 'purchase_date', 'amount', 'employee_id')); //input post
        // save into tbl expense and return expense id
        $this->emp_model->_table_name = "tbl_expense"; // table name
        $this->emp_model->_primary_key = "expense_id"; // $id
        $expense_id = $this->emp_model->save($data, $id);
        //upload bill info
        if (!empty($_FILES['bill_copy']['name']['0'])) {

            $old_path = $this->input->post('bill_copy_path');
            if ($old_path) {
                unlink($old_path);
            }
            $mul_val = $this->emp_model->multi_uploadAllType('bill_copy');
            foreach ($mul_val as $val) {
                $val == TRUE || redirect('employee/dashboard/expense');
                $bdata['bill_copy'] = $val['path'];
                $bdata['bill_copy_filename'] = $val['fileName'];
                $bdata['bill_copy_path'] = $val['fullPath'];
                $bdata['expense_id'] = $expense_id;
                $this->emp_model->_table_name = "tbl_expense_bill_copy"; // table name
                $this->emp_model->_primary_key = "expense_bill_copy_id"; // $id
                $this->emp_model->save($bdata, $id);
            }
        }
        $type = "success";
        $message = "Expense Information Successfully Saved!";
        set_message($type, $message);
        redirect('employee/dashboard/expense'); //redirect page
    }
    public function order_delect($id){

        $data['title'] = "九优付网站";
        $type = "success";
        $message = "删除成功!"; //Page title
        set_message($type, $message);
        $this->settings_model->delete_order($id);

        redirect('employee/dashboard/search_order');

    }

    public function set_password() {
        $employee_login_id = $this->session->userdata('employee_login_id');
        $data['password'] = $this->hash($this->input->post('new_password'));
        $this->emp_model->_table_name = 'tbl_employee_login';
        $this->emp_model->_primary_key = 'employee_login_id';
        $this->emp_model->save($data, $employee_login_id);
        $type = "success";
        $message = "修改成功!";
        set_message($type, $message);
        redirect('login/logout'); //redirect page
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    public function over_time()
    {
        $data['menu'] = array("over_time" => 1);
        $data['title'] = "Employee Overtime Clock History";

        $flag = $this->input->post('sbtn',TRUE);
        if($flag)
        {
            $data['month'] = $this->input->post('txtmonth',TRUE);
            $emp = $this->session->userdata('employee_id');
            $this->emp_model->_table_name = "tbl_attendance"; // table name
            $this->emp_model->_order_by = "date";

            $data['attendance_overtime_info'] = $this->emp_model->get_day_base_total_hours($emp, $data['month']);
            /*echo '<pre>';
            print_r($data['attendance_overtime_info']);die;*/
        }
        $data['subview'] = $this->load->view('employee/over_time', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);

    }

    public function over_time_cause() {
        $data['title'] = "Overtime Cause";

        $data['subview'] = $this->load->view('employee/over_time_cause', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }
    public function search_order() {
        $data['title'] = "九优付网站";
        $data['menu'] = array("search_order" => 1);
        $employee_id = $this->session->userdata('employee_id');
        $data['price'] = $this->emp_model->get_price_info($employee_id);
        if(!empty($_POST)){
            $sdata['tbl_order.employee_id'] = $employee_id;
            if($this->input->post('start_time')!=NULL){
                $data['start_date']=$this->input->post('start_time');
                $sdata['submit_time >='] = $this->input->post('start_time');
            }
            if($this->input->post('end_time')!=NULL){
                $data['end_date']=$this->input->post('end_time');
                $sdata['submit_time <='] = $this->input->post('end_time');
            }
            if($this->input->post('pay_mode')!=NULL&&$this->input->post('pay_mode')!=='-1'){
                $data['pay_mode']= $sdata['pay_mode'] = $this->input->post('pay_mode');
            }
            if($this->input->post('pay_method')!=NULL&&$this->input->post('pay_method')!==''){
              if($this->input->post('pay_method') == 'ONLINE'){
                $sdata['pay_method'] = 'SHB';

                $sea = 'online';

              }else {
                $sdata['pay_method'] = $this->input->post('pay_method');
                $sea = null;
              }
                $data['pay_method'] = $this->input->post('pay_method');
            }
             if($this->input->post('order_status')!=NULL&&$this->input->post('order_status')!==''){
                $data['order_status']= $sdata['order_status'] = $this->input->post('order_status');
            }
            if($this->input->post('order_num')!=NULL){
                $data['order_id']=$sdata['order_id'] = $this->input->post('order_num');
            }
            if($this->input->post('recharge_card_num')!=NULL){
                $data['recharge_card_num'] = $sdata['recharge_card_num'] = $this->input->post('recharge_card_num');
            }
            $data['search_order'] = $this->emp_model->search_order_table_info($sdata, $sea);



        }else{
            $data['search_order'] = $this->emp_model->all_order_table_info($employee_id);

        }
        // get all notice by flag
        $this->emp_model->_table_name = "tbl_channel_rate"; // table name
        $this->emp_model->_order_by = "id"; // $id
        $data['all_leave_category'] = $this->emp_model->get();
        $this->emp_model->_table_name = "tbl_channel"; // table name
        $this->emp_model->_order_by = "id"; // $id
        $data['channel_name'] = $this->emp_model->get();
        $data['subview'] = $this->load->view('employee/search_order', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    function passive_order(){
        $sys_order = $this->input->post('sys_serial_num');
        if($sys_order){
            if ($sys_order=="") {
                    $type = "error";
                    $message = "手动补单处理失败！";
                    set_message($type, $message);
                    redirect('employee/dashboard/passive_order');
            }
                $this->emp_model->_table_name = 'tbl_order';
                $this->emp_model->_order_by = "id";
                $check_order_id =  $this->emp_model->get_by(array('sys_serial_num' => $sys_order), true);
            if ($check_order_id) {
                    $type = "error";
                    $message = "手动补单处理失败！";
                    set_message($type, $message);
                    redirect('employee/dashboard/passive_order');
            }


        $employee_id = $this->session->userdata('employee_id');
        $banktype = $this->input->post('pay_method');
        if ($banktype=="") {
                $type = "error";
                $message = "手动补单处理失败！";
                set_message($type, $message);
                redirect('employee/dashboard/passive_order');
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
        }
        else{
           $chanel_name = 'channel_online';
           $chanel_limit = "online_limit";
           $banktype_clone = "ONLINE";
           $banktype = 'ICBC';
        }
        $employee_info =  $this->emp_model->get_order_data($employee_id, $banktype);

        if ($employee_info->status!=1) {
            $type = "error";
            $message = "你的账面价值被冻结。";
            set_message($type, $message);
            redirect('employee/dashboard/passive_order');
        }

        $paymoney = $this->input->post('real_amount');


        if ($paymoney < $employee_info->$chanel_limit) {
            $type = "error";
            $message = "你提交的金额太低了。";
            set_message($type, $message);
            redirect('employee/dashboard/passive_order');
        }


        $this->settings_model->_table_name = "tbl_employee"; //table name
        $this->settings_model->_order_by = "employee_id";
        $emp_all_info = $this->settings_model->get_by(array('employee_id' => $employee_id), TRUE); //employee_all info
        if ($banktype_clone) {
            $submit_info =  $this->emp_model->get_gateway_hao_info($employee_id, $chanel_name, $banktype_clone);
        }else{
            $submit_info =  $this->emp_model->get_gateway_hao_info($employee_id, $chanel_name, $banktype);
        }
             //channel agent
        $submit_all_info =  $this->emp_model->get_gateway_jangfu_info($submit_info[0]['num'], $submit_info[0]['email']); //gateway account

        $this->settings_model->_table_name = "tbl_channel"; //table name
        $this->settings_model->_order_by = "id";
        $emp_all_info_fee = $this->settings_model->get_by(array('id' => $emp_all_info->$chanel_name), TRUE); //employee_all info


        if (empty($submit_all_info)) {
            $type = "error";
            $message = "没有注册的账号!!!";
            set_message($type, $message);
            redirect('employee/dashboard/passive_order');
        }

        if ($submit_all_info->loop_state!=1) {
            $type = "error";
            $message = "账号冻结!!!";
            set_message($type, $message);
            redirect('employee/dashboard/passive_order');
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

        $this->emp_model->_table_name = "tbl_order"; // table name
        $this->emp_model->_primary_key = "id";

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
        $this->emp_model->save($data);


        $this->emp_model->_table_name = 'tbl_order';
        $this->emp_model->_order_by = 'id';
        $info =  $this->emp_model->get_by(array('order_id' => $ordernumber), true);
        $employee_id = $info->employee_id;
        $employee_fee = $paymoney*$info->employee_fee/100;
        $agent_fee = $paymoney*($info->proxy_fee-$info->employee_fee)/100;
        $pingtai_fee = $paymoney*$info->cost_ratio/100 - $employee_fee - $agent_fee;

        $data['final_price'] = $employee_fee+$pingtai_fee+$agent_fee;

            $this->emp_model->_table_name = 'tbl_employee';
            $this->emp_model->_order_by = 'employment_id';
            $emp_data = $this->emp_model->get_by(array('employee_id' => $employee_id), TRUE);
            $usr_amount = $emp_data->usr_amount;
            $usr_amount = $usr_amount + $employee_fee;
            $datae = array('usr_amount' => $usr_amount);
            $wheree = array('employee_id'=>$employee_id);
            $this->emp_model->set_action($wheree, $datae, 'tbl_employee');

            $submit_all_info_fe =  $this->emp_model->get_gateway_jangfu_info($info->gateway_id, $info->proxy_mail);
            $pingtai_mount = $submit_all_info_fe->account_amount + $paymoney ;
            $datag = array('account_amount' => $pingtai_mount);
            $whereg = array('gateway_id'=>$info->gateway_id);
            $this->emp_model->set_action($whereg, $datag, 'tbl_gateway_account');



            $this->emp_model->_table_name = 'tbl_proxy';
            $this->emp_model->_order_by = 'proxy_id';
            $agent_data = $this->emp_model->get_by(array('mail_address' => $info->proxy_mail), TRUE);

            $agent_amount = $agent_data->account_amount + $agent_fee;
            $datap = array('account_amount' => $agent_amount);
            $wherep = array('mail_address'=>$info->proxy_mail);
            $this->emp_model->set_action($wherep, $datap, 'tbl_proxy');


            ////////////////////////////////////

            $type = "success";
            $message = "手动补单处理成功！";
            set_message($type, $message);
            redirect('employee/dashboard/search_order');

            ////////////////////////////////

        }

        $this->emp_model->_table_name = "tbl_channel_rate"; // table name
        $this->emp_model->_order_by = "id"; // $id
        $data['all_leave_category'] = $this->emp_model->get();// get result

        $data['title'] = "九优付网站";
        $data['subview'] = $this->load->view('employee/passive_order', $data, TRUE);
        $this->load->view('employee/_layout_main', $data);
    }

    public function save_over_time_cause() {
        $this->emp_model->_table_name = "tbl_overtime_report"; // table name
        $this->emp_model->_primary_key = "overtime_report_id"; // $id
        //receive form input by post
        $data['employee_id'] = $this->input->post('employeeId');
        $data['date'] = $this->input->post('overtimeDate');
        $data['report'] = $this->input->post('reason');
        $data['report_create'] = date("Y-m-d");
        //save data in database
        /*echo '<pre>';
        print_r($data);
        die();*/
        $this->emp_model->save($data);

        // messages for user
        $type = "success";
        $message = "Overtime Cause Successfully Submitted !";
        set_message($type, $message);
        redirect('employee/dashboard/over_time');
    }

    public function send_sms(){
        $this->emp_model->_table_name = "tbl_sdl";// table name
        $this->emp_model->_order_by ="id";
        $gsetting =  $this->emp_model->get_by(array('id' => '1'), true);
        $sms_user_name = $gsetting->sms_gatewayid;
        $sms_pass_word = $gsetting->sms_gatewaykey;
        $curl_send="http://api.smsbao.com/sms?u=".$sms_user_name."&p=".$sms_pass_word;
        $employee_id = $this->session->userdata('employee_id');
        $phone_number = $this->emp_model->get_user_phone_number($employee_id);
        $mobile="";
        foreach ($phone_number as $val){
            $mobile = $val->usr_mobile;
        }
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


}
