<?
session_start();
include "./lib/config.php";
include "./lib/function.php";
include "./lib/class.php";
if($cartadd)
{
	//��ٱ��� ���
	$idxstr = Laststrcut($idxstr);
	$idx_arr = explode("/",$idxstr);
	if (count($idx_arr)<2) $idx_arr[0] = $idxstr;
	for ($i=0; $i<count($idx_arr); $i++)
	{
		$compare_row = $MySQL->fetch_array("SELECT goodsIdx from compare WHERE idx=$idx_arr[$i] limit 1");
		$goods_row	  = $MySQL->fetch_array("select *from goods where idx=$compare_row[goodsIdx] limit 1"); //����ǰ�� ��ǰ ����
		$gprice = new CGoodsPrice($goods_row[idx]);
		$chek_qry = "select *from cart where userid='$_SESSION[GOOD_SHOP_USERID]' and goodsIdx=$compare_row[goodsIdx] and option1='$option1' and option2='$option2' and option3='$option3' limit 1";	//�ߺ�üũ
		$MySQL->query($chek_qry);
		if($MySQL->is_affected())
		{
			//������ǰ�� ���� ��ٱ��Ͽ� ������ ��� ������ ����
			$add_qry = "update cart set cnt=cnt+1 where userid='$_SESSION[GOOD_SHOP_USERID]' and goodsIdx=$compare_row[goodsIdx] and option1='$option1' and option2='$option2' and option3='$option3'";
		}
		else
		{
			//��ٱ��� ���
			$price = $gprice->Price();
			$point = $gprice->PutPoint();
			if (empty($price)) $price=0;
			if (empty($point)) $point=0;
			$add_qry = "insert into cart(userid,goodsIdx,cnt,option1,option2,option3,price,point,writeday)values(";
			$add_qry.= "'$_SESSION[GOOD_SHOP_USERID]',$compare_row[goodsIdx],1,'',";
			$add_qry.= "'','',";
			$add_qry.= "$price,$point,now())";
		}
		$MySQL->query($add_qry);
		$MySQL->query("delete from compare where goodsIdx=$compare_row[goodsIdx]");
	}
	if ($st=="cart") ReFresh("cart.php");
	if ($st=="order") ReFresh("order_sheet.php");
}
else if($del)
{
	// ����ǰ�� ����
	$idxstr = Laststrcut($idxstr);
	$idx_arr = explode("/",$idxstr);
	if (count($idx_arr)<2) $idx_arr[0] = $idxstr;
	for ($i=0; $i<count($idx_arr); $i++)
	{
		$add_qry = "delete from compare where idx= $idx_arr[$i]";
		$MySQL->query($add_qry);
	}
	ReFresh("mypage_compare.php");
}
?>