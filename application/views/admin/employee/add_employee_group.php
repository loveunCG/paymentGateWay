<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i>  添加商户组
                            </strong>
                        </div>

                    </div>
                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation()" action="<?php echo base_url(); ?>admin/employee/save_employee_group/<?php if (!empty($ginfo)) echo $ginfo->id; ?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home"
                                                      data-toggle="tab"><?php echo $this->language->from_body()[57][0] ?></a>
                                </li>
                                <li class=""><a href="#channel"
                                                data-toggle="tab">接入设置</a>
                                </li>
                                <li class=""><a href="#profile"
                                                data-toggle="tab">费率设置</a>
                                </li>

                                
                                <li class=""><a href="#messages"
                                                data-toggle="tab"><?php echo $this->language->from_body()[57][5] ?></a>
                                <li class=""><a href="#amount"
                                                data-toggle="tab">通道限额</a>
                               <!--  <li class=""><a href="#messages"
                                                data-toggle="tab">通道限额</a> -->                                                                                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">商户组名称 
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="group_name" id="group_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->group_name; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">商户组备注
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="group_details" id="group_details" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->group_details; ?>" />
                                                <!-- <span id="id_error_msg7" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">
                                                <span class="required"> </span></label>                                        
                                            <div class="col-sm-5">
                                          <span id="id_error_msg" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*输入的所有信息。</small></span> 
                                            </div>
                                        
                                        </div>                                        

                                    </p>

                                </div>
                                <div class="tab-pane fade" id="channel">
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">网银通道 
                                                <span class="required"> *</span></label>
                                          <div class="col-sm-5">
                                              <select name="channel_online" class="form-control col-sm-5" aria-required="true" aria-invalid="false">
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php                               
                                                foreach ($channel_info as $key=>$v_fields) :                                  
                                                    if ($v_fields->channel_type==1) {                                                           
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_alipay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
                                                        <?php
                                                        }                                  
                                                endforeach;
                                                ?>
                                              </select>
                                        </div>                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">支付宝通道 
                                                <span class="required"> *</span></label>
                                          <div class="col-sm-5">
                                              <select name="channel_alipay" class="form-control col-sm-5" aria-required="true" aria-invalid="false">
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php                               
                                                foreach ($channel_info as $key=>$v_fields) :                                  
                                                    if ($v_fields->channel_type==3) {                                                           
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_alipay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
                                                        <?php
                                                        }                                  
                                                endforeach;
                                                ?>
                                              </select>
                                        </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">财付通通道 
                                                <span class="required"> *</span></label>
                                          <div class="col-sm-5">
                                              <select name="channel_tenpay" class="form-control col-sm-5" aria-required="true" aria-invalid="false">
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php                               
                                                foreach ($channel_info as $key=>$v_fields) :                                  
                                                    if ($v_fields->channel_type==4) {                                                           
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_alipay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
                                                        <?php
                                                        }                                  
                                                endforeach;
                                                ?>
                                              </select>
                                        </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">微信通道
                                                <span class="required"> *</span></label>
                                          <div class="col-sm-5">
                                              <select name="channel_weixin" class="form-control col-sm-5" aria-required="true" aria-invalid="false">
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php                               
                                                foreach ($channel_info as $key=>$v_fields) :                                  
                                                    if ($v_fields->channel_type==5) {                                                           
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_alipay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
                                                        <?php
                                                        }                                  
                                                endforeach;
                                                ?>
                                              </select>
                                        </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">wap支付宝通道 
                                                <span class="required"> *</span></label>
                                          <div class="col-sm-5">
                                              <select name="channel_wapalipay" class="form-control col-sm-5" aria-required="true" aria-invalid="false">
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php                               
                                                foreach ($channel_info as $v_fields) :                                  
                                                    if ($v_fields->channel_type==6) {                                                           
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_alipay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
                                                        <?php
                                                        }                                  
                                                endforeach;
                                                ?>
                                              </select>
                                        </div>                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">wap微信通道 
                                                <span class="required"> *</span></label>
                                          <div class="col-sm-5">
                                              <select name="channel_wapweixin" class="form-control col-sm-5" aria-required="true" aria-invalid="false">
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php                               
                                                foreach ($channel_info as $key=>$v_fields) :                                  
                                                    if ($v_fields->channel_type==9) {                                                           
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_alipay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
                                                        <?php
                                                        }                                  
                                                endforeach;
                                                ?>
                                              </select>
                                        </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">代付网关通道 
                                                <span class="required"> *</span></label>
                                          <div class="col-sm-5">
                                              <select name="channel_daifu" class="form-control col-sm-5" aria-required="true" aria-invalid="false">
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php                               
                                                foreach ($channel_info as $v_fields) :                                  
                                                    if ($v_fields->channel_type==10) {                                                           
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_alipay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
                                                        <?php
                                                        }                                  
                                                endforeach;
                                                ?>
                                              </select>
                                        </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">
                                                <span class="required"> </span></label>                                        
                                            <div class="col-sm-5">
                                          <span id="id_error_msg" ><small style="padding-left:10px;color:red;font-size:14px">*输入的所有信息。</small></span> 
                                            </div>
                                        
                                        </div>                                                                                                                    
                                    </p>

                                </div>                                
                                <div class="tab-pane fade" id="profile">
                                    <h4></h4>
                                    <p>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo $this->language->from_body()[3][7] ?> <span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ICBC) {
                                        ?>
                         <input type="text" name="ONLINE"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ICBC) {
                                        ?>
                         <input type="text" name="ONLINE"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                    
                        </div>
                  
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">财付通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == TENPAY) {
                                        ?>
                         <input type="text" name="TENPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == TENPAY) {
                                        ?>
                         <input type="text" name="TENPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">微信<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXIN) {
                                        ?>
                         <input type="text" name="WEIXIN"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXIN) {
                                        ?>
                         <input type="text" name="WEIXIN"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">支付宝<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAY) {
                                        ?>
                         <input type="text" name="ALIPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAY) {
                                        ?>
                         <input type="text" name="ALIPAY"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">WAP支付宝<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAYWAP) {
                                        ?>
                         <input type="text" name="ALIPAYWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == ALIPAYWAP) {
                                        ?>
                         <input type="text" name="ALIPAYWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">WAP微信<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXINWAP) {
                                        ?>
                         <input type="text" name="WEIXINWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == WEIXINWAP) {
                                        ?>
                         <input type="text" name="WEIXINWAP"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">代付<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if ($agentname=="dont") { ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == DAIFU) {
                                        ?>
                         <input type="text" name="DAIFU"  class="form-control" id="field-1" value="<?php echo $v_fields->cost_rate; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } else{ ?>
                                <?php                                
                                foreach ($cinfo as $v_fields) :
                                    if ($v_fields->channel_code == DAIFU) {
                                        ?>
                         <input type="text" name="DAIFU"  class="form-control" id="field-1" value="<?php echo $v_fields->$agentname; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>                        
                    </div>   
                              <div class="form-group">                  <!-- List  of days -->                   
                                         <label for="field-1" class="col-sm-3 control-label">商户费率设置 
                                         <span class="required"> </span></label>                          
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="user_rate_limit_set" value="1"
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->user_rate_limit_set == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>
                                                    <span>
                                                    启用</span>
                                                </label>
                              </div>                                                           
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4></h4>
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">默认手续费率
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-1">
                                                <?php if (!empty($ginfo->group_fee)) { ?>
                                                <input type="text" name="group_fee" id="group_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_fee; ?>" />
                                                <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="text" name="group_fee" id="group_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->fee; ?>" />
                                                <?php } ?>                                                         
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">手续费上限
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->group_up_fee)) { ?>
                                                <input type="number" name="group_up_fee" id="group_up_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_up_fee; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="group_up_fee" id="group_up_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->max_sdl_value; ?>" />
                                                <?php } ?>                                                          
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">手续费下限
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->group_low_fee)) { ?>
                                                <input type="number" name="group_low_fee" id="group_low_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_low_fee; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="group_low_fee" id="group_low_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->min_sdl_value; ?>" />
                                                <?php } ?>                                                           
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">最低提现金额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->group_amount)) { ?>
                                                <input type="number" name="group_amount" id="group_amount" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_amount; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="group_amount" id="group_amount" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->payable_amount; ?>" />
                                                <?php } ?>                                                         
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">提现模式
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-2">

                                                <?php if (!empty($ginfo->group_withdraw_time)) { ?>
                                                <input type="number" name="group_withdraw_time" id="group_withdraw_time" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_withdraw_time; ?>" />
                                                <span id="id_error_msg5" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)。</small></span>
                                                <?php } else{ ?>
                                                <input type="number" name="group_withdraw_time" id="group_withdraw_time" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->method; ?>" />
                                                <span id="id_error_msg5" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)。</small></span>                                                       
                                                <?php } ?>

                                            </div>
                                           <label for="field-3" class="col-sm-3 control-label">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)</label>
                                        </div> 

                                        <div class="form-group">                  <!-- List  of days -->                   
                                         <label for="field-1" class="col-sm-3 control-label">商户提现设置 
                                         <span class="required"> </span></label>                          
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="user_tixian_limit_set" value="1"
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->user_tixian_limit_set == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>
                                                    <span>
                                                    启用</span>
                                                </label>
                                        </div>                                                                                                                                                              
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="amount">
                                    <h4></h4>
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">网银限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->online_limit)) { ?>
                                                <input type="number" name="online_limit" id="online_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->online_limit; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="online_limit" id="online_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->limit_online; ?>" />
                                                <?php } ?>                                                         
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">支付宝限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->alipay_limit)) { ?>
                                                <input type="number" name="alipay_limit" id="alipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->alipay_limit; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="alipay_limit" id="alipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->limit_alipay; ?>" />
                                                <?php } ?>                                                           
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">支付宝WAP限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->wapalipay_limit)) { ?>
                                                <input type="number" name="wapalipay_limit" id="wapalipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->wapalipay_limit; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="wapalipay_limit" id="wapalipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->limit_wap; ?>" />
                                                <?php } ?>                                                           
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">财付通限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->tenpay_limit)) { ?>
                                                <input type="number" name="tenpay_limit" id="tenpay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->tenpay_limit; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="tenpay_limit" id="tenpay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->limit_financial; ?>" />
                                                <?php } ?>                                                          
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">微信限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->weixin_limit)) { ?>
                                                <input type="number" name="weixin_limit" id="weixin_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->weixin_limit; ?>" />
                                                <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span> 
                                                <?php } else{ ?>
                                                <input type="number" name="weixin_limit" id="weixin_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info[0]->limit_credit; ?>" />
                                                <?php } ?>                                                         
                                            </div>
                                        </div>
                                        <div class="form-group">                  <!-- List  of days -->                   
                                         <label for="field-1" class="col-sm-3 control-label">商户限额设置 
                                         <span class="required"> </span></label>                          
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="user_limit_set" value="1"
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->user_limit_set == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>
                                                    <span>
                                                    启用</span>
                                                </label>
                                        </div>                                                                                                                                                                                                                                         
                                    </p>
                                </div>                                
                            </div>
                            <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-2">
                                <button type="submit" id="sbtn" class="btn btn-primary" style="float: right;" 
                                        id="i_submit"><?php echo $this->language->from_body()[2][50] ?></button>
                            </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
          $(document).ready(function(){
            var sd = $('#group_fee').val()+"%";
            $('#group_fee').val(sd);
        });

    function validation()
    {
        var group_name = $('#group_name').val(); 
        var group_details = $('#group_details').val();
        // var channel_online = $('#channel_online').val();
        // var channel_card = $('#channel_card').val();
        // var channel_alipay = $('#channel_alipay').val();
        // var channel_tenpay = $('#channel_tenpay').val();
        // var channel_weixin = $('#channel_weixin').val();

        // var channel_wapalipay = $('#channel_wapalipay').val();
        // var channel_waptenpay = $('#channel_waptenpay').val();
        // var channel_wapqq = $('#channel_wapqq').val();
        // var channel_wapweixin = $('#channel_wapweixin').val();
        // var channel_daifu = $('#channel_daifu').val();
        // var group_fee = $('#group_fee').val();
        // var group_up_fee = $('#group_up_fee').val();
        // var group_low_fee = $('#group_low_fee').val();
        // var group_amount = $('#group_amount').val();
        // var group_withdraw_time = $('#group_withdraw_time').val();
        // var online_limit = $('#online_limit').val();
        // var alipay_limit = $('#alipay_limit').val();
        // var wapalipay_limit = $('#wapalipay_limit').val();
        // var tenpay_limit = $('#tenpay_limit').val();
        // var weixin_limit = $('#weixin_limit').val();
        // var user_limit_set = $('#user_limit_set').val();

        if (group_name=='') {
            $("#id_error_msg").css("display", "block");          
            document.getElementById("group_name").focus();
            return false;
        }
        if (group_details=='') {
            $("#id_error_msg").css("display", "block");           
            document.getElementById("group_details").focus();
            return false;
        }
        // if (channel_online=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_online").focus();
        //     return false;
        // }
        // if (channel_card=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_card").focus();
        //     return false;
        // }
        // if (channel_alipay=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_alipay").focus();
        //     return false;
        // }
        // if (channel_tenpay=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_tenpay").focus();
        //     return false;
        // }                    
        // if (channel_weixin=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_weixin").focus();
        //     return false;
        // }

        // if (channel_wapalipay=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_wapalipay").focus();
        //     return false;
        // }
        // if (channel_waptenpay=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_waptenpay").focus();
        //     return false;
        // }
        // if (channel_wapqq=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_wapqq").focus();
        //     return false;
        // }
        // if (channel_wapweixin=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_wapweixin").focus();
        //     return false;
        // }
        // if (channel_daifu=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("channel_daifu").focus();
        //     return false;
        // }
        // if (group_fee=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("group_fee").focus();
        //     return false;
        // }
        // if (group_up_fee=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("group_up_fee").focus();
        //     return false;
        // }
        // if (group_low_fee=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("group_low_fee").focus();
        //     return false;
        // }
        // if (group_amount=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("group_amount").focus();
        //     return false;
        // }
        // if (group_withdraw_time=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("group_withdraw_time").focus();
        //     return false;
        // }
        // if (online_limit=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("online_limit").focus();
        //     return false;
        // }
        // if (alipay_limit=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("alipay_limit").focus();
        //     return false;
        // }
        // if (wapalipay_limit=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("wapalipay_limit").focus();
        //     return false;
        // }
        // if (tenpay_limit=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("tenpay_limit").focus();
        //     return false;
        // }
        // if (weixin_limit=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("weixin_limit").focus();
        //     return false;
        // }
        // if (user_limit_set=='') {
        //     $("#id_error_msg").css("display", "block");
        //     document.getElementById("user_limit_set").focus();
        //     return false;
        // }
        
        
    }
</script>    