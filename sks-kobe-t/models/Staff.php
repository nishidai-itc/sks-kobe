<?php 

    // 社員マスタクラス
    class Staff
    {
        // 変数の宣言
        public $inp_order;
        public $inp_m_staff_id;
        public $inp_m_staff_office_id;
        public $inp_m_staff_login_id;
        public $inp_m_staff_pass;
        public $inp_m_staff_kana;
        public $inp_m_staff_name;
        public $inp_m_staff_mail;
        public $inp_m_staff_social_position;
        public $inp_m_staff_auth;
        public $inp_m_staff_skill_kbn;
        public $inp_m_staff_genba_id;
        public $inp_m_staff_del_flg;
        public $inp_m_staff_created;
        public $inp_m_staff_created_staffid;
        public $inp_m_staff_modified;
        public $inp_m_staff_modified_staffid;

        public $inp_m_kanri_id;

        public $inp_m_staff_id_not;
        public $inp_m_staff_ids;
        // public $inp_m_check_taisya;

        public $oup_m_staff_id;
        public $oup_m_staff_office_id;
        public $oup_m_staff_login_id;
        public $oup_m_staff_pass;
        public $oup_m_staff_kana;
        public $oup_m_staff_name;
        public $oup_m_staff_mail;
        public $oup_m_staff_social_position;
        public $oup_m_staff_auth;
        public $oup_m_staff_skill_kbn;
        public $oup_m_staff_genba_id;
        public $oup_m_staff_del_flg;
        public $oup_m_staff_created;
        public $oup_m_staff_created_staffid;
        public $oup_m_staff_modified;
        public $oup_m_staff_modified_staffid;

        public $oup_m_kanri_id;
        public $oup_m_staff_kbn;
        
        public $inp_m_staff_nyusya = null;
        public $inp_m_staff_taisya = null;
        public $inp_m_staff_company = null;
        public $oup_m_staff_nyusya;
        public $oup_m_staff_taisya;
        public $oup_m_staff_company;
        
        public $inp_m_staff_haiti_name;
        public $oup_m_staff_haiti_name;

        public $auth = array("1" => "本部","2" => "リーダー","3" => "上下番チェック","4" => "隊員",);
        public $koyo = array("1" => "本部","2" => "常用","3" => "登録","4" => "協力会社",);

        // 入力チェック
        public function inputCheck() {
            if ((strlen($this->inp_m_staff_nyusya) != "8" && $this->inp_m_staff_nyusya != "") || (strlen($this->inp_m_staff_taisya) != "8" && $this->inp_m_staff_taisya != "")) {
                $this->errmsg .= "入社日、退社日は8ケタで入力してください。<br />";
            }
        }
        // public function inputCheck2() {
        //     if ($this->inp_m_check_taisya < date("Y-m-d")) {
        //         $this->errmsg .= "既に退職された隊員です。<br />";
        //     }
        // }

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
                 . ",   m_staff_genba_id "
                 . ",   m_staff_nyusya "
                 . ",   m_staff_taisya "
                 . ",   m_staff_company "
                 . ",   m_staff_del_flg "
                 . ",   m_staff_created "
                 . ",   m_staff_created_staffid "
                 . ",   m_staff_modified "
                 . ",   m_staff_modified_staffid "
                 . ",   m_staff_haiti_name "
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
            if ($this->inp_m_staff_id_in != "") {
                $sql .= "AND m_staff_id in (".$this->inp_m_staff_id_in.") ";
            }
            if ($this->inp_m_staff_id_not != "") {
                $sql .= "AND m_staff_id != '" . $db->escape_string($this->inp_m_staff_id_not) . "' ";
            }
            if ($this->inp_m_staff_ids != "") {
                $sql .= "AND (m_staff_id = '" . $db->escape_string($this->inp_m_staff_ids[0]) . "' or m_staff_login_id = '" . $db->escape_string($this->inp_m_staff_ids[1]) . "') ";
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
            if ($this->inp_m_staff_kana != "") {
                if ($this->inp_m_staff_kana=="ア") {
                    $sql .= "and (m_staff_kana like 'ア%' or m_staff_kana like 'イ%' or m_staff_kana like 'ウ%' or m_staff_kana like 'エ%' or m_staff_kana like 'オ%' or ";
                    $sql .= "     m_staff_kana like 'ｱ%' or m_staff_kana like 'ｲ%' or m_staff_kana like 'ｳ%' or m_staff_kana like 'ｴ%' or m_staff_kana like 'ｵ%') ";
                } else if ($this->inp_m_staff_kana=="カ") {
                    $sql .= "and (m_staff_kana like 'カ%' or m_staff_kana like 'キ%' or m_staff_kana like 'ク%' or m_staff_kana like 'ケ%' or m_staff_kana like 'コ%' or m_staff_kana like 'ガ%' or m_staff_kana like 'ギ%' or m_staff_kana like 'グ%' or m_staff_kana like 'ゲ%' or m_staff_kana like 'ゴ%' or ";
                    $sql .= "     m_staff_kana like 'ｶ%' or m_staff_kana like 'ｷ%' or m_staff_kana like 'ｸ%' or m_staff_kana like 'ｹ%' or m_staff_kana like 'ｺ%' or m_staff_kana like 'ｶﾞ%' or m_staff_kana like 'ｷﾞ%' or m_staff_kana like 'ｸﾞ%' or m_staff_kana like 'ｹﾞ%' or m_staff_kana like 'ｺﾞ%')  ";
                } else if ($this->inp_m_staff_kana=="サ") {
                    $sql .= "and (m_staff_kana like 'サ%' or m_staff_kana like 'シ%' or m_staff_kana like 'ス%' or m_staff_kana like 'セ%' or m_staff_kana like 'ソ%' or m_staff_kana like 'ザ%' or m_staff_kana like 'ジ%' or m_staff_kana like 'ズ%' or m_staff_kana like 'ゼ%' or m_staff_kana like 'ゾ%' or ";
                    $sql .= "     m_staff_kana like 'ｻ%' or m_staff_kana like 'ｼ%' or m_staff_kana like 'ｽ%' or m_staff_kana like 'ｾ%' or m_staff_kana like 'ｿ%' or m_staff_kana like 'ｻﾞ%' or m_staff_kana like 'ｼﾞ%' or m_staff_kana like 'ｽﾞ%' or m_staff_kana like 'ｾﾞ%' or m_staff_kana like 'ｿﾞ%')  ";
                } else if ($this->inp_m_staff_kana=="タ") {
                    $sql .= "and (m_staff_kana like 'タ%' or m_staff_kana like 'チ%' or m_staff_kana like 'ツ%' or m_staff_kana like 'テ%' or m_staff_kana like 'ト%' or m_staff_kana like 'ダ%' or m_staff_kana like 'ヂ%' or m_staff_kana like 'ヅ%' or m_staff_kana like 'デ%' or m_staff_kana like 'ド%' or ";
                    $sql .= "     m_staff_kana like 'ﾀ%' or m_staff_kana like 'ﾁ%' or m_staff_kana like 'ﾂ%' or m_staff_kana like 'ﾃ%' or m_staff_kana like 'ﾄ%' or m_staff_kana like 'ﾀﾞ%' or m_staff_kana like 'ﾁﾞ%' or m_staff_kana like 'ﾂﾞ%' or m_staff_kana like 'ﾃﾞ%' or m_staff_kana like 'ﾄﾞ%')  ";
                } else if ($this->inp_m_staff_kana=="ナ") {
                    $sql .= "and (m_staff_kana like 'ナ%' or m_staff_kana like 'ニ%' or m_staff_kana like 'ヌ%' or m_staff_kana like 'ネ%' or m_staff_kana like 'ノ%' or ";
                    $sql .= "     m_staff_kana like 'ﾅ%' or m_staff_kana like 'ﾆ%' or m_staff_kana like 'ﾇ%' or m_staff_kana like 'ﾈ%' or m_staff_kana like 'ﾉ%') ";
                } else if ($this->inp_m_staff_kana=="ハ") {
                    $sql .= "and (m_staff_kana like 'ハ%' or m_staff_kana like 'ヒ%' or m_staff_kana like 'フ%' or m_staff_kana like 'ヘ%' or m_staff_kana like 'ホ%' or m_staff_kana like 'バ%' or m_staff_kana like 'ビ%' or m_staff_kana like 'ブ%' or m_staff_kana like 'ベ%' or m_staff_kana like 'ボ%' or m_staff_kana like 'パ%' or m_staff_kana like 'ピ%' or m_staff_kana like 'プ%' or m_staff_kana like 'ペ%' or m_staff_kana like 'ポ%' or ";
                    $sql .= "     m_staff_kana like 'ﾊ%' or m_staff_kana like 'ﾋ%' or m_staff_kana like 'ﾌ%' or m_staff_kana like 'ﾍ%' or m_staff_kana like 'ﾎ%' or m_staff_kana like 'ﾊﾞ%' or m_staff_kana like 'ﾋﾞ%' or m_staff_kana like 'ﾌﾞ%' or m_staff_kana like 'ﾍﾞ%' or m_staff_kana like 'ﾎﾞ%' or m_staff_kana like 'ﾊﾟ%' or m_staff_kana like 'ﾋﾟ%' or m_staff_kana like 'ﾌﾟ%' or m_staff_kana like 'ﾍﾟ%' or m_staff_kana like 'ﾎﾟ%') ";
                } else if ($this->inp_m_staff_kana=="マ") {
                    $sql .= "and (m_staff_kana like 'マ%' or m_staff_kana like 'ミ%' or m_staff_kana like 'ム%' or m_staff_kana like 'メ%' or m_staff_kana like 'モ%' or ";
                    $sql .= "     m_staff_kana like 'ﾏ%' or m_staff_kana like 'ﾐ%' or m_staff_kana like 'ﾑ%' or m_staff_kana like 'ﾒ%' or m_staff_kana like 'ﾓ%') ";
                } else if ($this->inp_m_staff_kana=="ヤ") {
                    $sql .= "and (m_staff_kana like 'ヤ%' or m_staff_kana like 'ユ%' or m_staff_kana like 'ヨ%' or ";
                    $sql .= "     m_staff_kana like 'ﾔ%' or m_staff_kana like 'ﾕ%' or m_staff_kana like 'ﾖ%') ";
                } else if ($this->inp_m_staff_kana=="ラ") {
                    $sql .= "and (m_staff_kana like 'ラ%' or m_staff_kana like 'リ%' or m_staff_kana like 'ル%' or m_staff_kana like 'レ%' or m_staff_kana like 'ロ%' or ";
                    $sql .= "     m_staff_kana like 'ﾗ%' or m_staff_kana like 'ﾘ%' or m_staff_kana like 'ﾙ%' or m_staff_kana like 'ﾚ%' or m_staff_kana like 'ﾛ%') ";
                } else if ($this->inp_m_staff_kana=="ワ") {
                    $sql .= "and (m_staff_kana like 'ワ%' or m_staff_kana like 'ヲ%' or m_staff_kana like 'ン%' or ";
                    $sql .= "     m_staff_kana like 'ﾜ%' or m_staff_kana like 'ｦ%' or m_staff_kana like 'ン%') ";
                }
            }
            if ($this->inp_m_staff_name != "") {
                $sql .= "AND m_staff_name = ? ";
            }
            if ($this->inp_m_staff_mail != "") {
                $sql .= " m_staff_mail = ? ";
            }
            if ($this->inp_m_staff_social_position != "") {
                $sql .= " m_staff_social_position = ? ";
            }
            if ($this->inp_m_staff_auth != "") {
                $sql .= "AND m_staff_auth = '" . $db->escape_string($this->inp_m_staff_auth) . "' ";
            }
            if ($this->inp_m_staff_del_flg != "") {
                $sql .= "AND m_staff_del_flg = '" . $db->escape_string($this->inp_m_staff_del_flg) . "' ";
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
            if ($this->inp_m_staff_taisyaday != "") {
                if ($this->inp_m_staff_taisyaday == 1) {
                        $today = date('Ymd');
                        $sql .= "AND (m_staff_taisya >= $today or m_staff_taisya is null) ";
                } else {
                    $sql .= "AND (m_staff_taisya >= '" . $db->escape_string($this->inp_m_staff_taisyaday) . "' or m_staff_taisya is null) ";
                }
            }

            if ($this->inp_m_staff_genba_id_or) {
                $sql .= "OR m_staff_genba_id = '" . $db->escape_string($this->inp_m_staff_genba_id_or) . "' ";
            }

            if (!is_null($this->inp_m_staff_company) && $this->inp_m_staff_company != "") {
                $sql .= "AND m_staff_company = '" . $db->escape_string($this->inp_m_staff_company) . "' ";
            }

            if ($this->inp_order == "") {
                $sql .= "ORDER BY m_staff_kana ";
            } else {
                $sql .= $db->escape_string($this->inp_order)." ";
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
                    $this->oup_m_staff_genba_id[]         = $row[$i++];
                    $this->oup_m_staff_nyusya[]         = $row[$i++];
                    $this->oup_m_staff_taisya[]         = $row[$i++];
                    $this->oup_m_staff_company[]         = $row[$i++];
                    $this->oup_m_staff_del_flg[]          = $row[$i++];
                    $this->oup_m_staff_created[]          = $row[$i++];
                    $this->oup_m_staff_created_staffid[]  = $row[$i++];
                    $this->oup_m_staff_modified[]         = $row[$i++];
                    $this->oup_m_staff_modified_staffid[] = $row[$i++];
                    $this->oup_m_staff_haiti_name[] = $row[$i++];
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
                 . ",   m_staff_genba_id "
                 . ",   m_staff_nyusya "
                 . ",   m_staff_taisya "
                 . ",   m_staff_company "
                 . ",   m_staff_haiti_name "
                 . ",   m_staff_del_flg "
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
                 . ",    '".$this->inp_m_staff_genba_id."'";
                 //if ($this->inp_m_staff_nyusya == "") {
                 //   $sql .= ",    null";
                 //} else {
                    $sql .= ",    '".$this->inp_m_staff_nyusya."'";
                 //}
                 //if ($this->inp_m_staff_taisya == "") {
                 //   $sql .= ",    null";
                 //} else {
                    $sql .= ",    '".$this->inp_m_staff_taisya."'";
                 //}
                 $sql .= ",    '".$this->inp_m_staff_company."'"
                 . ",    '".$this->inp_m_staff_haiti_name."'"
                 . ",    '".$this->inp_m_staff_del_flg."'"
                 . ",    '".$this->inp_m_staff_created."'"
                 . ",    '".$this->inp_m_staff_created_staffid."'"
                 . ",    '".$this->inp_m_staff_modified."'"
                 . ",    '".$this->inp_m_staff_modified_staffid."'"
                 . ") ";

 //var_dump($sql);
 //exit;

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
                if ($this->inp_m_staff_genba_id != "") {
                    $sql .= ",   m_staff_genba_id = '" . $db->escape_string($this->inp_m_staff_genba_id) . "' ";
                }
                if (!is_null($this->inp_m_staff_nyusya)) {
                    $sql .= ",   m_staff_nyusya = '" . $db->escape_string($this->inp_m_staff_nyusya) . "' ";
                }
                if (!is_null($this->inp_m_staff_taisya)) {
                //if ($this->inp_m_staff_taisya == "null") {
                //    $sql .= ",   m_staff_taisya = null ";
                //} else {
                    $sql .= ",   m_staff_taisya = '" . $db->escape_string($this->inp_m_staff_taisya) . "' ";
                //}
                }
                if (!is_null($this->inp_m_staff_company)) {
                    $sql .= ",   m_staff_company = '" . $db->escape_string($this->inp_m_staff_company) . "' ";
                }
                if ($this->inp_m_staff_haiti_name != "") {
                    $sql .= ",   m_staff_haiti_name = '" . $db->escape_string($this->inp_m_staff_haiti_name) . "' ";
                }
                if ($this->inp_m_staff_del_flg != "") {
                    $sql .= ",   m_staff_del_flg = '" . $db->escape_string($this->inp_m_staff_del_flg) . "' ";
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
            if ($this->inp_m_staff_id2 != "") {
                $sql .= "AND m_staff_id = '" . $db->escape_string($this->inp_m_staff_id2) . "' ";
            }

// var_dump($sql);
 //exit;

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

        // 協力会社のみ削除（協力会社一覧から協力会社を削除する際）
        public function updateStaffCompany() {
            $db = new Db();
            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_staff SET m_staff_id = '" . $this->inp_m_staff_id . "' ";
                // if ($this->inp_m_staff_company_id) {
                //     $sql .= ",   m_staff_company = '' ";
                // }
            $sql .= ",   m_staff_company = '' ";
            $sql .= "WHERE 0 = 0 ";
            if ($this->inp_m_staff_id != "") {
                $sql .= "AND m_staff_id = '" . $db->escape_string($this->inp_m_staff_id) . "' ";
            }

            // var_dump($sql);
            // exit;

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
