<?php 

    // 会社マスタクラス
    class Company
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
        public $inp_m_company_kiroku_kbn;
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
        public $oup_m_company_end_date;
        public $oup_m_company_simple_kbn;
        public $oup_m_company_kiroku_kbn;
        public $oup_m_company_created;
        public $oup_m_company_created_staffid;
        public $oup_m_company_modified;
        public $oup_m_company_modified_staffid;

        // 入力チェック
        public function inputCheck() {
        }

        // セレクト
        public function getCompany() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_company_name "
                 . ",   m_company_disp_move_cost_yen "
                 . ",   m_company_disp_move_cost_kilo "
                 . ",   m_company_disp_move_cost_etc "
                 . ",   m_company_disp_work_created "
                 . ",   m_company_disp_work_modified "
                 . ",   m_company_people_num "
                 . ",   m_company_try_start_date "
                 . ",   m_company_try_end_date "
                 . ",   m_company_start_date "
                 . ",   m_company_end_date "
                 . ",   m_company_simple_kbn "
                 . ",   m_company_kiroku_kbn "
                 . ",   m_company_created "
                 . ",   m_company_created_staffid "
                 . ",   m_company_modified "
                 . ",   m_company_modified_staffid "
                 . "FROM "
                 .     "m_company "
                 . "WHERE 0 = 0 ";

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
                    $this->oup_m_company_name[]                 = $row[$i++];
                    $this->oup_m_company_disp_move_cost_yen[]   = $row[$i++];
                    $this->oup_m_company_disp_move_cost_kilo[]  = $row[$i++];
                    $this->oup_m_company_disp_move_cost_etc[]   = $row[$i++];
                    $this->oup_m_company_disp_work_created[]    = $row[$i++];
                    $this->oup_m_company_disp_work_modified[]   = $row[$i++];
                    $this->oup_m_company_people_num[]           = $row[$i++];
                    $this->oup_m_company_try_start_date[]       = $row[$i++];
                    $this->oup_m_company_try_end_date[]         = $row[$i++];
                    $this->oup_m_company_start_date[]           = $row[$i++];
                    $this->oup_m_company_end_date[]             = $row[$i++];
                    $this->oup_m_company_simple_kbn[]           = $row[$i++];
                    $this->oup_m_company_kiroku_kbn[]           = $row[$i++];
                    $this->oup_m_company_created[]              = $row[$i++];
                    $this->oup_m_company_created_staffid[]      = $row[$i++];
                    $this->oup_m_company_modified[]             = $row[$i++];
                    $this->oup_m_company_modified_staffid[]     = $row[$i++];
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
