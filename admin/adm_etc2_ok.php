<?
include "head.php";
if (!empty($postcode) && $postcode!="none")
{
	if(!empty($postcode_name))
	{
		$postcode_info=explode(".",$postcode_name);
		if($postcode_info[1]!="txt")
		{
			MsgView("txt���ϸ� ���ε� �����մϴ�.", -1);
			exit;
		}
		$postcode_name = str_replace(" ","",$postcode_name);
		@move_uploaded_file($postcode, "../upload/csv/$postcode_name"); //���Ϻ���
		@unlink($postcode);
	}
	// ������ �и��� �����ȣ txt���� DB�Է�
	$url = "../upload/csv/$postcode_name";
	$fp = fopen($url,"r");
	$arr=array();
	$cnt = 0 ;
	$buf ="";
	$str ="";
	$MySQL->query("TRUNCATE table postzip");
	$zip_cnt=0;
	while(!feof($fp))
	{
		$buf = fgets($fp); // �Ѷ����� ���� 
		$arr = explode("\t",$buf); // , �� �и�
		if ($zip_cnt>0)
		{
			if ($arr[0]) // NULL ���� ���ڵ� (�Ǹ�����)�� �Է¾��� 
			{
				$etc = $arr[4]." ".$arr[5]." ".$arr[6]." ".$arr[7]." ";
				$zip = $arr[0];
				$qry="INSERT INTO postzip (zip,city,goo,dong,etc) values ('$zip','$arr[1]','$arr[2]','$arr[3]','$etc')";
				if ($MySQL->query($qry))
				{
				}
				else echo $qry."<br>";
			}
		}
		$zip_cnt++;
	}
	if($MySQL->articles("select *from postzip limit 1"))
	{
		MsgViewHref("�Ϸ��Ͽ����ϴ�.","adm_etc2.php");
	}
	else
	{
		MsgViewHref("�����ȣ ���ſ� �����Ͽ����ϴ�.","adm_etc2.php");
	}
	unlink($url.$postcode_file);
	exit;
}
else
{
	if(empty($good_cipher))	$good_cipher =1;
	if(empty($bStamp))	$bStamp =0;

	$qry = "update admin set ";
	$qry.= "bPersonask			= $bPersonask,";
	$qry.= "bTrade				= $bTrade,";
	$qry.= "bStamp				= $bStamp,  ";
	$qry.= "bGdset				= '$bGdset',  ";
	$qry.= "bMouseRB			= '$bMouseRB'  ";

	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
		ReFresh("adm_etc2.php");
	}
	else
	{
		ErrMsg($qry);
		ReFresh("adm_etc2.php");
	}
}
?>