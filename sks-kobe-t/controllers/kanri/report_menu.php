<?php
    session_start();
    
    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:../controllers/login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Wkdetail.php');               // 作業開始クラス
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/ReportTable.php');
    require_once('../../models/Report.php');

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;         // 共通クラス
    $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
    $staff      = new Staff;          // 社員マスタクラス
    $report2      = new Report;

    $act            = NULL;
    // $no             = null;
    $plan_date      = date("Y-m-d");

    // 名称取得
    $report2->getReport("name");
    for ($i=0;$i<count($report2->oup_no);$i++) {
        $report_place[$report2->oup_no[$i]]             = $report2->oup_place[$i];
        $report_contract[$report2->oup_no[$i]]          = $report2->oup_contract[$i];
    }
    
    /*
    $place = array(
        "PI・C-15.16.17　KICT",
        "KFC",
        "L-6",
        "",
        "RIC-4・C-5",
        "RIC-5・CFS",
        "",
        "RIC-4・C-5に係る待機場A",
        "RIC-4・C-5に係る待機場B",
        "",
        "日本郵船神戸コンテナターミナル",
        "日本郵船神戸コンテナターミナル",
        "日本郵船神戸バンプール",
        "日本郵船神戸コンテナターミナル"
    );
    $company = array(
        "商船港運株式会社",
        "商船港運株式会社",
        "株式会社住友倉庫",
        "",
        "三菱倉庫株式会社",
        "三菱倉庫株式会社",
        "神菱港運株式会社",
        "三菱倉庫株式会社・川崎汽船株式会社",
        "三菱倉庫株式会社・川崎汽船株式会社",
        "阪神国際港湾株式会社",
        "日本郵船株式会社",
        "日本郵船株式会社",
        "日本郵船株式会社",
        "日本郵船株式会社"
    );
    */

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }
    
    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    $data = array();
    for ($i=0;$i<14;$i++) {
        $data[$i]["no"]             = null;
        $data[$i]["table"]          = $i+1;
        $data[$i]["kbn"]            = null;
        $data[$i]["place"]          = $report_place[$i+1];
        $data[$i]["contract"]       = $report_contract[$i+1];
        if ($i == 3) {
            continue;
        }

        if ($i == 10 || $i == 12 || $i == 13) {
            $report                 = new Report;
            // $report->inp_table      = $i+1;
            // $report->inp_plan_date  = $plan_date;
            $report->inp_no         = str_replace("-","",$plan_date).($i+1);
            $report->getReport("kanri");
            if ($report->oup_no) {
                // $data[$i]["no"]          = $report->oup_table_no[0];
                $data[$i]["no"]          = $report->oup_no[0];
                $data[$i]["kbn"]         = $report->oup_kbn[0];
            }
        }
    }

    // var_dump($data);

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report_menu_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report_menu_html.php');
    }
?>
