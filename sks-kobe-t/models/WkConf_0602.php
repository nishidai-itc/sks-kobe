<?php 

    // 作業実施テーブルクラス
    class WkConf
    {
        // 変数の宣言
        public $inp_t_wk_no;
        public $inp_t_wk_office_id;
        public $inp_t_wk_genba_id = NULL;
        public $inp_t_wk_taiin_id;
        public $inp_t_wk_plan_date;
        public $inp_t_wk_plan_start_date;
        public $inp_t_wk_plan_end_date;
        public $inp_t_wk_plan_kbn;
        public $inp_t_wk_plan_joban_time;
        public $inp_t_wk_plan_kaban_time;
        public $inp_t_wk_hokoku_id;
        public $inp_t_wk_joban_kbn;
        public $inp_t_wk_joban_time;
        public $inp_t_wk_kaban_kbn;
        public $inp_t_wk_kaban_time;
        public $inp_t_wk_kotuhi;
        public $inp_t_wk_post_teate;
        public $inp_t_wk_kiken_teate;
        public $inp_t_wk_rest_reason;
        public $inp_t_wk_del_flg;
        public $inp_t_wk_created;
        public $inp_t_wk_created_id;
        public $inp_t_wk_modified;
        public $inp_t_wk_modified_id;

        public $inp_t_wk_plan_month;

        public $oup_t_wk_no;
        public $oup_t_wk_office_id;
        public $oup_t_wk_genba_id;
        public $oup_t_wk_taiin_id;
        public $oup_t_wk_plan_date;
        public $oup_t_wk_plan_kbn;
        public $oup_t_wk_plan_joban_time;
        public $oup_t_wk_plan_kaban_time;
        public $oup_t_wk_hokoku_id;
        public $oup_t_wk_joban_kbn;
        public $oup_t_wk_joban_time;
        public $oup_t_wk_kaban_kbn;
        public $oup_t_wk_kaban_time;
        public $oup_t_wk_kotuhi;
        public $oup_t_wk_post_teate;
        public $oup_t_wk_kiken_teate;
        public $oup_t_wk_rest_reason;
        public $oup_t_wk_del_flg;
        public $oup_t_wk_created;
        public $oup_t_wk_created_id;
        public $oup_t_wk_modified;
        public $oup_t_wk_modified_id;

        public $oup_t_wk_plan_month;
        public $oup_m_genba_name;

        // 入力チェック
        public function inputCheck() {
        }

        // セレクト
        public function getWk() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_no "
                 . ",   t_wk_nengetu "
                 . ",   t_wk_genba_id "
                 . ",   t_wk_taiin_id "
                 . ",   t_wk_order "
                 . ",   t_wk_del_flg "
                 . ",   t_wk_created "
                 . ",   t_wk_created_id "
                 . ",   t_wk_modified "
                 . ",   t_wk_modified_id "
                 . "FROM "
                 .     "t_wk "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_no != "") {
                $sql .= "AND t_wk_no = " . $db->escape_string($this->inp_t_wk_no) . " ";
            }
            if ($this->inp_t_wk_nengetu != "") {
                $sql .= "AND t_wk_nengetu = '" . $db->escape_string($this->inp_t_wk_nengetu) . "' ";
            }
            if (!(is_null($this->inp_t_wk_genba_id))) {
                $sql .= "AND t_wk_genba_id = '" . $db->escape_string($this->inp_t_wk_genba_id) . "' ";
            }
            if ($this->inp_t_wk_taiin_id != "") {
                $sql .= "AND t_wk_taiin_id = '" . $db->escape_string($this->inp_t_wk_taiin_id) . "' ";
            }
            if ($this->inp_t_wk_del_flg != "") {
                $sql .= "AND t_wk_del_flg = '" . $db->escape_string($this->inp_t_wk_del_flg) . "' ";
            }

            // 条件がなかったらSQLを実効しない
            if (substr($sql, -12, 12) == "WHERE 0 = 0 ") {
                return;
            }

            if ($this->inp_order == "") {
                $sql .= "ORDER BY t_wk_order  ";
            } else {
                $sql .= $db->escape_string($this->inp_order);
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_wk_no[]              = $row[$i++];
                    $this->oup_t_wk_nengetu[]         = $row[$i++];
                    $this->oup_t_wk_genba_id[]        = $row[$i++];
                    $this->oup_t_wk_taiin_id[]        = $row[$i++];
                    $this->oup_t_wk_order[]           = $row[$i++];
                    $this->oup_t_wk_del_flg[]         = $row[$i++];
                    $this->oup_t_wk_created[]         = $row[$i++];
                    $this->oup_t_wk_created_id[]      = $row[$i++];
                    $this->oup_t_wk_modified[]        = $row[$i++];
                    $this->oup_t_wk_modified_id[]     = $row[$i++];

//var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
// var_dump($result);

            return $this->result;

            // MySQLへの接続を閉じる
            $db->close();

        }

        // セレクト
        public function getWkservice() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_service_no "
                 . ",   t_wk_service_type_cd "
                 . ",   t_wk_service_type_item_cd "
                 . ",   t_wk_service_time "
                 . ",   t_wk_service_created "
                 . ",   t_wk_service_created_staffid "
                 . ",   t_wk_service_modified "
                 . ",   t_wk_service_modified_staffid "
                 . "FROM "
                 .     "t_wk_service "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_service_no != "") {
                $sql .= "AND t_wk_service_no = " . $db->escape_string($this->inp_t_wk_service_no) . " ";
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

                    $this->oup_t_wk_service_no[$row[0].$row[1].$row[2]]                  = $row[$i++];
                    $this->oup_t_wk_service_type_cd[$row[0].$row[1].$row[2]]             = $row[$i++];
                    $this->oup_t_wk_service_type_item_cd[$row[0].$row[1].$row[2]]        = $row[$i++];
                    $this->oup_t_wk_service_time[$row[0].$row[1].$row[2]]                = $row[$i++];
                    $this->oup_t_wk_service_created[$row[0].$row[1].$row[2]]             = $row[$i++];
                    $this->oup_t_wk_service_created_staffid[$row[0].$row[1].$row[2]]     = $row[$i++];
                    $this->oup_t_wk_service_modified[$row[0].$row[1].$row[2]]            = $row[$i++];
                    $this->oup_t_wk_service_modified_staffid[$row[0].$row[1].$row[2]]    = $row[$i++];

// var_dump($row);
// var_dump($this->oup_t_wk_service_time);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
// var_dump($result);

            return $this->result;

            // MySQLへの接続を閉じる
            $db->close();

        }

        // セレクト
        public function getWkservice2() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_service_no "
                 . ",   t_wk_service_type_cd "
                 . ",   t_wk_service_type_item_cd "
                 . ",   t_wk_service_time "
                 . ",   t_wk_service_content "
                 . ",   t_wk_service_created "
                 . ",   t_wk_service_created_staffid "
                 . ",   t_wk_service_modified "
                 . ",   t_wk_service_modified_staffid "
                 . "FROM "
                 .     "t_wk_service "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_service_no != "") {
                $sql .= "AND t_wk_service_no = " . $db->escape_string($this->inp_t_wk_service_no) . " ";
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_wk_service_no[]                  = $row[$i++];
                    $this->oup_t_wk_service_type_cd[]             = $row[$i++];
                    $this->oup_t_wk_service_type_item_cd[]        = $row[$i++];
                    $this->oup_t_wk_service_time[]                = $row[$i++];
                    $this->oup_t_wk_service_content[]             = $row[$i++];
                    $this->oup_t_wk_service_created[]             = $row[$i++];
                    $this->oup_t_wk_service_created_staffid[]     = $row[$i++];
                    $this->oup_t_wk_service_modified[]            = $row[$i++];
                    $this->oup_t_wk_service_modified_staffid[]    = $row[$i++];

// var_dump($row);
// var_dump($this->oup_t_wk_service_time);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
// var_dump($result);

            return $this->result;

            // MySQLへの接続を閉じる
            $db->close();

        }

        // セレクト
        public function getWkPlan() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_no "
                 . ",   t_wk_office_id "
                 . ",   t_wk_genba_id "
                 . ",   m_genba_name "
                 . ",   t_wk_taiin_id "
                 . ",   t_wk_plan_date "
                 . ",   t_wk_plan_kbn "
                 . ",   t_wk_plan_joban_time "
                 . ",   t_wk_plan_kaban_time "
                 . ",   t_wk_del_flg "
                 . ",   t_wk_created "
                 . ",   t_wk_created_id "
                 . ",   t_wk_modified "
                 . ",   t_wk_modified_id "
                 . "FROM "
                 .     "t_wk "
                 . "INNER JOIN m_genba ON t_wk_genba_id = m_genba_id AND m_genba_del_flg = '0' "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_no != "") {
                $sql .= "AND t_wk_no = " . $db->escape_string($this->inp_t_wk_no) . " ";
            }
            if ($this->inp_t_wk_office_id != "") {
                $sql .= "AND t_wk_office_id = " . $db->escape_string($this->inp_t_wk_office_id) . " ";
            }
            if ($this->inp_t_wk_genba_id != "") {
                $sql .= "AND t_wk_genba_id = " . $db->escape_string($this->inp_t_wk_genba_id) . " ";
            }
            if ($this->inp_t_wk_genba_name != "") {
                $sql .= "AND m_genba_name LIKE '%" . $db->escape_string($this->inp_m_genba_name) . "%' ";
            }
            if ($this->inp_t_wk_taiin_id != "") {
                $sql .= "AND t_wk_taiin_id = '" . $db->escape_string($this->inp_t_wk_taiin_id) . "' ";
            }
            if ($this->inp_t_wk_plan_month != "") {
                $sql .= "AND DATE_FORMAT(t_wk_plan_date,'%Y%m') = '" . $db->escape_string($this->inp_t_wk_plan_month) . "' ";
            }
            if ($this->inp_t_wk_plan_date != "") {
                $sql .= "AND t_wk_plan_date = '" . substr($db->escape_string($this->inp_t_wk_plan_date),0,4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date),4,2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date),6,2) . "' ";
            }
            if ($this->inp_t_wk_plan_kbn != "") {
                $sql .= "AND t_wk_plan_kbn = '" . $db->escape_string($this->inp_t_wk_plan_kbn) . "' ";
            }
            if ($this->inp_t_wk_plan_joban_time != "") {
                $sql .= "AND t_wk_plan_joban_time = '" . $db->escape_string($this->inp_t_wk_plan_joban_time) . "' ";
            }
            if ($this->inp_t_wk_plan_kaban_time != "") {
                $sql .= "AND t_wk_plan_kaban_time = '" . $db->escape_string($this->inp_t_wk_plan_kaban_time) . "' ";
            }

            if (substr($sql, -12, 12) == "WHERE 0 = 0 ") {
                return;
            }

            if ($this->inp_order == "") {
                $sql .= "ORDER BY t_wk_plan_date, t_wk_plan_joban_time, t_wk_taiin_id  ";
            } else {
                $sql .= $db->escape_string($this->inp_order);
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);
            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_wk_no[]              = $row[$i++];
                    $this->oup_t_wk_office_id[]       = $row[$i++];
                    $this->oup_t_wk_genba_id[]        = $row[$i++];
                    $this->oup_m_genba_name[]           = $row[$i++];
                    $this->oup_t_wk_taiin_id[]        = $row[$i++];
                    $this->oup_t_wk_plan_date[]       = $row[$i++];
                    $this->oup_t_wk_plan_kbn[]        = $row[$i++];
                    $this->oup_t_wk_plan_joban_time[] = $row[$i++];
                    $this->oup_t_wk_plan_kaban_time[] = $row[$i++];
                    $this->oup_t_wk_del_flg[]         = $row[$i++];
                    $this->oup_t_wk_created[]         = $row[$i++];
                    $this->oup_t_wk_created_id[]      = $row[$i++];
                    $this->oup_t_wk_modified[]        = $row[$i++];
                    $this->oup_t_wk_modified_id[]     = $row[$i++];

