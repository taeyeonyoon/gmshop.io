<?
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
$qry="select * from member where userid='$userid'";
$MySQL->query($qry);
$numrows=$MySQL->is_affected();	//�ش���̵� ���翩�� ex) ���� : 1�̻�
$qry="select * from member_withdraw where userid='$userid'";
$MySQL->query($qry);
$numrows2=$MySQL->is_affected();	//�ش���̵� ���翩�� ex) ���� : 1�̻�
$illegal_id_arr = Array("admin","administrator","test","manager","������","����","���"); 
$illegal_id = array_search2($illegal_id_arr,$userid);
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
function select()
{
	<? if ($userid){ ?>
	opener.document.joinForm.userid.value = "<?=$userid?>";
	opener.document.joinForm.id_check.value = "<?=$userid?>";
	self.close();
	<? }else{ ?>
	self.close();
	<? }?>
}

function duple()
{
	if(!document.form.userid.value)
	{
		alert('���̵� �Է��ϼ���.');
		document.form.userid.focus();
	}
	else document.form.submit();
}
//-->
</SCRIPT>
</head>
<body topmargin='10' leftmargin='10' text='464646' marginwidth="10" marginheight="10">
<table width="280" border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='4'><img src='image/sub/table_tleft.gif'></td>
		<td width='272' background='image/sub/table_tbg.gif'></td>
		<td width='4'><img src='image/sub/table_tright.gif'></td>
	</tr>
	<tr>
		<td background='image/sub/idsearch_bg.gif' colspan='3' align='center'>
			<form name="form" method="post" action="idsearch.php">
			<table width='280' border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr>
					<td align='center'><img src='image/sub/id_search_tit.gif'></td>
				</tr><?
				if($illegal_id)
				{
					?>
				<tr>
					<td height=30 align=center>�������� ���� ID �Դϴ�. </td>
				</tr>
				<tr>
					<td height=45 align=center><input type="text" name="userid" size="15"> <a href="javascript:duple();"><img src="image/icon/duplicate.gif" border=0></a></td>
				</tr><?
				}
				else if ($numrows || $numrows2)
				{
					// �ߺ��� ���
					?>
				<tr>
					<td height=30 align=center>�ش��ϴ� ID�� �̹� �ֽ��ϴ�.</td>
				</tr>
				<tr>
					<td height=45 align=center><input type="text" name="userid" size="15"> <a href="javascript:duple();"><img src="image/icon/duplicate.gif" border=0></a></td>
				</tr><?
				}
				else
				{
					?>
				<tr>
					<td height=30 align=center>����Ҽ��ִ� ID �Դϴ�.</td>
				</tr>
				<tr>
					<td height=45 align=center><a href="javascript:select();"><img src="image/icon/ok2_btn.gif" border=0></a></td>
				</tr><?
				}
				?>
			</table>
			</form>
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