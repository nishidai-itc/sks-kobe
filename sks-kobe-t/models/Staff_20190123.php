<?php 

    // 社員マスタクラス
    class Staff
    {
        // 変数の宣言
        public $inp_m_staff_id;
        public $inp_m_staff_office_id;
        public $inp_m_staff_login_id;
        public $inp_m_staff_pass;
        public $inp_m_staff_kana;
        public $inp_m_staff_name;
        public $inp_m_staff_mail;
        public $inp_m_staff_kbn;
        public $inp_m_staff_social_position;
        public $inp_m_staff_auth;
        public $inp_m_staff_skill_kbn;
        public $inp_m_staff_entry_date;
        public $inp_m_staff_retire_date;
        public $inp_m_staff_created;
        public $inp_m_staff_created_staffid;
        public $inp_m_staff_modified;
        public $inp_m_staff_modified_staffid;

        public $oup_m_staff_id;
        public $oup_m_staff_office_id;
        public $oup_m_staff_login_id;
        public $oup_m_staff_pass;
        public $oup_m_staff_kana;
        public $oup_m_staff_name;
        public $oup_m_staff_mail;
        public $oup_m_staff_kbn;
        public $oup_m_staff_social_position;
        public $oup_m_staff_auth;
        public $oup_m_staff_skill_kbn;
        public $oup_m_staff_entry_date;
        public $oup_m_staff_retire_date;
        public $oup_m_staff_created;
        public $oup_m_staff_created_staffid;
        public $oup_m_staff_modified;
        public $oup_m_staff_modified_staffid;

        // 入力チェック
        public function inputCheck() {
        }

        // セレクト
        public function getStaff() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_staff_id "
                 . ",   m_staff_office_id "
                 . ",   m_staff_login_id "
                 . ",   m_staff_pass "
                 . ",   m_staff_kana "
                 . ",   m_staff_name "
                 . ",   m_staff_mail "
                 . ",   m_staff_kbn "
                 . ",   m_staff_social_position "
                 . ",   m_staff_auth "
                 . ",   m_staff_skill_kbn "
                 . ",   m_staff_entry_date "
                 . ",   m_staff_retire_date "
                 . ",   m_staff_created "
                 . ",   m_staff_created_staffid "
                 . ",   m_staff_modified "
                 . ",   m_staff_modified_staffid "
                 . "FROM "
                 .     "m_staff ";
            if ($this->inp_m_kanri_id != "") {
                $sql .= "inner join t_staff_user_list on m_staff_id = t_staff_user_list_staff_id ";
            }

            $sql .= "WHERE 0 = 0 ";

            if ($this->inp_m_kanri_id != "") {
                $sql .= "AND t_staff_user_list_user_id = '" . $db->escape_string($this->inp_m_kanri_id) . "' ";
            }
            if ($this->inp_m_staff_id != "") {
                $sql .= "AND m_staff_id = '" . $db->escape_string($this->inp_m_staff_id) . "' ";
            }
            if ($this->inp_m_staff_office_id != "") {
                $sql .= "AND m_staff_office_id = " . $db->escape_string($this->inp_m_staff_office_id) . " ";
            }
            if ($this->inp_m_staff_login_id != "") {
                $sql .= "AND m_staff_login_id = '" . $db->escape_string($this->inp_m_staff_login_id) . "' ";
            }
            if ($this->inp_m_staff_pass != "") {
                $sql .= "AND m_staff_pass = '" . $db->escape_string($this->inp_m_staff_pass) . "' ";
            }
            if ($this->inp_m_staff_name != "") {
                $sql .= "AND m_staff_name = ? ";
            }
            if ($this->inp_m_staff_mail != "") {
                $sql .= " m_staff_mail = ? ";
            }
            if ($this->inp_m_staff_kbn != "") {
                $sql .= "AND m_staff_kbn = '" . $db->escape_string($this->inp_m_staff_kbn) . "' ";
            }
            if ($this->inp_m_staff_social_position != "") {
                $sql .= " m_staff_social_position = ? ";
            }
            if ($this->inp_m_staff_auth != "") {
                $sql .= "AND m_staff_auth = '" . $db->escape_string($this->inp_m_staff_auth) . "' ";
            }
            if ($this->inp_m_staff_created != "") {
                $sql .= " m_staff_created = ? ";
            }
            if ($this->inp_m_staff_created_staffid != "") {
                $sql .= " m_staff_created_staffid = ? ";
            }
            if ($this->inp_m_staff_modified != "") {
                $sql .= " m_staff_modified = ? ";
            }
            if ($this->inp_m_staff_modified_staffid != "") {
                $sql .= " m_staff_modified_staffid = ? ";
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

// プリペアドクエリを実行する
//  mysqli_stmt_execute($stmt);
//    $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;
                    $this->oup_m_staff_id[]               = $row[$i++];
                    $this->oup_m_staff_office_id[]        = $row[$i++];
                    $this->oup_m_staff_login_id[]         = $row[$i++];
                    $this->oup_m_staff_pass[]             = $row[$i++];
                    $this->oup_m_staff_kana[]             = $row[$i++];
                    $this->oup_m_staff_name[]             = $row[$i++];
                    $this->oup_m_staff_mail[]             = $row[$i++];
                    $this->oup_m_staff_kbn[]              = $row[$i++];
                    $this->oup_m_staff_social_position[]  = $row[$i++];
                    $this->oup_m_staff_auth[]             = $row[$i++];
                    $this->oup_m_staff_skill_kbn[]        = $row[$i++];
                    $this->oup_m_staff_entry_date[]       = $row[$i++];
                    $this->oup_m_staff_retire_date[]      = $row[$i++];
                    $this->oup_m_staff_created[]          = $row[$i++];
                    $this->oup_m_staff_created_staffid[]  = $row[$i++];
                    $this->oup_m_staff_modified[]         = $row[$i++];
                    $this->oup_m_staff_modified_staffid[] = $row[$i++];
// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);

            }

            return $this->result;

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
                 . ",   m_staff_login_id "
                 . ",   m_staff_pass "
                 . ",   m_staff_kana "
                 . ",   m_staff_name "
                 . ",   m_staff_mail "
                 . ",   m_staff_kbn "
                 . ",   m_staff_social_position "
                 . ",   m_staff_auth "
                 . ",   m_staff_skill_kbn "
                 . ",   m_staff_entry_date "
                 . ",   m_staff_retire_date "
                 . ",   m_staff_created "
                 . ",   m_staff_created_staffid "
                 . ",   m_staff_modified "
                 . ",   m_staff_modified_staffid "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_m_staff_office_id."'"
                 . ",    '".$this->inp_m_staff_id."'"
                 . ",    '".$this->inp_m_staff_login_id."'"
                 . ",    '".$this->inp_m_staff_pass."'"
                 . ",    '".$this->inp_m_staff_kana."'"
                 . ",    '".$this->inp_m_staff_name."'"
                 . ",    '".$this->inp_m_staff_mail."'"
                 . ",    '".$this->inp_m_staff_kbn."'"
                 . ",    '".$this->inp_m_staff_social_position."'"
                 . ",    '".$this->inp_m_staff_auth."'"
                 . ",    '".$this->inp_m_staff_skill_kbn."'"
                 . ",    '".$this->inp_m_staff_entry_date."'"
                 . ",    '".$this->inp_m_staff_retire_date."'"
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
                if ($this->inp_m_staff_login_id != "") {
                    $sql .= ",   m_staff_login_id = '" . $db->escape_string($this->inp_m_staff_login_id) . "' ";
                }
                if ($this->inp_m_staff_pass != "") {
                    $sql .= ",   m_staff_pass = '" . $db->escape_string($this->inp_m_staff_pass) . "' ";
                }
                if ($this->inp_m_staff_kana != "") {
                    $sql .= ",   m_staff_kana = '" . $db->escape_string($this->inp_m_staff_kana) . "' ";
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
                if ($this->inp_m_staff_skill_kbn != "") {
                    $sql .= ",   m_staff_skill_kbn = '" . $db->escape_string($this->inp_m_staff_skill_kbn) . "' ";
                }
                if ($this->inp_m_staff_entry_date != "") {
                    $sql .= ",   m_staff_entry_date = '" . $db->escape_string($this->inp_m_staff_entry_date) . "' ";
                }
                if ($this->inp_m_staff_retire_date != "") {
                    $sql .= ",   m_staff_retire_date = '" . $db->escape_string($this->inp_m_staff_retire_date) . "' ";
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
                $sql .= "AND m_staff_office_id = '" . $db->escape_string($this->inp_m_staff_office_id) . "' ";
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

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_staff "
                 . "WHERE 0 = 0 ";

            $sql .= "AND m_staff_id = '" . $db->escape_string($this->inp_m_staff_id) . "' ";

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
