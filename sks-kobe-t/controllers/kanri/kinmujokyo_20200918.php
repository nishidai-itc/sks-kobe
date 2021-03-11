<?php
session_start();

// ログインチェック
if (!isset($_SESSION["staff_id"])) {
    // HTML表示
    header('Location:login.php');
}

?>
<?php
    set_time_limit(300);

    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Genba.php');                  // 現場クラス
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/Wkdetail.php');               // シフト予定クラス
    require_once('../../models/Shift.php');                  // シフトクラス
    require_once('../../models/Teate.php');                  // 手当てクラス
    require_once('../../models/Holiday.php');                 // 祝日マスタクラス
    require_once('../../models/Cooperation.php');                  // 協力会社クラス
    require_once('../../models/Kyuyo.php');                  // 支給給与クラス
    //require_once('../../models/Kotuhi.php');                 // 交通費クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $start = date('Ym01', strtotime('-1 month'));
    $end = date('Ym01', strtotime('+1 month'));
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
        $_SESSION['user_kana'] = $_REQUEST['user_kana'];
    } else {
        $user_kana = $_SESSION['user_kana'];
    }
    
    if (isset($_REQUEST['kyuyo_no'])) {
        $kyuyo_no = $_REQUEST['kyuyo_no'];
    }
    
    //総務用勤務一覧,勤務照会表示区分
    if (isset($_REQUEST['flg'])) {
        $flg = $_REQUEST['flg'];
        $_SESSION['flg'] = $_REQUEST['flg'];
    } else {
        $flg = $_SESSION['flg'];
    }
    
    $startday   = str_replace("-",$sp,$_SESSION["sday"]);
    $endday     = str_replace("-",$sp,$_SESSION["eday"]);
    
    //日付前日、翌日ボタン
    if (isset($_REQUEST["prev"])) {
        $startday_ts = strtotime($startday);
        $startday_ts2 = strtotime('-1 day',$startday_ts);
        $startday = date("Ymd",$startday_ts2);
        $endday_ts = strtotime($endday);
        $endday_ts2 = strtotime('-1 day',$endday_ts);
        $endday = date("Ymd",$endday_ts2);
        $_SESSION["sday"] = $startday;
        $_SESSION["eday"] = $endday;
    }
    if (isset($_REQUEST["next"])) {
        $startday_ts = strtotime($startday);
        $startday_ts2 = strtotime('+1 day',$startday_ts);
        $startday = date("Ymd",$startday_ts2);
        $endday_ts = strtotime($endday);
        $endday_ts2 = strtotime('+1 day',$endday_ts);
        $endday = date("Ymd",$endday_ts2);
        $_SESSION["sday"] = $startday;
        $_SESSION["eday"] = $endday;
    }

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
    $holiday      = new Holiday;        // 祝日マスタクラス
    $company      = new Cooperation;        // 協力会社マスタクラス
    //$kotuhi     = new Kotuhi;       // 交通費マスタクラス
    $staff_k     = new Staff;        // 社員マスタクラス 勤務照会用
    $genba_k     = new Staff;        // 現場マスタクラス 勤務照会用
    $wkdetail_k     = new Staff;        // シフト予定マスタクラス 勤務照会用
    $shift_k      = new Shift;        // シフトクラス 勤務照会用
    $kyuyo      = new Kyuyo;        // 支給給与クラス 
    
    //3ケタ(,)区切りに変換
    function num_format($number) {
      if ($number != 0) {
        $num = number_format(ceil($number));
      } else {
        // $num = $number;
        $num = "";
      }
      return $num;
    }
    //0は非表示
    function num_format2($number2) {
      if ($number2 != 0) {
        $num2 = $number2;
      } else {
        $num2 = "";
      }
      return $num2;
    }
    //計算時カンマを取り除く
    function num_format3($number3) {
      if (strpos($number3,',') !== false) {
        $num3 = str_replace(',','',$number3);
      } else {
        $num3 = $number3;
      }
      return $num3;
    }
  
    //勤務照会用年月プルダウン
    if (isset($_REQUEST['nengetu'])) {
        $nengetu = $_REQUEST['nengetu'];
    } else {
        $nengetu = date('Ym', strtotime('+1 day'));
    }

    // 協力会社マスタ 取得 に必要な情報をセット
    $company->inp_m_company_del_flg = "0";
    // 協力会社マスタ 取得
    $company->getCompany();
    
    //協力会社で複数検索
    if (isset($_REQUEST["search"])) {
        if (isset($_SESSION["company_id"])) {
            unset($_SESSION["company_id"]);
        }
    }
    if (isset($_REQUEST["company_id"])) {
        for ($i=0;$i<count($_REQUEST["company_id"]);$i++) {
            $company_id[$i] = $_REQUEST["company_id"][$i];
            $_SESSION["company_id"][$i] = $company_id[$i];
        }
    } else {
        if ($_SESSION["company_id"] != "") {
            for ($i=0;$i<count($_SESSION["company_id"]);$i++) {
                $company_id[$i] = $_SESSION["company_id"][$i];
            }
        }
    }
    for ($i=0;$i<count($company_id);$i++) {
        if ($i == 0) {
            $wkdetail->inp_join_m_staff = 1;
            $wkdetail->inp_m_company_id2 = "'".$company_id[0]."'";
        } else {
            $wkdetail->inp_m_company_id2 = $wkdetail->inp_m_company_id2.",'".$company_id[$i]."'";
        }
    }
    ////協力会社
    //if (isset($_REQUEST['company_id'])) {
    //    $company_id = $_REQUEST['company_id'];
    //    $_SESSION['company_id'] = $_REQUEST['company_id'];
    //} else {
    //    $company_id = $_SESSION['company_id'];
    //}
    ////協力会社で単体検索
    //if ($company_id != "") {
    //    $wkdetail->inp_join_m_staff = 1;
    //    $wkdetail->inp_m_company_id = $company_id;
    //}
    
    //検索月の祝日を取得
    $holiday->inp_holiday_start_date = $startday;
    $holiday->inp_holiday_end_date = $endday;
    //$holiday->inp_holiday_nengetu = substr($startday,0,6);
    $holiday->getHoliday();
    if ($holiday->oup_date != "") {
        for ($i=0;$i<count($holiday->oup_date);$i++) {
            if ($i==0) {
                $holday = $holiday->oup_date[$i];
                //$holday = substr($holiday->oup_date[$i],8,2);
            } else {
                $holday = $holday.",".$holiday->oup_date[$i];
                //$holday = $holday.",".substr($holiday->oup_date[$i],8,2);
            }
        }
    }

    // シフトの取得
    //使用終了日以降は非表示
    //$shift->inp_order = "order by case when m_shift_deleteday < 1 then 1 when m_shift_deleteday > $endday then 1 when m_shift_deleteday <= $endday then 2 end,m_shift_genba_id,m_shift_joban_time ";
    $shift->inp_m_shift_deleteday = $startday;
    // 表示順の現場別の区分別に表示する
    $shift->inp_left_join_m_genba = 1;
    $shift->inp_order = "order by m_genba.m_genba_hyoji_kbn, m_shift.m_shift_genba_id, m_shift.m_shift_plan_kbn, m_shift.m_shift_joban_time";
    $shift->getShift();

    $shift2 = array();

    for ($i=0;$i<count($shift->oup_m_shift_no);$i++) {
//        $shift2_col[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]] = $shift->oup_m_shift_color[$i];
        $shift2_color[$shift->oup_m_shift_no[$i]] = $shift->oup_m_shift_color[$i];
        $shift2_total[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_rodo_time[$i] + $shift->oup_m_shift_over_time[$i] + $shift->oup_m_shift_kyukei_time[$i];
        $shift2_rod[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_rodo_time[$i];
        $shift2_ovr[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_over_time[$i];
        $shift2_kk[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_kyukei_time[$i];
        
        $shift2_ji[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_plan_hosoku[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_jikyu[$i];
        $shift2_ni[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_plan_hosoku[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_nikyu[$i];
    }
    
    // 手当てマスタ 取得
    $teate->getTeate();
    
    if (!isset($_REQUEST["kyuyo"])) {
        //Gﾁｪｯｸ済登録
        if (isset($_POST["check_teate"]) && isset($_POST["gchk"])) {
                $check_teate = $_POST["check_teate"];
                $chk = $_POST["gchk"];
                // 登録
                foreach ($check_teate as $wkdetail_no) {

    $file = '../../log/log.txt';
    // ファイルをオープンして既存のコンテンツを取得します
    $current = file_get_contents($file);
    // 新しい人物をファイルに追加します
    $current .= date('m-d H:i:s')." ";
    $current .= "勤務状況一覧 一括 チェック ".$_SESSION["staff_id"]."\n";
    // 結果をファイルに書き出します
    file_put_contents($file, $current);

                    // 初期化
                    $wkdetail_chk   = new Wkdetail;
                    // 勤務詳細情報を更新
                    $wkdetail_chk->inp_t_wk_detail_no = $wkdetail_no;
                    $wkdetail_chk->inp_t_wk_gchk_kbn = $chk; // ﾁｪｯｸ
                    if ($chk == "1") {
                        $wkdetail_chk->inp_t_wk_gchk_created         = date('Y-m-d H:i:s');
                    }
                    $wkdetail_chk->updateWkdetail();

                }
        }
        //Sﾁｪｯｸ済登録
        if (isset($_POST["check_teate"]) && isset($_POST["schk"])) {
                $check_teate = $_POST["check_teate"];
                $chk = $_POST["schk"];
                // 登録
                foreach ($check_teate as $wkdetail_no) {

    $file = '../../log/log.txt';
    // ファイルをオープンして既存のコンテンツを取得します
    $current = file_get_contents($file);
    // 新しい人物をファイルに追加します
    $current .= date('m-d H:i:s')." ";
    $current .= "勤務状況一覧 一括 チェック ".$_SESSION["staff_id"]."\n";
    // 結果をファイルに書き出します
    file_put_contents($file, $current);

                    // 初期化
                    $wkdetail_chk   = new Wkdetail;
                    // 勤務詳細情報を更新
                    $wkdetail_chk->inp_t_wk_detail_no = $wkdetail_no;
                    $wkdetail_chk->inp_t_wk_schk_kbn = $chk; // ﾁｪｯｸ
                    if ($chk == "1") {
                        $wkdetail_chk->inp_t_wk_schk_created         = date('Y-m-d H:i:s');
                    }
                    $wkdetail_chk->updateWkdetail();

                }
        }

        //// 手当てマスタ 取得
        //$teate->getTeate();

        // 時間外一括登録
        if (isset($_POST["over_time"]) && $_POST["over_time"] != "") {
            if (isset($_POST["check_teate"]) && isset($_POST["input_over"])) {

                $check_teate = $_POST["check_teate"];
                $over_time = $_POST["over_time"];
                $input_over = $_POST["input_over"];

                // 登録
                foreach ($check_teate as $wkdetail_no) {

    $file = '../../log/log.txt';
    // ファイルをオープンして既存のコンテンツを取得します
    $current = file_get_contents($file);
    // 新しい人物をファイルに追加します
    $current .= date('m-d H:i:s')." ";
    $current .= "勤務状況一覧 一括 時間外 ".$_SESSION["staff_id"]."\n";
    // 結果をファイルに書き出します
    file_put_contents($file, $current);

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
                    $wkdetail_teate->inp_t_wk_modified         = date('Y-m-d H:i:s');

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

    $file = '../../log/log.txt';
    // ファイルをオープンして既存のコンテンツを取得します
    $current = file_get_contents($file);
    // 新しい人物をファイルに追加します
    $current .= date('m-d H:i:s')." ";
    $current .= "勤務状況一覧 一括 手当て ".$_SESSION["staff_id"]."\n";
    // 結果をファイルに書き出します
    file_put_contents($file, $current);

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
            if (($_POST["time1"]!="") && ($_POST["time2"]!="") && ($_POST["check_teate"]!="")) {

                $time = $_POST["time1"].":".$_POST["time2"];
                $check_teate = $_POST["check_teate"];

                // 登録
                foreach ($check_teate as $wkdetail_no) {

    $file = '../../log/log.txt';
    // ファイルをオープンして既存のコンテンツを取得します
    $current = file_get_contents($file);
    // 新しい人物をファイルに追加します
    $current .= date('m-d H:i:s')." ";
    $current .= "勤務状況一覧 一括 実績 ".$_SESSION["staff_id"]."\n";
    // 結果をファイルに書き出します
    file_put_contents($file, $current);

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

                    /*
                     * 勤務時間の更新
                     */

                    $work2      = new Wkdetail;     // 作業クラス
                    $work3      = new Wkdetail;     // 作業クラス
                    $work4      = new Wkdetail;     // 作業クラス
                    $shift      = new Shift;        // シフトクラス

                    $work4->inp_t_wk_detail_no = $wkdetail_no;              // 作業実施NO（連番）
                    $work4->getWkdetail();

                    //既に手入力がある場合は計算しない
                    if ($work4->oup_t_wk_inp_kbn[0] != "1") {
                        // シフト取得
                        $shift->inp_m_shift_no = $work4->oup_t_wk_shift_no[0];
                        $shift->getShift();

                        $work2->inp_genba_id = $shift->oup_m_shift_genba_id[0];
                        $work2->inp_shift_ktime = $shift->oup_m_shift_kyukei_time[0]; // 休憩
                        $work2->inp_shift_otime = $shift->oup_m_shift_over_time[0]; // 所定残
                        $work2->inp_shift_rtime = $shift->oup_m_shift_rodo_time[0]; // 労働時間
                        $work2->inp_joban_kbn = $work4->oup_t_wk_joban_kbn[0];
                        $work2->inp_plan_kbn = $work4->oup_t_wk_plan_kbn[0];
                        $work2->inp_plan_joban_time = $work4->oup_t_wk_plan_joban_time[0];
                        $work2->inp_plan_kaban_time = $work4->oup_t_wk_plan_kaban_time[0];
                        $work2->inp_joban_time = $work4->oup_t_wk_joban_time[0];
                        $work2->inp_kaban_time = $work4->oup_t_wk_kaban_time[0];
                        $work2->getcalckintime();

                        $work3->inp_t_wk_detail_no = $work4->oup_t_wk_detail_no[0];
                        $work3->inp_t_wk_kinmu_time = $work2->kinmu_time;
                        $work3->inp_t_wk_syotei_zan = $work2->syotei_otime;
                        $work3->inp_t_wk_hayazan = $work2->hayazan_time;
                        $work3->inp_t_wk_tuzan = $work2->tuzan_time;

                        $work3->updateWkdetail();
                    }


                }
            }
        }
        // 年休・欠勤一括登録
        if (isset($_POST["select_nk"]) && $_POST["select_nk"] != "") {
            if ($_POST["select_nk"]!="" && $_POST["check_teate"]!="") {

                $check_teate = $_POST["check_teate"];

                // 登録
                foreach ($check_teate as $wkdetail_no) {

    $file = '../../log/log.txt';
    // ファイルをオープンして既存のコンテンツを取得します
    $current = file_get_contents($file);
    // 新しい人物をファイルに追加します
    $current .= date('m-d H:i:s')." ";
    $current .= "勤務状況一覧 一括 年休・欠勤 ".$_SESSION["staff_id"]."\n";
    // 結果をファイルに書き出します
    file_put_contents($file, $current);

                    // 初期化
                    $wkdetail_teate   = new Wkdetail;

                    // 勤務詳細情報を更新
                    $wkdetail_teate->inp_t_wk_detail_no = $wkdetail_no;

                    $wkdetail_teate->inp_t_wk_joban_kbn = $_POST["select_nk"];

                    $wkdetail_teate->updateWkdetail();


                    /*
                     * 勤務時間の更新
                     */

                    $work2      = new Wkdetail;     // 作業クラス
                    $work3      = new Wkdetail;     // 作業クラス
                    $work4      = new Wkdetail;     // 作業クラス
                    $shift      = new Shift;        // シフトクラス

                    $work4->inp_t_wk_detail_no = $wkdetail_no;              // 作業実施NO（連番）
                    $work4->getWkdetail();

                    if ($work4->oup_t_wk_inp_kbn[0] != "1") {
                        // シフト取得
                        $shift->inp_m_shift_no = $work4->oup_t_wk_shift_no[0];
                        $shift->getShift();

                        $work2->inp_genba_id = $shift->oup_m_shift_genba_id[0];
                        $work2->inp_shift_ktime = $shift->oup_m_shift_kyukei_time[0]; // 休憩
                        $work2->inp_shift_otime = $shift->oup_m_shift_over_time[0]; // 所定残
                        $work2->inp_shift_rtime = $shift->oup_m_shift_rodo_time[0]; // 労働時間
                        $work2->inp_joban_kbn = $work4->oup_t_wk_joban_kbn[0];
                        $work2->inp_plan_kbn = $work4->oup_t_wk_plan_kbn[0];
                        $work2->inp_plan_joban_time = $work4->oup_t_wk_plan_joban_time[0];
                        $work2->inp_plan_kaban_time = $work4->oup_t_wk_plan_kaban_time[0];
                        $work2->inp_joban_time = $work4->oup_t_wk_joban_time[0];
                        $work2->inp_kaban_time = $work4->oup_t_wk_kaban_time[0];
                        $work2->getcalckintime();

                        $work3->inp_t_wk_detail_no = $work4->oup_t_wk_detail_no[0];
                        $work3->inp_t_wk_kinmu_time = $work2->kinmu_time;
                        $work3->inp_t_wk_syotei_zan = $work2->syotei_otime;
                        $work3->inp_t_wk_hayazan = $work2->hayazan_time;
                        $work3->inp_t_wk_tuzan = $work2->tuzan_time;

                        $work3->updateWkdetail();
                    }



                }
            }
        }
    }

    // 社員マスタ 取得 に必要な情報をセット
    $staff2->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff2->getStaff();
    
    // 現場マスタ 取得 に必要な情報をセット
    //使用終了日以降は非表示
    $genba4 = new Genba;
    
    //隊員権限者は自現場のみ
    if ($staff2->oup_m_staff_auth[0]=="4" || $staff2->oup_m_staff_auth[0]=="2") {
        $genba4->inp_m_genba_id = $staff2->oup_m_staff_genba_id[0];
    }
    //$order_nen = substr($startday,0,4)."-".substr($startday,4,2)."-".substr($startday,6,2);
    $genba4->inp_m_genba_deleteday = $startday;
    $genba4->inp_m_genba_del_flg = "0";
    //$genba4->inp_order = "order by case when m_genba_deleteday < 1 then 1 when m_genba_deleteday > $startday then 1 when m_genba_deleteday <= $startday then 2 end,m_genba_hyoji_kbn,m_genba_id ";
    $genba4->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

    // 現場マスタ 取得
    $genba4->getGenba();
    
    
    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";
    $genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

    // 現場マスタ 取得
    $genba->getGenba();

    //現場名を配列に格納
    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    }
    //親現場から子現場名を配列に格納
    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas2[$genba->oup_m_genba_id[$i]] = $genbas[$genba->oup_m_genba_oya_id[$i]];   
    }
    
    //個別チェックボックス
    if (isset($_REQUEST["search"])) {
        if (isset($_SESSION["alone"])) {
            unset($_SESSION["alone"]);
        }
    }
    if (isset($_REQUEST["alone"])) {
        $alone = $_REQUEST["alone"];
        $_SESSION["alone"] = $alone;
    } else {
        $alone = $_SESSION["alone"];
        //$alone = $_SESSION["alone"];
        //if (isset($_SESSION["alone"]) && isset($_REQUEST["search"])) {
        //    $alone = "";
        //    $_SESSION["alone"] = $alone;
        //}
        //if (!isset($_SESSION["alone"])) {
        //    $alone = "";
        //}
    }
    
    //チェック済検索
    if (isset($_REQUEST["gchk_search"])) {
        $gchk_search = $_REQUEST["gchk_search"];
        $_SESSION["gchk_search"] = $gchk_search;
    } else {
        //if (isset($_SESSION["gchk_search"])) {
        //$gchk_search = $_SESSION["gchk_search"];
        //}
        $gchk_search = $_SESSION["gchk_search"];
    }
    if (isset($_REQUEST["schk_search"])) {
        $schk_search = $_REQUEST["schk_search"];
        $_SESSION["schk_search"] = $schk_search;
    } else {
        //if (isset($_SESSION["schk_search"])) {
        //$schk_search = $_SESSION["schk_search"];
        //}
        $schk_search = $_SESSION["schk_search"];
    }
    $wkdetail->inp_t_wk_gchk_kbn = $gchk_search;
    $wkdetail->inp_t_wk_schk_kbn = $schk_search;
    
    //if (isset($_REQUEST["kinmu"])) {
    //    $kinmu = explode(',',$_REQUEST["kinmu"]);
    //    
    //    $plan_kbn = $kinmu[0];
    //    $_SESSION['plan_kbn'] = $plan_kbn;
    //    
    //    $plan_kaban_time = $kinmu[1];
    //    $_SESSION['plan_kaban_time'] = $plan_kaban_time;
    //    
    //    $plan_joban_time = $kinmu[2];
    //    $_SESSION['plan_joban_time'] = $plan_joban_time;
    //    
    //    $genba_id2 = $kinmu[4];
    //    $_SESSION['genba_id2'] = $genba_id2;
    //    
    //    $plan_hosoku = $kinmu[3];
    //    $_SESSION['plan_hosoku'] = $plan_hosoku;
    //    
    //} else {
    //    $plan_kbn = $_SESSION["plan_kbn"];
    //    $plan_joban_time = $_SESSION["plan_joban_time"];
    //    $plan_kaban_time = $_SESSION["plan_kaban_time"];
    //    $plan_hosoku = $_SESSION["plan_hosoku"];
    //    $genba_id2 = $_SESSION["genba_id2"];
    //}
    //$wkdetail->inp_t_wk_plan_kbn = $plan_kbn;
    //if ($genba_id2 != "9999") {
    //    $wkdetail->inp_t_wk_genba_id = $genba_id2;
    //}
    //if ($plan_hosoku == "" && $plan_kbn != "") {
    //    $wkdetail->inp_t_wk_plan_hosoku = 1;
    //} else {
    //    $wkdetail->inp_t_wk_plan_hosoku = $plan_hosoku;
    //}
    
    //勤務体系単体検索
    //if (isset($_REQUEST["kinmu"])) {
    //    $shift_no = $_REQUEST["kinmu"];
    //    $_SESSION["shift_no"] = $shift_no;
    //} else {
    //    $shift_no = $_SESSION["shift_no"];
    //}
    //$wkdetail->inp_t_wk_shift_no = $shift_no;
    
    //勤務体系複数検索
    if (isset($_REQUEST["search"])) {
        if (isset($_SESSION["shift_no"])) {
            unset($_SESSION["shift_no"]);
        }
    }
    if (isset($_REQUEST["kinmu"])) {
        for ($i=0;$i<count($_REQUEST["kinmu"]);$i++) {
            $shift_no[$i] = $_REQUEST["kinmu"][$i];
            $_SESSION["shift_no"][$i] = $shift_no[$i];
        }
    } else {
        if ($_SESSION["shift_no"] != "") {
            for ($i=0;$i<count($_SESSION["shift_no"]);$i++) {
                $shift_no[$i] = $_SESSION["shift_no"][$i];
            }
        }
    }
    for ($i=0;$i<count($shift_no);$i++) {
        if ($i == 0) {
            $wkdetail->inp_t_wk_shift_no2 = "'".$shift_no[0]."'";
        } else {
            $wkdetail->inp_t_wk_shift_no2 = $wkdetail->inp_t_wk_shift_no2.",'".$shift_no[$i]."'";
        }
    }

    //上下番区分を配列に
    $jk_kbn = array(
        '0' => '',
        '1' => '下番',
        '2' => '上番中',
        '3' => '未'
    );
    //上下番区分検索
    if (isset($_REQUEST['kbn'])) {
        if ($_REQUEST['kbn'] == 1) {
            $wkdetail->inp_t_wk_kaban_kbn = "1";
        }
        if ($_REQUEST['kbn'] == 2) {
            $wkdetail->inp_t_wk_kaban_time = "null";
            $wkdetail->inp_t_wk_joban_kbn = "1";
        }
        if ($_REQUEST['kbn'] == 3) {
            //$wkdetail->inp_t_wk_kaban_time = "null";
            //$wkdetail->inp_t_wk_joban_time = "null";
            $wkdetail->inp_t_wk_jk_kbn = "true";
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

    //現場複数検索
    if (isset($_REQUEST["search"])) {
        if (isset($_SESSION["gid"])) {
            unset($_SESSION["gid"]);
        }
    }
    if (isset($_REQUEST["genba_id"])) {
        for ($i=0;$i<count($_REQUEST["genba_id"]);$i++) {
            $genba_id[$i] = $_REQUEST["genba_id"][$i];
            $_SESSION["gid"][$i] = $genba_id[$i];
        }
    } else {
        if ($_SESSION["gid"] != "") {
            for ($i=0;$i<count($_SESSION["gid"]);$i++) {
                $genba_id[$i] = $_SESSION["gid"][$i];
            }
        }
    }
    
    //リーダーと隊員権限者のみ自現場を初期表示
    if (!(($staff2->oup_m_staff_auth[0]=="1") || ($staff2->oup_m_staff_auth[0]=="3"))) {
        //$genba_id = $staff2->oup_m_staff_genba_id[0];
        $genba_id[0] = $staff2->oup_m_staff_genba_id[0];
    }

    //現場単体検索
    //if (isset($_REQUEST['genba_id'])) {
    //    $genba_id = $_REQUEST['genba_id'];
    //    $_SESSION["gid"] = $_REQUEST['genba_id'];
    //} else {
    //    $genba_id = $_SESSION["gid"];
    //}

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

    //$staff->inp_m_staff_kana = $user_kana;
    
    //退職者は非表示
    $staff->inp_m_staff_taisyaday = $startday;
    //$staff->inp_order = "order by case when m_staff_taisya < 1 then 1 when m_staff_taisya > $endday then 1 when m_staff_taisya <= $endday then 2 end, m_staff_kana ";

    // 社員マスタ 取得
    $staff->getStaff();

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    //子現場も一緒に検索
    if ($alone == "") {
        // 現場マスタ 取得 に必要な情報をセット
        for ($i=0;$i<count($genba_id);$i++) {
            if ($i == 0) {
                $genba2->inp_m_genba_oya_id2 = "'".$genba_id[0]."'";
            } else {
                $genba2->inp_m_genba_oya_id2 = $genba2->inp_m_genba_oya_id2.",'".$genba_id[$i]."'";
            }
        }
        //$genba2->inp_m_genba_oya_id = $genba_id;
//    $genba2->inp_m_genba_oya_id = $genba_id[0];

        // 現場マスタ 取得
        $genba2->getGenba();

        // 作業テーブル 取得 に必要な情報をセット
        if ($staff2->oup_m_staff_genba_id[0] != "") {
            for ($i=0;$i<count($genba_id);$i++) {
                if ($i == 0) {
                    $wkdetail->inp_t_wk_genba_id2 = "'".$genba_id[0]."'";
                } else {
                    $wkdetail->inp_t_wk_genba_id2 = $wkdetail->inp_t_wk_genba_id2.",'".$genba_id[$i]."'";
                }
            }
            //$wkdetail->inp_t_wk_genba_id2    = "'".$genba_id."'";
            
            if ($genba_id != "") {
                for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) {
                    $wkdetail->inp_t_wk_genba_id2 = $wkdetail->inp_t_wk_genba_id2 . ",'" . $genba2->oup_m_genba_id[$i] . "'";
                }
            }
        }
    } else {
        for ($i=0;$i<count($genba_id);$i++) {
            if ($i == 0) {
                $wkdetail->inp_t_wk_genba_id2 = "'".$genba_id[0]."'";
                
            } else {
                $wkdetail->inp_t_wk_genba_id2 = $wkdetail->inp_t_wk_genba_id2.",'".$genba_id[$i]."'";
                
            }
        }
        //$wkdetail->inp_t_wk_genba_id = $genba_id;
    }

    // 予定の検索条件セット
    $wkdetail->inp_t_wk_plan_start_date = $startday;
    $wkdetail->inp_t_wk_plan_end_date = $endday;
    $wkdetail->inp_t_wk_taiin_id = $staff_id;
    $wkdetail->inp_left_join_m_genba = 1;
    //$wkdetail->inp_left_join_m_kotuhi = 1;
    $wkdetail->inp_order = "ORDER BY t_wk_detail.t_wk_plan_date,m_genba.m_genba_hyoji_kbn, t_wk_detail.t_wk_plan_kbn, t_wk_detail.t_wk_plan_joban_time, t_wk_detail.t_wk_taiin_id  ";

    // 予定の取得
    //勤務照会用
    if ($flg == 1) {
        $wkdetail->inp_t_wk_taiin_id = $_SESSION["staff_id"];
        $wkdetail->inp_t_wk_plan_start_date = $nengetu."01";
        $last_day = substr(date('Ymd', strtotime('last day of ' . $nengetu)),6,2);
        $wkdetail->inp_t_wk_plan_end_date = $nengetu.$last_day;
        //$wkdetail->getWkdetail();
    }
//    if (!isset($_REQUEST["prev2"]) && !isset($_REQUEST["next2"])) {
    $wkdetail->getWkdetail();
//    }
    
    //勤務照会用、表示フラグ
    $syotei_zan_flg = "false";
    $ht_zan_flg = "false";
    $daytime_over_time_flg = "false";
    $rest_over_time_flg = "false";
    $midnight_over_time_flg = "false";
    $renzan_flg = "false";
    $post_flg = "false";
    $kotuhi_flg = "false";
    $comment_flg = "false";
    $teate1_flg = "false";
    $teate2_flg = "false";
    $teate3_flg = "false";
    $teate4_flg = "false";
    $teate5_flg = "false";
    if ($flg == 1) {
        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            if ($wkdetail->oup_t_wk_syotei_zan[$i] != 0) {
                $syotei_zan_flg = "true";
            }
            if ($wkdetail->oup_t_wk_hayazan[$i] != 0 || $wkdetail->oup_t_wk_tuzan[$i] != 0) {
                $ht_zan_flg = "true";
            }
            if ($wkdetail->oup_t_wk_daytime_over_time[$i] > "00:00:00") {
                $daytime_over_time_flg = "true";
            }
            if ($wkdetail->oup_t_wk_rest_over_time[$i] > "00:00:00") {
                $rest_over_time_flg = "true";
            }
            if ($wkdetail->oup_t_wk_midnight_over_time[$i] > "00:00:00") {
                $midnight_over_time_flg = "true";
            }
            if ($wkdetail->oup_t_wk_renzan[$i] != 0) {
                $renzan_flg = "true";
            }
            if ($wkdetail->oup_t_wk_post_teate[$i] != 0) {
                $post_flg = "true";
            }
            if ($wkdetail->oup_t_wk_kotuhi[$i] != 0) {
                $kotuhi_flg = "true";
            }
            if ($wkdetail->oup_t_wk_comment[$i] != "") {
                $comment_flg = "true";
            }
            if ($wkdetail->oup_t_wk_shogatu_teate[$i] != 0) {
                $teate1_flg = "true";
            }
            if ($wkdetail->oup_t_wk_kaki_teate[$i] != 0) {
                $teate2_flg = "true";
            }
            if ($wkdetail->oup_t_wk_etc_teate1[$i] != 0) {
                $teate3_flg = "true";
            }
            if ($wkdetail->oup_t_wk_etc_teate2[$i] != 0) {
                $teate4_flg = "true";
            }
            if ($wkdetail->oup_t_wk_etc_teate3[$i] != 0) {
                $teate5_flg = "true";
            }
        }
    }
    
    //支給欄、手入力
    if (isset($_REQUEST["kyuyo"]) && $kyuyo_no != "") {
        $kyuyo2      = new Kyuyo;        // 支給給与クラス
        
        for ($i=1;$i<14;$i++) {
            if ($i != 12 && $i != 13) {
                if (isset($_REQUEST["k$i"])) {
                    if ($_REQUEST["k$i"] > 0) {
                        $kyuyo2->{inp_m_kyuyo_k.$i} = $_REQUEST["k$i"];
                    } else {
                        $kyuyo2->{inp_m_kyuyo_k.$i} = 0;
                    }
                }
                if (isset($_REQUEST["h$i"])) {
                    if (num_format3($_REQUEST["h$i"]) > 0) {
                        $kyuyo2->{inp_m_kyuyo_h.$i} = num_format3($_REQUEST["h$i"]);
                    } else {
                        $kyuyo2->{inp_m_kyuyo_h.$i} = 0;
                    }
                }
                //if (isset($_REQUEST["k$i"]) && isset($_REQUEST["h$i"])) {
                    if (num_format3($_REQUEST["k$i"]) > 0 && num_format3($_REQUEST["h$i"]) > 0) {
                        $kyuyo2->{inp_m_kyuyo_s.$i} = num_format3($_REQUEST["k$i"])*num_format3($_REQUEST["h$i"]);
                    } else {
                        $kyuyo2->{inp_m_kyuyo_s.$i} = 0;
                    }
                //}
                if ($i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6) {
                    if (isset($_REQUEST["e$i"])) {
                        $kyuyo2->{inp_m_kyuyo_e.$i} = num_format3($_REQUEST["e$i"]);
                    }
                }
            } else {
                if (isset($_REQUEST["s$i"])) {
                    $kyuyo2->{inp_m_kyuyo_s.$i} = num_format3($_REQUEST["s$i"]);
                }
            }
            //if ($kyuyo->{oup_m_kyuyo_s.$i}[0] != 0) {
            //    $total = $total + $kyuyo->{oup_m_kyuyo_s.$i}[0];
            //}
        }
        $kyuyo2->inp_m_kyuyo_kbn = 1;
        $kyuyo2->inp_m_kyuyo_no = $kyuyo_no;
        $kyuyo2->inp_m_kyuyo_modified = date("Y-m-d H:i:s");
        $kyuyo2->inp_m_kyuyo_modified_id = $_SESSION["staff_id"];
        
        $kyuyo2->updateKyuyo();
        
        header("Location:kinmujokyo.php#".$kyuyo_no);
    } elseif (isset($_REQUEST["kyuyo"]) && $kyuyo_no == "") {
        header("Location:kinmujokyo.php#99999");
    }
    
//    $taiin = "";
//    if (isset($_REQUEST["prev2"])) {
//        $kyuyo3      = new Kyuyo;        // 支給給与クラス
//        $kyuyo3->inp_m_kyuyo_nengetu = substr($startday,0,6);
//        $kyuyo3->inp_m_kyuyo_prev_k0 = $_REQUEST["kyuyo_k0"];
//        $kyuyo3->inp_order = "order by m_kyuyo_k0 desc ";
//        $kyuyo3->getKyuyo();
//        if (count($kyuyo3->oup_m_kyuyo_no) > 0) {
//            $taiin = $kyuyo3->oup_m_kyuyo_k0[0];
//        }
//    } elseif (isset($_REQUEST["next2"])) {
//        $kyuyo3      = new Kyuyo;        // 支給給与クラス
//        $kyuyo3->inp_m_kyuyo_nengetu = substr($startday,0,6);
//        $kyuyo3->inp_m_kyuyo_next_k0 = $_REQUEST["kyuyo_k0"];
//        $kyuyo3->inp_order = "order by m_kyuyo_k0 ";
//        $kyuyo3->getKyuyo();
//        if (count($kyuyo3->oup_m_kyuyo_no) > 0) {
//            $taiin = $kyuyo3->oup_m_kyuyo_k0[0];
//        }
//    }
//    
//    //一番目の隊員の給与情報を取得
//    if ($_REQUEST["kyuyo_k0"] == "" || isset($_REQUEST["search"])) {
        $kyuyo->inp_m_kyuyo_k0 = $wkdetail->oup_t_wk_taiin_id[0];
//    } elseif ($_REQUEST["kyuyo_k0"] != "" && $taiin != "") {
//        $kyuyo->inp_m_kyuyo_k0 = $taiin;
//        $user_kana = "";
//        $staff_id = $taiin;
//        $wkdetail->inp_t_wk_taiin_id = $staff_id;
//        //$wkdetail->getWkdetail();
//        $startday = substr($startday,0,6)."01";
//        $endday = substr($endday,0,6).substr(date('Ymd', strtotime($endday.'last day of this month')),6,2);
//        $wkdetail->inp_t_wk_plan_start_date = $startday;
//        $wkdetail->inp_t_wk_plan_end_date = $endday;
//        $wkdetail->getWkdetail();
//    } else {
//        $kyuyo->inp_m_kyuyo_k0 = $_REQUEST["kyuyo_k0"];
//    }
    $kyuyo->inp_m_kyuyo_nengetu = substr($startday,0,6);
    // 支給給与マスタ 取得
    if (count($wkdetail->oup_t_wk_detail_no) > 0) {
        $kyuyo->getKyuyo();
    }
    
    //Gチェック、Sチェック
    for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
        if ($wkdetail->oup_t_wk_gchk_kbn[$i] == "1" && $wkdetail->oup_t_wk_schk_kbn[$i] == "1") {
            $inp[$wkdetail->oup_t_wk_detail_no[$i]] = 1;
        }
    }
    
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