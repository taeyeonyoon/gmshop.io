<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function admSendit()
{
	var form=document.admForm;
	if(form.adminId.value=="")
	{
		alert("������ ���̵� �Է��� �ֽʽÿ�.");
		form.adminId.focus();
	}
	else if(form.adminPwd.value=="")
	{
		alert("������ ��й�ȣ�� �Է��� �ֽʽÿ�.");
		form.adminPwd.focus();
	}
	else if(form.adminPwd.value!=form.adminPwd2.value)
	{
		alert("������ ��й�ȣ Ȯ���� �Է����ּ���.");
		form.adminPwd2.focus();
	}
	else form.submit();
}
//�����ȣ ã��
function searchZip()
{
	window.open("search_post.php","","scrollbars=yes,width=480,height=200,left=250,top=250");
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php";?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "basic";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
	}
	$comNum = explode("-",$admin_row[comNum]);				//����� ��Ϲ�ȣ
	$comTel = explode("-",$admin_row[comTel]);				//����� ����ó
	$comFax = explode("-",$admin_row[comFax]);				//����� �ѽ���ȣ
	$comZip = explode("-",$admin_row[comZip]);
	?>
		<td width="85%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/account_tit_.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �⺻������ �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan=2>
									<table width="300" cellspacing="2" cellpadding="2">
										<tr align="center">
											<td width=50% bgcolor="#CBCCF8">�⺻���� �ֱټ�����¥</td>
											<td><b><?=$admin_row[editDay]?></b></td>
										</tr>
										<tr align="center" >
											<td width=50% bgcolor="#CBCCF8">�ֱ����ӳ�¥</td>
											<td><b><?=$admin_row[nearDay]?></b></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="2">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor="f5f5f5" colspan="3" height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:admSendit();"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:formClear(document.admForm);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width='440'><img src="image/adm_mid_tit.gif"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td height='10'></td>
							</tr>
							<tr>
								<td>
									<form name="admForm" method="post" action="adm_ok.php" enctype="multipart/form-data" >
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr valign="middle">
											<td width="20%" height="25" bgcolor="#FAFAFA"><div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���θ� �ּ�</div></td>
											<td width="80%" height="25"> &nbsp;&nbsp;<font color="#996600">http://</font> <input class="box" type="text" name="shopUrl" size="50" value="<?=$admin_row[shopUrl]?>" <?=$demo_readonly?>><br>&nbsp;&nbsp;<font class="help">�� �ݵ�� <b>���� ����Ǿ� �ִ� ������</b>���� �Է����ֽñ� �ٶ��ϴ�.</font></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="20%" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���θ� �̸�</div></td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="shopName" size="30" value="<?=$admin_row[shopName]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="20%" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���θ� ����<br><font class="help">�� ������ ��� Ÿ��Ʋ�ٿ� ǥ�õ˴ϴ�. </font></div></td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="shopTitle" size="90" value="<?=$admin_row[shopTitle]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="20%" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �˻� Ű����<br><font class="help">�� �˻������� �˻��Ǿ��� �˻��� (<b>�ĸ�</b>�� �и��ؼ� �Է��մϴ�.)</font></div></td>
											<td width="80%" height="25">&nbsp;<textarea class="box" name="shopKeyword" cols="60" rows="5"><?=$admin_row[shopKeyword]?></textarea></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="20%" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���� ��ȣ �����</div></td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="guard" size="10" value="<?=$admin_row[guard]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="20%" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �α����� ù������</div></td>
											<td width="80%" height="25"> &nbsp;&nbsp;<font color="#996600"><select name="startpage_adm"><?
											foreach ($menu_str_arr as $key => $value)
											{
												?><option value="<?=$ADMIN_MENU_ARR[$key]?>" <? if ($ADMIN_MENU_ARR[$key] == $admin_row[startpage_adm]) echo "selected";?>><?=$menu_str_arr[$key]?></option><?
											}
											?></select></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td colspan="2" height="15"></td>
										</tr>
										<tr>
											<td colspan="2">
												<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height='1' bgcolor='DADADA'></td>
													</tr>
													<tr>
														<td width='440'><img src="image/adm_mid_tit1.gif"></td>
													</tr>
													<tr>
														<td height='1' bgcolor='DADADA'></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ ���̵� </td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="adminId" size="20" value="<?=$admin_row[adminId]?>" <?=$demo_readonly?>></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ ��й�ȣ</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="password" name="adminPwd" size="20" value="<?=$admin_row[adminPwd]?>" <?=$demo_readonly?>></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ ��й�ȣ Ȯ��</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="password" name="adminPwd2" size="20" value=""> &nbsp;<font class="help">�� ��й�ȣ�� ��Ÿ�� �ԷµǼ� ���� �α����� �ȵǴ� ���� ������ ���� �׻� �Է�</font></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ �߼��̸���</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="adminEmail" size="35" value="<?=$admin_row[adminEmail]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ ȸ���̸���</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="adminEmail2" size="35" value="<?=$admin_row[adminEmail2]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td colspan="2" height="15"></td>
										</tr>
										<tr>
											<td colspan="2">
												<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height='1' colspan='3' bgcolor='DADADA'></td>
													</tr>
													<tr>
														<td width='440'><img src="image/adm_mid_tit2.gif"></td>
													</tr>
													<tr>
														<td height='1' colspan='3' bgcolor='DADADA'></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ȣ</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="comName" size="30" value="<?=$admin_row[comName]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����� ��Ϲ�ȣ</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="comNum1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$comNum[0]?>"> - <input class="box"type="text" name="comNum2" size="2" maxlength="2" <?=__ONLY_NUM?> value="<?=$comNum[1]?>"> - <input class="box"type="text" name="comNum3" size="5" maxlength="5" <?=__ONLY_NUM?> value="<?=$comNum[2]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</td>
											<td width="80%" height="25"> &nbsp;&nbsp;<input class="box"type="text" name="comCon" size="30" value="<?=$admin_row[comCon]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="comItem" size="30" value="<?=$admin_row[comItem]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����Ǹž� �Ű��ȣ</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="esailNum" size="30" value="<?=$admin_row[esailNum]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǥ�ڸ�</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="comCeo" size="30" value="<?=$admin_row[comCeo]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �����ȣ</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="comZip1" size="3" maxlength="10"  value="<?=$comZip[0]?>"> - <input class="box"type="text" name="comZip2" size="3" maxlength="10"  value="<?=$comZip[1]?>"> &nbsp;<img src="../image/icon/post_search.gif" onclick="searchZip();" style="cursor:pointer"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����� �ּ�</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="comAdr" size="80" value="<?=$admin_row[comAdr]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� �� ó</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="comTel" size="20" maxlength="20"  value="<?=$admin_row[comTel]?>"></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="20%" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</td>
											<td width="80%" height="25">&nbsp;&nbsp;<input class="box"type="text" name="comFax" size="20" maxlength="20" value="<?=$admin_row[comFax]?>"></td>
										</tr>
										<tr bgcolor="#FAFAFA">
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td bgcolor="f5f5f5" colspan="2" height="40" valign="middle">
												<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
													<tr>
														<td><div align="center"><a href="javascript:admSendit();"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
														<td><div align="center"><a href="javascript:formClear(document.admForm);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
													</tr>
												</table>
											</td>
										</tr>
										</form><!-- admForm -->
									</table>
								</td>
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