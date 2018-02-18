
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> 基本信息 </strong>
                        </div>

                    </div>
                   
                        <div class="panel-body">

                            <div class="tab-content">

                                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation()" action="<?php echo base_url(); ?>admin/gateway/save_gateway_account/<?php if (!empty($ginfo)) echo $ginfo->id; ?>" method="post" class="form-horizontal form-groups-bordered">
                                         <input type="hidden" name="gateway_id"  class="form-control" id="field-1" value="<?php echo $gateway_id; ?>"/>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">账户<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="account_name" id="account_name"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->account_name; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                             -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">账户ID<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="account_id" id="account_id"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->account_id; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg1"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                             -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">账户KEY<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="account_key" id="account_key"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->account_key; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg2"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                             -->
                                        </div>                                                                                

                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">E-mail<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="email" name="account_email" id="account_email"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->account_email; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg3"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                              -->
                                        </div>


                                        <div class="form-group">                  <!-- List  of days -->                   
                                         <label for="field-1" class="col-sm-3 control-label">启用跳转 
                                         <span class="required"> </span></label>                          
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="jump_state" value="<?php if (!empty($ginfo)) echo $ginfo->jump_state; ?>" 
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->jump_state == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>
                                                    <span>
                                                    <?php
                                                        if (!empty($ginfo) && $ginfo->jump_state == 0) {  ?>
                                                    <input  type="hidden" name="jump_state" value="<?php echo 1 ?>"/>
                                                    <?php  } ?>
                                                    
                                                </label>
                                        </div>                                          
                                                                                                                                       
                                         <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">跳转地址<span class="required"> </span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="jump_address" id="jump_address" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->jump_address; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg4"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div> 
                                        <div class="form-group">                  <!-- List  of days -->                   
                                         <label for="field-1" class="col-sm-3 control-label">启用循环 
                                         <span class="required"> </span></label>                          
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="loop_state" value="<?php if (!empty($ginfo)) echo $ginfo->loop_state; ?>" 
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->loop_state == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>
                                                    <span>
                                                    <?php
                                                        if (!empty($ginfo) && $ginfo->loop_state == 0) {  ?>
                                                    <input  type="hidden" name="loop_state" value="<?php echo 1 ?>"/>
                                                    <?php  } ?>
                                                   
                                                </label>
                                        </div> 
                                         <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">排序<span class="required"></span></label>

                                            <div class="col-sm-5">
                                                <input type="number" name="sort_id" id="sort_id" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->sort_id; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg4"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div>                                                                                                                                 
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-5">
                                                <button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" >提交</button>                            
                                            </div>
                                        </div>  

                                    </form>

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
        var account_name = $('#account_name').val();
        var account_id = $('#account_id').val();  
        var account_key = $('#account_key').val();
        var account_email = $('#account_email').val();
        var channel_cost_ratio = $('#channel_cost_ratio').val();

        if (account_name=='') {
            $("#id_error_msg").css("display", "block");
            document.getElementById("account_name").focus();
            return false;
        }else{
            $("#id_error_msg").css("display", "none");
        }
        if (account_id=='') {
            $("#id_error_msg1").css("display", "block");
            document.getElementById("account_id").focus();
            return false;
        } else{
            $("#id_error_msg1").css("display", "none");
        } 
        if (account_key=='') {
            $("#id_error_msg2").css("display", "block");
            document.getElementById("account_key").focus();
            return false;
        }  else{
            $("#id_error_msg2").css("display", "none");
        }
        if (account_email=='') {
            $("#id_error_msg3").css("display", "block");
            document.getElementById("account_email").focus();
            return false;
        }  else{
            $("#id_error_msg3").css("display", "none");
        }
        if (channel_cost_ratio=='') {
            $("#id_error_msg4").css("display", "block");
            document.getElementById("channel_cost_ratio").focus();
            return false;
        }  else{
            $("#id_error_msg4").css("display", "none");
        } 



        
    }
</script>    