<?
// �ҽ��������
// 20060720-1 �ҽ����� �輺ȣ : ������� ���� ����ȭ(ī��, �ڵ���, ������ü, �������, ������)
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
// ȸ���� ��ۿϷ� ó��
function trans_comple(tradecode)
{
	var form = document.form1;
	var form2 = document.form2;
	var good_arr = new Array();
	var comment_arr = new Array();
	var good_str = "";
	var comment_str = "";
	if (confirm("�� �ֹ��� ��ۿϷ� ó���Ͻðڽ��ϱ�?"))
	{
		form.tradecode.value = tradecode;	
		num = form2.elements["goodsIdx"].length;
		// ��ǰ�� �������϶� 
		if (num>1)
		{
			for (var i=0; i<num; i++)
			{
				good_arr[i] = form2.goodsIdx[i].value;
				comment_arr[i] = form2.comment[i].value;
				if (comment_arr[i]=="")
				{
					alert("��ǰ���� �����ֽø� �����ϰڽ��ϴ�.");
					form2.comment[i].focus();
					return false;
				}
			}
			good_str = good_arr.join("//");
			comment_str = comment_arr.join("//");
		}
		else
		{
			good_str = form2.goodsIdx.value;
			comment_str = form2.comment.value;
			if (comment_str=="")
			{
				alert("��ǰ���� �����ֽø� �����ϰڽ��ϴ�.");
				form2.comment.focus();
				return false;
			}
		}
		form.good_str.value = good_str;
		form.comment_str.value = comment_str;
		form.submit();
	}
}
function trade_cancel(tradecode)
{
	if (confirm("�� �ֹ��� ����Ͻðڽ��ϱ�?"))
	{
		var form = document.form1;
		form.tradecode.value = tradecode;
		form.cancel.value = "y";
		form.submit();
	}
	else
	{
	}
}
//-->
</SCRIPT>
<? include "top.php";?>
<form name="form1" action="mypage_order_status.php" method="post">
<input type="hidden" name="tradecode" value="">
<input type="hidden" name="guest" value="y">
<input type="hidden" name="good_str" value="">
<input type="hidden" name="comment_str" value="">
<input type="hidden" name="cancel" value="">
</form>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td height="51" valign="top" width="720" bgcolor="#FFFFFF">
			<table width="720" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2" height="51">
						<table width="720" height="35" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc7]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc7]?>" rowspan="2"></td>
								<td width="220" height="27" bgcolor="<?=$subdesign[bc7]?>"><img src="./upload/design/<?=$subdesign[img7]?>" ></td>
								<td width="490" height="27" bgcolor="<?=$subdesign[bc7]?>"><div align="right">&nbsp;<font color="<?=$subdesign[tc7]?>"> &nbsp; ������ġ : HOME &gt; �ֹ�������ȸ</font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td><img src='image/sub/img_order.gif'></td>
							</tr>
						</table>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td>
									<table width="670" border="0" cellspacing="0" cellpadding="0" height="25" align="center">
										<tr>
											<td colspan='11' bgcolor='80c9d8' height='2'></td>
										</tr>
										<tr>
											<td colspan='11' bgcolor='ffffff' height='1'></td>
										</tr>
										<tr bgcolor="edf7f9" align="center" height='30'>
											<td width="240"><font color='006676'><b>��ǰ��</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="100" align="center"><font color='006676'><b>�ɼ�</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="100" align="center"><font color='006676'><b>���԰�</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="38" align="center"><font color='006676'><b>����</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="76" align="center"><font color='006676'><b>�հ�</b></font></td>
											<td width='1'><img src='image/board/line.gif'></td>
											<td width="80" align="center"><font color='006676'><b>�ֹ�����</b></font></td>
										</tr>
										<tr>
											<td colspan='11' bgcolor='ffffff' height='1'></td>
										</tr>
										<tr>
											<td colspan='11' bgcolor='80c9d8' height='1'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<table width="670" border="0" cellspacing="0" cellpadding="0" height="25" align="center"><?
									$trade_row = $MySQL->fetch_array("select *from trade where tradecode='$tradecode'");
									if($trade_row[payMethod] =="card") $payMethod="<B>ī�����</B> [".$trade_row[bankInfo]."]";
									elseif($trade_row[payMethod] =="hand") $payMethod="<B>�޴���</B> [".$trade_row[bankInfo]."]";
									elseif($trade_row[payMethod] =="iche") $payMethod="<B>������ü</B> [".$trade_row[bankInfo]."]";
									elseif($trade_row[payMethod] =="cyber") $payMethod="<B>�������</B> [".$trade_row[bankInfo]."]";
									elseif($trade_row[payMethod] =="bank") $payMethod="<B>������</B> [".$trade_row[bankInfo]."]";
									$encode_str = "idx=".$trade_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
									$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
									$data=Encode64($encode_str);					//�� ���ڵ� ����
									$trade_goods_qry ="select *from trade_goods where tradecode='$trade_row[tradecode]'";
									$trade_goods_result = $MySQL->query($trade_goods_qry);
									$formCnt =0;
									while($trade_goods_row = mysql_fetch_array($trade_goods_result))
									{
										$formCnt++;
										$goods_qry    = "select *from goods where idx=$trade_goods_row[goodsIdx]";
										$goods_result = $MySQL->query($goods_qry);
										$goods_row    = mysql_fetch_array($goods_result);	//��ǰ����
										$optionArr = Array("$trade_goods_row[option1]","$trade_goods_row[option2]","$trade_goods_row[option3]");   //�ɼ� �迭
										$tprice = $trade_goods_row[price]*$trade_goods_row[cnt]; //��ǰ�հ��� 
										if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
										else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
										else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
										else $img_str = $goods_row[img1];

										// ��ۻ�, �����ȣ ����
										if ($trade_goods_row[trans_company]) $trans_info[$formCnt].= $trade_goods_row[trans_company].":".$trade_goods_row[trans_num];
										if ($trade_goods_row[status]==2 || $trade_goods_row[status]==3) /// �����,��ۿϷ��϶� ������� ��ũ����
										{
											$trans_com_url = $admin_row[trans_com_url];
											if ($trans_com_url)
											{
												$trans_info[$formCnt].= "&nbsp;&nbsp;&nbsp;<a href='http://$trans_com_url' target='_blank'><b>[�������]</b></a>";
											}
										}
										?>
										<tr>
											<td width="50" height="25" align="center"><img src="./upload/goods/<?=$img_str?>" width="40" height="40"></td>
											<td width="190" height="25" align="center"><?=$trade_goods_row[name]?></td>
											<td width="100" height="25" align="center"><div align="center">
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
												</table></div>
											</td>
											<td width="100" height="25" align="right"><?=PriceFormat($trade_goods_row[price])?> ��</td>
											<td width="38" height="25" align="center"><?=$trade_goods_row[cnt]?></td>
											<td width="76" height="25" align="right"><FONT COLOR="#ff4800"><b><?=PriceFormat($tprice)?> ��</b></FONT></td>
											<td width="80" height="25" align="center"><B><?=$TRADE_ARR[$trade_goods_row[status]]?></B></td>
										</tr>
										<tr>
											<td colspan="7" height="1" bgcolor='e1e1e1'></td>
										</tr><?
									}
									?>
									</table>
								</td>
							</tr>
							<tr>
								<td height="30">
									<table width="670" border="0" cellspacing="1" cellpadding="0">
										<tr>
											<td height="30" align="right"> �� �հ� : <b><font color="#FF0000"><?=PriceFormat($trade_row[totalM])?> ��</font></b> [��ۺ� : <font color="#FF0000"><?=PriceFormat($trade_row[transM])?></font> , ��������� <font color="#FF0000"><?=PriceFormat($trade_row[useP])?></font> ��] </td>
										</tr>
									</table>
								</td>
							</tr>
						</table><br><br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan='2' bgcolor='80c9d8' height='2'></td>
							</tr>
							<tr>
								<td colspan='2' bgcolor='ffffff' height='1'></td>
							</tr>
							<tr>
								<td height="30" colspan="2" bgcolor="#edf7f9"><b><font color='006676'> &nbsp;&nbsp;�ֹ� ����</b></font></td>
							</tr>
							<tr>
								<td colspan='2' bgcolor='80c9d8' height='1'></td>
							</tr>
							<tr>
								<td height="25" width="150" bgcolor="f4f4f4" align="center"> &nbsp;�ֹ��ڵ�</td>
								<td height="25"> &nbsp;&nbsp;<FONT COLOR="#76872e"><B><?=$trade_row[tradecode]?></B></FONT></td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="150" bgcolor="f4f4f4" align="center"> &nbsp;�ֹ�����</td>
								<td height="25"> &nbsp;&nbsp;<?=$trade_row[writeday]?></td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="150" bgcolor="f4f4f4" align="center"> &nbsp;��ۻ�/�����ȣ</td>
								<td height="25"> &nbsp;&nbsp;<?
								if (sizeof($trans_info))
								{
									foreach ($trans_info as $key => $value)
									{
										echo $value."&nbsp;&nbsp;";
									}
								}
								?></td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
						</table><br><br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan='2' bgcolor='80c9d8' height='2'></td>
							</tr>
							<tr>
								<td colspan='2' bgcolor='ffffff' height='1'></td>
							</tr>
							<tr>
								<td height="30" colspan="2" bgcolor="#edf7f9"><font color='006676'><b> &nbsp;&nbsp;���� ����</b></font></td>
							</tr>
							<tr>
								<td colspan='2' bgcolor='80c9d8' height='1'></td>
							</tr>
							<tr>
								<td height="25" width="150" bgcolor="f4f4f4" align="center"> &nbsp;�ѻ�ǰ �ݾ�</td>
								<td height="25"> &nbsp;&nbsp;<?=PriceFormat($trade_row[totalM])?> ��</td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="150" bgcolor="f4f4f4" align="center"> &nbsp;��� ������</td>
								<td height="25"> &nbsp;&nbsp;<?=PriceFormat($trade_row[useP])?> ��</td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="150" bgcolor="f4f4f4" align="center"> &nbsp;�� �� ��</td>
								<td height="25"> &nbsp;&nbsp;<?=PriceFormat($trade_row[transM])?> ��</td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="150" bgcolor="f4f4f4" align="center"> &nbsp;�� ���� �ݾ�</td>
								<td height="25"> &nbsp;&nbsp;<FONT COLOR="#ff4800"><B><?=PriceFormat($trade_row[payM])?></B> ��</FONT></td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="150" bgcolor="f4f4f4" align="center"> &nbsp;���� ���</td>
								<td height="25"> &nbsp;&nbsp;<?=$payMethod?></td>
							</tr>
							<tr>
								<td height="1" colspan="2" bgcolor='e1e1e1'></td>
							</tr>
						</table><br><br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan='4' bgcolor='80c9d8' height='2'></td>
							</tr>
							<tr>
								<td colspan='4' bgcolor='ffffff' height='1'></td>
							</tr>
							<tr>
								<td height="30" bgcolor="#edf7f9" colspan="2"><font color='006676'><b> &nbsp;&nbsp;�ֹ��� ����</b></font></td>
								<td height="30" bgcolor="#edf7f9" colspan="2"><font color='006676'><b> &nbsp;&nbsp;������ ����</b></font></td>
							</tr>
							<tr>
								<td colspan='4' bgcolor='80c9d8' height='1'></td>
							</tr>
							<tr>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;�� ��</td>
								<td height="25" width="200"> &nbsp;<?=$trade_row[name]?></td>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;�� ��</td>
								<td height="25" width="200"> &nbsp;<?=$trade_row[rname]?></td>
							</tr>
							<tr>
								<td height="1" colspan="4" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;�� �� ��</td>
								<td height="25" width="200"> &nbsp;<?=$trade_row[email]?></td>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;�� �� ��</td>
								<td height="25" width="200"> &nbsp;<?=$trade_row[remail]?></td>
							</tr>
							<tr>
								<td height="1" colspan="4" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;��ȭ��ȣ</td>
								<td height="25" width="200"> &nbsp;<?=$trade_row[tel]?></td>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;��ȭ��ȣ</td>
								<td height="25" width="200"> &nbsp;<?=$trade_row[rtel]?></td>
							</tr>
							<tr>
								<td height="1" colspan="4" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;�޴�����ȣ</td>
								<td height="25" width="200"> &nbsp;<?=$trade_row[hand]?> &nbsp;&nbsp;&nbsp; </td>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;�޴�����ȣ</td>
								<td height="25" width="200"> &nbsp;<?=$trade_row[rhand]?>&nbsp;&nbsp; </td>
							</tr>
							<tr>
								<td height="1" colspan="4" bgcolor='e1e1e1'></td>
							</tr>
							<tr>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;�� ��</td>
								<td height="25" width="200"> &nbsp;[<?=$trade_row[zip]?>]<br> &nbsp;<?=$trade_row[adr]?> <?=$trade_row[adr1]?> </td>
								<td height="25" width="100" bgcolor="f4f4f4">&nbsp;&nbsp;&nbsp;�� ��</td>
								<td height="25" width="200"> &nbsp;[<?=$trade_row[rzip]?>]<br> &nbsp;<?=$trade_row[radr1]?> <?=$trade_row[radr2]?> </td>
							</tr>
							<tr>
								<td height="1" colspan="4" bgcolor="e1e1e1"></td>
							</tr>
						</table><?
						/////////////////// �ֹ������϶� �ֹ���� ���///////////////////// 
						if ($trade_row[status]==0)
						{
							?><br><br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor='80c9d8' height='2'></td>
							</tr>
							<tr>
								<td bgcolor='ffffff' height='1'></td>
							</tr>
							<tr>
								<td height="30" bgcolor="#edf7f9"><font color='006676'><b>&nbsp;&nbsp;�ֹ����</b></font></td>
							</tr>
							<tr>
								<td bgcolor='80c9d8' height='1'></td>
							</tr>
							<tr>
								<td height="30" bgcolor="#ffffff"><b> &nbsp;&nbsp;<img src='image/icon/order_cancel.gif' onclick="trade_cancel('<?=$trade_row[tradecode]?>');" style='cursor:pointer' align='absmiddle'>&nbsp;�� ����Ȯ���� �Ǳ������� �ֹ��� ����ϽǼ� �ֽ��ϴ�. </b></td>
							</tr>
							<tr>
								<td bgcolor='e1e1e1' height='1'></td>
							</tr>
						</table><?
						}
						/////////////////// ������϶� ///////////////////// 
						if ($MySQL->articles("SELECT idx from trade_goods WHERE tradecode='$trade_row[tradecode]' and status=2 limit 1"))
						{
							?><br><br>
						<table width="600" border="1" cellspacing="0" cellpadding="0" align="center" class="table_coll">
							<tr>
								<td>
									<form name="form2" method="post">
									<table width=100% cellspacing="0" cellpadding="5" border=0>
										<tr align="center" bgcolor="f4f4f4">
											<td colspan="3" height="30"><b>�� ǰ �� �� �� ��</b></td>
										</tr><?
										$trade_goods_qry ="select *from trade_goods where tradecode='$trade_row[tradecode]'";
										$trade_goods_result = $MySQL->query($trade_goods_qry);
										$formCnt =0; 
										while($trade_goods_row = mysql_fetch_array($trade_goods_result))
										{
											$goods_row    = $MySQL->fetch_array("select *from goods where idx=$trade_goods_row[goodsIdx]");
											if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
											else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
											else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
											else $img_str = $goods_row[img1];
											?>
										<input type="hidden" name="goodsIdx" value="<?=$trade_goods_row[goodsIdx]?>">
										<tr>
											<td width="50" height="25" align="center"><img src="./upload/goods/<?=$img_str?>" width="60" height="60"></td>
											<td width="180" height="25" align="center"><?=$trade_goods_row[name]?></td>
											<td><textarea name="comment" class="box" rows="5" cols="60"></textarea></td>
										</tr><?
										}
										?>
									</table>
								</td>
							</tr>
							<tr align="center">
								<td height="50"><b>�ֹ��Ͻ� ��ǰ�� ���������� ��� �����̴ٸ� ���⸦ Ŭ�����ֽñ� �ٶ��ϴ�.����</b>&nbsp;<img align="absmiddle" src="image/trans_comple.jpg" style="cursor:pointer" onclick="trans_comple('<?=$trade_row[tradecode]?>');"><br><img src="image/icon/blue_bullet.gif"><font color="#999999"> ��ۿϷ� ó���� �Ǿ�߸� <b><? if ($admin_row[bUsepoint] && $GOOD_SHOP_PART=="member"){ ?>������ ���� �� <? } ?> ���������� �ֹ��Ϸ�ó��</b>�� �Ǿ����ϴ�.</font> <?
								if ($admin_row[bUsepoint] && $admin_row[write_goodsP] && $GOOD_SHOP_PART=="member")
								{
									?><br><img src="image/icon/blue_bullet.gif"><font color="#999999"> �����ı� �ۼ��� <b><?=PriceFormat($admin_row[write_goodsP])?> ��</b> �� �������� ���޵˴ϴ�.</font> <?
								}
								?></td>
							</tr>
							</form>
						</table><?
						}
						?>
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