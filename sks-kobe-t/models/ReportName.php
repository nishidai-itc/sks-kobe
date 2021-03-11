<?php 

    // 警備報告書のテーブルの取得列
    class ReportName
    {
        // 変数の宣言
        public $oup_t_report_no;
        public $oup_t_report_table;
        public $oup_t_report_place;
        public $oup_t_report_contract;
        public $oup_t_report_genba_id;

        // セレクト
        public function getReportName() {

            $row = NULL;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_report_no "
                 . ",   t_report_table "
                 . ",   t_report_place "
                 . ",   t_report_contract "
                 . ",   t_report_genba_id "
                 . "FROM "
                 .     "t_report_name "
                 . "ORDER BY t_report_table ";

            // 文字化け防止
            $db->set_charset();

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {

                    $i = 0;

                    $this->oup_t_report_no[]            = $row[$i++];
                    $this->oup_t_report_table[]         = $row[$i++];
                    $this->oup_t_report_place[]         = $row[$i++];
                    $this->oup_t_report_contract[]      = $row[$i++];
                    $this->oup_t_report_genba_id[]      = $row[$i++];

                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }

            return $result;

        }
    }
?>
