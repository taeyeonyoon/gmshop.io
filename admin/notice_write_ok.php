<?
include "head.php";
if($bHtml==1) $content = $TextContent;
elseif($bHtml==2) $content = $HtmlContent;
else $content = $content;
if(empty($str_width))		$str_width			=0;		//�˾�â ����ũ��
if(empty($str_height))		$str_height			=0;		//�˾�â ����ũ��
$qry = "insert into notice(part,code,writeday,readNum,title,bBasicimg,bPopup,";
$qry.= "sday,eday,app,width,height,content,bHtml,gubun)values(";
$qry.= "'$part',";		//part ex)notice,event
$qry.= "'$code',";		//�ڵ�
$qry.= "now(),";		//�����
$qry.= "0,";			//��ȸ��
$qry.= "'$title',";		//����	
$qry.= "'$bBasicimg',";
$qry.= "'$bPopup',";	//�˾�����  ex) y:���  n:�̻��
$qry.= "'$str_sday',";	//�˾� ������ ex) 20030101
$qry.= "'$str_eday',";  //�˾� ������ ex) 20030201
$qry.= "$bHtml,";			//HTML ����  ex) 1:HTML 0:TEXT
$qry.= "$str_width,";	//�˾�â ����ũ��
$qry.= "$str_height,";	//�˾�â ����ũ��
$qry.= "'$content',";	//����
$qry.= "'$bHtml',";	//����
$qry.= "'$gubun'";
$qry.= ")";

if($MySQL->query($qry))
{
	OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
	ReFresh("notice_list.php?part=$part");
}
else
{
	OnlyMsgView("��Ͽ� ������ �߻��Ͽ����ϴ�.");
	ReFresh("notice_list.php?part=$part");
}
?>