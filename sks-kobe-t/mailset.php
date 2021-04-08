<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 設置した場所のパスを指定する
require dirname(__FILE__).'/../PHPMailer/src/PHPMailer.php';
require dirname(__FILE__).'/../PHPMailer/src/Exception.php';
require dirname(__FILE__).'/../PHPMailer/src/SMTP.php';
// require('/var/www/html/PHPMailer/src/PHPMailer.php');
// require('/var/www/html/PHPMailer/src/Exception.php');
// require('/var/www/html/PHPMailer/src/SMTP.php');

//require "PHPMailer/class.phpmailer.php"; //ライブラリ読み込み※
//require "/var/www/html/PHPMailer/PHPMailerAutoload.php"; //ライブラリ読み込み※
date_default_timezone_set('Asia/Tokyo');
mb_language("ja");
mb_internal_encoding("ISO-2022-JP"); //内部エンコーディング(UTF-8など)
?>

<?php
$mailer = new PHPMailer();
$mailer->isSMTP(); //SMTP送信します宣言
$mailer->SMTPSecure = 'tls'; //Gmailの場合は必要
//$mailer->SMTPSecure = 'ssl'; //Gmailの場合は必要
$mailer->Host = 'sv10288.xserver.jp'; //メールサーバー
$mailer->Port = 587; //25 or 465
$mailer->SMTPAuth = true; //SMTP認証の有無
$mailer->Username = "saimen@e-itc.co.jp"; //SMTP認証用のユーザーID（さくら鯖はIDがメアド）
$mailer->Password = "Sai*0000"; //SMTP認証用のパスワード
$mailer->setFrom('kaigo@e-itc.co.jp', 'kaigo@e-itc.co.jp'); //送信用メールアドレス
$mailer->CharSet = 'ISO-2022-JP'; //文字化けした場合はUTF8に
?>

<?php
// $mail="poupeetheatre@gmail.com";
$mail="nishidai@e-itc.co.jp";
$sub="test";
$body="test";
$mailer->addAddress($mail); //送信先
$mailer->Subject = mb_convert_encoding($sub, "ISO-2022-JP","UTF-8"); //件名
$mailer->Body = mb_convert_encoding($body,"ISO-2022-JP","UTF-8"); //内容
// $attachfile = "/var/www/html/sks-kobe-t/log/report2.pdf";
$attachfile = $common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,6).".pdf";
$mailer->AddAttachment($attachfile);
$mailer->send(); //送信実行
?>
