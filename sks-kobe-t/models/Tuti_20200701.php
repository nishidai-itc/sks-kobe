<?php

    // 交通費マスタクラス
    class Tuti
    {
        // 変数の宣言
        public $inp_m_tuti_msg = null;
        //public $inp_m_tuti_;
        //public $inp_m_work_type_cd;
        //public $inp_m_work_type_item_cd;
        //public $inp_m_work_type_start_date;
        //public $inp_m_work_type_content;
        //public $inp_m_work_type_unit;
        //public $inp_m_work_type_calc;
        //public $inp_m_work_type_created;
        //public $inp_m_work_type_created_staffid;
        //public $inp_m_work_type_modified;
        //public $inp_m_work_type_modified_staffid;
        //
        //public $oup_m_work_type_kbn;
        //public $oup_m_work_type_cd;
        //public $oup_m_work_type_item_cd;
        //public $oup_m_work_type_start_date;
        //public $oup_m_work_type_content;
        //public $oup_m_work_type_unit;
        //public $oup_m_work_type_calc;
        //public $oup_m_work_type_created;
        //public $oup_m_work_type_created_staffid;
        //public $oup_m_work_type_modified;
        //public $oup_m_work_type_modified_staffid;

        // 入力チェック
        public function inputCheck()
        {
        }

        // セレクト
        public function getTuti()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_tuti_no "
                 . ",   m_tuti_startday "
                 . ",   m_tuti_endday "
                 . ",   m_tuti_msg "
                 . "FROM "
                 .     "m_tuti "
                 . "WHERE 0 = 0 ";
            
            if ($this->inp_m_tuti_no != "") {
                $sql .= "AND m_tuti_no = '" . $db->escape_string($this->inp_m_tuti_no) . "' ";
            }
            if ($this->inp_m_tuti_startday != "") {
                $sql .= "AND m_tuti_startday = '" . $db->escape_string(substr($this->inp_m_tuti_startday,0,4)."-".substr($this->inp_m_tuti_startday,4,2)."-".substr($this->inp_m_tuti_startday,6,2)) . "' ";
            }
            if ($this->inp_m_tuti_endday != "") {
                $sql .= "AND m_tuti_endday = '" . $db->escape_string(substr($this->inp_m_tuti_endday,0,4)."-".substr($this->inp_m_tuti_endday,4,2)."-".substr($this->inp_m_tuti_endday,6,2)) . "' ";
            }
            if ($this->inp_m_tuti_day != "") {
                $sql .= "AND (m_tuti_startday <= '" . $db->escape_string(substr($this->inp_m_tuti_day,0,4)."-".substr($this->inp_m_tuti_day,4,2)."-".substr($this->inp_m_tuti_day,6,2)) . "' && m_tuti_startday != '0000-00-00')";
                $sql .= "AND (m_tuti_endday >= '" . $db->escape_string(substr($this->inp_m_tuti_day,0,4)."-".substr($this->inp_m_tuti_day,4,2)."-".substr($this->inp_m_tuti_day,6,2)) . "' && m_tuti_endday != '0000-00-00')";
            }
            if ($this->inp_m_tuti_msg != "") {
                $sql .= "AND m_tuti_msg = '" . $db->escape_string($this->inp_m_tuti_msg) . "' ";
            }
            if ($this->inp_m_tuti_msg2 != "") {
                $sql .= "AND (m_tuti_msg is not null && m_tuti_msg != '') ";
            }
//print($sql);
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

                    $this->oup_m_tuti_no[]               = $row[$i++];
                    $this->oup_m_tuti_startday[]         = $row[$i++];
                    $this->oup_m_tuti_endday[]       = $row[$i++];
                    $this->oup_m_tuti_msg[]         = $row[$i++];

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
        public function insertTuti()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_tuti "
                 . "( "
                 .     "m_tuti_startday "
                 . ",   m_tuti_endday "
                 . ",   m_tuti_msg "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_m_tuti_startday."'"
                 . ",    '".$this->inp_m_tuti_endday."'"
                 . ",    '".$this->inp_m_tuti_msg."'"
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
        public function updateTuti()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_tuti SET "
                 . "    m_tuti_no                     = '" . $this->inp_m_tuti_no . "' ";
            if ($this->inp_m_tuti_startday != "") {
                $sql .= ",   m_tuti_startday            = '" . $this->inp_m_tuti_startday . "' ";
            }
            if ($this->inp_m_tuti_endday != "") {
                $sql .= ",   m_tuti_endday               = '" . $this->inp_m_tuti_endday . "' ";
            }
            if (!is_null($this->inp_m_tuti_msg)) {
                $sql .= ",   m_tuti_msg               = '" . $this->inp_m_tuti_msg . "' ";
            }
            
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND m_tuti_no        = '" . $db->escape_string($this->inp_m_tuti_no) . "' ";

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
        public function deleteTuti()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_tuti "
                 . "WHERE ";
            $sql .= " m_tuti_no        = '" . $db->escape_string($this->inp_m_tuti_no) . "' ";

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
