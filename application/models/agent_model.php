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

class Agent_Model extends MY_Model {


	public $_table_name;

	public $_order_by;

	public $_primary_key;


	public function login() {

		$proxy_name = $this->input->post('user_name');

		$this->_table_name = 'tbl_proxy';

		$this->_order_by = 'proxy_id';

		$proxy = $this->get_by(array('mail_address' => $proxy_name ,'proxy_password' =>$this->hash($this->input->post('password')),'proxy_state' => 2 ), TRUE);

		if (count($proxy)) {

			$data = array(
			'proxy_email' => $proxy->mail_address,
			'proxy_id' => $proxy->proxy_id,
			'loggedin' => TRUE,
			'user_type' => 3,
			'url' => 'agent/dashboard',
			);


			$data['employee_status'] = 0;

			$this->session->set_userdata($data);

			$this->loggedin();

			return $data;

		}
		else{

			$this->_table_name = 'tbl_proxy';

			$this->_order_by = 'proxy_id';

			$proxy = $this->get_by(array('mail_address' => $proxy_name ,'proxy_password' =>$this->hash($this->input->post('password')),'proxy_state' => 1 ), TRUE);

			if (count($proxy)) {

				$data = array(
				'proxy_email' => $proxy->mail_address,
				'proxy_id' => $proxy->proxy_id,
				'loggedin' => false,
				'user_type' => 4,
				'url' => 'agent/dashboard',
				);

				return $data;

			}

		}


	}

	public function loggedin() {

		return (bool) $this->session->userdata('loggedin');

	}


	public function hash($string) {

		return hash('sha512', $string . config_item('encryption_key'));

	}

	public function get_jisuan_jine($id){
		$this->_table_name = "tbl_proxy";// table name
		$this->_order_by = 'mail_address';
		$val = $this->get_by(array('proxy_id' => $id), TRUE);
		$agent_gourp = $val->agent_group;
		$proxy_name = $val->mail_address;
		$this->_table_name = "tbl_agent_group";// table name
		$this->_order_by = 'id';
		$v_application = $this->get_by(array('id' => $agent_gourp), TRUE);
		$today = date("Y-m-d", strtotime("+".$v_application->mode.' days')).date(" h:i:s");
		$this->db->select('tbl_order.*', FALSE);
		$this->db->from('tbl_order');
		$this->db->where('proxy_mail', $proxy_name);
		$query_result = $this->db->get();
		$result = $query_result->result();
		foreach ($result as $value) {
			if($value->submit_time < $today&&$value->jisuan_jine==null&&$value->order_status=='1'){
				$jisuanjine = $jisuanjine + $value->real_amount*($value->proxy_fee-$value->employee_fee)/100;
				$data = array('jisuan_jine' => 1);
				$where = array('order_id'=>$value->order_id);
				$this->set_action($where, $data, 'tbl_order');
			}

		}

		$xianzai_jine = $val->with_able_mount + $jisuanjine;
		$data = array('with_able_mount' => $xianzai_jine);
		$where = array('proxy_id'=>$id);
		$this->set_action($where, $data, 'tbl_proxy');
		return $xianzai_jine;
	}

	public function agent_info($id = NULL) {

		$this->db->select('tbl_proxy.*', FALSE);

		$this->db->select('tbl_card_type.*', FALSE);

		$this->db->from('tbl_proxy');

		$this->db->join('tbl_card_type', 'tbl_card_type.bank_id  = tbl_proxy.bank_name', 'left');

		if (!empty($id)) {

			$this->db->where('tbl_proxy.proxy_id', $id);

			$query_result = $this->db->get();

			$result = $query_result->row();

		}
		else {

			$query_result = $this->db->get();

			$result = $query_result->result_array();

		}


		return $result;

	}

	public function agent_fee_info($id = NULL) {
		$this->db->select('*', FALSE);
		$this->db->from('tbl_sdl');
		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}

