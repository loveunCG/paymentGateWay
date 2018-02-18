<?php include_once 'asset/admin-ajax.php'; ?>
<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); 
if(isset($emp_salary->basic_salary)){
$emp_basic_salary=$emp_salary->basic_salary;
}
else{
	$emp_basic_salary=0;
}
$databasePaymentFrequency =isset($emp_salary->payment_frequency)? $emp_salary->payment_frequency : 3 ;
?>


<div class="row">    
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default"><!-- *********     Employee Search Panel ***************** -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[17] ?></strong>
                    </div>
                </div>
                <form id="form" role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/payroll/manage_salary_details" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row"><br />
                            <div class="col-sm-12 form-groups-bordered">                                
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[20][0] ?> <span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <select name="designations_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">                            
                                            <option value="">Select Designations.....</option>
                                            <?php if (!empty($all_department_info)): foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                                    <?php if (!empty($v_department_info)): ?>
                                                        <optgroup label="<?php echo $dept_name; ?>">
                                                            <?php foreach ($v_department_info as $designation) : ?>
                                                                <option value="<?php echo $designation->designations_id; ?>" 
                                                                <?php
                                                                if (!empty($designations_id)) {
                                                                    echo $designation->designations_id == $designations_id ? 'selected' : '';
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
                                        <select name="employee_id" id="employee" class="form-control" >
                                            <option value="">Select Employee...</option>  
                                            <?php if (!empty($employee_info)): ?>
                                                <?php foreach ($employee_info as $v_employee) : ?>
                                                    <option value="<?php echo $v_employee->employee_id; ?>" 
                                                    <?php
                                                    if (!empty($employee_id)) {
                                                        echo $v_employee->employee_id == $employee_id ? 'selected' : '';
                                                    }
                                                    ?>><?php echo $v_employee->first_name . ' ' . $v_employee->last_name ?></option>                            
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5">
                                        <button id="submit" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block"><?php echo $this->language->from_body()[1][15] ?></button>
                                    </div>
                                </div>
                            </div><br />
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- ******************** Employee Search Panel Ends ******************** -->
    </div>

    <?php if (!empty($flag)): ?>
        <form id="form_validation" role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/payroll/save_salary_details/<?php
        if (!empty($emp_salary->payroll_id)) {
            echo $emp_salary->payroll_id;
        }
        ?>" method="post" class="form-horizontal form-groups-bordered">
            <div class="wrap-fpanel">
                <!-- ********************************* Salary Details Panel ***********************-->
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong>Salary Details</strong>
                            </div>
                        </div>
                        <div class="panel-body ">
	
                            <div class="row">
                                <div class="col-sm-12 form-groups-bordered">                                    
                                    <div class="form-group" id="border-none">
                                        <label for="field-1" class="col-sm-3 control-label">Employment Type <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="employment_type" class="form-control" required>
                                                <option value="">Select Employment Type ...</option>
                                                <option value="1" <?php
                                                if (!empty($emp_salary->employment_type)) {
                                                    echo $emp_salary->employment_type == 1 ? 'selected' : '';
                                                }
                                                ?>>Full-Time</option>
                                                <option value="1" <?php
                                                if (!empty($emp_salary->employment_type)) {
                                                    echo $emp_salary->employment_type == 2 ? 'selected' : '';
                                                }
                                                ?>>Part-Time</option>
                                                <option value="3" <?php
                                                if (!empty($emp_salary->employment_type)) {
                                                    echo $emp_salary->employment_type == 3 ? 'selected' : '';
                                                }
                                                ?>>Self-Employed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="border-none">
                                        <label for="field-1" class="col-sm-3 control-label">Salary Type<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="salary_type" id="salary_type" class="form-control" required>
                                                <option value="">Select Salary Type ...</option>
                                                <option value="1" <?php
                                                if (!empty($emp_salary->salary_type)) {
                                                    echo $emp_salary->salary_type == 1 ? 'selected' : '';
                                                }?>>Hourly</option>
                                                <option value="2" <?php
                                                if (!empty($emp_salary->salary_type)) {
                                                    echo $emp_salary->salary_type == 2 ? 'selected' : '';
                                                }?>>Fixed</option>
											</select>
                                        </div>
                                    </div>
									<div class="form-group" id="border-none">
                                        <label for="field-1" class="col-sm-3 control-label">Basic Salary or Rate/Hour <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="basic_salary" id="basic_salary" value="<?php
                                            if (!empty($emp_salary->basic_salary)) {
                                                echo $emp_salary->basic_salary;
                                            }
                                            ?>"  class="salary form-control" required>
                                        </div>
                                    </div>
									<div class="form-group" id="border-none">
                                        <label for="field-1" class="col-sm-3 control-label">Job Sector  <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="job_sector" class="form-control" id="sector" required>
                                                <option value="">Select Sector Type ...</option>
                                                <option value="1" <?php
                                                if (!empty($emp_salary->job_sector)) {
                                                    echo $emp_salary->job_sector == 1 ? 'selected' : '';
                                                }
                                                ?>>Public</option>
                                                <option value="2" <?php
                                                if (!empty($emp_salary->job_sector)) {
                                                    echo $emp_salary->job_sector == 2 ? 'selected' : '';
                                                }
                                                ?>>Private</option>
                                                <option value="3" <?php
                                                if (!empty($emp_salary->job_sector)) {
                                                    echo $emp_salary->job_sector == 3 ? 'selected' : '';
                                                }
                                                ?>>Self-Employed</option>
                                                <option value="4" <?php
                                                if (!empty($emp_salary->job_sector)) {
                                                    echo $emp_salary->job_sector == 4 ? 'selected' : '';
                                                }
                                                ?>>Voluntary</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="border-none">
                                        <label for="field-1" class="col-sm-3 control-label">Payment Frequency  <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="payment_frequency" id="payment_frequency" class="form-control" required onchange="updatePaymentFrequency(this.value)">
												
                                                <option value="">Select Payment Frequency...</option>
                                                <option value="1" <?php
                                                if (!empty($emp_salary->payment_frequency)) {
                                                    echo $emp_salary->payment_frequency == 1 ? 'selected' : '';
                                                }
                                                ?>>Weekly</option>
                                                <option value="2" <?php
                                                if (!empty($emp_salary->payment_frequency)) {
                                                    echo $emp_salary->payment_frequency == 2 ? 'selected' : '';
                                                }
                                                ?>>Bi-Monthly</option>
                                                <option value="3" <?php
                                                if ((!empty($emp_salary->payment_frequency) && $emp_salary->payment_frequency == 3) || ($databasePaymentFrequency==3)) {
                                                    echo   'selected';
                                                }
                                                ?>>Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--div class="form-group" id="border-none">
                                        <label for="field-1" class="col-sm-3 control-label">Eelect Ethinic <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="ethnic_type" class="form-control" id="ethinic" required>
                                                <option value="">Select Ethinic ...</option>
                                                <?php foreach($ethnics as $ethnic){?>
                                                <option value="<?php echo $ethnic['id']; ?>" <?php if (($emp_salary->ethnic_type==$ethnic['id'])) { echo  'selected';  } ?>><?php echo $ethnic['name']; ?></option>
                                               <?php }?>
                                            </select>
                                        </div>
                                    </div-->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- ***************** Salary Details  Ends *********************-->

                <!-- ******************-- Allowance Panel Start **************************-->
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong>Allowances</strong>
                            </div>
                        </div>
                        <div class="panel-body">
                        <?php
                       // print_r($global_allow_deduct); die;
						foreach($global_allow_deduct as $glob_allow)
						{
							$string='';
							//print_r($glob_allow);exit;
							if(!empty($glob_allow->allow_name))
							{
								if($glob_allow->allow_amt_type == "per")
								{
									//@sunny if allownces type in % wise then starts here 
									if (!empty($emp_salary->basic_salary)) {
										$emp_basic_salary=$emp_salary->basic_salary;
										$emp_basic_salary_before=$emp_basic_salary;
										 if($databasePaymentFrequency!=3)
											{
												
												   // if actual value==2
												   if($databasePaymentFrequency==2)
												   {
													   $emp_basic_salary=$emp_basic_salary*2;
												   }
												   //if actual value==1
													if($databasePaymentFrequency==1)
												   {
													   $emp_basic_salary=$emp_basic_salary*4;
												   }								   
												   
											}
										
										$amt = (($emp_basic_salary * $glob_allow->allow_amt)/100);
										$string= "( ( (Basic Salary) ".$emp_basic_salary_before." *  (%) ". $glob_allow->allow_amt." ) / 100 )";
										//@sunny if allownces type in % wise then ends here 
									}
									else
									{
										$amt = $glob_allow->allow_amt;
									}
								}
								else
								{
									$amt = $glob_allow->allow_amt;
								}
								
								//@sunny allownaces changes according to payment frequecy						
								       
		   
							    if($databasePaymentFrequency!=3)
							    {
									
									   // if actual value==2
									   if($databasePaymentFrequency==2)
									   {
										   $amt=$amt/2;
									   }
									   //if actual value==1
										if($databasePaymentFrequency==1)
									   {
										   $amt=$amt/4;
									   }								   
									   
								}
								
								
						?>
							<div class="">
                                <label class="control-label" ><?php echo ucfirst($glob_allow->allow_name);?> </label>
                                <input type="text" id="<?php echo str_replace(" ","_",$glob_allow->allow_name);?>" name="global_allow"  value="<?php echo $amt?>"  class="salary form-control">
								<?php echo $string; ?>
                            </div>
						<?php
							}
						}
						?>
							<div id="add_allowance" class="margin">
								<div class="col-sm-12">                            
									<strong><a href="javascript:void(0);" id="add_Alw" class="addCF "><i class="fa fa-plus"></i>&nbsp;Add Allowance</a></strong>
								</div>
								<?php
								$user_define_allow = 0;
								if(!empty($emp_salary->extra_allowance))
								{
									$extra_allow = explode('<-->',$emp_salary->extra_allowance);
									unset($extra_allow[count($extra_allow)-1]);
									$p=1;
									foreach($extra_allow as $ex_al)
									{
										$desc = explode("=",$ex_al);
								?>
									<div class="form-group">
										<div class="col-sm-4">
											<input type="text" name="description_allow[]" value="<?php echo $desc[0]?>" class="form-control" placeholder="Description"/>
										</div>
										<div class="col-sm-5">
											<input type="text" name="allowance[]"id="<?php echo str_replace(" ","_",$desc[0])."_".$p; ?>" value="<?php echo $desc[1]?> " class="salary form-control" placeholder="Amount"/>
										</div>
										<div class="col-sm-3">
											<strong><a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;Remove</a></strong>
										</div>
									</div>
								<?php
										$user_define_allow += $desc[1];
										$p++;
									}
								}
								?>
							</div>
                        </div>
                    </div>
                </div><!-- ********************Allowance End ******************-->

                <!-- ************** Deduction Panel Column  **************-->
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong>Deductions</strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="">
                                <label class="control-label" >Social Security</label>
                                <input type="text" name="social_security"  id="social_security" value="<?php
                                if (!empty($emp_salary->social_security)) {
                                    echo $emp_salary->social_security;
                                }
                                ?>"  class="deduction form-control" readonly required>
                            </div>
                            <div class="">
                                <label class="control-label" >National Health Insurance</label>
                                <input type="text" name="nhi_deduction" id="nhi_deduction"  value="<?php
                                if (!empty($emp_salary->nhi_deduction)) {
                                    echo $emp_salary->nhi_deduction;
                                }
                                ?>"  class="deduction form-control" readonly required>
                            </div>
                            <div class="">
                                <label class="control-label" >Spouse National Health Insurance</label>
                                <input type="text" name="spouse_nhi_deduction" id="spouse_nhi_deduction"  value="<?php
                                if (!empty($emp_salary->spouse_nhi_deduction)) {
                                    echo $emp_salary->spouse_nhi_deduction;
                                }
                                ?>"  class="deduction form-control" readonly required>
                            </div>
                            <div class="">
                                <label class="control-label" >Payroll Tax</label>
                                <input type="text" name="payroll_tax_deduction" id="payroll_tax_deduction"  value="<?php
                                if (!empty($emp_salary->payroll_tax_deduction) && $emp_basic_salary >= 10000) {
                                    echo $emp_salary->payroll_tax_deduction;
                                }
								else if(!empty($emp_salary->payroll_tax_deduction)){
									echo '0.000';
								}
									
                                ?>"  class="deduction form-control" readonly required>
								<input type="hidden" name="payroll_tax_deduction" id="payroll_tax_deduction_hidden"  value="<?php
                                if (!empty($emp_salary->payroll_tax_deduction)) {
                                    echo $emp_salary->payroll_tax_deduction;
                                }
                                ?>"  class="form-control" readonly required>
                            </div>
						<?php
						foreach($global_allow_deduct as $glob_deduct)
						{
							//print_r($glob_deduct);exit;
							if(!empty($glob_deduct->did_name))
							{	
								if($glob_deduct->did_amt_type == "per")
								{
									if (!empty($emp_salary->basic_salary)) {
										$amt = (($emp_salary->basic_salary * $glob_deduct->did_amt)/100);
									}
									else
									{
										$amt = $glob_deduct->did_amt;
									}
								}
								else
								{
									$amt = $glob_deduct->did_amt;
								}
								
								//@sunny for deduction according to frequecy
								       
		   
							    if($databasePaymentFrequency!=3)
							    {
									
									   // if actual value==2
									   if($databasePaymentFrequency==2)
									   {
										   $amt=$amt/2;
									   }
									   //if actual value==1
										if($databasePaymentFrequency==1)
									   {
										   $amt=$amt/4;
									   }								   
									   
								}
						?>			
						
									
						
							<div class="">
                                <label class="control-label" ><?php echo ucfirst($glob_deduct->did_name)?> </label>
                                <input type="text" name="global_deduct" id="<?php echo str_replace(" ","_",$glob_deduct->did_name);?>"  value="<?php echo $amt;?>"  class="deduction form-control">
                            </div>
						<?php
							}
						}
						?>
							<div id="add_deduction" class="margin">
								<div class="col-sm-12">                            
									<strong><a href="javascript:void(0);" id="add_deduct" class="addCF"><i class="fa fa-plus"></i>&nbsp;Add Deduction</a></strong>
								</div>
								<?php
								$user_define_deduct = 0;
								if(!empty($emp_salary->extra_deduction))
								{
									$extra_deduct = explode('<-->',$emp_salary->extra_deduction);
									unset($extra_deduct[count($extra_deduct)-1]);
									$k=1;
									foreach($extra_deduct as $ex_al)
									{
										$desc = explode("=",$ex_al);
								?>
									<div class="form-group">
										<div class="col-sm-4">
											<input type="text" name="description_deduct[]" value="<?php echo $desc[0]?>" class="form-control" placeholder="Description"/>
										</div>
										<div class="col-sm-5">
											<input type="text" name="deduction[]" id="<?php echo str_replace(" ","_",$desc[0])."_".$k; ?>" value="<?php echo $desc[1]?>" class="deduction form-control" placeholder="Amount"/>
										</div>
										<div class="col-sm-3">
											<strong><a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;Remove</a></strong>
										</div>
									</div>
								<?php
										$user_define_deduct += $desc[1];
										$k++;
									}
								}
								?>
							</div>
                        </div>
                    </div>                    
                </div><!-- ****************** Deduction End  *******************-->

                <!-- ************** Total Salary Details Start  **************-->
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong>Total Salary Details</strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="">
                                <label class="control-label" >Gross Salary </label>
                                <input type="text" name="gross_salary" disabled  value="" id="total"  class="form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Taxable Gross Salary </label>
                                								
                                <input type="text" name="taxable_gross_salary" disabled  value="" id="taxable_gross_salary"  class="form-control">
                                <input type="hidden" name="taxable_gross_salary_hidden" disabled  value="" id="taxable_gross_salary_hidden"  class="form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Total Deduction </label>
                                <input type="text" name="total_deduction" disabled value="" id="deduc"  class="form-control">
                            </div>                                                        
                            <div class="">
                                <label class="control-label" >Net Salary </label>
                                <input type="text" name="net_salary" disabled  value="" id="net_salary"  class="form-control">
                            </div>                                                        
                        </div>
                    </div>                    
                </div><!-- ****************** Total Salary Details End  *******************-->
            </div>                        
            <div class="col-sm-6 margin pull-right">
                <button id="salery_btn" type="submit" class="btn btn-primary btn-block">Save</button>
            </div>            

            <!--    ************************* Hidden Input Data *******************-->
            <input type="hidden" name="employee_id" value="<?php
    if (!empty($employee_id)) {
        echo $employee_id;
    }
    ?>" >
	<span id="as"></span>
	
	<input type="hidden" id="empAge" name="date_of_birth" value="<?php echo $age = date('Y') - date('Y',strtotime($empInfo->date_of_birth));	?>"  />
	<input type="hidden" id="employerSS" name="employerSS" value="<?php 
		if (!empty($emp_salary->employerSS)) {
			echo $emp_salary->employerSS;
		}?>"  />
	<input type="hidden" id="employerPayTax" name="employerPayTax" value="<?php 
		if (!empty($emp_salary->employerPayTax)) {
			echo $emp_salary->employerPayTax;
		}?>"  />
	<input type="hidden" id="employerNHI" name="employerNHI" value="<?php 
		if (!empty($emp_salary->employerNHI)) {
			echo $emp_salary->employerNHI;
		}?>"  />
</form>
    </div>    
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
		maxAppendAllow = 0;
		maxAppendDeduc = 0;
        $("#add_Alw").click(function(){
			
			if(maxAppendAllow == 5)
			{//alert("5")
				return false;
			}
			maxAppendAllow++;
			//alert("0")
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
			payrollCalc();
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
			payrollCalc();
        });
       
	});
