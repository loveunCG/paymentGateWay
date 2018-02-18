<div class="row">
    <div class="col-sm-12">        
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>Attendance</strong>
                </div>                
            </div>           
            <div class="panel-body">                
                <form role="form" enctype="multipart/form-data" action="<?php echo base_url(); ?>guardian/dashboard/attendance/<?php echo $this->encryption->encrypt($student_info->student_session_id) ?>" method="post" class="form-horizontal form-groups-bordered">                                          
                    <div class="row col-sm-12">
                        <label for="field-1" class="col-sm-3 control-label">Month & Year</label>                        
                        <div class="input-group col-sm-5" style="float: left">
                            <input type="text" class="form-control monthyear" value="<?php
                            if (!empty($day)) {
                                echo date('Y-n', strtotime($day));
                            }
                            ?>" name="date" >
                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>                   
                        <div class="col-sm-2">
                            <button type="submit" id="sbtn" class="btn btn-primary">Go</button>                            
                        </div>
                    </div>                     
                </form>                                
                <?php if (!empty($attendance)): ?>                                                   
                    <table class="table table-bordered" style="width: 100%;background: #FFF">                        
                        <thead>

                            <tr>                       
                                <?php
                                foreach ($day_name as $key => $value) {
                                    if ($key <= 6) {
                                        ?>
                                        <th class="" style="width: 107px;color: #000"><?php echo mb_substr($value, 0, 3); ?></th>            
                                        <?php
                                    }
                                }
                                ?>

                            </tr>  
                        </thead>      
                        <tbody>

                            <tr>                             
                                <?php foreach ($attendance as $name => $v_result): ?>
                                    <td style="height: 81px;">                                           
                                        <?php
                                        $adate = date('d', strtotime($v_result->day));
                                        ?>

                                        <?php foreach ($dateSl as $edate) : ?>   
                                            <?php
                                            if ($edate >= 1 && $edate <= 9) {
                                                $date = '0' . $edate;
                                            } else {
                                                $date = $edate;
                                            }
                                            ?>
                                            <?php if ($date == $adate): ?>
                                                <?php
                                                echo '<p style="text-align:right;">' . $date . '</p>';
                                                if ($date == 7 || $date == 14 || $date == 21 || $date == 28) {
                                                    if ($v_result->attendance_status == 1) {
                                                        echo '<span class="label label-success" style="margin:37px;">P</span>';
                                                    }
                                                    if ($v_result->attendance_status == 'H') {
                                                        echo '<span class="label label-info" style="margin:37px;">H</span>';
                                                    }
                                                    if ($v_result->attendance_status == '0') {
                                                        echo '<span class="label label-danger" style="margin:37px;">A</span>';
                                                    }
                                                    echo '</tr>' . '</br>';
                                                } else {
                                                    if ($v_result->attendance_status == 1) {
                                                        echo '<span class="label label-success" style="margin:37px;">P</span>';
                                                    }
                                                    if ($v_result->attendance_status == 'H') {
                                                        echo '<span class="label label-info" style="margin:37px;">H</span>';
                                                    }
                                                    if ($v_result->attendance_status == '0') {
                                                        echo '<span class="label label-danger" style="margin:37px;">A</span>';
                                                    }
                                                }
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>  
                                    <?php endforeach; ?>  
                                </td>

                            </tr>
                        </tbody>
                    </table> 
                <?php endif; ?>   
            </div>    
        </div>    
    </div>    
</div>        
<script src="<?php echo base_url() ?>asset/js/bootstrap-datepicker.js" ></script> 