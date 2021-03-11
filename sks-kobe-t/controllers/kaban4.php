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
    require_once('./function/utils.php');                 // 関数クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");

    // 昼残時間の選択に使用
    $select_daytime = array(
      '00:00' => '0',
      '15:00' => '15',
      '30:00' => '30',
      '45:00' => '45'
    );

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
    $utils      = new Utils;        // 関数クラス

    // 下番登録ボタン押下時
    if (isset($_POST["kaban_kojin"])) {
        // データの整形
        $kaban_time = $utils->formatHourMinute($_POST["kaban_time"][0], $_POST["kaban_time"][1]);                         // 下番時間
        $daytime_over_time = $utils->formatHourMinute($_POST["daytime_over_time"][0], $_POST["daytime_over_time"][1]);    // 昼残時間
        $rest_over_time = $utils->formatHourMinute($_POST["rest_over_time"][0], $_POST["rest_over_time"][1]);             // 休憩残業時間
        $midnight_over_time = $utils->formatHourMinute($_POST["midnight_over_time"][0], $_POST["midnight_over_time"][1]); // 深夜残業時間

        // データの登録
        $work->inp_t_wk_detail_no          = $_POST["kaban_kojin"];
        $work->inp_t_wk_kaban_time         = $kaban_time;           // 下番時間
        $work->inp_t_wk_daytime_over_time  = $daytime_over_time;    // 昼残時間
        $work->inp_t_wk_rest_over_time     = $rest_over_time;       // 休憩残業時間
        $work->inp_t_wk_midnight_over_time = $midnight_over_time;   // 深夜残業時間
        $work->inp_t_wk_post_teate         = $_POST["post_teate"];  // ポスト手当
        $work->inp_t_wk_kotuhi             = $_POST["kotuhi"];      // 交通費
        $work->updateWkdetail();

        header('Location:../controllers/menu.php');
    }


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

    // HTML表示
    require_once('../views/kaban4_html.php');
?>
