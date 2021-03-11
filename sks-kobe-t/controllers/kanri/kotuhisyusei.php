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
    require_once('../../models/Kotuhi.php');                 // 交通費クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $staff_id = null;
    $user_kana_array = array("" => "","1" => "ア","2" => "カ","3" => "サ","4" => "タ","5" => "ナ","6" => "ハ","7" => "マ","8" => "ヤ","9" => "ラ","10" => "ワ");
    $start = date('Ym01', strtotime('-1 month'));
    $end = date('Ym01', strtotime('+1 month'));

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
    $kotuhi     = new Kotuhi;       // 交通費マスタクラス

    $act = "1";
//    $nengetu = date('Ym', strtotime('-1 month'));
    $nengetu = date('Ym');
    $zan = array();

    //年月
//    if (isset($_REQUEST['nengetu'])) {
//        $nengetu = $_REQUEST['nengetu'];
//    } else {
//        $nengetu = date('Ym', strtotime('+1 day'));
//        ;
//    }
    
    if (isset($_REQUEST['act'])) {
        $act = $_REQUEST['act'];
    }
//    if (isset($_REQUEST['nengetu'])) {
//        $nengetu = $_REQUEST['nengetu'];
//    }
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

        // 交通費マスタ 取得 に必要な情報をセット
        $kotuhi->inp_m_kotuhi_startday = date('Y-m-d');

        // 交通費マスタ 取得
        $kotuhi->getKotuhi();

        for ($i=0;$i<count($kotuhi->oup_m_kotuhi_no);$i++) {
            $kotuhis[$kotuhi->oup_m_kotuhi_staff_id[$i]][$kotuhi->oup_m_kotuhi_place_id[$i]][$kotuhi->oup_m_kotuhi_hosoku[$i]] = $kotuhi->oup_m_kotuhi_cost[$i];
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
//print(count($wkdetail->oup_t_wk_detail_no));
//exit;

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
            $jbnkbn[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_joban_kbn[$i];
            $post[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_post_teate[$i];
            $tukin[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $wkdetail->oup_t_wk_kotuhi[$i];
            if ($kotuhis[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_hosoku[$i]]=="") {
                $tukin2[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $kotuhis[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][''];
            } else {
                $tukin2[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]][$wkdetail->oup_t_wk_genba_id[$i]] = $kotuhis[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_hosoku[$i]];
            }
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
//print($wkdetail->oup_t_wk_taiin_id[$i].",".$wkdetail->oup_t_wk_plan_date[$i].",".$wk."<br />");
            // 労働時間
            $rodo_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $shift2_rod[$wkdetail->oup_t_wk_shift_no[$i]]; // 労働時間
            $nikyu[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_date[$i]]     = $shift2_nky[$wkdetail->oup_t_wk_shift_no[$i]];



        }

// var_dump($jikyuflg);

    }

    if (($act == "1") || ($act == "2")) {

        for ($i=0;$i<count($wk->oup_t_wk_no);$i++) {

//            if ($staffkbns[$wk->oup_t_wk_taiin_id[$i]]=="4") {
//            } else if ($wk->oup_t_wk_taiin_id[$i]=="JPN01") {
//            } else if ($wk->oup_t_wk_taiin_id[$i]=="JPN02") {
//            } else if ($wk->oup_t_wk_taiin_id[$i]=="1") {
//            } else if ($wk->oup_t_wk_taiin_id[$i]=="2") {
//            } else {

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
                if ($jbnkbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {

                    // ポスト手当て
                    $kyuyo[$taiin_id]["s12"] = $kyuyo[$taiin_id]["s12"] + $post[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                    if (($post[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]=="")||(($post[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]==0))) {
                    } else {
                        $kyuyo[$taiin_id]["k12"] = $kyuyo[$taiin_id]["k12"]+6;
                    }

                    // 通勤費
                    $kyuyo[$taiin_id]["s13"] = $kyuyo[$taiin_id]["s13"] + $tukin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                    // 年休
                    if (($jbnkbn[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") || ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4")) {

                        $kyuyo[$taiin_id]["k13"] = $kyuyo[$taiin_id]["k13"] + 1;

                        $wk_kintime = "";

                        $zenkbn = "";

                        $tukin2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] = "0";

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
                            $kyuyo[$taiin_id]["h11"] = ceil(($jikyu[$taiin_id])*1.5);
                            $kyuyo[$taiin_id]["s11"] = ceil($kyuyo[$taiin_id]["k11"]*$kyuyo[$taiin_id]["h11"]);

                            $wk_sin = $sin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];

                            if ($kyuyo[$taiin_id]["k11"]==0) {
                                $kyuyo[$taiin_id]["k11"] = "";
                                $kyuyo[$taiin_id]["h11"] = "";
                                $kyuyo[$taiin_id]["s11"] = "";
                            }

                            // 泊
                            if ($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
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

                                    $tukin2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] = "0";
                                }

                                $zenkbn = "1";
                            }
                            // 夜勤
                            if ($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") {
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
                            if ($kbn2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") {
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

                                    $tukin2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] = "0";

                                }

                                $zenkbn = "2";
                            }
                        }
                    }
/*
print("隊員=");
print($taiin_id);
print(" ");
print("日付=");
print($nengetuwk);
print("現場=");
print($wk->oup_t_wk_genba_id[$i]);
print("交通費=");
print($tukin2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
print("<br />");
*/
                    if ($act == "1") {


                        if (($tukin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "") || ($tukin[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == 0)) {

                            if (!(($tukin2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "") || ($tukin2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == 0))) {

                                // 集計データ書き込み
                                $wkdetail3  = new Wkdetail;     // シフト予定マスタクラス

                                $wkdetail3->inp_t_wk_detail_no = $wk_detail_no[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];  // NO
                                $wkdetail3->inp_t_wk_kotuhi = $tukin2[$taiin_id][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];   // 交通費

//print($wkdetail3->inp_t_wk_detail_no);
//print(" ");

print("隊員=");
print($taiin_id);
print(" ");
print("日付=");
print($nengetuwk);
print(" ");
print("現場=");
print($wk->oup_t_wk_genba_id[$i]);
print(" ");
print("交通費=");
print($wkdetail3->inp_t_wk_kotuhi);
print("<br />");


//                        $wkdetail3->updateWkdetail();

                            }
                        }

                    }

                } else {

                    $zenkbn = "";

                }
//            }

            }
        }


            // アラート
            $alert = "<script type='text/javascript'>alert('交通費更新処理を行いました');</script>";
            echo $alert;



    }

?>
