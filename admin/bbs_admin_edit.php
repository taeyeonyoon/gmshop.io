<?
include "head.php";
$dataArr= Decode64($data);
$view_row=$MySQL->fetch_array("select *from bbs_list where idx=$dataArr[idx]");
$MySQL->query("select *from bbs_data where code ='$view_row[code]'");
$total_bbs_data = $MySQL->is_affected();	//�� �Խù� ��
if($view_row[bUse])
{
	$true_bUse	= "checked";
	$false_bUse	= "";
}
else
{
	$true_bUse	= "";
	$false_bUse	= "checked";
}
if($view_row[part] == "10")
{
	$part10		= "checked";
	$part20		= "";
	$part30		= "";
}
else if($view_row[part] == "20")
{
	$part10		= "";
	$part20		= "checked";
	$part30		= "";
}
else
{
	$part10		= "";
	$part20		= "";
	$part30		= "checked";
}
if($view_row[bComment])
{
	$true_bComment	= "checked";
	$false_bComment	= "";
}
else
{
	$true_bComment	= "";
	$false_bComment	= "checked";
}
if($view_row[bCommunity]=="y")
{
	$true_bCommunity	= "checked";
	$false_bCommunity	= "";
}
else
{
	$true_bCommunity	= "";
	$false_bCommunity	= "checked";
}
if($view_row[intro_html])
{
	$true_intro_html	= "checked";
	$false_intro_html	= "";
}
else
{
	$true_intro_html	= "";
	$false_intro_html	= "checked";
}
$partArr	= array("10" => "�ϹݰԽ���", "20" => "�ڷ��", "30" => "������");		//�Խ��� ���� �迭
$partKey	= array_keys($partArr);
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//���� ����
function bbsadminSendit()
{
	var form=document.bbs_adminForm;
	if(form.name.value=="")
	{
		alert("�Խ��Ǹ��� �Է��� �ֽʽÿ�.");
		form.name.focus();
	}
	else if(form.newPeriod.value < 1)
	{
		alert("���� �̹��� ǥ�ñⰣ�� 1�� �̻��Դϴ�.");
		form.newPeriod.focus();
	}
	else form.submit();
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "board";     //���� �Ҹ޴� ���� ����
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
								<td><img src="image/board_tit_info.gif"></td>
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
						<form name="bbs_adminForm" method="post" action="bbs_admin_edit_ok.php" enctype="multipart/form-data" >
						<input type="hidden" name="data" value="<?=$data?>">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" height="420">
							<tr valign="middle">
								<td width="150" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
								<td width="447" height="25">&nbsp;&nbsp;<select name="gubun"><option value="M" <? if ($gubun=="M") echo "selected";?>>ȸ���Խ���</option><option value="D" <? if ($gubun=="D") echo "selected";?>>����ȸ���Խ���</option></select><font class="help">�ص���ȸ���Խ����� <b>����ȸ���� �α�����������</b> ��������</font></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</td>
								<td width="447" height="25">
									<table width="400" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="10%"><input class="radio" type="radio" value="10" name="part" <?=$part10?>></td>
											<td width="20%">�ϹݰԽ���</td>
											<td width="10%"><input class="radio" type="radio" value="20" name="part" <?=$part20?>></td>
											<td width="20%">�ڷ��</td>
											<td width="10%"><input class="radio" type="radio" value="30" name="part" <?=$part30?>></td>
											<td width="30%">������</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="150" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
								<td width="447" height="25">&nbsp;&nbsp;<FONT  COLOR="#6600FF"><B><?=$view_row[code]?></B></FONT></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="150" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
								<td width="447" height="25">&nbsp;&nbsp;<input class="box" name="name" type="text" id="title" size="30" value="<?=$view_row[name]?>"></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="150" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� �Խù� ��</div></td>
								<td width="447" height="25">&nbsp;&nbsp;<?=$total_bbs_data?></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA" rowspan="5">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</td>
								<td width="447" height="25">
									<table width="250" border="0">
										<tr>
											<td width="100"> <div align="center">�б����</div></td>
											<td> <div align="center"> <select name="rAct"><option value="0">���Ѿ���</option><option value="10" <?if($view_row[rAct]==10) echo"selected";?>>ȸ���̻�</option><option value="100" <? if ($view_row[rAct]==100) echo "selected";?>>������</option></select></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="447" height="25">
									<table width="250" border="0">
										<tr>
											<td width="100"> <div align="center">�������</div></td>
											<td> <div align="center"> <select name="wAct"><option value="0">���Ѿ���</option><option value="10" <?if($view_row[wAct]==10) echo"selected";?>>ȸ���̻�</option><option value="100" <? if ($view_row[wAct]==100) echo "selected";?>>������</option></select></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="447" height="25">
									<table width="250" border="0">
										<tr>
											<td width="100"> <div align="center">�亯����</div></td>
											<td> <div align="center"> <select name="cAct"><option value="0">���Ѿ���</option><option value="10" <?if($view_row[cAct]==10) echo"selected";?>>ȸ���̻�</option><option value="100" <? if ($view_row[cAct]==100) echo "selected";?>>������</option></select></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �����̹��� <br>&nbsp;&nbsp;&nbsp;ǥ�ñⰣ (��)</td>
								<td width="447" height="25">&nbsp;&nbsp;<input class="box" name="newPeriod" type="text" id="width" size="3" <?=__ONLY_NUM?> value="<?=$view_row[newPeriod]?>"> ��</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �Խ��ǻ��</td>
								<td width="447" height="25" align="left">
									<table width="300" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="10%"><input class="radio" type="radio" value="1" name="bUse" <?=$true_bUse?>></td>
											<td width="40%">�����</td>
											<td width="10%"><input class="radio" type="radio" value="0" name="bUse" <?=$false_bUse?>></td>
											<td width="40%">�����������(����)</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ���������</td>
								<td width="447" height="25" align="left">
									<table width="300" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="10%"><input class="radio" type="radio" value="1" name="bComment" <?=$true_bComment?>></td>
											<td width="40%">�����</td>
											<td width="10%"><input class="radio" type="radio" value="0" name="bComment" <?=$false_bComment?>></td>
											<td width="40%">�����������</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> Ŀ�´�Ƽ ���������� &nbsp;&nbsp;&nbsp;&nbsp;�Խ��� ����</td>
								<td width="447" height="25" align="left">
									<table width="300" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td width="10%"><input class="radio" type="radio" value="1" name="bCommunity" <?=$true_bCommunity?>></td>
											<td width="40%">�����</td>
											<td width="10%"><input class="radio" type="radio" value="0" name="bCommunity" <?=$false_bCommunity?>></td>
											<td width="40%">�����������</td>
										</tr>
										<tr>
											<td colspan="4"><font class="help">�� ���� <b>�Խ��� ���</b>�� �����������(����)���� �����ϸ� �Ϲ������������� �Ⱥ��̰� <b>Ŀ�´�Ƽ������</b> ��Ÿ���� �Ҽ��ֽ��ϴ�.</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �Խ��ǼҰ�����</td>
								<td width="600" height="25" align="left">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td>&nbsp;<input type="radio" name="intro_html" value="0" <?=$false_intro_html?>>TEXT&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="intro_html" value="1" <?=$true_intro_html?>>HTML<br>&nbsp;<textarea class="box" name="intro" cols="80" rows="5"><?=$view_row[intro]?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �����̹���</td>
								<td width="600" height="25" align="left">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td>&nbsp;<input class="box" type="file" name="nameimg">&nbsp;�� ���� 175px (JPG, GIF�� ����)</td>
										</tr>
									</table>
								</td>
							</tr><?
							if ($view_row[nameimg])
							{
								?>
							<tr>
								<td colspan=2 width="500"><img src="../upload/bbs/<?=$view_row[nameimg]?>">&nbsp;&nbsp;<input type="checkbox" name="nameimg_del" value="y"> �̹��� ������ üũ�ϼ���</td>
							</tr><?
							}
							?>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> Ŀ�´�Ƽ �����̹���</td>
								<td width="600" height="25" align="left">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td>&nbsp;<input class="box" type="file" name="commnameimg"> (JPG, GIF�� ����)<br>&nbsp;�� �̹����� ���� �ȼ��� ��ü 720px �� �������� 2���ϰ�� 360px, 3���� 240px, 4���� 180px</td>
										</tr>
									</table>
								</td>
							</tr><?
							if ($view_row[commnameimg])
							{
								?>
							<tr>
								<td colspan=2 width="500"><img src="../upload/bbs/<?=$view_row[commnameimg]?>">&nbsp;&nbsp;<input type="checkbox" name="commnameimg_del" value="y"> �̹��� ������ üũ�ϼ���</td>
							</tr><?
							}
							?>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> Ÿ��Ʋ�̹���</td>
								<td width="600" height="25" align="left">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
										<tr>
											<td>&nbsp;<input class="box" type="file" name="img1">&nbsp;�� ���� 714px (JPG, GIF�� ����)</td>
										</tr>
									</table>
								</td>
							</tr><?
							if ($view_row[img])
							{
								?>
							<tr>
								<td colspan=2 width="500"><img src="../upload/bbs/<?=$view_row[img]?>">&nbsp;&nbsp;<input type="checkbox" name="img_del" value="y"> �̹��� ������ üũ�ϼ���</td>
							</tr><?
							}
							?>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="150" height="20">&nbsp;</td>
								<td width="447" height="20" align="left"><br>
									<table width="200" border="0" align="center">
										<tr>
											<td><div align="center"><a href="javascript:bbsadminSendit();"><img src="image/edit_btn.gif" width="40" height="17" border="0"></a></div></td>
											<td><div align="center"><a href="bbs_admin_list.php"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
										</tr>
									</table><br>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
						</table></form><!-- bbs_adminForm -->
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>