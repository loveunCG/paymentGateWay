<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        
    }

public function index(){
      $dashboard = $this->session->userdata('url');
      $this->login_model->loggedin() == FALSE || redirect($dashboard);    
      $this->load->helper(array('form', 'url'));
        // load the BotDetect Captcha library and set its parameter
        $this->load->library('botdetect/BotDetectCaptcha', array(
            'captchaConfig' => 'ExampleCaptcha'
        ));
        // make Captcha Html accessible to View code
        $data['captchaHtml'] = $this->botdetectcaptcha->Html();

        // initially, the message shown to the visitor is empty
        $data['captchaValidationMessage'] = '';
        $this->db->select('tbl_employee_group.*', FALSE);
        $this->db->from('tbl_employee_group');
        $query_result = $this->db->get();
        $result = $query_result->result();
        $data['employee'] = $result;    
        $this->admin_model->_table_name = "tbl_gsettings";// table name
        $this->admin_model->_order_by ="id_gsettings";
        $data['gsetting'] =  $this->admin_model->get_by(array('id_gsettings' => '1'), true);   

        $this->admin_model->_table_name = "tbl_bank_name";// table name
        $this->admin_model->_order_by ="id";
        $data['bank_name'] =  $this->admin_model->get(); 
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
        $this->load->view('intro/login', $data);
}

public function login() {
        //$this->session->sess_destroy(); //
        $rules = $this->login_model->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {                       
            if ($data=$this->login_model->login()) {

                   if($data['proxy_email']!=null){
                       redirect('login');
                   }
                    if ($this->login_model->is_member_plan_expired($data)) {
                        redirect('login');                
                    } else {
                        //echo 'anjan 1st else';
                        $this->session->set_flashdata('error', 'Subscription member plan has expired.');
                        redirect('login', 'refresh');
                    }
                }
            else {
                    //echo 'anjan 2nd else';
                    $this->session->set_flashdata('error', 'Username / Password combination does not exist.');
                    redirect('login', 'refresh');
                }
           //@sunny for check member plan expired 09/07/2016 ends here     
        }  
        $uri2 = $this->uri->segment(2);
        if (empty($uri2))  {
            redirect('intro/login');
        }       
        $this->load->view('intro/login', $data);
    }

    public function logout() {
        $this->login_model->logout();
        redirect('login');
    }

}