<?
// �ҽ��������
// 20060720-1 �����߰� �輺ȣ : ��ǰ�ɼ� ���̾ƿ�����
include "head.php";
include "linkstr_goods.php";

$getArrayOS = explode(";", $_SERVER[HTTP_USER_AGENT]);
$BROWGER = trim($getArrayOS[1]);
$OS = trim($getArrayOS[2]);
if(preg_match("/Windows/", $OS) && preg_match("/MSIE/", $BROWGER))
{
	$Os_Check=1;
	$Use_Check="";
}
else
{
	$Os_Check=0;
	$Use_Check="disabled";
}

if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=DBarray("select *from admin limit 0,1"); //������ ���� �迭
}

$dataArr= Decode64($data);
$goods_row = $MySQL->fetch_array("select * from goods where idx=$dataArr[idx] limit 1");  //��ǰ����

$category_row = $MySQL->fetch_array("select *from category where code='$goods_row[category]' limit 1");
$str_category = $category_row[name];

// ī�װ� ���� ��
if($goods_row[bOldPrice])
{
	$true_oldPrice		="checked";
	$false_oldPrice		="";
}
else
{
	$true_oldPrice		="";
	$false_oldPrice		="checked";
}

//����/�Ǹſ����
if($goods_row[bCompany])
{
	$true_bCompany		="checked";
	$false_bCompany		="";
}
else
{
	$true_bCompany		="";
	$false_bCompany		="checked";
}

//������
if($goods_row[bOrigin])
{
	$true_bOrigin		="checked";
	$false_bOrigin		="";
}
else
{
	$true_bOrigin		="";
	$false_bOrigin		="checked";
}

//�̹������ ����
if($goods_row[bHit])	$bHit = "checked";
else					$bHit = "";
if($goods_row[bNew])	$bNew = "checked";
else					$bNew = "";
if($goods_row[bEtc])	$bEtc = "checked";
else					$bEtc = "";

$wSize = array();
$hSize = array();
for ($i=1; $i<=8; $i++)
{
	$str = "img".$i;
	if ($goods_row[$str]) // �ش� �̹����� �����ϸ� 
	{
		$info = @getimagesize("../upload/goods/$goods_row[$str]");
		$wSize[$i] = $info[0];
		$hSize[$i] = $info[1];
	}
}
$content = $goods_row[content];
$trans_content = $goods_row[trans_content];
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//���߰� ��� Ȱ��/��Ȱ��
function showOldprice()
{
	var form= document.goodsForm;
	if(form.bOldPrice[0].checked)
	{
		showObject(form.oldPrice,true);
		showObject(form.sale,true);
	}
	else
	{
		showObject(form.oldPrice,false);
		showObject(form.sale,false);
	}
}

//������ ��� Ȱ��/��Ȱ��
function showCompany()
{
	var form= document.goodsForm;
	if(form.bCompany[0].checked) showObject(form.company,true);
	else showObject(form.company,false);
}

//������ ��� Ȱ��/��Ȱ��
function showOrigin()
{
	var form= document.goodsForm;
	if(form.bOrigin[0].checked) showObject(form.origin,true);
	else showObject(form.origin,false);
}

//������ ��� Ȱ��/��Ȱ��
function showLimit()
{
	var form= document.goodsForm;
	if(form.bLimit[0].checked) showObject(form.limitCnt,true);
	else showObject(form.limitCnt,false);
}

//Ȱ��/��Ȱ�� �ʱ�ȭ
function showInit()
{
	showOldprice();		//���߰� ��� Ȱ��/��Ȱ��	
	showCompany();		//������ ��� Ȱ��/��Ȱ��
	showOrigin();		//������ ��� Ȱ��/��Ȱ��
	showLimit();		//������ ��� Ȱ��/��Ȱ��
	var form=document.goodsForm;
	<? if ($goods_row[img_onetoall]==1) { ?>
	form.img_onetoall.value = 1;
	showObject(form.img1,false);
	showObject(form.img2,false);
	<? }else { ?>
	form.img_onetoall.value = 0;
	showObject(form.img1,true);
	showObject(form.img2,true);
	<? } ?>
}
function delAtt(partName,strPart)
{
	partName.value = "";
	strPart.value = "";
}
//��ǰ�ɼ� ����
function addAtt(Obj,Index)
{
	var form=document.goodsForm;
	if(Obj.value=="")
	{
		alert("�з����� �Է��� �ֽʽÿ�.");
		Obj.focus();
	}
	else
	{
		window.open("goods_attribute.php?Val="+Obj.value+"&Index="+Index,"","scrollbars=yes,left=50,top=100,width=420,height=350");
	}
}
//������ ����
function setOldprice()
{
	var form=document.goodsForm;
	var goodsPrice = form.price.value;
	if(hanCheck(goodsPrice))
	{
		alert("��ǰ ������ �ùٸ��� �ʽ��ϴ�.");
		form.price.focus();
	}
	else
	{
		<? if($admin_row[poMethod]=="t"){?>
		form.point.value = <?=$admin_row[poTotal]?>;
		<?}else{?>
		form.point.value = Math.round(goodsPrice *<?=$admin_row[poUnit]?> /100);
		<?}?>
	}
}

