<?
// �ҽ��������
// 20060718-1 �ҽ����� �輺ȣ : Ȯ���̹��� ��ü(6��) �Է½� ȭ�� ���� ����
include "head.php";
if (empty($goodsIdx))
{
	MsgViewHref("��ǰ������ ���������� �Ѿ���� �ʾҽ��ϴ�.","index.php");
	exit;
}
if($admin_row[xTrans_bhtml])
{
	$xTrans = $admin_row[xTrans];
}
else
{
	$xTrans = nl2br(htmlspecialchars($admin_row[xTrans]));
}
//��ȸ�� ����
$MySQL->query("update goods set readCnt=readCnt+1 where idx=$goodsIdx ");
$goods_row = $MySQL->fetch_array("select *from goods where idx=$goodsIdx limit 1");//��ǰ����
if ($design[today_view]) /// ���ú���ǰ ��ɻ��� 
{
	if(empty($_SESSION[GOOD_SHOP_USERID]))
	{
		//��ȸ�� ���� ���̵� ���
		$GOOD_SHOP_USERID	= time();
		$GOOD_SHOP_NAME		= "��ȸ��";
		$GOOD_SHOP_PART		= "guest";
		$GOOD_SHOP_CART		= time();
		$GOOD_SHOP_PART_GUBUN	= "G";
		$_SESSION['GOOD_SHOP_USERID'] = "$GOOD_SHOP_USERID";
		$_SESSION['GOOD_SHOP_NAME'] = "$GOOD_SHOP_NAME";
		$_SESSION['GOOD_SHOP_PART'] = "$GOOD_SHOP_PART";	
		$_SESSION['GOOD_SHOP_CART'] = "$GOOD_SHOP_CART";
		$_SESSION['GOOD_SHOP_PART_GUBUN'] = "$GOOD_SHOP_PART_GUBUN";
	}
	$today = date("Y-m-d",time());
	if (!$MySQL->articles("SELECT idx from today_view WHERE userid='$_SESSION[GOOD_SHOP_USERID]' and left(writeday,10)='$today' and goodsIdx=$goodsIdx limit 1"))
	{
		$qry = "INSERT INTO today_view values ('','$goodsIdx','$goods_row[img1]',now(),'$_SESSION[GOOD_SHOP_USERID]')";
		$MySQL->query($qry);
	}
}
$category_info = $MySQL->fetch_array("select * from category where code='$goods_row[category]' limit 1");	//�з� ����
//������ǰ
$next_goods_qry = "select max(idx) from goods where idx < $goods_row[idx] and bLimit<3";	//���� idx ���� ū idx �� ���� ������
$next_goods_qry.= " and category ='$category_info[code]'";
$next_goods_idx = $MySQL->fetch_array($next_goods_qry);
//������ǰ
$pre_goods_qry = "select min(idx) from goods where idx > $goods_row[idx] and bLimit<3";	//���� idx ���� ���� idx �� ���� ū��
$pre_goods_qry.= " and category='$category_info[code]'";
$pre_goods_idx = $MySQL->fetch_array($pre_goods_qry);

$img1_info	=@getimagesize("./upload/goods/$goods_row[img3]");   //Ȯ�� �̹��� ����
$wSize1	=$img1_info[0];	//����
$hSize1	=$img1_info[1];	//����
//��ǰ����
if($goods_row[bHtml])	$content =$goods_row[content];					//�±׻��
else
{
	$content=nl2br(htmlspecialchars($goods_row[content]));	//�±׹̻��
}
if($goods_row[bLimit])
{
	if(empty($goods_row[limitCnt]) || $goods_row[bLimit]==2) $limitCnt ="<FONT COLOR='#990000'>ǰ��</FONT>";
	else if($goods_row[bLimit]==3) $limitCnt ="<FONT COLOR='#990000'>����</FONT>";
	else if($goods_row[bLimit]==4) $limitCnt ="<FONT COLOR='#990000'>����</FONT>";
}

// �ǸŰ� ��� Ŭ����
$gprice = new CGoodsPrice($goods_row[idx]);
// ī�װ� ���� ����
$str_category = " <font color='$subdesign[tc1]'> &gt; ".$category_info[name];

