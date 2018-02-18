<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>Overtime Management</strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form_entitlement" action="<?php echo base_url() ?>admin/employee/save_employee_entitlement/<?php
                    if (!empty($entitlement_info->employee_entitlement_id)) {
                        echo $entitlement_info->employee_entitlement_id;
                    }
                    ?>" method="post"  enctype="multipart/form-data" class="form-horizontal">
                        <div class="panel_controls">
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo "Departments";//$this->language->from_body()[14][0] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="designations_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">                            
                                        <option value="">Select Departments.....</option>
                                        <?php if (!empty($all_department_info)): foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                                <?php if (!empty($v_department_info)): ?>
                                                    <optgroup label="<?php echo $dept_name; ?>">
                                                        <?php foreach ($v_department_info as $designation) : ?>
                                                            <option value="<?php echo $designation->designations_id; ?>" 
                                                            <?php
                                                            if (!empty($entitlement_info->designations_id)) {
                                                                echo $designation->designations_id == $entitlement_info->designations_id ? 'selected' : '';
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
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[14][1] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
								<?php //print_r($employee_info); ?>
                                    <select name="employee_id" id="employee" class="form-control" >
                                        <option value="">Select Employee...</option>  
                                        <?php if (!empty($employee_info)): ?>
                                            <?php foreach ($employee_info as $v_employee) : ?>
                                                <option value="<?php echo $v_employee->employee_id; ?>" 
                                                <?php
                                                if (!empty($entitlement_info->employee_id)) {
                                                    echo $v_employee->employee_id == $entitlement_info->employee_id ? 'selected' : '';
                                                }
                                                ?>><?php echo $v_employee->first_name . ' ' . $v_employee->last_name ?></option>                            
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                    </select>
                                </div>
                            </div>

						
							
							 <div class="form-group">
                                    <label class="col-sm-3 control-label">Select Month <span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text" required value="<?php
                                        if (!empty($month)) {
                                            echo $month;
                                        }
                                        ?>" class="form-control month" id="date" name="txtmonth">
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>
							
                           
                             
                             
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" id="sbtn" name="sbtn" value="1" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>
									  
								 
									  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
                        <strong>Employees Who Received Entitlement</strong>
                    </span>
                </div>
            </div>
            <!-- Table -->

            <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="col-sm-1">Emp ID</th>
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Leave Periods</th>
                        <th>Leave Days</th> 
                        <th>Remaining Leave</th> 
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>   
				 <?php //echo "<pre>"; print_r($all_employee_entitlement_info); ?>
                    <?php if (!empty($all_employee_entitlement_info)):foreach ($all_employee_entitlement_info as $v_entitlement_info): ?>
                            <tr>
                                <td><?php echo $v_entitlement_info->employment_id ?></td>
                                <td><?php echo $v_entitlement_info->first_name . ' ' . $v_entitlement_info->last_name; ?></td>
                                <td><?php echo $v_entitlement_info->category; ?></td> 
                                <td><?php echo $v_entitlement_info->leave_periods; ?></td>
                                <td><?php echo $total_leave_days = $v_entitlement_info->leave_days; ?></td>
                                <td> 
								<?php 
									$res = $this->employee_model->total_attebdance_leave_days($v_entitlement_info->leave_periods,$v_entitlement_info->employee_id,$v_entitlement_info->leave_category_id);
									if(!empty($res))
									{
										$remaining_leave_days = $total_leave_days - $res->taken_leave;
										echo $remaining_leave_days;
									}
									else
									{
										echo $total_leave_days;	
									}
								?>
								 
								</td>
                                
                                <td>
                                    <?php echo btn_edit('admin/employee/employee_entitlement/' . $v_entitlement_info->employee_entitlement_id . '/' . $v_entitlement_info->designations_id); ?>
                                    <?php echo btn_delete('admin/employee/delete_employee_entitlement/' . $v_entitlement_info->employee_entitlement_id); ?>
                                </td>
                            </tr>                   
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(function(){
		$('#date').datepicker({
			format : "yyyy-mm",
			autoclose : true,
			minViewMode: "months",
			endDate : new Date()
		});
		
	});
</script> 