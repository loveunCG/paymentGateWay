<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
		<title><?=$title?></title>
	</head>

    <body style="width:99%; align-content:center">
		<table width="95%">
			<tr>
				<?php
                    $genaral_info = $this->session->userdata('genaral_info');
                    if (!empty($genaral_info)) {
                        foreach ($genaral_info as $info) {
							if($info->id_gsettings == $this->session->userdata('id_gsettings'))
							{
								?>
								<td style="width: 35px; border: 0px;">
									&nbsp;
								</td>
								<td style="border: 0px;">
									<p style="margin-left: 10px; font: 14px lighter;"><?php echo $info->name ?></p>
								</td>
								<td width="50%" align="right">
									<div style="font-size:24px">SOCIAL SECURITY BOARD</div>
									<div style="font-size:19px"> Monthly Remittance Form</div>
								</td>
								<td align="right"> 
									<table style="align-content:right">
										<tr style="border: 0px">
											<td style="text-align:right;">For the month of</td>
										</tr>
										<tr>
											<td  style="border: 1px solid;text-align:right;"> 
												<?php echo date('M, Y',strtotime($month))?> 
											</td>
										</tr>
									</table>
								</td>
								<?php
							}
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
		<hr>
		<table cellspacing='0' cellpadding="0" border='0' style="border:none; align-content:center;">
			<thead>
				<tr>                                                    
					<th style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;width:4%">Employee Registraton No.</th>
					<th style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="15%">Name Of Employee</th>
					<th style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;width:1%">Sex</th>
					<th style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="45%">
						<table cellspacing='0' cellpadding='0' width="100%" style="line-height:35px">
							<tr>
								<th align="center" valign='middle' colspan="6">
									Earning And Contribution
								</th>
							</tr>
							<tr>
								<th style="border-top:1px solid;" align="center" width="10%"> </th>
								<th style="border-top:1px solid;border-left:1px solid;" width="18%" align="center">Week No 1</th>
								<th style="border-top:1px solid;border-left:1px solid;" width="18%" align="center">Week No 2</th>
								<th style="border-top:1px solid;border-left:1px solid;" width="18%" align="center">Week No 3</th>
								<th style="border-top:1px solid;border-left:1px solid;" width="18%" align="center">Week No 4</th>
								<th style="border-top:1px solid;border-left:1px solid;" width="18%" align="center">Week No 5</th>
							</tr>
						</table>
					</th>
					<th style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Total Earning For Month</th>
					<th style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Total Contri bution</th>
					<th style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">No Of Wks Wrk</th>                                        
					<th style="border:1px solid;">Pay type/ Comment</th>
				</tr>
			</thead>
			<tbody>                                                                                                
				<?php
				if (!empty($social_security)): 
					$basic_sal = $total_contr = 0;
					foreach ($social_security as $ss_details) :
					?>
						<tr>
							<td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo $ss_details['employment_id']?></td>
							<td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo $ss_details['employee_name']?></td>
							<td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo $ss_details['gender']?></td>
							<td style="border-left:1px solid;border-bottom:1px solid;">
								<table width='100%' style="border:0px" border='1' cellspacing='0' cellpadding='0'>
									<tr>
										<td align="center" width="10%">Pay</td>
									<?php 
									$total_sal = 0;
									for($i = 0; $i < 5; $i++)
									{
										if(isset($ss_details['basic_salary'][$i]))
										{
											$total_sal += $ss_details['basic_salary'][$i];
											echo '<td align="center" width="18%">'.number_format($ss_details['basic_salary'][$i],2).'</td>';
										}
										else
										{
											echo '<td align="center" width="18%">0.00</td>';
										}
									}
									?>
									</tr>
									<tr>
										<td align="center" width="10%"><?php
											if(!empty($ss_details['ss_detail']->employee_wage))
											{
												$set = 1;
												echo $ss_details['ss_detail']->employee_wage;
											}
											else
											{
												echo $set = 0;
											}
											?>%</td>
										<?php 
										$total_employee = 0;
										for($i = 0; $i < 5; $i++)
										{
											if(isset($ss_details['basic_salary'][$i]) && $set == 1)
											{
												$emp_wage = ($ss_details['basic_salary'][$i] * $ss_details['ss_detail']->employee_wage/100);
												$total_employee += $emp_wage;
												echo '<td align="center" width="18%">'.number_format($emp_wage,2).'</td>';
											}
											else
											{
												echo '<td align="center" width="18%">0.00</td>';
											}
										}
										?>
									</tr>
									<tr>
										<td align="center" width="10%">
										<?php 
											if(!empty($ss_details['ss_detail']->employer_wage))
											{
												$set = 1;
												echo $ss_details['ss_detail']->employer_wage;
											}
											else
											{
												echo $set = 0;
											}
											?>%</td>
										<?php 
										$total_employer = 0;
										for($i = 0; $i < 5; $i++)
										{
											if(isset($ss_details['basic_salary'][$i]) && $set == 1)
											{
												$emp_wage = ($ss_details['basic_salary'][$i] * $ss_details['ss_detail']->employer_wage/100);
												$total_employer += $emp_wage;
												echo '<td align="center" width="18%">'.number_format($emp_wage,2).'</td>';
											}
											else
											{
												echo '<td align="center" width="18%">0.00</td>';
											}
										}
										?>
									</tr>
								</table>
							</td>
							<td align="center" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($total_sal,2);?></td>
							<td align="center" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($total_employer + $total_employee,2);?></td>
							<td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"></td>
							<td align="center" style="border:1px solid;"><?php echo "Pay Type : ".$ss_details['payment_frequency'];?></td>
						</tr>
					<?php
						$basic_sal += $total_sal;
						$total_contr += ($total_employer + $total_employee);
					endforeach;
					?>
				<?php else : ?>
					<tr>       
						<td colspan="9">
							<strong>There is no data for display</strong>
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
						<table width="100%">
							<tr>
								<td style="font-size:13px">I certify that the above contributions are due in respect of the employees listed, for the periods shown and I enclose cheque/cash in payment</td>
								<td align="right"  style="font-size:15px;font-weight:bold;">TOTALS</td>
							</tr>
							<tr  style="font-size:15px;font-weight:bold;">
								<td >Signature of Employer ______________________________________</td>
								<td align="right">Surcharge (5% of Total Contributions)</td>
							</tr>
							<tr  style="font-size:15px;font-weight:bold;">
								<td>Date ______________________________________________________</td>
								<td align="right">GRAND TOTALS</td>
							</tr>
						</table>
					</td>
					<td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">
						<table width="100%" border='1' cellspacing="0" cellpadding='0' style="line-height:31px;">
							<tr>
								<td align="center"><?php echo number_format($basic_sal,2);?></td>
							</tr>
							<tr>
								<td align="center">&nbsp;</td>
							</tr>
							<tr>
								<td align="center"><?php echo number_format($basic_sal,2);?></td>
							</tr>
						</table>
					</td>
					<td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;border-right:2px solid;">
						<table width="100%" border='1' cellspacing="0" cellpadding='0' style="line-height:31px;">
							<tr>
								<td align="center"><?php echo number_format($total_contr,2);?></td>
							</tr>
							<tr>
								<td align="center">0.00</td>
							</tr>
							<tr>
								<td align="center"><?php echo number_format($total_contr,2);?></td>
							</tr>
						</table>
					</td>
					<td colspan="2"></td>
				</tr>
			</tfoot>
		</table>
		<table width="100%" cellpadding='0' cellspacing="0">
			<tr>
				<td colspan='3'>
					OFFICE USE ONLY
				</td>
			</tr>
			<tr>
				<td width='70%'>
					<table style="border:1px solid" cellpadding='15' cellspacing='0'  width="95%">
						<tr>
							<td>Cashier ________</td>
							<td>Reciept No _______</td>
							<td>Date _________</td>
							<td>Verified __________</td>
						</tr>
						<tr>
							<td>Posted ___________</td>
							<td>Date __________</td>
							<td colspan='2'>Checked ____________________________</td>
						</tr>
					</table>
				</td>
				<td width="15%">
					<div><u>Payment Type</u></div>
					<div>W = Weekly</div>
					<div>B = Bimonthly</div>
					<div>M = Monthly</div>
				</td>
				<td width="15%" >
					<table cellpadding='8' width='85%'>
						<tr>
							<td>CHEQUE NUMBER</td>
						</tr>
						<tr>
							<td style='border:1px solid'>&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
    </body>
</html>