<?php

class Admin_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function select_employee_by_department_id($department_id) {
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_employee');
        $this->db->join('tbl_department', 'tbl_employee.department_id = tbl_department.department_id', 'left');
        $this->db->where('tbl_employee.department_id', $department_id);
		
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
		
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }   

    public function check_holiday_by_date() {
        $this->db->select('tbl_holiday.*', FALSE);
        $this->db->from('tbl_holiday');
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_event_by_id($employee_id) {
        $this->db->select('tbl_event.*', FALSE);
        $this->db->select('tbl_employee.employee_id', FALSE);
        $this->db->from('tbl_event');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_event.employee_id', 'left');
       // $this->db->where('tbl_event.employee_id', $employee_id);
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
public function get_event_display($employee_id) {
        $this->db->select('tbl_event.*', FALSE);
        $this->db->select('tbl_employee.employee_id', FALSE);
        $this->db->from('tbl_event');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_event.employee_id', 'left');
       // $this->db->where('tbl_event.employee_id', $employee_id);
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
        $query_result = $this->db->get();
		$count_event = $query_result->num_rows();
		if($count_event > 0){
        foreach($query_result->result_array() as $row)
		{
			$event['id'] = $row['event_id'];
			$event['title'] = $row['event_name'];
			$event['start'] = $row['start_date'];
			$event['end'] =$row['end_date'];
			$events[] = $event;
		}
        //$result = $query_result->result();
        return $events;
		}else
		return false;
    }
    public function get_all_notice() {
        $this->db->select('*');
        $this->db->from('tbl_notice');
        $this->db->limit('3');
        $this->db->where('flag', 1);
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
        $this->db->order_by("created_date", "DESC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_emp_leave_info() {
        $this->db->select('tbl_application_list.*', FALSE);
        $this->db->select('tbl_employee.first_name,tbl_employee.last_name,tbl_employee.photo', FALSE);
        $this->db->from('tbl_application_list');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_application_list.employee_id', 'left');
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
        $this->db->where('tbl_application_list.view_status', '2');
        $this->db->where('tbl_application_list.notify_me', '1');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_menu_by_uri($uriSegment) {

        $this->db->select('tbl_menu.*', FALSE);
        $this->db->from('tbl_menu');
        $this->db->where('link', $uriSegment);
        $query_result = $this->db->get();
        $result = $query_result->row();
        if (count($result)) {
            $menuId[] = $result->menu_id;
            $menuId = $this->select_menu_by_id($result->parent, $menuId);
        } else {

            return false;
        }
        if (!empty($menuId)) {
            $lastId = end($menuId);
            $parrent = $this->select_menu_first_parent($lastId);
            array_push($menuId, $parrent->parent);
            return $menuId;
        }
    }

    public function select_menu_by_id($id, $menuId) {
        $this->db->select('tbl_menu.*', FALSE);
        $this->db->from('tbl_menu');
        $this->db->where('menu_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        if (count($result)) {
            array_push($menuId, $result->menu_id);
            if ($result->parent != 0) {
                $result = self::select_menu_by_id($result->parent, $menuId);
            }
        }
        return $menuId;
    }

    public function select_menu_first_parent($lastId) {
        $this->db->select('tbl_menu.*', FALSE);
        $this->db->from('tbl_menu');
        $this->db->where('menu_id', $lastId);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_expense_list_by_date($start_date, $end_date) {
        $this->db->select('tbl_expense.*', FALSE);
        $this->db->select('tbl_employee.first_name,tbl_employee.last_name', FALSE);
        $this->db->from('tbl_expense');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_expense.employee_id', 'left');
        $this->db->where('purchase_date >=', $start_date);
        $this->db->where('purchase_date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_recent_application() {
        $this->db->select('tbl_application_list.*', FALSE);
        $this->db->select('tbl_leave_category.*', FALSE);
        $this->db->select('tbl_employee.employment_id,tbl_employee.first_name,tbl_employee.last_name,tbl_employee.photo', FALSE);
        $this->db->from('tbl_application_list');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_application_list.employee_id', 'left');
        $this->db->join('tbl_leave_category', 'tbl_leave_category.leave_category_id = tbl_application_list.leave_category_id', 'left');
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
        $this->db->order_by('tbl_application_list.application_list_id', 'DESC');
        $this->db->limit('5');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
     public function get_absent_employee() {
        $this->db->select('tbl_attendance.*', FALSE);
        $this->db->select('tbl_employee.first_name,tbl_employee.last_name', FALSE);
        $this->db->from('tbl_attendance');
        $this->db->where('tbl_attendance.attendance_status','3');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_attendance.employee_id', 'left');
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

     public function get_all_request($id=null) {
        $this->db->select('tbl_order.*', FALSE);        
        $this->db->from('tbl_order');
        if (!empty($id)) {
            $this->db->where('status', $id);
            $query_result = $this->db->get();
            $result = $query_result->result_array();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result_array();
        }   

        return $result;
    }

     public function get_all_requestlist($id=null) {
        $this->db->select('tbl_order.*', FALSE);        
        $this->db->from('tbl_order');
        if (!empty($id)) {
        $this->db->where('status', $id);
        }
        $this->db->order_by('submit_time', 'asc');
        $this->db->limit('12');        
            $query_result = $this->db->get();
            $result = $query_result->result_array();
        

        return $result;
    }

}
