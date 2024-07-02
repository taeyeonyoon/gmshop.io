<?
// �ҽ� ���� ����
// 20060721_1 �����߰� ��ȣ��
// 20060721_2 �ҽ����� ��ȣ��(�ƿ��迡�� �����Ϸ� �������޽� ÷������ ����)

//��������� ������ ����
function ExitWithError($err)
{
	echo "$err";
	exit();
}

function qpDecode($in)
{
	if(preg_match("/=\?(.*)\?[qQ]\?(.*)\?=/ei",$in,$regs))
		return quoted_printable_decode($regs[2]);
	else
		return $in;
}

function qpDecode2($in)
{
	$in = str_replace("=\r\n","",$in);
	$in = str_replace("=\n","",$in);

	return quoted_printable_decode($in);
}

function b64Decode($in)
{
	while(preg_match("/=\?[0-9a-zA-Z_\-]+\?[bB]\?([0-9a-zA-Z\/\+\=]+)\?=/",$in,$regs))
		$in = str_replace($regs[0],base64_decode($regs[1]),$in);

	return $in;
}

function b64Decode2($in)
{
	$in = $GLOBALS['___BASE64_TEMP___'].preg_replace("/\r|\n/","",$in);
	$a = (int) (strlen($in)/4)*4;
	$GLOBALS['___BASE64_TEMP___'] = substr($in,$a,strlen($in)-strlen($a));

	return base64_decode(substr($in,0,$a));
}

//���� ��� ������ ������ �ִ� Ŭ����
//�������Ϸ� ���� ������ ��������� ��� �������� ��� ���κ��� ��������Ʈ�� return ���ش�. - �ٵ� �κ��� ��ü ������
//�ٵ���� ������ �ٷ� ���� ���� ���ؼ�....
class CMHead
{
	var $Received		= "(null)";
	var $Sender			= "(null)";
	var $Cc				= "(null)";
	var $From			= "(null)";
	var $Subject		= "(null)";
	var $ReplyTo		= "(null)";
	var $To				= "(null)";
	var $ContentType	= "(null)";
	var $MultiPart		= 0;
	var $Alternative	= 0;
	var $Mixed			= 0;
	var $Boundary		= "(null)";
	var $MessageID		= "(null)";
	var $Date			= "(null)";
	var $ContentTransferEncoding ="(null)";
	var $MIMEVersion	= "(null)";

