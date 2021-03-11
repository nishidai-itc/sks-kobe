<?php

    // 祝日マスタクラス
    class Holiday
    {
        // 変数の宣言
        public $oup_id;
        public $oup_date;
        public $oup_hol_name;

        public $inp_date;
        public $inp_hol_name;

        public $inp_holiday_no;

        public $up_holiday_id;
        public $up_holiday_date;
        public $up_holiday_name;

        public $delete_holiday_id;


        // 入力チェック
        public function inputCheck()
        {
        }

        // セレクト
        public function getHoliday()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "id "
                 . ",   date "
                 . ",   hol_name "
                 . "FROM "
                 .     "m_holiday "
                 . "WHERE 0 = 0 ";

            if ($this->inp_holiday_no != "") {
                $sql .= "AND id = '" . $db->escape_string($this->inp_holiday_no) . "' ";
            }
            if ($this->inp_holiday_nengetu != "") {
                $sql .= "AND date like '" . substr($db->escape_string($this->inp_holiday_nengetu),0,4)."-".substr($db->escape_string($this->inp_holiday_nengetu),4,2)."%".  "' ";
            }
            if ($this->inp_holiday_start_date != "") {
                $sql .= "AND date >= '" . substr($db->escape_string($this->inp_holiday_start_date),0,4)."-".substr($db->escape_string($this->inp_holiday_start_date),4,2)."-".substr($db->escape_string($this->inp_holiday_start_date),6,2) . "' ";
            }
            if ($this->inp_holiday_end_date != "") {
                $sql .= "AND date <= '" . substr($db->escape_string($this->inp_holiday_end_date),0,4)."-".substr($db->escape_string($this->inp_holiday_end_date),4,2)."-".substr($db->escape_string($this->inp_holiday_end_date),6,2) . "' ";
            }

            if ($this->inp_order != "") {
                $sql .= $db->escape_string($this->inp_order);
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

                    $this->oup_id[]               = $row[$i++];
                    $this->oup_date[]             = $row[$i++];
                    $this->oup_hol_name[]         = $row[$i++];

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
        public function insertHoliday()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_holiday "
                 . "( "
                 .     "date "
                 . ",   hol_name "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_date."'"
                 . ",    '".$this->inp_hol_name."'"
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
        public function updateHoliday()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_holiday SET "
                 . "    date                     = '" . $this->up_holiday_date . "' ";
            if ($this->up_holiday_name != "") {
                $sql .= ",   hol_name            = '" . $this->up_holiday_name . "' ";
            }
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND id        = '" . $db->escape_string($this->up_holiday_id) . "' ";

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
        public function deleteHoliday()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_holiday "
                 . "WHERE ";
            $sql .= " id        = '" . $db->escape_string($this->delete_holiday_id) . "' ";


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
