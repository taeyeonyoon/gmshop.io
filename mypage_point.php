<?
include "head.php";
$member_row = $MySQL->fetch_array("select *from member where userid='$_SESSION[GOOD_SHOP_USERID]'");
?>
<? include "top.php";?>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td height="51" valign="top" width="720" bgcolor="#FFFFFF">
			<table width="720" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2" height="51">
						<table width="720" height="35" border="0" cellspacing="0" cellpadding="0" ailgn='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc5]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc5]?>" rowspan="2"></td>
								<td width="220" height="27" bgcolor="<?=$subdesign[bc5]?>"><img src="./upload/design/<?=$subdesign[img5]?>" ></td>
								<td width="490" height="27" bgcolor="<?=$subdesign[bc5]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc5]?>"> <img src='image/good/icon0.gif'>&nbsp;������ġ : HOME &gt; Mypage(����������)&gt;��������ȸ�ϱ� </font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top"><br><? include "mypage_menu.php";?><?
					$plus_point = $MySQL->fetch_array("select sum(point) from point_table where userid='$member_row[userid]' and point >0");
					$minus_point = $MySQL->fetch_array("select sum(point) from point_table where userid='$member_row[userid]' and point <0");?><br><br>
						<table border='0' width='670' cellpadding='0' cellspacing='0' align='center'>
							<tr>
								<td><img src='image/member/my_tit3.gif'></td>
							</tr>
						</table><br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor='80c9d8' height='2' colspan='2'></td>
							</tr>
							<tr>
								<td height="25" width="170" bgcolor="edf7f9"> &nbsp;<font color='006676'> �� ������</font></td>
								<td height="25" width='500' style='padding:0 0 0 30'><FONT  COLOR="#6600FF"><?=PriceFormat($plus_point[0])?></FONT> ��</td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="170" bgcolor="edf7f9"> &nbsp;<font color='006676'> ����� ������</font></td>
								<td height="25" style='padding:0 0 0 30'><FONT  COLOR="#CC0000"><?=PriceFormat(abs($minus_point[0]))?></FONT> ��</td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="170" bgcolor="edf7f9"> &nbsp;<font color='006676'> ��밡���� ������</font></td>
								<td height="25" style='padding:0 0 0 30'><B><?=PriceFormat($member_row[point])?> ��</B></td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="20" colspan="2" bgcolor="ffffff"></td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="670" border="0" cellspacing="0" cellpadding="0" align="center"><?
										$data=Decode64($data);
										$pagecnt=$data[pagecnt];
										$letter_no=$data[letter_no];
										$offset=$data[offset];
										$numresults=$MySQL->query("select idx from point_table where userid='$_SESSION[GOOD_SHOP_USERID]'");
										$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
										$LIMIT		=10;								//�������� �� ��
										$PAGEBLOCK	=10;								//���� ������ ��
										if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
										if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
										if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
										$bbs_qry = "select * from point_table where userid='$_SESSION[GOOD_SHOP_USERID]' order by idx desc limit $offset,$LIMIT";
										?>
										<tr>
											<td height="30" colspan="2" bgcolor="#f4f4f4">&nbsp;&nbsp;<img src='image/member/icon_my.gif' align='absmiddle'><b> ������ ����</b></td>
										</tr>
										<tr>
											<td colspan="2" valign="top">
												<!-- ������ ��� ���� -->
												<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td colspan="9" height='25'>��ü [ <font color="#FF9900"><?=$numrows?></font> ]��<br></td>
													</tr>
													<tr>
														<td height="2" colspan="9" bgcolor="80c9d8"></td>
													</tr>
													<tr>
														<td height="1" colspan="9" bgcolor="ffffff"></td>
													</tr>
													<tr bgcolor="#edf7f9">
														<td height="30" width="30" align="center"><font color='006676'><b>��ȣ</b></font></td>
														<td width='1'><img src='image/board/line.gif'></td>
														<td height="30" width="30" align="center"><font color='006676'><b>����</b></font></td>
														<td width='1'><img src='image/board/line.gif'></td>
														<td height="30" align="center" width="100"><font color='006676'><b>������</b></font></td>
														<td width='1'><img src='image/board/line.gif'></td>
														<td height="30" align="center"><font color='006676'><b>����</b></font></td>
														<td width='1'><img src='image/board/line.gif'></td>
														<td height="30" width="100" align="center"><font color='006676'><b>�߻�����</b></font></td>
													</tr>
													<tr>
														<td height="1" colspan="9" align="center" bgcolor="ffffff"></td>
													</tr>
													<tr>
														<td height="1" colspan="9" align="center" bgcolor="80c9d8"></td>
													</tr><?
													$bbs_result=$MySQL->query($bbs_qry);
													$s_letter=$letter_no;								//�������� ���� �۹�ȣ
													while($bbs_row=mysql_fetch_array($bbs_result))
													{
														if ($bbs_row[part]=="ȸ��") $bbs_row[part]="�ֹ����";
														if($bbs_row[point] >=0) $part ="<FONT COLOR='#6600FF'>$bbs_row[part]</FONT>";
														else $part ="<FONT COLOR='#CC0000'>$bbs_row[part]</FONT>";
														?>
													<tr>
														<td align="center" height="25" width="30"><?=$letter_no?></td>
														<td align="center" height="25" width="2">&nbsp;</td>
														<td align="center" height="25" width="30"><font color="#0000FF"><?=$part?></font></td>
														<td align="center" height="25" width="2">&nbsp;</td>
														<td align="right" height="25" width="100"><?=PriceFormat($bbs_row[point])?> ��</td>
														<td align="center" height="25" width="2">&nbsp;</td>
														<td align="center" height="25" width="282"><?=$bbs_row[reason]?></td>
														<td align="center" height="25" width="2">&nbsp;</td>
														<td align="center" height="25" width="100"><?=str_replace("-","/",substr($bbs_row[writeday],0,16))?></td>
													</tr>
													<tr>
														<td align="center" colspan="9" height="1" bgcolor='e1e1e1'></td>
													</tr><?
														$letter_no--;
													}
													$Obj=new CList("mypage_point.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,"","","");
													?>
												</table>
												<!-- ������ ��� �� --><br>
												<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height="25" colspan="5" align="center"><?$Obj->putList(true,"<img src='image/board/btn_prev.gif'>","<img src='image/board/btn_next.gif'>");//�������� ����Ʈ?></td>
													</tr>
													<tr>
														<td height="1" colspan="9" bgcolor="ffffff"></td>
													</tr>
												</table>
												<br><br>
												<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
													<tr>
														<td bgcolor='dadfe5' height='1'></td>
													</tr>
													<tr>
														<td height="30" bgcolor='eff3f4' style='padding:0 0 0 10'><img src='image/index/icon_cate00.gif'> <font color='3d5b75'><b>����������</b></font></td>
													</tr>
													<tr>
														<td bgcolor='dadfe5' height='1'></td>
													</tr>
													<tr>
														<td valign="top">
															<table width="100%" border="0" cellspacing="0" cellpadding="10">
																<tr>
																	<td>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">�������� ���� ���Ž� <?
																	if($admin_row[poMethod]=="t")
																	{
																		?><b><?=PriceFormat($admin_row[poTotal])?></b>�� <?
																	}
																	else
																	{
																		echo"<B>$admin_row[poUnit]%</B>";
																	}
																	?> �� �����˴ϴ�. <br><br>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">�����ݾ��� <b><?=PriceFormat($admin_row[popayM])?></b>���̻� �϶� �������� ��� �� �� �ֽ��ϴ�.<br><br><?
																	if ($admin_row[poMaxunlimit])
																	{
																		?>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">�������� <b><?=PriceFormat($admin_row[poMin])?></b>���̻� �϶� ��� �� �� �ֽ��ϴ�.<br><br><?
																	}
																	else
																	{
																		?>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">�������� <b><?=PriceFormat($admin_row[poMin])?></b>���̻� <B><?=PriceFormat($admin_row[poMax])?></B>�����Ͽ��� ��� �� �� �ֽ��ϴ�.<br><br><?
																	}
																	?>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">���� ȸ�����Խ� <B><?=PriceFormat($admin_row[poReg])?></B>���� �������� �־����ϴ�.</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td bgcolor='dadfe5' height='1'></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<br><br><br><br>
								</td>
							</tr>
						</table>
						<br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php"; ?>
</div>
</body>
</html>