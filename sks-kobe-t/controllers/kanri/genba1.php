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
    require_once('../../models/Genba.php');                  // 現場クラス
    require_once('../../models/Staff.php');                  // 社員クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $genbas = array();

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    
    $genba_sort = "";
    $hyoji_sort = "";
    if (isset($_REQUEST["genba_sort"])) {
        $genba_sort = $_REQUEST["genba_sort"];
    }
    if (isset($_REQUEST["hyoji_sort"])) {
        $hyoji_sort = $_REQUEST["hyoji_sort"];
    }

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";

    // 現場マスタ 取得
    // if ($genba_sort != "") {
    //     $genba->inp_order = "order by case m_genba_deleteday when 0 then 1 else 2 end,m_genba_deleteday desc,cast(m_genba_id as signed) ";
    // } else {
    //     $genba->inp_order = "order by case m_genba_deleteday when 0 then 1 else 2 end,m_genba_deleteday desc,m_genba_hyoji_kbn ";
    // }
    if ($genba_sort != "" && $genba_sort == "1") {
        $genba->inp_order = "order by cast(m_genba_id as signed) ";
    } elseif ($hyoji_sort != "" && $hyoji_sort == "1") {
        $genba->inp_order = "order by m_genba_hyoji_kbn ";
    } else {
        $genba->inp_order = "order by case m_genba_deleteday when 0 then 1 else 2 end,m_genba_deleteday desc,m_genba_hyoji_kbn ";
    }
    
    //$genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";
    $genba->getGenba();
    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        if ($genba->oup_m_genba_deleteday[$i] < 1) {
            $genba->oup_m_genba_deleteday[$i] = "";
        }
    }

    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
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
        require_once('../../views/kanri/genba1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/genba1_html.php');
    }
?>
