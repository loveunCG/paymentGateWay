<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of employee
 *
 * @author NaYeM
 */
class Employee extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('settings_model');
    }

    public function add_employee($id = NULL) {
        //Author: Asemployeeaf
        $data['title'] = "Add Employee";
		//sod -b
		$data['id_gsettings'] = $this->session->userdata('id_gsettings');
		//sod - e

        if (!empty($id)) {// retrive data from db by id
            $data['employee_info'] = $this->employee_model->all_emplyee_info($id);
			//echo $query  = $this->db->last_query();
            if (empty($data['employee_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/employee/add_employee');
            }
        }

        // retrive all data from department table
        $this->employee_model->_table_name = "tbl_employee_group"; //table name
        $this->employee_model->_order_by = "id";
        $data['all_proxy_info'] = $this->employee_model->get();

        // retrive country
        $this->employee_model->_table_name = "countries"; //table name
        $this->employee_model->_order_by = "countryName";
        $data['all_country'] = $this->employee_model->get();


        $data['all_bank'] = $this->employee_model->bankinfo();



        $data['subview'] = $this->load->view('admin/employee/add_employee', $data, TRUE); //add




        $this->load->view('admin/_layout_main', $data);
    }

    public function radom_update_code(){
        $code = $this->sms_content();
        $employee_id = $this->input->post('employee');
        $data['usr_pay_check_code'] = md5($code);
        $res = $this->db->update('tbl_employee', $data, array('employee_id'=>$employee_id));
        if($res){
            echo md5($code);
        }else{
            echo "错误!";
        }

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

    public function save_employee($id = NULL) {
        // **** Employee Personal Details,Contact Details and Official Status Save And Update Start ***
        //input post


        $saveinfo = $this->db->list_fields('tbl_employee');
        foreach ($saveinfo as $value) {
            if (!empty($this->input->post($value, TRUE))) {
                $data[$value] = $this->input->post($value, TRUE);
            }
        } 


<<<<<<< .mine
                $data["usr_create_time"] = date("Y-m-d H:i:s");
                $data["id_gsettings"] = 1;
                $data["usr_email_status"] = 0;
                $data["employment_id"] = $this->input->post('usr_email');
                $data['group_fee'] = str_replace( "%", "",$data['group_fee']);
||||||| .r91

                $data["usr_create_time"] = date("Y-m-d H:i:s");
                $data["id_gsettings"] = 1;
                $data["usr_email_status"] = 0;
                $data["employment_id"] = $this->input->post('usr_email');
                $data['group_fee'] = str_replace( "%", "",$data['group_fee']);
=======
        $data['channel_status'] = $this->input->post('channel_status', TRUE);
        $data['rate_status'] = $this->input->post('rate_status', TRUE); 
        $data['user_method_set'] = $this->input->post('user_method_set', TRUE);  
        $data['user_limit_set'] = $this->input->post('user_limit_set', TRUE);                       
     
        $data["usr_create_time"] = date("Y-m-d H:i:s");
        $data["id_gsettings"] = 1;
        $data["usr_email_status"] = 0;
        $data["employment_id"] = $this->input->post('usr_email');
        $data['group_fee'] = str_replace( "%", "",$data['group_fee']);
>>>>>>> .r94
        if (!empty($id)) {


        }else{

        $this->employee_model->_table_name = "tbl_employee"; //table name
        $this->employee_model->_order_by = "employee_id";
        $empinfo =  $this->employee_model->get_by(array('usr_email' => $this->input->post('usr_email', TRUE)), true);

        if (!empty($empinfo)) {
                $type = "error";
                $message = "该商户账户已存在。";
                set_message($type, $message);
                redirect('admin/employee/employee_list'); //redirect page
       }

        $this->employee_model->_table_name = "tbl_employee_group"; //table name
        $this->employee_model->_order_by = "id";
        $empinfo =  $this->employee_model->get_by(array('id' => $this->input->post('usr_gourp', TRUE)), true);
        //var_dump($empinfo);exit;
        $data['group_fee'] = $empinfo->group_fee;
        $data['group_up_fee'] = $empinfo->group_up_fee;
        $data['group_low_fee'] = $empinfo->group_low_fee;
        $data['group_amount'] = $empinfo->group_amount;
        $data['group_withdraw_time'] = $empinfo->group_withdraw_time;
        $data['online_limit'] = $empinfo->online_limit;
        $data['alipay_limit'] = $empinfo->alipay_limit;
        $data['wapalipay_limit'] = $empinfo->wapalipay_limit;
        $data['tenpay_limit'] = $empinfo->tenpay_limit;
        $data['weixin_limit'] = $empinfo->weixin_limit;

        $data['DAIFU'] = $empinfo->DAIFU;
        $data['WEIXINWAP'] = $empinfo->WEIXINWAP;
        $data['ALIPAYWAP'] = $empinfo->ALIPAYWAP;
        $data['ALIPAY'] = $empinfo->ALIPAY;
        $data['WEIXIN'] = $empinfo->WEIXIN;
        $data['TENPAY'] = $empinfo->TENPAY;
        $data['ONLINE'] = $empinfo->ONLINE;

        $data['channel_daifu'] = $empinfo->channel_daifu;
        $data['channel_wapweixin'] = $empinfo->channel_wapweixin;
        $data['channel_wapalipay'] = $empinfo->channel_wapalipay;
        $data['channel_alipay'] = $empinfo->channel_alipay;
        $data['channel_weixin'] = $empinfo->channel_weixin;
        $data['channel_tenpay'] = $empinfo->channel_tenpay;
        $data['channel_online'] = $empinfo->channel_online;
        $data['usr_amount'] = 0;

        }
        $this->employee_model->_table_name = "tbl_employee"; //table name
        $this->employee_model->_primary_key = "employee_id";
        $this->employee_model->save($data, $id);

            if (!empty($this->input->post('password'))) {
            $this->employee_model->_table_name = "tbl_employee"; //table name
            $this->employee_model->_order_by = "employee_id";
            $empinfo =  $this->employee_model->get_by(array('usr_email' => $this->input->post('usr_email', TRUE)), true);
                $data['id_gsettings'] = $this->session->userdata('id_gsettings');

                // save into tbl employee login
                $this->employee_model->_table_name = "tbl_employee_login"; // table name
                $this->employee_model->_primary_key = "employee_login_id"; // $id

                $ldata['employee_id'] = $empinfo->employee_id;
                $ldata['user_name'] = $empinfo->usr_email;

                $ldata['password'] = $this->hash($this->input->post('password'));

                $ldata['activate'] = 1 ;
                $check_existing_data = $this->employee_model->check_by(array('employee_id' => $id), 'tbl_employee_login');
                if (!empty($check_existing_data)) {
                    $this->employee_model->save($ldata, $check_existing_data->employee_login_id);
                } else {
                    $this->employee_model->save($ldata);
                }
            }

        // $verify = $this->input->post('emailverify');
        //     if (!$verify){
        //         if($this->sendEmail($this->input->post('usr_email'))){

        //         }else{
        //             $type = "error";
        //             $message = "失败了";
        //             set_message($type, $message);
        //             redirect('admin/employee/employee_list'); //redirect page
        //         }
        //     }


        $type = "success";
        $message = "商户信息成功保存！";
        set_message($type, $message);
        redirect('admin/employee/employee_list'); //redirect page




    }

  public  function sendEmail($to_email)
    {

        $this->employee_model->_table_name = "tbl_gsettings";// table name
        $this->employee_model->_order_by ="id_gsettings";
        $gsetting =  $this->employee_model->get_by(array('id_gsettings' => '1'), true);
        $from_email = $gsetting->smtp_user;
        $subject = '确认你的邮件地址';
        $message = '亲爱的 商户,<br /><br />请点击下面的激活链接验证您的电子邮件地址。<br /><br />'.base_url().'register/verify/' . md5($to_email).'<br /><a href="'.base_url().'register/verify/' . md5($to_email).'">点击这里</a><br /><br />谢谢您<br />168xypay.com 服务团队';
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $gsetting->smtpserver; //smtp host name
        $config['smtp_port'] = '25'; //smtp port number
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
	public function unique_qr_code($qrCodeValue){
			$qr_code_config = array();
			$qr_code_config['cacheable'] 	= $this->config->item('cacheable');
			$qr_code_config['cachedir'] 	= $this->config->item('cachedir');
			$qr_code_config['imagedir'] 	= $this->config->item('imagedir');
			$qr_code_config['errorlog'] 	= $this->config->item('errorlog');
			$qr_code_config['ciqrcodelib'] 	= $this->config->item('ciqrcodelib');
			$qr_code_config['quality'] 		= $this->config->item('quality');
			$qr_code_config['size'] 		= $this->config->item('size');
			$qr_code_config['black'] 		= $this->config->item('black');
			$qr_code_config['white'] 		= $this->config->item('white');

			$this->ci_qr_code->initialize($qr_code_config);

			$image_name = random_string('alnum',20).'.png';
			$params['data'] = $qrCodeValue;
			$params['level'] = 'L';
			$params['size'] = 4;
			$params['savename'] = FCPATH.$qr_code_config['imagedir'].$image_name;
			$this->ci_qr_code->generate($params);
			return $image_name;
		}

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    public function delete_employee($id, $bank_id, $doc_id) {

        $this->employee_model->_table_name = "tbl_employee"; // table name
        $this->employee_model->_primary_key = "employee_id"; // $id
        $this->employee_model->delete($id);
        // delete into tbl bank


        // delete into tbl employee login
        $this->employee_model->_table_name = "tbl_employee_login"; // table name
        $this->employee_model->_order_by = "employee_id"; // table name
        $this->employee_model->_primary_key = "employee_login_id"; // $id
        $login_id = $this->employee_model->get_by(array('employee_id'=> $id), TRUE);

        $this->employee_model->delete($login_id->employee_login_id);

        // messages for user
        $type = "success";
        $message = "商户信息成功删除！";
        set_message($type, $message);
        redirect('admin/employee/employee_list'); //redirect page
    }

    public function employee_list($id = NULL) {
        $data['title'] = "Employee List";
        $data['employee_id'] = $this->input->post('employee_id');
        $data['emp_email'] = $this->input->post('emp_email');
        $data['qq'] = $this->input->post('qq');
        $data['phone'] = $this->input->post('phone');
        $data['status'] = $this->input->post('status');
        $data['emp_group'] = $this->input->post('emp_group');
        $data['agent_id'] = $this->input->post('agent_id');
        $data['channel'] = $this->input->post('channel');
        $data['limit_mon'] = $this->input->post('limit_mon');

        $this->employee_model->_table_name = "tbl_employee_group"; //table name
        $this->employee_model->_order_by = "id";
        $data['all_group_info'] = $this->employee_model->get();

        $this->employee_model->_table_name = "tbl_channel"; // table name
        $this->employee_model->_order_by = 'id';
        $data['channel_info'] = $this->employee_model->get();

        $data['all_employee_info'] = $this->employee_model->all_emplyee_info();
        $data['subview'] = $this->load->view('admin/employee/employee_list', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function employee_list_pdf() {
        $data['title'] = "Employee List";
        $data['all_employee_info'] = $this->employee_model->all_emplyee_info();
        $this->load->helper('dompdf');
		//echo "<pre>";print_r($this->session->userdata('genaral_info'));print_r($this->session->userdata('id_gsettings'));die;
        $view_file = $this->load->view('admin/employee/employee_list_pdf', $data, true);
        pdf_create($view_file, 'Employee List');
    }

    public function view_employee($id = NULL) {
        $data['title'] = "Add Employee";
        //sod -b
        $data['id_gsettings'] = $this->session->userdata('id_gsettings');
        //sod - e

        if (!empty($id)) {// retrive data from db by id
            $data['ginfo'] = $this->employee_model->all_emplyee_info($id);
            if (!empty($data['ginfo']->usr_gourp)) {
                 $data['agentname'] = "employee".$data['ginfo']->usr_gourp;
            }
            //echo $query  = $this->db->last_query();
            if (empty($data['ginfo'])) {
                $type = "error";
                $message = "没有找到记录";
                set_message($type, $message);
                redirect('admin/employee/view_employee');
            }
        }

        // retrive all data from department table
        $this->employee_model->_table_name = "tbl_employee_group"; //table name
        $this->employee_model->_order_by = "id";
        $data['all_group_info'] = $this->employee_model->get();

        $this->employee_model->_table_name = "tbl_channel"; //table name
        $this->employee_model->_order_by = "id";
        $data['channel_info'] = $this->employee_model->get();

        $this->employee_model->_table_name = "tbl_channel_rate"; //table name
        $this->employee_model->_order_by = "id";
        $data['cinfo'] = $this->employee_model->get();

        $this->employee_model->_table_name = "tbl_proxy"; //table name
        $this->employee_model->_order_by = "proxy_id";
        $data['proxy_info'] = $this->employee_model->get();

        $data['sys_info'] = $this->employee_model->get_sytem_fee_info();

        $this->employee_model->_table_name = "tbl_card_type"; //table name
        $this->employee_model->_order_by = "pay_type_status";
        $data['all_bank'] = $this->employee_model->get();

        $data['subview'] = $this->load->view('admin/employee/view_employee', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

	public function view_employee_qr($id = NULL) {
        $data['title'] = "View Employee";
        if (!empty($id)) {// retrive data from db by id
            $data['employee_info'] = $this->employee_model->all_emplyee_info($id);
            if (empty($data['employee_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/employee/employee_list');
            }
        }
        $data['subview'] = $this->load->view('admin/employee/view_employee_qr', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function employee_group($id = NULL, $designations_id = NULL) {
        $data['title'] = "Employee List";
        // retrive all data from department table

            // get all employee info by designation id
            $this->employee_model->_table_name = 'tbl_employee_group';
            $this->employee_model->_order_by = 'id';
            $data['employee_info'] = $this->employee_model->get();


        $data['subview'] = $this->load->view('admin/employee/employee_group', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function add_employee_group($id = NULL) {
        $data['title'] = "Employee List";
        // retrive all data from department table
        $this->employee_model->_table_name = "tbl_employee_group"; // table name
        $this->employee_model->_order_by = 'id';
        $data['ginfo'] = $this->employee_model->get_by(array('id' => $id), TRUE);
            // get all employee info by designation id
        $this->employee_model->_table_name = 'tbl_channel';
        $this->employee_model->_order_by = 'id';
        $data['channel_info'] = $this->employee_model->get();

        $this->employee_model->_table_name = "tbl_channel_rate"; //table name
        $this->employee_model->_order_by = "id";
        $data['cinfo'] = $this->employee_model->get();

        $this->settings_model->_table_name = "tbl_sdl"; //table name
        $this->settings_model->_order_by = "id";
        $data['sys_info'] = $this->settings_model->get();
        //var_dump($data['sys_info']);
        if (!empty($id)) {
           $data['agentname'] = "employee".$id;
           $data['subview'] = $this->load->view('admin/employee/edit_employee_group', $data, TRUE);
        }else{
            $data['agentname'] = "dont";
            $data['subview'] = $this->load->view('admin/employee/add_employee_group', $data, TRUE);
        }
        $this->load->view('admin/_layout_main', $data);
    }

    public function save_employee_group($id = NULL) {
        $data = $this->settings_model->array_from_post(array('group_name', 'group_details', 'channel_online', 'channel_card', 'channel_alipay', 'channel_tenpay', 'channel_weixin', 'channel_wapalipay', 'channel_waptenpay', 'channel_wapqq', 'channel_wapweixin', 'channel_daifu', 'group_fee', 'group_up_fee', 'group_low_fee', 'group_amount', 'group_withdraw_time', 'online_limit', 'alipay_limit', 'wapalipay_limit', 'tenpay_limit', 'weixin_limit', 'user_limit_set'
            , 'ONLINE', 'TENPAY', 'ALIPAYWAP', 'WEIXIN', 'WEIXINWAP', 'ALIPAY', 'DAIFU', 'user_tixian_limit_set', 'user_rate_limit_set'));
        if ($this->input->post($value->order_url, TRUE)) {
           $data['order_url'] = $this->input->post($value->order_url, TRUE);
        }
        if ($this->input->post($value->xafa_name, TRUE)) {
           $data['xafa_name'] = $this->input->post($value->xafa_name, TRUE);
        }
        $data['group_fee'] = str_replace( "%", "",$data['group_fee']);
        if (empty($id)) {
            $this->employee_model->_table_name = "tbl_employee_group"; //table name
            $this->employee_model->_order_by = "id";
            $empinfo =  $this->employee_model->get_by(array('group_name' => $this->input->post('group_name', TRUE)), true);

            if (!empty($empinfo)) {
                    $type = "error";
                    $message = "该商户组已存在。";
                    set_message($type, $message);
                    redirect('admin/employee/employee_group'); //redirect page
           }
                $this->settings_model->_table_name = "tbl_sdl"; //table name
                $this->settings_model->_order_by = "id";
                $system_info = $this->settings_model->get();
           if (empty($data['group_fee'])) {

                foreach ($system_info as $system) {
                $data['group_fee'] = $system->fee;
                $data['group_up_fee'] = $system->max_sdl_value;
                $data['group_low_fee'] = $system->min_sdl_value;
                $data['group_amount'] = $system->payable_amount;
                $data['group_withdraw_time'] = $system->method;
                }
           }

           if (empty($data['online_limit'])) {

                foreach ($system_info as $system1) {
                $data['online_limit'] = $system1->limit_online;
                $data['alipay_limit'] = $system1->limit_alipay;
                $data['wapalipay_limit'] = $system1->limit_wap;
                $data['tenpay_limit'] = $system1->limit_financial;
                $data['weixin_limit'] = $system1->limit_credit;
                }
           }
        }
            $this->settings_model->_table_name = "tbl_employee_group"; // table name
            $this->settings_model->_primary_key = "id"; // $id
            $this->settings_model->save($data,$id);
                      // messages for user
            $this->settings_model->_table_name = "tbl_employee_group"; // table name
            $this->settings_model->_order_by = "id"; // $id
            $agentinfo = $this->settings_model->get_by(array('group_name' => $data['group_name']), TRUE);
            $agenttable = "employee".$agentinfo->id;
            $this->settings_model->rate_setting($agenttable, $id);

            $this->settings_model->_table_name = "tbl_channel_rate"; //table name
            $this->settings_model->_order_by = "id";
            $saveinfo = $this->settings_model->get();

            foreach ($saveinfo as $value) {
                $this->settings_model->_table_name = "tbl_channel_rate"; //table name
                $this->settings_model->_primary_key = "id";
                if (!empty($this->input->post($value->channel_code, TRUE))) {
                     $data_rate = $this->input->post($value->channel_code, TRUE);
                     if (empty($data_rate)) {
                        $dataw[$agenttable] = $value->cost_rate ;
                     }else{
                        $dataw[$agenttable] = $data_rate;
                     }

                    $this->settings_model->save($dataw,$value->id);
                }

            }
            if (!empty($this->input->post('ONLINE', TRUE))) {
            $this->settings_model->_table_name = "tbl_channel_rate"; //table name
            $this->settings_model->_primary_key = "use_online";
            $datal[$agenttable] = $this->input->post('ONLINE', TRUE);

            $this->settings_model->save($datal, 1);
            }
            $type = "success";
            $message = "通道费率设置成功更新！";
            set_message($type, $message);

            redirect('admin/employee/employee_group');
    }

    public function delete_employee_award($id = NULL) {

        $this->employee_model->_table_name = "tbl_employee_award"; // table name
        $this->employee_model->_primary_key = "employee_award_id"; // $id
        $this->employee_model->delete($id); // delete
        // messages for user
        $type = "success";
        $message = "Employee Award Information Successfully Delete !";
        set_message($type, $message);
        redirect('admin/employee/employee_award'); //redirect page
    }

    public function make_pdf($employee_id) {
        $data['title'] = "Employee List";
        $data['employee_info'] = $this->employee_model->all_emplyee_info($employee_id);
        $this->load->helper('dompdf');
        $view_file = $this->load->view('admin/employee/employee_view_pdf', $data, true);
        pdf_create($view_file, $data['employee_info']->first_name);
    }


	/*-------------------------------JITENDRA WORK---------------------------*/


	public function export_csv()
	{
		    $file_name = "employee";
	        $this->load->helper('file');
	        $this->load->helper('download');
			$data = $this->employee_model->export_employee();
	        force_download($file_name.'-'.date("M-Y").'.csv', $data);
	}


	public function employee_by_csv($id = NULL) {
        $data['title'] = "Add Employee by CSV";
        $data['subview'] = $this->load->view('admin/employee/employee_by_csv', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

	function upload_csv()
	{


		$this->form_validation->set_rules('userfile', $this->language->from_body()[27][1], 'xss_clean');

		if ($this->form_validation->run() == true)
		{

		if ( isset($_FILES["userfile"])) /*if($_FILES['userfile']['size'] > 0)*/
		{

				//echo pathinfo($_FILES["userfile"]['name'], PATHINFO_EXTENSION);die;
		$this->load->library('upload');

		$config['upload_path'] = 'asset/upload/csv/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '2000';
		$config['overwrite'] = TRUE;

			$this->upload->initialize($config);

			if( ! $this->upload->do_upload()){
				$error = $this->upload->display_errors();
				$type = "error";
		        set_message($type, $error);
		        redirect('admin/employee/employee_by_csv');
			}

		$csv = $this->upload->file_name;

		$arrResult = array();
			$handle = fopen("asset/upload/csv/".$csv, "r");
			if( $handle ) {
			while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
				//$row['id_gsettings'] = $this->session->user_data('id_gsettings');
			$arrResult[] = $row;
			}
			fclose($handle);
			}
			$titles = array_shift($arrResult);

			$keys = array('employment_id', 'first_name', 'last_name', 'date_of_birth', 'gender', 'maratial_status', 'father_name', 'nationality',
			//'nric_no',
			'passport_number','present_address', 'city', 'country_id', 'mobile','phone', 'email', 'joining_date',);

			$final = array();

					foreach ( $arrResult as $key => $value ) {
								$final[] = array_combine($keys, $value);
					}

			$rw=2;
			foreach($final as $csv_pr) {
				//print_r($csv_pr);die;
				if($this->employee_model->getEmployeeByEmail($csv_pr['email'])) {
						set_message('error',$this->language->from_body()[5][0] . " (".$csv_pr['email']."). ".$this->language->from_body()[27][6]." ".$this->language->from_body()[27][7]." ".$rw);
						redirect('admin/employee/employee_by_csv');
				}

				if($this->employee_model->getEmpByEmploymentId($csv_pr['employment_id'])) {
						set_message('error','Employment id' . " (".$csv_pr['employment_id']."). ".$this->language->from_body()[27][6]." ".$this->language->from_body()[27][7]." ".$rw);
						redirect('admin/employee/employee_by_csv');
				}
				$fg = $this->employee_model->getEmpByEmploymentId($csv_pr['employment_id']);
				if(empty($fg)){
				    $country = $this->employee_model->getCountryByName($csv_pr['country_id']);
					$nationality = $this->employee_model->getCountryByName($csv_pr['nationality']);
					$em_id[] = $csv_pr['employment_id'];
					$em_fname[] = $csv_pr['first_name'];
					$em_lname[] = $csv_pr['last_name'];
					$em_date_of_birth[] = date("Y-m-d",strtotime($csv_pr['date_of_birth']));
					$em_gender[] = $csv_pr['gender'];
					$em_maratial_status[] = $csv_pr['maratial_status'];
					$em_father_name[] = $csv_pr['father_name'];
					$em_nationality[] = $nationality->idCountry;
					//$em_nric_no[] = $csv_pr['nric_no'];
					$em_passport_number[] = $csv_pr['passport_number'];
					$em_present_address[] = $csv_pr['present_address'];
					$em_city[] = $csv_pr['city'];
					$em_country[] = $country->idCountry;
					$em_mobile[] = $csv_pr['mobile'];
					$em_phone[] = $csv_pr['phone'];
					$em_email[] = $csv_pr['email'];
					$em_joining_date[] = date("Y-m-d",strtotime($csv_pr['joining_date']));
					//$id_gsettings[] = $this->session->user_data("id_gsettings");


				} else {
					set_message('error', $this->language->from_body()[6][5]." (".$csv_pr['country']."). ".$this->language->from_body()[27][8]." ".$this->language->from_body()[27][7]." ".$rw);
					redirect('admin/employee/employee_by_csv');
				}
			$rw++;
			}
		}

		$ikeys = array('employment_id', 'first_name', 'last_name', 'date_of_birth', 'gender', 'maratial_status', 'father_name', 'nationality',
		//'nric_no',
		'passport_number','present_address', 'city', 'country_id', 'mobile','phone', 'email', 'joining_date');

				$items = array();
				foreach ( array_map(null, $em_id, $em_fname, $em_lname, $em_date_of_birth, $em_gender, $em_maratial_status, $em_father_name, $em_nationality,
				//$em_nric_no,
				$em_passport_number,$em_present_address, $em_city, $em_country, $em_mobile, $em_phone, $em_email, $em_joining_date) as $ikey => $value ) {
					$items[] = array_combine($ikeys, $value);
				}

		$final = $this->mres($items);
		//$data['final'] = $final;

		}

		if ( $this->form_validation->run() == true && $employeeIds = $this->employee_model->add_employee($final))
		{
			  // save into tbl employee login
		        $this->employee_model->_table_name = "tbl_employee_login"; // table name
		        $this->employee_model->_primary_key = "employee_login_id"; // $id
		        // check employee login details exsist or not
		        // if existing do not save
		        // else save the login details

		     foreach($employeeIds as $k => $empId){

			        $check_existing = $this->employee_model->check_by(array('employee_id' => $empId), 'tbl_employee_login');
			        $logdata['employee_id'] = $empId;
			        $logdata['user_name'] = $final[$k]['employment_id'];
			        $logdata['password'] = $this->hash('employee');
			        $logdata['activate'] = '1';
			        if (empty($check_existing)) {
			            $this->employee_model->save($logdata);
			        }
		        }
			    $type = "success";
		        $message = "Employee Information Successfully Saved!";
		        set_message($type, $message);
		        redirect('admin/employee/employee_list');
		}
		else
		{

			$data['message'] = validation_errors() ;

			$data['userfile'] = array('name' => 'userfile',
				'id' => 'userfile',
				'type' => 'text',
				'value' => $this->form_validation->set_value('userfile')
			);

		 $data['title'] = "Add Employee by CSV";
		$data['subview'] = $this->load->view('admin/employee/employee_by_csv', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);

		}
	}

    public function delete_employee_group($id = NULL) {

        $this->employee_model->_table_name = "tbl_employee_group"; // table name
        $this->employee_model->_primary_key = "id"; // $id
        $this->employee_model->delete($id); // delete
        // messages for user
        $type = "success";
        $message = "!";
        set_message($type, $message);
        redirect('admin/employee/employee_group'); //redirect page
    }



	/*kajal employee entitlement*/
	public function employee_entitlement($id = NULL, $designations_id = NULL) {
        $data['title'] = "Employee List";

		$this->employee_model->_table_name = "tbl_user_type"; //table name
        $this->employee_model->_order_by = "user_type_id";
		$where = array(
			'id_gsettings' => $this->session->userdata('id_gsettings')
		);
        $data['user_type_info'] = $this->employee_model->get_by($where);


		$this->employee_model->_table_name = "tbl_leave_category"; //table name
        $this->employee_model->_order_by = "leave_category_id";

        // retrive data from db by id

        // retrive all data from db
        $data['all_leave_category_info'] = $this->employee_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));

        // retrive all data from department table
        $this->employee_model->_table_name = "tbl_department"; //table name
        $this->employee_model->_order_by = "department_id";
        $all_dept_info = $this->employee_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
        // get all department info and designation info
        foreach ($all_dept_info as $v_dept_info) {
            $data['all_department_info'][$v_dept_info->department_name] = $this->employee_model->get_add_department_by_id($v_dept_info->department_id);
        }
        /// edit and update get employee award info
        if (!empty($id)) {
            $data['entitlement_info'] = $this->employee_model->get_employee_entitlement_by_id($id);

            // get all employee info by designation id
            $this->employee_model->_table_name = 'tbl_employee';
            $this->employee_model->_order_by = 'designations_id';
            $data['employee_info'] = $this->employee_model->get_by(array('designations_id' => $designations_id), FALSE);
        }
        // get all_employee_award_info
        $data['all_employee_entitlement_info'] = $this->employee_model->get_employee_entitlement_by_id();

		//echo $que = $this->db->last_query();die;
        $data['subview'] = $this->load->view('admin/employee/employee_entitlement', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }


	 public function delete_employee_entitlement($id = NULL) {

        $this->employee_model->_table_name = "tbl_employee_entitlement"; // table name
        $this->employee_model->_primary_key = "employee_entitlement_id"; // $id
        $this->employee_model->delete($id); // delete
        // messages for user
        $type = "success";
        $message = "Employee Entitlement Information Successfully Delete !";
        set_message($type, $message);
        redirect('admin/employee/employee_entitlement'); //redirect page
    }

	public function save_employee_entitlement($id = NULL) {


		$this->employee_model->_table_name = "tbl_employee_entitlement"; // table name
		$this->employee_model->_order_by = 'employee_entitlement_id';

		$employee_id  = $this->input->post('employee_id', TRUE);
		$leave_category_id  = $this->input->post('leave_category_id', TRUE);
		$leave_periods  = $this->input->post('leave_periods', TRUE);

		$data['entitlement_exits_record'] = $this->employee_model->get_exist_employee_entitlement_by_id($employee_id, $leave_category_id, $leave_periods);

		if(!empty($data['entitlement_exits_record']))
		{
			$type = "error";
			$message = "Employee Entitlement Information Already Exits";
		}
		else
		{
			$data = $this->employee_model->array_from_post(array('employee_id', 'leave_category_id', 'leave_periods', 'leave_days'));
			$data['id_gsettings'] = $this->session->userdata('id_gsettings');
			$this->employee_model->_table_name = "tbl_employee_entitlement"; // table name
			$this->employee_model->_primary_key = "employee_entitlement_id"; // $id
			$this->employee_model->save($data, $id);
			// messages for user
			$type = "success";
			$message = "Employee Entitlement Information Successfully Saved!";
		}


        set_message($type, $message);
        redirect('admin/employee/employee_entitlement'); //redirect page
    }


	function mres($q) {
		if(is_array($q))
			foreach($q as $k => $v)
				$q[$k] = $this->mres($v); //recursive
		elseif(is_string($q))
			$q = mysql_real_escape_string($q);
		return $q;
	}


	/*------------------------------------------------------Sarps Mansi------------------------------------------------------------*/
 public function emp_job_letters_list(){
	 $data['title'] = "Employee List";
	 $data['jobletter_list']=$this->employee_model->get_Allrecord('tbl_job_letters');
	 //print_r($data['jobletter_list']);die;
	 $data['subview'] = $this->load->view('admin/employee/emp_join_letter_list', $data, TRUE);
	 $this->load->view('admin/_layout_main', $data);

 }

 public function convert_active($id){
	 $res=$this->employee_model->change_intoactive($id);
	redirect('admin/employee/emp_job_letters_list'); //redirect page
 }
 public function convert_inactive($id){
	 $res=$this->employee_model->change_intoinactive($id);
	redirect('admin/employee/emp_job_letters_list'); //redirect page
 }

 public function edit_employee($id){
	$data['employee_info']=$this->db->get_where('tbl_job_letters',array('id'=>$id))->row();
	$data['subview'] = $this->load->view('admin/employee/edit_joining_letter', $data, TRUE);
	 $this->load->view('admin/_layout_main', $data);


 }
 public function insert_employee(){
	 $uparray=array('name'=>$this->input->post('name'),
	 'address'=>$this->input->post('address'),
	 'joining_date'=>$this->input->post('joining_date'),
	 'salary'=>$this->input->post('salary'));
	 $res=$this->db->insert('tbl_job_letters',$uparray);
	 if($res==1){
		 $type = "success";
	$message = "Employee Entitlement Information Successfully Saved!";
	 }else{
		$type = "error";
			$message = "Employee Entitlement Information Already Exits";
	 }
	 redirect('admin/employee/emp_job_letters_list'); //redirect page
 }
 public function update_employee(){
	 $uparray=array('name'=>$this->input->post('name'),
	 'address'=>$this->input->post('address'),
	 'joining_date'=>$this->input->post('joining_date'),
	 'salary'=>$this->input->post('salary'));
	 $res=$this->db->update('tbl_job_letters',$uparray,array('id'=>$this->input->post('emp_id')));
	 if($res==1){
		 $type = "success";
	$message = "Joining Letter Updated!";
	 }else{
		$type = "error";
			$message = "Error in Updation Joining Letter.";
	 }
	 redirect('admin/employee/emp_job_letters_list'); //redirect page
 }
  public function make_pdf_join($employee_id) {
	  //echo $employee
        $data['title'] = "Joining Letter";
        $data['employee_info'] = $this->employee_model->getWhereRecord('tbl_job_letters',array('id'=>$employee_id));
        $this->load->helper('dompdf');
        $view_file = $this->load->view('admin/employee/joining_letter_pdf', $data, true);
		$title=strtotime("now")."_".rand();
        $res=pdf_create($view_file,'Joining Letter_'.$title);



    }
}
