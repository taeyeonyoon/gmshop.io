<?
session_start();
include "./lib/config.php";
include "./lib/function.php";
/*------------------------���� ����ǰ�� ����,����,����---------------------------------*/
if($act=="cartadd")
{
	//��ٱ��� ���
	$intIdxArr  = explode("����",$idxStr);
	$cntArr		= explode("����",$cntStr);
	for($i=0;$i<count($intIdxArr);$i++)
	{
		$interest_row = $MySQL->fetch_array("select *from interest where idx=$intIdxArr[$i]");		 //����ǰ�� ����
		$goods_row	  = $MySQL->fetch_array("select *from goods where idx=$interest_row[goodsIdx]"); //����ǰ�� ��ǰ ����
		$chek_qry = "select * from cart where userid='$_SESSION[GOOD_SHOP_USERID]' and goodsIdx=$interest_row[goodsIdx] and ";	//�ߺ�üũ
		$chek_qry.= "option1='$interest_row[option1]' and option2='$interest_row[option2]' ";
		$chek_qry.= " and option3='$interest_row[option3]' ";
		$MySQL->query($chek_qry);
		if($MySQL->is_affected())
		{
			//������ǰ�� ���� ��ٱ��Ͽ� ������ ��� ������ ����
			$add_qry = "update cart set cnt=cnt+$cntArr[$i] where userid='$_SESSION[GOOD_SHOP_USERID]' and goodsIdx=$interest_row[goodsIdx] and ";
			$add_qry.= " option1='$interest_row[option1]' and option2='$interest_row[option2]' ";
			$add_qry.= " and option3='$interest_row[option3]' ";
		}
		else
		{
			//��ٱ��� ���
			$price = $interest_row[price];
			$point = $interest_row[point]*$cntArr[$i];
			$add_qry = "insert into cart(userid,goodsIdx,cnt,option1,option2,option3,price,point,writeday)values(";
			$add_qry.= "'$_SESSION[GOOD_SHOP_USERID]',$interest_row[goodsIdx],$cntArr[$i],'$interest_row[option1]',";
			$add_qry.= "'$interest_row[option2]','$interest_row[option3]',";
			$add_qry.= "$price,$point,now())";
		}
		$MySQL->query($add_qry);
		$MySQL->query("delete from interest where idx=$intIdxArr[$i]");
	}
	if($goUrl =="cart") ReFresh("cart.php");
	else ReFresh("order_sheet.php");
}
else if($act =="selectdel")
{
	$intIdxArr  = explode("����",$idxStr);
	for($i=0;$i<count($intIdxArr);$i++)
	{
		$add_qry = "delete from interest where idx= $intIdxArr[$i]";
		$MySQL->query($add_qry);
	}
	ReFresh("mypage_interest.php");
}
else if($act =="del")
{
	$del_qry = "delete from interest where idx=$intIdx";
	if($MySQL->query($del_qry)) ReFresh("mypage_interest.php");
	else echo"Err. : $del_qry";
}
?>