<?php
// http://www.wincloud.jp/sks-kobe_t/controllers/upd_time.php

set_time_limit(120);

    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/Wkdetail.php');               // 作業クラス
    require_once('../models/Shift.php');                  // シフトクラス

    $common     = new Common;       // 共通クラス
    $work       = new Wkdetail;     // 作業クラス

    $work->inp_t_wk_plan_start_date   = "20200621";
    $work->inp_t_wk_plan_end_date   = "20200630";
    $work->inp_t_wk_del_flg     = "0";
    $work->inp_order = "ORDER BY  t_wk_genba_id,t_wk_plan_kbn, t_wk_plan_joban_time, t_wk_taiin_id  ";

    // 作業テーブル 取得
    $work->getWkdetail();


    for ($i=0;$i<count($work->oup_t_wk_detail_no);$i++) { 

        $work2      = new Wkdetail;     // 作業クラス
        $work3      = new Wkdetail;     // 作業クラス
        $shift      = new Shift;        // シフトクラス

        $shift->inp_m_shift_no = $work->oup_t_wk_shift_no[$i];
        $shift->getShift();

        $work2->inp_shift_ktime = $shift->oup_m_shift_kyukei_time[0]; // 休憩
        $work2->inp_shift_otime = $shift->oup_m_shift_over_time[0]; // 所定残
        $work2->inp_shift_rtime = $shift->oup_m_shift_rodo_time[0]; // 労働時間
        $work2->inp_joban_kbn = $work->oup_t_wk_joban_kbn[$i];
        $work2->inp_plan_kbn = $work->oup_t_wk_plan_kbn[$i];
        $work2->inp_plan_joban_time = $work->oup_t_wk_plan_joban_time[$i];
        $work2->inp_plan_kaban_time = $work->oup_t_wk_plan_kaban_time[$i];
        $work2->inp_joban_time = $work->oup_t_wk_joban_time[$i];
        $work2->inp_kaban_time = $work->oup_t_wk_kaban_time[$i];
        $work2->getcalckintime();

        $work3->inp_t_wk_detail_no = $work->oup_t_wk_detail_no[$i];
        $work3->inp_t_wk_kinmu_time = $work2->kinmu_time;
        $work3->inp_t_wk_syotei_zan = $work2->syotei_otime;
        $work3->inp_t_wk_hayazan = $work2->hayazan_time;
        $work3->inp_t_wk_tuzan = $work2->tuzan_time;

        $work3->updateWkdetail();

//        print($work->oup_t_wk_detail_no[$i]);
//        print(",");

        print("社員番号=");
        print($work->oup_t_wk_taiin_id[$i]);
        print(",");
        print("日付=");
        print($work->oup_t_wk_plan_date[$i]);
        print(",");
        print("休憩=");
        print($shift->oup_m_shift_kyukei_time[0]);
        print(",");
        print("所定残=");
        print($shift->oup_m_shift_over_time[0]);
        print(",");
        print("労働時間=");
        print($shift->oup_m_shift_rodo_time[0]);
        print(",");
        print("上番区分=");
        print($work->oup_t_wk_joban_kbn[$i]);
        print(",");
        print("勤務区分=");
        print($work->oup_t_wk_plan_kbn[$i]);
        print(",");
        print("上番予定=");
        print($work->oup_t_wk_plan_joban_time[$i]);
        print(",");
        print("下番予定=");
        print($work->oup_t_wk_plan_kaban_time[$i]);
        print(",");
        print("上番実績=");
        print($work->oup_t_wk_joban_time[$i]);
        print(",");
        print("下番実績=");
        print($work->oup_t_wk_kaban_time[$i]);
        print(" → ");
        print("勤務時間=");
        if (substr($shift->oup_m_shift_rodo_time[0],0,2)*60+substr($shift->oup_m_shift_rodo_time[0],3,2)*60 != $work2->kinmu_time) { print("<font color='red'>"); }
        print($work2->kinmu_time);
        if (substr($shift->oup_m_shift_rodo_time[0],0,2)*60+substr($shift->oup_m_shift_rodo_time[0],3,2)*60 != $work2->kinmu_time) { print("</font>"); }
        print(",");
        print("所定残=");
        print($work2->syotei_otime);
        print(",");
        print("早残=");
        print($work2->hayazan_time);
        print(",");
        print("通残=");
        print($work2->tuzan_time);
        print(",");
        print("<br />");
    }

?>
