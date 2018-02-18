<?php include_once 'asset/admin-ajax.php'; ?>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="wrap-fpanel">
                <div class="panel panel-default" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong><?php
                        echo $this->language->form_heading()[32]; 
                        ?></strong>
                        </div>                
                    </div>
                    <div class="panel-body">                                
                        <form id="form" action="<?php echo base_url(); ?>admin/payroll/save_ethnic/<?php
                        if (!empty($ethnic_info->id)) {
                            echo $ethnic_info->id;
                        }
                        ?>" method="post" class="form-horizontal form-groups-bordered">                       
                                                        
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Title<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control" name="name" value="<?php
                                    if (!empty($ethnic_info->name)) {
                                        echo $ethnic_info->name;
                                    }
                                    ?>" >
									
                                </div>
                            </div>    
							<div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Description<span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" required class="form-control" name="description" value="<?php
                                    if ($ethnic_info->description) {
                                        echo $ethnic_info->description;
                                    }
                                    ?>" >
									
                                </div>
                            </div>
														
							<div class="form-group">
                                 <label class="control-label col-md-3">Fund Details</label>
									<div class="col-sm-5">
								 <table  class="table table-hover small-text" id="tb">
									 <tr class="tr-header">
										  <th>Min Wage</th>
										  <th>Max Wage</th>
										  <th>Monthly Contribution</th>
										  <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore"><span class="glyphicon glyphicon-plus"> </span></a></th>
										  </tr>
										  <?php if(!empty($fund))
										  { 
										  foreach($fund as $fun){
										  ?>
										  <tr>
										  <td><input type="text" required name="min_wage[]" class="form-control" id="min_wage" value="<?php echo $fun->min_wage;?>"/> </td>
										  <td><input type="text" required name="max_wage[]" class="form-control"  id="max_wage" value="<?php echo $fun->max_wage;?>"/> </td>
										  <td><input type="text" required name="monthly_contribution[]" class="form-control" id="monthly_contribution" value="<?php echo $fun->monthly_contribution;?>"/> </td>
										  <th><a href='javascript:void(0);' style="font-size:18px;" class='remove'><span class='glyphicon glyphicon-remove'> </span></a></th>
									 </tr><?php } }?>
									 <tr>
										  <td><input type="text" required name="min_wage[]" class="form-control" id="min_wage" value="<?php if($fund->min_wage){echo $fund->min_wage;}?>"/> </td>
										  <td><input type="text" required name="max_wage[]" class="form-control"  id="max_wage" value="<?php if($fund->max_wage){echo $fund->max_wage;}?>"/> </td>
										  <td><input type="text" required name="monthly_contribution[]" class="form-control" id="monthly_contribution" value="<?php if($fund->monthly_contribution){echo $fund->monthly_contribution;}?>"/> </td>
										  <th><a href='javascript:void(0);' style="font-size:18px;" class='remove'><span class='glyphicon glyphicon-remove'> </span></a></th>
									 </tr>
								 </table>
								 </div>
								</div>
							  
                            <div class="form-group margin">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" id="sbtn" class="btn btn-primary"><?php echo!empty($calendar_details->year) ? 'Update' : 'Save' ?></button>                            
                                </div>
                            </div>
                    </div>           
                    </form>
                </div>
            </div>        
        </div>            
    </div> 
	
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
<script>
$(function(){
    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});      
</script>
