<?
include "head.php";
// ��ҹ�ư Ŭ����
if ($orderCancel=="y")
{
	$MySQL->query("DELETE from trade_goods WHERE tradecode='$tradecode'");
	$MySQL->query("DELETE from trade WHERE tradecode='$tradecode'");
	$MySQL->query("DELETE from cart WHERE userid='$GOOD_SHOP_USERID'");
	Refresh("index.php");
	exit;
}
if($act =="edit")
{
	// ��ٱ��� ����
	$cart_row = $MySQL->fetch_array("select * from cart where idx=$cartIdx");
	$new_point = ($cart_row[point]/$cart_row[cnt]) * $cnt;
	$edit_qry = "update cart set cnt = $cnt,point=$new_point where idx=$cartIdx";
	if($MySQL->query($edit_qry)){}
	else echo"Err. : $edit_qry";
}
else if($act =="del")
{
	//��ٱ��� ����
	$del_qry = "delete from cart  where idx=$cartIdx";
	if($MySQL->query($del_qry)){}
	else echo"Err. : $del_qry";
}
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");//����������
}
if($admin_row[bUsepoint] && $_SESSION[GOOD_SHOP_PART] =="member")
{
	$__TNAME_TD_WIDTH =147;
}
else
{
	$__TNAME_TD_WIDTH =214;
}
if($_SESSION[GOOD_SHOP_PART] =="member")
{
	$member_row = $MySQL->fetch_array("select * from member where userid='$GOOD_SHOP_USERID'");
	$tel	= explode("-",$member_row[tel]);
	$hand	= explode("-",$member_row[hand]);
	$zip	= explode("-",$member_row[zip]);
	$ceo_zip= explode("-",$member_row[ceo_zip]);
}

//�ֹ��ڵ� ����
srand(time());
$time = substr(time(),5,5);
for($i=0;$i<3;$i++)
{
	$asc=rand()%26+65;
	$c.=chr($asc);
}
$iparr = explode(".",$REMOTE_ADDR);
$tradecode=$c.$time.$iparr[3];
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//�����ȣ ã��
function searchZip(po)
{
	window.open("search_post.php?po="+po,"","scrollbars=yes,width=490,height=200,left=250,top=250");
}

