<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row margin">
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/accounting/add_accounts_type/', '<i class="fa fa-plus"></i>'.  "Add Account Type"); ?></h4>        
    </div>
</div>
    
<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> <?php echo "Manage Account Type" //$this->language->form_heading()[28] ?></strong>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="table table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Group Name</th>
                                <th>Group Type</th>
                                <th>Credit/Debit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;
							foreach($account_group as $acgroup)
							{ ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                            	<td><?php echo $acgroup->account_group; ?></td>                     
                                <td>
									<?php 
									if($acgroup->account_group_type == 1) 
										echo 'Trading Account'; 
									else if($acgroup->account_group_type == 2) 
										echo 'Profit & Loss'; 
									else if($acgroup->account_group_type == 3) 
										echo 'Balance Sheet'; 
									?>
								</td>
                                <td>
									<?php 
									if($acgroup->credit_debit == 1) 
										echo 'Credit'; 
									else if($acgroup->credit_debit == 2) 
										echo 'Debit'; 
									?>
								</td>
                                <td><?php echo btn_edit('admin/accounting/add_accounts_type/'.$acgroup->id); ?>  <?php echo btn_delete('admin/accounting/delete_accounts_type/' . $acgroup->id); ?> </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
