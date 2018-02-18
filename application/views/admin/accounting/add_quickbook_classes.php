<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row margin">   
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo "Add Quickbook Class" //$this->language->from_body()[10][7] ?></strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form" action="<?php echo base_url(); ?>admin/accounting/save_quickbooks_class/<?php
                        if (!empty($qb_class_info->id)) {
                            echo $qb_class_info->id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Quickbook Class Name<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="quickbooks_class_name" value="<?php
                                    if (!empty($qb_class_info->quickbooks_class_name)) {
                                        echo $qb_class_info->quickbooks_class_name;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group margin">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo!empty($account_info->ID) ? 'Update' : 'Save' ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>        
        </div>            
    </div> 
	