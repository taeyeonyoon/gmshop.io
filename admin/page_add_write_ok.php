<?
include "head.php";
$MySQL->query("select *from page where code='$code'");
if($MySQL->is_affected())
{
	MsgView("�ڵ��ߺ��Դϴ�.\\n\\n�ٸ� �ڵ带 �Է��� �ֽʽÿ�.",-1);
	exit;
}
else
{
	if(!empty($img_name))
	{
		$img_info=@getimagesize($img);
		$img_type=array_pop(explode(".",$img_name));
		if(($img_info[2]!=1) && ($img_info[2]!=2)  && ($img_info[2]!=6) )
		{
			MsgView("��ϰ����� �̹��� ������ gif , jpg , bmp  �Դϴ�.", -1);
			exit;
		}
		else
		{
			$img_name = time();
			@copy($img, "../upload/page/$img_name"); //���Ϻ���
		}
	}
	if(empty($bPopup)) $bPopup=0;
	if($bHtml==1) $content = $TextContent;
	elseif($bHtml==2) $content = $HtmlContent;
	else $content = $content;
	$qry = "insert into page(code,title,bPopup,imgcode,";
	if(!empty($img_name)) $qry.= "img,";
	$qry.= "content,bHtml)values(";
	$qry.= "'$code',";
	$qry.= "'$title',";
	$qry.= "$bPopup,";
	$qry.= "'$imgcode',";
	if(!empty($img_name)) $qry.= "$img_name,";
	$qry.= "'$content','$bHtml' ";
	$qry.= ")";
	if($MySQL->query($qry))
	{
		OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
		ReFresh("page_add.php");
	}
	else
	{
		echo"Err. : $qry";
	}
}
?>