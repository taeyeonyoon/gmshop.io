<?
// �ҽ��������
// 20060720-1 �ҽ����� �輺ȣ : ������� ���� ����ȭ(ī��, �ڵ���, ������ü, �������, ������)
include "head.php";
$member_row = $MySQL->fetch_array("select *from member where userid='$_SESSION[GOOD_SHOP_USERID]'");
?>
<? include "top.php";?>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td valign="top" width="720" bgcolor="#ffffff">
			<table width="720" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2">
						<table width="720" height="30" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc5]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc5]?>" rowspan="2"></td>
								<td width="220" height="27" bgcolor="<?=$subdesign[bc5]?>"><img src="./upload/design/<?=$subdesign[img5]?>" ></td>
								<td width="490" height="27" bgcolor="<?=$subdesign[bc5]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc5]?>"> <img src='image/good/icon0.gif'>&nbsp;������ġ : HOME &gt; Mypage(����������)&gt;�ֹ�������ȸ�ϱ�</font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top"><br><? include "mypage_menu.php";?><br><br>
						<table border='0' width='670' cellpadding='0' cellspacing='0' align='center'>
							<tr>
								<td><img src='image/member/my_tit2.gif'></td>
							</tr>
						</table>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center"><?
							$data=Decode64($data);
							$pagecnt=$data[pagecnt];
							$letter_no=$data[letter_no];
							$offset=$data[offset];
							$numresults_qry = "select * from trade where userid='$_SESSION[GOOD_SHOP_USERID]' and bPay=1";
							$MySQL->query($numresults_qry);
							$numrows=$MySQL->is_affected();				//�� ���ڵ��..
							$LIMIT		=15;								//�������� �� ��
							$PAGEBLOCK	=10;								//���� ������ ��
							if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
							if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
							if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
							$bbs_qry = $numresults_qry." order by idx desc limit $offset,$LIMIT";
							$bbs_result=$MySQL->query($bbs_qry);
							$s_letter=$letter_no;								//�������� ���� �۹�ȣ
							$colspan = 13;
							?>
							<tr>
								<td colspan="2" valign="top"><br>
									<!-- �ֹ���� ���� -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td colspan="<?=$colspan?>">��ü [ <font color="#FF9900"><?=$numrows?></font> ]��<br></td>
										</tr>
										<tr>
											<td height="2" colspan="<?=$colspan?>" bgcolor="80C9D8"></td>
										</tr>
										<tr>
											<td height="1" colspan="<?=$colspan?>" bgcolor="FFFFFF"></td>
										</tr>
										<tr align="center" bgcolor="#EDF7F9">
											<td height="30" width="30"><font color='006676'><b>��ȣ</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="70"><font color='006676'><b>�ֹ���</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="130" ><font color='006676'><b>�ֹ��ڵ�</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td><font color='006676'><b>�����ݾ�</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="100"><font color='006676'><b>��۹��</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="80"><font color='006676'><b>�������</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="80"><font color='006676'><b>�ֹ�����</b></font></td>
										</tr>
										<tr>
											<td height="1" colspan="<?=$colspan?>" align="center" bgcolor="ffffff"></td>
										</tr>
										<tr>
											<td height="1" colspan="<?=$colspan?>" align="center" bgcolor="80c9d8"></td>
										</tr><?
										while($bbs_row=mysql_fetch_array($bbs_result))
										{
											$encode_str = "idx=".$bbs_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
											$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
											$data=Encode64($encode_str);					//�� ���ڵ� ����
											if($bbs_row[payMethod] =="card") $payMethod="ī�����";
											elseif($bbs_row[payMethod] =="hand") $payMethod="�޴���";
											elseif($bbs_row[payMethod] =="iche") $payMethod="������ü";
											elseif($bbs_row[payMethod] =="cyber") $payMethod="�������";
											elseif($bbs_row[payMethod] =="bank") $payMethod="������";
											?>
										<tr height="30" align="center" bgcolor="ffffff" style='cursor:pointer;' onMouseOver="this.style.backgroundColor='#F2F2F2'" onMouseOut="this.style.backgroundColor=''" onclick="location.href='mypage_order_detail.php?data=<?=$data?>'">
											<td><?=$letter_no?></td>
											<td width='1'></td>
											<td><?=str_replace("-","/",substr($bbs_row[writeday],0,10))?></td>
											<td width='1'></td>
											<td><B><?=$bbs_row[tradecode]?></B></td>
											<td width='1'></td>
											<td><b><FONT  COLOR="#ff4800"><?=PriceFormat($bbs_row[payM])?> ��</FONT></b></td>
											<td width='1'></td>
											<td><?
												if ($bbs_row[transMethod]=="T") echo "�ù�";
												else if ($bbs_row[transMethod]=="K") echo "�浿ȭ��";
												else if ($bbs_row[transMethod]=="Q") echo "�����";
												else echo "&nbsp;";
												?></td>
											<td width='1'></td>
											<td><?=$payMethod?></td>
											<td width='1'></td>
											<td><?
											$tg_row=$MySQL->fetch_array("select status from trade_goods where tradecode='$bbs_row[tradecode]' limit 1");
											if ($tg_row[status]==0) $st_str = "�ֹ�����";
											else if ($tg_row[status]==1) $st_str = "<font color=brown>".$TRADE_ARR[$tg_row[status]]."</font>";
											else if ($tg_row[status]==2) $st_str = "<font color=blue>".$TRADE_ARR[$tg_row[status]]."</font>";
											else if ($tg_row[status]==3) $st_str = "<font color=green>".$TRADE_ARR[$tg_row[status]]."</font>";
											else if ($tg_row[status]==4) $st_str = "<font color=red>".$TRADE_ARR[$tg_row[status]]."</font>";
											else if ($tg_row[status]==5) $st_str = "<font color=red>".$TRADE_ARR[$tg_row[status]]."</font>";
											else $st_str ="&nbsp;";
											?><?=$st_str?></td>
										</tr>
										<tr>
											<td align="center" colspan="<?=$colspan?>" height="1" background="image/index/dot_width.gif"></td>
										</tr><?
											$letter_no--;
										}
										$Obj=new CList("mypage_order.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,"","","");
										?>
									</table>
									<br>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="25" colspan="5" align="center"><?$Obj->putList(true,"<img src='image/board/btn_prev.gif'>","<img src='image/board/btn_next.gif'>");//�������� ����Ʈ?></td>
										</tr>
										<tr>
											<td height="1" colspan="9" bgcolor="ffffff"></td>
										</tr>
									</table>
									<br><br>
									<table width="670" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td bgcolor='dadfe5' height='1'></td>
										</tr>
										<tr>
											<td height="30" bgcolor='eff3f4' style='padding:0 0 0 10'><img src='image/index/icon_cate00.gif'> <font color='3d5b75'><b>�ֹ�������ȸ</b></font></td>
										</tr>
										<tr>
											<td bgcolor='dadfe5' height='1'></td>
										</tr>
										<tr>
											<td valign="top">
												<table width="670" border="0" cellspacing="0" cellpadding="10">
													<tr>
														<td>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">&nbsp;�� �ڼ��� ������ �˰� �����ø� �ֹ��ڵ带 �����ø� �˴ϴ�.<br>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">&nbsp;��ȣ<br>&nbsp;&nbsp;&nbsp;&nbsp;�ֱ� �ֹ��� ����� �������� �����˴ϴ�.<br>&nbsp;&nbsp;&nbsp;&nbsp;- �ֹ���ȣ<br>&nbsp;&nbsp;&nbsp;&nbsp;- �ֹ��� �ڵ������� ��ȣ�� �˾Ƶνø� ���߿� Ȯ���Ͻñ� ���մϴ�.<br>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">&nbsp;�����<br>&nbsp;&nbsp;&nbsp;&nbsp;- ������� ��ǰ�� ������ Ȯ���ϰ� ���� ����� ���۵� ���� �Դϴ�.<br>&nbsp;&nbsp;&nbsp;&nbsp;- ��, �Ϻλ�ǰ�� ��� ������ü�� ������ ���� ����� �ټ� �ʾ��� �� ������ �˷��帳�ϴ�.<br>&nbsp;&nbsp;<img src="image/icon/icon_8.gif">&nbsp;��ۿϷ�<br>&nbsp;&nbsp;&nbsp;&nbsp;- ��ۿϷ����� ��ǰ�� �̹� ����� �Ϸ�� ���� �Դϴ�. ���� �� �����̴ٸ� �����ͷ� ���� �ּ���</td>
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