<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <title>九优通</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL STYLES -->
  <link href="<?php echo base_url(); ?>asset/home/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL SCRIPTS -->
  <!-- BEGIN THEME STYLES -->
  <link href='<?php echo base_url(); ?>asset/img/intro/favicon.png' rel='icon' type='image/x-icon' />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>asset/home/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css" />
  <link id="style_color" href="<?php echo base_url(); ?>asset/home/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" />
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
  <div class="content" style="width:720px">
    <!-- BEGIN LOGIN FORM -->    
       <?php if($info=='1'){  ?>

    <div class="note note-success" style="background-color: rgba(49, 52, 143, 0.39);">  
    
      <h3 class="block">邮件发送成功了!。</h3>
      <p>检查你的电子邮件，以确认您的电子邮件。请点击邮件中的验证链接 谢谢您。 </p>
      <div class="row">
        <a href="<?=base_url();?>intro" class="btn blue" style="float: right;"><i class="fa fa-reply"></i>登陆</a>
      </div>   
      <?php }elseif($info == '2'){?>
      <h3 class="block">邮件发送失败了!。</h3>
      <p>请联系服务中心 谢谢您。 </p>
      <div class="row">
        <a href="<?=base_url();?>intro" class="btn blue" style="float: right;"><i class="fa fa-angle-left"></i>退出</a>
      </div>  
      <?php }elseif($info=='3'){?>
      <h3 class="block">邮件发送成功了!。</h3>
      <p>检查你的电子邮件，以确认您的电子邮件。请点击邮件中的验证链接 谢谢您。 </p>
      <div class="row">
        <a href="<?=base_url();?>agentlogin" class="btn blue" style="float: right;"><i class="fa fa-angle-left"></i>退出</a>
      </div>  

      <?php }elseif($info=='4'){?>
      <h3 class="block">邮件发送失败了!。</h3>
      <p>请联系服务中心 谢谢您。 </p>
      <div class="row">
        <a href="<?=base_url();?>agentlogin" class="btn blue" style="float: right;"><i class="fa fa-angle-left"></i>退出</a>
      </div>  
      
      <?php }elseif($info=='5'){?>
      <h3 class="block">邮件验证成功了!。</h3>
      <p>你必须等待，直到你验证从服务中心您的帐户信息。
检查大约需要7天工作日。 谢谢您。 </p>
      <div class="row">
        <a href="<?=base_url();?>intro" class="btn blue" style="float: right;"><i class="fa fa-angle-left"></i>退出</a>
      </div>  
      <?php }else{ ?>
       <h3 class="block">邮件验证失败了!。</h3>
      <p>请联系服务中心 谢谢您。 </p>
      <div class="row">
        <a href="<?=base_url();?>agentlogin" class="btn blue" style="float: right;"><i class="fa fa-angle-left"></i>退出</a>
      </div>  
      <?php } ?>
      <!-- END REGISTRATION FORM -->
    </div>
    <!-- END LOGIN -->
    <!-- BEGIN COPYRIGHT -->
    <div class="copyright">
      Copyright 2009-2017 &copy;  九优通支付.
    </div>
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
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END JAVASCRIPTS -->
</body>
<script>
  jQuery(document).ready(function() {
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
</script>
<!-- END BODY -->








</html>