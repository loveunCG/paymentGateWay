
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> 添加通道 </strong>
                        </div>

                    </div>
                   
                        <div class="panel-body">

                            <div class="tab-content">

                                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation()" action="<?php echo base_url(); ?>admin/gateway/save_channel/<?php echo $gatenum;?>" method="post" class="form-horizontal form-groups-bordered">
                                   <!--  <input type="hidden" name="pay_type_status"  class="form-control" id="field-1" value="1"/> -->
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">通道名称<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="channel_name" id="channel_name"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->channel_name; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                             -->
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" >通道类别</label>
                                            <div class="col-sm-5">
                                                <select name="channel_type" id="channel_type" class="form-control col-sm-5" >
                                                    <?php
                                                    foreach ($typeinfo as $v_fields) :                                                        
                                                            ?>
                                                        <?php if ($v_fields->id == $ginfo->channel_type){ ?>
                                                            <option value="<?php echo $v_fields->id ?>" selected><?php echo $v_fields->gateway_name_type; ?></option>                  
                                                        <?php  
                                                        }                                             
                                                     endforeach;
                                                    ?> 
                                                </select>                                                     
                                            </div>
                                            <!-- <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                               -->
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" >所属网关</label>
                                            <div class="col-sm-5">


                                                    <select name="channel_gateway" id="channel_gateway" class="form-control" style="float: center;"> 
                                                    <?php
                                                    foreach ($gateway_info as $v_fields) :
                                                            ?>
                                                        <?php if ($v_fields['id'] == $ginfo->channel_gateway){ ?>
                                                            <option value="<?php echo $v_fields['id']; ?>" selected><?php echo $v_fields['gateway_name']; ?></option>
                                                                        <?php } else{ ?>
                                                        <option value="<?php echo $v_fields['id']; ?>" ><?php echo $v_fields['gateway_name']; ?></option>                                                                        
                                                            <?php
                                                        }
                                                    endforeach;
                                                    ?>
                                                    </select> 
                                                        
                                              

                                            </div>
                                            <!-- <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                  -->
                                        </div> 
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">通道代码<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="channel_code" id="channel_code"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->channel_code; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg3"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                              -->
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">通道成本比例<span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="number" name="channel_cost_ratio" id="channel_cost_ratio" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->channel_cost_ratio; ?>"/>
                                            </div>
                                            <!-- <span id="id_error_msg4"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>  -->
                                        </div>

                                        <div class="form-group">                  <!-- List  of days -->                   
                                         <label for="field-1" class="col-sm-3 control-label">通道状态 
                                         <span class="required"></span></label>                          
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="channel_status" value="<?php if (!empty($ginfo)) echo $ginfo->channel_status; ?>" 
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->channel_status == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>
                                                    <span>
                                                    <?php
                                                        if (!empty($ginfo) && $ginfo->channel_status == 0) {  ?>
                                                    <input  type="hidden" name="channel_status" value="<?php echo 1 ?>"/>
                                                    <?php  } ?>
                                                    <?php echo $this->language->from_body()[2][12] ?></span>
                                                </label>
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
        var channel_name = $('#channel_name').val();
        var channel_type = $('#channel_type').val();  
        var channel_gateway = $('#channel_gateway').val();
        var channel_code = $('#channel_code').val();
        var channel_cost_ratio = $('#channel_cost_ratio').val();

        if (channel_name=='') {
            $("#id_error_msg").css("display", "block");
            document.getElementById("channel_name").focus();
            return false;
        }else{
            $("#id_error_msg").css("display", "none");
        }
        if (channel_type=='') {
            $("#id_error_msg1").css("display", "block");
            document.getElementById("channel_type").focus();
            return false;
        } else{
            $("#id_error_msg1").css("display", "none");
        } 
        if (channel_gateway=='') {
            $("#id_error_msg2").css("display", "block");
            document.getElementById("channel_gateway").focus();
            return false;
        }  else{
            $("#id_error_msg2").css("display", "none");
        }
        if (channel_code=='') {
            $("#id_error_msg3").css("display", "block");
            document.getElementById("channel_code").focus();
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