<?
include "head.php";
$row = $MySQL->fetch_array("select * from sub_design");
$pre_img = "img".$part;
$pre_titimg = "titimg".$part;
if(!empty($img_name))
{
	$img_info=@getimagesize($img);		//�̹���1 ����
	if(($img_info[2]!=1) && ($img_info[2]!=2))
	{
		MsgView("�̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img_name =time();
	@move_uploaded_file($img, "../upload/design/$img_name"); //���Ϻ���
	@unlink($img);
	@unlink("../upload/design/$row[$pre_img]");
	$qry = "update sub_design set img$part	= '$img_name'";
	$MySQL->query($qry);
}
if(!empty($titimg_name))
{
	$titimg_info=@getimagesize($titimg);		//�̹���1 ����
	if(($titimg_info[2]!=1) && ($titimg_info[2]!=2))
	{
		MsgView("�̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$titimg_name =time() + 1;
	@move_uploaded_file($titimg, "../upload/design/$titimg_name"); //���Ϻ���
	@unlink($titimg);
	@unlink("../upload/design/$row[$pre_titimg]");
	$qry = "update sub_design set titimg$part	= '$titimg_name'";
	$MySQL->query($qry);
}
$qry = "update sub_design set bc$part='$copyBC' , tc$part='$copyTC' ";
if($MySQL->query($qry))
{
	OnlyMsgView("��� �Ϸ�");
	ReFresh("design_sub.php");
}
else
{
	echo"Err. : $qry";
}
?>