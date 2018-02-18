
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12 wrap-fpanel">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->form_heading()[56] ?></strong>
                </div>                
            </div>
            <div class="panel-body">

                <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/gateway/save_rate" method="post" class="form-horizontal form-groups-bordered">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo $this->language->from_body()[3][7] ?> <span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == ICBC) {
                                        ?>
                    <input type="text" name="ONLINE"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>                        
                            
                        </div>
<!--                         <label for="field-1" class="col-sm-1 control-label">骏网一卡通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == JUNNET) {
                                        ?>
                    <input type="text" name="JUNNET"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>                          
                           
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">盛大卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == SNDA) {
                                        ?>
                    <input type="text" name="SNDA"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>                           
                        </div>          -->               
                    </div>  
<!--                     <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">神州行<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == SZX) {
                                        ?>
                    <input type="text" name="SZX"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>                         

                        </div>
                        <label for="field-1" class="col-sm-1 control-label">征途卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == ZHENGTU) {
                                        ?>
                    <input type="text" name="ZHENGTU"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">QQ卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == QQCARD) {
                                        ?>
                    <input type="text" name="QQCARD"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                        </div>                        
                    </div>  
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">联通卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == UNICOM) {
                                        ?>
                    <input type="text" name="UNICOM"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">久游卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == JIUYOU) {
                                        ?>
                    <input type="text" name="JIUYOU"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">网易卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == NETEASE) {
                                        ?>
                    <input type="text" name="NETEASE"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">完美卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == WANMEI) {
                                        ?>
                    <input type="text" name="WANMEI"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">搜狐卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == SOHU) {
                                        ?>
                    <input type="text" name="SOHU"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">电信卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == TELECOM) {
                                        ?>
                    <input type="text" name="TELECOM"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">纵游一卡通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == ZONGYOU) {
                                        ?>
                    <input type="text" name="ZONGYOU"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">天下一卡通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == TIANXIA) {
                                        ?>
                    <input type="text" name="TIANXIA"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">天宏一卡通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == TIANHONG) {
                                        ?>
                    <input type="text" name="TIANHONG"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">盛付通卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == SFTCARD) {
                                        ?>
                    <input type="text" name="SFTCARD"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>  
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">32卡<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == SECARD) {
                                        ?>
                    <input type="text" name="SECARD"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>  
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">光宇一卡通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == GUANGYU) {
                                        ?>
                    <input type="text" name="GUANGYU"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>                        
                    </div>  -->
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">财付通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == TENPAY) {
                                        ?>
                    <input type="text" name="TENPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">微信<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXIN) {
                                        ?>
                    <input type="text" name="WEIXIN"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">支付宝<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAY) {
                                        ?>
                    <input type="text" name="ALIPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">WAP支付宝<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAYWAP) {
                                        ?>
                    <input type="text" name="ALIPAYWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">WAP微信<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXINWAP) {
                                        ?>
                    <input type="text" name="WEIXINWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>  
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">代付<span class="required"> *</span></label>

                        <div class="col-sm-2">
                                <?php                                
                                foreach ($ginfo as $v_fields) :
                                    if ($v_fields->channel_code == DAIFU) {
                                        ?>
                    <input type="text" name="DAIFU"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?> 
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" ><?php echo $this->language->from_body()[1][12] ?></button>                            
                        </div>
                    </div>  

                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    function validation(thisform)
    {
        with (thisform)
        {
            if (validateFileExtension(logo, "valid_msg", "Image files are only allowed!",
                    new Array("jpg", "jpeg", "gif", "png")) == false)
            {
                return false;
            }
            if (validateFileSize(logo, 1048576, "valid_msg", "Document size should be less than 1MB !") == false)
            {
                return false;
            }
        }
    }


    function validateFileExtension(component, msg_id, msg, extns)
    {
        var flag = 0;
        with (component)
        {
            var ext = value.substring(value.lastIndexOf('.') + 1);
            if (ext) {
                for (i = 0; i < extns.length; i++)
                {
                    if (ext == extns[i])
                    {
                        flag = 0;
                        break;
                    }
                    else
                    {
                        flag = 1;
                    }
                }
                if (flag != 0)
                {
                    document.getElementById(msg_id).innerHTML = msg;
                    component.value = "";
                    component.style.backgroundColor = "#eab1b1";
                    component.style.border = "thin solid #000000";
                    component.focus();
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }
    }

    function validateFileSize(component, maxSize, msg_id, msg)
    {
        if (navigator.appName == "Microsoft Internet Explorer")
        {
            if (component.value)
            {
                var oas = new ActiveXObject("Scripting.FileSystemObject");
                var e = oas.getFile(component.value);
                var size = e.size;
            }
        }
        else
        {
            if (component.files[0] != undefined)
            {
                size = component.files[0].size;
            }
        }
        if (size != undefined && size > maxSize)
        {
            document.getElementById(msg_id).innerHTML = msg;
            component.value = "";
            component.style.backgroundColor = "#eab1b1";
            component.style.border = "thin solid #000000";
            component.focus();
            return false;
        }
        else
        {
            return true;
        }
    }

</script>