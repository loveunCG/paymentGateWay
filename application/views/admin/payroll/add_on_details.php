<?php include_once 'asset/admin-ajax.php'; ?>
<style type="text/css" media="print">
    @media print{@page {size: landscape}}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[15] ?></strong>
                    </div>                
                </div>

                <div class="panel-body">
                    <form id="attendance-form" role="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/payroll/get_report" method="post" class="form-horizontal form-groups-bordered">                    
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[16][0] ?><span class="required">*</span></label>

                            <div class="col-sm-5">
                                <select name="department_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">
                                    <option value="" >Select Department...</option>                                  
                                    <?php if (!empty($all_department)): foreach ($all_department as $department): ?>
                                            <option value="<?php echo $department->department_id; ?>"
                                            <?php if (!empty($department_id)): ?>
                                                <?php echo $department->department_id == $department_id ? 'selected ' : '' ?>
                                                    <?php endif; ?>>
                                                        <?php echo $department->department_name; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?> 
                                </select>                            
                            </div>
                        </div> 
						<div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label">
										<?php echo $this->language->from_body()[14][1] ?> 
									</label>
                                    <div class="col-sm-5"> 
                                        <select name="employee_id" id="employee" class="form-control" >
										
                                            <option value="0">Select Employee...</option>  
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
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[16][1] ?> <span class="required">*</span></label>
                            <div class="input-group col-sm-5">
                                <input type="text" class="form-control monthyear" value="<?php
                                if (!empty($date)) {
                                    echo date('Y-n', strtotime($date));
                                }
                                ?>" name="date" >
                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>
                        </div>  
						 <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[20][2] ?> </label>
                                    <div class="col-sm-5">
                                        <select name="payment_frequency" id="payment_frequency" onchange="select_payment_date(this.value)" class="form-control" >
                                            <option value="">Payment Frequency...</option>
                                            
											 <option value="0" <?php
												if ((isset($payment_frequency) && $payment_frequency !='' && $payment_frequency == 0) ) {
													echo   'selected';
												}
												?>>Two Weekly</option>
                                            <option <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 1) ? 'selected' : '';
											?> value="1">Weekly</option>
                                            <option  <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 2) ? 'selected' : '';
											?> value="2">Bi-Monthly</option>
                                            <option  <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 3) ? 'selected' : '';
											?> value="3">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5 pull-right">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][14] ?></button>                            
                            </div>
                        </div>   
                    </form>
                </div>                        
            </div>                        
        </div>                
    </div>   
</div>