//��ǰ ���
function goodsSendit()
{
	var form=document.goodsForm;
	if(form.bHtml[2].checked==true)
	{
		<?
		if(!$Os_Check)
		{
			?>
		alert('�������͸� �������� �ʽ��ϴ�.');<?
		}
		?>
		cdiv.gogo();
	}
	form.action = "goods_edit_ok.php";
	form.target="";
	if(form.name.value=="")
	{
		alert("��ǰ���� �Է��� �ֽʽÿ�.");
		form.name.focus();
	}
	else if(form.price.value=="")
	{
		alert("��ǰ ������ �Է��� �ֽʽÿ�.");
		form.price.focus();
	}
	else if(hanCheck(form.price.value))
	{
		alert("��ǰ ������ �ùٸ��� �ʽ��ϴ�.");
		form.price.focus();
	}
	else if(form.bOldPrice[0].checked && form.oldPrice.value=="")
	{
		alert("���߰��� �Է��� �ֽʽÿ�.");
		form.oldPrice.focus();
	}
	else if(form.bCompany[0].checked && form.company.value=="")
	{
		alert("����/�Ǹſ��� �Է��� �ֽʽÿ�.");
		form.company.focus();
	}
	else if(form.bOrigin[0].checked && form.origin.value=="")
	{
		alert("�������� �Է��� �ֽʽÿ�.");
		form.origin.focus();
	}
	else if(form.bLimit[0].checked && form.limitCnt.value=="")
	{
		alert("�������� �Է��� �ֽʽÿ�.");
		form.limitCnt.focus();
	}
	else if(form.partName1.value!="" &&form.strPart1.value=="")
	{
		alert("�ɼ��� �Է��� �ֽʽÿ�.");
		addAtt(form.partName1,1);
	}
	else if(form.partName2.value!="" &&form.strPart2.value=="")
	{
		alert("�ɼ��� �Է��� �ֽʽÿ�.");
		addAtt(form.partName2,2);
	}
	else if(form.partName3.value!="" &&form.strPart3.value=="")
	{
		alert("�ɼ��� �Է��� �ֽʽÿ�.");
		addAtt(form.partName3,3);
	}
	else
	{
		form.str_oldPrice.value		=form.oldPrice.value;	//���߰�
		form.str_company.value		=form.company.value;	//������
		form.str_origin.value		=form.origin.value;		//������
		form.str_limitCnt.value		=form.limitCnt.value;	//������
		form.submit();//����
	}
}

// ���û�ǰ ã�� 
function addPosition(idx)
{
	window.open("goods_relation.php?idx="+idx,"","scrollbars=yes,width=500,height=750,top=20,left=20");
}

function image_multi()
{
	var form=document.goodsForm; 
	if (form.img_onetoall.value == 0)
	{
		showObject(form.img1,false);
		showObject(form.img2,false);
		form.img_onetoall.value = 1;
	}
	else if (form.img_onetoall.value == 1)
	{
		showObject(form.img1,true);
		showObject(form.img2,true);
		form.img_onetoall.value = 0;
	}
}
///////////���߰� �ۼ�Ʈ ��� 
function sale_per()
{
	var form = document.goodsForm;
	var oPrice = form.oldPrice.value;
	var Price = form.price.value;
	if(!oPrice || oPrice==0)
	{
		var sale_per = "";
	}
	else
	{
		var sale_per = Math.round(((oPrice-Price) / oPrice) * 100);
	}
	form.sale.value = sale_per;
}

function code_check() // ��ǰ�ڵ� ������ �ߺ��˻� 
{
	var form=document.goodsForm;
	var gcode = form.goodcode.value;
	form.action="goods_code_check.php?gcode="+gcode;
	form.target = "ifrm";
	form.submit();
}

function code_edit() // ��ǰ�ڵ� ����
{
	var form=document.goodsForm;
	var gcode = form.goodcode.value;
	location.href="goods_edit_ok.php?codeedit=1&data=<?=$data?>&code="+gcode;
}

