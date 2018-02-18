<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<h4><?php echo anchor('admin/payroll/foreign_levy', '<i class="fa fa-plus"></i> Add FWL'); ?></h4>
<div class="row">
    <div class="col-sm-12 wrap-fpanel" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
					
                        <strong><?php echo $this->language->form_heading()[27] ?></strong>
                    </span>
                </div>  </div>
				<br>
				       
                <div class="form-group">
                                
                            </div>
            <!-- Table -->
			 <table class="table table-bordered table-hover" id="dataTables-example">
			 
                <thead>
                    <tr>
                        <th >S. No</th>
                 
                        <th>Year</th>
                        <th>Sectors/Pass Type</th>
						<th>Factors</th>
                        <th>Tier</th>
                        <th>Levy Rate</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                             <?php $i=1; foreach($levies as $levy): ?>
							         
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $levy['year'];?></td>
                                <td><?php if($levy['sectors']=='1') { echo 'Services'; }
										elseif($levy['sectors']=='2') { echo 'Manufacturing'; }
										elseif($levy['sectors']=='3') { echo 'Construction'; }
										elseif($levy['sectors']=='4') { echo 'Process'; }
										elseif($levy['sectors']=='5') { echo 'Marine'; }
										elseif($levy['sectors']=='6') { echo 'S Pass'; }
											 ?></td>
								<td><?php if($levy['factors']=='1') { echo 'Skilled';}
										elseif($levy['factors']=='2') { echo 'Unskilled';} ?></td>
                                <td><?php if($levy['tier']=='1') { echo 'Basic/Tier 1';}
										elseif($levy['tier']=='2') { echo 'Tier 2';}
										elseif($levy['tier']=='3') { echo 'Tier 3';}
										elseif($levy['tier']=='4') { echo 'MYE';}
										elseif($levy['tier']=='5'){ echo 'MYE Waiver';} ?></td>
                               
                                <td><?php echo $levy['levy_rate']; ?></td>
                                <td><?php //echo btn_add('admin/payroll/foreign_levy/');?>
									<?php echo btn_edit('admin/payroll/foreign_levy/'.$levy['id']);?>
									 <?php echo btn_delete('admin/payroll/delete_levy/' . $levy['id']); ?>
								</td>
                            </tr>                
                      <?php $i++;endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#date').datepicker({
            format: "yyyy",
        });
    });
</script>