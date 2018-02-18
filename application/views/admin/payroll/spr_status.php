<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<h4><?php echo anchor('admin/payroll/add_spr', '<i class="fa fa-plus"></i> Add SPR'); ?></h4>
<div class="row">
    <div class="col-sm-12 wrap-fpanel" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
					
                        <strong><?php echo $this->language->form_heading()[34] ?></strong>
                    </span>
                </div>  </div>
				<br>
				 <!-- Table -->
			 <table class="table table-bordered table-hover" id="dataTables-example">
			 
                <thead>
                    <tr>
						<th>S. No.</th>
                        
                        <th>Name</th>
                        <th>Employee Type</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
				<?php function addSuffix($num) {
											if (!in_array(($num % 100),array(11,12,13))){
											  switch ($num % 10) {
												case 1:  return $num.'st';
												case 2:  return $num.'nd';
												case 3:  return $num.'rd';
											  }
											}
											return $num.'th';
										  }
							 
							 $i=1;
							 foreach($sprs as $spr): ?>
                            <tr>
								<td><?php echo $i; ?></td>
                               
                                <td><?php echo $spr['name'].' '.'-'.' '.addSuffix($spr['year']).' '."Year Singapore Permanent Residents".' '.$spr['sector'].' '."Sector";?></td>
                                <td><?php if($spr['employee_type']=='1') { echo 'Partial(also known as Graduate) Employer and Employee rates'; }
										elseif($spr['employee_type']=='2') { echo 'Full Employer and Partial(also known as Graduate) Employee rates'; }
										?></td>
								
								<td>
									<?php echo btn_edit('admin/payroll/add_spr/'.$spr['id']);?>
									 <?php // echo btn_delete('admin/payroll/delete_spr/' . $spr['id']); ?>
									 <?php //echo btn_add_wages('admin/payroll/add_wages/' . $spr['id']); ?>
									 <?php echo btn_view_wages('admin/payroll/view_wages/' . $spr['id']); ?>
								</td>

                            </tr>                
                      <?php $i++;
					  endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
