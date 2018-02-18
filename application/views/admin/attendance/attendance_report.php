<style type="text/css" media="print">
    @media print{@page {size: landscape}}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="wrap-fpanel">
            <div class="panel panel-default" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong><?php echo $this->language->form_heading()[15] ?></strong>
                    </div>                
                </div>

                <div class="panel-body">
                    <form id="attendance-form" role="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/attendance/get_report" method="post" class="form-horizontal form-groups-bordered">                    
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[16][0] ?><span class="required">*</span></label>

                            <div class="col-sm-5">
                                <select name="department_id" class="form-control" >
                                    <option value="" >Select Department...</option>                                  
                                    <?php if (!empty($all_department)): foreach ($all_department as $department): ?>
                                            <option value="<?php echo $department->department_id; ?>"
                                            <?php if (!empty($department_id)): ?>
                                                <?php echo $department->department_id == $department_id ? 'selected ' : '' ?>
                                                    <?php endif; ?>>
                                                        <?php echo $department->department_name; ?>
                                            </option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?> 
                                </select>                            
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo $this->language->from_body()[16][1] ?> <span class="required">*</span></label>
                            <div class="input-group col-sm-5">
                                <input type="text" class="form-control monthyear" value="<?php
                                if (!empty($date)) {
                                    echo date('Y-n', strtotime($date));
                                }
                                ?>" name="date" >
                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>
                        </div>                     
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5 pull-right">
                                <button type="submit" id="sbtn" class="btn btn-primary"><?php echo $this->language->from_body()[1][14] ?></button>                            
                            </div>
                        </div>   
                    </form>
                </div>                        
            </div>                        
        </div>                
    </div>   
</div>

<div id="EmpprintReport">
	
    <div class="show_print" style="width: 100%; border-bottom: 2px solid black;">
	
        <table style="width: 100%; vertical-align: middle;">
		
            <tr>
                <?php
                $genaral_info = $this->session->userdata('genaral_info');
                if (!empty($genaral_info)) {
                    foreach ($genaral_info as $info) {
                        ?>
                        <td style="width: 35px; border: 0px;">
                            <img style="width: 50px;height: 50px" src="<?php echo base_url() . $info->logo ?>" alt="" class="img-circle"/>
                        </td>
                        <td style="border: 0px;">
                            <p style="margin-left: 10px; font: 14px lighter;"><?php echo $info->name ?></p>
                        </td>
                        <?php
                    }
                } else {
                    ?>
                    <td style="width: 35px; border: 0px;">
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
    </div>
    <br/>
	<?php if (count($getAllAttendanceRecord[2]) > 0): ?>
	<div class="col-sm-9">
	<?php 
echo '<span  style="padding:2px; 4px" class="label label-success std_p">P</span>'.' '.'='.' '.'Present'.', ';
echo '<span  style="padding:2px; 4px" class="label label-primary std_p">H</span>'.' '.'='.' '.'Holiday'.', ';
echo '<span  style="padding:2px; 4px" class="label label-info std_p">L</span>'.' '.'='.' '.'Paid Leave'.', ';
echo '<span  style="padding:2px; 4px" class="label label-warning std_p">U</span>'.' '.'='.' '.'Unpaid Leave'.', ';
echo '<span  style="padding:2px; 4px" class="label label-danger std_p">A</span>'.' '.'='.' '.'Absent';
 ?></div>
    <br/>
    <br>
        <div class="std_heading" hidden style="background-color: rgb(224, 224, 224);margin-bottom: 5px;padding: 5px;">           
            <table style="margin: 3px 10px 0px 24px; width:100%;">                    
                <tr>

                    <td style="font-size: 15px"><strong>Department: </strong><?php echo $dept_name->department_name ?></td>                    
                    <td style="font-size: 15px"><strong>Date:</strong><?php echo $month ?></td>
                </tr>                                      
            </table>
        </div>
        <div class="row">
            <div class="col-sm-12 std_print"> 
                <div class="wrap-fpanel">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><strong>Attendance List </strong>
                                <div class="pull-right hidden-print" >
                                    <a href="<?php echo base_url() ?>admin/attendance/create_pdf/<?php echo $department_id . '/' . $date ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Pdf"><span><i class="fa fa-file-pdf-o"></i></span></a>
                                    <a href="<?php echo base_url() ?>admin/attendance/create_excel/<?php echo $department_id . '/' . $date ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a>                                                
                                    <button  class="btn-print" title="Print" data-toggle="tooltip" type="button" onclick="printEmp_report('EmpprintReport')"><?php echo btn_print(); ?></button>                                                              
                                </div>
                            </h4>
                        </div>                                                  
                        <table id="" class="table table-bordered std_table">
                            <thead>
                                <tr>
                                    <th style="width: 100%" class="col-sm-2">Name</th>                

                                    <?php foreach ($dateSl as $edate) : ?>                                
                                        <th class="std_p"><?php echo $edate ?></th>
                                    <?php endforeach; ?>
									<th style="width: 100%" class="col-sm-2">Total Hours</th>
                                </tr>  

                            </thead>      

                            <tbody>
                                <?php for($co=0; $co<count($getAllAttendanceRecord[2]); $co++){ ?>
                                    <tr>  
                                        <td style="width: 100%" class="col-sm-2"><?php echo $getAllAttendanceRecord[0][$getAllAttendanceRecord[2][$co]]['Fullname'][$co];?></td> 
                                        <?php for($i=0; $i<$totalDays; $i++){ ?>
                                                <td>
                                                    <?php
													$attendanceDay = $getAllAttendanceRecord[0][$getAllAttendanceRecord[2][$co]]['Attendance'];
													$othersLeaveDay = $getAllAttendanceRecord[1][$getAllAttendanceRecord[2][$co]]['LeaveDay'];
													$othersLeaveType = $getAllAttendanceRecord[1][$getAllAttendanceRecord[2][$co]]['LeaveType'];
													if(in_array($i+1, $saturday)){
														echo '<span style="padding:2px; 4px" class="label label-primary std_p">H</span>';
													}else if(in_array($i+1, $sunday)){
														echo '<span style="padding:2px; 4px" class="label label-primary std_p">H</span>';
													}
													else if(count($attendanceDay)>0 && in_array($i+1, $attendanceDay)){
														echo '<span  style="padding:2px; 4px" class="label label-success std_p">P</span>';
														$tot_hrs = $tot_hrs+8;
													}else if(count($othersLeaveDay)>0 && in_array($i+1, $othersLeaveDay)){
														$matchLeaveKey = array_search($i+1, $othersLeaveDay);
														$getLeaveType = $othersLeaveType[$matchLeaveKey];
														if($getLeaveType == 1){
															echo '<span style="padding:2px; 4px" class="label label-info std_p">L</span>';
														}else{
															echo '<span style="padding:2px; 4px" class="label label-warning std_p">U</span>';
														}
													}else {
                                                        echo '<span style="padding:2px; 4px" class="label label-danger std_p">A</span>';
														
                                                    }
                                                    ?>
                                                </td>
										<?php }?>
                                        <?php ?>
										<td style="width: 100%" class="col-sm-2">
										<?php $splitTime = explode(':',$getAllAttendanceRecord[3][$getAllAttendanceRecord[2][$co]][0]['workingTime']);
										 echo $splitTime[0].':'.$splitTime[1]; 
										 
										 ?></td>  
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>    
            </div>
        </div>    
    <?php endif; ?>
</div>

<script type="text/javascript">
    function printEmp_report(EmpprintReport) {
        var printContents = document.getElementById(EmpprintReport).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
