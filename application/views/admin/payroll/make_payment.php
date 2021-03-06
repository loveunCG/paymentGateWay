<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
 <style>
            .tooltip{background:#ffffff !important;color:#000;filter:alpha(opacity=80);}
            .tooltip-arrow,
            .red-tooltip + .tooltip > .tooltip-inner {background-color: #fff;}
        </style>  
        <link href="<?php echo base_url() ?>assets/css/jquery-ui.css"/>
<div class="row">    
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default">
<!-- *********     Employee Search Panel ***************** -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[19] ?></strong>
                    </div>
                </div>      
                <form id="make_payment_form" role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/payroll/make_payment" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 form-groups-bordered">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][2] ?><span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text"  value="<?php
                                        if (!empty($start_payment_date)) {
                                            echo $start_payment_date;
                                        }
                                        ?>" class="form-control" id="sdate" name="start_payment_date"  >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][3] ?> <span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text"  value="<?php
                                        if (!empty($end_payment_date)) {
                                            echo $end_payment_date;
                                        }
                                        ?>" class="form-control" id="edate" name="end_payment_date" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>							
                                <div class="form-group" id="border-none">
									<!--change by @p.p Department-->
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo "Select Department";//echo $this->language->from_body()[20][0] ?> <span class="required">*</span> </label>
                                    <div class="col-sm-5">
                                        <select name="designations_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">                            
                                           <!--change by @p.p Department-->
                                            <option value="">Select Department.....</option>
                                            <?php if (!empty($all_department_info)): 
													foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                                    <?php if (!empty($v_department_info)): ?>
                                                        <optgroup label="<?php echo $dept_name; ?>">
                                                            <?php 
																foreach ($v_department_info as $designation) : ?>
                                                                <option value="<?php echo $designation->designations_id; ?>" 
                                                                <?php
                                                                if (!empty($designations_id)) {
                                                                    echo $designation->designations_id == $designations_id ? 'selected' : '';
                                                                }
                                                                ?>
																>
																	<?php echo $designation->designations ?>
																</option>                            
																<?php endforeach; ?>
                                                        </optgroup>
                                                    <?php endif; ?>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label">
										<?php echo $this->language->from_body()[14][1] ?> 
									</label>
                                    <div class="col-sm-5"> 
                                        <select name="employee_id" id="employee" class="form-control" >
										
                                            <option value="">Select Employee...</option>  
                                            <?php 
												
												if (!empty($employee_info_emp)): ?>
                                                <?php foreach ($employee_info_emp as $v_employee) : ?>
													<?php
													if (!empty($designations_id)) 
													{
														?> 
                                                    <option value="<?php echo $v_employee->employee_id; ?>" 
                                                    <?php
                                                    if (!empty($employee_id)) {
                                                        echo $v_employee->employee_id == $employee_id ? 'selected' : '';
                                                    }
                                                    ?>><?php echo $v_employee->first_name . ' ' . $v_employee->last_name ?></option>      
													<?php } ?>                   
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
								<?php //echo "<pre>".print_r($this->language->from_body(),1)."</pre>";?>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[20][2] ?> </label>
                                    <div class="col-sm-5">
									<?php //echo '<pre>'; print_r($getAllPaymentTypeInfo);?>
                                        <select name="payment_frequency" id="payment_frequency" onchange="select_payment_date(this.value)" class="form-control" >
                                            <option value="">Payment Frequency...</option>
                                            <?php if($getAllPaymentTypeInfo[0]->next_payment_date != '0000-00-00'){?><option value="0" <?php if ((isset($payment_frequency) && $payment_frequency !='' && $payment_frequency == 0) ) {echo   'selected'; } ?>>Fortnightly</option><?php } ?>
                                            <option <?php echo (!empty($payment_frequency) && $payment_frequency == 1) ? 'selected' : ''; ?> value="1">Weekly</option>
											<?php if($getAllPaymentTypeInfo[0]->bi_monthly_payment_date1 != ''){?><option  <?php echo (!empty($payment_frequency) && $payment_frequency == 2) ? 'selected' : '';?> value="2">Bi-monthly</option><?php } ?>
                                            <option  <?php echo (!empty($payment_frequency) && $payment_frequency == 3) ? 'selected' : '';?> value="3">Monthly</option>
											<option  <?php echo (!empty($payment_frequency) && $payment_frequency == 4) ? 'selected' : '';?> value="4">Daily</option>
                                        </select>
                                    </div>
                                </div>
                               
								<!--@sunny 21 August 2016 Payment Date  starts here ....-->
								<div class="form-group <?php echo (!empty($payment_frequency) && $payment_frequency == 3) ? '' : 'hide';?>" id="div_monthly_payment_date" >
                                    <label class="col-sm-3 control-label">Set payment date for monthly<span class="required">*</span></label>
                                    <div class="input-group col-sm-6">
                                        <input type="text" readonly="readonly" value="<?php
                                        if (!empty($monthly_payment_date)) {
                                            echo $monthly_payment_date;
                                        }
                                        ?>" class="form-control" id="monthly_payment_date" name="monthly_payment_date"  >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
								</div> 
								<div class="form-group <?php echo (!empty($payment_frequency) && $payment_frequency == 2) ? '' : 'hide';?>" id="div_bi_monthly_payment_date">
                                    <label class="col-sm-3 control-label">Set payment date for bi-monthly <span class="required">*</span></label>
                                    <div class="input-group col-sm-6">
                                        <input type="text" readonly="readonly" value="<?php
                                        if (!empty($bi_monthly_payment_date1)) {
                                            echo $bi_monthly_payment_date1;
                                        }
                                        ?>" class="form-control" id="bi_monthly_payment_date1" name="bi_monthly_payment_date1" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
										
										<input type="text" style="margin-left:10px" readonly="readonly"  value="<?php
                                        if (!empty($bi_monthly_payment_date2)) {
                                            echo $bi_monthly_payment_date2;
                                        }
                                        ?>" class="form-control" id="bi_monthly_payment_date2" name="bi_monthly_payment_date2" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
								</div>		
							
								<div class="form-group <?php echo (isset($payment_frequency) && $payment_frequency!='' && $payment_frequency == 0) ? '' : 'hide';?>" id="div_two_weekly_payment_date">
                                    <label class="col-sm-3 control-label">Set payment date for two weekly<span class="required">*</span></label>
                                    <div class="input-group col-sm-6">
										<?php 
											$this->load->model("settings_model");
											$week_working_days_result=$this->settings_model->get_working_week_days(); ?>
										<input type="text" readonly="readonly" value="<?php
                                        if (!empty($two_weekly_payment_date)) {    
                               
											if (!empty($week_working_days_result)): 
												foreach ($week_working_days_result as $key => $value) : 
													if (!empty($value)): 
														if (!empty($two_weekly_payment_date)) {
															echo $value->working_days_id == $two_weekly_payment_date ? $value->day : '';
														}													                           
															
													endif;                             
												endforeach; 
											endif; 	
                                            
                                        }
                                        ?>" class="form-control" id="two_weekly_payment_date" name="two_weekly_payment_date" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>								
										
										<?php /*<input type="text" readonly="readonly"  value="<?php
										
										
											
                                        if (!empty($two_weekly_payment_date1)) {
                                            echo $two_weekly_payment_date1;
                                        }
                                        ?>" class="form-control" id="two_weekly_payment_date1" name="two_weekly_payment_date1" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
										
										<input type="text" style="margin-left:10px" readonly="readonly" value="<?php
                                        if (!empty($two_weekly_payment_date2)) {
                                            echo $two_weekly_payment_date2;
                                        }
                                        ?>" class="form-control" id="two_weekly_payment_date2" name="two_weekly_payment_date2" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>*/?>
										
							
                                    </div>
                                </div>
                                <div class="form-group <?php echo (!empty($payment_frequency) && $payment_frequency == 1) ? '' : 'hide';?>" id="div_weekly_payment_date">
                                    <label class="col-sm-3 control-label">Set payment date for weekly <span class="required">*</span></label>
                                    <div class="input-group col-sm-6">
                                        <input type="text" readonly="readonly" value="<?php
                                        if (!empty($weekly_payment_date)) {    
                               
											if (!empty($week_working_days_result)): 
												foreach ($week_working_days_result as $key => $value) : 
													if (!empty($value)): 
														if (!empty($weekly_payment_date)) {
															echo $value->working_days_id == $weekly_payment_date ? $value->day : '';
														}													                           
															
													endif;                             
												endforeach; 
											endif; 	
                                            
                                        }
                                        ?>" class="form-control" id="weekly_payment_date" name="weekly_payment_date" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div> 
								<!--@sunny 21 August 2016 Payment Date  ends here ....-->
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5">
                                        <button id="submit" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">GO</button>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
		<!-- ******************** Employee Search Panel Ends ******************** -->
        <?php
		//echo "<pre>";print_r($check_salary_payment);die;
										
		if (!empty($flag)) : ?>
            <!--************ Payment History Start ***********-->
            <!---************** Employee Info show When Print ***********************--->
            <div id="payment_history">
                <div class="show_print" style="width: 100%; border-bottom: 2px solid black;">
                    <table style="width: 100%; vertical-align: middle;">
                        <tr>
                            <?php
                            $genaral_info = $this->session->userdata('genaral_info');
                            if (!empty($genaral_info)) {
                                foreach ($genaral_info as $info) {
                                    ?>
                                    <td style="width: 35px; border: 0px;">
                                        <img style="width: 50px;height: 50px" src="<?php echo base_url() . $info->logo ?>" alt="" class="img-circle"/>
                                    </td>
                                    <td style="border: 0px;">
                                        <p style="margin-left: 10px; font: 14px lighter;"><?php echo $info->name ?></p>
                                    </td>
                                    <?php
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
                <div class="show_print" style="padding: 5px 0; width: 100%;margin-top: 20px;margin-bottom: 20px;">
                    <div>
                        <table style="width: 100%; border-radius: 3px;">
                            <tr>
                                <td style="width: 150px;">
                                    <table style="border: 1px solid grey;">
                                        <tr>
                                            <td style="background-color: lightgray; border-radius: 2px;">
                                                <?php if ($emp_salary_info->photo): ?>
                                                    <img src="<?php echo base_url() . $emp_salary_info->photo; ?>" style="width: 132px; height: 138px; border-radius: 3px;" >  
                                                <?php else: ?>
                                                    <img alt="Employee_Image">     
                                                <?php endif; ?> 
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 300px; margin-left: 10px; margin-bottom: 10px; font-size: 13px;">
                                        <tr>
                                            <td colspan="2"><h2><?php echo "$emp_salary_info->first_name " . "$emp_salary_info->last_name"; ?></h2></td>
                                        </tr>                                
                                        <tr>
                                            <td style="width: 100px"><strong>Employee ID : </strong></td>
                                            <td>&nbsp; <?php echo "$emp_salary_info->employment_id"; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px"><strong>Department : </strong></td>
                                            <td>&nbsp; <?php echo "$emp_salary_info->department_name"; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px"><strong>Designation :</strong> </td>
                                            <td>&nbsp; <?php echo "$emp_salary_info->designations"; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100px"><strong>Joining Date: </strong></td>
                                            <td>&nbsp; <?php echo date('d M Y', strtotime($emp_salary_info->joining_date)); ?></td>
                                        </tr>                                                                          
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>                      
                <!--  **************** show when print End ********************* -->

                <div class="col-sm-12 print_width">
                    <div class="row">       
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">                                        
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Payment History</strong>                                                
                                        <div class="pull-right"><!-- set pdf,Excel start action -->
                                            <label class="hidden-print control-label pull-left hidden-xs">
											</label>
											<label class="payment_print hidden-print control-label col-sm-3 pull-left hidden-xs">
                                                <?php echo btn_make_pdf("admin/payroll/payment_history_pdf/$start_payment_date/$end_payment_date"); // .$emp_salary_info->employee_id); ?>                                                    
                                            </label>
                                            <label class="hidden-print control-label pull-left hidden-xs">
                                                <button  class="btn-print" data-toggle="tooltip" data-placement="top" title="Print" type="button" onclick="payment_history('payment_history')"><?php echo btn_print(); ?></button>
                                            </label>                                                                                                       
                                        </div><!-- set pdf,Excel start action -->                                                
                                    </div>
                                </div>
								<form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>admin/payroll/get_payment/" id="payment_form" role="form">
                                <!--@sunny  Table starts-->
								<style>
									.select-checkbox {
									color: #fff !important;
								}
									</style>
									
									<?php //print_r($check_salary_payment);die; ?>
												<table class="table table-bordered table-hover" id="example">
								<!--@sunny  Table ends-->
                                    <thead>
                                        <tr> 
											<th><input name="select_all" type="checkbox"/></th>
										                                                   
                                            <th>Employee Name</th> 
                                            <th>Payment Date</th>
											<th>Hourly or Salary</th>
											<th>Total Hours Worked</th>
											<th>Base-Pay </th>
											<th>Overtime-Pay </th>
                                            <!--<th>Gross Salary </th>-->
                                            <th>Total Allowance </th>
											<th>Gross-Pay (Less Non-taxable deductions)</th>
                                            <th>Total Deduction =</br>Leave+Other</th>                         
                                            <!--<th>Net Salary</th> -->
                                            <th>Net Salary<!--=</br>( Basic salary * No of work_day ) / (Total work day)--></th>      
                                            <th>Payment Status</th>
                                            <th class="hidden-print">Payment Method</th>
											<th>Bank Accounts</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                                                        
                                        <?php
                                        $z=0; 
                                        if (!empty($check_salary_payment)): 
											foreach ($check_salary_payment as $payment_history){
												
												$M=0;
												$dateSlap = 0;
												foreach($payment_history AS $v_payment_history){
												
												$z++;
												$M++;
												
												
                                               
												
												$this->payroll_model->_table_name = 'tbl_employee_payroll';
												$this->payroll_model->_order_by = 'employee_id';
												$employee_payroll_result = $this->payroll_model->get_by(array('employee_id' => $v_payment_history->employee_id));
												//print_r($employee_payroll_result[0]->payment_frequency);die("shreeRam");	
												//print_r($leave_deduction_result[0]->leave_deduction);die;	
												$databasePaymentFrequency =(isset($employee_payroll_result[0]->payment_frequency)) ?$employee_payroll_result[0]->payment_frequency : 3; 
												
												
												
												
												if(!empty($v_payment_history->next_paydate) && !empty($v_payment_history->end_paydate))
												{
													$first_date = $v_payment_history->next_paydate;  
													$last_date =  $v_payment_history->end_paydate; 
												}
												else
												{
													$first_date = 0;
													$last_date = 0;
												}
												if($first_date  >  $last_date)
												{
													//echo "1";
												}
												else
												{  
												?> 
												
												<tr>
												 
												<?php 
												if(!empty($v_payment_history->total_working_salary))
												{
													$working_salary = $v_payment_history->total_working_salary;
													 //echo $working_salary."==";
												}
												else
												{
													$working_salary = "0";
												}
												if(!empty($v_payment_history->total_overtime_salary))
												{
													$overtime_salary = $v_payment_history->total_overtime_salary;
													  //echo $overtime_salary."==";
												}
												else
												{
													$overtime_salary = "0";
												}
												if(!empty($v_payment_history->total_holiday_salary))
												{
													$holiday_salary = $v_payment_history->total_holiday_salary;
													// echo $holiday_salary."==";
												}
												else
												{
													$holiday_salary = "0";
												}
													 
												?>
												<td style="color:#ff000"><?php echo isset($z)?$z:''; ?></td>
												<input type="hidden" name="total_working_hour[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $working_salary; ?>">
 
												<input type="hidden" name="total_overtime_hour[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $overtime_salary ;?>">	
												
												<input type="hidden" name="total_holiday_hour[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $holiday_salary ;?>">	
 												
                                                    <td><?php echo $v_payment_history->first_name.' '.$v_payment_history->last_name?></td>
                                                    
                                                    <td><?php 
													echo (!empty($v_payment_history->payment_date) ? $v_payment_history->payment_date /*date('d-M-y', strtotime($v_payment_history->payment_date))*/ : '-'); 
													?></td>
													<td><?php 
													if($v_payment_history->salary_type == 1)
													{
														echo "Hourly";

													}
													else
													{
														echo "Salary";
													}
													
													?></td>
													<td>
													<?php if(!empty($display_total_time[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
														$totalTimeMinutes = $display_total_time[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
														$hours = floor($totalTimeMinutes / 60);
														$minutes = $totalTimeMinutes % 60; 
														printf ("%d:%02d", $hours, $minutes);
													} else echo '00.00'?></td>
                                                    <td><?php 
													if(!empty($v_payment_history->basic_salary))
													{
														echo number_format($v_payment_history->basic_salary, 2, '.', ',');

													}
													else
													{
														echo "0";
													}
													
													?></td>
														<?php
													if (!empty($genaral_info[0]->currency)) {
															$currency = $genaral_info[0]->currency;
														} else {
															$currency = '$';
														}
													?>
													
													<td><?php if(!empty($display_overtime_salary[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])) echo $currency. ' ' .$display_overtime_salary[$v_payment_history->employee_id][$display_payment_key[$dateSlap]]; else echo 0;?></td>
                                                    <!--<td>-->
													<?php 
														$gross = 0;
														$global_allowance = 0;
														$extra_allowance = 0;
														$basic = 0;
														
														if(empty($v_payment_history->set_salary_details))
														{
															
															$basic = $v_payment_history->basic_salary;
															
															 
															if(is_array($v_payment_history->extra_allowance))
															{
																$new_extra_globle_allownces_array=array();
																foreach($v_payment_history->extra_allowance as $ex_alw)
																{
																	if($ex_alw != "")
																	{
																		$dd = explode("=",$ex_alw);
																		
																		//@sunny allownces acording to paymeny frequecy starts 
																		      

																		$new_allownces_value=$dd[1];

																		
																		//@sunny allownces acording to paymeny frequecy ends
																		
																		$extra_allowance += $new_allownces_value;
																		$new_extra_globle_allownces_array[]=$dd[0]."=".$new_allownces_value;
																	}
																}
															}
															//print_r($v_payment_history->global_allowance);
															if(isset($v_payment_history->global_allowance))
															{
																if(is_array($v_payment_history->global_allowance))
																{
																	$new_globle_allownces_array=array();$new_globle_allownces_array_for_save=array();
																	foreach($v_payment_history->global_allowance as $gb_alw)
																	{
																		if($gb_alw != "")
																		{
																			$dd = explode("=",$gb_alw);
																			
																			//@sunny allownces acording to paymeny frequecy starts 
																				  
										   
																			$new_allownces_value=$dd[1];
																			if(isset($dd[2]))
																			{
																				if($databasePaymentFrequency!=3 && $dd[2]=='fix' && empty($v_payment_history->salary_payment_id))
																				{
																					
																					   // if actual value==2
																					   if($databasePaymentFrequency==2)
																					   {
																						   $new_allownces_value=$new_allownces_value/2;
																					   }
																					    // if actual value==0 (Two Weekly)
																					   if($databasePaymentFrequency==0)
																					   {
																						   $new_allownces_value=$new_allownces_value/2;
																					   }
																					   //if actual value==1
																						if($databasePaymentFrequency==1)
																					   {
																						   $new_allownces_value=$new_allownces_value/4;
																					   }								   
																					   
																				}
																			}
																			//@sunny allownces acording to paymeny frequecy ends
																			
																			//*******If NON TAXABLE THAN CONCINATE (allow_amt_tax 1=Tax, 0=Non-Tax)********
																			//if(isset($dd[3]))
																			{
																				//if($dd[3]==0)
																				{
																				$global_allowance += $new_allownces_value;
																				$new_globle_allownces_array[]=$dd[0]."=".$new_allownces_value;
																				$new_globle_allownces_array_for_save[]=$dd[0]."=".$new_allownces_value."=".$dd[2]."=".$dd[3];
																				}
																			}
																			
																		}
																	}
																}
															}
														}
														//print_r($new_globle_allownces_array_for_save);
														$employee_total_allownces=$extra_allowance+$global_allowance;
														
														$gross = $basic + $global_allowance + $extra_allowance;
														//echo "=========";
														if (!empty($genaral_info[0]->currency)) {
															$currency = $genaral_info[0]->currency;
														} else {
															$currency = '$';
														}
														//echo $currency . ' ' . number_format($gross, 2);
													?>
													<!--</td>-->
													
													
													
													
												
													
													<!-- TOTAL ALLOWNCESS-->
													<td>
												
														 <input type="hidden" name="extra_allowance_pay[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $extra_allowance ?>" />
														 <input type="hidden" name="global_allowance_pay[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $global_allowance ?>" />
														<?php
														$totalGlobalAllowanceAmount = 0;
														$globalAllowanceAmountFix = array();
														$globalAllowanceStringFix = '';
														$globalAllowanceAmountPer = array();
														$globalAllowanceStringPer = '';
														 if(isset($display_phase_allowance_fix[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															
															$getAllAllowanceFix = $display_phase_allowance_fix[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															//print_r($getAllAllowanceFix);
															for($ALF=0;$ALF<count($getAllAllowanceFix);$ALF++){
																$splitALF = explode('==>', $getAllAllowanceFix[$ALF]);
																if($splitALF[0] != ''){
																	$globalAllowanceStringFix .= $splitALF[0].'='.$splitALF[1].' ';
																	$globalAllowanceAmountFix[] = $splitALF[1];
																}
															}	
														 }
										
														 if(isset($display_phase_allowance_per[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															
															$getAllAllowancePer = $display_phase_allowance_per[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															//print_r($getAllAllowancePer);
															for($ALP=0;$ALP<count($getAllAllowancePer);$ALP++){
																$splitALP = explode('==>', $getAllAllowancePer[$ALP]);
																if($splitALP[0] != ''){
																	$globalAllowanceStringPer .= $splitALP[0].'='.$splitALP[1].' ';
																	$globalAllowanceAmountPer[] = $splitALP[1];
																}
															}	
														 }
														$totalGlobalAllowanceAmount = array_sum($globalAllowanceAmountFix)+array_sum($globalAllowanceAmountPer);
														//$allowance =  $global_allowance + $extra_allowance;
														//$allowance = $allowance + $global_allowance + $extra_allowance;
														//echo "=========";
														//print_r($global_allowance);
														
														//echo $currency . ' ' . number_format($allowance, 2);
														
														 //
														 //* @rupali=for show allowance popup start here
														 //* 
														 //
														 
														 /*$v_payment_history_salary_payment_id='';
                                                                 if(isset($v_payment_history->salary_payment_id))
                                                                 {
																	 $v_payment_history_salary_payment_id=$v_payment_history->salary_payment_id;
																 }
																 $v_payment_history_no_of_total_leave_hours='';
																  if(isset($v_payment_history->no_of_total_leave_hours))
                                                                 {
																	 $v_payment_history_no_of_total_leave_hours=$v_payment_history->no_of_total_leave_hours;
																 }
														 
														 
														$global_allowance_string = "";
														if(isset($new_globle_allownces_array)){
															foreach ($new_globle_allownces_array as $value) {
																$global_allowance_string .= $value . "\t"." , ";
															}*/
															//echo '<p class="extra" id="p_'.$v_payment_history->salary_payment_id.'">'. $global_allowance_string.'</p>';
															?>
															<a href="#" id="age" data-toggle="tooltip" title="<?php echo $globalAllowanceStringFix.$globalAllowanceStringPer;?>"
															class="more"><?php echo $currency . ' ' . $totalGlobalAllowanceAmount;?></a>
														<?php  //}
														//ends
														//echo 'anajn';
													?>
													</td>
                                                    
                                                    <!--Total Dedduction -->
													<?php 
														$totalTaxableDedAmount = 0;
														$didAmountFix = array();
														$didStringFix = '';
														$didAmountPer = array();
														$didStringPer = '';
														$stringSS = '';
														$stringNHI = '';
														$stringNHIS = '';
														$stringPT = '';
														$stringPTC = '';
														$amountSS = 0;
														$amountNHI = 0;
														$amountNHIS = 0;
														$amountPT = 0;
														$amountPTC = 0;
														$grandTotalDeduc = 0;
														$showNetSalaryAmount = 0;
														 if(isset($display_phase_taxable_did_fix[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															
															$getAllDEduFix = $display_phase_taxable_did_fix[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															for($TDEF=0;$TDEF<count($getAllDEduFix);$TDEF++){
																$splitTDEF = explode('==>', $getAllDEduFix[$TDEF]);
																if($splitTDEF[0] != ''){
																	$didStringFix .= $splitTDEF[0].'='.$splitTDEF[1].' ';
																	$didAmountFix[] = $splitTDEF[1];
																}
															}	
														 }
										
														 if(isset($display_phase_taxable_did_per[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															
															$getAllDeduPer = $display_phase_taxable_did_per[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															for($TDEP=0;$TDEP<count($getAllDeduPer);$TDEP++){
																$splitTDEP = explode('==>', $getAllDeduPer[$TDEP]);
																if($splitTDEP[0] != ''){
																	$didStringPer .= $splitTDEP[0].'='.$splitTDEP[1].' ';
																	$didAmountPer[] = $splitTDEP[1];
																}
															}	
														 }
														$totalTaxableDedAmount = array_sum($didAmountFix)+array_sum($didAmountPer);
														if(isset($display_phase_social_security[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															$amountSS = $display_phase_social_security[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															$stringSS .= 'Social Security ='.$amountSS.' ';			
														}
														if(isset($display_phase_nhi_employee_salary[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															$amountNHI = $display_phase_nhi_employee_salary[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															$stringNHI .= 'NHI Deduction ='.$amountNHI.' ';			
														}
														if(isset($display_phase_nhi_employee_spouse_salary[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															$amountNHIS = $display_phase_nhi_employee_spouse_salary[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															$stringNHIS .= 'Spouse NHI Deduction ='.$amountNHIS.' ';			
														}
														if(isset($display_phase_employee_pay_tax[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															$amountPT = $display_phase_employee_pay_tax[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															$stringPT .= 'Payroll Tax Deduction ='.$amountPT.' ';			
														}
														if(isset($display_phase_class_charge[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){
															$amountPTC = $display_phase_class_charge[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];
															$stringPTC .= 'Payroll Tax Class Deduction ='.$amountPTC.' ';			
														}
														$grandTotalDeduc = $totalTaxableDedAmount+$amountSS+$amountNHI+$amountNHIS+$amountPT+$stringPTC;
														?>
													<td><?php echo $currency . ' '; echo $gross_hourly_salary_with_allowance[$v_payment_history->employee_id][$display_payment_key[$dateSlap]]-$display_phase_total_non_taxable[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];?></td>
                                                    <td><?php
													/*$deduction = 0;
													$extra_deduction = 0;
													$global_deduction = 0;
													$leave_deduction=0;
													$social_security = 0;
													
													
													if(empty($v_payment_history->set_salary_details))
													{  		
														 $deduction = round(  $v_payment_history->nhi_deduction + $v_payment_history->spouse_nhi_deduction + $v_payment_history->payroll_tax_deduction,3);
														
														if(is_array($v_payment_history->extra_deduction))
														{
															$new_extra_deduction_array=array();
															foreach($v_payment_history->extra_deduction as $ex_alw)
															{
																if($ex_alw != "")
																{
																	$dd = explode("=",$ex_alw);
																	
																	//@sunny deduction acording to paymeny frequecy starts 
																	      

																	$new_deduction_value=$dd[1];

																	
																	//@sunny deduction acording to paymeny frequecy ends
																	
																	$extra_deduction +=$new_deduction_value;
																	$new_extra_deduction_array[]=$dd[0]."=".$new_deduction_value;
																}
															}
														}
														
														if(isset($v_payment_history->global_deduction))
														{
															if(is_array($v_payment_history->global_deduction))
															{
																$new_globle_deduction_array=array();$new_globle_deduction_array_for_save=array();
																foreach($v_payment_history->global_deduction as $gb_alw)
																{
																	if($gb_alw != "")
																	{
																		$dd = explode("=",$gb_alw);
																		
																		//@sunny deduction acording to paymeny frequecy starts 
																			  

																		$new_deduction_value=$dd[1];
																		
																		if($databasePaymentFrequency!=3 && empty($v_payment_history->salary_payment_id))
																		{
																			
																			   // if actual value==2
																			   if($databasePaymentFrequency==2)
																			   {
																				   $new_deduction_value=$new_deduction_value/2;
																			   }
																			   // if actual value==0 (Two Weekly)
																			     
																			   if($databasePaymentFrequency==0)
																			   {
																				   $new_deduction_value=$new_deduction_value/2;
																			   }
																			   //if actual value==1
																				if($databasePaymentFrequency==1)
																			   {
																				   $new_deduction_value=$new_deduction_value/4;
																			   }								   
																			   
																		}
																		//@sunny deduction acording to paymeny frequecy ends
																																				
																		//*******If NON TAXABLE THAN CONCINATE (did_amt_tax 1=tax, 0=nontax)********
																		//if(isset($dd[3]))
																		{
																			//if($dd[3]==0)
																			{
																			$global_deduction += $new_deduction_value;
																			$new_globle_deduction_array[]=$dd[0]."=".$new_deduction_value;
																			$new_globle_deduction_array_for_save[]=$dd[0]."=".$new_deduction_value."=".$dd[2]."=".$dd[3];
																			}
																		}																																
																		
																	}
																}
															}
														}																	
														//@sunny deduction acording to paymeny frequecy starts 
														$social_security = $v_payment_history->social_security;														
														//@sunny deduction acording to paymeny frequecy ends
														
														
														
													}
													if(!empty($display_phase_social_security[$v_payment_history->employee_id][$display_payment_key[$dateSlap]])){	
													$social_security = $display_phase_social_security[$v_payment_history->employee_id][$display_payment_key[$dateSlap]];	
														
													}
													//echo $social_security.'AAAAAAAAAA';
													$deduction+= $social_security+$global_deduction + $extra_deduction;
													
													//@sunny deduction acording to paymeny frequecy starts 														      

													//$leave_deduction=$v_payment_history->leave_deduction;
													 $leave_deduction=(isset($v_payment_history->salary_payment_id)  && !empty($v_payment_history->salary_payment_id) ) ?  
													 $v_payment_history->leave_deduction  : 
													 (($gross - $deduction)*$v_payment_history->no_of_total_leave_hours)/$v_payment_history->total_work_day; 
													 
													 //$leave_deduction=($gross - $deduction)*$v_payment_history->no_of_total_leave_hours/$v_payment_history->total_work_day;
													
													//@sunny deduction acording to paymeny frequecy ends */
													?>
														 <input type="hidden" name="global_deduction_pay[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $global_deduction ?>" />
														 <input type="hidden" name="extra_deduction_pay[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $extra_deduction ?>" />
														 <input type="hidden" name="leave_deduction_pay[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $leave_deduction ?>" />
														 <input type="hidden" name="social_security_deduction_pay[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $social_security ?>" />
														<?php

													//echo $currency . ' ' . number_format($leave_deduction, 2)."</br>+</br>".$currency . ' ' . number_format($deduction, 2);
													 //
													 // @rupali=for show deduction popup start here
													 
													 //
                                                                 
															/*$global_deduction_string = "";
															if(isset($new_globle_deduction_array)){
																//print_r($new_globle_deduction_array); 
                                                                foreach ($new_globle_deduction_array as $value) {
                                                                    $global_deduction_string .= $value." , ";
                                                                }
															}
															$extra_deduction_string = "";
															if(isset($new_globle_deduction_array)){
                                                                foreach ($new_extra_deduction_array as $value) {
                                                                    $extra_deduction_string .= $value." , ";
                                                                }
															}
															$v_payment_history_nhi_deduction='';
															if(isset($v_payment_history->nhi_deduction))
															{
																$v_payment_history_nhi_deduction=$v_payment_history->nhi_deduction;
															}
															
															$v_payment_history_spouse_nhi_deduction='';
															if(isset($v_payment_history->spouse_nhi_deduction))
															{
																$v_payment_history_spouse_nhi_deduction=$v_payment_history->spouse_nhi_deduction;
															}
															
															$v_payment_history_payroll_tax_deduction='';
															if(isset($v_payment_history->payroll_tax_deduction))
															{
																$v_payment_history_payroll_tax_deduction=$v_payment_history->payroll_tax_deduction;
															}
															  
															
                                                                $global_deduction_string.= " social security = " . $social_security . $extra_deduction_string." , nhi_deduction = ". $v_payment_history_nhi_deduction." , spouse_nhi_deduction = ". $v_payment_history_spouse_nhi_deduction." , payroll_tax_deduction = ".$v_payment_history_payroll_tax_deduction;
                                                               // $deduction = round(   + $v_payment_history->spouse_nhi_deduction + $v_payment_history->payroll_tax_deduction,3);*/
                                                                 
																 
                                                               // echo '<a href="#" id="age" data-toggle="tooltip" title="Total Leave Days='.$v_payment_history->no_of_total_leave_hours.' And leave deduction=' . $leave_deduction . $this->payroll->$no_of_leave_day . '" p_id="' . $v_payment_history->salary_payment_id . '" class="more">' . $currency . ' ' . number_format($leave_deduction, 2) . '</a>
                                                                //echo '<a href="#" id="age" data-toggle="tooltip" title="Total Leave Days='.$v_payment_history_no_of_total_leave_hours.' And leave deduction=' . $leave_deduction  . '" p_id="' . $v_payment_history_salary_payment_id . '" class="more">' . $currency . ' ' . number_format($leave_deduction, 2) . '</a>
                                                                echo '<a href="#" id="age" data-toggle="tooltip" title="' . $didStringFix.$didStringPer.$stringSS.$stringNHI.$stringNHIS.$stringPT.$stringPTC . '" p_id="' . $v_payment_history_salary_payment_id . '" class="more" >' . $currency . ' ' . $grandTotalDeduc . '</a>';

                                                               
                                                                


                                                                //ends
													?>
													</td>
                                                    
                                                    
                                                    
													
													
													<!-- old Net Salary-->
                                                    <td style="display:none">
													<?php
													$net_salary = $gross - ($deduction); 
													$net_salary_without_leave_deduction=$net_salary - ($leave_deduction); 
													
													if (!empty($genaral_info[0]->currency)) {
														$currency = $genaral_info[0]->currency;
													} else {
														$currency = '$';
													}
																			
													
													echo '<a href="#"  data-toggle="tooltip" title="(Gross Salary -Total Deduction)"  class="more" >' . $currency . ' ' . number_format($net_salary_without_leave_deduction, 2) . '</a>';
																										
													//echo $currency . ' ' . number_format($net_salary_without_leave_deduction, 2);
													?>
													</td>
													
													
													<!-- Now Net Salary-->
													<td><?php
													/*$no_of_work_day=$v_payment_history->no_of_work_day;
													$total_work_day=$v_payment_history->total_work_day;						
													$basic_salary=$net_salary;
													
													$total_working_salary=(isset($v_payment_history->total_working_salary)) ? $v_payment_history->total_working_salary : 0;
													$total_overtime_salary=(isset($v_payment_history->total_overtime_salary)) ? $v_payment_history->total_overtime_salary : 0;
													
													
													$explainNetSal = ($v_payment_history->salary_type == 1) ? $total_working_salary." + ".$total_overtime_salary ." + (".$allowance." * ".$no_of_work_day." / ".$total_work_day." ) - (".$deduction." * ".$no_of_work_day." / ".$total_work_day." )" : $basic_salary." * ".$no_of_work_day." / ".$total_work_day;
													$working_salary=0;
													if(!empty($no_of_work_day) && !empty($total_work_day)){
													 $working_salary=($v_payment_history->salary_type == 1) ? $basic_hourly_salary[$v_payment_history->employee_id][$display_payment_key[$dateSlap]] + ($allowance * $no_of_work_day / $total_work_day ) - ($deduction * $no_of_work_day / $total_work_day )  : $basic_salary * ($no_of_work_day / $total_work_day);
													}
													//echo "<".$v_payment_history->total_working_salary.">total_overtime_salary="."<".$v_payment_history->total_overtime_salary.">";
													//echo $working_salary;
													$formula=($v_payment_history->salary_type == 1) ? '( total_working_salary + total_overtime_salary ) + (Allowance * No of work_day / Total work day ) - (Deduction * No of work_day / Total work day ) ' : '( Basic salary * No of work_day ) / (Total work day)';*/
													$explainNetSal = $gross_hourly_salary_with_allowance[$v_payment_history->employee_id][$display_payment_key[$dateSlap]].'+'.$display_phase_total_non_taxable[$v_payment_history->employee_id][$display_payment_key[$dateSlap]].'+'.$grandTotalDeduc; 
													$showNetSalaryAmount = $gross_hourly_salary_with_allowance[$v_payment_history->employee_id][$display_payment_key[$dateSlap]]-$display_phase_total_non_taxable[$v_payment_history->employee_id][$display_payment_key[$dateSlap]]-$grandTotalDeduc;
													//echo '<a href="#"  data-toggle="tooltip" title="'.$formula.'"  class="more" >' . $currency . ' ' . number_format($working_salary, 2) . '</a>';
													echo '<a href="#"  data-toggle="tooltip" title="'.$explainNetSal.'"  class="more" >' . $currency . ' ' . $showNetSalaryAmount . '</a>';
													
													?> 
													<input type="hidden" name="employee_no_of_work_day[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $no_of_work_day?>" />
													<input type="hidden" name="employee_total_work_day[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $total_work_day?>" />
													<input type="hidden" name="employee_no_of_total_leave_hours[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history_no_of_total_leave_hours?>" /><!--29.8.16-->
													<input type="hidden" name="employee_salary_type[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->salary_type?>" /><!--02.9.16-->
													<input type="hidden" name="employee_salary_type[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->salary_type?>" /><!--02.9.16-->
													<input type="hidden" name="employee_total_working_salary[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $total_working_salary; ?>" /><!--02.9.16-->
													<input type="hidden" name="employee_total_overtime_salary[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $total_overtime_salary; ?>" /><!--02.9.16-->
													</td>
													
													<!-- Action-->
													<td><?php 
													if(!empty($v_payment_history->paid_status))
													{
														echo '<span class="label label-success">'.$v_payment_history->paid_status.'</span>'; 
													}
													else if(!empty($v_payment_history->set_salary_details))
													{
														echo '<span class="label label-warning">Set Payment</span>';
													}
													else
													{
														echo '<span class="label label-danger">Unpaid</span>';
													   
													?>
													<!--@pulkit-->
														<input type="hidden" name="employee_id[]" value="<?php echo $v_payment_history->employee_id?>" />
														<input type="hidden" name="employee_gross_salary[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $gross?>" />
														<input type="hidden" name="payment_for_month[<?php echo $v_payment_history->employee_id?>]" value="<?php echo date('Y-m', strtotime($end_payment_date))?>">
														<input type="hidden" name="next_paydate[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->next_paydate?>">
														<input type="hidden" name="end_paydate[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->end_paydate?>">
														
														<input type="hidden" name="basic_sal[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->basic_salary?>" />
														<?php //print_r($new_globle_allownces_array_for_save); ?>
														<!-- Global and extra allowance -->
														<input type="hidden" name="global_allowance[<?php echo $v_payment_history->employee_id?>]" value="<?php if(isset($new_globle_allownces_array_for_save)) {echo implode("<-->",$new_globle_allownces_array_for_save); } ?>" />      
														
													 
														<input type="hidden" name="extra_allowance[<?php echo $v_payment_history->employee_id?>]" value="<?php if(isset($new_extra_globle_allownces_array)) { echo implode("<-->",$new_extra_globle_allownces_array); }?>" />
														
														
														<!-- Global and extra deduction -->
														<input type="hidden" name="global_deduction[<?php echo $v_payment_history->employee_id?>]" value="<?php if(isset($new_globle_deduction_array_for_save)) { echo implode('<-->',$new_globle_deduction_array_for_save) ; }?>" />
														<input type="hidden" name="extra_deduction[<?php echo $v_payment_history->employee_id?>]" value="<?php if(isset($new_extra_deduction_array)) { echo implode('<-->',$new_extra_deduction_array); } ?>" /> 
														
														
														<!-- nhi, ss and payroll -->
														<input type="hidden" name="payroll_tax[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->payroll_tax_deduction?>" /> 
														<input type="hidden" name="spouse_nhi[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->spouse_nhi_deduction ?>" /> 
														<input type="hidden" name="nhi[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->nhi_deduction?>" /> 
														<input type="hidden" name="social_security[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $social_security?>" /> 
														<input type="hidden" name="leave_deduction[<?php echo $v_payment_history->employee_id?>]" value="<?php echo $v_payment_history->leave_deduction?>" />

													
													<?php
														
													}
													?>
													</td>
													
													
                                                    <td class="hidden-print">
													<?php 
													if(!empty($v_payment_history->salary_payment_id))
													{
														echo btn_view('admin/payroll/salary_payment_details/' . $v_payment_history->salary_payment_id);
														//@rupali for print check  or direct deposite
														if (($v_payment_history->payment_type)=='Cheque Payment'){
                                                           
                                                             ?>
																<a title="" data-placement="top" data-toggle="tooltip" class="btn btn-info btn-xs" style="background-color:#428bca;"href="<?php echo base_url()?>admin/payroll/salary_cheque_details/<?php echo $v_payment_history->salary_payment_id;?>" data-original-title="View"><span class="fa fa-list-alt"> print</span></a>
																<?php
																 //echo btn_view('admin/payroll/salary_cheque_details/' . $v_payment_history->salary_payment_id);
														  
															 }  ?> 
																
														 <?php if (($v_payment_history->payment_type)=='Direct Deposite'){?>
													   
																<a title="" data-placement="top" data-toggle="tooltip" class="btn btn-info btn-xs" style="background-color:#428bca;"href="<?php echo base_url()?>admin/payroll/download_deposite/<?php echo $v_payment_history->salary_payment_id;?>" data-original-title="View"><span class="fa fa-list-alt">Download</span></a>
															  <?php  }     
														//@rupali ends
														?>
														<input type="hidden" name="selected_payment_type_<?=$z?>" id="selected_payment_type_<?=$z?>" value="<?=$v_payment_history->payment_type?>"/>
														<input type="hidden" name="selected_salary_payment_id_<?=$z?>" id="selected_salary_payment_id_<?=$z?>" value="<?=$v_payment_history->salary_payment_id?>"/>
														
														<?php 
														 
													}
													else if(!empty($v_payment_history->set_salary_details))
													{
														echo btn_edit('admin/payroll/manage_salary_details/' . $v_payment_history->employee_id.'/'.$v_payment_history->designations_id);
													}
													else
													{
													?>
														<input type="hidden" name="txtemp_id[]" value="<?=$v_payment_history->employee_id?>"/>
														<div class="parent_payment_type" >
															<!-- Payment Type       onchange="get_payment_value(this.value,'<?=$v_payment_history->employee_id?>')"-->                                               
															<select employee_id="<?=$v_payment_history->employee_id?>"  name="payment_type[<?php echo $v_payment_history->employee_id?>]" class="slect_payment_type form-control col-sm-5"   required >
																<option value="" >Select Payment Type...</option>                                            
																<option value="Cash Payment">Cash Payment</option>                                            
																<option value="Cheque Payment">Cheque Payment</option>
																<option value="Direct Deposite">Direct Deposite</option>                                           
															</select>
															<input type="hidden" name="Cheque_payment_no_<?=$v_payment_history->employee_id?>"  id="Cheque_payment_no_<?=$v_payment_history->employee_id?>"  >                                                 
														</div><!-- Payment Type --> 
													<?php
													}
													?>
													</td>
													<td>														<?php 														if(empty($v_payment_history->paid_status))														{															if(!empty($bank_account))															{																?>																																		<select class="form-control" name="bank_accounts[<?php echo $v_payment_history->employee_id?>]" id="bank">																	<option value="">-- Select -- </option> 																<?php																foreach($bank_account as $bank)																{																?>																	<option value="<?php echo $bank->account_id ?>"><?php echo $bank->account_name?></option>																																<?php																}																?>																</select>																<?php															}														}														else														{															echo $v_payment_history->bank_accounts;														}														
                                                    
														?>
													</td>
                                                </tr>
														<?php
														} 
												  ?>
                                                
                                                <?php
                                                
												
                                            $dateSlap++;
                                            
                                            }  // second for loop ends here
												//$z++;
                                            } // first for loop ends here 
                                            ?>
											
                                        <?php else : ?>
                                            <tr>       
                                                <td colspan="9">
                                                    <strong>There is no data for display</strong>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>      
								<div class="form-group" id="border-none">
									<label for="field-1" class="col-sm-3 control-label"></label>
									<div class="col-sm-12">
										<div class="col-sm-4">
										<button id="bulk_cheque_print" type="button" name="sbtn" value="" class="btn btn-primary btn-block">Bulk Cheque Print</button>
										<!--<input type="text" name="cheque_print" class="cheque_print" value="">-->
										</div>
										<div class="col-sm-4">
										<button id="payment" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">Make Payment</button>
										</div>
										<div class="col-sm-4">
										<button id="bulk_download" type="button" name="sbtn" value="1" class="btn btn-primary btn-block">Bulk Deposit Download</button>
										</div>
									</div>
								</div>
								</form>    
                            </div>                                    
                        </div>                             
                    </div><!--************ Payment History End***********-->
                </div>
            </div>
        </div>
    </div>    
<?php endif; ?>
<script type="text/javascript">
    function payment_history(payment_history) {
        var printContents = document.getElementById(payment_history).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<script type="text/javascript">
    $(document).on("change", function() {
        var fine = 0;
        fine = $("#fine_deduction").val();
        var net_salary = $("#net_salary").val();
        var total = net_salary - fine;
        $("#payment_amount").val(total);
		
    });
	$(function(){
		$('#sdate').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
		$('.input-daterange input').each(function() {
			$(this).datepicker("clearDates");
		});
		$('#edate').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
		$("#sdate").change(function(){
			$('#edate').datepicker('clearDates');
			$('#edate').datepicker('remove');
			
			$('#edate').datepicker({
				autoclose: true,
				format: "yyyy-mm-dd",
				startDate:$("#sdate").val()
			});
		});
		$("#edate").change(function(){
			$('#sdate').datepicker('clearDates');
			$('#sdate').datepicker('remove');
			
			$('#sdate').datepicker({
				autoclose: true,
				format: "yyyy-mm-dd",
				endDate:$("#edate").val()
			});
		});
		
	});
</script>        
<!--@pank 9-8-2016  for popup show Cheque_payment fields method START-->
<div id="modal-content" class="modal fade" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3> Cheque Details</h3>
            </div>
            <div class="modal-body">
                <label>Cheque NO :</label>
					<input type="number" name="Cheque_no" id="Cheque_no" value="" class="contact-input-box"  required>
					<input type="hidden" name="emp_id" id="emp_id" value="" class="contact-input-box" >
					
				 <div class="modal-footer"> 
             <button style="margin-left:40%" type="button" class="btn btn-secondary" id="cheque_no_save_btn" data-dismiss="modal">SAVE</button>
                 
            </div>
        </div>
    </div>
</div><!--@pank 9-8-2016  for popup show Cheque_payment fields method END-->
<!--@pank 9-8-2016  for popup new form  when select Cheque_payment method START-->
<script type="text/javascript">	
		
		$(".slect_payment_type").on("change", function(){
			
			var value=$(this).val();
			var emp_id=$(this).attr("employee_id");		
			
			if(value=="Cheque Payment")
			{	$('#modal-content').modal({
				show: true
				});
				 $("#emp_id").val(emp_id);
				
			}
		
		});
		
		$('#cheque_no_save_btn').click( function(){
				var check_value=$('#Cheque_no').val();
				if(check_value==''){alert("Please Enter Check No : Numeric");return false;}
				var Cheque_no = check_value;
				var emp_id = $('#emp_id').val();
				$('#Cheque_payment_no_'+emp_id).val(Cheque_no);
				$('#Cheque_no').val("");		
						
		});	
		
		
		<!--@sunny select_payment_date starts here ...--> 
		function select_payment_date(value){ 
			if(value==0){
				$("#div_monthly_payment_date").addClass("hide");
				$("#div_bi_monthly_payment_date").addClass("hide");
				$("#div_two_weekly_payment_date").removeClass("hide");
				$("#div_weekly_payment_date").addClass("hide");
			}
			else if(value==1){
				$("#div_monthly_payment_date").addClass("hide");
				$("#div_bi_monthly_payment_date").addClass("hide");
				$("#div_two_weekly_payment_date").addClass("hide");
				$("#div_weekly_payment_date").removeClass("hide");
			}
			else if(value==2){
				$("#div_monthly_payment_date").addClass("hide");
				$("#div_bi_monthly_payment_date").removeClass("hide");
				$("#div_two_weekly_payment_date").addClass("hide");
				$("#div_weekly_payment_date").addClass("hide");
			}
			else if(value==3){
				$("#div_monthly_payment_date").removeClass("hide");
				$("#div_bi_monthly_payment_date").addClass("hide");
				$("#div_two_weekly_payment_date").addClass("hide");
				$("#div_weekly_payment_date").addClass("hide");
			}
			else {
				$("#div_monthly_payment_date").addClass("hide");
				$("#div_bi_monthly_payment_date").addClass("hide");
				$("#div_two_weekly_payment_date").addClass("hide");
				$("#div_weekly_payment_date").addClass("hide");
			}
		}
		
	
		<!--@sunny select_payment_date ends here ...--> 
			 
</script>
<!--@pank 9-8-2016  for popup new form  when select Cheque_payment method START-->    





<!--@sunny Select and Un Select and send selected rows to bulk print payslip starts here ...-->

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatables/jquery-1.12.3.js">
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatables/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatables/dataTables.select.min.js">
</script>
<!--
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/datatables/select.dataTables.min.css">
<script>
	//@sunny starts here ....
$(document).ready(function() {
	// Array holding selected row IDs
	var rows_selected_id = '';
   var rows_selected = [];
   var table = $('#example').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc']]
    } );

   // Handle click on checkbox
   $('#example').on('click', 'td:first-child', function(e){
	  
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[0];
      //alert(rowId);
console.log("<<<"+rowId+">>>");
      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
     // if(this.checked && index === -1){alert("ckeck");
      if($row.hasClass("selected") && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){ //alert("unckeck");
         rows_selected.splice(index, 1);
      }
      
     
console.log(rows_selected_id);
		console.log("rows_selected_id=>"+rows_selected_id);
		  for (var i = 0; i < rows_selected.length; ++i)
			{
				console.log("rows_selected_id=>"+rows_selected_id);
				rows_selected_id+= (rows_selected_id=='') ? ''+rows_selected[i] :  '_'+rows_selected[i] ;
			}
			
			console.log("final_rows_selected_id=>"+rows_selected_id);
     /* if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }*/
      console.log(rows_selected_id);
return false;
      // Update state of "Select all" control
      //updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#example').on('click', 'tbody td, thead th:first-child', function(e){
	   //alert("test");
   console.log($(this));
     // $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

  
  
   // Handle click on "Select all" control
   $('thead input[name="select_all"]', table.table().container()).on('click', function(e){   
	  
      if(this.checked){ 
		   $row.addClass('selected'); 
         //$('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
		  $row.removeClass('selected');
        // $('#example tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
      
      /*if ($("#all").is(':checked')) { 
	  $(".checkboxclass", table.fnGetNodes()).each(function () { 
	  $(this).prop("checked", true);
	  });     
	else {
	  $(".checkboxclass", table.fnGetNodes()).each(function () {
	  $(this).prop("checked", false); 
	  })
	  }*/
   });




   // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });
    
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY     
      
      // Output form data to a console     
      $('#example-console').text($(form).serialize());
      console.log("Form submission", $(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });
     
     
     
     
     
   
   //@sunny bBulk Genereate Cheque and Direct deposit 15 august 2016 starts here .......  
		
		$('#bulk_cheque_print').on('click', function(e){
				//var selected_id="35_37";	
				var selected_id=rows_selected_id;	
				bulk_print_download_common(selected_id);
	
		});		
		
		$('#bulk_download').on('click', function(e){
				//var selected_id="36";		
				var selected_id=rows_selected_id;	
				//alert(selected_id);
				bulk_print_download_common(selected_id);
		});
		
		function bulk_print_download_common(selected_id){
			//alert("selected_id==>"+selected_id);
			var idArray=selected_id.split("_"); 
			
			var rowId; 
			var selected_payment_method; 
			var selecte_only_check=''; 
			var selecte_only_deposit='';
			for(var k=0; k<=idArray.length; k++)
			{
				
				rowId=idArray[k];
				//alert("rowId==>"+rowId);
				selected_payment_method=$("#selected_payment_type_"+rowId).val();
				//alert("selected_payment_method==>"+selected_payment_method);
				if(selected_payment_method=='Cheque Payment'){
					  rowId=$("#selected_salary_payment_id_"+rowId).val();
					selecte_only_check+=(selecte_only_check=='')? rowId : "_" + rowId;
				}
				if(selected_payment_method=='Direct Deposite'){
					rowId=$("#selected_salary_payment_id_"+rowId).val();
					selecte_only_deposit+=(selecte_only_deposit=='')? rowId : "_" + rowId;
				}
			}
			//if both exist
			if(selecte_only_check!='' && selecte_only_deposit!=''){							
			
					var pid = window.setInterval(function() {
						window.location.href="<?php echo base_url()?>admin/payroll/salary_cheque_details/"+selecte_only_check;
						
						typeof pid !== 'undefined' && window.clearInterval(pid);
					}, 1000);
					window.location.href="<?php echo base_url()?>admin/payroll/download_deposite/"+selecte_only_deposit;
					return false
					
			}
			//any one from them
			if(selecte_only_check!='' && selecte_only_deposit=='')
			{		
				window.location.href="<?php echo base_url()?>admin/payroll/salary_cheque_details/"+selecte_only_check;
				return false;
			}
			if(selecte_only_deposit!='' && selecte_only_check=='')
			{				
				window.location.href="<?php echo base_url()?>admin/payroll/download_deposite/"+selecte_only_deposit;	
				return false;			
			}
			
			if(selecte_only_check=='' && selecte_only_deposit==''){
				alert("Please Select at least one check box");return false;
			}
			if(selecte_only_deposit=='')
			{
				alert("Please Select at least one direct deposit file check box");return false;
			}
		}
	//@sunny bBulk Genereate Cheque and Direct deposit 15 august 2016 ends here .......
	<!--@sunny Select and Un Select and send selected rows to bulk print payslip starts here ...--> 


	
});





</script>


