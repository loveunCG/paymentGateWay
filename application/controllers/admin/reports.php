<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attendance
 *
 * @author NaYeM
 */
class Reports extends Admin_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('reports_model');

    }
	// social security html view
	public function ss_reports()
	{
		$data['title'] = "Social Security Reports"; //Page title
        $flag = $this->input->post('sbtn', TRUE);
		if(!empty($flag))
		{
			$data['flag'] = 1;
			$data['month'] = $this->input->post('txtmonth');
			$data['social_security'] = $this->reports_model->get_emp_salary_details($data['month'],'ss');
		}
        $data['subview'] = $this->load->view('admin/reports/ss_reports', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
	}
	
	//social security PDF View
	public function ss_pdf($year,$month)
	{
		if(empty($year) || empty($month))
		{
			redirect("admin/reports/ss_reports");
		}
		$data['title'] = "Social Security Reports";
		$data['month'] = date('Y-m',strtotime("$year-$month"));
		$data['social_security']  = $this->reports_model->get_emp_salary_details($data['month'],'ss');
		
		$viewfile = $this->load->view('admin/reports/ss_pdf', $data,TRUE);
		//echo $viewfile;die();
        $this->load->helper('dompdf');
        pdf_create($viewfile, 'Social Security Report For '.date('M-Y',strtotime("$year-$month")),TRUE,'a4');
	}
	
	//NHI html view
	public function nhi_reports()
	{
		$data['title'] = "National Health Insurance Reports"; //Page title
        $flag = $this->input->post('sbtn', TRUE);
		if(!empty($flag))
		{
			$data['flag'] = 1;
			$data['month'] = $this->input->post('txtmonth');
			$data['nhi_history'] = $this->reports_model->get_emp_salary_details($data['month'],'nhi');
			
			
			//echo "<pre>".print_r($data,1);die;
		}
        $data['subview'] = $this->load->view('admin/reports/nhi_reports', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
	}
	//NHI Pdf view
	public function nhi_pdf($year,$month)
	{
		if(empty($year) || empty($month))
		{
			redirect("admin/reports/ss_reports");
		}
		$data['title'] = "National Health Insurance Reports"; //Page title
		$data['flag'] = 1;
		$data['month'] = date('Y-m',strtotime("$year-$month"));
		$data['nhi_history'] = $this->reports_model->get_emp_salary_details($data['month'],'nhi');
		
		$viewfile = $this->load->view('admin/reports/nhi_pdf', $data,TRUE);
		//echo $viewfile;die();
        $this->load->helper('dompdf');
        pdf_create($viewfile, 'National Health Insurance Report For '.date('M-Y',strtotime("$year-$month")),TRUE,'a4');
	}
	//payroll tax html view
	public function paytax_reports()
	{
		$data['title'] = "Payroll Tax Report"; //Page title
		$this->reports_model->_table_name = "tbl_allow_ded";
		$this->reports_model->_order_by = "id";
		
        $data['global_allowance'] = $this->reports_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		$flag = $this->input->post('sbtn', TRUE);
		if(!empty($flag))
		{
			$data['flag'] = 1;
			$data['month'] = $this->input->post('txtmonth');
			$data['paytax_history'] = $this->reports_model->get_emp_salary_details($data['month'],'pay_tax');
		}
        $data['subview'] = $this->load->view('admin/reports/paytax_reports', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
	}
	
	//payroll tax pdf view
	public function paytax_pdf($year,$month)
	{
		
		$this->reports_model->_table_name = "tbl_allow_ded";
		$this->reports_model->_order_by = "id";
		
        $data['global_allowance'] = $this->reports_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		if(empty($year) || empty($month))
		{
			redirect("admin/reports/paytax_reports");
		}
		$data['title'] = "Payroll Tax Reports";
		$data['month'] = date('Y-m',strtotime("$year-$month"));
		$data['paytax_history'] = $this->reports_model->get_emp_salary_details($data['month'],'pay_tax');
		
		$viewfile = $this->load->view('admin/reports/paytax_pdf', $data,TRUE);
		//echo $viewfile;die();
        $this->load->helper('dompdf');
        pdf_create($viewfile, 'Payroll Tax Report For - '.date('M-Y',strtotime("$year-$month")),TRUE,'a4');
	}
}

?>