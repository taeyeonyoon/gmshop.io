<?
include "head.php";
?>
<? include "top.php";?>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<? include "left_menu.php";?>
		<td height="51" valign="top" width="720" bgcolor="#FFFFFF">
			<table width="720" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF" valign="top">
					<td colspan="2" height="51">
						<table width="720" height="35" border="0" cellspacing="0" cellpadding="0" ailgn='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc15]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc15]?>" rowspan="2"></td>
								<td width="220" height="30" bgcolor="<?=$subdesign[bc15]?>"><img src="./upload/design/<?=$subdesign[img15]?>" ></td>
								<td width="490" height="30" bgcolor="<?=$subdesign[bc15]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc15]?>"> &nbsp; ������ġ : HOME &gt; �󼼰˻�</font>&nbsp;</div></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="720">
						<table width="714" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><?
								if ($subdesign[titimg15])
								{
									?><img src="./upload/design/<?=$subdesign[titimg15]?>" ><?
								}
								?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" width="720"><?
					$GOODS_LIST_COL		= $design_goods[goodsListW];
					$GOODS_LIST_COL_PER	        = $GOODS_LIST_COL-1;
					$GOODS_LIST_ROW		= $design_goods[goodsListH];
					$LIST_LIMIT			= $admin_row[search_list_cnt];
					$GOODS_LIST_WIDTH = 720 / $GOODS_LIST_COL;
					$data=Decode64($data);
					$pagecnt=$data[pagecnt];
					$letter_no=$data[letter_no];
					$offset=$data[offset];
					if(!$searchstring)
					{
						$search=$data[search];
						$searchstring=$data[searchstring];
					}
					$chk_str = SearchCheck($searchstring); // �˻�� ������ �빮�ڷ� �ٲ� ���ڿ� 
					$cnt=0;
					$hide_result = $MySQL->query("SELECT code from category WHERE bHide=1");
					while ($hide_row = mysql_fetch_array($hide_result))
					{
						if (empty($cnt)) $HIDE_QRY.= " and (category<>'$hide_row[code]'";
						else $HIDE_QRY.= " and category<>'$hide_row[code]'";
						$cnt++;
					}
					if ($cnt) $HIDE_QRY.=")";
					if ($detail)
					{
						if ($name) $chk_str = SearchCheck($name); // �˻�� ������ �빮�ڷ� �ٲ� ���ڿ� 
						if ($company) $cp_chk_str = SearchCheck($company);
						if ($model) $model_chk_str = SearchCheck($model);
					}
					if($detail)
					{
						$total_qry = "select * from goods where bLimit<3 $HIDE_QRY ";
						if($price)
						{
							$searchLen = (strlen($price) -1)*-1;		//���� �ݿø�����	
							$searchstring = round($price,$searchLen);
							$total_qry.=" and truncate(price,$searchLen) = $searchstring";
						}
						if($name)
						{
							$total_qry.=" and (name like '%".$name."%' or name like '%".$chk_str."%')";
						}
						if($company)
						{
							$total_qry.=" and (company like '%$company%' or company like '%$cp_chk_str%')";
						}
						if($model)
						{
							$total_qry.=" and (model like '%$model%' or model like '%$model_chk_str%')";
						}
						if($category)
						{
							$total_qry.=" and ( category ='$category' ) ";
						}
					}
					else
					{
						if($searchstring)
						{
							if($search=="price")
							{
								$searchLen = (strlen($searchstring) -1)*-1;		//���� �ݿø�����	
								$searchstring = round($searchstring,$searchLen);
								$total_qry ="select * from goods where truncate(price,$searchLen) = $searchstring $HIDE_QRY and bLimit<3";
							}
							else
							{
								//�Ϲݰ˻�
								$total_qry ="select * from goods where bLimit<3 $HIDE_QRY and ($search like '%$searchstring%' or $search like '%".$chk_str."%' or upper($search) like '%".$chk_str."%') ";
							}
						}
						else
						{
							$total_qry ="select * from goods where bLimit<3 $HIDE_QRY ";
						}
					}
					$numresults=$MySQL->query($total_qry);
					$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
					$LIMIT		=$admin_row[search_list_cnt];								//�������� �� ��
					$PAGEBLOCK	=10;								//���� ������ ��
					if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
					if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
					if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
					$total_page_cnt = ceil($numrows/$LIMIT);
					$goods_qry = $total_qry;
					if($position) $goods_qry.= "and right(substring_index(position,'|',$position),1) ='1' ";
					if($sort) $goods_qry.= " order by $sortStr $sort ";
					else $goods_qry.= " order by setVal asc ";
					$goods_qry.=" limit $offset,$LIMIT";
					$goods_result=$MySQL->query($goods_qry);
					$s_letter=$letter_no;								//�������� ���� �۹�ȣ
					?>
						<SCRIPT LANGUAGE="JavaScript">
						<!--
						//���� ����   (���ı���,���)
						function goodsSort()
						{
							var form=document.sortForm;
							var Index = form.sortIndex.selectedIndex;
							if(Index ==1)
							{
								form.sort.value="asc";
								form.sortStr.value = "name";
							}
							else if(Index==2)
							{
								form.sort.value="desc";
								form.sortStr.value = "name";
							}
							else if(Index==3)
							{
								form.sort.value="asc";
								form.sortStr.value = "price";
							}
							else if(Index==4)
							{
								form.sort.value="desc";
								form.sortStr.value = "price";
							}
							form.submit();
						}
						//-->
						</SCRIPT><?
						$encode_str = "pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
						$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
						$sortData=Encode64($encode_str);					//�� ���ڵ� ����
						if($numrows)
						{
							?>
						<table width="650" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor='e1e1e1'><?
							if($search =="name")			$search_str ="��ǰ��";
							else if($search =="price")	$search_str ="����";
							else if($search =="company")	$search_str ="������";
							else if($search =="model")	$search_str ="�𵨸�";
							if($sort)
							{
								$sort_str =($sort =="asc") ?  "��" : "��";
								$sortStr_str =($sortStr =="name") ? "�̸���" : "���ݼ�";
								$sortCode = "<br><B>���ı���</B> &nbsp;&nbsp;&nbsp;<FONT  COLOR='#0000ff'>$sortStr_str $sort_str</FONT>";
							}
							else
							{
								$sortCode="";
							}
							if($detail)
							{
								?>
							<tr>
								<td  height="30" bgcolor='f7f7f7'><B>�˻��ڵ�</B><?
								if($name)
								{
									?> &nbsp;&nbsp;&nbsp;��ǰ�� : <FONT  COLOR="#0000ff"><?=$name?></FONT><?
								}
								if($company)
								{
									?> &nbsp;&nbsp;&nbsp;������ : <FONT  COLOR="#0000ff"><?=$company?></FONT><?
								}
								if($model)
								{
									?> &nbsp;&nbsp;&nbsp;�� : <FONT  COLOR="#0000ff"><?=$model?></FONT><?
								}
								if($price)
								{
									?> &nbsp;&nbsp;&nbsp;���� : <FONT  COLOR="#0000ff"><?=$price?></FONT><?
								}
								if($category)
								{
									?> &nbsp;&nbsp;&nbsp;�з� : <FONT  COLOR="#0000ff"><?=$cate_row[name]?></FONT><?
								}
								?><?=$sortCode?></td>
							</tr><?
							}
							else
							{
								?>
							<tr>
								<td  height="30" bgcolor='f7f7f7' style='padding:0 0 0 15'><img src='image/sub/search_code.gif' align='absmiddle'> &nbsp;&nbsp;&nbsp;���� �� <?=$search_str?> : <FONT  COLOR="#e10000"><b><?=$searchstring?></b></FONT> '<?=$sortCode?>(��)�� �˻��ϼ̽��ϴ�.</td>
							</tr><?
							}
							?>
						</table>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
							<form name="sortForm" method="post" action="search_result.php">
							<input type="hidden" name="sort"><!-- ���Ĺ�� ex)asc:��������  desc:�������� -->
							<input type="hidden" name="sortStr"><!-- ���ı��� ex)name:�̸�  price:���� -->
							<input type="hidden" name="name" value="<?=$name?>"><!-- ��ǰ�� -->
							<input type="hidden" name="price" value="<?=$price?>"><!-- ���� -->
							<input type="hidden" name="company" value="<?=$company?>"><!-- ȸ�� -->
							<input type="hidden" name="category" value="<?=$category?>"><!-- �з� -->
							<input type="hidden" name="detail" value="<?=$detail?>"><!-- �˻���� ex) 1:�󼼰˻� 0:�Ϲݰ˻� -->
							<input type="hidden" name="data" value="<?=$sortData?>">
							<tr>
								<td height="40" colspan="<?=$GOODS_LIST_COL?>">
									<table width="650" border="0" cellspacing="0" cellpadding="0" align='center'>
										<tr>
											<td><font color="#003366">�� <B><?=$total_page_cnt?></B> �������� <B><?=$numrows?></B> ���� ��ǰ�� �غ�Ǿ� �ֽ��ϴ�.</font></td>
											<td height="30" width="141"> <select name="sortIndex" onChange="javascript:goodsSort();"><option value="0">��ǰ���ı��� ����</option><option value="1">�̸�����</option><option value="2">�̸�����</option><option value="3">���ݼ���</option><option value="4">���ݼ���</option></select></td>
										</tr>
									</table>
								</td>
							</tr>
							</form>
							<tr>
								<td bgcolor='e1e1e1' height="1" colspan="<?=$GOODS_LIST_COL?>"></td>
							</tr>
							<tr valign="bottom"><?
							$designType = $design_goods[designType];
							include "goods_show_inc.php";
							$optionStr = "position=$position&sort=$sort&sortStr=$sortStr&detail=$detail";
							$optionStr.= "&name=$name&company=$company&price=$price&category=$category";
							$Obj=new CList("search_result.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,$optionStr);
							?>
							</tr>
							<tr valign="bottom">
								<td colspan="4" height="50" align="center"><?$Obj->putList(true,"<img src='image/board/btn_prev.gif'>","<img src='image/board/btn_next.gif'>");//�������� ����Ʈ?></td>
							</tr>
						</table><?
						}
						else
						{
							if($search =="name")			$search_str ="��ǰ��";
							else if($search =="price")	$search_str ="����";
							else if($search =="company")	$search_str ="������";
							if($sort)
							{
								$sort_str =($sort =="asc") ?  "��" : "��";
								$sortStr_str =($sortStr =="name") ? "�̸���" : "���ݼ�";
								$sortCode = "<br><B>���ı���</B> &nbsp;&nbsp;&nbsp;<FONT  COLOR='#0000ff'>$sortStr_str $sort_str</FONT>";
							}
							else
							{
								$sortCode="";
							}
							?>
						<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height="90" colspan="3">
									<table width='650' border='0' cellpadding='0' cellspacing='1' align='center' bgcolor='e1e1e1'><?
									if($detail)
									{
										//�󼼰˻�
										?>
										<tr>
											<td  height="30" bgcolor='f7f7f7' style='padding:0 0 0 15'><img src='image/sub/search_code.gif' align='absmiddle'>&nbsp;&nbsp;���� '<?
											if($name)
											{
												?>��ǰ�� : <FONT  COLOR="#e10000"><b><?=$name?></b></FONT><?
											}
											if($company)
											{
												?> / ������ : <FONT  COLOR="#e10000"><b><?=$company?></b></FONT><?
											}
											if($price)
											{
												?> / ���� : <FONT  COLOR="#e10000"><b><?=$price?></b></FONT><?
											}
											if($maxCate)
											{
												?> / �з� : <FONT  COLOR="#e10000"><b><?=$maxCate_row[name]?></b></FONT><?
											}
											?><?=$sortCode?>' (��)�� �˻��ϼ̽��ϴ�.</td>
										</tr><?
									}
									else
									{
										?>
										<tr>
											<td  height="35" bgcolor='f7f7f7' style='padding:0 0 0 15'><img src='image/sub/search_code.gif' align='absmiddle'> &nbsp;&nbsp;&nbsp;���� ��<?=$search_str?> : <FONT  COLOR="#e10000"><b><?=$searchstring?></b></FONT> '<?=$sortCode?>(��)�� �˻��ϼ̽��ϴ�.</td>
										</tr><?
									}
									?>
									</table></font></b></div><br><br>
									<table width='650' border='0' cellpadding='0' cellspacing='0' align='center'>
										<tr>
											<td align='center'><img src='image/sub/search_result.gif'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="3" height='40'><div align="center"><a href="detail_search.php"><img src="image/index/search_001.gif" border="0"></a></div></td>
							</tr>
						</table><?
						}
						?><br>
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