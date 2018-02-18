<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<form role="form" id="employee-form0" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/employee/save_employee/<?php
if (!empty($employee_info->empId)) {
    echo $employee_info->empId;
}
?>" method="post" class="form-horizontal form-groups-bordered">    
    <div class="row">
        <div class="wrap-fpanel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[11] ?></strong>
                    </div>
                </div>
            </div>
        </div>
        <!-- ************************ Personal Information Panel Start ************************-->
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading" style=" background-color: #d9534f;
    border-color: #d9534f;
    color: #ffffff; ">
                    <h4 class="panel-title">Your plan has completed the employee quata . If you want add more empoyee please change your plan .</h4>
                </div>
                     
            </div>            
        </div> 
        <div class="col-sm-12">
			<div class="col-sm-3 margin pull-center">
				
			</div>
			<div class="col-sm-6 margin pull-center">
				<!--<button id="btn_emp" type="button" class="btn btn-primary btn-block" onclick="javascript:window.location.href='http://<?php echo $_SERVER['HTTP_HOST'].'/'.SUBDOMAIN; ?>my-account/'">
					Change Plan</button>-->
				<button id="btn_emp" type="button" class="btn btn-primary btn-block" onclick="javascript:window.location.href='http://vihrms.backofficevi.com/my-account-2/'">
					Change Plan</button>	
					
			</div>
			<div class="col-sm-3 margin pull-center">
				
			</div>
		</div> 
        <!-- ************************ Personal Information Panel End ************************-->       
        

        
           
    </div>    
</form>

