<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">    
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default"><!-- *********  Employee Search Panel ***************** -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo 'Paytax Reports' ?></strong>
                    </div>
                </div>      
                <form id="form1" role="form" enctype="multipart/form-data" action="<?php echo site_url("admin/reports/paytax_reports") ?>" method="post" class="form-horizontal form-groups-bordered">
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
                                        <strong>Payroll Tax Reports</strong>                                                
                                        <div class="pull-right hidden-print">
											<span><a href="<?php echo site_url("admin/reports/paytax_pdf/".str_replace("-",'/',$month))?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="PDF"><span <i class="fa fa-file-pdf-o"></i></span></a></span>
											<!--<span><a href="http://client.tryonesolution.com/payroll/" class="btn btn-primary btn-xs" title="Print" data-toggle="tooltip" data-placement="top" onclick="ss_report('ss_report')"><span class="glyphicon glyphicon-print"></i></span></a></span>-->
										</div><!-- set pdf,Excel start action -->                                                
                                    </div>
                                </div>
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th rowspan='2' width="12%">Employee Name</th>
                                            <th rowspan='2'>Sex</th>
                                            <th rowspan='2'>Salary/Wages</th>
                                            <th width="45%" colspan="<?php echo count($global_allowance)?>">
												&nbsp;
											</th>
                                            <th rowspan='2'>Gross Benifits</th>
                                            <th rowspan='2'>Gross Renumeration Paid this Month</th>
                                            <th rowspan='2'>Employee Tax Payable this Month</th>                                        
                                            <th rowspan='2'>Employer Tax Payable this Month</th>                                      
                                            <th rowspan='2'>Total Tax Payable this Month</th>
                                        </tr>
										<tr>
										<?php 
										if(!empty($global_allowance))
										{
											foreach($global_allowance as $glob)
											{
												echo '<th>'.$glob->allow_name.'</th>';
											}
										}
										else
										{
											echo '<th> Other Benefits </th>';
										}
										?>
										</tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($paytax_history)): 
											foreach ($paytax_history as $pay_tax) :
												$rowspan_cnt = 1;
												$gross_benifit = 0;
												//$rowspan_cnt = count($pay_tax['global_allowance']);
										?>
											<tr>
												<td rowspan="<?php echo  $rowspan_cnt?> "><?php echo $pay_tax['employee_name'] ?></td>
												<td rowspan="<?php echo  $rowspan_cnt?>" ><?php echo substr($pay_tax['gender'],0,1)?></td>
												<td rowspan="<?php echo  $rowspan_cnt?>">$<?php echo number_format($pay_tax['tot_salary'],2) ?></td>
												<?php
												foreach($pay_tax['global_allowance'] as $pay_global_allow)
												{	foreach($pay_global_allow as $glob_allow)
													{
														$glob_allow_arr = explode('=',$glob_allow);
														echo "<td>$".number_format($glob_allow_arr[1],2)."</td>\n";
														$gross_benifit += $glob_allow_arr[1];
													}
													break;
												}
												?>
												<td rowspan="<?php echo  $rowspan_cnt?>">$<?php echo number_format($gross_benifit,2) ?></td>
												<td rowspan="<?php echo  $rowspan_cnt?>">$<?php echo number_format($gross_renum = ($pay_tax['tot_salary'] + $gross_benifit),2)?></td>
												<td rowspan="<?php echo  $rowspan_cnt?>">$<?php echo  number_format($gross_renum * ($pay_tax['pay_tax_detail']->employee_wage/100),2)?></td>
												<td rowspan="<?php echo  $rowspan_cnt?>">$<?php echo number_format($gross_renum * ($pay_tax['pay_tax_detail']->employer_wage/100),2) ?></td>
												<td rowspan="<?php echo  $rowspan_cnt?>">$<?php echo number_format($gross_renum * ($pay_tax['pay_tax_detail']->total_wages/100),2) ?></td>
											</tr>
											<?php
												/*$fst = 0;	
												foreach($pay_tax['global_allowance'] as $pay_global_allow)
												{
													if($fst > 0)
													{
													echo "<tr>";
													foreach($pay_global_allow as $glob_allow)
													{
														$glob_allow_arr = explode('=',$glob_allow);
														echo "<td>".$glob_allow_arr[1]."</td>\n";
													}
													echo "<tr>";
													}
													else
													{
														$fst++;
													}
												}*/
												?>
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
