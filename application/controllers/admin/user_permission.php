<?php

class User_permission extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_permission_model');
	}
	
	public function create_user_type($id = null)
	{
		if (!empty($id)) {
            $data['user_type_id'] = $id;
        } else {
            $data['user_type_id'] = null;
        }
		
		$data['title'] = "Create User";
 
		if($this->session->userdata('user_type') == 1)
		{
			$this->user_permission_model->_table_name = "tbl_menu"; //table name
			$this->user_permission_model->_order_by = "menu_id";
			
			$menu_info = $this->user_permission_model->get();
		}
		else
		{
			
			$menu_info = $this->global_model->select_user_roll($id);
		}
		
        
		foreach ($menu_info as $items) {
            $menu['parents'][$items->parent][] = $items;
        }
        $data['result'] = $this->buildChild(0, $menu);
		
		
		
		
		$this->user_permission_model->_table_name = "tbl_user_type"; //table name
        $this->user_permission_model->_order_by = "user_type_id";
		
		$where = array(
			'user_type_id' => $data['user_type_id'],
			'id_gsettings' => $this->session->userdata('id_gsettings')
		);
        $data['user_type_details'] = $this->user_permission_model->get_by($where, TRUE);
		//print_r($data['user_type_details']);die();
        

		
		$this->user_permission_model->_table_name = "tbl_user_role"; //table name
		$this->user_permission_model->_order_by = "user_type_id";
		
		$where = array(
			'user_type_id' => $data['user_type_id']
		);
        $data['user_role_info'] = $this->user_permission_model->get_by($where);
		
		$role = $this->user_permission_model->select_user_roll($data['user_type_id']);

            if ($role) {
                foreach ($role as $value) {
                    $result[$value->menu_id] = $value->menu_id;
                }

                $data['roll'] = $result;
            }
		
		
        $data['subview'] = $this->load->view('admin/user_type/create_user_type', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
	}
	
	public function buildChild($parent, $menu) {

        if (isset($menu['parents'][$parent])) {

            foreach ($menu['parents'][$parent] as $ItemID) {

                if (!isset($menu['parents'][$ItemID->menu_id])) {
                    $result[$ItemID->chinese] = $ItemID->menu_id;
                }
                if (isset($menu['parents'][$ItemID->menu_id])) {
                    $result[$ItemID->chinese][$ItemID->menu_id] = self::buildChild($ItemID->menu_id, $menu);
                }
            }
        }
        return $result;
    }
	
	public function user_type() {
        $data['title'] = "User Type";

        $this->user_permission_model->_table_name = "tbl_user_type"; //table name
        $this->user_permission_model->_order_by = "user_type_id";
		$where = array(
			'id_gsettings' => $this->session->userdata('id_gsettings')
		);
        $data['user_type_info'] = $this->user_permission_model->get_by($where);
		//print_r($data['user_type_info']);die();
        $data['subview'] = $this->load->view('admin/user_type/user_type_list', $data, TRUE);
        //echo $data['subview'];
		$this->load->view('admin/_layout_main', $data);
    }
	
	public function save_user_type($id = null) {
        
		$data = $this->user_permission_model->array_from_post(array('user_type'));
        $data['id_gsettings'] = $this->session->userdata('id_gsettings');
		
		//menu details from post
        $menu = $this->user_permission_model->array_from_post(array('menu'));
		
		//delete existing userroll by user type id
        if (!empty($id) && !empty($menu['menu'])) {
            $this->user_permission_model->_table_name = "tbl_user_role"; //table name
            $this->user_permission_model->_order_by = "user_role_id";
            $this->user_permission_model->_primary_key = "user_role_id";
			
			$where = array(
				'user_type_id' => $id
			);
            $roll = $this->user_permission_model->get_by($where, FALSE);

			if(!empty($roll))
			{
				foreach ($roll as $v_roll) {
					$this->user_permission_model->delete($v_roll->user_role_id);
				}
			}
        }

        $this->user_permission_model->_table_name = "tbl_user_type"; // table name
        $this->user_permission_model->_primary_key = "user_type_id"; // $id

        if (!empty($id)) {
            $id = $this->user_permission_model->save($data, $id);
        } else {
            $id = $this->user_permission_model->save($data);
        }

        $this->user_permission_model->_table_name = "tbl_user_role"; // table name
        $this->user_permission_model->_primary_key = "user_role_id"; // $id
        if (!empty($menu['menu']) && !empty($menu['menu'])) {
            foreach ($menu as $v_menu) {
                foreach ($v_menu as $value) {
                    $mdata['menu_id'] = $value;
                    $mdata['user_type_id'] = $id;
                    $this->user_permission_model->save($mdata);
                }
            }
        }
        if (!empty($id)) {
            $type = "success";
            $message = "用户类型更新成功！";
            set_message($type, $message);
            redirect('admin/user_permission/user_type'); //redirect page
        } else {
            $type = "success";
            $message = "新建用户类型已成功创建！";
            set_message($type, $message);
            redirect('admin/user_permission/user_type'); //redirect page
        }
    }
	
    public function delete_user_type($id = null) {
        if (!empty($id)) {
            $id ;//= $this->encryption->decrypt($id);
             //delete procedure run
                // Check user in db or not
                $this->user_permission_model->_table_name = "tbl_user_type"; //table name
                $this->user_permission_model->_order_by = "user_type_id";
				$where = array(
					'user_type_id' => $id,
					'id_gsettings' => $this->session->userdata('id_gsettings')
					);
                $result = $this->user_permission_model->get_by($where, true);

                if (count($result)) {
                    //delete user_type by id
                    $this->db->where('user_type_id =', $id);
                    $this->db->delete('tbl_user_type');

                    $this->db->where('user_type_id', $id);
                    $this->db->delete('tbl_user_role');

                    //redirect successful msg
                    $type = "success";
                    $message = "用户类型删除成功！";
                    set_message($type, $message);
                    redirect('admin/user_permission/user_type'); //redirect page
                } else {
                    //redirect error msg
                    $type = "error";
                    $message = "抱歉这个用户类型在数据库中找不到！";
                    set_message($type, $message);
                    redirect('admin/user_permission/user_type'); //redirect page
                }
        }
    }
}
?>