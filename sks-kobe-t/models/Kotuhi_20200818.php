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
        
        public $inp_m_kotuhi_startday = null;

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

            if ($this->inp_m_kotuhi_startday == "") {
                $sql = "SELECT "
                     .     "m_kotuhi_no "
                     . ",   m_kotuhi_staff_id "
                     . ",   m_kotuhi_staff_name "
                     . ",   m_kotuhi_place_id "
                     . ",   m_kotuhi_place "
                     . ",   m_kotuhi_kikan "
                     . ",   m_kotuhi_from "
                     . ",   m_kotuhi_to "
                     . ",   m_kotuhi_hosoku "
                     . ",   m_kotuhi_cost "
                     . ",   m_kotuhi_startday "
                     . ",   m_kotuhi_created "
                     . ",   m_kotuhi_created_id "
                     . ",   m_kotuhi_modified "
                     . ",   m_kotuhi_modified_id "
                     . "FROM "
                     .     "m_kotuhi ";
                     if ($this->inp_join_m_staff != "") {
                        $sql .= "join m_staff on m_kotuhi.m_kotuhi_staff_id = m_staff.m_staff_id ";
                     }
                     $sql .= "WHERE 0 = 0 ";
            } else {
                $sql  = "SELECT ";
                $sql .= "mk1.m_kotuhi_no ";
                $sql .= ",mk1.m_kotuhi_staff_id ";
                $sql .= ",mk1.m_kotuhi_place_id ";
                $sql .= ",mk1.m_kotuhi_cost ";
                $sql .= ",mk1.m_kotuhi_hosoku ";
                $sql .= "FROM ";
                $sql .= "m_kotuhi mk1 ";
                $sql .= "inner join ";
                $sql .= "( ";
                $sql .= "SELECT ";
                $sql .= "m_kotuhi_staff_id ";
                $sql .= ",m_kotuhi_place_id ";
                $sql .= ",m_kotuhi_hosoku ";
                $sql .= ",max(m_kotuhi_startday) as m_kotuhi_startday ";
                $sql .= "FROM ";
                $sql .= "m_kotuhi ";
                $sql .= "WHERE ";
                $sql .= "m_kotuhi_startday <= '" . $db->escape_string($this->inp_m_kotuhi_startday) . "' ";
                $sql .= "group by  ";
                $sql .= "m_kotuhi_staff_id ";
                $sql .= ",m_kotuhi_place_id ";
                $sql .= ",m_kotuhi_hosoku ";
                $sql .= ") mk2 ";
                $sql .= "on mk1.m_kotuhi_staff_id = mk2.m_kotuhi_staff_id ";
                $sql .= "and mk1.m_kotuhi_place_id = mk2.m_kotuhi_place_id ";
                $sql .= "and mk1.m_kotuhi_startday = mk2.m_kotuhi_startday ";
                $sql .= "and mk1.m_kotuhi_hosoku = mk2.m_kotuhi_hosoku ";
            }

            if ($this->inp_m_kotuhi_no != "") {
                $sql .= "AND m_kotuhi_no = '" . $db->escape_string($this->inp_m_kotuhi_no) . "' ";
            }
            if ($this->inp_m_kotuhi_staff_id != "") {
                $sql .= "AND m_kotuhi_staff_id = '" . $db->escape_string($this->inp_m_kotuhi_staff_id) . "' ";
            }
            if ($this->inp_m_work_type_item_cd != "") {
                $sql .= "AND m_work_type_item_cd = '" . $db->escape_string($this->inp_m_work_type_item_cd) . "' ";
            }
            if ($this->inp_order == "") {
                $sql .= "order by m_kotuhi_staff_name ";
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

                    if ($this->inp_m_kotuhi_startday == "") {

                        $this->oup_m_kotuhi_no[]               = $row[$i++];
                        $this->oup_m_kotuhi_staff_id[]         = $row[$i++];
                        $this->oup_m_kotuhi_staff_name[]       = $row[$i++];
                        $this->oup_m_kotuhi_place_id[]         = $row[$i++];
                        $this->oup_m_kotuhi_place[]            = $row[$i++];
                        $this->oup_m_kotuhi_kikan[]            = $row[$i++];
                        $this->oup_m_kotuhi_from[]             = $row[$i++];
                        $this->oup_m_kotuhi_to[]               = $row[$i++];
                        $this->oup_m_kotuhi_hosoku[]               = $row[$i++];
                        $this->oup_m_kotuhi_cost[]             = $row[$i++];
                        $this->oup_m_kotuhi_startday[]         = $row[$i++];
                        $this->oup_m_kotuhi_created[]          = $row[$i++];
                        $this->oup_m_kotuhi_created_id[]       = $row[$i++];
                        $this->oup_m_kotuhi_modified[]         = $row[$i++];
                        $this->oup_m_kotuhi_modified_id[]      = $row[$i++];

                    } else {

                        $this->oup_m_kotuhi_no[]               = $row[$i++];
                        $this->oup_m_kotuhi_staff_id[]         = $row[$i++];
                        $this->oup_m_kotuhi_place_id[]         = $row[$i++];
                        $this->oup_m_kotuhi_cost[]             = $row[$i++];
                        $this->oup_m_kotuhi_hosoku[]           = $row[$i++];

                    }

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
                 . ",   m_kotuhi_staff_name "
                 . ",   m_kotuhi_place_id "
                 . ",   m_kotuhi_place "
                 . ",   m_kotuhi_kikan "
                 . ",   m_kotuhi_from "
                 . ",   m_kotuhi_to "
                 . ",   m_kotuhi_hosoku "
                 . ",   m_kotuhi_cost "
                 . ",   m_kotuhi_startday "
                 . ",   m_kotuhi_created "
                 . ",   m_kotuhi_created_id "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_m_kotuhi_staff_id."'"
                 . ",    '".$this->inp_m_kotuhi_staff_name."'"
                 . ",    '".$this->inp_m_kotuhi_place_id."'"
                 . ",    '".$this->inp_m_kotuhi_place."'"
                 . ",    '".$this->inp_m_kotuhi_kikan."'"
                 . ",    '".$this->inp_m_kotuhi_from."'"
                 . ",    '".$this->inp_m_kotuhi_to."'"
                 . ",    '".$this->inp_m_kotuhi_hosoku."'"
                 . ",    '".$this->inp_m_kotuhi_cost."'"
                 . ",    '".$this->inp_m_kotuhi_startday."'"
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
            if ($this->inp_m_kotuhi_staff_name != "") {
                $sql .= ",   m_kotuhi_staff_name            = '" . $this->inp_m_kotuhi_staff_name . "' ";
            }
            if ($this->inp_m_kotuhi_place_id != "") {
                $sql .= ",   m_kotuhi_place_id               = '" . $this->inp_m_kotuhi_place_id . "' ";
            }
            if ($this->inp_m_kotuhi_place != "") {
                $sql .= ",   m_kotuhi_place               = '" . $this->inp_m_kotuhi_place . "' ";
            }
            if ($this->inp_m_kotuhi_hosoku != "") {
                $sql .= ",   m_kotuhi_hosoku               = '" . $this->inp_m_kotuhi_hosoku . "' ";
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
            if (!is_null($this->inp_m_kotuhi_startday)) {
                $sql .= ",   m_kotuhi_startday    = '" . $this->inp_m_kotuhi_startday . "' ";
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
