<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//���� ī�װ� Ÿ��Ʋ �̹��� ����,����
function titleimgSendit()
{
	var form=document.cateForm;
	if(form.img.value=="")
	{
		alert("�̹����� ������ �ֽʽÿ�.");
	}
	else
	{
		form.submit();
	}
}

//ī�װ� ����,����
function maxcateSendit()
{
	var form=document.maxcateForm;
	if(form.mainMaxcateH.value=="")
	{
		alert("ī�װ� ���̸� �Է��� �ֽʽÿ�.");
		form.mainMaxcateH.focus();
	}
	else if(!numCheck(form.mainMaxcateH.value))
	{
		alert("ī�װ� ���� ������ �ùٸ��� �ʽ��ϴ�.");
		form.mainMaxcateH.focus();
	}
	else
	{
		form.submit();
	}
}

//// �α��� ���� �̹��� 
function mainLogin(field)
{
	form = document.mainLoginForm;
	form.action = form.action + "&field="+field;
	form.submit();
}

function login_bg()
{
	form = document.mainLoginForm;
	form.action = "design_ok.php?act=design_c&part=7";
	form.submit();
}
//-->
</script>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
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
								<td><img src="image/design_tit_c.gif"></td>
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
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">C ȭ�� ����</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td width="80">&nbsp;</td>
											<td width="170"> <div align="center"><img src="image/design_c_view.gif" ></div></td>
											<td width="30"> <div align="center"></div></td>
											<td width="200"> <div align="center"><img src="image/design_c_view1.gif"></div></td>
											<td width="70">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="60">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" align="center" height="40">
												<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height="40"> * ��ǰ ī�װ� - ���� �������� ��︮�� ��ǰī�װ� Ÿ��Ʋ �̹��� �� ���� ����<br>* �α��� ���� �̹��� ���<br>* �������׺κ� ��ġ���� ���� </td>
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
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11"> �������� �κ� ������ ������ ������ (ī�װ� ������ �κ�) <br>&nbsp;&nbsp;(�⺻������ <b>������ B</b> �κп� ��ġ�ϸ� B�κп��� <b>�������� ������ϴ� ���̾ƿ� ����</b>�� ���� �ؾ��մϴ�.) <br>&nbsp;&nbsp;(��ġ������ <b>�������� Ÿ��Ʋ �̹��� �����ȼ��� 175~180�ȼ��� ����</b>�ؾ� �մϴ�.) <br><br>&nbsp;&nbsp;<img src="image/design_c_notice.jpg" align=middle><input type="radio" name="bNoticeLeft" value="y" <? if ($design[bNoticeLeft]=="y") echo "checked";?> onclick="location.href='design_ok.php?act=design_c&part=6&bNoticeLeft='+this.value">��ġ ������&nbsp;&nbsp;<input type="radio" name="bNoticeLeft" value="n" <? if ($design[bNoticeLeft]!="y") echo "checked";?> onclick="location.href='design_ok.php?act=design_c&part=6&bNoticeLeft='+this.value">��ġ �������� </td>
							</tr>
							<tr>
								<td colspan="2" valign="top">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11"> �α��� ���� �̹���</td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<form name="mainLoginForm" method="post" action="design_ok.php?act=design_c&part=4"  enctype="multipart/form-data" >
									<table width="750" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td colspan=2 bgcolor="#FFF3E1" height=20>�α��� ���̵�</td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[LoginIdBtn]?>"> </div></td>
											<td width="600">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"><input type="file" name="img[]" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="#;" onclick="mainLogin('LoginIdBtn');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> &nbsp;gif , jpg   ��밡�� (����ȭ ������ 42 x 13 pixel)</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan=2 bgcolor="#FFF3E1" height=20>�α��� �н�����</td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[LoginPwBtn]?>"> </div></td>
											<td width="600">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"><input type="file" name="img[]" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="#;" onclick="mainLogin('LoginPwBtn');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> &nbsp;gif , jpg   ��밡�� (����ȭ ������ 42 x 13 pixel)</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan=2 bgcolor="#FFF3E1" height=20>�α��� ��ư</td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[LoginBtn]?>"> </div></td>
											<td width="600">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"><input type="file" name="img[]" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="#;" onclick="mainLogin('LoginBtn');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> &nbsp;gif , jpg   ��밡�� (����ȭ ������ 51 x 19 pixel)</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan=2 bgcolor="#FFF3E1" height=20>ȸ������</td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[JoinBtn]?>"> </div></td>
											<td width="600">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"><input type="file" name="img[]" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="#;" onclick="mainLogin('JoinBtn');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> &nbsp;gif , jpg   ��밡�� (����ȭ ������ 42 x 13 pixel)</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan=2 bgcolor="#FFF3E1" height=20>���̵�/���ã��</td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[IdlossBtn]?>"> </div></td>
											<td width="600">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"><input type="file" name="img[]" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="#;" onclick="mainLogin('IdlossBtn');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> &nbsp;gif , jpg   ��밡�� (����ȭ ������ 82 x 13 pixel)</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan=2 bgcolor="#FFF3E1" height=20>�α׾ƿ�</td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[LogoutBtn]?>"> </div></td>
											<td width="600">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"><input type="file" name="img[]" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="#;" onclick="mainLogin('LogoutBtn');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> &nbsp;gif , jpg   ��밡�� (����ȭ ������ 62 x 19 pixel)</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan=2 bgcolor="#FFF3E1" height=20>��������</td>
										</tr>
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[EditBtn]?>"> </div></td>
											<td width="600">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"><input type="file" name="img[]" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="#;" onclick="mainLogin('EditBtn');"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> &nbsp;gif , jpg   ��밡�� (����ȭ ������ 42 x 13 pixel)</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan=3 bgcolor="#FFF3E1" height=20>�α��� �����϶� ������ ȭ�� ������ ����</td>
										</tr>
										<tr>
											<td width="150" align="center">
												<table width="140" border="1" cellspacing="0" cellpadding="0" height="20" id="no_font_color1" class="square" bgcolor="<?=$design[login_bgcolor]?>">
													<tr>
														<td align="center"></td>
													</tr>
												</table>
											</td>
											<td width="600"><a href="javascript:subsetColor('','design_c','no_font_color1','document.mainLoginForm');"><img src="image/design_p.gif" width="19" height="20" border="0"></a></div> RGB �ڵ� <input class="box" name="t_no_font_color1" type="text" id="t_no_font_color1" onChange="setChangedColor(this);no_font_color1.bgColor = this.value;" value="<?= $design[login_bgcolor]?>" size="8"> &nbsp;<img src="image/design_save_i.gif" width="46" height="18" border="0" onclick="login_bg();" style="cursor:pointer"></td>
										</tr>
									</table></form>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25">
									<table width=100%>
										<tr>
											<td width=300><img src="image/design_main_icon.gif" width="21" height="11">�α������� �����κп� �����Ŵ&nbsp;&nbsp;<input type="radio" name="bLoginShow" value="y" <? if ($design[bLoginShow]=="y") echo "checked";?> onclick="location.href='design_ok.php?act=design_c&part=5&bLoginShow='+this.value">������&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�α������� ��ܿ� �����Ŵ&nbsp;&nbsp; <input type="radio" name="bLoginShow" value="n" <? if ($design[bLoginShow]!="y") echo "checked";?> onclick="location.href='design_ok.php?act=design_c&part=5&bLoginShow='+this.value">������</td>
											<td><img src="image/design_c_login.jpg"> </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25">
									<table width=100%>
										<tr>
											<td width=300><img src="image/design_main_icon.gif" width="21" height="11">ī�װ������ �����κп� �����Ŵ&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="bLeftCategory" value="y" <? if ($design[bLeftCategory]=="y") echo "checked";?> onclick="location.href='design_ok.php?act=design_c&part=8&bLeftCategory='+this.value">������&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="bLeftCategory" value="n" <? if ($design[bLeftCategory]!="y") echo "checked";?> onclick="location.href='design_ok.php?act=design_c&part=8&bLeftCategory='+this.value">�������</td>
											<td><img src="image/design_c_category.jpg"> </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<form name="cateForm" method="post" action="design_ok.php?act=design_c&part=1"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">��ǰ ī�װ� Ÿ��Ʋ �̹���&nbsp;&nbsp;<input type="checkbox" name="bmainCategoryTitle" value="1" <? if ($design[bmainCategoryTitle]) echo "checked";?>>�̹��� ������ <a href="javascript:document.cateForm.submit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td width="150"> <div align="center"><img src="../upload/design/<?=$design[mainCategoryTitle]?>" width="175"  > </div></td>
											<td width="300">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
														<td><a href="javascript:titleimgSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#FFF3E1">
											<td colspan="2"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 175*50) </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- cateForm -->
							<form name="maxcateForm" method="post" action="design_ok.php?act=design_c&part=2"  enctype="multipart/form-data" ><?
							if($design[mainbMaxcateT])
							{
								$true_mainbMaxcateT  = "checked";
								$false_mainbMaxcateT = "";
							}
							else
							{
								$true_mainbMaxcateT  = "";
								$false_mainbMaxcateT = "checked";
							}
							?>
							<tr>
								<td colspan="2" height="40"><img src="image/design_main_icon.gif" width="21" height="11">ī�װ� �޴� ���� ����</td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" align="center"> <input type="radio" name="mainbMaxcateT" value="1" <?=$true_mainbMaxcateT?>>TEXT</td>
											<td bgcolor="#FFF3E1" align="center"> <input type="radio" name="mainbMaxcateT" value="0" <?=$false_mainbMaxcateT?>>�̹���</td>
										</tr>
										<tr>
											<td colspan="2" align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td width="300"> <div align="center"><img src="image/design_d_cate.gif" width="230" height="165"></div></td>
														<td>
															<table width="60%" border="0" cellspacing="0" cellpadding="0" height="75">
																<tr>
																	<td><input class="box" type="text" name="mainMaxcateH" size="10" <?=__ONLY_NUM?> value="<?=$design[mainMaxcateH]?>">px  <br><br><font color="009BD4">(����ȭ ������ 175*30)</font></td>
																</tr>
																<tr>
																	<td><div align="left"><a href="javascript:maxcateSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
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