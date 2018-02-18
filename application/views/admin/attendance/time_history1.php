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
                                        <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[15][0] ?> <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="date" id="date"  placeholder="Enter Day"  class="form-control" value="<?php
                                                if (!empty($date)) {
                                                    echo $date;
                                                }
                                                ?>" data-format="dd-mm-yyyy">
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

                                        <div class="col-sm-5"> <!--@Harshita 5August Ajax Based  change onchange function here..... -->
                                            <select name="department_id" id="department" onchange="get_employee_by_designations_id(this.value)" class="form-control">
                                                <option value="" >Select Department...</option>
                                                <?php foreach ($all_department as $v_department) : ?>
                                                    <option value="<?php echo $v_department->department_id ?>"                                                     
                                                    <?php
                                                    if (!empty($department_id)) {
                                                        echo $v_department->department_id == $department_id ? 'selected' : '';
                                                    }
                                                    ?>                                                    
                                                            >
                                                        <?php echo $v_department->department_name ?></option>
                                                <?php endforeach; ?>

                                            </select>                            
                                        </div>
                                    </div>
                                    <!--@Harshita 5August Ajax Based Employee Get Starts here..... -->
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


                    <?php if (!empty($employee_info)): ?>
                             <table class="table table-bordered">
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
                                 <?php foreach ($employee_info as $k => $v_employee) { ?>
                                    <tr>
										<td>  
                                            <input type="hidden" name="date" value="<?php echo $date ?>">                                                
                                            <?php
                                            foreach ($atndnce as $atndnce_status) {
                                                if (!empty($atndnce_status)) {
                                                    if ($v_employee->employee_id == $atndnce_status->employee_id) {
                                            ?>
                                                    <input type="hidden" name="attendance_id[]" value="<?php if ($atndnce_status) echo $atndnce_status->attendance_id ?>">
                                                        <?php
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
											if(!empty($times[$k]->time_in))
											{	
												$time_in = explode("<-->",$times[$k]->time_in);
												foreach($time_in as $c => $in)
												{
												?>
												<div class="input-group class_<?php echo $c ?>">
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
												foreach($time_out as $c => $out)
												{
												?>
												<div class="input-group class_<?php echo $c ?>">
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
											<div id="remove_link_<?php echo $v_employee->employee_id?>">
												<strong><a href="javascript:void(0);" id="add_time" class="addTime " onclick="time_clock('<?php echo $v_employee->employee_id?>')"><i class="fa fa-plus"></i>&nbsp;Add Time</a></strong>
												<?php
												if(!empty($times[$k]->time_in))
												{
													for($i = 1; $i < count(explode("<-->",$times[$k]->time_in)); $i++)
													{
													?>
													<strong class="<?php echo "class_".$i?>"><br/><a href="javascript:void(0);" id="add_time" class="addTime" onclick="time_clock_remove(<?php echo  "'class_".$i."','".$v_employee->employee_id."'" ?>)"><i class="fa fa-minus"></i>&nbsp;Remove</a></strong>
													<?php
													}
												}
												?>
											</div>
											<input type="hidden" id="cnt_<?php echo $v_employee->employee_id?>" 
											value="<?php 
											if(!empty($times[$k]->time_in))
											{
												echo count(explode("<-->",$times[$k]->time_in));
											}
											else
											{
												echo "1";
											}?>"/>
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
		$('#date').datepicker({
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
		$("#cnt_"+id).val(cnt+1);
		
		//add new time in
	var add_new = $('<div class="input-group class_'+ cnt +'">\n\
							<input type="text" name="time_in['+ id +'][]" id="time_in"  placeholder="Select in Time"  class="form-control time_in" value=""/>\n\
							<div class="input-group-addon">\n\
								<i class="glyphicon glyphicon-time"></i>\n\
							</div>\n\
					</div>');
		$("#add_time_in_"+id).append(add_new);
		$(".time_in").each(function(){
			$(this).timepicker();
		});
		
		
		//add new time out
		var add_new = $('<div class="input-group class_'+ cnt +'">\n\
							<input type="text" name="time_out['+ id +'][]" id="time_out"  placeholder="Select Out Time"  class="form-control time_out" value=""/>\n\
							<div class="input-group-addon">\n\
								<i class="glyphicon glyphicon-time"></i>\n\
							</div>\n\
					</div>');
		$("#add_time_out_"+id).append(add_new);
		$(".time_out").each(function(){
			$(this).timepicker();
		});
		
		
		//remove link
		var add_new = $('<strong class="class_'+ cnt +'"><br/><a href="javascript:void(0);" id="add_time" class="addTime" onclick="time_clock_remove(\'class_'+ cnt +'\',\''+ id +'\')"><i class="fa fa-minus"></i>&nbsp;Remove</a></strong>');
		
		$("#remove_link_"+id).append(add_new);
	}
	
	function time_clock_remove(cls,id)
	{
		$("."+cls).remove();
		
		var cnt = eval($("#cnt_"+id).val());
		$("#cnt_"+id).val(cnt-1);
	}
</script>