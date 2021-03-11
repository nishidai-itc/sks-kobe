<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../models/common/common.php');        // 共通クラス
    require_once('../models/common/db.php');            // DBクラス
    require_once('../models/Serviceq.php');             // サービス実施問題クラス
    require_once('../models/Servicea.php');             // サービス実施記録クラス
    require_once('../models/Work.php');                 // 作業開始クラス
    require_once('../models/Staff.php');                // 社員クラス
    require_once('../models/User.php');                 // 利用者クラス
    require_once('../models/Company.php');              // 会社クラス

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $serviceq   = new Serviceq;     // サービス実施問題クラス
    $servicea   = new Servicea;     // サービス実施記録クラス
    $work       = new Work;         // 作業実施テーブルクラス
    $work2      = new Work;         // 作業実施テーブルクラス
    $staff      = new Staff;        // 社員マスタクラス
    $user       = new User;         // 利用者クラス
    $company    = new Company;      // 会社マスタクラス

    // 会社マスタの取得
    $company->getCompany();

    if ( $_SESSION["work_no"] == "" ) {
        // HTML表示
        header('Location:../controllers/menu.php');
    }

    if (isset($_POST["act"])) {
        $act            = $common->html_decode($_POST["act"]);
    }

    // 作業実施テーブル 取得 に必要な情報をセット
    $work->inp_t_work_no    = $_SESSION["work_no"];

    // 作業実施テーブル 取得
    $work->getWork();

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($work->oup_t_work_plan_start_date[0]));
    $w = date("w", $time);
    $weekday = $week[$w];

    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 利用者 取得 に 必要な情報をセット
    $user->inp_m_user_id = $work->oup_t_work_user_id[0];

    // 利用者 取得
    $user->getUser();


    // サービス実施問題取得
    $serviceq->getServiceq();

    // サービス実施記録 取得 に必要な情報をセット
    if ( $_GET["work_no"] == "" ) {
        $servicea->inp_m_servicea_work_no    = $_SESSION["work_no"];
    } else {
        $servicea->inp_m_servicea_work_no    = $_GET["work_no"];
    }

    // サービス実施記録 取得
    $servicea->getServicea();

    for ($i=0;$i<count($servicea->oup_m_servicea_tcode);$i++) {
        for($j=1;$j<=10;$j++) {
            $servicea_a='oup_m_servicea_a'.$j.'chk';
            $servicea_a2='oup_m_servicea_a'.$j.'content';
            $answer[$servicea->oup_m_servicea_tcode[$i]][$servicea->oup_m_servicea_qcode[$i]][$j][chk] = $servicea->{$servicea_a}[$i];
            $answer[$servicea->oup_m_servicea_tcode[$i]][$servicea->oup_m_servicea_qcode[$i]][$j][content] = $servicea->{$servicea_a2}[$i];
//print($servicea->{$servicea_a}[$i]);
//print($servicea->{'oup_m_servicea_a'.$j.'chk'}[$i]);
//print("<br />");
        }
    }
    switch ($act) {
        // 画面上の決定ボタンが押された場合
        case 1:
        case "送信します":

            if ( $_SESSION["work_no"] != "" ) {
                $work2->inp_t_work_no               = $_SESSION["work_no"];
                $work2->inp_t_work_run_start_time   = substr($_POST['run_start_time'],0,2).substr($_POST['run_start_time'],3,2);
                $work2->inp_t_work_run_end_time     = substr($_POST['run_end_time'],0,2).substr($_POST['run_end_time'],3,2);
                $work2->updateWork();

                $servicea   = new Servicea;     // サービス実施記録クラス

                $servicea->inp_m_servicea_work_no   = $_SESSION["work_no"];
                $servicea->deleteServicea();

                for($i=0;$i<count($serviceq->oup_m_serviceq_tcode);$i++) {

                    $servicea   = new Servicea;     // サービス実施記録クラス

                    $servicea->inp_m_servicea_work_no   = $_SESSION["work_no"];
                    $servicea->inp_m_servicea_tcode     = $serviceq->oup_m_serviceq_tcode[$i];
                    $servicea->inp_m_servicea_qcode     = $serviceq->oup_m_serviceq_qcode[$i];

                    $m_serviceq='m_serviceq_'.$serviceq->oup_m_serviceq_tcode[$i].'_'.$serviceq->oup_m_serviceq_qcode[$i];
                    $m_serviceqt='m_serviceqt_'.$serviceq->oup_m_serviceq_tcode[$i].'_'.$serviceq->oup_m_serviceq_qcode[$i];
                    if (isset($_POST[$m_serviceq])) {
                        foreach ($_POST[$m_serviceq] as $key => $value) {

                            $servicea->{'inp_m_servicea_a'.$value.'chk'}     = "1";
                        }
                    }
                    if (isset($_POST[$m_serviceqt])) {
                        foreach ($_POST[$m_serviceqt] as $key => $value) {
                            $servicea->{'inp_m_servicea_a'.$key.'content'}  = $value;
                        }
                    }
                    // データ登録
                    $servicea->insertServicea();
                }
            }

            // メニュー画面に遷移する
            if ($common->judgephone) {
                if($company->oup_m_company_kiroku_kbn[0] == "1") {
                    // HTML表示
                    header('Location:../controllers/menu.php');
                } else {
                    // HTML表示
                    header('Location:../controllers/menu.php');
                }
            } else {
                if($company->oup_m_company_kiroku_kbn[0] == "1") {
                    // HTML表示
                    header("Location:../controllers/menu.php?".SID);
                } else {
                    // HTML表示
                    header("Location:../controllers/menu.php?".SID);
                }
            }

            break;
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../views/servicekiroku_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/servicekiroku_html.php');
    }
?>
