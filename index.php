<?
include "head.php";
include "./lib/_gm_counter.php";
$MAIN_BEST_GOODS_COL	= $design[mainBestGoodsW];		//����Ʈ ��ǰ ���� ��¼�
$MAIN_BEST_GOODS_ROW	= $design[mainBestGoodsH];		//����Ʈ ��ǰ ���� ��¼�
$MAIN_HIT_GOODS_COL		= $design[mainHitGoodsW];		//��Ʈ ��ǰ ���� ��¼�
$MAIN_HIT_GOODS_ROW		= $design[mainHitGoodsH];		//��Ʈ ��ǰ ���� ��¼�
//=======       POPUP â ���� ==========================================================
$popup_result=$MySQL->query("select *from notice where bPopup='y'");
$to_day=date("Ymd"); //���ó�¥
$popup_top		= 50;
$popup_left		= 50;
$popup_cnt		= 0;
while($popup_row=mysql_fetch_array($popup_result))
{
	if(${NOTICE_COOKIE_.$popup_row[idx]}!="no" )
	{
		//��Ⱚ�������
		if($popup_row[sday] <=$to_day && $popup_row[eday] >= $to_day)
		{
			$popup_top+=$popup_cnt*50;
			$popup_left+=$popup_cnt*550;
			if($popup_row[bBasicimg]=="n" && $popup_row[bPopup]=="y")
			{
				$popup_height	=$popup_row[height]+40;
				$popup_width	=$popup_row[width]+20;
				echo"<script>
				window.open(\"notice_view_html.php?idx=$popup_row[idx]\",\"\",\"scrollbars=yes,left=$popup_left,top=$popup_top,width=$popup_width,height=$popup_height\");
				</script>";
			}
			else
			{
				$popup_height = 470;
				$popup_width = 520;
				echo"<script>
				window.open(\"notice_view_text.php?idx=$popup_row[idx]\",\"\",\"scrollbars=yes,left=$popup_left,top=$popup_top,width=$popup_width,height=$popup_height\");
				</script>";
			}
			$popup_cnt++;
		}
	}
}
//=====================================================================================
?>
<!--  top ����  -->
<? include "top.php"; ?>
<!-- top ��  -->
<div id="main_layer">
	<div id="left_layer">
<table width='180' cellspacing="0" cellpadding="0" border="0">
	<tr><?
	$LEFT_MAIN = 1; ////// ���������������� ���� �޴� ���� Ʋ��
	include "left_menu.php";
	?>
	</tr>
</table></div>
	<div id = "center_layer"><?
//////////Ŀ�´�Ƽ ���� ������ & 1�� ��ġ///////////////
if ($design[bcomm_main]=="y" && $design[bcomm_main_type]==1)
{
	?>
<table width="720" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top"><? include "community_inc.php"; ?></td>
	</tr>
</table><?
}
?>
<table width="720" border="0" cellspacing="0" cellpadding="0"><!--  Ÿ��Ʋ �̹��� ����  -->
	<tr><?
	///////////////���̾ƿ� üũ/////////////////
	if ($design[design_b_layout]==1)
	{
		$mainTitleImg_width = 520;
	}
	else
	{
		$mainTitleImg_width = 720;
	}
	if($design[mainTitleImg_bhtml])
	{
		//�±׻��
		?>
		<td  valign='top'><?=$design[mainTitleImg_content]?></td><?
	}
	else if ($design[bScrollUse]=="y")
	{
		/////////////////////// ����Ÿ��Ʋ �̹��� ���� �����̵� ��� ����////////////////////////
		?>
		<td valign="top" align="center" height="245"><!--------- IFRAME ���� ����Ҷ� �̰� �̿� <iframe width="<?=$mainTitleImg_width?>" scrolling=no marginheight=0 height=245 frameborder=0 src="mainSlide_banner.php?mainTitleImg_width=<?=$mainTitleImg_width?>"></iframe> --------------------><? include "mainSlide_banner.php"; ?></td><?
	}
	else if($design[mainTitleImg_type]==4)
	{
		//�÷���
		$img = "./upload/design/$design[mainTitleImg]";
		$img_info = getimagesize($img);
		$swf_width = $img_info[0];
		$swf_height = $img_info[1];
		?>
		<td valign='top' align='center'>
			<script language='javascript'>
				getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
			</script>
		</td><?
	}
	else
	{
		?><td valign='top' align='center'><img src="./upload/design/<?=$design[mainTitleImg]?>" width="<?=$mainTitleImg_width?>" height=245></td><?
	}
	if ($design[design_b_layout]==1)
	{
		?><!--  �������� ����  -->
		<td valign="top">
			<table width="196" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
				<tr>
					<td><a href="notice_list.php"><img src="./upload/design/<?=$design[noticeTitleImg]?>"  border=0></a></td>
				</tr>
				<tr>
					<td>
						<table width="180" border="0" cellspacing="0" cellpadding="0" align="center"><?
						$top_notice_result = $MySQL->query("select *from notice where part='notice' order by idx desc limit 0,6");
						while($top_notice_row = mysql_fetch_array($top_notice_result))
						{
							if ($top_notice_row[gubun]=="M" && ($GOOD_SHOP_PART_GUBUN=="M" || $GOOD_SHOP_PART_GUBUN!="D")) $read_able = true;
							else if ($top_notice_row[gubun]=="D" && $GOOD_SHOP_PART_GUBUN=="D") $read_able = true;
							else if (empty($top_notice_row[gubun])) $read_able = true;
							else $read_able = false;
							if ($read_able)
							{
								$java_str = $top_notice_row[idx].",'".$top_notice_row[bBasicimg]."',".$top_notice_row[width].",".$top_notice_row[height];
								$java_str.= ",'".$top_notice_row[bPopup]."'";
								?>
							<tr>
								<td height="3"></td>
							</tr>
							<tr>
								<td height="23"><img src=image/notice_icon.gif>&nbsp;<a href="javascript:noticeView(<?=$java_str?>);"><font color="#464646"><?=StringCut($top_notice_row[title],24)?></font></a></td>
							</tr><?
							}
						}
						?>
						</table>
					</td>
				</tr><!--  �������� ��  --><!--  �������� �� ���� ����  -->
				<tr>
					<td valign="bottom" height="80"><a href="http://<?=$design[mainnSubTitle2_url]?>" target="<?=$design[mainnSubTitle2_target]?>"><img src="upload/design/<?=$design[mainnSubTitle2]?>" width="195" border=0></a></td>
				</tr>
			</table>
		</td><?
	}
	?>
	</tr>
</table><?
//////////Ŀ�´�Ƽ ���� ������ & 2�� ��ġ///////////////
if ($design[bcomm_main]=="y" && $design[bcomm_main_type]==2)
{
	?>
<table width="720" border="0" cellspacing="0" cellpadding="0" style="TABLE-LAYOUT: fixed;">
	<tr>
		<td valign="top"><? include "community_inc.php"; ?></td>
	</tr>
</table><?
}
?>
<!--  �����߾� 1���� ��� ����  --><?
if ($design[mainCenter1_use]=="y")
{
	?>
<table width="720" border="0" cellspacing="0" cellpadding="0" style="TABLE-LAYOUT: fixed;">
	<tr>
		<td valign="top">
			<table width="720" border="0" cellspacing="0" cellpadding="0"><?
			$ban_qry = "select *from banner where position ='mainCenter1' order by sunwi asc";
			$ban_result = $MySQL->query($ban_qry);
			$ban_cnt =1;
			while($ban_row = mysql_fetch_array($ban_result))
			{
				if ($ban_cnt % $design[mainCenter1_cols] == 1) echo "<tr>";
				if($ban_row[type]==4)
				{
					//�÷���
					$img = "upload/design/$ban_row[img]";
					$img_info = @getimagesize($img);
					$swf_width = $img_info[0];
					$swf_height = $img_info[1];
					?>
					<td align="center">
						<script language='javascript'>
							getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
						</script>
					</td><?
				}
				else
				{
					//�̹���
					if($ban_row[gubun]==0)
					{
						?><!-- ����Ʈ ��ũ --><?
						if ($ban_row[siteTarget] == "_blank") $http = "http://";
						?>
					<td align="center"><a href="<?=$http?><?=$ban_row[siteUrl]?>" target="<?=$ban_row[siteTarget]?>"> <img src="upload/design/<?=$ban_row[img]?>" border="0"></a></td><?
					}
					else if($ban_row[gubun]==1)
					{
						?><!-- ��ǰ ��ũ -->
					<td align="center"><a href="goods_detail.php?goodsIdx=<?=$ban_row[goodsUrl]?>"><img src="./upload/design/<?=$ban_row[img]?>" border="0"></a></td><?
					}
					else
					{
						?><!-- ��ũ���� -->
					<td align="center"><img src="./upload/design/<?=$ban_row[img]?>"></td><?
					}
				}
				if ($ban_cnt % $design[mainCenter1_cols] == 0) echo "</tr>";
				$ban_cnt ++;
			}
			?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="2"></td>
	</tr>
</table><?
}
if ($design[mainCenter2_use]=="y")
{
	?>
<table width="720" border="0" cellspacing="0" cellpadding="0" style="TABLE-LAYOUT: fixed;">
	<tr>
		<td valign="top">
			<table width="720" border="0" cellspacing="0" cellpadding="0"><?
			$ban_qry = "select *from banner where position ='mainCenter2' order by sunwi asc";
			$ban_result = $MySQL->query($ban_qry);
			$ban_cnt =1;
			while($ban_row = mysql_fetch_array($ban_result))
			{
				if ($ban_cnt % $design[mainCenter2_cols] == 1) echo "<tr>";
				if($ban_row[type]==4)
				{
					//�÷���
					$img = "upload/design/$ban_row[img]";
					$img_info = @getimagesize($img);
					$swf_width = $img_info[0];
					$swf_height = $img_info[1];
					?>
					<td align="center" align="center">
						<script language='javascript'>
							getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
						</script>
					</td><?
				}
				else
				{
					//�̹���
					if($ban_row[gubun]==0)
					{
						?><!-- ����Ʈ ��ũ --><?
						if ($ban_row[siteTarget] == "_blank") $http = "http://";
						?>
					<td align="center"><a href="<?=$http?><?=$ban_row[siteUrl]?>" target="<?=$ban_row[siteTarget]?>"> <img src="upload/design/<?=$ban_row[img]?>" border="0"></a></td><?
					}
					else if($ban_row[gubun]==1)
					{
						?><!-- ��ǰ ��ũ -->
					<td align="center"><a href="goods_detail.php?goodsIdx=<?=$ban_row[goodsUrl]?>"><img src="./upload/design/<?=$ban_row[img]?>" border="0"></a></td><?
					}
					else
					{
						?><!-- ��ũ���� -->
					<td align="center"><img src="./upload/design/<?=$ban_row[img]?>"></td><?
					}
				}
				if ($ban_cnt % $design[mainCenter2_cols] == 0) echo "</tr>";
				$ban_cnt ++;
			}
			?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="2"></td>
	</tr>
</table><?
}
if ($design[mainCenter3_use]=="y")
{
	?>
<table width="720" border="0" cellspacing="0" cellpadding="0" style="TABLE-LAYOUT: fixed;">
	<tr>
		<td valign="top">
			<table width="720" border="0" cellspacing="0" cellpadding="0"><?
			$ban_qry = "select *from banner where position ='mainCenter3' order by sunwi asc";
			$ban_result = $MySQL->query($ban_qry);
			$ban_cnt =1;
			while($ban_row = mysql_fetch_array($ban_result))
			{
				if ($ban_cnt % $design[mainCenter3_cols] == 1) echo "<tr>";
				if($ban_row[type]==4)
				{
					//�÷���
					$img = "upload/design/$ban_row[img]";
					$img_info = @getimagesize($img);
					$swf_width = $img_info[0];
					$swf_height = $img_info[1];
					?>
					<td align="center">
						<script language='javascript'>
							getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
						</script>
					</td><?
				}
				else
				{
					//�̹���
					if($ban_row[gubun]==0)
					{
						?><!-- ����Ʈ ��ũ --><?
						if ($ban_row[siteTarget] == "_blank") $http = "http://";
						?>
					<td align="center"><a href="<?=$http?><?=$ban_row[siteUrl]?>" target="<?=$ban_row[siteTarget]?>"> <img src="upload/design/<?=$ban_row[img]?>" border="0"></a></td><?
					}
					else if($ban_row[gubun]==1)
					{
						?><!-- ��ǰ ��ũ -->
					<td align="center"><a href="goods_detail.php?goodsIdx=<?=$ban_row[goodsUrl]?>"><img src="./upload/design/<?=$ban_row[img]?>" border="0"></a></td><?
					}
					else
					{
						?><!-- ��ũ���� -->
					<td align="center"><img src="./upload/design/<?=$ban_row[img]?>"></td><?
					}
				}
				if ($ban_cnt % $design[mainCenter3_cols] == 0) echo "</tr>";
				$ban_cnt ++;
			}
			?>
			</table>
		</td>
	</tr>
	<!--  �����߾� 3���� ��� ��  -->
	<tr>
		<td height='10'></td>
	</tr>
</table><?
}
?>
<!-- ����Ʈ ��ǰ�� ����  -->
<table width="720" border="0" cellspacing="0" cellpadding="0" style="TABLE-LAYOUT: fixed;">
	<tr>
		<td valign="top">
			<table width="720" border="0" cellspacing="0" cellpadding="0"><?
			if($design[mainBestApp]==1)
			{
				//���� ����Ʈ ��ǰ ��� ����� ���
				?>
				<tr>
					<td valign='top'><img src="./upload/design/<?=$design[mainBestGoodsTitle]?>" width="720" ></td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" valign="top"><!-- ���� ����Ʈ ��ǰ ��� ���� -->
						<table width="720" border="0" cellspacing="0" cellpadding="0" height="140" align="center"><?
						$MAIN_BEST_GOODS_LIMIT	= $MAIN_BEST_GOODS_COL *$MAIN_BEST_GOODS_ROW;	//���κ���Ʈ ��ǰ �� ����
						$TD_INTVAL	= intval( 720/$MAIN_BEST_GOODS_COL -1);
						$main_best_qry = "select goods.*from goods,position as pos where pos.goodsIdx=goods.idx and pos.part='mainbest' and goods.bLimit<3 order by pos.sunwi asc limit $MAIN_BEST_GOODS_LIMIT";
						$main_best_result = $MySQL->query($main_best_qry);
						$main_best_cnt =0;		//���κ���Ʈ ��ǰ ī��Ʈ
						?>
							<tr>
								<td  height="180"><br>
									<table width="720" height="170" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr><?
										if ($design[mainBestColsChange]=="y")
										{
											?>
											<td>
												<table width=100% cellspacing="0" cellpadding="0">
													<tr><?
													$mainBestCols_arr = explode("/",$design[mainBestColsChangeValue]);
													$MAIN_BEST_GOODS_COL = $mainBestCols_arr[0];
													$TD_INTVAL	= intval( 720/($MAIN_BEST_GOODS_COL -1));
													$mainBestCols_arr_cnt = 0; ///// �� �ٲ𶧸���
										}
										while($goods_row = mysql_fetch_array($main_best_result))
										{
											if ($MAIN_BEST_GOODS_COL)
											{
												$TD_INTVAL	= @intval( 720/($MAIN_BEST_GOODS_COL));
											}
											if ($goods_row[idx]) $gprice = new CGoodsPrice($goods_row[idx]);
												?>
														<td width="<?=$TD_INTVAL?>" valign="top">
															<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"><?
															$LINK = "goods_detail.php?goodsIdx=$goods_row[idx]";
															$MAINPAGE_BEST = 1;
															$designType =1;
															include "goods_detail_inc.php";
															$MAINPAGE_BEST = 0;
															?>
															</table>
														</td><?
														$main_best_cnt++; //ī��Ʈ ����
														if(! ($main_best_cnt%$MAIN_BEST_GOODS_COL))
														{
															//�ٴ��� �� ��ǰ�� �ƴϸ�
															$main_best_colspan_line =$MAIN_BEST_GOODS_COL*2-1;	//�ٹٲ� �̹��� ���� ����
															if($main_best_cnt <$MAIN_BEST_GOODS_LIMIT)
															{
																//�ٹٲ� �̹��� ������ ���� ǥ������ ����
																if ($design[mainBestColsChange]=="y")
																{
																	$main_best_cnt=0;
																	$mainBestCols_arr_cnt++;
																	$mainBestCols_arr = explode("/",$design[mainBestColsChangeValue]);
																	$MAIN_BEST_GOODS_COL = $mainBestCols_arr[$mainBestCols_arr_cnt];
																	if ($MAIN_BEST_GOODS_COL)
																	{
																		// �� �� �ƴҶ�
																		$TD_INTVAL	= intval( 720/($MAIN_BEST_GOODS_COL));
																	}
																}
																?>
													</tr>
													<tr>
														<td colspan="<?=$main_best_colspan_line?>" height="1" background="image/index/dot_width1.gif"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>
												<table cellspacing="0" cellpadding="0">
													<tr><?
															}
														}
														else
														{
															?>
														<td background="image/index/main_line.gif" width="1" height=124></td><?
														}
										}
										if($main_best_cnt %$MAIN_BEST_GOODS_COL)
										{
											//��ĭ���� <tr>�� ������ <td> ü��
											$empty_TD=$MAIN_BEST_GOODS_COL - ($main_best_cnt %$MAIN_BEST_GOODS_COL);
											for($i=0;$i<$empty_TD;$i++)
											{
												?>
														<td valign="middle" width="<?=$TD_INTVAL?>">
															<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
																<tr>
																	<td height="100" align="center">&nbsp;</td>
																</tr>
																<tr>
																	<td align="center">&nbsp;</td>
																</tr>
																<tr>
																	<td align="center">&nbsp;</td>
																</tr>
																<tr>
																	<td align="center">&nbsp;</td>
																</tr>
																<tr>
																	<td align="center">&nbsp;</td>
																</tr>
															</table>
														</td><?
												if(($i <$empty_TD-1))
												{
													?>
														<td background="image/index/main_line.gif" width="1" height=124></td><?
												}
											}
										}
										?>
													</tr>
													<tr>
														<td colspan="<?=$main_hit_colspan_line?>" height="1" background="image/index/dot_width1.gif"></td>
													</tr>
												</table>
											</td><?
											if ($design[mainBestColsChange]=="y")
											{
												?>
										</tr>
									</table>
								</td><?
											}
											?>
							</tr>
						</table>
					</td>
				</tr><!-- ���� ����Ʈ ��ǰ ��� �� --><?
			}
			else if ($design[mainBestApp]==2)
			{
				// �ڵ� ��ũ�Ѻ�
				?>
				<tr>
					<td valign='top'><img src="./upload/design/<?=$design[mainBestGoodsTitle]?>" width=720></td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" valign="top">
						<table width="720" border="0" cellspacing="0" cellpadding="0" height="150" align="center">
							<tr>
								<td style="padding: 10 0 10 0"><?
								$part ="best";
								include "mainScroll.php";
								?><!-------- IFRAME �� ���� �̰� ��� <iframe width="100%" scrolling=no marginheight=0 height="<?=$design_goods[scrollheight]?>" frameborder=0 src="mainScroll.php?part=<?=$part?>"></iframe> ---------></td>
							</tr>
						</table>
					</td>
				</tr><?
			}
			else
			{
				$mainBestContent = $design[mainBestContent];
				?>
				<tr>
					<td colspan="2" valign="top" align="center"><?=$mainBestContent?></td>
				</tr><?
			}
			?>
			</table>
		</td>
	</tr>
</table>
<!--  ����Ʈ ��ǰ�� ��  -->
<!--  ��Ʈ ��ǰ�� ����  -->
<table width="720" border="0" cellspacing="0" cellpadding="0" style="TABLE-LAYOUT: fixed;">
	<tr>
		<td>
			<table width='720' border='0' cellspacing='0' cellpadding='0' bgcolor='BDE6E5'>
				<tr>
					<td valign='top' bgcolor='ffffff'>
						<table width="710" border="0" cellspacing="0" cellpadding="0"><?
						// ���� ��Ʈ��ǰ��� ��������� ���
						if($design[mainHitApp]==1)
						{
							?>
							<tr>
								<td valign='top'><img src="./upload/design/<?=$design[mainHitGoodsTitle]?>"></td>
							</tr><?
							$MAIN_HIT_GOODS_LIMIT	= $MAIN_HIT_GOODS_COL *$MAIN_HIT_GOODS_ROW;	//������Ʈ ��ǰ �� ����
							$TD_INTVAL	= intval( 720/$MAIN_HIT_GOODS_COL -1);
							$main_hit_qry = "select goods.*from goods,position as pos where pos.goodsIdx=goods.idx and pos.part='mainhit' and goods.bLimit<3 order by pos.sunwi asc limit $MAIN_HIT_GOODS_LIMIT";
							$main_hit_result = $MySQL->query($main_hit_qry);
							$main_hit_cnt =0;	// ������Ʈ ��ǰ ī��Ʈ
							?>
							<tr>
								<td bgcolor="#FFFFFF"  valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="180"><br>
												<table width="100%" height="170" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr><?
													// �ึ�� �� ���� �ٲٴ� ��� ����
													if ($design[mainHitColsChange]=="y")
													{
														?>
														<td>
															<table width=100% cellspacing="0" cellpadding="0">
																<tr><?
																$mainHitCols_arr = explode("/",$design[mainHitColsChangeValue]);
																$MAIN_HIT_GOODS_COL = $mainHitCols_arr[0];
																$TD_INTVAL	= intval( 720/($MAIN_HIT_GOODS_COL -1));
																$mainHitCols_arr_cnt = 0;	// �� �ٲ𶧸���
													}
													while($goods_row = mysql_fetch_array($main_hit_result))
													{
														if ($MAIN_HIT_GOODS_COL)
														{
															$TD_INTVAL	= @intval( 720/($MAIN_HIT_GOODS_COL));
														}
														$gprice = new CGoodsPrice($goods_row[idx]);
														?>
																	<td width="<?=$TD_INTVAL?>" valign="top">
																		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="TABLE-LAYOUT: fixed;"><?
																		$LINK = "goods_detail.php?goodsIdx=$goods_row[idx]"; 
																		$MAINPAGE_HIT = 1;
																		$designType =1;
																		include "goods_detail_inc.php";
																		$MAINPAGE_HIT = 0;
																		?>
																		</table>
																	</td><?
														$main_hit_cnt++;	// ī��Ʈ ����
														if(! ($main_hit_cnt%$MAIN_HIT_GOODS_COL))
														{
															// �ٴ��� �� ��ǰ�� �ƴϸ�
															$main_hit_colspan_line =$MAIN_HIT_GOODS_COL*2-1;	//�ٹٲ� �̹��� ���� ����
															if($main_hit_cnt <$MAIN_HIT_GOODS_LIMIT)
															{
																// �ٹٲ� �̹��� ������ ���� ǥ������ ����
																if ($design[mainHitColsChange]=="y")
																{
																	$main_hit_cnt=0;
																	$mainHitCols_arr_cnt++;
																	$mainHitCols_arr = explode("/",$design[mainHitColsChangeValue]);
																	$MAIN_HIT_GOODS_COL = $mainHitCols_arr[$mainHitCols_arr_cnt];
																	if ($MAIN_HIT_GOODS_COL)
																	{
																		// �� �� �ƴҶ�
																		$TD_INTVAL	= intval( 720/($MAIN_HIT_GOODS_COL));
																	}
																}
																?>
																</tr>
																<tr>
																	<td colspan="<?=$main_hit_colspan_line?>" height="1" background="image/index/dot_width1.gif"></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td>
															<table cellspacing="0" cellpadding="0">
																<tr><?
															}
														}
														else
														{
															// �ٴ��� ����ǰ�� �ƴϸ� ������ ǥ��
															if ($goods_row[idx])
															{
																?>
																	<td background="image/index/main_line.gif" width="1" height=124></td><?
															}
														}
													}
													if($main_hit_cnt %$MAIN_HIT_GOODS_COL)
													{
														// ��ĭ���� <tr>�� ������ <td> ü��
														$empty_TD=$MAIN_HIT_GOODS_COL - ($main_hit_cnt %$MAIN_HIT_GOODS_COL);
														for($i=0;$i<$empty_TD;$i++)
														{
															?>
																	<td valign="middle" width="<?=$TD_INTVAL?>">
																		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
																			<tr>
																				<td height="100" align="center">&nbsp;</td>
																			</tr>
																			<tr>
																				<td align="center">&nbsp;</td>
																			</tr>
																			<tr>
																				<td align="center">&nbsp;</td>
																			</tr>
																			<tr>
																				<td align="center">&nbsp;</td>
																			</tr>
																			<tr>
																				<td align="center">&nbsp;</td>
																			</tr>
																		</table>
																	</td><?
															if(($i <$empty_TD-1))
															{
																?>
																	<td background="image/index/main_line.gif" width="1" height=124></td><?
															}
														}
													}
													?>
																</tr>
																<tr>
																	<td colspan="<?=$main_hit_colspan_line?>" height="1" background="image/index/dot_width1.gif"></td>
																</tr>
															</table>
														</td><?
													if ($design[mainHitColsChange]=="y")
													{
														?>
													</tr>
												</table>
											</td><?
													}
													?>
										</tr>
									</table>
								</td>
							</tr><!-- ���� ��Ʈ ��ǰ ��� �� --><?
							// �ڵ� ��ũ�Ѻ�
						}
						else if ($design[mainHitApp]==2)
						{
							?>
							<tr>
								<td valign='top'><img src="./upload/design/<?=$design[mainHitGoodsTitle]?>" width=720></td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" valign="top" style="padding: 10 0 10 0">
									<table width="720" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td><?
											$part ="hit";
											include "mainScroll.php";
											?></td>
										</tr>
									</table>
								</td>
							</tr><?
							// HTML ���
						}
						else
						{
							$mainhitContent = $design[mainHitContent];
							?>
							<tr>
								<td valign="top" align="center"><?=$mainhitContent?></td>
							</tr><?
						}
						?>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<!-- ��Ʈ ��ǰ�� �� -->
<!-- �� ���ɻ�ǰ ����Ʈ -->
<table width="720" border="0" cellspacing="0" cellpadding="0" style="TABLE-LAYOUT: fixed;"><?
if ($design[bcomm_main]=="y" && $design[bcomm_main_type]==3)
{
	?>
	<tr>
		<td valign="top"><? include "community_inc.php"; ?></td>
	</tr><?
}
?>
</table>
	</div>
	<div id = "bottom_layer">
<table width="900" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top"><? include "copy.php"; ?></td>
	</tr>
</table>
</div>
</div>
</body>
</html>