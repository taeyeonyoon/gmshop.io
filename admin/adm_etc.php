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
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function etcSendit()
{
	document.adm_etcForm.submit();
}

function etcSendit2(part)
{
	if(part==1)
	{
		document.adm_etcForm.part.value=1;
		if(document.adm_etcForm.bRegmail_bHtml[2].checked==true)
		{
			<?
			if(!$Os_Check)
			{
				?>
			alert('�������͸� �������� �ʽ��ϴ�.');<?
			}
			?>
			cdiv_mail_join.gogo();
		}
	}
	if(part==2)
	{
		document.adm_etcForm.part.value=2;
		if(document.adm_etcForm.bBuymail_bHtml[2].checked==true)
		{
			<?
			if(!$Os_Check)
			{
				?>
			alert('�������͸� �������� �ʽ��ϴ�.');<?
			}
			?>
			cdiv_mail_buy.gogo();
		}
	}
	if(part==3)
	{
		document.adm_etcForm.part.value=3;
		if(document.adm_etcForm.bTramail_bHtml[2].checked==true)
		{
			<?
			if(!$Os_Check)
			{
				?>
			alert('�������͸� �������� �ʽ��ϴ�.');<?
			}
			?>
			cdiv_mail_trans.gogo();
		}
	}
	if(part==4)
	{
		document.adm_etcForm.part.value=4;
		if(document.adm_etcForm.bEscmail_bHtml[2].checked==true)
		{
			<?
			if(!$Os_Check)
			{
				?>
			alert('�������͸� �������� �ʽ��ϴ�.');<?
			}
			?>
			cdiv_mail_cancel.gogo();
		}
	}
	if(part==5)
	{
		document.adm_etcForm.part.value=5;
		if(document.adm_etcForm.bPassmail_bHtml[2].checked==true)
		{
			<?
			if(!$Os_Check)
			{
				?>
			alert('�������͸� �������� �ʽ��ϴ�.');<?
			}
			?>
			cdiv_mail_pwd.gogo();
		}
	}
	if(part==6)
	{
		document.adm_etcForm.part.value=6;
		if(document.adm_etcForm.bCommail_bHtml[2].checked==true)
		{
			<?
			if(!$Os_Check)
			{
				?>
			alert('�������͸� �������� �ʽ��ϴ�.');<?
			}
			?>
			cdiv_mail_bottom.gogo();
		}
	}
	document.adm_etcForm.submit();
}
function pre_view_mail(url)
{
	window.open("../email/"+url,"","scrollbars=yes,left=10,top=10,width=650,height=600");
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php";?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  height="580">
	<tr><?
	$__TOP_MENU = "basic";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if($admin_row[bRegmail] =="y")
	{
		//�������� ����
		$true_bRegmail  = "checked";
		$false_bRegmail = "";
	}
	else
	{
		$true_bRegmail  = "";
		$false_bRegmail = "checked";
	}
	if($admin_row[bBuymail] =="y")
	{
		//��ǰ���� ���� ����
		$true_bBuymail  = "checked";
		$false_bBuymail = "";
	}
	else
	{
		$true_bBuymail  = "";
		$false_bBuymail = "checked";
	}
	if($admin_row[bTramail] =="y")
	{
		//��ǰ��� ����
		$true_bTramail  = "checked";
		$false_bTramail = "";
	}
	else
	{
		$true_bTramail  = "";
		$false_bTramail = "checked";
	}
	if($admin_row[bEscmail] =="y")
	{
		//�ֹ���� ����
		$true_bEscmail  = "checked";
		$false_bEscmail = "";
	}
	else
	{
		$true_bEscmail  = "";
		$false_bEscmail = "checked";
	}
	if($admin_row[bPassmail] =="y")
	{
		//��й�ȣ���� ����
		$true_bPassmail = "checked";
		$false_bPassmail= "";
	}
	else
	{
		$true_bPassmail = "";
		$false_bPassmail= "checked";
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
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height='1' bgcolor='DADADA'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/etc_mid_mail.gif"></td>
							</tr>
							<tr>
								<td height='1' bgcolor='DADADA'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<form name="adm_etcForm" method="post" action="adm_etc_ok.php" enctype="multipart/form-data" >
						<input type="hidden" name="part" value="7">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan='2' height="25" bgcolor="#FAFAFA"><br><font class="help">�� �ҽ����� <b>__URL</b> �� ���θ� �⺻�ּҸ� ��Ī�մϴ�. �������ͻ󿡼� �̹����� �ҷ��ö� �������ϴ�.<br> �������ͻ󿡼� �̹����� ���������� <b>�����̸�����</b> �Ǵ� ���� ���ÿ��� �������� �������ϴ�. </font><br></div></td>
							</tr>
							<tr>
								<td width="250" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �������� ����</div></td>
								<td width="500" height="25"><?
								$bRegmail_bHtml_chk[$admin_row[bRegmail_bHtml]]="checked";
								?>
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="20%">�ۼ�Ÿ��&nbsp;:&nbsp;</td>
											<td width="80%"><INPUT TYPE="radio" NAME="bRegmail_bHtml" value='1' onclick="document.getElementById('nsText1').style.display='block';document.getElementById('nsHtml1').style.display='none';document.getElementById('nsEdit1').style.display='none';" <?= $bRegmail_bHtml_chk[1]?>>TEXT &nbsp; <INPUT TYPE="radio" NAME="bRegmail_bHtml" value='2' <?=$Os_Check?"":"checked"?> onclick="document.getElementById('nsText1').style.display='none';document.getElementById('nsHtml1').style.display='block';document.getElementById('nsEdit1').style.display='none';" <?= $bRegmail_bHtml_chk[2]?>>HTML &nbsp; <INPUT TYPE="radio" NAME="bRegmail_bHtml" value='0' <?=$Os_Check?"checked":""?> onclick="document.getElementById('nsText1').style.display='none';document.getElementById('nsHtml1').style.display='none';document.getElementById('nsEdit1').style.display='block';" <?= $Use_Check?> <?= $bRegmail_bHtml_chk[0]?>>��������</td>
										</tr>
										<tr>
											<td width="20%">��뿩��&nbsp;:&nbsp;</td>
											<td width="80%"><input type="radio" name="bRegmail" value="y" <?=$true_bRegmail?>>����� <input type="radio" name="bRegmail" value="n" <?=$false_bRegmail?>>������� ����</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText1' style='display:none'>
										<tr>
											<td><textarea name="mail_join_Text" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_join])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml1' style='display:<?=$Os_Check?"none":"block"?>'>
										<tr>
											<td><textarea name="mail_join_Html" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_join])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit1' style='display:<?=$Os_Check?"block":"none"?>'>
										<tr>
											<td><input type=hidden name="bHtml" value="1"><?
											$form_name = "adm_etcForm";
											$form_content = "mail_join";
											$cdiv = "cdiv_mail_join";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="mail_join" cols="90" rows="20"><?=htmlspecialchars($admin_row[mail_join])?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan=2  height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit2('1');"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td> 
											<td align="center"><img src="image/preview.jpg" onclick="javascript:pre_view_mail('member_join_success.php?_PRINT=1');" style="cursor:pointer"></td>
										</tr>
										<tr>
											<td>&nbsp;���� �������� email/member_join_success.php <br>__LOGO : �ΰ��̹���<br>__NAME : ȸ����<BR>__COMNAME : ��ȣ�� </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="30"></td>
							</tr>
							<tr valign="middle">
								<td width="250" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ���� ����</div></td>
								<td width="500" height="25"><?
								$bBuymail_bHtml_chk[$admin_row[bBuymail_bHtml]]="checked";
								?>
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="20%">�ۼ�Ÿ��&nbsp;:&nbsp;</td>
											<td width="80%"><INPUT TYPE="radio" NAME="bBuymail_bHtml" value='1' onclick="document.getElementById('nsText2').style.display='block';document.getElementById('nsHtml2').style.display='none';document.getElementById('nsEdit2').style.display='none';" <?= $bBuymail_bHtml_chk[1]?>>TEXT &nbsp; <INPUT TYPE="radio" NAME="bBuymail_bHtml" value='2' <?=$Os_Check?"":"checked"?> onclick="document.getElementById('nsText2').style.display='none';document.getElementById('nsHtml2').style.display='block';document.getElementById('nsEdit2').style.display='none';" <?= $bBuymail_bHtml_chk[2]?>>HTML &nbsp; <INPUT TYPE="radio" NAME="bBuymail_bHtml" value='0' <?=$Os_Check?"checked":""?> onclick="document.getElementById('nsText2').style.display='none';document.getElementById('nsHtml2').style.display='none';document.getElementById('nsEdit2').style.display='block';" <?= $Use_Check?> <?= $bBuymail_bHtml_chk[0]?>>��������</td>
										</tr>
										<tr>
											<td width="20%">��뿩��&nbsp;:&nbsp;</td>
											<td width="80%"><input type="radio" name="bBuymail" value="y" <?=$true_bBuymail?>>����� <input type="radio" name="bBuymail" value="n" <?=$false_bBuymail?>>������� ����</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" align='center'>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText2' style='display:none'>
										<tr>
											<td><textarea name="mail_buy_Text" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_buy])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml2' style='display:<?=$Os_Check?"none":"block"?>'>
										<tr>
											<td><textarea name="mail_buy_Html" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_buy])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit2' style='display:<?=$Os_Check?"block":"none"?>'>
										<tr>
											<td><input type=hidden name="bHtml" value="1"><?
											$form_name = "adm_etcForm";
											$form_content = "mail_buy";
											$cdiv = "cdiv_mail_buy";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="mail_buy" cols="90" rows="20"><?=htmlspecialchars($admin_row[mail_buy])?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan=2  height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit2('2');"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td align="center"><img src="image/preview.jpg" onclick="javascript:pre_view_mail('goods_order.php?_PRINT=1');" style="cursor:pointer"></td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;���� �������� email/goods_order.php<br>�� ��ǰ������ ���α׷� ó���Ǿ� �����Ƿ� ���������� ���� �����ؾ��ϸ� <b>�� ������ ������ HTML������忡���� ����</b>�ؾ� �մϴ�. �׷��� ������ ���̺��� ������ �ֽ��ϴ�. </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="30"></td>
							</tr>
							<tr valign="middle">
								<td width="250" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ��� ����</div></td>
								<td width="500" height="25"><?
								$bTramail_bHtml_chk[$admin_row[bTramail_bHtml]]="checked";
								?>
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="20%">�ۼ�Ÿ��&nbsp;:&nbsp;</td>
											<td width="80%"><INPUT TYPE="radio" NAME="bTramail_bHtml" value='1' onclick="document.getElementById('nsText3').style.display='block';document.getElementById('nsHtml3').style.display='none';document.getElementById('nsEdit3').style.display='none';" <?= $bTramail_bHtml_chk[1]?>>TEXT &nbsp; <INPUT TYPE="radio" NAME="bTramail_bHtml" value='2' <?=$Os_Check?"":"checked"?> onclick="document.getElementById('nsText3').style.display='none';document.getElementById('nsHtml3').style.display='block';document.getElementById('nsEdit3').style.display='none';" <?= $bTramail_bHtml_chk[2]?>>HTML &nbsp; <INPUT TYPE="radio" NAME="bTramail_bHtml" value='0' <?=$Os_Check?"checked":""?> onclick="document.getElementById('nsText3').style.display='none';document.getElementById('nsHtml3').style.display='none';document.getElementById('nsEdit3').style.display='block';" <?= $Use_Check?> <?= $bTramail_bHtml_chk[0]?>>��������</td>
										</tr>
										<tr>
											<td width="20%">��뿩��&nbsp;:&nbsp;</td>
											<td width="80%"><input type="radio" name="bTramail" value="y" <?=$true_bTramail?>>����� <input type="radio" name="bTramail" value="n" <?=$false_bTramail?>>������� ����</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" align='center'>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText3' style='display:none'>
										<tr>
											<td><textarea name="mail_trans_Text" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_trans])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml3' style='display:<?=$Os_Check?"none":"block"?>'>
										<tr>
											<td><textarea name="mail_trans_Html" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_trans])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit3' style='display:<?=$Os_Check?"block":"none"?>'>
										<tr>
											<td><input type=hidden name="bHtml" value="1"><?
											$form_name = "adm_etcForm";
											$form_content = "mail_trans";
											$cdiv = "cdiv_mail_trans";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="mail_trans" cols="90" rows="20"><?=htmlspecialchars($admin_row[mail_trans])?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan=2  height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit2('3');"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td align="center"><img src="image/preview.jpg" onclick="javascript:pre_view_mail('goods_trans.php?_PRINT=1');" style="cursor:pointer"></td>
										</tr>
										<tr>
											<td>&nbsp;���� �������� email/goods_trans.php<br>__GOOD_NAME : ��ǰ��<br>__TRANS_COMPANY : ��ۻ�<br>__TRANS_NUM : �����ȣ<br>__ADDRESS : �����<br>__RNAME : �޴»��<br>__RTEL : �޴»�� ����ó</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="30"></td>
							</tr>
							<tr valign="middle">
								<td width="250" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �ֹ���� ����</div></td>
								<td width="500" height="25"><?
								$bEscmail_bHtml_chk[$admin_row[bEscmail_bHtml]]="checked";
								?>
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="20%">�ۼ�Ÿ��&nbsp;:&nbsp;</td>
											<td width="80%"><INPUT TYPE="radio" NAME="bEscmail_bHtml" value='1' onclick="document.getElementById('nsText4').style.display='block';document.getElementById('nsHtml4').style.display='none';document.getElementById('nsEdit4').style.display='none';" <?= $bEscmail_bHtml_chk[1]?>>TEXT &nbsp; <INPUT TYPE="radio" NAME="bEscmail_bHtml" value='2' <?=$Os_Check?"":"checked"?> onclick="document.getElementById('nsText4').style.display='none';document.getElementById('nsHtml4').style.display='block';document.getElementById('nsEdit4').style.display='none';" <?= $bEscmail_bHtml_chk[2]?>>HTML &nbsp; <INPUT TYPE="radio" NAME="bEscmail_bHtml" value='0' <?=$Os_Check?"checked":""?> onclick="document.getElementById('nsText4').style.display='none';document.getElementById('nsHtml4').style.display='none';document.getElementById('nsEdit4').style.display='block';" <?= $Use_Check?> <?= $bEscmail_bHtml_chk[0]?>>��������</td>
										</tr>
										<tr>
											<td width="20%">��뿩��&nbsp;:&nbsp;</td>
											<td width="80%"><input type="radio" name="bEscmail" value="y" <?=$true_bEscmail?>>����� <input type="radio" name="bEscmail" value="n" <?=$false_bEscmail?>>������� ����</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" align='center'>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText4' style='display:none'>
										<tr>
											<td><textarea name="mail_cancel_Text" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_cancel])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml4' style='display:<?=$Os_Check?"none":"block"?>'>
										<tr>
											<td><textarea name="mail_cancel_Html" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_cancel])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit4' style='display:<?=$Os_Check?"block":"none"?>'>
										<tr>
											<td><input type=hidden name="bHtml" value="1"><?
											$form_name = "adm_etcForm";
											$form_content = "mail_cancel";
											$cdiv = "cdiv_mail_cancel";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="mail_cancel" cols="90" rows="20"><?=htmlspecialchars($admin_row[mail_cancel])?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan=2  height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit2('4');"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td align="center"><img src="image/preview.jpg" onclick="javascript:pre_view_mail('goods_order_cancel.php?_PRINT=1');" style="cursor:pointer"></td>
										</tr>
										<tr>
											<td>&nbsp;���� �������� email/goods_order_cancel.php<br>�� ��ǰ������ ���α׷� ó���Ǿ� �����Ƿ� ���������� ���� �����ؾ��ϸ� <b>�� ������ ������ HTML������忡���� ����</b>�ؾ� �մϴ�. �׷��� ������ ���̺��� ������ �ֽ��ϴ�.</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="30"></td>
							</tr>
							<tr valign="middle">
								<td width="250" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��й�ȣ �������</div></td>
								<td width="500" height="25"><?
								$bPassmail_bHtml_chk[$admin_row[bPassmail_bHtml]]="checked";
								?>
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="20%">�ۼ�Ÿ��&nbsp;:&nbsp;</td>
											<td width="80%"><INPUT TYPE="radio" NAME="bPassmail_bHtml" value='1' onclick="document.getElementById('nsText5').style.display='block';document.getElementById('nsHtml5').style.display='none';document.getElementById('nsEdit5').style.display='none';" <?= $bPassmail_bHtml_chk[1]?>>TEXT &nbsp; <INPUT TYPE="radio" NAME="bPassmail_bHtml" value='2' <?=$Os_Check?"":"checked"?> onclick="document.getElementById('nsText5').style.display='none';document.getElementById('nsHtml5').style.display='block';document.getElementById('nsEdit5').style.display='none';" <?= $bPassmail_bHtml_chk[2]?>>HTML &nbsp; <INPUT TYPE="radio" NAME="bPassmail_bHtml" value='0' <?=$Os_Check?"checked":""?> onclick="document.getElementById('nsText5').style.display='none';document.getElementById('nsHtml5').style.display='none';document.getElementById('nsEdit5').style.display='block';" <?= $Use_Check?> <?= $bPassmail_bHtml_chk[0]?>>��������</td>
										</tr>
										<tr>
											<td width="20%">��뿩��&nbsp;:&nbsp;</td>
											<td width="80%"><input type="radio" name="bPassmail" value="y" <?=$true_bPassmail?>>����� <input type="radio" name="bPassmail" value="n" <?=$false_bPassmail?>>������� ����</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" align='center'>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText5' style='display:none'>
										<tr>
											<td><textarea name="mail_pwd_Text" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_pwd])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml5' style='display:<?=$Os_Check?"none":"block"?>'>
										<tr>
											<td><textarea name="mail_pwd_Html" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_pwd])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit5' style='display:<?=$Os_Check?"block":"none"?>'>
										<tr>
											<td><input type=hidden name="bHtml" value="1"><?
											$form_name = "adm_etcForm";
											$form_content = "mail_pwd";
											$cdiv = "cdiv_mail_pwd";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="mail_pwd" cols="90" rows="20"><?=htmlspecialchars($admin_row[mail_pwd])?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="30"></td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan="2"  height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit2('5');"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td align="center"><img src="image/preview.jpg" onclick="javascript:pre_view_mail('pwd_edit.php?_PRINT=1');" style="cursor:pointer"></td>
										</tr>
										<tr>
											<td>&nbsp;���� �������� email/pwd_edit.php<br>__ID : ���̵� <br>__PW : ��й�ȣ</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="30"></td>
							</tr>
							<tr valign="middle">
								<td width="250" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���� �ϴ� ������</div></td>
								<td width="500" height="25" bgcolor="#FAFAFA"><?
								$bCommail_bHtml_chk[$admin_row[bCommail_bHtml]]="checked";
								?>
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width="20%">�ۼ�Ÿ��&nbsp;:&nbsp;</td>
											<td width="80%"><INPUT TYPE="radio" NAME="bCommail_bHtml" value='1' onclick="document.getElementById('nsText6').style.display='block';document.getElementById('nsHtml6').style.display='none';document.getElementById('nsEdit6').style.display='none';" <?= $bCommail_bHtml_chk[1]?>>TEXT &nbsp; <INPUT TYPE="radio" NAME="bCommail_bHtml" value='2' <?=$Os_Check?"":"checked"?> onclick="document.getElementById('nsText6').style.display='none';document.getElementById('nsHtml6').style.display='block';document.getElementById('nsEdit6').style.display='none';" <?= $bCommail_bHtml_chk[2]?>>HTML &nbsp; <INPUT TYPE="radio" NAME="bCommail_bHtml" value='0' <?=$Os_Check?"checked":""?> onclick="document.getElementById('nsText6').style.display='none';document.getElementById('nsHtml6').style.display='none';document.getElementById('nsEdit6').style.display='block';" <?= $Use_Check?> <?= $bCommail_bHtml_chk[0]?>>��������</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" align='center'>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsText6' style='display:none'>
										<tr>
											<td><textarea name="mail_bottom_Text" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_bottom])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsHtml6' style='display:<?=$Os_Check?"none":"block"?>'>
										<tr>
											<td><textarea name="mail_bottom_Html" style="width:100%" rows="25" cols="80"><?=htmlspecialchars($admin_row[mail_bottom])?></textarea></td>
										</tr>
									</table>
									<table width="600" cellpadding="0" cellspacing="0" border="0" id='nsEdit6' style='display:<?=$Os_Check?"block":"none"?>'>
										<tr>
											<td><input type=hidden name="bHtml" value="1"><?
											$form_name = "adm_etcForm";
											$form_content = "mail_bottom";
											$cdiv = "cdiv_mail_bottom";
											$dir_path = "..";
											include "../editor.php";
											?><textarea style="display:none" class="text" name="mail_bottom" cols="90" rows="20"><?=htmlspecialchars($admin_row[mail_bottom])?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="f5f5f5" colspan=2  height="40" valign="middle">
									<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><div align="center"><a href="javascript:etcSendit2('6');"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
										<tr>
											<td>&nbsp;���� �������� - �̸��� ���ۼҽ� ��ü <br>(������ �⺻������ �Էµ� ���� �״�� �����մϴ�.) <br>__comName : ��ȣ�� <br>__adminEmail : ������ �̸��� <br>__esailNum : ����Ǹž� �Ű� <br>__comNum : ����� ��Ϲ�ȣ<br>__comCeo : ��ǥ��<br>__comTel : ��ȭ��ȣ<br>__comFax : �ѽ�<br>__comAdr : �ּ� <br></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="30"></td>
							</tr>
							<tr>
								<td height='30' colspan="2"></td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td width='440'><img src="image/etc_mid_list.gif"></td>
										</tr>
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='5' colspan="2"></td>
							</tr>
							<tr>
								<td width="250" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ���� ��� (�����ڸ޴�)</td>
								<td width="500" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td><input name="goods_list_cnt" type="text" class="box" size=3 value="<?=$admin_row[goods_list_cnt]?>"> �� </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="250" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �ֹ����� ��� (�����ڸ޴�)</td>
								<td width="500" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td><input name="trade_list_cnt" type="text" class="box" size=3 value="<?=$admin_row[trade_list_cnt]?>"> �� </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="250" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ȸ������ ��� (�����ڸ޴�)</td>
								<td width="500" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td><input name="member_list_cnt" type="text" class="box" size=3 value="<?=$admin_row[member_list_cnt]?>"> �� </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="250" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �Խ��� ���(�����ȭ��)</td>
								<td width="500" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td><input name="board_list_cnt" type="text" class="box" size=3 value="<?=$admin_row[board_list_cnt]?>"> �� </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="250" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �˻���� ���(�����ȭ��)</td>
								<td width="500" height="25">
									<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td><input name="search_list_cnt" type="text" class="box" size=3 value="<?=$admin_row[search_list_cnt]?>"> �� </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="10"></td>
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