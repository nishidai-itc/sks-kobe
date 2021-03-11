<?php

    // シフトクラス
    class Shift
    {
        // 変数の宣言
        public $inp_m_shift_no;
        public $inp_m_shift_plan_kbn;
        public $inp_m_shift_plan_hosoku = null;
        public $inp_m_shift_genba_id;
        public $inp_m_shift_joban_time;
        public $inp_m_shift_kaban_time;
        public $inp_order;

        public $oup_m_shift_no;
        public $oup_m_shift_plan_kbn;
        public $oup_m_shift_plan_hosoku;
        public $oup_m_shift_genba_id;
        public $oup_m_shift_joban_time;
        public $oup_m_shift_kaban_time;
        
        public $inp_m_shift_deleteday = null;
        public $oup_m_shift_deleteday;

        public $kbn  = array("1" => "泊","2" => "日","3" => "夜", "4" => "年", "5" => "欠", "6" => "時");
        public $kbn2 = array("1" => "泊","2" => "日勤","3" => "夜勤", "4" => "年休", "5" => "欠勤", "6" => "時給");

        // 入力チェック
        public function inputCheck()
        {
        }

        // セレクト
        public function getShift()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_shift_no "
                 . ",   m_shift_plan_kbn "
                 . ",   m_shift_plan_hosoku "
                 . ",   m_shift_color "
                 . ",   m_shift_genba_id "
                 . ",   HOUR(m_shift_joban_time) "
                 . ",   MINUTE(m_shift_joban_time) "
                 . ",   HOUR(m_shift_kaban_time) "
                 . ",   MINUTE(m_shift_kaban_time) "
                 . ",   m_shift_kyukei_start "
                 . ",   m_shift_kyukei_end "
                 . ",   m_shift_jikyu "
                 . ",   m_shift_nikyu "
                 . ",   m_shift_rodo_time "
                 . ",   m_shift_over_time "
                 . ",   m_shift_kyukei_time "
                 . ",   m_shift_created "
                 . ",   m_shift_created_id "
                 . ",   m_shift_modified "
                 . ",   m_shift_modified_id "
                 . ",   m_shift_deleteday "
                 . "FROM "
                 .     "m_shift ";
                 if ($this->inp_left_join_m_genba != "") {
                    $sql .= "left join m_genba on m_shift.m_shift_genba_id = m_genba.m_genba_id ";
                 }
                 $sql .= "WHERE 0 = 0 ";

            if ($this->inp_m_shift_no != "") {
                $sql .= "AND m_shift_no = '" . $db->escape_string($this->inp_m_shift_no) . "' ";
            }
            if ($this->inp_m_shift_genba_id != "") {
                $sql .= "AND m_shift_genba_id = '" . $db->escape_string($this->inp_m_shift_genba_id) . "' ";
            }
            if ($this->inp_m_shift_genba_id2 != "") {
                $sql .= "AND m_shift_genba_id in (" . $this->inp_m_shift_genba_id2 . ",'9999' )";
            }
            if ($this->inp_m_shift_genba_id3 != "") {
                $sql .= "AND m_shift_genba_id in (" . $this->inp_m_shift_genba_id3 . ")";
            }
            if ($this->inp_m_shift_genba_id4 != "") {
                $sql .= "AND m_shift_genba_id != '" . $db->escape_string($this->inp_m_shift_genba_id4) . "' ";
            }
            //if ($this->inp_m_shift_genba_id5 != "") {
            //    $sql .= "AND m_shift_genba_id not in (" . $this->inp_m_shift_genba_id5 . ") ";
            //}
            if ($this->inp_m_shift_joban_time != "") {
                $sql .= "AND m_shift_joban_time = '" . $db->escape_string($this->inp_m_shift_joban_time) . "' ";
            }
            if ($this->inp_m_shift_kaban_time != "") {
                $sql .= "AND m_shift_kaban_time = '" . $db->escape_string($this->inp_m_shift_kaban_time) . "' ";
            }
            if ($this->inp_m_shift_plan_kbn != "") {
                $sql .= "AND m_shift_plan_kbn = '" . $db->escape_string($this->inp_m_shift_plan_kbn) . "' ";
            }
            if ($this->inp_m_shift_plan_kbn2 != "") {
                $sql .= "AND m_shift_plan_kbn in (" . $db->escape_string($this->inp_m_shift_plan_kbn2) . ") ";
            }
            if (!(is_null($this->inp_m_shift_plan_hosoku))) {
                $sql .= "AND m_shift_plan_hosoku = '" . $db->escape_string($this->inp_m_shift_plan_hosoku) . "' ";
            }
            if ($this->inp_m_shift_free != "") {
                $sql .= $this->inp_m_shift_free;
            }
            if ($this->inp_m_shift_deleteday != "") {
            
                $del_genba     = new Genba;
                $del_genba->inp_m_genba_deleteday2 = $db->escape_string($this->inp_m_shift_deleteday);
                $del_genba->getGenba();
                
                if ($del_genba->oup_m_genba_id && count($del_genba->oup_m_genba_id) != 0) {
                // if (count($del_genba->oup_m_genba_id) != 0) {
                    $m_shift_genba_id = "'".$del_genba->oup_m_genba_id[0]."'";
                    for ($i=0;$i<count($del_genba->oup_m_genba_id);$i++) {
                        $m_shift_genba_id = $m_shift_genba_id.",'".$del_genba->oup_m_genba_id[$i]."'";
                    }
                    $sql .= "AND m_shift_genba_id not in (" . $m_shift_genba_id . ") ";
                }
                
                if ($this->inp_m_shift_deleteday == 1) {
                    $today = date('Ymd');
                    $sql .= "AND (m_shift_deleteday >= $today or m_shift_deleteday is null)";
                } else {
                    $sql .= "AND (m_shift_deleteday >= '" . substr($db->escape_string($this->inp_m_shift_deleteday),0,4) ."-".substr($db->escape_string($this->inp_m_shift_deleteday),4,2)."-".substr($db->escape_string($this->inp_m_shift_deleteday),6,2). "' or m_shift_deleteday is null)";
                }
            }
            if ($this->inp_m_group != "") {
                $sql .= "order by m_shift_no desc limit 1 ";
            } else {
            if ($this->inp_order == "") {
                $sql .= "order by m_shift_genba_id,m_shift_plan_kbn,m_shift_joban_time ";
            } else {
                $sql .= $db->escape_string($this->inp_order);
            }
            }
            

            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_m_shift_no[]             = $row[$i++];
                    $this->oup_m_shift_plan_kbn[]       = $row[$i++];
                    $this->oup_m_shift_plan_hosoku[]    = $row[$i++];
                    $this->oup_m_shift_color[]          = $row[$i++]; // 背景カラー
                    $this->oup_m_shift_genba_id[]       = $row[$i++];
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    $this->oup_m_shift_joban_time[]     = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    $this->oup_m_shift_kaban_time[]     = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    $this->oup_m_shift_kyukei_start[]   = $row[$i++];
                    $this->oup_m_shift_kyukei_end[]     = $row[$i++];
                    $this->oup_m_shift_jikyu[]          = $row[$i++];
                    $this->oup_m_shift_nikyu[]          = $row[$i++];
                    $this->oup_m_shift_rodo_time[]      = $row[$i++];
                    $this->oup_m_shift_over_time[]      = $row[$i++]; // 残業時間
                    $this->oup_m_shift_kyukei_time[]    = $row[$i++]; // 休憩時間
                    $this->oup_m_shift_created[]        = $row[$i++];
                    $this->oup_m_shift_created_id[]     = $row[$i++];
                    $this->oup_m_shift_modified[]       = $row[$i++];
                    $this->oup_m_shift_modified_id[]    = $row[$i++];
                    $this->oup_m_shift_deleteday[]    = $row[$i++];

                    // var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }

            return $result;
        }

        // インサート
        public function insertShift()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_shift "
                 . "( "
                 .     "m_shift_plan_kbn "
                 . ",   m_shift_plan_hosoku "
                 . ",   m_shift_color "       // 背景カラー
                 . ",   m_shift_genba_id "
                 . ",   m_shift_joban_time "
                 . ",   m_shift_kaban_time "
                 . ",   m_shift_kyukei_start "
                 . ",   m_shift_kyukei_end "
                 . ",   m_shift_jikyu "
                 . ",   m_shift_nikyu "
                 . ",   m_shift_rodo_time "
                 . ",   m_shift_over_time "    // 残業時間
                 . ",   m_shift_kyukei_time "  // 休憩時間
                 . ",   m_shift_created "
                 . ",   m_shift_created_id "
                 . ",   m_shift_modified "
                 . ",   m_shift_modified_id "
                 . ",   m_shift_deleteday "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_m_shift_plan_kbn."'"
                 . ",    '".$this->inp_m_shift_plan_hosoku."'"
                 . ",    '".$this->inp_m_shift_color."'"        // 背景カラー
                 . ",    '".$this->inp_m_shift_genba_id."'"
                 . ",    '".$this->inp_m_shift_joban_time."'"
                 . ",    '".$this->inp_m_shift_kaban_time."'"
                 . ",    '".$this->inp_m_shift_kyukei_start."'"
                 . ",    '".$this->inp_m_shift_kyukei_end."'"
                 . ",    '".$this->inp_m_shift_jikyu."'"
                 . ",    '".$this->inp_m_shift_nikyu."'"
                 . ",    '".$this->inp_m_shift_rodo_time."'"
                 . ",    '".$this->inp_m_shift_over_time."'"    // 残業時間
                 . ",    '".$this->inp_m_shift_kyukei_time."'"  // 休憩時間
                 . ",    '".$this->inp_m_shift_created."'"
                 . ",    '".$this->inp_m_shift_created_id."'"
                 . ",    '".$this->inp_m_shift_modified."'"
                 . ",    '".$this->inp_m_shift_modified_id."'"
                 . ",    '".$this->inp_m_shift_deleteday."'"
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
        public function updateShift()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_shift SET ";
            if ($this->inp_m_shift_plan_kbn != "") {
                $sql .= "   m_shift_plan_kbn = '" . $db->escape_string($this->inp_m_shift_plan_kbn) . "' ";
            }
            if ($this->inp_m_shift_plan_hosoku != "") {
            if ($this->inp_m_shift_plan_hosoku == "null") {
                $sql .= ",  m_shift_plan_hosoku = '' ";
            } else {
                $sql .= ",  m_shift_plan_hosoku = '" . $db->escape_string($this->inp_m_shift_plan_hosoku) . "' ";
            }
            }
            if ($this->inp_m_shift_color != "") {
                $sql .= ",  m_shift_color = '" . $db->escape_string($this->inp_m_shift_color) . "' ";
            }
            if ($this->inp_m_shift_genba_id != "") {
                $sql .= ",   m_shift_genba_id = '" . $db->escape_string($this->inp_m_shift_genba_id) . "' ";
            }
            if ($this->inp_m_shift_joban_time != "") {
                $sql .= ",   m_shift_joban_time = '" . $db->escape_string($this->inp_m_shift_joban_time) . "' ";
            }
            if ($this->inp_m_shift_kaban_time != "") {
                $sql .= ",   m_shift_kaban_time = '" . $db->escape_string($this->inp_m_shift_kaban_time) . "' ";
            }
            if ($this->inp_m_shift_kyukei_start != "") {
                $sql .= ",   m_shift_kyukei_start = '" . $db->escape_string($this->inp_m_shift_kyukei_start) . "' ";
            }
            if ($this->inp_m_shift_kyukei_end != "") {
                $sql .= ",   m_shift_kyukei_end = '" . $db->escape_string($this->inp_m_shift_kyukei_end) . "' ";
            }
            if ($this->inp_m_shift_jikyu != "") {
                $sql .= ",   m_shift_jikyu = '" . $db->escape_string($this->inp_m_shift_jikyu) . "' ";
            }
            if ($this->inp_m_shift_nikyu != "") {
                $sql .= ",   m_shift_nikyu = '" . $db->escape_string($this->inp_m_shift_nikyu) . "' ";
            }
            if ($this->inp_m_shift_rodo_time != "") {
                $sql .= ",   m_shift_rodo_time = '" . $db->escape_string($this->inp_m_shift_rodo_time) . "' ";
            }
            if ($this->inp_m_shift_over_time != "") {
                $sql .= ",   m_shift_over_time = '" . $db->escape_string($this->inp_m_shift_over_time) . "' ";
            }
            if ($this->inp_m_shift_kyukei_time != "") {
                $sql .= ",   m_shift_kyukei_time = '" . $db->escape_string($this->inp_m_shift_kyukei_time) . "' ";
            }
            if ($this->inp_m_shift_modified != "") {
                $sql .= ",   m_shift_modified = '" . $db->escape_string($this->inp_m_shift_modified) . "' ";
            }
            if ($this->inp_m_shift_modified_id != "") {
                $sql .= ",   m_shift_modified_id = '" . $db->escape_string($this->inp_m_shift_modified_id) . "' ";
            }
            if (!is_null($this->inp_m_shift_deleteday)) {
                $sql .= ",   m_shift_deleteday = '" . $db->escape_string($this->inp_m_shift_deleteday) . "' ";
            }
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND m_shift_no = " . $db->escape_string($this->inp_m_shift_no2) . " ";

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
        public function deleteShift()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql  = "DELETE FROM m_shift ";
            $sql .= "WHERE m_shift_no = '" . $db->escape_string($this->inp_m_shift_no) . "' ";

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
