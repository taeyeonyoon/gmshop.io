<?
// �ҽ��������
// 20060720-1 ���ϱ�ü �輺ȣ : 1.�����õ���� ����, 2.�ڷ����� ���� ����������� ����
session_start();
include "./lib/config.php";
include "./lib/function.php";
$_SELF=explode("/",$_SERVER[PHP_SELF]);
$_SELF[count($_SELF)-1]="";
$_PAY_OK_FILE=implode("/", $_SELF);
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1");//����������
}
if(!defined(__DESIGN_ROW))
{
	define(__DESIGN_ROW,"TRUE");
	$design=$MySQL->fetch_array("select *from design limit 0,1");
}
//����� Ȯ�ο� �Լ�
function Find_Bank($bankcode)
{
	switch($bankcode):
		case 01:	$banknm = "�ѱ�����";		break;
		case 02:	$banknm = "�������";		break;
		case 03:	$banknm = "�������";		break;
		case 04:	$banknm = "��������";		break;
		case 05:	$banknm = "��ȯ����";		break;
		case 06:	$banknm = "��������";		break;
		case 07:	$banknm = "����";			break;
		case 08:	$banknm = "������";			break;
		case 09:	$banknm = "���ſ�";		break;
		case 10:	$banknm = "�ų����߾�";		break;
		case 11:	$banknm = "����";			break;
		case 12:	$banknm = "����";			break;
		case 13:	$banknm = "����";			break;
		case 14:	$banknm = "����";			break;
		case 15:	$banknm = "����";			break;
		case 16:	$banknm = "����";			break;
		case 20:	$banknm = "�츮����";		break;
		case 21:	$banknm = "��������";		break;
		case 22:	$banknm = "�������";		break;
		case 23:	$banknm = "��������";		break;
		case 24:	$banknm = "��������";		break;
		case 25:	$banknm = "��������";		break;
		case 26:	$banknm = "��������";		break;
		case 27:	$banknm = "�ѹ�����";		break;
		case 28:	$banknm = "��ȭ����";		break;
		case 29:	$banknm = "��������";		break;
		case 30:	$banknm = "�뵿����";		break;
		case 31:	$banknm = "�뱸����";		break;
		case 32:	$banknm = "�λ�����";		break;
		case 33:	$banknm = "��û����";		break;
		case 34:	$banknm = "��������";		break;
		case 35:	$banknm = "��������";		break;
		case 36:	$banknm = "�������";		break;
		case 37:	$banknm = "��������";		break;
		case 38:	$banknm = "��������";		break;
		case 39:	$banknm = "�泲����";		break;
		case 40:	$banknm = "�������";		break;
		case 45:	$banknm = "�������ݰ�";		break;
		case 53:	$banknm = "��Ƽ����";		break;
		case 71:	$banknm = "��ü��";			break;
		case 76:	$banknm = "�ſ뺸��";		break;
		case 81:	$banknm = "�ϳ�����";		break;
		case 82:	$banknm = "��������";		break;
		case 83:	$banknm = "��ȭ����";		break;
		case 93:	$banknm = "�������ݰ�";		break;
		default :	$banknm = "��������";		break;
	endswitch;

	return $banknm;
}
$linkstr = PostToLink($_POST); // �������� ��ũ�ּҷ� ������� 
$sms = $MySQL->fetch_array("select * from smsinfo");

$SMS_GOODS= "";
$SMS_CNT="";
$SMS_HAND="";

$is_escrow = "none";			//����ũ�� ���뿩�� üũ
$pG_test = $admin_row[pG_test];	//�׽�Ʈ�� �������� üũ
$pG_shopId = $admin_row[shopId];	//������ ���Ǵ� ���̵�
$shop_pg_mertkey = $admin_row[shop_pg_mertkey];	//������ ���Ǵ� ����Ű
if($admin_row[pG_test]=="y")	//�׽�Ʈ�� ������
{
	switch($admin_row[pgName]):
		case 'dacom':		//������ : �׽�Ʈ�� ���� ����ڷ� ���� �Է¹޾ƾ� ��
			break;

		case 'allat':		//�þ�
			$pG_shopId = "allat_test02";	//������ ���Ǵ� ���̵�
			$shop_pg_mertkey = "a77b5ddf2f0e567ace361df4c5765281";	//������ ���Ǵ� ����Ű
			break;

		case 'inicis':		//�̴Ͻý�
			$pG_shopId = "INIpayTest";	//������ ���Ǵ� ���̵�
			break;
	endswitch;
}

