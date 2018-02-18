<br><?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10" style="margin-top:5%;">
                <div class="wrap-fpanel">
                    <div class="panel panel-info">

                        <div class="panel panel-info" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <strong>点卡提交</strong>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-offset-1">
                                    <form id="form" action="<?php echo base_url() ?>employee/dashboard/save_leave_application" method="post" class="form-horizontal">
                                        <div class="panel_controls">
                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label">支付方式选择<span > *</span></label>

                                                <div class="col-sm-5">
                                                    <select name="leave_category_id" id="sel_card_id" class="form-control" onchange="onchange_card(this.value)">
                                                <script>
                                                 var arySubList = {};
                                                function onchange_card(val)
                                                {
                                                     if(val == '26'||val=='28'||val=='27'||val=='29'||val=='30'){
                                                        $('#password_view').hide();
                                                        $('#card_num_view').hide();
                                                    }else{
                                                        $('#password_view').show();
                                                        $('#card_num_view').show();
                                                    }
                                                    var sel = $('#sel_card_id').val();
                                                    var strList = arySubList[sel];
                                                    $('#sub_card_id').html('');
                                                    var aryList = strList.split(',');
                                                    var strHtml = "";
                                                    for(var i = 0 ; i < aryList.length-1 ; i++){
                                                        strHtml += "<option value='" + aryList[i] +"'>" + aryList[i] + "</option>";
                                                    }
                                                    $('#sub_card_id').html(strHtml);

                                                }
                                                </script>
                                                <option value="" >选择通道</option>
                                                <?php foreach ($all_leave_category as $v_category){ ?>
                                                <?php if($v_category->channel_type=='1'||$v_category->channel_type=='0'){ ?>
                                                    <option value="<?php
                                                    echo $v_category->channel_code ?>">
                                                        <?php echo $data = $v_category->channel_name; ?></option>
                                                        <script>
                                                            <?php echo "arySubList['$v_category->id'] = '$v_category->pay_price_type';";
                                                            }
                                                            ?>
                                                        </script>
                                                <?php }
                                                ?>
                                            </select>
                                                </div>
                                            </div>
                                            <div id="onedingdan">
                                                <div class="form-group">
                                                    <label for="field-1" class="col-sm-3 control-label">面值<span class="required"> *</span></label>
                                                    <div class="col-sm-5">
                                                        <input type="number" name="real_amount" class="form-control" required >
                                                         <span id="id_error_msg"> </span>

                                                    </div>
                                                </div>
                                                <!--<div id="multi_dingdan" style="display:none;">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"> 分隔符选择:<span class="required"> </span></label>
                                                    <div class="col-sm-5">
                                                        <div class="input-group">
                                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="," checked>逗号
                                                            <input type="radio" name="optionsRadios" id="optionsRadios2" value=" ">空格<br>
                                                            <span>(每行一张，每行卡信息格式为：金额 卡号{分隔符}密码{分隔符})</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"><span class="required">订单内容</span></label>
                                                    <div class="col-sm-5">
                                                        <textarea class="form-control" name="multi_ding" rows="10"></textarea>

                                                    </div>
                                                </div>
                                            </div>-->
                                                <div class="form-group">
                                                    <div class="col-sm-offset-5 col-sm-12">
                                                        <button type="submit" name="sbtn" id = "register-submit-btn" class="btn btn-primary">提交</button>
                                                        <!--<input type="hidden" name="subtype" id="subtype" value="0">-->
                                                        <!--<input type="button" name="" value="批量提交" id="mul_click" class="btn btn-primary">-->
                                                        <!--<input type="button" id="sigle_click" value="单卡提交" class="btn btn-primary">-->
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #success_message {
        display: none;
    }

    #form .has-feedback .form-control-feedback {
        top: 0px;
        right: 58px
    }
</style>
<script>


// function check_value(val){
//      var base_url = '<?= base_url() ?>';
//       var strURL = base_url + "employee/dashboard/check_value";
//       $.post(strURL, {
//           value: val
//         })
//         .done(function (data) {
//           if (data) {
//             $("#id_error_msg").css("display", "block");
//             $("#id_error_msg").html(data);
//             $("#register-submit-btn").attr("disabled", "true");


//           } else {
//             $("#id_error_msg").css("display", "none");
//             $("#register-submit-btn").removeAttr("disabled");
//           }
//         });


// }
    $(document).ready(function () {

        $('#form').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                recharge_card_num: {
                    validators: {
                        stringLength: {
                            min: 10,
                            max: 16,
                            message: '清入10~16个字卡号吗'
                        },
                        notEmpty: {
                            message: '清入真卡号吗'
                        }
                    }
                },
                real_amount: {
                    validators: {
                        notEmpty: {
                            message: '请入资料'
                        },
                        regexp: { /* 只需加此键值对，包含正则表达式，和提示 */
                            regexp: /^[0-9_\.]+$/,
                            message: '只能是金额.'
                        }
                    }

                },
                leave_category_id: {
                    validators: {
                        notEmpty: {
                            message: '请选择类型'
                        }
                    }
                },
                recharge_card_pass: {
                    validators: {
                        stringLength: {
                            min: 6,
                            message: '清入6个字密吗'
                        },
                        notEmpty: {
                            message: '请入真密码'
                        }
                    }
                }

            }
        });

    });
</script>
