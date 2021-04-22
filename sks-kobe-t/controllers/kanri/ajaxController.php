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
    require_once('../../models/ReportMail.php');
    require_once('../../models/ReportGroup.php');

    $act                                    = NULL;
    $no                                     = NULL;
    $table                                  = NULL;

    $pdfName = array(
        "1" => "KICT",
        "2" => "KFC",
        "3" => "L-6",
        "5" => "三菱倉庫C4",
        "6" => "三菱倉庫C5",
        "7" => "新菱港運",
        // "8" => "待機場A",
        // "9" => "待機場B",
        // "10" => "誘導",
        "11" => "郵船（警備）",
        "12" => "郵船（作業）",
        "13" => "郵船VP",
        "14" => "郵船SBC",
        "99" => "警備報告書（A.B.誘導）"
    );

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
    $reportMail         = new ReportMail;
    $reportGroup         = new ReportGroup;

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
        } elseif ($act == "reportGchk") {
            $returndata = false;

            $report->inp_plan_start_date = $_POST["startdate"];
            $report->inp_plan_end_date = $_POST["enddate"];
            $report->inp_gchk = "1";
            $report->getReport("kanri");

            if ($report->oup_no) {
                // $returndata = $report;
                $returndata = array();
                for ($i=0;$i<count($report->oup_no);$i++) {
                    $reportMail         = new ReportMail;
                    $reportMail->inp_t_report_kanri_no = $report->oup_no[$i];
                    $reportMail->getReportMail();
                    if ($reportMail->oup_t_report_no) {
                        continue;       // 送信済はスルー
                    }

                    $reportGroup = new ReportGroup;
                    $reportGroup->inp_t_report_table_findInSet = $report->oup_table[$i];
                    $reportGroup->getReportGroup();
                    $returndata[$reportGroup->oup_t_report_id[0]][] = $report->oup_no[$i].",".$report->oup_table[$i];
                }
                if (empty($returndata)) {
                    $returndata = "mail";       // 未送信がない場合
                }

                // for ($i=0;$i<count($report->oup_no);$i++) {
                //     $_GET["no"] = $report->oup_no[$i];
                //     $_GET["act"] = "mail";
                //     require("./report".$report->oup_table[$i]."_pdf.php");
                // }
                // $returndata = $report;
            }

            echo json_encode($returndata);
            exit;

        // 警備報告書（A.B.誘導）
        } elseif ($act == "reportSend") {
            $returndata = false;

            // $array = array_unique($_POST["date"]);
            $report5 = new Report;
            $report5->inp_plan_date = $_POST["date"];
            $report5->inp_table_in = "'8','9','10'";
            $report5->inp_order = "order by CAST(t_report_table AS SIGNED)";
            $report5->inp_gchk = "1";
            $report5->getReport("kanri");
            
            for ($l=0;$l<count($report5->oup_no);$l++) {
                $_GET["no"] = $report5->oup_no[$l];
                $_GET["cnt"] = count($report5->oup_no);
                $file = "report".$report5->oup_table[$l]."_pdf.php";
                if ($l == 0) {
                    $_GET["act2"] = "first";
                } elseif ($l+1 == count($report5->oup_no)) {
                    $_GET["act2"] = "end";
                } else {
                    $_GET["act2"] = "middle";
                }

                require_once($file);
            }
            
            echo json_encode($returndata);
            exit;
        } elseif ($act == "addUpReportMail") {
            $returndata = false;

            foreach ($_POST["no"] as $key => $val) {
                $array = explode(",",$val);

                $reportMail         = new ReportMail;
                $reportMail->inp_t_report_kanri_no = $array[0];
                $reportMail->getReportMail();
                if ($reportMail->oup_t_report_no) {
                    $reportMail->inp_t_report_no = $reportMail->oup_t_report_no[0];
                    $reportMail->inp_t_report_send_date = date("Y-m-d");
                    $reportMail->updateReportMail();
                } else {
                    $reportGroup2 = new ReportGroup;
                    $reportGroup2->inp_t_report_table_findInSet = $array[1];
                    $reportGroup2->getReportGroup();

                    $reportMail2 = new ReportMail;
                    $reportMail2->inp_t_report_kanri_no = $array[0];
                    $reportMail2->inp_t_report_send_date = date("Y-m-d");
                    $reportMail2->inp_t_report_id = $reportGroup2->oup_t_report_id[0];
                    $reportMail2->insertReportMail();
                }
            }
            echo json_encode($returndata);
            exit;
        } elseif ($act == "mailSend") {
            $returndata = false;
            $group = array();

            $reportGroup2 = new ReportGroup;
            $reportGroup2->inp_t_report_id = 1;
            $reportGroup2->getReportGroup();
            $address = $reportGroup2->oup_t_report_mail[0];
            $name = $reportGroup2->oup_t_report_name[0];
            $bcc = $address;
            $bccName = $name;

            $reportGroup->inp_t_report_id = $_POST["dataList"]["id"];
            $reportGroup->getReportGroup();
            $mail = $reportGroup->oup_t_report_mail[0];
            $sub = $reportGroup->oup_t_report_title[0];
            $body = $reportGroup->oup_t_report_name[0]."　様\n\n";
            $body .= $reportGroup->oup_t_report_body[0]."\n\n";
            $body .= "㈱新神戸セキュリティ　".$name;

            require_once('../../mailset.php');
            foreach ($_POST["dataList"]["data"] as $key => $val) {
                $array = explode(",",$val);
                // $attachfile = $common->rootpath."/pdf/pdf_file/report".$array[1]."_".substr($array[0],0,8).".pdf";
                // 警備報告書（A.B.誘導）
                if ($array[1] == "8" || $array[1] == "9" || $array[1] == "10") {
                    $group[] = substr($array[0],0,8);
                    continue;
                }
                $attachfile = $common->rootpath."/pdf/pdf_file/".$pdfName[$array[1]]."_".substr($array[0],0,8).".pdf";
                $mailer->AddAttachment($attachfile);
            }
            // 警備報告書（A.B.誘導）
            if (!empty($group)) {
                $group = array_unique($group);
                foreach ($group as $key => $val) {
                    $attachfile = $common->rootpath."/pdf/pdf_file/".$pdfName["99"]."_".$val.".pdf";
                    $mailer->AddAttachment($attachfile);
                }
            }

            $mailer->send();

            echo json_encode($returndata);
            exit;
        }
    }

    echo json_encode($_POST);
    exit;

?>