if($GM_Shop_PayMethod == "OffBank")			//������ : payForm.submit() ���� ���޵� ���
{
	$bankDay = $year."-".$month."-".$day;
	$payer = $payer;
	$pG_test = "n";			//������ ������ �׻� �׽�Ʈ�� �ƴ�
	$pG_shopId = "";
}
elseif($admin_row[pgName]=="dacom")			//������ ó����ƾ
{
	$pay_dacom_row = $MySQL->fetch_array("SELECT * FROM GM_PG_dacom WHERE tradecode='".$oid."'");

	if(empty($pay_dacom_row[tradecode]))
	{
		MsgViewHref('���������� ���� ���������� ���Ź��� ���Ͽ����ϴ�\\n������ ������ �ֽñ� �ٶ��ϴ�','cart.php');
		exit;
	}
	else
	{
		if(("0000" == $pay_dacom_row[respcode]) || ("C000" == $pay_dacom_row[respcode]))	//�ǽð� ���´� C000�� �����ڵ�
		{
			$pG_shopId = $pay_dacom_row[shopId];
			$tradecode = $pay_dacom_row[tradecode];
			$pG_payM = $pay_dacom_row[amount];
			$is_escrow = ($pay_dacom_row[useescrow]=="Y") ? "escrow":"none";	//����ũ�ο��� Ȯ��

			//�ŷ���� üũ
			switch($pay_dacom_row[paytype]):
				case SC0010:		//ī���
					$payMethod = "card";
					$bankInfo = $pay_dacom_row[financename];	//ī���
					$bankDay = "";								//�Աݿ�������
					$payer = $pay_dacom_row[payer];				//������
					$escrow_tcd = $pay_dacom_row[transaction];	//�������� �ο��� �ŷ���ȣ
					OnlyMsgView('������ ���� �ϼ̽��ϴ�.');
					break;

				case SC0060:		//�ڵ���
					$payMethod="hand";
					$bankInfo = $pay_dacom_row[financename]." : ".$pay_dacom_row[telno];			//�޴����� : �޴�����ȣ
					$bankDay = "";								//�Աݿ�������
					$payer = $pay_dacom_row[payer];				//������
					$escrow_tcd = $pay_dacom_row[transaction];	//�������� �ο��� �ŷ���ȣ
					OnlyMsgView('������ ���� �ϼ̽��ϴ�.');
					break;

				case SC0030:		//�ǽð�����
					$payMethod = "iche";
					$bankInfo = $pay_dacom_row[financename]." ".$pay_dacom_row[accountnumber]." (������ : ".$pay_dacom_row[accountowner].")";		//����� ���¹�ȣ(������ : �����ָ�)
					$bankDay = "";								//�Աݿ�������
					$payer = $pay_dacom_row[payer];				//�Ա���
					$escrow_tcd = $pay_dacom_row[transaction];	//�������� �ο��� �ŷ���ȣ
					OnlyMsgView('������ ���� �ϼ̽��ϴ�.');
					break;

				case SC0040:		//�������
					$payMethod = "cyber";
					$bankInfo = $pay_dacom_row[financename]." ".$pay_dacom_row[accountnumber]." (������ : (��)������)";		//����� ���¹�ȣ(������ : �����ָ�)
					$bankDay = "";								//�Աݿ�������
					$payer = $pay_dacom_row[payer];				//�Աݿ�����
					$escrow_tcd = $pay_dacom_row[transaction];	//�������� �ο��� �ŷ���ȣ
					OnlyMsgView('������ �������Ա� ��û�� �Ϸ�Ǿ����ϴ�.');
					break;
			endswitch;
		}
		else
		{
			MsgViewHref('������ ���� �ϼ̽��ϴ�.\\n�����ڵ� : '.$respcode.'\\n�޽��� : '.$respmsg,'cart.php');
			exit;
		}
	}
}
elseif($admin_row[pgName]=="allat")		//�þ� ó����ƾ
{
	include "./AllplanPG/allat/allatutil.php";

	// �����������̽��� ����� Get : ���� �ֹ��������������� Request Get
	//------------------------------------------------------------------
	$at_data = "allat_shop_id=".urlencode($pG_shopId).		//������ ���� ��Ʈ�� ID
				"&allat_amt=".$allat_amt.							//���αݾ�
				"&allat_enc_data=".$_POST["allat_enc_data"].		//Plug-in �����
				"&allat_cross_key=".$shop_pg_mertkey;				//������ CrossKey��

	// �þܰ� ��� �� ����� �ޱ� : SendApproval->����Լ�, html->�����
	//-----------------------------------------------------------------
	$at_txt = ApprovalReq($at_data,($admin_row[shop_pg_encryption]=="y" ? "SSL":"NOSSL"));				//���� �ʿ� SSL (NOSSL - ���� �ڵ� 0212�� ��� �����)

	// �����(html)���� �ʿ��Ѱ� �Ҹ��� ����
	//-----------------------------------------------------------------
	$REPLYCD	=getValue("reply_cd",$at_txt);			//����ڵ�
	$REPLYMSG	=getValue("reply_msg",$at_txt);			//��� �޼���

	// ����� ó��
	//------------------------------------------------------------------
	if( !strcmp($REPLYCD,"0000") )	// reply_cd "0000" �϶��� ����
	{
		$ORDER_NO			=getValue("order_no",$at_txt);			//��	�� : �ֹ���ȣ
		$AMT				=getValue("amt",$at_txt);				//��	�� : ���αݾ�
		$PAY_TYPE			=getValue("pay_type",$at_txt);			//��	�� : ���Ҽ���
		$APPROVAL_YMDHMS	=getValue("approval_ymdhms",$at_txt);	//��	�� : �����Ͻ�
		$SEQ_NO				=getValue("seq_no",$at_txt);			//��	�� : �ŷ��Ϸù�ȣ
		$APPROVAL_NO		=getValue("approval_no",$at_txt);		//�ſ�ī�� : ���ι�ȣ
		$CARD_ID			=getValue("card_id",$at_txt);			//�ſ�ī�� : ī��ID
		$CARD_NM			=getValue("card_nm",$at_txt);			//�ſ�ī�� : ī���
		$SELL_MM			=getValue("sell_mm",$at_txt);			//�ſ�ī�� : �Һΰ���
		$ZEROFEE_YN			=getValue("zerofee_yn",$at_txt);		//�ſ�ī�� : �����ڿ��� - ������(Y),�Ͻú�(N)
		$CERT_YN			=getValue("cert_yn",$at_txt);			//�ſ�ī�� : �������� - ����(Y),������(N)
		$CONTRACT_YN		=getValue("contract_yn",$at_txt);		//�ſ�ī�� : �����Ϳ��� - 3�ڰ�����(Y),��ǥ������(N)
		$BANK_ID			=getValue("bank_id",$at_txt);			//������ü/������� : ����ID
		$BANK_NM			=getValue("bank_nm",$at_txt);			//������ü/������� : �����
		$CASH_BILL_NO		=getValue("cash_bill_no",$at_txt);		//������ü/������� : ���ݿ����� �Ϸ� ��ȣ
		$ESCROW_YN			=getValue("escrow_yn",$at_txt);			//������ü/������� : ����ũ�� ���� ����
		$ACCOUNT_NO			=getValue("account_no",$at_txt);		//������� : ���¹�ȣ
		$ACCOUNT_NM			=getValue("account_nm",$at_txt);		//������� : �Ա��ڸ�
		$INCOME_ACC_NM		=getValue("income_account_nm",$at_txt);	//������� : �Աݰ��¸�(������¼����ָ�)
		$INCOME_LIMIT_YMD	=getValue("income_limit_ymd",$at_txt);	//������� : �Աݱ�����
		$INCOME_EXPECT_YMD	=getValue("income_expect_ymd",$at_txt);	//������� : �Աݿ�����
		$CASH_YN			=getValue("cash_yn",$at_txt);			//������� : ���ݿ�������û ����

		$tradecode = $ORDER_NO;	//�ֹ��ڵ�
		$pG_payM = $AMT;
		$is_escrow = ($ESCROW_YN=="Y") ? "escrow":"none";	//����ũ�ο��� Ȯ��

		switch($PAY_TYPE):
			case 'ABANK':	//������ü
				$payMethod = "iche";
				$bankInfo = $BANK_NM;		//�����
				$bankDay = "";				//�Աݿ�������
				$payer = $ACCOUNT_NM;		//�Ա���
				$escrow_tcd = $SEQ_NO;		//�ŷ���ȣ
				OnlyMsgView('������ ���� �ϼ̽��ϴ�.');
				break;

			case 'VBANK':	//�������
				$payMethod = "cyber";
				$bankInfo = $BANK_NM." ".$ACCOUNT_NO." (������ : ".$INCOME_ACC_NM.")";	//����� ���¹�ȣ(������ : �����ָ�)
				$bankDay = $INCOME_EXPECT_YMD;		//�Աݿ�������
				$payer = $ACCOUNT_NM;				//�Աݿ�����
				$escrow_tcd = $SEQ_NO;				//�ŷ� ��ȣ
				OnlyMsgView('������ �������Ա� ��û�� �Ϸ�Ǿ����ϴ�.');
				break;

			default :	//�ſ�ī�� : 3D, ISP, NOR
				$payMethod = "card";
				$bankInfo = $CARD_NM;		//ī���
				$bankDay = "";				//�Աݿ�������
				$payer = $ACCOUNT_NM;		//������
				$escrow_tcd = $SEQ_NO;				//�ŷ� ��ȣ
				OnlyMsgView('������ ���� �ϼ̽��ϴ�.');
				break;
		endswitch;
	}
	else
	{	
		MsgViewHref('������ ���� �ϼ̽��ϴ�.\\n'.'['.$REPLYCD.'] '.$REPLYMSG,'cart.php');
		exit;
	}
}
elseif($admin_row[pgName]=="inicis")		// �̴Ͻý� ó����ƾ
{
	echo "<script language=javascript>
	<!--
	var openwin=window.open('AllplanPG/inicis/INIpay41/childwin.html','childwin','width=300,height=160');
	openwin.close();
	//-->
	</script>";

	/**************************
	 * 1. ���̺귯�� ��Ŭ��� *
	 **************************/
	require("AllplanPG/inicis/INIpay41/sample/INIpay41Lib.php");

	/***************************************
	 * 2. INIpay41 Ŭ������ �ν��Ͻ� ���� *
	 ***************************************/
	$inipay = new INIpay41;

	/*********************
	 * 3. ���� ���� ���� *
	 *********************/
	$inipay->m_inipayHome = $DOCUMENT_ROOT.$_PAY_OK_FILE."AllplanPG/inicis/INIpay41";	// �̴����� Ȩ���͸�
	$inipay->m_type = "securepay";			// ����
	$inipay->m_pgId = "IniTechPG_";			// ����
	$inipay->m_subPgIp = "203.238.3.10";	// ����
	$inipay->m_keyPw = "1111";				// Ű�н�����(�������̵� ���� ����)
	$inipay->m_debug = "false";				// �α׸��("true"�� �����ϸ� �󼼷αװ� ������.)
	$inipay->m_mid = $mid;					// �������̵�
	$inipay->m_uid = $uid;					// INIpay User ID
	$inipay->m_uip = getenv("REMOTE_ADDR");	// ����
	$inipay->m_goodName = $goodname;
	$inipay->m_currency = $currency;
	$inipay->m_price = $price;
	$inipay->m_buyerName = $buyername;
	$inipay->m_buyerTel = $buyertel;
	$inipay->m_buyerEmail = $buyeremail;
	$inipay->m_payMethod = $paymethod;		//������
	$inipay->m_encrypted = $encrypted;
	$inipay->m_sessionKey = $sessionkey;
	$inipay->m_url = $HTTP_HOST;
	$inipay->m_merchantReserved1 = "merchantreserved1";	// ����1
	$inipay->m_merchantReserved2 = "merchantreserved2";	// ����2
	$inipay->m_merchantReserved3 = "merchantreserved3";	// ����3
	$inipay->m_cardcode = $cardcode;		// ī���ڵ� ����
	$inipay->m_recvName = $recvname;		// ������ ��
	$inipay->m_recvTel = $recvtel;			// ������ ����ó
	$inipay->m_recvAddr = $recvaddr;		// ������ �ּ�
	$inipay->m_recvPostNum = $recvpostnum;	// ������ �����ȣ
	$inipay->m_recvMsg = $recvmsg;			// ���� �޼���

	/****************
	 * 4. ���� ��û *
	 ****************/
	$inipay->startAction();
	if($inipay->m_resultCode == "00")
	{
		$pG_shopId = $inipay->m_mid;
		$tradecode = $inipay->m_moid;	//�ֹ��ڵ�
		$pG_payM = $inipay->m_price;

		switch($inipay->m_payMethod):
			case 'VBank':			//������� �� ����ũ��
				$payMethod = "cyber";
				$bankInfo = Find_Bank($inipay->m_vcdbank)." ".$inipay->m_vacct ." (������ : " .$inipay->m_nmvacct.")";	//����� ���¹�ȣ(������ : �����ָ�)
				$bankDay = $inipay->m_dtinput;	//�Աݿ�������
				$payer = $inipay->m_nminput;	//�Ա���
				$escrow_tcd = $inipay->m_tid;	//�ŷ� ��ȣ
				$is_escrow = ($inipay->m_mid==$admin_row[shop_Escrow_Id]) ? "escrow":"none";	//����ũ�ο��� Ȯ��
				OnlyMsgView('������ �������Ա� ��û�� �Ϸ�Ǿ����ϴ�.');
				break;

			case 'DirectBank':		//�ǽð� ������ü
				$payMethod = "iche";
				$bankInfo = $pay_dacom_row[financename]." ".$pay_dacom_row[accountnumber]." (������ : ".$pay_dacom_row[accountowner].")";		//����� ���¹�ȣ(������ : �����ָ�)
				$bankDay = "";							//�Աݿ�������
				$payer = $inipay->m_nminput;			//�Ա���
				$escrow_tcd = $inipay->m_tid;			//�ŷ� ��ȣ
				OnlyMsgView('������ ���� �ϼ̽��ϴ�.');
				break;

			case 'HPP':				//�ڵ�������
				$payMethod = "hand";
				$bankInfo = $inipay->m_nohpp;		//�޴�����ȣ
				$bankDay = "";									//�Աݿ�������
				$payer = $inipay->m_nminput;					//������
				$escrow_tcd = $inipay->m_tid;					//�ŷ� ��ȣ
				OnlyMsgView('������ ���� �ϼ̽��ϴ�.');
				break;

			default :				//ī�����
				$payMethod = "card";
				$bankInfo = $inipay->m_cardIssuerCode .":".$inipay->m_cardCode." : ".$inipay->m_cardNumber;	//ī��� : ī���ȣ
				$bankDay = "";								//�Աݿ�������
				$payer = $inipay->m_nminput;				//������
				$escrow_tcd = $inipay->m_tid;	//����ũ�� �ŷ� ��ȣ
				OnlyMsgView('������ ���� �ϼ̽��ϴ�.');
		endswitch;
	}
	else
	{
			MsgViewHref('������ ���� �ϼ̽��ϴ�.\\n'.$inipay->m_resultMsg,'cart.php');
			exit;
	}
}

