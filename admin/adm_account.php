<?
// �ҽ��������
// 20060721-1 �����߰� �輺ȣ : ���ڰ��� ���� ������ ������������ ����
include "head.php";
if ($method =="all")
{
	if ($MySQL->query("UPDATE goods SET point=$p"))
	{
		OnlyMsgView("�����Ͽ����ϴ�.");
		$MySQL->query("UPDATE admin SET poTotal=$p");
	}
	Refresh("adm_account.php");
	exit;
}
else if ($method =="goods")
{
	if ($MySQL->query("UPDATE goods SET point=ROUND( price * ( $p /100 ), 0 )"))
	{
		OnlyMsgView("�����Ͽ����ϴ�.");
		$MySQL->query("UPDATE admin SET poUnit=$p");
	}
	Refresh("adm_account.php");
	exit;
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function enable_epay()
{
	var form=document.adm_accountForm;
	if(form.pgName.value == "none")
	{
		enable_pg_basic(false);
		enable_pg_rate('pg_rate', 0);
		enable_pg_rate('pg_rate_hand', 0);
		enable_pg_rate('pg_rate_iche', 0);
		enable_pg_rate('pg_rate_cyber', 0);
		enable_pg_etc(false, false, false, false);
	}
	else
	{
		enable_pg_basic(true);
		document.adm_accountForm.pG_test[0].style.background = "#dedede";
		document.adm_accountForm.pG_test[1].style.background = "#dedede";
		enable_pg_rate('pg_rate', form.bCardpay.value);
		enable_pg_rate('pg_rate_hand', form.bHpppay.value);
		enable_pg_rate('pg_rate_iche', form.bIchepay.value);
		enable_pg_rate('pg_rate_cyber', form.bCyberpay.value);
		check_Tmode();
	}
}

function check_Tmode()
{
	var form=document.adm_accountForm;
	if(form.pG_test[1].checked)	//��������
	{
		switch (form.pgName.value)
		{
			case "dacom" :	enable_pg_etc(true, false, true, false);	break;
			case "allat" :	enable_pg_etc(true, false, true, true);
				showObject(form.bHpppay, false);
				enable_pg_rate('pg_rate_hand', 0);
				break;
			case "inicis" :	enable_pg_etc(true, false, false, false);	break;
			default :		enable_pg_etc(true, false, false, false);	break;
		}
	}
	else	//�׽�Ʈ��
	{
		form.pG_test[0].checked = true;		//���� ���� ��쿡 ���� ó�� �ʿ�
		switch (form.pgName.value)
		{
			case "dacom" :	enable_pg_etc(true, false, true, false);	break;
			case "allat" :	enable_pg_etc(false, false, false, true);
				showObject(form.bHpppay, false);
				enable_pg_rate('pg_rate_hand', 0);
				break;
			case "inicis" :	enable_pg_etc(false, false, false, false);	break;
			default :		enable_pg_etc(false, false, false, false);	break;
		}
	}
}

function enable_pg_rate(rate_box, value)
{
	var target;
	switch (rate_box)
	{
		case "pg_rate"			: target=document.adm_accountForm.pg_rate;			break;
		case "pg_rate_hand"		: target=document.adm_accountForm.pg_rate_hand;		break;
		case "pg_rate_iche"		: target=document.adm_accountForm.pg_rate_iche;		break;
		case "pg_rate_cyber"	: target=document.adm_accountForm.pg_rate_cyber;	break;
	}
	var toggle = (value == 1) ? true:false;
	showObject(target, toggle);
}

function enable_pg_basic(bvalue)
{
	showObject(document.adm_accountForm.pG_test[0], bvalue);
	showObject(document.adm_accountForm.pG_test[1], bvalue);
	showObject(document.adm_accountForm.bCardpay, bvalue);
	showObject(document.adm_accountForm.bHpppay, bvalue);
	showObject(document.adm_accountForm.bIchepay, bvalue);
	showObject(document.adm_accountForm.bCyberpay, bvalue);
	showObject(document.adm_accountForm.pg_rate, bvalue);
	showObject(document.adm_accountForm.pg_rate_hand, bvalue);
	showObject(document.adm_accountForm.pg_rate_iche, bvalue);
	showObject(document.adm_accountForm.pg_rate_cyber, bvalue);
}

function enable_pg_etc(bShop_Id, bEscrow_Id, bPG_mertkey, bPG_encryption)
{
	showObject(document.adm_accountForm.shopId, bShop_Id);
	showObject(document.adm_accountForm.shop_Escrow_Id, bEscrow_Id);
	showObject(document.adm_accountForm.shop_pg_mertkey, bPG_mertkey);
	showObject(document.adm_accountForm.shop_pg_encryption, bPG_encryption);
}

function enable_bank()
{
	var form=document.adm_accountForm;
	var toggle = (form.bBankpay.value == 1) ? true:false;
	for(i=0; i<form.bBank.length; i++)
	{
		form.bBank[i].checked = toggle ? form.bBank[i].checked:false;
		showObject(form.bBank[i], toggle);
	}
	showBank();
}

//�������� disabled ��� �Լ�    ���� : bBank, bankName, bankId, bankOwn
function showBank()
{
	var form=document.adm_accountForm;
	for(i=0; i<form.bBank.length; i++)
	{
		if(form.bBank[i].checked)
		{
			//Ȱ��ȭ
			showObject(form.bankName[i],true);
			showObject(form.bankId[i],true);
			showObject(form.bankOwn[i],true);
			document.getElementById('bankTr_'+i).style.backgroundColor = "#E3EDF6";
		}
		else
		{
			//��Ȱ��ȭ
			showObject(form.bankName[i],false);
			showObject(form.bankId[i],false);
			showObject(form.bankOwn[i],false);
			document.getElementById('bankTr_'+i).style.backgroundColor = "#FAFAFA";
		}
	}
}

//�����ݻ�� disabled ��� �Լ�   ���� : bUsepoint, poReg, poMethod, poTotal, poUnit, poMin, poMax
function showPoint()
{
	var form=document.adm_accountForm;
	if(form.bUsepoint[0].checked)
	{
		//Ȱ��ȭ
		showObject(form.poReg,true);
		showObject(form.poMethod[0],true);
		showObject(form.poMethod[1],true);
		showObject(form.poTotal,true);
		showObject(form.poUnit,true);
		showObject(form.poMin,true);
		showObject(form.poMax,true);
		showObject(form.poMaxunlimit,true);
		showObject(form.popayM,true);
		showMethod();	//������ �߱� ���
		showPomax();	//������ �ִ� ���ݾ� �ѵ�, ������ ����
	}
	else
	{
		//��Ȱ��ȭ
		showObject(form.poReg,false);
		showObject(form.poMethod[0],false);
		showObject(form.poMethod[1],false);
		showObject(form.poTotal,false);
		showObject(form.poUnit,false);
		showObject(form.poMin,false);
		showObject(form.poMax,false);
		showObject(form.poMaxunlimit,false);
		showObject(form.popayM,false);
	}
}

//��ǰ���Ž� ������ �߱� ��� disabled ��� �Լ�  ���� : poMethod, poTotal, poUnit
function showMethod()
{
	var form=document.adm_accountForm;
	if(form.poMethod[0].checked)
	{
		//�ϰ�ó��
		showObject(form.poTotal,true);
		showObject(form.poUnit,false);
	}
	else
	{
		//��ǰ����
		showObject(form.poTotal,false);
		showObject(form.poUnit,true);
	}
}

//������ �ִ� ���ݾ� �ѵ�, ������ ����
function showPomax()
{
	var form=document.adm_accountForm;
	if(form.poMaxunlimit.checked) showObject(form.poMax,false);
	else showObject(form.poMax,true);
}

//�� ����
function accountSendit()
{
	//str_bBank str_bankName str_bankId str_bankOwn
	var form=document.adm_accountForm;
	var str_bBank		="";	//�ش����� ��뿩��
	var str_bankName	="";	//�ش����� ��
	var str_bankId		="";	//�ش����� ���¹�ȣ
	var str_bankOwn		="";	//�ش����� ������

	// hidden value ����
	for(i=0;i<form.bBank.length;i++)
	{
		//������ ��뿩��,�����,���¹�ȣ,������ ���ڿ�
		if(form.bBank[i].checked)		//ex) 1|0|1|0|0|
			str_bBank+="1|";
		else
			str_bBank+="0|";
		str_bankName	+=form.bankName[i].value	+"|";	//ex) ��������||�츮����|||
		str_bankId		+=form.bankId[i].value	+"|";		//ex) 12341|123-1-1|1345|||
		str_bankOwn		+=form.bankOwn[i].value	+"|";		//ex) ȫ�浿|��浿|tom|||
	}
	form.str_bBank.value	=str_bBank;
	form.str_bankName.value	=str_bankName;
	form.str_bankId.value	=str_bankId;
	form.str_bankOwn.value	=str_bankOwn;
	/******* disabled �� ���� �缳��  : disabled ������ isset()���� 'false' return  *******/
	form.str_poReg.value		=form.poReg.value;
	if(form.poMethod[0].checked) form.str_poMethod.value = "t";
	else form.str_poMethod.value = "b";
	form.str_poTotal.value		=form.poTotal.value;
	form.str_poUnit.value		=form.poUnit.value;
	form.str_poMin.value		=form.poMin.value;
	form.str_poMax.value		=form.poMax.value;
	if(form.poMaxunlimit.checked) form.str_poMaxunlimit.value	="1";
	else form.str_poMaxunlimit.value	="0";

	if((form.pgName.value == "none") && (form.bBankpay.value == 0))
	{
		alert("���� ����� �ϳ��̻� �����ϼž� �մϴ�.");
		form.bBankpay.value = 1;
		form.bBank[0].checked = true;
		enable_bank();
	}
	else if((form.bCardpay.value + form.bIchepay.value + form.bHpppay.value + form.bCyberpay.value + form.bBankpay.value) <= 0)
	{
		alert("���� ����� �ϳ��̻� �����ϼž� �մϴ�.");
		form.bBankpay.value = 1;
		form.bBank[0].checked = true;
		enable_bank();
	}
	else
	{
		form.submit();	//������
	}
}

function point_update()
{
	var form=document.adm_accountForm;
	if (form.poMethod[0].checked) 
	{
		location.href="adm_account.php?method=all&p="+form.poTotal.value;
	}
	else if(form.poMethod[1].checked) 
	{
		location.href="adm_account.php?method=goods&p="+form.poUnit.value;
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="javascript:enable_epay();enable_bank();showPoint();">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "basic";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select * from admin limit 0,1"); //������ ���� �迭
	}
	$bBank		=explode("|",$admin_row[bBank]);		//�����뿩�� �迭
	$bankName	=explode("|",$admin_row[bankName]);		//����� �迭
	$bankId		=explode("|",$admin_row[bankId]);		//���¹�ȣ �迭
	$bankOwn	=explode("|",$admin_row[bankOwn]);		//������ �迭
	?>
		<td width="85%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td align="center">
						<table width="750" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td rowspan="3" width="200"><img src="image/account_tit_.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �⺻������ �����ϽǼ� �ֽ��ϴ�.&nbsp;</font></div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center">
						<table width="750" border="0" cellspacing="0" cellpadding="0">
						<form name="adm_accountForm" method="post" action="adm_account_ok.php" enctype="multipart/form-data" >
						<input type="hidden" name="str_bBank"><!-- bBank ���ڿ� ex) 1|0|1|0|0| -->
						<input type="hidden" name="str_bankName"><!-- bankName ���ڿ� ex) ��������||�츮����|||  -->
						<input type="hidden" name="str_bankId"><!-- bankId ���ڿ� ex) 12341|123-1-1|1345||| -->
						<input type="hidden" name="str_bankOwn"><!-- bankOwn ���ڿ� ex) ȫ�浿|��浿|tom||| -->
						<!-- ���� disabled ������ �缳�� -->
						<input type="hidden" name="str_poReg">
						<input type="hidden" name="str_poMethod">
						<input type="hidden" name="str_poTotal">
						<input type="hidden" name="str_poUnit">
						<input type="hidden" name="str_poMin">
						<input type="hidden" name="str_poMax">
						<input type="hidden" name="str_poMaxunlimit">
						<input type="hidden" name="str_noTrans">
						<input type="hidden" name="str_transCom">
						<input type="hidden" name="str_transMoney">
						<!-- �̻� disabled ������ �缳�� -->
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td><img src="image/account_min_tit.gif"></td>
										</tr>
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="4"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="150" height="30" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> PG ��ü ����</td>
											<td><select name="pgName" size="1" onchange="enable_epay();"><option value="none"<?if($admin_row[pgName]=="") echo " selected";?>>::: ���Ҵ���� ���� :::</option>
												<option value="dacom"<?if($admin_row[pgName]=="dacom") echo " selected";?>>������</option>
												<option value="allat"<?if($admin_row[pgName]=="allat") echo " selected";?>>�þ�</option>
												<option value="inicis"<?if($admin_row[pgName]=="inicis") echo " selected";?>>�̴Ͻý�</option></select>&nbsp;&nbsp;<a href="http://webprogram.co.kr/faq_view.php?seq=10499&return_url=L2ZhcV9saXN0LnBocD9tYW5hZ2VyX3NlcT02" target="_blank"><img src='image/btn_pg.gif' border='0'></a><p>
												<table width="600" border="0" cellspacing="1" cellpadding="5" bgcolor='#898989'>
													<tr>
														<td width="150" bgcolor="#DEDEDE"><input type="radio" name="pG_test" value="y" onclick="check_Tmode();"<?if($admin_row[pG_test]=='y') echo " checked";?>>�׽�Ʈ�� ���ϴ� ���</td>
														<td width="450" bgcolor="#FFFFFF">1.������ PG��ü�� ���� ����� �׽�Ʈ�� �� �ִ� ������ �����մϴ�.<br>2.�׽�Ʈ ����� �̿��� ������ ������ ī���� �������� �ʽ��ϴ�.<br>&nbsp;&nbsp;(��, <font color="#FF0000">������ü�� ���</font>���� �����Ա��� �̷���� �� �����Ƿ� <font color="#FF0000">����</font> �ٶ��ϴ�.)</td>
													</tr>
													<tr>
														<td bgcolor="#DEDEDE"><input type="radio" name="pG_test" value="n" onclick="check_Tmode();"<?if($admin_row[pG_test]=='n') echo " checked";?>>PG ��ü�� ������<br>&nbsp;&nbsp;&nbsp;&nbsp;���ϴ� ���</td>
														<td width="450" bgcolor="#FFFFFF">1.������ PG��ü�� ���� ����� ����� �� �ֵ��� �����մϴ�.<br>2.������ ���θ� ��� ���� PG��ü�� ���� ����� �����Ϸ���<br>&nbsp;&nbsp;1)PG�� ��� <a href="http://webprogram.co.kr/faq_view.php?seq=10499&return_url=L2ZhcV9saXN0LnBocD9tYW5hZ2VyX3NlcT02" target="_blank"><img src='image/btn_pg.gif' border='0'></a><br>&nbsp;&nbsp;2)PG�� ���� (�������� ���� �뺸)<br>&nbsp;&nbsp;3)PG�� ��������� �����ϰ� �������̵�� ������� �Է�<br>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://webprogram.co.kr/service.php" target="_blank"><img src='image/btn_service2.gif' border='0'></a><br>&nbsp;&nbsp;4)ī��� �ɻ�(�� 7�� �ҿ� : PG��� ����)</td>
													</tr>
												</table><br><font class="help">�� �������� ������� ������ ���� <font color="#FF0000">�ݵ�� �������ҿ��� ���� ��û</font>�� ���ֽñ� �ٶ��ϴ�.</font>&nbsp;<a href="http://webprogram.co.kr/service.php" target="_blank"><img src='image/btn_service.gif' border='0'></a><p><font class="help">�� ����ǥ�� ������ ���񽺴� <b>����� �⺻ž��</b> �Ǿ� �ֽ��ϴ�. ������� �ʿ�ÿ��� <b>��������</b> �����մϴ�.</font><br>
												<table width="600" border="0" cellspacing="1" cellpadding="0" bgcolor='#898989'>
													<tr align="center">
														<td height="25" bgcolor="#DEDEDE"></td>
														<td width="100" bgcolor="#DEDEDE">������</td>
														<td width="100" bgcolor="#DEDEDE">�þ�</td>
														<td width="100" bgcolor="#DEDEDE">�̴Ͻý�</td>
														<td width="100" bgcolor="#DEDEDE">��ŸPG��</td>
													</tr>
													<tr bgcolor="#FFFFFF" align="center">
														<td height="25" bgcolor="#DEDEDE">ī�����</td>
														<td>�⺻ž��</td>
														<td>�⺻ž��</td>
														<td>�⺻ž��</td>
														<td><font color="#FF0000">��������</font></td>
													</tr>
													<tr bgcolor="#FFFFFF" align="center">
														<td height="25" bgcolor="#DEDEDE">�� �� ��</td>
														<td>�⺻ž��</td>
														<td><font class="help">��������</font></td>
														<td>�⺻ž��</td>
														<td><font color="#FF0000">��������</font></td>
													</tr>
													<tr bgcolor="#FFFFFF" align="center">
														<td height="25" bgcolor="#DEDEDE">������ü</td>
														<td>�⺻ž��</td>
														<td>�⺻ž��</td>
														<td>�⺻ž��</td>
														<td><font color="#FF0000">��������</font></td>
													</tr>
													<tr bgcolor="#FFFFFF" align="center">
														<td height="25" bgcolor="#DEDEDE">�������</td>
														<td>�⺻ž��</td>
														<td>�⺻ž��</td>
														<td>�⺻ž��</td>
														<td><font color="#FF0000">��������</font></td>
													</tr>
													<tr bgcolor="#FFFFFF" align="center">
														<td height="25" bgcolor="#DEDEDE">����ũ��</td>
														<td><font color="#FF0000">��������</font></td>
														<td><font color="#FF0000">��������</font></td>
														<td><font color="#FF0000">��������</font></td>
														<td><font color="#FF0000">��������</font></td>
													</tr>
													<tr bgcolor="#FFFFFF" align="center">
														<td height="25" bgcolor="#DEDEDE">���ݿ�����</td>
														<td><font color="#FF0000">��������</font></td>
														<td><font color="#FF0000">��������</font></td>
														<td><font color="#FF0000">��������</font></td>
														<td><font color="#FF0000">��������</font></td>
													</tr>
												</table>
												<p><font class="help">�� <b>����ũ��, ���ݿ�����</b> �� <b>������� �Ա��뺸 ���Ÿ�� ����</b>�� �⺻ž�� �Ǿ����� ���� �׸��Դϴ�.</font><p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���� ���̵�</td>
											<td> <input class="box"type="text" name="shopId" size="20" value="<?=$admin_row[shopId]?>"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr valign="middle">
											<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �������</td>
										</tr>
										<tr>
											<td height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="5"></td>
										</tr>
									</table>
									<table width="750" border="0" cellspacing="1" cellpadding="0" bgcolor='#898989'>
										<tr align="center">
											<td width="150" height="25" bgcolor="#DEDEDE">�������</td>
											<td bgcolor="#DEDEDE">ī�����</td>
											<td bgcolor="#DEDEDE">�ڵ�������</td>
											<td bgcolor="#DEDEDE">������ü</td>
											<td bgcolor="#DEDEDE">�������(PG�� ������)</td>
										</tr>
										<tr align="center" bgcolor="#FFFFFF">
											<td height="25">��뿩��</td>
											<td><select name="bCardpay" onchange="enable_pg_rate('pg_rate', this.value);"><option value="1" style="background-color:#4081b9;color:#FFFFFF;"<?if($admin_row[bCardpay] == 1) echo " selected";?>>�����</option><option value="0" style="background-color:#CBC7C0;"<?if($admin_row[bCardpay] == 0) echo " selected";?>>������</option></select></td>
											<td><select name="bHpppay" onchange="enable_pg_rate('pg_rate_hand', this.value);"><option value="1" style="background-color:#4081b9;color:#FFFFFF;"<?if($admin_row[bHpppay] == 1) echo " selected";?>>�����</option><option value="0" style="background-color:#CBC7C0;"<?if($admin_row[bHpppay] == 0) echo " selected";?>>������</option></select></td>
											<td><select name="bIchepay" onchange="enable_pg_rate('pg_rate_iche', this.value);"><option value="1" style="background-color:#4081b9;color:#FFFFFF;"<?if($admin_row[bIchepay] == 1) echo " selected";?>>�����</option><option value="0" style="background-color:#CBC7C0;"<?if($admin_row[bIchepay] == 0) echo " selected";?>>������</option></select></td>
											<td><select name="bCyberpay" onchange="enable_pg_rate('pg_rate_cyber', this.value);"><option value="1" style="background-color:#4081b9;color:#FFFFFF;"<?if($admin_row[bCyberpay] == 1) echo " selected";?>>�����</option><option value="0" style="background-color:#CBC7C0;"<?if($admin_row[bCyberpay] == 0) echo " selected";?>>������</option></select></td>
										</tr>
										<tr align="center" bgcolor="#FFFFFF">
											<td height="25" rowspan="2">PG�� ������</td>
											<td><input class="box"type="text" name="pg_rate" size="4" style="text-align:right;" value="<?=$admin_row[pg_rate]?>"> %</td>
											<td><input class="box"type="text" name="pg_rate_hand" size="4" style="text-align:right;" value="<?=$admin_row[pg_rate_hand]?>"> %</td>
											<td><input class="box"type="text" name="pg_rate_iche" size="4" style="text-align:right;" value="<?=$admin_row[pg_rate_iche]?>"> %</td>
											<td><input class="box"type="text" name="pg_rate_cyber" size="4" style="text-align:right;" value="<?=$admin_row[pg_rate_cyber]?>"> %</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="40"><font class="help">�� �� ������ <b>������� ,��ǰ �����ٿ�ޱ�</b> �� <b>�����ֹ� �߼��ڷ�</b>���� ���Ǿ����ϴ�.<br>&nbsp;&nbsp;�ſ�ī�� ~ ������� ������� <b>�������Ҵ���(PG)��� ����</b>���� �Է��մϴ�.</font></td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td><img src="image/account_min_tit1.gif"></td>
										</tr>
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="4"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����ũ�� ���̵�</td>
											<td><input class="box"type="text" name="shop_Escrow_Id" size="20" value="<?=$admin_row[shop_Escrow_Id]?>">&nbsp;<font class="help">�� <b>�̴Ͻý� ����ũ�� ������</b>���� �Է��ϴ� �׸� �Դϴ�. </font></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���� ����Ű</td>
											<td><input class="box"type="text" name="shop_pg_mertkey" size="35" value="<?=$admin_row[shop_pg_mertkey]?>">&nbsp;<font class="help">�� ��� : ������, �þ�</font></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> Open SSL</td>
											<td><select name="shop_pg_encryption" size="1"><option value="y"<?if($admin_row[shop_pg_encryption]=="y") echo " selected";?>>�����</option><option value="n"<?if($admin_row[shop_pg_encryption]=="n") echo " selected";?>>������</option></select>&nbsp;<font class="help">�� ��� : �þ� (<a style="cursor:pointer;" onclick="javascript:window.open('../AllplanPG/allat/ssltest.php');"><font class="help"><b>Open SSL �������ɿ��� Ȯ���ϱ�</b></font></a>)</font></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td><img src="image/account_min_tit2.gif"></td>
										</tr>
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="4"></td>
							</tr>
							<tr valign="middle">
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���� ��ü ������</td>
											<td><select name="bBankpay" onchange="enable_bank();"><option value="1" style="background-color:#4081b9;color:#FFFFFF;"<?if($admin_row[bBankpay] == 1) echo" selected";?>>�����</option><option value="0" style="background-color:#CBC7C0;"<?if($admin_row[bBankpay] == 0) echo" selected";?>>������</option></select></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td height="25">
									<table width="750" border="0" cellspacing="0" cellpadding="0"><?
									for($i=0;$i<10;$i++)
									{
										if($bBank[$i])	$bBank_chek =" checked";
										else			$bBank_chek ="";
										?>
										<tr id="bankTr_<?=$i?>">
											<td height='25'width="74" align="center">&nbsp;<input type="checkbox" name="bBank" onclick="javascript:showBank();"<?=$bBank_chek?>></td>
											<td width="53"><div align="center"><img src="image/icon.gif" width="11" height="11">�����</div></td>
											<td width="77"><input class="box"name="bankName" type="text" id="bankName" size="10" value="<?=$bankName[$i]?>"></td>
											<td width="70"><div align="center"><img src="image/icon.gif" width="11" height="11">���¹�ȣ</div></td>
											<td width="152"><input class="box"name="bankId" type="text" id="bankId" size="19" value="<?=$bankId[$i]?>"> </td>
											<td width="59"><div align="center"><img src="image/icon.gif" width="11" height="11">������</div></td>
											<td width="65"><input class="box"name="bankOwn" type="text" id="bankOwn" size="8" value="<?=$bankOwn[$i]?>"> </td>
										</tr><?
									}
									?>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td><img src="image/account_min_tit3.gif"></td>
										</tr>
										<tr>
											<td height='1' bgcolor='DADADA'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="4"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ ��� </td>
											<td width="10"> <div align="center"> <input class="radio" type="radio" value="1" name="bUsepoint" onclick="javascript:showPoint();"<?if($admin_row[bUsepoint]) echo " checked";?>></div></td>
											<td> <div align="left">�����</div></td>
											<td width="10"> <div align="center"> <input class="radio"type="radio" value="0" name="bUsepoint" onclick="javascript:showPoint();"<?if(!$admin_row[bUsepoint]) echo " checked";?>></div></td>
											<td> <div align="left">������� ����</div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ȸ�����Խ� (��)</td>
											<td><input class="box"type="text" name="poReg" size="10" <?=__ONLY_NUM?> style="text-align:right;" value="<?=$admin_row[poReg]?>"> </td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ ��Ͻ�<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���������� ����</td>
											<td valign="middle">
												<table width="600" border="0" cellspacing="0" cellpadding="0">
													<tr valign="middle">
														<td width="120"><input class="radio"type="radio" value="t" name="poMethod" onclick="javascript:showMethod();"<?if($admin_row[poMethod]=="t") echo " checked";?>>&nbsp;&nbsp; �ϰ�ó�� (��)</td>
														<td width="120"><input class="box"type="text" name="poTotal" size="10" <?=__ONLY_NUM?> style="text-align:right;" value="<?=$admin_row[poTotal]?>"> </td>
														<td width="360" rowspan="2" valign=middle><a href="javascript:point_update();"><img src="image/point_update.gif" border=0></a></td>
													</tr>
													<tr valign="middle">
														<td><input class="radio"type="radio" value="b" name="poMethod" onclick="javascript:showMethod();"<?if($admin_row[poMethod]=="b") echo " checked";?>>&nbsp;&nbsp; ��ǰ���� (%) </div></td>
														<td><input class="box"type="text" name="poUnit" size="5" style="text-align:right;" value="<?=$admin_row[poUnit]?>"> </td>
													</tr>
													<tr>
														<td colspan="3" height=40 valign=middle><font class="help">�� �������� �ٲ��� <b>[�����ϱ�]��ưŬ����</b> ���� ��ϵǾ��ִ� ��ǰ�� ���缳����� <b>�ϰ�����</b>�˴ϴ�.<br>�� �������� �ٲٰ� ������ �ϸ� <b>������ ��ϵǴ� ��ǰ</b>���͸� �ٲ� �������� ����˴ϴ�.<br>�� ȸ�� ����� �ִٸ� <b>ȸ����ް���</b>���� �������� �����մϴ�. </font></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="250" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǰ�����ı� �ۼ���</td>
											<td width="500"> &nbsp;&nbsp; <input class="box"type="text" name="write_goodsP" size="10" <?=__ONLY_NUM?> style="text-align:right;" value="<?=$admin_row[write_goodsP]?>"> �� ���� &nbsp;<font class="help">�� ���� ����Ϸ� ó���� �ϸ鼭 ��ǰ�����ı⸦ �����Ҷ�</font></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="35" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ ��밡���� ���űݾ� (��)</td>
											<td> &nbsp;&nbsp; �����ݾ��� <input class="box"type="text" name="popayM" size="9" <?=__ONLY_NUM?> style="text-align:right;" value="<?=$admin_row[popayM]?>"> �� �̻���� ������ ��밡�� </td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ �ּ� ��밡�� �ݾ� (��)</td>
											<td> &nbsp;&nbsp; <input class="box"type="text" name="poMin" size="20" <?=__ONLY_NUM?> style="text-align:right;" value="<?=$admin_row[poMin]?>"> </td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td height="35" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������ �ִ� ��밡�� �ݾ� (��)</td>
											<td> &nbsp;&nbsp; <input class="box"type="text" name="poMax" size="20" <?=__ONLY_NUM?> style="text-align:right;" value="<?=$admin_row[poMax]?>"> &nbsp;&nbsp;<input class="radio"type="checkbox" value="1" name="poMaxunlimit" onclick="javascript:showPomax();"<?if($admin_row[poMaxunlimit]) echo " checked";?>> ������</td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="8"></td>
							</tr>
							<tr>
								<td height="40" valign="middle">
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
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>