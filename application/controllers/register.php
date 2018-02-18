<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('emp_model');
        $this->load->model('admin_model');
        $this->lang->load('en_admin', 'english');
      //  $this->load->model('register_model');
    }
    public function index() {
        $this->admin_model->_table_name = "tbl_gsettings";// table name
        $this->admin_model->_order_by ="id_gsettings";
        $gsetting =  $this->admin_model->get_by(array('id_gsettings' => '1'), true);
        $password_hash = $this->hash($this->input->post('password'));
        $law_name = $this->input->post('username');
        $phone_num = $this->input->post('phone_num');
        $usr_email = $this->input->post('usr_email');
        $emp_group_id = $this->input->post('group_id');
        $usr_bank_name = $this->input->post('usr_bank_name');
        $usr_bank_num = $this->input->post('usr_bank_num');
        $usr_company_name = $this->input->post('usr_company_name');
        $data = array(
        'password' => $password_hash,
        'usr_mobile' => $phone_num,
        'law_name' =>$law_name,
        'usr_email' =>$usr_email,
        'usr_gourp'=>$emp_group_id,
        'usr_bank_name' =>$usr_bank_name,
        'usr_bank_num' =>$usr_bank_num,
        'usr_company_name' => $usr_company_name,
        );
        if($gsetting->whether_mail=='1'){
           if ($this->sendEmail($this->input->post('usr_email')))
           {
              $data['usr_email_status'] = 1;
							$data['usr_status'] = 5;
              $this->emp_model->save_data($data);
              redirect('register/review');
           }else
          {
                // error
              redirect('register/error_view');
          }

        }else{
					    $data['usr_status'] = 2;
					    $data['usr_email_status'] = 0;
              $this->emp_model->save_data($data);
              $data['info'] = 1;
              $this->result_view($data);
        }

    }
    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    public function verify($hash=NULL)
    {
        if ($this->emp_model->verifyEmailID($hash))
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
    public function review(){
        $data['info'] = 1;
        $this->load->view('intro/signup', $data);
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
        $message = '亲爱的 商户,<br /><br />请点击下面的激活链接验证您的电子邮件地址。<br /><br />'.base_url().'register/verify/' . md5($to_email).'<br /><a href="'.base_url().'register/verify/' . md5($to_email).'">点击这里</a><br /><br />谢谢您<br />168xypay.com 服务团队';
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
        $this->email->from($from_email, '九尤付');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }
    //activate user account
    public function send_sms($phone_num){
        $this->emp_model->_table_name = "tbl_sdl";// table name
        $this->emp_model->_order_by ="id";
        $gsetting =  $this->emp_model->get_by(array('id' => '1'), true);
        $sms_user_name = $gsetting->sms_gatewayid;
        $sms_pass_word = $gsetting->sms_gatewaykey;
        $curl_send="http://api.smsbao.com/sms?u=".$sms_user_name."&p=".$sms_pass_word;
        // $curl_send="http://api.smsbao.com/sms?u=huange&p=efbe1f2c1925f8b0a4b2d7fb63c00301";
        $mobile=$phone_num;
        $code = $this->sms_content();
        $content = "【九优付】账号注册验证码:".$code;
        $curl_send.="&m=".$mobile;
        $curl_send.="&c=".$content;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $curl_send,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        $resp = curl_exec($curl);
        if($resp == '0'){
            $data['sms_content']=$code;
            $this->session->set_userdata($data);
            echo $resp;
        }else{
            echo $resp;
        }
        curl_close($curl);
        return $resp;
    }
    public function check_emp_id($val) {
        $check_dupliaction_id = $this->admin_model->check_by(array('employment_id' => $val), 'tbl_employee');
        $check_dupliaction_id1 = $this->admin_model->check_by(array('user_name' => $val), 'tbl_user');
        if (!empty($check_dupliaction_id)||!empty($check_dupliaction_id1)) {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">账户重复</small>';

        } else {
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
   public function check_email_id() {
        $val = $this->input->post('proxyID');
        $check_dupliaction_id = $this->admin_model->check_by(array('employment_id' => $val), 'tbl_employee');
        if (!empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">账户重复</small>';

        } else {
            $result = NULL;

        }
        echo $result;
    }
   public function check_email_login_id(){
        $val = $this->input->post('proxyID');
        $check_emp_email = $this->admin_model->check_by(array('employment_id' => $val), 'tbl_employee');
        $check_emp_email_status = $this->admin_model->check_by(array('employment_id' => $val, 'usr_email_status'=>'1'), 'tbl_employee');
        $check_emp_status = $this->admin_model->check_by(array('employment_id' => $val, 'usr_status'=>'2'), 'tbl_employee');
        $check_emp_status1 = $this->admin_model->check_by(array('employment_id' => $val, 'usr_status'=>'3'), 'tbl_employee');
        $check_emp_status3 = $this->admin_model->check_by(array('employment_id' => $val, 'usr_status'=>'1'), 'tbl_employee');
        $check_emp_status2 = $this->admin_model->check_by(array('employment_id' => $val, 'usr_status'=>'4'), 'tbl_employee');
        $check_emp_status4 = $this->admin_model->check_by(array('employment_id' => $val, 'usr_status'=>'0'), 'tbl_employee');
        $check_admin = $this->admin_model->check_by(array('user_name' => $val), 'tbl_user');
        if (empty($check_emp_email)&&empty($check_admin)){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该账户不存在。</small>';
        }elseif(!empty($check_emp_email_status)) {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">还没验证邮箱! 请发送电子邮件认证。</small>';
        }elseif(!empty($check_emp_status)){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该商户未通过验证。</small>';
        }elseif(!empty($check_emp_status1)){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该商户已被拒绝验证。</small>';

        }elseif(!empty($check_emp_status2)){
            $result = '<small style="padding-left:10px;color:red;font-size:14px">该商户已被冻结。</small>';

        }elseif(!empty($check_admin)){
            $result = NULL;
        }
        elseif(!empty($check_emp_status3)){
            $result = NULL;
        }
        elseif(!empty($check_emp_status4)){
            $result = NULL;
        }else{
            $result = '<small style="padding-left:10px;color:red;font-size:14px">未经授权帐户。</small>';

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
