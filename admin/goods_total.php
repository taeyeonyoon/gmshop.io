<?
include "head.php";
$hide_result = $MySQL->query("SELECT code from category WHERE bHide=1");
while ($hide_row = mysql_fetch_array($hide_result))
{
	if (empty($cnt))  $HIDE_QRY.= " and (category<>'$hide_row[code]'";
	else 		  $HIDE_QRY.= " and category<>'$hide_row[code]'";
	$cnt++;
}
if ($cnt) $HIDE_QRY.=")";
if ($searchstring)
{
	$total_qry ="select * from goods where name like '%$searchstring%' $HIDE_QRY";
}
else
{
	if(empty($category))
	{
		$total_qry ="select * from goods where 1=1 $HIDE_QRY";
	}
	else
	{
		$total_qry ="select * from goods where 1=1 $HIDE_QRY and category='$category'";
	}
}
$numresults=$MySQL->query($total_qry);
$numrows=mysql_num_rows($numresults);				//�� ���ڵ��..
$LIMIT		=10;								//�������� �� ��
$PAGEBLOCK	=10;								//���� ������ ��
$data=Decode64($data); 
if ($data[offset]) $offset=$data[offset];
if ($data[pagecnt]) $pagecnt=$data[pagecnt];
$letter_no=$data[letter_no];
if($pagecnt==""){$pagecnt=0;}						//������ ��ȣ 
if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} //�� �������� ���� ��  
if(!$letter_no){$letter_no=$numrows;}				//�۹�ȣ
$goods_qry = $total_qry;
if($sort) $goods_qry.= " order by $sortStr $sort ";
else $goods_qry.= " order by idx desc ";
$goods_qry.=" limit $offset,$LIMIT";
$goods_result=$MySQL->query($goods_qry);
$s_letter=$letter_no;								//�������� ���� �۹�ȣ
////////////goods_position.php �� �ִ� �ҽ�//////////////////////
////////////��ϻ�ǰ�� ������ ���� ������//////////////////////// 
$mainbestLimit = $design[mainBestGoodsW] * $design[mainBestGoodsH];
$mainhitLimit  = $design[mainHitGoodsW] * $design[mainHitGoodsH];
$positionStr	= Array("","���� ����Ʈ","���� ��Ʈ","���� �ű�","����Ʈ(��)","����Ʈ","�ű�","�����ϴ�");
$positionLimit	= Array(0,$mainbestLimit,$mainhitLimit,$design[mainNewGoodsList],1,4,20,10); //�з��� ��� �Ѱ�
if(empty($category))
{
	$presentQry = "select *from position where part='$part'";
	$presentPocnt = $MySQL->articles($presentQry);
}
else
{
	$qry = "SELECT *from position WHERE category='$category' and part='$part'";
	$presentPocnt = $MySQL->articles($qry);
}
if($part=="recommend") $positionIndex = 4;
else if($part=="best") $positionIndex = 5;
else		       $positionIndex = $position;
?>
<SCRIPT LANGUAGE="JavaScript">
<!--   
// ���� ����   (���ı���,���)
function Sort(sortStr,sort)
{
	var form=document.sortForm;
	form.sort.value		=sort;
	form.sortStr.value	=sortStr;
	form.submit();
}

