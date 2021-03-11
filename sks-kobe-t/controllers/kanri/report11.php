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

    function getWeek($day) {
        $week = array("日", "月", "火", "水", "木", "金", "土");
        if ($day) {
            return $week[date("w", strtotime(date($day)))];
        } else {
            return null;
        }
    }
    // function getDates($day2) {
    //     if ($day2 && strpos($day2,"-") !== false) {
    //         $array = explode("-",$day2);
    //         return array($array[0],$array[1],$array[2]);
    //     } else {
    //         return array(null,null,null);
    //     }
    // }
    function getYear($day) {
        if ($day && strpos($day,"-") !== false) {
            return substr($day,0,4);
        } else {
            return null;
        }
    }
    function getMonth($day) {
        if ($day && strpos($day,"-") !== false) {
            return substr($day,5,2);
        } else {
            return null;
        }
    }
    function getDay($day) {
        if ($day && strpos($day,"-") !== false) {
            return substr($day,8,2);
        } else {
            return null;
        }
    }
    // $week = array("日", "月", "火", "水", "木", "金", "土");
    // $time = strtotime(date($date));
    // $time2 = strtotime(date($date2));
    // $w = date("w", $time);
    // $w2 = date("w", $time2);

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

    // 初期値
    $table                                  = 11;
    $kanri                                  = "kanri";
    $act                                    = NULL;
    $no                                     = NULL;
    // $plan_date                              = date("Y-m-d");
    $start_date                             = date("Y-m-d");
    $end_date                               = date("Y-m-d",strtotime($start_date." +1 day"));
    $joban_time                             = array("08","00");
    $kaban_time                             = array("08","00");
    $weather1                               = null;
    $weather2                               = null;
    $weathers                               = array("晴","曇","雨","雪");
    $staff_id                               = null;
    for ($i=1;$i<=5;$i++) {
        // ${"patrol_time".($i+1)}      = null;
        // ${"patrol_time".$i}[0]      = null;
        // ${"patrol_time".$i}[1]      = null;
        ${"patrol_time".$i}                 = array(null,null);
        ${"bath".$i}                        = null;
        ${"sip".$i}                         = null;
        ${"in_port_time".$i}                = array(null,null);
        ${"out_port_time".$i}               = array(null,null);
    }
    $baths                                  = array("C-6","C-7");
    // $yard  = null;
    // $yards = array("作業","常夜","街路");
    $yard                                   = array("","常夜","街路");
    $yard1_start_time                       = array(null,null);
    $yard1_end_time                         = array(null,null);
    $yard2_start_time                       = array(null,null);
    $yard2_end_time                         = array(null,null);
    $front_gate_start_time                  = array("08","30");
    $front_gate_end_time                    = array("17","00");
    $east_gate_start_time                   = array("08","30");
    $east_gate_end_time                     = array("16","30");
    $west_gate_start_time                   = array("08","30");
    $west_gate_end_time                     = array("16","30");
    $cam_time                               = array("20","00");
    $cam_text                               = "異常なし";
    $over_time_num                          = null;
    $over_time_name                         = null;
    $over_start_time                        = array("17","00");
    $over_end_time                          = array("17","30");
    $fence_time                             = array("18","00");
    $fence_text                             = "異常なし";
    $etc_comment1                           = "なし";
    $etc_comment2                           = null;
    $plan_kbn                               = array("泊","日","夜");
    for ($i=1;$i<=18;$i++) {
        ${"wk_staff_id".$i}                 = null;
    }
    // $wk_taiin = array(
    //     array("泊","t"),
    //     array("日","n"),
    //     array("夜","y")
    // );
    // for ($i=0;$i<3;$i++) {
    //     for ($j=0;$j<6;$j++) {
    //         ${"wk_".$kbn[$i][0]."_staff_id".($j+1)} = null;
    //     }
    // }

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }
    if (isset($_GET["no"])) {
        $no        = $_GET["no"];
    }

    // var_dump($report);

    // $report->inp_no = "1";
    // $report->inp_plan_date = $date;
    // $report->getReport($table);
    // var_dump($report->oup_no);
    
    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    if ($act) {
        // var_dump($_POST["out_port_time1"]);
        // exit;
        for ($i=1;$i<=5;$i++) {
            if (!$_POST["in_port_time".$i]) {
                // $_POST["in_port_time".$i][0]                     = "99";
                // $_POST["in_port_time".$i][1]                     = "99";
                $_POST["in_port_time".$i]                        = "停泊";
            }
            if (!$_POST["out_port_time".$i]) {
                // $_POST["out_port_time".$i][0]                    = "99";
                // $_POST["out_port_time".$i][1]                    = "99";
                $_POST["out_port_time".$i]                       = "停泊";
            }
        }
        // var_dump($_POST);
        // exit;

        foreach ($_POST as $key => $value) {
            // 値がなければnullを登録
            if (!$value) {
                // continue;
                $report->{"inp_".$key}                 = null;
            // 値が空ではない場合
            } else {
                if ($key == "act") {
                    continue;
                } elseif ($key == "yard") {
                    $val = $_POST[$key][0];
                    for ($i=0;$i<count($_POST[$key]);$i++) {
                        if ($i == 0) {
                            continue;
                        }
                        $val .= ",".$_POST[$key][$i];
                    }
                    $report->{"inp_".$key}              = $val;
                } elseif (is_array($value) && strpos($key,"time") !== false) {
                    if ($value[0] && $value[1]) {
                        $report->{"inp_".$key}          = sprintf("%02d",$value[0]).":".sprintf("%02d",$value[1]);
                    } else {
                        // continue;
                        $report->{"inp_".$key}          = null;
                    }
                } else {
                    $report->{"inp_".$key}              = $value;
                }
            }
        }
        
        if (!$_POST["no"]) {
            $report3                                       = new Report;
            $report3->inp_no                               = str_replace("-","",$_POST["start_date"]).$table;
            // $report3->inp_start_date                    = $_POST["start_date"];
            // $report3->inp_table                         = $table;
            $report3->getReport($table);
            if ($report3->oup_no) {
                $report->inp_no                            = $report3->oup_no[0];
                $report->inp_modified                      = date("Y-m-d H:i:s");
                $report->inp_modified_id                   = $_SESSION["staff_id"];
                $report->updateReport($table);
            } else {
                $report->inp_no                            = str_replace("-","",$_POST["start_date"]).$table;
                $report->inp_table                         = $table;
                $report->inp_created                       = date("Y-m-d H:i:s");
                $report->inp_created_id                    = $_SESSION["staff_id"];
                $report->insertReport($table);
            }
        } else {
            $report->inp_modified                      = date("Y-m-d H:i:s");
            $report->inp_modified_id                   = $_SESSION["staff_id"];
            $report->updateReport($table);
        }

        // 管理マスタ登録
        $report2        = new Report;
        $report2->inp_plan_date                             = $_POST["start_date"];
        $report2->inp_table                                 = $table;
        $report2->inp_name_no                               = $table;
        $report2->inp_kbn                                   = $_POST["act"];
        if (!$_POST["no"]) {
            $report3                                        = new Report;
            $report3->inp_no                                = str_replace("-","",$_POST["start_date"]).$table;
            // $report3->inp_plan_date                     = $_POST["start_date"];
            // $report3->inp_table                         = $table;
            $report3->getReport($kanri);
            if ($report3->oup_no) {
                $report2->inp_no                             = $report3->oup_no[0];
                // $report2->inp_table_no                       = $report3->oup_table_no[0];
                $report2->inp_modified                       = date("Y-m-d H:i:s");
                $report2->inp_modified_id                    = $_SESSION["staff_id"];
                $report2->updateReport($kanri);
            } else {
                $report2->inp_no                             = $report->oup_last_id;
                // $report2->inp_table_no                       = $report->oup_last_id;
                $report2->inp_created                        = date("Y-m-d H:i:s");
                $report2->inp_created_id                     = $_SESSION["staff_id"];
                $report2->insertReport($kanri);
            }
        } else {
            $report2->inp_no                             = $_POST["no"];
            // $report2->inp_table_no                       = $_POST["no"];
            $report2->inp_modified                       = date("Y-m-d H:i:s");
            $report2->inp_modified_id                    = $_SESSION["staff_id"];
            $report2->updateReport($kanri);
        }

        if ($_SESSION["menu_flg"] == "kanri") {
            header("Location:keibihokoku.php");
        } else {
            header("Location:report_menu.php");
        }
        exit;
    }

    if ($no) {
        $report3                    = new Report;
        $report3->inp_no            = $no;
        $report3->getReport($table);

        // $plan_date                  = $report3->oup_plan_date[0];

        if ($report3->oup_no) {
            foreach (ReportTable::$report11 as $k => $v) {
                // var_dump($v);
                // var_dump($report3->{"oup_".$v}[0]);
                if (strpos($v,"wk_staff") !== false) {
                    continue;
                }
                if (strpos($v,"date") !== false && !$report3->{"oup_".$v}[0]) {
                    continue;
                }
                if ($v == "over_time_num" || $v == "over_time_name") {
                    ${$v}      = $report3->{"oup_".$v}[0];
                    continue;
                }
                if (strpos($v,"time") !== false) {
                    if (strpos($report3->{"oup_".$v}[0],":") !== false) {
                        $array      = explode(":",$report3->{"oup_".$v}[0]);
                        ${$v}      = array($array[0],$array[1]);
                    } else {
                        if ($report3->{"oup_".$v}[0] == "停泊") {
                            ${$v}      = $report3->{"oup_".$v}[0];
                        } else {
                            ${$v}      = array(null,null);
                        }
                        // ${$v}      = array(null,null);
                    }
                    continue;
                }
                if ($v == "yard") {
                    if (strpos($report3->{"oup_".$v}[0],",") !== false) {
                        $array      = explode(",",$report3->{"oup_".$v}[0]);
                        for ($i=0;$i<count($array);$i++) {
                            if ($i == 0) {
                                ${$v}      = array($array[$i]);
                            } else {
                                ${$v}[]      = $array[$i];
                            }
                        }
                    } else {
                        ${$v}      = array($report3->{"oup_".$v}[0]);
                    }
                    continue;
                }
                ${$v}      = $report3->{"oup_".$v}[0];
            }
        }
    }
    
    // // 子現場取得
    // $genba->inp_m_genba_oya_id = "4";
    // $genba->getGenba();

    // // 当日予定のあるデータ取得
    // $wkdetail->inp_t_wk_genba_id2 = "'4'";
    // // 子現場があれば子現場のデータも取得
    // if ($genba->oup_m_genba_id) {
    //     for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
    //         $wkdetail->inp_t_wk_genba_id2 = $wkdetail->inp_t_wk_genba_id2.",'".$genba->oup_m_genba_id[$i]."'";
    //     }
    // }
    $wkdetail->inp_t_wk_genba_id        = "4";
    $wkdetail->inp_t_wk_plan_hosoku     = 1;
    $wkdetail->inp_t_wk_plan_kbn_in     = "'1','2','3'";
    $wkdetail->inp_t_wk_plan_date       = str_replace("-","",$start_date);
    $wkdetail->inp_order                = "order by t_wk_plan_joban_time";
    $wkdetail->getWkdetail();

    // 隊員取得
    if ($wkdetail->oup_t_wk_detail_no) {
        $t_cnt = 0;
        $n_cnt = 6;
        $y_cnt = 12;
        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            if ($i == 0) {
                $staff2->inp_m_staff_id_in = "'".$wkdetail->oup_t_wk_taiin_id[$i]."'";
            } else {
                $staff2->inp_m_staff_id_in = $staff2->inp_m_staff_id_in.",'".$wkdetail->oup_t_wk_taiin_id[$i]."'";
            }

            // 勤務員の項目の隊員デフォルト表示
            if ($wkdetail->oup_t_wk_plan_kbn[$i] == "1" && $t_cnt != 6) {
                $t_cnt = $t_cnt+1;
                if (!$no) {
                    ${"wk_staff_id".$t_cnt} = $wkdetail->oup_t_wk_taiin_id[$i];
                } else {
                    ${"wk_staff_id".$t_cnt} = $report3->{"oup_wk_staff_id".$t_cnt}[0];
                }
            }
            if ($wkdetail->oup_t_wk_plan_kbn[$i] == "2" && $n_cnt != 12) {
                $n_cnt = $n_cnt+1;
                if (!$no) {
                    ${"wk_staff_id".$n_cnt} = $wkdetail->oup_t_wk_taiin_id[$i];
                } else {
                    ${"wk_staff_id".$n_cnt} = $report3->{"oup_wk_staff_id".$n_cnt}[0];
                }
            }
            if ($wkdetail->oup_t_wk_plan_kbn[$i] == "3" && $y_cnt != 18) {
                $y_cnt = $y_cnt+1;
                if (!$no) {
                    ${"wk_staff_id".$y_cnt} = $wkdetail->oup_t_wk_taiin_id[$i];
                } else {
                    ${"wk_staff_id".$y_cnt} = $report3->{"oup_wk_staff_id".$y_cnt}[0];
                }
            }
        }
        
        $staff2->getStaff();

        // 隊員が一人なら担当警備員にデフォルト表示
        if (count($staff2->oup_m_staff_id) == 1) {
            $staff_id = $staff_id ? $staff_id : $staff2->oup_m_staff_id[0];
        }

        for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) {
            $staff_name[$staff2->oup_m_staff_id[$i]] = $staff2->oup_m_staff_name[$i];
        }
    }
    // $staff2->getStaff();

    // var_dump($_SESSION);
?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report11_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report11_html.php');
    }
?>
