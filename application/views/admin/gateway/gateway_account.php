<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/gateway/add_gateway_account/'.$gateway_id , '<i class="fa fa-plus"></i>添加网关账户'); ?> </h4>        
    </div>

</div>
		<?php //print_r($this->language->form_body()[10][7])?>
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->from_body()[3][0] ?></strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th><input type="checkbox" id="parent_present"></th>
											<th>批序</th>
											<th>账户ID</th>
											<th>账号</th>
											<th>已走金额</th>
											<th>跳转地址</th>
											<th>状态</th>											
											<th style="width: 10%;">操作</th>

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
													<td><input class="child_present" type="checkbox" name="selected_send_id[]" value="<?php echo $fund['id']; ?>"/></td>
													<td><?php echo $fund['sort_id']; ?></td>
													<td>														
														<b><?php echo $fund['account_id']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['account_name']; ?></b>
													</td>
													<td>
														<b><?php echo $fund['account_amount']; ?></b>
														
													</td>	
													<td>
														<b><?php echo $fund['cha_address']; ?></b>
														
													</td>
													<td>
														<b><?php if ($fund['loop_state']==1) {                        				
															echo '<span class="label label-success">正常</span>';
                                                                } else {
                                                            echo '<span class="label label-danger">非正常</span>';                                      
                                                        }  ?></b>
														
													</td>																																							
													<td><?php echo btn_edit('admin/gateway/add_gateway_account/'.$gateway_id.'/'.$fund['id']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['id']); ?> </td>
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
