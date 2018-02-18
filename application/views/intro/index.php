<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>九优通网站首页</title>
	<meta name="description" content="YinBao Bank Card">
	<meta name="author" content="www.yinbaocardbank.com">
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/zerogrid.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/responsiveslides.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/menu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/intro/default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/intro/component.css" />

	<link href="<?php echo base_url(); ?>asset/css/intro/style1.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>asset/css/intro/htmleaf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/intro/normalize.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>asset/css/intro/lunbo.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/js/intro/modernizr.custom.js"></script>

	<link href='<?php echo base_url(); ?>asset/img/intro/favicon.png' rel='icon' type='image/x-icon'/>
    <script src="<?php echo base_url(); ?>asset/js/intro/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/intro/responsiveslides.js"></script>
	<script>
		$(function () {
		  $("#slider").responsiveSlides({
			auto: true,
			pager: false,
			nav: true,
			speed: 500,
			maxwidth: 1713,
			namespace: "centered-btns"
		  });
		});
	</script>
</head>
<body>

<header>
	<div class="wrap-header zerogrid">
		<div id="logo"><a href="intro"><img src="<?php echo base_url(); ?>asset/img/intro/logo.png"/></a></div>
		<div class="social">
			<ul>
				<li><a href="flogin"><img src="<?php echo base_url(); ?>asset/img/intro/login.png" style="max-height: 50px;"/></a></li>
				<li><a href="signup"><img src="<?php echo base_url(); ?>asset/img/intro/register.png" style="max-height: 50px;"/></a></li>
			</ul>
		</div>
		<nav>
			<div class="wrap-nav">
				<div class="menu">
					<ul class="menu">
						<li class="current"><a href="intro">网站首页</a></li>
						<li><a href="#">产品大全</a>
                            <ul class="submenu">
                                <li><a href="catalog_1">微信扫码</a></li>
                                <li><a href="catalog_2">支付宝</a></li>
                                <li><a href="catalog_3">在线收款</a></li>
                            </ul>
                        </li>
						<li><a href="#">商户接入</a>
                            <ul class="submenu">
                                <li><a href="business_1">结算灵活</a></li>
                                <li><a href="business_2">开通快捷</a></li>
                                <li><a href="business_3">贴心服务</a></li>
                                <li><a href="business_4">自助服务</a></li>
                                <li><a href="business_5">费率优惠</a></li>
                            </ul>
                        </li>
						<li><a href="#">关于我们</a>
                            <ul class="submenu">
                                <li><a href="about_1">公司简介</a></li>
                                <li><a href="about_2">公司优势</a></li>
                                <li><a href="about_3">诚聘英才</a></li>
                            </ul>
                        </li>
						<li><a href="contact_1">联系我们</a></li>
					</ul>
				</div>

				<div class="minimenu"><div>MENU</div>
					<select onchange="location=this.value">
						<option></option>
						<option value="index.php">Home</option>
						<option value="blog.php">Blog</option>
						<option value="gallery.php">Gallery</option>
						<option value="single.php">About</option>
						<option value="contact.php">Contact</option>
					</select>
				</div>
			</div>
		</nav>
	</div>
</header>

<div class="featured">
	<div class="wrap-featured zerogrid">
		<div class="slider">
			<div class="rslides_container">
				<ul class="rslides" id="slider">
					<li><img src="<?php echo base_url(); ?>asset/img/intro/slide1.jpg"/></li>
					<li><img src="<?php echo base_url(); ?>asset/img/intro/slide2.jpg"/></li>
					<li><img src="<?php echo base_url(); ?>asset/img/intro/slide3.jpg"/></li>
                    <li><img src="<?php echo base_url(); ?>asset/img/intro/slide4.jpg"/></li>
                    <li><img src="<?php echo base_url(); ?>asset/img/intro/slide5.jpg"/></li>
				</ul>
			</div>
		</div>
	</div>
</div>


