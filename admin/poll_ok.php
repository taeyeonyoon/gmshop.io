<?
include "head.php";
$temp_sday	= $syday.$smday.$sdday;   //������
$temp_eday	= $eyday.$emday.$edday;   //������
$sday =min($temp_sday,$temp_eday);
$eday =max($temp_sday,$temp_eday);
$chekqry = "select *from poll where (sday >= $sday and sday <= $eday) or (eday >=$sday and eday <= $eday)";
$MySQL->query($chekqry);
if($MySQL->is_affected())
{
	MsgView("��¥ �ߺ��Դϴ�. \\n\\n������ ��ϵ� �������縦 Ȯ���Ͻʽÿ�.",-1);
}
else
{
	$qry = "insert into poll(sday,eday,title,answer,bPlu,reCan,gubun)values(";
	$qry.= "'$sday',";			//������ ex)20030101
	$qry.= "'$eday',";			//������ ex)20030201
	$qry.= "'$title',";			//����
	$qry.= "'$answer_string',";	//�亯 ��� ex) "�������ƴϿ���������"
	$qry.= "$bPlu,";			//���� ���� 1~10
	$qry.= "$reCan,";			//�亯������  ex)1:ȸ��,��ȸ��  2:ȸ������
	$qry.= "'$gubun'";
	$qry.= ")";
	if($MySQL->query($qry))
	{
		OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
		ReFresh("poll_list.php");
	}
	else
	{
		ErrMsg($qry);
		ReFresh("poll_list.php");
	}
}
?>