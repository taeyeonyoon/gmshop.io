<?
session_start();
include "./lib/config.php";
include "./lib/function.php";
?>
<form name="boardForm" method="post" action="board_edit.php">
<input type="hidden" name="data" value="<?=$data?>">
<input type="hidden" name="boardIndex" value="<?=$boardIndex?>">
</form>
<?
/*------------------------�Խ��� ��й�ȣ üũ ---------------------------------*/
$dataArr = Decode64($data);
$bbs_row = $MySQL->fetch_array("select *from bbs_data where idx=$dataArr[idx]");
if($pwd!=$bbs_row[pwd])
{
	OnlyMsgView("��й�ȣ�� �ùٸ��� �ʽ��ϴ�.");
	ReFresh("board_view.php?data=$data&boardIndex=$boardIndex");
	exit;
}
else
{
	if($del)
	{
		if($MySQL->query("delete from bbs_data where idx=$dataArr[idx]"))
		{
			if(!empty($bbs_row[up_file])) @unlink("./upload/bbs/$bbs_row[up_file]"); //���ϻ���
			//������ ����
			$MySQL->query("DELETE from comment where boardidx=$dataArr[idx]"); 
			OnlyMsgView("���� �Ϸ��Ͽ����ϴ�.");
			ReFresh("board_list.php?boardIndex=$boardIndex");
		}
		else
		{
			echo"delete Err. ";
		}
	}
	else if($edit)
	{
		echo "<script language='javascript'>
		function Auto_Submit()
		{
			document.boardForm.submit();
		}
		</script>
		<body onload='Auto_Submit()'></body>";
	}
}
?>