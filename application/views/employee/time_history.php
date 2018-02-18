
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12" data-offset="0">    
			
            <div class="panel panel-info">
                <!-- Default panel contents -->
				<form role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>employee/dashboard/time_history" method="post" class="form-horizontal form-groups-bordered">
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
                        <strong>Employee Time Clock History</strong>
                    </div>
                </div>
                <!-- Table -->
                <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>                                                                               
                            <th class="col-sm-1">No.</th> 
                            <th>Date</th>                                                                
                            <th>Time In</th>  
                            <th>Time Out</th>                                                                
                            <th>Status</th>                                                         
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($attendance_info)): 
								$cnt = 0;
								foreach ($attendance_info as $attendance) : 
									$cnt++;
						?>                            
                                <tr>
                                    <td><?php echo $cnt?></td>
                                    <td><?php echo date('d M, Y',strtotime($attendance->date))?></td>
									<td>
										<table>
										<?php
											$time_in = explode("<-->",$attendance->time_in);
											foreach($time_in as $time)
											{
										?>
											<tr>
												<td><?php echo $time?></td>
											</tr>												
										<?php
											}
										?>
										</table>
									</td>
									<td>
										<table>
										<?php
											$time_out = explode("<-->",$attendance->time_out);
											foreach($time_out as $time)
											{
										?>
											<tr>
												<td><?php echo $time?></td>
											</tr>												
										<?php
											}
										?>
										</table>
									</td>
									<td>
										<?php 
										if($attendance->attendance_status == 1)
										{
											echo '<strong style="padding:2px; 4px" class=" text-success std_p">Present</strong>';
										}
										if($attendance->attendance_status == 0)
										{
											echo '<strong style="padding:2px; 4px" class=" text-danger std_p">Absent</strong>';
										}
										if($attendance->attendance_status == 3)
										{
											echo '<strong style="padding:2px; 4px" class=" text-warning std_p">On Leave</strong>';
										}
											
										?>
									</td>
									
                                </tr>
                                <?php
                            endforeach;
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