
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12">  
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[9] ?></strong>
                    </div>
                </div>
                <div class="panel-body">

                    <form  id="form_validation" action="<?php echo base_url() ?>admin/department/save_department/<?php
                    if (!empty($department_info->department_id)) {
                        echo $department_info->department_id;
                    }
                    ?>" method="post" class="form-horizontal form-groups-bordered">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][0] ?> <span class="required"> *</span></label>

                            <div class="col-sm-5">                            
                                <input type="text" name="department_name" value="<?php
                                if (!empty($department_info->department_name)) {
                                    echo $department_info->department_name;
                                }
                                ?>" class="form-control" placeholder="Enter Your Department Name" required/>
                            </div>                           
                        </div>
                        <div id="add_new" class="margin">
                            <?php if (!empty($designation_info)): foreach ($designation_info as $v_designation) : ?>
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][1] ?> <span class="required"> *</span></label>

                                        <div class="col-sm-5">                            
                                            <input type="text" name="designations[]" value="<?php
                                            if (!empty($v_designation->designations)) {
                                                echo $v_designation->designations;
                                            }
                                            ?>" class="form-control" placeholder="Enter Your Designations"/>
                                        </div>                                                      
                                        <div class="col-sm-2">                            
                                            <?php echo btn_delete('admin/department/delete_designation/' . $v_designation->department_id . '/' . $v_designation->designations_id); ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="designations_id[]" value="<?php
                                    if (!empty($v_designation->designations_id)) {
                                        echo $v_designation->designations_id;
                                    }
                                    ?>" class="form-control" placeholder="Enter Your Designations"/>                                    
                                       <?php endforeach; ?>
                                <div class="col-sm-offset-8">                            
                                    <strong><a href="javascript:void(0);" id="add_more" class="addCF "><i class="fa fa-plus"></i>&nbsp;Add More</a></strong>
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][1] ?> <span class="required"> *</span></label>

                                    <div class="col-sm-5">                            
                                        <input type="text" name="designations[]" value="" class="form-control" placeholder="Enter Your Designations"/>
                                    </div>                           
                                    <div class="col-sm-2">                            
                                        <strong><a href="javascript:void(0);" id="add_more" class="addCF "><i class="fa fa-plus"></i>&nbsp;Add More</a></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group margin">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>                            
                            </div>
                        </div>
                    </form>
                </div>                 
            </div>                 
        </div>          
    </div>   
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var maxAppend = 0;
        $("#add_more").click(function() {
            if (maxAppend >= 9)
            {
                alert("Maximum 10 File is allowed");
            } else {
                var add_new = $('<div class="form-group">\n\
                <label for="field-1" class="col-sm-3 control-label">Add Designations <span class="required"> *</span></label>\n\
                    <div class="col-sm-5">\n\<input type="text" name="designations[]" value="<?php ?>" class="form-control" placeholder="Enter Your Designations"/>\n\
    </div>\n\
    <div class="col-sm-2">\n\
    <strong><a href="javascript:void(0);" class="remCF"><i class="fa fa-times"></i>&nbsp;Remove</a></strong>\n\
    </div>');
                maxAppend++;
                $("#add_new").append(add_new);
            }
        });

        $("#add_new").on('click', '.remCF', function() {
            $(this).parent().parent().parent().remove();
        });
    });
</script>