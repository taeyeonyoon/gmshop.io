<?
// �ѱ��� ������� �ƽ�Ű���� str2uni �Լ��� ����ִ� ����
include ("hangul.php");


// ==============================================================================
// =========================  �� �׷��� �Լ� ====================================
// ==============================================================================

// $result : ���ڷ� �� �迭��
// $file_name : gif �� ���� �����̸�
// $print_name : $result ���� ���� �� '����', '��õ' �� ���� ���� => �⺻�� ����
// $imgSize : �̹��� ������	=> �⺻�� 250
function Circle_Graph($result, $file_name, $print_name="", $imgSize, $nameArr)
{
	// ����ũ��
	$circleSize = $imgSize - 50;

	// �׸��� �׸������� �̹���������� ���� �����Ѵ�.
	$myImage = ImageCreate($imgSize, $imgSize);

	$white = ImageColorAllocate($myImage, 255, 255, 255);
	$black = ImageColorAllocate($myImage, 0, 0, 0);
	$gray = ImageColorAllocate($myImage, 204, 204, 204);

	// ĥ�� ���� 20������ �̸� ���س��´�.
	$fillColor[0] = ImageColorAllocate($myImage, 255, 102, 0);		//��Ȳ  , ����
	$fillColor[3] = ImageColorAllocate($myImage, 102, 102, 204);	//�Ķ� , ���Ľ�
	$fillColor[2] = ImageColorAllocate($myImage, 255, 204, 0);		//���  , ����
	$fillColor[1] = ImageColorAllocate($myImage, 102, 204, 102);	//��� , ���̹�

	$fillColor[4] = ImageColorAllocate($myImage, 255, 102, 153);
	$fillColor[5] = ImageColorAllocate($myImage, 102, 153, 255);
	$fillColor[6] = ImageColorAllocate($myImage, 255, 204, 153);
	$fillColor[7] = ImageColorAllocate($myImage, 153, 204, 153);
	$fillColor[8] = ImageColorAllocate($myImage, 230, 56, 19);
	$fillColor[9] = ImageColorAllocate($myImage, 102, 51, 204);
	$fillColor[10] = ImageColorAllocate($myImage, 213, 213, 0);
	$fillColor[11] = ImageColorAllocate($myImage, 51, 204, 0);
	$fillColor[12] = ImageColorAllocate($myImage, 204, 51, 102);
	$fillColor[13] = ImageColorAllocate($myImage, 51, 0, 255);
	$fillColor[14] = ImageColorAllocate($myImage, 255, 204, 204);
	$fillColor[15] = ImageColorAllocate($myImage, 102, 204, 204);
	$fillColor[16] = ImageColorAllocate($myImage, 153, 153, 153);
	$fillColor[17] = ImageColorAllocate($myImage, 0, 102, 153);
	$fillColor[18] = ImageColorAllocate($myImage, 204, 102, 255);
	$fillColor[19] = ImageColorAllocate($myImage, 153, 204, 102);

	// �����Լ��� �ʱ�ȭ �Ѵ�.
	srand(time());

	// ���� �Ѿ�� �迭������ ���⼭ �̸� ���س��� ������ �迭����
	// ũ�ٸ� �����Լ��� �̿��� ������ ��ŭ ������ ������.
	if(sizeof($result)>sizeof($fillColor))
	{
		for($i=0; $i<(sizeof($result)-sizeof($fillColor)); $i++)
		{
			$fillValue1 = rand(0,255);
			$fillValue2 = rand(0,255);
			$fillValue3 = rand(0,255);

			$fillColor[20+$i] = ImageColorAllocate($myImage, $fillValue1, $fillValue2, $fillValue3);
		}
	}

	// �Ѿ�� ������ ������ ���Ѵ�.
	for($i=0; $i<sizeof($result); $i++)
	{
		$sum = $sum + $result[$i];
	}

	$AngleForDraw[-1]=0;

	// �� �迭������ �ۼ��������� �����ϴ� ���� �׸���
	// ���� ������ �׸��� ���� �������� ���Ѵ�.
	for($i=0; $i<sizeof($result); $i++)
	{
		if ($result[$i]) $percent[$i] = ($result[$i]/$sum)*100;	// ������� ���Ѵ�.
		else $percent[$i]=0;
		$Angle[$i] = $percent[$i]*3.6;			// ������ ������ ������ ���Ѵ�.
		$AngleForDraw[$i] = $Angle[$i] + $AngleForDraw[$i-1];	// ������ �׸��� ���� �׷��� ���� ������ ���Ѵ�.
	}

	// �׸��� �׸������� �ʿ��� ��ǥ���� ���Ѵ�.
	for($i=0; $i<count($Angle); $i++)
	{
		// ������ ���� ȣ�� �׸��� ���� ���
		$radians = $AngleForDraw[$i] / 57.295779513082;			// ���������� �������� ��ȯ.
		$lineLength = $imgSize/2 - 25;
		$x2[$i] = $imgSize/2 + ($lineLength * cos($radians));	// x ��ǥ���� ���Ѵ�.
		$y2[$i] = $imgSize/2 + ($lineLength * sin($radians));	// y ��ǥ���� ���Ѵ�.

		// ������ ĥ�ϰ� ���ڰ� ���� ��ǥ ���
		$fillAngle = $AngleForDraw[$i] - ($Angle[$i]/2);
		$fillradians = $fillAngle / 57.295779513082;			// ���������� �������� ��ȯ.
		$fillpoint = $imgSize/3;
		$fillx2[$i] = $imgSize/2 + ($fillpoint * cos($fillradians));	// ������ ĥ�ϰ� , ���ڰ� ������ x,y ��ǥ��
		$filly2[$i] = $imgSize/2 + ($fillpoint * sin($fillradians));
	}

	// ���� �з����� �׸���.
	// int imageline (int im, int x1, int y1, int x2, int y2, int col)
	// int imagearc (int im, int cx, int cy, int w, int h, int s, int e, int col)

	for($i=0; $i<count($Angle); $i++)
	{
		ImageLine($myImage, $imgSize/2, $imgSize/2, $x2[$i], $y2[$i], $gray);
		Imagearc($myImage, $imgSize/2, $imgSize/2, $circleSize, $circleSize, $AngleForDraw[$i-1] , $AngleForDraw[$i], $gray);
	}

	// ������ ä���.
	// int imagefill (int im, int x, int y, int col)

	for($i=0; $i<count($Angle); $i++)
	{
		ImageFill($myImage,$fillx2[$i], $filly2[$i] , $fillColor[$i]);
	}

	// ���ڸ� ������.
	for($i=0; $i<count($Angle); $i++)
	{
		$cutting = round($percent[$i], 2);		// ������ �Ҽ� 2 �ڸ�����
		$print = $print_name[$i] . " " . $result[$i] . " (" . $cutting . "%" . ")" ;	// �� ����

		// ���� �߽����� ���� �� ��ġ����
		// �ѱ��� ������ؼ��� ImageTTFText �� ����Ͽ��� �ϰ�
		// ���� ������ include �� hangul.php �� �ʿ��ϴ�.
		// �� ���Ͽ��� ���⼭ ���̴� str2uni() �Լ��� ����ִ�.
		if($filly2[$i]>($imgSize/2))
		{
			//ImageTTFText($myImage,12,0,$fillx2[$i]-40,$filly2[$i]-15,$black,"hangul.ttf",str2uni($print));
		}
		else
		{
			//ImageTTFText($myImage,12,0,$fillx2[$i]-30,$filly2[$i]+15,$black,"hangul.ttf",str2uni($print));
		}
	}

	/////////////////////////////////////////////////
	// �̹����� ����ϰ�, �̹��� �ڵ鷯�� �����Ѵ�.
	/////////////////////////////////////////////////

	// ���� �̹����� gif ���Ϸ� ������.
	Imagegif($myImage,$file_name);
	Imagedestroy($myImage);

	////// �Լ��� ����߰�  1 ~ 4 ������ �ش� �׸��̸��� ������ ��� /////
	echo "<p>";

	for($i=0; $i<count($nameArr); $i++)
	{
		$nameImage = ImageCreate(30,30);		// �߰��ҽ� , �̸� �����̹���
		$fillColor_name[0] = ImageColorAllocate($nameImage, 255, 102, 0);
		$fillColor_name[3] = ImageColorAllocate($nameImage, 102, 102, 204);
		$fillColor_name[2] = ImageColorAllocate($nameImage, 255, 204, 0);
		$fillColor_name[1] = ImageColorAllocate($nameImage, 102, 204, 102);
		//ImageFill($nameImage,0,30, $fillColor_name[$i]);
		ImageFilledRectangle($nameImage, 0,0, 30, 30, $fillColor_name[$i]);
		Imagejpeg($nameImage,"../upload/nameImage$i.jpg");
		Imagedestroy($nameImage);
		echo $nameArr[$i]." : <img src='../upload/nameImage$i.jpg'> ".$result[$i]."% &nbsp;&nbsp;&nbsp;	";
	}
	echo "</p>";
}// function End.


