<?
include "head.php";
$admin_row = $MySQL->fetch_array("select * from admin");
$sms	   = $MySQL->fetch_array("select * from smsinfo");
$content_len =  strlen($content);
if($content_len >80)
{
	MsgView("�޼����� ���̴� 80 byte �� �ʰ��� �� �����ϴ�.\\n\\n���� ���� : $content_len byte",-1);
	exit;
}
else
{
	if ($idx_arr) $SMS_PART = "selected_member";
	else $SMS_PART = "allmember";
	include "../sms/smsclient.php";
	OnlyMsgView("�޼��� ������ �Ϸ� �Ͽ����ϴ�.");
	ReFresh("member_sms.php");
}
?>