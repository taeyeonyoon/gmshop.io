<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function etcSendit()
{
	document.adm_etcForm.submit();
}

function price_change()
{
	if (confirm("������ �����Ͻðڽ��ϱ�?"))
	{
		if (document.priceForm.perc.value=="")
		{
			alert("�ۼ�Ʈ ���� �Է����ּ���.");
		}
		else
		{
		document.priceForm.submit();
		}
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<object id="dlgHelper" classid="clsid:3050f819-98b5-11cf-bb82-00aa00bdce0b" width="0px" height="0px"></object>
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "goods";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
	}
	if($admin_row[bGoodsapp] =="y")
	{
		$true_bGoodsapp = "checked";
		$false_bGoodsapp= "";
	}
	else
	{
		$true_bGoodsapp = "";
		$false_bGoodsapp= "checked";
	}
	if($admin_row[beditprice_warn]=="y")
	{
		$true_beditprice_warn = "checked";
		$false_beditprice_warn= "";
	}
	else
	{
		$true_beditprice_warn = "";
		$false_beditprice_warn= "checked";
	}
	if($admin_row[bAskboard] =="y")
	{
		$true_bAskboard = "checked";
		$false_bAskboard= "";
	}
	else
	{
		$true_bAskboard = "";
		$false_bAskboard= "checked";
	}
	if($admin_row[bHit])	$bHit = "checked";
	else					$bHit = "";
	if($admin_row[bNew])	$bNew = "checked";
	else					$bNew = "";
	if($admin_row[bEtc])	$bEtc = "checked";
	else					$bEtc = "";
	?>
		<td width="85%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ��ǰ������ �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<form name="adm_etcForm" method="post" action="goods_manage_ok.php" enctype="multipart/form-data" >
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" height="500">
							<tr>
								<td colspan="2">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height='1' colspan='3' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td width='440'><img src="image/good_manager.gif"></td>
										</tr>
										<tr>
											<td height='1' colspan='3' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td height='20' colspan='3'><font class="help">�� �̹��� ���ε��� ���������� ������� <b>������ ���ΰ�ħ</b>�� ���ּ���. </font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='5' colspan="2"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ�� ��뿩��</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="10%"> <div align="center"> <input type="radio" name="bGoodsapp" value="y" <?=$true_bGoodsapp?>></div></td>
											<td width="25%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input type="radio" name="bGoodsapp" value="n" <?=$false_bGoodsapp?>></div></td>
											<td width="25%"> <div align="left">������� ����</div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ���� ��뿩��</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="10%"> <div align="center"> <input type="radio" name="bAskboard" value="y" <?=$true_bAskboard?>></div></td>
											<td width="25%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input type="radio" name="bAskboard" value="n" <?=$false_bAskboard?>></div></td>
											<td width="25%"> <div align="left">������� ����</div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ��ϻ󿡼� �ǸŰ� ������<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���޼���â ����</td>
								<td width="549" height="25">
									<table width="549" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="549" height=50>&nbsp; &nbsp;<input type="radio" name="beditprice_warn" value="y" <?=$true_beditprice_warn?>>��� ������&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="beditprice_warn" value="n" <?=$false_beditprice_warn?>>��� ��������&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;�����ڰ� �ǸŰ� ������ �������� <input class="box" type="text" name="editprice_warn" value="<?=$admin_row[editprice_warn]?>" size=8 <?__ONLY_NUM?>> �� �̻� ���̳��� ���޽��� ��� &nbsp;</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> NEW �̹��� ���</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td><img src="../upload/goods_new_img"></td>
											<td> ����� <input type="checkbox" name="bNew" value="1" <?=$bNew?>></td>
											<td><input class="box" type="file" name="goodsNewImg"></td>
										</tr>
										<tr>
											<td colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>���ο� ��ǰ���</b>�� �� �̹����� <input style="background-color:#FCFBB9" type="text" class="box" name="new_day" size=3 value="<?=$admin_row[new_day]?>"> �ϰ� ȭ�鿡 <b>�ڵ����</b></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA"  >&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��Ÿ �̹��� ���</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td><img src="../upload/goods_etc_img"></td>
											<td>����� <input type="checkbox" name="bEtc" value="1" <?=$bEtc?>></td>
											<td><input class="box" type="file" name="goodsEtcImg"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> HIT �̹��� </td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td width=30><img src="../upload/goods_hit_img" ></td>
											<td width="300"><input class="box" type="file" name="goodsHitImg"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �ǸŰ� �̹���</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td width=30><img src="../upload/goods_price_img"></td>
											<td width="300"><input class="box" type="file" name="goods_price_img"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ �̹���</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td width=30><img src="../upload/goods_point_img"></td>
											<td width="300"><input class="box" type="file" name="goodsPointImg"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> Ȯ�뺸��</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td width=30><img src="../upload/goods_view_img"></td>
											<td width="300"><input class="box" type="file" name="goods_view_img"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ǰ��ǥ��</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td width=30><img src="../upload/no_good_img"></td>
											<td width="300"><input class="box" type="file" name="no_good_img"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ī�װ� ����Ʈ��ǰ</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td width=30><img src="../upload/catebest_img"></td>
											<td width="300"><input class="box" type="file" name="catebest_img"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ��� ��Ʈ����</td>
								<td width="549" height="25">
									<table width="100%" border="1" cellspacing="0" cellpadding="3" class="table_coll">
										<tr align="center">
											<td><input type="checkbox" name="bGoodsList_1" value="1" <? if ($design_goods[bGoodsList_1]==1) echo "checked";?>> ȭ�����</td>
											<td valign="middle">���û���</td>
											<td><img src="../image/goodsample.jpg" width="100" height="100"></td>
											<td colspan="2"></td>
										</tr>
										<tr align="center">
											<td><input type="checkbox" name="bGoodsList_2" value="1" <? if ($design_goods[bGoodsList_2]==1) echo "checked";?>> ȭ�����</td>
											<td>��ǰ��</td>
											<td><font color="<?=$design_goods[gname_color]?>" id="text_no_font_color1">�����̽� ����</font></td>
											<td>
												<table id="no_font_color1" onClick="setColor('', 'bg',this.id);"  class="square" bgcolor="<?=$design_goods[gname_color]?>" style="cursor:pointer" width="40" border="1" cellspacing="0" cellpadding="0" height="20" >
													<tr>
														<td  align="center"></td>
													</tr>
												</table>
											</td>
											<td>&nbsp;RGB �ڵ� <input class="box" name="t_no_font_color1" type="text" id="t_no_font_color1"  value="<?= $design_goods[gname_color]?>" size="8"> </td>
										</tr>
										<tr align="center">
											<td><input type="checkbox" name="bGoodsList_4" value="1" <? if ($design_goods[bGoodsList_4]==1) echo "checked";?>> ȭ�����</td>
											<td>�ǸŰ�</td>
											<td><font color="<?=$design_goods[gprice_color]?>" id="text_no_font_color2">57,000 ��</font></td>
											<td>
												<table style="cursor:pointer" align="center" id="no_font_color2" onClick="setColor('', 'bg',this.id);" class="square" bgcolor="<?=$design_goods[gprice_color]?>" width="40" border="1" cellspacing="0" cellpadding="0" height="20">
													<tr>
														<td ></td>
													</tr>
												</table>
											</td>
											<td>&nbsp;RGB �ڵ� <input class="box" name="t_no_font_color2" type="text" id="t_no_font_color2" onChange="setChangedColor(this);no_font2.color=this.value;" value="<?= $design_goods[gprice_color]?>" size="8"> </td>
										</tr>
										<tr align="center">
											<td><input type="checkbox" name="bGoodsList_5" value="1" <? if ($design_goods[bGoodsList_5]==1) echo "checked";?>> ȭ�����</td>
											<td>������</td>
											<td><font color="<?=$design_goods[gpoint_color]?>" id="text_no_font_color3">570 ��</font></td>
											<td>
												<table style="cursor:pointer" align="center" id="no_font_color3" onClick="setColor('', 'bg',this.id);" class="square" bgcolor="<?=$design_goods[gpoint_color]?>" width="40" border="1" cellspacing="0" cellpadding="0" height="20">
													<tr>
														<td ></td>
													</tr>
												</table>
											</td>
											<td>&nbsp;RGB �ڵ� <input class="box" name="t_no_font_color3" type="text" id="t_no_font_color3" onChange="setChangedColor(this);no_font3.color=this.value;" value="<?= $design_goods[gpoint_color]?>" size="8"> </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���͸�ũ �̹���</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td><img src="../upload/watermark_img"></td>
										</tr>
										<tr>
											<td colspan=2>&nbsp;&nbsp;<input class="box" type="file" name="watermark_img"><font class="help">&nbsp;(JPG ����)<br>&nbsp;�� GD ��ġ�� ȣ���ÿ����� ��밡��. ��ǰ�̹����� <b>��ǰ���,������</b> �ڵ�����</font><br>&nbsp;����ǰ�̹������� ���͸�ũ ���� ��ġ&nbsp;&nbsp;<select name="wm_pos"><?
											for ($i=0; $i<9; $i++)
											{
												?><option value="<?=$i?>" <? if ($i==$admin_row[wm_pos]) echo "selected";?>><?=$i?></option><?
											}
											?></select><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="./image/wm_pos.jpg"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="201" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ�̹��� �ڵ����� ������</td>
								<td width="549" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="20"></td>
											<td width="300">�����̹��� ������ ���� <input class="box" type="text" name="gdimg1_width" size="5" value="<?=$design_goods[gdimg1_width]?>"> px &nbsp;&nbsp;���� <input class="box" type="text" name="gdimg1_height" size="5" value="<?=$design_goods[gdimg1_height]?>"> px <br>�߰��̹��� ������ ���� <input class="box" type="text" name="gdimg2_width" size="5" value="<?=$design_goods[gdimg2_width]?>"> px &nbsp;&nbsp;���� <input class="box" type="text" name="gdimg2_height" size="5" value="<?=$design_goods[gdimg2_height]?>"> px </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit();"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:formClear(document.adm_etcForm);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- adm_etcForm -->
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