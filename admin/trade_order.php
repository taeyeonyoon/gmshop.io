<?
// �ҽ��������
// 20060720-1 �ҽ����� �輺ȣ : ������� ���� ����ȭ(ī��, �ڵ���, ������ü, �������, ������)
//								�������� ����($pG_Cracked)������ ��ȭ
// 20060724-1 �����߰� �輺ȣ : ����������
include "head.php";
/////////������ �ֹ� ����///////////
if ($select_del=="y")
{
	$str_arr = explode("/",$str);
	for ($i=0; $i<count($str_arr); $i++)
	{
		$row = $MySQL->fetch_array("SELECT tradecode from trade WHERE idx='$str_arr[$i]' limit 1");
		if ($row[tradecode])
		{
			$qry="DELETE from trade WHERE tradecode='$row[tradecode]'";
			$MySQL->query($qry);		
			$qry="DELETE from trade_goods WHERE tradecode='$row[tradecode]'";
			$MySQL->query($qry);
		}
	}
	OnlyMsgView("�Ϸ��Ͽ����ϴ�.");
	Refresh("trade_order.php");
	exit;
}

include "../lib/class.php";
$trans_start=0;	// �ֹ����� �ϰ����� ������ġ (�ֹ�����)
$trans_company = $admin_row[transCom];	//��ۻ�

$now = time();
$now = date("Y-m-d",$now);
$now = explode("-",$now);

