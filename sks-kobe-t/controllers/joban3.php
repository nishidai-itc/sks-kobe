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
    require_once('../models/Wkdetail.php');               // 作業クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Genba.php');                  // 現場クラス
    require_once('../models/Shift.php');                  // シフトクラス

    $act        = NULL;
    $errmsg     = "";
    $week = array("日", "月", "火", "水", "木", "金", "土");

    if (isset($_REQUEST["act"])) {
        $act            = $_REQUEST["act"];
        $inp_joban_kbn  = $_REQUEST["joban_kbn"];
        $inp_joban_time = $_REQUEST["joban_time"];
        $new_pw2 = $_POST["new_pw2"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Wkdetail;     // 作業クラス
    $work2      = new Wkdetail;     // 作業クラス
    $staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス
    $shift      = new Shift;        // シフトマスタクラス

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業テーブル 取得 に必要な情報をセット
    $work->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
    $work->inp_t_wk_plan_date   = date('Ymd');
    $work->inp_t_wk_del_flg     = "0";

    // 作業テーブル 取得
    $work->getWkdetail();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    //  作業実施の上番時刻　取得
    $joban_time = $work->oup_t_wk_joban_time[0];

    if ($joban_time == "") {
        $joban_time = $work->oup_t_wk_plan_joban_time[0];
    }

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_id = $work->oup_t_wk_genba_id[0];

    // 現場マスタ 取得
    $genba->getGenba();

    switch ($act) {
        // 画面上の決定ボタンが押された場合
        case 1:

            // 作業 更新 に必要な情報をセット
            $work2->inp_t_wk_detail_no = $work->oup_t_wk_detail_no[0];              // 作業実施NO（連番）
            $work2->inp_t_wk_joban_kbn  = $inp_joban_kbn;               // 上番区分
            // 上番区分 = 通常
            if ($inp_joban_kbn == "1") {
                $work2->inp_t_wk_joban_time = $work->oup_t_wk_plan_joban_time[0];   // 上番時刻
            // 上番区分 = 休暇
            } else if ($inp_joban_kbn == "4") {
                $work2->inp_t_wk_joban_time = "";                                     // 上番時刻
            // 上番区分 = 早出 or 遅刻
            } else {
                $work2->inp_t_wk_joban_time = $inp_joban_time;                        // 上番時刻
            }

            $work2->inp_t_wk_modified    = date('Y-m-d H:i:s');                     // 更新日
            $work2->inp_t_wk_modified_id = $_SESSION["staff_id"];                   // 更新者

            // 作業の更新
            $work2->updateWkdetail();

            require_once('../views/joban5_html.php');

            exit();

    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/joban3_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/joban3_html.php');
    }
?>
