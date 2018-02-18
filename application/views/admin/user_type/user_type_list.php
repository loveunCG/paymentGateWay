
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
		<div class="col-sm-9">
			<h4 class="pull-left"><a href="<?php echo base_url("admin/user_permission/create_user_type")?>"><i class="fa fa-plus"></i><?php echo $this->language->from_body()[9][8] ?></a></h4>        
		</div>

	</div>
<div class="row">
    <div class="col-sm-12" data-spy="scroll" data-offset="0">
        <div class="wrap-fpanel">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->from_body()[9][9] ?></strong>
                    </div>
                </div>
                <!-- Table -->
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr class="active" >
                            <th class="col-sm-1"><?php echo $this->language->from_body()[9][1] ?></th>
                            <th><?php echo $this->language->from_body()[9][3] ?></th>                                            
                            <th class="col-sm-5" colspan=2><?php echo $this->language->from_body()[10][14] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $key = 0 ?>
                        <?php if (count($user_type_info)): foreach ($user_type_info as $user_type) : ?>
                                <?php if ($user_type->user_type_id!=1) { ?>
                                <tr>
                                    <td><?php echo $key ?></td>
                                    <td><?php echo "$user_type->user_type"; ?></td>
									<td>
										<a href=" <?php echo base_url() ?>admin/user_permission/create_user_type/<?php echo $user_type->user_type_id; ?>"><i class="fa fa-edit"></i> 
											<?php echo $this->language->from_body()[9][10] ?>
										</a>
                                    </td>   
                                    <td>
                                    <?php                                      
                                 
                                        echo btn_delete('admin/user_permission/delete_user_type/' . $user_type->user_type_id);                                  
                                     ?>

                                    </td>
                                </tr>
                                <?php } ?>
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

