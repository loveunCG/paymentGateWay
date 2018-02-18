<link href="<?php echo base_url() ?>asset/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>asset/js/bootstrap-toggle.min.js"></script>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12 wrap-fpanel">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->form_heading()[47] ?></strong>
                </div>
            </div>
            <div class="panel-body">

                <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/settings/save_sms/<?php if (!empty($ginfo)) echo $ginfo->id; ?>" method="post" class="form-horizontal form-groups-bordered">

                    <div class="form-group">                  <!-- List  of days -->
                     <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][11] ?>
                     <span class="required"> *</span></label>
                            <label class="col-sm-1 ">
                                <input  type="checkbox" name="sms_blue" value="<?php if (!empty($ginfo)) echo $ginfo->sms_blue; ?>"
                                        <?php
                                            if (!empty($ginfo) && $ginfo->sms_blue == 1) {
                                                echo 'checked';
                                            }
                                        ?>/>
                                <?php
                                    if (!empty($ginfo) && $ginfo->sms_blue == 0) {  ?>
                                <input  type="hidden" name="sms_blue" value="<?php echo 1 ?>"/>
                                <?php  } ?>
                                <?php echo $this->language->from_body()[2][12] ?>
                            </label>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][13] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="sms_gatewayid"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->sms_gatewayid; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][14] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="sms_gatewaykey"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->sms_gatewaykey; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">                  <!-- List  of days -->
                     <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][15] ?>
                     <span class="required"> *</span></label>
                            <label class="col-sm-1 ">
                                <input  type="checkbox" name="sms_waston" value="<?php if (!empty($ginfo)) echo $ginfo->sms_waston; ?>"
                                        <?php
                                            if (!empty($ginfo) && $ginfo->sms_waston == 1) {
                                                echo 'checked';
                                            }
                                        ?>/>
                                <span>
                                <?php
                                    if (!empty($ginfo) && $ginfo->sms_waston == 0) {  ?>
                                <input  type="hidden" name="sms_waston" value="<?php echo 1 ?>"/>
                                <?php  } ?>
                                <?php echo $this->language->from_body()[2][12] ?></span>
                            </label>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][13] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="sms_id"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->sms_id; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][16] ?><span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="sms_gatenum" value="<?php if (!empty($ginfo)) echo $ginfo->sms_gatenum; ?>" class="form-control" placeholder=""  id="field-2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][14] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="sms_key"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->sms_key; ?>"/>
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
