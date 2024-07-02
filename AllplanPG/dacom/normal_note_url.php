<?php
///////////////////////////////////////////////////////////////
// ���α׷���	: normal_note_url.php
// ��  ��		: ������ ���� ���� ���
// �ۼ���		: �輺ȣ
// ��  ��		: (��)���÷�
// ��  ��		: 2006�� 5�� 13�� �����
//	DB������ ���� ������������ ���� ������ �Ϻ�($value �迭����) �����Ͽ���
///////////////////////////////////////////////////////////////
// �ҽ��������
// 20060720-1 �����߰� �輺ȣ

include "../../lib/config.php";
include "../../lib/function.php";

if(!defined(__ADMIN_ROW)){
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("SELECT * FROM admin limit 0,1");//����������
}

//�� �������� �������� ���ʽÿ�. ������ html�±׳� �ڹٽ�ũ��Ʈ�� ���� ��� ������ ������ �� �����ϴ�.
//���� dbó���� write.php���� �����ϴ� �Լ� write_success(),write_failure(),write_hasherr()���� ���� ��ƾ�� �߰��Ͻø� �˴ϴ�.
//���� �� �Լ����� ���� ������ ���� log����� �˴ϴ�. ������������ ����� �����η� �°� �����Ͽ� �ּ���

//hash����Ÿ���� �´� �� Ȯ�� �ϴ� ��ƾ�� �����޿��� ���� ����Ÿ�� �´��� Ȯ���ϴ� ���̹Ƿ� �� ����ϼž� �մϴ�
//�������� ���� ���ӿ��� �ұ��ϰ� ��Ƽ �������� ������ ��Ʈ�� ���� ������ ���� hash ���� ������ �߻��� ���� �ֽ��ϴ�.
//�׷��Ƿ� hash �����ǿ� ���ؼ��� ���� �߻��� ������ �ľ��Ͽ� ��� ���� �� ��ó�� �ּž� �մϴ�.

