<?
include "head.php";
if($editVar=="mapImg")
{
	if(!empty($mapImg_name))
	{
		$mapImgInfo=@getimagesize($mapImg);		//ȸ�� ���� �̹��� ����
		if(($mapImgInfo[2]!=1) && ($mapImgInfo[2]!=2)) MsgView("�̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
		else
		{
			$mapImgName ="shop_map_img";
			if(file_exists("../upload/$mapImgName")) unlink("../upload/$mapImgName");
			@copy($mapImg, "../upload/$mapImgName");
			unlink($mapImg);
			@$MySQL->query("update admin set useShopmap=$useShopmap");
			ReFresh("adm_use.php");
		}
	}
	else
	{
		@$MySQL->query("update admin set useShopmap=$useShopmap");
		ReFresh("adm_use.php");
	}
}
else
{
	//���κ�ȣ��å,���θ��̿���,���Ծ��,ȸ��Ұ� ����
	$content = ${$editVar};
	$content = addslashes_userfc($content);
	$qry = "update admin set ";
	$qry.= "$editVar   = '$content',";
	$qry.= $editVar."_bhtml = ".${$editVar."_bhtml"};
	if($MySQL->query($qry))
	{
		OnlyMsgView("�����Ϸ� �Ͽ����ϴ�.");
		ReFresh("adm_use.php");
	}
	else
	{
		ErrMsg($qry);
		ReFresh("adm_use.php");
	}
}
?>