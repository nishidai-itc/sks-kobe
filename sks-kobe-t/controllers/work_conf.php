<?php
    session_start();
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/User.php');                   // 利用者クラス
    require_once('../models/Work.php');                 // 作業開始クラス
    require_once('../models/Worktype.php');               // 作業種類開始クラス

    $act        = NULL;

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }
    $user_id= $_SESSION["user_id"];
    if ($_SESSION["run_start_date"] == "") {
        $run_start_date= $_SESSION["run_start_date_yy"] . "-" . $_SESSION["run_start_date_mm"] . "-" . $_SESSION["run_start_date_dd"];
    } else {
        $run_start_date= $_SESSION["run_start_date"];
    }
    $run_start_date_yy= $_SESSION["run_start_date_yy"];
    $run_start_date_mm= $_SESSION["run_start_date_mm"];
    $run_start_date_dd= $_SESSION["run_start_date_dd"];
    $run_start_time_hh= $_SESSION["run_start_time_hh"];
    $run_start_time_mm= $_SESSION["run_start_time_mm"];
    $run_end_time_hh= $_SESSION["run_end_time_hh"];
    $run_end_time_mm= $_SESSION["run_end_time_mm"];
    $run_time= $_SESSION["run_time"];
    for($i=0;$i<$_SESSION["syurui_cnt"];$i++) {
        $T[$i] = $_SESSION["T".$i];
    }
    $syurui_cnt= $_SESSION["syurui_cnt"];
    $sumvalue= $_SESSION["sumvalue"];
    $move_cost_yen= $_SESSION["move_cost_yen"];
    $move_cost_kilo= $_SESSION["move_cost_kilo"];
    $move_cost_etc= $_SESSION["move_cost_etc"];
    $alert_kbn= $_SESSION["alert_kbn"];
    $comment= $_SESSION["comment"];
    $rest_reason= $_SESSION["rest_reason"];
    $stop_kbn= $_SESSION["stop_kbn"];
    if (isset($_SESSION["back"])) {
        $back        = $_SESSION["back"];
    } else {
        $back        = "work_regist.php";
    }

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($run_start_date));
    $w = date("w", $time);

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $worktype   = new Worktype;       // 作業種類マスタクラス
    $user     = new User;       // 利用者クラス
    $work   = new Work;     // 作業実施テーブルクラス

    // 利用者マスタ 取得 に必要な情報をセット
    $user->inp_t_staff_user_list_staff_id = $_SESSION["staff_id"];
    $user->inp_t_staff_user_list_user_id = $_SESSION["user_id"];

    // 利用者 取得
    $user->getStaffUser();

    // 作業種類マスタ 取得
    $worktype->getWorktype();

    // 画面上の決定ボタンが押された場合
    if ($act == "1") {

            // 作業実施登録 に必要な情報をセット
            $work->inp_t_work_office_id = $_SESSION["office_id"];
            $work->inp_t_work_user_id = $user_id;
            $work->inp_t_work_plan_start_date = '';
            $work->inp_t_work_plan_start_time = '';
            $work->inp_t_work_plan_end_time = '';
            $work->inp_t_work_plan_id = '';
            $work->inp_t_work_run_start_date = $run_start_date;
            $work->inp_t_work_run_start_time = $run_start_time_hh.$run_start_time_mm;
            $work->inp_t_work_run_end_time = $run_end_time_hh.$run_end_time_mm;
            $work->inp_t_work_run_time = '';
            $work->inp_t_work_stop_kbn = $stop_kbn;
            $work->inp_t_work_visitor_id = $_SESSION["staff_id"];
            $work->inp_t_work_alert_kbn = $alert_kbn;
            $work->inp_t_work_comment = $comment;
            $work->inp_t_work_rest_reason = $rest_reason;
            $work->inp_t_work_move_cost_yen = $move_cost_yen;
            $work->inp_t_work_move_cost_kilo = $move_cost_kilo;
            $work->inp_t_work_move_cost_etc = $move_cost_etc;
            $work->inp_t_work_run_kbn = '2';
            $work->inp_t_work_modifi_kbn = '0';
            $work->inp_t_work_ok_flg = '0';
            $work->inp_t_work_modified = date('Y-m-d H:i:s');
            $work->inp_t_work_modified_staffid = $_SESSION["staff_id"];

            // 新規登録の場合
            if ($back == "work_regist.php") {

                $work->inp_t_work_created = date('Y-m-d H:i:s');
                $work->inp_t_work_created_staffid = $_SESSION["staff_id"];

                // データ新規登録
                $work->insertWork();

            } else {

    			if ( $_SESSION["work_no"] != "" ) {

                    $work->inp_t_work_no = $_SESSION["work_no"];
                    $work->inp_t_work_service_no = $_SESSION["work_no"];

                    // データ更新
                    $work->updateWork();

                }

                // 作業実施テーブル削除
                $work->deleteWorkService();

                for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) {
                    // 作業実施テーブル登録 に必要な情報をセット
                    $work->inp_t_work_service_no = $_SESSION["work_no"];
                    $work->inp_t_work_service_type_cd = $worktype->oup_m_work_type_cd[$i];
                    $work->inp_t_work_service_type_item_cd = $worktype->oup_m_work_type_item_cd[$i];
                    $work->inp_t_work_service_time = $T[$i];
                    $work->inp_t_work_service_created = date('Y-m-d H:i:s');
                    $work->inp_t_work_service_created_staffid = $_SESSION["staff_id"];
                    $work->inp_t_work_service_modified = date('Y-m-d H:i:s');
                    $work->inp_t_work_service_modified_staffid = $_SESSION["staff_id"];

                    // 作業実施テーブル登録
                    $work->insertWorkService();
                }

                // セッション変数の破棄
                unset($_SESSION["work_no"]);
            }

            // セッション変数の破棄
            unset($_SESSION["run_start_date_yy"]);
            unset($_SESSION["run_start_date_mm"]);
            unset($_SESSION["run_start_date_dd"]);
            unset($_SESSION["run_start_time_hh"]);
            unset($_SESSION["run_start_time_mm"]);
            unset($_SESSION["run_time"]);
            for($i=0;$i<$_SESSION["syurui_cnt"];$i++) {
                unset($_SESSION["T".$i]);
            }
            unset($_SESSION["syurui_cnt"]);
            unset($_SESSION["sumvalue"]);
            unset($_SESSION["move_cost_yen"]);
            unset($_SESSION["move_cost_kilo"]);
            unset($_SESSION["move_cost_etc"]);
            unset($_SESSION["alert_kbn"]);
            unset($_SESSION["comment"]);
            unset($_SESSION["rest_reason"]);
            unset($_SESSION["stop_kbn"]);
            unset($_SESSION["back"]);

            // キャリア判定（PC/スマートフォン/タブレット）
            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/sagyojissekicomp.php');
            // キャリア判定（フィーチャーフォン）
            } else {
                // HTML表示
                header("Location:../controllers/sagyojissekicomp.php?".SID);
            }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/work_conf_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/work_conf_html.php');
    }

?>

