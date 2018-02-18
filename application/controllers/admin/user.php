<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        // $this->load->library('encryption');
    }
	
	public function create_user($id = null)
	{
		if (!empty($id)) {
            $data['user_id'] = $id;
        } else {
            $data['user_id'] = null;
        }
		
		$data['title'] = "Create User";
 
		if($this->session->userdata('user_type') == 1)
		{
			$this->user_model->_table_name = "tbl_menu"; //table name
			$this->user_model->_order_by = "menu_id";
			
			$menu_info = $this->user_model->get();
		}
		else
		{
			
			$menu_info = $this->global_model->select_user_roll($id);
		}
		
        
		foreach ($menu_info as $items) {
            $menu['parents'][$items->parent][] = $items;
        }
        $data['result'] = $this->buildChild(0, $menu);
		 
		$this->user_model->_table_name = "tbl_user"; //table name
        $this->user_model->_order_by = "user_id";
		
		$where = array(
			'user_id' => $data['user_id'],
			'id_gsettings' => $this->session->userdata('id_gsettings')
		);
        $data['user_type_detail'] = $this->user_model->get_by($where, TRUE);
		//print_r($data['user_type_info']);
		//echo $password = $this->encryption->decrypt($data['user_type_detail']->password);
		//die();
		$this->db->last_query();
		//die;
		$this->user_model->_table_name = "tbl_user_type"; //table name
        $this->user_model->_order_by = "user_type_id";
		$where = array(
			'id_gsettings' => $this->session->userdata('id_gsettings')
		);
        $data['user_type_info'] = $this->user_model->get_by($where);
        $data['password'] = $this->user_model->get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false);
		 

        $data['subview'] = $this->load->view('admin/user/create_user', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); 
	}

    public function buildChild($parent, $menu) {

        if (isset($menu['parents'][$parent])) {

            foreach ($menu['parents'][$parent] as $ItemID) {

                if (!isset($menu['parents'][$ItemID->menu_id])) {
                    $result[$ItemID->English] = $ItemID->menu_id;
                }
                if (isset($menu['parents'][$ItemID->menu_id])) {
                    $result[$ItemID->English][$ItemID->menu_id] = self::buildChild($ItemID->menu_id, $menu);
                }
            }
        }
        return $result;
    }

	
	
	
    public function user_list() {
        $data['menu'] = array("user_role" => 1, "c_user_role" => 1);
        $data['title'] = "Create User";

        $this->user_model->_table_name = "tbl_user"; //table name
        $this->user_model->_order_by = "user_id"; 
		
		
        $data['all_user_info'] = $this->user_model->get_user_type();
        //$data['all_employee_info'] = $this->user_model->get();
 
		
        $data['subview'] = $this->load->view('admin/user/user_list', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
		// echo $query = $this->db->last_query();
		 
    }
 
    public function save_user($id = null) {
		$user_name = $this->input->post('user_name');
		$this->user_model->_table_name = "tbl_user"; //table name
        $this->user_model->_order_by = "user_id";

		$result = $this->user_model->get_by(array('user_name' => $user_name));
		if ($id) {
			
		}else{
			if (!empty($result)) {
				$type = "error";
	            $message = "用户名已经存在，请重试！";
	            set_message($type, $message);
	            redirect('admin/user/user_list'); //redirect page
			}
		}
		//print_r($result);
		//die;

     		$data = $this->user_model->array_from_post(array('user_name', 'user_type_id', 'id_gsettings', 'flag')); 
			$data['id_gsettings'] = $this->session->userdata('id_gsettings');
			$user_id = $this->input->post('user_id');
			$password = $this->input->post('password');
			$password == '****************' || $data['password'] = $this->encryption->hash($this->input->post('password'));

			//delete existing userroll by login id
			if (!empty($id) && !empty($menu['menu'])) {
				$this->user_model->_table_name = "tbl_user_role"; //table name
				$this->user_model->_order_by = "user_id";
				$this->user_model->_primary_key = "user_role_id";

				$roll = $this->user_model->get_by(array('user_id' => $user_id), FALSE);

				foreach ($roll as $v_roll) {
					$this->user_model->delete($v_roll->user_role_id);
				}
			}

			$this->user_model->_table_name = "tbl_user"; // table name
			$this->user_model->_primary_key = "user_id"; // $id

			if (!empty($id)) {
				$id = $this->user_model->save($data, $id);
			} else {
				$id = $this->user_model->save($data);
			}

			$this->user_model->_table_name = "tbl_user_role"; // table name
			$this->user_model->_primary_key = "user_role_id"; // $id
			$menu = $this->user_model->array_from_post(array('menu'));
			if (!empty($menu['menu'])) {
				foreach ($menu as $v_menu) {
					foreach ($v_menu as $value) {
						$mdata['menu_id'] = $value;
						$mdata['user_id'] = $id;
						$this->user_model->save($mdata);
					}
				}
			}
			if (!empty($id)) {
				$type = "success";
				$message = "用户登录信息更新成功！";
				set_message($type, $message);
				redirect('admin/user/user_list'); //redirect page
			} else {
				$type = "success";
				$message = "新用户成功创建！";
				set_message($type, $message);
				redirect('admin/user/user_list'); //redirect page
			}
		

       
    }
	
    public function delete_user($id = null) {
		//echo $id; 
            //$id = $this->encryption->decrypt($id);
            //$user_id = $this->session->userdata('employee_id');
			$this->user_model->_table_name = "tbl_user"; //table name
            $this->user_model->_order_by = "user_id";
			$this->db->where('user_id =', $id);
                    $this->db->delete('tbl_user');
                    //redirect successful msg
                    $type = "success";
                    $message = "用户删除成功！";
                    set_message($type, $message);
                    redirect('admin/user/user_list');
					

    }

}

