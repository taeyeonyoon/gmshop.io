<?
if($sms[company]=="icodekorea")
{
	//  smsWorld SMS ���� PHP-API Test Sample
	require_once("class.sms.php");
	if($SMS_PART == "member_join")
	{
		//ȸ������
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$retel= str_replace("-","",$sms[retel]);
		if($sms[bSend1])
		{
			$msg = str_replace("__NAME",$name,$sms[msg1]);
			$msg = str_replace("__USERID",$userid,$msg);
			$msg = str_replace("__SITE",$admin_row[shopName],$msg);
			$hand = str_replace("-","",$hand);
			$result = $SMS->Add($hand,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
		if($sms[bSend2])
		{
			$msg = str_replace("__NAME",$name,$sms[msg2]);
			$msg = str_replace("__USERID",$userid,$msg);
			$msg = str_replace("__SITE",$admin_row[shopName],$msg);
			$result = $SMS->Add($retel,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
	}
	else if($SMS_PART == "trade")
	{
		//��ǰ�ֹ�
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$retel= str_replace("-","",$sms[retel]);
		$SMS_WRITEDAY = date("m�� d��");
		if($payMethod=="card") $SMS_PAYMETHOD = "ī�����";
		else $SMS_PAYMETHOD = "�������Ա�";
		if($sms[bSend3])
		{
			$msg = str_replace("__NAME",		$temp_row[name],	$sms[msg3]);
			$msg = str_replace("__WRITEDAY",	$SMS_WRITEDAY,		$msg);
			$msg = str_replace("__GOODS",		$SMS_GOODS,			$msg);
			$msg = str_replace("__PAYMETHOD",	$SMS_PAYMETHOD,		$msg);
			$msg = str_replace("__PRICE",		$payM,				$msg);
			$msg = str_replace("__CNT",			$SMS_CNT,			$msg);
			$msg = str_replace("__SITE",		$admin_row[shopName],$msg);
			$hand = str_replace("-","",$temp_row[hand]);
			$result = $SMS->Add($hand,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
		if($sms[bSend4])
		{
			$msg = str_replace("__NAME",$temp_row[name],$sms[msg4]);
			$msg = str_replace("__WRITEDAY",$SMS_WRITEDAY,$msg);
			$msg = str_replace("__GOODS",$SMS_GOODS,$msg);
			$msg = str_replace("__PAYMETHOD",$SMS_PAYMETHOD,$msg);
			$msg = str_replace("__PRICE",$payM,$msg);
			$msg = str_replace("__CNT",$SMS_CNT,$msg);
			$msg = str_replace("__SITE",$admin_row[shopName],$msg);
			$result = $SMS->Add($retel,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
	}
	else if($SMS_PART == "cancel")
	{
		//�ֹ����
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$retel= str_replace("-","",$sms[retel]);
		$SMS_WRITEDAY = date("m�� d��");
		if($payMethod=="card") $SMS_PAYMETHOD = "ī�����";
		else if($payMethod=="hpp") $SMS_PAYMETHOD = "�ڵ���";
		else if($payMethod=="iche") $SMS_PAYMETHOD = "������ü";
		else if($payMethod=="bank") $SMS_PAYMETHOD = "�������Ա�";
		if($sms[bSend8])
		{
			$msg = str_replace("__NAME",		$temp_row[name],	$sms[msg8]);
			$msg = str_replace("__GOODS",		$SMS_GOODS,			$msg);
			$msg = str_replace("__PAYMETHOD",	$SMS_PAYMETHOD,		$msg);
			$msg = str_replace("__SITE",		$admin_row[shopName],$msg);
			$hand = str_replace("-","",$temp_row[hand]);
			$result = $SMS->Add($hand,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
	}
	else if($SMS_PART == "send")
	{
		//��ǰ���
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$SMS_SENDDAY = date("m�� d��");
		if($sms[bSend5])
		{
			$msg = str_replace("__NAME",		$trade_row[name],	$sms[msg5]);
			$msg = str_replace("__TRANSNUM",	$trans_num,	$msg);
			$msg = str_replace("__GOODS",		StringCut($goods_row[name],20),	$msg);
			$msg = str_replace("__SENDDAY",		$SMS_SENDDAY,		$msg);
			$msg = str_replace("__SITE",		$admin_row[shopName],$msg);
			$hand = str_replace("-","",$trade_row[hand]);
			$result = $SMS->Add($hand,$adminTel,"",$msg,"");
			$result = $SMS->Send();
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
	}
	else if($SMS_PART=="allmember")
	{
		//ȸ����ü ������ (SMS���ŵ����� ȸ����) 
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$qry = "select * from member where bSms='y' and hand<>''";
		$qry_result = $MySQL->query($qry);
		while($row = mysql_fetch_array($qry_result))
		{
			$hand = str_replace("-","",$row[hand]);
			$result = $SMS->Add($hand,$adminTel,"",$content,"");
		}
		echo "<HR>";
		$result = $SMS->Send();
		if ($result)
		{
			echo "SMS ������ �����߽��ϴ�.<br>";
			$success = $fail = 0;
			foreach($SMS->Result as $result)
			{
				list($phone,$code)=explode(":",$result);
				if ($code=="Error")
				{
					echo $phone.'�� �߼��ϴµ� ������ �߻��߽��ϴ�.<br>';
					$fail++;
				}
				else
				{
					echo $phone."�� �����߽��ϴ�. (�޽�����ȣ:".$code.")<br>";
					$success++;
				}
			}
			echo $success."���� ���������� ".$fail."���� ������ ���߽��ϴ�.<br>";
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
		else echo "����: SMS ������ ����� �Ҿ����մϴ�.<br>";
	}
	else if($SMS_PART=="selected_member")
	{
		// �˻��� ȸ���� ������
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$adminTel = str_replace("-","",$sms[adminTel]);
		$temp = explode("/",$idx_arr);
		for ($i=0; $i<count($temp); $i++)
		{
			$row = $MySQL->fetch_array("SELECT hand from member WHERE idx=$temp[$i] and bSms='y' and hand<>'' limit 1");
			if($row[hand])
			{
				$hand = str_replace("-","",$row[hand]);
				$result = $SMS->Add($hand,$adminTel,"",$content,"");
			}
		}
		echo "<HR>";
		$result = $SMS->Send();
		if ($result)
		{
			echo "SMS ������ �����߽��ϴ�.<br>";
			$success = $fail = 0;
			foreach($SMS->Result as $result) 
			{
				list($phone,$code)=explode(":",$result);
				if ($code=="Error")
				{
					echo $phone.'�� �߼��ϴµ� ������ �߻��߽��ϴ�.<br>';
					$fail++;
				}
				else
				{
					echo $phone."�� �����߽��ϴ�. (�޽�����ȣ:".$code.")<br>";
					$success++;
				}
			}
			echo $success."���� ���������� ".$fail."���� ������ ���߽��ϴ�.<br>";
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
		else echo "����: SMS ������ ����� �Ҿ����մϴ�.<br>";
	}
	else if($SMS_PART=="permember")
	{
		// ȸ������ ������
		$SMS = new SMS($sms[userid],$sms[pwd],$sms[gubun]);
		$result = $SMS->Add($hand,$adminTel,"",$content,"");
		if ($result) echo $result; else echo "�Ϲݸ޽��� �Է� ����<BR>";
		echo "<HR>";
		$result = $SMS->Send();
		if ($result)
		{
			echo "SMS ������ �����߽��ϴ�.<br>";
			$success = $fail = 0;
			foreach($SMS->Result as $result)
			{
				list($phone,$code)=explode(":",$result);
				if ($code=="Error")
				{
					echo $phone.'�� �߼��ϴµ� ������ �߻��߽��ϴ�.<br>';
					$fail++;
				}
				else
				{
					echo $phone."�� �����߽��ϴ�. (�޽�����ȣ:".$code.")<br>";
					$success++;
				}
			}
			echo $success."���� ���������� ".$fail."���� ������ ���߽��ϴ�.<br>";
			$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
		}
		else echo "����: SMS ������ ����� �Ҿ����մϴ�.<br>";
	}
}
?>