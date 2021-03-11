<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Genba.php');                  // 現場クラス
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/Wk.php');                     // シフト予定クラス
    require_once('../../models/Wkdetail.php');               // シフト予定クラス
    require_once('../../models/Shift.php');                  // シフトクラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $staff_id = null;
    $user_kana_array = array("" => "","1" => "ア","2" => "カ","3" => "サ","4" => "タ","5" => "ナ","6" => "ハ","7" => "マ","8" => "ヤ","9" => "ラ","10" => "ワ");

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $wk         = new Wk;           // シフト予定マスタクラス
    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
    $wkdetail2  = new Wkdetail;     // シフト予定マスタクラス
    $shift      = new Shift;        // シフトクラス

    $act = "";
    $nengetu = date('Ym');
    $zan = array();

    if (isset($_REQUEST['act'])) {
        $act = $_REQUEST['act'];
    }
    if (isset($_REQUEST['nengetu'])) {
        $nengetu = $_REQUEST['nengetu'];
    }
    if (isset($_REQUEST['genba_id'])) {
        $genba_id = $_REQUEST['genba_id'];
    }
    if (isset($_REQUEST['staff_id'])) {
        $staff_id = $_REQUEST['staff_id'];
    }
    if (isset($_REQUEST['user_kana'])) {
        $user_kana = $_REQUEST['user_kana'];
    }

    // 社員マスタ 取得
    $staff->getStaff();

    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
        $staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_name[$i];
    }

    $staff      = new Staff;        // 社員マスタクラス

    $staff->inp_m_staff_kana = $user_kana;

    // 社員マスタ 取得
    $staff->getStaff();

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";

    // 現場マスタ 取得
    $genba->getGenba();

    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    }

    if ($act != "") {

        // シフトの取得
        $shift->getShift();

        $shift2 = array();

        for ($i=0;$i<count($shift->oup_m_shift_no);$i++) {
            $shift2_col[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]] = $shift->oup_m_shift_color[$i];
            $shift2_rod[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]] = $shift->oup_m_shift_rodo_time[$i];
            $shift2_ovr[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]] = $shift->oup_m_shift_over_time[$i];
            $shift2_nky[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]] = $shift->oup_m_shift_nikyu[$i];
            $shift2_jky[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]] = $shift->oup_m_shift_jikyu[$i];
        }

        $wk         = new Wk;         // シフト予定マスタクラス

        // 予定の検索条件セット
        if ($genba_id != "") {
        $wk->inp_t_wk_genba_id = $genba_id;
        }
        if ($staff_id != "") {
            $wk->inp_t_wk_taiin_id = $staff_id;
        }
        $wk->inp_t_wk_nengetu  = $nengetu;

        $wk->inp_order = "order by t_wk_genba_id, t_wk_order";

        // 予定の取得
        $wk->getWk();

        // 予定詳細の検索条件セット
        if ($genba_id != "") {
        $wkdetail2->inp_t_wk_genba_id = $genba_id;
        }
        if ($staff_id != "") {
            $wkdetail2->inp_t_wk_taiin_id = $staff_id;
        }
        $wkdetail2->inp_t_wk_plan_start_date = $nengetu . "01";
        $wkdetail2->inp_t_wk_plan_end_date = date('Ymd', strtotime('last day of ' . substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)));
        $wkdetail2->inp_t_wk_detail_conf = "1";

        // シフト 取得
        $wkdetail2->getWkdetail();

        for ($i=0;$i<count($wkdetail2->oup_t_wk_detail_no);$i++) {
            $kbn[$wkdetail2->oup_t_wk_taiin_id[$i]][$wkdetail2->oup_t_wk_plan_date[$i]][$wkdetail2->oup_t_wk_genba_id[$i]] = $wkdetail2->oup_t_wk_plan_kbn[$i];
        }

        // 実績詳細の検索条件セット
        $wkdetail->inp_t_wk_genba_id = $genba_id;
        $wkdetail->inp_t_wk_plan_start_date = $nengetu . "01";
        $wkdetail->inp_t_wk_plan_end_date = date('Ymd', strtotime('last day of ' . substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)));
        if ($staff_id != "") {
            $wkdetail->inp_t_wk_taiin_id = $staff_id;
        }

        // 実績詳細 取得
        $wkdetail->getWkdetail();
