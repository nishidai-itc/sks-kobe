<?php 
    // データベースクラス
    class Db
    {
        // 変数の宣言
        public $url = "wincloud.cytrgbzmibnk.ap-northeast-1.rds.amazonaws.com";
        public $user = "sks-kobe-t";
        public $pass = "sks-kobe-t";
        public $db = "skskobe-t";
        public $result = NULL;
        public $link = NULL;

        // DB接続
        public function connect() {

            // MySQLへ接続する
            $this->link = mysqli_connect($this->url,$this->user,$this->pass,$this->db) or die("MySQLへの接続に失敗しました。");
        }

        public function escape_string($str) {
            return mysqli_real_escape_string($this->link, $str);

        }

        // DB接続
        public function set_charset() {

            // 文字化け防止
            mysqli_set_charset($this->link,"utf8");
        }

        // クエリを実行
        public function query($sql) {

            return mysqli_query($this->link, $sql);

        }

        // DBクローズ
        public function close() {

            // MySQLへの接続を閉じる
            mysqli_close($this->link) or die("MySQL切断に失敗しました。");
        }

        // クエリを送信する
        public function prepare($sql) {

            // クエリを送信する
            $this->stmt = mysqli_prepare($this->link, $sql) or die("クエリの送信に失敗しました。<br />SQL:".$sql);
        }

        public function stmt_execute() {

            // プリペアドクエリを実行する
            $result = mysqli_stmt_execute($this->stmt);
            if (!($result)) {
                print("クエリの実行に失敗しました。<br />SQL");
            }

        }

        public function stmt_close() {

            // 結果保持用メモリを開放する
            mysqli_stmt_close($this->stmt);
        }
    }

?>
