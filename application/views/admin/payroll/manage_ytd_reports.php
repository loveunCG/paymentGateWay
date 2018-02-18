<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">    
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default"><!-- *********     Employee Search Panel ***************** -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[37] ?></strong>
                    </div>
                </div>      
                <form id="form1" role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/payroll/manage_ytd_reports" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row"><br />
                            <div class="col-sm-12 form-groups-bordered">                                
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[20][0] ?> <span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <select name="designations_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">                            
                                            <option value="">Select Department.....</option>
                                            <?php if (!empty($all_department_info)): foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                                    <?php if (!empty($v_department_info)): ?>
                                                        <optgroup label="<?php echo $dept_name; ?>">
                                                            <?php foreach ($v_department_info as $designation) : ?>
                                                                <option value="<?php echo $designation->designations_id; ?>" 
                                                                <?php
                                                                if (!empty($designations_id)) {
                                                                    echo $designation->designations_id == $designations_id ? 'selected' : '';
                                                                }
                                                                ?>><?php echo $designation->designations ?></option>                            
                                                                    <?php endforeach; ?>
                                                        </optgroup>
                                                    <?php endif; ?>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div><?php //echo "<pre>".print_r($this->language->from_body(),1)."</pre>";?>
								<div class="form-group">
                                    <label class="col-sm-3 control-label">Select Year <span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text" required value="<?php
                                        if (!empty($date)) {
                                            echo $date;
                                        }
                                        ?>" class="form-control" id="date" name="date">
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>
								<div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[20][2] ?> </label>
                                    <div class="col-sm-5">
                                        <select name="payment_frequency" id="payment_frequency" class="form-control" >
                                            <option value="">Payment Frequency...</option>
                                            <option <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 1) ? 'selected' : '';
											?> value="1">Weekly</option>
                                            <option  <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 2) ? 'selected' : '';
											?> value="2">Bi-Monthly</option>
                                            <option  <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 3) ? 'selected' : '';
											?> value="3">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[14][1] ?> </label>
                                    <div class="col-sm-5">
                                        <select name="employee_id" id="employee" class="form-control" >
                                            <option value="">Select Employee...</option>  
                                            <?php if (!empty($employee_info)): ?>
                                                <?php foreach ($employee_info as $v_employee) : ?>
                                                    <option value="<?php echo $v_employee->employee_id; ?>" 
                                                    <?php
                                                    if (!empty($employee_id)) {
                                                        echo $v_employee->employee_id == $employee_id ? 'selected' : '';
                                                    }
                                                    ?>><?php echo $v_employee->first_name . ' ' . $v_employee->last_name ?></option>                            
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5">
                                        <button id="submit" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">GO</button>
                                    </div>
                                </div>
                            </div><br />                            
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- ******************** Employee Search Panel Ends ******************** -->
        <?php if (!empty($flag)): ?>
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
                                        <strong>YTD Reports</strong>                                                
                                        <div class="pull-right">                                                                                                              
                                        </div><!-- set pdf,Excel start action -->                                                
                                    </div>
                                </div>

                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>                                                    
                                            <th>Employee Name</th>
                                            <th>Payment Month</th>
                                            <th>Last Payment Date</th>
                                            <th>Gross Salary </th>
                                            <th>Total Deduction</th>
                                            <th>Net Salary</th>                                        
                                            <th>Fine Deduction</th>
                                            <th>Payment Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                                                                                
                                        <?php
                                        if (!empty($payment_history)): 
											foreach ($payment_history as $v_payment_history) :
                                                ?>
                                                <tr>
													<td><?php echo $v_payment_history->first_name." ". $v_payment_history->last_name?></td>
                                                    <td><?php echo date(' M, Y', strtotime($v_payment_history->payment_for_month)); ?></td>
                                                    <td><?php echo date('d-M-y', strtotime($v_payment_history->payment_date)); ?></td>
                                                    <td><?php
														$total_allow = 0;
														if (!empty($v_payment_history->global_allowance))
														{			
															$global_allow = explode('<-->',$v_payment_history->global_allowance);
															foreach($global_allow as $allow)
															{
																if(!empty($allow))
																{
																	$alw = explode("=",$allow);
																	$total_allow += $alw[1];
																}
															}
														}
														
														if (!empty($v_payment_history->extra_allowance))
														{			
															$extra_allow = explode('<-->',$v_payment_history->extra_allowance);
															foreach($extra_allow as $allow)
															{
																if(!empty($allow))
																{
																	$alw = explode("=",$allow);
																	$total_allow += $alw[1];
																}
															}
														}
														echo $gross = $v_payment_history->basic_salary + $total_allow 
													?></td>
                                                    <td><?php 
														$total_deduct = 0;
														
														if (!empty($v_payment_history->global_deduction))
														{			
															$global_deduct = explode('<-->',$v_payment_history->global_deduction);
															foreach($global_deduct as $allow)
															{
																if(!empty($allow))
																{
																	$alw = explode("=",$allow);
																	$total_deduct += $alw[1];
																}
															}
														}
														
														if (!empty($v_payment_history->extra_deduction))
														{			
															$extra_deduct = explode('<-->',$v_payment_history->extra_deduction);
															foreach($extra_deduct as $allow)
															{
																if(!empty($allow))
																{
																	$alw = explode("=",$allow);
																	$total_deduct += $alw[1];
																}
															}
														}
														
														echo $deduction = round($total_deduct + $v_payment_history->leave_deduction + $v_payment_history->social_security + $v_payment_history->nhi_deduction + $v_payment_history->spouse_nhi_deduction + $v_payment_history->payroll_tax_deduction,3); 
														?>
													</td>
                                                    <td><?php echo $net_salary = $gross - $deduction; ?></td>
                                                    <td><?php echo $v_payment_history->fine_deduction; ?></td>
                                                    <td><?php echo $net_salary - $v_payment_history->fine_deduction; ?></td>
                                                </tr>
                                                <?php
                                            endforeach;
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
		$('#date').datepicker({
			format : "yyyy-mm-dd",
			autoclose : true,
			endDate : new Date()
		});
		
	});
</script>   