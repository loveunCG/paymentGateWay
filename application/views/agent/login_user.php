<!DOCTYPE html>

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>九优付网站</title>
    <meta name="description" content="">
    <meta name="author" content="">  
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/zerogrid.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/agent/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/agent/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/agent/responsiveslides.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/menu.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/agent/login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/agent/default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/agent/component.css" />
    
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/agent/bdc-layout-stylesheet.css" />
     <script src="<?php echo base_url(); ?>asset/js/jquery-1.10.2.min.js"></script>    
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/agent/style.css">
    <link href='<?php echo base_url(); ?>asset/img/intro/favicon.png' rel='icon' type='image/x-icon' />
    <script src="<?php echo base_url(); ?>asset/js/intro/responsiveslides.js"></script>
    <script src="http://rickharrison.github.io/validate.js/validate.js"></script>
     <script src="<?php echo base_url(); ?>asset/js/agent/custom.js"></script>


</head>

<body>

    <header>
        <div class="wrap-header zerogrid">
            <div id="logo"><a href="intro"><img src="<?php echo base_url(); ?>asset/img/intro/logo.png"/></a></div>
            <div class="social">
                <ul>
                    <li><a href="<?php echo base_url();?>agentlogin"><img src="<?php echo base_url(); ?>asset/img/intro/login.png" style="max-height: 50px;"/></a></li>
                    <li><a href="<?php echo base_url();?>agentlogin/signup"><img src="<?php echo base_url(); ?>asset/img/intro/register.png" style="max-height: 50px;"/></a></li>
                </ul>
            </div>

        </div>
    </header>


    <section id="content">
        <div class="wrap-content zerogrid">
            <div class="row block05">

                <div class="title"><span>代理登录</span></div>
                
                    <div class="center">
                        <div class="profile">
                        </div>


                        <div style="width: 100%;height: auto;">

                        <div style="float: left;width: 25%; text-align: right;margin-left: 25%;">
                           <form action="<?php echo base_url();?>agentlogin" autocomplete="on" class="form" method="post" onsubmit="return validation(this)">
                            <label>账 号：</label>
                            <input type="text" style="width: 50%; height: 30px;" placeholder="" name="user_name" id="user_name"><br><br>
                            <label>密 码：</label>
                            <input type="password" style="width: 50%; height: 30px;" placeholder="" name="password" id="password">
                           <br><?php echo $captchaHtml; ?>
                            <label>验证码：</label>
                            <input type="text" style="width: 50%; height: 30px;margin-top: 4px;" name="CaptchaCode" id="CaptchaCode"><br>
                            <input type="submit" style="margin-top: 8px;" value="登  录">
                        </form>
                        </div>
                        <div style="float: left;width: 25%; text-align: left;">

                               <form action="<?php echo base_url();?>agentlogin/signup" autocomplete="on" class="form" method="post">                                                                           


                                    <h3 style="margin-left: 30%;">还没有账号？</h3>
                                    <input type="submit" style="margin-top: 8px;" value="免费注册">
                                </form>
                        <?php include_once 'asset/admin-ajax.php'; ?>
                        <?php echo message_box('success'); ?>
                        <?php echo message_box('error'); ?>
                        </div>

                        </div>
                    </div>
            </div>
        </div>
    </section>

    <!-- <script src="<?php echo base_url(); ?>asset/js/intro/index.js"></script> -->

    <footer>



        <div class="copyright">
            <div style="float: left;">
                <a key="5834f79cefbfb06b9eb5da35" logo_size="83x30" logo_type="realname" href="http://v.pinpaibao.com.cn/authenticate/cert/?site=9vpay.com&amp;at=realname"
                    target="_blank">
                    <script src="//static.anquan.org/static/outer/js/aq_auth.js"></script><b id="aqLogoJFMHB" style="display: none;"></b></a>
                <a id="_pingansec_bottomimagesmall_shiming" href="http://si.trustutn.org/info?sn=377161209026042948560&amp;certType=1"><img src="http://v.trustutn.org/images/cert/bottom_small_img.png"></a>
            </div>
            <p><strong>Copyright 2009-2017 九优通商务开放平台 www.9vpay.com ,Inc. All rights reserved. 版权所有 远利达信息科技有限公司</strong></a>
            </p>
        </div>
    </footer>
    <script type="text/javascript">
     $(document).ready(function () {
        $('.BDC_CaptchaImageDiv a').remove();
     });
        
        function validation() {
 
                var usr_email = $('#user_name').val();
                var password = $('#password').val();
                var CaptchaCode = $('#CaptchaCode').val();
                if (usr_email==null) {
                    document.getElementById("user_name").focus();
                    return false;
                }
                if (password==null) {
                    document.getElementById("password").focus();
                    return false;
                }
                if(CaptchaCode==null){
                    document.getElementById("CaptchaCode").focus();
                    return false;
                }
        }

</script>
</body>

</html>
