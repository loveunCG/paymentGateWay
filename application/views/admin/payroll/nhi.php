<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/payroll/add_nhi/', '<i class="fa fa-plus"></i>'.  $this->language->from_body()[10][21] ); //echo "<pre>";print_r($this->language->from_body())?></h4>        
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
                                        <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->form_heading()[34] ?></strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Sector</th>
                        <th>Employee Age</th>
                        <th>Employee Wages</th>
                        <th>Employer Wages</th>
                        <th>Relationship</th>
                        <th>Rate</th>
                        <th>Account Number</th>
                        <th>Total Wages</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach($funds as $fund){ ?>
                            <tr>
                            	<td><?php echo $i; ?></td>
                            	<td><?php echo $fund['year']; ?></td>                     
                                <td>
								<?php 
									if($fund['sector']=='1') 
									{
										echo "Public";
									} 
									else if($fund['sector']=='2')
									{										
										echo "Private";
									} 
									else if($fund['sector']=='3')
									{										
										echo "Self-Employed";
									} 
									else if($fund['sector']=='4')
									{										
										echo "Voluntary";
									}
									?>
								</td>
                                <td><?php if($fund['emp_min_age']=='0'){echo $fund['emp_max_age']."  and below";} 
                                elseif($fund['emp_max_age']=='0'){echo "above ".$fund['emp_min_age'];} 
                                else{echo "above ".$fund['emp_min_age']." to ". $fund['emp_max_age'];}?></td>
                                <td><?php echo $fund['employee_wage']; ?></td>
                                <td><?php echo $fund['employer_wage']; ?></td>
                                <td><?php echo $fund['relation_ship']; ?></td>
                                <td><?php echo $fund['rate']; ?></td>
                                <td><?php echo $fund['account_id'];?></td>
                                <td><?php echo $fund['total_wages'];?></td>
                                <td><?php echo btn_edit('admin/payroll/add_nhi/'.$fund['id']); ?>  <?php echo btn_delete('admin/payroll/delete_nhi/' . $fund['id']); ?> </td>
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
