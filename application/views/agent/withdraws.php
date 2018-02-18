<div class="col-md-12">
	<p class="title">
       <b>提现记录 </b>
    </p>

</div>
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                    <?php  foreach($cinfo as $fund){
	                       $all_withdraw_amount = $all_withdraw_amount + $fund['withdraw_mount'];
	
}
					?>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-minus-square"></i> 总提现金额&nbsp;:&nbsp;<?php echo $all_withdraw_amount; ?>元</strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>提现金额</th>
											<th>手续费</th>
											<th>提现时间</th>
											<th class = "col-lg-2">支付时间</th>
											<th class = "col-lg-1">状态</th>
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
														<b><?php echo $fund['withdraw_mount']; ?></b>													
													</td>                     
													<td>
														<b><?php echo $fund['fee']; ?></b>
													</td>
													<td>
														<b><?php echo $fund['withdraw_time']; ?></b>
														
													</td>	
														<td>
														<b>
														<?php if(!$fund['pay_time']){
															echo '<span class="label label-primary ">下发中。。</span>';
														}elseif($fund['pay_time']){
															echo $fund['pay_time'];
														}
														
														?>
														
														
													</td>	
													<td>
														<b><?php if($fund['pay_state']=='1'){
						                                        echo '<span class="label label-primary ">下发中。。</span>';
						                                    }elseif($fund['pay_state']=='3'){
						                                        echo '<span class="label label-primary ">已拒绝</span>';
						                                    }elseif($fund['pay_state']=='2'){
						                                        echo '<span class="label label-primary ">已支付..</span>';
						                                    }else{
						                                        echo '<span class="label label-primary ">待审核..</span>';
						                                    }
						                                    ?></b>														
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
