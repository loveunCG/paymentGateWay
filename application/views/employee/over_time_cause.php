
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12" data-offset="0">    
			
            <div class="panel panel-info">
                <!-- Default panel contents -->
				<form role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>employee/dashboard/save_over_time_cause/" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row"><br />
                            <div class="col-sm-12 form-groups-bordered">                                
                                <input type="hidden" name="employeeId" value="<?php echo $this->uri->segment(4);?>"/>
								<input type="hidden" name="overtimeDate" value="<?php echo $this->uri->segment(5);?>"/>
								<div class="form-group">
                                        <label for="field-1" class="col-sm-3 control-label">Reason</label>

                                        <div class="col-sm-5">
                                            <textarea id="present" name="reason" class="form-control" rows="6"></textarea>
                                        </div>
                                    </div> 
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5">
                                        <button id="submit" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>          
            </div>
        </div>
    </div>        
</div>