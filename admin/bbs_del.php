<?
include "head.php";
if ($mode == "alldel")
{
	$idx_arr = explode("/",$idx);
	foreach ($idx_arr as $key => $value)
	{
		$view_row = $MySQL->fetch_array("select *from bbs_data where idx=$value"); //�Խ��� ����
		if(!empty($view_row[up_file]))
		{
			@unlink("../upload/bbs/$view_row[up_file]"); //���ϻ���
		}
		if(!empty($view_row[img1]))
		{
			@unlink("../upload/bbs/$view_row[img1]");
		}
		if(!empty($view_row[img2]))
		{
			@unlink("../upload/bbs/$view_row[img2]");
		}
		$MySQL->query("delete from bbs_data where idx=$value");
	}
	MsgViewHref("�����Ͽ����ϴ�","bbs_list.php?code=$code");
}
?>