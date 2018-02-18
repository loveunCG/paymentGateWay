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
                        <strong><?php echo "Add Vendors" //$this->language->from_body()[10][7] ?></strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form" action="<?php echo base_url(); ?>admin/accounting/save_vendors/<?php
                        if (!empty($vendor_info->vendor_id)) {
                            echo $vendor_info->vendor_id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Vendor Name<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="vendor_name" value="<?php
                                    if (!empty($vendor_info->vendor_name)) {
                                        echo $vendor_info->vendor_name;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Company Name<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="company_name" value="<?php
                                    if (!empty($vendor_info->compnay_name)) {
                                        echo $vendor_info->compnay_name;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Address<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <textarea type="text" class="form-control" required name="address"><?php
                                    if (!empty($vendor_info->address)) {
                                        echo $vendor_info->address;
                                    }
                                    ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Main Phone No.<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="main_phone" value="<?php
                                    if (!empty($vendor_info->main_phone)) {
                                        echo $vendor_info->main_phone;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Main Email ID<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="main_email" value="<?php
                                    if (!empty($vendor_info->main_email)) {
                                        echo $vendor_info->main_email;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Website<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="website" value="<?php
                                    if (!empty($vendor_info->website)) {
                                        echo $vendor_info->website;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Payment Terms<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="payment_terms" value="<?php
                                    if (!empty($vendor_info->payment_terms)) {
                                        echo $vendor_info->payment_terms;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Our A/c With Vendor<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="account_with_vendor" value="<?php
                                    if (!empty($vendor_info->account_with_vendor)) {
                                        echo $vendor_info->account_with_vendor;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-3 control-label">General Journal Account<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <select name="general_journal" id="general_journal" class="form-control" >
                                    <option value="">Select Group...</option>  
                                    <?php if (!empty($account_group)): ?>
                                        <?php foreach ($account_group as $account) : ?>
                                            <option value="<?php echo $account->account_id; ?>" 
                                            <?php
                                            if (!empty($vendor_info->general_journal) && $account->account_id == $vendor_info->general_journal) {
                                               echo 'selected';
                                            }
                                            ?>><?php echo $account->account_name ?></option>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group margin">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo!empty($vendor_info->vendor_id) ? 'Update' : 'Save' ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>        
        </div>            
    </div> 
	