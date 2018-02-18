<div class = "container-fluid">
  <section class="content-header" style="margin-top: 5%;">
      <h1>
          <bold>接口设置 </h1>
      <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> 接口设置</a></li>
          <li><a href="#">通知地址管理</a></li>
      </ol>
  </section>
<div class="alert alert-success alert-dismissible">
    <h3>修改下发地址</h3>

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> 您的直通车商户号是：<?php echo $this->session->userdata('employee_id'); ?>!</h4>
    1、目前暂不支持自行设定和修改接口对接供卡秘钥，如需更改秘钥，请联系商务。<br>
    2、收到秘钥后，请您及时与所使用的充值平台相关人员联系，并完成后续接入工作。 修改商户回调通知地址
</div>

<div class="row form-group">
    <div class="col-sm-6">
        <input type="email" class="form-control" id="exampleInputEmail1" required>
    </div>
    <div class = "col-sm-6">
    </div>
    <div class = "col-xs col-sm-6 col-xs-12">
    <button type="button" id = "send_mail" class="btn btn-primary">提交</button>
    <span id = "result"></span>
    </div>
</div>
</div>
<script>
    $('#send_mail').click(function(){
        var toemail = $('#exampleInputEmail1').val();
        var url = "<?=base_url()?>employee/dashboard/sendEmail/"
        $.post( url, { email: toemail}, function( data ) {
        $( ".result" ).html( data );
       });
    });

</script>