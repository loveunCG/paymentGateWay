<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12 wrap-fpanel">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>Direct Deposit</strong>
                </div>                
            </div>
            <div class="panel-body">

                <form id="direct_deposit" role="form" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/settings/save_ddinfo/<?php if (!empty($ddinfo)) echo $ddinfo->id_gsettings; ?>" method="post" class="form-horizontal form-groups-bordered">

                    <div class="form-group">
                        <label for="field-1" required class="col-sm-3 control-label">Immediate Destination Routing Number <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="idrn"  class="form-control" id="field-1"placeholder="Immediate Destination Routing Number" class="form-control"  value="<?php if (!empty($ddinfo)) echo $ddinfo->idrn; ?>"/>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Immediate Origin Routing</label>
                          <div class="col-sm-5">
                            <input type="text" name="ior"  class="form-control" id="field-2" value="<?php if (!empty($ddinfo)) echo $ddinfo->ior; ?>"/>
                        </div>
                        </div>
                                
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label">Company Name <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="cn" placeholder="Company Name(as on ACH Record)" class="form-control" value="<?php if (!empty($ddinfo)) echo $ddinfo->cn; ?>" ><span class="required"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-4" class="col-sm-3 control-label">Company Entry Description<span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="ced" class="form-control autogrow" id="field-4"  placeholder="Company Entry Description"value="<?php if (!empty($ddinfo)) echo $ddinfo->ced; ?>"<span class="required"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-5" class="col-sm-3 control-label">ACH Reference(Optional)</label>

                        <div class="col-sm-5">
                            <input type="text" name="achr" value="<?php if (!empty($ddinfo)) echo $ddinfo->achr; ?>" class="form-control" placeholder="ACH Reference(Optional)"  id="field-5">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-6" class="col-sm-3 control-label">Immediate Destination Name</label>

                        <div class="col-sm-5">
                            <input type="text" name="idn" value="<?php if (!empty($ddinfo)) echo $ddinfo->idn; ?>" class="form-control" placeholder="idn"  id="field-6">
                        </div>
                    </div>
                      
                      <div class="form-group">
                        <label for="field-7" class="col-sm-3 control-label">Company Bank Account</label>

                        <div class="col-sm-5">
                            <input type="text" name="cba" value="<?php if (!empty($ddinfo)) echo $ddinfo->cba; ?>" class="form-control" placeholder="Company Bank Account"  id="field-7">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-8" class="col-sm-3 control-label">Company Description Data(Optional)</label>

                        <div class="col-sm-5">
                            <input type="text" name="cdd" value="<?php if (!empty($ddinfo)) echo $ddinfo->cdd; ?>" class="form-control" placeholder="Company Description Data(Optional)"  id="field-8">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-9" class="col-sm-3 control-label">Company Id Assigned By Bank</label>

                        <div class="col-sm-5">
                            <input type="text" name="ciabb" value="<?php if (!empty($ddinfo)) echo $ddinfo->ciabb; ?>" class="form-control" placeholder="Company Id Assigned By Bank"  id="field-9">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-10" class="col-sm-3 control-label">Originating Financial Instiute RTN Number</label>

                        <div class="col-sm-5">
                            <input type="text" name="ofin" value="<?php if (!empty($ddinfo)) echo $ddinfo->ofin; ?>" class="form-control" placeholder="Originating Financial Instiute RTN Number"  id="field-10">
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
