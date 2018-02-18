
<script src="<?php echo base_url(); ?>asset/employee/excel/FileSaver.js"></script>
<script src="<?php echo base_url(); ?>asset/employee/excel/tableexport.js"></script>
<!--<script src="<?php echo base_url(); ?>asset/employee/excel/xls.core.js"></script>-->
<script src="<?php echo base_url(); ?>asset/employee/excel/xlsx.core.js"></script>

<script src="<?php echo base_url(); ?>asset/employee/excel/Blob.js"></script>
<link href="<?php echo base_url(); ?>asset/employee/excel/tableexport.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row" style="margin-top: 5%;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><strong>登录日志</strong></strong>
                </div>
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                    <thead style="background: #2cabe3;">
                        <tr>
                            <th>NO</th>
                            <th>登录时间(只显示30天记录)</th>
                            <th>登录IP</th>
                            <th>登录地点</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 1;
                        foreach($emp_log as $val){ ?>
                        <tr>
                            <td>
                                <?php echo $id++; ?>
                            </td>
                            <td>
                                <?php echo $val->login_time; ?>
                            </td>
                            <td>
                                <?php echo $val->ip; ?> </td>
                            <td>
                                <?php if($val->login_status=='1'){
                                        echo "登记成功";
                                    }else{
                                        echo "登记失败";
                                    } ?>
                            </td>

                        </tr>
                        <?php }?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<table class="table" id="table_export" style="display: none;">

    <thead>
        <tr>
            <th>NO</th>
            <th>登录时间(只显示30天记录)</th>
            <th>登录IP</th>
            <th>登录地点</th>
        </tr>
    </thead>
    <tbody>
        <?php $id = 1;
                        foreach($emp_log as $val){ ?>
        <tr>
            <td>
                <?php echo $id++; ?>
            </td>
            <td>
                <?php echo $val->login_time; ?>
            </td>
            <td>
                <?php echo $val->ip; ?> </td>
            <td>
                <?php if($val->login_status=='1'){
                                        echo "登记成功";
                                    }else{
                                        echo "登记失败";
                                    } ?>
            </td>

        </tr>
        <?php }?>

    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });    
</script>