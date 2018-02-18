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
            $category_str = array("结算灵活", "开通快捷", "贴心服务", "自助服务", "费率优惠");
            echo "<span style='color: red;'> &nbsp;&nbsp;&nbsp;当前位置：首页 > 商户接入 > ".$category_str[$category-1]."</span><br>";
            ?>
			<div class="title"><span>商户接入服务</span></div>
            <div class="col-1-4">
                <div class="wrap-col">
                    <div class="box">
                        <div class="heading"><h2><strong>&nbsp;商户接入</strong></h2></div>
                        <div class="content">
                            <div class="list">
                                <ul>
                                    <li><a href="business_1"><strong>结算灵活</strong></a></li>
                                    <li><a href="business_2"><strong>开通快捷</strong></a></li>
                                    <li><a href="business_3"><strong>贴心服务</strong></a></li>
                                    <li><a href="business_4"><strong>自助服务</strong></a></li>
                                    <li><a href="business_5"><strong>费率优惠</strong></a></li>
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
						<img src="<?php echo base_url(); ?>asset/img/intro/blog2.jpg"/>
					</article>
					<article>
                        <img src="<?php echo base_url(); ?>asset/img/intro/swt.jpg"/>
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
                        <img src="<?php echo base_url(); ?>asset/img/intro/blog2.jpg"/>
                    </article>
                    <article>
                        <center><img src="<?php echo base_url(); ?>asset/img/intro/ktkj.jpg"/></center>
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
                        <img src="<?php echo base_url(); ?>asset/img/intro/blog2.jpg"/>
                    </article>
                    <article>
                        <center><img src="<?php echo base_url(); ?>asset/img/intro/txfw.jpg" /></center>
                    </article>
                </div>
                <?php
                }
                ?>

                <?php
                if ($category == 4){
                    ?>
                    <div class="wrap-col">
                        <article>
                            <img src="<?php echo base_url(); ?>asset/img/intro/blog2.jpg"/>
                        </article>
                        <article>
                            <center><img src="<?php echo base_url(); ?>asset/img/intro/zzfw.jpg" /></center>
                        </article>
                    </div>
                    <?php
                }
                ?>

                <?php
                if ($category == 5){
                    ?>
                    <div class="wrap-col">
                        <article>
                            <img src="<?php echo base_url(); ?>asset/img/intro/blog2.jpg"/>
                        </article>
                        <article>
                            <center><img src="<?php echo base_url(); ?>asset/img/intro/flyh.jpg" /></center>
                        </article>
                    </div>
                    <?php
                }
                ?>
			</div>

		</div>
	</div>
</section><!--Footer-->

  

