<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12 wrap-fpanel" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
                        <strong><?php echo $this->language->form_heading()[18] ?></strong>
                    </span>
                </div>
            </div>
            <!-- Table -->

            <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="col-sm-1">ID</th>
                        <th>Full Name</th>
                        <th>Gross Salary</th>
                        <th>Deductions=Other + Leave Deduction</th>
                        <th>Net Salary</th>
                        <th>Emp Type</th>
                        <th class="col-sm-1">Details</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($emp_salary_info)):foreach ($emp_salary_info as $v_emp_salary): ?>                    
                            <tr>
                                <td><?php echo $v_emp_salary->employment_id; ?></td>
                                <td><?php echo $v_emp_salary->first_name . ' ' . $v_emp_salary->last_name ?></td>
                               
                               <!-- GRoss Salary starts here -->
                                <td><?php 
								$allowances = 0;
								//global Allowance
								if (!empty($global_allow_deduct)): 
									foreach($global_allow_deduct as $glob_allow)
									{
										//print_r($glob_allow);exit;
										if(!empty($glob_allow->allow_name))
										{
											if($glob_allow->allow_amt_type == "per")
											{
												if (!empty($v_emp_salary->basic_salary)) {
													$amt = (($v_emp_salary->basic_salary * $glob_allow->allow_amt)/100);
												}
												else
												{
													$amt = $glob_allow->allow_amt;
												}
											}
											else
											{
												$amt = $glob_allow->allow_amt;
											}
											
											//@sunny allownces acording to paymeny frequecy starts 
											$databasePaymentFrequency =$v_emp_salary->payment_frequency;       
		   
											if($databasePaymentFrequency!=3)
											{
												
												   // if actual value==2
												   if($databasePaymentFrequency==2)
												   {
													   $amt=$amt/2;
												   }
												   // if actual value==0 (Two Weekly)
												   if($databasePaymentFrequency==0)
												   {
													   $amt=$amt/2;
												   }
												   //if actual value==1
													if($databasePaymentFrequency==1)
												   {
													   $amt=$amt/4;
												   }								   
												   
											}
											//@sunny allownces acording to paymeny frequecy ends  
											
											
											
											
											$allowances += $amt;
										}
									}
								endif; 
								
								//extra allowance
								if (!empty($v_emp_salary->extra_allowance)): 
									$extra_allow = explode('<-->',$v_emp_salary->extra_allowance);
									unset($extra_allow[count($extra_allow)-1]);
									foreach($extra_allow as $ex_al)
									{
										$desc = explode("=",$ex_al);
										
										//@sunny allownces acording to paymeny frequecy starts 
											$databasePaymentFrequency =$v_emp_salary->payment_frequency;       
		   
											$new_allownces_value=$desc[1];
		   
											/*if($databasePaymentFrequency!=3)
											{
												
												   // if actual value==2
												   if($databasePaymentFrequency==2)
												   {
													   $new_allownces_value=$new_allownces_value/2;
												   }
												   //if actual value==1
													if($databasePaymentFrequency==1)
												   {
													   $new_allownces_value=$new_allownces_value/4;
												   }								   
												   
											}*/
											//@sunny allownces acording to paymeny frequecy ends
										//echo "<".$new_allownces_value."></br>";
										$allowances += $new_allownces_value;
									}
								endif;
								
								echo $gross = $v_emp_salary->basic_salary +  $allowances?></td>
                                
                                <!-- Deduction starts here -->
                                <td><?php
								
								$deductions = 0;
								//global Deductions
								if (!empty($global_allow_deduct)): 
									foreach($global_allow_deduct as $glob_deduct)
									{
										//print_r($glob_deduct);exit;
										if(!empty($glob_deduct->did_name))
										{	
											if($glob_deduct->did_amt_type == "per")
											{
												if (!empty($v_emp_salary->basic_salary)) {
													$amt = (($v_emp_salary->basic_salary * $glob_deduct->did_amt)/100);
												}
												else
												{
													$amt = $glob_deduct->did_amt;
												}
											}
											else
											{
												$amt = $glob_deduct->did_amt;
											}
											
											
											//@sunny deduction acording to paymeny frequecy starts 
											$databasePaymentFrequency =$v_emp_salary->payment_frequency;       
		   
											if($databasePaymentFrequency!=3)
											{
												
												   // if actual value==2
												   if($databasePaymentFrequency==2)
												   {
													   $amt=$amt/2;
												   }
												   // if actual value==0 (Two Weekly)
												    if($databasePaymentFrequency==0)
												   {
													   $amt=$amt/2;
												   }
												   //if actual value==1
													if($databasePaymentFrequency==1)
												   {
													   $amt=$amt/4;
												   }								   
												   
											}
											//@sunny deduction acording to paymeny frequecy ends 
											
											$deductions += $amt;
										}
									}
								endif; 
								
								//extra allowance
								if (!empty($v_emp_salary->extra_deduction)): 
								
									$extra_deduct = explode('<-->',$v_emp_salary->extra_deduction);
									
									unset($extra_deduct[count($extra_deduct)-1]);
									foreach($extra_deduct as $ex_al)
									{
										$desc = explode("=",$ex_al);
										
										//@sunny allownces acording to paymeny frequecy starts 
											$databasePaymentFrequency =$v_emp_salary->payment_frequency;       
		   
											$new_deduction_value=$desc[1];
		   
											/*if($databasePaymentFrequency!=3)
											{
												
												   // if actual value==2
												   if($databasePaymentFrequency==2)
												   {
													   $new_deduction_value=$new_deduction_value/2;
												   }
												   //if actual value==1
													if($databasePaymentFrequency==1)
												   {
													   $new_deduction_value=$new_deduction_value/4;
												   }								   
												   
											}*/
											//@sunny allownces acording to paymeny frequecy ends
										
										$deductions += $new_deduction_value;
									}
								endif; 
								
								if($v_emp_salary->basic_salary >= 10000)
								{
									$pay_tax = $v_emp_salary->payroll_tax_deduction;
								}
								else
								{
									$pay_tax = '0.000';
								}
								echo $deduction = $deductions + $v_emp_salary->social_security + $pay_tax + $v_emp_salary->nhi_deduction + $v_emp_salary->spouse_nhi_deduction;
								
								
								
								
								//$this->payroll_model->get_salary_payment_info($emp_id = NULL, $payment_date = NULL, $salary_payment_id);
								
								//print_r($this->payroll_model->get_emp_salary_list($v_emp_salary->employee_id));
								
								//LEAVE DEDUCTION
								$this->payroll_model->_table_name = 'tbl_salary_payment';
								$this->payroll_model->_order_by = 'salary_payment_id';
								$leave_deduction_result = $this->payroll_model->get_by(array('employee_id' => $v_emp_salary->employee_id));
								//print_r($leave_deduction_result[0]->leave_deduction);die;	
								if(isset($leave_deduction_result[0])){						
								echo " + ";
								echo ($leave_deduction_result[0]->leave_deduction=='') ? '0.000':$leave_deduction_result[0]->leave_deduction;
								
								echo " = ".$deduction+= $leave_deduction_result[0]->leave_deduction;
							    }
							    else{
									echo " + ";
								echo  '0.000';
								
								echo " = ".$deduction;
									
								}
								
								/*
								//@sunny calculate the total leave of candidate
				
								$emp_salary_info = $this->payroll_model->get_employee_leave_by_id($v_emp_salary->employee_id);
								
								$size = $leave =  $leave_min = count($emp_salary_info);
								//$size = $leave =  $leave_min = 2;
								$no_of_work_day = $size;
								$no_of_work_hours = $size;
								$no_of_leave_day = $size;
								$no_of_leave_hours = $size;*/?>
                                
                               <!-- Net salary starts here -->
                                <td><?php echo $gross - $deduction ?></td>
                                
                                
                                <td><?php
                                    if ($v_emp_salary->employment_type == 1) {
                                        echo 'Provision';
                                    } else {
                                        echo 'Permanent';
                                    }
                                    ?></td>
                                <td><?php echo btn_view('admin/payroll/view_salary_details/' . $v_emp_salary->employee_id); ?></td>
                                <td>
                                    <?php echo btn_edit('admin/payroll/manage_salary_details/' . $v_emp_salary->employee_id . '/' . $v_emp_salary->designations_id); ?>                                    
                                </td>
                            </tr>                
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
        });
    });
</script>
