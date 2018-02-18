<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/gateway/add_gateway/', '<i class="fa fa-plus"></i>'.  $this->language->form_heading()[53] ); //echo "<pre>"; print_r($this->language->from_body())?></h4>        
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
											<th>ID</th>
											<th>网关名称</th>
											<th>公司地址</th>
											<th>通道标识</th>
											<th>网关类别</th>											
											<th style="width: 15%;">管理操作</th>

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
													<td><?php echo $fund['id']; ?></td>
													<td>														
														<b><?php echo $fund['online_gatewayname']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['online_companyname']; ?></b>
													</td>
													<td>
														<b><?php echo $fund['online_channel']; ?></b>
														
													</td>	
													<td>
														<b><?php echo $fund['online_gatewaytype']; ?></b>
														
													</td>																									
													<td><?php echo btn_edit('admin/gateway/add_gateway/'.$fund['id']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['id']); ?> </td>
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
