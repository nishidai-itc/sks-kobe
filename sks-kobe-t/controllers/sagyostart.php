<?php
    require_once('../models/common/common.php');        // 共通クラス
    require_once('../models/common/db.php');            // DBクラス
    require_once('../models/sagyostart_class.php');     // 作業開始クラス
    require_once('../models/Work.php');                 // 作業開始クラス
    require_once('../models/Company.php');                // 会社クラス
    require_once('../models/Staff.php');                // 社員クラス
    require_once('../models/User.php');                 // 利用者クラス

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $sagyostart = new Sagyostart;   // 作業開始クラス
    $work       = new Work;         // 作業実施テーブルクラス
    $company    = new Company;      // 会社マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $user       = new User;         // 利用者クラス

    // 会社マスタの取得
    $company->getCompany();
?>
<?php
    session_start();
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        if (!isset($_GET["staff_id"])) {
            // HTML表示
            header('Location:../controllers/login.php');
            exit();
        } else {
            // 存在チェック
            // 社員マスタ 取得 に必要な情報をセット
            //
            $staff->inp_m_staff_id = $_GET["staff_id"];

            // 社員マスタ 取得
            $staff->getStaff();

            if ($staff->oup_m_staff_name[0] == "") {
                // HTML表示
                header('Location:../controllers/login.php');
                exit();
            }
            $_SESSION["staff_id"] = $_GET["staff_id"];
        }
    }
