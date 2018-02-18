<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Proxy extends Admin_Controller {

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

    public function listitem() {
        $data['title'] = "Proxy"; //Page title

        $data['employee_id'] = $this->input->post('employee_id');
        $data['emp_email'] = $this->input->post('emp_email');
        $data['qq'] = $this->input->post('qq');
        $data['phone'] = $this->input->post('phone');
        $data['status'] = $this->input->post('status');


        $data['all_proxy'] = $this->settings_model->get_all_agent();
        $data['subview'] = $this->load->view('admin/proxy/proxy_list', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

        public function add_proxy($val = NULL) {
            $data['title'] = " Add a proxy"; //Page title
            if (!empty($val)) {
            $this->settings_model->_table_name = "tbl_proxy"; //table name
            $this->settings_model->_order_by = "proxy_id";
            $data['ginfo'] = $this->settings_model->get_by(array('proxy_id' => $val), TRUE);
            }

        $data['all_bank'] = $this->settings_model->bankinfo(); 

        $this->settings_model->_table_name = "tbl_agent_group"; //table name
        $this->settings_model->_order_by = "id";
        $data['agent_group'] = $this->settings_model->get();

            $data['subview'] = $this->load->view('admin/proxy/add_proxy', $data, TRUE);
            $this->load->view('admin/_layout_main', $data); //page load
        }

        public function add_agent_group($val = NULL) {
            $data['title'] = " Add a agent group"; //Page title
            $this->settings_model->_table_name = "tbl_agent_group"; //table name
            $this->settings_model->_order_by = "id";
            $data['ginfo'] = $this->settings_model->get_by(array('id' => $val), TRUE);

            $this->settings_model->_table_name = "tbl_channel_rate"; //table name
            $this->settings_model->_order_by = "id";
            $data['cinfo'] = $this->settings_model->get();

            $this->settings_model->_table_name = "tbl_sdl"; //table name
            $this->settings_model->_order_by = "id";
            $data['sys_info'] = $this->settings_model->get();            
            
            if($val){
                $data['subview'] = $this->load->view('admin/proxy/edit_agent_group', $data, TRUE);
            }else{
                $data['subview'] = $this->load->view('admin/proxy/add_agent_group', $data, TRUE);
            }
            
            $this->load->view('admin/_layout_main', $data); //page load
        }

        public function manage_agent_group($val = NULL) {
            $data['title'] = " Agent group management"; //Page title

            $this->settings_model->_table_name = "tbl_agent_group"; //table name
            $this->settings_model->_order_by = "id";
            $data['agent_group'] = $this->settings_model->get();

            $data['subview'] = $this->load->view('admin/proxy/manage_agent_group', $data, TRUE);
            $this->load->view('admin/_layout_main', $data); //page load
        }

        public function save_data($id = NULL) {



            $data = $this->settings_model->array_from_post(array('mail_address', 'agent_group', 'proxy_state', 'contact_person', 'contact_number', 'qq_num', 'open_an_account_bank', 'bank_of_the_province_where_the_bank', 'account_area', 'bank_name', 'bank_card_number', 'account_name'));
            if (empty($id)) {
                $data['proxy_password'] = $this->hash($this->input->post('proxy_password'));
                $data['account_amount'] = 0;
            }elseif (!empty($this->input->post('proxy_password'))) {
               $data['proxy_password'] = $this->hash($this->input->post('proxy_password'));
            } 
            $data['registration_time'] = date("Y-m-d H:i:s");          
            if (empty($data['proxy_state'])) {
                $data['proxy_state'] = 1;
            }

            if (empty($id)) {
                    $this->settings_model->_table_name = "tbl_proxy"; //table name
                    $this->settings_model->_order_by = "proxy_id";
                    $empinfo =  $this->settings_model->get_by(array('mail_address' => $this->input->post('mail_address', TRUE)), true); 
                    
                    if (!empty($empinfo)) {
                            $type = "error";
                            $message = "该代理账户已存在。";
                            set_message($type, $message);
                            redirect('admin/proxy/listitem'); //redirect page     
                   }
            }
            $this->settings_model->_table_name = "tbl_proxy"; // table name
            $this->settings_model->_primary_key = "proxy_id"; // $id                    
            $this->settings_model->save($data,$id);            // messages for user

            redirect('admin/proxy/listitem');
        }

        public function save_agent_group($id = NULL) {
            //var_dump($_POST);exit;
            $data = $this->settings_model->array_from_post(array('agent_group_name', 'remarks', 'low_with_amount', 'fee_low_limit', 'fee_limit', 'default_rate', 'mode'
                , 'ONLINE', 'TENPAY', 'ALIPAYWAP', 'WEIXIN', 'WEIXINWAP', 'ALIPAY', 'DAIFU', 'agent_limit_set', 'agent_tixian_set'));    
            $data['default_rate'] = str_replace( "%", "",$data['default_rate']);
            if (empty($id)) {
                    $this->settings_model->_table_name = "tbl_agent_group"; //table name
                    $this->settings_model->_order_by = "id";
                    $empinfo =  $this->settings_model->get_by(array('agent_group_name' => $this->input->post('agent_group_name', TRUE)), true); 
                    
                    if (!empty($empinfo)) {
                            $type = "error";
                            $message = "该代理组已存在。";
                            set_message($type, $message);
                            redirect('admin/proxy/manage_agent_group'); //redirect page     
                   } 
                $this->settings_model->_table_name = "tbl_sdl"; //table name
                $this->settings_model->_order_by = "id";
                $system_info = $this->settings_model->get(); 
                
           if (empty($data['low_with_amount'])) {
                foreach ($system_info as $system) {
                    $data['default_rate'] = $system->fee;
                    $data['fee_limit'] = $system->max_sdl_value;
                    $data['fee_low_limit'] = $system->min_sdl_value;
                    $data['low_with_amount'] = $system->payable_amount;
                    $data['mode'] = $system->method;
                }
           }  

     }


            $this->settings_model->_table_name = "tbl_agent_group"; // table name
            $this->settings_model->_primary_key = "id"; // $id            
            $this->settings_model->save($data,$id);  
                      // messages for user
            $this->settings_model->_table_name = "tbl_agent_group"; // table name
            $this->settings_model->_order_by = "id"; // $id
            $agentinfo = $this->settings_model->get_by(array('agent_group_name' => $data['agent_group_name']), TRUE);
            $agenttable = "agent".$agentinfo->id;
            $this->settings_model->rate_setting($agenttable, $id);

            $this->settings_model->_table_name = "tbl_channel_rate"; //table name
            $this->settings_model->_order_by = "id";
            $saveinfo = $this->settings_model->get();  

            foreach ($saveinfo as $value) {
                $this->settings_model->_table_name = "tbl_channel_rate"; //table name
                $this->settings_model->_primary_key = "id";
                if (!empty($this->input->post($value->channel_code, TRUE))) {
                    $dataw[$agenttable] = $this->input->post($value->channel_code, TRUE);
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

            redirect('admin/proxy/manage_agent_group');
        }        

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }        

    public function delete_proxy($id) { // delete holiday list by id
        $this->settings_model->_table_name = "tbl_proxy"; //table name
        $this->settings_model->_primary_key = "proxy_id";    //id
        $this->settings_model->delete($id);
        $type = "success";
        $message = "代理信息成功删除！";
        set_message($type, $message);
        redirect('admin/proxy/listitem'); //redirect page
    }

    public function delete_agent_group($id) { // delete holiday list by id
        $this->settings_model->_table_name = "tbl_agent_group"; //table name
        $this->settings_model->_primary_key = "id";    //id
        $this->settings_model->delete($id);
        $agenttable = "agent".$id;
        $this->settings_model->rate_setting($agenttable, $id);
        $type = "success";
        $message = "代理信息成功删除！";
        set_message($type, $message);
        redirect('admin/proxy/manage_agent_group'); //redirect page
    }    
}
