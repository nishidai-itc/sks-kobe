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
    require_once('../../models/Teate.php');                  // 手当てクラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $genba_id = null;
    $staff_id = null;
    $sp = "";
    $user_kana_array = array("" => "","1" => "ア","2" => "カ","3" => "サ","4" => "タ","5" => "ナ","6" => "ハ","7" => "マ","8" => "ヤ","9" => "ラ","10" => "ワ");

    // 残業時間の選択に使用
    $select_daytime = array(
      '00:00' => '0',
      '00:15' => '15',
      '00:30' => '30',
      '00:45' => '45',
      '01:00' => '60'
    );

    if (isset($_REQUEST["startday"])) {
        $_SESSION["sday"] = $_REQUEST["startday"];
    } else {
        if (!isset($_SESSION["sday"])) {
        $_SESSION["sday"] = date('Ymd');
        }
    }
    if (isset($_REQUEST["endday"])) {
        $_SESSION["eday"] = $_REQUEST["endday"];
    } else {
        if (!isset($_SESSION["eday"])) {
        $_SESSION["eday"] = date('Ymd');
        }
    }
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
    if (isset($_REQUEST['user_kana'])) {
        $user_kana = $_REQUEST['user_kana'];
    }
    
    //親の時親子現場検索、子の時単体検索
