<?
////////////////////////////////////////////////////////////////
// ���α׷���	: login_ok.php
// ����			: �α���ó��
// �ۼ���		: ��ȣ��
// �� ��		: (��)���÷�
// �� ��		: 2006�� 5�� 9�� ������
///////////////////////////////////////////////////////////////
/*
���α׷� ����
2006-05-09 : �ҽ� ����(��ȣ��)
*/

session_start();
include "./lib/config.php";
include "./lib/function.php";
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select * from admin limit 0,1");
}
if($jdata)
{
	$vars=explode("&",base64_decode($jdata));
	$vars_num=count($vars);
	for($i=0;$i<$vars_num;$i++)
	{
		$elements=explode("=",$vars[$i]);
		$jdataArr[$elements[0]]=$elements[1];
	}
	$userid=$jdataArr[jUserid];
	$pwd=$jdataArr[jPwd];
}
/*------------------------�α��� /�α׾ƿ�---------------------------------*/
if (!$referer) $referer = $_SERVER["HTTP_REFERER"];
// ��ٱ��� ���������� �α��������� ��ٱ��� ���� update (��ȸ�� -> ȸ��) 
$referer_pos=strpos($referer,"cart");
if (!is_int($referer_pos) || empty($referer_pos)) {}
else $buy="cart";
$referer_pos=strpos($referer,"search_result"); // �˻������ �α����ϸ� �ε����� 

$referer_pos2=strpos($referer,"member_join");
if (!is_int($referer_pos2) || empty($referer_pos2)) {}
else $join_login=1;

$referer_pos2=strpos($referer,"login");
if (!is_int($referer_pos2) || empty($referer_pos2)) {}
else $join_login=1;

