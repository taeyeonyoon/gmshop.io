<?
include "head.php";
$member_row = $MySQL->fetch_array("select *from member where userid='$_SESSION[GOOD_SHOP_USERID]'");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
var goodsIdxArr = new Array();
var goodsCntArr	= new Array();

//üũ�ڽ� ��� üũ
function allCheck()
{
	var form=document.intForm;
	if(form.chek && form.chek.length)
	{
		//���ɻ�ǰ��� 2�̻�
		for(i=0;i<form.chek.length;i++)
		{
			if(form.allchek.checked)
			{
				form.chek[i].checked = true;
			}
			else
			{
				form.chek[i].checked = false;
			}
		}
	}
	else if(form.chek)
	{
		//���ɻ�ǰ 1��
		if(form.allchek.checked)
		{
			form.chek.checked = true;
		}
		else
		{
			form.chek.checked = false;
		}
	}
}

//��ٱ��� ��� ����
function cartSendit(goUrl)
{
	var form=document.intForm;
	form.idxStr.value = goodsIdxArr.join("����");	//idx ����
	form.cntStr.value = goodsCntArr.join("����");	//���� ����
	form.action = "mypage_interest_ok.php?act=cartadd&goUrl="+goUrl;
	form.submit();
}

//��ٱ��� �̵�
function moveCart(goUrl)
{
	//chek : üũ�ڽ�  intIdx : interest idx 
	var form=document.intForm;
	var selectErr = true;	//��ǰ���� ����
	var cntErr	  = false;	//��ǰ���ż��� ����
	if(form.chek && form.chek.length)
	{
		//���ɻ�ǰ��� 2�̻� 
		for(i=0;i<form.chek.length;i++)
		{
			var cntValue = form.cnt[i].value;
			if(form.chek[i].checked) selectErr=false;//err
			if(form.chek[i].checked &&(cntValue <1)) cntErr =true;	//err
		}
		if(selectErr)
		{
			alert("��ǰ�� ������ �ֽʽÿ�.");
		}
		else if(cntErr)
		{
			alert("���õ� ��ǰ�� ���ż����� �ùٸ��� �ʽ��ϴ�.");
		}
		else
		{
			//��ٱ��� ���
			var goodsCnt =0;
			for(i=0;i<form.chek.length;i++)
			{
				var idxValue = form.intIdx[i].value;
				var cntValue = form.cnt[i].value;
				if(form.chek[i].checked)
				{
					goodsIdxArr[goodsCnt] = idxValue;	//����ǰ�� ���̺� idx
					goodsCntArr[goodsCnt] = cntValue;	//���� ����
					goodsCnt++;
				}
			}
			cartSendit(goUrl);//����
		}
	}
	else if(form.chek)
	{
		//���ɻ�ǰ��� 1��
		var cntValue = form.cnt.value;
		if(form.chek.checked) selectErr=false;//err
		if(form.chek.checked &&(cntValue <1)) cntErr =true;	//err
		if(selectErr)
		{
			alert("��ǰ�� ������ �ֽʽÿ�.");
		}
		else if(cntErr)
		{
			alert("���õ� ��ǰ�� ���ż����� �ùٸ��� �ʽ��ϴ�.");
		}
		else
		{
			//��ٱ��� ���
			goodsIdxArr[0] = form.intIdx.value;	//����ǰ�� ���̺� idx
			goodsCntArr[0] = form.cnt.value;	//���� ����
			cartSendit(goUrl);	//����
		}
	}
	else
	{
		alert("����� ��ǰ�� �����ϴ�.");
	}
}

//����ǰ�� ���� ����
function delSendit()
{
	var form=document.intForm;
	form.idxStr.value = goodsIdxArr.join("����");	//idx ����
	form.action = "mypage_interest_ok.php?act=selectdel";
	form.submit();
}

