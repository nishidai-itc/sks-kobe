<?php 

    // グループクラス
    class ReportGroup
    {
        // 変数の宣言
        public $inp_t_report_id;
        public $inp_t_report_kbn;
        public $inp_t_report_mail;
        public $inp_t_report_name;
        public $inp_t_report_company;
        public $inp_t_report_title;
        public $inp_t_report_body;
        public $inp_t_report_table;


        public $oup_t_report_id;
        public $oup_t_report_kbn;
        public $oup_t_report_mail;
        public $oup_t_report_name;
        public $oup_t_report_company;
        public $oup_t_report_title;
        public $oup_t_report_body;
        public $oup_t_report_table;
    
    

        // 入力チェック
        // public function inputCheck() {
        //     if ($this->inp_t_report_id == "") {
        //         $this->errmsg .= "現場IDを入力してください。<br />";
        //     } 
        //     else if ($this->inp_t_report_kbn == "") {
        //         $this->errmsg .= "表示順序を入力してください。<br />";
        //     } else if (strlen($this->inp_m_genba_hyoji_kbn) != "4") {
        //         $this->errmsg .= "4ケタで入力してください。<br />";
        //     }
        // }

        // セレクト
        public function getReportGroup() {

            $row = NULL;
        
            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                .     "t_report_id "
                . ",   t_report_kbn "
                . ",   t_report_mail "
                . ",   t_report_name "
                . ",   t_report_company "
                . ",   t_report_title "
                . ",   t_report_body "
                . ",   t_report_table "
                . "FROM "
                .     "t_report_group "
                . "WHERE 0 = 0 ";
            
            if ($this->inp_t_report_id != "") {
                    $sql .= "AND t_report_id = '" . $db->escape_string($this->inp_t_report_id) . "' ";
            }
            if ($this->inp_t_report_table_findInSet) {
                $sql .= "AND FIND_IN_SET('".$db->escape_string($this->inp_t_report_table_findInSet)."', t_report_table) ";
            }
            
            if ($this->inp_order == "") {
                $sql .= "order by t_report_id ";
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
                    $this->oup_t_report_id[]             = $row[$i++];
                    $this->oup_t_report_kbn[]           = $row[$i++];
                    $this->oup_t_report_mail[]           = $row[$i++];
                    $this->oup_t_report_name[]           = $row[$i++];
                    $this->oup_t_report_company[]           = $row[$i++]; 
                    $this->oup_t_report_title[]           = $row[$i++];
                    $this->oup_t_report_body[]           = $row[$i++];
                    $this->oup_t_report_table[]           = $row[$i++];
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }

            return $result;

        }

    }
?>
