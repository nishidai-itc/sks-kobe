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
    require_once('../../models/Wk.php');                     // シフト予定クラス
    require_once('../../models/Wkdetail.php');               // シフト予定クラス
    require_once('../../models/Shift.php');                  // シフトクラス
    require_once('../../models/PostTeate.php');              // ポスト手当てクラス
    require_once('../../models/CarTeate.php');               // 車手当てクラス
    require_once('../../models/WkConf.php');                 // シフト予定クラス
    require_once('../../models/WkdetailConf.php');           // シフト予定クラス
    require_once('../../models/Holiday.php');                 // 祝日マスタクラス

    //ajax
    $kbn_name = array(
        '1'=>'泊',
        '2'=>'日',
        '3'=>'夜',
        '4'=>'年',
        '5'=>'欠',
        '6'=>'時'
    );
    
    $week = array("日", "月", "火", "水", "木", "金", "土");
    $start = date('Ym01', strtotime('-1 month'));
    $end = date('Ym01', strtotime('+2 month'));
    $user_kana_array = array("" => "","1" => "ア","2" => "カ","3" => "サ","4" => "タ","5" => "ナ","6" => "ハ","7" => "マ","8" => "ヤ","9" => "ラ","10" => "ワ");
//if ($_REQUEST["pos"] != "") {
//var_dump($_REQUEST["pos"]);
//exit;
//}
    /*********************************************************
     *	クラスの作成
      ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $staff2     = new Staff;        //  3/23
    $wk         = new Wk;           // シフト予定マスタクラス
    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
    $work   = new Wkdetail;         //  3/23
    $shift      = new Shift;        // シフトクラス
    $post_teate = new PostTeate;    // ポスト手当てマスタクラス
    $car_teate  = new CarTeate;     // 車手当てマスタクラス
    $holiday      = new Holiday;        // 祝日マスタクラス
    
    //確定フラグ
    if (isset($_REQUEST['conf_flg'])) {
        $conf_flg = $_REQUEST['conf_flg'];
    } else {
        $conf_flg = "";
    }
    
    //入力、選択区分
    if (isset($_REQUEST['chk_kbn'])) {
        $chk_kbn = $_REQUEST['chk_kbn'];
    } else {
        $chk_kbn = "";
    }

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    //印刷用表示
    if (isset($_REQUEST['dispctl'])) {
        $dispctl = $_REQUEST['dispctl'];
    }
    if (isset($dispctl)) {
        $disabled = "disabled";
        $void = "javascript:void(0);";
        //$disabled1 = "disabled1";
        $disabled_a = "btn disabled_a";
        $br = "<br>";
        $none = "a{text-decoration: none;}";
        $center = "a{vertical-align: middle;}";
        $align_center = "align=center";
        $align_right = "align=right";
        $display = "style='display:none;'";
    }
    
    // 年月
    if (isset($_REQUEST['nengetu'])) {
        $nengetu = mb_convert_kana($_REQUEST['nengetu'],'n');
        //検索月の祝日を取得
        $holiday->inp_holiday_nengetu = $nengetu;
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
    } else {
    //        $nengetu = date('Ym');
    //        $nengetu = date('Ym', strtotime(date('Y-m-1') . '+1 month'));
        $nengetu = date('Ym', strtotime('+1 day'));
    }
    
    //カナ検索
    if (isset($_REQUEST['user_kana'])) {
        $user_kana = $_REQUEST['user_kana'];
    }
    
    //// 現場マスタ 取得 に必要な情報をセット
    //$genba->inp_m_genba_del_flg = "0";
    //$genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";
    //
    //// 現場マスタ 取得
    //$genba->getGenba();

    /*3/23*/
    // 社員マスタ 取得 に必要な情報をセット
    $staff2->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff2->getStaff();

    if ($staff2->oup_m_staff_auth[0]!="1") {
        //$genba_id[0] = $staff2->oup_m_staff_genba_id[0];
        $genba_id = $staff2->oup_m_staff_genba_id[0];

    }
    /*3/23*/

    if (isset($_REQUEST['genba_id'])) {
        $genba_id = $_REQUEST['genba_id'];
    }
    //現場複数検索
    //$genba_flg = false;
    //if (isset($_REQUEST["genba_id"])) {
    //    for ($i=0;$i<count($_REQUEST["genba_id"]);$i++) {
    //        if ($i == 0 && count($_REQUEST["genba_id"]) == 1) {
    //            $genba_id[0] = $_REQUEST["genba_id"][0].$_REQUEST["genba_id"][1];
    //        } else {
    //            $genba_id[$i] = $_REQUEST["genba_id"][$i];
    //        }
    //    }
    //    if (count($genba_id) > 1) {
    //        $genba_flg = true;
    //    }
    //} else {
    //    $genba_id[0] = false;
    //}

    // 社員マスタ 取得
    $staff->getStaff();

    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
        $staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_name[$i];
    }
    
    $today = $nengetu.date("d");
    $today2 = $nengetu."01";
    
    $staff = new Staff;
    
    //$staff->inp_m_staff_kana = $user_kana;
    
    //退職者はプルダウンに表示しない
    $staff->inp_m_staff_taisyaday = $today2;
    //$staff->inp_m_staff_taisyaday = $today;
    //$staff->inp_order = "order by case when m_staff_taisya < 1 then 1 when m_staff_taisya > $today then 1 when m_staff_taisya <= $today then 2 end, m_staff_kana ";
    $staff->getStaff();
    
    // 現場マスタ 取得 に必要な情報をセット
    //使用終了日以降は非表示
    $genba->inp_m_genba_deleteday = $today2;
    //$genba->inp_m_genba_deleteday = $today;
    
    $genba->inp_m_genba_del_flg = "0";
    //$genba->inp_order = "order by case when m_genba_deleteday < 1 then 1 when m_genba_deleteday > $today then 1 when m_genba_deleteday <= $today then 2 end,m_genba_hyoji_kbn,m_genba_id ";

    // 現場マスタ 取得
    $genba->getGenba();
    
    //現場名を配列に格納
    //for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
    //    $genba_name[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    //}
    
    // 時間表示
    $jikan = "";
    if (isset($_REQUEST['jikan'])) {
        $jikan = $_REQUEST['jikan'];
    }

    // 月の最後の日
    $lastday = date("t", strtotime(substr($nengetu, 0, 4) . "/" . substr($nengetu, 4, 2) . "/01"));

    // シフト
    if (isset($_REQUEST['shift_no'])) {
        $shift_no = $_REQUEST['shift_no'];
    }
    // 研修
    if (isset($_REQUEST['kensyu'])) {
        if ($_REQUEST['kensyu']=="1") {
            $kensyu = $_REQUEST['kensyu'];
        }
    }

    /*
      *  上下
      */
    if ((isset($_REQUEST['up'])) || (isset($_REQUEST['down']))) {
        if ($_REQUEST['wk_no'] != "") {
            $wk2      = new Wk;         // シフト予定マスタクラス

            // 予定の検索条件セット
            $wk2->inp_t_wk_no = $_REQUEST['wk_no'];

            // 予定の取得
            $wk2->getWk();

            $wk3      = new Wk;         // シフト予定マスタクラス

            // 予定の検索条件セット
            $wk3->inp_t_wk_no = $_REQUEST['wk_no'];

            if (isset($_REQUEST['up'])) {
                $wk3->inp_t_wk_order = intval($wk2->oup_t_wk_order[0]) - 15;
            }
            if (isset($_REQUEST['down'])) {
                $wk3->inp_t_wk_order = intval($wk2->oup_t_wk_order[0]) + 15;
            }
            $wk3->inp_t_wk_modified    = date('Y-m-d H:i:s');
            $wk3->inp_t_wk_modified_id = $_SESSION["staff_id"];

            // 予定の更新
            $wk3->updateWk();
        }

        $wk2      = new Wk;         // シフト予定マスタクラス

        // 表示順再設定

        // 予定の検索条件セット
        //$wk2->inp_t_wk_genba_id = $genba_id[0];
        $wk2->inp_t_wk_genba_id = $genba_id;
        $wk2->inp_t_wk_nengetu  = $nengetu;

        $wk2->inp_order = "order by t_wk_order";

        // 予定の取得
        $wk2->getWk();

        for ($i=0;$i<count($wk2->oup_t_wk_no);$i++) {
            $wk3      = new Wk;         // シフト予定マスタクラス

            // 予定の検索条件セット
            $wk3->inp_t_wk_no = $wk2->oup_t_wk_no[$i];
            $wk3->inp_t_wk_order = ($i+1)*10;

            // 予定の更新
            $wk3->updateWk();
        }
    }

    /*
      *  隊員追加
      */
    if (isset($_REQUEST['ins'])) {
        $wk2         = new Wk;           // シフト予定マスタクラス
        
        // 登録されているシフト人数の取得
        //$wk2->inp_t_wk_genba_id = $genba_id[0];
        $wk2->inp_t_wk_genba_id = $genba_id;
        $wk2->inp_t_wk_nengetu  = $nengetu;
        $wk2->getWk();
        // 登録の並び順番(一番最後)
        if ($wk2->oup_t_wk_order) {
            $wk_order = (count($wk2->oup_t_wk_order) + 1) * 10;
        } else {
            $wk_order = 10;
        }
        
        //登録されているか確認
        $wk_old = new Wk;
        $wk_old->inp_t_wk_genba_id = $genba_id;
        $wk_old->inp_t_wk_nengetu  = $nengetu;
        $wk_old->inp_t_wk_taiin_id = $_REQUEST['staff_id'];
        $wk_old->getWk();

        //既に登録されていたら登録しない
        if (!$wk_old->oup_t_wk_no) {
        // if (count($wk_old->oup_t_wk_no) < 1) {
            // 登録
            //$wk2->inp_t_wk_genba_id = $genba_id[0];
            $wk2->inp_t_wk_genba_id = $genba_id;
            $wk2->inp_t_wk_nengetu  = $nengetu;
            $wk2->inp_t_wk_taiin_id = $_REQUEST['staff_id'];
            $wk2->inp_t_wk_order = $wk_order;
            
//$file = '../../log/log.txt';
//// ファイルをオープンして既存のコンテンツを取得します
//$current = file_get_contents($file);
//// 新しい人物をファイルに追加します
//$current .= date('m-d H:i:s')." ";
//$current .= "勤務予定表 隊員追加 ".$_SESSION["staff_id"]."\n";
//// 結果をファイルに書き出します
//file_put_contents($file, $current);

// 書き込みモード（追記）でファイルを開く
$fp = fopen("../../log/log.txt", "a");

$current = date('m-d H:i:s')." ";
$current .= "勤務予定表 隊員追加 ".$_SESSION["staff_id"]."\n";
// ファイルに書き込む
fwrite($fp, $current);

// ファイルを閉じる
fclose($fp);

            // シフト 取得
            $wk2->insertWk();
        }
    }

    /*
    *  シフト登録
    */
    if (isset($_REQUEST['click']) && $_REQUEST['click'] == 'regist') {
    // if (isset($_REQUEST['regist'])) {
        if ($_REQUEST['wk_no'] != "") {

            // セッションに入れておいたトークンを取得
            $session_token = isset($_SESSION['token']) ? $_SESSION['token'] : '';

            // POSTの値からトークンを取得
            $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';

            // トークンがない場合は不正扱い
            if ($token === '') {
//                die("不正な処理ですよ。");
                $err = "1";
            }
//print("token=".$token."<br />");
//print("session_token=".$session_token."<br />");
            // セッションに入れたトークンとPOSTされたトークンの比較
            if ($token !== $session_token) {
//                die("不正な処理ですよ。");
                $err = "1";
            }

            // セッションに保存しておいたトークンの削除
            unset($_SESSION['token']);

            if ($err!="1") {

                $wk2      = new Wk;         // シフト予定マスタクラス

                // 予定の検索条件セット
                $wk2->inp_t_wk_no = $_REQUEST['wk_no'];

                // 予定の取得
                $wk2->getWk();

                $shift2      = new Shift;        // シフトクラス

                $shift2->inp_m_shift_no = $_REQUEST['shift_no'];

                // シフトの取得
                $shift2->getShift();

                /* 手当ての取得(シフトNoから取得) */
                // ポスト手当て
                $post_teate->inp_m_post_teate_shift_no = $shift2->oup_m_shift_no[0];
                $post_teate->getPostTeate();

                // 車手当て
                $car_teate->inp_m_car_teate_shift_no = $shift2->oup_m_shift_no[0];
                $car_teate->getCarTeate();


                $wkdetail2   = new Wkdetail;     // シフト予定マスタクラス
                //var_dump($_REQUEST);
                //exit;
                // insert
                $wkdetail2->inp_t_wk_office_id = "";
                //$wkdetail2->inp_t_wk_genba_id   = $genba_id[0];
                $wkdetail2->inp_t_wk_genba_id   = $genba_id;
                $wkdetail2->inp_t_wk_taiin_id   = $wk2->oup_t_wk_taiin_id[0];
                // $wkdetail2->inp_t_wk_plan_date  = substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2)."-".sprintf('%02d', $_REQUEST['id']);
                $wkdetail2->inp_t_wk_plan_date  = substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2)."-".sprintf('%02d', $_REQUEST['day']);
                $wkdetail2->inp_t_wk_plan_kbn   = $shift2->oup_m_shift_plan_kbn[0];
                // 年休の場合は実績の休暇も登録する
                if ($shift2->oup_m_shift_plan_kbn[0] == "4") {
                    $wkdetail2->inp_t_wk_joban_kbn = "4";
                }
                $wkdetail2->inp_t_wk_plan_hosoku = $shift2->oup_m_shift_plan_hosoku[0];
                $wkdetail2->inp_t_wk_plan_joban_time = $shift2->oup_m_shift_joban_time[0];
                $wkdetail2->inp_t_wk_plan_kaban_time = $shift2->oup_m_shift_kaban_time[0];
                // $wkdetail2->inp_t_wk_plan_kensyu = $kensyu;
                $wkdetail2->inp_t_wk_plan_kensyu = $_REQUEST['kensyu'];
                $wkdetail2->inp_t_wk_post_teate = $post_teate->oup_m_post_teate_post_cost[0];   // ポスト手当て
                $wkdetail2->inp_t_wk_kuruma_teate = $car_teate->oup_m_car_teate_kuruma_cost[0]; // 車手当て
                $wkdetail2->inp_t_wk_created         = date('Y-m-d H:i:s');
                $wkdetail2->inp_t_wk_created_staffid = $_SESSION["staff_id"];
                $wkdetail2->inp_t_wk_shift_no        = $shift2->oup_m_shift_no[0];
                $wkdetail2->inp_t_wk_kintime         = $shift2->oup_m_shift_rodo_time[0];
                $wkdetail2->inp_t_wk_kinmu_time      = ($shift2->oup_m_shift_rodo_time[0]*1)*60;
                $wkdetail2->inp_t_wk_syotei_zan      = ($shift2->oup_m_shift_over_time[0]*1)*60;

//$file = '../../log/log.txt';
//// ファイルをオープンして既存のコンテンツを取得します
//$current = file_get_contents($file);
//// 新しい人物をファイルに追加します
//$current .= date('m-d H:i:s')." ";
//$current .= "勤務予定表 シフト登録 ".$_SESSION["staff_id"]."\n";
//// 結果をファイルに書き出します
//file_put_contents($file, $current);

// 書き込みモード（追記）でファイルを開く
$fp = fopen("../../log/log.txt", "a");

$current = date('m-d H:i:s')." ";
$current .= "勤務予定表 シフト登録 ".$_SESSION["staff_id"]."\n";
// ファイルに書き込む
fwrite($fp, $current);

// ファイルを閉じる
fclose($fp);

                // シフト 取得
                $wkdetail2->insertWkdetail();
            }

            //ajax
            $newwkdetail   = new Wkdetail;     // シフト予定マスタクラス
            $newwkdetail->inp_t_wk_genba_id   = $genba_id;
            $newwkdetail->inp_t_wk_taiin_id   = $wk2->oup_t_wk_taiin_id[0];
            $newwkdetail->inp_t_wk_plan_date  = $nengetu.sprintf('%02d', $_REQUEST['day']);
            $newwkdetail->getWkdetail();
            $data = array(
                'detail_no'=>$newwkdetail->oup_t_wk_detail_no[0],
                'plan_kbn'=>$newwkdetail->oup_t_wk_plan_kbn[0],
                'plan_kbn_name'=>$kbn_name[$newwkdetail->oup_t_wk_plan_kbn[0]],
                'plan_hosoku'=>$newwkdetail->oup_t_wk_plan_hosoku[0],
                'kensyu'=>$newwkdetail->oup_t_wk_plan_kensyu[0],
                'shift_color'=>$shift2->oup_m_shift_color[0],
                'token'=>md5(uniqid(rand(), true))
            );
            echo json_encode($data);
            exit;

        }
    }
    $date = new DateTime($wk_detail_no[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]]);
    $date2 = date_format($date,'Y-m');
    /*
     *  削除
     */
    if (isset($_REQUEST['delete1'])) {

        $wk2   = new Wkdetail;

        //$wk2->inp_t_wk_genba_id   = $_REQUEST['genba_id'][0];
        $wk2->inp_t_wk_genba_id   = $_REQUEST['genba_id'];
        $wk2->inp_t_wk_plan_month = $_REQUEST['nengetu'];
        $wk2->inp_t_wk_taiin_id   = $_REQUEST['taiin_id'];
        $wk2->inp_t_wk_jokaban_kbn2 = '1';

        $wk2->getWkdetail();

        if (!$wk2->oup_t_wk_detail_no) {
        // if (count($wk2->oup_t_wk_detail_no) == 0) {

            if ($_REQUEST['wk_no'] != "") {

                $wk2   = new Wk;     // シフト予定マスタクラス

                $wk2->inp_t_wk_no = $_REQUEST['wk_no'];

                // シフト 削除
                $wk2->deleteWk();

            }

            if (($_REQUEST['genba_id'] != "") && ($_REQUEST['nengetu'] != "") && ($_REQUEST['taiin_id'] != "")) {

                $wk2   = new Wkdetail;

                //$wk2->inp_t_wk_genba_id = $_REQUEST['genba_id'][0];
                $wk2->inp_t_wk_genba_id = $_REQUEST['genba_id'];
                $wk2->inp_t_wk_plan_date = $_REQUEST['nengetu'];
                $wk2->inp_t_wk_taiin_id = $_REQUEST['taiin_id'];

                $wk2->deleteWkdetail();
            }
        } else {

            // アラート
            $alert = "<script type='text/javascript'>alert('既に上下番済みのデータがあるので削除できません');</script>";
            echo $alert;

        }
    }
    if (isset($_REQUEST['delete2'])) {
        //シフト選択が空欄だったら削除（ただし上下番データがあったらエラー）
        if ($_REQUEST['shift_no'] == "") {
            
            $wk2   = new Wkdetail;     // シフト予定マスタクラス

            $wk2->inp_t_wk_detail_no = $_REQUEST['wk_no'];

            $wk2->getWkdetail();
            if($wk2->oup_t_wk_joban_time[0] == "" && $wk2->oup_t_wk_kaban_time[0] == ""){
                $wk2->inp_t_wk_no = $_REQUEST['wk_no'];

                // シフト 削除
                $wk2->deleteWkdetail();

                //ajax
                echo json_encode(['flg'=>'1']);
                exit;

            } else if($wk2->oup_t_wk_joban_time[0] != "" || $wk2->oup_t_wk_kaban_time[0] != ""){

                //ajax
                echo json_encode(['flg'=>'2']);
                exit;

                // アラート
                $alert = "<script type='text/javascript'>alert('既に上下番済みのデータがあるので削除できません');</script>";
                echo $alert;
//                echo("joban:".$wk2->oup_t_wk_joban_time[0]."#<br>\n");
//                echo("kaban:".$wk2->oup_t_wk_kaban_time[0]."#<br>\n");
            }

        //シフト選択されていたら予定部分を上書き
        } else if ($_REQUEST['wk_no'] != "") {

            // セッションに入れておいたトークンを取得
            $session_token = isset($_SESSION['token']) ? $_SESSION['token'] : '';

            // POSTの値からトークンを取得
            $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';

            // トークンがない場合は不正扱い
            if ($token === '') {
                echo("不正な処理ですよ。A");
                $err = "1";
            }
            // セッションに入れたトークンとPOSTされたトークンの比較
            if ($token !== $session_token) {
                echo("不正な処理ですよ。B");
                $err = "1";
            }

            // セッションに保存しておいたトークンの削除
            unset($_SESSION['token']);

            if ($err!="1") {

                $shift2      = new Shift;        // シフトクラス

                $shift2->inp_m_shift_no = $_REQUEST['shift_no'];

                // シフトの取得
                $shift2->getShift();

                /* 手当ての取得(シフトNoから取得) */
                // ポスト手当て
                $post_teate->inp_m_post_teate_shift_no = $shift2->oup_m_shift_no[0];
                $post_teate->getPostTeate();

                // 車手当て
                $car_teate->inp_m_car_teate_shift_no = $shift2->oup_m_shift_no[0];
                $car_teate->getCarTeate();

                //上書き前の勤務詳細の取得
                $old_wkdetail   = new Wkdetail;     // シフト予定マスタクラス
                $old_wkdetail->inp_t_wk_detail_no = $_REQUEST['wk_no'];
                $old_wkdetail->getWkdetail();
                
                $wkdetail2   = new Wkdetail;     // シフト予定マスタクラス

                $wkdetail2->inp_t_wk_detail_no = $_REQUEST['wk_no'];

                $wkdetail2->inp_t_wk_plan_kbn   = $shift2->oup_m_shift_plan_kbn[0];
                // 年休の場合は実績の休暇も登録する
                if ($shift2->oup_m_shift_plan_kbn[0] == "4") {
                    $wkdetail2->inp_t_wk_joban_kbn = "4";
                }
                // 年休から変更した場合上番区分を削除
                if ($old_wkdetail->oup_t_wk_plan_kbn[0] == "4") {
                    $wkdetail2->inp_t_wk_joban_kbn = "";
                }
                $wkdetail2->inp_t_wk_plan_hosoku = $shift2->oup_m_shift_plan_hosoku[0];
                $wkdetail2->inp_t_wk_plan_joban_time = $shift2->oup_m_shift_joban_time[0];
                $wkdetail2->inp_t_wk_plan_kaban_time = $shift2->oup_m_shift_kaban_time[0];
                $wkdetail2->inp_t_wk_plan_kensyu = $kensyu;
                $wkdetail2->inp_t_wk_post_teate = $post_teate->oup_m_post_teate_post_cost[0];   // ポスト手当て
                $wkdetail2->inp_t_wk_kuruma_teate = $car_teate->oup_m_car_teate_kuruma_cost[0]; // 車手当て
                $wkdetail2->inp_t_wk_modified        = date('Y-m-d H:i:s');
                $wkdetail2->inp_t_wk_modified_id     = $_SESSION["staff_id"];
                $wkdetail2->inp_t_wk_shift_no        = $shift2->oup_m_shift_no[0];
                $wkdetail2->inp_t_wk_kintime         = $shift2->oup_m_shift_rodo_time[0];
                $wkdetail2->inp_t_wk_kinmu_time      = ($shift2->oup_m_shift_rodo_time[0]*1)*60;
                $wkdetail2->inp_t_wk_syotei_zan       = ($shift2->oup_m_shift_over_time[0]*1)*60;
                
//$file = '../../log/log.txt';
//// ファイルをオープンして既存のコンテンツを取得します
//$current = file_get_contents($file);
//// 新しい人物をファイルに追加します
//$current .= date('m-d H:i:s')." ";
//$current .= "勤務予定表 シフト登録 ".$_SESSION["staff_id"]."\n";
//// 結果をファイルに書き出します
//file_put_contents($file, $current);

// 書き込みモード（追記）でファイルを開く
$fp = fopen("../../log/log.txt", "a");

$current = date('m-d H:i:s')." ";
$current .= "勤務予定表 シフト登録 ".$_SESSION["staff_id"]."\n";
// ファイルに書き込む
fwrite($fp, $current);

// ファイルを閉じる
fclose($fp);

                // シフト 取得
                $wkdetail2->updateWkdetail();

            }

            //$wk2->inp_t_wk_detail_no = $_REQUEST['wk_no'];
            //$wk2->inp_t_wk_joban_dakoku_time = "null";
            //
            //$wk2->getWkdetail();
            //if (count($wk2->oup_t_wk_detail_no) != 0) {
            //    $wk2->inp_t_wk_no = $_REQUEST['wk_no'];

                // シフト 削除
//                $wk2->deleteWkdetail();
            //} else {
            //    // アラート
            //    $alert = "<script type='text/javascript'>alert('既に打刻されているので削除できません');</script>";
            //    echo $alert;
            //}
        }
    }

    /*
     *  予定の確定
     */
    if (isset($_REQUEST['conf'])) {
        //新規
        if ($conf_flg == 1) {
        
            $wkconf       = new WkConf;         // シフト予定マスタクラス
            $wkdetailconf = new WkdetailConf;   // シフト予定マスタクラス
            
            $wkconf->inp_t_wk_nengetu = $nengetu;
            //$wkconf->inp_t_wk_genba_id = $genba_id[0];
            $wkconf->inp_t_wk_genba_id = $genba_id;
            $wkconf->inp_t_wk_created_id = $_SESSION['staff_id'];

            // 確定データの作成
            $wkconf->insertWkConf();
            
            // 予定確定日
            $wkconf->inp_t_wk_created = date('Y-m-d H:i:s');
            $wkconf->updateWkconf();

            $wkdetailconf->inp_t_wk_nengetu = $nengetu;
            //$wkdetailconf->inp_t_wk_genba_id = $genba_id[0];
            $wkdetailconf->inp_t_wk_genba_id = $genba_id;
            $wkdetailconf->inp_t_wk_created_id = $_SESSION['staff_id'];

            // 確定データの作成
            $wkdetailconf->insertWkdetailConf();
            
            // 予定確定日
            //$s_nengetu = substr($nengetu,0,6)."01";
            //$e_nengetu = substr(date('Ymd',strtotime('last day of this month')),0,8);
            $nengetu2 = substr($nengetu,0,4)."-".substr($nengetu,4,2);
            $s_nengetu = substr($nengetu,0,6)."01";
            $e_nengetu = substr($nengetu,0,6).substr(date('Y-m-d',strtotime($nengetu2.' last day of this month')),8,2);
            $wkdetailconf->inp_t_wk_created = date('Y-m-d H:i:s');
            $wkdetailconf->inp_t_wk_plan_start_date = $s_nengetu;
            $wkdetailconf->inp_t_wk_plan_end_date = $e_nengetu;
            $wkdetailconf->updateWkdetailconf();

            $alert = "<script type='text/javascript'>alert('予定を確定しました');</script>";
            echo $alert;
        
        //上書き
        } elseif ($conf_flg == 2) {
        
            $wkconf       = new WkConf;         // シフト予定マスタクラス
            $wkdetailconf = new WkdetailConf;   // シフト予定マスタクラス

            $wkconf->inp_t_wk_nengetu = $nengetu;
            //$wkconf->inp_t_wk_genba_id = $genba_id[0];
            $wkconf->inp_t_wk_genba_id = $genba_id;
            
            // 確定データの削除
            $wkconf->deleteWkConf();
            
            // 確定データの作成
            $wkconf->inp_t_wk_created_id = $_SESSION['staff_id'];
            $wkconf->insertWkConf();
            
            // 予定確定日
            $wkconf->inp_t_wk_created = date('Y-m-d H:i:s');
            $wkconf->updateWkconf();
            
            $wkdetailconf->inp_t_wk_nengetu = $nengetu;
            //$wkdetailconf->inp_t_wk_genba_id = $genba_id[0];
            $wkdetailconf->inp_t_wk_genba_id = $genba_id;
            
            // 確定データの削除
            $wkdetailconf->deleteWkdetailConf();
            
            // 確定データの作成
            $wkdetailconf->inp_t_wk_created_id = $_SESSION['staff_id'];
            $wkdetailconf->insertWkdetailConf();
            
            // 予定確定日
            $nengetu2 = substr($nengetu,0,4)."-".substr($nengetu,4,2);
            $s_nengetu = substr($nengetu,0,6)."01";
            $e_nengetu = substr($nengetu,0,6).substr(date('Y-m-d',strtotime($nengetu2.' last day of this month')),8,2);
            $wkdetailconf->inp_t_wk_created = date('Y-m-d H:i:s');
            $wkdetailconf->inp_t_wk_plan_start_date = $s_nengetu;
            $wkdetailconf->inp_t_wk_plan_end_date = $e_nengetu;
            $wkdetailconf->updateWkdetailconf();
            
            $alert = "<script type='text/javascript'>alert('予定を更新しました');</script>";
            echo $alert;
        }
    }
    
    if ($genba_id != "") {
        //$conf_flg = "";
        if ($nengetu < date("Ym")) {
        $conf_flg = 3;
        } elseif ($nengetu == date("Ym")) {
            $wk_conf       = new Wk;
            $wkdetail_conf       = new Wkdetail;
            
            $s_nengetu = substr($nengetu,0,6)."01";
            $e_nengetu = substr(date('Ymd',strtotime('last day of this month')),0,8);
            $wkdetail_conf->inp_t_wk_detail_conf = 1;
            //$wkdetail_conf->inp_t_wk_genba_id = $genba_id[0];
            $wkdetail_conf->inp_t_wk_genba_id = $genba_id;
            $wkdetail_conf->inp_t_wk_plan_start_date = $s_nengetu;
            $wkdetail_conf->inp_t_wk_plan_end_date = $e_nengetu;
            $wkdetail_conf->getWkdetail();
            
            $wk_conf->inp_t_wk_conf = 1;
            //$wk_conf->inp_t_wk_genba_id = $genba_id[0];
            $wk_conf->inp_t_wk_genba_id = $genba_id;
            $wk_conf->inp_t_wk_nengetu = $nengetu;
            $wk_conf->getWk();
            
            if ($wkdetail_conf->oup_t_wk_detail_no || $wk_conf->oup_t_wk_no) {
            //  if (count($wkdetail_conf->oup_t_wk_detail_no) != 0 || count($wk_conf->oup_t_wk_no) != 0) {
            $conf_flg = 3;
            } else {
            $conf_flg = 1;
            }
        } elseif ($nengetu > date("Ym")) {
            $wk_conf       = new Wk;
            $wkdetail_conf       = new Wkdetail;
            
            $nengetu2 = substr($nengetu,0,4)."-".substr($nengetu,4,2);
            $s_nengetu = substr($nengetu,0,6)."01";
            $e_nengetu = substr($nengetu,0,6).substr(date('Y-m-d',strtotime($nengetu2.' last day of this month')),8,2);
            $wkdetail_conf->inp_t_wk_detail_conf = 1;
            //$wkdetail_conf->inp_t_wk_genba_id = $genba_id[0];
            $wkdetail_conf->inp_t_wk_genba_id = $genba_id;
            $wkdetail_conf->inp_t_wk_plan_start_date = $s_nengetu;
            $wkdetail_conf->inp_t_wk_plan_end_date = $e_nengetu;
            $wkdetail_conf->getWkdetail();
            
            $wk_conf->inp_t_wk_conf = 1;
            //$wk_conf->inp_t_wk_genba_id = $genba_id[0];
            $wk_conf->inp_t_wk_genba_id = $genba_id;
            $wk_conf->inp_t_wk_nengetu = $nengetu;
            $wk_conf->getWk();
            
            if ($wkdetail_conf->oup_t_wk_detail_no || $wk_conf->oup_t_wk_no) {
            // if (count($wkdetail_conf->oup_t_wk_detail_no) != 0 || count($wk_conf->oup_t_wk_no) != 0) {
            $conf_flg = 2;
            } else {
            $conf_flg = 1;
            }
        }
    }
    
