<?
// �ҽ��������
// 20060714_1 �ҽ����� ��ȣ�� (��� ���α׷� �������� ���� �ҽ� ����)
define(__INCLUDE_FUNCTION_PHP, "TRUE");
define(__POLL_ANSWER_CNT, 10);				//�������� �亯 ����
if(!defined(__ONLY_NUM))					//�����Է�üũ ��ũ��Ʈ
{
	define(__ONLY_NUM, "onKeyup=\"if(!Number(this.value) && this.value && this.value!='0'){ alert('���ڸ� �־��ּ���'); this.select(); this.focus(); return false; }\"");
}

$HAND_STR = "hand";			//�ڵ��� ������ payMethod ��  2006. 1. 24
$ALL_BGCOLOR = "#ffffff";

//������
$G = "����";

//�ֹ����� �迭			0			1		2			3			4		5
$TRADE_ARR = array("�ֹ�����","����Ȯ��","�߼ۿϷ�","����Ϸ�","�ֹ����","��ǰó��");

//����������
$__THIS_PAGE_NAME = array_pop(explode("/", $PHP_SELF));

//����������
$__PRE_PAGE_NAME = array_pop(explode("/", $HTTP_REFERER));

//�����迭
$AREA_ARR = array("����","��õ","���","����","�泲","���","����","���","�泲","����","����","�뱸","���","�λ�","����","����");

//���� �̹��� �迭
$AREA_ARR_MAP = array("graph_local_seoul","graph_local_inchun","graph_local_kyungi","graph_local_kang","graph_local_chungnam","graph_local_chungbuk","graph_local_deajun","graph_local_kyungbuk","graph_local_kyungnam","graph_local_junbuk","graph_local_junnam","graph_local_deagu","graph_local_woolsan","graph_local_busan","graph_local_kyungju","graph_local_jeju");

//�÷� �迭
$COLOR_ARR = array("","red","orangered","orange","gold","yellow","yellowgreen","green","teal","darkcyan","skyblue","blue","mediumblue","blueviolet","purple","deeppink","fuchsia","black");

//ȸ�������� �׸�� �迭
$JOIN_FORM_ARR = array("ȸ�����̵�","��й�ȣ","��й�ȣ Ȯ��","�� ��","�̸���","�ֹε�Ϲ�ȣ","��ȭ��ȣ","�޴�����ȣ","�ּ�","--���� ���--","���ϸ�����","SMS����","�������","��ȥ�����");

//ȸ�������� �ʼ� �ʱ�ȭ �迭 (1:�ʼ�  0:����)
$JOIN_FORM_ARR_DEFAULT = array("1","1","1","1","0","0","0","0","0","0","0","0","0","0");

$SUB_ARR = array("��ǰ���","��ǰ������","�̿���","ȸ������","����������","��ٱ���","�ֹ��ۼ�ȭ��","","1:1����","�Խ���","ȸ��Ұ�","�̿�ȳ�","���κ�ȣ��å","���޾ȳ�","�󼼰˻�","��������","����ȭ��","�α���");

//���� �迭
$WEEK_ARR = array("��","��","ȭ","��","��","��","��");

$ADMIN_MENU_ARR = array("adm.php","trade_order.php","total_goods_list.php","category_manage.php","member_list.php","design.php","sale_status.php","log.php","page_add.php","notice_list.php","bbs_admin_list.php","ask.php","sms.php","admmail_main.php");
$menu_str_arr = array("�⺻����","�ֹ�����","��ǰ����","ī�װ�","ȸ������","������","�������","�������","���������������","��������","�Խ���","1:1����","SMS����","�����ڸ���");

$HAN_JA_ARR = array("��","��","��","��","��","��","��","��","��","��","��","��","��","��","��Ÿ");
$HAN_ARR = array("��","��","��","��","��","��","��","��","��","��","ī","Ÿ","��","��");

$MBOX_NAME = array("","����������","����������","�ӽ�������","������");