	public function agent_fee_infomation($id = NULL) {
		$this->db->select('*', FALSE);
		$this->db->from('tbl_proxy');
		$this->db->join('tbl_agent_group', 'tbl_proxy.agent_group  = tbl_agent_group.id', 'left');
		$this->db->where('tbl_proxy.proxy_id', $id);
		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}

	public function agent_fee_emp_info($id = NULL) {
		$emp_id = $this->session->userdata('employee_id');
		$this->db->select('tbl_employee.*', FALSE);
		$this->db->from('tbl_employee');
		$this->db->where('tbl_employee.employee_id', $id);
		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}


	public function agent_key_info($id = NULL) {

		$this->db->select('*', FALSE);

		$this->db->from('tbl_proxy');

		$this->db->join('tbl_employee', 'tbl_employee.usr_gourp  = tbl_proxy.proxy_id', 'left');

		$this->db->where('tbl_employee.employee_id', $id);

		$query_result = $this->db->get();

		$result = $query_result->row();


		return $result;

	}


	public function agent_withdraw_info($id = NULL) {

		$this->db->select('tbl_agent_withdraw.*', FALSE);

		$this->db->from('tbl_agent_withdraw');

		if (!empty($id)) {

			$this->db->where('agent_id', $id);

			$query_result = $this->db->get();

			$result = $query_result->result_array();

		}
		else {

			$query_result = $this->db->get();

			$result = $query_result->result_array();

		}


		return $result;

	}


	public function search_orderinfo() {

		$agent_id = $this->session->userdata('proxy_id');

		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');

		$partner = $this->input->post('partner');

		$order_state = $this->input->post('order_state');

		$order_number = $this->input->post('order_number');

		$user_number = $this->input->post('user_number');

		$usr_gourp = $this->input->post('pay_method');

		$today = date("Y-m-d H:i:s");



		$sql  = "SELECT * from tbl_order where order_status = 1 and proxy_id = '".$agent_id."' ";

		if ($partner) {

			$sql .= " and employee_id= ".$partner ." ";

		}

		if ($order_state) {

			$sql .= " and order_status= '".$order_state ."'";

		}

		if ($usr_gourp) {
			$sql .= " and pay_method = '".$usr_gourp ."'";
		}

		if ($order_number) {

			$sql .= " and order_id= '".$order_number ."'";

		}

		if ($user_number) {

			$sql .= " and user_number= '".$user_number ."'";

		}


		if($start_date != NULL && $end_date != NULL){

			$sql .= "and submit_time between '$start_date 00:00:00' and '$end_date 23:59:59' ";

		}
		elseif ($start_date != NULL && $end_date == NULL){

			$sql .= "and submit_time between '$start_date 00:00:00' and '$today' ";

		}
		else if($start_date == NULL && $end_date != NULL){

			$sql .= "and submit_time between '2000-1-1 00:00:00' and '$end_date 23:59:59' ";

		}


		$sql .= " ORDER BY submit_time desc ";

		$query_result = $this->db->query($sql);

		$result = $query_result->result_array();

		//e		cho $this->db->last_query();

		return $result;

	}

