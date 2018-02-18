<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


</div>

        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-minus-square"></i> 点卡通道设置</strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th><input type="checkbox" id="parent_present"></th>
											<th>通道名称</th>
											<th>通道代码</th>
											<th>所属网关</th>
											<th>通道状态</th>											
											<th style="width: 15%;">操作</th>

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
													<td><input class="child_present" type="checkbox" name="selected_send_id[]" value="<?php echo $fund['finance_serial']; ?>"/></td>
													<td>														
														<b><?php echo $fund['channel_name']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['cha_code']; ?></b>
													</td>
													<td>	                                               
                                                    <?php
                                                    foreach ($allinfo as $v_fields) :
                                                            ?>
                                                        <?php if ($v_fields['num'] == $fund['channel_gateway']){ ?>
                                                        <span><?php echo $v_fields['gateway_name']; ?></span>
                                                            <?php
                                                        }
                                                    endforeach;
                                                    ?>                                               	
														
													</td>	
													<td>		                                                
		                                                    <input  type="checkbox" name="channel_status" value="<?php if (!empty($ginfo)) echo $ginfo->channel_status; ?>" 
		                                                            <?php
		                                                                if ($fund['channel_status'] == 1) {
		                                                                    echo 'checked';
		                                                                }
		                                                            ?>/>
		                                                    <span> <?php echo $this->language->from_body()[2][12] ?></span>
		                                              
													</td>																									
													<td><?php echo btn_edit('admin/gateway/view_channel/'.$fund['num'].'/2'); ?>  <?php echo btn_delete('admin/gateway/delete_gateway/' . $fund['num']); ?> </td>
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
