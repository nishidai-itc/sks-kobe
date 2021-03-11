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

    if (isset($_REQUEST["act"])) {
        $act        = $_REQUEST["act"];
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

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_id = $work->oup_t_wk_genba_id[0];

    // 現場マスタ 取得
    $genba->getGenba();

    // 下番報告 報告事項 画面で「次へ」ボタンが押された場合
    if ($act == "1") {

        // 作業テーブル 取得 に必要な情報をセット
        $work->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
        $work->inp_t_wk_plan_date   = date('Ymd');
        $work->inp_t_wk_del_flg     = "0";

        // 作業テーブル 取得
        $work->getWkdetail();

        // 作業 更新 に必要な情報をセット
        $work2->inp_t_wk_detail_no = $work->oup_t_wk_detail_no[0];              // 作業実施NO（連番）

        // 下番区分 = 通常
        $work2->inp_t_wk_kaban_kbn  = "1";               // 下番区分
        $work2->inp_t_wk_kaban_time = $work->oup_t_wk_plan_kaban_time[0];   // 下番時刻

        $work2->inp_t_wk_modified    = date('Y-m-d H:i:s');                     // 更新日
        $work2->inp_t_wk_modified_id = $_SESSION["staff_id"];                   // 更新者

        // 作業の更新
        $work2->updateWkdetail();

        header("Location:kaban18.php");
    }

    // HTML表示
    require_once('../views/kaban17_html.php');
?>
