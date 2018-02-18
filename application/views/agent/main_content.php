<!-- Here begin Main Content -->
<div class="wrapper">

    <section class="content-header">
        <ol class="breadcrumb">
            <li><i class="fa fa-user" aria-hidden="true"></i> 我的账户</li>

        </ol>
    </section>
    <div class="col-md-12">
        <div class="main_content">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <div class="panel panel-info" style="border: 1px solid #004884 ">
                            <div class="panel-body">
                                <?php if ($agent_details->photo): ?>
                                <img src="<?php echo base_url() . $agent_details->photo; ?>" style="height: 200px; width: 210px;" class="img-responsive center-block"
                                />
                                <?php else: ?>
                                <img src="<?php echo base_url() ?>/asset/img/agent.jpg" style="height: 200px; width: 210px; " class="img-responsive center-block"
                                    alt="Employee_Image" />
                                <?php endif; ?>
                            </div>
                            <div style="border-top: 1px solid #004884 ;">
                                <h5 class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;账户:
                                     <?php 
													$email = $agent_details->mail_address;
													$domain = strstr($email, '@');
													$pre_frex = substr($email, 0, 3);                                            
													echo $pre_frex. str_repeat('*',5).$domain;
													
												?>
                                </h5>
                                <h5 class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;代理ID：
                                    <?php echo $agent_details->proxy_id ; ?>
                                </h5>
                            </div>
                        </div>
                         <?php foreach($agent_channel_rate as $val){
                               if($val->channel_code == 'ABC'){
                                   $online_rate = $val->rate_row;                                    
                               }elseif($val->channel_code == 'ALIPAY'){
                                  $ALIPAY_rate = $val->rate_row;                                    

                               }elseif($val->channel_code == 'ALIPAYWAP'){
                                  $ALIPAYWAP_rate = $val->rate_row;                                    

                               }
                               elseif($val->channel_code == 'TENPAY'){
                                  $TENPAY_rate = $val->rate_row;                                    

                               }
                               elseif($val->channel_code == 'WEIXIN'){
                                  $WEIXIN_rate = $val->rate_row;                          

                               }
                               elseif($val->channel_code == 'WEIXINWAP'){
                                  $WEIXINWAP_rate = $val->rate_row;                                    

                               }
                               elseif($val->channel_code == 'DAIFU'){
                                  $DAIFU_rate = $val->rate_row;                                    

                               } 
                         }                             
                            ?>
                    </div>
                    <div class="col-md-5">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h2 class="panel-title "><i class="fa fa-weixin"></i> <strong>通道费率</strong></h2>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <tbody>                                 
                                       
                                   
                                        <tr>
                                            <td>
                                                <span class="primary-link">网银:</span>
                                            </td>
                                            <td>
                                                <?php echo $online_rate.'%'; ?>
                                            </td> 
                                            <td>
                                                <span class="primary-link">微信:</span>
                                            </td>
                                            <td>
                                                 <?php echo $WEIXIN_rate.'%'; ?>
                                            </td>                                           
                                             
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="primary-link">支付宝:</span>
                                            </td>
                                            <td>
                                                <?php echo $ALIPAY_rate.'%'; ?>
                                            </td> 
                                            <td>
                                                <span class="primary-link">WAP微信:</span>
                                            </td>
                                            <td>
                                               <?php echo $ALIPAYWAP_rate.'%'; ?>
                                            </td>                                                                                                                              

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="primary-link">代付:</span>
                                            </td>
                                            <td>
                                                <?php echo $DAIFU_rate.'%'; ?>
                                            </td>       
                                            <td>
                                                <span class="primary-link">WAP支付宝</span>
                                            </td>
                                            <td>
                                                <?php echo $WEIXINWAP_rate.'%'; ?>
                                            </td>                                                                                                                         
                                        </tr>
                                        <tr>
                                            
                                            <td>
                                                <span class="primary-link">财付通:</span>
                                            </td>
                                            <td>
                                                <?php echo $TENPAY_rate.'%'; ?>
                                            </td>   
                                                                                                                                                               
                                        </tr>                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
               
                <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h2 class="panel-title "><i class="fa fa-jpy"></i> <strong>&nbsp;今日</strong></h2>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="primary-link">今天:</span>
                                            </td>
                                            <td>
                                                <?php echo $recent_time; ?>
                                            </td>
                                        </tr>                                    
                                        <tr>
                                        
                                        <td>                                                <span class="primary-link">今日网银：</span>
                                            </td>
                                            <td><?php if($finance->online_price==NULL){
                                            ?><?php echo "0.00元";
                                           } else{
                                            ?>
                                               <?=$finance->online_price?>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="primary-link">今日微信：</span>
                                            </td>
                                            <td>
                                            <?php if($finance->WEIXIN_price==NULL){?>
                                            <?php echo "0.00元";
                                           } else{
                                            ?>
                                                <?=$finance->WEIXIN_price?>
                                                                                            <?php }?>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="primary-link">今日WAP微信：</span>
                                            </td>
                                            <td><?php if($finance->WEIXINWAP_price==NULL){?>
                                            <?php echo "0.00元";
                                           } else{
                                            ?>
                                                <?=$finance->WEIXINWAP_price?>
                                                                                            <?php }?>

                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <span class="primary-link">今日财付通：</span>
                                            </td>
                                            <td><?php if($finance->TENPAY_price==NULL){?>
                                            <?php echo "0.00元";
                                           } else{
                                            ?>
                                                <?=$finance->TENPAY_price?>
                                                                                            <?php }?>

                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <span class="primary-link">今日代付：</span>
                                            </td>
                                            <td>
                                            <?php if($finance->DAIFU_price==NULL){?>
                                            <?php echo "0.00元";
                                           } else{
                                            ?>
                                                <?=$finance->DAIFU_price?>
                                            <?php }?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <span class="primary-link">今日支付宝：</span>
                                            </td>
                                            <td>
                                            <?php if($finance->ALIPAY_price==NULL){?>
                                            <?php echo "0.00元";
                                           } else{
                                            ?>
                                                <?=$finance->ALIPAY_price?>
                                                                                            <?php }?>

                                            </td>
                                        </tr>
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.col-md-12 -->
</div>
</div>