</script>
<script type="text/javascript">

$(document).ready(function(){
	
	/*----------------------CALCULATE Deduction----------------------------*/
	$("#basic_salary").on("change", function(){
		if($('#sector').val()==''){
			return false;
		}
		$("#sector").trigger("change");
	});
	/*----------------------/CALCULATE SDL END----------------------------*/
	
	/*-----------------------CALCULATION CPF------------------------*/
	$("#sector , #payment_frequency").on("change", function(){
		var empAge = $('#empAge').val();
		var payment_frequency = $('#payment_frequency').val();//@pank function for payroll_tax
		if($("#basic_salary").val()=='')
		{
				bootbox.alert('Basic Salary cant be blank ');
				$('#sector').val('');
				return false;
		}
		if($('#sector').val()=='')
		{
				bootbox.alert('Please select job sector to calculate CPF');
				return false;
		}
		//@sunny 9 August 2016
		payrollCalc();	
		var Salary_Gross_Salary=$("#total").val(); 
		//alert(Salary_Gross_Salary);
		
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>admin/payroll/getEmployeeDeduction",
			data: {'payment_frequency':payment_frequency ,'empAge': empAge, 'sector': $('#sector').val(), 'salary' :Salary_Gross_Salary,'employee_id' : '<?php echo $employee_id?>' },
			success: function(data) {
				//alert(data) 
			/*************@pank for calculate taxable gross salary 17-8-2016 start here ***************/
				var aData = $.parseJSON(data);
				var taxable_gross_salary=aData.taxable_gross_salary
				if( taxable_gross_salary != false)
				{
					$('#taxable_gross_salary_hidden').val(aData.taxable_gross_salary);
					
				}
				else
				{
					$('#taxable_gross_salary_hidden').val('0.000');
				}
			/*************@pank for calculate taxable gross salary 17-8-2016 start here ***************/
				if(aData.ss != false)
				{
					$('#social_security').val(aData.ss.employeeSS);
					$('#employerSS').val(aData.ss.employeerSS);
				}
				else
				{
					$('#social_security').val('0.000');
					$('#employerSS').val('0.000');
				}
				if(aData.pt != false)
				{//@pank 3-8-2016 for pay tex Start
					 var cc_salary=$("#basic_salary").val();
					 //alert(payment_frequency);
					if(payment_frequency == 1){
						cc_salary=cc_salary*4;
					}
					if(payment_frequency == 2){
						cc_salary=cc_salary*2;
					}
					
					if(cc_salary >= 10000)
					{//@pank 3-8-2016 for pay tex END
						
						$('#payroll_tax_deduction').val(aData.pt.employeePayTax);
						$('#payroll_tax_deduction').addClass('deduction');
						$('#payroll_tax_deduction_hidden').addClass('deduction'); //@pank 5-8-2016
					}
					else
					{
						$('#payroll_tax_deduction').val('0.000');
						$('#payroll_tax_deduction_hidden').removeClass('deduction');
						$('#payroll_tax_deduction').removeClass('deduction');
					}
					$('#payroll_tax_deduction_hidden').val(aData.pt.employeePayTax);
					$('#employerPayTax').val(aData.pt.employerPayTax);
				}
				else
				{
					$('#payroll_tax_deduction_hidden').val('0.000');
					$('#payroll_tax_deduction').val('0.000');
					$('#employerPayTax').val('0.000');
				}
				if(aData.nhi != false)
				{
					$('#nhi_deduction').val(aData.nhi.employeeNhi);
					$('#spouse_nhi_deduction').val(aData.nhi.employeeSpouseNhi);
					$('#employerNHI').val(aData.nhi.employerNhi);
				}
				else
				{
					$('#nhi_deduction').val('0.000');
					$('#spouse_nhi_deduction').val('0.000');
					$('#employerSS').val('0.000');
				}
				payrollCalc();	//@suunny call this function before ajax							 
			}
		});
	});
	/*-----------------------/CALCULATION CPF END------------------------*/ 
	
	/*----------------------- manage salary type------------------------*/
	/*$("#salary_type").on("change", function(){
		var st = $('#salary_type').val();
		if(st == 'hourly')
		{
			//alert(st);
			$("#fixedsal").show();
			$("#basic_salary").attr("readonly","readonly");
				
		}
		else
		{
			$("#fixedsal").hide();
			$("#basic_salary").removeAttr("readonly","readonly");
		}
		
	});*/
	/*-----------------------/CALCULATION CPF END------------------------*/ 
	/*-----------------------CALCULATION ETHNIC------------------------*/
	$("#ethinic").on("change", function(){
		
		if($("#basic_salary").val()=='')
		{
				bootbox.alert('Basic Salary cant be blank ');
				$('#ethinic').val('');
				return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>admin/payroll/getEmployeeETHNIC",
			data: {'ethnic': $(this).val(), 'salary' : $("#basic_salary").val() },																												
			success: function(data) {
			 var aData = $.parseJSON(data);
			  $('#ethnic_fund').val(aData);
			  payrollCalc();			
			}
		 });
	});
	/*-----------------------/CALCULATION ETHNIC END------------------------*/ 
	
	
	
	/*-----------------------ALLOWANCES CALCULATION------------------------*/ 
	$(".salary").on('change', function  () {
		if($("#basic_salary").val()=='')
		{
				bootbox.alert('Basic Salary cant be blank ');
				$(this).val('');
				return false;
		}
	   payrollCalc();
	});
	/*-----------------------/ALLOWANCES CALCULATION END------------------------*/
	
	/*-----------------------DEDUCTION CALCULATION------------------------*/ 
	$(".deduction").on('change', function  () {
		if($("#basic_salary").val()=='')
		{
				bootbox.alert('Basic Salary cant be blank ');
				$(this).val('');
				return false;
		}
	   payrollCalc();
	})
	/*-----------------------/DEDUCTION CALCULATION END------------------------*/
});


