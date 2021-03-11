<?php
set_time_limit(300);
    // 作業実施テーブルクラス
    class Wkdetail
    {
        // 変数の宣言
        public $inp_t_wk_no;
        public $inp_t_wk_office_id;
        public $inp_t_wk_genba_id;
        public $inp_t_wk_taiin_id;
        public $inp_t_wk_plan_date;
        public $inp_t_wk_plan_start_date;
        public $inp_t_wk_plan_end_date;
        public $inp_t_wk_plan_kbn;
        public $inp_t_wk_plan_hosoku;
        public $inp_t_wk_plan_joban_time;
        public $inp_t_wk_plan_kaban_time;
        public $inp_t_wk_plan_kensyu;
        public $inp_t_wk_hokoku_id;
        public $inp_t_wk_joban_kbn = null;
        public $inp_t_wk_joban_dakoku_time = null;
        public $inp_t_wk_joban_time = null;
        public $inp_t_wk_kaban_kbn = null;
        public $inp_t_wk_kaban_dakoku_time = null;
        public $inp_t_wk_kaban_time = null;
        public $inp_t_wk_kyukei_start1 = null;
        public $inp_t_wk_kyukei_end1 = null;
        public $inp_t_wk_kyukei_start2 = null;
        public $inp_t_wk_kyukei_end2 = null;
        public $inp_t_wk_kyukei_start3 = null;
        public $inp_t_wk_kyukei_end3 = null;
        public $inp_t_wk_kyukei_start4 = null;
        public $inp_t_wk_kyukei_end4 = null;
        public $inp_t_wk_kyukei_start5 = null;
        public $inp_t_wk_kyukei_end5 = null;
        public $inp_t_wk_kyukei_start6 = null;
        public $inp_t_wk_kyukei_end6 = null;
        public $inp_t_wk_kotuhi;
        public $inp_t_wk_post_teate = null; // ポスト手当て
        public $inp_t_wk_kiken_teate; // 危険手当て
        public $inp_t_wk_kuruma_teate; // 車手当て
        public $inp_t_wk_shogatu_teate; // 正月手当て
        public $inp_t_wk_kaki_teate; // 夏季手当て
        public $inp_t_wk_daytime_over_time; // 昼残時間
        public $inp_t_wk_rest_over_time;     // 休憩残業時間
        public $inp_t_wk_midnight_over_time; // 深夜残業時間
        public $inp_t_wk_rest_reason;
        public $inp_t_wk_kintime;
        public $inp_t_wk_zan;
        public $inp_t_wk_sin;
        public $inp_t_wk_renzan = null;
        public $inp_t_wk_stminus;
        public $inp_t_wk_del_flg;
        public $inp_t_wk_created;
        public $inp_t_wk_created_id;
        public $inp_t_wk_modified;
        public $inp_t_wk_modified_id;

        public $inp_t_wk_plan_month;
        public $inp_t_wk_detail_conf;

        public $oup_t_wk_no;
        public $oup_t_wk_office_id;
        public $oup_t_wk_genba_id;
        public $oup_t_wk_taiin_id;
        public $oup_t_wk_plan_date;
        public $oup_t_wk_plan_kbn;
        public $oup_t_wk_plan_hosoku;
        public $oup_t_wk_plan_joban_time;
        public $oup_t_wk_plan_kaban_time;
        public $oup_t_wk_hokoku_id;
        public $oup_t_wk_joban_kbn;
        public $oup_t_wk_joban_dakoku_time;
        public $oup_t_wk_joban_time;
        public $oup_t_wk_kaban_kbn;
        public $oup_t_wk_kaban_dakoku_time;
        public $oup_t_wk_kaban_time;
        public $oup_t_wk_kyukei_start1;
        public $oup_t_wk_kyukei_end1;
        public $oup_t_wk_kyukei_start2;
        public $oup_t_wk_kyukei_end2;
        public $oup_t_wk_kyukei_start3;
        public $oup_t_wk_kyukei_end3;
        public $oup_t_wk_kyukei_start4;
        public $oup_t_wk_kyukei_end4;
        public $oup_t_wk_kyukei_start5;
        public $oup_t_wk_kyukei_end5;
        public $oup_t_wk_kyukei_start6;
        public $oup_t_wk_kyukei_end6;
        public $oup_t_wk_kotuhi;
        public $oup_t_wk_post_teate; // ポスト手当て
        public $oup_t_wk_kiken_teate;
        public $oup_t_wk_kuruma_teate; // 車手当て
        public $oup_t_wk_shogatu_teate; // 正月手当て
        public $oup_t_wk_kaki_teate; // 夏季手当て
        public $oup_t_wk_daytime_over_time; // 昼残時間
        public $oup_t_wk_rest_over_time;     // 休憩残業時間
        public $oup_t_wk_midnight_over_time; // 深夜残業時間
        public $oup_t_wk_rest_reason;
        public $oup_t_wk_kintime;
        public $oup_t_wk_zan;
        public $oup_t_wk_sin;
        public $oup_t_wk_renzan;
        public $oup_t_wk_stminus;
        public $oup_t_wk_del_flg;
        public $oup_t_wk_created;
        public $oup_t_wk_created_id;
        public $oup_t_wk_modified;
        public $oup_t_wk_modified_id;

        public $oup_t_wk_plan_month;
        public $oup_m_genba_name;
        
        public $inp_t_wk_gchk_kbn;
        public $oup_t_wk_gchk_kbn;
        public $inp_t_wk_gchk_created;
        public $oup_t_wk_gchk_created;
        public $inp_t_wk_schk_kbn;
        public $oup_t_wk_schk_kbn;
        public $inp_t_wk_schk_created;
        public $oup_t_wk_schk_created;
        
        public $inp_t_wk_shift_no;
        public $oup_t_wk_shift_no;
        
        public $inp_t_wk_syotei_zan;
        public $inp_t_wk_hayazan;
        public $inp_t_wk_tuzan;
        public $inp_t_wk_kinmu_time;
        public $oup_t_wk_syotei_zan;
        public $oup_t_wk_hayazan;
        public $oup_t_wk_tuzan;
        public $oup_t_wk_kinmu_time;
        
        public $inp_t_wk_inp_kbn = null;
        public $oup_t_wk_inp_kbn;
        
        public $inp_t_wk_renzan_kbn = null;
        public $oup_t_wk_renzan_kbn;
        
        public $inp_t_wk_comment;
        public $oup_t_wk_comment;

        // 入力チェック
        public function inputCheck()
        {
        }

        // 時間の整形
        public function formatTime($wk_time1, $wk_time2)
        {
            var_dump($wk_time1, $wk_time2);
            if ($wk_time1 == null || $wk_time2 == null) {
                return null;
            } else {
                return sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
            }
        }

        // セレクト
        public function getWkdetail()
        {
            $row = null;
            $whereflg = false;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_detail_no "
                 . ",   t_wk_office_id "
                 . ",   t_wk_genba_id "
                 . ",   t_wk_taiin_id "
                 . ",   t_wk_plan_date "
                 . ",   t_wk_plan_kbn "
                 . ",   t_wk_plan_hosoku "
                 . ",   HOUR(t_wk_plan_joban_time) "
                 . ",   MINUTE(t_wk_plan_joban_time) "
                 . ",   HOUR(t_wk_plan_kaban_time) "
                 . ",   MINUTE(t_wk_plan_kaban_time) "
                 . ",   t_wk_plan_kensyu "
                 . ",   t_wk_hokoku_id "
                 . ",   t_wk_joban_kbn "
                 . ",   HOUR(t_wk_joban_dakoku_time) "
                 . ",   MINUTE(t_wk_joban_dakoku_time) "
                 . ",   HOUR(t_wk_joban_time) "
                 . ",   MINUTE(t_wk_joban_time) "
                 . ",   t_wk_kaban_kbn "
                 . ",   HOUR(t_wk_kaban_dakoku_time) "
                 . ",   MINUTE(t_wk_kaban_dakoku_time) "
                 . ",   HOUR(t_wk_kaban_time) "
                 . ",   MINUTE(t_wk_kaban_time) "
                 . ",   t_wk_kyukei_start1 "
                 . ",   t_wk_kyukei_end1 "
                 . ",   t_wk_kyukei_start2 "
                 . ",   t_wk_kyukei_end2 "
                 . ",   t_wk_kyukei_start3 "
                 . ",   t_wk_kyukei_end3 "
                 . ",   t_wk_kyukei_start4 "
                 . ",   t_wk_kyukei_end4 "
                 . ",   t_wk_kyukei_start5 "
                 . ",   t_wk_kyukei_end5 "
                 . ",   t_wk_kyukei_start6 "
                 . ",   t_wk_kyukei_end6 "
                 . ",   t_wk_kotuhi "
                 . ",   t_wk_post_teate "
                 . ",   t_wk_kiken_teate "
                 . ",   t_wk_kuruma_teate "
                 . ",   t_wk_shogatu_teate "
                 . ",   t_wk_kaki_teate "
                 . ",   t_wk_etc_teate1 "
                 . ",   t_wk_etc_teate2 "
                 . ",   t_wk_etc_teate3 "
                 . ",   HOUR(t_wk_daytime_over_time) " // 昼残時間
                 . ",   MINUTE(t_wk_daytime_over_time) "
                 . ",   HOUR(t_wk_rest_over_time) " // 休憩残業時間
                 . ",   MINUTE(t_wk_rest_over_time) "
                 . ",   HOUR(t_wk_midnight_over_time) " // 深夜残業時間
                 . ",   MINUTE(t_wk_midnight_over_time) "
                 . ",   t_wk_rest_reason "
                 . ",   t_wk_kintime "
                 . ",   t_wk_zan "
                 . ",   t_wk_sin "
                 . ",   t_wk_renzan "
                 . ",   t_wk_stminus "
                 . ",   t_wk_del_flg "
                 . ",   t_wk_gchk_kbn "
                 . ",   t_wk_schk_kbn "
                 . ",   t_wk_shift_no "
                 . ",   t_wk_syotei_zan "
                 . ",   t_wk_hayazan "
                 . ",   t_wk_tuzan "
                 . ",   t_wk_kinmu_time "
                 . ",   t_wk_inp_kbn "
                 . ",   t_wk_renzan_kbn "
                 . ",   t_wk_comment ";
                 //if ($this->inp_left_join_m_kotuhi != "") {
                 //   $sql .= ",   m_kotuhi_cost ";
                 //}
                 $sql .= "FROM ";

            if ($this->inp_t_wk_detail_conf == "") {
                $sql .= "t_wk_detail ";
            } else {
                $sql .= "t_wk_detail_conf ";
            }
            if ($this->inp_left_join_m_genba != "") {
                $sql .= "left join m_genba on t_wk_detail.t_wk_genba_id = m_genba.m_genba_id ";
            }
            //if ($this->inp_left_join_m_kotuhi != "") {
            //    $sql .= "left join m_kotuhi on t_wk_detail.t_wk_taiin_id = m_kotuhi.m_kotuhi_staff_id and t_wk_detail.t_wk_genba_id = m_kotuhi.m_kotuhi_place_id and t_wk_detail.t_wk_plan_hosoku = m_kotuhi.m_kotuhi_hosoku ";
            //}
            if ($this->inp_join_m_staff != "") {
                $sql .= "join m_staff on t_wk_detail.t_wk_taiin_id = m_staff.m_staff_id ";
            }

            $sql .= "WHERE ";

            if ($this->inp_t_wk_detail_no != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_detail_no = " . $db->escape_string($this->inp_t_wk_detail_no) . " ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_office_id != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_office_id = " . $db->escape_string($this->inp_t_wk_office_id) . " ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_genba_id != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_genba_id = '" . $db->escape_string($this->inp_t_wk_genba_id) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_genba_id2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_genba_id in (" . $this->inp_t_wk_genba_id2 . ") ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_taiin_id != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_taiin_id = '" . $db->escape_string($this->inp_t_wk_taiin_id) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_month != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "DATE_FORMAT(t_wk_plan_date,'%Y%m') = '" . $db->escape_string($this->inp_t_wk_plan_month) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_date != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_plan_date = '" . substr($db->escape_string($this->inp_t_wk_plan_date), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date), 4, 2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date), 6, 2) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_date2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $targetTime = strtotime(substr($db->escape_string($this->inp_t_wk_plan_date2), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date2), 4, 2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date2), 6, 2) . ' 00:00:00');
                $targetTime = date('Y-m-d', strtotime('-1 day', $targetTime));
                if (date(Hi)<"0800") {
                    $sql .= "t_wk_plan_date = '" . $targetTime . "' ";
                } else {
                    $sql .= "t_wk_plan_date = '" . substr($db->escape_string($this->inp_t_wk_plan_date2), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date2), 4, 2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date2), 6, 2) . "' ";
                }
                $whereflg = true;
            }
            if (($this->inp_t_wk_plan_start_date != "") && ($this->inp_t_wk_plan_end_date != "")) {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_plan_date between '" . substr($db->escape_string($this->inp_t_wk_plan_start_date), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_start_date), 4, 2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_start_date), 6, 2) . " 00:00:00' and '" . substr($db->escape_string($this->inp_t_wk_plan_end_date), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_end_date), 4, 2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_end_date), 6, 2) . " 23:59:59' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_shift_no != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_shift_no = '" . $db->escape_string($this->inp_t_wk_shift_no) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_shift_no2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_shift_no in (" . $this->inp_t_wk_shift_no2 . ") ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_kbn != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_plan_kbn = '" . $db->escape_string($this->inp_t_wk_plan_kbn) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_kbn2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_plan_kbn != '" . $db->escape_string($this->inp_t_wk_plan_kbn2) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_hosoku != "") {
            if ($this->inp_t_wk_plan_hosoku == 1) {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_plan_hosoku = '' ";
                $whereflg = true;
            } else {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_plan_hosoku = '" . $db->escape_string($this->inp_t_wk_plan_hosoku) . "' ";
                $whereflg = true;
            }
            }
            if ($this->inp_t_wk_plan_joban_time != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_plan_joban_time = '" . $db->escape_string($this->inp_t_wk_plan_joban_time) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_kaban_time != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_plan_kaban_time = '" . $db->escape_string($this->inp_t_wk_plan_kaban_time) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_jk_time != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "(t_wk_joban_kbn != '' or t_wk_kaban_kbn != '' or t_wk_joban_dakoku_time != '' or t_wk_kaban_dakoku_time != '' or t_wk_joban_time != '' or t_wk_kaban_time != '') ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_jk_kbn != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "(t_wk_joban_kbn = '' or t_wk_joban_kbn is null) AND (t_wk_kaban_kbn = '' or t_wk_kaban_kbn is null) ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_hokoku_id != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_hokoku_id = '" . $db->escape_string($this->inp_t_wk_hokoku_id) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_joban_kbn != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_joban_kbn = '" . $db->escape_string($this->inp_t_wk_joban_kbn) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_joban_kbn2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_joban_kbn != '" . $db->escape_string($this->inp_t_wk_joban_kbn2) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_joban_kbn3 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_joban_kbn != '" . $db->escape_string($this->inp_t_wk_joban_kbn3) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_joban_kbn4 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "(t_wk_joban_kbn = '' or t_wk_joban_kbn is null) ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_joban_kbns != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "(t_wk_joban_kbn not in (" .$this->inp_t_wk_joban_kbns. ") or t_wk_joban_kbn is null) ";
                $whereflg = true;
            }
            //if ($this->inp_t_wk_joban_kbns != "") {
            //    if ($whereflg == true) { $sql .= "AND "; }
            //    $sql .= "(t_wk_joban_kbn != 4 && t_wk_joban_kbn != 5) ";
            //    $whereflg = true;
            //}
            if ($this->inp_t_wk_jokaban_kbn2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "(t_wk_joban_kbn != '' or t_wk_kaban_kbn != '') ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_joban_dakoku_time != "") {
                if ($this->inp_t_wk_joban_dakoku_time == "null") {
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_joban_dakoku_time is null ";
                    $whereflg = true;
                } else {
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_joban_dakoku_time = '" . $db->escape_string($this->inp_t_wk_joban_dakoku_time) . "' ";
                    $whereflg = true;
                }
            }
            if ($this->inp_t_wk_joban_time != "") {
                if($this->inp_t_wk_joban_time == "null"){
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_joban_time IS NULL ";
                    $whereflg = true;
                }elseif ($this->inp_t_wk_joban_time == "is not null"){
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_joban_time is not null ";
                    $whereflg = true;
                }else{
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_joban_time = '" . $db->escape_string($this->inp_t_wk_joban_time) . "' ";
                    $whereflg = true;
                }
            }
            if ($this->inp_t_wk_kaban_kbn != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kaban_kbn = '" . $db->escape_string($this->inp_t_wk_kaban_kbn) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kaban_kbn2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "(t_wk_kaban_kbn = '' or t_wk_kaban_kbn is null) ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kaban_dakoku_time != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kaban_dakoku_time = '" . $db->escape_string($this->inp_t_wk_kaban_dakoku_time) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kaban_time != "") {
                if($this->inp_t_wk_kaban_time == "null"){
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_kaban_time IS NULL ";
                    $whereflg = true;
                }else{
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_kaban_time = '" . $db->escape_string($this->inp_t_wk_kaban_time) . "' ";
                    $whereflg = true;
                }
            }
            if ($this->inp_t_wk_kyukei_start1 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_start1 = '" . $db->escape_string($this->inp_t_wk_kyukei_start1) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end1 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_end1 = '" . $db->escape_string($this->inp_t_wk_kyukei_end1) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_start2 = '" . $db->escape_string($this->inp_t_wk_kyukei_start2) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_end2 = '" . $db->escape_string($this->inp_t_wk_kyukei_end2) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start3 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_start3 = '" . $db->escape_string($this->inp_t_wk_kyukei_start3) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end3 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_end3 = '" . $db->escape_string($this->inp_t_wk_kyukei_end3) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start4 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_start4 = '" . $db->escape_string($this->inp_t_wk_kyukei_start4) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end4 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_end4 = '" . $db->escape_string($this->inp_t_wk_kyukei_end4) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_start5 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_start5 = '" . $db->escape_string($this->inp_t_wk_kyukei_start5) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kyukei_end5 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kyukei_end5 = '" . $db->escape_string($this->inp_t_wk_kyukei_end5) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kotuhi != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kotuhi = '" . $db->escape_string($this->inp_t_wk_kotuhi) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_post_teate != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_post_teate = '" . $db->escape_string($this->inp_t_wk_post_teate) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kiken_teate != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kiken_teate = '" . $db->escape_string($this->inp_t_wk_kiken_teate) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_shogatu_teate != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_shogatu_teate = '" . $db->escape_string($this->t_wk_shogatu_teate) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kaki_teate != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_kaki_teate = '" . $db->escape_string($this->inp_t_wk_kaki_teate) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_daytime_over_time != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_daytime_over_time = '" . $db->escape_string($this->inp_t_wk_daytime_over_time) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_rest_over_time != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_rest_over_time = '" . $db->escape_string($this->inp_t_wk_rest_over_time) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_midnight_over_time != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_midnight_over_time = '" . $db->escape_string($this->inp_t_wk_midnight_over_time) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_rest_reason != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_rest_reason = '" . $db->escape_string($this->inp_t_wk_rest_reason) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_del_flg != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_del_flg = '" . $db->escape_string($this->inp_t_wk_del_flg) . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_gchk_kbn != "") {
                if ($this->inp_t_wk_gchk_kbn == "0") {
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_gchk_kbn is null ";
                    $whereflg = true;
                } else {
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_gchk_kbn = '" . $db->escape_string($this->inp_t_wk_gchk_kbn) . "' ";
                    $whereflg = true;
                }
            }
            if ($this->inp_t_wk_schk_kbn != "") {
                if ($this->inp_t_wk_schk_kbn == "0") {
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_schk_kbn is null ";
                    $whereflg = true;
                } else {
                    if ($whereflg == true) { $sql .= "AND "; }
                    $sql .= "t_wk_schk_kbn = '" . $db->escape_string($this->inp_t_wk_schk_kbn) . "' ";
                    $whereflg = true;
                }
            }
            if ($this->inp_t_wk_inp_kbn != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "t_wk_inp_kbn = '" . $db->escape_string($this->inp_t_wk_inp_kbn) . "' ";
                $whereflg = true;
            }
            if ($this->inp_m_company_id != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "m_staff.m_staff_company = '" . $db->escape_string($this->inp_m_company_id) . "' ";
                $whereflg = true;
            }
            if ($this->inp_m_company_id2 != "") {
                if ($whereflg == true) { $sql .= "AND "; }
                $sql .= "m_staff.m_staff_company in (" . $this->inp_m_company_id2 . ") ";
                $whereflg = true;
            }
            //if ($this->inp_t_wk_joban_time_flg == "1") {
            //    $sql .= "AND t_wk_joban_time != 'null' ";
            //}

            // 条件がなかったらSQLを実効しない
            if (substr($sql, -12, 12) == "WHERE 0 = 0 ") {
                return;
            }

            if ($this->inp_order == "") {
                $sql .= "ORDER BY t_wk_plan_date, t_wk_plan_joban_time, t_wk_taiin_id  ";
            } else {
                $sql .= $db->escape_string($this->inp_order);
            }
 //var_dump($sql);
            // SQL実行

            // 文字化け防止
            $db->set_charset();

            // var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;
                    
                    if ($this->inp_flg == "1") {
                        //if ($i==0) {
                            if ($row[21] == null) {$row21 = "";} else {$row21 = $row[21];}
                            if ($row[22] == null) {$row22 = "";} else {$row22 = $row[22];}
                            if ($row21 == "" && $row22 == "") {$row_kt = "";} else {$row_kt = sprintf("%02d",$row21).":".sprintf("%02d",$row22);}
                            
                            $this->all       = [$row[0],$row_kt,sprintf("%02d",$row[44]).":".sprintf("%02d",$row[45]),sprintf("%02d",$row[46]).":".sprintf("%02d",$row[47]),sprintf("%02d",$row[48]).":".sprintf("%02d",$row[49]),intval($row[36]),intval($row[35])];
                        //}
                    } elseif ($this->inp_flg == "2") {
                        //if ($i==0) {
                            if ($row[16] == null) {$row16 = "";} else {$row16 = $row[16];}
                            if ($row[17] == null) {$row17 = "";} else {$row17 = $row[17];}
                            if ($row[13] == null) {$row13 = "";} else {$row13 = $row[13];}
                            if ($row16 == "" && $row17 == "") {$row_jt = "";} else {$row_jt = sprintf("%02d",$row16).":".sprintf("%02d",$row17);}
                            
                            $this->all       = [$row[0],$row_jt,$row13];
                        //}
                    }
                    //var_dump($row[16],$row[17],$row[13]);
                    //var_dump($row[21],$row[22],$row[44],$row[45],$row[46],$row[47],$row[48],$row[49],$row[36],$row[35]);
                

                    $this->oup_t_wk_detail_no[]       = $row[$i++];
                    $this->oup_t_wk_office_id[]       = $row[$i++];
                    $this->oup_t_wk_genba_id[]        = $row[$i++];
                    $this->oup_t_wk_taiin_id[]        = $row[$i++];
                    $this->oup_t_wk_plan_date[]       = $row[$i++];
                    $this->oup_t_wk_plan_kbn[]        = $row[$i++];
                    $this->oup_t_wk_plan_hosoku[]     = $row[$i++];
                    $wk_time1 = $row[$i++];     // HH(t_wk_plan_joban_time)
                    $wk_time2 = $row[$i++];     // MI(t_wk_plan_joban_time)
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_plan_joban_time[] = null;
                    } else {
                        $this->oup_t_wk_plan_joban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_plan_joban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    $wk_time1 = $row[$i++];     // HH(t_wk_plan_kaban_time)
                    $wk_time2 = $row[$i++];     // MI(t_wk_plan_kaban_time)
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_plan_kaban_time[] = null;
                    } else {
                        $this->oup_t_wk_plan_kaban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_plan_kaban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    $this->oup_t_wk_plan_kensyu[]     = $row[$i++];
                    $this->oup_t_wk_hokoku_id[]       = $row[$i++];
                    $this->oup_t_wk_joban_kbn[]       = $row[$i++];
                    $wk_time1 = $row[$i++];     // HH(t_wk_joban_dakoku_time)
                    $wk_time2 = $row[$i++];     // MI(t_wk_joban_dakoku_time)
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_joban_dakoku_time[] = null;
                    } else {
                        $this->oup_t_wk_joban_dakoku_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_joban_dakoku_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    $wk_time1 = $row[$i++];     // HH(t_wk_joban_time)
                    $wk_time2 = $row[$i++];     // MI(t_wk_joban_time)
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_joban_time[] = null;
                    } else {
                        $this->oup_t_wk_joban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_joban_time[]      = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    $this->oup_t_wk_kaban_kbn[]       = $row[$i++];
                    $wk_time1 = $row[$i++];     // HH(t_wk_kaban_dakoku_time)
                    $wk_time2 = $row[$i++];     // MI(t_wk_kaban_dakoku_time)
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_kaban_dakoku_time[] = null;
                    } else {
                        $this->oup_t_wk_kaban_dakoku_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_kaban_dakoku_time[]      = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    $wk_time1 = $row[$i++];     // HH(t_wk_kaban_time)
                    $wk_time2 = $row[$i++];     // MI(t_wk_kaban_time)
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_kaban_time[] = null;
                    } else {
                        $this->oup_t_wk_kaban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_kaban_time[]      = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    $this->oup_t_wk_kyukei_start1[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end1[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start2[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end2[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start3[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end3[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start4[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end4[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start5[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end5[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start6[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end6[]     = $row[$i++];
                    $this->oup_t_wk_kotuhi[]          = $row[$i++];
                    $this->oup_t_wk_post_teate[]      = $row[$i++];
                    $this->oup_t_wk_kiken_teate[]     = $row[$i++];
                    $this->oup_t_wk_kuruma_teate[]    = $row[$i++];
                    $this->oup_t_wk_shogatu_teate[]   = $row[$i++];
                    $this->oup_t_wk_kaki_teate[]      = $row[$i++];
                    $this->oup_t_wk_etc_teate1[]      = $row[$i++];
                    $this->oup_t_wk_etc_teate2[]      = $row[$i++];
                    $this->oup_t_wk_etc_teate3[]      = $row[$i++];
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_daytime_over_time[] = null;
                    } else {
                        $this->oup_t_wk_daytime_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_daytime_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ; // 昼残時間
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_rest_over_time[] = null;
                    } else {
                        $this->oup_t_wk_rest_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_rest_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;// 休憩残業時間
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_midnight_over_time[] = null;
                    } else {
                        $this->oup_t_wk_midnight_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_midnight_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;// 深夜残業時間
                    $this->oup_t_wk_rest_reason[]   = $row[$i++];
                    $this->oup_t_wk_kintime[]       = $row[$i++];
                    $this->oup_t_wk_zan[]           = $row[$i++];
                    $this->oup_t_wk_sin[]           = $row[$i++];
                    $this->oup_t_wk_renzan[]        = $row[$i++];
                    $this->oup_t_wk_stminus[]       = $row[$i++];
                    $this->oup_t_wk_del_flg[]       = $row[$i++];
                    $this->oup_t_wk_gchk_kbn[]       = $row[$i++];
                    $this->oup_t_wk_schk_kbn[]       = $row[$i++];
                    $this->oup_t_wk_shift_no[]       = $row[$i++];
                    $this->oup_t_wk_syotei_zan[]       = $row[$i++];
                    $this->oup_t_wk_hayazan[]       = $row[$i++];
                    $this->oup_t_wk_tuzan[]       = $row[$i++];
                    $this->oup_t_wk_kinmu_time[]       = $row[$i++];
                    $this->oup_t_wk_inp_kbn[]       = $row[$i++];
                    $this->oup_t_wk_renzan_kbn[]       = $row[$i++];
                    $this->oup_t_wk_comment[]       = $row[$i++];
                    //if ($this->inp_left_join_m_kotuhi != "") {
                    //    $this->oup_m_kotuhi_cost[]       = $row[$i++];
                    //}

                    //var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            // var_dump($result);

            return $this->result;

            // MySQLへの接続を閉じる
            $db->close();
        }
        
        //勤務時間の計算
        public function getcalckintime()
        {
        $kinmu_flg = "";
        $kinmu_time = 0;
        $kinmu_otime = 0;
        $hayade = 0;
        $tikoku = 0;
        $soutai = 0;
        $zan = 0;
        $hayazan = 0;
        $tuzan = 0;
        $kinmu_syotei = 0;
        $kinmu_kyukei = 0;
        $syotei = 480;
        
        if ($this->inp_shift_ktime != "") {
            $wk00_k = $this->inp_shift_ktime*60;
        }
        if ($this->inp_shift_otime != "") {
            $wk00_o = $this->inp_shift_otime*60;
        }
        if ($this->inp_shift_rtime != "") {
            $wk00_r = $this->inp_shift_rtime*60;
        }

        //勤務区分
        if ($this->inp_plan_kbn != "") {
            $calc_plan_kbn = $this->inp_plan_kbn;
        }
        //上番区分
        if ($this->inp_joban_kbn != "") {
            $calc_joban_kbn = $this->inp_joban_kbn;
        }
        //所定上番時刻
        if ($this->inp_plan_joban_time != "") {
            $calc_plan_joban_time = sprintf("%02d",$this->inp_plan_joban_time)*60+substr($this->inp_plan_joban_time,3,2)+1440;
        }
        //所定下番時刻
        if ($this->inp_plan_kaban_time != "") {
            $calc_plan_kaban_time = sprintf("%02d",$this->inp_plan_kaban_time)*60+substr($this->inp_plan_kaban_time,3,2)+1440;
        }
        //実績上番時刻
        if ($this->inp_joban_time != "") {
            $calc_joban_time = sprintf("%02d",$this->inp_joban_time)*60+substr($this->inp_joban_time,3,2)+1440;
        }
        //実績下番時刻
        if ($this->inp_kaban_time != "") {
            $calc_kaban_time = sprintf("%02d",$this->inp_kaban_time)*60+substr($this->inp_kaban_time,3,2)+1440;
        }
        //var_dump($calc_plan_kbn,$calc_joban_kbn,$calc_plan_joban_time,$calc_plan_kaban_time,$calc_joban_time,$calc_kaban_time);
        //exit;

            //上番区分が年休、欠勤、勤務区分が年休以外
            if ($calc_joban_kbn != "4" && $calc_joban_kbn != "5" && $calc_plan_kbn != "4") {
            
                //上番区分が年休、欠勤、勤務区分が年休、時給以外
                //シフトの所定開始、終了から勤務予定合計時間を取得
                if ($calc_plan_kbn != "6") {
                    //通常勤務
                    if ($calc_plan_joban_time < $calc_plan_kaban_time) {
                        $wk00_t = $calc_plan_kaban_time - $calc_plan_joban_time;
                    //泊まり
                    } elseif ($calc_plan_joban_time == $calc_plan_kaban_time) {
                        $wk00_t = 1440;
                    //日をまたぐ勤務
                    } elseif ($calc_plan_joban_time > $calc_plan_kaban_time) {
                        $wk00_t = 1440 - ($calc_plan_joban_time - $calc_plan_kaban_time);
                    }
                }
                
                //実績上番か下番が空なら計算しない
                if ($calc_joban_time != "" && $calc_kaban_time != "") {
                    
                    //実績労働時間を取得
                    //24時間
                    if ($calc_joban_time == $calc_kaban_time) {
                        $kinmu_time = 1440;
                    //通常
                    } elseif ($calc_joban_time < $calc_kaban_time) {
                        $kinmu_time = $calc_kaban_time - $calc_joban_time;
                    //日をまたぐ　elseif ($calc_joban_time > $calc_kaban_time)
                    } else {
                        $kinmu_time = 1440 - ($calc_joban_time - $calc_kaban_time);
                    }
                    $kinmu_time_total = $kinmu_time;
                    //var_dump($calc_plan_kbn,$wk00_t,$kinmu_time,$calc_joban_time,$calc_kaban_time);
                    //exit;
                    
                    //勤務区分が泊、日勤、夜勤
                    if ($calc_plan_kbn == 1 || $calc_plan_kbn == 2 || $calc_plan_kbn == 3) {
                    
                        ////シフトの労働時間がゼロ以外
                        //if ($wk00_r != 0) {
                        
                        //勤務予定時間と実績時間が全く同じ場合
                        if ($calc_plan_joban_time == $calc_joban_time && $calc_plan_kaban_time == $calc_kaban_time) {
                            $kinmu_time = $wk00_r;
                            if ($wk00_o == 0) {
                                $kinmu_otime = 0;
                            } else {
                                $kinmu_otime = $wk00_o;
                            }
                            $hayazan = 0;
                            $tuzan = 0;
                        } else {
                        
                            //勤務区分が泊
                            if ($calc_plan_kbn == 1) {
                                
                                //日をまたぐ勤務or合計時間が同じで開始、終了が違う勤務
                                if ($calc_joban_time > $calc_kaban_time || $calc_joban_time == $calc_kaban_time) {
                                    //早出、遅刻
                                    if ($calc_plan_joban_time > $calc_joban_time) {
                                        $hayade = $calc_plan_joban_time - $calc_joban_time;
                                    } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                        $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                    }
                                    //残業、早退
                                    if ($calc_plan_kaban_time > $calc_kaban_time) {
                                        $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                    } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                        $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                    }
                                //日をまたがない勤務
                                } elseif ($calc_joban_time < $calc_kaban_time) {
                                    //早出、遅刻
                                    if ($calc_plan_joban_time > $calc_joban_time) {
                                        $hayade = $calc_plan_joban_time - $calc_joban_time;
                                    } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                        $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                    }
                                    //残業、早退
                                    if ($calc_plan_kaban_time > $calc_kaban_time) {
                                        $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                    } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                        $soutai = 1440 - ($calc_kaban_time - $calc_plan_kaban_time);
                                    } else {
                                        $soutai = 1440;
                                    }
                                }
                                //var_dump($calc_plan_kbn,$wk00_t,$kinmu_time,$hayade,$tikoku,$soutai,$zan);
                                //exit;
                                
                                //実績の上番、下番時間別にフラグを立てる
                                //所定内の勤務時間
                                if ($tikoku != "" && $soutai == "") {
                                    $kinmu_flg = 1;
                                    $calc_kinmu_time = $kinmu_time - $zan;
                                } elseif ($tikoku == "" && $soutai != "") {
                                    $kinmu_flg = 2;
                                    $calc_kinmu_time = $kinmu_time - $hayade;
                                } else {
                                    $kinmu_flg = 3;
                                    $calc_kinmu_time = $kinmu_time;
                                }
                                
                                //シフトに所定残業がある場合
                                if ($wk00_o != 0) {
                                    
                                    //所定と実績合計時間が同じ場合
                                    if ($kinmu_time == $wk00_t) {
                                        //所定労働時間より所定内勤務時間の方が少ないor同じ場合
                                        if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        //所定労働時間より所定内勤務時間の方が多い場合
                                        } else {
                                            //所定残業
                                            $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                            //計算
                                            if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                                $kinmu_otime = $kinmu_syotei;
                                            } else {
                                                $kinmu_otime = $wk00_o;
                                            }
                                            
                                            if ($kinmu_flg == 1) {
                                                $hayazan = 0;
                                                $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                            } elseif ($kinmu_flg == 2) {
                                                $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                                $hayazan = $hayade;
                                            }
                                            $kinmu_time = $wk00_r;
                                        }
                                    } else {
                                        if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        } else {
                                            //所定残業
                                            $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                            //計算
                                            if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                                $kinmu_otime = $kinmu_syotei;
                                            } else {
                                                $kinmu_otime = $wk00_o;
                                            }
                                            
                                            if ($kinmu_flg == 1) {
                                                $hayazan = 0;
                                                $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                            } elseif ($kinmu_flg == 2) {
                                                $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                                $hayazan = $hayade;
                                            } else {
                                                $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                                $hayazan = $hayade;
                                            }
                                            $kinmu_time = $wk00_r;
                                        }
                                    }
                                //シフトに所定残業がない場合
                                } else {
                                    //所定と実績合計時間が同じ場合
                                    if ($kinmu_time == $wk00_t) {
                                        //所定労働時間より所定内勤務時間の方が少ないor同じ場合
                                        if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        //所定労働時間より所定内勤務時間の方が多い場合
                                        } else {
                                            if ($kinmu_flg == 1) {
                                                $hayazan = 0;
                                                $tuzan = $zan + ($kinmu_time - $wk00_r - $zan);
                                            } elseif ($kinmu_flg == 2) {
                                                $tuzan = $kinmu_time - $wk00_r - $hayade;
                                                $hayazan = $kinmu_time - $wk00_r - $tuzan;
                                            }
                                            $kinmu_time = $wk00_r;
                                            $kinmu_otime = 0;
                                        }
                                    } else {
                                        if ($calc_kinmu_time < $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        } elseif ($calc_kinmu_time == $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        } else {
                                            if ($kinmu_flg == 1) {
                                                $hayazan = 0;
                                                $tuzan = $zan + ($kinmu_time - $wk00_r - $zan);
                                            } elseif ($kinmu_flg == 2) {
                                                $tuzan = $kinmu_time - $wk00_r - $hayade;
                                                $hayazan = $kinmu_time - $wk00_r - $tuzan;
                                            } else {
                                                $hayazan = 0;
                                                $tuzan = $kinmu_time - $wk00_r;
                                            }
                                            $kinmu_time = $wk00_r;
                                            $kinmu_otime = 0;
                                        }
                                    }
                                }
                                //var_dump($calc_plan_kbn,"所".$wk00_t,"実".$kinmu_time,"早".$hayazan,"残".$tuzan,"所残".$kinmu_otime,"シ勤".$calc_kinmu_time);
                                //exit;
                            //勤務区分が日勤
                            } elseif ($calc_plan_kbn == 2) {
                                
                                if ($calc_joban_time > $calc_kaban_time || $calc_joban_time == $calc_kaban_time) {
                                    
                                    if ($calc_plan_joban_time > $calc_joban_time) {
                                        $hayade = $calc_plan_joban_time - $calc_joban_time;
                                    } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                        $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                    }
                                    
                                    if ($calc_plan_kaban_time > $calc_kaban_time) {
                                        $zan = 1440 - ($calc_plan_kaban_time - $calc_kaban_time);
                                    } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                        $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                    }
                                    
                                } elseif ($calc_joban_time < $calc_kaban_time) {
                                    
                                    if ($calc_plan_joban_time > $calc_joban_time) {
                                        $hayade = $calc_plan_joban_time - $calc_joban_time;
                                    } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                        $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                    }
                                    
                                    if ($calc_plan_kaban_time > $calc_kaban_time) {
                                        $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                    } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                        $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                    }
                                    
                                }
                                //var_dump($calc_plan_kbn,"所".$wk00_t,"実".$kinmu_time,"早出".$hayade,"遅刻".$tikoku,"早退".$soutai,"残業".$zan);
                                //exit;
                                if ($tikoku == "" && $soutai == "") {
                                    $kinmu_flg = 4;
                                    $calc_kinmu_time = $kinmu_time - $hayade - $zan;
                                } elseif ($tikoku != "" && $soutai == "") {
                                    $kinmu_flg = 1;
                                    $calc_kinmu_time = $kinmu_time - $zan;
                                } elseif ($tikoku == "" && $soutai != "") {
                                    $kinmu_flg = 2;
                                    $calc_kinmu_time = $kinmu_time - $hayade;
                                } else {
                                    $kinmu_flg = 3;
                                    $calc_kinmu_time = $kinmu_time;
                                }
                                
                                if ($wk00_o != 0) {
                                    
                                    if ($kinmu_time == $wk00_t) {
                                        if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        } else {
                                            $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                            if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                                $kinmu_otime = $kinmu_syotei;
                                            } else {
                                                $kinmu_otime = $wk00_o;
                                            }
                                            
                                            if ($kinmu_flg == 1) {
                                                $hayazan = 0;
                                                $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                            } elseif ($kinmu_flg == 2) {
                                                $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                                $hayazan = $hayade;
                                            }
                                            $kinmu_time = $wk00_r;
                                        }
                                    } else {
                                    
                                        if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        } else {
                                            $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                            //$kinmu_kyukei = $calc_kinmu_time - $wk00_r - $wk00_o;
                                            if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                                $kinmu_otime = $kinmu_syotei;
                                            } else {
                                                $kinmu_otime = $wk00_o;
                                            }
                                            
                                            if ($kinmu_flg == 1) {
                                                $hayazan = 0;
                                                $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                            } elseif ($kinmu_flg == 2) {
                                                $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                                $hayazan = $hayade;
                                            } elseif ($kinmu_flg == 3) {
                                                $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                                $hayazan = $hayade;
                                            } else {
                                                $tuzan = $zan;
                                                $hayazan = $hayade;
                                            }
                                            $kinmu_time = $wk00_r;
                                        }
                                    }
                                } else {
                                    
                                    if ($kinmu_time == $wk00_t) {
                                        if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        } else {
                                            if ($kinmu_flg == 1) {
                                                $hayazan = 0;
                                                $tuzan = $zan + ($calc_kinmu_time - $wk00_r);
                                            } elseif ($kinmu_flg == 2) {
                                                $tuzan = $calc_kinmu_time - $wk00_r;
                                                $hayazan = $hayade;
                                            }
                                            $kinmu_time = $wk00_r;
                                            $kinmu_otime = 0;
                                        }
                                    } else {
                                        if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                            $kinmu_time = $calc_kinmu_time;
                                            $kinmu_otime = 0;
                                        } else {
                                            if ($kinmu_flg == 1) {
                                                $hayazan = 0;
                                                $tuzan = $zan + ($calc_kinmu_time - $wk00_r);
                                            } elseif ($kinmu_flg == 2) {
                                                $tuzan = $calc_kinmu_time - $wk00_r;
                                                $hayazan = $hayade;
                                            } elseif ($kinmu_flg == 3) {
                                                $hayazan = 0;
                                                $tuzan = $calc_kinmu_time - $wk00_r;
                                            } else {
                                                $hayazan = $hayade;
                                                $tuzan = $zan;
                                            }
                                            $kinmu_time = $wk00_r;
                                            $kinmu_otime = 0;
                                        }
                                    }
                                }
                            //勤務区分が夜勤
                            } elseif ($calc_plan_kbn == 3) {
                                //シフトの所定が日をまたがない勤務
                                if ($calc_plan_joban_time < $calc_plan_kaban_time) {
                                    if ($calc_joban_time > $calc_kaban_time || $calc_joban_time == $calc_kaban_time) {
                                        if ($calc_plan_joban_time > $calc_joban_time) {
                                            $hayade = $calc_plan_joban_time - $calc_joban_time;
                                        } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                            $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                        }
                                        
                                        if ($calc_plan_kaban_time > $calc_kaban_time) {
                                            $zan = 1440 - ($calc_plan_kaban_time - $calc_kaban_time);
                                        } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                            $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                        }
                                    } elseif ($calc_joban_time < $calc_kaban_time) {
                                        if ($calc_plan_joban_time > $calc_joban_time) {
                                            $hayade = $calc_plan_joban_time - $calc_joban_time;
                                        } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                            $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                        }
                                        
                                        if ($calc_plan_kaban_time > $calc_kaban_time) {
                                            $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                        } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                            $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                        }
                                    }
                                //シフトの所定が日をまたぐ勤務
                                } else {
                                    //当日勤務のみ
                                    if ($calc_joban_time > $calc_kaban_time || $calc_joban_time == $calc_kaban_time) {
                                        if ($calc_plan_joban_time > $calc_joban_time) {
                                            $hayade = $calc_plan_joban_time - $calc_joban_time;
                                        } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                            $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                        }
                                        
                                        if ($calc_plan_kaban_time > $calc_kaban_time) {
                                            $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                        } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                            $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                        }
                                    } elseif ($calc_joban_time < $calc_kaban_time) {
                                        //翌日勤務
                                        if ($calc_joban_time <= $calc_plan_kaban_time) {
                                            if ($calc_plan_joban_time > $calc_joban_time) {
                                                $tikoku = 1440 - ($calc_plan_joban_time - $calc_joban_time);
                                            }
                                            
                                            if ($calc_plan_kaban_time > $calc_kaban_time) {
                                                $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                            } elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                                $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                            }
                                        //当日勤務
                                        } else {
                                            if ($calc_plan_joban_time > $calc_joban_time) {
                                                $hayade = $calc_plan_joban_time - $calc_joban_time;
                                            } elseif ($calc_plan_joban_time < $calc_joban_time) {
                                                $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                            }
                                            
                                            if ($calc_plan_kaban_time < $calc_kaban_time) {
                                                $soutai = 1440 - ($calc_kaban_time - $calc_plan_kaban_time);
                                            }
                                        }
                                        
                                        //if ($calc_plan_joban_time > $calc_joban_time) {
                                        //    $tikoku = 1440 - ($calc_plan_joban_time - $calc_joban_time);
                                        //} elseif ($calc_plan_joban_time < $calc_joban_time) {
                                        //    $tikoku = $calc_joban_time - $calc_plan_joban_time;
                                        //}
                                        //
                                        //if ($calc_plan_kaban_time > $calc_kaban_time) {
                                        //    $soutai = $calc_plan_kaban_time - $calc_kaban_time;
                                        //} elseif ($calc_plan_kaban_time < $calc_kaban_time) {
                                        //    $zan = $calc_kaban_time - $calc_plan_kaban_time;
                                        //}
                                    }
                                }
                                //var_dump($calc_plan_kbn,"所".$wk00_t,"実".$kinmu_time,"早出".$hayade,"遅刻".$tikoku,"早退".$soutai,"残業".$zan);
                                //exit;
                                if ($tikoku == "" && $soutai == "") {
                                    $kinmu_flg = 4;
                                    $calc_kinmu_time = $kinmu_time - $hayade - $zan;
                                } elseif ($tikoku != "" && $soutai == "") {
                                    $kinmu_flg = 1;
                                    $calc_kinmu_time = $kinmu_time - $zan;
                                } elseif ($tikoku == "" && $soutai != "") {
                                    $kinmu_flg = 2;
                                    $calc_kinmu_time = $kinmu_time - $hayade;
                                } else {
                                    $kinmu_flg = 3;
                                    $calc_kinmu_time = $kinmu_time;
                                }
                                //var_dump($calc_plan_kbn,"所".$wk00_t/60,"計算前実".$kinmu_time/60,"早出".$hayade/60,"遅刻".$tikoku/60,"早退".$soutai/60,"残業".$zan/60,"シ勤".$calc_kinmu_time/60);
                                //exit;
                                //シフト内勤務が所定労働以下
                                if ($calc_kinmu_time < $wk00_r || $calc_kinmu_time == $wk00_r) {
                                    $hayazan = $hayade;
                                    $tuzan = $zan;
                                    $kinmu_time = $calc_kinmu_time;
                                    $kinmu_otime = 0;
                                //シフト内勤務が所定労働以上
                                } else {
                                    //所定残業有り
                                    if ($wk00_o != 0) {
                                        $kinmu_syotei = $calc_kinmu_time - $wk00_r;
                                        if ($wk00_o > $kinmu_syotei || $wk00_o == $kinmu_syotei) {
                                            $kinmu_otime = $kinmu_syotei;
                                        } else {
                                            $kinmu_otime = $wk00_o;
                                        }
                                        
                                        if ($kinmu_flg == 1) {
                                            $hayazan = 0;
                                            $tuzan = $zan + ($calc_kinmu_time - $wk00_r - $kinmu_otime);
                                        } elseif ($kinmu_flg == 2 || $kinmu_flg == 3) {
                                            $tuzan = $calc_kinmu_time - $wk00_r - $kinmu_otime;
                                            $hayazan = $hayade;
                                        } else {
                                            $tuzan = $zan;
                                            $hayazan = $hayade;
                                        }
                                        $kinmu_time = $wk00_r;
                                    //所定残業なし
                                    } else {
                                        if ($kinmu_flg == 1) {
                                            $hayazan = 0;
                                            $tuzan = $zan + ($calc_kinmu_time - $wk00_r);
                                        } elseif ($kinmu_flg == 2 || $kinmu_flg == 3) {
                                            $tuzan = $calc_kinmu_time - $wk00_r;
                                            $hayazan = $hayade;
                                        } else {
                                            $hayazan = $hayade;
                                            $tuzan = $zan;
                                        }
                                        $kinmu_time = $wk00_r;
                                        $kinmu_otime = 0;
                                    }
                                }
                            }
                            //var_dump($calc_plan_kbn,"所合".$wk00_t/60,"実勤".$kinmu_time/60,"実合".$kinmu_time_total/60,"早残".$hayazan/60,"通残".$tuzan/60,"所残".$kinmu_otime/60,"シ勤".$calc_kinmu_time/60);
                            //exit;
                        }
                        //}
                    //勤務区分が時給
                    } elseif ($calc_plan_kbn == 6) {
                        //勤務時間8時間越え
                        if ($kinmu_time > $syotei) {
                            $tuzan = $kinmu_time - $syotei;
                            $kinmu_time = $kinmu_time - $tuzan;
                        }
                    }
                    
                    //KICTのみ15分刻みで計算
                    if ($this->inp_genba_id != "" && $this->inp_genba_id == 6) {
                        $tuzan1 = floor($tuzan/60)*60;
                        $tuzan2 = $tuzan%60;
                        if ($tuzan2%15 != 0) {
                            $calc1 = $tuzan2;
                            $calc2 = 15;
                            
                            if ($calc1%$calc2 < 5) {
                                $tuzan       = $tuzan1+($calc2*floor($calc1/$calc2));
                            } else {
                                $tuzan       = $tuzan1+($calc2*ceil($calc1/$calc2));
                            }
                        }
                    }
                    
                    $this->kinmu_time       = $kinmu_time;
                    $this->syotei_otime       = $kinmu_otime;
                    $this->hayazan_time       = $hayazan;
                    $this->tuzan_time       = $tuzan;
                    //var_dump($calc_plan_kbn,"実勤".$kinmu_time/60,"実合".$kinmu_time_total/60,"早残".$hayazan/60,"通残".$tuzan/60,"シ勤".$calc_kinmu_time/60);
                    //exit;
                    
                //実績がない場合
                } else {
                    if ($wk00_r != 0) {
                        $kinmu_time = $wk00_r;
                    }
                    if ($wk00_o != 0) {
                        $kinmu_otime = $wk00_o;
                    }
                    $hayazan = 0;
                    $tuzan = 0;
                    
                    $this->kinmu_time       = $kinmu_time;
                    $this->syotei_otime       = $kinmu_otime;
                    $this->hayazan_time       = $hayazan;
                    $this->tuzan_time       = $tuzan;
                }
            //上番区分が年休、欠勤、勤務区分が年休の場合
            } else {
                $this->kinmu_time       = $kinmu_time;
                $this->syotei_otime       = $kinmu_otime;
                $this->hayazan_time       = $hayazan;
                $this->tuzan_time       = $tuzan;
            }
        }

        // セレクト
        public function getWkservice()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_service_no "
                 . ",   t_wk_service_type_cd "
                 . ",   t_wk_service_type_item_cd "
                 . ",   t_wk_service_time "
                 . ",   t_wk_service_created "
                 . ",   t_wk_service_created_staffid "
                 . ",   t_wk_service_modified "
                 . ",   t_wk_service_modified_staffid "
                 . "FROM "
                 .     "t_wk_service "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_service_no != "") {
                $sql .= "AND t_wk_service_no = " . $db->escape_string($this->inp_t_wk_service_no) . " ";
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

            // var_dump($sql);

            // プリペアドクエリを実行する
            $result = $db->query($sql, $row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_t_wk_service_no[$row[0].$row[1].$row[2]]                  = $row[$i++];
                    $this->oup_t_wk_service_type_cd[$row[0].$row[1].$row[2]]             = $row[$i++];
                    $this->oup_t_wk_service_type_item_cd[$row[0].$row[1].$row[2]]        = $row[$i++];
                    $this->oup_t_wk_service_time[$row[0].$row[1].$row[2]]                = $row[$i++];
                    $this->oup_t_wk_service_created[$row[0].$row[1].$row[2]]             = $row[$i++];
                    $this->oup_t_wk_service_created_staffid[$row[0].$row[1].$row[2]]     = $row[$i++];
                    $this->oup_t_wk_service_modified[$row[0].$row[1].$row[2]]            = $row[$i++];
                    $this->oup_t_wk_service_modified_staffid[$row[0].$row[1].$row[2]]    = $row[$i++];

                    // var_dump($row);
// var_dump($this->oup_t_wk_service_time);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            // var_dump($result);

            return $this->result;

            // MySQLへの接続を閉じる
            $db->close();
        }

        // セレクト
        public function getWkservice2()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_service_no "
                 . ",   t_wk_service_type_cd "
                 . ",   t_wk_service_type_item_cd "
                 . ",   t_wk_service_time "
                 . ",   t_wk_service_content "
                 . ",   t_wk_service_created "
                 . ",   t_wk_service_created_staffid "
                 . ",   t_wk_service_modified "
                 . ",   t_wk_service_modified_staffid "
                 . "FROM "
                 .     "t_wk_service "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_service_no != "") {
                $sql .= "AND t_wk_service_no = " . $db->escape_string($this->inp_t_wk_service_no) . " ";
            }

            // SQL実行

            // 文字化け防止
            $db->set_charset();

            // var_dump($sql);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_t_wk_service_no[]                  = $row[$i++];
                    $this->oup_t_wk_service_type_cd[]             = $row[$i++];
                    $this->oup_t_wk_service_type_item_cd[]        = $row[$i++];
                    $this->oup_t_wk_service_time[]                = $row[$i++];
                    $this->oup_t_wk_service_content[]             = $row[$i++];
                    $this->oup_t_wk_service_created[]             = $row[$i++];
                    $this->oup_t_wk_service_created_staffid[]     = $row[$i++];
                    $this->oup_t_wk_service_modified[]            = $row[$i++];
                    $this->oup_t_wk_service_modified_staffid[]    = $row[$i++];

                    // var_dump($row);
