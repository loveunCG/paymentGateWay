<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attendance_model
 *
 * @author NaYeM
 */
class Attendance_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function importAttendance($sql) {
		$this->db->trans_start();
		$flg = array();
		
		//print_r($sql);die;
		
		foreach($sql as $data)
		{
			$where['employee_id'] = $data['employee_id'];
			$where['date'] = $data['date'];
			
			//echo "<pre>";print_r($data);
			$results = $this->db->get_where('tbl_attendance', $where)->result();
			
			
			
			if(count($results) == 0)
			{
				if($this->db->insert('tbl_attendance', $data))
					$flg[] = 1;
				else
					$flg[] = 0;
			}
			else
			{
				//echo "<pre>";print_r($results);die;
				
				$data['time_in'] = $results[0]->time_in ."<-->" . $data['time_in'];
				$data['time_out'] = $results[0]->time_out ."<-->" . $data['time_out'];
				
				//echo "<pre>";print_r($results);print_r($data);die;
				
				$this->db->where($where);
				if($this->db->update('tbl_attendance', $data))
					$flg[] = 1;
				else
					$flg[] = 0;
			}
		}
		
		if(in_array(0,$flg))
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	
	public function importAttendanceTimeQPlus($sql) {
		$this->db->trans_start();
		$flg = array();
				
		foreach($sql as $data)
		{
				if($this->db->insert('tbl_attendance', $data))
					$flg[] = 1;
				else
					$flg[] = 0;
		}
		
		if(in_array(0,$flg))
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	
	//@sunny get attandence of start and end dates 	
	public function getTimeByDateBetweenTwoDates($start_date = NULL, $end_date = NULL){  
		
			$this->db->select('tbl_attendance_bulk.*', FALSE);
			$this->db->select('tbl_department.department_name', FALSE);
			$this->db->from('tbl_attendance_bulk');					
			$this->db->join('tbl_department', 'tbl_department.department_id  = tbl_attendance_bulk.department_id', 'left');
		
		
			if($start_date != NULL && $end_date != NULL)
			{
				$this->db->where('start_date >= "'.$start_date.'"',NULL,false);
				$this->db->where('end_date <= "'.$end_date.'"',NULL,false);
			}
			else if($start_date != NULL && $end_date == NULL)
			{
				$this->db->where('MONTH(date) =  MONTH("'.$start_date.'")',NULL,false);
				$this->db->where('YEAR(date) =  YEAR("'.$start_date.'")',NULL,false);
			}
			else if($start_date == NULL && $end_date != NULL)
			{
				$this->db->where('MONTH(date) =  MONTH("'.$end_date.'")',NULL,false);
				$this->db->where('YEAR(date) =  YEAR("'.$end_date.'")',NULL,false);
			}
			$this->db->order_by('date','asc');
			
			/*if ($id != NULL) {
				$this->db->where(array('id' => $id));
            }*/
            
			$result = $this->db->get()->result();
			//echo $this->db->last_query();
			return $result;
        
	}
	
	public function get_employee_id($id)
	{
		$this->db->select('employee_id');
		$this->db->from('tbl_employee');
		$this->db->where('employment_id',$id);
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		$res = $this->db->get()->row();
		
		return $res->employee_id;
	}
	/*
	//@Harshita Add new employee id paramater for filter data according to perticuler employe
	*/
	public function get_employee_id_by_dept_id($department_id,$employee_id= 0)
		{
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_employee');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id = tbl_designations.department_id', 'left');
        $this->db->where('tbl_department.department_id', $department_id);
        
        //@Harshita  August
        if($employee_id!=0){
        $this->db->where('tbl_employee.employee_id', $employee_id);
	    }
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
		
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

	public function get_employee_working_info_by_depart_id_month($department_id,$employee_id,$payment_frequency,$month,$year,$num)
		{
		$start_date = $year.'-'.$month.'-'.'01';
		$end_date = $year.'-'.$month.'-'.$num;
		
		/*$this->db->select('tbl_attendance.*, COUNT(tbl_attendance.employee_id) as totalRegularDays');
		$this->db->select('tbl_leave_category.*, COUNT(employee_id) as totalOthersLeave');
		
		$this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.*', FALSE);
		
		$this->db->select('tbl_attendance.*', FALSE);
		//$this->db->select('tbl_application_list.*', FALSE);
		//$this->db->select('tbl_leave_category.*', FALSE);
		
        $this->db->from('tbl_employee');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id = tbl_designations.department_id', 'left');
		
		$this->db->join('tbl_attendance', 'tbl_attendance.employee_id = tbl_employee.employee_id', 'left');*/
		//$this->db->join('tbl_application_list', 'tbl_application_list.employee_id = tbl_employee.employee_id', 'left');
		//$this->db->join('tbl_leave_category', 'tbl_leave_category.leave_category_id = tbl_application_list.leave_category_id', 'left');
		
        /*$this->db->where('tbl_department.department_id', $department_id);*/
		
	
		//$this->db->where('tbl_attendance.employee_id', $emp_id);
		/*$this->db->where("tbl_attendance.date BETWEEN '$start_date' AND '$end_date'");*/
		//$this->db->where('tbl_attendance.date >= ', $start_date);
        //$this->db->where('tbl_attendance.date <= ', $end_date);
        //$this->db->where('tbl_application_list.employee_id', $emp_id);
		//$this->db->or_where("tbl_application_list.date BETWEEN '$start_date' AND '$end_date'");
		//$this->db->or_where('tbl_application_list.leave_start_date >= ', $start_date);
        //$this->db->where('tbl_application_list.leave_end_date <= ', $end_date);
		//$this->db->group_by('tbl_application_list.leave_category_id');   , COUNT(te.employee_id) as totalRegularDays   left join tbl_attendance ta on ta.employee_id = te.employee_id   AND ta.date BETWEEN '".$start_date."' AND '".$end_date."'   ta.employee_id,
		
		$sql = "SELECT *, COUNT(te.employee_id) as totalRegularDays
				FROM tbl_employee te left join tbl_designations td on td.designations_id = te.designations_id 
				left join tbl_department tde on tde.department_id = td.department_id
				left join tbl_attendance ta on ta.employee_id = te.employee_id
				left join tbl_employee_payroll tep on tep.employee_id = te.employee_id";
		if($employee_id == 0){		
		$sql .=	" WHERE td.department_id='".$department_id."' ";
		}if($employee_id != 0){		
		$sql .=	" WHERE td.department_id='".$department_id."' AND te.employee_id='".$employee_id."' ";
		}if($payment_frequency != ''){		
		$sql .=	" AND tep.payment_frequency='".$payment_frequency."' ";
		}
		$sql .=	" AND ta.date BETWEEN '".$start_date."' AND '".$end_date."' AND ta.attendance_status=1
				GROUP BY ta.employee_id";
				
		/*$sql = "SELECT *, COUNT(tpl.leave_category_id) as totalOthersLeave 
				FROM tbl_employee te left join tbl_designations td on td.designations_id = te.designations_id 
				left join tbl_department tde on tde.department_id = td.department_id				
				left join tbl_application_list tpl on tpl.employee_id = te.employee_id
				left join tbl_leave_category tlc on tlc.leave_category_id = tpl.leave_category_id
				WHERE td.department_id='".$department_id."' AND tpl.leave_start_date >= '".$start_date."' AND tpl.leave_end_date <= '".$end_date."'
				GROUP BY tpl.employee_id, tpl.leave_category_id ";*/
				
		/*$sql = "SELECT *, COUNT(te.employee_id) as totalRegularDays, COUNT(tpl.leave_category_id) as totalOthersLeave 
				FROM tbl_employee te left join tbl_designations td on td.designations_id = te.designations_id 
				left join tbl_department tde on tde.department_id = td.department_id
				left join tbl_attendance ta on ta.employee_id = te.employee_id				
				left join tbl_application_list tpl on tpl.employee_id = te.employee_id
				left join tbl_leave_category tlc on tlc.leave_category_id = tpl.leave_category_id
				WHERE td.department_id='".$department_id."' 
				AND ta.date BETWEEN '".$start_date."' AND '".$end_date."' OR tpl.leave_start_date >= '".$start_date."' AND tpl.leave_end_date <= '".$end_date."'
				GROUP BY ta.employee_id, tpl.employee_id, tpl.leave_category_id ";*/
	
		$result = false;
		//echo $sql;
		$query_result = $this->db->query($sql);
        //$query_result = $this->db->get();
		$query = $this->db->query($sql);
        $recordSet = $query_result->result_array();
		if (count($recordSet) > 0){
				$result = $recordSet;
				for($i=0;$i<count($recordSet);$i++){
					$result[$i] = $recordSet[$i];
				}
			return $result;				
			}else{ return 0;}
    }
	
	public function get_employee_working_others_info_by_depart_id_month($empid,$month,$year,$num)
		{
		$start_date = $year.'-'.$month.'-'.'01';
		$end_date = $year.'-'.$month.'-'.$num;
		
		$sql = "SELECT *, COUNT(tpl.leave_category_id) as totalOthersLeave 
				FROM tbl_application_list tpl 
				left join tbl_leave_category tlc on tlc.leave_category_id = tpl.leave_category_id
				WHERE tpl.employee_id='".$empid."' AND tpl.leave_start_date >= '".$start_date."' AND tpl.leave_end_date <= '".$end_date."'
				GROUP BY tpl.employee_id, tpl.leave_category_id ";
				
		
		
		$result = false;
		$query_result = $this->db->query($sql);
		$query = $this->db->query($sql);
        $recordSet = $query_result->result_array();
		if (count($recordSet) > 0){
				$result = $recordSet;
				for($i=0;$i<count($recordSet);$i++){
					$result[$i] = $recordSet[$i];
				}
			return $result;				
			}else{ return 0;}
    }
	
		public function get_employee_others_leave_days_by_emp_id_month($emp_id,$month,$year,$num)
		{
		$start_date = $year.'-'.$month.'-'.'01';
		$end_date = $year.'-'.$month.'-'.$num;
		
		$this->db->select('tbl_leave_category.*, COUNT(employee_id) as totalOthersLeave');
		$this->db->select('tbl_application_list.*', FALSE);
        $this->db->from('tbl_application_list');
		$this->db->join('tbl_leave_category', 'tbl_leave_category.leave_category_id = tbl_application_list.leave_category_id', 'left');
        $this->db->where('tbl_application_list.employee_id', $emp_id);
		$this->db->where('tbl_application_list.leave_start_date >= ', $start_date);
        $this->db->where('tbl_application_list.leave_end_date <= ', $end_date);
		$this->db->group_by('tbl_application_list.leave_category_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function attendance_report_by_empid($employee_id = null, $sdate = null, $flag = NULL) {

        $this->db->select('tbl_attendance.date, tbl_attendance.time_in, tbl_attendance.time_out	, tbl_attendance.attendance_status', FALSE);
        $this->db->select('tbl_employee.first_name, tbl_employee.last_name ', FALSE);
        $this->db->from('tbl_attendance');
        $this->db->join('tbl_employee', 'tbl_attendance.employee_id  = tbl_employee.employee_id', 'left');
        $this->db->where('tbl_attendance.employee_id', $employee_id);
        $this->db->where('tbl_attendance.date', $sdate);
		$this->db->where('tbl_employee.id_gsettings', $this->session->userdata('id_gsettings'));
		
        $query_result = $this->db->get();
        $result = $query_result->result();

        if (empty($result)) {
            $val['attendance_status'] = $flag;
            $val['date'] = $sdate;
            $result[] = (object) $val;
        } else {
            if ($result[0]->attendance_status == 0) {
                if ($flag == 'H') {
                    $result[0]->attendance_status = 'H';
                }
            }
        }


        return $result;
    }
	
	/*-*------------- 30/09/2015 -----------------------*/
	public function getLeaveTypeById($param1='')
	{
		$results = $this->db->get_where('tbl_leave_category', array('leave_category_id'=>$param1, 'id_gsettings' => $this->session->userdata('id_gsettings')))->row();
		return $results;
	}
	
	public function getTimeByDate($where = '')
	{
		//$this->db->or_where('date',$where['date']);
		//$this->db->or_where('date = "'.$where['date'].'" and time_in = "'.$where['time_in'].'"',NULL,FALSE);
		//$this->db->or_where('date = "'.$where['date'].'" and time_out = "'.$where['time_out'].'"',NULL,FALSE);
		
		$results = $this->db->get_where('tbl_attendance',$where)->result();
		//$results = $res->result();
		//echo $this->db->last_query();
		//print_r($results);
		return $results;
	}
	
	
	
	
	public function getAttendanceByDate($where = '')
	{
		$results = $this->db->get_where('tbl_attendance', $where)->result();
		//echo $this->db->last_query();
		//print_r($results);
		return $results;
	}

	public function get_attendance_report_by_dep_id_month($department_id, $month, $year, $num)
	{
		$start_date = $year.'-'.$month.'-'.'01';
		$end_date = $year.'-'.$month.'-'.$num;
		
		/*//$this->db->select('tbl_leave_category.*, COUNT(employee_id) as totalOthersLeave');
		$this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.*', FALSE);
		$this->db->select('tbl_application_list.*', FALSE);
		$this->db->select('tbl_attendance.*', FALSE);
		$this->db->select('tbl_attendance.*', FALSE);
        $this->db->from('tbl_employee');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id = tbl_designations.department_id', 'left');
        $this->db->where('tbl_department.department_id', $department_id);
        $this->db->from('tbl_application_list');
		$this->db->join('tbl_leave_category', 'tbl_leave_category.leave_category_id = tbl_application_list.leave_category_id', 'left');
        $this->db->where('tbl_application_list.employee_id', $emp_id);
		$this->db->where('tbl_application_list.leave_start_date >= ', $start_date);
        $this->db->where('tbl_application_list.leave_end_date <= ', $end_date);
		$this->db->group_by('tbl_application_list.leave_category_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
		
		left join tbl_application_list tal on tal.employee_id = te.employee_id
				left join tbl_leave_category tlc on tlc.leave_category_id = tal.leave_category_id";
		 OR tal.leave_start_date >= '".$start_date."' AND tal.leave_end_date <= '".$end_date."'
		
		*/
		
		
		
		
		$sql = "SELECT *
				FROM tbl_employee te left join tbl_designations td on td.designations_id = te.designations_id 
				left join tbl_department tde on tde.department_id = td.department_id
				left join tbl_attendance ta on ta.employee_id = te.employee_id ";					
		$sql .=	" WHERE td.department_id='".$department_id."' ";
		$sql .=	" AND ta.date BETWEEN '".$start_date."' AND '".$end_date."' AND ta.attendance_status=1 ORDER BY te.employee_id,ta.date ";
		$result = false;
		
		$query_result = $this->db->query($sql);
        $recordSet = $query_result->result_array();
		if (count($recordSet) > 0){
				//$result = $recordSet;
				for($i=0;$i<count($recordSet);$i++){
					$employeeId[] = $recordSet[$i]['employee_id'];
					$result[$recordSet[$i]['employee_id']]['Fullname'][] = $recordSet[$i]['first_name'].' '.$recordSet[$i]['last_name'];
					$result[$recordSet[$i]['employee_id']]['Attendance'][] = date('j', strtotime($recordSet[$i]['date']));
				}
				$employeeId = array_values(array_unique($employeeId));
				foreach($employeeId as $val){
					$resultLeave[$val] = $this->get_employee_working_others_info_by_emp_id_month($val, $month, $year, $num);
					$resultWorkingTime[$val] = $this->get_total_hours($val, $start_date, $end_date);
				}
				$totalResult[0] = $result;
				$totalResult[1] = $resultLeave;
				$totalResult[2] = $employeeId;
				$totalResult[3] = $resultWorkingTime;
			return $totalResult;				
			}else{ return 0;}
    }
	
	public function get_employee_working_others_info_by_emp_id_month($empid,$month,$year,$num)
		{
		$start_date = $year.'-'.$month.'-'.'01';
		$end_date = $year.'-'.$month.'-'.$num;
		
		$sql = "SELECT *, DATEDIFF(tpl.leave_end_date, tpl.leave_start_date)+1 AS days
				FROM tbl_application_list tpl 
				left join tbl_leave_category tlc on tlc.leave_category_id = tpl.leave_category_id
				WHERE tpl.employee_id='".$empid."' AND tpl.leave_start_date BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY tpl.leave_start_date ";
				
		
		
			$result = false;
			$query_result = $this->db->query($sql);
			$recordSet = $query_result->result_array();
			if (count($recordSet) > 0){
					//$result = $recordSet;
					for($i=0;$i<count($recordSet);$i++){
						if($recordSet[$i]['days']>1){
							for($j=0; $j<$recordSet[$i]['days']; $j++){
								$result['LeaveDay'][] = date('j', strtotime($recordSet[$i]['leave_start_date']. ' +'.$j. 'day'));
								$result['LeaveType'][] = $recordSet[$i]['leave_type'];
							}
					}else{
						$result['LeaveDay'][] = date('j', strtotime($recordSet[$i]['leave_start_date']));
						$result['LeaveType'][] = $recordSet[$i]['leave_type'];
					}
				}
				return $result;				
			}else{ return 0;
		}
    }
	
	public function get_total_hours($emp_id, $satrt_date, $end_date)
	{
		$sql = "SELECT *, SEC_TO_TIME(sum(TIME_TO_SEC(STR_TO_DATE(`time_out`, '%h:%i %p'))-TIME_TO_SEC(STR_TO_DATE(`time_in`, '%h:%i %p')))) as workingTime from tbl_attendance where `attendance_status`=1 and `employee_id`=$emp_id and `date` between '".$satrt_date."' and '".$end_date."' ";
		$result = false;
		$query_result = $this->db->query($sql);
        $recordSet = $query_result->result_array();
		if (count($recordSet) > 0){
				$result = $recordSet;
				for($i=0;$i<count($recordSet);$i++){
					$result[$i] = $recordSet[$i];
				}
			return $result;				
			}else{ return 0;}
		
	}
	
	public function checkDateExistORNot($emp_id, $satrt_date, $end_date)
	{
		$satrt_date = date('Y-m-d', strtotime(str_replace('-', '/', $satrt_date)));
		$end_date = date('Y-m-d', strtotime(str_replace('-', '/', $end_date)));
		
		$sql = "SELECT * FROM `tbl_attendance` WHERE `employee_id` = $emp_id AND `date` BETWEEN '".$satrt_date."' AND '".$end_date."'";
		$query_result = $this->db->query($sql);
        $recordSet = $query_result->result_array();
		if (count($recordSet) > 0){ return 1; }else{ return 0;}
		
	}
        
        /* To get time history from attendance table*/
    public function get_attendance_time_history($params='')
	{

		$sql = "SELECT * FROM `tbl_attendance` A  ";
                $sql .= "INNER JOIN `tbl_employee` B ON B.employee_id=A.employee_id ";
                $sql .= "INNER JOIN `tbl_designations` C ON C.designations_id=B.designations_id ";
                $sql .= "INNER JOIN `tbl_department` D ON D.department_id=C.department_id ";
                $sql .= "WHERE `attendance_id` IS NOT NULL AND C.designations_id='".$params['designations_id']."' AND `date` BETWEEN '".$params['start_date']."' AND '".$params['end_date']."' ";
                if($params['employee_id'] > 0)
                    $sql .= " AND A.employee_id='".$params['employee_id']."' ";
                
		$query_result = $this->db->query($sql);
                $result = $query_result->result_array();
                return $result;
	}
        
    


}
