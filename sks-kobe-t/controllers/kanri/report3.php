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
    $table                                  = 3;
    $weather1                               = null;
    $weather2                               = null;
    $weathers                               = array("晴","曇","雨","雪");
    $chief                                  = null;
    $staff_id                               = null;
    $start_date                             = date("Y-m-d");
    if ($_GET["plan_date"] != "") {
        $start_date                         = $_GET["plan_date"];
    }
    $haiti                                  = array("背後地","前面");
    for ($i=1;$i<=10;$i++) {
        ${"wk_haiti".$i}                    = null;
        ${"wk_staff_id".$i}                 = null;
        ${"wk_joban_time".$i}               = array(null,null);
        ${"wk_kaban_time".$i}               = array(null,null);
    }
    $detail                                 = array(3,2,6,7,3);
    $times                                  = array(
        "1"=>array("06","30"),"2"=>array("06","30"),"3"=>array("06","00"),
        "13"=>array("08","00"),"14"=>array("19","00"),"15"=>array("17","00"),
        "19"=>array("19","30"),"20"=>array("22","00"),"21"=>array("22","00")
    );
    $cnt    = 0;
    for ($i=0;$i<count($detail);$i++) {
        for ($j=0;$j<$detail[$i];$j++) {
            $cnt = $cnt + 1;
            ${"wk_detail_time".$cnt}                    = $times[$cnt] ? array($times[$cnt][0],$times[$cnt][1]) : array(null,null);
            ${"wk_detail_staff_id".$cnt}                = null;
        }
    }
    $wk_detail_comment1                                 = null;
    $wk_detail_comment4                                 = null;
    $wk_detail_comment6                                 = null;
    $wk_detail_comment12                                = null;
    $wk_detail_comment19                                = null;
    $wk_detail_title17                                  = null;
    $wk_detail_title18                                  = null;
    $title                                  = array(
        array(
            "column"=>"開錠",
            "row"=>array(
                "外周",
                "200倉庫",
                "300倉庫"
            )
        ),
        array("column"=>"午前巡回","row"=>array("200倉庫1階","200倉庫4階")),
        array("column"=>"午後巡回","row"=>array("300倉庫北事務所","300倉庫車路","300倉庫2階","300倉庫3階","300倉庫4階","300倉庫南事務所")),
        array("column"=>"退出確認","row"=>array("住友倉庫","神港作業","樽喜梱包","全日検","藤原運輸","","")),
        array("column"=>"施錠","row"=>array("200倉庫","300倉庫","外周"))
    );
    $night_company                          = null;
    $night_exit_time                        = array(null,null);
    $night_taiin_id                         = null;
    $night_staff_id                         = null;

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
            if ($val[0] !== "" && $val[1] !== "") {
                $val = $val[0].":".$val[1];
            } elseif ($val[0] !== "" && $val[1] === "") {
                $val = $val[0].":00";
            } elseif ($val[0] === "" && $val[1] !== "") {
                $val = "00:".$val[1];
            }
        // 配列じゃない場合（時刻以外）
        } else {
            if ($val === "0") {
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
        foreach ($_POST as $key => $value) {
            // 登録フラグ以外の項目登録
            if ($key != "act") {
                // 値が空ならNULLで登録
                if ((!is_array($value) && $value === "") || (is_array($value) && $value[0] === "" && $value[1] === "")) {
                    $report2->{"inp_".$key}                 = null;
                } else {
                    // 値が空じゃない場合
                    $report2->{"inp_".$key}          = valChange($value);  // 整形function
                    // var_dump($key,valChange($value));
                }
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
            foreach (ReportTable::$report3 as $key => $value) {
                if ($value != "table") {
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
    }

    // 当日予定のある隊員取得
    $wkdetail->inp_t_wk_genba_id2       = "'11','41'";
    $wkdetail->inp_t_wk_plan_kbn        = "2";
    $wkdetail->inp_t_wk_plan_hosoku_in  = "'A','B','C','D','土'";
    $wkdetail->inp_t_wk_plan_date       = str_replace("-","",$start_date);
    $wkdetail->inp_order                = "order by t_wk_plan_joban_time";
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
        }
        
        $staff2->getStaff();

        // 隊員が一人なら担当警備員にデフォルト表示
        if (count($staff2->oup_m_staff_id) == 1) {
            $staff_id = $no ? $staff_id : $staff2->oup_m_staff_id[0];
        }

        for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) {
            $staff_name[$staff2->oup_m_staff_id[$i]] = $staff2->oup_m_staff_name[$i];

            // 勤務員の項目の隊員デフォルト表示
            if ($i == 0) {
                // 夜間退出記録氏名　SKS対応者
                $night_taiin_id                          = $no ? $night_taiin_id : null;
            }
            if ($cnt != 21) {
                $cnt = $cnt + 1;
                // データがある場合は取得したデータを、新規は予定が入っている隊員を表示
                if ($cnt <= 10) {
                    // 守衛者
                    ${"wk_staff_id".$cnt}                = $no ? ${"wk_staff_id".$cnt} : $staff2->oup_m_staff_id[$i];
                }
                // 日常記録
                ${"wk_detail_staff_id".$cnt}             = $no ? ${"wk_detail_staff_id".$cnt} : null;
            }
        }
    }

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report3_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report3_html.php');
    }
?>
