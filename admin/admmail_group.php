<?
include "head.php";
if (__DEMOPAGE) $readonly = "readonly";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
var idxArr;
var Index;
function grpDel(idx)
{
	var choose = confirm("�ش�׷쳻 ��� �ּҷ� ������ �����˴ϴ�.\n\n���� �Ͻðڽ��ϱ�?");
	if(choose)
	{
		location.href="admmail_group_edit_ok.php?edit_part=del&idx=" + idx;
	}
	else return;
}
function grpSearch()
{
	var form = document.grpSearchForm;
	if(form.searchstring.value=="")
	{
		alert("�˻�� �Է��� �ֽʽÿ�.");
		form.searchstring.focus();
		return false;
	}
	else
	{
		return true;
	}
}

function allChek(part)
{
	o = document.f.chekidx;
	if ( o != null )
	{
		if ( o.length != null ) 
		{
			for ( var i = 0 ; i < o.length ; i++ )
			{
				o[i].checked = part;
			}
		}
		else 
		{
			o.checked = part;
		}
	}
}

function allDel()
{
	idxArr = new Array();
	Index = 0;
	o = document.f.chekidx;
	if ( o != null )
	{
		if ( o.length != null ) 
		{
			for ( var i = 0 ; i < o.length ; i++ )
			{
				if(o[i].checked)
				{
					idxArr[Index] = o[i].value;
					Index++;
				}
			}
		}
		else 
		{
			if(o.checked)
			{
				idxArr[Index] = o.value;
				Index++;
			}
		}
		if(Index)
		{
			location.href="admmail_group_edit_ok.php?edit_part=alldel&idxStr=" + idxArr.join("-");
		}
		else
		{
			alert("������ �׷��� �����ϴ�.");
		}
	}
	else
	{
		alert("������ �׷��� �����ϴ�.");
	}
}

