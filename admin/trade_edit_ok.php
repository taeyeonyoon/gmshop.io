<?
include "head.php";

if ($_POST["del_trade"]) // �˻��Ⱓ������ �ֹ����� ����
{
	if (strlen($mo)==1) $mo = "0".$mo;
	if (strlen($da)==1) $da = "0".$da;
	$day = $ye."-".$mo."-".$da;
	$MySQL->query("DELETE from trade WHERE writeday < '$day'");
	$MySQL->query("DELETE from trade_temp WHERE writeday < '$day'");
	$MySQL->query("DELETE from trade_goods WHERE sday1 < '$day'");
	MsgViewHref("���� �Ϸ��Ͽ����ϴ�.","trade_order.php");
	exit;
}
if ($data) $dataArr = Decode64($data);
$trade_row = $MySQL->fetch_array("select * from trade where idx=$dataArr[idx]");

if($del)
{
	//===================================== ��ǰ�� �ش� ��� ����============================================================
	if ($trade_row[bPay]) // �ֹ��� �̰����Ȱ��� ���谨�� �����Ƿ� �����Ѵ�
	{
		$qry = "select *from trade_goods where tradecode='$trade_row[tradecode]' and status <4";
		$result = @$MySQL->query($qry);
		while($trade_goods_row = mysql_fetch_array($result))
		{
			$goods_row = $MySQL->fetch_array("select *from goods where idx=$trade_goods_row[goodsIdx] limit 1");
			if($goods_row[bLimit])
			{
				@$MySQL->query("update goods set limitCnt=limitCnt+$trade_goods_row[cnt]  where idx=$trade_goods_row[goodsIdx]");
			}
		}
	}

	//////////////////////// ������ ���� ////////////////////////////////////////////////////////
	if($trade_row[userid_part]=="member")
	{
		///////////////////////////////////// ȸ���� ��� ������ ����//////////////////////////
		//===================================== ��ǰ�� �ش� ������ ȸ��============================================================
		$qry = "select *from trade_goods where tradecode='$trade_row[tradecode]' and bPsupply=1";
		$result = @$MySQL->query($qry);
		while($trade_goods_row = mysql_fetch_array($result))
		{
			@$MySQL->query("update member set point=point-$trade_goods_row[goodsP] where userid='$trade_row[userid]'");
			$trade_goodsP =$trade_goods_row[goodsP]*(-1);
			$point_qry = "insert into point_table(part,userid,point,reason,writeday)values(";
			$point_qry.= "'ȸ��','$trade_row[userid]',$trade_goodsP,'�ֹ��� ���� [�ֹ��ڵ�:$trade_goods_row[tradecode]]',now())";
			@$MySQL->query($point_qry);
		}
		//===================================== ����� ������ ���� ===============================================================
		if($trade_row[bPsupply]==1 && $trade_row[useP])
		{
			@$MySQL->query("update member set point=point+$trade_row[useP] where userid='$trade_row[userid]'");
			$point_qry = "insert into point_table(part,userid,point,reason,writeday)values(";
			$point_qry.= "'����','$trade_row[userid]',$trade_row[useP],'�ֹ��� ���� [�ֹ��ڵ�:$trade_row[tradecode]]',now())";
			@$MySQL->query($point_qry);
		}
		//ȸ�������� ���ż�,���ž� ������Ʈ//
		$buyNum = $MySQL->fetch_array("select count(*) from trade where userid='$trade_row[userid]' and bPay=1 and status<4");
		$buyMoney =$MySQL->fetch_array("select sum(totalM) from trade where userid='$trade_row[userid]' and bPay=1 and status<4");
		//ȸ�� ���ż�, ���ž� ����
		if(empty($buyNum[0])) $buyNum[0] =0;
		if(empty($buyMoney[0])) $buyMoney[0] =0;
		$editQry = "update member set buyNum=$buyNum[0],buyMoney=$buyMoney[0] where userid='$trade_row[userid]'";
		@$MySQL->query($editQry);
	}
	/////////////////////////////////////////////////////////////////////////////////////////////
	if($MySQL->query("delete from trade_goods where tradecode='$trade_row[tradecode]'"))
	{
		if($MySQL->query("delete from trade where idx=$dataArr[idx]"))
		{
			OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
			close_par_refresh();
		}
		else
		{
			echo"trade delete Err.";
		}
	}
	else
	{
		echo"trade_goods delete Err.";
	}
}
?>