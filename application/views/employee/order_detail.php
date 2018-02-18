<div class="container-fluid">
    <div class="col-md-12" style="margin-top:5%;">
        <div class="panel panel-info">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>订单详细信息</strong><span class="pull-right"><a onclick="history.go(-1);" class="view-all-front">返回</a></span>
                </div>
            </div>
            <div class="panel-body form-horizontal">
                <div class="row">
                    <div class="col-md-6 notice-details-margin">
                        <?php foreach($detail_order as $val){ ?>
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
                            <label class="control-label"><strong>订单金额</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static text-justify">
                                <?php echo $val->real_amount; ?>￥
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>用户金额</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static"><span><?php echo $val->real_amount*$val->employee_fee/100; ?>￥</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6 notice-details-margin">
                      <div class="col-sm-4 text-right">
                          <label class="control-label"><strong>提交时间</strong></label>
                      </div>
                      <div class="col-sm-8">
                          <p class="form-control-static"><span class="text-danger"> <?php echo $val->submit_time; ?></span></p>
                      </div>
                  </div>
                    <div class="col-md-6 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>成功时间</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static"><span class="text-danger"> <?php echo $val->release_time; ?></span></p>
                        </div>
                    </div>
                  </div>
                    <div class="row">
                        <div class="col-md-6 notice-details-margin">
                            <div class="col-sm-4 text-right">
                                <label class="control-label"><strong>订单状态</strong></label>
                            </div>
                            <div class="col-sm-8">
                                <p class="form-control-static"> <?php
                                if($val->order_status=='1'){
                                            echo '<span class="label label-success ">成功</span>';
                                          }elseif ($val->order_status=='0'){
                                    echo '<span class="label label-primary ">处理中</span>';
                                  }elseif ($val->order_status=='2'){
                                    echo '<span class="label label-danger ">手动补单</span>';
                                  }elseif($val->order_status == '4'){
                                    echo '<span class="label label-danger ">冻结</span>';
                                  }elseif($val->order_status == '5'){
                                    echo '<span class="label label-danger ">已退款</span>';
                                  }else{
                                    echo '<span class="label label-danger ">失败</span>'; }?>


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

                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
