<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">
    <div class="col-sm-12" data-offset="0">                            
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading" style="background: #466472;color: #FFFFFF;">
                <div class="panel-title">
                    <strong><?php echo $this->language->form_heading()[10] ?></strong>
                </div>
            </div>
            <?php if (!empty($all_department_info)): foreach ($all_department_info as $akey => $v_department_info) : ?>                                
                    <?php if (!empty($v_department_info)): ?>

                        <div class="panel-heading" >
                            <div class="panel-title">
                                <strong><?php echo $all_dept_info[$akey]->department_name ?>
                                    <div class="pull-right">
                                        <?php echo btn_edit('admin/department/add_department/' . $all_dept_info[$akey]->department_id); ?>  
                                        <a data-original-title="Delete" href="<?php echo base_url() ?>admin/department/delete_department/<?php echo $all_dept_info[$akey]->department_id; ?>" class="btn btn-danger btn-xs" title="" data-toggle="tooltip" data-placement="top" onclick="return confirm('You are about to delete This Department. All Designation Under This Department Will Be Deleted. Are you sure?');"><i class="fa fa-trash-o"></i> Delete</a>
                                    </div>
                                </strong>
                            </div>
                        </div>
                        <!-- Table -->                    
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="col-sm-1">SL</th>
                                    <th>Designations</th>
                                     <th>Quickbooks Class Name</th>                                             
                                </tr>
                            </thead>
                            <tbody>                                                        
                                <?php foreach ($v_department_info as $key => $v_department) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td style="width:350px;"><?php echo $v_department->designations;?></td> <td><?php echo $v_department->quickbooks_class_name; ?></td>                                                

                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            <?php endif; ?>                                    
                        </tbody>
                    </table> 
                    <?php
                endforeach;
                ?>
            <?php else : ?>
                <div class="panel-body">
                    <strong>There is no data to display</strong>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
