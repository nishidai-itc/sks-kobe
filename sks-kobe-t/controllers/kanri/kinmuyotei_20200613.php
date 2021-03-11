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

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $start = date('Ym01', strtotime('-1 month'));
    $end = date('Ym01', strtotime('+1 month'));

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

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";
    $genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

    // 現場マスタ 取得
    $genba->getGenba();

    /*3/23*/
    // 社員マスタ 取得 に必要な情報をセット
    $staff2->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff2->getStaff();

    if ($staff2->oup_m_staff_auth[0]!="1") {

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
    /*3/23*/

    if (isset($_REQUEST['genba_id'])) {
        $genba_id = $_REQUEST['genba_id'];
    }

    // 社員マスタ 取得
    $staff->getStaff();

    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
        $staffs[$staff->oup_m_staff_id[$i]] = $staff->oup_m_staff_name[$i];
    }

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // 年月
    if (isset($_REQUEST['nengetu'])) {
        $nengetu = $_REQUEST['nengetu'];
    } else {
    //        $nengetu = date('Ym');
    //        $nengetu = date('Ym', strtotime(date('Y-m-1') . '+1 month'));
        $nengetu = date('Ym', strtotime('+1 day'));
        ;
    }
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
        $wk2->inp_t_wk_genba_id = $genba_id;
        $wk2->inp_t_wk_nengetu  = $nengetu;
        $wk2->getWk();
        // 登録の並び順番(一番最後)
        $wk_order = (count($wk2->oup_t_wk_order) + 1) * 10;

        // 登録
        $wk2->inp_t_wk_genba_id = $genba_id;
        $wk2->inp_t_wk_nengetu  = $nengetu;
        $wk2->inp_t_wk_taiin_id = $_REQUEST['staff_id'];
        $wk2->inp_t_wk_order = $wk_order;

        // シフト 取得
        $wk2->insertWk();
    }

    /*
      *  シフト登録
      */
    if (isset($_REQUEST['regist'])) {
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
                $wkdetail2->inp_t_wk_genba_id   = $genba_id;
                $wkdetail2->inp_t_wk_taiin_id   = $wk2->oup_t_wk_taiin_id[0];
                $wkdetail2->inp_t_wk_plan_date  = substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2)."-".sprintf('%02d', $_REQUEST['id']);
                $wkdetail2->inp_t_wk_plan_kbn   = $shift2->oup_m_shift_plan_kbn[0];
                // 年休の場合は実績の休暇も登録する
                if ($shift2->oup_m_shift_plan_kbn[0] == "4") {
                    $wkdetail2->inp_t_wk_joban_kbn = "4";
                }
                $wkdetail2->inp_t_wk_plan_hosoku = $shift2->oup_m_shift_plan_hosoku[0];
                $wkdetail2->inp_t_wk_plan_joban_time = $shift2->oup_m_shift_joban_time[0];
                $wkdetail2->inp_t_wk_plan_kaban_time = $shift2->oup_m_shift_kaban_time[0];
                $wkdetail2->inp_t_wk_plan_kensyu = $kensyu;
                $wkdetail2->inp_t_wk_post_teate = $post_teate->oup_m_post_teate_post_cost[0];   // ポスト手当て
                $wkdetail2->inp_t_wk_kuruma_teate = $car_teate->oup_m_car_teate_kuruma_cost[0]; // 車手当て
                $wkdetail2->inp_t_wk_created         = date('Y-m-d H:i:s');
                $wkdetail2->inp_t_wk_created_staffid = $_SESSION["staff_id"];
                $wkdetail2->inp_t_wk_shift_no        = $shift2->oup_m_shift_no[0];

                // シフト 取得
                $wkdetail2->insertWkdetail();
            }
        }
    }
    $date = new DateTime($wk_detail_no[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]]);
    $date2 = date_format($date,'Y-m');
    /*
     *  削除
     */
    if (isset($_REQUEST['delete1'])) {

        $wk2   = new Wkdetail;

        $wk2->inp_t_wk_genba_id   = $_REQUEST['genba_id'];
        $wk2->inp_t_wk_plan_month = $_REQUEST['nengetu'];
        $wk2->inp_t_wk_taiin_id   = $_REQUEST['taiin_id'];
        $wk2->inp_t_wk_jokaban_kbn2 = '1';

        $wk2->getWkdetail();

        if (count($wk2->oup_t_wk_detail_no) == 0) {

            if ($_REQUEST['wk_no'] != "") {

                $wk2   = new Wk;     // シフト予定マスタクラス

                $wk2->inp_t_wk_no = $_REQUEST['wk_no'];

                // シフト 削除
                $wk2->deleteWk();

            }

            if (($_REQUEST['genba_id'] != "") && ($_REQUEST['nengetu'] != "") && ($_REQUEST['taiin_id'] != "")) {

                $wk2   = new Wkdetail;

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
        if ($_REQUEST['wk_no'] != "") {
            
            $wk2   = new Wkdetail;     // シフト予定マスタクラス

            $wk2->inp_t_wk_no = $_REQUEST['wk_no'];
            //$wk2->inp_t_wk_detail_no = $_REQUEST['wk_no'];
            //$wk2->inp_t_wk_joban_dakoku_time = "null";
            //
            //$wk2->getWkdetail();
            //if (count($wk2->oup_t_wk_detail_no) != 0) {
            //    $wk2->inp_t_wk_no = $_REQUEST['wk_no'];

                // シフト 削除
                $wk2->deleteWkdetail();
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
     if ($nengetu == date("Ym")) {
         $wk_conf       = new Wkconf;
         $wkdetail_conf       = new Wkdetailconf;
         
         $conf = 1;
         $s_nengetu = substr($nengetu,0,6)."01";
         $e_nengetu = substr(date('Ymd',strtotime('last day of this month')),0,8);
         $wkdetail_conf->inp_t_wk_detail_conf = $conf;
         $wkdetail_conf->inp_t_wk_genba_id = $genba_id;
         $wkdetail_conf->inp_t_wk_plan_start_date = $s_nengetu;
         $wkdetail_conf->inp_t_wk_plan_end_date = $e_nengetu;
         $wkdetail_conf->getWkdetail();
         
         $wk_conf->inp_t_wk_conf = $conf;
         $wk_conf->inp_t_wk_genba_id = $genba_id;
         $wk_conf->inp_t_wk_nengetu = $nengetu;
         $wk_conf->getWk();
         
         if (count($wkdetail_conf->oup_t_wk_detail_no) != 0 || count($wk_conf->oup_t_wk_no) != 0) {
            $wkdetail_conf_flg = 1;
         } else {
            $wkdetail_conf_flg = "";
         }
     }
     //$conf = "";
     if ($nengetu > date("Ym")) {
         $wk_conf       = new Wkconf;
         $wkdetail_conf       = new Wkdetailconf;
         
         $conf = 1;
         $nengetu2 = substr($nengetu,0,4)."-".substr($nengetu,4,2);
         $s_nengetu = substr($nengetu,0,6)."01";
         $e_nengetu = substr($nengetu,0,6).substr(date('Y-m-d',strtotime($nengetu2.' last day of this month')),8,2);
         $wkdetail_conf->inp_t_wk_detail_conf = $conf;
         $wkdetail_conf->inp_t_wk_genba_id = $genba_id;
         $wkdetail_conf->inp_t_wk_plan_start_date = $s_nengetu;
         $wkdetail_conf->inp_t_wk_plan_end_date = $e_nengetu;
         $wkdetail_conf->getWkdetail();
         
         $wk_conf->inp_t_wk_conf = $conf;
         $wk_conf->inp_t_wk_genba_id = $genba_id;
         $wk_conf->inp_t_wk_nengetu = $nengetu;
         $wk_conf->getWk();
         
         if (count($wkdetail_conf->oup_t_wk_detail_no) != 0 || count($wk_conf->oup_t_wk_no) != 0) {
            $wkdetail_conf_flg = 2;
         } else {
            $wkdetail_conf_flg = "";
         }
     }
     $conf = "";
     
     if (isset($_REQUEST['conf'])) {
     if (count($wkdetail_conf->oup_t_wk_detail_no) != 0 || count($wk_conf->oup_t_wk_no) != 0) {
//     if ($wkdetail_conf_flg == 2) {

        $wkconf       = new WkConf;         // シフト予定マスタクラス
        $wkdetailconf = new WkdetailConf;   // シフト予定マスタクラス

        $wkconf->inp_t_wk_nengetu = $nengetu;
        $wkconf->inp_t_wk_genba_id = $genba_id;

        // 確定データの削除
        $wkconf->deleteWkConf();
        
        // 確定データの作成
        $wkconf->insertWkConf();
        
        // 予定確定日
        $wkconf->inp_t_wk_created = date('Y-m-d H:i:s');
        $wkconf->updateWkconf();
        
        $wkdetailconf->inp_t_wk_nengetu = $nengetu;
        $wkdetailconf->inp_t_wk_genba_id = $genba_id;
        
        // 確定データの削除
        $wkdetailconf->deleteWkdetailConf();
        
        // 確定データの作成
        $wkdetailconf->insertWkdetailConf();
        
        // 予定確定日
        $wkdetailconf->inp_t_wk_created = date('Y-m-d H:i:s');
        $wkdetailconf->inp_t_wk_plan_start_date = $s_nengetu;
        $wkdetailconf->inp_t_wk_plan_end_date = $e_nengetu;
        $wkdetailconf->updateWkdetailconf();
        
      } elseif (count($wkdetail_conf->oup_t_wk_detail_no) == 0 || count($wk_conf->oup_t_wk_no) == 0) {
        if ($nengetu == date("Ym")) {
            $wkdetail_conf_flg = 1;
        }
        if ($nengetu > date("Ym")) {
            $wkdetail_conf_flg = 2;
        }
//     } elseif ($wkdetail_conf_flg == "") {
        $wkconf       = new WkConf;         // シフト予定マスタクラス
        $wkdetailconf = new WkdetailConf;   // シフト予定マスタクラス
        
        $wkconf->inp_t_wk_nengetu = $nengetu;
        $wkconf->inp_t_wk_genba_id = $genba_id;

        // 確定データの作成
        $wkconf->insertWkConf();
        
        // 予定確定日
        $wkconf->inp_t_wk_created = date('Y-m-d H:i:s');
        $wkconf->updateWkconf();

        $wkdetailconf->inp_t_wk_nengetu = $nengetu;
        $wkdetailconf->inp_t_wk_genba_id = $genba_id;

        // 確定データの作成
        $wkdetailconf->insertWkdetailConf();
        
        // 予定確定日
        $wkdetailconf->inp_t_wk_created = date('Y-m-d H:i:s');
        $wkdetailconf->inp_t_wk_plan_start_date = $s_nengetu;
        $wkdetailconf->inp_t_wk_plan_end_date = $e_nengetu;
        $wkdetailconf->updateWkdetailconf();

        $alert = "<script type='text/javascript'>alert('予定を確定しました');</script>";
        echo $alert;
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
     *  検索
     */
    if (isset($_REQUEST['search'])) {

        // シフトの検索条件セット
        $shift->inp_m_shift_genba_id = $genba_id;

        // シフトの取得
        $shift->getShift();
        
        // シフトの検索条件セット
        $shift->inp_m_shift_genba_id = "9999";

        // シフトの取得
        $shift->getShift();

        $wk         = new Wk;         // シフト予定マスタクラス

        // 予定の検索条件セット
        $wk->inp_t_wk_genba_id = $genba_id;
        $wk->inp_t_wk_nengetu  = $nengetu;

        $wk->inp_order = "order by t_wk_order";

        // 予定の取得
        $wk->getWk();

        // 予定詳細の検索条件セット
        $wkdetail->inp_t_wk_genba_id = $genba_id;
        $wkdetail->inp_t_wk_plan_start_date = $nengetu . "01";
        $wkdetail->inp_t_wk_plan_end_date = date('Ymd', strtotime('last day of ' . substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)));

        // シフト 取得
        $wkdetail->getWkdetail();

        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            $wk_detail_no[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_detail_no[$i];
            $kbn[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_kbn[$i];
            $kbn2[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_joban_kbn[$i];
            $hosoku[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_hosoku[$i];
            $jtime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_joban_time[$i];
            $ktime[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_kaban_time[$i];
            $ken[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wkdetail->oup_t_wk_plan_kensyu[$i];

            // 労働時間

            // 背景カラー, 労働時間, 残業時間を取得
            $wk_shift      = new Shift;        // シフトクラス
            $wk_shift->inp_m_shift_genba_id = $genba_id;
            $wk_shift->inp_m_shift_plan_kbn = $wkdetail->oup_t_wk_plan_kbn[$i];
            $wk_shift->inp_m_shift_plan_hosoku = $wkdetail->oup_t_wk_plan_hosoku[$i];
            $wk_shift->getShift();

            $color[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_color[0];         // 背景カラー
            $rodo_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_rodo_time[0]; // 労働時間
            $over_time[$wkdetail->oup_t_wk_taiin_id[$i]][$wkdetail->oup_t_wk_plan_date[$i]] = $wk_shift->oup_m_shift_over_time[0]; // 残業時間
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
