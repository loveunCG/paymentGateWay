<br>
<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
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
                                <div class="form-group col-lg-6">
                                    <label class="col-md-3 control-label" for="state-danger">开始时间</label>
                                    <div class="input-group col-md-9">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" name="start_time" value="<?=$start_time?>"id="datepicker">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-md-3 control-label" for="state-danger">结束时间</label>
                                    <div class="input-group col-md-9">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" name="end_time" value="<?=$end_time?>" id="datepicker1">
                                    </div>

                                </div>

                                <div class="form-group col-lg-4">
                                    <label class="col-md-3 control-label" for="state-success">提现状态：</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="delivery_status" style="width: 100%;">
                                            <option  value="-1">---所有---</option>
                                            <option <?php if($delivery_status=='0') echo 'selected="selected"'; ?> value="0">等待审核</option>
                                            <option <?php if($delivery_status=='1') echo 'selected="selected"'; ?> value="1">审核通过</option>
                                            <option <?php if($delivery_status=='2') echo 'selected="selected"'; ?> value="2">付款完成</option>
                                            <option <?php if($delivery_status=='3') echo 'selected="selected"'; ?> value="3">审核拒绝</option>
                                        </select>
                                    </div>
                                </div>
                                   <div class="form-group col-lg-4">
                                <label class="col-md-3 control-label" for="state-danger">银行卡号</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-credit-card-alt"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="delivery_bank_card" value="<?=$delivery_bank_card?>" >
                                </div>

                            </div>
                                <div class="form-group col-lg-4">
                                    <label class="col-md-3 control-label" for="state-danger">收款人</label>
                                    <div class="input-group col-md-9">
                                        <div class="input-group-addon">
                                            <i class="fa fa-credit-card-alt"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" name="order_num">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-block btn-primary btn-flat"><i class="fa fa-search"></i> 查询</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" id="something" onclick = "update()" class="btn btn-block btn-primary btn-flat"><i class="fa fa-refresh"></i> 重置</button>

                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" id="btnExport" class="btn btn-block btn-primary btn-flat"><i class="fa fa-download"></i> 下载</button>

                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
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
                                    <th>银行名称</th>
                                    <th>收款账号</th>
                                    <th>收款人</th>
                                    <th>提现金额</th>
                                    <th data-sortable=false>手续费用</th>
                                    <th>提现时间</th>
                                    <th>提现状态</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                     $id = 0;
                     foreach ($withdraw_data as $v_events) { ?>
                                    <tr>
                                        <td>
                                            <?php $id ++;
                                        echo $v_events->id;
                             ?>
                                        </td>
                                        <td>
                                            <?php echo $v_events->delivery_bank_name ?>
                                        </td>
                                        <td>
                                            <?php echo $v_events->delivery_bank_card ?>
                                        </td>
                                        <td>
                                            <?php echo $v_events->delivery_name?>
                                        </td>
                                        <td>
                                            <?php echo $v_events->delivery_mount + $v_events->fee?>
                                        </td>
                                        <td>
                                            <?php echo $v_events->fee ?>
                                        </td>
                                        <td>
                                            <?php echo $v_events->create_time; ?>
                                        </td>
                                        <td>
                                            <?php if($v_events->delivery_status==2){
                                                 echo '<span class="label label-primary  col-sm-12" >付款完成</span>';
                                            }elseif($v_events->delivery_status==0){
                                                  echo '<span class="label label-primary col-sm-12">等待审核</span>';

                                            }elseif($v_events->delivery_status==1){
                                                echo '<span class="label label-primary col-sm-12" >审核通过</span>';
                                            }else{
                                                echo '<span class="label  col-sm-12" >'.btn_view2('employee/dashboard/immediate_reason/'.$v_events->id).'</span>';

                                            } ?>
                                        </td>
                                        <?php  }
                            ?>
                                    </tr>
                                    <tfoot>
                                        <tr>
                                            <th>序号</th>
                                            <th>银行名称</th>
                                            <th>收款账号</th>
                                            <th>收款人</th>
                                            <th>提现金额</th>
                                            <th>手续费用</th>
                                            <th>提现时间</th>
                                            <th>提现状态</th>
                                        </tr>
                                    </tfoot>
                        </table>
                    </div>
                </div>

        </div>

</div>
<!-- /.box-body -->
<!-- /.row -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->
<!-- Control Sidebar -->
</div>


<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
        $('#something').click(function () {
            location.reload();
        });
         $('#datepicker').datetimepicker({
              format: 'YYYY-MM-DD HH:mm:ss'


        });
        $('#datepicker1').datetimepicker({

              format: 'YYYY-MM-DD HH:mm:ss'
        });


    });
</script>
