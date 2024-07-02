<?
///////////////////////////////////////////////////////////////////////////////////////////
// �� �κ��� �ǵ帱 �ʿ䰡 �����ϴ�.

function spacing($text,$size) {
	for ($i=0; $i<$size; $i++) $text.=" ";
	$text = substr($text,0,$size);
	return $text;
}

function cut_char($word, $cut) {
//	$word=trim(stripslashes($word));
	$word=substr($word,0,$cut);						// �ʿ��� ���̸�ŭ ����.
	for ($k=$cut-1; $k>1; $k--) {	 
		if (ord(substr($word,$k,1))<128) break;			// �ѱ۰��� 160 �̻�.
	}
	$word=substr($word,0,$cut-($cut-$k+1)%2);
	return $word;
}

function CheckCommonType($dest, $rsvTime) {
	$dest=eregi_replace("[^0-9]","",$dest);
	if (strlen($dest)<10 || strlen($dest)>11) return "�޴��� ��ȣ�� Ʋ�Ƚ��ϴ�";
	$CID=substr($dest,0,3);
	if ( eregi("[^0-9]",$CID) || ($CID!='010' && $CID!='011' && $CID!='016' && $CID!='017' && $CID!='018' && $CID!='019') ) return "�޴��� ���ڸ� ��ȣ�� �߸��Ǿ����ϴ�";
	$rsvTime=eregi_replace("[^0-9]","",$rsvTime);
	if ($rsvTime) {
		if (!checkdate(substr($rsvTime,4,2),substr($rsvTime,6,2),substr($rsvTime,0,4))) return "���೯¥�� �߸��Ǿ����ϴ�";
		if (substr($rsvTime,8,2)>23 || substr($rsvTime,10,2)>59) return "����ð��� �߸��Ǿ����ϴ�";
	}
}

class SMS {
	var $ID;
	var $PWD;
	var $SMS_Server;
	var $port;
	var $SMS_Port;
	var $Data = array();
	var $Result = array();

	function SMS($ID,$PWD,$GUBUN) {
 
		$this->ID  =$ID;	////////////////// apl_ �� �ٿ��� �� (���÷� ������ ���)	
		$this->PWD =$PWD;		
		$this->SMS_Server="211.172.232.124";
		if($GUBUN ==1){
			$this->SMS_Port="7295";				/* ���� : 7296 / ���� : 7295 */
		}else if($GUBUN ==2){
			$this->SMS_Port="7296";				/* ���� : 7296 / ���� : 7295 */
		}
		$this->ID = spacing($this->ID,10);
		$this->PWD = spacing($this->PWD,10);
	}

	function Init() {
		$this->Data = "";
		$this->Result = "";
	}

	function Add($dest, $callBack, $Caller, $msg, $rsvTime="") { //$dest : �߼۹޴���  $callBack : �ڵ����� ������ ȸ�Ź�ȣ , $Caller : ����翡�� ���°���..���ڰ� 
		// ���� �˻� 1
		$Error = CheckCommonType($dest, $rsvTime);
		if ($Error) return $Error;
		// ���� �˻� 2
		if ( eregi("[^0-9]",$callBack) ) return "ȸ�� ��ȭ��ȣ�� �߸��Ǿ����ϴ�";
		$msg=cut_char($msg,80); // 80�� ����
		// ���� ������ �迭�� ����ֱ�
		$dest = spacing($dest,11);
		$callBack = spacing($callBack,11);
		$Caller = spacing($Caller,10);
		$rsvTime = spacing($rsvTime,12);
		$msg = spacing($msg,80);
		$this->Data[] = '01144 '.$this->ID.$this->PWD.$dest.$callBack.$Caller.$rsvTime.$msg;
		return "";
	}

	function AddURL($dest, $URL, $msg, $rsvTime="") {
		// ���� �˻� 1
		$Error = CheckCommonType($dest, $rsvTime);
		if ($Error) return $Error;
		// ���� �˻� 2
		//$URL=str_replace("http://","",$URL);
		if (strlen($URL)>50) return "URL�� 50�ڰ� �Ѿ����ϴ�";
		switch (substr($dest,0,3)) {
			case '011': //80����Ʈ
                $msg=cut_char($msg,80);
				break;
			case '016': // 80����Ʈ
				$msg=cut_char($msg,80);
				break;
			case '017': // URL ���� 80����Ʈ
				$msg=cut_char($msg,80-strlen($URL));
				break;
			case '018': // 20����Ʈ
				$msg=cut_char($msg,20);
				break;
			default:
				return "���� URL CallBack�� �������� �ʴ� ��ȣ�Դϴ�";
				break;
		}
		// ���� ������ �迭�� ����ֱ�
		$dest = spacing($dest,11);
		$URL = spacing($URL,50);
		$rsvTime = spacing($rsvTime,12);
		$msg = spacing($msg,80);
		$this->Data[] = '05173 '.$this->ID.$this->PWD.$dest.$URL.$rsvTime.$msg;
		return "";
	}

	function Send () {
		$fp=fsockopen($this->SMS_Server,$this->SMS_Port);
		if (!$fp) return false;
		set_time_limit(300);
		foreach($this->Data as $tmp => $puts) {  // PHP 4.3.10
		//foreach($this->Data as $puts) {
			$dest = substr($puts,26,11);
			
			fputs($fp,$puts);
			while(!$gets) { $gets=fgets($fp,29); }
			 
			if (substr($gets,0,19)=="0223  00".$dest) $this->Result[]=$dest.":".substr($gets,19,10);
			else $this->Result[$dest]=$dest.":Error";
			$gets="";
		}
		fclose($fp);
		$this->Data="";
		return true;
	}

}
?>
