<div class="container-fluid">
    <div class="col-sm-offset-1 col-sm-10" style="margin-top:5%;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><strong>提现拒绝原因</strong></strong>
                </div>
            </div>
            <div class="panel-body">
                <h3 class="box-title"> </h3>
                <div class="comment-center p-t-10">
                    <div class="comment-body">
                        <div class="mail-contnet">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="panel panel-info">

                                      <div class="panel-body">
                                          <table class="table table-hover">
                                              <tbody>
                                                  <tr>
                                                      <td>
                                                          <span class="primary-link">银行名称：</span>
                                                      </td>
                                                      <td>
                                                          <?php echo $delivery_info->delivery_bank_name ?>
                                                      </td>
                                                      <td>
                                                          <span class="primary-link">收款账号：:</span>
                                                      </td>
                                                      <td>
                                                          <?php echo $delivery_info->delivery_bank_card ?>
                                                      </td>
                                                      <td>
                                                          <span class="primary-link">收款人：</span>
                                                      </td>
                                                      <td>
                                                          <?php echo $delivery_info->delivery_name ?>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td>
                                                          <span class="primary-link">提现金额：</span>
                                                      </td>
                                                      <td>
                                                          <?php echo  $delivery_info->delivery_mount + $delivery_info->fee?>￥
                                                      </td>
                                                      <td>
                                                          <span class="primary-link">提现时间：</span>
                                                      </td>
                                                      <td>
                                                          <?=$delivery_info->create_time; ?>
                                                      </td>
                                                      <td>
                                                          <span class="primary-link">拒绝理由：</span>
                                                      </td>
                                                      <td>
                                                          <?=$delivery_info->reason; ?>
                                                      </td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>

                          </div>

                            <div class="col-sm-offset-11 col-sm-9"><a onclick="history.go(-1);" class="btn-rounded btn btn-default btn-outline"><i class="fa fa-mail-reply"></i>&nbsp;返回</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
