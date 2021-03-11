<?php 

    // 現場クラス
    class Cooperation
    {
        // 変数の宣言
        public $inp_m_company_id;
        public $inp_m_company_name;
        public $inp_m_company_kana;
        //public $inp_m_genba_oya_id = null;
        public $inp_m_company_del_flg;
        public $inp_m_company_created;
        public $inp_m_company_created_id;
        public $inp_m_company_modified;
        public $inp_m_company_modified_id;

        public $oup_m_company_id;
        public $oup_m_company_name;
        public $oup_m_company_kana;
        //public $oup_m_company_oya_id;
        public $oup_m_company_del_flg;
        public $oup_m_company_created;
        public $oup_m_company_created_id;
        public $oup_m_company_modified;
        public $oup_m_company_modified_id;
        
        //public $inp_m_genba_hyoji_kbn;
        //public $oup_m_genba_hyoji_kbn;
        
        public $inp_m_company_deleteday = null;
        public $oup_m_company_deleteday;

        // 入力チェック
        public function inputCheck() {
            if ($this->inp_m_company_id == "") {
                $this->errmsg .= "協力会社IDを入力してください。<br />";
            } 
            //elseif ($this->inp_m_company_flg != 1 && $this->inp_m_company_cnt == 1) {
            //    $this->errmsg .= "既に登録されているIDです。<br />";
            //}
            //elseif ($this->inp_m_company_name == "") {
            //    $this->errmsg .= "協力会社名を入力してください。<br />";
            //}
            //else if ($this->inp_m_genba_hyoji_kbn == "") {
            //    $this->errmsg .= "表示順序を入力してください。<br />";
            //} else if (strlen($this->inp_m_genba_hyoji_kbn) != "4") {
            //    $this->errmsg .= "4ケタで入力してください。<br />";
            //}
        }

        // セレクト
        public function getCompany() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_company_id "
                 . ",   m_company_name "
                 . ",   m_company_kana "
                 //. ",   m_company_oya_id "
                 . ",   m_company_del_flg "
                 . ",   m_company_created "
                 . ",   m_company_created_id "
                 . ",   m_company_modified "
                 . ",   m_company_modified_id "
                 //. ",   m_company_hyoji_kbn "
                 . ",   m_company_deleteday "
                 . "FROM "
                 .     "m_cooperation "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_company_id != "") {
                $sql .= "AND m_company_id = '" . $db->escape_string($this->inp_m_company_id) . "' ";
            }
            if ($this->inp_m_company_del_flg != "") {
                $sql .= "AND m_company_del_flg = '" . $db->escape_string($this->inp_m_company_del_flg) . "' ";
            }
            //if ($this->inp_m_company_deleteday != "") {
            //    if ($this->inp_m_company_deleteday == 1) {
            //        $today = date('Ymd');
            //        $sql .= "AND (m_company_deleteday >= $today or m_company_deleteday is null)";
            //    } else {
            //        $sql .= "AND (m_company_deleteday >= '" . substr($db->escape_string($this->inp_m_company_deleteday),0,4) ."-".substr($db->escape_string($this->inp_m_company_deleteday),4,2)."-".substr($db->escape_string($this->inp_m_company_deleteday),6,2). "' or m_company_deleteday is null)";
            //    }
            //}
            if ($this->inp_order == "") {
                $sql .= "order by m_company_id,m_company_kana ";
            } else {
                $sql .= $db->escape_string($this->inp_order);
            }

                //$sql .= "order by m_genba_kana ";

            // SQL実行

            // 文字化け防止
            $db->set_charset();

 //var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_m_company_id[]             = $row[$i++];
                    $this->oup_m_company_name[]           = $row[$i++];
                    $this->oup_m_company_kana[]           = $row[$i++];
                    //$this->oup_m_company_oya_id[]         = $row[$i++];
                    $this->oup_m_company_del_flg[]        = $row[$i++];
                    $this->oup_m_company_created[]        = $row[$i++];
                    $this->oup_m_company_created_id[]     = $row[$i++];
                    $this->oup_m_company_modified[]       = $row[$i++];
                    $this->oup_m_company_modified_id[]    = $row[$i++];
                    //$this->oup_m_company_hyoji_kbn[]    = $row[$i++];
                    $this->oup_m_company_deleteday[]    = $row[$i++];

// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);

            }

            return $result;

        }

        // インサート
        public function insertCompany() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_cooperation "
                 . "( "
                 .     "m_company_id "
                 . ",   m_company_name "
                 . ",   m_company_kana "
                 . ",   m_company_created "
                 . ",   m_company_created_id "
                 //. ",   m_company_hyoji_kbn "
                 //. ",   m_company_oya_id "
                 . ",   m_company_deleteday "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_m_company_id."'"
                 . ",    '".$this->inp_m_company_name."'"
                 . ",    '".$this->inp_m_company_kana."'"
                 . ",    '".$this->inp_m_company_created."'"
                 . ",    '".$this->inp_m_company_created_id."'"
                 //. ",    '".$this->inp_m_company_hyoji_kbn."'"
                 //. ",    '".$this->inp_m_company_oya_id."'"
                 . ",    '".$this->inp_m_company_deleteday."'"
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
        public function updateCompany() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_cooperation SET "
                 . "    m_company_id = '" . $this->inp_m_company_id . "' ";
                if ($this->inp_m_company_name != "") {
                    $sql .= ",   m_company_name = '" . $db->escape_string($this->inp_m_company_name) . "' ";
                }
                if ($this->inp_m_company_kana != "") {
                    $sql .= ",   m_company_kana = '" . $db->escape_string($this->inp_m_company_kana) . "' ";
                }
                if ($this->inp_m_company_del_flg != "") {
                    $sql .= ",   m_company_del_flg = '" . $db->escape_string($this->inp_m_company_del_flg) . "' ";
                }
                if ($this->inp_m_company_modified != "") {
                    $sql .= ",   m_company_modified = '" . $db->escape_string($this->inp_m_company_modified) . "' ";
                }
                if ($this->inp_m_company_modified_id != "") {
                    $sql .= ",   m_company_modified_id = '" . $db->escape_string($this->inp_m_company_modified_id) . "' ";
                }
                //if ($this->inp_m_company_hyoji_kbn != "") {
                //    $sql .= ",   m_company_hyoji_kbn = '" . $db->escape_string($this->inp_m_company_hyoji_kbn) . "' ";
                //}
                if (!is_null($this->inp_m_company_deleteday)) {
                    $sql .= ",   m_company_deleteday = '" . $db->escape_string($this->inp_m_company_deleteday) . "' ";
                }
                $sql .= "WHERE 0 = 0 ";
                $sql .= "AND m_company_id = '" . $db->escape_string($this->inp_m_company_id2) . "' ";
                //$sql .= "AND m_company_id = '" . $db->escape_string($this->inp_m_company_id) . "' ";

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
//exit;
        }

        // デリート
        public function deleteCompany() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql  = "DELETE FROM m_cooperation ";
            $sql .= "WHERE m_company_id = '" . $db->escape_string($this->inp_m_company_id) . "' ";

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

    }
?>
