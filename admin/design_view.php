								<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
									<tr align=center><?
									if ($main)
									{
										$img = "image/design_navigation.swf";
										$img_info = @getimagesize($img);
										$swf_width = $img_info[0];
										$swf_height = $img_info[1];
										?>
										<td>
											<script language='javascript'>
												getFlash("<?=$img?>", "<?=$swf_width?>", "<?=$swf_height?>");
											</script>
										</td><?
									}
									else
									{
										?>
										<td><img src="image/design_view1.gif"></td>
										<td>
											<table width="100%" border="1" cellspacing="0" cellpadding="10" align="center" bordercolor="#FFD28E" bordercolordark="#ffffff" height="50">
												<tr>
													<td bgcolor="#FFF3E1" style="font-size: 9pt">
													A - ���θ� ��ܿ� �ش��ϸ� �����ΰ� / ��ܸ޴� / �˻� / ��� ���<br><br>
													B - ���θ� Ÿ��Ʋ �̹��� / �������� <br><br>
													B-1 - �����߾� 3�� ���� �����̹��� ��� <br><br>
													C - ��ǰ ī�װ� / �α��� ���� / �������� <br><br>
													D - �Ż�ǰ�� / ���� ��� / ��������  <br><br>
													E - ����Ʈ ��ǰ�� <br><br>
													F - ��Ʈ ��ǰ�� / �������ǰ Ÿ��Ʋ �̹���<br><br>
													G - �ϴ� �޴� �� ī�Ƕ����� <br><br></td>
												</tr>
											</table>
										</td><?
									}
									?>
									</tr>
								</table>