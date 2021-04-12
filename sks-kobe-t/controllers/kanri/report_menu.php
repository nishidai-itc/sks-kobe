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
    $today          = date("Y-m-d");
    $totime         = date("H:i");
    if ($totime >= "00:00" && $totime < "12:00") {
        $plan_date      = date("Y-m-d",strtotime("-1 day"));
        $plan_start_date      = date("Y-m-d",strtotime("-1 day"));
        $plan_end_date      = date("Y-m-d",strtotime("-1 day"));
    } else {
        $plan_date      = $today;
        $plan_start_date      = $today;
        $plan_end_date      = $today;
    }
    $todate = $plan_start_date;
    
    $kbn            = array("1"=>"完了","2"=>"一時保存");

    $place = null;

    // $week           = array("日", "月", "火", "水", "木", "金", "土");
    // $time           = strtotime(date('Y-m-d'));
    // $w              = date("w", $time);
    function getWeek($day) {
        $week = array("日", "月", "火", "水", "木", "金", "土");
        if ($day) {
            return $week[date("w", strtotime(date($day)))];
        } else {
            return null;
        }
    }

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
    } elseif ($act == "1") {
        // var_dump($_POST);
        if (!$_POST["place"]) {
            $_SESSION["place"] = null;
        }

        foreach ($_POST as $key => $val) {
            if ($key == "plan_start_date" || $key == "plan_end_date" || $key == "place") {
                // ${$key} = $val;

                $_SESSION[$key] = $val;
            }
        }
    }

    if ($_SESSION) {
        foreach ($_SESSION as $key => $val) {
            if ($key == "plan_start_date" || $key == "plan_end_date" || $key == "place") {
                ${$key} = $val;
            }
        }
    }

    // // リーダー、上下番チェック者は自分の現場のみ取得
    // if ($staff->oup_m_staff_kbn[0] != "1") {
    //     $report->inp_genba_id_findInSet                      = $staff->oup_m_staff_genba_id[0];
    // }

    // 名称取得
    $report->inp_order = "order by t_report_disp";
    $report->getReport("name");
    for ($i=0;$i<count($report->oup_no);$i++) {
        if ($place && !in_array($report->oup_table[$i],$place)) {continue;}
        for ($k=$plan_start_date;$k<=$plan_end_date;$k=date("Y-m-d",strtotime($k."+1 day"))) {

            $wkdetail2                                      = new Wkdetail;
            // $wkdetail2->inp_t_wk_plan_date                  = str_replace("-","",$plan_date);
            $wkdetail2->inp_t_wk_plan_date                  = str_replace("-","",$k);

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
            // $flg[$report->oup_no[$i]] = false;
            $flg[str_replace("-","",$k).$report->oup_table[$i]] = false;
            // 当日予定のある警備報告書のみ表示
            if ($wkdetail2->oup_t_wk_detail_no) {
                // $flg[$report->oup_no[$i]] = true;
                $flg[str_replace("-","",$k).$report->oup_table[$i]] = true;
            }
            
        }
    }
    // var_dump($flg);
    
    /*
    // 当日の警備報告書を管理から取得
    $report2->inp_plan_date                             = $plan_date;
    $report2->getReport("kanri");
    if ($report2->oup_no) {
        for ($i=0;$i<count($report2->oup_no);$i++) {
            $report_kbn[$report2->oup_table[$i]]        = $kbn[$report2->oup_kbn[$i]];
            $report_no[$report2->oup_table[$i]]         = $report2->oup_no[$i];
        }
    }
    */

    $report4 = new Report;
    $report4->inp_order = "order by t_report_disp";
    $report4->getReport("name");
    
    $report5 = new Report;
    $report5->inp_plan_start_date = $plan_start_date;
    $report5->inp_plan_end_date = $plan_end_date;
    $report5->inp_join = "name";
    $report5->inp_order = "order by t_report_name.t_report_disp,t_report_kanri.t_report_plan_date";
    $report5->getReport("kanri");
    if ($report5->oup_no) {
        for ($i=0;$i<count($report5->oup_no);$i++) {
            if ($place && !in_array($report5->oup_table[$i],$place)) {continue;}
            $report_kbn[$report5->oup_no[$i]] = $kbn[$report5->oup_kbn[$i]];
            $report_no[$report5->oup_no[$i]] = $report5->oup_no[$i];
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
