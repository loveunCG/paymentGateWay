<div class="col-md-12">
	<p class="title">
       <b>订单管理 </b>
    </p>

</div>
<?php foreach($cinfo as $fund){
	$tixian_daili = $tixian_daili+ $fund['real_amount']*($fund['proxy_fee']/100-$fund['employee_fee']/100);
}
?>
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>agent/dashboard/search_orderinfo" method="post" class="form-horizontal form-groups-bordered">
                                     <div class="col-md-3">
                                        <label for="field-1" class="col-sm-3 control-label">支付时间:</label>
			                            <input type="text" class="form-control" id  = "datepicker" name="start_date" value="<?php if(!empty($start_date)) echo $start_date; ?>"><br>
                                         <label for="field-1" class="col-sm-3 control-label">支付方式:</label>
                                         <select name="pay_method" class="form-control">
                                             <option value="" >所有</option>
																						 <option <?php if($pay_method == "ICBC" ){
																							 echo 'selected="selected"';
																						 }?> value="ICBC" >网银</option>
																						 <option <?php if($pay_method == "WEIXIN" ){
																							 echo 'selected="selected"';
																						 }?> value="WEIXIN" >微信</option>
																						 <option <?php if($pay_method == "TENPAY" ){
																							 echo 'selected="selected"';
																						 }?> value="TENPAY" >财付通</option>
																						 <option <?php if($pay_method == "ALIPAY" ){
																							 echo 'selected="selected"';
																						 }?> value="ALIPAY" >支付宝</option>
																						 <option <?php if($pay_method == "ALIPAYWAP" ){
																							 echo 'selected="selected"';
																						 }?> value="ALIPAYWAP" >支付宝WAP</option>
																						 <option <?php if($pay_method == "WEIXINWAP" ){
																							 echo 'selected="selected"';
																						 }?> value="WEIXINWAP" >微信WAP</option>
																						 <option <?php if($pay_method == "DAIFU" ){
																							 echo 'selected="selected"';
																						 }?> value="DAIFU" >代付</option>

                                         </select>
                                     </div>
                                     <div class="col-md-3">
                                     	<label for="field-1" class="col-sm-3 control-label">至</label>
			                            <input type="text" class="form-control " id = "datepicker1" name="end_date" value="<?php if(!empty($end_date)) echo $end_date; ?>"><br>
                                         <strong><br>提交总金额: <?php if(!empty($tixian_daili)) echo $tixian_daili; ?>元</strong>
                                     </div>
                                     <div class="col-md-3">
                                     	<label for="field-1" class="col-sm-4 control-label">订单流水号：</label>
			                            <input type="text" name="order_number"  class="form-control" id="" value="<?php if(!empty($order_number)) echo $order_number; ?>"/><br>

                                     </div>
                                     <div class="col-md-3">
                                     	  <label for="field-1" class="col-sm-3 control-label">商户ID：</label>
			                            <input type="text" name="partner"  class="form-control" id="" value="<?php if(!empty($partner)) echo $partner; ?>"/><br>
			                            &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" >开始查询</button>

                                     </div>
                                    </form>
                                    </div>
                                        <strong><br>&nbsp;</strong>

                                    </div>

                                </div>
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>商户ID</th>
											<th>商户流水号</th>
											<th>订单金额</th>

											<th>代理金额</th>
											<th>支付方式</th>
											<th>支付时间</th>
											<th>订单状态</th>


										</tr>
									</thead>
									<tbody>
									<?php
											$i=1;foreach($cinfo as $fund)
											{


												?>
												<tr>
													<td>
													<b><?php echo $fund['employee_id']; ?></b>
													</td>
													<td>
													<b><?php echo $fund['order_id']; ?></b>
													</td>
													<td>
													<b><?php echo $fund['real_amount']; ?></b>
													</td>

													<td><b><?php echo $fund['real_amount']*($fund['proxy_fee']/100-$fund['employee_fee']/100); ?></b></td>
													<td><b>
														<?php  if($fund['pay_method'] == 'ALIPAY'){
														echo "支付宝";

										}
										elseif($fund['pay_method'] == 'TENPAY'){
												echo "财付通";


										}elseif($fund['pay_method'] == 'WEIXIN'){
												echo "微信";


										}elseif($fund['pay_method'] == 'WEIXINWAP'){
												echo "微信WAP";


										}elseif($fund['pay_method'] == 'ALIPAYWAP'){
												echo "支付宝WAP";


										}else{
												echo "网银";


										}


												 ?>
													</b></td>
													<td><b><?php echo $fund['submit_time']; ?></b></td>
													<td>
											<?php if($fund['order_status']=='1'){
														echo '<span class="label label-success col-sm-12">成功</span>';
												}elseif ($fund['order_status']=='0'){
														echo '<span class="label label-primary col-sm-12">处理中</span>';
													}elseif ($fund['order_status']=='2'){
														echo '<span class="label label-danger col-sm-12">派出中</span>';
													}elseif($fund['order_status'] == '3'){
														echo '<span class="label label-danger col-sm-12">已接受</span>';
													}elseif($fund['order_status'] == '-2'){
														echo '<span class="label label-danger col-sm-12">已退款</span>';

													}elseif($fund['order_status'] == '-1'){
														echo '<span class="label label-danger col-sm-12">失败</span>';
													}elseif($fund['order_status'] =='5'){
															echo '<span class="label label-danger  col-sm-12"> 补单处理中。。</span>';
          												}else{
          												echo '<span class="label label-primary col-sm-12">处理中</span>';
          													}?></td>

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
<script>
    $(document).ready(function () {

        // $('#dataTables-example').DataTable({
        //     responsive: true
        // });
        // $("#btnExport").click(function (e) {
        //     window.open('data:application/vnd.ms-excel,' + $('#download').html());
        //     e.preventDefault();
        // });
        // $('#something').click(function () {
        //     $('#refresh').submit();
        // });
        $('#datepicker').datetimepicker({
              format: 'YYYY-MM-DD HH:mm:ss'


        });
        $('#datepicker1').datetimepicker({

              format: 'YYYY-MM-DD HH:mm:ss'
        });

    });
</script>
