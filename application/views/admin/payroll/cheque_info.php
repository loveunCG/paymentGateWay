
<script type="text/javascript">
	function printDiv(printableArea) {
		var printContents = document.getElementById(printableArea).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

<style type="text/css">

    .bd{
        width: 100%;                
    }
    .banner{
        border-bottom: 2px solid black;
    }
    .banner td{
        border: 0px;
    }
    .banner td p{
        font-size: 16px;
        font-weight: bold;
        margin-left: 10px;
    }

    table{
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        border-collapse: collapse;
    } 


    th{
        padding: 8px 0 8px 5px;                
        text-align: left;
        font-size: 13px;

        background-color: #F2F2F2;
    }
    td{
        padding: 10px 0 8px 8px;
        text-align: left;
        font-size: 13px;
        color: black;

    }
    .head{
        background-color: #F2F2F2;
        font-size: 14px;
        padding: 15px 5px 8px 15px;
        border-radius: 5px;                
    }
    .head tr td{
        text-align: left;
        font-size: 15px;
        border: 0px;
        padding-left: 20px;
    }
    .tbl1{
       
        width: 49%;
        float: left;
    }
    .tbl2{
       
        width: 49%;
        float: right;
    }
    .tbl_total{
        width: 49%;
        float: right;          
    }    
    .tbl_total tr td{        
        border: 0px;        
    }
    .tbl_total td{
        padding-left: 25px;
    }
    .bg td{
        background-color: #F2F2F2;
        
    }
    #payment_receipt{height:586px;padding-top:13px;}



    .bd{
        width: 100%;                
    }
    .banner{
        border-bottom: 2px solid black;
    }
    .banner td{
        border: 0px;
    }
    .banner td p{
        font-size: 16px;
        font-weight: bold;
        margin-left: 10px;
    }

    table{
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        border-collapse: collapse;
    }            

    th{
        padding: 0px 5px 0px 4px;                 
        text-align: left;
        font-size: 13px;
        border: 1px solid black;
        background-color: #F2F2F2;
    }
    td{
        padding: 0px 0 0px 8px;
        text-align: left;
        font-size: 13px;
        color: black;
        border: 1px solid black;
    }
    .head{
        background-color: #F2F2F2;
        font-size: 14px;
        padding: 15px 5px 8px 15px;
        border-radius: 5px;                
    }
    .head tr td{
        text-align: left;
        font-size: 15px;
        border: 0px;
        padding-left: 20px;
    }
    .tbl1{
        /*                font-size: 18px;
                        border: 0px;
                        background-color: #fff;*/
        width: 49%;
        float: left;
    }
    .tbl2{
        /*                font-size: 18px;
                        border: 0px;
                        background-color: #fff;*/
        width: 49%;
        float: right;
    }
.tbl3{
/*                font-size: 18px;
                border: 0px;
                background-color: #fff;*/
width: 49%;
float: left;
}
    .tbl_total{
        width: 47%;
        float: right;          
    }    
    .tbl_total tr td{        
        border: 0px;        
    }
    .tbl_total td{
        padding-left: 25px;
    }
    .bg td{
        background-color: #F2F2F2;        
    }
footer{clear:both;}
@media print {
    .payment_receipt{ page-break-after: always;width:80%;}

}

.check_table td{border:none !important}
</style>
<div class="bd">
    <div style="text-align: right;"  >
        <button  type="button" onclick="printDiv('payment_receipt')" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Print&nbsp;Cheque" >Print Cheque</button>
    </div>

   
</div> 

<div id="payment_receipt">
	<?php 
	$employee_salary_info=$salary_cheque_details;
	//print_r($employee_salary_info); die;
	 foreach($employee_salary_info as $employee_salary_info) {
		   $salary_cheque_details=$employee_salary_info;
				 $where = array('salary_payment_id' => $employee_salary_info->salary_payment_id);
				$check_existing_recipt_no = $this->payroll_model->check_by($where, 'tbl_salary_payslip');
				//echo $this->db->last_query();die;
				$payslip_number ='';
				if (!empty($check_existing_recipt_no)) {
					$payslip_number = $check_existing_recipt_no->payslip_number;
				}
		   
				//@sunny vacation leave calculation starts 
				$start_payment_date=$employee_salary_info->start_payment_date;
				$end_payment_date=$employee_salary_info->end_payment_date;
				$emp_id=$employee_salary_info->employee_id;
				$employee_vacation_leave = $this->payroll_model->get_employee_vacation_leave_by_id($emp_id, $start_payment_date, $end_payment_date);
				//@sunny vacation leave calculation ends 
			 //<?php $payslip_number=$employee_salary_info->payslip_number;
                               
			?>
      <div class="payment_receipt">
        		
			<!--  cheque view start here -->
	
		<div class="tbl3" style="margin-top:31px">
			<table class="bg_img check_table" >
				<tbody>
					<tr style="height:70px;" ></tr>
					<tr style="height:40px;">
					<?php
					$genaral_info = $this->session->userdata('genaral_info');
					if (!empty($genaral_info)) {
						foreach ($genaral_info as $info) {
							//print_r($genaral_info);
							if ($info->id_gsettings == $this->session->userdata('id_gsettings')) {
								?>
													<td style="width:20%">

													</td>
													<td style="border: 0px;">
														<p style="margin-left: 10px; font: 30px lighter;"><?php //echo $info->name ?></p>
													</td>
								<?php
							}
						}
					} else {
						?>

							<?php
						}
						?>
						<td style="width:40%"></td><td style="font-size: 20px; padding: 34px 0px 10px 1%;"> <?php echo date('d-M,Y', strtotime($salary_cheque_details->payment_date)); ?></td>

					</tr>
					<tr style="height:60px;">
						<td></td>
						<td style="font-size: 22px;"> <?php echo "$salary_cheque_details->first_name " . "$salary_cheque_details->last_name"; ?></td>
						<td style="font-size: 22px;">  </td>
						<td style="font-size: 22px; margin-left:5px ;marg">  
							<?php
							
							 
                        //@sunny For Global Allownces 
						$total_allow = 0;
						if (!empty($employee_salary_info->global_allowance))
						{			
							$global_allow = explode('<-->',$employee_salary_info->global_allowance);
							foreach($global_allow as $allow)
							{
								if(!empty($allow))
								{
									$alw = explode("=",$allow);
									$total_allow += $alw[1];
						 
								}
							}
						} 
						
						 //@sunny For Extra Allownces
						if (!empty($employee_salary_info->extra_allowance))
						{			
							$extra_allow = explode('<-->',$employee_salary_info->extra_allowance);
							foreach($extra_allow as $allow)
							{
								if(!empty($allow))
								{
									$alw = explode("=",$allow);
									$total_allow += $alw[1];
						 
								}
							}
						} 
						 
								$total_deduct = 0;
								if (!empty($employee_salary_info->global_deduction))
								{			
									$global_deduct = explode('<-->',$employee_salary_info->global_deduction);
									foreach($global_deduct as $deduct)
									{
										if(!empty($deduct))
										{
											$alw = explode("=",$deduct);
											$total_deduct += $alw[1];
								 
										}
									}
								}
								if (!empty($employee_salary_info->extra_deduction))
								{			
									$extra_deduct = explode('<-->',$employee_salary_info->extra_deduction);
									foreach($extra_deduct as $deduct)
									{
										if(!empty($deduct))
										{
											$alw = explode("=",$deduct);
											$total_deduct += $alw[1];
								 
										}
									}
								}						
								
						$gross = $employee_salary_info->basic_salary + $total_allow;
						$deduction = $employee_salary_info->social_security + $total_deduct + $employee_salary_info->payroll_tax_deduction + $employee_salary_info->nhi_deduction + $employee_salary_info->spouse_nhi_deduction + $employee_salary_info->leave_deduction;
						$net_salary = $gross - $deduction;
					
						if (!empty($genaral_info[0]->currency)) {
							$currency = $genaral_info[0]->currency;
						} else {
							$currency = '$';
						}
						if (!empty($salary_payment_info->fine_deduction)) {
							$paid_amount = $net_salary - $salary_payment_info->fine_deduction;
						} else {
							$paid_amount = $net_salary;
						}
						
						 if (!empty($employee_salary_info)): 
							$no_of_work_day=$employee_salary_info->no_of_work_day;
							$total_work_day=$employee_salary_info->total_work_day;						
							$basic_salary=$paid_amount+$employee_salary_info->leave_deduction;
														                    
												
							$total_working_salary=(isset($employee_salary_info->total_working_salary)) ? $employee_salary_info->total_working_salary : 0;
							$total_overtime_salary=(isset($employee_salary_info->total_overtime_salary)) ? $employee_salary_info->total_overtime_salary : 0;
							$allowance=$total_allow;
							
														
							$working_salary=0;
							if(!empty($no_of_work_day) && !empty($total_work_day)){
							 $working_salary=($employee_salary_info->salary_type == 1) ? 
							 $employee_salary_info->total_working_salary + $employee_salary_info->total_overtime_salary + ($allowance * $no_of_work_day / $total_work_day ) - ($deduction * $no_of_work_day / $total_work_day )  
							 : 
							 $basic_salary * ($no_of_work_day / $total_work_day)
							 ;
								
							}
																
													
						endif;?>
						<?php echo $working_salary=round(number_format($working_salary, 2)); ?> </td>
					</tr>
					<tr style="height: 47px;">

						<td></td>

						<td style="font-weight: bold;font-size:20px;">				
											
						<?php // example of usage
						echo $this->payroll_model->convertNum($working_salary)."<br>";
						?>
						</td>						
						
					</tr>   
					<tr></tr> 
					<?php 
					//Monthly
					if($salary_cheque_details->payment_frequency==3){
						$salary_cheque_details_payment_date=date('F Y', strtotime($salary_cheque_details->payment_date)) ;
					}
					
					//Bi-Monthly
					if($salary_cheque_details->payment_frequency==2)
					{
						$salary_cheque_details_payment_date="";
						$query_date=$salary_cheque_details->payment_date;							
												
						if(
							date('d', strtotime($query_date)) >= date('d', strtotime(date('Y-m-01', strtotime($query_date))) ) &&
							date('d', strtotime($query_date)) <= date('d', strtotime(date('Y-m-15', strtotime($query_date))) )
						)
						{
							$salary_cheque_details_payment_date=date(''.$bi_monthly_payment_date1.' F Y', strtotime($query_date)) ;
						}
						
						if(
							date('d', strtotime($query_date)) >= date('d', strtotime(date('Y-m-16', strtotime($query_date))) ) &&
							date('d', strtotime($query_date)) <= date('d', strtotime(date('Y-m-t', strtotime($query_date))) )
						){ 
							$salary_cheque_details_payment_date=date(''.$bi_monthly_payment_date2.' F Y', strtotime($query_date)) ;
						}
					}
					
					//Two Weekly
					if($salary_cheque_details->payment_frequency==0)
					{
						$salary_cheque_details_payment_date="";
						$query_date=$salary_cheque_details->payment_date;							
												
						if(
							date('d', strtotime($query_date)) >= date('d', strtotime(date('Y-m-01', strtotime($query_date))) ) &&
							date('d', strtotime($query_date)) <= date('d', strtotime(date('Y-m-15', strtotime($query_date))) )
						)
						{
							$salary_cheque_details_payment_date=date(''.$bi_monthly_payment_date1.' F Y', strtotime($query_date)) ;
						}
						
						if(
							date('d', strtotime($query_date)) >= date('d', strtotime(date('Y-m-16', strtotime($query_date))) ) &&
							date('d', strtotime($query_date)) <= date('d', strtotime(date('Y-m-t', strtotime($query_date))) )
						){ 
							$salary_cheque_details_payment_date=date(''.$bi_monthly_payment_date2.' F Y', strtotime($query_date)) ;
						}
					}
					
					//Weekly
					if($salary_cheque_details->payment_frequency==1){
						$salary_cheque_details_payment_date=date('F Y', strtotime($salary_cheque_details->payment_date)) ;
					}
					?>
					<tr style="height: 0px;">
						
						<td colspan="3" style="color: rgb(128, 128, 128);    font-family: Times New Roman;    font-size: 22px;    font-weight: bold;    padding-left: 94px;"><span><?php echo "Vi-HRMS CK# ".$salary_cheque_details_payment_date; ?></span></td>
											
					</tr>
					<tr style="height: 40px;">
						<td style=""></td>
						<td style=""></td>
						<td style="color: rgb(128, 128, 128);    font-family: Times New Roman;    font-size: 22px;    font-weight: bold;    padding-left: 94px;"><?php echo "Vi-HRMS CK# ".$salary_cheque_details->Cheque_payment_no; ?></td>
					</tr>
					<tr style="height: 15px;"></tr>
				</tbody>
				</table><br>
		</div>

	</div>
	<!--  cheque view end here -->
	<div style="width: 100%; border-bottom: 2px solid black;">
		
            <table style="width: 100%; vertical-align: middle;">
                <tr>
                    <?php
					
                    $genaral_info = $this->session->userdata('genaral_info');
                    if (!empty($genaral_info)) {
                        foreach ($genaral_info as $info) {
							//print_r($genaral_info);
							if($info->id_gsettings == $this->session->userdata('id_gsettings'))
							{
                            ?>
                            <td style="width: 35px; border: 0px;">
                                <img style="width: 50px;height: 50px" src="<?php echo base_url() . $info->logo ?>" alt="" class="img-circle"/>
                            </td>
                            <td style="border: 0px;">
                                <p style="margin-left: 10px; font: 14px lighter;"><?php echo $info->name ?></p>
                            </td>
                            <?php
							}
                        }
                    } else {
                        ?>
                        <td style="width: 35px; border: 0px;">
                            <img style="width: 50px;height: 50px" src="<?php echo base_url() ?>img/logo.png" alt="Logo" class="img-circle"/>
                        </td>
                        <td style="border: 0px;">
                            <p style="margin-left: 10px; font: 14px lighter;">Human Resource Management System</p>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
            </table>
        </div>
       
        <div style="width: 100%;">            
            <div align="center">
                <table class="head">
                    <tr>
					<!-- changed by deepa -->
                        <td colspan="5" style="text-align:center; font-size: 16px; padding-bottom:1px;"><strong>Payslip <br/>Salary Month: <?php echo date('F , Y', strtotime($employee_salary_info->payment_for_month)) ?></strong> </td>
                    </tr>
                    <tr>
                        <td><strong>Employee ID:</strong> <?php echo $employee_salary_info->employment_id; ?></td>
                        <td><strong>Name:</strong> <?php echo $employee_salary_info->first_name . ' ' . $employee_salary_info->last_name; ?></td>
                  
                                               
                        
                        <td><strong>Payslip No:</strong> <?php echo $payslip_number; ?></td>
                    </tr>
                    <tr>
					
                        <td><strong>Mobile:</strong> <?php echo $employee_salary_info->mobile; ?></td>
                        <?php if (!empty($employee_salary_info->bank_name)): ?>
                            <td><strong>Bank:</strong> <?php echo $employee_salary_info->bank_name; ?></td>
                        <?php else: ?>
                            <td><strong>Email:</strong> <?php echo $employee_salary_info->email; ?></td>
                        <?php endif; ?>
                        <?php if (!empty($employee_salary_info->account_number)): ?>
                            <td><strong>A/C No :</strong> <?php echo $employee_salary_info->account_number; ?></td>
                        <?php else: ?>
                            <td><strong>Address:</strong> <?php echo $employee_salary_info->present_address; ?></td>
                        <?php endif; ?>                    
                    </tr>
                    <tr>
                        <td><strong>Department:</strong> <?php echo $employee_salary_info->department_name; ?></td>
                        <td><strong>Designation:</strong> <?php echo $employee_salary_info->designations; ?></td>
                        
						<td><strong>Joining Date:</strong> <?php echo date('d-M,Y', strtotime($employee_salary_info->joining_date)); ?></td>
						</tr>
						<tr>			
						<td><strong> start payment Date:</strong> <?php echo date('d-M,Y', strtotime($employee_salary_info->start_payment_date)); ?></td>
						<td><strong>end payment Date:</strong> <?php echo date('d-M,Y', strtotime($employee_salary_info->end_payment_date)); ?></td>
						</tr>
						<?php
						
						$datetime1 = date_create($employee_salary_info->end_payment_date);
                        $datetime2 = date_create($employee_salary_info->joining_date);
						$interval = date_diff($datetime1, $datetime2);
						//$worked_total_month= $interval->format('%m');
						
						//@deepa 16-8-2016 for claculate total month Start here
						$y=$interval->y;
						$m=$interval->m;
						$W_T_M=''; // create variable for find total working month of emmployee 
						
						if($y!=0){
							$W_T_M=$y*12+$m;
						}
						elseif($y==0){
							$W_T_M=$y+$m;
						}
                        $worked_total_month= $W_T_M;
												
					    /**********@deepa 16-8-2016 for claculate total month END ************/
						?>

						
                    </tr>
                </table>
            </div>
            <div align="center">
                <div class="tbl1" style="margin-top:31px">
                    <table style="width: 99%;">
                        <tr>
                            <td colspan="2" style="border: 0px; font-size: 18px;padding-left:0px;"><strong>Earning</strong></td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Type of Pay</th>
                        <th style="text-align: center">Ammount</th>
                         <th style="text-align: center">YTD</th>
							
                        </tr>
						<?php
						 $salary_type = $employee_salary_info->salary_type;
						if($salary_type == 2) // For Fixed Salary Type
						{
						?>
						<tr>
                            <td style="text-align: right"><strong> Basic :&nbsp;&nbsp; </strong></td>
                            <td> &nbsp; <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                echo $currency . ' ' . number_format($employee_salary_info->basic_salary, 2);
                                ?>
							</td>
							<!-- @deepa 9aug-->
							<td style="text-align: center"><?php   echo $currency . ' ' .number_format($worked_total_month *($employee_salary_info->basic_salary),2); ?></td>                     						
													 
						 </tr>
						<?php
							
						}
						else // For Hourly Salary Type
						{
						?>
						<tr>
                            <td style="text-align: right"><strong> Basic :&nbsp;&nbsp; </strong></td>
                            <td> &nbsp; <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                echo $currency . ' ' . number_format($employee_salary_info->basic_salary, 2);
                                ?>
							</td>
							<!-- @deepa 9aug-->
							<td style="text-align: center"><?php   echo $currency . ' ' .number_format($worked_total_month *($employee_salary_info->basic_salary),2); ?></td>                     						
													 
						 </tr>
						<tr>
                            <td style="text-align: right"><strong> Working Salary :&nbsp;&nbsp; </strong></td>
                            <td> &nbsp; <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
								$working = $employee_salary_info->total_working_hour;
								$holiday = $employee_salary_info->total_holiday_hour;
								$total_working_salart = $working + $holiday;
                                echo $currency . ' ' . number_format($total_working_salart, 2);
                                ?>
							</td>
								<!-- @deepa  9 aug-->
								<td style="text-align: center"><?php echo $currency . ' ' . number_format($worked_total_month* ($total_working_salart), 2);?></td>
														 
                        </tr>
						<tr>
                            <td style="text-align: right"><strong> OverTime Salary :&nbsp;&nbsp; </strong></td>
                            <td> &nbsp; <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                echo $currency . ' ' . number_format($employee_salary_info->total_overtime_hour, 2);
                                ?>
							</td>
								 <!-- @deepa  9aug-->
							 <td style="text-align: center"><?php echo $currency . ' ' . number_format($worked_total_month*($employee_salary_info->total_overtime_hour), 2);?></td>
										
						</tr>
						
						<?php
						}
						?>
						
                       <!--<tr>
                            <td style="text-align: right"><strong> Basic :&nbsp;&nbsp; </strong></td>
                            <td> &nbsp; <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                echo $currency . ' ' . number_format($employee_salary_info->basic_salary, 2);
                                ?>
							</td>
                        </tr>
						-->
						 
						
                        <?php 
                        //@sunny For Global Allownces 
						$total_allow = 0;
						if (!empty($employee_salary_info->global_allowance))
						{			
							$global_allow = explode('<-->',$employee_salary_info->global_allowance);
							foreach($global_allow as $allow)
							{
								if(!empty($allow))
								{
									$alw = explode("=",$allow);
									$total_allow += $alw[1];
						?>
                            <tr>
                                <td style="text-align: right"><strong><?php echo ucfirst($alw[0])?>  :&nbsp;&nbsp;</strong></td>

                                <td >&nbsp; <?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($alw[1], 2);
                                    ?></td>
									<!-- @deepa  9aug-->
									<td style="text-align: center"><?php $allownces_amount=$alw[1]; echo $currency . ' ' .number_format(($worked_total_month *  $allownces_amount),2);?></td>
                            </tr>  
						<?php 
								}
							}
						} 
						
						 //@sunny For Extra Allownces
						if (!empty($employee_salary_info->extra_allowance))
						{			
							$extra_allow = explode('<-->',$employee_salary_info->extra_allowance);
							foreach($extra_allow as $allow)
							{
								if(!empty($allow))
								{
									$alw = explode("=",$allow);
									$total_allow += $alw[1];
						?>
                            <tr>
                                <td style="text-align: right"><strong><?php echo ucfirst($alw[0])?>  :&nbsp;&nbsp;</strong></td>

                                <td >&nbsp; <?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($alw[1], 2);
                                    ?></td>
									<!-- deepa-->
									<td style="text-align: center"><?php echo $currency . ' ' .number_format($worked_total_month*($alw[1]), 2); ?></td>
                            </tr>  
						<?php 
								}
							}
						} 
						?>
                    </table>
                </div>
                <!-- Deduction Leave Starts Here -->
                <div class="tbl2" style="margin-top:31px">
                    <table >
                        <tr>
                           <td colspan="2" style="border: 0px; font-size: 18px;padding-left:0px;"><strong>Deduction</strong></td>
					</tr>
					<tr>
						<th style="text-align: center">Type of Pay</th>
						<th style="text-align: center">Ammount</th>
						<th style="text-align: center">YTD</th>
					</tr>
								<?php if (!empty($employee_salary_info->social_security)): ?>
									<tr>
										<td style="text-align: right"><strong>Social Security  :&nbsp;&nbsp;</strong></td>

										<td>&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($employee_salary_info->social_security, 2);
											?></td>
											<!-- @deepa  6 aug-->
									 <td style="text-align: center"><?php echo $currency . ' ' .number_format($worked_total_month*($employee_salary_info->social_security), 2);?></td>
			
									</tr>  
								<?php endif; ?>
								
								<?php if (!empty($employee_salary_info->nhi_deduction)): ?>
									<tr>
										<td style="text-align: right"><strong>National Health Insurance  :&nbsp;&nbsp;</strong></td>

										<td>&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($employee_salary_info->nhi_deduction, 2);
											?></td>
											<!-- @deepa  6 aug-->
										<td style="text-align: center"><?php echo $currency . ' ' .number_format($worked_total_month*($employee_salary_info->nhi_deduction), 2);?></td>
			
									</tr>  
								<?php endif; ?>
								
								<?php if (!empty($employee_salary_info->spouse_nhi_deduction)): ?>
									<tr>
										<td style="text-align: right"><strong>Spouse National Health Insurance  :&nbsp;&nbsp;</strong></td>

										<td>&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($employee_salary_info->spouse_nhi_deduction, 2);
											?></td>
											<!-- @deepa  6 aug-->
										<td style="text-align: center"><?php echo $currency . ' ' .number_format($worked_total_month*($employee_salary_info->spouse_nhi_deduction), 2);?></strong></td>
			
									</tr>  
								<?php endif; ?>
								
								<?php if (!empty($employee_salary_info->payroll_tax_deduction)): ?>
									<tr>
										<td style="text-align: right"><strong>Payroll Tax  :&nbsp;&nbsp;</strong></td>

										<td>&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($employee_salary_info->payroll_tax_deduction, 2);
											?></td>
											<!-- @deepa  6 aug-->
									<td style="text-align: center"><?php echo $currency . ' ' .number_format($worked_total_month*($employee_salary_info->payroll_tax_deduction), 2); ?></strong></td>
			
									</tr>  
								<?php endif; ?>
							  <?php if (!empty($employee_salary_info->leave_deduction)): ?>
									<tr>
										<td style="text-align: right"><strong>Leave Deduction  :&nbsp;&nbsp;</strong></td>

										<td>&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($employee_salary_info->leave_deduction, 2);
											?></td>
											 <!-- @deepa  6 aug-->
									<td style="text-align: center"><?php echo $currency . ' ' .number_format($worked_total_month*($employee_salary_info->leave_deduction), 2);?></td>
			
									</tr>   
								<?php endif; ?>
								<?php 
								$total_deduct = 0;
								if (!empty($employee_salary_info->global_deduction))
								{			
									$global_deduct = explode('<-->',$employee_salary_info->global_deduction);
									foreach($global_deduct as $deduct)
									{
										if(!empty($deduct))
										{
											$alw = explode("=",$deduct);
											$total_deduct += $alw[1];
								?>
									<tr>
										<td style="text-align: right"><strong><?php echo ucfirst($alw[0])?>  :&nbsp;&nbsp;</strong></td>

										<td >&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($alw[1], 2);
											?></td>
											<!--@deepa-->
									<td style="text-align: center"><?php echo $currency . ' ' .number_format(($worked_total_month*$alw[1]), 2);?></td>
									</tr>  
								<?php 
										}
									}
								}
								if (!empty($employee_salary_info->extra_deduction))
								{			
									$extra_deduct = explode('<-->',$employee_salary_info->extra_deduction);
									foreach($extra_deduct as $deduct)
									{
										if(!empty($deduct))
										{
											$alw = explode("=",$deduct);
											$total_deduct += $alw[1];
								?>
									<tr>
										<td style="text-align: right"><strong><?php echo ucfirst($alw[0])?>  :&nbsp;&nbsp;</strong></td>

										<td >&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($alw[1], 2);
											?></td>
										<td style="text-align: center"><?php echo $currency . ' ' .number_format(($worked_total_month*$alw[1]), 2); ?></td>

									</tr>  
								<?php 
										}
									}
								}						
								?>
							</table>
							
							
							<!-- deduction ends here -->
					<table>
                        <tr>
                        <td colspan="2" style="border: 0px; font-size: 18px;padding-left:0px;"><strong>Vacation leave</strong></td>
						</tr>
						<tr>
						<th style="text-align: center">Leave Date</th>
						<th style="text-align: center">Reason</th>
									</tr>
									<?php 
									if (!empty($employee_vacation_leave))
									{			
										
										foreach($employee_vacation_leave as $vacation_leave)
										{ ?>
											<tr>
												<td><?php echo $vacation_leave->date; ?></td>
												<td><?php echo $vacation_leave->category; ?></td>
											</tr>
									<?php }
									}
									 ?>
                    </table>
      
			 </div>
			<div class="tbl3" style="margin-top:31px">
				<table class="tbl_total" style="float:left;border-bottom: 1px solid;" >
					<tr>
					<td colspan="2" style="border: 0px; font-size: 18px;padding-left:0px;"><strong>Total Details</strong></td>
					</tr>                
					<?php if (!empty($employee_salary_info)): ?>
					<tr>
					<td style="text-align: right;"><strong> Gross Salary   :&nbsp;&nbsp;</strong></td>
					<td>&nbsp; <?php
					if (!empty($genaral_info[0]->currency)) {
						$currency = $genaral_info[0]->currency;
					} else {
						$currency = '$';
					}
					$gross = $employee_salary_info->basic_salary + $total_allow;
					echo $currency . ' ' . number_format($gross, 2);
					?></td>
					</tr>  
					<?php endif; ?>
					<?php if (!empty($employee_salary_info)): ?>
					<tr>
					<td style="text-align: right"><strong>Total Deduction  :&nbsp;&nbsp;</strong></td>

					<td> &nbsp; <?php
					if (!empty($genaral_info[0]->currency)) {
						$currency = $genaral_info[0]->currency;
					} else {
						$currency = '$';
					}
					$deduction = $employee_salary_info->social_security + $total_deduct + $employee_salary_info->payroll_tax_deduction + $employee_salary_info->nhi_deduction + $employee_salary_info->spouse_nhi_deduction + $employee_salary_info->leave_deduction;
					echo $currency . ' ' . number_format($deduction, 2);
					?></td>
					</tr>  
					<?php endif; ?>
					<?php if (!empty($employee_salary_info)): ?>
					<tr>
					<td style="text-align: right"><strong>Net Salary  :&nbsp;&nbsp;</strong></td>

					<td >&nbsp; <?php
						if (!empty($genaral_info[0]->currency)) {
							$currency = $genaral_info[0]->currency;
						} else {
							$currency = '$';
						}
					$net_salary = $gross - $deduction;
					echo $currency . ' ' . number_format($net_salary, 2);
					?></td>
					</tr>   
					<?php endif; ?>   
					<?php if (!empty($employee_salary_info->fine_deduction)): ?>
					<tr>
					<td style="text-align: right"><strong>Fine Deduction  :&nbsp;&nbsp;</strong></td>

					<td>&nbsp; <?php
						if (!empty($genaral_info[0]->currency)) {
							$currency = $genaral_info[0]->currency;
						} else {
							$currency = '$';
						}
					$net_salary = $gross - $deduction;
					echo $currency . ' ' . number_format($employee_salary_info->fine_deduction, 2);
					?></td>
					</tr>   
					<?php endif; ?>                                   
					<tr>
					<td style="text-align: right;font-weight: bold"><strong>Paid Amount :&nbsp;&nbsp;</strong></td>

					<td style="font-weight: bold;">&nbsp; <?php
						if (!empty($genaral_info[0]->currency)) {
							$currency = $genaral_info[0]->currency;
						} else {
							$currency = '$';
						}
						if (!empty($salary_payment_info->fine_deduction)) {
							$paid_amount = $net_salary - $salary_payment_info->fine_deduction;
						} else {
							$paid_amount = $net_salary;
						}
						echo $currency . ' ' . number_format($paid_amount, 2);
						?>
											</td>
					</tr>   
				</table>  
				
				
				
			<!-- ************** Total Working Salary Details Start  **************-->
		   
				<table class="tbl_total"  style="float:left;border-bottom: 1px solid;">
					<tr>
					<td colspan="2" style="border: 0px; font-size: 18px;padding-left:0px;"><strong>Total Working Salary Details</strong></td>
					</tr>                
					<?php if (!empty($employee_salary_info)): ?>
					<tr>
					<td style="text-align: right;"><strong> Gross Salary   :&nbsp;&nbsp;</strong></td>
					<td>&nbsp; <?php 
													$no_of_work_day=$employee_salary_info->no_of_work_day;
													$total_work_day=$employee_salary_info->total_work_day;						
													$basic_salary=$paid_amount+$employee_salary_info->leave_deduction;
													?>
                                <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                
                                echo $currency . ' ' . number_format($basic_salary, 3);
                                ?></td>
					</tr>  
					<?php endif; ?>
					<?php if (!empty($employee_salary_info)): ?>
					<tr>
						
						
					<td style="text-align: right"><strong>No Of Work Day :&nbsp;&nbsp;</strong></td>

					<td> &nbsp; <?php echo $no_of_work_day;?></td>
					</tr>  
					<?php endif; ?>
				
					
					
					
					<?php if (!empty($employee_salary_info)): ?>
					<tr>
					<td style="text-align: right"><strong>Total Work Day   :&nbsp;&nbsp;</strong></td>

					<td >&nbsp; <?php echo $total_work_day;?></td>
					</tr>   
					<?php endif; ?> 
					
					  
					                                   
					<tr>
					<td style="text-align: right;font-weight: bold"><strong>Paid Working Amount :&nbsp;&nbsp;</strong></td>

					<td style="font-weight: bold;">&nbsp; 
						<?php
							
												
							$total_working_salary=(isset($employee_salary_info->total_working_salary)) ? $employee_salary_info->total_working_salary : 0;
							$total_overtime_salary=(isset($employee_salary_info->total_overtime_salary)) ? $employee_salary_info->total_overtime_salary : 0;
							$allowance=$total_allow;
							
							echo ($employee_salary_info->salary_type == 1) ? "[".$employee_salary_info->total_working_salary." + ".$employee_salary_info->total_overtime_salary ." + (".$allowance." * ".$no_of_work_day." / ".$total_work_day." ) - (".$deduction." * ".$no_of_work_day." / ".$total_work_day." )] =" : $basic_salary." * ".$no_of_work_day." / ".$total_work_day." =";
							
							$working_salary=0;
							if(!empty($no_of_work_day) && !empty($total_work_day)){
							 $working_salary=($employee_salary_info->salary_type == 1) ? $employee_salary_info->total_working_salary + $employee_salary_info->total_overtime_salary + ($allowance * $no_of_work_day / $total_work_day ) - ($deduction * $no_of_work_day / $total_work_day )  : $basic_salary * ($no_of_work_day / $total_work_day);
							}
							
							$formula=($employee_salary_info->salary_type == 1) ? '( total_working_salary + total_overtime_salary ) + (Allowance * No of work_day / Total work day ) - (Deduction * No of work_day / Total work day ) ' : '( Basic salary * No of work_day ) / (Total work day)';
																				  
							echo '<a href="#"  data-toggle="tooltip" title="'.$formula.'"  class="more" >' . $currency . ' ' . number_format($working_salary, 2) . '</a>';
													
													
						?> 											
						
					</td>
					</tr>   
				</table>  
					
				
				<!-- ************** Total Working Salary Details Ends  **************-->
				
		

    
		</div>    
	</div> 
</div>

        
<?php } // foreah ends  ?>
        
    </div>








