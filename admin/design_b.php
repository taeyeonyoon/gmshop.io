<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//���� Ÿ��Ʋ �̹��� ����
function mainSendit()
{
	var form=document.mainForm;
	if(form.mainTitleImg_bhtml[1].checked && form.mainTitleImg_content.value=="")
	{
		alert("�����̹��� ��ġ�� �� �±׸� �Է��� �ֽʽÿ�.");
		form.mainTitleImg_content.focus();
	}
	else
	{
		form.submit();
	}
}

//���� Ÿ��Ʋ �̹��� �±׻��/�̹������ ���
function showContent()
{
	var form=document.mainForm;
	if(form.mainTitleImg_bhtml[0].checked)
	{
		document.getElementById('titleImg1').style.display = "";
		document.getElementById('titleImg2').style.display = "";
		document.getElementById('titleImg3').style.display = "none";
	}
	else
	{
		document.getElementById('titleImg1').style.display = "none";
		document.getElementById('titleImg2').style.display = "none";
		document.getElementById('titleImg3').style.display = "";
	}
}

//�������� Ÿ��Ʋ �̹��� ����
function noticeSendit()
{
	var form=document.noticeForm;
	if(form.img.value=="")
	{
		alert("�̹����� ����� �ֽʽÿ�.");
	}
	else
	{
		form.submit();
	}
}

function nSubSendit2()
{
	var form=document.nSubForm2;
	form.submit();
}

