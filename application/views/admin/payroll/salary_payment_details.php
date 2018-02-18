<div id="printableArea"> 
    <div class="row">
        <div class="col-sm-12" data-spy="scroll" data-offset="0">                            
            <div class="panel panel-default">            
                <!-- main content -->
                <div class="panel-heading hidden-print">
                    <div class="row">
                        <div  class="col-lg-12 panel-title">
                            <h3 class="col-lg-4 col-md-4 col-sm-4">Payment Salary Detail</h3>
                            <div class="pull-right">                                                               
                                <span><?php echo btn_pdf('admin/payroll/payment_salary_pdf/' . $salary_payment_info->salary_payment_id); ?></span>
                                <button class="margin btn-print" type="button" data-toggle="tooltip" title="Print" onclick="printDiv('printableArea')"><?php echo btn_print(); ?></button>                                                              
                            </div>
                        </div>
                    </div>
                </div>
                <br />            
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
                <br/>
                <div class="col-lg-12 well">
                    <div class="row">                            
                        <div class="col-lg-2 col-sm-2">
                            <div class="fileinput-new thumbnail" style="width: 144px; height: 158px; margin-top: 14px; margin-left: 16px; background-color: #EBEBEB;">
                                <?php if ($salary_payment_info->photo): ?>
                                    <img src="<?php echo base_url() . $salary_payment_info->photo; ?>" style="width: 142px; height: 148px; border-radius: 3px;" >  
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
                                    <h3><?php echo "$salary_payment_info->first_name " . "$salary_payment_info->last_name"; ?></h3>
                                    <hr />
                                    <table class="table-hover">
                                        <tr>
                                            <td><strong>Employee ID</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$salary_payment_info->employment_id"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Department</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$salary_payment_info->department_name"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Designation</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$salary_payment_info->designations"; ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <td><strong>Joining Date</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo date('d M Y', strtotime($salary_payment_info->joining_date)); ?></td>
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
                            <label for="field-1" class="col-sm-3 control-label"><strong>Salary Month :</strong> </label>                    
                            <p class="form-control-static"><?php echo date('F,Y', strtotime($salary_payment_info->payment_for_month)); ?></p>                    
                        </div>
                        <div class="">
                            <label for="field-1" class="col-sm-3 control-label"><strong>Basic Salary :</strong> </label>                    
                            <p class="form-control-static"><?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                echo $currency . ' ' . number_format($salary_payment_info->basic_salary, 2);
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
                    <?php /*<div class="panel-body">
                        <?php if (!empty($salary_payment_info->house_rent_allowance)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>House Rent Allowance  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->house_rent_allowance, 2);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->medical_allowance)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Medical Allowance  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->medical_allowance, 2);
                                    ?></p>                        
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->special_allowance)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Special Allowance  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->special_allowance, 2);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->fuel_allowance)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Fuel Allowance  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->fuel_allowance, 2);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->phone_bill_allowance)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Phone Bill Allowance  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->phone_bill_allowance, 2);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->other_allowance)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Other Allowance  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->other_allowance, 2);
                                    ?></p>                        
                            </div>
                        <?php endif; ?>
					 </div> */?>
                         <?php //print_r($global_allow_deduct); die; ?>
                        <!-----------@sunny starts for allownces ------>
                        
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
										if (!empty($salary_payment_info->basic_salary)) {
											$amt = (($salary_payment_info->basic_salary * $glob_allow->allow_amt)/100);
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
											$databasePaymentFrequency =$salary_payment_info->payment_frequency;       
		   
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
						if (!empty($salary_payment_info->extra_allowance)): 
							$extra_allow = explode('<-->',$salary_payment_info->extra_allowance);
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
									$databasePaymentFrequency =$salary_payment_info->payment_frequency;       
   
									$new_allownces_value=$desc[1];
   
									if($databasePaymentFrequency!=3)
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
									//@sunny allownces acording to paymeny frequecy ends
                        
								$allowances += $new_allownces_value;
							}
						endif; 
						?>
                    </div>
                        
                        <!------- @sunny ends for allownces -------->
                        
                        
                   
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
                   <?php /* <div class="panel-body">
                        <?php if (!empty($salary_payment_info->provident_fund)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Provident Fund  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->provident_fund, 2);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->tax_deduction)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Tax Deduction  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->tax_deduction, 2);
                                    ?></p>                        
                            </div>    
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->other_deduction)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Other Deduction  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->other_deduction, 2);
                                    ?></p>                       
                            </div>
                        <?php endif; ?>
                     <?php if (!empty($salary_payment_info->leave_deduction)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Leave Deduction  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->leave_deduction, 2);
                                    ?></p>                       
                            </div>
                        <?php endif; ?>
                    </div>*/?>
                     <div class="panel-body">
                        <?php if (!empty($salary_payment_info->social_security)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Social Security  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->social_security, 3);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->nhi_deduction)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>National Health Insurance  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->nhi_deduction, 3);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->spouse_nhi_deduction)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Spouse NHI  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->spouse_nhi_deduction, 3);
                                    ?></p>                         
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($salary_payment_info->payroll_tax_deduction) && $salary_payment_info->basic_salary >=10000): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Payroll Tax  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->payroll_tax_deduction, 3);
                                    ?></p>                         
                            </div>
                        <?php endif; 
						
						$deductions = 0;
						//global Deductions
						
						//print_r($global_allow_deduct); die;
						if (!empty($global_allow_deduct)): 
							foreach($global_allow_deduct as $glob_deduct)
							{
								//print_r($glob_deduct);exit;
								if(!empty($glob_deduct->did_name))
								{	
									if($glob_deduct->did_amt_type == "per")
									{
										if (!empty($salary_payment_info->basic_salary)) {
											$amt = (($salary_payment_info->basic_salary * $glob_deduct->did_amt)/100);
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
									$databasePaymentFrequency =$salary_payment_info->payment_frequency;       
   
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
						
						//extra deduction
						if (!empty($salary_payment_info->extra_deduction)): 
							$extra_deduct = explode('<-->',$salary_payment_info->extra_deduction);
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
                        
								//@sunny Deduction acording to paymeny frequecy starts 
								$databasePaymentFrequency =$salary_payment_info->payment_frequency;       

								$new_deduction_value=$desc[1];

								if($databasePaymentFrequency!=3)
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
								//@sunny Deduction acording to paymeny frequecy ends
                        
                        
								$deductions += $new_deduction_value;
							}
						endif; 
						?>
						
						
						<?php
						
						//extra deduction
						if (!empty($salary_payment_info->leave_deduction)): 
							
						?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong> Leave Deduction : </strong></label>
                                <p class="form-control-static"><?php 
								if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->leave_deduction, 3);
								?></p>                         
                            </div>
                        <?php                         
                        
								$deductions += $salary_payment_info->leave_deduction;
							
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
                            <p class="form-control-static"><?php /*
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                $gross = $salary_payment_info->basic_salary + $salary_payment_info->house_rent_allowance + $salary_payment_info->medical_allowance + $salary_payment_info->special_allowance + $salary_payment_info->fuel_allowance + $salary_payment_info->phone_bill_allowance + $salary_payment_info->other_allowance;
                                echo $currency . ' ' . number_format($gross, 2);*/
                                ?>
                                <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                $gross = $salary_payment_info->basic_salary + $allowances;
                                echo $currency . ' ' . number_format($gross, 3);
                                ?>
                                
                                </p>
                        </div>
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>Total Deduction  : </strong></label>
                            <p class="form-control-static"><?php /*
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                $deduction = $salary_payment_info->tax_deduction + $salary_payment_info->provident_fund + $salary_payment_info->other_deduction;
                                echo $currency . ' ' . number_format($deduction, 2); */
                                ?>
                               
                                <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
								if($salary_payment_info->basic_salary >= 10000)
								{
									$pay_tax = $salary_payment_info->payroll_tax_deduction;
								}
								else
								{
									$pay_tax = '0.000';
								}
                                $deduction = $salary_payment_info->social_security + $pay_tax + $salary_payment_info->nhi_deduction + $salary_payment_info->spouse_nhi_deduction + $deductions;
                                echo $currency . ' ' . number_format($deduction, 3);
                                ?>
                                
                                </p>
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
                                echo $currency . ' ' . number_format($net_salary, 2);
                                ?></p>
                        </div>                                                        
                        <?php if (!empty($salary_payment_info->fine_deduction)): ?>
                            <div class="">
                                <label class="col-sm-6 control-label" ><strong>Fine Deduction  : </strong></label>
                                <p class="form-control-static"><?php
                                    if (!empty($genaral_info[0]->currency)) {
                                        $currency = $genaral_info[0]->currency;
                                    } else {
                                        $currency = '$';
                                    }
                                    echo $currency . ' ' . number_format($salary_payment_info->fine_deduction, 2);
                                    ?></p>
                            </div>
                        <?php endif; ?>                        
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>Paid Amount  : </strong></label>
                            <p class="form-control-static"><?php
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
                                ?></p>
                        </div>                        
                    </div>
                </div>                    
            </div><!-- ****************** Total Salary Details End  *******************-->
            
            
            
            
            
            
             <!-- ************** Total Working Salary Details Start  **************-->
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>Total Working Salary Details</strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>Gross Salary  : </strong></label>
                            <p class="form-control-static"><?php
													$no_of_work_day=$salary_payment_info->no_of_work_day;
													$total_work_day=$salary_payment_info->total_work_day;						
													$basic_salary=$paid_amount+$salary_payment_info->leave_deduction;
													?>
                                <?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                
                                echo $currency . ' ' . number_format($basic_salary, 3);
                                ?>
                                
                                </p>
                        </div>
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>No Of Work Day  : </strong></label>
                            <p class="form-control-static"><?php echo $no_of_work_day;?>                         
                               
                                
                                </p>
                        </div>                                                        
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>Total Work Day  : </strong></label>
                            <p class="form-control-static"><?php echo $total_work_day;?>                         
                               
                                
                                </p>
                        </div>                                                              
                        <div class="">
                            <label class="col-sm-6 control-label" ><strong>Paid Working Amount  : </strong></label>
                            <p class="form-control-static">
							<?php
                                /*if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                echo $basic_salary." * ".$no_of_work_day." / ".$total_work_day." =";
								 $working_salary=$basic_salary * ($no_of_work_day/$total_work_day);
                                echo "<strong>".$currency . ' ' . number_format($working_salary, 2)."</strong>";*/
                                
                                
								$total_working_salary=(isset($salary_payment_info->total_working_salary)) ? $salary_payment_info->total_working_salary : 0;
								$total_overtime_salary=(isset($salary_payment_info->total_overtime_salary)) ? $salary_payment_info->total_overtime_salary : 0;
								$allowance=$allowances;
								
								echo ($salary_payment_info->salary_type == 1) ? "[".$salary_payment_info->total_working_salary." + ".$salary_payment_info->total_overtime_salary ." + (".$allowance." * ".$no_of_work_day." / ".$total_work_day." ) - (".$deduction." * ".$no_of_work_day." / ".$total_work_day." )] =" : $basic_salary." * ".$no_of_work_day." / ".$total_work_day." =";
								
								$working_salary=0;
								if(!empty($no_of_work_day) && !empty($total_work_day)){
								 $working_salary=($salary_payment_info->salary_type == 1) ? $salary_payment_info->total_working_salary + $salary_payment_info->total_overtime_salary + ($allowance * $no_of_work_day / $total_work_day ) - ($deduction * $no_of_work_day / $total_work_day )  : $basic_salary * ($no_of_work_day / $total_work_day);
								}
								//echo "<".$salary_payment_info->total_working_salary.">total_overtime_salary="."<".$salary_payment_info->total_overtime_salary.">";
								//echo $working_salary;
								$formula=($salary_payment_info->salary_type == 1) ? '( total_working_salary + total_overtime_salary ) + (Allowance * No of work_day / Total work day ) - (Deduction * No of work_day / Total work day ) ' : '( Basic salary * No of work_day ) / (Total work day)';
																					  
								echo '<a href="#"  data-toggle="tooltip" title="'.$formula.'"  class="more" >' . $currency . ' ' . number_format($working_salary, 2) . '</a>';
							?></p>
                        </div>                        
                    </div>
                </div>                    
            </div><!-- ****************** Total Working Salary Details End  *******************-->
            
            
            
            
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

