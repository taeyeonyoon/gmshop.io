<?
include "head.php";
$dataArr = Decode64($data);
$view_row = $MySQL->fetch_array("select *from bbs_data where idx=$dataArr[idx]"); //�Խ��� ����
$MySQL->query("update bbs_data set bRead=1,readnum=readnum+1 where idx=$dataArr[idx]");
$content	= ($view_row[bHtml]==1)?nl2br($view_row[content]):$view_row[content]; //�۳���
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function bbsDel()
{
	var choose = confirm("���� ������ �����˴ϴ�.\n\n���� �Ͻðڽ��ϱ�?");
	if(choose)
	{
		location.href="ask_edit_ok.php?data=<?=$data?>&del=1";
	}
	else return;
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "ask";     //���� �Ҹ޴� ���� ����
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
								<td rowspan="3" width="200"><img src="image/ask_tit_l.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP 1:1���ǰԽ��� ��� ���� �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
								<td width='440'><img src="image/ask_tit3.gif"></td>
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
						<table width="750" border="0" align="center" bgcolor="#EBEBEB" cellpadding="0" cellspacing="1" >
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
										<tr valign="middle">
											<td width="100" height="20" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ȣ</div></td>
											<td width="90" height="20"><div align="center"><?=$dataArr[present_num]?> &nbsp;&nbsp; </div></td>
											<td width="90" height="20" bgcolor="#FAFAFA"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �����</div></td>
											<td height="20" colspan="3"><div align="center"><?=$view_row[writeday]?></div></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="100" height="20" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
											<td width="450" height="20" colspan="5">&nbsp;&nbsp;<B><?=$view_row[title]?></B></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="100" height="20" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
											<td width="450" height="20" colspan="5">&nbsp;&nbsp;<?=$view_row[name]?></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="100" height="20" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �̸���</div></td>
											<td width="450" height="20" colspan="5">&nbsp;&nbsp;<?=$view_row[email]?></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="100" height="20" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</div></td>
											<td width="90" height="20"><div align="center"><?=$view_row[userIp]?> &nbsp;&nbsp; </div></td>
											<td width="90" height="20" bgcolor="#FAFAFA"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ȸ��</div></td>
											<td height="20" colspan="3"><div align="center"><?=$view_row[readnum]?></div></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr><?
										if(!empty($view_row[up_file]))
										{
											?>
										<tr valign="middle">
											<td width="100" height="20" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ÷������</div></td>
											<td width="450" height="20" colspan="5">&nbsp;&nbsp; <img src="image/s_file.gif" border="0"> <a href="../upload/bbs/<?=$view_row[up_file]?>"><?=$view_row[up_file]?></a></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr><?
										}
										?>
										<tr bgcolor="#FAFAFA">
											<td colspan="6" height="20"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td colspan="6" height="150">
												<table width="90%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#EBEBEB">
													<tr>
														<td height="140" bgcolor="#FDFDFD" valign="top">
															<table width="100%" border="0" align="center">
																<tr>
																	<td><?=$content?></td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td colspan="6" height="20">
												<table width="30%" border="0" bgcolor="#FFFFFF" align="center" height="50">
													<tr bgcolor="#FFFFFF"><?
													if(!$view_row[badmin])
													{
														?>
														<td width="43"><a href="ask_write.php?data=<?=$data?>"><img src="image/bbs_reply.gif" width="41" height="23" border="0"></a></td><?
													}
													if($view_row[badmin])
													{
														?>
														<td width="43"><a href="ask_edit.php?data=<?=$data?>"><img src="image/bbs_modify.gif" width="41" height="23" border="0"></a></td><?
													}
													?>
														<td width="43"><a href="javascript:bbsDel();"><img src="image/good_position_delete.gif" width="41" height="23" border="0"></a></td>
														<td width="43"><a href="ask.php?data=<?=$data?>"><img src="image/bbs_list_btn.gif" width="41" height="23" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table><br><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>