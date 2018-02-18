<?php

class Login_Model extends MY_Model {

    protected $_table_name;
    protected $_order_by;
    public $rules = array(
        'user_name' => array(
            'field' => 'user_name',
            'label' => 'User Name',
            'rules' => 'trim|required|xss_clean'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        )
    );

    public function login() {
         //check user type
        $this->_table_name = 'tbl_user';
        $this->_order_by = 'user_id';
        //echo $this->hash($this->input->post('password')); die();
        $admin = $this->get_by(array(
            'user_name' => $this->input->post('user_name'),
            'password' => $this->hash($this->input->post('password'))
                ), TRUE);
        if ($admin) {
            $data = array(
                'user_name' => $admin->user_name,
                'first_name' => $admin->first_name,
                'last_name' => $admin->last_name,
                'employee_id' => $admin->user_id,
                'id_gsettings' => $admin->id_gsettings,
                'employee_login_id' => $admin->user_id,
                'loggedin' => TRUE,
                //'user_type' => 1,
                'user_type' => $admin->user_type_id,
                //'user_flag' => $admin->flag,
                'user_flag' => 1,
                'url' => 'admin/dashboard',
            );
            $this->session->set_userdata($data); //@sunny
            return $data;
        } else {
            $employee_user_name = $this->input->post('user_name');
            $id_gsettings = 1;
            $this->_table_name = 'tbl_gsettings';
            $this->_order_by = 'id_gsettings';
            $gsettings = $this->get_by(array(
                'id_gsettings' => $id_gsettings,
            ), TRUE);
            if(!empty($gsettings)) {
                $config['hostname'] = $gsettings->database_host;
                $config['username'] = $gsettings->database_user_name;
                $config['password'] = $gsettings->database_user_password;
                $config['database'] = $gsettings->database_name;
                $config['dbdriver'] = "mysql";
                $config['dbprefix'] = "";
                $config['pconnect'] = FALSE;
                $config['db_debug'] = TRUE;
                $config['cache_on'] = FALSE;
                $config['cachedir'] = "";
                $config['char_set'] = "utf8";
                $config['dbcollat'] = "utf8_general_ci";
                $this->db = $this->load->database($config, TRUE);
            }
            //sua o day - end

            $this->_table_name = 'tbl_employee';
            $this->_order_by = 'employee_id';
            $employee_data1 = $this->get_by(array(
                'employment_id' => $employee_user_name,
                'usr_status' => '1',
            ), TRUE);
            $employee_data2 = $this->get_by(array(
                'employment_id' => $employee_user_name,
                'usr_status' => '0',
            ), TRUE);
            if(count($employee_data1)||count($employee_data2)){



            $this->_table_name = 'tbl_employee_login';
            $this->_order_by = 'employee_login_id';
            $employee = $this->get_by(array(
                'user_name' => $employee_user_name,
                'password' => $this->hash($this->input->post('password')),
                'activate' => 1
            ), TRUE);

            if (count($employee)) {
                // Log in user
                $employee_id = $employee->employee_id;
                $this->_table_name = "tbl_employee"; //table name
                $this->_order_by = "employee_id";
                $user_info = $this->get_by(array('employee_id' => $employee_id), TRUE);
                $ip = $this->getUserIP();
                $data = array(
                    'name' => $employee->user_name,
                    'employee_id' => $employee->employee_id,
                    'user_name' => $user_info->first_name . '  ' . $user_info->last_name,
                    'photo' => $user_info->photo,
                    'employee_login_id' => $employee->employee_login_id,
                    'loggedin' => TRUE,
                    'user_type' => 2,
                    'url' => 'employee/dashboard',
                    'ip' => $ip,
                    'login_time' => date("Y-m-d h:i:s"),
                );
                $this->_table_name = 'tbl_log'; //table name
                $this->_order_by = 'employee_id';
                $data_log = array(
                    'employee_id' => $employee_id,
                    'ip' => $ip,
                    'login_time' => date("Y-m-d h:i:s"),
                    'login_status' => '1',
                );
                $this->save($data_log);
                return $data;
               $this->session->set_userdata($data); //@sunny
            } else {
                $employee_user_name = $this->input->post('user_name');
                $this->_table_name = 'tbl_gsettings';
                $this->_order_by = 'id_gsettings';
                $gsettings = $this->get_by(array(
                        'id_gsettings' => $id_gsettings,
                        ), TRUE);
                        if(!empty($gsettings)) {
                            $config['hostname'] = $gsettings->database_host;
                            $config['username'] = $gsettings->database_user_name;
                            $config['password'] = $gsettings->database_user_password;
                            $config['database'] = $gsettings->database_name;
                            $config['dbdriver'] = "mysql";
                            $config['dbprefix'] = "";
                            $config['pconnect'] = FALSE;
                            $config['db_debug'] = TRUE;
                            $config['cache_on'] = FALSE;
                            $config['cachedir'] = "";
                            $config['char_set'] = "utf8";
                            $config['dbcollat'] = "utf8_general_ci";
                            $this->db = $this->load->database($config, TRUE);
                        }
                    $this->_table_name = 'tbl_employee_login';
                    $this->_order_by = 'employee_login_id';
                    $employee = $this->get_by(array(
                        'user_name' => $employee_user_name,
                        'password' => $this->hash($this->input->post('password')),
                        'activate' => 0
                    ), TRUE);
                if (count($employee)) {
                    // Log in user
                    $employee_id = $employee->employee_id;
                    $this->_table_name = "tbl_employee"; //table name
                    $this->_order_by = "employee_id";
                    $user_info = $this->get_by(array('employee_id' => $employee_id), TRUE);
                    $data = array(
                        'name' => $employee->employment_id,
                        'employee_id' => $employee->employee_id,
                        'user_name' => $user_info->first_name . '  ' . $user_info->last_name,
                        'photo' => $user_info->photo,
                        'employee_login_id' => $employee->employee_login_id,
                        'loggedin' => TRUE,
                        'user_type' => 2,
                        'url' => 'employee/dashboard',
                    );
                        $this->_table_name = "tbl_log"; //table name
                        $this->_order_by = "employee_id";
                        $data_log = array(
                            'employee_id'=>$employee_id,
                            'ip'=>$this->getUserIP(),
                            'login_time'=>date("Y-m-d h:i:s"),
                            'login_status'=>'1',

                        );
                       $this->save($data_log);
                       $this->session->set_userdata($data); //@sunny
                       return $data;

            }else {
                    ///////////////////////////////////////////////////////////
                    $employee_user_name = $this->input->post('user_name');
                    $this->_table_name = 'tbl_gsettings';
                    $this->_order_by = 'id_gsettings';
                    $gsettings = $this->get_by(array(
                        'id_gsettings' => $id_gsettings,
                    ), TRUE);
                    if (!empty($gsettings)) {
                        $config['hostname'] = $gsettings->database_host;
                        $config['username'] = $gsettings->database_user_name;
                        $config['password'] = $gsettings->database_user_password;
                        $config['database'] = $gsettings->database_name;
                        $config['dbdriver'] = "mysql";
                        $config['dbprefix'] = "";
                        $config['pconnect'] = FALSE;
                        $config['db_debug'] = TRUE;
                        $config['cache_on'] = FALSE;
                        $config['cachedir'] = "";
                        $config['char_set'] = "utf8";
                        $config['dbcollat'] = "utf8_general_ci";
                        $this->db = $this->load->database($config, TRUE);
                    }
                    //sua o day - end
                    $employee_user_name = $this->input->post('user_name');
                    $this->_table_name = 'tbl_employee_login';
                    $this->_order_by = 'employee_login_id';
                    $employee = $this->get_by(array(
                        'user_name' => $employee_user_name,
                        'password' => $this->hash($this->input->post('password')),
                        'activate' => 2
                    ), TRUE);
                    if (count($employee)) {
                        // Log in user
                        $employee_id = $employee->employee_id;
                        $this->_table_name = "tbl_employee"; //table name
                        $this->_order_by = "employee_id";
                        $user_info = $this->get_by(array('employee_id' => $employee_id), TRUE);
                        $data = array(
                            'name' => $employee->employment_id,
                            'employee_id' => $employee->employee_id,
                            'user_name' => $user_info->first_name . '  ' . $user_info->last_name,
                            'photo' => $user_info->photo,
                            'employee_login_id' => $employee->employee_login_id,
                            'loggedin' => TRUE,
                            'user_type' => 2,
                            'url' => 'employee/dashboard',
                        );
                        $this->_table_name = "tbl_log"; //table name
                        $this->_order_by = "employee_id";
                        $data_log = array(
                            'employee_id' => $employee_id,
                            'ip' => $this->getUserIP(),
                            'login_time' => date("Y-m-d h:i:s"),
                            'login_status' => '1',

                        );
                        $this->save($data_log);
                        // $data['employee_status'] = 0;
                        $this->session->set_userdata($data);
                        $this->loggedin();
                        return $data;
                        // $this->session->set_userdata($data); //@sunny
                    } else {

                              $proxy_name = $this->input->post('user_name');
                              $this->_table_name = 'tbl_proxy';
                              $this->_order_by = 'proxy_id';
                              $proxy = $this->get_by(array(
                                'mail_address' => $proxy_name,'proxy_password' =>$this->hash($this->input->post('password')),'proxy_state' => 2
                            ), TRUE);
                            if(count($proxy)){
                                $proxy_number = $proxy->mail_address;
                                $data = array(
                                    'proxy_email' => $proxy->mail_address,
                                    'proxy_id' => $proxy->proxy_id,
                                    'loggedin' => TRUE,
                                    'user_type' => 3,
                                    'url' => 'agent/dashboard',
                                );

                                $data['employee_status'] = 0;
                                $this->session->set_userdata($data);
                                $this->loggedin();
                                return $data;
                            }
                        }


            }
            }
                //end
            }
        }

        // return $this->loggedin(); //@sunny
    }


