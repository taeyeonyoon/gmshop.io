<?
include "head.php";
$qry = "DELETE from comment where idx=$idx";
if ($MySQL->query($qry))
{
	echo "<script>alert('�������� �����Ǿ����ϴ�') 
	location.href='bbs_view.php?data=$data&code=$code';
	</script>";
}
?>