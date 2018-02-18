<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12"> 
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $title ;?></strong>                    
                    </div>                
                </div>
                <div class="panel-body">

                    <form id="set_working_days" action="<?php echo base_url(); ?>admin/settings/save_payment_date/<?php if (!empty($id)) { echo $id; } ?>" method="post"  class="form-horizontal form-groups-bordered"  onsubmit="return validation(this)">                                                           
                        <div class="form-group">
                           

														
							<div class="form-group">
                                    <label class="col-sm-3 control-label">Set payment date for monthly<span class="required">*</span></label>
                                    <div class="input-group col-sm-6">
                                        <input type="text"  value="<?php
                                        if (!empty($monthly_payment_date)) {
                                            echo $monthly_payment_date;
                                        }
                                        ?>" class="form-control" id="monthly_payment_date" name="monthly_payment_date"  >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Set payment date for bi-monthly <span class="required">*</span></label>
                                    <div class="input-group col-sm-6">
                                        <input type="text"  value="<?php
                                        if (!empty($bi_monthly_payment_date1)) {
                                            echo $bi_monthly_payment_date1;
                                        }
                                        ?>" class="form-control" id="bi_monthly_payment_date1" name="bi_monthly_payment_date1" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
										
										<input type="text" style="margin-left:10px"  value="<?php
                                        if (!empty($bi_monthly_payment_date2)) {
                                            echo $bi_monthly_payment_date2;
                                        }
                                        ?>" class="form-control" id="bi_monthly_payment_date2" name="bi_monthly_payment_date2" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>		
							
							<div class="form-group">
                                    <label class="col-sm-3 control-label">Set payment date for two weekly<span class="required">*</span></label>
                                    <div class="input-group col-sm-6">
                                      										
										
									<!--	<input type="text"  value="<?php
                                        if (!empty($two_weekly_payment_date1)) {
                                            echo $two_weekly_payment_date1;
                                        }
                                        ?>" class="form-control" id="two_weekly_payment_date1" name="two_weekly_payment_date1" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
										
										<input type="text" style="margin-left:10px"  value="<?php
                                        if (!empty($two_weekly_payment_date2)) {
                                            echo $two_weekly_payment_date2;
                                        }
                                        ?>" class="form-control" id="two_weekly_payment_date2" name="two_weekly_payment_date2" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>-->
										<?php 
                                $this->load->model("settings_model");
                                $week_working_days_result=$this->settings_model->get_working_week_days();
                                ?>
                                
                                
                                <select name="two_weekly_payment_date" id="two_weekly_payment_date" class="form-control">                            
								   <!--change by @p.p Department-->
									<option value="">Select Payment Day.....</option>
									<?php if (!empty($week_working_days_result)): 
											foreach ($week_working_days_result as $key => $value) : ?>
											<?php if (!empty($value)): ?>
												
														<option value="<?php echo $value->working_days_id; ?>" 
														<?php
														if (!empty($two_weekly_payment_date)) {
															echo $value->working_days_id == $two_weekly_payment_date ? 'selected' : '';
														}
														?>
														>
															<?php echo $value->day ?>
														</option>                            
														
											<?php endif; ?>                            
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Set payment date for weekly <span class="required">*</span></label>
                                    <div class="input-group col-sm-6">
                                       <!-- <input type="text"  value="<?php
                                        if (!empty($weekly_payment_date)) {
                                            echo $weekly_payment_date;
                                        }
                                        ?>" class="form-control" id="weekly_payment_date" name="weekly_payment_date" >
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>-->
										
                                
                                
                                <select name="weekly_payment_date" id="weekly_payment_date" class="form-control">                            
								   <!--change by @p.p Department-->
									<option value="">Select Payment Day.....</option>
									<?php if (!empty($week_working_days_result)): 
											foreach ($week_working_days_result as $key => $value) : ?>
											<?php if (!empty($value)): ?>
												
														<option value="<?php echo $value->working_days_id; ?>" 
														<?php
														if (!empty($weekly_payment_date)) {
															echo $value->working_days_id == $weekly_payment_date ? 'selected' : '';
														}
														?>
														>
															<?php echo $value->day ?>
														</option>                            
														
											<?php endif; ?>                            
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
                                    </div>
                                </div>	
                                <input type="hidden" value="<?php echo $this->session->userdata('id_gsettings'); ?>" name="id_gsettings" id="id_gsettings" >
                                
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button class="btn btn-primary" id="sbtn" type="submit"><?php echo $this->language->from_body()[1][12] ?></button>                            
								</div>
							</div>
							
                            
                        </div> 
                    </form>
                </div>            
            </div>          
        </div>          

    </div>   
</div>

<script type="text/javascript">
    $(document).on("change", function() {
        var fine = 0;
        fine = $("#fine_deduction").val();
        var net_salary = $("#net_salary").val();
        var total = net_salary - fine;
        $("#payment_amount").val(total);
		
    });
    
	$(function(){
		$('#monthly_payment_date').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});
		
		$('.input-daterange input').each(function() {
			$(this).datepicker("clearDates");
		});
		
		$('#bi_monthly_payment_date1').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});		
		
		/*$('#two_weekly_payment_date1').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});*/
		
		$('#bi_monthly_payment_date2').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});		
		
		/*$('#two_weekly_payment_date2').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd"
		});*/
		
		/*$('#weekly_payment_date').datepicker({
			autoclose: true,
			//format: "yyyy-mm-dd"
			
			minDate: 0, // your min date
			maxDate: '+1w', // one week will always be 5 business day - not sure if you are including current day
			//beforeShowDay: $.datepicker.noWeekends // disable weekends
			
		});		
		    
		$("#weekly_payment_date").change(function(){
			$('#edate').datepicker('clearDates');
			$('#edate').datepicker('remove');
			
			$('#edate').datepicker({
				autoclose: true,
				format: "yyyy-mm-dd",
				startDate:$("#weekly_payment_date").val()
			});
		});*/
		$("#edate").change(function(){
			$('#sdate').datepicker('clearDates');
			$('#sdate').datepicker('remove');
			
			$('#sdate').datepicker({
				autoclose: true,
				format: "yyyy-mm-dd",
				endDate:$("#edate").val()
			});
		});
		
	});
</script> 
