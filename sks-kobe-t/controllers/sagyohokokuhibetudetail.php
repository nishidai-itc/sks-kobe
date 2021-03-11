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
    require_once('../models/Work.php');                   // 作業開始クラス
    require_once('../models/User.php');                 // 利用者クラス

    $act        = NULL;
    $work_day = NULL;

    if (isset($_POST["act"])) {
        $act = $_POST["act"];
    }
    if (isset($_POST["work_no"])) {
        $work_no= $_POST["work_no"];
    }
    if (isset($_SESSION["work_day"])) {
        $work_day = $_SESSION["work_day"];
    }
    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date(substr($work_day,0,4)."-".substr($work_day,4,2)."-".substr($work_day,6,2)));
    $w = date("w", $time);

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Work;           // 作業実施テーブルクラス

    if ($act == "2") {

        $_SESSION["work_no"] = $work_no;

        // 日別作業報告画面に遷移する
        if ($common->judgephone) {
            // HTML表示
            header('Location:../controllers/sagyohokokudetail.php');
        } else {
            // HTML表示
            header("Location:../controllers/sagyohokokudetail.php?".SID);
        }
    }

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_visitor_id = $_SESSION["staff_id"];
    $work->inp_t_work_run_start_date = $work_day;

    // 作業実施テーブル 取得
    $work->getWork();

    // 作業実施件数分ループをし、利用者名　取得
    for($i=0;$i<count($work->oup_t_work_no);$i++) {

        $user     = new User;       // 利用者クラス

        // 利用者 取得 に 必要な情報をセット
        $user->inp_m_user_id = $work->oup_t_work_user_id[$i];

        // 利用者 取得
        $user->getUser();

        // 利用者名を変数にセット
        $work->oup_t_work_user_name[$i] = $user->oup_m_user_name[0];

    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/sagyohokokuhibetudetail_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/sagyohokokuhibetudetail_html.php');
    }
?> 
