<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <!-- <h4 class="pull-left"><?php echo anchor('admin/gateway/add_gateway/', '<i class="fa fa-plus"></i>'.  $this->language->form_heading()[53] ); //echo "<pre>"; print_r($this->language->from_body())?></h4>         -->
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
											<th>序号</th>
											<th>提现商户ID</th>
											<th>提现金额</th>
											<th>手续费用</th>
											<th>开户银行</th>
											<th>开户支行</th>
											<th>银行账号</th>
											<th>开户名</th>
											<th>提现时间</th>																					
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
													<td><?php echo $fund['finance_serial']; ?></td>
													<td>														
														<b><?php echo $fund['finance_id']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['finance_withdrawal']; ?></b>
													</td>
													<td>
														<b><?php echo $fund['finance_fee']; ?></b>
														
													</td>	
													<td>
														<b><?php echo $fund['finance_bank']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['finance_branch']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['finance_bankaccount']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['finance_accountname']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['finance_timing']; ?></b>
														
													</td>
																																						
													<td><?php echo btn_edit('admin/finance/paylist#'.$fund['id']); ?>  <?php echo btn_delete('admin/finance/paylist#' . $fund['id']); ?> </td>
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
