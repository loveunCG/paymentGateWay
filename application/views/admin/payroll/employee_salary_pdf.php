<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
    </head>

    <body style="width: 100%;">
        <div style="width: 100%; border-bottom: 2px solid black;">
            <table style="width: 100%; vertical-align: middle;">
                <tr>
                    <?php
                    $genaral_info = $this->session->userdata('genaral_info');
                    if (!empty($genaral_info)) {
                        foreach ($genaral_info as $info) {
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
        <br/>
        <br/>
        <div style="padding: 5px 0; width: 100%;">
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
        <br/>
        <br/>
        <div style="width: 100%; margin-top: 55px;">

            <div >
                <div style="width: 100%; background: #E3E3E3;padding: 1px 0px 1px 10px; color: black; vertical-align: middle; ">
                    <p style="margin-left: 10px; font-size: 15px; font-weight: lighter;"><strong>Salary Details</strong></p>
                </div>
                <br />                
                <table style="width: 100%; /*border: 1px solid blue;*/ padding: 10px 0;">
                    <tr>
                        <td>
                            <table style="width: 100%; font-size: 13px;">
                                <tr>
                                    <td style="width: 30%;text-align: right"><strong>Employment Type :</strong></td>

                                    <td style="">&nbsp; <?php
                                        if ($emp_salary_info->employment_type == 1) {
                                            echo 'Provision';
                                        } else {
                                            echo 'Permanent';
                                        }
                                        ?></td>
                                </tr>                            
                                <tr>
                                    <td style="text-align: right"><strong>Basic Salary :</strong></td>

                                    <td style="width: 220px;">&nbsp; <?php
                                        if (!empty($genaral_info[0]->currency)) {
                                            $currency = $genaral_info[0]->currency;
                                        } else {
                                            $currency = '$';
                                        }
                                        echo $currency . ' ' . number_format($emp_salary_info->basic_salary, 2);
                                        ?></td>
                                </tr>                                                                                        
                            </table>
                        </td>
                    </tr>
                </table>                
            </div>
        </div><!-- ***************** Salary Details  Ends *********************-->

        <!-- ******************-- Allowance Panel Start **************************-->
        <div style="width: 100%; margin-top: 55px;">

            <div >
                <div style="width: 100%; background: #E3E3E3;padding: 1px 0px 1px 10px; color: black; vertical-align: middle; ">
                    <p style="margin-left: 10px; font-size: 15px; font-weight: lighter;"><strong>Allowances Details</strong></p>
                </div>
                <br />                
                <table style="width: 100%; /*border: 1px solid blue;*/ padding: 10px 0;">
                    <tr>
                        <td>
                            <table style="width: 100%; font-size: 13px;">
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
								?>
									<tr>
                                        <td style="text-align: right"><strong> <?php echo ucfirst($glob_allow->allow_name)?> : </strong></td>

                                        <td style="width: 220px;">&nbsp; <?php 
										if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($amt, 3);
										?></td>
                                    </tr> 
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
									<tr>
                                        <td style="text-align: right"><strong> <?php echo ucfirst($desc[0])?> : </strong></td>

                                        <td style="width: 220px;">&nbsp;<?php 
										if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($desc[1], 3);
										?></td>
                                    </tr> 
								<?php 
										$allowances += $desc[1];
									}
								endif;
								?>
                            </table>
                        </td>
                    </tr>
                </table>                
            </div>
        </div><!-- ********************Allowance End ******************-->

        <!-- ************** Deduction Panel Column  **************-->
        <div style="width: 100%; margin-top: 55px;">

            <div >
                <div style="width: 100%; background: #E3E3E3;padding: 1px 0px 1px 10px; color: black; vertical-align: middle; ">
                    <p style="margin-left: 10px; font-size: 15px; font-weight: lighter;"><strong>Deductions Details</strong></p>
                </div>
                <br />                
                <table style="width: 100%; /*border: 1px solid blue;*/ padding: 10px 0;">
                    <tr>
                        <td>
                            <table style="width: 100%; font-size: 13px;">
								<?php if (!empty($emp_salary_info->social_security)): ?>
									<tr>
                                        <td style="text-align: right"><strong> Social Security  : </strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($emp_salary_info->social_security, 3);
											?></td>
                                    </tr>
								<?php endif; ?>
								<?php if (!empty($emp_salary_info->nhi_deduction)): ?>
									<tr>
                                        <td style="text-align: right"><strong> National Health Insurance  : </strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($emp_salary_info->nhi_deduction, 3);
											?></td>
                                    </tr>
								<?php endif; ?>
								<?php if (!empty($emp_salary_info->spouse_nhi_deduction)): ?>
									<tr>
                                        <td style="text-align: right"><strong> Spouse NHI  : </strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($emp_salary_info->spouse_nhi_deduction, 3);
											?></td>
                                    </tr>
								<?php endif; ?>
								<?php if (!empty($emp_salary_info->payroll_tax_deduction) && $emp_salary_info->basic_salary >=10000): ?>
									<tr>
                                        <td style="text-align: right"><strong> Payroll Tax  : </strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($emp_salary_info->payroll_tax_deduction, 3);
											?>
										</td>
                                    </tr>
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
								?>
									<tr>
                                        <td style="text-align: right"><strong> <?php echo ucfirst($glob_deduct->did_name)?> : </strong></td>

                                        <td style="width: 220px;">&nbsp; <?php 
										if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($amt, 3);
										?></td>
                                    </tr>
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
									<tr>
                                        <td style="text-align: right"><strong> <?php echo ucfirst($desc[0])?> : </strong></td>

                                        <td style="width: 220px;">&nbsp; <?php 
										if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}
											echo $currency . ' ' . number_format($desc[1], 3);
										?></td>
                                    </tr>
								<?php 
										$deductions += $desc[1];
									}
								endif; 
								?>                            
                            </table>
                        </td>
                    </tr>
                </table>                
            </div>
        </div><!-- ****************** Deduction End  *******************-->

        <!-- ************** Total Salary Details Start  **************-->

        <div style="width: 100%; margin-top: 55px;">

            <div >
                <div style="width: 100%; background: #E3E3E3;padding: 1px 0px 1px 10px; color: black; vertical-align: middle; ">
                    <p style="margin-left: 10px; font-size: 15px; font-weight: lighter;"><strong>Total Salary Details</strong></p>
                </div>
                <br />                
                <table style="width: 100%; /*border: 1px solid blue;*/ padding: 10px 0;">
                    <tr>
                        <td>
                            <table style="width: 100%; font-size: 13px;">
                                <?php if (!empty($emp_salary_info)): ?>
                                    <tr>
                                        <td style="width: 30%;text-align: right"><strong>Gross Salary   :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            $gross = $emp_salary_info->basic_salary + $allowances;
                                            echo $currency . ' ' . number_format($gross, 2);
                                            ?></td>
                                    </tr>  
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Total Deduction  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
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
                                            echo $currency . ' ' . number_format($deduction, 2);
                                            ?></td>
                                    </tr>  
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info->other_deduction)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Net Salary  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
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
                            </table>
                        </td>
                    </tr>
                </table>                
            </div>
        </div><!-- ****************** Total Salary Details End  *******************-->    
    </body>
</html>