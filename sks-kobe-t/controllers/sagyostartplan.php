<?php
    require_once('../models/common/common.php');        // 共通クラス
    require_once('../models/common/db.php');            // DBクラス
    require_once('../models/common/config.php');        // 各種設定クラス
    require_once('../models/sagyostart_class.php');     // 作業開始クラス
    require_once('../models/Work.php');                 // 作業開始クラス
    require_once('../models/Company.php');              // 会社クラス
    require_once('../models/Staff.php');                // 社員クラス
    require_once('../models/User.php');                 // 利用者クラス

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $sagyostart = new Sagyostart;   // 作業開始クラス
    $work       = new Work;         // 作業実施テーブルクラス
    $work2      = new Work;         // 作業実施テーブルクラス
    $company    = new Company;      // 会社マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $user       = new User;         // 利用者クラス
    $mailcfg    = new MailCfg;      // メール設定クラス

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
    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    $alert_kbn = "0";

    if (isset($_POST["act"])) {
        $act            = $common->html_decode($_POST["act"]);
        $rest_reason    = $common->html_decode($_POST["rest_reason"]);
        $comment        = $common->html_decode($_POST["rest_reason"]);
        $run_start_time = $common->html_decode($_POST["run_start_time"]);
        $ido            = $common->html_decode($_POST["ido"]);
        $keido          = $common->html_decode($_POST["keido"]);
        $alert_kbn      = $common->html_decode($_POST["alert_kbn"]);
        if ($alert_kbn == "") {
            $alert_kbn = "0";
        }
    }
    if (isset($_GET["work_no"])) {
        $_SESSION["work_no"] = $_GET["work_no"];
    }

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    if ($_SESSION["work_no"] == "") {
        // HTML表示
        header('Location:../controllers/menu.php');
        exit();
    }

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_no    = $_SESSION["work_no"];

    // 作業実施テーブル 取得
    $work->getWork();

    // 作業実施サービステーブル 取得 に必要な情報をセット
    $work2->inp_t_work_plan_service_no = $_SESSION["work_no"];

    // 作業実施テーブル 取得
    $work2->getWorkplanservice();

    // 作業実施データが取得できなかった場合（作業予定データ登録無し）
    if (count($work->oup_t_work_no[0]) == 0) {
        // メニュー画面に遷移する
        if ($common->judgephone) {
            // HTML表示
            header('Location:../controllers/menu.php');
        } else {
            // HTML表示
            header("Location:../controllers/menu.php?".SID);
        }
    }

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 利用者 取得 に 必要な情報をセット
    $user->inp_m_user_id = $work->oup_t_work_user_id[0];

    // 利用者 取得
    $user->getUser();

    switch ($act) {
        // 画面上の決定ボタンが押された場合
        case 1:

            if ($sagyostart->errmsg == "") {

                $work2       = new Work;         // 作業実施テーブルクラス

    			if ( $_SESSION["work_no"] != "" ) {

                    // 作業実施登録 に必要な情報をセット
                    $work2->inp_t_work_no    = $_SESSION["work_no"];
                    if ($work->oup_t_work_office_id[0] == "") {
                    $work2->inp_t_work_office_id = $_SESSION["office_id"];
                    }
                    $work2->inp_t_work_user_id = $work->oup_t_work_user_id[0];
                    $work2->inp_t_work_run_start_date = date('Y-m-d');
                    $work2->inp_t_work_run_start_time = date('Hi');
                    $work2->inp_t_work_start_latitude_position = $ido;
                    $work2->inp_t_work_start_longitude_position = $keido;
                    $work2->inp_t_work_stop_kbn = '0';
                    $work2->inp_t_work_visitor_id = $_SESSION["staff_id"];
                    $work2->inp_t_work_run_kbn = '1';
                    $work2->inp_t_work_modifi_kbn = '0';
                    $work2->inp_t_work_ok_flg = '0';
                    $work2->inp_t_work_modified = date('Y-m-d H:i:s');
                    $work2->inp_t_work_modified_staffid = $_SESSION["staff_id"];
                    $work2->inp_t_work_update_flg = '0';

                    // データ登録
                    $work2->updateWork();

                }

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
        // 画面上の中止ボタンが押された場合
        case 2:

            // 中止 登録 に必要な情報をセット
            $sagyostart->inp_rest_reason    = $rest_reason;
            $sagyostart->inp_t_work_comment = " ";

            // 入力チェック
            $sagyostart->inputCheck();

            if ($sagyostart->errmsg == "") {

                $work2       = new Work;         // 作業実施テーブルクラス

    			if ( $_SESSION["work_no"] != "" ) {

                    // 作業実施登録 に必要な情報をセット
                    $work2->inp_t_work_no               = $_SESSION["work_no"];
                    if ($work->oup_t_work_office_id[0] == "") {
                    $work2->inp_t_work_office_id        = $_SESSION["office_id"];
                    }
                    $work2->inp_t_work_user_id          = $work->oup_t_work_user_id[0];
                    $work2->inp_t_work_run_start_date   = date('Y-m-d');
                    $work2->inp_t_work_run_start_time   = date('Hi');
                    $work2->inp_t_work_start_latitude_position = $ido;
                    $work2->inp_t_work_start_longitude_position = $keido;
                    $work2->inp_t_work_run_end_time     = '';
                    $work2->inp_t_work_stop_kbn         = '1';
                    $work2->inp_t_work_visitor_id       = $_SESSION["staff_id"];
                    $work2->inp_t_work_rest_reason      = $rest_reason;
                    $work2->inp_t_work_run_kbn          = '1';
                    $work2->inp_t_work_modifi_kbn       = '0';
                    $work2->inp_t_work_ok_flg           = '0';
                    $work2->inp_t_work_modified         = date('Y-m-d H:i:s');
                    $work2->inp_t_work_modified_staffid = $_SESSION["staff_id"];
                    $work2->inp_t_work_update_flg       = '0';

                    // データ登録
                    $work2->updateWork();

                }

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

        // 実績入力無し画面上の「作業報告します」ボタンが押された場合
        case 3:
        case "送信します":
        case "実施記録へ":

            // 作業報告します 登録 に必要な情報をセット
            $sagyostart->inp_t_work_comment = $comment;

            // 入力チェック
            $sagyostart->inputCheck();

            if ($sagyostart->errmsg == "") {

                $work2       = new Work;         // 作業実施テーブルクラス

    			if ( $_SESSION["work_no"] != "" ) {

                    // 作業実施登録 に必要な情報をセット
                    $work2->inp_t_work_no    = $_SESSION["work_no"];
                    if ($work->oup_t_work_office_id[0] == "") {
                        $work2->inp_t_work_office_id = $_SESSION["office_id"];
                    }
                    $work2->inp_t_work_user_id = $work->oup_t_work_user_id[0];
                    $work2->inp_t_work_plan_accomplishment_flg = "1";
//                    $work2->inp_t_work_run_start_date = date('Y-m-d');
                    $work2->inp_t_work_run_start_date = $work->oup_t_work_plan_start_date[0];
//                    $work2->inp_t_work_run_start_time = date('Hi');
                    $work2->inp_t_work_run_start_time = $work->oup_t_work_plan_start_time[0];
//                    $work2->inp_t_work_run_end_time = date('Hi');
                    $work2->inp_t_work_run_end_time = $work->oup_t_work_plan_end_time[0];
                    $work2->inp_t_work_run_time = 0;
                    $work2->inp_t_work_start_latitude_position = $ido;
                    $work2->inp_t_work_start_longitude_position = $keido;
                    $work2->inp_t_work_end_latitude_position = $ido;
                    $work2->inp_t_work_end_longitude_position = $keido;
                    $work2->inp_t_work_stop_kbn = '3';
                    $work2->inp_t_work_visitor_id = $_SESSION["staff_id"];
                    $work2->inp_t_work_alert_kbn = $alert_kbn;
                    $work2->inp_t_work_comment = $comment;
                    $work2->inp_t_work_run_kbn = '1';
                    $work2->inp_t_work_modifi_kbn = '0';
                    $work2->inp_t_work_ok_flg = '0';
                    $work2->inp_t_work_modified = date('Y-m-d H:i:s');
                    $work2->inp_t_work_modified_staffid = $_SESSION["staff_id"];
                    $work2->inp_t_work_update_flg = '0';

                    // データ登録
                    $work2->updateWork();



                    if ($alert_kbn == "1") {
                        $stf_name = $staff->oup_m_staff_name[0];

                        // サ責のアドレスを取得
                        if ($work->oup_t_work_user_id[0] != "") {
                            $staffs     = new Staff;
                            $staffs->inp_m_kanri_id = $work->oup_t_work_user_id[0];
                            $staffs->getStaff();
                        }

                        // サ責がいない場合は管理者に送付
                        if (count($staffs->oup_m_staff_mail)==0) {
                            $staffs     = new Staff;
                            $staffs->inp_m_staff_auth = "2";
                            $staffs->getStaff();
                        }

                        // 利用者名の取得
                        $usr = new User;
                        $usr->inp_m_user_id = $work->oup_t_work_user_id[0];
                        $usr->getUser();
                        $usr_name = $usr->oup_m_user_name[0];

                        function to_jis($s) {
                            return mb_convert_encoding($s, "JIS", "ASCII,JIS,UTF-8,CP51932,SJIS-win");
                        }

                        mb_language('Japanese');
                        mb_internal_encoding("JIS");

                        $subject = "かんたんヘルパーさん " . $stf_name . " 様から重要メッセージ付き作業報告が送信されました";
                        $subject = preg_replace('/\s+/', ' ', mb_encode_mimeheader(to_jis($subject), "JIS", "B"));
                        $subject  = mb_convert_encoding( $subject, "iso-2022-jp", "auto" );

                        $mailbody = '';
                        $mailbody .= $stf_name . " 様から重要メッセージ付き作業報告が送信されました。\n\n";
                        $mailbody .= "利用者　" . $usr_name . " さん\n\n";

                        $time = strtotime(date($work->oup_t_work_plan_start_date[0]));
                        $w = date("w", $time);

                        $mailbody .= "作業予定日　" . substr($work->oup_t_work_plan_start_date[0],0,4)."/".substr($work->oup_t_work_plan_start_date[0],5,2)."/".substr($work->oup_t_work_plan_start_date[0],8,2)." (" . $week[$w] . ")\n";
                        $mailbody .= "作業予定時刻　".substr($work->oup_t_work_plan_start_time[0],0,2).":".substr($work->oup_t_work_plan_start_time[0],2,2)." － ".substr($work->oup_t_work_plan_end_time[0],0,2).":".substr($work->oup_t_work_plan_end_time[0],2,2) . "\n";

                        $worktime = intval(substr($work->oup_t_work_plan_end_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_plan_end_time[0],2,2)) - intval(substr($work->oup_t_work_plan_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_plan_start_time[0],2,2));

                        $mailbody .= "作業予定時間　".$worktime . " 分\n\n";
//                        $mailbody .= "作業内容\n";
//                        $mailbody .= $work->oup_t_work_service_content[0] . "　" . $T[0] . " 分\n";

                        $mailbody .= "\n";
                        $mailbody .= "\n";
                        $mailbody .= "報告内容　\n" . mb_convert_kana($comment, "K","utf-8") . "\n";

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
                                }
                            }
                        }
                    }



                }

                // キャリア判定（PC/スマートフォン/タブレット）
                if ($common->judgephone) {
                    if($company->oup_m_company_kiroku_kbn[0] == "1") {
                        // HTML表示
                        header('Location:../controllers/servicekiroku.php');
                    } else {
                        // HTML表示
                        header('Location:../controllers/menu.php');
                    }
                // キャリア判定（フィーチャーフォン）
                } else {
                    if($company->oup_m_company_kiroku_kbn[0] == "1") {
                        // HTML表示
                        header("Location:../controllers/servicekiroku.php?".SID);
                    } else {
                        // HTML表示
                        header("Location:../controllers/menu.php?".SID);
                    }
                }

            }

            break;



        // 実績入力無し画面上の「一時保存」ボタンが押された場合
        case 4:
        case "一時保存":

            // 作業報告します 登録 に必要な情報をセット
            $sagyostart->inp_t_work_comment = $comment;

            $work2       = new Work;         // 作業実施テーブルクラス

			if ( $_SESSION["work_no"] != "" ) {

                // 作業実施登録 に必要な情報をセット
                $work2->inp_t_work_no    = $_SESSION["work_no"];
//                $work2->inp_t_work_office_id = $_SESSION["office_id"];
                $work2->inp_t_work_user_id = $work->oup_t_work_user_id[0];
                $work2->inp_t_work_visitor_id = $_SESSION["staff_id"];
                $work2->inp_t_work_comment = $comment;
                $work2->inp_t_work_modified = date('Y-m-d H:i:s');
                $work2->inp_t_work_modified_staffid = $_SESSION["staff_id"];

                // データ登録
                $work2->updateWork();

            }

            // キャリア判定（PC/スマートフォン/タブレット）
            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/today_list.php');
            // キャリア判定（フィーチャーフォン）
            } else {
                // HTML表示
                header("Location:../controllers/today_list.php?".SID);
            }

            break;

    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // 簡単入力区分 = 1 の場合、実績を入力しない。
        if ($company->oup_m_company_simple_kbn[0] == "1") {
            require_once('../views/sagyostartplansimple_html.php');
        } else {
            // HTML表示
            require_once('../views/sagyostartplan_html.php');
        }
    // キャリア判定（フィーチャーフォン）
    } else {
        // 簡単入力区分 = 1 の場合、実績を入力しない。
        if ($company->oup_m_company_simple_kbn[0] == "1") {
            require_once('../views/m/sagyostartplansimple_html.php');
        } else {
            // HTML表示
            require_once('../views/m/sagyostartplan_html.php');
        }
    }

?>
