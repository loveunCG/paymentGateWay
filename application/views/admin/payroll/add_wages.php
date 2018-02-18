<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">

		<div class="col-md-6"><strong><?php echo $this->language->from_body()[10][17] ?>:</strong> <?php echo  $spr->name;?></div>
		
		<div class="col-md-6"><strong><?php echo $this->language->from_body()[10][16] ?>:</strong> <?php if($spr->employee_type=='1') echo 'Partial(also known as Graduate) Employer and Employee rates';
		elseif($spr->employee_type=='2') echo 'Full Employer and Partial(also known as Graduate) Employee rates'; ?></div>
		</div>
	<br>	
<div class="row">
    <div class="col-sm-12 wrap-fpanel" data-offset="0">
        <div class="panel panel-default">
		
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
					
                        <strong><?php echo $this->language->form_heading()[34] ?></strong>
                    </span>
                </div>  </div>
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
              
				<br>
				 <div class="panel-body">
				<?php echo $dt;?>
                    <form id="form" action="<?php echo base_url() ?>admin/payroll/saveWages/<?php if(!empty($editWage->id)) echo $editWage->id?>" method="post" class="form-horizontal">
                        <div class="panel_controls">
							<div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][17] ?><span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="spr_id" id="name"  class="form-control " required onchange="call(this.value)">
                                        <option value="">Select Name....</option> 
										<?php foreach($all_spr as $spr){  ?>
                                       	<option value="<?php echo $spr->id;?>" <?php if($id == $spr->id)echo 'selected';?>><?php echo $spr->name;?></option> 
										<?php }?>
										
										</select>
                                </div>
                            </div>
							
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][20] ?><span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="employee_age" id="employee_age"  class="form-control " required >
                                        <option value="">Select Employee Age....</option>  
                                       	<option <?php if($editWage->employee_age == '1') echo 'selected';?> value="1">50 and below</option> 
										<option <?php if($editWage->employee_age=='2') echo 'selected';?> value="2">Above 50 to 55</option>
										<option <?php if($editWage->employee_age=='3') echo 'selected';?> value="3">Above 55 to 60</option> 
										<option <?php if($editWage->employee_age=='4') echo 'selected';?> value="4">Above 60 to 65</option>
										<option <?php if($editWage->employee_age=='5') echo 'selected';?> value="5">Above 65</option>
										</select>
                                </div>
                            </div>
							
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][9] ?><span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="monthly_wages" id="sectors"  class="form-control " required >
                                        <option value="">Select Monthly Wage....</option>  
                                       	<option <?php if($editWage->monthly_wages == '1') echo 'selected';?> value="1"><= $50</option> 
										<option <?php if($editWage->monthly_wages=='2') echo 'selected';?> value="2">>$50 to $500</option>
										<option <?php if($editWage->monthly_wages=='3') echo 'selected';?> value="3">>$500 to $750</option> 
										<option <?php if($editWage->monthly_wages=='4') echo 'selected';?> value="4">>= $750</option>  
										</select>
                                </div>
                            </div>
							<div class="form-group" id="border-none">
                                <label for="field-1"  class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][18] ?><span class="required">*</span></label>
                                <div class="col-sm-5">            
                <input type="text" name="total_contribution"    class="form-control" value="<?php echo $editWage->total_contribution; ?>" required>
            </div>
                            </div>
							<div class="form-group" id="border-none">
                                <label for="field-1"  class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][19] ?><span class="required">*</span></label>
                                <div class="col-sm-5">            
                <input type="text" name="employee_share"    class="form-control" value="<?php echo $editWage->employee_share; ?>" required>
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
        

				</div></div></div></div>
<script>
	function call(id)
	{
		window.location.href='<?php echo base_url()?>admin/payroll/add_wages/'+id;
	}
</script>