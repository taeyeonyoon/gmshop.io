<?
include "head.php";
?>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "news";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	?>
		<td width="85%" valign="top" height="400">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/notice_tit.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ��������, �̺�Ʈ, �������縦 �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
											<td width='440'><img src="image/notice_poll_list_tit.gif"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td height='15'></td>
							</tr>
							<tr>
								<td valign="top">
									<table width="750" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor='cdcdcd'>
										<tr valign="middle" bgcolor="#EBEBEB">
											<td height="30"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
											<td width="80" height="30"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
											<td width="80" height="30"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �����ڼ�</div></td>
											<td width="120" height="30" align="center"><img src="image/icon.gif" width="11" height="11"> ������</td>
											<td width="120" height="30" align="center"><img src="image/icon.gif" width="11" height="11"> ������</td>
										</tr><!-- �������� ��� ���� --><?
										$data=Decode64($data);
										$pagecnt=$data[pagecnt];
										$letter_no=$data[letter_no];
										$offset=$data[offset];
										$numresults=$MySQL->query("select idx from poll");
										$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
										$LIMIT		=15;								//�������� �� ��
										$PAGEBLOCK	=10;								//���� ������ ��
										if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ
										if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��
										if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
										$poll_result=$MySQL->query("select * from poll order by idx desc limit $offset,$LIMIT");
										$s_letter=$letter_no;								//�������� ���� �۹�ȣ
										while($poll_row=mysql_fetch_array($poll_result))
										{
											$encode_str = "idx=".$poll_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
											$encode_str.= "&search=".$search."&searchstring=".$searchstring;
											$data=Encode64($encode_str);					//�� ���ڵ� ����
											?>
										<tr  valign="middle" bgcolor="ffffff" style='cursor:pointer;' onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor=''" onclick="location.href='poll_view.php?data=<?=$data?>'">
											<td height="25"><div align="left">&nbsp;&nbsp;<?=$poll_row[title]?></div></td>
											<td height="25"><div align="center"><? if ($poll_row[gubun]=="M") echo "ȸ��"; else if ($poll_row[gubun]=="D") echo "�ŷ�ó"; ?></div></td>
											<td height="25"><div align="center"><?=$poll_row[total_num]?></div></td>
											<td height="25"><div align="center"><?=substr($poll_row[sday],0,4)?>/<?=substr($poll_row[sday],4,2)?>/<?=substr($poll_row[sday],6,2)?></div></td>
											<td height="25"> <div align="center"><?=substr($poll_row[eday],0,4)?>/<?=substr($poll_row[eday],4,2)?>/<?=substr($poll_row[eday],6,2)?></div></td>
										</tr><?
										}
										include "../lib/class.php";
										$Obj=new CList("poll.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,"","","");
										$pre_icon_img="<img src='image/pre_btn.gif' width='40' height='17' border='0'>";		//����������
										$next_icon_img="<img src='image/next_btn.gif' width='40' height='17' border='0'>";	//����������
										?>
									</table><br>
									<table width="100%" border="0" align="center">
										<tr>
											<td align="center"><?$Obj->putList(true,$pre_icon_img,$next_icon_img);//�������� ����Ʈ?></td>
											<td><a href="poll.php"><img src="image/entry_btn.gif" width="59" height="17" border="0"></a></td>
										</tr>
									</table>
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