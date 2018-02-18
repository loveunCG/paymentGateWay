<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notice extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notice_model');

        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => "Full",
                'width' => "100%",
                'height' => "200px"
            )
        );
    }

    public function add_notice($id = NULL) {

        $data['menu'] = array("notice_board" => 1, "create_notice" => 1);
        $data['title'] = "Create Notice"; //Page title

        if ($id) {
            $this->notice_model->_table_name = "tbl_notice"; // table name
            $this->notice_model->_order_by = "notice_id"; // $id
            $data['notice'] = $this->notice_model->get_by(array('notice_id' => $id,'id_gsettings' => $this->session->userdata('id_gsettings')), TRUE);

            if (empty($data['notice'])) {
                $type = "error";
                $message = "没有找到记录";
                set_message($type, $message);
                redirect('admin/notice/create_notice');
            }
        } else {

            $data['notice'] = $this->notice_model->get_notice();
        }

        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('admin/notice/create_notice', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function save_notice($id = NULL) {

        $date = date("Y-m-d H:i:s");
        $data = $this->notice_model->array_from_post(array(
            'title',
            'short_description',
            'long_description',
            'flag',
        ));
		$data['id_gsettings'] = $this->session->userdata('id_gsettings');
        
        $data['employee_id'] = $this->session->userdata('employee_id');
        $data['created_date'] = $date;

        $this->notice_model->_table_name = "tbl_notice"; // table name
        $this->notice_model->_primary_key = "notice_id"; // $id
        $this->notice_model->save($data, $id);

        // messages for user
        $type = "success";
        $message = "通知已成功保存！";
        set_message($type, $message);
        redirect('admin/notice/manage_notice');
    }

    public function manage_notice() {

        $data['title'] = "View Notice"; //Page title

        $this->notice_model->_table_name = "tbl_notice"; // table name
        $this->notice_model->_order_by = "notice_id"; // $id
        $data['notice'] = $this->notice_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));

        $data['subview'] = $this->load->view('admin/notice/view_notice', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function notice_details($id) {
        $data['title'] = "View Notice"; //Page title

        $this->notice_model->_table_name = "tbl_notice"; // table name
        $this->notice_model->_order_by = "notice_id"; // $id
        $data['full_notice_details'] = $this->notice_model->get_by(array('notice_id' => $id,'id_gsettings' => $this->session->userdata('id_gsettings')), TRUE);
        $this->notice_model->_primary_key = 'notice_id';
        $updata['view_status'] = '1';
        $this->notice_model->save($updata, $id);
        $data['subview'] = $this->load->view('admin/notice/notice_details', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }

    public function delete_notice($id = NULL) {

        $this->notice_model->_table_name = "tbl_notice";
        $this->notice_model->_primary_key = "notice_id";
        $this->notice_model->delete($id);

        // messages for user
        $type = "error";
        $message = "通知已成功删除！";
        set_message($type, $message);

        redirect('admin/notice/manage_notice');
    }

}
