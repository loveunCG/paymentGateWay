<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<!-- Every page of your app should have this snippet of Javascript in it, so that it can show the Blue Dot menu -->
		<script type="text/javascript" src="https://appcenter.intuit.com/Content/IA/intuit.ipp.anywhere.js"></script>
		<script type="text/javascript">
		intuit.ipp.anywhere.setup({
			menuProxy: 'http://payrollupdates.backofficevi.com/qbweb-app/docs/partner_platform/example_app_ipp_v3/menu.php',
			grantUrl: 'http://payrollupdates.backofficevi.com/qbweb-app/docs/partner_platform/example_app_ipp_v3/oauth.php'
		});
		</script>

<div class="row margin">   
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo "QB Online Setup" //$this->language->from_body()[10][7] ?></strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form" action="<?php echo base_url(); ?>admin/accounting/save_quickbooks_sysauth/<?php
                        if (!empty($qb_class_info->quickbooks_auth_id)) {
                            echo $qb_class_info->quickbooks_auth_id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">
                       
					   <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Quickbook App Token<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="quickbooks_app_token" value="<?php
                                    if (!empty($qb_class_info->quickbooks_app_token)) {
                                        echo $qb_class_info->quickbooks_app_token;
                                    }
                                    ?>" >
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">OAuth Consumer Key<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="app_consumer_key" value="<?php
                                    if (!empty($qb_class_info->app_consumer_key)) {
                                        echo $qb_class_info->app_consumer_key;
                                    }
                                    ?>" >
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">OAuth Consumer Secret<span class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" required name="app_consumer_secret" value="<?php
                                    if (!empty($qb_class_info->app_consumer_secret)) {
                                        echo $qb_class_info->app_consumer_secret;
                                    }
                                    ?>" >
                            </div>
                        </div>
						
						<p>
		

		<?php if ($_SESSION['qb_connected']==1): ?>
			<div style="border: 2px solid green; text-align: center; padding: 4px 8px; color: green;">
				<br>YOU ARE CONNECTED TO QUICKBOOKS ONLINE!<br>
				<a href="http://payrollupdates.backofficevi.com/qbweb-app/docs/partner_platform/example_app_ipp_v3/disconnect.php">Disconnect</a><br>
				
			</div>

		<?php else: ?>
			<div style="text-align: center; padding: 8px; color: red;">
				
				<br>
				<ipp:connectToIntuit></ipp:connectToIntuit>
				<br>
				<br>
				You must authenticate to QuickBooks <b>once</b> before you can exchange data with it. <br>
				<br>
				
			</div>	
		<?php endif; ?>		

	</p>
						
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
	