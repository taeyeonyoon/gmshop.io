<?
session_start();
include "./lib/config.php";
include "./lib/function.php";
$qry = "select * from page where code='$code'";
$page_row = $MySQL->fetch_array($qry);
if(!$page_row)
{
	// ������ �ڵ� ����
	echo"<B>- ������ �ڵ� �Է��� �ùٸ��� �ʽ��ϴ�.<P>- �ش������� ��ũ��� : ./new_page.php?code=<FONT COLOR='#CC0000'>�ش��ڵ�</FONT></B>";
	exit;
}
else
{
	if($page_row[bPopup])
	{
		// ������ �˾�â ��� [��������]
		if (!$admin_row[bMouseRB])
		{
			?>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false"><?
		}
		else
		{
			?>
<body topmargin='0' leftmargin='0'><?
		}
		echo"$page_row[content]";
	}
	else
	{
		// ������ ���������� ���
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
<title><?=$page_row[title]?></title>
<style>
<?=$design[css]?>
</style>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language=javascript src="./script/admin.js"></script>
</head>
<? include "top.php";?>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td  valign="top" width="714" bgcolor="#FFFFFF">
			<table width="714" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2" >
						<table width="714" border="0" cellspacing="0" cellpadding="0">
							<tr><?
							if($page_row[img])
							{
								// ����� ������ Ÿ��Ʋ �̹���
								?>
								<td width="220" height="27" bgcolor="#ffffff"><img src="upload/page/<?=$page_row[img]?>"></td><?
							}
							else
							{
								?><?
							}
							?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="712"><?=$page_row[content]?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php"; ?>
</div>
</body>
</html><?
	}
}
?>