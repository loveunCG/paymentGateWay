<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

        <div class="col-md-12">
        <form method="post" action="<?php echo base_url() ?>admin/finance/wait_withdrawlist" >
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                	银行类别
                                <?php if ($bankstatus == 1) { ?>
                        	<input type="radio" name="bank_status" value="1" id="usr_status" checked> 所有&nbsp;
                           <input type="radio" name="bank_status" value="2" id="usr_status"> 银行卡&nbsp;
                            <input type="radio" name="bank_status" value="3" id="usr_status"> 支付宝&nbsp;
                            <input type="radio" name="bank_status" value="4" id="usr_status"> 财付通
                            
                                <?php }elseif ($bankstatus == 2) { ?>
                        	<input type="radio" name="bank_status" value="1" id="usr_status" > 所有&nbsp;
                           <input type="radio" name="bank_status" value="2" id="usr_status" checked> 银行卡&nbsp;
                            <input type="radio" name="bank_status" value="3" id="usr_status"> 支付宝&nbsp;
                            <input type="radio" name="bank_status" value="4" id="usr_status"> 财付通
                            
                                <?php }elseif ($bankstatus == 3) { ?>
                        	<input type="radio" name="bank_status" value="1" id="usr_status" > 所有&nbsp;
                           <input type="radio" name="bank_status" value="2" id="usr_status" > 银行卡&nbsp;
                            <input type="radio" name="bank_status" value="3" id="usr_status" checked> 支付宝&nbsp;
                            <input type="radio" name="bank_status" value="4" id="usr_status"> 财付通
                            
                             <?php }elseif ($bankstatus == 4) { ?>
                        	<input type="radio" name="bank_status" value="1" id="usr_status" > 所有&nbsp;
                           <input type="radio" name="bank_status" value="2" id="usr_status" > 银行卡&nbsp;
                            <input type="radio" name="bank_status" value="3" id="usr_status" > 支付宝&nbsp;
                            <input type="radio" name="bank_status" value="4" id="usr_status" checked> 财付通
                            <?php }else{ ?>
                        	<input type="radio" name="bank_status" value="1" id="usr_status" checked> 所有&nbsp;
                           <input type="radio" name="bank_status" value="2" id="usr_status" > 银行卡&nbsp;
                            <input type="radio" name="bank_status" value="3" id="usr_status" > 支付宝&nbsp;
                            <input type="radio" name="bank_status" value="4" id="usr_status" > 财付通
                             <?php   }  ?>
		                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" >开始查询</button><br><br>
		                             <?php if($total!=null){ ?>
<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 提交总金额: <?php if(!empty($total)) echo $total; ?>元</strong>
							<?php } else{ ?>
							<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 提交总金额: 0.00元</strong>
							<?php } ?>
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
											<th>状态</th>																						
											<th style="width: 10%;"><?php echo $this->language->from_body()[2][38] ?></th>

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
                                                        <?php if ($fund['pay_state']==2) {
                                                               echo '<span class="label label-success">正常</span>';
                                                                } elseif($fund['pay_state']==1){
                                                                	echo '<span class="label label-danger">待机</span>';
                                                                }else {
                                                                    echo '<span class="label label-danger">非正常</span>';                                       
                                                        }  ?>
                                                    </td>												
																																						
													<td>
													<?php if($fund['pay_state']!=2){ ?>
													<?php echo btn_submit('admin/finance/success_agent_withdraw/'.$fund['number']); ?>  <?php echo btn_reject('admin/finance/reject_agent_view/' . $fund['number']); ?>
													<?php } else{ ?>
													<a href="#" class="btn btn-default btn-flat"><?php echo $this->language->from_body()[57][9] ?></a>
													<?php } ?>
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
