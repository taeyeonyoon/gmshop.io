<?
// �ҽ��������
// 20060720-1 �����߰� �輺ȣ : ��ǰ�ɼ� ���̾ƿ�����
session_cache_limiter("no-cache, must-revalidate");
include "head.php";
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
	$admin_row=DBarray("select * from admin limit 0,1"); //������ ���� �迭
}

// �� ī�װ� ����
$category_row = $MySQL->fetch_array("select * from category where code='$code'");
$str_category = $category_row[name];
$this_code = date("YmdHis").getmicrotime();
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
// ���߰� ��� Ȱ��/��Ȱ��
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

// ������ ��� Ȱ��/��Ȱ��
function showCompany()
{
	var form= document.goodsForm;
	if(form.bCompany[0].checked) showObject(form.company,true);
	else showObject(form.company,false);
}

// ������ ��� Ȱ��/��Ȱ��
function showOrigin()
{
	var form= document.goodsForm;
	if(form.bOrigin[0].checked) showObject(form.origin,true);
	else showObject(form.origin,false);
}

// ������ ��� Ȱ��/��Ȱ��
function showLimit()
{
	var form= document.goodsForm;
	if(form.bLimit[0].checked) showObject(form.limitCnt,true);
	else showObject(form.limitCnt,false);
}

// Ȱ��/��Ȱ�� �ʱ�ȭ
function showInit()
{
	showOldprice();		//���߰� ��� Ȱ��/��Ȱ��
	showCompany();		//������ ��� Ȱ��/��Ȱ��
	showOrigin();		//������ ��� Ȱ��/��Ȱ��
	showLimit();		//������ ��� Ȱ��/��Ȱ��
	var form=document.goodsForm;	
	form.img_onetoall.value = 0;
}

// ��ǰ�ɼ� ����
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
		window.open("goods_attribute.php?Val="+Obj.value+"&Index="+Index,"","scrollbars=yes,left=100,top=100,width=420,height=350");
	}
}

// ������ ����
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
		<?
		if($admin_row[poMethod]=="t")
		{
			?>
		form.point.value = <?=$admin_row[poTotal]?>;<?
		}
		else
		{
			?>
		form.point.value = Math.round((goodsPrice *<?=$admin_row[poUnit]?>) /100);<?
		}
		?>
	}
	sale_per();
}

// ��ǰ ���
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
	form.action="goods_write_ok.php";
	form.target="";
	if(form.name.value=="")
	{
		alert("��ǰ���� �Է��� �ֽʽÿ�.");
		form.name.focus();
	}
	else if(form.price.value=="")
	{
		alert("�ǸŰ��� �Է��� �ֽʽÿ�.");
		form.price.focus();
	}
	else if(form.bOldPrice[0].checked && form.oldPrice.value=="")
	{
		alert("���߰��� �Է��� �ֽʽÿ�.");
		form.oldPrice.focus();
	}
	else if(form.code.value=="")
	{
		alert("��ǰ�ڵ带 �Է��� �ֽʽÿ�.");
		form.code.focus();
	}
	else if(form.bCompany[0].checked && form.company.value=="")
	{
		alert("����/������ �Է��� �ֽʽÿ�.");
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
		addAtt(form.partName2,2)	;
	}
	else if(form.partName3.value!="" &&form.strPart3.value=="")
	{
		alert("�ɼ��� �Է��� �ֽʽÿ�.");
		addAtt(form.partName3,3);
	}
	else if (form.img_onetoall.value == 1 && form.img3.value =="")
	{
		alert("Ȯ���̹����� �Է��� �ֽʽÿ�.");
		form.img3.focus();
	}
	else if (form.img_onetoall.value != 1 && form.img1.value =="")
	{
		alert("�����̹����� �Է��� �ֽʽÿ�.");
		form.img1.focus();
	}
	else if (form.img_onetoall.value != 1 && form.img2.value =="")
	{
		alert("�߰��̹����� �Է��� �ֽʽÿ�.");
		form.img2.focus();
	}
	else
	{
		if (parseInt(form.price.value) < parseInt(form.supplyprice.value))
		{
			if (confirm("�ǸŰ��� ���ް����� �۽��ϴ�. ���� �Է»��·� ����Ͻðڽ��ϱ�?"))
			{
				form.str_oldPrice.value		=form.oldPrice.value;	//���߰�
				form.str_company.value		=form.company.value;	//������
				form.str_origin.value		=form.origin.value;		//������
				form.str_limitCnt.value		=form.limitCnt.value;	//������
				form.str_position.value		="0|0|0|0|0|0|0";		//Ư����ġ���� 
				form.submit();//����
			}
		}
		else
		{
			form.str_oldPrice.value		=form.oldPrice.value;	//���߰�
			form.str_company.value		=form.company.value;	//������
			form.str_origin.value		=form.origin.value;		//������
			form.str_limitCnt.value		=form.limitCnt.value;	//������
			form.str_position.value		="0|0|0|0|0|0|0";		//Ư����ġ���� 
			form.submit();//����
		}
	}
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

