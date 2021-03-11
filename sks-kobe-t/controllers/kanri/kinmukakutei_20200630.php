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

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $start = date('Ym01', strtotime('-1 month'));
    $end = date('Ym01', strtotime('+1 month'));
    $user_kana_array = array("" => "","1" => "ア","2" => "カ","3" => "サ","4" => "タ","5" => "ナ","6" => "ハ","7" => "マ","8" => "ヤ","9" => "ラ","10" => "ワ");

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

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";
    $genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

    // 現場マスタ 取得
    $genba->getGenba();

    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {

        $wkconf       = new WkConf;         // シフト予定マスタクラス
        $wkdetailconf = new WkdetailConf;   // シフト予定マスタクラス

         $wkconf->inp_t_wk_conf = "1";
        $wkconf->inp_t_wk_nengetu = date('Ym', strtotime(date('Y-m-1') . '-1 month'));
//        $wkconf->inp_t_wk_nengetu = date('Ym');
        $wkconf->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];

        // 確定データの検索
        $wkconf->getWk();

        if (count($wkconf->oup_t_wk_no)==0) {

            $wkconf->inp_t_wk_nengetu = date('Ym', strtotime(date('Y-m-1') . '-1 month'));
//            $wkconf->inp_t_wk_nengetu = date('Ym');
            $wkconf->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];

            // 確定データの作成
            $wkconf->insertWkConf();

            $wkdetailconf->inp_t_wk_nengetu = date('Ym', strtotime(date('Y-m-1') . '-1 month'));
//            $wkdetailconf->inp_t_wk_nengetu = date('Ym');
            $wkdetailconf->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];

            // 確定データの作成
            $wkdetailconf->insertWkdetailConf();
        }
    }

    print("処理終了しました");

?>
