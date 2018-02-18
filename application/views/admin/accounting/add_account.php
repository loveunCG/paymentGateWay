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
                        <strong><?php echo "Add Account" //$this->language->from_body()[10][7] ?></strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form" action="<?php echo base_url(); ?>admin/accounting/save_account/<?php
                        if (!empty($account_info->id)) {
                            echo $account_info->id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Account ID<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="account_id" value="<?php
                                    if (!empty($account_info->account_id)) {
                                        echo $account_info->account_id;
                                    }
                                    ?>" >
                            </div>
                        </div>
						<div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Account Name<span class="required">*</span></label>
							 <!--<div class="col-sm-5">
							 <?php //echo "<pre>"; print_r($account_info); ?>
								<select name="account_name" id="account_name" class="form-control" >
                                    <option value="">Select Account...</option>  
                                    <?php /*if (!empty($account_name)): ?>
                                        <?php foreach ($account_name as $account) : ?>
                                            <option value="<?php echo $account->account_name; ?>" 
                                            <?php
                                            if (!empty($account_info->account_name) && $account->account_name == $account_info->account_name) {
                                                echo 'selected';
                                            }
                                            ?>><?php echo $account->account_name ?></option>                            
                                                <?php endforeach; ?>
                                            <?php endif; */?>
									</select>
								</div>-->
								
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="account_name" value="<?php
                                    if (!empty($account_info->account_name)) {
                                        echo $account_info->account_name;
                                    }
                                    ?>" >
                            </div>
                        </div>
                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-3 control-label">
                                <?php //echo $this->language->from_body()[14][1] ?>
                                <?php echo "Group Name" ?> 
                            </label>
                            <div class="col-sm-5">
							<?php /*echo "<pre> info "; print_r($account_info); 
							echo "<br/> group ";
							print_r($account_group); */
							?>
                                <select name="account_group" id="account_group" class="form-control" >
                                    <option value="">Select Group...</option>  
                                    <?php if (!empty($account_group)): ?>
                                        <?php foreach ($account_group as $account) : ?>
                                            <option value="<?php echo $account->id; ?>" 
                                            <?php
                                            if (!empty($account_info->id) && $account->id == $account_info->account_group) {
                                               echo 'selected';
                                            }
                                            ?>><?php echo $account->account_group ?></option>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                </select>
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
	