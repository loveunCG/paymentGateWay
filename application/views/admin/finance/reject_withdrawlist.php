<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

        <div class="col-md-12">

            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation()" action="<?php echo base_url(); ?>admin/finance/reject_withdrawlist" method="post" class="form-horizontal form-groups-bordered">
                                    <input type="hidden" name="state" value="1">


                    <div class="row">
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">支付时间:</label>
                                    <div class="input-group col-md-7">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="start_date" value="<?php if(!empty($start_date)) echo $start_date; ?>" >
                                    </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">至:</label>
                                    <div class="input-group col-md-7">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker1" name="end_date" value="<?php if(!empty($end_date)) echo $end_date; ?>">
                                    </div>

                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">代理ID:</label>
                                    <div class="input-group col-md-7">

                                    <input type="text" class="form-control" style="border-radius: 4px;" name="employee_id" value="<?php if(!empty($employee_id)) echo $employee_id; ?>" >
                                    </div>

                                    </div> 
 
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">银行账号:</label>
                                    <div class="input-group col-md-7">

                                    <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="bank_name"  value="<?php if(!empty($bank_name)) echo $bank_name; ?>">
                                    </div>

                                    </div> 

                        </div>                                                                        
                                    
                             <?php   if($total!=null){ ?>

<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 提交总金额: <?php if(!empty($total)) echo $total; ?>元</strong>
							<?php } else{ ?>
							<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 提交总金额: 0.00元</strong>
							<?php } ?>
                         <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="sbtn" class="btn btn-primary" style="float: right;margin-right: 10%;" id="i_submit" >&nbsp;&nbsp;&nbsp;&nbsp; 开始查询 &nbsp;&nbsp;&nbsp;&nbsp;</button><br><br></strong>
                                    </div>  
</form>
                                    </div>  

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">

									<thead>
										<tr>
											<th>                                                                
			                                   <input type="checkbox" id="parent_present" disabled>
			                                </th>
											<th><?php echo $this->language->from_body()[58][5] ?></th>
											<th>代理ID</th>
											<th><?php echo $this->language->from_body()[58][7] ?></th>
											<th><?php echo $this->language->from_body()[58][8] ?></th>
											<th><?php echo $this->language->from_body()[2][43] ?></th>
											<th><?php echo $this->language->from_body()[57][6] ?></th>
											<th><?php echo $this->language->from_body()[57][8] ?></th>											
											<th><?php echo $this->language->from_body()[2][49] ?></th>
											<th><?php echo $this->language->from_body()[57][7] ?></th>
											<th>审核时间</th>
											<th>状态</th>																						
											<th>原因</th>

										</tr>
									</thead>
									<tbody>
										<?php
											//echo "<pre>";										
											//print_r($cinfo);
											//	var_dump($cinfo);
											$i=1;foreach($cinfo as $fund)
											{
												?>
												<tr>
													<td><input class="child_present" type="checkbox" name="selected_send_id[]" value="<?php echo $fund['number']; ?>"/ disabled></td>
													<td>														
														<b><?php echo $fund['number']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['agent_id']; ?></b>
													</td>
													<td>
														<b><?php echo $fund['withdraw_mount']; ?></b>
														
													</td>	
													<td>
														<b><?php echo $fund['fee']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['bank_name']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['bank_of_the_province_where_the_bank']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['bank_card_number']; ?></b>
														
													</td>													
													<td>
														<b><?php echo $fund['account_name']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['withdraw_time']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['pay_time']; ?></b>
														
													</td>													
                                                    <td>
                                                        <?php if ($fund['pay_mode']==1) {
                                                           echo '<span class="label label-success">直接拒绝</span>';
                                                        } else {
                                                            echo '<span class="label label-danger">拒绝并不退款</span>';                                       
                                                        }  ?>
                                                    </td>												
																																						
													<td>
													<?php if($fund['pay_mode']==1){
														echo btn_submit('admin/finance/agent_reason/'.$fund['number']); 
														}else{
															echo btn_submit('admin/finance/agent_reason/'.$fund['number']);
														?> <br><br> <?php
														echo btn_reject('admin/finance/refund_agent_view/' . $fund['number']);
															} ?>

													</td>
												</tr>                
											<?php } ?>											
									</tbody>

								</table>
<!-- 								<div class="row">
									 <div class="col-md-12">
									<div class="form-group">
									&nbsp;&nbsp;&nbsp;<?php echo $this->language->from_body()[57][10] ?>
									<button class="btn btn-default btn-sm"><i class="fa fa-paper-plane">&nbsp;<?php echo $this->language->from_body()[57][11] ?></i></button>   								
									&nbsp;&nbsp;<a href="#" class="btn btn-default btn-flat"><?php echo $this->language->from_body()[57][24] ?></a>&nbsp;&nbsp;
									</div>
									</div>
								</div> -->
                            </div>
                        </div>
                    </div>                           
            </div>
            </form>
        </div>
    </div>
<script>
	$(document).ready(function () {
		$('#datepicker').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});
		$('#datepicker1').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});

	});
</script>