?>
<?php
    // 変数の初期化
    $act        = NULL;
    $run_start_time       = date('H:i');
    $rest_reason = NULL;
    $m_user_id = NULL;
    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    if (isset($_POST["act"])) {
        $act        = $common->html_decode($_POST["act"]);
        $rest_reason   = $common->html_decode($_POST["rest_reason"]);
        $run_start_time  = $common->html_decode($_POST["run_start_time"]);
        $ido        = $common->html_decode($_POST["ido"]);
        $keido        = $common->html_decode($_POST["keido"]);
    }
    if (isset($_GET["m_user_id"])) {
        $_SESSION["m_user_id"] = $_GET["m_user_id"];
    }

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_stop_kbn      = "0";
    $work->inp_t_work_visitor_id    = $_SESSION["staff_id"];

    // 作業実施テーブル 取得
    $work->getWork();

    // 作業実施データが取得できた場合（作業開始データ登録済み）
    if ($setting->workinputmode=="startend") {
        if (count($work->oup_t_work_no[0]) != 0) {
            // メニュー画面に遷移する
            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/menu.php');
            } else {
                // HTML表示
                header("Location:../controllers/menu.php?".SID);
            }
        }
    }

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 利用者 取得 に 必要な情報をセット
    $user->inp_m_user_id = $_SESSION["m_user_id"];

    // 利用者 取得
    $user->getUser();

    switch ($act) {
        // 画面上の決定ボタンが押された場合
        case 1:

            if ($sagyostart->errmsg == "") {

                // 作業実施登録 に必要な情報をセット
//                $work->inp_t_work_office_id = $_SESSION["office_id"];
                $work->inp_t_work_user_id = $_SESSION["m_user_id"];
                $work->inp_t_work_plan_start_date = '';
                $work->inp_t_work_plan_start_time = '';
                $work->inp_t_work_plan_end_time = '';
                $work->inp_t_work_plan_id = '';
                $work->inp_t_work_run_start_date = date('Y-m-d');
                $work->inp_t_work_run_start_time = date('Hi');
                $work->inp_t_work_start_latitude_position = $ido;
                $work->inp_t_work_start_longitude_position = $keido;
                $work->inp_t_work_run_end_time = '';
                $work->inp_t_work_run_time = '';
                $work->inp_t_work_end_latitude_position = '';
                $work->inp_t_work_end_longitude_position = '';
                $work->inp_t_work_stop_kbn = '0';
                $work->inp_t_work_visitor_id = $_SESSION["staff_id"];
                $work->inp_t_work_alert_kbn = '';
                $work->inp_t_work_comment = '';
                $work->inp_t_work_rest_reason = '';
                $work->inp_t_work_move_cost_yen = '';
                $work->inp_t_work_move_cost_kilo = '';
                $work->inp_t_work_move_cost_etc = '';
                $work->inp_t_work_run_kbn = '1';
                $work->inp_t_work_modifi_kbn = '0';
                $work->inp_t_work_ok_flg = '0';
                $work->inp_t_work_created = date('Y-m-d H:i:s');
                $work->inp_t_work_created_staffid = $_SESSION["staff_id"];
                $work->inp_t_work_modified = date('Y-m-d H:i:s');
                $work->inp_t_work_modified_staffid = $_SESSION["staff_id"];

                // データ登録
                $work->insertWork();

                $_SESSION["work_no"] = $work->oup_last_id;

                // キャリア判定（PC/スマートフォン/タブレット）
                if ($judgephone->judge) {
                    // HTML表示
                    header('Location:../controllers/menu.php');
                // キャリア判定（フィーチャーフォン）
                } else {
                    // HTML表示
                    header("Location:../controllers/menu.php?".SID);
                }

            }

            break;
        // 画面上の休暇連絡ボタンが押された場合
        case 2:

            // 休暇連絡 登録 に必要な情報をセット
            $sagyostart->inp_rest_reason    = $rest_reason;

            // 入力チェック
            $sagyostart->inputCheck();

            if ($sagyostart->errmsg == "") {

                // 利用者さん 登録 に必要な情報をセット
//                $work->inp_t_work_office_id = $_SESSION["office_id"];
                $work->inp_t_work_user_id = $_SESSION["m_user_id"];
                $work->inp_t_work_plan_start_date = '';
                $work->inp_t_work_plan_start_time = '';
                $work->inp_t_work_plan_end_time = '';
                $work->inp_t_work_plan_id = '';
                $work->inp_t_work_run_start_date = date('Y-m-d');
                $work->inp_t_work_run_start_time = date('Hi');
                $work->inp_t_work_start_latitude_position = $ido;
                $work->inp_t_work_start_longitude_position = $keido;
                $work->inp_t_work_run_end_time = '';
                $work->inp_t_work_run_time = '';
                $work->inp_t_work_end_latitude_position = '';
                $work->inp_t_work_end_longitude_position = '';
                $work->inp_t_work_stop_kbn = '2';
                $work->inp_t_work_visitor_id = $_SESSION["staff_id"];
                $work->inp_t_work_alert_kbn = '';
                $work->inp_t_work_comment = '';
                $work->inp_t_work_rest_reason = $rest_reason;
                $work->inp_t_work_move_cost_yen = '';
                $work->inp_t_work_move_cost_kilo = '';
                $work->inp_t_work_move_cost_etc = '';
                $work->inp_t_work_run_kbn = '1';
                $work->inp_t_work_modifi_kbn = '0';
                $work->inp_t_work_ok_flg = '0';
                $work->inp_t_work_created = date('Y-m-d H:i:s');
                $work->inp_t_work_created_staffid = $_SESSION["staff_id"];
                $work->inp_t_work_modified = date('Y-m-d H:i:s');
                $work->inp_t_work_modified_staffid = $_SESSION["staff_id"];

                // データ登録
                $work->insertWork();

                // キャリア判定（PC/スマートフォン/タブレット）
                if ($common->judgephone) {
                    // HTML表示
                    header('Location:../controllers/menu.php');
                // キャリア判定（フィーチャーフォン）
                } else {
                    // HTML表示
                    header("Location:../controllers/menu.php?".SID);
                }

            }

            break;

        // 画面上の作業報告しますボタンが押された場合
        case 3:

            // 休暇連絡 登録 に必要な情報をセット
            $sagyostart->inp_rest_reason    = $rest_reason;

            // 入力チェック
            $sagyostart->inputCheck();

            if ($sagyostart->errmsg == "") {

                // 利用者さん 登録 に必要な情報をセット
//                $work->inp_t_work_office_id = $_SESSION["office_id"];
                $work->inp_t_work_user_id = $_SESSION["m_user_id"];
                $work->inp_t_work_plan_start_date = '';
                $work->inp_t_work_plan_start_time = '';
                $work->inp_t_work_plan_end_time = '';
                $work->inp_t_work_plan_id = '';
                $work->inp_t_work_run_start_date = date('Y-m-d');
                $work->inp_t_work_run_start_time = date('Hi');
                $work->inp_t_work_start_latitude_position = $ido;
                $work->inp_t_work_start_longitude_position = $keido;
                $work->inp_t_work_run_end_time = date('Hi');
                $work->inp_t_work_run_time = '';
                $work->inp_t_work_end_latitude_position = '';
                $work->inp_t_work_end_longitude_position = '';
                $work->inp_t_work_stop_kbn = '3';
                $work->inp_t_work_visitor_id = $_SESSION["staff_id"];
                $work->inp_t_work_alert_kbn = '0';
                $work->inp_t_work_comment = $rest_reason;
                $work->inp_t_work_rest_reason = '';
                $work->inp_t_work_move_cost_yen = '';
                $work->inp_t_work_move_cost_kilo = '';
                $work->inp_t_work_move_cost_etc = '';
                $work->inp_t_work_run_kbn = '1';
                $work->inp_t_work_modifi_kbn = '0';
                $work->inp_t_work_ok_flg = '0';
                $work->inp_t_work_created = date('Y-m-d H:i:s');
                $work->inp_t_work_created_staffid = $_SESSION["staff_id"];
                $work->inp_t_work_modified = date('Y-m-d H:i:s');
                $work->inp_t_work_modified_staffid = $_SESSION["staff_id"];

                // データ登録
                $work->insertWork();

                // キャリア判定（PC/スマートフォン/タブレット）
                if ($common->judgephone) {
                    // HTML表示
                    header('Location:../controllers/menu.php');
                // キャリア判定（フィーチャーフォン）
                } else {
                    // HTML表示
                    header("Location:../controllers/menu.php?".SID);
                }

            }

            break;
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // 簡単入力区分 = 1 の場合、実績を入力しない。
        if ($company->oup_m_company_simple_kbn[0] = "1") {
            require_once('../views/sagyostartsimple_html.php');
        } else {
            // HTML表示
            require_once('../views/sagyostart_html.php');
        }
    // キャリア判定（フィーチャーフォン）
    } else {
        if ($company->oup_m_company_simple_kbn[0] = "1") {
            require_once('../views/m/sagyostartsimple_html.php');
        } else {
            // HTML表示
            require_once('../views/m/sagyostart_html.php');
        }
    }

?>
