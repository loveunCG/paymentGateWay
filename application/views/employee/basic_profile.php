<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 col-xs-12">
            <form id="form" action="<?=base_url();?>employee/dashboard/save_basicpro" method="post">
                <div class="panel panel-info" style="margin-top:5%;">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><strong>基本资料</strong></strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-offset-2 col-xs-10 row">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td><strong>商户 ID</strong></td>
                                        <td>
                                            <?php echo $employee_details->employee_id ?>
                                        </td>
                                        <td>
                                            <td>
                                                <td>
                                                    <td>
                                                        <td>
                                                            <td>
                                                                <td>
                                                                    <td>
                                                                        <td>
                                                                            <td>
                                                                                <td>
                                                                                    <td>
                                                                                        <td>
                                                                                            <td>
                                                                                                <td>
                                                                                                    <td>

                                    </tr>
                                    <tr>
                                        <td> 手机号码:</td>
                                        <td>
                                            <?php
                                            $email = $employee_details->usr_mobile;
                                            $pre_frex = substr($email, 0, 3);    
                                            $end_frex = substr($email, -5, 5);                                       
                                            echo $pre_frex. str_repeat('*',5).$end_frex;
                                        ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>邮件地址</strong></td>
                                        <td>
                                            <?php 
                                            $email = $employee_details->usr_email;
                                            $domain = strstr($email, '@');
                                            $pre_frex = substr($email, 0, 3);                                            
                                            echo $pre_frex. str_repeat('*',5).$domain;
                                            if($employee_details->usr_email_status=='0'){ echo "&nbsp;&nbsp;&nbsp; 已认证";}else{
                                            echo "&nbsp;&nbsp;&nbsp; 还没认证";}                                            
                                             ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>腾讯QQ: </td>
                                        <td>
                                            <?php echo "$employee_details->usr_contact_qq_num"; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>公司名称: </td>
                                        <td>
                                            <?php if (empty($employee_details->usr_company_name)){ ?>
                                            <?php echo '<input type="text" name="company_name" class="form-control" style="width: 50%;">'; }else{
                                        echo '<input type="text" name="company_name" class="form-control" style="width: 50%;" value = "'.$employee_details->usr_company_name.'" >';}
                                    ?>
                                        </td>
                                    </tr>
                                    <?php ?>
                                    <tr>
                                        <td>网站地址: </td>
                                        <td>
                                            <?php if (empty($employee_details->usr_site_address)){ ?>
                                            <?php echo '<input type="url" name="usr_site_address" class="form-control" style="width: 50%;">'; }else{
                                        echo '<input type="url" name="usr_site_address" class="form-control" style="width: 50%;" value = "'.$employee_details->usr_site_address.'">';}
                                    ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <td>
                                                <td>
                                                    <td>

                                                    </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary form-control col-sm-12" style="color: antiquewhite;" value="">提交</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </form>
        </div>
    </div>
</div>