<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
                <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/proxy/listitem" method="post" class="form-horizontal form-groups-bordered">
                    <div class="row">
                                    <div class="form-group col-lg-2">
                                    <label class="col-md-5 control-label" for="state-danger">代理ID:</label>
                                    <div class="input-group col-md-7">
                                    <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="employee_id" value="<?php if(!empty($employee_id)) echo $employee_id; ?>" >
                                    </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">邮件地址:</label>
                                    <div class="input-group col-md-7">
                                    <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="emp_email" value="<?php if(!empty($emp_email)) echo $emp_email; ?>">
                                    </div>

                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">QQ:</label>
                                    <div class="input-group col-md-7">

                                    <input type="text" class="form-control" style="border-radius: 4px;" name="qq" value="<?php if(!empty($qq)) echo $qq; ?>">
                                    </div>

                                    </div> 
 
                                    <div class="form-group col-lg-2">
                                    <label class="col-md-5 control-label" for="state-danger">联系电话:</label>
                                    <div class="input-group col-md-7">

                                    <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="phone"  value="<?php if(!empty($phone)) echo $phone; ?>">
                                    </div>

                                    </div>
                                    <div class="form-group col-lg-2">
                                    <label class="col-md-5 control-label" for="state-danger">代理状态:</label>
                                    <div class="input-group col-md-7">

                                        <select name="status" class="form-control" style="border-radius: 4px;">                            
                                            <?php if ($status==1) { ?>
                                                <option value="0">所有状态</option>
                                                <option value="1" selected="">等侍验证</option>
                                                <option value="2" >通过验证</option>
                                                <option value="3" >拒绝验证</option>
                                                <option value="4" >冻结商户</option>
                                            <?php }elseif($status==2){ ?>
                                                <option value="0">所有状态</option>
                                                <option value="1" >等侍验证</option>
                                                <option value="2" selected="">通过验证</option>
                                                <option value="3" >拒绝验证</option>
                                                <option value="4" >冻结商户</option>
                                            <?php }elseif($status==3){ ?>
                                                <option value="0">所有状态</option>
                                                <option value="1" >等侍验证</option>
                                                <option value="2" >通过验证</option>
                                                <option value="3" selected="">拒绝验证</option>
                                                <option value="4" >冻结商户</option>
                                            <?php }elseif($status==4){ ?>
                                                <option value="0">所有状态</option>
                                                <option value="1" >等侍验证</option>
                                                <option value="2" >通过验证</option>
                                                <option value="3" >拒绝验证</option>
                                                <option value="4" selected="">冻结商户</option>
                                            <?php }else{ ?>                                                
                                                <option value="0" selected="">所有状态</option>
                                                <option value="1" >等侍验证</option>
                                                <option value="2" >通过验证</option>
                                                <option value="3" >拒绝验证</option>
                                                <option value="4" >冻结商户</option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    </div>                                      

                        </div>                                                                       
                                    

                         <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="sbtn" class="btn btn-primary" style="float: right;margin-right: 10%;" id="i_submit" >&nbsp;&nbsp;&nbsp;&nbsp; 开始查询 &nbsp;&nbsp;&nbsp;&nbsp;</button><br><br></strong>

</form>


</div>
		<?php //print_r($this->language->form_body()[10][7])?>
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->form_heading()[51] ?></strong>
                                    </div>

                                </div>
                                <br>
                                <table class="table table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>代理ID</th>
											<th>邮件地址</th>
											<th>所属代理组</th>
											<th>QQ</th>
											<th>联系人</th>
                                            <th>联系电话</th>
                                            <th>账户金额</th>
                                            <th>注册时间</th>
                                            <th>代理状态</th>
                                            <th>操作</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i=1;
											foreach($all_proxy as $item) {
											?>
												<tr>
													<td>
														<b><?php echo $item->proxy_id; ?></b>
													</td>
													<td>
                                                        <b><?php echo $item->mail_address; ?></b>
													</td>
													<td>
														<b><?php echo $item->agent_group_name; ?></b>

													</td>
                                                    <td>
                                                        <b><?php echo $item->qq_num; ?></b>
                                                    </td>
                                                    <td>
                                                        <b><?php echo $item->contact_person; ?></b>
                                                    </td>
                                                    <td>
                                                        <b><?php echo $item->contact_number; ?></b>
                                                    </td>
                                                    <td>
                                                        <b><?php echo $item->account_amount; ?></b>
                                                    </td>
                                                    <td>
                                                        <b><?php echo $item->registration_time; ?></b>
                                                    </td>
                                                    <td>
                                                        <?php if ($item->proxy_state==2) {
                                                               echo '<span class="label label-success"> 通过验证</span>';
                                                                } elseif($item->proxy_state==1) {
                                                                    echo '<span class="label label-danger"> 等侍验证</span>';              
                                                                 } elseif($item->proxy_state==3) {
                                                                    echo '<span class="label label-danger"> 拒绝验证</span>';              
                                                                 }  elseif($item->proxy_state==4) {
                                                                    echo '<span class="label label-danger">  冻结代理</span>';              
                                                                 }  
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo btn_edit('admin/proxy/add_proxy/'.$item->proxy_id); ?>  <?php echo btn_delete('admin/proxy/delete_proxy/' . $item->proxy_id); ?>
                                                    </td>

<!--													<td>--><!-- </td>-->
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
