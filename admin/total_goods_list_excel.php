<?
session_start();
$date = date("Ymd");
$time = date("His");
$f_name = "goods".$date."_".$time.".xls";
header( "Content-type: application/vnd.ms-excel; charset=ks_c_5601-1987");
header( "Content-Disposition: attachment; filename=$f_name");
header( "Content-Description: PHP4 Generated Data");
include "../lib/config.php";
include "../lib/function.php";
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");	//������ ���� �迭
}
$EXCEL_STR = "<table><tr><td>��ǰ�ڵ�</td><td>ī�װ�</td><td>��ǰ��</td><td>�𵨸�</td><td>������</td><td>������</td><td>������</td><td>���԰�</td><td>�ΰ���</td><td>��ۺ�</td><td>PG������</td><td>���Կ���</td><td>�ǸŰ�</td><td>������</td><td>��ǰ�̹���1</td><td>��ǰ�̹���2</td><td>��ǰ�̹���3</td><td>Ȯ���̹���1</td><td>Ȯ���̹���2</td><td>Ȯ���̹���3</td><td>Ȯ���̹���4</td><td>Ȯ���̹���5</td><td>���̹���1</td><td>���̹���2</td><td>���̹���3</td><td>���̹���4</td><td>�󼼼���</td><td>�����</td><td>���</td></tr></table>";
include "linkstr_goods.php";
$CATE_SEARCH_STR =" and category='$search_category' ";
//Ư����ġ Url ��ũ����
///////////////////	0		  1			 2		    3	 //////////
$postrArr = Array("��ü","���� ����Ʈ","���� ��Ʈ","���� �ű�");
// ī�װ� ���� 
$data=Decode64($data);
$pagecnt=$data[pagecnt];
$letter_no=$data[letter_no];
$offset=$data[offset];
$new_str = SearchCheck($searchstring); // �˻�� ������ �빮�ڷ� �ٲ� ���ڿ�
if(!$searchstring)
{			//�˻�
	$search=$data[search];
	$searchstring=$data[searchstring];
}
if($searchstring)
{//�˻�
	if($search=="price")
	{			//���ݰ˻�
	$searchLen = (strlen($searchstring) -1)*-1;		//���� �ݿø�����
	$searchstring = round($searchstring,$searchLen);
	$total_qry ="select * from goods where truncate(price,$searchLen) = $searchstring ";
	}
	else
	{				//�Ϲݰ˻�
		$total_qry.="select * from goods where ($search like '%$searchstring%' or upper($search) like '%$new_str%') $MALL_STR";
	}
}
else
{
	$total_qry ="select *from goods where 1=1 $MALL_STR ";
}
if($search_category)  $total_qry.=" $CATE_SEARCH_STR ";
if($etc)
{
	if($etc=="delay")  $total_qry.=" and delay=1 ";
	else if($etc=="stock") $total_qry.=" and ((bLimit=1 and limitCnt=0) or (bLimit=2)) ";
}
//////////���������� Ư����ġ///////////// 
if($best) $total_qry = "select goods.* from goods,position where goods.idx=position.goodsIdx and position.part='mainbest' ";
if($hit) $total_qry = "select goods.* from goods,position where goods.idx=position.goodsIdx and position.part='mainhit' ";
if($new) $total_qry = "select goods.* from goods,position where goods.idx=position.goodsIdx and position.part='mainnew' ";//order by position.sunwi asc

$numresults=@$MySQL->query($total_qry);
$numrows=mysql_num_rows($numresults);				//�� ���ڵ��
$goods_qry = $total_qry." order by idx desc";
$goods_result=@$MySQL->query($goods_qry);
$s_letter=$letter_no;								//�������� ���� �۹�ȣ
while($goods_row=mysql_fetch_array($goods_result))
{
	$encode_str = "idx=".$goods_row[idx]."&pagecnt=".$pagecnt."&letter_no=".$s_letter."&offset=".$offset;
	$encode_str.= "&search=".$search."&searchstring=".$searchstring."&present_num=".$letter_no;
	$data=Encode64($encode_str);
	///////////////ī�װ� ����////////////////////
	$cate[0]="";
	$cate_row = $MySQL->fetch_array("select name from category where code='$goods_row[category]' limit 1");
	$cate[0] = $cate_row[name];
	/////////////������////////////////// 
	if ($goods_row[bLimit]==0) $limitCnt="������";
	else if ($goods_row[bLimit]==1) $limitCnt="����";
	else if ($goods_row[bLimit]==2) $limitCnt="ǰ��";
	else if ($goods_row[bLimit]==3) $limitCnt="����";
	else if ($goods_row[bLimit]==4) $limitCnt="����";
	///////////////����//////////////// 
	$price = $goods_row[price];	
	///////////////���ް�//////////////// 
	if($goods_row[supplyprice]) $sprice = $goods_row[supplyprice];
	else		         $sprice = 0;

	$VAT = $sprice * 0.01;
	/////////////��ۺ�/////////////
	if(empty($admin_row[bTrans]) && empty($admin_row[chakbul]))			{$transM = 0;	$transMstr = "����"; }	//��ۺ�̻��
	else if(empty($admin_row[bTrans]) && $admin_row[chakbul])			{$transM = 0;   $transMstr = "����"; }	//��ۺ�̻��&���� 
	else $transM = $admin_row[transMoney];
	/////////////������ǰ�ִ���/////////
	$PG = $admin_row[pg_rate];
	//////////////���Կ���//////////////// ���ް� + �ΰ��� + ��ۺ� * PG������ 
	$real_sprice = round(($sprice + $VAT + $transM) * (1 + ($PG * 0.01))); 
	$EXCEL_STR ="<table><tr><td>$goods_row[code]</td>";
	$EXCEL_STR.="<td>$cate[0]</td>";
	$EXCEL_STR.="<td>$goods_row[name]</td>";
	$EXCEL_STR.="<td>$goods_row[model]</td>";
	$EXCEL_STR.="<td>$goods_row[company]</td>";
	$EXCEL_STR.="<td>$goods_row[origin]</td>";
	$EXCEL_STR.="<td>$limitCnt</td>";
	$EXCEL_STR.="<td>$sprice</td>";	 
	$EXCEL_STR.="<td>$VAT</td>";
	$EXCEL_STR.="<td>$transM</td>";
	$EXCEL_STR.="<td>$PG</td>";
	$EXCEL_STR.="<td>$real_sprice</td>";
	$EXCEL_STR.="<td>$price</td>";
	$EXCEL_STR.="<td>$goods_row[margin]</td>";
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[img1]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[img2]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[img3]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[img4]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[img5]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[img6]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[img7]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[img8]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[detailimg1]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[detailimg2]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[detailimg3]</td>"; 
	$EXCEL_STR.="<td>http://$admin_row[shopUrl]/upload/goods/$goods_row[detailimg4]</td>"; 
	$EXCEL_STR.="<td>".htmlspecialchars($goods_row[content])."</td>";
	$EXCEL_STR.="<td>$goods_row[writeday]</td></tr></table>";
	echo $EXCEL_STR;
}//while
?>