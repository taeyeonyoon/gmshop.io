<?
include "./lib/config.php";
include "./lib/function.php";
/*------------------------�Խ��� �� ����,���� ---------------------------------*/
$dataArr=Decode64($data);
$view_row = $MySQL->fetch_array("select *from bbs_data where idx=$dataArr[idx] limit 1"); //�Խ��� ����
//����÷��
if(!empty($up_file_name))
{
	if(!empty($view_row[up_file])) @unlink("./upload/bbs/$view_row[up_file]"); //�������ϻ���
	if(file_exists("./upload/bbs/$up_file_name")) $up_file_name =substr(time(),5,5)."_".$up_file_name;
	@copy($up_file, "./upload/bbs/$up_file_name"); //���Ϻ���
	unlink($up_file);
	$qry = "update bbs_data set up_file = '$up_file_name' where idx=$dataArr[idx]";
	$MySQL->query($qry);
}
if($bHtml==1) $content = $TextContent;
elseif($bHtml==2) $content = $HtmlContent;
else $content = $content;
$qry = "update bbs_data set ";
$qry.= "name	= '$name',";			//�ۼ���
$qry.= "email	= '$email',";			//�̸���
$qry.= "content = '$content',";		//�۳���
$qry.= "bHtml	= $bHtml,";			//�۳�������
$qry.= "title	= '$title' ";					//������
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
?>