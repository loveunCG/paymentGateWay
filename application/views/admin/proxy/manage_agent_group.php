<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/proxy/add_agent_group', '<i class="fa fa-plus"></i>添加代理组' ); ?></h4>
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
                                        <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->form_heading()[54] ?></strong>
                                    </div>

                                </div>
                                <br>
                                <!-- ************************ Contact Details End ******************************* -->
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>ID</th>
											<th><?php echo $this->language->from_body()[58][0] ?></th>
											<th><?php echo $this->language->from_body()[58][1] ?></th>
											<th><?php echo $this->language->from_body()[58][2] ?></th>

										</tr>
									</thead>
									<tbody>
										<?php
											foreach($agent_group as $item) {
											?>
												<tr>
													<td>
														<b><?php echo $item->id; ?></b>
													</td>
													<td>
                                                        <b><?php echo $item->agent_group_name; ?></b>
													</td>
													<td>
														<b><?php echo $item->remarks; ?></b>
													</td>
                                                    <td>
                                                        <b><?php echo btn_edit('admin/proxy/add_agent_group/'.$item->id);?>&nbsp;&nbsp;<?php echo btn_delete('admin/proxy/delete_agent_group/'.$item->id);?></b>
                                                    </td>
												</tr>
											<?php } ?>
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>                           
            </div>
        </div>
    </div>
