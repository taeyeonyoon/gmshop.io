<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function trade(str)
{
	window.open("member_trade.php?userid="+str,"","scrollbars=yes,left=20,top=50,width=820,height=500");
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "data";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	$__SHOW_LIMIT = 10;
	//�ֹ��� ���� ���� 10���� �湮��,�ֹ���,�Ǹűݾ� ��
	$total_accNum	= $MySQL->fetch_array("select sum(accNum)   from member order by buyNum desc limit 0,$__SHOW_LIMIT");	
	$total_buyNum	= $MySQL->fetch_array("select sum(buyNum)   from member order by buyNum desc limit 0,$__SHOW_LIMIT");
	$total_buyMoney = $MySQL->fetch_array("select sum(buyMoney) from member order by buyNum desc limit 0,$__SHOW_LIMIT"); 
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
											<td width='440'><img src="image/graph_sale.gif"></td>
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
								<td colspan="5" height="15">
									<table width="750" height="25" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="340">&nbsp;</td>
											<td width="15"><img src="image/graph_01_1.gif" width="10" height="10"></td>
											<td width="50"> �湮��</td>
											<td width="15"><img src="image/graph_02_1.gif" width="10" height="10"></td>
											<td width="50">�ֹ���</td>
											<td width="15"><img src="image/graph_03_1.gif" width="10" height="10"></td>
											<td width="65">�Ǹűݾ�</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr valign="middle">
								<td valign="top">
									<table width="750" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor='cdcdcd'>
										<tr>
											<td width="50" height="30" valign="middle" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ȣ </div></td>
											<td width="100" valign="middle" bgcolor="#EBEBEB"><div align="center"><img src="image/icon.gif" width="11" height="11"> ID </div></td>
											<td width="100" valign="middle" bgcolor="#EBEBEB"><div align="center"><img src="image/icon.gif" width="11" height="11"> ���� </div></td>
											<td width="100" valign="middle" bgcolor="#EBEBEB"><div align="center"><img src="image/icon.gif" width="11" height="11"> ��� </div></td>
											<td width="80" height="30" valign="middle" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �ֹ���</div></td>
											<td width="120" height="30" valign="middle" bgcolor="#EBEBEB"><div align="center"><img src="image/icon.gif" width="11" height="11"> �Ǹűݾ� </div></td>
											<td valign="middle" bgcolor="#EBEBEB"><div align="center"><img src="image/icon.gif" width="11" height="11"> �׷���</div></td>
										</tr><?
										$qry = "select *from member order by buyNum desc limit 0,$__SHOW_LIMIT";
										$result = $MySQL->query($qry);
										$cnt =0;
										while($row = mysql_fetch_array($result))
										{
											if(empty($total_accNum[0])) $accPercent   = 0;
											else $accPercent   = $row[accNum]/$total_accNum[0]*100*2;			//�湮�� �ۼ�Ʈ
											if(empty($total_buyNum[0])) $buyPercent   = 0;
											else $buyPercent	= $row[buyNum]/$total_buyNum[0]*100*2;			//���ż� �ۼ�Ʈ
											if(empty($total_buyMoney[0])) $buyMPercent  = 0;
											else $buyMPercent	= $row[buyMoney]/$total_buyMoney[0]*100*2;			//���ž� �ۼ�Ʈ
											$cnt++;
											?>
										<tr>
											<td  height="40" valign="middle" bgcolor="ffffff"> <div align="center"><?=$cnt?></div></td>
											<td  height="40" valign="middle" bgcolor="ffffff"><div align="center"><a href="javascript:trade('<?=$row[userid]?>');"><u><b><?=$row[userid]?></b></u></a></div></td>
											<td  height="40" valign="middle" bgcolor="ffffff"><div align="center"><?=$row[name]?></div></td>
											<td  height="40" valign="middle" bgcolor="ffffff"><div align="center"><?
											if ($row[part]=="M")
											{
												echo "ȸ��";
											}
											else if ($row[part]=="D")
											{
												echo "<font color=green>����</font>";	
											}
											?></div></td>
											<td  height="40" valign="middle" bgcolor="ffffff"> <div align="center"><?=$row[buyNum]?></div></td>
											<td  height="40" valign="middle" bgcolor="ffffff"><div align="right"><?=PriceFormat($row[buyMoney])?> ��</div></td>
											<td height="40" valign="middle" bgcolor="ffffff">
												<table width="210" border="0" cellspacing="0" cellpadding="0">
													<tr align="left">
														<td height="10" align="left">
															<table width="210" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="5" height="10"></td>
																	<td width="200" height="10"><img src="image/graph_01.gif" width="<?=$accPercent?>" height="10"></td>
																	<td width="1" height="10"></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="3"></td>
													</tr>
													<tr>
														<td height="10">
															<table width="210" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="5" height="10"></td>
																	<td width="200" height="10"><img src="image/graph_02.gif" width="<?=$buyPercent?>" height="10"></td>
																	<td width="1" height="10"></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="3"></td>
													</tr>
													<tr>
														<td height="10">
															<table width="210" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="5" height="10"></td>
																	<td width="200" height="10"><img src="image/graph_03.gif" width="<?=$buyMPercent?>" height="10"></td>
																	<td width="1" height="10"></td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr><?
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