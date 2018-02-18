<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[20] ?></strong>
                    </div>
                </div>
                <form id="make_payment_form" role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/payroll/generate_payslip" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 form-groups-bordered">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][2] ?><span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text"  value="<?php
                                        if (!empty($start_payment_date)) {
                                            echo $start_payment_date;
                                        }
                                        ?>" class="form-control" id="sdate" name="start_payment_date"  >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[6][3] ?> <span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text"  value="<?php
                                        if (!empty($end_payment_date)) {
                                            echo $end_payment_date;
                                        }
                                        ?>" class="form-control" id="edate" name="end_payment_date" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>							
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label">Department<?php //echo $this->language->from_body()[20][0] ?> </label>
                                    <div class="col-sm-5">
                                        <select name="designations_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">                            
                                            <option value="">Select Department.....</option>
                                            <?php if (!empty($all_department_info)): 
													foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                                    <?php if (!empty($v_department_info)): ?>
                                                        <optgroup label="<?php echo $dept_name; ?>">
                                                            <?php 
																foreach ($v_department_info as $designation) : ?>
                                                                <option value="<?php echo $designation->designations_id; ?>" 
                                                                <?php
                                                                if (!empty($designations_id)) {
                                                                    echo $designation->designations_id == $designations_id ? 'selected' : '';
                                                                }
                                                                ?>
																>
																	<?php echo $designation->designations ?>
																</option>                            
																<?php endforeach; ?>
                                                        </optgroup>
                                                    <?php endif; ?>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label">
										<?php echo $this->language->from_body()[14][1] ?> 
									</label>
                                    <div class="col-sm-5">
                                        <select name="employee_id" id="employee" class="form-control" >
                                            <option value="">Select Employee...</option>  
                                            <?php if (!empty($employee_info_emp)): ?>
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
                                                    ?>><?php echo $v_employee->first_name . ' ' . $v_employee->last_name ?></option><?php
													}
														?>                             
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
								<?php //echo "<pre>".print_r($this->language->from_body(),1)."</pre>";?>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[20][2] ?> </label>
                                    <div class="col-sm-5">
                                        <select name="payment_frequency" id="payment_frequency" class="form-control" >
                                            <option value="">Payment Frequency...</option>
                                            <option <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 1) ? 'selected' : '';
											?> value="1">Weekly</option>
                                            <option  <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 1) ? 'selected' : '';
											?> value="2">Bi-Monthly</option>
                                            <option  <?php 
											echo (!empty($payment_frequency) && $payment_frequency == 1) ? 'selected' : '';
											?> value="3">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5">
                                        <button id="submit" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">GO</button>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($flag)): ?>

    <div class="row">
        <div class="col-sm-12" data-offset="0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <span>
                            <strong>Generate Payslip for <?php
                                if (!empty($payment_date)) {
                                    echo '<span class="text-danger">' . date('F Y', strtotime($payment_date)) . '</span>';
                                }
                                ?></strong>
                        </span>
                    </div>
                </div>
<!--@sunny  Table starts-->
<style>
	.select-checkbox {
    color: #fff !important;
}
	</style>
                <table class="table table-bordered table-hover" id="example">
