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
//    require_once('../models/Worktype.php');               // 作業種類開始クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Wkdetail.php');                   // 作業開始クラス

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;         // 共通クラス
//    $worktype   = new Worktype;       // 作業種類マスタクラス
    $staff      = new Staff;          // 社員マスタクラス
    $work       = new Wkdetail;           // 作業実施テーブルクラス
    $work2      = new Wkdetail;           // 作業実施テーブルクラス

    $act        = NULL;
    $run_end_time   = $_SESSION["run_end_time"];
    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    for($i=0;$i<$_SESSION["syurui_cnt"];$i++) {
        $T[$i] = $_SESSION["T".$i];
    }

    $inp_t_work_comment = NULL;
    $alert_kbn        = NULL;

    // 画面上の決定ボタンが押された場合
    if ($act == "1") {

        // 作業実施登録 に必要な情報をセッションにセット
        $_SESSION["comment"] = $inp_t_work_comment;
        $_SESSION["alert_kbn"] = $alert_kbn;

        // キャリア判定（PC/スマートフォン/タブレット）
        if ($common->judgephone) {
            // HTML表示
            header('Location:../controllers/sagyojissekiconf.php');
        // キャリア判定（フィーチャーフォン）
        } else {
            // HTML表示
            header("Location:../controllers/sagyojissekiconf.php?".SID);
        }

        exit();
    }

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/tisou_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/tisou_html.php');
    }
?>
