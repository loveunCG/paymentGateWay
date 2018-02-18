<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">    
    <form role="form" id="update_profile" action="<?php echo base_url(); ?>admin/settings/profile_updated" method="post" class="form-horizontal form-groups-bordered">                        
        <div class="col-sm-6 wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->from_body()[17][1] ?></strong>
                    </div>                
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->language->from_body()[12][1] ?> <span class="required"> *</span></label>
                        <div class="col-sm-7">
                            <input type="text" name="first_name" value="<?php echo $this->session->userdata('first_name'); ?>" class="form-control"  placeholder="" />                                
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->language->from_body()[12][2] ?> <span class="required"> *</span></label>
                        <div class="col-sm-7">
                            <input type="text" name="last_name" value="<?php echo $this->session->userdata('last_name'); ?>" class="form-control"  placeholder="" />                                
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->language->from_body()[9][2] ?><span class="required"> *</span></label>
                        <div class="col-sm-7">
                            <input type="text" name="user_name" value="<?php echo $this->session->userdata('user_name'); ?>" class="form-control"  placeholder="" />
                        </div>
                    </div>                                                                                                
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                            <button type="submit" class="btn btn-primary"><?php echo $this->language->from_body()[1][13] ?></button>                            
                        </div>
                    </div>   
                </div>            
            </div>
        </div>
    </form>
    <form role="form" id="change_password" action="<?php echo base_url(); ?>admin/settings/set_password" method="post" class="form-horizontal form-groups-bordered">                        
        <div class="col-sm-6 wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->from_body()[17][3] ?></strong>
                    </div>                
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->language->from_body()[17][4] ?><span class="required"> *</span></label>
                        <div class="col-sm-7">
                            <input type="password" name="old_password" value="" class="form-control"  placeholder="" onchange="check_current_password(this.value)"/>
                            <span id="id_error_msg"><small style="padding-left:10px;color:red;font-size:10px">您输入的密码不符合</small></span>
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->language->from_body()[17][5] ?> <span class="required"> *</span></label>
                        <div class="col-sm-7">
                            <input type="password" name="new_password" id="new_password" value="" class="form-control"  placeholder=""/>
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->language->from_body()[17][6] ?> <span class="required"> *</span></label>
                        <div class="col-sm-7">
                            <input type="password" name="confirm_password" value="" class="form-control"  placeholder=""/>
                        </div>
                    </div>                                        

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                            <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][13] ?></button>                            
                        </div>
                    </div>   
                </div>            
            </div>
            <br/>   
        </div>   
    </form>
</div>   