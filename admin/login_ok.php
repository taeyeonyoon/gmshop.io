<?
// �ҽ��������
// 20060714_1 �ҽ����� ��ȣ�� (��� ���α׷� �������� ���� �ҽ� ����)
session_start();
include "../lib/config.php";
include "../lib/function.php";
$adminId = $_POST["adminId"];
$adminPwd = $_POST["adminPwd"];
$HTTP_REFERER = $_SERVER["HTTP_REFERER"];
$HTTP_REFERER = explode("admin/",$HTTP_REFERER);
$HTTP_REFERER = $HTTP_REFERER[1];
/*------------------------ ������ �α���---------------------------------*/
if(!empty($del))
{
	@session_unregister("GOOD_SHOP_ADMIN_USERID") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_ADMIN_NAME") or die("session_register err");
	@session_unregister("GOOD_SHOP_ADMIN_PWD") or die("session_register err");
	$MySQL->query("update admin set nearDay=now()"); /////���ӿϷ�ð� ���� 
	ReFresh("index.php");
}
else
{
	if ($_SESSION['GOOD_SHOP_ADMIN_USERID'])
	{
		OnlyMsgView("������ ���������� ���������Ƿ� �α׾ƿ� �� ��α��� �մϴ�.");
		@session_unregister("GOOD_SHOP_ADMIN_USERID") or die("session_unregister err");
		@session_unregister("GOOD_SHOP_ADMIN_NAME") or die("session_register err");
		@session_unregister("GOOD_SHOP_ADMIN_PWD") or die("session_register err");
		Refresh("index.php");
		exit;
	}
	$admin_row = $MySQL->fetch_array("select *from admin");
	if($admin_row[adminId]==$adminId && $admin_row[adminPwd]==$adminPwd) //�α��� ���� 
	{
		$GOOD_SHOP_ADMIN_USERID	= $adminId;
		$GOOD_SHOP_ADMIN_PWD      = $admin_row[adminPwd];
		$_SESSION['GOOD_SHOP_ADMIN_USERID'] = "$GOOD_SHOP_ADMIN_USERID";
		$_SESSION['GOOD_SHOP_ADMIN_PWD'] = "$GOOD_SHOP_ADMIN_PWD";
		$_SESSION['GOOD_SHOP_ADMIN_NAME'] = "������"; 
		if ($admin_row[nearDay]=="0000-00-00 00:00:00")
		{
			$MySQL->query("update admin set nearDay=now()"); /////���ӿϷ�ð� ����
		}
		///////���ú� ��ǰ��� �� ���������� ������ �ڵ�����//////////
		$today=date("Y-m-d"); 
		$MySQL->query("DELETE from today_view WHERE left(writeday,10)<'$today'");
		if ($admin_row[startpage_adm]) ReFresh($admin_row[startpage_adm]);
		else ReFresh("sale_status.php");
	}
	else
	{
		MsgView("�������� ���̵� �Ǵ� ��й�ȣ�� �ùٸ��� �ʽ��ϴ�.",-1);
	}
}
?>