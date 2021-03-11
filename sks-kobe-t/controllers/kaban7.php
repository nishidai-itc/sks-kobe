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

    $week = array("日", "月", "火", "水", "木", "金", "土");

    if (isset($_REQUEST["joban_kbn"])) {
        $inp_joban_kbn  = $_REQUEST["joban_kbn"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Wkdetail;     // 作業クラス
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

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_id = $work->oup_t_wk_genba_id[0];

    // 現場マスタ 取得
    $genba->getGenba();

    // セッションに通常下番をセット
    $_SESSION["kaban_kbn"] = "1";
    $_SESSION["kaban_time"] = $work->oup_t_wk_plan_kaban_time[0];
    if (isset($_REQUEST['act'])) {
        if ($_REQUEST['act']=="9") {
            $_SESSION["kyukei_start1"] = $_REQUEST['kyukei_start1'];
            $_SESSION["kyukei_end1"] = $_REQUEST['kyukei_end1'];
        } else {
            if ($_SESSION["kyukei_start1"]=="") {
                $_SESSION["kyukei_start1"] = $_REQUEST['kyukei_start1'];
                $_SESSION["kyukei_end1"] = $_REQUEST['kyukei_end1'];
            } else if ($_SESSION["kyukei_start2"]=="") {
                $_SESSION["kyukei_start2"] = $_REQUEST['kyukei_start1'];
                $_SESSION["kyukei_end2"] = $_REQUEST['kyukei_end1'];
            } else if ($_SESSION["kyukei_start3"]=="") {
                $_SESSION["kyukei_start3"] = $_REQUEST['kyukei_start1'];
                $_SESSION["kyukei_end3"] = $_REQUEST['kyukei_end1'];
                header("Location:kaban9.php");
            } else {
                header("Location:kaban9.php");
            }
        }
        header("Location:kaban".$_REQUEST['act'].".php");
    }

    // HTML表示
    require_once('../views/kaban7_html.php');
?>