<!--@sunny  Table ends-->
                    <thead>
                        <tr>
							<th><input name="select_all" type="checkbox"/></th>
                            <th class="col-sm-1">ID</th>
                            <th><strong>Full Name</strong></th>
                            <th><strong>Gross Salary</strong></th>
                            <th><strong>Deductions</strong></th>
                            <th>Net Salary=</br>(Gross Salary -Total Deduction)</th> 
							<th>Working Salary=</br>( Basic salary * No of work_day ) / (Total work day)</th>      
                            <th><strong>Payment For</strong></th>
                            <th><strong>Status</strong></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($check_salary_payment)): foreach ($check_salary_payment as $key => $emp_info): ?>
                                <?php if (!empty($emp_info)): 
										foreach($emp_info as $v_emp_info)
										{
								?>
                                    <tr>
										<td style="color:#ff000"><?php echo $v_emp_info->salary_payment_id; ?></td>
                                        <td><?php echo $v_emp_info->employment_id; ?></td>
                                        <td><?php echo $v_emp_info->first_name . ' ' . $v_emp_info->last_name; ?></td>
                                        <td>
											<?php 
												$total_allow = 0;
												$glob_allow = explode('<-->',$v_emp_info->global_allowance);
												$extra_allow = explode('<-->',$v_emp_info->extra_allowance);
												
												foreach($glob_allow as $allow)
												{
													if(!empty($allow))
													{
														$alw = explode("=",$allow);
														$total_allow += $alw[1];
													}
												}
												
												foreach($extra_allow as $allow)
												{
													if(!empty($allow))
													{
														$alw = explode("=",$allow);
														$total_allow += $alw[1];
													}
												}
												echo $gross = $v_emp_info->basic_salary + $total_allow;
											?>
										</td>
                                        <td>
											<?php 
												$total_deduct = 0;
												$glob_deduct = explode('<-->',$v_emp_info->global_deduction);
												$extra_deduct = explode('<-->',$v_emp_info->extra_deduction);
												
												foreach($glob_deduct as $deduct)
												{
													if(!empty($deduct))
													{
														$alw = explode("=",$deduct);
														$total_deduct += $alw[1];
													}
												}
												
												foreach($extra_deduct as $deduct)
												{
													if(!empty($deduct))
													{
														$alw = explode("=",$deduct);
														$total_deduct += $alw[1];
													}
												}
												
											echo $deduction = $v_emp_info->social_security + $v_emp_info->nhi_deduction  + $v_emp_info->payroll_tax_deduction + $v_emp_info->spouse_nhi_deduction + $v_emp_info->leave_deduction + $total_deduct; ?>
										</td>
                                        <td><?php echo $net_salary = $gross - $deduction; ?></td>
                                        <td>
										<?php
											$no_of_work_day=$v_emp_info->no_of_work_day;
											$total_work_day=$v_emp_info->total_work_day;						
											$basic_salary=$net_salary+$v_emp_info->leave_deduction;
											/*echo $basic_salary." * ".$no_of_work_day." / ".$total_work_day." =</br>";
											$working_salary=0;
											if(!empty($no_of_work_day) && !empty($total_work_day)){
											 $working_salary=$basic_salary * ($no_of_work_day / $total_work_day);
											}
											echo number_format($working_salary, 2);*/
											
											$total_working_salary=(isset($v_emp_info->total_working_salary)) ? $v_emp_info->total_working_salary : 0;
											$total_overtime_salary=(isset($v_emp_info->total_overtime_salary)) ? $v_emp_info->total_overtime_salary : 0;
											$allowance=$total_allow;
											
											echo ($v_emp_info->salary_type == 1) ? "[".$v_emp_info->total_working_salary." + ".$v_emp_info->total_overtime_salary ." + (".$allowance." * ".$no_of_work_day." / ".$total_work_day." ) - (".$deduction." * ".$no_of_work_day." / ".$total_work_day." )] =" : $basic_salary." * ".$no_of_work_day." / ".$total_work_day." =";
											
											$working_salary=0;
											if(!empty($no_of_work_day) && !empty($total_work_day)){
											 $working_salary=($v_emp_info->salary_type == 1) ? $v_emp_info->total_working_salary + $v_emp_info->total_overtime_salary + ($allowance * $no_of_work_day / $total_work_day ) - ($deduction * $no_of_work_day / $total_work_day )  : $basic_salary * ($no_of_work_day / $total_work_day);
											}
											//echo "<".$v_emp_info->total_working_salary.">total_overtime_salary="."<".$v_emp_info->total_overtime_salary.">";
											//echo $working_salary;
											$formula=($v_emp_info->salary_type == 1) ? '( total_working_salary + total_overtime_salary ) + (Allowance * No of work_day / Total work day ) - (Deduction * No of work_day / Total work day ) ' : '( Basic salary * No of work_day ) / (Total work day)';
											
											if (!empty($genaral_info[0]->currency)) {
												$currency = $genaral_info[0]->currency;
											} else {
												$currency = '$';
											}	
																								  
											echo '<a href="#"  data-toggle="tooltip" title="'.$formula.'"  class="more" >' . $currency . ' ' . number_format($working_salary, 2) . '</a>';
											?> 
											<input type="hidden" name="employee_no_of_work_day[<?php echo $v_emp_info->employee_id?>]" value="<?php echo $no_of_work_day?>" />
											<input type="hidden" name="employee_total_work_day[<?php echo $v_emp_info->employee_id?>]" value="<?php echo $total_work_day?>" />
										</td>
                                        <td><?php echo date("d-M",strtotime($v_emp_info->start_payment_date))." to ". date("d-M, Y",strtotime($v_emp_info->end_payment_date))?></td>
                                        <td><span class="label label-success">Paid</span></td>
                                        <td>
                                            <a class="text-success" href="<?php echo base_url()?>admin/payroll/receive_generated/<?php echo $v_emp_info->salary_payment_id;?>">Generate Payslip</a>
                                        </td>
                                    </tr> 
                            <?php
										}
										endif;
							endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                
                <div class="form-group" id="border-none">
					<label for="field-1" class="col-sm-3 control-label"></label>
					<div class="col-sm-5">
					<a class="text-success" href="javascript:">
						<button id="bulk_generate_payslip" type="button" name="sbtn" value="1" class="btn btn-primary btn-block"> Bulk Generate Payslip</button></a>
					</div>
				</div>	
                </div>
                
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
$(function(){
		$('#sdate').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
		$('.input-daterange input').each(function() {
			$(this).datepicker("clearDates");
		});
		$('#edate').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
		$("#sdate").change(function(){
			$('#edate').datepicker('clearDates');
			$('#edate').datepicker('remove');
			
			$('#edate').datepicker({
				autoclose: true,
				format: "yyyy-mm-dd",
				startDate:$("#sdate").val()
			});
		});
		$("#edate").change(function(){
			$('#sdate').datepicker('clearDates');
			$('#sdate').datepicker('remove');
			
			$('#sdate').datepicker({
				autoclose: true,
				format: "yyyy-mm-dd",
				endDate:$("#edate").val()
			});
		});
		
	});
