<?
// �ҽ��������
// 20060720-1 �ҽ����� �輺ȣ : ������� ���� ����ȭ(ī��, �ڵ���, ������ü, �������, ������)
//								ī���Ա� �����ݾ׿� Ÿ �������ܿ� ���� ������κе� ����Ͽ� ��� ������� ����
$now = date("YmdHis",time());
$EXCEL_NAME = "trans_".$now;
if($_GET[excel])
{
	header( "Content-type: application/vnd.ms-excel; charset=ks_c_5601-1987");
	header( "Content-Disposition: attachment; filename=$EXCEL_NAME.xls");
	header( "Content-Description: PHP4 Generated Data");
}
include "head.php";
echo "<script>document.title = '����Ȯ���ֹ� �߼��غ��ڷ� $now';</script>";
?>
<script language="javascript">
<?
if ($excel)
{
	?>
document.getElementById('click_id').style.display = "none";
<?
}
?>
function excel2()
{
	document.getElementById('click_id').style.display = "none";
	location.href="trade_goods_trans.php?excel=1";
}
</script>
<table width=1600 cellspacing="1" cellpadding="0" bordercolor="#000000" border=1>
	<tr bgcolor="eeeeee" height=30>
		<td width=3% align=center>��ȣ</td>
		<td width=4% align=center>�ֹ���¥</td>
		<td width=4% align=center>��۷�</td>
		<td width=4% align=center>����</td>
		<td width=4% align=center>��۹��</td>
		<td width=10% align=center>�䱸����</td>
		<td width=4% align=center>�ֹ���</td>
		<td width=4% align=center>������</td>
		<td align=center width=200>��ǰ/�ɼ�/â��/����</td>
		<td width=4% align=center>����</td>
		<td width=4% align=center>�ܰ�</td>
		<td width=4% align=center>ī���Ա�<br>�����ݾ�</td>
		<td width=4% align=center>�հ�</td>
		<td width=4% align=center>�Ѱ�</td>
		<td width=4% align=center>�ֹ��ڵ�</td>
		<td width=10% align=center>�ּ�</td>
		<td width=5% align=center>��������ȭ</td>
		<td width=5% align=center>�������ڵ���</td>
		<td width=5% align=center>�������̸���</td>
		<td width=4% align=center>ID</td>
	</tr><?
	$trade_result = $MySQL->query("SELECT trade.* from trade,trade_goods as tg WHERE trade.tradecode=tg.tradecode and trade.status=1 and tg.status=1 group by trade.tradecode order by trade.idx asc");
	$cnt=0;
	while ($trade_row = mysql_fetch_array($trade_result))
	{
		$cnt++;
		?>
	<tr>
		<td height=25 align=center><?=$cnt?></td>
		<td align=center><?=Substr($trade_row[writeday],2,8)?></td>
		<td align=center><?echo PriceFormat($trade_row[transM]);?></td>
		<td align=center><?
		if ($trade_row[level_gubun]=='D' && $trade_row[payMethod]=="bank") echo "����";
		else echo "�Ҹ�";
		?></td>
		<td align=center><?
		if ($trade_row[transMethod]=="T") echo "�ù�";
		else if ($trade_row[transMethod]=="K") echo "�浿ȭ��";
		else if ($trade_row[transMethod]=="Q") echo "�����";
		else	echo "&nbsp;";
		?></td>
		<td align=center><?
		if(""==$trade_row[content]) echo "&nbsp;";
		else	echo $trade_row[content];
		?></td>
		<td align=center><?=$trade_row[name]?></td>
		<td align=center><?=$trade_row[rname]?></td>
		<td align=center>
			<table width=100% border=0><?
			$trade_goods_result = $MySQL->query("SELECT *from trade_goods WHERE tradecode='$trade_row[tradecode]' and status=1");
			$tg_cnt=0;
			while ($trade_goods_row = mysql_fetch_array($trade_goods_result))
			{
				$goods_row = $MySQL->fetch_array("SELECT chango from goods WHERE idx=$trade_goods_row[goodsIdx] limit 1");
				echo "<tr>";
				///////////�Ϲݿɼ�//////////////
				$optionArr = Array("$trade_goods_row[option1]","$trade_goods_row[option2]","$trade_goods_row[option3]");	//�ɼ� �迭
				$OPTION_STR = "";
				$PRICE_OPTION_STR = "";
				for($i=0;$i<count($optionArr);$i++)
				{
					if(!empty($optionArr[$i]))
					{
						$option = explode("����",$optionArr[$i]);
						$OPTION_STR.= $option[0].":".$option[1];
						$OPTION_COLOR = "<font color=blue>";
					}
					else $OPTION_COLOR = "<font color=black>";
				}
				$OPTION_COLOR = "<font color=black>";
					?>
					<td><?=$trade_goods_row[name]?><?
						if ($OPTION_STR) echo "<font color=blue><br>[$OPTION_STR]</font>";
						if ($PRICE_OPTION_STR) echo "<font color=red><br>[$PRICE_OPTION_STR]</font>";
						if ($goods_row[chango]) echo "[".$goods_row[chango]."]";
						?></td>
					<td width=10% align=right valign=top><?=$trade_goods_row[cnt]?></td>
				</tr><?
				$tg_cnt++;
			}
				?>
			</table>
		</td>
		<td align=center><?
		switch($trade_row[payMethod]):
			case 'card':	$pg_rate = $admin_row[pg_rate];			echo "CC";	break;
			case 'hand':	$pg_rate = $admin_row[pg_rate_hand];	echo "CH";	break;
			case 'iche':	$pg_rate = $admin_row[pg_rate_iche];	echo "CI";	break;
			case 'cyber':	$pg_rate = $admin_row[pg_rate_cyber];	echo "CV";	break;
			case 'bank':	$pg_rate = 0;							echo "OL";	break;
			default :		$pg_rate = 0;							echo "&nbsp;";	break;
		endswitch;
		?></td>
		<?
		$trade_goods_result = $MySQL->query("SELECT *from trade_goods WHERE tradecode='$trade_row[tradecode]' and status=1");
		$tg_num = mysql_num_rows($trade_goods_result);
		$good_price = "";
		$card_price = "";
		$total_price = "";
		$BR_STR ="<BR>";
		$tg_cnt = 1;
		while ($trade_goods_row = mysql_fetch_array($trade_goods_result))
		{
			if ($tg_cnt == $tg_num) $BR_STR = "";	/// �Ǹ������� BR ���ϵ��� üũ
			$good_price.= PriceFormat($trade_goods_row[price]).$BR_STR;
			$card_price.= "<font color=red>".PriceFormat($trade_goods_row[price] - ($trade_goods_row[price] * ($pg_rate * 0.01)))."</font>".$BR_STR;
			$total_price.=PriceFormat($trade_goods_row[price] * $trade_goods_row[cnt]).$BR_STR;
			$tg_cnt++;
		}
		?>
		<td align=center><?=$OPTION_COLOR?><?=$good_price?></font></td>
		<td align=center><? if ($trade_row[payMethod]=="bank") echo "&nbsp;"; else echo $card_price;?></td>
		<td align=center><?=$total_price?></td>
		<td align=center><?=PriceFormat($trade_row[payM])?></td>
		<td align=center><?=$trade_row[tradecode]?></td>
		<td align=center><?="[".$trade_row[rzip]."]"."/".$trade_row[radr1]." ".$trade_row[radr2]?></td>
		<td align=center><?=$trade_row[rtel]?></td>
		<td align=center><?=$trade_row[rhand]?></td>
		<td align=center><?=$trade_row[email]?></td>
		<td align=center><?=$trade_row[userid]?></td>
	</tr>
	<?
	}//while

	if(!$excel)
	{
		?>
	<tr id="click_id">
		<td height=50 colspan=20 align=center>&nbsp;&nbsp;&nbsp;<a href="javascript:excel2();" style="cursor:pointer;"><img src="image/excel_down.gif"></a>&nbsp;&nbsp;&nbsp;<img src="image/close_btn.gif" onclick="self.close();" style="cursor:pointer;"></td>
	</tr><?
	}
		?>
</table>