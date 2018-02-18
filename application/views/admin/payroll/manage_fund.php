<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/payroll/add_ethnic_fund/', '<i class="fa fa-plus"></i> Add Ethnic Fund'); ?></h4>        
    </div>

</div>
    
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-calendar"></i> <?php echo $this->language->form_heading()[30]; ?></strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="col-sm-1">S. No</th>
						<th><?php echo $this->language->from_body()[10][12] ?></th>
                        <th><?php echo $this->language->from_body()[10][9] ?></th>
                        <th><?php echo $this->language->from_body()[10][11] ?></th>
                        <th><?php echo $this->language->from_body()[10][14] ?></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;
					foreach($ethnicFunds as $info){ ?>
                            <tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $info->name; ?></td>
                                <td><?php if($info->min_wage == 0){echo '<= '.$info->max_wage;}elseif($info->max_wage == 0){echo '> '.$info->min_wage;}else{echo '> '.$info->min_wage.' to '.$info->max_wage;} ?></td>
                                <td><?php echo $info->monthly_contribution; ?></td>
                                <td><?php echo btn_delete('admin/payroll/delete_fund/' . $info->id); ?> </td>
                            </tr>                
                        <?php $i++;} ?>
                </tbody>
            </table>
                            </div>
                        </div>
                    </div>                           
            </div>
        </div>
    </div>
