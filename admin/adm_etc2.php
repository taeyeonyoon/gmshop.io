<?
include "head.php";
$gd_array = @gd_info();
//////////�� �������� ������ �ʴ� ���� �� ������ �ּ�ó���ؾ���. GD ��ü�� ������ ���� ��� �׷���. 
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function postcode()
{
	<? if (__DEMOPAGE){ ?>
	alert("������������ ����� ���ѵǾ� �ֽ��ϴ�.");
	<? }else{ ?>
	if (confirm("������Ʈ �Ͻðڽ��ϱ�?"))
	{
		document.adm_etcForm.submit();
	}
	<? } ?> 
}

function etcSendit()
{
	<? if (__DEMOPAGE){ ?>
	alert("������������ ����� ���ѵǾ� �ֽ��ϴ�.");
	<? }else{ ?>
	document.adm_etcForm.submit();
	<? } ?>
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php";?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "basic";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
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
						<form name="adm_etcForm" method="post" action="adm_etc2_ok.php" enctype="multipart/form-data" >
						<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height='1' colspan='3' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td width='440'><img src="image/etc_mid_etc.gif"></td>
										</tr>
										<tr>
											<td height='1' colspan='3' bgcolor='DADADA'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='5' colspan="2"></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan="2" height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit();"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:formClear(document.adm_etcForm);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="300" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ��Ͻ� �Ѱ��̹��� �������<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��,��,�� �ڵ����� ���</td>
								<td width="450" height="25">
									<table width="430" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="10%"> <div align="center"> <input type="radio" name="bGdset" value="y" <?if($admin_row[bGdset]=="y"){echo"checked";}?>></div></td>
											<td width="25%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input type="radio" name="bGdset" value="n" <?if($admin_row[bGdset]=="n" || !$gd_array["GIF Create Support"]){echo"checked";}?>></div></td>
											<td width="25%"> <div align="left">������� ����</div></td>
										</tr>
										<tr>
											<td colspan=4><font class="help">�� ȣ���� ������ <b>GD LIBRARY ���� 2.0</b> ��ġ�Ǿ����� ��밡�� (JPG��) <br>�� <b>GD 2.0.28 ����</b> �̻���� GIF �̹����� ���డ���մϴ�.<br>�� ������ <b>ȣ���� ����</b>���� 2004�� 11��22�� 2.08 ������ ��ġ�Ǿ����ϴ�.</font><?
											if ($gd_array["GD Version"]) echo "<BR><b> ������ GD���� : ".$gd_array["GD Version"]."</b>";
											else echo "<BR><font color=red><b>������ GD������ Ȯ�ε��� �ʽ��ϴ�. ȣ���þ�ü Ȯ�ο��.</b></font>";
											if ($gd_array["GIF Create Support"]) echo "<BR><b> GIF ��밡��</b>";
											else echo "<BR><font color=red><b>������ GIF ��밡�ɿ��ΰ� Ȯ�ε��� �ʽ��ϴ�. ȣ���þ�ü Ȯ�ο��.</b></font>";
											if ($gd_array["JPG Support"]) echo "<BR><b> JPG ��밡��</b>";
											else echo "<BR><font color=red><b>������ JPG ��밡�ɿ��ΰ� Ȯ�ε��� �ʽ��ϴ�. ȣ���þ�ü Ȯ�ο��.</b></font>";
											?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="300" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> 1:1���� ��뿩��</td>
								<td width="450" height="25">
									<table width="430" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="10%"> <div align="center"> <input type="radio" name="bPersonask" value="1" <?if($admin_row[bPersonask]){echo"checked";}?>></div></td>
											<td width="25%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input type="radio" name="bPersonask" value="0" <?if(!$admin_row[bPersonask]){echo"checked";}?>></div></td>
											<td width="25%"> <div align="left">������� ����</div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="300" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���콺 �����ʹ�ư ����㰡����</td>
								<td width="450" height="25">
									<table width="430" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="10%"> <div align="center"> <input type="radio" name="bMouseRB" value="1" <?if($admin_row[bMouseRB]){echo"checked";}?>></div></td>
											<td width="25%"> <div align="left">�㰡��</div></td>
											<td width="10%"> <div align="center"> <input type="radio" name="bMouseRB" value="0" <?if(!$admin_row[bMouseRB]){echo"checked";}?>></div></td>
											<td width="25%"> <div align="left">�㰡���� ����</div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="300" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �ֹ���� �ڵ����ΰ�ħ(�� 2��30��)</td>
								<td width="450" height="25">
									<table width="430" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="10%"> <div align="center"> <input type="radio" name="bTrade" value="1" <?if($admin_row[bTrade]){echo"checked";}?>></div></td>
											<td width="25%"> <div align="left">�����</div></td>
											<td width="10%"> <div align="center"> <input type="radio" name="bTrade" value="0" <?if(!$admin_row[bTrade]){echo"checked";}?>></div></td>
											<td width="25%"> <div align="left">������� ����</div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="300" height="50" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �����ȣ ������Ʈ</td>
								<td><input type="file" name="postcode"><a href="javascript:postcode();"><img src="image/save_btn.gif" width="40" height="17" border="0"></a> <br><font color="#999999"><b>���������� �����ȣ ��ġTXT ������ �����Ǹ�</b> �� �����ȣ TXT������ �ٿ�ε��Ͽ� �̰��� ����ϸ� ���ŵ˴ϴ�.</font></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan="2" height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit();"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:formClear(document.adm_etcForm);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr></form><!-- adm_etcForm -->
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