//����� ����
function infoEqual()
{
	var form=document.orderForm;
	if(form.eql.checked)
	{
		//�ֹ���,����� ����
		form.rname.value	=form.name.value;
		form.remail.value	=form.email.value;
		form.rtel1.value	=form.tel1.value;
		form.rtel2.value	=form.tel2.value;
		form.rtel3.value	=form.tel3.value;
		form.rhand1.value	=form.hand1.value;
		form.rhand2.value	=form.hand2.value;
		form.rhand3.value	=form.hand3.value;
		form.rzip1.value	=form.zip1.value;
		form.rzip2.value	=form.zip2.value;
		form.radr1.value	=form.adr1.value;
		form.radr2.value	=form.adr2.value;
	}
	else
	{
		form.rname.value	="";
		form.remail.value	="";
		form.rtel1.value	="";
		form.rtel2.value	="";
		form.rtel3.value	="";
		form.rhand1.value	="";
		form.rhand2.value	="";
		form.rhand3.value	="";
		form.rzip1.value	="";
		form.rzip2.value	="";
		form.radr1.value	="";
		form.radr2.value	="";
	}
}
//��������
function tradeSendit(str,str2)
{
	var form=document.orderForm;
	if(form.name.value =="")
	{
		alert("�ֹ��ڸ��� �Է��� �ֽʽÿ�.");
		form.name.focus();
	}
	else if(form.zip1.value=="")
	{
		alert("�ּҸ� �Է��� �ֽʽÿ�.");
		searchZip(1);
	}
	else if(form.rname.value =="")
	{
		alert("�޴��̸��� �Է��� �ֽʽÿ�.");
		form.rname.focus();
	}
	else if(form.rzip1.value=="")
	{
		alert("����� �ּҸ� �Է��� �ֽʽÿ�.");
		searchZip(2);
	}
	else if(str ==1)
	{
		// ���ǰ��
		var tell = "�˼��մϴ�. ("+str2+") ��ǰ�� ������ ��� �������� ���ŵǾ����ϴ�."
		alert(tell); 
		location.href="cart.php";
	}
	else if(str ==2)
	{
		// ����ʰ� 
		var tell = "�˼��մϴ�. ("+str2+") "
		alert(tell); 
		location.href="cart.php";
	}
	else
	{
		form.submit();
	}
}
//��ٱ��� ����
function cartEdit(Obj,bLimit,limitCnt,minbuyCnt,maxbuyCnt)
{
	var Cnt = Obj.cnt.value;
	if(Cnt=="" || Cnt=="0" ||Cnt==0 || !numCheck(Cnt))
	{
		alert("���ż����� �ùٸ��� �ʽ��ϴ�.");
		Obj.cnt.focus();
	}
	else if(bLimit && Cnt > limitCnt)
	{
		alert("�˼��մϴ�. �������� �����մϴ�.\n\n��� : "+limitCnt);
		Obj.cnt.focus();
	}
	else if(minbuyCnt!=0 && Cnt<minbuyCnt)
	{
		alert("�� ��ǰ�� �ּұ��ż����� "+minbuyCnt+ " �� �Դϴ�.");
		Obj.cnt.value = minbuyCnt;
		Obj.cnt.focus();
	}
	else if(maxbuyCnt!=0 && Cnt>maxbuyCnt)
	{
		alert("�� ��ǰ�� �ִ뱸�ż����� "+maxbuyCnt+ " �� �Դϴ�.");
		Obj.cnt.value = maxbuyCnt;
		Obj.cnt.focus();
	}
	else
	{
		Obj.action = "order_sheet.php?act=edit";
		Obj.submit();
	}
}
//��ٱ��� ����
function cartDel(Obj)
{
	Obj.action = "order_sheet.php?act=del";
	Obj.submit();
}
function searchZip_ceo()
{
	window.open("search_post_ceo.php?form=orderForm","","scrollbars=yes,width=490,height=200,left=250,top=250");
}
//-->
</SCRIPT>
<? include "top.php";?>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td valign="top" width="720" bgcolor="#FFFFFF">
			<table width="720" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2">
						<table width="720" height="30" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc7]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc7]?>" rowspan="2"></td>
								<td width="220" height="30" bgcolor="<?=$subdesign[bc7]?>"><img src="./upload/design/<?=$subdesign[img7]?>" ></td>
								<td height="30" bgcolor="<?=$subdesign[bc7]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc7]?>"> <img src='image/good/icon0.gif'>&nbsp;������ġ : HOME &gt; �ֹ�����</font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="720">
						<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td><?
								if ($subdesign[titimg7])
								{
									?><img src="./upload/design/<?=$subdesign[titimg7]?>" ><?
								}
								else
								{
									?><img src="image/work/order_tit.gif" ><?
								}
								?></td>
							</tr>
							<tr>
								<td align='center'><img src="image/sub/order_02.gif"></td>
							</tr>
						</table>
						<br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height='2' bgcolor='80c9d8'></td>
							</tr>
							<tr>
								<td>
									<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr bgcolor="edf7f9" height="30">
											<td height='25' width="40" align="center"><font color='006676'><b>��ȣ</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="<?=$__TNAME_TD_WIDTH?>" align="center"><font color='006676'><b>��ǰ��</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="130" align="center"><font color='006676'><b>�ɼ�</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="70" align="center"><font color='006676'><b>���԰�</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<?
											if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
											{
												?>
											<td width="66" align="center"><font color='006676'><b>������</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td><?
											}
											?>
											<td width="70" align="center"><font color='006676'><b>����</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="80" align="center"><font color='006676'><b>�հ� (��)</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="60" align="center"><font color='006676'><b>����</b></font></td>
										</tr>
										<tr>
											<td colspan='15' height='1' bgcolor='80c9d8'></td>
										</tr><?
										$cart_qry		 = "select * from cart where userid='$GOOD_SHOP_USERID' order by goodsIdx desc";
										$cart_result	 = $MySQL->query($cart_qry);
										$cart_goods_cnt = $MySQL->is_affected();
										$cart_cnt = 0;
										$total_price = 0;
										while($cart_row = mysql_fetch_array($cart_result))
										{
											$goods_row = $MySQL->fetch_array("select *from goods where idx=$cart_row[goodsIdx]"); //��ǰ����
											$gprice = new CGoodsPrice($goods_row[idx]);
											if ($admin_row[bNew])
											{
												$bNew = limitday($goods_row[writeday],$admin_row[new_day]);
												if (empty($bNew) && $goods_row[bNew]) $bNew = "<img src='upload/goods_new_img'>";
											}
											$bHit =$goods_row[bHit]?"<img src='./upload/goods_hit_img'>":"";	// ��Ʈ �̹���
											$bEtc =$goods_row[bEtc]?"<img src='./upload/goods_etc_img'>":"";	// ��Ÿ �̹���
											$optionArr = Array("$cart_row[option1]","$cart_row[option2]","$cart_row[option3]");	//�ɼ� �迭
											$tprice	   = $cart_row[cnt] * $cart_row[price];	// ���Ű��� : ��ǰ����X��ǰ����
											$code_array = $goods_row[code].",".$code_array;	// ����ǰ �ڵ��Է� 11.18 
											if ($goods_row[bLimit]==1)
											{
												if (empty($goods_row[limitCnt]))
												{
													$limit = 1;	// ǰ���̸� 1
													$limit_good = $goods_row[name];
												}
												else if ($goods_row[limitCnt] < $cart_row[cnt])	// ǰ���� �ƴѵ� ���ż����� �������� �Ѿ��
												{
													$limit = 2; // ����ʰ��̸� 2 
													$over_cnt = $cart_row[cnt] - $goods_row[limitCnt];
													$limit_good = $goods_row[name]."��ǰ�� ��� $over_cnt �� �ʰ��Ͽ����ϴ�.";
												}
											}
											else if ($goods_row[bLimit]>1)
											{
												$limit = $goods_row[bLimit]; // ����ǰ�� 2, ���� 3 , ���� 4 
												$limit_good = "��ǰ�� ���� �Ǵ� ������ �����Դϴ�.";
											}
											$bLimit	   = $goods_row[bLimit];
											$limitCnt  = $goods_row[limitCnt];
											if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
											else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
											else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
											else $img_str = $goods_row[img1];
											?>
										<form name="cartForm<?=$cart_cnt?>" method="post">
										<input type="hidden" name="cartIdx" value="<?=$cart_row[idx]?>"><!-- ��ٱ��� idx ��ȣ -->
										<tr>
											<td height="25" align="center"><?=$cart_goods_cnt?></td>
											<td width='1'></td>
											<td align="left" valign="middle">
												<table>
													<tr>
														<td><img src="./upload/goods/<?=$img_str?>" width="40" height="40"></td>
														<td><?=$goods_row[name]?> <?=$bHit?> <?=$bNew?> <?=$bEtc?></td>
													</tr>
												</table>
											</td>
											<td width='1'></td>
											<td align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0"><?
												for($i=0;$i<count($optionArr);$i++)
												{
													if(!empty($optionArr[$i]))
													{
														$option = explode("����",$optionArr[$i]);
														?>
													<tr>
														<td width="40%"  bgcolor="#F7F7F7"> <div align="center"><?=$option[0]?> </div></td>
														<td width="60%" bgcolor="#DDFFFB"> <div align="left"> : <?=$option[1]?></div></td>
													</tr>
													<tr  bgcolor="#CCCCCC">
														<td colspan="2" height="1"></td>
													</tr><?
													}
												}
												?>
												</table>
											</td>
											<td width='1'></td>
											<td height="25" align="right"><?=$gprice->PutPrice();?>&nbsp;</td>
											<td width='1'></td><?
											if($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member")
											{
												?>
											<td height="25" align="right"><?=PriceFormat($cart_row[point])?>&nbsp;</td>
											<td width='1'></td><?
											}
											?>
											<td height="25" align="center"><input type="text" name="cnt" size="2" value="<?=$cart_row[cnt]?>"> ��<br><a href="javascript:cartEdit(document.cartForm<?=$cart_cnt?>,<?=$bLimit?>,<?=$limitCnt?>,<?=$goods_row[minbuyCnt]?>,<?=$goods_row[maxbuyCnt]?>);"><img src="image/icon/edit_btn.gif" border="0"></a></td>
											<td width='1'></td>
											<td height="25" align="right"> <FONT COLOR="#990000"><?=PriceFormat($tprice)?></FONT>&nbsp;</td>
											<td width='1'></td>
											<td height="25" align="center"><a href="javascript:cartDel(document.cartForm<?=$cart_cnt?>);"><img src="image/icon/btn_delete0.gif" border="0"></a></td>
										</tr>
										<tr>
											<td colspan="15" height="1" bgcolor='e1e1e1'></td>
										</tr>
										</form><?
											$total_price +=$tprice;	// �ѱ��Ű���
											$tprice_array = $tprice.",".$tprice_array;	// �ֹ����̺� �� ���ݵ� ,�� ���� �и�  
											$cart_goods_cnt --;
											$cart_cnt ++;
										}
										?>
									</table>
								</td>
							</tr>
							<tr>
								<td height="30" colspan="15">
									<table width="670" border="0" cellspacing="1" cellpadding="0" bgcolor="#ffffff" align="center">
										<tr>
											<td bgcolor="fafafa" height="30" align="right">&nbsp;&nbsp;<B>��ǰ�հ�</B> : <b><font color="#FF0000"><?=PriceFormat($total_price)?>��</font></b></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br><br>
			<table width="670" border="0" cellspacing="0" cellpadding="0" align="center"><?
			if(empty($admin_row[bTrans]) && empty($admin_row[chakbul]))	// ��ۺ�̻��
			{
				$transM = 0;
				$transMstr = "����";
			}
			else if(empty($admin_row[bTrans]) && $admin_row[chakbul])	//��ۺ�̻��&���� 
			{
				$transM = 0;
				$transMstr = "����";
			}
			else
			{
				if($admin_row[noTrans] <=$total_price)
				{
					$transM = 0;
					$transMstr=PriceFormat($transM)." ��";
				}
				else	//��ۺ񹫷� ����ݾ�
				{
					$transM = $admin_row[transMoney];
					$transMstr=PriceFormat($transM)." ��";
				}
				//��ۺ�����
			}
			if ($MySQL->articles("SELECT idx from cart WHERE userid='$_SESSION[GOOD_SHOP_USERID]'")==1) // ��ٱ��Ͽ� ��ǰ�� 1���϶� 
			{
				$cart_row = $MySQL->fetch_array("SELECT goodsIdx from cart WHERE userid='$_SESSION[GOOD_SHOP_USERID]' limit 1");
				$goods_row = $MySQL->fetch_array("SELECT size from goods WHERE idx=$cart_row[goodsIdx] limit 1");
				if ($goods_row[size]=="n") //������ ��ǰ�̸� 
				{
					$transM = 0;
					$transMstr=PriceFormat($transM)." ��";
				}
			}
			if (!$transMstr) $transMstr=PriceFormat($transM)." ��";
			?>
				<tr>
					<td height="30" colspan="7">
						<table width="670" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td bgcolor="fafafa" height="30" align="right">[ ��ۺ� : <font color="#FF0000"><?=$transMstr?></font> ] &nbsp;&nbsp; <B>�����ݾ�</B> : <b><font color="#FF0000"><?=PriceFormat($total_price+$transM)?>��</font></b></td>
							</tr>
						</table>
					</td>
				</tr>
			</table><br>
			<form name="orderForm" method="post" action="order_table.php">
			<input type="hidden" name="tprice_array" value="<?=$tprice_array?>">
			<input type="hidden" name="code_array" value="<?=$code_array?>">
			<input type="hidden" name="transM_array" value="<?=$transM_array?>">
			<input type="hidden" name="city" value="<?=$member_row[city]?>">
			<input type="hidden" name="tradecode" value="<?=$tradecode?>">
			<input type="hidden" name="channel" value="<?=$channel?>"><!--ex)cart:��ٱ��Ͽ������� direct:�ٷα����ϱ� -->
			<!-- �ֹ��� ���� ���� -->
			<table width="670" border="0" cellspacing="1" cellpadding="10" valign="top" align='center' bgcolor='dadada'>
				<tr>
					<td bgcolor='ffffff'>
						<table width="650" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td height="2" colspan="2" bgcolor="#e1e1e1"></td>
							</tr>
							<tr>
								<td height="30" colspan="2" bgcolor="#f4f4f4">&nbsp;&nbsp;<b>�ֹ�������</b></td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor="#e1e1e1"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA"> &nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>���̵�</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <?
								if($GOOD_SHOP_PART=="member")
								{
									?><FONT  COLOR="#4D4095"><?=$GOOD_SHOP_USERID?></FONT><?
								}
								else
								{
									?><FONT  COLOR="#8000FF">GUEST</FONT><?
								}
								?></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�� ��</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="name" size="10" value="<?=$member_row[name]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�� �� ��</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="email" size="30"  value="<?=$member_row[email]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>��ȭ��ȣ</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="tel1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$tel[0]?>"> - <input class="box" type="text" name="tel2" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$tel[1]?>"> - <input class="box" type="text" name="tel3" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$tel[2]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�޴�����ȣ</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="hand1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$hand[0]?>"> - <input class="box" type="text" name="hand2" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$hand[1]?>"> - <input class="box" type="text" name="hand3" size="4" maxlength="4" <?=__ONLY_NUM?> value="<?=$hand[2]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�����ȣ</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="zip1" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$zip[0]?>"> - <input class="box" type="text" name="zip2" size="3" maxlength="3" <?=__ONLY_NUM?> value="<?=$zip[1]?>"> <a href="javascript:searchZip(1);"><img src="image/icon/post_search.gif" border="0" align="absmiddle"></a></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�� ��</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="adr1" size="50"  value="<?=$member_row[address1]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�� �� �� ��</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="adr2" size="50"  value="<?=$member_row[address2]?>"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br><br>
			<table width="670" border="0" cellspacing="1" cellpadding="10" valign="top" align='center' bgcolor='dadada'>
				<tr>
					<td bgcolor='ffffff'>
						<table width="650" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td height="2" colspan="2" bgcolor="e1e1e1"></td>
							</tr>
							<tr>
								<td height="30" colspan="2" bgcolor="#F4F4F4">&nbsp;&nbsp;<b>������ ����</b> <input  type="checkbox" name="eql" value="checkbox" onClick="javascript:infoEqual();"> (�ֹ��� ������ ������)</td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor="e1e1e1"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�� ��</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="rname" size="10"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�� �� ��</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="remail" size="30"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>��ȭ��ȣ</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="rtel1" size="3" maxlength="3" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rtel2" size="4" maxlength="4" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rtel3" size="4" maxlength="4" <?=__ONLY_NUM?>></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�޴���ȭ</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="rhand1" size="3" maxlength="3" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rhand2" size="4" maxlength="4" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rhand3" size="4" maxlength="4" <?=__ONLY_NUM?>></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�����ȣ</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="rzip1" size="3" maxlength="3" <?=__ONLY_NUM?>> - <input class="box" type="text" name="rzip2" size="3" maxlength="3" <?=__ONLY_NUM?>> <a href="javascript:searchZip(2);"><img src="image/icon/post_search.gif" border="0" align="absmiddle"></a></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�� ��</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="radr1" size="50"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>�� �� �� ��</font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <input class="box" type="text" name="radr2" size="50"></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
							<tr>
								<td height="25" width="104" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src='image/mem_icon.gif'>&nbsp;<font class='mem'>���Ҹ�</font></font></td>
								<td height="25" width="496"> &nbsp;&nbsp; <textarea name="content" cols="70" rows="4"  class="text"></textarea></td>
							</tr>
							<tr>
								<td height="1" colspan="2" background="image/index/dot_width.gif"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form><!-- orderForm --><br>
			<table width="150" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr align="center">
					<td><a href="javascript:tradeSendit('<?=$limit?>','<?=$limit_good?>');"><img src="image/icon/ok2_btn.gif" border="0"></a></td>
					<td><a href="order_table.php?orderCancel=y&tradecode=<?=$tradecode?>"><img src="image/icon/cancel_lag.gif" border="0"></a></td>
				</tr>
			</table><br>
		</td>
	</tr>
</table>
<? include "copy.php"; ?>
</div>
</body>
</html>