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
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/Genba.php');                  // 現場クラス
    require_once('../../models/Cooperation.php');                  // 協力会社クラス

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $staff      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス
    $company      = new Cooperation;        // 協力会社マスタクラス

    $staff->inp_order = "ORDER BY case m_staff_taisya when 0 then 1 else 2 end,m_staff_taisya desc,m_staff_id ";
//    $staff->inp_order = "ORDER BY m_staff_kana ";

    // 社員マスタ 取得
    $staff->getStaff();
    
    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
        if ($staff->oup_m_staff_nyusya[$i] < 1) {
            $staff->oup_m_staff_nyusya[$i] = "";
        }
        if ($staff->oup_m_staff_taisya[$i] < 1) {
            $staff->oup_m_staff_taisya[$i] = "";
        }
    }

    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = "0";
    
    // 現場マスタ 取得
    $genba->getGenba();

    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    }
    
    // 協力会社マスタ 取得 に必要な情報をセット
    $company->inp_m_company_del_flg = "0";
    // 協力会社マスタ 取得
    $company->getCompany();
    for ($i=0;$i<count($company->oup_m_company_id);$i++) {
        $companys[$company->oup_m_company_id[$i]] = $company->oup_m_company_name[$i];
    }

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/staff1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/staff1_html.php');
    }
?>
