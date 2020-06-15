<?php
error_reporting(0);
$id = isset($_GET['id'])?intval($_GET['id']):exit();
$url = isset($_GET['url'])?trim($_GET['url']):exit();
if($id<1 || $id>6)exit();

$backgrounds = array('adv1.jpg','adv2.jpg','adv3.jpg','adv4.jpg','adv5.jpg','adv6.jpg');

$imagesx = array(175,175,280,260,325,270);

$imagesy = array(175,125,350,245,380,330);

$imagesize = array(150,150,240,300,190,260);


//ͼƬһ
$path_1 = './img/'.$backgrounds[$id-1];
//ͼƬ��
$path_2 = 'http://www.liantu.com/api.php?w='.$imagesize[$id-1].'&m=10&text='.urlencode($url);
//����ͼƬ����
//imagecreatefrompng($filename)--���ļ��� URL ����һ����ͼ��
$image_1 = imagecreatefromjpeg($path_1);
$image_2 = imagecreatefrompng($path_2);
//�ϳ�ͼƬ
//imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )---�������ϲ�ͼ���һ����
//�� src_im ͼ��������� src_x��src_y ��ʼ�����Ϊ src_w���߶�Ϊ src_h ��һ���ֿ����� dst_im ͼ��������Ϊ dst_x �� dst_y ��λ���ϡ���ͼ�񽫸��� pct �������ϲ��̶ȣ���ֵ��Χ�� 0 �� 100���� pct = 0 ʱ��ʵ����ʲôҲû������Ϊ 100 ʱ���ڵ�ɫ��ͼ�񱾺����� imagecopy() ��ȫһ�����������ɫͼ��ʵ���� alpha ͸����
imagecopymerge($image_1, $image_2, $imagesx[$id-1], $imagesy[$id-1], 0, 0, imagesx($image_2), imagesy($image_2), 100);
// ����ϳ�ͼƬ
//imagepng($image[,$filename]) �� �� PNG ��ʽ��ͼ���������������ļ�
header('Content-type:image/png');
imagepng($image_1);