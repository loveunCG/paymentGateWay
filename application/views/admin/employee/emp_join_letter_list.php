
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<h4><?php echo anchor('admin/employee/add_employee', '<i class="fa fa-plus"></i> Add Employee'); ?></h4>
<br/>
<div id="employee_list">
    <div class="show_print" style="width: 100%; border-bottom: 2px solid black;margin-bottom: 20px;">
        <table style="width: 100%; vertical-align: middle;">
            <tr>
                <?php
                $genaral_info = $this->session->userdata('genaral_info');
                if (!empty($genaral_info)) {
                    foreach ($genaral_info as $info) {
                        ?>
                        <td style="width: 35px; border: 0px;">
                            <img style="width: 50px;height: 50px" src="<?php echo base_url() . $info->logo ?>" alt="" class="img-circle"/>
                        </td>
                        <td style="border: 0px;">
                            <p style="margin-left: 10px; font: 14px lighter;"><?php echo $info->name ?></p>
                        </td>
                        <?php
                    }
                } else {
                    ?>
                    <td style="width: 35px; border: 0px;">
                        <img style="width: 50px;height: 50px" src="<?php echo base_url() ?>img/logo.png" alt="Logo" class="img-circle"/>
                    </td>
                    <td style="border: 0px;">
                        <p style="margin-left: 10px; font: 14px lighter;">Human Resource Management System</p>
                    </td>
                    <?php
                }
                ?>
            </tr>
        </table>
    </div><!--            show when print start-->   
    <div class="row">
        <div class="col-sm-12 wrap-fpanel" data-spy="scroll" data-offset="0">                            
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[12] ?></strong>
                        <div class="pull-right hidden-print">
                        	 <span><?php echo btn_csv('admin/employee/export_csv'); ?></span>                                                                     
                            <span><?php echo btn_pdf('admin/employee/employee_list_pdf'); ?></span>
                            <button class="btn-print" type="button" data-toggle="tooltip" title="Print" onclick="employee_list('employee_list')"><?php echo btn_print(); ?></button>                                                              
                        </div>
                    </div>
                </div>
                <br />
                <!-- Table -->
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th class="col-sm-1">EMP ID</th>
                            <th>Employee</th>
                             <!--change by @p.p single-->
                            <th>Address</th>
                            <th>Joining Date</th>
							<th>Salary</th>
                            
                            <th>Status</th>
                            <!--<th class="col-sm-2 hidden-print">View</th>  -->                                           
                            <th class="col-sm-2 hidden-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>                    
                        <?php if (!empty($jobletter_list)): foreach ($jobletter_list as $v_employee) : ?>

                                <tr>
                                    <td><?php echo $v_employee->id ?></td>
                                    <td><?php echo "$v_employee->name "; ?></td>
                                    <td><?php echo $v_employee->address ?></td>
                                    <td><?php echo $v_employee->joining_date ?></td>  
                                     <td><?php echo $v_employee->salary ?></td>									
                                                                   
                                    <td><?php
                                        if ($v_employee->status == 'approve') {
                                            echo '<a href ="'.base_url('admin/employee/convert_inactive/')."/".$v_employee->id.'"/change_status/0" class="label label-success">Approve</a>';
                                        } else {
                                            echo '<a href ="'.base_url('admin/employee/convert_active/')."/".$v_employee->id.'"" class="label label-danger">Disapprove</a>';
                                        }
                                        ?></td>                                
                                   <!--<td class="hidden-print"><?php echo btn_view('admin/employee/view_employee/' . $v_employee->id); ?>&nbsp;&nbsp;<?php echo btn_view_qr('admin/employee/view_employee_qr/' . $v_employee->empId); ?></td>   -->                             
                                    <td class="hidden-print"> 
                                        <?php echo btn_edit('admin/employee/edit_employee/' . $v_employee->empId); ?>
                                        <?php //echo btn_delete('admin/employee/delete_employee/' . $v_employee->empId.'/'.$v_employee->employee_bank_id.'/'.$v_employee->document_id); ?>
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
