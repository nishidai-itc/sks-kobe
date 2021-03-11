<?php

    // ポストマスタクラス
    class PostTeate
    {

        // 変数の宣言
        public $inp_m_post_teate_no;          // 通し番号
        public $inp_m_post_teate_staff_id;    // 社員No
        public $inp_m_post_teate_shift_no;    // シフトNo
        public $inp_m_post_teate_post_cost;   // ポスト手当て
        public $inp_m_post_teate_created;     // 作成時間
        public $inp_m_post_teate_created_id;  // 作成者
        public $inp_m_post_teate_modified;    // 修正時間
        public $inp_m_post_teate_modified_id; // 修正者

        public $oup_m_post_teate_no;
        public $oup_m_post_teate_staff_id;
        public $oup_m_post_teate_shift_no;
        public $oup_m_post_teate_post_cost;
        public $oup_m_post_teate_created;
        public $oup_m_post_teate_created_id;
        public $oup_m_post_teate_modified;
        public $oup_m_post_teate_modified_id;

        // 入力チェック
        public function inputCheck()
        {
        }

        // セレクト
        public function getPostTeate()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_post_teate_no "
                 . ",   m_post_teate_staff_id "
                 . ",   m_post_teate_shift_no "
                 . ",   m_post_teate_post_cost "
                 . ",   m_post_teate_created "
                 . ",   m_post_teate_created_id "
                 . ",   m_post_teate_modified "
                 . ",   m_post_teate_modified_id "
                 . "FROM "
                 .     "m_post_teate "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_post_teate_no != "") {
                $sql .= "AND m_post_teate_no = '" . $db->escape_string($this->inp_m_post_teate_no) . "' ";
            }
            if ($this->inp_m_post_teate_shift_no != "") {
                $sql .= "AND m_post_teate_shift_no = '" . $db->escape_string($this->inp_m_post_teate_shift_no) . "' ";
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

            // var_dump($sql);

            // プリペアドクエリを実行する
            $result = $db->query($sql, $row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_m_post_teate_no[]          = $row[$i++];
                    $this->oup_m_post_teate_staff_id[]    = $row[$i++];
                    $this->oup_m_post_teate_shift_no[]    = $row[$i++];
                    $this->oup_m_post_teate_post_cost[]   = $row[$i++];
                    $this->oup_m_post_teate_created[]     = $row[$i++];
                    $this->oup_m_post_teate_created_id[]  = $row[$i++];
                    $this->oup_m_post_teate_modified[]    = $row[$i++];
                    $this->oup_m_post_teate_modified_id[] = $row[$i++];

                    // var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $result;

            // var_dump($result);

            // MySQLへの接続を閉じる
            $db->close();
        }

        // インサート
        public function insertPostTeate()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_post_teate "
                 . "( "
                 .     "m_post_teate_staff_id "
                 . ",   m_post_teate_shift_no "
                 . ",   m_post_teate_post_cost "
                 . ",   m_post_teate_created "
                 . ",   m_post_teate_created_id "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_m_post_teate_staff_id."'"
                 . ",    '".$this->inp_m_post_teate_shift_no."'"
                 . ",    '".$this->inp_m_post_teate_post_cost."'"
                 . ",    '".$this->inp_m_post_teate_created."'"
                 . ",    '".$this->inp_m_post_teate_created_id."'"
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
        public function updatePostTeate()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_post_teate SET "
                 . "    m_post_teate_no                     = '" . $this->inp_m_post_teate_no . "' ";
            if ($this->inp_m_post_teate_staff_id != "") {
                $sql .= ",   m_post_teate_staff_id            = '" . $this->inp_m_post_teate_staff_id . "' ";
            }
            if ($this->inp_m_post_teate_shift_no != "") {
                $sql .= ",   m_post_teate_shift_no               = '" . $this->inp_m_post_teate_shift_no . "' ";
            }
            if ($this->inp_m_post_teate_post_cost != "") {
                $sql .= ",   m_post_teate_post_cost    = '" . $this->inp_m_post_teate_post_cost . "' ";
            }
            if ($this->inp_m_post_teate_modified != "") {
                $sql .= ",   m_post_teate_modified           = '" . $this->inp_m_post_teate_modified . "' ";
            }
            if ($this->inp_m_post_teate_modified_id != "") {
                $sql .= ",   m_post_teate_modified_id   = '" . $this->inp_m_post_teate_modified_id . "' ";
            }
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND m_post_teate_no        = '" . $db->escape_string($this->inp_m_post_teate_no) . "' ";

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
        public function deletePostTeate()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_post_teate "
                 . "WHERE ";
            $sql .= " m_post_teate_no        = '" . $db->escape_string($this->inp_m_post_teate_no) . "' ";

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
