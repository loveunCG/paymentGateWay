<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12" data-spy="scroll" data-offset="0">                            
            <div class="panel panel-info">            
                <!-- main content -->
                <div class="panel-heading">
                    <div class="row">
                        <div  class="col-lg-12 panel-title">
                            <strong>您的帐户</strong><span class="pull-right"><a onclick="history.go(-1);" class="view-all-front">推出</a></span>                        
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 well-user-profile">
                    <div class="row">                            
                        <div class="col-lg-2 col-sm-2">
                            <div class="fileinput-new thumbnail" style="width: 144px; height: 158px; margin-top: 14px; margin-left: 16px; background-color: #EBEBEB;">
                                <?php if ($employee_details->photo): ?>
                                    <img src="<?php echo base_url() . $employee_details->photo; ?>" style="width: 142px; height: 148px; border-radius: 3px;" >  
                                <?php else: ?>
                                    <img src="<?php echo base_url() ?>img/account.png" alt="Employee_Image">
                                <?php endif; ?>         
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1">
                            &nbsp;
                        </div>
                        <div class="col-lg-8 col-sm-8 ">
                            <div>
                                <div style="margin-left: 20px;">                                        
                                    <h3><?php echo "$employee_details->first_name " . "$employee_details->last_name"; ?></h3>
                                    <hr />
                                    <table class="table-hover">
                                        <tr>
                                            <td><strong>商户 ID</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo $employee_details->employment_id ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>商户组</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$employee_details->department_name"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>商户状态</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$employee_details->designations"; ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <td><strong>登录时间</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo date('d M Y', strtotime($employee_details->joining_date)); ?></td>
                                        </tr>                                            
                                    </table>                                                                           
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <!-- ************************ Personal Information Panel Start ************************-->
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">个人资料</h4>
                            </div>
                            <div class="panel-body form-horizontal">                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">生日: </label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo date('d M Y', strtotime($employee_details->date_of_birth)); ?></p>                                                                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">性别:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo "$employee_details->gender"; ?></p>                                                                                          
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> 手机号码:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo "$employee_details->maratial_status"; ?></p>                                                                                          
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">QQ id: </label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo "$employee_details->qq_id"; ?></p>                                                                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> : </label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->nationality)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->nationality"; ?></p>                                                                                          
                                        <?php endif; ?>
                                    </div>
                                </div>                                


                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->passport_number)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->passport_number"; ?></p>                                                                                          
                                        <?php endif; ?>                                
                                    </div>
                                </div>                                

                            </div>            
                        </div>            
                    </div> <!-- ************************ Personal Information Panel End ************************-->       
                    <div class="col-sm-6"><!-- ************************ Contact Details Start******************************* -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4 class="panel-title">联系信息</h4>
                                </div>
                            </div>
                            <div class="panel-body form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">邮件 : </label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->email)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->email"; ?></p>  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">电话 : </label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->phone)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->phone"; ?></p>  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">手机 : </label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->mobile)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->mobile"; ?></p>  
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">地址 : </label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->present_address)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->present_address"; ?></p>   
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">城市 : </label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->city)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->city"; ?></p> 
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">国家 : </label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->country_id)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->countryName"; ?></p> 
                                        <?php endif; ?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div> <!-- ************************ Contact Details End ******************************* -->

                    <div class="col-sm-6 hidden-print"><!-- ************************ Employee Documents Start ******************************* -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4 class="panel-title">其他资料</h4>
                                </div>
                            </div>
                            <div class="panel-body form-horizontal">
                                <!-- CV Upload -->                                                                  
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Resume : </label>
                                    <div class="col-sm-8"> 
                                        <?php if (!empty($employee_details->resume)): ?>       
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_details->resume; ?>" target="_blank" style="text-decoration: underline;">View Employee Resume</a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Offer Letter : </label>
                                    <div class="col-sm-8">  
                                        <?php if (!empty($employee_details->offer_letter)): ?> 
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_details->offer_letter; ?>" target="_blank" style="text-decoration: underline;">View Offer Latter</a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Joining Letter : </label>
                                    <div class="col-sm-8">
                                        <?php if (!empty($employee_details->joining_letter)): ?>  
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_details->joining_letter; ?>" target="_blank" style="text-decoration: underline;">View Joining Letter</a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Contract Paper : </label>
                                    <div class="col-sm-8"> 
                                        <?php if (!empty($employee_details->contract_paper)): ?>          
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_details->contract_paper; ?>" target="_blank" style="text-decoration: underline;">View Contract Paper</a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">ID Proff : </label>
                                    <div class="col-sm-8"> 
                                        <?php if (!empty($employee_details->id_proff)): ?>     
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_details->id_proff; ?>" target="_blank" style="text-decoration: underline;">View ID Proff</a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Other Document : </label>
                                    <div class="col-sm-8"> 
                                        <?php if (!empty($employee_details->other_document)): ?>      
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_details->other_document; ?>" target="_blank" style="text-decoration: underline;">View Other Document</a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- ************************ Employee Documents Start ******************************* -->

                    <!-- ************************      Bank Details Start******************************* -->
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4 class="panel-title">提现</h4>
                                </div>
                            </div>
                            <div class="panel-body form-horizontal">                                
                                <?php if (!empty($employee_details->bank_name)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" > Bank Name :</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_details->bank_name"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_details->branch_name)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" >Branch Name :</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_details->branch_name"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_details->account_name)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Account Name : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_details->account_name"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_details->account_number)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Account Number : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_details->account_number"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div><!-- ************************ Bank Details End ******************************* -->                            
                </div>                
            </div>
        </div>
    </div>
</div>



