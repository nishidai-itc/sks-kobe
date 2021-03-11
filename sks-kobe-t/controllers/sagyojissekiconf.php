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
    require_once('../models/common/config.php');          // 各種設定クラス
    require_once('../models/Worktype.php');               // 作業種類開始クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/User.php');                   // 利用者クラス
    require_once('../models/Work.php');                   // 作業開始クラス

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;         // 共通クラス
    $mailcfg    = new MailCfg;        // メール設定クラス
    $worktype   = new Worktype;       // 作業種類マスタクラス
    $worktype2  = new Worktype;       // 作業種類マスタクラス
    $staff      = new Staff;          // 社員マスタクラス
    $user       = new User;           // 利用者マスタクラス
    $work       = new Work;           // 作業実施テーブルクラス
    $work2      = new Work;           // 作業実施テーブルクラス

    $act        = NULL;
    $run_end_time   = $_SESSION["run_end_time"];
    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    for($i=0;$i<$_SESSION["syurui_cnt"];$i++) {
        $T[$i] = $_SESSION["T".$i];
    }
    $sumvalue       = $_SESSION["sumvalue"];
    $move_cost_yen  = $_SESSION["move_cost_yen"];
    $move_cost_kilo = $_SESSION["move_cost_kilo"];
    $move_cost_etc  = $_SESSION["move_cost_etc"];
    $comment        = $_SESSION["comment"];
    $alert_kbn      = $_SESSION["alert_kbn"];
    $accomplishment_flg      = $_SESSION["accomplishment_flg"];
    if ($alert_kbn == "") {
        $alert_kbn = "0";
    }
    $ido            = $_SESSION["ido"];
    $keido          = $_SESSION["keido"];

    if (isset($_POST["act"])) {
        $act        = $common->html_decode($_POST["act"]);
    }

    // 作業実施テーブルが取得できない場合はメニューに遷移
    if ($_SESSION["work_no"] == "") {
        // キャリア判定（PC/スマートフォン/タブレット）
        if ($common->judgephone) {
            // HTML表示
            header('Location:../controllers/menu.php');
        // キャリア判定（フィーチャーフォン）
        } else {
            // HTML表示
            header("Location:../controllers/menu.php?".SID);
        }
        exit();
    }


    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_no    = $_SESSION["work_no"];

    // 作業実施テーブル 取得
    $work->getWork();

    // 作業予定サービステーブル 取得 に必要な情報をセット
    $work2->inp_t_work_plan_service_no      = $work->oup_t_work_no[0];

    // 作業予定サービステーブル 取得
    $work2->getWorkplanservice();

    if (count($work2->oup_t_work_plan_service_no) == 0) {

        // 作業種類マスタ 取得
        $worktype->getWorktype();
    }

    // 画面上の決定ボタンが押された場合
