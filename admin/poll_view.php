<?
include "head.php";
$dataArr= Decode64($data);
$view_row=$MySQL->fetch_array("select *from poll where idx=$dataArr[idx]");
$today = date("Ymd");  //���ó�¥ ex)20030101
//�������� ����  0:������  1:������  2:����Ϸ�
$pollStatus =array("������","������","����Ϸ�");
if($view_row[sday] > $today)		$pollStatusIndex	= 0;	//������
else if($view_row[eday] < $today)	$pollStatusIndex	= 2;	//����Ϸ�
else								$pollStatusIndex	= 1;	//������
$answerArr = explode("����",$view_row[answer]);		//�亯 ���
$numArr	   = explode("����",$view_row[answer_num]);	//�亯�� ���
if($view_row[reCan]==1)		$reCan = "ȸ��,��ȸ��";
else						$reCan = "ȸ����";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//�������� ���� üũ
function pollDel()
{
	<?if($pollStatusIndex==0){?>//������
	var str="�������� ������ �����˴ϴ�.\n\n���� �Ͻðڽ��ϱ�?";
	<?}else if($pollStatusIndex==1){?>//������
	var str="���� ���� ������ �Դϴ�.\n\n���� �Ͻðڽ��ϱ�?";
	<?}else{?>//����Ϸ�
	var str="�������� ����� �����˴ϴ�.\n\n���� �Ͻðڽ��ϱ�?";
	<?}?>
	var choose = confirm(str);
	if(choose)
	{
		location.href="poll_edit_ok.php?data=<?=$data?>&del=1";
	}
	else return;
}
//�����Ұ� ���� �޼���
function editErr()
{
	alert("������, �Ǵ� ����Ϸ�� ��������� ������ �Ұ����մϴ�.");
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "news";     //���� �Ҹ޴� ���� ����
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
											<td width='440'><img src="image/poll_view_tit.gif"></td>
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
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr valign="middle">
											<td width="103" height="20" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ����</div></td>
											<td width="447" height="20">&nbsp;<B><?=$view_row[title]?></B> </td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr valign="middle">
											<td width="103" height="20" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǥ�Ⱓ</div></td>
											<td width="447" height="20">&nbsp;<?=substr($view_row[sday],0,4)?>�� <?=substr($view_row[sday],4,2)?>�� <?=substr($view_row[sday],6,2)?>�� ~ <?=substr($view_row[eday],0,4)?>�� <?=substr($view_row[eday],4,2)?>�� <?=substr($view_row[eday],6,2)?>��</td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="103" height="20" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��ǥ��</td>
											<td width="447" height="20"> &nbsp;&nbsp;<?=$view_row[total_num]?> </td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="103" height="20" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</td>
											<td width="447" height="20"> &nbsp;&nbsp;<B><FONT COLOR="#6600FF"><?=$pollStatus[$pollStatusIndex]?></FONT></B> </td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="103" height="20" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��������</td>
											<td width="447" height="20"> &nbsp;&nbsp;<?=$view_row[bPlu]?> </td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td width="103" height="20" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �亯������</td>
											<td width="447" height="20"> &nbsp;&nbsp;<?=$reCan?> </td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<tr>
											<td colspan="2" height="20">&nbsp;&nbsp;&nbsp; </td>
										</tr>
										<tr bgcolor="#EBEBEB">
											<td colspan="2" height="30"> <div align="center">�������� ���</div></td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<!-- �亯��� ���� --><?
										for($i=0;$i<count($answerArr);$i++)
										{
											$num = $i+1;		//������ȣ
											//ǥ��,�ۼ�Ʈ ����
											if($view_row[total_num] ==0)
											{
												$vote=0;
												$percent =0.00;
											}
											else
											{
												$vote =$numArr[$i];
												$percent =($vote / $view_row[total_num] * 100);
											}
											$percent = sprintf("%01.2f",$percent);
											?>
										<tr>
											<td colspan="2" height="25" bgcolor="#FAFAFA">
												<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td width="45%"><?=$num?>. <?=$answerArr[$i]?></td>
														<td width="35%"><img src="image/poll_view.jpg" width="<?=$percent?>%" height="15"></td>
														<td width="20%">( <?=$vote?> ǥ <?=$percent?> %)</td>
													</tr>
												</table>
											</td>
										</tr><?
										}
										?>
										<tr>
											<td colspan="2" height="1" background="image/line_bg1.gif"></td>
										</tr>
										<!-- �亯��� �� -->
										<tr>
											<td colspan="2" height="30">
												<table width="400" border="0" align="center">
													<tr><?
													if($pollStatusIndex)
													{
														//������,����Ϸ� �������� �����Ұ�
														?>
														<td ><a href="javascript:editErr();"><img src="image/edit_btn.gif" width="40" height="17" border="0"></a></td><?
													}
													else
													{
														?>
														<td ><a href="poll_edit.php?data=<?=$data?>"><img src="image/edit_btn.gif" width="40" height="17" border="0"></a></td><?
													}
													?>
														<td><a href="javascript:pollDel();"><img src="image/delete_btn.gif" width="40" height="17" border="0"></a></td>
														<td><a href="poll_list.php?data=<?=$data?>"><img src="image/list_btn.gif" width="40" height="17" border="0"></a></td>
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
<? include "copy.php"; ?>
</body>
</html>