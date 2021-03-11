<?php 

    // 現場クラス
    class Genba
    {
        // 変数の宣言
        public $inp_m_genba_id;
        public $inp_m_genba_name;
        public $inp_m_genba_kana;
        public $inp_m_genba_oya_id = null;
        public $inp_m_genba_del_flg;
        public $inp_m_genba_created;
        public $inp_m_genba_created_id;
        public $inp_m_genba_modified;
        public $inp_m_genba_modified_id;

        public $oup_m_genba_id;
        public $oup_m_genba_name;
        public $oup_m_genba_kana;
        public $oup_m_genba_oya_id;
        public $oup_m_genba_del_flg;
        public $oup_m_genba_created;
        public $oup_m_genba_created_id;
        public $oup_m_genba_modified;
        public $oup_m_genba_modified_id;
        
        public $inp_m_genba_hyoji_kbn;
        public $oup_m_genba_hyoji_kbn;
        
        public $inp_m_genba_deleteday = null;
        public $oup_m_genba_deleteday;

        // 入力チェック
        public function inputCheck() {
            if ($this->inp_m_genba_id == "") {
                $this->errmsg .= "現場IDを入力してください。<br />";
            } 
            else if ($this->inp_m_genba_hyoji_kbn == "") {
                $this->errmsg .= "表示順序を入力してください。<br />";
            } else if (strlen($this->inp_m_genba_hyoji_kbn) != "4") {
                $this->errmsg .= "4ケタで入力してください。<br />";
            }
        }

        // セレクト
        public function getGenba() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_genba_id "
                 . ",   m_genba_name "
                 . ",   m_genba_kana "
                 . ",   m_genba_oya_id "
                 . ",   m_genba_del_flg "
                 . ",   m_genba_created "
                 . ",   m_genba_created_id "
                 . ",   m_genba_modified "
                 . ",   m_genba_modified_id "
                 . ",   m_genba_hyoji_kbn "
                 . ",   m_genba_deleteday "
                 . "FROM "
                 .     "m_genba "
                 . "WHERE 0 = 0 ";

            //$sql .= "AND m_genba_id != '9999' ";
            if ($this->inp_m_genba_id != "") {
                $sql .= "AND m_genba_id = '" . $db->escape_string($this->inp_m_genba_id) . "' ";
            }
            if ($this->inp_m_genba_id2 != "") {
                $sql .= "AND m_genba_id in (" . $this->inp_m_genba_id2 . ") ";
            }
            if ($this->inp_m_genba_id9999 != "") {
                $sql .= "AND m_genba_id != '9999' ";
            }
            if ($this->inp_m_genba_del_flg != "") {
                $sql .= "AND m_genba_del_flg = '" . $db->escape_string($this->inp_m_genba_del_flg) . "' ";
            }
            if ($this->inp_m_genba_oya_id != "") {
                $sql .= "AND m_genba_oya_id = '" . $db->escape_string($this->inp_m_genba_oya_id) . "' ";
            }
            if ($this->inp_m_genba_oya_id2 != "") {
                $sql .= "AND m_genba_oya_id in (" . $this->inp_m_genba_oya_id2 . ") ";
            }
            if ($this->inp_m_genba_deleteday2 != "") {
                $sql .= "AND (m_genba_deleteday != '0000-00-00' && m_genba_deleteday < '" . substr($db->escape_string($this->inp_m_genba_deleteday2),0,4) ."-".substr($db->escape_string($this->inp_m_genba_deleteday2),4,2)."-".substr($db->escape_string($this->inp_m_genba_deleteday2),6,2). "') ";
            }
            if ($this->inp_m_genba_deleteday != "") {
                if ($this->inp_m_genba_deleteday == 1) {
                    $today = date('Ymd');
                    $sql .= "AND (m_genba_deleteday >= $today or m_genba_deleteday is null)";
                } else {
                    $sql .= "AND (m_genba_deleteday >= '" . substr($db->escape_string($this->inp_m_genba_deleteday),0,4) ."-".substr($db->escape_string($this->inp_m_genba_deleteday),4,2)."-".substr($db->escape_string($this->inp_m_genba_deleteday),6,2). "' or m_genba_deleteday is null)";
                }
            }
            if ($this->inp_order == "") {
                $sql .= "order by m_genba_hyoji_kbn,m_genba_kana ";
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

                    $this->oup_m_genba_id[]             = $row[$i++];
                    $this->oup_m_genba_name[]           = $row[$i++];
                    $this->oup_m_genba_kana[]           = $row[$i++];
                    $this->oup_m_genba_oya_id[]         = $row[$i++];
                    $this->oup_m_genba_del_flg[]        = $row[$i++];
                    $this->oup_m_genba_created[]        = $row[$i++];
                    $this->oup_m_genba_created_id[]     = $row[$i++];
                    $this->oup_m_genba_modified[]       = $row[$i++];
                    $this->oup_m_genba_modified_id[]    = $row[$i++];
                    $this->oup_m_genba_hyoji_kbn[]    = $row[$i++];
                    $this->oup_m_genba_deleteday[]    = $row[$i++];

// var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);

            }

            return $result;

        }

        // インサート
        public function insertGenba() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_genba "
                 . "( "
                 .     "m_genba_id "
                 . ",   m_genba_name "
                 . ",   m_genba_kana "
                 . ",   m_genba_created "
                 . ",   m_genba_created_id "
                 . ",   m_genba_hyoji_kbn "
                 . ",   m_genba_oya_id "
                 . ",   m_genba_deleteday "
                 . ") "
                 . "VALUES "
                 . "( "
                 .      "'".$this->inp_m_genba_id."'"
                 . ",    '".$this->inp_m_genba_name."'"
                 . ",    '".$this->inp_m_genba_kana."'"
                 . ",    '".$this->inp_m_genba_created."'"
                 . ",    '".$this->inp_m_genba_created_id."'"
                 . ",    '".$this->inp_m_genba_hyoji_kbn."'"
                 . ",    '".$this->inp_m_genba_oya_id."'";
                 //if ($this->inp_m_genba_deleteday == "" || $this->inp_m_genba_deleteday == null) {
                 //   $sql .= ",    null";
                 //} else {
                    $sql .= ",    '".$this->inp_m_genba_deleteday."'";
                 //}
                 $sql .= ") ";

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
        public function updateGenba() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE m_genba SET "
                 . "    m_genba_id = '" . $this->inp_m_genba_id . "' ";
                if ($this->inp_m_genba_name != "") {
                    $sql .= ",   m_genba_name = '" . $db->escape_string($this->inp_m_genba_name) . "' ";
                }
                if ($this->inp_m_genba_kana != "") {
                    $sql .= ",   m_genba_kana = '" . $db->escape_string($this->inp_m_genba_kana) . "' ";
                }
                if ($this->inp_m_genba_del_flg != "") {
                    $sql .= ",   m_genba_del_flg = '" . $db->escape_string($this->inp_m_genba_del_flg) . "' ";
                }
                if ($this->inp_m_genba_modified != "") {
                    $sql .= ",   m_genba_modified = '" . $db->escape_string($this->inp_m_genba_modified) . "' ";
                }
                if ($this->inp_m_genba_modified_id != "") {
                    $sql .= ",   m_genba_modified_id = '" . $db->escape_string($this->inp_m_genba_modified_id) . "' ";
                }
                if ($this->inp_m_genba_hyoji_kbn != "") {
                    $sql .= ",   m_genba_hyoji_kbn = '" . $db->escape_string($this->inp_m_genba_hyoji_kbn) . "' ";
                }
                if (!is_null($this->inp_m_genba_oya_id)) {
                    $sql .= ",   m_genba_oya_id = '" . $db->escape_string($this->inp_m_genba_oya_id) . "' ";
                }
                if (!is_null($this->inp_m_genba_deleteday)) {
                    $sql .= ",   m_genba_deleteday = '" . $db->escape_string($this->inp_m_genba_deleteday) . "' ";
                }
                //if ($this->inp_m_genba_oya_id != "") {
                //    $sql .= ",   m_genba_oya_id = '" . $db->escape_string($this->inp_m_genba_oya_id) . "' ";
                //}
                //if ($this->inp_m_genba_oya_id == null) {
                //    $sql .= ",   m_genba_oya_id = '' ";
                //}
                $sql .= "WHERE 0 = 0 ";
                $sql .= "AND m_genba_id = '" . $db->escape_string($this->inp_m_genba_id2) . "' ";

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
//exit;
        }

        // デリート
        public function deleteGenba() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql  = "DELETE FROM m_genba ";
            $sql .= "WHERE m_genba_id = '" . $db->escape_string($this->inp_m_genba_id) . "' ";

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
