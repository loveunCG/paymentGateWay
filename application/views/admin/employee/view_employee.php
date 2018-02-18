
<div class="col-md-12">
    <div class="tab-content">
        <div>
            <div class="wrap-fpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><i class="fa fa-minus-square"></i> 商户信息
                            </strong>
                            <div style="float: right;">
<!--                             <span><?php echo btn_edit('admin/employee/add_employee/' . $employee_info->employee_id); ?></span>
                            <span><?php echo btn_pdf('admin/employee/make_pdf/' . $employee_info->employee_id); ?></span> -->

                        </div>
                        </div>

                    </div>
                    <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation()" action="<?php echo base_url(); ?>admin/employee/save_employee/<?php if (!empty($ginfo)) echo $ginfo->employee_id; ?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#user"
                                                      data-toggle="tab">商户信息</a>
                                </li>
                                <li><a href="#home"
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
                                <li class=""><a href="#account"
                                                data-toggle="tab"> 账户信息</a>
                                <li class=""><a href="#shezhi"
                                                data-toggle="tab">返单设置</a>
                               <!--  <li class=""><a href="#messages"
                                                data-toggle="tab">通道限额</a> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="user">
                                    <p>
                                        <div class="form-group" >
                                            <label for="field-1" required style="text-align: left;margin-left: 5%;"
                                                   class="col-sm-1 control-label">商户ID
                                               </label>

                                            <div class="col-sm-5">
                                                  <label for="field-1" required style="text-align: left;"
                                                   class="col-sm-3 control-label"><?php if (!empty($ginfo)) echo $ginfo->employee_id; ?>
                                               </label>
                                              <input type="hidden" name="" id="employee_id" value="<?php if (!empty($ginfo)) echo $ginfo->employee_id; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required style="text-align: left;margin-left: 5%;"
                                                   class="col-sm-1 control-label">商户邮件
                                               </label>

                                            <div class="col-sm-5">
                                                  <label for="field-1" required style="text-align: left;"
                                                   class="col-sm-3 control-label"><?php if (!empty($ginfo)) echo $ginfo->usr_email; ?>
                                               </label>
                                        <input type="hidden" name="usr_email" value="<?php if (!empty($ginfo)) echo $ginfo->usr_email; ?>">

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required style="text-align: left;margin-left: 5%;"
                                                   class="col-sm-1 control-label">最后登录时间
                                               </label>

                                            <div class="col-sm-5">
                                                  <label for="field-1" required style="text-align: left;"
                                                   class="col-sm-3 control-label"><?php if (!empty($ginfo)) echo $ginfo->usr_create_time; ?>
                                               </label>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required style="text-align: left;margin-left: 5%;"
                                                   class="col-sm-1 control-label">最后登录IP
                                               </label>

                                            <div class="col-sm-5">
                                                  <label for="field-1" required style="text-align: left;"
                                                   class="col-sm-3 control-label"><?php if (!empty($ginfo)) echo $ginfo->user_ip; ?>
                                               </label>

                                            </div>

                                        </div>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="home">
                                    <p>
                                        <div class="form-group" >
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">商户ID
                                               </label>

                                            <div class="col-sm-5">
                                                  <label for="field-1" required
                                                   class="col-sm-3 control-label"><?php if (!empty($ginfo)) echo $ginfo->employee_id; ?>
                                               </label>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">商户邮件
                                               </label>

                                            <div class="col-sm-5">
                                                  <label for="field-1" required
                                                   class="col-sm-6 control-label"><?php if (!empty($ginfo)) echo $ginfo->usr_email; ?>

                                              <?php if ($ginfo->usr_email_status==0) { ?>
                                                  &nbsp;&nbsp;已验证邮箱
                                                  </label>
                                             <input type="hidden" name="emailverify" value="1">
                                              <?php } else{ ?>
                                                  &nbsp;&nbsp;还没验证
                                                  </label>

                                              <?php } ?>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">最后登录时间
                                               </label>

                                            <div class="col-sm-5">
                                                  <label for="field-1" required
                                                   class="col-sm-3 control-label"><?php if (!empty($ginfo)) echo $ginfo->usr_create_time; ?>
                                               </label>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">最后登录IP
                                               </label>

                                            <div class="col-sm-5">
                                                  <label for="field-1" required
                                                   class="col-sm-3 control-label"><?php if (!empty($ginfo)) echo $ginfo->user_ip; ?>
                                               </label>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">所属代理
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <select name="agent_group" class="form-control">
                                                  <option value="" ></option>
                                                   <?php if (!empty($proxy_info)){ ?>
                                                                    <?php foreach ($proxy_info as $agent) :
                                                                    if ($agent->proxy_id==$ginfo->agent_group) {
                                                                    ?>
                                                                        <option value="<?php echo $agent->proxy_id; ?>"  selected>
                                                                        <?php echo $agent->proxy_id ?></option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $agent->proxy_id; ?>" >
                                                                        <?php echo $agent->proxy_id ?></option>
                                                                    <?php }  endforeach; ?>

                                                    <?php } ?>
                                              </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">所属商户组
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <select name="usr_gourp" class="form-control">
                                                    <option value="" ></option>
                                                   <?php if (!empty($all_group_info)): ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                          <option value="<?php echo $designation->id; ?>"  selected>
                                                          <?php echo $designation->group_name ?></option>
                                                      <?php } else { ?>
                                                          <option value="<?php echo $designation->id; ?>" >
                                                          <?php echo $designation->group_name ?></option>
                                                      <?php }  endforeach; ?>

                                                    <?php endif; ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">所属销售
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="sale_state" id="sale_state" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->sale_state; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">商户密码
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="password" name="password" id="password" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">确认商户密码
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="password" name="password" id="password" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">商户状态
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                            <?php  if ($ginfo->usr_status==1) { ?>
                                              <input name="usr_status" value="2" id="usr_status" type="radio"> 等侍验证&nbsp;
                                              <input name="usr_status" value="1" id="usr_status" type="radio" checked> 通过验证&nbsp;
                                              <input name="usr_status" value="3" id="usr_status" type="radio"> 拒绝验证&nbsp;
                                              <input name="usr_status" value="4" id="usr_status" type="radio"> 冻结商户
                                             <?php } elseif($ginfo->usr_status==2) {?>
                                              <input name="usr_status" value="2" id="usr_status" type="radio" checked> 等侍验证&nbsp;
                                              <input name="usr_status" value="1" id="usr_status" type="radio"> 通过验证&nbsp;
                                              <input name="usr_status" value="3" id="usr_status" type="radio"> 拒绝验证&nbsp;
                                              <input name="usr_status" value="4" id="usr_status" type="radio"> 冻结商户
                                              <?php } elseif($ginfo->usr_status==3){ ?>
                                              <input name="usr_status" value="2" id="usr_status" type="radio" > 等侍验证&nbsp;
                                              <input name="usr_status" value="1" id="usr_status" type="radio"> 通过验证&nbsp;
                                              <input name="usr_status" value="3" id="usr_status" type="radio" checked> 拒绝验证&nbsp;
                                              <input name="usr_status" value="4" id="usr_status" type="radio"> 冻结商户
                                              <?php } else{ ?>
                                              <input name="usr_status" value="2" id="usr_status" type="radio" > 等侍验证&nbsp;
                                              <input name="usr_status" value="1" id="usr_status" type="radio"> 通过验证&nbsp;
                                              <input name="usr_status" value="3" id="usr_status" type="radio" > 拒绝验证&nbsp;
                                              <input name="usr_status" value="4" id="usr_status" type="radio" checked> 冻结商户
                                              <?php }?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">资金状态
                                                <span class="required"> *</span></label>
                                            <div class="col-sm-5">
                                            <?php  if ($ginfo->status==1) { ?>
                                                <input name="status" value="1" id="status" type="radio" checked=""> 正常&nbsp;
                                                <input name="status" value="2" id="status" type="radio"> 冻结&nbsp;
                                            <?php } else{ ?>
                                                <input name="status" value="1" id="status" type="radio"> 正常&nbsp;
                                                <input name="status" value="2" id="status" type="radio" checked=""> 冻结&nbsp;
                                            <?php }?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">支付校验证码
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_pay_check_code" id="pay_code" id="field-1" style="width: 60%;"
                                                       placeholder="" value="<?php if (!empty($ginfo)) echo $ginfo->usr_pay_check_code; ?>" />

                                                <input type="button" onclick="javascript:update_code()" value="更换">
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">下行URL地址
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="url_adress" id="url_adress" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->url_adress; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">风控状态
                                                <span class="required"> *</span></label>
                                            <div class="col-sm-5">
                                                <label class="col-sm-3 ">
                                                    <input  type="checkbox" name="wind_control_status" value="<?php if (!empty($ginfo)) echo $ginfo->wind_control_status; ?>"
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->wind_control_status == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>
                                                    <span>
                                                    <?php
                                                        if (!empty($ginfo) && $ginfo->wind_control_status == 0) {  ?>
                                                    <input  type="hidden" name="wind_control_status" value="<?php echo 1 ?>"/>
                                                    <?php  } ?>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">商品名称
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="product_name" id="product_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->product_name; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">商品描述
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="product_details" id="product_details" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->product_details; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">法人
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_law_name" id="usr_law_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_law_name; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">法人身份证号码
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_idcard_num" id="usr_idcard_num" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_idcard_num; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">联系电话
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_mobile" id="usr_mobile" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_mobile; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">QQ/MSN
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_contact_qq_num" id="usr_contact_qq_num" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_contact_qq_num; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                             <label for="field-1" required
                                                    class="col-sm-3 control-label">营业执照信用代码</label>
                                             <div class="col-sm-5">
                                                 <input type="text" name="maratial_status"  class="form-control" id="field-1" placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->maratial_status; ?>" />
                                             </div>
                                         </div>
                                       <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">公司名称
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_company_name" id="usr_company_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_company_name; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">公司注册号
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="user_company_account" id="user_company_account" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->user_company_account; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">网站地址
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <?php if (!empty($ginfo->user_company_url)) { ?>
                                                  <input type="text" name="user_company_url" id="user_company_url" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->user_company_url; ?>" disabled/>
                                                <?php  } else { ?>
                                                  <input type="text" name="user_company_url" id="user_company_url" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->user_company_url; ?>" />
                                                <?php } ?>
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">追加备注
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="summary" id="summary" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->summary; ?>" />
                                                <!-- <span id="id_error_msg6" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                         -->
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
                                              <select name="channel_online" class="form-control col-sm-5" aria-required="true" aria-invalid="false" >
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php
                                                foreach ($channel_info as $key=>$v_fields) :
                                                    if ($v_fields->channel_type==1) {
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_online ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?> ><?php echo $v_fields->channel_name; ?></option>
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
                                              <select name="channel_alipay" class="form-control col-sm-5" aria-required="true" aria-invalid="false" >
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
                                              <select name="channel_tenpay" class="form-control col-sm-5" aria-required="true" aria-invalid="false" >
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php
                                                foreach ($channel_info as $key=>$v_fields) :
                                                    if ($v_fields->channel_type==4) {
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_tenpay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
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
                                              <select name="channel_weixin" class="form-control col-sm-5" aria-required="true" aria-invalid="false" >
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php
                                                foreach ($channel_info as $key=>$v_fields) :
                                                    if ($v_fields->channel_type==5) {
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_weixin ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
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
                                              <select name="channel_wapalipay" class="form-control col-sm-5" aria-required="true" aria-invalid="false" >
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php
                                                foreach ($channel_info as $key=>$v_fields) :
                                                    if ($v_fields->channel_type==6) {
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_wapalipay ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
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
                                              <select name="channel_wapweixin" class="form-control col-sm-5" aria-required="true" aria-invalid="false" >
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php
                                                foreach ($channel_info as $key=>$v_fields) :
                                                    if ($v_fields->channel_type==9) {
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_wapweixin ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
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
                                              <select name="channel_daifu" class="form-control col-sm-5" aria-required="true" aria-invalid="false" >
                                                  <option value="" ><?php echo $this->language->from_body()[5][5] ?></option>
                                                  <?php
                                                foreach ($channel_info as $key=>$v_fields) :
                                                    if ($v_fields->channel_type==10) {
                                                        ?>
                                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)){ echo $v_fields->id == $ginfo->channel_daifu ? 'selected' : '';}else{if($key==1){echo 'selected';}} ?>><?php echo $v_fields->channel_name; ?></option>
                                                        <?php
                                                        }
                                                endforeach;
                                                ?>
                                              </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">个人网关设置
                                                <span class="required"> *</span></label>
                                          <div class="col-sm-5">
                                              <input  type="checkbox" name="channel_status" value="1"
                                                    <?php  if ($ginfo->channel_status == 1) {
                                                                        echo 'checked';
                                                                    }
                                                                ?> />
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
                          <?php if (!$ginfo->ONLINE) { ?>
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
                               
                         <input type="text" name="ONLINE"  class="form-control" id="field-1" value="<?php echo $ginfo->ONLINE; ?>"/>

                          <?php } ?>
                    
                        </div>
                  
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">财付通<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if (!$ginfo->TENPAY) { ?>
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

                         <input type="text" name="TENPAY"  class="form-control" id="field-1" value="<?php echo $ginfo->TENPAY; ?>"/>

                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">微信<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if (!$ginfo->WEIXIN) { ?>
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
                         <input type="text" name="WEIXIN"  class="form-control" id="field-1" value="<?php echo $ginfo->WEIXIN; ?>"/>

                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">支付宝<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if (!$ginfo->ALIPAY) { ?>
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

                         <input type="text" name="ALIPAY"  class="form-control" id="field-1" value="<?php echo $ginfo->ALIPAY; ?>"/>

                          <?php } ?>
                        </div>                        
                    </div> 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">WAP支付宝<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if (!$ginfo->ALIPAYWAP) { ?>
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

                         <input type="text" name="ALIPAYWAP"  class="form-control" id="field-1" value="<?php echo $ginfo->ALIPAYWAP; ?>"/>

                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">WAP微信<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if (!$ginfo->WEIXINWAP) { ?>
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
                         <input type="text" name="WEIXINWAP"  class="form-control" id="field-1" value="<?php echo $ginfo->WEIXINWAP; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>
                        <label for="field-1" class="col-sm-1 control-label">代付<span class="required"> *</span></label>

                        <div class="col-sm-2">
                          <?php if (!$ginfo->DAIFU) { ?>
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
                         <input type="text" name="DAIFU"  class="form-control" id="field-1" value="<?php echo $ginfo->DAIFU; ?>"/>
                                <?php
                                    }
                                endforeach;
                                ?>
                          <?php } ?>
                        </div>                        
                    </div>     
                        <div class="form-group">
                              <label for="field-1" required
                                                   class="col-sm-3 control-label">个人费率设置
                                                <span class="required"> *</span></label>
                                <div class="col-sm-5">
                                      <input  type="checkbox" name="rate_status" value="1"
                                      <?php
                                          if ($ginfo->rate_status == 1) {
                                              echo 'checked';
                                          }
                                      ?> />
                                        </div>
                                        </div>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4></h4>
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">默认手续费率
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <?php if (!empty($ginfo->group_fee)) { ?>
                                                <input type="text" name="group_fee" id="group_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_fee; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="group_fee" id="group_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->group_fee ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="group_fee" id="group_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->fee; ?>" />
                                              <?php } ?>

                                                <!-- <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                          -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">手续费上限
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <?php if (!empty($ginfo->group_up_fee)) { ?>
                                                <input type="text" name="group_up_fee" id="group_up_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_up_fee; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="group_up_fee" id="group_up_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->group_up_fee ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="group_up_fee" id="group_up_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->max_sdl_value; ?>" />
                                              <?php } ?>

                                                <!-- <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">手续费下限
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <?php if (!empty($ginfo->group_low_fee)) { ?>
                                                <input type="text" name="group_low_fee" id="group_low_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_low_fee; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="group_low_fee" id="group_low_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->group_low_fee ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="group_low_fee" id="group_low_fee" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->min_sdl_value; ?>" />
                                              <?php } ?>
                                                <!-- <span id="id_error_msg3" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">最低提现金额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <?php if (!empty($ginfo->group_amount)) { ?>
                                                <input type="text" name="group_amount" id="group_amount" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_amount; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="group_amount" id="group_amount" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->group_amount ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="group_amount" id="group_amount" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->payable_amount; ?>" />
                                              <?php } ?>

                                                <!-- <span id="id_error_msg4" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">提现模式
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-2">
                                              <?php if (!empty($ginfo->group_withdraw_time)) { ?>
                                                <input type="text" name="group_withdraw_time" id="group_withdraw_time" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->group_withdraw_time; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="group_withdraw_time" id="group_withdraw_time" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->group_withdraw_time ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="group_withdraw_time" id="group_withdraw_time" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->method; ?>" />
                                              <?php } ?>
                                            </div>
                                            <label for="field-3" class="col-sm-3 control-label">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)</label>
                                        </div>
                                        <div class="form-group">                  <!-- List  of days -->
                                         <label for="field-1" class="col-sm-3 control-label">商户设置
                                         <span class="required"> *</span></label>
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="user_method_set" value="1"
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->user_method_set == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>

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
                                                <input type="text" name="online_limit" id="online_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->online_limit; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="online_limit" id="online_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->online_limit ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="online_limit" id="online_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->limit_online; ?>" />
                                              <?php } ?>

                                                <!-- <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                          -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">支付宝限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <?php if (!empty($ginfo->alipay_limit)) { ?>
                                                <input type="text" name="alipay_limit" id="alipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->alipay_limit; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="alipay_limit" id="alipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->alipay_limit ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="alipay_limit" id="alipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->limit_alipay; ?>" />
                                              <?php } ?>

                                                <!-- <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">支付宝WAP限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <?php if (!empty($ginfo->wapalipay_limit)) { ?>
                                                <input type="text" name="wapalipay_limit" id="wapalipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->wapalipay_limit; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="wapalipay_limit" id="wapalipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->wapalipay_limit ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="wapalipay_limit" id="wapalipay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->limit_wap; ?>" />
                                              <?php } ?>

                                                <!-- <span id="id_error_msg3" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">财付通限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <?php if (!empty($ginfo->tenpay_limit)) { ?>
                                                <input type="text" name="tenpay_limit" id="tenpay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->tenpay_limit; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="tenpay_limit" id="tenpay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->tenpay_limit ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="tenpay_limit" id="tenpay_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->limit_financial; ?>" />
                                              <?php } ?>

                                                <!-- <span id="id_error_msg4" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">微信限额
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                              <?php if (!empty($ginfo->weixin_limit)) { ?>
                                                <input type="text" name="weixin_limit" id="weixin_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $ginfo->weixin_limit; ?>" />
                                              <?php } elseif (!empty($agentname)) { ?>
                                                      <?php foreach ($all_group_info as $designation) :
                                                      if ($designation->id==$ginfo->usr_gourp) {
                                                      ?>
                                                      <input type="text" name="weixin_limit" id="weixin_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $designation->weixin_limit ?>" />
                                                      <?php }  endforeach; ?>

                                              <?php }else{ ?>
                                                <input type="text" name="weixin_limit" id="weixin_limit" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php echo $sys_info->limit_credit; ?>" />
                                              <?php } ?>

                                                <!-- <span id="id_error_msg5" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">                  <!-- List  of days -->
                                         <label for="field-1" class="col-sm-3 control-label">商户限额设置
                                         <span class="required"> *</span></label>
                                                <label class="col-sm-1 ">
                                                    <input  type="checkbox" name="user_limit_set" value="1"
                                                            <?php
                                                                if (!empty($ginfo) && $ginfo->user_limit_set == 1) {
                                                                    echo 'checked';
                                                                }
                                                            ?>/>
                                                    <span> 启用</span>
                                                </label>
                                        </div>
                                    </p>
                                </div>
                              <div class="tab-pane fade" id="account">
                                    <h4></h4>
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">开户银行
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_bank_name" id="usr_bank_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_bank_name; ?>" />
                                                <!-- <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                          -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">开户行所在省
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_address_1" id="usr_address_1" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_address_1; ?>" />
                                                <!-- <span id="id_error_msg2" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">开户行所在地区
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_address_2" id="usr_address_2" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_address_2; ?>" />
                                                <!-- <span id="id_error_msg3" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">开户行网点名称
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_bank_branch_name" id="usr_bank_branch_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_bank_branch_name; ?>" />
                                                <!-- <span id="id_error_msg4" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                           -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">开户行卡号
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="usr_bank_num" id="usr_bank_num" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->usr_bank_num; ?>" />
                                                <!-- <span id="id_error_msg5" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)。</small></span>                                                         -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" required
                                                   class="col-sm-3 control-label">开户名
                                                <span class="required"> *</span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="user_name" id="user_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->user_name; ?>" />
                                                <!-- <span id="id_error_msg5" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入提现模式(实时提现输入0或输入之后希望的提现天数)。</small></span>                                                         -->
                                            </div>
                                        </div>
                                    </p>
                                </div>

                              <div class="tab-pane fade" id="shezhi">
                                    <h4></h4>
                                    <p>
                                        <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">返单地址
                                                <span class="required"> </span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="order_url" id="order_url" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->order_url; ?>" />
                                                <!-- <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>                                                          -->
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="field-1" required class="col-sm-3 control-label">下发服务器
                                                <span class="required"> </span></label>

                                            <div class="col-sm-5">
                                                <input type="text" name="xafa_name" id="xafa_name" class="form-control" id="field-1"
                                                       placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->xafa_name; ?>" />
                                                <span id="id_error_msg1" style="display: none;"><small style="padding-left:10px;color:red;font-size:14px">*请输入一个字段值。</small></span>
                                            </div>
                                        </div>-->


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

 function update_code() {
        var employee_id = $('#employee_id').val();
        var val = 0;
        var base_url = '<?php echo base_url(); ?>';
        var strURL = base_url + "admin/employee/radom_update_code";
        $.post(strURL, {employee: employee_id}, function(data)  {
                $('#pay_code').val(data);
         } );

    }


    // function validation()
    // {
    //     var group_name = $('#group_name').val();
    //     var group_details = $('#group_details').val();
    //     var channel_online = $('#channel_online').val();
    //     var channel_card = $('#channel_card').val();
    //     var channel_alipay = $('#channel_alipay').val();
    //     var channel_tenpay = $('#channel_tenpay').val();
    //     var channel_weixin = $('#channel_weixin').val();

    //     var channel_wapalipay = $('#channel_wapalipay').val();
    //     var channel_waptenpay = $('#channel_waptenpay').val();
    //     var channel_wapqq = $('#channel_wapqq').val();
    //     var channel_wapweixin = $('#channel_wapweixin').val();
    //     var channel_daifu = $('#channel_daifu').val();
    //     var group_fee = $('#group_fee').val();
    //     var group_up_fee = $('#group_up_fee').val();
    //     var group_low_fee = $('#group_low_fee').val();
    //     var group_amount = $('#group_amount').val();
    //     var group_withdraw_time = $('#group_withdraw_time').val();
    //     var online_limit = $('#online_limit').val();
    //     var alipay_limit = $('#alipay_limit').val();
    //     var wapalipay_limit = $('#wapalipay_limit').val();
    //     var tenpay_limit = $('#tenpay_limit').val();
    //     var weixin_limit = $('#weixin_limit').val();
    //     var user_limit_set = $('#user_limit_set').val();

    //     if (group_name=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("group_name").focus();
    //         return false;
    //     }
    //     if (group_details=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("group_details").focus();
    //         return false;
    //     }
    //     if (channel_online=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_online").focus();
    //         return false;
    //     }
    //     if (channel_card=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_card").focus();
    //         return false;
    //     }
    //     if (channel_alipay=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_alipay").focus();
    //         return false;
    //     }
    //     if (channel_tenpay=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_tenpay").focus();
    //         return false;
    //     }
    //     if (channel_weixin=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_weixin").focus();
    //         return false;
    //     }

    //     if (channel_wapalipay=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_wapalipay").focus();
    //         return false;
    //     }
    //     if (channel_waptenpay=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_waptenpay").focus();
    //         return false;
    //     }
    //     if (channel_wapqq=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_wapqq").focus();
    //         return false;
    //     }
    //     if (channel_wapweixin=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_wapweixin").focus();
    //         return false;
    //     }
    //     if (channel_daifu=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("channel_daifu").focus();
    //         return false;
    //     }
    //     if (group_fee=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("group_fee").focus();
    //         return false;
    //     }
    //     if (group_up_fee=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("group_up_fee").focus();
    //         return false;
    //     }
    //     if (group_low_fee=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("group_low_fee").focus();
    //         return false;
    //     }
    //     if (group_amount=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("group_amount").focus();
    //         return false;
    //     }
    //     if (group_withdraw_time=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("group_withdraw_time").focus();
    //         return false;
    //     }
    //     if (online_limit=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("online_limit").focus();
    //         return false;
    //     }
    //     if (alipay_limit=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("alipay_limit").focus();
    //         return false;
    //     }
    //     if (wapalipay_limit=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("wapalipay_limit").focus();
    //         return false;
    //     }
    //     if (tenpay_limit=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("tenpay_limit").focus();
    //         return false;
    //     }
    //     if (weixin_limit=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("weixin_limit").focus();
    //         return false;
    //     }
    //     if (user_limit_set=='') {
    //         $("#id_error_msg").css("display", "block");
    //         document.getElementById("user_limit_set").focus();
    //         return false;
    //     }


    // }
</script>
