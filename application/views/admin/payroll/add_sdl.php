<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>Add SDL</strong>
                    </div>
                </div>
				<br>
				
                               
				
                <div class="panel-body">
				
                    <form id="form" action="<?php echo base_url() ?>admin/payroll/save_sdl/<?php if (!empty($spr->id)) { echo $spr->id; } ?>" method="post" class="form-horizontal">
                        <div class="panel_controls">
                            
                            
                            
                            <div class="form-group" id="border-none">
                                <label for="field-1"  class="col-sm-3 control-label">SDL Wages for Month<span class="required">*</span></label>
                                <div class="col-sm-5">            
                
                					<div class="input-group">
											  <span class="input-group-addon">Min</span>
											  <input type="number" name="min_sdl_value" class="form-control" required min="0"  value="<?php echo $spr->min_sdl_value; ?>" aria-required="true">
											  <span class="input-group-addon">Max</span>
											  <input type="number" class="form-control" name="max_sdl_value" required min="0"  value="<?php echo $spr->max_sdl_value; ?>" aria-required="true">
										</div>
            </div>
                            </div>
                            
							
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label">Payble Amount <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="payable_amount"    class="form-control" value="<?php if(!empty($spr->payable_amount)){ echo $spr->payable_amount;} ?>" required>
                                </div>
                            </div>
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label">Calculation value<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="number" name="calc"    class="form-control" value="<?php if(!empty($spr->calc)){ echo $spr->calc;} ?>" required>
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