//    if (isset($_REQUEST['conf'])) {
//
//        $wkconf       = new WkConf;         // シフト予定マスタクラス
//        $wkdetailconf = new WkdetailConf;   // シフト予定マスタクラス
//
//        $wkconf->inp_t_wk_nengetu = $nengetu;
//        $wkconf->inp_t_wk_genba_id = $genba_id;
//
//        // 確定データの削除
//        $wkconf->deleteWkConf();
//
//        // 確定データの作成
//        $wkconf->insertWkConf();
//
//        // 確定データの削除
//        $wkdetailconf->inp_t_wk_nengetu = $nengetu;
//        $wkdetailconf->inp_t_wk_genba_id = $genba_id;
//
//        $wkdetailconf->deleteWkdetailConf();
//
//        // 確定データの作成
//        $wkdetailconf->insertWkdetailConf();
//
//        $alert = "<script type='text/javascript'>alert('予定を確定しました');</script>";
//        echo $alert;
//
//    }

    /*
     *  前月コピー
     */
    if (isset($_REQUEST['copy'])) {

        // 前月の予定を取得
        $zengetu = date('Ym', strtotime(substr($nengetu,0,4)."-".substr($nengetu,4,2)."-01" . '-1 month'));

        $wk         = new Wk;         // シフト予定マスタクラス

        // 予定の検索条件セット
        //$wk->inp_t_wk_genba_id = $genba_id[0];
        $wk->inp_t_wk_genba_id = $genba_id;
        $wk->inp_t_wk_nengetu  = $zengetu;

        $wk->inp_order = "order by t_wk_order";

        // 予定の取得
        $wk->getWk();

        for ($i=0;$i<count($wk->oup_t_wk_no);$i++) {

            /*
             * 当月にデータがあるかどうか確認
             */

            $wk2         = new Wk;         // シフト予定マスタクラス

            // 予定の検索条件セット
            //$wk2->inp_t_wk_genba_id = $genba_id[0];
            $wk2->inp_t_wk_genba_id = $genba_id;
            $wk2->inp_t_wk_nengetu  = $nengetu;
            $wk2->inp_t_wk_taiin_id = $wk->oup_t_wk_taiin_id[$i];

            // 予定の取得
            $wk2->getWk();

            if (!$wk2->oup_t_wk_no) {
            // if (count($wk2->oup_t_wk_no)==0) {

                // データ書き込み
                $wk3         = new Wk;         // シフト予定マスタクラス

                $wk3->inp_t_wk_nengetu = $nengetu;
                //$wk3->inp_t_wk_genba_id = $genba_id[0];
                $wk3->inp_t_wk_genba_id = $genba_id;
                $wk3->inp_t_wk_taiin_id = $wk->oup_t_wk_taiin_id[$i];
                $wk3->inp_t_wk_order = $wk->oup_t_wk_order[$i];

//$file = '../../log/log.txt';
//// ファイルをオープンして既存のコンテンツを取得します
//$current = file_get_contents($file);
//// 新しい人物をファイルに追加します
//$current .= date('m-d H:i:s')." ";
//$current .= "勤務予定表 前月コピー ".$_SESSION["staff_id"]."\n";
//// 結果をファイルに書き出します
//file_put_contents($file, $current);

// 書き込みモード（追記）でファイルを開く
$fp = fopen("../../log/log.txt", "a");

$current = date('m-d H:i:s')." ";
$current .= "勤務予定表 前月コピー ".$_SESSION["staff_id"]."\n";
// ファイルに書き込む
fwrite($fp, $current);

// ファイルを閉じる
fclose($fp);

                $wk3->insertWk();

            }

        }

        $alert = "<script type='text/javascript'>alert('前月をコピーしました');</script>";
        echo $alert;
        $_REQUEST['search']=true;


    }

    /*
     *  検索
     */
    if (isset($_REQUEST['search']) || $staff2->oup_m_staff_auth[0] == "2" || $_REQUEST['j_flg']) {
    if ($genba_id != "") {

        // シフトの検索条件セット
        //$shift->inp_m_shift_genba_id = $genba_id;
        //for ($i=0;$i<count($genba_id);$i++) {
        //    if ($i == 0) {
        //        $shift->inp_m_shift_genba_id2 = "'".$genba_id[0]."'";
        //    } else {
        //        $shift->inp_m_shift_genba_id2 = $shift->inp_m_shift_genba_id2.",'".$genba_id[$i]."'";
        //    }
        //}
        $shift->inp_m_shift_genba_id2 = $genba_id;
        
        //未使用日以降は非表示
        $shift->inp_m_shift_deleteday = $today2;
        //$shift->inp_m_shift_deleteday = $today;
        //$shift->inp_order = "order by case when m_shift_deleteday < 1 then 1 when m_shift_deleteday > $today then 1 when m_shift_deleteday <= $today then 2 end,m_shift_genba_id,m_shift_joban_time ";
        
        // シフトの取得
        $shift->getShift();

        $wk         = new Wk;         // シフト予定マスタクラス

        // 予定の検索条件セット
        //for ($i=0;$i<count($genba_id);$i++) {
        //    if ($i == 0) {
        //        $wk->inp_t_wk_genba_id2 = "'".$genba_id[0]."'";
        //    } else {
        //        $wk->inp_t_wk_genba_id2 = $wk->inp_t_wk_genba_id2.",'".$genba_id[$i]."'";
        //    }
        //}

        //非同期通信用
        if ($_REQUEST["taiin_id"]) {
            $wk->inp_t_wk_taiin_id = $_REQUEST["taiin_id"];
            $wkdetail->inp_t_wk_taiin_id = $_REQUEST["taiin_id"];
        }

        $wk->inp_t_wk_genba_id = $genba_id;
        $wk->inp_t_wk_nengetu  = $nengetu;

        //$wk->inp_order = "order by t_wk_genba_id,t_wk_order";
        $wk->inp_order = "order by t_wk_order";

        // 予定の取得
        $wk->getWk();

        // 予定詳細の検索条件セット
        //for ($i=0;$i<count($genba_id);$i++) {
        //    if ($i == 0) {
        //        $wkdetail->inp_t_wk_genba_id2 = "'".$genba_id[0]."'";
        //    } else {
        //        $wkdetail->inp_t_wk_genba_id2 = $wkdetail->inp_t_wk_genba_id2.",'".$genba_id[$i]."'";
        //    }
        //}
        $wkdetail->inp_t_wk_genba_id = $genba_id;
        $wkdetail->inp_t_wk_plan_start_date = $nengetu . "01";
        $wkdetail->inp_t_wk_plan_end_date = date('Ymd', strtotime('last day of ' . substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)));

        // シフト 取得
        $wkdetail->getWkdetail();

        $wk_shift      = new Shift;        // シフトクラス
        $wk_shift->getShift();
        unset($arr_shift);
        foreach($wk_shift->oup_m_shift_no as $key => $value){
            $arr_shift[$value]['color'] = $wk_shift->oup_m_shift_color[$key];
            $arr_shift[$value]['rodo'] = $wk_shift->oup_m_shift_rodo_time[$key];
            $arr_shift[$value]['over'] = $wk_shift->oup_m_shift_over_time[$key];
        }

        if ($wkdetail->oup_t_wk_detail_no) {
        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            $wk_detail_no[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_detail_no[$i];
            $kbn[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_kbn[$i];
            $kbn2[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_joban_kbn[$i];
            $hosoku[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_hosoku[$i];
            $jtime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_joban_time[$i];
            $ktime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_kaban_time[$i];
            $ken[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_kensyu[$i];
            $gchk[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_gchk_kbn[$i];
            $gchk_cnt[$wkdetail->oup_t_wk_taiin_id[$i]] = $gchk_cnt[$wkdetail->oup_t_wk_taiin_id[$i]] + $gchk[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]];
            $schk[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_schk_kbn[$i];
            $schk_cnt[$wkdetail->oup_t_wk_taiin_id[$i]] = $schk_cnt[$wkdetail->oup_t_wk_taiin_id[$i]] + $schk[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]];

            // 労働時間

            // 背景カラー, 労働時間, 残業時間を取得
/*
            $wk_shift      = new Shift;        // シフトクラス
            $wk_shift->inp_m_shift_genba_id = $genba_id;
            $wk_shift->inp_m_shift_plan_kbn = $wkdetail->oup_t_wk_plan_kbn[$i];
            $wk_shift->inp_m_shift_plan_hosoku = $wkdetail->oup_t_wk_plan_hosoku[$i];
            $wk_shift->getShift();

            $color[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_color[0];         // 背景カラー
            $rodo_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_rodo_time[0]; // 労働時間
            $over_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_over_time[0]; // 残業時間
*/
            $color[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $arr_shift[$wkdetail->oup_t_wk_shift_no[$i]]['color'];         // 背景カラー
            $rodo_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $arr_shift[$wkdetail->oup_t_wk_shift_no[$i]]['rodo']; // 労働時間
            $over_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $arr_shift[$wkdetail->oup_t_wk_shift_no[$i]]['over']; // 残業時間
        }
        }

        //ajax
        if ($_REQUEST['j_flg']) {
            // $kbn_name = array(
            //     '1'=>'泊',
            //     '2'=>'日',
            //     '3'=>'夜',
            //     '4'=>'年',
            //     '5'=>'欠',
            //     '6'=>'時'
            // );
            $data = array();
            $data['wk_no'] = $wk->oup_t_wk_no[0];
            $data['taiin_id'] = $wk->oup_t_wk_taiin_id[0];
            if ($wkdetail->oup_t_wk_detail_no) {
            for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
                $data['detail'][$i] = array(
                    'detail_no'=>$wkdetail->oup_t_wk_detail_no[$i],
                    'plan_kbn'=>$wkdetail->oup_t_wk_plan_kbn[$i],
                    'plan_kbn_name'=>$kbn_name[$wkdetail->oup_t_wk_plan_kbn[$i]],
                    'plan_hosoku'=>$wkdetail->oup_t_wk_plan_hosoku[$i],
                    'plan_date'=>$wkdetail->oup_t_wk_plan_date[$i],
                    'joban_time'=>$wkdetail->oup_t_wk_plan_joban_time[$i],
                    'kaban_time'=>$wkdetail->oup_t_wk_plan_kaban_time[$i],
                    'gchk'=>$wkdetail->oup_t_wk_gchk_kbn[$i],
                    'schk'=>$wkdetail->oup_t_wk_schk_kbn[$i]
                );
            }
            }
            echo json_encode($data);
            exit;
        }
    }
    }

    // トークンを発行する
    $token = md5(uniqid(rand(), true));

    // トークンをセッションに保存
    $_SESSION['token'] = $token;

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/kinmuyotei_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/kinmuyotei_html.php');
    }
?>
