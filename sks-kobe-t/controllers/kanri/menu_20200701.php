<?php
    session_start();
    if (isset($_SESSION["nextpass"])) {
        if ($_SESSION["nextpass"] == "1") {
            setcookie("PHPSESSID", session_id(), time() + 60*60*24*7);
        }
    }
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:login.php');
    }
    
    if (isset($_SESSION["sday"])) {
        unset($_SESSION["sday"]);
    }
    if (isset($_SESSION["eday"])) {
        unset($_SESSION["eday"]);
    }
    if (isset($_SESSION["gid"])) {
        unset($_SESSION["gid"]);
    }
    if (isset($_SESSION["sid"])) {
        unset($_SESSION["sid"]);
    }
    if (isset($_SESSION["kkbn"])) {
        unset($_SESSION["kkbn"]);
    }
    if (isset($_SESSION["plan_kbn"])) {
        unset($_SESSION["plan_kbn"]);
        unset($_SESSION["plan_joban_time"]);
        unset($_SESSION["plan_kaban_time"]);
        unset($_SESSION["plan_hosoku"]);
        unset($_SESSION["genba_id2"]);
    }
    if (isset($_SESSION["alone"])) {
        unset($_SESSION["alone"]);
    }
    if (isset($_SESSION["chk_search"])) {
        unset($_SESSION["chk_search"]);
    }
//    if (isset($_SESSION["oyako"])) {
//        unset($_SESSION["oyako"]);
//    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Wkdetail.php');                   // 作業開始クラス
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/Company.php');                // 会社クラス
    require_once('../../models/Office.php');                 // 事業所クラス
    require_once('../../models/common/config.php');          // config クラス
    require_once('../../models/User.php');                 // 利用者クラス
    require_once('../../models/Tuti.php');                  // 通知クラス

    $updflg         = NULL;
    $act            = NULL;
    $work_no        = NULL;
    $run_end_time   = date('H:i');
    $todayworkflg   = NULL;
    $tmonthworkflg  = NULL;
    $nmonthworkflg  = NULL;

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;         // 共通クラス
    $work       = new Wkdetail;           // 作業実施テーブルクラス
    $staff      = new Staff;          // 社員マスタクラス
    $company    = new Company;        // 会社マスタクラス
    $office     = new Office;         // 事業所マスタクラス
    $todaywork  = new Wkdetail;           // 作業実施テーブルクラス
    $recentlywork = new Wkdetail;         // 作業実施テーブルクラス
    $setting    = new Setting;        // config クラス
    $user       = new User;         // 利用者クラス
    $work2      = new Wkdetail;         // 作業実施テーブルクラス
    $tuti      = new Tuti;        // 通知マスタクラス

    //通知メッセージ
    $today = date("Ymd");
    $tuti->inp_m_tuti_day = $today;
    $tuti->inp_m_tuti_msg2 = 1;
    $tuti->getTuti();
    for ($i=0;$i<count($tuti->oup_m_tuti_msg);$i++) {
        $tuti->oup_m_tuti_msg[$i] = nl2br($tuti->oup_m_tuti_msg[$i]);
    }
    
    // 会社マスタ 取得
    $company->getCompany();

    // 事業所マスタ 取得 に必要な情報をセット
    $office->inp_m_office_id = $_SESSION["office_id"];

    // 事業所マスタ 取得
    $office->getOffice();

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_stop_kbn      = "0";
    $work->inp_t_work_visitor_id    = $_SESSION["staff_id"];

    // 作業実施テーブル 取得
    $work->getWkdetail();

    // 作業実施データが取得できた場合
    if (count($work->oup_t_work_no[0]) != 0) {
        // 更新フラグをtrueにする
        $updflg = true;

		$_SESSION["work_no"]    = $work->oup_t_work_no[0];
        $_SESSION["m_user_id"]  = $work->oup_t_work_user_id[0];

        // 利用者 取得 に 必要な情報をセット
        $user->inp_m_user_id = $_SESSION["m_user_id"];

        // 利用者 取得
        $user->getUser();

        // 作業実施サービステーブル 取得 に必要な情報をセット
        $work2->inp_t_work_plan_service_no = $_SESSION["work_no"];

        // 作業実施テーブル 取得
        $work2->getWkplanservice();
    }

    // 作業実施テーブル 取得 に必要な情報をセット
    $todaywork->inp_t_work_taiin_id    = $_SESSION["staff_id"];
    $todaywork->inp_t_work_plan_date   = date('Ymd');
    $todaywork->inp_t_work_del_flg   = "0";

    // 作業実施テーブル 取得
    $todaywork->getWkdetail();
