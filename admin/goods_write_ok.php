<?
include "head.php";
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");//����������
}
if(!$bHtml) $content = $TextContent;
elseif($bHtml==2) $content = $HtmlContent;
else $content = $content;
$GD_SET = $admin_row[bGdset];
// GD �� ����
$SCRIPT_FILENAME_ARR = explode("admin",$_SERVER["SCRIPT_FILENAME"]);
$host = $SCRIPT_FILENAME_ARR[0];
if (substr($host,-1)=="/") $host = Laststrcut($host);
if (substr($admin_row[shopUrl],-1)=="/") $admin_row[shopUrl] = Laststrcut($admin_row[shopUrl]);
$home_url = $host."/upload/goods/";
$http_url = "http://$admin_row[shopUrl]"."/upload/goods/";
if ($bWmark=="y")
{
	$wm_info = getimagesize("../upload/watermark_img");
	$wm_file = "/upload/watermark_img";
	$targetfile = $home_url.$src_file;
	if ($wm_info[2]==2)
	{
		$wm_type = "jpg";
		$insertfile_id = ImageCreateFromJPEG($host.$wm_file);
	}
	else if ($wm_info[2]==1)
	{
		$wm_type = "gif";
		$insertfile_id = ImageCreateFromGIF($host.$wm_file);
	}
	else $wm_type="";
}