//print(count($wkdetail->oup_t_wk_detail_no));
//exit;
        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            $wk_detail_no[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_detail_no[$i];
            $hosoku[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_hosoku[$i];
            $jtime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_joban_time[$i];
            $pktime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_kaban_time[$i];
            $jktime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_kaban_time[$i];
            $ken[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_kensyu[$i];
            $kbn2[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_kbn[$i];
            $jbnkbn[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_joban_kbn[$i];
            $post[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_post_teate[$i];
            $tukin[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_kotuhi[$i];

            // 所定残
            $wk00 = ($shift2_ovr[$genba_id][$wkdetail->oup_t_wk_plan_kbn[$i]])*60;
//print($shift2_ovr[9][2]);
//print("genba_id=".$genba_id);
//print("plan_kbn=".$wkdetail->oup_t_wk_plan_kbn[$i]);
//print("kbn=".$wk00);
            // 早出残
            $wk01 = 0;
            if ($wkdetail->oup_t_wk_plan_joban_time[$i] !== null && $wkdetail->oup_t_wk_joban_time[$i] !== null) {
                $plan_joban_time = new DateTime($wkdetail->oup_t_wk_plan_joban_time[$i]);
                $joban_time = new DateTime($wkdetail->oup_t_wk_joban_time[$i]);
                $interval = $plan_joban_time->diff($joban_time);
                if ($interval->invert=="0") {
                    $wk01 = 0-(substr($interval->format('%H%I'),0,2)*60+substr($interval->format('%H%I'),2,2));
                } else {
                    $wk01 = substr($interval->format('%H%I'),0,2)*60+substr($interval->format('%H%I'),2,2);
                }
            }
//print("no=".$wkdetail->oup_t_wk_detail_no[$i].",");
//print("hiduke=".$wkdetail->oup_t_wk_plan_date[$i].",");
//print("taiin=".$wkdetail->oup_t_wk_taiin_id[$i].",");
//print("hayade=".$wk01.",");
//print($wkdetail->oup_t_wk_kaban_time[$i]);
            // 通常残
            $wk02 = 0;
            if ($wkdetail->oup_t_wk_plan_kaban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                $plan_kaban_time = new DateTime($wkdetail->oup_t_wk_plan_kaban_time[$i]);
                $kaban_time = new DateTime($wkdetail->oup_t_wk_kaban_time[$i]);
                $interval = $plan_kaban_time->diff($kaban_time);
                if ($interval->invert=="0") {
                    $wk02 = substr($interval->format('%H%I'),0,2)*60+substr($interval->format('%H%I'),2,2);
                } else {
                    $wk02 = 0-(substr($interval->format('%H%I'),0,2)*60+substr($interval->format('%H%I'),2,2));
                }
            }
//print("tujo=".$wk02."<br />");

            // 昼残
            $wk1 = $wkdetail->oup_t_wk_daytime_over_time[$i];
            if ($wk1 == "") {
                $wk1 = "0";
            } else {
                $wk1 = substr($wk1,0.2)*60+substr($wk1,3.2);
            }
            // 休憩残
            $wk2 = $wkdetail->oup_t_wk_rest_over_time[$i];
            if ($wk2 == "") {
                $wk2 = 0;
            } else {
                $wk2 = substr($wk2,0.2)*60+substr($wk2,3.2);
            }
            // 深夜
            $wk3 = $wkdetail->oup_t_wk_midnight_over_time[$i];
            if ($wk3 == "") {
                $wk3 = 0;
            } else {
                $wk3 = substr($wk3,0.2)*60+substr($wk3,3.2);
            }
            $wk3=intval($wk3);
            $wk3=round($wk3/60,3);
            $wk4=intval($wk00)+intval($wk01)+intval($wk02)+intval($wk1)+intval($wk2);
            $wk4=round($wk4/60,3);
            $zan[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wk4;
            $sin[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wk3;
//            $zan[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_daytime_over_time[$i]+$wkdetail->oup_t_wk_rest_over_time[$i]+$wkdetail->oup_t_wk_midnight_over_time[$i];
//            $zan[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_daytime_over_time[$i];
//print($wkdetail->oup_t_wk_taiin_id[$i].",".$wkdetail->oup_t_wk_plan_date[$i].",".$wk."<br />");
            // 労働時間

            // 背景カラー, 労働時間, 残業時間を取得
//            $wk_shift      = new Shift;        // シフトクラス
//            $wk_shift->inp_m_shift_genba_id = $genba_id;
//            $wk_shift->inp_m_shift_plan_kbn = $wkdetail->oup_t_wk_plan_kbn[$i];
//            $wk_shift->getShift();



//            $color[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_color[0];         // 背景カラー
//            $rodo_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_rodo_time[0]; // 労働時間
//            $over_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_over_time[0]; // 残業時間

            $color[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $shift2_col[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]];         // 背景カラー
            $rodo_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $shift2_rod[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]]; // 労働時間
            $over_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $shift2_ovr[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]]; // 残業時間

        }







        if ($act == "1") {
            for ($i=0;$i<count($wk->oup_t_wk_no);$i++) {

                /*
                 * 予定
                 */
                print($genbas[$wk->oup_t_wk_genba_id[$i]]);     // 現場名
                print(",");
                print($wk->oup_t_wk_taiin_id[$i]);              // 隊員ID
                print(",");
                print($staffs[$wk->oup_t_wk_taiin_id[$i]]);     // 隊員名

                print("予定");
                print(",");

                // 1日～月末までループ
                for ($j=1;$j<=31;$j++) {

                    // 日を2桁0埋めでフォーマット
                    $day = sprintf('%02d', $j);

                    // 指定日の予定があるかどうか判定
//                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day] != "") {
//                        // 予定内容を表示
//                        print($shift->kbn[$kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]]);
//                    }

                    print(",");
                }
                print("<br />");

                /*
                 * 実績
                 */
                print($genbas[$wk->oup_t_wk_genba_id[$i]]);     // 現場名
                print(",");
                print($wk->oup_t_wk_taiin_id[$i]);              // 隊員ID
                print(",");
                print($staffs[$wk->oup_t_wk_taiin_id[$i]]);     // 隊員名

                print("実績");
                print(",");

                // 1日～月末までループ
                for ($j=1;$j<=31;$j++) {

                    // 日を2桁0埋めでフォーマット
                    $day = sprintf('%02d', $j);

                    // 下番時刻があるかどうか判定
                    if ($jktime[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day] != "") {
                        print("○");
                    }

                    print(",");



                }
                print("<br />");

                /*
                 * 残業
                 */
                print($genbas[$wk->oup_t_wk_genba_id[$i]]);     // 現場名
                print(",");
                print($wk->oup_t_wk_taiin_id[$i]);              // 隊員ID
                print(",");
                print($staffs[$wk->oup_t_wk_taiin_id[$i]]);     // 隊員名

                print("残業");
                print(",");

                // 1日～月末までループ
                for ($j=1;$j<=31;$j++) {

                    // 日を2桁0埋めでフォーマット
                    $day = sprintf('%02d', $j);

                    // 下番時刻があるかどうか判定
//print($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]);
//                    if (($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day] == "") ||
//                        ($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day] == "00:00")) {
//                    } else {
//print($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]);
//                    }

                    print(",");

                }
                print("<br />");

            }
        }




    }
//    if ($act == "2") {
    if ($act != "") {

        for ($i=0;$i<count($wk->oup_t_wk_no);$i++) {

            $taiin_id = $wk->oup_t_wk_taiin_id[$i];
            $zenkbn = "";

            $kyuyo[$taiin_id]["k0"] = $taiin_id;       // 社員コード

            // 1日～月末までループ
            for ($j=1;$j<=31;$j++) {

                $wk_kintime = "";
                $wk_zan = "";
                $wk_sin = "";
                $wk_renzan = "";
                $wk_stminus = "";

                // 日を2桁0埋めでフォーマット
                $day = sprintf('%02d', $j);

                $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;

                // 指定日の実績があるかどうか判定
                if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {

                    // ポスト手当て
                    $kyuyo[$taiin_id]["s12"] = $kyuyo[$taiin_id]["s12"] + $post[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                    // 通勤費
                    $kyuyo[$taiin_id]["s13"] = $kyuyo[$taiin_id]["s13"] + $tukin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                    // 年休
                    if ($jbnkbn[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") {

                        $kyuyo[$taiin_id]["k13"] = $kyuyo[$taiin_id]["k13"] + 1;

                        $wk_kintime = "";

                        $zenkbn = "";

                    } else {

                        $wk_kintime = $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]]+$zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                        // 時間給
                        if ($zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]<0) {

                            $kyuyo[$taiin_id]["k8"] = $kyuyo[$taiin_id]["k8"] + ($shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]]+$zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            $kyuyo[$taiin_id]["h8"] = $shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                            $kyuyo[$taiin_id]["s8"] = ceil($kyuyo[$taiin_id]["k8"]*$kyuyo[$taiin_id]["h8"]);

                            $wk_stminus = $zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                            $zenkbn = $kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                        } else {

                            // 時間外
                            if (($kyuyo[$taiin_id]["h9"] == "") || ($kyuyo[$taiin_id]["h9"] == ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25))) {
                                $kyuyo[$taiin_id]["k9"] = $kyuyo[$taiin_id]["k9"] + $zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                $kyuyo[$taiin_id]["h9"] = ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25);
                                $kyuyo[$taiin_id]["s9"] = ceil($kyuyo[$taiin_id]["k9"]*$kyuyo[$taiin_id]["h9"]);

                                $wk_zan = $wk_zan + $zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                            } else {
                                $kyuyo[$taiin_id]["k10"] = $kyuyo[$taiin_id]["k10"] + $zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                $kyuyo[$taiin_id]["h10"] = ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25);
                                $kyuyo[$taiin_id]["s10"] = ceil($kyuyo[$taiin_id]["k10"]*$kyuyo[$taiin_id]["h10"]);

                                $wk_zan = $wk_zan + $zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                            }

                            if ($kyuyo[$taiin_id]["k9"]==0) {
                                $kyuyo[$taiin_id]["k9"] = "";
                                $kyuyo[$taiin_id]["h9"] = "";
                                $kyuyo[$taiin_id]["s9"] = "";
                            }
                            if ($kyuyo[$taiin_id]["k10"]==0) {
                                $kyuyo[$taiin_id]["k10"] = "";
                                $kyuyo[$taiin_id]["h10"] = "";
                                $kyuyo[$taiin_id]["s10"] = "";
                            }

                            // 深夜
                            $kyuyo[$taiin_id]["k11"] = $kyuyo[$taiin_id]["k11"] + $sin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                            $kyuyo[$taiin_id]["h11"] = ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.5);
                            $kyuyo[$taiin_id]["s11"] = ceil($kyuyo[$taiin_id]["k11"]*$kyuyo[$taiin_id]["h11"]);

                            $wk_sin = $sin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                            if ($kyuyo[$taiin_id]["k11"]==0) {
                                $kyuyo[$taiin_id]["k11"] = "";
                                $kyuyo[$taiin_id]["h11"] = "";
                                $kyuyo[$taiin_id]["s11"] = "";
                            }

                            // 泊
                            if ($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
                                if (($kyuyo[$taiin_id]["h1"] == "") || ($kyuyo[$taiin_id]["h1"] == $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["1"])) {
                                    $kyuyo[$taiin_id]["k1"] = $kyuyo[$taiin_id]["k1"] + 1;
                                    $kyuyo[$taiin_id]["h1"] = $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["1"];
                                    $kyuyo[$taiin_id]["s1"] = $kyuyo[$taiin_id]["k1"]*$kyuyo[$taiin_id]["h1"];
                    } else {
                                    $kyuyo[$taiin_id]["k2"] = $kyuyo[$taiin_id]["k2"] + 1;
                                    $kyuyo[$taiin_id]["h2"] = $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["1"];
                                    $kyuyo[$taiin_id]["s2"] = $kyuyo[$taiin_id]["k2"]*$kyuyo[$taiin_id]["h2"];
                    }

                                // 泊→泊の場合は割り増し
                                // 夜勤→泊の場合は割り増し
                                if (($zenkbn == "1") || ($zenkbn == "3")) {
                                    if (($kyuyo[$taiin_id]["h9"] == "") || ($kyuyo[$taiin_id]["h9"] == ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25))) {
                                        $kyuyo[$taiin_id]["k9"] = $kyuyo[$taiin_id]["k9"] + $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                        // 今日の所定分が割り増し
                                        $kyuyo[$taiin_id]["h9"] = ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25);
                                        $kyuyo[$taiin_id]["s9"] = ceil($kyuyo[$taiin_id]["k9"]*$kyuyo[$taiin_id]["h9"]);

                                        $wk_renzan = $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                        $wk_zan = $wk_zan + $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];

                                    } else {
                                        $kyuyo[$taiin_id]["k10"] = $kyuyo[$taiin_id]["k10"] + $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                        $kyuyo[$taiin_id]["h10"] = ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25);
                                        $kyuyo[$taiin_id]["s10"] = ceil($kyuyo[$taiin_id]["k10"]*$kyuyo[$taiin_id]["h10"]);

                                        $wk_renzan = $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                        $wk_zan = $wk_zan + $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                    }
                                }

                                $zenkbn = "1";
                            }
                            // 夜勤
                            if ($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") {
                                if (($kyuyo[$taiin_id]["h3"] == "") || ($kyuyo[$taiin_id]["h3"] == $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["3"])) {
                                    $kyuyo[$taiin_id]["k3"] = $kyuyo[$taiin_id]["k3"] + 1;
                                    $kyuyo[$taiin_id]["h3"] = $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["3"];
                                    $kyuyo[$taiin_id]["s3"] = $kyuyo[$taiin_id]["k3"]*$kyuyo[$taiin_id]["h3"];
                                } else {
                                    $kyuyo[$taiin_id]["k4"] = $kyuyo[$taiin_id]["k4"] + 1;
                                    $kyuyo[$taiin_id]["h4"] = $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["3"];
                                    $kyuyo[$taiin_id]["s4"] = $kyuyo[$taiin_id]["k4"]*$kyuyo[$taiin_id]["h4"];
                                }
                                $zenkbn = "3";
                            }
                            // 日勤
                            if ($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") {
                                if (($kyuyo[$taiin_id]["h5"] == "") || ($kyuyo[$taiin_id]["h5"] == $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["2"])) {
                                    $kyuyo[$taiin_id]["k5"] = $kyuyo[$taiin_id]["k5"] + 1;
                                    $kyuyo[$taiin_id]["h5"] = $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["2"];
                                    $kyuyo[$taiin_id]["s5"] = $kyuyo[$taiin_id]["k5"]*$kyuyo[$taiin_id]["h5"];
                                } else if (($kyuyo[$taiin_id]["h6"] == "") || ($kyuyo[$taiin_id]["h6"] == $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["2"])) {
                                    $kyuyo[$taiin_id]["k6"] = $kyuyo[$taiin_id]["k6"] + 1;
                                    $kyuyo[$taiin_id]["h6"] = $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["2"];
                                    $kyuyo[$taiin_id]["s6"] = $kyuyo[$taiin_id]["k6"]*$kyuyo[$taiin_id]["h6"];
                                } else {
                                    $kyuyo[$taiin_id]["k7"] = $kyuyo[$taiin_id]["k7"] + 1;
                                    $kyuyo[$taiin_id]["h7"] = $shift2_nky[$wk->oup_t_wk_genba_id[$i]]["2"];
                                    $kyuyo[$taiin_id]["s7"] = $kyuyo[$taiin_id]["k7"]*$kyuyo[$taiin_id]["h7"];
                                }

                                // 泊→日の場合は割り増し
                                // 夜勤→日の場合は割り増し
                                if (($zenkbn == "1") || ($zenkbn == "3")) {
                                    if (($kyuyo[$taiin_id]["h9"] == "") || ($kyuyo[$taiin_id]["h9"] == ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25))) {
                                        $kyuyo[$taiin_id]["k9"] = $kyuyo[$taiin_id]["k9"] + $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                        // 今日の所定分が割り増し
                                        $kyuyo[$taiin_id]["h9"] = ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25);
                                        $kyuyo[$taiin_id]["s9"] = ceil($kyuyo[$taiin_id]["k9"]*$kyuyo[$taiin_id]["h9"]);

                                        $wk_renzan = $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                        $wk_zan = $wk_zan + $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];

                                    } else {
                                        $kyuyo[$taiin_id]["k10"] = $kyuyo[$taiin_id]["k10"] + $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                        $kyuyo[$taiin_id]["h10"] = ceil(($shift2_jky[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]])*1.25);
                                        $kyuyo[$taiin_id]["s10"] = ceil($kyuyo[$taiin_id]["k10"]*$kyuyo[$taiin_id]["h10"]);

                                        $wk_renzan = $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                        $wk_zan = $wk_zan + $shift2_rod[$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]];
                                    }
                }

                                $zenkbn = "2";
            }
        }
                    }

                    // 集計データ書き込み
                    $wkdetail3  = new Wkdetail;     // シフト予定マスタクラス

                    $wkdetail3->inp_t_wk_detail_no = $wk_detail_no[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];  // NO
                    $wkdetail3->inp_t_wk_kintime = $wk_kintime; // 勤務時間
                    $wkdetail3->inp_t_wk_zan = $wk_zan;         // 時間外
                    $wkdetail3->inp_t_wk_sin = $wk_sin;         // 深夜
                    $wkdetail3->inp_t_wk_renzan = $wk_renzan;   // 集計連続勤務残業
                    $wkdetail3->inp_t_wk_stminus = $wk_stminus; // 集計所定マイナス

                    $wkdetail3->updateWkdetail();


                } else {

                    $zenkbn = "";

                }
            }

        }

        print("<br />");
        print("<table border='1' align='center' style='font-size: 10pt;'>");
        print("<tr>");
        print("<td>隊員番号</td>");
        print("<td>勤怠・昼夜勤①</td>");
        print("<td>勤怠・昼夜勤②</td>");
        print("<td>勤怠・夜勤①</td>");
        print("<td>勤怠・夜勤②</td>");
        print("<td>勤怠・日勤①</td>");
        print("<td>勤怠・日勤②</td>");
        print("<td>勤怠・日勤③</td>");
        print("<td>勤怠・時間給</td>");
        print("<td>勤怠・時間外①</td>");
        print("<td>勤怠・時間外②</td>");
        print("<td>勤怠・深夜</td>");
        print("<td>勤怠・ポスト</td>");
        print("<td>勤怠・年休</td>");
        print("<td>勤怠・弁当</td>");
        print("<td>補助・昼夜勤①</td>");
        print("<td>補助・昼夜勤②</td>");
        print("<td>補助・夜勤①</td>");
        print("<td>補助・夜勤②</td>");
        print("<td>補助・日勤①</td>");
        print("<td>補助・日勤②</td>");
        print("<td>補助・日勤③</td>");
        print("<td>補助・時間給</td>");
        print("<td>補助・時間外①</td>");
        print("<td>補助・時間外②</td>");
        print("<td>補助・深夜</td>");
        print("<td>支給・昼夜勤①</td>");
        print("<td>支給・昼夜勤②</td>");
        print("<td>支給・夜勤①</td>");
        print("<td>支給・夜勤②</td>");
        print("<td>支給・日勤①</td>");
        print("<td>支給・日勤②</td>");
        print("<td>支給・日勤③</td>");
        print("<td>支給・時間給</td>");
        print("<td>支給・時間外①</td>");
        print("<td>支給・時間外②</td>");
        print("<td>支給・深夜</td>");
        print("<td>支給・ポスト手当</td>");
        print("<td>支給・通勤費</td>");
        print("<td>控除・弁当代</td>");
        print("</tr>");

        asort($kyuyo);

        foreach ($kyuyo as $key => $value) {
            print("<tr>");
            print("<td>".$key."</td>");
            print("<td>".$value["k1"]."</td>");
            print("<td>".$value["k2"]."</td>");
            print("<td>".$value["k3"]."</td>");
            print("<td>".$value["k4"]."</td>");
            print("<td>".$value["k5"]."</td>");
            print("<td>".$value["k6"]."</td>");
            print("<td>".$value["k7"]."</td>");
            print("<td>".$value["k8"]."</td>");
            print("<td>".$value["k9"]."</td>");
            print("<td>".$value["k10"]."</td>");
            print("<td>".$value["k11"]."</td>");
            print("<td>".$value["k12"]."</td>");
            print("<td>".$value["k13"]."</td>");
            print("<td>".$value["k14"]."</td>");
            print("<td>".$value["h1"]."</td>");
            print("<td>".$value["h2"]."</td>");
            print("<td>".$value["h3"]."</td>");
            print("<td>".$value["h4"]."</td>");
            print("<td>".$value["h5"]."</td>");
            print("<td>".$value["h6"]."</td>");
            print("<td>".$value["h7"]."</td>");
            print("<td>".$value["h8"]."</td>");
            print("<td>".$value["h9"]."</td>");
            print("<td>".$value["h10"]."</td>");
            print("<td>".$value["h11"]."</td>");
            print("<td>".$value["s1"]."</td>");
            print("<td>".$value["s2"]."</td>");
            print("<td>".$value["s3"]."</td>");
            print("<td>".$value["s4"]."</td>");
            print("<td>".$value["s5"]."</td>");
            print("<td>".$value["s6"]."</td>");
            print("<td>".$value["s7"]."</td>");
            print("<td>".$value["s8"]."</td>");
            print("<td>".$value["s9"]."</td>");
            print("<td>".$value["s10"]."</td>");
            print("<td>".$value["s11"]."</td>");
            print("<td>".$value["s12"]."</td>");
            print("<td>".$value["s13"]."</td>");
            print("<td>".$value["s14"]."</td>");
            print("</tr>");
    }

        print("</table>");

