<?
include "head.php";
$code = time();
$qry = "insert into webmail_adr_grp(code,badmin,name,content)values(";
$qry.= "'$code',1,'$name','$content')";
if($MySQL->query($qry))
{
	OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
	ReFresh("admmail_group.php");
}
else
{
	echo"Err. : $qry";
}
?>