//������ �ϴ� ����
$BOTTOM_HTML="<div align='center'><font color='#666666'>Copyright �� $admin_row[comName] All Rights Reserved Anyquestions to <a href='mailto:$admin_row[adminEmail]'><U>$admin_row[adminEmail]</U></a> <br>�����ŷ� ����ȸ���� ������ ǥ�ؾ���� ����մϴ�. <br>����Ǹž��Ű� �� $admin_row[esailNum] ȣ <br>����ڵ�Ϲ�ȣ : $admin_row[comNum] ��ǥ�� $admin_row[comCeo] <br>Tel : $admin_row[comTel], Fax : $admin_row[comFax]<br>�ּ� : $admin_row[comAdr] </font></div>";

//����Ʈ ������ ��ũ�ּҷ� ����
function PostToLink($array)
{
	if(is_array($array))
	{
		foreach($array as $key => $value)
		{
			$link_str.= $key."=".$value."&";
		}
		return Laststrcut($link_str);
	}
	else
	{
		return 0;
	}
}

//53200 ������ ���ڰ��� �ѱ� ������õ�̹������ ����
function PriceToHan($price)
{
	$key_arr = Array();
	$key_arr[0] = "";
	$key_arr[1] = "��";
	$key_arr[2] = "��";
	$key_arr[3] = "õ";

	$position_arr = Array();
	$position_arr[0] = "��";
	$position_arr[4] = "��";
	$position_arr[8] = "��";

	$num_arr = Array();
	$num_arr[0] = "";
	$num_arr[1] = "��";
	$num_arr[2] = "��";
	$num_arr[3] = "��";
	$num_arr[4] = "��";
	$num_arr[5] = "��";
	$num_arr[6] = "��";
	$num_arr[7] = "ĥ";
	$num_arr[8] = "��";
	$num_arr[9] = "��";
	$totalM_len = strlen($price);
	$totalM_arr = Array();

	for($i=0; $i<$totalM_len; $i++)
	{
		$totalM_arr[(($totalM_len-1)-$i)] = substr($price,$i,1);
	}

	for($i=0; $i<count($totalM_arr); $i++)
	{
		$number = $totalM_arr[$i];			//1~0 ���� ����
		$number_str = $num_arr[$number];	//�� ~ �� ���ڷ� ����
		//if($i != (count($totalM_arr)-1) && $number_str=="��") $number_str="";

		if($number != 0) $key_str = $key_arr[($i%4)];	//��,��,��,õ �ڸ��� ���� (���̴� ���̴� ������ 4���� ����)
		else $key_str = "";

		if($i>=4 && $i<=7 && $totalM_arr[4]==0 && $totalM_arr[5]==0 && $totalM_arr[6]==0 && $totalM_arr[7]==0)
		{
			//'��'�� ���� �Ҷ��� �ִ� (��,�ʸ�,�鸸,õ���� ��� 0�϶�) (��: 1������� 1�︸���� �ƴ�)
		}
		else
		{
			$position_str = $position_arr[$i];			//���� (��,��,��)
		}
		
		if($key_arr[$i]=="��" && $number_str=="��") $number_str = "";

		$total_str = $number_str.$key_str.$position_str.$total_str;
		//echo $totalM_arr[$i]." ".$number_str." ".$key_str." ".$position_str."<br>";
	}

	return $total_str;
}

function addslashes_userfc($str)
{
	if(!get_magic_quotes_gpc())		//PHP�� magic_quotes �ɼ��� Off �϶�
	{
		return addslashes($str);
	}
	else
	{
		return $str;
	}
}

// NEW ������  �����ڰ� å���� �Ⱓ���� ������ ǥ��, �������� ǥ�þ���
function limitday($day, $new_day)
{
	$predate = mktime(0,0,0, date('m'), date('d'), date('Y'));
	$strtime = substr(str_replace("-","",$day),0,8);
	$strtime = strtotime($strtime);
	$diff_time = $predate - $strtime;
	$limit_time = 86400 * $new_day;
	if($diff_time < $limit_time) $bNew ="<img src=upload/goods_new_img>";
	else $bNew ="";

	return $bNew;
}

