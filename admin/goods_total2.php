<?
session_cache_limiter("no-cache, must-revalidate");
include "head.php";
$dataArr=Decode64($data);
$pagecnt=$dataArr[pagecnt];
$offset=$dataArr[offset];
if($dataArr[searchstring]) $searchstring=$dataArr[searchstring];
if ($searchstring)
{
	$total_qry ="select * from goods where name like '%$searchstring%' $MALL_STR";
}
else
{
	$total_qry ="select * from goods where 1=1 $MALL_STR";
}
$numresults=$MySQL->query($total_qry);
$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
$LIMIT		=10;								//�������� �� ��
$PAGEBLOCK	=10;								//���� ������ ��
if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
$goods_qry = $total_qry;
if($sort) $goods_qry.= " order by $sortStr $sort ";
else $goods_qry.= " order by idx desc ";
$goods_qry.=" limit $offset,$LIMIT";
$goods_result=$MySQL->query($goods_qry);
$s_letter=$letter_no;								//�������� ���� �۹�ȣ
?>
<!-- -----------------------------------��ǰ ���� ��� �� ����-------------------------------------------------------------- -->
<SCRIPT LANGUAGE="JavaScript">
<!--
function select_goods(idx)
{
	if (parent.document.relationForm.relation.value == "")
	{
		parent.document.relationForm.relation.value = idx +"/";
	}
	else
	{
		parent.document.relationForm.relation.value = parent.document.relationForm.relation.value +idx+"/";
	}
	complete();
}
function complete()
{
	<? if ($part=="write")  { ?> ///��ǰ��Ͻÿ��� DB������Ʈ ���ϴ� ��� ���� 
	alert("���õǾ����ϴ�.");
	parent.document.relationForm.action = "goods_relation.php?write_update=1&part=<?=$part?>";
	parent.document.relationForm.submit();
	<? }else{ ?>
	parent.document.relationForm.data.value = "<?=$data?>";
	parent.document.relationForm.action = "goods_relation.php?update=1";
	parent.document.relationForm.submit();
	<? } ?>
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#000000">
<?
$encode_str = "pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
$sortData=Encode64($encode_str);					//�� ���ڵ� ����
?>
<table width="450" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table width="450" border="0" cellspacing="0" cellpadding="0">  
				<tr>
					<td>
						<form name="searchform" method="post" action="goods_total2.php?part=<?=$part?>">
						<input type="hidden" name="code" value="<?=$code?>"><!-- �з� -->
						<table border=0>
							<tr>
								<td width="50">��ǰ��</td>
								<td width="120"><input class="box" type="text" name="searchstring" size="20"></td>
								<td width="50"><input type="image" src="image/bbs_search_btn.gif" border=0></td>
							</tr>
							<tr>
								<td colspan=3><font color="#999999">�� ��ǰŬ���ø��� ���û�ǰ���� ��ϵ˴ϴ�.</font></td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr><?
	if($numrows)
	{
		?>
	<tr>
		<td>
			<table width="450" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="60"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ǰ</div></td>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="110"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �з���</div></td>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="180"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ǰ�� <a href="javascript:Sort('name','asc');">��</a><a href="javascript:Sort('name','desc');">��</a></div></td>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="100"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ����� <a href="javascript:Sort('writeday','asc');">��</a><a href="javascript:Sort('writeday','desc');">��</a></div></td>
				</tr>
				<tr>
					<td height="1" colspan="4" background="image/line_bg1.gif"></td>
				</tr><?
				while($goods_row=mysql_fetch_array($goods_result))
				{
					$encode_str = "idx=".$goods_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
					$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
					$data=Encode64($encode_str);					//�� ���ڵ� ����
					//ī�װ� ����
					$cate_row = $MySQL->fetch_array("select *from category where code='$goods_row[category]'");
					$str_category = $cate_row[name];
					?>
				<tr valign="middle" bgcolor="fafafa" style='cursor:pointer;' onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor=''"  onclick="javascript:select_goods('<?=$goods_row[idx]?>');"><?
					if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
					else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
					else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
					else $img_str = $goods_row[img1];
					?>
					<td height="45"  width="60"> <div align="center"><img src="../upload/goods/<?=$img_str?>" width="40" height="40"></div></td>
					<td height="45"  width="110"> <div align="center"><b><?=$str_category?></b></div></td>
					<td height="45" width="180"> <div align="center"><?=$goods_row[name]?></div></td>
					<td height="45" width="100"> <div align="center"><?=str_replace("-","/",substr($goods_row[writeday],0,10))?><br><?=substr($goods_row[writeday],11,8)?></div></td>
				</tr>
				<tr>
					<td height="1" colspan="4" background="image/line_bg1.gif"></td>
				</tr><?
					$letter_no--;
				}
				include "../lib/class.php";
				$optionStr = "part=$part";
				$Obj=new CList("goods_total2.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,$optionStr);
				$pre_icon_img="<img src='image/pre_btn.gif' width='40' height='17' border='0'>";		//����������
				$next_icon_img="<img src='image/next_btn.gif' width='40' height='17' border='0'>";	//����������
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50">
			<table width="100%" border="0" align="center">
				<tr>
					<td align="center"><?$Obj->putList(true,$pre_icon_img,$next_icon_img);//�������� ����Ʈ?></td>
				</tr>
			</table>
		</td>
	</tr><?
	}
	else
	{
		?>
	<tr>
		<td height="50">
			<table width="100%" border="0" align="center">
				<tr>
					<td><FONT COLOR="#993300">- ����� ��ǰ�� �����ϴ�.</FONT></td>
				</tr>
			</table>
		</td>
	</tr><?
	}
	?>
</table>
</body>
</html>