<div class="col-md-12">

    <div class="panel panel-info" style="margin-top: 5%;">
        <!-- Default panel contents -->

        <div class="panel-heading">
            <div class="panel-title">                 
                <strong公告详细信息n</strong><span class="pull-right"><a onclick="history.go(-1);" class="view-all-front">退出</a></span>
            </div>                    
        </div>    
        <div class="panel-body form-horizontal">
            <div class="col-md-12 ">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>节目:</strong></label>
                </div>                    
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($full_notice_details->notice_id)) echo $full_notice_details->title; ?></p>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>内容:</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static text-justify"><?php if (!empty($full_notice_details->notice_id)) echo $full_notice_details->short_description; ?></p>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="col-sm-4 text-right" style="margin-top: 8px;">
                    <label class="control-label"><strong>详细内容</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static text-justify"><?php if (!empty($full_notice_details->notice_id)) echo $full_notice_details->long_description; ?></p>
                </div>                  
            </div>
            <div class="col-md-12 ">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong>发泼日期</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><span class="text-danger"><?php if (!empty($full_notice_details->notice_id)) echo $full_notice_details->created_date; ?></span></p>
                </div>                                              
            </div>

        </div>                
    </div>
</div>






