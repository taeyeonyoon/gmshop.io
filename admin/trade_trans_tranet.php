<?
session_start();
$date = date("Ymd");
$time = date("His");
$f_name = "invoice".$date."_".$time.".xls";
header( "Content-type: application/vnd.ms-excel; charset=ks_c_5601-1987");
header( "Content-Disposition: attachment; filename=$f_name");
header( "Content-Description: PHP4 Generated Data");
include "../lib/config.php";
include "../lib/function.php";
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select * from admin limit 0,1");
}

$spec_report = $admin_row[trans_content];
$trans_goodname = $admin_row[trans_goodname];

$qry = "select * from trade where status=1";
$f_result=$MySQL->query($qry);
$today = date("Y-m-d",time());
//echo "ȸ���\t������\t��ȭ��ȣ\t�ڵ���\t�����ȣ\t�ּ�\tȭ����\t���ǻ���\tƯ����� \n";
//echo "����\t��¥\t�����ȣ\t�ּ�\t��ȭ��\t��ȭ1\t��ȭ2\t�޼���1\t�޼���2\t����\t�Ϸù�ȣ\t����\t����\tǰ��\n";
echo"������ ����\t������ ����ó1\t������ ����ó2\t������ �����ȣ\t������ �ּ�\tbox����\tboxũ��\t��������\t������ �޸�\n";

$i=1;
while($f_row = mysql_fetch_array($f_result))
{
	$content = str_replace("\r\n","",$f_row[content]);
	if ($f_row[payMethod]=="card") $payMethod = "ī��";
	else if ($f_row[payMethod]=="bank") $payMethod = "������";
	else if($f_row[payMethod]==$HAND_STR) $payMethod = "�ڵ���";
	else if($f_row[payMethod]=="iche") $payMethod = "������ü";
	else if($f_row[payMethod]=="cyber") $payMethod = "�������";

	$EXCEL_STR.="$f_row[rname]\t";
	$EXCEL_STR.="$f_row[rtel]\t";
	$EXCEL_STR.="$f_row[rhand]\t";
	$EXCEL_STR.="$f_row[rzip]\t";
	$EXCEL_STR.="$f_row[radr1] $f_row[radr2]\t";
	$EXCEL_STR.= "1\t";
	$EXCEL_STR.= "\t";
	$EXCEL_STR.= "$payMethod\t";
	$EXCEL_STR.="$content\t\n";

	echo $EXCEL_STR;
	$i++;
}
?>