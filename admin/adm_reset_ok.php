<?
include "head.php";
if ($_POST["resetmall"])
{
	if ($part=="goods" || $part=="all")
	{
		// ��ü ī�װ� ����
		$_del_qry = "select * from category";
		$_del_result = $MySQL->query($_del_qry);
		while($_del_row = mysql_fetch_array($_del_result)) 
		{
			@unlink("../upload/category/$_del_row[img1]");
			@unlink("../upload/category/$_del_row[img2]");
			@unlink("../upload/category/$_del_row[img3]");
			@unlink("../upload/category/$_del_row[img4]");
		}
		$MySQL->query("DELETE from category");

		// ��ü ��ǰ ����
		$_del_qry = "select * from goods";
		$_del_result = $MySQL->query($_del_qry);
		while($_del_row = mysql_fetch_array($_del_result))
		{
			@unlink("../upload/goods/$_del_row[img1]");
			@unlink("../upload/goods/$_del_row[img2]");
			@unlink("../upload/goods/$_del_row[img3]");
			@unlink("../upload/goods/$_del_row[img4]");
			@unlink("../upload/goods/$_del_row[img5]");
			@unlink("../upload/goods/$_del_row[img6]");
			@unlink("../upload/goods/$_del_row[img7]");
			@unlink("../upload/goods/$_del_row[img8]");
			@unlink("../upload/goods/$_del_row[detailimg1]");
			@unlink("../upload/goods/$_del_row[detailimg2]");
			@unlink("../upload/goods/$_del_row[detailimg3]");
			@unlink("../upload/goods/$_del_row[detailimg4]");
		}
		$MySQL->query("DELETE from goods");

		//��ǰ����
		$MySQL->query("DELETE from goods_comment");
		$MySQL->query("DELETE from good_board");
		$MySQL->query("DELETE from good_board_comment");

		$MySQL->query("DELETE from position");
		$MySQL->query("DELETE from compare");
		$MySQL->query("DELETE from interest");
	}
	if ($part=="board" || $part=="all")
	{
		// ��ü �Խ��� �� ����
		$result = $MySQL->query("SELECT * from bbs_data");
		while ($row = mysql_fetch_array($result))
		{
			@unlink("../upload/bbs/$row[up_file]");
			@unlink("../upload/bbs/$row[img1]");
			@unlink("../upload/bbs/$row[img2]");
		}
		$MySQL->query("DELETE from bbs_data");

		$MySQL->query("DELETE from comment");

		//�������� , ��������
		$MySQL->query("DELETE from notice");
		$MySQL->query("DELETE from poll");
	}
	if ($part=="member" || $part=="all")
	{
		$MySQL->query("DELETE from member");
		$MySQL->query("DELETE from member_withdraw");
		$MySQL->query("DELETE from point_table");
	}
	if ($part=="trade" || $part=="all")
	{
		//�ֹ�
		$MySQL->query("DELETE from trade");
		$MySQL->query("DELETE from trade_goods");
		$MySQL->query("DELETE from trade_temp");
		$MySQL->query("DELETE from cart");
		//�߰���ۺ�
		$MySQL->query("DELETE from trans_add");
	}
	if ($part=="stat" || $part=="all")
	{
		$MySQL->query("TRUNCATE TABLE GM_Counter");
	}
	if ($part=="design" || $part=="all")
	{
		// ��ü ��������������� ����
		$result = $MySQL->query("SELECT * from page");
		while ($row = mysql_fetch_array($result))
		{
			@unlink("../upload/page/$row[img]");
		}
		$MySQL->query("DELETE from page");

		$result = $MySQL->query("SELECT *from banner where position<>'topbanner'");
		while ($row = mysql_fetch_array($result))
		{
			@unlink("../upload/design/$row[img]");   //��ǰ�̹���1 ����
		}
		$MySQL->query("DELETE from banner where position<>'topbanner'");
		$MySQL->query("update design set bScrollUse='n'"); // ���� Ÿ��Ʋ�̹��� �����̵� ȿ�� ���� 
		////������
		$MySQL->query("UPDATE design SET mainBestApp=1,mainHitApp=1"); //���κ���Ʈ,��Ʈ �ڵ���ũ���ϰ�� 1�� ���� 
	}
	if ($part=="etc" || $part=="all")
	{
		$MySQL->query("DELETE from ipblock");
		$MySQL->query("DELETE from patch");
		$MySQL->query("DELETE from patchDetail");
		$MySQL->query("DELETE from userSrcEdit");
	}
	MsgViewHref("�ʱ�ȭ �Ϸ��Ͽ����ϴ�.","adm_reset.php");
	exit;
}
?>