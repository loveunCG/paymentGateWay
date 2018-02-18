<style>

    .color-palette {
        height: 35px;
        line-height: 35px;
        text-align: center;
    }

    .color-palette-set {
        margin-bottom: 15px;
    }

    .color-palette span {
        display: none;
        font-size: 12px;
    }

    .color-palette:hover span {
        display: block;
    }

    .color-palette-box h4 {
        position: absolute;
        top: 100%;
        left: 25px;
        margin-top: -40px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        display: block;
        z-index: 7;
    }
</style>
  <!-- Ionicons -->
<div class="centent-wrapper" style="margin-top: 5%;">

<div class="box box-default">
            
<div class="box-body">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2 class="panel-title "><i class="fa fa-user"></i> <strong>商户信息</strong><span class="pull-right"><a href="<?php echo base_url() ?>intro" class="view-all-front">退出</a></span></h2>
        </div>
        <div class="panel-body">
          <?php if ($type == "success") {?>
            <div class="callout callout-success">
                <h4>登录成功！</h4>

                <p>请您的邮相 确认一下 谢谢.</p>
            </div>
            <?php }else {?>
            <div class="callout callout-warning">
                <h4> 登录失败!</h4>

                <a class="btn btn-app">
                <i class="fa fa-repeat"></i> 再申请</a>
            </div>


            <?php }?>


        </div>
    </div>

</div>
</div>
</div>