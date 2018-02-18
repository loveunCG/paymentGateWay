
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php if($getActiveUserDetails['user_type'] == 1 || $getActiveUserDetails['user_type'] == 3){ ?>
<h4><?php echo anchor('admin/attendance/apply_new_application', '<i class="fa fa-plus"></i> Apply New Application'); ?></h4>
<br/>
<?php } ?>
    <div class="row">
        <div class="col-sm-12 wrap-fpanel" data-spy="scroll" data-offset="0">                            
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $title; ?></strong>
                        <div class="pull-right hidden-print">
                            <span><?php //echo btn_pdf('admin/employee/employee_list_pdf'); ?></span>
                        </div>
                    </div>
                </div>
                <br />
                <!-- Table -->
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
							<th class="col-sm-2">Name</th>						
                            <th class="col-sm-1">Start Date</th>
                            <th class="col-sm-1">End Date</th>
                            <th class="col-sm-1">Applied On</th>
                            <th class="col-sm-1">Status</th>
							<th class="col-sm-1">Action</th>
							<th class="col-sm-1">View</th>

							
							
                            <!--<th class="col-sm-1">EMP ID</th>
                            <th>Employee</th>
                             
                            <th>Dept. > Departments</th>
                            <th class="show_print">Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th class="col-sm-2 hidden-print">View</th>                                             
                            <th class="col-sm-2 hidden-print">Action</th>-->
                        </tr>
                    </thead>
                    <tbody>                    
                        <?php if (!empty($all_leave_applications)): foreach ($all_leave_applications as $each_leave_application) : ?>

                                <tr>
                                    <td><?php echo "$each_leave_application->first_name " . "$each_leave_application->last_name"; ?></td>
									<td><?php echo date('d M Y', strtotime($each_leave_application->leave_start_date)) ?></td>
                                    <td><?php echo date('d M Y', strtotime($each_leave_application->leave_end_date)) ?></td>
									<td><?php echo $each_leave_application->category ?></td>
									<td><?php /*echo $each_leave_application->application_date;*/ if($each_leave_application->application_date != "0000-00-00 00:00:00") echo date('d M, y', strtotime($each_leave_application->application_date)); else echo date('d M, y');?></td>
                                    <td><?php
                                        if ($each_leave_application->application_status == 1) {
                                            echo '<span class="label label-info">Pending</span>';
                                        } elseif ($each_leave_application->application_status == 2) {
                                            echo '<span class="label label-success">Accepted</span>';
                                        } else {
                                            echo '<span class="label label-danger">Rejected</span>';
                                        }
                                        ?>
                                    </td>
                                                                   
                                    <td class="hidden-print">
									<?php echo btn_view('admin/attendance/view_application/'. $each_leave_application->application_list_id); ?>&nbsp;&nbsp;
									<?php //echo btn_delete('admin/attendance/delete_application/' . $each_leave_application->empId.'/'.$each_leave_application->employee_bank_id.'/'.$each_leave_application->document_id); ?>
									</td>                                
                                      
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        <?php else : ?>
                        <td colspan="3">
                            <strong>There is no data to display</strong>
                        </td>
                    <?php endif; ?>
                    </tbody>
                </table>          
            </div>
        </div>
    </div>

<script type="text/javascript">
    function employee_list(employee_list) {
        var printContents = document.getElementById(employee_list).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
