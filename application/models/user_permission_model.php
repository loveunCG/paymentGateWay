<?php

class User_permission_model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;
	
	public function select_user_roll($user_type_id) {
        $this->db->select('tbl_user_role.*', FALSE);
        $this->db->select('tbl_menu.english', FALSE);
        $this->db->from('tbl_user_role');
        $this->db->join('tbl_menu', 'tbl_user_role.menu_id = tbl_menu.menu_id', 'left');
        $this->db->where('tbl_user_role.user_type_id', $user_type_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
	
	
}

?>