<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function smsSendit(Part)
{
	//���� ����
	var form=document.smsForm;
	form.part.value = Part;
	if(Part==1)
	{
		if(form.bSms[0].checked && form.userid.value=="")
		{
			alert("���̵� �Է��� �ֽʽÿ�.");
			form.userid.focus();
		}
		else if(form.bSms[0].checked && form.pwd.value=="")
		{
			alert("��й�ȣ�� �Է��� �ֽʽÿ�.");
			form.pwd.focus();
		}
		else
		{
			form.submit();
		}
	}
	else if(Part==2)
	{
		if(form.bSend1.checked && form.msg1.value=="")
		{
			alert("�޼����� �Է��� �ֽʽÿ�.");
			form.msg1.focus();
		}
		else if(form.bSend2.checked && form.msg2.value=="")
		{
			alert("�޼����� �Է��� �ֽʽÿ�.");
			form.msg2.focus();
		}
		else
		{
			form.submit();
		}
	}
	else if(Part==3)
	{
		if(form.bSend3.checked && form.msg3.value=="")
		{
			alert("�޼����� �Է��� �ֽʽÿ�.");
			form.msg3.focus();
		}
		else if(form.bSend4.checked && form.msg4.value=="")
		{
			alert("�޼����� �Է��� �ֽʽÿ�.");
			form.msg4.focus();
		}
		else
		{
			form.submit();
		}
	}
	else if(Part==4)
	{
		if(form.bSend5.checked && form.msg5.value=="")
		{
			alert("�޼����� �Է��� �ֽʽÿ�.");
			form.msg5.focus();
		}
		else
		{
			form.submit();
		}
	}
	else if(Part==6)
	{
		if(form.bSend8.checked && form.msg8.value=="")
		{
			alert("�޼����� �Է��� �ֽʽÿ�.");
			form.msg8.focus();
		}
		else
		{
			form.submit();
		}
	}
}
function checklen(form,fieldname,flag) //flag : 1 ȸ������, 2 : ���������� 
{
	var form=form;
	var msgtext, msglen;
	msgtext = eval("form."+fieldname).value;
	msglen = eval("form.msglen"+flag).value;
	var i=0,l=0;
	var temp,lastl;
	//���̸� ���Ѵ�.
	while(i < msgtext.length)
	{
		temp = msgtext.charAt(i);
		if (escape(temp).length > 4) l+=2;
		else if (temp!='\r') l++;
		if (temp=='\r' && l>79)
		{
			msgtext = msgtext.substr(0,i);
		}
		// OverFlow
		if(l>80)
		{
			alert("�޽������� ��� ���� �̻��� ���� ���̽��ϴ�.\n�޽��������� �ѱ� 40��, ����80�ڱ����� ���� �� �ֽ��ϴ�.");
			temp = msgtext.substr(0,i);
			msgtext = temp;
			l = lastl;
			i = msgtext.length;
			msglen=l;
			eval("form."+fieldname).focus();
			return;
			break;
		}
		lastl = l;
		i++;
	}
	eval("form.msglen"+flag).value = l;
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "sms";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	$sms = $MySQL->fetch_array("select * from smsinfo limit 0,1");
	$retel  = explode("-",$sms[retel]);
	$adminTel  = explode("-",$sms[adminTel]);
	$retel  = explode("-",$sms[retel]);
	?>
		<td width="85%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" height="400">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/sms_tit_l.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP SMS �޴������� ���񽺸� �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
								<td width='440'><img src="image/adm_mid_tit.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height='10'></td>
				</tr>
				<tr>
					<td valign="top">
						<form name="smsForm" method="post" action="sms_ok.php">
						<input type="hidden" name="part">
						<table width="796" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td valign="top" height="25">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="30" width="160" bgcolor="f2f2f2">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> SMS ���</td>
											<td height="30" colspan="3"> &nbsp; <input type="radio" name="bSms" value="1" <?if($sms[bSms])echo"checked";?>>����� <input type="radio" name="bSms" value="0" <?if(!$sms[bSms])echo"checked";?>>������� ����</td>
										</tr>
										<tr>
											<td height="1" colspan="4" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="30" bgcolor="f2f2f2">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���� ��ü</td>
											<td height="30" colspan="3"> &nbsp; <select name="company"><option value="icodekorea" <?if($sms[company]=="icodekorea") echo"selected";?>>icodekorea</option></select> <input type="radio" name="gubun" value="1" <?if($sms[gubun]==1)echo"checked";?>> ���� <input type="radio" name="gubun" value="2" <?if($sms[gubun]==2)echo"checked";?>> ����</td>
										</tr>
										<tr>
											<td height="1" colspan="4" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="30" bgcolor="f2f2f2">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���̵�</td>
											<td height="30" width="500"> &nbsp; <input type="text" class="box" name="userid" value="<?=$sms[userid]?>"> <font class="help">��(��)���÷��� ���ص��°��� ���̵�տ� <b>apl_</b> �� �ٿ��ּ���.</font></td>
										</tr>
										<tr>
											<td height="1" colspan="4" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="30" bgcolor="f2f2f2">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��й�ȣ</td>
											<td height="30" width="225"> &nbsp; <input type="password" class="box" name="pwd" size="10" value="<?=$sms[pwd]?>"></td>
										</tr>
										<tr>
											<td height="1" colspan="4" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="30" bgcolor="f2f2f2">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ǥ�õǴ� �����ڹ�ȣ</td>
											<td height="30" colspan="3"> &nbsp; <input type="text" class="box" name="adminTel1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$adminTel[0]?>"> - <input type="text" class="box" name="adminTel2" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$adminTel[1]?>"> - <input type="text" class="box" name="adminTel3" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$adminTel[2]?>">&nbsp;<font class="help">�� 1588-1111 ���� ���ڸ� ��ȣ�� �Ǿ��ڸ� �����Է��� ����μ���</font></td>
										</tr>
										<tr>
											<td height="1" colspan="4" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="30" bgcolor="f2f2f2">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ ���ſ� �޴��ȣ</td>
											<td height="30" colspan="3"> &nbsp; <input type="text" class="box" name="retel1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$retel[0]?>"> - <input type="text" class="box" name="retel2" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$retel[1]?>"> - <input type="text" class="box" name="retel3" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$retel[2]?>"></td>
										</tr>
										<tr>
											<td height="1" colspan="4" background="image/line_bg1.gif"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="30"> <div align="center"><a href="javascript:smsSendit(1);"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width='1' bgcolor='dadada' colspan='3'></td>
										</tr>
										<tr>
											<td width='440'><img src="image/sms_tit.gif"></td>
										</tr>
										<tr>
											<td width='1' bgcolor='dadada' colspan='3'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<FONT  COLOR="#CC3300">- �޼��� ������ <B>80 byte</B>(�ѱ� 40��)�� �ʰ��� ��� �޼����� ���۵��� �ʽ��ϴ�.</FONT></td>
							</tr>
							<tr>
								<td valign="top">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="40"><img src="image/design_main_icon.gif" width="21" height="11"> ȸ������</td>
										</tr>
										<tr>
											<td>
												<table width="750" border="0" cellspacing="1" cellpadding="10" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f4f4f4"><B>__NAME</B> : �̸�&nbsp;&nbsp;&nbsp;&nbsp;<B>__USERID</B> : ���̵�&nbsp;&nbsp;&nbsp;&nbsp;<B>__SITE</B> : ����Ʈ��</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
												<table width="750" border="0" cellspacing="1" cellpadding="0" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f2f2f2" height="30"> <div align="center"> <input type="checkbox" name="bSend1" value="1" <?if($sms[bSend1]) echo"checked";?>>ȸ�� ���� &nbsp;&nbsp;<font color="blue">���� ���� �� </font><font color="104E89"><input type="text" name="msglen1" class="nonbox" readonly value="<?=strlen($sms[msg1])?>" size="2"><input type="text" name="whole" class="nonbox" value="/ 80" readonly size="2" style="width:30;"></font></div></td>
														<td bgcolor="f2f2f2"> <div align="center"> <input type="checkbox" name="bSend2" value="1" <?if($sms[bSend2]) echo"checked";?>>������ ���� &nbsp;&nbsp;<font color="blue">���� ���� �� </font><font color="104E89"><input type="text" name="msglen2" class="nonbox" readonly value="<?=strlen($sms[msg2])?>" size="2"><input type="text" name="whole2" class="nonbox" value="/ 80" readonly size="2" style="width:30;"></font></div></td>
													</tr>
													<tr bgcolor="#FFFFFF">
														<td height="30"> <div align="center"> <textarea name="msg1" rows="6" cols="40" onKeyUp="javascript:checklen(this.form,this.name,1);"><?=$sms[msg1]?></textarea></div></td>
														<td> <div align="center"> <textarea name="msg2" rows="6" cols="40" onKeyUp="javascript:checklen(this.form,this.name,2);"><?=$sms[msg2]?></textarea></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30"> <div align="center"><a href="javascript:smsSendit(2);"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="40"><img src="image/design_main_icon.gif" width="21" height="11"> ��ǰ����</td>
										</tr>
										<tr>
											<td>
												<table width="750" border="0" cellspacing="1" cellpadding="10" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f4f4f4"><B>__WRITEDAY</B> : ���ų�¥&nbsp;&nbsp;&nbsp;&nbsp;<B>__NAME</B> : �ֹ��ڸ�&nbsp;&nbsp;&nbsp;&nbsp;<B>__GOODS</B> : ��ǰ��&nbsp;&nbsp;&nbsp;&nbsp;<B>__TRADECODE</B> : �ֹ��ڵ�<BR><B>__PAYMETHOD</B> : �������&nbsp;&nbsp;&nbsp;&nbsp;<B>__PRICE</B> : �����ݾ�&nbsp;&nbsp;&nbsp;&nbsp;<B>__CNT</B> : ����&nbsp;&nbsp;&nbsp;&nbsp;<B>__SITE</B> : ����Ʈ��</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
												<table width="750" border="0" cellspacing="1" cellpadding="0" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f2f2f2" height="30"> <div align="center"> <input type="checkbox" name="bSend3" value="1" <?if($sms[bSend3]) echo"checked";?>>ȸ�� ����&nbsp;&nbsp;<font color="blue">���� ���� �� </font><font color="104E89"><input type="text" name="msglen3" class="nonbox" readonly value="<?=strlen($sms[msg3])?>" size="2"><input type="text" name="whole" class="nonbox" value="/ 80" readonly size="2" style="width:30;"></font></div></td>
														<td bgcolor="f2f2f2"> <div align="center"> <input type="checkbox" name="bSend4" value="1" <?if($sms[bSend4]) echo"checked";?>>������ ����&nbsp;&nbsp;<font color="blue">���� ���� �� </font><font color="104E89"><input type="text" name="msglen4" class="nonbox" readonly value="<?=strlen($sms[msg4])?>" size="2"><input type="text" name="whole" class="nonbox" value="/ 80" readonly size="2" style="width:30;"></font></div></td>
													</tr>
													<tr bgcolor="#FFFFFF">
														<td height="30"> <div align="center"> <textarea name="msg3" rows="6" cols="40" onKeyUp="javascript:checklen(this.form,this.name,3);"><?=$sms[msg3]?></textarea></div></td>
														<td> <div align="center"> <textarea name="msg4" rows="6" cols="40" onKeyUp="javascript:checklen(this.form,this.name,4);"><?=$sms[msg4]?></textarea></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30"> <div align="center"><a href="javascript:smsSendit(3);"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="40"><img src="image/design_main_icon.gif" width="21" height="11">��ǰ���</td>
										</tr>
										<tr>
											<td>
												<table width="750" border="0" cellspacing="1" cellpadding="10" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f4f4f4"><B>__SITE</B> : ����Ʈ��&nbsp;&nbsp;&nbsp;&nbsp;<B>__NAME</B> : �ֹ��ڸ�&nbsp;&nbsp;&nbsp;&nbsp;<B>__GOODS</B> : ��ǰ��&nbsp;&nbsp;&nbsp;&nbsp;<B>__TRANSNUM</B> : �����ȣ&nbsp;&nbsp;&nbsp;&nbsp;<B>__SENDDAY</B> : �����</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
												<table width="750" border="0" cellspacing="1" cellpadding="0" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f2f2f2" height="30"> <div align="center"> <input type="checkbox" name="bSend5" value="1" <?if($sms[bSend5]) echo"checked";?>>ȸ�� ����&nbsp;&nbsp;<font color="blue">���� ���� �� </font><font color="104E89"><input type="text" name="msglen5" class="nonbox" readonly value="<?=strlen($sms[msg5])?>" size="2"><input type="text" name="whole" class="nonbox" value="/ 80" readonly size="2" style="width:30;"></font></div></td>
														<td bgcolor="f2f2f2"> <div align="center"> </div></td>
													</tr>
													<tr bgcolor="#FFFFFF">
														<td height="30"> <div align="center"> <textarea name="msg5" rows="6" cols="40" onKeyUp="javascript:checklen(this.form,this.name,5);"><?=$sms[msg5]?></textarea></div></td>
														<td width="50%"> <div align="center"> </div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30"> <div align="center"><a href="javascript:smsSendit(4);"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="40"><img src="image/design_main_icon.gif" width="21" height="11">�ֹ����</td>
										</tr>
										<tr>
											<td>
												<table width="750" border="0" cellspacing="1" cellpadding="10" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f4f4f4"><B>__SITE</B> : ����Ʈ��&nbsp;&nbsp;&nbsp;&nbsp;<B>__NAME</B> : �ֹ��ڸ�&nbsp;&nbsp;&nbsp;&nbsp;<B>__GOODS</B> : ��ǰ��&nbsp;&nbsp;&nbsp;&nbsp;<B>__PAYMETHOD</B> : �������&nbsp;&nbsp;&nbsp;&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
												<table width="750" border="0" cellspacing="1" cellpadding="0" bgcolor="cdcdcd">
													<tr>
														<td bgcolor="f2f2f2" height="30"> <div align="center"> <input type="checkbox" name="bSend8" value="1" <?if($sms[bSend8]) echo"checked";?>>�� ����&nbsp;&nbsp;<font color="blue">���� ���� �� </font><font color="104E89"><input type="text" name="msglen8" class="nonbox" readonly value="<?=strlen($sms[msg8])?>" size="2"><input type="text" name="whole" class="nonbox" value="/ 80" readonly size="2" style="width:30;"></font></div></td>
														<td bgcolor="f2f2f2"> <div align="center"> </div></td>
													</tr>
													<tr bgcolor="#FFFFFF">
														<td height="30"> <div align="center"> <textarea name="msg8" rows="6" cols="40" onKeyUp="javascript:checklen(this.form,this.name,8);"><?=$sms[msg8]?></textarea></div></td>
														<td width="50%"> <div align="center"> </div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30"> <div align="center"><a href="javascript:smsSendit(6);"><img src="image/save_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
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