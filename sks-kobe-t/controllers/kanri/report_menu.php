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

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    if ($act == "2") {
        if ($_POST["no"]) {
            $no                 = explode(",",$_POST["no"]);
            $report3            = new Report;
            $report3->inp_no    = $no[0];
            $report3->deleteReport("kanri");
            $report3->deleteReport($no[1]);
        }
    }

    // 名称取得
    $report->getReport("name");
    
    // 当日の警備報告書を管理から取得
    $report2->inp_plan_date                            = $plan_date;
    $report2->getReport("kanri");
    for ($i=0;$i<count($report2->oup_no);$i++) {
        $report_kbn[$report2->oup_table[$i]]           = $kbn[$report2->oup_kbn[$i]];
    }
    
    // $data = array();
    // for ($i=0;$i<14;$i++) {
    //     $data[$i]["no"]             = null;
    //     $data[$i]["table"]          = $i+1;
    //     $data[$i]["kbn"]            = null;
    //     $data[$i]["place"]          = $report_place[$i+1];
    //     $data[$i]["contract"]       = $report_contract[$i+1];
    //     if ($i == 3) {
    //         continue;
    //     }

    //     if ($i != 2 && $i != 4 && $i != 5 && $i != 8 && $i != 9) {
    //         $report2                = new Report;
    //         // $report->inp_table      = $i+1;
    //         // $report->inp_plan_date  = $plan_date;
    //         $report2->inp_no        = str_replace("-","",$plan_date).($i+1);
    //         $report2->getReport("kanri");
    //         if ($report2->oup_no) {
    //             // $data[$i]["no"]          = $report->oup_table_no[0];
    //             $data[$i]["no"]     = $report2->oup_no[0];
    //             $data[$i]["kbn"]    = $report2->oup_kbn[0];
    //         }
    //     }
    // }

    // var_dump($data);

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
