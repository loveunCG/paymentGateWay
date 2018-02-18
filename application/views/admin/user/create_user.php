<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/kendo.default.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/kendo.common.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/kendo.all.min.js"></script>
</script>
<script>
$(document).ready(function(){
	//alert("dfg");
    $(".reg_password").click(function(){
		alert("");
        $("#div1").html(<?php echo  $password ?>);
    });
});
</script>

<div class="row"> 
    <div class="col-sm-12">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->from_body()[17][0] ?></strong>
                </div>
            </div>
            <div class="panel-body">


                <div class="panel-body">
                    <form role="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/user/save_user/<?php if(!empty($user_type_detail->user_id)) echo $user_type_detail->user_id?>" method="post" class="form-horizontal form-groups-bordered">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[9][2] ?><span class="required">*</span></label>

                                    <div class="col-sm-8">

                                        <input type="text" name="user_name" value="<?php if(!empty($user_type_detail->user_name)) echo $user_type_detail->user_name; ?>" class="form-control"  placeholder="" required/>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[9][7] ?><span class="required">*</span></label>

                                    <div class="col-sm-8">
                                        <input type="password" name="password"  class="form-control"  value=""  placeholder="" />
                                    </div>
									<!--<a id="div1"></a>
									<a class="reg_password">test</a>-->
                                </div>
							
			<div class="form-group">	
			
				<label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[9][3] ?><span class="required">*</span></label>
						 <div class="col-sm-8">
                        <select name="user_type_id" class="form-control" >
                            <option value=""></option>
							 
							 
					
					  <?php if (!empty($user_type_info)): ?>
                                            <?php foreach ($user_type_info as $user_type) : ?>
                                                <option value="<?php echo $user_type->user_type_id; ?>" 
                                                <?php
                                                if (!empty($user_type_detail->user_type_id)) {
                                                    echo $user_type->user_type_id == $user_type_detail->user_type_id ? 'selected' : '';
                                                }
                                                ?>><?php echo $user_type->user_type?></option>                            
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
							
                        </select>
                    
					</div>
					</div>
								
                               <div class="col-sm-offset-3 col-sm-8">
                                    <button type="submit" id="sbtn" class="btn btn-primary"><?php echo!empty($user_type_detail->user_id) ? '更新' : '创建' ?></button>
                                </div>

                            </div>
                         <!--   <div class="col-sm-6">

                                <div class="list-group">
                                    <a href="#" class="list-group-item disabled">
                                        User Permission Level
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="k-header">
                                            <div class="box-col">
                                                <div id="treeview"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>-->
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>  
<!--
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
                              id: "", text: "<?php echo $sub_chld_name;?>",<?php if(!empty($roll[$sub_chld_id])){echo $roll[$sub_chld_id] ?'check: "checked",':'' ;} ?> value: "<?php if(!empty ($sub_chld_id)){ echo $sub_chld_id;}?>",  
                            },  
                            <?php endforeach;?>
                       ]     
                    },                        
                    <?php endforeach;?>   
                    <?php else:?>
                        {
                        id: "", text: "<?php echo $child;?>", <?php if(!is_array($v_sub_child)){if(!empty($roll[$v_sub_child])){echo $roll[$v_sub_child] ?'check: "checked",':'' ;}} ?> value: "<?php if(!empty ($v_sub_child)){ echo $v_sub_child;}?>",
                    },
                    <?php endif;?>
                   <?php endforeach;?>         
                ]
            },                        
            <?php endforeach;?>
            <?php else: ?>                
                  {
                        id: "", text: "<?php echo $parent?>", <?php if(!is_array($v_parent)){if(!empty($roll[$v_parent])){echo $roll[$v_parent] ?'check: "checked",':'' ;}} ?> value: "<?php if(!is_array($v_parent)) {echo $v_parent;}?>"
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

-->