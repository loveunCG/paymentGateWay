<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


		<?php //print_r($this->language->form_body()[10][7])?>
        <div class="col-md-12">

            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                                <form method="post" action="<?php echo base_url() ?>admin/finance/delivery" >
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    银行类别
                                <?php if ($bankstatus == 1) { ?>
                        	<input type="radio" name="bank_status" value="1" id="usr_status" checked> 所有&nbsp;&nbsp;
                           <input type="radio" name="bank_status" value="2" id="usr_status"> 银行卡&nbsp;&nbsp;
                            <input type="radio" name="bank_status" value="3" id="usr_status"> 支付宝&nbsp;&nbsp;
                            <input type="radio" name="bank_status" value="4" id="usr_status"> 财付通
                            
                                <?php }elseif ($bankstatus == 2) { ?>
                        	<input type="radio" name="bank_status" value="1" id="usr_status" > 所有&nbsp;&nbsp;
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
                             <?php   } ?>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" >开始查询</button><br><br>
 <?php if($total!=null){  ?>
<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 提交总金额: <?php if(!empty($total)) echo $total; ?>元</strong>
							<?php } else{ ?>
							<strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 提交总金额: 0.00元</strong>
							<?php } ?>
                                    </div>                                      

                                </div>         </form>           
                                <!-- Table -->
      <!--   <form method="post" action="<?php echo base_url() ?>admin/finance/success_accept" >     -->                            
                                <table class="table table-bordered table-hover" id="dataTables-example">

									<thead>
										<tr>
											<th>                                                                
			                                   <input type="checkbox" id="parent_present">
			                                </th>
											<th><?php echo $this->language->from_body()[58][5] ?></th>
											<th><?php echo $this->language->from_body()[58][6] ?></th>
											<th><?php echo $this->language->from_body()[58][7] ?></th>
											<th><?php echo $this->language->from_body()[58][8] ?></th>
											<th><?php echo $this->language->from_body()[2][43] ?></th>
											<th><?php echo $this->language->from_body()[57][6] ?></th>
											<th><?php echo $this->language->from_body()[57][8] ?></th>											
											<th><?php echo $this->language->from_body()[2][49] ?></th>
											<th><?php echo $this->language->from_body()[57][7] ?></th>
											<th>审核时间</th>
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
													<td><input class="child_present" type="checkbox" name="selected_send_id[]" value="<?php echo $fund['id']; ?>"/></td>
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
														<?php if($fund['delivery_status']==1){ ?>
														<span class="label label-success">等待 </span>											
														<?php }else{ ?>
														<span class="label label-danger">非正常 </span>
														<?php } ?>
														
													</td>

																																						
													<td><?php  echo btn_save('admin/finance/success_accept/'.$fund['id']); ?> 
														<?php echo btn_reject('admin/finance/reject_view/'.$fund['id']); ?> 
													</td>
												</tr>                
											<?php } ?>											
									</tbody>

								</table>
								<div class="row">
									 <div class="col-md-12">
									<div class="form-group">
<!-- 									&nbsp;&nbsp;&nbsp;<?php echo $this->language->from_body()[57][10] ?>
									<button class="btn btn-default btn-sm"><i class="fa fa-paper-plane">&nbsp;<?php echo $this->language->from_body()[57][11] ?></i></button>    -->								
									<!-- &nbsp;&nbsp;<a href="#" class="btn btn-default btn-flat"><?php echo $this->language->from_body()[57][24] ?></a>&nbsp;&nbsp; -->
									</div>
									</div>
									</div>
									<!-- </form> -->
                            </div>
                        </div>
                    </div>                           
            </div>
            </form>
        </div>
    </div>
