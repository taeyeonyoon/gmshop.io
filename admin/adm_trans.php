<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//��ۺ��� disabled ��� �Լ�  ���� : bTrans, noTrans, 
function showTrans()
{
	var form=document.adm_accountForm;
	if(form.bTrans[0].checked)
	{
		showObject(form.noTrans,true);
		showObject(form.transMoney,true);
	}
	else
	{
		showObject(form.noTrans,false);
		showObject(form.transMoney,false);
	}
}

function showTransMethod()
{
	var form=document.adm_accountForm;
	if(form.bTransmethod[0].checked)
	{
		showObject(form.method_1,true);
		showObject(form.method_2,true);
		showObject(form.method_3,true);
	}
	else
	{
		showObject(form.method_1,false);
		showObject(form.method_2,false);
		showObject(form.method_3,false);
	}
}

function accountSendit()
{
	var form=document.adm_accountForm;
	form.submit();
}

function trans_select()
{
	var form=document.adm_accountForm;
	if (form.trans_etc.checked == true)
	{
		showObject(form.transCom2,true)
	}
	else  showObject(form.transCom2,false)
}

function searchZip(type,cnt)
{
	window.open("search_post_addtrans.php?cnt="+cnt+"&type="+type,"","scrollbars=yes,width=480,height=200,left=500,top=250");
}

