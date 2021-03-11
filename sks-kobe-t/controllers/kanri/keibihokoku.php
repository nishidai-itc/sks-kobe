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
    require_once('../../models/ReportName.php');             // 警備報告書マスタクラス
    require_once('../../models/ReportTable.php');                 // 警備報告書クラス
    require_once('../../models/Report.php');                 // 警備報告書クラス
    require_once('../../models/Staff.php');                  // 社員クラス

    $act            = NULL;

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $reportname = new ReportName;   // 警備報告書マスタクラス
    $report     = new Report;       // 警備報告書クラス

    // Gチェック登録ボタンが押された
    if (isset($_REQUEST["bundle"])) {
        //Gﾁｪｯｸ済登録
//var_dump($_POST["gchk1"]);
//var_dump($_POST["gchk2"]);
        if (isset($_POST["check_teate"]) && (($_POST["gchk1"] != "") || ($_POST["gchk2"] != ""))) {
//print("OK");
            $check_teate = $_POST["check_teate"];
            if ($_POST["gchk1"]!="") {
                $chk = $_POST["gchk1"];
            } else {
                $chk = $_POST["gchk2"];
            }
            // 登録
            foreach ($check_teate as $wkdetail_no) {

                // 初期化
                $report2     = new Report;       // 警備報告書クラス
                // 勤務詳細情報を更新
                $report2->inp_no   = $wkdetail_no;
                $report2->inp_gchk = $chk; // ﾁｪｯｸ
                $report2->inp_modified  = date('Y-m-d H:i:s');
//var_dump($report2);
                $report2->updateReport("kanri");
            }
        }
    }

    // 警備報告書マスタ取得（警備報告書プルダウン用）
    $reportname->getReportName();
    for ($i=0;$i<count($reportname->oup_t_report_no);$i++) {
        $report_place[$reportname->oup_t_report_no[$i]] = $reportname->oup_t_report_place[$i];
        $report_contract[$reportname->oup_t_report_no[$i]] = $reportname->oup_t_report_contract[$i];
    }

    // 警備報告書取得
    // 検索部分はまだ出来ていないため全件取得
    $report->getReport("kanri");
//var_dump($report);
?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/keibihokoku_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/keibihokoku_html.php');
    }
?>
