
<div class="col-sm-12" data-offset="0">                            
    <div class="panel panel-default">
        <!-- Default panel contents -->

        <div class="panel-heading">
            <div class="panel-title">                 
                <strong>Notice Details</strong>
            </div>                    
        </div>    
        <div class="panel-body form-horizontal">
            <div class="col-sm-4">
                <label class="control-label"><strong>Title:</strong></label>
            </div>                    
            <div class="col-sm-8">
                <p class="form-control-static"><?php echo $notice->title; ?></p>
            </div>
            <div class="col-sm-4">
                <label class="control-label"><strong>Long Descriontion:</strong></label>
            </div>
            <div class="col-sm-8">
                <p class="form-control-static"><?php echo $notice->long_description ?></p>
            </div>                  
            <div class="col-sm-4">
                <label class="control-label"><strong>Published Date:</strong></label>
            </div>
            <div class="col-sm-8">
                <p class="form-control-static"><span class="text-danger"><?php echo $notice->created_date ?></span></p>
            </div>                  
        </div>                
    </div>
</div>
