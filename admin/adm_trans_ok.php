<?
include "head.php";
if ($part==1)
{
	if(empty($bTrans))		$bTrans				=0;		//��ۺ� ��뿩��
	if(empty($noTrans))		$noTrans		=0;		//������ ����ݾ�
	if(empty($transMoney))		$transMoney		=0;		//��ۺ�
	if(empty($chakbul)) 		$chakbul=0;
	if($transCom2) $transCom = $transCom2;

	$qry = "update admin set ";
	$qry.= "bTrans		= $bTrans,";				//��ۺ� ��뿩��
	$qry.= "noTrans		= $noTrans,";			//������� ����ݾ�
	$qry.= "transMoney	= $transMoney,";		//��ۺ�
	$qry.= "transCom    = '$transCom', ";		//�⺻���ȸ��
	$qry.= "chakbul    = $chakbul, ";
	$qry.= "trans_etc    = '$trans_etc', ";
	$qry.= "trans_content    = '$trans_content', ";
	$qry.= "trans_goodname    = '$trans_goodname', ";
	$qry.= "bTransmethod    = '$bTransmethod', ";
	$qry.= "method_1    = '$method_1', ";
	$qry.= "method_2    = '$method_2', ";
	$qry.= "method_3    = '$method_3', ";
	$qry.= "trans_com_url    = '$trans_com_url' ";

	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
	}
	else
	{
		ErrMsg($qry);
	}
}
else if ($part==2)
{
	$qry = "INSERT INTO trans_add (addr,first_zip,last_zip,transP) values(";
	$qry.= "'$addr',";
	$qry.= "'$first_zip',";
	$qry.= "'$last_zip',";
	$qry.= "$transP";
	$qry.= ")";
	if($MySQL->query($qry))
	{
		OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
	}
	else
	{
		ErrMsg($qry);
	}
}
else if ($part==3)
{
	$qry = "update trans_add set ";
	$qry.= "addr='$addr',";
	$qry.= "first_zip='$first_zip',";
	$qry.= "last_zip='$last_zip',";
	$qry.= "transP=$transP";
	$qry.= " where idx=$idx";
	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
	}
	else
	{
		ErrMsg($qry);
	}
}
else if ($part==4)
{
	$qry = "DELETE from trans_add WHERE idx=$idx ";
	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
	}
	else
	{
		ErrMsg($qry);
	}
}
ReFresh("adm_trans.php");
?>