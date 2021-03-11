<?php 

    // サービス実施問題クラス
    class Serviceq
    {
        // 変数の宣言
        public $inp_m_company_name;
        public $inp_m_company_disp_move_cost_yen;
        public $inp_m_company_disp_move_cost_kilo;
        public $inp_m_company_disp_move_cost_etc;
        public $inp_m_company_disp_work_created;
        public $inp_m_company_disp_work_modified;
        public $inp_m_company_people_num;
        public $inp_m_company_try_start_date;
        public $inp_m_company_try_end_date;
        public $inp_m_company_start_date;
        public $inp_m_company_end_date;
        public $inp_m_company_simple_kbn;
        public $inp_m_company_created;
        public $inp_m_company_created_staffid;
        public $inp_m_company_modified;
        public $inp_m_company_modified_staffid;

        public $oup_m_company_name;
        public $oup_m_company_disp_move_cost_yen;
        public $oup_m_company_disp_move_cost_kilo;
        public $oup_m_company_disp_move_cost_etc;
        public $oup_m_company_disp_work_created;
        public $oup_m_company_disp_work_modified;
        public $oup_m_company_people_num;
        public $oup_m_company_try_start_date;
        public $oup_m_company_try_end_date;
        public $oup_m_company_start_date;
        public $oup_m_company_simple_kbn;
        public $oup_m_company_end_date;
        public $oup_m_company_created;
        public $oup_m_company_created_staffid;
        public $oup_m_company_modified;
        public $oup_m_company_modified_staffid;

        // 入力チェック
        public function inputCheck() {
        }

        // セレクト
        public function getServiceq() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_serviceq_tcode "
                 . ",   m_serviceq_qcode "
                 . ",   m_serviceq_type "
                 . ",   m_serviceq_question "
                 . ",   m_serviceq_tdisp "
                 . ",   m_serviceq_qdisp "
                 . ",   m_serviceq_a1kbn "
                 . ",   m_serviceq_a1content "
                 . ",   m_serviceq_a1iflg "
                 . ",   m_serviceq_a2kbn "
                 . ",   m_serviceq_a2content "
                 . ",   m_serviceq_a2iflg "
                 . ",   m_serviceq_a3kbn "
                 . ",   m_serviceq_a3content "
                 . ",   m_serviceq_a3iflg "
                 . ",   m_serviceq_a4kbn "
                 . ",   m_serviceq_a4content "
                 . ",   m_serviceq_a4iflg "
                 . ",   m_serviceq_a5kbn "
                 . ",   m_serviceq_a5content "
                 . ",   m_serviceq_a5iflg "
                 . ",   m_serviceq_a6kbn "
                 . ",   m_serviceq_a6content "
                 . ",   m_serviceq_a6iflg "
                 . ",   m_serviceq_a7kbn "
                 . ",   m_serviceq_a7content "
                 . ",   m_serviceq_a7iflg "
                 . ",   m_serviceq_a8kbn "
                 . ",   m_serviceq_a8content "
                 . ",   m_serviceq_a8iflg "
                 . ",   m_serviceq_a9kbn "
                 . ",   m_serviceq_a9content "
                 . ",   m_serviceq_a9iflg "
                 . ",   m_serviceq_a10kbn "
                 . ",   m_serviceq_a10content "
                 . ",   m_serviceq_a10iflg "
                 . "FROM "
                 .     "m_serviceq "
                 . "order by m_serviceq_tdisp, m_serviceq_qdisp ";

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

                    $this->oup_m_serviceq_tcode[]       = $row[$i++];
                    $this->oup_m_serviceq_qcode[]       = $row[$i++];
                    $this->oup_m_serviceq_type[]        = $row[$i++];
                    $this->oup_m_serviceq_question[]    = $row[$i++];
                    $this->oup_m_serviceq_tdisp[]       = $row[$i++];
                    $this->oup_m_serviceq_qdisp[]       = $row[$i++];
                    $this->oup_m_serviceq_a1kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a1content[]   = $row[$i++];
                    $this->oup_m_serviceq_a1iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a2kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a2content[]   = $row[$i++];
                    $this->oup_m_serviceq_a2iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a3kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a3content[]   = $row[$i++];
                    $this->oup_m_serviceq_a3iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a4kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a4content[]   = $row[$i++];
                    $this->oup_m_serviceq_a4iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a5kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a5content[]   = $row[$i++];
                    $this->oup_m_serviceq_a5iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a6kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a6content[]   = $row[$i++];
                    $this->oup_m_serviceq_a6iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a7kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a7content[]   = $row[$i++];
                    $this->oup_m_serviceq_a7iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a8kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a8content[]   = $row[$i++];
                    $this->oup_m_serviceq_a8iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a9kbn[]       = $row[$i++];
                    $this->oup_m_serviceq_a9content[]   = $row[$i++];
                    $this->oup_m_serviceq_a9iflg[]      = $row[$i++];
                    $this->oup_m_serviceq_a10kbn[]      = $row[$i++];
                    $this->oup_m_serviceq_a10content[]   = $row[$i++];
                    $this->oup_m_serviceq_a10iflg[]     = $row[$i++];

// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);

            }

            return $result;

        }

        // インサート
        public function insertStaff() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_staff "
                 . "( "
                 .     "m_staff_office_id "
                 . ",   m_staff_id "
                 . ",   m_staff_pass "
                 . ",   m_staff_name "
                 . ",   m_staff_mail "
                 . ",   m_staff_kbn "
                 . ",   m_staff_social_position "
                 . ",   m_staff_auth "
                 . ",   m_staff_created "
                 . ",   m_staff_created_staffid "
                 . ",   m_staff_modified "
                 . ",   m_staff_modified_staffid "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_m_staff_office_id."'"
                 . ",    '".$this->inp_m_staff_id."'"
                 . ",    '".$this->inp_m_staff_pass."'"
                 . ",    '".$this->inp_m_staff_name."'"
                 . ",    '".$this->inp_m_staff_mail."'"
                 . ",    '".$this->inp_m_staff_kbn."'"
                 . ",    '".$this->inp_m_staff_social_position."'"
                 . ",    '".$this->inp_m_staff_auth."'"
                 . ",    '".$this->inp_m_staff_created."'"
                 . ",    '".$this->inp_m_staff_created_staffid."'"
                 . ",    '".$this->inp_m_staff_modified."'"
                 . ",    '".$this->inp_m_staff_modified_staffid."'"
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
        public function updateStaff() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_staff SET "
                 . "    m_staff_id = '" . $this->inp_m_staff_id . "' ";
                if ($this->inp_m_staff_office_id != "") {
                    $sql .= ",   m_staff_office_id = '" . $db->escape_string($this->inp_m_staff_office_id) . "' ";
                }
                if ($this->inp_m_staff_pass != "") {
                    $sql .= ",   m_staff_pass = '" . $db->escape_string($this->inp_m_staff_pass) . "' ";
                }
                if ($this->inp_m_staff_name != "") {
                    $sql .= ",   m_staff_name = '" . $db->escape_string($this->inp_m_staff_name) . "' ";
                }
                if ($this->inp_m_staff_mail != "") {
                    $sql .= ",   m_staff_mail = '" . $db->escape_string($this->inp_m_staff_mail) . "' ";
                }
                if ($this->inp_m_staff_kbn != "") {
                    $sql .= ",   m_staff_kbn = '" . $db->escape_string($this->inp_m_staff_kbn) . "' ";
                }
                if ($this->inp_m_staff_social_position != "") {
                    $sql .= ",   m_staff_social_position = '" . $db->escape_string($this->inp_m_staff_social_position) . "' ";
                }
                if ($this->inp_m_staff_auth != "") {
                    $sql .= ",   m_staff_auth = '" . $db->escape_string($this->inp_m_staff_auth) . "' ";
                }
                if ($this->inp_m_staff_created != "") {
                    $sql .= ",   m_staff_created = '" . $db->escape_string($this->inp_m_staff_created) . "' ";
                }
                if ($this->inp_m_staff_created_staffid != "") {
                    $sql .= ",   m_staff_created_staffid = '" . $db->escape_string($this->inp_m_staff_created_staffid) . "' ";
                }
                if ($this->inp_m_staff_modified != "") {
                    $sql .= ",   m_staff_modified = '" . $db->escape_string($this->inp_m_staff_modified) . "' ";
                }
                if ($this->inp_m_staff_modified_staffid != "") {
                    $sql .= ",   m_staff_modified_staffid = '" . $db->escape_string($this->inp_m_staff_modified_staffid) . "' ";
                }
                $sql .= "WHERE 0 = 0 ";

            if ($this->inp_m_staff_office_id != "") {
                $sql .= "AND m_staff_office_id = " . $db->escape_string($this->inp_m_staff_office_id) . " ";
            }
            if ($this->inp_m_staff_id != "") {
                $sql .= "AND m_staff_id = '" . $db->escape_string($this->inp_m_staff_id) . "' ";
            }

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
        public function deleteStaff() {

  $url = "localhost";
  $user = "root";
  $pass = "";
  $db = "visit_support";

  // MySQLへ接続する
  $link = mysqli_connect($url,$user,$pass,$db) or die("MySQLへの接続に失敗しました。");

            $sql = "DELETE FROM m_staff "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_staff_office_id != "") {
                $sql .= "AND m_staff_office_id = " . mysqli_real_escape_string($link, $this->inp_m_staff_office_id) . " ";
            }
            if ($this->inp_m_staff_id != "") {
                $sql .= "AND m_staff_id = '" . mysqli_real_escape_string($link, $this->inp_m_staff_id) . "' ";
            }

// var_dump($sql);

  // 文字化け防止
  mysqli_set_charset($link,"utf8");

  // クエリを送信する
  $stmt = mysqli_prepare($link, $sql) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

  // プリペアドクエリを実行する
  mysqli_stmt_execute($stmt);

  // 結果保持用メモリを開放する
  mysqli_stmt_close($stmt);

  // MySQLへの接続を閉じる
  mysqli_close($link) or die("MySQL切断に失敗しました。");


        }

    }
?>
