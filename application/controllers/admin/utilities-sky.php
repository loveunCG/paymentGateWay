<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utilities extends Admin_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('utilities_model');
	}
	
	public function qb_bills()
	{
		$data['title'] = "Create QB Bills";

        $this->utilities_model->_table_name = "tbl_vendors"; 
		$this->utilities_model->_order_by = "vendor_id";
		$data['vendor_info'] = $this->utilities_model->get();
		
		$flag = $this->input->post("sbtn",true);
		if($flag){
			$data['month'] = $this->input->post("txtmonth",true);
			$data['vendor_id'] = $this->input->post("vendor_name",true);
			
			$data['qb_bills_data'] = $this->utilities_model->get_bill_details($data['month'],$data['vendor_id']);
			$data['reference'] = random_string('numeric',8);
		}
        $data['subview'] = $this->load->view('admin/utilities/qb_bills', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
	}
	
}

?>