// var_dump($this->oup_t_wk_service_time);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            // var_dump($result);

            return $this->result;

            // MySQLへの接続を閉じる
            $db->close();
        }

        // セレクト
        public function getWkPlan()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_no "
                 . ",   t_wk_office_id "
                 . ",   t_wk_genba_id "
                 . ",   m_genba_name "
                 . ",   t_wk_taiin_id "
                 . ",   t_wk_plan_date "
                 . ",   t_wk_plan_kbn "
                 . ",   t_wk_plan_joban_time "
                 . ",   t_wk_plan_kaban_time "
                 . ",   t_wk_del_flg "
                 . ",   t_wk_created "
                 . ",   t_wk_created_id "
                 . ",   t_wk_modified "
                 . ",   t_wk_modified_id "
                 . "FROM "
                 .     "t_wk "
                 . "INNER JOIN m_genba ON t_wk_genba_id = m_genba_id AND m_genba_del_flg = '0' "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_no != "") {
                $sql .= "AND t_wk_no = " . $db->escape_string($this->inp_t_wk_no) . " ";
            }
            if ($this->inp_t_wk_office_id != "") {
                $sql .= "AND t_wk_office_id = " . $db->escape_string($this->inp_t_wk_office_id) . " ";
            }
            if ($this->inp_t_wk_genba_id != "") {
                $sql .= "AND t_wk_genba_id = " . $db->escape_string($this->inp_t_wk_genba_id) . " ";
            }
            if ($this->inp_t_wk_genba_name != "") {
                $sql .= "AND m_genba_name LIKE '%" . $db->escape_string($this->inp_m_genba_name) . "%' ";
            }
            if ($this->inp_t_wk_taiin_id != "") {
                $sql .= "AND t_wk_taiin_id = '" . $db->escape_string($this->inp_t_wk_taiin_id) . "' ";
            }
            if ($this->inp_t_wk_plan_month != "") {
                $sql .= "AND DATE_FORMAT(t_wk_plan_date,'%Y%m') = '" . $db->escape_string($this->inp_t_wk_plan_month) . "' ";
            }
            if ($this->inp_t_wk_plan_date != "") {
                $sql .= "AND t_wk_plan_date = '" . substr($db->escape_string($this->inp_t_wk_plan_date), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date), 4, 2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_date), 6, 2) . "' ";
            }
            if ($this->inp_t_wk_plan_kbn != "") {
                $sql .= "AND t_wk_plan_kbn = '" . $db->escape_string($this->inp_t_wk_plan_kbn) . "' ";
            }
            if ($this->inp_t_wk_plan_joban_time != "") {
                $sql .= "AND t_wk_plan_joban_time = '" . $db->escape_string($this->inp_t_wk_plan_joban_time) . "' ";
            }
            if ($this->inp_t_wk_plan_kaban_time != "") {
                $sql .= "AND t_wk_plan_kaban_time = '" . $db->escape_string($this->inp_t_wk_plan_kaban_time) . "' ";
            }

            if (substr($sql, -12, 12) == "WHERE 0 = 0 ") {
                return;
            }

            if ($this->inp_order == "") {
                $sql .= "ORDER BY t_wk_plan_date, t_wk_plan_joban_time, t_wk_taiin_id  ";
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

                    $this->oup_t_wk_no[]              = $row[$i++];
                    $this->oup_t_wk_office_id[]       = $row[$i++];
                    $this->oup_t_wk_genba_id[]        = $row[$i++];
                    $this->oup_m_genba_name[]           = $row[$i++];
                    $this->oup_t_wk_taiin_id[]        = $row[$i++];
                    $this->oup_t_wk_plan_date[]       = $row[$i++];
                    $this->oup_t_wk_plan_kbn[]        = $row[$i++];
                    $this->oup_t_wk_plan_joban_time[] = $row[$i++];
                    $this->oup_t_wk_plan_kaban_time[] = $row[$i++];
                    $this->oup_t_wk_del_flg[]         = $row[$i++];
                    $this->oup_t_wk_created[]         = $row[$i++];
                    $this->oup_t_wk_created_id[]      = $row[$i++];
                    $this->oup_t_wk_modified[]        = $row[$i++];
                    $this->oup_t_wk_modified_id[]     = $row[$i++];

                    //var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            // var_dump($result);

            return $this->result;

            // MySQLへの接続を閉じる
            $db->close();
        }

        public function getWkdaysum()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "count(t_wk_no) as cnt "
                 . ",   sum(t_wk_run_time) as cnt "
                 . ",   DATE_FORMAT(t_wk_run_start_date ,'%Y年%m月%d日') as day1 "
                 . ",   DATE_FORMAT(t_wk_run_start_date ,'%Y%m%d') as day2 "
                 . "FROM "
                 .     "t_wk "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_visitor_id != "") {
                $sql .= "AND t_wk_visitor_id = '" . $db->escape_string($this->inp_t_wk_visitor_id) . "' ";
            }
            if ($this->inp_t_wk_run_start_month != "") {
                $sql .= "AND t_wk_run_start_date between '" . substr($db->escape_string($this->inp_t_wk_run_start_month), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_run_start_month), 4, 2) . "-01' and '".date('Y-m-d', mktime(0, 0, 0, substr($db->escape_string($this->inp_t_wk_run_start_month), 4, 2) + 1, 0, date('Y')))."' ";
            }
            $sql .= "GROUP BY ";
            $sql .= "    day1 ";
            $sql .= "ORDER BY ";
            $sql .= "    day2 DESC ";

            // SQL実行

            // 文字化け防止
            $db->set_charset();

            //  var_dump($sql);

            // プリペアドクエリを実行する
