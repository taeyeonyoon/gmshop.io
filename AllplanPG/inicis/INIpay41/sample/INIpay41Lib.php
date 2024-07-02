<?php


/****************************************************************************************
 **** ���Ҽ��ܺ��� PGID�� �ٸ��� ǥ���Ѵ� (2003.12.19 �븮 ������) ****
 ****************************************************************************************
 *** �ϴ��� PGID �κ��� ���Ҽ��ܺ��� TID�� ������ ǥ���ϵ��� �ϸ�,  ***
 *** ���Ƿ� �����ϴ� ��� ���� ���а� �߻� �ɼ� �����Ƿ� ����� ����  ***
 *** ���� �ʵ��� �Ͻñ� �ٶ��ϴ�.     ********************************************* 
 *** ���Ƿ� �����Ͽ� �߻��� ������ ���ؼ��� (��)�̴Ͻý��� å����    ***** 
 *** ������ ���� �Ͻñ� �ٶ��ϴ�.      ********************************************
 ***************************************************************************************/
 
switch($paymethod){

	case(Card): // �ſ�ī�� 
		$pgid = "CARD";
		break;
	case(Account): // ���� ���� ��ü
		$pgid = "ACCT";
		break;
	case(DirectBank): // �ǽð� ���� ��ü
		$pgid = "DBNK";
		break;
	case(OCBPoint): // OCB
		$pgid = "OCBP";
		break;
	case(VCard): // ISP ����
		$pgid = "ISP_";
		break;
	case(HPP): // �޴��� ����
		$pgid = "HPP_";
		break;
	case(ArsBill): // 700 ��ȭ����
		$pgid = "ARSB";
		break;
	case(PhoneBill): // PhoneBill ����(�޴� ��ȭ)
		$pgid = "PHNB";
		break;
	case(Ars1588Bill): // 1588 ��ȭ����
		$pgid = "1588";
		break;
	case(VBank):  // ������� ��ü
		$pgid = "VBNK";
		break;
	case(Culture):  // ��ȭ��ǰ�� ����
		$pgid = "CULT";
		break;
	case(CMS): // CMS ����
		$pgid = "CMS_";
		break;
	case(AUTH): // �ſ�ī�� ��ȿ�� �˻�
		$pgid = "AUTH";
		break;	
	case(INIcard): // ��Ƽ�Ӵ� ����
		$pgid = "INIC";
		break;
	case(MDX):  // �󵦽�ī��
		$pgid = "MDX_";
		break;
	default:        // ��� ���Ҽ��� �� �߰��Ǵ� ���Ҽ����� ��� �⺻���� paymethod�� 4�ڸ��� �Ѿ�´�.
		$pgid = $paymethod;
}

/*************************************************************************************
 *************************************************************************************
 ********************        ���κ� ���� ���� �Ұ�      ************************
 *************************************************************************************
 *************************************************************************************/
 
/*----------------------------------------------------------* 
 *������ �Һΰŷ��� ��� �Һΰ����� �ڿ� �������Һ����� ǥ��*
 *----------------------------------------------------------*/

if($quotainterest == "1")
{
	$interest = "(�������Һ�)";
}
 
