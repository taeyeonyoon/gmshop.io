<?
session_cache_limiter("no-cache, must-revalidate");
include "html_head.php";
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");
}
$__SURELY_ICON	= "<img src='image/member/star.gif' width='7' height='7' align='absmiddle'>";		//�ʼ��׸� ������
$showArr = explode("|",$design_goods[memberJoinShow]);			//ǥ��
$sureArr = explode("|",$design_goods[memberJoinSure]);			//�ʼ�
for($i=0;$i<count($sureArr);$i++)
{
	//�ʼ��׸� ������ ǥ��
	$sureArr[$i] ? $sureIcon[$i] = $__SURELY_ICON : $sureIcon[$i] = "";
}
$bDeal=in_array($bDeal,array(0,1))?$bDeal:0;
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function searchZip()
{
	window.open("search_post.php","","scrollbars=yes,width=490,height=200,left=250,top=250");
}

function searchZip_ceo()
{
	window.open("search_post_ceo.php?form=joinForm","","scrollbars=yes,width=490,height=200,left=250,top=250");
}

function joinSendit()
{
	var form=document.joinForm;
	if(form.userid.value=="")
	{
		alert("���̵� �Է��� �ֽʽÿ�.");
		form.userid.focus();
	}
	else if(checkSpace(form.userid.value) != "")
	{
		alert("���̵� ������ �����Ҽ� �����ϴ�.");
		form.userid.focus();
		form.userid.select();
	}
	else if(form.id_check.value =="")
	{
		alert("���̵� �ߺ��˻��� ���ֽʽÿ�");
		form.userid.focus();
	}
	else if(form.userid.value!=form.id_check.value)
	{
		alert("�ߺ��˻��� ���̵� �����Ͽ����ϴ�. �ٽ� �ߺ��˻��� ���ֽʽÿ�.");
		form.userid.focus();
	}
	else if(form.pwd1.value =="")
	{
		alert("��й�ȣ�� �Է��� �ֽʽÿ�.");
		form.pwd1.focus();
	}
	else if(form.pwd2.value =="")
	{
		alert("��й�ȣ Ȯ���� �Է��� �ֽʽÿ�.");
		form.pwd2.focus();
	}
	else if(form.pwd1.value !=form.pwd2.value)
	{
		alert("��й�ȣ�� �ùٸ��� �ʽ��ϴ�.");
		form.pwd1.focus();
	}
	else if(form.name.value =="")
	{
		alert("�̸��� �Է��� �ֽʽÿ�.");
		form.name.focus();
	}
	else if(checkSpace(form.name.value) != "")
	{
		alert("�̸��� ������ �����Ҽ� �����ϴ�.");
		form.name.focus();
		form.name.select();
	}
	<?if($showArr[4] && $sureArr[4]){?>
	else if(form.email.value=="")
	{
		alert("�̸����� �Է��� �ֽʽÿ�.");
		form.email.focus();
	}
	else if(! isEmail(form.email.value))
	{
		alert("�̸����� �ùٸ��� �ʽ��ϴ�.");
		form.email.focus();
	}
	<?}?>
	<?if($sureArr[5] && !$bDeal) {?>
	else if( !bsshChek(form.ssh1.value,form.ssh2.value) )
	{
		alert("�ֹε�Ϲ�ȣ�� �ùٸ��� �ʽ��ϴ�.");
		form.ssh1.focus();
	}
	<?}?>
	<?if($showArr[6] && $sureArr[6]){?>
	else if(!telCheck(form.tel1.value,form.tel2.value,form.tel3.value))
	{
		alert("����ó�� �ùٸ��� �ʽ��ϴ�.");
		form.tel1.focus();
	}
	<?}?>
	<?if($showArr[7] && $sureArr[7]){?>
	else if(!telCheck(form.hand1.value,form.hand2.value,form.hand3.value))
	{
		alert("�޴���ȭ�� �ùٸ��� �ʽ��ϴ�.");
		form.hand1.focus();
	}
	<?}?>
	<?if($showArr[8] && $sureArr[8]){?>
	else if(form.zip1.value=="")
	{
		alert("�ּҸ� �Է��� �ֽʽÿ�.");
		searchZip();
	}
	<?}?>
	<?if($showArr[12] && $sureArr[12]){?>
	else if(form.year.value=="")
	{
		alert("��������� �Է��� �ֽʽÿ�.");
		
	}
	<?}?>
	<?if($showArr[13] && $sureArr[13]){?>
	else if(form.year2.value=="")
	{
		alert("��ȥ������� �Է��� �ֽʽÿ�.");
	}
	<?}?>
	else
	{
		form.submit();
	}
}

