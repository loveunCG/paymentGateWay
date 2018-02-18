<div class="container-fluid">
    <section class="content-header" style="margin-top: 5%;">
        <h1>
            <bold>接口设置 </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>接口设置</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title"><strong><strong>接口设置</strong></strong>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>代销卡种类</th>
                            <th>对接编码</th>
                            <th>支持面值(元)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id=1;
?>
                        <?php foreach ($card_table as $v_application): ?>
                        <tr>
                            <td class="col-sm-2">
                                <?php echo $id++;
?>
                            </td>
                            <td class="col-sm-4">
                                <?php echo $v_application->bank_id ?>
                            </td>
                            <td class="col-sm-4">
                                <?php echo $v_application->pay_type ?>
                            </td>
                            <td class="col-sm-2">
                                <?php echo $v_application->pay_price_type ?>
                            </td>
                        </tr>
                        <?php endforeach;
?>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>代销卡种类</th>
                                <th>对接编码</th>
                                <th>支持面值(元)</th>
                            </tr>
                        </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.row -->
    </section>
    <script>
        $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            }

        );
    </script>