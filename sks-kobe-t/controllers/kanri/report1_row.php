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
    $tokki = array(
        array("・共同デポ","07","00","08","00","2","1"),
        array("・PC15.16.17　並び","07","30","08","00","2","0.5"),
        array("・PC15.16.17　CY","17","00","","","",""),
        array("・専用道白出口","17","00","18","00","1","1.25"),
        array("・VP作業","17","00","17","30","2","0.75"),
        array("・昼作業","12","00","13","00","8","1"),
        array("・ゲート延長","17","00","18","00","1","1.25"),
        array("・Mバース","17","00","","","","")
    );
    $num = array(
        array("➀","19","00"),
        array("➁","21","00"),
        array("➂","23","00"),
        array("➃","01","00"),
        array("➄","03","00"),
        array("➅","05","00"),
        array("➆","",""),
        array("➇","","")
    );
    $kinmu = array("","デ","デゲ","並","✓","白","並✓");

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($date));
    $time2 = strtotime(date($date2));
    $w = date("w", $time);
    $w2 = date("w", $time2);

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
        require_once('../../views/kanri/report1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report1_html.php');
    }
?>