	function InputHeadInfo($m_filename, $badmin)
	{
		$offset = 0;

		if($badmin)
		{
			if(!file_exists("../eml/".$m_filename))
			{
				ExitWithError("���� ���� ������ ã�� �� �����ϴ�. : $m_filename");
			}
		}
		else
		{
			if(!file_exists("eml/".$m_filename))
			{
				ExitWithError("���� ���� ������ ã�� �� �����ϴ�. : $m_filename");
			}
		}

		$exit=1;
		if($badmin)
			$fp = fopen("../eml/".$m_filename,"r");
		else
			$fp = fopen("eml/".$m_filename,"r");

		while($exit)
		{
			$line = fgets($fp,255);		//�Ѷ��� �б�

			$offset += strlen($line);	//���� ������ ���� - ����� ������ ���� ���ذ���. ->����� ���ǰ��� ��

			if(preg_match("/Received: (.*)/i",$line,$regs))		//(.*) ������ �ѱ��ڰ� ���ų� Ȥ�� �ϳ� �̻�
				$this->Received = chop($regs[1]);				//chop() == rtrim() ���ڿ� �� �κ��� ������ �����մϴ�.
			if(preg_match("/Sender: (.*)/i",$line,$regs))
			{
				$this->Sender = chop($regs[1]);
				$this->Sender = qpDecode($this->Sender);
				$this->Sender = b64Decode($this->Sender);
			}
			if(preg_match("/Cc: (.*)/i",$line,$regs))
			{
				$this->Cc = chop($regs[1]);
				$this->Cc = qpDecode($this->Cc);
				$this->Cc = b64Decode($this->Cc);
			}
			if(preg_match("/From: (.*)/i",$line,$regs))
			{
				$this->From = chop($regs[1]);
				$this->From = qpDecode($this->From);
				$this->From = b64Decode($this->From);
			}
			if(preg_match("/Subject: (.*)/i",$line,$regs))
			{
				$this->Subject = chop($regs[1]);
				$this->Subject = qpDecode($this->Subject);
				$this->Subject = b64Decode($this->Subject);
				if ($this->Subject == '') $this->Subject = "(null)";
			}
			if(preg_match("/Reply-To: (.*)/i",$line,$regs))
			{
				$this->ReplyTo = chop($regs[1]);
				$this->ReplyTo = qpDecode($this->ReplyTo);
				$this->ReplyTo = b64Decode($this->ReplyTo);
			}
			if(preg_match("/To: (.*)/i",$line,$regs))
			{
				$this->To = chop($regs[1]);
				$this->To = qpDecode($this->To);
				$this->To = b64Decode($this->To);
			}
			if(preg_match("/Content-Type: (.*)/i",$line,$regs))
			{
				list($this->ContentType) = split(';',chop($regs[1]));
				if(preg_match("/multipart/i",$this->ContentType,$regs))
					$this->MultiPart = 1;
				if(preg_match("/alternative/i",$this->ContentType,$regs))
					$this->Alternative = 1;
				if(preg_match("/mixed/i",$this->ContentType,$regs))
					$this->Mixed = 1;
				if(preg_match("/related/i",$this->ContentType,$regs))
					$this->Mixed = 1;
			}
			if(preg_match("/Boundary=(.*?);/i",$line,$regs) || preg_match("/Boundary=(.*)/i",$line,$regs))
			{
				$this->Boundary = chop($regs[1]);
				$this->Boundary = str_replace('"','',trim($this->Boundary));
			}
			if(preg_match("/Message-ID: (.*)/i",$line,$regs))
				$this->MessageID  = chop($regs[1]);
			if(preg_match("/Date: (.*)/i",$line,$regs))
				$this->Date       = chop($regs[1]);
			if(preg_match("/MIME-Version: (.*)/i",$line,$regs))
				$this->MIMEVersion= chop($regs[1]);
			if(preg_match("/Content-Transfer-Encoding: (.*)/i",$line,$regs))
				$this->ContentTransferEncoding= chop($regs[1]);
			if(strlen($line) <= 2)
				$exit=0;
		}//while
		fclose($fp);

		return $offset;
	}//function InputHeadInfo
}//class CMHead


// ���Ͽ��������� .eml ���Ϸ� ���� ���,�ٵ� ������ �����´�.
// ���������� �� �� ���� ������ ���� �������� ���� ��� ���� �޼��� ����� ����
class CMailObject
{

	var $M_bAdmin = 0;
	var $M_emlFolder = "eml/";				//.eml ���� ���� ����
	var $M_filename = '';					//.eml ���ϸ� - ���Ͽ��� ����

	var $M_filepoint = 0;					//���Ͽ��� ��������Ʈ
	var $HeadObject = "";					//������� ��ü
	var $BodyNum = 0;
	var $Body = '(null)';
	var $BodyPart = 0;
	var $BodyOffset;
	var $BodyEnd;
	var $BodyContentType;
	var $BodyContentTransferEncoding;
	var $BodyContentDisposition;
	var $BodyName;
	var $BodySize;
	var $BodyFilename;
	var $ContentNum = 0;
	var $BodyContentID;
	var $BodyContentOffset;
	var $BodyCIDType;
	var $BodyCIDEncoding;
	var $BodyMultiPart;
	var $BodyAlternative;
	var $BodyMixed;
	var $Subject_continue =0;
	var $Filename_continue =0;

