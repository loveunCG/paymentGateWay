<div class="col-md-12">
    <div class="wrap-fpanel">
        <div class="panel panel-default">
            <!-- Default panel contents -->

            <div class="panel-heading">
                <div class="panel-title">                 
                    <strong>通知詳情</strong><span class="pull-right"><a style="cursor: pointer"onclick="history.go(-1)" class="view-all-front">回去</a></span>
                </div>                    
            </div>    
            <div class="panel-body form-horizontal">
                <div class="col-md-12 notice-details-margin">
                    <div class="col-sm-4 text-right">
                        <label class="control-label"><strong>標題:</strong></label>
                    </div>                    
                    <div class="col-sm-8">
                        <p class="form-control-static"><?php if (!empty($full_notice_details->notice_id)) echo $full_notice_details->title; ?></p>
                    </div>
                </div>
                <div class="col-md-12 notice-details-margin">
                    <div class="col-sm-4 text-right">
                        <label class="control-label"><strong>簡短的介紹:</strong></label>
                    </div>
                    <div class="col-sm-8">
                        <p class="form-control-static text-justify"><?php if (!empty($full_notice_details->notice_id)) echo $full_notice_details->short_description; ?></p>
                    </div>
                </div>
                <div class="col-md-12 notice-details-margin">
                    <div class="col-sm-4 text-right" style="margin-top: 8px;">
                        <label class="control-label"><strong>詳細描述:</strong></label>
                    </div>
                    <div class="col-sm-8">
                        <p class="form-control-static text-justify"><?php if (!empty($full_notice_details->notice_id)) echo $full_notice_details->long_description; ?></p>
                    </div>                  
                </div>
                <div class="col-md-12 notice-details-margin">
                    <div class="col-sm-4 text-right">
                        <label class="control-label"><strong>發布日期:</strong></label>
                    </div>
                    <div class="col-sm-8">
                        <p class="form-control-static"><span class="text-danger"><?php if (!empty($full_notice_details->notice_id)) echo $full_notice_details->created_date; ?></span></p>
                    </div>                                              
                </div>

            </div>                
        </div>
    </div>
</div>