/*----------------------------------------------------------*/

 
class INIpay41
{
	var $fd;
	var $m_inipayHome; //�̴����� Ȩ���͸�
	var $m_test; // "true"�� 17������ ������
	var $m_debug; // "true"�� ���� �α׸� �����
	var $m_type; // �ŷ� ����
	var $m_pgId; // ��� PG? (Inicis, SK, ...)
	var $m_keyPw; // keypass.enc�� pass phrase
	var $m_subPgIp; // 3��° ���� PG IP Addr
	var $m_mid; // ���� ���̵�
	var $m_language; // �����
	var $m_oldTid; // (repay) ���ŷ����̵�
	var $m_tid; // �ŷ����̵�
	var $m_goodName; // ��ǰ��
	var $m_currency; // ȭ����� (WON, USD)
	var $m_price; // �ݾ�
	var $m_buyerName; // ������ ����
	var $m_buyerTel; // ������ ��ȭ��ȣ (SMS ���� �ݵ�� �̵���ȭ...)
	var $m_buyerEmail; // ������ �̸���
	var $m_recvName; // ������ ����
	var $m_recvTel; // ������ ����ó
	var $m_recvAddr; // ������ �ּ�
	var $m_recvPostNum; // ������ �����ȣ
	var $m_recvMsg; // �����ο��� ������ �޽���
	var $m_companyNumber; // ����� ��Ϲ�ȣ(10�ڸ� ����)
	var $m_cardCode; // ī��� �ڵ�
	var $m_cardIssuerCode; // ī�� �߱޻�(����) �ڵ�
	var $m_payMethod; // ���ҹ��
	var $m_merchantReserved1; // �����ʵ� (����) 
	var $m_merchantReserved2; // �����ʵ� (����) 
	var $m_merchantReserved3; // �����ʵ� (����) 
	var $m_uip; // ������ PC IP Addr
	var $m_url; // ���� ���� URL
	var $m_billingPeriod; // Billing �Ⱓ (2002/07 ���� ������)
	var $m_payOption; // ...
	var $m_encrypted; // ��ȣ�� (��ĪŰ�� ��ȣȭ�� PLAIN TEXT)
	var $m_sessionKey; // ��ȣ�� (����Ű�� ��ȣȭ�� ��ĪŰ)
	var $m_uid; // INIpay User ID (2002/07 ���� ������)
	var $m_quotaInterest; // �������Һ� FLAG
	var $m_cardNumber;  // �ſ�ī�� ��ȣ
	var $m_price1; // OK Cashbag, Netimoney ���� ����ϴ� �߰� �ݾ�����
	var $m_price2; // OK Cashbag, Netimoney ���� ����ϴ� �߰� �ݾ�����
	var $m_cardQuota; // �ҺαⰣ
	var $m_bankCode; // �����ڵ�
	var $m_bankAccount; // ���� ���¹�ȣ
	var $m_regNumber; // �ֹε�Ϲ�ȣ
	var $m_ocbNumber; // OK Cashbag ī�� ��ȣ
	var $m_ocbPasswd; // OK Cashbag ī�� ��й�ȣ
	var $m_authentification; // �������� FLAG
	var $m_authField1; // ���������� �ʿ��� �ֹι�ȣ �� 7�ڸ�
	var $m_authField2; // ���������� �ʿ��� ī�� ��й�ȣ �� 2�ڸ�
	var $m_authField3; // ���������� �ʿ��� �����ʵ�
	var $m_passwd; // (����) ��й�ȣ
	var $m_cardExpy; // �ſ�ī�� ��ȿ�Ⱓ-�� (YY)
	var $m_cardExpm; // �ſ�ī�� ��ȿ�Ⱓ-�� (MM)
	var $m_cardExpire; // �ſ�ī�� ��ȿ�Ⱓ (YYMM)
	var $m_ocbCardType; // OK Cashbag ī�� ���� (�ڻ�ī��...)
	var $m_merchantReserved; // �����ʵ� (������)
	var $m_cancelMsg; // ��� ����
	var $m_resultCode; // ��� �ڵ� (2 digit)
	var $m_resultMsg; // ��� ����
	var $m_authCode; // �ſ�ī�� ���ι�ȣ
	var $m_ocbResultPoint; // OK Cashbag Point ��ȸ�� ��������Ʈ
	var $m_authCertain; // PG���� ���������� �����Ͽ������� ��Ÿ���� FLAG
	var $m_ocbSaveAuthCode; // OK Cashbag ���� ���ι�ȣ
	var $m_ocbUseAuthCode; // OK Cashbag ��� ���ι�ȣ
	var $m_ocbAuthDate; // OK Cashbag ���� ��¥
	var $m_pgAuthDate; // PG ���� ��¥
	var $m_pgAuthTime; // PG ���� �ð�
	var $m_pgCancelDate; // PG ��� ��¥
	var $m_pgCancelTime; // PG ��� �ð�
	var $m_requestMsg; // ���� �޽���
	var $m_responseMsg; // ���� �޽���
	var $m_resulterrcode; // ����޼��� �����ڵ�
	
	
/* == �ʵ��߰� (2004.06.23 �븮 ������) == */
	var $m_moid; 		// ��ǰ�ֹ���ȣ
	var $m_codegw; 		// ��ȭ���� ����� �ڵ�
	var $m_ParentEmail; 	// ��ȣ�� �̸��� �ּ�
	var $m_ocbcardnumber; 	// OK CASH BAG ���� , ������ ��� OK CASH BAG ī�� ��ȣ
	var $m_cultureid;	// ���� ���� ID
	var $m_directbankacc;	// ���� ������ü ������ ��� ���� ���� ��ȣ
	var $m_directbankcode;	// ���� ������ü ������ ��� ���� �ڵ� ��ȣ
	
	
/* ==  ������¸� ���� �߰� (2003.07.07 �븮 ������)  == */
	var $m_perno; // ������� ���� ������ �ֹι�ȣ
	var $m_oid; // �ֹ���ȣ(�������� ���޵Ǵ� ��)
	var $m_vacct; // ������� ��ȣ
	var $m_vcdbank; // ä���� ���� �����ڵ�
	var $m_dtinput; // �Ա� ������
	var $m_nminput; // �۱��� ��
	var $m_nmvacct; // ������ ��
	var $m_rvacct;	// ȯ�Ұ��� ��ȣ
	var $m_rvcdbank;	// ȯ�Ұ��� �����ڵ�
	var $m_rnminput;	// ȯ�Ұ��� �����ָ�
	

/* ==  OCB + ISP ���հ����� ���� �߰� (2003.11.18 �븮 ������)  == */
    
