<?php

class Utilities_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;
	
	public function get_bill_details($month,$vendor)
	{
		$this->db->select("tbl_vendors.vendor_name,tbl_account_payment.*,sum(amount) as tot_amount");
		$this->db->from("tbl_vendors");
        
		$this->db->join('tbl_accounts', 'tbl_vendors.general_journal = tbl_accounts.account_id', 'left');
		$this->db->join('tbl_account_payment', 'tbl_account_payment.account_id = tbl_accounts.account_id', 'left');
		
		$this->db->where("DATE_FORMAT(tbl_account_payment.pay_date,'%Y-%m')",$month);
		$this->db->where("tbl_vendors.vendor_id",$vendor);
		
		$this->db->group_by('tbl_account_payment.account_id');
		
		$query = $this->db->get();
		return $query->result();
	}

}