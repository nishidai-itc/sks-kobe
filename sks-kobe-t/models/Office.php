<?php 

    // 事業所マスタクラス
    class Office
    {
        // 変数の宣言
        public $inp_m_office_id;
        public $inp_m_office_name;
        public $inp_m_office_tel;
        public $inp_m_office_created;
        public $inp_m_office_created_staffid;
        public $inp_m_office_modified;
        public $inp_m_office_modified_staffid;

        public $oup_m_office_id;
        public $oup_m_office_name;
        public $oup_m_office_tel;
        public $oup_m_office_created;
        public $oup_m_office_created_staffid;
        public $oup_m_office_modified;
        public $oup_m_office_modified_staffid;

        // 入力チェック
        public function inputCheck() {
        }

        // セレクト
        public function getOffice() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_office_id "
                 . ",   m_office_name "
                 . ",   m_office_tel "
                 . ",   m_office_created "
                 . ",   m_office_created_staffid "
                 . ",   m_office_modified "
                 . ",   m_office_modified_staffid "
                 . "FROM "
                 .     "m_office "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_office_id != "") {
                $sql .= "AND m_office_id = '" . $db->escape_string($this->inp_m_office_id) . "' ";
            }
            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

  // プリペアドクエリを実行する
    $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;
                    $this->oup_m_office_id[]                = $row[$i++];
                    $this->oup_m_office_name[]              = $row[$i++];
                    $this->oup_m_office_tel[]               = $row[$i++];
                    $this->oup_m_office_created[]           = $row[$i++];
                    $this->oup_m_office_created_staffid[]   = $row[$i++];
                    $this->oup_m_office_modified[]          = $row[$i++];
                    $this->oup_m_office_modified_staffid[]  = $row[$i++];
// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);

            }

            return $result;

        }

        // インサート
        public function insertOffice() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_office "
                 . "( "
                 .     "m_office_id "
                 . ",   m_office_name "
                 . ",   m_office_tel "
                 . ",   m_office_created "
                 . ",   m_office_created_staffid "
                 . ",   m_office_modified "
                 . ",   m_office_modified_staffid "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_m_office_id."'"
                 . ",    '".$this->inp_m_office_name."'"
                 . ",    '".$this->inp_m_office_tel."'"
                 . ",    '".$this->inp_m_office_created."'"
                 . ",    '".$this->inp_m_office_created_staffid."'"
                 . ",    '".$this->inp_m_office_modified."'"
                 . ",    '".$this->inp_m_office_modified_staffid."'"
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
        public function updateOffice() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_office SET "
                 . "    m_office_id = '" . $this->inp_m_office_id . "' ";
                if ($this->inp_m_office_name != "") {
                    $sql .= ",   m_office_name = '" . $db->escape_string($this->inp_m_office_name) . "' ";
                }
                if ($this->inp_m_office_tel != "") {
                    $sql .= ",   m_office_tel = '" . $db->escape_string($this->inp_m_office_tel) . "' ";
                }
                if ($this->inp_m_office_created != "") {
                    $sql .= ",   m_office_created = '" . $db->escape_string($this->inp_m_office_created) . "' ";
                }
                if ($this->inp_m_office_created_staffid != "") {
                    $sql .= ",   m_office_created_staffid = '" . $db->escape_string($this->inp_m_office_created_staffid) . "' ";
                }
                if ($this->inp_m_office_modified != "") {
                    $sql .= ",   m_office_modified = '" . $db->escape_string($this->inp_m_office_modified) . "' ";
                }
                if ($this->inp_m_office_modified_staffid != "") {
                    $sql .= ",   m_office_modified_staffid = '" . $db->escape_string($this->inp_m_office_modified_staffid) . "' ";
                }
                $sql .= "WHERE 0 = 0 ";
                $sql .= "AND m_office_id = '" . $db->escape_string($this->inp_m_office_id) . "' ";

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
        public function deleteOffice() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_office "
                 . "WHERE 0 = 0 ";
            $sql .= "AND m_office_id = " . $db->escape_string($this->inp_m_office_id) . " ";

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
