<?php

class Hr_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_new_deptinfo() {
        $post = new stdClass();
        $post->department_id = '';
        $post->department_name = '';

        return $post;
    }

    public function get_new_positioninfo() {
        $post = new stdClass();
        $post->position_id = '';
        $post->position_name = '';

        return $post;
    }
    
//     //active session & newly create session
//    public function active_session() {
//        $this->db->select('*');
//        $this->db->from('tbl_session');
//        $this->db->where('active', 1);
//        $this->db->or_where('flag', 1);
//        $query_result = $this->db->get();
//        $result = $query_result->resu();
//        return $result;
//    }

    public function all_emplyee() {
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('tbl_position.position_name', FALSE);
        $this->db->from('tbl_employee');
        //$this->db->where('id=tbl_employee.employee_id');
        $this->db->join('tbl_department', 'tbl_employee.department_id = tbl_department.department_id', 'left');
        $this->db->join('tbl_position', 'tbl_employee.position_id  = tbl_position.position_id', 'left');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function employee_by_id($id) {
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('tbl_position.position_name', FALSE);
        $this->db->select('countries.countryName', FALSE);
        $this->db->from('tbl_employee');
        //$this->db->where('id=tbl_employee.employee_id');
        $this->db->join('tbl_department', 'tbl_employee.department_id = tbl_department.department_id', 'left');
        $this->db->join('tbl_position', 'tbl_employee.position_id  = tbl_position.position_id', 'left');
        $this->db->join('countries', 'tbl_employee.country  = countries.idCountry', 'left');
        $this->db->where('tbl_employee.employee_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function employee_info_by_id($id) {
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('tbl_position.position_name', FALSE);
        $this->db->select('countries.countryName', FALSE);
        $this->db->from('tbl_employee');
        //$this->db->where('id=tbl_employee.employee_id');
        $this->db->join('tbl_department', 'tbl_employee.department_id = tbl_department.department_id', 'left');
        $this->db->join('tbl_position', 'tbl_employee.position_id  = tbl_position.position_id', 'left');
        $this->db->join('countries', 'tbl_employee.country  = countries.idCountry', 'left');
        $this->db->where('tbl_employee.employee_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function subject_teacher_allocation_details($course_id, $class_id) {
        $this->db->select('tbl_subject.*', FALSE);
        $this->db->select('tbl_teacher_allocation.teacher_allocation_id, tbl_teacher_allocation.employee_id, tbl_teacher_allocation.class_id ', FALSE);
        $this->db->join('tbl_teacher_allocation', 'tbl_subject.subject_id = tbl_teacher_allocation.subject_id && tbl_teacher_allocation.class_id = ' . $class_id, 'left');
        $this->db->from('tbl_subject');
        $this->db->where('course_id', $course_id);

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
      public function select_class_by_session($session_id, $course_id) {
        $this->db->select('tbl_class.*', FALSE);
        $this->db->select('tbl_course.course', FALSE);
        $this->db->select('tbl_shift.shift', FALSE);
        $this->db->select('tbl_section.section', FALSE);
        $this->db->select('tbl_session.year', FALSE);
        $this->db->from('tbl_class');
        $this->db->join('tbl_course', 'tbl_class.course_id = tbl_course.course_id', 'left');
        $this->db->join('tbl_shift', 'tbl_class.shift_id  = tbl_shift.shift_id ', 'left');
        $this->db->join('tbl_section', 'tbl_class.section_id  = tbl_section.section_id ', 'left');
        $this->db->join('tbl_session', 'tbl_class.session_id  = tbl_session.session_id ', 'left');
        $this->db->where('tbl_class.session_id', $session_id);
        $this->db->where('tbl_class.course_id', $course_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
     public function select_employee_by_group($employee_department_id) {
        $this->db->select('*');
        $this->db->from('tbl_employee');
        $this->db->where('tbl_employee.department_id', $employee_department_id);        
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function get_empty_class() {
        $post = new stdClass();
        $post->class_id = '';
        $post->employee_id = '';

        return $post;
    }

    public function get_new_employeeinfo() {
        $post = new stdClass();
        $post->employee_id = '';
        $post->first_name = '';
        $post->last_name = '';
        $post->position_id = '';
        $post->job_title = '';
        $post->department_id = '';
        $post->joining_date = '';
        $post->date_of_birth = '';
        $post->gender = '';
        $post->maratial_status = '';        
        $post->father_name = '';
        $post->mother_name = '';
        $post->present_address = '';
        $post->permanent_address = '';
        $post->city = '';
        $post->country = '';
        $post->mobile = '';
        $post->phone = '';
        $post->email = '';
        $post->photo = '';
        $post->photo_a_path = '';
        $post->cv = '';
        $post->cv_path = '';
        $post->file_a_path = '';
        $post->flag_teacher = '';

        return $post;
    }

    public function get_new_leave_category() {
        $post = new stdClass();
        $post->leave_category_id = '';
        $post->category = '';

        return $post;
    }

    public function get_set_attendance() {
        $post = new stdClass();
        $post->attendance_id = '';
        $post->department_id = '';
        $post->leave_catgeory_id = '';
        $post->day = '';
        $post->absent = '';
        $post->present = '';
        return $post;
    }

    

    public function get_employee_id_by_dept_id($department_id) {
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_employee');
        $this->db->join('tbl_department', 'tbl_employee.department_id = tbl_department.department_id', 'left');
        $this->db->where('tbl_employee.department_id', $department_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    

    public function attendance_report_by_empid($employee_id = null, $sdate = null, $flag = NULL) {

        $this->db->select('tbl_attendance.date,tbl_attendance.attendance_status', FALSE);
        $this->db->select('tbl_employee.first_name, tbl_employee.last_name ', FALSE);
        $this->db->from('tbl_attendance');
        $this->db->join('tbl_employee', 'tbl_attendance.employee_id  = tbl_employee.employee_id', 'left');
        $this->db->where('tbl_attendance.employee_id', $employee_id);
        $this->db->where('tbl_attendance.date', $sdate);
        $query_result = $this->db->get();
        $result = $query_result->result();

        if (empty($result)) {
            $val['attendance_status'] = $flag;
            $val['date'] = $sdate;
            $result[] = (object) $val;
        }else{
            if($result[0]->attendance_status==0){
                if($flag=='H'){
                    $result[0]->attendance_status = 'H';
                }
            }
        }


        return $result;
    }

}