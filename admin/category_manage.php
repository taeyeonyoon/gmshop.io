<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function edit(Obj)
{
	<? if (__DEMOPAGE){ ?>
	alert("������������ ���������� �����ϴ�.");
	<? }else { ?>
	Obj.submit();
	<? } ?>
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "category";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");	// ������ ���� �迭
	}
	$result = $MySQL->query("SELECT *from category order by position asc");
	?>
		<td width="100%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/cate_tit.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ī�װ� ���� ���� ��� ���� �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td width='1' bgcolor='dadada'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/cate_tit3.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="90%" border="1" cellspacing="0" cellpadding="1" align="center" class="table_coll">
							<tr valign="middle" bgcolor="#FAFAFA">
								<td width="40%" height="25" align="center"> ī�װ��� </td>
								<td width="10%" align="center"> �� �� </td>
								<td width="10%" align="center"> �������� </td>
								<td width="15%" align="center"> ������</td>
								<td width="25%" align="center"> ī�װ� �����μ��� </td>
							</tr><?
							$cnt=0;
							while ($row = mysql_fetch_array($result))
							{
								$cnt++;
								?>
							<form name="cateForm<?=$cnt?>" method="post" action="category_manage_ok.php" enctype="multipart/form-data" >
							<input type="hidden" name="parentcode" value="<?=$row[code]?>">
							<tr>
								<td align="center"><input type="text" class="box" size=30 name="name" value="<?=$row[name]?>"></td>
								<td align="center"><input type="checkbox" name="bHide" value="1" <? if ($row[bHide]) echo "checked";?>></td>
								<td align="center"><a href="#;" onclick="javascript:edit(document.cateForm<?=$cnt?>);"><img src="image/edit_btn.gif" border=0></a></td>
								<td align="center" bgcolor="f5f5f5"><a href="category_edit.php?parentcode=<?=$row[code]?>"><img src="image/statusview.gif" border=0></a></td>
								<td align="center" bgcolor="f5f5f5"><a href="category_design.php?parentcode=<?=$row[code]?>"><img src="image/statusview.gif" border=0></a></td>
							</tr>
							</form><?
							}
							?>
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