<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<h4><?php echo anchor('admin/employee/add_employee', '<i class="fa fa-plus"></i> '.$this->language->form_heading()[11]); ?></h4>
<br/>

                <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation(this)" action="<?php echo base_url(); ?>admin/employee/employee_list" method="post" class="form-horizontal form-groups-bordered">
                    <div class="row">
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">商户ID:</label>
                                    <div class="input-group col-md-7">
                                    <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="employee_id" value="<?php if(!empty($employee_id)) echo $employee_id; ?>" >
                                    </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">注册E-MAIL:</label>
                                    <div class="input-group col-md-7">
                                    <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="emp_email" value="<?php if(!empty($emp_email)) echo $emp_email; ?>">
                                    </div>

                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">资金状态:</label>
                                    <div class="input-group col-md-7">

                                                <select name="qq" class="form-control">
                                                   <?php 
                                                        if ($qq == 1) {                          
                                                        ?>
                                                        <option value="" ></option>
                                                            <option value="1"  selected>正常</option>
                                                            <option value="2" >非正常</option>                            
                                                        <?php } elseif($qq == 2) { ?>
                                                            <option value="" ></option>
                                                            <option value="1"  >正常</option>
                                                            <option value="2" selected>非正常</option>    
                                                    <?php }else{ ?>
                                                            <option value="" ></option>
                                                            <option value="1"  >正常</option>
                                                            <option value="2">非正常</option>
                                                    <?php } ?>                                                                
                                                                          

                                                </select>
                                    </div>

                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">所属商户组:</label>
                                    <div class="input-group col-md-7">

                                                <select name="emp_group" class="form-control">
                                                    <option value="" ></option>                           
                                                   <?php if (!empty($all_group_info)): ?>                                        
                                                                    <?php foreach ($all_group_info as $designation) : 
                                                                    if ($designation->id==$emp_group) {                          
                                                                    ?>
                                                                        <option value="<?php echo $designation->id; ?>"  selected>
                                                                        <?php echo $designation->group_name ?></option>                            
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $designation->id; ?>" >
                                                                        <?php echo $designation->group_name ?></option>    
                                                                    <?php }  endforeach; ?>
                                                                
                                                    <?php endif; ?>                            

                                                </select>
                                    </div>

                                    </div> 
                        </div>
                    <div class="row">
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">联系电话:</label>
                                    <div class="input-group col-md-7">

                                    <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="phone"  value="<?php if(!empty($phone)) echo $phone; ?>">
                                    </div>

                                    </div>
                                    <div class="form-group col-lg-3">
                                    <label class="col-md-5 control-label" for="state-danger">商户状态:</label>
                                    <div class="input-group col-md-7">

                                        <select name="status" class="form-control" style="border-radius: 4px;">                            
                                            <?php if ($status==2) { ?>
                                                <option value="0">所有状态</option>
                                                <option value="2" selected="">等侍验证</option>
                                                <option value="1" >通过验证</option>
                                                <option value="3" >拒绝验证</option>
                                                <option value="4" >冻结商户</option>
                                            <?php }elseif($status==1){ ?>
                                                <option value="0">所有状态</option>
                                                <option value="2" >等侍验证</option>
                                                <option value="1" selected="">通过验证</option>
                                                <option value="3" >拒绝验证</option>
                                                <option value="4" >冻结商户</option>
                                            <?php }elseif($status==3){ ?>
                                                <option value="0">所有状态</option>
                                                <option value="2" >等侍验证</option>
                                                <option value="1" >通过验证</option>
                                                <option value="3" selected="">拒绝验证</option>
                                                <option value="4" >冻结商户</option>
                                            <?php }elseif($status==4){ ?>
                                                <option value="0">所有状态</option>
                                                <option value="2" >等侍验证</option>
                                                <option value="1" >通过验证</option>
                                                <option value="3" >拒绝验证</option>
                                                <option value="4" selected="">冻结商户</option>
                                            <?php }else{ ?>                                                
                                                <option value="0" selected="">所有状态</option>
                                                <option value="2" >等侍验证</option>
                                                <option value="1" >通过验证</option>
                                                <option value="3" >拒绝验证</option>
                                                <option value="4" >冻结商户</option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    </div>                     
                        <div class="form-group col-lg-3">
                        <label class="col-md-5 control-label" for="state-danger">代理ID:</label>
                        <div class="input-group col-md-7">
                        <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="agent_id" value="<?php if(!empty($agent_id)) echo $agent_id; ?>" >
                        </div>
                        </div> 
                        <div class="form-group col-lg-3">
                        <label class="col-md-5 control-label" for="state-danger">通道:</label>
                        <div class="input-group col-md-7">
                                                <select name="channel" class="form-control">
                                                    <option value="" ></option>                           
                                                   <?php if (!empty($channel_info)): ?>                                        
                                                                    <?php foreach ($channel_info as $cha) : ?>
                                                                    <?php if ($cha->parent!=1) {
                                                                        if ($cha->id==$channel) {                          
                                                                        ?>
                                                                            <option value="<?php echo $cha->id; ?>"  selected>
                                                                            <?php echo $cha->channel_name ?></option>                            
                                                                        <?php } else { ?>
                                                                            <option value="<?php echo $cha->id; ?>" >
                                                                            <?php echo $cha->channel_name ?></option>
                                                                        <?php } } ?>    
                                                                    <?php endforeach; ?>
                                                                
                                                    <?php endif; ?>                            

                                                </select>
                        </div>
                        </div>
                                                                    
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                        <label class="col-md-5 control-label" for="state-danger">账户金额:</label>
                        <div class="input-group col-md-7">
                        <input type="text" class="form-control pull-right" style="border-radius: 4px;" name="limit_mon" value="<?php if(!empty($limit_mon)) echo $limit_mon; ?>" >
                        </div>
                        </div> 
                    </div>
                                    

                         <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="sbtn" class="btn btn-primary" style="float: right;margin-right: 10%;" id="i_submit" >&nbsp;&nbsp;&nbsp;&nbsp; 开始查询 &nbsp;&nbsp;&nbsp;&nbsp;</button><br><br></strong>

</form>

    <div class="row">
        <div class="col-sm-12 wrap-fpanel" data-spy="scroll" data-offset="0">                            
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>商户列表</strong>

                    </div>
                </div>
                <br />
                <!-- Table -->
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>                            
                            <th class="col-sm-1"><?php echo $this->language->from_body()[57][42];?></th>
                            <th>注册E-MAIL</th>
                             <!--change by @p.p single-->
                            <th><?php echo $this->language->from_body()[57][44];?></th>
                            <th class="show_print"><?php echo $this->language->from_body()[57][45];?></th>
                            <th>QQ</th>
                            <th><?php echo $this->language->from_body()[57][46];?></th>
                            <th><?php echo $this->language->from_body()[57][47];?></th>
                            <th class="col-sm-1 hidden-print"><?php echo $this->language->from_body()[57][48];?></th>
                            <th class="col-sm-1 hidden-print"><?php echo $this->language->from_body()[57][49];?></th>
                            <th class="col-sm-1 hidden-print"><?php echo $this->language->from_body()[57][50];?></th>
                            <th class="col-sm-1 hidden-print"><?php echo $this->language->from_body()[57][51];?></th>
                            <!-- <th class="col-sm-1 hidden-print"><?php echo $this->language->from_body()[57][52];?></th> -->
                            <th class="col-sm-1 hidden-print"><?php echo $this->language->from_body()[57][53];?></th>
                        </tr>
                    </thead>
                    <tbody>                    
                        <?php if (!empty($all_employee_info)): foreach ($all_employee_info as $v_employee) : ?>

                                <tr>                               
                                    <td><?php echo $v_employee->employee_id ?></td>
                                    <td><?php echo $v_employee->usr_email; ?></td>
                                    <td><?php echo $v_employee->group_name ;?></td>
                                    <td><?php echo $v_employee->usr_contact_qq_num; ?></td>
                                    <td><?php echo $v_employee->first_name.$v_employee->last_name;?></td>

                                    <td><?php echo $v_employee->usr_mobile; ?></td>
                                    <td><?php echo $v_employee->usr_amount; ?></td>
                                    <td><?php echo $v_employee->usr_create_time; ?></td>
                                    <td><?php
                                        if ($v_employee->usr_status == 1) {
                                            echo '<span class="label label-success"> 通过验证 </span>';
                                        } elseif($v_employee->usr_status == 4) {
                                            echo '<span class="label label-danger">冻结商户</span>';
                                        } elseif($v_employee->usr_status == 3) {
                                            echo '<span class="label label-danger"> 拒绝验证</span>';
                                        }elseif($v_employee->usr_status == 2) {
                                            echo '<span class="label label-danger"> 等侍验证 </span>';
                                        }
                                        ?></td>
                                    <td><?php
                                        if ($v_employee->status == 1) {
                                            echo '<span class="label label-success">正常</span>';
                                        } else {
                                            echo '<span class="label label-danger">非正常</span>';
                                        }
                                        ?></td>
                                    <!-- <td>点击显示</td> -->
                                    <td class="hidden-print">
                                        <?php echo btn_edit('admin/employee/view_employee/' . $v_employee->empId); ?>
                                        <?php echo btn_delete('admin/employee/delete_employee/' . $v_employee->empId); ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        <?php else : ?>
                        <td colspan="3">
                            <strong>没有数据可以显示</strong>
                        </td>
                    <?php endif; ?>
                    </tbody>
                </table>          
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function employee_list(employee_list) {
        var printContents = document.getElementById(employee_list).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
