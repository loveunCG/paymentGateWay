<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

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
                                            <select name="employment_type" class="form-control" >
                                                <option value="">Select Employment Type ...</option>
                                                <option value="1" <?php
                                                if (!empty($emp_salary->employment_type)) {
                                                    echo $emp_salary->employment_type == 1 ? 'selected' : '';
                                                }
                                                ?>>Provision</option>
                                                <option value="2" <?php
                                                if (!empty($emp_salary->employment_type)) {
                                                    echo $emp_salary->employment_type == 2 ? 'selected' : '';
                                                }
                                                ?>>Permanent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="border-none">
                                        <label for="field-1" class="col-sm-3 control-label">Basic Salary <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="basic_salary" id="basic_salary" value="<?php
                                            if (!empty($emp_salary->basic_salary)) {
                                                echo $emp_salary->basic_salary;
                                            }
                                            ?>"  class="salary form-control">
                                        </div>
                                    </div>
									<div class="form-group" id="border-none">
                                        <label for="field-1" class="col-sm-3 control-label">Sector Type <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="employment_type" class="form-control" id="sector">
                                                <option value="">Select Sector Type ...</option>
                                                <option value="1" <?php
                                                if (!empty($emp_salary->sector)) {
                                                    echo $emp_salary->sector == 1 ? 'selected' : '';
                                                }
                                                ?>>Public</option>
                                                <option value="2" <?php
                                                if (!empty($emp_salary->sector)) {
                                                    echo $emp_salary->sector == 2 ? 'selected' : '';
                                                }
                                                ?>>Private</option>
                                            </select>
                                        </div>
                                    </div>
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
                            <div class="">
                                <label class="control-label" >House Rent Allowance </label>
                                <input type="text" name="house_rent_allowance"  value="<?php
                                if (!empty($emp_salary->house_rent_allowance)) {
                                    echo $emp_salary->house_rent_allowance;
                                }
                                ?>"  class="salary form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Medical Allowance </label>
                                <input type="text" name="medical_allowance"  value="<?php
                                if (!empty($emp_salary->medical_allowance)) {
                                    echo $emp_salary->medical_allowance;
                                }
                                ?>"  class="salary form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Special Allowance </label>
                                <input type="text" name="special_allowance"  value="<?php
                                if (!empty($emp_salary->special_allowance)) {
                                    echo $emp_salary->special_allowance;
                                }
                                ?>"  class="salary form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Fuel Allowance </label>
                                <input type="text" name="fuel_allowance"   value="<?php
                                if (!empty($emp_salary->fuel_allowance)) {
                                    echo $emp_salary->fuel_allowance;
                                } 
                                ?>"  class="salary form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Phone Bill Allowance </label>
                                <input type="text" name="phone_bill_allowance"  value="<?php
                                if (!empty($emp_salary->phone_bill_allowance)) {
                                    echo $emp_salary->phone_bill_allowance;
                                }
                                ?>"  class="salary form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Other Allowance </label>
                                <input type="text" name="other_allowance"  value="<?php
                                if (!empty($emp_salary->other_allowance)) {
                                    echo $emp_salary->other_allowance;
                                }
                                ?>"  class="salary form-control">
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
                                <label class="control-label" >Provident Fund </label>
                                <input type="text" name="provident_fund"  id="provident_fund" value="<?php
                                if (!empty($emp_salary->provident_fund)) {
                                    echo $emp_salary->provident_fund;
                                }
                                ?>"  class="deduction form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Tax Deduction </label>
                                <input type="text" name="tax_deduction" id="tax_deduction" value="<?php
                                if (!empty($emp_salary->tax_deduction)) {
                                    echo $emp_salary->tax_deduction;
                                }
                                ?>"  class="deduction form-control">
                            </div>                            
                            <div class="">
                                <label class="control-label" >Other Deduction </label>
                                <input type="text" name="other_deduction"  value="<?php
                                if (!empty($emp_salary->other_deduction)) {
                                    echo $emp_salary->other_deduction;
                                }
                                ?>"  class="deduction form-control">
                            </div>
							<div class="">
                                <label class="control-label" >Ethnic Fund</label>
                                <input type="text" name="ethnic_fund"  value="<?php
                                if (!empty($emp_salary->ethnic_fund)) {
                                    echo $emp_salary->ethnic_fund;
                                }
                                ?>"  class="deduction form-control">
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
                                <input type="text" name="provident_fund" disabled  value="<?php if (!empty($emp_salary)) {
                                       echo $gross = $emp_salary->basic_salary + $emp_salary->house_rent_allowance + $emp_salary->medical_allowance + $emp_salary->special_allowance + $emp_salary->fuel_allowance + $emp_salary->phone_bill_allowance + $emp_salary->other_allowance;
                                   } ?>" id="total"  class="form-control">
                            </div>
                            <div class="">
                                <label class="control-label" >Total Deduction </label>
                                <input type="text" name="tax_deduction" disabled value="<?php if (!empty($emp_salary)) {
                                       echo $deduction = $emp_salary->tax_deduction + $emp_salary->provident_fund + $emp_salary->other_deduction;
                                   } ?>" id="deduc"  class="form-control">
                            </div>                                                        
                            <div class="">
                                <label class="control-label" >Net Salary </label>
                                <input type="text" name="tax_deduction" disabled  value="<?php if (!empty($gross)) {
                                       echo $gross - $deduction;
                                   } ?>" id="net_salary"  class="form-control">
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
	<input type="hidden" id="empAge" name="date_of_birth" value="<?php 
			if(!empty($employee_id)) {
			
				foreach($employeeInfo as $info){
				$age = (date('Y') - date('Y',strtotime($info->date_of_birth)));
				echo $age;}
			}?>"  />
        </form>
    </div>    
