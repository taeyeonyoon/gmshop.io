<?
include "head.php";
$trans_company = $admin_row[transCom];	// ��ϻ󿡼� �ŷ����� �ϰ����������� �̸� ��ۻ纯�� �����ؾ��� 
$sms = $MySQL->fetch_array("select * from smsinfo");
if (!$tgidx) $type = "all"; // �ϰ�������� ���

// �ֹ����� �迭            0			1		2		3			4		5
// $TRADE_ARR	 = array("�ֹ�����","����Ȯ��","�����","��ۿϷ�","�ֹ����","��ǰó��");

$sdayArr = array("sday1","sday2","sday3","sday4","sday5","sday6");
if ($data) $dataArr = Decode64($data);

// ��ϻ󿡼� �ŷ����� �ϰ�����������
if ($status_list_change == "y")
{
	$str = Laststrcut($select_str);
	$str_arr = explode("/",$str);
	if (count($str_arr)<2) $str_arr[0] = $str;
	$formno_str = Laststrcut($formno_str);
	$formno_str_arr = explode("/",$formno_str);
	if (count($formno_str_arr)<2) $formno_str_arr[0] = $formno_str;
	$transnum_str = Laststrcut($transnum_str);
	$transnum_str_arr = explode("/",$transnum_str);
	if (count($transnum_str_arr)<2) $transnum_str_arr[0] = $transnum_str;
}
else	// ��� �ϰ������� �ƴҶ��� for���� ���⶧���� $str_arr[0] �� trade_row idx�� ���� 
{
	$str_arr[0] = $dataArr[idx];
	$trans_company = $tc;
	$transnum_str_arr[0] = $tn;
}
for ($status_i=0; $status_i<count($str_arr); $status_i++)
{
	$trade_row	= $MySQL->fetch_array("select *from trade where idx=$str_arr[$status_i]");	// �ֹ�����
	$nowStatus	= $trade_row[status];	// �������
	$newStatus	= $status;	// ���ο� ����

	// ��������� �ƴҶ� trade�� ��ۻ�,�����ȣ�� ������Ʈ 
	// if (!$tgidx && $newStatus>=2 && $newStatus<=3)
	// ��ü �ֹ��ǿ� ���� �����ŷ����´� �����Ѵ�. 
	$qry="update trade set status=$newStatus WHERE tradecode='$trade_row[tradecode]'";
	$MySQL->query($qry);
	$tgnum = $MySQL->articles("SELECT idx from trade_goods WHERE tradecode='$trade_row[tradecode]'");
	// $tgidx���� ������ ������ǰ ���º�����. 
	if ($tgidx) $TG_QRY = " and idx=$tgidx";	// �ֹ���ǰ�� �Ѱ��϶��� �ֹ���һ��·� �ϰ������ص� �ٲ�� 1.31 �����
	else if ($tgnum==1) $TG_QRY = "";
	else $TG_QRY = " and status<4";	// ���� �ֹ���ǰ������ �ƴ϶�� �ֹ���� ������ ���¸� ����ǵ���!! 2006. 1. 4 ����  
	$qry = "select * from trade_goods where tradecode='$trade_row[tradecode]' $TG_QRY";
	$result = $MySQL->query($qry);
	$goods_name = "";
	while($trade_goods_row = mysql_fetch_array($result))
	{
		$nowStatus		= $trade_goods_row[status];	//�������
		$newStatus		= $status;			//���ο� ����
		$goods_row = $MySQL->fetch_array("select * from goods where idx=$trade_goods_row[goodsIdx]");
		// ������ ����
		if($goods_row[bLimit])
		{
			if($nowStatus <4 && $newStatus >3)
			{
				@$MySQL->query("update goods set limitCnt=limitCnt+$trade_goods_row[cnt] where idx=$trade_goods_row[goodsIdx]");
			} // �ֹ���ҿ��� ��ۿϷ�� 
			else if($nowStatus >3 && $newStatus <4)
			{
				@$MySQL->query("update goods set limitCnt=limitCnt-$trade_goods_row[cnt] where idx=$trade_goods_row[goodsIdx]");
			}
		}
		$goods_name.=$goods_row[name]."<br>";
		$nowsdayArr = array("$trade_goods_row[sday1]","$trade_goods_row[sday2]","$trade_goods_row[sday3]","$trade_goods_row[sday4]","$trade_goods_row[sday5]","$trade_goods_row[sday6]");		//���� ���� ��¥ �迭
		//=====================================  �ش� ��ǰ ��¥ ���� =================================================================== 
		if($newStatus ==0)
		{
			for($i=1;$i<count($sdayArr);$i++)
			{
				$editQry = "update trade_goods set $sdayArr[$i] = NULL where idx=$trade_goods_row[idx]";
				@$MySQL->query($editQry) or die("Err. : $editQry");
			}
		}
		else if($nowStatus > $newStatus)
		{
			for($i=$newStatus;$i<count($sdayArr);$i++)
			{
				if($i==$newStatus)
				{
					$editQry = "update trade_goods set $sdayArr[$i] = now() where idx= $trade_goods_row[idx]";
					$editQry1 = "update trade set $sdayArr[$i] = now() where tradecode='$trade_goods_row[tradecode]'";
				}
				else
				{
					$editQry = "update trade_goods set $sdayArr[$i] = NULL where idx=$trade_goods_row[idx]";
					$editQry1 = "update trade set $sdayArr[$i] = NULL where tradecode='$trade_goods_row[tradecode]'";
				}
				@$MySQL->query($editQry) or die("Err. : $editQry");
				@$MySQL->query($editQry1) or die("Err. : $editQry1");
			}
		}
		else
		{
			/////�ֹ���� ���� �ܰ��϶�////////// 
			if($newStatus <4)
			{
				for($i=0;$i<$newStatus;$i++)
				{
					if(empty($nowsdayArr[$i]))
					{
						$editQry = "update trade_goods set $sdayArr[$i] =now() where idx=$trade_goods_row[idx]";
						@$MySQL->query($editQry) or die("Err. : $editQry");
						$editQry1 = "update trade set $sdayArr[$i] =now() where tradecode='$trade_goods_row[tradecode]'";
						@$MySQL->query($editQry1) or die("Err. : $editQry1");
					}
				}
				$editQry = "update trade_goods set $sdayArr[$newStatus] =now() where idx=$trade_goods_row[idx]";
				$editQry1 = "update trade set $sdayArr[$newStatus] =now() where tradecode='$trade_goods_row[tradecode]'";
				$MySQL->query($editQry);
				$MySQL->query($editQry1);
				////��ۿϷ��� ���¿��� �ֹ���� ���·�//
			}
			else if($newStatus >3 && $nowStatus <4)
			{
				$editQry = "update trade_goods set $sdayArr[$newStatus] =now() where idx=$trade_goods_row[idx]";
				$MySQL->query($editQry);
			}
			else
			{
				$editQry = "update trade_goods set $sdayArr[$newStatus] =now(),$sdayArr[$nowStatus]=NULL where idx=$trade_goods_row[idx]";
				$MySQL->query($editQry);
			}
		}
		$qry = "update trade_goods set status=$newStatus";
		if ($transnum_str_arr[$status_i] && ($newStatus==2 || $newStatus==3))
		{
			$qry.=" ,trans_num='$transnum_str_arr[$status_i]'"; // �����ȣ �������� ������Ʈ 
			$qry.=" ,trans_company='$trans_company'"; // �ù�� ù ������Ʈ�϶� 
		}
		$qry.=" where idx=$trade_goods_row[idx]";
		$MySQL->query($qry);
	} /////////////////// while 
	//=====================================  ��� ���Ϲ߼� ========================================================================
	if($newStatus==2 && $admin_row[bTramail]=="y" )
	{
		$trans_company = $trans_company;
		$trans_num = $transnum_str_arr[$status_i];
		if (!$tgidx) $type = "all"; // �ϰ�������� ��� 
		include "../email/goods_trans.php";
	}
	if($newStatus==2)
	{
		//sms ������ ����/////////////////////////////////////////////////////////////////////////////
		if($sms[bSms] && !empty($sms[userid]) && !empty($sms[pwd]))
		{
			//��� sms ������
			$SMS_PART = "send";
			include "../sms/smsclient.php";
		}
		//sms ������ ��/////////////////////////////////////////////////////////////////////////////
	}
	//=====================================  �ֹ���� ���Ϲ߼� ========================================================================
	if($newStatus==4 && $admin_row[bEscmail]=="y" )
	{
		include "../email/goods_order_cancel.php";
		///////4.3 �߰� 
		if($sms[bSms] && !empty($sms[userid]) && !empty($sms[pwd]))
		{
			$temp_row[name] = $trade_row[name];
			$temp_row[hand] = $trade_row[hand];
			$payMethod = $trade_row[payMethod];
			$trade_goods_row = $MySQL->fetch_array("SELECT name from trade_goods WHERE tradecode='$trade_row[tradecode]' limit 1");
			$SMS_GOODS = StringCut($trade_goods_row[name],20);
			if ($trade_row[userid_part]=="member") //ȸ������
			{
				if ($MySQL->articles("SELECT idx from member WHERE userid='$trade_row[userid]' and bSms='y'")) // SMS ���� ����ߴ���
				{
					$SMS_PART = "cancel";
					include "../sms/smsclient.php";
				}
			}
			else //��ȸ���̸� ������ SMS�߼�
			{
				$SMS_PART = "cancel";
				include "../sms/smsclient.php";
			}
		}
		///////4.3 �߰� �� 
	}
	//=====================================  ����Ȯ�� ���Ϲ߼� ========================================================================
	if($newStatus==1)
	{
		if (!$tgidx) $type = "all"; // �ϰ�������� ��� 
		include "../email/b2b_credit.php"; // ������,�� 
	}
	if($trade_row[userid_part]=="member")
	{
		///////////////////////////////////// ȸ���� ��� ������ ����//////////////////////////
		$qry = "select * from trade_goods where tradecode='$trade_row[tradecode]' $TG_QRY";
		$result = $MySQL->query($qry);
		while ($trade_goods_row = mysql_fetch_array($result))
		{
			//��ۿϷ� , �ֹ����
			$MySQL->query("select *from trade_goods where status=3 and tradecode='$trade_row[tradecode]'");
			$completeTrCnt = $MySQL->is_affected();
			$MySQL->query("select *from trade_goods where status > 3 and tradecode='$trade_row[tradecode]'");
			$cancelTrCnt = $MySQL->is_affected();
			$MySQL->query("select *from trade_goods where tradecode='$trade_row[tradecode]'");
			$goodsTrCnt = $MySQL->is_affected();
			// ��ǰ�� �ش� ������ ���� /ȸ��
			if($trade_goods_row[bPsupply]==0 && $newStatus ==3)
			{
				//������ ����
				$MySQL->query("update trade_goods set bPsupply =1 where idx=$trade_goods_row[idx]");
				if ($trade_goods_row[goodsP])
				{
					$MySQL->query("update member set point=point+$trade_goods_row[goodsP] where userid='$trade_row[userid]'");
					$point_qry = "insert into point_table(part,userid,point,reason,writeday)values(";
					$point_qry.= "'����','$trade_row[userid]',$trade_goods_row[goodsP],'��ǰ���� [�ֹ��ڵ�:$trade_goods_row[tradecode]]',now())";
					$MySQL->query($point_qry);
				}
				// ��ۿϷ�� ȸ�������� ���ż�,���ž� ������Ʈ
				$buyNum = $MySQL->fetch_array("select count(*) from trade where userid='$trade_row[userid]' and bPay=1 and status<4");
				$buyMoney =$MySQL->fetch_array("select sum(payM) from trade where userid='$trade_row[userid]' and bPay=1 and status<4");
				// ȸ�� ���ż�, ���ž� ����	 
				if(empty($buyNum[0])) $buyNum[0] =0;
				if(empty($buyMoney[0])) $buyMoney[0] =0;
				$editQry = "update member set buyNum=$buyNum[0],buyMoney=$buyMoney[0],nearBuy=now() where userid='$trade_row[userid]'";
				$MySQL->query($editQry);
				// �ֹ���ҽ�
			}
			else if($trade_goods_row[bPsupply]==1 && $newStatus!=3)
			{
				//���޵� ������ ȸ��
				$MySQL->query("update trade_goods set bPsupply =0 where idx=$trade_goods_row[idx]");
				if ($trade_goods_row[goodsP])
				{
					$MySQL->query("update member set point=point-$trade_goods_row[goodsP] where userid='$trade_row[userid]'");
					$trade_goodsP =$trade_goods_row[goodsP]*(-1);
					$point_qry = "insert into point_table(part,userid,point,reason,writeday)values(";
					$point_qry.= "'ȸ��','$trade_row[userid]',$trade_goodsP,'��ۿϷ� -> $TRADE_ARR[$newStatus] [�ֹ��ڵ�:$trade_goods_row[tradecode]]',now())";
					$MySQL->query($point_qry);
				}
				// �����ı⸦ �ۼ��� ������ ������ �����ı������� ȸ��
				if ($MySQL->articles("SELECT idx from point_table WHERE userid='$trade_row[userid]' and part='����' and tradecode='$trade_goods_row[tradecode]' limit 1"))
				{
					$backP_row = $MySQL->fetch_array("SELECT point from point_table WHERE userid='$trade_row[userid]' and tradecode='$trade_goods_row[tradecode]' limit 1");
					$backP = $backP_row[point] * (-1);
					$qry = "update member set point=point+$backP where userid='$trade_row[userid]'";
					$MySQL->query($qry);
					$point_qry = "insert into point_table(part,userid,point,reason,writeday)values(";
					$point_qry.= "'ȸ��','$trade_row[userid]',$backP,'������ҷ� ���� �����ı��ۼ� ������ ȸ�� [�ֹ��ڵ�:$trade_goods_row[tradecode]]',now())";
					$MySQL->query($point_qry);
				}
				// �ֹ���ҽ� ȸ�������� ���ż�,���ž� ������Ʈ
				$buyNum = $MySQL->fetch_array("select count(*) from trade where userid='$trade_row[userid]' and bPay=1 and status<4");
				$buyMoney =$MySQL->fetch_array("select sum(payM) from trade where userid='$trade_row[userid]' and bPay=1 and status<4");
				// ȸ�� ���ż�, ���ž� ����
				if(empty($buyNum[0])) $buyNum[0] =0;
				if(empty($buyMoney[0])) $buyMoney[0] =0;
				$editQry = "update member set buyNum=$buyNum[0],buyMoney=$buyMoney[0] where userid='$trade_row[userid]'";
				$MySQL->query($editQry);
			}
		}
		// �ֹ��� �����ݻ�� / ����
		if($trade_row[useP])
		{
			if($trade_row[bPsupply]==0 && $cancelTrCnt != $goodsTrCnt)
			{
				// ��ǰ���Ž� ������ ��� ���� 
				$MySQL->query("update trade set bPsupply=1 where idx=$str_arr[$status_i]");
				$MySQL->query("update member set point=point-$trade_row[useP] where userid='$trade_row[userid]'");
				$trade_goodsP =$trade_row[useP]*(-1);
				$point_qry = "insert into point_table(part,userid,point,reason,writeday)values(";
				$point_qry.= "'���','$trade_row[userid]',$trade_goodsP,'��ǰ���� [�ֹ��ڵ�:$trade_row[tradecode]]',now())";
				$MySQL->query($point_qry);
			}
			else if($trade_row[bPsupply]==1 && $cancelTrCnt == $goodsTrCnt)
			{
				// ����� ������ ���� �ֹ���� 
				$MySQL->query("update trade set bPsupply=0 where idx=$str_arr[$status_i]");
				$MySQL->query("update member set point=point+$trade_row[useP] where userid='$trade_row[userid]'");
				$point_qry = "insert into point_table(part,userid,point,reason,writeday)values(";
				$point_qry.= "'����','$trade_row[userid]',$trade_row[useP],";
				$point_qry.= "'$TRADE_ARR[$nowStatus] -> $TRADE_ARR[$newStatus] [�ֹ��ڵ�:$trade_row[tradecode]]',now())";
				$MySQL->query($point_qry);
			}
		}
	}
}
if ($status_list_change=="y")
{
	OnlyMsgView("�Ϸ��Ͽ����ϴ�.");
	echo "<script>parent.location.reload();</script>";
}
else if ($tgidx) Refresh("trade_order_view.php?data=$data");
else close_par_refresh();
?>