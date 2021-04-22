<?php 

    // 現場クラス
    class ReportMail
    {
        // 変数の宣言
        // public $inp_t_report_no;
        // public $inp_t_report_send_date;
        // public $inp_t_report_id;

        // public $oup_t_report_no;
        // public $oup_t_report_send_date;
        // public $oup_t_report_id;

        // 入力チェック

        // セレクト
        public function getReportMail() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                .     "t_report_no "
                . ",   t_report_kanri_no "
                . ",   t_report_send_date "
                . ",   t_report_id "
                . "FROM "
                .     "t_report_mail "
                . "WHERE 0 = 0 ";

                if ($this->inp_t_report_kanri_no) {
                    $sql .= "AND t_report_kanri_no = '" . $db->escape_string($this->inp_t_report_kanri_no) . "' ";
                }
                if ($this->inp_t_report_id) {
                $sql .= "AND t_report_id = '" . $db->escape_string($this->inp_t_report_id) . "' ";
            }

            if (!$this->inp_order) {
                $sql .= "order by t_report_send_date ";
            } else {
                $sql .= $db->escape_string($this->inp_order);
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

            //var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;
                    $this->oup_t_report_no[]             = $row[$i++];
                    $this->oup_t_report_kanri_no[]             = $row[$i++];
                    $this->oup_t_report_send_date[]      = $row[$i++];
                    $this->oup_t_report_id[]             = $row[$i++];
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);

            }

            return $result;

        }

        // インサート
        public function insertReportMail() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO t_report_mail"
                . "( "
                // .     "t_report_no "
                .     "t_report_kanri_no "
                . ",   t_report_send_date "
                . ",   t_report_id "
                . ") "
                . "VALUES "
                . "( ";
                // $sql .= "    '".$this->inp_t_report_no."'";
                $sql .= "    '".$this->inp_t_report_kanri_no."'";
                if ($this->inp_t_report_send_date) {
                    $sql .= ",    '".$this->inp_t_report_send_date."'";
                } else {
                    $sql .= ",    null ";
                }
                if ($this->inp_t_report_id) {
                    $sql .= ",    '".$this->inp_t_report_id."'";
                } else {
                    $sql .= ",    null ";
                }
                $sql .= " )";

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
        public function updateReportMail() {

            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE t_report_mail SET "
                . "    t_report_no = '" . $this->inp_t_report_no . "' ";
                if ($this->inp_t_report_id) {
                    $sql .= ",   t_report_id = '" . $db->escape_string($this->inp_t_report_id) . "' ";
                }
                if ($this->inp_t_report_send_date) {
                    $sql .= ",   t_report_send_date = '" . $db->escape_string($this->inp_t_report_send_date) . "' ";
                } 
            $sql .= "WHERE 0 = 0 ";
            $sql .= "AND t_report_no = '" . $db->escape_string($this->inp_t_report_no) . "' ";

            // var_dump($sql);
            // echo json_encode($sql);
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

    }
?>
