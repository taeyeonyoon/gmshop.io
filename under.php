<?
include "./lib/config.php";
include "./lib/function.php";
if(!defined(__DESIGN_ROW))
{
	define(__DESIGN_ROW,"TRUE");
	$design=$MySQL->fetch_array("select *from design limit 0,1");
}
$startday = explode("-",$design[startday]);
$endday = explode("-",$design[endday]);
$year = $startday[0];
$month = $startday[1];
$day = $startday[2];
$year2 = $endday[0];
$month2 = $endday[1];
$day2 = $endday[2];
$startday = $year." �� ".$month." �� ".$day." �� ";
$endday = $year2." �� ".$month2." �� ".$day2." �� ";
?>
<table align=center>
	<tr>
		<td align=center><img src="upload/design/<?=$design[underImg]?>"></td>
	</tr>
	<tr>
		<td align=center><br><?=$startday?> ~ <?=$endday?></td>
	</tr>
</table>