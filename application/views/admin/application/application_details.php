<div class="col-md-12">
    <div class="wrap-fpanel">
        <div class="panel panel-default">
            <!-- Default panel contents -->

            <div class="panel-heading">
                <div class="panel-title">                 
                    <strong>Leave Application  Details</strong><span class="pull-right"><a style="cursor: pointer"onclick="history.go(-1)" class="view-all-front">Go Back</a></span>
                </div>                    
            </div>    
            <form method="post" action="<?php echo base_url() ?>admin/application_list/set_action/<?php echo $application_info->application_list_id ?>"
                  <div class="panel-body form-horizontal">
                    <div class="col-md-12">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>Name : </strong></label>
                        </div>                    
                        <div class="col-sm-8">
                            <p class="form-control-static"><?php echo $application_info->first_name . ' ' . $application_info->last_name; ?></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>Leave Date : </strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static text-justify"><?php
                                if ($application_info->leave_start_date == $application_info->leave_end_date) {
                                    echo date('d M y', strtotime($application_info->leave_start_date));
                                } else {
                                    echo date('d M y', strtotime($application_info->leave_start_date)) . '<span class="text-danger"> To </span>' . date('d M y', strtotime($application_info->leave_end_date));
                                }
                                ?></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>Leave Type :</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static text-justify"><?php echo $application_info->category; ?></p>
                        </div>                  
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>Apply On : </strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static"><span class="text-danger"><?php echo date('d M y', strtotime($application_info->application_date)); ?></span></p>
                        </div>                                              
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>Reason : </strong></label>
                        </div>
                        <div class="col-sm-8">
                            <p class="form-control-static"><?php echo $application_info->reason; ?></p>
                        </div>                                              
                    </div>
                    <div class="col-md-12 margin">
                        <div class="col-sm-4 text-right">
                            <label class="control-label"><strong>Action : </strong></label>
                        </div>
                        <div class="col-sm-2">                        
                            <select class="form-control" name="application_status">
                                <option value="1" <?php echo $application_info->application_status == 1 ? 'selected' : '' ?>> Pending </option>
                                <option value="2" <?php echo $application_info->application_status == 2 ? 'selected' : '' ?>> Accept </option>
                                <option value="3" <?php echo $application_info->application_status == 3 ? 'selected' : '' ?>> Reject </option>
                            </select>                        
                        </div>                                              
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-4">
                            <!-- Hidden Input ---->
                            <input type="hidden" name="employee_id" value="<?php echo $application_info->employee_id; ?>">
                            <input type="hidden" name="leave_category_id" value="<?php echo $application_info->leave_category_id; ?>">
                            <input type="hidden" name="leave_start_date" value="<?php echo $application_info->leave_start_date; ?>">
                            <input type="hidden" name="leave_end_date" value="<?php echo $application_info->leave_end_date; ?>">
                        </div>
                        <div class="col-sm-4 margin">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>                                                                
                    </div>

                </div>                
        </div>
    </div>
</div>