<section id="content">
	<div class="wrap-content zerogrid">

		<div class="row block01"><h2>欢迎，欢迎，非常感谢您访问<a href="/" target="_blank">我们的网站</a></h2>
		<p>人们一看是一类一类的，招聘是一类，婚介是一类。分类广告跟传统的工商广告有着本质的不同，如果说工商广告说企业我想卖什么，他基本上不管消费者我想要什么。公益广告是政府说你们要干什么。分类广告把商家的我想卖什么和消费者我需要什么有机结合起来的一个桥梁。他微观、具体、直接，这是分类广告的特点，与人的声音、生活之间所需要的产品与服务密切相关。</p></div>

		<div class=divider></div>

		<div class="row block02">
			<div class="col-1-4">
				<div class="wrap-col">
					<a href="#"><h2><span><img src="<?php echo base_url(); ?>asset/img/intro/money-wallet-icon.png" style="width:64px;"/></span>快速消耗 安全省心</h2></a>
					<p>30秒极速消耗 在线自动完成，节约人工成本. 50秒极速消耗 在线自动完成，节约人工成本</p>
				</div>
			</div>
			<div class="col-1-4">
				<div class="wrap-col">
					<a href="#"><h2><span><img src="<?php echo base_url(); ?>asset/img/intro/Earth-Security-icon.png" style="width:64px;"/></span>数据加密安全速达</h2></a>
					<p>7x24小时安心使用 360°保护您的使用安全. 7x24小时安心使用 360°保护您的使用安全</p>
				</div>
			</div>
			<div class="col-1-4">
				<div class="wrap-col">
					<a href="#"><h2><span><img src="<?php echo base_url(); ?>asset/img/intro/Time-Machine-icon.png" style="width:64px;"/></span>7*24小时贴心客服</h2></a>
					<p>专业的技术支持贴心的解决问题. 单卡、多卡自动识别实时的数据分析</p>
				</div>
			</div>
			<div class="col-1-4">
				<div class="wrap-col">
					<a href="#"><h2><span><img src="<?php echo base_url(); ?>asset/img/intro/Search-icon.png" style="width:64px;"/></span>自动，快捷匹配功能</h2></a>
					<p>单卡、多卡自动识别实时的数据分析. 单卡、多卡自动识别实时的数据分析</p>
				</div>
			</div>

		</div>

		<div class="row block03">
			<div class="title"><span><strong>微信支付服务商</strong></span></div>
            <ul class="grid cs-style-3">
                <li>
                    <figure>
                        <img src="<?php echo base_url(); ?>asset/img/intro/img1.png" alt="img01">
                        <figcaption>
                            <h3>公众号支付</h3>
                            <span>在APP中，调起微信进行APP支付</span>
                            <a href="contact_1"><strong>我要接入</strong></a>
                        </figcaption>
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="<?php echo base_url(); ?>asset/img/intro/img2.png" alt="img03">
                        <figcaption>
                            <h3>APP支付</h3>
                            <span>在微信内的商家页面上完成公众号支付</span>
                            <a href="contact_1"><strong>我要接入</strong></a>
                        </figcaption>
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="<?php echo base_url(); ?>asset/img/intro/img3.png" alt="img04">
                        <figcaption>
                            <h3>扫码支付</h3>
                            <span>扫描二维码(包含PC网站)进行扫码支付</span>
                            <a href="contact_1"><strong>我要接入</strong></a>
                        </figcaption>
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="<?php echo base_url(); ?>asset/img/intro/img4.png" alt="img02">
                        <figcaption>
                            <h3>刷卡支付</h3>
                            <span>用户展示条码，商户扫描完成刷卡支付</span>
                            <a href="contact_1"><strong>我要接入</strong></a>
                        </figcaption>
                    </figure>
                </li>
            </ul>
		</div>

		<div class="row block03">
			<div class="title"><span><strong>支付宝服务商</strong></span></div>
            <ul class="grid cs-style-4">
                <li>
                    <figure>
                        <img src="<?php echo base_url(); ?>asset/img/intro/img5.png" alt="img01">
                        <figcaption>
                            <h3>公众号支付</h3>
                            <span>在APP中，调起微信进行APP支付</span>
                            <a href="contact_1"><strong>我要接入</strong></a>
                        </figcaption>
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="<?php echo base_url(); ?>asset/img/intro/img6.png" alt="img03">
                        <figcaption>
                            <h3>APP支付</h3>
                            <span>在微信内的商家页面上完成公众号支付</span>
                            <a href="contact_1"><strong>我要接入</strong></a>
                        </figcaption>
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="<?php echo base_url(); ?>asset/img/intro/img7.png" alt="img04">
                        <figcaption>
                            <h3>扫码支付</h3>
                            <span>扫描二维码(包含PC网站)进行扫码支付</span>
                            <a href="contact_1"><strong>我要接入</strong></a>
                        </figcaption>
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="<?php echo base_url(); ?>asset/img/intro/img8.png" alt="img02">
                        <figcaption>
                            <h3>刷卡支付</h3>
                            <span>用户展示条码，商户扫描完成刷卡支付</span>
                            <a href="contact_1"><strong>我要接入</strong></a>
                        </figcaption>
                    </figure>
                </li>
            </ul>
		</div>

	</div>
</section>

<footer>
	<div class="wrap-footer zerogrid">
			<div class="col-1-1">
				<div class="wrap-col">
					<div class="box">
						<div class="heading"><h2>合作伙伴</h2></div>
						<div class="content">
							<div class="tag" style="width: 55%; margin-left: auto; margin-right: auto; margin-top: 6px; margin-bottom: -30px;">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/my_1.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/my_2.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl1.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl2.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl3.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl4.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl5.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl6.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl7.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl8.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl9.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/zl10.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_1.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_2.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_3.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_4.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_5.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_6.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_7.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_8.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_9.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_10.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_11.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_15.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_16.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_18.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_19.png" alt="">
                                <img src="<?php echo base_url(); ?>asset/img/intro/partner_img/card_20.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="copyright">
        <div style="float: left;">
            <a key="5834f79cefbfb06b9eb5da35" logo_size="83x30" logo_type="realname" href="http://v.pinpaibao.com.cn/authenticate/cert/?site=9vpay.com&amp;at=realname" target="_blank"><script src="//static.anquan.org/static/outer/js/aq_auth.js"></script><b id="aqLogoJFMHB" style="display: none;"></b></a>
            <a id="_pingansec_bottomimagesmall_shiming" href="http://si.trustutn.org/info?sn=377161209026042948560&amp;certType=1"><img src="http://v.trustutn.org/images/cert/bottom_small_img.png"></a>
        </div>
        <p><strong>Copyright 2009-2017 九优通商务开放平台 www.9vpay.com ,Inc. All rights reserved. 版权所有 远利达信息科技有限公司</strong></a></p>
	</div>
</footer>
<script src="<?php echo base_url(); ?>asset/js/intro/toucheffects.js"></script>
</body></html>
