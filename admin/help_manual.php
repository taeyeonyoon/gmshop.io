<?
// �ҽ��������
// 20060714_1 �ҽ����� ��ȣ�� (��� ���α׷� �������� ���� �ҽ� ����)
include "head.php";
?>
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
											<td width='440' height=30><img src="image/adm_icon.gif"> �޴�����</td>
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
								<td height='20'>Ctrl + F �� �����ż� Ư���޴��� �˻��Ҽ� �ֽ��ϴ�.</td>
							</tr>
							<tr>
								<td height='10'></td>
							</tr>
							<tr>
								<td valign=top>
									<table width="95%"  border="1" cellspacing="1" cellpadding="3" align="center" bgcolor='' class="table_coll">
										<tr align="center" height=30 bgcolor='#CBCCF8'>
											<td width=13%><b>�޴��̸�</b></td>
											<td width=14%><b>�Ϻθ޴�</b></td>
											<td width=73%><b>�������� ����</b></td>
										</tr>
										<tr align="center">
											<td  rowspan=7 bgcolor="#3D179C"><font color=white><b>�⺻����</b></font></td>
											<TD bgcolor="#eeeeee">������ �⺻����</TD>
											<TD align="left" style="line-height:18px">*�⺻���� ���� - ���θ��ּ�, ���θ��̸�, ���θ�����, ������ȣ�����, �α����� ù������ <br>*���������� ���� - ������ ���̵�, ��й�ȣ, �߼��̸���, ȸ���̸���<br>*��������� - ��ȣ, ����ڵ�Ϲ�ȣ, ����, ����, ����Ǹž� �Ű��ȣ, ��ǥ�ڸ�, �����ȣ, ������ּ�, ����ó, �ѽ�</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">���ڰ��� ����</TD>
											<TD align="left" style="line-height:18px">*�������, PG��, �������̵�, PG�� ������, �������Ա� ��������<br>*���������� ��뿩��, ȸ������������, ��ǰ����������, ��ǰ�����ı� ������, �����ݻ�� ������ ���űݾ��ѵ�, �����ݻ�� �ּ�/�ִ�ݾ� </TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��� ����</TD>
											<TD align="left" style="line-height:18px">*��ۺ� ���� - ��ۺ����� ��뼳�� �� ���� �Ǵ� �����۱ݾ� ����, ��۹�� ����, ��۾�ü���� <br>*�����갣 ��ۺ��� - ����,�︪�� ���� ��ۺ� ���� ��� ������ �����մϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�̿�ȳ� ����</TD>
											<TD align="left" style="line-height:18px">*���κ�ȣ��å, ���θ��̿�ȳ�, ȸ����������, ȸ�����Ծ��, ���ԿϷ������� �޼���, ��ٱ��� �̿�ȳ�, �������(�ֹ��ó���), ���޾ȳ�, ȸ��Ұ�, �൵, �ֹ��Ϸ������� �޽����� �����մϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">���� �� ��� ����</TD>
											<TD align="left" style="line-height:18px">*�������ϸ���, ��ǰ���Ÿ���, ��ǰ��۸���, �ֹ���Ҹ���, ��й�ȣ �������, �����ϴ� �� ������ ������ ����<br>*��ǰ������� �����, �ֹ�������� �����, ȸ��������� �����, �Խ��Ǹ�� �����(�Һ���ȭ��), �˻������� �����(�Һ���ȭ��)</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">���ʱ�ȭ ����</TD>
											<TD align="left" style="line-height:18px">*���θ� ��ü�ʱ�ȭ �� �κ��ʱ�ȭ, �������������� ��ٱ���, ����ǰ�� �������� ���.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��Ÿ����</TD>
											<TD align="left" style="line-height:18px">*��ǰ��Ͻ� Ȯ���̹��� 1���� ����,�߰��̹��� �ڵ����� ��ɼ���, 1:1���ǰԽ���, ���콺������ ��ư�㰡����, �ֹ���� �ڵ����ΰ�ħ, �����ȣ ������Ʈ</TD>
										</TR>
										<tr align="center">
											<td  rowspan=7 bgcolor="#3D179C"><font color=white><b>�ֹ�����</b></font></td>
											<TD bgcolor="#eeeeee">�ֹ�����	 ���</TD>
											<TD align="left" style="line-height:18px">*��ü �ֹ���� ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee"><?=$TRADE_ARR[0]?> ���</TD>
											<TD align="left" style="line-height:18px">*<?=$TRADE_ARR[0]?> �����ֹ��� ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee"><?=$TRADE_ARR[1]?> ���</TD>
											<TD align="left" style="line-height:18px">*<?=$TRADE_ARR[1]?> �����ֹ��� ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee"><?=$TRADE_ARR[2]?> ���</TD>
											<TD align="left" style="line-height:18px">*<?=$TRADE_ARR[2]?> �����ֹ��� ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee"><?=$TRADE_ARR[3]?> ���</TD>
											<TD align="left" style="line-height:18px">*<?=$TRADE_ARR[3]?> �����ֹ��� ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee"><?=$TRADE_ARR[4]?> ���</TD>
											<TD align="left" style="line-height:18px">*<?=$TRADE_ARR[4]?> �����ֹ��� ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee"><?=$TRADE_ARR[5]?> ���</TD>
											<TD align="left" style="line-height:18px">*<?=$TRADE_ARR[5]?> �����ֹ��� ����</TD>
										</TR>
										<tr align="center">
											<td  rowspan=7 bgcolor="#3D179C"><font color=white><b>��ǰ����</b></font></td>
											<TD bgcolor="#eeeeee">Ư����ġ���</TD>
											<TD align="left" style="line-height:18px">*���κ���Ʈ, ������Ʈ, ���νű�, ī�װ��� ����Ʈ,�ű� ��ġ�� ��ϵ� ��ǰ���� </TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��ǰ���</TD>
											<TD align="left" style="line-height:18px">*��ϵǾ� �ִ� ��ǰ����� ���� ������, ��ǰ�� �̵�/������ ��ϻ󿡼� �Ҽ��ֽ��ϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��ǰ��� ������</TD>
											<TD align="left" style="line-height:18px">*�����ΰ����� ��ǰ��� ������ �ٷΰ����ִ� ��ũ�Դϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��ǰ�� ����</TD>
											<TD align="left" style="line-height:18px">*���� ��ǰ�� ���� ��ǰ���� ������ ������ �����ϴ� ������ �Դϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��ǰ����</TD>
											<TD align="left" style="line-height:18px">*���� ��ǰ�� ���� ������ ������ ������ �����ϴ� ������ �Դϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��ǰ���� ����</TD>
											<TD align="left" style="line-height:18px">*��ǰ��/��ǰ���� ��뿩��, ��ǰ��ϻ󿡼� �ǸŰ� ������ ���޼���â ����<br>NEW / ��Ÿ / HIT / �ǸŰ� / ������ / Ȯ�뺸�� / ǰ��ǥ�� / ī�װ�����Ʈ��ǰ �̹������<br>��ǰ��� ��Ʈ����, ���͸�ũ �̹�������</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��ǰ�������</TD>
											<TD align="left" style="line-height:18px">*���ÿ������� �ٿ�ޱ�, �ۼ��� ��ǰ������������ ���ε��ϱ�, ��ǰDB�ʵ� ����</TD>
										</TR>
										<tr align="center">
											<td  rowspan=3 bgcolor="#3D179C"><font color=white><b>ī�װ�</b></font></td>
											<TD bgcolor="#eeeeee">ī�װ� ����</TD>
											<TD align="left" style="line-height:18px">*ī�װ��� ����, ī�װ� ������</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">ī�װ� ���</TD>
											<TD align="left" style="line-height:18px">*ī�װ��� ����ϴ� ȭ���Դϴ�. �̸��� �̹���1~6 �� ����մϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">ī�װ� ����</TD>
											<TD align="left" style="line-height:18px">*�Һ��� ȭ�鿡 ǥ���� ī�װ��� ����Ǵ� �켱������ �����մϴ�.</TD>
										</TR>
										<tr align="center">
											<td  rowspan=4 bgcolor="#3D179C"><font color=white><b>ȸ������</b></font></td>
											<TD bgcolor="#eeeeee">ȸ�����</TD>
											<TD align="left" style="line-height:18px">*������ ȸ���� ����� �����ϴ� ������ �Դϴ�. ������,�������� ��ü���� ��ɰ� ����ȸ��/��ȥ����� ȸ���˻� ���� �����մϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">ȸ����ü ���Ϻ�����</TD>
											<TD align="left" style="line-height:18px">*���ϼ��ſ��θ� üũ�� ȸ������ ��ü������ �߼��մϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�߼۸�����Ȳ</TD>
											<TD align="left" style="line-height:18px">*�߼۵� ���ϳ����� �����մϴ�. ���Ϲ߼ۿ� ������ �־� �߼۵��� ���� ������ ��߼� �Ҽ��� �ֽ��ϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">ȸ����ü SMS������</TD>
											<TD align="left" style="line-height:18px">*SMS���ſ��θ� üũ�� ȸ������ ��üSMS�� �߼��մϴ�.(SMS ��ü�� ����� ���־�� �մϴ�.)</TD>
										</TR>
										<tr align="center">
											<td  rowspan=6 bgcolor="#3D179C"><font color=white><b>�����ΰ���</b></font></td>
											<TD bgcolor="#eeeeee">����ȭ��</TD>
											<TD align="left" style="line-height:18px">*A - ��ܺκ� ���̾ƿ� 2��������, �ΰ� / ���ã�� / ȸ������~�ֹ���ȸ, ��ǰ�˻�~���������� ž �̹��� ���<br>*B - ���̾ƿ� 2��������, ����Ÿ��Ʋ / �������� / �������� �غ��� �̹������, ����Ÿ��Ʋ �����̵�ȿ�� ����<br>*B-1 -���������� �߾Ӻκ� 3���� ������ �����̹��� ���, �� �������� 1 ~ 4 ���� ���� ������ ���� <br>*C - ��ǰ ī�װ� Ÿ��Ʋ�̹��� ���, ��з�/�ߺз� ���̼���, �������� �������⿩��, �α����� �������⿩��<br>*D - �����޴� ���� / �������� ��뿩�� �� �̹��� ���. �űԻ�ǰ�� Ÿ��Ʋ�̹������ �� ��ϼ� ����<br>*E - ����Ʈ��ǰ�� ����x���ι迭 / HTML�����Է� / �ڵ���ũ�� ����, Ÿ��Ʋ�̹������, ��ϼ� �� �̹��� ũ�� ����<br>*F - ��Ʈ��ǰ�� ����x���ι迭 / HTML�����Է� / �ڵ���ũ�� ����, Ÿ��Ʋ�̹������, ��ϼ� �� �̹��� ũ�� ����<br>*G - ���� �ϴܺκ� ī�װ��� �̹��� ��뿩��<br>*H - ���� �ϴܺκ� �Խ���, �̺�Ʈ Ÿ��Ʋ �̹��� ��� �� ��뼳��, 1:1���ǰԽ���~ȸ��Ұ� �����̹��� ���<br>*I  - �����ϴ� ���»纣�� ���<br>*J - �������ϴ� �ΰ��̹���, ȸ����������Ǵºκ� ���,������</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��ǰ���</TD>
											<TD align="left" style="line-height:18px">*B - ��ǰ ������� ���� ���� - ī�װ� �������� �Ǵ� ��� ī�װ� �ϰ�����, ��ǰ ������� - �Ϲ����� �ٵ��ǽĹ迭�� �Խ��ǽ� �迭, ��ǰ ����Ʈ  ���,�̹���ũ�� ����<br>*C -��ǰ���ȭ�鿡�� ī�װ� ���� �޴��� ��뿩�� ����, �Խ���Ÿ��Ʋ�̹��� / ��� ���</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">����������</TD>
											<TD align="left" style="line-height:18px">* ��ǰ��� / ��ǰ������ / �̿��� / ȸ������ / ���������� / ��ٱ��� / �ֹ����� / 1:1���� / �Խ��� / ȸ��Ұ� / �̿�ȳ� / ���κ�ȣ��å / �󼼰˻� / ��������</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">ȸ������</TD>
											<TD align="left" style="line-height:18px">*ȸ������ ������ �ʼ����� �� ǥ���� �׸� ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">������ ���̾��</TD>
											<TD align="left" style="line-height:18px">*������ �¿��� ���� ��� (���θ� ������ ��� �϶��� ��� �����մϴ�.)<br>*���� �������� ��� ���� �� ��ǰ ��� ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">Ŀ�´�Ƽ</TD>
											<TD align="left" style="line-height:18px">*Ŀ�´�Ƽ Ÿ��Ʋ �̹��� ���, Ŀ�´�Ƽ �Խ��� ���� ����, Ŀ�´�Ƽ �Խ��� ���������� ���� ����</TD>
										</TR>
										<tr align="center">
											<td  rowspan=5 bgcolor="#3D179C"><font color=white><b>�������</b></font></td>
											<TD bgcolor="#eeeeee">�Ϲ����</TD>
											<TD align="left" style="line-height:18px">*���� �������(����Ϸ�� ��¥����)�� �Ѵ��� ���� �ֵ��� �޷��������� ǥ��</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�������</TD>
											<TD align="left" style="line-height:18px">*�Ϻ� �������(ī�װ�, ��ǰ, ȸ���� ���еǾ�����)</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�������</TD>
											<TD align="left" style="line-height:18px">*���� �������(ī�װ�, ��ǰ, ȸ���� ���еǾ�����)</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�Ⱓ���</TD>
											<TD align="left" style="line-height:18px">*�⺰ �������(ī�װ�, ��ǰ, ȸ���� ���еǾ�����)</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">Ư���Ⱓ���</TD>
											<TD align="left" style="line-height:18px">*���ϴ� Ư���Ⱓ �������(ī�װ�, ��ǰ, ȸ���� ���еǾ�����)</TD>
										</TR>
										<tr align="center">
											<td  rowspan=6 bgcolor="#3D179C"><font color=white><b>�������</b></font></td>
											<TD bgcolor="#eeeeee">�Ϲ����</TD>
											<TD align="left" style="line-height:18px">*��¥, ��, ��ü���� �������</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�ð����</TD>
											<TD align="left" style="line-height:18px">*��¥, ��, ��ü���� �Žð��� �������</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�ְ����</TD>
											<TD align="left" style="line-height:18px">*��, ��ü���� ���Ϻ� �������</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">���Ӱ��</TD>
											<TD align="left" style="line-height:18px">*� ����Ʈ�� ���� �� ����Ʈ�� �����ߴ��� ���</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">������</TD>
											<TD align="left" style="line-height:18px">*�� ����Ʈ�� ������ ������� PC ������ ����</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�ü��</TD>
											<TD align="left" style="line-height:18px">*�� ����Ʈ�� ������ ������� PC �ü�� ����</TD>
										</TR>
										<tr align="center">
											<td  rowspan=1 bgcolor="#3D179C"><font color=white><b>���������������</b></font></td>
											<TD bgcolor="#eeeeee">���������������</TD>
											<TD align="left" style="line-height:18px">*���θ����� ���� ���ο� �������� ������� �Ҷ� �� ����� ����մϴ�.</TD>
										</TR>
										<tr align="center">
											<td  rowspan=3 bgcolor="#3D179C"><font color=white><b>��������</b></font></td>
											<TD bgcolor="#eeeeee">��������</TD>
											<TD align="left" style="line-height:18px">*���������� ����ϸ� �ڵ����� ���������� ������ ǥ�õǸ� ���ÿ� �ڵ����� �˾�â�� ������ �ֽ��ϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�̺�Ʈ</TD>
											<TD align="left" style="line-height:18px">*���������� ����ϸ� �ڵ����� ���������� �ϴܿ� ǥ�õǸ� ���ÿ� �ڵ����� �˾�â�� ������ �ֽ��ϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��������</TD>
											<TD align="left" style="line-height:18px">*�������縦 �ǽ��Ҽ� �ֽ��ϴ�. �������� ��������� ���߿� �����Ҽ� �����ϴ�.</TD>
										</TR>
										<tr align="center">
											<td  rowspan=1 bgcolor="#3D179C"><font color=white><b>�Խ���</b></font></td>
											<TD bgcolor="#eeeeee">�Խ���</TD>
											<TD align="left" style="line-height:18px">*��ϵ� �Խ��� ���� �� ���, ������ �Ҽ� �ֽ��ϴ�. (�б�/����/�亯 ����, ������ ��ɿ���, Ŀ�´�Ƽ�������� ���⼳��, �Ұ�����, �̹��� ���)</TD>
										</TR>
										<tr align="center">
											<td  rowspan=1 bgcolor="#3D179C"><font color=white><b>1:1���ǰԽ���</b></font></td>
											<TD bgcolor="#eeeeee">1:1���ǰԽ���</TD>
											<TD align="left" style="line-height:18px">*1:1���ǰԽ��� ��Ͽ��� �� �亯, ������ �Ҽ� �ֽ��ϴ�. 1:1���ǰԽ����� ȸ���� �̿밡���ϸ� Ÿ���� �� ���� ȸ���� ���������ϴ�.</TD>
										</TR>
										<tr align="center">
											<td  rowspan=1 bgcolor="#3D179C"><font color=white><b>SMS����</b></font></td>
											<TD bgcolor="#eeeeee">SMS����</TD>
											<TD align="left" style="line-height:18px">*SMS��ü�� ���� ��� �̰��� ID,PW�� �����ϸ�, ȸ������ / ��ǰ���� / ��� �ÿ� ���� ���ڳ����� �����մϴ�.</TD>
										</TR>
										<tr align="center">
											<td  rowspan=1 bgcolor="#3D179C"><font color=white><b>�̹������ε�</b></font></td>
											<TD bgcolor="#eeeeee">�̹������ε�</TD>
											<TD align="left" style="line-height:18px">*FTP�����Ͽ� ���ε� ���ʿ� ���� �̰����� �̹����� ���ε� �Ҽ��ֽ��ϴ�. upload/page ������ ����˴ϴ�.</TD>
										</TR>
										<tr align="center">
											<td  rowspan=5 bgcolor="#3D179C"><font color=white><b>�����ڸ���</b></font></td>
											<TD bgcolor="#eeeeee">�⺻����</TD>
											<TD align="left" style="line-height:18px">*OUTLOOK EXPRESS ���α׷��� ������ ������ ����̸� �⺻�����޴����� ���� �ùٸ� ������ ����ؾ� �Ϻθ޴����� �������ϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">��������</TD>
											<TD align="left" style="line-height:18px">*������ �߼��ϴ� �޴��Դϴ�. 3������ ����÷�θ� �Ҽ������� �Բ��޴��� ���� �Ǵ� �ּҷϿ��� �ҷ����� ����� �ֽ��ϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�����԰���</TD>
											<TD align="left" style="line-height:18px">*����������, ����������, �ӽú������� �����մϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">�ּҷ�</TD>
											<TD align="left" style="line-height:18px">*���θ��ϵ�� �� �׷켳���� �����մϴ�.</TD>
										</TR>
										<TR align="center">
											<TD bgcolor="#eeeeee">ȯ�漳��</TD>
											<TD align="left" style="line-height:18px">*�ް�������� ������ ���Űźμ��� �� �ܺ�POP3 ������ �����մϴ�.</TD>
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