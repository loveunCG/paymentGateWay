<link href="<?php echo base_url() ?>asset/css/fullcalendar.css" rel="stylesheet" type="text/css" >
<style type="text/css">
    .datepicker{z-index:1151 !important;}   
</style>
<?php echo message_box('success'); ?>
<input type="hidden" name="event_encode_result" id="event_encode_result" value='<?php echo json_encode($get_event);?>'/>  
<div class="dashboard row" >
    <div class="container-fluid">
        <!-- Info boxes -->
        <!--get total view-->
        <div class="row">         
            <!--Total Order-->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-pie-chart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo $this->language->from_body()[57][21] ?></span>
                        <span class="info-box-number"><?php
                            if (!empty($total_request_count)) {
                                echo $total_request_count;
                            }else{
                            echo 0;}  ?></span>
                    </div>
                </div>
            </div>
            <!--/ Total Order-->

            <!--Total Invoice-->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-bell-slash-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo $this->language->from_body()[57][22] ?></span>
                        <span class="info-box-number"><?php
                            if (!empty($request_count)) {
                                echo $request_count;
                            }else{
                            echo 0;} ?></span>
                    </div>
                </div>
            </div>
            <!--/ Total Invoice-->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <!--Total Customer-->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-bell-slash-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo $this->language->from_body()[57][23] ?></span>
                        <span class="info-box-number"><?php
                            if (!empty($procrequest_count)) {
                                echo $procrequest_count;
                            }else{
                            echo 0;} ?></span>
                    </div>
                </div>
            </div>
            <!--/ Total Customer-->            
        </div> 
        <!--/ get total view-->

        <!--Monthly Recap Report And Latest Order and Total Revenue,Cost,Profit,Tax -->

            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong><i class="fa fa-minus-square"></i> 总请求列表</strong>
                            </div>
                        </div></div>
                    <div class="panel-body">

                        <table class="table">
                                    <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>商户ID</th>
                                            <th>订单号码</th>


                                        </tr>
                                    </thead>                        
                                    <tbody>
                                        <?php
                  
                                            $i=1;foreach($total_requestlist as $fund)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $fund['id']; ?></td>
                                                    <td>
                                                        <b><?php echo $fund['employee_id']; ?></b>
                                                    </td>
                                                    <td>
                                                        <b><?php echo $fund['order_id']; ?></b>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                    </tbody>
                        </table>

                    </div>
                </div>    
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong><i class="fa fa-minus-square"></i> 总剩余请求列表</strong>
                            </div>
                        </div></div>
                    <div class="panel-body">

                        <table class="table">
                                    <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>商户ID</th>
                                            <th>订单号码</th>


                                        </tr>
                                    </thead>                        
                                    <tbody>
                                        <?php
                  
                                            $i=1;foreach($requestlist as $fund)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $fund['id']; ?></td>
                                                    <td>
                                                        <b><?php echo $fund['employee_id']; ?></b>
                                                    </td>
                                                    <td>
                                                        <b><?php echo $fund['order_id']; ?></b>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                    </tbody>
                        </table>

                    </div>
                </div>    
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong><i class="fa fa-minus-square"></i> 总进程请求列表</strong>
                            </div>
                        </div></div>
                    <div class="panel-body">

                        <table class="table">
                                    <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>商户ID</th>
                                            <th>订单号码</th>


                                        </tr>
                                    </thead>                        
                                    <tbody>
                                        <?php
                  
                                            $i=1;foreach($procrequestlist as $fund)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $fund['id']; ?></td>
                                                    <td>
                                                        <b><?php echo $fund['employee_id']; ?></b>
                                                    </td>
                                                    <td>
                                                        <b><?php echo $fund['order_id']; ?></b>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                    </tbody>
                        </table>

                    </div>
                </div>    
            </div>                      
        </div>
    </div>  