// ���ڿ��� ���� ������ 1���� �ڸ���
function Laststrcut($str)
{
	$str = substr($str, 0, strlen($str)-1);

	return $str;
}

// �˻��� ��� ���������� ��� upper�����Ͽ� �˻��� ������
function SearchCheck($str)
{
	$str_len = strlen($str);
	$new_str = "";
	$one_str = "";

	for($i=0; $i<$str_len; $i++)
	{
		$one_str = (substr($str, $i, 1));
		if(ord($one_str) > 64 && ord($one_str) < 123) $new_str.= strtoupper($one_str);
		else $new_str.= $one_str;
	}

	return $new_str;
}

function getmicrotime()
{
	list($usec, $sec) = explode(" ", microtime());

	return (int)($usec*1000);
}

// Get ��� ���� ��ȣȭ �Լ�
function Encode64($data)
{
	return user_urlencode(($data));
}

function user_urlencode($str)
{
	return urlencode($str);
}

function user_urldecode($str)
{
	return urldecode($str);
}

// Get������� �Ѿ�� ������ Decode�ϴ� �Լ�
function Decode64($sending_data)
{
	$sending_data = user_urldecode($sending_data);
	$vars = explode("&",(str_replace("||","",$sending_data)));
	$vars_num = count($vars);
	for($i=0; $i<$vars_num; $i++)
	{
		$elements = explode("=",$vars[$i]);
		$var[$elements[0]] = $elements[1];
	}

	return $var;
}

//���¹� ǥ�� �Լ�
function Status($status)
{
	echo " onMouseOver=\"javascript:window.status='$status';return true;\"";
}

// ����â �ݰ� �θ�â ��������
function close_par_refresh()
{
	echo "<script>self.close(); opener.location.reload();</script>";
}