    var $m_OresultCode; 
    var $m_OresultMsg;        
    var $m_OpgCancelDate;        
    var $m_OpgCancelTime;	
	
	function startAction()
	{
		switch($this->m_type)
		{
			case("securepay") :
				$this->m_requestMsg = 
					"inipayhome=" . $this->m_inipayHome . "\x0B" .
					"pgid=" . $this->m_pgId . "\x0B" .
					"spgip=" . $this->m_subPgIp . "\x0B" .
					"admin=" . $this->m_keyPw . "\x0B" .
					"debug=" . $this->m_debug . "\x0B" .
					"test=" . $this->m_test . "\x0B" .
					"mid=" . $this->m_mid . "\x0B" .
					"uid=" . $this->m_uid . "\x0B" .
					"url=" . $this->m_url . "\x0B" .
					"uip=" . $this->m_uip . "\x0B" .
					"paymethod=" . $this->m_payMethod . "\x0B" .
					"goodname=" . $this->m_goodName . "\x0B" .
					"currency=" . $this->m_currency . "\x0B" .
					"price=" . $this->m_price . "\x0B" .
					"buyername=" . $this->m_buyerName . "\x0B" .
					"buyertel=" . $this->m_buyerTel . "\x0B" .
					"buyeremail=" . $this->m_buyerEmail . "\x0B" .
					"parentemail=" . $this->m_ParentEmail . "\x0B" .
					"recvname=" . $this->m_recvName . "\x0B" .
					"recvtel=" . $this->m_recvTel . "\x0B" .
					"recvaddr=" . $this->m_recvAddr . "\x0B" .
					"recvpostnum=" . $this->m_recvPostNum . "\x0B" .
					"recvmsg=" . $this->m_recvMsg . "\x0B" .
					"sessionkey=" . $this->m_sessionKey . "\x0B" .
					"encrypted=" . $this->m_encrypted . "\x0B" .
					"merchantreserved1=" . $this->m_merchantReserved1 . "\x0B" .
					"merchantreserved2=" . $this->m_merchantReserved2 . "\x0B" .
					"merchantreserved3=" . $this->m_merchantReserved3;
				$this->m_responseMsg = exec($this->m_inipayHome . '/phpexec/INIsecurepay.phpexec \'' . $this->m_requestMsg . '\'');
				if(strlen($this->m_responseMsg) <= 1)
					$this->m_responseMsg = "libResultCode=01&libResultMsg=[9199]INVOKE ERR : " . $this->m_inipayHome . '/phpexec/INIsecurepay.phpexec';
				break;
		
			case("cancel") :
				$this->m_requestMsg = 
					"inipayhome=" . $this->m_inipayHome . "\x0B" .
					"pgid=" . $this->m_pgId . "\x0B" .
					"spgip=" . $this->m_subPgIp . "\x0B" .
					"admin=" . $this->m_keyPw . "\x0B" .
					"debug=" . $this->m_debug . "\x0B" .
					"test=" . $this->m_test . "\x0B" .
					"mid=" . $this->m_mid . "\x0B" .
					"tid=" . $this->m_tid . "\x0B" .
					"msg=" . $this->m_cancelMsg . "\x0B" .
					"uip=" . $this->m_uip . "\x0B" .
					"merchantreserved=" . $this->m_merchantReserved;
				$this->m_responseMsg = exec($this->m_inipayHome . '/phpexec/INIcancel.phpexec \'' . $this->m_requestMsg . '\'');
				if(strlen($this->m_responseMsg) <= 1)
					$this->m_responseMsg = "libResultCode=01&libResultMsg=[9199]INVOKE ERR : " . $this->m_inipayHome . '/phpexec/INIcancel.phpexec';
				break;

			case("confirm") :
				$this->m_requestMsg = 
					"inipayhome=" . $this->m_inipayHome . "\x0B" .
					"test=" . $this->m_test . "\x0B" .
					"pgid=" . $this->m_pgId . "\x0B" .
					"spgip=" . $this->m_subPgIp . "\x0B" .
					"admin=" . $this->m_keyPw . "\x0B" .
					"mid=" . $this->m_mid . "\x0B" .
					"tid=" . $this->m_tid . "\x0B" .
					"debug=" . $this->m_debug . "\x0B" .
					"merchantreserved=" . $this->m_merchantReserved;
				$this->m_responseMsg = exec($this->m_inipayHome . '/phpexec/INIconfirm.phpexec \'' . $this->m_requestMsg . '\'');
				if(strlen($this->m_responseMsg) <= 1)
					$this->m_responseMsg = "libResultCode=01&libResultMsg=[9199]INVOKE ERR : " . $this->m_inipayHome . '/phpexec/INIconfirm.phpexec';
				break;
		
			case("capture") :
				$this->m_requestMsg = 
					"inipayhome=" . $this->m_inipayHome . "\x0B" .
					"test=" . $this->m_test . "\x0B" .
					"pgid=" . $this->m_pgId . "\x0B" .
					"spgip=" . $this->m_subPgIp . "\x0B" .
					"admin=" . $this->m_keyPw . "\x0B" .
					"mid=" . $this->m_mid . "\x0B" .
					"tid=" . $this->m_tid . "\x0B" .
					"debug=" . $this->m_debug . "\x0B" .
					"merchantreserved=" . $this->m_merchantReserved;
				$this->m_responseMsg = exec($this->m_inipayHome . '/phpexec/INIcapture.phpexec \'' . $this->m_requestMsg . '\'');
				if(strlen($this->m_responseMsg) <= 1)
					$this->m_responseMsg = "libResultCode=01&libResultMsg=[9199]INVOKE ERR : " . $this->m_inipayHome . '/phpexec/INIcapture.phpexec';
				break;
		
			case("formpay") :
				$this->m_requestMsg =
					"inipayhome=" . $this->m_inipayHome . "\x0B" .
					"pgid=" . $this->m_pgId . "\x0B" .
					"spgip=" . $this->m_subPgIp . "\x0B" .
					"admin=" . $this->m_keyPw . "\x0B" .
					"debug=" . $this->m_debug . "\x0B" .
					"test=" . $this->m_test . "\x0B" .
					"mid=" . $this->m_mid . "\x0B" .
					"uid=" . $this->m_uid . "\x0B" .
					"url=" . $this->m_url . "\x0B" .
					"uip=" . $this->m_uip . "\x0B" .
					"paymethod=" . $this->m_payMethod . "\x0B" .
					"goodname=" . $this->m_goodName . "\x0B" .
					"currency=" . $this->m_currency . "\x0B" .
					"price=" . $this->m_price . "\x0B" .
					"buyername=" . $this->m_buyerName . "\x0B" .
					"buyertel=" . $this->m_buyerTel . "\x0B" .
					"buyeremail=" . $this->m_buyerEmail . "\x0B" .
					"recvname=" . $this->m_recvName . "\x0B" .
					"recvtel=" . $this->m_recvTel . "\x0B" .
					"recvaddr=" . $this->m_recvAddr . "\x0B" .
					"recvpostnum=" . $this->m_recvPostNum . "\x0B" .
					"cardnumber=" . $this->m_cardNumber . "\x0B" .
					"cardquota=" . $this->m_cardQuota . "\x0B" .
					"cardexpy=" . $this->m_cardExpy . "\x0B" .
					"cardexpm=" . $this->m_cardExpm . "\x0B" .
					"quotainterest=" . $this->m_quotaInterest . "\x0B" .
					"authentification=" . $this->m_authentification . "\x0B" .
					"authfield1=" . $this->m_authfield1 . "\x0B" .
					"authfield2=" . $this->m_authfield2 . "\x0B" .
					"price1=" . $this->m_price1 . "\x0B" .
					"price2=" . $this->m_price2 . "\x0B" .
					"bankcode=" . $this->m_bankCode . "\x0B" .
					"bankaccount=" . $this->m_bankAccount . "\x0B" .
					"regnumber=" . $this->m_regNumber . "\x0B" .
					"ocbnumber=" . $this->m_ocbNumber . "\x0B" .
					"ocbpasswd=" . $this->m_ocbPasswd . "\x0B" .
					"passwd=" . $this->m_passwd . "\x0B" .
					"perno=" . $this->m_perno . "\x0B" .
	                "oid=" . $this->m_oid . "\x0B" .
	                "vacct=" . $this->m_vacct . "\x0B" .
	                "vcdbank=" . $this->m_vcdbank . "\x0B" .
	                "dtinput=" . $this->m_dtinput . "\x0B" .
	                "nminput=" . $this->m_nminput . "\x0B" .
					"companynumber=" . $this->m_companyNumber . "\x0B" .
					"merchantreserved1=" . $this->m_merchantReserved1 . "\x0B" .
					"merchantreserved2=" . $this->m_merchantReserved2 . "\x0B" .
					"merchantreserved3=" . $this->m_merchantReserved3;
																			
				$this->m_responseMsg = exec($this->m_inipayHome . '/phpexec/INIformpay.phpexec \'' . $this->m_requestMsg . '\'');
				if(strlen($this->m_responseMsg) <= 1)
					$this->m_responseMsg = "libResultCode=01&libResultMsg=[9199]INVOKE ERR : " . $this->m_inipayHome . '/phpexec/INIformpay.phpexec';
				
				
				break;
		
			case("repay") :
				$this->m_requestMsg =
					"inipayhome=" . $this->m_inipayHome . "\x0B" .
					"pgid=" . $this->m_pgId . "\x0B" .
					"spgip=" . $this->m_subPgIp . "\x0B" .
					"admin=" . $this->m_keyPw . "\x0B" .
					"debug=" . $this->m_debug . "\x0B" .
					"test=" . $this->m_test . "\x0B" .
					"mid=" . $this->m_mid . "\x0B" .
					"oldtid=" . $this->m_oldTid . "\x0B" .
					"url=" . $this->m_url . "\x0B" .
					"uip=" . $this->m_uip . "\x0B" .
					"goodname=" . $this->m_goodName . "\x0B" .
					"currency=" . $this->m_currency . "\x0B" .
					"price=" . $this->m_price . "\x0B" .
					"buyername=" . $this->m_buyerName . "\x0B" .
					"buyertel=" . $this->m_buyerTel . "\x0B" .
					"buyeremail=" . $this->m_buyerEmail . "\x0B" .
					"cardquota=" . $this->m_cardQuota . "\x0B" .
					"quotainterest=" . $this->m_quotaInterest . "\x0B" .
					"merchantreserved1=" . $this->m_merchantReserved1 . "\x0B" .
					"merchantreserved2=" . $this->m_merchantReserved2 . "\x0B" .
					"merchantreserved3=" . $this->m_merchantReserved3;
				$this->m_responseMsg = exec($this->m_inipayHome . '/phpexec/INIrepay.phpexec \'' . $this->m_requestMsg . '\'');
				if(strlen($this->m_responseMsg) <= 1)
					$this->m_responseMsg = "libResultCode=01&libResultMsg=[9199]INVOKE ERR : " . $this->m_inipayHome . '/phpexec/INIrepay.phpexec';
				break;

			case("ocbquery") :
				$this->m_requestMsg =
					"inipayhome=" . $this->m_inipayHome . "\x0B" .
					"mid=" . $this->m_mid . "\x0B" .
					"ocbnumber=" . $this->m_ocbNumber;
				$this->m_responseMsg = exec($this->m_inipayHome . '/phpexec/INIocbquery.phpexec \'' . $this->m_requestMsg . '\'');
				if(strlen($this->m_responseMsg) <= 1)
					$this->m_responseMsg = "libResultCode=01&libResultMsg=[9199]INVOKE ERR : " . $this->m_inipayHome . '/phpexec/INIocbquery.phpexec';
				break;

			default :
				$this->m_responseMsg = "libResultCode=01&libResultMsg=ó���� �� ���� �ŷ������Դϴ� : " . $this->m_type;
		}
		
		
		parse_str($this->m_responseMsg);
				
		$this->m_resultCode = $libResultCode;
		$this->m_resultMsg = $libResultMsg;
		$this->m_pgCancelDate = $libPgCancelDate;
		$this->m_pgCancelTime = $libPgCancelTime;
		
// OCB + ISP �������� �� ��� �޼���(2003.11.18)

        $this->m_OresultCode = $OlibResultCode;    
        $this->m_OresultMsg = $OlibResultMsg;        
        $this->m_OpgCancelDate = $OlibPgCancelDate;        
        $this->m_OpgCancelTime = $OlibPgCancelTime;

		$this->m_payMethod = $libPayMethod;
		$this->m_authCode = $libAuthCode;
		$this->m_cardCode = $libCardCode;
		$this->m_cardIssuerCode = $libCardIssuerCode;
		$this->m_tid = $libTid;
		$this->m_price1 = $libPrice1;
		$this->m_price2 = $libPrice2;
		$this->m_cardQuota = $libCardQuota;
		$this->m_quotaInterest = $libQuotaInterest;
		$this->m_authCertain = $libAuthCertain;
		$this->m_pgAuthDate = $libPgAuthDate;
		$this->m_pgAuthTime = $libPgAuthTime;
		$this->m_ocbSaveAuthCode = $libOcbSaveAuthCode;
		$this->m_ocbUseAuthCode = $libOcbUseAuthCode;
		$this->m_ocbAuthDate = $libOcbAuthDate;
		$this->m_ocbResultPoint = $libResultPoint;
		$this->m_cardNumber = $libCardNumber;
		$this->m_cardExpire = $libCardExpire;
		$this->m_cardQuota = $libCardQuota;
		$this->m_perno = $libperno;
		$this->m_oid = $libvoid;
		$this->m_vacct = $libvacct;
		$this->m_vcdbank = $libvcdbank;
		$this->m_dtinput = $libdtinput;
		$this->m_nminput = $libnminput;
		$this->m_nmvacct = $libnmvacct;
		$this->m_rvacct = $librvacct;
		$this->m_rvcdbank = $librvcdbank;
		$this->m_rnminput = $librnminput;
		$this->m_eventFlag = $libEventFlag;
		$this->m_nohpp = $libnohpp; 
		$this->m_noars = $libnoars;
		
/* == �߰� �ʵ� (2004.6.23 �븮 ������) == */
		$this->m_moid = $libmoid;
		$this->m_codegw = $libcodegw;
		$this->m_ocbcardnumber = $libocbcardnumber; 
		$this->m_cultureid = $libcultureid;
		$this->m_directbankacc = $libdirectbankacc;
		$this->m_directbankcode = $libdirectbankcode;

		
		// ����޼��� ($m_resultMsg)���� �����ڵ� �Ľ�

		$str = $this->m_resultMsg ;
		$arr = split("\]+", $str);
		$this->m_resulterrcode = substr($arr[0],1);
	}
}

?>
