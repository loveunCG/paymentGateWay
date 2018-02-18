<div class="container-fluid">

  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
  <section class="content-header" style="margin-top: 5%;">
      <h1>
          <bold>通道费率 </h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> 订单管理</a></li>
          <li><a href="#">通道费率</a></li>
      </ol>
  </section>
<div class="col-sm-12" data-offset="0">
<div class="panel panel-info">            
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>通道费率</strong>
                    </div>
                </div>
                <!-- Table -->
           <div class="panel-body">

        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>代销卡种类</th>
                            <th>销售价格</th>
                            <th>我方维护状态</th>
                            <th>你方开通状态 </th>
                            <th class="col-sm-1">操作</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($channel_rate as $v_award) : ?>
                                <tr>
                                    <td>网银通道</td>
                                    <td><?php echo $v_award->ONLINE; ?></td>
                                    <?php if($v_award->pay_type_status=='1'){ ?>
                                    <td><?php echo "正常销售" ?></td>
                                    <?php }else{?>
                                    <td><?php echo "正常" ?></td>
                                    <?php } ?>
                                    <td><?php echo "已开通" ?></td>
                                    <td><?php echo '<span class="label label-primary col-sm-12"><i class="fa fa-check-square-o"></i> 开通此卡</span>' ?></td>
                                </tr>
                                <tr>
                                    <td>财付通</td>
                                    <td><?php echo $v_award->TENPAY; ?></td>
                                    <?php if($v_award->pay_type_status=='1'){ ?>
                                    <td><?php echo "正常销售" ?></td>
                                    <?php }else{?>
                                    <td><?php echo "正常" ?></td>
                                    <?php } ?>
                                    <td><?php echo "已开通" ?></td>
                                    <td><?php echo '<span class="label label-primary col-sm-12"><i class="fa fa-check-square-o"></i> 开通此卡</span>' ?></td>
                                </tr> 
                                <tr>
                                    <td>微信</td>
                                    <td><?php echo $v_award->WEIXIN; ?></td>
                                    <?php if($v_award->pay_type_status=='1'){ ?>
                                    <td><?php echo "正常销售" ?></td>
                                    <?php }else{?>
                                    <td><?php echo "正常" ?></td>
                                    <?php } ?>
                                    <td><?php echo "已开通" ?></td>
                                    <td><?php echo '<span class="label label-primary col-sm-12"><i class="fa fa-check-square-o"></i> 开通此卡</span>' ?></td>
                                </tr>
                                <tr>
                                    <td>支付宝</td>
                                    <td><?php echo $v_award->ALIPAY; ?></td>
                                    <?php if($v_award->pay_type_status=='1'){ ?>
                                    <td><?php echo "正常销售" ?></td>
                                    <?php }else{?>
                                    <td><?php echo "正常" ?></td>
                                    <?php } ?>
                                    <td><?php echo "已开通" ?></td>
                                    <td><?php echo '<span class="label label-primary col-sm-12"><i class="fa fa-check-square-o"></i> 开通此卡</span>' ?></td>
                                </tr> 
                                <tr>
                                    <td>WAP支付宝</td>
                                    <td><?php echo $v_award->ALIPAYWAP; ?></td>
                                    <?php if($v_award->pay_type_status=='1'){ ?>
                                    <td><?php echo "正常销售" ?></td>
                                    <?php }else{?>
                                    <td><?php echo "正常" ?></td>
                                    <?php } ?>
                                    <td><?php echo "已开通" ?></td>
                                    <td><?php echo '<span class="label label-primary col-sm-12"><i class="fa fa-check-square-o"></i> 开通此卡</span>' ?></td>
                                </tr> 
                                <tr>
                                    <td>WAP微信</td>
                                    <td><?php echo $v_award->WEIXINWAP; ?></td>
                                    <?php if($v_award->pay_type_status=='1'){ ?>
                                    <td><?php echo "正常销售" ?></td>
                                    <?php }else{?>
                                    <td><?php echo "正常" ?></td>
                                    <?php } ?>
                                    <td><?php echo "已开通" ?></td>
                                    <td><?php echo '<span class="label label-primary col-sm-12"><i class="fa fa-check-square-o"></i> 开通此卡</span>' ?></td>
                                </tr> 
                                <tr>
                                    <td>代付</td>
                                    <td><?php echo $v_award->DAIFU; ?></td>
                                    <?php if($v_award->pay_type_status=='1'){ ?>
                                    <td><?php echo "正常销售" ?></td>
                                    <?php }else{?>
                                    <td><?php echo "正常" ?></td>
                                    <?php } ?>
                                    <td><?php echo "已开通" ?></td>
                                    <td><?php echo '<span class="label label-primary col-sm-12"><i class="fa fa-check-square-o"></i> 开通此卡</span>' ?></td>
                                </tr>                                                                                                                                                                                                 
                                <?php
                            endforeach;
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