//���������� ó���� ��쿡�� �����޿��� ������ ���� ���� ���� ��������� �ߺ��ؼ� ���� �� �����Ƿ� ������ ó���� ����Ǿ�� �մϴ�. 
//�� �������� ������������ ���ο� ���� 'OK' �Ǵ� 'FAIL' �̶�� ���ڸ� ǥ���ϵ��� �Ǿ����ϴ�.  
//PHP������ �ǵ����̸� error_reporting() �Լ��� �̿��Ͽ� ���� �Ŀ��� �ܼ��� ���޼����� ����� ���� �ʵ��� ���ֽʽÿ�.

	// �������� function page
	include("./normal_write.php");



	// �����޿��� ���� value
	$respcode="";       // �����ڵ�: 0000(����) �׿� ����
	$respmsg="";        // ����޼���
	$hashdata="";       // �ؽ���
	$transaction="";    // �������� �ο��� �ŷ���ȣ
	$mid="";            // �������̵� 
	$oid="";            // �ֹ���ȣ
	$amount="";         // �ŷ��ݾ�
	$currency="";       // ��ȭ�ڵ�('410':��ȭ, '840':�޷�)
	$paytype="";        // ���������ڵ�
	$msgtype="";        // �ŷ������� ���� �������� ������ �ڵ�
	$paydate="";        // �ŷ��Ͻ�(�����Ͻ�/��ü�Ͻ�)
	$buyer="";          // �����ڸ�
	$productinfo="";    // ��ǰ����
	$buyerssn="";       // �������ֹε�Ϲ�ȣ
	$buyerid="";        // ������ID
	$buyeraddress="";   // �������ּ�
	$buyerphone="";     // ��������ȭ��ȣ
	$buyeremail="";     // �������̸����ּ�
	$receiver="";       // �����θ�
	$receiverphone="";  // ��������ȭ��ȣ
	$deliveryinfo="";   // �������
	$producttype="";    // ��ǰ����
	$productcode="";    // ��ǰ�ڵ�
	$financecode="";    // ��������ڵ�(ī������/�����ڵ�)
	$financename="";    // ��������̸�(ī���̸�/�����̸�)

	$authnumber="";     // ���ι�ȣ(�ſ�ī��)
	$cardnumber="";     // ī���ȣ(�ſ�ī��)
	$cardexp="";        // ��ȿ�Ⱓ(�ſ�ī��)
	$cardperiod="";     // �Һΰ�����(�ſ�ī��)	
	$nointerestflag=""; //�������Һο���(�ſ�ī��) - '1'�̸� �������Һ� '0'�̸� �Ϲ��Һ�
	$transamount="";    // ȯ������ݾ�(�ſ�ī��)
	$exchangerate="";   // ȯ��(�ſ�ī��)

	$pid="";            // ������/�޴��������� �ֹε�Ϲ�ȣ(������ü/�޴���) 
	$accountowner="";   // ���¼������̸�(������ü) 
	$accountnumber="";  // ���¹�ȣ(������ü, �������Ա�) 

	$telno="";          // �޴�����ȣ(�޴���)

	$payer="";           // �Ա���(�������Ա�)
	$cflag="";           // �������Ա� �÷���(�������Ա�) - 'R':�����Ҵ�, 'I':�Ա�, 'C':�Ա����
	$tamount="";         // �Ա��Ѿ�(�������Ա�)
	$camount="";         // ���Աݾ�(�������Ա�)
	$bankdate="";        // �ԱݶǴ�����Ͻ�(�������Ա�)
	$seqno="";			 // �Աݼ���(�������Ա�)
	$receiptnumber="";	 // ���ݿ����� ���ι�ȣ


	$resp = false;      //������� ��������

	$respcode = get_param("respcode");
	$respmsg = get_param("respmsg");
	$hashdata = get_param("hashdata");
	$transaction = get_param("transaction");
	$mid = get_param("mid");
	$oid = get_param("oid");
	$amount = get_param("amount");
	$currency = get_param("currency");
	$paytype = get_param("paytype");
	$msgtype = get_param("msgtype");
	$paydate = get_param("paydate");
	$buyer = get_param("buyer");
	$productinfo = get_param("productinfo");
	$buyerssn = get_param("buyerssn");
	$buyerid = get_param("buyerid");
	$buyeraddress = get_param("buyeraddress");
	$buyerphone = get_param("buyerphone");
	$buyeremail = get_param("buyeremail");
	$receiver = get_param("receiver");
	$receiverphone = get_param("receiverphone");
	$deliveryinfo = get_param("deliveryinfo");
	$producttype = get_param("producttype");
	$productcode = get_param("productcode");
	$financecode = get_param("financecode");
	$financename = get_param("financename");
	$authnumber = get_param("authnumber");
	$cardnumber = get_param("cardnumber");
	$cardexp = get_param("cardexp");
	$cardperiod = get_param("cardperiod");
	$nointerestflag = get_param("nointerestflag");
	$transamount = get_param("transamount");
	$exchangerate = get_param("exchangerate");
	$pid = get_param("pid");
	$accountnumber = get_param("accountnumber");
	$accountowner = get_param("accountowner");
	$telno = get_param("telno");
	$payer = get_param("payer");
	$cflag = get_param("cflag");
	$tamount = get_param("tamount");
	$camount = get_param("camount");
	$bankdate = get_param("bankdate");
	$seqno= get_param("seqno");
	$receiptnumber= get_param("receiptnumber");
	$useescrow= get_param("useescrow");


	$mertkey = $admin_row[shop_pg_mertkey]; //�����޿��� �߱��� ����Ű�� ������ �ֽñ� �ٶ��ϴ�.

	$hashdata2 = md5($transaction.$mid.$oid.$paydate.$mertkey);

	$value = array(	"msgtype"		=> $msgtype,
					"transaction"	=> $transaction,
					"shopId"			=> $mid,
					"tradecode"			=> $oid,
					"amount"		=> $amount,
					"currency"		=> $currency,
					"paytype"		=> $paytype,
					"paydate"		=> $paydate,
					"buyer"			=> $buyer,
					"productinfo"	=> $productinfo,
					"respcode"		=> $respcode,
					"respmsg"		=> $respmsg,
					"buyerssn"		=> $buyerssn,
					"buyerid"		=> $buyerid,
					"buyeraddress"	=> $buyeraddress,
					"buyerphone"	=> $buyerphone,
					"buyeremail"	=> $buyeremail,
					"receiver"		=> $receiver,
					"receiverphone"	=> $receiverphone,
					"deliveryinfo"	=> $deliveryinfo,
					"producttype"	=> $producttype,
					"productcode"	=> $productcode,
					"financecode"	=> $financecode,
					"financename"	=> $financename,
					"authnumber"	=> $authnumber,
					"cardnumber"	=> $cardnumber,
					"cardexp"		=> $cardexp,
					"cardperiod"	=> $cardperiod,
					"nointerestflag"=> $nointerestflag,
					"transamount"	=> $transamount,
					"exchangerate"	=> $exchangerate,
					"pid"			=> $pid,
					"accountnumber"	=> $accountnumber,
					"accountowner"	=> $accountowner,
					"telno"			=> $telno,
					"payer"			=> $payer,
					"cflag"			=> $cflag,
					"tamount"		=> $tamount,
					"camount"		=> $camount,
					"bankdate"			=>$bankdate,
					"hashdata"			=>$hashdata,
					"hashdata2"			=>$hashdata2,
					"seqno"				=>$seqno,
					"receiptnumber"		=>$receiptnumber,
					"useescrow"			=>$useescrow
					);
	
	if ($hashdata2 == $hashdata) {			//�ؽ��� ������ �����ϸ�
		if($respcode == "0000"){			//������ �����̸�
			$resp = write_success($value);
		}else {								//������ �����̸�
			$resp = write_failure($value);
		}
	} else {								//�ؽ��� ������ �����̸�
		write_hasherr($value);
	}

	if($resp){								//��������� �����̸�
		echo "OK";
	}else{									//��������� �����̸�
		echo "FAIL";
	}
?>
