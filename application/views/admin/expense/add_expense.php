<?php include_once 'asset/admin-ajax.php'; ?>
<div class="row">
    <div class="col-sm-12 wrap-fpanel">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?php echo $this->language->form_heading()[21] ?></strong>
                </div>
            </div>
            <div class="panel-body">

                <form role="form" id="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/expense/save_expense/<?php
                if (!empty($expense_info->expense_id)) {
                    echo $expense_info->expense_id;
                }
                ?>" method="post" class="form-horizontal form-groups-bordered">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[22][0] ?>  <span class="required">*</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="item_name" placeholder="Enter Item Name"  class="form-control" id="field-1" value="<?php
                            if (!empty($expense_info->item_name)) {
                                echo $expense_info->item_name;
                            }
                            ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[22][1] ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="purchase_from" class="form-control" placeholder="Enter Purchased From" value="<?php
                            if (!empty($expense_info->purchase_from)) {
                                echo $expense_info->purchase_from;
                            }
                            ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[22][2] ?> <span class="required">*</span></label>

                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" name="purchase_date"  placeholder=" Enter Purchase Date"  class="form-control datepicker" value="<?php
                                if (!empty($expense_info->purchase_date)) {
                                    echo $expense_info->purchase_date;
                                }
                                ?>" data-format="dd-mm-yyyy">
                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[22][3] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <input type="text" name="amount" class="form-control" placeholder="Enter Amount" value="<?php
                            if (!empty($expense_info->amount)) {
                                echo $expense_info->amount;
                            }
                            ?>" ><span class="g-email-error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[22][4] ?> <span class="required"> *</span></label>

                        <div class="col-sm-5">
                            <select class="form-control select_box" name="employee_id" >
                                <option value="">Select Employee...</option>
                                <?php if (!empty($employee_info)): ?>
                                    <?php foreach ($employee_info as $v_employee): ?>                                                                    
                                        <option value="<?php echo $v_employee->employee_id ?>" <?php
                                        if (!empty($expense_info->employee_id)) {
                                            $v_employee->employee_id == $expense_info->employee_id ? 'selected' : '';
                                        }
                                        ?>><?php echo $v_employee->first_name . ' ' . $v_employee->last_name ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[22][5] ?></label>
                        <input type="hidden" name="bill_copy_path" value="<?php
                        if (!empty($expense_info->bill_copy_path)) {
                            echo $expense_info->bill_copy_path;
                        }
                        ?>">
                        <div class="col-sm-5">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <?php if (!empty($expense_info->bill_copy)): ?>
                                    <span class="btn btn-default btn-file"><span class="fileinput-new" style="display: none" >Select file</span>
                                        <span class="fileinput-exists" style="display: block">Change</span>
                                        <input type="hidden" name="bill_copy" value="<?php echo $expense_info->bill_copy ?>">
                                        <input type="file" name="bill_copy" >
                                    </span>                                    
                                    <span class="fileinput-filename"> <?php echo $expense_info->bill_copy_filename ?></span>                                          
                                <?php else: ?>
                                    <span class="btn btn-default btn-file"><span class="fileinput-new" >Select file</span>
                                        <span class="fileinput-exists" >Change</span>                                            
                                        <input type="file" name="bill_copy" >
                                    </span> 
                                    <span class="fileinput-filename"></span>                                        
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>                                                                                                            
                                <?php endif; ?>

                            </div>  
                            <div id="msg_pdf" style="color: #e11221"></div>
                        </div>                    
                    </div>                    

                    <div class="form-group margin-top">
                        <label for="field-1" class="col-sm-3 control-label"></label>
                        <div class="col-sm-5">
                            <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo base_url() ?>asset/css/select2.css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>asset/js/select2.js"></script>