<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mailbox
 *
 * @author NaYeM
 */
class Mailbox extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mailbox_model');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => "Full",
                'width' => "99.8%",
                'height' => "350px"
            )
        );
    }

    public function inbox() {
        $data['title'] = "Inbox";
        // get email info by session
        $ginfo = $this->session->userdata('genaral_info');
        if (!empty($ginfo)) {
            $email = $ginfo[0]->email;
            // get all inbox by email 
            $data['get_inbox_message'] = $this->mailbox_model->get_inbox_message($email);
            $data['unread_mail'] = count($this->mailbox_model->get_inbox_message($email, TRUE));
        }
        $data['subview'] = $this->load->view('admin/mailbox/inbox', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function read_inbox_mail($id) {
        $data['title'] = "Inbox";
        $this->mailbox_model->_table_name = 'tbl_inbox';
        $this->mailbox_model->_order_by = 'inbox_id';
        $data['read_mail'] = $this->mailbox_model->get_by(array('inbox_id' => $id), true);
        $this->mailbox_model->_primary_key = 'inbox_id';
        $updata['view_status'] = '1';
        $this->mailbox_model->save($updata, $id);
        $data['subview'] = $this->load->view('admin/mailbox/read_mail', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function delete_inbox_mail() {
        // get sellected id into inbox email page
        $selected_inbox_id = $this->input->post('selected_inbox_id', TRUE);
        if (!empty($selected_inbox_id)) { // check selected message is empty or not
            foreach ($selected_inbox_id as $v_inbox_id) {
                $this->mailbox_model->_table_name = 'tbl_inbox';
                $this->mailbox_model->delete_multiple(array('inbox_id' => $v_inbox_id));
            }
            $type = "success";
            $message = "Your message has been Deleted.";
        } else {
            $type = "error";
            $message = "Please Select a Message to Delete.";
        }
        set_message($type, $message);
        redirect('admin/mailbox/inbox');
    }

    public function sent() {
        $data['title'] = "Sent Email";
        $employee_id = $this->session->userdata('employee_id');
        $data['get_sent_message'] = $this->mailbox_model->get_sent_message($employee_id);
        $data['subview'] = $this->load->view('admin/mailbox/sent', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function read_send_mail($id) {
        $data['title'] = "Inbox";
        $this->mailbox_model->_table_name = 'tbl_send';
        $this->mailbox_model->_order_by = 'send_id';
        $data['read_mail'] = $this->mailbox_model->get_by(array('send_id' => $id), true);
        $data['subview'] = $this->load->view('admin/mailbox/read_mail', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function delete_send_mail() {
        // get sellected id into send email page
        $selected_send_id = $this->input->post('selected_send_id', TRUE);

        if (!empty($selected_send_id)) {
            foreach ($selected_send_id as $v_send_id) {
                $this->mailbox_model->_table_name = 'tbl_send';
                $this->mailbox_model->delete_multiple(array('send_id' => $v_send_id));
            }
            $type = "success";
            $message = "Your message has been Deleted.";
        } else {
            $type = "error";
            $message = "Please Select a Message to Delete.";
        }
        set_message($type, $message);
        redirect('admin/mailbox/sent');
    }

    public function compose() {
        $data['title'] = "Inbox";
        $this->mailbox_model->_table_name = 'tbl_employee';
        $this->mailbox_model->_order_by = 'employee_id';
        $data['get_employee_email'] = $this->mailbox_model->get_by(array('status' => '1'), FALSE);
        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('admin/mailbox/compose_mail', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

    public function send_mail() {

        $discard = $this->input->post('discard', TRUE);
        
        if ($discard) {
            redirect('admin/mailbox/inbox');
        }
        $all_email = $this->input->post('to', TRUE);
        
        // get all email address
        foreach ($all_email as $v_email) {
            $data = $this->mailbox_model->array_from_post(array('subject', 'message_body'));
            if (!empty($_FILES['attach_file']['name'])) {
                $old_path = $this->input->post('attach_file_path');
                if ($old_path) {
                    unlink($old_path);
                }
                $val = $this->mailbox_model->uploadAllType('attach_file');
                $val == TRUE || redirect('admin/mailbox/compose');
                // save into send table
                $data['attach_filename'] = $val['fileName'];
                $data['attach_file'] = $val['path'];
                $data['attach_file_path'] = $val['fullPath'];
                // save into inbox table
                $idata['attach_filename'] = $val['fileName'];
                $idata['attach_file'] = $val['path'];
                $idata['attach_file_path'] = $val['fullPath'];
            } else {
                $data['attach_filename'] = NULL;
                $data['attach_file'] = NULL;
                $data['attach_file_path'] = NULL;
                // save into inbox table
                $idata['attach_filename'] = NULL;
                $idata['attach_file'] = NULL;
                $idata['attach_file_path'] = NULL;
            }
            $data['to'] = $v_email;
            /*
             * Email Configuaration 
             */
            $ginfo = $this->session->userdata('genaral_info');
            // get company name
            $name = $ginfo[0]->email;
            $info = $data['subject'];
            // set from email
            $from = array($name, $info);
            // set sender email
            $to = $v_email;
            //set subject
            $subject = $data['subject'];
            $data['employee_id'] = $this->session->userdata('employee_id');
            $data['message_time'] = date('Y-m-d H:i:s');
            // save into send 
            $this->mailbox_model->_table_name = 'tbl_send';
            $this->mailbox_model->_primary_key = 'send_id';
            $send_id = $this->mailbox_model->save($data);
            // get mail info by send id to send
            $this->mailbox_model->_table_name = 'tbl_send';
            $this->mailbox_model->_order_by = 'send_id';
            $data['read_mail'] = $this->mailbox_model->get_by(array('send_id' => $send_id), true);
            // set view page
            $view_page = $this->load->view('admin/mailbox/read_mail', $data, TRUE);
            $send_email = $this->mail->sendEmail($from, $to, $subject, $view_page);
            // save into inbox table procees 
            $idata['to'] = $ginfo[0]->email;
            $idata['from'] = $data['to'];
            $idata['subject'] = $data['subject'];
            $idata['message_body'] = $data['message_body'];
            $idata['message_time'] = date('Y-m-d H:i:s');
            // save into inbox
            $this->mailbox_model->_table_name = 'tbl_inbox';
            $this->mailbox_model->_primary_key = 'inbox_id';
            $this->mailbox_model->save($idata);
        }
        if ($send_email) {
            $type = "success";
            $message = "Your message has been sent.";
            set_message($type, $message);
            redirect('admin/mailbox/sent');
        } else {
            show_error($this->email->print_debugger());
        }
    }

}
