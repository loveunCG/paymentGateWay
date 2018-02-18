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
            $category_str = array();
            echo "<span style='color: red;'> &nbsp;&nbsp;&nbsp;当前位置：首页 > 联系我们 "."</span><br>";
            ?>

            <div class="col-1-4">
                <div class="wrap-col">
                    <div class="box">
                        <div class="heading"><h2><strong>&nbsp;联系我们</strong></h2></div>
                    </div>
                </div>
            </div>
			<div class="col-3-4">
                <?php
                if ($category == 1){
                ?>
				<div class="wrap-col">

					<article>
						<div class="about_right" style="margin: 0 auto;">
							<table style="width:90%">
								<tbody><tr><td height="15" colspan="2"></td></tr>
								<tr>
									<td colspan="2" class="f14black grayb">联系我们</td>
								</tr>
								<tr><td height="20" colspan="2"></td></tr>
								<tr>
									<td class="list" colspan="2" style="padding-left:21px; line-height:24px; height:24px;">
										<li>在线客服:QQ--<?php echo $info->qq_num;?></li>
										<li>QQ客服7*24小时在线服务，直接交谈，实时为你解决问题</li>
										<br>
									</td>
								</tr>
								<tr><td height="25" colspan="2"></td></tr>
								<tr><td colspan="2" class="grayb"><font class="f14black">商务合作</font>（以下在线咨询只接受商务合作联系,仅限通道合作）</td></tr>
							</tbody>
						</table>
						<table class="table-contactus">
							<tbody><tr><td height="15" colspan="2"></td></tr>
							<tr>
							<td class="list" colspan="2" style="padding-left:21px; line-height:24px; height:24px;">
								<li>小刘：</li>
										<li>QQ-<?php echo $info->qq_num;?></li>
										<br>
										<li>张：</li>
										<li>QQ-<?php echo $info->qq_num;?></li>
										<br>
										<li>福建省福州市鼓楼区鼓东街道八一七北路81号五洲大厦写字楼6层604室C区</li>
										<li>邮编：350000</li>
										<br>
									</td>
								</tr>
				        </tbody>
							</table>
    			</div>
					</article>
				</div>
                <?php
                }
                ?>
			</div>

		</div>
	</div>
</section>


<!--Footer-->