<?php endif; ?>
<script type="text/javascript">
    $(document).on("change", function() {
        var sum = 0;
        var deduc = 0;
		var empAge = $('#empAge').val();
		var sector = $('#sector').val();
		var salary = $("#basic_salary").val();
		$.ajax({
			 type: "post",
				url: "<?php echo base_url();?>admin/payroll/getEmployeeCPF",
				data: {'empAge': empAge, 'sector': $('#sector').val(), },				
				beforeSend: function(){
				 $('#provident_fund').show();
				},
				success: function(data) {
				 
				}
		}); 
		
		if(sector ==2){
		if(empAge < 50)
		{
			$("#provident_fund").val(salary * 0.20);
		}
		if(empAge >= 50 && empAge < 55)
		{
			$("#provident_fund").val(salary * 0.19);
		}
		if(empAge >= 55 && empAge < 60)
		{
			$("#provident_fund").val(salary * 0.13);
		}if(empAge >= 60 && empAge < 65)
		{
			$("#provident_fund").val(salary * 0.075);
		}if(empAge >= 65)
		{
			$("#provident_fund").val(salary * 0.05);
		}
		}
		
		if(sector == 1){
		if(empAge < 50)
		{
			$("#provident_fund").val(salary * 0.15);
		}
		if(empAge >= 50 && empAge < 55)
		{
			$("#provident_fund").val(salary * 0.1425);
		}
		if(empAge >= 55 && empAge < 60)
		{
			$("#provident_fund").val(salary * 0.0975);
		}if(empAge >= 60 && empAge < 65)
		{
			$("#provident_fund").val(salary * 0.05625);
		}if(empAge >= 65)
		{
			$("#provident_fund").val(salary * 0.0375);
		}
		}
		
		//var prov_fund=$("#basic_salary").val() * 0.20;
		//$("#provident_fund").val(prov_fund);
		//var salary=$("#basic_salary").val();
		if(salary <= 20000)
			$("#tax_deduction").val("0");
		else if(salary > 20000 && salary <= 30000)
			$("#tax_deduction").val("200");
		else if(salary > 30000 && salary <= 40000)
			$("#tax_deduction").val("550");
		else if(salary > 40000 && salary <= 80000)
			$("#tax_deduction").val("3350");
		else if(salary > 80000 && salary <= 120000)
			$("#tax_deduction").val("7950");
		else if(salary > 120000 && salary <= 160000)
			$("#tax_deduction").val("13950");
		else if(salary > 160000 && salary <= 200000)
			$("#tax_deduction").val("20750");
		else if(salary > 200000 && salary <= 320000)
			$("#tax_deduction").val("42350");
		else if(salary > 320000)
		{
			var ext_tax=(salary-320000) * 0.2;
			var tax=ext_tax+42350;
			$("#tax_deduction").val(tax);
		}
        $(".salary").each(function() {
            sum += +$(this).val();
        });

        $(".deduction").each(function() {
            deduc += +$(this).val();
        });
        var ctc = $("#ctc").val();

        $("#total").val(sum);
        $("#deduc").val(deduc);
        var net_salary = 0;
        net_salary = sum - deduc;
        $("#net_salary").val(net_salary);


    });
	
</script>