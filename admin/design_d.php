<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
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

//�������� ��뿩�� ����
function bpollSendit()
{
	document.pollForm1.submit();
}

//�������� �̹��� ����
function pollSendit(Obj)
{
	if(Obj.img.value=="")
	{
		alert("�̹����� ������ �ֽʽÿ�.");
	}
	else
	{
		Obj.submit();
	}
}

//�űԻ�ǰ ��� Ÿ��Ʋ �̹���
function titleimgSendit()
{
	var form=document.titleForm;
	if(form.img.value=="")
	{
		alert("�̹����� ������ �ֽʽÿ�.");
	}
	else
	{
		form.submit();
	}
}

//�űԻ�ǰ ��� ���� ����
function newlistSendit()
{
	var form=document.listForm;
	if(!numCheck(form.mainNewGoodsList.value))
	{
		alert("�űԻ�ǰ ��ϼ� ������ �ùٸ��� �ʽ��ϴ�.");
		form.mainNewGoodsList.focus();
	}
	else
	{
		form.submit();
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
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
								<td><img src="image/design_tit_d.gif"></td>
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
							<? include "main_design_menu.php";?>
							<tr>
								<td colspan="2" height="10"></td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">D ȭ�� ����</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td width="80">&nbsp;</td>
											<td width="170"> <div align="center"><img src="image/design_d_view.gif"></div></td>
											<td width="30"> <div align="center"></div></td>
											<td width="200"> <div align="center"><img src="image/design_d_view1.gif"></div></td>
											<td width="70">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="20">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" height="60">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" align="center" height="40">
												<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height="40">* ���ʺ��� - ��ǰ���� Ÿ����Ʈ ��� (���ο����� ����) <br>* �������� - �������� ���,�̻�� ���� �� Ÿ��Ʋ,��ư �̹���  <br>* �Ż�ǰ�� Ÿ��Ʋ�̹��� ���</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="35"><br><img src="image/design_main_icon.gif" width="21" height="11">��ʿ��� </td>
							</tr><?
							$ban_qry = "select *from banner where position ='left3' order by sunwi asc";
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
							<form name="bannerForm3<?=$ban_cnt?>" method="post" action="design_ok.php?act=design_d&part=1"  enctype="multipart/form-data" >
							<input type="hidden" name="siteUrl_str">
							<input type="hidden" name="goodsUrl_str">
							<input type="hidden" name="bannerIdx" value="<?=$ban_row[idx]?>">
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="150"><?
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
																	<td align="center"> <input type="text" name="goodsUrl" value="<?=$ban_row[goodsUrl]?>" readonly size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$goods_color?>" <?=$goods_disabled?>> <a href="javascript:selectGoods('document.bannerForm3<?=$ban_cnt?>.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></td>
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
								<td colspan="2" align=center>* ���� ���ε�� *</td>
							</tr>
							<form name="bannerwriteForm3" method="post" action="design_ok.php?act=design_d&part=2"  enctype="multipart/form-data" >
							<input type="hidden" name="siteUrl_str">
							<input type="hidden" name="goodsUrl_str">
							<tr>
								<td colspan="2">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="0" onClick="javascript:showSiteUrl(document.bannerwriteForm3);">����Ʈ URL</div></td>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="1" onClick="javascript:showSiteUrl(document.bannerwriteForm3);">��ǰ URL</div></td>
											<td width="166" bgcolor="#FFF3E1"> <div align="center"> <input type="radio" name="gubun" value="2" checked  onClick="javascript:showSiteUrl(document.bannerwriteForm3);">Not URL</div></td>
										</tr>
										<tr>
											<td colspan="3"><div align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center">http:// <input type="text" name="siteUrl"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" disabled><input type="radio" name="siteTarget" value="_parent" checked>����â <input type="radio" name="siteTarget" value="_blank" >��â <br><input type="text" name="goodsUrl"  size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" readonly disabled><a href="javascript:selectGoods('document.bannerwriteForm3.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></div></td>
														<td rowspan="2" width="60"> <div align="center"><a href="javascript:bannerwriteSendit(document.bannerwriteForm3);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
													</tr>
													<tr>
														<td> <div align="center"> <input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
													</tr>
												</table></div>
											</td>
										</tr>
										<tr>
											<td colspan="3" bgcolor="#FFF3E1"> <div align="center">gif , jpg , swf  ��밡�� (����ȭ ������ ���� 175 pixel) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form>
							<form name="pollForm1" method="post" action="design_ok.php?act=design_d&part=3"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" height="40"><br><img src="image/design_main_icon.gif" width="21" height="11">�������� </td>
							</tr>
							<tr>
								<td colspan="2" height="50">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" align="center" width="200"> <input type="radio" name="bPoll" value="1" <?if($design[bPoll]){echo"checked";}?> >�������� ���</td>
											<td bgcolor="#FFF3E1" align="center" width="200"> <input type="radio" name="bPoll" value="0" <?if(!$design[bPoll]){echo"checked";}?>>�������� �̻��</td>
											<td bgcolor="#FFF3E1" align="center" width="100"> <a href="javascript:bpollSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- pollForm1 -->
							<form name="pollForm2" method="post" action="design_ok.php?act=design_d&part=4"  enctype="multipart/form-data" >
							<tr id="title">
								<td colspan="2" height="100">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center"><b>�������� Ÿ��Ʋ �̹���</b></div></td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[mainPollTitle]?>"> </div></td>
											<td width="350">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:pollSendit(document.pollForm2);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 175*30) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- pollForm2 -->
							<form name="pollForm3" method="post" action="design_ok.php?act=design_d&part=5"  enctype="multipart/form-data" >
							<tr id="write">
								<td colspan="2" height="100">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center"><b>'��ǥ�ϱ�' �̹���</b></div></td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[mainPollWrite]?>"> </div></td>
											<td width="350">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:pollSendit(document.pollForm3);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 57*15) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- pollForm3 -->
							<form name="pollForm4" method="post" action="design_ok.php?act=design_d&part=6"  enctype="multipart/form-data" >
							<tr id="result">
								<td colspan="2" height="100">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center"><b>'�������' �̹���</b></div></td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[mainPollResult]?>"  > </div></td>
											<td width="350">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:pollSendit(document.pollForm4);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 57*15) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp; </td>
							</tr>
							</form><!-- pollForm4 -->
							<form name="titleForm" method="post" action="design_ok.php?act=design_d&part=9"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">�űԻ�ǰ Ÿ��Ʋ �̹���</td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[mainNewGoodsTitle]?>" > </div></td>
											<td width="300">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:titleimgSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 175*30) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- titleForm -->
							<form name="listForm" method="post" action="design_ok.php?act=design_d&part=8"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" height="40"><img src="image/design_main_icon.gif" width="21" height="11">�űԻ�ǰ ��� ���� (<a href="goods_position.php?part=mainnew&position=3"><u>���� �űԻ�ǰ�� ��ǰ�����ϱ�</u></a>)</td>
							</tr>
							<tr>
								<td colspan="2" height="50">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="200" bgcolor="#FFF3E1"> <div align="center">�ű� ��ǰ ��� ��</div></td>
											<td width="300"><input type="text" name="mainNewGoodsList" size="10" value="<?=$design[mainNewGoodsList]?>" class="box" <?=__ONLY_NUM?>>�� <a href="javascript:newlistSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp; </td>
							</tr>
							</form>
							<form name="freeForm" method="post" action="design_ok.php?act=design_d&part=12"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">������ ��ǰ Ÿ��Ʋ �̹���<br>
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="200" bgcolor="#FFF3E1"> <div align="center">ȭ�� ����</div></td>
											<td width="300"><input type="checkbox" name="bmainFreeTitle" value="y" <? if ($design[bmainFreeTitle]=="y") echo "checked";?>>�����</td>
										</tr>
										<tr>
											<td width="200" bgcolor="#FFF3E1"> <div align="center">������ ��ǰ����</div></td>
											<td width="300"><input type="text" name="mainFreeGoodsList" size="5" value="<?=$design[mainFreeGoodsList]?>" class="box" <?=__ONLY_NUM?>>�� <a href="javascript:document.freeForm.submit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[mainFreeTitle]?>" > </div></td>
											<td width="300">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:document.freeForm.submit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 175*30) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- freeForm -->
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp; </td>
				</tr>
				<tr>
					<td height=30 colspan="2">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>