<?
session_start();
include "./lib/config.php";
include "./lib/function.php";
if ($_SESSION[GOOD_SHOP_PART] != "member")
{
	$name = "�մ�";
	$userid = time();
}
else
{
	$name = $_SESSION["GOOD_SHOP_NAME"];
	$userid = $_SESSION["GOOD_SHOP_USERID"];
}
$goods_row = $MySQL->fetch_array("SELECT *from goods WHERE idx=$gidx limit 1");
$qry = "INSERT INTO good_board (title,name,writeday,content,userid,gidx) values(";
$qry.="'$title',";
$qry.="'$name',";
$qry.="now(),";
$qry.="'$content',";
$qry.="'$userid',";
$qry.="$gidx";
$qry.=")";
if ($MySQL->query($qry))
{
	OnlyMsgView("��ϵǾ����ϴ�.");
	echo "<script>
	opener.location.reload();
	self.close();
	</script>";
}
else
{
	OnlyMsgView("��� �����Ͽ����ϴ�.");
	echo "<script>self.close();</script>";
}
?>