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
                        <div class="col-sm-6 form-group">
                            <label>商户ID:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id" value="<?php echo $order_info->employee_id?>">
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>银行订单:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id" value="<?php echo $order_info->sys_serial_num?>">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>商户订单号:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id"  value="<?php echo $order_info->employment_id."_".$order_info->order_id;?>">
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>订单号码:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id" value="<?php echo $order_info->order_id;?>">
                            </div>
                        </div>
                        <!-- <div class="col-sm-6 form-group">
                            <label>充值卡号:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id"  value="<?php echo "";?>">
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>状态：</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id"  value="<?php if($order_info->order_status=='1'){
                                    echo '支付成功';
                                }else if($order_info->order_status=='0') {
                                    echo '处理中';

                                } else if($order_info->order_status=='5'){
                                    echo '补单处理中。。';

                                }else if($order_info->order_status=='7'){
                                    echo '退款成功。。';
                                  }
                                  else if($order_info->order_status=='6'){
                                      echo '申请退款。。';
                                    }
                                    else if($order_info->order_status=='4'){
                                        echo '冻结。';
                                      }else if($order_info->order_status=='-1'){
                                    echo '失败。';

                                }else if($order_info->order_status=='2'){
                              echo '手动补单';

                          }?>">
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>客户端返回信息:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id"  value="<?php if($order_info->order_status==1){
                                    echo 'ok';
                                }else{
                                    echo '';

                                }?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>上级网关商户ID:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id"  value="<?php echo $order_info->partner;?>">
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>下发次数:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id"  value="<?php echo "1";?>">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>接口网关:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                                <input type="text" class="form-control" name="employment_id"  value="<?php
                              $banktype =  $order_info->pay_method;

                                if($banktype == 'ALIPAY'){
                                  $chanel_name = '支付宝';
                                  $chanel_limit = "alipay_limit";
                                }elseif($banktype == 'ALIPAYWAP'){
                                  $chanel_name = '支付宝WAP';
                                  $chanel_limit = "wapalipay_limit";
                                }elseif($banktype == 'TENPAY'){
                                  $chanel_name = '财付通';
                                  $chanel_limit = "tenpay_limit";
                                }
                                elseif($banktype == "WEIXIN"){
                                  $chanel_name = '微信';
                                  $chanel_limit = "weixin_limit";
                                }
                                elseif($banktype == 'WEIXINWAP'){
                                  $chanel_name = '微信WAP';
                                  $chanel_limit = "weixin_limit";
                                }  elseif($banktype == 'DAIFU'){
                                  $chanel_name = 'channel_daifu';
                                  $chanel_limit = "online_limit";
                                }
                                else{
                                  $chanel_name = '网银';
                                  $chanel_limit = "online_limit";
                                  $banktype_clone = "ONLINE";
                                }

                                echo $chanel_name;
                                ?>">
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>提交IP:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="employment_id"  value="<?php echo $order_info->client_ip;?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>下发参数组:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <textarea name="short_description" class="form-control" rows="5" required placeholder="" aria-required="true" >
                                    <?php echo $order_info->order_url;?>
                                </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                      <div class="col-sm-4">
                      </div>
                      <div class="col-lg-3">
                        <input type="submit" class="btn btn-primary" id="btnSendMobile" value="重发订单"/>

                      </div>
                      <div class="col-lg-3">
                        <button type="button" onclick="history.go(-1);" class="btn btn-primary" >返回</button>

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
