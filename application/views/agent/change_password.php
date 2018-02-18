<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>修改密码</strong>
                </div>                
            </div>
            <div class="panel-body">
                <form role="form" id="change_password" action="<?php echo base_url(); ?>agent/dashboard/set_password" method="post" class="form-horizontal form-groups-bordered">                        

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">原密码： <span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="password" name="old_password" value="" class="form-control"  placeholder="" onchange="check_agent_password(this.value)"/>
                            
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">新密码：<span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="password" name="new_password" id="new_password" value="" class="form-control"  placeholder=""/>
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">确认密码：<span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="password" name="confirm_password" value="" class="form-control"  placeholder=""/>
                        </div>
                    </div>                                        

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" id="sbtn" class="btn btn-primary">确认修改</button>                            
                        </div>
                    </div>   
                </form>
            </div>            
        </div>
        <br/>   
    </div>   
</div>   
