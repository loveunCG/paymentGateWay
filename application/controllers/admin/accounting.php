<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounting extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('accounting_model');
		$this->load->model('settings_model');
    }
	
	/*------ Account Group ------*/
	public function accounts_type()
	{
		$data['title'] = "Accounts Type";
		$this->accounting_model->_table_name = "tbl_accounts_type"; 
		$this->accounting_model->_order_by = "id";
        $data['account_group'] = $this->accounting_model->get();
		
        $data['subview'] = $this->load->view('admin/accounting/accounts_type', $data, TRUE);
		$this->load->view('admin/_layout_main', $data);
	}
	
	public function add_accounts_type($id = NULL) {
        $data['title'] = "Add Accounts Type";
		// echo  $id; die;
        if (!empty($id)) {// retrive data from db by id          
            $data['accounts_type_info'] = $this->accounting_model->account_group_by_id($id);
			
			if (empty($data['accounts_type_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/accounting/add_accounts_type');
            }
        }
		
        //page load
        $data['subview'] = $this->load->view('admin/accounting/add_accounts_type', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    public function save_accounts_type($id = NULL) {
              
        // input data
		//$ttl =array('total_wages' =>$this->input->post('employee_wage', TRUE)+$this->input->post('employer_wage', TRUE));
		$data = $this->accounting_model->array_from_post(array('account_group','account_group_type','credit_debit')); //input post
		//$data = array_merge($dt,$ttl);
		
		//$data['id_gsettings'] = $this->session->userdata('id_gsettings');
		
		$this->accounting_model->_table_name = "tbl_accounts_type"; //table name 
        $this->accounting_model->_primary_key = "id"; // $id
		if(!empty($id)){
		//$cpf_id = $id;
        $this->accounting_model->save($data, $id);
		}
		else
		{
		$this->accounting_model->save($data);
		}
        // messages for user
        $type = "success";
        $message = "Account Type Successfully Saved!";
        set_message($type, $message);
        redirect('admin/accounting/accounts_type'); //redirect page
    }
	
	 public function delete_account_group($id = NULL) {

        $this->accounting_model->_table_name = "tbl_accounts_type"; //table name 
        $this->accounting_model->_primary_key = "id"; // $id
        $this->accounting_model->delete($id); // delete 
        // messages for user
        $type = "success";
        $message = "Account Type Successfully Delete !";
        set_message($type, $message);
        redirect('admin/accounting/accounts_type'); //redirect page
    }
	
	/*------ Account ------*/
	public function account()
	{
		$data['title'] = "Account";
		
		$data['account_info'] = $this->accounting_model->account();
		
        $data['subview'] = $this->load->view('admin/accounting/account', $data, TRUE);
		$this->load->view('admin/_layout_main', $data);
	}
	
	public function add_account($id = NULL) {
        $data['title'] = "Add Account";
		//account group info
		
		$this->accounting_model->_table_name = "tbl_accounts_type"; 
		$this->accounting_model->_order_by = "id";
        $data['account_group'] = $this->accounting_model->get();
		$data['account_name'] = $this->accounting_model->account();
		
		// echo  $id; die;
        if (!empty($id)) {// retrive data from db by id            
            $data['account_info'] = $this->accounting_model->account_by_id($id);
			
			if (empty($data['account_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/accounting/add_account');
            }
        }
		
        //page load
        $data['subview'] = $this->load->view('admin/accounting/add_account', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    public function save_account($id = NULL) {
              
        // input data
		//$ttl =array('total_wages' =>$this->input->post('employee_wage', TRUE)+$this->input->post('employer_wage', TRUE));
		$data = $this->accounting_model->array_from_post(array('account_name','account_group','account_id')); //input post
		//$data = array_merge($dt,$ttl);
		
		//$data['id_gsettings'] = $this->session->userdata('id_gsettings');
		
		$this->accounting_model->_table_name = "tbl_accounts"; //table name 
        $this->accounting_model->_primary_key = "id"; // $id
		if(!empty($id)){
		//$cpf_id = $id;
        $this->accounting_model->save($data, $id);
		}
		else
		{
		$this->accounting_model->save($data);
		}
		
		require_once('/home3/pappiean/public_html/payrollupdates/qbweb-app/docs/partner_platform/example_app_ipp_v3/config.php');
		
		$realmID=123145830971972;

		$AccountService = new QuickBooks_IPP_Service_Account();

		$Account = new QuickBooks_IPP_Object_Account();

		$Account->setName($data['account_name']);
		
		$Account->setDescription($data['account_name']);
		
		$Account->setAccountType('Income');

		if ($resp = $AccountService->add($Context, $realmID, $Account))
		{
			//print('Our new Account ID is: [' . $resp . ']');
		}
		else
		{
			//print($AccountService->lastError());
		}
		
        // messages for user
        $type = "success";
        $message = "Account Successfully Saved!";
        set_message($type, $message);
        redirect('admin/accounting/account'); //redirect page
    }
	
	 public function delete_account($id = NULL) {

        $this->accounting_model->_table_name = "tbl_accounts"; //table name 
        $this->accounting_model->_primary_key = "id"; // $id
        $this->accounting_model->delete($id); // delete 
        // messages for user
        $type = "success";
        $message = "Account Successfully Delete !";
        set_message($type, $message);
        redirect('admin/accounting/account'); //redirect page
    }
	
	/*------ Vendor ------*/
	public function vendors()
	{
		$data['title'] = "Vendors";
		
		$this->accounting_model->_table_name = "tbl_vendors"; 
		$this->accounting_model->_order_by = "vendor_id";
		$data['vendor_info'] = $this->accounting_model->get();
		
        $data['subview'] = $this->load->view('admin/accounting/vendors', $data, TRUE);
		$this->load->view('admin/_layout_main', $data);
	}
	
	public function add_vendors($id = NULL) {
        $data['title'] = "Add Vendors";
		//account group info
		
		$this->accounting_model->_table_name = "tbl_accounts"; 
		$this->accounting_model->_order_by = "id";
        $data['account_group'] = $this->accounting_model->get();
		
		// echo  $id; die;
        if (!empty($id)) {// retrive data from db by id     
			$this->accounting_model->_table_name = "tbl_vendors";
			$this->accounting_model->_order_by = "vendor_id";         
            $data['vendor_info'] = $this->accounting_model->get_by(array("vendor_id" => $id),true);
			
			if (empty($data['vendor_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/accounting/add_vendors');
            }
        }
		
        //page load
        $data['subview'] = $this->load->view('admin/accounting/add_vendors', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    public function save_vendors($id = NULL) {
              
        // input data
		//$ttl =array('total_wages' =>$this->input->post('employee_wage', TRUE)+$this->input->post('employer_wage', TRUE));
		$data = $this->accounting_model->array_from_post(array('vendor_name','company_name','main_phone','address','main_email','website','account_with_vendor','payment_terms','general_journal')); //input post
		//$data = array_merge($dt,$ttl);
		
		//$data['id_gsettings'] = $this->session->userdata('id_gsettings');
		
		$this->accounting_model->_table_name = "tbl_vendors"; //table name 
        $this->accounting_model->_primary_key = "vendor_id"; // $id
		if(!empty($id)){
		//$cpf_id = $id;
        $this->accounting_model->save($data, $id);
		}
		else
		{
		$this->accounting_model->save($data);
		}
		
		require_once('/home3/pappiean/public_html/payrollupdates/qbweb-app/docs/partner_platform/example_app_ipp_v3/config.php');
		
		$realmID=123145830971972;

		$VendorService = new QuickBooks_IPP_Service_Vendor();

		$Vendor = new QuickBooks_IPP_Object_Vendor();
		
		$Vendor->setGivenName($data['vendor_name']);
		
		$Vendor->setDisplayName($data['vendor_name']);
		
		$Vendor->setCompanyName($data['company_name']);
		
		$Email = new QuickBooks_IPP_Object_PrimaryEmailAddr();

		$Email->setAddress($data['main_email']);

		$Email->setTag('Business');

		$Vendor->setEmail($Email);
		
		$Phone = new QuickBooks_IPP_Object_PrimaryPhone();

		$Phone->setDeviceType('Phone');

		$Phone->setFreeFormNumber($data['main_phone']);

		$Phone->setTag('Phone');

		$Vendor->setPhone($Phone);
		
		$Website = new QuickBooks_IPP_Object_WebAddr();

		$Website->setURI($data['website']);

		$Website->setTag('Business');

		$Vendor->setWebAddr($Website);
		
		$Vendor->setTermRef($data['payment_terms']);

		if ($resp = $VendorService->add($Context, $realmID, $Vendor))
		{
			//print('Our new Vendor ID is: [' . $resp . ']');
		}
		else
		{
			//print($VendorService->lastError($Context));
		}
		
        // messages for user
        $type = "success";
        $message = "Vendors Successfully Saved!";
        set_message($type, $message);
        redirect('admin/accounting/vendors'); //redirect page
    }
	
	 public function delete_vendors($id = NULL) {

        $this->accounting_model->_table_name = "tbl_vendors"; //table name 
        $this->accounting_model->_primary_key = "vendor_id"; // $id
        $this->accounting_model->delete($id); // delete 
        // messages for user
        $type = "success";
        $message = "Vendors Successfully Delete !";
        set_message($type, $message);
        redirect('admin/accounting/vendors'); //redirect page
    }
	
	
	/*------ Quickbook Classes ------*/
	public function quickbook_classes()
	{
		$data['title'] = "Quickbook Classes";
		$this->accounting_model->_table_name = "quickbooks_classes"; 
		$this->accounting_model->_order_by = "quickbooks_class_id";
        $data['qb_class_info'] = $this->accounting_model->get();
		
        $data['subview'] = $this->load->view('admin/accounting/quickbook_classes', $data, TRUE);
		$this->load->view('admin/_layout_main', $data);
	}
	
	public function add_quickbooks_class($id = NULL) {
        $data['title'] = "Add Quickbook Classes";
		// echo  $id; die;
        if (!empty($id)) {// retrive data from db by id          
            $data['qb_class_info'] = $this->accounting_model->get_by(array('quickbooks_class_id' => $id),true);
			
			if (empty($data['accounts_type_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/accounting/add_quickbook_classes');
            }
        }
		
        //page load
        $data['subview'] = $this->load->view('admin/accounting/add_quickbook_classes', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    public function save_quickbooks_class($id = NULL) {
              
        // input data
		//$ttl =array('total_wages' =>$this->input->post('employee_wage', TRUE)+$this->input->post('employer_wage', TRUE));
		$data = $this->accounting_model->array_from_post(array('quickbooks_class_name')); //input post
		//$data = array_merge($dt,$ttl);
		
		//$data['id_gsettings'] = $this->session->userdata('id_gsettings');
		
		$this->accounting_model->_table_name = "quickbooks_classes"; //table name 
        $this->accounting_model->_primary_key = "quickbooks_class_id"; // $id
		if(!empty($id)){
		//$cpf_id = $id;
        $this->accounting_model->save($data, $id);
		}
		else
		{
		$this->accounting_model->save($data);
		}
		
		require_once('/home3/pappiean/public_html/payrollupdates/qbweb-app/docs/partner_platform/example_app_ipp_v3/config.php');
		
		$realmID=123145830971972;
		
		$ClassService = new QuickBooks_IPP_Service_Class();

		$Class = new QuickBooks_IPP_Object_Class();

		$Class->setName($data['quickbooks_class_name']);
		
		if ($resp = $ClassService->add($Context, $realm, $Class))
		{
			//print('Our new class ID is: [' . $resp . ']');
		}
		else
		{
			//print($ClassService->lastError());
		}		
		
        // messages for user
        $type = "success";
        $message = "Quickbook Class Successfully Saved!";
        set_message($type, $message);
        redirect('admin/accounting/quickbook_classes'); //redirect page
    }
	
	
	public function add_quickbook_sysauth($id = NULL) {
        $data['title'] = "QB Online Setup";
		
		require_once('/home3/pappiean/public_html/payrollupdates/qbweb-app/docs/partner_platform/example_app_ipp_v3/config.php');
		
		// echo  $id; die;
        if (!empty($id)) {// retrive data from db by id          
            /* $data['qb_class_info'] = $this->accounting_model->get_by(array('quickbooks_auth_id' => $id),true); */
			
			$data['qb_class_info'] = $this->accounting_model->auths_by_id($id);
			//$this->load->library('session');
			$_SESSION["auth"] = $data['qb_class_info'];
			//$this->session->set_userdata(array(				'auth'       => $data['qb_class_info']			));
			if (empty($data['qb_class_info'])) {
                $type = "error";
                $message = "No Record Found";
                set_message($type, $message);
                redirect('admin/accounting/add_quickbook_sysauth');
            }
        }
		
        //page load
        $data['subview'] = $this->load->view('admin/accounting/add_quickbook_sysauth', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
	
	public function save_quickbooks_sysauth($id = NULL) {
              
        // input data
		//$ttl =array('total_wages' =>$this->input->post('employee_wage', TRUE)+$this->input->post('employer_wage', TRUE));
		$data = $this->accounting_model->array_from_post(array('quickbooks_app_token','app_consumer_key','app_consumer_secret')); //input post
		//$data = array_merge($dt,$ttl);
		
		//$data['id_gsettings'] = $this->session->userdata('id_gsettings');
		
		$this->accounting_model->_table_name = "quickbooks_auths"; //table name 
        $this->accounting_model->_primary_key = "quickbooks_auth_id"; // $id
		if(!empty($id)){
		//$cpf_id = $id;
        $this->accounting_model->save($data, $id);
		}
		else
		{
		$this->accounting_model->save($data);
		}
		
		// messages for user
        $type = "success";
        $message = "QB Online Setup Successfully Saved!";
        set_message($type, $message);
        redirect('admin/accounting/quickbook_auths'); //redirect page
    }
	
	public function quickbook_auths()
	{
		$data['title'] = "QB Online Setup";
		$this->accounting_model->_table_name = "quickbooks_auths"; 
		$this->accounting_model->_order_by = "quickbooks_auth_id";
        $data['qb_class_info'] = $this->accounting_model->get();
		
        $data['subview'] = $this->load->view('admin/accounting/quickbook_auths', $data, TRUE);
		$this->load->view('admin/_layout_main', $data);
	}
	
	
	 public function delete_quickbooks_class($id = NULL) {

        $this->accounting_model->_table_name = "quickbooks_classes"; //table name 
        $this->accounting_model->_primary_key = "quickbooks_class_id"; // $id
        $this->accounting_model->delete($id); // delete 
        // messages for user
        $type = "success";
        $message = "Quickbooks Class Successfully Delete !";
        set_message($type, $message);
        redirect('admin/accounting/quickbook_classes'); //redirect page
    }
	
	public function delete_quickbooks_sysauth($id = NULL) {

        $this->accounting_model->_table_name = "quickbooks_auths"; //table name 
        $this->accounting_model->_primary_key = "quickbooks_auth_id"; // $id
        $this->accounting_model->delete($id); // delete 
        // messages for user
        $type = "success";
        $message = "QB Online Setup Successfully Deleted !";
        set_message($type, $message);
        redirect('admin/accounting/quickbook_auths'); //redirect page
    }
	
	
	public function direct_deposit($val = NULL) { 
			$data['title'] = " Direct_Deposit_Settings"; //Page title
			//Query from DB
			$this->settings_model->_table_name = "tbl_ddsettings"; //table name
		   $this->settings_model->_order_by = "idrn";
			$val = $this->settings_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')), TRUE);



			if ($val) { // get general info by id
				$data['ddinfo'] = $val; // assign value from db    
			}

			
			$data['subview'] = $this->load->view('admin/settings/direct_deposit', $data, TRUE);
			$this->load->view('admin/_layout_main', $data); //page load
		}
		
		public function save_ddinfo($id = NULL) {

			$this->settings_model->_table_name = "tbl_ddsettings"; // table name
			$this->settings_model->_primary_key = "id_gsettings"; // $id

			$data = $this->settings_model->array_from_post(array('idrn', 'ior', 'cn', 'ced', 'achr', 'idn', 'cba', 'cdd', 'ciabb', 'ofin'));

			$this->settings_model->save($data, $id);
			// messages for user
			$type = "success";
			$message = "Direct Deposit Information Successfully Update!";
			set_message($type, $message);
			redirect('admin/settings/direct_deposit');
			 
		}
	
}
