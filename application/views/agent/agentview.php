<div class="wrapper">

    <section class="content-header">
        <ol class="breadcrumb">
            <li><i class="fa fa-user" aria-hidden="true"></i> 我的账户</li>

        </ol>
    </section>
    <div class="col-md-12">
        <div class="main_content">
            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h2 class="panel-title "><i class="fa fa-user"></i> <strong>账户信息</strong></h2>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="primary-link">邮箱地址：</span>
                                            </td>
                                            <td>
                                                <?php 
													$email = $agent_details->mail_address;
													$domain = strstr($email, '@');
													$pre_frex = substr($email, 0, 3);                                            
													echo $pre_frex. str_repeat('*',5).$domain;													
												?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="primary-link">代理ID：</span>
                                            </td>
                                            <td>
                                                <?php echo "$agent_details->proxy_id"; ?>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="primary-link">联系电话:</span>
                                            </td>
                                            <td>
                                               <?php 
													$email = $agent_details->contact_number;
													$domain = strstr($email, '@');
													$pre_frex = substr($email, 0, 3);                                            
													echo $pre_frex. str_repeat('*',5).$domain;
												 
												?>
                                               
												
                                            </td>
                                        </tr>
                                       

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
               
                <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h2 class="panel-title "><i class="fa fa-university"></i> <strong>&nbsp;银行信息</strong></h2>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="primary-link">开户银行:</span>
                                            </td>
                                            <td>
                                                                                               <?php echo "$agent_details->open_an_account_bank "; ?>

                                               
                                                
                                            </td>
                                        </tr>                                    
                                        <tr>
                                            <td>
                                                <span class="primary-link">开户姓名</span>
                                            </td>
                                            <td>
                                                <?php echo "$agent_details->account_name "; ?>
                                                 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="primary-link">银行帐号</span>
                                            </td>
                                            <td>
                                                
                                                <?php 
                                                     $email = $agent_details->bank_card_number;
												 	$domain = strstr($email, '@');
													$pre_frex = substr($email, 0, 3);                                            
													echo $pre_frex. str_repeat('*',5).$domain;
												?>
                                            </td>

                                        </tr> 
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.col-md-12 -->
</div></div>