<?
// �ҽ��������
// 20060724-1 ���ϱ�ü �輺ȣ
// 20060724-2 �ҽ����� �輺ȣ : [��ǰ����] (������ġ) ��ǰ�󼼺��� ��ǰ���� ��� �۹�ȣ �ߺ�
session_start();
include "./lib/config.php";
include "./lib/function.php";
if(!defined(__INCLUDE_CLASS_PHP)) include "./lib/class.php";
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");
}
if(!defined(__DESIGN_ROW))
{
	define(__DESIGN_ROW,"TRUE");
	$design=$MySQL->fetch_array("select *from design limit 0,1");
}
if(!defined(__DESIGN_GOODS_ROW))
{
	define(__DESIGN_GOODS_ROW,"TRUE");
	$design_goods=$MySQL->fetch_array("select *from design_goods limit 0,1");
}
$__SITE_ALIGN = $design[mainAlign];			//����Ʈ ������� ex)left, center
?>
<html>
<head>
<title><?=$admin_row[shopTitle]?></title>
<style>
<?=$design[css]?>
</style>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language=javascript src="./script/admin.js"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
function goods_ask(gidx)
{
	<?if($GOOD_SHOP_PART=="member"){?>
	var userid = "<?=$GOOD_SHOP_USERID?>";
	if (userid=="")
	{
		userid = "guest";
	}
	window.open("goods_ask.php?gidx="+gidx+"&userid="+userid,"","scrollbars=yes,width=620,height=400,top=50,left=300");
	<?}else{?>
	alert("ȸ�� �α����� �̿��ϽǼ� �ֽ��ϴ�.");
	<?}?>
}
function ask_view(idx)
{
	window.open("goods_ask_view.php?idx="+idx,"","scrollbars=yes,width=620,height=400,top=50,left=300");
}
//-->
</SCRIPT>
</head>
<table width="630" border="0" cellspacing="1" cellpadding="0" align="center">
	<tr>
		<td colspan='6' bgcolor='cdcdcd'></td>
	</tr>
	<tr bgcolor="f1f1f1">
		<td align="center" width="40" height=30>��ȣ</td>
		<td align="center" >��������</td>
		<td align="center" width="100">�۾���</td>
		<td align="center" width="100">��¥</td>
		<td align="center" width="50">��ȸ</td>
		<td align="center" width="50">���</td>
	</tr>
	<tr>
		<td colspan='6' bgcolor='cdcdcd'></td>
	</tr><?
	$data=Decode64($data);
	$pagecnt=$data[pagecnt];
	$offset=$data[offset];
	$total_list_qry = "SELECT * from good_board WHERE gidx=$gidx";
	$numresults=$MySQL->query($total_list_qry);
	$numrows=mysql_num_rows($numresults);
	$LIMIT		=5;										//�������� �� ��
	$PAGEBLOCK	=10;									//���� ������ ��
	if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ
	if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;}	//�� �������� ���� ��
	$letter_no=$numrows - $offset;						//���۱� ��ȣ
	$list_qry = $total_list_qry." order by idx desc limit $offset,$LIMIT";
	$good_board_result=$MySQL->query($list_qry);
	if ($numrows)
	{
		while ($good_board_row = mysql_fetch_array($good_board_result))
		{
			$reply_num = $MySQL->articles("SELECT idx from good_board_comment WHERE boardidx=$good_board_row[idx]");
			?>
	<tr bgcolor='ffffff' height='25'>
		<td align="center"><?=$letter_no?></td>
		<td align="center"><a href="#;" onclick="javascript:ask_view(<?=$good_board_row[idx]?>);"><?=$good_board_row[title]?></a></td>
		<td align="center"><?=$good_board_row[name]?></td>
		<td align="center"><?=substr($good_board_row[writeday],0,10)?></td>
		<td align="center"><?=$good_board_row[readnum]?></td>
		<td align="center"><?=$reply_num?></td>
	</tr>
	<tr>
		<td colspan='6' bgcolor='cdcdcd'></td>
	</tr><?
			$letter_no--;
		}
	}
	else
	{
		// ��ǰ���� ������
		?>
	<tr>
		<td colspan="5" align=center>�ش� ��ǰ�� ���õ� ��ǰ Q&A�� �����ϴ�.</td>
	</tr><?
	}
	?>
</table><?
$OptionStr = "gidx=$gidx";
$Obj=new CList("goods_board.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,$OptionStr);
?>
<table width="600" border="0" cellspacing="0" cellpadding="2" align="center">
	<tr>
		<td align="center"><?$Obj->putList(false,"<img src='image/board/btn_prev.gif'>","<img src='image/board/btn_next.gif'>");//�������� ����Ʈ?></td>
	</tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="2" align="center">
	<tr>
		<td align="right"><a href="javascript:goods_ask('<?=$gidx?>');"><img src='image/work/ask_write.gif' border='0'></a></td>
	</tr>
</table>
</body>
</html>