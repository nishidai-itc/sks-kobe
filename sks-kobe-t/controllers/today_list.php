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
    require_once('../models/User.php');                   // 利用者クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Work.php');                   // 作業開始クラス
    require_once('../models/common/config.php');          // config クラス
    require_once('../models/Company.php');                // 会社クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    $confirmflg     = false;
    $act            = NULL;

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $staff      = new Staff;        // 社員マスタクラス
    $work       = new Work;         // 作業実施テーブルクラス
    $workcon    = new Work;           // 作業実施テーブルクラス
    $mailcfg    = new MailCfg;        // メール設定クラス
    $company    = new Company;        // 会社マスタクラス

    // 会社マスタ 取得
    $company->getCompany();

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_plan_id    = $_SESSION["staff_id"];
    $work->inp_t_work_plan_start_date   = date('Ymd');
    $work->inp_t_work_stop_kbn   = "";
    $work->inp_t_work_delete_flg    = "0";

    // 作業実施テーブル 取得
    $work->getWork();

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業開始確認テーブル 取得 に必要な情報をセット
    $workcon->inp_t_work_confirm_staff_id   = $_SESSION["staff_id"];
    $workcon->inp_t_work_confirm_start_date = date('Y-m-d');
    $workcon->getWorkconfirm();

    // 作業開始確認データが取得できた場合
    if (count($workcon->oup_t_work_confirm_staff_id[0]) != 0) {
        // 確認フラグをtrueにする
        $confirmflg = true;
    }

    switch ($act) {
        // 画面上の「本日 訪問 OK 連絡」ボタンが押された場合
        case 4:

            if(!($confirmflg)) {

                // 作業開始確認テーブル 登録 に必要な情報をセット
                $workcon->inp_t_work_confirm_staff_id           = $_SESSION["staff_id"];
                $workcon->inp_t_work_confirm_start_date         = date('Y-m-d');
                $workcon->inp_t_work_confirm_created            = date('Y-m-d H:i:s');
                $workcon->inp_t_work_confirm_created_staffid    = $_SESSION["staff_id"];
                $workcon->inp_t_work_confirm_modified           = date('Y-m-d H:i:s');
                $workcon->inp_t_work_confirm_modified_staffid   = $_SESSION["staff_id"];

                // 作業開始確認テーブル 登録
                $workcon->insertWorkconfirm();

                // 確認フラグをtrueにする
                $confirmflg = true;

                // 管理者にメール

                // 訪問者名の取得
                $stf = new Staff;
                $stf->inp_m_staff_id = $_SESSION["staff_id"];
                $stf->getStaff();
                $stf_name = $stf->oup_m_staff_name[0];

                // 管理者の取得
                $staffs     = new Staff;
                $staffs->inp_m_staff_auth = "2";
                $staffs->getStaff();

                function to_jis($s) {
                    return mb_convert_encoding($s, "JIS", "ASCII,JIS,UTF-8,CP51932,SJIS-win");
                }

                mb_language('Japanese');
                mb_internal_encoding("JIS");

                $subject = "【かんたんヘルパーさん】" . $stf_name . " 様より本日訪問OKの連絡";
                $subject = preg_replace('/\s+/', ' ', mb_encode_mimeheader(to_jis($subject), "JIS", "B"));

                $mailbody = '';
                $mailbody .= $stf_name . " 様より本日訪問OKの連絡が送信されました。\n\n";

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

            break;
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/today_list_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/today_list_html.php');
    }
?>
