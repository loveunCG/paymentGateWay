<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[27] ?></strong>
                    </div>
                </div>
				<br>
				
                               
				
                <div class="panel-body">
				
                    <form id="form" action="<?php echo base_url() ?>admin/payroll/add_foreign_levy/<?php if (!empty($levy->id)) { echo $levy->id; } ?>" method="post" class="form-horizontal">
                        <div class="panel_controls">
                            
							<div class="form-group" id="border-none">
                                <label for="field-1"  class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][6] ?><span class="required">*</span></label>
                                <div class="col-sm-5">            
                <input type="text" name="year"    class="form-control years" value="<?php
                if (!empty($levy->year)) {
                    echo $levy->year;
                }
                ?>" data-format="yyyy">
            </div>
                            </div>
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][2] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="sectors" id="sectors" class="form-control" required>
                                        <option value="">Select Sectors....</option>  
                                       	<option <?php if($levy->sectors == '1') echo 'selected';?> value="1">Services</option> 
										<option <?php if($levy->sectors=='2') echo 'selected';?> value="2">Manufacturing</option> 
										<option <?php if($levy->sectors=='3') echo 'selected';?> value="3">Construction</option> 
										<option <?php if($levy->sectors=='4') echo 'selected';?> value="4">Process</option> 
										<option <?php if($levy->sectors=='5') echo 'selected';?> value="5">Marine</option> 
										<option <?php if($levy->sectors=='6') echo 'selected';?> value="6">S Pass </option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][3] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="factors" class="form-control" required>                            
                                        <option value="">Select Factors....</option>
										<option <?php if($levy->factors=='1') echo 'selected'; ?> value="1">Skilled</option>
										<option <?php if($levy->factors=='2') echo 'selected'; ?>  value="2">Unskilled</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][4] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="tier" class="form-control" required>                            
                                        <option value="">Select Tier....</option>
										<option <?php if($levy->tier=='1') echo 'selected'; ?> value="1">Basic/Tier 1</option>
										<option <?php if($levy->tier=='2') echo 'selected'; ?> value="2">Tier 2</option>
										<option <?php if($levy->tier=='3') echo 'selected'; ?> value="3">Tier 3</option>
										<option <?php if($levy->tier=='4') echo 'selected'; ?> value="4">MYE</option>
										<option <?php if($levy->tier=='5') echo 'selected'; ?> value="5">MYE Waiver</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][5] ?><span class="required">*</span></label>

                                <div class="col-sm-5">
                                    <input type="text" name="levy_rate" required class="form-control" value="<?php echo $levy->levy_rate;?>" />
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
        </div>
    </div>
</div>