//var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
// var_dump($result);

            return $this->result;

            // MySQLへの接続を閉じる
            $db->close();

        }

        public function getWkdaysum() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "count(t_wk_no) as cnt "
                 . ",   sum(t_wk_run_time) as cnt "
                 . ",   DATE_FORMAT(t_wk_run_start_date ,'%Y年%m月%d日') as day1 "
                 . ",   DATE_FORMAT(t_wk_run_start_date ,'%Y%m%d') as day2 "
                 . "FROM "
                 .     "t_wk "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_visitor_id != "") {
                $sql .= "AND t_wk_visitor_id = '" . $db->escape_string($this->inp_t_wk_visitor_id) . "' ";
            }
            if ($this->inp_t_wk_run_start_month != "") {
                $sql .= "AND t_wk_run_start_date between '" . substr($db->escape_string($this->inp_t_wk_run_start_month),0,4) . "-" . substr($db->escape_string($this->inp_t_wk_run_start_month),4,2) . "-01' and '".date('Y-m-d', mktime(0, 0, 0, substr($db->escape_string($this->inp_t_wk_run_start_month),4,2) + 1 , 0, date('Y')))."' ";
            }
            $sql .= "GROUP BY ";
            $sql .= "    day1 ";
            $sql .= "ORDER BY ";
            $sql .= "    day2 DESC ";

            // SQL実行

            // 文字化け防止
            $db->set_charset();

