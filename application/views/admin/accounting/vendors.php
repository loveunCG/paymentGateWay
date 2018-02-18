<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row margin">
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/accounting/add_vendors/', '<i class="fa fa-plus"></i>'.  "Add Vendors"); ?></h4>        
    </div>
</div>
    
<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> <?php echo "Manage Vendors" //$this->language->form_heading()[28] ?></strong>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="table table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vendor Name</th>
                                <th>Company Name</th>
                                <th>Contact Details</th>
                                <th>Our A/c with vendor</th>
                                <th>General Journal Account</th>
                                <th>Payment Terms</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
							if(!empty($vendor_info))
							{
								$i=1;
								foreach($vendor_info as $vendor)
								{ 
							?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $vendor->vendor_name; ?></td>
                                <td><?php echo $vendor->company_name; ?></td>
                                <td>
									<p>Address : <?php echo $vendor->address; ?><p>
									<p>Phone : <?php echo $vendor->main_phone; ?><p>
									<p>Email : <?php echo $vendor->main_email; ?><p>
									<p>Website : <?php echo $vendor->website; ?><p>
								</td>
                                <td><?php echo $vendor->account_with_vendor; ?></td>
                                <td><?php echo $vendor->general_journal; ?></td>
                                <td><?php echo $vendor->account_with_vendor; ?></td>
                                <td>
								<?php 
									echo btn_edit('admin/accounting/add_vendors/'.$vendor->vendor_id); 
									echo btn_delete('admin/accounting/delete_vendors/' . $vendor->vendor_id);
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
