<?
include "head.php";
?>
<body bgcolor="#FFFFFF" text="#464646" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10">
<table width="790" border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='4'><img src='image/sub/table_tleft.gif'></td>
		<td width='782' background='image/sub/table_tbg.gif'></td>
		<td width='4'><img src='image/sub/table_tright.gif'></td>
	</tr>
	<tr>
		<td background='image/member/recommend_bg.gif' colspan='3' align='center'>
			<table width="780" border="0" cellspacing="0" cellpadding="0" align='center'>
				<tr>
					<td align='center'><img src="image/member/recommend_top.gif"></td>
				</tr>
				<tr>
					<td align='center'><br>
						<table width="770" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="2" colspan="13" bgcolor="#80C9D8"></td>
							</tr>
							<tr>
								<td height="1" colspan="13" bgcolor="#FFFFFF"></td>
							</tr>
							<tr bgcolor="#EDF7F9" align="center">
								<td height="30" width="10%">�ֹ���ȣ</td>
								<td width='1'><img src='image/board/line.gif'></td>
								<td width="10%">�ֹ�������</td>
								<td width='1'><img src='image/board/line.gif'></td>
								<td width="30%">��ǰ��</td>
								<td width='1'><img src='image/board/line.gif'></td>
								<td width="15%">�ɼ�</td>
								<td width='1'><img src='image/board/line.gif'></td>
								<td width="15%">����/����</td>
								<td width='1'><img src='image/board/line.gif'></td>
								<td width="10%">�հ�</td>
								<td width='1'><img src='image/board/line.gif'></td>
								<td width="10%">�ŷ�����</td>
							</tr>
							<tr>
								<td height="1" colspan="13" bgcolor="ffffff"></td>
							</tr>
							<tr>
								<td height="1" colspan="13" bgcolor="80c9d8"></td>
							</tr><?
							$data_arr = Decode64($data);
							$result = $MySQL->query("SELECT * from trade_goods WHERE userid='$data_arr[userid]' order by idx desc");
							while ($trade_goods_row = mysql_fetch_array($result))
							{
								$optionArr = Array("$trade_goods_row[option1]","$trade_goods_row[option2]","$trade_goods_row[option3]"); //�ɼ� �迭
								$tprice = $trade_goods_row[price]*$trade_goods_row[cnt]; //��ǰ�հ��� 
								$total_price+= $tprice;
								$goods_row = $MySQL->fetch_array("SELECT *from goods WHERE idx=$trade_goods_row[goodsIdx] limit 1");
								if ($trade_goods_row[sday1] < $goods_row[editday]) $editday = "<br><u>��ǰ���� �ֱټ����� : ".Substr($goods_row[editday],0,10)."</u>";
								else $editday = "";
								// ������������ �߸����ֹ���ǰ�� ������¥ǥ�� (������¥�� �ֹ��ð����� ������) 
								if (empty($editday) && ($goods_row[point] * $trade_goods_row[cnt]) != $trade_goods_row[goodsP]) $editday = "<br><u>��ǰ���� �ֱټ����� : ".Substr($goods_row[editday],0,10)." (����)</u>";
								?>
							<tr bgcolor="#FAFAFA" align="center">
								<td><?=$trade_goods_row[tradecode]?></td>
								<td width='1'></td>
								<td><?=$trade_goods_row[sday1],0,10?></td>
								<td width='1'></td>
								<td><?=$trade_goods_row[name]?> <?=$editday?></td>
								<td width='1'></td>
								<td>
									<table width="100" border="0" cellspacing="0" cellpadding="0"><?
									for($i=0;$i<count($optionArr);$i++)
									{
										if(!empty($optionArr[$i]))
										{
											$option = explode("����",$optionArr[$i]);
											?>
										<tr>
											<td width="45"  bgcolor="#F7F7F7"> <div align="center"><?=$option[0]?> </div></td>
											<td   bgcolor="#DDFFFB"> <div align="left"> : <?=$option[1]?></div></td>
										</tr>
										<tr  bgcolor="#CCCCCC">
											<td colspan="2" height="1"></td>
										</tr><?
										}
									}
									?>
									</table>
								</td>
								<td width='1'></td>
								<td><?=PriceFormat($trade_goods_row[price])?> / <?=$trade_goods_row[cnt]?></td>
								<td width='1'></td>
								<td><?=PriceFormat($tprice)?><br>���� : <?=PriceFormat($trade_goods_row[goodsP])?></td>
								<td width='1'></td>
								<td><?=$TRADE_ARR[$trade_goods_row[status]]?></td>
							</tr>
							<tr>
								<td colspan="13" height="1" bgcolor='#DDDDDD'></td>
							</tr><?
							}
							?>
						</table>
						<table width="770" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="right" height='35'><b>���� : <?=PriceFormat($total_price)?> ��</b></td>
							</tr>
							<tr>
								<td height='1' bgcolor='#DDDDDD'></td>
							</tr>
							<tr>
								<td align="center" height='45'><img src="image/icon/close.gif" border=0 onclick="javascript:self.close();" style="cursor:pointer"></b></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><img src='image/sub/table_bleft.gif'></td>
		<td background='image/sub/table_bbg.gif'></td>
		<td><img src='image/sub/table_bright.gif'></td>
	</tr>
</table>
</body>
</html>