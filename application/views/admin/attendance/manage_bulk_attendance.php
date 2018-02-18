<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row margin">
	<div class="col-sm-9">
		<h4 class="pull-left">
		<a data-toggle="modal" data-target="#myModal" href="#">
		  <i class="fa fa-plus"></i> Upload Timecard
		</a>
		</h4>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form form-horizontal" method="post" action="<?php echo base_url() ?>admin/attendance/import_attendance" enctype="multipart/form-data">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload Timesheet</h4>
			  </div>
			  <div class="modal-body">
				<div class="form-group margin">
					<label class="col-md-3 ">Attendance</label>
					<div class="col-md-6">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<span class="btn btn-default btn-file">
								<span class="fileinput-new" >Select file</span>
								<span class="fileinput-exists" >Change</span>                                            
								<input type="file" name="filecard" >
							</span> 
							<span class="fileinput-filename"></span>                                        
							<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>
						</div>
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Upload</button>
			  </div>
		  </form>
		</div>
	  </div>
	</div>
            <div class="col-sm-12" data-offset="0">    
                <div class="wrap-fpanel">
                    <div class="panel panel-default" data-collapsed="0">                    
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong><?php echo "Set Bulk Attendance";//echo $this->language->form_heading()[14] ?></strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form id="form" action="<?php echo base_url() ?>admin/attendance/manage_bulk_attendance" method="post"  enctype="multipart/form-data" class="form-horizontal">
                                <div class="panel_controls">                         
                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?php echo "Start Date";//echo $this->language->from_body()[15][0] ?> <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="start_date" id="stdate"  placeholder="Enter Day"  class="form-control" value="<?php if ($start_date) echo $start_date ?>" data-format="dd-mm-yyyy">
                                                <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                        </div>                                                                                                
                                    </div>
                                    <div class="panel_controls">                         
                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?php echo "End Date";//echo $this->language->from_body()[15][0] ?> <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="end_date" id="endate"  placeholder="Enter Day"  class="form-control" value="<?php if ($end_date) echo $end_date ?>" data-format="dd-mm-yyyy">
                                                <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
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
                                            <select name="department_id" id="department" onchange="get_employee_by_designations_id(this.value)" class="form-control">
                                                <option value="" >Select Department...</option>
                                                <?php foreach ($all_department as $v_department) : ?>
                                                    <option value="<?php echo $v_department->department_id ?>"                                                     
                                                    <?php
                                                    if (!empty($department_id)) {
                                                        echo $v_department->department_id == $department_id ? 'selected' : '';
                                                        if($v_department->department_id == $department_id){
															$selected_department_name=$v_department->department_name;
															$selected_department_id=$department_id;
														}
                                                    }
                                                    ?>                                                    
                                                            >
                                                        <?php echo $v_department->department_name ?></option>
                                                <?php endforeach; ?>

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
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-5">
                                            <button type="submit" id="sbtn" name="sbtn" value="1" class="btn btn-primary">Go</button>                            
                                        </div>
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div>


                    <?php if (!empty($employee_info)): ?>
                        <form action="<?php echo base_url() ?>admin/attendance/save_bulk_attendance" method="post"  enctype="multipart/form-data" class="form-horizontal"> 
                           
                           <input type="hidden" name="start_date" value="<?php if ($start_date) echo $start_date ?>">
                           <input type="hidden" name="end_date" value="<?php if ($end_date) echo $end_date ?>">
                           <input type="hidden" name="department_id" value="<?php if ($selected_department_id) echo $selected_department_id ?>">
						   <input type="hidden" name="employee_id" value="<?php if ($employee_id) echo $employee_id ?>">
						   
                          
                           
                            <!-- table of  perticuler department-->
                            <table class="table table-bordered">
                                 <thead>
                                     <tr>                                                                    
                                        <th>Designation</th>
										<th>Time In</th>
										<th>Time Out</th>
										<!--<th>Add Time</th> -->                                   
                                    </tr>
                                 </thead> 
                                 <?php $v_employee=(isset($bulk_attandence_info[0])) ? $bulk_attandence_info[0] : ''; 
								
                                 ?>
                                  <input type="hidden" name="attendance_bulk_id" value="<?php if (isset($v_employee->id)){ echo $v_employee->id;} ?>">
                                    <tr>
										                                                                           
                                        <td><?php echo (isset($v_employee->department_name)) ? $v_employee->department_name : $selected_department_name ;?>
                                        
                                        
                                        
                                        </td>
                                        <td>
											<div id="add_time_in" >
											<?php
											if(!empty($v_employee->time_in))
											{	
												$time_in = explode("<-->",$v_employee->time_in);
												foreach($time_in as $in)
												{
												?>
												<div class="input-group">
													<input type="text" name="time_in_0" id="time_in_0"  placeholder="Select In Time"  class="form-control time_in" value="<?php echo $in; ?>"/>
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-time"></i>
													</div>                                           
												</div>
											<?php
												}
											}
											else
											{
											?>
												<div class="input-group">
													<input type="text" name="time_in_0" id="time_in_0"  placeholder="Select In Time"  class="form-control time_in" value=""/>
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-time"></i>
													</div>
												</div>
											<?php 
											
											}
											?>
											</div>
										</td>                                                                             
                                        <td>
											<div id="add_time_out"> 
											<?php
											if(!empty($v_employee->time_out))
											{	
												$time_out = explode("<-->",$v_employee->time_out);
												foreach($time_out as $out)
												{
												?>
												<div class="input-group">
													<input type="text" name="time_out_0" id="time_out_0"  placeholder="Select Out Time"  class="form-control time_out" value="<?php echo $out; ?>"/>
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-time"></i>
													</div>                                           
												</div>
											<?php
												}
											}
											else
											{
											?>
												<div class="input-group">
													<input type="text" name="time_out_0" id="time_out_0"  placeholder="Select Out Time"  class="form-control time_out" value=""/>
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-time"></i>
													</div>                                           
												</div>
											<?php 
											
											}
											?>
											</div>
										</td>
										<!--<td>
											<strong><a href="javascript:void(0);" id="add_time" class="addTime " onclick="time_clock('<?php echo $v_employee->employee_id?>')"><i class="fa fa-plus"></i>&nbsp;Add Time</a></strong>
											<input type="hidden" id="cnt_<?php echo $v_employee->employee_id?>" value="<?php echo count(explode("<-->",$times[$k]->time_out))?>"/>
										</td>-->
										
										<!--<td style="width: 35%">                            
                                            <input id="<?php echo $v_employee->employee_id ?>" type="checkbox"
                                            <?php
                                            foreach ($atndnce as $atndnce_status) {
                                                if ($atndnce_status) {
                                                    if ($v_employee->employee_id == $atndnce_status->employee_id) {
                                                        echo $atndnce_status->leave_category_id ? 'checked ' : '';
                                                    }
                                                }
                                            }
                                            ?>
                                                   value="<?php echo $v_employee->employee_id ?>" class="child_absent" >
                                            <div id="l_category" class="col-sm-9">
                                                <select name="leave_category_id[]" class="form-control"  >
                                                    <option value="" >Select Leave Category...</option>
                                                    <?php foreach ($all_leave_category_info as $v_L_category) : ?>
                                                        <option value="<?php echo $v_L_category->leave_category_id ?>"
                                                        <?php
                                                        foreach ($atndnce as $atndnce_status) {
                                                            if ($atndnce_status) {
                                                                if ($v_employee->employee_id == $atndnce_status->employee_id) {
                                                                    echo $v_L_category->leave_category_id == $atndnce_status->leave_category_id ? 'selected ' : '';
                                                                }
                                                            }
                                                        }
                                                        ?> > 
                                                            <?php echo $v_L_category->category ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>   
                                        </td></tr>-->
                                                          
                                 <tbody>
								 </tbody>
                            </table>  
                            
                            
                            <!-- table of all employee of perticuler department-->
                           
                             <table class="table table-bordered hide">
                                 <thead>
                                     <tr>
                                        <th>Employee Name</th>                                
                                        <th>Designation</th>
										<th>Time In</th>
										<th>Time Out</th>
										<th>Add Time</th>
                                        <th><input type="checkbox" class="checkbox-inline select_one"  id="parent_absent"/> Leave Category</th>
                                    </tr>
                                 </thead>                           
                                 <tbody>
                                 <?php //print_r($employee_info);
                                 foreach ($employee_info as $k => $v_employee) { ?>
                                    <tr>
										<td>  
                                            <input type="hidden" name="date" value="<?php echo $date ?>">                                                
                                            <?php //print_r($atndnce);
                                            foreach ($atndnce as $atndnce_status_1) {
												
                                                if (!empty($atndnce_status_1)) {
													
													foreach ($atndnce_status_1 as $atndnce_status) {
													
														if ($v_employee->employee_id == $atndnce_status->employee_id) {
												?>
														<input type="hidden" name="attendance_id[]" value="<?php if ($atndnce_status) echo $atndnce_status->attendance_id ?>">
															<?php
														}
													}
												}
                                            }
                                            ?>

                                            <input type="hidden" name="employee_id[]"  value="<?php echo $v_employee->employee_id ?>"> <?php echo $v_employee->first_name . ' ' . $v_employee->last_name; ?>
										</td>                                                                             
                                        <td><?php echo $v_employee->designations ?></td>
                                        <td>
											<div id="add_time_in_<?php echo $v_employee->employee_id?>" > 
											<?php
											if(!empty($times[$k]->time_out))
											{	
												$time_in = explode("<-->",$times[$k]->time_in);
												foreach($time_in as $in)
												{
												?>
												<div class="input-group">
													<input type="text" name="time_in[<?php echo $v_employee->employee_id?>][]" id="time_in"  placeholder="Select In Time"  class="form-control time_in" value="<?php echo $in; ?>"/>
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-time"></i>
													</div>                                           
												</div>
											<?php
												}
											}
											else
											{
											?>
												<div class="input-group">
													<input type="text" name="time_in[<?php echo $v_employee->employee_id ?>][]" id="time_in"  placeholder="Select In Time"  class="form-control time_in" value=""/>
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-time"></i>
													</div>
												</div>
											<?php 
											
											}
											?>
											</div>
										</td>                                                                             
                                        <td>
											<div id="add_time_out_<?php echo $v_employee->employee_id?>"> 
											<?php
											if(!empty($times[$k]->time_out))
											{	
												$time_out = explode("<-->",$times[$k]->time_out);
												foreach($time_out as $out)
												{
												?>
												<div class="input-group">
													<input type="text" name="time_out[<?php echo $v_employee->employee_id?>][]" id="time_out"  placeholder="Select Out Time"  class="form-control time_out" value="<?php echo $out; ?>"/>
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-time"></i>
													</div>                                           
												</div>
											<?php
												}
											}
											else
											{
											?>
												<div class="input-group">
													<input type="text" name="time_out[<?php echo $v_employee->employee_id?>][]" id="time_out"  placeholder="Select Out Time"  class="form-control time_out" value=""/>
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-time"></i>
													</div>                                           
												</div>
											<?php 
											
											}
											?>
											</div>
										</td>
										<td>
											<strong><a href="javascript:void(0);" id="add_time" class="addTime " onclick="time_clock('<?php echo $v_employee->employee_id?>')"><i class="fa fa-plus"></i>&nbsp;Add Time</a></strong>
											<input type="hidden" id="cnt_<?php echo $v_employee->employee_id?>" value="<?php echo count(explode("<-->",$times[$k]->time_out))?>"/>
										</td>
										
										<td style="width: 35%">                            
                                            <input id="<?php echo $v_employee->employee_id ?>" type="checkbox"
                                            <?php
                                            foreach ($atndnce as $atndnce_status) {
                                                if ($atndnce_status) {
                                                    if ($v_employee->employee_id == $atndnce_status->employee_id) {
                                                        echo $atndnce_status->leave_category_id ? 'checked ' : '';
                                                    }
                                                }
                                            }
                                            ?>
                                                   value="<?php echo $v_employee->employee_id ?>" class="child_absent" >
                                            <div id="l_category" class="col-sm-9">
                                                <select name="leave_category_id[]" class="form-control"  >
                                                    <option value="" >Select Leave Category...</option>
                                                    <?php foreach ($all_leave_category_info as $v_L_category) : ?>
                                                        <option value="<?php echo $v_L_category->leave_category_id ?>"
                                                        <?php
                                                        foreach ($atndnce as $atndnce_status) {
                                                            if ($atndnce_status) {
                                                                if ($v_employee->employee_id == $atndnce_status->employee_id) {
                                                                    echo $v_L_category->leave_category_id == $atndnce_status->leave_category_id ? 'selected ' : '';
                                                                }
                                                            }
                                                        }
                                                        ?> > 
                                                            <?php echo $v_L_category->category ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>   
                                        </td></tr>
                                <?php }
                                ?>  
                                </tbody>
                            </table>                               
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-11">
                            <button type="submit" id="sbtn" class="btn btn-primary">Update</button>                            
                        </div>
                    </div>
                    </form>
                <?php endif; ?>
        </div>
    </div>                                            
