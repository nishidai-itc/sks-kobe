<?php
session_start();

// ログインチェック
if (!isset($_SESSION["staff_id"])) {
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
require_once('../../models/Wkdetail.php');               // シフト予定クラス
require_once('../../models/Shift.php');                  // シフトクラス

$week = array("日", "月", "火", "水", "木", "金", "土");

if (isset($_REQUEST['targetday'])) {
    $targetday = $_REQUEST['targetday'];
} else {
    $targetday = date('Ym');
}

/*********************************************************
 *	クラスの作成
********************************************************/
$common     = new Common;       // 共通クラス
$genba      = new Genba;        // 現場マスタクラス
$staff      = new Staff;        // 社員マスタクラス
$wk         = new Wk;           // シフト予定マスタクラス
$wkdetail   = new Wkdetail;     // シフト予定マスタクラス
$shift      = new Shift;        // シフトクラス

// 現場マスタ 取得 に必要な情報をセット
$genba->inp_m_genba_del_flg = "0";
// 現場マスタ 取得
$genba->getGenba();

// 年月
if (isset($_REQUEST['nengetu'])) {
    $nengetu = $_REQUEST['nengetu'];
} else {
    $nengetu = date('Ym', strtotime('+1 day'));
}

// リストの生成
$yotei_list = [];
for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
    $yotei_list[$i]['genba_name'] = $genba->oup_m_genba_name[$i];
}

// 社員マスタ 取得
$staff->getStaff();

for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
    $staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_name[$i];
}

// 作業実施の曜日　取得
$time = strtotime(date('Y-m-d'));
$w = date("w", $time);

// HTML表示
require_once('../../views/kanri/shukei_html.php');
?>