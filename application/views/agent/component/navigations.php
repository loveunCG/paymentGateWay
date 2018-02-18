
<div class="container-fluid" style="background: #1D83A3;">


    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
        <a href="<?php echo base_url();?>agent/dashboard" >
            <img src="<?php echo base_url(); ?>asset/img/intro/logo.png" style="margin-top: 7%;margin-left: 35%;"/>
        </a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav" style="float: right;margin-top: 4%;">
            <li class="dropdown">
                  <li class="<?php if(!empty($menu['index'])){ echo $menu['index'] == 1 ? 'active' : '';} ?>">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">我的账户<b class="caret"></b></a>
                     <ul class="dropdown-menu dropdown-menu-left">
                             <li class="<?php if(!empty($menu['agentview'])){ echo $menu['agentview'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>agent/dashboard/agentview">账户信息</a></li>
                             <li class="<?php if(!empty($menu['withdraws'])){ echo $menu['withdraws'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>agent/dashboard/withdraws">提现记录</a></li>
                         </ul>
                 </li>
            </li>
             <li class="dropdown <?php if(!empty($menu['ordermanage'])){ echo $menu['ordermanage'] == 1 ? 'active' : '';} ?>">
                    <a href="<?php echo base_url() ?>agent/dashboard/ordermanage">订单管理</a>
             </li>
             <li class=" dropdown <?php if(!empty($menu['usermanage'])){ echo $menu['usermanage'] == 1 ? 'active' : '';} ?>">
                    <a href="<?php echo base_url() ?>agent/dashboard/usermanage">商户管理</a>
                </li>
             <li class="<?php if(!empty($menu['AgentWithdraw'])){ echo $menu['AgentWithdraw'] == 1 ? 'active' : '';} ?>">
                    <a href="<?php echo base_url() ?>agent/dashboard/AgentWithdraw">结算管理</a>
             </li>
            <li class="<?php if(!empty($menu['pubinfo'])){ echo $menu['pubinfo'] == 1 ? 'active' : '';} ?>">
                    <a href="<?php echo base_url() ?>agent/dashboard/pubinfo">公共信息</a>
            </li>
            <li class="<?php if(!empty($menu['agentfinancelist'])){ echo $menu['agentfinancelist'] == 1 ? 'active' : '';} ?>">
                     <a href="<?php echo base_url() ?>agent/dashboard/agentfinancelist">财务管理</a>
            </li>
            <li class="<?php if(!empty($menu['profile'])){ echo $menu['profile'] == 1 ? 'active' : '';} ?>">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown">账户<b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li class="<?php if(!empty($menu['change_password'])){ echo $menu['change_password'] == 1 ? 'active' : '';} ?>"><a href="<?php echo base_url() ?>agent/dashboard/change_password">修改密码</a></li>
                        <li><a href="<?php echo base_url() ?>agent/dashboard/logout">退出登录</a></li>
                    </ul>
           </li>
        </ul>

</div>
<div class="div-social-top">
    <div class="row-fluid">
        <div class="col-lg-offset-2 col-lg-2">
           <a href="#">
               &nbsp;&nbsp;</i>
            </a>
        </div>
    </div>
</div>

</header>
</div>
