<?
include "head.php";
$member_row = $MySQL->fetch_array("select *from member where userid='$_SESSION[GOOD_SHOP_USERID]'");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function ask_view(idx)
{
	window.open("goods_ask_view.php?idx="+idx,"","scrollbars=yes,width=620,height=400,top=50,left=300");
}
//-->
</SCRIPT>
<? include "top.php"; ?>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php"; ?>
		<td valign="top" width="720" bgcolor="#ffffff">
			<table width="720" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2">
						<table width="720" height="30" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2" bgcolor="<?=$subdesign[bc5]?>" rowspan="2"></td>
								<td width="2" bgcolor="<?=$subdesign[bc5]?>" rowspan="2"></td>
								<td width="220" height="27" bgcolor="<?=$subdesign[bc5]?>"><img src="./upload/design/<?=$subdesign[img5]?>" ></td>
								<td width="490" height="27" bgcolor="<?=$subdesign[bc5]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc5]?>"> <img src='image/good/icon0.gif'>&nbsp;������ġ : HOME &gt; Mypage(����������)&gt;������������ </font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top"><br><? include "mypage_menu.php";?><br>
						<table border='0' width='670' cellpadding='0' cellspacing='0' align='center'>
							<tr>
								<td><img src='image/member/my_tit7.gif'></td>
							</tr>
						</table>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center"><?
							$data=Decode64($data);
							$pagecnt=$data[pagecnt];
							$letter_no=$data[letter_no];
							$offset=$data[offset];
							$numresults_qry = "SELECT * from good_board WHERE userid='$_SESSION[GOOD_SHOP_USERID]'";
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
							?>
							<tr>
								<td colspan="2" valign="top"><br>
									<!-- �ֹ� ��� ���� -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td colspan="6">��ü [ <font color="#FF9900"><?=$numrows?></font> ]��<br></td>
										</tr>
										<tr>
											<td height="2" colspan="11" bgcolor="80c9d8"></td>
										</tr>
										<tr>
											<td height="1" colspan="11" bgcolor="ffffff"></td>
										</tr>
										<tr bgcolor="edf7f9" align="center">
											<td width="40" height=30><font color='006676'><b>��ȣ</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td><font color='006676'><b>��������</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="100"><font color='006676'><b>�۾���</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="100"><font color='006676'><b>��¥</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="50"><font color='006676'><b>��ȸ</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="50"><font color='006676'><b>���</b></font></td>
										</tr>
										<tr>
											<td height="1" colspan="11" align="center" bgcolor="ffffff"></td>
										</tr>
										<tr>
											<td height="1" colspan="11" align="center" bgcolor="80c9d8"></td>
										</tr><?
										$gb_cnt = mysql_num_rows($bbs_result);
										if ($gb_cnt)
										{
											while ($good_board_row = mysql_fetch_array($bbs_result))
											{
												$reply_num = $MySQL->articles("SELECT idx from good_board_comment WHERE boardidx=$good_board_row[idx]");
												$encode_str = "idx=".$bbs_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
												$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
												$data=Encode64($encode_str);					//�� ���ڵ� ���� 
												?>
										<tr style='cursor:pointer;' onMouseOver="this.style.backgroundColor='#F2F2F2'" onMouseOut="this.style.backgroundColor=''" onclick="javascript:ask_view(<?=$good_board_row[idx]?>);">
											<td align="center" height='25'><?=$letter_no?></td>
											<td width='1'></td>
											<td><?=$good_board_row[title]?></td>
											<td width='1'></td>
											<td align="center"><?=$good_board_row[name]?></td>
											<td width='1'></td>
											<td align="center"><?=substr($good_board_row[writeday],0,10)?></td>
											<td width='1'></td>
											<td align="center"><?=$good_board_row[readnum]?></td>
											<td width='1'></td>
											<td align="center"><?=$reply_num?></td>
										</tr>
										<tr>
											<td align="center" colspan="11" height="1" bgcolor='e1e1e1'></td>
										</tr><?
												$letter_no--; 
											}
										}
										else
										{
											// ��ǰ���� ������
											?>
										<tr>
											<td colspan="11" height='35' align="center">�ش� ��ǰ�� ���õ� ��ǰ Q&A�� �����ϴ�.</td>
										</tr>
										<tr>
											<td align="center" colspan="11" height="1" bgcolor='e1e1e1'></td>
										</tr><?
										}
										$Obj=new CList("mypage_ask.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,"","","");
										?>
									</table><!-- �ֹ� ��� �� -->
									<br>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="25" align="center"><?$Obj->putList(true,"<img src='image/board/btn_prev.gif'>","<img src='image/board/btn_next.gif'>");//�������� ����Ʈ?></td>
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
<? include "copy.php"; ?>
</body>
</html>