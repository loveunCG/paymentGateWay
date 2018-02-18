<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- Table -->

<div class="row" style="margin-bottom: 5%">
</div>

<div class=" col-sm-3"></div>
<div class="col-sm-6 well">
   <h1 class="well">手动补单处理</h1>
    <div class="row">
        <form id="contact_form" action="<?php echo base_url() ?>agent/dashboard/passive_order" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="col-sm-12">
                    <div class="row">
                        <div class=" col-sm-6 form-group">
                            <label>商户ID:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <select name="employee_id" class="form-control" >
                                    <option value=""  ></option>
                                <?php foreach ($cinfo as $emp) : ?>                                        
                                         <option value="<?php echo $emp['employee_id']; ?>"  >
                                        <?php echo $emp['usr_email'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>订单号码 :</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="order_id" >                           
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>商户订单号:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="usr_order_id" >
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>支付通道:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>                     
                                <select name="pay_mode" id="sel_card_id" class="form-control"  onchange="onchange_card(this.value)">                      
                                     
                                    <?php foreach ($all_channel as $designation) : ?>
                                        <?php if ($designation->channel_status==1) { ?>
                                         <option value="<?php echo $designation->id; ?>"  >  
                                       
                                        <?php echo $designation->channel_name ?></option>   
                                         <?php   } ?>                         
                                    <?php endforeach; ?>
               

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-6 form-group">
                            <label>支付方式:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                                <select name="banktype" id="sel_card_id" class="form-control"  onchange="onchange_card(this.value)">                      
                                     
                                                    <?php foreach ($all_channel as $designation) : ?>
                                                        <?php if ($designation->parent==1) { ?>
                                                        <option value="<?php echo $designation->id; ?>"  >
                                                        <?php echo $designation->gateway_name ?></option> 
                                                        <?php   } ?>                           
                                                    <?php endforeach; ?>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>提交金额:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="real_amount" >
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5%;margin-bottom: 5%;">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-block btn-info">手动补单申请</button>
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
<style>
    #success_message {
        display: none;
    }

    #form .has-feedback .form-control-feedback {
        top: 0px;
        right: 58px
    }
</style>
<script>
    $(document).ready(function () {       
        $('#contact_form').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                employee_id: {
                    validators: {
                        stringLength: {
                            min: 4,
                            message: '请输入ID.。！'
                        },
                        notEmpty: {
                            message: '请输入ID！'
                        }
                    }
                },
                order_id: {
                    validators: {
                        stringLength: {
                            min: 8,
                            message: '必须要的！'
                        },
                        notEmpty: {
                            message: '必须要的！'
                        }
                    }
                },
                banktype: {
                    validators: {
                        
                        notEmpty: {
                            message: '必须要的！'
                        }
                    }

                },               
                real_amount: {
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