function list_edit(obj)
{
	<? if ($admin_row[beditprice_warn]=="y"){ ?>
	var last_price = obj.lastprice.value;
	var diff_price = obj.price.value - last_price;
	var warn_price = <?=$admin_row[editprice_warn]?>;
	if (diff_price<0) diff_price = diff_price * (-1);
	if (diff_price >= warn_price)
	{
		if (confirm("�������� "+warn_price+"�� �̻� ���̰� ���ϴ�. �����Ͻðڽ��ϱ�?"))
		{
			goodsSendit();
		}
	}
	else
	{
		goodsSendit();
	}
	<? }else { ?>
	goodsSendit();
	<? } ?>
}
//-->
</SCRIPT>
<body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="javascript:showInit();">
<? include "top_menu.php"; ?>
<iframe name="ifrm" width=0 height=0 frameborder=0></iframe>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "goods";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=DBarray("select *from admin limit 0,1"); //������ ���� �迭
	}
	?>
		<td width="85%" valign="top">
			<table width="100%" height="500" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/good_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ��ǰ��� ���� ���� ���� �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/goods_data_tit2.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height='10'></td>
				</tr>
				<tr>
					<td valign="top">
						<form name="goodsForm" method="post" action="goods_edit_ok.php" enctype="multipart/form-data" >
						<input type="hidden" name="code" value="<?=$goods_row[category]?>"><!-- ī�װ� �ڵ� -->
						<input type="hidden" name="sort" value="<?=$sort?>"><!-- ���Ĺ�� ex)asc:��������  desc:�������� -->
						<input type="hidden" name="sortStr" value="<?=$sortStr?>"><!-- ���ı��� ex)name:�̸�  price:���� -->
						<input type="hidden" name="view_position" value="<?=$position?>"><!-- ��ġ -->
						<input type="hidden" name="data" value="<?=$data?>"><!-- ��ǰ���� -->
						<input type="hidden" name="returnPage" value="<?=$returnPage?>"><!-- ������ϸ� -->
						<!-- ���� disabled ������ �缳�� -->
						<input type="hidden" name="str_oldPrice"><!-- ���߰� -->
						<input type="hidden" name="str_company"><!-- ������ -->
						<input type="hidden" name="str_origin"><!-- ������ -->
						<input type="hidden" name="str_limitCnt"><!-- ������ -->
						<input type="hidden" value="<?=$LINK_STR?>" name="LINK_STR"><!-- ��ũ���� -->
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr valign="middle">
								<td colspan="4" height="50" bgcolor="#FAFAFA">
									<table width="200" border="0" align="center">
										<tr>
											<td> <div align="center"><a href="javascript:list_edit(document.goodsForm);"><img src="image/entry_btn1.gif" width="40" height="17" border="0"></a></div></td>
											<td> <div align="center"><a href="javascript:goodsDel('goods_edit_ok.php?del=1');"><img src="image/delete_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td> <div align="center"><a href="javascript:goUrl('total_goods_list.php?<?=$LINK_STR?>');"><img src="image/list_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<table width="300" cellspacing="2" cellpadding="2" align="left" border='0'>
										<tr align="center">
											<td width=50% bgcolor="#CBCCF8">��ǰ���� ��ϳ�¥</td>
											<td><b><?=$goods_row[writeday]?></b></td>
										</tr>
										<tr align="center">
											<td width=50% bgcolor="#CBCCF8">��ǰ���� �ֱټ�����¥</td>
											<td><b><?=$goods_row[editday]?></b></td>
										</tr>
										<tr align="center" >
											<td width=50% bgcolor="#CBCCF8">�ǸŻ���Ʈ �̸�����</td>
											<td><a href="http://<?=$admin_row[shopUrl]?>/goods_detail.php?goodsIdx=<?=$goods_row[idx]?>" target="_blank"><u><b>�̸�����</b></u></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif" bgcolor="#F5F5F5"></td>
							</tr>
							<tr>
								<td colspan="4" height="10"></td>
							</tr>
							<tr valign="middle">
								<td width="150" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ ī�װ�</div></td>
								<td height="25" colspan="3">&nbsp;&nbsp; <B><?=$str_category?></B> </td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� �� �� ��</b></font></td>
							<tr>
							<tr>
								<td width="137" height="61" bgcolor="#FAFAFA" rowspan="3">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���߰�</td>
								<td height="25" colspan="3">
									<table width="250" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="12"> <div align="center"> </div></td>
											<td width="5%"> <input class="radio" type="radio" name="bOldPrice" value="1" onclick="javascript:showOldprice();" <?=$true_oldPrice?> <?=$price_disabled?>></td>
											<td width="30%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input class="radio" type="radio" name="bOldPrice" value="0" onclick="javascript:showOldprice();" <?=$false_oldPrice?> <?=$price_disabled?>></div></td>
											<td width="50%"> <div align="left">������� ����</div></td>
										</tr>
									</table>&nbsp;&nbsp;<font class="help">�� �ǸŰ��� ǥ������ <strike>5,000</strike> �̷������� ���߰��� ǥ��˴ϴ�.</font>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif" colspan="3"></td>
							</tr>
							<tr>
								<td height="25" colspan="3">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="20">&nbsp;</td>
											<td width="70" height="20" bgcolor="#F5F5F5"> <div align="center"><font color="#0099CC">�� �� ��</font></div></td>
											<td width="300" height="20"> &nbsp;&nbsp; <input class="box" name="oldPrice" type="text" id="eday" size="15" <?=__ONLY_NUM?> value="<?=$goods_row[oldPrice]?>" onBlur="javascript:sale_per();" <?=$price_readonly?>>&nbsp;&nbsp;<input name=sale type=text class="box" value="<?=$goods_row[sale]?>" size=2 <?=$price_readonly?>>% <font class="help">&nbsp;�� ���߰����� ������ </font>&nbsp;&nbsp;<input type="checkbox" name="bSaleper" value="1" <? if ($goods_row[bSaleper]) echo "checked";?> <?=$price_disabled?>><font class="help">�ػ����ȭ�鿡 ���η�ǥ�� </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<!-- �Ϲݰ��� -->
							<tr>
								<td width="137" height="25" bgcolor="#E1DEFE">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">�ǸŰ�</FONT></td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <input class="box" name="price" type="text" id="eday" size="15" <?=__ONLY_NUM?> value="<?=$goods_row[price]?>" <? if ($admin_row[bUsepoint]){ ?> onblur="setOldprice()" <?}?>></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#E1DEFE">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">������</FONT></td>
								<td height="25" colspan="3"><div align="left"><FONT COLOR="#990000">&nbsp;&nbsp;&nbsp;<?=PriceFormat($goods_row[lastprice])?></FONT>&nbsp;��&nbsp;</div> <input type="hidden" name="lastprice" value="<?=$goods_row[lastprice]?>"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr  id="idprice1">
								<td width="137" height="25" bgcolor="#E1DEFE">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <input class="box" name="point" type="text" id="eday" size="15" <?=__ONLY_NUM?>  value="<?=$goods_row[point]?>" ></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����</td>
								<td height="25" colspan="3">
									<table>
										<tr>
											<td>&nbsp;&nbsp;<input class="box" name="margin" value="<?=$goods_row[margin]?>" size='3' <?=__ONLY_NUM?>> %</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���ް�</td>
								<td height="25" colspan="3">
									<table>
										<tr>
											<td>&nbsp; <input class="box" name="supplyprice" type="text" id="eday" size="15" <?=__ONLY_NUM?> value="<?=$goods_row[supplyprice]?>"> �� </td>
											<td><font class="help">�� ��ǰ�� ���ް� (���� ȭ������� ���� �ʽ��ϴ�.)</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="4" height="10">&nbsp;</td>
							</tr>
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� �� �� ��</b></font></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">��ǰ�ڵ�</FONT></div></td>
								<td height="25" colspan="3">&nbsp;&nbsp; <FONT  COLOR="#6600FF"><input class="box" name="goodcode" type="text" id="eday" size="20" value="<?=$goods_row[code]?>">&nbsp;<a href="javascript:code_check();"><img src="image/jungbok.gif" border=0 ></a>&nbsp;<a href="javascript:code_edit();"><img src="image/edit_btn.gif" border=0 ></a> &nbsp;<font class="help">�� ��ǰ�ڵ带 �ٸ������� �����Ҷ� <b>�ߺ��˻� Ŭ��</b></font></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">��ǰ��</FONT></td>
								<td height="25" colspan="3">&nbsp;&nbsp; <input class="box" name="name" type="text" id="eday" size="60" value="<?=htmlspecialchars($goods_row[name])?>"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �𵨸�</td>
								<td height="25" colspan="3">&nbsp;&nbsp; <input class="box" name="model" type="text" id="eday" size="60" value="<?=htmlspecialchars($goods_row[model])?>"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �˻� Ű����</td>
								<td height="25" colspan="3">&nbsp;&nbsp; <textarea class="box" name="meta_str" cols="60" rows="5"><?=$goods_row[meta_str]?></textarea></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="61" bgcolor="#FAFAFA" rowspan="3">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����/�Ǹſ�</td>
								<td height="25" colspan="3">
									<table width="250" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="12"> <div align="center"> </div></td>
											<td width="5%"> <input class="radio" type="radio" name="bCompany" value="1" onclick="javascript:showCompany();" <?=$true_bCompany?>></td>
											<td width="30%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input class="radio" type="radio" name="bCompany" value="0" onclick="javascript:showCompany();" <?=$false_bCompany?>></div></td>
											<td width="50%"> <div align="left">������� ����</div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif" colspan="3"></td>
							</tr>
							<tr>
								<td height="25" colspan="3">
									<table width="73%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="20">&nbsp;</td>
											<td width="70" height="20" bgcolor="#F5F5F5"> <div align="center"><font color="#0099CC">����/�Ǹſ�</font></div></td>
											<td width="172" height="20"> &nbsp;&nbsp; <input class="box" name="company" type="text" id="eday" size="25" value="<?=$goods_row[company]?>"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="61" bgcolor="#FAFAFA" rowspan="3">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</td>
								<td height="25" colspan="3">
									<table width="250" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="12"> <div align="center"> </div></td>
											<td width="5%"> <input class="radio" type="radio" name="bOrigin" value="1" onclick="javascript:showOrigin();" <?=$true_bOrigin?>></td>
											<td width="30%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input class="radio" type="radio" name="bOrigin" value="0" onclick="javascript:showOrigin();" <?=$false_bOrigin?>></div></td>
											<td width="50%"> <div align="left">������� ����</div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif" colspan="3"></td>
							</tr>
							<tr>
								<td height="25" colspan="3">
									<table width="73%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="20">&nbsp;</td>
											<td width="70" height="20" bgcolor="#F5F5F5"> <div align="center"><font color="#0099CC">�� �� ��</font></div></td>
											<td width="172" height="20"> &nbsp;&nbsp; <input class="box" name="origin" type="text" id="eday" size="25" value="<?=$goods_row[origin]?>"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr><?
							$bHtml_chk[$goods_row[bHtml]]="checked";
							?>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ �� ����</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <INPUT TYPE="radio" NAME="bHtml" value='0' onclick="document.getElementById('nsText').style.display='block';document.getElementById('nsHtml').style.display='none';document.getElementById('nsEdit').style.display='none';" <?= $bHtml_chk[0]?>>TEXT &nbsp; <INPUT TYPE="radio" NAME="bHtml" value='2' onclick="document.getElementById('nsText').style.display='none';document.getElementById('nsHtml').style.display='block';document.getElementById('nsEdit').style.display='none';" <?= $bHtml_chk[2]?>>HTML &nbsp; <INPUT TYPE="radio" NAME="bHtml" value='1' onclick="document.getElementById('nsText').style.display='none';document.getElementById('nsHtml').style.display='none';document.getElementById('nsEdit').style.display='block';" <?= $Use_Check?> <?= $bHtml_chk[1]?>>��������</td>
							</tr>
							<tr valign="middle">
								<td colspan="4" valign=top align="center" width="600">
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText' style='display:<?=!$goods_row[bHtml]?"block":"none"?>'>
										<tr>
											<td><textarea name="TextContent" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($content)?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml' style='display:<?=$goods_row[bHtml]==2?"block":"none"?>'>
										<tr>
											<td><textarea name="HtmlContent" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($content)?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit' style='display:<?=$goods_row[bHtml]==1?"block":"none"?>'>
										<tr>
											<td width="600"><?
											$form_name = "goodsForm";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="content" cols="90" rows="10"><?=htmlspecialchars($content)?></textarea></td>
										</tr>
									</table><br><br>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���̹��� 1</div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="500" height="26"> <input class="box" type="file" name="detailimg1">&nbsp;&nbsp;<a href="javascript:zoom('../upload/goods/<?=$goods_row[detailimg1]?>','<?=$wdSize[1]?>','<?=$hdSize[1]?>');"><u><?=$goods_row[detailimg1]?></u></a>&nbsp;<a href="goods_edit_ok.php?detailimgdel=1&img_num=1&data=<?=$data?>&returnPage=<?=$returnPage?>"><img src="image/delete_btn.gif" border=0></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���̹��� 2</div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="500" height="26"> <input class="box" type="file" name="detailimg2">&nbsp;&nbsp;<a href="javascript:zoom('../upload/goods/<?=$goods_row[detailimg2]?>','<?=$wdSize[2]?>','<?=$hdSize[2]?>');"><u><?=$goods_row[detailimg2]?></u></a> <a href="goods_edit_ok.php?detailimgdel=1&img_num=2&data=<?=$data?>&returnPage=<?=$returnPage?>"><img src="image/delete_btn.gif" border=0></a>&nbsp;&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���̹��� 3</div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="500" height="26"> <input class="box" type="file" name="detailimg3">&nbsp;&nbsp;<a href="javascript:zoom('../upload/goods/<?=$goods_row[detailimg3]?>','<?=$wdSize[3]?>','<?=$hdSize[3]?>');"><u><?=$goods_row[detailimg3]?></u></a> &nbsp;<a href="goods_edit_ok.php?detailimgdel=1&img_num=3&data=<?=$data?>&returnPage=<?=$returnPage?>"><img src="image/delete_btn.gif" border=0></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���̹��� 4</div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="500" height="26"> <input class="box" type="file" name="detailimg4">&nbsp;&nbsp;<a href="javascript:zoom('../upload/goods/<?=$goods_row[detailimg4]?>','<?=$wdSize[4]?>','<?=$hdSize[4]?>');"><u><?=$goods_row[detailimg4]?></u></a> &nbsp;<a href="goods_edit_ok.php?detailimgdel=1&img_num=4&data=<?=$data?>&returnPage=<?=$returnPage?>"><img src="image/delete_btn.gif" border=0></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� �� �� ��</b></font></td>
							</tr>
							<!-- ��ǰ�ɼ� ���� -->
							<tr valign="middle">
								<td width="137" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ�ɼǻ��<br><font class="help">&nbsp;�ǸŰ���������<br>&nbsp;������ ����</font></div></td>
								<td height="25" width="12"> </td>
								<td style='padding:5 0 5 0;'>
									<table width="480" border="0" cellspacing="1" cellpadding="0" bgcolor='#C2C2C2'>
										<tr>
											<td bgcolor="#EBEBEB" height="25" width="100"> <div align="center"><font color="#424242">�ɼǸ�</font></div></td>
											<td height="25" bgcolor='#FFFFFF' width="380">
												<table width="90%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="70" height="26" style='padding:0 0 0 5;'> <input class="box" name="partName1" type="text" id="eday" size="15" value="<?=$goods_row[partName1]?>"></td>
														<td height="26"><a href="javascript:addAtt(document.goodsForm.partName1,1);"> <img src="image/ok_btn.gif" width="40" height="17" border="0"></a><img src="image/delete_btn.gif" onclick="delAtt(document.goodsForm.partName1,document.goodsForm.strPart1);"><font class="help">��) ����</font></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr valign="middle">
											<td bgcolor="#EBEBEB" height="25" width="100"> <div align="center"><font color="#424242">�ɼ� ���ڿ�</font></div></td>
											<td height="25" bgcolor='#FFFFFF' width="380">&nbsp; <input class="nonbox" name="strPart1" type="text" id="eday" size="50" readonly value="<?=$goods_row[strPart1]?>"><br><font class="help">��) �ɼǿ� ���� ���û��� (����,�Ķ�)</font></td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="2"></td>
										</tr>
									</table>
									<table width="480" border="0" cellspacing="1" cellpadding="0" bgcolor='#C2C2C2'>
										<tr valign="middle">
											<td bgcolor="#EBEBEB" height="25" width="100"> <div align="center"><font color="#424242">�ɼǸ�</font></div></td>
											<td height="25" bgcolor='#FFFFFF' width="380">
												<table width="90%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="100" height="26" style='padding:0 0 0 5;'> <input class="box" name="partName2" type="text" id="eday" size="15" value="<?=$goods_row[partName2]?>"></td>
														<td height="26"><a href="javascript:addAtt(document.goodsForm.partName2,2);"><img src="image/ok_btn.gif" width="40" height="17" border="0"></a><img src="image/delete_btn.gif" onclick="delAtt(document.goodsForm.partName2,document.goodsForm.strPart2);"><font class="help">��) ũ��</font></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr valign="middle">
											<td bgcolor="#EBEBEB" height="25" width="100"> <div align="center"><font color="#424242">�ɼ� ���ڿ�</font></div></td>
											<td height="25" bgcolor='#FFFFFF' width="380">&nbsp; <input class="nonbox" name="strPart2" type="text" id="eday" size="50" readonly value="<?=$goods_row[strPart2]?>"><br><font class="help">��) �ɼǿ� ���� ���û��� (��,��,��)</font></td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="2"></td>
										</tr>
									</table>
									<table width="480" border="0" cellspacing="1" cellpadding="0" bgcolor='#C2C2C2'>
										<tr valign="middle">
											<td bgcolor="#EBEBEB" height="25" width="100"> <div align="center"><font color="#424242">�ɼǸ�</font></div></td>
											<td height="25" bgcolor='#FFFFFF' width="380">
												<table width="90%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="100" height="26" style='padding:0 0 0 5;'> <input class="box" name="partName3" type="text" id="eday" size="15" value="<?=$goods_row[partName3]?>"></td>
														<td height="26"><a href="javascript:addAtt(document.goodsForm.partName3,3);"><img src="image/ok_btn.gif" width="40" height="17" border="0"></a>&nbsp;<img src="image/delete_btn.gif" onclick="delAtt(document.goodsForm.partName3,document.goodsForm.strPart3);"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr valign="middle">
											<td bgcolor="#EBEBEB" height="25" width="100"> <div align="center"><font color="#424242">�ɼ� ���ڿ�</font></div></td>
											<td height="25" bgcolor='#FFFFFF' width="380">&nbsp; <input class="nonbox" name="strPart3" type="text" id="eday" size="50" readonly value="<?=$goods_row[strPart3]?>"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr valign="middle">
								<td height="1" background="image/line_bg1.gif" colspan="3"></td>
							</tr>
							<!-- ��ǰ�ɼ� �� -->
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� �� / �� �� �� ��</b></font></td>
							</tr>
							<tr>
								<td width="137" height="30" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��۱��� ����</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <input name="size" type="checkbox" value="N" <? if ($goods_row[size]=="N") echo "checked";?>>������</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="61" bgcolor="#FAFAFA" rowspan="3">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</td>
								<td height="25" colspan="3">
									<table width="400" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="12"> <div align="center"></div></td>
											<td> <input class="radio" type="radio" name="bLimit" value="1" onclick="javascript:showLimit();" <? if ($goods_row[bLimit]==1) echo "checked";?>>����&nbsp;&nbsp;&nbsp;&nbsp;<input class="radio" type="radio" name="bLimit" value="0" onclick="javascript:showLimit();" <? if ($goods_row[bLimit]==0) echo "checked";?>>������&nbsp;&nbsp;&nbsp;&nbsp;<input class="radio" type="radio" name="bLimit" value="2" <? if ($goods_row[bLimit]==2) echo "checked";?>>ǰ��&nbsp;&nbsp;&nbsp;&nbsp;<input class="radio" type="radio" name="bLimit" value="3" <? if ($goods_row[bLimit]==3) echo "checked";?>>����&nbsp;&nbsp;&nbsp;&nbsp;<input class="radio" type="radio" name="bLimit" value="4" <? if ($goods_row[bLimit]==4) echo "checked";?>>����&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;<font class="help">�� <b>ǰ��</b>������ �ܿ���� ������� ǰ�����·� �������ϴ�.</font><br>&nbsp;&nbsp;<font class="help">�� <b>����,����</b>������ ���θ������� �������� �ʽ��ϴ�.</font><br>&nbsp;&nbsp;<font class="help">�� <b>�ɼ�+�����</b> ��ɻ��� ����,������ ����� ���� �����ϴ�.</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif" colspan="3"></td>
							</tr>
							<tr>
								<td height="25" colspan="3">
									<table width="73%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="20">&nbsp;</td>
											<td width="70" height="20" bgcolor="#F5F5F5"> <div align="center"><font color="#0099CC">������</font></div></td>
											<td width="172" height="20"> &nbsp;&nbsp; <input class="box" name="limitCnt" type="text" id="eday" size="15" <?=__ONLY_NUM?> value="<?=$goods_row[limitCnt]?>" ></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="30" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �ּ�,�ִ� ���ż���</td>
								<td height="25" colspan="3"> &nbsp;&nbsp;�ּ� ���ż��� <input class="box" name="minbuyCnt" type="text" value="<?=$goods_row[minbuyCnt]?>" size="5"> �� &nbsp;&nbsp;<font class="help">�� �� ������ ����ǰ�� �ּұ��ż��� ���Ϸ� �ֹ��Ҽ� �����ϴ�.</font><br>&nbsp;&nbsp; �ִ� ���ż��� <input class="box" name="maxbuyCnt" type="text" value="<?=$goods_row[maxbuyCnt]?>" size="5"> �� &nbsp;&nbsp;<font class="help">�� �� ������ ����ǰ�� �ִ뱸�ż��� �̻����� �ֹ��Ҽ� �����ϴ�.</font></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ �������<br>�� ����ǰ���� Ư���� �ٸ� ��������� �����Ҷ��� ��� </div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="500" height="26"> <textarea name="trans_content" class="box" cols="90" rows="10"><?=htmlspecialchars($trans_content)?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> â����/����������</td>
								<td height="25" colspan="3">&nbsp;&nbsp; <input class="box" name="chango" type="text" id="eday" size="20" value="<?=htmlspecialchars($goods_row[chango])?>"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� �� �� �� ��</b></font></td>
							</tr>
							<!-- ��Ʈ�̹��� -->
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> HIT �̹��� ���</div></td>
								<td height="25" colspan="3"> &nbsp;&nbsp;&nbsp; <input class="radio" type="checkbox" name="bHit" value="1" <?if(!$admin_row[bHit]){?>disabled<?}?> <?=$bHit?>><img src="../upload/goods_hit_img"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<!-- ���̹��� -->
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> NEW �̹��� ���</div></td>
								<td height="25" colspan="3"> &nbsp;&nbsp;&nbsp; <input class="radio" type="checkbox" name="bNew" value="1"  <?=$bNew?>> <img src="../upload/goods_new_img"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<!-- ��Ÿ�̹��� -->
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��Ÿ �̹��� ���</div></td>
								<td height="25" colspan="3"> &nbsp;&nbsp;&nbsp; <input class="radio" type="checkbox" name="bEtc" value="1" <?if(!$admin_row[bEtc]){?>disabled<?}?> <?=$bEtc?>> <img src="../upload/goods_etc_img"  ></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="60" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���͸�ũ ����</div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" >&nbsp;</td>
											<td width="500"> <input type="checkbox" value="y"  name="bWmark" <?if ($goods_row[bWmark]=="y") echo "checked"; ?>> Ȯ���̹������� �̹��� ���ܵ����� �����ϴ� ���͸�ũ ���� <br><a href="goods_manage.php"><u><b>���͸�ũ �̹��� ���� �ٷΰ���</b></u></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="50" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ�̹��� ó��</div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" >&nbsp;</td>
											<td width="500" > <input type="checkbox" value=1  name="img_onetoall" onclick="javascript:image_multi();" <?if ($goods_row[img_onetoall]==1) echo "checked"; ?>> Ȯ���̹���[1] �Ѱ��� ���ε��Ͽ� ��,��,�� �̹����� ���� ���<br>(GIF �ִϸ��̼��� �ڵ����� �ȵ�)</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">���� �̹���</FONT></div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="500" height="26"> <? if ($goods_row[img1]) { ?><img align="absmiddle" style="border-width:1px;border-color:#eeeeee;border-style:solid;" src="../upload/goods/<?=$goods_row[img1]?>" width="50" height="50">&nbsp;&nbsp;&nbsp;<a href="javascript:zoom('../upload/goods/<?=$goods_row[img1]?>','<?=$wSize[1]?>','<?=$hSize[1]?>');"><u><?=$goods_row[img1]?></u></a><br><? } ?><input class="box" type="file" name="img1">&nbsp;<a href="goods_edit_ok.php?imgdel=1&img_num=1&data=<?=$data?>&returnPage=<?=$returnPage?>"><img src="image/delete_btn.gif" border=0></a>(100*100)</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"><div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">ū �̹���</FONT></div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="500" height="26"> <? if ($goods_row[img2]) { ?><img align="absmiddle" style="border-width:1px;border-color:#eeeeee;border-style:solid;" src="../upload/goods/<?=$goods_row[img2]?>" width="75" height="75">&nbsp;&nbsp;&nbsp;<a href="javascript:zoom('../upload/goods/<?=$goods_row[img2]?>','<?=$wSize[2]?>','<?=$hSize[2]?>');"><u><?=$goods_row[img2]?></u></a><br><? } ?><input class="box" type="file" name="img2">&nbsp;<a href="goods_edit_ok.php?imgdel=1&img_num=2&data=<?=$data?>&returnPage=<?=$returnPage?>"><img src="image/delete_btn.gif" border=0></a>(240*240)</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">Ȯ�� �̹���[1]</FONT></div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="500" height="26"><?
											if ($goods_row[img3])
											{
												?><img align="absmiddle" style="border-width:1px;border-color:#eeeeee;border-style:solid;" src="../upload/goods/<?=$goods_row[img3]?>" width="100" height="100">&nbsp;&nbsp;&nbsp;<a href="javascript:zoom('../upload/goods/<?=$goods_row[img3]?>','<?=$wSize[3]?>','<?=$hSize[3]?>');"><u><?=$goods_row[img3]?></u></a><br><?
											}
											?><input class="box" type="file" name="img3">&nbsp;<a href="goods_edit_ok.php?imgdel=1&img_num=3&data=<?=$data?>&returnPage=<?=$returnPage?>"><img src="image/delete_btn.gif" border=0></a>&nbsp;(500*500)</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr><?
							for($i=0;$i<5;$i++)
							{
								$num = $i+2;
								$img_num = $i+4;
								$img_str = "img".$img_num;
								?>
							<tr valign="middle" id="add_max_img">
								<td width="137" height="25" bgcolor="#FAFAFA"><div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> Ȯ�� �̹���[<?=$num?>]</div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="220" height="26"><?
											if ($goods_row[$img_str])
											{
												?><img align="absmiddle" style="border-width:1px;border-color:#eeeeee;border-style:solid;" src="../upload/goods/<?=$goods_row[$img_str]?>" width="100" height="100">&nbsp;&nbsp;&nbsp;<a href="javascript:zoom('../upload/goods/<?=$goods_row[$img_str]?>','<?=$wSize[$img_num]?>','<?=$hSize[$img_num]?>');"><u><?=$goods_row[$img_str]?></u></a><br><?
											}
											?><input class="box" type="file" name="img<?=$img_num?>"></td>
											<td width="350" height="26" align=left>&nbsp;<a href="goods_edit_ok.php?imgdel=1&img_num=<?=$img_num?>&data=<?=$data?>&returnPage=<?=$returnPage?>"><img src="image/delete_btn.gif" border=0></a>(500 x 500)</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr id="add_max_img">
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr><?
							}
							?>
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� Ÿ �� ��</b></font></td>
							<tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ ���� ����</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <select name="setVal"><?
								for($i=1;$i<=10;$i++)
								{
									?><option value="<?=$i?>" <?if($i==$goods_row[setVal]){echo"selected";}?>><?=$i?></option><?
								}
								?></select> &nbsp;&nbsp;     <FONT  COLOR="#993300">1  ����  �������� &nbsp;&nbsp;  �������� ���� 10</FONT></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���û�ǰ</div></td>
								<td>&nbsp;&nbsp;<a href="javascript:addPosition('<?=$goods_row[idx]?>');"><img src="image/entry_btn1.gif" width="40" height="17" border="0"></a><input type="hidden" name="relation" value="<?=$goods_row[relation]?>"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="30" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ���� ����</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <input name="quality" type="radio" value="A" <? if ($goods_row[quality]=="A") echo "checked";?>>A &nbsp;&nbsp;&nbsp;&nbsp;<input name="quality" type="radio" value="B" <? if ($goods_row[quality]=="B") echo "checked";?>>B &nbsp;&nbsp;&nbsp;&nbsp;<input name="quality" type="radio" value="C" <? if ($goods_row[quality]=="C") echo "checked";?>>C &nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<font class="help">�� �Һ����������� ������� �ʽ��ϴ�. (��ü�������� ���)</font></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td colspan="4" height="50" bgcolor="#FAFAFA"> 
									<table width="200" border="0" align="center">
										<tr>
											<td><div align="center"><a href="javascript:list_edit(document.goodsForm);"><img src="image/entry_btn1.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:goodsDel('goods_edit_ok.php?del=1');"><img src="image/delete_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:goUrl('total_goods_list.php?<?=$LINK_STR?>');"><img src="image/list_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif" bgcolor="#F5F5F5"></td>
							</tr>
							</form><!-- goodsForm -->
							<SCRIPT LANGUAGE="JavaScript">
							<!--
							function goUrl(url)
							{
								var form=document.viewForm;
								form.action=url;
								form.submit();
							}
							//��ǰ����
							function goodsDel(url)
							{
								var form=document.viewForm;
								var choose = confirm("��ǰ�� �����˴ϴ�.\n\n���� �Ͻðڽ��ϱ�?");
								if(choose)
								{
									form.action=url;
									form.submit();
								}
								else return;
							}
							//-->
							</SCRIPT>
							<form name="viewForm" method="post">
							<input type="hidden" name="catePart" value="<?=$catePart?>"><!-- ex) maxCate:��з�  minCate:�ߺз� -->
							<input type="hidden" name="cateCode" value="<?=$cateCode?>"><!-- ī�װ� �ڵ� -->
							<input type="hidden" name="sort" value="<?=$sort?>"><!-- ���Ĺ�� ex)asc:��������  desc:�������� -->
							<input type="hidden" name="sortStr" value="<?=$sortStr?>"><!-- ���ı��� ex)name:�̸�  price:���� -->
							<input type="hidden" name="position" value="<?=$position?>"><!-- ��ġ -->
							<input type="hidden" name="data" value="<?=$data?>"><!-- ��ǰ���� -->
							<input type="hidden" name="returnPage" value="<?=$returnPage?>"><!-- ������ϸ� -->
							</form>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>