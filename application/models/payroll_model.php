<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payroll_model
 *
 * @author NaYeM
 */
class Payroll_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;
	
	/*--------------------------CPF SALARY CALCULATION-----------------------------*/
	public function getSalaryCalculationForCpf($data=array()) {
		
        $this->db->select("round(($data[salary] * employee_wage)/100,rtrim(3)) as employeeCpf,
							round(($data[salary] * employer_wage)/100,rtrim(3)) as employerCpf");
        $this->db->where('year', $data['year']);
		$this->db->where('sector', $data['sector']);
		$this->db->where( 'emp_min_age <= ', $data['empAge']);
		$this->db->where( 'emp_max_age >= ', $data['empAge']);
		$q = $this->db->get('tbl_cpf');
      //echo $this->db->last_query();
       //echo $q->num_rows();
        if($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	
	/*--------------------------NON TAXABLE CALCULATION-----------------------------*/
	function gotNonTaxableSalary($data){
		$salary=$data['salary'];
		if(isset($data['payment_frequency'])){
			$databasePaymentFrequency=$data['payment_frequency'];
		}
		else
		{
			$databasePaymentFrequency=3;
		}
		
		// for calculate non_taxable salary behaf of the allow
		$this->db->select_sum('allow_amt');		
		$this->db->from('tbl_allow_ded');
		$this->db->where('allow_amt_tax',0);
		$this->db->where('id_gsettings',$this->session->userdata('id_gsettings'));
		$query = $this->db->get();
		$result=$query->result();		
		$non_taxable_salary=$result[0]->allow_amt; 
		if($databasePaymentFrequency!=3)
		{
			
			//Two weekly
			if($databasePaymentFrequency==0)
			   {
				   $non_taxable_salary=$non_taxable_salary/2;
			   }
			   // if actual value==2
			   if($databasePaymentFrequency==2)
			   {
				   $non_taxable_salary=$non_taxable_salary/2;
			   }
			   //if actual value==1
				if($databasePaymentFrequency==1)
			   {
				   $non_taxable_salary=$non_taxable_salary/4;
			   }								   
			   
		}
		
		$salary=$salary-$non_taxable_salary;
		
		//@pank  for calculate non_taxable salary behaf of the diduction 17-8-2016
		$this->db->select_sum('did_amt');		
		$this->db->from('tbl_allow_ded');
		$this->db->where('did_amt_tax',0);
		$this->db->where('id_gsettings',$this->session->userdata('id_gsettings'));
		$query = $this->db->get();
		$result=$query->result();		
		$non_taxable_salary=$result[0]->did_amt; 
		if($databasePaymentFrequency!=3)
		{
			
				//Two weekly
				if($databasePaymentFrequency==0)
			   {
				   $non_taxable_salary=$non_taxable_salary/2;
			   }
			
			   // if actual value==2
			   if($databasePaymentFrequency==2)
			   {
				   $non_taxable_salary=$non_taxable_salary/2;
			   }
			   
			   
			   //if actual value==1
				if($databasePaymentFrequency==1)
			   {
				   $non_taxable_salary=$non_taxable_salary/4;
			   }								   
			   
		}//end
		
		$salary=$salary-$non_taxable_salary;
		
		return $salary;
	}
	
	/*--------------------------Working Day in a month-----------------------------*/
	function getWorkingDays($startDate, $endDate){
		
	 $begin=strtotime($startDate);
	 $end=strtotime($endDate);
	 if($begin>$end){
	  echo "startdate is in the future! <br />";
	  return 0;
	 }else{
	   $no_days=0;
	   $weekends=0;
	   $non_work_day=array();
	   $non_working_days=$this->get_working_days_in_week(); 
	  
		/*foreach($non_working_days as $val){
			//print_r($val->);
			$non_work_day[]=$val->day_id;
		}
		//print_r($non_work_day);*/
		$workingDayInWeek=7-count($non_working_days);
	  while($begin<=$end){
		$no_days++; // no of days in the given interval
		 $what_day=date("N",$begin);
		
		 if($what_day>$workingDayInWeek) { // 6 and 7 are weekend days
			  $weekends++;
		 };
		//	  echo "{{".$what_day."}}</br>";
		/* if (in_array($what_day, $non_work_day, true)) {
			
			$weekends++;
		}*/
		 
		$begin+=86400; // +1 day
	  };
	 // echo "no_days=".$no_days." weekends=".$weekends;die;
	  $working_days=$no_days-$weekends;
	 // $working_days=$working_days+2;
	  return $working_days;
	 }
	}
	
	/*--------------------------Working Day in a betweeen two dates-----------------------------*/
	function getWorkingDatesBetweenTwoDates($startDate, $endDate){
		
	 $begin=strtotime($startDate);
	 $end=strtotime($endDate);
	 if($begin>$end){
	  echo "startdate is in the future! <br />";
	  return 0;
	 }else{
		$no_days=0;
		$no_days_array=array();
		$weekends_array=array();
		$weekends=0;
		$non_work_day=array();
		$non_working_days=$this->get_working_days_in_week(); 
		
		$workingDayInWeek=7-count($non_working_days);
		while($begin<=$end){
			$no_days++; // no of days in the given interval
			
			
			array_push($no_days_array,date("Y-m-d",$begin));
			$what_day=date("N",$begin);

			if($what_day>$workingDayInWeek) { // 6 and 7 are weekend days
			$weekends++;
			array_push($weekends_array,date("Y-m-d",$begin));
			};
			

			$begin+=86400; // +1 day
		};
		
		
		$result=array_diff($no_days_array,$weekends_array);		
		
		return $result;
	 }
	}
	
	
	/*--------------------------Working Day in a betweeen two dates-----------------------------*/
	function getWorkingDaysBetweenTwoDates($startDate, $endDate){
		
	 $begin=strtotime($startDate);
	 $end=strtotime($endDate);
	 if($begin>$end){
	  echo "startdate is in the future! <br />";
	  return 0;
	 }else{
	   $no_days=0;
	   $weekends=0;
	   $non_work_day=array();
	   $non_working_days=$this->get_working_days_in_week(); 
	  
		/*foreach($non_working_days as $val){
			//print_r($val->);
			$non_work_day[]=$val->day_id;
		}
		//print_r($non_work_day);*/
		$workingDayInWeek=7-count($non_working_days);
	  while($begin<=$end){
		$no_days++; // no of days in the given interval
		 $what_day=date("N",$begin);
		
		 if($what_day>$workingDayInWeek) { // 6 and 7 are weekend days
			  $weekends++;
		 };
		//	  echo "{{".$what_day."}}</br>";
		/* if (in_array($what_day, $non_work_day, true)) {
			
			$weekends++;
		}*/
		 
		$begin+=86400; // +1 day
	  };
	 // echo "no_days=".$no_days." weekends=".$weekends;die;
	  $working_days=$no_days-$weekends;
	 // $working_days=$working_days+2;
	  return $working_days;
	 }
	}
	
	/*--------------------------Working Day in a month-----------------------------*/
	function getWorkingDaysInMonth($startDate, $endDate){
		
	 $begin=strtotime($startDate);
	 $end=strtotime($endDate);
	 if($begin>$end){
	  echo "startdate is in the future! <br />";
	  return 0;
	 }else{
	   $no_days=0;
	   $weekends=0;
	   $non_work_day=array();
	   $non_working_days=$this->get_working_days_in_week(); 
	  
		/*foreach($non_working_days as $val){
			//print_r($val->);
			$non_work_day[]=$val->day_id;
		}
		//print_r($non_work_day);*/
		$workingDayInWeek=7-count($non_working_days);
	  while($begin<=$end){
		$no_days++; // no of days in the given interval
		 $what_day=date("N",$begin);
		
		 if($what_day>$workingDayInWeek) { // 6 and 7 are weekend days
			  $weekends++;
		 };
		//	  echo "{{".$what_day."}}</br>";
		/* if (in_array($what_day, $non_work_day, true)) {
			
			$weekends++;
		}*/
		 
		$begin+=86400; // +1 day
	  };
	 // echo "no_days=".$no_days." weekends=".$weekends;die;
	  $working_days=$no_days-$weekends;
	 // $working_days=$working_days+2;
	  return $working_days;
	 }
	}
	
	
	
	public function get_working_days_in_week() { 
        $this->db->select('tbl_working_days.*', FALSE);
        $this->db->select('tbl_days.day', FALSE);
        $this->db->from('tbl_working_days');
        $this->db->join('tbl_days', 'tbl_working_days.day_id = tbl_days.day_id', 'left');
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		$this->db->where('tbl_working_days.flag', 0);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    /*---------Convert Digit Or Number to Word Starts --------*/
    
     
	// recursive fn, converts three digits per pass
	public function convertTri($num, $tri) {
		
		$ones = array(
		 "",
		 " one",
		 " two",
		 " three",
		 " four",
		 " five",
		 " six",
		 " seven",
		 " eight",
		 " nine",
		 " ten",
		 " eleven",
		 " twelve",
		 " thirteen",
		 " fourteen",
		 " fifteen",
		 " sixteen",
		 " seventeen",
		 " eighteen",
		 " nineteen"
		);
		 
		$tens = array(
		 "",
		 "",
		 " twenty",
		 " thirty",
		 " forty",
		 " fifty",
		 " sixty",
		 " seventy",
		 " eighty",
		 " ninety"
		);
		 
		$triplets = array(
		 "",
		 " thousand",
		 " million",
		 " billion",
		 " trillion",
		 " quadrillion",
		 " quintillion",
		 " sextillion",
		 " septillion",
		 " octillion",
		 " nonillion"
		);

		// chunk the number, ...rxyy
		$r = (int) ($num / 1000);
		$x = ($num / 100) % 10;
		$y = $num % 100;

		// init the output string
		$str = "";

		// do hundreds
		if ($x > 0)
		$str = $ones[$x] . " hundred";

		// do ones and tens
		if ($y < 20)
		$str .= $ones[$y];
		else
		$str .= $tens[(int) ($y / 10)] . $ones[$y % 10];

		// add triplet modifier only if there
		// is some output to be modified...
		if ($str != "")
		$str .= $triplets[$tri];

		// continue recursing?
		if ($r > 0)
		return $this->convertTri($r, $tri+1).$str;
		else
		return $str;
	}
 
	// returns the number as an anglicized string
	public function convertNum($num) {
		 $num = (int) $num;    // make sure it's an integer
		 
		 if ($num < 0)
		  return "negative".convertTri(-$num, 0);
		 
		 if ($num == 0)
		  return "zero";
		 
		 return $this->convertTri($num, 0);
	}
 
	// Returns an integer in -10^9 .. 10^9
	// with log distribution
	public function makeLogRand() {
		$sign = mt_rand(0,1)*2 - 1;
		$val = randThousand() * 1000000
		+ randThousand() * 1000
		+ randThousand();
		$scale = mt_rand(-9,0);

		return $sign * (int) ($val * pow(10.0, $scale));
	}
	/*---------Convert Digit Or Number to Word Ends--------*/
 

    
    
    /*-----------GET PAYMENT FREQUENCY DATES ARRAY ACCORDING TO PAYMENT FREQUENCY-------------*/
	public function get_payment_frequency_date_array($payment_frequency,$payment_date,$joining_date) { 	
		$joining_date;// 2016-01-01 
		$current_date=date("Y-m-d"); //2016-08-23
		$current_date;
		$start_payment_date = $this->input->post('start_payment_date', TRUE);
		$end_payment_date = $this->input->post('end_payment_date', TRUE);
		
		if($start_payment_date=='' && $end_payment_date=='')
		{
			$start_payment_date=$joining_date;
			$end_payment_date=$current_date;
		}	
		
		//for loop on two dates with increment of one month 2 september 2016
		$begin = new DateTime($start_payment_date );
		$end =  new DateTime($end_payment_date);
		$interval = new DateInterval('P1M');
		//$interval = DateInterval::createFromDateString('1 month');
		//$interval->format('F j, Y');
		$period = new DatePeriod($begin, $interval, $end);		
		$payment_frequency_date=array();
		
		//Weekly
		if($payment_frequency==1 ){	
			
			$z=0;		
			$payment_day = date('w', strtotime($payment_date));
			//for loop on two dates with increment of one month 2 september 2016
			foreach ( $period as $dt )
			{
				$for_loop_date= $dt->format( "l Y-m-d H:i:s\n" );
				$for_loop_month=date('m', strtotime($for_loop_date));
				$for_loop_year=date('Y', strtotime($for_loop_date));
				$end_date_of_previous_month = '';
				$date_index = (count($payment_frequency_date) ? count($payment_frequency_date)-1 : 0);
				if($date_index) {
					$end_date_of_previous_month=$payment_frequency_date[$date_index]['end_payment_date'];
				}
				$for_loop_month=($z==0)? $for_loop_month :sprintf('%02d', $for_loop_month);
				$firstDayOfMonth = $for_loop_year.'-'.$for_loop_month.'-01';   // Try also with first day of other months
				
				$value=$firstDayOfMonth;
				$weeks_in_month=$this->weeks_in_month($for_loop_year, $for_loop_month, $payment_day,$current_date,$payment_date);
				for($l=0;$l<=$weeks_in_month;$l++)
				{					
					$start = ($l==0) ? $value: date( "Y-m-d" ,strtotime('next Wednesday', strtotime( $value ) ) );
					$end = date( "Y-m-d" ,strtotime('next Tuesday', strtotime( $start ) ) );
					
					$custom_array=array();
					$custom_array['start_payment_date']=$start;
					$custom_array['end_payment_date']= $end;
					if(strtotime($end_date_of_previous_month) < strtotime($start) )
					{
						array_push( $payment_frequency_date, $custom_array );
					}
					
					$value=$start;
				}									
				
				$z++;
			}
			
		}	
		
		
		//Two weekly
		if($payment_frequency==0 ){	
			
			$z=0;	
			$payment_day = date('w', strtotime($payment_date));	
			//for loop on two dates with increment of one month 2 september 2016
			foreach ( $period as $dt )
			{
				$for_loop_date= $dt->format( "l Y-m-d H:i:s\n" );
				$for_loop_month=date('m', strtotime($for_loop_date));
				$for_loop_year=date('Y', strtotime($for_loop_date));
				//echo $for_loop_month.'-'.$for_loop_year;
				$offset=(count($payment_frequency_date)-1 < 0) ? 0 : count($payment_frequency_date)-1;
				//echo $offset . '<br/>';
				$end_date_of_previous_month=(isset($payment_frequency_date[$offset]['end_payment_date']))?$payment_frequency_date[$offset]['end_payment_date']:'';
				
				$for_loop_month=($z==0)? $for_loop_month :sprintf('%02d', $for_loop_month);
				$firstDayOfMonth = $for_loop_year.'-'.$for_loop_month.'-01';   // Try also with first day of other months
								
				$value=$firstDayOfMonth;
				//echo $payment_date.'<br/>';
				$weeks_in_month=$this->weeks_in_month($for_loop_year, $for_loop_month, $payment_day,$current_date,$payment_date);
				$custom_array=array();
				$payment_date=$payment_date;
				//print_r($weeks_in_month);
				for($l=0;$l<=$weeks_in_month;$l++)
				{	
								
					$for_loop_date=$start = ($l==0) ? $value: date( "Y-m-d" ,strtotime('next Wednesday', strtotime( $value ) ) );
					$end = date( "Y-m-d" ,strtotime('next Tuesday', strtotime( $start ) ) );
										
					
					//for loop date should smaller than current and greater than payment 
					if( strtotime(date('Y-m-'.$payment_date, strtotime($for_loop_date))) < strtotime($current_date) &&
							strtotime(date('Y-m-'.$payment_date, strtotime($for_loop_date))) < strtotime($end_payment_date)
						) 	
					{	
					
						if(($l%2==0)){
						
						$custom_array['start_payment_date']=$start;
						}
						else{
						$custom_array['end_payment_date']= $end;					
						}
						
						if($l%2==1){ 
							if(strtotime($end_date_of_previous_month) < strtotime($start)) 
							{
								array_push( $payment_frequency_date, $custom_array );
							}
						}
					}
					
					$value=$start;
					$payment_date=$payment_date+7;
				}									
				
				$z++;
			}
			//die;
			//print_r($payment_frequency_date); die;
		}
		
		//Bi-Monthly
		if($payment_frequency==2 ){		
					
			$z=0;		
			

			//for loop on two dates with increment of one month 2 september 2016
			foreach ( $period as $dt )
			{
				$for_loop_date= $dt->format( "l Y-m-d H:i:s\n" );
				$for_loop_month=date('m', strtotime($for_loop_date));
				$for_loop_year=date('Y', strtotime($for_loop_date));
						
				$query_date = $for_loop_year.'-'.sprintf('%02d', $for_loop_month).'-24';	
				
				if(date('m', strtotime($query_date))==date('m', strtotime($current_date)))
				{		
					
					//if(date('d', strtotime($payment_date[0])) < date('d', strtotime($current_date))) 
					//if($payment_date[0] < date('d', strtotime($current_date))) 
					if(strtotime(date('Y-m-'.$payment_date[0], strtotime($for_loop_date))) < strtotime($current_date)) 
					{
						$custom_array=array();
						// First day of the First Half month.
						$custom_array['start_payment_date']=date('Y-m-01', strtotime($query_date));
						
						// Last day of the First Half month.
						$custom_array['end_payment_date']=date('Y-m-15', strtotime($query_date)); 
						
						array_push( $payment_frequency_date, $custom_array );
					}		
					
					
					
					//if(date('d', strtotime($payment_date[1])) < date('d', strtotime($current_date))) 
					//if($payment_date[1] < date('d', strtotime($current_date))) 
					if(strtotime(date('Y-m-'.$payment_date[1], strtotime($for_loop_date))) < strtotime($current_date))
					{
						$custom_array1=array();
						
						// First day of the Second Half month.
						$custom_array1['start_payment_date']=date('Y-m-16', strtotime($query_date));
						
						// Last day of the Second Half month.
						$custom_array1['end_payment_date']=date('Y-m-t', strtotime($query_date)); 
						
						array_push( $payment_frequency_date, $custom_array1 );	
					}
				}	
				else{				
					
						if( strtotime(date('Y-m-'.$payment_date[0], strtotime($for_loop_date))) < strtotime($current_date) &&
							strtotime(date('Y-m-'.$payment_date[0], strtotime($for_loop_date))) < strtotime($end_payment_date)
						) 
						{
							$custom_array=array();
							// First day of the First Half month.
							$custom_array['start_payment_date']=date('Y-m-01', strtotime($query_date));
							
							// Last day of the First Half month.
							$custom_array['end_payment_date']=date('Y-m-15', strtotime($query_date)); 
							
							array_push( $payment_frequency_date, $custom_array );
						}				
					
						if( strtotime(date('Y-m-'.$payment_date[1], strtotime($for_loop_date))) < strtotime($current_date) &&
							strtotime(date('Y-m-'.$payment_date[1], strtotime($for_loop_date))) < strtotime($end_payment_date)
							)
						{
							$custom_array1=array();
							
							// First day of the Second Half month.
							$custom_array1['start_payment_date']=date('Y-m-16', strtotime($query_date));
							
							// Last day of the Second Half month.
							$custom_array1['end_payment_date']=date('Y-m-t', strtotime($query_date)); 
							
							array_push( $payment_frequency_date, $custom_array1 );
						}						
				}				
			
				$z++;
			}
			
								
		}
		//Monthly
		if($payment_frequency==3){			
						
			$z=0;			

			//for loop on two dates with increment of one month 2 september 2016
			//print_r($period);
			foreach ( $period as $dt )
			{
								
				$for_loop_date= $dt->format( "l Y-m-d H:i:s\n" );
				$for_loop_month=date('m', strtotime($for_loop_date));
				$for_loop_year=date('Y', strtotime($for_loop_date));
				
				/*$offset=(count($payment_frequency_date)-1 < 0) ? 0 : count($payment_frequency_date)-1;				
				$end_date_of_previous_month=$payment_frequency_date[$offset]['end_payment_date'];
				$start_date_of_previous_month=$payment_frequency_date[$offset]['start_payment_date'];*/
				
				$query_date = $for_loop_year.'-'.$for_loop_month.'-04';

				if(strtotime(date('Y-m-'.$payment_date, strtotime($for_loop_date))) < strtotime($current_date)) 
				{
					// First day of the month.
					$payment_frequency_date[$z]['start_payment_date']=date('Y-m-01', strtotime($query_date));
					
					// Last day of the month.
					$payment_frequency_date[$z]['end_payment_date']=date('Y-m-t', strtotime($query_date)); 	
				}						
				
				$z++;
			}							
		}		
		
		//print_r($payment_frequency_date); die;
		return $payment_frequency_date ;
	}   
	
	
	/**
	* Return the total number of weeks of a given month.
	* @param int $year
	* @param int $month
	* @param int $start_day_of_week (0=Sunday ... 6=Saturday)
	* @return int
	*/
	function weeks_in_month($year, $month, $start_day_of_week,$current_date,$payment_date)
	{
		// Total number of days in the given month.
		//echo '-' . $start_day_of_week . '<br/>';
		$num_of_days = date("t", mktime(0,0,0,$month,1,$year));

		// Count the number of times it hits $start_day_of_week.
		$num_of_weeks = 0;
		for($i=1; $i<=$num_of_days; $i++)
		{
			
			$day_of_week = date('w', mktime(0,0,0,$month,$i,$year));
			
			//starts the week 
			if($day_of_week==$start_day_of_week)
			{
				$check=0;
				$h=$i+6;
				
				$d=1;
				//echo "[[".$i."====".$h."]]";
				for($k=$i;$k<=$h;$k++){
					
					//echo "</br>(((((((((((((((((((((((".$k.")currnt date day=(".date('d', strtotime($current_date)).")";
					//echo "</br>[[".$i.",".$month.",".$year."]]";
					//if check current date exist in this week
					if($k > date('d', strtotime($current_date))) {
						$check=1;
								
						break;						
					}
					
					// current date cross the limit of end date 
					/*if($d < $payment_date) {
						
						echo "</br>(week day=".$d.")week day=(current date day =".$payment_date.")";
						$check=1;
						break;						
					}*/
					$d++;
				}
				
				
				$i=$i+6;
				//echo "</br>{day_of_week{".$day_of_week."}}{start_day_of_week{".$start_day_of_week."}}";
				
				//that mean current date day < payment date day
				//echo "</br>check=".$check."</br></br>";
				//echo "(((((((((((".$current_date."))))))))))))";
				//echo "<<<".date("m", strtotime($year."-".$month."-1")).">>><<<<".date('m', strtotime($current_date)).">>>>>";
				if(date("m", strtotime($year."-".$month."-1")) == date('m', strtotime($current_date))){
					if($check==0 ){ 
						//echo "</br>[pankaj[".$i.",".$month.",".$year."]]</br></br></br>";	
					$num_of_weeks++;
					}
				}else{
					//echo "</br>[sunny[".$i.",".$month.",".$year."]]</br></br></br>";	
					$num_of_weeks++;
				}
				
				
			}
		}

		return $num_of_weeks;
	}
	
	
	/**
	 * Return the last day of the Week/Month/Quarter/Year that the
	 * current/provided date falls within
	 *
	 * @param string   $period The period to find the last day of. ('year', 'quarter', 'month', 'week')
	 * @param DateTime $date   The date to use instead of the current date
	 *
	 * @return DateTime
	 * @throws InvalidArgumentException
	 */
	function lastDayOf($period, DateTime $date = null)
	{
		$period = strtolower($period);
		$validPeriods = array('year', 'quarter', 'month', 'week');
	 
		if ( ! in_array($period, $validPeriods))
			throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));
	 
		$newDate = ($date === null) ? new DateTime() : clone $date;
	 
		switch ($period)
		{
			case 'year':
				$newDate->modify('last day of december ' . $newDate->format('Y'));
				break;
			case 'quarter':
				$month = $newDate->format('n') ;
	 
				if ($month < 4) {
					$newDate->modify('last day of march ' . $newDate->format('Y'));
				} elseif ($month > 3 && $month < 7) {
					$newDate->modify('last day of june ' . $newDate->format('Y'));
				} elseif ($month > 6 && $month < 10) {
					$newDate->modify('last day of september ' . $newDate->format('Y'));
				} elseif ($month > 9) {
					$newDate->modify('last day of december ' . $newDate->format('Y'));
				}
				break;
			case 'month':
				$newDate->modify('last day of this month');
				break;
			case 'week':
				$newDate->modify(($newDate->format('w') === '0') ? 'now' : 'sunday this week');
				break;
		}
	 
		return $newDate;
	}
	
	
	/**
	 * Return the first day of the Week/Month/Quarter/Year that the
	 * current/provided date falls within
	 *
	 * @param string   $period The period to find the first day of. ('year', 'quarter', 'month', 'week')
	 * @param DateTime $date   The date to use instead of the current date
	 *
	 * @return DateTime
	 * @throws InvalidArgumentException
	 */
	function firstDayOf($period, DateTime $date = null)
	{
		$period = strtolower($period);
		$validPeriods = array('year', 'quarter', 'month', 'week');
	 
		if ( ! in_array($period, $validPeriods))
			throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));
	 
		$newDate = ($date === null) ? new DateTime() : clone $date;
	 
		switch ($period) {
			case 'year':
				$newDate->modify('first day of january ' . $newDate->format('Y'));
				break;
			case 'quarter':
				$month = $newDate->format('n') ;
	 
				if ($month < 4) {
					$newDate->modify('first day of january ' . $newDate->format('Y'));
				} elseif ($month > 3 && $month < 7) {
					$newDate->modify('first day of april ' . $newDate->format('Y'));
				} elseif ($month > 6 && $month < 10) {
					$newDate->modify('first day of july ' . $newDate->format('Y'));
				} elseif ($month > 9) {
					$newDate->modify('first day of october ' . $newDate->format('Y'));
				}
				break;
			case 'month':
				$newDate->modify('first day of this month');
				break;
			case 'week':
				$newDate->modify(($newDate->format('w') === '0') ? 'monday last week' : 'monday this week');
				break;
		}
	 
		return $newDate;
	}
	
	
	
	
	
    
	/*--------------------------Social Security SALARY CALCULATION-----------------------------*/
	public function getSalaryCalculationForSS($data=array()) {
		//echo $salary=$this->gotNonTaxableSalary($data);
		
		$salary=round($data['salary'], 2);
		$sql = "SELECT round(('".$salary."' * employee_wage)/100,rtrim(3) ) as employeeSS,round(('".$salary."' * employer_wage)/100,rtrim(3) )  as employerSS
				FROM tbl_cpf WHERE year='".$data['year']."' AND sector='".$data['sector']."' AND '".$data['empAge']."' BETWEEN `emp_min_age` AND `emp_max_age` AND id_gsettings = '".$this->session->userdata('id_gsettings')."' ";
				
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
	
	public function getSalaryCalculationForPayTax($data=array()) {
		
		$salary=round($data['salary'], 2);
		//$salary=$this->gotNonTaxableSalary($data);
		
		$sql = "SELECT round(('".$salary."' * employee_wage)/100,rtrim(3) ) as employeePayTax,round(('".$salary."' * employer_wage)/100,rtrim(3) )  as employerPayTax,round(('".$salary."' * classCharge)/100,rtrim(3) ) as classCharge
				FROM tbl_payroll_tax WHERE year='".$data['year']."' AND sector='".$data['sector']."' AND '".$data['empAge']."' BETWEEN `emp_min_age` AND `emp_max_age` AND id_gsettings = '".$this->session->userdata('id_gsettings')."' ";
				
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
	
	public function getSalaryCalculationForNHI($data=array()) {
		
		$salary=round($data['salary'], 2);
		//$salary=$this->gotNonTaxableSalary($data);
		
		$sql = "SELECT *,round(('".$salary."' * employee_wage)/100,rtrim(3) ) as employeeNhi,round(('".$salary."' * employer_wage)/100,rtrim(3) )  as employerNhi, round(('".$salary."' * rate)/100,rtrim(3) ) as employeeSpouseNhi
				FROM tbl_nhi WHERE year='".$data['year']."' AND sector='".$data['sector']."' AND '".$data['empAge']."' BETWEEN `emp_min_age` AND `emp_max_age` AND id_gsettings = '".$this->session->userdata('id_gsettings')."' ";		
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
	public function getCheckSpouseForNHI($emp) {
		
			$this->db->select('*');
			$this->db->from('tbl_employee');
			$this->db->where('employee_id',$emp);
			$this->db->where('is_spouse','1');
			$rs = $this->db->get();
			
			if($rs->num_rows() == 0){
				return TRUE;
			}else{
				return FALSE;
			}
        
    }
	
	public function getSalaryCalculationForSDL($data) {
		
        $this->db->select("*");
		$this->db->where( 'min_sdl_value <= ', $data);
		$this->db->where( 'max_sdl_value >= ', $data);
		$q = $this->db->get('tbl_sdl');
      //echo $this->db->last_query();die;
       //echo $q->num_rows();
        if($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	
	public function getSalaryCalculationForETHNIC($param1=null, $param2=NULL) {
		
        $this->db->select("monthly_contribution");
        $this->db->where( 'fund ', $param2);
		$this->db->where( 'min_wage <= ', $param1);
		$this->db->where( 'max_wage >= ', $param1);
		$q = $this->db->get('tbl_fund_contri');
     //echo $this->db->last_query();die;
       //echo $q->num_rows();
        if($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	
	
    public function get_add_department_by_id($department_id) {
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->from('tbl_department');
        $this->db->join('tbl_designations', 'tbl_department.department_id = tbl_designations.department_id', 'left');
        $this->db->where('tbl_department.department_id', $department_id);
		$this->db->where('tbl_designations.id_gsettings',$this->session->userdata('id_gsettings'));
		
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

    public function get_emp_salary_list($id = NULL, $designation_id = NULL) {
        $this->db->select('tbl_employee_payroll.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->from('tbl_employee_payroll');
        $this->db->join('tbl_employee', 'tbl_employee_payroll.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
		
		$this->db->where('tbl_employee.id_gsettings',$this->session->userdata('id_gsettings'));
		
		$this->db->where('tbl_employee_payroll.id_gsettings', $this->session->userdata('id_gsettings'));
        
		if (!empty($designation_id)) {
            $this->db->where('tbl_designations.designations_id', $designation_id);
        }
        if (!empty($id)) {
            $this->db->where('tbl_employee_payroll.employee_id', $id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $query_result = $this->db->get();
            $result = $query_result->result();
        }
        //echo $this->db->last_query();
       // print_r($result); die;
        return $result;
    }
	
    public function get_salary_ytd_list($data = array()) {
		//get result from start date
		$this->db->select('tbl_salary_payment.*', FALSE);
		
		//$this->db->select('sum((tbl_salary_payment.leave_deduction + tbl_salary_payment.social_security + tbl_salary_payment.nhi_deduction + tbl_salary_payment.payroll_tax_deduction + tbl_salary_payment.spouse_nhi_deduction)) as total_deduction',FALSE);
		
		//$this->db->select('sum(tbl_salary_payment.basic_salary) as basic_salary',FALSE);
		
		//$this->db->select('sum((tbl_salary_payment.house_rent_allowance + tbl_salary_payment.medical_allowance + tbl_salary_payment.special_allowance + tbl_salary_payment.fuel_allowance + tbl_salary_payment.phone_bill_allowance)) as total_allowance',FALSE);
        
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.designations_id', FALSE);
        $this->db->select('tbl_department.department_id', FALSE);
		$this->db->from('tbl_salary_payment');
        $this->db->join('tbl_employee', 'tbl_salary_payment.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
		$this->db->where('tbl_employee.id_gsettings' , $this->session->userdata('id_gsettings'));
		
		if(!empty($data['designations_id']))
		{
			$this->db->where('tbl_designations.designations_id',$data['designations_id']);
		}
		
		if(!empty($data['employee_id']))
		{
			$this->db->where('tbl_salary_payment.employee_id',$data['employee_id']);
		}
		
        if (!empty($data['date'])) {
            //$this->db->where('MONTH(tbl_salary_payment.payment_date) = "'.date('m',strtotime($data['date'])).'"',NULL, FALSE);
			$this->db->where('YEAR(tbl_salary_payment.payment_date) = "'.date('Y',strtotime($data['date'])).'"',NULL, FALSE);
        }
		//$this->db->having('MONTH(tbl_salary_payment.payment_date)','MONTH("'.$data['date'].'")');
		//$this->db->group_by('tbl_salary_payment.employee_id');
		$this->db->order_by('tbl_salary_payment.payment_date','DESC');
		$query_result = $this->db->get();
		//$query_result1 = $this->db->last_query();
		
		//echo $this->db->last_query();
		$result = $query_result->result();
        return $result;
    }

    public function get_all_attendance_old($id = NULL){
	if (!empty($id)) {
            $result = $this->db->get_where('tbl_attendance' , array('employee_id' => $id))->result();
			return $result;
        }
	}
	
	/*public function get_all_attendance($id = NULL,$start_date = NULL, $end_date = NULL){
		if (!empty($id)) {
			if($start_date != NULL && $end_date != NULL)
			{
				$this->db->where('date >= "'.$start_date.'"',NULL,false);
				$this->db->where('date <= "'.$end_date.'"',NULL,false);
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
            $this->db->where(array('employee_id' => $id));
			$result = $this->db->get('tbl_attendance')->result();
			return $result;
        }
	}*/
	public function get_all_attendance($id = NULL,$start_date = NULL, $end_date = NULL){
		$this->db->select('tbl_attendance.*', FALSE);
        $this->db->select('tbl_leave_category.leave_type', FALSE);
		//$this->db->from('tbl_attendance');
        $this->db->join('tbl_leave_category', 'tbl_attendance.leave_category_id = tbl_leave_category.leave_category_id', 'left');
		
		if (!empty($id)) {
			if($start_date != NULL && $end_date != NULL)
			{
				$this->db->where('date >= "'.$start_date.'"',NULL,false);
				$this->db->where('date <= "'.$end_date.'"',NULL,false);
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
            $this->db->where(array('employee_id' => $id));
            
			$result = $this->db->get('tbl_attendance')->result();
			//echo $this->db->last_query();
			return $result;
        }
	}
	
	//@sunny only present attendence	
	public function get_all_attendance_attendance_status_present($id = NULL,$start_date = NULL, $end_date = NULL){
		$this->db->select('tbl_attendance.*', FALSE);
        $this->db->select('tbl_leave_category.leave_type', FALSE);
		//$this->db->from('tbl_attendance');
        $this->db->join('tbl_leave_category', 'tbl_attendance.leave_category_id = tbl_leave_category.leave_category_id', 'left');
		
		if (!empty($id)) {
			if($start_date != NULL && $end_date != NULL)
			{
				$this->db->where('date >= "'.$start_date.'"',NULL,false);
				$this->db->where('date <= "'.$end_date.'"',NULL,false);
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
            $this->db->where(array('employee_id' => $id));
             $this->db->where(array('attendance_status' => 1));
            
			$result = $this->db->get('tbl_attendance')->result();
			//echo $this->db->last_query();
			return $result;
        }
	}
	//@sunny 21july2016 for fetch employee vacation leave 
	public function get_employee_vacation_leave_by_id($id = NULL,$start_date = NULL, $end_date = NULL){ 
		$this->db->select('tbl_attendance.*,tbl_leave_category.leave_type,tbl_leave_category.category');
        	
        $this->db->join('tbl_leave_category', 'tbl_attendance.leave_category_id = tbl_leave_category.leave_category_id', 'left');
		
		if (!empty($id)) {
			if($start_date != NULL && $end_date != NULL)
			{
				$this->db->where('date >= "'.$start_date.'"',NULL,false);
				$this->db->where('date <= "'.$end_date.'"',NULL,false);
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
            $this->db->where(array('employee_id' => $id));
          
            $this->db->where(array('tbl_leave_category.leave_type' => 1));
            
			$result = $this->db->get('tbl_attendance')->result();
			// echo $this->db->last_query(); die;
			return $result;
        }
       
	}
	//@sunny 21july2016 for fetch employee casual leave 
	public function get_fixed_employee_leave_by_id($id = NULL,$start_date = NULL, $end_date = NULL){
		$this->db->select('tbl_attendance.*', FALSE);
        $this->db->select('tbl_leave_category.leave_type', FALSE);
		//$this->db->from('tbl_attendance');
        $this->db->join('tbl_leave_category', 'tbl_attendance.leave_category_id = tbl_leave_category.leave_category_id', 'left');
		
		if (!empty($id)) {
			if($start_date != NULL && $end_date != NULL)
			{
				$this->db->where('date >= "'.$start_date.'"',NULL,false);
				$this->db->where('date <= "'.$end_date.'"',NULL,false);
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
            $this->db->where(array('employee_id' => $id));
            $this->db->where(array('tbl_attendance.leave_category_id' => 3));
			$result = $this->db->get('tbl_attendance')->result();
			//echo $this->db->last_query();
			return $result;
        }
	}

	public function get_hourly_employee_leave_by_id($id = NULL,$start_date = NULL, $end_date = NULL){
		$this->db->select('tbl_attendance.*', FALSE);
        $this->db->select('tbl_leave_category.leave_type', FALSE);
		//$this->db->from('tbl_attendance');
        $this->db->join('tbl_leave_category', 'tbl_attendance.leave_category_id = tbl_leave_category.leave_category_id', 'left');
		
		if (!empty($id)) {
			if($start_date != NULL && $end_date != NULL)
			{
				$this->db->where('date >= "'.$start_date.'"',NULL,false);
				$this->db->where('date <= "'.$end_date.'"',NULL,false);
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
            $this->db->where(array('employee_id' => $id));
            $this->db->where(array('tbl_attendance.leave_category_id' => 3));
			$result = $this->db->get('tbl_attendance')->result();
			//echo $this->db->last_query();
			return $result;
        }
	}
	
    public function get_attendance_by_id($id = NULL){
        $this->db->select('tbl_attendance.*', FALSE);
	$this->db->select('tbl_salary_payment.*', FALSE);
	$this->db->select('tbl_salary_payslip.*', FALSE);
	$this->db->from('tbl_salary_payslip');
	$this->db->join('tbl_salary_payment','tbl_salary_payslip.salary_payment_id = tbl_salary_payment.salary_payment_id');
	$this->db->join('tbl_attendance','tbl_salary_payment.salary_payment_id = tbl_attendance.employee_id');
	if (!empty($id)) {
            $this->db->where("tbl_attendance.employee_id", $id);
            $query_result = $this->db->get();
            $result = $query_result->result();
        }
	    return $result;
	}

    public function get_salary_payment_info_old($employee_id, $payment_date = NULL, $salary_payment_id = NULL) {

        $this->db->select('tbl_salary_payment.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->from('tbl_salary_payment');
        $this->db->join('tbl_employee', 'tbl_salary_payment.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
        if (!empty($salary_payment_id)) {
            $this->db->where("tbl_salary_payment.salary_payment_id", $salary_payment_id);
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            $this->db->where('tbl_salary_payment.employee_id', $employee_id);
            if (!empty($payment_date)) {
                $this->db->where('tbl_salary_payment.payment_for_month', $payment_date);
                $query_result = $this->db->get();
                $result = $query_result->row();
            } else {
                $this->db->order_by("tbl_salary_payment.salary_payment_id", "DESC");
                $query_result = $this->db->get();
                $result = $query_result->result();
            }
        }
        return $result;
    } 
	
	public function get_salary_payment_details($where)
	{
		
		$start_date = $where['start_payment_date'];
		$end_date = $where['start_payment_date'];
		
		//get result from start date
		$this->db->select('tbl_salary_payment.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.designations_id', FALSE);
        $this->db->select('tbl_department.department_id', FALSE);
		$this->db->from('tbl_salary_payment');
        $this->db->join('tbl_employee', 'tbl_salary_payment.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_employee_payroll', 'tbl_employee_payroll.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
		$this->db->where('tbl_employee.id_gsettings' , $this->session->userdata('id_gsettings'));
		
		if(!empty($where['designations_id']))
		{
			$this->db->where('tbl_designations.designations_id',$where['designations_id']);
		}
		
		if(!empty($where['employee_id']))
		{
			$this->db->where('tbl_salary_payment.employee_id',$where['employee_id']);
		}
		
		if(!empty($where['payment_frequency']))
		{
			$this->db->where('tbl_employee_payroll.payment_frequency',$where['payment_frequency']);
		}
		
		if(!empty($start_date))
		{
			//$this->db->where('tbl_salary_payment.payment_date >= ',$start_date);
			//$this->db->where('tbl_salary_payment.payment_date <= ',$end_date);
			
			$this->db->where('MONTH(tbl_salary_payment.start_payment_date) = "'.date('m',strtotime($start_date)).'"',NULL, FALSE);
			$this->db->where('YEAR(tbl_salary_payment.start_payment_date) = "'.date('Y',strtotime($start_date)).'"',NULL, FALSE);
			
			//$this->db->where('MONTH(tbl_salary_payment.end_payment_date) = "'.date('m',strtotime($end_date)).'"',NULL, FALSE);
			//$this->db->where('YEAR(tbl_salary_payment.end_payment_date) = "'.date('Y',strtotime($end_date)).'"',NULL, FALSE);
		}
		$this->db->order_by('tbl_salary_payment.end_payment_date','ASC');
		$this->db->get();
		//print_r($this->db->get()->result());die;
		
		//test starts ....
		
		//$result = $query->result();
		
		//return $this->db->get()->result();
		// test ends ....
		
		
		//echo $this->db->last_query();
		$query_result1 = $this->db->last_query();
        //$result1 = $query_result->result();
		
		//get result from end date
		$this->db->select('tbl_salary_payment.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.designations_id', FALSE);
        $this->db->select('tbl_department.department_id', FALSE);
		$this->db->from('tbl_salary_payment');
        $this->db->join('tbl_employee', 'tbl_salary_payment.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_employee_payroll', 'tbl_employee_payroll.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
		$this->db->where('tbl_employee.id_gsettings' , $this->session->userdata('id_gsettings'));
		
		if(!empty($where['designations_id']))
		{
			$this->db->where('tbl_designations.designations_id',$where['designations_id']);
		}
		
		if(!empty($where['employee_id']))
		{
			$this->db->where('tbl_salary_payment.employee_id',$where['employee_id']);
		}
		if(!empty($where['payment_frequency']))
		{
			//$this->db->join('tbl_employee_payroll', 'tbl_employee_payroll.employee_id = tbl_employee.employee_id', 'left');
			$this->db->where('tbl_employee_payroll.payment_frequency',$where['payment_frequency']);
		}
		
		if(!empty($end_date))
		{
			$this->db->where('MONTH(tbl_salary_payment.end_payment_date) = "'.date('m',strtotime($end_date)).'"',NULL, FALSE);
			$this->db->where('YEAR(tbl_salary_payment.end_payment_date) = "'.date('Y',strtotime($end_date)).'"',NULL, FALSE);
		}
		
		$this->db->order_by('tbl_salary_payment.end_payment_date','ASC');
		//echo $this->db->last_query();die;
		$this->db->get();
		$query_result2 = $this->db->last_query();
        //$result2 = $query_result->result();
		
		$query = $this->db->query('('.$query_result1.') UNION ('. $query_result2.')');
		//echo $this->db->last_query();
		$result = $query->result();
		// echo $this->db->last_query(); die;
        return $result;
	}
	
	public function get_salary_payment_details_on_date($where)
	{
		$start_date = $where['start_payment_date'];
		$end_date = $where['start_payment_date'];
		
		$where['designations_id'] = 1;
		$where['employee_id'] = 2;
		
		/*echo '<pre>';
		print_r($where);
		die();*/
		//get result from start date
		$this->db->select('tbl_salary_payment.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.designations_id', FALSE);
        $this->db->select('tbl_department.department_id', FALSE);
		$this->db->from('tbl_salary_payment');
        $this->db->join('tbl_employee', 'tbl_salary_payment.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_employee_payroll', 'tbl_employee_payroll.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
		$this->db->where('tbl_employee.id_gsettings' , $this->session->userdata('id_gsettings'));
		
		
		if(!empty($where['designations_id']))
		{
			$this->db->where('tbl_designations.designations_id',$where['designations_id']);
		}
		
		if(!empty($where['employee_id']))
		{
			$this->db->where('tbl_salary_payment.employee_id',$where['employee_id']);
		}
		
		if(!empty($where['payment_frequency']))
		{
			$this->db->where('tbl_employee_payroll.payment_frequency',$where['payment_frequency']);
		}
		
		if(!empty($start_date))
		{
			//$this->db->where('tbl_salary_payment.payment_date >= ',$start_date);
			//$this->db->where('tbl_salary_payment.payment_date <= ',$end_date);
			
			$this->db->where('MONTH(tbl_salary_payment.start_payment_date) = "'.date('m',strtotime($start_date)).'"',NULL, FALSE);
			$this->db->where('YEAR(tbl_salary_payment.start_payment_date) = "'.date('Y',strtotime($start_date)).'"',NULL, FALSE);
			
			//$this->db->where('MONTH(tbl_salary_payment.end_payment_date) = "'.date('m',strtotime($end_date)).'"',NULL, FALSE);
			//$this->db->where('YEAR(tbl_salary_payment.end_payment_date) = "'.date('Y',strtotime($end_date)).'"',NULL, FALSE);
		}
		$this->db->order_by('tbl_salary_payment.end_payment_date','ASC');
		$this->db->get();
		//print_r($this->db->get()->result());die;
		
		//test starts ....
		
		//$result = $query->result();
		
		//return $this->db->get()->result();
		// test ends ....
		
		
		//echo $this->db->last_query();
		$query_result1 = $this->db->last_query();
        //$result1 = $query_result->result();
		
		//get result from end date
		$this->db->select('tbl_salary_payment.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_designations.designations_id', FALSE);
        $this->db->select('tbl_department.department_id', FALSE);
		$this->db->from('tbl_salary_payment');
        $this->db->join('tbl_employee', 'tbl_salary_payment.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_employee_payroll', 'tbl_employee_payroll.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
		$this->db->where('tbl_employee.id_gsettings' , $this->session->userdata('id_gsettings'));
		
		if(!empty($where['designations_id']))
		{
			$this->db->where('tbl_designations.designations_id',$where['designations_id']);
		}
		
		if(!empty($where['employee_id']))
		{
			$this->db->where('tbl_salary_payment.employee_id',$where['employee_id']);
		}
		if(!empty($where['payment_frequency']))
		{
			//$this->db->join('tbl_employee_payroll', 'tbl_employee_payroll.employee_id = tbl_employee.employee_id', 'left');
			$this->db->where('tbl_employee_payroll.payment_frequency',$where['payment_frequency']);
		}
		
		if(!empty($end_date))
		{
			$this->db->where('MONTH(tbl_salary_payment.end_payment_date) = "'.date('m',strtotime($end_date)).'"',NULL, FALSE);
			$this->db->where('YEAR(tbl_salary_payment.end_payment_date) = "'.date('Y',strtotime($end_date)).'"',NULL, FALSE);
		}
		
		$this->db->order_by('tbl_salary_payment.end_payment_date','ASC');
		//echo $this->db->last_query();die;
		$this->db->get();
		$query_result2 = $this->db->last_query();
        //$result2 = $query_result->result();
		
		$query = $this->db->query('('.$query_result1.') UNION ('. $query_result2.')');
		//echo $this->db->last_query();
		$result = $query->result();
		// echo $this->db->last_query(); die;
        return $result;
	}
	
	public function add_account_payment($data,$metakey,$metavalue,$data2)
	{ 
		//print_r($metakey);
		//	print_r($metavalue);
		//	die;
		$field = $metakey;			
		$value = $metavalue;
		$size = sizeof($value) ;
		for($i=0; $i < $size ; $i++)
		{
			$data = array(
			   'account_id' => $field[$i],
			   'amount' => $value[$i],
			   'salary_payment_id' => $salary_payment_id 
			);
			
			$this->db->insert('tbl_account_payment', $data);
	
		}
		
			//  echo $this->db->last_query();
		//die;
	}
	 
	
	public function get_salary_payment_info($employee_id, $start_payment_date = NULL, $salary_payment_id = NULL, $end_payment_date = NULL) {

        $this->db->select('tbl_salary_payment.*', FALSE);
        $this->db->select('tbl_employee.*', FALSE);
        $this->db->select('tbl_employee_payroll.*', FALSE);
        $this->db->select('tbl_designations.*', FALSE);
        $this->db->select('tbl_department.department_name', FALSE);
        $this->db->from('tbl_salary_payment');
        $this->db->join('tbl_employee', 'tbl_salary_payment.employee_id = tbl_employee.employee_id', 'left');
		$this->db->join('tbl_employee_payroll', 'tbl_employee_payroll.employee_id = tbl_employee.employee_id', 'left');
        $this->db->join('tbl_designations', 'tbl_designations.designations_id  = tbl_employee.designations_id', 'left');
        $this->db->join('tbl_department', 'tbl_department.department_id  = tbl_designations.department_id', 'left');
        if (!empty($salary_payment_id)) {
            /*$this->db->where("tbl_salary_payment.salary_payment_id", $salary_payment_id);           
            $query_result = $this->db->get();
            $result = $query_result->row();*/
            
            //@sunny starts for multiple employee id 
					
			$salary_payment_id=explode("_",$salary_payment_id);			
			$this->db->where_in("tbl_salary_payment.salary_payment_id", $salary_payment_id);
			$query_result = $this->db->get();
            $result = $query_result->result();
			//@sunny ends 
        } else {
            $this->db->where('tbl_salary_payment.employee_id', $employee_id);
            if (!empty($start_payment_date) && empty($end_payment_date)) {
                //$this->db->where('DATE_FORMAT(tbl_salary_payment.start_payment_date,"%M-%Y") = DATE_FORMAT("'.$start_payment_date.'","%M-%Y")',NULL,FALSE);
				$this->db->where('DATE_FORMAT(tbl_salary_payment.start_payment_date,"%M-%Y") = DATE_FORMAT("'.$start_payment_date.'","%M-%Y")',NULL,FALSE);
				$this->db->where('tbl_salary_payment.start_payment_date <= ', $start_payment_date);
                $this->db->where('tbl_salary_payment.end_payment_date >= ', $start_payment_date);
                
				
				$query_result = $this->db->get();
                $result = $query_result->result();
            }
			else if (!empty($start_payment_date) && !empty($end_payment_date)) {
                $this->db->where('DATE_FORMAT(tbl_salary_payment.start_payment_date,"%M-%Y") = DATE_FORMAT("'.$start_payment_date.'","%M-%Y")',NULL,FALSE);
				$this->db->where('tbl_salary_payment.start_payment_date <= ', $start_payment_date);
                $this->db->where('tbl_salary_payment.end_payment_date >= ', $end_payment_date);
                
				//$this->db->where('tbl_salary_payment.end_payment_date', $end_payment_date);
                $query_result = $this->db->get();
                $result = $query_result->result();
            }
			else {
                $this->db->order_by("tbl_salary_payment.salary_payment_id", "DESC");
                $query_result = $this->db->get();
                $result = $query_result->result();
            }
        }
        return $result;
    }
/*----------------- DEVENDRA WORK ----------------*/
	
	public function foreignWorkerLevy()
	{
		$results = $this->db->order_by('id', 'desc')->get('foreign_levy')->result_array();
		return $results;
		
	}
	
	public function foreignWorkerLevyById($id='')
	{
		$result = $this->db->get_where('foreign_levy', array('id'=>$id))->row();
		//echo $this->db->last_query();die;
		//$this->db->get('foreign_levy')->result_array();
		return $result;
	}
/*----------------- DEVENDRA WORK ------22-SEP-2015----------*/
	
	
	
	public function allSprStaus()
	{
		$this->db->order_by('id','DESC');
		$results = $this->db->get('tbl_spr')->result_array();
		return $results;
	}
	
	public function sprStausById($id='')
	{
		$result = $this->db->get_where('tbl_spr', array('id'=>$id))->row();
		return $result;
	}
	/*-------- wages -----------------*/
	
	public function getAllWagesbySprId($id='')
	{
		
		$result = $this->db->get_where('tbl_add_wages', array('spr_id'=>$id))->result_array();
		return $result;
	}
	public function viewWagesbyId($id='')
	{
		$result = $this->db->get_where('tbl_add_wages', array('id'=>$id))->row();
		return $result;
	}
	
	public function viewAllWages()
	{
		$this->db->order_by('id','DESC');
		$this->db->select('tbl_spr.name,tbl_spr.year,tbl_spr.sector,tbl_add_wages.*');
		$this->db->from('tbl_add_wages');
        $this->db->join('tbl_spr', 'tbl_add_wages.spr_id = tbl_spr.id', 'left');
		$results =  $this->db->get()->result_array();
		return $results;
	}
	public function sprStaus()
	{
		$this->db->order_by('id','DESC');
		$results =  $this->db->get('tbl_spr')->result();
		return $results;
	}
	
	public function getSprIdByField($field1='', $field2='')
	{
		$result = $this->db->get_where('tbl_spr', array('name'=> $field1))->row();
		
		return $result;
	}
	
	public function viewAllAges()
	{
		$results = $this->db->get('tbl_add_wages')->result_array();
		return $results;
	}
	/*----------------- ANJALI WORK ---21-SEP-2015----------------*/
	public function social_security_by_id($id='')
	{
		$data = $this->db->get_where('tbl_cpf',array('id'=>$id,'id_gsettings' => $this->session->userdata('id_gsettings')))->row();
		//print_r($data); die;
		return $data;
	}
	
	public function social_security()
	{
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		$data = $this->db->order_by('id', 'desc')->get('tbl_cpf')->result_array();
		//echo $this->db->last_query();;
		return $data;
	}
	public function payroll_tax_by_id($id='')
	{
		$data = $this->db->get_where('tbl_payroll_tax',array('id'=>$id,'id_gsettings' => $this->session->userdata('id_gsettings')))->row();
		//print_r($data); die;
		return $data;
	}
	
	public function payroll_tax()
	{
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		$data = $this->db->order_by('id', 'desc')->get('tbl_payroll_tax')->result_array();
		//echo $this->db->last_query();;
		return $data;
	}
	public function allow_ded()
	{
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		$data = $this->db->order_by('id', 'desc')->get('tbl_allow_ded')->result_array();
		//echo $this->db->last_query();;
		return $data;
	}
	public function allow_ded_by_id($id='')
	{
		$data = $this->db->get_where('tbl_allow_ded',array('id'=>$id,'id_gsettings' => $this->session->userdata('id_gsettings')))->row();
		//print_r($data); die;
		return $data;
	}
	public function nhi()
	{
		$this->db->where('id_gsettings', $this->session->userdata('id_gsettings'));
		$data = $this->db->order_by('id', 'desc')->get('tbl_nhi')->result_array();
		//echo $this->db->last_query();;
		return $data;
	}
	public function nhi_by_id($id='')
	{
		$data = $this->db->get_where('tbl_nhi',array('id'=>$id,'id_gsettings' => $this->session->userdata('id_gsettings')))->row();
		//print_r($data); die;
		return $data;
	}
	
	/*----------------- ANJALI WORK -----22-SEP-2015-----------*/
	
	public function ethnic()
	{
		$data = $this->db->get('tbl_ethnic')->result_array();
		return $data;
	}
	
	public function ethnicFund($id=null)
	{
		if($id)
		{
			$data = $this->db->get_where('tbl_eth_fund',array('id' => $id))->row();
		}
		return $data;
	}
	
	public function getEthnicfund($id = '')
	 {
	  //$this->db->order_by('id','desc');
	  if($id)
	  {
	   $this->db->select("tbl_fund_contri.*, tbl_ethnic.name as name");
	   $this->db->join('tbl_ethnic', 'tbl_fund_contri.fund = tbl_ethnic.id');
	   $q = $this->db->get_where('tbl_fund_contri', array('fund' => $id));
	  }
	  else
	  {
	   $this->db->select("tbl_fund_contri.*, tbl_ethnic.name as name");
	   $this->db->join('tbl_ethnic', 'tbl_fund_contri.fund = tbl_ethnic.id');
	   $q = $this->db->get('tbl_fund_contri'); 
	  }
	  
	  //$d= $q->result();
			//echo $this->db->last_query();die;
	   if($q->num_rows() > 0) {
				foreach (($q->result()) as $row) {
					$data[] = $row;
				}
			}
			return $data;
	 }
 
 public function ethnic_by_id($id='')
 {
  $data = $this->db->get_where('tbl_ethnic',array('id'=>$id))->row();
  return $data;
 }
 
 public function fund()
 {
  $data = $this->db->get('tbl_eth_fund')->result_array();
  return $data;
 }
 public function contri()
 {
  $data = $this->db->get('tbl_fund_contri')->result_array();
  return $data;
 }
 /*-----------25SEP WORK-----------*/
 public function ethnic_by_name($name='')
 {
  $data = $this->db->get_where('tbl_ethnic',array('name'=>$name))->row();
  return $data;
 }
 public function fund_by_id($id='')
 {
  $data = $this->db->get_where('tbl_fund_contri',array('fund'=>$id))->result();
  //print_r($data);die;
  return $data;
 }
	/*-------------------SDL-------*/
	public function getSDLById($id='')
	{
		$data = $this->db->get_where('tbl_sdl',array('id'=>$id))->row();
		return $data;
	}
	
	/*-------------------Get Reference No-------*/
	public function get_ref_no($ref_no)
	{
		$data = $this->db->get_where('tbl_account_payment',array('reference_number'=>$ref_no))->result();
		
		if(empty($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*-------------------Get Accounts (15-7-2016)-------*/
	public function get_accounts()
	{
		 $this->db->select('tbl_accounts.*,tbl_accounts_type.account_group_type', FALSE);
        $this->db->from('tbl_accounts');
        $this->db->join('tbl_accounts_type', 'tbl_accounts.account_group = tbl_accounts_type.id', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	
	/*-------------------Get Accounts (15-7-2016)-------*/
	public function get_banks()
	{
		 $this->db->select('tbl_accounts.*', FALSE);
        $this->db->from('tbl_accounts');
        $this->db->join('tbl_accounts_type', 'tbl_accounts.account_group = tbl_accounts_type.id', 'left');
        $this->db->where('tbl_accounts.account_group', '9');
		$query = $this->db->get();
		return $query->result();
		
	}
	
	public function get_total_hours($emp_id, $satrt_date, $end_date)
	{
		$sql = "SELECT *, SEC_TO_TIME(sum(TIME_TO_SEC(STR_TO_DATE(`time_out`, '%h:%i %p'))-TIME_TO_SEC(STR_TO_DATE(`time_in`, '%h:%i %p')))) as availTime from tbl_attendance where `attendance_status`=1 and `employee_id`=$emp_id and `date` between '".$satrt_date."' and '".$end_date."' ";
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
	
	/* FOR DISPLAY THE PAYMENT FREQUENCY */
	
	public function get_list_payment_frequency()
	{
		 
		$this->db->select('tbl_payment_date_settings.*', FALSE);
        $this->db->from('tbl_payment_date_settings');
		$query = $this->db->get();
		return $query->result();
	}
	
	
}
