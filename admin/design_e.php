<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//Ȱ�� /��Ȱ��
function showApp()
{
	var form=document.bestForm;
	<?if($design[mainHitApp]==2){ ?>
	if(form.mainBestApp[2].checked)
	{
		alert("�ڵ� ��ũ�Ѻ�� ����Ʈ��ǰ��,��Ʈ��ǰ�� �� �Ѱ��� ���밡���մϴ�.");
		form.mainBestApp[0].checked = true;
	}
	<? } ?>
	if(form.mainBestApp[0].checked || form.mainBestApp[2].checked)
	{
		document.getElementById('goodsApp').style.display="";
		document.getElementById('htmlApp').style.display="none";
	}
	else
	{
		document.getElementById('goodsApp').style.display="none";
		document.getElementById('htmlApp').style.display="";
	}
}

//���� ����
function bestSendit(Part)
{
	var form=document.bestForm;
	if(Part==1 && form.img.value=="")
	{
		alert("�̹����� ������ �ֽʽÿ�.");
	}
	else if(Part==2 && !numCheck(form.mainBestGoodsW.value))
	{
		alert("���� ��¼� ������ �ùٸ��� �ʽ��ϴ�.");
		form.mainBestGoodsW.focus();
	}
	else if(Part==2 && form.mainBestGoodsW.value <2)
	{
		alert("���� ��¼��� 2 �̻��� ���ڸ� �Է��� �ֽʽÿ�.");
		form.mainBestGoodsW.focus();
	}
	else if(Part==2 && !numCheck(form.mainBestGoodsH.value))
	{
		alert("���� ��¼� ������ �ùٸ��� �ʽ��ϴ�.");
		form.mainBestGoodsH.focus();
	}
	else if(Part==2 && form.mainBestGoodsH.value <1)
	{
		alert("���� ��¼��� 1 �̻��� ���ڸ� �Է��� �ֽʽÿ�.");
		form.mainBestGoodsH.focus();
	}
	else if(Part==3 &&  form.mainBestContent.value=="")
	{
		alert("������ �Է��� �ֽʽÿ�.");
		form.mainBestContent.focus();
	}
	else if(Part==2 && form.mainBestApp[2].checked && form.mainBestGoodsW.value!=4)
	{
		alert("�ڵ���ũ�Ѻ� ���ÿ��� ������¼��� 4 �� �����ؾ� �մϴ�..");
	}
	else
	{
		form.action +="&part="+Part;
		form.submit();
	}
}

