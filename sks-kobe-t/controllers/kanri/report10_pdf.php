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

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $reportname = new ReportName;   // 警備報告書マスタクラス
    $report     = new Report;       // 警備報告書クラス
    $staff      = new Staff;        // 社員マスタクラス

    // 社員マスタ 取得
    $staff->getStaff();
    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
        $staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_name[$i];
    }

    // 警備報告書取得
    // 検索部分はまだ出来ていないため全件取得
    $report->inp_no = $_GET['no'];
    $report->getReport("10");

var_dump($report);

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report10_pdf_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report10_pdf_html.php');
    }
?>
