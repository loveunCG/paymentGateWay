<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

	<div class="row margin">      
    <div class="col-sm-9">
        <h4 class="pull-left"><?php echo anchor('admin/company/add_company/', '<i class="fa fa-plus"></i>'.  $this->language->from_body()[41][0] ); //echo "<pre>"; print_r($this->language->from_body())?></h4>        
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
                                        <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->form_heading()[38] ?></strong>
                                    </div>

                                </div>                    
                                <!-- Table -->
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th><?php echo $this->language->from_body()[57][25];?></th>
											<th><?php echo $this->language->from_body()[57][26];?></th>
											<th><?php echo $this->language->from_body()[57][27];?></th>
											<th><?php echo $this->language->from_body()[57][28];?></th>
											<th><?php echo $this->language->from_body()[57][29];?></th>
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
														<b>名称: </b><?php echo $fund['name']; ?><br>
														<b>电子邮件: </b> <?php echo $fund['email']; ?><br>
														<b>网站: </b> <?php echo $fund['website']; ?>
													</td>                     
													<td>
														<img width="70px" src="<?php echo base_url($fund['logo']) ?>" alt="<?php echo $fund['name'] ?>"/>
													</td>
													<td>
														<b>地址: </b><?php echo $fund['address']; ?><br>
														<b>城市: </b> <?php echo $fund['city']; ?>
													</td>
													<td>
														<b>Phone: </b><?php echo $fund['phone']; ?><br>
														<b>Mobile: </b> <?php echo $fund['mobile']; ?><br>
														<b>QQ: </b> <?php echo $fund['qq_num']; ?><br>
														<b>Fax: </b> <?php echo $fund['fax']; ?>
													</td>
													<td><?php echo btn_edit('admin/company/add_company/'.$fund['id_gsettings']); ?>  <?php echo btn_delete('admin/company/delete_company/' . $fund['id_gsettings']); ?> </td>
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
