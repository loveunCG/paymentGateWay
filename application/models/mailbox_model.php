<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mailbox_model
 *
 * @author NaYeM
 */
class Mailbox_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_inbox_message($email, $flag = Null, $limit = NULL) {
        $this->db->select('*');
        $this->db->from('tbl_inbox');
        $this->db->where('from', $email);
        if (!empty($flag)) {
            $this->db->where('view_status', '2');
        }
        if (!empty($limit)) {
            $this->db->limit('10');
        }
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_sent_message($employee_id) {
        $this->db->select('*');
        $this->db->from('tbl_send');
        $this->db->where('employee_id', $employee_id);
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

}
