<?
include "head.php";
include "top.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function readLoginErr()
{
	alert("�б� ������ �����ϴ�.\n\n�α��� ���ֽʽÿ�.");
}
//-->
</SCRIPT>
<table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$ALL_BGCOLOR?>">
	<tr>
		<?
		$COMMUNITY_PAGE = 1;
		include "left_menu.php";
		?>
		<td  valign="top">
			<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top">
						<table width="720" height="35" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td width="2"  bgcolor="<?=$subdesign[bc10]?>" rowspan="2"></td>
								<td width="2"  bgcolor="<?=$subdesign[bc10]?>" rowspan="2"></td>
								<td width="220" height="30" bgcolor="<?=$subdesign[bc10]?>"><img src="./upload/design/<?=$subdesign[img10]?>" ></td>
								<td width="490" height="30" bgcolor="<?=$subdesign[bc10]?>"><div align="right"> &nbsp;<font color="<?=$subdesign[tc10]?>"> <img src='image/good/icon0.gif'>&nbsp;������ġ : <a href='index.php'><font color='<?=$subdesign[tc10]?>'>HOME</font></a> &gt; Ŀ�´�Ƽ</font>&nbsp;</div></td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td valign='top' align='center'><?
								$img = "upload/design/$design[maincommunityTitleImg]";
								if($design[maincommunityTitleImg_type]==4)
								{
									//�÷���
									$img_info = @getimagesize($img);
									$swf_width = $img_info[0];
									$swf_height = $img_info[1];
									?><script language='javascript'>getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");</script><?
								}
								else
								{
									?><img src="<?=$img?>"><?
								}
								?></td>
							</tr>
							<tr>
								<td valign="top"><?=$design[community_content]?></td>
							</tr>
						</table><br>
						<? include "community_inc.php"; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php"; ?>
</div>
</body>
</html>