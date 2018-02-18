<?php

/**
 * Description of employee_model
 *
 * @author NaYeM
 */
class Application_model extends MY_Model {

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

    public function all_emplyee_info($id = NULL) {
        $this->db->select('tbl_employee.employee_id as empId,tbl_employee.*', FALSE);
        $this->db->select('tbl_employee_bank.*', FALSE);
        $this->db->select('tbl_employee_document.*', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('countries.countryName', FALSE);
        $this->db->from('tbl_employee');
        $this->db->join('tbl_employee_bank', 'tbl_employee_bank.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_employee_document', 'tbl_employee_document.employee_id  = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
        $this->db->join('countries', 'countries.idCountry  = tbl_employee.country_id', 'left');
        if (!empty($id)) {
            $this->db->where('tbl_employee.employee_id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
			//echo $this->db->last_query();
            $result = $query_result->result();
        }
       /*
        if (!empty($id)) {
                   $this->db->select('tbl_employee.nationality', FALSE);
                   $this->db->select('countries.countryName', FALSE);
                   $this->db->from('tbl_employee');
                   $this->db->join('countries', 'countries.idCountry  =  tbl_employee.nationality ', 'left');
                   $query_nationality = $this->db->get();
                   $nationality = $query_nationality->row();
                   if (!empty($nationality)) {
                       $result->nationality = $nationality->countryName;
                   }
               }*/
       
        return $result;
    }

    public function get_employee_award_by_id($id=NULL) {

        // $this->db->select('tbl_employee_award.*', FALSE);
        // $this->db->select('tbl_employee.*', FALSE);
        // $this->db->from('tbl_employee_award');
        // $this->db->join('tbl_employee', 'tbl_employee_award.employee_id = tbl_employee.employee_id', 'left');
        // if (!empty($id)) {
        //     $this->db->where('tbl_employee_award.employee_award_id', $id);
        //     $query_result = $this->db->get();
        //     $result = $query_result->row();
        // } else {
        //     $query_result = $this->db->get();
        //     $result = $query_result->result();
        // }
        // return $result;
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
		$q = $this->db->get_where('tbl_employee', array('employee_id' => $id), 1);
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
}
