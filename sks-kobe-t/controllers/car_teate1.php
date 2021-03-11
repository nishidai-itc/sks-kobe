<?php
session_start();

// ログインチェック
if (!isset($_SESSION["staff_id"])) {
    // HTML表示
    header('Location:../controllers/login.php');
}
?>
<?php
require_once('../models/common/common.php');             // 共通クラス
require_once('../models/common/db.php');                 // DBクラス
require_once('../models/Kotuhi.php');                    // 交通費クラス
require_once('../models/CarTeate.php');                  // 車手当てクラス
require_once('../models/Staff.php');                     // 社員クラス
require_once('../models/Genba.php');                     // 現場クラス
require_once('../models/Shift.php');                     // シフトクラス

$week = array("日", "月", "火", "水", "木", "金", "土");

/*********************************************************
 *	クラスの作成
  ********************************************************/
$common     = new Common;       // 共通クラス
$car_teate  = new CarTeate;     // 車手当てマスタクラス
$kotuhi     = new Kotuhi;       // 交通費マスタクラス
$staff      = new Staff;        // 社員マスタクラス
$shift      = new Shift;        // シフトマスタクラス
$genba      = new Genba;        //  現場マスタクラス


// 手当てマスタから一覧を取得
$car_teate->getCarTeate();

// 社員マスタ 取得
$staff->inp_m_staff_id = $_SESSION["staff_id"];
$staff->getStaff();

// 作業実施の曜日　取得
$time = strtotime(date('Y-m-d'));
$w = date("w", $time);

// キャリア判定（PC/スマートフォン/タブレット）
if ($common->judgephone) {
    // HTML表示
    require_once('../views/car_teate1_html.php');
// キャリア判定（フィーチャーフォン）
} else {
    // HTML表示
    require_once('../views/m/car_teate1_html.php');
}
?>