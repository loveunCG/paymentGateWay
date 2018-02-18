<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row margin">
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="wrap-fpanel">
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><?php
                        echo $this->language->from_body()[10][7] 
                        ?></strong>
                        </div>                
                    </div>
                    <div class="panel-body">                                
                        <form id="form" action="<?php echo base_url(); ?>admin/payroll/save_cpf/<?php
                        if (!empty($cpf_info->id)) {
                            echo $cpf_info->id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">                       
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Year<span class="required"> *</span></label>

                                <div class="col-sm-5">
                                    <input type="text" name="year"class="form-control years"  value="<?php
                                    if (!empty($cpf_info->year)) {
                                        echo $cpf_info->year;
                                    }
                                    ?>" id="field-1" placeholder="Enter Your Year"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Sector<span class="required">*</span></label>
								 <div class="col-sm-5">
                        <select name="sector" class="form-control col-sm-5" required>
                            <option value="" >Select Sector...</option>
							<option <?php if($cpf_info->sector == 1) echo 'selected';?> value="1" >public</option>
							<option <?php if($cpf_info->sector == 2) echo 'selected';?>  value="2" >private</option>
                           
                        </select> 
                                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Employee Age<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="employee_age" class="form-control col-sm-5" required>
                            <option value="" >Select Age...</option>
							<option <?php if($cpf_info->employee_age == 1) echo 'selected';?> value="1" > 50 and below</option>
                            <option <?php if($cpf_info->employee_age == 2) echo 'selected';?> value="2" >above 50 to 55</option>
							<option <?php if($cpf_info->employee_age == 3) echo 'selected';?> value="3" >above 55 to 60</option>
							<option <?php if($cpf_info->employee_age == 4) echo 'selected';?> value="4" >above 60 to 65</option>
							<option <?php if($cpf_info->employee_age == 5) echo 'selected';?> value="5" >above 65</option>
                        </select> 
                                                                       
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Employee Wage<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" required name="employee_wage" value="<?php
                                    if (!empty($cpf_info->employee_wage)) {
                                        echo $cpf_info->employee_wage;
                                    }
                                    ?>" >
									
                                </div>
                            </div>    
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Employer Wage<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" required name="employer_wage" value="<?php
                                    if (!empty($cpf_info->employer_wage)) {
                                        echo $cpf_info->employer_wage;
                                    }
                                    ?>" >
									
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
	