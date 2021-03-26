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
  
  $act                            = NULL;
  $no                             = NULL;
  $table                          = 6;
  $weather1                       = null;
  $weather2                       = null;
  $weathers                       = array("晴","曇","雨","雪");
  $staff_id                       = null;
  $start_date                     = date("Y-m-d");
  if ($_GET["plan_date"] != "") {
    $start_date                   = $_GET["plan_date"];
  }
  $end_date                       = $start_date;
  $joban_time                     = array("08","00");
  $kaban_time                     = array("17","00");
  $wk_start_time1                 = array("07","30");
  $wk_end_time1                   = array("18","00");
  $wk_start_time2                 = array("07","30");
  $wk_end_time2                   = array("18","00");
  $wk_start_time3                 = array("07","30");
  $wk_end_time3                   = array("18","00");
  $offwk_count                    = null;
  // $off_start_time                 = array("07","30");
  // $off_end_time                   = array("08","00");
  $outsider                       = null;


  $comment                        = "巡回点検警備その他服務中異状ありません";
  $times                          = array("1"=>array("08","00"),"2"=>array("12","00"),"3"=>array("13","00"),"4"=>array("16","30"));
  $title                          = array("A","B","C","D");
  for ($i=1;$i<=4;$i++) {
    ${"wk_staff_id".$i}           = null;
  }
  
  // $week           = array("日", "月", "火", "水", "木", "金", "土");
  // $time           = strtotime(date($date));
  // $w              = date("w", $time);
  function getWeek($day) {
    $week = array("日", "月", "火", "水", "木", "金", "土");
    if ($day) {
        return $week[date("w", strtotime(date($day)))];
    } else {
        return null;
    }
  }

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
  $wkdetail2       = new Wkdetail;
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
    foreach ($_POST as $key => $value) {
      if ($key != "act") {
        $report2->{"inp_".$key}               = valChange($value);
      }
    }

    // 登録
    $report3                  = new Report;
    $report3->inp_no          = str_replace("-","",$_POST["start_date"]).$table;
    $report3->getReport($table);
    // 新規
    if (!$report3->oup_no) {
      // 報告書
      $report2->inp_no                            = str_replace("-","",$_POST["start_date"]).$table;
      $report2->inp_table                         = $table;
      $report2->inp_created                       = date("Y-m-d H:i:s");
      $report2->inp_created_id                    = $_SESSION["staff_id"];
      require_once('../../models/common/reportLog.php');
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
      require_once('../../models/common/reportLog.php');      
      $report3->insertReport("kanri");
    } else {
      if ($no) {
        $report2->inp_no                          = $no;
        $report2->inp_modified                    = date("Y-m-d H:i:s");
        $report2->inp_modified_id                 = $_SESSION["staff_id"];
        require_once('../../models/common/reportLog.php');        
        $report2->updateReport($table);

        // 管理
        $report3                                  = new Report;
        $report3->inp_no                          = $no;
        // $report3->inp_plan_date                   = $_POST["start_date"];
        // $report3->inp_table                       = $table;
        // $report3->inp_name_no                     = $table;
        $report3->inp_kbn                         = $_POST["act"];
        $report3->inp_modified                    = date("Y-m-d H:i:s");
        $report3->inp_modified_id                 = $_SESSION["staff_id"];
        require_once('../../models/common/reportLog.php');
        $report3->updateReport("kanri");
      } else {
      }
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

    if ($report3->oup_no) {
      foreach (ReportTable::$report6 as $k => $key) {
        if (strpos($key,"time") !== false) {
          // 時刻
          if (strpos($report3->{"oup_".$key}[0],":") !== false) {
            $array        = explode(":",$report3->{"oup_".$key}[0]);
            ${$key}       = array($array[0],$array[1]);
          } elseif (is_null($report3->{"oup_".$key}[0])) {
            ${$key}       = array(null,null);
          }
        } else {
          // 時刻以外
          ${$key}         = $report3->{"oup_".$key}[0];
        }
      }
    }
  }

  $wkdetail->inp_t_wk_genba_id      = "1";
  $wkdetail->inp_t_wk_plan_hosoku_in   = "'神','5'";
  $wkdetail->inp_t_wk_plan_kbn      = "2";
  $wkdetail->inp_t_wk_plan_date     = str_replace("-","",$start_date);
  $wkdetail->inp_order              = "order by t_wk_plan_kbn,t_wk_plan_joban_time";
  $wkdetail->getWkdetail();

  $wkdetail2->inp_t_wk_genba_id      = "1";
  $wkdetail2->inp_t_wk_plan_kbn_in      = "'1','2','3'";
  $wkdetail2->inp_t_wk_plan_date     = str_replace("-","",$start_date);
  $wkdetail2->inp_order              = "order by t_wk_plan_kbn,t_wk_plan_joban_time";
  $wkdetail2->getWkdetail();

  $plan_kbn = array("1"=>"泊","2"=>"日","3"=>"夜");
  $plan_ken = array("1"=>"研");

  // 隊員取得
  if ($wkdetail->oup_t_wk_detail_no) {
    $cnt = 0;
    for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {

      // 勤務員の項目の隊員デフォルト表示
      if ($cnt != 2) {
        $cnt = $cnt + 1;
        ${"wk_staff_id".$cnt}         = $no ? ${"wk_staff_id".$cnt} : $wkdetail->oup_t_wk_taiin_id[$i];
      }
    }

    // 隊員が一人なら担当警備員にデフォルト表示
    if (count($wkdetail->oup_t_wk_detail_no) == 1) {
      $staff_id = $no ? $staff_id : $wkdetail->oup_t_wk_taiin_id[0];
    }
  }

  // if ($wkdetail2->oup_t_wk_detail_no) {
  //   $cnt = 2;
  //   for ($i=0;$i<count($wkdetail2->oup_t_wk_detail_no);$i++) {

  //     // // 勤務員の項目の隊員デフォルト表示
  //     // if ($cnt != 4) {
  //     //   $cnt = $cnt + 1;
  //     //   ${"wk_staff_id".$cnt}         = $no ? ${"wk_staff_id".$cnt} : $wkdetail2->oup_t_wk_taiin_id[$i];
  //     // }
  //   }
  // }

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report6_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report6_html.php');
    }
?>