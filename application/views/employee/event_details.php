<div class="col-md-12">

    <div class="panel panel-info">
        <!-- Default panel contents -->

        <div class="panel-heading">
            <div class="panel-title">                 
                <strong>Event Details</strong><span class="pull-right"><a onclick="history.go(-1);" class="view-all-front">Go Back</a></span>
            </div>                    
        </div>    
        <div class="panel-body form-horizontal">
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Title:</strong></label>
                </div>                    
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($event_details->holiday_id)) echo $event_details->event_name; ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Description:</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static text-justify"><?php if (!empty($event_details->holiday_id)) echo $event_details->description; ?></p>
                </div>                  
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>Start Date:</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><span class="text-success"><?php if (!empty($event_details->holiday_id)) echo date('d M Y', strtotime($event_details->start_date)); ?></span></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>End Date:</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><span class="text-danger"><?php if (!empty($event_details->holiday_id)) echo date('d M Y', strtotime($event_details->end_date)); ?></span></p>
                </div>                  
            </div>


        </div>                
    </div>
</div>






