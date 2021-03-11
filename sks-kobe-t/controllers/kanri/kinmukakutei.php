<?php
    session_start();
    
    require_once('/var/www/html/sks-kobe/models/common/common.php');          // 共通クラス
    require_once('/var/www/html/sks-kobe/models/common/db.php');              // DBクラス
    require_once('/var/www/html/sks-kobe/models/Genba.php');                  // 現場クラス
    require_once('/var/www/html/sks-kobe/models/Wk.php');                     // シフト予定クラス
    require_once('/var/www/html/sks-kobe/models/Wkdetail.php');               // シフト予定クラス
    require_once('/var/www/html/sks-kobe/models/Shift.php');                  // シフトクラス
    require_once('/var/www/html/sks-kobe/models/WkConf.php');                 // シフト予定クラス
    require_once('/var/www/html/sks-kobe/models/WkdetailConf.php');           // シフト予定クラス

    // require_once('../../models/common/common.php');          // 共通クラス
    // require_once('../../models/common/db.php');              // DBクラス
    // require_once('../../models/Genba.php');                  // 現場クラス
    // require_once('../../models/Wk.php');                     // シフト予定クラス
    // require_once('../../models/Wkdetail.php');               // シフト予定クラス
    // require_once('../../models/Shift.php');                  // シフトクラス
    // require_once('../../models/WkConf.php');                 // シフト予定クラス
    // require_once('../../models/WkdetailConf.php');           // シフト予定クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $start = date('Ym01', strtotime('-1 month'));
    $end = date('Ym01', strtotime('+1 month'));

    /*********************************************************
     *	クラスの作成
      ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $wk         = new Wk;           // シフト予定マスタクラス
    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
    $work   = new Wkdetail;         //  3/23
    $shift      = new Shift;        // シフトクラス

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";
    $genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

    // 現場マスタ 取得
    $genba->getGenba();

    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
    
        $wk2       = new Wk;         // 予定マスタクラス
        
        $wk2->inp_t_wk_nengetu = date("Ym");
        $wk2->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
        $wk2->getWk();
        
        if ($wk2->oup_t_wk_taiin_id) {
        for ($j=0;$j<count($wk2->oup_t_wk_taiin_id);$j++) {

            $wkconf       = new WkConf;         // シフト予定マスタクラス
            $wkdetailconf = new WkdetailConf;   // シフト予定マスタクラス

             $wkconf->inp_t_wk_conf = "1";
    //        $wkconf->inp_t_wk_nengetu = date('Ym', strtotime(date('Y-m-1') . '-1 month'));
            $wkconf->inp_t_wk_nengetu = date("Ym");
            $wkconf->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
            $wkconf->inp_t_wk_taiin_id = $wk2->oup_t_wk_taiin_id[$j];

            // 確定データの検索
            $wkconf->getWk();

            if (!$wkconf->oup_t_wk_no) {
            // if (count($wkconf->oup_t_wk_no)==0) {

    //        $wkconf->inp_t_wk_nengetu = date('Ym', strtotime(date('Y-m-1') . '-1 month'));
                $wkconf->inp_t_wk_nengetu = date("Ym");
                $wkconf->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                $wkconf->inp_t_wk_taiin_id = $wk2->oup_t_wk_taiin_id[$j];
                $wkconf->inp_t_wk_created = date("Y-m-d H:i:s");
                $wkconf->inp_t_wk_created_id = $_SESSION['staff_id'];

                // 確定データの作成
                $wkconf->insertWkConf();

    //            $wkdetailconf->inp_t_wk_nengetu = date('Ym', strtotime(date('Y-m-1') . '-1 month'));
                $wkdetailconf->inp_t_wk_nengetu = date("Ym");
                $wkdetailconf->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                $wkdetailconf->inp_t_wk_taiin_id = $wk2->oup_t_wk_taiin_id[$j];
                $wkdetailconf->inp_t_wk_created = date("Y-m-d H:i:s");
                $wkdetailconf->inp_t_wk_created_id = $_SESSION['staff_id'];

                // 確定データの作成
                $wkdetailconf->insertWkdetailConf();
            }
        }
        }
    }

    print("処理終了しました");

?>
