<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- Table -->
<div class=" col-sm-2"></div>



<div class="col-sm-8 well" style="padding-top: 5%;">
    <div class="row">
        <form id="contact_form" action="<?php echo base_url() ?>employee/admin/order_proc" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>商户ID*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id" disabled="disabled" value="<?php echo $order_info->employment_id?>">
                            </div>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>订单号码* </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                <input type="text" class="form-control" name="order_id" disabled="disabled" value="<?php echo $order_info->order_id?>">
                            </div>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>支付方式*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="pay_type" disabled="disabled" value=" <?php echo $order_info->pay_type ?>">
                            </div>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>支付通道*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                                <input type="text" class="form-control" id="cha_name" disabled="disabled" value="<?php echo $order_info->cha_name ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>用户金额* </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-jpy" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name = "usr_amount" disabled="disabled" value="<?php echo $order_info->usr_amount;?>">
                            </div>
                        </div>                       
                        <div class="col-sm-4 form-group">
                            <label>卡号* </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                <input type="text" class="form-control" name = "recharge_card_num" disabled="disabled" value="<?php echo $order_info->recharge_card_num;?>">
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>卡密* </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" disabled="disabled" value="<?php echo $order_info->recharge_card_pass;?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label>成本比列: </label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-credit-card"></i>
                                </div>
                                <input type="text" class="form-control" name = "cha_rate" disabled="disabled" value="<?php echo $order_info->cha_rate;?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>成功金额 </label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-jpy" aria-hidden="true"></i>
                                </div>
                                <input type="text" class="form-control" name="success_price" value="<?php echo $order_info->success_price;?>" >
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>平台收益</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-jpy" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="law_name" class="form-control" value="<?php echo $order_info->success_price*$order_info->cha_rate;?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>代理收益 *</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                   <i class="fa fa-jpy" aria-hidden="true"></i>
                                </div>
                                <input type="text" class="form-control" id="usr_email" disabled="disabled" value="<?php echo $order_info->cha_rate*$order_info->success_price;?>">
                            </div>

                        </div>
                        <div class="col-sm-4 form-group">
                            <label>订单代码:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                   <i class="fa fa-key" aria-hidden="true"></i>
                                </div>
                                <input type="text" id="order_code" name="order_code" class="form-control" value="<?php echo $order_info->order_code;?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>提交时间</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                <input type="text" class="form-control" disabled="disabled" value="<?php echo date('d M Y', strtotime($order_info->submit_time)) ?>">
                            </div>
                        </div>
                        <!-- /.input group -->
                        <div class="col-sm-4 form-group">
                            <label>发布时间</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                <input type="text" class="form-control" disabled="disabled" value="<?php echo date('d M Y', strtotime($order_info->release_time)) ?>">
                            </div>
                        </div>
                        <!-- /.input group -->
                        <div class="col-sm-4 form-group">
                            <label>成功时间</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                <input type="text" class="form-control" disabled="disabled" value="<?php echo date('d M Y', strtotime($order_info->pay_time)) ?>">
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>                
                   
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>支付金额*</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-euro"></i></span>
                                <input type="number" class="form-control" name="usr_amount" id="usr_amount">
                            </div>
                        </div>
                    </div>                
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-block btn-info" >订单处理 </button>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                          <button type="button" onclick="history.go(-1);" class="view-all-front btn btn-block btn-info ">退出</button>
                        </div>
                    </div>
    </div>
    </fieldset>
    </form>
</div>
</div>
<style>
    #success_message {
        display: none;
    }
</style>

