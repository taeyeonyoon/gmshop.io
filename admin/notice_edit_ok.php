<?
include "head.php";
$dataArr= Decode64($data);
if($del)
{
	$qry = "delete from notice where idx=$dataArr[idx]";
	if($MySQL->query($qry))
	{
		$file_result = $MySQL->query("select *from up_file where code='$code'");
		while($file_row = mysql_fetch_array($file_result))
		{
			@unlink("../upload/notice/$file_row[name]");
		}
		$del_qry = "delete from up_file where code = '$code'";
		if($MySQL->query($del_qry))
		{
			OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
			ReFresh("notice_list.php?part=$part");
		}
		else
		{
			ErrMsg("���ϻ���, ���������� : $del_qry");
			ReFresh("notice_edit.php?data=$data&part=$part");
		}
	}
	else
	{
		ErrMsg($qry);
		ReFresh("notice_edit.php?data=$data&part=$part");
	}
}
else
{
	if(empty($str_width))		$str_width			=0;		//�˾�â ����ũ��
	if(empty($str_height))		$str_height			=0;		//�˾�â ����ũ��
	if($bHtml==1) $content = $TextContent;
	elseif($bHtml==2) $content = $HtmlContent;
	else $content = $content;
	if($bHtml==1) $app = 0;
	elseif($bHtml==2) $app = 1;
	else $app = 1;
	$qry = "update notice set ";
	$qry.= "title	='$title',";		//����
	$qry.= "bPopup	='$bPopup',";		//�˾�����  ex) y:���  n:�̻��
	$qry.= "bBasicimg='$bBasicimg',";		//�˾� �⺻Ʋ����  ex) y:���  n:�̻��
	$qry.= "sday	='$str_sday',";		//�˾� ������ ex) 20030101
	$qry.= "eday	='$str_eday',";		//�˾� ������ ex) 20030201
	$qry.= "app		=$app,";			//HTML ����  ex) 1:HTML 0:TEXT
	$qry.= "width	=$str_width,";		//�˾�â ����ũ��
	$qry.= "height	=$str_height,";		//�˾�â ����ũ��
	$qry.= "content	='$content',";		//����
	$qry.= "bHtml	='$bHtml',";		//����
	$qry.= "gubun	='$gubun'"; // ȸ��,�ŷ�ó ���� 
	$qry.= " where idx=$dataArr[idx]";
	if($MySQL->query($qry))
	{
		OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
		ReFresh("notice_edit.php?data=$data&part=$part");
	}
	else
	{
		ErrMsg($qry);
		ReFresh("notice_edit.php?data=$data&part=$part");
	}
}
?>