function allMailSend()
{
	idxArr = new Array();
	Index = 0;
	o = document.f.chekidx;
	if ( o != null )
	{
		if ( o.length != null ) 
		{
			for ( var i = 0 ; i < o.length ; i++ )
			{
				if(o[i].checked)
				{
					idxArr[Index] = o[i].value;
					Index++;
				}
			}
		}
		else 
		{
			if(o.checked)
			{
				idxArr[Index] = o.value;
				Index++;
			}
		}
		if(Index)
		{
			location.href="admmail_write.php?w_to_grpIdxStr=" + idxArr.join("-");
		}
		else
		{
			alert("������ �׷��� �����ϴ�.");
		}
	}
	else
	{
		alert("������ �׷��� �����ϴ�.");
	}
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
										<? include "admmail_address_top.php";?>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="83"><a href="admmail_address.php"><img src="image/webmail/menu_1_1.gif" width="83" height="28" border="0"></a></td>
														<td width="83"><a href="admmail_group.php"><img src="image/webmail/menu_2.gif" width="83" height="28" border="0"></a></td>
														<td>&nbsp;</td>
														<td width="85"><a href="admmail_address_add.php"><img src="image/webmail/person_btn.gif" width="77" height="23" border="0"></a></td>
														<td width="80"><a href="admmail_group_add.php"><img src="image/webmail/group_btn.gif" width="77" height="23" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="7DBA0C" height="35">
												<form name="grpSearchForm" method="post" action="admmail_group.php" onsubmit="return grpSearch();">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td width="10">&nbsp;</td>
														<td>&nbsp;</td>
														<td width="70"><div align="center"><select name="search"><option value="name" selected>�׷��</option><option value="content">�׷켳��</option></select></div></td>
														<td width="85"> <input type="text" name="searchstring" size="12"></td>
														<td width="45"> <div align="center"><input type="image" src="image/webmail/search_btn.gif" width="35" height="17" border="0"></div></td>
													</tr>
												</table></form>
											</td>
										</tr>
										<tr>
											<td bgcolor="D6EFE7">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" height="30">
													<tr>
														<td width="70"> <div align="center"><a href="javascript:allChek(true);"><img src="image/webmail/all_btn.gif" width="61" height="17" border="0"></a></div></td>
														<td width="70"><a href="javascript:allChek(false);"><img src="image/webmail/select_cancel.gif" width="61" height="17" border="0"></a></td>
														<td width="80">������ �׷�</td>
														<td width="40"><a href="javascript:allDel();"><img src="image/webmail/delete_btn.gif" width="35" height="17" border="0"></a></td>
														<td><a href="javascript:allMailSend();"><img src="image/webmail/send_mail.gif" width="71" height="17" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td valign="top"><FORM NAME="f">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td colspan="5" height="1" bgcolor="cdcdcd"></td>
													</tr>
													<tr>
														<td height="30" width="40" bgcolor="f4f4f4"> <div align="center"> </div></td>
														<td height="30" width="180" bgcolor="f4f4f4"> <div align="center">�׷��</div></td>
														<td height="30" width="80" bgcolor="f4f4f4"> <div align="center">�׷쳻 ���μ�</div></td>
														<td height="30" bgcolor="f4f4f4"> <div align="center">�׷켳��</div></td>
														<td height="30" width="120" bgcolor="f4f4f4"> <div align="center">���� | ����</div></td>
													</tr>
													<tr>
														<td colspan="5" height="1" bgcolor="cdcdcd"></td>
													</tr>
													<tr>
														<td colspan="5" height="2" bgcolor="f4f4f4"></td>
													</tr><?
													$data=Decode64($data);
													$pagecnt=$data[pagecnt];
													$letter_no=$data[letter_no];
													$offset=$data[offset];
													if(!$searchstring)
													{
														$search=$data[search];
														$searchstring=$data[searchstring];
													}
													if($searchstring) $numresults=$MySQL->query("select idx from webmail_adr_grp where badmin=1 and $search like '%$searchstring%'");
													else $numresults=$MySQL->query("select idx from webmail_adr_grp where badmin=1");
													$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
													$LIMIT		= 15;
													$PAGEBLOCK	= 10;								//���� ������ ��
													if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
													if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
													if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
													if($searchstring)
													{
														$bbs_qry = "select * from webmail_adr_grp where badmin=1 and $search like '%$searchstring%' ";
														$bbs_qry.= " order by name asc limit $offset,$LIMIT";
													}
													else
													{
														$bbs_qry = "select * from webmail_adr_grp where badmin=1 order by name asc limit $offset,$LIMIT";
													}
													$bbs_result=$MySQL->query($bbs_qry);
													$s_letter=$letter_no;								//�������� ���� �۹�ȣ
													while($bbs_row=mysql_fetch_array($bbs_result))
													{
														$MySQL->query("select idx from webmail_adr where grp='$bbs_row[code]'");
														$adr_cnt = $MySQL->is_affected();
														?>
													<tr>
														<td height="30"> <div align="center"> <input type="checkbox" name="chekidx" value="<?=$bbs_row[idx]?>"></div></td>
														<td height="30"> <div align="center"><a href="admmail_group_edit.php?idx=<?=$bbs_row[idx]?>"><?=$bbs_row[name]?></a></div></td>
														<td height="30"> <div align="center"><?=$adr_cnt?></div></td>
														<td height="30"> <div align="center"><?=StringCut($bbs_row[content],20)?></div></td>
														<td height="30"> <div align="center"><a href="admmail_group_edit.php?idx=<?=$bbs_row[idx]?>"><img src="image/webmail/edit_btn.gif" width="35" height="17" border="0"></a> <a href="javascript:grpDel(<?=$bbs_row[idx]?>);"><img src="image/webmail/delete_btn.gif" width="35" height="17" border="0"></a> </div></td>
													</tr>
													<tr>
														<td colspan="5" height="1" background="image/webmail/bg2.gif"></td>
													</tr><?
														$letter_no--;
													}
													include "../lib/class.php";
													$Obj=new CList("admmail_group.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"");
													$pre_img = "<img src='image/webmail/prev_btn.gif' border='0'>";
													$next_img = "<img src='image/webmail/next_btn.gif' border='0'>";
													?>
												</table></form>
											</td>
										</tr>
										<tr>
											<td height="30" bgcolor="D6EFE7">
												<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td> <div align="center"><? $Obj->putList(true,$pre_img,$next_img);//�������� ����Ʈ ?></div></td>
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