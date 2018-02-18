<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<form role="form" id="employee-form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/employee/save_employee" method="post" class="form-horizontal form-groups-bordered">
    <div class="row">
        <div class="wrap-fpanel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[11] ?></strong>
                    </div>
                </div>
            </div>
        </div>
        <!-- ************************ Personal Information Panel Start ************************-->
        <div class="col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><?php echo $this->language->from_body()[12][0] ?></h4>
                </div>
                <div class="panel-body ">

<!--                     <div class="">
                        <label class="control-label" >商户ID<span class="required"> *</span></label>
                        <input type="text" name="last_name" value="16020" class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?> readonly>
                    </div> -->
                    <div class="">
                        <label class="control-label" >注册E-MAIL <span class="required"> *</span></label>
                        <input type="email"  name="usr_email" value="<?php
                        if (!empty($employee_info->usr_email)) {
                            echo $employee_info->usr_email;
                        }
                        ?>"  class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>
                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[9][7] ?><span class="required"> *</span></label>
                        <input type="password" name="password" value="" class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?> >
                    </div>
                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[17][9] ?><span class="required"> *</span></label>
                        <input type="password" name="passwordchk" value="" class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>
                    <div class="">
                        <!--change by @p.p Department-->
                        <label class="control-label" ><?php echo $this->language->from_body()[15][1] ?> <span class="required">*</span></label>
                        <select name="usr_gourp" class="form-control">
                            <!--change by @p.p Department-->
                            <option value="">选择商户组</option>
                                    <?php if (!empty($all_proxy_info)): ?>
                                            <?php foreach ($all_proxy_info as $designation) : ?>
                                                <option value="<?php echo $designation->id; ?>"  >
                                                <?php echo $designation->group_name ?></option>
                                            <?php endforeach; ?>

                                    <?php endif; ?>

                        </select>
                    </div>

                    <div class="">
                        <label class="control-label">商户状态</label> &nbsp;&nbsp;
                        <input type="radio" name="usr_status" value="2" checked="checked" id="usr_status"> <?php echo $this->language->from_body()[5][6] ?>&nbsp;
                        <input type="radio" name="usr_status" value="1" id="usr_status"> <?php echo $this->language->from_body()[5][7] ?>&nbsp;
                        <input type="radio" name="usr_status" value="3" id="usr_status"> <?php echo $this->language->from_body()[5][8] ?>&nbsp;
                        <input type="radio" name="usr_status" value="4" id="usr_status"> 冻结商户

                    </div>



                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[1][7] ?> <span class="required"> *</span></label>
                        <input type="text" name="usr_mobile" value="<?php
                        if (!empty($employee_info->usr_mobile)) {
                            echo $employee_info->usr_mobile;
                        }
                        ?>"  class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>


                    <div class="" id="nationality">
                        <label class="control-label" ><?php echo $this->language->from_body()[2][42] ?></label>
                        <input type="text" name="usr_contact_qq_num" value="<?php
                        if (!empty($employee_info->usr_contact_qq_num)) {
                            echo $employee_info->usr_contact_qq_num;
                        }
                        ?>"  class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>

                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-12">
                            <label for="field-1" class="control-label"><?php echo $this->language->from_body()[12][9] ?> <span class="required">*</span></label>
                            <div class="input-group">
                                <input type="hidden" name="old_path" value="<?php
                                if (!empty($employee_info->photo_a_path)) {
                                    echo $employee_info->photo_a_path;
                                }
                                ?>">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                        <?php if (!empty($employee_info->photo)): ?>
                                            <img src="<?php echo base_url() . $employee_info->photo; ?>" >
                                        <?php else: ?>
                                            <img src="http://placehold.it/350x260" alt="请连接您的网络">
                                        <?php endif; ?>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;">
                                        <input type="file" value="<?php if (!empty($employee_info)) echo base_url() . $employee_info->photo; ?>" name="photo" size="20" />
                                    </div>
                                    <div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileinput-new"><input type="file"  name="photo" size="20" /></span>
                                            <span class="fileinput-exists">更改</span>
                                        </span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">去掉</a>
                                    </div>
                                </div>
                                <div id="valid_msg" style="color: #e11221"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ************************ Personal Information Panel End ************************-->
        <div class="col-sm-6"><!-- ************************ Contact Details Start******************************* -->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4 class="panel-title"><?php echo $this->language->from_body()[17][8] ?></h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[2][43] ?><span class="required"> *</span></label>

                        <input list="browsers" name="usr_bank_name" class="form-control" />
                            <datalist id="browsers" >
                                <?php foreach ($all_bank as $v_country) : ?>
                                    <option value="<?php echo $v_country->channel_name ?>" >
                                <?php endforeach; ?>
                            </datalist>
                    </div>
                    <div data-toggle="distpicker">
                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[2][45] ?><span class="required"> *</span></label>
                            <select class="form-control" name="usr_address_1" id="province7"></select>
                    </div>
                    <div class="">
                        <label class="control-label" >开户行所在市<span class="required"> *</span></label>
                                <select class="form-control" name="usr_address_2" id="city7"></select>
                    </div>
                    </div>
                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[2][47] ?><span class="required"> *</span></label>
                        <input type="text" name="usr_bank_branch_name" value="<?php
                        if (!empty($employee_info->usr_bank_branch_name)) {
                            echo $employee_info->usr_bank_branch_name;
                        }
                        ?>" class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>
                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[2][48] ?><span class="required"> *</span></label>
                        <input type="text" name="usr_bank_num" value="<?php
                        if (!empty($employee_info->usr_bank_num)) {
                            echo $employee_info->usr_bank_num;
                        }
                        ?>" class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>
                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[2][49] ?><span class="required"> *</span></label>
                        <input type="text" name="user_name" value="<?php
                        if (!empty($employee_info->user_name)) {
                            echo $employee_info->user_name;
                        }
                        ?>" class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>
                    <div class="">
                        <label class="control-label" ><?php echo $this->language->from_body()[17][7] ?> <span class="required"> *</span></label>
                        <input type="text" name="usr_law_name" value="<?php
                        if (!empty($employee_info->usr_law_name)) {
                            echo $employee_info->usr_law_name;
                        }
                        ?>"  class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>
                    <div class="">
                        <label class="control-label" ><?php echo '营业执照信用代码' ?> <span class="required"> </span></label>
                        <input type="text" name="maratial_status" value="<?php
                        if (!empty($employee_info->maratial_status)) {
                            echo $employee_info->maratial_status;
                        }
                        ?>"  class="form-control" <?php
                        if (!empty($employee_info->employee_id)) { ?> readonly <?php
                        }
                        ?>>
                    </div>


                </div>
            </div>
        </div> <!-- ************************ Contact Details End ******************************* -->




<!-- ************************** official status column End  ****************************-->
        <div class="col-sm-6 margin pull-right">
            <button id="btn_emp" type="submit" class="btn btn-primary btn-block"><?php echo $this->language->from_body()[1][12] ?></button>
        </div>
    </div>
</form>
<script>
	$(function(){
		<?php
		if(empty($employee_info->maratial_status) || $employee_info->maratial_status != 'married')
		{
		?>
			$("#spouse").hide();
		<?php
		}
		?>
		$("#maratial_status").change(function(){
			if($("#maratial_status").val() == 'married')
			{
				$("#spouse").show();
				$("#is_spouse").prop('selectedIndex', 0);
			}else{
				$("#spouse").show();
				$("#is_spouse").prop('selectedIndex', 2);
			}

		});
	});
</script>
