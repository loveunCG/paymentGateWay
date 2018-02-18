<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> <?php echo $this->language->form_heading()[54] ?>
                            </strong>
                        </div>

                    </div>
                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation()" action="<?php echo base_url(); ?>admin/proxy/save_agent_group/<?php if (!empty($ginfo)) echo $ginfo->id; ?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home"
                                                      data-toggle="tab"><?php echo $this->language->from_body()[57][0] ?></a>
                                </li>
                                <li class=""><a href="#profile"
                                                data-toggle="tab"><?php echo $this->language->from_body()[57][4] ?></a>
                                </li>
                                <li class=""><a href="#messages"
                                                data-toggle="tab"><?php echo $this->language->from_body()[57][5] ?></a>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label"><?php echo $this->language->from_body()[57][1] ?>
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="agent_group_name" id="agent_group_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->agent_group_name; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label"><?php echo $this->language->from_body()[57][2] ?>
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="remarks" id="remarks" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->remarks; ?>" />
                                                <!-- <span id="id_error_msg7" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">
                                                <span class="required"> </span></label>                                        
                                            <div class="col-sm-5">
                                          <span id="id_error_msg" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*输入的所有信息。</small></span> 
                                            </div>
                                        
                                        </div>                                        

                                    </p>

                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <h4></h4>
                                     <p>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo $this->language->from_body()[3][7] ?> <span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ICBC) {
                                        ?>
                         <input type="text" name="ONLINE"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ICBC) {
                                        ?>
                         <input type="text" name="ONLINE"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                    
                        </div>
                  
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">财付通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == TENPAY) {
                                        ?>
                         <input type="text" name="TENPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == TENPAY) {
                                        ?>
                         <input type="text" name="TENPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">微信<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXIN) {
                                        ?>
                         <input type="text" name="WEIXIN"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXIN) {
                                        ?>
                         <input type="text" name="WEIXIN"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">支付宝<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAY) {
                                        ?>
                         <input type="text" name="ALIPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAY) {
                                        ?>
                         <input type="text" name="ALIPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">WAP支付宝<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAYWAP) {
                                        ?>
                         <input type="text" name="ALIPAYWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAYWAP) {
                                        ?>
                         <input type="text" name="ALIPAYWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">WAP微信<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXINWAP) {
                                        ?>
                         <input type="text" name="WEIXINWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXINWAP) {
                                        ?>
                         <input type="text" name="WEIXINWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">代付<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == DAIFU) {
                                        ?>
                         <input type="text" name="DAIFU"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == DAIFU) {
                                        ?>
                         <input type="text" name="DAIFU"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>                        
                    </div>  
                                        <div class="form-group">                  <!-- List  of days -->
                                         <label for="field-1" class="col-sm-3 control-label">代理组费率设置
                                         <span class="required"> *</span></label>
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="agent_limit_set" value="1"
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->agent_limit_set == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/> <span> 启用</span>
                                                </label>
                                        </div>                                                           
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4></h4>
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">默认手续费率
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-1">

                                                <?php if (!empty($ginfo->default_rate)) { ?>
                                                <input type="text" name="default_rate" id="default_rate" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->default_rate; ?>" />
                                                <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="text" name="default_rate" id="default_rate" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->fee; ?>" />
                                                <?php } ?> 
                                            </div>                                          
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">手续费上限
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->fee_limit)) { ?>
                                                <input type="number" name="fee_limit" id="fee_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->fee_limit; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="fee_limit" id="fee_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->max_sdl_value; ?>" />
                                                <?php } ?> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">手续费下限
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->fee_low_limit)) { ?>
                                                <input type="number" name="fee_low_limit" id="fee_low_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->fee_low_limit; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="fee_low_limit" id="fee_low_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->min_sdl_value; ?>" />
                                                <?php } ?> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">最低提现金额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->low_with_amount)) { ?>
                                                <input type="number" name="low_with_amount" id="low_with_amount" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->low_with_amount; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="low_with_amount" id="low_with_amount" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->payable_amount; ?>" />
                                                <?php } ?> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">提现模式 T+
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-1">
                                                <?php if (!empty($ginfo->mode)) { ?>
                                                <input type="number" name="mode" id="mode" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->mode; ?>" />
                                                <span id="id_error_msg5" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)。</small></span>
                                                <?php } else{ ?>
                                                <input type="number" name="mode" id="mode" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->method; ?>" />
                                                <span id="id_error_msg5" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)。</small></span>                                                       
                                                <?php } ?>                                                                                                        
                                            </div>
                                             <label for="field-3" class="col-sm-3 control-label">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)</label>
                                        </div> 
                                        <div class="form-group">                  <!-- List  of days -->
                                         <label for="field-1" class="col-sm-3 control-label">代理组提现设置
                                         <span class="required"> *</span></label>
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="agent_tixian_set" value="1"
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->agent_tixian_set == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/> <span> 启用</span>
                                                </label>
                                        </div>                                                                                                                                                                 
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-2">
                                <button type="submit" id="sbtn" class="btn btn-primary" style="float: right;" 
                                        id="i_submit"><?php echo $this->language->from_body()[2][50] ?></button>
                            </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        $(document).ready(function(){
            var sd = $('#default_rate').val()+"%";
            $('#default_rate').val(sd);
        });
    function validation()
    {
        // var mode = $('#mode').val(); 
        // var default_rate = $('#default_rate').val();
        // var fee_limit = $('#fee_limit').val();
        // var fee_low_limit = $('#fee_low_limit').val();
        // var low_with_amount = $('#low_with_amount').val();
        var remarks = $('#remarks').val();
        var agent_group_name = $('#agent_group_name').val();

        if (agent_group_name=='') {
            $("#id_error_msg6").css("display", "block");
            $("#id_error_msg").css("display", "block");
            document.getElementById("agent_group_name").focus();
            return false;
        }else{
            $("#id_error_msg6").css("display", "none");
        }
        if (remarks=='') {
            $("#id_error_msg7").css("display", "block");
            $("#id_error_msg").css("display", "block");
            document.getElementById("remarks").focus();
            return false;
        }else{
            $("#id_error_msg7").css("display", "none");
        } 
        // if (default_rate=='') {
        //     $("#id_error_msg1").css("display", "block");
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("default_rate").focus();
        //     return false;
        // }else{
        //     $("#id_error_msg1").css("display", "none");
        // }
        // if (fee_limit=='') {
        //     $("#id_error_msg2").css("display", "block");
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("fee_limit").focus();
        //     return false;
        // }else{
        //     $("#id_error_msg2").css("display", "none");
        // }
        // if (fee_low_limit=='') {
        //     $("#id_error_msg3").css("display", "block");
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("fee_low_limit").focus();
        //     return false;
        // }else{
        //     $("#id_error_msg3").css("display", "none");
        // }
        // if (low_with_amount=='') {
        //     $("#id_error_msg4").css("display", "block");
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("low_with_amount").focus();
        //     return false;
        // }else{
        //     $("#id_error_msg4").css("display", "none");
        // }                        
        // if (mode=='') {
        //     $("#id_error_msg5").css("display", "block");
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("mode").focus();
        //     return false;
        // }else{
        //     $("#id_error_msg5").css("display", "none");
        // }
        
        
    }
</script>    