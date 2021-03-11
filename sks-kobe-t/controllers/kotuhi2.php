<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../models/common/common.php');          // 共通クラス
    require_once('../models/common/db.php');              // DBクラス
    require_once('../models/Kotuhi.php');                 // 交通費クラス
    require_once('../models/Staff.php');                  // 社員クラス
    require_once('../models/Genba.php');                  // 現場クラス

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    if (isset($_REQUEST["act"])) {
    if (isset($_REQUEST["kotuhi_no2"])) {
        $kotuhi_no2 = $_REQUEST["kotuhi_no2"];
    }
        $act       = $_REQUEST["act"];
        $kotuhi_no = $_REQUEST["kotuhi_no"];
        $staff_id     = $_REQUEST["staff_id"];
        $place     = $_REQUEST["place"];
        $hosoku     = $_REQUEST["hosoku"];
        //$from      = $_REQUEST["from"];
        //$to        = $_REQUEST["to"];
        $kikan     = $_REQUEST["kikan"];
        $cost      = $_REQUEST["cost"];
        $startday      = $_REQUEST["startday"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $kotuhi     = new Kotuhi;       // 交通費マスタクラス
    $kotuhi2    = new Kotuhi;       // 交通費マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $staff2      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス
    
    // 社員マスタ 取得 に必要な情報をセット
    $staff2->inp_m_staff_del_flg = 0;
    // 社員マスタ 取得
    $staff2->getStaff();
    
    // 現場マスタ 取得 に必要な情報をセット
    $genba->inp_m_genba_del_flg = 0;
    // 現場マスタ 取得
    $genba->getGenba();

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    if ($act == "") {
        if (isset($_REQUEST["no"])) {
        $kotuhi_no = $_REQUEST["no"];
            // 交通費マスタ 取得
            $kotuhi->inp_m_kotuhi_no = $_REQUEST["no"];
            $kotuhi->getKotuhi();
            if ($common->uae == 1) {
                $kotuhi->oup_m_kotuhi_startday[0] = str_replace(array('-', 'ー', '−', '―', '‐'), '', $kotuhi->oup_m_kotuhi_startday[0]);
            }
            if ($kotuhi->oup_m_kotuhi_startday[0] < 1) {
                $kotuhi->oup_m_kotuhi_startday[0] = "";
            }
        }
    }

    // 取引先詳細画面で「登録」ボタンが押された場合
    if ($act == "1") {
    $staff = explode(' ', $staff_id);
    $genba = explode(' ', $place);

            //if ($kotuhi_no == "") {
            //
            //    $kotuhi2->inp_m_kotuhi_staff_id = $_SESSION["staff_id"];
            //    $kotuhi2->inp_m_kotuhi_no     = $kotuhi_no;
            //    $kotuhi2->inp_m_kotuhi_place  = $place;
            //    $kotuhi2->inp_m_kotuhi_kikan  = $kikan;
            //    $kotuhi2->inp_m_kotuhi_from   = $from;
            //    $kotuhi2->inp_m_kotuhi_to     = $to;
            //    $kotuhi2->inp_m_kotuhi_cost   = $cost;
            //    $kotuhi2->inp_m_kotuhi_created    = date('Y-m-d H:i:s');
            //    $kotuhi2->inp_m_kotuhi_created_id = $_SESSION["staff_id"];
            //
            //    // データ登録
            //    $kotuhi2->insertKotuhi();
            //
            //} else {

                $kotuhi2->inp_m_kotuhi_no     = $kotuhi_no;
                $kotuhi2->inp_m_kotuhi_staff_id  = $staff[0];
                $kotuhi2->inp_m_kotuhi_staff_name  = $staff[1];
                $kotuhi2->inp_m_kotuhi_place_id  = $genba[0];
                $kotuhi2->inp_m_kotuhi_place  = $genba[1];
                $kotuhi2->inp_m_kotuhi_hosoku  = $hosoku;
                //$kotuhi2->inp_m_kotuhi_from   = $from;
                //$kotuhi2->inp_m_kotuhi_to     = $to;
                $kotuhi2->inp_m_kotuhi_cost   = $cost;
                $kotuhi2->inp_m_kotuhi_kikan  = $kikan;
                $kotuhi2->inp_m_kotuhi_startday  = $startday;
                $kotuhi2->inp_m_kotuhi_modified    = date('Y-m-d H:i:s');
                $kotuhi2->inp_m_kotuhi_modified_id = $_SESSION["staff_id"];

                // データ更新
                $kotuhi2->updateKotuhi();
            //}

            //header('Location:kotuhi1.php');
            //header("Location:kotuhi1.php#".$staff[0].",".$genba[0]);
            header("Location:kotuhi1.php#".$kotuhi_no);

    }
    if ($act == "2") {
    //var_dump($_REQUEST);
    //exit;

                $kotuhi2->inp_m_kotuhi_no     = $kotuhi_no;

                // データ削除
                $kotuhi2->deleteKotuhi();

            //header('Location:kotuhi1.php');
            if (isset($kotuhi_no2)) {
                header("Location:kotuhi1.php#".$kotuhi_no2);
            } else {
                header("Location:kotuhi1.php");
            }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/kotuhi2_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/kotuhi2_html.php');
    }
?>
