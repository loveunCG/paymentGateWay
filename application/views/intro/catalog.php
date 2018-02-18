

    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/zerogrid.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/responsiveslides.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/intro/menu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/intro/default.css" />

<section id="content">
	<div class="wrap-content zerogrid">
		<div class="row block05">
            <?php
            $category_str = array("微信扫码", "支付宝", "在线收款");
            echo "<span style='color: red;'> &nbsp;&nbsp;&nbsp;当前位置：首页 > 产品大全 > ".$category_str[$category-1]."</span><br>";
            ?>
			<div class="title"><span>产品大全</span></div>
            <div class="col-1-4">
                <div class="wrap-col">
                    <div class="box">
                        <div class="heading"><h2><strong>&nbsp;产品大全</strong></h2></div>
                        <div class="content">
                            <div class="list">
                                <ul>
                                    <li><a href="catalog_1"><strong>微信扫码</strong></a></li>
                                    <li><a href="catalog_2"><strong>支付宝</strong></a></li>
                                    <li><a href="catalog_3"><strong>在线收款</strong></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-3-4">
                <?php
                if ($category == 1){
                ?>
				<div class="wrap-col">
					<article>
						<img src="<?php echo base_url(); ?>asset/img/intro/blog1.jpg"/>
						<p>步骤1：商户根据微信支付的规则，为不同商品生成不同的二维码（如图6.1），展示在各种场景，用于用户扫描购买
                            <br>步骤2：用户使用微信“扫一扫”（如图6.2）扫描二维码后，获取商品支付信息，引导用户完成支付（如图6.3）</p>
					</article>
					<article>
                        <img src="<?php echo base_url(); ?>asset/img/intro/cp.jpg"/>
						<p>步骤（3）：用户确认支付，输入支付密码（如图6.4）
                            <br>步骤（4）：支付完成后会提示用户支付成功（如图6.5），商户后台得到支付成功的通知，然后进行发货处理</p>
					</article>
					<article>
                        <img src="<?php echo base_url(); ?>asset/img/intro/cp1.jpg"/>
					</article>
				</div>
                <?php
                }
                ?>

                <?php
                if ($category == 2){
                ?>
                <div class="wrap-col">
                    <article>
                        <img src="<?php echo base_url(); ?>asset/img/intro/blog1.jpg"/>
                        <p>步骤1：用户打开支付宝，点击“付款”</p>
                    </article>
                    <article>
                        <center><img src="<?php echo base_url(); ?>asset/img/intro/cp2.png" style="width: 253px; "/></center>
                        <p>步骤2：选择“扫码付”，并将摄像头对准二维码或者条形码</p>
                    </article>
                    <article>
                        <center><img src="<?php echo base_url(); ?>asset/img/intro/cp3.png" style="width: 253px; "/></center>
                        <p>步骤3：付款确认</p>
                    </article>
                    <article>
                        <center><img src="<?php echo base_url(); ?>asset/img/intro/cp4.png" style="width: 253px; "/></center>
                        <p>步骤4：付款确认</p>
                    </article>
                    <article>
                        <center><img src="<?php echo base_url(); ?>asset/img/intro/cp5.png" style="width: 253px; "/></center>
                    </article>
                </div>
                <?php
                }
                ?>

                <?php
                if ($category == 3){
                ?>
                <div class="wrap-col">
                    <article>
                        <img src="<?php echo base_url(); ?>asset/img/intro/blog1.jpg"/>

                    </article>
                    <article>
                        <center><img src="<?php echo base_url(); ?>asset/img/intro/wysk.jpg" /></center>
                        <h2 style="color: rgb(242, 108, 35); font-size: 16px;font-weight: bold;">发起我要收款马上就能收到钱吗？</h2>
                        <p>答：不会。您将您的收款链接发给对方付款，只有在对方付款成功后，款项才会直接打入您的启跃账户。</p>
                    </article>
                    <article>
                        <h2 style="color: rgb(242, 108, 35); font-size: 16px;font-weight: bold;">使用我要收款得来的钱可以提现吗？</h2>
                        <p>答：可以。</p>
                    </article>
                    <article>
                        <h2 style="color: rgb(242, 108, 35); font-size: 16px;font-weight: bold;">每天发起收款的限额是多少？</h2>
                        <p>答：限额根据银行卡开通时银行卡限额标准。</p>
                    </article>
                </div>
                <?php
                }
                ?>
			</div>

		</div>
	</div>
</section>
