<?
include "head.php"; 
if (empty($data2)) ////// ��üȸ�� ������ �帧���� 
{
	$data=Decode64($data);
	$pagecnt=$data[pagecnt];
	$letter_no=$data[letter_no];
	$offset=$data[offset];
	$LIMIT		=20;								//�������� �� ��
	$PAGEBLOCK	=10;								//���� ������ ��
	$numresults=$MySQL->query("select idx from point_table");
	$numrows=mysql_num_rows($numresults);	
	if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
	if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
	if(!$letter_no){$letter_no=$numrows;}	
	$bbs_qry = "select * from point_table order by idx desc limit $offset,$LIMIT";
}
else /////////// ȸ�� ���� ������ �帧����ÿ��� $data ������ ���� ����
{
	$dataArr = Decode64($data2); ////ȸ������ 
	$data=Decode64($data); ///���������� 
	$pagecnt=$data[pagecnt];
	$letter_no=$data[letter_no];
	$offset=$data[offset];
	$LIMIT		=15;								//�������� �� ��
	$PAGEBLOCK	=10;								//���� ������ ��
	$member_row = $MySQL->fetch_array("select *from member where idx=$dataArr[idx]"); 
	$numresults=$MySQL->query("select idx from point_table where userid='$member_row[userid]'");
	$numrows=mysql_num_rows($numresults);	
	if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
	if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
	if(!$letter_no){$letter_no=$numrows;}	
	$bbs_qry = "select * from point_table where userid='$member_row[userid]' order by idx desc limit $offset,$LIMIT";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="30" colspan="2" bgcolor="#f4f4f4"><b>&nbsp;&nbsp;������ ����</b></td>
	</tr>
	<tr>
		<td height="1" colspan="2" bgcolor="ffffff"></td>
	</tr>
	<tr>
		<td height="1" colspan="2" bgcolor="dadada"></td>
	</tr>
	<tr>
		<td colspan="2" valign="top"><br>
			<table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td colspan="9">��ü [ <font color="#FF9900"><?=$numrows?></font> ]��<br></td>
				</tr>
				<tr>
					<td height="1" colspan="11" bgcolor="dadada"></td>
				</tr>
				<tr>
					<td height="1" colspan="11" bgcolor="ffffff"></td>
				</tr>
				<tr>
					<td height="22" width="30" align="center" bgcolor="#f4f4f4">��ȣ</td>
					<td height="22" width="2" bgcolor="#F2F2F2" ><img src="image/board/wid_line_1.gif" width="2" height="16"></td>
					<td height="22" width="100" align="center" bgcolor="#f4f4f4">���̵�</td>
					<td height="22" width="2" bgcolor="#F2F2F2" ><img src="image/board/wid_line_1.gif" width="2" height="16"></td>
					<td height="22" width="30" align="center" bgcolor="#f4f4f4">����</td>
					<td height="22" width="2" bgcolor="#F2F2F2" ><img src="image/board/wid_line_1.gif" width="2" height="16"></td>
					<td height="22" align="center" bgcolor="#f4f4f4" width="80">������</td>
					<td height="22" width="2" bgcolor="#F2F2F2" ><img src="image/board/wid_line_1.gif" width="2" height="16"></td>
					<td height="22" width="282" align="center" bgcolor="#f4f4f4">����</td>
					<td height="22" width="2" align="center" bgcolor="#F2F2F2"><img src="image/board/wid_line_1.gif" width="2" height="16"></td>
					<td height="22" width="100" align="center" bgcolor="#f4f4f4">�߻�����</td>
				</tr>
				<tr>
					<td height="1" colspan="11" align="center" bgcolor="ffffff"></td>
				</tr>
				<tr>
					<td height="1" colspan="11" align="center" bgcolor="dadada"></td>
				</tr><?
				$bbs_result=$MySQL->query($bbs_qry);
				$s_letter=$letter_no;								//�������� ���� �۹�ȣ
				while($bbs_row=mysql_fetch_array($bbs_result))
				{
					if($bbs_row[point] >=0)	$part ="<FONT COLOR='#6600FF'>$bbs_row[part]</FONT>";
					else				$part ="<FONT COLOR='#CC0000'>$bbs_row[part]</FONT>";
					?>
				<tr>
					<td align="center" height="25" width="30"><?=$letter_no?></td>
					<td align="center" height="25" width="2">&nbsp;</td>
					<td align="center" height="25" width="100"><?=$bbs_row[userid]?></td>
					<td align="center" height="25" width="2">&nbsp;</td>
					<td align="center" height="25" width="30"><font color="#0000FF"><?=$part?></font></td>
					<td align="center" height="25" width="2">&nbsp;</td>
					<td align="right" height="25" width="80"><?=PriceFormat($bbs_row[point])?> ��</td>
					<td align="center" height="25" width="2">&nbsp;</td>
					<td align="center" height="25" width="282"><?=$bbs_row[reason]?></td>
					<td align="center" height="25" width="2">&nbsp;</td>
					<td align="center" height="25" width="100"><?=str_replace("-","/",substr($bbs_row[writeday],0,16))?></td>
				</tr>
				<tr>
					<td align="center" colspan="11" height="1" background="../image/index/dot_width.gif"></td>
				</tr><?
					$letter_no--;
				}
				include "../lib/class.php";
				$Obj=new CList("member_point.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,"","","data2=$data2");
				?>
			</table><br>
			<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr bgcolor="cccccc">
					<td height="25" colspan="5" align="center" bgcolor="#fafafa"><?$Obj->putList(true,"","");//�������� ����Ʈ?></td>
				</tr>
				<tr>
					<td height="1" colspan="9" bgcolor="ffffff"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>