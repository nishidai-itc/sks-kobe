<?php 

    // 楽々ケア２連動ログクラス
    class Rakulog
    {
        // 変数の宣言
        public $inp_t_raku_log_id;
        public $inp_t_raku_log_content;
        public $inp_t_raku_log_created;

        public $oup_t_raku_log_id;
        public $oup_t_raku_log_content;
        public $oup_t_raku_log_created;

        // 入力チェック
        public function inputCheck() {
        }

        // セレクト
        public function getRakulog() {

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
        public function insertRakulog() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO t_raku_log "
                 . "( "
                 .     "t_raku_log_content "
                 . ",   t_raku_log_created "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_t_raku_log_content."'"
                 . ",    '".$this->inp_t_raku_log_created."'"
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
        public function deleteRakulog() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM t_raku_log "
                 . "WHERE t_raku_log_created <= '".date("Y-m-d H:i:s", strtotime("-1 month"))."' ";

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
