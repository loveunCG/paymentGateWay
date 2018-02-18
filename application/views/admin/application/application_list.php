
<?php echo message_box('success'); ?>
<div class="row">
    <div class="col-sm-12 wrap-fpanel" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
                        <strong><?php echo $this->language->form_heading()[16] ?></strong>
                    </span>
                </div>
            </div>
            <!-- Table -->

            <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="col-sm-1">ID</th>
                        <th>Full Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Leave Type</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Change / View</th>                        

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($all_application_info)):foreach ($all_application_info as $key => $v_application): ?>
                            <tr>
                                <td><?php echo $v_application->employment_id; ?></td>
                                <td><?php echo $v_application->first_name . ' ' . $v_application->last_name; ?></td>
                                <td><?php echo $v_application->leave_start_date; ?></td>
                                <td><?php echo $v_application->leave_end_date; ?></td>
                                <td><?php echo $v_application->category; ?></td>
                                <td><?php echo date('d M,y', strtotime($v_application->application_date)) ?></td>
                                <td><?php
                                    if ($v_application->application_status == '1') {
                                        echo '<span class="label label-warning"> Pending </span>';
                                    } elseif ($v_application->application_status == '2') {
                                        echo '<span class="label label-danger"> Accpeted </span>';
                                    } else {
                                        echo '<span class="label label-success"> Rejected </span>';
                                    }
                                    ?></td>
                                <td><?php echo btn_view('admin/application_list/view_application/' . $v_application->application_list_id) ?></td>                                
                            </tr>                
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

