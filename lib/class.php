<?
define(__INCLUDE_CLASS_PHP, "TRUE");

if(!defined(__INCLUDE_FUNCTION_PHP)) include "function.php";

/*******************************************************************
��� (_list.php) �������� ���� class
�� 1 [2][3][4][5] ��
********************************************************************/
class CList
{
	var $g_pageName;		//�������ϸ� ex) notice_list.php, qna_list.php
	var $g_pageCnt;			//���������� ��ȣ
	var $g_offset;			//����Ÿ���̽� ���� ����Ʈ ��ȣ
	var $g_numRows;			//�ѰԽù� ��
	var $g_pageBlock;		//���� ������ �� ex) 5 : [1][2][3][4][5]
	var $g_limit;			//�������� ��� �Խù� ��
	var $g_search;			//�˻� �÷� ex)name,title,...
	var $g_searchstring;	//�˻���
	var $g_option;			//�߰� get ��  ex) &part=$part
	var $g_pniView;			//��ũ���� ���� ������ ǥ�� ���� ex) true,1 : ǥ��  false,0 : ��ǥ��
	var $g_pIcon;			//���� ������
	var $g_nIcon;			//���� ������

	// ������
	// CList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
	// CList(��������, ������������ȣ, DB����offset, �ѰԽù���, ������������, ��������Խù���, �˻��÷�, �˻���, �߰�get��)
	function CList($pagename, $pagecnt, $offset, $numrows, $pageblock, $limit, $search, $searchstring, $option)
	{
		$this->g_pageName		= $pagename;
		$this->g_pageCnt		= $pagecnt;
		$this->g_offset			= $offset;
		$this->g_numRows		= $numrows;
		$this->g_pageBlock		= $pageblock;
		$this->g_limit			= $limit;
		$this->g_search			= $search;
		$this->g_searchstring	= $searchstring;
		$this->g_option			= $option;
	}

	// ������ ����
	// putList( BOOL pniView, char* pre_icon, char* next_icon)
	// putList( ��ũ���� ���� ������ ǥ�� ����, ����������, ����������
	function putList($pniView,$pre_icon,$next_icon)
	{
		$this->g_pniView=$pniView;							//��ũ���� ���� ������ ǥ�� ����
		if(empty($pre_icon))	$this->g_pIcon="��";			//���� ������ ����
		else					$this->g_pIcon=$pre_icon;

		if(empty($next_icon))	$this->g_nIcon="��";			//���� ������ ����
		else					$this->g_nIcon=$next_icon;

		$this->pniPrint(); //ȭ�� ���
	}

