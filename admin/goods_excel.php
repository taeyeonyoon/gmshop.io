<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function etcSendit()
{
	if (document.adm_etcForm.csv_file.value=="")
	{
		alert("CSV ������ �����Ͽ� �ֽʽÿ�.");
	}
	else
	{
		document.adm_etcForm.submit();
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "goods";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	?>
		<td width="85%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/good_tit_img.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP ��ǰ������ �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td colspan="2">
									<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td height='1' colspan='3' bgcolor='DADADA'></td>
										</tr>
										<tr>
											<td width='440'><img src="image/goods_excel.gif"></td>
										</tr>
										<tr>
											<td height='1' colspan='3' bgcolor='DADADA'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='5' colspan="2"></td>
							</tr>
							<tr>
								<td valign="top">
									<form name="adm_etcForm" method="post" action="goods_excel_ok.php" enctype="multipart/form-data" >
									<table bgcolor="eeeeee" width="400" height="100" align="center">
										<tr align="center" >
											<td>CSV ���� ���ε�</td>
											<td><input type="file" name="csv_file" class="box"> <img src="image/entry_btn.gif" align="absmiddle" onclick="etcSendit();" style="cursor:pointer"></td>
										</tr>
										<tr>
											<td colspan="2">�� ���� CSV���� �ٿ�ޱ� �� <a href="csv_down.php"><img src="image/s_file.gif" align="absmiddle"></a></td>
										</tr>
										<tr>
											<td colspan="2">�� �� �� �� �� </td>
										</tr>
										<tr>
											<td colspan="2">1. �������� �ٿ���� (���÷� ��ǰ1���� ������ �ԷµǾ��ֽ��ϴ�.)<br>2. ù���� �ʵ���� ���ܵΰ� 2��° ����� �ش�Ǵ� ������ �Է�<br>3. �۾��Ϸ�� ���� - ���������� CSV(��ǥ�κи�)���·� ����<br>4. �¸�׼� �������� �̰��� ���ż� �ش������� ���ε� ��Ŵ<br>5. ���ε��� CSV���Ͽ� ������ ������� �����޼��� ��µ�<br>6. CSV���Ͽ� ������ ������ �ۡ۰� �Ϸ� �޼��� ��µ� <br>7. ���� ��ǰ������ upload/goods ��ο� �÷��ֽñ� �ٶ��ϴ�. </td>
										</tr>
									</table></form>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="20"></td>
							</tr>
							<tr>
								<td valign="top">
									<table bgcolor="eeeeee" width="600" align="center" border="1" style="border-collapse:collapse" bordercolor="#999999">
										<tr align="center">
											<td colspan="2" height="50"><font size="+1"><b>�� �� �� ��</b></font><br>�� ���ݰ� ���õ� ������ �Է½� <b>�ĸ� �Է� ����</b></td>
										</tr>
										<tr align="left">
											<td width="100">code</td>
											<td bgcolor="ffffff">��ǰ�ڵ� (�ߺ������ʴ� 40�� �̳� ����)</td>
										</tr>
										<tr align="left">
											<td width="100">name</td>
											<td bgcolor="ffffff">��ǰ��</td>
										</tr>
										<tr align="left">
											<td width="100">price</td>
											<td bgcolor="ffffff">�ǸŰ� </td>
										</tr>
										<tr align="left">
											<td width="100">bOldPrice</td>
											<td bgcolor="ffffff">���߰� ǥ�ÿ��� (0: ǥ�þ��� 1: ǥ����)</td>
										</tr>
										<tr align="left">
											<td width="100">oldPrice</td>
											<td bgcolor="ffffff">���߰� </td>
										</tr>
										<tr align="left">
											<td width="100">point</td>
											<td bgcolor="ffffff">������</td>
										</tr>
										<tr align="left">
											<td width="100">bCompany</td>
											<td bgcolor="ffffff">������ ǥ�ÿ��� (0: ǥ�þ��� 1: ǥ����)</td>
										</tr>
										<tr align="left">
											<td width="100">company</td>
											<td bgcolor="ffffff">������</td>
										</tr>
										<tr align="left">
											<td width="100">bOrigin</td>
											<td bgcolor="ffffff">������ ǥ�ÿ��� (0: ǥ�þ��� 1: ǥ����)</td>
										</tr>
										<tr align="left">
											<td width="100">origin</td>
											<td bgcolor="ffffff">������</td>
										</tr>
										<tr align="left">
											<td width="100">bLimit</td>
											<td bgcolor="ffffff">������ (0: ������, 1:���� 2: ǰ��, 3:���� 4:����)</td>
										</tr>
										<tr align="left">
											<td width="100">limitCnt</td>
											<td bgcolor="ffffff">������</td>
										</tr>
										<tr align="left">
											<td width="100">bHit</td>
											<td bgcolor="ffffff">��Ʈ�̹��� ��뿩�� (0: ǥ�þ��� 1: ǥ����)</td>
										</tr>
										<tr align="left">
											<td width="100">bNew</td>
											<td bgcolor="ffffff">���̹��� ��뿩�� (0: ǥ�þ��� 1: ǥ����)</td>
										</tr>
										<tr align="left">
											<td width="100">bEtc</td>
											<td bgcolor="ffffff">��Ÿ�̹��� ��뿩�� (0: ǥ�þ��� 1: ǥ����)</td>
										</tr>
										<tr align="left">
											<td width="100">partName1</td>
											<td bgcolor="ffffff">ù��° ��ǰ�ɼǸ� (��: ����, ������)</td>
										</tr>
										<tr align="left">
											<td width="100">partName2</td>
											<td bgcolor="ffffff">�ι�° ��ǰ�ɼǸ�</td>
										</tr>
										<tr align="left">
											<td width="100">partName3</td>
											<td bgcolor="ffffff">����° ��ǰ�ɼǸ�</td>
										</tr>
										<tr align="left">
											<td width="100">strPart1</td>
											<td bgcolor="ffffff">ù��° ��ǰ�ɼ��� �����׸� (��: ������������������Ķ���) , �׸���̿� �ݵ�� Ư������ ���� �� ����</td>
										</tr>
										<tr align="left">
											<td width="100">strPart2</td>
											<td bgcolor="ffffff">�ι�° ��ǰ�ɼ� �����׸�</td>
										</tr>
										<tr align="left">
											<td width="100">strPart3</td>
											<td bgcolor="ffffff">����° ��ǰ�ɼ� �����׸�</td>
										</tr>
										<tr align="left">
											<td width="100">img1</td>
											<td bgcolor="ffffff">��ǰ�̹��� (��)	[��ξ��� ���ϸ� �Է�]</td>
										</tr>
										<tr align="left">
											<td width="100">img2</td>
											<td bgcolor="ffffff">��ǰ�̹��� (��)</td>
										</tr>
										<tr align="left">
											<td width="100">img3</td>
											<td bgcolor="ffffff">��ǰ�̹��� (��)</td>
										</tr>
										<tr align="left">
											<td width="100">img4</td>
											<td bgcolor="ffffff">��ǰ�̹��� (��) �������� �߰��̹��� 1</td>
										</tr>
										<tr align="left">
											<td width="100">img5</td>
											<td bgcolor="ffffff">��ǰ�̹��� (��) �������� �߰��̹��� 2</td>
										</tr>
										<tr align="left">
											<td width="100">img6</td>
											<td bgcolor="ffffff">��ǰ�̹��� (��) �������� �߰��̹��� 3</td>
										</tr>
										<tr align="left">
											<td width="100">img7</td>
											<td bgcolor="ffffff">��ǰ�̹��� (��) �������� �߰��̹��� 4</td>
										</tr>
										<tr align="left">
											<td width="100">img8</td>
											<td bgcolor="ffffff">��ǰ�̹��� (��) �������� �߰��̹��� 5</td>
										</tr>
										<tr align="left">
											<td width="100">content</td>
											<td bgcolor="ffffff">��ǰ����</td>
										</tr>
										<tr align="left">
											<td width="100">writeday</td>
											<td bgcolor="ffffff">�����</td>
										</tr>
										<tr align="left">
											<td width="100">readcnt</td>
											<td bgcolor="ffffff">��ȸ��</td>
										</tr>
										<tr align="left">
											<td width="100">setVal</td>
											<td bgcolor="ffffff">�������� (1~10 �� �� �Է�, Ŭ���� ���ʿ� �����, �⺻�� 5)</td>
										</tr>
										<tr align="left">
											<td width="100">category</td>
											<td bgcolor="ffffff">ī�װ��ڵ�</td>
										</tr>
										<tr align="left">
											<td width="100">detailimg1</td>
											<td bgcolor="ffffff">��ǰ������ �ؿ� �ΰ������� ��ϵǴ� �����̹��� 1</td>
										</tr>
										<tr align="left">
											<td width="100">detailimg2</td>
											<td bgcolor="ffffff">��ǰ������ �ؿ� �ΰ������� ��ϵǴ� �����̹��� 2</td>
										</tr>
										<tr align="left">
											<td width="100">detailimg3</td>
											<td bgcolor="ffffff">��ǰ������ �ؿ� �ΰ������� ��ϵǴ� �����̹��� 3</td>
										</tr>
										<tr align="left">
											<td width="100">detailimg4</td>
											<td bgcolor="ffffff">��ǰ������ �ؿ� �ΰ������� ��ϵǴ� �����̹��� 4</td>
										</tr>
										<tr align="left">
											<td width="100">margin</td>
											<td bgcolor="ffffff">������ (1~100%)</td>
										</tr>
										<tr align="left">
											<td width="100">supplyprice</td>
											<td bgcolor="ffffff">���ް�</td>
										</tr>
										<tr align="left">
											<td width="100">meta_str</td>
											<td bgcolor="ffffff">������ Ÿ��Ʋ�ٿ� ������ ���� (�˻����� �κ� �����ͷ� Ȱ��)</td>
										</tr>
										<tr align="left">
											<td width="100">chango</td>
											<td bgcolor="ffffff">â�� ������ ��ġ���� (��ǰ�ֹ��� �߼��غ��ڷ� ����ÿ� ��Ÿ���ϴ�.)</td>
										</tr>
										<tr align="left">
											<td width="100">quality</td>
											<td bgcolor="ffffff">ǰ�� (A,B,C �� ����ϰ� �����ڿ��Ը� ���Դϴ�.)</td>
										</tr>
										<tr align="left">
											<td width="100">model</td>
											<td bgcolor="ffffff">�𵨸�</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="20"></td>
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