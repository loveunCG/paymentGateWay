<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12 wrap-fpanel">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->form_heading()[0] ?></strong>
                </div>                
            </div>
            <div class="panel-body">

                <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/company/save_cinfo/<?php if (!empty($ginfo)) echo $ginfo->id_gsettings; ?>" method="post" class="form-horizontal form-groups-bordered">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][0] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="name"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->name; ?>"/>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][1] ?></label>

                        <div class="col-sm-5">     

                            <input type="hidden" name="old_path" value="<?php if (!empty($ginfo)) echo $ginfo->full_path; ?>">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail g-logo-img" >
                                    <?php if (!empty($ginfo->logo)): ?>
                                        <img src="<?php echo base_url() . $ginfo->logo; ?>" >  
                                    <?php else: ?>
                                        <img src="http://placehold.it/350x260" alt="Please Connect Your Internet">     
                                    <?php endif; ?>                                 
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail g-logo-img" ></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">
                                            <input type="file" name="logo" value="upload" id="myImg">
<!--                                            <input type="file" name="logo" size="20" id="myImg" /></span>-->
                                            <span class="fileinput-exists"><?php echo $this->language->from_body()[1][25] ?></span>
    <!--                                        <input type="file" name="logo" size="20" id="logo"/>-->
                                        </span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?php echo $this->language->from_body()[1][16] ?></a>

                                </div>

                                <div id="valid_msg" style="color: #e11221"></div>

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][2] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="email" name="email" placeholder="Enter Your Email Address" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->email; ?>" ><span class="g-email-error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][3] ?><span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <textarea  name="address" class="form-control autogrow" id="field-ta"  placeholder=""><?php if (!empty($ginfo)) echo $ginfo->address; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][4] ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="city" value="<?php if (!empty($ginfo)) echo $ginfo->city; ?>" class="form-control" placeholder=""  id="field-2">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" ><?php echo $this->language->from_body()[1][5] ?><span class="required">*</span></label>
                        <div class="col-sm-5">
                            <select name="country_id" class="form-control col-sm-5" >
                                <option value="" >Select...</option>
                                <?php foreach ($all_country as $v_country) : ?>
                                    <option value="<?php echo $v_country->idCountry ?>" <?php if (!empty($ginfo) && $v_country->idCountry == $ginfo->country_id )  echo 'selected';  if (empty($ginfo) && $v_country->idCountry == 239 )  echo 'selected'; ?>><?php echo $v_country->countryName ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" ><?php echo $this->language->from_body()[1][6] ?> </label>
                        <div class="col-sm-5">
                            <select name="active_language" class="form-control col-sm-5" >                                                                
                                <?php
                                $fields = $this->db->list_fields('tbl_menu');
                                foreach ($fields as $v_fields) :
                                    if ($v_fields != 'menu_id' && $v_fields != 'link' && $v_fields != 'icon' && $v_fields != 'parent' && $v_fields != 'sort') {
                                        ?>
                                        <option value="<?php echo $v_fields ?>" <?php if (!empty($ginfo)) echo $v_fields == $ginfo->active_language ? 'selected' : '' ?>><?php echo $v_fields; ?></option>
                                        <?php
                                    }
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][7] ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="phone" value="<?php if (!empty($ginfo)) echo $ginfo->phone; ?>" class="form-control" placeholder=""  id="field-1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][8] ?><span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="mobile" id="g-s-mobile" value="<?php if (!empty($ginfo)) echo $ginfo->mobile; ?>" class="form-control" placeholder=""  id="field-1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][9] ?><span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="qq_num" id="g-s-hotline" value="<?php if (!empty($ginfo)) echo $ginfo->qq_num; ?>" class="form-control" placeholder=""  id="field-1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][10] ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="fax" value="<?php if (!empty($ginfo)) echo $ginfo->fax; ?>" class="form-control" placeholder=""  id="field-1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][11] ?></label>

                        <div class="col-sm-5">
                            <input type="url" name="website" value="<?php if (!empty($ginfo)) echo $ginfo->website; ?>" class="form-control" placeholder=""  id="field-3">
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