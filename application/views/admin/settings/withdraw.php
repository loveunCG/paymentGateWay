<link href="<?php echo base_url() ?>asset/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>asset/js/bootstrap-toggle.min.js"></script>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12 wrap-fpanel">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->form_heading()[46] ?></strong>
                </div>
            </div>
            <div class="panel-body">

                <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/settings/save_withdraw/<?php if (!empty($ginfo)) echo $ginfo->id; ?>" method="post" class="form-horizontal form-groups-bordered">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][3] ?> <span class="required"> *</span></label>

                        <div class="col-sm-2">
                            <input type="text" name="fee" id="group_fee" class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->fee; ?>"/>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][4] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="max_sdl_value"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->max_sdl_value; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][5] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="min_sdl_value"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->min_sdl_value; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][6] ?><span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="payable_amount" value="<?php if (!empty($ginfo)) echo $ginfo->payable_amount; ?>" class="form-control" placeholder=""  id="field-2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][7] ?> <span class="required"> *</span></label>

                        <div class="col-sm-1">
                            <input type="text" name="method"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->method; ?>"/>

                        </div>
                        <label for="field-3" class="col-sm-3 control-label">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)</label>
                    </div>

                    <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][8] ?>  <span class="required">*</span></label>

                            <div class="col-sm-5">
                                <input  data-toggle="toggle" <?php
                                if (!empty($ginfo) && $ginfo->agent_way == 1) {
                                    echo 'checked';
                                }
                                ?> name="agent_way" value="1" data-on="是" data-off="否" data-onstyle="success" data-offstyle="danger" type="checkbox">
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][9] ?><span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="open_time" value="<?php if (!empty($ginfo)) echo $ginfo->open_time; ?>" class="form-control" placeholder=""  id="field-2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][10] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="close_time"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->close_time; ?>"/>
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

    $(document).ready(function(){
        var sd = $('#group_fee').val()+"%";
        $('#group_fee').val(sd);
    });

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
