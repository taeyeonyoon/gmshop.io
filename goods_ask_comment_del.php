<?
include "head.php";
$row = $MySQL->fetch_array("SELECT *from good_board_comment where idx=$idx");
if ($com_del)
{
	$MySQL->query("SELECT * from good_board_comment where re_pwd='$re_pwd' and idx='$idx' limit 1");
	if ($MySQL->is_affected())
	{
		$qry = "DELETE from good_board_comment where idx=$idx";
		if ($MySQL->query($qry))
		{
			echo "<script>
			alert('�������� �����Ǿ����ϴ�')
			opener.location.reload();
			self.close();
			</script>";
			exit;
		}
	}
	else
	{
		MsgView("��й�ȣ�� ��ġ���� �ʽ��ϴ�.",-1);
		exit;
	}
}
?>
<script language="javascript">
function submit2()
{
	if (!document.form.re_pwd.value)
	{
		alert('��й�ȣ�� �Է��ϼ���.');
	}
	else
	{
		document.form.com_del.value = 1;
		document.form.submit();
	}
}
</script>
<body topmargin='10' leftmargin='10' text='464646'>
<table width="280" border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='4'><img src='image/sub/table_tleft.gif'></td>
		<td width='272' background='image/sub/table_tbg.gif'></td>
		<td width='4'><img src='image/sub/table_tright.gif'></td>
	</tr>
	<tr>
		<td background='image/sub/idsearch_bg.gif' colspan='3' align='center'>
			<table border="0" width=100% cellspacing=0 cellpadding='0' align="center">
				<tr>
					<td colspan="2" align="center" valign='top'><img src='image/work/comment.gif'></td>
				</tr>
				<tr>
					<td>
						<form name="form" method="post" action="goods_ask_comment_del.php" onsubmit="javascript:submit2();">
						<input type="hidden" name="com_del">
						<input type="hidden" name="idx" value="<?=$idx?>">
						<table border="0" width=90% cellspacing=0 cellpadding='0' align="center">
							<tr>
								<td align="center" valign="middle" width='70' height='45'>��й�ȣ</td>
								<td><input type="password" name="re_pwd" size=15 onKeyPress="javascript:if(event.keyCode==13) {submit2();}" class='box_s'>&nbsp;<a href="javascript:submit2();"><img src='image/icon/ok.gif' border='0' align='absmiddle'></a></td>
							</tr>
							<tr>
								<td colspan='3' height='20' align='center'><font class='stext'>�ڸ�Ʈ�ۼ��� �����ֽ� ��й�ȣ�Դϴ�.</font></td>
							</tr>
						</table>
						</form>
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