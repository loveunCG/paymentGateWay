<div class="container-fluid">
    <div class="container block" style="margin-top:5%;">
        <h1 class="well">商户注册</h1>
        <div class="col-sm-12 well ">
            <div class="row">
                <form id="contact_form" action="<?php echo base_url() ?>employee/dashboard/save_employee" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="col-sm-12">
                            
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>商户ID*</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>
                                        <input type="text" class="form-control" id="usr_name" disabled="disabled" value="<?php echo  $employee_details->employee_id;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>商户邮件* </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" name="usr_email" disabled="disabled" value="<?php echo  $employee_details->usr_email;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>身份证号码: </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-credit-card"></i>
                                        </div>
                                        <input type="number" name="usr_idcard_num" id="usr_idcard_num" class="form-control">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>公司名称 </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                        <input type="text" class="form-control" name="usr_company_num" id="usr_company_num" disabled="disabled" value="<?php echo  $employee_details->usr_company_name;?>">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>法人</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </div>
                                        <input type="text" name="law_name" id="law_name" class="form-control" disabled="disabled" value="<?php echo  $employee_details->usr_law_name;?>">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="row" style="margin-top:2%;margin-bottom:2%;">
                                <div class="col-sm-6 form-group">
                                    <label>所属商户组 *</label>
                                    <input type="txet" class="form-control select2" style="width: 100%;" name="emp_group_id" disabled="disabled" value="<?php echo  $employee_details->emp_group_id;?>">
                                </div>
                            </div>

                            <div class="row">                                
                                <div class="col-sm-6 form-group">
                                    <label>QQ/MSN</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-qrcode"></i>
                                        </div>
                                        <input type="text" class="form-control" id="usr_contact_qq_num" name="usr_contact_qq_num">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>联系电话</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" id="usr_mobile" class="form-control" disabled value="<?php echo $employee_details->usr_mobile;?>">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                       
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>开户银行*</label>
                                     <input type="text" id="" class="form-control" disabled value="<?php echo $employee_details->usr_bank_name;?>">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>开户行所在省 *</label>
                                    <div data-toggle="distpicker" id="distpicker1">
                                        <div class="col-sm-6">
                                            <label class="sr-only" for="province3">Province</label>
                                            <select class="form-control" name="usr_bank_branch_name" id="province3" data-province="浙江省"></select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="sr-only" for="city3">City</label>
                                            <select class="form-control" name="usr_address2" id="city3" data-city="杭州市"></select>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>开户行卡号*</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                        <input type="text" class="form-control" name="usr_bank_num" id="usr_bank_num" disabled value="<?php echo $employee_details->usr_bank_num;?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-block btn-info">登记 </button>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-block btn-info "><a onclick="history.go(-1);">退出</a></button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</div>
<script src="<?php echo base_url(); ?>asset/employee/distpicker.data.js"></script>
<script src="<?php echo base_url(); ?>asset/employee/distpicker.js"></script>
<script src="<?php echo base_url(); ?>asset/employee/main.js"></script>
<style>
    #success_message {
        display: none;
    }

    #contact_form .has-feedback .form-control-feedback {
        top: 26px;
        right: 4%
    }
</style>



<script>
    $(document).ready(function () {
        $("#distpicker1").distpicker();
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#contact_form').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    validators: {
                        stringLength: {
                            min: 1,
                            message: '请输入您的性！'
                        },
                        notEmpty: {
                            message: '请输入您的性！'
                        }
                    }
                },
                last_name: {
                    validators: {
                        stringLength: {
                            min: 1,
                            message: '请输入您的名！'
                        },
                        notEmpty: {
                            message: '请输入您的名！'
                        }
                    }
                },
                usr_idcard_num: {
                    validators: {
                        stringLength: {
                            min: 10,
                            max: 18,
                            message: '请输入11~14个字！'
                        },
                        notEmpty: {
                            message: '请输入您的身份ID！'
                        }
                    }

                },
                law_name: {
                    validators: {
                        stringLength: {
                            min: 2,
                            message: '请输入 2个字！'
                        },
                        notEmpty: {
                            message: '请输入您法人名！'
                        }
                    }

                },
                usr_phone_num: {
                    validators: {
                        stringLength: {
                            min: 8,
                            max: 12,
                            message: '请输入8~12个字！'

                        },
                        notEmpty: {
                            message: '请输入您的性！'
                        }
                    }
                },
               
                user_name: {
                    validators: {
                        stringLength: {
                            min: 1,
                            message: '请输入2个字！'

                        },
                        notEmpty: {
                            message: '请输入您的性！'
                        }
                    }
                },               
                usr_bank_num: {
                    validators: {
                        stringLength: {
                            min: 8,
                            max: 14,
                            message: '请正确输入！'
                        },
                        notEmpty: {
                            message: '请正确输入！'
                        }
                    }
                },
                usr_amount: {
                    validators: {
                        stringLength: {
                            min: 1,
                        },
                        notEmpty: {
                            message: '请输入充值金额'
                        }
                    }
                }
            }
        });

    });
</script>