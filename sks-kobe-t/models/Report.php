<?php 

    // 警備報告書マスタクラス
    class Report extends ReportTable
    {
        // 変数の宣言

        // セレクト
        // 「クラス名」->inp_「「t_report_」以降のテーブルの列名」で渡す
        // 「クラス名」->oup_「「t_report_」以降のテーブルの列名」で戻ってくる
        // 引数にテーブルNo.を渡す
        public function getReport($number) {

            // var_dump(parent::${"report".$number});
            // exit;

            // ReportTableクラスで定義したテーブルのカラムを取得する
            $tableColumn = parent::${"report".$number};

            // 管理テーブルから取得
            if ($number == "kanri") {
                $number = "_kanri";
            // 名称テーブルから取得
            } elseif ($number == "name") {
                $number = "_name";
            }

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT ";
            
            for ($i=0;$i<count($tableColumn);$i++) {
                if ($i == 0) {
                    $sql .= "t_report".$number.".t_report_".$tableColumn[$i]." ";
                } else {
                    $sql .= ",t_report".$number.".t_report_".$tableColumn[$i]." ";
                }
            }
            $sql .= "from t_report".$number." ";
            if ($this->inp_join) {
                if ($this->inp_join == "kanri") {
                    $this->inp_join = "_kanri";
                } elseif ($this->inp_join == "name") {
                    $this->inp_join = "_name";
                }
                $sql .= "left join t_report".$this->inp_join." on t_report".$number.".t_report_table = t_report".$this->inp_join.".t_report_table ";
            }
            $sql .= "where 0 = 0 ";

            foreach ($this as $key => $value) {
                // スキップ
                if ($key == "inp_join" || $key == "inp_order") {
                    continue;
                }

                // 日付範囲検索
                if ($key == "inp_plan_start_date") {
                    // 管理テーブル
                    if ($number == "_kanri") {
                        $sql .= "and t_report".$number.".t_report_plan_date >= '".$db->escape_string($value)."' ";
                    } else {
                        $sql .= "and t_report".$number.".t_report_start_date >= '".$db->escape_string($value)."' ";
                    }
                // 日付範囲検索
                } elseif ($key == "inp_plan_end_date") {
                    // 管理テーブル
                    if ($number == "_kanri") {
                        $sql .= "and t_report".$number.".t_report_plan_date <= '".$db->escape_string($value)."' ";
                    } else {
                        $sql .= "and t_report".$number.".t_report_start_date <= '".$db->escape_string($value)."' ";
                    }
                } else {
                    // 文字列削除
                    $str = str_replace("inp_","",$key);
                    // where is not null句
                    if (strpos($str,"_NOTNULL") !== false) {
                        $sql .= "and t_report".$number.".t_report_".str_replace("_NOTNULL","",$str)." is not null ";
                    // where in句
                    } elseif (strpos($str,"_in") !== false) {
                        if (strpos($str,"not_in") !== false) {
                            $sql .= "and t_report".$number.".t_report_".str_replace("_not_in","",$str)." not in (".$value.") ";
                        } else {
                            $sql .= "and t_report".$number.".t_report_".str_replace("_in","",$str)." in (".$value.") ";
                        }
                    // where like句
                    } elseif (strpos($str,"_like") !== false) {
                        $sql .= "and t_report".$number.".t_report_".str_replace("_like","",$str)." like '%".$db->escape_string($value)."%' ";
                    } elseif (strpos($str,"_findInSet") !== false) {
                        $sql .= "and find_in_set ('".$db->escape_string($value)."',t_report".$number.".t_report_".str_replace("_findInSet","",$str).") ";
                    } else {
                        $sql .= "and t_report".$number.".t_report_".$str." = '".$db->escape_string($value)."' ";
                    }
                }
                // var_dump($key,$value);
            }

            // if ($this->inp_union) {
            //     $sql .= "union ".$db->escape_string($this->inp_union)." ";
            // }
            // $this->oup_union = $sql;

            if ($this->inp_order) {
                $sql .= $db->escape_string($this->inp_order);
            } else {
                "order by t_report".$number.".t_report_start_date";
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

            // var_dump($sql);
            // exit;

            // プリペアドクエリを実行する
            //  mysqli_stmt_execute($stmt);
            //    $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;
                    for ($j=0;$j<count($tableColumn);$j++) {
                        // 時刻は「時：分」に整形
                        if (strpos($tableColumn[$j],"time") !== false && strpos($row[$i],":") !== false) {
                            $time                                   = explode(":",$row[$i++]);
                            $this->{"oup_".$tableColumn[$j]}[]             = $time[0].":".$time[1];
                            continue;
                        }
                        $this->{"oup_".$tableColumn[$j]}[]             = $row[$i++];
                    }
                    // var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);

            }

            return $this->result;

        }

        // インサート
        public function insertReport($number) {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            if ($number == "kanri") {
                $number = "_kanri";
            }

            $sql = "INSERT INTO t_report".$number." ( ";
            for ($i=0;$i<2;$i++) {
                $cnt = 0;
                foreach ($this as $key2 => $value2) {
                    if ($i == 0) {
                        if ($cnt == 0) {
                            $sql .= "t_report_".str_replace("inp_","",$key2)." ";
                            $cnt = 1;
                        } else {
                            $sql .= ", t_report_".str_replace("inp_","",$key2)." ";
                        }
                    } else {
                        if ($cnt == 0) {
                            $sql .= ") values ( ";
                            $sql .= !is_null($value2) ? "'".$value2."' " : "null ";
                            $cnt = 1;
                        } else {
                            $sql .= !is_null($value2) ? ", '".$value2."' " : ", null ";
                        }
                    }
                }
            }
            $sql .= ") ";

            // var_dump($sql);
            // exit;

            require dirname(__FILE__).'/common/log.php';

            // 文字化け防止
            $db->set_charset();

            // クエリを送信する
            $db->prepare($sql);

            // プリペアドクエリを実行する
            $db->stmt_execute();

            $this->oup_last_id = mysqli_insert_id($db->link);

            // 結果保持用メモリを開放する
            $db->stmt_close();

            // MySQLへの接続を閉じる
            $db->close();

        }

        // アップデート
        public function updateReport($number) {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            if ($number == "kanri") {
                $number = "_kanri";
            }

            $sql = "UPDATE t_report".$number." SET ";
            $cnt = 0;
            foreach ($this as $key3 => $value3) {
                if ($key3 == "inp_no") {
                    continue;
                }
                if ($cnt == 0) {
                    if (!is_null($value3)) {
                        $sql .= "t_report_".str_replace("inp_","",$key3)." = '".$db->escape_string($value3)."' ";
                    } else {
                        $sql .= "t_report_".str_replace("inp_","",$key3)." = null ";
                    }
                    $cnt = 1;
                } else {
                    if (!is_null($value3)) {
                        $sql .= ", t_report_".str_replace("inp_","",$key3)." = '".$db->escape_string($value3)."' ";
                    } else {
                        $sql .= ", t_report_".str_replace("inp_","",$key3)." = null ";
                    }
                }
            }

            $sql .= "WHERE 0 = 0 AND t_report_no = ".$db->escape_string($this->inp_no);

            // var_dump($sql);
            // exit;

            require dirname(__FILE__).'/common/log.php';

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
        public function deleteReport($number) {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            if ($number == "kanri") {
                $number = "_kanri";
            }

            $sql  = "DELETE FROM t_report".$number." ";
            $sql .= "WHERE t_report_no = ".$db->escape_string($this->inp_no)." ";

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

        // 本船名取得
        public function getReportShip() {

            // $tableColumn = parent::${"report".$number};

            // if ($number == "kanri") {
            //     $number = "_kanri";
            // } elseif ($number == "name") {
            //     $number = "_name";
            // }

            $row = NULL;
            $db = new Db();
            $db->connect();

            $sql = "SELECT ";
            $sql .= "t_report_no ";
            for ($i=1;$i<=10;$i++) {
                $sql .= ",t_report_wk_ship".$i." ";
            }
            $sql .= "from t_report1 ";
            $sql .= "where 0 = 0 ";

            // if ($this->inp_union) {
            //     $sql .= "union ".$db->escape_string($this->inp_union)." ";
            // }
            // $this->oup_union = $sql;

            if ($this->inp_order) {
                $sql .= $db->escape_string($this->inp_order);
            }

            // SQL実行
            // 文字化け防止
            $db->set_charset();
            // var_dump($sql);
            // exit;

            // プリペアドクエリを実行する
            //  mysqli_stmt_execute($stmt);
            //    $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;
                    $this->oup_no[]             = $row[$i++];
                    for ($j=1;$j<=10;$j++) {
                        $this->{"oup_wk_ship".$j}[]             = $row[$i++];
                    }
                }
                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;
        }

    }
?>