//            $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_t_wk_day_cnt[]                = $row[$i++];
                    $this->oup_t_wk_daytime[]                = $row[$i++];
                    $this->oup_t_wk_day1[]                   = $row[$i++];
                    $this->oup_t_wk_day2[]                   = $row[$i++];

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

        public function getWkPlandaysum()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "count(t_wk_no) as cnt "
                 . ",   sum((substr(t_wk_plan_end_time,1,2)*60+substr(t_wk_plan_end_time,3,2))-(substr(t_wk_plan_start_time,1,2)*60+substr(t_wk_plan_start_time,3,2))) as cnt "
                 . ",   concat(DATE_FORMAT(t_wk_plan_start_date ,'%c月%e日'),\"(\",ELT(WEEKDAY(t_wk_plan_start_date)+1,\"月\",\"火\",\"水\",\"木\",\"金\",\"土\",\"日\"),\")\") as day1 "
                 . ",   DATE_FORMAT(t_wk_plan_start_date ,'%Y%m%d') as day2 "
                 . "FROM "
                 .     "t_wk "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_plan_id != "") {
                $sql .= "AND t_wk_plan_id = '" . $db->escape_string($this->inp_t_wk_plan_id) . "' ";
            }
            if ($this->inp_t_wk_plan_start_month != "") {
                $sql .= "AND DATE_FORMAT(t_wk_plan_start_date,'%Y%m') = '" . $db->escape_string($this->inp_t_wk_plan_start_month) . "' ";
            }
            if ($this->inp_t_wk_plan_start_date != "") {
                $sql .= "AND (t_wk_plan_start_date >= '" . substr($db->escape_string($this->inp_t_wk_plan_start_date), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_start_date), 4, 2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_start_date), 6, 2) . "' ";
                $sql .= "AND  t_wk_plan_start_date <= '" . substr($db->escape_string($this->inp_t_wk_plan_end_date), 0, 4) . "-" . substr($db->escape_string($this->inp_t_wk_plan_end_date), 4, 2) . "-" . substr($db->escape_string($this->inp_t_wk_plan_end_date), 6, 2) . "') ";
            }
            if ($this->inp_t_wk_delete_flg != "") {
                $sql .= "AND t_wk_delete_flg = '" . $db->escape_string($this->inp_t_wk_delete_flg) . "' ";
            }

            $sql .= "GROUP BY ";
            $sql .= "    day1 ";
            $sql .= "ORDER BY ";
            $sql .= "    day2 ";

            // SQL実行

            // 文字化け防止
            $db->set_charset();

              //var_dump($sql);

            // プリペアドクエリを実行する
