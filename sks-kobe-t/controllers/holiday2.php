<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Holiday.php');                 // 祝日マスタクラス


    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    
    
    //登録ボタンを押したとき
    if (isset($_REQUEST["act"])) {
        $act       = $_REQUEST["act"];
        
        
        $holiday_no = $_REQUEST["holiday_no"];
        $holiday_date = $_REQUEST["holiday_date"];
        $holiday_name = $_REQUEST["holiday_name"];

    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $staff      = new Staff;        // 社員マスタクラス
    $holiday      = new Holiday;        // 祝日マスタクラス
    $holiday2     = new Holiday;        // 祝日マスタクラス



    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    if ($act == "") {
        if (isset($_REQUEST["no"])) {
            // 祝日マスタ取得
            $holiday->inp_holiday_no = $_REQUEST["no"];
            $holiday->getHoliday();

        }
    }

    // 「登録」ボタンが押された場合
    if ($act == "1") {
    
            //holiday_noがREQUESTされていなければ、新規
            if ($holiday_no == "") {

                $holiday->inp_date = $holiday_date;
                $holiday->inp_hol_name    = $holiday_name;

                // データ登録
                $holiday->insertHoliday();

            } else {
            
           //holiday_noがREQUESTされていれば、更新
                $holiday->up_holiday_id     = $holiday_no;
                $holiday->up_holiday_date  = $holiday_date;
                $holiday->up_holiday_name  = $holiday_name;


                // データ更新
                $holiday->updateHoliday();
            }

            header('Location:holiday1.php');

    }
    
    if ($act == "2") {

        $holiday2->delete_holiday_id     = $holiday_no;

        // データ削除
        $holiday2->deleteHoliday();

        header('Location:holiday1.php');
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/holiday2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/holiday2_html.php');
    }
?>
