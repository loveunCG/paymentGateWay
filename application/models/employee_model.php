<?php

/**
 * Description of employee_model
 *
 * @author NaYeM
 */
class Employee_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_add_department_by_id($department_id) {
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->from('tbl_department');
        $this->db->join('tbl_designations', 'tbl_department.department_id = tbl_designations.department_id', 'left');
        $this->db->where('tbl_department.department_id', $department_id);

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

    public function rate_setting($agenttable =null,$id=null){        

        if (!empty($id)) {
            $sql  = "alter table tbl_channel_rate drop ".$agenttable;
            $query_result = $this->db->query($sql);
        }
        if (!empty($agenttable)) {
           $sql  = "alter table tbl_channel_rate add ".$agenttable." varchar(10) not null default '0'";
            $query_result = $this->db->query($sql);
        }

    }      

    public function all_emplyee_info($id = NULL, $for = NULL) {

         $employee_id = $this->input->post('employee_id');
         $emp_email = $this->input->post('emp_email');
         $qq = $this->input->post('qq');
         $emp_group = $this->input->post('emp_group');
         $phone = $this->input->post('phone');
         $status = $this->input->post('status');
         $agent_id = $this->input->post('agent_id');
         $channel = $this->input->post('channel');
		 $limit_mon = $this->input->post('limit_mon');         

		if ($channel) {
        	$this->db->select('*', FALSE);
        	$this->db->from('tbl_channel');
        	$this->db->where('id', $channel);
        	$query_result01 = $this->db->get();
        	$result01 = $query_result01->row();
        	if ($result01->channel_type==1) {
              	$channel_type_info = "channel_online" ; 
            }elseif ($result01->channel_type==2) {
            	$channel_type_info = "channel_card" ;
            }elseif ($result01->channel_type==3) {
            	$channel_type_info = "channel_alipay" ;
            }elseif ($result01->channel_type==4) {
            	$channel_type_info = "channel_tenpay" ;
            }elseif ($result01->channel_type==5) {
            	$channel_type_info = "channel_weixin" ;
            }elseif ($result01->channel_type==6) {
            	$channel_type_info = "channel_wapalipay" ;
            }elseif ($result01->channel_type==7) {
            	$channel_type_info = "channel_waptenpay" ;
            }elseif ($result01->channel_type==8) {
            	$channel_type_info = "channel_wapqq" ;
            }elseif ($result01->channel_type==9) {
            	$channel_type_info = "channel_wapweixin" ;
            }elseif ($result01->channel_type==10) {
            	$channel_type_info = "channel_daifu" ;
            }

        }                             

        $this->db->select('tbl_employee.employee_id as empId,tbl_employee.*,tbl_employee_group.group_name', FALSE);
        $this->db->from('tbl_employee');
		$this->db->join('tbl_employee_group', 'tbl_employee_group.id = tbl_employee.usr_gourp', 'left');
		$this->db->join('tbl_proxy', 'tbl_proxy.proxy_id = tbl_employee.agent_group', 'left');		        
        if (!empty($employee_id)) {
        	$this->db->where('tbl_employee.employee_id', $employee_id);
        }
        if (!empty($agent_id)) {
        	$this->db->where('tbl_employee.agent_group', $agent_id);
        }        
        if (!empty($emp_email)) {
        	$this->db->where('tbl_employee.employment_id', $emp_email);
        }
        if (!empty($limit_mon)) {
        	$this->db->where('tbl_employee.usr_amount > '.$limit_mon,NULL,false);
        }        
        if (!empty($qq)) {
        	$this->db->where('tbl_employee.status', $qq);
        }
        if (!empty($channel)) {
        	$this->db->where('tbl_employee.'.$channel_type_info, $channel);
        }        
        if (!empty($phone)) {
        	$this->db->where('tbl_employee.usr_mobile', $phone);
        }
        if (!empty($emp_group)) {
        	$this->db->where('tbl_employee.usr_gourp', $emp_group);
        }        
        if ($status==1) {
        	$this->db->where('tbl_employee.usr_status', 1);
        }elseif ($status==2) {
        	$this->db->where('tbl_employee.usr_status', 2);
        }elseif ($status==3) {
        	$this->db->where('tbl_employee.usr_status', 3);
        }elseif ($status==4) {
        	$this->db->where('tbl_employee.usr_status', 4);
        }                                

		if (!empty($id)) {
            $this->db->where('tbl_employee.employee_id', $id);
            $query_result = $this->db->get();
            if($for == 'QR')
				$result = $query_result->result_array();
			else
				$result = $query_result->row();
        } else {
            $query_result = $this->db->get();
			//echo $this->db->last_query();
            $result = $query_result->result();
        }       
        return $result;
    }

