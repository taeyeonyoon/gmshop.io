<?
include "../lib/config.php";
include "../lib/function.php";
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
	$SMS_PART = "permember";
	$adminTel = $adminTel1.$adminTel2.$adminTel3;
	$hand = str_replace("-","",$hand);
	include "../sms/smsclient.php";
	OnlyMsgView("�޼��� ������ �Ϸ� �Ͽ����ϴ�.");
	echo"<script language='javascript'>
	window.close();
	</script>";
}
?>