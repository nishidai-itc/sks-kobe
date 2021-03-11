<?php
//$file = '../log/log.txt';
//$file = 'C:\xampp\htdocs\sks-kobe\log\log.txt';
//// ファイルをオープンして既存のコンテンツを取得します
//$current = file_get_contents($file);
//// 新しい人物をファイルに追加します
//$current .= date('m-d H:i:s')." ";
//$current .= $sql."\n";
//// 結果をファイルに書き出します
//file_put_contents($file, $current);

//// 書き込みモードでファイルを開く
//$fp = fopen("C:\xampp\htdocs\sks-kobe\log\log.txt", "w");

// 書き込みモード（追記）でファイルを開く
$fp = fopen("/var/www/html/sks-kobe-t/log/log.txt", "a");
// $fp = fopen("C:/xampp/htdocs/sks-kobe/log/log.txt", "a");

$current = date('m-d H:i:s')." ";
$current .= $sql."\n";
// ファイルに書き込む
fwrite($fp, $current);

// ファイルを閉じる
fclose($fp);
?>
