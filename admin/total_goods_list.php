<?
include "head.php";
if ($margin_process)//��ϵ� ��ü��ǰ�� ��ϵǾ� �ִ� �ǸŰ�,���ް� �������� �������� �ڵ��Է� 
{
	$result = $MySQL->query("SELECT idx,price,supplyprice from goods");
	while ($row = mysql_fetch_array($result))
	{
		$mj = round((($row[price]-$row[supplyprice])/$row[price])*100);
		$MySQL->query("UPDATE goods SET margin='$mj' where idx=$row[idx]");
	}
	echo "<script>
	if (confirm('�Ϸ��Ͽ����ϴ�. �������� ���ΰ�ħ �մϴ�.'))
	{
		location.href='total_goods_list.php';
	}
	else location.href='total_goods_list.php';
	</script>";
	exit;
}
if($code && !$search_category) $search_category = $code;
include "linkstr_goods.php";
$postrArr = Array("��ü","���� ����Ʈ","���� ��Ʈ","���� �ű�");
$category_result = $MySQL->query("select name,code from category");
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//�˻� ���� ����
function searchSendit()
{
	var form = document.searchForm;
	if(form.search.selectedIndex==1 && !numCheck(form.searchstring.value))
	{
		alert("�˻��ϰ��� �ϴ� ������ �ùٸ��� �ʽ��ϴ�.");
		form.searchstring.focus();
		return false;
	}
	else
	{
		return true;
	}
}

function list_edit(obj)
{
	<? if ($admin_row[beditprice_warn]=="y"){ ?>
	var last_price = obj.lastprice.value;
	var diff_price = obj.pricebox.value - last_price;
	var warn_price = <?=$admin_row[editprice_warn]?>;
	if (diff_price<0) diff_price = diff_price * (-1);
	if (diff_price >= warn_price)
	{
		if (confirm("�������� "+warn_price+"�� �̻� ���̰� ���ϴ�. �����Ͻðڽ��ϱ�?"))
		{
			obj.target = "ifrm";
			obj.submit();
		}
	}
	else
	{
		if (confirm("��ϻ��� ���������� �ݿ��Ͻðڽ��ϱ�?"))
		{
			obj.target = "ifrm";
			obj.submit();
		}
	}
	<? }else { ?>
	if (confirm("��ϻ��� ���������� �ݿ��Ͻðڽ��ϱ�?"))
	{
		obj.target = "ifrm";
		obj.submit();
	}
	<? } ?>
}

function bLimit_change(Obj,cnt)
{
	if (Obj.bLimit.selectedIndex==1)	
	{
		eval("document.all.limitCnt_id"+cnt).style.display="block";
	}
	else  eval("document.all.limitCnt_id"+cnt).style.display="none";
}

function list_num_set(list_num)
{
	location.href="total_goods_list.php?<?=$LINK_STR?>&list_num="+list_num;
}

function checkAll()
{
	var str="";
	for (var i=0; i<document.forms.length; i++)
	{
		var formname = document.forms[i].name;
		var formname_str = formname.substring(0,13);
		if (formname_str == "goodtype_form")
		{
			for (var j=0;j<document.forms[i].elements.length;j++)
			{
				if (document.forms[i].elements[j].name == "idxno")
				{
					if (document.forms[i].elements["idxno"].checked == true)
					{
						document.forms[i].elements["idxno"].checked = false;
						str="";
					}
					else
					{
						document.forms[i].elements["idxno"].checked = true;
						str = document.forms[i].elements["idxno"].value + "/" + str;
					}
				}
			}
		}
	}
	document.viewForm.select_str.value = str;
}

function idxno_click(f)
{
	if(f.idxno.checked)
	{
		var str= document.viewForm.select_str.value;
		str = f.idxno.value + "/" + str;
		document.viewForm.select_str.value = str;
	}
	else ////////// üũ������ �ش� ���� ���� ( '/' ���ڿ� üũ) 
	{
		var str="";
		var formno="";
		var transnum_str="";
		for (var i=0; i<document.forms.length; i++)
		{
			var formname = document.forms[i].name;
			var formname_str = formname.substring(0,13);
			if (formname_str == "goodtype_form")
			{
				for (var j=0;j<document.forms[i].elements.length -1 ;j++)
				{
					if (document.forms[i].elements[j].name == "idxno")
					{
						if (document.forms[i].elements["idxno"].checked == true)
						{
							str = document.forms[i].elements["idxno"].value + "/" + str;
						}
						else 
						{
						}
					}
				}
			}
		}
		document.viewForm.select_str.value = str;
	}
}

