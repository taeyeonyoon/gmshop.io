<?
include "head.php";
if ($bcomment)
{
	$re_content = htmlspecialchars($re_content);
	$qry = "INSERT INTO comment(re_name,re_content,re_pwd,boardcode,boardidx,writeday) values ('$re_name','$re_content','$re_pwd','$code','$boardidx',now())";
	$MySQL->query($qry);
}
$bbs_admin_row = $MySQL->fetch_array("select *from bbs_list where code='$code'"); //�Խ��� ����
$dataArr = Decode64($data);
$view_row = $MySQL->fetch_array("select *from bbs_data where idx=$dataArr[idx]"); //�Խ��� ����
$MySQL->query("update bbs_data set readnum=readnum+1 where idx=$dataArr[idx]");
if($view_row[bHtml]) $content	= stripslashes($view_row[content]); //�۳���
else $content    = str_replace("\n","<br>", (stripslashes($view_row[content]))); //�۳���
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function bbsDel()
{
	var choose = confirm("���� ������ �����˴ϴ�.\n\n���� �Ͻðڽ��ϱ�?");
	if(choose)
	{
		location.href="bbs_edit_ok.php?data=<?=$data?>&code=<?=$code?>&del=1";
	}
	else return;
}
function comment_del(a,b,c)
{
	location.href="comment_del.php?idx="+a+"&code="+b+"&data="+c;
}
function comment_check()
{
	var comform = document.comment;
	if (comform.re_name.value == "")
	{
		alert("�̸��� �Է��ϼ���");
		comform.re_name.focus();
	}
	else if (comform.re_content.value == "")
	{
		alert("������ �Է��ϼ���");
		comform.re_content.focus();
	}
	else if (comform.re_pwd.value == "")
	{
		alert("��й�ȣ�� �Է��ϼ���");
		comform.re_pwd.focus();
	}
	else comform.submit();
}
function del_file(data)
{
	location.href="bbs_edit_ok.php?del_file=1&data="+data;
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "board";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	$actArr		= array("10" => "���Ѿ���", "20" => "ȸ��,������", "30" => "������");	//�Խ��� ���� �迭
	$actKey		= array_keys($actArr);												//�Խ��� ���� �迭 Ű�� ex) array("10","20","30")
	$partArr	= array("10" => "�ϹݰԽ���", "20" => "�ڷ��" , "30" => "������" );	//�Խ��� ���� �迭
	$partKey	= array_keys($partArr);												//�Խ��� ���� �迭 Ű�� ex) array("10","20")
	?>
		<td width="85%" valign="top">
			<table width="100%" height="500" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/board_tit.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �Խ��� �߰�,����,���� ���� �ۼ��ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
								<td width='1' bgcolor='dadada'></td>
							</tr>
							<tr>
								<td><img src="image/board_tit_view.gif"></td>
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
						<table width="750" border="0" align="center" bgcolor="#EBEBEB" cellpadding="0" cellspacing="1" >
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" height="420" bgcolor="#FFFFFF">
										<tr valign="middle">
											<td width="100" height="30" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ȣ</div></td>
											<td width="90" height="30"><div align="center"><?=$dataArr[present_num]?> &nbsp;&nbsp; </div></td>
											<td width="90" height="30" bgcolor="#FAFAFA"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �����</div></td>
											<td height="30" colspan="3"><div align="center"><?=$view_row[gongji]?$view_row[gongji_day]:$view_row[writeday]?></div></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="100" height="30" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
											<td width="450" height="30" colspan="5">&nbsp;&nbsp;<B><?=$view_row[title]?></B></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="100" height="30" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
											<td width="450" height="30" colspan="5">&nbsp;&nbsp;<?=$view_row[name]?></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="100" height="30" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �̸���</div></td>
											<td width="450" height="30" colspan="5">&nbsp;&nbsp;<?=$view_row[email]?></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="100" height="30" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</div></td>
											<td width="90" height="30"><div align="center"><?=$view_row[userIp]?> &nbsp;&nbsp; </div></td>
											<td width="90" height="30" bgcolor="#FAFAFA"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ȸ��</div></td>
											<td height="20" colspan="3"><div align="center"><?=$view_row[readnum]?></div></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr><?
										if($bbs_admin_row[part]==30)
										{
											?>
										<tr valign="middle">
											<td width="100" height="30" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �̹���1</div></td>
											<td width="90" height="30"><?
											if($view_row[img1])
											{
												?><div align="center"><img src="../upload/bbs/<?=$view_row[img1]?>" width="50" height="50"></div><?
											}
											?></td>
											<td width="90" height="30" bgcolor="#FAFAFA"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �̹���2</div></td>
											<td height="30" colspan="3"><?
											if($view_row[img2])
											{
												?><div align="center"><img src="../upload/bbs/<?=$view_row[img2]?>" width="50" height="50"></div><?
											}
											?></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr><?
										}
										if(!empty($view_row[up_file]))
										{
											?>
										<tr valign="middle">
											<td width="100" height="30" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ÷������</div></td>
											<td width="450" height="30" colspan="5">&nbsp;&nbsp; <img src="image/s_file.gif" border="0"> <a href="../upload/bbs/<?=$view_row[up_file]?>"><?=$view_row[up_file]?></a>&nbsp;&nbsp;<a href="javascript:del_file('<?=$data?>');"><img src="image/delete_btn.gif" border=0></a></td>
										</tr>
										<tr>
											<td colspan="6" height="1" background="image/line_bg1.gif"></td>
										</tr><?
										}
										?>
										<tr bgcolor="#FAFAFA">
											<td colspan="6" height="30"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
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
										</tr><?
										$comment_result = mysql_query("SELECT *from comment where boardcode='$bbs_admin_row[code]' and boardidx='$dataArr[idx]'");
										if (mysql_num_rows($comment_result))
										{
											while ($comment_row = mysql_fetch_array($comment_result))
											{
												$comment_writeday = $comment_row[writeday];
												$comment_writeday = substr($comment_writeday,5);
												$comment_re_content = nl2br($comment_row[re_content]);
												?>
										<tr>
											<td colspan="5" height=20>
												<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td width=100><font color="#009BD4"><?=$comment_row[re_name]?></font></td>
														<td><br><font color='3c3c3c'><?=$comment_re_content?></font><br><br></td>
														<td width=90><?=$comment_writeday?></td>
														<td width=30><a href="javascript:comment_del('<?=$comment_row[idx]?>','<?=$bbs_admin_row[code]?>','<?=$data?>');">����</a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="5" height="1" background="image/icon/dot_width.gif"></td>
										</tr><?
											}
										}
										?>
										<tr>
											<td colspan="5">
												<form name="comment" action="bbs_view.php?data=<?=$data?>" method="post">
												<input type="hidden" name="code" value="<?=$bbs_admin_row[code]?>">
												<input type="hidden" name="boardidx" value="<?=$dataArr[idx]?>">
												<input type="hidden" name="boardIndex" value="<?=$boardIndex?>">
												<input type="hidden" name="bcomment" value="1">
												<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td width="100">�̸� <input type="text" style="background-color:#FDFDFD;border:1px solid #cccccc;text-align:left;color:#525252" name="re_name" size="6"></td>
														<td valign=middle><textarea style="background-color:#FDFDFD;border:1px solid #cccccc;text-align:left;color:#525252" name="re_content" cols="40" rows="2"></textarea></td>
														<td width="120">��й�ȣ <input type="password" style="background-color:#FDFDFD;border:1px solid #cccccc;text-align:left;color:#525252" name="re_pwd" size="6"><br><a href="javascript:comment_check();"><img src="image/write.gif" border="0"></a></td>
													</tr>
												</table></form></td>
										</tr>
										<tr>
											<td colspan="5" height="1" background="image/icon/dot_width.gif"></td>
										</tr>
										<tr>
											<td colspan="6" height="20">
												<table width="30%" border="0" bgcolor="#FFFFFF" align="center" height="50">
													<tr bgcolor="#FFFFFF"><?
													if($bbs_admin_row[part]==30)
													{
														?>
														<td width="43">&nbsp;</td><?
													}
													else
													{
														?>
														<td width="43"><a href="bbs_write.php?code=<?=$code?>&data=<?=$data?>"><img src="image/bbs_reply.gif" width="41" height="23" border="0"></a></td><?
													}
													?>
														<td width="43"><a href="bbs_edit.php?code=<?=$code?>&data=<?=$data?>"><img src="image/bbs_modify.gif" width="41" height="23" border="0"></a></td>
														<td width="43"><a href="javascript:bbsDel();"><img src="image/good_position_delete.gif" width="41" height="23" border="0"></a></td>
														<td width="43"><a href="bbs_list.php?code=<?=$code?>&data=<?=$data?>"><img src="image/bbs_list_btn.gif" width="41" height="23" border="0"></a></td>
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