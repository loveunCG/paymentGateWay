<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paygateway extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('agent_model');
    }

public function index(){		
		$partner = $this->input->get('partner');
		$banktype = $this->input->get('banktype');
		$paymoney = $this->input->get('paymoney');
		$ordernumber = $this->input->get('ordernumber');
		$callbackurl = $this->input->get('callbackurl');
		$sign = $this->input->get('sign');
		$attach = $this->input->get('attach');
		$hrefbackurl = $this->input->get('hrefbackurl');
        $agent_info = $this->agent_model->agent_key_info($partner);
    	$preEncodeStr="partner=".$partner."&banktype=".$banktype."&paymoney=".$paymoney."&ordernumber=".$ordernumber."&callbackurl=".$callbackurl.$agent_info->agent_key;
		$encodeStr=md5($preEncodeStr);
		if ($sign == $encodeStr) {
            $this->agent_model->_table_name = 'agent_order';
            $this->agent_model->_order_by = "id";
            $info =  $this->agent_model->get_by(array('ordernumber' => $ordernumber), true);
			if (count($info)) {				
				redirect('intro/failed');				
			}
			// echo $partner;
			$data['partner'] = $partner;
			$data['banktype'] = $banktype;
			$data['paymoney'] = $paymoney;
			$data['ordernumber'] = $ordernumber;
			$data['sysnumber'] = date("YmdHis")."".rand(1000000,9999999);
			$data['attach'] = $attach;
			$data['user_number'] = $agent_info->employee_id;
			$data['agent_group'] = $agent_info->proxy_id;
			$data['orderstatus'] = 0;
			$data['callbackurl'] = $callbackurl;
			$data['hrefbackurl'] = $hrefbackurl;
			$data['create_time'] = date("Y-m-d H:i:s");
		    $this->agent_model->_table_name = 'agent_order';
		    $this->agent_model->_primary_key = 'id';
		    $this->agent_model->save($data, $id);				
			$data['orderstatus'] = 1;
            $this->agent_model->_table_name = 'agent_order';
            $this->agent_model->_order_by = "id";
            $info =  $this->agent_model->get_by(array('sysnumber' => $data['sysnumber']), true);
            $userid = 27641;
            $userkey = 1234567890;
            $gateway = "http://api.52hpay.com:8888/paygateway.aspx";
            $ourcall = "http://103.239.28.239/Inbao/paygateway/check_state";
            $ourhref = "http://http://103.239.28.239/Inbao/paygateway/check_call_state";
			$chsign = md5("partner=".$userid."&banktype=".$banktype."&paymoney=".$paymoney."&ordernumber=".$ordernumber."&callbackurl=".$ourcall.$userkey);
			// $this->load->view('paygateway/paystatus', $data);
			$url = $gateway."?partner=".$userid."&banktype=".$banktype."&paymoney=".$paymoney."&ordernumber=".$ordernumber."&callbackurl=".$ourcall;
			$url .= "&hrefbackurl=".$ourhref."&attach=".$attach."&sign=".$chsign;
			ob_clean();
			header('Location: ' . $url);
			exit;			
		}else{
			ob_clean();
			header('Location: ' . $hrefbackurl);
			exit;
		}
	}
	public function check_state(){
		$partner = $this->input->get('partner');
		$banktype = $this->input->get('banktype');
		$orderstatus = $this->input->get('orderstatus');
		$paymoney = $this->input->get('paymoney');
		$ordernumber = $this->input->get('ordernumber');
		$sysnumber = $this->input->get('sysnumber');		
		$sign = $this->input->get('sign');
		$attach = $this->input->get('attach');
        $userid = 27641;
        $userkey = 1234567890;
        $this->agent_model->_table_name = 'agent_order';
        $this->agent_model->_order_by = "id";
        $info =  $this->agent_model->get_by(array('ordernumber' => $ordernumber), true);
    	$preEncodeStr="partner=".$partner."&ordernumber=".$ordernumber."&orderstatus=".$orderstatus."&paymoney=".$paymoney.$userkey;
		$encodeStr=md5($preEncodeStr);
		if ($sign==$encodeStr) {
			echo "ok";
		}else{
			ob_clean();
			header('Location: ' . $info->hrefbackurl);
			exit;
		}
		
	}
	public function check_call_state(){
			$partner = $this->input->get('partner');
			$banktype = $this->input->get('banktype');
			$orderstatus = $this->input->get('orderstatus');
			$paymoney = $this->input->get('paymoney');
			$ordernumber = $this->input->get('ordernumber');
			$sysnumber = $this->input->get('sysnumber');		
			$sign = $this->input->get('sign');
			$attach = $this->input->get('attach');
	        $userid = 27641;
	        $userkey = 1234567890;			
            $this->agent_model->_table_name = 'agent_order';
            $this->agent_model->_order_by = "id";
            $info =  $this->agent_model->get_by(array('ordernumber' => $ordernumber), true);
            $agent_info = $this->agent_model->agent_key_info($info->agent_group);
			$chksign = md5("partner=".$info->partner."&ordernumber=".$info->sysnumber."&orderstatus=1&paymoney=".$info->paymoney.$agent_info->agent_key);
			// $this->load->view('paygateway/paystatus', $data);
			$callurl = "partner=".$info->partner."&ordernumber=".$info->sysnumber."&orderstatus=1&paymoney=".$info->paymoney."&attach=".$attach."&sign=".$chksign; 			
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $info->callbackurl); 
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 			
			curl_setopt ($ch, CURLOPT_SSLVERSION,3); 
			curl_setopt ($ch, CURLOPT_HEADER, 0); 
			curl_setopt ($ch, CURLOPT_POST, 1); 
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $callurl); 
			curl_setopt ($ch, CURLOPT_TIMEOUT, 30); 
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
			$result = curl_exec ($ch);
			curl_close ($ch);
			if ($result=="ok") {
				$this->callback($info->id, $hrefbackurl);
			}else{
				$this->failed($info->id, $hrefbackurl);
			}
	}
	public function callback($sysnum=null, $hrefbackurl){	
				
			$data['orderstatus'] = 1;
			$data['create_time'] = date("Y-m-d H:i:s");
		    $this->agent_model->_table_name = 'agent_order';
		    $this->agent_model->_primary_key = 'id';
		    $this->agent_model->save($data, $sysnum);
			ob_clean();
			header('Location: ' . $hrefbackurl);
			exit;
	}

	public function failed($sysnum=null, $hrefbackurl){							
		        $this->agent_model->_table_name = "agent_order"; // table name
		        $this->agent_model->_primary_key = "id"; // $id
		        $this->agent_model->delete($sysnum);			 	
			ob_clean();
			header('Location: ' . $hrefbackurl);
			exit;
	}	
}
