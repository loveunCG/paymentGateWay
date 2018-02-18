<div class="container-fluid">

    <section class="content-header" style="margin-top: 5%;">
        <h1>
            <bold>提现管理 </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 提现管理</a></li>
            <li><a href="#">提现记录</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- <div class="row"> -->
        <!-- /.box-header -->
          <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-search"></i>&nbsp;查询</h4>
                </div>
                <div class="panel-body form-horizontal">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label class="col-md-3 control-label" for="state-danger">开始时间</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="start_time" id="datepicker">
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="col-md-3 control-label" for="state-danger">结束时间</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="end_time" id="datepicker1">
                                </div>

                            </div>
                            <div class="form-group col-lg-3">
                                <label class="col-md-3 control-label" for="state-success">使用通道</label>
                                <div class="col-md-9">
                                    <select class="form-control select2" name="channel_id" style="width: 100%;">
                                            <option selected="selected" value="0">选择通道</option>
                                            <option value="1">工商银行</option>
                                            <option value="2">招商银行</option>
                                            <option value="3">农业银行</option>
                                            <option value="4">建设银行</option>
                                            <option value="5">北京银行</option>
                                            <option value="6">中国银行</option>
                                            <option value="7">交通银行</option>
                                            <option value="8">兴业银行</option>
                                            <option value="9">南京银行</option>
                                            <option value="10">民生银行</option>
                                            <option value="11">光大银行</option>
                                            <option value="12">平安银行</option>
                                            <option value="13">渤海银行</option>
                                            <option value="14">东亚银行</option>
                                            <option value="15">宁波银行</option>
                                            <option value="16">中信银行</option>
                                            <option value="17">广发银行</option>
                                            <option value="18">上海银行</option>
                                            <option value="19">上海浦东发展银行</option>
                                            <option value="20">中国邮政</option>
                                            <option value="21">华夏银行</option>
                                            <option value="22">北京农村商业银行</option>
                                            <option value="23">上海农商银行</option>
                                            <option value="43">深圳发展银行</option>
                                            <option value="44">浙江稠州商业银行</option>
                                            <option value="45">光宇一卡通</option>
                                            <option value="24">骏网一卡通</option>
                                            <option value="25">盛大卡</option>
                                            <option value="26">神州行</option>
                                            <option value="27">征途卡</option>
                                            <option value="28">QQ卡</option>
                                            <option value="29">联通卡</option>
                                            <option value="30">久游卡</option>
                                            <option value="31">网易卡</option>
                                            <option value="32">完美卡</option>
                                            <option value="33">搜狐卡</option>
                                            <option value="34">电信卡</option>
                                            <option value="35">纵游一卡通</option>
                                            <option value="36">天下一卡通</option>
                                            <option value="37">天宏一卡通</option>
                                            <option value="38">盛付通卡</option>
                                            <option value="39">32卡</option>
                                            <option value="40">支付宝余额</option>
                                            <option value="41">财付通余额</option>
                                            <option value="42">微信扫码</option>
                                            <option value="46">手机支付宝</option>
                                            <option value="49">WAP微信</option>
                                            <option value="50">代付</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="col-md-3 control-label" for="state-success">订单类型</label>
                                <div class="col-md-9">
                                    <select class="form-control select2" name="order_type" style="width: 100%;">
                                            <option selected="selected" value="0">所有</option>
                                            <option value="1">网银</option>
                                            <option value="2">点卡</option>
                                            <option value="3">支付宝</option>
                                            <option value="4">财付通</option>
                                            <option value="5">微信</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-md-3 control-label" for="state-success">订单状态</label>
                                <div class="col-md-9">
                                    <select class="form-control select2" name="order_status" style="width: 100%;">
                                        <option value="3">选择状态</option>
                                        <option value="1">支付中</option>
                                        <option selected="selected" value="0">成功</option>
                                        <option value="-1">失败</option>
                                        <option value="2">冻结</option>
                                        <option value="-2">已退款</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-md-3 control-label" for="state-danger">订单号</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-credit-card-alt"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="order_num">
                                </div>

                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-md-3 control-label" for="state-danger">充值卡号</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-credit-card-alt"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="recharge_card_num">
                                </div>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-block btn-primary btn-flat"><i class="fa fa-search"></i>&nbsp;&nbsp; 查询</button>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" id="something" class="btn btn-block btn-primary btn-flat"><i class="fa fa-refresh"></i> &nbsp;&nbsp;重置</button>

                                </div>
                                <div class="col-sm-4">
                                    <button type="button" id="btnExport" class="btn btn-block btn-primary btn-flat"><i class="fa fa-download"></i> &nbsp;&nbsp;下载</button>

                                </div>
                                <!-- /.box -->
                            </div>
                        </div>

                    </form>
                    <!-- /.box -->

                    <!-- /.col -->
                    <!-- /.col -->

                </div>
            </div>
        </div>
    </div>
        <div class = "row">
        <div class="panel panel-info">

            <div class="panel-heading">
                <div class="panel-title">
                    <strong><strong>提现记录</strong></strong>
                </div>
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>序号</th>
                            <th>提现金额</th>
                            <th>手续费用</th>
                            <th>提现时间</th>
                            <th>支付时间</th>
                            <th>支付状态</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php
                     $id = 0;
                     foreach ($withdraw_data as $v_events) { ?>
                            <tr>
                                <td>
                                    <?php $id ++; 
                             echo $id;
                             ?>
                                </td>
                                <td>
                                    <?php echo $v_events->delivery_mount ?>
                                </td>
                                <td>
                                    <?php echo $v_events->delivery_rate ?>
                                </td>
                                <td>
                                    <?php echo $v_events->delivery_time; ?>
                                </td>
                                <td>
                                    <?php echo $v_events->delivery_time; ?>
                                </td>
                                <td>
                                    <?php if($v_events->delivery_status==1){
                            echo "成功";}elseif($v_events->delivery_status==0){
                                echo "处理中"; 
                            
                            }else{
                                echo "失败"; 
                            } ?>
                                </td>
                                <?php  }
                            ?>
                            </tr>
                            <tfoot>
                                <tr>
                                    <th>序号</th>
                                    <th>提现金额</th>
                                    <th>手续费用</th>
                                    <th>提现时间</th>
                                    <th>支付时间</th>
                                    <th>支付状态</th>
                                </tr>
                            </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
            <!-- </div> -->
   
   
    
    
    
       </div>
    </section>



    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
</div>
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });       
         $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

</script>