function idsearch()
{
	var form=document.joinForm;
	if(form.userid.value=="")
	{
		alert("���̵� �Է��� �ֽʽÿ�.");
		form.userid.focus();
	}
	else
	{
		var userid = form.userid.value;
		window.open("idsearch.php?userid="+userid,"","scrollbars=no,width=300,height=150,left=250,top=250")
	}
}
//-->
</SCRIPT>
<? include "top.php";?>
<iframe width=0 height=0 name="ifrm" frameborder='0'></iframe>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td valign="top" bgcolor="#FFFFFF">
			<table width="720" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2">
						<table width="720" height="27" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc4]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc4]?>" rowspan="2"></td>
								<td width="220" height="27" bgcolor="<?=$subdesign[bc4]?>"><img src="./upload/design/<?=$subdesign[img4]?>" ></td>
								<td height="27" bgcolor="<?=$subdesign[bc4]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc4]?>"> <img src='image/good/icon0.gif'>&nbsp;������ġ : HOME &gt; ȸ������</font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="2" bgcolor="#e6e6e6" valign="top"></td>
					<td valign="top" width="712" valign="top">
						<table width="714" border="0" cellspacing="0" cellpadding="0" valign="top">
							<tr>
								<td><?
								if ($subdesign[titimg3])
								{
									?><img src="./upload/design/<?=$subdesign[titimg4]?>" ><?
								}
								else
								{
									?><img src="image/index/member_article_img1.gif" ><?
								}
								?></td>
							</tr>
						</table><br>
						<form name="joinForm" method="post" action="member_join_ok.php">
						<input type="hidden" name="bDeal" value="<?=$bDeal?>">
						<input type="hidden" name="city"><!-- ȸ�������� -->
						<input type="hidden" name="id_check" value=""><!-- ���̵�˻� ex)1:���̵�˻�  0:ȸ������ -->
						<table width="650" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="#ffffff">
							<tr>
								<td align="center" bgcolor="ffffff" valign="top"><br>
								<!-- �⺻���� ���� -->
									<table width="630" border="0" cellspacing="1" cellpadding="10" valign="top" align='center' bgcolor='dadada'>
										<tr>
											<td bgcolor='ffffff'>
												<table width="600" border="0" cellspacing="1" cellpadding="0" valign="top">
													<tr>
														<td height="1" colspan="2" bgcolor="ffffff"></td>
													</tr>
													<tr>
														<td height="30" colspan="2" bgcolor="#f4f4f4" style="padding:5 5 5 5"><b>&nbsp;&nbsp;�⺻����</b>&nbsp;&nbsp;&nbsp;&nbsp; <?=$__SURELY_ICON?> �ʼ��׸�</td>
													</tr>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;ȸ�� ���̵� <?=$sureIcon[0]?></font></td>
														<td width="480" bgcolor="#FFFFFF" valign="middle" style="padding:5 5 5 5"> <input class="box1" type="text" name="userid" size="15"> <a href="javascript:idsearch();"><img src="image/icon/duplicate.gif" border="0" align='absmiddle'></a></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;��й�ȣ <?=$sureIcon[1]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="password" name="pwd1" size="15"></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;��й�ȣ Ȯ�� <?=$sureIcon[2]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="password" name="pwd2" size="15"></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'><font class='mem'>&nbsp;�� �� <?=$sureIcon[3]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="name" size="10"></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr>
													<?
													if($showArr[4])
													{
														?>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;�̸��� <?=$sureIcon[4]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="email" size="50"></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr><?
													}
													if($showArr[5] && !$bDeal)
													{
														?>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;�ֹε�� ��ȣ <?=$sureIcon[5]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="ssh1" size="6" maxlength="6" <?=__ONLY_NUM?>> - <input class="box1" type="text" name="ssh2" size="7" maxlength="7" <?=__ONLY_NUM?>></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr><?
													}
													if($showArr[5] && $bDeal==1)
													{
														?>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;���� ��ȣ <?=$sureIcon[5]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="ssh1" size="6" maxlength="6" <?=__ONLY_NUM?>> - <input class="box1" type="text" name="ssh2" size="7" maxlength="7" <?=__ONLY_NUM?>></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr><?
													}
													if($showArr[6])
													{
														?>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;��ȭ��ȣ <?=$sureIcon[6]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="tel1" size="3" maxlength="3" <?=__ONLY_NUM?>> - <input class="box1" type="text" name="tel2" size="4" maxlength="4" <?=__ONLY_NUM?>> - <input class="box1" type="text" name="tel3" size="4" maxlength="4" <?=__ONLY_NUM?>></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr><?
													}
													if($showArr[7])
													{
														?>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;�޴��� ��ȣ <?=$sureIcon[7]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="hand1" size="3" maxlength="3" <?=__ONLY_NUM?>> - <input class="box1" type="text" name="hand2" size="4" maxlength="4" <?=__ONLY_NUM?>> - <input class="box1" type="text" name="hand3" size="4" maxlength="4" <?=__ONLY_NUM?>></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr><?
													}
													if($showArr[8])
													{
														?>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;�����ȣ <?=$sureIcon[8]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="zip1" size="3" maxlength="3" <?=__ONLY_NUM?> > - <input class="box1" type="text" name="zip2" size="3" maxlength="3" <?=__ONLY_NUM?> > &nbsp;&nbsp; <a href="javascript:searchZip();"><img src="image/icon/post_search.gif" border="0" align='absmiddle'></a></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;�ּ� <?=$sureIcon[8]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="address1" size="50"></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;�� �ּ� </font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="address2" size="40"></td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr><?
													}
													if($showArr[10])
													{
														?>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;���ϸ� ���� <?=$sureIcon[10]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5">
															<table width="265" border="0" cellspacing="0" cellpadding="0" align="left">
																<tr>
																	<td width="79">&nbsp;&nbsp;&nbsp;��û�մϴ�</td>
																	<td width="49"> <input class="radio" type="radio" name="bMail" value="1" checked></td>
																	<td width="110">��û���� �ʽ��ϴ�.</td>
																	<td width="27"> <input class="radio" type="radio" name="bMail" value="0"></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr><?
													}
													if($showArr[11])
													{
														?>
													<tr>
														<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;SMS ���� <?=$sureIcon[11]?></font></td>
														<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5">
															<table width="265" border="0" cellspacing="0" cellpadding="0" align="left">
																<tr>
																	<td width="79">&nbsp;&nbsp;&nbsp;��û�մϴ�</td>
																	<td width="49"> <input class="radio" type="radio" name="bSms" value="y" checked></td>
																	<td width="110">��û���� �ʽ��ϴ�.</td>
																	<td width="27"> <input class="radio" type="radio" name="bSms" value="n"></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
													</tr><?
													}
													?>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table><br><?
						if ($bDeal==1)
						{
							?>
						<table width="630" border="0" cellspacing="1" cellpadding="10" valign="top" align='center' bgcolor='dadada'>
							<tr>
								<td bgcolor='ffffff'>
									<table width="600" border="0" cellspacing="0" cellpadding="0" valign="top" align='center'>
										<tr>
											<td height="30" colspan="2" bgcolor="#F4F4F4" style='padding:5 5 5 5'><b>&nbsp;&nbsp;����� ����</b></td>
										</tr>
										<tr>
											<td colspan="2">
												<table width=100% border="0" cellspacing="0" cellpadding="0" valign="top" align='center'>
													<tr>
														<td width="121" bgcolor="fafafa" height="30" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'> <font class='mem'>��ȣ(���θ�)</font></td>
														<td bgcolor="ffffff" style="padding:5 5 5 5"> <input type="text" class="box1" name="companyname" size="20" value="<?=$member_row[companyname]?>"></td>
														<td width="121" bgcolor="fafafa" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'><img src='image/mem_icon.gif'> <font class='mem'>����ڹ�ȣ</font><?//=$__SURELY_ICON?></td><?
														$ceonum = explode("-",$member_row[ceonum]);
														?>
														<td bgcolor="ffffff" style="padding:5 5 5 5"> <input type="text" class="box1" name="ceonum1" size="3" value="<?=$ceonum[0]?>" maxlength="3" <?= __ONLY_NUM ?>> - <input type="text" class="box1" name="ceonum2" size="2" value="<?=$ceonum[1]?>" maxlength="2" <?= __ONLY_NUM ?>> - <input type="text" class="box1" name="ceonum3" size="5" value="<?=$ceonum[2]?>" maxlength="5" <?= __ONLY_NUM ?>></td>
													</tr>
													<tr>
														<td height="1" colspan="4" background="image/index/dot_width.gif"></td>
													</tr>
													<tr>
														<td width="121" bgcolor="fafafa" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'> <font class='mem'>��ǥ��</font></td>
														<td bgcolor="ffffff" style="padding:5 5 5 5"> <input type="text" class="box1" name="ceoname" size="20" value="<?=$member_row[ceoname]?>"></td>
													</tr>
													<tr>
														<td height="1" colspan="4" background="image/index/dot_width.gif"></td>
													</tr>
													<tr>
														<td width="121" bgcolor="fafafa" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'> <font class='mem'>�����ȣ </font></td>
														<td colspan="3" bgcolor="ffffff" style="padding:5 5 5 5"> <input type="text" class="box1" name="ceo_zip1" size="3" <?=__ONLY_NUM?> value="<?=$ceo_zip[0]?>"> - <input type="text" class="box1" name="ceo_zip2" size="3" <?=__ONLY_NUM?> value="<?=$ceo_zip[1]?>"> <a href="javascript:searchZip_ceo();"><img src="image/icon/post_search.gif" border='0'></a> </td>
													</tr>
													<tr>
														<td height="1" colspan="4" background="image/index/dot_width.gif"></td>
													</tr>
													<tr>
														<td width="121" bgcolor="fafafa" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'> <font class='mem'>�ּ� </font></td>
														<td colspan="3" bgcolor="ffffff" style="padding:5 5 5 5"> <input type="text" class="box1" name="ceo_address1" size="55" value="<?=$member_row[ceo_address1]?>"></td>
													</tr>
													<tr>
														<td height="1" colspan="4" background="image/index/dot_width.gif"></td>
													</tr>
													<tr>
														<td width="121" bgcolor="fafafa" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'> <font class='mem'>���ּ� </font></td>
														<td colspan="3" bgcolor="ffffff" style="padding:5 5 5 5"> <input type="text" class="box1" name="ceo_address2" size="55" value="<?=$member_row[ceo_address2]?>"></td>
													</tr>
													<tr>
														<td height="1" colspan="4" background="image/index/dot_width.gif"></td>
													</tr>
													<tr>
														<td width="121" bgcolor="fafafa" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'> <font class='mem'>����</font></td>
														<td bgcolor="ffffff" style="padding:5 5 5 5"> <input type="text" class="box1" name="upjongtype" size="20" value="<?=$member_row[upjongtype]?>"></td>
														<td width="121" bgcolor="fafafa" style="padding:5 5 5 5"> <img src='image/mem_icon.gif'> <font class='mem'>����</font></td>
														<td bgcolor="ffffff" style="padding:5 5 5 5"> <input type="text" class="box1" name="jongmok" size="20" value="<?=$member_row[jongmok]?>"></td>
													</tr>
													<tr>
														<td height="1" colspan="4" background="image/index/dot_width.gif"></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table><br><?
						}
						?>
						<table width="630" border="0" cellspacing="1" cellpadding="10" valign="top" align='center' bgcolor='dadada'>
							<tr>
								<td bgcolor='ffffff'>
									<table width="600" border="0" cellspacing="1" cellpadding="0" valign="top" align='center'>
										<tr>
											<td height="30" colspan="2" bgcolor="#f4f4f4"><b>&nbsp;&nbsp;�ΰ�����</b>&nbsp;&nbsp;&nbsp;&nbsp; </td>
										</tr><?
										if($showArr[12])
										{
											?>
										<tr>
											<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;������� <?=$sureIcon[12]?></font></td>
											<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="year" size="4" maxlength='4' <?= __ONLY_NUM ?>> ��  &nbsp;&nbsp; <select name="month" class="box1"><?
											for ($i=1; $i<13; $i++)
											{
												?><option value="<?=$i?>" <? if ($i == $month) echo "selected";?>><?=$i?></option><?
											}
											?></select> ��&nbsp;&nbsp; <select name="day" class="box1"><?
											for ($i=1; $i<32; $i++)
											{
												?><option value="<?=$i?>" <? if ($i == $day) echo "selected";?>><?=$i?></option><?
											}
											?></select> ��</td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
										</tr><?
										}
										if($showArr[13])
										{
											?>
										<tr>
											<td width="110" bgcolor="#fafafa" style="padding:5 5 5 5"><img src='image/mem_icon.gif'><font class='mem'>&nbsp;��ȥ����� <?=$sureIcon[13]?></font></td>
											<td width="480" bgcolor="#FFFFFF" style="padding:5 5 5 5"> <input class="box1" type="text" name="year2" size="4" maxlength='4' <?= __ONLY_NUM ?>> ��  &nbsp;&nbsp; <select name="month2" class="box1"><?
											for ($i=1; $i<13; $i++)
											{
												?><option value="<?=$i?>" <? if ($i == $month) echo "selected";?>><?=$i?></option><?
											}
											?></select> ��&nbsp;&nbsp; <select name="day2" class="box1"><?
											for ($i=1; $i<32; $i++)
											{
												?><option value="<?=$i?>" <? if ($i == $day) echo "selected";?>><?=$i?></option><?
											}
											?></select> ��</td>
										</tr>
										<tr>
											<td colspan="2" height="1" background="image/index/dot_width.gif" bgcolor="#FDFDFD"></td>
										</tr><?
										}
										?>
									</table>
								</td>
							</tr>
						</table><br>
						<table width="250" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr align="center">
								<td><a href="javascript:joinSendit();"><img src="image/icon/ok2_btn.gif" border="0"></a></td>
								<td><a href="index.php"><img src="image/icon/cancel_lag.gif" border="0"></a></td>
							</tr>
						</table></form><!-- joinForm -->
					</td>
				</tr>
			</table><br>
		</td>
	</tr>
</table>
<? include "copy.php"; ?>
</body>
</html>