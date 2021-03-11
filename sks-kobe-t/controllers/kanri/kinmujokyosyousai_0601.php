<?php
session_start();

// ログインチェック
if (!isset($_SESSION["staff_id"])) {
    // HTML表示
    header('Location:login.php');
}
?>
<?php
require_once('../../models/common/common.php');          // 共通クラス
require_once('../../models/common/db.php');              // DBクラス
require_once('../../models/Genba.php');                  // 現場クラス
require_once('../../models/Staff.php');                  // 社員クラス
require_once('../../models/Wkdetail.php');               // シフト予定クラス
require_once('../../models/Shift.php');                  // シフトクラス
require_once('./../function/utils.php');                 // 関数クラス
require_once('../../models/PostTeate.php');              // ポスト手当てクラス

$week = array("日", "月", "火", "水", "木", "金", "土");
$time = strtotime(date('Y-m-d'));
$w = date("w", $time);

// 残業時間の選択に使用
$select_daytime = array(
  '00:00' => '0',
  '00:15' => '15',
  '00:30' => '30',
  '00:45' => '45',
  '01:00' => '60'
);

if (isset($_REQUEST['startday'])) {
    $startday = $_REQUEST['startday'];
} else {
    $startday = date('Ymd');
}
if (isset($_REQUEST['endday'])) {
    $endday = $_REQUEST['endday'];
} else {
    $endday = date('Ymd');
}

/*********************************************************
 *	クラスの作成
********************************************************/
$common     = new Common;       // 共通クラス
$genba      = new Genba;        // 現場マスタクラス
$staff      = new Staff;        // 社員マスタクラス
$wkdetail   = new Wkdetail;     // シフト予定マスタクラス
$shift      = new Shift;        // シフトクラス
$utils      = new Utils;        // 関数クラス
$postteate  = new PostTeate;    // ポスト手当てクラス

// ポスト手当て取得
$postteate->getPostteate();

