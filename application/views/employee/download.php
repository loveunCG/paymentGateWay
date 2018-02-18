<div class="container-fluid">
    <section class="content-header" style="margin-top: 5%;">
        <h1>
            <bold>接口设置 </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 接口设置</a></li>
            <li><a href="#">下载</a></li>
        </ol>
    </section>
    <div class="alert alert-success alert-dismissible">
        <h3>文档下载</h3>

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> 您的直通车商户号是：
            <?php echo $this->session->userdata('employee_id'); ?>!</h4>
        1、目前暂不支持自行设定和修改接口对接供卡秘钥，如需更改秘钥，请联系商务。<br> 2、收到秘钥后，请您及时与所使用的充值平台相关人员联系，并完成后续接入工作。 修改商户回调通知地址
    </div>

    <div class="row">
        <form action="" method="post" id="download">
         <input type="hidden" name="type_doc" id="type_doc" value="1" />
         </form>
         <form action="" method="post" id="download1">
         <input type="hidden" name="type_doc" id="type_doc" value="0" />
         </form>
            <div class="col-sm-5"></div>

                <div class="col-sm-2">
                    <button type="button" id="yin_download" class="btn btn-block btn-primary btn-flat"><i class="fa fa-download"></i> &nbsp;&nbsp;文档下载</button>

                </div>
                <!-- /.box -->

            </div>
    </div>
</div>
<script>
    $('#yin_download').click(function () {
       window.location.href = '<?=base_url()?>'+'asset/uploads/jiuyoufu_API.doc';
    });
    $('#ka_downlad').click(function () {
       var base_url = '<?= base_url() ?>';
      var strURL = base_url + "employee/dashboard/ajax_download";
      $.post(strURL, {
          type_doc: 0
        }).done(function (data) {
        });
    });
</script>
