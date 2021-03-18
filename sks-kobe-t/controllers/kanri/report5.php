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
    require_once('../../models/Genba.php');
    require_once('../../models/ReportTable.php');
    require_once('../../models/Report.php');
    
    $act                                    = NULL;
    $no                                     = NULL;
    $table                                  = 5;
    $weather1                               = null;
    $weather2                               = null;
    $weathers                               = array("晴","曇","雨","雪");
    $chief                                  = null;
    $staff_id                               = null;
    $start_date                             = date("Y-m-d");
    $end_date                               = date("Y-m-d",strtotime($date." +1 day"));
    $joban_time                             = array("08","00");
    $kaban_time                             = array("08","00");
    $picketTimes1                           = array(array("08","30"),array("08","30"),array("08","30"));
    $picketTimes2                           = array(array("17","00"),array("16","30"),array("17","00"));
    for ($i=1;$i<=4;$i++) {
        if ($i < 3) {
            ${"c2_joban_time".$i}          = array(null,null);
            ${"c2_kaban_time".$i}          = array(null,null);
            ${"c3_joban_time".$i}          = array(null,null);
            ${"c3_kaban_time".$i}          = array(null,null);
            ${"c4_joban_time".$i}          = array(null,null);
            ${"c4_kaban_time".$i}          = array(null,null);
            ${"c5_joban_time".$i}          = array(null,null);
            ${"c5_kaban_time".$i}          = array(null,null);
            ${"tonbo_light_joban_time".$i}  = array(null,null);
            ${"tonbo_light_kaban_time".$i}  = array(null,null);
            ${"c5_light_joban_time".$i}    = array(null,null);
            ${"c5_light_kaban_time".$i}    = array(null,null);
        }
        if ($i < 4) {
            ${"picket_joban_time".$i}       = array($picketTimes1[$i-1][0],$picketTimes1[$i-1][1]);
            ${"picket_kaban_time".$i}       = array($picketTimes2[$i-1][0],$picketTimes2[$i-1][1]);
        }
        ${"ship".$i}                        = null;
        ${"ship_in_port_time".$i}           = array(null,null);
        ${"ship_out_port_time".$i}          = array(null,null);
    }
    $comment                                = null;
    $times = array(
        array("17","30"),array("19","00"),array("21","00"),array("22","30"),array("00","00"),array("01","00"),
        array("02","00"),array("03","00"),array("04","00"),array("05","30"),array("06","30")
    );
    for ($i=1;$i<=16;$i++) {
        ${"patrol_time".$i}                 = $times[$i-1] ? array($times[$i-1][0],$times[$i-1][1]) : array(null,null);
    }
    $wk_comment                             = "巡回　点検　警備その他服務中異常ありません";
    $wk_admin_end                           = null;
    $wk_outsider                            = null;
    $abc                                    = array("1"=>"A","2"=>"B","3"=>"C","4"=>"D","5"=>"E","6"=>"F","7"=>"G","8"=>"H","9"=>"I");
    for ($i=1;$i<=9;$i++) {
        ${"wk_staff_id".$i}                 = null;
    }

    // $week = array("日", "月", "火", "水", "木", "金", "土");
    // $time = strtotime(date($date));
    // $w = date("w", $time);
    function getWeek($day) {
        $week = array("日", "月", "火", "水", "木", "金", "土");
        if ($day) {
            return $week[date("w", strtotime(date($day)))];
        } else {
            return null;
        }
    }
    // 値の整形
    function valChange($val) {
        // 配列の場合（時刻等）
        if (is_array($val)) {
            // 値が空ならNULLで登録
            if ($val[0] === "" && $val[1] === "") {
                $val = null;
            // 値が空じゃない場合
            } elseif ($val[0] !== "" && $val[1] !== "") {
                $val = sprintf("%02d",$val[0]).":".sprintf("%02d",$val[1]);
            } elseif ($val[0] !== "" && $val[1] === "") {
                $val = sprintf("%02d",$val[0]).":00";
            } elseif ($val[0] === "" && $val[1] !== "") {
                $val = "00:".sprintf("%02d",$val[1]);
            }
        // 配列じゃない場合（時刻以外）
        } else {
            if ($val === "" || $val === "0") {
                $val = null;
            } else {
                $val = $val;
            }
        }
        return $val;
    }

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }
    if (isset($_REQUEST["no"])) {
        $no         = $_REQUEST["no"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common         = new Common;         // 共通クラス
    $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
    $staff          = new Staff;          // 社員マスタクラス
    $staff2         = new Staff;
    $genba          = new Genba;
    $report         = new Report;
    $report2        = new Report;
    
    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    if ($act) {
        // var_dump($_POST);
        // exit;

        // チェックボックスにチェックされていたら停泊を登録
        for ($i=1;$i<=4;$i++) {
            if (!$_POST["ship_in_port_time".$i]) {
                $_POST["ship_in_port_time".$i]               = "停泊";
            }
            if (!$_POST["ship_out_port_time".$i]) {
                $_POST["ship_out_port_time".$i]              = "停泊";
            }
        }

        foreach ($_POST as $key => $value) {
            // 登録フラグ以外の項目登録
            if ($key != "act") {
                $report2->{"inp_".$key}              = valChange($value);           // 値整形
            }
        }

        // 登録
        $report3                  = new Report;
        $report3->inp_no          = str_replace("-","",$_POST["start_date"]).$table;
        // 既に登録されたデータがあるかチェック
        $report3->getReport($table);
        // 新規
        if (!$report3->oup_no) {
            // 報告書
            $report2->inp_no                            = str_replace("-","",$_POST["start_date"]).$table;
            $report2->inp_table                         = $table;
            $report2->inp_created                       = date("Y-m-d H:i:s");
            $report2->inp_created_id                    = $_SESSION["staff_id"];
            $report2->insertReport($table);

            // 管理
            $report3                                    = new Report;
            $report3->inp_no                            = $report2->oup_last_id;
            $report3->inp_plan_date                     = $_POST["start_date"];
            $report3->inp_table                         = $table;
            $report3->inp_name_no                       = $table;
            $report3->inp_kbn                           = $_POST["act"];
            $report3->inp_created                       = date("Y-m-d H:i:s");
            $report3->inp_created_id                    = $_SESSION["staff_id"];
            $report3->insertReport("kanri");

        // 更新
        } else {
            $report2->inp_no                          = $report3->oup_no[0];
            $report2->inp_modified                    = date("Y-m-d H:i:s");
            $report2->inp_modified_id                 = $_SESSION["staff_id"];
            $report2->updateReport($table);

            // 管理
            $report2                                  = new Report;
            $report2->inp_no                          = $report3->oup_no[0];
            $report2->inp_kbn                         = $_POST["act"];
            $report2->inp_modified                    = date("Y-m-d H:i:s");
            $report2->inp_modified_id                 = $_SESSION["staff_id"];
            $report2->updateReport("kanri");
        }

        if ($_SESSION["menu_flg"] == "kanri") {
            header("Location:keibihokoku.php");
        } else {
            header("Location:report_menu.php");
        }
        exit;

    }

    // 登録済データ取得
    if ($no) {
        $report3                    = new Report;
        $report3->inp_no            = $no;
        $report3->getReport($table);

        if ($report3->oup_no) {
            // ReportTableで定義したテーブル項目をループ
            foreach (ReportTable::${"report".$table} as $key => $value) {
                if ($value == "table") {
                    continue;
                }
                // 時刻（checkboxの項目以外）
                if (strpos($value,"time") !== false && strpos($report3->{"oup_".$value}[0],":") !== false) {
                    $array          = explode(":",$report3->{"oup_".$value}[0]);
                    ${$value}       = array($array[0],$array[1]);
                } elseif (strpos($value,"time") !== false && is_null($report3->{"oup_".$value}[0])) {
                    ${$value}       = array(null,null);
                } else {
                    // 時刻以外
                    ${$value}           = $report3->{"oup_".$value}[0];
                }
            }
        }
    }

    // 当日予定のある隊員取得
    $wkdetail->inp_t_wk_genba_id = "1";
    $wkdetail->inp_t_wk_plan_kbn_in = "'1','2','3'";
    $wkdetail->inp_t_wk_plan_date = str_replace("-","",$start_date);
    $wkdetail->inp_order = "order by t_wk_plan_joban_time";
    $wkdetail->getWkdetail();

    // 隊員取得
    if ($wkdetail->oup_t_wk_detail_no) {
        $cnt = 0;
        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            if ($i == 0) {
                $staff2->inp_m_staff_id_in = "'".$wkdetail->oup_t_wk_taiin_id[$i]."'";
            } else {
                $staff2->inp_m_staff_id_in = $staff2->inp_m_staff_id_in.",'".$wkdetail->oup_t_wk_taiin_id[$i]."'";
            }

            // // 勤務区分
            // $staff_kbn[$wkdetail->oup_t_wk_taiin_id[$i]] = $wkdetail->oup_t_wk_plan_kbn[$i];
        }
        
        $staff2->getStaff();

        // // 隊員が一人なら担当警備員にデフォルト表示
        // if (count($staff2->oup_m_staff_id) == 1) {
        //     $staff_id = $staff_id ? $staff_id : $staff2->oup_m_staff_id[0];
        // }

        for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) {
            $staff_name[$staff2->oup_m_staff_id[$i]] = $staff2->oup_m_staff_name[$i];

            // 勤務員の項目の隊員デフォルト表示
            $cnt = $cnt + 1;
            // データがある場合は取得したデータを、新規は予定が入っている隊員を表示
            ${"wk_staff_id".$cnt}         = $no ? ${"wk_staff_id".$cnt} : $staff2->oup_m_staff_id[$i];
        }
    }

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report5_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report5_html.php');
    }
?>
