<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//���� ���� ����
function appSendit()
{
	document.appForm.submit();
}

//���� Ȱ��/��Ȱ��
function appShow()
{
	var form=document.appForm;
	if(form.layApp[0].checked)
	{
		document.getElementById('imgshow').style.display  ="";
		document.getElementById('htmlshow').style.display ="none";
	}
	else
	{
		document.getElementById('imgshow').style.display  ="none";
		document.getElementById('htmlshow').style.display ="";
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

//�����̹��� �ø��� ��â
function inputImg(Part)
{
	var form=document.contentForm;
	window.open("input_design_img.php?part="+Part,"","scrollbars=yes,left=200,top=200,width=420,height=350");
}

//���� ����
function contentSendit()
{
	var form=document.contentForm;
	form.submit();
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="javascript:appShow();">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "design";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
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
								<td rowspan="3" width="200"><img src="image/design_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �������� �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
								<td width='1' bgcolor='dadada'></td>
							</tr>
							<tr>
								<td><img src="image/design_tit_b.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height='10'></td>
				</tr>
				<tr>
					<td valign="top">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<? include "good_design_menu.php";?>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" height="25" valign="top"> <p><img src="image/design_main_icon.gif" width="21" height="11">B ȭ�� ����</p></td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td width="80">&nbsp;</td>
											<td width="170"> <div align="center"><img src="image/design_g_view_b.gif"></div></td>
											<td width="30">&nbsp;</td>
											<td width="200"> <div align="center"><img src="image/design_g_view_b1.gif" ></div></td>
											<td width="70">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="60">
									<table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff" height="50">
										<tr>
											<td bgcolor="#FFF3E1">* ī�װ� ���� �޴��� ��뿩�� ���� <br>* �Խ��� Ÿ��Ʋ �̹��� <br>* ��� - ��ǰ���� ��ʳ� Ÿ ����Ʈ ���ʱ��� ����</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top">&nbsp;</td>
							</tr>
							<form name="wForm" method="post" action="design_goods_ok.php?act=design_good_b&part=6">
							<tr>
								<td colspan="2" height="40"> <img src="image/design_main_icon.gif" width="21" height="11">���� �޴� ��뿩�� </td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="100%" bgcolor="#FFF3E1"> <div align="center"><b>��ǰ��� ������������</b> ���� ī�װ� ���� �������� �޴��� ȭ�������ϱ� <br>(��ɻ��� <b>��ǰ��� ������������</b> ��������, �űԻ�ǰ��, �Խ���, ����) <br>(�� ����� ������ <b>ī�װ� ������ ������ ������</b>�� <b>�����κе�</b> ���������� �ٹм� �ֵ��� �ϱ� �����Դϴ�. </div></td>
										</tr>
										<tr>
											<td width="100%">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"> <input type="radio" name="bGoodsList_left" value="y" <? if ($design_goods[bGoodsList_left]=="y") echo "checked";?>>��ɻ���� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="bGoodsList_left" value="n" <? if ($design_goods[bGoodsList_left]=="n") echo "checked";?>>��ɻ����� &nbsp;&nbsp;&nbsp;&nbsp;<img src="image/design_save_i.gif" width="46" height="18" onclick="document.wForm.submit();" style="cursor:pointer"></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top">&nbsp;</td>
							</tr>
							</form>
							<form name="searchForm1" method="post" action="design_goods_ok.php?act=design_good_b&part=5"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" valign="top" height="35"><img src="image/design_main_icon.gif" width="21" height="11"> �Խ��� Ÿ��Ʋ </td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design_goods[SubBbsTitle]?>" > </div></td>
											<td width="350">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"> <input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:searchForm1.submit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 175 * 30) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top">&nbsp;</td>
							</tr>
							</form>
							<form name="appForm" method="post" action="design_goods_ok.php?act=design_good_b&part=1"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" height="40"> <img src="image/design_main_icon.gif" width="21" height="11">�� ��</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" width="150"> <div align="center">�� ��</div></td>
											<td> <div align="center"> <input type="radio" name="layApp" value="1" <?if($design_goods[layApp])echo"checked";?> onclick="javascript:appShow();">�̹���</div></td>
											<td> <div align="center"> <input type="radio" name="layApp" value="0" <?if(!$design_goods[layApp])echo"checked";?> onclick="javascript:appShow();">HTML </div></td>
											<td> <div align="center"><a href="javascript:appSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr id="imgshow">
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td colspan="2">�� ����â���� ��ũ�� ���� http://�ּ�~~ �ʿ���� �ش����ϸ� ���� ex) goods_list.php </td>
										</tr><?
										$ban_qry = "select *from banner where position ='layer' order by sunwi asc";
										$ban_result = $MySQL->query($ban_qry);
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
										<form name="bannerForm44<?=$ban_cnt?>" method="post" action="design_goods_ok.php?act=design_good_b&part=2"  enctype="multipart/form-data" >
										<input type="hidden" name="siteUrl_str">
										<input type="hidden" name="goodsUrl_str">
										<input type="hidden" name="bannerIdx" value="<?=$ban_row[idx]?>">
										<tr>
											<td colspan="2" height="70">
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td><?
														if($ban_row[type]==4)
														{
															$img = "../upload/design/".$ban_row[img];
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
																	<td width="33%" height="25"> <div align="center"> <input class="radio" type="radio" name="gubun" value="0" <?if($ban_row[gubun]==0)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm44<?=$ban_cnt?>);">����Ʈ URL</div></td>
																	<td height="33%"> <div align="center"> <input class="radio" type="radio" name="gubun" value="1" <?if($ban_row[gubun]==1)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm44<?=$ban_cnt?>);">��ǰ URL</div></td>
																	<td width="33%" height="25"> <div align="center"> <input class="radio" type="radio" name="gubun" value="2" <?if($ban_row[gubun]==2)echo"checked";?> onClick="javascript:showSiteUrl(document.bannerForm44<?=$ban_cnt?>);">Not URL</div></td>
																</tr>
																<tr>
																	<td colspan="3">
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
																			<tr>
																				<td> <div align="center">http:// <input type="text" name="siteUrl" value="<?=$ban_row[siteUrl]?>"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$site_color?>" <?=$site_disabled?>></div></td>
																				<td rowspan="2" width="60"> <div align="center"><a href="javascript:bannerSendit(document.bannerForm44<?=$ban_cnt?>,'&edit=1');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> <a href="javascript:bannerSendit(document.bannerForm44<?=$ban_cnt?>,'&del=1');"><img src="image/design_delete.gif" width="46" height="18" border="0"></a></div></td>
																			</tr>
																			<tr>
																				<td> <div align="center"> <input type="radio" name="siteTarget" value="_parent" <? if ($ban_row[siteTarget] == "_parent") echo "checked";?>>����â <input type="radio" name="siteTarget" value="_blank" <? if ($ban_row[siteTarget] == "_blank") echo "checked";?>>��â <br>&nbsp;&nbsp;&nbsp;<b>ȭ����� �켱����</b> <input class="box" type="text" name="sunwi" value="<?=$ban_row[sunwi]?>" size=2> ��) 1~10 </div></td>
																			</tr>
																			<tr>
																				<td > <div align="center"> <input type="text" name="goodsUrl" value="<?=$ban_row[goodsUrl]?>" readonly size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$goods_color?>" <?=$goods_disabled?>> <a href="javascript:selectGoods('document.bannerForm44<?=$ban_cnt?>.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></div></td>
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
										</form><!-- bannerForm44 --><?
										}
										?>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<form name="bannerwriteForm5" method="post" action="design_goods_ok.php?act=design_good_b&part=3"  enctype="multipart/form-data" >
										<input type="hidden" name="siteUrl_str">
										<input type="hidden" name="goodsUrl_str">
										<tr>
											<td colspan="2" align=center>* ���� ���ε�� *</td>
										</tr>
										<tr>
											<td colspan="2">
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="0" onClick="javascript:showSiteUrl(document.bannerwriteForm5);">����Ʈ URL</div></td>
														<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="1" onClick="javascript:showSiteUrl(document.bannerwriteForm5);">��ǰ URL</div></td>
														<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="2" checked  onClick="javascript:showSiteUrl(document.bannerwriteForm5);">Not URL</div></td>
													</tr>
													<tr>
														<td colspan="3" align="center">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td> <div align="center">http:// <input type="text" name="siteUrl" maxlength="32" size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" disabled> <input type="radio" name="siteTarget" value="_parent" checked>����â <input type="radio" name="siteTarget" value="_blank">��â <br><input type="text" name="goodsUrl" maxlength="32" size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" readonly disabled> <a href="javascript:selectGoods('document.bannerwriteForm5.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></div></td>
																	<td rowspan="2" width="60"> <div align="center"><a href="javascript:bannerwriteSendit(document.bannerwriteForm5);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
																<tr>
																	<td> <div align="center"> <input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="3" bgcolor="#FFF3E1"> <div align="center">gif , jpg , swf ��밡�� (����ȭ ������ ���� : 175 px) </div></td>
													</tr>
												</table>
											</td>
										</tr>
										</form><!-- bannerwriteForm5 -->
									</table>
								</td>
							</tr>
							<form name="contentForm" method="post" action="design_goods_ok.php?act=design_good_b&part=4"  enctype="multipart/form-data" >
							<tr id="htmlshow">
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" width="100"> <div align="center">���� �̹���</div></td>
											<td width="400"><a href="javascript:inputImg('layContent');"><img src="image/design_upload.gif" width="46" height="18" border="0"></a></td>
										</tr>
										<tr>
											<td colspan="2"> <div align="center"> <textarea name="layContent" class="text" cols="70" rows="5"><?=$design_goods[layContent]?></textarea></div></td>
										</tr>
										<tr>
											<td height="30" colspan="2"> <div align="center"><a href="javascript:contentSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- contentForm -->
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