<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Shift.php');                  // シフトクラス
    require_once('../../models/Genba.php');                  // 現場クラス
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

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $shift      = new Shift;        // シフトマスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス

    // 現場マスタ 取得
    $genba->getGenba();

    // 現場マスタの内容を配列に格納
    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genba_m[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    }

    // 表示順の現場別の区分別に表示する
    $shift->inp_left_join_m_genba = 1;
    $shift->inp_order = "order by case m_shift_deleteday when 0 then 1 else 2 end,m_shift_deleteday desc,m_genba.m_genba_hyoji_kbn, m_shift.m_shift_genba_id, m_shift.m_shift_plan_kbn, m_shift.m_shift_joban_time";

    // シフトマスタ 取得
    $shift->getShift();
    for ($i=0;$i<count($shift->oup_m_shift_no);$i++) {
        if ($shift->oup_m_shift_deleteday[$i] < 1) {
            $shift->oup_m_shift_deleteday[$i] = "";
        }
    }

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/shift1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/shift1_html.php');
    }
?>
