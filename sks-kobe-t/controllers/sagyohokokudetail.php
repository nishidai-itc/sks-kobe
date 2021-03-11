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
    require_once('../models/Company.php');                // 会社クラス
    require_once('../models/Work.php');                   // 作業開始クラス
    require_once('../models/Worktype.php');               // 作業種類開始クラス
    require_once('../models/User.php');                   // 利用者クラス

    $act              = NULL;
    $week = array("日", "月", "火", "水", "木", "金", "土");

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Work;         // 作業実施テーブルクラス
    $work2      = new Work;         // 作業実施テーブルクラス
    $worktype   = new Worktype;     // 作業種類マスタクラス
    $user       = new User;         // 利用者クラス
    $company    = new Company;      // 会社マスタクラス

    if ($act == "1") {
        // パスワード入力確認画面に遷移する
        if ($common->judgephone) {
            // HTML表示
            header('Location:../controllers/work_modify.php');
        } else {
            // HTML表示
            header("Location:../controllers/work_modify.php?".SID);
        }
    }

	if ( $_SESSION["work_no"] == "" ) {
        if ($common->judgephone) {
            // HTML表示
            header('Location:../controllers/menu.php');
        } else {
            // HTML表示
            header("Location:../controllers/menu.php?".SID);
        }
	}

    // 会社マスタ 取得
    $company->getCompany();

    // 作業種類マスタ 取得
    $worktype->getWorktype();

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_no = $_SESSION["work_no"];

    // 作業実施テーブル 取得
    $work->getWork();

    // 作業実施サービステーブル 取得 に必要な情報をセット
    $work2->inp_t_work_service_no = $_SESSION["work_no"];

    // 作業実施テーブル 取得
    $work2->getWorkservice2();

    // 作業実施の曜日　取得
    $time = strtotime($work->oup_t_work_run_start_date[0]);
    $w = date("w", $time);

    // 利用者 取得 に 必要な情報をセット
    $user->inp_m_user_id = $work->oup_t_work_user_id[0];

    // 利用者 取得
    $user->getUser();

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/sagyohokokudetail_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/sagyohokokudetail_html.php');
    }
?>

