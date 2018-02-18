<div class="container-fluid">
    <div class="col-sm-offset-1 col-sm-10" style="margin-top:5%;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><strong>订单结果</strong></strong>
                </div>
            </div>
            <div class="panel-body">
                <h3 class="box-title"> </h3>
                <div class="comment-center p-t-10">
                    <div class="comment-body">
                        <div class="mail-contnet">
                                <div class="col-sm-offset-2 col-sm-9">
                                    <h3><i class="fa fa-warning"></i> &nbsp;&nbsp;现在您的订单(<?php echo '订单号：'.$info->order_id.' 提交金额：   '.$info->real_amount;?>)的状态是 <?php echo $stauts->result;?> , 请联系商务</h3>
                                </div>
                            <div class="col-sm-offset-11 col-sm-9"><a onclick="history.go(-1);" class="btn-rounded btn btn-default btn-outline"><i class="fa fa-mail-reply"></i>&nbsp;推出</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    </div>