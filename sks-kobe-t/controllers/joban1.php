<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])) {
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    set_time_limit(300);
    
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/Wkdetail.php');               // 作業クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Genba.php');                  // 現場クラス
    require_once('../models/Wk.php');                     // シフト予定クラス
    require_once('../models/Shift.php');                  // シフトクラス
    require_once('../models/Kotuhi.php');                 // 交通費クラス
    require_once('./function/utils.php');                 // 関数クラス

    $act        = null;
    $errmsg     = "";
    $week = array("日", "月", "火", "水", "木", "金", "土");
    $user_kana_array = array("" => "","1" => "ア","2" => "カ","3" => "サ","4" => "タ","5" => "ナ","6" => "ハ","7" => "マ","8" => "ヤ","9" => "ラ","10" => "ワ");

    if (isset($_POST["act"])) {
        $act            = $_POST["act"];
//        $inp_joban_kbn  = $_POST["joban_kbn"];
//        $inp_joban_time = $_POST["joban_time"];
//        $new_pw2 = $_POST["new_pw2"];
    }
    //カナ検索
    if (isset($_REQUEST['user_kana'])) {
        $user_kana = $_REQUEST['user_kana'];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $work       = new Wkdetail;     // 作業クラス
    $work_mem   = new Wkdetail;     // 作業クラス
    $staff      = new Staff;        // 社員マスタクラス
    $search_staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス
    $genba2     = new Genba;        // 現場マスタクラス
    $shift      = new Shift;        // シフトマスタクラス
    $shift2      = new Shift;        // シフトマスタクラス
    $kotuhi     = new Kotuhi;       // 交通費マスタクラス
    $utils      = new Utils;        // 関数クラス

    if ($common->device == "mobile") {
        $col1 = "col-3";
        $col2 = "col-5";
    } else {
        $col1 = "col-1";
        $col2 = "col-4";
    }
    //$search_staff->inp_m_staff_kana = $user_kana;
    //退職者はプルダウンに表示しない
    $search_staff->inp_m_staff_taisyaday = 1;
    // 社員マスタ 取得
    $search_staff->getStaff();

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

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    //検索プルダウン、（本部、上下番チェック者）
    if (isset($_REQUEST['genba_id'])) {
        $genba_id = $_REQUEST['genba_id'];
        //$_SESSION["gid"] = $_REQUEST['genba_id'];
    } else {
        //追加ボタン押下時
        if (isset($_REQUEST['genba_id2'])) {
            $genba_id = $_REQUEST['genba_id2'];
        } else {
            //if ($staff->oup_m_staff_auth[0] == 1 || $staff->oup_m_staff_auth[0] == 3) {
                $genba_id = "";
            //} else {
            //    $genba_id = $staff->oup_m_staff_genba_id[0];
            //}
        }
    }
    //// 現場マスタ 取得 に必要な情報をセット
    //if ($staff->oup_m_staff_auth[0] == 2) {
    //    $genba->inp_m_genba_id = $staff->oup_m_staff_genba_id[0];
    //} else {
    //    //$genba->inp_m_genba_id = $staff->oup_m_staff_genba_id[0];
    //}
    //
    //// 現場マスタ 取得
    ////使用終了日以降は非表示
    //$genba->inp_m_genba_deleteday = 1;
    //$genba->getGenba();
    
    //現場名を現場IDに格納
    $genba4     = new Genba;
    //$genba4->inp_m_genba_deleteday = 1;
    $genba4->inp_m_genba_deleteday = date("Ymd");
    $genba4->getGenba();
    for ($i=0;$i<count($genba4->oup_m_genba_id);$i++) {
        $genba_name[$genba4->oup_m_genba_id[$i]] = $genba4->oup_m_genba_name[$i];
    }
    
    //$del_genba     = new Genba;
    //$del_genba->inp_m_genba_get_deleteday = date("Ymd");
    //$del_genba->getGenba();
    
    $shift2->inp_left_join_m_genba = "1";
    //リーダー権限者は自分の親子現場のみ
    if ($staff->oup_m_staff_auth[0] == 2) {
        if ($genba_id != "") {
            $shift2->inp_m_shift_genba_id2 = $genba_id;
        } else {
            $genba5     = new Genba;
            $genba5->inp_m_genba_oya_id = $staff->oup_m_staff_genba_id[0];
            $genba5->getGenba();
            
            
            $shift2->inp_m_shift_genba_id3 = "'".$staff->oup_m_staff_genba_id[0]."'";
            if ($genba5->oup_m_genba_id) {
            for ($i=0;$i<count($genba5->oup_m_genba_id);$i++) {
                $shift2->inp_m_shift_genba_id3 = $shift2->inp_m_shift_genba_id3 . ",'" . $genba5->oup_m_genba_id[$i] . "'";
            }
            }
        }

    } else {
        if ($genba_id != "") {
        
            $genba5     = new Genba;
            $genba5->inp_m_genba_oya_id = $genba_id;
            $genba5->getGenba();
            
            
            $shift2->inp_m_shift_genba_id2 = "'".$genba_id."'";
            if ($genba5->oup_m_genba_id) {
            for ($i=0;$i<count($genba5->oup_m_genba_id);$i++) {
                $shift2->inp_m_shift_genba_id2 = $shift2->inp_m_shift_genba_id2 . ",'" . $genba5->oup_m_genba_id[$i] . "'";
            }
            }
        } else {
            $shift2->inp_m_shift_genba_id4 = "9999";
        }
    }
    
    //if (count($del_genba->oup_m_genba_id) != 0) {
    //    $shift2->inp_m_shift_genba_id5 = "'".$del_genba->oup_m_genba_id[0]."'";
    //    for ($i=0;$i<count($del_genba->oup_m_genba_id);$i++) {
    //        $shift2->inp_m_shift_genba_id5 = $shift2->inp_m_shift_genba_id5.",'".$del_genba->oup_m_genba_id[$i]."'";
    //    }
    //}
    $shift2->inp_m_shift_deleteday = date("Ymd");
    $shift2->inp_order = "ORDER BY m_genba_hyoji_kbn";
    $shift2->getShift();
    for ($i=0;$i<count($shift2->oup_m_shift_no);$i++) {
        if ($shift2->oup_m_shift_plan_hosoku[$i] != "") {
            $shift_name[$shift2->oup_m_shift_no[$i]] = $genba_name[$shift2->oup_m_shift_genba_id[$i]]."/".$shift2->kbn[$shift2->oup_m_shift_plan_kbn[$i]].$shift2->oup_m_shift_plan_hosoku[$i]."/".substr($shift2->oup_m_shift_joban_time[$i],0,5)."～".substr($shift2->oup_m_shift_kaban_time[$i],0,5);
        } else {
            $shift_name[$shift2->oup_m_shift_no[$i]] = $genba_name[$shift2->oup_m_shift_genba_id[$i]]."/".$shift2->kbn[$shift2->oup_m_shift_plan_kbn[$i]]."/".substr($shift2->oup_m_shift_joban_time[$i],0,5)."～".substr($shift2->oup_m_shift_kaban_time[$i],0,5);
        }
    }

    //リーダー権限は自分の親子現場のみ
    // 作業テーブル 取得 に必要な情報をセット
    if ($staff->oup_m_staff_auth[0] == 2) {
        // 現場マスタ 取得 に必要な情報をセット
        $genba2->inp_m_genba_oya_id = $staff->oup_m_staff_genba_id[0];
        // 現場マスタ 取得
        $genba2->getGenba();
    
        $genba->inp_m_genba_id2    = "'".$staff->oup_m_staff_genba_id[0]."'";
        if ($genba2->oup_m_genba_id) {
        for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) {
            $genba->inp_m_genba_id2 = $genba->inp_m_genba_id2 . ",'" . $genba2->oup_m_genba_id[$i] . "'";
        }
        }
        
        if ($genba_id == "") {
            $work_mem->inp_t_wk_genba_id2    = "'".$staff->oup_m_staff_genba_id[0]."'";
            if ($genba2->oup_m_genba_id) {
            for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) {
                $work_mem->inp_t_wk_genba_id2 = $work_mem->inp_t_wk_genba_id2 . ",'" . $genba2->oup_m_genba_id[$i] . "'";
            }
            }
        } else {
            $work_mem->inp_t_wk_genba_id    = $genba_id;
        }
    }
    // 現場マスタ 取得
    //使用終了日以降は非表示
    //$genba->inp_m_genba_deleteday = 1;
    $genba->inp_m_genba_deleteday = date("Ymd");
    $genba->inp_m_genba_id9999 = 1;
    $genba->getGenba();
    
    // 社員マスタ追加
    if (isset($_POST['add_staff'])) {
        if ($_REQUEST['shift'] != "") {
            $wk_check         = new Wk;           // シフト予定マスタクラス
            $wk_shift         = new Wk;           // シフト予定マスタクラス

//$file = '../log/log.txt';
//// ファイルをオープンして既存のコンテンツを取得します
//$current = file_get_contents($file);
//// 新しい人物をファイルに追加します
//$current .= date('m-d H:i:s')." ";
//$current .= "上番（リーダー）隊員追加 ".$_SESSION["staff_id"]."\n";
//// 結果をファイルに書き出します
//file_put_contents($file, $current);

// 書き込みモード（追記）でファイルを開く
$fp = fopen("../log/log.txt", "a");

$current = date('m-d H:i:s')." ";
$current .= "上番（リーダー）隊員追加 ".$_SESSION["staff_id"]."\n";
// ファイルに書き込む
fwrite($fp, $current);

// ファイルを閉じる
fclose($fp);

            
            // 勤務詳細のみ登録
            $wkdetail       = new Wkdetail;     // 勤務詳細マスタクラス
            $wkdetail2       = new Wkdetail;     // 勤務詳細マスタクラス
            $shift3       = new Shift;     // シフトマスタクラス
            
            $shift3->inp_m_shift_no = $_REQUEST['shift'];
            $shift3->getShift();
            
            $wkdetail->inp_t_wk_office_id = "";
            if ($shift3->oup_m_shift_genba_id[0] != "9999") {
                $wkdetail->inp_t_wk_genba_id = $shift3->oup_m_shift_genba_id[0];
                $wk_check->inp_t_wk_genba_id = $shift3->oup_m_shift_genba_id[0];
                $wk_shift->inp_t_wk_genba_id = $shift3->oup_m_shift_genba_id[0];
            } else {
                $wkdetail->inp_t_wk_genba_id = $genba_id;
                $wk_check->inp_t_wk_genba_id = $genba_id;
                $wk_shift->inp_t_wk_genba_id = $genba_id;
            }
            
            //予定があるかチェック
            $wk_check->inp_t_wk_nengetu  = date('Ym');
            $wk_check->getWk();
            if ($wk_check->oup_t_wk_no) {
                $wk_order = count($wk_check->oup_t_wk_no)*10+10;
            } else {
                $wk_order = 10;
            }
            
            $wk_shift->inp_t_wk_nengetu  = date('Ym');
            $wk_shift->inp_t_wk_taiin_id = $_POST['add_staff'];
            $wk_shift->getWk();
            
            //予定がなければ予定を追加
            if (!$wk_shift->oup_t_wk_no) {
            // if (count($wk_shift->oup_t_wk_no) == 0) {
                $wk_shift->inp_t_wk_order = $wk_order;
                $wk_shift->insertWk();
            }
            //同じ勤務がなければ追加（更新ボタンの回避）
            $wkdetail2->inp_t_wk_plan_date = date('Ymd');
            $wkdetail2->inp_t_wk_taiin_id = $_POST['add_staff'];
            $wkdetail2->inp_t_wk_shift_no = $_REQUEST['shift'];
            $wkdetail2->getWkdetail();
            if (!$wkdetail2->oup_t_wk_detail_no) {
            // if (count($wkdetail2->oup_t_wk_detail_no) == 0) {
                $wkdetail->inp_t_wk_taiin_id = $_POST['add_staff'];
                $wkdetail->inp_t_wk_plan_date = date('Y-m-d');
                $wkdetail->inp_t_wk_plan_kbn = $shift3->oup_m_shift_plan_kbn[0];
                if ($shift3->oup_m_shift_plan_kbn[0] == "4") {
                    $wkdetail->inp_t_wk_joban_kbn = $shift3->oup_m_shift_plan_kbn[0];
                }
                if ($shift3->oup_m_shift_plan_hosoku[0] != "") {
                    $wkdetail->inp_t_wk_plan_hosoku = $shift3->oup_m_shift_plan_hosoku[0];
                }
                $wkdetail->inp_t_wk_plan_joban_time = $shift3->oup_m_shift_joban_time[0];
                $wkdetail->inp_t_wk_plan_kaban_time = $shift3->oup_m_shift_kaban_time[0];
                $wkdetail->inp_t_wk_shift_no = $_REQUEST['shift'];
                $wkdetail->inp_t_wk_created = date('Y-m-d H:i:s');
                $wkdetail->inp_t_wk_created_id = $_SESSION['staff_id'];
                
                $wkdetail->insertWkdetail();
                
                $alert = "<script type='text/javascript'>alert('隊員追加しました。');</script>";
                echo $alert;
            }
            
        } else {
            //$alert = "<script type='text/javascript'>alert('勤務体系を選んでください');</script>";
            //echo $alert;
        }
    }
    
    ////検索プルダウン、（本部、上下番チェック者）
    //if (isset($_REQUEST['genba_id'])) {
    //    $genba_id = $_REQUEST['genba_id'];
    //    //$_SESSION["gid"] = $_REQUEST['genba_id'];
    //} else {
    //    if (isset($_REQUEST['genba_id2'])) {
    //        $genba_id = $_REQUEST['genba_id2'];
    //    } else {
    //        if ($staff->oup_m_staff_auth[0] == 1 || $staff->oup_m_staff_auth[0] == 3) {
    //            $genba_id = "";
    //        } else {
    //            $genba_id = $staff->oup_m_staff_genba_id[0];
    //        }
    //    }
    //}
    //検索
    //if (isset($_REQUEST["search"]) || (isset($_REQUEST["user_kana"]) && $staff->oup_m_staff_auth[0] != 2)) {
    if ($staff->oup_m_staff_auth[0] != 2) {
    
        $genba3      = new Genba;        // 現場マスタクラス
        $genba3->inp_m_genba_oya_id = $genba_id;
        $genba3->getGenba();
        
        $work_mem->inp_t_wk_genba_id2    = "'".$genba_id."'";
        if ($genba3->oup_m_genba_id) {
        for ($i=0;$i<count($genba3->oup_m_genba_id);$i++) {
            $work_mem->inp_t_wk_genba_id2 = $work_mem->inp_t_wk_genba_id2 . ",'" . $genba3->oup_m_genba_id[$i] . "'";
        }
        }
        //$work_mem->inp_t_wk_genba_id     = $genba_id;
    }

    $work_mem->inp_t_wk_plan_date   = date('Ymd');
    $work_mem->inp_t_wk_del_flg     = "0";
    $work_mem->inp_t_wk_joban_kbn4     = "true";
    //$work_mem->inp_t_wk_kaban_kbn2     = 1;
    //$work_mem->inp_order = "ORDER BY  t_wk_genba_id,t_wk_plan_kbn, t_wk_plan_joban_time, t_wk_taiin_id  ";
    $work_mem->inp_left_join_m_genba = 1;
    $work_mem->inp_order = "ORDER BY m_genba.m_genba_hyoji_kbn, t_wk_detail.t_wk_plan_kbn, t_wk_detail.t_wk_plan_joban_time, t_wk_detail.t_wk_taiin_id  ";

    // 作業テーブル 取得
    $work_mem->getWkdetail();

