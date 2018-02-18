<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <title>九优付网站</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"
  />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
    type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
    type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"
  />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"
  />

  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL STYLES -->
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"
  />
  <link href="<?php echo base_url(); ?>asset/home/assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL SCRIPTS -->
  <!-- BEGIN THEME STYLES -->
  <link href='<?php echo base_url(); ?>asset/img/intro/favicon.png' rel='icon' type='image/x-icon' />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/css/components.css" id="style_components" rel="stylesheet"
    type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css" />
  <link id="style_color" href="<?php echo base_url(); ?>asset/home/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet"
    type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css" />
  <!-- END THEME STYLES -->
  <?php include_once 'asset/admin-ajax.php'; ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="login">
  <!-- BEGIN LOGO -->
  <div class="logo">
    <a href="intro">
	<img src="<?php echo base_url(); ?>asset/img/intro/logo.png" style="width: 18%;" alt=""/>
	</a>
  </div>
  <!-- END LOGO -->
  <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
  <div class="menu-toggler sidebar-toggler">
  </div>
  <!-- END SIDEBAR TOGGLER BUTTON -->
  <!-- BEGIN LOGIN -->
  <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <?php echo form_open('login','autocomplete="on" class="login-form" method="post"'); ?>
    <h3 class="form-title"><strong>会员登录</strong></h3>
    <div class="alert alert-danger display-hide">
      <button class="close" data-close="alert"></button>
      <span>请输入 ID 和 密码. </span>
    </div>
    <div class="form-group">
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label <?php echo base_url(); ?>asset/home/">商户ID</label>
      <div class="input-icon">
        <i class="fa fa-user"></i>
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="商户ID" name="user_name" onchange="check_email_login_id(this.value)"
        />
        <span id="id_error_msg"></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label <?php echo base_url(); ?>asset/home/">密码</label>
      <div class="input-icon">
        <i class="fa fa-lock"></i>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="密码" name="password" onchange="check_user_password(this.value)"
        />
        <span id="id_error_msg1"> </span>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-lg-7">
        <?php echo $captchaHtml; ?>
        <?php echo $captchaValidationMessage;?>
      </div>
      <div class="col-lg-5">
        <input type="text" class="form-control placeholder-no-fix" name="CaptchaCode" id="CaptchaCode" />
      </div>
    </div>
    <div class="form-actions">
      <label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> 记住我 </label>
      <button type="submit" id="form_submit" class="btn blue pull-right">	登  录 <i class="m-icon-swapright m-icon-white"></i></button>
    </div>
    <div class="forget-password">
      <h4> 忘记密码？</h4>
      <p>别担心, 点击 <a href="javascript:;" id="forget-password">
				这儿 </a> 设置密码.
      </p>
    </div>
    <div class="create-account">
      <p>
        还没有账户 ?&nbsp; <a href="javascript:;" id="register-btn">
				立即注册 </a>
      </p>
    </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="" method="post">
      <h3>忘记密码？</h3>
      <p>
        请入您的邮箱地址 </p>
      <div class="form-group">
        <div class="input-icon">
          <i class="fa fa-envelope"></i>
          <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="邮箱地址" name="email" />
        </div>
      </div>
      <div class="form-actions">
        <button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> 推出 </button>
        <button type="submit" class="btn blue pull-right">
			发送 <i class="fa fa-paper-plane" aria-hidden="true"></i>

			</button>
      </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <?php if($gsetting->site_is_open==1){ ?>
    <form class="register-form" action="register" method="post">
      <h3><strong>会员注册</strong></h3>
      <div class="row">
        <div class="form-group" style="float: right;">
          <div class="btn-group" data-toggle="buttons">
            <button class="btn btn-circle btn-sm green" onclick="select(this.value)" value="1">个人&nbsp;&nbsp;<span class="fa fa-user"> </span></button>
            <button class="btn btn-circle btn-sm green" onclick="select(this.value)" value="2">公司&nbsp;&nbsp;<span class="fa fa-briefcase"> </span></button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label ">邮箱</label>
        <div class="input-icon">
          <i class="fa fa-envelope"></i>
          <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="邮箱" name="usr_email" onchange="check_email(this.value)"
          />
          <span id="id_error_msg5"> </span>
        </div>
      </div>
      <!-- register from start-->
      <div class="row">
        <div class="form-group col-lg-6">
          <label class="control-label" id="company_name">法人</label>
          <div class="input-icon">
            <i class="fa fa-user"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="法人" name="username"/>
            <span id="id_error_msg3"> </span>
          </div>
        </div>
        <div class="form-group col-lg-6">
          <label class="control-label ">银行名</label>
          <div class="input-icon">
            <i class="fa fa-bank"></i>
            <input class="form-control placeholder-no-fix" list="browsers" autocomplete="off" placeholder="银行名" name="usr_bank_name"/>
            <datalist id="browsers">
              <?php foreach ($bank_name as $v_country) : ?>
              <option value="<?php echo $v_country->bank_name;?>">
                <?php endforeach; ?>
            </datalist>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-lg-4">
          <label class="control-label">商户组:</label>
          <select class="bs-select form-control input-small" name="group_id" data-style="green">
             <option value="" >选择商户组</option>
             <?php foreach ($employee as $v_category){ ?>
                  <option value="<?php    echo $v_category->id ?>">
                    <?php echo $data = $v_category->group_name; ?>
                    </option>
                              <?php }
                 ?>
            </select>
        </div>
        <div class="form-group col-lg-8">
          <label class="control-label">银行卡:</label>
          <div class="input-icon">
            <i class="fa fa-credit-card"></i>
            <input class="form-control placeholder-no-fix" type="text" placeholder="银行卡"  name="usr_bank_num" />
          </div>
        </div>
      </div>
      <input type="hidden" name="usr_status" value="1">
      <div class="form-group" id="company_add" style="display:none;">
        <label class="control-label">公司名称:</label>
        <div class="input-icon">
          <i class="fa fa-briefcase"></i>
          <input class="form-control placeholder-no-fix" type="text" placeholder="公司名称" name="usr_company_name" />
        </div>
      </div>
      <div class="row">
        <div class="form-group col-lg-6">
          <label class="control-label">密码</label>
          <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="密码"
              name="password" />
          </div>
        </div>
        <div class="form-group col-lg-6">
          <label class="control-label">确认密码 </label>
          <div class="controls">
            <div class="input-icon">
              <i class="fa fa-check"></i>
              <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="确认密码" name="rpassword" />
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label">手机号码:</label>
        <div class="input-icon">
          <i class="fa fa-phone-square"></i>
          <input class="form-control placeholder-no-fix" type="text" placeholder="手机号码" id="phone_num" name="phone_num" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-8">
          <label class="control-label">手机验证码:</label>
          <div class="input-icon">
            <i class="fa fa-check-circle"></i>
            <input class="form-control placeholder-no-fix" type="text" name="check_code" onchange="check_code_num(this.value)" />
            <span id="id_error_msg2"> </span>
          </div>
        </div>
        <div class="col-lg-3">
          <label class="control-label">&nbsp;</label>
          <input id="btnSendMobile" type="button" class="btn green-meadow" onclick="return sendMobileCode()" value="发送验证码">
        </div>
      </div>
      <div class="form-group">
        <div id="register_tnc_error"></div>
      </div>
      <div class="form-actions" style="margin-top: 10%;margin-bottom: 10%;">
        <!-- END LOGIN -->
        <button id="register-back-btn" type="button" class="btn green-meadow">
            <i class="m-icon-swapleft"></i> 回退 </button>
        <button id="register-submit-btn" type="submit" class="btn green-meadow pull-right">提交 <i class="fa fa-paper-plane"></i>
          </button>
      </div>
    </form>
    <!-- END REGISTRATION FORM -->
    <?php }else{
    ?>
    <div class="register-form">
      <div class="note note-success" style="background-color: rgba(49, 52, 143, 0.39);">
        <h3 class="block">通知!。</h3>
        <p>现在 您用不了注册的功能 请您联系我们的服务台 谢谢您。 </p>
        <div class="row">
          <a href="<?=base_url();?>login" class="btn blue" style="float: right;"><i class="fa fa-reply"></i>登陆</a>
        </div>
      </div>
    </div>
    <?php }?>
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div class="copyright">
    Copyright 2009-2017 &copy; 九优通支付 .
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
  <!-- BEGIN CORE PLUGINS -->
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/respond.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/excanvas.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
  <!-- END CORE PLUGINS -->
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>asset/home/assets/global/plugins/select2/select2.min.js"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN PAGE LEVEL SCRIPTS -->
  <script src="<?php echo base_url(); ?>asset/home/assets/global/scripts/metronic.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/home/assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>asset/employee/jquery.auto-complete.js" type="text/javascript"></script>

  <!-- END PAGE LEVEL SCRIPTS -->
  <script type="text/javascript">
    function select(val) {
      if (val == '2') {
        $("#company_add").css("display", "block");
        $('#usr_stauts').val('1');

      } else {
        $("#company_add").css("display", "none");
        $('#usr_stauts').val('0');
      }

    };

    $(document).ready(function () {
      $('.BDC_CaptchaImageDiv a').remove();
      $('#usr_bank_name').autoComplete({
        minChars: 0,
        source: function (term, suggest) {
          term = term.toLowerCase();
          var choices = [
            <?php foreach($bank_name as $val){
                      echo "'".$val->bank_name."', ";
                      }

                      ?>
          ];
          var suggestions = [];
          for (i = 0; i < choices.length; i++)
            if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
          suggest(suggestions);
        }
      });
    });

    function sendMobileCode() {
      var InterValObj; //timer变量，控制时间
      var count = 70; //间隔函数，1秒执行
      var curCount; //当前剩余秒数
      curCount = count;
      var phone_num = $('#phone_num').val();
      var base_url = "<?=base_url();?>";
      var url = base_url + "register/send_sms/" + phone_num;
      $.post(url, function (result) {
        var str2 = result.replace(/\n|\r/g, "");
        if (str2 != '0') {
          alert("发送失败");
        } else {
          var time = 70;

          function timeCountDown() {
            if (time == 0) {
              clearInterval(timer);
              $("#btnSendMobile").removeAttr("disabled"); //启用按钮
              $("#btnSendMobile").val("重新发送");
              return true;
            }
            $('#btnSendMobile').val(time + "秒后重试");
            time--;
            return false;
          }
          $("#btnSendMobile").attr("disabled", "true");
          timeCountDown();
          var timer = setInterval(timeCountDown, 1000);
          alert("已发送");
        }
      })
    }
  </script>
  <script>
    jQuery(document).ready(function () {
      Metronic.init(); // init metronic core components
      Layout.init(); // init current layout
      Login.init();
      Demo.init();
      // init background slide images
      $.backstretch([
        "<?php echo base_url(); ?>asset/img/intro/10.jpg",
        "<?php echo base_url(); ?>asset/img/intro/11.jpg",
        "<?php echo base_url(); ?>asset/img/intro/11.jpg",
        "<?php echo base_url(); ?>asset/img/intro/13.jpg",
        "<?php echo base_url(); ?>asset/img/intro/12.jpg"
      ], {
        fade: 1000,
        duration: 8000
      });
    });

    function check_email(val) {
      var base_url = '<?= base_url() ?>';
      var strURL = base_url + "register/check_email_id/";
      $.post(strURL, {
          proxyID: val
        })
        .done(function (data) {
          if (data) {
            $("#id_error_msg5").css("display", "block");
            $("#id_error_msg5").html(data);
            // $("#register-submit-btn").attr("disabled", "true");

          } else {
            $("#id_error_msg5").css("display", "none");
            document.getElementById('register-submit-btn').disabled = false;
          }
        });

    };

    function check_email_login_id(val) {
      var base_url = '<?= base_url() ?>';
      var strURL = base_url + "register/check_email_login_id";
      $.post(strURL, {
          proxyID: val
        })
        .done(function (data) {
          if (data) {
            $("#id_error_msg").css("display", "block");
            $("#id_error_msg").html(data);
            // $("#form_submit").attr("disabled", "true");
          } else {
            $("#id_error_msg").css("display", "none");
            $("#form_submit").removeAttr("disabled");
          }
        });

    };
    function check_code_num(val) {
      var base_url = '<?= base_url() ?>';
      var strURL = base_url + "register/check_code";
      $.post(strURL, {
          proxyID: val
        })
        .done(function (data) {
          if (data) {
            $("#id_error_msg2").css("display", "block");
            $("#id_error_msg2").html(data);
            $("#register-submit-btn").attr("disabled", "true");
          } else {
            $("#id_error_msg2").css("display", "none");
            $("#register-submit-btn").removeAttr("disabled");
          }
        });

    };

  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>
