<?
include "head.php";
$dataArr=Decode64($data);
$bbs_row = $MySQL->fetch_array("select *from bbs_list where idx=$dataArr[idx]");
if ($commnameimg_del=="y")
{
	@unlink("../upload/bbs/$bbs_row[commnameimg]");
	$MySQL->query("UPDATE bbs_list SET commnameimg='' where idx=$dataArr[idx]");
}
if ($nameimg_del=="y")
{
	@unlink("../upload/bbs/$bbs_row[nameimg]");
	$MySQL->query("UPDATE bbs_list SET nameimg='' where idx=$dataArr[idx]");
}
if ($img_del=="y")
{
	@unlink("../upload/bbs/$bbs_row[img]");
	$MySQL->query("UPDATE bbs_list SET img='' where idx=$dataArr[idx]");
}
if(empty($newPeriod))		$newPeriod			=1;		//�Խ��� ���� �̹��� ǥ�ñⰣ(��)
if(empty($bUse))			$bUse				=0;		//�Խ��� ��뿩�� ex) 0:����  1:���
if(empty($intro_html)) $intro_html = 0;
if(empty($bComment)) $bComment = 0;
if(!empty($img1_name))
{
	$img1_info=@getimagesize($img1);		//�̹���1 ����
	if(($img1_info[2]!=1) && ($img1_info[2]!=2))
	{
		MsgView("Ÿ��Ʋ�̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img1_name ="title".substr(time(),5,5)."_".$img1_name;	
	@move_uploaded_file($img1, "../upload/bbs/$img1_name"); //���Ϻ���
	@unlink($img1);
	@unlink("../upload/bbs/$bbs_row[img]");		//���̹��� ����
	$MySQL->query("update bbs_list set img= '$img1_name' where idx=$dataArr[idx]");
}
if(!empty($nameimg_name))
{
	$nameimg_info=@getimagesize($nameimg);
	if(($nameimg_info[2]!=1) && ($nameimg_info[2]!=2))
	{
		MsgView("�����̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$nameimg_name ="name".substr(time(),5,5)."_".$nameimg_name;	
	@move_uploaded_file($nameimg, "../upload/bbs/$nameimg_name"); //���Ϻ���
	@unlink($nameimg);
	@unlink("../upload/bbs/$bbs_row[nameimg]");		//���̹��� ����
	$MySQL->query("update bbs_list set nameimg= '$nameimg_name' where idx=$dataArr[idx]");
}
if(!empty($commnameimg_name))
{
	$commnameimg_info=@getimagesize($commnameimg);	 
	if(($commnameimg_info[2]!=1) && ($commnameimg_info[2]!=2))
	{
		MsgView("Ŀ�´�Ƽ �����̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$commnameimg_name ="comname".substr(time(),5,5)."_".$commnameimg_name;	
	@move_uploaded_file($commnameimg, "../upload/bbs/$commnameimg_name"); //���Ϻ���
	@unlink($commnameimg);
	@unlink("../upload/bbs/$bbs_row[commnameimg]");		//���̹��� ����
	$MySQL->query("update bbs_list set commnameimg= '$commnameimg_name' where idx=$dataArr[idx]");
}
$qry = "update bbs_list set ";
$qry.= "name	  = '$name',";		//�Խ��Ǹ�
$qry.= "rAct	  = $rAct,";		//�б����    ex) 10:���Ѿ���  20:ȸ��,������  30: ������
$qry.= "wAct	  = $wAct,";		//�������                  "
$qry.= "cAct	  = $cAct,";		//�亯����				   "
$qry.= "part	  = $part,";		//����      ex) 10:�ϹݰԽ���  20:�ڷ��
$qry.= "newPeriod = $newPeriod,";	//�����̹��� ǥ�ñⰣ
$qry.= "bUse	  = $bUse, ";		//��뿩��
$qry.= "bComment	  = $bComment, ";
$qry.= "bCommunity	  = '$bCommunity', ";
$qry.= "intro_html	  = $intro_html, ";
$qry.= "gubun	  = '$gubun', ";
$qry.= "intro	  = '$intro' ";
$qry.= " where idx=$dataArr[idx]";
if($MySQL->query($qry))
{
	OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
	ReFresh("bbs_admin_edit.php?data=$data");
}
else
{
	ErrMsg($qry);
	ReFresh("bbs_admin_edit.php?data=$data");
}
?>