</script> 

<!--@sunny Select and Un Select and send selected rows to bulk print payslip starts here ...-->

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatables/jquery-1.12.3.js">
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatables/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>asset/datatables/dataTables.select.min.js">
</script>
<!--
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/datatables/select.dataTables.min.css">
<script>
	//@sunny starts here ....
$(document).ready(function() {
	// Array holding selected row IDs
	var rows_selected_id = '';
   var rows_selected = [];
   var table = $('#example').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    } );

   // Handle click on checkbox
   $('#example').on('click', 'td:first-child', function(e){
	  
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
     // if(this.checked && index === -1){alert("ckeck");
      if($row.hasClass("selected") && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){ //alert("unckeck");
         rows_selected.splice(index, 1);
      }
      
     
console.log(rows_selected_id);
		console.log("rows_selected_id=>"+rows_selected_id);
		  for (var i = 0; i < rows_selected.length; ++i)
			{
				console.log("rows_selected_id=>"+rows_selected_id);
				rows_selected_id+= (rows_selected_id=='') ? ''+rows_selected[i] :  '_'+rows_selected[i] ;
			}
			
			console.log("final_rows_selected_id=>"+rows_selected_id);
     /* if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }*/
      console.log(rows_selected_id);
return false;
      // Update state of "Select all" control
      //updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#example').on('click', 'tbody td, thead th:first-child', function(e){//alert("test");
   console.log($(this));
     // $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

  
  
   // Handle click on "Select all" control
   $('thead input[name="select_all"]', table.table().container()).on('click', function(e){   
	  
      if(this.checked){ 
		   $row.addClass('selected'); 
         //$('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
		  $row.removeClass('selected');
        // $('#example tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
      
      /*if ($("#all").is(':checked')) { 
	  $(".checkboxclass", table.fnGetNodes()).each(function () { 
	  $(this).prop("checked", true);
	  });     
	else {
	  $(".checkboxclass", table.fnGetNodes()).each(function () {
	  $(this).prop("checked", false); 
	  })
	  }*/
   });




   // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });
    
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY     
      
      // Output form data to a console     
      $('#example-console').text($(form).serialize());
      console.log("Form submission", $(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });
   
   
   
   //Bulk Genereate Payslip
    $('#bulk_generate_payslip').on('click', function(e){
		var selected_rows=rows_selected_id;
		//alert( selected_rows +' row(s) selected' );
		window.location.href="<?php echo base_url()?>admin/payroll/receive_generated/"+selected_rows;
		});
   
});
//@sunny ends here ....
</script>
<!--@sunny Select and Un Select and send selected rows to bulk print payslip starts here ...-->
