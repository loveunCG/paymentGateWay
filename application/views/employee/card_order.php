<div class="container-fluid">
    <div class="row" style="margin-top:5%;">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-search"></i>&nbsp;查询</h4>
                </div>
                <div class="panel-body form-horizontal">
                    <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-lg-1"></div>
                            <div class="form-group col-lg-5">
                                <label class="col-md-3 control-label" for="state-danger">开始时间</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value = "<?=$start_time?>" name="start_time" id="datepicker">
                                </div>
                            </div>
                            <div class="form-group col-lg-5">
                                <label class="col-md-3 control-label" for="state-danger">结束时间</label>
                                <div class="input-group col-md-9">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" value = "<?=$end_time?>" name="end_time" id="datepicker1">
                                </div>

                            </div>

                        </div>



                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-block btn-primary btn-flat"><i class="fa fa-search"></i>&nbsp;查询</button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" id="something" class="btn btn-block btn-primary btn-flat"><i class="fa fa-refresh"></i>&nbsp;重置</button>

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

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">销卡订单</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-search"></span> 查询</button>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" placeholder="订单号码" disabled></th>
                            <th><input type="text" placeholder="订单金额" disabled></th>
                            <th><input type="text" placeholder="实际金额" disabled></th>
                            <th><input type="text" placeholder="用户金额" disabled></th>
                            <th><input type="text" placeholder="支付通道" disabled></th>
                            <th><input type="text" placeholder="支付时间" disabled></th>
                            <th><input type="text" placeholder="订单状态" disabled></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($order_data)): foreach ($order_data as $v_application) : ?>
                        <tr>
                            <td>
                                <?php echo $v_application->order_id ?>
                            </td>
                            <td>
                                <?php echo $v_application->real_amount ?>
                            </td>
                            <td>
                                <?php echo $v_application->real_amount*0.9; ?>
                            </td>
                            <td>
                                <?php echo $v_application->usr_amount ?>
                            </td>
                            <td>
                                <?php echo $v_application->channel_name ?>
                            </td>
                            <td>
                                <?php echo $v_application->submit_time;?>
                            </td>
                            <td>
                                <?php if($v_application->order_status==1){
                                            echo '<span class="label label-success col-sm-12">成功</span>';
                                    }elseif ($v_application->order_status==0){
                                            echo '<span class="label label-primary col-sm-12">处理中</span>';
                                        }elseif ($v_application->order_status==2){
                                            echo '<span class="label label-primary col-sm-12">派出中</span>';
                                        }else{
                                            echo '<span class="label label-danger col-sm-12">失败</span>';
                                        }?></td>

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



<script>
    /*
            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
            */       
                $(document).ready(function () {
                    $('.filterable .btn-filter').click(function () {
                        var $panel = $(this).parents('.filterable'),
                            $filters = $panel.find('.filters input'),
                            $tbody = $panel.find('.table tbody');
                        if ($filters.prop('disabled') == true) {
                            $filters.prop('disabled', false);
                            $filters.first().focus();
                        } else {
                            $filters.val('').prop('disabled', true);
                            $tbody.find('.no-result').remove();
                            $tbody.find('tr').show();
                        }
                    });




                    $('#dataTables-example').DataTable({
                        responsive: true
                    });

                    $('.filterable .filters input').keyup(function (e) {
                        /* Ignore tab key */
                        var code = e.keyCode || e.which;
                        if (code == '9') return;
                        /* Useful DOM data and selectors */
                        var $input = $(this),
                            inputContent = $input.val().toLowerCase(),
                            $panel = $input.parents('.filterable'),
                            column = $panel.find('.filters th').index($input.parents('th')),
                            $table = $panel.find('.table'),
                            $rows = $table.find('tbody tr');
                        /* Dirtiest filter function ever ;) */
                        var $filteredRows = $rows.filter(function () {
                            var value = $(this).find('td').eq(column).text().toLowerCase();
                            return value.indexOf(inputContent) === -1;
                        });
                        /* Clean previous no-result if exist */
                        $table.find('tbody .no-result').remove();
                        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                        $rows.show();
                        $filteredRows.hide();
                        /* Prepend no-result row if all rows are filtered */
                        if ($filteredRows.length === $rows.length) {
                            $table.find('tbody').prepend($(
                                '<tr class="no-result text-center"><td colspan="' +
                                $table.find('.filters th').length +
                                '">No result found</td></tr>'));
                        }
                    });
                    $('#datepicker').datetimepicker({
              format: 'YYYY-MM-DD HH:mm:ss'


        });
        $('#datepicker1').datetimepicker({
            
              format: 'YYYY-MM-DD HH:mm:ss'
        });
                    $('#something').click(function () {
                        location.reload();
                    });

                });
</script>
<style>
    .filterable {
        margin-top: 15px;
    }

    .filterable .panel-heading .pull-right {
        margin-top: -20px;
    }

    .filterable .filters input[disabled] {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
    }

    .filterable .filters input[disabled]::-webkit-input-placeholder {
        color: #333;
    }

    .filterable .filters input[disabled]::-moz-placeholder {
        color: #333;
    }

    .filterable .filters input[disabled]:-ms-input-placeholder {
        color: #333;
    }
</style>