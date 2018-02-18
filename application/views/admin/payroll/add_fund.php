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
									echo $this->language->form_heading()[31]; 
									?></strong>
									</div>                
								</div>
								<div class="panel-body">                                
									<form id="form" action="<?php echo base_url(); ?>admin/payroll/save_fund/<?php echo $id; ?>/<?php echo $editId; ?>" method="post" class="form-horizontal form-groups-bordered">                       
										
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][12] ?><span class="required">*</span></label>
											<div class="col-sm-5">
												<select name="fund"  class="form-control col-sm-5"  id="field-1" onchange="call(this.value)" required>
										<option value="" >Select Fund...</option>
											<?php foreach ($ethnic_info as $info) : ?>
	                                <option value="<?php echo $info['id']; ?>" <?php
	                                if ($info['id']==$id) {
	                                    echo 'selected';
	                                }
	                                ?>><?php echo $info['name'] ?></option>
	                                    <?php endforeach; ?>
									</select> 
																   
											</div>
										</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][9] ?><span class="required">*</span></label>
											<div class="col-sm-5">
												<select name="monthly_wage"  class="form-control col-sm-5" id="field-1" required>
										<option value="" >Select Wages...</option>
										<?php if($id == '1'){?>
										<option <?php if($fund->monthly_wage=='<=$2000')echo selected; ?> value="<?php echo "<=$2000"; ?>" > <=$2000 </option>
										<option <?php if($fund->monthly_wage=='>$2000 to $3500')echo selected; ?> value="<?php echo ">$2000 to $3500"; ?>" > >$2000 to $3500</option>
										<option <?php if($fund->monthly_wage=='>$3500 to $5000')echo selected; ?> value="<?php echo ">$3500 to $5000"; ?>" > >$3500 to $5000</option>
										<option <?php if($fund->monthly_wage=='>$5000 to $7500')echo selected; ?> value="<?php echo ">$5000 to $7500"; ?>" > >$5000 to $7500</option>
										<option <?php if($fund->monthly_wage=='>$7500')echo selected; ?> value="<?php echo ">$7500"; ?>" > >$7500</option>
										<?php } ?>
										<?php if($id == '2'){?>
										<option <?php if($fund->monthly_wage=='<=$1000')echo selected; ?> value="<?php echo "<=$1000"; ?>" > <=$1000 </option>
										<option <?php if($fund->monthly_wage=='>$1000 to $1500')echo selected; ?> value="<?php echo ">$1000 to $1500"; ?>" > >$1000 to $1500</option>
										<option <?php if($fund->monthly_wage=='>$1500 to $2500')echo selected; ?> value="<?php echo ">$1500 to $2500"; ?>" > >$1500 to $2500</option>
										<option <?php if($fund->monthly_wage=='>$2500 to $4000')echo selected; ?> value="<?php echo ">$2500 to $4000"; ?>" > >$2500 to $4000</option>
										<option <?php if($fund->monthly_wage=='>$4000 to $7000')echo selected; ?> value="<?php echo ">$4000 to $7000"; ?>" > >$4000 to $7000</option>
										<option <?php if($fund->monthly_wage=='>$7000 to $10000')echo selected; ?> value="<?php echo ">$7000 to $10000"; ?>" > >$7000 to $10000</option>
										<option <?php if($fund->monthly_wage=='>$10000')echo selected; ?> value="<?php echo ">$10000"; ?>" > >$10000</option>
										<?php } ?>
										<?php if($id == '3'){?>
										<option <?php if($fund->monthly_wage=='<=$200')echo selected; ?> value="<?php echo "<=$200"; ?>" > <=$200 </option>
										<option <?php if($fund->monthly_wage=='$200 to $1000')echo selected; ?> value="<?php echo ">$200 to $1000"; ?>" > >$200 to $1000</option>
										<option <?php if($fund->monthly_wage=='>$1000 to $2000')echo selected; ?> value="<?php echo ">$1000 to $2000"; ?>" > >$1000 to $2000</option>
										<option <?php if($fund->monthly_wage=='>$2000 to $3000')echo selected; ?> value="<?php echo ">$2000 to $3000"; ?>" > >$2000 to $3000</option>
										<option <?php if($fund->monthly_wage=='>$3000 to $4000')echo selected; ?> value="<?php echo ">$3000 to $4000"; ?>" > >$3000 to $4000</option>
										<option <?php if($fund->monthly_wage=='>$4000')echo selected; ?> value="<?php echo ">$4000"; ?>" > >$4000</option>
										<?php } ?>
										<?php if($id == '4'){?>
										<option <?php if($fund->monthly_wage=='<=$1000')echo selected; ?> value="<?php echo "<=$1000"; ?>" > <=$1000 </option>
										<option <?php if($fund->monthly_wage=='>$1000 to $1500')echo selected; ?> value="<?php echo ">$1000 to $1500"; ?>" > >$1000 to $1500</option>
										<option <?php if($fund->monthly_wage=='>$1500 to $2500'){echo 'selected';} ?> value="<?php echo ">$1500 to $2500"; ?>" > >$1500 to $2500</option>
										<option <?php if($fund->monthly_wage=='$2500 to $4500')echo selected; ?> value="<?php echo ">$2500 to $4500"; ?>" > >$2500 to $4500</option>
										<option <?php if($fund->monthly_wage=='>$4500 to $7500')echo selected; ?> value="<?php echo ">$4500 to $7500"; ?>" > >$4500 to $7500</option>
										<option <?php if($fund->monthly_wage=='>$7500 to $10000')echo selected; ?> value="<?php echo ">$7500 to $10000"; ?>" > >$7500 to $10000</option>
										<option <?php if($fund->monthly_wage=='>$10000 to $15000')echo selected; ?> value="<?php echo ">$10000 to $15000"; ?>" > >$10000 to $15000</option>
										<option <?php if($fund->monthly_wage=='>$15000')echo selected; ?> value="<?php echo ">$15000"; ?>" > >$15000</option>
										<?php } ?>
									</select> 
															   
											</div>
										</div>
										<div class="form-group">
											<label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[10][11] ?><span class="required">*</span></label>
											<div class="col-sm-5">
												<input type="text" required class="form-control" name="monthly_contribution" value="<?php echo $fund->monthly_contribution;
											?>" >
												
											</div>
										</div>
										<div class="form-group margin">
											<div class="col-sm-offset-3 col-sm-5">
												<button type="submit" id="sbtn" class="btn btn-primary"><?php echo 'Save' ?></button>                            
											</div>
										</div>
										</form>
								</div>           
								
							</div>
						</div>        
					</div>
	</div> 
<script>
function call(id)
{
	window.location.href = '<?php echo base_url()?>admin/payroll/add_fund/'+id; 
}
	
</script>

