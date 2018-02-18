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
					<div style="font-size:24px">Payroll Tax</div>
					<div style="font-size:18px"> Monthly Tax Return</div>
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
					<th rowspan="2" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" width="12%">Employee Name</th>
					<th rowspan="2" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;width:1%">Sex</th>
                    <th rowspan='2' style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Salary/ Wages</th>
					<th colspan="<?php echo count($global_allowance)?>" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;width:45%">
						&nbsp;
					</th>
					<th rowspan="2"  style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Gross Benifits</th>
					<th rowspan="2"  style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Gross Renumeration Paid this Month</th>
					<th rowspan="2"  style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Employee Tax Payable this Month</th>
					<th rowspan="2"  style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;">Employer Tax Payable this Month</th>
					<th rowspan="2" width="6%" style="border:1px solid;">Total Tax Payable this Month</th>
				</tr>
				<tr>
					<?php 
					if(!empty($global_allowance))
					{
						//echo $per = 100/count($global_allowance);
						foreach($global_allowance as $glob)
						{
							echo '<th style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;" align="center">'.$glob->allow_name.'</th>';
						}
					}
					?>
				</tr>
			</thead>
			<tbody>                                                                                                
				<?php
					if (!empty($paytax_history)): 
						foreach ($paytax_history as $pay_tax) :
							$rowspan_cnt = 1;
							$gross_benifit = 0;
							//$rowspan_cnt = count($pay_tax['global_allowance']);
					?>
						<tr>
							<td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo $pay_tax['employee_name']?></td>
							<td style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo substr($pay_tax['gender'],0,1)?></td>
							<td align="center" style="border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($pay_tax['tot_salary'],2) ?></td>
							<?php
							
							
							
							foreach($pay_tax['global_allowance'] as $pay_global_allow)
							{	foreach($pay_global_allow as $glob_allow)
								{
									$glob_allow_arr = explode('=',$glob_allow);
									echo '<td align="center" style="border-left:1px solid;border-bottom:1px solid;">'.number_format($glob_allow_arr[1],2)."</td>\n";
									$gross_benifit += $glob_allow_arr[1];
								}
								
								if(count($global_allowance) > count($pay_tax['global_allowance'][0]))
								{
									$remain = count($global_allowance) - count($pay_tax['global_allowance'][0]);
									for($i = 0; $i < $remain; $i++)
									{
										echo '<td align="center" style="border-left:1px solid;border-bottom:1px solid;">'.number_format(0,2)."</td>\n";
									}
								}
								
								break;
							}
							?>
							<td align="center" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($gross_benifit,2) ?></td>
							<td align="center" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($gross_renum = ($pay_tax['tot_salary'] + $gross_benifit),2) ?></td>
							<td align="center" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($gross_renum * ($pay_tax['pay_tax_detail']->employee_wage/100),2) ?></td>
							<td align="center" style="border-top:1px solid;border-left:1px solid;border-bottom:1px solid;"><?php echo number_format($gross_renum * ($pay_tax['pay_tax_detail']->employer_wage/100),2) ?></td>
							<td align="center" style="border:1px solid;"><?php echo number_format($gross_renum * ($pay_tax['pay_tax_detail']->total_wages/100),2) ?></td>
						</tr>
						
					<?php
						/*echo $emp_wage_tr;
						$basic_sal += $total_sal;
						$total_contr += ($total_employer + $total_employee);*/
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
    </body>
</html>
<?php 
//die;
?>