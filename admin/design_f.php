<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//Ȱ�� /��Ȱ��
function showApp()
{
	var form=document.hitForm;
	<?if($design[mainBestApp]==2){ ?>
	if(form.mainHitApp[2].checked)
	{
		alert("�ڵ� ��ũ�Ѻ�� ����Ʈ��ǰ��,��Ʈ��ǰ�� �� �Ѱ��� ���밡���մϴ�.");
		form.mainHitApp[0].checked = true;
	}
	<? } ?>
	if(form.mainHitApp[0].checked || form.mainHitApp[2].checked)
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
function hitSendit(Part)
{
	<? if (__DEMOPAGE){ ?>
	alert("������������ ��Ʈ��ǰ�� ��������� ���ѵǾ� �ֽ��ϴ�.");
	<? }else{ ?>
	var form=document.hitForm;
	if(Part==1 && form.img.value=="")
	{
		alert("�̹����� ������ �ֽʽÿ�.");
	}
	else if(Part==2 && !numCheck(form.mainHitGoodsW.value))
	{
		alert("���� ��¼� ������ �ùٸ��� �ʽ��ϴ�.");
		form.mainHitGoodsW.focus();
	}
	else if(Part==2 && form.mainHitGoodsW.value <2)
	{
		alert("���� ��¼��� 2 �̻��� ���ڸ� �Է��� �ֽʽÿ�.");
		form.mainHitGoodsW.focus();
	}
	else if(Part==2 && !numCheck(form.mainHitGoodsH.value))
	{
		alert("���� ��¼� ������ �ùٸ��� �ʽ��ϴ�.");
		form.mainHitGoodsH.focus();
	}
	else if(Part==2 && form.mainHitGoodsH.value <1)
	{
		alert("���� ��¼��� 1 �̻��� ���ڸ� �Է��� �ֽʽÿ�.");
		form.mainHitGoodsH.focus();
	}
	else if(Part==3 &&  form.mainHitContent.value=="")
	{
		alert("������ �Է��� �ֽʽÿ�.");
		form.mainHitContent.focus();
	}
	else if(Part==2 && form.mainHitApp[2].checked && form.mainHitGoodsW.value!=4)
	{
		alert("�ڵ���ũ�Ѻ� ���ÿ��� ������¼��� 4 �� �����ؾ� �մϴ�..");
	}
	else
	{
		form.action +="&part="+Part;
		form.submit();
	}
	<? } ?>
}

function ColsChange()
{
	var form=document.hitForm;
	if (form.mainHitColsChange.checked == true)
	{
		document.getElementById('colschange_id').style.display = "inline";
		var cols = form.mainHitGoodsIH.value; ////������¼�
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
								<td><img src="image/design_tit_f.gif"></td>
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
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">F ȭ�� ����</td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td> <div align="center"><img src="image/design_f_view.gif"></div></td>
											<td> <div align="center"><img src="image/design_f_view1.gif"></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="70">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" align="center" height="40">
												<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
														<td height="40"> * ��Ʈ ��ǰ�� Ÿ��Ʋ �̹��� ��� </td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" height="25"><img src="image/design_main_icon.gif" width="21" height="11">��Ʈ ��ǰ�� �Ǵ� �̺�Ʈ. ����</td>
							</tr>
							<form name="hitForm" method="post" action="design_ok.php?act=design_f"  enctype="multipart/form-data">
							<tr>
								<td colspan="2" height="50">
									<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
										<tr>
											<td bgcolor="#FFF3E1" width="100"> <div align="center">�� ��</div></td>
											<td> <div align="center"> <input type="radio" name="mainHitApp" value="1" onclick="javascript:showApp();" <?if($design[mainHitApp]==1)echo"checked";?>>���� X ���� �������</div></td>
											<td> <div align="center"> <input type="radio" name="mainHitApp" value="0" onclick="javascript:showApp();" <?if(!$design[mainHitApp])echo"checked";?>>HTML ���</div></td>
											<td> <div align="center"> <input type="radio" name="mainHitApp" value="2" onclick="javascript:showApp();" <?if($design[mainHitApp]==2)echo"checked";?>>�ڵ� ��ũ�Ѻ�</div></td>
											<td rowspan="2" align="center"><a href="javascript:hitSendit(2);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
										</tr>
										<tr>
											<td bgcolor="#FFF3E1"> <div align="center">�ڵ���ũ�Ѻ� <br>���μ���</div></td>
											<td> <div align="center"> ���� <input type="text" class="box" name="mainScrollHeight" value="<?=$design[mainScrollHeight]?>" size=5> px</div></td>
											<td> <div align="center"> ��ũ�Ѽӵ� <input type="text" class="box" name="mainScrollSpeed" value="<?=$design[mainScrollSpeed]?>" size=5> <font class="help">�� Ŭ���� ����</font></div></td>
											<td> <div align="center"> �ӹ��½ð� <input type="text" class="box" name="mainScrollWait" value="<?=$design[mainScrollWait]?>" size=5> <font class="help"> ��</font></div></td>
										</tr>
										<tr>
											<td colspan=5><font class="help">�� �ڵ���ũ�Ѻ�� ������¼� 4<b>(����)</b><br>�� �ڵ���ũ�Ѻ�� ����Ʈ��ǰ��,��Ʈ��ǰ�� �� <b>�Ѱ����� ����</b> �����մϴ�.<br>�� <b>��ǰ�����̹��� ���</b>�� ��ǰ��Ͻÿ� <b>��ǰ�����̹���</b>�� ��������� ���ο����� ��밡���մϴ�. </td>
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
														<td bgcolor="#FFF3E1" width=200> <div align="center"><b>��Ʈ ��ǰ�� Ÿ��Ʋ �̹���</b></div></td>
													</tr>
													<tr>
														<td height="30" width=300><img src="../upload/design/<?=$design[mainHitGoodsTitle]?>"  border="0"></td>
													</tr>
													<tr>
														<td align="center">
															<table width="80%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td> <div align="center"> <input type="file" name="img" size="25" style="BORDER-RIGHT: gray 1px solid; BORDER-TOP: gray  1px solid; FONT-SIZE: 9pt; BORDER-LEFT: gray 1px solid; BORDER-BOTTOM: gray  1px solid; FONT-FAMILY: gulim; HEIGHT: 19px; BACKGROUND-COLOR: white"></div></td>
																	<td><a href="javascript:hitSendit(1);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a> </td>
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
														<td width="200" bgcolor="#FFF3E1"> <div align="center">��Ʈ ��ǰ�� ��� ��</div></td>
														<td width="400">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td> <div align="center">������¼� �� ���� ��¼�</div></td>
																	<td rowspan="2" width="70"> <div align="center"><a href="javascript:hitSendit(2);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
																<tr>
																	<td align="center"> <input class="box" type="text" name="mainHitGoodsW" value="<?=$design[mainHitGoodsW]?>" size="10" <?=__ONLY_NUM?>> �� <input class="box" type="text" name="mainHitGoodsH" value="<?=$design[mainHitGoodsH]?>" size="10" <?=__ONLY_NUM?>><br>�� �� ���� �� ���� ���� ��� <input type="checkbox" value="y" name="mainHitColsChange" onclick="ColsChange();" <? if ($design[mainHitColsChange]=="y") echo "checked";?>>����� <br><font class="help">�� ������¼� ����� <b>�ϴ� ������</b> �� ���� <br>�� ����� ���� �Ʒ��� <b>�̹��� ������ ����ȵ�</b> </font>
																		<table width=100% id="colschange_id" style="display:none;">
																			<tr>
																				<td><?
																				if ($design[mainHitColsChange]=="y")
																				{
																					$cols_arr = explode("/",$design[mainHitColsChangeValue]);
																				}
																				for ($i=1; $i<=$design[mainHitGoodsH]; $i++)
																				{
																					?><?=$i."��"?> <input type="text" name="cols_arr[]" size="2" class="box" value="<?=$cols_arr[$i-1]?>"> ��<br><?
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
																	<td rowspan="2" width="70"> <div align="center"><a href="javascript:hitSendit(4);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
																</tr>
																<tr>
																	<td> <div align="center"> <input class="box" type="text" name="mainHitGoodsIW" value="<?=$design[mainHitGoodsIW]?>" size="10" <?=__ONLY_NUM?>> �� <input class="box" type="text" name="mainHitGoodsIH" value="<?=$design[mainHitGoodsIH]?>" size="10" <?=__ONLY_NUM?>></div></td>
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
												<table width="100%" border="1" cellspacing="0" cellpadding="2" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff">
													<tr>
														<td colspan="2"> <div align="center"> <textarea name="mainHitContent" cols="60" rows="5"><?=$design[mainHitContent]?></textarea></div></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="30"> <div align="center"><a href="javascript:hitSendit(3);"><img src="image/design_save_i.gif" width="46" height="18" border="0"></a></div></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="5"></td>
							</tr>
							</form><!-- hittForm -->
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