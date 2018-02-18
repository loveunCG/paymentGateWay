<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


</div>
		<?php //print_r($this->language->form_body()[10][7])?>
        <div class="col-md-12" id="employee_list">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/finance/agent_withdraw_ready" method="post" class="form-horizontal form-groups-bordered">
                                    <div class="row">
	                                    <input type="hidden" name="state" value="1">
                                    <label for="field-1" class="col-sm-2 control-label">商户余额大于等于</label>
                                    <div class="col-md-2">
		                            <input type="text" name="request_mount"  class="form-control" id="" value="<?php if(!empty($request_mount)) echo $request_mount; ?>"/><br>			                          	
                                     </div>
                                    <label for="field-1" class="col-sm-2 control-label">商户可结算金额大于等于</label>
                                    <div class="col-md-2">
		                            <input type="text" name="able_mount"  class="form-control" id="" value="<?php if(!empty($able_mount)) echo $able_mount; ?>"/><br>		                          	
                                     </div>
                                    <label for="field-1" class="col-sm-1 control-label">商户ID：</label>
    	                                    <div class="col-md-2">
		                            <input type="text" name="employee_id"  class="form-control" id="" value="<?php if(!empty($employee_id)) echo $employee_id; ?>"/><br>		                          	
                                     </div>
                                    </div>
                                    <div class="row" style="float: right;">

                                    <label for="field-1" class="col-sm-1 control-label"></label>
                                    <div class="col-md-12">
		                             <button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" >开始查询</button>

 		                             <input type="button" class="btn btn-primary"  onclick="set_id();"  value="批量結算">
 		                                               	
                                     </div> 
                                    </div>

                                                                                                              
                                    </form>
                             <?php   if($total!=null){ ?>

<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 可结算总金额: <?php if(!empty($total)) echo $total*100/100; ?>元 &nbsp;&nbsp;&nbsp; </strong>
							<?php } else{ ?>
							<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 提交总金额: 0.00元 &nbsp;&nbsp;&nbsp;</strong>
							<?php } ?>
                                    <button style="float: right;" class="btn-print" type="button" data-toggle="tooltip" title="" onclick="employee_list('employee_list')" data-original-title="Print" aria-describedby="tooltip478896"><a href="<?php echo base_url(); ?>admin/finance/agent_withdraw_ready" class="btn btn-primary btn-xs" title="" data-toggle="tooltip" data-placement="top" onclick="printDiv(" printablearea")"="" data-original-title="Print"><span class="glyphicon glyphicon-print"></span></a></button>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th style="width: 3%;"> <input type="checkbox" id="parent_present"></th>
											<th>代理ID</th>
											<th><?php echo $this->language->from_body()[12][29] ?></th>
											<th><?php echo $this->language->from_body()[12][15] ?></th>
											<th><?php echo $this->language->from_body()[12][14] ?></th>
											<th><?php echo $this->language->from_body()[12][13] ?></th>
											<th style="width: 10%;"><?php echo $this->language->from_body()[12][12] ?></th>
										<!-- 	<th style="width: 5%;"><?php echo $this->language->from_body()[2][38] ?></th> -->
										

										</tr>
									</thead>
	                             <form role="form" id="set_submin" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/finance/agent_with_all/" method="post" class="form-horizontal form-groups-bordered">
									<tbody>
										<?php
											//echo "<pre>";										
											//print_r($cinfo);
											//	var_dump($cinfo);
											$i=1;foreach($cinfo as $fund)
											{
												?>
												<tr>
													<td><input class="child_present" type="checkbox" name="selected_send_id[]" value="<?php echo $fund['proxy_id']; ?>"/></td>													
													<td>														
														<b><?php echo $fund['proxy_id']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['bank_card_number']; ?></b>
													</td>
													<td>
														<?php if ($fund['account_amount']) {
															echo $fund['account_amount']; 
															
														}else{echo 0;}
														?>
														
													</td>	
													<td>
														<?php if ($total=="") {
															echo 0;
														}else{ echo $total; }
														?>
														
													</td>
													<td>
														<b><?php echo $fund['default_rate']; ?>%</b>
														
													</td>
													<td>
														<b><?php echo $fund['login_time']; ?></b>
														
													</td>											
<!-- 																																						
													<td><a href="#" class="btn btn-default btn-flat"><?php echo $this->language->from_body()[5][3] ?></a></td> -->
												</tr>                
											<?php } ?>
									</tbody>
									</form> 
								</table>
                            </div>
                        </div>
                    </div>                           
            </div>
        </div>
    </div>
<script type="text/javascript">
    function employee_list(employee_list) {
        var printContents = document.getElementById(employee_list).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function set_id() {
    	set_submin.submit();
    }

 
</script>