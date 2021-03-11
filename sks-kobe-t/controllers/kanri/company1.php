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
    require_once('../../models/Cooperation.php');                  // 協力会社クラス
    require_once('../../models/Staff.php');                  // 社員クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    //$genbas = array();

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $company      = new Cooperation;        // 協力会社マスタクラス
    $staff      = new Staff;        // 社員マスタクラス

    // 協力会社マスタ 取得 に必要な情報をセット
    $company->inp_m_company_del_flg = "0";

    $company->inp_order = "order by case m_company_deleteday when 0 then 1 else 2 end,m_company_deleteday desc,m_company_id,m_company_kana";
    
    // 協力会社マスタ 取得
    //$genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";
    $company->getCompany();
    for ($i=0;$i<count($company->oup_m_company_id);$i++) {
        if ($company->oup_m_company_deleteday[$i] < 1) {
            $company->oup_m_company_deleteday[$i] = "";
        }
    }
    
    //for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
    //    $genbas[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    //}

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
        require_once('../../views/kanri/company1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/company1_html.php');
    }
?>