if(empty($price))			$price =0;
if(empty($bOldPrice))		$bOldPrice=0;
if(empty($str_oldPrice))	$str_oldPrice =0;
if(empty($point))			$point=0;
if(empty($setVal))			$setVal=0;
if(empty($bCompany))		$bCompany=0;
if(empty($bOrigin))			$bOrigin =0;
if(empty($bLimit))			$bLimit=0;
if(empty($str_limitCnt))	$str_limitCnt=0;
if(empty($bHit))			$bHit =0;
if(empty($bNew))			$bNew =0;
if(empty($bEtc))			$bEtc =0;
if(empty($bHtml))			$bHtml=0;
if(empty($point))			$point=0;
if(empty($img_onetoall))	$img_onetoall=0;
if(empty($margin) || (!is_numeric($margin)))	$margin=0;
if(empty($supplyprice))		$supplyprice=0;
if (strlen($month)==1) $month = "0".$month;
if (strlen($month2)==1) $month2 = "0".$month2;
if (strlen($day)==1) $day = "0".$day;
if (strlen($day2)==1) $day2 = "0".$day2;
if(empty($minbuyCnt))		$minbuyCnt=0;
if(empty($maxbuyCnt))		$maxbuyCnt=0;
function imgalldel()
{
	global $img1_name,$img2_name,$img3_name,$img4_name,$img5_name,$img6_name,$img7_name,$img8_name;
	global $detailimg1_name,$detailimg2_name,$detailimg3_name,$detailimg4_name;
	if(is_file("../upload/goods/$img1_name")) @unlink("../upload/goods/$img1_name");
	if(is_file("../upload/goods/$img2_name")) @unlink("../upload/goods/$img2_name");
	if(is_file("../upload/goods/$img3_name")) @unlink("../upload/goods/$img3_name");
	if(is_file("../upload/goods/$img4_name")) @unlink("../upload/goods/$img4_name");
	if(is_file("../upload/goods/$img5_name")) @unlink("../upload/goods/$img5_name");
	if(is_file("../upload/goods/$img6_name")) @unlink("../upload/goods/$img6_name");
	if(is_file("../upload/goods/$img7_name")) @unlink("../upload/goods/$img7_name");
	if(is_file("../upload/goods/$img8_name")) @unlink("../upload/goods/$img8_name");
	if(is_file("../upload/goods/$detailimg1_name")) @unlink("../upload/goods/$detailimg1_name");
	if(is_file("../upload/goods/$detailimg2_name")) @unlink("../upload/goods/$detailimg2_name");
	if(is_file("../upload/goods/$detailimg3_name")) @unlink("../upload/goods/$detailimg3_name");
	if(is_file("../upload/goods/$detailimg4_name")) @unlink("../upload/goods/$detailimg4_name");
}
// �̹������
if(!empty($img1_name))
{
	$img1_info=@getimagesize($img1);		//�̹���1 ����
	if(($img1_info[2]!=1) && ($img1_info[2]!=2))
	{
		MsgView("�����̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img1_name ="a".substr(time(),5,5)."_".$img1_name;
	$img1_name = str_replace(" ","",$img1_name);
	@move_uploaded_file($img1, "../upload/goods/$img1_name"); //���Ϻ���
	@unlink($img1);
}
if(!empty($img2_name))
{
	$img2_info=@getimagesize($img2);		//�̹���2 ����
	if(($img2_info[2]!=1) && ($img2_info[2]!=2))
	{
		imgalldel();
		MsgView("ū�̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img2_name ="b".substr(time(),5,5)."_".$img2_name;
	$img2_name = str_replace(" ","",$img2_name);
	@move_uploaded_file($img2, "../upload/goods/$img2_name"); //���Ϻ���
	@unlink($img2);
}
if(!empty($img3_name))
{
	$img3_info=@getimagesize($img3);		//�̹���3 ����
	if(($img3_info[2]!=1) && ($img3_info[2]!=2))
	{
		imgalldel();
		MsgView("Ȯ���̹���[1] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img3_name ="c".substr(time(),5,5)."_".$img3_name;
	$img3_name = str_replace(" ","",$img3_name);
	@move_uploaded_file($img3, "../upload/goods/$img3_name"); //���Ϻ���
	// ���͸�ũ ���� ����
	if ($bWmark=="y")
	{
		make_wmark($img3_name,$img3_info);
	}
	@unlink($img3);
}
if(!empty($img4_name))
{
	$img4_info=@getimagesize($img4);
	if(($img4_info[2]!=1) && ($img4_info[2]!=2))
	{
		imgalldel();
		MsgView("Ȯ���̹���[2] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img4_name ="d".substr(time(),5,5)."_".$img4_name;	
	$img4_name = str_replace(" ","",$img4_name);
	@move_uploaded_file($img4, "../upload/goods/$img4_name"); //���Ϻ���
	// ���͸�ũ ���� ����
	if ($bWmark=="y")
	{
		make_wmark($img4_name,$img4_info);
	}
	@unlink($img4);
}
if(!empty($img5_name))
{
	$img5_info=@getimagesize($img5);
	if(($img5_info[2]!=1) && ($img5_info[2]!=2))
	{
		imgalldel();
		MsgView("Ȯ���̹���[3] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img5_name ="e".substr(time(),5,5)."_".$img5_name;
	$img5_name = str_replace(" ","",$img5_name);
	@move_uploaded_file($img5, "../upload/goods/$img5_name"); //���Ϻ���
	// ���͸�ũ ���� ����
	if ($bWmark=="y")
	{
		make_wmark($img5_name,$img5_info);
	}
	@unlink($img5);
}
if(!empty($img6_name))
{
	$img6_info=@getimagesize($img6);
	if(($img6_info[2]!=1) && ($img6_info[2]!=2))
	{
		imgalldel();
		MsgView("Ȯ���̹���[4] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img6_name ="f".substr(time(),5,5)."_".$img6_name;
	$img6_name = str_replace(" ","",$img6_name);
	@move_uploaded_file($img6, "../upload/goods/$img6_name"); //���Ϻ���
	// ���͸�ũ ���� ����
	if ($bWmark=="y")
	{
		make_wmark($img6_name,$img6_info);
	}
	@unlink($img6);
}
if(!empty($img7_name))
{
	$img7_info=@getimagesize($img7);
	if(($img7_info[2]!=1) && ($img7_info[2]!=2))
	{
		imgalldel();
		MsgView("Ȯ���̹���[5] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img7_name ="g".substr(time(),5,5)."_".$img7_name;
	$img7_name = str_replace(" ","",$img7_name);
	@move_uploaded_file($img7, "../upload/goods/$img7_name"); //���Ϻ���
	// ���͸�ũ ���� ����
	if ($bWmark=="y")
	{
		make_wmark($img7_name,$img7_info);
	}
	@unlink($img7);
}
if(!empty($img8_name))
{
	$img8_info=@getimagesize($img8);
	if(($img8_info[2]!=1) && ($img8_info[2]!=2))
	{
		imgalldel();
		MsgView("Ȯ���̹���[6] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$img8_name ="h".substr(time(),5,5)."_".$img8_name;
	$img8_name = str_replace(" ","",$img8_name);
	@move_uploaded_file($img8, "../upload/goods/$img8_name"); //���Ϻ���
	// ���͸�ũ ���� ����
	if ($bWmark=="y")
	{
		make_wmark($img8_name,$img8_info);
	}
	@unlink($img8);
}
if(!empty($detailimg1_name))
{
	$detailimg1_info=@getimagesize($detailimg1);
	if(($detailimg1_info[2]!=1) && ($detailimg1_info[2]!=2))
	{
		imgalldel();
		MsgView("���̹���[1] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$detailimg1_name ="h".substr(time(),5,5)."_".$detailimg1_name;
	$detailimg1_name = str_replace(" ","",$detailimg1_name);
	@move_uploaded_file($detailimg1, "../upload/goods/$detailimg1_name"); //���Ϻ���
	@unlink($detailimg1);
	@unlink("../upload/goods/$goods_row[detailimg1]");		//���̹��� ����
}
if(!empty($detailimg2_name))
{
	$detailimg2_info=@getimagesize($detailimg2);
	if(($detailimg2_info[2]!=1) && ($detailimg2_info[2]!=2))
	{
		imgalldel();
		MsgView("���̹���[2] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$detailimg2_name ="h".substr(time(),5,5)."_".$detailimg2_name;
	$detailimg2_name = str_replace(" ","",$detailimg2_name);
	@move_uploaded_file($detailimg2, "../upload/goods/$detailimg2_name"); //���Ϻ���
	@unlink($detailimg2);
	@unlink("../upload/goods/$goods_row[detailimg2]");		//���̹��� ����
}
if(!empty($detailimg3_name))
{
	$detailimg3_info=@getimagesize($detailimg3);
	if(($detailimg3_info[2]!=1) && ($detailimg3_info[2]!=2))
	{
		imgalldel();
		MsgView("���̹���[3] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$detailimg3_name ="h".substr(time(),5,5)."_".$detailimg3_name;
	$detailimg3_name = str_replace(" ","",$detailimg3_name);
	@move_uploaded_file($detailimg3, "../upload/goods/$detailimg3_name"); //���Ϻ���
	@unlink($detailimg3);
	@unlink("../upload/goods/$goods_row[detailimg3]");		//���̹��� ����
}
if(!empty($detailimg4_name))
{
	$detailimg4_info=@getimagesize($detailimg4);
	if(($detailimg4_info[2]!=1) && ($detailimg4_info[2]!=2))
	{
		imgalldel();
		MsgView("���̹���[4] ������ gif , jpg �� �Է��� �ּ���", -1);
		exit;
	}
	$detailimg4_name ="h".substr(time(),5,5)."_".$detailimg4_name;
	$detailimg4_name = str_replace(" ","",$detailimg4_name);
	@move_uploaded_file($detailimg4, "../upload/goods/$detailimg4_name"); //���Ϻ���
	@unlink($detailimg4);
	@unlink("../upload/goods/$goods_row[detailimg4]");		//���̹��� ����
}
$name = addslashes_userfc(trim($name));
$meta_str = addslashes_userfc(trim($meta_str));
$content = addslashes_userfc(trim($content));
$company = addslashes_userfc($company);

$qry = "insert into goods(category,code,name,price,bOldPrice,oldPrice,";
$qry.= "point,bCompany,company,bOrigin,origin,bLimit,limitCnt,bHit,bNew,bEtc,";
$qry.= "partName1,partName2,partName3,strPart1,strPart2,strPart3,";
$qry.= "img1,img2,img3,img4,img5,img6,img7,img8,";
$qry.= "bHtml,content,writeday,position,readCnt,setVal,img_onetoall,";
$qry.= "supplyprice,margin,detailimg1,detailimg2,detailimg3,detailimg4,";
$qry.= "meta_str,size,model,";
$qry.= "chango,quality,bWmark,minbuyCnt,maxbuyCnt,trans_content,sale,bSaleper,relation";
$qry.= ") values(";
$qry.= "'$category',";			//��ǰī�װ� �ڵ�
$qry.= "'$code',";				//��ǰ�ڵ�
$qry.= "'$name',";				//��ǰ��
$qry.= "$price,";				//����
$qry.= "$bOldPrice,";			//���߰���� ex)1:���  0:�̻��
$qry.= "$str_oldPrice,";		//���߰�
$qry.= "$point,";				//������
$qry.= "$bCompany,";			//�������� ex)1:���  0:�̻��
$qry.= "'$str_company',";		//������
$qry.= "$bOrigin,";				//��������� ex)1:���  0:�̻��
$qry.= "'$str_origin',";		//������
$qry.= "$bLimit,";				//��������� ex)1:���  0:�̻��
$qry.= "$str_limitCnt,";		//������
$qry.= "$bHit,";				//hit �̹������	ex)1:���  0:�̻��
$qry.= "$bNew,";				//new �̹������  ex)1:���  0:�̻��
$qry.= "$bEtc,";				//etc �̹������  ex)1:���  0:�̻��
$qry.= "'$partName1',";			//
$qry.= "'$partName2',";			//�Ӽ���  ex)'����','������',....
$qry.= "'$partName3',";			//
$qry.= "'$strPart1',";			//
$qry.= "'$strPart2',";			//�Ӽ�   ex)����������������Ķ���������
$qry.= "'$strPart3',";			//
$qry.= "'$img1_name',";			//��ǰ�̹���
$qry.= "'$img2_name',";
$qry.= "'$img3_name',";
$qry.= "'$img4_name',";			//��ǰ�̹���
$qry.= "'$img5_name',";
$qry.= "'$img6_name',";
$qry.= "'$img7_name',";			//��ǰ�̹���
$qry.= "'$img8_name',";
$qry.= "$bHtml,";				//��ǰ�� ���� html���  1:���  0:�̻��
$qry.= "'$content',";			//��ǰ�� ����
$qry.= "now(),";				//�����
$qry.= "'$str_position',";		//Ư�� ��ġ
$qry.= "0, ";					//��ȸ��
$qry.= "$setVal,";				//��ǰ���� �켱���� ex)1 ~ 10
$qry.= "$img_onetoall,";
$qry.= "$supplyprice,";
$qry.= "$margin,";
$qry.= "'$detailimg1_name',";
$qry.= "'$detailimg2_name',";
$qry.= "'$detailimg3_name',";
$qry.= "'$detailimg4_name',";
$qry.= "'$meta_str',";
$qry.= "'$size',";
$qry.= "'$model',";
$qry.= "'$chango',";	
$qry.= "'$quality',";
$qry.= "'$bWmark',";
$qry.= "$minbuyCnt,";
$qry.= "$maxbuyCnt,";
$qry.= "'$trans_content',";
$qry.= "'$sale',";
$qry.= "'$bSaleper',";
$qry.= "'$relation'";
$qry.= ")";
if($MySQL->query($qry))
{
	OnlyMsgView("��ϿϷ� �Ͽ����ϴ�.");

	// GD �̹��� ���� 2.0 �̻� ���õ�����
	if ($img_onetoall && $GD_SET=="y")
	{
		if (empty($img1_name) && empty($img2_name)) // �̹���1,2 �� ������ ���� ���� 
		{
			if(!defined(__DESIGN_GOODS_ROW))
			{
				define(__DESIGN_GOODS_ROW,"TRUE");
				$design_goods=$MySQL->fetch_array("select *from design_goods limit 0,1");
			}
			$GDIMG1_WIDTH = $design_goods[gdimg1_width];
			$GDIMG1_HEIGHT = $design_goods[gdimg1_height];
			$GDIMG2_WIDTH = $design_goods[gdimg2_width];
			$GDIMG2_HEIGHT = $design_goods[gdimg2_height];
			if (!$GDIMG1_WIDTH) $GDIMG1_WIDTH = 100;
			if (!$GDIMG1_HEIGHT) $GDIMG1_HEIGHT = 100;
			if (!$GDIMG2_WIDTH) $GDIMG2_WIDTH = 240;
			if (!$GDIMG2_HEIGHT) $GDIMG2_HEIGHT = 240;
			$src_file = $img3_name;

			//100������ 
			$tmp_src = explode(".",$src_file);
			$tmp_src[0] = "gd_".$tmp_src[0];
			$dst_file = join(".",$tmp_src);

			//240 ������ 
			$tmp_src = explode(".",$src_file);
			$tmp_src[0] = "gd240_".$tmp_src[0];
			$dst_file240 = join(".",$tmp_src);
			if ($tmp_src[1] == "jpg" || $tmp_src[1] == "JPG")
			{
				$src = imagecreatefromjpeg($home_url.$src_file); 
				$dst = imagecreatetruecolor($GDIMG1_WIDTH, $GDIMG1_HEIGHT); //GD 2.0
				$dst240 = imagecreatetruecolor($GDIMG2_WIDTH, $GDIMG2_HEIGHT); //GD 2.0
				ImageColorAllocate($dst, 255, 255, 255); 
				ImageColorAllocate($dst240, 255, 255, 255); 
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $GDIMG1_WIDTH, $GDIMG1_HEIGHT, imagesx($src), imagesy($src)); //GD 2.0 �̻� 
				imagejpeg($dst, $home_url.$dst_file, 100); 
				ImageDestroy($dst);
				imagecopyresampled($dst240, $src, 0, 0, 0, 0, $GDIMG2_WIDTH, $GDIMG2_HEIGHT, imagesx($src), imagesy($src)); //GD 2.0 �̻� 
				imagejpeg($dst240, $home_url.$dst_file240, 100); 
				ImageDestroy($src); 
				ImageDestroy($dst240); 
			}
			else if ($tmp_src[1] == "gif" || $tmp_src[1] == "GIF")
			{
				$src = ImageCreateFromGIF($home_url.$src_file); 
				$dst = imagecreatetruecolor($GDIMG1_WIDTH, $GDIMG1_HEIGHT); //GD 2.0
				$dst240 = imagecreatetruecolor($GDIMG2_WIDTH, $GDIMG2_HEIGHT); //GD 2.0
				ImageColorAllocate($dst, 255, 255, 255); 
				ImageColorAllocate($dst240, 255, 255, 255); 
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $GDIMG1_WIDTH, $GDIMG1_HEIGHT, imagesx($src), imagesy($src)); //GD 2.0 �̻� 
				imagegif($dst, $home_url.$dst_file, 100); 
				imagecopyresampled($dst240, $src, 0, 0, 0, 0, $GDIMG2_WIDTH, $GDIMG2_HEIGHT, imagesx($src), imagesy($src)); //GD 2.0 �̻� 
				imagegif($dst240, $home_url.$dst_file240, 100); 
				ImageDestroy($src); 
				ImageDestroy($dst); 
				ImageDestroy($dst240); 
			}
			$qry ="UPDATE goods SET img1='$dst_file',img2='$dst_file240' WHERE code='$code'";
			$MySQL->query($qry);
		}
	}
	ReFresh("total_goods_list.php?code=$category&write_code=$category"); ////write_code �� ��ǰ����� ����̵��� ��ǰī�װ� �ڵ������� ���� 
}
else
{
	imgalldel();
	echo "$qry";
}
?>