/*------------------------�ֹ����� ���� ---------------------------------*/
$temp_row = $MySQL->fetch_array("select *from trade_temp where tradecode='$tradecode' limit 1");
$SMS_HAND = $temp_row[hand];
$temp_row_content =addslashes_userfc($temp_row[content]);

//�ӽ����̺��� ��������
$useP=$temp_row[useP];
$transM=$temp_row[transM];
$payM=$temp_row[payM];
$totalM=$temp_row[totalM];
$transMethod=$temp_row[transMethod];
if(empty($useP))	$useP =0;
if(empty($transM))	$transM =0;
if(empty($payM))	$payM =0;
if(empty($totalM))	$totalM =0;
$pG_Cracked = "";
$temp_trade_goods_row = $MySQL->fetch_array("select sum(price * cnt) as gsum from trade_goods where tradecode='".$tradecode."'");
if($totalM != $temp_trade_goods_row[gsum])
{
	$pG_Cracked = "�����հ� Ȯ�ο��";
}
elseif($payMethod != "bank")
{
	if($payM != $pG_payM)	//ī����� ����ݾװ� PG�� ����Ȯ�� �ݾ��� ����
	{
		$pG_Cracked = "PG�� Ȯ�ο��";
	}
}

//���������� ��� ǰ���� �Ǿ������ üũ
$cart_result = $MySQL->query("select *from cart where userid='$temp_row[userid]'");
while($cart_row = mysql_fetch_array($cart_result))
{
	$goods_row = $MySQL->fetch_array("select *from goods where idx=$cart_row[goodsIdx] limit 1");
	if ($goods_row[bLimit])
	{
		if (empty($goods_row[limitCnt]))
		{
			$limit = 1; // ǰ���̸� 1
			$limit_good = $goods_row[name];
		}
		else if ($goods_row[bLimit] && ($goods_row[limitCnt] < $cart_row[cnt])) // ǰ���� �ƴѵ� ���ż����� �������� �Ѿ�� 
		{
			$limit = 2; // ����ʰ��̸� 2 
			$over_cnt = $cart_row[cnt] - $goods_row[limitCnt];
			$limit_good = $goods_row[name]."��ǰ�� ��� $over_cnt �� �ʰ��Ͽ����ϴ�.";
		}
	}
}
if ($limit ==1)
{
	OnlyMsgView("�˼��մϴ�. $limit_good ��ǰ�� ������ ��� �������� ���ŵǾ����ϴ�. ��ٱ��Ϸ� �̵��մϴ�.");
	Refresh("cart.php");
	exit;
}
else if ($limit ==2)
{
	OnlyMsgView("�˼��մϴ�. $limit_good ��ٱ��Ϸ� �̵��մϴ�.");
	Refresh("cart.php");
	exit;
}
if($temp_row[userid_part]=="member")
{
	// ȸ���� ��� ������ ����
	if ($useP && !$MySQL->articles("SELECT idx from point_table WHERE userid='$temp_row[userid]' and part='���' and tradecode='$temp_row[tradecode]'")) // ����� �������� �������� & order_table_ok.php �ߺ����ΰ�ħ ���� 1���� ������� 
	{
		$MySQL->query("update member set point = point - $useP where userid='$temp_row[userid]' ");
		$trade_goodsP =$useP*-1;
		$point_qry = "insert into point_table(part,userid,point,reason,writeday)values(";
		$point_qry.= "'���','$temp_row[userid]',$trade_goodsP,'��ǰ���� [�ֹ��ڵ�:$temp_row[tradecode]]',now())";
		$MySQL->query($point_qry);
	}
}
$qry = "update trade set payM=$payM,payMethod='$payMethod',useP=$useP,transM=$transM,totalM=$totalM,bPay=1, ";
$qry.= "bankInfo='$bankInfo',bankDay='$bankDay',payer='$payer',transMethod='$transMethod',userip='$REMOTE_ADDR', ";
if(!empty($pG_payM)) $qry.= "pG_payM=".$pG_payM.", ";			//ī������� PG�� ����Ȯ�� �ݾ�
if($pG_Cracked != "") $qry.= "pG_Cracked='".$pG_Cracked."', ";	//�����ݾװ��� ������ Ȯ���ʿ�
$qry.= "escrow_tcd='".$escrow_tcd."', is_escrow='".$is_escrow."', pG_shopId='".$pG_shopId."', pG_test='".$pG_test."' where tradecode='$tradecode' ";

