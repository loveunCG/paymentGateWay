<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Intro extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('emp_model');

        //$this->load->model('admin_model');
    }
    
    public function index() {
        $data['subview'] = $this->load->view('intro/home', $data, TRUE);
        $this->load->view('intro/layout', $data);
    }

    public function product_catalog() {
        $sub_menu = $this->uri->rsegment(3);
        $data['category'] = $sub_menu;
         $data['subview'] = $this->load->view('intro/catalog', $data, TRUE);
        $this->load->view('intro/layout', $data);
    }

    public function business_access() {

        $sub_menu = $this->uri->rsegment(3);
        $data['category'] = $sub_menu;
        $data['subview'] = $this->load->view('intro/business', $data, TRUE);
        $this->load->view('intro/layout', $data);
    }

    public function about_us() {
        $sub_menu = $this->uri->rsegment(3);
        $data['categorys'] = $sub_menu;
        $data['subview'] = $this->load->view('intro/about_us', $data, TRUE);
        $this->load->view('intro/layout', $data);
    }

    public function contact_us() {
        $sub_menu = $this->uri->rsegment(3);
        $data['info'] = $this->emp_model->get_tbl_gsetting();
        $data['category'] = $sub_menu;
        $data['subview'] = $this->load->view('intro/contact_us', $data, TRUE);
        $this->load->view('intro/layout', $data);
    }

    public function login_user() {
      $sub_menu = $this->uri->rsegment(3);
      $data['category'] = $sub_menu;
      $this->load->view('intro/login_user.php', $data);
    }

    public function success() {
      $data['subview'] = $this->load->view('intro/success', $data, TRUE);
      $this->load->view('intro/layout', $data);
    }

    public function failed() {
      $data['subview'] = $this->load->view('intro/failed', $data, TRUE);
      $this->load->view('intro/layout', $data);
    }


}
