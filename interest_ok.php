<?
session_start();
include "lib/config.php";
include "lib/function.php";
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
$goods_info_row = $MySQL->fetch_array("select *from goods where idx=$goodsIdx"); //��ǰ����
if(!empty($option1)) $option1 = $goods_info_row[partName1]."����".$option1;//��ǰ�ɼ�  ex) ���򡹡���� 
else $option1="";
if(!empty($option2)) $option2 = $goods_info_row[partName2]."����".$option2;
else $option2="";
if(!empty($option3)) $option3 = $goods_info_row[partName3]."����".$option3;
else $option3="";
$chek_qry = "select *from interest where userid='$GOOD_SHOP_USERID' and goodsIdx=$goodsIdx";
$chek_qry.= " and option1='$option1' and option2='$option2' and option3='$option3' ";
$MySQL->query($chek_qry);
if(!$MySQL->is_affected())
{
	//�ߺ���� ����
	$price = $price;
	$point = $point;
	if (empty($point)) $point = 0;
	$qry = "insert into interest(userid,goodsIdx,option1,option2,option3,price,point,writeday)values('$GOOD_SHOP_USERID',$goodsIdx,";
	$qry.= "'$option1','$option2','$option3',$price,$point,now())";
	$MySQL->query($qry);
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function goMypage()
{
	opener.location.href="mypage_interest.php";
	window.close();
}
//-->
</SCRIPT>
<style>
.tt01{ font-family:���� ; font-size:9pt ; font-weight:bold ; letter-spacing:-1px ; LINE-HEIGHT: 160%;}
</style>
<body bgcolor="#FFFFFF" topmargin='10' leftmargin='10' text='464646' marginwidth="10" marginheight="10">
<table width="430" border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='4'><img src='image/sub/table_tleft.gif'></td>
		<td width='422' background='image/sub/table_tbg.gif'></td>
		<td width='4'><img src='image/sub/table_tright.gif'></td>
	</tr>
	<tr>
		<td background='image/sub/interest_bg.gif' colspan='3' align='center'>
			<table width="410" height="150" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td><img src="image/good/interest_ok_top.gif" ></td>
				</tr>
				<tr>
					<td style='padding:30 10 10 30'><font class='tt01'>���ɹ�ǰ�� �����ϴ�. ���ɹ�ǰ�� ���� Ȯ���Ͻðڽ��ϱ�?<br>����Ͻ� ���ɹ�ǰ�� <font color='ff4800'>����������>���ɹ�ǰ����</font> ���� Ȯ���Ͻ� �� <br>�ֽ��ϴ�.</font></td>
				</tr>
				<tr>
					<td height="100%" valign="middle" align="center" style='padding:10 10 10 10'><a href="javascript:goMypage();"><img src="image/icon/interest_view.gif" border="0"></a> <a href="javascript:window.close();"><img src="image/icon/close.gif" border="0"></a></td>
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