<script src="<?php echo base_url(); ?>asset/employee/excel/FileSaver.js">
</script>
<script src="<?php echo base_url(); ?>asset/employee/excel/tableexport.js"></script>
<!--<script src="<?php echo base_url(); ?>asset/employee/excel/xls.core.js"></script>-->
<script src="<?php echo base_url(); ?>asset/employee/excel/xlsx.core.js"></script>

<script src="<?php echo base_url(); ?>asset/employee/excel/Blob.js"></script>
<link href="<?php echo base_url(); ?>asset/employee/excel/tableexport.css" rel="stylesheet">
<div class="container-fluid">

    <section class="content-header" style="margin-top: 5%;">
        <h1>
            <bold>订单查询 </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 订单管理</a></li>
            <li><a href="#">订单查询</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <div class="row">
        <br>
        <?php echo message_box('success'); ?>
        <?php echo message_box('error');  ?>
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-search"></i>&nbsp;查询</h4>
                </div>
                <div class="panel-body form-horizontal">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label class="col-md-3 control-label" for="state-danger">开始时间</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="<?php if(!empty($start_date)) echo $start_date; ?>" name="start_time"
                                        id="datepicker">
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-md-3 control-label" for="state-danger">结束时间</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="<?php if(!empty($end_date)) echo $end_date; ?>" name="end_time"
                                        id="datepicker1">
                                </div>

                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-md-3 control-label" for="state-success">支付方式</label>
                                <div class="col-md-9">
                                    <select name="pay_method" class="form-control select2">
                                      <option value="" >所有</option>
                                      <option <?php if($pay_method == "ONLINE" ){
                                        echo 'selected="selected"';
                                      }?> value="ONLINE" >网银</option>
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
                                    <!-- <select class="form-control select2" name="pay_mode" style="width: 100%;">
                                            <option value="-1">选择通道</option>
                                                <?php foreach ($channel_name as $v_category){ ?>
                                                <?php if($v_category->channel_name!=""){ ?>
                                                    <option value="<?php
                                                    echo $v_category->id ?>"<?php if($pay_mode ==$v_category->id){
                                                        echo 'selected="selected"';
                                                    }?>>
                                                        <?php echo $data = $v_category->channel_name; ?></option>

                                                            <?php
                                                            }

                                                            ?>
                                                <?php }
                                                ?>
                                            </select> -->
                                </div>
                            </div>
                            <!--
                            <div class="form-group col-lg-3">
                                <label class="col-md-4 control-label" for="state-success">订单类型</label>
                                <div class="col-md-8">
                                    <select class="form-control select2" name="use_online" style="width: 100%;">
                                            <option value="-1">所有</option>
                                            <option <?php if($use_online == '1') echo 'selected="selected"'?> value="1">网银</option>
                                            <option <?php if($use_online == '2') echo 'selected="selected"'?>  value="2">支付宝</option>
                                            <option  <?php if($use_online == '3') echo 'selected="selected"'?> value="3">财付通</option>
                                            <option <?php if($use_online == '5') echo 'selected="selected"'?>  value="5">微信</option>
                                    </select>
                                </div>
                            </div>
