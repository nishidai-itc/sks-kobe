<?php

    // 給与マスタクラス
    class Syukei
    {
        // 変数の宣言
        //public $inp_m_tuti_msg = null;
        //public $inp_m_tuti_startday = null;
        //public $inp_m_tuti_endday = null;
        public $inp_m_syukei_plan_total = null;
        public $inp_m_syukei_plan_day_total = null;
        

        // 入力チェック
        public function inputCheck()
        {
        }

        // セレクト
        public function getSyukei()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_syukei_no "
                 . ",   m_syukei_nengetu "
                 . ",   m_syukei_plan_total "
                 . ",   m_syukei_plan_day_total "
	             . ",   m_syukei_created "
	             . ",   m_syukei_created_id "
	             . ",   m_syukei_modified "
	             . ",   m_syukei_modified_id "
                 . "FROM "
                 .     "m_syukei "
                 . "WHERE 0 = 0 ";
            
            if ($this->inp_m_syukei_no != "") {
                $sql .= "AND m_syukei_no = '" . $db->escape_string($this->inp_m_syukei_no) . "' ";
            }
            if ($this->inp_m_syukei_nengetu != "") {
                $sql .= "AND m_syukei_nengetu = '" . $db->escape_string($this->inp_m_syukei_nengetu). "' ";
            }
            //if ($this->inp_m_tuti_endday != "") {
            //    $sql .= "AND m_tuti_endday = '" . $db->escape_string(substr($this->inp_m_tuti_endday,0,4)."-".substr($this->inp_m_tuti_endday,4,2)."-".substr($this->inp_m_tuti_endday,6,2)) . "' ";
            //}
            //if ($this->inp_m_tuti_day != "") {
            //    $sql .= "AND (m_tuti_startday <= '" . $db->escape_string(substr($this->inp_m_tuti_day,0,4)."-".substr($this->inp_m_tuti_day,4,2)."-".substr($this->inp_m_tuti_day,6,2)) . "' && m_tuti_startday != '0000-00-00')";
            //    $sql .= "AND (m_tuti_endday >= '" . $db->escape_string(substr($this->inp_m_tuti_day,0,4)."-".substr($this->inp_m_tuti_day,4,2)."-".substr($this->inp_m_tuti_day,6,2)) . "' && m_tuti_endday != '0000-00-00')";
            //}
            if ($this->inp_order == "") {
                $sql .= "ORDER BY m_syukei_no  ";
            } else {
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

                    $this->oup_m_syukei_no[]           = $row[$i++];
                    $this->oup_m_syukei_nengetu[]            = $row[$i++];
                    $this->oup_m_syukei_plan_total[]            = $row[$i++];
                    $this->oup_m_syukei_plan_day_total[]            = $row[$i++];
                    $this->oup_m_syukei_created[]            = $row[$i++];
	                $this->oup_m_syukei_created_id[]         = $row[$i++];
	                $this->oup_m_syukei_modified[]           = $row[$i++];
	                $this->oup_m_syukei_modified_id[]        = $row[$i++];

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
        public function insertSyukei()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_syukei "
                 . "( "
                 . "    m_syukei_no "
	             . ",   m_syukei_nengetu "
	             . ",   m_syukei_plan_total "
	             . ",   m_syukei_plan_day_total "
	             . ",   m_syukei_created "
	             . ",   m_syukei_created_id "
	             . ",   m_syukei_modified "
	             . ",   m_syukei_modified_id "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_m_syukei_no."'"
                 . ",    '".$this->inp_m_syukei_nengetu."'"
                 . ",    '".$this->inp_m_syukei_plan_total."'"
                 . ",    '".$this->inp_m_syukei_plan_day_total."'"
                 . ",    '".$this->inp_m_syukei_created."'"
                 . ",    '".$this->inp_m_syukei_created_id."'"
                 . ",    '".$this->inp_m_syukei_modified."'"
                 . ",    '".$this->inp_m_syukei_modified_id."'"
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
        public function updateSyukei()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_syukei SET "
                 //. "    m_syukei_no                     = '" . $this->inp_m_syukei_no . "' ";
                 . "    m_syukei_nengetu                     = '" . $this->inp_m_syukei_nengetu . "' ";
            if ($this->inp_m_syukei_nengetu != "") {
                $sql .= ",   m_syukei_nengetu            = '" . $this->inp_m_syukei_nengetu . "' ";
            }
            if (!is_null($this->inp_m_syukei_plan_total)) {
                $sql .= ",   m_syukei_plan_total            = '" . $this->inp_m_syukei_plan_total . "' ";
            }
            if (!is_null($this->inp_m_syukei_plan_day_total)) {
                $sql .= ",   m_syukei_plan_day_total            = '" . $this->inp_m_syukei_plan_day_total . "' ";
            }
            if ($this->inp_m_syukei_modified != "") {
                $sql .= ",   m_syukei_modified            = '" . $this->inp_m_syukei_modified . "' ";
            }
            if ($this->inp_m_syukei_modified_id != "") {
                $sql .= ",   m_syukei_modified_id            = '" . $this->inp_m_syukei_modified_id . "' ";
            }
            
            $sql .= "WHERE 0 = 0 ";
            //$sql .= "AND m_syukei_no        = '" . $db->escape_string($this->inp_m_syukei_no) . "' ";
            $sql .= "AND m_syukei_nengetu        = '" . $db->escape_string($this->inp_m_syukei_nengetu) . "' ";

             //var_dump($sql);

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
        public function deleteSyukei()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_syukei "
                 . "WHERE ";
            $sql .= "    m_syukei_no = '" . $db->escape_string($this->inp_m_syukei_no). "' ";
            //$sql .= "AND m_syukei_nengetu      = '" . $db->escape_string($this->inp_m_syukei_nengetu). "' ";

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
