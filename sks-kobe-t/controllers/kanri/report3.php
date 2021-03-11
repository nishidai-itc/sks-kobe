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

    function funcstr($substr) {
        if ($substr != "") {
            $val = substr($substr,0,2);
        } else {
            $val = "";
        }
        return $val;
    }
    function funcstr2($substr) {
        if ($substr != "") {
            $val = substr($substr,3,2);
        } else {
            $val = "";
        }
        return $val;
    }
    
    $act            = NULL;
    $weather        = null;
    $weathers       = array(
        "1"=>"晴",
        "2"=>"曇",
        "3"=>"雨",
        "4"=>"雪"
    );
    $staff_id       = null;
    $date           = date("Y-m-d");
    $date2          = date("Y-m-d",strtotime($date." +1 day"));
    $dates          = explode("-",$date);
    $dates2         = explode("-",$date2);
    // $joban_time     = array(
    //     "08",
    //     "00"
    // );
    // $kaban_time     = array(
    //     "08",
    //     "00"
    // );
    $haiti = array(
        "背後地",
        "前面"
    );
    $con1 = array(
        array(
            "title"=>"開錠",
            "row"=>3,
            "rowTitle"=>array(
                "外周",
                "200倉庫",
                "300倉庫"
            ),
            "defaultTime"=>array(
                "06:30",
                "06:30",
                "06:00"
            ),
        ),
        array(
            "title"=>"午前巡回",
            "row"=>2,
            "rowTitle"=>array(
                "200倉庫1階",
                "200倉庫4階"
            )
        ),
        array(
            "title"=>"午後巡回",
            "row"=>6,
            "rowTitle"=>array(
                "300倉庫北事務所",
                "300倉庫車路",
                "300倉庫2階",
                "300倉庫3階",
                "300倉庫4階",
                "300倉庫南事務所"
            )
        ),
        array(
            "title"=>"退出確認",
            "row"=>7,
            "rowTitle"=>array(
                "住友倉庫",
                "神港作業",
                "樽喜梱包",
                "全日検",
                "",
                "",
                ""
            ),
            "defaultTime"=>array(
                "",
                "20:00",
                "19:00",
                "17:00",
                "",
                "",
                ""
            ),
        ),
        array(
            "title"=>"施錠",
            "row"=>3,
            "rowTitle"=>array(
                "200倉庫",
                "300倉庫",
                "外周"
            ),
            "defaultTime"=>array(
                "19:30",
                "22:00",
                "22:00"
            ),
        )
    );

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($date));
    $time2 = strtotime(date($date2));
    $w = date("w", $time);
    $w2 = date("w", $time2);

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;         // 共通クラス
    $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
    $staff      = new Staff;          // 社員マスタクラス
    $staff2      = new Staff;
    
    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    $staff2->getStaff();

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report3_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report3_html.php');
    }
?>
