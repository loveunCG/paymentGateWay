
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">
    <div class="col-sm-12"> 
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php
                        echo $this->language->form_heading()[3]
                        ?></strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form" action="<?php echo base_url() ?>admin/settings/save_leave_category/<?php
                    if (!empty($leave_category->leave_category_id)) {
                        echo $leave_category->leave_category_id;
                    }
                    ?>" method="post" class="form-horizontal form-groups-bordered">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[4][0] ?> <span class="required">*</span></label>
                            <div class="col-sm-5">                            
                                <input type="text" name="category" value="<?php
                                if (!empty($leave_category->category)) {
                                    echo $leave_category->category;
                                }
                                ?>" class="form-control" placeholder="Enter Your leave Category Name" />
                            </div>
                        </div>
						<div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[4][2] ?> <span class="required">*</span></label>

                            <div class="col-sm-8">                            
                                <div class="col-sm-2"><input type="radio" <?php if(!empty($leave_category->leave_type) && $leave_category->leave_type == 1) echo "checked"; ?> name="leave_type" value="1" id="leave_type" /> Paid</div>
								<div class="col-sm-2"><input type="radio" <?php if(!empty($leave_category->leave_type) && $leave_category->leave_type == 2) echo "checked"; ?> name="leave_type" value="2" id="leave_type"/> Unpaid</div>
                            </div>
						</div>
						<div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo "Paid Leave Amount" ?> <span class="required">*</span></label>
                            <div class="col-sm-5">                            
                                <input type="text" name="leave_amount" value="<?php
                                if (!empty($leave_category->leave_amount)) {
                                    echo $leave_category->leave_amount;
                                }
                                ?>" class="form-control" placeholder="Paid leave amount" />
                            </div>
                        </div>
							
						<div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" id="sbtn" name="sbtn" value="1" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>
                                </div>
                            </div>
                    </form>
                </div>                 
            </div>                 
        </div>  
        <br/>

        <div class="row">
            <div class="col-sm-12" data-offset="0">                            
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><?php echo $this->language->from_body()[4][1] ?></strong>
                        </div>
                    </div>

                    <!-- Table -->
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-1">SL</th>
                                <th>Category Name</th>
								<th>Leave Type</th>
								<th>Paid Leave Amount</th>
                                <th class="col-sm-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $key = 1 ?>
                            <?php if (!empty($all_leave_category_info)): foreach ($all_leave_category_info as $v_category) : ?>
                                    <tr>
                                        <td><?php echo $key ?></td>
                                        <td><?php echo $v_category->category; ?></td>
										<td><?php if($v_category->leave_type == '1') {echo "Paid" ;} elseif($v_category->leave_type == '2') {echo "Unpaid"; } ?></td>
										<td><?php echo $v_category->leave_amount; ?></td>
										<td>
                                            <?php echo btn_edit('admin/settings/leave_category/' . $v_category->leave_category_id); ?>  
                                            <?php echo btn_delete('admin/settings/delete_leave_category/' . $v_category->leave_category_id); ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $key++;
                                endforeach;
                                ?>
                            <?php else : ?>
                            <td colspan="3">
                                <strong>There is no data to display</strong>
                            </td>
                        <?php endif; ?>
                        </tbody>
                    </table>          
                </div>
            </div>
        </div>
    </div>   
</div>
<script>
function Validate(){
    if($('.attrInputs:checked').length == 0)
        alert('Please Select Leave Type!');
}
</script>