</div>   
<script type="text/javascript">
    $(document).ready(function() {
        $(':checkbox').on('change', function() {
            var th = $(this), id = th.prop('id');

            if (th.is(':checked')) {
                $(':checkbox[id="' + id + '"]').not($(this)).prop('checked', false);
            }
        });
    });

    $(function() {
		
		$('#intime').timepicker();
		$('#outtime').timepicker('setTime' ,'6:00 PM');
		$('#stdate').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
		$('#endate').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
			
		$(".time_out").each(function(){
			$(this).timepicker();
		});
		$(".time_in").each(function(){
			$(this).timepicker();
		});
		$("input[name='time_out[][]']").each(function(){
			$(this).timepicker();
		});
    });
	function time_clock(id)
	{
		var cnt = eval($("#cnt_"+id).val());
		if(cnt == 5)
		{
			
			return false;
		}
		console.log("False Counter " + cnt);
		$("#cnt_"+id).val(cnt+1);
		var add_new = $('<div class="input-group">\n\
							<input type="text" name="time_in['+ id +'][]" id="time_in"  placeholder="Select in Time"  class="form-control time_in" value=""/>\n\
							<div class="input-group-addon">\n\
								<i class="glyphicon glyphicon-time"></i>\n\
							</div>\n\
					</div>');
		$("#add_time_in_"+id).append(add_new);
		$(".time_in").each(function(){
			$(this).timepicker();
		});
		
		var add_new = $('<div class="input-group">\n\
							<input type="text" name="time_out['+ id +'][]" id="time_out"  placeholder="Select Out Time"  class="form-control time_out" value=""/>\n\
							<div class="input-group-addon">\n\
								<i class="glyphicon glyphicon-time"></i>\n\
							</div>\n\
					</div>');
		$("#add_time_out_"+id).append(add_new);
		$(".time_out").each(function(){
			$(this).timepicker();
		});
	}
