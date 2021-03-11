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
    require_once('../models/Work.php');                   // 作業開始クラス
    require_once('../models/Company.php');                // 会社クラス

    $act        = NULL;

    if (isset($_POST["act"])) {
        $act = $_POST["act"];
    }
    if (isset($_POST["sagyomonth"])) {
        $sagyomonth = $_POST["sagyomonth"];
    } else {
        $sagyomonth = date('Ym');
    }
    if (isset($_POST["work_day"])) {
        $work_day = $_POST["work_day"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Work;           // 作業実施テーブルクラス
    $company    = new Company;      // 会社マスタクラス

    if ($act == "2") {

        $_SESSION["work_day"] = $work_day;

        // 日別作業報告画面に遷移する
        if ($common->judgephone) {
            // HTML表示
            header('Location:../controllers/sagyohokokuhibetudetail.php');
        } else {
            // HTML表示
            header("Location:../controllers/sagyohokokuhibetudetail.php?".SID);
        }
    }

    // 会社マスタ 取得
    $company->getCompany();

    // 月別 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_visitor_id = $_SESSION["staff_id"];

    // 月別 作業実施テーブル 取得
    $work->getWorkmonthsum();

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_visitor_id = $_SESSION["staff_id"];
    $work->inp_t_work_run_start_month = $sagyomonth;

    // 月別 作業実施テーブル 取得
    $work->getWorkdaysum();

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/sagyohokokulist_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/sagyohokokulist_html.php');
    }
?>