/*----------------------CALCULATE PAYROLL----------------------------*/
var payrollCalc = function() {
	
        var sum = 0;
        var deduc = 0;		
		
		
        $(".salary").each(function() {
           // sum += parseInt($(this).val()); // @pank 5-8-2016
            sum += parseFloat($(this).val()); //@pank  for display floating values in gross salary 
			if(isNaN(sum))
			{
				sum = 0.00;
			}
        });
		$(".deduction").each(function() {
			//@pankaj 4august
			 deduc += parseFloat($(this).val());//@pank  for display floating values in deduction 17-8-2015
           //deduc += parseInt($(this).val());
           	if(isNaN(deduc))
			{	
				deduc = 0.00;
			}
        });
        var ctc = $("#ctc").val();
        

        $("#total").val(sum);
        //alert("total gross");
               // alert($('#taxable_gross_salary_hidden').val());

		$("#taxable_gross_salary").val($('#taxable_gross_salary_hidden').val());  //@pank  for calculate Taxable_gross_salary 17-8-2016  
        $("#deduc").val(deduc);
        var net_salary = 0;
        net_salary = sum - deduc;
        $("#net_salary").val(net_salary);
        taxable_gross_salary();
}

payrollCalc();
	
	
	function taxable_gross_salary(){
		
		var empAge = $('#empAge').val();
		var payment_frequency = $('#payment_frequency').val();//@pank function for payroll_tax
		if($("#basic_salary").val()=='')
		{
				bootbox.alert('Basic Salary cant be blank ');
				$('#sector').val('');
				return false;
		}
		if($('#sector').val()=='')
		{
				bootbox.alert('Please select job sector to calculate CPF');
				return false;
		}
		//@sunny 9 August 2016
		//payrollCalc();	
		var Salary_Gross_Salary=$("#total").val(); 
		//alert(Salary_Gross_Salary);
		
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>admin/payroll/getEmployeeDeduction",
			data: {'payment_frequency':payment_frequency ,'empAge': empAge, 'sector': $('#sector').val(), 'salary' :Salary_Gross_Salary,'employee_id' : '<?php echo $employee_id?>' },
			success: function(data) {
				//alert(data) 
			/*************@pank for calculate taxable gross salary 17-8-2016 start here ***************/
				var aData = $.parseJSON(data);
				var taxable_gross_salary=aData.taxable_gross_salary
				if( taxable_gross_salary != false)
				{
					$('#taxable_gross_salary_hidden').val(aData.taxable_gross_salary);
					$("#taxable_gross_salary").val($('#taxable_gross_salary_hidden').val());  //@pank  for calculate Taxable_gross_salary 17-8-2016
				}
				else
				{
					$('#taxable_gross_salary_hidden').val('0.000');
				}
			/*************@pank for calculate taxable gross salary 17-8-2016 start here ***************/
				if(aData.ss != false)
				{
					$('#social_security').val(aData.ss.employeeSS);
					$('#employerSS').val(aData.ss.employeerSS);
				}
				else
				{
					$('#social_security').val('0.000');
					$('#employerSS').val('0.000');
				}
				if(aData.pt != false)
				{//@pank 3-8-2016 for pay tex Start
					 var cc_salary=$("#basic_salary").val();
					 //alert(payment_frequency);
					if(payment_frequency == 1){
						cc_salary=cc_salary*4;
					}
					if(payment_frequency == 2){
						cc_salary=cc_salary*2;
					}
					
					if(cc_salary >= 10000)
					{//@pank 3-8-2016 for pay tex END
						
						$('#payroll_tax_deduction').val(aData.pt.employeePayTax);
						$('#payroll_tax_deduction').addClass('deduction');
						$('#payroll_tax_deduction_hidden').addClass('deduction'); //@pank 5-8-2016
					}
					else
					{
						$('#payroll_tax_deduction').val('0.000');
						$('#payroll_tax_deduction_hidden').removeClass('deduction');
						$('#payroll_tax_deduction').removeClass('deduction');
					}
					$('#payroll_tax_deduction_hidden').val(aData.pt.employeePayTax);
					$('#employerPayTax').val(aData.pt.employerPayTax);
				}
				else
				{
					$('#payroll_tax_deduction_hidden').val('0.000');
					$('#payroll_tax_deduction').val('0.000');
					$('#employerPayTax').val('0.000');
				}
				if(aData.nhi != false)
				{
					$('#nhi_deduction').val(aData.nhi.employeeNhi);
					$('#spouse_nhi_deduction').val(aData.nhi.employeeSpouseNhi);
					$('#employerNHI').val(aData.nhi.employerNhi);
				}
				else
				{
					$('#nhi_deduction').val('0.000');
					$('#spouse_nhi_deduction').val('0.000');
					$('#employerSS').val('0.000');
				}
				//payrollCalc();	//@suunny call this function before ajax							 
			}
		});
	}
	
	
	
	</script>

		<input type="hidden" id="hiddencurrfreq" value="3">
		
	<script>
	
	function updatePaymentFrequency(value){
			var current_payment_frequency=document.getElementById("hiddencurrfreq").value;
			
	      	     document.getElementById("hiddencurrfreq").value=value;
	      	   
	      	 var databasePaymentFrequency ='3';    
	     
	  /*
	   *  this is for basic salary for database
	  */	    
	     
	       var defaultBasicSalary='<?php if (!empty($emp_salary->basic_salary)) { echo $emp_salary->basic_salary;}?>';
	    
		/*
		 *before save, change value on behalf of payment freqency
		*/
		   if(defaultBasicSalary=='') 			
			{
				var dynamicBasicSalary = document.getElementById("basic_salary").value;
				
				var updatedBasicSalary=dynamicBasicSalary;
				
		
				if(current_payment_frequency==1 && value==3){
					 if(value==3){
						dynamicBasicSalary= dynamicBasicSalary*4;
					 }  
				 }
				if(current_payment_frequency==2 && value==3){
					   if(value==3){
						  dynamicBasicSalary= dynamicBasicSalary*2;
					   }
				}   
				if(current_payment_frequency==2 && value==1){
					   if(value==1){
						  dynamicBasicSalary= dynamicBasicSalary/2;
					   }
				 }	  
				if(current_payment_frequency==3 && value==1){
						dynamicBasicSalary= dynamicBasicSalary/4;
				} 
				if(current_payment_frequency==3 && value==2){
					  if(value==2){
						  dynamicBasicSalary= dynamicBasicSalary/2;
					   }  
				}   
				if(current_payment_frequency==1 && value==2){
					
					   if(value==2){  
						  dynamicBasicSalary= dynamicBasicSalary*2;
					   }    
					   if(value==3){  
						  dynamicBasicSalary= dynamicBasicSalary*4;
					   }  
				}
				  defaultBasicSalary=dynamicBasicSalary;
				  updatedBasicSalary=defaultBasicSalary;
		}
	    /*		
		 *after save, change value of basic salary on behalf of payment freqency
		*/
	    else{       
			/*		
			*if database payment frequency !=3
			*/
			if(databasePaymentFrequency!=3){//alert("!=3");
				if(databasePaymentFrequency==2){
				   if(value==1){
					  updatedBasicSalary= defaultBasicSalary/2;
				   }
				   if(value==3){ 
					  updatedBasicSalary= defaultBasicSalary*2;
				   }   
				   if(value==2){
					   updatedBasicSalary= defaultBasicSalary;
					}
				}
			   
				if(databasePaymentFrequency==1){
				   if(value==3){
					  updatedBasicSalary= defaultBasicSalary*4;
				   }
				   if(value==2){  
					  updatedBasicSalary= defaultBasicSalary*2;
				   } 
				   if(value==1){  
					  updatedBasicSalary= defaultBasicSalary;
				   }    
			   }
			}
		   
			   /*		
				*if database payment frequency ==3
				*/
			   else{
				   
				    if(value==1){
						  updatedBasicSalary= defaultBasicSalary/4;
					   }
					   if(value==2){
						  updatedBasicSalary= defaultBasicSalary/2;
					   }
					    if(value==3){
						  updatedBasicSalary= defaultBasicSalary;
					   }
				   }
		}
		
					document.getElementById("basic_salary").value=updatedBasicSalary;
			 /*		
			  *this is for allowanace
			 */
			var defaultBasicAllowanace=0;
			var updatedBasicAllowanace=defaultBasicAllowanace;
			<?php
				foreach($global_allow_deduct as $glob_allow)
				{
					//print_r($glob_allow);exit;
					if(!empty($glob_allow->allow_name))
					{
						if($glob_allow->allow_amt_type == "per")
						{
							if (!empty($emp_salary->basic_salary)) {
								$amt = (($emp_salary->basic_salary * $glob_allow->allow_amt)/100);
							}
							else
							{
								$amt = $glob_allow->allow_amt;
							}
						}
						else
						{
							$amt = $glob_allow->allow_amt;
						}
				?>
										
				   var amt='<?php echo $amt; ?>';
				   updatedBasicAllowanace= amt;
				   if(value==1)
				   {
					  updatedBasicAllowanace= amt/4;
				   }
				   if(value==2)
				   {
					  updatedBasicAllowanace= amt/2;
				   }
					document.getElementById("<?php echo str_replace(" ","_",$glob_allow->allow_name);?>").value=updatedBasicAllowanace;
				<?php
					}
				}
				?>
					
					
			//************This is for Deductions *****************
			
			/*
			* For Social Security
			*/
		   var defaultBasicSocialSecurity='<?php if (!empty($emp_salary->social_security)) { echo $emp_salary->social_security;}?>';
	    		
			/*
			* For dynamicSocial Security
			*/
			
	       var dynamicSocialSecurity = updatedBasicSalary*4/100;
	      
	       defaultBasicSocialSecurity= (defaultBasicSocialSecurity=='') ? dynamicSocialSecurity : defaultBasicSocialSecurity;
	      
	       var updatedBasicSocialSecurity=defaultBasicSocialSecurity;
	      		  
		   if(databasePaymentFrequency!=3)
		   {			
			 
			   if(databasePaymentFrequency==2)
			   {
				   if(value==1){
					  updatedBasicSocialSecurity= defaultBasicSocialSecurity/2;
				   }
				   if(value==3){  
					  updatedBasicSocialSecurity= defaultBasicSocialSecurity*2;
				   }   
				   if(value==2){
					   updatedBasicSocialSecurity= updatedBasicSocialSecurity*2;
					   }
			   }
			 
			    if(databasePaymentFrequency==1)
			   {
				   if(value==3){
					  updatedBasicSocialSecurity= defaultBasicSocialSecurity*4;
				   }
				   if(value==2){  
					  updatedBasicSocialSecurity= defaultBasicSocialSecurity*2;
				   }   
			   }
			
			   if(databasePaymentFrequency==3)
			   {
				   if(value==1){
					  updatedBasicSocialSecurity= defaultBasicSocialSecurity/4;
				   }
				   if(value==2){  
					  updatedBasicSocialSecurity= defaultBasicSocialSecurity/2;
				   }   
			  }			   
			   
		   }
		   else{			 						   
					   <?php if (!empty($emp_salary->social_security)) { ?>
						   if(value==1){
							  updatedBasicSocialSecurity= defaultBasicSocialSecurity/4;
						   }
						   if(value==2){  
							  updatedBasicSocialSecurity= defaultBasicSocialSecurity/2;
						   } 
						<?php } ?>  
			   }
		   		document.getElementById("social_security").value=updatedBasicSocialSecurity;
			
		   // For nhi deduction
		   var defaultBasicNhiDeduction='<?php if (!empty($emp_salary->nhi_deduction)) { echo $emp_salary->nhi_deduction;}?>';
	    
	       var dynamicBasicNhiDeduction=(updatedBasicSalary*3.75)/100;
	     
	       defaultBasicNhiDeduction= (defaultBasicNhiDeduction=='') ? dynamicBasicNhiDeduction : defaultBasicNhiDeduction;
	       
	       var updatedBasicNhiDeduction=defaultBasicNhiDeduction;
	     
		   
		    if(databasePaymentFrequency!=3)
		   {			
			  
			   if(databasePaymentFrequency==2)
			   {
				   if(value==1)
				   {
					  updatedBasicNhiDeduction= defaultBasicNhiDeduction/2;
				   }
				   if(value==3)
				   {  
					  updatedBasicNhiDeduction= defaultBasicNhiDeduction*2;
				   }   
				   if(value==2)
				   {
					   updatedBasicNhiDeduction= updatedBasicNhiDeduction*2;
					   }
			   }
			 
			    if(databasePaymentFrequency==1)
			   {
				   if(value==3)
				   {
					  updatedBasicNhiDeduction= defaultBasicNhiDeduction*4;
				   }
				   if(value==2)
				   {  
					  updatedBasicNhiDeduction= defaultBasicNhiDeduction*2;
				   }   
			   }
			 
			   if(databasePaymentFrequency==3)
			   {
				   if(value==1)
				   {
					  updatedBasicNhiDeduction= defaultBasicNhiDeduction/4;
				   }
				   if(value==2)
				   {  
					  updatedBasicNhiDeduction= defaultBasicNhiDeduction/2;
				   }   
			  }			   
			   
		   }
		    else{
		    
					   <?php if (!empty($emp_salary->nhi_deduction)) { ?>
						   if(value==1)
						   {
							updatedBasicNhiDeduction= defaultBasicNhiDeduction/4;
						   }
						   if(value==2)
						   {  
							  updatedBasicNhiDeduction= defaultBasicNhiDeduction/2;
						   } 
						   
						   <?php } ?>  
						   
		   }
			document.getElementById("nhi_deduction").value=updatedBasicNhiDeduction;
			
			
			
			/*
			 * For SpouseNhiDeduction
			*/
		   var defaultBasicSpouseNhiDeduction='<?php if (!empty($emp_salary->spouse_nhi_deduction)) { echo $emp_salary->spouse_nhi_deduction;}?>';
	       var updatedBasicSpouseNhiDeduction=defaultBasicSpouseNhiDeduction;
	      
			if(databasePaymentFrequency!=3)
		   {			
			  
			   if(databasePaymentFrequency==2)
			   {
				   if(value==1)
				   {
					  updatedBasicSpouseNhiDeduction= defaultBasicSpouseNhiDeduction/2;
				   }
				   if(value==3)
				   {  
					  updatedBasicSpouseNhiDeduction= defaultBasicSpouseNhiDeduction*2;
				   }   
				   if(value==2)
				   {
					   updatedBasicSpouseNhiDeduction= updatedBasicSpouseNhiDeduction*2;
					   }
			   }
			   
			    if(databasePaymentFrequency==1)
			   {
				   if(value==3)
				   {
					  updatedBasicSpouseNhiDeduction= defaultBasicSpouseNhiDeduction*4;
				   }
				   if(value==2)
				   {  
					  updatedBasicSpouseNhiDeduction= defaultBasicSpouseNhiDeduction*2;
				   }   
			   }
			  
			   if(databasePaymentFrequency==3)
			   {
				   if(value==1)
				   {
					  updatedBasicSpouseNhiDeduction= defaultBasicSpouseNhiDeduction/4;
				   }
				   if(value==2)
				   {  
					  updatedBasicSpouseNhiDeduction= defaultBasicSpouseNhiDeduction/2;
				   }   
			  }			   
			   
		   }
		   
			document.getElementById("spouse_nhi_deduction").value=updatedBasicSpouseNhiDeduction;
			
			
		 
		   /*
			 * For payroll_tax_deduction
			*/
		   var defaultBasicPayrollTaxDeduction='<?php
			if (!empty($emp_salary->payroll_tax_deduction) && $emp_salary->basic_salary >= 10000) {
				echo $emp_salary->payroll_tax_deduction;
			}
			else if(!empty($emp_salary->payroll_tax_deduction)){
				echo '0.000';
			}
				
			?>';
	       
	       var updatedBasicPayrollTaxDeduction=defaultBasicPayrollTaxDeduction;
	       
	       if(databasePaymentFrequency!=3)
		   {			
			   
			   if(databasePaymentFrequency==2)
			   {
				   if(value==1)
				   {
					  updatedBasicPayrollTaxDeduction= defaultBasicPayrollTaxDeduction/2;
				   }
				   if(value==3)
				   {  
					  updatedBasicPayrollTaxDeduction= defaultBasicPayrollTaxDeduction*2;
				   }   
				   if(value==2)
				   {
					   updatedBasicPayrollTaxDeduction= updatedBasicPayrollTaxDeduction*2;
					   }
			   }
			  
			    if(databasePaymentFrequency==1)
			   {
				   if(value==3)
				   {
					  updatedBasicPayrollTaxDeduction= defaultBasicPayrollTaxDeduction*4;
				   }
				   if(value==2)
				   {  
					  updatedBasicPayrollTaxDeduction= defaultBasicPayrollTaxDeduction*2;
				   }   
			   }
			  
			   if(databasePaymentFrequency==3)
			   {
				   if(value==1)
				   {
					  updatedBasicPayrollTaxDeduction= defaultBasicPayrollTaxDeduction/4;
				   }
				   if(value==2)
				   {  
					  updatedBasicPayrollTaxDeduction= defaultBasicPayrollTaxDeduction/2;
				   }   
			  }			   
			   
		   }
		   
		   document.getElementById("payroll_tax_deduction").value=updatedBasicPayrollTaxDeduction;
		   
		   // For payroll_tax_deduction_hidden
		   document.getElementById("payroll_tax_deduction_hidden").value=updatedBasicPayrollTaxDeduction;
		   
		   /* 
		   *for calculation global deduction 
		   */
		   var defaultBasicDiduction='';
			var updatedBasicDiduction=defaultBasicDiduction;
			<?php
				foreach($global_allow_deduct as $glob_did)
				{ 
					//print_r($glob_did);exit;
					if(!empty($glob_did->did_name))
					{
						if($glob_did->did_amt_type == "per")
						{
							if (!empty($emp_salary->basic_salary)) {
								$amt = (($emp_salary->basic_salary * $glob_did->did_amt)/100);
							}
							else
							{
								$amt = $glob_did->did_amt;
							}
						}
						else
						{
							$amt = $glob_did->did_amt;
						}
				?>
										
				   var amt='<?php echo $amt; ?>';
				   updatedBasicDiduction= amt;
				  
				   if(value==1)
				   {
					   updatedBasicDiduction= amt/4;
				   }
				   if(value==2)
				   {
					  updatedBasicDiduction= amt/2;
				   }
				   if(value==3)
				   {
					  updatedBasicDiduction= amt*1;
				   }
				   	document.getElementById("<?php echo str_replace(" ","_",$glob_did->did_name);?>").value=updatedBasicDiduction;
				<?php
					}
				}
				?>
				
				// add extra diduction 
				
				
				<?php
				$user_define_deduct = 0;
				if(!empty($emp_salary->extra_deduction))
				{
					$extra_deduct = explode('<-->',$emp_salary->extra_deduction);
					unset($extra_deduct[count($extra_deduct)-1]);
					$m=1;
					
					?>
					var defaultAddExtraDiduction=0;
					var updatedAddExtraDiduction=defaultAddExtraDiduction;
					<?php 
					foreach($extra_deduct as $ex_al)
					{
						$desc = explode("=",$ex_al);
					?>
					
					
					var desc='<?php echo $desc[1]; ?>';
					updatedAddExtraDiduction= desc;
					
				   //if actual value!=3 again
				   if(databasePaymentFrequency!=3)
				   {			
						   // if actual value==2
						   if(databasePaymentFrequency==2)
						   { 
							   if(value==1){
								  updatedAddExtraDiduction= updatedAddExtraDiduction/4;
							   }
							   if(value==3){  
								  updatedAddExtraDiduction= updatedAddExtraDiduction;
							   }   
							   if(value==2){ 
								   updatedAddExtraDiduction= updatedAddExtraDiduction/2;
								}
						   }
						   //if actual value==1
							if(databasePaymentFrequency==1)
							{
							   if(value==3){
								  updatedAddExtraDiduction= updatedAddExtraDiduction*4;
							   }
							   if(value==2){ 
								  updatedAddExtraDiduction= updatedAddExtraDiduction*2;
							   }
							 }
						   //if actual value==3 again
						   if(databasePaymentFrequency==3)
						   {
							   if(value==1){
								  updatedAddExtraDiduction= updatedAddExtraDiduction/4;
							   }
							   if(value==2){  
								  updatedAddExtraDiduction= updatedAddExtraDiduction/2;
							   }   
						  }			   
					}
					
						document.getElementById("<?php echo str_replace(" ","_",$desc[0])."_".$m; ?>").value=updatedAddExtraDiduction;
					
					<?php
							$user_define_deduct += $desc[1];
							$m++;
						}
					}
					?>
				
				  //for addExtraAllowance
				  <?php
						$user_define_allow = 0;
						if(!empty($emp_salary->extra_allowance))
						{
							$extra_allow = explode('<-->',$emp_salary->extra_allowance);
							unset($extra_allow[count($extra_allow)-1]);
							$p=1;
										
							?>
							var defaultAddExtraAllowance=0;
							var updatedAddExtraAllowance=defaultAddExtraAllowance;
							<?php 
								foreach($extra_allow as $ex_al)
								{
									$desc = explode("=",$ex_al);
							?>
							var desc='<?php echo $desc[1]; ?>';
							updatedAddExtraAllowance= desc;
						
				   if(databasePaymentFrequency!=3)
				   {			
						   // if actual value==2
						   if(databasePaymentFrequency==2)
						   { 
							   if(value==1)
							   {
								  updatedAddExtraAllowance= updatedAddExtraAllowance/4;
							   }
							   if(value==3)
							   {  
								  updatedAddExtraAllowance= updatedAddExtraAllowance*4;//@pank 5-8
							   }   
							   if(value==2)
							   { 
								   updatedAddExtraAllowance= updatedAddExtraAllowance/2;
								}
						   }
						   //if actual value==1
							if(databasePaymentFrequency==1)
							{
							   if(value==3)
							   {
								  updatedAddExtraAllowance= updatedAddExtraAllowance*4;
							   }
							   if(value==2)
							   { 
								  updatedAddExtraAllowance= updatedAddExtraAllowance*2;
							   }
							     
							}
						   //if actual value==3 again
						   if(databasePaymentFrequency==3)
						   {
							   if(value==1)
							   {
								  updatedAddExtraAllowance= updatedAddExtraAllowance/4;
							   }
							   if(value==2)
							   {  
								  updatedAddExtraAllowance= updatedAddExtraAllowance/2;
							   }   
						  }			   
						   
				   }
						document.getElementById("<?php echo str_replace(" ","_",$desc[0])."_".$p; ?>").value=updatedAddExtraAllowance;
						
										
						<?php
								$user_define_allow += $desc[1];
								$p++;
								}
							}
						?>
						//for Total Salary Details
						
		                     // payrollCalc();			
				
	} // function ends 
	
	</script>
