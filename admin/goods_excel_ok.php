<?
include "head.php";
if(!empty($csv_file_name))
{
	$csv_file_info=explode(".",$csv_file_name);
	if($csv_file_info[1]!="csv")
	{
		MsgView("csv���ϸ� ���ε� �����մϴ�.", -1);
		exit;
	}
	$csv_file_name = date("Ymd",time())."_".trim($csv_file_name);
	@move_uploaded_file($csv_file, "../upload/csv/$csv_file_name");	//���Ϻ���
	@unlink($csv_file);
}
else
{
	MsgViewHref("CSV������ �����ϴ�.","goods_excel.php");
	exit;
}
$url = "../upload/csv/$csv_file_name";
$array = file($url);
for($i=0;$i<count($array);$i++)
{
	if ($length < strlen($array[$i]))
	{
		$length = strlen($array[$i]);
	}
}
unset($array);
$error_occur = false;
$row = 1;
$error_row = 0;
$handle = fopen($url, "r");
while(($data = fgetcsv($handle, $length, ",")) !== FALSE)
{
	if($row == 1)	//������� ����
	{
		$row++;
	}
	elseif($row>1 && $data[1]!="")	//������� �� Null ���� ����(��ǰ�� �ʼ��Է��̹Ƿ�)
	{
		if(!$data[0]) $this_code = date("YmdHis").getmicrotime();
		else $this_code = $data[0];
		if(!$data[30]) $writeday = date("Y-m-d",time());
		else $writeday = $data[30];

		$qry = "INSERT INTO goods SET ";
		$qry.="code='".addslashes($this_code)."',";				//��ǰ�ڵ�
		$qry.="name='".addslashes($data[1])."',";				//��ǰ��
		$qry.="price='".addslashes($data[2])."',";				//�ǸŰ�
		$qry.="bOldPrice='".addslashes($data[3])."',";			//���߰� ��뿩��
		$qry.="oldPrice='".addslashes($data[4])."',";			//���߰�
		$qry.="point='".addslashes($data[5])."',";				//������
		$qry.="bCompany='".addslashes($data[6])."',";			//����/�Ǹſ� ��뿩��
		$qry.="company='".addslashes($data[7])."',";			//����/�Ǹſ�
		$qry.="bOrigin='".addslashes($data[8])."',";			//������ ��뿩��
		$qry.="origin='".addslashes($data[9])."',";				//������
		$qry.="bLimit='".addslashes($data[10])."',";			//������� ����
		$qry.="limitCnt='".addslashes($data[11])."',";			//������
		$qry.="bHit='".addslashes($data[12])."',";				//HIT �̹��� ��뿩��
		$qry.="bNew='".addslashes($data[13])."',";				//NEW �̹��� ��뿩��
		$qry.="bEtc='".addslashes($data[14])."',";				//��Ÿ �̹��� ��뿩��
		$qry.="partName1='".addslashes($data[15])."',";			//��ǰ�ɼ�1
		$qry.="partName2='".addslashes($data[16])."',";			//��ǰ�ɼ�2
		$qry.="partName3='".addslashes($data[17])."',";			//��ǰ�ɼ�3
		$qry.="strPart1='".addslashes($data[18])."',";			//��ǰ�ɼ� ���ڿ�1
		$qry.="strPart2='".addslashes($data[19])."',";			//��ǰ�ɼ� ���ڿ�2
		$qry.="strPart3='".addslashes($data[20])."',";			//��ǰ�ɼ� ���ڿ�3
		$qry.="img1='".addslashes($data[21])."',";				//�����̹���
		$qry.="img2='".addslashes($data[22])."',";				//ū�̹���
		$qry.="img3='".addslashes($data[23])."',";				//Ȯ���̹���[1]
		$qry.="img4='".addslashes($data[24])."',";				//Ȯ���̹���[2]
		$qry.="img5='".addslashes($data[25])."',";				//Ȯ���̹���[3]
		$qry.="img6='".addslashes($data[26])."',";				//Ȯ���̹���[4]
		$qry.="img7='".addslashes($data[27])."',";				//Ȯ���̹���[5]
		$qry.="img8='".addslashes($data[28])."',";				//Ȯ���̹���[6]
		$qry.="content='".addslashes($data[29])."',";			//��ǰ������
		$qry.="writeday='".addslashes($writeday)."',";			//��ǰ��ϳ�¥
		$qry.="readCnt='".addslashes($data[31])."',";			//��ǰ��ȸ��
		$qry.="setVal='".addslashes($data[32])."',";			//��ǰ��������
		$qry.="category='".addslashes($data[33])."',";			//ī�װ��ڵ�
		$qry.="detailimg1='".addslashes($data[34])."',";		//���̹���1
		$qry.="detailimg2='".addslashes($data[35])."',";		//���̹���2
		$qry.="detailimg3='".addslashes($data[36])."',";		//���̹���3
		$qry.="detailimg4='".addslashes($data[37])."',";		//���̹���4
		$qry.="margin='".addslashes($data[38])."',";			//��ǰ����
		$qry.="supplyprice='".addslashes($data[39])."',";		//���ް�
		$qry.="meta_str='".addslashes($data[40])."',";			//�˻�Ű����
		$qry.="chango='".addslashes($data[41])."',";			//â����/����������
		$qry.="quality='".addslashes($data[42])."',";			//��ǰ���ɼ���
		$qry.="model='".addslashes($data[43])."',";				//�𵨸�
		$qry.="trans_content=''";								//��۰��� ���� : ���鹮�ڿ� �Է����� �ʱ�ȭ

		if ($MySQL->query($qry))
		{
			$row++;		//������ �Է°� ī��Ʈ ����
			echo $row." | ".$this_code."<br>";
		}
		else
		{
			echo "�������� �߻�!!! �������� ������ �ùٸ��� Ȯ�� �ٶ��ϴ�<BR> : $qry <BR>";
			$error_occur = true;
			$error_row++;
		}
	}//if
}//while
fclose($handle);

if($error_occur)
{
	echo $error_row." ���� �Է� ������ �߻��Ͽ����ϴ�.<p>";
	echo "<a href='goods_excel.php'>������� �������� �̵��ϱ�</a>";
}
else
{
	MsgViewHref(($row-2)." �� �Ϸ��Ͽ����ϴ�.","goods_excel.php");
}
?>