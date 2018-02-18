<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<h4><?php echo anchor('admin/employee/add_employee_group', '<i class="fa fa-plus"></i> 添加商户组'); ?></h4>
<br/>
<div class="row">
    <div class="col-sm-12" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
                        <strong>商户组管理</strong>
                    </span>
                </div>
            </div>
            <!-- Table -->

            <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="col-sm-1">ID</th>
                        <th>商户组名称</th>
                        <th>备注</th>
                        <th>管理操作</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employee_info as $v_award_info): ?>
                            <tr>
                                <td><?php echo $v_award_info->id ?></td>
                                <td><?php echo $v_award_info->group_name ?></td>
                                <td><?php echo $v_award_info->group_details; ?></td>

                                <td>
                                    <?php echo btn_edit('admin/employee/add_employee_group/' . $v_award_info->id ); ?>
                                    <?php echo btn_delete('admin/employee/delete_employee_group/' . $v_award_info->id); ?>
                                </td>
                            </tr>                   
                        <?php endforeach; ?>                    
                </tbody>
            </table>
        </div>
    </div>
</div>
