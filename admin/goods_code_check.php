<?
include "head.php";
$num = $MySQL->articles("select idx from goods where code like '%$gcode%' limit 1");
if ($num)
{
	OnlyMsgView("�̹� ��ϵ� �ڵ��Դϴ�.");
}
else OnlyMsgView("�Է� ������ �ڵ��Դϴ�.");
?>