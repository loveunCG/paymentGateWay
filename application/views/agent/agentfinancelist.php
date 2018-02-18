<div class="col-md-12">
	<p class="title">
       <b>资金流水 </b>
    </p>

</div>
		
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-minus-square"></i> 
                                      <?php if ($totalprice) {
                                      			echo "提交总金额: ".$totalprice." 元" ;
                                      } else{ ?>
                                        提交总金额:0.00 元 </strong>
                                        <?php } ?>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>

											<th>记录时间</th>
											<th>商户ID</th>
											<th>金额类型</th>
											<th>提交金额</th>
											<th>收益/支出</th>
											<th>余额</th>
											<th>备注</th>
										

										</tr>
									</thead>
									<tbody>
			                        <?php
			                        //echo "<pre>";
			                        //print_r($cinfo);
			                        //	var_dump($cinfo);
			                        $i=1;foreach($all_info as $fund)
			                        {
			                            ?>
			                            <tr>
			                                <td>
			                                    <b><?php echo $fund['finance_time']; ?></b>
			                                </td>
			                                <td>
			                                    <b><?php echo $fund['finance_id']; ?></b>
			                                </td>
			                                <td>
			                                    <b><?php echo $fund['finance_submit']; ?></b>

			                                </td>
			                                <td>
			                                <b><?php echo $fund['finance_amount']; ?></b>
			                                </td>
			                                <td>
			                                <b><?php echo $fund['finance_type']; ?></b>
			                                </td>
			                                <td> 
			                                    <b><?php echo $fund['finance_balance']; ?></b>
			                                </td>
			                                <td>
			                                <b><?php echo $fund['finance_remarks']; ?></b>
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
