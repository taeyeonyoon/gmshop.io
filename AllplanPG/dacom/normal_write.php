<?php
///////////////////////////////////////////////////////////////
// ���α׷���	: normal_write.php
// ��  ��		: ������ ���� ���Ű�� DB/����ó�� ���
// �ۼ���		: �輺ȣ
// ��  ��		: (��)���÷�
// ��  ��		: 2006�� 5�� 13�� �����
//	return value
//		true	: DB���� ����
//		false	: DB���� ����
///////////////////////////////////////////////////////////////
// �ҽ��������
// 20060720-1 �����߰� �輺ȣ

function write_success($noti){
	global $MySQL;

	$qry_pre = "INSERT INTO GM_PG_dacom(";
	$qry_post = " VALUES(";
	reset($noti);
	while(list($key, $val) = each($noti))
	{
		$qry_pre.= $key.",";
		$qry_post.= "'".addslashes($val)."',";
	}
	$qry_pre.= "readDay";	// �ڷ�������� ��Ͽ� �ʵ� �߰�
	$qry_post.= "now()";	// �ڷ�������� : ������ ���Ž���
	$qry = $qry_pre.")".$qry_post.")";

	if( !($MySQL->query($qry)) )	// DBó�� ���� �߻���
	{
		//DB���� �Ұ��ÿ��� ���Ϸ� ���� ����Ͽ� DB �Է¿��� ������ Ȯ����� ��
		$body = "[".date("Y-m-d :h:i:s A")."] �������� (tradecode(oid) : ".$noti[tradecode].") ".$qry;
		write_file($body, "a+");
		return false;	// DBó���� ���� ��� ��ȯ
	}
	else
	{
		if("CBR" == $noti[msgtype])		//������� �Ա��뺸�� ���� ó��
		{
			@$MySQL->query("UPDATE trade_goods SET sday2 =now(),status=1 WHERE tradecode='".$noti[tradecode]."'");
			@$MySQL->query("UPDATE trade SET sday2 =now(),status=1 WHERE tradecode='".$noti[tradecode]."'");
		}

		return true;
	}
}

function write_failure($noti){
	global $MySQL;

	$qry_pre = "INSERT INTO GM_PG_dacom(";
	$qry_post = " VALUES(";
	reset($noti);
	while(list($key, $val) = each($noti))
	{
		$qry_pre.= $key.",";
		$qry_post.= "'".addslashes($val)."',";
	}
	$qry_pre.= "readDay";	// �ڷ�������� ��Ͽ� �ʵ� �߰�
	$qry_post.= "now()";	// �ڷ�������� : ������ ���Ž���
	$qry = $qry_pre.")".$qry_post.")";

	if( !($MySQL->query($qry)) )	// DBó�� ���� �߻���
	{
		//DB���� �Ұ��ÿ��� ���Ϸ� ���� ����Ͽ� DB �Է¿��� ������ Ȯ����� ��
		$body = "[".date("Y-m-d :h:i:s A")."] �������� (tradecode(oid) : ".$noti[tradecode].") ".$qry;
		write_file($body, "a+");

		return false;	// DBó���� ���� ��� ��ȯ
	}
	else
	{
		return true;
	}
}

function write_hasherr($noti) {
	$body = "[".date("Y-m-d :h:i:s A")."] �ؽ����� (tradecode(oid) : ".$noti[tradecode].") ";
	write_file($body, "a+");
	return true;
}

//���ϱ�� ó��
function write_file($body, $fopen_opt){
	$filename = "log.txt";
	$fp = fopen($filename, $fopen_opt);
	fwrite($fp,$body);
	fclose($fp);
}

function get_param($name){
	global $HTTP_POST_VARS, $HTTP_GET_VARS;
	if (!isset($HTTP_POST_VARS[$name]) || $HTTP_POST_VARS[$name] == "") {
		if (!isset($HTTP_GET_VARS[$name]) || $HTTP_GET_VARS[$name] == "") {
			return false;
		} else {
			return $HTTP_GET_VARS[$name];
		}
	}
	return $HTTP_POST_VARS[$name];
}
?>