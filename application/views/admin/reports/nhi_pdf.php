<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
		<title><?=$title?></title>
	</head>

    <body style="width:100%; align-content:center">
		<table width="98%">
			<tr>
				<td style="width: 35px; border: 0px;">
					
				</td>
				<td style="border: 0px;">
					<p style="margin-left: 10px; font: 14px lighter;"></p>
				</td>
				<td width="50%" align="right">
					<div style="font-size:24px">NATIONAL HEALTH INSURANCE</div>
					<div style="font-size:18px"> CONTRIBUTION REMITTANCE FORM</div>
				</td>
				<td align="right"> 
					<table style="text-align:right">
						<tr style="border: 0px">
							<td style="text-align:right;">For the month of</td>
						</tr>
						<tr>
							<td  style="border: 1px solid;text-align:center;"> 
								<?php echo date('M, Y',strtotime($month))?> 
							</td>
						</tr>
					</table>
				</td>			
			</tr>
		</table>
		<hr>
		<table cellspacing='0' cellpadding="0" border='0' style="border:none; align-content:center;width:98%">
			<thead>
				<tr>                                                    
					<th rowspan="2" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;width:4%">Employee Registraton No.</th>
					<th rowspan="2" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="15%">Name Of Employee</th>
					<th rowspan="2" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;width:1%">Sex</th>
					<th rowspan="1" colspan="6" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">
						Earning And Contribution
						<!--<table cellspacing='0' cellpadding='0' width="100%" style="line-height:35px">
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
						</table>-->
					</th>
					<th rowspan="2"  style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Total Earning For Month</th>
					<th rowspan="2"  style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Total Contri bution</th>
					<th rowspan="2" width="6%" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">No Of Wks Wrk</th>                                        
					<th rowspan="2" style="border:1px solid;">Pay type/ Comment</th>
				</tr>
				<tr>
					<th rowspan="1" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" align="center" width="10%"> </th>
					<th rowspan="1" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="7%" align="center">Week No 1</th>
					<th rowspan="1" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="7%" align="center">Week No 2</th>
					<th rowspan="1" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="7%" align="center">Week No 3</th>
					<th rowspan="1" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="7%" align="center">Week No 4</th>
					<th rowspan="1" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="7%" align="center">Week No 5</th>
				</tr>
			</thead>
			<tbody>                                                                                                
				<?php
				if (!empty($nhi_history)): 
					$basic_sal = $total_contr = 0;
					foreach ($nhi_history as $nhi_details) :
					?>
						<tr>
							<td rowspan="4"  style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo $nhi_details['employment_id']?></td>
							<td rowspan="4" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo $nhi_details['employee_name']?></td>
							<td rowspan="4" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo $nhi_details['gender']?></td>
							<td rowspan="1" style="border-left:1px solid;border-bottom:1px solid;">Earnings</td>
							<?php 
							//basic salary
							$total_sal = 0;
							for($i = 0; $i < 5; $i++)
							{
								if(isset($nhi_details['basic_salary'][$i]))
								{
									$total_sal += $nhi_details['basic_salary'][$i];
									echo '<td style="border-left:1px solid;border-bottom:1px solid;" rowspan="1" align="center" width="7%">'.number_format($nhi_details['basic_salary'][$i],2).'</td>';
								}
								else
								{
									echo '<td style="border-left:1px solid;border-bottom:1px solid;" rowspan="1" align="center" width="7%">0.00</td>';
								}
							}
							
							//employee wage
							$emp_wage_tr = '<tr>
								<td rowspan="1" style="border-left:1px solid;border-bottom:1px solid;">Employee ';
							if(!empty($nhi_details['nhi_deduct_detail']->employee_wage))
							{
								$set = 1;
								$emp_wage_tr .= $nhi_details['nhi_deduct_detail']->employee_wage;
							}
							else
							{
								$emp_wage_tr .= $set = 0;
							}
							$emp_wage_tr .= '</td>';
							$total_employee = 0;
							for($i = 0; $i < 5; $i++)
							{
								if(isset($nhi_details['basic_salary'][$i]) && $set == 1)
								{
									$emp_wage = ($nhi_details['basic_salary'][$i] * $nhi_details['nhi_deduct_detail']->employee_wage/100);
									$total_employee += $emp_wage;
									$emp_wage_tr .= '<td style="border-left:1px solid;border-bottom:1px solid;" rowspan="1" align="center" width="7%">'.number_format($emp_wage,2).'</div>';
								}
								else
								{
									$emp_wage_tr .= '<td style="border-left:1px solid;border-bottom:1px solid;" rowspan="1" align="center" width="7%">0.00</div>';
								}
							}
							
							//employer wage
							$emp_wage_tr .= '</tr>
								<tr>
								<td rowspan="1" style="border-left:1px solid;border-bottom:1px solid;">Employer ';
							if(!empty($nhi_details['nhi_deduct_detail']->employer_wage))
							{
								$set = 1;
								$emp_wage_tr .= $nhi_details['nhi_deduct_detail']->employer_wage;
							}
							else
							{
								$emp_wage_tr .= $set = 0;
							}
							$emp_wage_tr .= '</td>';
							$total_employer = 0;
							for($i = 0; $i < 5; $i++)
							{
								if(isset($nhi_details['basic_salary'][$i]) && $set == 1)
								{
									$emp_wage = ($nhi_details['basic_salary'][$i] * $nhi_details['nhi_deduct_detail']->employer_wage/100);
									$total_employer += $emp_wage;
									$emp_wage_tr .= '<td style="border-left:1px solid;border-bottom:1px solid;" rowspan="1" align="center" width="7%">'.number_format($emp_wage,2).'</div>';
								}
								else
								{
									$emp_wage_tr .= '<td style="border-left:1px solid;border-bottom:1px solid;" rowspan="1" align="center" width="7%">0.00</div>';
								}
							}
							//spouse wage
							$emp_wage_tr .= '</tr>
								<tr>
								<td rowspan="1" style="border-left:1px solid;border-bottom:1px solid;">Spouse ';
							if(!empty($nhi_details['nhi_deduct_detail']->rate) )
							{
								$set = 1;
								$emp_wage_tr .= $nhi_details['nhi_deduct_detail']->rate;
							}
							else
							{
								$emp_wage_tr .= $set = 0;
							}
							$emp_wage_tr .= '</td>';
							
							$total_spouse = 0;
							for($i = 0; $i < 5; $i++)
							{
								if(isset($nhi_details['basic_salary'][$i]) && $set == 1)
								{
									$emp_wage = ($nhi_details['basic_salary'][$i] * $nhi_details['nhi_deduct_detail']->employer_wage/100);
									$total_spouse += $emp_wage;
									$emp_wage_tr .= '<td style="border-left:1px solid;border-bottom:1px solid;" rowspan="1" align="center" width="7%">'.number_format($emp_wage,2).'</div>';
								}
								else
								{
									$emp_wage_tr .= '<td style="border-left:1px solid;border-bottom:1px solid;" rowspan="1" align="center" width="7%">0.00</div>';
								}
							}
							$emp_wage_tr .= '</tr>';
							?>
									
									
							<td rowspan="4" align="center" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($total_sal,2);?></td>
							<td rowspan="4" align="center" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($total_employer + $total_employee + $total_spouse,2);?></td>
							<td rowspan="4" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"></td>
							<td rowspan="4" align="center" style="border:1px solid;"><?php echo "Pay Type : ".$nhi_details['payment_frequency'];?></td>
						</tr>
						
					<?php
						echo $emp_wage_tr;
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
		</table>
		<div style="display:block; height:30px">I certify that the above contributions are due in respect of the employees listed for the periods shown and I enclose cheque/cash as payment.</div>
		<div style="display:block; height:30px">
			<div style="display:inline;">Signature of Employer ____________________________________ </div>
			<div style="display:inline;">Date: D ____ M ____ Y ________</div>
		</div>
		
		<table width="100%" cellpadding='0' cellspacing="0">
			<tr>
				<td width="60%" align="center" style="border-top:1px solid;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
					OFFICE USE ONLY
				</td>
				<td></td>
			</tr>
			<tr>
				<td style="border-top:1px solid;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
					<table cellpadding='0' cellspacing='0'  width="100%" style="line-height:40px">
						<tr>
							<td width="24%">Cashier _______________</td>
							<td width="24%">Reciept No ____________</td>
							<td width="26%">Date: D___ M___ Y___</td>
							<td width="26%">Verified _________________</td>
						</tr>
						<tr>
							<td>Posted _______________</td>
							<td colspan="2">Date: D___ M___ Y____</td>
							<td>Checked ________________</td>
						</tr>
					</table>
				</td>
				<td align="center" width="20%" >
					<table cellpadding='8' width='80%'>
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