	function InitMailObject($m_filename,$badmin)
	{
		$this->M_filename = $m_filename;
		$this->M_bAdmin = $badmin;

		if($this->M_bAdmin)
		{
			$this->M_emlFolder = "../eml/";
		}

		if(!file_exists($this->M_emlFolder.$this->M_filename))
			ExitWithError("���� ���� ������ ã�� �� �����ϴ�. : $this->M_filename");

		$this->InitHead();					//���� ������� ��ü ����
		$this->InitBody();
	}

	function InitHead()
	{
		$this->HeadObject = new CMHead;
		//�������Ϸ� ���� ��尴ü ������ ������ �Է¹ް� ��峡�κ��� ��������Ʈ ������ �����´�.
		$this->M_filepoint = $this->HeadObject->InputHeadInfo($this->M_filename,$this->M_bAdmin);
	}

	function InitBody()
	{
		$this->BodyNum=0;
		if(!file_exists($this->M_emlFolder.$this->M_filename))
			ExitWithError("���� ���� ������ ã�� �� �����ϴ�. : $this->M_filename");

		$exit=1;
		$fp = fopen($this->M_emlFolder.$this->M_filename,"r");
		fseek($fp,$this->M_filepoint);		//������� ���κ����� ��������Ʈ �̵�

		$this->BodyOffset[$this->BodyNum] = $this->M_filepoint;
		$NotCheckContentType = 0;
		$NotCheckContentTransferEncoding = 0;
		$this->BodyBoundary[$this->BodyNum]					= "(null)";
		$this->BodyContentType[$this->BodyNum]				= "(null)";
		$this->BodyContentTransferEncoding[$this->BodyNum]	= "(null)";
		$this->BodyContentDisposition[$this->BodyNum]		= "(null)";
		$this->BodyName[$this->BodyNum]						= "(null)";
		$this->BodyFilename[$this->BodyNum]					= "(null)";
		$this->BodyContentID[$this->ContentNum]				= "(null)";
		$this->BodyContentOffset[$this->ContentNum]			= "0";
		$this->BodyMultiPart[$this->BodyNum]				= 0;
		$this->BodyAlternative[$this->BodyNum]				= 0;
		$this->BodyMixed[$this->BodyNum]					= 0;
		$this->BodySize[$this->BodyNum]						= 0;

		while($exit)
		{
			if($this->HeadObject->MultiPart &&	strstr($line,"--".$this->HeadObject->Boundary))
			{
				$this->BodyEnd[$this->BodyNum] = $this->M_filepoint;
				$this->BodyNum++;
				$this->BodyOffset[$this->BodyNum]					= $this->M_filepoint;
				$this->BodyBoundary[$this->BodyNum]					= "(null)";
				$this->BodyContentType[$this->BodyNum]				= "(null)";
				$this->BodyContentTransferEncoding[$this->BodyNum]	= "(null)";
				$this->BodyContentDisposition[$this->BodyNum]		= "(null)";
				$this->BodyName[$this->BodyNum]						= "(null)";
				$this->BodyFilename[$this->BodyNum]					= "(null)";
				$this->BodyMultiPart[$this->BodyNum]				= 0;
				$this->BodyAlternative[$this->BodyNum]				= 0;
				$this->BodyMixed[$this->BodyNum]					= 0;
				$NotCheckContentType								= 0;
				$NotCheckContentTransferEncoding					= 0;
			}

			if($this->HeadObject->MultiPart && !$NotCheckContentType && preg_match("/Content-Type: (.*)/i",$line,$regs))
			{
				list($this->BodyContentType[$this->BodyNum]) = split(';',chop($regs[1]));
				if(preg_match("/multipart/i",$this->BodyContentType[$this->BodyNum],$regs))
					$this->BodyMultiPart[$this->BodyNum] = 1;
				if(preg_match("/alternative/i",$this->BodyContentType[$this->BodyNum],$regs))
					$this->BodyAlternative[$this->BodyNum] = 1;
				if(preg_match("/mixed/i",$this->BodyContentType[$this->BodyNum],$regs))
					$this->BodyMixed[$this->BodyNum] = 1;
				if(preg_match("/related/i",$this->BodyContentType[$this->BodyNum],$regs))
					$this->BodyMixed[$this->BodyNum] = 1;
				$NotCheckContentType = 1;
			}

			if(preg_match("/Content-Type: (.*)/i",$line,$regs))
			{
				list($this->BodyCIDType[$this->ContentNum]) = split(';',chop($regs[1]));
			}

			if($this->HeadObject->MultiPart &&	preg_match("/Boundary=(.*)/i",$line,$regs))
			{
				$this->BodyBoundary[$this->BodyNum] = chop($regs[1]);
				$this->BodyBoundary[$this->BodyNum] = str_replace('"','',$this->BodyBoundary[$this->BodyNum]);
			}

			if($this->HeadObject->MultiPart && !$NotCheckContentTransferEncoding &&
					preg_match("/Content-Transfer-Encoding: (.*)/i",$line,$regs))
			{
				$this->BodyContentTransferEncoding[$this->BodyNum] = chop($regs[1]);
				$NotCheckContentTransferEncoding = 1;
			}

			if(preg_match("/Content-Transfer-Encoding: (.*)/i",$line,$regs))
			{
				$this->BodyCIDEncoding[$this->ContentNum] = chop($regs[1]);
			}

			if($this->HeadObject->MultiPart && preg_match("/Content-Disposition: (.*);/i",$line,$regs))
				$this->BodyContentDisposition[$this->BodyNum] = chop($regs[1]);

			if($this->HeadObject->MultiPart && preg_match("/name=\"(.*)\"/i",$line,$regs))
			{
				$this->BodyName[$this->BodyNum] = chop($regs[1]);
				$this->BodyName[$this->BodyNum] = qpDecode($this->BodyName[$this->BodyNum]);
				$this->BodyName[$this->BodyNum] = b64Decode($this->BodyName[$this->BodyNum]);
			}
			else if($this->HeadObject->MultiPart && preg_match("/name=\"(.*)/i",$line,$regs))
			{
				$Subject_continue = 1;
				$this->BodyName[$this->BodyNum] = chop($regs[1]);
				$this->BodyName[$this->BodyNum] = qpDecode($this->BodyName[$this->BodyNum]);
				$this->BodyName[$this->BodyNum] = b64Decode($this->BodyName[$this->BodyNum]);
			}
			else if($this->HeadObject->MultiPart && preg_match("/(.*)\"/i",$line,$regs) && $Subject_continue == 1)
			{
				$temp_str = chop($regs[1]);
				$temp_str = qpDecode($temp_str);
				$this->BodyName[$this->BodyNum].= trim(b64Decode($temp_str));
				$Subject_continue = 0;
			}
			if($this->HeadObject->MultiPart && preg_match("/filename=\"(.*)\"/i",$line,$regs))
			{
				$this->BodyFilename[$this->BodyNum] = chop($regs[1]);
				$this->BodyFilename[$this->BodyNum] = qpDecode($this->BodyFilename[$this->BodyNum]);
				$this->BodyFilename[$this->BodyNum] = b64Decode($this->BodyFilename[$this->BodyNum]);
			}
			else if($this->HeadObject->MultiPart && preg_match("/filename=\"(.*)/i",$line,$regs))
			{
				$Filename_continue = 1;
				$this->BodyFilename[$this->BodyNum] = chop($regs[1]);
				$this->BodyFilename[$this->BodyNum] = qpDecode($this->BodyFilename[$this->BodyNum]);
				$this->BodyFilename[$this->BodyNum] = b64Decode($this->BodyFilename[$this->BodyNum]);
			}
			else if($this->HeadObject->MultiPart && preg_match("/(.*)\"/i",$line,$regs) && $Filename_continue == 1)
			{
				$temp_str = chop($regs[1]);
				$temp_str = qpDecode($temp_str);
				$this->BodyFilename[$this->BodyNum].= trim(b64Decode($temp_str));
				$Filename_continue = 0;
			}

			if($this->HeadObject->MultiPart && preg_match("/Content-ID: (.*)/i",$line,$regs))
			{
				$this->BodyContentID[$this->ContentNum] = chop($regs[1]);
				$this->BodyContentOffset[$this->ContentNum] = $this->M_filepoint;
				$this->ContentNum++;
			}

			$line = fgets($fp,255);
			$this->M_filepoint += strlen($line);
			$this->BodySize[$this->BodyNum] += strlen($line);

			if(feof($fp))
			{
				$this->BodyEnd[$this->BodyNum]=$this->M_filepoint;
				if(!$this->MultiPart)
					$this->BodyNum++;
				$exit=0;
			}
		}//while($exit)
		fclose($fp);

		if(!$this->HeadObject->MultiPart && !$this->HeadObject->Alternative && !$this->HeadObject->Mixed && ($this->BodyNum <= 1))
			$this->BodyPart=0;
		if($this->HeadObject->MultiPart && !$this->HeadObject->Alternative && $this->HeadObject->Mixed && ($this->BodyNum > 1))
			$this->BodyPart=1;
		if($this->HeadObject->MultiPart && $this->HeadObject->Alternative && !$this->HeadObject->Mixed && ($this->BodyNum > 1))
			$this->BodyPart=2;
		if($this->HeadObject->MultiPart && !$this->HeadObject->Alternative && !$this->HeadObject->Mixed && ($this->BodyNum > 1))
			$this->BodyPart=1;
		if($this->HeadObject->MultiPart && $this->HeadObject->Alternative && !$this->HeadObject->Mixed && ($this->BodyNum == 3))
			$this->BodyPart=1;
	}//function InitBody

