<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// �ݒu�����ꏊ�̃p�X���w�肷��
require dirname(__FILE__).'/../PHPMailer/src/PHPMailer.php';
require dirname(__FILE__).'/../PHPMailer/src/Exception.php';
require dirname(__FILE__).'/../PHPMailer/src/SMTP.php';
// require('/var/www/html/PHPMailer/src/PHPMailer.php');
// require('/var/www/html/PHPMailer/src/Exception.php');
// require('/var/www/html/PHPMailer/src/SMTP.php');

//require "PHPMailer/class.phpmailer.php"; //���C�u�����ǂݍ��݁�
//require "/var/www/html/PHPMailer/PHPMailerAutoload.php"; //���C�u�����ǂݍ��݁�
date_default_timezone_set('Asia/Tokyo');
mb_language("ja");
mb_internal_encoding("ISO-2022-JP"); //�����G���R�[�f�B���O(UTF-8�Ȃ�)
?>

<?php
$mailer = new PHPMailer();
$mailer->isSMTP(); //SMTP���M���܂��錾
$mailer->SMTPSecure = 'tls'; //Gmail�̏ꍇ�͕K�v
//$mailer->SMTPSecure = 'ssl'; //Gmail�̏ꍇ�͕K�v
$mailer->Host = 'sv10288.xserver.jp'; //���[���T�[�o�[
$mailer->Port = 587; //25 or 465
$mailer->SMTPAuth = true; //SMTP�F�؂̗L��
$mailer->Username = "saimen@e-itc.co.jp"; //SMTP�F�ؗp�̃��[�U�[ID�i������I��ID�����A�h�j
$mailer->Password = "Sai*0000"; //SMTP�F�ؗp�̃p�X���[�h
$mailer->setFrom('kaigo@e-itc.co.jp', 'kaigo@e-itc.co.jp'); //���M�p���[���A�h���X
$mailer->CharSet = 'ISO-2022-JP'; //�������������ꍇ��UTF8��
?>

<?php
// $mail="poupeetheatre@gmail.com";
$mail="nishidai@e-itc.co.jp";
$sub="test";
$body="test";
$mailer->addAddress($mail); //���M��
$mailer->Subject = mb_convert_encoding($sub, "ISO-2022-JP","UTF-8"); //����
$mailer->Body = mb_convert_encoding($body,"ISO-2022-JP","UTF-8"); //���e
// $attachfile = "/var/www/html/sks-kobe-t/log/report2.pdf";
$attachfile = $common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,6).".pdf";
$mailer->AddAttachment($attachfile);
$mailer->send(); //���M���s
?>
