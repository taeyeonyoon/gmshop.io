<?
session_start();
include "./lib/config.php";
include "./lib/function.php";
$MySQL->query("select *from trade where tradecode='$tradecode'");
if(!$MySQL->is_affected())
{
	MsgView("�ֹ��ڵ尡 �ùٸ��� �ʽ��ϴ�. \\n\\n�ٽ� �Է��� �ֽʽÿ�.",-1);
}
else
{
	ReFresh("order_detail_nomem.php?tradecode=$tradecode");
}
?>