// var_dump($kyuyo);

/*
社員コード      k0
勤怠・昼夜勤①  k1
勤怠・昼夜勤②  k2
勤怠・夜勤①    k3
勤怠・夜勤②    k4
勤怠・日勤①    k5
勤怠・日勤②    k6
勤怠・日勤③    k7
勤怠・時間給    k8
勤怠・時間外①  k9
勤怠・時間外②  k10
勤怠・深夜      k11
勤怠・ポスト    k12
勤怠・年休      k13
勤怠・弁当      k14
補助・昼夜勤①  h1
補助・昼夜勤②  h2
補助・夜勤①    h3
補助・夜勤②    h4
補助・日勤①    h5
補助・日勤②    h6
補助・日勤③    h7
補助・時間給    h8
補助・時間外①  h9
補助・時間外②  h10
補助・深夜      h11
支給・昼夜勤①  s1
支給・昼夜勤②  s2
支給・夜勤①    s3
支給・夜勤②    s4
支給・日勤①    s5
支給・日勤②    s6
支給・日勤③    s7
支給・時間給    s8
支給・時間外①  s9
支給・時間外②  s10
支給・深夜      s11
支給・ポスト手当
支給・通勤費
控除・弁当代
*/

    }


    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // HTML表示
    require_once('../../views/kanri/kinmusyukei_html.php');
?>
