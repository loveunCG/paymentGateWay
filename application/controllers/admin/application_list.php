<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Application_List extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('application_model');
    }

    public function index() {
        $data['title'] = "Application List";
        $data['all_application_info'] = $this->application_model->get_emp_leave_info();

        $data['subview'] = $this->load->view('admin/application/application_list', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function view_application($id) {
        $data['title'] = "Application List";
        $data['application_info'] = $this->application_model->get_emp_leave_info($id);
        // set view status by id
        $where = array('application_list_id' => $id);
        $updata['view_status'] = '1';
        $this->application_model->set_action($where, $updata, 'tbl_application_list');

        $data['subview'] = $this->load->view('admin/application/application_details', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function set_action($id) {
        $data['application_status'] = $this->input->post('application_status', TRUE);
        if ($data['application_status'] == 2) {
            $atdnc_data = $this->application_model->array_from_post(array('employee_id', 'leave_category_id'));
            $leave_start_date = $this->input->post('leave_start_date', TRUE);
            $leave_end_date = $this->input->post('leave_end_date', TRUE);
            if ($leave_start_date == $leave_end_date) {
                $this->admin_model->_table_name = 'tbl_attendance';
                $this->admin_model->_order_by = 'attendance_id';
                $check_leave_date = $this->admin_model->get_by(array('employee_id' => $atdnc_data['employee_id'], 'date' => $leave_end_date), FALSE);
                if (empty($check_leave_date)) {
                    $atdnc_data['date'] = $leave_start_date;
                    $atdnc_data['attendance_status'] = '3';
                    $this->admin_model->_table_name = 'tbl_attendance';
                    $this->admin_model->_primary_key = "attendance_id";
                    $this->admin_model->save($atdnc_data);
                }
            } else {
                for ($l = $leave_start_date; $l <= $leave_end_date; $l++) {
                    $this->admin_model->_table_name = 'tbl_attendance';
                    $this->admin_model->_order_by = 'attendance_id';
                    $check_leave_date = $this->admin_model->get_by(array('employee_id' => $atdnc_data['employee_id'], 'date' => $l), FALSE);
                    if (empty($check_leave_date)) {
                        $atdnc_data['date'] = $l;
                        $atdnc_data['attendance_status'] = '3';
                        $this->admin_model->_table_name = 'tbl_attendance';
                        $this->admin_model->_primary_key = "attendance_id";
                        $this->admin_model->save($atdnc_data);
                    }
                }
            }
        }
        $where = array('application_list_id' => $id);
        $this->application_model->set_action($where, $data, 'tbl_application_list');
        $type = "success";
        $message = "Application Status Successfully Changed!";
        set_message($type, $message);
        redirect('admin/application_list'); //redirect page
    }

}
