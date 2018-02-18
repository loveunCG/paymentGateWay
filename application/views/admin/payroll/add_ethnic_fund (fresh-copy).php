<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="wrap-fpanel">
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><?php
                        echo $this->language->form_heading()[32]; 
                        ?></strong>
                        </div>                
                    </div>
                    <div class="panel-body">                                
                        <form id="form" action="<?php echo base_url(); ?>admin/payroll/save_ethnic/<?php
                        if (!empty($ethnic_info->id)) {
                            echo $ethnic_info->id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">                       
                                                        
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Title<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control" name="name" value="<?php
                                    if (!empty($ethnic_info->name)) {
                                        echo $ethnic_info->name;
                                    }
                                    ?>" >
									
                                </div>
                            </div>    
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Description<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control" name="description" value="<?php
                                    if ($ethnic_info->description) {
                                        echo $ethnic_info->description;
                                    }
                                    ?>" >
									
                                </div>
                            </div>
							<?php if ($ethnic_info->status) {?>
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Status<span class="required">*</span></label>
                                <div class="col-sm-5">
									<select name="status">
									<option value="">Select Status</option>
									<option <?php if ($ethnic_info->status=='active'){echo selected;} ?> value="active">Active</option>
									<option <?php if ($ethnic_info->status=='inactive'){echo selected;} ?> value="inactive">Inactive</option>
									</select>
                                </div>
                            </div>   
							<?php } ?>                 
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
	