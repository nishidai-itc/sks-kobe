<?php
    session_start();

// var_dump($_SESSION);
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../models/common/common.php');        // 共通クラス
    require_once('../models/common/db.php');            // DBクラス
    require_once('../models/Worktype.php');             // 作業種類開始クラス
    require_once('../models/Staff.php');                // 社員クラス
    require_once('../models/sagyojissekisyurui_class.php');         // 作業実績種類クラス
    require_once('../models/sagyojissekikoutuhi_class.php');        // 作業実績交通費クラス
    require_once('../models/Work.php');                 // 作業開始クラス
    require_once('../models/User.php');                 // 利用者クラス
    require_once('../models/Company.php');              // 会社クラス

    $equal      = NULL;
    $act        = NULL;
    $sumvalue   = NULL;
    $week       = array("日", "月", "火", "水", "木", "金", "土");
    $time       = strtotime(date('Y-m-d'));
    $w          = date("w", $time);
    $run_end_time = date('H:i');
    $_SESSION["run_end_time"] = $run_end_time;

    // 交通費
    $move_cost_yen = NULL;
    $move_cost_kilo =NULL;
    $move_cost_etc = NULL;

    // コメント
    $inp_t_work_comment = NULL;
    $alert_kbn        = NULL;

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $worktype   = new Worktype;     // 作業種類マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $sagyojissekisyurui     = new Sagyojissekisyurui;       // 作業実績種類クラス
    $sagyojissekikoutuhi    = new Sagyojissekikoutuhi;      // 作業実績交通費クラス
    $work       = new Work;         // 作業実施テーブルクラス
    $work2      = new Work;         // 作業実施テーブルクラス
    $user       = new User;         // 利用者クラス
    $company    = new Company;      // 会社マスタクラス

    // 会社マスタの取得
    $company->getCompany();

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
        $run_end_time   = $common->html_decode($_POST["run_end_time"]);
        $ido            = $common->html_decode($_POST["ido"]);
        $keido          = $common->html_decode($_POST["keido"]);
        $equal          = $common->html_decode($_POST["equal"]);
        $move_cost_yen  = $common->html_decode($_POST["move_cost_yen"]);
        $move_cost_kilo = $common->html_decode($_POST["move_cost_kilo"]);
        $move_cost_etc  = $common->html_decode($_POST["move_cost_etc"]);
        $inp_t_work_comment = $common->html_decode($_POST["t_work_comment"]);
    }
    if (isset($_POST["alert_kbn"])) {
        $alert_kbn= $_POST["alert_kbn"];
    }

    // 作業種類の件数
    if (isset($_POST["syurui_cnt"])) {
        $syurui_cnt = $_POST["syurui_cnt"];
        $sumvalue   = 0;
        for($i=0;$i<$syurui_cnt;$i++) {
            if ($equal == "1") {
                $sumvalue = $sumvalue + $_POST["T2".$i];
            } else {
                $sumvalue = $sumvalue + intval($_POST["T".$i]);
            }
        }
    }

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();


    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_stop_kbn      = "0";
    $work->inp_t_work_visitor_id    = $_SESSION["staff_id"];

    // 作業実施テーブル 取得
    $work->getWork();


    // 作業予定サービステーブル 取得 に必要な情報をセット
    $work2->inp_t_work_plan_service_no      = $work->oup_t_work_no[0];

    // 作業予定サービステーブル 取得
    $work2->getWorkplanservice();


    // 利用者 取得 に 必要な情報をセット
    $user->inp_m_user_id = $_SESSION["m_user_id"];

    // 利用者 取得
    $user->getUser();


    if (count($work2->oup_t_work_plan_service_no) == 0) {

        // 作業種類マスタ 取得
        $worktype->getWorktype();
    }

    // 画面上の決定ボタンが押された場合
    if ($act == "1") {

        $_SESSION["accomplishment_flg"] = "";
        $_SESSION["ido"] = $ido;
        $_SESSION["keido"] = $keido;

        // 入力内容のチェック に必要な情報をセット
        $sagyojissekisyurui->inp_sumvalue  = $sumvalue;       // 合計

        // 作業予定と同じの場合（入力チェックは行わない）
        if ($equal == "1") {
            $_SESSION["accomplishment_flg"] = "1";
        } else {
            // 入力内容のチェック
            $sagyojissekisyurui->inputCheck();
        }

        // 入力内容のチェックでエラーが無い場合
        if ($sagyojissekisyurui->errmsg == "") {
            for($i=0;$i<$syurui_cnt;$i++) {
                if ($equal == "1") {
                    $sagyojissekisyurui->inp_t = $_POST["T2".$i];
                } else {
                    $sagyojissekisyurui->inp_t = $_POST["T".$i];
                }
            }
        }

        // 入力内容のチェック に必要な情報をセット
        $sagyojissekikoutuhi->inp_move_cost_yen = $move_cost_yen;       // 交通費
        $sagyojissekikoutuhi->inp_move_cost_kilo= $move_cost_kilo;      // 移動距離

        // 入力内容のチェック
        $sagyojissekikoutuhi->inputCheck();

        // 入力内容のチェックでエラーが無い場合
        if ($sagyojissekisyurui->errmsg == "") {

            // 入力内容のチェックでエラーが無い場合
            if ($sagyojissekikoutuhi->errmsg == "") {

                for($i=0;$i<$syurui_cnt;$i++) {
                    if ($equal == "1") {
                        $_SESSION["T".$i] = $_POST["T2".$i];
                    } else {
                        $_SESSION["T".$i] = $_POST["T".$i];
                    }
                }
                $_SESSION["syurui_cnt"]     = $syurui_cnt;
                $_SESSION["sumvalue"]       = $sumvalue;
                $_SESSION["move_cost_yen"]  = $move_cost_yen;
                $_SESSION["move_cost_kilo"] = $move_cost_kilo;
                $_SESSION["move_cost_etc"]  = $move_cost_etc;
                $_SESSION["comment"]        = $inp_t_work_comment;
                $_SESSION["alert_kbn"]      = $alert_kbn;

                // キャリア判定（PC/スマートフォン/タブレット）
                if ($common->judgephone) {
                    if($company->oup_m_company_kiroku_kbn[0] == "1") {
                        // HTML表示
                        header('Location:../controllers/servicekiroku.php');
                    } else {
                        // HTML表示
                        header('Location:../controllers/sagyojissekicomp.php');
                    }
                // キャリア判定（フィーチャーフォン）
                } else {
                    if($company->oup_m_company_kiroku_kbn[0] == "1") {
                        // HTML表示
                        header("Location:../controllers/servicekiroku.php?".SID);
                    } else {
                        // HTML表示
                        header("Location:../controllers/sagyojissekicomp.php?".SID);
                    }
                }

                exit();
            }
        }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/sagyojissekisyuruiinput_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/sagyojissekisyuruiinput_html.php');
    }
?>
