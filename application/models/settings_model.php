<?php

class Settings_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_working_days() {
        $this->db->select('tbl_working_days.*', FALSE);
        $this->db->select('tbl_days.day', FALSE);
        $this->db->from('tbl_working_days');
        $this->db->join('tbl_days', 'tbl_working_days.day_id = tbl_days.day_id', 'left');
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function withdraw_counts() {
        $this->db->select('*', FALSE);
        $this->db->from('tbl_agent_withdraw');
        $this->db->where('time_state', 0);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function withdraw_counts_emp() {
        $this->db->select('*', FALSE);
        $this->db->from('tbl_delivery');
        $this->db->where('time_state', 0);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_all_agent() {
         $employee_id = $this->input->post('employee_id');
         $emp_email = $this->input->post('emp_email');
         $qq = $this->input->post('qq');
         $phone = $this->input->post('phone');
         $status = $this->input->post('status');
        $this->db->select('tbl_proxy.*, tbl_agent_group.*', FALSE);
        $this->db->from('tbl_proxy');
        $this->db->join('tbl_agent_group', 'tbl_agent_group.id = tbl_proxy.agent_group', 'left');

        if (!empty($employee_id)) {
            $this->db->where('tbl_proxy.proxy_id', $employee_id);
        }
        if (!empty($emp_email)) {
            $this->db->where('tbl_proxy.mail_address', $emp_email);
        }
        if (!empty($qq)) {
            $this->db->where('tbl_proxy.qq_num', $qq);
        }
        if (!empty($phone)) {
            $this->db->where('tbl_proxy.contact_number', $phone);
        }
        if ($status==1) {
            $this->db->where('tbl_proxy.proxy_state', 1);
        }elseif ($status==2) {
            $this->db->where('tbl_proxy.proxy_state', 2);
        }elseif ($status==3) {
            $this->db->where('tbl_proxy.proxy_state', 3);
        }elseif ($status==4) {
            $this->db->where('tbl_proxy.proxy_state', 4);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
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
    //@sunny 22 august 2016
    public function get_working_week_days() {
        $this->db->select('tbl_working_days.*', FALSE);
        $this->db->select('tbl_days.day', FALSE);
        $this->db->from('tbl_working_days');
        $this->db->join('tbl_days', 'tbl_working_days.day_id = tbl_days.day_id', 'left');
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		$this->db->where('flag', 1);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_holiday_list_by_date($start_date, $end_date) {
        $this->db->select('tbl_holiday.*', FALSE);
        $this->db->from('tbl_holiday');
        $this->db->where('start_date >=', $start_date);
        $this->db->where('end_date <=', $end_date);
		$this->db->where(array('id_gsettings' => $this->session->userdata('id_gsettings')));

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
     public function delete_order($order_id) {
        //  $this->db->select('tbl_order.id', FALSE);
        // $this->db->from('tbl_order');
        // $this->db->where('order_id', $order_id);

        $this->_table_name = "tbl_order"; // table name
        $this->_order_by = "order_id";
        $this->_primary_key = "id";

        $user_info = $this->get_by(array('order_id' => $order_id), TRUE);
        $_id=$user_info->id;
        // $id
        $this->delete($_id);
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

    public function delete_all($table) {
        $this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		$this->db->delete($table);
    }

    public function select_general_info() {
        $this->db->select('*');
        $this->db->from('tbl_gsettings');

        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    public function get_company_info() {
        $this->db->select('*');
		$this->db->where('id_gsettings >= 1',NULL,FALSE);
        $this->db->from('tbl_gsettings');

        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_card_info() {
        $this->db->select('*');
        $this->db->from('tbl_card_type');
        $this->db->where('pay_type_status', 1);
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_employee_withdraw_info($state, $bankstatus) {
        $this->db->select('*');
        $this->db->from('tbl_delivery');
        $this->db->where('delivery_status', $state);
        if ($bankstatus==2) {
        $this->db->where('pay_mode', 'ONLINE');
        }elseif ($bankstatus==3) {
        $this->db->where('pay_mode', 'ALIPAY');
        }elseif ($bankstatus==4) {
        $this->db->where('pay_mode', 'TENPAY');
        }
        $query_result = $this->db->get();

       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function update_employee_money($employee_id,$money){
        $sql  = "UPDATE `tbl_employee` SET `usr_amount` = `usr_amount`+".$money
                ." WHERE `tbl_employee`.`employee_id` = '".$employee_id."'";
        $query_result = $this->db->query($sql);
        return true;
    }

    public function search_employee_withdraw_info($state) {
        $employee_id = $this->input->post('employee_id');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $bank_name = $this->input->post('bank_name');
        $today = date("Y-m-d H:i:s");


        $sql  = "SELECT * from tbl_delivery where delivery_status = '".$state."' ";
        if ($employee_id) {
            $sql .= " and employee_id= '".$employee_id ."'";
        }
        if ($bank_name) {
            $sql .= " and delivery_bank_card like '%$bank_name%'";
        }

        if($start_date != NULL && $end_date != NULL){
            $sql .= "and complete_time between '$start_date' and '$end_date' ";
        }elseif ($start_date != NULL && $end_date == NULL){
            $sql .= "and complete_time between '$start_date' and '$today' ";
        }else if($start_date == NULL && $end_date != NULL){
             $sql .= "and complete_time between '2000-1-1 00:00:00' and '$end_date' ";
        }

        $sql .= " ORDER BY complete_time desc ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result_array();
        return $result;
    }

    public function all_get_order_info($data = null) {
        $this->db->select('tbl_order.*,tbl_order.id as jangfu ,tbl_order.employee_id as infome', FALSE);
        $this->db->select('tbl_channel_rate.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_channel.*, tbl_channel.channel_name as cha_name', FALSE);
        $this->db->from('tbl_order');
        $this->db->join('tbl_channel_rate', 'tbl_order.pay_method = tbl_channel_rate.id', 'left');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_order.employee_id', 'left');
        $this->db->join('tbl_channel', 'tbl_channel.id = tbl_order.channel_id', 'left');
        $this->db->order_by('tbl_order.submit_time','desc');
        if($data){
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        //echo $this->db->last_query();
        $result = $query_result->result();
        return $result;
    }

    public function update_status($id,$status){
        $time = date("Y-m-d H:m:s", time());
        $sql = "select * from tbl_order where order_id = '".$id."'";
        $result1 = $this->db->query($sql);
        $row = $result1->row($result1);
        //查询商户
        $sql = "select * from tbl_employee where employee_id = ".$row->employee_id;
        $result1 = $this->db->query($sql);
        $rs = $result1->row($result1);
        $fl = $this->_get_fl($rs);

        //获取商户使用费率
        if($rs->rate_status == 0){
            $sql = "select * from tbl_employee_group where id = ".$rs->usr_gourp;
            $result1 = $this->db->query($sql);
            $rs = $result1->row($result1);
            $fl = $this->_get_fl($rs);
        }
        $sql = "select gateway_name,gateway_rate_basic,gateway_type from tbl_channel where id = ".$row->banktype;
        $result1 = $this->db->query($sql);
        $rs = $result1->row($result1);
        $row->banktype = $rs->gateway_name;
        $row->gateway_rate_basic = $rs->gateway_rate_basic;
        //查询网关类别
        $sql = "select * from tbl_gateway_type where id = ".$rs->gateway_type;
        $result1 = $this->db->query($sql);
        $gateway_info = $result1->row($result1);
        $shfl = $fl[$gateway_info->channel_code];
        $success_price = round($row->real_amount * $shfl / 100,2);
        $sql = "UPDATE tbl_order SET order_status = '".$status."',release_time = '".$time."',"
                . "success_price = '".$success_price."',cost_ratio='".$shfl."' WHERE order_id = '" .$id."'";
        $this->db->query($sql);
        $this->update_employee_money($row->employee_id, $success_price);
        return true;
    }

    public function all_get_order($data = null) {
        $this->db->select('*', FALSE);
        $this->db->from('tbl_order');
        $this->db->order_by('submit_time','desc');
        if($data){
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        //echo $this->db->last_query();
        $result = $query_result->result_array();
        foreach ($result as &$row){
            $sql = "select gateway_name,gateway_rate_basic,gateway_type from tbl_channel where id = ".$row['banktype'];
            $result1 = $this->db->query($sql);
            $rs = $result1->row($result1);
            $row['banktype'] = $rs->gateway_name;
            $row['gateway_rate_basic'] = $rs->gateway_rate_basic;
            //查询网关类别
            $sql = "select * from tbl_gateway_type where id = ".$rs->gateway_type;
            $result1 = $this->db->query($sql);
            $gateway_info = $result1->row($result1);

            $sql = "select channel_name,channel_cost_ratio,channel_status from tbl_channel where id = ".$row['pay_mode'];
            $result1 = $this->db->query($sql);
            $rs = $result1->row($result1);
            $row['pay_mode'] = $rs->channel_name;
            if($rs->channel_status){
                $row['ok_real_amount'] = $row['real_amount'] * $rs->channel_cost_ratio / 100;
            }else{
                $row['ok_real_amount'] = $row['real_amount'] * $row['gateway_rate_basic'] / 100;
            }
            //查询商户
            $sql = "select * from tbl_employee where employee_id = ".$row['employee_id'];
            $result1 = $this->db->query($sql);
            $rs1 = $result1->row($result1);
            $fl = $this->_get_fl($rs);

            //获取商户使用费率
            if($rs->rate_status == 0){
                $sql = "select * from tbl_employee_group where id = ".$rs1->usr_gourp;
                $result1 = $this->db->query($sql);
                $rs = $result1->row($result1);
                $fl = $this->_get_fl($rs);
            }
            $shfl = $fl[$gateway_info->channel_code];

            //判断商户是否是平台直属的商户
            if($rs->agent_group == 1){
                $row['agent_amount'] = 0;
                $row['employee_amount'] = round($row['real_amount'] * $shfl / 100,2);
                $row['platform_amount'] = round($row['ok_real_amount'] - $row['employee_amount'],2);
            }else{
                //获取代理使用费率
                //查询代理
                $sql = "select * from tbl_proxy where proxy_id = ".$rs1->agent_group;
                $result1 = $this->db->query($sql);
                $rs = $result1->row($result1);
                $sql = "select * from tbl_agent_group where id = ".$rs->agent_group;
                $result1 = $this->db->query($sql);
                $rs = $result1->row($result1);
                $fl = $this->_get_fl($rs);
                $dlfl = $fl[$gateway_info->channel_code];

                $row['agent_amount'] = round($row['real_amount'] * ($dlfl - $shfl) / 100,2);
                $row['employee_amount'] = round($row['real_amount'] * $shfl / 100,2);
                $row['platform_amount'] = round($row['ok_real_amount'] - $row['agent_amount'] - $row['employee_amount'],2);
            }
            //echo $row['ok_real_amount']."=".$row['agent_amount']."=".$row['employee_amount']."=".$row['platform_amount'];die;
        }
        return $result;
    }

    function _get_fl($obj){
        return array(
            "ONLINE" => $obj->ONLINE,
            "ALIPAY" => $obj->ALIPAY,
            "TENPAY" => $obj->TENPAY,
            "WEIXIN" => $obj->WEIXIN,
            "ALIPAYWAP" => $obj->ALIPAYWAP,
            "WEIXINWAP" => $obj->WEIXINWAP,
            "DAUFU" => $obj->DAUFU,
        );
    }

    public function get_o_info($order_id){
        $sql = "select * from tbl_order where order_id = ".$order_id;
        $result1 = $this->db->query($sql);
        $rs = $result1->row($result1);
        return $rs;
    }

    public function get_order_info($order_id) {
        $this->db->select('tbl_order.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_channel_rate.*', FALSE);
        $this->db->select('tbl_channel.*, tbl_channel.channel_name as cha_name', FALSE);
        $this->db->from('tbl_order ');
        $this->db->join('tbl_channel_rate', 'tbl_order.pay_method = tbl_channel_rate.id', 'left');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_order.employee_id', 'left');
        $this->db->join('tbl_channel', 'tbl_channel.id = tbl_order.channel_id', 'left');
        $this->db->order_by('tbl_order.submit_time','desc');
        $this->db->where('tbl_order.order_id', $order_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

      public function get_order_infomation($id=null) {
        $this->db->select('tbl_order.*', FALSE);
        $this->db->select('tbl_card_type.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_channel_manage.*', FALSE);
        $this->db->from('tbl_order ');
        $this->db->join('tbl_card_type', 'tbl_order.pay_method = tbl_card_type.id', 'left');
        $this->db->join('tbl_employee', 'tbl_employee.employee_id = tbl_order.employee_id', 'left');
        $this->db->join('tbl_channel_manage', 'tbl_channel_manage.id = tbl_card_type.channel_id', 'left');
        $this->db->where('tbl_order.id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    //agent withdraw
    public function get_issued_info($id) {
        $this->db->select('*');
        $this->db->from('tbl_finance');
        $this->db->where('finance_operation', $id);
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function employee_withdraw_com($id) {
        $this->db->select('tbl_employee.* , tbl_log.*');
        $this->db->from('tbl_employee');
        $this->db->join('tbl_log', 'tbl_log.employee_id = tbl_employee.employee_id', 'left');
        $this->db->where('usr_status', $id);
        $this->db->group_by('tbl_employee.employee_id');
        $this->db->order_by('tbl_log.login_time','asc');
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function employee_withdraw_sear_com($id) {
        $employee_id = $this->input->post('employee_id');
        $request_mount = $this->input->post('request_mount');
        $able_mount = $this->input->post('able_mount');

        $sql  = "SELECT a.*, a.employee_id as emp_id ,b.* from tbl_employee a LEFT JOIN tbl_log b ON b.employee_id = a.employee_id where a.status = ".$id." and a.usr_status = ".$id;
        if ($employee_id) {
            $sql .= " and a.employee_id= '".$employee_id ."'";
        }
        if ($request_mount!=null &&  $able_mount!=null) {
            $sql .= " and a.usr_amount between $request_mount and $able_mount ";
        }
        if ($request_mount!=null &&  $able_mount==null) {
            $sql .= " and a.usr_amount > $request_mount ";
        }
        if ($request_mount==null &&  $able_mount!=null) {
            $sql .= " and a.usr_amount < $able_mount ";
        }
        $sql .= " GROUP BY a.employee_id";
        $query_result = $this->db->query($sql);
        $result = $query_result->result_array();
        return $result;
    }

    public function get_gateway_info($id=null) {
        $this->db->select('tbl_channel.*,tbl_channel.id as num , tbl_channel.channel_code as cha_code');
        $this->db->select('tbl_gateway_type.*');
        $this->db->from('tbl_channel');
        $this->db->join('tbl_gateway_type', 'tbl_gateway_type.id = tbl_channel.gateway_type', 'left');
        if ($id) {
        $this->db->where('tbl_channel.channel_type', $id);
        }
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_gatewayinfo($id=null) {
        $this->db->select('tbl_channel.*');
        $this->db->from('tbl_channel');
        if ($id) {
        $this->db->where('tbl_channel.gateway_type', $id);
        }
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_gateway_view_info($id=null) {
        $this->db->select('tbl_channel.*,tbl_channel.id as num');
        $this->db->select('tbl_gateway_type.*');
        $this->db->from('tbl_channel');
        $this->db->join('tbl_gateway_type', 'tbl_gateway_type.id = tbl_channel.gateway_type', 'left');
        $this->db->where('tbl_channel.gateway_type', $id);
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_gateway_list($id=null) {
        $this->db->select('tbl_channel.*,tbl_channel.id as num');
        $this->db->select('tbl_gateway_type.*');
        $this->db->from('tbl_channel');
        $this->db->join('tbl_gateway_type', 'tbl_gateway_type.id = tbl_channel.gateway_type', 'left');
        $this->db->where('tbl_channel.parent', 1);
        if ($id) {
        $this->db->where('tbl_channel.gateway_type', $id);
        }
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_gateway_list_json($id=null) {
        $this->db->select('tbl_channel.gateway_name,tbl_channel.id,tbl_channel.gateway_rate_basic');
        $this->db->from('tbl_channel');
        $this->db->where('gateway_type', $id);
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_basic_list_json($id=null) {
        $this->db->select('tbl_channel.gateway_rate_basic');
        $this->db->from('tbl_channel');
        $this->db->where('id', $id);
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->row();
    }

    public function get_gateway_all_list() {
        $this->db->select('tbl_channel.*,tbl_channel.id as num');
        $this->db->select('tbl_gateway_type.*');
        $this->db->from('tbl_channel');
        $this->db->join('tbl_gateway_type', 'tbl_gateway_type.id = tbl_channel.gateway_type', 'left');
        $this->db->where('tbl_channel.parent', 1);

        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_gateway_account_info($id=null) {
        $this->db->select('*');
        $this->db->from('tbl_gateway_account');
        $this->db->where('gateway_id', $id);
        $query_result = $this->db->get();
        return $query_result->result_array();
    }

    public function get_bank_info() {
        $this->db->select('*');
        $this->db->from('tbl_card_type');
        $this->db->where('pay_type_status', 2);
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }

    public function get_bank_all_info() {
        $this->db->select('*');
        $this->db->from('tbl_card_type');
        $query_result = $this->db->get();
       // $result = $query_result->row();
        return $query_result->result_array();
    }
    /*
	 *@Pulkit08.8.16 for Direct_Deposit starts
	 */
	public function select_dd_info() {
		$this->db->select('*');
		$this->db->from('tbl_ddsettings');

		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}

    public function get_agentwithdraw_info($id, $bankstatus) {
        $this->db->select('tbl_agent_withdraw.*,tbl_agent_withdraw.id as number ', FALSE);
        $this->db->select('tbl_proxy.*', FALSE);
        $this->db->select('tbl_card_type.*', FALSE);
        $this->db->from('tbl_agent_withdraw');
        $this->db->join('tbl_proxy', 'tbl_proxy.proxy_id = tbl_agent_withdraw.agent_id', 'left');
        $this->db->join('tbl_card_type', 'tbl_card_type.bank_id = tbl_proxy.bank_name', 'left');
        $this->db->where('tbl_proxy.proxy_state', 2);
        $this->db->where('tbl_agent_withdraw.pay_state', $id);
        if ($bankstatus==2) {
        $this->db->where('pay_mode', 'ONLINE');
        }elseif ($bankstatus==3) {
        $this->db->where('pay_mode', 'ALIPAY');
        }elseif ($bankstatus==4) {
        $this->db->where('pay_mode', 'TENPAY');
        }
        $query_result = $this->db->get();
       return $query_result->result_array();
    }

    public function get_agentwithdraw_search_info($id) {

        $employee_id = $this->input->post('employee_id');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $bank_name = $this->input->post('bank_name');
        $today = date("Y-m-d H:i:s");


        $sql  = "SELECT a.*, a.id as number ,b.*,c.* from tbl_agent_withdraw a";
        $sql .= " left join tbl_proxy b on a.agent_id=b.proxy_id";
        $sql .= " left join tbl_card_type c on c.bank_id=b.bank_name";

        $sql .= " where b.proxy_state = 2";
        $sql .= " and a.pay_state = '".$id."' ";
        if ($employee_id) {
            $sql .= " and a.agent_id= '".$employee_id ."'";
        }
        if ($bank_name) {
            $sql .= " and b.bank_name like '%$bank_name%'";
        }

        if($start_date != NULL && $end_date != NULL){
            $sql .= "and pay_time between '$start_date' and '$end_date' ";
        }elseif ($start_date != NULL && $end_date == NULL){
            $sql .= "and pay_time between '$start_date' and '$today' ";
        }else if($start_date == NULL && $end_date != NULL){
             $sql .= "and pay_time between '2000-1-1 00:00:00' and '$end_date' ";
        }

        $sql .= " ORDER BY pay_time desc ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result_array();
        return $result;
    }

    public function get_agentwithdraw_ready() {

        $this->db->select('*', FALSE);

        $this->db->from('tbl_proxy');

        $this->db->join('tbl_log', 'tbl_log.employee_id = tbl_proxy.proxy_id', 'left');
        $this->db->where('tbl_proxy.proxy_state', 2);
        $this->db->group_by('tbl_proxy.proxy_id');
        $this->db->order_by('tbl_log.login_time','asc');
        $query_result = $this->db->get();
       return $query_result->result_array();
    }

    public function get_agent_pay($id) {

        $this->db->select('tbl_proxy.*, tbl_agent_group.*', FALSE);
        $this->db->from('tbl_proxy');
        $this->db->join('tbl_agent_group', 'tbl_agent_group.id = tbl_proxy.agent_group', 'left');
        $this->db->where('tbl_proxy.proxy_state', 2);
        $this->db->where('tbl_proxy.proxy_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;

    }

    public function get_employee_pay($id) {

        $this->db->select('tbl_employee.*', FALSE);
        $this->db->from('tbl_employee');
        $this->db->where('tbl_employee.usr_status', 1);
        $this->db->where('tbl_employee.employee_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;

    }

    public function get_agentwithdraw_search_ready() {

        $employee_id = $this->input->post('employee_id');
        $request_mount = $this->input->post('request_mount');
        $able_mount = $this->input->post('able_mount');

        $sql  = "SELECT * from tbl_proxy a LEFT JOIN tbl_log b ON b.employee_id = a.proxy_id LEFT JOIN tbl_agent_group c ON c.id = a.agent_group where a.proxy_state = 2";
        if ($employee_id) {
            $sql .= " and a.agent_id= '".$employee_id ."'";
        }
        if ($request_mount!=null &&  $able_mount!=null) {
            $sql .= " and a.account_amount between $request_mount and $able_mount ";
        }
        if ($request_mount!=null &&  $able_mount==null) {
            $sql .= " and a.account_amount > $request_mount ";
        }
        if ($request_mount==null &&  $able_mount!=null) {
            $sql .= " and a.account_amount < $able_mount ";
        }
        $sql .= " GROUP BY a.proxy_id";
        $query_result = $this->db->query($sql);
        $result = $query_result->result_array();
        return $result;
    }




}
