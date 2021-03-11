<?php 

    // 手当てクラス
    class teate
    {
        // 変数の宣言
        public $inp_m_teate_no;
        public $inp_m_teate_name;
        public $inp_m_teate_created;
        public $inp_m_teate_created_id;
        public $inp_m_teate_modified;
        public $inp_m_teate_modified_id;

        public $oup_m_teate_no;
        public $oup_m_teate_name;
        public $oup_m_teate_created;
        public $oup_m_teate_created_id;
        public $oup_m_teate_modified;
        public $oup_m_teate_modified_id;

        // 入力チェック
        public function inputCheck() {
            if ($this->inp_m_teate_name == "") {
                $this->errmsg .= "手当て名を入力してください。<br />";
            }
        }

        // セレクト
        public function getTeate() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_teate_no "
                 . ",   m_teate_name "
                 . ",   m_teate_created "
                 . ",   m_teate_created_id "
                 . ",   m_teate_modified "
                 . ",   m_teate_modified_id "
                 . "FROM "
                 .     "m_teate "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_teate_no != "") {
                $sql .= "AND m_teate_no = '" . $db->escape_string($this->inp_m_teate_no) . "' ";
            }

            $sql .= "order by m_teate_no ";

            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_m_teate_no[]             = $row[$i++];
                    $this->oup_m_teate_name[]           = $row[$i++];
                    $this->oup_m_teate_created[]        = $row[$i++];
                    $this->oup_m_teate_created_id[]     = $row[$i++];
                    $this->oup_m_teate_modified[]       = $row[$i++];
                    $this->oup_m_teate_modified_id[]    = $row[$i++];

// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);

            }

            return $result;

        }

        // インサート
        public function insertGenba() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_genba "
                 . "( "
                 .     "m_genba_id "
                 . ",   m_genba_name "
                 . ",   m_genba_kana "
                 . ",   m_genba_created "
                 . ",   m_genba_created_id "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_m_genba_id."'"
                 . ",    '".$this->inp_m_genba_name."'"
                 . ",    '".$this->inp_m_genba_kana."'"
                 . ",    '".$this->inp_m_genba_created."'"
                 . ",    '".$this->inp_m_genba_created_id."'"
                 . ") ";

// var_dump($sql);

            // 文字化け防止
            $db->set_charset();

            // クエリを送信する
            $db->prepare($sql);

            // プリペアドクエリを実行する
            $db->stmt_execute();

            // 結果保持用メモリを開放する
            $db->stmt_close();

            // MySQLへの接続を閉じる
            $db->close();

        }

        // アップデート
        public function updateTeate() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_teate SET "
                 . "    m_teate_no = '" . $this->inp_m_teate_no . "' ";
                if ($this->inp_m_teate_name != "") {
                    $sql .= ",   m_teate_name = '" . $db->escape_string($this->inp_m_teate_name) . "' ";
                }
                if ($this->inp_m_teate_modified != "") {
                    $sql .= ",   m_teate_modified = '" . $db->escape_string($this->inp_m_teate_modified) . "' ";
                }
                if ($this->inp_m_teate_modified_id != "") {
                    $sql .= ",   m_teate_modified_id = '" . $db->escape_string($this->inp_m_teate_modified_id) . "' ";
                }
                $sql .= "WHERE ";
                $sql .= " m_teate_no = '" . $db->escape_string($this->inp_m_teate_no) . "' ";

// var_dump($sql);

            // 文字化け防止
            $db->set_charset();

            // クエリを送信する
            $db->prepare($sql);

            // プリペアドクエリを実行する
            $db->stmt_execute();

            // 結果保持用メモリを開放する
            $db->stmt_close();

            // MySQLへの接続を閉じる
            $db->close();
        }

        // デリート
        public function deleteGenba() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql  = "DELETE FROM m_genba ";
            $sql .= "WHERE m_genba_id = '" . $db->escape_string($this->inp_m_genba_id) . "' ";

// var_dump($sql);

            // 文字化け防止
            $db->set_charset();

            // クエリを送信する
            $db->prepare($sql);

            // プリペアドクエリを実行する
            $db->stmt_execute();

            // 結果保持用メモリを開放する
            $db->stmt_close();

            // MySQLへの接続を閉じる
            $db->close();

        }

    }
?>