// ��ġ����
function ChangePosition(idx)
{
	var form=document.sortForm;
	<? if($presentPocnt >= $positionLimit[$positionIndex]){ ?>
	alert("�� ��ϰ��ɼ� : <?=$positionLimit[$positionIndex]?>\n\n���� ��ϼ� : <?=$presentPocnt?>\n\n���̻� ����� �Ұ����մϴ�.");
	self.close();
	<?}else{?>
	form.action="change_position.php?idx="+idx;
	form.target = "ifrm";
	form.submit();
	form.action="goods_total.php";
	form.target = "";
	<?}?>
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#000000">
<iframe name="ifrm" width=0 height=0 frameborder=0></iframe><?
$encode_str = "pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
$sortData=Encode64($encode_str);					//�� ���ڵ� ����
?>
<form name="sortForm" method="post" action="goods_total.php">
<input type="hidden" name="sort"><!-- ���Ĺ�� ex)asc:��������  desc:�������� -->
<input type="hidden" name="sortStr"><!-- ���ı��� ex)name:�̸�  price:���� -->
<input type="hidden" name="position" value="<?=$position?>"><!-- ��ġ -->
<input type="hidden" name="part" value="<?=$part?>"><!-- ex) best:����Ʈ  recommend :��õ -->
<input type="hidden" name="category" value="<?=$category?>"><!-- �з� -->
<input type="hidden" name="part" value="<?=$part?>"><!-- �ߺз� -->
<input type="hidden" name="data" value="<?=$sortData?>">
<input type="hidden" name="offset" value="<?=$offset?>">
<input type="hidden" name="pagecnt" value="<?=$pagecnt?>">
</form>
<table width="450" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="image/goods_total_tit.gif" width="450" height="26"></td>
	</tr>
	<tr>
		<td>
			<table width="450" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<form name="searchform" method="post" action="goods_total.php">
						<input type="hidden" name="code" value="<?=$code?>"><!-- �з� -->
						<input type="hidden" name="position" value="<?=$position?>"><!-- ��ġ -->
						<input type="hidden" name="part" value="<?=$part?>"><!-- ex) best:����Ʈ  recommend :��õ -->
						<input type="hidden" name="category" value="<?=$category?>"><!-- �з� -->
						<table>
							<tr>
								<td>��ǰ��</td>
								<td><input class="box" type="text" name="searchstring" size="20"></td>
								<td><input type="image" src="image/bbs_search_btn.gif" border=0></td>
							</tr>
						</table></form>
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
			<table width="550" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="60"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ǰ</div></td>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="110"> <div align="center"><img src="image/icon.gif" width="11" height="11"> �з���</div></td>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="180"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ǰ�� <a href="javascript:Sort('name','asc');">��</a><a href="javascript:Sort('name','desc');">��</a></div></td>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="100"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ����� <a href="javascript:Sort('writeday','asc');">��</a><a href="javascript:Sort('writeday','desc');">��</a></div></td>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="100"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ��ȸ�� <a href="javascript:Sort('readCnt','asc');">��</a><a href="javascript:Sort('readCnt','desc');">��</a></div></td>
					<td height="30" bgcolor="#EBEBEB" background="image/bbs_tit_bg.jpg" width="100"> <div align="center"><img src="image/icon.gif" width="11" height="11"> ���</div></td>
				</tr>
				<tr>
					<td height="1" colspan="6" background="image/line_bg1.gif"></td>
				</tr><!-- ��� ���� --><?
				while($goods_row=mysql_fetch_array($goods_result))
				{
					//ī�װ� ����
					$cate_row = $MySQL->fetch_array("select *from category where code='$goods_row[category]'");
					$str_category = $cate_row[name];
					if($goods_row[bHit]) $bHit ="<img src='../upload/goods_hit_img'>";
					else				   $bHit ="";
					if($goods_row[bEtc]) $bEtc ="<img src='../upload/goods_etc_img' >";
					else				   $bEtc ="";
					?>
				<tr valign="middle" bgcolor="fafafa" style=cursor:pointer; onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor=''"  onclick="javascript:ChangePosition('<?=$goods_row[idx]?>');"><?
					if (empty($GD_SET) && $goods_row[img_onetoall]) $img_str = $goods_row[img3];
					else if ($GD_SET && $goods_row[img_onetoall] && empty($goods_row[img1])) $img_str = $goods_row[img3];
					else if ($GD_SET && empty($goods_row[img_onetoall]) && empty($goods_row[img1])) $img_str = $goods_row[img3];
					else $img_str = $goods_row[img1];
					?>
					<td height="45"  width="60"> <div align="center"><img src="../upload/goods/<?=$img_str?>" width="40" height="40"></div></td>
					<td height="45"  width="110"> <div align="center"><b><?=$str_category?></b></div></td>
					<td height="45" width="180"> <div align="center"><?=$goods_row[name]?><br><?=$bHit?><?=$bEtc?></div></td>
					<td height="45" width="100"> <div align="center"><?=str_replace("-","/",substr($goods_row[writeday],0,10))?><br><?=substr($goods_row[writeday],11,8)?></div></td>
					<td height="45"> <div align="center"><?=$goods_row[readCnt]?></div></td>
					<td height="45"> <div align="center"><?
					if ($goods_row[bLimit]==0) echo "������";
					else if ($goods_row[bLimit]==1) echo $goods_row[limitCnt]; 
					else if ($goods_row[bLimit]==2) echo "ǰ��"; 
					else if ($goods_row[bLimit]==3) echo "����"; 
					else if ($goods_row[bLimit]==4) echo "����"; 
					?></div></td>
				</tr>
				<tr>
					<td height="1" colspan="6" background="image/line_bg1.gif"></td>
				</tr><?
					$letter_no--;
				}
				include "../lib/class.php";
				$optionStr = "position=$position&sort=$sort&sortStr=$sortStr&category=$category&part=$part&code=$code&search=$search&searchstring=$searchstring";
				$Obj=new CList("goods_total.php",$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,$optionStr);
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
					<td align="center"><?$Obj->putList(true,$pre_icon_img,$next_icon_img);//�������� ����Ʈ?><br><br><img src="image/close_btn.gif" onclick="self.close();"></td>
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
					<td><FONT COLOR="#993300">- ����� ��ǰ�� �����ϴ�.</FONT><br><br><img src="image/close_btn.gif" onclick="self.close();"></td>
				</tr>
			</table>
		</td>
	</tr><?
	}
	?>
</table>
</body>
</html>