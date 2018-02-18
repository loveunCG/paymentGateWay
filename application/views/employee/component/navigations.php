<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header" style="position: fixed;">
            <nav class="nav navbar-top-links navbar-left" >
                <!-- Logo -->
                <div class="logo" style="margin-top: 3%;margin-bottom: 1%;">
                    <?php $genaral_info=$this->session->userdata('genaral_info');
                                        if (!empty($genaral_info)) {
                                            foreach ($genaral_info as $info) {
                                                ?><a href="<?php echo base_url() ?>employee/dashboard"><img src="<?php echo base_url() . $info->logo ?>" style="width: 75%;margin-left: 10%;margin-bottom: 2%;' alt="" class="img"/></a>
                    <?php
                                            }
                                        }

                                        else {
                                            ?><img src="<?php echo base_url() ?>img/logo.png" class="img-circle" alt="school_logo" style="width: 80%;margin-left: 10%;margin-bottom:1%">
                        <?php
                                        }

                                        ?>
                </div>
            </nav>
            <!-- /Logo -->
            <ul class="nav navbar-top-links navbar-right pull-right" style="margin-left: -19%;">
                <li class="dropdown <?php if(!empty($menu['profile'])){ echo $menu['profile'] == 1 ? 'active' : '';} ?>" style="margin-left: -50%;margin-top: 24%;" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> &nbsp;账户<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">

                        <li class="<?php if(!empty($menu['change_password'])){ echo $menu['change_password'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/change_password"><i class="ti-settings"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;修改密码</a></li>
                        <li><a href="<?php echo base_url() ?>login/logout"><i class="fa fa-power-off"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;退出登录</a></li>

                </li>
                </ul>
                <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!--==============================================================-->
    <!-- Left Sidebar - style you can find in sidebar.scss -->
    <!--==============================================================-->
    <div class="navbar-default sidebar" role="navigation" style="margin-top: 2%;">
        <div class="sidebar-nav slimscrollsidebar">

            <?php  $employee_status = $this->session->userdata('employee_status');
                if($employee_status == 1 || $employee_status == 2){ ?>


            <ul class="nav" id="side-menu">
                <li style="padding: 70px 0 0;" class="<?php if(!empty($menu['basic_profile'])){ echo $menu['profile_info'] == 1 ? 'active' : '';} ?>"><a href="#" class="dropdown-toggle waves-effect" data-toggle="dropdown"><i class="fa fa-user fa-fw" aria-hidden="true"></i>我的信息<span class="label label-rouded label-warning pull-right">4</span><span class="fa arrow"></span></a>

                </li>
                <li class="<?php if(!empty($menu['leave_application'])){ echo $menu['leave_application'] == 1 ? 'active' : '';} ?>"><a href="#" class="dropdown-toggle  waves-effect"><i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;点击寄售<span class="label label-rouded label-warning pull-right">2</span><span class="fa arrow"></span></a>

                </li>
                <li class="<?php if(!empty($menu['search_order'])){ echo $menu['search_order'] == 1 ? 'active' : '';} ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;订单管理<span class="label label-rouded label-warning pull-right">2</span><span class="fa arrow"></span></a>

                </li>
                <li class="<?php if(!empty($menu['interface_id_get'])){ echo $menu['interface_id_get'] == 1 ? 'active' : '';} ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-spin fa-cog"></i>&nbsp;&nbsp;接口设置<span class="label label-rouded label-warning pull-right">3</span><span class="fa arrow"></span></a>

                </li>
                <li class="<?php if(!empty($menu['immediate_delivery'])){ echo $menu['immediate_delivery'] == 1 ? 'active' : '';} ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-send"></i>&nbsp;&nbsp;提现管理<span class="label label-rouded label-warning pull-right">4</span><span class="fa arrow"></span></a>

                </li>
                <li class="<?php if(!empty($menu['all_award'])){ echo $menu['channel'] == 1 ? 'active' : '';} ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-jpy"></i>&nbsp;&nbsp;通道费率<span class="label label-rouded label-warning pull-right">1</span><span class="fa arrow"></span></a>

                </li>
                <li class="<?php if(!empty($menu['channel'])){ echo $menu['funds_flow'] == 1 ? 'active' : '';} ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bank"></i>&nbsp;&nbsp;财务管理<span class="label label-rouded label-warning pull-right">1</span><span class="fa arrow"></span></a>

                </li>

            </ul>
            <?php }else{?>



            <ul class="nav" id="side-menu">
                <li style="padding: 70px 0 0;" class=""><a href="#" class="dropdown-toggle waves-effect" data-toggle="dropdown"><i class="fa fa-user fa-fw" aria-hidden="true"></i>我的信息<span class="label label-rouded label-warning pull-right">4</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if(!empty($menu['basic_profile'])){ echo $menu['basic_profile'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/basic_profile">基本资料</a></li>
                        <li class="<?php if(!empty($menu['account_info'])){ echo $menu['account_info'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/account_info">账户信息</a></li>
                        <li class="<?php if(!empty($menu['login_log'])){ echo $menu['login_logs'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/login_log">登录日志</a></li>
                        <li class=""><a href="<?php echo base_url() ?>employee/dashboard/change_password">修改密码</a></li>
                    </ul>
                </li>
                <!-- <li class=""><a href="#" class="dropdown-toggle  waves-effect"><i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;订单申请<span class="label label-rouded label-warning pull-right">1</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if(!empty($menu['leave_application1'])){ echo $menu['leave_application1'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/apply_leave_application">订单提交</a></li>
                    </ul>
                </li> -->
                <li class=""><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;订单管理<span class="label label-rouded label-warning pull-right">1</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if(!empty($menu['search_order'])){ echo $menu['search_order'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/search_order">订单查询</a></li>
                        <!--<li class="<?php if(!empty($menu['card_order'])){ echo $menu['card_order'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/card_order">销卡订单</a></li>-->
                    </ul>
                </li>
                <li class=""><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-spin fa-cog"></i>&nbsp;&nbsp;接口设置<span class="label label-rouded label-warning pull-right">3</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if(!empty($menu['interface_id_get'])){ echo $menu['interface_id_get'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/interface_id_get">查看ID密钥</a></li>
                        <!--<li class="<?php if(!empty($menu['card_table'])){ echo $menu['card_table'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/card_table">卡类编码</a></li>-->
                        <li class="<?php if(!empty($menu['notice_manage'])){ echo $menu['notice_manage'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/notice_manage">通知地址管理</a></li>
                        <li class="<?php if(!empty($menu['download'])){ echo $menu['download'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/download">接口文档下载</a></li>

                    </ul>
                </li>
                <li class=""><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-send"></i>&nbsp;&nbsp;提现管理<span class="label label-rouded label-warning pull-right">3</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="<?php if(!empty($menu['immediate_delivery'])){ echo $menu['immediate_delivery'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/immediate_delivery">提现申请</a></li>
                        <li class="<?php if(!empty($menu['immediate_log'])){ echo $menu['immediate_log'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/immediate_log">提现记录</a></li>
<!--                    <li class="<?php if(!empty($menu['withdraw_log'])){ echo $menu['withdraw_log'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/uwithdraw_log">提现记录</a></li>
                        <li class="<?php if(!empty($menu['withdraw'])){ echo $menu['withdraw'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>employee/dashboard/withdraw">提现申请</a></li> -->
                    </ul>
                </li>
                <li class=""><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-jpy"></i>&nbsp;&nbsp;通道费率<span class="label label-rouded label-warning pull-right">1</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url() ?>employee/dashboard/all_award">通道费率</a></li>
                    </ul>
                </li>
                <li class=""><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bank"></i>&nbsp;&nbsp;财务管理<span class="label label-rouded label-warning pull-right">1</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url() ?>employee/dashboard/funds_flow">资金流水</a></li>
                    </ul>
                </li>

            </ul>
            <?php }?>
        </div>
    </div>
</div>
