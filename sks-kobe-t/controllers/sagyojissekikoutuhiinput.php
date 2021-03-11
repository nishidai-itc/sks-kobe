<?php
    session_start();

// var_dump($_SESSION);
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/Worktype.php');               // 作業種類開始クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Work.php');                   // 作業開始クラス
    require_once('../models/sagyojissekikoutuhi_class.php');         // 作業実績交通費クラス

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;         // 共通クラス
    $worktype   = new Worktype;       // 作業種類マスタクラス
    $staff      = new Staff;          // 社員マスタクラス
    $work       = new Work;           // 作業実施テーブルクラス
    $work2      = new Work;           // 作業実施テーブルクラス
    $sagyojissekikoutuhi   = new Sagyojissekikoutuhi;       // 作業実績交通費クラス

    $act        = NULL;
    $run_end_time   = $_SESSION["run_end_time"];
    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    for($i=0;$i<$_SESSION["syurui_cnt"];$i++) {
        $T[$i] = $_SESSION["T".$i];
    }
    $move_cost_yen = NULL;
    $move_cost_kilo =NULL;
    $move_cost_etc = NULL;

    $inp_t_work_comment = NULL;
    $alert_kbn        = NULL;

    if (isset($_POST["act"])) {
        $act        = $common->html_decode($_POST["act"]);
        $move_cost_yen = $common->html_decode($_POST["move_cost_yen"]);
        $move_cost_kilo = $common->html_decode($_POST["move_cost_kilo"]);
        $move_cost_etc = $common->html_decode($_POST["move_cost_etc"]);
        $inp_t_work_comment = $common->html_decode($_POST["t_work_comment"]);
    }
    if (isset($_POST["alert_kbn"])) {
        $alert_kbn= $_POST["alert_kbn"];
    }

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_stop_kbn      = "0";
    $work->inp_t_work_visitor_id    = $_SESSION["staff_id"];

    // 作業実施テーブル 取得
    $work->getWork();

    // 作業予定サービステーブル 取得 に必要な情報をセット
    $work2->inp_t_work_plan_service_no      = $work->oup_t_work_no[0];

    // 作業予定サービステーブル 取得
    $work2->getWorkplanservice();

    if (count($work2->oup_t_work_plan_service_no) == 0) {

        // 作業種類マスタ 取得
        $worktype->getWorktype();
    }

    // 画面上の決定ボタンが押された場合
    if ($act == "1") {

        // 入力内容のチェック に必要な情報をセット
        $sagyojissekikoutuhi->inp_move_cost_yen= $move_cost_yen;       // 交通費
        $sagyojissekikoutuhi->inp_move_cost_kilo= $move_cost_kilo;       // 移動距離

        // 入力内容のチェック
        $sagyojissekikoutuhi->inputCheck();

        // 入力内容のチェックでエラーが無い場合
        if ($sagyojissekikoutuhi->errmsg == "") {

            $_SESSION["move_cost_yen"]  = $move_cost_yen;
            $_SESSION["move_cost_kilo"] = $move_cost_kilo;
            $_SESSION["move_cost_etc"]  = $move_cost_etc;
            $_SESSION["comment"]        = $inp_t_work_comment;
            $_SESSION["alert_kbn"]      = $alert_kbn;

            // キャリア判定（PC/スマートフォン/タブレット）
            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/sagyojissekiconf.php');
            // キャリア判定（フィーチャーフォン）
            } else {
                // HTML表示
                header("Location:../controllers/sagyojissekiconf.php?".SID);
            }
        }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/sagyojissekikoutuhiinput_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/sagyojissekikoutuhiinput_html.php');
    }
?>