function addtrans_sendit()
{
	var form=document.writeForm;
	if (form.addr.value=="" || form.first_zip.value=="" || form.last_zip.value=="")
	{
		alert("�����ȣ�˻��� ���ֽñ� �ٶ��ϴ�.");
	}
	else if (form.transP.value=="")
	{
		alert("�߰���ۺ� �Է��� �ֽñ� �ٶ��ϴ�.");
	}
	else
	{
		form.submit();
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="showTrans();trans_select();showTransMethod()">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "basic";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
	}
	if($admin_row[bTrans])
	{
		$true_bTrans  = "checked";
		$false_bTrans = "";
	}
	else
	{
		$true_bTrans  = "";
		$false_bTrans = "checked";
	}
	if($admin_row[bTransmethod]=="y")
	{
		$true_bTransmethod  = "checked"; 
		$false_bTransmethod = "";
	}
	else
	{
		$true_bTransmethod  = "";
		$false_bTransmethod = "checked";
	}
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
								<td rowspan="3" width="200"><img src="image/account_tit_.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �⺻������ �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<form name="adm_accountForm" method="post" action="adm_trans_ok.php?part=1" enctype="multipart/form-data" >
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan='2'>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td width='440'><img src="image/account_min_tit4.gif"></td>
										</tr>
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="4"></td>
							</tr>
							<tr>
								<td width="200"  bgcolor="#FAFAFA" rowspan="5">&nbsp;&nbsp; <img src="image/icon.gif" width="11" height="11"> ��ۺ� ����</td>
								<td width="550" height="25" valign="middle">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="10%"> <div align="center"> <input class="radio"type="radio" value="1" name="bTrans" onclick="javascript:showTrans();" <?=$true_bTrans?>></div></td>
											<td width="25%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input class="radio"type="radio" value="0" name="bTrans" onclick="javascript:showTrans();" <?=$false_bTrans?>></div></td>
											<td><div align="left">������� ����&nbsp;(<input type="checkbox" name="chakbul" value="1" <? if ($admin_row[chakbul]) echo "checked";?>> ���ҷ� ǥ��)</div></td>
										</tr>
										<tr>
											<td colspan=4><font class="help">�� ������� ���� ��� ������ <b>������</b> �Դϴ�.(����ǥ�� ������ ���ҷ� ǥ��)<BR> </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="550" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="550" height="25" valign="middle">
									<table width="100%" height="25" border="0" cellspacing="0" cellpadding="0">
										<tr valign="middle">
											<td width="130"> <div align="center">������ ����ݾ�</div></td>
											<td width="400"> <input class="box"type="text" name="noTrans" size="10" <?=__ONLY_NUM?> value="<?=$admin_row[noTrans]?>"> �� �̻󱸸Ž� ������ </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="550" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="550" height="25" valign="middle">
									<table width="100%" height="25" border="0" cellspacing="0" cellpadding="0">
										<tr valign="middle">
											<td width="130"> <div align="center">�⺻ ��ۺ�</div></td>
											<td width="400"> <input class="box"type="text" name="transMoney" size="10" <?=__ONLY_NUM?> value="<?=$admin_row[transMoney]?>"> �� </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="550" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="200"  bgcolor="#FAFAFA" rowspan="7">&nbsp;&nbsp; <img src="image/icon.gif" width="11" height="11"> ��۹�� ����</td>
								<td width="550" height="25" valign="middle">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="10%"> <div align="center"> <input class="radio"type="radio" value="y" name="bTransmethod" onclick="javascript:showTransMethod();" <?=$true_bTransmethod?>></div></td>
											<td width="25%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input class="radio"type="radio" value="n" name="bTransmethod" onclick="javascript:showTransMethod();" <?=$false_bTransmethod?>></div></td>
											<td width="25%">������</td>
										</tr>
										<tr>
											<td colspan=4><font class="help">�� ���� �������������� <b>�Һ��ڰ� �ù����� �����Ҽ� �ִ� �޴�</b>�� ���ɴϴ�.<br>�� �浿ȭ���� ����� ���ý� <b>��ۺ�� ����</b>�� �����˴ϴ�. </font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="550" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="550" height="25" valign="middle">
									<table width="100%" height="60" border="0" cellspacing="0" cellpadding="0">
										<tr valign="middle">
											<td width="130"> <div align="center">�ù���</div></td>
											<td width="400"><textarea name="method_1" class="box" cols="60" rows="3"><?=$admin_row[method_1]?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="550" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="550" height="25" valign="middle">
									<table width="100%" height="60" border="0" cellspacing="0" cellpadding="0">
										<tr valign="middle">
											<td width="130"> <div align="center">�浿ȭ��</div></td>
											<td width="400"> <textarea name="method_2" class="box" cols="60" rows="3"><?=$admin_row[method_2]?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="550" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="550" height="25" valign="middle">
									<table width="100%" height="60" border="0" cellspacing="0" cellpadding="0">
										<tr valign="middle">
											<td width="130"> <div align="center">�����</div></td>
											<td width="400"><textarea name="method_3" class="box" cols="60" rows="3"><?=$admin_row[method_3]?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="200"  bgcolor="#FAFAFA">&nbsp;&nbsp; <img src="image/icon.gif" width="11" height="11"> ��۾�ü ����</td>
								<td width="550" valign="middle">
									<table width="100%"   border="0" cellspacing="0" cellpadding="0">
										<tr valign="middle">
											<td width="130" height=40> <div align="center">�⺻ ��� ȸ��</div></td>
											<td width="400"><select name="transCom"><option value=0>����۾�ü����</option>
											<option value="�������" <? if ($admin_row[transCom]=="�������") echo "selected";?>>�������</option>
											<option value="��ü��" <? if ($admin_row[transCom]=="��ü��") echo "selected";?>>��ü��</option>
											<option value="CJ GLS�ù�" <? if ($admin_row[transCom]=="CJ GLS�ù�") echo "selected";?>>CJ GLS�ù�</option>
											<option value="�����ù�" <? if ($admin_row[transCom]=="�����ù�") echo "selected";?>>�����ù�</option>
											<option value="�����ù�" <? if ($admin_row[transCom]=="�����ù�") echo "selected";?>>�����ù�</option> 
											<option value="�Ｚ�ù�" <? if ($admin_row[transCom]=="�Ｚ�ù�") echo "selected";?>>�Ｚ�ù�</option> 
											<option value="Ʈ����ù�" <? if ($admin_row[transCom]=="Ʈ����ù�") echo "selected";?>>Ʈ����ù�</option>
											</select>&nbsp;&nbsp;<input onclick="trans_select();" type="checkbox" name="trans_etc" value="y" <? if ($admin_row[trans_etc]=="y") echo "checked";?>>Ÿ��ü �����Է� <input class="box"type="text" name="transCom2" size="20" <? if ($admin_row[trans_etc]=="y") echo "value=$admin_row[transCom]";?>> </td>
										</tr>
										<tr>
											<td colspan=2 width="550" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="130" height=40> <div align="center">������Ʈ �ּ�</div></td>
											<td width="400"><input type="text" class="box" size="50" name="trans_com_url" value="<?=$admin_row[trans_com_url]?>"><br><font class="help">�ù�ȸ���� ������� �������ּ� �Է½� ���� <b>������� �ֹ���ǰ��ȸ</b>���� ��ũ�� �����մϴ�.</font></td>
										</tr>
										<tr>
											<td colspan=2 width="550" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="130" height=40> <div align="center">ȭ���� �Է�</div></td>
											<td width="400"><input type="text" class="box" size="20" name="trans_goodname" value="<?=$admin_row[trans_goodname]?>"><br><font class="help"><b>������¿� �������Ͽ� �ù�纰�� �� �׸��� ������� ����˴ϴ�.</b> �� ��) ���ƿ�ǰ, ������ǰ, ...</font></td>
										</tr>
										<tr>
											<td colspan=2 width="550" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="130" height=40> <div align="center">Ư�����(���)�Է�</div></td>
											<td width="400"><input type="text" class="box" size="50" name="trans_content" value="<?=$admin_row[trans_content]?>"> <br><font class="help"><b>������¿� �������Ͽ� �ù�纰�� �� �׸��� ������� ����˴ϴ�.</b> �� ��) ������ǿ��,������ ���� ȭ���Դϴ�, ...</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan="2" height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:accountSendit();"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:formClear(document.adm_accountForm);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr></form><!-- adm_accountForm -->
						</table>
					</td>
				</tr>
				<tr>
					<td ><br><br>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height='1' bgcolor='DADADA'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/add_trans.gif"></td>
							</tr>
							<tr>
								<td height='1' bgcolor='DADADA'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td>
						<form name="writeForm" method="post" action="adm_trans_ok.php?part=2">
						<table width="750" border="0" bgcolor="A5A5A5" cellspacing="1" cellpadding="0" align="center">
							<tr bgcolor="fafafa" height=30>
								<td colspan=6>&nbsp;<img src="image/icon.gif" width="11" height="11"> �����갣���� �űԵ��</td>
							</tr>
							<tr bgcolor="eeeeee" height=30>
								<td align=center width=25%>�� ��</td>
								<td align=center width=20%>�����ȣ</td>
								<td align=center width=15%>�߰���ۺ�</td>
								<td align=center width=12%>�����ȣ �˻�</td>
								<td align=center width=15%>�� ��</td>
							</tr>
							<tr bgcolor="FBFAC9" height=25>
								<td align=center><input name="addr" type="text" class="box" size=30></td>
								<td align=center><input name="first_zip" type="text" class="box" size=10> ~ <input name="last_zip" type="text" class="box" size=10></td>
								<td align=center><input name="transP" type="text" class="box" size=10> ��</td>
								<td align=center><img src="../image/icon/post_search.gif" onclick="searchZip('write',0);" style="cursor:pointer"></td>
								<td align=center><img src="image/entry_btn.gif" onclick="addtrans_sendit();" style="cursor:pointer"></td>
							</tr>
						</table></form><br><br>
						<table width="750" border="0" bgcolor="A5A5A5" cellspacing="1" cellpadding="0" align="center">
							<tr bgcolor="fafafa" height=30>
								<td colspan=6>&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ϵ� �����갣���� ���</td>
							</tr>
							<tr bgcolor="eeeeee" height=30>
								<td align=center width=25%>�� ��</td>
								<td align=center width=20%>�����ȣ</td>
								<td align=center width=15%>�߰���ۺ�</td>
								<td align=center width=12%>�����ȣ �˻�</td>
								<td align=center width=8%>����</td>
								<td align=center width=8%>�� ��</td>
							</tr><?
							$result = $MySQL->query("SELECT *from trans_add");
							$cnt = 1;
							while ($row = mysql_fetch_array($result))
							{
								?>
							<form name="editForm<?=$cnt?>" method="post" action="adm_trans_ok.php?part=3">
							<input type="hidden" name="idx" value="<?=$row[idx]?>">
							<tr bgcolor="FBFAC9" height=25>
								<td align=center><input value="<?=$row[addr] ?>" name="addr" type="text" class="box" size=30></td>
								<td align=center><input value="<?=$row[first_zip] ?>" name="first_zip" type="text" class="box" size=10> ~ <input value="<?=$row[last_zip] ?>" type="text" name="last_zip" class="box" size=10></td>
								<td align=center><input value="<?=$row[transP] ?>" name="transP" type="text" class="box" size=10> ��</td>
								<td align=center><img src="../image/icon/post_search.gif" onclick="searchZip('edit',<?=$cnt?>)"; style="cursor:pointer"></td>
								<td align=center><img src="image/edit_btn.gif" onclick="document.editForm<?=$cnt?>.submit();" style="cursor:pointer"></td>
								<td align=center><img src="image/delete_btn.gif" onclick="location.href='adm_trans_ok.php?part=4&idx=<?=$row[idx]?>';" style="cursor:pointer"></td>
							</tr>
							</form><?
								$cnt++;
							}
							?>
						</table>
					</td>
				</tr>
			</table><br><br>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>