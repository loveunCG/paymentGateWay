<?php

class Global_Model extends MY_Model {

    protected $_table_name;
    protected $_order_by;

    public function class_details($id) {
        $this->db->select('tbl_class.class_id, tbl_class.session_id ', FALSE);
        $this->db->select('tbl_session.year', FALSE);
        $this->db->select('tbl_course.course, tbl_course.course_id ', FALSE);
        $this->db->select('tbl_shift.shift_id ,tbl_shift.shift', FALSE);
        $this->db->select('tbl_section.section_id ,tbl_section.section', FALSE);
        $this->db->from('tbl_class');
        $this->db->join('tbl_session', 'tbl_class.session_id = tbl_session.session_id', 'left');
        $this->db->join('tbl_course', 'tbl_class.course_id = tbl_course.course_id', 'left');
        $this->db->join('tbl_shift', 'tbl_class.shift_id = tbl_shift.shift_id', 'left');
        $this->db->join('tbl_section', 'tbl_class.section_id = tbl_section.section_id', 'left');
        $this->db->where('tbl_class.class_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function select_course_by_session_id($session_id) {
        $this->db->select('tbl_class_session.*', FALSE);
        $this->db->select('tbl_course.course', FALSE);
        $this->db->from('tbl_class_session');
        $this->db->join('tbl_course', 'tbl_class_session.course_id = tbl_course.course_id', 'left');
        $this->db->where('session_id', $session_id);

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_shift_by_class_session_id($class_session_id) {

        $this->db->select('tbl_shift_session.*', FALSE);
        $this->db->select('tbl_shift.shift', FALSE);
        $this->db->from('tbl_shift_session');
        $this->db->join('tbl_shift', 'tbl_shift_session.shift_id = tbl_shift.shift_id', 'left');
        $this->db->where('class_session_id', $class_session_id);

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function select_section_by_shift_session_id($shift_session_id) {
        $this->db->select('tbl_section_session.*', FALSE);
        $this->db->select('tbl_section.section', FALSE);
        $this->db->from('tbl_section_session');
        $this->db->join('tbl_section', 'tbl_section_session.section_id = tbl_section.section_id', 'left');
        $this->db->where('shift_session_id', $shift_session_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_public_holidays($yymm) {
        // $this->db->select('tbl_holiday.*', FALSE);
        // $this->db->from('tbl_holiday');
		// $this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
        // $this->db->like('start_date', $yymm);        
        // $query_result = $this->db->get();
        // $result = $query_result->result();
        // return $result;
    }

    public function get_holidays() {
        // $this->db->select('tbl_working_days.day_id,tbl_working_days.flag', FALSE);
        // $this->db->select('tbl_days.day', FALSE);
        // $this->db->from('tbl_working_days');
        // $this->db->join('tbl_days', 'tbl_days.day_id = tbl_working_days.day_id', 'left');
		// $this->db->where('tbl_working_days.id_gsettings',$this->session->userdata('id_gsettings'));
        // $this->db->where('flag', 0);
        // $query_result = $this->db->get();
        // $result = $query_result->result();
        // return $result;
    }

    public function select_user_roll($employee_login_id) {
		
		$employee_login_id = $this->session->userdata('user_type');
		
		$this->db->select('tbl_user_role.menu_id', FALSE);
        $this->db->select('tbl_menu.English,tbl_menu.parent', FALSE);
        $this->db->from('tbl_user_role');
        $this->db->join('tbl_menu', 'tbl_user_role.menu_id = tbl_menu.menu_id', 'left');
        $this->db->where('user_type_id', $employee_login_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
		
        return $result;
    }

    public function student_details_by_class_id($class_id) {
        $this->db->select('tbl_student_session.student_session_id, tbl_student_session.student_id, tbl_student_session.class_roll ', FALSE);
        $this->db->select('tbl_student.registration_number, tbl_student.std_first_name, tbl_student.std_last_name', FALSE);
        $this->db->select('tbl_group.group_id, tbl_group.subject_group_id', FALSE);

        $this->db->from('tbl_student_session');
        $this->db->join('tbl_student', 'tbl_student_session.student_id = tbl_student.student_id', 'left');
        $this->db->join('tbl_group', 'tbl_student_session.student_session_id = tbl_group.student_session_id', 'left');

        $this->db->where('class_id', $class_id);
        $this->db->where('status', 1);
        $this->db->order_by("class_roll", "asc");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function subject_details_by_class_id($class_id) {
        $this->db->select('tbl_subject.* ', FALSE);

        $this->db->from('tbl_subject');

        $this->db->where('course_id', 1);
        $this->db->group_by("subject_group_id");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_last_id($table, $key) {
        $this->db->select_max($key);
        $Q = $this->db->get($table);
        $row = $Q->row_array();
        $last_id = $row['exam_mark_id'];
        return $last_id;
    }

    public function student_details($class_id, $flag = NULL) {

        $this->db->select('tbl_student_session.*', FALSE);
        $this->db->select('tbl_student.registration_number, tbl_student.std_first_name, tbl_student.std_last_name  ', FALSE);
        $this->db->from('tbl_student_session');
        $this->db->join('tbl_student', 'tbl_student.student_id = tbl_student_session.student_id', 'left');
        //$this->db->where('tbl_student.student_id', $student_id);
        $this->db->where('tbl_student_session.class_id', $class_id);
        if ($flag == TRUE) {
            $this->db->where('tbl_student_session.status', 1);
            $this->db->where('tbl_student_session.alumni', 0);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_lecture_info_by_id($class_id = NULL, $subject_id = NULL, $class_discusstion_id = NULL) {

        $this->db->select('tbl_class_lecture.*', FALSE);
        $this->db->select('tbl_class_lecture_details.*', FALSE);
        $this->db->select('tbl_employee.first_name,tbl_employee.last_name', FALSE);
        $this->db->select('tbl_subject.subject_name', FALSE);
        $this->db->from('tbl_class_lecture');
        $this->db->join('tbl_class_lecture_details', 'tbl_class_lecture_details.class_lecture_id = tbl_class_lecture.class_lecture_id', 'left');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_class_lecture.employee_id', 'left');
        $this->db->join('tbl_class', 'tbl_class.class_id = tbl_class_lecture.class_id', 'left');
        $this->db->join('tbl_subject', 'tbl_subject.subject_id = tbl_class_lecture.subject_id', 'left');
        if (!empty($subject_id)) {
            $this->db->where('tbl_class_lecture.subject_id', $subject_id);
        }
        $this->db->where('tbl_class_lecture.class_id', $class_id);
        if (!empty($class_discusstion_id)) {
            $this->db->where('tbl_class_lecture_details.class_lecture_details_id', $class_discusstion_id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }
        return $result;
    }

    public function student_invdle_details($student_session_id) {
        $this->db->select('tbl_student.*', FALSE);
        $this->db->select('tbl_student_contact.*', FALSE);
        $this->db->select('tbl_student_session.*', FALSE);
        $this->db->select('tbl_class.class_id', FALSE);
        $this->db->select('tbl_session.session_id,tbl_session.year', FALSE);
        $this->db->select('tbl_course.*', FALSE);
        $this->db->select('tbl_shift.*', FALSE);
        $this->db->select('tbl_section.section', FALSE);
        $this->db->from('tbl_student');
        $this->db->join('tbl_student_contact', 'tbl_student_contact.student_id = tbl_student.student_id', 'left');
        $this->db->join('tbl_student_session', 'tbl_student.student_id = tbl_student_session.student_id', 'left');
        $this->db->join('tbl_class', 'tbl_class.class_id = tbl_student_session.class_id', 'left');
        $this->db->join('tbl_session', 'tbl_class.session_id = tbl_session.session_id', 'left');
        $this->db->join('tbl_course', 'tbl_class.course_id = tbl_course.course_id', 'left');
        $this->db->join('tbl_shift', 'tbl_class.shift_id = tbl_shift.shift_id', 'left');
        $this->db->join('tbl_section', 'tbl_class.section_id = tbl_section.section_id', 'left');
        $this->db->where('tbl_student_session.student_session_id', $student_session_id);
        $this->db->where('tbl_student_session.status', 1);
        $this->db->where('tbl_student_session.alumni', 0);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_studnet_comment($cls_dis_details_id, $class_id) {
        $this->db->select('tbl_student_comment.*', FALSE);
        $this->db->select('tbl_student_session.student_session_id', FALSE);
        $this->db->select('tbl_student.std_first_name,tbl_student.std_last_name', FALSE);
        $this->db->select('tbl_class.class_id', FALSE);

        $this->db->select('tbl_employee.first_name,tbl_employee.last_name', FALSE);

        $this->db->from('tbl_student_comment');
        $this->db->join('tbl_student_session', 'tbl_student_session.student_session_id = tbl_student_comment.student_session_id', 'left');
        $this->db->join('tbl_student', 'tbl_student.student_id = tbl_student_session.student_id', 'left');
        $this->db->join('tbl_class', 'tbl_class.class_id = tbl_student_comment.class_id', 'left');

        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_student_comment.employee_id', 'left');

        $this->db->where('tbl_student_comment.class_lecture_details_id', $cls_dis_details_id);
        $this->db->where('tbl_student_comment.class_id', $class_id);

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_visited_student_info($cls_dis_details_id) {

        $this->db->select('tbl_visited_student.*', FALSE);
        $this->db->select('tbl_student_session.student_session_id', FALSE);
        $this->db->select('tbl_student.std_first_name,tbl_student.std_last_name', FALSE);
        $this->db->from('tbl_visited_student');
        $this->db->join('tbl_student_session', 'tbl_student_session.student_session_id = tbl_visited_student.student_session_id', 'left');
        $this->db->join('tbl_student', 'tbl_student.student_id = tbl_student_session.student_id', 'left');
        $this->db->where('tbl_visited_student.class_lecture_details_id', $cls_dis_details_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_discussion_info_by_id($class_id = NULL, $class_discusstion_id = NULL, $discussion_type_id = NULL) {

        $this->db->select('tbl_post.*', FALSE);
        $this->db->select('tbl_post_details.*', FALSE);
        $this->db->select('tbl_discussion_type.*', FALSE);
        $this->db->select('tbl_employee.first_name,tbl_employee.last_name', FALSE);
        $this->db->select('tbl_class.*', FALSE);
        $this->db->select('tbl_session.year', FALSE);
        $this->db->select('tbl_course.course, tbl_course.course_id ', FALSE);
        $this->db->select('tbl_shift.shift_id ,tbl_shift.shift', FALSE);
        $this->db->select('tbl_section.section_id ,tbl_section.section', FALSE);
        $this->db->from('tbl_post');
        $this->db->join('tbl_post_details', 'tbl_post_details.post_id = tbl_post.post_id', 'left');
        $this->db->join('tbl_discussion_type', 'tbl_discussion_type.discussion_type_id = tbl_post_details.discussion_type_id', 'left');
        $this->db->join('tbl_class', 'tbl_class.class_id = tbl_post.class_id', 'left');
        $this->db->join('tbl_session', 'tbl_class.session_id = tbl_session.session_id', 'left');
        $this->db->join('tbl_course', 'tbl_class.course_id = tbl_course.course_id', 'left');
        $this->db->join('tbl_shift', 'tbl_class.shift_id = tbl_shift.shift_id', 'left');
        $this->db->join('tbl_section', 'tbl_class.section_id = tbl_section.section_id', 'left');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_post.employee_id', 'left');
        if (!empty($discussion_type_id)) {
            $this->db->where('tbl_post_details.discussion_type_id', $discussion_type_id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        } else {
            if (!empty($class_id)) {
                $this->db->where('tbl_post.class_id', $class_id);
            }
            $this->db->where('tbl_post_details.post_details_id', $class_discusstion_id);

            $query_result = $this->db->get();
            $result = $query_result->row();
        }

        return $result;
    }

    public function get_all_thread($post_details_id, $class_id) {

        $this->db->select('tbl_thread.*', FALSE);
        $this->db->select('tbl_student_session.student_session_id', FALSE);
        $this->db->select('tbl_student.std_first_name,tbl_student.std_last_name', FALSE);
        $this->db->select('tbl_class.class_id', FALSE);
        $this->db->select('tbl_employee.first_name,tbl_employee.last_name', FALSE);
        $this->db->from('tbl_thread');
        $this->db->join('tbl_student_session', 'tbl_student_session.student_session_id = tbl_thread.student_session_id', 'left');
        $this->db->join('tbl_student', 'tbl_student.student_id = tbl_student_session.student_id', 'left');
        $this->db->join('tbl_class', 'tbl_class.class_id = tbl_thread.class_id', 'left');

        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_thread.employee_id', 'left');
        $this->db->where('tbl_thread.post_details_id', $post_details_id);
        $this->db->where('tbl_thread.class_id', $class_id);

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_all_sub_thread_by_id($thread_id) {

        $this->db->select('tbl_sub_thread.*', FALSE);
        $this->db->select('tbl_thread.*', FALSE);
        $this->db->select('tbl_student_session.student_session_id', FALSE);
        $this->db->select('tbl_student.std_first_name,tbl_student.std_last_name', FALSE);        
        $this->db->select('tbl_employee.first_name,tbl_employee.last_name', FALSE);
        $this->db->from('tbl_sub_thread');
        $this->db->join('tbl_thread', 'tbl_thread.thread_id = tbl_sub_thread.thread_id', 'left');
        $this->db->join('tbl_student_session', 'tbl_student_session.student_session_id = tbl_sub_thread.student_session_id', 'left');
        $this->db->join('tbl_student', 'tbl_student.student_id = tbl_student_session.student_id', 'left');

        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_sub_thread.employee_id', 'left');
        $this->db->where('tbl_sub_thread.thread_id', $thread_id);
//        $this->db->where('tbl_sub_thread.employee_id', $employee_id);
//        $this->db->where('tbl_sub_thread.student_session_id', $student_session_id);

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

}
