<?
include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
var arr=new Array();
//�亯 �߰�
function answerAdd()
{
	var form=document.pollForm;
	var addStr = form.answer_str.value;  //�߰��亯 ���ڿ�
	if(addStr =="")
	{
		alert("�亯�� �Է��� �ֽʽÿ�.");
		form.answer_str.focus();
	}
	else if(arr.length >= <?=__POLL_ANSWER_CNT?>)	//�亯 ���� ����
		alert("�亯����� <?=__POLL_ANSWER_CNT?> �� ������ �����մϴ�.");
	else
	{
		addArray(arr,addStr);		//�迭�߰�
		showAnswer();				//�亯��� ����
		form.answer_str.value ="";
		form.answer_str.focus();
	}
}
//�亯 ����
function answerDel()
{
	var form=document.pollForm;
	var returnSize=0;						//������ �迭����
	delIndex =form.answer.selectedIndex;	//���� �ε���
	returnSize=delArray(arr,delIndex);		//����
	arr=arr.slice(0,returnSize);			//������ �迭 ������ũ
	showAnswer();							//�亯 ��� ����
}
//�亯 ��� ����
function showAnswer()
{
	var form= document.pollForm;
	for ( i = form.answer.length-1 ; i > -1 ; i--)
	{
		//option ����
		form.answer.options[i].value = null; 
		form.answer.options[i] = null; 
	}
	for(i=0;i<arr.length;i++)
	{
		//option �߰�
		form.answer.options[i] = new Option(arr[i],1);
		form.answer.options[i].value = arr[i];
	}
}
//����Ű üũ
function answerChek(aEvent)
{
	var myEvent = aEvent ? aEvent : window.event;
	if(myEvent.keyCode==13) answerAdd();
}
//�������� ����
function pollSendit()
{
	var form=document.pollForm;
	if(form.title.value=="")
	{
		alert("������ �Է��� �ֽʽÿ�.");
		form.title.focus();
	}
	else if(arr.length < 2)
	{
		alert("�� �̻��� �亯�� �Է��� �ֽʽÿ�.");
		form.answer_str.focus();
	}
	else
	{
		form.answer_string.value= arr.join("����");
		form.submit();
	}
}
//-->
</SCRIPT>
<body bgcolor="#FFFFFF" text="#5A595A" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include "top_menu.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><?
	$__TOP_MENU = "news";     //���� �Ҹ޴� ���� ����
	include "left_menu.php";
	$now = date("Y-m-d",time());
	$now_arr = explode("-",$now);
	?>
		<td width="85%" valign="top" height="400">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height='5'></td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td rowspan="3" width="200"><img src="image/notice_tit.gif"></td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#E6E6E6" height='26'><div align='right'><font class='text1'>SHOP �⺻������ �����ϽǼ� �ֽ��ϴ�.&nbsp;</div></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
							<tr>
								<td width='440'><img src="image/poll_write.gif"></td>
							</tr>
							<tr>
								<td width='1' bgcolor='dadada' colspan='3'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<form name="pollForm" method="post" action="poll_ok.php" enctype="multipart/form-data" >
						<input type="hidden" name="answer_string"><!-- �亯 ���ڿ� ex)�������ƴϿ�������Ÿ -->
						<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr valign="middle">
								<td width="103" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</div></td>
								<td width="447" height="25">
									<table width="432" border="0" align="center">
										<tr>
											<td width="30" bgcolor="#F6F6F6"> <div align="center">�⵵</div></td>
											<td width="50"> <select class="box" name="syday"><?
											for($i=$now_arr[0];$i<$now_arr[0]+5;$i++)
											{
												?><option value="<?=$i?>"><?=$i?></option><?
											}
											?></select></td>
											<td width="24" bgcolor="#F6F6F6"> <div align="center">��</div></td>
											<td width="40"> <select class="box" name="smday"><?
											for($i=1;$i<13;$i++)
											{
												if($i<10) $i="0".$i;
												?><option value="<?=$i?>"><?=$i?></option><?
											}
											?></select></td>
											<td width="24" bgcolor="#F6F6F6"> <div align="center">��</div></td>
											<td width="40"> <select class="box" name="sdday"><?
											for($i=1;$i<32;$i++)
											{
												if($i<10) $i="0".$i;
												?><option value="<?=$i?>"><?=$i?></option><?
											}
											?></select></td>
											<td>&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="103" height="25" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ������</div></td>
								<td width="447" height="25">
									<table width="432" border="0" align="center">
										<tr>
											<td width="30" bgcolor="#F6F6F6"> <div align="center">�⵵</div></td>
											<td width="50"> <select class="box" name="eyday"><?
											for($i=$now_arr[0];$i<$now_arr[0]+5;$i++)
											{
												?><option value="<?=$i?>"><?=$i?></option><?
											}
											?></select></td>
											<td width="24" bgcolor="#F6F6F6"> <div align="center">��</div></td>
											<td width="40"> <select class="box" name="emday"><?
											for($i=1;$i<13;$i++)
											{
												if($i<10) $i="0".$i;
												?><option value="<?=$i?>"><?=$i?></option><?
											}
											?></select></td>
											<td width="24" bgcolor="#F6F6F6"> <div align="center">��</div></td>
											<td width="40"> <select class="box" name="edday"><?
											for($i=1;$i<32;$i++)
											{
												if($i<10) $i="0".$i;
												?><option value="<?=$i?>"><?=$i?></option><?
											}
											?></select></td>
											<td>&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr valign="middle">
								<td width="103" height="30" bgcolor="#FAFAFA"> <div align="left">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</div></td>
								<td width="447" height="30"> &nbsp;&nbsp; <select name="gubun" class="box"><option value="">����ü</option><option value="M">ȸ��,��ȸ��</option><option value="D">�ŷ�ó</option></select></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="103" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �� ��</td>
								<td width="447" height="25"> &nbsp;&nbsp; <input class="box"name="title" type="text" id="sday" size="50"></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="103" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �亯���</td>
								<td width="447" height="25"> &nbsp;&nbsp; <select name="answer" size="10"  style="width:310;" ondblclick="javascript:answerDel();"></select> <a href="javascript:answerDel();"><img src="image/good_position_delete.gif" border="0"></a></td>
							</tr>
							<tr>
								<td width="103" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �亯�߰�</td>
								<td width="447" height="25"> &nbsp;&nbsp; <input class="box"name="answer_str" type="text" id="AnswerAdd" size="50" onkeypress="answerChek(event)"> <a href="javascript:answerAdd();"><img src="image/poll_add.gif" width="41" height="23" border="0"></a> </td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="103" height="25" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> ��������</td>
								<td width="447" height="25"> &nbsp;&nbsp;&nbsp; <select class="box" name="bPlu"><?
								for($i=1;$i<11;$i++)
								{
									?><option value="<?=$i?>"><?=$i?></option><?
								}
								?></select></td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td width="103" bgcolor="#FAFAFA">&nbsp;&nbsp;<img src="image/icon.gif" width="11" height="11"> �亯 ������</td>
								<td height="25"> &nbsp;&nbsp;&nbsp; <select class="box" name="reCan"><option selected value="1">ȸ��, ��ȸ��</option><option value="2">ȸ������</option></select>&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" height="1" background="image/line_bg1.gif"></td>
							</tr>
							<tr>
								<td colspan="2" height="30">
									<table width="100" border="0" align="center">
										<tr>
											<td width="70"><a href="javascript:pollSendit();"><img src="image/entry_btn.gif" width="57" height="17" border="0"></a></td>
											<td width="20">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
						</table></form><!-- pollForm --><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include "copy.php";?>
</body>
</html>