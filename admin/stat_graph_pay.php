<?
include "head.php";
?>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "data";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	//�ֹ���,�Ǹűݾ� ��
	$total_buyNum	= $MySQL->fetch_array("select sum(cnt) from trade_goods where status>0 and status<4");
	$total_buyMoney = $MySQL->fetch_array("select sum(totalM) from trade where bPay=1 and status>0 and status<4");
	?>
		<td width="85%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/graph_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ȸ�����, �Ǹ���Ȳ, �Ⱓ�� �������, ������ ������ Ȯ���ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="2">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width='440'><img src="image/graph_pay.gif"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td height='10'></td>
							</tr>
							<tr>
								<td height='5'></td>
							</tr>
							<tr valign="middle">
								<td>
									<table width="750" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="10">&nbsp;</td>
											<td width="60"> <div align="center"><a href="stat_graph_pay.php"><img src="image/graph_pay_year.gif" width="45" height="19" border="0"></a></div></td>
											<td width="60"> <div align="center"><a href="stat_graph_pay_m.php"><img src="image/graph_pay_month.gif" width="45" height="19" border="0"></a></div></td>
											<td width="60"> <div align="center"><a href="stat_graph_pay_d.php"><img src="image/graph_pay_day.gif" width="58" height="19" border="0"></a></div></td>
											<td>&nbsp;</td>
											<td width="15"><img src="image/graph_01_1.gif" width="10" height="10"></td>
											<td width="50">�Ǹż�</td>
											<td width="15"><img src="image/graph_02_1.gif" width="10" height="10"></td>
											<td width="65">�Ǹűݾ�</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='3'></td>
							</tr>
							<tr>
								<td valign="top">
									<table width="750" border="0" cellspacing="1" bgcolor='cdcdcd' cellpadding="0">
										<tr valign="middle">
											<td width="80" bgcolor="#EBEBEB" height="30"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ����</div></td>
											<td width="100" bgcolor="#EBEBEB" height="30"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �Ǹż�</div></td>
											<td bgcolor="#EBEBEB" width="130" height="30"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �Ǹűݾ�</div></td>
											<td bgcolor="#EBEBEB" height="30"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �׷���</div></td>
										</tr><?
										$qry = "select year(sday1),sum(cnt),sum(price) from trade_goods where status>0 and status<4 group by year(sday1) order by 1 asc;";
										$result = $MySQL->query($qry);
										$cnt =0;
										while($row = mysql_fetch_array($result))
										{
											if($total_buyNum[0])			  $cntP			= $row[1]/$total_buyNum[0]*100*2.3;					//���ż� �ۼ�Ʈ
											else				  	  $cntP			= 0;			//���ż� �ۼ�Ʈ
											$sumPrice		= $MySQL->fetch_array("select sum(payM) from trade where year(writeday)='$row[0]' and bPay=1 and status>0 and status<4");
											if($total_buyMoney[0])		  $priceP		= $sumPrice[0]/$total_buyMoney[0]*100*2.3;			//���ž� �ۼ�Ʈ
											else					  $priceP		= 0;
											$cnt++;
											?>
										<tr>
											<td width="80" height="30" bgcolor="ffffff"> <div align="center"><?=$row[0]?></div></td>
											<td width="100" height="30" bgcolor="ffffff"> <div align="center"><?=$row[1]?></div></td>
											<td width="130" height="30" bgcolor="ffffff"> <div align="center"><?=PriceFormat($sumPrice[0]);?></div></td>
											<td width="240" height="30" bgcolor="ffffff">
												<table width="240" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td height="10">
															<table width="240" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="5" height="10"></td>
																	<td width="230" height="10"><img src="image/graph_01.gif" width="<?=$cntP?>" height="10"></td>
																	<td width="5" height="10"></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="3"></td>
													</tr>
													<tr>
														<td height="10">
															<table width="240" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="5" height="10"></td>
																	<td width="230" height="10" ><img src="image/graph_02.gif" width="<?=$priceP?>" height="10"></td>
																	<td width="5" height="10"></td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr><?
											if ($sumPrice[0])
											{
												?>
										<tr bgcolor="ffffff">
											<td valign="middle" align="center"><?=$row[0]?>�⵵<br>���������</td>
											<td colspan="3">
												<table class="table_coll" border=1 width="80%" align="center">
													<tr align="center" height="30" bgcolor="fafafa">
														<td width="10%">����</td>
														<td width="20%">���̵�</td>
														<td width="20%">�̸�</td>
														<td width="40%">�Ǹž�</td>
													</tr><?
													$best_result  = $MySQL->query("SELECT userid,sum(payM),name,userid_part from trade WHERE year(sday1) = $row[0] and status>0 and status<4 group by userid order by 2 desc limit 5"); 
													$cnt=1;
													while ($best_row = mysql_fetch_array($best_result))
													{
														if ($best_row[userid_part] == "guest") $best_row[userid] = "��ȸ��";
														?>
													<tr align="center" height="30" <? if ($cnt==1) echo "bgcolor='#FAE1EC'";?>>
														<td><?=$cnt?>��</td>
														<td><?=$best_row[userid]?></td>
														<td><?=$best_row[name]?></td>
														<td><?=PriceFormat($best_row[1])?> ��</td>
													</tr><?
														$cnt++;
													}
													?>
												</table>
											</td>
										</tr><?
											}
										}
										?>
									</table>
								</td>
							</tr>
						</table><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>