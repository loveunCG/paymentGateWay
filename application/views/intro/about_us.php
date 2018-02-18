    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/style.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/responsiveslides.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/menu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/intro/default.css" />
    <link href="<?php echo base_url(); ?>asset/css/intro/style1.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>asset/css/intro/htmleaf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/intro/normalize.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/intro/lunbo.css" rel="stylesheet">
<style>
    a:hover {color: #1522ff;}
</style>

<section id="content">
	<div class="wrap-content zerogrid">
		<div class="row block05">
            <?php
            $category_str = array("公司简介", "公司优势", "诚聘英才");
            echo "<span style='color: red;'> &nbsp;&nbsp;&nbsp;当前位置：首页 > 关于我们 > ".$category_str[$category-1]."</span><br>";
            ?>

            <div class="col-1-4">
                <div class="wrap-col">
                    <div class="box">
                        <div class="heading"><h2><strong>&nbsp;商户接入</strong></h2></div>
                        <div class="content">
                            <div class="list">
                                <ul>
                                    <li><a href="about_1"><strong>公司简介</strong></a></li>
                                    <li><a href="about_2"><strong>公司优势</strong></a></li>
                                    <li><a href="about_3"><strong>诚聘英才</strong></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-3-4">
                <?php
                if ($categorys == 1){
                ?>
				<div class="wrap-col">
					<article>
                        <center><h2>九优通商务简介</h2></center>

					</article>
					<article>
						<img src="<?php echo base_url(); ?>asset/img/intro/blog3.jpg"/>
                        <p style="font-size: 16px; line-height: 30px; padding: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 九优通商务，由福州远利信息科技有限公司创立，公司从04年专注于开发支付系统，是国内领先的支付接口平台。主要是回收各种数字卡（手机充值卡、游戏充值卡）、微信支付、支付宝、财付通等，致力于游戏运营商、电子商务运营商延伸出多种安全、便捷、稳定的充值在线收费方式。<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 随着中国经济的快速发展和网络应用的不断成熟，电子商务产业已进入高速发展阶段。在电子商务领域，九优通商务凭借创新而务实的风格、领先的技术、敏锐的市场预见力，将一直与各大商家共享API接口技术打造自身的品牌，不断根据客户的需求推出创新产品，为促进电子商务产业的持续发展做出不懈努力。九优通商务也在业界树立了良好的口碑，先后获得包括网民最信赖的支付品牌、最佳电子支付平台、互联网支付创新奖、最具投资价值企业等奖项，中国互联网新锐企业，互联网在线支付消费者权益保护创新企业奖等多项奖项。<br>
                            &nbsp;&nbsp;&nbsp;&nbsp; “安全、稳定、高效、便捷”是九优通商务长期坚持的核心战略，截至目前已与中国移动、中国电信、中国联通、阿里巴巴、腾讯、易宝支付、宝付、快钱、环迅、骏网、盛大、等企业建立了战略合作伙伴关系并赢得伙伴的高度认同。
                        </p>
					</article>
				</div>
                <?php
                }
                ?>

                <?php
                if ($categorys == 2){
                ?>
                <div class="wrap-col">
									<div class="about_right" style="">

											<div class="htmleaf-container" style="position:relative;">

												<div class="container">

														<div class="hub-slider">

																<div class="hub-slider-slides">
																		<ul>
																				<li data-key="0" style="z-index: 4; top: 0px; transform: scale(1); opacity: 1; transition: 2s; transform-style: flat;"></li>
																				<li data-key="1" style="z-index: 3; top: -28px; transform: scale(0.95); opacity: 0.8; transition: 2s; transform-style: flat;"></li>
																				<li data-key="2" style="z-index: 2; top: -56px; transform: scale(0.9); opacity: 0.6; transition: 2s; transform-style: flat;"></li>
																				<li data-key="3" style="z-index: 0; top: -84px; transform: scale(0.85); opacity: 0.4; transition: 2s; transform-style: flat;"></li>
																		</ul>
																</div>

																<div class="hub-slider-controls">
																		<button class="hub-slider-arrow hub-slider-arrow_next">↑</button>
																		<button class="hub-slider-arrow hub-slider-arrow_prev">↓</button>
																</div>

														</div>

												</div>

										</div>
									</div>
                </div>
                <?php
                }
                ?>

                <?php
                if ($categorys == 3){
                ?>
                <div class="wrap-col">
                    <article>
                        <img src="<?php echo base_url(); ?>asset/img/intro/blog2.jpg"/>
                    </article>
										<div class="col-1-2">
											<div class="wrap-col" style="border: 1px solid rgb(0, 159, 227); padding:20px;">
												<p style="font-size: 16px; line-height: 30px;">
													<span>诚聘NET工程师</span>
					                <dl>
					                    <dd>岗位职责</dd>
					                    <dt>1.开发电子商务平台网站，负责WEB代码开发工作；</dt>
					                    <dt>2.在.NET FRAMEWORK 3.5/4.0下编写规范的，高质量，高性能的C#代码；</dt>
					                    <dt>3.配合测试人员进行测试，及时修复代码BUG；</dt>
					                    <dt>4.按时完成上级领导交办的各项任务；</dt>
					                </dl>
					                <dl>
					                    <dd>任职资格</dd>
					                    <dt>1.掌握Asp.Net（C#）开发技术，熟悉vs开发环境；</dt>
					                    <dt>2.掌握SQL数据库开发技术，熟悉使用ADO.Net进行数据库操作；</dt>
					                    <dt>3.了解Web开发技术（AJax、HTML、JavaScript、CSS等）；</dt>
					                    <dt>4.能快速理解业务模式，有良好的敬业精神学习能力，沟通能力和团队协作能力。</dt>
					                </dl>
												</p>
											</div>
									</div>
									<div class="col-1-2">
										<div class="wrap-col" style="border: 1px solid rgb(0, 159, 227);padding:20px;">
											<p style="font-size: 16px; line-height: 30px;">
												<span>诚聘网络客服</span>
				                <dl>
				                    <dd>岗位职责</dd>
				                    <dt>1.利用网络进行客户问题解答；</dt>
				                    <dt>2.接听客户咨询电话解决客户相关问题。</dt>
				                </dl>
				                <dl>
				                    <dd>任职资格</dd>
				                    <dt>1.专科及以上学历，市场营销等相关专业；</dt>
				                    <dt>2.熟悉互联网络，熟练使用网络交流工具和各种办公软件；</dt>
				                    <dt>3.有较强的沟通能力，和温和的态度。<br><br><br><br><br><br><br></dt>
				                </dl>
											</p>
										</div>
									</div>


                </div>
                <?php
                }
                ?>
			</div>

		</div>
	</div>
</section>
<script src="<?php echo base_url(); ?>asset/js/intro/hubslider.js"></script>
<script type="text/javascript">
    $(function () {
        $('.hub-slider-slides ul').hubSlider({
            selector: $('li'),
            button: {
                next: $('.hub-slider-arrow_next'),
                prev: $('.hub-slider-arrow_prev')
            },
            transition: '2s',
            startOffset: 28,
            auto: true,
            time: 4.5 // secondly
        });
    })
</script>




<!--  Custom Scripts -->
<script src="<?php echo base_url(); ?>asset/home/assets/js/custom.js"></script>
<div id="footer-sec">
    <div id="footser-end">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-offset-5 col-lg-6">
                       Copyright 2009-2017 九优付网站开放平台 <br> www.168xypay.com ,版权所有 九优通<br> <i class="fa fa-qq" aria-hidden="true">QQ：800186515</i>
                </div>
            </div>

        </div>
    </div>
</div>