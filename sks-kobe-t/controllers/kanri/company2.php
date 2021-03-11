<?php
    session_start();

// var_dump($_SESSION);
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Cooperation.php');                  // 協力会社クラス
    require_once('../../models/Staff.php');                  // 社員クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    if (isset($_REQUEST["act"])) {
        $act        = $_REQUEST["act"];
        $company_id   = $_REQUEST["company_id"];
        $company_name = $_REQUEST["company_name"];
        $company_kana = $_REQUEST["company_kana"];
        $company_id2  = $_REQUEST["company_id2"];
        $hyoji_kbn  = $_REQUEST["hyoji_kbn"];
        $deleteday  = $_REQUEST["deleteday"];
        //if ($_REQUEST["oya_genba"] == "") {
        //    $oya_genba  = null;
        //} else {
            //$oya_genba  = $_REQUEST["oya_genba"];
        //}
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $company      = new Cooperation;        // 協力会社マスタクラス
    $company2     = new Cooperation;        // 協力会社マスタクラス
    $company3     = new Cooperation;        // 協力会社マスタクラス
    $staff      = new Staff;        // 社員マスタクラス

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    //if (isset($_REQUEST["flgs"])) {
    //    $flg = $_REQUEST["flgs"];
    //}
    if ($act == "") {
        if (isset($_REQUEST["no"])) {
            // 現場マスタ 取得
            $company->inp_m_company_id = $_REQUEST["no"];
            $company->getCompany();
            if ($common->uae == 1) {
                $company->oup_m_company_deleteday[0] = str_replace(array('-', 'ー', '−', '―', '‐'), '', $company->oup_m_company_deleteday[0]);
            }
            if ($company->oup_m_company_deleteday[0] < 1) {
                $company->oup_m_company_deleteday[0] = "";
            }
        }
    }

    // 協力会社マスタ 取得 に必要な情報をセット
//    $company3->inp_m_company_del_flg = "0";
    //$genba3->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

    // 協力会社マスタ 取得
//    $company3->getCompany();

    // 取引先詳細画面で「登録」ボタンが押された場合
    if ($act == "1") {
    //if (isset($_REQUEST["flg"])) {
    //    $flg = $_REQUEST["flg"];
    //}
    //$company2->inp_m_company_id         = sprintf("%04d",$company_id);
    //$company2->getCompany();
    //if (count($company2->oup_m_company_id) != 0) {
    //    $cnt = 1;
    //}

        $company2->inp_m_company_id         = $company_id;
        //if ($flg != 1) {
        //    $company2->inp_m_company_flg         = $flg;
        //    $company2->inp_m_company_cnt         = $cnt;
        //}
        
        //$company2->inp_m_company_name         = $company_name;
        //$company2->inp_m_genba_hyoji_kbn   = $hyoji_kbn;

        // 入力内容のチェック
        $company2->inputCheck();

        // 入力内容のチェックでエラーが無い場合
        if ($company2->errmsg == "") {

            //if ($flg == "") {
            if ($company_id2 == "") {

                //$company2->inp_m_company_id         = sprintf("%04d",$company_id);
                $company2->inp_m_company_id          = $company_id;
                $company2->inp_m_company_name       = $company_name;
                $company2->inp_m_company_kana       = $company_kana;
                $company2->inp_m_company_created    = date('Y-m-d H:i:s');
                $company2->inp_m_company_created_id = $_SESSION["staff_id"];
                //$company2->inp_m_company_hyoji_kbn   = $hyoji_kbn;
                //$company2->inp_m_company_oya_id         = $oya_genba;
                $company2->inp_m_company_deleteday         = $deleteday;

                // データ登録
                $company2->insertCompany();

            } else {

                //$company2->inp_m_company_id          = sprintf("%04d",$company_id);
                $company2->inp_m_company_id          = $company_id;
                $company2->inp_m_company_name        = $company_name;
                $company2->inp_m_company_kana        = $company_kana;
                $company2->inp_m_company_modified    = date('Y-m-d H:i:s');
                $company2->inp_m_company_modified_id = $_SESSION["staff_id"];
                $company2->inp_m_company_id2         = $company_id2;
                //$company2->inp_m_company_hyoji_kbn   = $hyoji_kbn;
                //$company2->inp_m_company_oya_id         = $oya_genba;
                $company2->inp_m_company_deleteday         = $deleteday;

                // データ更新
                $company2->updateCompany();
            }

            //header('Location:genba1.php');
            header("Location:company1.php#".$company_id);

        } else {
            $company->oup_m_company_id[0]   = $company_id;
            $company->oup_m_company_name[0] = $company_name;
            $company->oup_m_company_kana[0] = $company_kana;
            //$company->oup_m_company_hyoji_kbn[0] = $hyoji_kbn;
            //$company->oup_m_company_oya_id[0]   = $oya_genba;
            $company->oup_m_company_deleteday[0]         = $deleteday;
        }

    }
    if ($act == "2") {
    //var_dump($company_id);
    //exit;

                //$company2->inp_m_company_id          = sprintf("%04d",$company_id);
                $company2->inp_m_company_id          = $company_id;
                $company2->inp_m_company_del_flg     = "1";
                $company2->inp_m_company_modified    = date('Y-m-d H:i:s');
                $company2->inp_m_company_modified_id = $_SESSION["staff_id"];
                $company2->inp_m_company_id2         = $company_id2;
                //$company2->inp_m_company_hyoji_kbn   = $hyoji_kbn;
                //$company2->inp_m_company_oya_id         = $oya_genba;
                $company2->inp_m_company_deleteday         = $deleteday;

                // データ削除
                $company2->deleteCompany();

            header('Location:company1.php');
    }
//var_dump($_REQUEST);
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/company2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/company2_html.php');
    }
?>
