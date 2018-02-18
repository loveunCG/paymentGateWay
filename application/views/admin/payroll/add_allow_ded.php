<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

		
<!-- JAVASCRIPT FILES -->
<script src="<?php echo base_url()?>asset/js/jquery-1.10.2.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url()?>asset/js/validation.js" type="text/javascript"></script>  

<div class="row margin">
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="wrap-fpanel">
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><?php
                        echo $this->language->from_body()[19][0]
                        ?></strong>
                        </div>                
                    </div>
                    <div class="panel-body">                                
                        <form id="form" action="<?php echo base_url(); ?>admin/payroll/save_allow_ded/<?php
                        if (!empty($ad_info->id)) {
                            echo $ad_info->id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">                       
					<fieldset>	                           
							<legend align="right">Allowance :</legend>
						   <div class="form-group">
                                <!--label for="field-1" class="col-sm-2 control-label">Allowance Name<span class="required"> *</span></label-->
								<div class="col-sm-3">
                                    <input type="text" name="allow_name"class="form-control" value="<?php
                                    if (!empty($ad_info->allow_name)) {
                                        echo $ad_info->allow_name;
                                    }
                                    ?>" id="field-1" placeholder="Allowance Name"/>
                                </div>
                                <!--label for="field-1" class="col-sm-2 control-label">Enter Amount<span class="required"> *</span></label-->
								<div class="col-sm-3">
                                    <input type="text" name="allow_amt"class="form-control" value="<?php
                                    if (!empty($ad_info->allow_amt)) {
                                        echo $ad_info->allow_amt;
                                    }
                                    ?>" id="field-1" placeholder="Enter Your Allowance"/>
                                </div>
                                <!--label for="field-1" class="col-sm-2 control-label">Amount Type<span class="required"> *</span></label-->
								<div class="col-sm-3">
									<select name="allow_amt_type" class="form-control col-sm-5" required>
										<option <?php if(!empty($ad_info->allow_amt_type) && $ad_info->allow_amt_type == 'fix') echo 'selected';?> value="fix" >Fixed</option>
										<option <?php if(!empty($ad_info->allow_amt_type) && $ad_info->allow_amt_type == 'per') echo 'selected';?>  value="per" >Percentage</option>
									</select> 
                                </div>
								<div class="col-sm-3">								
									<?php //print_r($ad_info); ?>
									<select name="allow_account_id" id="allow_account_id" class="form-control" >
                                    <option value="">Select Account...</option>  
                                    <?php if (!empty($account_name)): ?>
                                        <?php foreach ($account_name as $account) : ?>
                                            <option value="<?php echo $account->account_id; ?>" 
                                            <?php
                                            if (!empty($ad_info->allow_account_id) && $account->account_id == $ad_info->allow_account_id) {
                                                echo 'selected';
                                            } 
                                            ?>><?php echo $account->account_name ?></option>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
									</select>
									
                                </div>
                                <!--@ pulkit 06.8 New Col Add For New Field Taxable and Non_taxable  START-->


                                <div class="col-sm-3">
									<select name="allow_amt_tax" class="form-control col-sm-5" required>
										<option <?php //if(!empty($ad_info->allow_amt_tax) && $ad_info->allow_amt_tax == '1') echo 'selected';?> value="1" >Taxable</option>
										<option <?php if($ad_info->allow_amt_tax != '' && $ad_info->allow_amt_tax == 0) echo 'selected';?>  value="0" >NonTaxable</option>
									</select> 
                                </div>
                                <!--@ pulkit 06.8 New Col Add For New Field Taxable and Non_taxable ENDS -->
                            </div> 
					</fieldset>	
					<fieldset>	                           
							<legend align="right">Deduction :</legend>					
                            <div class="form-group">
                                <!--label for="field-1" class="col-sm-2 control-label">Deduction Name<span class="required"> *</span></label-->
								<div class="col-sm-3">
                                    <input type="text" name="did_name"class="form-control" value="<?php
                                    if (!empty($ad_info->did_name)) {
                                        echo $ad_info->did_name;
                                    }
                                    ?>" id="field-1" placeholder="Deduction Name"/>
                                </div>
                                <!--label for="field-1" class="col-sm-2 control-label">Enter Amount<span class="required"> *</span></label-->
								<div class="col-sm-3">
                                    <input type="text" name="did_amt" class="form-control" value="<?php
                                    if (!empty($ad_info->did_amt)) {
                                        echo $ad_info->did_amt;
                                    }
                                    ?>" id="field-1" placeholder="Enter Deduction"/>
                                </div>
                                <!--label for="field-1" class="col-sm-2 control-label">Amount Type<span class="required"> *</span></label-->
								<div class="col-sm-3">
									<select name="did_amt_type" class="form-control col-sm-5" required>
										<option <?php if(!empty($ad_info->did_amt_type) && $ad_info->did_amt_type == 'fix') echo 'selected';?> value="fix" >Fixed</option>
										<option <?php if(!empty($ad_info->did_amt_type) && $ad_info->did_amt_type == 'per') echo 'selected';?>  value="per" >Percentage</option>
									</select> 
                                </div>
								<div class="col-sm-3">								
									<?php //print_r($ad_info); ?>
									<select name="ded_account_id" id="ded_account_id" class="form-control" >
                                    <option value="">Select Account...</option>  
                                    <?php if (!empty($account_name)): ?>
                                        <?php foreach ($account_name as $account) : ?>
                                            <option value="<?php echo $account->account_id; ?>" 
                                            <?php
                                            if (!empty($ad_info->ded_account_id) && $account->account_id == $ad_info->ded_account_id) {
                                                echo 'selected';
                                            } 
                                            ?>><?php echo $account->account_name ?></option>                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
									</select>
									
                                </div>
                                 <!--@pulkit 06.8 New Col Add For New Field Taxable and Non_taxable  START -->


                                <div class="col-sm-3">
									<select name="did_amt_tax" class="form-control col-sm-5" required>
										<option <?php //if(!empty($ad_info->did_amt_tax) && $ad_info->did_amt_tax == 1) echo 'selected="selected"';?> value="1" >Taxable</option>
										<option <?php if($ad_info->did_amt_tax != '' && $ad_info->did_amt_tax == 0) echo 'selected="selected"';?>  value="0" >NonTaxable</option>
									</select> 
                                </div>
                                <!--@pulkit 06.8 New Col Add For New Field Taxable and Non_taxable ENDS -->
                            </div>   
					</fieldset>	        
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
	
