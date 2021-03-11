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
    require_once('../../models/Genba.php');                  // 現場クラス
    require_once('../../models/Staff.php');                  // 社員クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    if (isset($_REQUEST["act"])) {
        $act        = $_REQUEST["act"];
        $genba_id   = $_REQUEST["genba_id"];
        $genba_name = $_REQUEST["genba_name"];
        $genba_kana = $_REQUEST["genba_kana"];
        $genba_id2  = $_REQUEST["genba_id2"];
        $hyoji_kbn  = $_REQUEST["hyoji_kbn"];
        //if ($_REQUEST["oya_genba"] == "") {
        //    $oya_genba  = null;
        //} else {
            $oya_genba  = $_REQUEST["oya_genba"];
        //}
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $genba      = new Genba;        // 現場マスタクラス
    $genba2     = new Genba;        // 現場マスタクラス
    $genba3     = new Genba;        // 現場マスタクラス
    $staff      = new Staff;        // 社員マスタクラス

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    
    if ($act == "") {
        if (isset($_REQUEST["no"])) {
            // 現場マスタ 取得
            $genba->inp_m_genba_id = $_REQUEST["no"];
            $genba->getGenba();
        }
    }
    
    // 現場マスタ 取得 に必要な情報をセット
    $genba3->inp_m_genba_del_flg = "0";
    $genba3->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";

    // 現場マスタ 取得
    $genba3->getGenba();

    // 取引先詳細画面で「登録」ボタンが押された場合
    if ($act == "1") {

        $genba2->inp_m_genba_id         = $genba_id;
        $genba2->inp_m_genba_hyoji_kbn   = $hyoji_kbn;

        // 入力内容のチェック
        $genba2->inputCheck();

        // 入力内容のチェックでエラーが無い場合
        if ($genba2->errmsg == "") {

            if ($genba_id2 == "") {

                $genba2->inp_m_genba_id         = $genba_id;
                $genba2->inp_m_genba_name       = $genba_name;
                $genba2->inp_m_genba_kana       = $genba_kana;
                $genba2->inp_m_genba_created    = date('Y-m-d H:i:s');
                $genba2->inp_m_genba_created_id = $_SESSION["staff_id"];
                $genba2->inp_m_genba_hyoji_kbn   = $hyoji_kbn;
                $genba2->inp_m_genba_oya_id         = $oya_genba;

                // データ登録
                $genba2->insertGenba();

            } else {

                $genba2->inp_m_genba_id          = $genba_id;
                $genba2->inp_m_genba_name        = $genba_name;
                $genba2->inp_m_genba_kana        = $genba_kana;
                $genba2->inp_m_genba_modified    = date('Y-m-d H:i:s');
                $genba2->inp_m_genba_modified_id = $_SESSION["staff_id"];
                $genba2->inp_m_genba_id2         = $genba_id2;
                $genba2->inp_m_genba_hyoji_kbn   = $hyoji_kbn;
                $genba2->inp_m_genba_oya_id         = $oya_genba;

                // データ更新
                $genba2->updateGenba();
            }

            //header('Location:genba1.php');
            header("Location:genba1.php#".$genba_id);

        } else {
            $genba->oup_m_genba_id[0]   = $genba_id;
            $genba->oup_m_genba_name[0] = $genba_name;
            $genba->oup_m_genba_kana[0] = $genba_kana;
            $genba->oup_m_genba_hyoji_kbn[0] = $hyoji_kbn;
            $genba->oup_m_genba_oya_id[0]   = $oya_genba;
        }

    }
    if ($act == "2") {

                $genba2->inp_m_genba_id          = $genba_id;
                $genba2->inp_m_genba_del_flg     = "1";
                $genba2->inp_m_genba_modified    = date('Y-m-d H:i:s');
                $genba2->inp_m_genba_modified_id = $_SESSION["staff_id"];
                $genba2->inp_m_genba_id2         = $genba_id2;
                $genba2->inp_m_genba_hyoji_kbn   = $hyoji_kbn;
                $genba2->inp_m_genba_oya_id         = $oya_genba;

                // データ削除
                $genba2->deleteGenba();

            header('Location:genba1.php');
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/genba2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/genba2_html.php');
    }
?>
