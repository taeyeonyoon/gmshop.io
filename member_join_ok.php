<?
include "./lib/config.php";
include "./lib/function.php";
if (empty($_POST)) exit;
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
if(!defined(__DESIGN_GOODS_ROW))
{
	define(__DESIGN_GOODS_ROW,"TRUE");
	$design_goods=$MySQL->fetch_array("select *from design_goods limit 0,1");
}
$sms = $MySQL->fetch_array("select * from smsinfo");
$showArr = explode("|",$design_goods[memberJoinShow]);			//ǥ��
$sureArr = explode("|",$design_goods[memberJoinSure]);			//�ʼ�
$bDeal=in_array($bDeal,array(0,1))?$bDeal:0;
$pwd		=$pwd1;							// ��й�ȣ
$ssh		=$ssh1."-".$ssh2;				// �ֹε�Ϲ�ȣ
$zip		=$zip1."-".$zip2;				// �����ȣ
$tel		=$tel1."-".$tel2."-".$tel3;		// ����ó
$hand		=$hand1."-".$hand2."-".$hand3;	// �޴���ȭ
if(!$showArr[10] && !$sureArr[10])
{
	//���ϼ��ſ��� �����Ҷ� �ڵ����� �������� ���� 
	if($bMail==1) $bMail	=1;			// ���ϸ�����Ʈ ex) 1:���  0:�����
	else $bMail = 0;
}
if (!isset($bMail)) $bMail = 1;

$id_qry		="select *from member where userid='$userid' and part='M'";
$MySQL->query($id_qry);
$id_numrows	=$MySQL->is_affected();		//�ش���̵� ���翩�� ex) ���� : 1�̻�
if (!$bDeal && ($showArr[5] || $sureArr[5]))
{
	$ssh_qry		="select *from member where ssh='$ssh' and part='M'";
	$MySQL->query($ssh_qry);
	$ssh_numrows	=$MySQL->is_affected();		//�ش��ֹι�ȣ ���翩�� ex) ���� : 1�̻�
}
$birth = $year."-".$month."-".$day; //���� 
$birth2 = $year2."-".$month2."-".$day2; //��ȥ����� 
$ceo_zip = $ceo_zip1."-".$ceo_zip2;
$ceonum =  $ceonum1."-".$ceonum2."-".$ceonum3;
if($id_numrows)
{
	MsgView("�̹� �����ϴ� ���̵� �Դϴ�.\\n\\n�ٸ� ���̵� �Է��� �ֽʽÿ�.",-1);
	exit;
}
if($showArr[5] || $sureArr[5])
{
	if($ssh_numrows && $ssh!='-')
	{
		MsgView("������ ���̵� �����ϴ� �ֹε�Ϲ�ȣ �Դϴ�.",-1);	 //�ֹε�Ϲ�ȣ ����
		exit;
	}
}
$address1 = str_replace(",","",$address1);
$address2 = str_replace(",","",$address2);
$name = trim($name);
$userid = trim($userid);
$qry = "insert into member(name,userid,pwd,";
$qry.= "email,ssh,zip,address1,address2,city,tel,hand,bMail,writeday,point,bSms,bDeal,nearDay,birth,birth2,companyname,ceonum,ceoname,ceo_zip,ceo_address1,ceo_address2,upjongtype,jongmok";
$qry.= ")values(";
$qry.= "'$name',";			// �̸�
$qry.= "'$userid',";			// ���̵�
$qry.= "password('$pwd'),";		// ��й�ȣ
$qry.= "'$email',";			// �̸���
$qry.= "'$ssh',";				// �ֹε�Ϲ�ȣ
$qry.= "'$zip',";				// �����ȣ
$qry.= "'$address1',";		// �ּ�
$qry.= "'$address2',";		// ���ּ�
$qry.= "'$city',";			// ��������
$qry.= "'$tel',";				// ����ó
$qry.= "'$hand',";			// �޴���ȭ
$qry.= "$bMail,";				// ���ϸ�����Ʈ ex) 1:���  0:�����
$qry.= "now(),";				// ������
$qry.= "$admin_row[poReg],";	// ���� ������
$qry.= "'$bSms',";
$qry.= "$bDeal,";
$qry.= "now(),'$birth','$birth2'";
$qry.= ",'$companyname','$ceonum','$ceoname','$ceo_zip','$ceo_address1','$ceo_address2','$upjongtype','$jongmok'";
$qry.= ")";
if($MySQL->query($qry))
{
	//������ ����/////////////////////////////////////////////////////////////////////////////
	if ($admin_row[bUsepoint])
	{
		$pqry = "insert into point_table(part,userid,point,reason,writeday)values(";
		$pqry.= "'����','$userid',$admin_row[poReg],'ȸ������ ����',now())";
		@$MySQL->query($pqry) or die("Err. :$pqry");
	}
	// ���� ������ ����
	if($admin_row[bRegmail]=="y")
	{
		//���Ը��� ������
		include "email/member_join_success.php";
	}

	// sms ������ ����
	if ($bSms=="y")
	{
		if($sms[bSms] && !empty($sms[userid]) && !empty($sms[pwd]))
		{
			// ����sms ������
			$SMS_PART = "member_join";
			include "sms/smsclient.php";
		}
	}
	$jdata = base64_encode("jName=$name&jUserid=$userid&jPwd=$pwd");
	ReFresh("member_join_success.php?jdata=$jdata");
}
else
{
	echo "Err. : <p>$qry";
}
?>