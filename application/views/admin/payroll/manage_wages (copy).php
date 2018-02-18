<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<h4><?php echo anchor('admin/payroll/add_wages', '<i class="fa fa-plus"></i> Add SPR Wage'); ?></h4>				
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
				       
                <div class="form-group">
                                
                            </div>				
            <!-- Table -->
			
			 <table class="table table-bordered table-hover" id="dataTables-example">
			 
                <thead>
                    <tr>
						<th>S. No.</th>
						 <th><?php echo $this->language->from_body()[10][17]; ?></th>
						
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
							 foreach($allWages as $wage): ?>
                            <tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $wage['name']; ?></td>
								
                                <td><?php if($wage['employee_age']=='1') {echo '50 and below'; }
										elseif($wage['employee_age']=='2') {echo 'Above 50 to 55'; }
										elseif($wage['employee_age']=='3') {echo 'Above 55 to 60'; }
										elseif($wage['employee_age']=='4') {echo 'Above 60 to 65'; }
										elseif($wage['employee_age']=='5') {echo 'Above 65'; } ?></td>
                                <td><?php if($wage['monthly_wages'] == '1') { echo '<= $50';}
										elseif($wage['monthly_wages'] == '2') { echo '>$50 to $500';}
										elseif($wage['monthly_wages'] == '3') { echo '>$500 to $750';}
										elseif($wage['monthly_wages'] == '4') { echo '>= $750';}?></td>
                                <td><?php echo $wage['total_contribution']; ?></td>
								<td><?php echo $wage['employee_share']; ?></td>
								<td>
									<?php echo btn_edit('admin/payroll/add_wages/'.$wage['spr_id'].'/'.$wage['id']);?>
									 <?php echo btn_delete('admin/payroll/delete_wage/' . $wage['id']); ?>
								</td>
                            </tr>                
                      <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
