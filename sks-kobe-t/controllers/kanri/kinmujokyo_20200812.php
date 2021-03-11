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
    }
    
    if (isset($_REQUEST['kyuyo_no'])) {
        $kyuyo_no = $_REQUEST['kyuyo_no'];
    }
    
    //協力会社
    if (isset($_REQUEST['company_id'])) {
        $company_id = $_REQUEST['company_id'];
        $_SESSION['company_id'] = $_REQUEST['company_id'];
    } else {
        $company_id = $_SESSION['company_id'];
    }
    
    //総務用勤務一覧,勤務照会表示区分
    if (isset($_REQUEST['flg'])) {
        $flg = $_REQUEST['flg'];
        $_SESSION['flg'] = $_REQUEST['flg'];
    } else {
        $flg = $_SESSION['flg'];
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
    function num_format2($number2) {
      if ($number2 != 0) {
        $num2 = $number2;
      } else {
        $num2 = "";
      }
      return $num2;
    }
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
    
    //協力会社で検索
    if ($company_id != "") {
        $wkdetail->inp_join_m_staff = 1;
        $wkdetail->inp_m_company_id = $company_id;
    }
    
    //検索月の祝日を取得
    $holiday->inp_holiday_nengetu = substr($startday,0,6);
    $holiday->getHoliday();
    if ($holiday->oup_date != "") {
        for ($i=0;$i<count($holiday->oup_date);$i++) {
            if ($i==0) {
                $holday = substr($holiday->oup_date[$i],8,2);
            } else {
                $holday = $holday.",".substr($holiday->oup_date[$i],8,2);
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
        
        $shift2_ji[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_jikyu[$i];
        $shift2_ni[$shift->oup_m_shift_genba_id[$i]][$shift->oup_m_shift_plan_kbn[$i]][$shift->oup_m_shift_joban_time[$i]][$shift->oup_m_shift_kaban_time[$i]] = $shift->oup_m_shift_nikyu[$i];
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
                    
    //DB時間登録(未)                
    //                //実績があれば勤務、所定残、早残、通残を計算してアップデート
    //                $wkdetail_teate   = new Wkdetail;
    //                $wkdetail_teate->inp_t_wk_detail_no = $wkdetail_no;
    //                $wkdetail_teate->getWkdetail();
    //                
    //                $shift_no = $wkdetail_teate->oup_t_wk_shift_no;
    //                $joban_kbn = $wkdetail_teate->oup_t_wk_joban_kbn;
    //                $joban_time = $wkdetail_teate->oup_t_wk_joban_time;
    //                $kaban_time = $wkdetail_teate->oup_t_wk_kaban_time;
    //                
    //                $shift3 = new Shift;
    //                $shift3->inp_m_shift_no = $shift_no[$i];
    //                $shift3->getShift();
    //                
    //                $calc = new Wkdetail;
    //                $calc->inp_joban_kbn = $joban_kbn;
    //                $calc->inp_plan_kbn = $shift3->oup_m_shift_plan_kbn;
    //                $calc->inp_plan_joban_time = $shift3->oup_m_shift_joban_time;
    //                $calc->inp_plan_kaban_time = $shift3->oup_m_shift_kaban_time;
    //                if ($_POST["select_kbn"] == 'joban') {
    //                    $calc->inp_joban_time = $time;
    //                    $calc->inp_kaban_time = $kaban_time;
    //                } elseif ($_POST["select_kbn"] == 'kaban') {
    //                    $calc->inp_joban_time = $joban_time;
    //                    $calc->inp_kaban_time = $time;
    //                }
    //                $calc->inp_shift_rtime = $shift3->oup_m_shift_rodo_time;
    //                $calc->inp_shift_otime = $shift3->oup_m_shift_over_time;
    //                $calc->inp_shift_ktime = $shift3->oup_m_shift_kyukei_time;
    //                $calc->getcalckintime();
    //                
    //                $wkdetail_teate->inp_t_wk_detail_no = $wkdetail_no;
    //                $wkdetail_teate->inp_t_wk_kinmu_time = $calc->kinmu_time;
    //                $wkdetail_teate->inp_t_wk_syotei_zan = $calc->syotei_otime;
    //                $wkdetail_teate->inp_t_wk_hayazan = $calc->hayazan_time;
    //                $wkdetail_teate->inp_t_wk_tuzan = $calc->tuzan_time;
    //                //var_dump($kaban_time,$time);
    //                //exit;
    //                
    //                $wkdetail_teate->updateWkdetail();


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

    // 現場マスタ 取得 に必要な情報をセット
    //使用終了日以降は非表示
    $genba4 = new Genba;
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
    
    //退職者は非表示
    $staff->inp_m_staff_taisyaday = $startday;
    //$staff->inp_order = "order by case when m_staff_taisya < 1 then 1 when m_staff_taisya > $endday then 1 when m_staff_taisya <= $endday then 2 end, m_staff_kana ";

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
    $wkdetail->getWkdetail();
    
    if (isset($_REQUEST["kyuyo"]) && $kyuyo_no != "") {
        $kyuyo2      = new Kyuyo;        // 支給給与クラス
        
        for ($i=1;$i<14;$i++) {
            if ($i != 12 && $i != 13) {
                if (isset($_REQUEST["k$i"])) {
                    $kyuyo2->{inp_m_kyuyo_k.$i} = $_REQUEST["k$i"];
                }
                if (isset($_REQUEST["h$i"])) {
                    $kyuyo2->{inp_m_kyuyo_h.$i} = num_format3($_REQUEST["h$i"]);
                }
                if (isset($_REQUEST["k$i"]) && isset($_REQUEST["h$i"])) {
                    $kyuyo2->{inp_m_kyuyo_s.$i} = num_format3($_REQUEST["k$i"])*num_format3($_REQUEST["h$i"]);
                }
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
    
    //一番目の隊員の給与情報を取得
    $kyuyo->inp_m_kyuyo_k0 = $wkdetail->oup_t_wk_taiin_id[0];
    $kyuyo->inp_m_kyuyo_nengetu = substr($startday,0,6);
    // 支給給与マスタ 取得
    $kyuyo->getKyuyo();
    
    //var_dump($_REQUEST);
    for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
        if ($wkdetail->oup_t_wk_gchk_kbn[$i] == "1" || $wkdetail->oup_t_wk_schk_kbn[$i] == "1") {
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