if($del)//�α׾ƿ�
{
	/* ���ι� ���� */
	//-->
	@$MySQL->query("delete from cart where userid='$_SESSION[GOOD_SHOP_USERID]'");
	@$MySQL->query("delete from today_view where userid='$_SESSION[GOOD_SHOP_USERID]'");
	//<--
	@session_unregister("GOOD_SHOP_USERID") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_NAME") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_PART") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_CART") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_PWD") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_PART_GUBUN") or die("session_unregister err");
	ReFresh("index.php");
}
else if($buy)
{
	include "./lib/class.php";
	$input_result = "Select password('$pwd') ";
	$pwd = mysql_result($MySQL->query($input_result),0,0);
	$qry="select * from member where userid='$userid' and pwd='$pwd'";
	$MySQL->query($qry);
	if(!$MySQL->is_affected())
	{
		$qry2="select * from member where userid='$userid'";
		$MySQL->query($qry2);
		if ($MySQL->is_affected())
		{
			$msg = "��й�ȣ�� �߸��Ǿ����ϴ�.";
			MsgView($msg,-1);
			exit;
		}
		$qry3="select * from member where pwd='$pwd'";
		$MySQL->query($qry3);
		if ($MySQL->is_affected())
		{
			$msg = "���̵� �߸��Ǿ����ϴ�.";
			MsgView($msg,-1);
			exit;
		}
		$msg = "�ش��ϴ� ������ �����ϴ�.";
		MsgView($msg,-1);
		exit;
	}
	else
	{
		//ȸ�� �湮ȸ��, �ֱ����� ����
		$today=date("Y-m-d");
		$editQry = "update member set accNum =accNum+1 ,nearDay=now() where userid='$userid'";
		$MySQL->query($editQry);
		$user_row = $MySQL->fetch_array("select * from member where userid='$userid'");
		$qry="update cart set userid='$user_row[userid]' where userid='$_SESSION[GOOD_SHOP_USERID]'";
		$MySQL->query($qry);
		$qry="update today_view set userid='$user_row[userid]' where userid='$_SESSION[GOOD_SHOP_USERID]' and left(writeday,10)='$today'";
		$MySQL->query($qry);

		$GOOD_SHOP_USERID		= $user_row[userid];
		$GOOD_SHOP_NAME			= $user_row[name];
		$GOOD_SHOP_PART			= "member";
		$GOOD_SHOP_PART_GUBUN	= $user_row[part];	// M ȸ��, D �ŷ�ó
		$GOOD_SHOP_CART			= time();

		$_SESSION['GOOD_SHOP_USERID']		= "$GOOD_SHOP_USERID";
		$_SESSION['GOOD_SHOP_NAME']			= "$GOOD_SHOP_NAME";
		$_SESSION['GOOD_SHOP_PART']			= "$GOOD_SHOP_PART";
		$_SESSION['GOOD_SHOP_PART_GUBUN']	= "$GOOD_SHOP_PART_GUBUN";
		$_SESSION['GOOD_SHOP_CART']			= "$GOOD_SHOP_CART";

		// ��ٱ��� ���� üũ
		$cart_result = $MySQL->query("SELECT * from cart WHERE userid='$_SESSION[GOOD_SHOP_USERID]'"); 
		while ($cart_row = mysql_fetch_array($cart_result))
		{
			$goods_info_row = $MySQL->fetch_array("select * from goods where idx=$cart_row[goodsIdx] limit 1"); //��ǰ����
			$gprice = new CGoodsPrice($goods_info_row[idx]);
			$price = $gprice->Price();
			$point = $gprice->PutPoint()*$cart_row[cnt];
			// 2006.05.04 ����(�輺ȣ)
			$qry="update cart set price=$price,point=$point where userid='$_SESSION[GOOD_SHOP_USERID]' and idx=$cart_row[idx]";
			$MySQL->query($qry);
		}
		if ($buy=="cart") ReFresh("cart.php");
		else ReFresh("order_sheet.php");
	}
}
else
{
	// �Է� ���� �� ��ȣȭ
	$input_result = " Select password('$pwd') ";
	$pwd = mysql_result($MySQL->query($input_result),0,0);
	$qry="select *from member where userid='$userid' and pwd='$pwd'";
	$MySQL->query($qry);
	if(!$MySQL->is_affected())
	{
		$qry2="select *from member where userid='$userid'";
		$MySQL->query($qry2);
		if ($MySQL->is_affected())
		{
			$msg = "��й�ȣ�� �߸��Ǿ����ϴ�.";
			MsgViewHref($msg,"login.php");
			exit;
		}

		$qry3="select *from member where pwd='$pwd'";
		$MySQL->query($qry3);
		if ($MySQL->is_affected())
		{
			$msg = "���̵� �߸��Ǿ����ϴ�.";
			MsgViewHref($msg,"login.php");
			exit;
		}

		// ������ ����������� �α���
		if ($userid == $admin_row[adminId] && $pwd == $admin_row[adminPwd])
		{
			$GOOD_SHOP_USERID	= "admin";
			$GOOD_SHOP_NAME	= "������";
			$GOOD_SHOP_PART	= "member";
			$_SESSION['GOOD_SHOP_USERID'] = "$GOOD_SHOP_USERID";
			$_SESSION['GOOD_SHOP_NAME'] = "$GOOD_SHOP_NAME";
			$_SESSION['GOOD_SHOP_PART'] = "$GOOD_SHOP_PART";
			if (empty($referer)) ReFresh("index.php");
			else ReFresh($referer);
			exit;
		}
		else  // ������ ���̵� �ƴ϶�� 
		{
			$msg = "�ش��ϴ� ������ �����ϴ�.";
			MsgViewHref($msg,"login.php");
			exit;
		}
	}
	else
	{
		$today=date("Y-m-d");
		$buyNum = $MySQL->fetch_array("select count(*) from trade where userid='$userid' and status>0 and status<4");
		$buyMoney =$MySQL->fetch_array("select sum(totalM) from trade where userid='$userid' and status>0 and status<4");
		//ȸ�� �湮ȸ��, �ֱ����� ����, ���ż�, ���ž� ����
		if(empty($buyNum[0])) $buyNum[0] =0;
		if(empty($buyMoney[0])) $buyMoney[0] =0;
		$editQry = "update member set accNum =accNum+1 ,nearDay=now(),buyNum=$buyNum[0],buyMoney=$buyMoney[0] where userid='$userid'";
		$MySQL->query($editQry);
		$user_row = $MySQL->fetch_array("select *from member where userid='$userid'");

		$MySQL->query("update cart set userid='$user_row[userid]' where userid='$_SESSION[GOOD_SHOP_USERID]'");
		$MySQL->query("update today_view set userid='$user_row[userid]' where userid='$_SESSION[GOOD_SHOP_USERID]' and left(writeday,10)='$today'");

		$GOOD_SHOP_USERID		= $user_row[userid];
		$GOOD_SHOP_NAME			= $user_row[name];
		$GOOD_SHOP_PART			= "member";
		$GOOD_SHOP_CART			= time();
		$GOOD_SHOP_PART_GUBUN	= $user_row[part]; /// M ȸ��, D �ŷ�ó

		$_SESSION['GOOD_SHOP_USERID']		= "$GOOD_SHOP_USERID";
		$_SESSION['GOOD_SHOP_NAME']			= "$GOOD_SHOP_NAME";
		$_SESSION['GOOD_SHOP_PART']			= "$GOOD_SHOP_PART";
		$_SESSION['GOOD_SHOP_CART']			= "$GOOD_SHOP_CART";
		$_SESSION['GOOD_SHOP_PART_GUBUN']	= "$GOOD_SHOP_PART_GUBUN";

		$buyhap = $user_row[buyMoney]; //// ���ž�
		if (empty($referer)) ReFresh("index.php");
		else if ($join_login) ReFresh("index.php");
		else ReFresh($referer);
	}
}
?>