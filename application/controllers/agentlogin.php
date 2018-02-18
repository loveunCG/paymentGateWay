<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agentlogin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('agent_model');
        $this->load->model('admin_model');
        $this->load->model('emp_model');
        $this->load->model('settings_model');
    }

public function index(){
      $this->load->helper(array('form', 'url'));
      $this->admin_model->_table_name = "tbl_gsettings";// table name
      $this->admin_model->_order_by ="id_gsettings";
      $data['gsetting'] =  $this->admin_model->get_by(array('id_gsettings' => '1'), true);
      $this->admin_model->_table_name = "tbl_bank_name";// table name
        $this->admin_model->_order_by ="id";
        $data['bank_name'] =  $this->admin_model->get();
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
                $data['captchaValidationMessage'] = '图形验证码 成功';
                $this->login();
                $data['captchaValidationMessage'] = '登录成功';
                // TODO: continue with form processing, knowing the submission was made by a human
            } else {
                // Captcha validation failed, return an error message
                $data['captchaValidationMessage'] = '登录 失败';
            }
        }
    $this->load->view('agent/login', $data);
}

public function signup(){
    $agentname = $this->input->post('mail_address');
    if($this->sendEmail($agentname)){
            $this->save_data();
        }else{
           redirect('register/error_view');

        }


}
 public function verify($hash=NULL)
    {
        if ($this->agent_model->verifyEmailID($hash))
        {
            $data['info']= '5';
            $this->result_view($data);
        }
        else
        {
            $$data['info'] = '6';
            $this->result_view($data);
        }
  }
  public function result_view($data){
      $this->load->view('intro/signup', $data);
  }
  public function error_view(){
        $this->load->view('intro/error', $data);
  }
  public  function sendEmail($to_email)
    {
        $this->emp_model->_table_name = "tbl_gsettings";// table name
        $this->emp_model->_order_by ="id_gsettings";
        $gsetting =  $this->emp_model->get_by(array('id_gsettings' => '1'), true);
        $from_email = $gsetting->smtp_user;
        $smtp_port = $gsetting->smtp_port;
        $subject = '确认你的邮件地址';
        $message = '亲爱的 商户,<br /><br />请点击下面的激活链接验证您的电子邮件地址。<br /><br />'.base_url().'agentlogin/verify/' . md5($to_email).'<br /><a href="'.base_url().'agentlogin/verify/' . md5($to_email).'">点击这里</a><br /><br />谢谢您<br />168xypay.com 服务团队';
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $gsetting->smtpserver; //smtp host name
        $config['smtp_port'] = $smtp_port; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = $gsetting->smtp_pass; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        //send mail
        $this->email->from($from_email, '九优通');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    public function save_data($id=null) {
            $agentname = $this->input->post('mail_address');
            $this->settings_model->_table_name = 'tbl_proxy';
            $this->settings_model->_order_by = 'proxy_id';
            $agentnum = $this->settings_model->get_by(array('mail_address' => $agentname ), TRUE);
            if ($agentnum) {
                    $type = "warning";
                    $message = "帐户已经存在。";
                    set_message($type, $message);
                    redirect('agentlogin','refresh');
            }

            $this->settings_model->_table_name = "tbl_proxy"; // table name
            $this->settings_model->_primary_key = "proxy_id"; // $id

            $data = $this->settings_model->array_from_post(array('mail_address', 'qq_num', 'contact_person', 'id_number', 'bank_card_number', 'bank_name', 'bank_of_the_province_where_the_bank', 'contact_number'));
            $data['proxy_password'] = $this->hash($this->input->post('proxy_password'));
            $data['agent_key'] = md5($this->input->post('proxy_password'));
            $data['proxy_state'] = 1;
            $data['registration_time'] = date("Y-m-d H:i:s");

            $this->settings_model->save($data,$id);            // messages for user
                    $type = "success";
                    $message = "注册成功。 它必须是一个帐户的批准。";
                    set_message($type, $message);
                    $data['info'] = '3';
                    $this->result_view($data);
        }


    public function login() {
        $dashboard = "agentlogin";
        if ($data=$this->agent_model->login()) {
            if ($data['user_type']==3) {
               redirect($data['url']);
            }elseif ($data['user_type']==4) {
                    $data['message'] = "此帐户未获批准。";
                    $this->load->view('agent/alert', $data);

            }

         }
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

      public function send_sms($phone_num){
        $curl_send="http://api.smsbao.com/sms?u=huange&p=efbe1f2c1925f8b0a4b2d7fb63c00301";
        $mobile=$phone_num;
        $code = $this->sms_content();
        $contetnt = "【九优付】账号注册验证码:".$code;
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
            $data['sms_content']=$code;
            $this->session->set_userdata($data);
            echo $resp;

        }else{
            echo $resp;
        }
        // Close request to clear up some resources
        curl_close($curl);
        return $resp;
    }
   public function check_proxy_id() {
        $val = $this->input->post('proxyID');
        $check_dupliaction_id = $this->admin_model->check_by(array('mail_address' => $val), 'tbl_proxy');
        if (!empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">账户重复</small>';

        } else {
            $result = NULL;

        }
        echo $result;
    }
    public function check_password(){
        $val =$this->hash($this->input->post('proxyID'));

        $check_dupliaction_id = $this->admin_model->check_by(array('proxy_password' => $val), 'tbl_proxy');
        if (empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">没有这些密码</small>';

        } else {
            $result = NULL;

        }
        echo $result;

    }
     public function check_proxy_id_login() {
        $val = $this->input->post('proxyID');
        $check_dupliaction_id = $this->admin_model->check_by(array('mail_address' => $val), 'tbl_proxy');
        $check_proxy_role = $this->admin_model->check_by(array('mail_address' => $val, 'proxy_state'=>1), 'tbl_proxy');
        $check_proxy_email = $this->admin_model->check_by(array('mail_address' => $val, 'proxy_state'=>0), 'tbl_proxy');
        $check_proxy_email1 = $this->admin_model->check_by(array('mail_address' => $val, 'proxy_state'=>3), 'tbl_proxy');
        $check_proxy_email2 = $this->admin_model->check_by(array('mail_address' => $val, 'proxy_state'=>4), 'tbl_proxy');


        if (empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该账户不存在。</small>';

        } elseif(!empty($check_proxy_role)){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该代理未通过验证。</small>';

        }elseif(!empty($check_proxy_email1)){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该代理已被冻结。</small>';

        }elseif(!empty($check_proxy_email2)){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该代理已被拒绝验证。</small>';

        }elseif(!empty($check_proxy_email)){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该代理已被冻结。</small>';
        }else{
            $result = NULL;
        }
        echo $result;
    }
	public function check_code(){
        $val = $this->input->post('proxyID');
        $code = $this->session->userdata('sms_content');
		if ($code != $val) {
            $result = '<small style="padding-left:10px;color:red;font-size:10px;"> 代码错误了</small>';
        } else {
            $result = NULL;
        }
        echo $result;
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
