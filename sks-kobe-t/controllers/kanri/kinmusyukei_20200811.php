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
    require_once('../../models/Cooperation.php');                  // 協力会社クラス
    require_once('../../models/Teate.php');                  // 手当てクラス
    require_once('../../models/Holiday.php');                // 祝日マスタクラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $staff_id = null;
    $user_kana_array = array("" => "","1" => "ア","2" => "カ","3" => "サ","4" => "タ","5" => "ナ","6" => "ハ","7" => "マ","8" => "ヤ","9" => "ラ","10" => "ワ");
    $start = date('Ym01', strtotime('-1 month'));
    $end = date('Ym01', strtotime('+1 month'));
    
    if (isset($_REQUEST['flg'])) {
        $flg = $_REQUEST['flg'];
        $_SESSION['flg'] = $_REQUEST['flg'];
    } else {
        $flg = $_SESSION['flg'];
    }

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
    $company      = new Cooperation;        // 協力会社マスタクラス
    $teate      = new Teate;        // 手当てマスタクラス
    $holiday    = new Holiday;      // 祝日マスタクラス

    $act = "";
    $nengetu = date('Ym', strtotime('-1 month'));;
    $zan = array();
    
    // 手当てマスタ 取得
    $teate->getTeate();
    
    // 協力会社マスタ 取得 に必要な情報をセット
    $company->inp_m_company_del_flg = "0";
    // 協力会社マスタ 取得
    $company->getCompany();
    
    //協力会社
    if (isset($_REQUEST['company_id'])) {
        $company_id = $_REQUEST['company_id'];
    }

    //年月
    if (isset($_REQUEST['nengetu'])) {
        $nengetu = $_REQUEST['nengetu'];
    } else {
//        $nengetu = date('Ym', strtotime('+1 day'));
//        ;
    }
    
    // 検索月の祝日を取得
    $holiday->inp_holiday_nengetu = $nengetu;
    $holiday->getHoliday();
    for ($i=0;$i<count($holiday->oup_date);$i++) {
        if ($i==0) {
            $wk_holiday = substr($holiday->oup_date[$i],8,2);
        } else {
            $wk_holiday = $wk_holiday.",".substr($holiday->oup_date[$i],8,2);
        }
    }

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

    if ($act == "2") {
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=kyuyo".$nengetu.".csv");
    }

    // 社員マスタ 取得
    $staff->getStaff();

    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
        $staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_name[$i];
        $staffkbns[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_kbn[$i];
        $staffgenbas[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_genba_id[$i];


        // 時間給は隊員の現場の時給を取得する

        $wk_shift      = new Shift;        // シフトクラス

        $wk_shift->inp_m_shift_genba_id = $staff->oup_m_staff_genba_id[$i];
        $wk_shift->inp_m_shift_plan_kbn2 = "1,2,3";

        $wk_shift->getShift();

        $jikyu[$staff->oup_m_staff_id[$i]]     = $wk_shift->oup_m_shift_jikyu[0];

    }

    $staff      = new Staff;        // 社員マスタクラス

    $staff->inp_m_staff_kana = $user_kana;
    //退職者はプルダウンに表示しない
    $staff->inp_m_staff_taisyaday = $nengetu."01";

    // 社員マスタ 取得
    $staff->getStaff();
    
    $genba2 = new Genba;;
    // 現場マスタ 取得 に必要な情報をセット
    $genba2->inp_m_genba_del_flg = "0";
    $genba2->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";
    
    //使用終了日以降は非表示
    $genba2->inp_m_genba_deleteday = $nengetu."01";

    // 現場マスタ 取得
    $genba2->getGenba();

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";
    $genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

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
            $shift2_col[$shift->oup_m_shift_no[$i]] = $shift->oup_m_shift_color[$i];
            $shift2_rod[$shift->oup_m_shift_no[$i]] = $shift->oup_m_shift_rodo_time[$i];
            $shift2_ovr[$shift->oup_m_shift_no[$i]] = $shift->oup_m_shift_over_time[$i];
            $shift2_nky[$shift->oup_m_shift_no[$i]] = $shift->oup_m_shift_nikyu[$i];
            $shift2_jky[$shift->oup_m_shift_no[$i]] = $shift->oup_m_shift_jikyu[$i];
        }

        $wk         = new Wk;         // シフト予定マスタクラス

        // 予定の検索条件セット
        if ($genba_id != "") {
            $wk->inp_t_wk_genba_id = $genba_id;
        }
        if ($staff_id != "") {
            $wk->inp_t_wk_taiin_id = $staff_id;
        }
        if ($company_id != "") {
            $wk->inp_join_m_staff = 1;
            $wk->inp_m_company_id = $company_id;
        }
        $wk->inp_t_wk_nengetu  = $nengetu;

        if ($act=="2") {
            $wk->inp_order = "order by t_wk_taiin_id";
        } else {
            $wk->inp_order = "order by t_wk_genba_id, t_wk_order";
        }

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

        // 予定詳細 取得
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

        $wk_detail_no = array();
        $hosoku = array();
        $pjtime = array();
        $jtime = array();
        $pktime = array();
        $jktime = array();
        $kintime = array();
        $jikyuflg = array();

        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            $wk_detail_no[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_detail_no[$i];
            $hosoku[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_hosoku[$i];
            $pjtime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_joban_time[$i];
            $jtime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_joban_time[$i];
            $pktime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_kaban_time[$i];
            $jktime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_kaban_time[$i];
            $kintime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = ($wkdetail->oup_t_wk_kinmu_time[$i]/60);

            /*
             * 時給判定用の区分
             */

            $wkpjt = $wkdetail->oup_t_wk_plan_joban_time[$i];
            $wkpjt = substr($wkpjt,0,2)*60 + substr($wkpjt,3,2);
            $wkjt = $wkdetail->oup_t_wk_joban_time[$i];
            $wkjt = substr($wkjt,0,2)*60 + substr($wkjt,3,2);

            $wkpkt = $wkdetail->oup_t_wk_plan_kaban_time[$i];
            $wkpkt = substr($wkpkt,0,2)*60 + substr($wkpkt,3,2);
            $wkkt = $wkdetail->oup_t_wk_kaban_time[$i];
            $wkkt = substr($wkkt,0,2)*60 + substr($wkkt,3,2);

            if (($wkdetail->oup_t_wk_plan_kbn[$i]=="1") || ($wkdetail->oup_t_wk_plan_kbn[$i]=="3")) {
                $wk1 = (1440 + $wkpkt) - $wkpjt;
                $wk2 = (1440 + $wkkt) - $wkjt;
            } else {
                $wk1 = $wkpkt - $wkpjt;
                $wk2 = $wkkt - $wkjt;
            }

            // 予定より実績がマイナス
            if ($wk1>$wk2) {
                // 所定時間より実績がマイナス
                if (($shift2_rod[$wkdetail->oup_t_wk_shift_no[$i]]*60)>$wkdetail->oup_t_wk_kinmu_time[$i]) {
                    $jikyuflg[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = "1";
                }
            }

            $ken[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_kensyu[$i];
            $kbn2[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_plan_kbn[$i];
            $kbn3[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_kaban_kbn[$i];
            $jbnkbn[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_joban_kbn[$i];
            $post[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_post_teate[$i];
            $tukin[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_kotuhi[$i];
            $shogatu[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_shogatu_teate[$i];
            $kaki[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_kaki_teate[$i];
            $teate1[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_etc_teate1[$i];
            $teate2[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_etc_teate2[$i];
            $teate3[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_etc_teate3[$i];

            // 所定残
            $wk00 = 0;
            $wk00 = $wkdetail->oup_t_wk_syotei_zan[$i];

            // 早出残
            $wk01 = 0;
            $wk01 = $wkdetail->oup_t_wk_hayazan[$i];

            // 通常残
            $wk02 = 0;
            $wk02 = $wkdetail->oup_t_wk_tuzan[$i];

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

//            $color[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_date[$i]]     = $shift2_col[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]]; // 背景カラー
            $rodo_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $shift2_rod[$wkdetail->oup_t_wk_shift_no[$i]]; // 労働時間
//            $over_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $shift2_ovr[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]]; // 残業時間
            $nikyu[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_date[$i]]     = $shift2_nky[$wkdetail->oup_t_wk_shift_no[$i]];

//            $jikyu[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_date[$i]]     = $shift2_jky[$wkdetail->oup_t_wk_shift_no[$i]];


        }

// var_dump($jikyuflg);





        if ($act == "99") {
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

                    print(",");

                }
                print("<br />");

            }
        }
    }

    // 連勤残計算
    if ($act == "1") {

        $wkdetail   = new Wkdetail;     // シフト予定マスタクラス

        // 前月末～当月末まで
        $wkdetail->inp_t_wk_plan_start_date = date('Ymd', mktime(0, 0, 0, substr($nengetu, 4, 2), 0, substr($nengetu, 0, 4)));
        $wkdetail->inp_t_wk_plan_end_date = date('Ymd', strtotime('last day of ' . substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)));
        $wkdetail->inp_order = "ORDER BY t_wk_taiin_id,t_wk_plan_date,t_wk_plan_joban_time";

        // 実績詳細 取得
        $wkdetail->getWkdetail();

        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {

            if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$i]]=="4") {
//            } else if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$i]]=="1") {
            } else if ($wkdetail->oup_t_wk_taiin_id[$i]=="JPN01") {
            } else if ($wkdetail->oup_t_wk_taiin_id[$i]=="JPN02") {
            } else if ($wkdetail->oup_t_wk_taiin_id[$i]=="1") {
            } else if ($wkdetail->oup_t_wk_taiin_id[$i]=="2") {
            } else {

                if ($i == 0) {

                    $old_taiin_id = $wkdetail->oup_t_wk_taiin_id[$i];

                } else {

                    $taiin_id = $wkdetail->oup_t_wk_taiin_id[$i];
                    $zenkbn = "";
                    $wk_renzan = "";

                    // 人が変わったらクリア
                    if ($taiin_id == $old_taiin_id) {

                        // 指定日の実績があるかどうか判定
                        if ($wkdetail->oup_t_wk_kaban_kbn[$i] != "") {
//print($wkdetail->oup_t_wk_plan_date[$i-1]);
//print(" ");
//print(date('Y/m/d', strtotime('-1 day', strtotime($wkdetail->oup_t_wk_plan_date[$i]))));
//print("<br />");
                            // 前日の予定があって
                            if ($wkdetail->oup_t_wk_plan_date[$i-1] == date('Y-m-d', strtotime('-1 day', strtotime($wkdetail->oup_t_wk_plan_date[$i])))) {
//print("前日予定あり<br />");
                                // 泊→泊の場合は割り増し
                                if (($wkdetail->oup_t_wk_plan_kbn[$i-1] == "1") && ($wkdetail->oup_t_wk_plan_kbn[$i] == "1")) {
//print("泊→泊 割りまし<br />");
                                    $wk_renzan = $rodo_time[$taiin_id][$wkdetail->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]]][$wkdetail->oup_t_wk_plan_date[$i]];
                                }
                                // 夜勤→泊の場合は割り増し
                                if (($wkdetail->oup_t_wk_plan_kbn[$i-1] == "3") && ($wkdetail->oup_t_wk_plan_kbn[$i] == "1")) {
//print("夜勤→泊 割りまし<br />");
                                    $wk_renzan = $rodo_time[$taiin_id][$wkdetail->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]]][$wkdetail->oup_t_wk_plan_date[$i]];
                                }
                                // 泊→日の場合は割り増し
                                if (($wkdetail->oup_t_wk_plan_kbn[$i-1] == "1") && ($wkdetail->oup_t_wk_plan_kbn[$i] == "2")) {
//print("泊→日 割りまし<br />");
                                    $wk_renzan = $rodo_time[$taiin_id][$wkdetail->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]]][$wkdetail->oup_t_wk_plan_date[$i]];
                                }
                                // 夜勤→日の場合は割り増し
                                if (($wkdetail->oup_t_wk_plan_kbn[$i-1] == "3") && ($wkdetail->oup_t_wk_plan_kbn[$i] == "2")) {
//print("夜勤→日 割りまし<br />");
                                    $wk_renzan = $rodo_time[$taiin_id][$wkdetail->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]]][$wkdetail->oup_t_wk_plan_date[$i]];
                                }
                            }
                        }
                    }

                    $old_taiin_id = $wkdetail->oup_t_wk_taiin_id[$i];

                        // 集計データ書き込み
                        $wkdetail3  = new Wkdetail;     // シフト予定マスタクラス

                        $wkdetail3->inp_t_wk_detail_no = $wkdetail->oup_t_wk_detail_no[$i];  // NO
                        $wkdetail3->inp_t_wk_renzan = $wk_renzan;   // 集計連続勤務残業

                        $wkdetail3->updateWkdetail();
/*
print($wkdetail->oup_t_wk_detail_no[$i]);
print(" ");
print($wkdetail->oup_t_wk_genba_id[$i]);
print(" ");
print($wkdetail->oup_t_wk_taiin_id[$i]);
print("<br />");
*/
                }
            }

        }

            // アラート
            $alert = "<script type='text/javascript'>alert('集計処理を行いました');</script>";
            echo $alert;

    }


