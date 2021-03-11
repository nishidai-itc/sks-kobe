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
    require_once('../models/User.php');                   // 利用者クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Wkdetail.php');                   // 作業開始クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    $act            = NULL;

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $staff      = new Staff;        // 社員マスタクラス
    $work       = new Wkdetail;         // 作業実施テーブルクラス

    // 作業実施テーブル 取得 に必要な情報をセット
//    $work->inp_t_work_plan_id    = $_SESSION["staff_id"];
//    $work->inp_t_work_plan_start_month   = date('Ym');

    // 作業実施テーブル 取得
//    $work->getWorkPlandaysum();

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    switch ($act) {
        case 2:

            $_SESSION["work_day"]    = $_POST["work_day"];

            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/sagyoplandetail.php');
            } else {
                // HTML表示
                header("Location:../controllers/sagyoplandetail.php?".SID);
            }

            break;
    }


    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/kyuka_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/kyuka_html.php');
    }
?>
