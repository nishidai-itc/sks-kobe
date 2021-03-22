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
    $table                                  = 1;
    $weather1                               = null;
    $weather2                               = null;
    $weathers                               = array("晴","曇","雨","雪");
    $staff_id                               = null;
    $start_date                             = date("Y-m-d");
    if ($_GET["plan_date"] != "") {
        $start_date                         = $_GET["plan_date"];
    }
    $end_date                               = date("Y-m-d",strtotime($start_date." +1 day"));
    $joban_time                             = array("08","00");
    $kaban_time                             = array("08","00");
    $port                                   = array("停泊","順延");
    for ($i=1;$i<=10;$i++) {
        ${"wk_ship".$i}                     = null;
        ${"wk_ship_in_port_time".$i}        = array(null,null);
        ${"wk_ship_out_port_time".$i}       = array(null,null);
    }
    $wk_in_out_start_time                   = array(null,null);
    $wk_in_out_end_time                     = array(null,null);
    $wk_joban_time                          = array(null,null);
    $wk_kaban_time                          = array(null,null);
    $wk_vp_end_time                         = array(null,null);
    $wk_vp_kaban_time                       = array(null,null);
    $koyo_joban_time                        = array(null,null);
    $koyo_kaban_time                        = array(null,null);
    $sumii_joban_time                       = array(null,null);
    $sumii_kaban_time                       = array(null,null);
    $last_exit                              = null;
    $last_exit1                             = array(null,null);
    $last_exit2                             = array(null,null);
    $yard_on_time1                          = array(null,null);
    $yard_off_time1                         = array(null,null);
    $yard_on_time2                          = array(null,null);
    $yard_off_time2                         = array(null,null);

    $array                                  = array(
        array(array("07","00"),array("08","00"),null,null),                 // 共同デポ
        array(array("07","30"),array("08","00"),null,null),                 // PC15.16.17　並び
        array(array("17","00"),array(null,null),null,null),                 // PC15.16.17　CY
        // array(array("17","00"),array("18","00"),"1","1.25"),             // 専用道白出口
        array(array("17","00"),array("17","30"),null,null),                 // VP作業
        array(array("12","00"),array("13","00"),null,null),                 // 昼作業
        array(array("17","00"),array("18","00"),null,null),                 // ゲート延長
        array(array("17","00"),array(null,null),null,null),                 // Mバース
        array(array("17","00"),array(null,null),null,null),                 // T字立哨
        array(array("17","00"),array(null,null),null,null),                 // 空前立哨
        array(array("17","00"),array(null,null),null,null),                 // 岸壁立哨
        array(array("17","00"),array(null,null),null,null)                  // 分別立哨
    );
    $tokki = array(
        array(
            // "title"=>"・早出➀共同デポ",
            "title"=>"・早出➀",
            "name"=>array("depo_joban_time","depo_kaban_time","depo_num","depo_zan")
        ),
        array(
            // "title"=>"・早出➁PC15.16.17　並び",
            "title"=>"・早出➁",
            "name"=>array("sort_joban_time","sort_kaban_time","sort_num","sort_zan")
        ),
        array(
            "title"=>"・PC15.16.17　CY",
            "name"=>array("cy_joban_time","cy_kaban_time","cy_num","cy_zan")
        ),
        // array(
        //     "title"=>"・専用道白出口",
        //     "name"=>array("exit_joban_time","exit_kaban_time","exit_num","exit_zan")
        // ),
        array(
            "title"=>"・VP作業",
            "name"=>array("vp_joban_time","vp_kaban_time","vp_num","vp_zan")
        ),
        array(
            "title"=>"・昼作業",
            "name"=>array("midday_joban_time","midday_kaban_time","midday_num","midday_zan")
        ),
        array(
            "title"=>"・ゲート延長",
            "name"=>array("gate_joban_time","gate_kaban_time","gate_num","gate_zan")
        ),
        array(
            "title"=>"・Mバース",
            "name"=>array("mbath_joban_time","mbath_kaban_time","mbath_num","mbath_zan")
        ),
        array(
            "title"=>"・T字立哨",
            "name"=>array("picket_joban_time1","picket_kaban_time1","picket_num1","picket_zan1")
        ),
        array(
            "title"=>"・空前立哨",
            "name"=>array("picket_joban_time2","picket_kaban_time2","picket_num2","picket_zan2")
        ),
        array(
            "title"=>"・岸壁立哨",
            "name"=>array("picket_joban_time3","picket_kaban_time3","picket_num3","picket_zan3")
        ),
        array(
            "title"=>"・分別立哨",
            "name"=>array("picket_joban_time4","picket_kaban_time4","picket_num4","picket_zan4")
        )
    );
    for ($i=0;$i<count($tokki);$i++) {
        for ($j=0;$j<4;$j++) {
            ${$tokki[$i]["name"][$j]}           = $array[$i][$j];
        }
    }

    $comment = "巡回点検異常ありません";
    // $title                            = array("1"=>"➀","2"=>"➁","3"=>"➂","4"=>"➃","5"=>"➄","6"=>"➅","7"=>"➆","8"=>"➇");
    // $times                            = array("1"=>array("19","00"),"2"=>array("21","00"),"3"=>array("23","00"),"4"=>array("01","00"),"5"=>array("03","00"),"6"=>array("05","00"),"7"=>array(null,null),"8"=>array(null,null));
    // for ($i=1;$i<=8;$i++) {
    //     ${"patrol_time".$i}           = array($times[$i][0],$times[$i][1]);
    // }
    $meterb1                          = null;
    $meterb2                          = null;
    $meterc1                          = null;
    $meterc2                          = null;
    $wk_kbn                           = array("➀","➁","C","白","V","昼","ゲ","M","T","岸","分");
    for ($i=1;$i<=18;$i++) {
        ${"wk_staff".$i."_zan1"}      = null;
        ${"wk_staff".$i."_zan2"}      = null;
        ${"wk_staff_id".$i}           = null;
    }
    $wk_comment                       = null;

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

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }
    if (isset($_REQUEST["no"])) {
        $no        = $_REQUEST["no"];
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

    $staff2->getStaff();
    for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) {
        $staff_name[$staff2->oup_m_staff_id[$i]] = $staff2->oup_m_staff_name[$i];
    }

    if ($act) {
        // var_dump($_POST);
        // exit;

        // // チェックボックスにチェックされていたら停泊を登録
        // for ($i=1;$i<=9;$i++) {
        //     if (!$_POST["wk_ship_in_port_time".$i]) {
        //         $_POST["wk_ship_in_port_time".$i]               = "停泊";
        //     }
        //     if (!$_POST["wk_ship_out_port_time".$i]) {
        //         $_POST["wk_ship_out_port_time".$i]              = "停泊";
        //     }
        // }

        foreach ($_POST as $key => $value) {
            // var_dump($key,$value);
            
            // 値が空ならNULLで登録
            if ((!is_array($value) && $value === "") || (is_array($value) && $value[0] === "" && $value[1] === "")) {
                $report2->{"inp_".$key}                 = null;
                continue;
            }

            // 値が空じゃない場合
            // 登録フラグ以外の項目登録
            if ($key != "act") {
                // 時刻の場合（時：分が空ならNULL、片方が空なら00を登録）
                if (is_array($value) && (strpos($key,"time") !== false || strpos($key,"last_exit") !== false)) {
                    if ($value[0] !== "" && $value[1] !== "") {
                        $report2->{"inp_".$key}          = sprintf("%02d",$value[0]).":".sprintf("%02d",$value[1]);  // 時刻整形
                    } elseif ($value[0] !== "" && $value[1] === "") {
                        $report2->{"inp_".$key}          = sprintf("%02d",$value[0]).":00";
                    } elseif ($value[0] === "" && $value[1] !== "") {
                        $report2->{"inp_".$key}          = "00:".sprintf("%02d",$value[1]);
                    }
                    continue;
                }

                // 時刻以外
                $report2->{"inp_".$key}              = $value === "0" ? null : $value ;
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
            foreach (ReportTable::$report1 as $key => $value) {
                if ($value == "table") {
                    continue;
                }
                // 最終退出者
                if (strpos($value,"last_exit") !== false) {
                    if (strpos($report3->{"oup_".$value}[0],":") !== false) {
                        $array          = explode(":",$report3->{"oup_".$value}[0]);
                        ${$value}       = array($array[0],$array[1]);
                    } else {
                        ${$value}       = array(null,null);
                    }
                    continue;
                }
                // 時刻（checkboxの項目以外）
                if (strpos($value,"time") !== false && strpos($report3->{"oup_".$value}[0],":") !== false) {
                    $array          = explode(":",$report3->{"oup_".$value}[0]);
                    ${$value}       = array($array[0],$array[1]);
                    continue;
                }
                if (strpos($value,"time") !== false && is_null($report3->{"oup_".$value}[0])) {
                    ${$value}       = array(null,null);
                    continue;
                }

                // 時刻以外
                ${$value}           = $report3->{"oup_".$value}[0];
            }
        }
    }

    // 当日予定のある隊員取得
    $wkdetail->inp_t_wk_genba_id = "6";
    $wkdetail->inp_t_wk_plan_kbn_in = "'1','2','3'";
    $wkdetail->inp_t_wk_plan_date = str_replace("-","",$start_date);
    $wkdetail->inp_order = "order by t_wk_plan_kbn,t_wk_plan_joban_time";
    $wkdetail->getWkdetail();

    $kbnMark                          = array("1"=>"◎","2"=>"〇","3"=>"－");

    // 隊員取得
    if ($wkdetail->oup_t_wk_detail_no) {
        $cnt = 0;
        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            // 勤務員の項目の隊員デフォルト表示
            if ($cnt != 18) {
                $cnt = $cnt + 1;
                // データがある場合は取得したデータを、新規は予定が入っている隊員を表示
                ${"wk_staff_id".$cnt}         = $no ? ${"wk_staff_id".$cnt} : $wkdetail->oup_t_wk_taiin_id[$i];
            }
        }

        // 隊員が一人なら担当警備員にデフォルト表示
        if (count($wkdetail->oup_t_wk_detail_no) == 1) {
            $staff_id = $no ? $staff_id : $wkdetail->oup_t_wk_taiin_id[0];
        }
    }

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report1_html.php');
    }
?>
