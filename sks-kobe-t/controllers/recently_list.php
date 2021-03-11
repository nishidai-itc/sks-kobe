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
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Wkdetail.php');               // 作業開始クラス
    require_once('../models/Genba.php');                  // 現場クラス
    require_once('../models/Shift.php');                  // シフトクラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    $act            = NULL;

	$start = date('Ym01',mktime(0,0,0,substr(date('Ym01'),4,2) -11,0,substr(date('Ym01'),0,4)));
	$end = date('Ym01',mktime(0,0,0,substr(date('Ym01'),4,2) +2,0,substr(date('Ym01'),0,4)));

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }
    if (isset($_POST["target_ym"])) {
        $target_ym  = $_POST["target_ym"];
    } else {
        $target_ym  = date('Ym');
    }
    if (isset($_POST["target_id"])) {
        $target_id  = $_POST["target_id"];
    } else {
        $target_id  = $_SESSION["staff_id"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $staff      = new Staff;        // 社員マスタクラス
    $staff2      = new Staff;           //  3/23
    $work       = new Wkdetail;     // 作業実施テーブルクラス
    $genba      = new Genba;        // 現場マスタクラス
    $shift      = new Shift;        // シフトマスタクラス

    $lastday = date('d', mktime(0, 0, 0, substr($target_ym, 4, 2) + 1, 0, substr($target_ym, 0, 4)));

    // 作業テーブル 取得 に必要な情報をセット
    $work->inp_t_wk_taiin_id    = $target_id;
    $work->inp_t_wk_plan_start_date   = $target_ym."01";
    $work->inp_t_wk_plan_end_date   = $target_ym.$lastday;

    // 作業予定データ 取得
    $work->getWkdetail();
//3/23
// 社員マスタ 取得 に必要な情報をセット
$staff2->inp_m_staff_id = $_SESSION["staff_id"];

// 社員マスタ 取得
$staff2->getStaff();

if ($staff2->oup_m_staff_auth[0]!="1") {

    // 作業テーブル 取得 に必要な情報をセット
    $work->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
    $work->inp_t_wk_plan_date   = date('Ymd');
    $work->inp_t_wk_del_flg     = "0";

    // リーダーの作業テーブル 取得
    $work->getWkdetail();

    // 現場マスタ 取得 に必要な情報をセット
    $genba_id = $work->oup_t_wk_genba_id[0];

}
//3/23
    // 社員マスタソート順
    $staff->inp_order = "order by m_staff_kana";

    // 隊員権限の場合
    if ($staff2->oup_m_staff_auth[0]=="4") {
        $staff->inp_m_staff_id = $_SESSION["staff_id"];
    }

    // 社員マスタ 取得
    $staff->getStaff();

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";

    // 現場マスタ 取得
    $genba->getGenba();

    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    }

    switch ($act) {
        case 2:

            $_SESSION["work_day"]    = $_POST["work_day"];

            // HTML表示
            header('Location:../controllers/sagyoplandetail.php');

            break;
    }

    // HTML表示
    require_once('../views/recently_list_html.php');
?>