-->
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="col-md-3 control-label" for="state-success">订单状态</label>
                            <div class="col-md-9">
                                <select class="form-control select2" name="order_status" style="width: 100%;">
                                        <option <?php if($order_status == '') echo 'selected="selected"'?> value="">选择状态</option>
                                        <option <?php if($order_status == '0') echo 'selected="selected"'?> value='0'>处理中</option>
                                        <option <?php if($order_status == '5') echo 'selected="selected"'?> value='5'>待审核</option>
                                        <option <?php if($order_status == '1') echo 'selected="selected"'?> value='1'>成功</option>
                                        <option <?php if($order_status == '4') echo 'selected="selected"'?> value='4'>冻结</option>
                                        <option <?php if($order_status == '-1') echo 'selected="selected"'?> value='-1'>失败</option>
                                        <option <?php if($order_status == '2') echo 'selected="selected"'?> value='2'>手动补单</option>
                                        <option <?php if($order_status == '6') echo 'selected="selected"'?> value='6'>申请退款</option>
                                        <option <?php if($order_status == '7') echo 'selected="selected"'?> value='7'>退款成功</option>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="col-md-3 control-label" for="state-danger">订单号</label>
                            <div class="input-group col-md-9">
                                <div class="input-group-addon">
                                    <i class="fa fa-credit-card-alt"></i>
                                </div>
                                <input type="text" class="form-control pull-right" value="<?php if(!empty($order_id)) echo $order_id; ?>" name="order_num">
                            </div>

                        </div>

                </div>



                <div class="row" style="margin-bottom:2%;">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-block btn-primary "><i class="fa fa-search"></i> 查询</button>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" id="something" class="btn btn-block btn-primary "><i class="fa fa-refresh"></i> 重置</button>

                        </div>
                        <div class="col-sm-4">
                            <input style="margin-left: 5%;" type="button" class="btn btn-primary" value="手动补单处理" onclick="javascript:window.location.href='<?=base_url();?>employee/dashboard/passive_order'"><br><br>

                        </div>

                        <!-- /.box -->
                    </div>
                </div>
                <div class="row" style="margin-bottom:2%;">
                    <div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
        <?php
		foreach ($search_order as $v_application){
      if($v_application->order_status==1){
			$liyi_amount = $liyi_amount + $v_application->real_amount*($v_application->employee_fee/100);
    }
		}

		?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong>&nbsp;&nbsp;&nbsp;商户收益:&nbsp;<?php  if($liyi_amount!=null){
                    echo round($liyi_amount, 2);
                    }else{
                    echo "0.00";
                    } ?>&nbsp;￥ </strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>订单号码</th>
                                        <th>充值方式</th>
                                        <th>订单金额</th>
                                        <!-- <th>实际金额</th> -->
                                        <th>用户金额</th>
                                        <!-- <th>支付通道</th> -->
                                        <th>完成时间</th>
                                        <th>订单</th>
                                        <th>操作</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($search_order)): foreach ($search_order as $v_application) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $v_application->order_id ?>
                                        </td>
                                        <td>


                                            <?php  if($v_application->pay_method == 'ALIPAY'){
                                        echo "支付宝";

                                }
                                elseif($v_application->pay_method == 'TENPAY'){
                                    echo "财付通";


                                }elseif($v_application->pay_method == 'WEIXIN'){
                                    echo "微信";


                                }elseif($v_application->pay_method == 'WEIXINWAP'){
                                    echo "微信WAP";


                                }elseif($v_application->pay_method == 'ALIPAYWAP'){
                                    echo "支付宝WAP";


                                }else{
                                    echo "网银";


                                }


                                     ?>

                                        </td>
                                        <td>
                                            <?php echo $v_application->real_amount ?>
                                        </td>
                                        <td>
                                            <?php echo $v_application->real_amount*$v_application->employee_fee/100; ?>
                                        </td>
                                        <td>
                                            <?php echo $v_application->release_time ?>
                                        </td>
                                        <td>
                                            <?php if($v_application->order_status==1){
                                            echo '<span class="label label-success col-sm-12">成功</span>';
                                    }elseif ($v_application->order_status== '0'){
                                            echo '<span class="label label-primary col-sm-12">处理中</span>';
                                        }elseif ($v_application->order_status== '5'){
                                            echo '<span class="label label-danger col-sm-12">退款成功</span>';
                                        }elseif ($v_application->order_status== '7'){
                                            echo '<span class="label label-danger col-sm-12">退款成功</span>';
                                        }elseif($v_application->order_status == '2'){
                                            echo '<span class="label label-danger col-sm-12">手动处理中</span>';
                                        }elseif($v_application->order_status == '6'){
                                            echo '<span class="label label-danger col-sm-12">申请退款</span>';

                                        }elseif ($v_application->order_status == '4') {
                                          echo '<span class="label label-danger col-sm-12">冻结</span>';
                                        }else{
                                            echo '<span class="label label-danger col-sm-12">失败</span>';

                                            }?></td>
                                        <td>
                                            <?php if($v_application->order_status=='1'){
                                            echo '<span class="label  col-sm-12">'.btn_view_oreder('employee/dashboard/order_view/'.$v_application->order_id).'</span>';

                                    }elseif ($v_application->order_status=='0'){
                                      echo '<span class="label  col-sm-12">'.btn_view_oreder('employee/dashboard/order_view/'.$v_application->order_id).'</span>';
                                        }else{
                                          echo '<span class="label  col-sm-12">'.btn_view_oreder('employee/dashboard/order_view/'.$v_application->order_id).'</span>';
                                        }?>
                                        </td>
                                    </tr>
                                    <?php  endforeach;
                            ?>

                                    <?php else : ?>
                                    <?php endif; ?>

                                </tbody>
                        </div>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>

            </div>
    </div>
    <form id="refresh" action="" method="post">

    </form>

</div>
</div>

<script>
    $(document).ready(function () {

        $('#dataTables-example').DataTable({
            responsive: true
        });
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