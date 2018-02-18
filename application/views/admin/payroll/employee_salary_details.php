<div id="printableArea"> 
    <div class="row">
        <div class="col-sm-12 wrap-fpanel" data-spy="scroll" data-offset="0">                            
            <div class="panel panel-default">            
                <!-- main content -->
                <div class="panel-heading hidden-print">
                    <div class="row">
                        <div  class="col-lg-12 panel-title">
                            <strong>Employee Salary Detail</strong>
                            <div class="pull-right">                               
                                <span><?php echo btn_edit('admin/payroll/manage_salary_details/' . $emp_salary_info->employee_id . '/' . $emp_salary_info->designations_id); ?></span>
                                <span><?php echo btn_pdf('admin/payroll/make_pdf/' . $emp_salary_info->employee_id); ?></span>
                                <button class="btn-print" type="button" data-toggle="tooltip" title="Print" onclick="printDiv('printableArea')"><?php echo btn_print(); ?></button>                                                              
                            </div>
                        </div>
                    </div>
                </div>                                  
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
                </div><!--            show when print start-->            
                <div class="col-lg-12" style="background: #ECF0F1;margin-bottom: 20px;" >
                    <div class="row">                            
                        <div class="col-lg-2 col-sm-2">
                            <div class="fileinput-new thumbnail" style="width: 144px; height: 158px; margin-top: 14px; margin-left: 16px; background-color: #EBEBEB;">
                                <?php if ($emp_salary_info->photo): ?>
                                    <img src="<?php echo base_url() . $emp_salary_info->photo; ?>" style="width: 142px; height: 148px; border-radius: 3px;" >  
                                <?php else: ?>
                                    <img src="<?php echo base_url() ?>/img/user.png" alt="Employee_Image">
                                <?php endif; ?>         
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1">
                            &nbsp;
                        </div>
                        <div class="col-lg-8 col-sm-8 ">
                            <div>
                                <div style="margin-left: 20px;">                                        
                                    <h3><?php echo "$emp_salary_info->first_name " . "$emp_salary_info->last_name"; ?></h3>
                                    <hr />
                                    <table style="border: none">
                                        <tr>
                                            <td><strong>Employee ID</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$emp_salary_info->employment_id"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Department</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$emp_salary_info->department_name"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Designation</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$emp_salary_info->designations"; ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <td><strong>Joining Date</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo date('d M Y', strtotime($emp_salary_info->joining_date)); ?></td>
                                        </tr>                                            
                                    </table>                                                                           
                                </div>
                            </div>
                        </div>

                    </div>
                </div>                
            </div>                
        </div>                
    </div>                

    <div class="row">
        <div class="wrap-fpanel form-horizontal">
            <!-- ********************************* Salary Details Panel ***********************-->
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>Salary Details</strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="">
                            <label for="field-1" class="col-sm-3 control-label"><strong>Employment Type :</strong></label>
                            <p class="form-control-static"><?php
                                if ($emp_salary_info->employment_type == 1) {
                                    echo 'Provision';
                                } else {
                                    echo 'Permanent';
                                }
                                ?></p>
                        </div>
                        <div class="">
                            <label for="field-1" class="col-sm-3 control-label"><strong>Basic Salary :</strong> </label>                    
                            <p class="form-control-static"><?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                echo $currency . ' ' . number_format($emp_salary_info->basic_salary, 3);
                                ?></p>                    
                        </div>
                        <div class="">
                            <label for="field-1" class="col-sm-3 control-label"><strong>Job Sector :</strong> </label>                    
                            <p class="form-control-static"><?php
                                if ($emp_salary_info->job_sector == 1) {
                                    echo 'Public';
                                } else {
                                    echo 'Private';
                                }
                                ?></p>                    
                        </div>
                    </div>
                </div>
            </div><!-- ***************** Salary Details  Ends *********************-->

            <!-- ******************-- Allowance Panel Start **************************-->
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>Allowances</strong>
                        </div>
                    </div>
                    <div class="panel-body">
						<?php 
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
										if (!empty($emp_salary_info->basic_salary)) {
											$amt = (($emp_salary_info->basic_salary * $glob_allow->allow_amt)/100);
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
											$databasePaymentFrequency =$emp_salary_info->payment_frequency;       
		   
											if($databasePaymentFrequency!=3)
											{
												
												   // if actual value==2
												   if($databasePaymentFrequency==2)
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
									
						?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong> <?php echo ucfirst($glob_allow->allow_name)?> : </strong></label>
                                <p class="form-control-static"><?php 
								if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($amt, 3);
								?></p>                         
                            </div>
                        <?php	
									$allowances += $amt;
								}
							}
						endif; 
						
						//extra allowance
						if (!empty($emp_salary_info->extra_allowance)): 
							$extra_allow = explode('<-->',$emp_salary_info->extra_allowance);
							unset($extra_allow[count($extra_allow)-1]);
							foreach($extra_allow as $ex_al)
							{
								$desc = explode("=",$ex_al);
						?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong> <?php echo ucfirst($desc[0])?> : </strong></label>
                                <p class="form-control-static"><?php 
								if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($desc[1], 3);
								?></p>                         
                            </div>
                        <?php 
                        
								//@sunny allownces acording to paymeny frequecy starts 
									$databasePaymentFrequency =$emp_salary_info->payment_frequency;       
   
									$new_allownces_value=$desc[1];
   
									if($databasePaymentFrequency!=3)
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
										   
									}
									//@sunny allownces acording to paymeny frequecy ends
                        
								$allowances += $new_allownces_value;
							}
						endif; 
						?>
                    </div>
                </div>
            </div><!-- ********************Allowance End ******************-->

            <!-- ************** Deduction Panel Column  **************-->
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>Deductions</strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($emp_salary_info->social_security)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Social Security  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    
                                    
                                    
                                    //@sunny allownces acording to paymeny frequecy starts 
									$databasePaymentFrequency =$emp_salary_info->payment_frequency;       
   
									$emp_social_security=$emp_salary_info->social_security;
   
									if($databasePaymentFrequency!=3)
									{
										
										   // if actual value==2
										   if($databasePaymentFrequency==2)
										   {
											   //$emp_social_security=$emp_social_security/2;
										   }
										   //if actual value==1
											if($databasePaymentFrequency==1)
										   {
											   //$emp_social_security=$emp_social_security/4;
										   }								   
										   
									}
									//@sunny allownces acording to paymeny frequecy ends
                                    
                                    echo $currency . ' ' . number_format($emp_social_security, 3);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($emp_salary_info->nhi_deduction)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>National Health Insurance  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($emp_salary_info->nhi_deduction, 3);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($emp_salary_info->spouse_nhi_deduction)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Spouse NHI  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($emp_salary_info->spouse_nhi_deduction, 3);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($emp_salary_info->payroll_tax_deduction) && $emp_salary_info->basic_salary >=10000): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Payroll Tax  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($emp_salary_info->payroll_tax_deduction, 3);
                                    ?></p>                         
                            </div>
                        <?php endif; 
						
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
										if (!empty($emp_salary_info->basic_salary)) {
											$amt = (($emp_salary_info->basic_salary * $glob_deduct->did_amt)/100);
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
									$databasePaymentFrequency =$emp_salary_info->payment_frequency;       
   
									if($databasePaymentFrequency!=3)
									{
										
										   // if actual value==2
										   if($databasePaymentFrequency==2)
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
						?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong> <?php echo ucfirst($glob_deduct->did_name)?> : </strong></label>
                                <p class="form-control-static"><?php 
								if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($amt, 3);
								?></p>                         
                            </div>
                        <?php	
									$deductions += $amt;
								}
							}
						endif; 
						
						//extra allowance
						if (!empty($emp_salary_info->extra_deduction)): 
							$extra_deduct = explode('<-->',$emp_salary_info->extra_deduction);
							unset($extra_deduct[count($extra_deduct)-1]);
							foreach($extra_deduct as $ex_al)
							{
								$desc = explode("=",$ex_al);
						?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong> <?php echo ucfirst($desc[0])?> : </strong></label>
                                <p class="form-control-static"><?php 
								if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($desc[1], 3);
								?></p>                         
                            </div>
                        <?php 
                        
								//@sunny allownces acording to paymeny frequecy starts 
								$databasePaymentFrequency =$emp_salary_info->payment_frequency;       

								$new_deduction_value=$desc[1];

								if($databasePaymentFrequency!=3)
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
									   
								}
								//@sunny allownces acording to paymeny frequecy ends
                        
                        
								$deductions += $new_deduction_value;
							}
						endif; 
						?>
                    </div>
                </div>                    
            </div><!-- ****************** Deduction End  *******************-->

            <!-- ************** Total Salary Details Start  **************-->
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>Total Salary Details</strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>Gross Salary  : </strong></label>
                            <p class="form-control-static"><?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                $gross = $emp_salary_info->basic_salary + $allowances;
                                echo $currency . ' ' . number_format($gross, 3);
                                ?></p>
                        </div>
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>Total Deduction  : </strong></label>
                            <p class="form-control-static"><?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
								if($emp_salary_info->basic_salary >= 10000)
								{
									$pay_tax = $emp_salary_info->payroll_tax_deduction;
								}
								else
								{
									$pay_tax = '0.000';
								}
                                $deduction = $emp_salary_info->social_security + $pay_tax + $emp_salary_info->nhi_deduction + $emp_salary_info->spouse_nhi_deduction + $deductions;
                                echo $currency . ' ' . number_format($deduction, 3);
                                ?></p>
                        </div>                                                        
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>Net Salary  : </strong></label>
                            <p class="form-control-static"><?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                $net_salary = $gross - $deduction;
                                echo $currency . ' ' . number_format($net_salary, 3);
                                ?></p>
                        </div>                                                        
                    </div>
                </div>                    
            </div><!-- ****************** Total Salary Details End  *******************-->
        </div>  
    </div>  

    <script type="text/javascript">
        function printDiv(printableArea) {
            var printContents = document.getElementById(printableArea).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

