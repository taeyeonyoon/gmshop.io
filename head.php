<?
session_start();
include "html_head.php";
if ($MySQL->articles("SELECT idx from ipblock WHERE ip='$REMOTE_ADDR'"))
{
	OnlyMsgView("�����Ͻ� IP�� ������Ʈ���� ���ܼ��� �Ǿ� �ֽ��ϴ�.");
	exit;
}
?>