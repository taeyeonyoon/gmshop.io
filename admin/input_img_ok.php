<?
include "head.php";
if(!empty($delIdx))
{
	$infoRow = $MySQL->fetch_array("select *from up_file where idx=$delIdx");
	@unlink("../upload/$part/$infoRow[name]");
	if($MySQL->query("delete from up_file where idx=$delIdx"))
	{
		ReFresh("input_img.php?code=$code&part=$part");
	}
	else
	{
		ErrMsg("delete query Err.");
	}
}
else
{
	$upfileInfo=@getimagesize($file);		//�������� ���� �̹��� ����
	if(($upfileInfo[2]!=1) && ($upfileInfo[2]!=2)) MsgView("�̹��� ������ gif , jpg �� �Է��� �ּ���", -1);
	else
	{
		$upfileName = $file_name;
		if(file_exists("../upload/$part/$upfileName"))
		{
			MsgView("���� �̸��� �̹����� ���� �����մϴ�. \\n\\n�ٸ� �̸����� ����� �ֽʽÿ�.\\n\\n���ϸ� : $upfileName",-1);
		}
		else
		{
			@copy($file, "../upload/$part/$upfileName");
			unlink($file);
			if($MySQL->query("insert into up_file(code,name)values('$code','$upfileName')"))
			{
				OnlyMsgView("���ε� �Ϸ� �Ͽ����ϴ�.");
				ReFresh("input_img.php?code=$code&part=$part");
			}
			else ErrMsg("insert Err.");
		}
	}
}
?>