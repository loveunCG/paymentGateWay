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
                                    <td style="width: 30%;text-align: right"><strong>Salary Month :</strong></td>

                                    <td style="">&nbsp; <?php echo date('F, Y', strtotime($emp_salary_info->payment_for_month)) ?></td>
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
                                <?php if (!empty($emp_salary_info->house_rent_allowance)): ?>
                                    <tr>
                                        <td style="width: 30%;text-align: right"><strong>House Rent Allowance  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->house_rent_allowance, 2);
                                            ?></td>
                                    </tr>  
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info->medical_allowance)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Medical Allowance  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->medical_allowance, 2);
                                            ?></td>
                                    </tr>  
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info->special_allowance)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Special Allowance  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->special_allowance, 2);
                                            ?></td>
                                    </tr>   
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info->fuel_allowance)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Fuel Allowance  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->basic_salary, 2);
                                            ?></td>
                                    </tr>     
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info->phone_bill_allowance)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Phone Bill  Allowance  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->phone_bill_allowance, 2);
                                            ?></td>
                                    </tr>   
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info->other_allowance)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Other Allowance  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->other_allowance, 2);
                                            ?></td>
                                    </tr>  
                                <?php endif; ?>
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
                                <?php if (!empty($emp_salary_info->provident_fund)): ?>
                                    <tr>
                                        <td style="width: 30%;text-align: right"><strong>Provident Fund  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->provident_fund, 2);
                                            ?></td>
                                    </tr>  
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info->tax_deduction)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Tax Deduction  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->tax_deduction, 2);
                                            ?></td>
                                    </tr>  
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info->other_deduction)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Other Deduction  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            echo $currency . ' ' . number_format($emp_salary_info->other_deduction, 2);
                                            ?></td>
                                    </tr>   
                                <?php endif; ?>                               
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
                                            $gross = $emp_salary_info->basic_salary + $emp_salary_info->house_rent_allowance + $emp_salary_info->medical_allowance + $emp_salary_info->special_allowance + $emp_salary_info->fuel_allowance + $emp_salary_info->phone_bill_allowance + $emp_salary_info->other_allowance;
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
                                            $deduction = $emp_salary_info->tax_deduction + $emp_salary_info->provident_fund + $emp_salary_info->other_deduction;
                                            echo $currency . ' ' . number_format($deduction, 2);
                                            ?></td>
                                    </tr>  
                                <?php endif; ?>
                                <?php if (!empty($emp_salary_info)): ?>
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
                                <?php if (!empty($emp_salary_info->fine_deduction)): ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Fine Deduction  :</strong></td>

                                        <td style="width: 220px;">&nbsp; <?php
                                            if (!empty($genaral_info[0]->currency)) {
                                                $currency = $genaral_info[0]->currency;
                                            } else {
                                                $currency = '$';
                                            }
                                            $net_salary = $gross - $deduction;
                                            echo $currency . ' ' . number_format($emp_salary_info->fine_deduction, 2);
                                            ?></td>
                                    </tr>   
                                <?php endif; ?>                                   
                                <tr>
                                    <td style="text-align: right"><strong>Paid Amount :</strong></td>

                                    <td style="width: 220px;">&nbsp; <?php
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
                                        ?></td>
                                </tr>                                   

                            </table>
                        </td>
                    </tr>
                </table>                
            </div>
        </div><!-- ****************** Total Salary Details End  *******************-->    
    </body>
</html>