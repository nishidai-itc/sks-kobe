<?php 

    // 利用者マスタクラス
    class User
    {
        // 変数の宣言
        public $inp_m_user_id;
        public $inp_m_user_kana;
        public $inp_m_user_name;
        public $inp_m_user_birth_date = NULL;
        public $inp_m_user_sex;
        public $inp_m_user_address;
        public $inp_m_user_tel;
        public $inp_m_user_emergency_name;
        public $inp_m_user_emergency_address;
        public $inp_m_user_emergency_tel;
        public $inp_m_user_start_date;
        public $inp_m_user_end_date;
        public $inp_m_user_kbn;
        public $inp_m_user_created;
        public $inp_m_user_created_staffid;
        public $inp_m_user_modified;
        public $inp_m_user_modified_staffid;

        public $inp_t_staff_user_list_staff_id;
        public $inp_t_staff_user_list_user_id;
        public $inp_t_staff_user_list_created;
        public $inp_t_staff_user_list_created_staffid;
        public $inp_t_staff_user_list_modified;
        public $inp_t_staff_user_list_modified_staffid;

        public $oup_m_user_id;
        public $oup_m_user_kana;
        public $oup_m_user_name;
        public $oup_m_user_birth_date;
        public $oup_m_user_sex;
        public $oup_m_user_address;
        public $oup_m_user_tel;
        public $oup_m_user_emergency_name;
        public $oup_m_user_emergency_address;
        public $oup_m_user_emergency_tel;
        public $oup_m_user_start_date;
        public $oup_m_user_end_date;
        public $oup_m_user_kbn;
        public $oup_m_user_created;
        public $oup_m_user_created_staffid;
        public $oup_m_user_modified;
        public $oup_m_user_modified_staffid;

        public $oup_last_id;

        // 入力チェック
        public function inputCheck() {
        }

        // セレクト
        public function getUser() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_user_id "
                 . ",   m_user_kana "
                 . ",   m_user_name "
                 . ",   m_user_birth_date "
                 . ",   m_user_sex "
                 . ",   m_user_address "
                 . ",   m_user_tel "
                 . ",   m_user_emergency_name "
                 . ",   m_user_emergency_address "
                 . ",   m_user_emergency_tel "
                 . ",   m_user_start_date "
                 . ",   m_user_end_date "
                 . ",   m_user_kbn "
                 . ",   m_user_created "
                 . ",   m_user_created_staffid "
                 . ",   m_user_modified "
                 . ",   m_user_modified_staffid "
                 . "FROM "
                 .     "m_user "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_user_id != "") {
                $sql .= "AND m_user_id = '" . $db->escape_string($this->inp_m_user_id) . "' ";
            }
            if ($this->inp_m_user_kana != "") {
                $sql .= "AND m_user_kana = " . $db->escape_string($this->inp_m_user_kana) . " ";
            }
            if ($this->inp_m_user_name != "") {
                $sql .= "AND m_user_name = ? ";
            }
            if ($this->inp_m_user_birth_date != "") {
                $sql .= " m_user_birth_date = ? ";
            }
            if ($this->inp_m_user_start_date != "") {
                $sql .= " m_user_start_date = ? ";
            }
            if ($this->inp_m_user_end_date != "") {
                $sql .= " m_user_end_date = ? ";
            }
            if ($this->inp_m_user_kbn != "") {
                $sql .= " m_user_kbn = ? ";
            }
            if ($this->inp_m_user_created != "") {
                $sql .= " m_user_created = ? ";
            }
            if ($this->inp_m_user_created_staffid != "") {
                $sql .= " m_user_created_staffid = ? ";
            }
            if ($this->inp_m_user_modified != "") {
                $sql .= " m_user_modified = ? ";
            }
            if ($this->inp_m_user_modified_staffid != "") {
                $sql .= " m_user_modified_staffid = ? ";
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_m_user_id[]              = $row[$i++];
                    $this->oup_m_user_kana[]            = $row[$i++];
                    $this->oup_m_user_name[]            = $row[$i++];
					if ($row[3] == "0000-00-00 00:00:00") {
	                    $this->oup_m_user_birth_date[]      = "";
						$i++;
					} else {
	                    $this->oup_m_user_birth_date[]      = $row[$i++];
					}
                    $this->oup_m_user_sex[]             = $row[$i++];
                    $this->oup_m_user_address[]         = $row[$i++];
                    $this->oup_m_user_tel[]             = $row[$i++];
                    $this->oup_m_user_emergency_name[]  = $row[$i++];
                    $this->oup_m_user_emergency_address[] = $row[$i++];
                    $this->oup_m_user_emergency_tel[]   = $row[$i++];
                    $this->oup_m_user_start_date[]      = $row[$i++];
                    $this->oup_m_user_end_date[]        = $row[$i++];
                    $this->oup_m_user_kbn[]             = $row[$i++];
                    $this->oup_m_user_created[]         = $row[$i++];
                    $this->oup_m_user_created_staffid[] = $row[$i++];
                    $this->oup_m_user_modified[]        = $row[$i++];
                    $this->oup_m_user_modified_staffid[]= $row[$i++];

                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;

// var_dump($result);

            // MySQLへの接続を閉じる
            $db->close();

        }

        // セレクト
        public function getStaffUser() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_user_id "
                 . ",   m_user_kana "
                 . ",   m_user_name "
                 . ",   m_user_birth_date "
                 . ",   m_user_sex "
                 . ",   m_user_address "
                 . ",   m_user_tel "
                 . ",   m_user_emergency_name "
                 . ",   m_user_emergency_address "
                 . ",   m_user_emergency_tel "
                 . ",   m_user_start_date "
                 . ",   m_user_end_date "
                 . ",   m_user_kbn "
                 . ",   m_user_created "
                 . ",   m_user_created_staffid "
                 . ",   m_user_modified "
                 . ",   m_user_modified_staffid "
                 . ",   t_work_run_start_date "
                 . "FROM "
                 .     "m_user "
                 .     "INNER JOIN t_staff_user_list "
                 . "ON m_user.m_user_id = t_staff_user_list.t_staff_user_list_user_id  "
                 .     "LEFT JOIN ( "
                 .     "SELECT t_work_user_id,MAX(t_work_run_start_date) AS t_work_run_start_date FROM t_work WHERE t_work_run_start_date <= DATE_ADD(CURDATE(),INTERVAL -7 DAY) ";
            if ($this->inp_t_staff_user_list_staff_id != "") {
                $sql .= "AND t_work_visitor_id = '" . $db->escape_string($this->inp_t_staff_user_list_staff_id) . "' ";
            }
				$sql .= "GROUP BY t_work_user_id ) t_work "
                 . "ON m_user.m_user_id = t_work.t_work_user_id  "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_staff_user_list_staff_id != "") {
                $sql .= "AND t_staff_user_list_staff_id = '" . $db->escape_string($this->inp_t_staff_user_list_staff_id) . "' ";
            }
            if ($this->inp_t_staff_user_list_user_id != "") {
                $sql .= "AND t_staff_user_list_user_id = '" . $db->escape_string($this->inp_t_staff_user_list_user_id) . "' ";
            }
                $sql .= "ORDER BY t_work_run_start_date DESC, m_user_kana ASC ";

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

                    $this->oup_m_user_id[]              = $row[$i++];
                    $this->oup_m_user_kana[]            = $row[$i++];
                    $this->oup_m_user_name[]            = $row[$i++];
					if ($row[3] == "0000-00-00 00:00:00") {
	                    $this->oup_m_user_birth_date[]      = "";
						$i++;
					} else {
	                    $this->oup_m_user_birth_date[]      = $row[$i++];
					}
                    $this->oup_m_user_sex[]             = $row[$i++];
                    $this->oup_m_user_address[]         = $row[$i++];
                    $this->oup_m_user_tel[]             = $row[$i++];
                    $this->oup_m_user_emergency_name[]  = $row[$i++];
                    $this->oup_m_user_emergency_address[] = $row[$i++];
                    $this->oup_m_user_emergency_tel[]   = $row[$i++];
                    $this->oup_m_user_start_date[]      = $row[$i++];
                    $this->oup_m_user_end_date[]        = $row[$i++];
                    $this->oup_m_user_kbn[]             = $row[$i++];
                    $this->oup_m_user_created[]         = $row[$i++];
                    $this->oup_m_user_created_staffid[] = $row[$i++];
                    $this->oup_m_user_modified[]        = $row[$i++];
                    $this->oup_m_user_modified_staffid[]= $row[$i++];

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
        public function insertUser() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_user "
                 . "( "
                 .     "m_user_kana ";
            if ($this->inp_m_user_id != "") {
                $sql .= ",   m_user_id ";
            }
                $sql .= ",   m_user_name ";
            if ($this->inp_m_user_birth_date != "") {
                $sql .= ",   m_user_birth_date ";
			}
            if ($this->inp_m_user_sex != "") {
                $sql .= ",   m_user_sex ";
			}
            if ($this->inp_m_user_address != "") {
                $sql .= ",   m_user_address ";
			}
            if ($this->inp_m_user_tel != "") {
                $sql .= ",   m_user_tel ";
			}
            if ($this->inp_m_user_emergency_name != "") {
                $sql .= ",   m_user_emergency_name ";
			}
            if ($this->inp_m_user_emergency_address != "") {
                $sql .= ",   m_user_emergency_address ";
			}
            if ($this->inp_m_user_emergency_tel != "") {
                $sql .= ",   m_user_emergency_tel ";
			}
            if ($this->inp_m_user_start_date != "") {
                $sql .= ",   m_user_start_date ";
			}
            if ($this->inp_m_user_end_date != "") {
                $sql .= ",   m_user_end_date ";
			}
            $sql .=",   m_user_kbn "
                 . ",   m_user_created "
                 . ",   m_user_created_staffid "
                 . ",   m_user_modified "
                 . ",   m_user_modified_staffid "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_m_user_kana."'";
            if ($this->inp_m_user_id != "") {
                $sql .= ",   '".$this->inp_m_user_id."'";
            }
                $sql .= ",   '".$this->inp_m_user_name."'";
            if ($this->inp_m_user_birth_date != "") {
                $sql .=",    '".$this->inp_m_user_birth_date."'";
			}
            if ($this->inp_m_user_sex != "") {
                $sql .=",    '".$this->inp_m_user_sex."'";
			}
            if ($this->inp_m_user_address != "") {
                $sql .=",    '".$this->inp_m_user_address."'";
			}
            if ($this->inp_m_user_tel != "") {
                $sql .=",    '".$this->inp_m_user_tel."'";
			}
            if ($this->inp_m_user_emergency_name != "") {
                $sql .=",    '".$this->inp_m_user_emergency_name."'";
			}
            if ($this->inp_m_user_emergency_address != "") {
                $sql .=",    '".$this->inp_m_user_emergency_address."'";
			}
            if ($this->inp_m_user_emergency_tel != "") {
                $sql .=",    '".$this->inp_m_user_emergency_tel."'";
			}
            if ($this->inp_m_user_start_date != "") {
                $sql .=",    '".$this->inp_m_user_start_date."'";
			}
            if ($this->inp_m_user_end_date != "") {
                $sql .=",    '".$this->inp_m_user_end_date."'";
			}
            $sql .=",    '".$this->inp_m_user_kbn."'"
                 . ",    '".$this->inp_m_user_created."'"
                 . ",    '".$this->inp_m_user_created_staffid."'"
                 . ",    '".$this->inp_m_user_modified."'"
                 . ",    '".$this->inp_m_user_modified_staffid."'"
                 . ") ";

            // 文字化け防止
            $db->set_charset();

