<?
include "head.php";
if (__DEMOPAGE) $readonly = "readonly";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function adrWSendit()
{
	var form = document.adrWForm;
	if(form.name.value=="")
	{
		alert("�̸��� �Է��� �ֽʽÿ�.");
		form.name.focus();
	}
	else if(form.email.value=="")
	{
		alert("�̸����� �Է��� �ֽʽÿ�.");
		form.email.focus();
	}
	else if(!isEmail(form.email.value))
	{
		alert("�̸��� �ּҰ� �ùٸ��� �ʽ��ϴ�.");
		form.email.focus();
	}
	else
	{
		form.submit();
	}
}
function searchZip()
{
	window.open("../search_post.php?po=webmail","","scrollbars=yes,width=480,height=200,left=250,top=250");
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "admmail";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
	}
	$comNum = explode("-",$admin_row[comNum]);				//����� ��Ϲ�ȣ
	$comTel = explode("-",$admin_row[comTel]);				//����� ����ó
	$comFax = explode("-",$admin_row[comFax]);				//����� �ѽ���ȣ
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
								<td rowspan="3" width="200"><img src="image/admmail_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �����ڸ��� ������ �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="2" valign="top">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width='440'><img src="image/admmail_tit_5.gif"></td>
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
								<td valign="top" align="center">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="30">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td><img src="image/webmail/icon0.gif" width="8" height="9"><font color="#FF6600"> <b>���� �����ϱ�</b></font></td>
														<td>&nbsp;</td>
														<td width="63"><a href="javascript:adrWSendit();"><img src="image/webmail/save_btn.gif" width="58" height="23" border="0"></a></td>
														<td width="65"><a href="admmail_address.php"><img src="image/webmail/cancel_btn.gif" width="58" height="23" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr><?
										$adr_info = $MySQL->fetch_array("select * from webmail_adr where idx=$idx");
										$tel = explode("-",$adr_info[tel]);
										$birth = explode("-",$adr_info[birth]);
										$zip = explode("-",$adr_info[zip]);
										?>
										<tr>
											<td height="30">
												<table width="100%" border="0" cellspacing="1" cellpadding="10" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f4f4f4">
															<form name="adrWForm" method="post" action="admmail_address_edit_ok.php">
															<input type="hidden" name="idx" value="<?=$idx?>">
															<table width="100%" border="0" cellspacing="2" cellpadding="3" align="center">
																<tr>
																	<td height="25" width="120" bgcolor="e6e6e6"> <div align="center">�̸�</div></td>
																	<td> <input type="text" name="name" size="20" class="box" value="<?=$adr_info[name]?>"></td>
																</tr>
																<tr>
																	<td height="25" width="120" bgcolor="e6e6e6"> <div align="center">�̸���</div></td>
																	<td> <input type="text" name="email" size="40" class="box" value="<?=$adr_info[email]?>"></td>
																</tr>
																<tr>
																	<td height="25" width="120" bgcolor="e6e6e6"> <div align="center">����ó</div></td>
																	<td> <input type="text" name="tel1" size="6" class="box" <?=__ONLY_NUM?> maxlength="3" value="<?=$tel[0]?>"> - <input type="text" name="tel2" size="6" class="box" <?=__ONLY_NUM?> maxlength="4" value="<?=$tel[1]?>"> - <input type="text" name="tel3" size="6" class="box" <?=__ONLY_NUM?> maxlength="4" value="<?=$tel[2]?>"></td>
																</tr>
																<tr>
																	<td height="25" width="120" bgcolor="e6e6e6"> <div align="center">�׷켱��</div></td>
																	<td> <select name="grp"><option value="">�׷켱��</option><?
																	$w_grp_result = $MySQL->query("select * from webmail_adr_grp where badmin=1");
																	while($w_grp_row = mysql_fetch_array($w_grp_result))
																	{
																		?><option value="<?=$w_grp_row[code]?>" <?if($adr_info[grp]==$w_grp_row[code]){echo"selected";}?>><?=$w_grp_row[name]?></option><?
																	}
																	?></select></td>
																</tr>
																<tr>
																	<td height="25" width="120" bgcolor="e6e6e6"> <div align="center">�������</div></td>
																	<td> <input type="text" name="birth1" size="5" class="box" <?=__ONLY_NUM?> maxlength="4"  value="<?=$birth[0]?>">�� <input type="text" name="birth2" size="3" class="box" <?=__ONLY_NUM?> maxlength="2" value="<?=$birth[1]?>">�� <input type="text" name="birth3" size="3" class="box" <?=__ONLY_NUM?> maxlength="2" value="<?=$birth[2]?>">��</td>
																</tr>
																<tr>
																	<td height="25" width="120" bgcolor="e6e6e6"> <div align="center">���ּ�</div></td>
																	<td> <input type="text" name="zip1" size="4" class="box" <?=__ONLY_NUM?> maxlength="3" value="<?=$zip[0]?>"> - <input type="text" name="zip2" size="4" class="box" <?=__ONLY_NUM?> maxlength="3" value="<?=$zip[1]?>"> <a href="javascript:searchZip();"><img src="image/webmail/post_search.gif" width="85" height="17" align="absmiddle" border="0"></a><br><input type="text" name="adr1" size="60" class="box" value="<?=$adr_info[adr1]?>"><br><input type="text" name="adr2" size="40" class="box" value="<?=$adr_info[adr2]?>"></td>
																</tr>
																<tr>
																	<td height="25" width="120" bgcolor="e6e6e6"> <div align="center">�޸�</div></td>
																	<td> <textarea name="content" class="text" cols="70" rows="5"><?=$adr_info[content]?></textarea></td>
																</tr>
															</table></form>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php"; ?>
</body>
</html>