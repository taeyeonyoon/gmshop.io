<?
include "head.php";
if ($del)
{
	if ($MySQL->query("DELETE from mailing_list WHERE idx=$del"))
	{
		OnlyMsgView("�����Ͽ����ϴ�.");
		Refresh("mailing_list.php");
		exit;
	}
}
if ($complete_del==1)
{
	if ($MySQL->query("DELETE from mailing_list WHERE sending='Y'"))
	{
		OnlyMsgView("�����Ͽ����ϴ�.");
		Refresh("mailing_list.php");
		exit;
	}
}
if ($complete_del==2)
{
	$dir = "./mail_content";
	$dh  = opendir($dir);
	while (false !== ($filename = readdir($dh)))
	{
		if(is_file($dir."/".$filename)) @unlink($dir."/".$filename);
	}
	if ($MySQL->query("DELETE from mailing_list"))
	{
		OnlyMsgView("��� ���� ��ϰ� ������ �����Ͽ����ϴ�.");
		Refresh("mailing_list.php");
		exit;
	}
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function mail_del()
{
	if (confirm("�Ϸ���ϸ���� �����Ͻðڽ��ϱ�?"))
	{
		document.mailform.complete_del.value=1;
		document.mailform.submit();
	}
}
function mail_all_del()
{
	if (confirm("��ü ���ϸ�� �� ������ �����Ͻðڽ��ϱ�?"))
	{
		document.mailform.complete_del.value=2;
		document.mailform.submit();
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<form name="mailform" method="post" action="mailing_list.php">
<input type="hidden" name="complete_del" value="1">
<input type="hidden" name="mail_list" value="y">
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "member";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
	}
	?>
		<td width="85%" valign="top" height='400'>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
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
								<td bgcolor="#E6E6E6" height='26'></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="2">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width='440'><img src="image/mailing_list_tit.gif"></td>
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
								<td valign=top>
									<table width="530" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td height="22" bgcolor="cccccc" colspan="5" align="center">�߼� ��Ȳ</td>
													</tr>
													<tr>
														<td valign="top" height="2" colspan="5"></td>
													</tr>
													<tr>
														<td>
															<form name="searchForm" method="post" action="mailing_list.php">
															<table width=100% border='0' cellpadding='0' cellspacing='0'>
																<tr bgcolor="#ffffff">
																	<td width="390" height='30'><select name='syear' style="font-size:9pt"><?
																	for($i=date('Y')-5; $i<date('Y')+1; $i++)
																	{
																		$syear_sel[date('Y')] = "selected";
																		?><option value="<?= $i?>" <?= $syear_sel[$i]?>><?= $i?>��</option><?
																	}
																	?></select> <select name='smonth' style="font-size:9pt"><?
																	for($i=1; $i<13; $i++)
																	{
																		$smonth_sel[date('m')] = "selected";
																		$ss = (strlen($i)==1)?"0".$i:$i;
																		?><option value="<?= $ss?>" <?= $smonth_sel[$ss]?>><?= $ss?>��</option><?
																	}
																	?></select> <select name='sday' style="font-size:9pt"><?
																	for($i=1; $i<32; $i++)
																	{
																		$sday_sel[date('d')] = "selected";
																		$ss = (strlen($i)==1)?"0".$i:$i;
																		?><option value="<?= $ss?>" <?= $sday_sel[$ss]?>><?= $ss?>��</option><?
																	}
																	?></select>&nbsp;<input type="text" name="mailto" value="<?= ($mailto)?$mailto:""?>" size="15" onclick="this.value='';">&nbsp;<input type="button" value="�� ��" onclick="javascript:document.searchForm.submit();"></td>
																</tr>
															</table>
															</form>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td valign="top" height="1" colspan="9" bgcolor="BDBDBD"></td>
										</tr>
										<tr>
											<td height="277" valign="top">
												<table width="600" border="0" cellspacing="1" cellpadding="5" align="center" bgcolor="#DDDDDD">
													<tr bgcolor="#EFEFEF" align="center">
														<td width="30">����</td>
														<td width="">�߽Ÿ���</td>
														<td width="">���Ÿ���</td>
														<td width="30">�߼�</td>
														<td width="30">����</td>
														<td width="70">�߼�����</td>
														<td width="30">����</td>
													</tr><?
													$data=Decode64($data);
													$pagecnt=$data[pagecnt];
													$letter_no=$data[letter_no];
													$offset=$data[offset];
													if(!$searchstring)
													{
														//�˻�
														$search=$data[search];
														$searchstring=$data[searchstring];
													}
													$qry = "select * from mailing_list where 1=1";
													if ($mailto) $qry.=" and `to` like '%$mailto%'";
													if ($syear) $qry.=" and send_day like '$syear-$smonth-$sday%'";
													$numresults=$MySQL->query($qry);
													$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
													if ($year) echo "<br>&nbsp;&nbsp;&nbsp;<b>[$numrows] �� �˻�</b>"; 
													$LIMIT		=20;								//�������� �� ��
													$PAGEBLOCK	=10;								//���� ������ ��
													if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
													if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
													if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
													$bbs_qry = $qry;
													$bbs_qry.= " order by idx desc limit $offset,$LIMIT";
													$bbs_result=$MySQL->query($bbs_qry);
													$s_letter=$letter_no;								//�������� ���� �۹�ȣ
													while($bbs_row=mysql_fetch_array($bbs_result))
													{
														$encode_str = "idx=".$bbs_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
														$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
														$data=Encode64($encode_str);					//�� ���ڵ� ����
														$sending_str = ($bbs_row[sending]=='N')?"<font color='#FF0000'>�غ�</font>":"�Ϸ�";
														?>
													<tr bgcolor="#FFFFFF">
														<td align='center'><?=$letter_no?></td>
														<td height="20" bgcolor="ffffff"><?=$bbs_row[from2]?></td>
														<td height="20" bgcolor="ffffff"><?=$bbs_row[to2]?></td>
														<td align='center'><?= $sending_str?></td>
														<td height="20" bgcolor="ffffff"><a href="mail_content/<?= $bbs_row[file_num]?>" target="_blank">����</a></td>
														<td align='center'><?= ($bbs_row[send_day]=='0000-00-00 00:00:00')?'�غ�':substr($bbs_row[send_day],0,10);?></td>
														<td align='center'><a href="#;" onclick="javascript:location.href='mailing_list.php?del=<?=$bbs_row[idx]?>'"><u>����</u></a></td>
													</tr><?
														$letter_no--;
													}
													include "../lib/class.php";
													$Obj=new CList("mailing_list.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"syear=$syear&smonth=$smonth&sday=$sday&tar=$tar&mailto=$mailto");
													?>
												</table><br><?
												$total_num = $MySQL->articles("SELECT idx from mailing_list WHERE sending='Y'");
												$total_failnum = $MySQL->articles("SELECT idx from mailing_list WHERE sending='N'");
												?>
												<table width="400" class="table_coll" border=1>
													<tr align="center" height="50">
														<td width="100" bgcolor="#f5f5f5">�߼ۿϷ�</td>
														<td>���� <?=PriceFormat($total_num)?> ��</td>
													</tr>
													<tr align="center" height="50">
														<td width="100" bgcolor="#f5f5f5">�̹߼�</td>
														<td>���� <?=PriceFormat($total_failnum)?> ��&nbsp;&nbsp;<input type="button" value="�̹߼۰� �߼��ϱ�" onclick="location.href='member_sendmail_ok.php?re_send=1'"></td>
													</tr>
													<tr align="center" height="50">
														<td width="100" bgcolor="#f5f5f5">�Ϸ��� ����</td>
														<td>&nbsp;&nbsp;<input type="button" value="�Ϸ��� ����" onclick="mail_del();"></td>
													</tr>
													<tr align="center" height="50">
														<td width="100" bgcolor="#f5f5f5">���� ����</td>
														<td>&nbsp;&nbsp;<input type="button" value="���� ����" onclick="mail_all_del();"> �Ϸ�, �̿Ϸ�, ���� ���� ����</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="50">&nbsp; </td>
										</tr>
										<tr>
											<td height="25" align="center">&nbsp;<?$Obj->putList(true,"","");//�������� ����Ʈ?></td>
										</tr>
									</table>
								</td>
							</tr>
						</table><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>