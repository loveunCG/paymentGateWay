<div class="container-fluid">
      <?php  foreach($notice_info as $val){
            $str = $val->title.":".$val->short_description;
            }?>
    <div class="row white-box" style="margin-top: 2%;">
        <div class="col-lg-1">
           <i class="fa fa-bell-o"></i> <strong>公告:

        </div>
        <div class="col-lg-5">
           <marquee><font color="#0099ff" size="3"><?php echo $str;?></marquee></strong>
        </div>
        <div class="col-lg-offset-5 col-lg-1">
        <a href="<?php echo base_url()?>employee/dashboard/all_notice">详细</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="panel-title "><i class="fa fa-user"></i> <strong>商户信息</strong><span class="pull-right"><a href="#" class="view-all-front"></a></span></h2>
                </div>
                <div class="panel-body">
                    <div class="row" style="margin-top: 1%;">
                        <div class="col-sm-4">
                            <span class=""><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您上次登录:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('login_time'); ?></span>
                        </div>
                        <div class="col-sm-4">
                            <span class=""><i class="fa fa-desktop"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登录IP:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>                            <span style="color:red;"><?php if($this->session->userdata('ip')=='::1'){
                            echo '127.0.0.1';
                            }else{
                                echo $this->session->userdata('ip');
                            }

                            ?></span>
                        </div>
                        <div class="col-sm-4">
                            <span class=""><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登录地址:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>                            <span style="color:red;"><?php if($this->session->userdata('ip_location')!=null){
                        echo $this->session->userdata('ip_location');}else{
                        echo "获取失败";}
                        ?></span>
                        </div>

                    </div>
                    <div class="row" style="margin-top: 1%;">
                        <div class="col-sm-4">
                            <span class=""><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;商户ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$employee_details->employee_id "; ?></span>
                        </div>

                        <div class="col-sm-4">
                            <span class=""><i class="fa fa-key"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您的秘钥:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>                            <span style="color:red;"><?php if($employee_details->usr_pay_check_code!=null){
                                      echo "$employee_details->usr_pay_check_code";
                                    } else{
                                    echo "请联系商务获取秘钥";} ?></span>
                        </div>
                        <div class="col-sm-4">
                            <i class="fa fa-shield"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;安全等级：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="label label-primary">中</span>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="panel-title "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单信息</strong></h2>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="primary-link">成交订单：</span>
                                </td>
                                <td>
                                    <?php echo $price['success_count']; ?>
                                </td>
                                <td>
                                    <span class="primary-link">金额</span>
                                </td>
                                <td>
                                    <?php if($price['success_amount']==null){
                                        echo "0.00";}else{
                                        echo $price['success_amount']; }?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">失败订单</span>
                                </td>
                                <td>
                                    <?php echo $price['failed_count']; ?>
                                </td>
                                <td>
                                    <span class="primary-link">金额</span>
                                </td>
                                <td>
                                    <?php if($price['failded_amount']==null){
                                        echo "0.00";
                                    } else{
                                    echo $price['failded_amount'];}

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">处理中订单</span>
                                </td>
                                <td>
                                    <?php echo $price['processing_count'];?>
                                </td>
                                <td>
                                    <span class="primary-link">金额</span>
                                </td>
                                <td>
                                    <?php if($price['processing_amount']==null){
                                        echo "0.00";
                                    }else{
                                    echo $price['processing_amount']; }?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="panel-title "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;财务信息</strong></h2>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="primary-link">今日网银</span>
                                </td>
                                <td>
                                    <?php if($price['onine_amount']==null){
                                    echo "0.00";}else{
                                    echo $price['onine_amount'];
                                    }
                                     ?>
                                </td>
                                <td>
                                    <span class="primary-link">今日财付通</span>
                                </td>
                                <td>
                                     <?php if($price['tenpay_amount']==null){
                                    echo "0.00";}else{
                                    echo $price['tenpay_amount'];
                                    }
                                     ?>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">今日微信支付</span>
                                </td>
                                <td>
                                    <?php if($price['weixin_amount']==null){
                                    echo "0.00";}else{
                                    echo $price['weixin_amount'];
                                    }
                                     ?>
                                </td>
                                <td>
                                    <span class="primary-link">今日支付宝</span>
                                </td>
                                <td>
                                   <?php if($price['ALIPAY_amount']==null){
                                    echo "0.00";}else{
                                    echo $price['ALIPAY_amount'];
                                    }
                                     ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">今日代付</span>
                                </td>
                                <td>
                                     <?php if($price['daufu_amount']==null){
                                    echo "0.00";}else{
                                    echo $price['tenpay_amount'];
                                    }
                                     ?>
                                </td>
                                <td>
                                    <span class="primary-link">已冻结资金</span>
                                </td>
                                <td>
                                    <?php echo "0.00"; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="panel-title "><i class="fa fa-cc-discover" aria-hidden="true"></i> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;提现详情</strong></h2>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="primary-link">账户余额:</span>
                                </td>
                                <td>
                                    <?php echo $employee_details->usr_amount ?>元
                                </td>
                                <td>
                                    <span class="primary-link">可结算金额</span>
                                </td>
                                <td>
                                    <?php echo $jisuan_jine ?>元
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">结算方式</span>
                                </td>
                                <td>
                                    T+<?php echo $employee_details->group_withdraw_time;?>
                                </td>
                                <td>
                                    <span class="primary-link">提现中金额</span>
                                </td>
                                <td>
                                    <?=$taka_money; ?>元
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="panel-title "><i class="fa fa-credit-card-alt" aria-hidden="true"></i><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;即时下发详情</strong>
                        <span
                            class="pull-right"></span>
                    </h2>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="primary-link">账户余额：</span>
                                </td>
                                <td>
                                    <?php echo "$employee_details->usr_amount "; ?>
                                </td>
                                <td>
                                    <span class="primary-link">可结算金额：</span>
                                </td>
                                <td>
                                    <?php echo "$employee_details->usr_amount "; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">结算方式：</span>
                                </td>
                                <td>
                                    <?php echo "D+1"; ?> </td>
                                <td>
                                    <span class="primary-link">下发中金额：</span>
                                </td>
                                <td>
                                    <?php if($price['p_delivery_amount']==null){
                                        echo "0.00";
                                    }
                                    echo $price['p_delivery_amount']; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div-->
    </div>
</div>


<!-- /.box -->
