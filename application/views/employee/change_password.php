<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="container-fluid">
    <div class="row col-xs-offset-1 col-xs-10" style="margin-top:5%;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><strong>修改密码</strong></strong>
                </div>
            </div>
            <div class="row">
                <div class="panel-body">
                    <div class="col-xs-12">
                        <form role="form" id="change_password" action="<?php echo base_url(); ?>employee/dashboard/set_password" method="post" class="form-horizontal form-groups-bordered">
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">旧密码 <span class="required"> *</span></label>
                                <div class="col-sm-5">
                                    <input type="password" name="old_password" value="" class="form-control" placeholder="请输入密码" onchange="check_employee_password(this.value)"/>
                                    <span id="id_error_msg"></span>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">新密码 <span class=""> *</span></label>
                                    <div class="col-sm-5">
                                        <input type="password" name="new_password" id="new_password" value="" class="form-control" placeholder="新密码" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">确认密码 <span class=""> *</span></label>
                                    <div class="col-sm-5">
                                        <input type="password" name="confirm_password" value="" class="form-control" placeholder="再输入" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-12">
                                        <button type="submit" id="sbtn" class="btn btn-primary">更新</button>
                                    </div>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        $('#change_password').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                new_password: {
                    validators: {
                        stringLength: {
                            min: 8,
                            message: '输入 8个字以上'
                        },
                        notEmpty: {
                            message: '输入 8个字以上'
                        }
                    }
                },
                confirm_password: {
                    validators: {
                        stringLength: {
                            min: 8,
                            message: '输入 8个字以上'
                        },
                        notEmpty: {
                            message: '输入 8个字以上'
                        }
                    }
                }
            }
        });
    });
</script>