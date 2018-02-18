<div class="row">
    <div class="col-sm-12" data-spy="scroll" data-offset="0">                            
        <div class="panel panel-default">            
            <!-- main content -->
            <div class="panel-heading">
                <div class="row">
                    <div  class="col-lg-12 panel-title">
                        <h3 class="col-lg-4 col-md-4 col-sm-4">Employee Detail</h3>
                        <div class="pull-right">                               
                            <span><?php echo btn_edit('admin/employee/add_employee/' . $employee_info->employee_id); ?></span>
                            <span><?php echo btn_pdf('admin/employee/make_pdf/' . $employee_info->employee_id); ?></span>
                            <button class="margin btn-print" type="button" data-toggle="tooltip" title="Print" onclick="printDiv('printableArea')"><?php echo btn_print(); ?></button>                                                              
                        </div>
                    </div>
                </div>
            </div>
            <br />
			
            <div id="printableArea"> 
                <div class="show_print" style="width: 100%; border-bottom: 2px solid black;">
                    <table style="width: 100%; vertical-align: middle;">
                        <tr>
                            <?php
                            $genaral_info = $this->session->userdata('genaral_info');
                            if (!empty($genaral_info)) {
                                foreach ($genaral_info as $info) {
                                    ?>
                                    <td style="width: 75px; border: 0px;">
                                        <img style="width: 50px;height: 50px" src="<?php echo base_url() . $info->logo ?>" alt="" class="img-circle"/>
                                    </td>
                                    <td style="border: 0px;">
                                        <p style="margin-left: 10px; font: 14px lighter;"><?php echo $info->name ?></p>
                                    </td>
                                    <?php
                                }
                            } else {
                                ?>
                                <td style="width: 75px; border: 0px;">
                                    <img style="width: 50px;height: 50px" src="<?php echo base_url() ?>img/logo.png" alt="Logo" class="img-circle"/>
                                </td>
                                <td style="border: 0px;">
                                    <p style="margin-left: 10px; font: 14px lighter;">Human Resource Management System</p>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                    </table>
                </div><!--            show when print start-->
                <br/>
                <div class="col-lg-12 well">
                    <div class="row">                            
                        <div class="col-lg-2 col-sm-2">
                            <div class="fileinput-new thumbnail" style="width: 144px; height: 158px; margin-top: 14px; margin-left: 16px; background-color: #EBEBEB;">
                                <?php if ($employee_info->photo): ?>
                                    <img src="<?php echo base_url() . $employee_info->photo; ?>" style="width: 142px; height: 148px; border-radius: 3px;" >  
                                <?php else: ?>
                                    <img src="<?php echo base_url() ?>/img/user.png" alt="Employee_Image">
                                <?php endif; ?>         
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1">
                            &nbsp;
                        </div>
                        <div class="col-lg-8 col-sm-8 ">
                            <div>
                                <div style="margin-left: 20px;">                                        
                                    <h3><?php echo "$employee_info->first_name " . "$employee_info->last_name"; ?></h3>
                                    <hr />
                                    <table class="table-hover">                                        
									   <tr>
                                            <td><strong>Employee ID</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo $employee_info->employment_id ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Department</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$employee_info->department_name"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Designation</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo "$employee_info->designations"; ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <td><strong>Joining Date</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php echo date('d M Y', strtotime($employee_info->joining_date)); ?></td>
                                        </tr>                                            
                                    </table>                                                                           
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <!-- ************************ Personal Information Panel Start ************************-->
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">Personal Details</h4>
                            </div>
                            <div class="panel-body form-horizontal">                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Date of Birth: </label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo date('d M Y', strtotime($employee_info->date_of_birth)); ?></p>                                                                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gender:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo "$employee_info->gender"; ?></p>                                                                                          
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Maratial Status:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo "$employee_info->maratial_status"; ?></p>                                                                                          
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Father's Name: </label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo "$employee_info->father_name"; ?></p>                                                                                          
                                    </div>
                                </div>
                                <?php if (!empty($employee_info->nationality)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nationality : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->nationality"; ?></p>                                                                                          
                                        </div>
                                    </div>                                
                                <?php endif; ?>
                                <?php if (!empty($employee_info->passport_number)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Passport Number: </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->passport_number"; ?></p>                                                                                          
                                        </div>
                                    </div>                                
                                <?php endif; ?>                                
                            </div>            
                        </div>            
                    </div> <!-- ************************ Personal Information Panel End ************************-->       
                    <div class="col-sm-6"><!-- ************************ Contact Details Start******************************* -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4 class="panel-title">Contact Details</h4>
                                </div>
                            </div>
                            <div class="panel-body form-horizontal">
                                <?php if (!empty($employee_info->email)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->email"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->phone)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Phone : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->phone"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->mobile)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Mobile : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->mobile"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->present_address)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Address : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->present_address"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->city)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">City : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->city"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->country_id)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Country : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->countryName"; ?></p>                                                                                          
                                        </div>
                                    </div> 
                                <?php endif; ?>
                            </div>
                        </div>
                    </div> <!-- ************************ Contact Details End ******************************* -->

                    <div class="col-sm-6 hidden-print"><!-- ************************ Employee Documents Start ******************************* -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4 class="panel-title">Employee Documents</h4>
                                </div>
                            </div>
                            <div class="panel-body form-horizontal">
                                <!-- CV Upload -->                                                                  
                                <?php if (!empty($employee_info->resume)): ?>                                                
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Resume : </label>
                                        <div class="col-sm-8">                                                        
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_info->resume; ?>" target="_blank" style="text-decoration: underline;">View Employee Resume</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->offer_letter)): ?>                                                
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Offer Letter : </label>
                                        <div class="col-sm-8">                                                        
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_info->offer_letter; ?>" target="_blank" style="text-decoration: underline;">View Offer Latter</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->joining_letter)): ?>                                                
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Joining Letter : </label>
                                        <div class="col-sm-8">                                                        
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_info->joining_letter; ?>" target="_blank" style="text-decoration: underline;">View Joining Letter</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->contract_paper)): ?>                                                
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Contract Paper : </label>
                                        <div class="col-sm-8">                                                        
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_info->contract_paper; ?>" target="_blank" style="text-decoration: underline;">View Contract Paper</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->id_proff)): ?>                                                
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">ID Proff : </label>
                                        <div class="col-sm-8">                                                        
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_info->id_proff; ?>" target="_blank" style="text-decoration: underline;">View ID Proff</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($employee_info->other_document)): ?>                                                
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Other Document : </label>
                                        <div class="col-sm-8">                                                        
                                            <p class="form-control-static">
                                                <a href="<?php echo base_url() . $employee_info->other_document; ?>" target="_blank" style="text-decoration: underline;">View Other Document</a>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>                                                            
                            </div>
                        </div>
                    </div> <!-- ************************ Employee Documents Start ******************************* -->

                    <!-- ************************      Bank Details Start******************************* -->
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4 class="panel-title">Bank Information</h4>
                                </div>
                            </div>
                            <div class="panel-body form-horizontal">                                
                                <?php if (!empty($employee_info->bank_name)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" > Bank Name :</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->bank_name"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_info->branch_name)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" >Branch Name :</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->branch_name"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_info->account_name)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Account Name : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->account_name"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_info->account_number)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Account Number : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->account_number"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div><!-- ************************ Bank Details End ******************************* -->            

					
					 <!-- ************************     Employee Salary Details Start******************************* -->
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4 class="panel-title">Employee Salary Details</h4>
                                </div>
                            </div>
                            <div class="panel-body form-horizontal">                                
                                <?php if (!empty($employee_info->employment_type)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" > Employment Type :</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">        
												<?php
                                                if ($employee_info->employment_type == 1) {
                                                     echo "Full-Time";
                                                }
												else  if ($employee_info->employment_type == 2)
												{
													echo "Part-Time";
												}
												else if ($employee_info->employment_type == 3)
												{
													
													echo "Self-Employed";
												}
                                                ?>	
											</p> 												
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_info->salary_type)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" >Salary Type :</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">
												<?php
													if ($employee_info->salary_type == 1) {
														 echo "Hourly";
													}
													else  if ($employee_info->salary_type == 2)
													{
														echo "Fixed";
													}
													 
                                                ?> 
											</p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_info->basic_salary)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Basic Salary or Rate/Hour : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo "$employee_info->basic_salary"; ?></p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>                                
                                <?php if (!empty($employee_info->job_sector)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Job Sector : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"> 
											<?php
                                                if ($employee_info->job_sector == 1) {
                                                     echo "Public";
                                                }
												else  if ($employee_info->job_sector == 2)
												{
													echo "Private";
												}
												else if ($employee_info->job_sector == 3)
												{
													
													echo "Self-Employed";
												}
												else if ($employee_info->job_sector == 4)
												{
													
													echo "Voluntary";
												}
                                                ?>	
											</p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
								 <?php if (!empty($employee_info->payment_frequency)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Payment Frequency : </label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"> 
											<?php
                                                if ($employee_info->payment_frequency == 1) {
                                                     echo "Weekly";
                                                }
												else  if ($employee_info->payment_frequency == 2)
												{
													echo "Bi-Monthly";
												}
												else if ($employee_info->payment_frequency == 3)
												{
													
													echo "Monthly";
												} 
                                                ?>
											</p>                                                                                          
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div><!-- ************************ Employee Salary Details End ******************************* --> 

						
                </div>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function printDiv(printableArea) {
        var printContents = document.getElementById(printableArea).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

