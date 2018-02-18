<div class="col-md-12">

    <div class="panel panel-info">
        <!-- Default panel contents -->

        <div class="panel-heading">
            <div class="panel-title">                 
                <strong>Award Details</strong><span class="pull-right"><a onclick="history.go(-1);" class="view-all-front">Go Back</a></span>
            </div>                    
        </div>    
        <div class="panel-body form-horizontal">
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Award Name:</strong></label>
                </div>                    
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($employee_award_info->employee_award_id)) echo $employee_award_info->award_name; ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Employee:</strong></label>
                </div>                    
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($employee_award_info->employee_award_id)) echo $employee_award_info->first_name . " " . $employee_award_info->last_name; ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Designation:</strong></label>
                </div>                    
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($employee_award_info->employee_award_id)) echo $employee_award_info->department_name . " - " .$employee_award_info->designations; ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Gift Item:</strong></label>
                </div>                    
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($employee_award_info->employee_award_id)) echo $employee_award_info->gift_item; ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Designation:</strong></label>
                </div>                    
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($employee_award_info->employee_award_id)) echo $employee_award_info->award_amount; ?></p>
                </div>
            </div>
                        
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Award Date:</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><span class="text-danger"><?php if (!empty($employee_award_info->employee_award_id)) echo date('d M Y', strtotime($employee_award_info->award_date)); ?></span></p>
                </div>                                              
            </div>

        </div>                
    </div>
</div>