//����ǰ�� ����
function delInter()
{
	var form=document.intForm;
	var selectErr = true;				//��ǰ���� ����
	if(form.chek && form.chek.length)
	{
		//���ɻ�ǰ��� 2�̻� 
		for(i=0;i<form.chek.length;i++)
		{
			var cntValue = form.cnt[i].value;
			if(form.chek[i].checked) selectErr=false;//err
		}
		if(selectErr)
		{
			alert("��ǰ�� ������ �ֽʽÿ�.");
		}
		else
		{
			//����
			var goodsCnt =0;
			for(i=0;i<form.chek.length;i++)
			{
				var idxValue = form.intIdx[i].value;
				if(form.chek[i].checked)
				{
					goodsIdxArr[goodsCnt] = idxValue;	//����ǰ�� ���̺� idx
					goodsCnt++;
				}
			}
			delSendit();//����
		}
	}
	else if(form.chek)
	{
		//���ɻ�ǰ��� 1��
		var cntValue = form.cnt.value;
		if(form.chek.checked) selectErr=false;//err
		if(selectErr)
		{
			alert("��ǰ�� ������ �ֽʽÿ�.");
		}
		else
		{
			//��ٱ��� ���
			goodsIdxArr[0] = form.intIdx.value;	//����ǰ�� ���̺� idx
			delSendit();	//����
		}
	}
	else
	{
		alert("������ ��ǰ�� �����ϴ�.");
	}
}
//-->
</SCRIPT>
<? include "top.php";?>
<table width="900" border="0" cellspacing="1" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td height="51" valign="top" width="720" bgcolor="#FFFFFF">
			<table width="720" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2">
						<table width="720" height="35" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc5]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc5]?>" rowspan="2"></td>
								<td width="220" height="27" bgcolor="<?=$subdesign[bc5]?>"><img src="./upload/design/<?=$subdesign[img5]?>" ></td>
								<td width="490" height="27" bgcolor="<?=$subdesign[bc5]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc5]?>"> <img src='image/good/icon0.gif'>&nbsp;������ġ : HOME &gt; Mypage(����������)&gt;���ɹ�ǰ ����</font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="720"><br><? include "mypage_menu.php";?><br><br>
						<table border='0' width='670' cellpadding='0' cellspacing='0' align='center'>
							<tr>
								<td><img src='image/member/my_tit4.gif'></td>
							</tr>
						</table>
						<form name="intForm" method="post">
						<input type="hidden" name="idxStr">
						<input type="hidden" name="cntStr">
						<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td><br><br>
									<table width="670" border="0" cellspacing="0" cellpadding="0" height="30" align="center">
										<tr>
											<td bgcolor="80c9d8" height='2' colspan='12'></td>
										</tr>
										<tr>
											<td bgcolor="ffffff" height='1' colspan='12'></td>
										</tr>
										<tr bgcolor="#edf7f9">
											<td width="30" align="center"><input type="checkbox" name="allchek" value="checkbox" onclick="javascript:allCheck();"></td>
											<td width="38" align="center"><font color='006676'><b>��ȣ</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="248" align="center"> <font color='006676'><b>��ǰ��</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="100" align="center"> <font color='006676'><b>�ɼ�</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="76" align="center"> <font color='006676'><b>�� ��</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="44" align="center"> <font color='006676'><b>����</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="56" align="center"><font color='006676'><b>����</b></font></td>
										</tr>
										<tr>
											<td bgcolor="ffffff" height='1' colspan='12'></td>
										</tr>
										<tr>
											<td bgcolor="80c9d8" height='1' colspan='12'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<!-- ���� ��ǰ ��� ���� -->
									<table width="100%" border="0" cellspacing="0" cellpadding="0" height="25" align="center"><?
									$int_qry    = "select *from interest where userid='$_SESSION[GOOD_SHOP_USERID]'";
									$int_result = $MySQL->query($int_qry);
									$interest_goods_cnt = $MySQL->is_affected();	//���� ��ǰ ����
									$int_cnt =0;		//�� ī��Ʈ
									while($int_row = mysql_fetch_array($int_result))
									{
										$goods_row = $MySQL->fetch_array("select *from goods where idx=$int_row[goodsIdx]"); //��ǰ����
										//�̹������
										if($goods_row[bHit]) $bHit ="<img src='admin/image/hit.gif'>";
										else				 $bHit ="";
										if ($admin_row[bNew])  $bNew = limitday($goods_row[writeday],$admin_row[new_day]);
										if($goods_row[bEtc]) $bEtc ="<img src='./upload/goods_etc_img' >";
										else				 $bEtc ="";
										$optionArr = Array("$int_row[option1]","$int_row[option2]","$int_row[option3]");   //�ɼ� �迭
										if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
										else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
										else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
										else $img_str = $goods_row[img1];
										?>
										<tr>
											<td width="30" height="25" align="center"> <input type="checkbox" name="chek" value="checkbox" ><input type="hidden" name="intIdx" value="<?=$int_row[idx]?>"></td>
											<td width="38" height="25" align="center"><?=$interest_goods_cnt?></td>
											<td width="45" height="25" align="center"><img src="upload/goods/<?=$img_str?>" width="45" height="45"></td>
											<td width="203" height="25" align="center"><a href="goods_detail.php?goodsIdx=<?=$goods_row[idx]?>"><?=$goods_row[name]?></a> <?=$bHit?> <?=$bNew?> <?=$bEtc?></td>
											<td width="100" height="25" align="center">
												<table width="100" border="0" cellspacing="0" cellpadding="0"><?
												for($i=0;$i<count($optionArr);$i++)
												{
													if(!empty($optionArr[$i]))
													{
														$option = explode("����",$optionArr[$i]);
														?>
													<tr>
														<td width="45"  bgcolor="#F7F7F7"> <div align="center"><?=$option[0]?> </div></td>
														<td   bgcolor="#DDFFFB"> <div align="left"> : <?=$option[1]?></div></td>
													</tr>
													<tr  bgcolor="#CCCCCC">
														<td colspan="2" height="1"></td>
													</tr><?
													}
												}
												?>
												</table>
											</td>
											<td width="76" height="25" align="center"><font color="ff0000"><?=PriceFormat($int_row[price])?> ��</font> </td>
											<td width="44" height="25" align="center"> <input type="text" name="cnt" size="2" value="1" <?=__ONLY_NUM?>></td>
											<td width="56" height="25" align="center"> <a href="mypage_interest_ok.php?act=del&intIdx=<?=$int_row[idx]?>"><img src="image/icon/btn_delete0.gif" border="0"></td>
										</tr>
										<tr>
											<td colspan="8" height="1" bgcolor='e1e1e1'></td>
										</tr><?
										$int_cnt ++;
										$interest_goods_cnt --;
									}
									?>
									</table>
									<!-- ���� ��ǰ ��� �� -->
								</td>
							</tr>
							<tr>
								<td height="30"><br>
									<table width="400" border="0" cellspacing="2" cellpadding="0" align="center">
										<tr align="center">
											<td><a href="javascript:moveCart('cart');"><img src="image/icon/cart_btn.gif" border="0"></a></td>
											<td><a href="javascript:moveCart('order');"><img src="image/icon/order_btn.gif" border="0"></a></td>
											<td><a href="javascript:delInter();"><img src="image/icon/delete.gif" border="0"></a></td>
											<td><a href="index.php"><img src="image/icon/shopping_continue_btn.gif" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</form><!-- intForm -->
						<br><br><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php"; ?>
</div>
</body>
</html>