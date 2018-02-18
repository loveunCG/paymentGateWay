<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/kendo.default.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/kendo.common.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/kendo.all.min.js"></script>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>创建用户类型</strong>
                </div>
            </div>
            <div class="panel-body">


                <div class="panel-body">
                    <form role="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/user_permission/save_user_type/<?php if(!empty($user_type_details->user_type_id)) echo $user_type_details->user_type_id?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">用户类型<span class="required">*</span></label>

                                    <div class="col-sm-8">

                                        <input type="text" name="user_type" value="<?php if(!empty($user_type_details->user_type)) echo $user_type_details->user_type; ?>" class="form-control"  placeholder="" required/>

                                    </div>
                                </div>
                                <div class="col-sm-offset-3 col-sm-8">
                                    <button type="submit" id="sbtn" class="btn btn-primary"><?php echo!empty($user_type_details->user_type) ? '更新' : '创建' ?></button>
                                </div>

                            </div>
                            <div class="col-sm-6">

                                <div class="list-group">
                                    <a href="#" class="list-group-item disabled">
                                        用户权限级别
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="k-header">
                                            <div class="box-col">
                                                <div id="treeview"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>  

    <script>
        $("#treeview").kendoTreeView({
            checkboxes: {
                checkChildren: true,
                template: "<input type='checkbox' #= item.check# name='menu[]' value='#= item.value #'  />"
            },
            check: onCheck,
            dataSource: [
        <?php foreach ($result as $parent => $v_parent): ?>                   
            <?php if(is_array($v_parent)):?>
                <?php foreach ($v_parent as $parent_id => $v_child): ?>            
                {
                id: "", text: "<?php echo $parent; ?>",value: "<?php if(!empty ($parent_id)){ echo $parent_id;}?>", expanded: false, items: [                                                                                                   
                 <?php foreach ($v_child as $child => $v_sub_child) :?>         
                   <?php if(is_array($v_sub_child)):?> 
                    <?php foreach ($v_sub_child as  $sub_chld =>  $v_sub_chld): ?>
                   {
                        id: "", text: "<?php echo $child;?>",value: "<?php if(!empty ($sub_chld)){ echo $sub_chld;}?>",expanded: false, items: [
                            <?php foreach($v_sub_chld as $sub_chld_name => $sub_chld_id):?>
                            {
                              id: "", text: "<?php echo $sub_chld_name;?>",<?php if(!empty($roll[$sub_chld_id])){echo $roll[$sub_chld_id] ?'check: "checked",':'check:"checked",' ;} ?> value: "<?php if(!empty ($sub_chld_id)){ echo $sub_chld_id;}?>",  
                            },  
                            <?php endforeach;?>
                       ]     
                    },                        
                    <?php endforeach;?>   
                    <?php else:?>
                        {
                        id: "", text: "<?php echo $child;?>", <?php if(!is_array($v_sub_child)){if(!empty($roll[$v_sub_child])){echo $roll[$v_sub_child] ?'check: "checked",':'check:"checked",' ;}} ?> value: "<?php if(!empty ($v_sub_child)){ echo $v_sub_child;}?>",
                    },
                    <?php endif;?>
                   <?php endforeach;?>         
                ]
            },                        
            <?php endforeach;?>
            <?php else: ?>                
                  {
                        id: "", text: "<?php echo $parent?>", <?php if(!is_array($v_parent)){if(!empty($roll[$v_parent])){echo $roll[$v_parent] ? 'check: "checked",':'check:"checked",' ;}} ?> value: "<?php if(!is_array($v_parent)) {echo $v_parent;}?>"
                    },                  
            <?php endif;?>
            <?php endforeach;?>
            ]
        });
        

        // show checked node IDs on datasource change
        function onCheck() {
            var checkedNodes = [],
                treeView = $("#treeview").data("kendoTreeView"),
                message;

            checkedNodeIds(treeView.dataSource.view(), checkedNodes);

            $("#result").html(message);
        }
    </script>


    <script type="text/javascript">

        $(function () {
            $('form').submit(function () {
                $('#treeview :checkbox').each(function () {
                    if (this.indeterminate) {
                        this.checked = true;
                    }
                });
            })
        })
    </script>

