<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function pageDel(pageIdx)
{
	var choose = confirm("�������� ������ �����˴ϴ�.\n\n���� �Ͻðڽ��ϱ�?");
	if(choose)
	{
		location.href="page_add_edit_ok.php?del=1&pageIdx="+pageIdx;
	}
	else return;
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "page";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	?>
		<td width="85%" valign="top" height='400'>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/page_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ���ο� �������� �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/page_tit.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height='10'></td>
				</tr>
				<tr>
					<td valign="top">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan="2" height="30" valign="top"> <div valign="middle"><B>- ���θ����� ���� ���ο� �������� ������� �Ҷ� �� ����� ����մϴ�.</B></div></td>
							</tr>
							<tr>
								<td colspan="2" height="30" valign="top"> <div valign="middle"><B>- �������ڵ� : ������ �ĺ��Ҽ� �ִ� ������ ������</B></div></td>
							</tr>
							<tr>
								<td colspan="2" height="30" valign="top"> <div valign="middle"><B>- ����� �ش������� ��ũ��� : ./new_page.php?code=<FONT  COLOR="#CC0000">�������ڵ�</FONT></B></div></td>
							</tr>
							<tr>
								<td colspan="2" height="30" valign="top"> <div valign="middle"><B>- ��) : http://������ ������/new_page.php?code=<FONT  COLOR="#CC0000">event</FONT></B></div></td>
							</tr>
							<tr>
								<td valign="top" height="25">
									<table width="750" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor='cdcdcd'>
										<tr>
											<td width="50" height="30" valign="middle" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ȣ</div></td>
											<td width="200" valign="middle" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ������ �ڵ�</div></td>
											<td width="200" height="30" valign="middle" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ������ ����</div></td>
											<td height="30" valign="middle" width="100" bgcolor="#EBEBEB"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ����/����</div></td>
										</tr><?
										$qry = "select *from page order by idx asc";
										$result = $MySQL->query($qry);
										$cnt=0;
										while($row = mysql_fetch_array($result))
										{
											$cnt++;
											?>
										<tr>
											<td width="50" height="30" valign="middle" bgcolor="ffffff"> <div align="center"><?=$cnt?></div></td>
											<td width="200" height="30" valign="middle" bgcolor="ffffff"> <div align="center"><B><FONT COLOR="#CC0000"><?=$row[code]?></FONT></B></div></td>
											<td width="200" height="30" valign="middle" bgcolor="ffffff"> <div align="center"><?=$row[title]?></div></td>
											<td height="30" valign="middle" width="100" bgcolor="ffffff"> <div align="center"><a href="page_add_edit.php?pageIdx=<?=$row[idx]?>"><img src="image/page_01.gif" width="35" height="23" border="0"></a><a href="javascript:pageDel('<?=$row[idx]?>');"><img src="image/page_02.gif" width="35" height="23" border="0"></a></div></td>
										</tr><?
										}
										?>
									</table>
								</td>
							</tr>
							<tr>
								<td height="50"><div align="center"><a href="page_add_write.php"><img src="image/page_btn.gif" width="62" height="33" border="0"></a></div></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>