	//������ ���� ���
	//���븸 ��� - ÷�������� ���� ����Ѵ�.
	function EchoBody()
	{
		if(!file_exists($this->M_emlFolder.$this->M_filename))
				ExitWithError("���� ���� ������ ã�� �� �����ϴ�. : $this->M_filename");

		$fp = fopen($this->M_emlFolder.$this->M_filename,"r");	//���� ���� ���� �о� ����

		$offset = $this->BodyOffset[$this->BodyPart];
		fseek($fp, $offset);

		if(!$this->BodyAlternative[$this->BodyPart] && !$this->BodyMixed[$this->BodyPart])
		{
			if($this->BodyContentType[$this->BodyPart] != '(null)') 
			{
				$exit=1;
				while($exit)
				{
					$line = fgets($fp,255);
					$offset += strlen($line);
					if(strlen($line) <= 2) $exit=0;
				}
			}

			if($this->BodyNum == '1')
			{
				$this->BodyContentType[0] = $this->HeadObject->ContentType;
				$this->BodyContentTransferEncoding[0] = $this->HeadObject->ContentTransferEncoding;
			}

			$exit=1;
			while($exit)
			{
				$line = fgets($fp,255);
				$offset += strlen($line);
				if(!strstr($line,"--".$this->HeadObject->Boundary))
				{
					if(stristr($this->BodyContentTransferEncoding[$this->BodyPart], "base64"))
						$pLine = b64Decode2($line);
					elseif(stristr($this->BodyContentTransferEncoding[$this->BodyPart], "quoted"))
						$pLine = qpDecode2($line);
					else
						$pLine = $line;

					if(!preg_match("/html/i",$this->BodyContentType[$this->BodyPart],$regs))
					{
						$pLine = ereg_replace( "&nbsp;", " ", $pLine );
						$pLine = $this->txt2html($pLine);
					}

					echo $pLine;
				}
				if($offset >= $this->BodyEnd[$this->BodyPart])
					$exit=0;
			}
		}
		else
		{	// Alternative Part
			$exit = 0;
			while($exit < 2)
			{
				$line = fgets($fp,255);
				if(strstr($line,"--".$this->BodyBoundary[$this->BodyPart]))
					$exit++;
			}

			$exit = 1;
			while($exit)
			{
				$line = fgets($fp,255);
				if(preg_match("/Content-Type: (.*)/i",$line,$regs))
					list($ContentType) = split(';',chop($regs[1]));
				if(preg_match("/Content-Transfer-Encoding: (.*)/i",$line,$regs))
					$ContentTransferEncoding = chop($regs[1]);
				if(strlen($line) <= 2)
					$exit=0;
			}

			$exit = 1;
			while($exit)
			{
				$line = fgets($fp,255);
				if(!strstr($line,"--".$this->BodyBoundary[$this->BodyPart]))
				{
					if(stristr($ContentTransferEncoding, "base64"))
						$pLine = b64Decode2($line);
					elseif(stristr($ContentTransferEncoding, "quoted"))
						$pLine = qpDecode2($line);
					else
						$pLine = $line;

					$pLine = $this->cid2url($pLine);
					echo $pLine;
				}
				if(strstr($line,"--".$this->BodyBoundary[$this->BodyPart]))
					$exit=0;
			}
		}
		fclose($fp);
	}//function EchoBody

