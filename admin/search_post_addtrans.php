<?
include "head.php";
?>
<script language="javascript">
<!--
function choice(type)
{
	var f = document.form1;
	if (type=="write") var opform =opener.document.writeForm;
	else if (type=="edit") var opform =opener.document.editForm<?=$cnt?>;
	opform.addr.value = f.add.value;
	opform.first_zip.value = f.first_zip.value;
	opform.last_zip.value = f.last_zip.value;
	window.close();
}
function sendit()
{
	if(document.frmzipsearch.zipcode.value=="")
	{
		alert("������ �Է��ϼ���");
		document.frmzipsearch.zipcode.focus();
		return false;
	}
	else if (document.frmzipsearch.city_chk.value ==0)
	{
		alert("���� ������ �����ϴ� ��Ұ� ������ �����Ƿ� \n���������� �ݵ�� �ϼž� �մϴ�. ");
		return false;
	}
	else
	{
		document.frmzipsearch.submit();
	}
}
function reSize()
{
	<?if(!empty($zipcode)){?>
	window.resizeTo(480,400);
	<?}?>
}
//�����ȣ ã��
function searchZip()
{
	window.open("search_post.php","","scrollbars=yes,width=480,height=200,left=250,top=250");
}
//-->
</script>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="document.frmzipsearch.zipcode.focus();reSize();">
<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="73" width="450"><img src="../image/member/zipcode_search_top.gif"></td>
	</tr>
	<tr>
		<td  width="450" valign="top">
			<table width="450" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top"><br>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<form method="post" action="search_post_addtrans.php" name="frmzipsearch">
							<input type="hidden" name="cnt" value="<?=$cnt?>">
							<input type="hidden" name="po" value="<?=$po?>">
							<input type="hidden" name="type" value="<?=$type?>">
							<input type="hidden" name="cnt" value="<?=$cnt?>">
							<tr>
								<td width="100" align="center" bgcolor="eeeeee"> ���� ���� </td>
								<td width="100" align="center"><select name="city_chk">
									<option value=0>��/��</option>
									<option value=����>����</option>
									<option value=���>���</option>
									<option value=�泲>�泲</option>
									<option value=���>���</option>
									<option value=����>����</option>
									<option value=�뱸>�뱸</option>
									<option value=����>����</option>
									<option value=�λ�>�λ�</option>
									<option value=����>����</option>
									<option value=���>���</option>
									<option value=��õ>��õ</option>
									<option value=����>����</option>
									<option value=����>����</option>
									<option value=����>����</option>
									<option value=�泲>�泲</option>
									<option value=���>���</option>
								</select></td>
								<td width="200" align="center" bgcolor="eeeeee"> ��/��/��/�� �˻� </td>
								<td width="100" align="center"> <input class="box" type="text" name="zipcode" size="10" onKeydown="if (event.Keycode==13) sendIt();"></td>
								<td width="100" align="center"><a href="#;" onclick="sendit();"><img src="../image/icon/search_2.gif" width="54" height="19" border="0"></a></td>
							</tr>
							<tr>
								<td colspan="5" height="5"></td>
							</tr></form><!-- post --><?
							if($zipcode)
							{
								$goo_search=$MySQL->articles("select idx from postzip where city='$city_chk' and goo like '%$zipcode%'");
								$dong_search=$MySQL->articles("select idx from postzip where city='$city_chk' and dong like '%$zipcode%'");
								if ($goo_search) $result=$MySQL->query("select * from postzip where city='$city_chk' and goo like '%$zipcode%' order by zip asc");
								else if ($dong_search) $result=$MySQL->query("select * from postzip where city='$city_chk' and dong like '%$zipcode%' order by zip asc");
								$search_num = mysql_num_rows($result);
								?>
							<tr>
								<td colspan="5" align=right><font class="help">�� �˻������� �ʹ� Ŭ��� ��/��/�� �� �˻����ּ���.</font><img src="image/add_trans_btn.gif" onclick="choice('<?=$type?>');"></td>
							</tr>
							<tr>
								<td colspan="5" align="center">
									<table width="98%" border="0" cellspacing="1" cellpadding="0" bgcolor='C1C1C1'>
										<tr>
											<td width="20%" align="center" height="20" bgcolor="#E3E3E3">�����ȣ</td>
											<td width="80%" align="center" height="20" bgcolor="#E3E3E3">�� ��</td>
										</tr><?
										$i=1;
										while($row=mysql_fetch_array($result))
										{
											$string=$row[zip];
											$szip1=substr($string,0,3);
											$szip2=substr($string,4,3);
											if ($i==1)
											{
												$first_zip = $string;
												if ($goo_search)	$add = $row[city]." ".$row[goo];
												else if ($dong_search)  $add = $row[city]." ".$row[dong];
											}
											if ($i==$search_num) $last_zip = $string;
											?>
										<tr bgcolor="#F6F6F6"  valign="bottom">
											<td width="20%" align="center" height="20"><?=$row[zip]?></td>
											<td width="80%" height="20">&nbsp;&nbsp;<?=$row[city]?> <?=$row[goo]?> <?=$row[dong]?>&nbsp;&nbsp;<?=$row[etc]?></td>
										</tr><?
											$i++;
										}
										?>
										<form name="form1">
										<input type="hidden" name="first_zip" value="<?=$first_zip?>">
										<input type="hidden" name="last_zip" value="<?=$last_zip?>">
										<input type="hidden" name="add" value="<?=$add?>">
										</form>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr><?
							}
							?>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="1" width="307"></td>
	</tr>
</table>
</body>
</html>