</script>

<script type="text/javascript">
    $(document).ready(function() {
		maxAppendAllow = 0;
		maxAppendDeduc = 0;
        $("#add_time_in").click(function(){
			
			if(maxAppendAllow == 5)
			{
				return false;
			}
			maxAppendAllow++;
			
			var add_new = $('<div class="form-group">\n\
			<div class="col-sm-4">\n\<input type="text" name="description_allow[]" value="" class="form-control" placeholder="Description"/>\n\
			</div>\n\
			<div class="col-sm-5">\n\<input type="text" name="allowance[]" value="" onchange="payrollCalc();" class="salary form-control" placeholder="Amount"/>\n\
			</div>\n\
			<div class="col-sm-3">\n\
			<strong><a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;Remove</a></strong>\n\
			</div>\n\</div>');
			
			$("#add_allowance").append(add_new);
		});
		$("#add_allowance").on('click', '.remCF', function() {
			maxAppendAllow--;
            $(this).parent().parent().parent().remove();
        });
		$("#add_deduct").click(function(){
			
			if(maxAppendDeduc == 5)
			{
				return false;
			}
			maxAppendDeduc++;
			
			
            var add_new = $('<div class="form-group">\n\
			<div class="col-sm-4">\n\<input type="text" name="description_deduct[]" value="" class="form-control" placeholder="Description"/>\n\
			</div>\n\
			<div class="col-sm-5">\n\<input type="text" name="deduction[]" value="" onchange="payrollCalc();" class="deduction form-control" placeholder="Amount"/>\n\
			</div>\n\
			<div class="col-sm-3">\n\
			<strong><a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;Remove</a></strong>\n\
			</div>\n\</div>');
			$("#add_deduction").append(add_new);
		});
		$("#add_deduction").on('click', '.remCF', function() {
			maxAppendDeduc--;
            $(this).parent().parent().parent().remove();
        });
	});
</script>
