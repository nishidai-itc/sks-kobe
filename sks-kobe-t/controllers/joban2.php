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
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Genba.php');                  // 現場クラス

    $act        = NULL;
    $errmsg     = "";
    $week = array("日", "月", "火", "水", "木", "金", "土");

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
        $inp_joban_kbn  = $_POST["joban_kbn"];
        $inp_joban_time = $_POST["joban_time"];
        $new_pw2 = $_POST["new_pw2"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Work;         // 作業クラス
    $work2      = new Work;         // 作業クラス
    $staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業テーブル 取得 に必要な情報をセット
    $work->inp_t_work_taiin_id    = $_SESSION["staff_id"];
    $work->inp_t_work_plan_date   = date('Ymd');
    $work->inp_t_work_del_flg     = "0";

    // 作業テーブル 取得
    $work->getWork();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    //  作業実施の上番時刻　取得
    $joban_time = $work->oup_t_work_joban_time[0];

    if ($joban_time == "") {
        $joban_time = $work->oup_t_work_plan_joban_time[0];
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
            $work2->inp_t_work_no = $work->oup_t_work_no[0];              // 作業実施NO（連番）
            $work2->inp_t_work_joban_kbn  = $inp_joban_kbn;               // 上番区分
            // 上番区分 = 通常
            if ($inp_joban_kbn == "1") {
                $work2->inp_t_work_joban_time = $work->oup_t_work_plan_joban_time[0];   // 上番時刻
            // 上番区分 = 休暇
            } else if ($inp_joban_kbn == "4") {
                $work2->inp_t_work_joban_time = "";                                     // 上番時刻
            // 上番区分 = 早出 or 遅刻
            } else {
                $work2->inp_t_work_joban_time = $inp_joban_time;                        // 上番時刻
            }

            // 作業の更新
            $work2->updateWork();

                // キャリア判定（PC/スマートフォン/タブレット）
                if ($common->judgephone) {
                    // HTML表示
                    header('Location:../controllers/menu.php');
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
        require_once('../views/joban2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/joban2_html.php');
    }
?>
