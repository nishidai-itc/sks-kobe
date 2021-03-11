<?php
    session_start();

// var_dump($_SESSION);
    // ログインチェック
    if (!isset($_SESSION["staff_id"])) {
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Genba.php');                  // 現場クラス
    require_once('../../models/Shift.php');                  // シフトクラス
    require_once('../../models/Staff.php');                  // 社員クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");

    $color_code_list = array(
        '#FF8080' => '赤',
        '#ebd8c0' => '茶',
        // '#8080FF' => '青',
        '#FFFF80' => '黄',
        '#00FF80' => '緑',
        '#F8DAD8' => 'ピンク',
        '#F5B076' => 'オレンジ',
    );

    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    if (isset($_REQUEST["act"])) {
        $act          = $_REQUEST["act"];
        $plan_kbn     = $_REQUEST["plan_kbn"];
        $plan_hosoku  = $_REQUEST["plan_hosoku"];
        $color        = $_REQUEST["color"];
        $genba_id     = $_REQUEST["genba_id"];
        $joban_time   = $_REQUEST["joban_time"];
        $kaban_time   = $_REQUEST["kaban_time"];
        $kyukei_start = $_REQUEST["kyukei_start"];
        $kyukei_end   = $_REQUEST["kyukei_end"];
        $jikyu        = $_REQUEST["jikyu"];
        $nikyu        = $_REQUEST["nikyu"];
        $rodo_time    = $_REQUEST["rodo_time"];
        $over_time    = $_REQUEST["over_time"];
        $kyukei_time  = $_REQUEST["kyukei_time"];
        $shift_id2    = $_REQUEST["shift_id2"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $shift      = new Shift;        // シフトマスタクラス
    $shift2     = new Shift;        // シフトマスタクラス
    $shift3     = new Shift;        // シフトマスタクラス
    $staff      = new Staff;        // 社員マスタクラス

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";

    // 現場マスタ 取得
    $genba->getGenba();

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 取引先詳細画面で「登録」ボタンが押された場合
    if ($act == "1") {
        if ($plan_kbn == '' || $genba_id == '') {
            $error_message = '勤務区分と現場名を入力してください。';
        } else {

            // 勤務区分、補足文字、現場、開始時間、終了時間が同じデータは登録できないようにする
            $shift3->inp_m_shift_plan_kbn     = $plan_kbn;
            $shift3->inp_m_shift_plan_hosoku  = $plan_hosoku;
            $shift3->inp_m_shift_genba_id     = $genba_id;
            if ($shift_id2 != "") {
                $shift3->inp_m_shift_free         = "and m_shift_no <> '".$shift_id2."' ";
            }
            $shift3->getShift();

            if (count($shift3->oup_m_shift_no) != 0) {
                $error_message = '勤務区分、補足文字、現場名 が同じデータが既に登録されています。';
            } else {

            if ($shift_id2 == "") {
                $shift2->inp_m_shift_plan_kbn     = $plan_kbn;
                $shift2->inp_m_shift_plan_hosoku  = $plan_hosoku;
                $shift2->inp_m_shift_color        = $color;
                $shift2->inp_m_shift_genba_id     = $genba_id;
                $shift2->inp_m_shift_joban_time   = $joban_time;
                $shift2->inp_m_shift_kaban_time   = $kaban_time;
                $shift2->inp_m_shift_kyukei_start = $kyukei_start;
                $shift2->inp_m_shift_kyukei_end   = $kyukei_end;
                $shift2->inp_m_shift_jikyu        = $jikyu;
                $shift2->inp_m_shift_nikyu        = $nikyu;
                $shift2->inp_m_shift_rodo_time    = $rodo_time;
                $shift2->inp_m_shift_over_time    = $over_time;
                $shift2->inp_m_shift_kyukei_time  = $kyukei_time;
                $shift2->inp_m_shift_created      = date('Y-m-d H:i:s');
                $shift2->inp_m_shift_created_id   = $_SESSION["staff_id"];

                // データ登録
                $shift2->insertShift();
            } else {
                $shift2->inp_m_shift_plan_kbn     = $plan_kbn;
                $shift2->inp_m_shift_plan_hosoku  = $plan_hosoku;
                $shift2->inp_m_shift_color        = $color;
                $shift2->inp_m_shift_genba_id     = $genba_id;
                $shift2->inp_m_shift_joban_time   = $joban_time;
                $shift2->inp_m_shift_kaban_time   = $kaban_time;
                $shift2->inp_m_shift_kyukei_start = $kyukei_start;
                $shift2->inp_m_shift_kyukei_end   = $kyukei_end;
                $shift2->inp_m_shift_jikyu        = $jikyu;
                $shift2->inp_m_shift_nikyu        = $nikyu;
                $shift2->inp_m_shift_rodo_time    = $rodo_time;
                $shift2->inp_m_shift_over_time    = $over_time;
                $shift2->inp_m_shift_kyukei_time  = $kyukei_time;
                $shift2->inp_m_shift_modified     = date('Y-m-d H:i:s');
                $shift2->inp_m_shift_modified_id  = $_SESSION["staff_id"];
                $shift2->inp_m_shift_no2          = $shift_id2;

                // データ更新
                $shift2->updateShift();
            }

            // // アラート
            // $alert = "<script type='text/javascript'>alert('登録しました。');</script>";
            // echo $alert;

            //header('Location:shift1.php');
            header('Location:shift1.php#'.$shift_id2);
        }
    }
    }
    if ($act == "2") {
        $shift2->inp_m_shift_no          = $shift_id2;

        // データ削除
        $shift2->deleteShift();

        header('Location:shift1.php');
    }
    if ($act == "") {
        if (isset($_REQUEST["no"])) {
            // シフトマスタ 取得
            $shift->inp_m_shift_no = $_REQUEST["no"];
            $shift->getShift();

            $plan_kbn     = $shift->oup_m_shift_plan_kbn[0];
            $plan_hosoku  = $shift->oup_m_shift_plan_hosoku[0];
            $color        = $shift->oup_m_shift_color[0];
            $genba_id     = $shift->oup_m_shift_genba_id[0];
            $joban_time   = $shift->oup_m_shift_joban_time[0];
            $kaban_time   = $shift->oup_m_shift_kaban_time[0];
            $kyukei_start = $shift->oup_m_shift_kyukei_start[0];
            $kyukei_end   = $shift->oup_m_shift_kyukei_end[0];
            $jikyu        = $shift->oup_m_shift_jikyu[0];
            $nikyu        = $shift->oup_m_shift_nikyu[0];
            $rodo_time    = $shift->oup_m_shift_rodo_time[0];
            $over_time    = $shift->oup_m_shift_over_time[0];
            $kyukei_time  = $shift->oup_m_shift_kyukei_time[0];
            $shift_id2    = $shift->oup_m_shift_no[0];

        }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/shift2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/shift2_html.php');
    }
?>