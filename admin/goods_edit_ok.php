<?
include "head.php";
?>
<form name="viewForm" method="post">
<input type="hidden" name="sort" value="<?=$sort?>"><!-- ���Ĺ�� ex)asc:��������  desc:�������� -->
<input type="hidden" name="sortStr" value="<?=$sortStr?>"><!-- ���ı��� ex)name:�̸�  price:���� -->
<input type="hidden" name="position" value="<?=$view_position?>"><!-- ��ġ -->
<input type="hidden" name="data" value="<?=$data?>">
<input type="hidden" name="returnPage" value="<?=$returnPage?>"><!-- ������ϸ� -->
<input type="hidden" name="code" value="<?=$code?>"><!-- ī�װ� �ڵ� -->
</form>
<?
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");//����������
}
if(!$bHtml) $content = $TextContent;
elseif($bHtml==2) $content = $HtmlContent;
else $content = $content;
$GD_SET = $admin_row[bGdset];

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
$dataArr = Decode64($data);
$goods_row = $MySQL->fetch_array("select *from goods where idx='$dataArr[idx]' limit 1");  //��ǰ����
include "linkstr_goods.php";
if ($listedit)
{
	$qry="UPDATE goods SET ";
	if ($limitCnt || $limitCnt>=0) $qry.=" limitCnt=$limitCnt,";
	if (isset($bHit)) $qry.=" bHit='$bHit',";
	if (isset($bEtc)) $qry.=" bEtc='$bEtc',";
	$qry.=" margin = '$margin',point = '$point',supplyprice = '$supplyprice', price='$pricebox' ,bLimit = '$bLimit',size='$size',editday=now(),lastprice=$goods_row[price] WHERE idx=$goods_row[idx]";
	if ($goods_row[price] != $pricebox) // ������ �ٲ������  ����ǰ�� ������Ʈ 
	{
		$num = $MySQL->articles("SELECT idx from interest WHERE goodsIdx=$goods_row[idx]");
		if($num)
		{
			if ($MySQL->query("UPDATE interest SET price=$pricebox,point=$point WHERE goodsIdx=$goods_row[idx]"))
			{
				OnlyMsgView("���� �̻�ǰ�� ����ǰ������ ����ִ� $num ���� ����,�������� �����Ǿ����ϴ�.");
			}
		}
	}
	if ($MySQL->query($qry))
	{
		OnlyMsgView("�����Ǿ����ϴ�.");
	}
	exit;
}
// LIST �󿡼� ��ü���� ����
if ($selectAll_del)
{
	$str = Laststrcut($str);
	$str_arr = explode("/",$str);
	if (count($str_arr)<2) $str_arr[0] = $str;
	for ($i=0; $i<count($str_arr); $i++)
	{
		$goods_row = $MySQL->fetch_array("SELECT * from goods WHERE idx=$str_arr[$i] limit 1");
		if ($goods_row[idx])
		{
			$img1= "../upload/goods/$goods_row[img1]";
			$img2= "../upload/goods/$goods_row[img2]";
			$img3= "../upload/goods/$goods_row[img3]";
			$img4= "../upload/goods/$goods_row[img4]";
			$img5= "../upload/goods/$goods_row[img5]";
			$img6= "../upload/goods/$goods_row[img6]";
			$img7= "../upload/goods/$goods_row[img7]";
			$img8= "../upload/goods/$goods_row[img8]";
			@unlink($img1);
			@unlink($img2);
			@unlink($img3);
			@unlink($img4);
			@unlink($img5);
			@unlink($img6);
			@unlink($img7);
			@unlink($img8);
			$detailimg1= "../upload/goods/$goods_row[detailimg1]";
			$detailimg2= "../upload/goods/$goods_row[detailimg2]";
			$detailimg3= "../upload/goods/$goods_row[detailimg3]";
			$detailimg4= "../upload/goods/$goods_row[detailimg4]";
			@unlink($detailimg1);
			@unlink($detailimg2);
			@unlink($detailimg3);
			@unlink($detailimg4);
			$MySQL->query("DELETE from position where goodsIdx=$goods_row[idx]");
			$MySQL->query("DELETE from compare where goodsIdx=$goods_row[idx]");
			$MySQL->query("DELETE from goods WHERE idx=$str_arr[$i]");
		}
	}
	OnlyMsgView("���� �Ϸ��Ͽ����ϴ�.");
	Refresh($returnPage."?$LINK_STR");
	exit;
}
// LIST �󿡼� ���û�ǰ �ǸŰ� �ϰ�����
if ($price_change)
{
	$succ_cnt = 0;
	$str = Laststrcut($str);
	$str_arr = explode("/",$str);
	if (count($str_arr)<2) $str_arr[0] = $str;
	for ($i=0; $i<count($str_arr); $i++)
	{
		$goods_row = $MySQL->fetch_array("SELECT *from goods WHERE idx=$str_arr[$i] limit 1");
		$price = $goods_row[price];
		$change = round($goods_row[price] * $price_percent * 0.01);
		if ($price_change=="up") $price = $price + $change;
		else if ($price_change=="dn") $price = $price - $change;
		if ($bPoint_stop=="y") { $POINT_QRY = ""; }
		else  ////////// �����ݵ� �ݿ��Ҷ� /////////// 
		{
			if($admin_row[poMethod]!="t")
			{
				$point = round($price * $admin_row[poUnit] * 0.01);
				$POINT_QRY = ",point = $point";
			}
		}
		$qry = "UPDATE goods SET price=$price $POINT_QRY WHERE idx=$goods_row[idx]";
		if ($MySQL->query($qry))
		{
			$succ_cnt++;
		}
	}
	OnlyMsgView("���ݼ��� $succ_cnt �� �Ϸ��Ͽ����ϴ�.");
	Refresh("total_goods_list.php?$LINK_STR");
	exit;
}
if ($codeedit)
{
	if ($MySQL->query("UPDATE goods SET code='$code', editday=now() WHERE idx=$goods_row[idx]"))
	{
		MsgViewHref("�ڵ带 �����Ͽ����ϴ�.","goods_edit.php?data=$data&returnPage=$returnPage&$LINK_STR");
	}
	else
	{
		MsgViewHref("�ڵ������ ������ �߻��Ͽ����ϴ�.","goods_edit.php?data=$data&returnPage=$returnPage&$LINK_STR");
	}
	exit;
}
if ($imgdel) // �߰�Ȯ���̹��� ����
{
	$img = "img$img_num";
	$img_url = "../upload/goods/$goods_row[$img]";
	@unlink($img_url);
	$MySQL->query("UPDATE goods SET $img = '' WHERE idx=$dataArr[idx]");
	echo"<script language='javascript'>
	function Auto_Submit()
	{
		alert('�����Ϸ� �Ͽ����ϴ�.');
		document.viewForm.action='goods_edit.php?$LINK_STR';
		document.viewForm.submit();
	}
	</script>
	<body onload='Auto_Submit()'></body>";
	exit;
}
if ($detailimgdel) // �������̹��� ����
{
	$img = "detailimg$img_num";
	$img_url = "../upload/goods/$goods_row[$img]";
	@unlink($img_url);
	$MySQL->query("UPDATE goods SET $img = '', editday=now() WHERE idx=$dataArr[idx]");
	echo"<script language='javascript'>
	function Auto_Submit()
	{
		alert('�����Ϸ� �Ͽ����ϴ�.');
		document.viewForm.action='goods_edit.php?$LINK_STR';
		document.viewForm.submit();
	}
	</script>
	<body onload='Auto_Submit()'></body>";
	exit;
}
if($del)
{
	$img1= "../upload/goods/$goods_row[img1]";
	$img2= "../upload/goods/$goods_row[img2]";
	$img3= "../upload/goods/$goods_row[img3]";
	$img4= "../upload/goods/$goods_row[img4]";
	$img5= "../upload/goods/$goods_row[img5]";
	$img6= "../upload/goods/$goods_row[img6]";
	$img7= "../upload/goods/$goods_row[img7]";
	$img8= "../upload/goods/$goods_row[img8]";
	@unlink($img1);
	@unlink($img2);
	@unlink($img3);
	@unlink($img4);
	@unlink($img5);
	@unlink($img6);
	@unlink($img7);
	@unlink($img8);
	$detailimg1= "../upload/goods/$goods_row[detailimg1]";
	$detailimg2= "../upload/goods/$goods_row[detailimg2]";
	$detailimg3= "../upload/goods/$goods_row[detailimg3]";
	$detailimg4= "../upload/goods/$goods_row[detailimg4]";
	@unlink($detailimg1);
	@unlink($detailimg2);
	@unlink($detailimg3);
	@unlink($detailimg4);
	if($MySQL->articles("SELECT *from position WHERE goodsIdx=$goods_row[idx]"))
	{
		$up_qry = "DELETE from position WHERE goodsIdx=$goods_row[idx]";
		$MySQL->query($up_qry);
	}
	$qry = "delete from goods where idx=$dataArr[idx]";
	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
		$MySQL->query("DELETE from compare where goodsIdx=$dataArr[idx]"); // �񱳻�ǰ ���̺����� �ش��ǰ ���� 
		ReFresh($returnPage."?code=$code&$LINK_STR");
	}
	else
	{
		echo"Err. : $qry";
	}
}
else
{
	if(empty($price))			$price =0;
	if(empty($bOldPrice))		$bOldPrice=0;
	if(empty($str_oldPrice))	$str_oldPrice =0;
	if(empty($point))			$point=0;
	if(empty($bCompany))		$bCompany=0;
	if(empty($bOrigin))			$bOrigin =0;
	if(empty($bLimit))			$bLimit=0;
	if(empty($str_limitCnt))	$str_limitCnt=0;
	if(empty($bHit))			$bHit =0;
	if(empty($bNew))			$bNew =0;
	if(empty($bEtc))			$bEtc =0;
	if(empty($bHtml))			$bHtml=0;
	if(empty($img_onetoall))		$img_onetoall=0;
	if(empty($bSaleper))			$bSaleper=0; // ���η� ����� ǥ�ÿ��� 
	if(empty($sale))			$sale=0; // ���η� 
	if(empty($margin))			$margin=0;
	if(empty($supplyprice))			$supplyprice=0;
	if (strlen($month)==1) $month = "0".$month;
	if (strlen($month2)==1) $month2 = "0".$month2;
	if (strlen($day)==1) $day = "0".$day;
	if (strlen($day2)==1) $day2 = "0".$day2;
	if(!empty($img1_name))
	{
		$img1_info=@getimagesize($img1);		//�̹���1 ����
		if(($img1_info[2]!=1) && ($img1_info[2]!=2))
		{
			MsgView("�̹���1 ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$img1_name ="a".substr(time(),5,5)."_".$img1_name;	
		@move_uploaded_file($img1, "../upload/goods/$img1_name"); //���Ϻ���
		@unlink($img1);
		@unlink("../upload/goods/$goods_row[img1]");		//���̹��� ����
		$MySQL->query("update goods set img1= '$img1_name' where idx=$dataArr[idx]");
	}
	if(!empty($img2_name))
	{
		$img2_info=@getimagesize($img2);		//�̹���2 ����
		if(($img2_info[2]!=1) && ($img2_info[2]!=2))
		{
			MsgView("�̹���2 ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$img2_name ="b".substr(time(),5,5)."_".$img2_name;
		@move_uploaded_file($img2, "../upload/goods/$img2_name"); //���Ϻ���
		@unlink($img2);
		@unlink("../upload/goods/$goods_row[img2]");        //���̹��� ����
		$MySQL->query("update goods set img2= '$img2_name' where idx=$dataArr[idx]");
	}
	if(!empty($img3_name))
	{
		$img3_info=@getimagesize($img3);		//�̹���3 ����
		if(($img3_info[2]!=1) && ($img3_info[2]!=2))
		{
			MsgView("�̹���3 ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$img3_name ="c".substr(time(),5,5)."_".$img3_name;	
		@move_uploaded_file($img3, "../upload/goods/$img3_name"); //���Ϻ���
		@unlink($img3);
		@unlink("../upload/goods/$goods_row[img3]");		//���̹��� ����
		$MySQL->query("update goods set img3= '$img3_name' where idx=$dataArr[idx]");
	}
	if(!empty($img4_name))
	{
		$img4_info=@getimagesize($img4);
		if(($img4_info[2]!=1) && ($img4_info[2]!=2))
		{
			MsgView("Ȯ���̹���[2] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$img4_name ="d".substr(time(),5,5)."_".$img4_name;
		@move_uploaded_file($img4, "../upload/goods/$img4_name"); //���Ϻ���
		//////////���͸�ũ ���� ����////////// 
		if ($bWmark=="y")
		{
			make_wmark($img4_name,$img4_info);
		}
		@unlink($img4);
		@unlink("../upload/goods/$goods_row[img4]");		//���̹��� ����
		$MySQL->query("update goods set img4= '$img4_name' where idx=$dataArr[idx]");
	}
	if(!empty($img5_name))
	{
		$img5_info=@getimagesize($img5);
		if(($img5_info[2]!=1) && ($img5_info[2]!=2))
		{
			MsgView("Ȯ���̹���[3] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$img5_name ="e".substr(time(),5,5)."_".$img5_name;
		@move_uploaded_file($img5, "../upload/goods/$img5_name"); //���Ϻ���
		//////////���͸�ũ ���� ����////////// 
		if ($bWmark=="y")
		{
			make_wmark($img5_name,$img5_info);
		}
		@unlink($img5);
		@unlink("../upload/goods/$goods_row[img5]");		//���̹��� ����
		$MySQL->query("update goods set img5= '$img5_name' where idx=$dataArr[idx]");
	}
	if(!empty($img6_name))
	{
		$img6_info=@getimagesize($img6);
		if(($img6_info[2]!=1) && ($img6_info[2]!=2))
		{
			MsgView("Ȯ���̹���[4] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$img6_name ="f".substr(time(),5,5)."_".$img6_name;	
		@move_uploaded_file($img6, "../upload/goods/$img6_name"); //���Ϻ���
		//////////���͸�ũ ���� ����////////// 
		if ($bWmark=="y")
		{
			make_wmark($img6_name,$img6_info);
		}
		@unlink($img6);
		@unlink("../upload/goods/$goods_row[img6]");		//���̹��� ����
		$MySQL->query("update goods set img6= '$img6_name' where idx=$dataArr[idx]");
	}
	if(!empty($img7_name))
	{
		$img7_info=@getimagesize($img7);
		if(($img7_info[2]!=1) && ($img7_info[2]!=2))
		{
			MsgView("Ȯ���̹���[5] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$img7_name ="g".substr(time(),5,5)."_".$img7_name;
		@move_uploaded_file($img7, "../upload/goods/$img7_name"); //���Ϻ���
		//////////���͸�ũ ���� ����////////// 
		if ($bWmark=="y")
		{
			make_wmark($img7_name,$img7_info);
		}
		@unlink($img7);
		@unlink("../upload/goods/$goods_row[img7]");		//���̹��� ����
		$MySQL->query("update goods set img7= '$img7_name' where idx=$dataArr[idx]");
	}
	if(!empty($img8_name))
	{
		$img8_info=@getimagesize($img8);
		if(($img8_info[2]!=1) && ($img8_info[2]!=2))
		{
			MsgView("Ȯ���̹���[6] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$img8_name ="h".substr(time(),5,5)."_".$img8_name;	
		@move_uploaded_file($img8, "../upload/goods/$img8_name"); //���Ϻ���
		//////////���͸�ũ ���� ����////////// 
		if ($bWmark=="y")
		{
			make_wmark($img8_name,$img8_info);
		}
		@unlink($img8);
		@unlink("../upload/goods/$goods_row[img8]");		//���̹��� ����
		$MySQL->query("update goods set img8= '$img8_name' where idx=$dataArr[idx]");
	}
	if(!empty($detailimg1_name))
	{
		$detailimg1_info=@getimagesize($detailimg1);
		if(($detailimg1_info[2]!=1) && ($detailimg1_info[2]!=2))
		{
			MsgView("���̹���[1] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$detailimg1_name ="h".substr(time(),5,5)."_".$detailimg1_name;	
		@move_uploaded_file($detailimg1, "../upload/goods/$detailimg1_name"); //���Ϻ���
		@unlink($detailimg1);
		@unlink("../upload/goods/$goods_row[detailimg1]");		//���̹��� ����
		$MySQL->query("update goods set detailimg1= '$detailimg1_name' where idx=$dataArr[idx]");
	}
	if(!empty($detailimg2_name))
	{
		$detailimg2_info=@getimagesize($detailimg2);
		if(($detailimg2_info[2]!=1) && ($detailimg2_info[2]!=2))
		{
			MsgView("���̹���[2] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$detailimg2_name ="h".substr(time(),5,5)."_".$detailimg2_name;	
		@move_uploaded_file($detailimg2, "../upload/goods/$detailimg2_name"); //���Ϻ���
		@unlink($detailimg2);
		@unlink("../upload/goods/$goods_row[detailimg2]");		//���̹��� ����
		$MySQL->query("update goods set detailimg2= '$detailimg2_name' where idx=$dataArr[idx]");
	}
	if(!empty($detailimg3_name))
	{
		$detailimg3_info=@getimagesize($detailimg3);
		if(($detailimg3_info[2]!=1) && ($detailimg3_info[2]!=2))
		{
			MsgView("���̹���[3] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$detailimg3_name ="h".substr(time(),5,5)."_".$detailimg3_name;	
		@move_uploaded_file($detailimg3, "../upload/goods/$detailimg3_name"); //���Ϻ���
		@unlink($detailimg3);
		@unlink("../upload/goods/$goods_row[detailimg3]");		//���̹��� ����
		$MySQL->query("update goods set detailimg3= '$detailimg3_name' where idx=$dataArr[idx]");
	}
	if(!empty($detailimg4_name))
	{
		$detailimg4_info=@getimagesize($detailimg4);
		if(($detailimg4_info[2]!=1) && ($detailimg4_info[2]!=2))
		{
			MsgView("���̹���[4] ������ gif , jpg �� �Է��� �ּ���", -1);
			exit;
		}
		$detailimg4_name ="h".substr(time(),5,5)."_".$detailimg4_name;	
		@move_uploaded_file($detailimg4, "../upload/goods/$detailimg4_name"); //���Ϻ���
		@unlink($detailimg4);
		@unlink("../upload/goods/$goods_row[detailimg4]");		//���̹��� ����
		$MySQL->query("update goods set detailimg4= '$detailimg4_name' where idx=$dataArr[idx]");
	}
	$name = addslashes_userfc(trim($name));
	$meta_str = addslashes_userfc(trim($meta_str));
	$content = addslashes_userfc(trim($content));
	$company = addslashes_userfc($company);
	if (strlen($sale)>3) $sale=0;
	$qry = "update goods set ";
	$qry.= "margin		= $margin,";
	$qry.= "bSaleper	= $bSaleper,";
	$qry.= "sale		= $sale,";
	$qry.= "setVal		= $setVal,";				//��ǰ���� �켱���� ex)1~10		
	$qry.= "price		= $price,";					//����
	$qry.= "bOldPrice	= $bOldPrice,";				//���߰���� ex)1:���  0:�̻��
	$qry.= "oldPrice	= $str_oldPrice,";			//���߰�
	$qry.= "point		= $point,";					//������
	$qry.= "name		= '$name',";				//��ǰ��
	$qry.= "bCompany	= $bCompany,";				//�������� ex)1:���  0:�̻��
	$qry.= "company		= '$company',";			//������
	$qry.= "bOrigin		= $bOrigin,";				//��������� ex)1:���  0:�̻��
	$qry.= "origin		= '$origin',";			//������
	$qry.= "bLimit		= $bLimit,";				//��������� ex)1:���  0:�̻��
	$qry.= "limitCnt	= $str_limitCnt,";			//������
	$qry.= "bHit		= $bHit,";					//hit �̹������	ex)1:���  0:�̻��
	$qry.= "bNew		= $bNew,";					//new �̹������  ex)1:���  0:�̻��
	$qry.= "bEtc		= $bEtc,";					//etc �̹������  ex)1:���  0:�̻��
	$qry.= "partName1	= '$partName1',";			//
	$qry.= "partName2	= '$partName2',";			//�Ӽ���  ex)'����','������',....
	$qry.= "partName3	= '$partName3',";			//
	$qry.= "strPart1	= '$strPart1',";			//
	$qry.= "strPart2	= '$strPart2',";			//�Ӽ�   ex)����������������Ķ���������
	$qry.= "strPart3	= '$strPart3',";			//
	$qry.= "bHtml		= $bHtml,";					//��ǰ�� ���� html���  1:���  0:�̻��
	$qry.= "content		= '$content',";				//��ǰ�� ����
	$qry.= "img_onetoall	= $img_onetoall,";
	$qry.= "supplyprice	= $supplyprice,";
	$qry.= "meta_str	= '$meta_str',";	
	$qry.= "editday	= now(),";	
	$qry.= "size	= '$size',";	
	$qry.= "model	= '$model',";	
	$qry.= "chango	= '$chango',";	
	$qry.= "quality	= '$quality',";	
	$qry.= "bWmark	= '$bWmark',";	
	$qry.= "minbuyCnt	= '$minbuyCnt',";	
	$qry.= "maxbuyCnt	= '$maxbuyCnt',";
	$qry.= "trans_content	= '$trans_content'";
	$qry.= " where idx=$dataArr[idx]";
	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
		if ($goods_row[price] != $price) // ������ �ٲ������  
		{
			if($MySQL->articles("SELECT idx from interest WHERE goodsIdx=$dataArr[idx]"))
			{
				$num = $MySQL->articles("SELECT idx from interest WHERE goodsIdx=$dataArr[idx]");
				if ($MySQL->query("UPDATE interest SET price=$price,point=$point WHERE goodsIdx=$dataArr[idx]"))
				{
					OnlyMsgView("���� �̻�ǰ�� ����ǰ������ ����ִ� $num ���� ����,�������� �����Ǿ����ϴ�.");
				}
			}
		}

		if ($img_onetoall && $GD_SET=="y")
		{
			if ($img3_name) // �̹���3�� ��ü�ɶ� 1,2,3 GD���� 
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
					if ($bWmark=="y")
					{
						$sourcefile_id = ImageCreateFromJPEG($home_url.$src_file);
						$targetfile = $home_url.$src_file;
						if ($wm_type)
						{
							mergePix($sourcefile_id,$insertfile_id, $targetfile, $admin_row[wm_pos],$transition=50,"jpg",$wm_type);
						}
						else
						{
							OnlyMsgView("���͸�ũ �̹����� jpg,gif �� �ƴϰų� �̹����� �����ϴ�.");
						}
					}
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
					ImageDestroy($dst240);
					ImageDestroy($src);
				}
				else if ($tmp_src[1] == "gif" || $tmp_src[1] == "GIF")
				{
					if ($bWmark=="y")
					{
						$sourcefile_id = ImageCreateFromGIF($home_url.$src_file);
						$targetfile = $home_url.$src_file;
						if ($wm_type)
						{
							mergePix($sourcefile_id,$insertfile_id, $targetfile, $admin_row[wm_pos],$transition=50,"gif",$wm_type);
						}
						else
						{
							OnlyMsgView("���͸�ũ �̹����� jpg,gif �� �ƴϰų� �̹����� �����ϴ�.");
						}
					}
					$src = ImageCreateFromGIF($home_url.$src_file);
					$dst = imagecreatetruecolor($GDIMG1_WIDTH, $GDIMG1_HEIGHT); //GD 2.0
					$dst240 = imagecreatetruecolor($GDIMG2_WIDTH, $GDIMG2_HEIGHT); //GD 2.0
					ImageColorAllocate($dst, 255, 255, 255); 
					ImageColorAllocate($dst240, 255, 255, 255);
					imagecopyresampled($dst, $src, 0, 0, 0, 0, $GDIMG1_WIDTH, $GDIMG1_HEIGHT, imagesx($src), imagesy($src)); //GD 2.0 �̻� 
					imagegif($dst, $home_url.$dst_file, 100);
					imagecopyresampled($dst240, $src, 0, 0, 0, 0, $GDIMG2_WIDTH, $GDIMG2_HEIGHT, imagesx($src), imagesy($src)); //GD 2.0 �̻� 
					imagegif($dst240, $home_url.$dst_file240, 100); 
					ImageDestroy($dst); 
					ImageDestroy($dst240);
					ImageDestroy($src); 
				}
				$qry ="UPDATE goods SET img1='$dst_file',img2='$dst_file240' WHERE code='$goodcode'";
				if ($MySQL->query($qry))
				{
					unlink("../upload/goods/$goods_row[img1]");        //���̹��� ����
					unlink("../upload/goods/$goods_row[img2]");        //���̹��� ����
				}
			}
		}
		echo"<script language='javascript'>
		function Auto_Submit()
		{
			document.viewForm.action='goods_edit.php?$LINK_STR';
			document.viewForm.submit();
		}
		</script>
		<body onload='Auto_Submit()'></body>";
	}
	else
	{
		echo "$qry";
	}
}
?>