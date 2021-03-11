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
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/Genba.php');                  // 現場クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    if (isset($_REQUEST["act"])) {
        $act        = $_REQUEST["act"];
        $staff_id   = $_REQUEST["staff_id"];
        $staff_name = $_REQUEST["staff_name"];
        $staff_kana = $_REQUEST["staff_kana"];
        $staff_login_id = $_REQUEST["staff_login_id"];
        $staff_pass = $_REQUEST["staff_pass"];
        $staff_auth = $_REQUEST["staff_auth"];
        $staff_koyo = $_REQUEST["staff_koyo"];
        $staff_id2  = $_REQUEST["staff_id2"];
        $genba_id   = $_REQUEST["genba_id"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $staff      = new Staff;        // 社員マスタクラス
    $staff2     = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス

    if ($act == "") {
        if (isset($_REQUEST["no"])) {
            // 社員マスタ 取得
            $staff->inp_m_staff_id = $_REQUEST["no"];
            $staff->getStaff();
        }
    }

    $genba->inp_order = "order by m_genba_hyoji_kbn,m_genba_id ";
    // 現場マスタ 取得
    $genba->getGenba();

    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genbas[$genba->oup_m_genba_id[$i]] = $staff->oup_m_genba_name[$i];
    }

    // 取引先詳細画面で「登録」ボタンが押された場合
    if ($act == "1") {

        if ($staff_id2 == "") {

            $staff2->inp_m_staff_id         = $staff_id;
            $staff2->inp_m_staff_name       = $staff_name;
            $staff2->inp_m_staff_kana       = $staff_kana;
            $staff2->inp_m_staff_login_id   = $staff_login_id;
            $staff2->inp_m_staff_pass       = md5(md5("ITC".$staff_pass)."ITC");
            $staff2->inp_m_staff_auth       = $staff_auth;
            $staff2->inp_m_staff_kbn        = $staff_koyo;
            $staff2->inp_m_staff_genba_id   = $genba_id;
            $staff2->inp_m_staff_created    = date('Y-m-d H:i:s');
            $staff2->inp_m_staff_created_id = $_SESSION["staff_id"];

            // データ登録
            $staff2->insertStaff();

        } else {

            $staff2->inp_m_staff_id         = $staff_id;
            $staff2->inp_m_staff_name       = $staff_name;
            $staff2->inp_m_staff_kana       = $staff_kana;
            $staff2->inp_m_staff_login_id   = $staff_login_id;
            $staff2->inp_m_staff_auth       = $staff_auth;
            $staff2->inp_m_staff_kbn        = $staff_koyo;
            $staff2->inp_m_staff_genba_id   = $genba_id;
            if ($staff_pass != "") {
                $staff2->inp_m_staff_pass        = md5(md5("ITC".$staff_pass)."ITC");
            }
            $staff2->inp_m_staff_modified    = date('Y-m-d H:i:s');
            $staff2->inp_m_staff_modified_id = $_SESSION["staff_id"];
            $staff2->inp_m_staff_id2         = $staff_id2;

            // データ更新
            $staff2->updateStaff();
        }

        header("Location:staff1.php#".$staff_id);
    }
    if ($act == "2") {

            $staff2->inp_m_staff_id          = $staff_id;

            // データ削除
            $staff2->deleteStaff();

            header('Location:staff1.php');
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/staff2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/staff2_html.php');
    }
?>