//  var_dump($sql);

            // プリペアドクエリを実行する
//            $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_wk_day_cnt[]                = $row[$i++];
                    $this->oup_t_wk_daytime[]                = $row[$i++];
                    $this->oup_t_wk_day1[]                   = $row[$i++];
                    $this->oup_t_wk_day2[]                   = $row[$i++];

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

        public function getWkPlandaysum() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "count(t_wk_no) as cnt "
                 . ",   sum((substr(t_wk_plan_end_time,1,2)*60+substr(t_wk_plan_end_time,3,2))-(substr(t_wk_plan_start_time,1,2)*60+substr(t_wk_plan_start_time,3,2))) as cnt "
                 . ",   concat(DATE_FORMAT(t_wk_plan_start_date ,'%c月%e日'),\"(\",ELT(WEEKDAY(t_wk_plan_start_date)+1,\"月\",\"火\",\"水\",\"木\",\"金\",\"土\",\"日\"),\")\") as day1 "
                 . ",   DATE_FORMAT(t_wk_plan_start_date ,'%Y%m%d') as day2 "
                 . "FROM "
                 .     "t_wk "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_plan_id != "") {
                $sql .= "AND t_wk_plan_id = '" . $db->escape_string($this->inp_t_wk_plan_id) . "' ";
            }
            if ($this->inp_t_wk_plan_start_month != "") {
                $sql .= "AND DATE_FORMAT(t_wk_plan_start_date,'%Y%m') = '" . $db->escape_string($this->inp_t_wk_plan_start_month) . "' ";
            }
            if ($this->inp_t_wk_plan_start_date != "") {
                $sql .= "AND (t_wk_plan_start_date >= '" . substr($db->escape_string($this->inp_t_wk_plan_start_date),0,4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_start_date),4,2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_start_date),6,2) . "' ";
                $sql .= "AND  t_wk_plan_start_date <= '" . substr($db->escape_string($this->inp_t_wk_plan_end_date),0,4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_end_date),4,2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_end_date),6,2) . "') ";
            }
            if ($this->inp_t_wk_delete_flg != "") {
                $sql .= "AND t_wk_delete_flg = '" . $db->escape_string($this->inp_t_wk_delete_flg) . "' ";
            }

            $sql .= "GROUP BY ";
            $sql .= "    day1 ";
            $sql .= "ORDER BY ";
            $sql .= "    day2 ";

            // SQL実行

            // 文字化け防止
            $db->set_charset();

