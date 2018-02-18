<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row margin">
    <!--<div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/card/add_card/', '<i class="fa fa-plus"></i>'.  $this->language->form_heading()[40] ); //echo "<pre>"; print_r($this->language->from_body())?></h4>
    </div>-->

</div>
<!-- Table -->

<div class="col-lg-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-search"></i>&nbsp;查询</h4>
        </div>
        <div class="panel-body form-horizontal">
            <form action="" method="post">
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label class="col-md-4 control-label" for="state-danger">商户ID</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control pull-right" value="<?=$employee_id?>" name="employee_id">
                        </div>

                    </div>

                    <div class="form-group col-lg-3">
                        <label class="col-md-4 control-label" for="state-danger">订单号</label>
                        <div class="input-group col-md-8">

                            <input type="text" class="form-control pull-right" value="<?=$order_id?>" name="order_id">
                        </div>

                    </div>

<!--                     <div class="form-group col-lg-3">
                        <label class="col-md-4 control-label" for="state-danger">通知状态</label>
                        <div class="input-group col-md-8">
                        <select class="form-control select2" name="order_type1" style="width: 100%;">
                        <option value = "-1" selected="selected">所有</option>
                        <option value="1">未发送</option>
                        <option value="2">成功</option>
                        <option value="3">失败</option>
                        </select>
                        </div>

                    </div> -->


                    <div class="form-group col-lg-3">
                        <label class="col-md-4 control-label" for="state-success">使用通道</label>
                        <div class="col-md-8">

                            <select name="pay_mode" id="sel_card_id" class="form-control">
                                <option value="">选择通道</option>
                                    <?php foreach ($all_channel as $designation) : ?>
                                        <?php if ($designation->channel_status==1) { ?>
                                         <option value="<?php echo $designation->id; ?>"  <?php if($pay_mode == $designation->id) echo 'selected="selected"'?>>

                                        <?php echo $designation->channel_name ?></option>
                                         <?php   } ?>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                                </div>


                    </div>
                    <div class="row">
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-4 control-label" for="state-danger">开始时间</label>
                                    <div class="input-group col-md-8">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="<?php if(!empty($start_date)) echo $start_date; ?>" name="start_time" id="datepicker">
                                    </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-4 control-label" for="state-danger">结束时间</label>
                                    <div class="input-group col-md-8">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value="<?php if(!empty($end_date)) echo $end_date; ?>" name="end_time" id="datepicker1">
                                    </div>

                                    </div>

                                    <div class="form-group col-lg-3">
                                    <label class="col-md-4 control-label" for="state-success">支付方式</label>
                                    <div class="col-md-8">

                                    <select name="banktype" id="sel_card_id" class="form-control">
                                        <option value="">选择支付方式</option>
                                                    <?php foreach ($all_channel as $designation) : ?>
                                                        <?php if ($designation->parent==1) { ?>
                                                        <option value="<?php echo $designation->id; ?>"  <?php if($banktype == $designation->id) echo 'selected="selected"'?>>
                                                        <?php echo $designation->gateway_name ?></option>
                                                        <?php   } ?>
                                                    <?php endforeach; ?>


                                    </select>
                                    </select>
                                    </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-4 control-label" for="state-success">订单状态</label>
                                        <div class="col-md-8">
                                        <select class="form-control select2" name="order_status" style="width: 100%;">
                                            <option value=''>选择状态</option>
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

                                    </div>
                                    </div>



                                    <div class="row" style="margin-bottom:2%;">
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-4">
                                    <div class="col-sm-4">
                                    <button type="submit" class="btn btn-block btn-primary "><i class="fa fa-search"></i>&nbsp;&nbsp; 查询</button>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" id="something" class="btn btn-block btn-primary " onclick = "location.reload()"><i class="fa fa-refresh"></i> &nbsp;&nbsp;重置</button>

                                </div>


                                <!-- /.box -->
                                </div>

                                </div>

                                <div class="row" style = "margin-bottom:1px;">
                                    <div>

                                    </form>
                                    <!-- /.box -->

                                    <!-- /.col -->
                                    <!-- /.col -->

                                    </div>
                                    </div>
                                    </div>
                                    </div>
<div class = "container-fluid">
    </div>
<div class="container-fluid">
    <table class="table table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>序号</th>
                <th>商户ID</th>
                <th>订单号码</th>
                <th>支付方式</th>
                <th>支付通道</th>
                <th>提交金额</th>
                <th>成功金额</th>
                <th>平台收益</th>
                <th>商户收益 </th>
                <th>提交时间</th>
                <th>通知状态 </th>
                <th>下发状态 </th>
                <th>操作 </th>

            </tr>
        </thead>
        <tbody>
            <?php $id=0;
            if (!empty($orderinfo)): foreach ($orderinfo as $v_application) :
                if($v_application['order_status']==2){

                ?>
            <tr>
                    <?php                 $id++;?>
                 <td>
                    <?php echo $id ?>
                </td>
                 <td>
                    <?php echo $v_application['employee_id']; ?>
                </td>
                <td>
                    <?php echo $v_application['order_id']; ?>
                </td>
                <td>
                    <?php echo $v_application['banktype'];  ?>
                </td>

                <td>
                    <?=$v_application['pay_mode'];?>
                    </td>
                <td>
                    <?php echo $v_application['real_amount']; ?>
                </td>
                <td>
                    <?php echo $v_application['ok_real_amount']; ?>
                </td>
                <td>
                    <?php echo $v_application['platform_amount']; ?>
                </td>
                <td>
                    <?php echo $v_application['employee_amount']; ?>
                </td>
                <td>
                    <?php echo $v_application['submit_time']; ?>
                </td>
                <td>
                    <?php if($v_application->cha_status==1){
                                            echo '<span class="label label-success col-sm-12">连接</span>';
                                    }elseif ($v_application->cha_status==0){
                                            echo '<span class="label label-primary col-sm-12" type="span">非连接</span>';

                                        }?>
                </td>
                <td>
                    <?php if($v_application->cha_status==1){
                                            echo '<span class="label label-success col-sm-12"><i class="icon-ok-sign">是</i></span>';
                                    }elseif ($v_application->cha_status==0){
                                            echo '<span class="label label-primary col-sm-12" type="span"><i class="icon-remove">否</i></span>';

                                        }?>
                </td>
               	<td>
                    <?php if($this->session->userdata('user_type')==7) {
                            echo btn_view1('admin/order/order_detail/'.$v_application['order_id']);
                    }else{
                            echo btn_view1('admin/order/order_detail/'.$v_application['order_id']);
                            echo btn_passive_pro('admin/order/passive_proc/'.$v_application['order_id']);
                            echo btn_freeze('admin/order/order_freeze/'.$v_application['order_id']); }
                    ?>

                </td>
            </tr>
            <?php }
            endforeach;
                            ?>

            <?php
            else : ?>

            <?php endif; ?>
        </tbody>
    </table>
</div>
<form id = "refresh">

</form>


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
