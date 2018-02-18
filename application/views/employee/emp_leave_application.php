<div class="container-fluid">
    <div class="col-md-12">
        <?php include_once 'asset/admin-ajax.php'; ?>
        <?php echo message_box('success'); ?>
        <?php echo message_box('error'); ?>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
        <h4>
            <?php echo anchor('employee/dashboard/apply_leave_application', '<i class="fa fa-plus"></i> 点卡提交'); ?></h4>
        <br/>
        <div class="row">
            <div class="col-sm-12">
                <div class="tab-content">
                    <div class="wrap-fpanel">
                        <div class="panel panel-info">


                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>提交记录</strong>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>订单号码</th>
                                                <th>订单类型</th>
                                                <th>订单金额</th>
                                                <th>订单状态</th>
                                                <th>提交时间</th>
                                                <th>成功金额</th>
                                            </tr>
                                        </thead>
                                        <tbody style="margin-bottom: 0px;background: #FFFFFF;">
                                            <?php if (!empty($order_data)): foreach ($order_data as $v_application) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo $v_application->order_id ?>
                                                </td>
                                                <td>
                                                    <?php echo $v_application->pay_type ?>
                                                </td>
                                                <td>
                                                    <?php echo $v_application->real_amount ?>
                                                </td>
                                                <td>
                                                    <?php if($v_application->status==0){
                                            echo '<span class="label label-success col-sm-12">成功</span>';
                                    }elseif ($v_application->status==1){
                                            echo '<span class="label label-primary col-sm-12">处理中</span>';

                                        }else{
                                            echo '<span class="label label-danger col-sm-12">失败</span>';
                                        }?></td>
                                                <td>
                                                    <?php echo $v_application->submit_time; ?>
                                                </td>
                                                <td>
                                                    <?php if($v_application->succes_price){
                                    echo $v_application->succes_price;}
                                    else{
                                   echo '<span class="label label-primary col-sm-12">处理中</span>';

                                    } ?></td>
                                            </tr>
                                            <?php
                            endforeach;
                            ?>
                                                <?php else : ?>

                                                <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>