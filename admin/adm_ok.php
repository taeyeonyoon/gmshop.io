<?
include "head.php";
if(empty($adminId) || $adminId =="")
{
	OnlyMsgView("�ùٸ� ������ �ƴմϴ�.");
	ReFresh("adm.php");
	exit;
}
if(!defined(__ADMIN_ROW))
{
	define(__ADMIN_ROW,"TRUE");
	$admin_row=$MySQL->fetch_array("select *from admin limit 0,1"); //������ ���� �迭
}
/*------------------------������ �⺻ ���� ���� ---------------------------------*/
$comNum = $comNum1."-".$comNum2."-".$comNum3;
$comZip = $comZip1."-".$comZip2;
$qry = "update admin set ";
$qry.= "shopUrl    = '$shopUrl',";		//���θ� �ּ�
$qry.= "shopTitle  = '$shopTitle',";	//���θ� ����
$qry.= "shopName   = '$shopName',";	    //���θ� ����
$qry.= "adminId	   = '$adminId',";		//������ ���̵�
$qry.= "adminPwd   = '$adminPwd',";		//������ ��й�ȣ
$qry.= "adminEmail = '$adminEmail',";	//������ �̸���
$qry.= "comName	   = '$comName',";		//��ȣ
$qry.= "comNum	   = '$comNum',";		//����� ��Ϲ�ȣ
$qry.= "comCon     = '$comCon',";		//����
$qry.= "comItem    = '$comItem',";		//����
$qry.= "comCeo     = '$comCeo',";		//��ǥ�� ��
$qry.= "comAdr     = '$comAdr',";		//����� �ּ�
$qry.= "comTel     = '$comTel',";		//����ó
$qry.= "comFax     = '$comFax', ";		//�ѽ�
$qry.= "esailNum   = '$esailNum', ";		//����Ǹž��Ű��ȣ
$qry.= "adminEmail2 = '$adminEmail2',";
$qry.= "startpage_adm = '$startpage_adm',";
$qry.= "guard = '$guard',";
$qry.= "comZip = '$comZip',";
$qry.= "shopKeyword = '$shopKeyword',";
$qry.= "editDay = now()";

if ($adminId != $admin_row[adminId] || $adminPwd != $admin_row[adminPwd]) //������ ���̵� ��ȣ�� �ٲ������ ���� ���� 
{
	@session_unregister("GOOD_SHOP_ADMIN_USERID") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_ADMIN_PWD") or die("session_register err");
	$GOOD_SHOP_ADMIN_USERID		= $adminId;
	$GOOD_SHOP_ADMIN_PWD		= $adminPwd;
	$_SESSION['GOOD_SHOP_ADMIN_USERID']		= "$GOOD_SHOP_ADMIN_USERID";
	$_SESSION['GOOD_SHOP_ADMIN_PWD']		= "$GOOD_SHOP_ADMIN_PWD";
}
if($MySQL->query($qry))
{
	OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
	ReFresh("adm.php");
}
else
{
	ErrMsg($qry);
	ReFresh("adm.php");
}
?>