function selectAll_del()
{
	if(document.viewForm.select_str.value=="")
	{
		alert("��ǰ�� �����ϼ���.");
	}
	else
	{
		if (confirm("������ ��ǰ�� �����Ͻðڽ��ϱ�?"))
		{
			location.href="goods_edit_ok.php?returnPage=total_goods_list.php&data=<?=$data?>&<?=$LINK_STR?>&selectAll_del=1&str="+document.viewForm.select_str.value;
		}
	}
}

function selectAll_move(val,part)
{
	var gd_set = "<?=$admin_row[bGdset]?>";
	if(document.viewForm.select_str.value=="")
	{
		alert("��ǰ�� �����ϼ���.");
	}
	else if(document.all.search_category3.value=="")
	{
		alert("ī�װ��� �����ϼ���.");
	}
	else if (gd_set=="n")
	{
		alert("��ǰ�������� �̹������縦 ���� PHP GD �� ����ؾ߸� �մϴ�. \n�⺻���� - ��Ÿ�������� GD��뿩�θ� Ȯ�����ּ���.");
	}
	else
	{
		location.href="goods_move.php?returnPage=total_goods_list.php&<?=$LINK_STR?>&all_move=1&change_code="+val+"&str="+document.viewForm.select_str.value+"&part="+part;
	}
}

function tg_show(cnt)
{
	obj = eval("document.getElementById('tgood_id"+cnt+"')");
	td_obj = eval("document.getElementById('td_"+cnt+"')");
	if (obj.style.display == "block")
	{
		obj.style.display = "none";
		td_obj.innerHTML = "��";
	}
	else if (obj.style.display == "none")
	{
		obj.style.display = "block";
		td_obj.innerHTML = "<font color=red>��</font>";
	}
}

