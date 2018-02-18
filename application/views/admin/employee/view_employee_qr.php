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
                        <?php if (isset($employee_info->qr_code)): ?>
                        <div class="col-lg-2 col-sm-2">
                            <div class="fileinput-new thumbnail" style="width: 120px; height: 120px; margin-top: 14px; margin-left: 16px; background-color: #EBEBEB;">
                            	<img src="<?php echo base_url().'tmp/qr_codes/'.$employee_info->qr_code; ?>" style="width: 100px; height: 100px; border-radius: 3px;" >   
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-1">
                            &nbsp;
                        </div>
                         <?php endif; ?> 
                        <div class="col-lg-5 col-sm-5 ">
                            <div>
                                <div style="margin-left: 20px;">                                        
                                    <h3><?php echo "$employee_info->first_name " . "$employee_info->last_name"; ?></h3>
                                    <hr />
                                    <table class="table-hover">                                        
									   <tr>
                                            <td><strong>Employee ID</strong></td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td><?php if($this->uri->segment(4)){echo $this->uri->segment(4);} ?></td>
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

