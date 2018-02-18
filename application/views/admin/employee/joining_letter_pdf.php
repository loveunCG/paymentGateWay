<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
    </head>

    <body style="width: 100%;">
        <div style="width: 100%; border-bottom: 2px solid black;">
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
        <br/>
        <div style="padding: 5px 0; width: 100%;">
            <div>
                <table style="width: 100%; border-radius: 3px;">
                    <tr>
                        <td style="width: 150px;">
                            <table style="border: 1px solid grey;">
                                <tr>
                                    
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="width: 300px; margin-left: 10px; margin-bottom: 10px; font-size: 13px;">
                                <tr>
                                    <td colspan="2"><h2><?php $name=ucwords($employee_info->name);echo "$name"; ?></h2></td>
                                </tr>                                
                                <tr>
                                    <td style="width: 100px"><strong>Employee ID : </strong></td>
                                    <td colspan="2"><?php echo "$employee_info->id "; ?></td>
                                </tr>                                
                                <tr>
                                    <td style="width: 100px"><strong>Name : </strong></td>
                                    <td>&nbsp; <?php echo "$employee_info->name"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px"><strong>Salary :</strong> </td>
                                    <td>&nbsp; <?php echo "$employee_info->salary"; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px"><strong>Joining Date: </strong></td>
                                    <!--<td>&nbsp; <?php echo date('d M Y', strtotime($employee_info->joining_date)); ?></td>-->
									<td>&nbsp; <?php echo $employee_info->joining_date; ?></td>
                                </tr>                                                                          
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!--        <hr style="margin-top: 10px; margin-bottom: 10px;" />-->

       
        </div>          
    </body>
</html>