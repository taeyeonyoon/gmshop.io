<?
include "head.php";
$dataArr=Decode64($data);
$bbs_admin_row = $MySQL->fetch_array("select *from bbs_list where code='$code'"); //�Խ��� ����
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
	if(file_exists("../upload/bbs/$up_file_name"))
	{
		$up_file_name =substr(time(),5,5)."_".$up_file_name;
	}
	@copy($up_file, "../upload/bbs/$up_file_name"); //���Ϻ���
	unlink($up_file);
}
if($bbs_admin_row[part]==30)
{
	if(!empty($img1_name))
	{
		if(file_exists("../upload/bbs/$img1_name"))
		{
			$img1_name =substr(time(),5,5)."_".$img1_name;
		}
		@copy($img1, "../upload/bbs/$img1_name"); //���Ϻ���
		unlink($img1);
	}
	if(!empty($img2_name))
	{
		if(file_exists("../upload/bbs/$img2_name"))
		{
			$img2_name =substr(time(),5,5)."_".$img2_name;
		}
		@copy($img2, "../upload/bbs/$img2_name"); //���Ϻ���
		unlink($img2);
	}
}
if (empty($gongji)) $gongji=0;
if($bHtml==1) $content = $TextContent;
elseif($bHtml==2) $content = $HtmlContent;
else $content = $content;
$qry = "insert into bbs_data(code,name,email,content,bHtml,title,writeday,";
$qry.= "pwd,img1,img2,ref,re_step,re_level,userIp,up_file,gongji,gongji_day,userid,bLock)values(";
$qry.= "'$code',";			//�Խ��� �ڵ�
$qry.= "'$name',";			//�ۼ���
$qry.= "'$email',";			//�̸���
$qry.= "'$content',";		//�۳���
$qry.= "$bHtml,";			//�۳���
$qry.= "'$title',";			//������
$qry.= "now(),";			//�ۼ���
$qry.= "'$pwd',";			//��й�ȣ
$qry.= "'$img1_name',";		//������ �̹���
$qry.= "'$img2_name',";		//������ �̹���
$qry.= "$ref,";				//�亯����
$qry.= "$re_step,";			//�亯����
$qry.= "$re_level,";		//�亯����
$qry.= "'$REMOTE_ADDR',";	//������
$qry.= "'$up_file_name', ";	//÷�����ϸ�
$qry.= "$gongji, ";
$qry.= "now(), ";
$qry.= "'$GOOD_SHOP_ADMIN_USERID','$bLock' ";
$qry.= ")";
if($MySQL->query($qry))
{
	OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");
	ReFresh("bbs_list.php?code=$code");
}
else
{
	@unlink("../upload/bbs/$up_file_name"); 
	@unlink("../upload/bbs/$img1_name"); 
	@unlink("../upload/bbs/$img2_name"); 
	echo "$qry";
}
?>