//�����̹��� �ø��� ��â
function inputImg(Part)
{
	var form=document.writeForm;
	window.open("input_img.php?part="+Part,"","scrollbars=yes,left=50,top=200,width=420,height=350");
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

function showLayout()
{
	if (document.layoutForm.design_b_layout[0].checked == true)
	{
		document.getElementById("layout1").style.display = "";
	}
	else
	{
		document.getElementById("layout1").style.display = "none";
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="showContent();showLayout();">
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
							<? include "main_design_menu.php";?>
							<tr>
								<td colspan="2" height="10"></td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">B ȭ�� ����</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td width="80">���̾ƿ� 1</td>
											<td width="170"> <div align="center"><img src="image/design_b_view.gif" ></div></td>
											<td width="30"> <div align="center"></div></td>
											<td width="200"> <div align="center"><img src="image/design_b_view1.gif" ></div></td>
											<td width="70">&nbsp;</td>
										</tr>
										<tr>
											<td height=20 colspan="5"></td>
										</tr>
										<tr>
											<td width="80">���̾ƿ� 2</td>
											<td width="170"> <div align="center"><img src="image/design_b_view2.gif" ></div></td>
											<td width="30"> <div align="center"></div></td>
											<td width="200"> <div align="center"><img src="image/design_b_view2-1.gif" ></div></td>
											<td width="70">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="100"><br>
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" align="center" height="40">
												<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height="40"><b>- ���̾ƿ� 1</b> <br>* ���θ� Ÿ��Ʋ �̹��� ���<br>* �������� Ÿ��Ʋ �̹������<br>* �������� �� ��� ��� <br>* ��� ��� - ���θ��� ��ǰ���� ��� �� Ÿ�� ���<br><b>- ���̾ƿ� 2 </b><br>* ���� Ÿ��Ʋ �̹��� ��� <br>* ���� ��ũ�� ���� ��� (��������)<br><br>�� ���̾ƿ�2 ���� <b>������C</b> �κп��� ���������� ���������� ǥ���Ҽ��ִ� ���������� �ֽ��ϴ�. </td>
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
							<form name="layoutForm" method="post" action="design_ok.php?act=design_b&part=9">
							<tr>
								<td height=50 colspan="2" valign="top"><img src="image/design_main_icon.gif" width="21" height="11">���̾ƿ� &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="design_b_layout" value="1" onclick="showLayout();" <? if ($design[design_b_layout]==1) echo "checked";?>>���̾ƿ� 1 &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="design_b_layout" value="2" onclick="showLayout();" <? if ($design[design_b_layout]==2) echo "checked";?>>���̾ƿ� 2 &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.layoutForm.submit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
							</tr>
							</form>
							<tr id ="layout1">
								<td colspan="2">
									<table>
										<form name="noticeForm" method="post" action="design_ok.php?act=design_b&part=1"  enctype="multipart/form-data" >
										<tr>
											<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">�������� Ÿ��Ʋ </td>
										</tr>
										<tr>
											<td colspan="2" height="70">
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td width="200"> <div align="center"><img src="../upload/design/<?=$design[noticeTitleImg]?>"  > </div></td>
														<td width="300">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td><div align="center"><input type="file" name="img"   value=""  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
																	<td><a href="javascript:noticeSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
																</tr>
															</table>
														</td>
													</tr>
													<tr bgcolor="#FFF3E1">
														<td colspan="2"><div align="center">gif , jpg , ��밡�� (����ȭ ������ 196*35) </div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										</form><!-- noticeForm -->
										<form name="nSubForm2" method="post" action="design_ok.php?act=design_b&part=4"  enctype="multipart/form-data" >
										<tr>
											<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">�������� �غκ� �����̹��� </td>
										</tr>
										<tr>
											<td colspan="2" height="70">
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td width="200"> <div align="center"><img src="../upload/design/<?=$design[mainnSubTitle2]?>" width="196" height="100"> </div></td>
														<td width="300">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td><div align="center"> http:// <input type="text" name="mainnSubTitle2_url" value="<?=$design[mainnSubTitle2_url]?>"  size="30" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px;" <?=$site_disabled?>><br><input type="radio" name="mainnSubTitle2_target" value="_parent" <? if ($design[mainnSubTitle2_target] == "_parent") echo "checked";?>>����â <input type="radio" name="mainnSubTitle2_target" value="_blank" <? if ($design[mainnSubTitle2_target] != "_parent") echo "checked";?>>��â <br><input type="file" name="img"   value=""  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
																	<td><a href="javascript:nSubSendit2();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr bgcolor="#FFF3E1">
														<td colspan="2"><div align="center">gif , jpg , ��밡�� (����ȭ ������ 196*100) </div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
										</tr>
										</form>
									</table>
								</td>
							</tr>
							<form name="mainForm" method="post" action="design_ok.php?act=design_b&part=2"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">���� Ÿ��Ʋ �̹���</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="40">
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td bgcolor="#FFF3E1" width="150"> <div align="center">�� ��</div></td>
														<td> <div align="center"> <input type="radio" name="mainTitleImg_bhtml" value="0" <?if(!$design[mainTitleImg_bhtml])echo"checked";?> onclick="javascript:showContent();">�̹���</div></td>
														<td> <div align="center"> <input type="radio" name="mainTitleImg_bhtml" value="1" <?if($design[mainTitleImg_bhtml])echo"checked";?> onclick="javascript:showContent();">HTML </div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr id="titleImg1">
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="150"><?
											if($design[mainTitleImg_type]==4)
											{
												$img = "../upload/design/".$design[mainTitleImg];
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
												?><div align="center"><img src="../upload/design/<?=$design[mainTitleImg]?>" ></div><?
											}
											?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr id="titleImg2">
								<td colspan="2"><br>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td>
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td bgcolor="#ffffff"> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
													</tr>
													<tr>
														<td bgcolor="#FFF3E1"> <div align="center"> gif , jpg ,  swf ��밡�� (����ȭ ������ 520*275) <br>(���̾ƿ� 2 ���� ���λ����� 720) </div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table>
								</td>
							<tr>
							<tr id="titleImg3" >
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td>
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td bgcolor="#FFF3E1" width="100"> <div align="center">���� �̹���</div></td>
														<td width="400"><a href="javascript:inputImg('design');"><img src="image/design_upload.gif" width="46" height="18" border="0"></a></td>
													</tr>
													<tr>
														<td colspan="2"> <div align="center"> <textarea name="mainTitleImg_content" cols="95" rows="5"><?=$design[mainTitleImg_content]?></textarea></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="40"> <div align="center"><a href="javascript:mainSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- mainForm -->
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">���� Ÿ��Ʋ �̹��� ���ߵ�� ��� (���徿 �����̵� �Ǹ� ��Ÿ���ϴ�.)<br><font class="help">�� ������� �÷���ó�� ���̰� �ϴ� ��ũ��Ʈȿ���μ� �̹��� ��ü�ø��� <b>�̼��� ȭ��������� ����</b>�� �̸� �����մϴ�.<br>�� ���κ���Ʈ,��Ʈ�κ��� ��ũ���� �ڿ������� ���ϰ� �ɼ��� �ֽ��ϴ�.</font><br>
									<form name="baseForm" method="post" action="design_ok.php?act=design_b&part=12">
									<input type="hidden" name="position" value="<?=$position?>">
									<table class="table">
										<tr>
											<td align=center bgcolor=eeeeee width=100>��� ��뿩��</td>
											<td width=150 align=center> <input type="radio" name="bScrollUse" value="y" <? if ($design[bScrollUse]=="y") echo "checked";?>>�����&nbsp;&nbsp; <input type="radio" name="bScrollUse" value="n" <? if ($design[bScrollUse]!="y") echo "checked";?>>������ </td>
										</tr>
										<tr>
											<td align=center bgcolor=eeeeee width=100>��ũ�� �ð�</td>
											<td align=center><input name="designBwait" type="text" class="box" size=4 value="<?=$design[designBwait]?>"> ��</td>
										</tr>
										<tr>
											<td colspan=2 align=center><img src="image/design_save_i.gif" width="46" height="18" border="0" onclick="document.baseForm.submit();"></td>
										</tr>
									</table></form>
								</td>
							</tr><?
							$ban_qry = "select *from banner where position ='mainScroll'";
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
							<form name="bannerForm44<?=$ban_cnt?>" method="post" action="design_ok.php?act=design_b&part=10"  enctype="multipart/form-data" >
							<input type="hidden" name="siteUrl_str">
							<input type="hidden" name="goodsUrl_str">
							<input type="hidden" name="bannerIdx" value="<?=$ban_row[idx]?>">
							<input type="hidden" name="position" value="mainScroll">
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="100%"><?
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
										</tr>
										<tr>
											<td>
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
																	<td> <div align="center">http:// <input type="text" name="siteUrl" value="<?=$ban_row[siteUrl]?>"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$site_color?>" <?=$site_disabled?>> <input type="radio" name="siteTarget" value="_parent" <? if ($ban_row[siteTarget] == "_parent") echo "checked";?>>����â <input type="radio" name="siteTarget" value="_blank" <? if ($ban_row[siteTarget] == "_blank") echo "checked";?>>��â </div></td>
																</tr>
																<tr>
																	<td> <div align="center"> ��ǰURL ���ý� <input type="text" name="goodsUrl" value="<?=$ban_row[goodsUrl]?>" readonly size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: <?=$goods_color?>" <?=$goods_disabled?>> <a href="javascript:selectGoods('document.bannerForm44<?=$ban_cnt?>.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a><br>&nbsp;&nbsp;&nbsp;<b>ȭ����� �켱����</b> <input class="box" type="text" name="sunwi" value="<?=$ban_row[sunwi]?>" size=2> ��) 1~10 </div></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="3"> <div align="center"> �̹��� ��� <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"><a href="javascript:bannerSendit(document.bannerForm44<?=$ban_cnt?>,'&edit=1');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> <a href="javascript:bannerSendit(document.bannerForm44<?=$ban_cnt?>,'&del=1');"><img src="image/design_delete.gif" width="46" height="18" border="0"></a></div></td>
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
							</form><!-- bannerForm44 --><?
							}
							?>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;<img src="image/design_main_icon.gif" width="21" height="11">���� Ÿ��Ʋ �̹��� ���ߵ�� �űԵ��</td>
							</tr>
							<form name="bannerwriteForm5" method="post" action="design_ok.php?act=design_b&part=11"  enctype="multipart/form-data" >
							<input type="hidden" name="siteUrl_str">
							<input type="hidden" name="goodsUrl_str">
							<input type="hidden" name="position" value="mainScroll">
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
														<td> <div align="center">http:// <input type="text" name="siteUrl"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" disabled> <input type="radio" name="siteTarget" value="_parent" checked>����â <input type="radio" name="siteTarget" value="_blank">��â <br>��ǰURL ���ý�<input type="text" name="goodsUrl"  size="18" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: #dddddd" readonly disabled><a href="javascript:selectGoods('document.bannerwriteForm5.goodsUrl');"><img src="image/design_good.gif" width="46" height="18" border="0"></a></div></td>
														<td rowspan="2" width="60"> <div align="center"><a href="javascript:bannerwriteSendit(document.bannerwriteForm5);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
													</tr>
													<tr>
														<td> <div align="center"> �̹��� ��� <input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="3" bgcolor="#FFF3E1"> <div align="center">gif , jpg , swf  ��밡��<br></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							</form><!-- bannerwriteForm5 -->
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>