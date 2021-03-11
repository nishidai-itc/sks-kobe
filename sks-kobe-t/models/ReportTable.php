<?php 

    // 警備報告書のテーブルの取得列
    class ReportTable
    {
        // 変数の宣言

        public static $report1 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","wk_ship1","wk_ship_in_port_time1","wk_ship_out_port_time1",
            "wk_ship2","wk_ship_in_port_time2","wk_ship_out_port_time2","wk_ship3","wk_ship_in_port_time3","wk_ship_out_port_time3","wk_ship4","wk_ship_in_port_time4",
            "wk_ship_out_port_time4","wk_ship5","wk_ship_in_port_time5","wk_ship_out_port_time5","wk_ship6","wk_ship_in_port_time6","wk_ship_out_port_time6","wk_ship7",
            "wk_ship_in_port_time7","wk_ship_out_port_time7","wk_ship8","wk_ship_in_port_time8","wk_ship_out_port_time8","wk_ship9","wk_ship_in_port_time9","wk_ship_out_port_time9",
            "in_out_start_time","in_out_end_time","wk_joban_time","wk_kaban_time","wk_vp_end_time","wk_vp_kaban_time","koyo_joban_time","koyo_kaban_time","sumii_joban_time",
            "sumii_kaban_time","last_exit","yard_on_time1","yard_off_time1","yard_on_time2","yard_off_time2","depo_joban_time","depo_kaban_time","depo_num","depo_zan","sort_joban_time",
            "sort_kaban_time","sort_num","sort_zan","cy_joban_time","cy_kaban_time","cy_num","cy_zan","exit_joban_time","exit_kaban_time","exit_num","exit_zan","vp_joban_time","vp_kaban_time","vp_num",
            "vp_zan","midday_joban_time","midday_kaban_time","midday_num","midday_zan","gate_joban_time","gate_kaban_time","gate_num","gate_zan","mbath_joban_time","mbath_kaban_time","mbath_num",
            "mbath_zan","picket_joban_time1","picket_kaban_time1","picket_num1","picket_zan1","picket_joban_time2","picket_kaban_time2","picket_num2","picket_zan2","picket_joban_time3",
            "picket_kaban_time3","picket_num3","picket_zan3","picket_joban_time4","picket_kaban_time4","picket_num4","picket_zan4","comment","patrol_time1","patrol_time2","patrol_time3",
            "patrol_time4","patrol_time5","patrol_time6","patrol_time7","patrol_time8","metertb1","metertb2","metertc1","metertc2","wk_staff_id1","wk_staff_id2","wk_staff_id3","wk_staff_id4",
            "wk_staff_id5","wk_staff_id6","wk_staff_id7","wk_staff_id8","wk_staff_id9","wk_staff_id10","wk_staff_id11","wk_staff_id12","wk_staff_id13","wk_staff_id14","wk_staff_id15","wk_comment"
        );

        public static $report2 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","wk_end_time","flag1_time","flag2_time","picket_end_time",
            "comment",
        );

        public static $report7 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","staff_id2",
        );


        // 日本郵船神戸コンテナターミナル
        public static $report11 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","patrol_time1","bath1","sip1","in_port_time1",
            "out_port_time1","patrol_time2","bath2","sip2","in_port_time2","out_port_time2","patrol_time3","bath3","sip3","in_port_time3","out_port_time3","patrol_time4",
            "bath4","sip4","in_port_time4","out_port_time4","patrol_time5","bath5","sip5","in_port_time5","out_port_time5","front_gate_start_time","front_gate_end_time",
            "east_gate_start_time","east_gate_end_time","west_gate_start_time","west_gate_end_time","over_time_num","over_time_name","over_start_time","over_end_time",
            "yard","yard1_start_time","yard1_end_time","yard2_start_time","yard2_end_time","cam_time","cam_text","fence_time","fence_text","etc_comment1","etc_comment2",
            "wk_staff_id1","wk_staff_id2","wk_staff_id3","wk_staff_id4","wk_staff_id5","wk_staff_id6","wk_staff_id7","wk_staff_id8","wk_staff_id9","wk_staff_id10",
            "wk_staff_id11","wk_staff_id12","wk_staff_id13","wk_staff_id14","wk_staff_id15","wk_staff_id16","wk_staff_id17","wk_staff_id18"
        );

        public static $report12 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","gate1","gate2",
        );

        public static $report13 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","wk_start_time","wk_end_time","picket_start_time","picket_end_time",
            "comment","patrol_time1","patrol_time2","patrol_time3","patrol_time4","wk_staff_id1","wk_staff_id2","wk_staff_id3","wk_staff_id4","etc_comment",
        );

        public static $report14 = array(
            "no","table","start_date","weather1","weather2","wk_staff_id1","wk_joban_time1","wk_kaban_time1","wk_zan1","wk_staff_id2","wk_joban_time2","wk_kaban_time2","wk_zan2",
            "wk_staff_id3","wk_joban_time3","wk_kaban_time3","wk_zan3","wk_staff_id4","wk_joban_time4","wk_kaban_time4","wk_zan4","picket_joban_time","picket_kaban_time","comment",
        );

        public static $reportkanri = array("no","plan_date","table"/*,"table_no"*/,"gchk","name_no","kbn");

        public static $reportname = array("no","table","place","contract","genba_id");

        // public function __construct() {
        // }

        // // セレクト
        // public function test() {
        // }

        // 警備報告書管理マスタ
        // public function getReportKanri() {
        //     $row = NULL;
        //     $db = new Db();
        //     $db->connect();
        //     $sql = "SELECT t_report_no,t_report_plan_date,t_report_id,t_report_id_no,t_report_gchk,t_report_name_no,t_report_kbn ";
        //     $sql .= "from t_report_kanri where 0 = 0 ";
        //     foreach ($this as $key => $value) {
        //         $sql .= "and t_report_".str_replace("inp_","",$key)." = '".$db->escape_string($value)."' ";
        //     }
        //     // SQL実行
        //     // 文字化け防止
        //     $db->set_charset();

        //     // var_dump($sql);
        //     // exit;

        //     // プリペアドクエリを実行する
        //     if ($this->result = $db->query($sql)) {
        //         while ($row = mysqli_fetch_row($this->result)) {
        //             $i = 0;
        //             $this->oup_no[]                     = $row[$i++];
        //             $this->oup_plan_date[]              = $row[$i++];
        //             $this->oup_id[]                     = $row[$i++];
        //             $this->oup_id_no[]                  = $row[$i++];
        //             $this->oup_gchk[]                   = $row[$i++];
        //             $this->oup_name_no[]                = $row[$i++];
        //             $this->oup_kbn[]                    = $row[$i++];
        //         }
        //         /* 結果セットを開放します */
        //         mysqli_free_result($this->result);
        //     }
        //     return $this->result;
        // }

    }
?>