//���߰� ���� ���η� ���
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

// ���û�ǰ ã�� 
function addPosition(idx,part)
{
	window.open("goods_relation.php?idx="+idx+"&part="+part,"","scrollbars=yes,width=500,height=750,top=20,left=20");
}

function code_check() // ��ǰ�ڵ� ������ �ߺ��˻� 
{
	var form=document.goodsForm;
	var gcode = form.code.value;
	form.action="goods_code_check.php?gcode="+gcode;
	form.target = "ifrm";
	form.submit();
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"  onload="javascript:showInit();">
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
								<td width='440'><img src="image/good_entry_tit.gif"></td>
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
						<form name="goodsForm" method="post" action="goods_write_ok.php" enctype="multipart/form-data" >
						<input type="hidden" name="category" value="<?=$code?>"><!-- ��ǰī�װ� ���� -->
						<input type="hidden" name="code_num" value="<?=$new_g_num?>"><!-- ��ǰ���� ���� -->
						<!-- ���� disabled ������ �缳�� -->
						<input type="hidden" name="str_oldPrice"><!-- ���߰� -->
						<input type="hidden" name="str_company"><!-- ������ -->
						<input type="hidden" name="str_origin"><!-- ������ -->
						<input type="hidden" name="str_limitCnt"><!-- ������ -->
						<input type="hidden" name="str_position"><!-- Ư����ġ -->
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr valign="middle">
								<td colspan="4" height="50" bgcolor="#FAFAFA">
									<table width="200" border="0" align="center">
										<tr>
											<td><div align="center"><a href="javascript:goodsSendit();"><img src="image/entry_btn1.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:location.href='total_goods_list.php?code=<?=$code?>';"><img src="image/list_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif" bgcolor="#F5F5F5"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ ī�װ�</div></td>
								<td height="25" colspan="3">&nbsp;&nbsp; <?=$str_category?></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� �� �� ��</b></font></td>
							<tr>
							<!-- �Ϲݰ��� -->
							<tr>
								<td width="137" height="25" bgcolor="#E1DEFE">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">�ǸŰ�</FONT></td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <input class="box" name="price" type="text" size="15" <?=__ONLY_NUM?> value="<?=$price?>" onblur="setOldprice();"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr id="idprice1">
								<td width="137" height="25" bgcolor="#E1DEFE">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <input class="box" name="point" type="text" size="15" <?=__ONLY_NUM?> value="<?=$point?>" ></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����</td>
								<td height="25" colspan="3">
									<table>
										<tr>
											<td>&nbsp;&nbsp;<input class="box" name="margin" value="" size='3' <?=__ONLY_NUM?>> %</td>
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
											<td>&nbsp; <input class="box" name="supplyprice" type="text" size="15" <?=__ONLY_NUM?>> �� </td>
											<td><font class="help">�� ��ǰ�� ���ް� (���� ȭ������� ���� �ʽ��ϴ�.)</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="61" bgcolor="#FAFAFA" rowspan="3">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���߰�</td>
								<td height="25" colspan="3">
									<table width="250" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="12"> <div align="center"> </div></td>
											<td width="5%"> <input class="radio" type="radio" name="bOldPrice" value="1" onclick="javascript:showOldprice();" <?=$price_disabled?>></td>
											<td width="30%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input class="radio" type="radio" name="bOldPrice" value="0" checked  onclick="javascript:showOldprice();" <?=$price_disabled?>></div></td>
											<td width="50%"> <div align="left">������� ����</div></td>
										</tr>
									</table>&nbsp;<font class="help">�� �ǸŰ��� ǥ������ <strike>5,000 ��</strike> �̷������� ���߰��� ǥ��˴ϴ�.</font>
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
											<td width="300" height="20"> &nbsp;&nbsp; <input class="box" name="oldPrice" type="text" size="15" <?=__ONLY_NUM?> onBlur="javascript:sale_per();">&nbsp;&nbsp;<input name=sale type=text class="box" size=2 readonly>% <font class="help">&nbsp;�� ���߰����� ������ </font>&nbsp;&nbsp;<input type="checkbox" name="bSaleper" value="1" <?=$price_disabled?>><font class="help">�ػ����ȭ�鿡 ���η�ǥ�� </td>
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
							<tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">��ǰ�ڵ�</FONT></div></td>
								<td height="25" colspan="3">&nbsp;&nbsp; <input class="box" name="code" type="text" size="30" value="<?=$this_code?>">&nbsp;<a href="javascript:code_check();"><img src="image/jungbok.gif" border=0 ></a></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">��ǰ��</FONT></td>
								<td height="25" colspan="3">&nbsp;&nbsp; <input class="box" name="name" type="text" size="60"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �𵨸�</td>
								<td height="25" colspan="3">&nbsp;&nbsp; <input class="box" name="model" type="text" size="60"></td>
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
											<td width="5%"> <input class="radio" type="radio" name="bCompany" value="1"  onclick="javascript:showCompany();"></td>
											<td width="30%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input class="radio" type="radio" name="bCompany" value="0" checked onclick="javascript:showCompany();"></div></td>
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
											<td width="172" height="20"> &nbsp;&nbsp; <input class="box" name="company" type="text" size="25"></td>
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
											<td width="5%"> <input class="radio" type="radio" name="bOrigin" value="1"  onclick="javascript:showOrigin();"></td>
											<td width="30%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input class="radio" type="radio" name="bOrigin" value="0"  checked onclick="javascript:showOrigin();"></div></td>
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
											<td width="172" height="20"> &nbsp;&nbsp; <input class="box" name="origin" type="text" size="25"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ �� ����</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <INPUT TYPE="radio" NAME="bHtml" value='0' onclick="document.getElementById('nsText').style.display='block';document.getElementById('nsHtml').style.display='none';document.getElementById('nsEdit').style.display='none';">TEXT &nbsp; <INPUT TYPE="radio" NAME="bHtml" value='2' <?=$Os_Check?"":"checked"?> onclick="document.getElementById('nsText').style.display='none';document.getElementById('nsHtml').style.display='block';document.getElementById('nsEdit').style.display='none';">HTML &nbsp; <INPUT TYPE="radio" NAME="bHtml" value='1' <?=$Os_Check?"checked":""?> onclick="document.getElementById('nsText').style.display='none';document.getElementById('nsHtml').style.display='none';document.getElementById('nsEdit').style.display='block';" <?= $Use_Check?>>��������</td>
							</tr>
							<tr>
								<td colspan="4" valign=top align='center'>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText' style='display:none'>
										<tr>
											<td><textarea name="TextContent" style="width:100%" rows="20" cols="80"></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml' style='display:<?=$Os_Check?"none":"block"?>'>
										<tr>
											<td><textarea name="HtmlContent" style="width:100%" rows="20" cols="80"></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit' style='display:<?=$Os_Check?"block":"none"?>'>
										<tr>
											<td><?
											$form_name = "goodsForm";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="content" cols="90" rows="10"></textarea></td>
										</tr>
									</table>
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
											<td width="500" height="26"> <input class="box" type="file" name="detailimg1"></td>
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
											<td width="500" height="26"> <input class="box" type="file" name="detailimg2"></td>
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
											<td width="500" height="26"> <input class="box" type="file" name="detailimg3"></td>
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
											<td width="500" height="26"> <input class="box" type="file" name="detailimg4"></td>
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
											<td height="25" width="380" bgcolor='#FFFFFF'>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="10" height="26">&nbsp;</td>
														<td width="70" height="26"> <input class="box" name="partName1" type="text" size="15" value="<?=$goods_row[partName1]?>"></td>
														<td height="26">&nbsp;<a href="javascript:addAtt(document.goodsForm.partName1,1);"><img src="image/ok_btn.gif" width="40" height="17" border="0"></a><font class="help">��) ����</font></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr valign="middle">
											<td height="25" bgcolor="#EBEBEB" width="100"> <div align="center"><font color="#424242">�ɼ� ���ڿ�</font></div></td>
											<td height="25" width="380" bgcolor='#FFFFFF'>&nbsp; <input class="nonbox" name="strPart1" type="text" size="50" readonly><br><font class="help">��) �ɼǿ� ���� ���û��� (����,�Ķ�)</font></td>
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
											<td height="25" width="380" bgcolor='#FFFFFF'>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="10" height="26">&nbsp;</td>
														<td width="70" height="26"> <input class="box" name="partName2" type="text" size="15"></td>
														<td height="26">&nbsp;<a href="javascript:addAtt(document.goodsForm.partName2,2);"><img src="image/ok_btn.gif" width="40" height="17" border="0"></a><font class="help">��) ũ��</font> </td>
													</tr>
												</table>
											</td>
										</tr>
										<tr valign="middle">
											<td height="25" bgcolor="#EBEBEB" width="100"> <div align="center"><font color="#424242">�ɼ� ���ڿ�</font></div></td>
											<td height="25" width="380" bgcolor='#FFFFFF'>&nbsp; <input class="nonbox" name="strPart2" type="text" size="50" readonly><br><font class="help">��) �ɼǿ� ���� ���û��� (��,��,��)</font></td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="2"></td>
										</tr>
									</table>
									<table width="480" border="0" cellspacing="1" cellpadding="0" bgcolor='#C2C2C2'>
										<tr valign="middle">
											<td width="100" height="25" bgcolor="#EBEBEB"> <div align="center"><font color="#424242">�ɼǸ�</font></div></td>
											<td width="380" height="25" bgcolor='#FFFFFF'>
												<table width="60%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="10" height="26">&nbsp;</td>
														<td width="123" height="26"> <input class="box" name="partName3" type="text" size="15"></td>
														<td width="76" height="26"><a href="javascript:addAtt(document.goodsForm.partName3,3);"><img src="image/ok_btn.gif" width="40" height="17" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr valign="middle">
											<td width="100" height="25" bgcolor="#EBEBEB"> <div align="center"><font color="#424242">�ɼ� ���ڿ�</font></div></td>
											<td height="25" width="380" bgcolor='#FFFFFF'>&nbsp; <input class="nonbox" name="strPart3" type="text" size="50" readonly></td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- ��ǰ�ɼ� �� -->
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� �� / �� ��</b></font></td>
							</tr>
							<tr>
								<td width="137" height="30" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��۷ᱸ�� ����</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <input name="size" type="checkbox" value="n" <? if ($goods_row[size]=="n") echo "checked";?>>������</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="61" bgcolor="#FAFAFA" rowspan="3">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</td>
								<td height="25" colspan="3">
									<table width="400" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="12"> <div align="center"> </div></td>
											<td> <input class="radio" type="radio" name="bLimit" value="1" onclick="javascript:showLimit();" <? if ($goods_row[bLimit]==1) echo "checked";?>>����&nbsp;&nbsp;&nbsp;&nbsp; <input class="radio" type="radio" name="bLimit" value="0" onclick="javascript:showLimit();" <? if ($goods_row[bLimit]==0) echo "checked";?>>������&nbsp;&nbsp;&nbsp;&nbsp; <input class="radio" type="radio" name="bLimit" value="2" <? if ($goods_row[bLimit]==2) echo "checked";?>>ǰ��&nbsp;&nbsp;&nbsp;&nbsp; <input class="radio" type="radio" name="bLimit" value="3" <? if ($goods_row[bLimit]==3) echo "checked";?>>����&nbsp;&nbsp;&nbsp;&nbsp; <input class="radio" type="radio" name="bLimit" value="4" <? if ($goods_row[bLimit]==4) echo "checked";?>>����&nbsp;&nbsp;&nbsp;&nbsp; <br>&nbsp;&nbsp;<font class="help">�� <b>ǰ��</b>������ �ܿ���� ������� ǰ�����·� �������ϴ�.</font> <br>&nbsp;&nbsp;<font class="help">�� <b>����,����</b>������ ���θ������� �������� �ʽ��ϴ�.</font> <br>&nbsp;&nbsp;<font class="help">�� <b>�ɼ�+�����</b> ��ɻ��� ����,������ ����� ���� �����ϴ�.</font></td>
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
											<td width="172" height="20"> &nbsp;&nbsp; <input class="box" name="limitCnt" type="text" size="15" <?=__ONLY_NUM?> ></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="30" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �ּ�,�ִ� ���ż���</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; �ּ� ���ż��� <input class="box" name="minbuyCnt" type="text" value="<?=$goods_row[minbuyCnt]?>" size="5"> �� &nbsp;&nbsp;<font class="help">�� �� ������ ����ǰ�� �ּұ��ż��� ���Ϸ� �ֹ��Ҽ� �����ϴ�.</font> <br>&nbsp;&nbsp; �ִ� ���ż��� <input class="box" name="maxbuyCnt" type="text" value="<?=$goods_row[maxbuyCnt]?>" size="5"> �� &nbsp;&nbsp;<font class="help">�� �� ������ ����ǰ�� �ִ뱸�ż��� �̻����� �ֹ��Ҽ� �����ϴ�.</font></td>
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
											<td width="500" height="26"> <textarea name="trans_content" class="box" cols="90" rows="10"></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> â����/����������</td>
								<td height="25" colspan="3">&nbsp;&nbsp; <input class="box" name="chango" type="text" size="20"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� �� ��</b></font></td>
							<tr>
							<!-- ��Ʈ/���̹��� -->
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> HIT / NEW </div></td>
								<td height="25" colspan="3"> &nbsp;&nbsp;&nbsp; <input class="radio" type="checkbox" name="bHit" value="1" <?if(!$admin_row[bHit]){?>disabled<?}?>> <img src="../upload/goods_hit_img">&nbsp;&nbsp;&nbsp; <input class="radio" type="checkbox" name="bNew" value="1" <?if(!$admin_row[bNew]){?>disabled<?}?>> <img src="../upload/goods_new_img"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<!-- ��Ÿ�̹��� -->
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��Ÿ �̹��� ���</div></td>
								<td height="25" colspan="3"> &nbsp;&nbsp;&nbsp; <input class="radio" type="checkbox" name="bEtc" value="1" <?if(!$admin_row[bEtc]){?>disabled<?}?>><img src="../upload/goods_etc_img"></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="40" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���͸�ũ ����</div></td>
								<td height="60" colspan="3">
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
											<td width="500" > <input type="checkbox" value=1  name="img_onetoall" onclick="javascript:image_multi();"> Ȯ���̹���[1] �Ѱ��� ���ε��Ͽ� ��,��,�� �̹����� ���� ��� <br>(GIF �ִϸ��̼��� �ڵ����� �ȵ�)</td>
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
											<td width="400" height="26"> <font class="help">�� �̹������ϸ��� <b>����,Ư������</b>�� �̸� ������ �ֽñ�ٶ��ϴ�. <br>�� ���ϸ� <b>�ѱ��� ���ԵǾ�����</b> ��ǻ�Ϳ� ���� ȭ����¿� ������ �߻��� ���� �ֽ��ϴ�. </font> <br><input class="box" type="file" name="img1">&nbsp;(100*100)</td>
											<td width="111" height="26">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> <FONT  COLOR="#CC3300">ū �̹���</FONT></div> </td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="300" height="26"> <input class="box" type="file" name="img2">&nbsp;(240*240)</td>
											<td width="111" height="26">&nbsp;</td>
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
											<td width="300" height="26"> <input class="box" type="file" name="img3">&nbsp;(500*500)</td>
											<td width="111" height="26" align="center"></td>
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
								?>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> Ȯ�� �̹���[<?=$num?>]</div></td>
								<td height="25" colspan="3">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="12" height="26">&nbsp;</td>
											<td width="227" height="26"> <input class="box" type="file" name="img<?=$img_num?>"></td>
											<td width="151" height="26">&nbsp;����ȭ ������ (500 x 500) </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr><?
							}
							?>
							<tr>
								<td  colspan="4" height="30" align="center"  bgcolor="#051D55"><font color="white"><b>�� Ÿ �� ��</b></font></td>
							</tr>
							<tr>
								<td width="137" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ ���� ����</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <select name="setVal"><?
								for($i=1;$i<=10;$i++)
								{
									?><option value="<?=$i?>" <?if($i==5){echo"selected";}?>><?=$i?></option><?
								}
								?></select> &nbsp;&nbsp;     <FONT  COLOR="#993300">1  ����  �������� &nbsp;&nbsp;  �������� ���� 10</FONT></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="137" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���û�ǰ</div></td>
								<td colspan=3>&nbsp;&nbsp;<a href="javascript:addPosition('<?=$goods_row[idx]?>','write');"><img src="image/entry_btn1.gif" width="40" height="17" border="0"></a><input type="hidden" name="relation" value=""></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="137" height="30" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ���� ����</td>
								<td height="25" colspan="3"> &nbsp;&nbsp; <input name="quality" type="radio" value="A" checked>A &nbsp;&nbsp;&nbsp;&nbsp;<input name="quality" type="radio" value="B" >B &nbsp;&nbsp;&nbsp;&nbsp;<input name="quality" type="radio" value="C" >C &nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;<font class="help">�� �Һ����������� ������� �ʽ��ϴ�. (��ü�������� ���)</font></td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td colspan="4" height="50" bgcolor="#FAFAFA"> 
									<table width="200" border="0" align="center">
										<tr>
											<td><div align="center"><a href="javascript:goodsSendit();"><img src="image/entry_btn1.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:history.go(-1);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" height="1" background="image/line_bg1.gif" bgcolor="#F5F5F5"></td>
							</tr>
						</table></form><!-- goodsForm -->
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>