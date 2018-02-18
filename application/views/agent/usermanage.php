<div class="col-md-12">
	<p class="title">
       <b>名下商户 </b>
    </p>

</div>
		
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-minus-square"></i></strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>

											<th>商户ID</th>
											<th>用户名</th>
											<th>当日充值</th>
											<th>昨日充值</th>
											<th>电话</th>
											<th>QQ</th>
											<th>状态</th>
										

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
														<b><?php echo $fund['employee_id']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['usr_email']; ?></b>
													</td>
													<td>
														<b><?php
														$sum_jin = 0.00;
														foreach($orderinfo as $val){
																if($val['employee_id'] ==$fund['employee_id']){
																	$sum_jin = $sum_jin + $val['real_amount'];
																}
													
														}
														echo $sum_jin;
													
														?></b>
														
													</td>	
													<td>
														<b><?php
														$sum_jin = 0.00;
														foreach($order_zinfo as $vale){
																if($vale['employee_id'] ==$fund['employee_id'] ){
																	$sum_jin = $sum_jin + $vale['real_amount'];
																}
													
														}
														echo $sum_jin;
													
														?></b>
														
													</td>
													<td>
														<b><?php echo $fund['usr_mobile']; ?></b>
														
													</td>
													<td>
														<b><?php echo $fund['usr_contact_qq_num']; ?></b>
														
													</td>
													<td>
														<b>
										<?php
                                        if ($fund['usr_status'] == 1) {
                                            echo '<span class="label label-success"> 通过验证 </span>';
                                        } elseif($fund['usr_status'] == 4) {
                                            echo '<span class="label label-danger">冻结商户</span>';
                                        } elseif($fund['usr_status'] == 3) {
                                            echo '<span class="label label-danger"> 拒绝验证</span>';
                                        }elseif($fund['usr_status'] == 2) {
                                            echo '<span class="label label-danger"> 等侍验证 </span>';
                                        }
                                        ?>                                        	

                                        </b>
														
													</td>

													
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
