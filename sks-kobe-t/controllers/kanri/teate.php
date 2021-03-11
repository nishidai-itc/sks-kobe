<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Teate.php');                  // 手当てクラス
    require_once('../../models/Staff.php');                  // 社員クラス

    $act  = "";
    $week = array("日", "月", "火", "水", "木", "金", "土");

    if (isset($_REQUEST["act"])) {
        $act          = $_REQUEST["act"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $teate      = new Teate;        // 手当てマスタクラス
    $staff      = new Staff;        // 社員マスタクラス

    // 手当て画面で「登録」ボタンが押された場合
    if ($act == "1") {
        for ($i=1;$i<=5;$i++) {

            $teate2      = new Teate;        // 手当てマスタクラス

            $teate2->inp_m_teate_no            = $i;
            $teate2->inp_m_teate_name          = $_REQUEST['teate_name'.$i];
            $teate2->inp_m_teate_modified      = date('Y-m-d H:i:s');
            $teate2->inp_m_teate_modified_id   = $_SESSION["staff_id"];

            $teate2->updateTeate();
        }
    }

    // 手当てマスタ 取得
    $teate->getTeate();

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // HTML表示
    require_once('../../views/kanri/teate_html.php');
?>
