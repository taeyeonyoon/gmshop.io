<?
include "head.php";
$codeArr = explode("-",$strCode);				//ī�װ� �ڵ� �迭
$poArr	 = explode("-",$strPosition);			//ī�װ� ���� �迭
for($i=0;$i<count($codeArr);$i++)
{
	$cate_row = $MySQL->fetch_array("select *from category where code='$codeArr[$i]'");
	$positionArr[$i] = $cate_row[position];		//�θ�ī�װ� ���� ������ �迭
}
$inv_poArr		 = array_flip($poArr);          //����,Ű �ٲ�
$sum_position =0;
for($i=0;$i<count($poArr);$i++)
{
	$inv_Index = $inv_poArr[$i]; 
	if($i==0) $__START = $positionArr[0];					//���� ī�װ� ������ ���۰� ����
	else	  $__START = $sum_position;
	$sum_position =$__START+1;		//���� ī�װ� ������ ���۰� ����
	$diver =$__START - $positionArr[$inv_Index];			// ������ ��ȭ�� 
	//ī�װ� ��� ������ ����
	$MySQL->query("update category set position=position +$diver where code='$codeArr[$inv_Index]'");
}
if(empty($parentcode))
{
	ReFresh("category_position.php");
}
else
{
	ReFresh("category_position.php?parentcode=$parentcode");
}
?>