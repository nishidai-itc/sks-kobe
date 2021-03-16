<?php
    session_start();
    
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Wkdetail.php');               // 作業開始クラス
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/ReportTable.php');
    require_once('../../models/Report.php');

    $act            = NULL;
    $plan_date      = date("Y-m-d");
    $kbn            = array("1"=>"完了","2"=>"一時保存");

    $week           = array("日", "月", "火", "水", "木", "金", "土");
    $time           = strtotime(date('Y-m-d'));
    $w              = date("w", $time);

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common         = new Common;         // 共通クラス
    $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
    $staff          = new Staff;          // 社員マスタクラス
    $report         = new Report;
    $report2        = new Report;
    $report3        = new Report;

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    if ($act == "2") {
        if ($_POST["no"]) {
            $no                 = explode(",",$_POST["no"]);
            $report3->inp_no    = $no[0];
            $report3->deleteReport("kanri");
            $report3->deleteReport($no[1]);
        }
    }

    // if ($staff->oup_m_staff_kbn[0] != "1") {
    //     $wkdetail->inp_t_wk_taiin_id                        = $staff->oup_m_staff_id[0];
    // }

    // $wkdetail->inp_t_wk_plan_date                           = str_replace("-","",$plan_date);
    // $wkdetail->inp_group                                    = "t_wk_genba_id";
    // $wkdetail->getWkdetail();

    // 名称取得
    $report->getReport("name");
    for ($i=0;$i<count($report->oup_no);$i++) {
        $wkdetail2                                      = new Wkdetail;
        $wkdetail2->inp_t_wk_plan_date                  = str_replace("-","",$plan_date);

        if ($report->oup_genba_id[$i]) {
            $genba[0]                                   = $report->oup_genba_id[$i];
            if (strpos($report->oup_genba_id[$i],",")) {
                $genba                                  = explode(",",$report->oup_genba_id[$i]);
            }
            for ($j=0;$j<count($genba);$j++) {
                if ($j == 0) {
                    $wkdetail2->inp_t_wk_genba_id2      = "'".$genba[$j]."'";
                } else {
                    $wkdetail2->inp_t_wk_genba_id2      = $wkdetail2->inp_t_wk_genba_id2.",'".$genba[$j]."'";
                }
            }
        }
        if ($report->oup_plan_kbn[$i]) {
            $plan_kbn[0]                                = $report->oup_plan_kbn[$i];
            if (strpos($report->oup_plan_kbn[$i],",")) {
                $plan_kbn                               = explode(",",$report->oup_plan_kbn[$i]);
            }
            for ($j=0;$j<count($plan_kbn);$j++) {
                if ($j == 0) {
                    $wkdetail2->inp_t_wk_plan_kbn_in    = "'".$plan_kbn[$j]."'";
                } else {
                    $wkdetail2->inp_t_wk_plan_kbn_in    = $wkdetail2->inp_t_wk_plan_kbn_in.",'".$plan_kbn[$j]."'";
                }
            }
        }
        if ($report->oup_plan_hosoku[$i]) {
            $plan_hosoku[0]                                = $report->oup_plan_hosoku[$i];
            if (strpos($report->oup_plan_hosoku[$i],",")) {
                $plan_hosoku                               = explode(",",$report->oup_plan_hosoku[$i]);
            }
            for ($j=0;$j<count($plan_hosoku);$j++) {
                if ($j == 0) {
                    $wkdetail2->inp_t_wk_plan_hosoku_in    = "'".$plan_hosoku[$j]."'";
                } else {
                    $wkdetail2->inp_t_wk_plan_hosoku_in    = $wkdetail2->inp_t_wk_plan_hosoku_in.",'".$plan_hosoku[$j]."'";
                }
            }
        }

        $wkdetail2->inp_order = "order by t_wk_detail_no limit 1";
        $wkdetail2->getWkdetail();
        $flg[$report->oup_no[$i]] = false;
        if ($wkdetail2->oup_t_wk_detail_no) {
            $flg[$report->oup_no[$i]] = true;
        }
    }
    // var_dump($flg);
    
    // 当日の警備報告書を管理から取得
    $report2->inp_plan_date                             = $plan_date;
    $report2->getReport("kanri");
    if ($report2->oup_no) {
        for ($i=0;$i<count($report2->oup_no);$i++) {
            $report_kbn[$report2->oup_table[$i]]        = $kbn[$report2->oup_kbn[$i]];
            $report_no[$report2->oup_table[$i]]         = $report2->oup_no[$i];
        }
    }

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report_menu_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report_menu_html.php');
    }
?>
