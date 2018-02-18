<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

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
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/responsiveslides.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/menu.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/agent/login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/intro/default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/intro/component.css" />

   <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
     <script src="<?php echo base_url(); ?>asset/js/jquery-1.10.2.min.js"></script>    

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

                <div class="title"><span>代理注册</span></div>               
                    <div class="center">
                        <div class="profile">
                        </div>
                        <div style="margin: auto;width: 80%;">
                        <form action="<?php echo base_url();?>agentlogin/signup" autocomplete="on" class="form" method="post" onsubmit="return validation(this)">
                            <table style="text-align: right; color: #fff; font-weight: bold;">
                                <tr style="height: 50px;">
                                    <td style="width: 10%;">
                                        <label>账 号：</label>
                                    </td>
                                    <td style="width: 20%;">
                                        <input type="email"  placeholder="" name="mail_address" id="mail_address">
                                    </td>
                                    <td style="width: 14%;text-align: right;">
                                        <label>QQ号码：</label>
                                    </td>
                                    <td style="width: 20%;">
                                        <input type="text"  placeholder="" name="qq_num" id="qq_num">
                                    </td>
                                    <td style="width: 10%;text-align: right;">
                                        <label>收款人：</label>
                                    </td>
                                    <td style="width: 20%;">
                                        <input type="text"  placeholder="" name="contact_person" id="contact_person">
                                    </td>
                                </tr>
                                <tr  style="height: 50px;">
                                    <td>
                                        <label>密 码：</label>
                                    </td>
                                    <td>
                                        <input type="password"  placeholder="" name="proxy_password" id="proxy_password">
                                    </td>
                                    <td style="width: 10%;text-align: right;">
                                        <label>身份证号码：</label>
                                    </td>
                                    <td>
                                        <input type="text"  placeholder="" name="id_number" id="id_number">
                                    </td>
                                    <td style="width: 10%;text-align: right;">
                                        <label>开户账号：</label>
                                    </td>
                                    <td>
                                        <input type="text"  placeholder="" name="bank_card_number" id="bank_card_number">
                                    </td>
                                </tr>
                                <tr  style="height: 50px;">
                                    <td>
                                        <label >确认密码： </label>
                                    </td>
                                    <td>
                                        <input type="password"  placeholder="" name="confirm" id="confirm">
                                    </td>
                                    <td style="width: 10%;text-align: right;">
                                        <label>开户银行：</label>
                                    </td>
                                    <td>
                                        <select name="bank_name" style="width: 100%;height: 30px;">                                                                
                                            <?php
                                            
                                            foreach ($bank_name as $v_fields) :
                                                {
                                                    ?>
                                                    <option value="<?php echo $v_fields['bank_id'] ?>"><?php echo $v_fields['pay_type']; ?></option>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </select>                                         
                                    </td>
                                    <td style="width: 20%;text-align: right;">
                                        <label>银行地址：</label>
                                    </td>
                                    <td>
                                        <input type="text"  placeholder="" name="bank_of_the_province_where_the_bank" id="bank_of_the_province_where_the_bank">
                                    </td>
                                </tr>
                                <tr style="height: 50px;">
                                    <td>
                                        <label>手机号码：</label>
                                    </td>
                                    <td>
                                        <input type="text"  placeholder="" name="contact_number" id="contact_number">
                                    </td>
                                    <td style="width: 10%;text-align: right;">
                                        
                                    </td>
                                    <td>
                                        <?php echo $captchaHtml; ?>

                                    </td>
                                    <td style="width: 10%;text-align: right;">
                                        <label>验证码：</label>
                                    </td>
                                    <td>
                                        <input type="text"  placeholder="" name="CaptchaCode" id="CaptchaCode">
                                    </td>
                                </tr>
                                <tr  style="height: 50px;">
                                    <td>
                                        
                                    </td>
                                    <td>
                                    </td>
                                    <td style="width: 10%;text-align: right;">
                                        
                                    </td>
                                    <td>
                                        <input type="submit" style="margin-top: 8px;" value="登  录">
                                    </td>
                                    <td style="width: 10%;text-align: right;">
                                       
                                    </td>
                                    <td>
                                    </td>
                                </tr>                                                                                                

                            </table>
                        </form>
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
 
                var usr_email = $('#mail_address').val();
                var qq_num = $('#qq_num').val();
                var contact_person = $('#contact_person').val();
                var proxy_password = $('#proxy_password').val();
                var id_number = $('#id_number').val();
                var bank_card_number = $('#bank_card_number').val();
                var confirm = $('#confirm').val();
                var bank_of_the_province_where_the_bank = $('#bank_of_the_province_where_the_bank').val();
                var contact_number = $('#contact_number').val();
                var CaptchaCode = $('#CaptchaCode').val();

                if (usr_email=='') {
                    document.getElementById("mail_address").focus();
                    return false;
                }
                if (qq_num == '') {
                    document.getElementById("qq_num").focus();
                    return false;
                }
                if (contact_person == '') {
                    document.getElementById("contact_person").focus();
                    return false;
                }
                if (proxy_password == '') {
                    document.getElementById("proxy_password").focus();
                    return false;
                }
                if (id_number == '') {
                    document.getElementById("id_number").focus();
                    return false;
                }
                if (bank_card_number == '') {
                    document.getElementById("bank_card_number").focus();
                    return false;
                }
                if (confirm == '') {
                    document.getElementById("confirm").focus();
                    return false;
                }
                if (confirm != proxy_password) {
                    document.getElementById("confirm").focus();
                    return false;
                }
                if (bank_of_the_province_where_the_bank == '') {
                    document.getElementById("bank_of_the_province_where_the_bank").focus();
                    return false;
                }
                if (contact_number == '') {
                    document.getElementById("contact_number").focus();
                    return false;
                }  
                if (CaptchaCode == '') {
                    document.getElementById("CaptchaCode").focus();
                    return false;
                }                                
                                              


        }        
    </script>
</body>

</html>