	function cid2url($in)
	{
		return eregi_replace("<BAS","<CAS",str_replace("cid:","/bin/decode_cid.php?f=".$GLOBALS["f"]."&cid=",$in));
	}

	function txt2html($in)
	{
		return nl2br(str_replace(" ","&nbsp;",htmlspecialchars($in)));
	}

	//÷�������� �ٿ�ε� �ǰԲ� ó���� �ִ� �Լ�
	function Attach($p, $filename)
	{
		if(strstr($GLOBALS['HTTP_USER_AGENT'],"MSIE"))
		{
			header("Content-type: application/octetstream");
		}
		else
		{
			header("Content-type: application/octetstream");
			header("Content-disposition: attachment; filename=\"$filename\"");
		}

		$fp = fopen($this->M_emlFolder.$this->M_filename,"r");

		fseek($fp,$this->BodyOffset[$p]);
		$exit=1;
		while($exit)
		{
			$line = fgets($fp,255);
			if(strlen($line) <= 2)
				$exit=0;
		}

		$exit=1;
		while($exit)
		{
			$line = fgets($fp,255);
			if(!strstr($line,"--".$this->HeadObject->Boundary)) 
			{
				if(stristr($this->BodyContentTransferEncoding[$p],"base64"))
				{
					$line = str_replace("\n","",$line);
					$line = str_replace("\r","",$line);
					$pLine = b64Decode2($line);
				}
				elseif(stristr($this->BodyContentTransferEncoding[$p],"quoted"))
				{
					$pLine = qpDecode2($line);
				}
				else
					$pLine = $line;
				echo $pLine;
			}

			if(strstr($line,"--".$this->HeadObject->Boundary))
				$exit=0;
		}
		fclose($fp);
	}//function Attach

