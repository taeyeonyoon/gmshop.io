<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function menu_show(cnt)
{
	obj = eval("document.getElementById('menu_id"+cnt+"')");
	td_obj = eval("document.getElementById('td_"+cnt+"')");
	if (obj.style.display == "")
	{
		obj.style.display = "none";
		td_obj.innerHTML = "��";
	}
	else if (obj.style.display == "none")
	{
		obj.style.display = "";
		td_obj.innerHTML = "<font color=red>��</font>";
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "help";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	if(!defined(__ADMIN_ROW))
	{
		define(__ADMIN_ROW,"TRUE");
		$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
	}
	?>
		<td width="85%" valign="top" height='400'>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/help_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �⺻������ �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="2">
						<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td>
									<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td width='440' height=30><img src="image/adm_icon.gif"> �ҽ����� �̷°���</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor='DADADA' height='1'></td>
							</tr>
							<tr>
								<td height='10'></td>
							</tr>
							<tr>
								<td valign=top>
									<table width="95%"  border="0" cellspacing="1" cellpadding="3" align="center" bgcolor=''>
										<tr>
											<td colspan="2"> �� �ַ�� �̿� ������ ���α׷� �ҽ� ���������� ����ϴ� �޴��Դϴ�. ���� ������ġ�� ������ ���⿡ ��ϵ� ���ϰ� �ߺ��� ������ �ʴ��� üũ�� �˴ϴ�.</td>
										</tr>
										<tr>
											<td colspan="2">
												<form name="form1" method="post" action="help_src_ok.php">
												<table border=0 align="center" cellspacing="3" cellpadding="0" width="700" class="table_coll">
													<tr align="center">
														<td colspan="2" bgcolor="#3D179C" height=30><font color="white">�� �� �� �� �� �� &nbsp;&nbsp;�� �� �� ��</font></td>
													</tr>
													<tr align="center" height="30">
														<td width="150" bgcolor="#eeeeee">�۾�����</td>
														<td ><input type="text" class="box" name="title" size="40">&nbsp;��) ���� ��� �˻��� ��ġ �̵�</td>
													</tr>
													<tr align="center" height="30">
														<td width="150" bgcolor="#eeeeee">���ϸ�</td>
														<td ><input type="text" class="box" name="filename" size="35">&nbsp;��) index.php , admin/goods_write.php</td>
													</tr>
													<tr align="center">
														<td width="150" bgcolor="#eeeeee">�۾� �󼼳���</td>
														<td ><textarea class="box" name="content" rows="10" cols="50"></textarea></td>
													</tr>
													<tr align="center">
														<td width="150" bgcolor="#eeeeee">���ǻ���</td>
														<td ><textarea class="box" name="notice" rows="5" cols="50"></textarea></td>
													</tr>
													<tr align="center">
														<td colspan="2" bgcolor="#eeeeee" height><input type="button" class="button" value="�� ��" onclick="document.form1.submit();"></td>
													</tr>
												</table></form>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign=top><br>
									<table width="95%"  border="0" cellspacing="1" cellpadding="3" align="center" bgcolor=''>
										<tr>
											<td>
												<table border=0 align="center" cellspacing="3" cellpadding="0" width="800" class="table_coll">
													<tr align="center">
														<td colspan="6" bgcolor="#3D179C" height=30><font color="white">�� �� �� �� �� �� �� ��&nbsp;&nbsp;</font></td>
													</tr>
													<tr align="center" bgcolor="#eeeeee" height="30">
														<td width="250">�۾�����</td>
														<td width="250">���ϸ�</td>
														<td width="100">��¥</td>
														<td width="80">�۾��󼼳��� <br>���ǻ��׺���</td>
														<td width="120">�� ��</td>
													</tr><?
													$qry = "SELECT *from userSrcEdit order by idx desc";
													$result = $MySQL->query($qry);
													while ($row = mysql_fetch_array($result))
													{
														$cnt++;
														?>
													<form name="form_<?=$cnt?>" method="post" action="help_src_ok.php?edit=1">
													<input type="hidden" name="idx" value="<?=$row[idx]?>">
													<tr align="center" height="30">
														<td><input type="text" class="box" name="title" value="<?=$row[title]?>" size="35"></td>
														<td><input type="text" class="box" name="filename" value="<?=$row[filename]?>" size="35"></td>
														<td><?=substr($row[writeday],0,16)?></td>
														<td id="td_<?=$cnt?>" onclick="	menu_show(<?=$cnt?>);" style="cursor:pointer">��</td>
														<td><img src="image/edit_btn.gif" onclick="document.form_<?=$cnt?>.submit();" style="cursor:pointer">&nbsp;&nbsp;&nbsp;<img src="image/delete_btn.gif" onclick="if (confirm('�����Ͻðڽ��ϱ�?')) { location.href='help_src_ok.php?del=1&idx=<?=$row[idx]?>' }" style="cursor:pointer"></td>
													</tr>
													<tr id="menu_id<?=$cnt?>" style="display:none";>
														<td colspan="5" bgcolor="ffffff">
															<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
																<tr align="center" height="25" >
																	<td width="50%" >�۾� �󼼳���</td>
																	<td width="50%">���ǻ���</td>
																</tr>
																<tr align="center">
																	<td width=50%><textarea class="box" name="content" rows="10" cols="50"><?=$row[content]?></textarea></td>
																	<td width=50%><textarea class="box" name="notice" rows="10" cols="50"><?=$row[notice]?></textarea></td>
																</tr>
															</table>
														</td>
													</tr>
													</form><?
													}
													?>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>