<?
include "head.php";
function imgalldel()
{
	global $img1_name,$img2_name,$img3_name,$img4_name;
	if(is_file("../upload/category/$img1_name")) @unlink("../upload/category/$img1_name");
	if(is_file("../upload/category/$img2_name")) @unlink("../upload/category/$img2_name");
	if(is_file("../upload/category/$img3_name")) @unlink("../upload/category/$img3_name");
	if(is_file("../upload/category/$img4_name")) @unlink("../upload/category/$img4_name");
}
if (!$name || !$_POST["name"])
{
	MsgViewHref("�˼����� ������ ������ �Ѿ���� �ʾҽ��ϴ�.","category_write.php");
	exit;
}
if(!empty($img1_name))
{
	$img1_info=@getimagesize($img1);		//�̹���1 ����
	if(($img1_info[2]!=1) && ($img1_info[2]!=2))
	{
		MsgView("�̹���1 ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img1_name ="a".substr(time(),5,5)."_".$img1_name;	
	@copy($img1, "../upload/category/$img1_name"); //���Ϻ���
	unlink($img1);
}
if(!empty($img2_name))
{
	$img2_info=@getimagesize($img2);		//�̹���2 ����
	if(($img2_info[2]!=1) && ($img2_info[2]!=2))
	{
		imgalldel();
		MsgView("�̹���2 ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img2_name ="b".substr(time(),5,5)."_".$img2_name;	
	@copy($img2, "../upload/category/$img2_name"); //���Ϻ���
	unlink($img2);
}
if(!empty($img3_name))
{
	$img3_info=@getimagesize($img3);		//�̹���3 ����
	if(($img3_info[2]!=1) && ($img3_info[2]!=2))
	{
		imgalldel();
		MsgView("�̹���3 ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img3_name ="c".substr(time(),5,5)."_".$img3_name;	
	@copy($img3, "../upload/category/$img3_name"); //���Ϻ���
	unlink($img3);
}
if(!empty($img4_name))
{
	$img4_info=@getimagesize($img4);		//�̹���3 ����
	if(($img4_info[2]!=1) && ($img4_info[2]!=2))
	{
		imgalldel();
		MsgView("�̹���4 ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img4_name ="d".substr(time(),5,5)."_".$img4_name;	
	@copy($img4, "../upload/category/$img4_name"); //���Ϻ���
	unlink($img4);
}
$total_category_row = $MySQL->fetch_array("select max(position) from category"); //�����ϵ� ��� ī�װ� ��
$position = $total_category_row[0] +1;
$qry = "insert into category(code,name,img1,img2,img3,img4,position)values(";
$qry.= "'$code',";			//ī�װ� �ڵ�
$qry.= "'$name',";			//ī�װ���
$qry.= "'$img1_name',";		//�̹���1
$qry.= "'$img2_name',";		//�̹���2
$qry.= "'$img3_name',";		//�̹���3
$qry.= "'$img4_name',";		//�̹���4
$qry.= "$position";			//ī�װ� �Ϸü�����ȣ	
$qry.= ")";

if($MySQL->query($qry))
{
	OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
	ReFresh("category_write.php");
}
else
{
	imgalldel();
	echo "$qry";
}
?>