//print(count($todaywork->oup_t_work_no[0]));
    // 作業実施データが取得できた場合
    if (count($todaywork->oup_t_work_no[0]) != 0) {
        // 更新フラグをtrueにする
        $todayworkflg = true;
    }

    // 作業実施テーブル 取得 に必要な情報をセット
    $recentlywork->inp_t_work_plan_id    = $_SESSION["staff_id"];
    $recentlywork->inp_t_work_plan_start_date   = date('Ymd', strtotime("-7 day"  ));
    $recentlywork->inp_t_work_plan_end_date     = date('Ymd', strtotime("7 day"  ));

    // 作業実施テーブル 取得
    $recentlywork->getWkPlandaysum();

    // 作業実施データが取得できた場合
    if (count($recentlywork->oup_t_work_day_cnt[0]) != 0) {
        // 更新フラグをtrueにする
        $recentlyworkflg = true;

    }

    switch ($act) {
        // 画面上の「作業中止します」ボタンが押された場合
        case 1:

			if ( $work->oup_t_work_no[0] != "" ) {

	            // 作業実施テーブル 作業中止 登録 に必要な情報をセット
	            $work->inp_t_work_no        = $work->oup_t_work_no[0];
	            $work->inp_t_work_stop_kbn  = '1';
	            $work->inp_t_work_modified  = date('Y-m-d H:i:s');
	            $work->inp_t_work_modified_staffid = $_SESSION["staff_id"];

	            // データ更新
	            $work->updateWork();

			}

            // セッション変数の破棄
            unset($_SESSION["work_no"]);

            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/menu.php');
            } else {
                // HTML表示
                header("Location:../controllers/menu.php?".SID);
            }

            break;

        // 画面上の「作業をやり直します」ボタンが押された場合
        case 2:

			if ( $work->oup_t_work_no[0] != "" ) {

                // 作業実施テーブル 作業キャンセル 登録 に必要な情報をセット
                $work->inp_t_work_no        = $work->oup_t_work_no[0];
                $work->inp_t_work_visitor_id = "";
                $work->inp_t_work_stop_kbn  = "";
                $work->inp_t_work_modified  = date('Y-m-d H:i:s');
                $work->inp_t_work_modified_staffid = $_SESSION["staff_id"];

                // データ更新
                $work->updateWork();

			}

            // セッション変数の破棄
            unset($_SESSION["work_no"]);

            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/menu.php');
            } else {
                // HTML表示
                header("Location:../controllers/menu.php?".SID);
            }

            break;

        // 画面上の「記録票を撮影して終了します」ボタンが押された場合
        case 3:

			if ( $work->oup_t_work_no[0] != "" ) {

                // 作業実施テーブル 作業キャンセル 登録 に必要な情報をセット
                $work->inp_t_work_no        = $work->oup_t_work_no[0];
                $work->inp_t_work_run_end_time = substr($run_end_time,0,2).substr($run_end_time,3,2);
                $work->inp_t_work_run_time = intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2));
                $work->inp_t_work_stop_kbn  = "4";
                $work->inp_t_work_visitor_id = $_SESSION["staff_id"];
                $work->inp_t_work_run_kbn   = '1';
                $work->inp_t_work_ok_flg    = '0';
                $work->inp_t_work_modified  = date('Y-m-d H:i:s');
                $work->inp_t_work_modified_staffid = $_SESSION["staff_id"];
                $work->inp_t_work_update_flg = '0';

                // データ更新
                $work->updateWork();

			}

            // セッション変数の破棄
            unset($_SESSION["work_no"]);

            if ($common->judgephone) {
                $url = "../controllers/camera.php?work_no=".$work->oup_t_work_no[0];
                // HTML表示
                header("Location: ".$url);
            } else {
                // HTML表示
                header("Location:../controllers/camera.php?".SID);
            }

            break;

    }

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/menu_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/menu_html.php');
    }
?>
