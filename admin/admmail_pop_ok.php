<?
include "head.php";
include "../lib/webmail_function.php";
$err = "";
if($edit_part=="write")
{
	//�ܺθ��� ���� ����
	if(!CheckPop3($pop3,$pop3_user,$pop3_pass,&$err))
	{
		MsgView($err,-1);
		exit;
	}
	//�������� �����
	if($bMboxMake)
	{
		$mbox = time();
		$mbox_qry = "insert into webmail_mbox(badmin,name,mbox)values(1,'$mbox_name','$mbox')";
		$MySQL->query($mbox_qry);
	}

	$qry = "insert into webmail_pop3(pop3,badmin,pop3_user,pop3_pass,mbox,bDel)values(";
	$qry.= "'$pop3',";
	$qry.= "1,";
	$qry.= "'$pop3_user',";
	$qry.= "'$pop3_pass',";
	$qry.= "'$mbox',";
	$qry.= "$bDel)";

	if($MySQL->query($qry))
	{
		OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
		ReFresh("admmail_pop.php");
	}
	else
	{
		echo"Err. : $qry";
	}
}
else if($edit_part=="edit")
{
	//�ܺθ��� ����
	if(!CheckPop3($pop3,$pop3_user,$pop3_pass,&$err))
	{
		MsgView($err,-1);
		exit;
	}
	$qry = "update webmail_pop3 set ";
	$qry.= "pop3 = '$pop3',";
	$qry.= "pop3_user = '$pop3_user',";
	$qry.= "pop3_pass = '$pop3_pass',";
	$qry.= "mbox = '$mbox',";
	$qry.= "bDel = $bDel where idx=$idx";
	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
		ReFresh("admmail_pop.php");
	}
	else
	{
		echo"Err. : $qry";
	}
}
else if($edit_part =="del")
{
	if($MySQL->query("delete from webmail_pop3 where idx=$idx"))
	{
		ReFresh("admmail_pop.php");
	}
	else
	{
		echo"Err. : �ܺθ��� ���� ���� ����";
	}
}
?>