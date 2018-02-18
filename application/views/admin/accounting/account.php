<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row margin">
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/accounting/add_account/', '<i class="fa fa-plus"></i>'.  "Add Account"); ?></h4>        
    </div>
</div>
    
<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> <?php echo "Manage Account" //$this->language->form_heading()[28] ?></strong>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="table table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Account ID</th>
                                <th>Account Name</th>
                                <th>Group Name</th>
                                <th>Account Type</th>
                                <!--<th>Debit</th>
                                <th>Credit</th>
                                -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
							if(!empty($account_info))
							{
								$i=1;
								foreach($account_info as $account)
								{ 
							?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $account->account_id; ?></td>
                                <td><?php echo $account->account_name; ?></td>
                                <td><?php echo $account->account_group; ?></td>
                                <td>
									<?php 
									if($account->account_group_type == 1) 
										echo 'Trading Account'; 
									else if($account->account_group_type == 2) 
										echo 'Profit & Loss'; 
									else if($account->account_group_type == 3) 
										echo 'Balance Sheet'; 
									?>
								</td>
                               <!-- <td><?php //echo $fund['acdramt']; ?></td>
                                <td><?php //echo $fund['accramt']; ?></td> -->
                                <td>
								<?php 
									echo btn_edit('admin/accounting/add_account/'.$account->id); 
									echo btn_delete('admin/accounting/delete_account/' . $account->id);
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
