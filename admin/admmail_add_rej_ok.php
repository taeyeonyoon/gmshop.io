<?
include "head.php";
$qry ="insert into webmail_reject(badmin,rej_email)values(1,'$rej_email')";
if($MySQL->query($qry))
{
	?>
<SCRIPT LANGUAGE="JavaScript">
<!--
alert("��ϿϷ� �Ͽ����ϴ�.");
window.close();
//-->
</SCRIPT><?
}
else
{
	echo"Err : $qry";
}
?>