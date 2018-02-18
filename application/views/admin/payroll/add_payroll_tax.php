<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

		
<!-- JAVASCRIPT FILES -->
<script src="<?php echo base_url()?>asset/js/jquery-1.10.2.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url()?>asset/js/validation.js" type="text/javascript"></script>  

<script>
$(document).ready(function(){
	$("#emp_max_age").bind("input propertychange",function(){
	
		test_num_limit('#emp_max_age',"#msgmax");
	});

});
</script>

<div class="row margin">
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="wrap-fpanel">
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><?php
                        echo $this->language->from_body()[10][22]
                        ?></strong>
                        </div>                
                    </div>
                    <div class="panel-body">                                
                        <form id="form" action="<?php echo base_url(); ?>admin/payroll/save_payroll_tax/<?php
                        if (!empty($pt_info->id)) {
                            echo $pt_info->id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">                       
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Year<span class="required"> *</span></label>

                                <div class="col-sm-5">
                                    <input type="text" name="year"class="form-control years"  value="<?php
                                    if (!empty($pt_info->year)) {
                                        echo $pt_info->year;
                                    }
                                    ?>" id="field-1" placeholder="Enter Your Year"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Sector<span class="required">*</span></label>
								 <div class="col-sm-5">
                        <select name="sector" class="form-control col-sm-5" required>
                            <option value="" >Select Sector...</option>
                            <option <?php if(!empty($pt_info->sector) && $pt_info->sector == 1) echo 'selected';?> value="1" >Public</option>
                            <option <?php if(!empty($pt_info->sector) && $pt_info->sector == 2) echo 'selected';?>  value="2" >Private</option>
                            <option <?php if(!empty($pt_info->sector) && $pt_info->sector == 3) echo 'selected';?> value="3" >Self-Employed</option>
                            <option <?php if(!empty($pt_info->sector) && $pt_info->sector == 4) echo 'selected';?>  value="4" >Voluntary</option>
                           
                        </select> 
                                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Employee Age<span class="required">*</span></label>
                                <div class="col-sm-5">                                   
                                    <div class="input-group">
                                        <span class="input-group-addon">Min</span>
                                        <input type="number" name="emp_min_age" class="form-control" required min="0" max="100" value="<?php if(!empty($pt_info->emp_min_age)) echo $pt_info->emp_min_age; ?>">
                                        <span class="input-group-addon">Max</span>
                                        <input type="number" class="form-control" name="emp_max_age" id="emp_max_age"  required min="0" max="247" value="<?php  if(!empty($pt_info->emp_max_age))echo $pt_info->emp_max_age; ?>">
                                    </div>
										<span id="msgmax" style="color:#B94A48" class="ErrorMsg"></span>                            
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Employee Wage<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" required name="employee_wage" value="<?php
                                    if (!empty($pt_info->employee_wage)) {
                                        echo $pt_info->employee_wage;
                                    }
                                    ?>" >
									
                                </div>
                            </div>    
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Employer Wage<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" required name="employer_wage" value="<?php
                                    if (!empty($pt_info->employer_wage)) {
                                        echo $pt_info->employer_wage;
                                    }
                                    ?>" >
									
                                </div>
                            </div>     
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Account Number </label>
                                <div class="col-sm-5">
									<select name="account_id" class="form-control col-sm-5">
										<option value="" >--Select Account--</option>
										<?php if (!empty($account_name)): ?>
                                        <?php foreach ($account_name as $account) : ?>
                                            <option value="<?php echo $account->account_id; ?>" 
                                            <?php
                                            if (!empty($pt_info->account_id) && $account->account_id == $pt_info->account_id) {
                                                echo 'selected';
                                            } 
                                            ?>><?php echo $account->account_name ?></option>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
									</select>
									
                                </div>
                            </div>     
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Business Class <span class="required">*</span></label>
                                <div class="col-sm-5">
									<select name="business_class" class="form-control col-sm-5" required>
										<option value="" >--Select Class--</option>
										<option <?php if(!empty($pt_info->business_class) && $pt_info->business_class == 1) echo 'selected';?> value="1" >Class 1</option>
										<option <?php if(!empty($pt_info->business_class) && $pt_info->business_class == 2) echo 'selected';?>  value="2" >Class 2</option>
									   
									</select>
									
                                </div>
                            </div>
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Class Charge<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" required name="classCharge" value="<?php
                                    if (!empty($pt_info->classCharge)) {
                                        echo $pt_info->classCharge;
                                    }
                                    ?>" >
									
                                </div>
                            </div> 
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Vendor </label>
                                <div class="col-sm-5">
									<select name="vendor_name" class="form-control col-sm-5">
										<option value="" >--Select Vendor--</option>
										<?php if (!empty($vendor_info)): ?>
                                        <?php foreach ($vendor_info as $vendor) : ?>
                                            <option value="<?php echo $vendor->vendor_id; ?>" 
                                            <?php
                                            if (!empty($cpf_info->vendor_id) && $vendor->vendor_id == $cpf_info->account_id) {
                                                echo 'selected';
                                            } 
                                            ?>><?php echo $vendor->vendor_name ?></option>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
									</select>
                                </div>
                            </div>							
							<div class="form-group margin">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" id="sbtn" class="btn btn-primary"><?php echo!empty($calendar_details->year) ? 'Update' : 'Save' ?></button>                            
                                </div>
                            </div>
                    </div>           
                    </form>
                </div>
            </div>        
        </div>            
    </div> 
	