	// ȭ�� ���
	function pniPrint()
	{
		/*	����	*/
		if($this->g_pageCnt>0)					//���������� ����
		{
			$prepage = $this->g_pageCnt-1;		//������ ���������� ����.
			$pre_letter_no = $this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//������ ���۱� ��ȣ ����
			$data = Encode64("pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring);

			$pre_str = "<a href='".$this->g_pageName."?data=".$data;
			if(!empty($this->g_option))
				$pre_str.= "&".$this->g_option;
			$pre_str.= "'>".$this->g_pIcon."</a>&nbsp;&nbsp;&nbsp;";

			echo "$pre_str";		//���������� ��ũ
		}
		else						//���������� ����
		{
			if($this->g_pniView)	//������ ǥ��
				$empty_pre_str = $this->g_pIcon."&nbsp;&nbsp;&nbsp;";
			else					//������ ��ǥ��
				$empty_pre_str = "&nbsp;&nbsp;&nbsp;";

			echo "$empty_pre_str";
		}

		/*	1 [2][3][4][5]	*/
		$chekpage = intval($this->g_numRows/($this->g_limit*$this->g_pageBlock));		//���������� üũ

		if($chekpage==$this->g_pageCnt)			//������ ���� ���....
		{
			$pCnt = (intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1;		//������ �� �������� ���
			if(!($this->g_numRows%($this->g_limit)))
			{
				$pCnt--;
			}
		}
		else
		{
			$pCnt = $this->g_pageBlock;
		}

		$l = 0;
		while($l<$pCnt)
		{
			$loffset = $l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//���۱� ����
			$lnum = $l + (($this->g_pageCnt)*$this->g_pageBlock) + 1;								//������ ��ȣ ����
			$cu_letter_no = $this->g_numRows-(($lnum-1)*$this->g_limit);							//���۱� ��ȣ ����
			$en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
			$en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring;
			$data = Encode64($en_str);
			if($lnum==(($this->g_offset/$this->g_limit)+1))		//���� ������ �� ���....
			{
				echo " $lnum ";
			}
			else
			{
				$mid_str = "<a href='".$this->g_pageName."?data=".$data;
				if(!empty($this->g_option))
					$mid_str.= "&".$this->g_option;
				$mid_str.= "'>[".$lnum."]</a>";

				echo "$mid_str";
			}
			$l++;
		}

		/*	����	*/
		if($this->g_pageCnt!=$chekpage)			//���������� ����
		{
			echo "&nbsp;&nbsp;&nbsp; ";
			$newpagecnt = $this->g_pageCnt+1;		//���� �� ���������� ����
			$newt = $cu_letter_no-$this->g_limit;	//���� �� ���۱� ��ȣ ����
			$data = Encode64("pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring);

			$next_str = "<a href='".$this->g_pageName."?data=".$data;
			if(!empty($this->g_option))
				$next_str.= "&".$this->g_option;
			$next_str.= "'>".$this->g_nIcon."</a>";

			echo $next_str;			//���� ������ ��ũ
		}
		else									//���������� ����
		{
			if($this->g_pniView)			//������ ǥ��
				echo "&nbsp;&nbsp;&nbsp;".$this->g_nIcon;
			else							//������ ��ǥ��
				echo "&nbsp;&nbsp;&nbsp;";
		}
	}//function pniPrint()
}//class CList

/*******************************************************************
	��ǰ ���� ���� class
********************************************************************/
class CGoodsPrice
{
	var $MySQL;
	var $G	= "����";		//������
	var $g_gPrice;			//��ǰ����
	var $g_gPoint;			//��ǰ������
	var $g_optionPriceStr;
	var $g_optionPriceName;
	var $g_gOptionLength;

	// ������
	// CGoodsPrice( char* dbp, int idx)
	// CGoodsPrice( ����Ÿ���̽� ����Ʈ, ��ǰ�Ϸù�ȣ)
	function CGoodsPrice($idx)
	{
		global $MySQL;
		$this->MySQL = $MySQL;
		global $GOOD_SHOP_PART_GUBUN;

		if($idx) $goods_row = $this->MySQL->fetch_array("SELECT * FROM goods WHERE idx=$idx");

		if($GOOD_SHOP_PART_GUBUN=="M")			//�Ϲ�ȸ��
		{
			$this->g_gPrice = $goods_row[price];
			$this->g_gPoint = $goods_row[point];
		}
		elseif($GOOD_SHOP_PART_GUBUN=="D")			//����
		{
			$this->g_gPrice = $goods_row[price];
			$this->g_gPoint = $goods_row[point];
		}
		else		//��ȸ���̸�
		{
			$this->g_gPrice = $goods_row[price];
			$this->g_gPoint = $goods_row[point];
		}
	}//function CGoodsPrice

	//��ǰ ���� ���(format)
	function PutPrice()
	{
		return PriceFormat($this->g_gPrice);
	}

	//��ǰ ���� ���
	function Price()
	{
		return $this->g_gPrice;
	}

	//��ǰ ������ ���
	function PutPoint()
	{
		return $this->g_gPoint;
	}
	function PutPoint2()
	{
		return PriceFormat($this->g_gPoint);
	}

	//�ɼǺ� ���� ���
	function PutOptionStr()
	{
		$temp_attArr = explode($this->G,$this->g_optionPriceStr);
		for($i=0; $i<count($temp_attArr); $i++)
		{
			$temp = explode("|",$temp_attArr[$i]);
			$attArr[$i][0] = $temp[0];
			$attArr[$i][1] = $temp[1];
			$attArr[$i][2] = $temp[2];
		}
		$this->g_gOptionLength = count($temp_attArr);

		return $attArr;
	}

	//
	function PutOptionLength()
	{
		return $this->g_gOptionLength;
	}
}//class CGoodsPrice
?>