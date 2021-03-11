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
    require_once('../models/regist_user_class.php');      // 利用者さん登録クラス
//    require_once('../models/Staff.php');                  // 社員クラス

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $user       = new User;         // 利用者クラス
    $registuser = new Registuser;   // ログインクラス
//    $staff      = new Staff;        // 社員マスタクラス

    /*********************************************************
     *	変数の設定
     ********************************************************/
    $act        = NULL;
    $m_user_kana   = NULL;
    $m_user_name = NULL;
    $m_user_birth_date = NULL;
    $m_user_birth_date_yy = NULL;
    $m_user_birth_date_mm = NULL;
    $m_user_birth_date_dd = NULL;

    if (isset($_POST["act"])) {
        $act        = $common->html_decode($_POST["act"]);
        $m_user_kana = $common->html_decode($_POST["m_user_kana"]);
        $m_user_name = $common->html_decode($_POST["m_user_name"]);
        $m_user_birth_date = $common->html_decode($_POST["m_user_birth_date"]);
    }
    if (isset($_POST["m_user_birth_date_yy"])) {
        $m_user_birth_date_yy = $_POST["m_user_birth_date_yy"];
    }
    if (isset($_POST["m_user_birth_date_mm"])) {
        $m_user_birth_date_mm = $_POST["m_user_birth_date_mm"];
    }
    if (isset($_POST["m_user_birth_date_dd"])) {
        $m_user_birth_date_dd = $_POST["m_user_birth_date_dd"];
    }
    if ((isset($_POST["m_user_birth_date_yy"])) || (isset($_POST["m_user_birth_date_mm"])) || (isset($_POST["m_user_birth_date_dd"]))) {
        $m_user_birth_date = $m_user_birth_date_yy."-".$m_user_birth_date_mm."-".$m_user_birth_date_dd;
    }

    // 画面上の決定ボタンが押された場合
    if ($act == "1") {

        // 入力チェック に必要な情報をセット
        $registuser->inp_m_user_kana    = $m_user_kana;
        $registuser->inp_m_user_name  = $m_user_name;
        $registuser->inp_m_user_birth_date  = $m_user_birth_date;

        // 入力チェック
        $registuser->inputCheck();

        if ($registuser->errmsg == "") {

            // ランダム文字列生成（md5利用）
            $str = substr((md5(date("YmdD His"))), 0, 10); 

            // 利用者さん 登録 に必要な情報をセット
            $user->inp_m_user_id = $str;
            $user->inp_m_user_kana    = $m_user_kana;
            $user->inp_m_user_name  = $m_user_name;
            $user->inp_m_user_birth_date = $m_user_birth_date;
            $user->inp_m_user_start_date = date('Y-m-d');
            $user->inp_m_user_end_date = "";
            $user->inp_m_user_kbn = '1';
            $user->inp_m_user_created = date('Y-m-d H:i:s');
            $user->inp_m_user_created_staffid = $_SESSION["staff_id"];
            $user->inp_m_user_modified = date('Y-m-d H:i:s');
            $user->inp_m_user_modified_staffid = $_SESSION["staff_id"];

            // データ登録
            $user->insertUser();

//            // 社員マスタ 取得
//            $staff->getStaff();
//
//            // データが取得できている場合
//            if (count($staff->oup_m_staff_id) != 0) {
//
//                for($i=0;$i<count($staff->oup_m_staff_id);$i++) {
//
//                    // 社員用利用者一覧テーブル 登録 に必要な情報をセット
//                    $user->inp_t_staff_user_list_staff_id = $staff->oup_m_staff_id[$i];
//                    $user->inp_t_staff_user_list_user_id = $user->oup_last_id;
//                    $user->inp_t_staff_user_list_created = date('Y-m-d H:i:s');
//                    $user->inp_t_staff_user_list_created_staffid = $_SESSION["staff_id"];
//                    $user->inp_t_staff_user_list_modified = date('Y-m-d H:i:s');
//                    $user->inp_t_staff_user_list_modified_staffid = $_SESSION["staff_id"];
//
//                    // データ登録
//                    $user->insertStaffUserlist();
//
//                }
//
//            } else {

                // 社員用利用者一覧テーブル 登録 に必要な情報をセット
                $user->inp_t_staff_user_list_staff_id = $_SESSION["staff_id"];
                $user->inp_t_staff_user_list_user_id = $str;
                $user->inp_t_staff_user_list_created = date('Y-m-d H:i:s');
                $user->inp_t_staff_user_list_created_staffid = $_SESSION["staff_id"];
                $user->inp_t_staff_user_list_modified = date('Y-m-d H:i:s');
                $user->inp_t_staff_user_list_modified_staffid = $_SESSION["staff_id"];

                // データ登録
                $user->insertStaffUserlist();

//            }

            // キャリア判定（PC/スマートフォン/タブレット）
            if ($common->judgephone) {
                // HTML表示
                header('Location:../controllers/user_list.php');
            // キャリア判定（フィーチャーフォン）
            } else {
                // HTML表示
                header("Location:../controllers/user_list.php?".SID);
            }
        }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/user_regist_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/user_regist_html.php');
    }
?>
