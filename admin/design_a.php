<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
// ���� �ΰ� �̹��� ���
function logoSendit()
{
	var form=document.logoForm;
	if(form.img.value=="")
	{
		alert("�̹����� ������ �ֽʽÿ�.");
	}
	else
	{
		form.submit();
	}
}

// �޴� �̹��� ���
function menuSendit(Obj)
{
	if(Obj.img1.value=="" && Obj.img2.value=="")
	{
		alert("�̹����� ����� �ֽʽÿ�.");
	}
	else
	{
		Obj.submit();
	}
}

// ���� �˻� ������ ���� ����
function searchSendit(Obj)
{
	Obj.submit();
}

// ���»� ���� ���� 
function titleimgSendit(Obj)
{
	Obj.siteUrl_str.value = Obj.siteUrl.value;
	Obj.submit();
}

// ���� ����
function bannerwriteSendit(Obj)
{
	if(Obj.siteUrl.value=="")
	{
		alert("����Ʈ ��θ� �Է��� �ֽʽÿ�.");
		Obj.siteUrl.focus();
	}
	else if(Obj.img.value=="")
	{
		alert("�̹����� ������ �ֽʽÿ�.");
	}
	else
	{
		Obj.siteUrl_str.value = Obj.siteUrl.value;
		Obj.submit();
	}
}