//    if (isset($_REQUEST['oyako_kbn'])) {
//        $oyako_kbn = $_REQUEST['oyako_kbn'];
//        $_SESSION["oyako"] = $_REQUEST['oyako_kbn'];
//    } else {
//        $oyako_kbn = $_SESSION["oyako"];
//    }
    
    $startday   = str_replace("-",$sp,$_SESSION["sday"]);
    $endday     = str_replace("-",$sp,$_SESSION["eday"]);

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $staff2     = new Staff;        // 社員マスタクラス
    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
    $shift      = new Shift;        // シフトクラス
    $work       = new Wkdetail;     // 作業クラス
    $teate      = new Teate;        // 手当てマスタクラス
    $genba2     = new Genba;        // 現場マスタクラス

    // シフトの取得
    $shift->getShift();

    $shift2 = array();

    for ($i=0;$i<count($shift->oup_m_shift_no);$i++) {
//        $shift2_col[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]] = $shift->oup_m_shift_color[$i];
        $shift2_rod[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_rodo_time[$i];
        $shift2_ovr[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_over_time[$i];
    }
    
    //ﾁｪｯｸ済登録
    if (isset($_POST["check_teate"]) && isset($_POST["chk"])) {
            $check_teate = $_POST["check_teate"];
            $chk = $_POST["chk"];
            // 登録
            foreach ($check_teate as $wkdetail_no) {
                // 初期化
                $wkdetail_chk   = new Wkdetail;
                // 勤務詳細情報を更新
                $wkdetail_chk->inp_t_wk_detail_no = $wkdetail_no;
                $wkdetail_chk->inp_t_wk_chk_kbn = $chk; // ﾁｪｯｸ
                $wkdetail_chk->inp_t_wk_chk_created         = date('Y-m-d H:i:s');
                $wkdetail_chk->updateWkdetail();
            }
    }

    // 手当てマスタ 取得
    $teate->getTeate();

    // 時間外一括登録
    if (isset($_POST["over_time"]) && $_POST["over_time"] != "") {
        if (isset($_POST["check_teate"]) && isset($_POST["input_over"])) {

            $check_teate = $_POST["check_teate"];
            $over_time = $_POST["over_time"];
            $input_over = $_POST["input_over"];

            // 登録
            foreach ($check_teate as $wkdetail_no) {

                // 初期化
                $wkdetail_teate   = new Wkdetail;

                // 勤務詳細情報を更新
                $wkdetail_teate->inp_t_wk_detail_no = $wkdetail_no;
                if ($over_time ===  'daytime') {
                    $wkdetail_teate->inp_t_wk_daytime_over_time = $input_over; // 昼残
                } elseif ($over_time ===  'rest') {
                    $wkdetail_teate->inp_t_wk_rest_over_time = $input_over; // 休憩残
                } elseif ($over_time ===  'midnight') {
                    $wkdetail_teate->inp_t_wk_midnight_over_time = $input_over; // 深夜残
                }

                $wkdetail_teate->updateWkdetail();
            }
        }
    }

    // 手当て一括登録
    if (isset($_POST["select_teate"]) && $_POST["select_teate"] != "") {
        if (isset($_POST["check_teate"]) && isset($_POST["input_teate"])) {

            $check_teate = $_POST["check_teate"];
            $select_teate = $_POST["select_teate"];
            $input_teate = $_POST["input_teate"];

            // 登録
            foreach ($check_teate as $wkdetail_no) {
                // 初期化
                $wkdetail_teate   = new Wkdetail;

                // 勤務詳細情報を更新
                $wkdetail_teate->inp_t_wk_detail_no = $wkdetail_no;
                if ($select_teate ===  'post_teate') {
                    $wkdetail_teate->inp_t_wk_post_teate = $input_teate; // 手当て ﾎﾟｽﾄ
                } elseif ($select_teate ===  'kotu_teate') {
                    $wkdetail_teate->inp_t_wk_kotuhi = $input_teate; // 交通費
                } elseif ($select_teate ===  'shogatu_teate') {
                    $wkdetail_teate->inp_t_wk_shogatu_teate = $input_teate; // 手当て 正月
                } elseif ($select_teate ===  'kaki_teate') {
                    $wkdetail_teate->inp_t_wk_kaki_teate = $input_teate; // 手当て 夏季
                } elseif ($select_teate ===  'etc_teate1') {
                    $wkdetail_teate->inp_t_wk_etc_teate1 = $input_teate; // 手当て 1
                } elseif ($select_teate ===  'etc_teate2') {
                    $wkdetail_teate->inp_t_wk_etc_teate2 = $input_teate; // 手当て 2
                } elseif ($select_teate ===  'etc_teate3') {
                    $wkdetail_teate->inp_t_wk_etc_teate3 = $input_teate; // 手当て 3
                }
                $wkdetail_teate->updateWkdetail();
            }
        }
    }
    // 実績一括登録
    if (isset($_POST["select_kbn"]) && $_POST["select_kbn"] != "") {
        if (($_POST["time1"]!="") && ($_POST["time2"]!="")) {

            $time = $_POST["time1"].":".$_POST["time2"];
            $check_teate = $_POST["check_teate"];

            // 登録
            foreach ($check_teate as $wkdetail_no) {
                // 初期化
                $wkdetail_teate   = new Wkdetail;

                // 勤務詳細情報を更新
                $wkdetail_teate->inp_t_wk_detail_no = $wkdetail_no;

                if ($_POST["select_kbn"] == 'joban') {
                    $wkdetail_teate->inp_t_wk_joban_kbn = "1";
                    $wkdetail_teate->inp_t_wk_joban_time = $time;
                }
                if ($_POST["select_kbn"] == 'kaban') {
                    $wkdetail_teate->inp_t_wk_kaban_kbn = "1";
                    $wkdetail_teate->inp_t_wk_kaban_time = $time;
                }

                $wkdetail_teate->updateWkdetail();
            }
        }
    }
    // 年休・欠勤一括登録
    if (isset($_POST["select_nk"]) && $_POST["select_nk"] != "") {
        if ($_POST["select_nk"]!="") {

            $check_teate = $_POST["check_teate"];

            // 登録
            foreach ($check_teate as $wkdetail_no) {
                // 初期化
                $wkdetail_teate   = new Wkdetail;

                // 勤務詳細情報を更新
                $wkdetail_teate->inp_t_wk_detail_no = $wkdetail_no;

                $wkdetail_teate->inp_t_wk_joban_kbn = $_POST["select_nk"];

                $wkdetail_teate->updateWkdetail();
            }
        }
    }

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";
    $genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

    // 現場マスタ 取得
    $genba->getGenba();

    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    }
    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas2[$genba->oup_m_genba_id[$i]] = $genbas[$genba->oup_m_genba_oya_id[$i]];   
    }

    // 社員マスタ 取得 に必要な情報をセット
    $staff2->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff2->getStaff();

    if (!(($staff2->oup_m_staff_auth[0]=="1") || ($staff2->oup_m_staff_auth[0]=="3"))) {

        // 作業テーブル 取得 に必要な情報をセット
//        $work->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
//        $work->inp_t_wk_plan_date   = date('Ymd');
//        $work->inp_t_wk_del_flg     = "0";

        // リーダーの作業テーブル 取得
//        $work->getWkdetail();

        // 現場マスタ 取得 に必要な情報をセット
//        $genba_id = $work->oup_t_wk_genba_id[0];
        $genba_id = $staff2->oup_m_staff_genba_id[0];

    }
    
    if (isset($_REQUEST["alone"])) {
        $alone = $_REQUEST["alone"];
        $_SESSION["alone"] = $alone;
    } else {
        $alone = $_SESSION["alone"];
        if (isset($_SESSION["alone"]) && isset($_REQUEST["search"])) {
            $alone = "";
            $_SESSION["alone"] = $alone;
        }
        if (!isset($_SESSION["alone"])) {
            $alone = "";
        }
    }
    
    if (isset($_REQUEST["chk_search"])) {
        $chk_search = $_REQUEST["chk_search"];
        $_SESSION["chk_search"] = $chk_search;
    } else {
        if (isset($_SESSION["chk_search"])) {
        $chk_search = $_SESSION["chk_search"];
        }
        $chk_search = $_SESSION["chk_search"];
    }
    $wkdetail->inp_t_wk_chk_kbn = $chk_search;

    if (isset($_REQUEST["kinmu"])) {
        $kinmu = explode(',',$_REQUEST["kinmu"]);
        
        $plan_kbn = $kinmu[0];
        $_SESSION['plan_kbn'] = $plan_kbn;
        
        $plan_kaban_time = $kinmu[1];
        $_SESSION['plan_kaban_time'] = $plan_kaban_time;
        
        $plan_joban_time = $kinmu[2];
        $_SESSION['plan_joban_time'] = $plan_joban_time;
        
        $genba_id2 = $kinmu[4];
        $_SESSION['genba_id2'] = $genba_id2;
        
        $plan_hosoku = $kinmu[3];
        $_SESSION['plan_hosoku'] = $plan_hosoku;
        
    } else {
        $plan_kbn = $_SESSION["plan_kbn"];
        $plan_joban_time = $_SESSION["plan_joban_time"];
        $plan_kaban_time = $_SESSION["plan_kaban_time"];
        $plan_hosoku = $_SESSION["plan_hosoku"];
        $genba_id2 = $_SESSION["genba_id2"];
    }
    $wkdetail->inp_t_wk_plan_kbn = $plan_kbn;
    $wkdetail->inp_t_wk_plan_kaban_time = $plan_kaban_time;
    $wkdetail->inp_t_wk_plan_joban_time = $plan_joban_time;
    if ($genba_id2 != "9999") {
        $wkdetail->inp_t_wk_genba_id = $genba_id2;
    }
    if ($plan_hosoku == "" && $plan_kbn != "") {
        $wkdetail->inp_t_wk_plan_hosoku = 1;
    } else {
        $wkdetail->inp_t_wk_plan_hosoku = $plan_hosoku;
    }

    $jk_kbn = array(
        '0' => '',
        '1' => '下番',
        '2' => '上番中',
        '3' => '未'
    );
    if (isset($_REQUEST['kbn'])) {
        if ($_REQUEST['kbn'] == 1) {
            $wkdetail->inp_t_wk_kaban_kbn = "1";
        }
        if ($_REQUEST['kbn'] == 2) {
            $wkdetail->inp_t_wk_kaban_time = "null";
            $wkdetail->inp_t_wk_joban_kbn = "1";
        }
        if ($_REQUEST['kbn'] == 3) {
            $wkdetail->inp_t_wk_kaban_time = "null";
            $wkdetail->inp_t_wk_joban_time = "null";
        }
        $kbns = $_REQUEST['kbn'];
        $_SESSION['kkbn'] = $_REQUEST['kbn'];
    } else {
        $kbns = $_SESSION["kkbn"];
        if ($kbns == 1) {
            $wkdetail->inp_t_wk_kaban_kbn = "1";
        }
        if ($kbns == 2) {
            $wkdetail->inp_t_wk_kaban_time = "null";
            $wkdetail->inp_t_wk_joban_kbn = "1";
        }
        if ($kbns == 3) {
            $wkdetail->inp_t_wk_kaban_time = "null";
            $wkdetail->inp_t_wk_joban_dakoku_time = "null";
        }
    }

