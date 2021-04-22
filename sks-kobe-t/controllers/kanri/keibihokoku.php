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
    // require_once('../../models/Genba.php');                  // 社員クラス
    require_once('../../models/ReportGroup.php');                  // グループクラス
    require_once('../../models/ReportMail.php');              //メールクラス

    $act       = NULL;
    $hokokusyo = "";
    $kbn['1'] = "完了";
    $kbn['2'] = "一時保存";

    if (isset($_REQUEST['startday'])) {
        $_SESSION["sday"] = $_REQUEST["startday"];
    } else {
        if (!isset($_SESSION["sday"])) {
            $_SESSION["sday"] = date('Ymd', strtotime('-1 day'));
        }
    }
    if (isset($_REQUEST['endday'])) {
        $_SESSION["eday"] = $_REQUEST["endday"];
    } else {
        if (!isset($_SESSION["eday"])) {
            $_SESSION["eday"] = date('Ymd', strtotime('-1 day'));
        }
    }

    $startday   = str_replace("-",$sp,$_SESSION["sday"]);
    $endday     = str_replace("-",$sp,$_SESSION["eday"]);

    // 日付前日ボタン
    if (isset($_REQUEST["prev"])) {
        $startday_ts = strtotime($startday);
        $startday_ts2 = strtotime('-1 day',$startday_ts);
        $startday = date("Ymd",$startday_ts2);
        $endday_ts = strtotime($endday);
        $endday_ts2 = strtotime('-1 day',$endday_ts);
        $endday = date("Ymd",$endday_ts2);
    }
    // 日付翌日ボタン
    if (isset($_REQUEST["next"])) {
        $startday_ts = strtotime($startday);
        $startday_ts2 = strtotime('+1 day',$startday_ts);
        $startday = date("Ymd",$startday_ts2);
        $endday_ts = strtotime($endday);
        $endday_ts2 = strtotime('+1 day',$endday_ts);
        $endday = date("Ymd",$endday_ts2);
    }

    if (isset($_REQUEST["genba_id"])) {
        for ($i=0;$i<count($_REQUEST["genba_id"]);$i++) {
            $genba_id[$i] = $_REQUEST["genba_id"][$i];
            $_SESSION["gid"][$i] = $genba_id[$i];
        }
    } else {
        if ($_SESSION["gid"] != "") {
            for ($i=0;$i<count($_SESSION["gid"]);$i++) {
                $genba_id[$i] = $_SESSION["gid"][$i];
            }
        }
    }
    if (isset($genba_id)) {
        for ($i=0;$i<count($genba_id);$i++) {
            if ($i != 0) {
                $hokokusyo .= ",";
            }
            $hokokusyo .= "'".$genba_id[$i]."'";
        }
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $reportname = new ReportName;   // 警備報告書マスタクラス
    $report     = new Report;       // 警備報告書クラス
    // $genba     = new Genba;
    // $group     = new Group;
    $reportMail      = new ReportMail;

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
    $report->inp_plan_start_date = $startday;
    $report->inp_plan_end_date = $endday;
    if ($hokokusyo != "") {
        $report->inp_table_in = $hokokusyo;
    }
//print($hokokusyo);
    $report->inp_join = "name";
    $report->inp_order = "order by t_report_name.t_report_disp, t_report_kanri.t_report_plan_date, t_report_kanri.t_report_no ";
    // $report->inp_order = "order by t_report_plan_date, 	t_report_no ";
    // 検索部分はまだ出来ていないため全件取得
    $report->getReport("kanri");

    $reportMail->getReportMail();
    // var_dump($reportMail);

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
