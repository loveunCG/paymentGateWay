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
                        <strong><?php echo "Add Accounts Type" //$this->language->from_body()[10][7] ?></strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form" action="<?php echo base_url(); ?>admin/accounting/save_accounts_type/<?php
                        if (!empty($accounts_type_info->id)) {
                            echo $accounts_type_info->id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Accounts Type Name<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="account_group" value="<?php
                                    if (!empty($accounts_type_info->account_group)) {
                                        echo $accounts_type_info->account_group;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Account Credit/Debit<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <select name="credit_debit" class="form-control col-sm-5" required>
                                    <option value="" >Select...</option>
                                    <option <?php if(!empty($accounts_type_info->credit_debit) && $accounts_type_info->credit_debit == 1) echo 'selected';?> value="1" >Credit</option>
                                    <option <?php if(!empty($accounts_type_info->credit_debit) && $accounts_type_info->credit_debit == 2) echo 'selected';?>  value="2" >Debit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Accounts Group Type<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <select name="account_group_type" class="form-control col-sm-5" required>
                                    <option value="" >Select Group Type...</option>
                                    <option <?php if(!empty($accounts_type_info->account_group_type) && $accounts_type_info->account_group_type == 1) echo 'selected';?> value="1" >Trading Account</option>
                                    <option <?php if(!empty($accounts_type_info->account_group_type) && $accounts_type_info->account_group_type == 2) echo 'selected';?>  value="2" >Profit & Loss</option>
                                    <option <?php if(!empty($accounts_type_info->account_group_type) && $accounts_type_info->account_group_type == 3) echo 'selected';?> value="3" >Balance Sheet</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group margin">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo !empty($accounts_type_info->id) ? 'Update' : 'Save' ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>        
        </div>            
    </div> 
	