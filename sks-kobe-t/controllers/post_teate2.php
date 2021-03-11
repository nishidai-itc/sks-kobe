<?php
session_start();

// ログインチェック
if (!isset($_SESSION["staff_id"])) {
    // HTML表示
    header('Location:../controllers/login.php');
}
?>
    <?php
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/Kotuhi.php');                 // 交通費クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/PostTeate.php');              // 手当てクラス
    require_once('../models/Genba.php');                  // 現場クラス
    require_once('../models/Shift.php');                  // シフトクラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    if (isset($_REQUEST["act"])) {
        $act       = $_REQUEST["act"];
        $post_teate_no  = $_REQUEST["post_teate_no"];
        $staff_no  = $_REQUEST["staff_no"];
        $shift_no  = $_REQUEST["shift_no"];
        $post_cost = $_REQUEST["post_cost"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $kotuhi     = new Kotuhi;       // 交通費マスタクラス
    $kotuhi2    = new Kotuhi;       // 交通費マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $post_teate = new PostTeate;    // 手当てマスタクラス
    $shift      = new Shift;        // シフトマスタクラス

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];
    // 社員マスタ 取得
    $staff->getStaff();

    if ($act == "") {
        // 編集する手当てのNo
        if (isset($_REQUEST["no"])) {
            // 交通費マスタ 取得
            $post_teate->inp_m_post_teate_no = $_REQUEST["no"];
            $post_teate->getPostTeate();
        }
    }

    // データの登録・更新
    if ($act == "1") {
        if ($post_teate_no == "") {
            // データの登録
            $post_teate->inp_m_post_teate_no          = $post_teate_no;
            $post_teate->inp_m_post_teate_staff_id    = $staff_no;
            $post_teate->inp_m_post_teate_shift_no    = $shift_no;
            $post_teate->inp_m_post_teate_post_cost   = $post_cost;
            $post_teate->inp_m_post_teate_created     = date('Y-m-d H:i:s');
            $post_teate->inp_m_post_teate_created_id  = $_SESSION["staff_id"];
            $post_teate->insertPostTeate();
        } else {
            // データの更新
            $post_teate->inp_m_post_teate_no          = $post_teate_no;
            $post_teate->inp_m_post_teate_staff_id    = $staff_no;
            $post_teate->inp_m_post_teate_shift_no    = $shift_no;
            $post_teate->inp_m_post_teate_post_cost   = $post_cost;
            $post_teate->inp_m_post_teate_modified    = date('Y-m-d H:i:s');
            $post_teate->inp_m_post_teate_modified_id = $_SESSION["staff_id"];
            $post_teate->updatePostTeate();
        }

        header('Location:post_teate1.php');
    }

    // データの削除
    if ($act == "2") {
        // データ削除
        $post_teate->inp_m_post_teate_no = $_REQUEST["no"];
        $post_teate->deletePostTeate();

        header('Location:post_teate1.php');
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/post_teate2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/post_teate2_html.php');
    }
    ?>
