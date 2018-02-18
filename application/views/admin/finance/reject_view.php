<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


		<?php //print_r($this->language->form_body()[10][7])?>
        <div class="col-md-12">
            <div class="tab-content">
                <div>
                        <div class="wrap-fpanel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><i class="fa fa-minus-square"></i> 拒绝视图</strong>
                                    </div>                                    

                                </div>                    
                        <form role="form" id="general_settings" enctype="multipart/form-data" onsubmit="return validation()" action="<?php echo base_url(); ?>admin/finance/reject_request" method="post" class="form-horizontal form-groups-bordered">
								<div class="row">
									 <div class="col-md-12">
									 <div class="form-group"></div>
									 <div class="form-group">
 	                                    <label for="field-1" class="col-sm-1 control-label">拒绝理由:</label>
                                    	<div class="col-md-4">
			                            <input type="text" class="form-control" name="reason" id="reason" >			      
                                <input type="radio" name="pay_mode" value="1" id="usr_status"> 直接拒绝
                                <input type="radio" name="pay_mode" value="2" id="usr_status">拒绝并不退款
			                            <input type="hidden" name="std" value="<?php echo $std?>" />
	                                     </div>
	                                     <button type="submit" id="sbtn" class="btn btn-primary" id="i_submit" >提交</button><br><br>	
									 </div>

									</div>
									</div>
						</form>
                            </div>
                        </div>
                    </div>                           
            </div>


<script type="text/javascript">

    function validation()
    {
        var reason = $('#reason').val(); 

        if (reason=='') {          
            document.getElementById("reason").focus();
            return false;
        }       
        
    }
</script>               
        </div>
    </div>
 