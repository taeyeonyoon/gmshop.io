<?
include "head.php";
$dataArr=Decode64($data);
if($del)
{
	$MySQL->query("delete from poll where idx =$dataArr[idx]");
	ReFresh("poll_list.php");
}
else
{
	$temp_sday	= $syday.$smday.$sdday;   //������
	$temp_eday	= $eyday.$emday.$edday;   //������
	$sday =min($temp_sday,$temp_eday);
	$eday =max($temp_sday,$temp_eday);
	//��¥�ߺ� üũ
	$chekqry = "select *from poll where ((sday >= $sday and sday <= $eday) or (eday >=$sday and eday <= $eday)) ";
	$chekqry.= " and idx<>$dataArr[idx]";
	$MySQL->query($chekqry);
	if($MySQL->is_affected())
	{
		MsgView("��¥ �ߺ��Դϴ�. \\n\\n������ ��ϵ� �������縦 Ȯ���Ͻʽÿ�.",-1);
	}
	else
	{
		$qry = "update poll set ";
		$qry.= "sday	= '$sday',";
		$qry.= "eday	= '$eday',";
		$qry.= "title	= '$title',";
		$qry.= "answer	= '$answer_string',";
		$qry.= "bPlu	= $bPlu,";
		$qry.= "reCan	= $reCan, ";
		$qry.= "gubun	= '$gubun' ";
		$qry.= " where idx=$dataArr[idx]";
		if($MySQL->query($qry))
		{
			OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
			ReFresh("poll_view.php?data=$data");
		}
		else
		{
			ErrMsg($qry);
			ReFresh("poll_edit.php?data=$data");
		}
	}
}
?>