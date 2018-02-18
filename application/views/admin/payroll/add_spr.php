<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[34] ?></strong>
                    </div>
                </div>
				<br>
				
                               
				
                <div class="panel-body">
				
                    <form id="form" action="<?php echo base_url() ?>admin/payroll/addSpr/<?php if (!empty($spr->id)) { echo $spr->id; } ?>" method="post" class="form-horizontal">
                        <div class="panel_controls">
                            
								<div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][17] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="name" id="name"  class="form-control " required >
                                        <option value="CPF">CPF</option>  
                                       	</select>
                                </div>
                            </div>
                           	 	<div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][6] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="year" id="year"  class="form-control " required >
                                        <option value="">Select Year....</option>
										<?php
										  function addSuffix($num) {
											if (!in_array(($num % 100),array(11,12,13))){
											  switch ($num % 10) {
												case 1:  return $num.'st';
												case 2:  return $num.'nd';
												case 3:  return $num.'rd';
											  }
											}
											return $num.'th';
										  }
										for ($i = 1; $i <= 15; $i++){ ?>
										<option <?php if($spr->year == $i) echo 'selected';?> value="<?php echo $i;?>"><?php echo addSuffix($i).' '.'Year'; ?></option>
										  <?php } ?>
										  </select>
                                </div>
                            </div>
								<div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label">Sector<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="sector" id="sector"  class="form-control " required >
                                        <option value="">Select Sectors....</option>  
                                       	<option <?php if($spr->sector == 'Public') echo 'selected';?> value="Public">Public </option> 
										<option <?php if($spr->sector=='Private') echo 'selected';?> value="Private">Private</option> 
										</select>
                                </div>
                            </div>
								<div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][16] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
								
                                    <select name="employee_type" id="sectors"  class="form-control " required >
                                        <option value="">Select Employee Type....</option>  
                                       	<option <?php if($spr->employee_type == '1') echo 'selected';?> value="1">Partial (also known as Graduate) Employer and Employee rates</option> 
										<option <?php if($spr->employee_type=='2') echo 'selected';?> value="2">Full Employer and Partial (also known as Graduate) Employee rates</option> 
										</select>
                                </div>
                            </div>
					<div class="form-group" id="border-none">
						<label for="field-1"  class="col-sm-3 control-label">SPR Detail<span class="required"></span></label>
					<div class="col-sm-9"> 
						<table  class="table table-bordered small-text" id="tb">
						<tr class="tr-header">
							<th>Employee Min Age</th>
							<th>Employee Max Age</th>
							<th>Min Wage</th>
							<th>Max Wage</th>
							<th>Total Contribution</th>
							<th>Employee Share</th>
							<th><a href="javascript:void(0);" id="addMore"><i class="fa fa-plus"></i></a></th>
						</tr>
					<?php foreach($editWages as $editWage){?>
						<tr>
							<td><input class="form-control input-sm" type="number" name="emp_min_age[]" id="emp_min_age" value="<?php echo $editWage['emp_min_age'] ?>" required/> </td>
							<td><input class="form-control input-sm" type="number" name="emp_max_age[]" id="emp_max_age" value="<?php echo $editWage['emp_max_age'] ?>" required /> </td>
							<td><input class="form-control input-sm" type="number" name="min_wage[]" id="min_wage" value="<?php echo $editWage['min_wage'] ?>" required /> </td>
							<td><input class="form-control input-sm" type="number" name="max_wage[]" id="max_wage" value="<?php echo $editWage['max_wage'] ?>" required /> </td>
							<td><input class="form-control input-sm" type="text" name="total_contri[]" id="total_contri" value="<?php echo $editWage['total_contri'] ?>" required /> </td>
							<td><input class="form-control input-sm" type="text" name="emp_share[]" id="emp_share" value="<?php echo $editWage['emp_share'] ?>" required /> </td>
							<th><a href='javascript:void(0);'  class='remove'><i class="fa fa-times"></i></a></th>
						</tr>
						<?php } ?>
						<tr>
							<td><input class="form-control input-sm" type="number" name="emp_min_age[]" id="emp_min_age" required /> </td>
							<td><input class="form-control input-sm" type="number" name="emp_max_age[]" id="emp_max_age" required /> </td>
							<td><input class="form-control input-sm" type="number" name="min_wage[]" id="min_wage" required /> </td>
							<td><input class="form-control input-sm" type="number" name="max_wage[]" id="max_wage" required /> </td>
							<td><input class="form-control input-sm" type="text" name="total_contri[]" id="total_contri" required /> </td>
							<td><input class="form-control input-sm" type="text" name="emp_share[]" id="emp_share" required /> </td>
							<th><a href='javascript:void(0);'  class='remove'><i class="fa fa-times"></i></a></th>
						</tr>
						</table>
					</div>
				</div>
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" id="sbtn" name="sbtn" value="1" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>
									
                                </div>
                            </div>
                       
                    </form></div>
					 </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
<script>
$(function(){
    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("First row can't be removed!");
           }
      });
});      
</script>
