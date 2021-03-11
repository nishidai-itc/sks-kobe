<?php
session_start();

// ログインチェック
if (!isset($_SESSION["staff_id"])) {
    // HTML表示
    header('Location:../controllers/login.php');
}
?>
<?php
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/Wkdetail.php');               // 作業クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Genba.php');                  // 現場クラス
    require_once('../models/Shift.php');                  // シフトクラス
    require_once('../models/PostTeate.php');              // ポスト手当てクラス
    require_once('./function/utils.php');                 // 関数クラス

    $act        = null;
    $errmsg     = "";
    $week = array("日", "月", "火", "水", "木", "金", "土");

    // 残業時間の選択に使用
    $select_daytime = array(
      '00:00' => '0',
      '00:15' => '15',
      '00:30' => '30',
      '00:45' => '45',
      '01:00' => '60'
    );

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Wkdetail;     // 作業クラス
    $work_mem   = new Wkdetail;     // 作業クラス
    $staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス
    $genba2     = new Genba;        // 現場マスタクラス
    $shift      = new Shift;        // シフトマスタクラス
    $utils      = new Utils;        // 関数クラス
    $postteate  = new PostTeate;    // ポスト手当てクラス

    // ポスト手当て取得
    $postteate->getPostteate();

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業テーブル 取得 に必要な情報をセット
    $work->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
    $work->inp_t_wk_plan_date   = date('Ymd');
    $work->inp_t_wk_del_flg     = "0";

    // 作業テーブル 取得
    $work->getWkdetail();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_id = $staff->oup_m_staff_genba_id[0];

    // 現場マスタ 取得
    $genba->getGenba();

    // 現場マスタ 取得 に必要な情報をセット
    $genba2->inp_m_genba_oya_id = $staff->oup_m_staff_genba_id[0];

    // 現場マスタ 取得
    $genba2->getGenba();

    // 作業テーブル 取得 に必要な情報をセット
    if ($staff->oup_m_staff_auth[0] != 1) {
        $work_mem->inp_t_wk_genba_id2    = "'".$staff->oup_m_staff_genba_id[0]."'";

        for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) {
            $work_mem->inp_t_wk_genba_id2 = $work_mem->inp_t_wk_genba_id2 . ",'" . $genba2->oup_m_genba_id[$i] . "'";
        }
    }

    $work_mem->inp_t_wk_plan_date   = date('Ymd');
    $work_mem->inp_t_wk_del_flg     = "0";
    $work_mem->inp_order = "ORDER BY  t_wk_genba_id,t_wk_plan_kbn, t_wk_plan_joban_time, t_wk_taiin_id  ";

    // 作業テーブル 取得
    $work_mem->getWkdetail();

    // 前日の作業者で下番登録していない人
    $work_mem2 = new Wkdetail;
    if ($staff->oup_m_staff_auth[0] != 1) {
    $work_mem2->inp_t_wk_genba_id    = $staff->oup_m_staff_genba_id[0];

        for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) {
            $work_mem->inp_t_wk_genba_id2 = $work_mem->inp_t_wk_genba_id2 . ",'" . $genba2->oup_m_genba_id[$i] . "'";
        }
	}
    $work_mem2->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
    $work_mem2->inp_t_wk_kaban_time  = "null";
    $work_mem2->inp_t_wk_del_flg     = "0";
    $work_mem2->inp_order = "ORDER BY  t_wk_genba_id,t_wk_plan_kbn, t_wk_plan_joban_time, t_wk_taiin_id  ";
    $work_mem2->getWkdetail();

//    for ($i=0;$i<count($work_mem->oup_t_wk_taiin_id);$i++) {
    $staff_mem  = new Staff;        // 社員マスタクラス

    // 社員マスタ 取得 に必要な情報をセット
//        $staff_mem->inp_m_staff_id = $work_mem->oup_t_work_taiin_id[$i];

    // 社員マスタ 取得
    $staff_mem->getStaff();
//        $staff_name[$i] = $staff_mem->oup_m_staff_name[0];

    for ($i=0;$i<count($staff_mem->oup_m_staff_id);$i++) {
        $staffs[$staff_mem->oup_m_staff_id[$i]] = $staff_mem->oup_m_staff_name[$i];
    }

    //  作業実施の上番時刻　取得
//        $p_joban_time[$i] = substr($work_mem->oup_t_work_plan_joban_time[$i], 0, 5);
//        $p_kaban_time[$i] = substr($work_mem->oup_t_work_plan_kaban_time[$i], 0, 5);

//        $joban_time[$i] = substr($work_mem->oup_t_work_joban_time[$i], 0, 5);
//        if ($joban_time[$i] == "" && $work_mem->oup_t_work_joban_kbn[$i] == "") {
//            $joban_time[$i] = $p_joban_time[$i];
//        }

    // 勤務 取得
