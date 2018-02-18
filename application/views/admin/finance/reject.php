<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

</div>
		<?php //print_r($this->language->form_body()[10][7])?>
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/finance/reject" method="post" class="form-horizontal form-groups-bordered">
                                    <input type="hidden" name="state" value="1">


                    <div class="row">
                            <div class="form-group col-lg-6">
                                    <label class="col-md-5 control-label" for="state-danger">支付时间:</label>
                                    <div class="input-group col-md-7">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="start_date" value="<?php if(!empty($start_date)) echo $start_date; ?>" >
                                    </div>
                            </div>
                            <div class="form-group col-lg-6">
                                    <label class="col-md-5 control-label" for="state-danger">至:</label>
                                    <div class="input-group col-md-7">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker1" name="end_date" value="<?php if(!empty($end_date)) echo $end_date; ?>">
                                    </div>

                            </div>


                        </div> 
                         <div class="row">
                                 <div class="form-group col-lg-6">
                                    <label class="col-md-5 control-label" for="state-danger">商户ID:</label>
                                    <div class="input-group col-md-7">

                                    <input type="text" class="form-control" style="border-radius: 4px;" name="employee_id" value="<?php if(!empty($employee_id)) echo $employee_id; ?>">
                                    </div>

                                </div> 
 
                                <div class="form-group col-lg-6">
                                    <label class="col-md-5 control-label" for="state-danger">银行账号:</label>
                                    <div class="input-group col-md-7">

                                    <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="bank_name"  value="<?php if(!empty($bank_name)) echo $bank_name; ?>">
                                    </div>

                                </div> 
                         </div>                                                                       
                                    
                             <?php   if($total!=null){ ?>

<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 拒绝总金额: <?php if(!empty($total)) echo $total*100/100; ?>元 &nbsp;&nbsp;&nbsp; </strong>
							<?php } else{ ?>
							<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 提交总金额: 0.00元 &nbsp;&nbsp;&nbsp; </strong>
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
									
											<th>序号</th>
											<th>商户ID</th>
											<th>提现金额</th>
											<th>手续费用</th>
											<th>开户银行</th>
											<th>开户支行</th>
											<th>银行账号</th>
											<th>开户名</th>
											<th>提现时间</th>
											<th>审核时间</th>
											<th>原因</th>
											<th>状态</th>																					
<!-- 											<th style="width: 10%;">操作</th> -->

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
											
													<td>														
														<b><?php echo $fund['id']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['employee_id']; ?></b>
													</td>
													<td>
														<b><?php echo $fund['delivery_mount']; ?></b>
														
													</td>	
													<td>
														<b><?php echo $fund['fee']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['delivery_bank_name']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['delivery_bankbrach_name']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['delivery_bank_card']; ?></b>
														
													</td>													
													<td>
														<b><?php echo $fund['user_name']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['create_time']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['complete_time']; ?></b>
														
													</td>
													<td>
												<span><?php echo $fund['reason']; ?> </span>
														
													</td>																										
													<td>
														<?php if($fund['pay_mode']==1){ ?>
														<span class="label label-success">直接拒绝</span>
														<?php }else{ ?>
														<span class="label label-danger">拒绝并不退款</span>
														<?php } ?>
														
													</td>													
																																						
<!-- 													<td><?php echo btn_edit('admin/finance/derivery#'.$fund['id']); ?>  <?php echo btn_delete('admin/finance/derivery#' . $fund['id']); ?> </td> -->
												</tr>                
											<?php } ?>
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>                           
            </div>
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