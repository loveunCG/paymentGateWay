<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/card/add_card/', '<i class="fa fa-plus"></i>'.  $this->language->form_heading()[40] ); //echo "<pre>"; print_r($this->language->from_body())?></h4>        
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
                                        <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->form_heading()[41] ?></strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th><?php echo $this->language->from_body()[57][25];?></th>
											<th><?php echo $this->language->from_body()[57][31];?></th>
											<th><?php echo $this->language->from_body()[57][32];?></th>
											<th><?php echo $this->language->from_body()[57][33];?></th>
											<th><?php echo $this->language->from_body()[57][30];?></th>

										</tr>
									</thead>
									<tbody>
										<?php
											//echo "<pre>";										
											//print_r($cinfo);
											//	var_dump($cinfo);
											$i=1;foreach($cinfo as $fund)
											{
												?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td>														
														<b><?php echo $fund['pay_type']; ?></b>													
													</td>                     
													<td>
														<img width="70px" src="<?php echo base_url($fund['logo']) ?>" alt="<?php echo $fund['bank_id'] ?>"/>
													</td>
													<td>
														<b><?php echo $fund['pay_price_type']; ?></b>
														
													</td>													
													<td><?php echo btn_edit('admin/card/add_card/'.$fund['id']); ?>  <?php echo btn_delete('admin/card/delete_card/' . $fund['id']); ?> </td>
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
