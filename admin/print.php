<?
// �ҽ��������
// 20060720-1 �ҽ����� �輺ȣ : ������� ���� ����ȭ(ī��, �ڵ���, ������ü, �������, ������)
include "head.php";
echo "<script>window.print();</script>";
?>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td bgcolor="#FFFFFF">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><?
				$dataArr = Decode64($data);
				$trade_row = $MySQL->fetch_array("select *from trade where idx=$date");
				if($trade_row[payMethod] =="card") $payMethod="<B>ī�����</B> [".$trade_row[bankInfo]."]";
				elseif($trade_row[payMethod] =="hand") $payMethod="<B>�޴���</B> [".$trade_row[bankInfo]."]";
				elseif($trade_row[payMethod] =="iche") $payMethod="<B>������ü</B> [".$trade_row[bankInfo]."]";
				elseif($trade_row[payMethod] =="cyber") $payMethod="<B>�������</B> [".$trade_row[bankInfo]."]";
				elseif($trade_row[payMethod] =="bank") $payMethod="<B>������</B> [".$trade_row[bankInfo]."]";
				$content	= str_replace("\n","<br>", $trade_row[content]); //���Ҹ�
				$tel=explode("-",$trade_row[tel]);
				$hand=explode("-",$trade_row[hand]);
				$zip=explode("-",$trade_row[zip]);
				$rtel=explode("-",$trade_row[rtel]);
				$rhand=explode("-",$trade_row[rhand]);
				$rzip=explode("-",$trade_row[rzip]);
				?>
					<td width="598" valign="top">
						<table width="594" height="500" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td>
												<table width=100%>
													<tr>
														<td valign="top" align="left" width="300">
															<table width="100%" border="1" cellspacing="0" cellpadding="3">
																<tr>
																	<td bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" height="31" width="130"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� �� �� ȣ</div></td>
																	<td height="25" width="130"> <div align="center"><font size=2><B><?=$trade_row[tradecode]?></B></font></div></td>
																</tr>
																<tr>
																	<td width="200" background="image/bbs_tit_bg.jpg" height="31"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� �� �� �� ��</div></td>
																	<td width="200" height="25" bgcolor="fafafa"> <div align="center"><?=$trade_row[writeday]?></div></td>
																</tr>
																<tr>
																	<td background="image/bbs_tit_bg.jpg" width="200" height="31"> <img src="image/icon.gif" width="11" height="11"> �ֹ��� ���̵�/�̸� </td>
																	<td height="25" width="200"> <div align="center"><B><?=$trade_row[userid]?> / <?=$trade_row[name]?></B></div></td>
																</tr>
															</table>
														</td>
														<td width="300" valign=top>
															<table width="100%" border="0" cellspacing="0" cellpadding="3">
																<tr valign="middle">
																	<td valign="top">
																		<table width="300" border="1" cellspacing="0" cellpadding="2"><?
																		$pay_price = $trade_row[totalM];
																		?>
																			<tr>
																				<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� ��ǰ �ݾ�</div></td>
																				<td height="25" bgcolor="fafafa" width="150">
																					<table width="150" border="0" cellspacing="0" cellpadding="0">
																						<tr>
																							<td width="30">&nbsp;</td>
																							<td><font color="#FF0000"><b><?=PriceFormat($pay_price)?> ��</b></font></td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ���� ���</div></td>
																				<td height="25" bgcolor="fafafa" width="150">
																					<table width="150" border="0" cellspacing="0" cellpadding="0">
																						<tr>
																							<td width="30">&nbsp;</td>
																							<td><?=$payMethod?></td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="25" width="144" bgcolor='f7f7f7'> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��� ������</div></td>
																				<td height="25" width="150">
																					<table width="150" border="0" cellspacing="0" cellpadding="0">
																						<tr>
																							<td width="30">&nbsp;</td>
																							<td><?=PriceFormat($trade_row[useP])?> ��</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="1" colspan="2" background="image/line_bg1.gif"> </td>
																			</tr>
																			<tr>
																				<td height="25" width="144" bgcolor='f7f7f7'> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ۺ�</div></td>
																				<td height="25" width="150">
																					<table width="150" border="0" cellspacing="0" cellpadding="0">
																						<tr>
																							<td width="30">&nbsp;</td>
																							<td><?=PriceFormat($trade_row[transM])?> ��</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="1" colspan="2" background="image/line_bg1.gif"> </td>
																			</tr>
																			<tr>
																				<td height="25" width="144"  bgcolor='f7f7f7'> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� ���� �ݾ�</div></td>
																				<td height="25"  width="150">
																					<table width="150" border="0" cellspacing="0" cellpadding="0">
																						<tr>
																							<td width="30">&nbsp;</td>
																							<td><font color="#FF0000"><b><?=PriceFormat($trade_row[payM])?> ��</b></font></td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="1" colspan="2" background="image/line_bg1.gif"> </td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="20"><img src="image/order_view_m1.gif" > </td>
										</tr>
										<tr>
											<td></td>
										</tr>
										<tr valign="middle">
											<td valign="top">
												<table width="640" border="1" cellspacing="0" cellpadding="0">
													<tr>
														<td height="25" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ǰ��</div></td>
														<td height="25" background="image/bbs_tit_bg.jpg" width="80"> <div align="center"><img src="image/icon.gif" width="11" height="11"> <FONT COLOR="#993300">����</FONT>/<FONT COLOR="#6633FF">����</FONT></div></td>
														<td height="25" background="image/bbs_tit_bg.jpg" width="120"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �ɼ�</div></td>
														<td height="25" background="image/bbs_tit_bg.jpg" width="70"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �հ�(��)</div></td>
														<td height="25" background="image/bbs_tit_bg.jpg" width="100"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �������</div></td>
														<td height="25" background="image/bbs_tit_bg.jpg" width="80"> <div align="center"><img src="image/icon.gif" width="11" height="11" colspan="2"> �ŷ�����</div></td>
													</tr><?
													$trade_goods_qry ="select *from trade_goods where tradecode='$trade_row[tradecode]' $MALL_STR order by goodsIdx asc";
													$trade_goods_result = $MySQL->query($trade_goods_qry);
													$formCnt =0;
													while($trade_goods_row = mysql_fetch_array($trade_goods_result))
													{
														$formCnt++;
														$top =$formCnt*60-280;
														$goods_qry    = "select *from goods where idx=$trade_goods_row[goodsIdx]";
														$goods_result = $MySQL->query($goods_qry);
														$goodsChek    = $MySQL->is_affected();
														$goods_row    = mysql_fetch_array($goods_result);	//��ǰ����
														$optionArr = Array("$trade_goods_row[option1]","$trade_goods_row[option2]","$trade_goods_row[option3]"); //�ɼ� �迭
														$tprice = $trade_goods_row[price]*$trade_goods_row[cnt]; //��ǰ�հ��� 
														$sday1= $trade_goods_row[sday1]; if(empty($sday1)) $sday1="���� ����";
														$sday2= $trade_goods_row[sday2]; if(empty($sday2)) $sday2="���� ����";
														$sday3= $trade_goods_row[sday3]; if(empty($sday3)) $sday3="���� ����";
														$sday4= $trade_goods_row[sday4]; if(empty($sday4)) $sday4="���� ����";
														$sday5= $trade_goods_row[sday5]; if(empty($sday5)) $sday5="���� ����";
														$sday6= $trade_goods_row[sday6]; if(empty($sday6)) $sday6="���� ����";
														if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
														else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
														else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
														else $img_str = $goods_row[img1];
														?>
													<tr>
														<td  bgcolor="fafafa" valign="middle"><div align="center"><img src="../upload/goods/<?=$img_str?>" width="50" height="50" align="middle" ><br><?=$goods_row[name]?></div></td>
														<td bgcolor="fafafa" width="80"> <div align="center"><FONT COLOR="#993300"><?=PriceFormat($trade_goods_row[price])?></font><br><FONT COLOR="#6633FF"><?=$trade_goods_row[cnt]?></font></div></td>
														<td  bgcolor="fafafa">
															<table width="100%" border="0" cellspacing="0" cellpadding="0"><?
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
															</table></div>
														</td>
														<td  bgcolor="fafafa" width="70"> <div align="right"><FONT COLOR="#990000"><?=PriceFormat($tprice)?></FONT></div></td>
														<td  bgcolor="fafafa" onMouseOut="MM_showHideLayers('Layer<?=$formCnt?>','','hide')" onMouseOver="MM_showHideLayers('Layer<?=$formCnt?>','','show')" > <div align="center"><FONT COLOR="#990000">��ۻ�</FONT><br><?=$trade_goods_row[trans_company]?><br><FONT COLOR="#990000">�����ȣ</FONT><br><?=$trade_goods_row[trans_num]?></div></td>
														<td  width="79" <? if ($trade_goods_row[status]>3) echo "bgcolor='pink'"; else echo "bgcolor='#fafafa'";?>><div align="center"><?=$TRADE_ARR[$trade_goods_row[status]]?></div></td>
													</tr><?
													}
													?>
												</table>
											</td>
										</tr>
										<tr valign="middle">
											<td valign="top" height="10">&nbsp;</td>
										</tr>
										<tr valign="middle">
											<td valign="top"><img src="image/order_view_m3.gif"> </td>
										</tr>
										<form name="tradeForm" method="post" action="trade_order_view_ok.php">
										<input type="hidden" value="<?=$data?>" name="data">
										<tr valign="middle">
											<td valign="top">
												<table width="640" border="1" cellspacing="0" cellpadding="2">
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[name]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ȭ��ȣ</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$tel[0]?> - <?=$tel[1]?> -<?=$tel[2]?>&nbsp;&nbsp;&nbsp;<?=$hand[0]?> - <?=$hand[1]?> - <?=$hand[2]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �����ȣ</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$zip[0]?> - <?=$zip[1]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[adr1]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� �ּ�</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[adr2]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> E-mail </div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[email]?></td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr valign="middle">
											<td valign="top" height="10">&nbsp;</td>
										</tr>
										<tr valign="middle">
											<td valign="top"><img src="image/order_view_m4.gif" > </td>
										</tr>
										<tr valign="middle">
											<td valign="top">
												<table width="640" border="1" cellspacing="0" cellpadding="2">
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[rname]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ȭ��ȣ</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$rtel[0]?> - <?=$rtel[1]?> - <?=$rtel[2]?>&nbsp;&nbsp;&nbsp;<?=$rhand[0]?> - <?=$rhand[1]?> - <?=$rhand[2]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �����ȣ</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$rzip[0]?> - <?=$rzip[1]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[radr1]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td height="25" width="144" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �� �ּ�</div></td>
														<td height="25" bgcolor="fafafa" width="401">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[radr2]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td width="150" height="25" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ���Ҹ�</div></td>
														<td bgcolor="fafafa">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[content]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td width="150" height="25" background="image/bbs_tit_bg.jpg"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �ֹ�����</div></td>
														<td bgcolor="fafafa">
															<table width="400" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="30">&nbsp;</td>
																	<td><?=$trade_row[manaContent]?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="2" height="1" background="image/line_bg1.gif"> </td>
													</tr>
												</table>
											</td>
										</tr></form>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>