    public function bankinfo() {
        $this->db->select('tbl_channel_rate.*', FALSE);

        $this->db->from('tbl_channel_rate');
		$this->db->where('use_online', 1);

            $query_result = $this->db->get();
			//echo $this->db->last_query();
            $result = $query_result->result();
 
        return $result;
    }    
	
	public function all_designation_department_info($id) {
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);       
        $this->db->from('tbl_designations');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
		$this->db->where('tbl_designations.designations_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result_array();
        return $result;
    }
	
    public function get_employee_award_by_id($id=NULL) {

        $this->db->select('tbl_employee_award.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->from('tbl_employee_award');
        $this->db->join('tbl_employee', 'tbl_employee_award.employee_id = tbl_employee.employee_id', 'left');
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
        if (!empty($id)) {
            $this->db->where('tbl_employee_award.employee_award_id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }
        return $result;
    }

	 public function get_employee_entitlement_by_id($id=NULL) {

        $this->db->select('tbl_employee_entitlement.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_leave_category.*', FALSE);
        $this->db->from('tbl_employee_entitlement');
        $this->db->join('tbl_employee', 'tbl_employee_entitlement.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_leave_category', 'tbl_employee_entitlement.leave_category_id = tbl_leave_category.leave_category_id', 'left');
		
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
        if (!empty($id)) {
            $this->db->where('tbl_employee_entitlement.employee_entitlement_id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }
        return $result;
    } 
	
	public function get_exist_employee_entitlement_by_id($emp_id, $leave_id, $leave_period) {
		  
        $this->db->select('*', FALSE);  
		$this->db->from('tbl_employee_entitlement');
		$this->db->where('employee_id', $emp_id);
		$this->db->where('leave_category_id', $leave_id);
		$this->db->where('leave_periods', $leave_period);
		$this->db->group_by('employee_id');
        $query_result = $this->db->get();
		 if( $query_result->num_rows() > 0 )
		  {
			return $query_result->row();
		  } 
		//$result = $query_result->result();
		 return FALSE;
    }

	public function get_sytem_fee_info() {		  
        $this->db->select('*', FALSE);  
		$this->db->from('tbl_sdl');
		$this->db->where('id', 1);
        $query_result = $this->db->get();
		return $query_result->row();
    }    
    
    
    //****@sunny get user plan via user id stats******
    public function get_user_plan_via_user_id($id) {
		 
        $this->db->select('*', FALSE);  
		$this->db->from('tbl_user_plan');
		$this->db->where('user_id', $id);
        $query_result = $this->db->get();
		 if( $query_result->num_rows() > 0 )
		  {
			return $query_result->row();
		  } 
		//$result = $query_result->result();
		 return FALSE;
    }
    //****@sunny get user plan via user id ends ****
	
	public function total_attebdance_leave_days($year, $emp_id,$leave_category)
	{
		$this->db->select('*,count(leave_category_id) as taken_leave',false);
		$this->db->from('tbl_attendance');
		$this->db->where('YEAR(date) = '.$year,NULL,false);
		$this->db->where('employee_id',$emp_id);
		$this->db->where('leave_category_id',$leave_category);
		$this->db->group_by('leave_category_id');
		$query = $this->db->get();
		//echo $query = $this->db->last_query();
		return $query->row();
	}
	
	public function getEmployeeByEmail($email) 
	{

		$q = $this->db->get_where('tbl_employee', array('email' => $email), 1); 
		  if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 
		
		  return FALSE;

	}
	
	public function getEmployeeById($id=null) 
	{
		$q = $this->db->get_where('tbl_employee', array('employee_id' => $id,'id_gsettings' => $this->session->userdata('id_gsettings')), 1);
		//echo $this->db->last_query();die; 
		  if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 
		
		  return FALSE;

	}
	
	public function getEmpByEmploymentId($employment_id) 
	{
		$q = $this->db->get_where('tbl_employee', array('employment_id' => $employment_id), 1); 
		  if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 
		  return FALSE;
	}
	
	public function getCountryByName($name) 
	{
		$this->db->select('*')->from('countries')->like('countryName', $name, 'both');
		$q = $this->db->get();
		if($q->num_rows() > 0) {
			return $q->row();
			}				
			return FALSE;
	 }

	public function add_employee($data = array())
	{
		$insertIds  = array();
		foreach ($data as $value) {
			$value['id_gsettings'] = $this->session->userdata('id_gsettings');
			$this->db->insert('tbl_employee', $value);
			$insertIds[] = $this->db->insert_id();			
		}
		return $insertIds;
	}
	
	public function export_employee()
	{ 
	 		$this->load->dbutil();
	        $query = $this->db->query("SELECT tbl_employee.employment_id as 'Employment Id', tbl_employee.first_name as 'First Name', tbl_employee.last_name as 'Last Name', tbl_employee.date_of_birth as 'Date of Birth', tbl_employee.gender as 'Gender', tbl_employee.maratial_status as 'Maratial Status', tbl_employee.father_name as 'Father Name', N.countryName as 'Nationality', tbl_employee.nric_no as 'NRIC No', tbl_employee.passport_number as 'Passport Number', tbl_employee.present_address as 'Present Address', tbl_employee.city as 'City', C.countryName as 'Country', tbl_employee.mobile as 'Mobile', tbl_employee.phone as 'Emergency Phone', tbl_employee.email as 'Email', tbl_employee.joining_date as 'Joining Date' FROM (tbl_employee) LEFT JOIN countries as C ON C.idCountry = tbl_employee.country_id LEFT JOIN countries as N ON N.idCountry = tbl_employee.nationality");
	        $delimiter = ",";
	        $newline = "\r\n";
	        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
			if($data){
				return $data;
			}
			else {
				return FALSE;
			}
	}
	
	function updateQrcode($data,$id) {
		$this->db->where('employee_id', $id);
		$this->db->update('tbl_employee', $data);
    }
    //***pulkit 15 august 2016 
    public function select_dd_bank_info($id) {
		$this->db->select('*');
		$this->db->from('tbl_employee_bank');
		$this->db->where("employee_id",$id);
        $query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}
	
		public function getEmpPayrollByEmploymentId($employment_id) 
	{
		$q = $this->db->get_where('tbl_employee_payroll', array('employee_id' => $employment_id), 1); 
		  if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 
		  return FALSE;
	}

		public function getSalaryPaymentByEmploymentId($employment_id) 
	{
		$q = $this->db->get_where('tbl_salary_payment', array('employee_id' => $employment_id), 1); 
		  if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 
		  return FALSE;
	}
	
	/*----------------------------------------------Sarps Mansi----------------------------------------------*/
	public function get_Allrecord($tbl){
		return $this->db->get($tbl)->result();
	}
	public function change_intoactive($id){
		return $this->db->update('tbl_job_letters',array('status'=>'approve'),array('id'=>$id));
		
	}
	public function change_intoinactive($id){
		return $this->db->update('tbl_job_letters',array('status'=>'disapprove'),array('id'=>$id));
		
	}
	public function getWhereRecord($tbl,$where){
		$res= $this->db->get_where($tbl,$where)->row();
		return $res;
		
	}
}