//    for ($i=0;$i<count($work_mem->oup_t_wk_taiin_id);$i++) {
        $staff_mem  = new Staff;        // 社員マスタクラス

        // 社員マスタ 取得 に必要な情報をセット
//        $staff_mem->inp_m_staff_id = $work_mem->oup_t_wk_taiin_id[$i];

        // 社員マスタ 取得
        $staff_mem->getStaff();

    for ($i=0;$i<count($staff_mem->oup_m_staff_id);$i++) {
        $staffs[$staff_mem->oup_m_staff_id[$i]] = $staff_mem->oup_m_staff_name[$i];
    }

      //  $staff_name[$i] = $staff_mem->oup_m_staff_name[0];

      //   //  作業実施の上番時刻　取得
      //  $p_joban_time[$i] = substr($work_mem->oup_t_wk_plan_joban_time[$i], 0, 5);
      //  $p_kaban_time[$i] = substr($work_mem->oup_t_wk_plan_kaban_time[$i], 0, 5);

      //  $joban_time[$i] = substr($work_mem->oup_t_wk_joban_time[$i], 0, 5);
      //  if ($joban_time[$i] == "" && $work_mem->oup_t_wk_joban_kbn[$i] == "") {
      //      $joban_time[$i] = $p_joban_time[$i];
      //  }

      //   // 勤務 取得
      //  if ($work_mem->oup_t_wk_plan_kbn[$i]=="1") {
      //      $kinmu[$i] = "泊";
      //  } else if ($work_mem->oup_t_wk_plan_kbn[$i]=="2") {
      //      $kinmu[$i] = "日勤";
      //  } else if ($work_mem->oup_t_wk_plan_kbn[$i]=="3") {
      //      $kinmu[$i] = "夜勤";
      //  } else {
      //      $kinmu[$i] = "";
      //  }
   

    switch ($act) {
        // 画面上の決定ボタンが押された場合
        case 1:
//$time_start = microtime(true);
            // 交通費マスタ 取得 に必要な情報をセット
            $kotuhi->inp_m_kotuhi_startday = date('Y-m-d');

            // 交通費マスタ 取得
            $kotuhi->getKotuhi();

            if ($kotuhi->oup_m_kotuhi_no) {
            for ($i=0;$i<count($kotuhi->oup_m_kotuhi_no);$i++) {
                $kotuhis[$kotuhi->oup_m_kotuhi_staff_id[$i]][$kotuhi->oup_m_kotuhi_place_id[$i]][$kotuhi->oup_m_kotuhi_hosoku[$i]] = $kotuhi->oup_m_kotuhi_cost[$i];
            }
            }
//var_dump($kotuhis);
            for ($i=0; $i<count($_POST["wk_no"]); $i++) {
                // $post_joban_kbn = $_POST["joban_time"][$i][0] . ':' . $_POST["joban_time"][$i][1];
//print("1=".$_POST["tujo_checked"][$i]);
//print(" ");
//print("2=".$_POST["plan_joban"][$i]);
//print(" ");
//print("3=".$_POST["joban_time"][$i]);
//print("<br />");
                
                if ($_POST["joban_time"][$i] == "" && $_POST["kyuka"][$i] == "") {
                    continue;
                }
                ////DBに現在登録されているデータを取得
                //$work_old      = new Wkdetail;         // 作業クラス
                //$work_old->inp_t_wk_detail_no = $_POST["wk_no"][$i];              // 作業実施NO（連番）
                //$work_old->inp_flg = "2";
                //$work_old->getWkdetail();
                ////var_dump($work_old->all);
                ////exit;
                ////元のデータと変更がなければスキップ
                //if ($work_old->all[1] == $_POST['joban_time'][$i] && $work_old->all[2] == $_POST['kyuka'][$i]) {
                //    continue;
                //}
                
                if (($_POST["tujo_checked"][$i]!="") || ($_POST["plan_joban"][$i]!=$_POST["joban_time"][$i]) || ($_POST["kyuka"][$i]!="")) {
                //if (($_POST["tujo_checked"][$i]!="") || ($_POST["plan_time"][$i]!=$_POST["joban_time"][$i] && $_POST["joban_time"][$i] != "") || ($_POST["kyuka"][$i]!="")) {
//print("OK");
                    // if ($_POST["joban_time"][$i]!="") {

                        $work2      = new Wkdetail;         // 作業クラス
                        $work3      = new Wkdetail;         // 作業クラス

                        $work3->inp_t_wk_detail_no = $_POST["wk_no"][$i];              // 作業実施NO（連番）

                        $work3->getWkdetail();

                        // 作業 更新 に必要な情報をセット
                        $work2->inp_t_wk_detail_no = $_POST["wk_no"][$i];              // 作業実施NO（連番）
                        // if (!$_POST["joban_kbn"][$i]) {
                        //     $inp_joban_kbn = null;
                        // } else {
                        //     $inp_joban_kbn = $_POST["joban_kbn"][$i];
                        // }
                        // $work2->inp_t_work_joban_kbn  = $inp_joban_kbn;               // 上番区分

                        // 上番区分 = 通常
                        // if ($inp_joban_kbn == "1") {
                        //     $work2->inp_t_wk_joban_time = $_POST["joban_time"][$i];   // 上番時刻
                        //     $work2->inp_t_wk_joban_kbn = "1";
                        // // 上番区分 = 休暇
                        //} else
                        if ($_POST["kyuka"][$i] == "4") {
                            $work2->inp_t_wk_joban_time = "";                                     // 上番時刻
                            $work2->inp_t_wk_joban_kbn = "4";
                        // 上番区分 = 欠勤
                        } elseif ($_POST["kyuka"][$i] == "5") {
                            $work2->inp_t_wk_joban_time = "";                                     // 上番時刻
                            $work2->inp_t_wk_joban_kbn = "5";
                        // 上番区分 = 通常 or 早出 or 遅刻
                        } else {
                            if ($_POST["joban_time"][$i] === "") {
                                $post_joban_time = "";
                            } else {
                                $post_joban_time = $_POST["joban_time"][$i];

                                if ($kotuhis[$work3->oup_t_wk_taiin_id[0]][$work3->oup_t_wk_genba_id[0]][$work3->oup_t_wk_plan_hosoku[0]]=="") {
                                    $work2->inp_t_wk_kotuhi      = $kotuhis[$work3->oup_t_wk_taiin_id[0]][$work3->oup_t_wk_genba_id[0]][''];
                                } else {
                                    $work2->inp_t_wk_kotuhi      = $kotuhis[$work3->oup_t_wk_taiin_id[0]][$work3->oup_t_wk_genba_id[0]][$work3->oup_t_wk_plan_hosoku[0]];
                                }
                            }

                            // $post_joban_time = $utils->formatHourMinute($_POST["joban_time"][$i][0], $_POST["joban_time"][$i][1]); // 上番時刻の整形

                            if ($post_joban_time == "") {
                                //実績上番時間を空に
                                //$work2->inp_t_wk_joban_time = "";                        // 上番時刻
//                                $work2->inp_t_wk_joban_kbn = "";
                            } else {
                                $work2->inp_t_wk_joban_kbn = "1";
                                $work2->inp_t_wk_joban_time = $post_joban_time;                        // 上番時刻
                            }
                            // } elseif ($_POST["plan_time"][$i] == $post_joban_time) {
                            //     $work2->inp_t_wk_joban_kbn = "1";
                            //     $work2->inp_t_wk_joban_time = $post_joban_time;                        // 上番時刻
                            // } elseif ($_POST["plan_time"][$i] > $post_joban_time) {
                            //     $work2->inp_t_wk_joban_kbn = "2";
                            //     $work2->inp_t_wk_joban_time = $post_joban_time;                        // 上番時刻
                            // } elseif ($_POST["plan_time"][$i] < $post_joban_time) {
                            //     $work2->inp_t_wk_joban_kbn = "3";
                            //     $work2->inp_t_wk_joban_time = $post_joban_time;                        // 上番時刻
                            // }

                            if (($post_joban_time != "") && ($_POST["joban_dakoku"][$i]=="")) {
                                $work2->inp_t_wk_joban_dakoku_time = date("H:i:s");
                            }

                        }

//print("taiin=".$work3->oup_t_wk_taiin_id[0]);
//print("kotuhi=".$work2->inp_t_wk_kotuhi);
//print("<br />");
//                        $work2->inp_t_wk_kotuhi      = $kotuhis[$work3->oup_t_wk_taiin_id[0]][$work3->oup_t_wk_genba_id[0]];

                        // 連勤の場合は登録しない
                        // 泊→泊の場合
                        // 夜勤→泊の場合
                        // 泊→日の場合
                        // 夜勤→日の場合

                        $work4      = new Wkdetail;         // 作業クラス

                        // 作業テーブル 取得 に必要な情報をセット
//                        $work4->inp_t_wk_taiin_id    = $_SESSION["staff_id"];
                        $work4->inp_t_wk_taiin_id    = $work3->oup_t_wk_taiin_id[0];
                        $work4->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
                        $work4->inp_t_wk_del_flg     = "0";
                        $work4->inp_t_wk_genba_id    = $work3->oup_t_wk_genba_id[0];

                        // リーダーの作業テーブル 取得
                        $work4->getWkdetail();

                        if (($work4->oup_t_wk_plan_kbn[0]=="1" && $work3->oup_t_wk_plan_kbn[0]=="1") || 
                            ($work4->oup_t_wk_plan_kbn[0]=="3" && $work3->oup_t_wk_plan_kbn[0]=="1") || 
                            ($work4->oup_t_wk_plan_kbn[0]=="1" && $work3->oup_t_wk_plan_kbn[0]=="2") || 
                            ($work4->oup_t_wk_plan_kbn[0]=="3" && $work3->oup_t_wk_plan_kbn[0]=="2")) {
                            $work2->inp_t_wk_kotuhi = 0;
                        }

                        $work2->inp_t_wk_modified    = date('Y-m-d H:i:s');                     // 更新日
                        $work2->inp_t_wk_modified_id = $_SESSION["staff_id"];                   // 更新者


//$file = '../log/log.txt';
//// ファイルをオープンして既存のコンテンツを取得します
//$current = file_get_contents($file);
//// 新しい人物をファイルに追加します
//$current .= date('m-d H:i:s')." ";
//$current .= "上番（リーダー） ".$_SESSION["staff_id"]."\n";
//// 結果をファイルに書き出します
//file_put_contents($file, $current);

// 書き込みモード（追記）でファイルを開く
$fp = fopen("../log/log.txt", "a");

$current = date('m-d H:i:s')." ";
$current .= "上番（リーダー） ".$_SESSION["staff_id"]."\n";
// ファイルに書き込む
fwrite($fp, $current);

// ファイルを閉じる
fclose($fp);


                        // 作業の更新
                        $work2->updateWkdetail();


                        /*
                         * 勤務時間の更新
                         */

                        $work5      = new Wkdetail;         // 作業クラス

                        $work5->inp_t_wk_detail_no = $_POST["wk_no"][$i];              // 作業実施NO（連番）

                        $work5->getWkdetail();
                        
                        //if ($work_mem->oup_t_wk_inp_kbn[$i] != "1") {
                        if ($work5->oup_t_wk_inp_kbn[0] != "1") {
                        
                            $work2      = new Wkdetail;     // 作業クラス
                            $work3      = new Wkdetail;     // 作業クラス
                            $shift      = new Shift;        // シフトクラス

                            // シフト取得
                            //$shift->inp_m_shift_no = $work_mem->oup_t_wk_shift_no[$i];
                            $shift->inp_m_shift_no = $work5->oup_t_wk_shift_no[0];
                            $shift->getShift();

                            $work2->inp_genba_id = $shift->oup_m_shift_genba_id[0];
                            $work2->inp_shift_ktime = $shift->oup_m_shift_kyukei_time[0]; // 休憩
                            $work2->inp_shift_otime = $shift->oup_m_shift_over_time[0]; // 所定残
                            $work2->inp_shift_rtime = $shift->oup_m_shift_rodo_time[0]; // 労働時間
                            //$work2->inp_joban_kbn = $work_mem->oup_t_wk_joban_kbn[$i];
                            //$work2->inp_plan_kbn = $work_mem->oup_t_wk_plan_kbn[$i];
                            //$work2->inp_plan_joban_time = $work_mem->oup_t_wk_plan_joban_time[$i];
                            //$work2->inp_plan_kaban_time = $work_mem->oup_t_wk_plan_kaban_time[$i];
                            //$work2->inp_joban_time = $work_mem->oup_t_wk_joban_time[$i];
                            //$work2->inp_kaban_time = $work_mem->oup_t_wk_kaban_time[$i];
                            $work2->inp_joban_kbn = $work5->oup_t_wk_joban_kbn[0];
                            $work2->inp_plan_kbn = $work5->oup_t_wk_plan_kbn[0];
                            $work2->inp_plan_joban_time = $work5->oup_t_wk_plan_joban_time[0];
                            $work2->inp_plan_kaban_time = $work5->oup_t_wk_plan_kaban_time[0];
                            $work2->inp_joban_time = $work5->oup_t_wk_joban_time[0];
                            $work2->inp_kaban_time = $work5->oup_t_wk_kaban_time[0];
                            $work2->getcalckintime();

                            //$work3->inp_t_wk_detail_no = $work_mem->oup_t_wk_detail_no[$i];
                            $work3->inp_t_wk_detail_no = $work5->oup_t_wk_detail_no[0];
                            $work3->inp_t_wk_kinmu_time = $work2->kinmu_time;
                            $work3->inp_t_wk_syotei_zan = $work2->syotei_otime;
                            $work3->inp_t_wk_hayazan = $work2->hayazan_time;
                            $work3->inp_t_wk_tuzan = $work2->tuzan_time;

                            $work3->updateWkdetail();
                        }




                    //}
                }
            }
//var_dump(microtime(true) - $time_start);
//exit;
            // キャリア判定（PC/スマートフォン/タブレット）
            if ($common->judgephone) {
                // HTML表示
                header('Location:./menu.php');
            // キャリア判定（フィーチャーフォン）
            } else {
                // HTML表示
                header("Location:./menu.php?".SID);
            }

            break;
    }

    

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/joban1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/joban1_html.php');
    }
?>