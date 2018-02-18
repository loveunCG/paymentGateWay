<?php

/**
 * Description of Reports_Model
 *
 * @author NaYeM
 */
class Reports_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

	public function get_emp_salary_details($month,$report)
	{
		$this->db->select('tbl_salary_payment.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_employee_payroll.payment_frequency,tbl_employee_payroll.basic_salary as salary,tbl_employee_payroll.job_sector', FALSE);
		$this->db->from('tbl_salary_payment');
        $this->db->join('tbl_employee', 'tbl_salary_payment.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_employee_payroll', 'tbl_salary_payment.employee_id = tbl_employee_payroll.employee_id', 'left');
		$this->db->where('tbl_employee.id_gsettings' , $this->session->userdata('id_gsettings'));
		
		if(!empty($month))
		{
			//$this->db->where('tbl_salary_payment.payment_date >= ',$start_date);
			//$this->db->where('tbl_salary_payment.payment_date <= ',$end_date);
			
			$this->db->where('MONTH(tbl_salary_payment.payment_date) = "'.date('m',strtotime($month)).'"',NULL, FALSE);
			$this->db->where('YEAR(tbl_salary_payment.payment_date) = "'.date('Y',strtotime($month)).'"',NULL, FALSE);
			
			//$this->db->where('MONTH(tbl_salary_payment.end_payment_date) = "'.date('m',strtotime($end_date)).'"',NULL, FALSE);
			//$this->db->where('YEAR(tbl_salary_payment.end_payment_date) = "'.date('Y',strtotime($end_date)).'"',NULL, FALSE);
		}
		
		$this->db->order_by('tbl_salary_payment.employee_id','ASC');
		$query_result = $this->db->get();
		//$query_result1 = $this->db->last_query();
		$result = $query_result->result();
		
		$data = array();
		foreach($result as $pay)
		{
			$emp_id = $pay->employee_id;
			
			if(empty($data[$emp_id]['ss_amount']))
			{
				$cnt = 0;
			}
			$data[$emp_id]['employee_id'] = $pay->employee_id; 
			$data[$emp_id]['employee_name'] = $pay->first_name." ". $pay->last_name;
			$data[$emp_id]['employment_id'] = $pay->employment_id; 
			
			if( $pay->payment_frequency == '1')
			{
				$data[$emp_id]['payment_frequency'] = 'W';
			}
			else if( $pay->payment_frequency == '2')
			{
				$data[$emp_id]['payment_frequency'] = 'B'; 
			}
			else if( $pay->payment_frequency == '3')
			{
				$data[$emp_id]['payment_frequency'] = 'M'; 
			}
			
			$data[$emp_id]['gender'] = $pay->gender;
			$data[$emp_id]['ss_amount'][$cnt] = $pay->social_security;
			$data[$emp_id]['nhi_amount'][$cnt] = $pay->nhi_deduction;
			$data[$emp_id]['spouse_nhi_amount'][$cnt] = $pay->spouse_nhi_deduction;
			$data[$emp_id]['payroll_tax_amount'][$cnt] = $pay->payroll_tax_deduction;
			$data[$emp_id]['leave_deduction'][$cnt] = $pay->leave_deduction;
			
			$data[$emp_id]['basic_salary'][$cnt] = $pay->basic_salary;
			$data[$emp_id]['global_allowance'][$cnt] = explode("<-->",$pay->global_allowance);
			if(!empty($data[$emp_id]['tot_salary']))
			{
				$data[$emp_id]['tot_salary'] += $pay->basic_salary;
			}
			else
			{
				$data[$emp_id]['tot_salary'] = $pay->basic_salary;
			}
			$data[$emp_id]['salary'] = $pay->salary;
			
			if($report == 'ss')
			{
				
				//get social security details from table cpf
				$where['year'] = date('Y',strtotime($month));
				$where['empAge'] = date('Y') - date('Y',strtotime($pay->date_of_birth));
				$where['sector'] = $pay->job_sector;
				
				$data[$emp_id]['ss_detail'] = $this->get_social_security($where);
			}
			else if($report == 'nhi')
			{
				
				$where['year'] = date('Y',strtotime($month));
				$where['empAge'] = date('Y') - date('Y',strtotime($pay->date_of_birth));
				$where['sector'] = $pay->job_sector;
				
				$data[$emp_id]['nhi_deduct_detail'] = $this->get_nhi_details($where);
			}
			else if($report == 'pay_tax')
			{
				
				//get social security details from table cpf
				$where['year'] = date('Y',strtotime($month));
				$where['empAge'] = date('Y') - date('Y',strtotime($pay->date_of_birth));
				$where['sector'] = $pay->job_sector;
				
				$data[$emp_id]['pay_tax_detail'] = $this->get_payroll_tax($where);
			}
			$cnt++;
		}
		return $data;
		//echo "<pre>".print_r($result1,1);die;
	}
	
	public function get_social_security($data)
	{
		$this->db->where('year', $data['year']);
		$this->db->where('sector', $data['sector']);
		$this->db->where( 'emp_min_age <= ', $data['empAge']);
		$this->db->where( 'emp_max_age >= ', $data['empAge']);
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		
		$q = $this->db->get('tbl_cpf');
		return $q->row();
	}
	
	public function get_nhi_details($data)
	{
		$this->db->where('year', $data['year']);
		$this->db->where('sector', $data['sector']);
		$this->db->where( 'emp_min_age <= ', $data['empAge']);
		$this->db->where( 'emp_max_age >= ', $data['empAge']);
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		
		$q = $this->db->get('tbl_nhi');
		return $q->row();
	}
	
	public function get_payroll_tax($data)
	{
		$this->db->where('year', $data['year']);
		$this->db->where('sector', $data['sector']);
		$this->db->where( 'emp_min_age <= ', $data['empAge']);
		$this->db->where( 'emp_max_age >= ', $data['empAge']);
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		
		$q = $this->db->get('tbl_payroll_tax');
		return $q->row();
	}
}
