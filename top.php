<?
if ($design[bUnder])
{
	if ($GOOD_SHOP_ADMIN_USERID) ///////// �����ڰ� �������� ���� ������ ������ ���� 
	{
		if ($__THIS_PAGE_NAME=="index.php")
		{
			OnlyMsgView("�����ڸ�忡�� ���������� ��ư�� Ŭ���Ͽ� ������ ������ �����̶� �����ȭ���� ���� �ֽ��ϴ�.");
		}
	}
	else
	{
		$today=date("Y-m-d");
		if($design[startday] <=$today && $design[endday] >= $today)
		{
			Refresh("under.php");
			exit;
		}
	}
}

function Get_Logo()	// ��� �ΰ� ����ϱ�
{
	global $design;
	$img = "./upload/design/$design[mainLogoImg]";
	if($design[mainLogoImg_type]==4)
	{
		$img_info = @getimagesize($img);
		$swf_width = $img_info[0];
		$swf_height = $img_info[1];
		return "<script language='javascript'>getFlash(\"".$img."\", \"".$swf_width."\", \"".$swf_height."\");</script>";
	}
	else
	{
		return "<a href=\"index.php\"><img src=\"$img\"  border=\"1\"></a>";
	}
}

function Get_Common()	// ��� ���� �޴� ����ϱ�
{
	global $design;
	$r.="<table width=\"200\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	if($_SESSION[GOOD_SHOP_PART]!="member")
	{
		$r.="	<tr>";
		$r.="		<td><a href=\"member_article.php\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image211','','./upload/design/$design[mainMenuImg2]',1)\"><img name=\"Image211\" src=\"./upload/design/$design[mainMenuImg1]\" border=\"0\"></a></td>";
		$r.="		<td><a href=\"javascript:login();\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image311','','./upload/design/$design[mainMenuImg4]',1)\"><img name=\"Image311\" src=\"./upload/design/$design[mainMenuImg3]\" border=\"0\"></a></td>";
		$r.="		<td><a href=\"javascript:mypageLoginChek();\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image411','','upload/design/$design[mainMenuImg8]',1)\"><img name=\"Image411\" src=\"upload/design/$design[mainMenuImg7]\" border=\"0\"></a></td>";
		$r.="		<td><a href=\"cart.php\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image511','','upload/design/$design[mainMenuImg10]',1)\"><img name=\"Image511\" src=\"upload/design/$design[mainMenuImg9]\" border=\"0\"></a></td>";
		$r.="		<td><a href=\"order_refer.php\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image611','','upload/design/$design[mainMenuImg12]',1)\"><img name=\"Image611\" src=\"upload/design/$design[mainMenuImg11]\" border=\"0\"></a></td>";
		$r.="	</tr>";
	}
	else
	{
		$r.="	<tr>";
		$r.="		<td>&nbsp;</td>";
		$r.="		<td><a href=\"login_ok.php?del=1\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image1311','','upload/design/$design[mainMenuImg6]',1)\"><img name=\"Image1311\" src=\"upload/design/$design[mainMenuImg5]\" border=\"0\"></a></td>";
		$r.="		<td><a href=\"mypage_member.php\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image1411','','upload/design/$design[mainMenuImg8]',1)\"><img name=\"Image1411\" src=\"upload/design/$design[mainMenuImg7]\" border=0 ></a></td>";
		$r.="		<td><a href=\"cart.php\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image1511','','upload/design/$design[mainMenuImg10]',1)\"><img name=\"Image1511\" src=\"upload/design/$design[mainMenuImg9]\" border=\"0\" ></a></td>";
		$r.="		<td><a href=\"mypage_order.php\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('Image1611','','upload/design/$design[mainMenuImg12]',1)\"><img name=\"Image1611\" src=\"upload/design/$design[mainMenuImg11]\" border=\"0\" ></a></td>";
		$r.="	</tr>";
	}
	$r.="</table>";
	return $r;
}

