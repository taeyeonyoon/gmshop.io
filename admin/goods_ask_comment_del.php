<?
include "head.php";
$result = $MySQL->query("SELECT *from good_board_comment where idx=$idx");
$row = mysql_fetch_array($result);
$qry = "DELETE from good_board_comment where idx=$idx";
if ($MySQL->query($qry))
{
	echo "<script>alert('����� �����Ǿ����ϴ�')
	opener.location.reload();
	self.close();</script>";
	exit;
}?>