<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//�ʼ� Ȱ��/��Ȱ��
function sureDisabled(Index)
{
	var form=document.showForm;
	if(form.show[Index].checked)
	{
		checkshowObject(form.sure[Index],true);
	}
	else
	{
		form.sure[Index].checked=false;
		checkshowObject(form.sure[Index],false);
	}
}
function showDisabled(Index)
{
	var form=document.showForm;
	if(form.sure[Index].checked)
	{
		form.show[Index].checked=true;
	}
}
//���� ����
function showSendit()
{
	var form=document.showForm;
	var showArr = new Array();
	var sureArr = new Array();
	for(i=0;i<form.show.length;i++)
	{
		form.show[i].checked ? showArr[i]=1:showArr[i] =0;
		form.sure[i].checked ? sureArr[i]=1:sureArr[i] =0;
	}
	form.memberJoinShow.value = showArr.join("|");
	form.memberJoinSure.value = sureArr.join("|");
	form.submit();
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "design";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
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
								<td rowspan="3" width="200"><img src="image/design_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �������� �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
								<td><img src="image/design_tit_join.gif"></td>
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
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan="2" height="25" valign="top"> <p><img src="image/design_main_icon.gif" width="21" height="11">ȸ�� ���� ȭ�� ����</p></td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td width="80">&nbsp;</td>
											<td width="170"> <div align="center"><img src="image/design_join_view.gif"></div></td>
											<td width="30">&nbsp;</td>
											<td width="200"> <div align="center"><img src="image/design_join_view1.gif"></div></td>
											<td width="70">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="60">
									<table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff" height="50">
										<tr>
											<td bgcolor="#FFF3E1">* ȸ������ �� - �ʼ����׹� ���� ���� ����</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="image/design_main_icon.gif" width="21" height="11">ȸ������ �� �ʼ��׸�</td>
				</tr>
				<tr>
					<td colspan="2"> <div align="center"><b><font color="#FF0000">* üũ������ �� ������ ���� �Դϴ�.</font></b><br></div>
						<table width="750" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
							<tr bgcolor="#FFF3E1">
								<td height="25" width='300'> <div align="center"><font color="#FF6600">����</font></div></td>
								<td height="25"> <div align="center"><font color="#FF6600">ǥ ��</font></div></td>
								<td height="25"> <div align="center"><font color="#FF6600">�� ��</font></div></td>
							</tr>
							<form name="showForm" method="post" action="design_goods_ok.php?act=design_join&part=2"  enctype="multipart/form-data" >
							<input type="hidden" name="memberJoinShow">
							<input type="hidden" name="memberJoinSure"><?
							$showArr = explode("|",$design_goods[memberJoinShow]); //ǥ�� �迭
							$sureArr = explode("|",$design_goods[memberJoinSure]); //�ʼ� �迭
							for($i=0;$i<count($JOIN_FORM_ARR);$i++)
							{
								$disabled = $JOIN_FORM_ARR_DEFAULT[$i] ? "disabled" :""; //���ð���|�Ұ���
								$bgcolor  = $JOIN_FORM_ARR_DEFAULT[$i] ? "#dddddd" :"#ffffff";
								$showCheck =$showArr[$i] ?"checked" : ""; //ǥ��|��ǥ��
								$sureCheck =$sureArr[$i] ?"checked" : ""; //�ʼ�|���ʼ�
								?>
							<tr>
								<td height="25" bgcolor="#FFF3E1"> <div align="center"><?=$i?> <?=$JOIN_FORM_ARR[$i]?></div></td>
								<td height="25" bgcolor="<?=$bgcolor?>"> <div align="center"> <input type="checkbox" name="show" value="1" <?=$showCheck?> <?=$disabled?> onclick="javascript:sureDisabled(<?=$i?>);"></div></td>
								<td height="25"  bgcolor="<?=$bgcolor?>"> <div align="center"> <input type="checkbox" name="sure" value="1" <?=$sureCheck?> <?=$disabled?> onclick="javascript:showDisabled(<?=$i?>);"></div></td>
							</tr><?
							}
							?>
							</form><!-- showForm -->
							<tr>
								<td colspan="3" height="25" align="center"><a href="javascript:showSendit();"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>