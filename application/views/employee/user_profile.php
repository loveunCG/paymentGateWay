<div class="container-fluid">
    <div class="row" style="margin-top:5%;">
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
                                            <td><strong>邮件地址</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php 
                                            $email = $employee_details->usr_email;
                                            $domain = strstr($email, '@');
                                            $pre_frex = substr($email, 0, 3);                                            
                                            echo $pre_frex. str_repeat('*',5).$domain;
                                            if($employee_details->usr_email_status==0){ echo "&nbsp;&nbsp;&nbsp; 已认证";}else{
                                            echo "&nbsp;&nbsp;&nbsp; 还没认证";}                                            
                                             ?></td>
                                        </tr>
                                    </table>                                  
                                    </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <!-- ************************ Personal Information Panel Start ************************-->
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">个人资料</h4>
                            </div>
                            <div class="panel-body form-horizontal">                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">生日: </label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static"><?php echo date('d M Y', strtotime($employee_details->date_of_birth)); ?></p>                                                                                          
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> 手机号码:</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static"><?php
                                            $email = $employee_details->usr_mobile;
                                            $pre_frex = substr($email, 0, 3);    
                                            $end_frex = substr($email, -5, 5);                                       
                                            echo $pre_frex. str_repeat('*',5).$end_frex;
                                        ?></p>                                                                                          
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">腾讯QQ: </label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static"><?php echo "$employee_details->usr_contact_qq_num"; ?></p>                                                                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司名称: </label>
                                    <div class="col-sm-4">
                                        <?php if (!empty($employee_details->usr_company_name)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->usr_company_name"; ?></p>                                                                                          
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <?php if (!empty($employee_details->passport_number)): ?>
                                            <p class="form-control-static"><?php echo "$employee_details->passport_number"; ?></p>                                                                                          
                                        <?php endif; ?>                                
                                    </div>
                                </div>                                

                            </div>            
                        </div>            
                    </div> <!-- ************************ Personal Information Panel End ************************-->       
                </div>                
            </div>
        </div>
    </div>
    </section>
</div>



