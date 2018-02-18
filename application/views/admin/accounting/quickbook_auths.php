<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row margin">
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/accounting/add_quickbook_sysauth/', '<i class="fa fa-plus"></i>'.  "Add QB Online Setup"); ?></h4>        
    </div>
</div>
    
<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> <?php echo "Manage QB Online Setup" //$this->language->form_heading()[28] ?></strong>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="table table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>App Token</th>
								<th>OAuth Consumer Key</th>
								<th>OAuth Consumer Secret</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
							if(!empty($qb_class_info))
							{
								$i=1;
								foreach($qb_class_info as $qb_cls)
								{ 
							?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $qb_cls->quickbooks_app_token; ?></td>
								<td><?php echo substr($qb_cls->app_consumer_key,0,10); ?></td>
								<td><?php echo substr($qb_cls->app_consumer_secret,0,10); ?></td>
                                <td>
								<?php 
									echo btn_edit('admin/accounting/add_quickbook_sysauth/'.$qb_cls->quickbooks_auth_id); 
									echo btn_delete('admin/accounting/delete_quickbooks_sysauth/' . $qb_cls->quickbooks_auth_id);
								?> </td>
                            </tr>
                            <?php 
									$i++; 
								}
							}
							?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