//    if (isset($_REQUEST['genba_id'])) {
//    for ($i=0;$i<count($_REQUEST['genba_id']);$i++) {
//        $genba_id[$i] = $_REQUEST['genba_id'][$i];
//        $_SESSION["gid"][$i] = $_REQUEST['genba_id'][$i];
//    }
//    } else {
//        $genba_id = $_SESSION["gid"];
//    }

    if (isset($_REQUEST['genba_id'])) {
        $genba_id = $_REQUEST['genba_id'];
        $_SESSION["gid"] = $_REQUEST['genba_id'];
    } else {
        $genba_id = $_SESSION["gid"];
    }

    if (isset($_REQUEST['staff_id'])) {
        $staff_id = $_REQUEST['staff_id'];
        $_SESSION["sid"] = $_REQUEST['staff_id'];
    } else {
        $staff_id = $_SESSION["sid"];
    }

    // 社員マスタ 取得
    $staff->getStaff();

    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
        $staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_name[$i];
    }

    $staff      = new Staff;        // 社員マスタクラス

    // 隊員権限は自分のみ
    if ($staff2->oup_m_staff_auth[0]=="4") {
        $staff_id = $_SESSION['staff_id'];
        $staff->inp_m_staff_id = $_SESSION["staff_id"];
    }

    $staff->inp_m_staff_kana = $user_kana;

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

