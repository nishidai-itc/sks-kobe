<?php 

    // 警備報告書のテーブルの取得列
    class ReportTable
    {
        // 変数の宣言

        public static $report1 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","wk_ship1","wk_ship_in_port_time1","wk_ship_out_port_time1","wk_ship2","wk_ship_in_port_time2","wk_ship_out_port_time2",
            "wk_ship3","wk_ship_in_port_time3","wk_ship_out_port_time3","wk_ship4","wk_ship_in_port_time4","wk_ship_out_port_time4","wk_ship5","wk_ship_in_port_time5","wk_ship_out_port_time5",
            "wk_ship6","wk_ship_in_port_time6","wk_ship_out_port_time6","wk_ship7","wk_ship_in_port_time7","wk_ship_out_port_time7","wk_ship8","wk_ship_in_port_time8","wk_ship_out_port_time8",
            "wk_ship9","wk_ship_in_port_time9","wk_ship_out_port_time9","wk_ship10","wk_ship_in_port_time10","wk_ship_out_port_time10","wk_in_out_start_time","wk_in_out_end_time","wk_joban_time","wk_kaban_time",
            "wk_vp_end_time","wk_vp_kaban_time","koyo_joban_time","koyo_kaban_time","sumii_joban_time","sumii_kaban_time","last_exit","last_exit1","last_exit2","yard_on_time1","yard_off_time1","yard_on_time2","yard_off_time2",
            "depo_joban_time","depo_kaban_time","depo_num","depo_zan","sort_joban_time","sort_kaban_time","sort_num","sort_zan","cy_joban_time","cy_kaban_time","cy_num","cy_zan","exit_joban_time","exit_kaban_time","exit_num","exit_zan",
            "vp_joban_time","vp_kaban_time","vp_num","vp_zan","midday_joban_time","midday_kaban_time","midday_num","midday_zan","gate_joban_time","gate_kaban_time","gate_num","gate_zan",
            "mbath_joban_time","mbath_kaban_time","mbath_num","mbath_zan","picket_joban_time1","picket_kaban_time1","picket_num1","picket_zan1","picket_joban_time2","picket_kaban_time2","picket_num2",
            "picket_zan2","picket_joban_time3","picket_kaban_time3","picket_num3","picket_zan3","picket_joban_time4","picket_kaban_time4","picket_num4","picket_zan4","comment","etc_comment",
            /*"patrol_time1","patrol_time2","patrol_time3","patrol_time4","patrol_time5","patrol_time6","patrol_time7","patrol_time8",*/"meterb1","meterb2","meterc1","meterc2","wk_staff_id1","wk_staff1_kbn","wk_staff1_zan1","wk_staff1_zan2","wk_staff1_zan3",
            "wk_staff_id2","wk_staff2_kbn","wk_staff2_zan1","wk_staff2_zan2","wk_staff2_zan3","wk_staff_id3","wk_staff3_kbn","wk_staff3_zan1","wk_staff3_zan2","wk_staff3_zan3","wk_staff_id4","wk_staff4_kbn","wk_staff4_zan1","wk_staff4_zan2","wk_staff4_zan3",
            "wk_staff_id5","wk_staff5_kbn","wk_staff5_zan1","wk_staff5_zan2","wk_staff5_zan3","wk_staff_id6","wk_staff6_kbn","wk_staff6_zan1","wk_staff6_zan2","wk_staff6_zan3","wk_staff_id7","wk_staff7_kbn","wk_staff7_zan1","wk_staff7_zan2","wk_staff7_zan3",
            "wk_staff_id8","wk_staff8_kbn","wk_staff8_zan1","wk_staff8_zan2","wk_staff8_zan3","wk_staff_id9","wk_staff9_kbn","wk_staff9_zan1","wk_staff9_zan2","wk_staff9_zan3","wk_staff_id10","wk_staff10_kbn","wk_staff10_zan1","wk_staff10_zan2","wk_staff10_zan3",
            "wk_staff_id11","wk_staff11_kbn","wk_staff11_zan1","wk_staff11_zan2","wk_staff11_zan3","wk_staff_id12","wk_staff12_kbn","wk_staff12_zan1","wk_staff12_zan2","wk_staff12_zan3","wk_staff_id13","wk_staff13_kbn","wk_staff13_zan1","wk_staff13_zan2","wk_staff13_zan3",
            "wk_staff_id14","wk_staff14_kbn","wk_staff14_zan1","wk_staff14_zan2","wk_staff14_zan3","wk_staff_id15","wk_staff15_kbn","wk_staff15_zan1","wk_staff15_zan2","wk_staff15_zan3","wk_staff_id16","wk_staff16_kbn","wk_staff16_zan1","wk_staff16_zan2","wk_staff16_zan3",
            "wk_staff_id17","wk_staff17_kbn","wk_staff17_zan1","wk_staff17_zan2","wk_staff17_zan3","wk_staff_id18","wk_staff18_kbn","wk_staff18_zan1","wk_staff18_zan2","wk_staff18_zan3","wk_comment"
        );

        public static $report2 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","wk_end_time","flag1_time","flag2_time","comment",
        );

        public static $report3 = array(
            "no","table","start_date","weather1","weather2","chief","staff_id","wk_haiti1","wk_staff_id1","wk_joban_time1","wk_kaban_time1","wk_haiti2","wk_staff_id2","wk_joban_time2","wk_kaban_time2",
            "wk_haiti3","wk_staff_id3","wk_joban_time3","wk_kaban_time3","wk_haiti4","wk_staff_id4","wk_joban_time4","wk_kaban_time4","wk_haiti5","wk_staff_id5","wk_joban_time5","wk_kaban_time5","wk_haiti6",
            "wk_staff_id6","wk_joban_time6","wk_kaban_time6","wk_haiti7","wk_staff_id7","wk_joban_time7","wk_kaban_time7","wk_haiti8","wk_staff_id8","wk_joban_time8","wk_kaban_time8","wk_haiti9","wk_staff_id9",
            "wk_joban_time9","wk_kaban_time9","wk_haiti10","wk_staff_id10","wk_joban_time10","wk_kaban_time10","wk_detail_time1","wk_detail_staff_id1","wk_detail_comment1","wk_detail_time2","wk_detail_staff_id2","wk_detail_time3",
            "wk_detail_staff_id3","wk_detail_time4","wk_detail_staff_id4","wk_detail_comment4","wk_detail_time5","wk_detail_staff_id5","wk_detail_time6","wk_detail_staff_id6","wk_detail_comment6","wk_detail_time7","wk_detail_staff_id7","wk_detail_time8","wk_detail_staff_id8",
            "wk_detail_time9","wk_detail_staff_id9","wk_detail_time10","wk_detail_staff_id10","wk_detail_time11","wk_detail_staff_id11","wk_detail_time12","wk_detail_staff_id12","wk_detail_comment12","wk_detail_time13","wk_detail_staff_id13",
            "wk_detail_time14","wk_detail_staff_id14","wk_detail_time15","wk_detail_staff_id15","wk_detail_time16","wk_detail_staff_id16","wk_detail_title17","wk_detail_time17","wk_detail_staff_id17","wk_detail_title18","wk_detail_time18",
            "wk_detail_staff_id18","wk_detail_time19","wk_detail_staff_id19","wk_detail_comment19","wk_detail_time20","wk_detail_staff_id20","wk_detail_time21","wk_detail_staff_id21","night_company","night_taiin_id","night_exit_time","night_staff_id",
        );

        public static $report5 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","ship1","ship_in_port_time1","ship_out_port_time1","ship2","ship_in_port_time2","ship_out_port_time2","ship3","ship_in_port_time3","ship_out_port_time3",
            "ship4","ship_in_port_time4","ship_out_port_time4","ship5","ship_in_port_time5","ship_out_port_time5","ship6","ship_in_port_time6","ship_out_port_time6","picket_joban_time1","picket_kaban_time1","picket_joban_time2","picket_kaban_time2","picket_joban_time3","picket_kaban_time3","comment","c2_kbn1","c2_joban_time1","c2_kaban_time1","c2_kbn2",
            "c2_joban_time2","c2_kaban_time2","c2_kbn3","c2_joban_time3","c2_kaban_time3","c2_kbn4","c2_joban_time4","c2_kaban_time4","c3_kbn1","c3_joban_time1","c3_kaban_time1","c3_kbn2","c3_joban_time2","c3_kaban_time2","c3_kbn3","c3_joban_time3","c3_kaban_time3","c3_kbn4","c3_joban_time4","c3_kaban_time4",
            "c4_kbn1","c4_joban_time1","c4_kaban_time1","c4_kbn2","c4_joban_time2","c4_kaban_time2","c4_kbn3","c4_joban_time3","c4_kaban_time3","c4_kbn4","c4_joban_time4","c4_kaban_time4","c5_kbn1","c5_joban_time1","c5_kaban_time1","c5_kbn2","c5_joban_time2","c5_kaban_time2","c5_kbn3","c5_joban_time3","c5_kaban_time3","c5_kbn4","c5_joban_time4","c5_kaban_time4",
            "tonbo_light_kbn1","tonbo_light_joban_time1","tonbo_light_kaban_time1","tonbo_light_kbn2","tonbo_light_joban_time2","tonbo_light_kaban_time2","tonbo_light_kbn3","tonbo_light_joban_time3","tonbo_light_kaban_time3","tonbo_light_kbn4","tonbo_light_joban_time4","tonbo_light_kaban_time4","c5_light_kbn1","c5_light_joban_time1","c5_light_kaban_time1",
            "c5_light_kbn2","c5_light_joban_time2","c5_light_kaban_time2","c5_light_kbn3","c5_light_joban_time3","c5_light_kaban_time3","c5_light_kbn4","c5_light_joban_time4","c5_light_kaban_time4","patrol_time1","patrol_time2","patrol_time3","patrol_time4",
            "patrol_time5","patrol_time6","patrol_time7","patrol_time8","patrol_time9","patrol_time10","patrol_time11","patrol_time12","patrol_time13","patrol_time14","patrol_time15","patrol_time16","wk_comment",
            "wk_admin_end","wk_outsider","wk_staff_id1","wk_staff_id1_kbn","wk_staff_id1_ken","wk_staff_id2","wk_staff_id2_kbn","wk_staff_id2_ken","wk_staff_id3","wk_staff_id3_kbn","wk_staff_id3_ken","wk_staff_id4","wk_staff_id4_kbn","wk_staff_id4_ken",
            "wk_staff_id5","wk_staff_id5_kbn","wk_staff_id5_ken","wk_staff_id6","wk_staff_id6_kbn","wk_staff_id6_ken","wk_staff_id7","wk_staff_id7_kbn","wk_staff_id7_ken","wk_staff_id8","wk_staff_id8_kbn","wk_staff_id8_ken","wk_staff_id9","wk_staff_id9_kbn","wk_staff_id9_ken"
        );

        public static $report6 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","wk_start_time1","wk_end_time1","wk_start_time2","wk_end_time2","wk_start_time3","wk_end_time3","offwk_joban_time","offwk_kaban_time",
            "offwk_count","outsider","wk_staff_id1","wk_staff1_kbn","wk_staff_id2","wk_staff2_kbn","wk_staff_id3","wk_staff3_kbn","wk_staff_id4","wk_staff4_kbn","wk_staff_id5","wk_staff_id6","wk_staff_id7","wk_staff_id8","wk_staff_id9","comment",
        );


        public static $report7 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id",
        );

        public static $report8 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","wk_start_time","wk_end_time","result1","wk_staff_id1","wk_staff_id2","wk_staff_id3","wk_staff_id4","wk_staff_id5","wk_staff_id6","wk_staff_id7","wk_staff_id8","comment",
        );

        public static $report9 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","wk_start_time1","wk_end_time1","wk_start_time2","wk_end_time2","result1","wk_staff_id1","wk_staff_id2","wk_staff_id3","wk_staff_id4","wk_staff_id5","wk_staff_id6","wk_staff_id7","wk_staff_id8","wk_staff_id9","wk_staff_id10","wk_staff_id11","wk_staff_id12","wk_staff_id13","wk_staff_id14","wk_staff_id15","wk_staff_id16","comment",
        );

        public static $report10 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","marsk_number1","marsk_number2","marsk_number3","marsk_number4","wait_anumber1","wait_anumber2","wait_anumber3","wait_anumber4","wait_bnumber1","wait_bnumber2","wait_bnumber3","wait_bnumber4",
            "wait_outside1","wait_outside2","wait_outside3","wait_outside4","in_port1","in_port2","facter","comment",
        );



        // 日本郵船神戸コンテナターミナル
        public static $report11 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","patrol_time1","bath1","sip1","in_port_time1","out_port_time1","patrol_time2",
            "bath2","sip2","in_port_time2","out_port_time2","patrol_time3","bath3","sip3","in_port_time3","out_port_time3","patrol_time4","bath4","sip4","in_port_time4","out_port_time4",
            "patrol_time5","bath5","sip5","in_port_time5","out_port_time5","patrol_time6","bath6","sip6","in_port_time6","out_port_time6","front_gate_start_time","front_gate_end_time",
            "east_gate_start_time","east_gate_end_time","west_gate_start_time","west_gate_end_time","over_time_num","over_time_name","over_start_time","over_end_time",
            "yard","yard1_start_time","yard1_end_time","yard2_start_time","yard2_end_time","cam_time","cam_text","fence_time","fence_text","etc_comment1","etc_comment2",
            "wk_staff_id1","wk_staff_id2","wk_staff_id3","wk_staff_id4","wk_staff_id5","wk_staff_id6","wk_staff_id7","wk_staff_id8","wk_staff_id9","wk_staff_id10",
            "wk_staff_id11","wk_staff_id12","wk_staff_id13","wk_staff_id14","wk_staff_id15","wk_staff_id16","wk_staff_id17","wk_staff_id18"
        );

        public static $report12 = array(
            "no","table","start_date","end_date","joban_time","kaban_time","weather1","weather2","staff_id","gate1","gate2","comment"
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

        public static $reportname = array("no","table","place","contract","genba_id","plan_kbn","plan_hosoku","disp");

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