//  var_dump($sql);

            // プリペアドクエリを実行する
//            $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_wk_day_cnt[]                = $row[$i++];
                    $this->oup_t_wk_daytime[]                = $row[$i++];
                    $this->oup_t_wk_day1[]                   = $row[$i++];
                    $this->oup_t_wk_day2[]                   = $row[$i++];

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

        public function getWkmonthsum() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "count(t_wk_no) as cnt "
                 . ",   sum(t_wk_run_time) as cnt "
                 . ",   DATE_FORMAT(t_wk_run_start_date ,'%Y年%m月') as month1 "
                 . ",   DATE_FORMAT(t_wk_run_start_date ,'%Y%m') as month2 "
                 . "FROM "
                 .     "t_wk "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_visitor_id != "") {
                $sql .= "AND t_wk_visitor_id = '" . $db->escape_string($this->inp_t_wk_visitor_id) . "' ";
            }

            $sql .= "GROUP BY ";
            $sql .= "    month1 ";
            $sql .= "ORDER BY ";
            $sql .= "    month2 ";

            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

            // プリペアドクエリを実行する
//            $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_wk_month_cnt[]                = $row[$i++];
                    $this->oup_t_wk_monthtime[]               = $row[$i++];
                    $this->oup_t_wk_month1[]                   = $row[$i++];
                    $this->oup_t_wk_month2[]                   = $row[$i++];

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

        public function getWkplanservice() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_plan_service_no "
                 . ",   t_wk_plan_service_type_cd "
                 . ",   t_wk_plan_service_type_item_cd "
                 . ",   t_wk_plan_service_time "
                 . ",   t_wk_plan_content "
                 . ",   t_wk_plan_service_created "
                 . ",   t_wk_plan_service_created_staffid "
                 . ",   t_wk_plan_service_modified "
                 . ",   t_wk_plan_service_modified_staffid "
                 . "FROM "
                 .     "t_wk_plan_service "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_plan_service_no != "") {
                $sql .= "AND t_wk_plan_service_no = '" . $db->escape_string($this->inp_t_wk_plan_service_no) . "' ";
            }

            // 文字化け防止
            $db->set_charset();

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_wk_plan_service_no[]                 = $row[$i++];
                    $this->oup_t_wk_plan_service_type_cd[]            = $row[$i++];
                    $this->oup_t_wk_plan_service_type_item_cd[]       = $row[$i++];
                    $this->oup_t_wk_plan_service_time[]               = $row[$i++];
                    $this->oup_t_wk_plan_content[]                    = $row[$i++];
                    $this->oup_t_wk_plan_service_created[]            = $row[$i++];
                    $this->oup_t_wk_plan_service_created_staffid[]    = $row[$i++];
                    $this->oup_t_wk_plan_service_modified[]           = $row[$i++];
                    $this->oup_t_wk_plan_service_modified_staffid[]   = $row[$i++];

// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;

        }

        public function getServiceItem() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_service_item_type_cd "
                 . ",   m_service_item_cd "
                 . ",   m_service_item_content "
                 . "FROM "
                 .     "m_service_item "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_service_item_type_cd != "") {
                $sql .= "AND m_service_item_type_cd = '" . $db->escape_string($this->inp_m_service_item_type_cd) . "' ";
            }
            if ($this->inp_m_service_item_cd != "") {
                $sql .= "AND m_service_item_cd = '" . $db->escape_string($this->inp_m_service_item_cd) . "' ";
            }

            // 文字化け防止
            $db->set_charset();

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_m_service_item_type_cd[]       = $row[$i++];
                    $this->oup_m_service_item_cd[]            = $row[$i++];
                    $this->oup_m_service_item_content[]       = $row[$i++];

// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;

        }

        public function getWkconfirm() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_confirm_staff_id "
                 . ",   t_wk_confirm_start_date "
                 . ",   t_wk_confirm_created "
                 . ",   t_wk_confirm_created_staffid "
                 . ",   t_wk_confirm_modified "
                 . ",   t_wk_confirm_modified_staffid "
                 . "FROM "
                 .     "t_wk_confirm "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_confirm_staff_id != "") {
                $sql .= "AND t_wk_confirm_staff_id = '" . $db->escape_string($this->inp_t_wk_confirm_staff_id) . "' ";
            }
            if ($this->inp_t_wk_confirm_start_date != "") {
                $sql .= "AND t_wk_confirm_start_date = '" . $db->escape_string($this->inp_t_wk_confirm_start_date) . "' ";
            }

            // 文字化け防止
            $db->set_charset();

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_wk_confirm_staff_id[]            = $row[$i++];
                    $this->oup_t_wk_confirm_start_date[]          = $row[$i++];
                    $this->oup_t_wk_confirm_created[]             = $row[$i++];
                    $this->oup_t_wk_confirm_created_staffid[]     = $row[$i++];
                    $this->oup_t_wk_confirm_modified[]            = $row[$i++];
                    $this->oup_t_wk_confirm_modified_staffid[]    = $row[$i++];

// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;

        }

        // インサート
        public function insertWkConf() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO t_wk_conf "
                 . "( "
                 .     "t_wk_no "
                 . ",   t_wk_nengetu "
                 . ",   t_wk_genba_id "
                 . ",   t_wk_taiin_id "
                 . ",   t_wk_order "
                 . ",   t_wk_del_flg "
                 . ",   t_wk_created "
                 . ",   t_wk_created_id "
                 . ",   t_wk_modified "
                 . ",   t_wk_modified_id "
                 . ") ";
            $sql.= "     select "
                 .     "t_wk_no "
                 . ",   t_wk_nengetu "
                 . ",   t_wk_genba_id "
                 . ",   t_wk_taiin_id "
                 . ",   t_wk_order "
                 . ",   t_wk_del_flg "
                 . ",   t_wk_created "
                 . ",   t_wk_created_id "
                 . ",   t_wk_modified "
                 . ",   t_wk_modified_id ";
            $sql.= "from t_wk ";
            $sql .= "WHERE t_wk_nengetu  = '" . $db->escape_string($this->inp_t_wk_nengetu) . "' ";
            $sql .= "AND   t_wk_genba_id = '" . $db->escape_string($this->inp_t_wk_genba_id) . "' ";

// var_dump($sql);

            // 文字化け防止
            $db->set_charset();

            // クエリを送信する
            $db->prepare($sql);

            // プリペアドクエリを実行する
            $db->stmt_execute();

            // 最新のIDを取得
            $this->oup_last_id = mysqli_insert_id($db->link);

            // 結果保持用メモリを開放する
            $db->stmt_close();

            // MySQLへの接続を閉じる
            $db->close();

        }

        // アップデート
        public function updateWk() {

            $db = new Db();
            $whereflg = false;

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE t_wk SET ";
            if ($this->inp_t_wk_no != "") {
                $sql .= "    t_wk_no                       = '" . $this->inp_t_wk_no . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_joban_kbn != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_joban_kbn                = '" . $this->inp_t_wk_joban_kbn . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_joban_time != "") {
                if ($whereflg == true) { $sql .= ","; }
                if ($this->inp_t_wk_joban_time != "null") {
                    $sql .= "    t_wk_joban_time           = '" . $this->inp_t_wk_joban_time . "' ";
                } else {
                    $sql .= "    t_wk_joban_time           = null ";
                }
                $whereflg = true;
            }
            if ($this->inp_t_wk_kaban_kbn != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kaban_kbn                  = '" . $this->inp_t_wk_kaban_kbn . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kaban_time != "") {
                if ($whereflg == true) { $sql .= ","; }
                if ($this->inp_t_wk_kaban_time != "null") {
                    $sql .= "    t_wk_kaban_time            = '" . $this->inp_t_wk_kaban_time . "' ";
                } else {
                    $sql .= "    t_wk_kaban_time            = null ";
                }
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start1 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_start1         = '" . $this->inp_t_wk_kyukei_start1 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end1 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_end1         = '" . $this->inp_t_wk_kyukei_end1 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start2 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_start2         = '" . $this->inp_t_wk_kyukei_start2 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end2 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_end2         = '" . $this->inp_t_wk_kyukei_end2 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start3 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_start3         = '" . $this->inp_t_wk_kyukei_start3 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end3 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_end3         = '" . $this->inp_t_wk_kyukei_end3 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start4 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_start4         = '" . $this->inp_t_wk_kyukei_start4 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end4 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_end4         = '" . $this->inp_t_wk_kyukei_end4 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start5 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_start5         = '" . $this->inp_t_wk_kyukei_start5 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end5 != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kyukei_end5         = '" . $this->inp_t_wk_kyukei_end5 . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_cooperation_no != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_cooperation_no                = '" . $this->inp_t_wk_cooperation_no . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_office_id != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_office_id                = '" . $this->inp_t_wk_office_id . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_user_id != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_user_id                       = '" . $this->inp_t_wk_user_id . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_start_date != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_plan_start_date          = '" . $this->inp_t_wk_plan_start_date . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_id != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_plan_id                  = '" . $this->inp_t_wk_plan_id . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_run_end_time))) {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_run_end_time             = '" . $this->inp_t_wk_run_end_time . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_run_time))) {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_run_time                 = '" . $this->inp_t_wk_run_time . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_stop_kbn))) {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_stop_kbn                 = '" . $this->inp_t_wk_stop_kbn . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_visitor_id))) {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_visitor_id               = '" . $this->inp_t_wk_visitor_id . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kotuhi))) {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kotuhi            = '" . $this->inp_t_wk_kotuhi . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_post_teate))) {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_post_teate            = '" . $this->inp_t_wk_post_teate . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kiken_teate))) {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kiken_teate            = '" . $this->inp_t_wk_kiken_teate . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kuruma_teate != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_kuruma_teate           = '" . $this->inp_t_wk_kuruma_teate . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_rest_reason != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_rest_reason              = '" . $this->inp_t_wk_rest_reason . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_admin_memo))) {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_admin_memo            = '" . $this->inp_t_wk_admin_memo . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_run_kbn != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_run_kbn                  = '" . $this->inp_t_wk_run_kbn . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_ok_flg != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_ok_flg                   = '" . $this->inp_t_wk_ok_flg . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_update_flg != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_update_flg               = '" . $this->inp_t_wk_update_flg . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_order != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_order               = '" . $this->inp_t_wk_order . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_delete_flg != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_delete_flg               = '" . $this->inp_t_wk_delete_flg . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_service_type_cd != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_service_type_cd               = '" . $this->inp_t_wk_service_type_cd . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_service_type_item_cd != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_service_type_item_cd               = '" . $this->inp_t_wk_service_type_item_cd . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_service_content != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_service_content               = '" . $this->inp_t_wk_service_content . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_created != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_created                  = '" . $this->inp_t_wk_created . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_created_staffid != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_created_staffid          = '" . $this->inp_t_wk_created_staffid . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_modified != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_modified                 = '" . $this->inp_t_wk_modified . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_modified_id != "") {
                if ($whereflg == true) { $sql .= ","; }
                $sql .= "    t_wk_modified_id         = '" . $this->inp_t_wk_modified_id . "' ";
                $whereflg = true;
            }
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND t_wk_no = " . $db->escape_string($this->inp_t_wk_no) . " ";
/*
            if ($this->inp_t_wk_cooperation_no != "") {
                $sql .= "AND t_wk_cooperation_no = '" . $db->escape_string($this->inp_t_wk_cooperation_no) . "' ";
            }
            if ($this->inp_t_wk_plan_start_date != "") {
                $sql .= "AND t_wk_plan_start_date = '" . substr($db->escape_string($this->inp_t_wk_plan_start_date),0,4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_start_date),4,2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_start_date),6,2) . "' ";
            }
*/

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
        public function updateServiceItem() {

            $db = new Db();
            $whereflg = false;

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_service_item SET ";
//2017-09-11 MOD Start
//            if ($this->inp_m_service_item_type_cd != "") {
//                $sql .= "    m_service_item_type_cd                 = '" . $this->inp_m_service_item_type_cd . "' ";
//                $whereflg = true;
//            }
//            if ($this->inp_m_service_item_cd != "") {
//                if ($whereflg == true) { $sql .= ","; }
//                $sql .= "    m_service_item_cd            = '" . $this->inp_m_service_item_cd . "' ";
//                $whereflg = true;
//            }
//            if ($this->inp_m_service_item_content != "") {
//                if ($whereflg == true) { $sql .= ","; }
//                $sql .= "    m_service_item_content       = '" . $this->inp_m_service_item_content . "' ";
//                $whereflg = true;
//            }
            if ($this->inp_m_service_item_content != "") {
                $sql .= "    m_service_item_content       = '" . $this->inp_m_service_item_content . "' ";
            }
            $sql .= "WHERE 0 = 0 ";
            if ($this->inp_m_service_item_type_cd != "") {
                $sql .= "AND    m_service_item_type_cd                 = '" . $this->inp_m_service_item_type_cd . "' ";
            }
            if ($this->inp_m_service_item_cd != "") {
                $sql .= "AND    m_service_item_cd            = '" . $this->inp_m_service_item_cd . "' ";
            }
//2017-09-11 MOD End

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
        public function deleteWkConf() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql  = "DELETE FROM t_wk_conf ";
            $sql .= "WHERE t_wk_nengetu  = '" . $db->escape_string($this->inp_t_wk_nengetu) . "' ";
            $sql .= "AND   t_wk_genba_id = '" . $db->escape_string($this->inp_t_wk_genba_id) . "' ";

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
