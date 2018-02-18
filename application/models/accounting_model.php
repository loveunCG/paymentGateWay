<?php

/**
 * Description of employee_model
 *
 * @author NaYeM
 */
class Accounting_model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;
	
	
	public function accounts_type()
	{
		$data = $this->db->get('tbl_accounts_type')->result_array();
		//$data = $this->db->order_by('created', 'desc')->get('tbl_cpf')->result_array();
		//echo $this->db->last_query();;
		return $data;
	}
	public function account_group_by_id($id='')
	{
	 $data = $this->db->get_where('tbl_accounts_type',array('id'=>$id))->row();
	 //print_r($data);die;
	 return $data;
	}
	/*---------------- Account  -------------------*/
	public function account()
	{
		$this->db->select('tbl_accounts.*,tbl_accounts_type.account_group,tbl_accounts_type.account_group_type');
		$this->db->from('tbl_accounts');
		$this->db->join('tbl_accounts_type', 'tbl_accounts.account_group = tbl_accounts_type.id', 'left');
		$query_result = $this->db->get();
		//$data = $this->db->order_by('created', 'desc')->get('tbl_cpf')->result_array();
		//echo $this->db->last_query();;
		return $query_result->result();
	}
	public function account_by_id($id='')
	{
	 $data = $this->db->get_where('tbl_accounts',array('id'=>$id))->row();
	 //print_r($data);die;
	 return $data;
	}

public function auths_by_id($id='')
	{
	 $data = $this->db->get_where('quickbooks_auths',array('quickbooks_auth_id'=>$id))->row();
	 //print_r($data);die;
	 return $data;
	}
}
