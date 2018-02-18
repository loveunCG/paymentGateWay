<br>
<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="container-fluid">
    <section class="row white-box" style="margin-top: 5%;">
        <h1>
            <bold>提现管理 </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 提现管理</a></li>
            <li><a href="#">提现申请</a></li>
        </ol>
    </section>
    <div class="row white-box">
        <h3> 查看账户</h3>
        <table class="table">

            <tbody>
                <tr>
                    <td>商户 ID</td>
                    <td>
                        <?php echo $employee_details->employee_id ?>
                    </td>

                    <td>账户余额</td>
                    <td> <?php echo $employee_details->usr_amount ?>元
                    <?php  $mount = intval($employee_details->jisuan_jine); ?>
                        <input type="hidden" id="mount" value="<?php echo $mount; ?>">
                    </td>
                    <td>结算方式</td>
                    <td>T+<?php echo $employee_details->group_withdraw_time;?></td>
                </tr>
                <tr>
                    <td>每日对帐时间</td>
                    <td><?php echo $gsetting->open_time;?> ~ <?php echo $gsetting->close_time;?>(对账期间禁止提现)</td>
                    <td>可结算金额 </td>
                    <td><?php echo $jisuan_jine ?>元</td>
                    <td>手机号码 </td>
                    <td> <?php
                                            $email = $employee_details->usr_mobile;
                                            $pre_frex = substr($email, 0, 3);
                                            $end_frex = substr($email, -4, 4);
                                            echo $pre_frex. str_repeat('*',4).$end_frex;
                                        ?></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="row white-box">
            <div class="box-header">
                <h3 class="box-title">提现操作</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
        	   <?php echo form_open('employee/dashboard/immediate_delivery','class="col-sm-12" id="form"'); ?>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>支行名称</th>
                                <th>开户银行 </th>
                                <th>姓名</th>
                                <th>银行卡号</th>
                                <th>提现金额</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="add_location">
                            <tr>


                            <td> <select class="form-control select2" name="pay_method" style="width: 100%;">
                                           <option value="" >选择支付方式</option>
                                           <option value="ALIPAY">支付宝</option>
                                           <option value="TENPAY">网银</option>
                                           <option value="ONLINE">财付通</option>
                                           <option value="WEIXIN">微信</option>
                                            </select></td>
                                <td> <input list="browsers" name="delivery_bank_name" class="form-control select2" style="width: 100%;">
                                     <datalist id="browsers">
                                        <?php foreach ($bank_nam as $v_country) : ?>
                                        <option value="<?php echo $v_country->bank_name;?>">
                                            <?php endforeach; ?>
                                        </datalist>
                                </td>
                                <td><div class="form-group"> <input type="text" class="form-control" name="delivery_bankbrach_name">
                                </div></td>
                                <td> <div class="form-group"><input type="text" class="form-control" name="delivery_bank_card" >
                              </div></td>
                                <td><div class="form-group"> <input type="number" class="form-control" name="delivery_mount" onchange="check_tixian_stauts()">
                                <span id="id_error_msg2"> </span></div></td>
                                <td></td>

                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> 验证码: </th>
                                <th> <input class="col-sm-12 form-control" name="CaptchaCode" id="CaptchaCode" type="text">

                                </th>
                                <th><?php echo $captchaHtml; ?></th>
                                <th><?php echo $captchaValidationMessage; ?></a></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>短信验证码: </th>
                                <th> <input class="col-sm-12 form-control" name ="sms_code" id="sms_code" type="text"></th>
                                <th><input type="button" class="btn btn-primary col-sm-12" value="发送验证码" id = "btnSendMobile" onclick="return sendMobileCode()"></button></th>
                                <th><input type="submit" id = "submit_tixian" class="btn btn-primary col-sm-3" value="提交">
                                <div class="col-sm-1"></div> <button type="" class="btn btn-primary col-sm-7">收款人模板下载</button></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
            <!-- /block -->

            <!-- /.box-body -->

        </div>
    </div>
    <script>
    function check_tixian_stauts(val) {
      var base_url = '<?= base_url() ?>';
      var strURL = base_url + "employee/dashboard/check_tixian_stauts";
      $.post(strURL, {
          proxyID: val
        })
        .done(function (data) {
          if (data) {
            $("#id_error_msg2").css("display", "block");
            $("#id_error_msg2").html(data);
            // $("#submit_tixian").attr("disabled", "true");
          } else {
            $("#id_error_msg2").css("display", "none");
            $("#submit_tixian").removeAttr("disabled");
          }
        });

    };
    </script>

     <script>
            function sendMobileCode() {
                var InterValObj; //timer变量，控制时间
                var count = 70; //间隔函数，1秒执行
                var curCount;//当前剩余秒数
                curCount = count;
                var base_url = "<?=base_url();?>";
                var url = base_url + "employee/dashboard/send_sms/";
                $.post(url, function (result) {
                  var str2 = result.replace(/\n|\r/g, "");
                    if (str2 === '0') {
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
                    } else {
                      alert("失败");
                    }
                })
            }
        $(document).ready(function () {
            $('.BDC_CaptchaImageDiv a').remove();
            var mount = $('#mount').val();
            $('#form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    delivery_bank_name: {
                        validators: {
                            stringLength: {
                                min: 2,
                                message: '输入 2个字以上'
                            },

                            notEmpty: {
                                message: '输入 2个字以上'

                            }
                        }
                    },
                    delivery_bankbrach_name: {
                        validators: {
                            stringLength: {
                                min: 2,
                                message: '请输入 两个字以上 '
                            },
                            notEmpty: {
                                message: '请输入 两个字以上'
                            }
                        }
                    },
                    delivery_bank_card1: {
                        validators: {
                            stringLength: {
                                min: 8,
                                max: 18,
                                message: '输入 5~14个字以上'
                            },
                            regexp: {
								regexp: /^[0-9\s.'-]+$/,
								message: "请输入数字"
								},
                            notEmpty: {
                                message: '请输入'
                            }
                        }

                    },
                    delivery_mount: {
                        validators: {
                            between: {
                                min: <?=$employee_details->group_amount?>,
                                max: mount,
                                message: '提现金额必须在'+<?=$employee_details->group_amount ?>+'元和 '+mount+'元之间!',
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
    </div>
<link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
<link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>css/style.css" />
<!-- <script>
 var count = 0;
    $(document).ready(function () {

        $("#addition").click(function () {

            if(count<5){
            var strHtml = "";
            count++;
            strHtml += "<tr id='remove" + count + "'>";
            strHtml += "<td> <select name='pay_method1[]' class='form-control select2' style='width: 100%;'>";
            strHtml += "<option selected='selected'>工商银行</option>";
            strHtml +=
                "<option>农业银行</option><option>建设银行</option><option>中央银行</option><option>开发银行</option><option>工业银行</option>";
            strHtml += "<option>工业银行</option></select></td>";
            strHtml +=
                "<td> <input type='text' class='form-control' name = 'delivery_bank_name1[]'></td>";
            strHtml +=
                "<td> <input type='text' class='form-control' name = 'delivery_bankbrach_name1[]'  ></td>";
            strHtml +=
                "<td> <input type='text' class='form-control' name = 'delivery_bank_card1[]'  ></td>";
            strHtml +=
                "<td> <input type='text' class='form-control' name = 'delivery_mount1[]' ></td>";
            strHtml +=
                "<td><button onclick='onRemove($(this));' class='btn btn-block btn-success'><span class='glyphicon glyphicon-minus'></span></button></td></tr>";
            $("#add_location").append(strHtml);
            }else{
            count = 5;
            }
        });

    });
   function onRemove(pthis) {
        pthis.parent().parent().remove();
        count--;
    }

</script> -->
