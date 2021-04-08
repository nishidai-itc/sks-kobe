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
    require_once('../../models/Cooperation.php');                  // 協力会社クラス
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
    $company        = new Cooperation;
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
        } elseif ($act == "companyDel") {
            $flg = false;

            $wkdetail->inp_join_m_staff = 1;
            $wkdetail->inp_m_company_id = $_POST["no"];
            // $wkdetail->inp_group = "t_wk_taiin_id";
            $wkdetail->getWkdetail();

            if (!$wkdetail->oup_t_wk_detail_no) {
                $staff->inp_m_staff_company = $_POST["no"];
                $staff->getStaff();
                if ($staff->oup_m_staff_id) {
                    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
                        $staff2          = new Staff;
                        $staff2->inp_m_staff_id = $staff->oup_m_staff_id[$i];
                        $staff2->updateStaffCompany();
                    }
                }
                $flg = true;
            }

            echo json_encode($flg);
            exit;
        }
    }

    echo json_encode($_POST);
    exit;

?>