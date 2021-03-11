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
    require_once('../models/Worktype.php');               // 作業種類開始クラス
    require_once('../models/Work.php');                   // 作業開始クラス
    require_once('../models/work_regist_class.php');      // 作業登録クラス

    $act              = NULL;
    $run_start_date= NULL;
    $run_start_time= NULL;
    $run_end_time= NULL;
    $move_cost_yen= NULL;
    $move_cost_kilo= NULL;
    $move_cost_etc= NULL;
    $comment        = NULL;

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }
    if (isset($_POST["user_id"])) {
        $user_id        = $_POST["user_id"];
    }
    if (isset($_POST["run_start_date"])) {
        $run_start_date = $_POST["run_start_date"];
    }
    if (isset($_POST["run_start_date_yy"])) {
        $run_start_date_yy = $_POST["run_start_date_yy"];
    }
    if (isset($_POST["run_start_date_mm"])) {
        $run_start_date_mm = $_POST["run_start_date_mm"];
    }
    if (isset($_POST["run_start_date_dd"])) {
        $run_start_date_dd = $_POST["run_start_date_dd"];
    }
    if ((isset($_POST["run_start_date_yy"])) || (isset($_POST["run_start_date_mm"])) || (isset($_POST["run_start_date_dd"]))) {
        $run_start_date = $run_start_date_yy."-".$run_start_date_mm."-".$run_start_date_dd;
    }
    if (isset($_POST["run_start_time_hh"])) {
        $run_start_time_hh= $_POST["run_start_time_hh"];
    }
    if (isset($_POST["run_start_time_mm"])) {
        $run_start_time_mm= $_POST["run_start_time_mm"];
    }
    if (isset($_POST["run_end_time_hh"])) {
        $run_end_time_hh= $_POST["run_end_time_hh"];
    }
    if (isset($_POST["run_end_time_mm"])) {
        $run_end_time_mm= $_POST["run_end_time_mm"];
    }
    if (isset($_POST["run_time"])) {
        $run_time= $_POST["run_time"];
    }
    if (isset($_POST["syurui_cnt"])) {
        $syurui_cnt = $_POST["syurui_cnt"];
        $sumvalue   = 0;
        for($i=0;$i<$syurui_cnt;$i++) {
            $sumvalue = $sumvalue + $_POST["T".$i];
        }
    }
    if (isset($_POST["sumvalue"])) {
        $sumvalue= $_POST["sumvalue"];
    }
    if (isset($_POST["move_cost_yen"])) {
        $move_cost_yen= $_POST["move_cost_yen"];
    }
    if (isset($_POST["move_cost_kilo"])) {
        $move_cost_kilo= $_POST["move_cost_kilo"];
    }
    if (isset($_POST["move_cost_etc"])) {
        $move_cost_etc= $_POST["move_cost_etc"];
    }
    if (isset($_POST["alert_kbn"])) {
        $alert_kbn= $_POST["alert_kbn"];
    }
    if (isset($_POST["comment"])) {
        $comment= $_POST["comment"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $user     = new User;       // 利用者クラス
    $worktype   = new Worktype;       // 作業種類マスタクラス
    $work       = new Work;           // 作業実施テーブルクラス
    $workregist   = new Workregist;   // 作業登録クラス

    // 利用者マスタ 取得 に必要な情報をセット
    $user->inp_t_staff_user_list_staff_id = $_SESSION["staff_id"];

    // 利用者 取得
    $user->getStaffUser();

    // 作業種類マスタ 取得
    $worktype->getWorktype();

    switch ($act) {

        case 1:

            $workregist->inp_user_id = $user_id;
            $workregist->inp_run_start_date= $run_start_date;
            $workregist->inp_run_start_time_hh= $run_start_time_hh;
            $workregist->inp_run_start_time_mm= $run_start_time_mm;
            $workregist->inp_run_end_time_hh= $run_end_time_hh;
            $workregist->inp_run_end_time_mm= $run_end_time_mm;
            $workregist->inp_run_time= $run_time;

            // 入力内容のチェック
            $workregist->inputCheck();

            // 入力内容のチェックでエラーが無い場合
            if ($workregist->errmsg == "") {

                // セッションに情報をセット
                $_SESSION["user_id"] = $user_id;
                $_SESSION["run_start_date"] = $run_start_date;
                $_SESSION["run_start_date_yy"] = $run_start_date_yy;
                $_SESSION["run_start_date_mm"] = $run_start_date_mm;
                $_SESSION["run_start_date_dd"] = $run_start_date_dd;
                $_SESSION["run_start_time_hh"] = $run_start_time_hh;
                $_SESSION["run_start_time_mm"] = $run_start_time_mm;
                $_SESSION["run_end_time_hh"] = $run_end_time_hh;
                $_SESSION["run_end_time_mm"] = $run_end_time_mm;
                $_SESSION["run_time"] = $run_time;
                for($i=0;$i<$syurui_cnt;$i++) {
                    $_SESSION["T".$i] = $_POST["T".$i];
                }
                $_SESSION["syurui_cnt"] = $syurui_cnt;
                $_SESSION["sumvalue"] = $sumvalue;
                $_SESSION["move_cost_yen"] = $move_cost_yen;
                $_SESSION["move_cost_kilo"] = $move_cost_kilo;
                $_SESSION["move_cost_etc"] = $move_cost_etc;
                $_SESSION["alert_kbn"] = $alert_kbn;
                $_SESSION["comment"] = $comment;
                $_SESSION["back"] = "work_modify.php";

                // キャリア判定（PC/スマートフォン/タブレット）
                if ($common->judgephone) {
                    // HTML表示
                    header('Location:../controllers/work_conf.php');
                // キャリア判定（フィーチャーフォン）
                } else {
                    // HTML表示
                    header("Location:../controllers/work_conf.php?".SID);
                }

            }

            break;

        // 初期表示
        default:

            // 作業実施テーブル 取得 に必要な情報をセット
            $work->inp_t_work_no = $_SESSION["work_no"];

            // 作業実施テーブル 取得
            $work->getWork();

            // 作業実施サービステーブル 取得 に必要な情報をセット
            $work->inp_t_work_service_no = $_SESSION["work_no"];

            // 作業実施テーブル 取得
            $work->getWorkservice();

            // 取得内容を変数にセット
            $user_id        = $work->oup_t_work_user_id[0];
            $run_start_date= $work->oup_t_work_run_start_date[0];
            $run_start_date_yy= substr($work->oup_t_work_run_start_date[0],0,4);
            $run_start_date_mm= substr($work->oup_t_work_run_start_date[0],5,2);
            $run_start_date_dd= substr($work->oup_t_work_run_start_date[0],8,2);
            $run_start_time= $work->oup_t_work_run_start_time[0];
            $run_end_time= $work->oup_t_work_run_end_time[0];
            $move_cost_yen= $work->oup_t_work_move_cost_yen[0];
            $move_cost_kilo= $work->oup_t_work_move_cost_kilo[0];
            $move_cost_etc= $work->oup_t_work_move_cost_etc[0];
            $comment = $work->oup_t_work_comment[0];

            break;
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/work_modify_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/work_modify_html.php');
    }
?>

