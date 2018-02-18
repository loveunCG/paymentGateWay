<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<form role="form" id="employee-form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/employee/update_employee/<?php
if (!empty($employee_info->id)) {
    echo $employee_info->id;
}
?>" method="post" class="form-horizontal form-groups-bordered">    
    <div class="row">
        <div class="wrap-fpanel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>Edit Employee</strong>
                    </div>
                </div>
            </div>
        </div>
        
      
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><?php echo $this->language->from_body()[12][0] ?></h4>
                </div>
                <div class="panel-body ">
                    <div class="">
                        <label class="control-label" >Employee Name: <span class="required"> *</span></label>
						<input type="hidden" value="<?php echo $employee_info->id;?>" name="emp_id">
                        <input type="text" name="name" value="<?php
                        if (!empty($employee_info->name)) {
                            echo $employee_info->name;
                        }
                        ?>"  class="form-control">
                    </div>
                    <div class="">
                        <label class="control-label" >Address: <span class="required"> *</span></label>
                        <input type="text" name="address" value="<?php
                        if (!empty($employee_info->address)) {
                            echo $employee_info->address;
                        }
                        ?>" class="form-control">
                    </div>
                    <div class="">
                        <label class="control-label" >Joining Date:  <span class="required"> *</span></label>
                        <div class="input-group">
                            <input type="text" name="joining_date" value="<?php
                            if (!empty($employee_info->joining_date)) {
                                echo $employee_info->joining_date;
                            }
                            ?>" class="form-control datepicker" data-format="yyy-mm-dd">
                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    
					
                    <div class="">
                        <label class="control-label" >Salary <span class="required"> *</span></label>
                        <input type="text" name="salary" value="<?php
                        if (!empty($employee_info->salary)) {
                            echo $employee_info->salary;
                        }
                        ?>"  class="form-control">
                    </div>
                    
                    
                    
                </div>            
            </div>            
        </div> <!-- ************************ Personal Information Panel End ************************-->       
     

       
            

       
         
    </div>  
<input type="submit" name="update_info" value="Update">	
</form>
<script>
	$(function(){
		<?php 
		if(empty($employee_info->maratial_status) || $employee_info->maratial_status != 'married')
		{
		?>
			$("#spouse").hide();
		<?php 
		}
		?>
		$("#maratial_status").change(function(){
			if($("#maratial_status").val() == 'married')
			{
				$("#spouse").show();
				$("#is_spouse").prop('selectedIndex', 0);
			}else{
				$("#spouse").show();
				$("#is_spouse").prop('selectedIndex', 2);
			}
				
		});
	});
</script>
