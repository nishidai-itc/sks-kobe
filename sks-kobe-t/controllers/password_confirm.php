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

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
        $new_pw1 = $_SESSION["password"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $password   = new Password;       // パスワードクラス
    $staff      = new Staff;        // 社員マスタクラス

    if ($act == "1") {
        // 入力内容のチェック に必要な情報をセット
        $password->inp_new_pw1 = $new_pw1;      // 新しいパスワード

        // 入力内容のチェック
        $password->confirmCheck();

        // 入力内容のチェックでエラーが無い場合
        if ($password->errmsg == "") {

            // パスワードの更新 に必要な情報をセット
            $staff->inp_m_staff_id   = $_SESSION["staff_id"];                   // 社員ID
            $staff->inp_m_staff_pass = $new_pw1;                                // パスワード
            $staff->inp_m_staff_modified = date('Y-m-d');                       // 更新日
            $staff->inp_m_staff_modified_staffid = $_SESSION["staff_id"];       // 更新者

            // パスワードの更新
            $staff->updateStaff();

            // セッション変数の破棄
            unset($_SESSION["password"]);

            // パスワード入力完了画面に遷移する
            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/password_complete.php');
            } else {
                // HTML表示
                header("Location:../controllers/password_complete.php?".SID);
            }
        }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/password_confirm_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/password_confirm_html.php');
    }
?> 
