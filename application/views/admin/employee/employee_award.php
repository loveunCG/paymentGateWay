<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[13] ?></strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="form" action="<?php echo base_url() ?>admin/employee/save_employee_award/<?php
                    if (!empty($award_info->employee_award_id)) {
                        echo $award_info->employee_award_id;
                    }
                    ?>" method="post"  enctype="multipart/form-data" class="form-horizontal">
                        <div class="panel_controls">
                            <div class="form-group" id="border-none">
								 <!--change by @p.p single-->
                                <label for="field-1" class="col-sm-3 control-label"><?php echo "Departments";//$this->language->from_body()[14][0] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="designations_id" class="form-control" onchange="get_employee_by_designations_id(this.value)">                            
                                         <!--change by @p.p single-->
                                        <option value="">Select Departments.....</option>
                                        <?php if (!empty($all_department_info)): foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                                <?php if (!empty($v_department_info)): ?>
                                                    <optgroup label="<?php echo $dept_name; ?>">
                                                        <?php foreach ($v_department_info as $designation) : ?>
                                                            <option value="<?php echo $designation->designations_id; ?>" 
                                                            <?php
                                                            if (!empty($award_info->designations_id)) {
                                                                echo $designation->designations_id == $award_info->designations_id ? 'selected' : '';
                                                            }
                                                            ?>><?php echo $designation->designations ?></option>                            
                                                                <?php endforeach; ?>
                                                    </optgroup>
                                                <?php endif; ?>                            
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="border-none">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[14][1] ?> <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <select name="employee_id" id="employee" class="form-control" >
                                        <option value="">Select Employee...</option>  
                                        <?php if (!empty($employee_info)): ?>
                                            <?php foreach ($employee_info as $v_employee) : ?>
                                                <option value="<?php echo $v_employee->employee_id; ?>" 
                                                <?php
                                                if (!empty($award_info->employee_id)) {
                                                    echo $v_employee->employee_id == $award_info->employee_id ? 'selected' : '';
                                                }
                                                ?>><?php echo $v_employee->first_name . ' ' . $v_employee->last_name ?></option>                            
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[14][2] ?> <span class="required">*</span></label>

                                <div class="col-sm-5">
                                    <input type="text" name="award_name" class="form-control" value="<?php
                                    if (!empty($award_info->award_name)) {
                                        echo $award_info->award_name;
                                    }
                                    ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[14][3] ?></label>

                                <div class="col-sm-5">
                                    <input type="text" name="gift_item" class="form-control" value="<?php
                                    if (!empty($award_info->gift_item)) {
                                        echo $award_info->gift_item;
                                    }
                                    ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[14][4] ?></label>

                                <div class="col-sm-5">
                                    <input type="text" name="award_amount" class="form-control" value="<?php
                                    if (!empty($award_info->award_amount)) {
                                        echo $award_info->award_amount;
                                    }
                                    ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $this->language->from_body()[14][5] ?> <span class="required">*</span></label>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" name="award_date" placeholder="Enter Month"  class="form-control monthyear" value="<?php
                                        if (!empty($award_info->award_date)) {
                                            echo $award_info->award_date;
                                        }
                                        ?>" data-format="dd-mm-yyyy">
                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" id="sbtn" name="sbtn" value="1" class="btn btn-primary"><?php echo $this->language->from_body()[1][12] ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12" data-offset="0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <span>
                        <strong><?php echo $this->language->from_body()[14][6] ?></strong>
                    </span>
                </div>
            </div>
            <!-- Table -->

            <table class="table table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="col-sm-1">Emp ID</th>
                        <th>Employee Name</th>
                        <th>Award Name</th>
                        <th>Gift</th>
                        <th>Award Amount</th>
                        <th>Month</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($all_employee_award_info)):foreach ($all_employee_award_info as $v_award_info): ?>
                            <tr>
                                <td><?php echo $v_award_info->employment_id ?></td>
                                <td><?php echo $v_award_info->first_name . ' ' . $v_award_info->last_name; ?></td>
                                <td><?php echo $v_award_info->award_name; ?></td>
                                <td><?php echo $v_award_info->gift_item; ?></td>
                                <td><?php echo $v_award_info->award_amount; ?></td>
                                <td><?php echo date('F y', strtotime($v_award_info->award_date)) ?></td>
                                <td>
                                    <?php echo btn_edit('admin/employee/employee_award/' . $v_award_info->employee_award_id . '/' . $v_award_info->designations_id); ?>
                                    <?php echo btn_delete('admin/employee/delete_employee_award/' . $v_award_info->employee_award_id); ?>
                                </td>
                            </tr>                   
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
