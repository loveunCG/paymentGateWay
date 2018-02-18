<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">    
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default"><!-- *********     Employee Search Panel ***************** -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[19] ?></strong>
                    </div>
                </div>      
                <form id="form" role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/payroll/make_payment" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row"><br />
                            <div class="col-sm-12 form-groups-bordered">                                
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[20][0] ?> <span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <select name="designations_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">                            
                                            <option value="">Select Designations.....</option>
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
                                </div><?php //echo "<pre>".print_r($this->language->from_body(),1)."</pre>";?>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[20][2] ?> </label>
                                    <div class="col-sm-5">
                                        <select name="payment_frequency" id="payment_frequency" class="form-control" >
                                            <option value="">Payment Frequency...</option>
                                            <option value="1">Weekly</option>
                                            <option value="2">Bi-Monthly</option>
                                            <option value="3">Monthly</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][2] ?> </label>
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
                                    <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][3] ?> </label>
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
            <form role="form"  enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/payroll/get_payment/<?php
            if (!empty($check_salary_payment->salary_payment_id)) {
                echo $check_salary_payment->salary_payment_id;
            }
            ?>" method="post" class="form-horizontal form-groups-bordered">
                <div class="col-sm-3" data-spy="scroll" data-offset="0">        
                    <div class="row">
						<div class="panel panel-primary fees_payment">
                            <!-- Default panel contents -->
                            <div class="panel-heading" >
                                <div class="panel-title">
                                    <strong>Payment For <?php echo date('d, F', strtotime($start_payment_date)) ?> To <?php echo date('d, F,Y', strtotime($end_payment_date)) ?></strong>
                                </div>
                            </div>      
							
							<?php  
							/*------------------- calculate working days and hours-------------------*/
							$year = date('Y',strtotime($this->input->post('start_payment_date')));
							$month = date('m',strtotime($this->input->post('start_payment_date'))); 
							//$total_work_day = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
							
							$start_days = new DateTime($this->input->post('start_payment_date'));
							$end_days = new DateTime($this->input->post('end_payment_date'));
									
							$total_work_day = $end_days->diff($start_days)->days + 1;
							
							$size = 0;
							
							$no_of_work_day = $size;
							$no_of_work_hours = $size;
							//echo "<pre>".print_r($check_salary_payment,1)."</pre>";
							foreach($employee_absent_info as $attend){

								$min = 0;
								$hrs = 0;
								if(!empty($attend->time_in) && !empty($attend->time_in))
								{
									$start_time = new DateTime("$attend->date $attend->time_in");
									$end_time = new DateTime("$attend->date $attend->time_out");
									$diff = $end_time->diff($start_time);
									$min = ($diff->h * 60);
									$min += $diff->i;
								}
								
								if($attend->attendance_status == 1)
								{
									if($emp_salary_info->salary_type == 1)
									{
										$no_of_work_hours += $min;
									}
									else
									{
										$a = ($attend);
										$size++;
										$no_of_work_day = $size;
									}
								}
								else if($attend->attendance_status == 0)
								{
									$a = ($attend);
									$size--;
									$no_of_work_day = $size;
								}
								else if($attend->attendance_status == 'H')
								{
									if($emp_salary_info->salary_type == 1)
									{
										$no_of_work_hours += $min;
									}
									else
									{
										$size++;
										$no_of_work_day = $size;
									}
								}
							}
							
							$hrs = floor($no_of_work_hours/60);
							$min = ($no_of_work_hours % 60); 
							?>
                            <div class="panel-body">
								<?php
								if($emp_salary_info->salary_type == 1)
								{
									$hrs = (strlen($hrs) < 2) ? "0$hrs" : $hrs;
									$min = (strlen($min) < 2) ? "0$min" : $min;
									//basic
									$basic = ($no_of_work_hours * ($emp_salary_info->basic_salary/60));
									//deduciton
									$pay_tax = 0;
									$ss = ($no_of_work_hours * ($emp_salary_info->social_security/60));
									$nhi = ($no_of_work_hours * ($emp_salary_info->nhi_deduction/60));
									$spouse_nhi = ($no_of_work_hours * ($emp_salary_info->spouse_nhi_deduction/60));
									$leave = 0;
									if($basic >= 10000)
									{
										$pay_tax = ($no_of_work_hours * ($emp_salary_info->payroll_tax_deduction/60));
									}
								?>
								<div class="">
                                    <label class="control-label" >Total Working Hours </label>
									<div class="input-group">
                                    <input type="text" name="total_working_hours" readonly  value="<?php echo $hrs.":".$min;?>"  class="salary form-control">
									<span class="input-group-addon">*</span>
									<input type="text" name="rate_per_hours" readonly  value="<?php echo $emp_salary_info->basic_salary;?>"  class="salary form-control">
									</div>
                                </div>
								<?php
								}
								else
								{
									$basic = $emp_salary_info->basic_salary;
									
									//deduciton
									$ss = $emp_salary_info->social_security;
									$nhi = $emp_salary_info->nhi_deduction;
									$spouse_nhi = $emp_salary_info->spouse_nhi_deduction;
									$leave = $basic * ($no_of_work_day/$total_work_day);
									$pay_tax = 0;
									
									if($basic >= 10000)
									{
										$pay_tax = $emp_salary_info->payroll_tax_deduction;
									}
								}
								$fine = 0;
								if(!empty($check_salary_payment))
								{
									$basic = $check_salary_payment->basic_salary;
									
									$nhi = $check_salary_payment->nhi_deduction;
									$ss = $check_salary_payment->social_security;
									$spouse_nhi = $check_salary_payment->spouse_nhi_deduction;
									$pay_tax = $check_salary_payment->payroll_tax_deduction;
									$fine = $check_salary_payment->fine_deduction;
									$leave = $check_salary_payment->leave_deduction;
									
									$start_payment_date = $check_salary_payment->start_payment_date;
									$end_payment_date = $check_salary_payment->end_payment_date;
									
								}
								
								$user_define_allow = 0;
								if(!empty($emp_salary_info->extra_allowance))
								{
									$extra_allow = explode('<-->',$emp_salary_info->extra_allowance);
									
									unset($extra_allow[count($extra_allow)-1]);
									
									foreach($extra_allow as $ex_al)
									{
										$desc = explode("=",$ex_al);
										$user_define_allow += $desc[1];
									}
								}
								
								$user_define_deduct = 0;
								if(!empty($emp_salary_info->extra_deduction))
								{
									$extra_deduct = explode('<-->',$emp_salary_info->extra_deduction);
									
									unset($extra_deduct[count($extra_deduct)-1]);
									
									foreach($extra_deduct as $ex_al)
									{
										$desc = explode("=",$ex_al);
										$user_define_deduct += $desc[1];
									}
								}
								?>
								
                                <div class="">
                                    <label class="control-label" >Gross Salary </label>
                                    <input type="text" name="house_rent_allowance" disabled value="<?php
									//if($emp_salary_info->)
                                    echo $gross = $basic + $emp_salary_info->house_rent_allowance + $emp_salary_info->medical_allowance + $emp_salary_info->special_allowance + $emp_salary_info->fuel_allowance + $emp_salary_info->phone_bill_allowance + $emp_salary_info->other_allowance + $user_define_allow;
                                    ?>"  class="salary form-control">
                                </div>

                               <!---------------HIDDEN FEILDS------------------>
								<div class="">
                                    <input type="hidden" name="basic_salary" id="basic_salary" readonly value="<?php echo $basic?>"  class="salary form-control">
                                    <input type="hidden" name="leave_deduction" id="leave_deduction" readonly value="<?php echo $leave; ?>"  class="salary form-control">
                                    <input type="hidden" name="nhi_deduction" id="nhi_deduction" readonly value="<?php echo $nhi; ?>"  class="salary form-control">
                                    <input type="hidden" name="social_security" id="social_security" readonly value="<?php echo $ss; ?>"  class="salary form-control">
                                    <input type="hidden" name="payroll_tax_deduction" id="payroll_tax_deduction" readonly value="<?php echo $pay_tax; ?>"  class="salary form-control">
                                </div>
								 <!---------------HIDDEN FEILDS------------------>
                            
                                <div class="">
                                    <label class="control-label" >Total Deduction </label>
                                    <input type="text" name="other_allowance" disabled  value="<?php
                                    echo $deduction = round($emp_salary_info->tax_deduction + $emp_salary_info->other_deduction + $leave + $ss + $pay_tax + $nhi + $spouse_nhi + $user_define_deduct,3);
                                    ?>"  class="salary form-control">
                                </div>
                                <div class="">
                                    <label class="control-label" >Net Salary </label>
                                    <input type="text" id="net_salary" name="other_allowance" disabled  value="<?php
                                    echo $net_salary = $gross - $deduction - $fine;
                                    ?>"  class="salary form-control">
                                </div>
                                <?php if (!empty($award_info)): foreach ($award_info as $v_award_info) : ?>
                                        <?php if (!empty($v_award_info->award_amount)): ?>
                                            <div class="">
                                                <label class="control-label" > Award <small>( <?php echo $v_award_info->award_name; ?> )</small> </label>
                                                <input type="text" name="other_allowance" disabled  value="<?php echo $v_award_info->award_amount; ?>"  class="salary form-control">
                                                <input type="hidden" name="award[]" value="<?php echo $v_award_info->award_amount; ?>"  class="salary form-control">
                                            </div>
                                        <?php endif; ?>                                
                                    <?php endforeach; ?>
                                <?php endif; ?>                                                               
                                <div class="">
                                    <label class="control-label" >Fine Deduction </label>
                                    <input type="text" name="fine_deduction" id="fine_deduction" value="<?php
                                    if (!empty($check_salary_payment->fine_deduction)) {
                                        echo $check_salary_payment->fine_deduction;
                                    }
                                    ?>"  class="salary form-control">
                                </div>
                                <div class="">
                                    <label class="control-label" ><strong>Payment Amount </strong></label>
                                    <input type="text" name="payment_amount" id="payment_amount" value="<?php echo $net_salary; ?>"  class="salary form-control">
                                </div>
                                <!-- Hidden Employee Id -->
                                <input type="hidden" id="employee_id" name="employee_id" value="<?php echo $emp_salary_info->employee_id; ?>"  class="salary form-control">                               
                                
								<input type="hidden"  name="start_payment_date" value="<?php if(!empty($start_payment_date)){ 
									echo $start_payment_date; 
								}?>"  class="salary form-control">
								
								<input type="hidden"  name="end_payment_date" value="<?php if(!empty($end_payment_date)){ 
								echo $end_payment_date; }?>"  class="salary form-control">   
								
                                <div class=""><!-- Payment Type -->
                                    <label class="control-label" >Payment Type <span class="required"> *</span></label>                                               
                                    <select name="payment_type" class="form-control col-sm-5" onchange="get_payment_value(this.value)" >
                                        <option value="" >Select Payment Type...</option>                                            
                                        <option value="Cash Payment" <?php
                                        if (!empty($check_salary_payment->payment_type)) {
                                            echo $check_salary_payment->payment_type == 'Cash Payment' ? 'selected' : '';
                                        }
                                        ?>>Cash Payment</option>                                            
                                        <option value="Cheque Payment" <?php
                                        if (!empty($check_salary_payment->payment_type)) {
                                            echo $check_salary_payment->payment_type == 'Cheque Payment' ? 'selected' : '';
                                        }
                                        ?>>Cheque Payment</option>                                            
                                        <option value="Bank Account" <?php
                                        if (!empty($check_salary_payment->payment_type)) {
                                            echo $check_salary_payment->payment_type == 'Bank Account' ? 'selected' : '';
                                        }
                                        ?>>Bank Account</option>                   
                                    </select>                                                 
                                </div><!-- Payment Type -->                                  
                                <div class="">
                                    <label class="control-label" >Comments </label>
                                    <input type="text" name="comments" value="<?php
                                    if (!empty($check_salary_payment->comments)) {
                                        echo $check_salary_payment->comments;
                                    }
                                    ?>"  class="salary form-control">
                                </div>                                
                                <div class="form-group margin"> 
                                    <div class="col-sm-5">
                                        <button type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                            </div>                                
                        </div>                                
                    </div>                                
                </div><!--************ Fees payment End ***********-->
            </form>
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

                <div class="col-sm-9 print_width">
                    <div class="row">       
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">                                        
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Payment History</strong>                                                
                                        <div class="pull-right"><!-- set pdf,Excel start action -->
                                            <label class="payment_print hidden-print control-label col-sm-3 pull-left hidden-xs">
                                                <?php echo btn_make_pdf('admin/payroll/payment_history_pdf/' . $emp_salary_info->employee_id); ?>                                                    
                                            </label>                                                                                                       
                                            <label class="hidden-print control-label pull-left hidden-xs">
                                                <button  class="btn-print" data-toggle="tooltip" data-placement="top" title="Print" type="button" onclick="payment_history('payment_history')"><?php echo btn_print(); ?></button>
                                            </label>                                                                                                       
                                        </div><!-- set pdf,Excel start action -->                                                
                                    </div>
                                </div>

                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>                                                    
                                            <th>Payment Month</th>
                                            <th>Payment Date</th>
                                            <th>Gross Salary </th>
                                            <th>Total Deduction</th>
                                            <th>Net Salary</th>                                        
                                            <th>Fine Deduction</th>
                                            <th>Payment Amount</th>
                                            <th class="hidden-print">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                                                                                
                                        <?php
                                        if (!empty($payment_history)): 
											foreach ($payment_history as $v_payment_history) :
                                                ?>
                                                <tr>                                                            
                                                    <td><?php echo date('d, M', strtotime($v_payment_history->start_payment_date))." To ". date('d, M, Y', strtotime($v_payment_history->end_payment_date)); ?></td>
                                                    <td><?php echo date('d-M-y', strtotime($v_payment_history->payment_date)); ?></td>
                                                    <td><?php echo $gross = $v_payment_history->basic_salary + $v_payment_history->house_rent_allowance + $v_payment_history->medical_allowance + $v_payment_history->special_allowance + $v_payment_history->fuel_allowance + $v_payment_history->phone_bill_allowance + $v_payment_history->other_allowance; ?></td>
                                                    <td><?php echo $deduction = round($v_payment_history->tax_deduction + $v_payment_history->other_deduction + $v_payment_history->leave_deduction + $v_payment_history->social_security + $v_payment_history->nhi_deduction + $v_payment_history->payroll_tax_deduction,3); ?></td>
                                                    <td><?php echo $net_salary = $gross - $deduction; ?></td>
                                                    <td><?php echo $v_payment_history->fine_deduction; ?></td>
                                                    <td><?php echo $net_salary - $v_payment_history->fine_deduction; ?></td>
                                                    <td class="hidden-print"><?php echo btn_view('admin/payroll/salary_payment_details/' . $v_payment_history->salary_payment_id) ?></td>
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