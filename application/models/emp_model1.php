<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emp_model
 *
 * @author nayem
 */
class Emp_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function all_emplyee_info($id = NULL) {
        $this->db->select('tbl_employee.*', FALSE);
        // $this->db->select('tbl_employee_bank.*', FALSE);
        // $this->db->select('tbl_employee_document.*', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('countries.countryName', FALSE);
        $this->db->from('tbl_employee');
        // $this->db->join('tbl_employee_bank', 'tbl_employee_bank.employee_id = tbl_employee.employee_id', 'left');
        // $this->db->join('tbl_employee_document', 'tbl_employee_document.employee_id  = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
        $this->db->join('countries', 'countries.idCountry  = tbl_employee.country_id', 'left');
        if (!empty($id)) {
            $this->db->where('tbl_employee.employee_id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }
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
        }
        return $result;
    }
    public function get_log_data($id){
        $this->db->select('tbl_log.*', FALSE);
        $this->db->from('tbl_log');
        $this->db->order_by("id", "DESC");
        $this->db->where('employee_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;        
    }
    public function get_all_channel_rate($employee_id){
        $this->db->select('tbl_employee.usr_gourp', FALSE);
        $this->db->from('tbl_employee');
        $this->db->where('tbl_employee.employee_id', $employee_id);
        $query_result = $this->db->get();
        $usr_gourp = $query_result->row();
        $this->db->select('channel_name, cost_rate'.$usr_gourp, FALSE);
        $this->db->from('tbl_channel_rate');
        $query_result = $this->db->get();
        $channel_rate = $query_result->result();   
        return $channel_rate;
    }
    public function save_data($data){
        $this->_table_name = "tbl_employee";
        $this->_order_by = 'employment_id';
        $sign = array(
        'usr_law_name' => $data['law_name'],
        'employment_id' => $data['usr_email'],
        'usr_mobile' => $data['usr_mobile'],
        'usr_email' =>$data['usr_email'],
        'usr_gourp'=>$data['emp_group_id'],
        'usr_bank_name' =>$data['usr_bank_name'],
        'usr_bank_num' =>$data['usr_bank_num'],
        'usr_company_name' => $data['usr_company_name'],
        'id_gsettings' => 1,
        'usr_email_status' => 1       
        );
        $setting_id = $this->save($sign, $id);
        $this->_table_name = "tbl_employee"; // table name
        $this->_order_by = 'employment_id';
        $val = $this->get_by(array('employment_id' => $data['usr_email']), TRUE);
        $this->_table_name = "tbl_employee_login"; // table name
        $this->_order_by = 'employment_id';        
        $emlogn = array(
        'employee_id' => $val->employee_id,
        'password' => $data['password'],
        'user_name' => $data['usr_email'],
        );
        $setting_id = $this->save($emlogn, $id);
        return $setting_id;
    }
    public function get_order_data($employee_id, $banktype){
        $this->_table_name = "tbl_employee"; // table name
        $this->_order_by = 'employee_id';
        $val = $this->get_by(array('employee_id' => $employee_id), TRUE); 
        $usr_gorup = $val->usr_gourp;
        $this->_table_name = "tbl_employee_group"; // table name
        $this->_order_by = 'id';
        $result1 = $this->get_by(array('id' => $usr_gorup), TRUE);  
         $chanel_name = '';
         if($banktype == 'ALIPAY'){
           $chanel_name = 'channel_alipay';
        }elseif($banktype == 'ALIPAYWAP'){
           $chanel_name = 'channel_wapalipay';
        }elseif($banktype == 'TENPAY'){
           $chanel_name = 'channel_tenpay';
        }
        elseif($banktype == 'WEIXIN'){
           $chanel_name = 'channel_weixin';            
        }
        elseif($banktype == 'WEIXINWAP'){
           $chanel_name = 'channel_wapweixin';

        }
        else{
           $chanel_name = 'channel_online';
        }
        return $result1->$chanel_name;
        // $this->db->select('tbl_employee_group.*', FALSE);
        // $this->db->from('tbl_employee');
        // $this->db->join('tbl_employee_group', 'tbl_employee_group.id  = tbl_employee.usr_gourp', 'left');
        // $this->db->where('tbl_employee.employee_id', $employee_id);
        // $query_result = $this->db->get();
        // $result = $query_result->result();
        // return $result1; 
    public function get_order_data($employee_id){
        
        $this->db->select('tbl_employee_group.*', FALSE);
        $this->db->from('tbl_employee');
        $this->db->join('tbl_employee_group', 'tbl_employee_group.id  = tbl_employee.usr_gourp', 'left');
        $this->db->where('tbl_employee.employee_id', $employee_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result; 
    public function get_order_data($employee_id, $banktype){

        $this->db->select('tbl_employee_group.'.$banktype , FALSE);
        $this->db->from('tbl_employee_group');
        $this->db->join('tbl_employee', 'tbl_employee_group.id  = tbl_employee.usr_gourp', 'left');
        $this->db->where('tbl_employee.employee_id', $employee_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result; 
    }
  function verifyEmailID($key)
    {       
        $this->_table_name = "tbl_employee"; // table name
        $this->_order_by = 'employment_id';
        $is_verify = $this->get_by(array('md5(employment_id)'=>$key), TRUE);        
        if($is_verify){
            $data = array('usr_email_status' => 0, 'usr_status'=>'0');
            $where = array('md5(employment_id)'=>$key);
            $this->set_action($where, $data, 'tbl_employee');
            $val = $this->get_by(array('md5(employment_id)' => $key), TRUE);           
            $sdata = array('activate'=>'0');
            $where = array('employee_id'=>$val->employee_id);
            $this->set_action($where, $sdata,  'tbl_employee_login');
        }else{
            $is_verify = false;

        }
        return $is_verify;
    }
    public function get_tbl_gsetting(){
        $this->_table_name = 'tbl_gsettings';
        $this->_order_by = 'id_gsettings';
        $gsettings = $this->get_by(array('id_gsettings' => 1,), TRUE);
        return $gsettings;

    }
    public function get_price_info($id){
        $this->_table_name = "tbl_order"; // table name
        $this->_order_by = 'employee_id';
        $val = $this->get_by(array('employee_id' => $id), false);
        $data['order_count'] = count($val);
        $data['success_count']=0;
        $data['failed_count']=0;
        $data['processing_count'] = 0;
        foreach($val as $tempval){
            $data['submit_amount']+=$tempval->real_amount;
            if($tempval->order_status=='1'){
                $data['success_amount']+=$tempval->success_price;
                $data['success_count']++;
            }elseif($tempval->order_status=='-1'){
                $data['failded_amount']+=$tempval->success_price;
                $data['failed_count']++;
            }elseif($tempval->order_status=='0'){
                $data['processing_amount']+=$tempval->real_amount;
                $data['processing_count']++;
            }
        }
        $this->_table_name = "tbl_delivery"; // table name
        $this->_order_by = 'employee_id';
        $val = $this->get_by(array('employee_id' => $id), false);
        $data['delivery_count'] = 0;
        $data['s_delivery_count'] = 0;
        $data['f_delivery_count'] = 0;
        $data['p_delivery_count'] = 0;
        foreach($val as $tmepval){
            $data['delivery_amount']+=$tempval->devlivery_mount;
            $data['delivery_count']++;
            if($tempval->delivery_status == '0'){
                $data['s_delivery_amount']+=$tempval->devlivery_mount;
                $data['s_delivery_count']++;

            }elseif($tempval->delivery_status == '-1'){
                $data['f_delivery_amount']+=$tempval->devlivery_mount;
                $data['f_delivery_count']++;
            }else{
                $data['p_delivery_amount']+=$tempval->devlivery_mount;
                $data['p_delivery_count']++;
            }

        }
        $this->_table_name = "tbl_order"; // table name
        $this->_order_by = 'employee_id';
        $jintian = date("Y-m-d")." 00:00:00";
        $val = $this->get_by(array('employee_id' => $id, 'submit_time >='=> $jintian), false);       
        foreach($val as $tempval){
        if($tempval->banktype == 'ALIPAY'){
             $data['ALIPAY_amount']+=$tempval->real_amount*$tempval->cost_ratio;           
        }elseif($tempval->banktype == 'ALIPAYWAP'){
            $data['ALIPAYWAP_amount']+=$tempval->real_amount*$tempval->cost_ratio;   
        }elseif($tempval->banktype == 'TENPAY'){
            $data['tenpay_amount']+=$tempval->real_amount*$tempval->cost_ratio;   
        }
        elseif($tempval->banktype == 'WEIXIN'){
            $data['weixin_amount']+=$tempval->real_amount*$tempval->cost_ratio;   
        }
        elseif($tempval->banktype == 'WEIXINWAP'){
            $data['weixinwap_amount']+=$tempval->real_amount*$tempval->cost_ratio;   

        }
        else{
            $data['onine_amount']+=$tempval->real_amount*$tempval->cost_ratio;   
        }
        }
           
        $this->_table_name = "tbl_delivery"; // table name
        $this->_order_by = 'employee_id';
        $val = $this->get_by(array('employee_id' => $id,'delivery_time >='=> $jintian), false);
        foreach($val as $tmepval){
            $data['jin_delivery_amount']+=$tempval->devlivery_mount;           

        }


        return $data;
    }
    public function all_emplyee_table_info() {
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->from('tbl_employee');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_all_notice($limit = NULL) {
        $this->db->select('tbl_notice.*', FALSE);
        $this->db->from('tbl_notice');
        if (!empty($limit)) {
            $this->db->limit('5');
        }
        $this->db->where('flag', 1);
        $this->db->order_by("notice_id", "desc");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_all_events() {
        // $this->db->select('*');
        // $this->db->from('tbl_holiday');
        // $this->db->limit('7');
        // $this->db->order_by("start_date", "desc");
        // $query_result = $this->db->get();
        // $result = $query_result->result();
        // return $result;
    }

    public function get_all_awards($id = NULL) {
        
    }
    public function get_user_phone_number($id){
        $this->db->select('tbl_employee.usr_mobile', FALSE);
        $this->db->from('tbl_employee');
        $this->db->where('tbl_employee.employee_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_withdraw_data($id){
        $this->db->select('tbl_delivery.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->from('tbl_delivery');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id  = tbl_delivery.employee_id', 'left');
        $this->db->where($id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_all_leave_applied($employee_id) {


    }

    public function get_employee_all_leave_applied() {

    }

    public function get_specific_employee_all_leave_applied($application_list_id) {
        // $this->db->select('tbl_application_list.*', FALSE);
        // $this->db->select('tbl_leave_category.*', FALSE);
        // $this->db->select('tbl_employee.*', FALSE);
        // $this->db->from('tbl_application_list');
        // $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_application_list.employee_id', 'left');
        // $this->db->join('tbl_leave_category', 'tbl_leave_category.leave_category_id  = tbl_application_list.leave_category_id', 'left');
        // $this->db->where('tbl_application_list.application_list_id', $application_list_id);
        // $query_result = $this->db->get();
        // $result = $query_result->result();
        // return $result;
    }

    public function get_approved_leave($employee_id) {
        // $this->db->select('tbl_application_list.*', FALSE);
        // $this->db->select('tbl_leave_category.*', FALSE);
        // $this->db->from('tbl_application_list');
        // $this->db->join('tbl_leave_category', 'tbl_leave_category.leave_category_id  = tbl_application_list.leave_category_id', 'left');
        // $this->db->where('tbl_application_list.employee_id', $employee_id);
        // $this->db->where('tbl_application_list.application_status', 2);
        // $query_result = $this->db->get();
        // $result = $query_result->result();
        // return $result;
    }

    public function get_total_attendace_by_date($start_date, $end_date, $employee_id) {
        $this->db->select('tbl_attendance.*', FALSE);
        $this->db->from('tbl_attendance');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_delivery_info($employee_id){
        $this->db->select('tbl_delivery.*', FALSE);
        $this->db->from('tbl_delivery');
        $this->db->where('employee_id', $employee_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;


    }

    public function get_public_holiday($start_date, $end_date) {
        // $this->db->select('tbl_holiday.*', FALSE);
        // $this->db->from('tbl_holiday');
        // $this->db->where('start_date >=', $start_date);
        // $this->db->where('end_date <=', $end_date);
        // $query_result = $this->db->get();
        // $result = $query_result->result();
        // return $result;
    }
    public function all_order_table_info($employee_id = null) {
        $this->db->select('tbl_order.*', FALSE);
        $this->db->select('tbl_channel_rate.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->from('tbl_order ');
        $this->db->join('tbl_channel_rate', 'tbl_order.pay_method = tbl_channel_rate.id', 'left');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_order.employee_id', 'left');
        $this->db->where('tbl_order.employee_id', $employee_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_all_empolyee_info($id = null, $agent=null ) {

        $this->db->select('tbl_employee.*', FALSE);
        $this->db->from('tbl_employee ');
        if(!empty($agent)){
        $this->db->join('tbl_proxy', 'tbl_proxy.proxy_id = tbl_employee.', 'left');            
        }
        $this->db->join('tbl_channel_rate', 'tbl_order.pay_method = tbl_channel_rate.id', 'left');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_order.employee_id', 'left');
        $this->db->where('tbl_order.employee_id', $employee_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function search_order_table_info($data) {
        $this->db->select('tbl_order.*', FALSE);
        $this->db->select('tbl_channel_rate.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->from('tbl_order ');
        $this->db->join('tbl_channel_rate', 'tbl_order.pay_method = tbl_channel_rate.id', 'left');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_order.employee_id', 'left');
        $this->db->where($data);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function order_order_view($employee_id) {
        $this->db->select('tbl_order.*', FALSE);
        $this->db->select('tbl_channel_rate.*', FALSE);
        $this->db->from('tbl_order');
        $this->db->join('tbl_channel_rate', 'tbl_order.pay_method = tbl_channel_rate.id', 'left');
        $this->db->where('tbl_order.order_id', $employee_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_cardtype_info($id) {
        $this->db->select('tbl_card_type.*', FALSE);
        $this->db->from('tbl_card_type ');
        $this->db->where('tbl_card_type.id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function all_get_cardtype_table() {
        $this->db->select('tbl_card_type.*', FALSE);
        $this->db->from('tbl_card_type ');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_day_base_total_hours($emp_id, $date)
    {
        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $satrt_date = $year.'-'.$month.'-'.'01';
        $end_date = $year.'-'.$month.'-'.$num;
        $sql = "SELECT *, SEC_TO_TIME(sum(TIME_TO_SEC(STR_TO_DATE(`time_out`, '%h:%i %p'))-TIME_TO_SEC(STR_TO_DATE(`time_in`, '%h:%i %p')))) as workingTime from tbl_attendance where `employee_id`=$emp_id and `attendance_status`=1 and `date` between '".$satrt_date."' and '".$end_date."' group by `date` ";
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
}
