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
require_once('../models/CarTeate.php');                  // 手当てクラス
require_once('../models/Genba.php');                  // 現場クラス
require_once('../models/Shift.php');                  // シフトクラス


$week = array("日", "月", "火", "水", "木", "金", "土");
$time = strtotime(date('Y-m-d'));
$w = date("w", $time);

if (isset($_REQUEST["act"])) {
    $act       = $_REQUEST["act"];
    $car_teate_no  = $_REQUEST["car_teate_no"];
    $shift_no  = $_REQUEST["shift_no"];
    $kuruma_cost = $_REQUEST["kuruma_cost"];
}

/*********************************************************
 *	クラスの作成
  ********************************************************/
$common     = new Common;       // 共通クラス
$kotuhi     = new Kotuhi;       // 交通費マスタクラス
$kotuhi2    = new Kotuhi;       // 交通費マスタクラス
$staff      = new Staff;        // 社員マスタクラス
$car_teate  = new CarTeate;     // 手当てマスタクラス
$shift      = new Shift;        // シフトマスタクラス


// 社員マスタ 取得 に必要な情報をセット
$staff->inp_m_staff_id = $_SESSION["staff_id"];
// 社員マスタ 取得
$staff->getStaff();


if ($act == "") {
    // 編集する手当てのNo
    if (isset($_REQUEST["no"])) {
        // 交通費マスタ 取得
        $car_teate->inp_m_car_teate_no = $_REQUEST["no"];
        $car_teate->getCarTeate();
    }
}

// データの登録・更新
if ($act == "1") {
    if ($car_teate_no == "") {
        // データの登録
        $car_teate->inp_m_car_teate_no          = $car_teate_no;
        $car_teate->inp_m_car_teate_staff_id    = $_SESSION["staff_id"];
        $car_teate->inp_m_car_teate_shift_no    = $shift_no;
        $car_teate->inp_m_car_teate_kuruma_cost = $kuruma_cost;
        $car_teate->inp_m_car_teate_created     = date('Y-m-d H:i:s');
        $car_teate->inp_m_car_teate_created_id  = $_SESSION["staff_id"];
        $car_teate->insertCarTeate();
    } else {
        // データの更新
        $car_teate->inp_m_car_teate_no          = $car_teate_no;
        $car_teate->inp_m_car_teate_shift_no    = $shift_no;
        $car_teate->inp_m_car_teate_kuruma_cost   = $kuruma_cost;
        $car_teate->inp_m_car_teate_modified    = date('Y-m-d H:i:s');
        $car_teate->inp_m_car_teate_modified_id = $_SESSION["staff_id"];
        $car_teate->updateCarTeate();
    }

    header('Location:car_teate1.php');
}

// データの削除
if ($act == "2") {
    // データ削除
    $car_teate->inp_m_car_teate_no = $_REQUEST["no"];
    $car_teate->deleteCarTeate();

    header('Location:car_teate1.php');
}

// キャリア判定（PC/スマートフォン/タブレット）
if ($common->judgephone) {
    // HTML表示
    require_once('../views/car_teate2_html.php');
// キャリア判定（フィーチャーフォン）
} else {
    // HTML表示
    require_once('../views/m/car_teate2_html.php');
}
?>