
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> 添加网关 </strong>
                        </div>

                    </div>
                   
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">基本信息</a>
                                </li>
<!--                                 <li class=""><a href="#profile"
                                                data-toggle="tab">成本比例</a>
                                </li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <p>
                                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation()" action="<?php echo base_url(); ?>admin/gateway/save_cinfo/<?php if (!empty($ginfo)) echo $ginfo->id; ?>" method="post" class="form-horizontal form-groups-bordered">
                                   <!--  <input type="hidden" name="pay_type_status"  class="form-control" id="field-1" value="1"/> -->
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">网关名称<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_name" id="gateway_name"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_name; ?>"/>
                                            </div>
                                            <span id="id_error_msg"><small style="padding-left:10px;color:red;font-size:14px">*请输入网管名称。</small></span>                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" >网关类别<span class="required"> *</span></label>
                                            <div class="col-sm-5">
                                                <select name="gateway_type" id="gateway_type" class="form-control col-sm-5" >    
                                                    <option value="" >请迭择</option>                                             
                                                    <?php
                                                    foreach ($typeinfo as $v_fields) :
                                                            ?>
                                                            <option value="<?php echo $v_fields->id ?>" <?php if (!empty($ginfo)) echo $v_fields->id == $ginfo->gateway_type ? 'selected' : '' ?>><?php echo $v_fields->gateway_name_type; ?></option>
                                                            <?php
                                                    endforeach;
                                                    ?>
                                                </select> 
                                            </div>
                                            <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请选择网关类别。</small></span>                                              
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">接口标识<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_mark"  class="form-control" id="gateway_mark" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_mark; ?>"/>
                                            </div>
                                            <span id="id_error_msg2"><small style="padding-left:10px;color:red;font-size:14px">*请输入接口标识。</small></span>                                              
                                        </div> 
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">邮件地址</label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_mail" id="gateway_mail"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_mail; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg3"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                              -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">接入地址<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_access_address" id="gateway_access_address" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_access_address; ?>"/>
                                            </div>
                                            <span id="id_error_msg4"><small style="padding-left:10px;color:red;font-size:14px">*请填写接入地址。</small></span> 
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">商品名称<span class="required"> </span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_product_name" id="gateway_product_name" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_product_name; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg5"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">商品描述<span class="required"> </span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_product_description" id="gateway_product_description" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_product_description; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg6"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">公司地址<span class="required"></span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_company" id="gateway_company" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_company; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg7"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">循环金额<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_cycle_amount" id="gateway_cycle_amount" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_cycle_amount; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg8"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">网关备注<span class="required"> </span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_notes" id="gateway_notes" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_notes; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg9"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">成本费率<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="gateway_rate_basic" id="gateway_rate_basic" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->gateway_rate_basic; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg9"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div>                                                                                                                                                     
                                                
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-5">
                                                <button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" >提交</button>                            
                                            </div>
                                        </div>  

                                    </form>
                                    </p>

                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <h4></h4>
                                    <p></p>
                                </div>

                            </div>
                        </div>                

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">

    function validation()
    {
        var gateway_name = $('#gateway_name').val();
        var gateway_type = $('#gateway_type').val();  
        var gateway_mark = $('#gateway_mark').val();
         var gateway_rate_basic = $('#gateway_rate_basic').val();
        var gateway_access_address = $('#gateway_access_address').val();
        // var gateway_product_name = $('#gateway_product_name').val();
        // var gateway_product_description = $('#gateway_product_description').val();
        // var gateway_company = $('#gateway_company').val();
        var gateway_cycle_amount = $('#gateway_cycle_amount').val();
        // var gateway_notes = $('#gateway_notes').val();


        if (gateway_name=='') {
            $("#id_error_msg").css("display", "block");
            document.getElementById("gateway_name").focus();
            return false;
        }else{
            $("#id_error_msg").css("display", "none");
        }
        if (gateway_type=='') {
            $("#id_error_msg1").css("display", "block");
            document.getElementById("gateway_type").focus();
            return false;
        } else{
            $("#id_error_msg1").css("display", "none");
        } 
        if (gateway_mark=='') {
            $("#id_error_msg2").css("display", "block");
            document.getElementById("gateway_mark").focus();
            return false;
        }  else{
            $("#id_error_msg2").css("display", "none");
        }
        // if (gateway_mail=='') {
        //     $("#id_error_msg3").css("display", "block");
        //     document.getElementById("gateway_mail").focus();
        //     return false;
        // }  else{
        //     $("#id_error_msg3").css("display", "none");
        // }
        if (gateway_access_address=='') {
            $("#id_error_msg4").css("display", "block");
            document.getElementById("gateway_access_address").focus();
            return false;
        }  else{
            $("#id_error_msg4").css("display", "none");
        } 
        // if (gateway_product_name=='') {
        //     $("#id_error_msg5").css("display", "block");
        //     document.getElementById("gateway_product_name").focus();
        //     return false;
        // }  else{
        //     $("#id_error_msg5").css("display", "none");
        // } 
        // if (gateway_product_description=='') {
        //     $("#id_error_msg6").css("display", "block");
        //     document.getElementById("gateway_product_description").focus();
        //     return false;
        // }  else{
        //     $("#id_error_msg6").css("display", "none");
        // } 
        // if (gateway_company=='') {
        //     $("#id_error_msg7").css("display", "block");
        //     document.getElementById("gateway_company").focus();
        //     return false;
        // }  else{
        //     $("#id_error_msg7").css("display", "none");
        // } 
        if (gateway_cycle_amount=='') {
            $("#id_error_msg8").css("display", "block");
            document.getElementById("gateway_cycle_amount").focus();
            return false;
        }  else{
            $("#id_error_msg8").css("display", "none");
        } 
        if (gateway_rate_basic=='') {
            $("#id_error_msg9").css("display", "block");
            document.getElementById("gateway_rate_basic").focus();
            return false;
        }  else{
            $("#id_error_msg9").css("display", "none");
        } 
        
    }
</script>    