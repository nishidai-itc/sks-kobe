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
  
  $act            = NULL;
  $weather        = null;
  $weathers       = array(
    "1"=>"晴",
    "2"=>"曇",
    "3"=>"雨",
    "4"=>"雪"
  );
  $staff_id       = null;
  $date           = date("Y-m-d");
  $date2          = date("Y-m-d",strtotime($date." +1 day"));
  $dates          = explode("-",$date);
  $dates2         = explode("-",$date2);
  $joban_time     = array(
    "08",
    "00"
  );
  $kaban_time     = array(
    "08",
    "00"
  );
  
  $week = array("日", "月", "火", "水", "木", "金", "土");
  $time = strtotime(date($date));
  $time2 = strtotime(date($date2));
  $w = date("w", $time);
  $w2 = date("w", $time2);

  if (isset($_POST["act"])) {
    $act        = $_POST["act"];
  }

  /*********************************************************
   *	クラスの作成
    ********************************************************/
  $common     = new Common;         // 共通クラス
  $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
  $staff      = new Staff;          // 社員マスタクラス
  $staff2      = new Staff;
  
  // 社員マスタ 取得 に必要な情報をセット
  $staff->inp_m_staff_id = $_SESSION["staff_id"];

  // 社員マスタ 取得
  $staff->getStaff();

  $staff2->getStaff();
?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report10_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report10_html.php');
    }
?>