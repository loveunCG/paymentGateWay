<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">    
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default"><!-- *********     Employee Search Panel ***************** -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo 'Cretae QB Bills' ?></strong>
                    </div>
                </div>      
                <form id="form1" role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/utilities/qb_bills" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row"><br />
                            <div class="col-sm-12 form-groups-bordered">                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Select Month <span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text" required value="<?php
                                        if (!empty($month)) {
                                            echo $month;
                                        }
                                        ?>" class="form-control" id="date" name="txtmonth">
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label">Vendor <span class="required">*</span></label>
									<div class="col-sm-5">
										<select name="vendor_name" class="form-control col-sm-5" required>
											<option value="" >--Select Vendor--</option>
											<?php if (!empty($vendor_info)): ?>
											<?php foreach ($vendor_info as $vendor) : ?>
												<option value="<?php echo $vendor->vendor_id; ?>" 
												<?php
												if (!empty($qb_bill_info->vendor_id) && $vendor->vendor_id == $qb_bill_info->account_id) {
													echo 'selected';
												} 
												?>><?php echo $vendor->vendor_name ?></option>                            
													<?php endforeach; ?>
												<?php endif; ?>
										</select>
									</div>
								</div>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5">
                                        <button id="submit" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">GO</button>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
		<!-- ******************** Employee Search Panel Ends ******************** -->
		<?php
		if(!empty($qb_bills_data))
		{
		?>
		<div class="col-sm-12 print_width">
			<div class="row">       
				<div class="wrap-fpanel">
					<div class="panel panel-default">                                        
						<!-- Default panel contents -->
						<div class="panel-heading">
							<div class="panel-title">
								<strong>Quickbook Bill Data</strong>
							</div>
						</div>
						<!-- Table -->
						<table class="table table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>                                                    
									<th>No.</th>
									<th>Vendor Name</th>
									<th>Date</th>
									<th>Amount Due</th>
									<th>Reference No.</th>
									<th>Bill Due</th>                                        
									<th>Expense Account</th>                                  
									<th>Expense Amount</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$cnt = 1;
							foreach($qb_bills_data as $bills)
							{
							?>
								<tr>
									<td><?php echo $cnt++;?></td>
									<td><?php echo $bills->vendor_name;?></td>
									<td><?php echo date("d,M Y",strtotime($month));?></td>
									<td><?php echo number_format($bills->tot_amount,2)?></td>
									<td><?php echo $reference;?></td>
									<td><?php echo date('d,M Y');?></td>
									<td><?php echo $bills->account_id;?></td>
									<td><?php echo number_format($bills->tot_amount,2);?></td>
								</tr>
							<?php
							}
							?>
							</tbody>
						</table>          
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</div>
<script type="text/javascript">
   	$(function(){
		$('#date').datepicker({
			format : "yyyy-mm",
			autoclose : true,
			minViewMode: "months",
			endDate : new Date()
		});
		
	});
</script>