<?
session_start();
include "./lib/config.php";
include "./lib/function.php";

if(!defined(__DESIGN_GOODS_ROW))
{
	define(__DESIGN_GOODS_ROW,"TRUE");
	$design_goods=$MySQL->fetch_array("select *from design_goods limit 0,1");
}

$showArr = explode("|",$design_goods[memberJoinShow]);		//ǥ��
$sureArr = explode("|",$design_goods[memberJoinSure]);		//�ʼ�
$member_row = $MySQL->fetch_array("select * from member where userid='$_SESSION[GOOD_SHOP_USERID]'");
$ceonum =  $ceonum1."-".$ceonum2."-".$ceonum3;
if($memberdel)
{
	// Ż��ȸ�� ��Ͽ� �߰�
	$qry = "insert into member_withdraw(name,userid,pwd,";
	$qry.= "email,ssh,zip,address1,address2,city,tel,hand,bMail,writeday,point,bSms";
	$qry.= ")values(";
	$qry.= "'$member_row[name]',";			// �̸�
	$qry.= "'$member_row[userid]',";			// ���̵�
	$qry.= "('$member_row[pwd]'),";				// ��й�ȣ
	$qry.= "'$member_row[email]',";			// �̸���
	$qry.= "'$member_row[ssh]',";				// �ֹε�Ϲ�ȣ
	$qry.= "'$member_row[zip]',";				// �����ȣ
	$qry.= "'$member_row[address1]',";		// �ּ�
	$qry.= "'$member_row[address2]',";		// ���ּ�
	$qry.= "'$member_row[city]',";			// ��������
	$qry.= "'$member_row[tel]',";				// ����ó
	$qry.= "'$member_row[hand]',";			// �޴���ȭ
	$qry.= "$member_row[bMail],";				// ���ϸ�����Ʈ ex) 1:���  0:�����
	$qry.= "now(),";				// ������
	$qry.= "$member_row[point],";	// ���� ������
	$qry.= "'$member_row[bSms]'";
	$qry.= ")";
	$MySQL->query($qry);

	$MySQL->query("delete from cart where userid='$_SESSION[GOOD_SHOP_USERID]'");
	$MySQL->query("delete from member where userid='$_SESSION[GOOD_SHOP_USERID]'");
	$MySQL->query("delete from interest where userid='$_SESSION[GOOD_SHOP_USERID]'");
	$MySQL->query("delete from point_table where userid='$_SESSION[GOOD_SHOP_USERID]'");

	OnlyMsgView("Ż��Ϸ� �Ͽ����ϴ�. \\n\\n�׵��� ���� ����Ʈ�� �̿��� �ּż� ����� �����մϴ�.");
	ReFresh("login_ok.php?del=1");
}
else
{
	/*------------------------ȸ���������� ---------------------------------*/
	$pwd		=$pwd1;							// ��й�ȣ
	$zip		=$zip1."-".$zip2;				// �����ȣ
	$tel		=$tel1."-".$tel2."-".$tel3;		// ����ó
	$hand		=$hand1."-".$hand2."-".$hand3;	// �޴���ȭ
	if (!isset($bMail))		$bMail	=1;			// ���ϸ�����Ʈ ex) 1:���  0:�����
	$ceo_zip = $ceo_zip1."-".$ceo_zip2;
	$birth = $year."-".$month."-".$day;
	$birth2 = $year2."-".$month2."-".$day2;

	$qry = "update member set ";
	if ($pwd)	$qry.= "pwd		= password('$pwd'),";				// ��й�ȣ
	$qry.= "email	= '$email',";			// �̸���
	$qry.= "zip		= '$zip',";				// �����ȣ
	$qry.= "address1= '$address1',";		// �ּ�
	$qry.= "address2= '$address2',";		// ���ּ�
	$qry.= "city	= '$city',";			// ��������
	$qry.= "tel		= '$tel',";				// ����ó
	$qry.= "hand	= '$hand',";			// �޴���ȭ
	$qry.= "bMail	= $bMail,";				// ���ϸ�����Ʈ ex) 1:���  0:�����
	$qry.= "bSms	= '$bSms',";
	$qry.= " companyname='$companyname', ";
	$qry.= " ceonum='$ceonum', ";
	$qry.= " ceoname='$ceoname', ";
	$qry.= " ceo_zip='$ceo_zip', ";
	$qry.= " ceo_address1='$ceo_address1', ";
	$qry.= " ceo_address2='$ceo_address2', ";
	$qry.= " upjongtype='$upjongtype', ";
	$qry.= " jongmok ='$jongmok', ";	
	$qry.= " birth='$birth', ";
	$qry.= " birth2='$birth2', ";
	$qry.= ",refund_bank	= '".addslashes($refund_bank)."'";
	$qry.= ",refund_name	= '".addslashes($refund_name)."'";
	$qry.= ",refund_account	= '".addslashes($refund_account)."'";
	$qry.= ",bDeal	= '".$bDeal."'";
	$qry.= " where userid='$_SESSION[GOOD_SHOP_USERID]' ";

	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
		ReFresh("mypage_member.php");
	}
	else
	{
		echo "Err. : <p>$qry";
	}
}
?>