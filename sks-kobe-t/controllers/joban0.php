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
    require_once('../models/Work.php');                   // 作業クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Genba.php');                  // 現場クラス

    $act        = NULL;
    $errmsg     = "";
    $week = array("日", "月", "火", "水", "木", "金", "土");

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
//        $inp_joban_kbn  = $_POST["joban_kbn"];
//        $inp_joban_time = $_POST["joban_time"];
//        $new_pw2 = $_POST["new_pw2"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Work;         // 作業クラス
    $work_mem   = new Work;         // 作業クラス
    $staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業テーブル 取得 に必要な情報をセット
    $work->inp_t_work_taiin_id    = $_SESSION["staff_id"];
    $work->inp_t_work_plan_date   = date('Ymd');
    $work->inp_t_work_del_flg     = "0";

    // 作業テーブル 取得
    $work->getWork();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_id = $work->oup_t_work_genba_id[0];

    // 現場マスタ 取得
    $genba->getGenba();

    // 作業テーブル 取得 に必要な情報をセット
    $work_mem->inp_t_work_genba_id    = $work->oup_t_work_genba_id[0];
    $work_mem->inp_t_work_plan_date   = date('Ymd');
    $work_mem->inp_t_work_del_flg     = "0";

    // 作業テーブル 取得
    $work_mem->getWork();

    for ($i=0;$i<count($work_mem->oup_t_work_taiin_id);$i++) {
        $staff_mem  = new Staff;        // 社員マスタクラス

        // 社員マスタ 取得 に必要な情報をセット
        $staff_mem->inp_m_staff_id = $work_mem->oup_t_work_taiin_id[$i];

        // 社員マスタ 取得
        $staff_mem->getStaff();
        $staff_name[$i] = $staff_mem->oup_m_staff_name[0];

        //  作業実施の上番時刻　取得
        $p_joban_time[$i] = substr($work_mem->oup_t_work_plan_joban_time[$i], 0, 5);
        $p_kaban_time[$i] = substr($work_mem->oup_t_work_plan_kaban_time[$i], 0, 5);

        $joban_time[$i] = substr($work_mem->oup_t_work_joban_time[$i], 0, 5);
        if ($joban_time[$i] == "" && $work_mem->oup_t_work_joban_kbn[$i] == "") {
            $joban_time[$i] = $p_joban_time[$i];
        }

        // 勤務 取得
        if ($work_mem->oup_t_work_plan_kbn[$i]=="1") {
            $kinmu[$i] = "泊";
        } else if ($work_mem->oup_t_work_plan_kbn[$i]=="2") {
            $kinmu[$i] = "日勤";
        } else if ($work_mem->oup_t_work_plan_kbn[$i]=="3") {
            $kinmu[$i] = "夜勤";
        } else {
            $kinmu[$i] = "";
        }
    }

    switch ($act) {
        // 画面上の決定ボタンが押された場合
        case 1:

          for ($i=0;$i<count($_POST["work_no"]);$i++) {
            $work2      = new Work;         // 作業クラス
            // 作業 更新 に必要な情報をセット
            $work2->inp_t_work_no = $_POST["work_no"][$i];              // 作業実施NO（連番）
            if (!$_POST["joban_kbn"][$i]) {
                $inp_joban_kbn = NULL;
            } else {
                $inp_joban_kbn = $_POST["joban_kbn"][$i];
            }
            $work2->inp_t_work_joban_kbn  = $inp_joban_kbn;               // 上番区分
            // 上番区分 = 通常
            if ($inp_joban_kbn == "1") {
                $work2->inp_t_work_joban_time = $_POST["jtime"][$i];   // 上番時刻
            // 上番区分 = 休暇
            } else if ($inp_joban_kbn == "4") {
                $work2->inp_t_work_joban_time = "null";                                     // 上番時刻
            // 上番区分 = 早出 or 遅刻
            } else {
                $work2->inp_t_work_joban_time = $_POST["jtime"][$i];                        // 上番時刻
            }

            // 作業の更新
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

            break;

    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/joban0_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/joban0_html.php');
    }
?>