    //@sunny for check member plan expired 09/07/2016 strats here
    public function is_member_plan_expired($data) {
        //check user type

        $this->_table_name = 'tbl_user';
        $this->_order_by = 'user_id';

        $admin = $this->get_by(array(
            'user_name' => $this->input->post('user_name'),
            'password' => $this->hash($this->input->post('password')),
            'status' => 1
                ), TRUE);
        if ($admin) {

                $this->session->set_userdata($data);
                return $this->loggedin();

        } else {

            $this->_table_name = 'tbl_employee_login';
            $this->_order_by = 'employee_login_id';
            $employee = $this->get_by(array(
                'user_name' => $this->input->post('user_name'),
                'password' => $this->hash($this->input->post('password')),
                'activate' => 1
                    ), TRUE);
            if (count($employee)) {
                // Log in user
                $employee_id = $employee->employee_id;
                $this->_table_name = "tbl_employee"; //table name
                $this->_order_by = "employee_id";
                $user_info = $this->get_by(array('employee_id' => $employee_id), TRUE);


                        $data['employee_status'] = 0;
                        $this->session->set_userdata($data);
                        return $this->loggedin();


            }else{
                $this->_table_name = 'tbl_employee_login';
                $this->_order_by = 'employee_login_id';
                $employee = $this->get_by(array(
                'user_name' => $this->input->post('user_name'),
                'password' => $this->hash($this->input->post('password')),
                'activate' => 2
                    ), TRUE);
            if (count($employee)) {
                // Log in user
                $employee_id = $employee->employee_id;
                $this->_table_name = "tbl_employee"; //table name
                $this->_order_by = "employee_id";
                $user_info = $this->get_by(array('employee_id' => $employee_id), TRUE);


                $this->_table_name = 'tbl_user';
                $this->_order_by = 'user_id';

                $admin = $this->get_by(array(
                    'id_gsettings' => $user_info->id_gsettings,
                    'status' => 1
                        ), TRUE);


                        //return true;
                        $data['employee_status'] = 2;
                        $this->session->set_userdata($data);
                        return $this->loggedin();

            }else{


                ///////////////
                //start
                $this->_table_name = 'tbl_employee_login';
                $this->_order_by = 'employee_login_id';
                $employee = $this->get_by(array(
                    'user_name' => $this->input->post('user_name'),
                    'password' => $this->hash($this->input->post('password')),
                    'activate' => 0
                        ), TRUE);
                $employee_id = $employee->employee_id;
                $this->_table_name = "tbl_employee"; //table name
                $this->_order_by = "employee_id";
                $user_info = $this->get_by(array('employee_id' => $employee_id), TRUE);

                         $data['employee_status'] = 1;
                        $this->session->set_userdata($data);
                        return $this->loggedin();

            }

            }
        }

        return false;
    }
    //@sunny for check member plan expired 09/07/2016 ends here


    public function logout() {
        $this->session->sess_destroy();
    }

    public function loggedin() {
        return (bool) $this->session->userdata('loggedin');
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
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
   public function getlocation($ip){
        $json  = file_get_contents("https://freegeoip.net/json/$ip");
        $json  =  json_decode($json ,true);
        $country =  $json['country_name'];
        $region= $json['region_name'];
        $city = $json['city'];
        return $country.$region.$city;
   }

}