function Get_LoginBox()	// ��� �α����� ����ϱ�
{
	global $design,$MySQL, $admin_row;
	if ($_SESSION["GOOD_SHOP_PART"]=="member" )
	{
		$m_row = $MySQL->fetch_array("SELECT point from member WHERE userid='$_SESSION[GOOD_SHOP_USERID]' limit 1");
		$m_point = PriceFormat($m_row[point]);
		$NAME = $_SESSION["GOOD_SHOP_NAME"];
		$r.="<table align='left' width='50%' cellpadding='0' cellspacing='0' border='0' height='27'>";
		$r.="	<tr>";
		$r.="		<td><a href='mypage_member.php'><font color='FF4800'><b>$NAME</b></font></a> ��";
		if ($admin_row[bUsepoint]==1)
		{
			$r.="&nbsp;<img src='image/index/point.gif' align='absmiddle'><a href='mypage_point.php'>������: <font color='A68901'><b>$m_point point</b></font></a> ";
		}
		$r.="		</td>";
		$r.="	</tr>";
		$r.="</table>";
	}
	else if ($design[bLoginShow]=="n" && $_SESSION["GOOD_SHOP_PART"]!="member")
	{
		$r.="<form name='loginmainForm' method='post' action='login_ok.php'>";
		$r.="<table align='left' width='40%' cellpadding='0' cellspacing='0' border='0' height='27'>";
		$r.="	<tr>";
		$r.="		<td style='padding:0 0 0 10'><img src='upload/design/$design[LoginIdBtn]'></td>";
		$r.="		<td width=75><input autocomplete='off' class='text_l' type='text' name='userid' size='10' ";
		if (__DEMOPAGE) $r.="value='test'";
		$r.="></td>";
		$r.="		<td class=\"font11\"><div align=\"center\"><img style=\"cursor:pointer\" src=\"upload/design/$design[LoginPwBtn]\"></div></td>";
		$r.="		<td width=80><input autocomplete=\"off\" class=\"text_l\" type=\"password\" name=\"pwd\" size=\"10\" ";
		if (__DEMOPAGE) $r.="value='1111' ";
		$r.="onKeyDown=\"javascript:left_loginChek(event);\"></td>";
		$r.="		<td><img style=\"cursor:pointer\" onclick=\"left_login_check();\" src=\"upload/design/$design[LoginBtn]\" border=\"0\" align=\"absmiddle\"></td>";
		$r.="	</tr>";
		$r.="</table></form>";
	}
	return $r;
}

