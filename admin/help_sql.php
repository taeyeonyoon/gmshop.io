<?
include "head.php";
if ($qry)
{
	$qry = str_replace("\\","",$qry);
	if ($MySQL->query($qry))
	{
		OnlyMsgView("���� �Ǿ����ϴ�.");
	}
	else
	{
		$errMsg =  "�������࿡�� : ".mysql_error();
		OnlyMsgView("���� �Ͽ����ϴ�.");
	}
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function qry_start()
{
	<? if (__DEMOPAGE) { ?>
	alert("���������������� ������� ���ѵǾ��ֽ��ϴ�.");
	<? }else { ?>
	if (confirm("������ �����Ͻðڽ��ϱ�?"))
	{
		document.qry_form.submit();
	}
	<? } ?>
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "help";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
	}
	?>
		<td width="85%" valign="top" height='400'>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/help_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �⺻������ �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="2">
						<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td>
									<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width='440' height=30><img src="image/adm_icon.gif"> SQL �����</td>
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
								<td valign=top>
									<table width="95%"  border="0" cellspacing="1" cellpadding="3" align="center" bgcolor=''>
										<tr>
											<td colspan="2"><br><? if ($errMsg) echo $errMsg."<BR>"; ?>
												<form name="qry_form" method="post" action="<?=$PHP_SELF?>">
												<table width="80%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor='E6E6E6'>
													<tr align="center">
														<td height="30" bgcolor='082042'><font color='ffffff'><b>S&nbsp;&nbsp;Q&nbsp;&nbsp;L&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</b></td>
													<tr>
													<tr align="center">
														<td><textarea name="qry" cols="80" rows="10"><?=$qry?></textarea><br><input type="button" class="text" value=" �� �� " onclick="qry_start();"></td>
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