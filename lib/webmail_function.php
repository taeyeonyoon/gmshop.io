<?
$__WEBMAIL_VERSION = "ver GoodMorningMail 1.0";

define(__LIST_MBOX,		1);		//����������
define(__SEND_MBOX,		2);		//����������
define(__TEMP_MBOX,		3);		//�ӽ�������
define(__RECYCLE_MBOX,	4);		//������

define(__MAIL_DEL,		1);		//�������� ���� ����
define(__NOT_MAIL_DEL,	0);		//�������� ���� �̻���

//�̸��� ���� �Լ�
function EmailPickUp($str)
{
	ereg('[_a-zA-z0-9\-]+(\.[_a-zA-z0-9\-]+)*\@' . '[_a-zA-z0-9\-]+(\.[a-zA-z]{1,3})+',$str,$reg);
	return $reg[0];
}

//pop3 ������ ���� ���� ���� ����
function GetPop3($badmin,$session_id,$server,$user,$pass,$mbox,$bdel,$err)
{
	global $MySQL;
	//��������
	$fp = @fsockopen($server, 110, &$errno, &$errstr);
	@set_socket_blocking($fp, 1);
	if(!$fp)
	{
		$err = "-ERR pop3 ���� �ּҰ� �ùٸ��� �ʽ��ϴ�. : $server $errstr";
		return false;
	}

	//���������� �޼��� �޾ƿ���
	$buf=fgets($fp,255);
	if(substr($buf,0,1) != '+')
	{
		$err = "-ERR pop3 ������ ���� �� �� �����ϴ�. : $server";
		return false;
	}

	//���̵� �Է�
	fputs($fp,"user $user\n");
	$buf = fgets($fp,255);

	//��й�ȣ �Է�
	fputs($fp,"pass $pass\n");
	$buf = fgets($fp,255);
	if(substr($buf,0,1) != '+')
	{
		$err = "-ERR ���̵� �Ǵ� ��й�ȣ�� �ùٸ��� �ʽ��ϴ�. : $server";
		return false;
	}

	//���ϸ�� ��������
	fputs($fp,"list\n");
	$buf = fgets($fp,255);
	
	$msg = 0;

	// 'list' �������� ����� �������� ����� ��� ������ ���� �޼��� ������
	// ���Ϲ�ȣ�� ���Ͽ뷮 ���� ���, '.' �̸� �Ϸ�
	//
	// +OK Mailbox scan listing follows
	// 1 1494
	// 2 2976
	// .

	while(substr($buf,0,1) != '.')
	{
		$buf = fgets($fp,255);

		if(substr($buf,0,1) != '.')
		{
			//�������� ������ ��ȣ�� �뷮 ����
			list($mail_num[$msg],$mail_size[$msg]) = split(" ",$buf); 
			$mail_num[$msg] = (int)($mail_num[$msg]);
			$msg++;
		}
	}

	// 'retr' �������� ������� �������� ������
	// mail class �� �ش� ���� �м��� ����Ÿ���̽��� ���� - ������� ������ ����Ÿ���̽��� ����.
	// ���� : ���Ϻ��� ������� �����ϰ� �Ǹ� ����Ÿ���̽� �뷮�� �����ϰ� ����� �� �ֱ� ������.
	// ���Ͽ����� './eml' ������ ���� ���� - ���� ���Ϻ��⿡�� �ٽ� ����ϱ� ����...

	if($msg > 0) 
	{
		for($j=0; $j < $msg; $j++)
		{
			fputs($fp,"retr $mail_num[$j]\n");
			$buffer=fgets($fp,255);
		
			if(substr($buffer,0,1) == '+')
			{
				global $dbp;
				$MailObj = new CMail;
				$MailObj -> InitMail($fp,$badmin);

				//���Űź� ���� ���� üũ
				$from_mail = EmailPickUp($MailObj ->Mail_From);

				if($badmin)
				{
					$_reject_qry = "SELECT idx FROM webmail_reject WHERE badmin=$badmin and rej_email='$from_mail'";
				}
				else
				{
					$_reject_qry = "SELECT idx FROM webmail_reject WHERE userid='$session_id' and rej_email='$from_mail'";
				}
				$MySQL->query($_reject_qry);
				if($MySQL->is_affected())
				{
					$MailObj -> MFileDelete();
				}
				else
				{
					$MailObj -> DBinput($badmin,$session_id,$mbox);
				}
			}
		}

		//$bdel ==1 �̸� �������� ���� ������ ��� ����
		if($bdel)
		{
			for($j=0; $j < $msg; $j++)
			{
				fputs($fp,"dele $mail_num[$j]\n");
				$buf=fgets($fp,255);
			}
		}
	}
	
	//�������� ����
	fputs($fp,"quit\n");
	fclose($fp);

	return true;
}


//pop3 ���� üũ�ϱ�
function CheckPop3($server,$user,$pass,$err)
{
	//��������
	$fp = @fsockopen($server, 110, &$errno, &$errstr);
	@set_socket_blocking($fp, 1);
	if(!$fp)
	{
		$err = "-ERR pop3 ���� �ּҰ� �ùٸ��� �ʽ��ϴ�. : $server";
		return false;
	}

	//���������� �޼��� �޾ƿ���
	$buf = fgets($fp,255);
	if(substr($buf,0,1) != '+')
	{
		$err = "-ERR pop3 ������ ���� �� �� �����ϴ�. : $server";
		return false;
	}

	//���̵� �Է�
	fputs($fp,"user $user\n");
	$buf = fgets($fp,255);

	//��й�ȣ �Է�
	fputs($fp,"pass $pass\n");
	$buf = fgets($fp,255);
	if(substr($buf,0,1) != '+')
	{
		$err = "-ERR ���̵� �Ǵ� ��й�ȣ�� �ùٸ��� �ʽ��ϴ�. : $server";
		return false;
	}

	//�������� ����
	fputs($fp,"quit\n");
	fclose($fp);

	return true;
}

//pop3 ���� ���� üũ�ϱ�
function SimpleCheckPop3($server,$err)
{
	//��������
	$fp = @fsockopen($server, 110, &$errno, &$errstr);
	@set_socket_blocking($fp, 1);
	if(!$fp)
	{
		$err = "-ERR pop3 ���� �ּҰ� �ùٸ��� �ʽ��ϴ�. : $server";
		return false;
	}

	//���������� �޼��� �޾ƿ���
	$buf = fgets($fp,255);
	if(substr($buf,0,1) != '+')
	{
		$err = "-ERR pop3 ������ ���� �� �� �����ϴ�. : $server";
		return false;
	}

	//�������� ����
	fputs($fp,"quit\n");
	fclose($fp);

	return true;
}

//smtp ���� üũ�ϱ�
function CheckSmtp($server,$err)
{
	$CheckSmtp_RETURN = chr(13).chr(10);	// \r\n
	$fp = @fsockopen($server,25,&$errno, &$errstr, 30);
	if(!$fp)
	{
		$err = "-ERR smtp ���� �ּҰ� �ùٸ��� �ʽ��ϴ�. : $server";
		return false;
	}
	set_socket_blocking($fp,1);
	$smtp_msg = fgets($fp,255);

	fputs($fp,"QUIT$CheckSmtp_RETURN");
	$smtp_msg = fgets($fp,255);

	fclose($fp);

	return true;
}