// ���� ����
function bannerSendit(Obj,Url)
{
	Obj.siteUrl_str.value = Obj.siteUrl.value;
	Obj.action +=Url;
	Obj.submit();
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
			<table width="100%" height="500" border="0" cellspacing="0" cellpadding="0" align="center">
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
								<td><img src="image/design_tit_a.gif"></td>
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
								<td colspan="2" height="30">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">A ȭ�� ����</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td height='60'><div align='center'><img src="image/design_a_view1.gif" ></div></td>
										</tr>
									</table><br>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="60">
									<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" align="center" height="40">
												<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height="40">* ��� �κ� ���̾ƿ� 1,2 ����<br>* �����ΰ� �̹��� ���<br>* ��� �޴� �̹��� - (��) �α��� / ȸ������ / �Խ���..�� ��ǰī�װ� ���� �޴�<br>* ��ǰ�˻� - Ÿ��Ʋ�̹��� / �˻���ư / �󼼰˻���ư<br>* ��� ��� - (��)�̺�Ʈ / ��ǰ�� / ������</td>
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
							<form name="layForm" method="post" action="design_ok.php?act=design_a&part=41">
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">��ܺκ� ���̾ƿ� ����</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr align="center" height="150">
											<td width="150" bgcolor="#FFF3E1">���̾ƿ� 1 <input type="radio" name="topSkin" value="1" <? if ($design[topSkin]==1) echo "checked";?> ></td>
											<td><img src="image/design_a_lay1.jpg"></td>
										</tr>
										<tr align="center" height="150">
											<td width="150" bgcolor="#FFF3E1">���̾ƿ� 2 <input type="radio" name="topSkin" value="2" <? if ($design[topSkin]==2) echo "checked";?> ></td>
											<td><img src="image/design_a_lay2.jpg"></td>
										</tr>
										<tr align="center" height="30">
											<td bgcolor="#FFF3E1">��� ���̾ƿ� 1 ����</td>
											<td>����ȭ 6���ϰ�� �̹��� 1���� ���� 120px  (120 x 6 = <b>720</b>)</td>
										</tr>
										<tr align="center" height="30">
											<td bgcolor="#FFF3E1">��� ���̾ƿ� 2 ����</td>
											<td>����ȭ 6���ϰ�� �̹��� 1���� ���� 150px  (150 x 6 = <b>900</b>)</td>
										</tr>
										<tr align="center">
											<td colspan="2" align="center"><img src="image/design_save_i.gif" width="46" height="18" border="0" onclick="document.layForm.submit();" style="cursor:pointer"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top">&nbsp;</td>
							</tr>
							</form>
							<form name="logoForm" method="post" action="design_ok.php?act=design_a&part=1"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">�ΰ� �̹���</td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="150"><?
											if($design[mainLogoImg_type]==4)
											{
												$img = "../upload/design/".$design[mainLogoImg];
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
												?><div align="center"><img src="../upload/design/<?=$design[mainLogoImg]?>"></div><?
											}
											?></td>
											<td width="350">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td><div align="center"><input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:logoSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center">gif , jpg ,  swf ��밡�� (����ȭ ������ 180 * 65 pixel) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							</form><!-- //logoForm -->
							<form name="favoriteForm" method="post" action="design_ok.php?act=design_a&part=38"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">���ã�� �̹���</td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="150"><div align="center"><img src="../upload/design/<?=$design[mainFavorite]?>"> </div></td>
											<td width="350">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td><div align="center"><input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:favoriteForm.submit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"><div align="center">gif , jpg ��밡�� (����ȭ ������ 88 x 17 pixel) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							</form><!-- //logoForm -->
							<tr>
								<td colspan="2" valign="top" height="35"><img src="image/design_main_icon.gif" width="21" height="11">�� ��</td>
							</tr>
							<tr>
								<td colspan="2" height="210">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td>
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr bgcolor="#FFF3E1">
														<td bgcolor="#FFF3E1" width="50"> <div align="center">����</div></td>
														<td bgcolor="#FFF3E1"> <div align="center">���콺 �ƿ� </div></td>
														<td> <div align="center">���콺 ���� </div></td>
														<td width="50"> <div align="center">����</div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="5"></td>
										</tr><?
										$menuTitleArr = Array("ȸ������","�α���","�α׾ƿ�","����������","��ٱ���","�ֹ���ȸ");
										for($i=0;$i<6;$i++)
										{
											$formIndex	= $i+1;		//�� �ε���
											$part		= $i+2;		//part ��
											$menuMoutIndex	= ($formIndex)*2-1;
											$menuMoverIndex = ($formIndex)*2;
											$imgIndexMout	= "mainMenuImg$menuMoutIndex";
											$imgIndexMover	= "mainMenuImg$menuMoverIndex";
											?>
										<form name="menuForm<?=$formIndex?>" method="post" action="design_ok.php?act=design_a&part=<?=$part?>"  enctype="multipart/form-data" >
										<tr>
											<td>
												<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td width="50" bgcolor="#FFF3E1"><div align="center"><p><?=$menuTitleArr[$i]?></p></div></td>
														<td><div align="center"><img src="../upload/design/<?=$design[$imgIndexMout]?>" ><br><input type="file" name="img1" size="14" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><div align="center"><img src="../upload/design/<?=$design[$imgIndexMover]?>" ><br><input type="file" name="img2" size="14" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td width="50"><div align="center"><a href="javascript:menuSendit(document.menuForm<?=$formIndex?>);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></div></td>
													</tr>
												</table>
											</td>
										</tr>
										</form><!-- menuForm1 -->
										<tr>
											<td height="5"></td>
										</tr><?
										}
										?>
										<tr>
											<td>
												<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr bgcolor="#FFF3E1">
														<td bgcolor="#FFF3E1"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 67*20) </div></td>
													</tr>
												</table>
											</td>
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
				<form name="searchForm4" method="post" action="design_ok.php?act=design_a&part=42"  enctype="multipart/form-data" >
				<tr>
					<td colspan="2" height="35">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="image/design_main_icon.gif" width="21" height="11">��ǰ�˻� Ÿ��Ʋ </td>
				</tr>
				<tr>
					<td colspan="2" height="35" valign="top">
						<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
							<tr>
								<td width="150"><div align="center"><img src="../upload/design/<?=$design[mainGoodsSearchTitle]?>" ></div></td>
								<td width="350">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><div align="center"><input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
											<td><a href="javascript:searchSendit(document.searchForm4);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#FFF3E1">
								<td colspan="2"><div align="center">gif , jpg ��밡�� (����ȭ ������ ���� 20 pixel ����) </div></td>
							</tr>
						</table>
					</td>
				</tr>
				</form><!-- searchForm4 -->
				<form name="searchForm2" method="post" action="design_ok.php?act=design_a&part=10"  enctype="multipart/form-data" >
				<tr>
					<td colspan="2" height="35">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="image/design_main_icon.gif" width="21" height="11">��ǰ �˻� ã�� ��ư</td>
				</tr>
				<tr>
					<td colspan="2" height="35" valign="top">
						<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
							<tr>
								<td width="150"><div align="center"><img src="../upload/design/<?=$design[mainGoodsSearchButton]?>" ></div></td>
								<td width="350">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><div align="center"><input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
											<td><a href="javascript:searchSendit(document.searchForm2);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#FFF3E1">
								<td colspan="2"><div align="center">gif , jpg ��밡�� (����ȭ ������ ���� 20 pixel ����) </div></td>
							</tr>
						</table>
					</td>
				</tr>
				</form><!-- searchForm2 -->
				<form name="searchForm3" method="post" action="design_ok.php?act=design_a&part=11"  enctype="multipart/form-data" >
				<tr>
					<td colspan="2" height="35">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="image/design_main_icon.gif" width="21" height="11">�� �˻� ã�� ��ư</td>
				</tr>
				<tr>
					<td colspan="2" height="35" valign="top">
						<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
							<tr>
								<td width="150"><div align="center"><img src="../upload/design/<?=$design[mainGoodsSearchButton2]?>" ></div></td>
								<td width="350">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><div align="center"><input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
											<td><a href="javascript:searchSendit(document.searchForm3);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#FFF3E1">
								<td colspan="2"><div align="center">gif , jpg ��밡�� (����ȭ ������ ���� 20 pixel ����) </div></td>
							</tr>
						</table>
					</td>
				</tr>
				</form><!-- searchForm2 -->
				<form name="bmainTopMenuForm" method="post" action="design_ok.php?act=design_a&part=14">
				<tr>
					<td colspan="2" height=30>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="image/design_main_icon.gif" width="21" height="11">��ܺ���&nbsp; (�ݵ�� ������ 6���� �ʿ�� ������ �ش� ���̾ƿ� ���̺� �ִ�ũ�⿡ ���缭 ����ؾ� �մϴ�.)</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" height="25">
						<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
							<tr>
								<td colspan="2"><img src="image/design_a_top.gif" align="center"></td>
							</tr>
							<tr height="50">
								<td colspan="2" valign="top"  align="center"><input type="radio" name="bmainTopMenu"  value="1" <? if ($design[bmainTopMenu] ==1) echo "checked";?>>��ܺ��� �����&nbsp;<input type="radio" name="bmainTopMenu"  value="0" <? if ($design[bmainTopMenu] ==0) echo "checked";?>>��ܺ��� ������(ȭ�鿡 ��Ÿ���� ����) &nbsp;<a href="javascript:bmainTopMenuForm.submit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				</form>
				<tr>
					<td colspan="2" valign="top" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="help">�� ����â���� ��ũ�� ���� <b>http://�ּ�~~ �ʿ���� �ش����ϸ�</b> ���� ex) goods_list.php </font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="help">�� ž�κ� <b>��Ų1</b>�� ��� ž�޴� ������ �� 720 px, <b>��Ų2</b>�� ��� ž�޴� ������ 900 px , �޴��� ��ϰ����� ������ ������ <b>��Ų�� ������</b>�� ������ ������ �˴ϴ�.</font><br>&nbsp;&nbsp;Ŀ�´�Ƽ : community.php<br><br></td>
				</tr><?
				$ban_qry = "select *from banner where position ='topbanner' order by idx asc";
				$ban_result = $MySQL->query($ban_qry);
				$ban_cnt =0;
				while($ban_row = mysql_fetch_array($ban_result))
				{
					$ban_cnt ++;
					$img = "../upload/design/$ban_row[img]";
					$img_info = getimagesize($img);
					$swf_width = $img_info[0];
					$swf_height = $img_info[1];
					?>
				<form name="titleForm<?=$ban_cnt?>" method="post" action="design_ok.php?act=design_a&part=12"  enctype="multipart/form-data" >
				<input type="hidden" name="bannerIdx" value="<?=$ban_row[idx]?>">
				<input type="hidden" name="siteUrl_str" value="<?=$ban_row[siteUrl]?>">
				<tr>
					<td colspan="2" height="70"><br>
						<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
							<tr>
								<td width="120"><?
								if($ban_row[type]==4)
								{
									?><div align="center">
										<script language='javascript'>
											getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
										</script>
									</div><?
								}
								else
								{
									?><div align="center"><img src="../upload/design/<?=$ban_row[img]?>" ></div><?
								}
								?></td>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><div align="center"><input type="text" name="siteUrl" value="<?=$ban_row[siteUrl]?>"   size="30" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"><br><input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"><input type="radio" name="siteTarget" value="_parent" <? if ($ban_row[siteTarget] == "_parent") echo "checked";?>>����â <input type="radio" name="siteTarget" value="_blank" <? if ($ban_row[siteTarget] == "_blank") echo "checked";?>>��â </div></td>
											<td><a href="javascript:titleimgSendit(document.titleForm<?=$ban_cnt?>);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a>&nbsp;&nbsp;<a href="javascript:bannerSendit(document.titleForm<?=$ban_cnt?>,'&del=1');"><img src="image/design_delete.gif" width="46" height="18" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#FFF3E1">
								<td colspan="2"><div align="center">gif , jpg , swf  ��밡��</div></td>
							</tr>
						</table>
					</td>
				</tr>
				</form><!-- titleForm --><?
				}
				?>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" align=center>* ���� ���ε�� *</td>
				</tr>
				<form name="bannerwriteForm5" method="post" action="design_ok.php?act=design_a&part=13"  enctype="multipart/form-data" >
				<input type="hidden" name="siteUrl_str">
				<tr>
					<td colspan="2">
						<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
							<tr>
								<td colspan="3"><div align="center">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><div align="center"><input type="text" name="siteUrl"  size="20" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"><br></div></td>
											<td rowspan="2" width="60"><div align="center"><a href="javascript:bannerwriteSendit(document.bannerwriteForm5);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
										</tr>
										<tr>
											<td><div align="center"><input type="file" name="img"  size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"><input type="radio" name="siteTarget" value="_parent" checked>����â <input type="radio" name="siteTarget" value="_blank" >��â </div></td>
										</tr>
									</table></div>
								</td>
							</tr>
							<tr>
								<td colspan="3" bgcolor="#FFF3E1"><div align="center">gif , jpg , swf(swf�� ��� ���۽� ���������� ��ũ�� �ɾ��ּž� �մϴ�) ��밡�� (����ȭ ������ 120*40 ) </div></td>
							</tr>
						</table>
					</td>
				</tr>
				</form><!-- bannerwriteForm5 -->
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