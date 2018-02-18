<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row margin">
</div>
<!-- Table -->


<div class="container-fluid">

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-search"></i>&nbsp;查询</h4>
                </div>
                <div class="panel-body form-horizontal">
            <form action="" method="post">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label class="col-md-4 control-label" for="state-danger">商户ID</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control pull-right" value="<?=$employee_id?>" name="employee_id">
                        </div>

                    </div>

                    <div class="form-group col-lg-4">
                        <label class="col-md-4 control-label" for="state-danger">订单号</label>
                        <div class="input-group col-md-8">

                            <input type="text" class="form-control pull-right" value="<?=$order_id?>" name="order_id">
                        </div>

                    </div>

                    <div class="form-group col-lg-4">
                        <label class="col-md-4 control-label" for="state-success">使用通道</label>
                        <div class="col-md-8">

                            <select name="pay_mode" id="sel_card_id" class="form-control">

                                <option value="">所有</option>
                                    <?php foreach ($all_channel as $designation) : ?>
                                        <?php if ($designation->channel_status==1) { ?>

                                         <option value="<?php echo $designation->id; ?>"  <?php if($pay_mode == $designation->id) echo 'selected="selected"'?> >

                                        <?php echo $designation->channel_name ?></option>
                                         <?php   } ?>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label class="col-md-4 control-label" for="state-danger">开始时间</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="<?php if(!empty($start_date)) echo $start_date; ?>" name="start_time" id="datepicker">
                                </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="col-md-4 control-label" for="state-danger">结束时间</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="<?php if(!empty($end_date)) echo $end_date; ?>" name="end_time" id="datepicker1">
                                </div>
                        </div>

                        <div class="form-group col-lg-4">
                            <label class="col-md-4 control-label" for="state-success">支付方式</label>
                                <div class="col-md-8">
                                <select name="pay_method" id="sel_card_id" class="form-control">
                                    
                                    <option value="" >所有</option>
                                    <option value="ONLINE" <?php if ($pay_method=="ONLINE") {
                                           echo "selected";
                                    } ?>>网银</option>
                                    <option value="WEIXIN" <?php if ($pay_method=="WEIXIN") {
                                           echo "selected";
                                    } ?>>微信</option>
                                    <option value="TENPAY" <?php if ($pay_method=="TENPAY") {
                                           echo "selected";
                                    } ?>>财付通</option> 
                                    <option value="ALIPAY" <?php if ($pay_method=="ALIPAY") {
                                           echo "selected";
                                    } ?>>支付宝</option> 
                                    <option value="ALIPAYWAP" <?php if ($pay_method=="ALIPAYWAP") {
                                           echo "selected";
                                    } ?>>支付宝WAP</option> 
                                    <option value="WEIXINWAP" <?php if ($pay_method=="WEIXINWAP") {
                                           echo "selected";
                                    } ?>>微信WAP</option> 
                                    <option value="DAIFU" <?php if ($pay_method=="DAIFU") {
                                           echo "selected";
                                    } ?>>代付</option> 
                                </select>                                    
                            </div>
                        </div>

                </div>
                <div class="row">

                        <div class="form-group col-lg-4">
                                <label class="col-md-4 control-label" for="state-danger">订单金额 到：</label>
                                <div class="input-group col-md-8">
                                    <input type="text" class="form-control pull-right" value="<?=$star_price ?>" name="start_price">
                                </div>
                        </div>
                        <div class="form-group col-lg-4">
                                <label class="col-md-4 control-label" for="state-danger">至</label>
                                <div class="input-group col-md-8">
                                    <input type="text" class="form-control pull-right" value="<?=$end_price?>" name="end_price">
                                </div>

                        </div>
                        <div class="form-group col-lg-4">
                                    <label class="col-md-4 control-label" for="state-success">订单状态</label>
                                        <div class="col-md-8">
                                        <select class="form-control select2" name="order_status" style="width: 100%;">
                                            <option value=''>所有</option>
                                            <option <?php if($order_status == '0') echo 'selected="selected"'?> value='0'>处理中</option>                                            
                                            <option <?php if($order_status == '1') echo 'selected="selected"'?> value='1'>成功</option>
                                            <option <?php if($order_status == '4') echo 'selected="selected"'?> value='4'>冻结</option>
                                            <option <?php if($order_status == '-1') echo 'selected="selected"'?> value='-1'>失败</option>
                                            <option <?php if($order_status == '2') echo 'selected="selected"'?> value='2'>手动补单</option>                                           
                                            <option <?php if($order_status == '7') echo 'selected="selected"'?> value='7'>退款成功</option>
                                    </select>
                                </div>
                        </div>
                        </div>
    </div>








                <div class="row" style="margin-bottom:2%;">
                    <div class="col-sm-offset-5 col-sm-4">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-block btn-primary "><i class="fa fa-search"></i>&nbsp;&nbsp; 查询</button>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" id="something" class="btn btn-block btn-primary " onclick="location.reload()"><i class="fa fa-refresh"></i> &nbsp;&nbsp;重置</button>

                        </div>

                        <!-- /.box -->
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label class="col-md-4 control-label" for="state-danger">总成功金额</label>
                        <div class="input-group col-md-8"><?=$sum_succes_price;?>元</div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:2%;">
                    <div>

                        </form>
                        <!-- /.box -->

                        <!-- /.col -->
                        <!-- /.col -->

                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="tab-content">
                <div class="wrap-fpanel">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->form_heading()[60] ?></strong>
                            </div>
                        </div>

                        <!-- Table -->
                        <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th style="width: 3%;">序号</th>
                                    <th>商户ID</th>
                                    <th>订单号码</th>
                                    <th>支付方式</th>
                                    <th>支付通道</th>
                                    <th>提交金额</th>
                                    <th>成功金额</th>
                                    <th>平台收益</th>
                                    <th>代理收益 </th>
                                    <th>商户收益 </th>
                                    <th>提交时间</th>
                                    <th>完成时间</th>
                                    <th>订单状态</th>
                                    <th style="width: 15%;">操作 </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id=0;
                                    if (!empty($orderinfo)): foreach ($orderinfo as $v_application) : ?>
                                <tr>
                                    <?php $id++;?>
                                    <td>
                                        <?php echo $v_application['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $v_application['employee_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_application['order_id']; ?>
                                    </td>
                                    <td>
                                        <?php if ($v_application['pay_method']=="WEIXIN") {
                                            echo "微信";
                                        }elseif($v_application['pay_method']=="TENPAY"){
                                            echo "财付通";
                                        }elseif($v_application['pay_method']=="ALIPAYWAP"){
                                            echo "支付宝WAP";
                                        }elseif($v_application['pay_method']=="ALIPAY"){
                                            echo "支付宝";
                                        }elseif($v_application['pay_method']=="WEIXINWAP"){
                                            echo "微信WAP";
                                        }elseif($v_application['pay_method']=="DAIFU"){
                                            echo "代付";
                                        }else{
                                            echo "网关";
                                            }  ?>
                                    </td>

                                    <td>
                                        <?=$v_application['pay_mode'];?>
                                    </td>
                                    <td>
                                        <?php echo $v_application['real_amount']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_application['ok_real_amount']; ?>
                                        <!-- 提交金额 -->
                                    </td>
                                    <td>
                                        <?php echo $v_application['platform_amount']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_application['agent_amount']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_application['employee_amount']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_application['submit_time']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_application['release_time'] ?>
                                    </td>
                                    <td>
                            <?php if($v_application['order_status']=='1'){
                                echo '<span class="label label-success col-sm-12" style="color: green;"><i class="icon-ok-sign">支付成功</i></span>';
                            }else if($v_application['order_status']=='0') {
                                echo '<span class="label label-primary col-sm-12" type="span" style="color: blue;"><i class="icon-remove">处理中</i></span>';

                            }else if($v_application['order_status']=='4'){
                                echo '<span class="label label-warning col-sm-12" type="span" style="color: red;"><i class="icon-remove">冻结</i></span>';

                            } else if($v_application['order_status']=='5'){
                                echo '<span class="label label-warning col-sm-12" type="span" style="color: red;"><i class="icon-remove">待审核</i></span>';

                            }else if($v_application['order_status']=='2'){
                                echo '<span class="label label-warning col-sm-12" type="span" style="color: red;"><i class="icon-remove">手动补单</i></span>';

                            }else if($v_application['order_status']=='6'){
                                echo '<span class="label label-warning col-sm-12" type="span" style="color: red;"><i class="icon-remove">申请退款</i></span>';

                            }else if($v_application['order_status']=='7'){
                                echo '<span class="label label-warning col-sm-12" type="span" style="color: red;"><i class="icon-remove">退款成功</i></span>';

                            }else if($v_application['order_status']=='-1') {
                                echo '<span class="label label-warning col-sm-12" type="span" style="color: red;"><i class="icon-remove">失败</i></span>';

                            }?></td>

                                    <td>
                                        <?php if ($this->session->userdata('user_type')==7) {
                                           echo btn_view1('admin/order/order_detail/'.$v_application['order_id']);
                                        } else{
                                          if ($v_application['order_status']==1) {
                                            echo btn_view1('admin/order/order_detail/'.$v_application['order_id']);
                                            ?><br><br><?php
                                            echo btn_view('admin/order/order_accept/'.$v_application['id']."/".$v_application['platform_amount']."/".$v_application['agent_amount']);
                                            ?>&nbsp;<?php
                                            echo btn_freeze('admin/order/order_freeze/'.$v_application['id']."/".$v_application['employee_amount']."/".$v_application['agent_amount']);
                                          }elseif ($v_application['order_status']=='7') {
                                            echo btn_view1('admin/order/order_detail/'.$v_application['order_id']);

                                          }elseif ($v_application['order_status']=='4') {
                                            echo btn_view1('admin/order/order_detail/'.$v_application['order_id']);
                                            ?><br><br><?php
                                            echo btn_view4('admin/order/order_retry/'.$v_application['id']."/".$v_application['employee_amount']."/".$v_application['agent_amount']);
                                          }else{
                                            echo btn_view1('admin/order/order_detail/'.$v_application['order_id']);
                                          }
                                        }

               	                        ?>
                                    </td>
                                </tr>
                                <?php  endforeach;
                            ?>

                                <?php else : ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

<form id = "refresh">

</form>

    </div>
    <script>
        $(document).ready(function () {

            $("#btnExport").click(function (e) {
                window.open('data:application/vnd.ms-excel,' + $('#download').html());
                e.preventDefault();
            });
            $('#something').click(function () {
                $('#refresh').submit();
            });
           $('#datepicker').datetimepicker({
              format: 'YYYY-MM-DD HH:mm:ss'


        });
        $('#datepicker1').datetimepicker({

              format: 'YYYY-MM-DD HH:mm:ss'
        });

        });
    </script>
