<?
include "head.php";
$cate_row=$MySQL->fetch_array("select *from category where code='$parentcode'");  //���� ī�װ� ����
if (__DEMOPAGE && $del)
{
	MsgViewHref("������������ ���������� ���ѵǾ����ϴ�.","category_edit.php?parentcode=$parentcode");
	exit;
}
if ($del) // �̹�������
{
	$cate_row=$MySQL->fetch_array("select *from category where idx=$idx");  //���� ī�װ� ����
	@unlink("../upload/category/$cate_row[$img]");
	$MySQL->query("UPDATE category SET $img='' WHERE idx=$idx");
	if ($MySQL->query("UPDATE category SET $img='' WHERE idx=$idx"))
	{
		OnlyMsgView("�̹����� �����Ͽ����ϴ�.");
		ReFresh("category_edit.php?parentcode=$parentcode");
		exit;
	}
	else
	{
		OnlyMsgView("�̹��� ������ ���� �Ͽ����ϴ�.�ٽ� �õ����ּ���");
		ReFresh("category_edit.php?parentcode=$parentcode");
		exit;
	}
}
if(!empty($img1_name))
{
	$img1_info=@getimagesize($img1);		//�̹���1 ����
	if(($img1_info[2]!=1) && ($img1_info[2]!=2))
	{
		MsgView("�̹���1 ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	if(!empty($cate_row[img1]))
	{
		@unlink("../upload/category/$cate_row[img1]");
	}
	$img1_name ="a".substr(time(),5,5)."_".$img1_name;
	@copy($img1, "../upload/category/$img1_name"); //���Ϻ���
	unlink($img1);
	$MySQL->query("update category set img1= '$img1_name' where code='$parentcode'");
}
if(!empty($img2_name))
{
	$img2_info=@getimagesize($img2);		//�̹���2 ����
	if(($img2_info[2]!=1) && ($img2_info[2]!=2))
	{
		MsgView("�̹���2 ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	if(!empty($cate_row[img2]))
	{
		@unlink("../upload/category/$cate_row[img2]");
	}
	$img2_name ="b".substr(time(),5,5)."_".$img2_name;	
	@copy($img2, "../upload/category/$img2_name"); //���Ϻ���
	unlink($img2);
	$MySQL->query("update category set img2= '$img2_name' where code='$parentcode'");
}
if(!empty($img3_name))
{
	$img3_info=@getimagesize($img3);		//�̹���3 ����
	if(($img3_info[2]!=1) && ($img3_info[2]!=2))
	{
		MsgView("�̹���3 ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	if(!empty($cate_row[img3]))
	{
		@unlink("../upload/category/$cate_row[img3]");
	}
	$img3_name ="c".substr(time(),5,5)."_".$img3_name;
	@copy($img3, "../upload/category/$img3_name"); //���Ϻ���
	unlink($img3);
	$MySQL->query("update category set img3= '$img3_name' where code='$parentcode'");
}
if(!empty($img4_name))
{
	$img4_info=@getimagesize($img4);		//�̹���3 ����
	if(($img4_info[2]!=1) && ($img4_info[2]!=2))
	{
		MsgView("�̹���4 ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	if(!empty($cate_row[img4]))
	{
		@unlink("../upload/category/$cate_row[img4]");
	}
	$img4_name ="d".substr(time(),5,5)."_".$img4_name;	
	@copy($img4, "../upload/category/$img4_name"); //���Ϻ���
	unlink($img4);
	$MySQL->query("update category set img4= '$img4_name' where code='$parentcode'");
}
$good_code = strtoupper($good_code);
$qry = "update category set ";
$qry.= "name = '$name', ";
$qry.= "bHide = '$bHide', ";
$qry.= "editday = now()";
$qry.= " where code='$parentcode'";
if($MySQL->query($qry))
{
	OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
	ReFresh("category_edit.php?parentcode=$parentcode");
}
else
{
	echo "$qry";
}
?>