// ���û�ǰ ���翩�� üũ
$relation_cnt = 0;
if ($goods_row[relation])
{
	$relation = Laststrcut($goods_row[relation]);
	$relation = explode("/",$relation);
	if(!empty($relation[0]))
	{
		$relation_qry = $relation[0];
		for ($j=1; $j<count($relation); $j++)
		{
			$relation_qry.= ", ".$relation[$j];
		}
	}
	$row = $MySQL->fetch_array("select count(*) as cnt from goods where idx in (".$relation_qry.") and bLimit<3");
	$relation_cnt = $row[cnt];	//ǥ�� ������ ���û�ǰ��
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
var optionArr = new Array();
optionArr[0] ="<?=$goods_row[partName1]?>";
optionArr[1] ="<?=$goods_row[partName2]?>";
optionArr[2] ="<?=$goods_row[partName3]?>";

// ��ٱ��� ���
function addCart(Channel)
{
	var form=document.goodsForm;
	var Cnt	= form.cnt.value;
	var bLimit = <?=$goods_row[bLimit]?>;   //���  ex)1:������  0:������
	var limitCnt =<?=$goods_row[limitCnt]?>;//�������l
	var minbuyCnt =<?=$goods_row[minbuyCnt]?>;// �ּұ��ż��� 
	var maxbuyCnt =<?=$goods_row[maxbuyCnt]?>;// �ִ뱸�ż���
	if(Cnt=="" || Cnt=="0" ||Cnt==0 || !numCheck(Cnt))
	{
		alert("���ż����� �ùٸ��� �ʽ��ϴ�.");
		form.cnt.focus();
	}
	else if(bLimit  && !limitCnt || bLimit==2)
	{
		alert("�˼��մϴ�. ���� ǰ���� ��ǰ�Դϴ�.");
	}
	else if(bLimit	 && limitCnt < Cnt)
	{
		alert("�˼��մϴ�. �������� �����մϴ�.\n\n��� : "+limitCnt);
		form.cnt.focus();
	}
	else if(minbuyCnt!=0 && Cnt<minbuyCnt)
	{
		alert("�� ��ǰ�� �ּұ��ż����� "+minbuyCnt+ " �� �Դϴ�.");
		form.cnt.value = minbuyCnt;
		form.cnt.focus();
	}
	else if(maxbuyCnt!=0 && Cnt>maxbuyCnt)
	{
		alert("�� ��ǰ�� �ִ뱸�ż����� "+maxbuyCnt+ " �� �Դϴ�.");
		form.cnt.value = maxbuyCnt;
		form.cnt.focus();
	}
	else if(optionArr[0].length && form.option1.selectedIndex==0)
	{
		alert(optionArr[0]+"�� ������ �ֽʽÿ�.");
		form.option1.focus();
	}
	else if(optionArr[1].length && form.option2.selectedIndex==0)
	{
		alert(optionArr[1]+"�� ������ �ֽʽÿ�.");
		form.option2.focus();
	}
	else if(optionArr[2].length && form.option3.selectedIndex==0)
	{
		alert(optionArr[2]+"�� ������ �ֽʽÿ�.");
		form.option3.focus();
	}
	else
	{
		form.action="cart_ok.php?act=add&channel="+Channel;
		<? if ($relation_cnt > 0){ ?>
		form.action = form.action + "&gidx_total=" + document.relationForm.gidx_total.value;
		<? } ?>
		form.target="";
		form.submit();
	}
}
//����ǰ����
function addInter()
{
	var form=document.goodsForm;
	if(optionArr[0].length && form.option1.selectedIndex==0)
	{
		alert(optionArr[0]+"�� ������ �ֽʽÿ�.");
		form.option1.focus();
	}
	else if(optionArr[1].length && form.option2.selectedIndex==0)
	{
		alert(optionArr[1]+"�� ������ �ֽʽÿ�.");
		form.option2.focus();
	}
	else if(optionArr[2].length && form.option3.selectedIndex==0)
	{
		alert(optionArr[2]+"�� ������ �ֽʽÿ�.");
		form.option3.focus();
	}
	else
	{
		interwindow = window.open("","intfee","scrollbars=no,width=450,height=225 top=300,left=300");
		form.target="intfee";
		form.action="interest_ok.php?goodsIdx=<?=$goodsIdx?>";
		form.submit();
		interwindow.focus();
	}
}
//��ǰ�� ����
function commentSendit()
{
	<?
	if($GOOD_SHOP_PART=="member")
	{
		?>
	var form=document.commentForm;
	if(form.content.value=="")
	{
		alert("��ǰ���� �Է��� �ֽʽÿ�.");
		form.content.focus();
	}
	else
	{
		form.submit();
	}
	<?
	}
	else
	{
	?>
	alert("�α��� ���ֽʽÿ�.");
	document.detail.submit();
	<?
	}
	?>
}

function commentDel(com_idx)
{
	document.commentForm.del.value = 1;
	document.commentForm.com_idx.value = com_idx;
	document.commentForm.submit();
}

//��ǰ���� ����
function setPrice()
{
	var form=document.goodsForm;
	var new_p = SetComma(form.price);
	form.price2.value = new_p;
	<? if ($relation_cnt > 0){ ?>
	update_price();
	<? } ?>
	// �ɼ� ����� �������� ������ ���� ����.
	/*
	<?
	if ($admin_row[bUsepoint]) 
	{
		// ������ �缳��
		?>
	var point_per = "<?=$admin_row[poUnit]?>";
	<?
		if ($admin_row[poMethod]=="b")//�ۼ�Ʈ�϶��� �����ݺ��� 
		{
			?>
	form.point.value = Math.round(point_per * 0.01 * parseInt(form.price.value));
	<?
		}
	}
	?>
	var new_point = SetComma(form.point);
	form.point2.value = new_point;
	*/
}

// �޸� �ֱ� //////////////////////////////////////////
function SetComma(frm) 
{
	var rtn = "";
	var val = "";
	var j = 0;
	x = frm.value.length;
	for(i=x; i>0; i--) 
	{
		if(frm.value.substring(i,i-1) != ",") 
		{
			val = frm.value.substring(i,i-1)+val;
		}
	}
	x = val.length;
	for(i=x; i>0; i--) 
	{
		if(j%3 == 0 && j!=0) 
		{
			rtn = val.substring(i,i-1)+","+rtn;  
		}
		else 
		{
			rtn = val.substring(i,i-1)+rtn;
		}
		j++;
	}
	return rtn;
}

function changeImageThumb(simg)
{
	document.PicMedium.src = "upload/goods/"+simg;
	return;
}

function relation_select(count)
{
	var form = document.relationForm;
	if (count==1) // ���û�ǰ�� �� 1���϶� 
	{
		if (form.gidx.checked == true)
		{
			form.gidx_total.value = form.gidx.value;
			document.goodsForm.temp_price.value = parseInt(form.price.value);
		}
		else
		{
			form.gidx_total.value = "";
			document.goodsForm.temp_price.value = 0;
		}
	}
	else
	{
		var gidx_array = new Array();
		var gidx_str = "";
		var temp_price = 0;
		for (var i=0; i<count; i++)
		{
			if (form.gidx[i].checked == true)
			{
				gidx_array[i] = form.gidx[i].value;
				temp_price += parseInt(form.price[i].value);
			}
			else
			{
				gidx_array[i] = "";
			}
		}
		document.goodsForm.temp_price.value = temp_price;
		var gidx_str = gidx_array.join("/");
		form.gidx_total.value = gidx_str;
	}
	update_price();
}

function update_price()
{
	document.goodsForm.preview_price.value=parseInt(document.goodsForm.temp_price.value) + parseInt(document.goodsForm.price.value);
	document.goodsForm.preview_price.value=SetComma(document.goodsForm.preview_price);
}

function only_num(str) ////// ���ڿ��� ���ڸ� ����� ����
{
	var tmp = "";
	var num2=str.length;
	for (var i=0; i<num2; i++)
	{
		var chk_str = str.substr(i,1); //���ڸ��� ������
		if (chk_str.match(/[0-9]/i))
		{
			tmp=tmp+str.substr(i,1);
		}
	}
	return tmp;
}
//-->
</SCRIPT>
<?
include "top.php";
?>
<!-- mypage �α��� üũ�� referer�� ����--> 
<form name="detail" method="post" action="login.php"><input type="hidden" name="referer" value="<?= $_SERVER[PHP_SELF]?>?goodsIdx=<?=$goodsIdx?>"></form>
<iframe name="ifrm" width='0' height='0' frameborder='0'></iframe>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php"; ?>
		<td valign="top" bgcolor="#FFFFFF">
			<table width="720" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="2" bgcolor="<?=$subdesign[bc2]?>" rowspan="2"></td>
					<td width="2" bgcolor="<?=$subdesign[bc2]?>" rowspan="2"></td>
					<td width="220" height="30" bgcolor="<?=$subdesign[bc2]?>"><img src="./upload/design/<?=$subdesign[img2]?>"></td>
					<td width="490" height="30" bgcolor="<?=$subdesign[bc2]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc2]?>"> <img src='image/good/icon0.gif'>&nbsp;������ġ : <a href="index.php"><font color="<?=$subdesign[tc2]?>">HOME</font></a><?=$str_category?></font>&nbsp;</div></td>
				</tr>
			</table>
			<table width="720" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td height="310" valign="top">
						<table width="720" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td width="43%" valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
										<tr><?
										if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
										else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img2])) $img_str = $goods_row[img3];
										else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img2])) $img_str = $goods_row[img3];
										else $img_str = $goods_row[img2];
										$info = @getimagesize("./upload/goods/$goods_row[img3]");
										$wSize = $info[0]+250;
										$hSize = $info[1]+120;
										if ($wSize<500) $wSize=600;
										if ($hSize<500) $hSize=600;
										?>
											<td align="center"><a href="javascript:zoom2('<?=$goods_row[idx]?>',<?=$wSize?>,<?=$hSize?>);"><img name="PicMedium" src="upload/goods/<?=$img_str?>" width="<?=$design_goods[goodsListIW1]?>" height="<?=$design_goods[goodsListIH1]?>" border="0"></a></td>
										</tr>
										<tr>
											<td>
												<table bgcolor='E6E6E6' border="0" cellspacing="1" cellpadding="0" align='center'>
													<tr>
														<?
														for ($i=3; $i<=8; $i++)
														{
															if ($i==3) $big_img_str = "img".($i-1);
															else $big_img_str = "img$i";
															if ($goods_row[$big_img_str])
															{
																?>
														<td bgcolor='ffffff'><img src="upload/goods/<?=urlencode($goods_row[$big_img_str])?>" border=0 width=50 height=50 onmouseover="javascript:changeImageThumb('<?=urlencode($goods_row[$big_img_str])?>');"></td><?
															}
														}
														?>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30">
												<table width="200" border="0" cellspacing="0" cellpadding="0" align='center'>
													<tr>
														<td><div align="center"><a href="javascript:zoom2('<?=$goods_row[idx]?>',<?=$wSize?>,<?=$hSize?>);"><img src="image/good/enlarge_btn.gif" border="0"></a></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30">
												<table width="57%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr><?
													if(!empty($pre_goods_idx[0]))
													{
														//������ǰ����
														?>
														<td width="55%"><div align="center"><a href="goods_detail.php?goodsIdx=<?=$pre_goods_idx[0]?>"><img src="image/good/back.gif" border="0"></a></div></td><?
													}
													else
													{
														?>
														<td width="55%"><div align="center"><img src="image/good/back.gif"></div></td><?
													}
													if(!empty($next_goods_idx[0]))
													{
														//������ǰ����
														?>
														<td width="45%"><a href="goods_detail.php?goodsIdx=<?=$next_goods_idx[0]?>"><img src="image/good/front.gif"  border="0"></a></td><?
													}
													else
													{
														?>
														<td width="45%"><img src="image/good/front.gif"></td><?
													}
													?>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
								<td width="1"></td>
								<td valign="top"><br>
									<table width="380" border="0" cellspacing="3" cellpadding="0" align="center" bgcolor='e1e1e1'>
										<tr>
											<td bgcolor='ffffff'>
												<form name="goodsForm" method="post">
												<input type="hidden" name="goodsIdx" value="<?=$goodsIdx?>"><!-- ��ǰ idx -->
												<input type="hidden" name="optionName1" value="<?=$goods_row[partName1]?>"><!-- ��ǰ idx -->
												<input type="hidden" name="optionName2" value="<?=$goods_row[partName2]?>"><!-- ��ǰ idx -->
												<input type="hidden" name="optionName3" value="<?=$goods_row[partName3]?>"><!-- ��ǰ idx -->
												<input type="hidden" name="temp_price" value="0"><!-- ���û�ǰ �ӽð��� -->
												<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td colspan="3"><?
														//�̹������
														if ($admin_row[bNew])  $bNew = limitday($goods_row[writeday],$admin_row[new_day]);
														if($goods_row[bHit]) $view_bHit ="<img src='./upload/goods_hit_img'>"; else $view_bHit="";
														if($goods_row[bEtc]) $view_bEtc ="<img src='./upload/goods_etc_img' >"; else $view_bEtc="";
														?>
															<table width="100%" border="0" cellspacing="0" cellpadding="0" height="30" align="center">
																<tr>
																	<td height="40" bgcolor="#f4f4f4" style="line-height:20px" style='padding:0 0 0 10'><font color="#000000" size="3"><b><?=$goods_row[name]?></b></font> <?=$view_bHit?> <?=$bNew?> <?=$view_bEtc?></td>
																</tr>
																<tr>
																	<td height="30" style='padding:0 0 0 3'>&nbsp;<img src="image/notice_icon.gif"> <font color="#464646">�ǸŰ��� &nbsp;&nbsp;&nbsp;</font> <input class="nonbox" type="hidden" size="18" name="price" value="<?=$gprice->Price();?>"><input class="nonbox" type="text" size="12" name="price2" readonly style="color:red;text-align:right;" value="<?=$gprice->PutPrice();?>"> ��&nbsp;&nbsp;<?
																	//////////������ ��ǰ�϶� �̹���ǥ��////
																	if ($goods_row[size]=="N")
																	{
																		?><img src="image/icon/free_delivery.gif"><?
																	}
																	?></td>
																</tr><?
																if ($relation_cnt > 0)
																{
																	?>
																<tr>
																	<td height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646">���û�ǰ ���԰�</font><input size="8" class="nonbox" type="text" name="preview_price"  style="color:red;text-align:right;font-weight:700;" value="<?=$gprice->PutPrice();?>"> �� <!-- ���û�ǰ ���� �� �ǸŰ� ���� �̸������� --></td>
																</tr><?
																}
																?>
															</table>
														</td>
													</tr>
													<tr>
														<td bgcolor="d7d7d7" height="1" colspan="3"></td>
													</tr><?
													for($i=1;$i<=3;$i++)
													{
														$partName	="partName$i";//�ɼǸ�
														$strPart	="strPart$i"; //�ɼ� ����
														if(!empty( $goods_row[$partName] ))
														{
															$strArr = explode("����",$goods_row[$strPart]);
															?>
													<tr>
														<td colspan="3">
															<table width="370" border="0" cellspacing="0" cellpadding="0" height="30" align="center">
																<tr>
																	<td width="110" height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646"><?=$goods_row[$partName]?></font></td>
																	<td width='1' bgcolor='e1e1e1'></td>
																	<td height="30" style='padding:0 0 0 10'><select name="option<?=$i?>"><option value="0"><?=$goods_row[$partName]?></option><?
																	for($j=0;$j<count($strArr);$j++)
																	{
																		?><option value="<?=$strArr[$j]?>"><?=$strArr[$j]?></option><?
																	}
																	?></select></td>
																</tr>
															</table>
														</td>
													</tr><?
														}
													}
													?>
													<tr>
														<td colspan="3">
															<table width="370" border="0" cellspacing="0" cellpadding="0" height="30" align="center"><?
															if($goods_row[bOldPrice])
															{
																//���߰�ǥ��
																?>
																<tr>
																	<td width="110" height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646">���߰�</font></td>
																	<td width='1' bgcolor='e1e1e1'></td>
																	<td height="30" style='padding:0 0 0 10'> <strike><?=PriceFormat($goods_row[oldPrice])?>��</strike> <?
																	if ($goods_row[bSaleper] && $goods_row[sale])
																	{
																		echo "<font color=#D83232>($goods_row[sale]%)</font>"; 
																	}
																	?></td>
																</tr><?
															}
															if($goods_row[model])
															{
																//������ǥ��
																?>
																<tr>
																	<td width="110" height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646">�𵨸�</font></td>
																	<td width='1' bgcolor='e1e1e1'></td>
																	<td height="30" style='padding:0 0 0 10'> <?=$goods_row[model]?></td>
																</tr><?
															}
															if($goods_row[bCompany])
															{
																//������ǥ��
																?>
																<tr>
																	<td width="110" height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646">������</font></td>
																	<td width='1' bgcolor='e1e1e1'></td>
																	<td height="30" style='padding:0 0 0 10'> <?=$goods_row[company]?></td>
																</tr><?
															}
															if($goods_row[bOrigin])
															{
																//������ǥ��
																?>
																<tr>
																	<td width="110" height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646">������</font></td>
																	<td width='1' bgcolor='e1e1e1'></td>
																	<td height="30" style='padding:0 0 0 10'> <?=$goods_row[origin]?></td>
																</tr><?
															}
															if($admin_row[bUsepoint])
															{
																?>
																<tr>
																	<td width="110" height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646">���� ������</font></td>
																	<td width='1' bgcolor='e1e1e1'></td>
																	<td height="30" style='padding:0 0 0 10'> <input type="hidden" name="point" readonly style="text-align:right;" value="<?=$gprice->PutPoint();?>"><input class="nonbox" type="text" size="8" name="point2" readonly style="text-align:right;" value="<?=$gprice->PutPoint2();?>"> ��</td>
																</tr><?
															}
															else
															{
																?>
																<input type="hidden" name="point" value="0"><input type="hidden" name="point2" value="0"><?
															}
															?>
																<tr>
																	<td width="110" height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646">���</font></td>
																	<td width='1' bgcolor='e1e1e1'></td>
																	<td  height="30" style='padding:0 0 0 10'> <?
																	if (($goods_row[bLimit]==1 && !$goods_row[limitCnt]) || $goods_row[bLimit]==2)
																	{
																		if (file_exists("./upload/no_good_img"))
																		{
																			?><img src="./upload/no_good_img" align="absmiddle"><?
																		}
																		else
																		{
																			?><FONT COLOR='#990000'>ǰ��</FONT><?
																		}
																	}
																	else if($goods_row[bLimit]==3)
																	{
																		?><FONT COLOR='#990000'>����</FONT><?
																	}
																	else if($goods_row[bLimit]==4)
																	{
																		?><FONT COLOR='#990000'>����</FONT><?
																	}
																	else
																	{
																		echo "�Ǹ���";
																	}
																	?></td>
																</tr>
																<tr>
																	<td width="110" height="30">&nbsp;<img src="image/notice_icon.gif">&nbsp;<font color="#464646">���ż���</font></td>
																	<td width='1' bgcolor='e1e1e1'></td>
																	<td height="30" style='padding:0 0 0 10'> <?
																	//////////// �ּұ��ż��� ������ �⺻���� ���������� //////////// 
																	if ($goods_row[minbuyCnt]) $buyCnt = $goods_row[minbuyCnt];
																	else $buyCnt = 1;
																	?><input type="text" name="cnt" size="3" <?=__ONLY_NUM?> value="<?=$buyCnt?>" class='box_s'> <font class='stext'>EA</font> &nbsp;<?=$limitCnt?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td bgcolor="d7d7d7" height="1" colspan="3"></td>
													</tr>
													<tr>
														<td  colspan='3' height='10'></td>
													</tr>
													<tr>
														<td colspan="3" align=center> <a href="#;" onclick="addCart('cart');"><img src="image/work/cart_btn1.gif" border="0"></a> <a href="javascript:addCart('direct');"><img src="image/work/order_btn.gif" border="0"></a>&nbsp;&nbsp;<?
														if($_SESSION[GOOD_SHOP_PART]=="member")
														{
															?><a href="#;" onclick="addInter();"><img src="image/work/inter_btn.gif"  border="0"></a><?
														}
														?></td>
													</tr>
												</table>
												</form><!-- //goodsForm -->
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="3" height="25" bgcolor="ffffff"></td>
							</tr>
						</table>
					</td>
				</tr><?
				if($relation_cnt > 0)
				{
					?>
				<tr>
					<td>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" style="table-layout:fixed;">
							<tr>
								<td rowspan='3' width='66' bgcolor='ebeaea' valign='top'><img src="image/good/good_info.gif"></td>
								<td><img src='image/good/good_info_t.gif'></td>
							</tr>
							<tr>
								<td background='image/good/good_info_bg.gif' align='center'>
									<form name="relationForm" method="post">
									<input type="hidden" name="gidx_total" value=""> <!-- ���û�ǰ idx ���� -->
									<table width="600" border=0 cellspacing="0" cellpadding="0"><?
											$for_cnt = 1;
											if(!empty($relation[0]))
											{
												for ($j=0; $j<count($relation); $j++)
												{
													$row = $MySQL->fetch_array("select * from goods where idx=$relation[$j] and bLimit<3 limit 1");
													if (empty($GD_SET) && $row[img_onetoall]) $img_str = $row[img3];
													else if ($GD_SET && $row[img_onetoall] && empty($row[img1])) $img_str = $row[img3];
													else if ($GD_SET && empty($row[img_onetoall]) && empty($row[img1])) $img_str = $row[img3];
													else $img_str = $row[img1];
													if ($row[idx])
													{
														if ($admin_row[bNew])
														{
															$bNew = limitday($row[writeday],$admin_row[new_day]);
															/////������ �Ⱓ���� ������ new ��ũ�� ���� ������ ���Ƿ� ��ǰ�������� ����ũ ����///// 
															if (empty($bNew) && $row[bNew]) $bNew = "<img src='upload/goods_new_img'>";
														}
														if($row[bHit]) $bHit ="<img src='upload/goods_hit_img'>";		//��Ʈ �̹���
														else			$bHit ="";
														if($row[bEtc]) $bEtc ="<img src='upload/goods_etc_img' >";	//��Ÿ �̹���
														else			$bEtc ="";
														$rel_gprice = new CGoodsPrice($row[idx]);
														if(($for_cnt%5) == 1)
														{

															echo "\n										<tr>\n";
															if($for_cnt != 1)
															{
																echo "\n										<tr>\n";
																echo "\n										<td colspan='5' bgcolor='e1e1e1' height='1'></td>\n";
																echo "\n										</tr>\n";
															}
														}
														?>
											<td align="center" valign='top'>
												<table width="100" border=0 cellspacing="0" cellpadding="0">
													<input type="hidden" name="price" value="<?=$rel_gprice->Price();?>"><!-- ���û�ǰ �������� -->
													<tr>
														<td width=100 align="center"><a href="javascript:zoom2('<?=$row[idx]?>',750,620);"><img src="upload/goods/<?=$img_str?>" width="70" height="70" border="0"></a></td>
													</tr>
													<tr>
														<td align="center"><input onfocus="this.blur();" type="checkbox" name="gidx" onclick="javascript:relation_select(<?=$relation_cnt?>);" value="<?=$row[idx]?>">�Բ����� </td>
													</tr>
													<tr>
														<td align=center valign=middle style='padding:5 0 0 0'><a href="goods_detail.php?goodsIdx=<?=$row[idx]?>"><font color="<?=$design_goods[gname_color]?>">&nbsp;<?=$row[name]?></font></a><br><?=$bHit?> <?=$bNew?> <?=$bEtc?><br><?
															if ($row[strPart1])
															{
																?>&nbsp;<img src="admin/image/option.gif"><?
															}
															?></td>
													</tr>
													<tr>
														<td align=center><?
															if(false)	//if($row[bOldPrice])
															{
																?><font color='ff4800'><?=PriceFormat($row[oldPrice])?> ��</font><?
																if ($row[bSaleper] && $row[sale])
																{
																	echo "<font color=#D83232>($row[sale]%����)</font>";
																}
																?><br><?
															}
															?><font color="<?=$design_goods[gprice_color]?>"><b><?=$rel_gprice->PutPrice();?>�� </b> </font><br><?
															if (($row[bLimit]==1 && !$row[limitCnt]) || $row[bLimit]==2)
															{
																if (file_exists("./upload/no_good_img"))
																{
																	?><img src="./upload/no_good_img" align="absmiddle"><?
																}
																else
																{
																	?><FONT COLOR='#990000'>ǰ��</FONT><?
																}
															}
															?></td>
													</tr>
												</table>
											</td><?
														if(($for_cnt%5) == 0) echo "\n										</tr>\n";
														$for_cnt++;
													}
												}
												if(1 < $for_cnt)	//���� td�߰�
												{
													for ($j=($for_cnt%5); $j<=5; $j++)
													{
														echo "<td></td>";
													}
													echo "\n										</tr>\n";
												}
											}
											?>
									</table></form>
								</td>
							</tr>
							<tr>
								<td><img src='image/good/good_info_b.gif'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="15"></td>
				</tr><?
				}
				?>
				<tr>
					<td><a name="01" id="01"></a>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" style="table-layout:fixed;">
							<tr>
								<td><img src="image/good/tit_detail01.gif" usemap="#Map1"></td>
							</tr>
						</table>
						<map name="Map1" id="Map1"><area shape="rect" coords="198,5,317,39" href="#02"><area shape="rect" coords="326,6,445,39" href="#03"><area shape="rect" coords="455,7,572,40" href="#04"></map>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" style="table-layout:fixed;">
							<tr>
								<td style="word-break:break-all" background='image/good/tit_detail_bg.gif'>
									<table width="680" border="0" cellspacing="0" cellpadding="10" align="center">
										<tr>
											<td style="word-break:break-all"><?=$content?><br></td>
										</tr><?
										for ($i=1; $i<5; $i++)
										{
											$str = "detailimg$i"; 
											if ($goods_row[$str]) 
											{
												?>
										<tr>
											<td><img src="upload/goods/<?=$goods_row[$str]?>"></td>
										</tr>
										<tr>
											<td height=5></td>
										</tr><?
											}
										}
										?>
									</table>
								</td>
							</tr>
							<tr>
								<td><img src='image/good/tit_detail_b.gif'></td>
							</tr>
						</table><br>
					</td>
				</tr><?
				if ($xTrans)
				{
					?>
				<tr valign="top">
					<td>
						<a name="02" id="02"></a>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" style="table-layout:fixed;">
							<tr>
								<td><img src="image/good/tit_detail02.gif" usemap="#Map2"></td>
							</tr>
						</table>
						<map name="Map2" id="Map2"><area shape="rect" coords="9,2,134,38" href="#01"><area shape="rect" coords="323,4,442,38" href="#03"><area shape="rect" coords="447,5,569,36" href="#04"></map>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/good/tit_detail_bg.gif'>
									<table width="680" border="0" cellspacing="0" cellpadding="10" align="center">
										<tr>
											<td><?
											if ($goods_row[trans_content])
											{
												echo nl2br($goods_row[trans_content]);
											}
											else
											{
												echo $xTrans;
											}
											?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td><img src='image/good/tit_detail_b.gif'></td>
							</tr>
						</table><br>
					</td>
				</tr><?
				}
				?>
				<!-- ��ǰ���� --><?
				if ($admin_row[bAskboard]=="y")
				{
					?>
				<tr>
					<td>
						<a name="03" id="03"></a>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" style="table-layout:fixed;">
							<tr>
								<td><img src="image/good/tit_detail03.gif" usemap="#Map3"></td>
							</tr>
						</table>
						<map name="Map3" id="Map3"><area shape="rect" coords="13,2,132,38" href="#01"><area shape="rect" coords="141,4,262,39" href="#02"><area shape="rect" coords="468,4,590,39" href="#04"></map>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/good/tit_detail_bg.gif'><div align='center'><iframe src="goods_board.php?gidx=<?=$goods_row[idx]?>" frameborder=0 width=670 height=250 scrolling=auto></iframe></div></td>
							</tr>
							<tr>
								<td><img src='image/good/tit_detail_b.gif'></td>
							</tr>
						</table><br>
					</td>
				</tr><?
				}
				?><!-- ��ǰ�� ���� --><?
				if($admin_row[bGoodsapp]=="y")
				{
					?>
				<tr>
					<td>
						<a name="04" id="04"></a>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" style="table-layout:fixed;">
							<tr>
								<td><img src="image/good/tit_detail04.gif" usemap="#Map4"></td>
							</tr>
						</table>
						<map name="Map4" id="Map4"><area shape="rect" coords="11,3,133,38" href="#01"><area shape="rect" coords="139,0,262,39" href="#02"><area shape="rect" coords="272,6,393,39" href="#03"></map>
						<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" style="table-layout:fixed;">
							<tr>
								<td background='image/good/tit_detail_bg.gif'>
									<form name="commentForm" method="post" action="goods_comment_ok.php">
									<input type="hidden" name="goodsIdx" value="<?=$goodsIdx?>">
									<input type="hidden" name="name" value="<?=$goods_row[name]?>">
									<input type="hidden" name="del" value="">
									<input type="hidden" name="com_idx" value="">
									<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td><div align='center'><textarea class='box1' name="content" cols="100" rows="5"></textarea></div></td>
										</tr>
										<tr>
											<td height="2">&nbsp;</td>
										</tr>
										<tr>
											<td align="right" valign="middle"><a href="javascript:commentSendit();"><img src="image/good/good_write.gif" border="0"></a>&nbsp;&nbsp;&nbsp;</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td><!-- ��ǰ�� ��� ���� --><?
											$data=Decode64($data);
											$pagecnt=$data[pagecnt];
											$offset=$data[offset];
											$numresults=$MySQL->query("select idx from goods_comment where gidx=$goodsIdx");
											$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
											$LIMIT		=5;								//�������� �� ��
											$PAGEBLOCK	=10;								//���� ������ ��
											if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
											if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��
											$com_qry = "select * from goods_comment where gidx=$goodsIdx order by idx desc limit $offset,$LIMIT";
											$com_result=$MySQL->query($com_qry);
											while($com_row=mysql_fetch_array($com_result))
											{
												$content	= str_replace("\n","<br>", htmlspecialchars($com_row[content])); //�۳���
												?>
												<table width="650" border="0" cellspacing="0" cellpadding="0" align='center'>
													<tr>
														<td height='1' bgcolor='E1E1E1' colspan='2'></td>
													</tr>
													<tr>
														<td bgcolor="f4f4f4" height="20" colspan='2'> <font color="#0D78C8">&nbsp;<img src='image/notice_icon.gif'> <b><?=$com_row[userid]?></b></font> ��</td>
													</tr>
													<tr>
														<td height='1' bgcolor='E1E1E1' colspan='2'></td>
													</tr>
													<tr>
														<td bgcolor="fafafa" height='35'> <p><?=$content?></td>
														<td width=55 bgcolor="fafafa"><?
														if ($com_row[userid]==$GOOD_SHOP_USERID)
														{
															?><a href="#;" onclick="commentDel('<?=$com_row[idx]?>')"><img src="image/icon/btn_delete0.gif"></a><?
														}
														?></td>
													</tr>
												</table><?
											}
											?>
											<!-- ��ǰ�� ��� �� --><?
											$Obj=new CList("goods_detail.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,"","","goodsIdx=$goodsIdx");
											?></td>
										</tr>
										<tr valign="bottom">
											<td colspan="2" height="30" align="center"><?if($numrows){?><?$Obj->putList(true,"<img src='image/board/btn_prev.gif'>","<img src='image/board/btn_next.gif'>");//�������� ����Ʈ?><?}?></td>
										</tr>
									</table></form><!-- commentForm -->
								</td>
							</tr><?
							}
							?>
							<!-- ��ǰ�� �� -->
							<tr>
								<td><img src='image/good/tit_detail_b.gif'></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php"; ?>
</div>
</body>
</html>