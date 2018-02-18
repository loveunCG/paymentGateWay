<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="col-md-12">
    <p class="title">
        <b>提现记录 </b>
    </p>

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2 class="panel-title "><i class="fa fa-university"></i><strong>账户信息</strong></h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>
                                    <span class="primary-link">开户银行：</span>
                                </td>
                                <td>
                                    <?php echo "$agent_details->open_an_account_bank "; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">开户姓名：</span>
                                </td>
                                <td>
                                    <?php echo "$agent_details->contact_person "; ?>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">银行帐号:</span>
                                </td>
                                <td>
                                    <?php echo "$agent_details->bank_card_number"; ?>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2 class="panel-title "><i class="fa fa-university"></i> <strong>&nbsp;银行信息</strong></h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>
                                    <span class="primary-link">帐户余额：</span>
                                </td>
                                <td>
                                    <?php if(!empty($agent_details->account_amount)){ echo $agent_details->account_amount;
                                    }else{
                                        echo "0.00";
                                        } ?>元
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">可结算金额：</span>
                                </td>
                                <td>
                                    <?php if(!empty($agent_jisuan)){ echo $agent_jisuan;
                                    }else{
                                        echo "0.00";
                                        } ?>元
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">总订单金额：</span>
                                </td>
                                <td>
                                    <?php foreach ($order_info as $value) {
                                      $sum_order = $sum_order + $value->real_amount;
                                    }
                                    if(!empty($sum_order)){ echo $sum_order;
                                    }else{
                                        echo "0.00";
                                        } ?>元
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="primary-link">提现中金额：</span>
                                </td>
                                <td>
                                   <?php if(!empty($withdraw_amount)){ echo $withdraw_amount;
                                    }else{
                                        echo "0.00";
                                    } ?>元
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2 class="panel-title "><i class="fa fa-university"></i><strong>代理提现</strong></h2>
        </div>

        <div class="panel-body">
              <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>agent/dashboard/save_pay_withdraw" method="post" class="form-horizontal form-groups-bordered">
                <input type="hidden" class="form-control" name="withdraw_limit" value="<?php if(!empty($agent_jisuan)){ echo $agent_jisuan;
                        }else{echo 0;} ?>">
                        <div class="row">
                          <div class="col-sm-3">
                          </div>
                            <div class="col-sm-offest-2 col-sm-6 form-group">
                                <label>提现金额:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" id = "withdraw_mount" name="withdraw_mount" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-3">
                          </div>
                            <div class="col-sm-6 form-group">
                                <label>短信验证吗:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" name="sms_content" value="">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                          </div>
                          <div class="col-lg-3">
                            <input type="button" class="btn btn-primary" id="btnSendMobile" onclick="return sendMobileCode()" value="送发短信"/>

                          </div>
                          <div class="col-lg-3">
                            <button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" >申请提现</button>

                          </div>

                        </div>

              </form>

            </table>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">

                        </div>

                    </div>
                    <!-- Table -->
                    <table class="table table-bordered table-hover" id="dataTables-example" style="text-align: center;">
                        <thead>
                        <tr>
                            <th style="text-align: center;">提现金额</th>
                            <th style="text-align: center;">手续费率</th>
                            <th style="text-align: center;">手续费</th>
                            <th style="text-align: center;">提现时间</th>
                            <th style="text-align: center;">支付时间</th>
                            <th style="text-align: center;">状态</th>


                        </tr>
                        </thead>
                        <tbody >
                        <?php
                        //echo "<pre>";
                        //print_r($cinfo);
                        //	var_dump($cinfo);
                        $i=1;foreach($withdraw_request as $fund)
                        {
                            ?>
                            <tr>
                                <td>
                                    <b><?php echo $fund['withdraw_mount']; ?></b>
                                </td>
                                <td>
                                    <b><?php echo $agnet_fee->default_rate; ?>%</b>
                                </td>
                                <td>
                                    <b><?php echo $fund['fee']; ?></b>

                                </td>
                                <td>
                                <b><?php echo $fund['withdraw_time']; ?></b>
                                </td>
                                <td>
                                <b><?php echo $fund['pay_time']; ?></b>
                                </td>
                                <td>
                                    <b><?php if($fund['pay_state']=='1'){
                                        echo '<span class="label label-primary ">提现中。。</span>';
                                    }elseif($fund['pay_state']=='3'){
                                      echo '<span class="label  col-sm-12" >'.btn_view2('agent/dashboard/withdraw_reason/'.$fund['id']).'</span>';
                                    }elseif($fund['pay_state']=='2'){
                                        echo '<span class="label label-success ">已支付。。</span>';
                                    }else{
                                        echo '<span class="label label-primary ">待审核。。</span>';
                                    }
                                    ?></b>
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
<script type="text/javascript">


function sendMobileCode() {
    var InterValObj; //timer变量，控制时间
    var count = 70; //间隔函数，1秒执行
    var curCount;//当前剩余秒数
    curCount = count;
    var base_url = "<?=base_url();?>";
    var url = base_url + "agent/dashboard/send_sms/";
    $.post(url, function (result) {
      var str2 = result.replace(/\n|\r/g, "");
        if (str2 != '0') {
            alert("失败");
        } else {
            var time = 70;
            function timeCountDown() {
                if (time == 0) {
                    clearInterval(timer);
                    $("#btnSendMobile").removeAttr("disabled");//启用按钮
                    $("#btnSendMobile").val("重新发送");
                    return true;
                }
                $('#btnSendMobile').val(time + "秒后重试");
                time--;
                return false;
            }
            $("#btnSendMobile").attr("disabled", "true");
            timeCountDown();
            var timer = setInterval(timeCountDown, 1000);
            alert("已发送");
        }
    })
}

        function validation() {
                var withdraw_mount = $('#withdraw_mount').val();


                if (withdraw_mount=='') {
                    document.getElementById("withdraw_mount").focus();
                    return false;
                }
        }
    </script>
    <script>
    $(document).ready(function () {

        $('#general_settings').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                withdraw_mount: {
                    validators: {
                        between: {
                            min: <?=$agnet_fee->low_with_amount?>,
                            max: <?=$agent_jisuan ?>,
                            message: '提现金额必须在'+<?=$agnet_fee->low_with_amount?>+'元和 '+<?=$agent_jisuan ?>+'元之间!',
                        },

                        regexp: {
                        regexp: /^[0-9\s.'-]+$/,
                               message: "输入"
                                },
                                notEmpty: {
                               message: '请输入'
                        }
                    }

                }
            }
        });
    });
    </script>
