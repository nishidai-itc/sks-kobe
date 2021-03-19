<?php
// 書き込みモード（追記）でファイルを開く
$fp = fopen("../../log/log.txt", "a");
$current = date('m-d H:i:s')." ";
$current .= "警備報告書".$table."　".$_SESSION["staff_id"]."\n";
// ファイルに書き込む
fwrite($fp, $current);
// ファイルを閉じる
fclose($fp);
?>