//        if ($work_mem->oup_t_work_plan_kbn[$i]=="1") {
//            $kinmu[$i] = "泊";
//        } else if ($work_mem->oup_t_work_plan_kbn[$i]=="2") {
//            $kinmu[$i] = "日勤";
//        } else if ($work_mem->oup_t_work_plan_kbn[$i]=="3") {
//            $kinmu[$i] = "夜勤";
//        } else {
//            $kinmu[$i] = "";
//        }
//    }

    switch ($act) {
        // 画面上の決定ボタンが押された場合
        case 1:

            for ($i=0;$i<count($_POST["wk_no"]);$i++) {

                        $work2      = new Wkdetail;         // 作業クラス
                        // 作業 更新 に必要な情報をセット
                        $work2->inp_t_wk_detail_no = $_POST["wk_no"][$i];              // 作業実施NO（連番）

                if (($_POST["tujo_checked"][$i]!="") || ($_POST["plan_kaban"][$i]!=$_POST["kaban_time"][$i])) {

                    // 下番時刻
                    $kaban_time = $_POST['kaban_time'][$i];

                    $work2->inp_t_wk_kaban_time = $kaban_time;                 // 下番時刻

                    if ($_POST["kaban_time"][$i]!="") {

                        if ($_POST['kaban_time'][$i] != "") {
                            $work2->inp_t_wk_kaban_kbn  = 1;               // 下番区分
                        }

                        if ($inp_kaban_kbn == "1") {
                            $work2->inp_t_wk_kaban_time = $_POST["plan_time"][$i];   // 上番時刻
                        }
                    }
                }
                        for ($j=1;$j<=6;$j++) {
                            $work2->{'inp_t_wk_kyukei_start'.$j} = $_POST['kyukei_start'.$j][$i];
                            $work2->{'inp_t_wk_kyukei_end'.$j} = $_POST['kyukei_end'.$j][$i];
                        }
                        for ($j=1;$j<=3;$j++) {
                            $work2->{'inp_t_wk_etc_teate'.$j} = $_POST['etc_teate'.$j][$i];
                        }

                        // フォームを分けた場合の処理
                        // $kaban_time = $utils->formatHourMinute($_POST["kaban_time"][$i][0], $_POST["kaban_time"][$i][1]);                         // 下番時刻
                        // $daytime_over_time = $utils->formatHourMinute($_POST["daytime_over_time"][$i][0], $_POST["daytime_over_time"][$i][1]);    // 昼残時間
                        // $rest_over_time = $utils->formatHourMinute($_POST["rest_over_time"][$i][0], $_POST["rest_over_time"][$i][1]);             // 休憩残業時間
                        // $midnight_over_time = $utils->formatHourMinute($_POST["midnight_over_time"][$i][0], $_POST["midnight_over_time"][$i][1]); // 深夜残業時間

                        // 昼残時間
                        $daytime_over_time = $_POST['daytime_over_time'][$i];
                        // 休憩残業時間
                        $rest_over_time = $_POST['rest_over_time'][$i];
                        // 深夜残業時間
                        $midnight_over_time = $_POST['midnight_over_time'][$i];

                        // // 下番時刻
                        // if ($_POST['kaban_time'][$i] === '') {
                        //     $kaban_time = null;
                        // } else {
                        //     $kaban_time = $_POST['kaban_time'][$i];
                        // }
                        // // 昼残時間
                        // if ($_POST['daytime_over_time'][$i] === '') {
                        //     $daytime_over_time = null;
                        // } else {
                        //     $daytime_over_time = $_POST['daytime_over_time'][$i];
                        // }
                        // // 休憩残業時間
                        // if ($_POST['rest_over_time'][$i] === '') {
                        //     $rest_over_time = null;
                        // } else {
                        //     $rest_over_time = $_POST['rest_over_time'][$i];
                        // }
                        // // 深夜残業時間
                        // if ($_POST['midnight_over_time'][$i] === '') {
                        //     $midnight_over_time = null;
                        // } else {
                        //     $midnight_over_time = $_POST['midnight_over_time'][$i];
                        // }

                        $work2->inp_t_wk_daytime_over_time = $daytime_over_time;   // 昼残時間
                        $work2->inp_t_wk_rest_over_time = $rest_over_time;         // 休憩残業時間
                        $work2->inp_t_wk_midnight_over_time = $midnight_over_time; // 深夜残業時間
                        $work2->inp_t_wk_post_teate = $_POST['post_teate'][$i];    // ポスト手当
                        $work2->inp_t_wk_kotuhi = $_POST['kotuhi'][$i];            // 交通費
                        $work2->inp_t_wk_modified    = date('Y-m-d H:i:s');        // 更新日
                        $work2->inp_t_wk_modified_id = $_SESSION["staff_id"];      // 更新者

                    if (($_POST["kaban_time"][$i] != "") && ($_POST["kaban_dakoku"][$i]=="")) {
                        $work2->inp_t_wk_kaban_dakoku_time = date("H:i:s");
                    }

$file = '../log/log.txt';
// ファイルをオープンして既存のコンテンツを取得します
$current = file_get_contents($file);
// 新しい人物をファイルに追加します
$current .= date('m-d H:i:s')." ";
$current .= "下番（リーダー） ".$_SESSION["staff_id"]."\n";
// 結果をファイルに書き出します
file_put_contents($file, $current);

                        // 作業の更新
                        $work2->updateWkdetail();
            }

            // HTML表示
            header('Location:../controllers/menu.php');

            break;
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/kaban1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/kaban1_html.php');
    }
?>
