<?
include "head.php";
if(empty($mbox))
{
	OnlyMsgView("�ùٸ� ������ �ƴմϴ�.");
	ReFresh("admmail_adm.php");
	exit;
}
if($edit_part=="alldel")
{
	//���ϻ���
	$idxArr = explode("-",$idxStr);
	if($mbox=="4")
	{
		//��������
		for($i=0;$i<count($idxArr);$i++)
		{
			// .eml ���� ����
			$qry = "select * from webmail_mail where idx=$idxArr[$i]";
			$row = $MySQL->fetch_array($qry);
			if(file_exists("../eml/$row[m_filename]"))
			{
				//�������ϸ� üũ
				@unlink("../eml/$row[m_filename]");
			}
			$MySQL->query("delete from webmail_mail where idx=$idxArr[$i]");
		}
		ReFresh("admmail_list.php?mbox=$mbox");
	}
	else
	{
		//�����������
		for($i=0;$i<count($idxArr);$i++)
		{
			$MySQL->query("update webmail_mail set mbox='4' where idx=$idxArr[$i]");
		}
		ReFresh("admmail_list.php?mbox=$mbox");
	}
}
else if($edit_part=="allmove")
{
	$idxArr = explode("-",$idxStr);
	for($i=0;$i<count($idxArr);$i++)
	{
		$MySQL->query("update webmail_mail set mbox='$movebox' where idx=$idxArr[$i]");
	}
	ReFresh("admmail_list.php?mbox=$mbox");
}
?>