//    if (($act == "1") || ($act == "2")) {
    if ($act == "2") {

        for ($i=0;$i<count($wk->oup_t_wk_no);$i++) {

            if ($staffkbns[$wk->oup_t_wk_taiin_id[$i]]=="4") {
            } else if ($staffkbns[$wk->oup_t_wk_taiin_id[$i]]=="1") {
            } else if ($wk->oup_t_wk_taiin_id[$i]=="JPN01") {
            } else if ($wk->oup_t_wk_taiin_id[$i]=="JPN02") {
            } else if ($wk->oup_t_wk_taiin_id[$i]=="1") {
            } else if ($wk->oup_t_wk_taiin_id[$i]=="2") {
            } else {

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
                    if (($post[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]=="")||(($post[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]==0))) {
                    } else {
                        $kyuyo[$taiin_id]["k12"] = $kyuyo[$taiin_id]["k12"]+6;
                    }

                    // 通勤費
                    $kyuyo[$taiin_id]["s13"] = $kyuyo[$taiin_id]["s13"] + $tukin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                    $kyuyo[$taiin_id]["s15"] = $kyuyo[$taiin_id]["s15"] + $shogatu[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                    $kyuyo[$taiin_id]["s16"] = $kyuyo[$taiin_id]["s16"] + $kaki[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                    $kyuyo[$taiin_id]["s17"] = $kyuyo[$taiin_id]["s17"] + $teate1[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                    $kyuyo[$taiin_id]["s18"] = $kyuyo[$taiin_id]["s18"] + $teate2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                    $kyuyo[$taiin_id]["s19"] = $kyuyo[$taiin_id]["s19"] + $teate3[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                    // 年休
                    if (($jbnkbn[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") || ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4")) {

                        $kyuyo[$taiin_id]["k13"] = $kyuyo[$taiin_id]["k13"] + 1;

                        $wk_kintime = "";

                        $zenkbn = "";

                    } else {

                        $wk_kintime = $rodo_time[$taiin_id][$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]][$nengetuwk]+$zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                        // 時間給
                        if ($jikyuflg[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {

                            $kyuyo[$taiin_id]["k8"] = $kyuyo[$taiin_id]["k8"] + $kintime[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                            $kyuyo[$taiin_id]["h8"] = $jikyu[$taiin_id];
                            $kyuyo[$taiin_id]["s8"] = ceil($kyuyo[$taiin_id]["k8"]*$kyuyo[$taiin_id]["h8"]);

                            $wk_stminus = $zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                            $zenkbn = $kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                        } else {

                            // 時間外
                                $kyuyo[$taiin_id]["k9"] = $kyuyo[$taiin_id]["k9"] + $zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                $kyuyo[$taiin_id]["h9"] = ceil(($jikyu[$taiin_id])*1.25);
                                $kyuyo[$taiin_id]["s9"] = ceil($kyuyo[$taiin_id]["k9"]*$kyuyo[$taiin_id]["h9"]);

                                $wk_zan = $wk_zan + $zan[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];


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
                            $kyuyo[$taiin_id]["h11"] = ceil(($jikyu[$taiin_id])*0.25);
                            $kyuyo[$taiin_id]["s11"] = ceil($kyuyo[$taiin_id]["k11"]*$kyuyo[$taiin_id]["h11"]);

                            $wk_sin = $sin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                            if ($kyuyo[$taiin_id]["k11"]==0) {
                                $kyuyo[$taiin_id]["k11"] = "";
                                $kyuyo[$taiin_id]["h11"] = "";
                                $kyuyo[$taiin_id]["s11"] = "";
                            }

                            // 泊
                            if (($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") && ($kintime[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]!="0")) {
                                if (($kyuyo[$taiin_id]["h1"] == "") || ($kyuyo[$taiin_id]["h1"] == $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["1"][$nengetuwk])) {
                                    $kyuyo[$taiin_id]["k1"] = $kyuyo[$taiin_id]["k1"] + 1;
                                    $kyuyo[$taiin_id]["h1"] = $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["1"][$nengetuwk];
                                    $kyuyo[$taiin_id]["s1"] = $kyuyo[$taiin_id]["k1"]*$kyuyo[$taiin_id]["h1"];
                                } else {
                                    $kyuyo[$taiin_id]["k2"] = $kyuyo[$taiin_id]["k2"] + 1;
                                    $kyuyo[$taiin_id]["h2"] = $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["1"][$nengetuwk];
                                    $kyuyo[$taiin_id]["s2"] = $kyuyo[$taiin_id]["k2"]*$kyuyo[$taiin_id]["h2"];
                                }

                                // 泊→泊の場合は割り増し
                                // 夜勤→泊の場合は割り増し
                                if (($zenkbn == "1") || ($zenkbn == "3")) {
                                        $kyuyo[$taiin_id]["k10"] = $kyuyo[$taiin_id]["k10"] + $rodo_time[$taiin_id][$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]][$nengetuwk];
                                        $kyuyo[$taiin_id]["h10"] = ceil(($jikyu[$taiin_id])*0.25);
                                        $kyuyo[$taiin_id]["s10"] = ceil($kyuyo[$taiin_id]["k10"]*$kyuyo[$taiin_id]["h10"]);

                                        $wk_renzan = $rodo_time[$taiin_id][$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]][$nengetuwk];
                                }

                                $zenkbn = "1";
                            }
                            // 夜勤
                            if (($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") && ($kintime[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]!="0")) {
                                if (($kyuyo[$taiin_id]["h3"] == "") || ($kyuyo[$taiin_id]["h3"] == $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["3"][$nengetuwk])) {
                                    $kyuyo[$taiin_id]["k3"] = $kyuyo[$taiin_id]["k3"] + 1;
                                    $kyuyo[$taiin_id]["h3"] = $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["3"][$nengetuwk];
                                    $kyuyo[$taiin_id]["s3"] = $kyuyo[$taiin_id]["k3"]*$kyuyo[$taiin_id]["h3"];
                                } else {
                                    $kyuyo[$taiin_id]["k4"] = $kyuyo[$taiin_id]["k4"] + 1;
                                    $kyuyo[$taiin_id]["h4"] = $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["3"][$nengetuwk];
                                    $kyuyo[$taiin_id]["s4"] = $kyuyo[$taiin_id]["k4"]*$kyuyo[$taiin_id]["h4"];
                                }
                                $zenkbn = "3";
                            }
                            // 日勤
                            if (($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") && ($kintime[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]!="0")) {
                                if (($kyuyo[$taiin_id]["h5"] == "") || ($kyuyo[$taiin_id]["h5"] == $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["2"][$nengetuwk])) {
                                    $kyuyo[$taiin_id]["k5"] = $kyuyo[$taiin_id]["k5"] + 1;
                                    $kyuyo[$taiin_id]["h5"] = $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["2"][$nengetuwk];
                                    $kyuyo[$taiin_id]["s5"] = $kyuyo[$taiin_id]["k5"]*$kyuyo[$taiin_id]["h5"];
                                } else if (($kyuyo[$taiin_id]["h6"] == "") || ($kyuyo[$taiin_id]["h6"] == $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["2"][$nengetuwk])) {
                                    $kyuyo[$taiin_id]["k6"] = $kyuyo[$taiin_id]["k6"] + 1;
                                    $kyuyo[$taiin_id]["h6"] = $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["2"][$nengetuwk];
                                    $kyuyo[$taiin_id]["s6"] = $kyuyo[$taiin_id]["k6"]*$kyuyo[$taiin_id]["h6"];
                                } else {
                                    $kyuyo[$taiin_id]["k7"] = $kyuyo[$taiin_id]["k7"] + 1;
                                    $kyuyo[$taiin_id]["h7"] = $nikyu[$taiin_id][$wk->oup_t_wk_genba_id[$i]]["2"][$nengetuwk];
                                    $kyuyo[$taiin_id]["s7"] = $kyuyo[$taiin_id]["k7"]*$kyuyo[$taiin_id]["h7"];
                                }

                                // 泊→日の場合は割り増し
                                // 夜勤→日の場合は割り増し
                                if (($zenkbn == "1") || ($zenkbn == "3")) {
                                        $kyuyo[$taiin_id]["k10"] = $kyuyo[$taiin_id]["k10"] + $rodo_time[$taiin_id][$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]][$nengetuwk];
                                        $kyuyo[$taiin_id]["h10"] = ceil(($jikyu[$taiin_id])*0.25);
                                        $kyuyo[$taiin_id]["s10"] = ceil($kyuyo[$taiin_id]["k10"]*$kyuyo[$taiin_id]["h10"]);

                                        $wk_renzan = $rodo_time[$taiin_id][$wk->oup_t_wk_genba_id[$i]][$kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]][$nengetuwk];
                                }

                                $zenkbn = "2";
                            }
                        }
                    }

                    if ($act == "1") {
                        // 集計データ書き込み
                        $wkdetail3  = new Wkdetail;     // シフト予定マスタクラス

                        $wkdetail3->inp_t_wk_detail_no = $wk_detail_no[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];  // NO
                        $wkdetail3->inp_t_wk_renzan = $wk_renzan;   // 集計連続勤務残業
                        $wkdetail3->inp_t_wk_stminus = $wk_stminus; // 集計所定マイナス

                        $wkdetail3->updateWkdetail();
                    }

                } else {

                    $zenkbn = "";

                }
            }

            }
        }

        if ($act == "2") {
/*
            print("<br />");
            print("<table border='1' align='center' style='font-size: 10pt;'>");
            print("<tr>");
            print("<td>社員コード</td>");
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
*/
            ob_end_clean();
            $csv  = "\"社員コード\",\"氏名\",\"勤怠・昼夜勤①\",\"勤怠・昼夜勤②\",\"勤怠・夜勤①\",\"勤怠・夜勤②\",\"勤怠・日勤①\",\"勤怠・日勤②\",\"勤怠・日勤③\",\"勤怠・時間給\",";
            $csv .= "\"勤怠・時間外①\",\"勤怠・時間外②\",\"勤怠・深夜\",\"勤怠・ポスト\",\"勤怠・年休\",\"勤怠・弁当\",\"補助・昼夜勤①\",\"補助・昼夜勤②\",\"補助・夜勤①\",";
            $csv .= "\"補助・夜勤②\",\"補助・日勤①\",\"補助・日勤②\",\"補助・日勤③\",\"補助・時間給\",\"補助・時間外①\",\"補助・時間外②\",\"補助・深夜\",\"支給・昼夜勤①\",";
            $csv .= "\"支給・昼夜勤②\",\"支給・夜勤①\",\"支給・夜勤②\",\"支給・日勤①\",\"支給・日勤②\",\"支給・日勤③\",\"支給・時間給\",\"支給・時間外①\",\"支給・時間外②\",";
            $csv .= "\"支給・深夜\",\"支給・ポスト手当\",\"支給・通勤費\",\"控除・弁当代\",\"".$teate->oup_m_teate_name[0]."\",\"".$teate->oup_m_teate_name[1]."\",\"".$teate->oup_m_teate_name[2]."\",\"".$teate->oup_m_teate_name[3]."\",\"".$teate->oup_m_teate_name[4]."\"";
            $csv .= "\r\n";


//            asort($kyuyo);

            foreach ($kyuyo as $key => $value) {

                // 通勤費 3万円まで
                if ($value["s13"] > 30000) {
                    $value["s13"] = 30000;
                }

/*
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
                print("<td>".$value["s15"]."</td>");
                print("<td>".$value["s16"]."</td>");
                print("<td>".$value["s17"]."</td>");
                print("<td>".$value["s18"]."</td>");
                print("<td>".$value["s19"]."</td>");
                print("</tr>");
*/

if ($value["k1"]=="") { $value["k1"]=0; }
if ($value["k2"]=="") { $value["k2"]=0; }
if ($value["k3"]=="") { $value["k3"]=0; }
if ($value["k4"]=="") { $value["k4"]=0; }
if ($value["k5"]=="") { $value["k5"]=0; }
if ($value["k6"]=="") { $value["k6"]=0; }
if ($value["k7"]=="") { $value["k7"]=0; }
if ($value["k8"]=="") { $value["k8"]=0; }
if ($value["k9"]=="") { $value["k9"]=0; }
if ($value["k10"]=="") { $value["k10"]=0; }
if ($value["k11"]=="") { $value["k11"]=0; }
if ($value["k12"]=="") { $value["k12"]=0; }
if ($value["k13"]=="") { $value["k13"]=0; }
if ($value["k14"]=="") { $value["k14"]=0; }
if ($value["h1"]=="") { $value["h1"]=0; }
if ($value["h2"]=="") { $value["h2"]=0; }
if ($value["h3"]=="") { $value["h3"]=0; }
if ($value["h4"]=="") { $value["h4"]=0; }
if ($value["h5"]=="") { $value["h5"]=0; }
if ($value["h6"]=="") { $value["h6"]=0; }
if ($value["h7"]=="") { $value["h7"]=0; }
if ($value["h8"]=="") { $value["h8"]=0; }
if ($value["h9"]=="") { $value["h9"]=0; }
if ($value["h10"]=="") { $value["h10"]=0; }
if ($value["h11"]=="") { $value["h11"]=0; }
if ($value["s1"]=="") { $value["s1"]=0; }
if ($value["s2"]=="") { $value["s2"]=0; }
if ($value["s3"]=="") { $value["s3"]=0; }
if ($value["s4"]=="") { $value["s4"]=0; }
if ($value["s5"]=="") { $value["s5"]=0; }
if ($value["s6"]=="") { $value["s6"]=0; }
if ($value["s7"]=="") { $value["s7"]=0; }
if ($value["s8"]=="") { $value["s8"]=0; }
if ($value["s9"]=="") { $value["s9"]=0; }
if ($value["s10"]=="") { $value["s10"]=0; }
if ($value["s11"]=="") { $value["s11"]=0; }
if ($value["s12"]=="") { $value["s12"]=0; }
if ($value["s13"]=="") { $value["s13"]=0; }
if ($value["s14"]=="") { $value["s14"]=0; }
if ($value["s15"]=="") { $value["s15"]=0; }
if ($value["s16"]=="") { $value["s16"]=0; }
if ($value["s17"]=="") { $value["s17"]=0; }
if ($value["s18"]=="") { $value["s18"]=0; }
if ($value["s19"]=="") { $value["s19"]=0; }


            $csv .= "\"".$key."\",\"".$staffs[$key]."\",\"".$value["k1"]."\",\"".$value["k2"]."\",\"".$value["k3"]."\",\"".$value["k4"]."\",\"".$value["k5"]."\",\"".$value["k6"]."\",";
            $csv .= "\"".$value["k7"]."\",\"".$value["k8"]."\",\"".$value["k9"]."\",\"".$value["k10"]."\",\"".$value["k11"]."\",\"".$value["k12"]."\",";
            $csv .= "\"".$value["k13"]."\",\"".$value["k14"]."\",\"".$value["h1"]."\",\"".$value["h2"]."\",\"".$value["h3"]."\",\"".$value["h4"]."\",";
            $csv .= "\"".$value["h5"]."\",\"".$value["h6"]."\",\"".$value["h7"]."\",\"".$value["h8"]."\",\"".$value["h9"]."\",\"".$value["h10"]."\",";
            $csv .= "\"".$value["h11"]."\",\"".$value["s1"]."\",\"".$value["s2"]."\",\"".$value["s3"]."\",\"".$value["s4"]."\",\"".$value["s5"]."\",";
            $csv .= "\"".$value["s6"]."\",\"".$value["s7"]."\",\"".$value["s8"]."\",\"".$value["s9"]."\",\"".$value["s10"]."\",\"".$value["s11"]."\",";
            $csv .= "\"".$value["s12"]."\",\"".$value["s13"]."\",\"".$value["s14"]."\",\"".$value["s15"]."\",\"".$value["s16"]."\",\"".$value["s17"]."\",";
            $csv .= "\"".$value["s18"]."\",\"".$value["s19"]."\"";
            $csv .= "\r\n";

            }

            $csv = mb_convert_encoding($csv,"SJIS-win","UTF-8");
            print($csv);
            exit;


        }

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
