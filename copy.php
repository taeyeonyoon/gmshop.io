<?
// 20060721 ���Լ� : powered by �̹��� �߰�
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");
}
?>
<table width="900" border��0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan='2' height='1' bgcolor='e1e1e1'></td>
	</tr>
</table>
<table width="900" border="0" cellspacing="0" cellpadding="0">
	<tr bgcolor="<?=$design[copyBC]?>">
		<td colspan='2' height="35" style='padding:0 0 0 15'> <a href="company.php"><img src='image/index/copy01.gif' border='0' align='absmiddle'></a>  <a href="use_guide.php"><img src='image/index/copy02.gif' border='0' align='absmiddle'></a>  <a href="member_article.php"><img src='image/index/copy03.gif' border='0' align='absmiddle'></a>  <a href="person_guard.php"><img src='image/index/copy04.gif' border='0' align='absmiddle'></a>  <a href="cooperation.php"><img src='image/index/copy05.gif' border='0' align='absmiddle'></a><a href="ask_list.php"><img src='image/index/copy09.gif' border='0' align='absmiddle'></a></td>
		<td width='60'><a href='#top'><img src='image/index/btn_top.gif' border='0'></a></td>
	</tr>
</table>
<table width="900" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='1' bgcolor='e1e1e1'></td>
	</tr>
	<tr>
		<td height="80" valign="top" style='padding:5 0 0 0'>
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align='center'><img src="upload/design/<?=$design[copyLogo]?>"></td>
					<td align='center'><font class='stext' color="<?=$design[copyTC]?>">Copyright �� <?=$admin_row[comName]?> All Rights Reserved Any questions to <a href="javascript:sendMail('<?=$admin_row[adminEmail2]?>');"><U><?=$admin_row[adminEmail2]?></U></a><br><br>�����ŷ� ����ȸ���� ������ ǥ�ؾ���� ����մϴ�. <br>����Ǹž��Ű� �� <?=$admin_row[esailNum]?> ȣ,���� ��ȣ ����� : <?=$admin_row[guard]?>, ����ڵ�Ϲ�ȣ : <?=$admin_row[comNum]?> ��ǥ�� <?=$admin_row[comCeo]?> <br>Tel : <?=$admin_row[comTel]?>, Fax : <?=$admin_row[comFax]?>, �ּ� : <?=$admin_row[comAdr]?> [<?=$admin_row[comZip]?> ]</font></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align='right'><a href='http://webprogram.co.kr' target='_blank'><img src='image/index/poweredby.gif' border='0'></a></td>
	</tr>
</table>