<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


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

                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#online"  data-toggle="tab">网银</a></li>
                                <li class=""><a href="#alipay" data-toggle="tab">支付宝</a></li>
                                <li class=""><a href="#tenpay" data-toggle="tab">财付通</a></li>
                                <li class=""><a href="#weixin" data-toggle="tab">微信</a></li>
                                <li class=""><a href="#wapalipay" data-toggle="tab">wap支付宝</a></li>
                                <li class=""><a href="#wapweixin" data-toggle="tab">wap微信</a></li>
                                <li class=""><a href="#daifu" data-toggle="tab">代付网关</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="online">
                                   
                                <table class="table table-bordered table-hover" id="dataTables-example" style="color: #555;">
									<thead>
										<tr>
											<th>ID</th>
											<th>网关名称</th>
											<th>公司地址</th>
											<th>接口标识</th>
											<th>网关类别</th>									
											<th style="width: 15%;">管理操作</th>

										</tr>
									</thead>
									<tbody>
										<?php
											foreach($ginfo as $fund):											
												?>
												<tr>
												<?php if ($fund['gateway_type']==1) { ?>
													<td><?php echo $fund['num']; ?></td>
													<td><?php echo $fund['gateway_name']; ?></td>
													<td><?php echo $fund['gateway_company']; ?></td>
													<td><?php echo $fund['gateway_mark']; ?></td>
													<td><?php echo $fund['gateway_name_type']; ?></td>
																								
													<td><?php echo btn_view_account('admin/gateway/gateway_account/'.$fund['num']); ?> <?php echo btn_edit('admin/gateway/add_gateway/'.$fund['num']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['num']); ?> </td>
												<?php } ?>
												</tr>                
											<?php endforeach; ?>
									</tbody>
								</table>
                                   

                                </div>
                                
                                <div class="tab-pane fade" id="alipay">
                                <table class="table table-bordered table-hover" id="dataTables-example" style="color: #555;">
									<thead>
										<tr>
											<th>ID</th>
											<th>网关名称</th>
											<th>公司地址</th>
											<th>接口标识</th>
											<th>网关类别</th>									
											<th style="width: 15%;">管理操作</th>

										</tr>
									</thead>
									<tbody>
										<?php
											foreach($ginfo as $fund):											
												?>
												<tr>
												<?php if ($fund['gateway_type']==3) { ?>
													<td><?php echo $fund['num']; ?></td>
													<td><?php echo $fund['gateway_name']; ?></td>
													<td><?php echo $fund['gateway_company']; ?></td>
													<td><?php echo $fund['gateway_mark']; ?></td>
													<td><?php echo $fund['gateway_name_type']; ?></td>
																								
													<td><?php echo btn_view_account('admin/gateway/gateway_account/'.$fund['num']); ?> <?php echo btn_edit('admin/gateway/add_gateway/'.$fund['num']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['num']); ?> </td>
												<?php } ?>
												</tr>                
											<?php endforeach; ?>
									</tbody>
								</table>
                                </div>

                                <div class="tab-pane fade" id="tenpay">
                                <table class="table table-bordered table-hover" id="dataTables-example" style="color: #555;">
									<thead>
										<tr>
											<th>ID</th>
											<th>网关名称</th>
											<th>公司地址</th>
											<th>接口标识</th>
											<th>网关类别</th>									
											<th style="width: 15%;">管理操作</th>

										</tr>
									</thead>
									<tbody>
										<?php
											foreach($ginfo as $fund):											
												?>
												<tr>
												<?php if ($fund['gateway_type']==4) { ?>
													<td><?php echo $fund['num']; ?></td>
													<td><?php echo $fund['gateway_name']; ?></td>
													<td><?php echo $fund['gateway_company']; ?></td>
													<td><?php echo $fund['gateway_mark']; ?></td>
													<td><?php echo $fund['gateway_name_type']; ?></td>
																								
													<td><?php echo btn_view_account('admin/gateway/gateway_account/'.$fund['num']); ?> <?php echo btn_edit('admin/gateway/add_gateway/'.$fund['num']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['num']); ?> </td>
												<?php } ?>
												</tr>                
											<?php endforeach; ?>
									</tbody>
								</table>
                                </div>
                                <div class="tab-pane fade" id="weixin">
                                <table class="table table-bordered table-hover" id="dataTables-example" style="color: #555;">
									<thead>
										<tr>
											<th>ID</th>
											<th>网关名称</th>
											<th>公司地址</th>
											<th>接口标识</th>
											<th>网关类别</th>									
											<th style="width: 15%;">管理操作</th>

										</tr>
									</thead>
									<tbody>
										<?php
											foreach($ginfo as $fund):											
												?>
												<tr>
												<?php if ($fund['gateway_type']==5) { ?>
													<td><?php echo $fund['num']; ?></td>
													<td><?php echo $fund['gateway_name']; ?></td>
													<td><?php echo $fund['gateway_company']; ?></td>
													<td><?php echo $fund['gateway_mark']; ?></td>
													<td><?php echo $fund['gateway_name_type']; ?></td>
																								
													<td><?php echo btn_view_account('admin/gateway/gateway_account/'.$fund['num']); ?> <?php echo btn_edit('admin/gateway/add_gateway/'.$fund['num']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['num']); ?> </td>
												<?php } ?>
												</tr>                
											<?php endforeach; ?>
									</tbody>
								</table>
                                </div>
                                <div class="tab-pane fade" id="wapalipay">
                                <table class="table table-bordered table-hover" id="dataTables-example" style="color: #555;">
									<thead>
										<tr>
											<th>ID</th>
											<th>网关名称</th>
											<th>公司地址</th>
											<th>接口标识</th>
											<th>网关类别</th>									
											<th style="width: 15%;">管理操作</th>

										</tr>
									</thead>
									<tbody>
										<?php
											foreach($ginfo as $fund):											
												?>
												<tr>
												<?php if ($fund['gateway_type']==6) { ?>
													<td><?php echo $fund['num']; ?></td>
													<td><?php echo $fund['gateway_name']; ?></td>
													<td><?php echo $fund['gateway_company']; ?></td>
													<td><?php echo $fund['gateway_mark']; ?></td>
													<td><?php echo $fund['gateway_name_type']; ?></td>
																								
													<td><?php echo btn_view_account('admin/gateway/gateway_account/'.$fund['num']); ?> <?php echo btn_edit('admin/gateway/add_gateway/'.$fund['num']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['num']); ?> </td>
												<?php } ?>
												</tr>                
											<?php endforeach; ?>
									</tbody>
								</table>
                                </div>
                                
                                <div class="tab-pane fade" id="wapweixin">
                                <table class="table table-bordered table-hover" id="dataTables-example" style="color: #555;">
									<thead>
										<tr>
											<th>ID</th>
											<th>网关名称</th>
											<th>公司地址</th>
											<th>接口标识</th>
											<th>网关类别</th>									
											<th style="width: 15%;">管理操作</th>

										</tr>
									</thead>
									<tbody>
										<?php
											foreach($ginfo as $fund):											
												?>
												<tr>
												<?php if ($fund['gateway_type']==9) { ?>
													<td><?php echo $fund['num']; ?></td>
													<td><?php echo $fund['gateway_name']; ?></td>
													<td><?php echo $fund['gateway_company']; ?></td>
													<td><?php echo $fund['gateway_mark']; ?></td>
													<td><?php echo $fund['gateway_name_type']; ?></td>
																								
													<td><?php echo btn_view_account('admin/gateway/gateway_account/'.$fund['num']); ?> <?php echo btn_edit('admin/gateway/add_gateway/'.$fund['num']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['num']); ?> </td>
												<?php } ?>
												</tr>                
											<?php endforeach; ?>
									</tbody>
								</table>
                                </div>
                                <div class="tab-pane fade" id="daifu">
                                <table class="table table-bordered table-hover" id="dataTables-example" style="color: #555;">
									<thead>
										<tr>
											<th>ID</th>
											<th>网关名称</th>
											<th>公司地址</th>
											<th>接口标识</th>
											<th>网关类别</th>									
											<th style="width: 15%;">管理操作</th>

										</tr>
									</thead>
									<tbody>
										<?php
											foreach($ginfo as $fund):											
												?>
												<tr>
												<?php if ($fund['gateway_type']==10) { ?>
													<td><?php echo $fund['num']; ?></td>
													<td><?php echo $fund['gateway_name']; ?></td>
													<td><?php echo $fund['gateway_company']; ?></td>
													<td><?php echo $fund['gateway_mark']; ?></td>
													<td><?php echo $fund['gateway_name_type']; ?></td>
																								
													<td><?php echo btn_view_account('admin/gateway/gateway_account/'.$fund['num']); ?> <?php echo btn_edit('admin/gateway/add_gateway/'.$fund['num']); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['num']); ?> </td>
												<?php } ?>
												</tr>                
											<?php endforeach; ?>
									</tbody>
								</table>
                                </div>                                                                                                                                                                                                                                
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>                           
            </div>
        </div>
    </div>