//    if (count($genba_id) == 1) {
    if ($alone == "") {
    // 現場マスタ 取得 に必要な情報をセット
    $genba2->inp_m_genba_oya_id = $genba_id;
//    $genba2->inp_m_genba_oya_id = $genba_id[0];

    // 現場マスタ 取得
    $genba2->getGenba();

    // 作業テーブル 取得 に必要な情報をセット
    if ($staff2->oup_m_staff_genba_id[0] != "") {
        $wkdetail->inp_t_wk_genba_id2    = "'".$genba_id."'";

        for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) {
            $wkdetail->inp_t_wk_genba_id2 = $wkdetail->inp_t_wk_genba_id2 . ",'" . $genba2->oup_m_genba_id[$i] . "'";
        }
    }
    } else {
        $wkdetail->inp_t_wk_genba_id = $genba_id;
    }
//    if ($staff2->oup_m_staff_genba_id[0] != "") {
//        $wkdetail->inp_t_wk_genba_id2    = "'".$genba_id[0]."'";
//
//        for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) {
//            $wkdetail->inp_t_wk_genba_id2 = $wkdetail->inp_t_wk_genba_id2 . ",'" . $genba2->oup_m_genba_id[$i] . "'";
//        }
//    }
//    else {
//        $wkdetail->inp_t_wk_genba_id = $genba_id[0];
//    }
//    }

    // 予定の検索条件セット
    $wkdetail->inp_t_wk_plan_start_date = $startday;
    $wkdetail->inp_t_wk_plan_end_date = $endday;
    //親の時親子現場検索、子の時単体検索
//    if ($oyako_kbn == 2) {
  //  if (count($genba_id) > 1) {
  //  for ($i=0;$i<count($genba_id);$i++) {
  //      if ($i == 0) {
  //      $wkdetail->inp_t_wk_genba_id2 = "'".$genba_id[0]."'";
  //      } else {
  //      $wkdetail->inp_t_wk_genba_id2 = $wkdetail->inp_t_wk_genba_id2.",'".$genba_id[$i]."'";
  //      }
  //  }
  //  }
//    else {
//        $wkdetail->inp_t_wk_genba_id = $genba_id;
//    }
//    }
    $wkdetail->inp_t_wk_taiin_id = $staff_id;
    $wkdetail->inp_left_join_m_genba = 1;
    $wkdetail->inp_order = "ORDER BY t_wk_detail.t_wk_plan_date,m_genba.m_genba_hyoji_kbn, t_wk_detail.t_wk_plan_kbn, t_wk_detail.t_wk_plan_joban_time, t_wk_detail.t_wk_taiin_id  ";

    // 予定の取得
    $wkdetail->getWkdetail();

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/kinmujokyo_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/kinmujokyo_html.php');
    }
?>