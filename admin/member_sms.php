<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function smsSendit()
{
	//���� ����
	var form=document.smsForm;
	if(form.content.value=="")
	{
		alert("�޼��� ������ �Է��� �ֽʽÿ�.");
		form.content.focus();
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
	$__TOP_MENU = "member";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
	}
	$sms=$MySQL->fetch_array("select *from smsinfo limit 0,1"); //sms ���� �迭
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
								<td width='440'><img src="image/member_sms.gif"></td>
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
					<td valign="top">
						<table width="796" border="0" cellspacing="0" cellpadding="0" align="center"><?
						if($sms[bSms] && !empty($sms[userid]) && !empty($sms[pwd]))
						{
							?>
							<tr>
								<td height="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <FONT  COLOR="#D0A626">- �޼��� ������ <B>80 byte</B>(�ѱ� 40��)�� �ʰ��� ��� �޼����� ���۵��� �ʽ��ϴ�.</FONT></td>
							</tr>
							<tr>
								<td valign="top" height="25">
									<form name="smsForm" method="post" action="member_sms_ok.php">
									<!----- �˻��� ȸ������ SMS �������� ��� idx_arr ���� --------> 
									<input type="hidden" name="idx_arr" value="<?=$idx_arr?>">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td><img src="image/icon.gif" width="11" height="11"> ���� <input type="text" name="content" size="80" class="box"> <a href="javascript:smsSendit();"><img src="image/ok_btn.gif" width="40" height="17" border="0"></a></td>
										</tr>
									</table></form>
								</td>
							</tr><?
						}
						else
						{
							?>
							<tr>
								<td height="50"><BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <FONT  COLOR="#0099CC">- SMS <B>�̻��</B> ���� �̰ų� Ȥ�� SMS ������ �ùٸ��� �ʽ��ϴ�.</FONT><P>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <FONT  COLOR="#0099CC">- <B>SMS����</B>�� ������ Ȯ�� �Ͻñ� �ٶ��ϴ�.</td>
							</tr><?
						}
						?>
							<tr>
								<td>&nbsp;</td>
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