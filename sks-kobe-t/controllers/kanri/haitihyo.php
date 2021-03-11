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
    require_once('../../models/Wkdetail.php');               // シフト予定クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");

    if (isset($_REQUEST['targetday'])) {
        $targetday = $_REQUEST['targetday'];
    } else {
        $targetday = date('Ymd');
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";

    // 現場マスタ 取得
    $genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";
    $genba->getGenba();

    // 社員マスタ 取得
    $staff->getStaff();

    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
        //$staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_name[$i];
        $staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_haiti_name[$i];
        $staffkbns[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_kbn[$i];
    }
    
    $wkdetail_j2   = new Wkdetail;
    $wkdetail_j2->inp_t_wk_plan_date = $targetday;
    $wkdetail_j2->inp_t_wk_plan_kbn = "6";
    $wkdetail_j2->inp_t_wk_joban_kbn2 = "4";
    $wkdetail_j2->inp_t_wk_joban_kbn3 = "5";
    $wkdetail_j2->getWkdetail();
    $work_mem_j2   = new Wkdetail;
    $work_mem_j2->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
    $work_mem_j2->inp_t_wk_kaban_time  = "null";
    $work_mem_j2->inp_t_wk_joban_time  = "is not null";
    $work_mem_j2->inp_t_wk_del_flg     = "0";
    $work_mem_j2->inp_t_wk_plan_kbn = "6";
    $work_mem_j2->inp_t_wk_joban_kbn2 = "4";
    $work_mem_j2->inp_t_wk_joban_kbn3 = "5";
    $work_mem_j2->getWkdetail();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // 予定の検索条件セット
//    $wkdetail->inp_t_wk_plan_date = $targetday;

    // 予定の取得
//    $wkdetail->getWkdetail();

    // HTML表示
    require_once('../../views/kanri/haitihyo_html.php');
?>
