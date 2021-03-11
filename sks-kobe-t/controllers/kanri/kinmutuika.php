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
    require_once('../../models/Genba.php');                  // 現場クラス
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/Wk.php');                     // シフト予定クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $wk         = new Wk;           // シフト予定マスタクラス

    if (isset($_REQUEST['genba_id'])) {
        $genba_id = $_REQUEST['genba_id'];
    }
    if (isset($_REQUEST['nengetu'])) {
        $nengetu = $_REQUEST['nengetu'];
    }
    if (isset($_REQUEST['regist'])) {

        $wk->inp_t_wk_genba_id = $genba_id;
        $wk->inp_t_wk_nengetu  = $nengetu;
        $wk->inp_t_wk_taiin_id = $_REQUEST['staff_id'];
        $wk->inp_t_wk_order = 10;

        // シフト 取得
        $wk->insertWk();

        // HTML表示
        header("Location:kinmuyotei.php?genba_id=".$genba_id."&nengetu=".$nengetu."&search=");
    }

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";
    $genba->inp_m_genba_id = $genba_id;

    // 現場マスタ 取得
    $genba->getGenba();

    // 社員マスタ 取得 に必要な情報をセット
//    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/kinmutuika_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/kinmutuika_html.php');
    }
?>
