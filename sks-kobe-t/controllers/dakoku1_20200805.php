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
    require_once('../models/Kotuhi.php');                 // 交通費クラス

    $act        = null;
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
    $work       = new Wkdetail;     // 作業クラス
    $work_mem   = new Wkdetail;     // 作業クラス
    $staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス
    $shift      = new Shift;        // シフトマスタクラス
    $kotuhi     = new Kotuhi;       // 交通費マスタクラス
    $work2      = new Wkdetail;     // 作業クラス

    // // 打刻する隊員IDの宣言
    // $dakoku_staff_id = '';
    // $dakoku_staff_name = '';


    // if (isset($_POST["staff_id"])) {
    //     // postされた隊員IDから隊員を検索
    //     $staff->inp_m_staff_id = $_POST["staff_id"];

    //     // 社員マスタ 取得
    //     $staff->getStaff();
    //     $dakoku_staff_id = $staff->oup_m_staff_id[0];
    //     $dakoku_staff_name = $staff->oup_m_staff_name[0];

    //     //(日:0〜土:6)を設定
    //     $week = [
    //         '日', // 0
    //         '月', // 1
    //         '火', // 2
    //         '水', // 3
    //         '木', // 4
    //         '金', // 5
    //         '土', // 6
    //     ];

    //     // 検索結果があれば、打刻画面に移動
    //     if ($dakoku_staff_id !== null) {
    //         require_once('../views/dakoku2_html.php');
    //         exit;
    //     }
    // }

    // 上番打刻
    if (isset($_POST["joban_dakoku"])) {

        // 交通費マスタ 取得 に必要な情報をセット
        $kotuhi->inp_m_kotuhi_startday = date('Y-m-d');

        // 交通費マスタ 取得
        $kotuhi->getKotuhi();

        for ($i=0;$i<count($kotuhi->oup_m_kotuhi_no);$i++) {
            $kotuhis[$kotuhi->oup_m_kotuhi_staff_id[$i]][$kotuhi->oup_m_kotuhi_place_id[$i]][$kotuhi->oup_m_kotuhi_hosoku[$i]] = $kotuhi->oup_m_kotuhi_cost[$i];
        }

        // 社員マスタ 取得 に必要な情報をセット
        $staff->inp_m_staff_id = $_SESSION["staff_id"];

        // 社員マスタ 取得
        $staff->getStaff();

        // 作業テーブル 取得 に必要な情報をセット
        $work->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
        $work->inp_t_wk_plan_date   = date('Ymd');
        $work->inp_t_wk_del_flg     = "0";

        // リーダーの作業テーブル 取得
        $work->getWkdetail();

        if ($work->oup_t_wk_detail_no[0] == null) {
            // 新規登録
            $work_mem->inp_t_wk_joban_kbn = "1";
            $work_mem->inp_t_wk_office_id = 0;
            $work_mem->inp_t_wk_taiin_id = $_SESSION["staff_id"];
            $work_mem->inp_t_wk_plan_date   = date('Ymd');
            $work_mem->inp_t_wk_joban_dakoku_time = date("H:i:s");
            $work_mem->inp_t_wk_joban_time = date("H:i:s");
            $work_mem->insertWkdetail();
        }

        for ($i=0;$i<count($work->oup_t_wk_detail_no);$i++) {

            if ($work->oup_t_wk_joban_kbn[$i]=="") {

$file = '../log/log.txt';
// ファイルをオープンして既存のコンテンツを取得します
$current = file_get_contents($file);
// 新しい人物をファイルに追加します
$current .= date('m-d H:i:s')." ";
$current .= "個人打刻 上番 ".$_SESSION["staff_id"]."\n";
// 結果をファイルに書き出します
file_put_contents($file, $current);


                // 更新
                $work_mem->inp_t_wk_joban_kbn = "1";
                $work_mem->inp_t_wk_detail_no = $work->oup_t_wk_detail_no[$i];
                $work_mem->inp_t_wk_joban_dakoku_time = date("H:i:s");
//                $work_mem->inp_t_wk_joban_time = date("H:i:s");
                $work_mem->inp_t_wk_joban_time = $work->oup_t_wk_plan_joban_time[$i];
                // 交通費
                if ($kotuhis[$work->oup_t_wk_taiin_id[$i]][$work->oup_t_wk_genba_id[$i]][$work->oup_t_wk_plan_hosoku[$i]]=="") {
                    $work_mem->inp_t_wk_kotuhi      = $kotuhis[$work->oup_t_wk_taiin_id[$i]][$work->oup_t_wk_genba_id[$i]][''];
                } else {
                    $work_mem->inp_t_wk_kotuhi      = $kotuhis[$work->oup_t_wk_taiin_id[$i]][$work->oup_t_wk_genba_id[$i]][$work->oup_t_wk_plan_hosoku[$i]];
                }
                // 連勤の場合は登録しない
                // 泊→泊の場合
                // 夜勤→泊の場合
                // 泊→日の場合
                // 夜勤→日の場合

                // 作業テーブル 取得 に必要な情報をセット
                $work2->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
                $work2->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
                $work2->inp_t_wk_del_flg     = "0";
                $work2->inp_t_wk_genba_id    = $work->oup_t_wk_genba_id[$i];

                // リーダーの作業テーブル 取得
                $work2->getWkdetail();

                if (($work2->oup_t_wk_plan_kbn[0]=="1" && $work->oup_t_wk_plan_kbn[$i]=="1") || 
                    ($work2->oup_t_wk_plan_kbn[0]=="3" && $work->oup_t_wk_plan_kbn[$i]=="1") || 
                    ($work2->oup_t_wk_plan_kbn[0]=="1" && $work->oup_t_wk_plan_kbn[$i]=="2") || 
                    ($work2->oup_t_wk_plan_kbn[0]=="3" && $work->oup_t_wk_plan_kbn[$i]=="2")) {
                    $work_mem->inp_t_wk_kotuhi = 0;
                }

                $work_mem->updateWkdetail();


                /*
                 * 勤務時間の更新
                 */

                //既に手入力がある場合は計算しない
                if ($work->oup_t_wk_inp_kbn[$i] != "1") {
                    $work2      = new Wkdetail;     // 作業クラス
                    $work3      = new Wkdetail;     // 作業クラス
                    $shift      = new Shift;        // シフトクラス

                    // シフト取得
                    $shift->inp_m_shift_no = $work->oup_t_wk_shift_no[$i];
                    $shift->getShift();

                    $work2->inp_shift_ktime = $shift->oup_m_shift_kyukei_time[0]; // 休憩
                    $work2->inp_shift_otime = $shift->oup_m_shift_over_time[0]; // 所定残
                    $work2->inp_shift_rtime = $shift->oup_m_shift_rodo_time[0]; // 労働時間
                    $work2->inp_joban_kbn = $work->oup_t_wk_joban_kbn[$i];
                    $work2->inp_plan_kbn = $work->oup_t_wk_plan_kbn[$i];
                    $work2->inp_plan_joban_time = $work->oup_t_wk_plan_joban_time[$i];
                    $work2->inp_plan_kaban_time = $work->oup_t_wk_plan_kaban_time[$i];
                    $work2->inp_joban_time = $work->oup_t_wk_joban_time[$i];
                    $work2->inp_kaban_time = $work->oup_t_wk_kaban_time[$i];
                    $work2->getcalckintime();

                    $work3->inp_t_wk_detail_no = $work->oup_t_wk_detail_no[$i];
                    $work3->inp_t_wk_kinmu_time = $work2->kinmu_time;
                    $work3->inp_t_wk_syotei_zan = $work2->syotei_otime;
                    $work3->inp_t_wk_hayazan = $work2->hayazan_time;
                    $work3->inp_t_wk_tuzan = $work2->tuzan_time;

                    $work3->updateWkdetail();
                }

                break;
            }
        }

        // アラート
        $alert = "<script type='text/javascript'>alert('上番打刻しました。');</script>";
        echo $alert;

        $dakoku_staff_id = '';
        $dakoku_staff_name = '';

        $url = $_SERVER['PHP_SELF'];
        $reload = "<script type='text/javascript'>location.href = '$url';</script>";
        echo $reload;
    }

    // 下番打刻
    if (isset($_POST["kaban_dakoku"])) {
        // 社員マスタ 取得 に必要な情報をセット
        $staff->inp_m_staff_id = $_SESSION["staff_id"];

        // 社員マスタ 取得
        $staff->getStaff();

        // 作業テーブル 取得 に必要な情報をセット
        $work->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
        $work->inp_t_wk_plan_date   = date('Ymd');
        $work->inp_t_wk_del_flg     = "0";

        // リーダーの作業テーブル 取得
        $work->getWkdetail();

        // 前日の作業者で下番登録していない人
        $work2 = new Wkdetail;
        $work2->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
        $work2->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
        $work2->inp_t_wk_kaban_time  = "null";
        $work2->inp_t_wk_del_flg     = "0";
        $work2->getWkdetail();

        // 昨日の実績か今日の実績か判定
        if (count($work2->oup_t_wk_detail_no) != 0 && is_null($work2->oup_t_wk_kaban_time[0])) {

$file = '../log/log.txt';
// ファイルをオープンして既存のコンテンツを取得します
$current = file_get_contents($file);
// 新しい人物をファイルに追加します
$current .= date('m-d H:i:s')." ";
$current .= "個人打刻 下番 ".$_SESSION["staff_id"]."\n";
// 結果をファイルに書き出します
file_put_contents($file, $current);

            // 昨日
            // 更新
            $work_mem->inp_t_wk_kaban_kbn = "1";
            $work_mem->inp_t_wk_detail_no = $work2->oup_t_wk_detail_no[0];
            $work_mem->inp_t_wk_kaban_dakoku_time = date('H:i:s', strtotime('-1 day'));
//            $work_mem->inp_t_wk_kaban_time = date("H:i:s");
            $work_mem->inp_t_wk_kaban_time = $work2->oup_t_wk_plan_kaban_time[0];;
            $work_mem->updateWkdetail();
        } else {
            // 今日
            if ($work->oup_t_wk_detail_no[0] == null) {

                // 下番されていなければエラー
                $errmsg = "先に上番をおこなってください";

                // 新規登録
//                $work_mem->inp_t_wk_kaban_kbn = "1";
//                $work_mem->inp_t_wk_office_id = 0;
//                $work_mem->inp_t_wk_taiin_id = $_SESSION["staff_id"];
//                $work_mem->inp_t_wk_plan_date   = date('Ymd');
//                $work_mem->inp_t_wk_kaban_dakoku_time = date("H:i:s");
//                $work_mem->inp_t_wk_kaban_time = date("H:i:s");
//                $work_mem->insertWkdetail();
            } else {

                for ($i=0;$i<count($work->oup_t_wk_detail_no);$i++) {

                    if ($work->oup_t_wk_joban_kbn[$i]=="") {

                        // 下番されていなければエラー
                        $errmsg = "先に上番をおこなってください";

                    } else if ($work->oup_t_wk_kaban_kbn[$i]=="") {

$file = '../log/log.txt';
// ファイルをオープンして既存のコンテンツを取得します
$current = file_get_contents($file);
// 新しい人物をファイルに追加します
$current .= date('m-d H:i:s')." ";
$current .= "個人打刻 下番 ".$_SESSION["staff_id"]."\n";
// 結果をファイルに書き出します
file_put_contents($file, $current);

//DBに時間登録（未）
//                        //実績があれば勤務、所定残、早残、通残を計算してアップデート
//                        $wk = new Wkdetail;
//                        $wk->inp_t_wk_detail_no = $work->oup_t_wk_detail_no[$i];
//                        $wk->getWkdetail();
//                        
//                        $shift2 = new Shift;
//                        $shift2->inp_m_shift_no = $wk->oup_t_wk_shift_no[$i];
//                        $shift2->getShift();
//                        
//                        $calc = new Wkdetail;
//                        $calc->inp_joban_kbn = $wk->oup_t_wk_joban_kbn[$i];
//                        $calc->inp_plan_kbn = $shift2->oup_m_shift_plan_kbn[$i];
//                        $calc->inp_plan_joban_time = $shift2->oup_m_shift_joban_time[$i];
//                        $calc->inp_plan_kaban_time = $shift2->oup_m_shift_kaban_time[$i];
//                        $calc->inp_joban_time = $wk->oup_t_wk_joban_time[$i];
//                        $calc->inp_kaban_time = $work->oup_t_wk_plan_kaban_time[$i];
//                        $calc->inp_shift_rtime = $shift2->oup_m_shift_rodo_time[$i];
//                        $calc->inp_shift_otime = $shift2->oup_m_shift_over_time[$i];
//                        $calc->inp_shift_ktime = $shift2->oup_m_shift_kyukei_time[$i];
//                        $calc->getcalckintime();
//                        
//                        $work_mem->inp_t_wk_kinmu_time = $calc->kinmu_time[$i];
//                        $work_mem->inp_t_wk_syotei_zan = $calc->syotei_otime[$i];
//                        $work_mem->inp_t_wk_hayazan = $calc->hayazan_time[$i];
//                        $work_mem->inp_t_wk_tuzan = $calc->tuzan_time[$i];
//                        //var_dump($work->oup_t_wk_plan_kaban_time);
//                        //exit;
                        
                        // 更新
                        $work_mem->inp_t_wk_kaban_kbn = "1";
                        $work_mem->inp_t_wk_detail_no = $work->oup_t_wk_detail_no[$i];
                        $work_mem->inp_t_wk_kaban_dakoku_time = date("H:i:s");
//                        $work_mem->inp_t_wk_kaban_time = date("H:i:s");
                        $work_mem->inp_t_wk_kaban_time = $work->oup_t_wk_plan_kaban_time[$i];
                        $work_mem->updateWkdetail();

                        /*
                         * 勤務時間の更新
                         */

                        //既に手入力がある場合は計算しない
                        if ($work->oup_t_wk_inp_kbn[$i] != "1") {
                            $work2      = new Wkdetail;     // 作業クラス
                            $work3      = new Wkdetail;     // 作業クラス
                            $shift      = new Shift;        // シフトクラス

                            // シフト取得
                            $shift->inp_m_shift_no = $work->oup_t_wk_shift_no[$i];
                            $shift->getShift();

                            $work2->inp_shift_ktime = $shift->oup_m_shift_kyukei_time[0]; // 休憩
                            $work2->inp_shift_otime = $shift->oup_m_shift_over_time[0]; // 所定残
                            $work2->inp_shift_rtime = $shift->oup_m_shift_rodo_time[0]; // 労働時間
                            $work2->inp_joban_kbn = $work->oup_t_wk_joban_kbn[$i];
                            $work2->inp_plan_kbn = $work->oup_t_wk_plan_kbn[$i];
                            $work2->inp_plan_joban_time = $work->oup_t_wk_plan_joban_time[$i];
                            $work2->inp_plan_kaban_time = $work->oup_t_wk_plan_kaban_time[$i];
                            $work2->inp_joban_time = $work->oup_t_wk_joban_time[$i];
                            $work2->inp_kaban_time = $work->oup_t_wk_kaban_time[$i];
                            $work2->getcalckintime();

                            $work3->inp_t_wk_detail_no = $work->oup_t_wk_detail_no[$i];
                            $work3->inp_t_wk_kinmu_time = $work2->kinmu_time;
                            $work3->inp_t_wk_syotei_zan = $work2->syotei_otime;
                            $work3->inp_t_wk_hayazan = $work2->hayazan_time;
                            $work3->inp_t_wk_tuzan = $work2->tuzan_time;

                            $work3->updateWkdetail();
                        }

                        break;
                    }
                }
            }
        }

        if ($errmsg == "") {

            // アラート
            $alert = "<script type='text/javascript'>alert('下番打刻しました。');</script>";
            echo $alert;
            
            $url = $_SERVER['PHP_SELF'];
            $reload = "<script type='text/javascript'>location.href = '$url';</script>";
            echo $reload;

        } else {
            $alert = "<script type='text/javascript'>alert('".$errmsg."');</script>";
            echo $alert;
        }

        $dakoku_staff_id = '';
        $dakoku_staff_name = '';
    }


    // sessionから社員を検索
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();
    $dakoku_staff_id = $staff->oup_m_staff_id[0];
    $dakoku_staff_name = $staff->oup_m_staff_name[0];

    // 作業テーブル 取得 に必要な情報をセット
    $work->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
    $work->inp_t_wk_plan_date   = date('Ymd');
    $work->inp_t_wk_del_flg     = "0";
    // 作業テーブル 取得
    $work->getWkdetail();

    //(日:0〜土:6)を設定
    $week = [
        '日', // 0
        '月', // 1
        '火', // 2
        '水', // 3
        '木', // 4
        '金', // 5
        '土', // 6
    ];

    // 検索結果があれば、打刻画面に移動
    if ($dakoku_staff_id !== null) {
        require_once('../views/dakoku2_html.php');
        exit;
    }


    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        // require_once('../views/dakoku2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/dakoku2_html.php');
    }
?>