<?
include "head.php";
$cate_row = $MySQL->fetch_array("select *from category where code='$category'");
$this_position = $cate_row[position];
$MySQL->query("delete from category where code='$category'"); //�ڽ��������� 

////////////////////////////////////////�з� ����/////////////////////////////////////////////////////
if(!empty($cate_row[img1])) @unlink("../upload/category/$cate_row[img1]");
if(!empty($cate_row[img2])) @unlink("../upload/category/$cate_row[img2]");
if(!empty($cate_row[img3])) @unlink("../upload/category/$cate_row[img3]");
if(!empty($cate_row[img4])) @unlink("../upload/category/$cate_row[img4]");

/////////////////////////////////////////��ǰ����//////////////////////////////////////////////////
$goods_del_qry = "select *from goods where category ='$category'";
$goods_del_result = $MySQL->query($goods_del_qry);
while($goods_del_row = mysql_fetch_array($goods_del_result)) //��ǰ�̹��� ����
{
	@unlink("../upload/goods/$goods_del_row[img1]");
	@unlink("../upload/goods/$goods_del_row[img2]");
	@unlink("../upload/goods/$goods_del_row[img3]");
	@unlink("../upload/goods/$goods_del_row[img4]");
	@unlink("../upload/goods/$goods_del_row[img5]");
	@unlink("../upload/goods/$goods_del_row[img6]");
	@unlink("../upload/goods/$goods_del_row[img7]");
	@unlink("../upload/goods/$goods_del_row[img8]");
	@unlink("../upload/goods/$goods_del_row[detailimg1]");
	@unlink("../upload/goods/$goods_del_row[detailimg2]");
	@unlink("../upload/goods/$goods_del_row[detailimg3]");
	@unlink("../upload/goods/$goods_del_row[detailimg4]");

	/////////// ī�װ� Ư����ġ ������ ���� �۾� ////////////
	if($MySQL->articles("SELECT *from position WHERE goodsIdx=$goods_del_row[idx]"))
	{
		$up_qry = "DELETE from position WHERE goodsIdx=$goods_del_row[idx]";
		$MySQL->query($up_qry);
	}
}
$MySQL->query("delete from goods where category = '$category'");	//��ǰ��������
$MySQL->query("update category set position=position-1 where position >$this_position");
OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
ReFresh("category_write.php");
?>