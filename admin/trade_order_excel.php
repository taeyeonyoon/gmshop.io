<?
// �ҽ��������
// 20060720-1 �ҽ����� �輺ȣ : ������� ���� ����ȭ(ī��, �ڵ���, ������ü, �������, ������)
session_start();
$date = date("Ymd");
$time = date("His");
$f_name = "order".$date."_".$time.".csv";
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

$data=Decode64($data);
$pagecnt=$data[pagecnt];
$letter_no=$data[letter_no];
$offset=$data[offset];

if(!$searchstring)			//�˻�
{
	$search=$data[search];
	$searchstring=$data[searchstring];
}
if (!isset($status) || $status==6) $status_str="1=1";
else if (isset($status) && $status==0) $status_str = "status=$status";
else $status_str = "status=$status";

if($searchstring)//�˻�
	$numresults_qry = "select * from trade where $status_str and $search like '%$searchstring%'";
else
	$numresults_qry = "select * from trade where $status_str";

if(!empty($paym)) $numresults_qry.= " and payMethod='$paym'";
if (!empty($start)) $numresults_qry.= " and left(writeday,10) between '$start' and '$end'";
$bbs_qry = $numresults_qry." order by idx desc";
$bbs_result=$MySQL->query($bbs_qry);
$total_payM = 0;
$total_cnt = 0;
echo "�ֹ���¥,�ֹ���,�������,������,�������ּ�,��������ȭ,�������ڵ���,��ǰ��,�Ϲݿɼ�,����,����,�հ�,��ۺ�,�����ݻ��,�����ݾ�,�ŷ�����,��۾�ü,�����ȣ,���Ҹ�,�ֹ����� \r\n";
while($bbs_row=mysql_fetch_array($bbs_result))
{
	$trade_goods_qry ="select *from trade_goods where tradecode='$bbs_row[tradecode]' and $status_str $MALL_STR order by idx desc";
	$trade_goods_result = @$MySQL->query($trade_goods_qry) or die("Err. : $trade_goods_qry");
	$formCnt =0;
	while ($trade_goods_row = mysql_fetch_array($trade_goods_result))
	{
		$total_payM+= $bbs_row[payM];
		$payM = $bbs_row[payM];
		$total_cnt++;
		$encode_str = "idx=".$bbs_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
		$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
		$data=Encode64($encode_str);					//�� ���ڵ� ����
		if($bbs_row[payMethod] =="card") $payMethod="ī�����";
		elseif($bbs_row[payMethod] =="hand") $payMethod="�޴���";
		elseif($bbs_row[payMethod] =="iche") $payMethod="������ü";
		elseif($bbs_row[payMethod] =="cyber") $payMethod="�������";
		elseif($bbs_row[payMethod] =="bank") $payMethod="������";
		if($bbs_row[level_gubun]=="M") $name = $bbs_row[name]."[�Ϲ�ȸ��]";
		elseif($bbs_row[level_gubun]=="D") $name = $bbs_row[name]."[����]";
		else $name = $bbs_row[name]."[��ȸ��]";
		if(!$bbs_row[bPay])
		{
			//$bgcolor="#E9CFFE";
			$payMethod = "�̰���";
		}
		$formCnt++;
		$goods_qry = "select * from goods where idx=$trade_goods_row[goodsIdx]";
		$goods_result = @$MySQL->query($goods_qry);
		$goodsChek = @$MySQL->is_affected();
		$goods_row = mysql_fetch_array($goods_result);	//��ǰ����
		$optionArr = Array("$trade_goods_row[option1]","$trade_goods_row[option2]","$trade_goods_row[option3]");	//�ɼ� �迭
		$tprice = $trade_goods_row[price]*$trade_goods_row[cnt];	//��ǰ�հ���
		$writeday = substr($bbs_row[writeday],0,16);
		$EXCEL_STR = "$writeday,";
		$EXCEL_STR.="$name,";
		$EXCEL_STR.="$payMethod,";
		$EXCEL_STR.="$bbs_row[rname],";
		$EXCEL_STR.="$bbs_row[radr1]."." $bbs_row[radr2],";
		$EXCEL_STR.="$bbs_row[rtel],";
		$EXCEL_STR.="$bbs_row[rhand],";
		$EXCEL_STR.="$goods_row[name],";
		for($i=0;$i<count($optionArr);$i++)
		{
			if(!empty($optionArr[$i]))
			{
				$option = explode("����",$optionArr[$i]);
				$option[0] = str_replace(",","",$option[0]);
				$option[1] = str_replace(",","",$option[1]);
				if ($option[1])  $EXCEL_STR.="$option[0] : $option[1] ";
			}
			else
			{
				$option[0]=""; $option[1]="";
			}
		}
		$EXCEL_STR.=",";
		$status = $TRADE_ARR[$trade_goods_row[status]];
		$content = str_replace("\r\n","",$bbs_row[content]);
		$mana_content = str_replace("\r\n","",$bbs_row[mana_content]);
		$EXCEL_STR.="$trade_goods_row[price],";
		$EXCEL_STR.="$trade_goods_row[cnt],";
		$EXCEL_STR.="$tprice,";
		$EXCEL_STR.="$bbs_row[transM],";
		$EXCEL_STR.="$bbs_row[useP],";
		$EXCEL_STR.="$payM,";
		$EXCEL_STR.="$status,";
		$EXCEL_STR.="$trade_goods_row[trans_company],";
		$EXCEL_STR.="$trade_goods_row[trans_num], ";
		$EXCEL_STR.="$content,";
		$EXCEL_STR.="$mana_content \r\n";

		echo $EXCEL_STR;
	}//trade_goods_result
}//while
?>