if ($MySQL->query($qry)) $inSuccess =true;
if($inSuccess)
{
	// ��ǰ�ֹ��� ����� �谨 
	$qry = "select *from cart where userid='$temp_row[userid]'";
	$cart_result = $MySQL->query($qry);
	$inSuccess =true;
	while($cart_row = mysql_fetch_array($cart_result))
	{
		$goods_row = $MySQL->fetch_array("select *from goods where idx=$cart_row[goodsIdx] limit 1");
		if($goods_row[bLimit])
		{
			// ������ ����
			$new_limitCnt = $goods_row[limitCnt]-$cart_row[cnt];
			if($new_limitCnt <0) $new_limitCnt=0;
			$MySQL->query("update goods set limitCnt=$new_limitCnt where idx=$goods_row[idx]");
		}
	}

	// �ֹ� ���� ������ ����
	if($admin_row[bBuymail]=="y")
	{
		include "email/goods_order.php";
	}

	// sms ������ ����
	if($sms[bSms] && !empty($sms[userid]) && !empty($sms[pwd]))
	{
		$t_goods_row = $MySQL->fetch_array("SELECT name,goodsIdx,cnt from trade_goods WHERE tradecode='$tradecode' group by tradecode");
		if ($t_goods_row[cnt]>1)
		{
			$CNT_STR = " �� ".($t_goods_row[cnt]-1)." ";
		}
		else $CNT_STR = "";
		$SMS_GOODS = StringCut($t_goods_row[name],20);
		$SMS_CNT = $CNT_STR;
		$SMS_PART = "trade";
		include "sms/smsclient.php";
	}

	//������ �� ī�����, ����ũ�� �� ��Ÿ�� ��� ����Ȯ���� �۾�����
	switch ($payMethod):
		case 'card':	//ī�����
			$editQry = "UPDATE trade_goods SET sday2 =now(),status=1 WHERE tradecode='".$tradecode."'";
			$MySQL->query($editQry);
			$editQry1 = "UPDATE trade SET sday2 =now(),status=1 WHERE tradecode='".$tradecode."'";
			$MySQL->query($editQry1);
			$type = "all";	// �ϰ���� ���Ϲ߼�
			break;

		case 'iche':	//�ǽð�����
			$editQry = "UPDATE trade_goods SET sday2 =now(),status=1 WHERE tradecode='".$tradecode."'";
			$MySQL->query($editQry);
			$editQry1 = "UPDATE trade SET sday2 =now(),status=1 WHERE tradecode='".$tradecode."'";
			$MySQL->query($editQry1);
			$type = "all";	// �ϰ���� ���Ϲ߼�
			break;

		case 'hand':		//�ڵ���
			$editQry = "UPDATE trade_goods SET sday2 =now(),status=1 WHERE tradecode='".$tradecode."'";
			$MySQL->query($editQry);
			$editQry1 = "UPDATE trade SET sday2 =now(),status=1 WHERE tradecode='".$tradecode."'";
			$MySQL->query($editQry1);
			$type = "all";	// �ϰ���� ���Ϲ߼�
			break;
	endswitch;
	//������ �� ī�����, ����ũ�� �� ��Ÿ�� ��� ����Ȯ���� �۾����� ��

	if ($type == "all")	// �ϰ���� ���� �߼�
	{
		$trade_goods_result = $MySQL->query("SELECT name from trade_goods WHERE tradecode='".$tradecode."'");
		while ($trade_goods_row = mysql_fetch_array($trade_goods_result))
		{
			$goods_name.= $trade_goods_row[name]."<BR>";
		}
		$trade_row = $MySQL->fetch_array("select *from trade where tradecode='".$tradecode."' limit 1");
		include "email/b2b_credit.php"; // ������,��ü,��
	}
	ReFresh("order_ok.php?tradecode=$tradecode");
}
else	// �ֹ������߻���
{
	echo"Err. ";
}
?>