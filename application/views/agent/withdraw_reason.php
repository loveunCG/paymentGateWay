<div class="container-fluid">
    <div class="col-md-12" style="margin-top:5%;">
        <div class="panel panel-info">
            <!-- Default panel contents -->
            <div class="panel-heading" style="height: 38px;">
                <div class="panel-title">
                    <strong>提现详细信息</strong><span class="label label-primary  pull-right"><a onclick="history.go(-1);" style="font-size: 15px" >返回</a></span>
                </div>
            </div>
            <div class="panel-body form-horizontal">
                <div class="row">
                    <div class="col-md-4 notice-details-margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>代理ID：</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static">
                                <?php  echo $detail_order->agent_id; ?>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="row">
                  <div class="col-md-4 notice-details-margin">
                      <div class="col-sm-4 text-right">
                          <label class="control-label"><strong>提现金额：</strong></label>
                      </div>
                      <div class="col-sm-8">
                          <p class="form-control-static text-justify">
                              <?php  echo $detail_order->withdraw_mount; ?>￥
                          </p>
                      </div>
                  </div>
                  <div class="col-md-4 notice-details-margin">
                      <div class="col-sm-4 text-right">
                          <label class="control-label"><strong>提现时间：:</strong></label>
                      </div>
                      <div class="col-sm-8">
                          <p class="form-control-static text-justify">
                              <?php  echo $detail_order->withdraw_time; ?>
                          </p>
                      </div>
                  </div>
                  <div class="col-md-4 notice-details-margin">
                      <div class="col-sm-4 text-right">
                          <label class="control-label"><strong><?php if($detail_order->reason!=null){
                            echo '拒绝时间：';
                          }else {
                            echo '成功时间：';
                          }?></strong></label>
                      </div>
                      <div class="col-sm-8">
                          <p class="form-control-static text-justify">
                              <?php  echo $detail_order->withdraw_time; ?>
                          </p>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 notice-details-margin">
                      <div class="col-sm-4 text-right">
                          <label class="control-label"><strong>提现状态:</strong></label>
                      </div>
                      <div class="col-sm-8">
                          <p class="form-control-static text-justify">
                            <?php if($detail_order->pay_state=='1'){
                                echo '<span class="label label-primary ">下发中。。</span>';
                            }elseif($detail_order->pay_state=='3'){
                              echo '<span class="label label-danger ">已拒绝</span>';
                            }elseif($detail_order->pay_state=='2'){
                                echo '<span class="label label-success ">已支付..</span>';
                            }else{
                                echo '<span class="label label-primary ">待审核..</span>';
                            }?>
                          </p>
                      </div>
                  </div>
                  <div class="col-md-8 notice-details-margin">
                      <div class="col-sm-4 text-right">
                          <label class="control-label"><strong>拒绝理由:</strong></label>
                      </div>
                      <div class="col-sm-8">
                          <p class="form-control-static text-justify">
                              <?php  echo $detail_order->reason; ?>
                          </p>
                      </div>
                  </div>
                </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