function margin_check(form) ///������ ����� ���ް�����
{
	var form= form;
	if (form.pricebox.value != "" && form.pricebox.value != 0)
	{
		var price = parseInt(form.pricebox.value);
		var margin = form.margin.value;
		var supplyprice =  Math.round(price-(price*(margin*0.01)));
		form.supplyprice.value = supplyprice;
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<iframe name="ifrm" width=0 frameborder=0 height=0></iframe>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "goods";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	$CATE_SEARCH_STR =" and category='$search_category' ";
	$data=Decode64($data);
	$pagecnt=$data[pagecnt];
	$letter_no=$data[letter_no];
	$offset=$data[offset];
	$new_str = SearchCheck($searchstring); // �˻�� ������ �빮�ڷ� �ٲ� ���ڿ� 
	if(!$searchstring)
	{
		$search=$data[search];
		$searchstring=$data[searchstring];
	}
	if($searchstring)
	{
		if($search=="price")
		{
			$searchLen = (strlen($searchstring) -1)*-1;
			$searchstring = round($searchstring,$searchLen);
			$total_qry ="select * from goods where truncate(price,$searchLen) = $searchstring ";
		}
		else
		{
			$total_qry.="select * from goods where ($search like '%$searchstring%' or upper($search) like '%$new_str%') $MALL_STR";
		}
	}
	else
	{
		$total_qry ="select * from goods where 1=1 $MALL_STR ";
	}
	if($search_category)  $total_qry.=" $CATE_SEARCH_STR ";
	if($etc)
	{
		if($etc=="delay")  $total_qry.=" and bLimit=3 ";
		else if($etc=="delay2")  $total_qry.=" and bLimit=4 ";
		else if($etc=="stock") $total_qry.=" and ((bLimit=1 and limitCnt=0) or (bLimit=2)) ";
		else if($etc=="relation") $total_qry.=" and relation<>'' ";
	}
	if($size) $total_qry.=" and size='$size' ";
	if($best) $total_qry = "select goods.* from goods,position where goods.idx=position.goodsIdx and position.part='mainbest' ";
	if($hit) $total_qry = "select goods.* from goods,position where goods.idx=position.goodsIdx and position.part='mainhit' ";
	if($new) $total_qry = "select goods.* from goods,position where goods.idx=position.goodsIdx and position.part='mainnew' ";
	$numresults=$MySQL->query($total_qry);
	$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
	if (!$list_num) $LIMIT =$admin_row[goods_list_cnt]; 
	else $LIMIT		=$list_num;		//�������� �� ��
	$PAGEBLOCK	=10;				//���� ������ ��
	$total_page = ceil($numrows / $LIMIT);
	if($pagecnt==""){$pagecnt=0;}			//������ ��ȣ 
	if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
	if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
	$goods_qry = $total_qry;
	if($sort)     	$goods_qry.= " order by $sortStr $sort ";
	else			$goods_qry.= " order by idx desc";
	$goods_qry.= " limit $offset,$LIMIT";
	$goods_result=$MySQL->query($goods_qry);
	$s_letter=$letter_no;								//�������� ���� �۹�ȣ
	?>
		<td width="85%" valign="top" height="400">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='left'>
							<tr>
								<td rowspan="3" width="200"><img src="image/good_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='left'><font class='text1'>SHOP ��ǰ��� ���� ���� ���� �ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="left">
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/good_list_tit.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan="2" height="2" bgcolor='f5f5f5'>
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height="40" bgcolor="#F5F5F5">
												<form name="searchForm" method="post"  onSubmit="return searchSendit();" action="total_goods_list.php">
												<table width="100%" border="0" bgcolor="#FAFAFA" align="center">
													<tr bgcolor="#F5F5F5">
														<td align="left">&nbsp;<select name="search_category"><option value="0">��ī�װ�</option><?
														$qry = "select code,name from category order by position asc";
														$max_result = $MySQL->query($qry);
														while($max_row = mysql_fetch_array($max_result))
														{
															$deep_nbsp .="";
															$deep_zero_style="style=\"background-color:#F6B7F8\"";
															?><option value="<?=$max_row[code]?>" <? if ($search_category==$max_row[code]) echo "selected";?> <?=$deep_zero_style?>><?=$deep_nbsp?><?=$max_row[name]?></option><?
														}
														?></select>&nbsp;&nbsp;&nbsp;<select name="search"><option value="name" <? if ($search=="name") echo "selected";?>>��ǰ��</option><option value="price" <? if ($search=="price") echo "selected";?>>�� ��</option><option value="company" <? if ($search=="company") echo "selected";?>>������</option><option value="code" <? if ($search=="code") echo "selected";?>>��ǰ�ڵ�</option></select> <input class="box" type="text" name="searchstring" size="15"> <input type="image"src="image/bbs_search_btn.gif" width="41" height="23" border="0"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2" height="2">
												<table width="770" border="0" cellspacing="0" cellpadding="0" align="left">
													<tr>
														<td height="40" bgcolor="#F5F5F5">
															<table width="100%" border="0" bgcolor="#FAFAFA" align="center">
																<tr bgcolor="#F5F5F5">
																	<td>&nbsp;<select name="etc"><option value="0">����Ÿ����</option><option value="delay" <? if ($etc=="delay") echo "selected";?>>�����Ȼ�ǰ</option><option value="delay2" <? if ($etc=="delay2") echo "selected";?>>�����Ȼ�ǰ</option><option value="stock" <? if ($etc=="stock") echo "selected";?>>ǰ���Ȼ�ǰ</option><option value="relation" <? if ($etc=="relation") echo "selected";?>>���û�ǰ</option></select> <select name="size"><option value="0">����۱���</option><option value="N" <? if ($size=="N") echo "selected";?>>������</option> </select> <a href="total_goods_list.php?best=1"><img src="image/good_position_m01.gif" border=0></a> <a href="total_goods_list.php?hit=1"><img src="image/good_position_m02.gif" border=0></a> <a href="total_goods_list.php?new=1"><img src="image/good_position_m03.gif" border=0></a></td>
																	<td align=left><a href="total_goods_list_excel.php?<?=$LINK_STR?>"><img src="image/excel_down.gif"></a></td>
																</tr>
																</form><!-- searchForm -->
															</table><hr>
															<table width="100%" border="0" bgcolor="#FAFAFA" align="left">
															<form name="cateForm" method="post" action="goods_write.php">
															<input type="hidden" name="catename" value="<?=$row[name]?>">
																<tr bgcolor="#F5F5F5">
																	<td align="left"><iframe src="frame_category.php?write_code=<?=$write_code?>&code=<?=$search_category?>" width="90%" frameborder=0 height=50 marginheight=0 margintop=0 scroll=0 scrolling=no></iframe></td>
																</tr>
															</table>
															</form>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<SCRIPT LANGUAGE="JavaScript">
										<!--
										//���� ����   (���ı���,���)
										function Sort(sortStr,sort)
										{
											var form=document.sortForm;
											form.sort.value		=sort;
											form.sortStr.value	=sortStr;
											form.submit();
										}
										//-->
										</SCRIPT><?
										$encode_str = "pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
										$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
										$sortData=Encode64($encode_str);					//�� ���ڵ� ����
										?>
										<form name="sortForm" method="post" action="total_goods_list.php?<?=$LINK_STR?>">
										<input type="hidden" name="sort"><!-- ���Ĺ�� ex)asc:��������  desc:�������� -->
										<input type="hidden" name="sortStr"><!-- ���ı��� ex)name:�̸�  price:���� -->
										<input type="hidden" name="position" value="<?=$position?>"><!-- ��ġ -->
										<input type="hidden" name="data" value="<?=$sortData?>">
										</form>
										<form name="viewForm" method="post">
										<input type="hidden" name="select_str" value="">
										</form>
										<tr valign="middle">
											<td height="20" valign="top" colspan="2"><br><font color="blue">��� ��¼� <select name="list_num" onchange="list_num_set(this.value);"><?
											if (!$list_num)
											{
												for ($i=10; $i<500; $i=$i+10)
												{
													?><option value="<?=$i?>" <? if ($i==$admin_row[goods_list_cnt]) echo "selected";?>>��<?=$i?></option><?
												}
											}
											else
											{
												for ($i=10; $i<500; $i=$i+10)
												{
													?><option value="<?=$i?>" <? if ($i==$list_num) echo "selected";?>>��<?=$i?></option><?
												}
											}
											?><option value="<?=$admin_row[goods_list_cnt]?>"><?=$admin_row[goods_list_cnt]?></option></select>&nbsp;&nbsp;&nbsp;&nbsp;������ ��ǰ�� <img src="image/delete_btn.gif" onclick="selectAll_del();" style="cursor:pointer"> &nbsp;������ ��ǰ�� <select name="search_category3" id="search_category3"><option value="">��ī�װ�����</option><?
											$qry = "select code,name from category order by position asc";
											$max_result = $MySQL->query($qry);
											while($max_row = mysql_fetch_array($max_result))
											{
												$deep_nbsp .="";
												$deep_zero_style="style=\"background-color=#F6B7F8\"";
												?><option value="<?=$max_row[code]?>" <? if ($search_category==$max_row[code]) echo "selected";?> <?=$deep_zero_style?>><?=$deep_nbsp?><?=$max_row[name]?></option><?
											}
											?></select> <img src="image/goods_view_copy2.gif" onclick="selectAll_move(document.all.search_category3.value,'copy2');" style="cursor:pointer"></font></td>
										</tr>
										<tr valign="middle">
											<td valign="top" colspan="2">
												<table width="830" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor='cdcdcd'>
													<tr valign="middle">
														<td width="25" height="30" bgcolor="#EBEBEB"> <div align="center">NO</div></td>
														<td width="25" height="30" bgcolor="#EBEBEB"> <div align="center"><input type="checkbox" onclick="checkAll();"></a></div></td>
														<td width="80" height="30" bgcolor="#EBEBEB"> <div align="center">��Ÿ����</div></td>
														<td width="200" height="30" bgcolor="#EBEBEB"> <div align="center">��ǰ�� <a href="javascript:Sort('name','asc');">��</a> <a href="javascript:Sort('name','desc');">��</a></div></td>
														<td width="50" height="30" bgcolor="#EBEBEB"> <div align="center">����Ʈ</div></td>
														<td width="80" height="30" bgcolor="#EBEBEB"> <div align="center">�ǸŰ� <br><a href="javascript:Sort('price','asc');">��</a> <a href="javascript:Sort('price','desc');">��</a></div></td>
														<td width="80" height="30" bgcolor="#EBEBEB"> <div align="center">���ް�</div></td>
														<td width="70" height="30" bgcolor="#EBEBEB"> <div align="center">��������</div></td>
														<td width="120" height="30" bgcolor="#EBEBEB"> <div align="center">������</div></td>
														<td width="80" height="30" bgcolor="#EBEBEB"> <div align="center">������ <br><a href="javascript:Sort('editday','asc');">��</a> <a href="javascript:Sort('editday','desc');">��</a></div></div></td>
														<td width="80" height="30" bgcolor="#EBEBEB"> <div align="center">����� <br><a href="javascript:Sort('writeday','asc');">��</a> <a href="javascript:Sort('writeday','desc');">��</a></div></div></div></td>
														<td width="100" height="30" bgcolor="#EBEBEB"> <div align="center">ī�װ�</div></td>
													</tr><?
													$cnt=0;
													while($goods_row=mysql_fetch_array($goods_result))
													{
														$cnt++;
														$encode_str = "idx=".$goods_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
														$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
														$data=Encode64($encode_str);
														//ī�װ� ����
														$cate_row = $MySQL->fetch_array("select name from category where code='$goods_row[category]' limit 1");
														$category = $cate_row[name];
														//��ǰ������
														$comment_num = $MySQL->articles("select *from goods_comment where gidx=$goods_row[idx]");
														if ($admin_row[bNew])
														{
															$bNew = limitday($goods_row[writeday],$admin_row[new_day]);
															if (empty($bNew) && $goods_row[bNew]) $bNew = "<img src=../upload/goods_new_img>";
														}
														if ($bNew == "<img src=upload/goods_new_img>")  $bNew = "<img src=../upload/goods_new_img>";
														if($goods_row[bHit]) $bHit ="<img src='../upload/goods_hit_img'>";
														else				   $bHit ="";
														if($goods_row[bEtc]) $bEtc ="<img src='../upload/goods_etc_img' >";
														else				   $bEtc ="";
														if($goods_row[bLimit]==1)  $limitCnt_display = "block";
														else $limitCnt_display = "none";
														if ($goods_row[partName1] || $goods_row[partName2] || $goods_row[partName3])  $option_img = "<img src=../admin/image/option.gif>";
														else $option_img = "";
														?>
													<form name="goodtype_form<?=$cnt?>" method="post" action="goods_edit_ok.php?listedit=1&<?=$LINK_STR?>&data=<?=$data?>">
													<tr valign="middle" bgcolor="ffffff">
														<td height="25"><div align="center"><?=$letter_no?></div></td>
														<td><div align="center"><input type="checkbox" name="idxno" value="<?=$goods_row[idx]?>" onclick="idxno_click(this.form)"></div></td>
														<td id="td_<?=$cnt?>" align="center" onclick="tg_show(<?=$cnt?>);" style="cursor:pointer" onMouseOver="this.style.backgroundColor='#F9F9CF'" onMouseOut="this.style.backgroundColor=''"> �� </td>
														<td width="200" align="center"  onMouseOver="this.style.backgroundColor='#F9F9CF'" onMouseOut="this.style.backgroundColor=''"> <a href="goods_edit.php?data=<?=$data?>&returnPage=total_goods_list.php&<?=$LINK_STR?>"><font color="##000084"><u><?=$goods_row[name]?></u></font></a><br><?=$bHit?><?=$bNew?><?=$bEtc?><?=$option_img?></td>
														<td> <div align="center"><input type="text" class="box" name="point" value="<?=$goods_row[point]?>" size="5" <?=__ONLY_NUM?>></div></td>
														<td> <div align="center"><input type=text class=box name=pricebox value="<?=$goods_row[price]?>" size=8 <?=__ONLY_NUM?> onchange="margin_check(document.goodtype_form<?=$cnt?>)"></div></td>
														<td> <div align="center">���� <input type="text" class="box" name="margin" value="<?=$goods_row[margin]?>" size=2 onchange="margin_check(document.goodtype_form<?=$cnt?>)"> %<br><input type="text" class="nonbox" name="supplyprice" value="<?=$goods_row[supplyprice]?>" size="8" <?=__ONLY_NUM?> readonly style="background-color:#DDDDDD"></div></td>
														<td height="25" > <div align="center"><a href="#;" onclick="javascript:list_edit(document.goodtype_form<?=$cnt?>);"><img src='image/edit2.gif' border='0'></a></div></td>
														<td height="25" align="center">
															<table>
																<tr>
																	<td id="limitCnt_id<?=$cnt?>" style="display:<?=$limitCnt_display?>"><input type=text name=limitCnt value="<?=$goods_row[limitCnt]?>" size=3></td>
																	<td> <select name="bLimit" onchange="bLimit_change(document.goodtype_form<?=$cnt?>,<?=$cnt?>);">
																	<option value=0 <? if ($goods_row[bLimit]==0) {echo "selected"; }?>>������</option>
																	<option value=1 <? if ($goods_row[bLimit]==1) {echo "selected"; }?> style="background-color:#F9FCAD">����</option>
																	<option value=2 <? if ($goods_row[bLimit]==2) {echo "selected"; }?> style="background-color:#FBE6E6">ǰ��</option>
																	<option value=3 <? if ($goods_row[bLimit]==3) {echo "selected"; }?> style="background-color:#FCACAC">����</option>
																	<option value=4 <? if ($goods_row[bLimit]==4) {echo "selected"; }?> style="background-color:#F86E6E">����</option>
																	</select></td>
																</tr>
															</table>
														</td>
														<td height="25" > <div align="center"><?=Substr($goods_row[editday],2,8)?>&nbsp;</div></td>
														<td height="25" > <div align="center"><?=Substr($goods_row[writeday],2,8)?>&nbsp;</div></td>
														<td height="25" width="100"> <div align="center"><?=$category?>&nbsp;</div></td>
													</tr>
													<tr>
														<td colspan="12" bgcolor="ffffff" align="center">
															<table width="570" border="1" cellspacing="0" cellpadding="0" class="table_coll" id="tgood_id<?=$cnt?>" style="display:none">
																<tr>
																	<td width="120" height="30" bgcolor="#EBEBEB"> <div align="center">������</div></td>
																	<td width="100" height="30" bgcolor="#EBEBEB"> <div align="center">��۱���</div></td>
																	<td width="150" height="30" bgcolor="#EBEBEB"> <div align="center">������ ���</div></td>
																	<td width="100" height="30" bgcolor="#EBEBEB"> <div align="center">��������</div></td>
																</tr>
																<tr bgcolor="#F9CFF8">
																	<td height="25" align="center"> <?=PriceFormat($goods_row[lastprice])?></div> <input type="hidden" name="lastprice" value="<?=$goods_row[lastprice]?>"></td>
																	<td height="25" > <div align="center"><select name="size"><option value="0">����۱���</option><option value="N" style="background-color:#B1D9F8;" <? if ($goods_row[size]=="N") echo "selected";?>>������</option></select></div></td>
																	<td height="25" > <div align="center"><?
																	if($goods_row[bHit])	$bHit = "checked";
																	else					$bHit = "";
																	if($goods_row[bNew])	$bNew = "checked";
																	else					$bNew = "";
																	if($goods_row[bEtc])	$bEtc = "checked";
																	else					$bEtc = "";
																	?>��Ʈ <input class="radio" type="checkbox" name="bHit" value="1" <?if(!$admin_row[bHit]){?>disabled<?}?> <?=$bHit?>>��Ÿ <input class="radio" type="checkbox" name="bEtc" value="1" <?if(!$admin_row[bEtc]){?>disabled<?}?> <?=$bEtc?>></div></td>
																	<td height="25" > <div align="center"><a href="#;" onclick="javascript:list_edit(document.goodtype_form<?=$cnt?>);"><img src='image/edit2.gif' border='0'></a></div></td>
																</tr>
															</table>
														</td>
													</tr>
													</form><?
														$letter_no--;
													}
													include "../lib/class.php";
													$optionStr = "sort=$sort&sortStr=$sortStr&etc=$etc&position=$position&search_category=$search_category&searchstring=$searchstring&search=$search&size=$size&list_num=$list_num";
													$Obj=new CList("total_goods_list.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,$optionStr);
													$pre_icon_img="<img src='image/pre_btn.gif' width='40' height='17' border='0'>";		//����������
													$next_icon_img="<img src='image/next_btn.gif' width='40' height='17' border='0'>";	//����������
													?>
													<tr valign="middle">
														<td colspan="12">
															<table width="100%" border="0" bgcolor="#FFFFFF" align="center">
																<tr bgcolor="#FFFFFF">
																	<td width=30%>�� ������ : <?=$total_page?> / �� ��ǰ�� : <?=$numrows?>�� </td>
																	<td><font color="#0099CC"><?$Obj->putList(true,$pre_icon_img,$next_icon_img);//�������� ����Ʈ?></font></td>
																</tr>
																<tr>
																	<td colspan="2">��ϵ� ��ü��ǰ�� ��ϵǾ� �ִ� �ǸŰ�,���ް� �������� �������� �ڵ��Է�<input type="button" value="�� ��" class="button" onclick="location.href='total_goods_list.php?margin_process=1'"></td>
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