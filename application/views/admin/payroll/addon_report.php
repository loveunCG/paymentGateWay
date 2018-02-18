<style type="text/css" media="print">
    @media print{@page {size: landscape}}
</style>
<div class="row">
      <div class="col-sm-12 print_width">
                    <div class="row">       
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">                                        
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <div class="panel-title"><h4 class="panel-title">
                                        <strong>Add On History </strong> 
                                <div class="pull-right hidden-print" >
                                    <a href="<?php echo base_url() ?>admin/payroll/create_excel/<?php echo $department_id_excel . '/' . $myn. '/' . $employee_id_excel. '/' . $payment_frequency_excel ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a>                                                
                                </div></h4>
										
                                        <div class="pull-right"><!-- set pdf,Excel start action -->
                                            <label class="hidden-print control-label pull-left hidden-xs">
											</label>
											<label class="payment_print hidden-print control-label col-sm-3 pull-left hidden-xs">
                                                <?php //echo btn_make_pdf("admin/payroll/payment_history_pdf/$start_payment_date/$end_payment_date"); // .$emp_salary_info->employee_id); ?>                                                    
                                            </label>
                                                                                                                                                 
                                        </div><!-- set pdf,Excel start action -->                                                
                                    </div>
                                </div>
								<form class="form-horizontal" method="POST" action="#" id="payment_form" role="form">
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
										                                                   
                                            <th>Employee Name </th>                                                    
                                            <th>REG </th>
                                            <th>OT </th>
                                            <th>PRM </th>
                                            <th>PHOL1 </th>
                                            <th>PHOL2 </th>
                                            <th>SICK </th>
											<th>VACATION </th>
                                        </tr>
                                    </thead>
                                    <tbody>                                                                        
                                        <?php
                                        
                                        //echo '<pre>';
										//print_r($employee);
										$myn = explode('-',$myn);
                                        if (!empty($employee)): 
											for ($i=0;$i<count($employee);$i++ ):
													 
												?>
												<tr>
												<td style="color:#ff000"><?php //echo isset($z)?$z:''; ?></td>
													
 												
                                                    <td><?php echo $employee[$i]['first_name'].' '.$employee[$i]['last_name'];?></td>
                                                    <td><?php echo $employee[$i]['totalRegularDays'];?></td>
                                                    <td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<?php $getothers = $this->attendance_model->get_employee_working_others_info_by_depart_id_month($employee[$i]['employee_id'],$myn[0],$myn[1],$myn[2]); //echo '<pre>'; print_r($getothers);?>
													<?php for ($j=0;$j<count($getothers);$j++ ):?>
													<?php if($getothers[$j]['category']=='Sick Leave'){?>
													<td> <?php echo $getothers[$j]['totalOthersLeave'];?></td>
													<?php }if($getothers[$j]['category']=='Vacation Leave'){?>
													<td><?php  echo $getothers[$j]['totalOthersLeave'];?></td>
													<?php }endfor;?>
												</tr>	
											<?php endfor;?>
										<?php else : ?>
                                            <tr>       
                                                <td colspan="9">
                                                    <strong>There is no data for display</strong>
                                                </td>
                                            </tr>
										<?php endif; ?>
                                    </tbody>
                                </table>      
								<!--<div class="form-group" id="border-none">
									<label for="field-1" class="col-sm-3 control-label"></label>
									<div class="col-sm-12">
										<div class="col-sm-4">
										<button id="bulk_cheque_print" type="button" name="sbtn" value="" class="btn btn-primary btn-block">Bulk Cheque Print</button>
										<!--<input type="text" name="cheque_print" class="cheque_print" value="">
										</div>
										<div class="col-sm-4">
										<button id="payment" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">Make Payment</button>
										</div>
										<div class="col-sm-4">
										<button id="bulk_download" type="button" name="sbtn" value="1" class="btn btn-primary btn-block">Bulk Deposit Download</button>
										</div>
									</div>
								</div>-->
								</form>    
                            </div>                                    
                        </div>                             
                    </div><!--************ Payment History End***********-->
                </div> 
</div>
