<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//��з� ����
function cateSendit()
{
	<?	if (__DEMOPAGE){ ?>
	alert("������������ ���������� ���ѵǾ����ϴ�.");
	<? }else {?>
	var form=document.cateForm;
	if(form.name.value =="")
	{
		alert("ī�װ����� �Է��� �ֽʽÿ�.");
		form.name.focus();
		return false;
	}
	else if(filehanCheck(form.img1.value))
	{
		alert("�̹���1 �� ���������� ����� �ֽʽÿ�.");
		form.img1.focus();
		return false;
	}
	else if(filehanCheck(form.img2.value))
	{
		alert("�̹���2 �� ���������� ����� �ֽʽÿ�.");
		form.img2.focus();
		return false;
	}
	else if(filehanCheck(form.img3.value))
	{
		alert("�̹���3 �� ���������� ����� �ֽʽÿ�.");
		form.img3.focus();
		return false;
	}
	else
	{
		return true;
	}
	<? } ?>
}
function categoryDel(cateName)
{
	<?	if (__DEMOPAGE){ ?>
	alert("������������ ���������� ���ѵǾ����ϴ�.");
	<? }else {?>
	var choose = confirm(cateName+"\n\n�з��� ��� ��ǰ�� �����˴ϴ�.\n\n���� �Ͻðڽ��ϱ�?");
	if(choose)
	{
		location.href="category_del.php?category=<?=$parentcode?>";
	}
	else return;
	<? } ?>
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "category";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	$parent_cate_row = $MySQL->fetch_array("select *from category where code ='$parentcode'"); //�θ�ī�װ� ����

	//ī�װ� �̹��� ��
	if(!empty($parent_cate_row[img1]))
	{
		$size_img1	=@getimagesize("../upload/category/$parent_cate_row[img1]");   //�̹��� ����
		$wSize	=$size_img1[0];	//����
		$hSize	=$size_img1[1];	//����
		$img1 = "<a href=\"javascript:zoom('../upload/category/$parent_cate_row[img1]','$wSize','$hSize');\">";
		$img1.= "<u>$parent_cate_row[img1]</a>";
	}
	if(!empty($parent_cate_row[img2]))
	{
		$size_img2	=@getimagesize("../upload/category/$parent_cate_row[img2]");   //�̹��� ����
		$wSize	=$size_img2[0];	//����
		$hSize	=$size_img2[1];	//����
		$img2 = "<a href=\"javascript:zoom('../upload/category/$parent_cate_row[img2]','$wSize','$hSize');\">";
		$img2.= "<u>$parent_cate_row[img2]</a>";
	}
	if(!empty($parent_cate_row[img3]))
	{
		$size_img3	=@getimagesize("../upload/category/$parent_cate_row[img3]");   //�̹��� ����
		$wSize	=$size_img3[0];	//����
		$hSize	=$size_img3[1];	//����
		$img3 = "<a href=\"javascript:zoom('../upload/category/$parent_cate_row[img3]','$wSize','$hSize');\">";
		$img3.= "<u>$parent_cate_row[img3]</a>";
	}
	if(!empty($parent_cate_row[img4]))
	{
		$size_img4	=@getimagesize("../upload/category/$parent_cate_row[img4]");   //�̹��� ����
		$wSize	=$size_img4[0];	//����
		$hSize	=$size_img4[1];	//����
		$img4 = "<a href=\"javascript:zoom('../upload/category/$parent_cate_row[img4]','$wSize','$hSize');\">";
		$img4.= "<u>$parent_cate_row[img4]</a>";
	}
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
								<td rowspan="3" width="200"><img src="image/cate_tit.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ī�װ� ���� ���� ��� ���� �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
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
								<td><img src="image/cate_tit2.gif"></td>
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
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" height="420">
							<tr>
								<td><div align='center'></div></td>
							</tr>
							<tr valign="middle">
								<td height="200" valign="top">
									<table width="90%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC" align="center">
										<tr>
											<td bgcolor="#FFFFFF">
												<form name="cateForm" method="post" action="category_edit_ok.php" enctype="multipart/form-data" onSubmit="return cateSendit();">
												<input type="hidden" name="parentcode" value="<?=$parentcode?>"><!-- �θ�ī�װ� �ڵ� -->
												<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td colspan="3" height="30" background="image/mem_data_bg.gif">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td><img src="image/cate_01_tit.gif" width="90" height="20"></td>
																	<td width="80%" align="center"><a href="category_design.php?parentcode=<?=$parentcode?>"><img src="image/cate_design_btn.gif"></a></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="3" height="1" background="image/line_bg1.gif"></td>
													</tr>
													<tr>
														<td width="27%" height="30" bgcolor="#F5F5F5">&nbsp;<img src="image/icon.gif" width="11" height="11"> �ڵ�</td>
														<td height="30" colspan="2"> &nbsp;&nbsp;<B><FONT  COLOR="#6600FF"><?=$parent_cate_row[code]?></FONT></B></td>
													</tr>
													<tr>
														<td colspan="3" height="1" background="image/line_bg1.gif"></td>
													</tr>
													<tr>
														<td width="27%" height="30" bgcolor="#F5F5F5">&nbsp;<img src="image/icon.gif" width="11" height="11"> �з���</td>
														<td height="30" colspan="2"> &nbsp;&nbsp; <input class="box" type="text" name="name" value="<?=$parent_cate_row[name]?>" size=40>&nbsp;&nbsp;<input type="checkbox" name="bHide" value="1" <? if ($parent_cate_row[bHide]) echo "checked";?>>���� �������� ����</td>
													</tr>
													<tr>
														<td colspan="3" height="1" background="image/line_bg1.gif"></td>
													</tr>
													<tr bgcolor="#E7E7E7">
														<td colspan="3" height="30"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �з� �̹���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A href="#go1"><font color="#FF0000">(�̹��� ������ġ�� �Ʒ��� �����ϼ���)</font></a></div></td>
													</tr>
													<tr>
														<td  height="25" bgcolor="#F5F5F5" rowspan="2"> <div align="center">�̹���1</div></td>
														<td  height="25" valign="middle" colspan="2"> &nbsp;&nbsp;<?=$img1?></td>
													</tr>
													<tr>
														<td  height="25" valign="middle" colspan="2"> &nbsp;&nbsp; <input class="box" type="file" name="img1">  <a href="category_edit_ok.php?del=1&img=img1&idx=<?=$parent_cate_row[idx]?>&parentcode=<?=$parentcode?>"><img src="image/delete_btn.gif" border=0></a><BR><FONT COLOR="#993300">- ���� ī�װ���½� �⺻�̹��� (170 x 30)</FONT></td>
													</tr>
													<tr>
														<td colspan="3" height="1" background="image/line_bg1.gif"></td>
													</tr>
													<tr>
														<td  height="25" bgcolor="#F5F5F5" rowspan="2"> <div align="center">�̹���2</div></td>
														<td  height="25" valign="middle" colspan="2"> &nbsp;&nbsp;<?=$img2?></td>
													</tr>
													<tr>
														<td  height="25" valign="middle" colspan="2"> &nbsp;&nbsp; <input class="box" type="file" name="img2"> <a href="category_edit_ok.php?del=1&img=img2&idx=<?=$parent_cate_row[idx]?>&parentcode=<?=$parentcode?>"><img src="image/delete_btn.gif" border=0></a><BR><FONT COLOR="#993300">- ���� ī�װ���½� MOUSE OVER (170 x 30)</FONT></td>
													</tr>
													<tr>
														<td colspan="3" height="1" background="image/line_bg1.gif"></td>
													</tr>
													<tr>
														<td  height="25" bgcolor="#F5F5F5" rowspan="2"> <div align="center">�̹���3</div></td>
														<td  height="25" valign="middle" colspan="2"> &nbsp;&nbsp;<?=$img3?></td>
													</tr>
													<tr>
														<td  height="25" valign="middle" colspan="2"> &nbsp;&nbsp; <input class="box" type="file" name="img3">  <a href="category_edit_ok.php?del=1&img=img3&idx=<?=$parent_cate_row[idx]?>&parentcode=<?=$parentcode?>"><img src="image/delete_btn.gif" border=0></a><BR><FONT COLOR="#993300">- ��ǰ��ϳ� ī�װ� Ÿ��Ʋ (���� 53pixel)</FONT></td>
													</tr>
													<tr>
														<td colspan="3" height="1" background="image/line_bg1.gif"></td>
													</tr>
													<tr>
														<td  height="25" bgcolor="#F5F5F5" rowspan="2"> <div align="center">�̹���4</div></td>
														<td  height="25" valign="middle" colspan="2"> &nbsp;&nbsp;<?=$img4?></td>
													</tr>
													<tr>
														<td  height="25" valign="middle" colspan="2"> &nbsp;&nbsp; <input class="box" type="file" name="img4"> <a href="category_edit_ok.php?del=1&img=img4&idx=<?=$parent_cate_row[idx]?>&parentcode=<?=$parentcode?>"><img src="image/delete_btn.gif" border=0></a><BR><FONT COLOR="#993300">- ��ǰ��ϳ� ī�װ� �̹��� (720 x 200)</FONT></td>
													</tr>
													<tr>
														<td colspan="3" height="1" background="image/line_bg1.gif"></td>
													</tr>
													<tr>
														<td colspan="3" height="20">ī�װ� ���� ���������� : <?=$parent_cate_row[editday]?> </td>
													</tr>
													<tr>
														<td colspan="3" height="1" background="image/line_bg1.gif"></td>
													</tr>
													<tr>
														<td colspan="3" height="45">
															<table width="200" border="0" align="center">
																<tr>
																	<td> <div align="center"><input type="image" src="image/edit_btn.gif" width="40" height="17" border="0"></div></td>
																	<td> <div align="center"><a href="javascript:categoryDel('<?=htmlspecialchars($parent_cate_row[name])?>');"><img src="image/delete_btn.gif" width="40" height="17" border="0"></a></div></td>
																	<td> <div align="center"><a href="javascript:formClear(document.cateForm);"><img src="image/cancel_btn.gif" width="40" height="17" border="0"></a></div></td>
																</tr>
															</table>
														</td>
													</tr>
												</table></form><!-- cateForm -->
											</td>
										</tr>
									</table>
									<a name=go1> <br></a><br>
									<img src='image/design_good_view2.gif'>
								</td>
							</tr>
						</table><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>