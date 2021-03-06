<?php
    session_start();
?>
<?php
/*
if (empty($_SERVER['HTTPS'])) {
    header("Location: https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
    exit;
}
*/
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/Company.php');                // 会社クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/login_class.php');            // ログインクラス

    $act              = null;
    $staff_login_id   = null;
    $staff_pass       = null;
    $nextpass         = null;
    $logout           = null;
    $status           = null;

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
        $staff_login_id = $_POST["staff_login_id"];
        $staff_pass     = $_POST["staff_pass"];
    }
    if (isset($_POST["nextpass"])) {
        $nextpass       = $_POST["nextpass"];
    }
    if (isset($_POST["logout"])) {
        $logout         = 1;
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $company    = new Company;      // 会社マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $login      = new Login;        // ログインクラス
    $common     = new Common;       // 共通クラス

    // 会社マスタの取得
    $company->getCompany();

    // 申込状況を取得
    if (($company->oup_m_company_end_date[0] != "") &&
        ($company->oup_m_company_end_date[0] < date('Y-m-d'))) {
        $status = "2";
    } elseif (($company->oup_m_company_start_date[0] != "") &&
               ($company->oup_m_company_end_date[0] != "") &&
               ($company->oup_m_company_start_date[0] <= date('Y-m-d'))
            && (date('Y-m-d') <= $company->oup_m_company_end_date[0])) {
        $status = "1";
    // 仕様期間終了
    } elseif (($company->oup_m_company_try_end_date[0] != "") &&
               ($company->oup_m_company_try_end_date[0] < date('Y-m-d'))) {
        $status = "4";
    } elseif (($company->oup_m_company_try_start_date[0] != "") &&
               ($company->oup_m_company_try_end_date[0] != "") &&
               ($company->oup_m_company_try_start_date[0] <= date('Y-m-d'))
            && (date('Y-m-d') <= $company->oup_m_company_try_end_date[0])) {
        $status = "3";
    } else {
        $status = "5";
    }

    // ログアウト処理
    if ($logout == 1) {

        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }

//        unset($_SESSION['staff_id']);

        // セッション変数を全て解除する
        $_SESSION = array();

        // セッションを破壊
        session_destroy();

        // メッセージ表示
        $login->errmsg = "ログアウトしました。";
    }

    // ログインしている場合
    if (isset($_SESSION["staff_id"])) {
        // メニュー画面に遷移する
        // HTML表示
        //
        header('Location:../controllers/menu.php');
    }

    // ログイン画面で「ログイン」ボタンが押された場合
    if ($act == "1") {

        // 入力内容のチェック に必要な情報をセット
        $login->inp_staff_login_id  = $staff_login_id;    // ログインID
        $login->inp_staff_pass      = $staff_pass;        // パスワード
        $login->inp_m_staff_kbn     = "1";                // 有効区分（1=有効/0=無効）

        // 入力内容のチェック
        $login->inputCheck();

        // 入力内容のチェックでエラーが無い場合
        if ($login->errmsg == "") {

            // 社員マスタ 取得 に必要な情報をセット
            $staff->inp_m_staff_login_id  = $staff_login_id;    // ログインID
            $staff->inp_m_staff_pass      = md5(md5("ITC".$staff_pass)."ITC");        // パスワード
            $staff->inp_m_staff_kbn     = "1";                // 有効区分（1=有効/0=無効）

            // 社員マスタ 取得
            $staff->getStaff();

            // データが取得できている場合
            if (count($staff->oup_m_staff_id) != 0) {

                // セッションに情報をセット
                $_SESSION["staff_id"] = $staff->oup_m_staff_id[0];
                $_SESSION["office_id"] = $staff->oup_m_staff_office_id[0];
                $_SESSION["nextpass"] = $nextpass;

                // メニュー画面に遷移する
                if ($common->judgephone) {
                    // HTML表示
                    if ($staff->oup_m_staff_auth[0] == 4) {
                        header("Location:../controllers/dakoku1.php");
                    } elseif($staff->oup_m_staff_auth[0] == 1){
                        header("Location:../controllers/kanri/menu.php");
                    } else {
                        header("Location:../controllers/menu.php");
                    }
                } else {
                    // HTML表示
                    header("Location:../controllers/menu.php?".SID);
                }
                exit();
            } else {
                $login->errmsg = "ログインID、パスワードの入力に誤りがあるか登録されていません。";
            }
        }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/login_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/login_html.php');
    }

?>

