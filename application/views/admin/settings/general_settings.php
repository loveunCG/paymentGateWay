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

                <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/settings/save_ginfo/<?php if (!empty($ginfo)) echo $ginfo->id_gsettings; ?>" method="post" class="form-horizontal form-groups-bordered">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][0] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="name"  class="form-control" id="field-1" value="<?php if (!empty($ginfo)) echo $ginfo->name; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[1][11] ?></label>

                        <div class="col-sm-5">
                            <input type="url" name="website" value="<?php if (!empty($ginfo)) echo $ginfo->website; ?>" class="form-control" placeholder=""  id="field-3">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[57][55] ?></label>

                        <div class="col-sm-5">
                            <input type="url" name="return_address" value="<?php if (!empty($ginfo)) echo $ginfo->return_address; ?>" class="form-control" placeholder=""  id="field-3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[57][56] ?><span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <textarea  name="site_description" class="form-control autogrow" id="field-ta"  placeholder=""><?php if (!empty($ginfo)) echo $ginfo->site_description; ?></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[57][57] ?><span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <textarea  name="site_keyword" class="form-control autogrow" id="field-ta"  placeholder=""><?php if (!empty($ginfo)) echo $ginfo->site_keyword; ?></textarea>
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

<!--                     <div class="form-group">
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
                    </div>  --> 
                    <div class="form-group">
                       <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[57][58] ?></label>
                        <?php if ($ginfo->site_is_open==1): ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="site_is_open" value="1" id="site_is_open" checked> 
                            <?php echo $this->language->from_body()[57][59] ?>&nbsp;
                            <input type="radio" name="site_is_open" value="2" id="site_is_open"> 
                            <?php echo $this->language->from_body()[57][60] ?>&nbsp;
                        <?php else: ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="site_is_open" value="1" id="site_is_open" > 
                            <?php echo $this->language->from_body()[57][59] ?>&nbsp;
                            <input type="radio" name="site_is_open" value="2" id="site_is_open" checked> 
                            <?php echo $this->language->from_body()[57][60] ?>&nbsp;     
                        <?php endif; ?> 


                       
                    </div> 
<!--                     <div class="form-group">
                        <label class="col-sm-3 control-label" ><?php echo $this->language->from_body()[57][61] ?> </label>
                        <div class="col-sm-5">
                            <select name="register_user_group" class="form-control col-sm-5" >
                                 <option value="1" >新户风控组</option>
                                 <option value="2" >需要</option>
                            </select> 
                        </div>
                    </div>   -->                    
                    <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[57][62] ?></label>
                        <?php if ($ginfo->user_reviewd==1): ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="user_reviewd" value="1" id="user_reviewd" checked> <?php echo $this->language->from_body()[57][63] ?>&nbsp;
                           <input type="radio" name="user_reviewd" value="2" id="user_reviewd"> <?php echo $this->language->from_body()[57][64] ?>&nbsp;
                        <?php else: ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="user_reviewd" value="1" id="user_reviewd"> <?php echo $this->language->from_body()[57][63] ?>&nbsp;
                           <input type="radio" name="user_reviewd" value="2" id="user_reviewd" checked> <?php echo $this->language->from_body()[57][64] ?>&nbsp;
                               
                        <?php endif; ?>                


                       
                    </div> 
                    <div class="form-group">
                       <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[57][65] ?></label>

                        <?php if ($ginfo->whether_mail==1): ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="whether_mail" value="1" id="whether_mail" checked> <?php echo $this->language->from_body()[57][66] ?>&nbsp;
                           <input type="radio" name="whether_mail" value="2" id="whether_mail"> <?php echo $this->language->from_body()[57][67] ?>&nbsp;
                        <?php else: ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="whether_mail" value="1" id="whether_mail"> <?php echo $this->language->from_body()[57][66] ?>&nbsp;
                           <input type="radio" name="whether_mail" value="2" id="whether_mail" checked> <?php echo $this->language->from_body()[57][67] ?>&nbsp;
                               
                        <?php endif; ?> 
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