<?
include "head.php";
$dataArr=Decode64($data);
$view_row = $MySQL->fetch_array("select *from bbs_data where idx=$dataArr[idx]"); //�Խ��� ����
if($del)
{
	if(!empty($view_row[up_file]))
	{
		@unlink("../upload/bbs/$view_row[up_file]"); //���ϻ���
	}
	$del_qry = "delete from bbs_data where idx=$dataArr[idx]";
	if($MySQL->query($del_qry))
	{
		ReFresh("ask.php");
	}
	else
	{
		echo "$qry";
	}
}
else
{
	if(!empty($up_file_name))
	{
		if(!empty($view_row[up_file])) @unlink("../upload/bbs/$view_row[up_file]");
		if(file_exists("../upload/bbs/$up_file_name"))
		{
			$up_file_name =substr(time(),5,5)."_".$up_file_name;
		}
		@copy($up_file, "../upload/bbs/$up_file_name"); //���Ϻ���
		unlink($up_file);
		$qry = "update bbs_data set up_file = '$up_file_name' where idx=$dataArr[idx]";
		$MySQL->query($qry);
	}
	$qry = "update bbs_data set ";
	$qry.= "name	= '$name',";			//�ۼ���
	$qry.= "email	= '$email',";			//�̸���
	$qry.= "content = '$content',";			//�۳���
	$qry.= "title	= '$title' ";			//������
	$qry.= " where idx=$dataArr[idx]";
	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
		ReFresh("ask_view.php?data=$data");
	}
	else
	{
		echo "$qry";
	}
}
?>