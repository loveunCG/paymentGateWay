<!DOCTYPE html>
<html>
    <head>
        <title>Employee Attendance</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
    </head>
    <body style="min-width: 100%; min-height: 100%; overflow: hidden; alignment-adjust: central;">
        <br />
        <div style="width: 100%; border-bottom: 2px solid black;">
            <table style="width: 100%; vertical-align: middle;">
                <tr>
                    <?php
                    $genaral_info = $this->session->userdata('genaral_info');
                    if (!empty($genaral_info)) {
                        foreach ($genaral_info as $info) {
							if($info->id_gsettings == $this->session->userdata('id_gsettings'))
							{
								?>
								<td style="width: 35px;">
									<img style="width: 50px;height: 50px" src="<?php echo base_url() . $info->logo ?>" alt="" class="img-circle"/>
								</td>
								<td>
									<p style="margin-left: 10px; font: 14px lighter;"><?php echo $info->name ?></p>
								</td>
								<?php
							}
                        }
                    } else {
                        ?>
                        <td style="width: 35px;">
                            <img style="width: 50px;height: 50px" src="<?php echo base_url() ?>img/logo.png" alt="Logo" class="img-circle"/>
                        </td>
                        <td>
                            <p style="margin-left: 10px; font: 14px lighter;">Human Resource Management System</p>
                        </td>
                    <?php }
                    ?>                    
                </tr>
            </table>
        </div>
        <br />
        <div style="width: 100%;">
            <div style="height: 25px; width: 99%; background-color: rgb(224, 224, 224); padding: 1px 0px 5px 15px;">                
                <table style="margin: 3px 10px 0px 24px; width: 65%;">                    
                    <tr>                        
                        <td style="font-size: 15px"><strong>Department:</strong> <?php echo $dept_name->department_name ?></td>                        
                        <td style="font-size: 15px"><strong>Month:</strong> <?php echo $date ?></td>
                    </tr>                                      
                </table>
            </div>
            <div align="center">
                <table style="width: 100%; font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;">
                    <tr style="font-size: 20px;  text-align: center">
                        <td colspan="32" style=" padding: 10px 0;  color: black;">Employee Attendance</td>
                    </tr>
                    <tr style="background-color: rgb(224, 224, 224);">
                        <th style="text-align: center; font-size: 12px; border: 1px solid black;">Name</th>
                        <?php foreach ($dateSl as $edate) : ?>  
                            <th style="text-align: center; font-size: 12px; border: 1px solid black;"><?php echo $edate ?></th>
                        <?php endforeach; ?>

                    </tr>
                    <?php foreach ($attendance as $key => $v_employee): ?>
                        <tr>
                            <td style="text-align: left; border: 1px solid black; font-size: 12px;"><?php echo $employee[$key]->first_name.' '.$employee[$key]->last_name ?> </td>
                            <?php foreach ($v_employee as $v_result): ?>
                                <td style="padding: 2px;text-align: center;font-size: 10px; border: 1px solid black;">
                                    <?php
                                    foreach ($v_result as $emp_attendance):
                                        if ($emp_attendance->attendance_status == 1) {
                                            echo 'P';
                                        }if ($emp_attendance->attendance_status == '0') {
                                            echo 'A';
                                        }if ($emp_attendance->attendance_status == 'H') {
                                            echo 'H';
                                        }
                                    endforeach;
                                    ?> 
                                </td>       
                            <?php endforeach; ?>       
                        </tr>
                    <?php endforeach; ?>                    
                </table>
            </div>
        </div>
    </body>
</html>