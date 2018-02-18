
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<h4><?php echo anchor('admin/user/create_user/', '<i class="fa fa-plus"></i> '.$this->language->form_heading()[58] ); ?></h4>
<div class="row">
    <div class="col-sm-12" data-spy="scroll" data-offset="0">
        <div class="wrap-fpanel">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->from_body()[9][0] ?></strong>
                    </div>
                </div>
                <br />
                <!-- Table -->
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr class="active" >
                            <th class="col-sm-1"><?php echo $this->language->from_body()[9][1] ?></th>
                            <th><?php echo $this->language->from_body()[9][2] ?></th>
                          <!--  <th>Department</th>-->

                            <th class="col-sm-1"><?php echo $this->language->from_body()[9][3] ?></th>                                             
                            <th class="col-sm-5" colspan=2><?php echo $this->language->from_body()[10][14] ?></th> 
                        </tr>
                    </thead>
                    <tbody>  
						
                        <?php $key = 1 ?>
                        <?php if (count($all_user_info)): foreach ($all_user_info as $v_employee) : ?>
                            <?php if ($v_employee->user_id!=1) { ?>
                            
                           
                                <tr>
                                    <td><?php echo $key ?></td>
                                    <td><?php echo $v_employee->user_name ?></td>
                                     <?php /* echo $v_employee->department_name */?> 

                                    <td><?php echo  $v_employee->user_type  ?></td>                                
                                    <td>
										<a href=" <?php echo base_url() ?>admin/user/create_user/<?php echo  $v_employee->user_id  ?>"><i class="fa fa-edit"></i> 
											<?php echo $this->language->from_body()[9][4] ?>
										</a>
                                    </td>   
                                    <td>
                                    <?php echo btn_delete('admin/user/delete_user/'.$v_employee->user_id ); ?>
                                    </td> 
                                    
                                </tr>
                                <?php  } ?>
                                <?php
                                $key++;
                            endforeach;
                            ?>
                        <?php else : ?>
                        <td colspan="3">
                            <strong>没有记录显示！</strong>
                        </td>
                    <?php endif; ?>
                    </tbody>
                </table>          
            </div>
        </div>
    </div>
</div>