	//÷������ ������� ���ϸ�� �׿����� ��ũ���� ���
	//���� ����Ʈ�� ��¸��� ���� �Լ�
	//÷������ �ٿ�ε�= $this->Attach() �̴�.
	function pAttach()
	{
		$temp=urlencode($this->M_filename);
		if(preg_match("/html/i",$this->BodyContentType[$this->BodyPart],$regs))
		{
			//echo "<BR><BR>";
		}
		else
		{
			//echo "\n\n";
		}

		for($i=$this->BodyPart+1; $i< $this->BodyNum; $i++)
		{
			if($this->BodyName[$i] != '(null)')
			{
				$attach_file_size = sprintf("%10.1fKB",$this->BodySize[$i]/1024);	//÷�����Ϻ� ������ ��� ,KB �������
				$img_file = "<img src='image/webmail/add.gif' align='absmiddle'>";
				$temp_attach .= $img_file."<a href=webmail_attach.php/".str_replace(" ","",$this->BodyName[$i])."/?f=".$temp."&p=".$i."&filename=".str_replace(" ","",($this->BodyName[$i]))." >".$this->BodyName[$i]." (".$attach_file_size.")</a>&nbsp;&nbsp;&nbsp;&nbsp;\n";
			}
		}

		return $temp_attach;
	}//function pAttach
}//class CMailObject
?>