//    if ($act == "1") {

		if ( $work->oup_t_work_no[0] != "" ) {

            // 作業実施登録 に必要な情報をセット
            $work->inp_t_work_no = $work->oup_t_work_no[0];
            $work->inp_t_work_run_end_time = substr($run_end_time,0,2).substr($run_end_time,3,2);
    //        $work->inp_t_work_run_time = intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2));
            $work->inp_t_work_run_time = $sumvalue;
            $work->inp_t_work_end_latitude_position = $ido;
            $work->inp_t_work_end_longitude_position = $keido;
            $work->inp_t_work_stop_kbn = '3';
            $work->inp_t_work_visitor_id = $_SESSION["staff_id"];
            $work->inp_t_work_alert_kbn = $alert_kbn;
            $work->inp_t_work_comment = $comment;
            $work->inp_t_work_rest_reason = '';
            $work->inp_t_work_move_cost_yen = $move_cost_yen;
            $work->inp_t_work_move_cost_kilo = $move_cost_kilo;
            $work->inp_t_work_move_cost_etc = $move_cost_etc;
            $work->inp_t_work_run_kbn = '1';
            $work->inp_t_work_modifi_kbn = '0';
            $work->inp_t_work_ok_flg = '0';
            $work->inp_t_work_plan_accomplishment_flg = $accomplishment_flg;
            $work->inp_t_work_modified = date('Y-m-d H:i:s');
            $work->inp_t_work_modified_staffid = $_SESSION["staff_id"];
            $work->inp_t_work_update_flg = '0';

            // 作業実施登録更新
            $work->updateWork();

		}

        if (count($work2->oup_t_work_plan_service_no) == 0) {

            for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) {

                // 作業実施サービステーブル登録 に必要な情報をセット
                $work->inp_t_work_service_no                = $work->oup_t_work_no[0];
                $work->inp_t_work_service_type_cd           = $worktype->oup_m_work_type_cd[$i];
                $work->inp_t_work_service_type_item_cd      = $worktype->oup_m_work_type_item_cd[$i];
                $work->inp_t_work_service_time              = $T[$i];
                $work->inp_t_work_service_content           = $worktype->oup_m_work_type_content[$i];
                $work->inp_t_work_service_created           = date('Y-m-d H:i:s');
                $work->inp_t_work_service_created_staffid   = $_SESSION["staff_id"];
                $work->inp_t_work_service_modified          = date('Y-m-d H:i:s');
                $work->inp_t_work_service_modified_staffid  = $_SESSION["staff_id"];

                // 作業実施サービステーブル登録
                $work->insertWorkService();
            }

        // 作業予定から登録する場合
        } else {

            for($i=0;$i<count($work2->oup_t_work_plan_service_no);$i++) {

                // 作業実施サービステーブル登録 に必要な情報をセット
                $work->inp_t_work_service_no                = $work2->oup_t_work_plan_service_no[$i];
                $work->inp_t_work_service_type_cd           = $work2->oup_t_work_plan_service_type_cd[$i];
                $work->inp_t_work_service_type_item_cd      = $work2->oup_t_work_plan_service_type_item_cd[$i];
                $work->inp_t_work_service_time              = $T[$i];
                $work->inp_t_work_service_content           = $work2->oup_t_work_plan_content[$i];
                $work->inp_t_work_service_created           = date('Y-m-d H:i:s');
                $work->inp_t_work_service_created_staffid   = $_SESSION["staff_id"];
                $work->inp_t_work_service_modified          = date('Y-m-d H:i:s');
                $work->inp_t_work_service_modified_staffid  = $_SESSION["staff_id"];

                // 作業実施サービステーブル登録
                $work->insertWorkService();

                // 作業種類マスタ にデータが存在するか確認
                //

                // 作業種類マスタ 取得 に必要な情報をセット
                $worktype2->inp_m_work_type_cd          = $work2->oup_t_work_plan_service_type_cd[$i];
                $worktype2->inp_m_work_type_item_cd     = $work2->oup_t_work_plan_service_type_item_cd[$i];

                // 作業種類マスタ 取得
                $worktype2->getWorktype();

                if (count($worktype2->oup_m_work_type_cd) == 0) {

                    // 作業種類マスタ 登録 に必要な情報をセット
                    $worktype2->inp_m_work_type_kbn                 = "1";
                    $worktype2->inp_m_work_type_cd                  = $work2->oup_t_work_plan_service_type_cd[$i];
                    $worktype2->inp_m_work_type_item_cd             = $work2->oup_t_work_plan_service_type_item_cd[$i];
                    $worktype2->inp_m_work_type_start_date          = date('Y-m-d H:i:s');
                    $worktype2->inp_m_work_type_content             = $work2->oup_t_work_plan_content[$i];
                    $worktype2->inp_m_work_type_unit                = "";
                    $worktype2->inp_m_work_type_calc                = "";
                    $worktype2->inp_m_work_type_created             = date('Y-m-d H:i:s');
                    $worktype2->inp_m_work_type_created_staffid     = $_SESSION["staff_id"];
                    $worktype2->inp_m_work_type_modified            = date('Y-m-d H:i:s');
                    $worktype2->inp_m_work_type_modified_staffid    = $_SESSION["staff_id"];

                    // 作業種類マスタ 登録
                    $worktype2->insertWorktype();
                }
            }
        }

        if ($alert_kbn == "1") {
            // 訪問者名の取得
            $stf = new Staff;
            $stf->inp_m_staff_id = $_SESSION["staff_id"];
            $stf->getStaff();
            $stf_name = $stf->oup_m_staff_name[0];

            $staffs     = new Staff;
            $staffs->inp_m_staff_auth = "2";
            $staffs->getStaff();

            // 利用者名の取得
            $usr = new User;
            $usr->inp_m_user_id = $work->oup_t_work_user_id[0];
            $usr->getUser();
            $usr_name = $usr->oup_m_user_name[0];

            //作業時間の算出
            $worktime = intval(substr($run_end_time,0,2)) * 60;
            $worktime = $worktime + intval(substr($run_end_time,3,2));
            $worktime = $worktime - (intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60);
            $worktime = $worktime - intval(substr($work->oup_t_work_run_start_time[0],2,2));

            function to_jis($s) {
                return mb_convert_encoding($s, "JIS", "ASCII,JIS,UTF-8,CP51932,SJIS-win");
            }

            mb_language('Japanese');
            mb_internal_encoding("JIS");

            $subject = "訪問業務システム " . $stf_name . " 様から重要メッセージ付き作業実績報告が送信されました";
            $subject = preg_replace('/\s+/', ' ', mb_encode_mimeheader(to_jis($subject), "JIS", "B"));

            $mailbody = '';
            $mailbody .= $stf_name . " 様から重要メッセージ付き作業実績報告が送信されました。\n\n";
            $mailbody .= "利用者　" . $usr_name . " さん\n\n";
            $mailbody .= "作業日　" . date('Y/m/d') . " (" . $week[$w] . ")\n";
            $mailbody .= "作業時刻　" . substr($work->oup_t_work_run_start_time[0],0,2) . ":" . substr($work->oup_t_work_run_start_time[0],2,2) . " － " . $run_end_time . "\n";
            $mailbody .= "作業時間　" . $worktime . " 分\n\n";
            $mailbody .= "作業内容\n";
            for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) {
                $mailbody .= $worktype->oup_m_work_type_content[$i] . "　" . $T[$i] . " 分\n";
            }
            $mailbody .= "\n";
            if ($move_cost_yen != "") {
                $mailbody .= "交通費　" . $move_cost_yen . " 円\n";
            }
            if ($move_cost_kilo != "") {
                $mailbody .= "移動距離　" . $move_cost_kilo . " km\n";
            }
            if ($move_cost_etc != "") {
                $mailbody .= "その他　" . $move_cost_etc . "\n";
            }
            $mailbody .= "\n";
            $mailbody .= "コメント　\n" . $comment . "\n";

            $mailbody  = implode("\r\n", preg_split("/\r?\n/", $mailbody));
            $mailbody  = mb_convert_encoding( $mailbody, "iso-2022-jp", "auto" );

            $header  = "From: " . $mailcfg->sendaddr . "\n" .
                       "X-Mailer: PHP/" . phpversion() . "\n" .
                       "MIME-Version: 1.0\n" .
                       "Content-Type: text/plain; charset=ISO-2022-JP\n" .
                       "Content-Transfer-Encoding: 7bit";

            for($i=0;$i<count($staffs->oup_m_staff_mail);$i++) {
                $mailaddr = $staffs->oup_m_staff_mail[$i];
                if ($mailaddr != "") {
                    if (mail($mailaddr, $subject, $mailbody, $header)) {
                        //echo "メールが送信されました。";
                    } else {
                        //echo "メールの送信に失敗しました。";
//var_dump($mailaddr, $subject, $mailbody);
                    }
                }
            }
        }

        // セッション変数の破棄
        unset($_SESSION["work_no"]);
        unset($_SESSION["run_end_time"]);
        unset($_SESSION["move_cost_yen"]);
        unset($_SESSION["move_cost_kilo"]);
        unset($_SESSION["move_cost_etc"]);
        unset($_SESSION["comment"]);
        unset($_SESSION["alert_kbn"]);
        unset($_SESSION["accomplishment_flg"]);

        // キャリア判定（PC/スマートフォン/タブレット）
        if ($common->judgephone) {
            // HTML表示
            header('Location:../controllers/sagyojissekicomp.php');
        // キャリア判定（フィーチャーフォン）
        } else {
            // HTML表示
            header("Location:../controllers/sagyojissekicomp.php?".SID);
        }

//    }
//
//    // 社員マスタ 取得 に必要な情報をセット
//    $staff->inp_m_staff_id = $_SESSION["staff_id"];
//
//    // 社員マスタ 取得
//    $staff->getStaff();
//
//    // キャリア判定（PC/スマートフォン/タブレット）
//    if ($common->judgephone) {
//        // HTML表示
//        require_once('../views/sagyojissekiconf_html.php');
//    // キャリア判定（フィーチャーフォン）
//    } else {
//        // HTML表示
//        require_once('../views/m/sagyojissekiconf_html.php');
//    }
?>
