<?
// �ҽ��������
// 20060720-1 ���ϱ�ü �輺ȣ
include "head.php";
/*------------------------������ �������� ���� ���� ---------------------------------*/
if(empty($bCardpay))		$bCardpay			=0;		//ī����� ��뿩��
if(empty($bHpppay))			$bHpppay			=0;		//�ڵ������� ��뿩��
if(empty($bIchepay))		$bIchepay			=0;		//������ü ��뿩��
if(empty($bCyberpay))		$bCyberpay			=0;		//������� ��뿩��
if(empty($bBankpay))		$bBankpay			=0;		//������ü �������Ա� ��뿩��
if(empty($bUsepoint))		$bUsepoint			=0;		//������ ��뿩��
if(empty($str_poReg))		$str_poReg			=0;		//ȸ�����Խ� ������
if(empty($str_poTotal))		$str_poTotal		=0;		//�ϰ�ó��
if(empty($str_poUnit))		$str_poUnit			=0;		//��ǰ����
if(empty($str_poMin))		$str_poMin			=0;		//������ �ּ� ��밡�� �ݾ�
if(empty($str_poMax))		$str_poMax			=0;		//������ �ִ� ��밡�� �ݾ�
if(empty($str_poMaxunlimit))$str_poMaxunlimit	=0;		//������ �ִ� ��밡�� �ݾ� : ������ ����

if(empty($popayM)) $popayM=0;
if(empty($write_goodsP)) $write_goodsP=0;

$qry = "update admin set ";
$qry.= "pgName			= '$pgName', ";					//���Ҵ���� ��
$qry.= "pG_test			= '$pG_test', ";				//PG �׽�Ʈ
$qry.= "shopId			= '$shopId', ";					//���Ҵ���� ���� ���̵�
$qry.= "shop_Escrow_Id	= '$shop_Escrow_Id', ";			//�̴Ͻý� ����ũ�ο� ���̵�
$qry.= "shop_pg_mertkey	= '$shop_pg_mertkey', ";		//PG ����Ű
$qry.= "shop_pg_encryption	= '$shop_pg_encryption', ";	//��ȣȭ ���뿩��
$qry.= "bCardpay		= $bCardpay, ";					//ī����� ��뿩��
$qry.= "bHpppay			= $bHpppay, ";					//�ڵ������� ��뿩��
$qry.= "bIchepay		= $bIchepay, ";					//������ü ��뿩��
$qry.= "bCyberpay		= $bCyberpay, ";				//������� ��뿩��
$qry.= "pg_rate			= '$pg_rate', ";				//ī����� ������
$qry.= "pg_rate_hand	= '$pg_rate_hand', ";			//�ڵ������� ������
$qry.= "pg_rate_iche	= '$pg_rate_iche', ";			//������ü ������
$qry.= "pg_rate_cyber	= '$pg_rate_cyber', ";			//������� ������
$qry.= "bBankpay		= $bBankpay, ";					//������ü �������Ա� ��뿩��
$qry.= "bBank			= '$str_bBank', ";				//�� ���� ��뿩��
$qry.= "bankName		= '$str_bankName', ";			//�� ���� ����� 
$qry.= "bankId			= '$str_bankId', ";				//�� ���� ���¹�ȣ
$qry.= "bankOwn 		= '$str_bankOwn', ";			//�� ���� ������
$qry.= "bUsepoint		= $bUsepoint, ";				//������ ��뿩��
$qry.= "poReg			= $str_poReg, ";				//ȸ�����Խ� ������
$qry.= "poMethod		= '$str_poMethod', ";			//��ǰ ���Ž� ������ ���� ���
$qry.= "poTotal			= $str_poTotal, ";				//�ϰ�ó��
$qry.= "poUnit			= $str_poUnit, ";				//��ǰ����
$qry.= "poMin			= $str_poMin, ";				//������ �ּ� ��밡�� �ݾ�
$qry.= "poMax			= $str_poMax, ";				//������ �ִ� ��밡�� �ݾ�
$qry.= "poMaxunlimit	= $str_poMaxunlimit, ";			//������ �ִ� ��밡�� �ݾ� : ������ ����
$qry.= "popayM			= $popayM, ";
$qry.= "write_goodsP	= $write_goodsP ";

if($MySQL->query($qry))
{
	OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
	ReFresh("adm_account.php");
}
else
{
	ErrMsg($qry);
	ReFresh("adm_account.php");
}
?>