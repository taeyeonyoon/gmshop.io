<?
// ��ǰ���� ��ºκ� ���� include ����
//goods_list , search_result ���� ���̴� ��

// �ٵ��ǽ� �迭
if ($designType==1)
{
	while($goods_row=mysql_fetch_array($goods_result))
	{
		$gprice = new CGoodsPrice($goods_row[idx]);
		$show = 1;
		if ($show)
		{
			$LINK = "goods_detail.php?goodsIdx=$goods_row[idx]";
			?>
		<td height="180" valign="top">
			<table style="table-layout:fixed;" width="<?=($GOODS_LIST_WIDTH - 10)?>" border="0" cellspacing="2" cellpadding="0" align="center"><?
			$designType = 1;
			include "goods_detail_inc.php"; 
			?>
			</table>
		</td><?
			$list_cnt++; //ī��Ʈ ����
			if(! ($list_cnt%$GOODS_LIST_COL) && $list_cnt <$LIST_LIMIT)
			{
				//�ٴ��� �� ��ǰ�� �ƴϸ�
				?>
	</tr>
	<tr>
		<td height='1' bgcolor='dadada' colspan='<?=$GOODS_LIST_COL?>'></td>
	</tr>
	<tr valign="bottom"><?
			}
		}
	}
	if($list_cnt %$GOODS_LIST_COL)
	{
		//��ĭ���� <tr>�� ������ <td> ü��
		$empty_TD=$GOODS_LIST_COL - ($list_cnt %$GOODS_LIST_COL);
		for($i=0;$i<$empty_TD;$i++)
		{
			?>
		<td height="180" width="<?=$GOODS_LIST_WIDTH?>">&nbsp;</td><?
		}
	}
}
else if ($designType==2)
{
	?>
<table width=100% border=0 cellpadding='0' cellspacing='0'><?
	while($goods_row=mysql_fetch_array($goods_result))
	{
		$show = 1;
		if ($show)
		{
			$LINK = "goods_detail.php?goodsIdx=$goods_row[idx]";
			$gprice = new CGoodsPrice($goods_row[idx]);
			$designType = 2;
			include "goods_detail_inc.php";
		}
	}//while 
?>
</table>
<? /////////////ȥ�ս� �迭///////////// 
}
else if ($designType==3)
{
?>
<table width=100% border=0>
<?
	while($goods_row=mysql_fetch_array($goods_result))
	{
		$show = 1;
		if ($show)
		{
			$LINK = "goods_detail.php?goodsIdx=$goods_row[idx]";
			$gprice = new CGoodsPrice($goods_row[idx]);
			$designType = 3;
			include "goods_detail_inc.php";
		}
	}
?>
</table>
<?
}
?>