	public function get_order_info($id){
		$this->db->select('tbl_order.*', FALSE);
		$this->db->from('tbl_order');
		$this->db->where('proxy_id', $id);
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	function verifyEmailID($key)
	{

		$this->_table_name = "tbl_proxy";
		// 		table name
		$this->_order_by = 'proxy_id';

		$is_verify = $this->get_by(array('md5(mail_address)'=>$key), TRUE);

		if(!empty($is_verify)){

			$data = array('proxy_state' => 0);

			$where = array('md5(mail_address)'=>$key);

			$this->set_action($where, $data, 'tbl_proxy');

		}
		else{

			$is_verify = false;

		}

		return $is_verify;

	}

	public function search_orderinfo_pay() {

		$agent_id = $this->session->userdata('proxy_id');

		$start_date = $this->input->post('start_date');

		$end_date = $this->input->post('end_date');

		$partner = $this->input->post('partner');

		$order_state = $this->input->post('order_state');

		$order_number = $this->input->post('order_number');

		$user_number = $this->input->post('user_number');

		$usr_gourp = $this->input->post('usr_gourp');

		$today = date("Y-m-d H:i:s");


		$sql  = "SELECT sum(real_amount) as pay from tbl_order where proxy_id = '".$agent_id."' ";

		if ($partner) {

			$sql .= " and employee_id= ".$partner ." ";

		}

		if ($order_state) {

			$sql .= " and order_status= '".$order_state ."'";

		}

		if ($usr_gourp) {
			$sql .= " and pay_mode = '".$usr_gourp ."'";
		}

		if ($order_number) {

			$sql .= " and order_id= '".$order_number ."'";

		}

		if ($user_number) {

			$sql .= " and order_id= '".$user_number ."'";

		}


		if($start_date != NULL && $end_date != NULL){

			$sql .= "and submit_time between '$start_date 00:00:00' and '$end_date 23:59:59' ";

		}
		elseif ($start_date != NULL && $end_date == NULL){

			$sql .= "and submit_time between '$start_date 00:00:00' and '$today' ";

		}
		else if($start_date == NULL && $end_date != NULL){

			$sql .= "and submit_time between '2000-1-1 00:00:00' and '$end_date 23:59:59' ";

		}


		$sql .= " ORDER BY submit_time desc ";


		$query_result = $this->db->query($sql);

		$result = $query_result->row();

		//e		cho $this->db->last_query();

		return $result;

	}


	public function agent_withdraw_money_info() {

		$agent_id = $this->session->userdata('proxy_id');

		$this->_table_name = "tbl_agent_withdraw";
		// 		table name
		$this->_order_by = 'id';
		$val = $this->get_by(array('agent_id' => $agent_id, 'pay_state' => 1,'pay_state' => 0), false);
		$sum_d  = 0;
		foreach($val as $sum_data){
			$sum_d = $sum_d + $sum_data->withdraw_mount;
		}
		return $sum_d;

	}


	public function agent_withdraw_request($id = NULL) {

		$agent_id = $this->session->userdata('proxy_id');

		$this->db->select('*', FALSE);

		$this->db->from('tbl_agent_withdraw');


		$this->db->where('agent_id', $agent_id);

		$query_result = $this->db->get();

		$result = $query_result->result_array();

		return $result;

	}


	public function agent_user_info($id = NULL) {
		$this->db->select('*', FALSE);
		$this->db->from('tbl_employee');
		if (!empty($id)) {
			$this->db->where('agent_group', $id);
			$query_result = $this->db->get();
			$result = $query_result->result_array();
		}
		else {
			$query_result = $this->db->get();
			$result = $query_result->result_array();
		}
		return $result;
	}


	public function agent_channel($id = NULL) {

		$this->_table_name = "tbl_proxy";
		// 		table name
		$this->_order_by ="proxy_id";

		$agent_data =  $this->get_by(array('proxy_id' => $id), true);

		$agent_gourp1 = $agent_data->agent_group;

		$agent_table = 'agent'.$agent_gourp1;

		$this->db->select($agent_table.' as rate_row', FALSE);

		$this->db->select('tbl_channel_rate.channel_code', FALSE);

		$this->db->from('tbl_channel_rate');

		$query_result = $this->db->get();

		$result = $query_result->result();

		return $result;

	}

	public function get_jin_finance($id = NULL) {

		$this->db->select('*', FALSE);
		$start_date = date("Y-m-d").'00:00:00';
		$this->db->from('tbl_order');
		$this->db->where('partner', $id);
		$this->db->where('submit_time >=', $start_date);
		$query_result = $this->db->get();
		$result = $query_result->result();
		foreach($result as $val){
			if($val->banktype == 'ALIPAY'){
				$data['ALIPAY_price'] = $data['ALIPAY_price'] + $val->real_amount;

			}
			elseif($val->banktype == 'ALIPAYWAP'){

				$data['ALIPAYWAP_price'] = $data['ALIPAYWAP_price'] + $val->real_amount;


			}

			elseif($val->banktype == 'TENPAY'){

				$data['TENPAY_price'] = $data['TENPAY_price'] + $val->real_amount;


			}

			elseif($val->banktype == 'WEIXIN'){

				$data['WEIXIN_price'] = $data['WEIXIN_price'] + $val->real_amount;


			}

			elseif($val->banktype == 'WEIXINWAP'){

				$data['WEIXINWAP_price']= $data['WEIXINWAP_price'] + $val->real_amount;


			}
			elseif($val->banktype == 'DAIFU'){

				$data['DAIFU_price'] =$data['DAIFU_price'] + $val->real_amount;


			}
			else{

				$data['online_price'] = $data['online_price'] + $val->real_amount;

			}

		}
        return $data;


	}

	public function agent_order_data($id = NULL) {

		$this->db->select('*', FALSE);

		$start_date = date("Y-m-d").'00:00:00';

		$this->db->from('tbl_order');

		$this->db->where('proxy_id', $id);

		$this->db->where('submit_time >=', $start_date);

		$query_result = $this->db->get();

		$result = $query_result->result_array();

		return $result;

	}

	public function agent_user_info_zuo($id = NULL) {
		$start_date = date('Y-m-d',strtotime("-1 days"));

		$sql  = "SELECT * from tbl_order where proxy_id = '".$id."' ";
		$sql .= " and submit_time between '$start_date 00:00:00' and '$start_date 23:59:59' ";
		$query_result = $this->db->query($sql);
		$result = $query_result->result_array();

		return $result;
	}

	public function agent_withdraw_limit_amount($id = NULL, $with_time) {
		$start_date = date('Y-m-d',strtotime("-".$with_time." days"));

		$sql  = "SELECT * from tbl_order where proxy_id = '".$id."' ";
		$sql .= " and submit_time >= '$start_date 23:59:59' ";
		$query_result = $this->db->query($sql);
		$result = $query_result->result_array();

		return $result;
	}


	public function agent_orderinfo($id = NULL) {

		$this->db->select('*', FALSE);

		$this->db->from('tbl_order');
		$this->db->where('order_status', '1');


		if (!empty($id)) {

			$this->db->where('proxy_id', $id);


		}

		$this->db->order_by('submit_time','desc');

		$query_result = $this->db->get();

		$result = $query_result->result_array();

		return $result;

	}




	public function get_order_view($employee_id) {

		$this->db->select('tbl_order.*', FALSE);

		$this->db->select('tbl_channel_rate.*', FALSE);

		$this->db->from('tbl_order');

		$this->db->join('tbl_channel_rate', 'tbl_order.pay_method = tbl_channel_rate.id', 'left');

		$this->db->where('tbl_order.order_id', $employee_id);

		$query_result = $this->db->get();

		$result = $query_result->result();

		return $result;

	}

	public function get_channel_rate(){

		$this->db->select('*', FALSE);

		$this->db->from('tbl_channel_rate');

		$query_result = $this->db->get();

		$result = $query_result->result_array();

		return $result;

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

	public function all_order_table_info($employee_id = null) {

		$this->db->select('tbl_order.*', FALSE);

		$this->db->select('tbl_card_type.*', FALSE);

		$this->db->select('tbl_employee.*', FALSE);

		$this->db->from('tbl_order ');

		$this->db->join('tbl_card_type', 'tbl_order.pay_method = tbl_card_type.id', 'left');

		$this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_order.employee_id', 'left');

		$this->db->where('tbl_order.employee_id', $employee_id);

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

			for ($i=0;$i<count($recordSet);$i++){

				$result[$i] = $recordSet[$i];

			}

			return $result;

		}
		else{
			return 0;
		}


	}

}