function ColsChange()
{
	var form=document.bestForm;
	if (form.mainBestColsChange.checked == true)
	{
		document.getElementById('colschange_id').style.display = "inline";
		var cols = form.mainBestGoodsIH.value; ////������¼�
	}
	else document.getElementById('colschange_id').style.display = "none";
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="javascript:showApp();ColsChange();">
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
								<td><img src="image/design_tit_e.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height='10'></td>
				</tr>
				<tr>
					<td valign="top">
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<? include "main_design_menu.php";?>
							<tr>
								<td colspan="2" height="10"></td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">E ȭ�� ����</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="650" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td> <div align="center"><img src="image/design_e_view.gif"></div></td>
											<td> <div align="center"><img src="image/design_e_view1.gif"></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="80">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" align="center" height="40">
												<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height="40"> * ����Ʈ ��ǰ�� Ÿ��Ʋ �̹��� ��� </td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">����Ʈ ��ǰ�� �Ǵ� �̺�Ʈ. ����</td>
							</tr>
							<form name="bestForm" method="post" action="design_ok.php?act=design_e"  enctype="multipart/form-data" >
							<tr>
								<td colspan="2" height="50">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" width="100"> <div align="center">�� ��</div></td>
											<td> <div align="center"> <input type="radio" name="mainBestApp" value="1" onclick="javascript:showApp();" <?if($design[mainBestApp]==1) echo"checked";?>>���� X ���� �������</div></td>
											<td> <div align="center"> <input type="radio" name="mainBestApp" value="0" onclick="javascript:showApp();" <?if(!$design[mainBestApp]) echo"checked";?>>HTML </div></td>
											<td> <div align="center"> <input type="radio" name="mainBestApp" value="2" onclick="javascript:showApp();"  <?if($design[mainBestApp]==2) echo"checked";?>>�ڵ� ��ũ�Ѻ�</div></td>
											<td rowspan="2" align="center"><a href="javascript:bestSendit(2);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
										</tr>
										<tr>
											<td bgcolor="#FFF3E1"> <div align="center">�ڵ���ũ�Ѻ� <br>���μ���</div></td>
											<td> <div align="center"> ���� <input type="text" class="box" name="mainScrollHeight" value="<?=$design[mainScrollHeight]?>" size=5> px</div></td>
											<td> <div align="center"> ��ũ�Ѽӵ� <input type="text" class="box" name="mainScrollSpeed" value="<?=$design[mainScrollSpeed]?>" size=5> <font class="help">�� Ŭ���� ����</font></div></td>
											<td> <div align="center"> �ӹ��½ð� <input type="text" class="box" name="mainScrollWait" value="<?=$design[mainScrollWait]?>" size=5> <font class="help"> ��</font></div></td>
										</tr>
										<tr>
											<td colspan=5><font class="help">�� �ڵ���ũ�Ѻ�� ������¼� 4 <b>(����)</b><br>�� �ڵ���ũ�Ѻ�� ����Ʈ��ǰ��,��Ʈ��ǰ�� �� <b>�Ѱ����� ����</b> �����մϴ�. <br>�� <b>��ǰ�����̹��� ���</b>�� ��ǰ��Ͻÿ� <b>��ǰ�����̹���</b>�� ��������� ���ο����� ��밡���մϴ�.</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr id="goodsApp">
								<td colspan="2"><br>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
										<tr>
											<td>
												<table width="100%" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td bgcolor="#FFF3E1" width=200> <div align="center"><b>����Ʈ ��ǰ�� Ÿ��Ʋ �̹���</b></div></td>
													</tr>
													<tr>
														<td height="30" width=300><img src="../upload/design/<?=$design[mainBestGoodsTitle]?>" border="0"></td>
													</tr>
													<tr>
														<td align="center">
															<table width="80%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
																	<td><a href="javascript:bestSendit(1);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
																</tr>
															</table>
														</td>
													</tr>
													<tr bgcolor="#FFF3E1">
														<td bgcolor="#FFF3E1"> <div align="center">gif , jpg ��밡�� (����ȭ ������ 720*30) </div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="5"></td>
										</tr>
										<tr>
											<td><br>
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td width="200" bgcolor="#FFF3E1"> <div align="center">����Ʈ ��ǰ�� ��� ��</div></td>
														<td width="400">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td> <div align="center">������¼� �� ���� ��¼�</div></td>
																	<td rowspan="2" width="70"> <div align="center"><a href="javascript:bestSendit(2);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
																<tr>
																	<td> <div align="center"> <input class="box" type="text" name="mainBestGoodsW" value="<?=$design[mainBestGoodsW]?>" size="10" <?=__ONLY_NUM?>> �� <input class="box" type="text" name="mainBestGoodsH" value="<?=$design[mainBestGoodsH]?>" size="10" <?=__ONLY_NUM?>><br>�� �� ���� �� ���� ���� ��� <input type="checkbox" value="y" name="mainBestColsChange" onclick="ColsChange();" <? if ($design[mainBestColsChange]=="y") echo "checked";?>>�����<br><font class="help">�� ������¼� ����� <b>�ϴ� ������</b> �� ���� <br>�� ����� ���� �Ʒ��� <b>�̹��� ������ ����ȵ�</b> </font>
																		<table width=100% id="colschange_id" style="display:none;">
																			<tr>
																				<td><?
																				if ($design[mainBestColsChange]=="y")
																				{
																					$cols_arr = explode("/",$design[mainBestColsChangeValue]);
																				}
																				for ($i=1; $i<=$design[mainBestGoodsH]; $i++)
																				{
																					?><?=$i."��"?> <input type="text" name="cols_arr[]" size="2" class="box" value="<?=$cols_arr[$i-1]?>"> ��<br> <?
																				}
																				?></td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td width="200" bgcolor="#FFF3E1"> <div align="center">�̹��� ��»�����</div></td>
														<td width="300">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td> <div align="center">���λ����� �� ���λ�����</div></td>
																	<td rowspan="2" width="70"> <div align="center"><a href="javascript:bestSendit(4);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
																<tr>
																	<td> <div align="center"> <input class="box" type="text" name="mainBestGoodsIW" value="<?=$design[mainBestGoodsIW]?>" size="10" <?=__ONLY_NUM?>> �� <input class="box" type="text" name="mainBestGoodsIH" value="<?=$design[mainBestGoodsIH]?>" size="10" <?=__ONLY_NUM?>></div></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr bgcolor="#FFF3E1">
														<td bgcolor="#FFF3E1" colspan="2"> <div align="center"> ������¼��� 2 �̻� ���� ��¼��� 1�̻��� ���ڸ� �Է��� �ֽʽÿ�. </div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp; </td>
							</tr>
							<tr id="htmlApp">
								<td colspan="2" height="160">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td>
												<table width="500" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td colspan="2"> <div align="center"> <textarea name="mainBestContent" cols="65" rows="5"><?=$design[mainBestContent]?></textarea></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30"> <div align="center"><a href="javascript:bestSendit(3);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							</form><!-- bestForm -->
							<tr>
								<td colspan="2">&nbsp;</td>
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