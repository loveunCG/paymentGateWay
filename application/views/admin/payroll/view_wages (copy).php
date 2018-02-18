<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
		<div class="col-md-6"><strong><?php echo $this->language->from_body()[10][17] ?>:</strong> <?php echo $spr->name;?></div>
		
		<div class="col-md-6"><strong><?php echo $this->language->from_body()[10][16] ?>:</strong> <?php if($spr->employee_type=='1') echo 'Partial(also known as Graduate) Employer and Employee rates';
		elseif($spr->employee_type=='2') echo 'Full Employer and Partial(also known as Graduate) Employee rates'; ?></div>
		</div>
		<br>

<div class="row">
    <div class="col-sm-12 wrap-fpanel" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
					
                       <strong><?php echo $this->language->form_heading()[34] ?></strong> / <?php echo $spr->name;?>
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
                        <th><?php echo $this->language->from_body()[10][20]; ?></th>
                        <th><?php echo $this->language->from_body()[10][9] ?></th>
						<th><?php echo $this->language->from_body()[10][18] ?></th>
						<th><?php echo $this->language->from_body()[10][19] ?></th>
						<!--<th>Action</th>-->
                    </tr>
                </thead>
                <tbody>
                             <?php 
							 $i=1;
							 foreach($wages as $wage): ?>
                            <tr>
								<td><?php echo $i; ?></td>
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
								<!--<td>
									<?php echo btn_edit('admin/payroll/view_wages/'.$spr_id.'/'.$wage['id']);?>
									 <?php echo btn_delete('admin/payroll/delete_wage/' . $wage['id']); ?>
								</td>-->
                            </tr>                
                      <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
