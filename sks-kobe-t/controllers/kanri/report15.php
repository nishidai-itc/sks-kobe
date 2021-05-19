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
    $table                                  = 15;
    $start_date                             = date("Y-m-d");
    if ($_GET["plan_date"] != "") {
        $start_date                         = $_GET["plan_date"];
    }
    $dis_date                               = $start_date;
    for ($i=1;$i<=10;$i++) {
        if ($i < 8) {
            ${"wharf_contents".$i}          = null;
        }
        ${"patrol_staff_id".$i}             = null;
        ${"patrol_time".$i}                 = array(null,null);
        ${"sensor_select".$i}               = null;
        ${"camera_select".$i}               = null;
    }
    $select = array("1"=>"有","2"=>"無");
    $dis_staff_id                           = null;
    $dis_place                              = null;
    $dis_contents                           = null;
    $etc_contents                           = null;
    $checkCon1 = array(
        "1"=>"①コンテナ搬出入出口門扉",
        "2"=>"②外周フェンス（西側）",
        "3"=>"③外周フェンス（南側）",
        "4"=>"④外周フェンス（100M延長部分）",
        "5"=>"⑤PC15～17岸壁（東向き）",
        "6"=>"⑥PC15岸壁（北向き）",
        "7"=>"⑦外周フェンス（PC-14境界）",
        "8"=>"⑧外周フェンス（空ﾊﾞﾝエリア北側）",
        "9"=>"⑨外周フェンス（空ﾊﾞﾝエリア西側）",
        "10"=>"⑩外周フェンス（空ﾊﾞﾝエリア南側）",
        "11"=>"⑪上屋外周及び上屋外周フェンス（上屋南側）",
        "12"=>"⑫PC-15～17ヤード各レーン間",
        "13"=>"⑬空ﾊﾞﾝエリアメンテエリア付近",
        "14"=>"⑭その他の場所、Fヤード外周フェンスおよびヤード内",
        // "15"=>"",
        // "16"=>"",
        // "17"=>"",
        // "18"=>"",
        // "19"=>"",
        // "20"=>"",
        // "21"=>"",
    );
    $checkCon2 = array(
        "1"=>"（赤外線検知センサー発報、監視カメラによるヤード内異状）",
        "2"=>"発見者",
        "3"=>"発見日時",
        "4"=>"発見場所",
        "5"=>"発見内容",
        "6"=>"",
        "7"=>"",
        "8"=>"",
        "9"=>"その他何かあれば記載してください",
        "10"=>"",
        "11"=>"",
        "12"=>"",
        "13"=>"",
        "14"=>""
    );
    $checkCon3 = array(
        "1"=>"埠頭設備点検表",
        "2"=>"障壁、扉",
        "3"=>"監視カメラ",
        "4"=>"遠隔操作部",
        "5"=>"映像表示部",
        "6"=>"記録・再生部",
        "7"=>"赤外線センサー",
        "8"=>"照明塔、投光器等"
    );

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
        $no        = $_REQUEST["no"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common         = new Common;         // 共通クラス
    $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
    $staff          = new Staff;          // 社員マスタクラス
    $staff2         = new Staff;
    // $staff3         = new Staff;
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
        // exit();

        foreach ($_POST as $key => $value) {
            // var_dump($key,$value);
            
            // 登録フラグ以外の項目登録
            if ($key != "act") {
                // // 警備員登録　勤務区分、補足文字と隊員IDに分ける
                // if (strpos($key,"wk_staff_id") !== false) {
                //     if (strpos($value,",") !== false) {
                //         $array = explode(",",$value);
                //         $report2->{"inp_".$key}               = $array[1];
                //         $report2->{"inp_".str_replace("_id","",$key)."_kbn"}        = $array[0];
                //         // $report2->{"inp_".str_replace("_id","",$key)."_ken"}        = $array[2];
                //     } else {
                //         $report2->{"inp_".$key}               = null;
                //         $report2->{"inp_".str_replace("_id","",$key)."_kbn"}        = null;
                //         // $report2->{"inp_".str_replace("_id","",$key)."_ken"}        = null;
                //     }
                //     continue;
                // }
                
                $report2->{"inp_".$key}              = valChange($value);
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
                if (strpos($value,"time") !== false) {
                    if (strpos($report3->{"oup_".$value}[0],":") !== false) {
                        $array          = explode(":",$report3->{"oup_".$value}[0]);
                        ${$value}       = array($array[0],$array[1]);
                    } elseif (is_null($report3->{"oup_".$value}[0])) {
                        ${$value}       = array(null,null);
                    } else {
                        ${$value}       = $report3->{"oup_".$value}[0];
                    }
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
    $wkdetail->inp_order = "order by case
    when t_wk_plan_kbn = '1' and t_wk_plan_kensyu = '' then 1
    when t_wk_plan_kbn = '2' and t_wk_plan_kensyu = '' then 2
    when t_wk_plan_kbn = '3' and t_wk_plan_hosoku != '巡' and t_wk_plan_kensyu = '' then 3
    when t_wk_plan_kbn = '3' and t_wk_plan_hosoku = '巡' and t_wk_plan_kensyu = '' then 4
    when t_wk_plan_kbn = '1' and t_wk_plan_kensyu != '' then 5
    when t_wk_plan_kbn = '2' and t_wk_plan_kensyu != '' then 6
    else 7 end";
    $wkdetail->getWkdetail();

    $kbnMark                          = array("1"=>"泊","2"=>"日","3"=>"夜");

    // 隊員取得
    if ($wkdetail->oup_t_wk_detail_no) {
        $cnt = 0;
        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            // 勤務員の項目の隊員デフォルト表示
            if ($cnt != 10) {
                $cnt = $cnt + 1;
                // データがある場合は取得したデータを、新規は予定が入っている隊員を表示
                ${"patrol_staff_id".$cnt}         = $no ? ${"patrol_staff_id".$cnt} : $wkdetail->oup_t_wk_taiin_id[$i];
            }
        }
    }

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report15_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report15_html.php');
    }
?>
