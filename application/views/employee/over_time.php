
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12" data-offset="0">    
			
            <div class="panel panel-info">
                <!-- Default panel contents -->
				<form role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>employee/dashboard/over_time" method="post" class="form-horizontal form-groups-bordered">
                    <div class="panel-body">
                        <div class="row"><br />
                            <div class="col-sm-12 form-groups-bordered">                                
                                
								<div class="form-group">
                                    <label class="col-sm-3 control-label">Select Month <span class="required">*</span></label>
                                    <div class="input-group col-sm-5">
                                        <input type="text" required value="<?php
                                        if (!empty($month)) {
                                            echo $month;
                                        }
                                        ?>" class="form-control month" id="date" name="txtmonth">
										<div class="input-group-addon">
											<i class="entypo-calendar"></i>
										</div>
                                    </div>
                                </div>
                                <div class="form-group" id="border-none">
                                    <label for="field-1" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5">
                                        <button id="submit" type="submit" name="sbtn" value="1" class="btn btn-primary btn-block">GO</button>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
                <div class="panel-heading">
                    <div class="panel-title">                 
                        <strong>Employee Overtime Clock History</strong>
                    </div>
                </div>
                <!-- Table -->
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>                                                                               
                            <th class="col-sm-1">No.</th> 
                            <th>Date</th>                                                                
                            <th>Total Time</th>  
                            <th>Over Time</th>
							<th>Report</th>							
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($attendance_overtime_info)): 
								$ovTi=0;
								$countAttendanceData = count($attendance_overtime_info);
								for ($i=0; $i<count($attendance_overtime_info); $i++) : 
								$getHourAndMinute = explode(':', $attendance_overtime_info[$i]['workingTime']);
									if($getHourAndMinute[0]>=8 && $getHourAndMinute[1]>=1):
						?>                            
									<tr>
										<td><?php echo $i+1; ?></td>
										<td><?php echo date('d M, Y',strtotime($attendance_overtime_info[$i]['date']));?></td>
										<td><?php echo $getHourAndMinute[0].':'.$getHourAndMinute[1]; ?></td>
										<td><?php echo sprintf("%02d", $getHourAndMinute[0]-8); echo ':'.$getHourAndMinute[1]; ?></td>
										<td><a href="<?php echo base_url() ?>employee/dashboard/over_time_cause/<?php echo $attendance_overtime_info[$i]['employee_id'].'/'.$attendance_overtime_info[$i]['date'];?>/">Enter Cause</a></td>
									</tr>
                                <?php
								$ovTi++;
								else:								
									if($ovTi == 0 && $countAttendanceData == $i+1):
								?>
									<td colspan="3">
										<strong>There is no overtime data to display</strong>
									</td>
							<?php
									endif;
								endif;
                            endfor;
                            ?>
                        <?php else : ?>
                        <td colspan="3">
                            <strong>There is no data to display</strong>
                        </td>
                    <?php endif; ?>
                    </tbody>
                </table>          
            </div>
        </div>
    </div>        
</div>