<SCRIPT LANGUAGE="JavaScript">
<!--
function topAdrAdd()
{
	var form = document.topAdrForm;
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
//-->
</SCRIPT>
<?
$MySQL->query("select idx from webmail_adr where badmin=1");
$top_adr_cnt = $MySQL->is_affected();
?>
										<tr>
											<td height="30"><img src="image/webmail/icon.gif" width="15" height="10"> �ּҷ� : �����ּ� <b><font color="#FF6600"><?=$top_adr_cnt?></font></b>��</td>
										</tr>
										<tr>
											<td height="30"><img src="image/webmail/icon0.gif" width="8" height="9"><font color="#FF6600"> <b>�����ּҷ� �߰�</b></font></td>
										</tr>
										<tr>
											<td height="30">
												<table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f4f4f4">
															<form name="topAdrForm" method="post" action="admmail_address_add_ok.php">
															<input type="hidden" name="write_part" value="fast">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td height="20"> <div align="center">�׷�</div></td>
																	<td height="20"> <div align="center">�̸�</div></td>
																	<td height="20"> <div align="center">�̸���</div></td>
																	<td height="20"> <div align="center">����ó</div></td>
																	<td height="20"> <div align="center"></div></td>
																</tr>
																<tr>
																	<td height="35"> <div align="center"><select name="grp"><option value="">�׷켱��</option><?
																	$top_grp_result = $MySQL->query("select * from webmail_adr_grp where badmin=1");
																	while($top_grp_row = mysql_fetch_array($top_grp_result))
																	{
																		?><option value="<?=$top_grp_row[code]?>"><?=$top_grp_row[name]?></option><?
																	}
																	?></select></div></td>
																	<td height="35"> <div align="center"> <input type="text" name="name" size="15" class="box"></div></td>
																	<td height="35"> <div align="center"> <input type="text" name="email" size="30" class="box"></div></td>
																	<td height="35"> <div align="center"> <input type="text" name="tel1" size="6" class="box" <?=__ONLY_NUM?> maxlength="3"> - <input type="text" name="tel2" size="6" class="box" <?=__ONLY_NUM?> maxlength="4"> - <input type="text" name="tel3" size="6" class="box" <?=__ONLY_NUM?> maxlength="4"></div></td>
																	<td height="35"> <div align="center"><a href="javascript:topAdrAdd();"><img src="image/webmail/add_btn.gif" width="35" height="17" border="0"></a></div></td>
																</tr>
															</table></form>
														</td>
													</tr>
												</table>
											</td>
										</tr>