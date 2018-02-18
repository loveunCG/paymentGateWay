<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">    
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default"><!-- *********     Employee Search Panel ***************** -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo 'National Heallth Insurance Reports' ?></strong>
                    </div>
                </div>      
                <form id="form1" role="form" enctype="multipart/form-data" action="<?php echo site_url("admin/reports/nhi_reports") ?>" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row"><br />
                            <div class="col-sm-12 form-groups-bordered">                                
                                
								<div class="form-group">
                                    <label class="col-sm-3 control-label">Select Month <span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text" required value="<?php
                                        if (!empty($month)) {
                                            echo $month;
                                        }
                                        ?>" class="form-control" id="date" name="txtmonth">
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
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- ******************** Employee Search Panel Ends ******************** -->
        <?php if (!empty($flag)): ?>
           <!--************ Payment History Start ***********-->
            <!---************** Employee Info show When Print ***********************--->
            <div id="ss_report">
                <div class="col-sm-12 print_width">
                    <div class="row">       
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">                                        
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>National Health Insurance</strong>                                                
                                        <div class="pull-right hidden-print">
											<span><a href="<?php echo site_url("admin/reports/nhi_pdf/".str_replace("-",'/',$month))?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="PDF"><span <i class="fa fa-file-pdf-o"></i></span></a></span>
											<!--<span><a href="http://client.tryonesolution.com/payroll/" class="btn btn-primary btn-xs" title="Print" data-toggle="tooltip" data-placement="top" onclick="ss_report('ss_report')"><span class="glyphicon glyphicon-print"></i></span></a></span>-->
										</div><!-- set pdf,Excel start action -->                                                
                                    </div>
                                </div>

                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>                                                    
                                            <th>Employee ID</th>
                                            <th width="12%">Employee Name</th>
                                            <th>Sex</th>
                                            <th width="45%">
												<div class="row">
													<div class="col-md-12 text-center ">
														Earning And Contribution
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-2">Week No 1</div>
													<div class="col-md-2">Week No 2</div>
													<div class="col-md-2">Week No 3</div>
													<div class="col-md-2">Week No 4</div>
													<div class="col-md-2">Week No 5</div>
												</div>
											</th>
                                            <th>Total Earning For Month</th>
                                            <th>Total Contribution</th>
                                            <th>No Of Wks Wrk</th>                                        
                                            <th>Pay type/ Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                                                                                
                                        <?php
                                        if (!empty($nhi_history)): 
											foreach ($nhi_history as $nhi_details) :
                                            ?>
												<tr>
													<td><?php echo $nhi_details['employment_id']?></td>
													<td><?php echo $nhi_details['employee_name']?></td>
													<td><?php echo $nhi_details['gender']?></td>
													<td>
														<div class="row">
															<div class="col-md-2">Earnings</div>
															<?php 
															$total_sal = 0;
															for($i = 0; $i < 5; $i++)
															{
																if(isset($nhi_details['basic_salary'][$i]))
																{
																	$total_sal += $nhi_details['basic_salary'][$i];
																	echo '<div class="col-md-2 text-center">'.number_format($nhi_details['basic_salary'][$i],2).'</div>';
																}
																else
																{
																	echo '<div class="col-md-2 text-center">0.00</div>';
																}
															}
															?>
														</div>
														<div class="row"> 
															<div class="col-md-2">Employee <?php
																if(!empty($nhi_details['nhi_deduct_detail']->employee_wage))
																{
																	$set = 1;
																	echo $nhi_details['nhi_deduct_detail']->employee_wage;
																}
																else
																{
																	echo $set = 0;
																}
																?>%</div>
															<?php 
															$total_employee = 0;
															for($i = 0; $i < 5; $i++)
															{
																if(isset($nhi_details['basic_salary'][$i]) && $set == 1)
																{
																	$emp_wage = ($nhi_details['basic_salary'][$i] * $nhi_details['nhi_deduct_detail']->employee_wage/100);
																	$total_employee += $emp_wage;
																	echo '<div class="col-md-2 text-center">'.number_format($emp_wage,2).'</div>';
																}
																else
																{
																	echo '<div class="col-md-2 text-center">0.00</div>';
																}
															}
															?>
														</div>
														<div class="row">
															<div class="col-md-2"> Employer
															<?php if(!empty($nhi_details['nhi_deduct_detail']->employer_wage))
																{
																	$set = 1;
																	echo $nhi_details['nhi_deduct_detail']->employer_wage;
																}
																else
																{
																	echo $set = 0;
																}
																?>%</div>
															<?php 
															$total_employer = 0;
															for($i = 0; $i < 5; $i++)
															{
																if(isset($nhi_details['basic_salary'][$i]) && $set == 1)
																{
																	$emp_wage = ($nhi_details['basic_salary'][$i] * $nhi_details['nhi_deduct_detail']->employer_wage/100);
																	$total_employer += $emp_wage;
																	echo '<div class="col-md-2 text-center">'.number_format($emp_wage,2).'</div>';
																}
																else
																{
																	echo '<div class="col-md-2 text-center">0.00</div>';
																}
															}
															?>
														</div>
														<div class="row">
															<div class="col-md-2"> Spouse
															<?php if(!empty($nhi_details['nhi_deduct_detail']->rate))
																{
																	$set = 1;
																	echo $nhi_details['nhi_deduct_detail']->rate;
																}
																else
																{
																	echo $set = 0;
																}
																?>%</div>
															<?php 
															$total_spouse = 0;
															if(!empty($nhi_details['is_spouse']) && $nhi_details['is_spouse'] == 1)
															{
																for($i = 0; $i < 5; $i++)
																{
																	if(isset($nhi_details['basic_salary'][$i]) && $set == 1)
																	{
																		$emp_wage = ($nhi_details['basic_salary'][$i] * $nhi_details['nhi_deduct_detail']->rate/100);
																		$total_spouse += $emp_wage;
																		echo '<div class="col-md-2 text-center">'.number_format($emp_wage,2).'</div>';
																	}
																	else
																	{
																		echo '<div class="col-md-2 text-center">0.00</div>';
																	}
																}
															}
															else
															{
																echo '<div class="col-md-2 text-center">0.00</div>';
															}
															?>
														</div>
													</td>
													<td><?php echo number_format($total_sal,2);?></td>
													<td><?php echo number_format($total_employer + $total_employee + $total_spouse,2);?></td>
													<td></td>
													<td><?php echo $nhi_details['payment_frequency'];?></td>
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
    function ss_report(ss_report) {
        var printContents = document.getElementById(ss_report).innerHTML;
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
			format : "yyyy-mm",
			autoclose : true,
			minViewMode: "months",
			endDate : new Date()
		});
		
	});
</script>
