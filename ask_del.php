<?
session_start();
include "./lib/config.php";
include "./lib/function.php";
/*------------------------�Խ��� ��й�ȣ üũ ---------------------------------*/
$dataArr = Decode64($data);
$bbs_row = $MySQL->fetch_array("select *from bbs_data where idx=$dataArr[idx]");
if($MySQL->query("delete from bbs_data where idx=$dataArr[idx]"))
{
	if(!empty($bbs_row[up_file])) @unlink("./upload/bbs/$bbs_row[up_file]"); //���ϻ���
	OnlyMsgView("���� �Ϸ��Ͽ����ϴ�.");
	ReFresh("ask_list.php");
}
else
{
	echo"delete Err. ";
}
?>