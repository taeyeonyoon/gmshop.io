<?
include "head.php";
$cate_row=$MySQL->fetch_array("select *from category where code='$parentcode'");  //���� ī�װ� ����
$good_code = strtoupper($good_code);
$qry = "update category set ";
$qry.= "name = '$name', ";			//ī�װ���
$qry.= "bHide = '$bHide', ";
$qry.= "editday = now() ";
$qry.= " where code='$parentcode'";
if($MySQL->query($qry))
{
	OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
	ReFresh("category_manage.php");
}
else
{
	echo "$qry";
}
?>