//            $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_t_wk_day_cnt[]                = $row[$i++];
                    $this->oup_t_wk_daytime[]                = $row[$i++];
                    $this->oup_t_wk_day1[]                   = $row[$i++];
                    $this->oup_t_wk_day2[]                   = $row[$i++];

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

        public function getWkmonthsum()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "count(t_wk_no) as cnt "
                 . ",   sum(t_wk_run_time) as cnt "
                 . ",   DATE_FORMAT(t_wk_run_start_date ,'%Y年%m月') as month1 "
                 . ",   DATE_FORMAT(t_wk_run_start_date ,'%Y%m') as month2 "
                 . "FROM "
                 .     "t_wk "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_visitor_id != "") {
                $sql .= "AND t_wk_visitor_id = '" . $db->escape_string($this->inp_t_wk_visitor_id) . "' ";
            }

            $sql .= "GROUP BY ";
            $sql .= "    month1 ";
            $sql .= "ORDER BY ";
            $sql .= "    month2 ";

            // SQL実行

            // 文字化け防止
            $db->set_charset();

            // var_dump($sql);

            // プリペアドクエリを実行する
//            $result = $db->query($sql,$row);

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_t_wk_month_cnt[]                = $row[$i++];
                    $this->oup_t_wk_monthtime[]               = $row[$i++];
                    $this->oup_t_wk_month1[]                   = $row[$i++];
                    $this->oup_t_wk_month2[]                   = $row[$i++];

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

        public function getWkplanservice()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_plan_service_no "
                 . ",   t_wk_plan_service_type_cd "
                 . ",   t_wk_plan_service_type_item_cd "
                 . ",   t_wk_plan_service_time "
                 . ",   t_wk_plan_content "
                 . ",   t_wk_plan_service_created "
                 . ",   t_wk_plan_service_created_staffid "
                 . ",   t_wk_plan_service_modified "
                 . ",   t_wk_plan_service_modified_staffid "
                 . "FROM "
                 .     "t_wk_plan_service "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_plan_service_no != "") {
                $sql .= "AND t_wk_plan_service_no = '" . $db->escape_string($this->inp_t_wk_plan_service_no) . "' ";
            }

            // 文字化け防止
            $db->set_charset();

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_t_wk_plan_service_no[]                 = $row[$i++];
                    $this->oup_t_wk_plan_service_type_cd[]            = $row[$i++];
                    $this->oup_t_wk_plan_service_type_item_cd[]       = $row[$i++];
                    $this->oup_t_wk_plan_service_time[]               = $row[$i++];
                    $this->oup_t_wk_plan_content[]                    = $row[$i++];
                    $this->oup_t_wk_plan_service_created[]            = $row[$i++];
                    $this->oup_t_wk_plan_service_created_staffid[]    = $row[$i++];
                    $this->oup_t_wk_plan_service_modified[]           = $row[$i++];
                    $this->oup_t_wk_plan_service_modified_staffid[]   = $row[$i++];

                    // var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;
        }

        public function getServiceItem()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "m_service_item_type_cd "
                 . ",   m_service_item_cd "
                 . ",   m_service_item_content "
                 . "FROM "
                 .     "m_service_item "
                 . "WHERE 0 = 0 ";

            if ($this->inp_m_service_item_type_cd != "") {
                $sql .= "AND m_service_item_type_cd = '" . $db->escape_string($this->inp_m_service_item_type_cd) . "' ";
            }
            if ($this->inp_m_service_item_cd != "") {
                $sql .= "AND m_service_item_cd = '" . $db->escape_string($this->inp_m_service_item_cd) . "' ";
            }

            // 文字化け防止
            $db->set_charset();

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_m_service_item_type_cd[]       = $row[$i++];
                    $this->oup_m_service_item_cd[]            = $row[$i++];
                    $this->oup_m_service_item_content[]       = $row[$i++];

                    // var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;
        }

        public function getWkconfirm()
        {
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
                 .     "t_wk_confirm_staff_id "
                 . ",   t_wk_confirm_start_date "
                 . ",   t_wk_confirm_created "
                 . ",   t_wk_confirm_created_staffid "
                 . ",   t_wk_confirm_modified "
                 . ",   t_wk_confirm_modified_staffid "
                 . "FROM "
                 .     "t_wk_confirm "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_confirm_staff_id != "") {
                $sql .= "AND t_wk_confirm_staff_id = '" . $db->escape_string($this->inp_t_wk_confirm_staff_id) . "' ";
            }
            if ($this->inp_t_wk_confirm_start_date != "") {
                $sql .= "AND t_wk_confirm_start_date = '" . $db->escape_string($this->inp_t_wk_confirm_start_date) . "' ";
            }

            // 文字化け防止
            $db->set_charset();

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_t_wk_confirm_staff_id[]            = $row[$i++];
                    $this->oup_t_wk_confirm_start_date[]          = $row[$i++];
                    $this->oup_t_wk_confirm_created[]             = $row[$i++];
                    $this->oup_t_wk_confirm_created_staffid[]     = $row[$i++];
                    $this->oup_t_wk_confirm_modified[]            = $row[$i++];
                    $this->oup_t_wk_confirm_modified_staffid[]    = $row[$i++];

                    // var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;
        }

        // 勤務予定表集計で使用
        public function getWkGenbaNengetuKbn()
        {
            // SELECT * FROM `t_wk_detail` WHERE `t_wk_genba_id` = '99' and DATE_FORMAT(`t_wk_plan_date`, '%Y%m') = 202001
            $row = null;

            $db = new Db();

            $db->connect();

            $sql = "SELECT "
            .     "t_wk_detail_no "
                 . ",   t_wk_office_id "
                 . ",   t_wk_genba_id "
                 . ",   t_wk_taiin_id "
                 . ",   t_wk_plan_date "
                 . ",   t_wk_plan_kbn "
                 . ",   t_wk_plan_hosoku "
                 . ",   HOUR(t_wk_plan_joban_time) "
                 . ",   MINUTE(t_wk_plan_joban_time) "
                 . ",   HOUR(t_wk_plan_kaban_time) "
                 . ",   MINUTE(t_wk_plan_kaban_time) "
                 . ",   t_wk_plan_kensyu "
                 . ",   t_wk_hokoku_id "
                 . ",   t_wk_joban_kbn "
                 . ",   HOUR(t_wk_joban_dakoku_time) "
                 . ",   MINUTE(t_wk_joban_dakoku_time) "
                 . ",   HOUR(t_wk_joban_time) "
                 . ",   MINUTE(t_wk_joban_time) "
                 . ",   t_wk_kaban_kbn "
                 . ",   HOUR(t_wk_kaban_dakoku_time) "
                 . ",   MINUTE(t_wk_kaban_dakoku_time) "
                 . ",   HOUR(t_wk_kaban_time) "
                 . ",   MINUTE(t_wk_kaban_time) "
                 . ",   t_wk_kyukei_start1 "
                 . ",   t_wk_kyukei_end1 "
                 . ",   t_wk_kyukei_start2 "
                 . ",   t_wk_kyukei_end2 "
                 . ",   t_wk_kyukei_start3 "
                 . ",   t_wk_kyukei_end3 "
                 . ",   t_wk_kyukei_start4 "
                 . ",   t_wk_kyukei_end4 "
                 . ",   t_wk_kyukei_start5 "
                 . ",   t_wk_kyukei_end5 "
                 . ",   t_wk_kyukei_start6 "
                 . ",   t_wk_kyukei_end6 "
                 . ",   t_wk_kotuhi "
                 . ",   t_wk_post_teate "
                 . ",   t_wk_kiken_teate "
                 . ",   t_wk_kuruma_teate "
                 . ",   t_wk_shogatu_teate " // 正月手当て
                 . ",   t_wk_kaki_teate " // 夏季手当て
                 . ",   t_wk_etc_teate1 "
                 . ",   t_wk_etc_teate2 "
                 . ",   t_wk_etc_teate3 "
                 . ",   HOUR(t_wk_daytime_over_time) " // 昼残時間
                 . ",   MINUTE(t_wk_daytime_over_time) "
                 . ",   HOUR(t_wk_rest_over_time) " // 休憩残業時間
                 . ",   MINUTE(t_wk_rest_over_time) "
                 . ",   HOUR(t_wk_midnight_over_time) " // 深夜残業時間
                 . ",   MINUTE(t_wk_midnight_over_time) "
                 . ",   t_wk_rest_reason "
                 . ",   t_wk_del_flg "
                 . "FROM "
                 .     "t_wk_detail "
                 . "WHERE 0 = 0 ";

            if ($this->inp_t_wk_genba_id != "") {
                $sql .= "AND t_wk_genba_id = '" . $db->escape_string($this->inp_t_wk_genba_id) . "' ";
            }
            if ($this->inp_t_wk_plan_date != "") {
                $sql .= "AND DATE_FORMAT(`t_wk_plan_date`, '%Y%m') = '" . $db->escape_string($this->inp_t_wk_plan_date) . "' ";
            }
            if ($this->inp_t_wk_plan_kbn != "") {
                $sql .= "AND t_wk_plan_kbn = '" . $db->escape_string($this->inp_t_wk_plan_kbn) . "' ";
            }

            // 文字化け防止
            $db->set_charset();

            // プリペアドクエリを実行する
            if ($this->result = $db->query($sql)) {
                while ($row = mysqli_fetch_row($this->result)) {
                    $i = 0;

                    $this->oup_t_wk_detail_no[]       = $row[$i++];
                    $this->oup_t_wk_office_id[]       = $row[$i++];
                    $this->oup_t_wk_genba_id[]        = $row[$i++];
                    $this->oup_t_wk_taiin_id[]        = $row[$i++];
                    $this->oup_t_wk_plan_date[]       = $row[$i++];
                    $this->oup_t_wk_plan_kbn[]        = $row[$i++];
                    $this->oup_t_wk_plan_hosoku[]     = $row[$i++];
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_plan_joban_time[] = null;
                    } else {
                        $this->oup_t_wk_plan_joban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_plan_kaban_time[] = null;
                    } else {
                        $this->oup_t_wk_plan_kaban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    $this->oup_t_wk_plan_kensyu[]     = $row[$i++];
                    $this->oup_t_wk_hokoku_id[]       = $row[$i++];
                    $this->oup_t_wk_joban_kbn[]       = $row[$i++];
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_joban_dakoku_time[] = null;
                    } else {
                        $this->oup_t_wk_joban_dakoku_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_joban_time[] = null;
                    } else {
                        $this->oup_t_wk_joban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    $this->oup_t_wk_kaban_kbn[]       = $row[$i++];
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_kaban_dakoku_time[] = null;
                    } else {
                        $this->oup_t_wk_kaban_dakoku_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_kaban_time[] = null;
                    } else {
                        $this->oup_t_wk_kaban_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    $this->oup_t_wk_kyukei_start1[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end1[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start2[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end2[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start3[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end3[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start4[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end4[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start5[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end5[]     = $row[$i++];
                    $this->oup_t_wk_kyukei_start6[]   = $row[$i++];
                    $this->oup_t_wk_kyukei_end6[]     = $row[$i++];
                    $this->oup_t_wk_kotuhi[]          = $row[$i++];
                    $this->oup_t_wk_post_teate[]      = $row[$i++];
                    $this->oup_t_wk_kiken_teate[]     = $row[$i++];
                    $this->oup_t_wk_kuruma_teate[]    = $row[$i++];
                    $this->oup_t_wk_shogatu_teate[]   = $row[$i++];
                    $this->oup_t_wk_kaki_teate[]      = $row[$i++];
                    $this->oup_t_wk_etc_teate1[]      = $row[$i++];
                    $this->oup_t_wk_etc_teate2[]      = $row[$i++];
                    $this->oup_t_wk_etc_teate3[]      = $row[$i++];
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_daytime_over_time[] = null;
                    } else {
                        $this->oup_t_wk_daytime_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_daytime_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ; // 昼残時間
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_rest_over_time[] = null;
                    } else {
                        $this->oup_t_wk_rest_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_rest_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;// 休憩残業時間
                    $wk_time1 = $row[$i++];
                    $wk_time2 = $row[$i++];
                    if ($wk_time1 == null || $wk_time2 == null) {
                        $this->oup_t_wk_midnight_over_time[] = null;
                    } else {
                        $this->oup_t_wk_midnight_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;
                    }
                    // $this->oup_t_wk_midnight_over_time[] = sprintf('%02d', $wk_time1).":".sprintf('%02d', $wk_time2) ;// 深夜残業時間
                    $this->oup_t_wk_rest_reason[]     = $row[$i++];
                    $this->oup_t_wk_del_flg[]         = $row[$i++];

                    //var_dump($row);
                }

                /* 結果セットを開放します */
                mysqli_free_result($this->result);
            }
            return $this->result;
        }

        // インサート
        public function insertWkdetail()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO t_wk_detail "
                 . "( "
                 .     "t_wk_office_id ";
            $sql.= ",   t_wk_genba_id "
                 . ",   t_wk_taiin_id ";
            $sql.= ",   t_wk_plan_date ";
            $sql.= ",   t_wk_plan_kbn "
                 . ",   t_wk_plan_hosoku ";

            $sql.= ",   t_wk_joban_kbn ";
            if ($this->inp_t_wk_joban_dakoku_time != "") {
                $sql.= ",   t_wk_joban_dakoku_time ";
            }

            $sql.= ",   t_wk_plan_joban_time ";

            if ($this->inp_t_wk_kaban_dakoku_time != "") {
                $sql.= ",   t_wk_kaban_dakoku_time ";
            }

            $sql.= ",   t_wk_plan_kaban_time "
                 . ",   t_wk_plan_kensyu "
                 . ",   t_wk_post_teate "
                 . ",   t_wk_kuruma_teate "
                 . ",   t_wk_shift_no "
                 . ",   t_wk_created "
                 . ",   t_wk_created_id "
                 . ",   t_wk_kinmu_time "
                 . ",   t_wk_kintime "
                 . ",   t_wk_syotei_zan "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_t_wk_office_id."'";
            $sql.= ",    '".$this->inp_t_wk_genba_id."'"
                 . ",    '".$this->inp_t_wk_taiin_id."'";
            $sql.= ",    '".$this->inp_t_wk_plan_date."'";
            $sql.= ",    '".$this->inp_t_wk_plan_kbn."'"
                 . ",    '".$this->inp_t_wk_plan_hosoku."'"
                 . ",    '".$this->inp_t_wk_joban_kbn."'";

            if ($this->inp_t_wk_joban_dakoku_time != "") {
                $sql.= ",    '".$this->inp_t_wk_joban_dakoku_time."'";
            }

            $sql.= ",    '".$this->inp_t_wk_plan_joban_time."'";

            if ($this->inp_t_wk_kaban_dakoku_time != "") {
                $sql.= ",    '".$this->inp_t_wk_kaban_dakoku_time."'";
            }

            $sql.= ",    '".$this->inp_t_wk_plan_kaban_time."'"
                 . ",    '".$this->inp_t_wk_plan_kensyu."'"
                 . ",    '".$this->inp_t_wk_post_teate."'"
                 . ",    '".$this->inp_t_wk_kuruma_teate."'"
                 . ",    '".$this->inp_t_wk_shift_no."'"
                 . ",    '".$this->inp_t_wk_created."'"
                 //. ",    '".$this->inp_t_wk_created_staffid."'"
                 . ",    '".$this->inp_t_wk_created_id."'"
                 . ",    '".$this->inp_t_wk_kinmu_time."'"
                 . ",    '".$this->inp_t_wk_kintime."'"
                 . ",    '".$this->inp_t_wk_syotei_zan."'"
                 . ") ";

//             var_dump($sql);


require dirname(__FILE__).'./common/log.php';

            // 文字化け防止
            $db->set_charset();

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
        public function insertWkService()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO t_wk_service "
                 . "( "
                 .     "t_wk_service_no "
                 . ",   t_wk_service_type_cd "
                 . ",   t_wk_service_type_item_cd "
                 . ",   t_wk_service_time "
                 . ",   t_wk_service_content "
                 . ",   t_wk_service_created "
                 . ",   t_wk_service_created_staffid "
                 . ",   t_wk_service_modified "
                 . ",   t_wk_service_modified_staffid "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_t_wk_service_no."'"
                 . ",    '".$this->inp_t_wk_service_type_cd."'"
                 . ",    '".$this->inp_t_wk_service_type_item_cd."'"
                 . ",    '".$this->inp_t_wk_service_time."'"
                 . ",    '".$this->inp_t_wk_service_content."'"
                 . ",    '".$this->inp_t_wk_service_created."'"
                 . ",    '".$this->inp_t_wk_service_created_staffid."'"
                 . ",    '".$this->inp_t_wk_service_modified."'"
                 . ",    '".$this->inp_t_wk_service_modified_staffid."'"
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

        // インサート
        public function insertServiceItem()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO m_service_item "
                 . "( "
                 .     "m_service_item_type_cd "
                 . ",   m_service_item_cd "
                 . ",   m_service_item_content "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_m_service_item_type_cd."'"
                 . ",    '".$this->inp_m_service_item_cd."'"
                 . ",    '".$this->inp_m_service_item_content."'"
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

        // インサート
        public function insertWkPlanService()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO t_wk_plan_service "
                 . "( "
                 .     "t_wk_plan_service_no "
                 . ",   t_wk_plan_service_type_cd "
                 . ",   t_wk_plan_service_type_item_cd "
                 . ",   t_wk_plan_service_time "
                 . ",   t_wk_plan_content "
                 . ",   t_wk_plan_service_created "
                 . ",   t_wk_plan_service_created_staffid "
                 . ",   t_wk_plan_service_modified "
                 . ",   t_wk_plan_service_modified_staffid "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_t_wk_plan_service_no."'"
                 . ",    '".$this->inp_t_wk_plan_service_type_cd."'"
                 . ",    '".$this->inp_t_wk_plan_service_type_item_cd."'"
                 . ",    '".$this->inp_t_wk_plan_service_time."'"
                 . ",    '".$this->inp_t_wk_plan_content."'"
                 . ",    '".$this->inp_t_wk_plan_service_created."'"
                 . ",    '".$this->inp_t_wk_plan_service_created_staffid."'"
                 . ",    '".$this->inp_t_wk_plan_service_modified."'"
                 . ",    '".$this->inp_t_wk_plan_service_modified_staffid."'"
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

        // インサート
        public function insertWkConfirm()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "INSERT INTO t_wk_confirm "
                 . "( "
                 .     "t_wk_confirm_staff_id "
                 . ",   t_wk_confirm_start_date "
                 . ",   t_wk_confirm_created "
                 . ",   t_wk_confirm_created_staffid "
                 . ",   t_wk_confirm_modified "
                 . ",   t_wk_confirm_modified_staffid "
                 . ") "
                 . "VALUES "
                 . "( "
                 . "     '".$this->inp_t_wk_confirm_staff_id."'"
                 . ",    '".$this->inp_t_wk_confirm_start_date."'"
                 . ",    '".$this->inp_t_wk_confirm_created."'"
                 . ",    '".$this->inp_t_wk_confirm_created_staffid."'"
                 . ",    '".$this->inp_t_wk_confirm_modified."'"
                 . ",    '".$this->inp_t_wk_confirm_modified_staffid."'"
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
        public function updateWkdetail()
        {
            $db = new Db();
            $whereflg = false;

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE t_wk_detail SET ";
            if ($this->inp_t_wk_detail_no != "") {
                $sql .= "    t_wk_detail_no                = '" . $this->inp_t_wk_detail_no . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_genba_id != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_genba_id                = '" . $this->inp_t_wk_genba_id . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_shift_no != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_shift_no                = '" . $this->inp_t_wk_shift_no . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_plan_kbn))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_plan_kbn != "") {
                    $sql .= "    t_wk_plan_kbn            = '" . $this->inp_t_wk_plan_kbn . "' ";
                } else {
                    $sql .= "    t_wk_plan_kbn            = '' ";
                }
                $whereflg = true;
            }
            //if ($this->inp_t_wk_plan_kbn != "") {
            //    if ($whereflg == true) {
            //        $sql .= ",";
            //    }
            //    $sql .= "    t_wk_plan_kbn                = '" . $this->inp_t_wk_plan_kbn . "' ";
            //    $whereflg = true;
            //}
            //if ($this->inp_t_wk_plan_hosoku == "") {
            //    if ($whereflg == true) {
            //        $sql .= ",";
            //    }
            //    $sql .= "    t_wk_plan_hosoku                = '' ";
            //    $whereflg = true;
            //}

            if (!(is_null($this->inp_t_wk_plan_hosoku))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_plan_hosoku != "") {
                    $sql .= "    t_wk_plan_hosoku            = '" . $this->inp_t_wk_plan_hosoku . "' ";
                } else {
                    $sql .= "    t_wk_plan_hosoku            = null ";
                }
                $whereflg = true;
            }
            //if ($this->inp_t_wk_plan_hosoku != "") {
            //    if ($whereflg == true) {
            //        $sql .= ",";
            //    }
            //    $sql .= "    t_wk_plan_hosoku                = '" . $this->inp_t_wk_plan_hosoku . "' ";
            //    $whereflg = true;
            //}
            if (!(is_null($this->inp_t_wk_plan_joban_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_plan_joban_time != "null") {
                    $sql .= "    t_wk_plan_joban_time           = '" . $this->inp_t_wk_plan_joban_time . "' ";
                } else {
                    $sql .= "    t_wk_plan_joban_time           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_plan_kaban_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_plan_kaban_time != "null") {
                    $sql .= "    t_wk_plan_kaban_time           = '" . $this->inp_t_wk_plan_kaban_time . "' ";
                } else {
                    $sql .= "    t_wk_plan_kaban_time           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_joban_kbn))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_joban_kbn                = '" . $this->inp_t_wk_joban_kbn . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_joban_dakoku_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_joban_dakoku_time != "") {
                    $sql .= "    t_wk_joban_dakoku_time           = '" . $this->inp_t_wk_joban_dakoku_time . "' ";
                } else {
                    $sql .= "    t_wk_joban_dakoku_time           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_joban_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_joban_time != "") {
                    $sql .= "    t_wk_joban_time           = '" . $this->inp_t_wk_joban_time . "' ";
                    $sql .= ",";
                    $sql .= "    t_wk_joban_kbn           = '1' ";
                } else {
                    $sql .= "    t_wk_joban_time           = null ";
                    if ($this->inp_t_wk_joban_kbn != 4 && $this->inp_t_wk_joban_kbn != 5) {
                        $sql .= ",";
                        $sql .= "    t_wk_joban_kbn           = null ";
                    }
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kaban_kbn))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_kaban_kbn                  = '" . $this->inp_t_wk_kaban_kbn . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kaban_dakoku_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kaban_dakoku_time != "") {
                    $sql .= "    t_wk_kaban_dakoku_time            = '" . $this->inp_t_wk_kaban_dakoku_time . "' ";
                } else {
                    $sql .= "    t_wk_kaban_dakoku_time            = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kaban_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kaban_time != "") {
                    $sql .= "    t_wk_kaban_time            = '" . $this->inp_t_wk_kaban_time . "' ";
                    $sql .= ",";
                    $sql .= "    t_wk_kaban_kbn            = '1' ";
                } else {
                    $sql .= "    t_wk_kaban_time            = null ";
                    $sql .= ",";
                    $sql .= "    t_wk_kaban_kbn            = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_start1))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_start1 != "") {
                    $sql .= "    t_wk_kyukei_start1           = '" . $this->inp_t_wk_kyukei_start1 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_start1           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_end1))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_end1 != "") {
                    $sql .= "    t_wk_kyukei_end1           = '" . $this->inp_t_wk_kyukei_end1 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_end1           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_start2))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_start2 != "") {
                    $sql .= "    t_wk_kyukei_start2           = '" . $this->inp_t_wk_kyukei_start2 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_start2           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_end2))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_end2 != "") {
                    $sql .= "    t_wk_kyukei_end2           = '" . $this->inp_t_wk_kyukei_end2 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_end2           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_start3))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_start3 != "") {
                    $sql .= "    t_wk_kyukei_start3           = '" . $this->inp_t_wk_kyukei_start3 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_start3           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_end3))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_end3 != "") {
                    $sql .= "    t_wk_kyukei_end3           = '" . $this->inp_t_wk_kyukei_end3 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_end3           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_start4))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_start4 != "") {
                    $sql .= "    t_wk_kyukei_start4           = '" . $this->inp_t_wk_kyukei_start4 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_start4           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_end4))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_end4 != "") {
                    $sql .= "    t_wk_kyukei_end4           = '" . $this->inp_t_wk_kyukei_end4 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_end4           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_start5))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_start5 != "") {
                    $sql .= "    t_wk_kyukei_start5           = '" . $this->inp_t_wk_kyukei_start5 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_start5           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_end5))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_end5 != "") {
                    $sql .= "    t_wk_kyukei_end5           = '" . $this->inp_t_wk_kyukei_end5 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_end5           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_start6))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_start6 != "") {
                    $sql .= "    t_wk_kyukei_start6           = '" . $this->inp_t_wk_kyukei_start6 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_start6           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kyukei_end6))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kyukei_end6 != "") {
                    $sql .= "    t_wk_kyukei_end6           = '" . $this->inp_t_wk_kyukei_end6 . "' ";
                } else {
                    $sql .= "    t_wk_kyukei_end6           = null ";
                }
                $whereflg = true;
            }
            if ($this->inp_t_wk_cooperation_no != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_cooperation_no                = '" . $this->inp_t_wk_cooperation_no . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_office_id != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_office_id                = '" . $this->inp_t_wk_office_id . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_user_id != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_user_id                       = '" . $this->inp_t_wk_user_id . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_start_date != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_start_date          = '" . $this->inp_t_wk_plan_start_date . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_id != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_id                  = '" . $this->inp_t_wk_plan_id . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_run_end_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_run_end_time             = '" . $this->inp_t_wk_run_end_time . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_run_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_run_time                 = '" . $this->inp_t_wk_run_time . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_stop_kbn))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_stop_kbn                 = '" . $this->inp_t_wk_stop_kbn . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_visitor_id))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_visitor_id               = '" . $this->inp_t_wk_visitor_id . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kotuhi))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_kotuhi            = '" . $this->inp_t_wk_kotuhi . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_post_teate))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_post_teate            = '" . $this->inp_t_wk_post_teate . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kiken_teate))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_kiken_teate            = '" . $this->inp_t_wk_kiken_teate . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kuruma_teate != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_kuruma_teate           = '" . $this->inp_t_wk_kuruma_teate . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kaki_teate != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_kaki_teate           = '" . $this->inp_t_wk_kaki_teate . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_shogatu_teate != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_shogatu_teate           = '" . $this->inp_t_wk_shogatu_teate . "' ";
                $whereflg = true;
            }

            if (!(is_null($this->inp_t_wk_etc_teate1))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_etc_teate1            = '" . $this->inp_t_wk_etc_teate1 . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_etc_teate2))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_etc_teate2            = '" . $this->inp_t_wk_etc_teate2 . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_etc_teate3))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_etc_teate3           = '" . $this->inp_t_wk_etc_teate3 . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_daytime_over_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_daytime_over_time != "") {
                    $sql .= "    t_wk_daytime_over_time           = '" . $this->inp_t_wk_daytime_over_time . "' ";
                } else {
                    $sql .= "    t_wk_daytime_over_time           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_rest_over_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_rest_over_time != "") {
                    $sql .= "    t_wk_rest_over_time           = '" . $this->inp_t_wk_rest_over_time . "' ";
                } else {
                    $sql .= "    t_wk_rest_over_time           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_midnight_over_time))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_midnight_over_time != "") {
                    $sql .= "    t_wk_midnight_over_time           = '" . $this->inp_t_wk_midnight_over_time . "' ";
                } else {
                    $sql .= "    t_wk_midnight_over_time           = null ";
                }
                $whereflg = true;
            }

            if ($this->inp_t_wk_rest_reason != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_rest_reason              = '" . $this->inp_t_wk_rest_reason . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_admin_memo))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_admin_memo            = '" . $this->inp_t_wk_admin_memo . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_run_kbn != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_run_kbn                  = '" . $this->inp_t_wk_run_kbn . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_ok_flg != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_ok_flg                   = '" . $this->inp_t_wk_ok_flg . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_update_flg != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_update_flg               = '" . $this->inp_t_wk_update_flg . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_planet_no != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_planet_no               = '" . $this->inp_t_wk_planet_no . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_kintime))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_kintime != "") {
                    $sql .= "    t_wk_kintime           = '" . $this->inp_t_wk_kintime . "' ";
                } else {
                    $sql .= "    t_wk_kintime           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_zan))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_zan != "") {
                    $sql .= "    t_wk_zan           = '" . $this->inp_t_wk_zan . "' ";
                } else {
                    $sql .= "    t_wk_zan           = null ";
                }
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_sin))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_sin != "") {
                    $sql .= "    t_wk_sin           = '" . $this->inp_t_wk_sin . "' ";
                } else {
                    $sql .= "    t_wk_sin           = null ";
                }
                $whereflg = true;
            }
            //if (!(is_null($this->inp_t_wk_renzan))) {
            //    if ($whereflg == true) {
            //        $sql .= ",";
            //    }
            //    if ($this->inp_t_wk_renzan != "") {
            //        $sql .= "    t_wk_renzan           = '" . $this->inp_t_wk_renzan . "' ";
            //    } else {
            //        $sql .= "    t_wk_renzan           = null ";
            //    }
            //    $whereflg = true;
            //}
            if (!(is_null($this->inp_t_wk_renzan))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_renzan           = '" . $this->inp_t_wk_renzan . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_stminus))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_stminus != "") {
                    $sql .= "    t_wk_stminus           = '" . $this->inp_t_wk_stminus . "' ";
                } else {
                    $sql .= "    t_wk_stminus           = null ";
                }
                $whereflg = true;
            }
            if ($this->inp_t_wk_delete_flg != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_delete_flg               = '" . $this->inp_t_wk_delete_flg . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_service_type_cd != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_service_type_cd               = '" . $this->inp_t_wk_service_type_cd . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_service_type_item_cd != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_service_type_item_cd               = '" . $this->inp_t_wk_service_type_item_cd . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_service_content != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_service_content               = '" . $this->inp_t_wk_service_content . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_created != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_created                  = '" . $this->inp_t_wk_created . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_created_staffid != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_created_staffid          = '" . $this->inp_t_wk_created_staffid . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_modified != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_modified                 = '" . $this->inp_t_wk_modified . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_modified_id != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_modified_id         = '" . $this->inp_t_wk_modified_id . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_gchk_kbn != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_gchk_kbn == "2") {
                    $sql .= "    t_wk_gchk_kbn         = null ";
                } else {
                    $sql .= "    t_wk_gchk_kbn         = '" . $this->inp_t_wk_gchk_kbn . "' ";
                }
                $whereflg = true;
            }
            //else {
            //    if ($whereflg == true) {
            //        $sql .= ",";
            //    }
            //    $sql .= "    t_wk_chk_kbn         = null ";
            //    $whereflg = true;
            //}
            if ($this->inp_t_wk_gchk_created != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_gchk_created         = '" . $this->inp_t_wk_gchk_created . "' ";
                $whereflg = true;
            }
            //else {
            //    if ($whereflg == true) {
            //        $sql .= ",";
            //    }
            //    $sql .= "    t_wk_chk_created         = null ";
            //    $whereflg = true;
            //}
            if ($this->inp_t_wk_schk_kbn != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                if ($this->inp_t_wk_schk_kbn == "2") {
                    $sql .= "    t_wk_schk_kbn         = null ";
                } else {
                    $sql .= "    t_wk_schk_kbn         = '" . $this->inp_t_wk_schk_kbn . "' ";
                }
                $whereflg = true;
            }
            if ($this->inp_t_wk_schk_created != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_schk_created         = '" . $this->inp_t_wk_schk_created . "' ";
                $whereflg = true;
            }
            if (!is_null($this->inp_t_wk_kinmu_time)) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_kinmu_time                  = '" . $this->inp_t_wk_kinmu_time . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_kintime != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_kintime                  = '" . $this->inp_t_wk_kintime . "' ";
                $whereflg = true;
            }
            if (!is_null($this->inp_t_wk_syotei_zan)) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_syotei_zan                  = '" . $this->inp_t_wk_syotei_zan . "' ";
                $whereflg = true;
            }
            if (!is_null($this->inp_t_wk_hayazan)) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_hayazan                  = '" . $this->inp_t_wk_hayazan . "' ";
                $whereflg = true;
            }
            if (!is_null($this->inp_t_wk_tuzan)) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_tuzan                  = '" . $this->inp_t_wk_tuzan . "' ";
                $whereflg = true;
            }
            if (!is_null($this->inp_t_wk_inp_kbn)) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_inp_kbn                  = '" . $this->inp_t_wk_inp_kbn . "' ";
                $whereflg = true;
            }
            if (!is_null($this->inp_t_wk_renzan_kbn)) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_renzan_kbn                  = '" . $this->inp_t_wk_renzan_kbn . "' ";
                $whereflg = true;
            }
            if (!(is_null($this->inp_t_wk_comment))) {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_comment            = '" . $this->inp_t_wk_comment . "' ";
                $whereflg = true;
            }
            $sql .= "WHERE t_wk_detail_no = " . $db->escape_string($this->inp_t_wk_detail_no) . " ";

