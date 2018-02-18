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
                            </tr>                
                      <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
