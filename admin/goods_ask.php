<?
include "head.php";
if ($del)
{
	if ($MySQL->query("DELETE from good_board where idx=$idx limit 1"))
	{
		OnlyMsgView("��ǰ���ǰ� �����Ǿ����ϴ�.");
		Refresh("goods_ask.php");
		exit;
	}
	else OnlyMsgView("��ǰ���� ������ �����Ͽ����ϴ�.");
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function ask_view(idx)
{
	window.open("goods_ask_view.php?idx="+idx,"","scrollbars=yes,width=620,height=400,top=50,left=300");
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "goods";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	$data=Decode64($data);
	$pagecnt=$data[pagecnt];
	$letter_no=$data[letter_no];
	$offset=$data[offset];
	$total_qry = "SELECT idx from good_board where 1=1 $MALL_STR";
	if ($searchstring) $total_qry.= " and $search like '%$searchstring%'";
	$numresults=$MySQL->query($total_qry);
	$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
	$LIMIT		=20;								//�������� �� ��
	$PAGEBLOCK	=10;								//���� ������ ��
	if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
	if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
	if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
	$comment_qry = "SELECT *from good_board where 1=1 $MALL_STR";
	if ($searchstring) $comment_qry.= " and $search like '%$searchstring%'";
	$comment_qry.=" order by idx desc limit $offset,$LIMIT";
	$comment_result=$MySQL->query($comment_qry);
	$s_letter=$letter_no;								//�������� ���� �۹�ȣ
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
								<td rowspan="3" width="200"><img src="image/good_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ��ǰ������ �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
											<td width='440'><img src="image/good_ask.gif"></td>
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
								<td valign="top">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" height="420">
										<tr>
											<td colspan="2" height="2">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height="40" bgcolor="#F5F5F5">
															<form name="searchForm" method="post" action="goods_ask.php">
															<table width="100%" border="0" bgcolor="#FAFAFA" align="center">
																<tr bgcolor="#F5F5F5">
																	<td align="right"><select name="search"><option value="name">�ۼ���</option><option value="title">��������</option><option value="userid">���̵�</option></select></td>
																	<td width="130" align="left"> <input class="box" type="text" name="searchstring" size="20"></td>
																	<td width="71"><input type="image"src="image/bbs_search_btn.gif" width="41" height="23" border="0"></td>
																</tr>
															</table></form><!-- searchForm -->
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif" bgcolor="#F5F5F5"></td>
										</tr>
										<tr>
											<td colspan="2" height="20"><font class="help">�� ���̵� Ŭ�� - ȸ������ ����<br>�� ��ǰ�� Ŭ�� - ��ǰ���� ���� <br>�� �������� Ŭ�� - �������� ����</font></td>
										</tr>
										<tr valign="middle">
											<td height="200" valign="top" colspan="2">
												<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center" height="162">
													<tr>
														<td colspan="6" height="15"></td>
													</tr>
													<tr valign="middle">
														<td width="12%" height="30" bgcolor="#EBEBEB" background="image/goods_tit_bg.jpg"> <div align="center">��ǰī�װ�</div></td>
														<td width="12%" height="30" bgcolor="#EBEBEB" background="image/goods_tit_bg.jpg"> <div align="center">��ǰ��</div></td>
														<td width="8%" height="30" bgcolor="#EBEBEB" background="image/goods_tit_bg.jpg"> <div align="center">���̵�</div></td>
														<td height="30" bgcolor="#EBEBEB"> <div align="center">��������</div></td>
														<td width="5%" height="30" bgcolor="#EBEBEB"> <div align="center">��ȸ��</div></td>
														<td width="5%" height="30" bgcolor="#EBEBEB"> <div align="center">��ۼ�</div></td>
														<td width="12%" height="30" bgcolor="#EBEBEB"> <div align="center">��¥</div></td>
														<td width="8%" height="30" bgcolor="#EBEBEB"> <div align="center">����</div></td>
													</tr>
													<tr>
														<td colspan="8" height="1" background="image/line_bg1.gif"></td>
													</tr><?
													while($comment_row=mysql_fetch_array($comment_result))
													{
														$encode_str = "idx=".$comment_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
														$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
														$data=Encode64($encode_str);					//�� ���ڵ� ����
														$goods_row = $MySQL->fetch_array("select idx,category,name from goods where idx=$comment_row[gidx] limit 1");
														$encode_str2 = "idx=".$goods_row[idx];
														$data2=Encode64($encode_str2);
														//ī�װ� ����
														$cate_row = $MySQL->fetch_array("select *from category where code='$goods_row[category]'");
														$category = $cate_row[name];
														$reply_num = $MySQL->articles("SELECT idx from good_board_comment WHERE boardidx=$comment_row[idx]");
														?>
													<tr valign="middle" bgcolor="fafafa">
														<td height="25"><div align="center"><B><?=$category?></b></div></td>
														<td height="25" > <div align="center"><a href="goods_edit.php?data=<?=$data2?>&returnPage=good_board.php" target="_blank"><?=$goods_row[name]?></a></div></td>
														<td height="25" > <div align="center"><a href="member_list.php?search=userid&searchstring=<?=$comment_row[userid]?>" target="_blank"><?=$comment_row[userid]?></a></div></td>
														<td height="25" > <div align="left"><a href="#;" onclick="javascript:ask_view(<?=$comment_row[idx]?>);"><?=$comment_row[title]?></a></div></td>
														<td height="25" > <div align="center"><?=$comment_row[readnum]?></div></td>
														<td height="25" > <div align="center"><?=$reply_num?></div></td>
														<td height="25" > <div align="center"><?=Substr($comment_row[writeday],0,10)?></div></td>
														<td height="25" > <div align="center"><a href="goods_ask.php?del=1&idx=<?=$comment_row[idx]?>"><img src="image/delete_btn.gif" border=0></a></div></td>
													</tr>
													<tr>
														<td colspan="8" height="1" background="image/line_bg1.gif"></td>
													</tr><?
														$letter_no--;
													}
													include "../lib/class.php";
													$Obj=new CList("goods_ask.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,$optionStr);
													$pre_icon_img="<img src='image/pre_btn.gif' width='40' height='17' border='0'>";		//����������
													$next_icon_img="<img src='image/next_btn.gif' width='40' height='17' border='0'>";	//����������
													?>
													<tr valign="middle">
														<td height="11" colspan="8">
															<table width="80%" border="0" bgcolor="#FFFFFF" align="center">
																<tr bgcolor="#FFFFFF">
																	<td ><div align="center"><font color="#0099CC"><?$Obj->putList(true,$pre_icon_img,$next_icon_img);//�������� ����Ʈ?></font></div></td>
																</tr>
															</table>
														</td>
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
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>