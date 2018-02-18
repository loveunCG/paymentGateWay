<div class="container-fluid">
    <div class="col-md-12" style="margin-top:5%;">
        <div class="panel panel-info">
            <!-- Default panel contents -->
            <div class="panel-heading" style="height: 38px;">
                <div class="panel-title">
                    <strong>公告详细信息</strong><span class="label label-primary  pull-right"><a onclick="history.go(-1);" style="font-size: 15px" >退出</a></span>
                </div>
            </div>
            <div class="panel-body form-horizontal">
            <?php foreach($detail_order as $val){ ?>
                <div class="row">
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>订单号码:</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static">
                                <?php  echo $val->order_id; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>充值卡号:</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static text-justify">
                                <?php  echo $val->recharge_card_num; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>银行订单:</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static">
                                <?php  echo $val->sys_serial_num; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>商户订单号:</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static text-justify">
                                <?php  echo $val->employee_id.'-'.$val->order_id; ?>
                            </p>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>客户端返回信息:</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static">
                            <?php if($val->order_status==1){
                                    echo 'ok';
                                }else{
                                    echo '';

                                }?>                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>提交IP:</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static text-justify">
                                <?php  echo $val->client_ip; ?>
                            </p>
                        </div>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>订单金额</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static text-justify">
                                <?php echo $val->real_amount; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>用户金额</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static"><span class="text-danger"><?php echo $employee_details->usr_amount; ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>支付通道</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static"><span class="text-danger"><?php echo $val->channel_name; ?></span></p>
                        </div>
                    </div>
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>支付时间</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static"><span class="text-danger"> <?php echo $val->submit_time; ?></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 notice-details-margin">
                            <div class="col-sm-4 text-right">
                                <label class="control-label"><strong>订单状态</strong></label>
                            </div>
                            <div class="col-sm-8">
                                <p class="form-control-static"><span class="text-danger"> <?php if($val->order_status=='0'){
                                    echo '<span class="label label-primary ">处理中</span>';
                                            }elseif ($val->order_status=='1'){
                                    echo '<span class="label label-success ">成功</span>'; 
                                     }elseif ($val->order_status=='4'){
                                    echo '<span class="label label-danger ">派出中</span>'; }elseif($val->order_status == '3'){
                                    echo '<span class="label label-danger ">失败</span>'; }?>

                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 notice-details-margin">
                            <div class="col-sm-4 text-right">
                                <label class="control-label"><strong>上级网关商户ID</strong></label>
                            </div>
                            <div class="col-sm-8">
                                <p class="form-control-static"><span class="text"> <?php echo $val->partner; ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 notice-details-margin">
                            <div class="col-sm-4 text-right">
                                <label class="control-label"><strong>提交IP</strong></label>
                            </div>
                            <div class="col-sm-8">
                                <p class="form-control-static"><span class="text"> <?php if( $val->client_ip=='::1'){
                        echo '127.0.01';
                        }else{
                        echo $val->client_ip;} ?></span></p>
                            </div>
                        </div>
                        <div class="col-md-6 notice-details-margin">
                            <div class="col-sm-4 text-right">
                                <label class="control-label"><strong>接口网关</strong></label>
                            </div>
                            <div class="col-sm-8">
                                <p class="form-control-static"><span class="text"> <?php echo $val->channel_name; ?></span></p>
                            </div>
                        </div>
                         <div class="row">
                    <div class="col-md-12 " style="margin-left: -15%">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>下发参数组</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static text-justify">
                                <?php echo $val->order_url; ?>
                            </p>
                        </div>
                    </div>                    
                </div>

                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>