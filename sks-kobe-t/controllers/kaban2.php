<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/Work.php');                   // 作業クラス
    require_once('../models/Kotuhi.php');                 // 交通費クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Genba.php');                  // 現場クラス

    $act        = NULL;
    $errmsg     = "";
    $week = array("日", "月", "火", "水", "木", "金", "土");

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
        $inp_joban_kbn  = $_POST["joban_kbn"];
        $inp_joban_time = $_POST["joban_time"];
        $inp_kaban_kbn  = $_POST["kaban_kbn"];
        $inp_kaban_time = $_POST["kaban_time"];
        $inp_kyukei_start1 = $_POST["kyukei_start1"];
        $inp_kyukei_end1   = $_POST["kyukei_end1"];
        $inp_kyukei_start2 = $_POST["kyukei_start2"];
        $inp_kyukei_end2   = $_POST["kyukei_end2"];
        $inp_kyukei_start3 = $_POST["kyukei_start3"];
        $inp_kyukei_end3   = $_POST["kyukei_end3"];
        $inp_kyukei_start4 = $_POST["kyukei_start4"];
        $inp_kyukei_end4   = $_POST["kyukei_end4"];
        $inp_kyukei_start5 = $_POST["kyukei_start5"];
        $inp_kyukei_end5   = $_POST["kyukei_end5"];

        $inp_kotuhi = $_POST["kotuhi"];
        $inp_kotuhi2 = $_POST["kotuhi2"];
        $inp_post   = $_POST["post"];
        $inp_sikaku = $_POST["sikaku"];
        $inp_kuruma = $_POST["kuruma"];
        $inp_riyu   = $_POST["riyu"];

        $id         = $_POST["id"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Work;         // 作業クラス
    $work2      = new Work;         // 作業クラス
    $kotuhi     = new Kotuhi;       // 交通費マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 交通費マスタ 取得 に必要な情報をセット
    if ($_REQUEST["id"]!="") {
        $kotuhi->inp_m_kotuhi_staff_id = $_REQUEST["id"];
    } else {
        $kotuhi->inp_m_kotuhi_staff_id = $_SESSION["staff_id"];
    }

    // 交通費マスタ 取得
    $kotuhi->getKotuhi();

    // 作業テーブル 取得 に必要な情報をセット
    if ($_REQUEST["id"]!="") {
        $work->inp_t_work_taiin_id    = $_REQUEST["id"];
    } else {
        $work->inp_t_work_taiin_id    = $_SESSION["staff_id"];
    }
    $work->inp_t_work_plan_date   = date('Ymd');
    $work->inp_t_work_del_flg     = "0";

    // 作業テーブル 取得
    $work->getWork();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // 作業実施の上番時刻　取得
    $joban_time = $work->oup_t_work_joban_time[0];

    if ($joban_time == "") {
        $joban_time = $work->oup_t_work_plan_joban_time[0];
    }

    // 作業実施の下番時刻　取得
    $kaban_time = $work->oup_t_work_kaban_time[0];

    if ($kaban_time == "") {
        $kaban_time = $work->oup_t_work_plan_kaban_time[0];
    }

    // 作業実施の早出残業時間　取得
    $wk_st_h = substr($joban_time,0,2);
    $wk_st_m = substr($joban_time,3,2);
    $wk_ed_h = substr($work->oup_t_work_plan_joban_time[0],0,2);
    $wk_ed_m = substr($work->oup_t_work_plan_joban_time[0],3,2);
    $hayade = $wk_ed_h * 60 + $wk_ed_m - $wk_st_h * 60 - $wk_st_m;
    if ($hayade<0) {
        $hayade=0;
    }

    // 作業実施の通常残業時間　取得
    $wk_st_h = substr($work->oup_t_work_plan_kaban_time[0],0,2);
    $wk_st_m = substr($work->oup_t_work_plan_kaban_time[0],3,2);
    $wk_ed_h = substr($kaban_time,0,2);
    $wk_ed_m = substr($kaban_time,3,2);
    $tujo = $wk_ed_h * 60 + $wk_ed_m - $wk_st_h * 60 - $wk_st_m;
    if ($tujo<0) {
        $tujo=0;
    }

    // 作業実施の休憩残業時間　取得
    for ($i=1;$i<=5;$i++) {
        $wk_st_h = substr($work->{'oup_t_work_kyukei_start'.$i}[0],0,2);
        $wk_st_m = substr($work->{'oup_t_work_kyukei_start'.$i}[0],3,2);
        $wk_ed_h = substr($work->{'oup_t_work_kyukei_end'.$i}[0],0,2);
        $wk_ed_m = substr($work->{'oup_t_work_kyukei_end'.$i}[0],3,2);
        ${'kyukei'.$i} = $wk_ed_h * 60 + $wk_ed_m - $wk_st_h * 60 - $wk_st_m;
        if (${'kyukei'.$i}<0) {
            ${'kyukei'.$i}=0;
        }
    }

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_id = $work->oup_t_work_genba_id[0];

    // 現場マスタ 取得
    $genba->getGenba();

    // 勤務 取得
    if ($work->oup_t_work_plan_kbn[0]=="1") {
        $kinmu = "泊";
    } else if ($work->oup_t_work_plan_kbn[0]=="2") {
        $kinmu = "日勤";
    } else if ($work->oup_t_work_plan_kbn[0]=="3") {
        $kinmu = "夜勤";
    }

    switch ($act) {
        // 画面上の決定ボタンが押された場合
        case 1:

            // 作業 更新 に必要な情報をセット
            $work2->inp_t_work_no = $work->oup_t_work_no[0];                 // 連番
            $work2->inp_t_work_joban_kbn  = $inp_joban_kbn;                  // 上番区分
            $work2->inp_t_work_joban_time = $inp_joban_time;                 // 上番時刻
            $work2->inp_t_work_kaban_kbn  = $inp_kaban_kbn;                  // 下番区分
            // 下番区分 = 通常
            if ($inp_kaban_kbn == "1") {
                $work2->inp_t_work_kaban_time = $work->oup_t_work_plan_kaban_time[0];   // 下番時刻
            // 下番区分 = 早退 or 残業 or 指示終了
            } else {
                $work2->inp_t_work_kaban_time = $inp_kaban_time;                        // 下番時刻
            }

            $work2->inp_t_work_kyukei_start1 = $inp_kyukei_start1;           // 休憩残業開始時刻1
            $work2->inp_t_work_kyukei_start2 = $inp_kyukei_start2;           // 休憩残業開始時刻2
            $work2->inp_t_work_kyukei_start3 = $inp_kyukei_start3;           // 休憩残業開始時刻3
            $work2->inp_t_work_kyukei_start4 = $inp_kyukei_start4;           // 休憩残業開始時刻4
            $work2->inp_t_work_kyukei_start5 = $inp_kyukei_start5;           // 休憩残業開始時刻5
            $work2->inp_t_work_kyukei_end1 = $inp_kyukei_end1;               // 休憩残業終了時刻1
            $work2->inp_t_work_kyukei_end2 = $inp_kyukei_end2;               // 休憩残業終了時刻2
            $work2->inp_t_work_kyukei_end3 = $inp_kyukei_end3;               // 休憩残業終了時刻3
            $work2->inp_t_work_kyukei_end4 = $inp_kyukei_end4;               // 休憩残業終了時刻4
            $work2->inp_t_work_kyukei_end5 = $inp_kyukei_end5;               // 休憩残業終了時刻5

            if ($inp_kotuhi!="") {
                $work2->inp_t_work_kotuhi      = $inp_kotuhi;               // 交通費
            } else {
                $work2->inp_t_work_kotuhi      = $inp_kotuhi2;               // 交通費
            }
            $work2->inp_t_work_post_teate   = $inp_post;                 // ポスト手当
            $work2->inp_t_work_kiken_teate  = $inp_sikaku;               // 危険物資格手当
            $work2->inp_t_work_kuruma_teate = $inp_kuruma;               // 車手当
            $work2->inp_t_work_rest_reason  = $inp_riyu;                 // 理由
            $work2->inp_t_work_modified     = date('Y-m-d H:i:s');
            $work2->inp_t_work_modified_id  = $_SESSION["staff_id"];

            // 作業の更新
            $work2->updateWork();

                // キャリア判定（PC/スマートフォン/タブレット）
                if ($common->judgephone) {
                    if ($_REQUEST["id"]!="") {
                        // HTML表示
                        header('Location:../controllers/kaban1.php');
                    } else {
                        // HTML表示
                        header('Location:../controllers/menu.php');
                    }
                // キャリア判定（フィーチャーフォン）
                } else {
                    // HTML表示
                    header("Location:../controllers/menu.php?".SID);
                }

            break;
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/kaban2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/kaban2_html.php');
    }
?>