// 勤務状況の更新
if (isset($_POST["detail_no"])) {
    // 送信された値の整形
    // 勤務
    if (isset($_POST["kinmu"])) {
        $kinmu = explode(' ', $_POST["kinmu"]);
        $genba_id = $kinmu[0];
        $kinmu_kbn = $kinmu[1];
        $kinmu_hosoku = $kinmu[2];
    } else {
        $genba_id = null;
        $kinmu_kbn = null;
        $kinmu_hosoku = null;
    }
    // 所定時間 開始
    if(($_POST["plan_joban_time"][0] == "") && ($_POST["plan_joban_time"][1] == "")) {
        $plan_joban_time = "";
    } else {
    	$plan_joban_time = $utils->formatHourMinute($_POST["plan_joban_time"][0], $_POST["plan_joban_time"][1]);
	}
    // 所定時間 終了
    if(($_POST["plan_kaban_time"][0] == "") && ($_POST["plan_kaban_time"][1] == "")) {
        $plan_kaban_time = "";
    } else {
    	$plan_kaban_time = $utils->formatHourMinute($_POST["plan_kaban_time"][0], $_POST["plan_kaban_time"][1]);
	}
    // 打刻 上番
    if(($_POST["joban_dakoku_time"][0] == "") && ($_POST["joban_dakoku_time"][1] == "")) {
        $joban_dakoku_time = "";
    } else {
    	$joban_dakoku_time = $utils->formatHourMinute($_POST["joban_dakoku_time"][0], $_POST["joban_dakoku_time"][1]);
	}
    // 打刻 下番
    if(($_POST["kaban_dakoku_time"][0] == "") && ($_POST["kaban_dakoku_time"][1] == "")) {
        $kaban_dakoku_time = "";
    } else {
    	$kaban_dakoku_time = $utils->formatHourMinute($_POST["kaban_dakoku_time"][0], $_POST["kaban_dakoku_time"][1]);
	}
    // 実績 上番
    if(($_POST["joban_time"][0] == "") && ($_POST["joban_time"][1] == "")) {
        $joban_time = "";
    } else {
	    $joban_time = $utils->formatHourMinute($_POST["joban_time"][0], $_POST["joban_time"][1]);
	}
    // 実績 下番
    if(($_POST["kaban_time"][0] == "") && ($_POST["kaban_time"][1] == "")) {
        $kaban_time = "";
    } else {
    	$kaban_time = $utils->formatHourMinute($_POST["kaban_time"][0], $_POST["kaban_time"][1]);
    }
    // 交通費
    if (isset($_POST["kotuhi"])) {
        $kotuhi = $_POST["kotuhi"];
    } else {
        $kotuhi = null;
    }
    // 時間外勤務 昼残
    if (isset($_POST["daytime_over_time"])) {
        $daytime_over_time = $_POST["daytime_over_time"];
    } else {
        $daytime_over_time = null;
    }
    // 時間外勤務 休憩残業
    if (isset($_POST["rest_over_time"])) {
        $rest_over_time = $_POST["rest_over_time"];
    } else {
        $rest_over_time = null;
    }
    // 時間外勤務 深夜残業
    if (isset($_POST["midnight_over_time"])) {
        $midnight_over_time = $_POST["midnight_over_time"];
    } else {
        $midnight_over_time = null;
    }
    // 手当て ポスト
    if (isset($_POST["post_teate"])) {
        $post_teate = $_POST["post_teate"];
    } else {
        $post_teate = null;
    }
    // 手当て 正月
    if (isset($_POST["shogatu_teate"])) {
        $shogatu_teate = $_POST["shogatu_teate"];
    } else {
        $shogatu_teate = null;
    }
    // 手当て 夏季
    if (isset($_POST["kaki_teate"])) {
        $kaki_teate = $_POST["kaki_teate"];
    } else {
        $kaki_teate = null;
    }
    // 手当て 1
    if (isset($_POST["etc_teate1"])) {
        $etc_teate1 = $_POST["etc_teate1"];
    } else {
        $etc_teate1 = null;
    }
    // 手当て 2
    if (isset($_POST["etc_teate2"])) {
        $etc_teate2 = $_POST["etc_teate2"];
    } else {
        $etc_teate2 = null;
    }
    // 手当て 3
    if (isset($_POST["etc_teate3"])) {
        $etc_teate3 = $_POST["etc_teate3"];
    } else {
        $etc_teate3 = null;
    }
    // 上番区分
    if (isset($_POST["joban_kbn"])) {
        $joban_kbn = $_POST["joban_kbn"];
    } else {
        $joban_kbn = "";
    }
    // 下番区分
    if (isset($_POST["kaban_kbn"])) {
        $kaban_kbn = $_POST["kaban_kbn"];
    } else {
        $kaban_kbn = "";
    }

    // 勤務詳細情報を更新
    $wkdetail->inp_t_wk_detail_no = $_POST["detail_no"];
    $wkdetail->inp_t_wk_genba_id = $genba_id; // 現場ID
    $wkdetail->inp_t_wk_plan_kbn = $kinmu_kbn; // 勤務(区分)
    $wkdetail->inp_t_wk_plan_hosoku = $kinmu_hosoku; // 勤務(補足)
    $wkdetail->inp_t_wk_plan_joban_time = $plan_joban_time; // 所定時間 開始
    $wkdetail->inp_t_wk_plan_kaban_time = $plan_kaban_time; // 所定時間 終了
    $wkdetail->inp_t_wk_joban_dakoku_time = $joban_dakoku_time; // 打刻 上番
    $wkdetail->inp_t_wk_kaban_dakoku_time = $kaban_dakoku_time; // 打刻 下番
    $wkdetail->inp_t_wk_joban_kbn = $joban_kbn; // 実績 上番区分
    $wkdetail->inp_t_wk_joban_time = $joban_time; // 実績 上番
    $wkdetail->inp_t_wk_kaban_kbn = $kaban_kbn; // 実績 下番区分
    $wkdetail->inp_t_wk_kaban_time = $kaban_time; // 実績 下番
    $wkdetail->inp_t_wk_kotuhi = $kotuhi; // 交通費
    $wkdetail->inp_t_wk_daytime_over_time = $daytime_over_time; // 時間外勤務 昼残
    $wkdetail->inp_t_wk_rest_over_time = $rest_over_time; // 時間外勤務 休憩残業
    $wkdetail->inp_t_wk_midnight_over_time = $midnight_over_time; // 時間外勤務 深夜残業
    $wkdetail->inp_t_wk_post_teate = $post_teate; // 手当て ポスト
    $wkdetail->inp_t_wk_shogatu_teate = $shogatu_teate; // 手当て 正月
    $wkdetail->inp_t_wk_kaki_teate = $kaki_teate; // 手当て 夏季
    $wkdetail->inp_t_wk_etc_teate1 = $etc_teate1; // 手当て 1
    $wkdetail->inp_t_wk_etc_teate2 = $etc_teate2; // 手当て 2
    $wkdetail->inp_t_wk_etc_teate3 = $etc_teate3; // 手当て 3
    $wkdetail->updateWkdetail();

    // メッセージ
    $successmsg = '更新に成功しました。';


    // 更新後、再度値を取得
    // 勤務詳細情報を取得
    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
    $wkdetail->inp_t_wk_detail_no = $_POST["detail_no"];
    $wkdetail->getWkdetail();

    // 会員情報を取得
    $staff->inp_m_staff_id = $wkdetail->oup_t_wk_taiin_id[0];
    $staff->getStaff();

    // 現場情報を取得
    if ($wkdetail->oup_t_wk_genba_id[0] !== '') {
        $genba->inp_m_genba_id = $wkdetail->oup_t_wk_genba_id[0];
        $genba->getGenba();
        $genba_name = $genba->oup_m_genba_name[0];
    } else {
        $genba_name = '';
    }

    // 現場の勤務区分を取得
    // $shift->inp_m_shift_genba_id = $wkdetail->oup_t_wk_genba_id[0];
    $shift->getShift();
}


// 編集する会員の情報を取得
if (isset($_REQUEST['no'])) {
    // 勤務詳細情報を取得
    $wkdetail->inp_t_wk_detail_no = $_REQUEST['no'];
    $wkdetail->getWkdetail();

    // 会員情報を取得
    $staff->inp_m_staff_id = $wkdetail->oup_t_wk_taiin_id[0];
    $staff->getStaff();

    // 現場情報を取得
    if ($wkdetail->oup_t_wk_genba_id[0] !== '') {
        $genba->inp_m_genba_id = $wkdetail->oup_t_wk_genba_id[0];
        $genba->getGenba();
        $genba_name = $genba->oup_m_genba_name[0];
    } else {
        $genba_name = '';
    }


    // 現場の勤務区分を取得
    // $shift->inp_m_shift_genba_id = $wkdetail->oup_t_wk_genba_id[0];
    $shift->getShift();
}

// データの削除
if ($_GET["act"] == "2") {
    
    // データ削除
    //$wkdetail->inp_t_wk_detail_no = $wk_detail_no;
    $wkdetail->inp_t_wk_detail_no = $_REQUEST["no"];
    $wkdetail->deletedetail_no();

    header('Location:kinmujokyo.php');
}


// キャリア判定（PC/スマートフォン/タブレット）
if ($common->judgephone) {
    // HTML表示
    require_once('../../views/kanri/kinmujokyosyousai_html.php');
// キャリア判定（フィーチャーフォン）
} else {
    // HTML表示
    require_once('../../views/m/kanri/kinmujokyosyousai_html.php');
}
?>