<?php
ini_set('display_errors', 0);
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
class Attendance extends Admin_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('emp_model');
        $this->load->model('attendance_model');
        $this->load->model('sitetable_Model');
        $this->load->model('employee_model');
		$this->load->helper('date');
    }
    public function application_leave() {
        $data['menu'] = array("leave_application" => 1);
        $data['title'] = "List of All Applications";
		/*echo '<pre>';
		print_r($this->session->all_userdata());
		die;*/
		$data['getActiveUserDetails'] = $this->session->all_userdata();
        $data['all_leave_applications'] = $this->emp_model->get_employee_all_leave_applied();

        $data['subview'] = $this->load->view('admin/attendance/leave_application', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

	public function apply_new_application() {
        $data['title'] = "Add New Application  ";
		$data['getActiveUserDetails'] = $this->session->all_userdata();
        //get leave category for dropdown
        $this->emp_model->_table_name = "tbl_leave_category"; // table name
        $this->emp_model->_order_by = "leave_category_id"; // $id
        $data['all_leave_category'] = $this->emp_model->get(); // get result
		$data['all_employee_info'] = $this->emp_model->all_emplyee_table_info();
		/*$CI = &get_instance();
		$CI->load->database();
		echo 'USER => '.$CI->db->username.'</br>';
		echo 'PASS => '.$CI->db->password.'</br>';
		echo 'DATABASE => '.$CI->db->database.'</br>';
		echo 'HOST => '.$CI->db->hostname;
		echo '<pre>';
		print_r($data['all_employee_info']);
		echo '<pre>';
		print_r($data['all_leave_category']);
		die;*/
        $data['subview'] = $this->load->view('admin/attendance/apply_new_application', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
	public function view_application($id = NULL) {
        $data['title'] = "Update Application";
		$data['getActiveUserDetails'] = $this->session->all_userdata();
		/*echo '<pre>';
		print_r($data['getActiveUserDetails']); die;*/
        //get leave category for dropdown
        $this->emp_model->_table_name = "tbl_leave_category"; // table name
        $this->emp_model->_order_by = "leave_category_id"; // $id
        $data['all_leave_category'] = $this->emp_model->get(); // get result
		$data['all_employee_info'] = $this->emp_model->all_emplyee_table_info();
		$data['specific_employee_info'] = $this->emp_model->get_specific_employee_all_leave_applied($id);
		
		/*echo '<pre>';
		print_r($data['all_leave_category']);*/
		//die;
        $data['subview'] = $this->load->view('admin/attendance/view_application', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
	
	public function save_application_leave() {
        $this->emp_model->_table_name = "tbl_application_list"; // table name
        $this->emp_model->_primary_key = "application_list_id"; // $id
        //receive form input by post
        $data['employee_id'] = $this->input->post('employee_id');
        $data['leave_category_id'] = $this->input->post('leave_category_id');
        $data['leave_start_date'] = $this->input->post('leave_start_date');
        $data['leave_end_date'] = $this->input->post('leave_end_date');
        $data['reason'] = $this->input->post('reason');
		$data['comment'] = $this->input->post('comment');
		$data['approved_by'] = $this->input->post('approved_by');
		
		if($this->input->post('sbtn') == "Accept") { 
			$data['application_status'] = $this->input->post('application_status');
			$showmessage = "Application Accepted Successfully";
		} 
		if($this->input->post('sbtn') == "Reject"){
			$data['application_status'] = '3';
			$showmessage = "Application Rejected Successfully";
		}		
		
		if($data['approved_by'] == 1 || $data['approved_by'] == 3)	
			$data['application_date'] = date('Y-m-d H:i:s'); 
		
        //save data in database
		$checkExistOrNot = $this->attendance_model->checkDateExistORNot($data['employee_id'], $data['leave_start_date'], $data['leave_end_date']);
		if(!$checkExistOrNot){
			$this->emp_model->_table_name = "tbl_application_list"; // table name
			$this->emp_model->_primary_key = "application_list_id"; 
			$application_list_id = $this->input->post('application_list_id', TRUE);
			if (!empty($application_list_id)) 
				$this->emp_model->save($data,$application_list_id);
			else
				$this->emp_model->save($data);
			// messages for user
			$type = "success";
			$message = $showmessage;
		}else{
			$type = "error";
			$message = "Allready records exist for attendance.";
		}
        set_message($type, $message);
		//$this->session->set_flashdata('success', array('message' => 'Leave Application Successfully Submitted !','class' => 'success'));
        redirect('admin/attendance/application_leave');
    }
	
	public function apply_leave_application() {
        $data['title'] = "New Leave Application";
		
        //get leave category for dropdown
        $this->emp_model->_table_name = "tbl_leave_category"; // table name
        $this->emp_model->_order_by = "leave_category_id"; // $id
        $data['all_leave_category'] = $this->emp_model->get(); // get result
		$data['all_employee_info'] = $this->emp_model->all_emplyee_table_info();
		/*echo '<pre>';
		print_r($data['all_employee_info']);
		echo '<pre>';
		print_r($data['all_leave_category']);
		die;*/
        $data['subview'] = $this->load->view('admin/attendance/apply_new_leave_application', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
	public function save_leave_application() {
        $this->emp_model->_table_name = "tbl_application_list"; // table name
        $this->emp_model->_primary_key = "application_list_id"; // $id
        //receive form input by post
        $data['employee_id'] = $this->input->post('employee_id');
        $data['leave_category_id'] = $this->input->post('leave_category_id');
        $data['leave_start_date'] = $this->input->post('leave_start_date');
        $data['leave_end_date'] = $this->input->post('leave_end_date');
        $data['reason'] = $this->input->post('reason');
        //save data in database
        $this->emp_model->save($data);

        // messages for user
		$this->session->set_flashdata('success', array('message' => 'Leave Application Successfully Submitted !','class' => 'success'));
        redirect('admin/attendance/apply_leave_application');
    }
	
    public function import_attendance() {
    	 $type = $this->input->post('type');
        if($type=='POS')
        {
        $config =  array(
            'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/asset/uploads/",
            'allowed_types'   => '*',
            'overwrite'       => TRUE,
            'max_size'        => "100000"
        );
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('filecard')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
            $type = "success";
            $message = "Some error occurred in uploading file!";
            set_message($type, $message);
            redirect('admin/attendance/manage_attendance'); //redirect page

        } else {
            $this->load->library('csvreader');
            $result =   $this->csvreader->parse_file(FCPATH . 'asset/uploads/'.str_replace(' ', '_', $_FILES['filecard']['name']));
            $data['csvData'] =  $result;
            //echo '<pre>';
            //var_dump($result); die;
            $this->processData($result);
            $type = "success";
            $message = "Uploaded successfully!";
            set_message($type, $message);
            redirect('admin/attendance/manage_attendance', $data); //redirect page
        }
            
        } elseif($type=='TIMEQPLUS') {
            	if(empty($_FILES['filecard']['name']))
		{
			$type = "error";
			$message .= "File is not selected. Please, try again...!";
			set_message($type, $message);
			redirect('admin/attendance/manage_attendance');
			exit;
		}
		
		//check file is csv or not
		$ext = strrchr($_FILES['filecard']['name'],".");
		if($ext != ".csv")
		{
			$type = "error";
			$message .= "Invalid file, Upload CSV file...!";
			set_message($type, $message);
			redirect('admin/attendance/manage_attendance');
			exit;
		}	
		
		//Import uploaded file to Database
		$handle = fopen($_FILES['filecard']['tmp_name'], "r");
		$flag = true;
		$dataSql = array();
		$cnt = 0;
		$coForTimeOut = 0;
		$everyTimeDateCheck = 0;
		
	    while (($data = fgetcsv($handle,'1000',',')) !== FALSE) {		
			if($flag) { $flag = false; continue; }
			if($data[0] != "" && $data[2] !== "")
			{ 
				if($coForTimeOut == 0){
					if($data[4] == 'SIC'){ echo $data[4];
						$dataSql[$cnt]['employee_id'] = (int)$data[1]; 
						$dataSql[$cnt]['leave_category_id'] = 2;
						$dataSql[$cnt]['date'] = date('Y-m-d',strtotime($data[2]));
						$dataSql[$cnt]['attendance_status'] = 1;
						$dataSql[$cnt]['time_in'] = $data[3];
						$dataSql[$cnt]['time_out'] = $data[3];
						$dataSql[$cnt]['id_gsettings'] = $this->session->userdata('id_gsettings');
						$cnt++;
					}elseif($data[4] == 'VAC'){echo $data[4];
						$dataSql[$cnt]['employee_id'] = (int)$data[1]; 
						$dataSql[$cnt]['leave_category_id'] = 4;
						$dataSql[$cnt]['date'] = date('Y-m-d',strtotime($data[2]));
						$dataSql[$cnt]['attendance_status'] = 1;
						$dataSql[$cnt]['time_in'] = $data[3];
						$dataSql[$cnt]['time_out'] = $data[3];
						$dataSql[$cnt]['id_gsettings'] = $this->session->userdata('id_gsettings');
						$cnt++;
					}else{
						$everyTimeDateCheck = $data[2];
						$dataSql[$cnt]['employee_id'] = (int)$data[1]; //$this->attendance_model->get_employee_id($data[0]);
						$dataSql[$cnt]['leave_category_id'] = 0;
						$dataSql[$cnt]['date'] = date('Y-m-d',strtotime($data[2]));
						$dataSql[$cnt]['attendance_status'] = 1;
						$dataSql[$cnt]['time_in'] = $data[3];
						$dataSql[$cnt]['id_gsettings'] = $this->session->userdata('id_gsettings');
						$coForTimeOut++;
					}
				}else{
					if(strtotime($data[2]) == strtotime($everyTimeDateCheck)){
						$dataSql[$cnt]['time_out'] = $data[3];
						$cnt++;
						$everyTimeDateCheck = 0;
						$coForTimeOut = 0;
					}else{ 
						$dataSql[$cnt]['time_out'] = '6:00 PM';
						$cnt++;
						$dataSql[$cnt]['employee_id'] = (int)$data[1]; //$this->attendance_model->get_employee_id($data[0]);
						$dataSql[$cnt]['leave_category_id'] = 0;
						$dataSql[$cnt]['date'] = date('Y-m-d',strtotime($data[2]));
						$dataSql[$cnt]['attendance_status'] = 1;
						$dataSql[$cnt]['time_in'] = $data[3];
						$dataSql[$cnt]['id_gsettings'] = $this->session->userdata('id_gsettings');
						$everyTimeDateCheck = $data[2];
						$coForTimeOut = 1;
					}
					
				}
				
			}
	    }
			/*echo '<pre>';
			print_r($dataSql);	
			die();*/
	    fclose($handle);
		if($this->attendance_model->importAttendance($dataSql)){
				// messages for user        
			$type = "success";
			$message .= "Attendance Information Successfully Imported!";
			set_message($type, $message);
			redirect('admin/attendance/manage_attendance');
			exit;
		}
		else
		{
			// messages for user        
			$type = "error";
			$message .= "Attendance Information Not Imported Try Again...!";
			set_message($type, $message);
			redirect('admin/attendance/manage_attendance');
			exit;
		}
		//print_r($dataSql);
		//print_r($_FILES);
		//die;
        }else{
            	if(empty($_FILES['filecard']['name']))
		{
			$type = "error";
			$message .= "File is not selected. Please, try again...!";
			set_message($type, $message);
			redirect('admin/attendance/manage_attendance');
			exit;
		}
		
		//check file is csv or not
		$ext = strrchr($_FILES['filecard']['name'],".");
		if($ext != ".csv")
		{
			$type = "error";
			$message .= "Invalid file, Upload CSV file...!";
			set_message($type, $message);
			redirect('admin/attendance/manage_attendance');
			exit;
		}	
		
		//Import uploaded file to Database
		$handle = fopen($_FILES['filecard']['tmp_name'], "r");
		$flag = true;
		$dataSql = array();
		$cnt = 0;
	    while (($data = fgetcsv($handle,'1000',',')) !== FALSE) {
			if($flag) { $flag = false; continue; }
			if($data[0] != "" && $data[2] !== "")
			{
				$dataSql[$cnt]['employee_id'] = $this->attendance_model->get_employee_id($data[0]);
				$dataSql[$cnt]['leave_category_id'] = $data[1];
				$dataSql[$cnt]['date'] = date('Y-m-d',strtotime($data[2]));
				$dataSql[$cnt]['attendance_status'] = $data[3];
				$dataSql[$cnt]['time_in'] = $data[4];
				$dataSql[$cnt]['time_out'] = $data[5];
				$dataSql[$cnt]['id_gsettings'] = $this->session->userdata('id_gsettings');
				$cnt++;
			}
			//print_r($data);	
	    }
	    fclose($handle);
		if($this->attendance_model->importAttendance($dataSql)){
				// messages for user        
			$type = "success";
			$message .= "Attendance Information Successfully Imported!";
			set_message($type, $message);
			redirect('admin/attendance/manage_attendance');
			exit;
		}
		else
		{
			// messages for user        
			$type = "error";
			$message .= "Attendance Information Not Imported Try Again...!";
			set_message($type, $message);
			redirect('admin/attendance/manage_attendance');
			exit;
		}
		//print_r($dataSql);
		//print_r($_FILES);
		//die;
        }

		

	}


    public function processData($csvData)
    {
        if(!empty($csvData))
        {
            foreach ($csvData as $field)
            {
                $date = date("Y-m-d", strtotime($field['Clock-in date']));
                $query = $this->db->get_where('tbl_attendance', array('employee_id' => $field['Employee#'], 'date' => $date), 1);
                
                if($query->num_rows > 0)
                {
                foreach($query->result() as $row) {
              
                $updateData = array(
                                 'time_in' => $row->time_in . '<-->' .  $field['Clock-in time'],
                                 'time_out' => $row->time_in . '<-->' .  $field['Clock-out time']
                              );
                  $this->db->where('attendance_id', $row->attendance_id);
                  $this->db->update('tbl_attendance', $updateData); 
                }                  
                  

                } else {
                  $dataArray = array(
                      'employee_id' => ($field['Employee#'] == '' ? 0 : $field['Employee#']),
                      'date' => $date,
                      'time_in' => $field['Clock-in time'],
                      'attendance_status' => (isset($field['attendance_status']) ? $field['attendance_status'] : '1' ),
                      'time_out' => $field['Clock-out time'],
                      'clocking_status' => (isset($field['clocking_status']) ? $field['clocking_status'] : '0'),
                  ); 
                   $this->db->insert('tbl_attendance', $dataArray);                 
                }
                
                

            }          
        }
    }
	
	
	public function time_history()
	{
		$data['title'] = "Attendance History";
		$this->attendance_model->_table_name = "tbl_leave_category"; //table name
        $this->attendance_model->_order_by = "leave_category_id";
        $data['all_leave_category_info'] = $this->attendance_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		//print_r($data['all_leave_category_info']);die;
        $this->attendance_model->_table_name = "tbl_department"; //table name
        $this->attendance_model->_order_by = "department_id";
        $data['all_department'] = $this->attendance_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		//print_r($data['all_department']);die;
		$this->attendance_model->_table_name = "tbl_attendance";
		$this->attendance_model->_order_by = "attendance_id";
				
		$data['date'] = $this->input->post('date', TRUE);
		$data['endDate'] = $this->input->post('endDate', TRUE);
        $data['intime'] = $this->input->post('intime', TRUE);
        $data['outtime'] = $this->input->post('outtime', TRUE);
        $data['department_id'] = $this->input->post('department_id_not_required');
        $data['employee_id'] = $this->input->post('employee_id_not_required');  //@Harshita 5august
		
		/*echo '<pre>';
		print_r($data);
		die();*/
		
        if ($sbtnType == 1 || $flag == 1) {
            if ($flag) {
                $data['date'] = $this->session->userdata('date');
                $data['department_id'] = $this->session->userdata('department_id');
                $this->session->unset_userdata('date');
                $this->session->unset_userdata('flag');
                $this->session->unset_userdata('department_id');
            } else {

                $data['date'] = $this->input->post('date');
                $data['department_id'] = $this->input->post('department_id_not_required');
            }
        }
        
        // retrive all data from department table
        $this->employee_model->_table_name = "tbl_department"; //table name
        $this->employee_model->_order_by = "department_id";
        $all_dept_info = $this->employee_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
        // get all department info and designation info
        foreach ($all_dept_info as $v_dept_info) {
            $data['all_department_info'][$v_dept_info->department_name] = $this->employee_model->get_add_department_by_id($v_dept_info->department_id);
        }        
        
        //Submit time hostory filter
        if($this->input->post('sbtn')) {
            $params = array('start_date' => $this->input->post('start_date'),
                            'end_date' => $this->input->post('end_date'),
                            'designations_id' => $this->input->post('designations_id'),
                            'employee_id' => $this->input->post('employee_id_not_required')
                            );
            $data['result_data'] = $this->attendance_model->get_attendance_time_history($params);
        }
		
        $data['subview'] = $this->load->view('admin/attendance/time_history', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
        
		
	}
	
	
    public function manage_attendance() {
    
        //author By NaYeM        
		//echo "<pre>";//print_r($_POST);//print_r($_SESSION);die;
        $data['title'] = "Set Attendance";
        $this->attendance_model->_table_name = "tbl_leave_category"; //table name
        $this->attendance_model->_order_by = "leave_category_id";
        $data['all_leave_category_info'] = $this->attendance_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		//print_r($data['all_leave_category_info']);die;
        $this->attendance_model->_table_name = "tbl_department"; //table name
        $this->attendance_model->_order_by = "department_id";
        $data['all_department'] = $this->attendance_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		//print_r($data['all_department']);die;
		$this->attendance_model->_table_name = "tbl_attendance";
		$this->attendance_model->_order_by = "attendance_id";
		
        $data['department_id'] = $this->input->post('department_id');
        $data['employee_id'] = $this->input->post('employee_id_not_required');  //@Harshita 5august
        $data['date'] = $this->input->post('date', TRUE);
        /*$data['intime'] = $this->input->post('intime', TRUE);
        $data['outtime'] = $this->input->post('outtime', TRUE);*/
		$datetime = array(
			'date'=> $data['date'],'employee_id'=> $data['employee_id']
		);
		
		$data['times'] = $this->attendance_model->getTimeByDate($datetime);
		//print_r($data['times']);die;
        $sbtnType = $this->input->post('sbtn');
        $flag = $this->session->userdata('flag');
        if ($sbtnType == 1 || $flag == 1) {
			
            if ($flag) {
                $data['date'] = $this->session->userdata('date');
                $data['department_id'] = $this->session->userdata('department_id');
                
                $this->session->unset_userdata('date');
                $this->session->unset_userdata('flag');
                $this->session->unset_userdata('department_id');
                
            } else {
				
                $data['date'] = $this->input->post('date');
                $data['department_id'] = $this->input->post('department_id');
            }
        }
        //<!--@Harshita 5August Ajax Based Employee Get Starts here..... -->
        $this->attendance_model->_table_name = "tbl_department"; //table name
        $this->attendance_model->_order_by = "department_id";
        $data['all_department'] = $this->attendance_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		$this->load->model('payroll_model');
		
		//get all employee info by payment frequency
		$this->payroll_model->_table_name = 'tbl_employee';
		$this->payroll_model->_order_by = 'designations_id';
		
		$data['designations_id'] = $this->input->post('department_id', TRUE);
		$where['designations_id'] = $data['designations_id'];
		$data['employee_info_emp'] = $this->payroll_model->get_by(array('designations_id' => $data['designations_id']), FALSE);
		
		/*
		//@Harshita Add new employee id paramater for filter data according to perticuler employe
		*/
        $data['employee_info'] = $this->attendance_model->get_employee_id_by_dept_id($data['department_id'],$data['employee_id']);

		//<!--@Harshita 5August Ajax Based Employee Get ends here..... -->
       

        foreach ($data['employee_info'] as $v_employee) {
            $where = array('employee_id' => $v_employee->employee_id, 'date' => $data['date']);
            $data['atndnce'][] = $this->attendance_model->check_by($where, 'tbl_attendance');
        }
        $data['subview'] = $this->load->view('admin/attendance/manage_attendance', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
 //@pulkit30.8.16 Manage Bulk Attendance Starts Here.....
 
    public function manage_bulk_attendance() {
        
        $data['title'] = "Set Attendance";
        $this->attendance_model->_table_name = "tbl_leave_category"; //table name
        $this->attendance_model->_order_by = "leave_category_id";
        $data['all_leave_category_info'] = $this->attendance_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		//print_r($data['all_leave_category_info']);die;
        $this->attendance_model->_table_name = "tbl_department"; //table name
        $this->attendance_model->_order_by = "department_id";
        $data['all_department'] = $this->attendance_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
		
		//print_r($data['all_department']);die;
		$this->attendance_model->_table_name = "tbl_attendance";
		$this->attendance_model->_order_by = "attendance_id";
		
        $data['department_id'] = $this->input->post('department_id');
		$data['employee_id'] = $this->input->post('employee_id_not_required');
         $data['date'] = $this->input->post('date', TRUE); 
        /*$data['intime'] = $this->input->post('intime', TRUE);
        $data['outtime'] = $this->input->post('outtime', TRUE);*/
		$datetime = array(
			'date'=> $data['date']
		);	
		
		$data['times'] = $this->attendance_model->getTimeByDate($datetime);
		
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');	
		/*$data['attendance_bulk_id'] = $this->input->post('attendance_bulk_id', TRUE); 
		if($attendance_bulk_id)
		{			
			$data['bulk_attandence_info'] = $this->attendance_model->getTimeByDateBetweenTwoDates($attendance_bulk_id,$start_date,$end_date);
		}
		else{
			$data['bulk_attandence_info'] = '';
		}*/
		
		$data['bulk_attandence_info'] = $this->attendance_model->getTimeByDateBetweenTwoDates($start_date,$end_date);
		
		//print_r($data['bulk_attandence_info']); die;
        $sbtnType = $this->input->post('sbtn');
        $flag = $this->session->userdata('flag');
        if ($sbtnType == 1 || $flag == 1) {
            if ($flag) {
                $data['date'] = $this->session->userdata('date');
                $data['department_id'] = $this->session->userdata('department_id');
                $this->session->unset_userdata('date');
                $this->session->unset_userdata('flag');
                $this->session->unset_userdata('department_id');
            } else {

                $data['date'] = $this->input->post('date');
                $data['department_id'] = $this->input->post('department_id');
            }
        }
        
        $data['employee_info'] = $this->attendance_model->get_employee_id_by_dept_id($data['department_id']);
        $data['start_date'] = $start_date;
		$data['end_date'] = $end_date;				
		
		
        foreach ($data['employee_info'] as $v_employee) {
            /*$where = array('employee_id' => $v_employee->employee_id, 'date >' => $start_date , 'date <' => $end_date);
            
            $rr=$this->attendance_model->check_by($where, 'tbl_attendance');
            echo $this->db->last_query();
           print_r($rr);
            $data['atndnce'][] = $this->attendance_model->check_by($where, 'tbl_attendance');*/
            
            $this->db->where('employee_id', $v_employee->employee_id_not_required);
            $this->db->where('date >=', $start_date);
			$this->db->where('date <=', $end_date);
			$data['atndnce'][] =  $this->db->get('tbl_attendance')->result();
        }//print_r($data['atndnce']); die;
        $data['subview'] = $this->load->view('admin/attendance/manage_bulk_attendance', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
    
        //@pulkit30.8.16 Manage Bulk Attendance Ends Here.....
        
	public function save_bulk_attendance() {
                            
        $time_in = $this->input->post('time_in', TRUE);
		$time_out = $this->input->post('time_out', TRUE);
		
        $leave_category_id = $this->input->post('leave_category_id', TRUE);
		
        //$employee_id = $this->input->post('select_employee_id', TRUE);
		$employee_id = $this->input->post('employee_id', TRUE);
		
        $attendance_id = $this->input->post('attendance_id', TRUE);
        //print_r($attendance_id); //die;
        //get only working dates  
		
        $this->load->model('payroll_model');   
		$total_working_dates =$this->payroll_model->getWorkingDatesBetweenTwoDates($_POST['start_date'],$_POST['end_date']); 
		$tbl_attendance_bulk_id=$this->input->post('attendance_bulk_id', TRUE);		
        //ends here 
        
        if (!empty($tbl_attendance_bulk_id)) {
            $key = 0;
            
            //save record in table attandence bulk
			$this->attendance_model->_table_name = "tbl_attendance_bulk"; // table name
			$this->attendance_model->_primary_key = "id"; // $id
			
			$attandence_bulk_data=array();				 
			$attandence_bulk_data["department_id"]=$this->input->post('department_id', TRUE);
			$attandence_bulk_data['time_in'] = $this->input->post('time_in_0', TRUE);
			$attandence_bulk_data['time_out'] = $this->input->post('time_out_0', TRUE);
			$attandence_bulk_data['start_date'] = $this->input->post('start_date', TRUE);
			$attandence_bulk_data['end_date'] = $this->input->post('end_date', TRUE);
			$attandence_bulk_data['id_gsettings'] =$this->session->userdata('id_gsettings');
			$attandence_bulk_data['date'] =date("Y-m-d H:i:s");
			$this->attendance_model->save($attandence_bulk_data, $tbl_attendance_bulk_id);
			
			//ends here 
            
            
            $this->attendance_model->_table_name = "tbl_attendance"; // table name
			$this->attendance_model->_primary_key = "attendance_id"; // $id
            //loop for every employee
			
            foreach ($employee_id as $empID) {
                $data['leave_category_id'] = NULL;
				$data['attendance_status'] = 1;
                $data['employee_id'] = $empID;               
				$data['id_gsettings'] = $this->session->userdata('id_gsettings');
				$data['time_in'] = $this->input->post('time_in_0', TRUE);
				$data['time_out'] = $this->input->post('time_out_0', TRUE);
				
				$id = $attendance_id[$key];
                
				//starts here save every date record between start and end date 
				
				foreach($total_working_dates as $value){					
					$data1=$data;
					$data1['date']=$value;
					
										
					$this->db->where('employee_id', $empID);
					$this->db->where('date', $value);					
					$data_atndnce =  $this->db->get('tbl_attendance')->result();				
					$data_atndnce =(isset($data_atndnce[0]))?$data_atndnce[0]:'';
					
					
					if (!empty($data_atndnce->attendance_id)) {
						$id = $data_atndnce->attendance_id;
						 $this->attendance_model->save($data1, $id);
					} else { 
						//$id = (isset($data_atndnce->attendance_id))? $data_atndnce->attendance_id : '' ;
						
						 $this->attendance_model->save($data1);
						 /*echo '<pre>'; print_r($data1); $data_atndnce->attendance_id;*/ 
					}					
				}                
				//ends
                $key++;
            }//for each ends 
			
        } else {
			
			//save record in table attandence bulk
			$this->attendance_model->_table_name = "tbl_attendance_bulk"; // table name
			$this->attendance_model->_primary_key = "id"; // $id
			
			$attandence_bulk_data=array();				 
			$attandence_bulk_data["department_id"]=$this->input->post('department_id', TRUE);
			$attandence_bulk_data['time_in'] = $this->input->post('time_in_0', TRUE);
			$attandence_bulk_data['time_out'] = $this->input->post('time_out_0', TRUE);
			$attandence_bulk_data['start_date'] = $this->input->post('start_date', TRUE);
			$attandence_bulk_data['end_date'] = $this->input->post('end_date', TRUE);
			$attandence_bulk_data['id_gsettings'] =$this->session->userdata('id_gsettings');
			$attandence_bulk_data['date'] = date("Y-m-d H:i:s");
			$this->attendance_model->save($attandence_bulk_data);
			
			
			//ends here 
			
			$this->attendance_model->_table_name = "tbl_attendance"; // table name
			$this->attendance_model->_primary_key = "attendance_id"; // $id
			
            $key = 0;
			
            foreach ($employee_id as $empID) {
                $data['date'] = $this->input->post('date', TRUE);
                
                $data['employee_id'] = $empID;
                $data['id_gsettings'] = $this->session->userdata('id_gsettings');
                
				$data['time_in'] = $this->input->post('time_in_0', TRUE);
				$data['time_out'] = $this->input->post('time_out_0', TRUE);
				
				$data['leave_category_id'] = NULL;
				$data['attendance_status'] = 1;
								
                // starts here save every date record between start and end date
				foreach($total_working_dates as $value){					
					
					 $data1=$data;
					 $data1['date']=$value;
					
					$this->attendance_model->save($data1);
				}
				//ends
				
                $key++;
            } //for each ends 
        }       
        
        $fdata['department_id'] = $this->input->post('department_id', TRUE);
        $fdata['date'] = $this->input->post('date');
        $fdata['flag'] = 1;
        $this->session->set_userdata($fdata);
        // messages for user        
        $type = "success";
        $message .= "Attendance Information Successfully Saved!";
        set_message($type, $message);
        redirect('admin/attendance/manage_bulk_attendance'); //redirect page
    }
    
    
    
        
    public function save_attendance() {
        $this->attendance_model->_table_name = "tbl_attendance"; // table name
        $this->attendance_model->_primary_key = "attendance_id"; // $id                    
        $time_in = $this->input->post('time_in', TRUE);
		$time_out = $this->input->post('time_out', TRUE);
		
        $leave_category_id = $this->input->post('leave_category_id', TRUE);
		//print_r($leave_category_id); die;
        $employee_id = $this->input->post('employee_id', TRUE);
		
        $attendance_id = $this->input->post('attendance_id', TRUE);
        if (!empty($attendance_id)) {
            $key = 0;
            foreach ($employee_id as $empID) {
                $data['date'] = $this->input->post('date', TRUE);
                $data['attendance_status'] = 0;
                $data['employee_id'] = $empID;
                $data['time_in'] = implode('<-->',$time_in[$empID]);
				$data['time_out'] = implode('<-->',$time_out[$empID]);
				$data['id_gsettings'] = $this->session->userdata('id_gsettings');
				
				if (!empty($time_in[$empID])) 
				{
					$data['attendance_status'] = 1;
					$data['leave_category_id'] = NULL;
                }
				else
				{
					 $data['attendance_status'] = 0;
				}
				if($time_in[$empID][0] == $time_out[$empID][0])
				{
					$data['attendance_status'] = 0;
					$data['time_in']=$time_in[$empID][0];
					$data['time_out']=$time_out[$empID][0];
				}
				if (!empty($leave_category_id[$key])) {
					$leave_type = $this->attendance_model->getLeaveTypeById($leave_category_id[$key]);
					if($leave_type->leave_type == '1')
					{
                    	$data['leave_category_id'] = $leave_category_id[$key];
						$data['attendance_status'] = 3;
					}
					else
					{
						$data['leave_category_id'] = $leave_category_id[$key];
						$data['attendance_status'] = 2;
					}
                }
				else 
				{
                    $data['leave_category_id'] = NULL;
                }
                $id = $attendance_id[$key];
                if (!empty($id)) {
                    $this->attendance_model->save($data, $id);
                } else {
                    $this->attendance_model->save($data, $id);
                }

                $key++;
            }
        } else {
            $key = 0;
			
            foreach ($employee_id as $empID) {
                $data['date'] = $this->input->post('date', TRUE);
                $data['attendance_status'] = 0;
                $data['employee_id'] = $empID;
                $data['time_in'] = implode('<-->',$time_in[$empID]);
                $data['id_gsettings'] = $this->session->userdata('id_gsettings'); //@rupali fro inserting id_gseting in tbl_attendence
				$data['time_out'] = implode('<-->',$time_out[$empID]);
				if (!empty($time_in[$empID])) 
				{
					$data['attendance_status'] = 1;
					$data['leave_category_id'] = NULL;
                }
				else
				{
					 $data['attendance_status'] = 0;
				}
				if($time_in[$empID][0] == $time_out[$empID][0])
				{
					$data['attendance_status'] = 0;
					$data['time_in']=$time_in[$empID][0];
					$data['time_out']=$time_out[$empID][0];
				}
                if (!empty($leave_category_id[$key])) {
					$leave_type = $this->attendance_model->getLeaveTypeById($leave_category_id[$key]);
					if($leave_type->leave_type == '1')
					{
                    	$data['leave_category_id'] = $leave_category_id[$key];
						$data['attendance_status'] = 3;
					}
					else
					{
						$data['leave_category_id'] = $leave_category_id[$key];
						$data['attendance_status'] = 2;
					}
                }
				else 
				{
                    $data['leave_category_id'] = NULL;
                }
                if (!empty($attendance_status)) {
                    foreach ($attendance_status as $v_status) {
                        if ($empID == $v_status) 
						{
                            $data['attendance_status'] = 1;
                            $data['leave_category_id'] = NULL;
                        }
                    }
                }
                $this->attendance_model->save($data);
                $key++;
            }
        }
        $fdata['department_id'] = $this->input->post('department_id', TRUE);
        $fdata['date'] = $this->input->post('date');
        $fdata['flag'] = 1;
        $this->session->set_userdata($fdata);
        // messages for user        
        $type = "success";
        $message .= "Attendance Information Successfully Saved!";
        set_message($type, $message);
        redirect('admin/attendance/manage_attendance'); //redirect page
    }

    public function attendance_report() {
        $data['title'] = "Attendance Report";
        $this->attendance_model->_table_name = "tbl_department"; //table name
        $this->attendance_model->_order_by = "department_id";
        $data['all_department'] = $this->attendance_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
        $data['subview'] = $this->load->view('admin/attendance/attendance_report', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }

	public function get_month_date($year, $month, $day) {
			$monthdays = date('t', mktime(0, 0, 0, $month, 1, $year));
			$dates = array();
			for($i = 0; $i <= $monthdays; $i++ ) {
				if($day == date('l', mktime(0, 0, 0, $month, 1+$i, $year)) && $month == date('n', mktime(0, 0, 0, $month, 1+$i, $year))) {
				$dates[] = date('j', mktime(0, 0, 0, $month, 1+$i, $year));
				}
			}
		return $dates; 
	}
    public function get_report() {
        $department_id = $this->input->post('department_id', TRUE);
        $date = $this->input->post('date', TRUE);
        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data['totalDays'] = $num;
		$data['employee'] = $this->attendance_model->get_employee_id_by_dept_id($department_id);
        $data['getAllAttendanceRecord'] = $this->attendance_model->get_attendance_report_by_dep_id_month($department_id, $month, $year, $num);
        $data['saturday'] = $this->get_month_date($year, $month, 'Saturday');
		$data['sunday'] = $this->get_month_date($year, $month, 'Sunday');
		$day = date('d', strtotime($date));
        for ($i = 1; $i <= $num; $i++) {
            $data['dateSl'][] = $i;
        }
        $holidays = $this->global_model->get_holidays(); //tbl working Days Holiday

        if ($month >= 1 && $month <= 9) {
            $yymm = $year . '-' . '0' . $month;
        } else {
            $yymm = $year . '-' . $month;
        }

        $public_holiday = $this->global_model->get_public_holidays($yymm);

	
        //tbl a_calendar Days Holiday        
        if (!empty($public_holiday)) {
            foreach ($public_holiday as $p_holiday) {
                for ($k = 1; $k <= $num; $k++) {

                    if ($k >= 1 && $k <= 9) {
                        $sdate = $yymm . '-' . '0' . $k;
                    } else {
                        $sdate = $yymm . '-' . $k;
                    }

                    if ($p_holiday->start_date == $sdate && $p_holiday->end_date == $sdate) {
                        $p_hday[] = $sdate;
                    }
                    if ($p_holiday->start_date == $sdate) {
                        for ($j = $p_holiday->start_date; $j <= $p_holiday->end_date; $j++) {
                            $p_hday[] = $j;
                        }
                    }
                }
            }
        }  
		//echo $sdate;
        foreach ($data['employee'] as $sl => $v_employee) {
            $key = 1;
            $x = 0;
            for ($i = 1; $i <= $num; $i++) {

                if ($i >= 1 && $i <= 9) {

                    $sdate = $yymm . '-' . '0' . $i;
                } else {
                    $sdate = $yymm . '-' . $i;
                }
                $day_name = date('l', strtotime("+$x days", strtotime($year . '-' . $month . '-' . $key)));
 
                if (!empty($holidays)) {
                    foreach ($holidays as $v_holiday) {

                        if ($v_holiday->day == $day_name) {
                            $flag = 'H';
							//echo "123--";
                        }
                    }
                }
                if (!empty($p_hday)) {
                    foreach ($p_hday as $v_hday) {
                        if ($v_hday == $sdate) {
                            $flag = 'H';
                        }
                    }
                }
				
                if (!empty($flag)) {
                    $data['attendance'][$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->employee_id, $sdate, $flag);
                } else {
                    $data['attendance'][$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->employee_id, $sdate);
                }

                $key++;
                $flag = '';
            }
        }        
		//echo "123--";
        $data['title'] = "Attendance Report";
        $this->attendance_model->_table_name = "tbl_department"; //table name
        $this->attendance_model->_order_by = "department_id";
        $data['all_department'] = $this->attendance_model->get();
        $data['department_id'] = $this->input->post('department_id', TRUE);
        $data['date'] = $this->input->post('date', TRUE);
        $where = array('department_id' => $department_id);
        $data['dept_name'] = $this->attendance_model->check_by($where, 'tbl_department');

        $data['month'] = date('F-Y', strtotime($yymm));
        $data['subview'] = $this->load->view('admin/attendance/attendance_report', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    public function create_pdf($department_id, $date) {
        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $data['employee'] = $this->attendance_model->get_employee_id_by_dept_id($department_id);

        $day = date('d', strtotime($date));
        for ($i = 1; $i <= $num; $i++) {
            $data['dateSl'][] = $i;
        }
        $holidays = $this->global_model->get_holidays(); //tbl working Days Holiday
        if ($month >= 1 && $month <= 9) {
            $yymm = $year . '-' . '0' . $month;
        } else {
            $yymm = $year . '-' . $month;
        }
        $public_holiday = $this->global_model->get_public_holidays($yymm);
        if (!empty($public_holiday)) {
            //tbl a_calendar Days Holiday        
            foreach ($public_holiday as $p_holiday) {
                for ($k = 1; $k <= $num; $k++) {

                    if ($k >= 1 && $k <= 9) {
                        $sdate = $yymm . '-' . '0' . $k;
                    } else {
                        $sdate = $yymm . '-' . $k;
                    }
                    if ($p_holiday->start_date == $sdate && $p_holiday->end_date == $sdate) {
                        $p_hday[] = $sdate;
                    }
                    if ($p_holiday->start_date == $sdate) {
                        for ($j = $p_holiday->start_date; $j <= $p_holiday->end_date; $j++) {
                            $p_hday[] = $j;
                        }
                    }
                }
            }
        }
        foreach ($data['employee'] as $sl => $v_employee) {
            $key = 1;
            $x = 0;
            for ($i = 1; $i <= $num; $i++) {

                if ($i >= 1 && $i <= 9) {

                    $sdate = $yymm . '-' . '0' . $i;
                } else {
                    $sdate = $yymm . '-' . $i;
                }
                $day_name = date('l', strtotime("+$x days", strtotime($year . '-' . $month . '-' . $key)));
                if (!empty($holidays)) {
                    foreach ($holidays as $v_holiday) {

                        if ($v_holiday->day == $day_name) {
                            $flag = 'H';
                        }
                    }
                }
                if (!empty($p_hday)) {
                    foreach ($p_hday as $v_hday) {
                        if ($v_hday == $sdate) {
                            $flag = 'H';
                        }
                    }
                }
                if (!empty($flag)) {
                    $data['attendance'][$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->employee_id, $sdate, $flag);
                } else {
                    $data['attendance'][$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->employee_id, $sdate);
                }
                $key++;
                $flag = '';
            }
        }
        $where = array('department_id' => $department_id);
        $data['dept_name'] = $this->attendance_model->check_by($where, 'tbl_department');
        $data['date'] = date('F-Y', strtotime($yymm));
        $this->load->helper('dompdf');
        $view_file = $this->load->view('admin/attendance/Emp_report_pdf', $data, true);
        $file_name = pdf_create($view_file, date('F-Y', strtotime($yymm)));
        echo $file_name;
    }

    public function create_excel($department_id, $date) {
        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $employee = $this->attendance_model->get_employee_id_by_dept_id($department_id);
        $where = array('department_id' => $department_id);
        $dept_name = $this->attendance_model->check_by($where, 'tbl_department');

        $day = date('d', strtotime($date));
        for ($i = 1; $i <= $num; $i++) {
            $dateSl[] = $i;
        }
        $holidays = $this->global_model->get_holidays(); //tbl working Days Holiday
        if ($month >= 1 && $month <= 9) {
            $yymm = $year . '-' . '0' . $month;
        } else {
            $yymm = $year . '-' . $month;
        }
        $public_holiday = $this->global_model->get_public_holidays($yymm);
        if (!empty($public_holiday)) {
            //tbl a_calendar Days Holiday        
            foreach ($public_holiday as $p_holiday) {
                for ($k = 1; $k <= $num; $k++) {

                    if ($k >= 1 && $k <= 9) {
                        $sdate = $yymm . '-' . '0' . $k;
                    } else {
                        $sdate = $yymm . '-' . $k;
                    }
                    if ($p_holiday->start_date == $sdate && $p_holiday->end_date == $sdate) {
                        $p_hday[] = $sdate;
                    }
                    if ($p_holiday->start_date == $sdate) {
                        for ($j = $p_holiday->start_date; $j <= $p_holiday->end_date; $j++) {
                            $p_hday[] = $j;
                        }
                    }
                }
            }
        }
        foreach ($employee as $sl => $v_employee) {
            $key = 1;
            $x = 0;
            for ($i = 1; $i <= $num; $i++) {

                if ($i >= 1 && $i <= 9) {

                    $sdate = $yymm . '-' . '0' . $i;
                } else {
                    $sdate = $yymm . '-' . $i;
                }
                $day_name = date('l', strtotime("+$x days", strtotime($year . '-' . $month . '-' . $key)));
                if (!empty($holidays)) {
                    foreach ($holidays as $v_holiday) {

                        if ($v_holiday->day == $day_name) {
                            $flag = 'H';
                        }
                    }
                }
                if (!empty($p_hday)) {
                    foreach ($p_hday as $v_hday) {
                        if ($v_hday == $sdate) {
                            $flag = 'H';
                        }
                    }
                }
                if (!empty($flag)) {
                    $attendance[$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->employee_id, $sdate, $flag);
                } else {
                    $attendance[$sl][] = $this->attendance_model->attendance_report_by_empid($v_employee->employee_id, $sdate);
                }
                $key++;
                $flag = '';
            }
        }
        //load PHPExcel library
        $this->load->library('Excel');
        ob_start();
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $styleArray = array(
            'font' => array(
                'size' => 13,
                'name' => 'Verdana'
        ));
        $fontArray = array(
            'font' => array(
                'bold' => true,
                'size' => 11,
                'name' => 'Verdana'
        ));
        $dateArray = array(
            'font' => array(
                'bold' => true,
        ));
        $bgcolor = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'E7E7E7'),
        ));
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B' . '1', 'Date:')
                ->setCellValue('D' . '1', date('F-Y', strtotime($yymm)));
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B1:C1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:H1');
        $objPHPExcel->getActiveSheet()->getStyle('B1:C1')->applyFromArray($fontArray);

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('J' . '1', 'Department:')
                ->setCellValue('N' . '1', $dept_name->department_name);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('J1:M1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('N1:V1');
        $objPHPExcel->getActiveSheet()->getStyle('J1:L1')->applyFromArray($fontArray);

// Set document properties
        $objPHPExcel->getProperties()->setCreator("Comprehensive School Management")
                ->setLastModifiedBy("Comprehensive School Management")
                ->setTitle("Office  XLSX Test Document")
                ->setSubject("Office XLSX Test Document")
                ->setDescription("Test document for Office XLSX, generated by PHP classes.")
                ->setKeywords("office openxml php")
                ->setCategory("Excel Sheet");


// Add some data                
        $cl = 'B';
        $bg = 'A';
        foreach ($dateSl as $date) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($cl . '3', $date);
            $objPHPExcel->getActiveSheet()->getColumnDimension($cl)->setWidth(3);
            $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getStyle($cl . '3')->getFont()->setSize(9);
            $objPHPExcel->getActiveSheet()->getStyle($cl . '3')->applyFromArray($dateArray);
            $objPHPExcel->getActiveSheet()->getStyle($cl . '4')->applyFromArray($bgcolor);
            $objPHPExcel->getActiveSheet()->getStyle($cl . '1')->applyFromArray($bgcolor);
            $objPHPExcel->getActiveSheet()->getStyle($cl . '2')->applyFromArray($bgcolor);
            $objPHPExcel->getActiveSheet()->getStyle($bg . '4')->applyFromArray($bgcolor);
            $objPHPExcel->getActiveSheet()->getStyle($bg . '1')->applyFromArray($bgcolor);
            $objPHPExcel->getActiveSheet()->getStyle($bg . '2')->applyFromArray($bgcolor);
            $objPHPExcel->getActiveSheet()->getStyle($cl . '3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $cl++;
        }

        $row = 5;
        $c = 0;
        foreach ($attendance as $name => $v_Emp) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A3', 'Name')
                    ->setCellValue('A' . $row, $employee[$name]->first_name . ' ' . $employee[$name]->last_name);
            $objPHPExcel->getActiveSheet()->getColumnDimension('A1')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
            $col = 1;
            foreach ($v_Emp as $v_result) {
                if (!empty($v_result)) {
                    foreach ($v_result as $Emp_atndnce) {
                        $objPHPExcel->getActiveSheet()->getStyle($row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $objPHPExcel->getActiveSheet()->getStyle($row, $col)->getFont()->setSize(10);
                        if ($Emp_atndnce->attendance_status == '0') {
                            $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValueByColumnAndRow($col, $row, 'A');
                        }
                        if ($Emp_atndnce->attendance_status == '1') {
                            $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValueByColumnAndRow($col, $row, 'P');
                        }
                        if ($Emp_atndnce->attendance_status == 'H') {
                            $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValueByColumnAndRow($col, $row, 'H');
                        }
                        $col++;
                    }
                }
            }
            $row++;
            $c++;
        }
// Rename worksheet (worksheet, not filename)
        $objPHPExcel->getActiveSheet()->setTitle('Student Attendance');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
//clean the output buffer
        ob_end_clean();
//this is the header given from PHPExcel examples. but the output seems somewhat corrupted in some cases.
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//so, we use this header instead.
        $filename = date("F j, Y, g:i a") . '  ' . 'Employee Attendance.xls'; //save our workbook as this file name
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function view_location() {
        $data['title'] = "View Location";
		
        $this->sitetable_Model->_table_name = "sitetable"; // table name
        $this->sitetable_Model->_primary_key = "id"; // $id 
        
        
        $data['all_locations'] = $this->sitetable_Model->getAllLocations();
        
     //   print_r($data);
        
        $data['subview'] = $this->load->view('admin/attendance/view_location', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function get_location($id){
        
        $this->sitetable_Model->_table_name = "sitetable"; // table name
        $this->sitetable_Model->_primary_key = "id"; // $id 
        
        
        $data['location'] = $this->sitetable_Model->getLocationByID($id);
        
        echo json_encode($data['location']);
    }
    
    public function  save_location()
    {
                $this->sitetable_Model->_table_name = "sitetable"; // table name
                $this->sitetable_Model->_primary_key = "id"; // $id 
                
                $id = $this->input->post('id', TRUE);
                $data['id'] = $this->input->post('id', TRUE);
                $data['status'] = $this->input->post('optstatus', TRUE);
                $data['gps_required'] = $this->input->post('optgps', TRUE);
                echo $id;
                if (!empty($id)) {
                    $this->sitetable_Model->save($data, $id);
                   
                } else {
                    $this->sitetable_Model->save($data, $id);
                }
    }
    
    
    public function  delete_location()
    {
                $this->sitetable_Model->_table_name = "sitetable"; // table name
                $this->sitetable_Model->_primary_key = "id"; // $id 
                
                $id = $this->input->post('id', TRUE);
                $data['id'] = $this->input->post('id', TRUE);
                echo $id;
                if (!empty($id)) {
                    $this->sitetable_Model->delete($data, $id);
                    
                }
    }
    
	public function view_overtime(){
        $data['title'] = "Overtime Management";
		
		$this->employee_model->_table_name = "tbl_user_type"; //table name
        $this->employee_model->_order_by = "user_type_id";
		$where = array(
			'id_gsettings' => $this->session->userdata('id_gsettings')
		);
        $data['user_type_info'] = $this->employee_model->get_by($where);
  
        // retrive all data from department table
        $this->employee_model->_table_name = "tbl_department"; //table name
        $this->employee_model->_order_by = "department_id";
        $all_dept_info = $this->employee_model->get_by(array('id_gsettings' => $this->session->userdata('id_gsettings')));
        // get all department info and designation info
        foreach ($all_dept_info as $v_dept_info) {
            $data['all_department_info'][$v_dept_info->department_name] = $this->employee_model->get_add_department_by_id($v_dept_info->department_id);
        }
        /// edit and update get employee award info
        if (!empty($id)) {
            $data['entitlement_info'] = $this->employee_model->get_employee_entitlement_by_id($id);

            // get all employee info by designation id
            $this->employee_model->_table_name = 'tbl_employee';
            $this->employee_model->_order_by = 'designations_id';
            $data['employee_info'] = $this->employee_model->get_by(array('designations_id' => $designations_id), FALSE);
        }
        // get all_employee_award_info
        $data['all_employee_entitlement_info'] = $this->employee_model->get_employee_entitlement_by_id();
		
		//echo $que = $this->db->last_query();die;
        $data['subview'] = $this->load->view('admin/attendance/overtime', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
	}
}