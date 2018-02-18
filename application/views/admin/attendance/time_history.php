<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row margin">
	<!-- Modal -->
            <div class="col-sm-12" data-offset="0">    
                <div class="wrap-fpanel">
                    <div class="panel panel-default" data-collapsed="0">                    
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong><?php echo $this->language->form_heading()[14] ?></strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form id="form" action="<?php echo base_url() ?>admin/attendance/time_history" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                <div class="panel_controls">                         
                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label">Start Date <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="start_date" id="stdate"  placeholder="Enter Day"  class="form-control" value="<?php if ($start_date) echo $start_date ?>" data-format="dd-mm-yyyy">
                                                <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                        </div>                                                                                                
                                    </div>
                                    
                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label">End Date <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="end_date" id="enddate"  placeholder="Enter Day"  class="form-control" value="<?php if ($end_date) echo $end_date ?>" data-format="dd-mm-yyyy">
                                                <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                        </div>                                                                                                
                                    </div>                                    
									<!--<div class="form-group margin">
                                        <label class="col-sm-3 control-label">Select In Time: <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="intime" id="intime"  placeholder="Select In Time"  class="form-control">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon-time"></i>
                                                </div>
                                            </div>
                                        </div>
									</div>
									<div class="form-group margin">
                                        <label class="col-sm-3 control-label">Select Out Time: <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="outtime" id="outtime"  placeholder="Select Out Time"  class="form-control">
                                                <div class="input-group-addon">
                                                    <i class="glyphicon glyphicon-time"></i>
                                                </div>
                                            </div>
                                        </div>
									</div>-->
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[15][1] ?> <span class="required">*</span></label>

                                        <div class="col-sm-5"> 
                                            <select name="designations_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">                            
                                                <!--change by @p.p single-->
                                                <option value="">Select Departments.....</option>
                                                <?php if (!empty($all_department_info)): foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                                        <?php if (!empty($v_department_info)): ?>
                                                            <optgroup label="<?php echo $dept_name; ?>">
                                                                <?php foreach ($v_department_info as $designation) : ?>
                                                                    <option value="<?php echo $designation->designations_id; ?>" 
                                                                    <?php
                                                                    if (!empty($award_info->designations_id)) {
                                                                        echo $designation->designations_id == $award_info->designations_id ? 'selected' : '';
                                                                    }
                                                                    ?>><?php echo $designation->designations ?></option>                            
                                                                        <?php endforeach; ?>
                                                            </optgroup>
                                                        <?php endif; ?>                            
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[14][1] ?> </label>
                                    <div class="col-sm-5"> 
                                        <select name="employee_id_not_required" id="employee" class="form-control" >
										
                                            <option value="">Select Employee...</option>  
                                            <?php 
												
												if (!empty($employee_info_emp)): ?>
                                                <?php foreach ($employee_info_emp as $v_employee) : ?>
													<?php
													if (!empty($designations_id)) 
													{
														?> 
                                                    <option value="<?php echo $v_employee->employee_id; ?>" 
                                                    <?php
                                                    if (!empty($employee_id)) {
                                                        echo $v_employee->employee_id == $employee_id ? 'selected' : '';
                                                    }
                                                    ?>><?php echo $v_employee->first_name . ' ' . $v_employee->last_name ?></option>      
													<?php } ?>                   
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                    <!--@Harshita 5August Ajax Based Employee Get ends here..... -->
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-5">
                                            <button type="submit" id="sbtn" name="sbtn" value="1" class="btn btn-primary">Go</button>                            
                                        </div>
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div>
                    
                     <!-- result display begins -->
<div class="row">
        <div class="col-sm-12 wrap-fpanel" data-spy="scroll" data-offset="0">                            
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>Attendance Report</strong>
                        <div class="pull-right hidden-print">
                            <button class="btn-print" type="button" data-toggle="tooltip" title="Print" onclick="time_history_list('time_history_list')"><?php echo btn_print(); ?></button>                                                              
                        </div>
                    </div>
                </div>
                <br />
                <!-- Table -->
                <div id="time_history_list">
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th class="col-sm-1">ID</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody>                    
                        <?php if (!empty($result_data)): foreach ($result_data as $row) : ?>

                                <tr>
                                    <td><?php echo $row['employment_id'] ?></td>
                                    <td><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
                                    <td><?php echo $row['department_name'] ?></td>
                                    <td><?php echo $row['date'] ?></td>
                                    <td>
                                        
                                    <?php 
                                        $time_in = explode("<-->",$row['time_in']);
                                        foreach($time_in as $time)
                                        {                                        
                                            echo $time.'<br>';
                                        }
                                    ?>
                                    
                                    </td>
                                    <td>
                                    <?php 
                                        $time_out = explode("<-->",$row['time_out']);
                                        foreach($time_out as $time)
                                        {                                        
                                            echo $time.'<br>';
                                        }
                                    ?>
                                        
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        <?php else : ?>
                        <td colspan="6">
                            <strong>There is no data to display</strong>
                        </td>
                    <?php endif; ?>
                    </tbody>
                </table>   
                </div>
            </div>
        </div>
    </div>
                     <!-- result display ends -->
                     </div>
        </div>
    </div>                                            
</div>   
<script type="text/javascript">
    $(function() {
		
		$('#stdate').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
		$('#enddate').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
			
    });

	

</script>

<script type="text/javascript">
    function time_history_list(time_history_list) {
        var printContents = document.getElementById(time_history_list).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>