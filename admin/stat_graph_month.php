<?
include "head.php";
$MEMBER_TITLE = "ȸ������";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function searchSendit()
{
	document.dayForm.submit();
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "data";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(empty($toy))
	{
		$today = date("Y-m");
		$toy   = date("Y");
		$tom   = date("m");
	}
	else
	{
		$today = $toy."-".$tom;
	}
	$MySQL->query("select *from member");
	$total_member = $MySQL->is_affected();
	$MySQL->query("select *from member where left(writeday,7) ='$today'");
	$today_member = $MySQL->is_affected();
	if(empty($total_member))      $avg_member = 0;
	else			  $avg_member = sprintf("%01.2f",$today_member/$total_member*320);
	//�Ǹż�
	$MySQL->query("select *from trade where bPay=1 and status>0 and status<4 $SHOP_LIKE_STR");
	$total_trade = $MySQL->is_affected();
	$MySQL->query("select *from trade where left(writeday,7) ='$today' and bPay=1 and status>0 and status<4 $SHOP_LIKE_STR");
	$today_trade  = $MySQL->is_affected();
	if(empty($total_trade))		$avg_trade = 0;
	else					$avg_trade = sprintf("%01.2f",$today_trade/$total_trade*320);
	//�Ǹűݾ�
	$total_sum_money = $MySQL->fetch_array("select sum(totalM) from trade where bPay=1 and status>0 and status<4 $SHOP_LIKE_STR");
	$today_sum_money = $MySQL->fetch_array("select sum(totalM) from trade where left(writeday,7) ='$today' and bPay=1 and status>0 and status<4 $SHOP_LIKE_STR");
	if(empty($total_sum_money[0]))	$avg_sum_money = 0;
	else $avg_sum_money = $today_sum_money[0]/$total_sum_money[0]*320;
	$today_ask =  $MySQL->articles("SELECT idx from good_board where left(writeday,7) ='$today'");//��ǰ���� 
	$MySQL->query("select *from bbs_data where left(writeday,7) ='$today'");
	$today_bbs		= $MySQL->is_affected();//�Խ��� 
	$MySQL->query("select *from trade_goods where left(sday1,7) ='$today' $SHOP_STR group by tradecode");
	$today_sday1		= $MySQL->is_affected();
	$MySQL->query("select *from trade_goods where left(sday2,7) ='$today' and status=1 $SHOP_STR group by tradecode");
	$today_sday2		= $MySQL->is_affected();//����Ȯ����
	$MySQL->query("select *from trade_goods where left(sday3,7) ='$today' and status=2 $SHOP_STR group by tradecode");
	$today_sday3		= $MySQL->is_affected();//����� 
	$MySQL->query("select *from trade_goods where left(sday4,7) ='$today' and status=3 $SHOP_STR group by tradecode");
	$today_sday4		= $MySQL->is_affected();//��ۿϷ�
	$MySQL->query("select *from trade_goods where left(sday5,7) ='$today' and status=4 $SHOP_STR group by tradecode");
	$today_sday5		= $MySQL->is_affected();//�ֹ����
	$today_card_money= $MySQL->fetch_array("select sum(payM) from trade where payMethod='card' and left(writeday,7) ='$today' and status>0 and status<4 $SHOP_LIKE_STR");//ī��
	$today_bank_money= $MySQL->fetch_array("select sum(payM) from trade where payMethod='bank' and left(writeday,7) ='$today' and status>0 and status<4 $SHOP_LIKE_STR");//������
	$today_iche_money= $MySQL->fetch_array("select sum(payM) from trade where payMethod='iche' and left(writeday,7) ='$today' and status>0 and status<4 $SHOP_LIKE_STR");//�ڵ��� 
	$today_hpp_money= $MySQL->fetch_array("select sum(payM) from trade where payMethod='hpp' and left(writeday,7) ='$today' and status>0 and status<4 $SHOP_LIKE_STR");//������ü 
	$today_useP	    = $MySQL->fetch_array("select sum(useP) from trade where left(writeday,7) ='$today' and status>0 and status<4 $SHOP_LIKE_STR");//������
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
								<td bgcolor="#E6E6E6" height='26'></td>
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
											<td width='440'><img src="image/graph_month.gif"></td>
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
								<td height="1" background="image/line_bg1.gif" bgcolor="#F5F5F5"></td>
							</tr>
							<tr>
								<td height="30" bgcolor="#F5F5F5">
									<form name="dayForm" method="post" action="stat_graph_month.php">
									<table width="280" border="0" align="center">
										<tr bgcolor="#F5F5F5">
											<td width="90"> <select name="toy"><?
											for($i=2003;$i<2007;$i++)
											{
												if(strlen($i)==1) $i="0".$i;
												?><option value="<?=$i?>" <?if($toy==$i)echo"selected";?>><?=$i?></option><?
											}
											?></select>�� </td>
											<td width="90"><select name="tom"><?
											for($i=1;$i<13;$i++)
											{
												if(strlen($i)==1) $i="0".$i;
												?><option value="<?=$i?>" <?if($tom==$i)echo"selected";?>><?=$i?></option><?
											}
											?></select>�� </td>
											<td width="90"><a href="javascript:searchSendit();"><img src="image/bbs_search_btn.gif" width="41" height="23" border="0"></a></td>
										</tr>
									</table></form>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif" bgcolor="#F5F5F5"></td>
							</tr>
							<tr>
								<td height='5'></td>
							</tr>
							<tr valign="middle">
								<td valign="top">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor='CDCDCD'>
										<tr>
											<td width="25%" height="30" valign="middle" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ���� </div></td>
											<td width="15%" height="30" valign="middle" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��</div></td>
											<td width="60%" height="30" valign="middle" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �׷���</div></td>
										</tr>
										<tr>
											<td width="25%" height="25" valign="middle" bgcolor="ffffff"> <div align="center"><?=$MEMBER_TITLE?></div></td>
											<td width="15%" height="25" valign="middle" bgcolor="ffffff"> <div align="center"><?=$today_member?> ��</div> </td>
											<td width="60%" height="25" valign="middle" bgcolor="ffffff">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="5" height="10"></td>
														<td width="380"height="10"><img src="image/graph_01.gif" width="<?=$avg_member?>" height="10"> (<?=intval($avg_member/3.2)?>%)</td>
														<td width="5" height="10"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td width="25%" height="25" valign="middle" bgcolor="ffffff"><div align="center">�ֹ��� </div></td>
											<td width="15%" height="25" valign="middle" bgcolor="ffffff"><div align="center"><?=$today_trade?> ��</div> </td>
											<td width="60%" height="25" valign="middle" bgcolor="ffffff">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="5" height="10"></td>
														<td width="380"height="10"><img src="image/graph_02.gif" width="<?=$avg_trade?>" height="10"> (<?=intval($avg_trade/3.2)?>%)</td>
														<td width="5" height="10"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="25" valign="middle" bgcolor="ffffff"><div align="center">�ֹ��ݾ� </div></td>
											<td height="25" valign="middle" bgcolor="ffffff"><div align="center"><?=PriceFormat($today_sum_money[0])?> ��</div></td>
											<td height="25" valign="middle" bgcolor="ffffff">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="5" height="10"></td>
														<td width="380"height="10"><img src="image/graph_03.gif" width="<?=$avg_sum_money?>" height="10"> (<?=intval($avg_sum_money/3.2)?>%)</td>
														<td width="5" height="10"></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='15'></td>
							</tr>
							<tr valign="middle">
								<td valign="top">
									<table width="70%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor='E6E6E6'>
										<tr>
											<td>
												<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor='cdcdcd'>
													<tr>
														<td colspan='2' height="30" bgcolor='9C9A9C'><font color='ffffff'><b><div align='center'>�̴��� SHOP ��Ȳ</div></b></font></td>
													</tr>
													<tr>
														<td height="25" bgcolor='f5f5f5'>&nbsp;&nbsp;<b>�� �ֹ� ������</b></td>
														<td width="30%" bgcolor='f5f5f5'><div align="right"><b><?=$today_sday1?>��</b></div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;<?=$TRADE_ARR[1]?></td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=$today_sday2?>��</div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;<?=$TRADE_ARR[2]?></td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=$today_sday3?> ��</div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;<?=$TRADE_ARR[3]?></td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=$today_sday4?> ��</div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;<?=$TRADE_ARR[4]?></td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=$today_sday5?> ��</div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;ī����� �ݾ�</td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=PriceFormat($today_card_money[0])?> ��</div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;������ �Աݾ� </td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=PriceFormat($today_bank_money[0])?> �� </div></td>
													</tr>
													<tr>
														<td width="60%" height="25" bgcolor='ffffff'>&nbsp;&nbsp;������ü �Աݾ� </td>
														<td bgcolor='ffffff'><div align="right"><?=PriceFormat($today_iche_money[0])?> �� </div></td>
													</tr>
													<tr>
														<td width="60%" height="25" bgcolor='ffffff'>&nbsp;&nbsp;�ڵ��� �Աݾ� </td>
														<td bgcolor='ffffff'><div align="right"><?=PriceFormat($today_hpp_money[0])?> �� </div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;������ ���ݾ�</td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=PriceFormat($today_useP[0])?> ��</div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;��ǰ����</td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=PriceFormat($today_ask)?> ��</div></td>
													</tr>
													<tr>
														<td height="25" bgcolor='ffffff'>&nbsp;&nbsp;�Խ��� �� </td>
														<td width="30%" bgcolor='ffffff'><div align="right"><?=$today_bbs?>�� </div></td>
													</tr>
												</table>
											</td>
										</tr>
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