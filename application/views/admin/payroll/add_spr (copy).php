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
                                <label for="field-1"  class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][17] ?><span class="required">*</span></label>
                                <div class="col-sm-5">            
                <input type="text" name="name"    class="form-control" value="<?php if(!empty($spr->name)){ echo $spr->name;} ?>" required>
            </div>
                            </div>
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][16] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="employee_type" id="sectors"  class="form-control " required >
                                        <option value="">Select Employee Type....</option>  
                                       	<option <?php if($spr->employee_type == '1') echo 'selected';?> value="1">Partial(also known as Graduate) Employer and Employee rates</option> 
										<option <?php if($spr->employee_type=='2') echo 'selected';?> value="2">Full Employer and Partial(also known as Graduate) Employee rates</option> 
										</select>
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



