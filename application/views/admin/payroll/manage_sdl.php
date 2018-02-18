<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<h4><?php echo anchor('admin/payroll/add_sdl', '<i class="fa fa-plus"></i> Add SDL'); ?></h4>
<div class="row">
    <div class="col-sm-12 wrap-fpanel" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
					
                        <strong>Manage SDL</strong>
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
                        
                        <th>Total wages for month</th>
                        <th>SDL payable</th>
                        <th>Calculation value</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                             <?php 
							 $i=1;
							 foreach($sprs as $spr): ?>
                            <tr>
								<td><?php echo $i; ?></td>
                               
                                <td>$ <?php if($spr->min_sdl_value=='0.000'){echo  '< '. $spr->max_sdl_value;}
														elseif ($spr->max_sdl_value=='0.000') {
															echo  '> '. $spr->min_sdl_value;
														} else{
															echo $spr->min_sdl_value.' <strong>to</strong> '. $spr->max_sdl_value;
														}?>
								</td>
                                <td>$ <?php echo $spr->payable_amount;?></td>
                                <td><?php if($spr->calc=='0.25'){echo '(%)';}else{echo '$';}?> <?php echo $spr->calc;?></td>
								<td>
									<?php echo btn_edit('admin/payroll/add_sdl/'.$spr->id);?>
									 <?php echo btn_delete('admin/payroll/delete_sdl/' . $spr->id); ?>
								
								</td>

                            </tr>                
                      <?php $i++;
					  endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
