<?
include "head.php";
$getArrayOS = explode(";", $_SERVER[HTTP_USER_AGENT]);
$BROWGER = trim($getArrayOS[1]);
$OS = trim($getArrayOS[2]);
if(preg_match("/Windows/", $OS) && preg_match("/MSIE/", $BROWGER))
{
	$Os_Check=1;
	$Use_Check="";
}
else
{
	$Os_Check=0;
	$Use_Check="disabled";
}
if ($birth)
{
	$content="
<table width=600 border=0 align=center>
	<tr>
		<td align=center><img src='http://$admin_row[shopUrl]/upload/birth_img'></td>
	</tr>
	<tr>
		<td height=200 valign=middle align=center><b>������ ������ �������� ���ϵ帳�ϴ�.<p>�����ε� ���� ���ɰ� ��� ��Ź�帳�ϴ�.</b></td>
	</tr>
</table>";
	$title="������ ������ ���ϵ帳�ϴ�";
}
/////��ȥ����ϴ�ü����////////
if ($birth2)
{
	$content="
<table width=600 border=0 align=center>
	<tr>
		<td align=center><img src='http://$admin_row[shopUrl]/upload/birth2_img'></td>
	</tr>
	<tr>
		<td height=200 valign=middle align=center><b>������ ��ȥ������� �������� ���ϵ帳�ϴ�.<p>�����ε� ���� ���ɰ� ��� ��Ź�帳�ϴ�.</b></td>
	</tr>
</table>";
	$title="������ ��ȥ������� ���ϵ帳�ϴ�";
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function mailSendit()
{
	<? if ($demo_readonly) { ?>
	alert("������������ ���� ���Ը��� �߼��� ��������\n ��������� �ξ����ϴ�. �˼��մϴ�.");
	<? }else { ?>
	var form=document.mailForm;
	if(form.bHtml[2].checked==true)
	{
		<?
		if(!$Os_Check)
		{
			?>
		alert('�������͸� �������� �ʽ��ϴ�.');<?
		}
		?>
		cdiv.gogo();
	}
	if(form.title.value=="")
	{
		alert("������ �Է��� �ֽʽÿ�.");
		form.title.focus();
	}
	else if(form.auth_code.value=="")
	{
		alert("�����ڵ带 �Է��� �ֽʽÿ�.");
		form.auth_code.focus();
	}
	else
	{
		form.submit();
	}
	<? } ?>
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "member";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	?>
		<td width="85%" valign="top" height="400">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/member_tit.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ȸ����ü��� �� ��ü���Ϲ߼� ���� �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/member_send.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align=center><b>�� �̸��� �߼� �������α׷��� �ƴ� ���󿡼��� ��ü���� �߼��� ������ ���� ���ϸ� �����ü� �ֽ��ϴ�.<br>���� ��κ��� ȣ���þ�ü ������ PHP ����ð��� 1�й̸����� �����Ǿ� �ֱ⶧���� ���Ϲ߼۷��� �Ѱ谡 �ֽ��ϴ�.</b></td>
				</tr>
				<tr>
					<td valign="top">
						<form name="mailForm" method="post" action="member_sendmail_ok.php">
						<input type="hidden" name="idx_arr" value="<?=$idx_arr?>">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" height="420">
							<tr valign="middle">
								<td width="103" height="40" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
								<td width="447" height="40"> &nbsp;&nbsp; <input class="box" name="title" type="text" id="title" size="50" value="<?=$title?>"></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="103" height="40" bgcolor="#FAFAFA"><div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �����ڵ�</div></td>
								<td width="447" height="40">
									<table cellpadding=0 cellspacing=0 cellpadding=0 border=0>
										<tr>
											<td width="10"></td>
											<td><? include "../lib/auth_img.php"; ?></td>
											<td>&nbsp; <input class="box" name="auth_code" type="text" id="auth_code" size="10"> ���� ���̴� �����ڵ带 �Է��ϼ���</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="103" height="40" bgcolor="#FAFAFA"><div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��������</div></td>
								<td width="447" height="40"> &nbsp;&nbsp; <INPUT TYPE="radio" NAME="bHtml" value='1' onclick="document.getElementById('nsText').style.display='block';document.getElementById('nsHtml').style.display='none';document.getElementById('nsEdit').style.display='none';">TEXT &nbsp; <INPUT TYPE="radio" NAME="bHtml" value='2' <?=$Os_Check?"":"checked"?> onclick="document.getElementById('nsText').style.display='none';document.getElementById('nsHtml').style.display='block';document.getElementById('nsEdit').style.display='none';">HTML &nbsp; <INPUT TYPE="radio" NAME="bHtml" value='0' <?=$Os_Check?"checked":""?> onclick="document.getElementById('nsText').style.display='none';document.getElementById('nsHtml').style.display='none';document.getElementById('nsEdit').style.display='block';" <?= $Use_Check?>>��������</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="103" height="20" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����</td>
								<td width="447" height="20" align="left"><br>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText' style='display:none'>
										<tr>
											<td><textarea name="TextContent" style="width:100%" rows="25" cols="80"><?=$content?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml' style='display:<?=$Os_Check?"none":"block"?>'>
										<tr>
											<td><textarea name="HtmlContent" style="width:100%" rows="25" cols="80"><?=$content?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit' style='display:<?=$Os_Check?"block":"none"?>'>
										<tr>
											<td><?
											$form_name = "mailForm";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="content" cols="90" rows="15"><?=$content?></textarea></td>
										</tr>
									</table><?
									if ($idx_arr)
									{
										$temp = explode("/",$idx_arr);
										$temp_cnt = count($temp);
										?><br><br>�˻���� ���Ϻ����� [ <b><?=$temp_cnt?></b> �� ]<?
									}
									?>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="20"><br>
									<table width="200" border="0" align="center">
										<tr>
											<td><div align="center"><a href="javascript:mailSendit();"><img src="image/ok_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="javascript:formClear(document.mailForm);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table><br>
								</td>
							</tr>
						</table></form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>