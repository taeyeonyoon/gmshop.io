<?
include "head.php";
if($edit_part=="write")
{
	//������ �����
	$mbox = time();
	$qry = "insert into webmail_mbox(mbox,badmin,name)values(";
	$qry.= "'$mbox',";
	$qry.= "1,";
	$qry.= "'$name')";
	if($MySQL->query($qry))
	{
		ReFresh("admmail_mbox.php");
	}
	else
	{
		echo"Err. : $qry";
	}
}
else if($edit_part=="edit")
{
	//������ ����
	$qry = "update  webmail_mbox set ";
	$qry.= "name = '$name' where mbox='$mbox'";
	if($MySQL->query($qry))
	{
		?>
		<SCRIPT LANGUAGE="JavaScript">
		<!--
		opener.location.href="admmail_mbox.php";
		window.close();
		//-->
		</SCRIPT><?
	}
	else
	{
		echo"Err. : $qry";
	}
}
else if($edit_part=="empty")
{
	//������ ����
	// .eml ���� ����
	$qry = "select * from webmail_mail where mbox='$mbox' and badmin=1";
	$result = $MySQL->query($qry);
	while($row = mysql_fetch_array($result))
	{
		if(file_exists("../eml/$row[m_filename]")) @unlink("../eml/$row[m_filename]");
	}
	$qry = "delete from webmail_mail where mbox='$mbox' and badmin=1";
	if($MySQL->query($qry))
	{
		ReFresh("admmail_mbox.php");
	}
	else
	{
		echo"Err. : $qry";
	}
}
else if($edit_part=="left")
{
	//������ ����
	// .eml ���� ����
	$qry = "select * from webmail_mail where mbox='4' and badmin=1";
	$result = $MySQL->query($qry);
	while($row = mysql_fetch_array($result))
	{
		if(file_exists("../eml/$row[m_filename]")) @unlink("../eml/$row[m_filename]");
	}
	$qry = "delete from webmail_mail where mbox='4' and badmin=1";
	if($MySQL->query($qry))
	{
		ReFresh("admmail_list.php?mbox=4");
	}
	else
	{
		echo"Err. : $qry";
	}
}
else if($edit_part=="del")
{
	//������ ����
	// .eml ���� ����
	$qry = "select * from webmail_mail where mbox='$mbox' and badmin=1";
	$result = $MySQL->query($qry);
	while($row = mysql_fetch_array($result))
	{
		if(file_exists("../eml/$row[m_filename]")) @unlink("../eml/$row[m_filename]");
	}
	$qry = "delete from webmail_mail where mbox='$mbox' and badmin=1";
	@$MySQL->query($qry);
	$qry = "delete from webmail_mbox where mbox='$mbox'";
	if($MySQL->query($qry))
	{
		ReFresh("admmail_mbox.php");
	}
	else
	{
		echo"Err. : $qry";
	}
}
?>