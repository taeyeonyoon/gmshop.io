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
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");
}

$qry = "select * from trade where status=1";
$f_result=$MySQL->query($qry);
echo "ȸ���\t�����\t��ȭ��ȣ\t�����ȣ\t�ּ�\t��Ÿ�ּ�\tǰ��1\tŸ��1\t����1\t���ӱ���\t�⺻����\t��Ÿ����\t���ǻ���\t������ȣ\t�ֹ���\t�������\t�ļ�����\tǰ��5\tǰ��6\t�ڵ���\t�ֹ���ȣ\t���� \n";
$i=1;
while($f_row = mysql_fetch_array($f_result))
{
	$content = str_replace("\r\n","",$f_row[content]);
	$EXCEL_STR = "";
	$EXCEL_STR.="$admin_row[comName]\t";
	$EXCEL_STR.="$f_row[rname]\t";
	$EXCEL_STR.="$f_row[rtel]\t";
	$EXCEL_STR.="$f_row[rzip]\t";
	$EXCEL_STR.="$f_row[radr1]\t";
	$EXCEL_STR.="$f_row[radr2]\t";
	$EXCEL_STR.="\t";
	$EXCEL_STR.="1\t";
	$EXCEL_STR.="1\t";
	$EXCEL_STR.="3\t";
	$EXCEL_STR.="\t";
	$EXCEL_STR.="\t";
	$EXCEL_STR.="$content\t";	//���� , Ư�����
	$EXCEL_STR.="$f_row[trans_num]\t";
	$EXCEL_STR.="$f_row[name]\t";
	$EXCEL_STR.="\t";	//�������
	$EXCEL_STR.="\t";	//�ļ�����
	$EXCEL_STR.="\t";	//ǰ��5
	$EXCEL_STR.="\t";	//ǰ��6
	$EXCEL_STR.="$f_row[rhand]\t";
	$EXCEL_STR.="$f_row[tradecode]\t";
	$EXCEL_STR.="����\n";

	echo $EXCEL_STR;
	$i++;
}
?>