<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12 wrap-fpanel">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->form_heading()[52] ?></strong>
                </div>                
            </div>
            <div class="panel-body">

                <form id="add_proxy" role="form" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/proxy/save_data/<?php if (!empty($ginfo)) echo $ginfo->proxy_id; ?>" method="post" class="form-horizontal form-groups-bordered">

                    <div class="form-group">
                        <label for="field-1" required class="col-sm-3 control-label">注册E-MAIL<span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="email" name="mail_address"  class="form-control" id="mail_address" placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->mail_address; ?>"/>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">所属代理组 <span class="required"> *</span></label>
                          <div class="col-sm-5">
                              <select name="agent_group" class="form-control col-sm-5" aria-required="true" aria-invalid="false">
                                  <option value="" >请选择代理组</option>
                                  <?php                               
                                foreach ($agent_group as $v_fields) :                                  
                                        ?>
                                        <option value="<?php echo $v_fields->id?>" <?php if (!empty($ginfo)) echo $v_fields->id == $ginfo->agent_group ? 'selected' : '' ?>><?php echo $v_fields->agent_group_name; ?></option>
                                        <?php                                  
                                endforeach;
                                ?>
                              </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][40] ?> <span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="password" name="proxy_password"  class="form-control" id="proxy_password" placeholder="" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][41] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="password" name="confirm_proxy_password" id="confirm_proxy_password" placeholder="" class="form-control"><span class="required"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][32] ?><span class="required"> *</span></label>
                        <div class="col-sm-8">
                            <?php if($ginfo->proxy_state ==1){ ?>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="1" id="proxy_state" checked> <?php echo $this->language->from_body()[5][6] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="2" id="proxy_state"> <?php echo $this->language->from_body()[5][7] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="3" id="proxy_state"> <?php echo $this->language->from_body()[5][8] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="4" id="proxy_state"> <?php echo $this->language->from_body()[5][9] ?></div>
                            <?php } elseif($ginfo->proxy_state == 2){ ?>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="1" id="proxy_state" > <?php echo $this->language->from_body()[5][6] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="2" id="proxy_state" checked> <?php echo $this->language->from_body()[5][7] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="3" id="proxy_state"> <?php echo $this->language->from_body()[5][8] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="4" id="proxy_state"> <?php echo $this->language->from_body()[5][9] ?></div>
                            <?php } elseif($ginfo->proxy_state ==3){ ?>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="1" id="proxy_state" > <?php echo $this->language->from_body()[5][6] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="2" id="proxy_state" > <?php echo $this->language->from_body()[5][7] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="3" id="proxy_state" checked> <?php echo $this->language->from_body()[5][8] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="4" id="proxy_state"> <?php echo $this->language->from_body()[5][9] ?></div>  
                            <?php } elseif($ginfo->proxy_state ==4){ ?>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="1" id="proxy_state" > <?php echo $this->language->from_body()[5][6] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="2" id="proxy_state" > <?php echo $this->language->from_body()[5][7] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="3" id="proxy_state" > <?php echo $this->language->from_body()[5][8] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="4" id="proxy_state" checked> <?php echo $this->language->from_body()[5][9] ?></div>                                                       

                            <?php }else{?>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="1" id="proxy_state" checked> <?php echo $this->language->from_body()[5][6] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="2" id="proxy_state" > <?php echo $this->language->from_body()[5][7] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="3" id="proxy_state" > <?php echo $this->language->from_body()[5][8] ?></div>
                            <div class="col-sm-2"><input type="radio" name="proxy_state" value="4" id="proxy_state"> <?php echo $this->language->from_body()[5][9] ?></div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][35] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="contact_person" placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->contact_person; ?>"><span class="required"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][31] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="contact_number" placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->contact_number; ?>"><span class="required"></span>
                        </div>
                    </div>
                    <div class="form-group"> <!-- QQ/MSN -->
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][42] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="qq_num" placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->qq_num; ?>"><span class="required"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][43] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                        <input list="browsers" name="open_an_account_bank" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->open_an_account_bank; ?>"/>
                            <datalist id="browsers" >                                
                                <?php foreach ($all_bank as $v_country) : ?>
                                    <option value="<?php echo $v_country->channel_name ?>" >
                                <?php endforeach; ?>
                            </datalist> 
                        <!-- <select name="open_an_account_bank" class="form-control col-sm-5" > -->
<!--                             <option value="" ></option>
                            <?php foreach ($all_bank as $v_country) : ?>
                                <option value="<?php echo $v_country->bank_id ?>" <?php
                                if (!empty($ginfo->open_an_account_bank)) {
                                    echo $v_country->bank_id == $ginfo->open_an_account_bank ? 'selected' : '';
                                }
                                ?>><?php echo $v_country->pay_type ?></option>
                                    <?php endforeach; ?>
                        </select>  -->
                        </div>
                    </div>


                    <div data-toggle="distpicker">
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][45] ?><span class="required"> *</span></label>
                       <div class="col-sm-5">
                            <select class="form-control" name="bank_of_the_province_where_the_bank" id="province7"></select> 
                            </div>                 
                    </div>  
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][46] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                                <select class="form-control" name="account_area" id="city7"></select>  
                                </div>                 
                    </div>                          
                    </div>                       
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][47] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="bank_name" placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->bank_name; ?>"><span class="required"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][48] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="bank_card_number" placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->bank_card_number; ?>"><span class="required"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-3" class="col-sm-3 control-label"><?php echo $this->language->from_body()[2][49] ?><span class="required"> *</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="account_name" placeholder="" class="form-control" value="<?php if (!empty($ginfo)) echo $ginfo->account_name; ?>"><span class="required"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" ><?php echo $this->language->from_body()[2][50] ?></button>
                        </div>
                    </div>
                     

                </form>
            </div>
        </div>
    </div>
</div>

 

<script type="text/javascript">

            function validation() {
 
                var usr_email = $('#mail_address').val();
                var password = $('#proxy_password').val();
                var confirm_passwd = $('#confirm_proxy_password').val();
                if(password!=confirm_passwd){
                    document.getElementById("proxy_password").focus();
                    return false;
                }

            }

</script>
