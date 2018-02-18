<link href="<?php echo base_url() ?>asset/css/bootstrap-toggle.min.css" rel="stylesheet"> 
<script src="<?php echo base_url() ?>asset/js/bootstrap-toggle.min.js"></script>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php
$error_message = $this->session->userdata('error_message');
$error_type = $this->session->userdata('error_type');
if (!empty($error_message)) {
    foreach ($error_message as $key => $v_message) {
        ?>
        <div class="alert alert-<?php echo $error_type[$key] ?>">
            <?php echo $v_message; ?>
        </div>
    <?php }
} $this->session->unset_userdata('error_message'); ?>
<div class="row">
    <div class="col-sm-12"> 
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php
                        echo $this->language->form_heading()[4]
                        ?></strong>
                    </div>
                </div>
                <div class="panel-body">

                    <form id="form" action="<?php echo base_url() ?>admin/settings/set_noticifation" method="post" class="form-horizontal form-groups-bordered">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[5][0] ?>  <span class="required">*</span></label>

                            <div class="col-sm-5">                            
                                <input data-toggle="toggle" name="email" value="1" <?php
                                if (!empty($email_notiifation) && $email_notiifation->notify_me == 1) {
                                    echo 'checked';
                                }
                                ?> data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" type="checkbox">
                            </div>                            
                        </div>                                            
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[5][1] ?>  <span class="required">*</span></label>

                            <div class="col-sm-5">                            
                                <input  data-toggle="toggle" <?php
                                if (!empty($notice_notiifation) && $notice_notiifation->notify_me == 1) {
                                    echo 'checked';
                                }
                                ?> name="notice" value="1" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" type="checkbox">
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[5][2] ?>  <span class="required">*</span></label>

                            <div class="col-sm-5">                            
                                <input  data-toggle="toggle" <?php
                                if (!empty($leave_notiifation) && $leave_notiifation->notify_me == 1) {
                                    echo 'checked';
                                }
                                ?> name="leave" value="1" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" type="checkbox">
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][13] ?></button>                            
                            </div>
                        </div>
                    </form>
                </div>                 
            </div>                 
        </div>         
    </div>   
</div>