if (!$year) // ��¥���Ǿ�����
{
	$year = $now[0] - 1;
	$month = $now[1];
	$day = $now[2];
	$year2 = $now[0];
	$month2 = $now[1];
	$day2 = $now[2];

	if (strlen($day)==1) $day = "0".$day;
	if (strlen($month)==1) $month = "0".$month;
	if (strlen($day2)==1) $day2 = "0".$day2;
	if (strlen($month2)==1) $month2 = "0".$month2;
	$start = $year."-".$month."-".$day;
	$end = $year2."-".$month2."-".$day2;
}
else // ��¥����������
{
	if (strlen($day)==1) $day = "0".$day;
	if (strlen($month)==1) $month = "0".$month;
	if (strlen($day2)==1) $day2 = "0".$day2;
	if (strlen($month2)==1) $month2 = "0".$month2;
	$start = $year."-".$month."-".$day;
	$end = $year2."-".$month2."-".$day2;
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
var tradeArr = new Array();
<?
for($i=0;$i<count($TRADE_ARR);$i++)
{
	?>
tradeArr[<?=$i?>] = "<?=$TRADE_ARR[$i]?>";
<?
}
?>

//////////////////// �ŷ����� �ϰ�����
function goodsChangeStatus2(changeIndex)
{
	changeIndex = changeIndex -1;

	var trans_Index = 2;
	var trans_Index2 = 3;
	if (document.all.status_id.selectedIndex == 0)
	{
		alert("������ �ŷ����¸� �������ֽʽÿ�.");
	}
	else if (document.viewForm.select_str.value == "")
	{
		alert("������ �ֹ������ �������ֽʽÿ�.");
	}
	else if (changeIndex==trans_Index || changeIndex==trans_Index2)	//////////// �����,��ۿϷ�� �ٲܶ��� ������ �׸���� �����ȣ üũ��
	{
		var selectstr_Arr = new Array();
		var err_form="";
		var selectstr_Arr = document.viewForm.select_str.value.split("/");
		var formno_Arr = document.viewForm.formno_str.value.split("/");
		var tn;
		for (var i=0; i < selectstr_Arr.length -1 ; i++)
		{
			var transForm = eval("document.goodtype_form"+formno_Arr[i]);
			if (transForm.trans_num.value)
			{
				tn = transForm.trans_num.value;
			}
			else
			{
				tn = 0;
			}
			if (transForm.trans_num.value=="" || transForm.trans_num.value==0)
			{
				err_form = err_form + (parseInt(formno_Arr[i])+1) + ", ";	///////////// �����ȣ �Է¾ȵ� ��ϻ��� ��ȣ�� ����
				transForm.idxno.checked = false;
				idxno_click("false",selectstr_Arr[i],formno_Arr[i],tn);	//////// ���� �����ȣ�� �Է��ϸ� ������ �ȵǹǷ� üũ�ڽ��� ������ ����
			}
		}
		if (err_form)  ///////////// ��ۻ�,�����ȣ �Է¾ȵ� ��ϻ��� ��ȣ�� ���â���� ���
		{
			alert(err_form + "�� �׸��� ��ۻ� �Ǵ� �����ȣ�� �Էµ��� �ʾҽ��ϴ�. �Է��� �ش� üũ�ڽ��� �ٽ� �������ֽʽÿ�.");
		}
		else
		{
			//CONFIRM WINDOW
			var choose = confirm("������ �׸��� �ŷ����¸� �����մϴ�. \n\n["+tradeArr[changeIndex]+"] ���·� �����Ͻðڽ��ϱ�?");
			if(choose)
			{
				document.viewForm.status.value = changeIndex;
				document.viewForm.target = "ifrm";
				document.viewForm.submit();
			}
			else
			{
				return;
			}
		}
	}
	else
	{
		document.viewForm.status.value = changeIndex;
		document.viewForm.target = "ifrm";
		document.viewForm.submit();
	}
}

//////////�ϰ������� �ֹ� ����////
function del_select_item()
{
	if (confirm("�����Ͻ� �ֹ����� ���� �����Ͻðڽ��ϱ�?"))
	{
		location.href="trade_order.php?select_del=y&str="+document.viewForm.select_str.value;	
	}
}

///////////�ϰ�����//////////////////
function checkAll()
{
	var str="";
	var formno="";
	var transnum_str="";
	for (var i=0; i<document.forms.length; i++)
	{
		var formname = document.forms[i].name;
		var formname_str = formname.substring(0,13);
		if (formname_str == "goodtype_form")
		{
			for (var j=0;j<document.forms[i].elements.length -1 ;j++)
			{
				if (document.forms[i].elements[j].name == "idxno")
				{
					if (document.forms[i].elements["idxno"].checked == true)
					{
						document.forms[i].elements["idxno"].checked = false;
						str="";
						formno="";
						transnum_str="";
					}
					else
					{
						document.forms[i].elements["idxno"].checked = true;
						str = document.forms[i].elements["idxno"].value + "/" + str;
						formno = document.forms[i].elements["formno"].value + "/" + formno;
						transnum_str = document.forms[i].elements["trans_num"].value + "/" + transnum_str;
					}
				}
			}
		}
	}
	document.viewForm.select_str.value = str;
	document.viewForm.formno_str.value = formno;
	document.viewForm.transnum_str.value = transnum_str;
}

///////////////��������/////////////////////
function idxno_click(bCheck,val,formcnt,transnum)
{
	if (bCheck == true && document.all.status_id.value=="" && document.all.sel_del.selectedIndex==0)
	{
		alert("���� ������ �ŷ����¸� üũ �Ǵ� \n�ֹ��� �����ÿ��� ���� ���úκ��� ������ ������ �ֽʽÿ�.");
		var Obj = eval("document.goodtype_form"+formcnt);
		Obj.idxno.checked = false;
	}
	else if (bCheck == true)
	{
		/// �ŷ����¸� �����,��ۿϷ�� �ٲٷ��� �Ҷ� üũ�ڽ��� ���� ������ (�����ȣ �Է¾���ä) ���
		if ((document.all.status_id.value==2 || document.all.status_id.value==3) && transnum==0)
		{
			var Obj = eval("document.goodtype_form"+formcnt);
			alert("�ŷ����¸� �����, ��ۿϷ�� �ٲٷ��� üũ�ڽ��� ǥ������ �̸� �����ȣ�� �Է��ؾ� �մϴ�.");
			Obj.idxno.checked = false;
			var tgood_obj = eval("document.all.tgood_id"+formcnt);
			tgood_obj.style.display = "inline";
			Obj.trans_num.focus();
		}
		else
		{
			var str= document.viewForm.select_str.value;
			var formno= document.viewForm.formno_str.value;
			var transnum_str= document.viewForm.transnum_str.value;
			str = val + "/" + str;
			formno = formcnt + "/" + formno;
			transnum_str = transnum + "/" + transnum_str;
			document.viewForm.select_str.value = str;
			document.viewForm.formno_str.value = formno;
			document.viewForm.transnum_str.value = transnum_str;
		}
	}
	else ////////// üũ������ �ش� ���� ���� ( '/' ���ڿ� üũ)
	{
		var str="";
		var formno="";
		var transnum_str="";
		for (var i=0; i<document.forms.length; i++)
		{
			var formname = document.forms[i].name;
			var formname_str = formname.substring(0,13);
			if (formname_str == "goodtype_form")
			{
				for (var j=0;j<document.forms[i].elements.length -1 ;j++)
				{
					if (document.forms[i].elements[j].name == "idxno")
					{
						if (document.forms[i].elements["idxno"].checked == true)
						{
							str = document.forms[i].elements["idxno"].value + "/" + str;
							formno = document.forms[i].elements["formno"].value + "/" + formno;
							transnum_str = document.forms[i].elements["trans_num"].value + "/" + transnum_str;
						}
						else
						{
						}
					}
				}
			}
		}
		document.viewForm.select_str.value = str;
		document.viewForm.formno_str.value = formno;
		document.viewForm.transnum_str.value = transnum_str;
	}
}

function searchSendit()
{
	var form=document.searchForm;
	form.bSearch.value = "true";
	form.submit();
}

function tradeTotalMail()
{
	window.open("../email/mail.php?trade=1","","scrollbars=yes,left=200,top=50,width=620,height=530");
}

function del_trade(year,month,day)
{
	var tmp_day = year+"Ҵ"+month+"��"+day+"��";
	if (confirm(tmp_day + " ������ �ֹ������� �����Ͻðڽ��ϱ�?"))
	{
		document.delForm.submit();
	}
}

function trade_order_view(data)
{
	window.open("trade_order_view.php?data="+data,"","scrollbars=yes,left=10,top=10,width=800,height=700");
}

function trade_goods()
{
	window.open("trade_goods.php","","scrollbars=yes,left=10,top=10,width=800,height=700");
}

function trade_goods_trans()
{
	window.open("trade_goods_trans.php","","scrollbars=yes,left=10,top=10,width=1000,height=700");
}

function trade_trans()
{
<?
	switch($admin_row[transCom])
	{
		case '�������':
			echo "	location.href='trade_trans_dh.php';\n";
			break;
		case '��ü��':
			echo "	location.href='trade_trans_post.php';\n";
			break;
		case 'CJ GLS�ù�':
			echo "	location.href='trade_trans_cj.php';\n";
			break;
		case '�����ù�':
			echo "	location.href='trade_trans_hd.php';\n";
			break;
		case '�����ù�':
			echo "	location.href='trade_trans_hd.php';\n";
			break;
		case '�Ｚ�ù�':
			echo "	location.href='trade_trans_sam.php';\n";
			break;
		case 'Ʈ����ù�':
			echo "	location.href='trade_trans_tranet.php';\n";
			break;
		default :
			echo "	alert('�ش��ü�� ���õ� ���忢�������� �����Ǿ� ���� �ʽ��ϴ�.');\n";
			break;
	}
?>
}

function tg_show(cnt)
{
	obj = eval("document.getElementById('tgood_id"+cnt+"')");
	obj1 = eval("document.getElementById('tgood_id"+cnt+"_1')");
	if (obj.style.display == "block")
	{
		obj.style.display = "none";
		obj1.style.display = "block";
	}
	else if (obj.style.display == "none")
	{
		obj.style.display = "block";
		obj1.style.display = "none";
	}
}
//-->
</SCRIPT>
<?
if ($admin_row[bTrade])
{
	?>
<meta http-equiv='refresh' content='120'>
<?
}
	?>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<form name="viewForm" method="post" action="status_change.php">
<input type="hidden" name="status_list_change" value="y">	<!-- ��ϻ󿡼� �ŷ����º������� status_change.php �� �뺸 -->
<input type="hidden" name="select_str" value="">	<!-- �ֹ� idx ���幮�� -->
<input type="hidden" name="formno_str" value="">	<!-- goodType_form $cnt ��ȣ ���幮��-->
<input type="hidden" name="transnum_str" value="">	<!-- �����ȣ ���幮�� -->
<input type="hidden" name="status" value="">	<!--  �ٲ� �ŷ����� -->
</form>
<iframe name="ifrm" frameborder=0 width=0 height=0></iframe>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "order";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
		?>
		<td width="85%" valign="top" height="400">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="800" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/order_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �ֹ����� ���� ���� ���� �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td width='1' bgcolor='dadada'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/order_tit_img_1.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td valign="top">
						<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td valign="top">
									<form name="searchForm" method="post" action="trade_order.php">
									<input type='hidden' name='bSearch' value='<?=$bSearch?>'>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<!-- -------------------------------------------------�ֹ� �˻� ����----------------------------------------------------------- -->
										<tr>
											<td height="30"  width="90%">
												<table width="800" border="0" align="center" bgcolor="#F5F5F5">
													<tr>
														<td valign=middle colspan="5">
														<select name="paym">
															<option value="0" <? if (!$paym) echo "selected";?>>���������</option>
															<option value="card" <? if ($paym=="card") echo "selected";?>>ī�����</option>
															<option value="hand" <? if ($paym=="hand") echo "selected";?>>�ڵ���</option>
															<option value="iche" <? if ($paym=="iche") echo "selected";?>>������ü</option>
															<option value="cyber" <? if ($paym=="cyber") echo "selected";?>>�������</option>
															<option value="bank" <? if ($paym=="bank") echo "selected";?>>�������Ա�</option>
														</select>
														<select name="status">
															<option value="6" <? if (!isset($status)) echo "selected";?>>���ŷ�����</option>
															<option value="0" <? if (isset($status) && $status==0) echo "selected";?>><?=$TRADE_ARR[0]?></option>
															<option value="1" <? if ($status==1) echo "selected";?>><?=$TRADE_ARR[1]?></option>
															<option value="2" <? if ($status==2) echo "selected";?>><?=$TRADE_ARR[2]?></option>
															<option value="3" <? if ($status==3) echo "selected";?>><?=$TRADE_ARR[3]?></option>
															<option value="4" <? if ($status==4) echo "selected";?>><?=$TRADE_ARR[4]?></option>
															<option value="5" <? if ($status==5) echo "selected";?>><?=$TRADE_ARR[5]?></option>
														</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<select name="search">
															<!--<option value="0" selected>���⺻�˻�</option>-->
															<option value="name" <? if ($search=="name") echo "selected";?>>�ֹ��ڸ�</option>
															<option value="tradecode" <? if ($search=="tradecode") echo "selected";?>>�ֹ��ڵ�</option>
															<option value="userid" <? if ($search=="userid") echo "selected";?>>�ֹ��ھ��̵�</option>
															<option value="rname" <? if ($search=="rname") echo "selected";?>>������</option>
														</select>
														<input class="box" type="text" name="searchstring" size="15" value="<?=$searchstring?>">
														<!--<a href="javascript:searchSendit();"><img src="image/bbs_search_btn.gif" width="41" height="23" border="0"></a>-->
														<input onfocus="this.blur()" value="�� &nbsp;&nbsp;��" type="button" style="font-weight:bold;background-color:black;color:white" onclick="searchSendit()">
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30" bgcolor="#ffffff">
												<table width="800" border="0" align="center">
													<tr bgcolor="#F5F5F5">
														<td width="680">
															<select name="year"><?
															for ($i=$now[0]; $i>1999; $i--)
															{
																if(strlen($i)==1) $real_date_data = "0".$i;
																else		$real_date_data = $i;
																?>
																<option value="<?=$real_date_data?>" <? if ($real_date_data == $year) echo "selected";?>><?=$i?></option><?
															}
																?>
															</select>��
															<select name="month"><?
															for ($i=1; $i<13; $i++)
															{
																if(strlen($i)==1) $real_date_data = "0".$i;
																else		$real_date_data = $i;
																?>
																<option value="<?=$real_date_data?>" <? if ($real_date_data == $month) echo "selected";?>><?=$i?></option><?
															}
																?>
															</select>��
															<select name="day"><?
															for ($i=1; $i<32; $i++)
															{
																if(strlen($i)==1) $real_date_data = "0".$i;
																else		$real_date_data = $i;
																?>
																<option value="<?=$real_date_data?>" <? if ($real_date_data == $day) echo "selected";?>><?=$i?></option><?
															}
																?>
															</select>�� ~ 
															<select name="year2"><?
															for ($i=$now[0]; $i>1999; $i--)
															{
																if(strlen($i)==1) $real_date_data = "0".$i;
																else		$real_date_data = $i;
															?>
																<option value="<?=$real_date_data?>" <? if ($real_date_data == $year2) echo "selected";?>><?=$i?></option><?
															}
																?>
															</select>��
															<select name="month2"><?
															for ($i=1; $i<13; $i++)
															{
																if(strlen($i)==1) $real_date_data = "0".$i;
																else		$real_date_data = $i;
																?>
																<option value="<?=$real_date_data?>" <? if ($real_date_data == $month2) echo "selected";?>><?=$i?></option><?
															}
																?>
															</select>��
															<select name="day2"><?
															for ($i=1; $i<32; $i++)
															{
																if(strlen($i)==1) $real_date_data = "0".$i;
																else		$real_date_data = $i;
																?>
																<option value="<?=$real_date_data?>" <? if ($real_date_data == $day2) echo "selected";?>><?=$i?></option><?
															}
																?>
															</select>��&nbsp;&nbsp;<a href="javascript:tradeTotalMail();"><img src="image/mail_all.gif" height="23" border="0"></a><?
															if ($status==6 || !isset($status))
															{
																?>&nbsp;<a href="trade_order_excel.php?paym=<?=$paym?>&search=<?=$search?>&searchstring=<?=$searchstring?>&start=<?=$start?>&end=<?=$end?>"><img src='image/excel_down.gif' border='0'></a><?
															}
															else
															{
																?>&nbsp;<a href="trade_order_excel.php?status=<?=$status?>&paym=<?=$paym?>&search=<?=$search?>&searchstring=<?=$searchstring?>&start=<?=$start?>&end=<?=$end?>"><img src='image/excel_down.gif' border='0'></a><?
															}
																?>
														</td>
													</tr>
													<tr>
														<td>
															<table>
																<tr>
																	<td><a href="#;" onclick="trade_goods();"><img src="../admin/image/trade_goods.gif"></a></td>
																	<td>&nbsp;&nbsp;��&nbsp;&nbsp;</td>
																	<td><a href="#;" onclick="trade_goods_trans();"><img src="../admin/image/trade_goods_trans.gif"></a></td>
																	<td>&nbsp;&nbsp;��&nbsp;&nbsp;</td>
																	<td><a href="#;" onclick="trade_trans();"><img src="../admin/image/trade_trans.gif"></a></td>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;<A href="adm_trans.php"><img src="../admin/image/go_admtrans.gif"></a></td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									</form>
									<!-- -------------------------------------------------�ֹ� �˻� ��----------------------------------------------------------- -->
								</td>
							</tr><?
							///////////������ �ֹ�,��� ����//////////////////////////////
							$today = date("Y-m-d");
							$todayTrade_qry = "select idx from trade_goods where left(sday1,10)='$today' $MALL_STR group by tradecode ";
							$todayTradeCnt	= $MySQL->articles($todayTrade_qry);		//������ �ֹ�
							?>
							<tr>
								<td>
									<table width=100% border=0>
										<tr>
											<td width="80%"><font color="#0000FF">������ �׸��� �ֹ����¸� ��� </font>
												<select name="status" id="status_id">
													<option value="">���ŷ����º���</option><?
													for($i=$trans_start;$i<count($TRADE_ARR);$i++)
													{
														?>
													<option value="<?=$i?>"><?=$TRADE_ARR[$i]?></option><?
													}//for
														?>
												</select>�� �����մϴ�.
												&nbsp;<img align="absmiddle" src="../admin/image/price_change.jpg" onclick="goodsChangeStatus2(document.all.status_id.selectedIndex);" style="cursor:pointer;">
											</td>
											<td align="right"><font color="#0000FF">�� ������ �ֹ� :<b> <?=$todayTradeCnt?> </b>�� </font></td>
										</tr>
										<tr>
											<td colspan="2"><font color="#0000FF">������ �׸��� �ֹ����¸� ��� </font>
												<select name="sel_del" id="sel_del">
													<option>������</option>
													<option>����</option>
												</select>&nbsp;<img align="absmiddle" src="../admin/image/price_change.jpg" onclick="del_select_item();" style="cursor:pointer;">
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr valign="middle">
								<td valign="top">
									<table width="800" border="0" cellspacing="1" cellpadding="0" align='center' bgcolor='#cdcdcd'>
										<tr height="25">
											<td width="30"  bgcolor="#EBEBEB"><div align="center"><input type="checkbox" onclick="checkAll();"></a></div></td>
											<td width="150" bgcolor="#ebebeb"><div align="center">�ֹ�����</div></td>
											<td width="110" bgcolor="#ebebeb" align="center">�ֹ���¥</td>
											<td width="100" bgcolor="#ebebeb"><div align="center">�ֹ���/�Ա���</div></td>
											<td width="90" bgcolor="#ebebeb"><div align="center">ȸ������</div></td>
											<td width="130" bgcolor="#ebebeb"><div align="center">�����ݾ�</div></td>
											<td width="70" bgcolor="#ebebeb"><div align="center">�������</div></td>
											<td width="70" bgcolor="#ebebeb"><div align="center">�ŷ�����</div></td><?
											if ($admin_row[bTransmethod]=="y")	/// ��۹�� ����
											{
											?>
											<td  width="70"  bgcolor="#ebebeb"><div align="center">��۹��</div></td><?
											}
											?>
										</tr>
										<!-- �ֹ� ��� ���� --><?
										$data=Decode64($data);
										$pagecnt=$data[pagecnt];
										$letter_no=$data[letter_no];
										$offset=$data[offset];
										if(!$searchstring)			//�˻�
										{
											$search=$data[search];
											$searchstring=$data[searchstring];
										}
										if (!isset($status) || $status==6) $status_str="1=1";
										else if ($status == 0) $status_str = "status=$status";
										else $status_str = "status=$status";
										if($searchstring)//�˻�
											$numresults_qry = "select * from trade where $status_str and $search like '%$searchstring%' $MALL_SEARCH_STR";
										else
											$numresults_qry = "select * from trade where $status_str $MALL_SEARCH_STR";
										if(!empty($paym))
											$numresults_qry.= " and payMethod='$paym'";
										if (!empty($start)) $numresults_qry.= " and left(writeday,10) between '$start' and '$end' ";
										if($gubun)
										{
											if($gubun=="M") $numresults_qry.=" and level_gubun='$gubun'";
											else if($gubun=="D") $numresults_qry.=" and level_gubun='$gubun'";
										}
										$numrows=$MySQL->articles($numresults_qry);
										if ($numrows)
										{
											if($searchstring)//�˻�
											$qry = "select sum(payM) from trade where $status_str and $search like '%$searchstring%' ";
											else
												$qry = "select sum(payM) from trade where $status_str";
											if(!empty($paym))
												$qry.= " and payMethod='$paym'";
											if (!empty($start)) $qry.= " and left(writeday,10) between '$start' and '$end'";
											if($gubun)
											{
												if($gubun=="M") $qry.=" and level_gubun='$gubun'";
												else if($gubun=="D") $qry.=" and level_gubun='$gubun'";
											}
											$total_price = mysql_result($MySQL->query($qry),0);
										}
										// �� ����� ���� ����¡ ������ ����
										$LIMIT		= $admin_row[trade_list_cnt];							//�������� �� ��
										//$LIMIT=5;
										$PAGEBLOCK	=10;								//���� ������ ��
										$total_page = ceil($numrows / $LIMIT);
										if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ
										if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��
										if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
										//////////����Ȯ�� ����ϰ�� �Ա��� ������ ����////////////
										if ($status==1) $bbs_qry = $numresults_qry." order by sday2 desc limit $offset,$LIMIT";
										else $bbs_qry = $numresults_qry." order by idx desc limit $offset,$LIMIT";
										$bbs_result=$MySQL->query($bbs_qry);
										$now2 = time();
										$now2 = date("Y-m-d",$now2);
										$cnt = 0;
										while($bbs_row=mysql_fetch_array($bbs_result))
										{
											$encode_str = "idx=".$bbs_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
											$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
											$data=Encode64($encode_str);					//�� ���ڵ� ����
											if($bbs_row[payMethod] =="card")		$payMethod="<font color=red>ī�����</font>";
											else if($bbs_row[payMethod] =="hand")	$payMethod="<font color=red>�ڵ���</font>";
											else if($bbs_row[payMethod] =="iche")	$payMethod="<font color=red>������ü</font>";
											else if($bbs_row[payMethod] =="cyber")	$payMethod="<font color=green>�������</font>";
											else if($bbs_row[payMethod] =="bank")	$payMethod="<font color=green>������</font>";
											else if($bbs_row[payMethod] =="point")	$payMethod="������";
											//else					 $payMethod="�̰���";
											if($bbs_row[pG_Cracked] != "") $payMethod.="<br>(".$bbs_row[pG_Cracked].")";
											if ($bbs_row[payMethod] =="bank") $payer = "/<font color=green>$bbs_row[payer]</font>";
											else $payer = "";
											$name = "<FONT  COLOR='#6600FF'>".$bbs_row[name]."</FONT>";
											if ($bbs_row[level_gubun]=="M")
											{
												$level_gubun = "�Ϲ�ȸ��";
											}
											else if ($bbs_row[level_gubun]=="D")
											{
												$level_gubun = "����";
											}
											else
											{
												$level_gubun = "��ȸ��";
											}

											/////////�ֹ���ǰ����////////////
											$tg_row=$MySQL->fetch_array("select status,name from trade_goods where tradecode='$bbs_row[tradecode]' $MALL_STR limit 1");
											$tg_num = $MySQL->articles("select idx from trade_goods where tradecode='$bbs_row[tradecode]' $MALL_STR");
											$tg_status = $tg_row[status];
											if ($tg_row[status]==0) $st_str = $TRADE_ARR[$tg_status];
											else if ($tg_row[status]==1) $st_str = "<font color=brown>$TRADE_ARR[$tg_status]</font>";
											else if ($tg_row[status]==2) $st_str = "<font color=blue>$TRADE_ARR[$tg_status]</font>";
											else if ($tg_row[status]==3) $st_str = "<font color=green>$TRADE_ARR[$tg_status]</font>";
											else if ($tg_row[status]==4) $st_str = "<font color=red>$TRADE_ARR[$tg_status]</font>";
											else if ($tg_row[status]==5) $st_str = "<font color=red>$TRADE_ARR[$tg_status]</font>";
											else $st_str ="";
											$trans_ing_num = $MySQL->articles("SELECT idx from trade_goods WHERE tradecode='$bbs_row[tradecode]' and status=2 $MALL_STR");	//������ΰ�
											$trans_cancel_num = $MySQL->articles("SELECT idx from trade_goods WHERE tradecode='$bbs_row[tradecode]' and status=4 $MALL_STR");	//�ֹ�����ΰ�
											$trans_bp_num = $MySQL->articles("SELECT idx from trade_goods WHERE tradecode='$bbs_row[tradecode]' and status=5 $MALL_STR");//��ǰ�ΰ�
											if(!$bbs_row[bPay])	/// �ֹ������Ϸ� ���϶�
											{
												$order_diff_time = time() - strtotime($bbs_row[writeday]);	// ����ð� - �ֹ��ð� ����
												if ($order_diff_time < 1800)	/// �ֹ��������� 30���� ���� �ʾ�����
												{
													$st_str="�ֹ�������";
												}
												else
												{
													$st_str="�̰���";
												}
											}
											if ($tg_num>1)  $tgood_intro = StringCut($tg_row[name],10)."��ǰ ��".($tg_num-1);
											else $tgood_intro = StringCut($tg_row[name],18);
											$tprice = $bbs_row[payM];
											if (strlen($bbs_row[hand])>3) $tel = $bbs_row[hand];
											else $tel = $bbs_row[tel];

											/////�����ֹ� ����ó��//////
											if ($now2 == substr($bbs_row[writeday],0,10)) $NEW_IMG = "<img src='../upload/goods_new_img'>";
											else $NEW_IMG = "";
											?>
										<form name="goodtype_form<?=$cnt?>" method="post">
										<tr bgcolor="fafafa">
											<td><div align="center"><input type="checkbox" name="idxno" value="<?=$bbs_row[idx]?>" onclick="idxno_click(this.checked,this.value,<?=$cnt?>,this.form.trans_num.value)"><input type="hidden" name="formno" value="<?=$cnt?>"></div></td>
											<td>
												<table width=100%>
													<tr>
														<td align="left" height="15" onMouseOver="this.style.backgroundColor='#9ED6C0'" onMouseOut="this.style.backgroundColor=''"><a href="javascript:trade_order_view('<?=$data?>');"><FONT  COLOR="#000000"><B><u><?=$bbs_row[tradecode]?></u></B></FONT></a>&nbsp;<?=$NEW_IMG?></td>
													</tr>
													<tr>
														<td align="left" onMouseOver="this.style.backgroundColor='#ffd700'" onMouseOut="this.style.backgroundColor=''"><a onclick="tg_show(<?=$cnt?>);" style="cursor:pointer"><u><b><?=$tgood_intro?> ��</b></u></a></td>
													</tr>
												</table>
											</td>
											<td><div align="center"><?=str_replace("-",".",$bbs_row[writeday])?><?
											if ($bbs_row[status]==1) echo "<br><b>������¥<BR>".$bbs_row[sday2]."</b>";
											?></div></td>
											<td><div align="center"><?=$name?><?=$payer?></div></td>
											<td><div align="center"><?=$level_gubun?></div></td>
											<td align=right><?
											if ($bbs_row[useP])
											{
												?><img src="../upload/goods_point_img"><?
											}
											if ($bbs_row[useP] && !$bbs_row[payM])
											{
												?><font style="font-size:11px">���������װ���</font> &nbsp;<FONT  COLOR="#CC0000">(<?=PriceFormat($bbs_row[useP])?>)</FONT>&nbsp;<?
											}
											else
											{
												?>&nbsp;<FONT  COLOR="#CC0000"><?=PriceFormat($tprice)?></FONT>&nbsp;&nbsp;<?
											}
											?></td>
											<td><div align="center"><B><?=$payMethod?></B></div></td>
											<td><div align="center"><?=$st_str?><? if ($trans_ing_num) echo "<br>����� : ".$trans_ing_num; if ($trans_cancel_num) echo "<br><font color=red><b>��� : ".$trans_cancel_num."</b></font>"; if ($trans_bp_num) echo "<br><font color=red><b>��ǰ : ".$trans_bp_num."</b></font>"; ?></div></td>
											<?
											if ($admin_row[bTransmethod]=="y")	/// ��۹�� ����
											{
												?>
											<td ><div align="center"><?
											if ($bbs_row[transMethod]=="T") echo "�ù�";
											else if ($bbs_row[transMethod]=="K") echo "�浿ȭ��";
											else if ($bbs_row[transMethod]=="Q") echo "�����";
											?></div></td><?
											}
											?>
										</tr>
										<tr>
											<td colspan="9" bgcolor="#FFFFFF" align="center">
												<table width="750" border="0" cellspacing="0" cellpadding="0" id="tgood_id<?=$cnt?>_1" style="display:block";>
													<tr>
														<td height="25" width="800">�� �ֹ���ǰ���� Ŭ���ϼ���.</td>
													</tr>
												</table>
												<table width="750" border="0" cellspacing="1" cellpadding="0" bgcolor='#000000' id="tgood_id<?=$cnt?>" style="display:none">
													<tr>
														<td height="20" bgcolor='ebebeb' width="250"><div align="center"><img src="image/icon.gif" width="11" height="11"> ��ǰ��</div></td>
														<td bgcolor='ebebeb' width="150"><div align="center"><img src="image/icon.gif" width="11" height="11"> �ɼ�</div></td>
														<td bgcolor='ebebeb' width="100"><div align="center"><img src="image/icon.gif" width="11" height="11"> <FONT COLOR="#993300">����</FONT>/<FONT COLOR="#6633FF">����</FONT></div></td>
														<td bgcolor='ebebeb' width="100"><div align="center"><img src="image/icon.gif" width="11" height="11"> ��ǰ�հ�(��)</div></td>
														<td bgcolor='ebebeb' width="100"><div align="center"><img src="image/icon.gif" width="11" height="11"> �ŷ�����</div></td>
													</tr><?
													$trade_goods_qry ="select * from trade_goods where tradecode='$bbs_row[tradecode]' $MALL_STR";
													$trade_goods_result = @$MySQL->query($trade_goods_qry) or die("Err. : $trade_goods_qry");
													while($trade_goods_row = mysql_fetch_array($trade_goods_result))
													{
														$goods_row = $MySQL->fetch_array("SELECT *from goods WHERE idx=$trade_goods_row[goodsIdx] limit 1");
														$optionArr = Array("$trade_goods_row[option1]","$trade_goods_row[option2]","$trade_goods_row[option3]");	//�ɼ� �迭
														$tg_tprice = $trade_goods_row[price]*$trade_goods_row[cnt];	//��ǰ�հ���
														?>
													<tr height="30">
														<td  bgcolor="ffffff" valign="middle"><div align="center"><?=$trade_goods_row[name]?></div></td>
														<td  bgcolor="ffffff"><div align="center">
															<table width="100%" border="0" cellspacing="0" cellpadding="0"><?
															for($i=0;$i<count($optionArr);$i++)
															{
																if(!empty($optionArr[$i]))
																{
																	$option = explode("����",$optionArr[$i]);
																	?>
																<tr>
																	<td width="100"  bgcolor="#F7F7F7"><div align="center"><?=$option[0]?> </div></td>
																	<td   bgcolor="#DDFFFB"><div align="left"> : <?=$option[1]?></div></td>
																</tr>
																<tr bgcolor="#CCCCCC">
																	<td colspan="2" height="1"></td>
																</tr><?
																}
															}
															?>
															</table></div>
														</td>
														<td bgcolor="ffffff"><div align="center"><FONT COLOR="#993300"><?=PriceFormat($trade_goods_row[price])?></font> / <FONT COLOR="#6633FF"><?=$trade_goods_row[cnt]?></font></div></td>
														<td  bgcolor="ffffff"><div align="right"><FONT COLOR="#990000"><?=PriceFormat($tg_tprice)?></FONT></div></td>
														<td  bgcolor="ffffff"><div align="right"><?
															if ($bbs_row[bPay]==0) echo "�̰���";
															else  echo $TRADE_ARR[$trade_goods_row[status]];
															?></div></td>
													</tr><?
															if ($trade_goods_row[trans_num]) $trans_num = $trade_goods_row[trans_num];
															else $trans_num = 0;
														}//while
														if ($bbs_row[payMethod]=="bank")
														{
															?>
													<tr height="30" bgcolor="#ffffff">
														<td colspan="6">[�Ա����� : <?=$bbs_row[bankInfo]?>] &nbsp;[�Աݿ����� : <?=$bbs_row[bankDay]?>] &nbsp;[�Ա��ڸ� : <?=$bbs_row[payer]?>]</td>
													</tr><?
														}
															?>
													<tr height="30" bgcolor="#ffffff">
														<td colspan="6">�����ȣ <input style="background-color:#CBCCF8" type="text" class="box" name="trans_num" value="<?=$trans_num?>">&nbsp;&nbsp;<font class="help">�� ��ϻ󿡼� <b>�ŷ������ϰ� �߼ۿϷ� �Ǵ� ����Ϸ�� ����ÿ���</b> �̸� �Է��س��ƾ� �մϴ�.</font></td>
													</tr>
												</table>
											</td>
										</tr>
										</form><?
											$cnt++;
										}//while
										?>
										<!-- �ֹ� ��� �� --><?
										/****************************************************************************************************************************
										CList(char* pagename,int pagecnt,int offset,int numrows,int pageblock,int limit,char* search,char* searchstring,char* option)
										putList( BOOL pniView, char* pre_icon, char* next_icon)
										****************************************************************************************************************************/
										if (isset($status) && ($status>0 || $status==0)) $optionStr="paym=$paym&start=$start&end=$end&status=$status&year=$year&month=$month&day=$day&year2=$year2&month2=$month2&day2=$day2";
										else $optionStr="paym=$paym&start=$start&end=$end&year=$year&month=$month&day=$day&year2=$year2&month2=$month2&day2=$day2";
										$Obj=new CList("trade_order.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,$optionStr);
										?>
									</table>
								</td>
							</tr>
							<form name="delForm" method="post" action="trade_edit_ok.php">
							<input type="hidden" name="del_trade" value="1">
							<tr valign="middle">
								<td valign="top" align="center"><br>
									<table width="100%" border="0" bgcolor="#FFFFFF" align="center" cellspacing=0>
										<tr bgcolor="#D7F0FA">
											<td width="50%" align="left" height=30>
												<select name="ye"><?
												for ($i=$now[0]; $i>$now[0]-5; $i--)
												{
													?>
													<option value="<?=$i?>"><?=$i?></option><?
												}
													?>
												</select>��
												<select name="mo"><?
												for ($i=1; $i<13; $i++)
												{
													?>
													<option value="<?=$i?>" <? if ($i == $month) echo "selected";?>><?=$i?></option><?
												}
												?>
												</select>��
												<select name="da">
												<?
												for ($i=1; $i<32; $i++)
												{
													?>
													<option value="<?=$i?>" <? if ($i == $day) echo "selected";?>><?=$i?></option><?
												}
													?>
												</select>�� ������ �ֹ�����
												<a href="javascript:del_trade(document.delForm.ye.value,document.delForm.mo.value,document.delForm.da.value);"><img src="image/delete_btn.gif" border=0></a></td>
											<td align=right>�� <?=$total_page?> pages / �ڷ� <?=$numrows?>�� / �հ�ݾ� : <?=PriceFormat($total_price)?> ��</td>
										</tr>
										<tr>
											<td colspan=2 height=30><div align="center"><?$Obj->putList(true,"","");//�������� ����Ʈ?> </div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form>
							<tr valign="middle">
								<td valign="top">&nbsp;</td>
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