// var_dump($sql);

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

        // インサート
        public function insertStaffUserlist() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO t_staff_user_list "
                 . "( "
                 .     "t_staff_user_list_staff_id "
                 . ",   t_staff_user_list_user_id "
                 . ",   t_staff_user_list_created "
                 . ",   t_staff_user_list_created_staffid "
                 . ",   t_staff_user_list_modified "
                 . ",   t_staff_user_list_modified_staffid "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_t_staff_user_list_staff_id."'"
                 . ",    '".$this->inp_t_staff_user_list_user_id."'"
                 . ",    '".$this->inp_t_staff_user_list_created."'"
                 . ",    '".$this->inp_t_staff_user_list_created_staffid."'"
                 . ",    '".$this->inp_t_staff_user_list_modified."'"
                 . ",    '".$this->inp_t_staff_user_list_modified_staffid."'"
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
        public function updateUser() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_user SET "
                 . "    m_user_kana = '" . $this->inp_m_user_kana . "' ";
                if ($this->inp_m_user_id != "") {
                    $sql .= ",   m_user_id = '" . $this->inp_m_user_id . "' ";
                }
                if ($this->inp_m_user_name != "") {
                    $sql .= ",   m_user_name = '" . $this->inp_m_user_name . "' ";
                }
                if (!(is_null($this->inp_m_user_birth_date))) {
                    $sql .= ",   m_user_birth_date = '" . $this->inp_m_user_birth_date . "' ";
                }
                if ($this->inp_m_user_sex != "") {
                    $sql .= ",   m_user_sex = '" . $this->inp_m_user_sex . "' ";
                }
                if ($this->inp_m_user_address != "") {
                    $sql .= ",   m_user_address = '" . $this->inp_m_user_address . "' ";
                }
                if ($this->inp_m_user_tel != "") {
                    $sql .= ",   m_user_tel = '" . $this->inp_m_user_tel . "' ";
                }
                if ($this->inp_m_user_emergency_name != "") {
                    $sql .= ",   m_user_emergency_name = '" . $this->inp_m_user_emergency_name . "' ";
                }
                if ($this->inp_m_user_emergency_address != "") {
                    $sql .= ",   m_user_emergency_address = '" . $this->inp_m_user_emergency_address . "' ";
                }
                if ($this->inp_m_user_emergency_tel != "") {
                    $sql .= ",   m_user_emergency_tel = '" . $this->inp_m_user_emergency_tel . "' ";
                }
                if ($this->inp_m_user_start_date != "") {
                    $sql .= ",   m_user_start_date = '" . $this->inp_m_user_start_date . "' ";
                }
                if ($this->inp_m_user_end_date != "") {
                    $sql .= ",   m_user_end_date = '" . $this->inp_m_user_end_date . "' ";
                }
                if ($this->inp_m_user_kbn != "") {
                    $sql .= ",   m_user_kbn = '" . $this->inp_m_user_kbn . "' ";
                }
                if ($this->inp_m_user_modified != "") {
                    $sql .= ",   m_user_modified = '" . $this->inp_m_user_modified . "' ";
                }
                if ($this->inp_m_user_modified_staffid != "") {
                    $sql .= ",   m_user_modified_staffid = '" . $this->inp_m_user_modified_staffid . "' ";
                }
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND m_user_id = '" . $db->escape_string($this->inp_m_user_id) . "' ";

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
        public function deleteUser() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM m_user "
                 . "WHERE 0 = 0 ";
            $sql .= "AND m_user_id = '" . $db->escape_string($this->inp_m_user_id) . "' ";

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
        public function deleteStaffUserlist() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM t_staff_user_list "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_staff_user_list_staff_id != "") {
                $sql .= "AND t_staff_user_list_staff_id = '" . $db->escape_string($this->inp_t_staff_user_list_staff_id) . "' ";
            }

            if ($this->inp_t_staff_user_list_user_id != "") {
                $sql .= "AND t_staff_user_list_user_id = '" . $db->escape_string($this->inp_t_staff_user_list_user_id) . "' ";
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

    }
?>