function Get_Online()	// ���ã�� ����ϱ�
{
	global $design,$MySQL,$admin_row;

	$r.="<table align='right' border='0' cellpadding='0' cellspacing='0'>";
	$r.="	<tr>";
	$shopTitle = str_replace("\"","",$admin_row[shopTitle]);
	$r.="		<td><a href='#' onclick=\"{window.external.AddFavorite('http://$admin_row[shopUrl]','$shopTitle')}\"><img src='./upload/design/$design[mainFavorite]' border='0'></a></td>";
	$r.="	</tr>";
	$r.="</table>";
	return $r;
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//�������� ����
function noticeView(Idx,App,Width,Height,bPopup)
{
	// �������� �⺻Ʋ �����Ҷ�
	if(App=="n")
	{
		var popup_height =Height+40;
		var popup_width	 =Width+20;
		window.open("notice_view_html.php?bcook=no&idx="+Idx,"","scrollbars=yes,width="+popup_width+",height="+popup_height+",top=100,left=100");
	}
	else
	{
		window.open("notice_view_text.php?bcook=no&idx="+Idx,"","scrollbars=yes,width=520,height=470,top=100,left=100");
	}
}

//��ǥ�ϱ� 
//Status	last:������ ��ǥ  now:����������
//pPlu		1:��������Ұ�  2~10:�������䰡�ɰ���
//reCan		1:ȸ��,��ȸ��		2:ȸ����
function pollWrite(Status,bPlu,reCan)
{
	var form=document.pollForm;
	var voteArr = new Array();	//��ǥ�迭
	var loginCheck ="<?=$GOOD_SHOP_PART?>";	//�α��� üũ
	if(Status=="last") alert("�Ⱓ�� ����� �������� �Դϴ�.");
	else
	{
		if(reCan==2 && loginCheck!="member")
		{
			alert("ȸ���� �������� �Դϴ�. ȸ�� �α����� ���ֽʽÿ�.");
		}
		else
		{
			var bVote = false;
			var voteCnt =0;	//��ǥ��
			for(i=0;i<form.vote.length;i++)
			{
				if(form.vote[i].checked)
				{
					bVote=true;
					voteArr[i]=1;	//����
					voteCnt++;	//���ü� ����
				}
				else
				{
					voteArr[i]=0;	//����
				}
			}
			if(bVote)
			{
				if(voteCnt >bPlu)
				{
					//�������� �ʰ�
					alert(bPlu+"���� ���������� ������ �������� �Դϴ�.");
				}
				else
				{
					form.voteArrstr.value = voteArr.join("|");
					winP = window.open("","Window","width=320,height=372,top=200,left=400,status,scrollbars");
					form.target="Window";
					form.submit();
					winP.focus();
				}
			}
			else
			{
				alert("��ǥ�� ���� �����̽��ϴ�.");
			}
		}
	}
}

//��ǥ ����
function pollErr()
{
	alert("�̹� ��ǥ �ϼ̽��ϴ�.");
}

//�������� ��� ����
function viewPoll(Data)
{
	window.open("poll_new.php?data="+Data,"","width=320,height=372,top=200,left=400,status,scrollbars");
}

//�α��� üũ
function mypageLoginChek()
{
	<?
	if($GOOD_SHOP_PART =="member")	// ȸ��
	{
		?>
	location.href="mypage_member.php";<?
	}
	else	//��ȸ��
	{
		?>
	alert("ȸ�� �޴��Դϴ�.\n\n�α��� �� �ֽʽÿ�.");
	document.mypage.submit();<?
	}
	?>
}

function login()
{
	document.a.submit();
}

<? if ($design_goods[bSubMiddleBanner]){ ?>
var speed = "<?=$design_goods[scrollspeed]?>";
var k=1
var pre=0
function verscroll()
{
	if (xx.layer111.style.pixelLeft >= 1000) xx.layer111.style.pixelLeft = -500;
	if (xx.layer111.style.pixelLeft <= -1000) xx.layer111.style.pixelLeft = 500;
	xx.layer111.style.pixelLeft = xx.layer111.style.pixelLeft + k;
	setTimeout("verscroll(k)",speed);
}
function ss()
{
	verscroll();
}
function chg(x)
{
	k = x;
}
function stop()
{
	pre = k;
	chg(0)
}
function start()
{
	chg(pre)
}
<? } ?>

function left_login_check()
{
	var form=document.loginmainForm;
	if(form.userid.value=="")
	{
		alert("���̵� �Է��� �ֽʽÿ�.");
		form.userid.focus();
	}
	else if(form.pwd.value=="")
	{
		alert("��й�ȣ�� �Է��� �ֽʽÿ�.");
		form.pwd.focus();
	}
	else
	{
		form.submit();
	}
}

function left_loginChek(aEvent)
{
	var myEvent = aEvent ? aEvent : window.event;
	if(myEvent.keyCode==13) left_login_check();
}

function searchId(Part)
{
	window.open("id_loss.php?part="+Part,"","scrollbars=no,width=330,height=240,top=200,left=200");
}

<?
if ($design[today_view]=="y")
{
	// ���ú���ǰ ���̾����
	?>
var arr_TodayImg = new Array();	// �̹����ּ� �迭 
var arr_TodayGoodsIdx = new Array();	// ��ǰDB idx �迭 
var current_today = 0;	// �̹������ٿ��� ���� ù�̹��� �迭���Ұ�
	<?
	$today=date("Y-m-d"); 
	$today_result = $MySQL->query("SELECT *from today_view WHERE userid='$GOOD_SHOP_USERID' and left(writeday,10)='$today' order by idx desc");
	$cnt=0;
	while ($today_row = mysql_fetch_array($today_result))
	{
		if (is_file("./upload/goods/".$today_row[img1]))
		{
			?>
arr_TodayImg[<?=$cnt?>] = "<?=urlencode($today_row[img1])?>";
arr_TodayGoodsIdx[<?=$cnt?>] = "<?=$today_row[goodsIdx]?>";<?
			$cnt++;
		}
	}
}
?>

function imgUp()	// ���ú���ǰ 5�� �ʰ��϶� �̹��� ��ĭ �ø���
{
	if (arr_TodayImg.length<6)
	{
		// alert("���ú���ǰ�� 5���� ������ �۵���.");
	}
	else if (current_today>0)
	{
		current_today--;
		var next=0;
		for (var i=0; i<5; i++)
		{
			next = current_today + i;
			var obj = eval("document.todayimg"+i);
			obj.src = "upload/goods/"+ arr_TodayImg[next];
			var obj2 = eval("document.all.href"+i);		
			obj2.href = "goods_detail.php?goodsIdx="+arr_TodayGoodsIdx[next]; 
		}
	}
}

function imgDown()	// ���ú���ǰ 5�� �ʰ��϶� �̹��� ��ĭ ������
{
	if (arr_TodayImg.length<6)
	{
		// alert("���ú���ǰ�� 5���� ������ �۵���.");
	}
	else if ((arr_TodayImg.length - current_today) > 5 )
	{
		current_today++;
		var next=0;
		for (var i=0; i<5; i++)
		{
			next = current_today + i;
			var obj = eval("document.todayimg"+i);
			obj.src = "upload/goods/"+ arr_TodayImg[next];
			var obj2 = eval("document.all.href"+i);
			obj2.href = "goods_detail.php?goodsIdx="+arr_TodayGoodsIdx[next];
		}
	}
}

var main_width = (screen.width - 900)/2;
//-->
</SCRIPT>
<style type="text/css">
#main_layer {width:900px; text-align:left}
#main_layer #top_layer, #main_layer #left_layer, #main_layer #center_layer, #main_layer #bottom_layer {float:left}
#main_layer #top_layer {width:900px}
#main_layer #left_layer {width:180px}
#main_layer #center_layer {width:720px}
#main_layer #bottom_layer {width:900px}
</style>
<body style="background-repeat:repeat-x;" background='image/index/body_bg.gif' text="#636363" topmargin='0' leftmargin='0' <?= !$admin_row[bMouseRB]?"oncontextmenu='return false' onselectstart='return false' ondragstart='return false'":"";?> <?= $modOnload?>>
<div align="<?=$__SITE_ALIGN?>">
<!-- �Ϲ����� �α��ι�ư Ŭ���� -->
<form name="a" method="post" action="login.php"></form>
<!-- mypage �α��� üũ�� referer�� ����-->
<form name="mypage" method="post" action="login.php">
<input type="hidden" name="referer" value="http://<?=$admin_row[shopUrl]?>/mypage_member.php">
</form>
<form name="underForm" method="post" action="under.php"></form>
<table width='900' border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><?
		if ($design[bwinguse]=="y")
		{
			// ���� ������� ������ġ ��� (���� ū �̹����� �����ȼ���ŭ �������� �� �̵��Ѵ�)
			$absolute_left_start = 0 - $design[wing_width];
			$lay_height = 105;
			if ($design[topSkin]==2)
			{
				// ��� ���̾ƿ� 2�� ���� ���ΰ� ���� ����������
				$lay_height = $lay_height + 35;
			}
			?><font style="position:relative;"><div id="divMenu2" style="position:absolute; top: <?=$lay_height?>px; left: <?=$absolute_left_start?>px">
			<table border="0" cellspacing='0' cellpadding='0'><?
			$left_ban_qry = "select * from banner where position ='left_wing' order by idx asc";
			$left_ban_result = @$MySQL->query($left_ban_qry);
			$left_ban_cnt =0;
			while($left_ban_row = mysql_fetch_array($left_ban_result))
			{
				?>
				<tr><?
				if($left_ban_row[gubun]==0)
				{
					if ($left_ban_row[siteTarget] == "_blank") $http = "http://";
					else $http = "";
					?>
					<td><a href='<?=$http?><?=$left_ban_row[siteUrl]?>' target="<?=$left_ban_row[siteTarget]?>"><img src='./upload/design/<?=$left_ban_row[img]?>' border="0"></a></td><?
				}
				else if($left_ban_row[gubun]==1)
				{
					?>
					<td><a href="goods_detail.php?goodsIdx=<?=$left_ban_row[goodsUrl]?>"><img src="./upload/design/<?=$left_ban_row[img]?>"></td><?
				}
				else
				{
					?>
					<td><img src='./upload/design/<?=$left_ban_row[img]?>' border="0"></td><?
				}
				?>
				</tr><?
			}
			?>
			</table></div>
			<!--------------------- ���� ���� ���� -------------------><?
			$absolute_right_start = 900;
			?>
			<div id="divMenu1" style="position:absolute; top: <?=$lay_height?>px; left: <?=$absolute_right_start?>px; width:50"><?
			if ($design[today_view]=="y")
			{
				// ���ú���ǰ ���̾����
				?>
			<table width="45" border="0" cellspacing='0' cellpadding='0'>
				<tr>
					<td><a href="cart.php"><img src='image/index/right_cart_t.gif' border='0'></a></td>
				</tr>
				<tr>
					<td background='image/index/right_cart_bg.gif' align='center'>
						<table width='40' border='0' cellspacing='0' cellpadding='0'>
							<tr>
								<td bgcolor='5f8f0f' align='center'><font class='stext' color='ffffff'><b><?=$MySQL->articles("SELECT idx from cart WHERE userid='$_SESSION[GOOD_SHOP_USERID]'")?></b></font></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><img src='image/index/right_cart_b.gif'></td>
				</tr>
			</table>
			<table width="45" border="0" cellspacing='0' cellpadding='0'>
				<tr>
					<td height='3'></td>
				</tr>
			</table>
			<table width="45" border="0" cellspacing='0' cellpadding='0'>
				<tr>
					<td><img src='image/index/right_good_t.gif' border='0'></td>
				</tr>
				<tr>
					<td background='image/index/right_good_bg.gif' align='center'>
						<table width='40' border='0' cellspacing='0' cellpadding='0'>
							<tr>
								<td bgcolor='4296b5' align='center'><font class='stext' color='ffffff'><b><?
								$today_result = $MySQL->query("SELECT img1 from today_view WHERE userid='$_SESSION[GOOD_SHOP_USERID]' and left(writeday,10)='$today'");
								while ($today_row = mysql_fetch_array($today_result))
								{
									if (file_exists("./upload/goods/".$today_row[img1])) $today_cnt++;
								}
								?><?=$today_cnt?$today_cnt:0?></b></font></td>
							</tr>
							<tr>
								<td height='2'></td>
							</tr>
							<tr>
								<td><a href="#;" onclick="imgUp()"><img src='image/index/right_prev.gif' border='0' alt='����'></a></td>
							</tr><?
							$today = date("Y-m-d",time());
							$today_result = $MySQL->query("SELECT * from today_view WHERE userid='$_SESSION[GOOD_SHOP_USERID]' and left(writeday,10)='$today' order by idx desc limit 5");
							$today_cnt = 0;
							while ($today_row = mysql_fetch_array($today_result))
							{
								if (file_exists("./upload/goods/".$today_row[img1]))
								{
									?>
							<tr align="center">
								<td height="42"><a id="href<?=$today_cnt?>" href="goods_detail.php?goodsIdx=<?=$today_row[goodsIdx]?>"><img name="todayimg<?=$today_cnt?>" src="upload/goods/<?=urlencode($today_row[img1])?>" width="40" height="40"></a></td>
							</tr><?
								$today_cnt++;
								}
							}
							?>
							<tr>
								<td><a href="#;" onclick="imgDown()"><img src='image/index/right_next.gif' border='0' alt='����'></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><img src='image/index/right_good_b.gif'></td>
				</tr>
				<tr>
					<td align='center'><a href='#top'><img src='image/index/right_top.gif' border='0' alt='����'></a></td>
				</tr>
			</table><?
			}
			else
			{
				?>
			<table border="0" bgColor="ffffff" cellspacing='0' cellpadding='0'><?
				$left_ban_qry = "select *from banner where position ='right_wing' order by idx asc";
				$left_ban_result = @$MySQL->query($left_ban_qry) or die("Err. : $left_ban_qry");
				$left_ban_cnt =0;
				while($left_ban_row = mysql_fetch_array($left_ban_result))
				{
					?>
				<tr><?
					if($left_ban_row[gubun]==0)
					{
						if ($left_ban_row[siteTarget] == "_blank") $http = "http://";
						else $http = "";
						?>
					<td><a href='<?=$http?><?=$left_ban_row[siteUrl]?>' target="<?=$left_ban_row[siteTarget]?>"><img src='./upload/design/<?=$left_ban_row[img]?>' border="0"></a></td><?
					}
					else if($left_ban_row[gubun]==1)
					{
						?>
					<td><a href="goods_detail.php?goodsIdx=<?=$left_ban_row[goodsUrl]?>"><img src="./upload/design/<?=$left_ban_row[img]?>"></td><?
					}
					else
					{
						?>
					<td><img src='./upload/design/<?=$left_ban_row[img]?>' border="0"></td><?
					}
					?>
				</tr><?
				}//while
				?>
			</table><?
			}
			?></div></font>
			<script language=javascript>
			<!-- 
			// �¿��� ���� ���ʸ� ���� ��ũ��Ʈ
			var bNetscape4plus = (navigator.appName == "Netscape" && navigator.appVersion.substring(0,1) >= "4");
			var bExplorer4plus = (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.substring(0,1) >= "4");
			function CheckUIElements()
			{
				var yMenuFrom, yMenuTo, yButtonFrom, yButtonTo, yOffset, timeoutNextCheck;
 				if ( bNetscape4plus )
				{
					yMenuTo     = window.pageYOffset + 0;
				}
				else if ( bExplorer4plus )
				{
					yMenuTo     = document.body.scrollTop + <?=$lay_height?>;
				}
				yMenuFrom   = parseInt(document.getElementById("divMenu1").style.top, 10);
				yMenuFrom2   = parseInt(document.getElementById("divMenu2").style.top, 10);
				timeoutNextCheck = 500;

				if ( yMenuFrom != yMenuTo )
				{
					yOffset = Math.ceil( Math.abs( yMenuTo - yMenuFrom ) / 20 );
					if ( yMenuTo < yMenuFrom ) yOffset = -yOffset;
					if ( bNetscape4plus ) document.getElementById("divMenu1").top += yOffset;
					else if ( bExplorer4plus )
					{
						document.getElementById("divMenu1").style.top = parseInt (document.getElementById("divMenu1").style.top, 10) + yOffset;
						document.getElementById("divMenu2").style.top = parseInt (document.getElementById("divMenu2").style.top, 10) + yOffset;
					}
					timeoutNextCheck = 10;
				}
				setTimeout ("CheckUIElements()", timeoutNextCheck);
			}
			
			function OnLoad()
			{
				var y;
				if ( top.frames.length )
				{
					if ( bNetscape4plus )
					{
						document.getElementById("divMenu1").top = top.pageYOffset + 145;
						document.getElementById("divMenu1").visibility = "visible";
					}
					else if ( bExplorer4plus)
					{
						document.getElementById("divMenu1").style.top = document.body.scrollTop + 145;
						document.getElementById("divMenu1").style.visibility = "visible";
					}
				}
				CheckUIElements();
				return true;
			}
			OnLoad();
			//-->
			</script><?
		}
		if ($design[topSkin]==1)	// TOP ���̾ƿ� 1�� ����
		{
			?>
			<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="180" align="center"><?= Get_Logo() ?></td>
					<td width="720" valign="top">
						<table width="720" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="right"><?= Get_Common() ?></td>
								<td height="20"></td>
							</tr>
							<tr>
								<td colspan='2' valign='bottom'>
									<?= Get_LoginBox() ?>
									<?= Get_Online() ?>
								</td>
							</tr><?
							if ($design[bmainTopMenu]==1)
							{
								// ��ܸ޴� ����
								?>
							<tr>
								<td colspan='2' valign='bottom'>
									<table border="0" cellspacing="0" cellpadding="0">
										<tr><?
										$ban_qry = "select * from banner where position ='topbanner' order by idx asc";
										$ban_result = $MySQL->query($ban_qry);
										while($ban_row = mysql_fetch_array($ban_result))
										{
											$img = "./upload/design/$ban_row[img]";
											$img_info = getimagesize($img);
											$swf_width = $img_info[0];
											$swf_height = $img_info[1];
											if($ban_row[type]==4)
											{
												//�÷���
												?>
											<td valign='top'>
												<script language='javascript'>
													getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
												</script>
											</td><?
											}
											else
											{
												?>
											<td><a href="<?=$ban_row[siteUrl]?>" target="<?=$ban_row[siteTarget]?>"><img src="<?=$img?>" border=0></a></td><?
											}
										}
										?></tr>
									</table>
								</td>
							</tr><?
							}
							?>
						</table>
					</td>
				</tr>
			</table><?
		}
		else if ($design[topSkin]==2)	// TOP ���̾ƿ� 2�� ����
		{
			?>
			<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<table width="900" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="180" align="center"><?= Get_Logo() ?></td>
								<td width="720" valign="top">
									<table width="720" border="0" cellspacing="0" cellpadding="0" align='right' height='70'>
										<tr>
											<td width="100%" align="right"><?= Get_Common() ?></td>
										</tr>
										<tr>
											<td valign="bottom" colspan='2' style='padding:0 0 5 0'>
												<table width='100%' border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td><?= Get_LoginBox() ?></td>
														<td><?= Get_Online() ?></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr><?
				if ($design[bmainTopMenu]==1)
				{
					// ��ܸ޴� ����
					?>
				<tr>
					<td valign='middle'>
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
							<?
							$ban_qry = "select * from banner where position ='topbanner' order by idx asc";
							$ban_result = $MySQL->query($ban_qry);
							while($ban_row = mysql_fetch_array($ban_result))
							{
								$img = "./upload/design/$ban_row[img]";
								$img_info = getimagesize($img);
								$swf_width = $img_info[0];
								$swf_height = $img_info[1];
								if($ban_row[type]==4)
								{
									?>
								<td valign='top'>
									<script language='javascript'>
										getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
									</script>
								</td><?
								}
								else
								{
									?>
								<td><a href="<?=$ban_row[siteUrl]?>" target="<?=$ban_row[siteTarget]?>"><img src="<?=$img?>"  border=0></a></td><?
								}
							}
							?></tr>
						</table>
					</td>
				</tr><?
				}
				?>
			</table><?
		}
		?><!--------------- ��üī�װ����� & ��ǰ�˻��� ------------>
			<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
							<tr>
								<td width='180'>
									<table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
										<tr>
											<td><img src="image/btn_anotherStoreGo.gif" border="0" onclick="MM_showHideLayers('Layer_cate','','show');" style="cursor:pointer"></td>
										</tr>
										<tr>
											<td style='padding:0 0 0 5'><div style="position:relative;" onMouseOver="MM_showHideLayers('Layer_cate','','show');" onMouseOut="MM_showHideLayers('Layer_cate','','hide');">
												<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" id="Layer_cate" style="position:absolute; top:0px; width:132px; height:120px; z-index:1; visibility: hidden; filter:alpha(opacity=85);border:1px;border-style:solid;border-color:#ffffff"><?
												$result = $MySQL->query("SELECT idx,name from category WHERE bHide<>'1' order by position asc");
												while ($row = mysql_fetch_array($result))
												{
													?>
													<tr>
														<td width='1' bgcolor='cccccc'></td>
														<td style='padding:3 0 3 15;'><a href="goods_list.php?Index=<?=$row[idx]?>"><font class='stext' color="#363636"><?=$row[name]?></font></a></td>
														<td width='1' bgcolor='cccccc'></td>
													</tr><?
												}
												?>
													<tr>
														<td colspan='3' bgcolor='cccccc' height='1'></td>
													</tr>
												</table></div>
											</td>
										</tr>
									</table>
								</td>
								<td width="630">
									<form name="topGoodsSearchForm" method="get" action="search_result.php">
									<table width="350" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right"><img align="absmiddle" src="upload/design/<?=$design[mainGoodsSearchTitle]?>"></td>
											<td width='100' align="center"><select name="search" class="box"><option value="name">��ǰ��</option><option value="price">����</option><option value="company">������</option><option value="model">�𵨸�</option></select></td>
											<td><input type="text" name="searchstring" size="25" class="text_l"></td>
											<td width=32 align="right"><a href="javascript:goodsSearchSendit(document.topGoodsSearchForm);"><img align="absmiddle" src="upload/design/<?=$design[mainGoodsSearchButton]?>" border="0"></a></td>
											<td width=68 align="right"><a href="detail_search.php"><img align="absmiddle" src="upload/design/<?=$design[mainGoodsSearchButton2]?>" border="0"></a></td>
										</tr>
									</table></form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td> 
	</tr>
</table>