<?
include "head.php";
$cate_row = $MySQL->fetch_array("select *from category where code='$parentcode' limit 1");
$str_category = "<b>".$cate_row[name]."</b>";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function sendit()
{
	var form=document.wForm;
	if(!numCheck(form.goodsListW.value))
	{
		alert("���� ���ڰ� �ùٸ��� �ʽ��ϴ�.");
		form.goodsListW.focus();
	}
	else if(form.goodsListW.value <1)
	{
		alert("���� ��¼��� 0 �̻��� ���� �Է��� �ֽʽÿ�.");
		form.goodsListW.focus();
	}
	else if(!numCheck(form.goodsListH.value))
	{
		alert("���� ���ڰ� �ùٸ��� �ʽ��ϴ�.");
		form.goodsListH.focus();
	}
	else if(form.goodsListH.value <1)
	{
		alert("���� ��¼��� 1 �̻��� ���� �Է��� �ֽʽÿ�.");
		form.goodsListH.focus();	
	}
	else
	{
		form.submit();
	}
}

function designType_select(val)
{
	var form = document.wForm;	
	if (val==3) //ȥ�� 
	{
		form.goodsListW.value = 2;
		form.goodsListW.readOnly = true;
		form.goodsListW.style.backgroundColor = "#eeeeee";
	}
	else if (val==2) // �Խ��� 
	{
		form.goodsListW.value = 1;
		form.goodsListW.readOnly = true;
		form.goodsListW.style.backgroundColor = "#eeeeee";
	}
	else
	{
		form.goodsListW.readOnly = false;
		form.goodsListW.style.backgroundColor = "#ffffff";
	}
}
//����Ʈ���,��ǰ�ڵ� Ȱ��/��Ȱ��
function showSiteUrl(Obj)
{
	if(Obj.gubun[0].checked)
	{
		showObject(Obj.siteUrl,true);
		showObject(Obj.goodsUrl,false);
	}
	else if(Obj.gubun[1].checked)
	{
		showObject(Obj.siteUrl,false);
		showObject(Obj.goodsUrl,true);
	}
	else
	{
		showObject(Obj.siteUrl,false);
		showObject(Obj.goodsUrl,false);
	}
}
//���� ����
function bannerwriteSendit(Obj)
{
	if(Obj.gubun[0].checked && Obj.siteUrl.value=="")
	{
		alert("����Ʈ ��θ� �Է��� �ֽʽÿ�.");
		Obj.siteUrl.focus();
	}
	else if(Obj.gubun[1].checked &&Obj.goodsUrl.value=="")
	{
		alert("��ǰ ����Դϴ�. ��ǰ�� ������ �ֽʽÿ�.");
	}
	else if(Obj.img.value=="")
	{
		alert("�̹����� ������ �ֽʽÿ�.");
	}
	else
	{
		Obj.siteUrl_str.value = Obj.siteUrl.value;
		Obj.goodsUrl_str.value = Obj.goodsUrl.value;
		Obj.submit();
	}
}
//���� ����
function bannerSendit(Obj,Url)
{
	if(Obj.gubun[0].checked && Obj.siteUrl.value=="")
	{
		alert("����Ʈ ��θ� �Է��� �ֽʽÿ�.");
		Obj.siteUrl.focus();
	}
	else if(Obj.gubun[1].checked &&Obj.goodsUrl.value=="")
	{
		alert("��ǰ ����Դϴ�. ��ǰ�� ������ �ֽʽÿ�.");
	}
	else
	{
		Obj.siteUrl_str.value = Obj.siteUrl.value;
		Obj.goodsUrl_str.value = Obj.goodsUrl.value;
		Obj.action +=Url;
		Obj.submit();
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="designType_select(<?=$cate_row[designType]?>);">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "category";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	?>
		<td width="85%" valign="top">
			<table width="100%" height="500" border="0" cellspacing="0" cellpadding="0" height="560">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/cate_tit.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ī�װ� ���� ���� ��� ���� �ϽǼ� �ֽ��ϴ�.&nbsp;</font></div></td>
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
								<td width='440'><img src="image/cate_design_tit2.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td valign="top">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" >
							<tr>
								<td colspan="2" height="40">�� <?=$str_category."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='image/prepage.gif' align='absmiddle' onclick='history.go(-1);' style='cursor:pointer'>"?> </td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" >
										<tr>
											<td width="170"> <div align="center">�ٵ��ǽ� �迭<br><img src="image/design_g_a_view.gif"> </div></td>
											<td width="170"><div align="center">�Խ��ǽ� �迭<br><img src="image/design_g_a_view3.gif"> </div></td>
											<td width="170"><div align="center">ȥ�ս� �迭<br><img src="image/design_g_a_view4.gif"> </div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="60">
									<table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff" height="50">
										<tr>
											<td bgcolor="#FFF3E1">* ��ǰ ����Ʈ- �����ְ��� �ϴ� ��ǰ�� ����,����� ���Ҽ� ����<br>* ��ǰ ������� - �Ϲ����� �ٵ��ǽĹ迭�� �Խ��ǽ� �迭 <br>* ��ǰ��� ���� ���� <br>* ��ǰ��� �߾� ����<br>* ��ǰ��� �Ż�ǰ ��� �ٷΰ��� </td>
										</tr>
									</table>
								</td>
							</tr>
							<form name="wForm" method="post" action="category_design_ok.php?part=1">
							<input type="hidden" name="parentcode" value="<?=$parentcode?>">
							<tr>
								<td colspan="2" height="40"> <img src="image/design_main_icon.gif" width="21" height="11">��ǰ ������� </td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="200" bgcolor="#FFF3E1"> <div align="center">��ǰ �������</div></td>
											<td width="400">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="70"><div align="center"></div></td>
													</tr>
													<tr>
														<td> <div align="center"> <input type="radio" name="designType" value="1" <? if ($cate_row[designType]==1 || $cate_row[designType]== 0) echo "checked";?> onclick="designType_select(this.value);">�ٵ��ǽ� �迭 &nbsp;&nbsp;<input type="radio" name="designType" value="2" <? if ($cate_row[designType]==2) echo "checked";?> onclick="designType_select(this.value);">�Խ��ǽ� �迭 &nbsp;&nbsp;<input type="radio" name="designType" value="3" <? if ($cate_row[designType]==3) echo "checked";?> onclick="designType_select(this.value);">ȥ�ս� �迭 </div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="40"> <img src="image/design_main_icon.gif" width="21" height="11">��ǰ ����Ʈ ����</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="200" bgcolor="#FFF3E1"> <div align="center">��ǰ ��� ��</div></td>
											<td width="300">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center">������¼� x ������¼�</div></td>
													</tr>
													<tr>
														<td> <div align="center"> <input type="text" name="goodsListW" class="box" size="10" value="<?=$cate_row[goodsListW]?>"> x <input type="text" name="goodsListH" class="box" size="10" value="<?=$cate_row[goodsListH]?>"></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="200" bgcolor="#FFF3E1"> <div align="center">��ǰ ��� �̹��� ������</div></td>
											<td width="300">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center">���λ����� x ���λ�����</div></td>
													</tr>
													<tr>
														<td> <div align="center"> <input type="text" name="goodsListIW" class="box" size="10" value="<?=$cate_row[goodsListIW]?>"> x <input type="text" name="goodsListIH" class="box" size="10" value="<?=$cate_row[goodsListIH]?>"></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="200" bgcolor="#FFF3E1"> <div align="center">����Ʈ(��) �̹��� ������</div></td>
											<td width="300">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center">���λ����� x ���λ�����</div></td>
													</tr>
													<tr>
														<td> <div align="center"> <input type="text" name="goodsListIW1" class="box" size="10" value="<?=$cate_row[goodsListIW1]?>"> x <input type="text" name="goodsListIH1" class="box" size="10" value="<?=$cate_row[goodsListIH1]?>"></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="200" bgcolor="#FFF3E1"> <div align="center">����Ʈ �̹��� ������</div></td>
											<td width="300">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center">���λ����� x ���λ�����</div></td>
													</tr>
													<tr>
														<td> <div align="center"> <input type="text" name="goodsListIW2" class="box" size="10" value="<?=$cate_row[goodsListIW2]?>"> x <input type="text" name="goodsListIH2" class="box" size="10" value="<?=$cate_row[goodsListIH2]?>"></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" align="center" height="30"><a href="javascript:sendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
							</tr>
							</form>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="35"><br><img src="image/design_main_icon.gif" width="21" height="11"><a href="goods_position.php?part=new&category=<?=$parentcode?>">��ǰ��� ������ <b>���� �Ż�ǰ</b> ��ϸ޴� �ٷΰ��� </a></td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="35"><br><img src="image/design_main_icon.gif" width="21" height="11">��ǰ��� ������ <b>����</b> ���ʸ��</td>
							</tr><?
							$ban_qry = "select *from banner where position ='$parentcode' order by sunwi asc";
							$ban_result = @$MySQL->query($ban_qry);
							$ban_cnt =0;
							while($ban_row = mysql_fetch_array($ban_result))
							{
								$ban_cnt ++;
								if($ban_row[gubun]==0)
								{
									$site_color = "white";
									$goods_color = "#dddddd";
									$site_disabled = "";
									$goods_disabled = "disabled";
								}
								else if($ban_row[gubun]==1)
								{
									$site_color = "#dddddd";
									$goods_color = "white";
									$site_disabled = "disabled";
									$goods_disabled = "";
								}
								else
								{
									$site_color = "#dddddd";
									$goods_color = "#dddddd";
									$site_disabled = "disabled";
									$goods_disabled = "disabled";
								}
								?>
							<form name="bannerForm3<?=$ban_cnt?>" method="post" action="category_design_ok.php?part=2"  enctype="multipart/form-data" >
							<input type="hidden" name="siteUrl_str">
							<input type="hidden" name="goodsUrl_str">
							<input type="hidden" name="bannerIdx" value="<?=$ban_row[idx]?>">
							<input type="hidden" name="parentcode" value="<?=$parentcode?>">
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width	="180"><?
											if($ban_row[type]==4)
											{
												$img = "../upload/design/$ban_row[img]";
												$img_info = @getimagesize($img);
												$swf_width = $img_info[0];
												$swf_height = $img_info[1];
												?><div align="center">
													<script language='javascript'>
														getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
													</script>
												</div><?
											}
											else
											{
												?><div align="center"><img src="../upload/design/<?=$ban_row[img]?>"></div><?
											}
											?></td>
											<td width="350">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="33%" height="25"> <div align="center"> <input class="radio" type="radio" name="gubun" value="0" <?if($ban_row[gubun]==0)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm3<?=$ban_cnt?>);">����Ʈ URL</div></td>
														<td height="33%"> <div align="center"> <input class="radio" type="radio" name="gubun" value="1" <?if($ban_row[gubun]==1)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm3<?=$ban_cnt?>);">��ǰ URL</div></td>
														<td width="33%" height="25"> <div align="center"> <input class="radio" type="radio" name="gubun" value="2" <?if($ban_row[gubun]==2)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm3<?=$ban_cnt?>);">Not URL</div></td>
													</tr>
													<tr>
														<td colspan="3">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td > <div align="center">http:// <input type="text" name="siteUrl" value="<?=$ban_row[siteUrl]?>"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$site_color?>" <?=$site_disabled?>><br><input type="radio" name="siteTarget" value="_parent" <? if ($ban_row[siteTarget] == "_parent") echo "checked";?>>����â <input type="radio" name="siteTarget" value="_blank" <? if ($ban_row[siteTarget] == "_blank") echo "checked";?>>��â <br>&nbsp;&nbsp;&nbsp;<b>ȭ����� �켱����</b> <input class="box" type="text" name="sunwi" value="<?=$ban_row[sunwi]?>" size=2> ��) 1~10 </div></td>
																	<td rowspan="2" width="60"> <div align="center"><a href="javascript:bannerSendit(document.bannerForm3<?=$ban_cnt?>,'&edit=1');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> <a href="javascript:bannerSendit(document.bannerForm3<?=$ban_cnt?>,'&del=1');"><img src="image/design_delete.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
																<tr>
																	<td > <div align="center"> <input type="text" name="goodsUrl" value="<?=$ban_row[goodsUrl]?>" readonly size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$goods_color?>" <?=$goods_disabled?>> <a href="javascript:selectGoods('document.bannerForm3<?=$ban_cnt?>.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="3"> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- bannerForm1 --><?
							}
							?>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" align=left>* ��ǰ��� ������ <b>����</b> ���� �űԵ�� *</td>
							</tr>
							<form name="bannerwriteForm5" method="post" action="category_design_ok.php?part=3"  enctype="multipart/form-data" >
							<input type="hidden" name="siteUrl_str">
							<input type="hidden" name="goodsUrl_str">
							<input type="hidden" name="parentcode" value="<?=$parentcode?>">
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="0" onClick="javascript:showSiteUrl(document.bannerwriteForm5);" checked>����Ʈ URL</div></td>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="1" onClick="javascript:showSiteUrl(document.bannerwriteForm5);">��ǰ URL</div></td>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="2" checked  onClick="javascript:showSiteUrl(document.bannerwriteForm5);">Not URL</div></td>
										</tr>
										<tr>
											<td colspan="3"> <div align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center">http:// <input type="text" name="siteUrl"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" disabled><input type="radio" name="siteTarget" value="_parent" checked>����â <input type="radio" name="siteTarget" value="_blank" >��â <br><input type="text" name="goodsUrl"  size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" readonly disabled> <a href="javascript:selectGoods('document.bannerwriteForm5.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></div></td>
														<td rowspan="2" width="60"> <div align="center"><a href="javascript:bannerwriteSendit(document.bannerwriteForm5);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
													</tr>
													<tr>
														<td> <div align="center"> <input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
													</tr>
												</table></div>
											</td>
										</tr>
										<tr>
											<td colspan="3" bgcolor="#FFF3E1"> <div align="center">gif , jpg , swf ,  ��밡�� (����ȭ ������ ���� 175 pixel) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="35"><br><img src="image/design_main_icon.gif" width="21" height="11"> ��ǰ��� ������ <b>ȭ���߾Ӻκ�</b> ���ʸ��</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="table_coll" width="300"> 
										<tr align="center">
											<td bgcolor="eeeeee">���ٿ� ��µ� �̹��� �� ����</td>
											<td><select name="midBannerCols" onchange="location.href='category_design_ok.php?part=6&parentcode=<?=$parentcode?>&val='+this.value"><option value="2" <? if ($cate_row[midBannerCols]==2) echo "selected";?>>2��</option><option value="3" <? if ($cate_row[midBannerCols]==3) echo "selected";?>>3��</option><option value="4" <? if ($cate_row[midBannerCols]==4) echo "selected";?>>4��</option></select></td>
										</tr>
									</table>
								</td>
							</tr><?
							$ban_qry = "select *from category_banner where position ='$parentcode' order by sunwi asc";
							$ban_result = @$MySQL->query($ban_qry);
							$ban_cnt =0;
							while($ban_row = mysql_fetch_array($ban_result))
							{
								$ban_cnt ++;
								if($ban_row[gubun]==0)
								{
									$site_color = "white";
									$goods_color = "#dddddd";
									$site_disabled = "";
									$goods_disabled = "disabled";
								}
								else if($ban_row[gubun]==1)
								{
									$site_color = "#dddddd";
									$goods_color = "white";
									$site_disabled = "disabled";
									$goods_disabled = "";
								}
								else
								{
									$site_color = "#dddddd";
									$goods_color = "#dddddd";
									$site_disabled = "disabled";
									$goods_disabled = "disabled";
								}
								?>
							<form name="bannerForm4<?=$ban_cnt?>" method="post" action="category_design_ok.php?part=4"  enctype="multipart/form-data" >
							<input type="hidden" name="siteUrl_str">
							<input type="hidden" name="goodsUrl_str">
							<input type="hidden" name="bannerIdx" value="<?=$ban_row[idx]?>">
							<input type="hidden" name="parentcode" value="<?=$parentcode?>">
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="180"> <?
											if($ban_row[type]==4)
											{
												$img = "../upload/design/$ban_row[img]";
												$img_info = @getimagesize($img);
												$swf_width = $img_info[0];
												$swf_height = $img_info[1];
												?><div align="center">
													<script language='javascript'>
														getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
													</script>
												</div><?
											}
											else
											{
												?><div align="center"><img src="../upload/design/<?=$ban_row[img]?>"> </div><?
											}
											?></td>
											<td width="350">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="33%" height="25"> <div align="center"> <input class="radio" type="radio" name="gubun" value="0" <?if($ban_row[gubun]==0)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm4<?=$ban_cnt?>);">����Ʈ URL</div></td>
														<td height="33%"> <div align="center"> <input class="radio" type="radio" name="gubun" value="1" <?if($ban_row[gubun]==1)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm4<?=$ban_cnt?>);">��ǰ URL</div></td>
														<td width="33%" height="25"> <div align="center"> <input class="radio" type="radio" name="gubun" value="2" <?if($ban_row[gubun]==2)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm4<?=$ban_cnt?>);">Not URL</div></td>
													</tr>
													<tr>
														<td colspan="3">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td > <div align="center">http:// <input type="text" name="siteUrl" value="<?=$ban_row[siteUrl]?>"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$site_color?>" <?=$site_disabled?>><br><input type="radio" name="siteTarget" value="_parent" <? if ($ban_row[siteTarget] == "_parent") echo "checked";?>>����â <input type="radio" name="siteTarget" value="_blank" <? if ($ban_row[siteTarget] == "_blank") echo "checked";?>>��â <br>&nbsp;&nbsp;&nbsp;<b>ȭ����� �켱����</b> <input class="box" type="text" name="sunwi" value="<?=$ban_row[sunwi]?>" size=2> ��) 1~10 </div></td>
																	<td rowspan="2" width="60"> <div align="center"><a href="javascript:bannerSendit(document.bannerForm4<?=$ban_cnt?>,'&edit=1');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> <a href="javascript:bannerSendit(document.bannerForm4<?=$ban_cnt?>,'&del=1');"><img src="image/design_delete.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
																<tr>
																	<td > <div align="center"> <input type="text" name="goodsUrl" value="<?=$ban_row[goodsUrl]?>" readonly size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$goods_color?>" <?=$goods_disabled?>> <a href="javascript:selectGoods('document.bannerForm4<?=$ban_cnt?>.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="3"> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- bannerForm1 --><?
							}
							?>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" align=left>* ��ǰ��� ������ <b>ȭ���߾Ӻκ�</b> �űԵ�� *</td>
							</tr>
							<form name="bannerForm4" method="post" action="category_design_ok.php?part=5"  enctype="multipart/form-data" >
							<input type="hidden" name="siteUrl_str">
							<input type="hidden" name="goodsUrl_str">
							<input type="hidden" name="parentcode" value="<?=$parentcode?>">
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="0" onClick="javascript:showSiteUrl(document.bannerForm4);" checked>����Ʈ URL</div></td>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="1" onClick="javascript:showSiteUrl(document.bannerForm4);">��ǰ URL</div></td>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="2" checked  onClick="javascript:showSiteUrl(document.bannerForm4);">Not URL</div></td>
										</tr>
										<tr>
											<td colspan="3"> <div align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center">http:// <input type="text" name="siteUrl"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" disabled><br><input type="radio" name="siteTarget" value="_parent" checked>����â <input type="radio" name="siteTarget" value="_blank" >��â <br><input type="text" name="goodsUrl"  size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" readonly disabled><a href="javascript:selectGoods('document.bannerForm4.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></div></td>
														<td rowspan="2" width="60"> <div align="center"><a href="javascript:bannerwriteSendit(document.bannerForm4);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
													</tr>
													<tr>
														<td> <div align="center"> <input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
													</tr>
												</table></div></td>
										</tr>
										<tr>
											<td colspan="3" bgcolor="#FFF3E1"> <div align="center">gif , jpg , swf ,  ��밡�� (�̹��� ���� ������ ���������� 4���϶� 180 pixel, 3���϶� 240px, 2���϶� 360px) </div></td>
										</tr>
									</table>
								</td>
							</tr></form>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
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