// var_dump($sql);

//            require_once('Wklog.php');    // ログクラス

//            $wklog    = new Wklog;          // ログクラス

//            $wklog->inp_t_log_content .= $db->escape_string($sql);
//            $wklog->inp_t_log_created = date('Y-m-d H:i:s');
            // ログ 書き込み
//            $wklog->insertWklog();

            if ($this->inp_not_wright == "") {


require dirname(__FILE__).'./common/log.php';

            }

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
        public function updateWkPlanService()
        {
            $db = new Db();
            $whereflg = false;

            // MySQLへ接続する
            $db->connect();

            $sql = "UPDATE t_wk_plan_service SET ";
            if ($this->inp_t_wk_plan_service_no != "") {
                $sql .= "    t_wk_plan_service_no                 = '" . $this->inp_t_wk_plan_service_no . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_service_type_cd != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_service_type_cd            = '" . $this->inp_t_wk_plan_service_type_cd . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_service_type_item_cd != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_service_type_item_cd       = '" . $this->inp_t_wk_plan_service_type_item_cd . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_service_time != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_service_time               = '" . $this->inp_t_wk_plan_service_time . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_content != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_content                    = '" . $this->inp_t_wk_plan_content . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_service_created != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_service_created            = '" . $this->inp_t_wk_plan_service_created . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_service_created_staffid != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_service_created_staffid    = '" . $this->inp_t_wk_plan_service_created_staffid . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_service_modified != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_service_modified           = '" . $this->inp_t_wk_plan_service_modified . "' ";
                $whereflg = true;
            }
            if ($this->inp_t_wk_plan_service_modified_staffid != "") {
                if ($whereflg == true) {
                    $sql .= ",";
                }
                $sql .= "    t_wk_plan_service_modified_staffid   = '" . $this->inp_t_wk_plan_service_modified_staffid . "' ";
                $whereflg = true;
            }
            $sql .= "WHERE 0 = 0 ";

            if ($this->inp_t_wk_plan_service_no != "") {
                $sql .= "AND t_wk_plan_service_no             = " . $db->escape_string($this->inp_t_wk_plan_service_no) . " ";
            }
            /*
                        if ($this->inp_t_wk_plan_service_type_cd != "") {
                            $sql .= "AND t_wk_plan_service_type_cd        = '" . $db->escape_string($this->inp_t_wk_plan_service_type_cd) . "' ";
                        }
                        if ($this->inp_t_wk_plan_service_type_item_cd != "") {
                            $sql .= "AND t_wk_plan_service_type_item_cd   = '" . $db->escape_string($this->inp_t_wk_plan_service_type_item_cd) . "' ";
                        }
            */
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
        public function deleteWkdetail()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $ym = $db->escape_string($this->inp_t_wk_plan_date);
            if ($ym == "") {
                $sql = "DELETE FROM t_wk_detail "
                     . "WHERE 0 = 0 ";
                $sql .= "AND t_wk_detail_no = " . $db->escape_string($this->inp_t_wk_no) . " ";
            }
            if ($ym != "") {
                $sql = "DELETE FROM t_wk_detail "
                    . "WHERE DATE_FORMAT(t_wk_plan_date,'%Y%m') = $ym ";
                $sql .= "AND t_wk_genba_id = '" . $db->escape_string($this->inp_t_wk_genba_id) . "' ";
                $sql .= "AND t_wk_taiin_id = '" . $db->escape_string($this->inp_t_wk_taiin_id) . "' ";
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

        // デリート
        public function deletedetail_no()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM t_wk_detail "
                 . "WHERE ";
            $sql .= " t_wk_detail_no        = '" . $db->escape_string($this->inp_t_wk_detail_no) . "' ";

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
        public function deleteWkPlanService()
        {
            $db = new Db();

            // MySQLへ接続する
            $db->connect();

            $sql = "DELETE FROM t_wk_plan_service "
                 . "WHERE 0 = 0 ";
            $sql .= "AND t_wk_plan_service_no = " . $db->escape_string($this->inp_t_wk_no) . " ";
            if ($this->inp_t_wk_plan_service_type_cd != "") {
                $sql .= "AND t_wk_plan_service_type_cd = " . $db->escape_string($this->inp_t_wk_plan_service_type_cd) . " ";
            }
            if ($this->inp_t_wk_plan_service_type_item_cd != "") {
                $sql .= "AND t_wk_plan_service_type_item_cd = " . $db->escape_string($this->inp_t_wk_plan_service_type_item_cd) . " ";
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
