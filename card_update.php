<?
// �ҽ��������
// 20060719-1 ���ϱ�ü �輺ȣ: 1.�����õ���� ����, 2.�ڷ����� ���� ����������� ����
include "head.php";
if(empty($useP)) $useP =0;
if(empty($payM)) $payM =0;
if(empty($transM)) $transM =0;
if(empty($totalM)) $totalM =0;
if(!empty($tradecode))
{
	$temp_qry = "update trade_temp set payM=$payM,useP=$useP,transM=$transM,totalM=$totalM,transMethod='$transMethod' where tradecode='$tradecode'";
	$trade_qry = "update trade set payMethod='".$payMethod."' where tradecode='".$tradecode."'";
	if ($MySQL->query($temp_qry) && $MySQL->query($trade_qry))
	{
	}
	else
	{
		OnlyMsgView("�������� ������ �߻��Ͽ����ϴ�. �����ڿ��� �������ֽñ� �ٶ��ϴ�.");
	}
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function OnPayAct()
{
	<?
	if($admin_row[pgName]=="dacom")	//�����ڿ��� ������ ī���� : ��ȣȭ ��� ����
	{
		$hashdata = md5($admin_row[shopId].$tradecode.$payM.$admin_row[shop_pg_mertkey]);	//��ȣȭ�� hashdata �����
		echo "parent.document.dacomForm.hashdata.value = '".$hashdata."';\n";
	}

	switch ($payMethod):
		case 'card':	$ParentPayAct = "	parent.go_card();\n";			break;	//�ſ�ī��
		case 'hand':	$ParentPayAct = "	parent.go_card();\n";			break;	//�ڵ���
		case 'iche':	$ParentPayAct = "	parent.go_card();\n";			break;	//������ü
		case 'cyber':	$ParentPayAct = "	parent.go_card();\n";			break;	//�������
		case 'bank':	$ParentPayAct = "	parent.document.payForm.submit();\n";	break;	//����������
		default :		$ParentPayAct = "";		break;	//�������� ����
	endswitch;

	switch ($pay_ready):
		case 'paysendit':	//���������� ����
			echo $ParentPayAct;
			break;

		case 'usePoint':		//������ �����
			echo "	parent.document.usePform.pay_ready.value = 'paysendit';\n";
			echo "	parent.bank_select();\n";
			break;

		default :			//���������� �ε���
			echo "	parent.document.usePform.pay_ready.value = 'paysendit';\n";
			echo "	parent.bank_select();\n";
			echo "	parent.viewAct('nsAct');\n";
			break;
	endswitch;
	?>
}
//-->
</SCRIPT>
<body onload="OnPayAct();">
</body>
</html>