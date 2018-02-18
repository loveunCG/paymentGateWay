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
			
			require_once('/home3/pappiean/public_html/payrollupdates/qbweb-app/docs/partner_platform/example_app_ipp_v3/config.php');
		
			$realmID=123145830971972;
			
			$BillService = new QuickBooks_IPP_Service_Bill();

			$Bill = new QuickBooks_IPP_Object_Bill();

			$Bill->setDocNumber($data['reference']);
			$Bill->setTxnDate('Y-m-d');
			//$Bill->setVendorRef('{-'.$data['vendor_id'].'}');
			$Bill->setVendorRef('{-31}');

			$Line = new QuickBooks_IPP_Object_Line();
			$Line->setAmount(650);
			$Line->setDetailType('AccountBasedExpenseLineDetail');

			$AccountBasedExpenseLineDetail = new QuickBooks_IPP_Object_AccountBasedExpenseLineDetail();
			$AccountBasedExpenseLineDetail->setAccountRef('{-17}');

			$Line->setAccountBasedExpenseLineDetail($AccountBasedExpenseLineDetail);

			$Bill->addLine($Line);
			
			if ($id = $BillService->add($Context, $realm, $Bill))
			{
				//print('New bill id is: ' . $id);
			}
			else
			{
				//print('Bill add failed...? ' . $BillService->lastError());
			}
			
		}
        $data['subview'] = $this->load->view('admin/utilities/qb_bills', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
	}
	
}

?>