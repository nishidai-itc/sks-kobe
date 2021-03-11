<?php

    // 交通費マスタクラス
    class Kotuhi
    {
        // 変数の宣言
        public $inp_m_work_type_kbn;
        public $inp_m_work_type_cd;
        public $inp_m_work_type_item_cd;
        public $inp_m_work_type_start_date;
        public $inp_m_work_type_content;
        public $inp_m_work_type_unit;
        public $inp_m_work_type_calc;
        public $inp_m_work_type_created;
        public $inp_m_work_type_created_staffid;
        public $inp_m_work_type_modified;
        public $inp_m_work_type_modified_staffid;

        public $oup_m_work_type_kbn;
        public $oup_m_work_type_cd;
        public $oup_m_work_type_item_cd;
        public $oup_m_work_type_start_date;
        public $oup_m_work_type_content;
        public $oup_m_work_type_unit;
        public $oup_m_work_type_calc;
        public $oup_m_work_type_created;
        public $oup_m_work_type_created_staffid;
        public $oup_m_work_type_modified;
        public $oup_m_work_type_modified_staffid;

        // 入力チェック
        public function inputCheck()
        {
        }

        // セレクト
        public function getKotuhi()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_kotuhi_no "
                 . ",   m_kotuhi_staff_id "
                 . ",   m_kotuhi_place "
                 . ",   m_kotuhi_kikan "
                 . ",   m_kotuhi_from "
                 . ",   m_kotuhi_to "
                 . ",   m_kotuhi_cost "
                 . ",   m_kotuhi_created "
                 . ",   m_kotuhi_created_id "
                 . ",   m_kotuhi_modified "
                 . ",   m_kotuhi_modified_id "
                 . "FROM "
                 .     "m_kotuhi "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_kotuhi_no != "") {
                $sql .= "AND m_kotuhi_no = '" . $db->escape_string($this->inp_m_kotuhi_no) . "' ";
            }
            if ($this->inp_m_kotuhi_staff_id != "") {
                $sql .= "AND m_kotuhi_staff_id = '" . $db->escape_string($this->inp_m_kotuhi_staff_id) . "' ";
            }
            if ($this->inp_m_work_type_item_cd != "") {
                $sql .= "AND m_work_type_item_cd = '" . $db->escape_string($this->inp_m_work_type_item_cd) . "' ";
            }
            if ($this->inp_m_work_type_start_date != "") {
                $sql .= "AND m_work_type_start_date = '" . $db->escape_string($this->inp_m_work_type_start_date) . "' ";
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

                    $this->oup_m_kotuhi_no[]               = $row[$i++];
                    $this->oup_m_kotuhi_staff_id[]         = $row[$i++];
                    $this->oup_m_kotuhi_place[]            = $row[$i++];
                    $this->oup_m_kotuhi_kikan[]            = $row[$i++];
                    $this->oup_m_kotuhi_from[]             = $row[$i++];
                    $this->oup_m_kotuhi_to[]               = $row[$i++];
                    $this->oup_m_kotuhi_cost[]             = $row[$i++];
                    $this->oup_m_kotuhi_created[]          = $row[$i++];
                    $this->oup_m_kotuhi_created_id[]       = $row[$i++];
                    $this->oup_m_kotuhi_modified[]         = $row[$i++];
                    $this->oup_m_kotuhi_modified_id[]      = $row[$i++];

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
        public function insertKotuhi()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_kotuhi "
                 . "( "
                 .     "m_kotuhi_staff_id "
                 . ",   m_kotuhi_place "
                 . ",   m_kotuhi_kikan "
                 . ",   m_kotuhi_from "
                 . ",   m_kotuhi_to "
                 . ",   m_kotuhi_cost "
                 . ",   m_kotuhi_created "
                 . ",   m_kotuhi_created_id "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_m_kotuhi_staff_id."'"
                 . ",    '".$this->inp_m_kotuhi_place."'"
                 . ",    '".$this->inp_m_kotuhi_kikan."'"
                 . ",    '".$this->inp_m_kotuhi_from."'"
                 . ",    '".$this->inp_m_kotuhi_to."'"
                 . ",    '".$this->inp_m_kotuhi_cost."'"
                 . ",    '".$this->inp_m_kotuhi_created."'"
                 . ",    '".$this->inp_m_kotuhi_created_id."'"
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
        public function updateKotuhi()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_kotuhi SET "
                 . "    m_kotuhi_no                     = '" . $this->inp_m_kotuhi_no . "' ";
            if ($this->inp_m_kotuhi_staff_id != "") {
                $sql .= ",   m_kotuhi_staff_id            = '" . $this->inp_m_kotuhi_staff_id . "' ";
            }
            if ($this->inp_m_kotuhi_place != "") {
                $sql .= ",   m_kotuhi_place               = '" . $this->inp_m_kotuhi_place . "' ";
            }
            if ($this->inp_m_kotuhi_kikan != "") {
                $sql .= ",   m_kotuhi_kikan               = '" . $this->inp_m_kotuhi_kikan . "' ";
            }
            if ($this->inp_m_kotuhi_from != "") {
                $sql .= ",   m_kotuhi_from            = '" . $this->inp_m_kotuhi_from . "' ";
            }
            if ($this->inp_m_kotuhi_to != "") {
                $sql .= ",   m_kotuhi_to    = '" . $this->inp_m_kotuhi_to . "' ";
            }
            if ($this->inp_m_kotuhi_cost != "") {
                $sql .= ",   m_kotuhi_cost    = '" . $this->inp_m_kotuhi_cost . "' ";
            }
            if ($this->inp_m_kotuhi_modified != "") {
                $sql .= ",   m_kotuhi_modified           = '" . $this->inp_m_kotuhi_modified . "' ";
            }
            if ($this->inp_m_kotuhi_modified_id != "") {
                $sql .= ",   m_kotuhi_modified_id   = '" . $this->inp_m_kotuhi_modified_id . "' ";
            }
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND m_kotuhi_no        = '" . $db->escape_string($this->inp_m_kotuhi_no) . "' ";

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
        public function deleteKotuhi()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_kotuhi "
                 . "WHERE ";
            $sql .= " m_kotuhi_no        = '" . $db->escape_string($this->inp_m_kotuhi_no) . "' ";

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
