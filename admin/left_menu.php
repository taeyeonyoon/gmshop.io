<?
// �ҽ��������
// 20060714_1 �ҽ����� ��ȣ�� (��� ���α׷� �������� ���� �ҽ� ����)
/*************************************************
������ ���� �Ҹ޴� ($__TOP_MENU)

basic		: �⺻����
order		: �ֹ�����
goods		: ��ǰ����
category	: ī�װ�
member		: ȸ������
design		: �����ΰ���
sale		: �������
gm_counter	: ������� ����
page		: ���������������
news		: ��������
board		: �Խ���
ask			: 1:1���ǰԽ���
sms			: SMS����
�̹������ε�(��â)
admmail		: �����ڸ���
help		: ����������
**************************************************/
?>
		<td valign="top" bgcolor='EFF2F3' width='170'>
			<table width='170' border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td height='15'></td>
				</tr>
				<tr><?
				if($__TOP_MENU=="basic")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='adm.php'>������ �⺻����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='adm_account.php'>���ڰ��� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='adm_trans.php'>��� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='adm_use.php'>�̿�ȳ� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='adm_etc.php'>���� �� ��� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='adm_reset.php'>�� �ʱ�ȭ ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='adm_etc2.php'>��Ÿ ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="order")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='trade_order.php'>�ֹ����� ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='trade_order.php?status=0'><?=$TRADE_ARR[0]?> ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='trade_order.php?status=1'><?=$TRADE_ARR[1]?> ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='trade_order.php?status=2'><?=$TRADE_ARR[2]?> ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='trade_order.php?status=3'><?=$TRADE_ARR[3]?> ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='trade_order.php?status=4'><?=$TRADE_ARR[4]?> ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='trade_order.php?status=5'><?=$TRADE_ARR[5]?> ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="goods")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='goods_position.php'>Ư����ġ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='total_goods_list.php'>��ǰ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='design_good_a.php'>��ǰ��� ������<br>(������ �����޴� �ٷΰ���)</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='goods_comment.php'>��ǰ�� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='goods_ask.php'>��ǰ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='goods_manage.php'>��ǰ���� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='goods_excel.php'>��ǰ�������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td><br>
									<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
										<tr>
											<td><?
											$left_menu_cate_result = $MySQL->query("select name,code,bHide from category order by position asc");
											$cnt = 0;
											while($left_menu_cate_row = mysql_fetch_array($left_menu_cate_result))
											{
												if($left_menu_cate_row[bHide]) echo "<font color=red>����������</font>";
												?><a href="total_goods_list.php?code=<?=$left_menu_cate_row[code]?>"><b><?=$left_menu_cate_row[name]?></b></a><br><br><?
												$cnt++;
											}
											?>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="category")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='category_manage.php'>ī�װ� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='category_write.php'>ī�װ� ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='category_position.php'>ī�װ� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td valign="top" align="center"><br>
									<table width="90%" border="0" cellspacing="0" cellpadding="4" align="center" bgcolor="#ffffff">
										<tr>
											<td><?
											$left_menu_cate_result = $MySQL->query("select name,code,bHide from category order by position asc");
											$cnt = 0;
											while($left_menu_cate_row = mysql_fetch_array($left_menu_cate_result))
											{
												if($left_menu_cate_row[bHide]) echo "<font color=red>����������</font>";
												?><a href="category_edit.php?parentcode=<?=$left_menu_cate_row[code]?>"><b><?=$left_menu_cate_row[name]?></b></a><br><br><?
												$cnt++;
											}
											?>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="member")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='member_list.php'>ȸ�����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='member_sendmail.php'>ȸ����ü ���Ϻ�����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='mailing_list.php'>�߼۸��� ��Ȳ</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='member_sms.php'>ȸ����ü SMS������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="design")
				{
					?>
					<td width="170" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='design.php'>����ȭ��</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='design_good.php'>��ǰ ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='design_sub.php'>���� ������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='design_join.php'>ȸ������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='design_wing.php'>�� ���� ���̾��</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='design_community.php'>Ŀ�´�Ƽ</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='design_new.php'>�űԻ�ǰ��</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td></td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="sale")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='sale_status.php'>�Ϲ� ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='sale_status_day.php'>���� ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='sale_status_month.php'>���� ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='sale_status_year.php'>�Ⱓ ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='sale_status_all.php'>Ư���Ⱓ ���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="gm_counter")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='gm_counter.php'>�Ϲ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='gm_counter_time.php'>�ð����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='gm_counter_week.php'>�ְ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='gm_counter_referer.php'>���Ӱ��</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='gm_counter_brower.php'>������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='gm_counter_os.php'>�ý���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="page")
				{
					?>
					<td width="170" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="news")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='notice_list.php?part=notice'>��������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='notice_list.php?part=event'>�̺�Ʈ</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='poll_list.php'>��������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="board")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='bbs_admin_list.php'>�Խ��� ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height="5" align="center">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF"><?
									$left_menu_bbs_today = date("Y-m-d");
									$left_menu_bbs_result =$MySQL->query("select *from bbs_list where gubun<>'B' order by idx asc");
									while($left_menu_bbs_row=mysql_fetch_array($left_menu_bbs_result))
									{
										$bbs_num = $MySQL->articles("SELECT idx from bbs_data WHERE code='$left_menu_bbs_row[code]'");
										$bbs_new_num = $MySQL->articles("SELECT idx from bbs_data WHERE code='$left_menu_bbs_row[code]' and left(writeday,10)='$left_menu_bbs_today' limit 1");
										if($bbs_new_num) $newImg = "<img src='../image/icon/icon_new.gif' width='30' height='10'>";
										else $newImg = "";
										?>
										<tr>
											<td height="30" ><img src="image/icon.gif" width="11" height="11"> <a href="bbs_list.php?code=<?=$left_menu_bbs_row[code]?>"><u><font color="#000099"><?=$left_menu_bbs_row[name]?></font></a> [<?=$bbs_num?>] <?=$newImg?></td>
										</tr><?
									}
									?>
									</table>
								</td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="ask")
				{
					?>
					<td width="170" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="sms")
				{
					?>
					<td width="170" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="admmail")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='admmail_adm.php'>�⺻����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr><?
							if($webmail_admin_row[adm_bWebmail])
							{
								?>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='admmail_write.php'>��������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='admmail_mbox.php'>������ ����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr><?
								$MySQL->query("select idx from webmail_mail where mbox='1' and badmin=1 and bRead=0");
								$left_menu_noread_cnt = $MySQL->is_affected();
								if($left_menu_noread_cnt)
								{
									$left_menu_noread_cnt_str = "[<B>$left_menu_noread_cnt</B>]";
								}
								else
								{
									$left_menu_noread_cnt_str = "";
								}
								?>
							<tr>
								<td height='25' bgcolor="ffffff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../image/webmail/left_icon2.gif" width="17" height="17" align="absmiddle"> <a href='admmail_list.php?mbox=1'>���������� <?=$left_menu_noread_cnt_str?></a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr><?
								$MySQL->query("select idx from webmail_mail where mbox='2' and badmin=1 and bRead=0");
								$left_menu_noread_cnt = $MySQL->is_affected();
								if($left_menu_noread_cnt)
								{
									$left_menu_noread_cnt_str = "[<B>$left_menu_noread_cnt</B>]";
								}
								else
								{
									$left_menu_noread_cnt_str = "";
								}
								?>
							<tr>
								<td height='25' bgcolor="ffffff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../image/webmail/left_icon3.gif" width="17" height="17" align="absmiddle"> <a href='admmail_list.php?mbox=2'>���������� <?=$left_menu_noread_cnt_str?></a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr><?
								$MySQL->query("select idx from webmail_mail where mbox='3' and badmin=1 and bRead=0");
								$left_menu_noread_cnt = $MySQL->is_affected();
								if($left_menu_noread_cnt)
								{
									$left_menu_noread_cnt_str = "[<B>$left_menu_noread_cnt</B>]";
								}
								else
								{
									$left_menu_noread_cnt_str = "";
								}
								?>
							<tr>
								<td height='25' bgcolor="ffffff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../image/webmail/left_icon4.gif" width="17" height="17" align="absmiddle"> <a href='admmail_list.php?mbox=3'>�ӽ������� <?=$left_menu_noread_cnt_str?></a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr><?
								$MySQL->query("select idx from webmail_mail where mbox='4' and badmin=1 and bRead=0");
								$left_menu_noread_cnt = $MySQL->is_affected();
								if($left_menu_noread_cnt)
								{
									$left_menu_noread_cnt_str = "[<B>$left_menu_noread_cnt</B>]";
								}
								else
								{
									$left_menu_noread_cnt_str = "";
								}
								?>
							<tr>
								<td height='25' bgcolor="ffffff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../image/webmail/left_icon5.gif" width="17" height="17" align="absmiddle"> <a href='admmail_list.php?mbox=4'>������ <?=$left_menu_noread_cnt_str?></a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr><?
								$left_menu_mbox_qry = "select * from webmail_mbox where badmin=1 order by idx asc";
								$left_menu_mbox_result = $MySQL->query($left_menu_mbox_qry);
								while($left_menu_mbox_row = mysql_fetch_array($left_menu_mbox_result))
								{
									$MySQL->query("select idx from webmail_mail where mbox='$left_menu_mbox_row[mbox]' and badmin=1 and bRead=0");
									$left_menu_noread_cnt = $MySQL->is_affected();
									if($left_menu_noread_cnt)
									{
										$left_menu_noread_cnt_str = "[<B>$left_menu_noread_cnt</B>]";
									}
									else
									{
										$left_menu_noread_cnt_str = "";
									}
									?>
							<tr>
								<td height='25' bgcolor="ffffff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../image/webmail/left_icon6.gif" width="17" height="17" align="absmiddle"> <a href='admmail_list.php?mbox=<?=$left_menu_mbox_row[mbox]?>'><?=$left_menu_mbox_row[name]?> <?=$left_menu_noread_cnt_str?></a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr><?
								}
								?>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='admmail_address.php'>�ּҷ�</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='admmail_manager.php'>ȯ�漳��</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr><?
							}
							?>
						</table>
					</td><?
				}
				else if($__TOP_MENU=="help")
				{
					?>
					<td width="170" valign="top">
						<table width="160" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='help_board.php'>����������</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='help_sql.php'>SQL �����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='help_manual.php'>�޴�����</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
							<tr>
								<td height='30'>&nbsp;&nbsp;<img src="image/left_icon.gif"> <a href='help_src.php'>�ҽ����� �̷°���</a></td>
							</tr>
							<tr>
								<td background='image/left_line.gif' height='2'></td>
							</tr>
						</table>
					</td><?
				}
				?>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>