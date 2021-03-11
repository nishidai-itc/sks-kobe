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
    require_once('../models/password_class.php');         // パスワード変更クラス
    require_once('../models/Staff.php');                  // 社員クラス

    $act              = NULL;
    $now_pw   = NULL;
    $new_pw1       = NULL;
    $new_pw2    = NULL;

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
        $now_pw  = $_POST["now_pw"];
        $new_pw1 = $_POST["new_pw1"];
        $new_pw2 = $_POST["new_pw2"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $password   = new Password;       // パスワードクラス
    $staff    = new Staff;      // 社員マスタクラス

    if ($act == "1") {
        // 入力内容のチェック に必要な情報をセット
        $password->inp_now_pw  = md5(md5("ITC".$now_pw)."ITC");       // 現在のパスワード
        $password->inp_new_pw1 = md5(md5("ITC".$new_pw1)."ITC");      // 新しいパスワード
        $password->inp_new_pw2 = md5(md5("ITC".$new_pw2)."ITC");      // 新しいパスワード（確認）

        // 入力内容のチェック
        $password->inputCheck();

        // 入力内容のチェックでエラーが無い場合
        if ($password->errmsg == "") {

            // 現在のパスワードが正しいかどうかチェックを行う
            $staff->inp_m_staff_id = $_SESSION["staff_id"];
            $staff->inp_m_staff_pass = md5(md5("ITC".$now_pw)."ITC");

            $staff->getStaff();

            // データが取得できている場合
            if (count($staff->oup_m_staff_id) != 0) {

                $_SESSION["password"] = md5(md5("ITC".$new_pw1)."ITC");

                // パスワード入力確認画面に遷移する
                if ($common->judgephone) {
                    // HTML表示
                    header('Location:../controllers/password_confirm.php');
                } else {
                    // HTML表示
                    header("Location:../controllers/password_confirm.php?".SID);
                }
            } else {
                $password->errmsg = "パスワードが正しくありません。";
            }
        }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/password_modify_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/password_modify_html.php');
    }
?>
