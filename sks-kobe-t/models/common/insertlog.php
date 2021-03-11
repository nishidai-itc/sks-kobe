<?php

    $db2 = new Db();

    // MySQLへ接続する
    $db2->connect();

    $sql2 = "INSERT INTO t_log "
        . "( "
        .     "t_log_kbn "
        . ",   t_log_content "
        . ",   t_log_created "
        . ",   t_log_created_id "
        . ") "
        . "VALUES "
        . "( "
        . "     '".$current."'"
        . ",    \"$sql\""
        . ",    '".date('Y-m-d H:i:s')."'"
        . ",    '".$_SESSION['staff_id']."'"
        . ") ";

//             var_dump($sql);

    // 文字化け防止
    $db2->set_charset();

    // クエリを送信する
    $db2->prepare($sql2);

    // プリペアドクエリを実行する
    $db2->stmt_execute();

    // // 最新のIDを取得
    // $this->oup_last_id = mysqli_insert_id($db->link);

    // 結果保持用メモリを開放する
    $db2->stmt_close();

    // MySQLへの接続を閉じる
    $db2->close();

?>
