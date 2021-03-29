<?php
    session_start();
    
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Wkdetail.php');               // 作業開始クラス
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/Genba.php');
    require_once('../../models/ReportTable.php');
    require_once('../../models/Report.php');

    $act                                    = NULL;
    $no                                     = NULL;
    $table                                  = NULL;

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common         = new Common;         // 共通クラス
    $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
    $staff          = new Staff;          // 社員マスタクラス
    $genba          = new Genba;
    $report         = new Report;

    if ($act) {
        if ($act == "gchk") {
            $report->inp_no = $_POST["no"];
            $report->getReport("kanri");
            $chk = null;
            if ($report->oup_no) {
                $chk = $report->oup_gchk[0];
            }
            echo json_encode($chk);
            exit;
        }
    }

    echo json_encode($_POST);
    exit;

?>