// ==============================================================================
// =========================  �� �׷��� �Լ� ====================================
// ==============================================================================

// data : ���� ���� ����
// data_name : ���� ���� �̸�
// file_name : �̹����� ������ ���� �̸�
// x_size : �̹��� ����ũ��
// y_size : �̹��� ����ũ��
// dot_num : �׷����� ���� ��������
// color : ���뼱�� ����, 1~20���� �������ִ�.

function Line_Graph($data, $data_name, $file_name, $x_size=400, $y_size=300, $dot_num=4, $color=15)
{
	$x_axis = $x_size - 80;		// �׷����� �׸� ������ ���Ѵ�
	$y_axis = $y_size - 60;

	for($i=0; $i<sizeof($data); $i++)
	{
		$sum += $data[$i];
	}

	$first_gap = ($x_axis/sizeof($data))/2;					// ù���밡 �׷��� ��ġ
	$print_gap = $first_gap / 5;							// ����� ������ ����
	$line_width = ($x_axis-2*$first_gap-2*$print_gap)/sizeof($data);	// ������ ��

	for($i=0; $i<sizeof($data); $i++)
	{
		$line_rate[$i] = number_format(($data[$i]/$sum)*100,1);				// ������� ����
		$line_height[$i] = number_format(($line_rate[$i]/100)*$y_axis,1);	// ������ ����
	}

	// �̹����� �����Ѵ�.
	$image = ImageCreate($x_size,$y_size);

	$white = ImageColorAllocate($image , 255,255,255);
	$gray = ImageColorAllocate($image , 227,227,227);
	$dark_gray = ImageColorAllocate($image , 190,190,190);
	$black = ImageColorAllocate($image , 0,0,0);

	// ĥ�� ���� 20������ �̸� ���س��´�.
	$fillColor[0] = ImageColorAllocate($image, 255, 102, 0);
	$fillColor[1] = ImageColorAllocate($image, 102, 102, 204);
	$fillColor[2] = ImageColorAllocate($image, 255, 204, 0);
	$fillColor[3] = ImageColorAllocate($image, 102, 204, 102);
	$fillColor[4] = ImageColorAllocate($image, 255, 102, 153);
	$fillColor[5] = ImageColorAllocate($image, 102, 153, 255);
	$fillColor[6] = ImageColorAllocate($image, 255, 204, 153);
	$fillColor[7] = ImageColorAllocate($image, 153, 204, 153);
	$fillColor[8] = ImageColorAllocate($image, 230, 56, 19);
	$fillColor[9] = ImageColorAllocate($image, 102, 51, 204);
	$fillColor[10] = ImageColorAllocate($image, 213, 213, 0);
	$fillColor[11] = ImageColorAllocate($image, 51, 204, 0);
	$fillColor[12] = ImageColorAllocate($image, 204, 51, 102);
	$fillColor[13] = ImageColorAllocate($image, 51, 0, 255);
	$fillColor[14] = ImageColorAllocate($image, 255, 204, 204);
	$fillColor[15] = ImageColorAllocate($image, 102, 204, 204);
	$fillColor[16] = ImageColorAllocate($image, 153, 153, 153);
	$fillColor[17] = ImageColorAllocate($image, 0, 102, 153);
	$fillColor[18] = ImageColorAllocate($image, 204, 102, 255);
	$fillColor[19] = ImageColorAllocate($image, 153, 204, 102);

	// �׷����� �׷��� ������ ��ȸ������ ĥ�Ѵ�
	ImageFilledRectangle($image , 60, 20, 60+$x_axis, 20+$y_axis, $gray);

	// �ܰ� �׵θ� �簢�� �ڽ�
	ImageRectangle($image , 0, 0, $x_size-1, $y_size-1, $black);

	// �׷����� �� �׸���. �β��� �׸������� ������ �ߴ´�.
	ImageLine($image, 60, 20, 60, 20+$y_axis, $black);	// Y ��
	ImageLine($image, 61, 20, 61, 20+$y_axis, $black);	// Y ��
	ImageLine($image, 60, 20+$y_axis, 60+$x_axis, 20+$y_axis, $black);	// X ��
	ImageLine($image, 60, 19+$y_axis, 60+$x_axis, 19+$y_axis, $black);	// X ��

	$dotgap = $y_axis/$dot_num;	// ������ ����
	$y_gap = 100/$dot_num;		// ������ ���� �ۼ�Ʈ

	// �������� ���� �ۼ�Ƽ���� �� ǥ��
	for($i=0; $i<$dot_num; $i++)
	{
		ImageDashedLine($image , 61, 20+($dotgap*$i), 60+$x_axis, 20+($dotgap*$i), $dark_gray);
		$sign_percent = 100-($y_gap*$i);				// Y ���� ��ǥ �ۼ�Ʈ
		$sign_num = ($sum/$dot_num)*($dot_num-$i);		// Y ���� ��ǥ �ۼ�Ʈ�� �ش��ϴ� ��
		ImageString($image, 2, 20, 14+($i*$dotgap), $sign_percent ."%", $black);
		ImageString($image, 2, 20, 26+($i*$dotgap), "(".$sign_num .")", $black);
	}

	for($i=0; $i<sizeof($data); $i++)
	{
		if($i==0)
		{
			$x_pos[$i] = $first_gap;					// ó�� �׷����� �׷��� X ��ǥ
		}
		else
		{
			$x_pos[$i] = $x2_pos[$i-1] + $print_gap;	// ó���� �ƴ� �׷����� �׷��� X ��ǥ
		}

		$x2_pos[$i] = $x_pos[$i] + $line_width;

		// �������� ������ data �� �� ����
		imageString($image, 2, $x_pos[$i]+80, ($y_axis-$line_height[$i]), $data[$i], $black);

		// ����Ʒ��� ������ data �̸� ���
		// array imagettftext (int im, int size, int angle, int x, int y, int col, string fontfile, string text)

		//ImageTTFText($image,12,0, 40+$x_pos[$i]+($line_width/2), $y_axis+35, $black, "hangul.ttf", str2uni($data_name[$i]));

		// �簢�� �׸���
		ImageFilledRectangle($image, $x_pos[$i]+60, 20+($y_axis-$line_height[$i]), $x2_pos[$i]+60, 20+$y_axis-2, $fillColor[$color]);
	}

	// 0 ��ǥ ���
	ImageString($image ,2 ,50, 20+$y_axis-10, "0", $black);

	ImageGif($image,"$file_name");
	ImageDestroy($image);

}// function End.
?>