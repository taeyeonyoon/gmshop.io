<?
include "head.php";
?>
<table width="850" border="0" cellspacing="3" cellpadding="0">
	<tr bgcolor="#EBEBEB" height=30>
		<td align="center"  width=10%>�ֹ���</td>
		<td align="center"  width=10%>�ֹ���ȣ</td>
		<td align="center" width=10%>�ֹ�������</td>
		<td align="center" width=30%>��ǰ��</td>
		<td align="center" width=12%>�ɼ�</td>
		<td align="center" width=12%>����/����</td>
		<td align="center" width=10%>�հ�</td>
		<td align="center" width=10%>�ŷ�����</td>
	</tr><?
	if ($all) $result = $MySQL->query("SELECT *from trade_goods order by idx desc");
	else $result = $MySQL->query("SELECT *from trade_goods WHERE userid='$userid' order by idx desc");
	while ($trade_goods_row = mysql_fetch_array($result))
	{
		$optionArr = Array("$trade_goods_row[option1]","$trade_goods_row[option2]","$trade_goods_row[option3]"); //�ɼ� �迭
		$tprice = $trade_goods_row[price]*$trade_goods_row[cnt]; //��ǰ�հ��� 
		$total_price+= $tprice;
		$goods_row = $MySQL->fetch_array("SELECT *from goods WHERE idx=$trade_goods_row[goodsIdx] limit 1");
		////////�ֹ���¥���� ��ǰ������ ���������� ������ ������¥ǥ�� 
		if ($trade_goods_row[sday1] < $goods_row[editday]) $editday = "<br><u>��ǰ���� �ֱټ����� : ".Substr($goods_row[editday],0,10)."</u>";
		else $editday = "";
		///////������������ �߸����ֹ���ǰ�� ������¥ǥ�� (������¥�� �ֹ��ð����� ������) 
		if (empty($editday) && ($goods_row[point] * $trade_goods_row[cnt]) != $trade_goods_row[goodsP]) $editday = "<br><u>��ǰ���� �ֱټ����� : ".Substr($goods_row[editday],0,10)." (����)</u>";
		$trade_row = $MySQL->fetch_array("SELECT userid,userid_part,name from trade WHERE tradecode='$trade_goods_row[tradecode]' limit 1");
		if ($trade_row[userid_part]=="guest") $member_str = $trade_row[name]."<br>��ȸ��";
		else $member_str = $trade_row[name]."<BR>".$trade_row[userid];
		?>
	<tr bgcolor="fafafa">
		<td align="center"><?=$member_str?></td>
		<td align="center"><?=$trade_goods_row[tradecode]?></td>
		<td align="center"><?=$trade_goods_row[sday1],0,10?></td>
		<td align="center"><?=$trade_goods_row[name]?> <?=$editday?></td>
		<td align="center"><div align="center">
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
			</table></div>
		</td>
		<td align="center"><?=PriceFormat($trade_goods_row[price])?> / <?=$trade_goods_row[cnt]?></td>
		<td align="center"><?=PriceFormat($tprice)?><br>���� : <?=PriceFormat($trade_goods_row[goodsP])?></td>
		<td align="center"><?=$TRADE_ARR[$trade_goods_row[status]]?></td>
	</tr>
	<tr>
		<td colspan="8" height="1" background="image/line_bg1.gif"></td>
	</tr><?
	}
	?>
	<tr>
		<td colspan=7 align="right"><b>���� : <?=PriceFormat($total_price)?> ��</b></td>
	</tr>
	<tr>
		<td colspan=7 align="right"><img src="image/close_btn.gif" border=0 onclick="javascript:self.close();" style="cursor:pointer"></b></td>
	</tr>
</table>