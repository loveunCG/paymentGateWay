<div class="container-fluid">
    <section class="content-header" style="margin-top: 5%;">
        <h1>
            <bold>财务管理 </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 财务管理</a></li>
            <li><a href="#">资金流水</a></li>
        </ol>
    </section>
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="panel panel-info">
                    <!-- Default panel contents -->

                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>资金流水</strong>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>记录时间</th>
                                    <th>金额类型</th>
                                    <th>提交金额</th>
                                    <th>收益/支出 </th>
                                    <th>费用</th>
                                    <th>余额</th>
                                    <th>备注</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($all_info as $v_award) : ?>
                                <tr>
                                    <td>
                                        <?php echo $v_award['finance_time']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_award['finance_name'];?>
                                    </td>
                                    <td>
                                        <?php echo $v_award['finance_amount']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_award['finance_type']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_award['finance_balance']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_award['finance_submit']; ?>
                                    </td>
                                    <td>
                                        <?php echo $v_award['finance_remarks']; ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
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
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
