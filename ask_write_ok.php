<?
session_start();
include "./lib/config.php";
include "./lib/function.php";
/*------------------------�Խ��� �� ��� ---------------------------------*/
$dataArr=Decode64($data);
//��������  :ref,re_level,re_step,content
if(!empty($data))
{
	$up_sql="update bbs_data set re_step=re_step+1 where ref=$ref and re_step > $re_step";
	$up_result=$MySQL->query($up_sql);
	$re_step++;
	$re_level++;
}
else
{
	$row=$MySQL->fetch_array("select max(ref) from bbs_data");
	$ref=$row[0]+1;
	$re_step=0;
	$re_level=0;
}
//����÷��
if(!empty($up_file_name))
{
	if(file_exists("./upload/bbs/$up_file_name"))
	{
		//�������ϸ� üũ
		$up_file_name =substr(time(),5,5)."_".$up_file_name;
	}
	@copy($up_file, "./upload/bbs/$up_file_name"); //���Ϻ���
	unlink($up_file);
}
if($bHtml==1) $content = $TextContent;
elseif($bHtml==2) $content = $HtmlContent;
else $content = $content;
$qry = "insert into bbs_data(code,name,email,content,bHtml,title,writeday,";
$qry.= "pwd,ref,re_step,re_level,userIp,up_file,userid)values(";
$qry.= "'person_ask',";			//�Խ��� �ڵ�
$qry.= "'$name',";			//�ۼ���
$qry.= "'$email',";			//�̸���
$qry.= "'$content',";		//�۳���
$qry.= "'$bHtml',";			//������
$qry.= "'$title',";			//������
$qry.= "now(),";			//�ۼ���
$qry.= "'$pwd',";			//��й�ȣ
$qry.= "$ref,";				//�亯����
$qry.= "$re_step,";			//�亯����
$qry.= "$re_level,";		//�亯����
$qry.= "'$REMOTE_ADDR',";	//������
$qry.= "'$up_file_name', ";	//÷�����ϸ�
$qry.= "'$_SESSION[GOOD_SHOP_USERID]'";
$qry.= ")";
if($MySQL->query($qry))
{
	OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
	ReFresh("ask_list.php");
}
else
{
	@unlink("./upload/bbs/$up_file_name");
	echo "$qry";
}
?>