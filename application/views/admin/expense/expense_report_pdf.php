<!DOCTYPE html>
<html>
    <head>
        <title>Expense Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
        <style type="text/css">
            .table_tr1{
                background-color: rgb(224, 224, 224);
            }
            .table_tr1 td{
                padding: 7px 0px 7px 8px;
                font-weight: bold;
            }
            .table_tr2 td{
                padding: 7px 0px 7px 8px;
                border: 1px solid black;
            }

            .total_amount{
                background-color: rgb(224, 224, 224);
                font-weight: bold;
                text-align: right;

            }
            .total_amount td{
                padding: 7px 8px 7px 0px;
                border: 1px solid black;
                font-size: 15px;
            }
        </style>
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
            <div style="width: 100%; background-color: rgb(224, 224, 224); padding: 1px 0px 5px 15px;">                
                <table style="width: 100%;">                    
                    <tr style="font-size: 20px;  text-align: center">
                        <td style="padding: 10px;">Expense Report For <?php echo $monthyaer ?></td>
                    </tr>                                    
                </table>
            </div>
            <br/>            
            <table style="width: 100%; font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;">
                <tr class="table_tr1">
                    <td style="border: 1px solid black;">Sl</td>                    
                    <td style="border: 1px solid black;">Item Name</td>                    
                    <td style="border: 1px solid black;">Purchase From</td>                    
                    <td style="border: 1px solid black;">Purchase Date</td>                    
                    <td style="border: 1px solid black;">Employee Name</td>                    
                    <td style="border: 1px solid black;">Amount</td>                    
                </tr>  
                <?php
                $key = 1;
                $total_amount = 0;
                ?>
                <?php if (!empty($expense_list)): foreach ($expense_list as $v_expense) : ?>
                        <tr class="table_tr2">
                            <td><?php echo $key ?></td>
                            <td><?php echo $v_expense->item_name ?></td>
                            <td><?php echo $v_expense->purchase_from ?></td>
                            <td><?php echo date('d M Y', strtotime($v_expense->purchase_date)); ?></td>     
                            <td><?php echo $v_expense->first_name . ' ' . $v_expense->last_name ?></td>    
                            <td><?php
                                if (!empty($genaral_info[0]->currency)) {
                                    $currency = $genaral_info[0]->currency;
                                } else {
                                    $currency = '$';
                                }
                                echo $currency . ' ' . number_format($v_expense->amount, 2);
                                $total_amount+=$v_expense->amount;
                                ?></td>
                                                    
                        </tr>
                        <?php
                        $key++;
                    endforeach;
                    ?>
                    <tr class="total_amount">
                        <td colspan="5" style="text-align: right"><span>Total Amount:</span></td>
                        <td colspan="1" style="padding-left: 8px;"><?php
                            if (!empty($genaral_info[0]->currency)) {
                                $currency = $genaral_info[0]->currency;
                            } else {
                                $currency = '$';
                            }
                            echo $currency . ' ' . number_format($total_amount, 2);
                            ;
                            ?></td>
                    </tr>   
                <?php else : ?>
                    <td colspan="3">
                        <strong>There is no data to display</strong>
                    </td>
                <?php endif; ?>
            </table>            
        </div>
    </body>
</html>