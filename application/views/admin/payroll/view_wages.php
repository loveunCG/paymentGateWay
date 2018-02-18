<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php if($spr->id==''){?>
<h4><?php echo anchor('admin/payroll/add_spr', '<i class="fa fa-plus"></i> Add SPR'); ?></h4>
<?php }?>
<div class="row">

		<div class="col-md-6"><strong><?php function addSuffix($num) {
											if (!in_array(($num % 100),array(11,12,13))){
											  switch ($num % 10) {
												case 1:  return $num.'st';
												case 2:  return $num.'nd';
												case 3:  return $num.'rd';
											  }
											}
											return $num.'th';
										  }
										   if($spr->id){?><?php echo $this->language->from_body()[10][17] ?>:</strong> <?php echo $spr->name.' '.'-'.' '.addSuffix($spr->year).' '."Year Singapore Permanent Residents".' '.$spr->sector.' '."Sector";?></div>
		
		<div class="col-md-6"><strong><?php echo $this->language->from_body()[10][16] ?>:</strong> <?php if($spr->employee_type=='1') echo 'Partial(also known as Graduate) Employer and Employee rates';
		elseif($spr->employee_type=='2') echo 'Full Employer and Partial(also known as Graduate) Employee rates'; ?>
		<?php } ?></div>
		</div>
		<br>

<div class="row">
    <div class="col-sm-12 wrap-fpanel" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
					
                       <strong><?php echo $this->language->form_heading()[34] ?></strong> <?php if($spr->id){?>/ <?php echo $spr->name.' '.'-'.' '.addSuffix($spr->year).' '."Year Singapore Permanent Residents".' '.$spr->sector.' '."Sector";}?>
                    </span>
                </div>  </div>
				<br>
				       
                <div class="form-group">
                                
                            </div>				
            <!-- Table -->
			 <table class="table table-bordered table-hover" id="dataTables-example">
			 
                <thead>
                    <tr>
						<th>S. No.</th>
						<?php if($spr->id==''){?>
						<th><?php echo $this->language->from_body()[10][17] ?></th>
						<?php }?>
                        <th><?php echo $this->language->from_body()[10][20]; ?></th>
                        <th><?php echo $this->language->from_body()[10][9] ?></th>
						<th><?php echo $this->language->from_body()[10][18] ?></th>
						<th><?php echo $this->language->from_body()[10][19] ?></th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                             <?php 
							
							 $i=1;
							 foreach($wages as $wage): ?>
                            <tr>
								<td><?php echo $i; ?></td>
								<?php if($spr->id==''){?>
								<td><?php echo $wage['name'].' '.'-'.' '.addSuffix($wage['year']).' '."Year Singapore Permanent Residents".' '.$wage['sector'].' '."Sector";?></td>
								<?php }?>
                                <td><?php if($wage['emp_min_age'] == 0) 
											{ 
												echo $wage['emp_max_age'].' '.'and below'; 
											}
											elseif($wage['emp_max_age'] == 0)
											{
												echo 'Above'.' '.$wage['emp_min_age'];
											}
											else
											{ 
												echo 'Above'.' '. $wage['emp_min_age'].' '.'to'.' '.$wage['emp_max_age'];
											}
										?></td>
									 
                              <td><?php if($wage['min_wage'] == 0) 
											{ 
												echo '<='.' '.$wage['max_wage']; 
											}
											elseif($wage['max_wage'] == 0)
											{
												echo '>='.' '.$wage['min_wage'];
											}
											else
											{ 
												echo '>'.' '. $wage['min_wage'].' '.'to'.' '.$wage['max_wage'];
											}
										?></td>
                                <td><?php echo $wage['total_contri']; ?></td>
								<td><?php echo $wage['emp_share']; ?></td>
								<td>
									
									 <?php echo btn_delete('admin/payroll/delete_wage/' . $wage['id']); ?>
								</td>
								<!--<td>
									<?php echo btn_edit('admin/payroll/add_wages/'.$wage['spr_id'].'/'.$wage['id']);?>
									 <?php echo btn_delete('admin/payroll/delete_wage/' . $wage['id']); ?>
								</td>-->
                            </tr>                
                      <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