// �ڹٽ�ũ��Ʈ �޽��� ��� �Լ�
function MsgView($Msg, $go)
{
	echo "
		<script language='javascript'>
			alert(\"$Msg\");
			history.go($go);
		</script>
		";

		return true;
}

function OnlyMsgView($Msg)
{
	echo "
		<script language='javascript'>
			alert(\"$Msg\");
		</script>
		";
}

function MsgViewHref($Msg, $href)
{
	echo "
		<script language='javascript'>
			alert('$Msg');
			location.href='$href';
		</script>
		";

		return true;
}

function MsgViewClose($Msg)
{
	echo "
		<script language='javascript'>
			alert('$Msg');
			window.close();
		</script>
		";
}

function ErrMsg($Msg)
{
	$Msg = addslashes($Msg);
	$Msg = "Err. \\n\\n".$Msg;
	echo"
		<script language='javascript'>
			alert(\"$Msg\");
		</script>
		";
}

//$n ���� ���ڿ��� '...' ���̱� �Լ� �Լ�
function StringCut($string, $n)		//$n : Cutting String Number
{
	if($n%2)
		$n++;
	$len = strlen($string);		//string length
	if($len<$n)
	{
		return $string;
	}
	else
	{
		$OneNextN = $n + 1;
		$newstring = substr($string, 0, $n);
		$total = 0;
		for($i=0; $i<$n; $i++)
		{
			$asc = ord(substr($string, $i, 1));
			if($asc>128)
				$total++;
		}

		if($total%2)
		{
			$newstring = substr($string, 0, $OneNextN);
		}

		$newstring.= "...";

		return $newstring;
	}
}

//���� ��� �Լ�
// 1234566 -> 1,234,567
function PriceFormat($price)
{
	return number_format($price, 0);
}

function ReFresh($href)
{
	echo "<meta http-equiv='Refresh' content='0; URL=$href'>";
}

//����ð��� Ư���� ������ �Ⱓ
function BetweenPeriod($datetime, $periodDay)
{//2003-02-19 11:32:15
	$now = time();
	$timeArr = explode(":",substr($datetime,11,8));
	$dayArr = explode("-",substr($datetime,0,10));

	$mktime = mktime($timeArr[0],$timeArr[1],$timeArr[2],$dayArr[1],$dayArr[2],$dayArr[0]);
	$period = $periodDay*24*60*60;		//�Ⱓ���

	if($now >$mktime && $now < ($mktime+$period))
		return 1;
	elseif( ($mktime-$period) <$now && $now <$mktime )
		return -1;
	else
		return 0;
}

//��ǰȮ���̹����� ���͸�ũ ������
function mergePix($sourcefile_id, $insertfile_id, $targetfile, $pos, $transition=100, $srcimg_type, $wmimg_type)
{
	//Get the resource id��s of the pictures

	//Get the sizes of both pix
	$sourcefile_width = imageSX($sourcefile_id);
	$sourcefile_height = imageSY($sourcefile_id);
	$insertfile_width = imageSX($insertfile_id);
	$insertfile_height = imageSY($insertfile_id);

	//middle
	if( $pos == 0 )
	{
		$dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
		$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
	}

	//top left
	if( $pos == 1 )
	{
		$dest_x = 0;
		$dest_y = 0;
	}

	//top right
	if( $pos == 2 )
	{
		$dest_x = $sourcefile_width - $insertfile_width;
		$dest_y = 0;
	}

	//bottom right
	if( $pos == 3 )
	{
		$dest_x = $sourcefile_width - $insertfile_width;
		$dest_y = $sourcefile_height - $insertfile_height;
	}

	//bottom left
	if( $pos == 4 )
	{
		$dest_x = 0;
		$dest_y = $sourcefile_height - $insertfile_height;
	}

	//top middle
	if( $pos == 5 )
	{
		$dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
		$dest_y = 0;
	}

	//middle right
	if( $pos == 6 )
	{
		$dest_x = $sourcefile_width - $insertfile_width;
		$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
	}

	//bottom middle
	if( $pos == 7 )
	{
		$dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
		$dest_y = $sourcefile_height - $insertfile_height;
	}

	//middle left
	if( $pos == 8 )
	{
		$dest_x = 0;
		$dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
	}

	//The main thing : merge the two pix
	imageCopyMerge($sourcefile_id, $insertfile_id,$dest_x,$dest_y,0,0,$insertfile_width,$insertfile_height,$transition);

	//Create a jpeg out of the modified picture
	if($srcimg_type == "jpg")
		imagejpeg($sourcefile_id,$targetfile,100);
	elseif($srcimg_type == "gif")
		imagegif($sourcefile_id,$targetfile,100);
}//function mergePix

//�߰�Ȯ���̹������� ���͸�ũ ���� �غ�
function make_wmark($img_name, $img_info)
{
	global $targetfile;
	global $wm_type;
	global $insertfile_id;
	global $home_url;
	global $admin_row;

	$src_file = $img_name;
	$targetfile = $home_url.$img_name;

	if($img_info[2]==1)
	{
		$src_type = "gif";
		$sourcefile_id = imagecreatefromgif($home_url.$src_file);
	}
	elseif($img_info[2]==2)
	{
		$src_type = "jpg";
		$sourcefile_id = imagecreatefromjpeg($home_url.$src_file);
	}

	if($wm_type)
	{
		mergePix($sourcefile_id,$insertfile_id, $targetfile, $admin_row[wm_pos],$transition=50,$src_type,$wm_type);
	}
	else
	{
		OnlyMsgView("���͸�ũ �̹����� jpg,gif �� �ƴϰų� �̹����� �����ϴ�.");
	}
}//function make_wmark

//�ش�迭���� Ư���� �ִ���
function array_search2($array, $str)
{
	foreach($array as $key => $value)
	{
		if($value==$str) $result = 1;
	}

	return $result;
}
?>