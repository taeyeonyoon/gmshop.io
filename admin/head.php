<?
session_start();
include "html_head.php";
if(empty($GOOD_SHOP_ADMIN_USERID) || (($admin_row[adminId] != $_SESSION['GOOD_SHOP_ADMIN_USERID']) && ($admin_row[adminPwd] != $_SESSION['GOOD_SHOP_ADMIN_PWD'])))
{
	MsgViewHref("�ùٸ� ������ �ƴϰų� 3�а� �ƹ��۾��� ������ �α����� ����ϴ�.\\n\\n������Ʈ�� ���������� ������ ���� �������� ������ �� �ֽ��ϴ�.", "index.php");
	exit;
}

if($_GET["admin_author"]) $admin_author = 0;	// ���Ȼ� 0���� ����(url �����Է�)
?>