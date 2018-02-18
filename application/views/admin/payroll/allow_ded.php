<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/payroll/add_allow_ded/', '<i class="fa fa-plus"></i>'.  $this->language->from_body()[19][0] ); //echo "<pre>";print_r($this->language->from_body())?></h4>        
    </div>

</div>
		<?php //print_r($this->language->form_body()[10][7])?>
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->form_heading()[36] ?></strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Allowance</th>
                        <th>Deduction</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach($funds as $fund){ ?>
                            <tr>
                            	<td><?php echo $i; ?></td>
                            	<td>
									<b>Allowance Name: </b><?php echo $fund['allow_name']; ?><br>
									<b>Allowance Amount: </b><?php echo $fund['allow_amt']; ?><br>
									<b>Amount Type: </b><?php if($fund['allow_amt_type']== 'fix') { echo "Fixed";}else { echo "Percentage";}?><br>
									<b>Amount Tax Type: </b><?php if($fund['allow_amt_tax']== 0) { echo "Non Taxable";}else { echo "Taxable";}?><br>
									<b>Account Id: </b><?php echo $fund['allow_account_id']; ?><br>
								</td>
                            	<td>
									<b>Deduction Name: </b><?php echo $fund['did_name']; ?><br>
									<b>Deduction Amount: </b><?php echo $fund['did_amt']; ?><br>
									<b>Amount Type: </b><?php if($fund['did_amt_type']== 'fix') { echo "Fixed";}else { echo "Percentage";}?><br>
									<b>Amount Tax Type: </b><?php if($fund['did_amt_tax']== 0) { echo "Non Taxable";}else { echo "Taxable";}?><br><!--@pulkit 17-8-2016 for show did amount tax -->
									<b>Account Id: </b><?php echo $fund['ded_account_id']; ?><br>
								</td>          
                                <td><?php echo btn_edit('admin/payroll/add_allow_ded/'.$fund['id']); ?>  <?php echo btn_delete('admin/payroll/delete_allow_ded/' . $fund['id']); ?> </td>
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
