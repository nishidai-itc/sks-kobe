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
    require_once('../../models/Genba.php');
    require_once('../../models/ReportTable.php');
    require_once('../../models/Report.php');
    
    $act                                    = NULL;
    $no                                     = NULL;
    $table                                  = 1;
    $weather1                               = null;
    $weather2                               = null;
    $weathers                               = array("晴","曇","雨","雪");
    $staff_id                               = null;
    $start_date                             = date("Y-m-d");
    $end_date                               = date("Y-m-d",strtotime($date." +1 day"));
    $joban_time                             = array("08","00");
    $kaban_time                             = array("08","00");
    for ($i=1;$i<=9;$i++) {
        ${"wk_ship".$i}                     = null;
        ${"wk_ship_in_port_time".$i}        = array(null,null);
        ${"wk_ship_out_port_time".$i}       = array(null,null);
    }
    $wk_in_out_start_time                   = array(null,null);
    $wk_in_out_end_time                     = array(null,null);
    $wk_joban_time                          = array(null,null);
    $wk_kaban_time                          = array(null,null);
    $wk_vp_end_time                         = array(null,null);
    $wk_vp_kaban_time                       = array(null,null);
    $koyo_joban_time                        = array(null,null);
    $koyo_kaban_time                        = array(null,null);
    $sumii_joban_time                       = array(null,null);
    $sumii_kaban_time                       = array(null,null);
    $last_exit                              = null;
    $yard_on_time1                          = array(null,null);
    $yard_off_time1                         = array(null,null);
    $yard_on_time2                          = array(null,null);
    $yard_off_time2                         = array(null,null);

    $array                                  = array(
        array(array("07","00"),array("08","00"),"2","1"),
        array(array("07","30"),array("08","00"),"2","0.5"),
        array(array("17","00"),array(null,null),null,null),
        array(array("17","00"),array("18","00"),"1","1.25"),
        array(array("17","00"),array("17","30"),"2","0.75"),
        array(array("12","00"),array("13","00"),"8","1"),
        array(array("17","00"),array("18","00"),"1","1.25"),
        array(array("17","00"),array(null,null),null,null),
        // 予備
        array(array(null,null),array(null,null),null,null),
        array(array(null,null),array(null,null),null,null),
        array(array(null,null),array(null,null),null,null),
        array(array(null,null),array(null,null),null,null)
    );
    $tokki = array(
        array(
            "title"=>"・共同デポ",
            "name"=>array("depo_joban_time","depo_kaban_time","depo_num","depo_zan")
        ),
        array(
            "title"=>"・PC15.16.17　並び",
            "name"=>array("sort_joban_time","sort_kaban_time","sort_num","sort_zan")
        ),
        array(
            "title"=>"・PC15.16.17　CY",
            "name"=>array("cy_joban_time","cy_kaban_time","cy_num","cy_zan")
        ),
        array(
            "title"=>"・専用道白出口",
            "name"=>array("exit_joban_time","exit_kaban_time","exit_num","exit_zan")
        ),
        array(
            "title"=>"・VP作業",
            "name"=>array("vp_joban_time","vp_kaban_time","vp_num","vp_zan")
        ),
        array(
            "title"=>"・昼作業",
            "name"=>array("midday_joban_time","midday_kaban_time","midday_num","midday_zan")
        ),
        array(
            "title"=>"・ゲート延長",
            "name"=>array("gate_joban_time","gate_kaban_time","gate_num","gate_zan")
        ),
        array(
            "title"=>"・Mバース",
            "name"=>array("mbath_joban_time","mbath_kaban_time","mbath_num","mbath_zan")
        ),
        // 予備
        array(
            "title"=>"・T字立哨",
            "name"=>array("picket_joban_time1","picket_kaban_time1","picket_num1","picket_zan1")
        ),
        array(
            "title"=>"・空前立哨",
            "name"=>array("picket_joban_time2","picket_kaban_time2","picket_num2","picket_zan2")
        ),
        array(
            "title"=>"・岸壁立哨",
            "name"=>array("picket_joban_time3","picket_kaban_time3","picket_num3","picket_zan3")
        ),
        array(
            "title"=>"・分別立哨",
            "name"=>array("picket_joban_time4","picket_kaban_time4","picket_num4","picket_zan4")
        )
    );
    for ($i=0;$i<count($tokki);$i++) {
        for ($j=0;$j<4;$j++) {
            ${$tokki[$i]["name"][$j]}           = $array[$i][$j];
        }
    }

    $comment = "巡回点検異常ありません";
    $title                            = array("1"=>"➀","2"=>"➁","3"=>"➂","4"=>"➃","5"=>"➄","6"=>"➅","7"=>"➆","8"=>"➇");
    $times                            = array("1"=>array("19","00"),"2"=>array("21","00"),"3"=>array("23","00"),"4"=>array("01","00"),"5"=>array("03","00"),"6"=>array("05","00"),"7"=>array(null,null),"8"=>array(null,null));
    for ($i=1;$i<=8;$i++) {
        ${"patrol_time".$i}           = array($times[$i][0],$times[$i][1]);
    }
    $meterb1                          = null;
    $meterb2                          = null;
    $meterc1                          = null;
    $meterc2                          = null;
    for ($i=1;$i<=15;$i++) {
        ${"wk_staff_id".$i}           = null;
    }
    $wk_comment                       = null;

    $kbnMark                          = array("1"=>"◎","2"=>"〇","3"=>"－");

    // $week = array("日", "月", "火", "水", "木", "金", "土");
    // $time = strtotime(date($date));
    // $w = date("w", $time);
    function getWeek($day) {
        $week = array("日", "月", "火", "水", "木", "金", "土");
        if ($day) {
            return $week[date("w", strtotime(date($day)))];
        } else {
            return null;
        }
    }

    if (isset($_POST["act"])) {
        $act        = $_POST["act"];
    }
    if (isset($_REQUEST["no"])) {
        $no        = $_REQUEST["no"];
    }

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common         = new Common;         // 共通クラス
    $wkdetail       = new Wkdetail;       // 作業実施テーブルクラス
    $staff          = new Staff;          // 社員マスタクラス
    $staff2         = new Staff;
    $genba          = new Genba;
    $report         = new Report;
    $report2        = new Report;
    
    // 社員マスタ 取得 に必要な情報をセット
    $staff->inp_m_staff_id = $_SESSION["staff_id"];

    // 社員マスタ 取得
    $staff->getStaff();

    // 当日予定のある隊員取得
    $wkdetail->inp_t_wk_genba_id = "6";
    $wkdetail->inp_t_wk_plan_kbn_in = "'1','2','3'";
    $wkdetail->inp_t_wk_plan_date = str_replace("-","",$start_date);
    $wkdetail->inp_order = "order by t_wk_plan_joban_time";
    $wkdetail->getWkdetail();

    // 隊員取得
    if ($wkdetail->oup_t_wk_detail_no) {
        $cnt = 0;
        for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) {
            if ($i == 0) {
                $staff2->inp_m_staff_id_in = "'".$wkdetail->oup_t_wk_taiin_id[$i]."'";
            } else {
                $staff2->inp_m_staff_id_in = $staff2->inp_m_staff_id_in.",'".$wkdetail->oup_t_wk_taiin_id[$i]."'";
            }

            // 勤務区分
            $staff_kbn[$wkdetail->oup_t_wk_taiin_id[$i]] = $wkdetail->oup_t_wk_plan_kbn[$i];
        }
        
        $staff2->getStaff();

        for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) {
            $staff_name[$staff2->oup_m_staff_id[$i]] = $staff2->oup_m_staff_name[$i];

            // 勤務員の項目の隊員デフォルト表示
            if ($cnt != 15) {
                $cnt = $cnt + 1;
                ${"wk_staff_id".$cnt}         = ${"wk_staff_id".$cnt} ? ${"wk_staff_id".$cnt} : $staff2->oup_m_staff_id[$i];
            }
        }
    }

?>
<?php
    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('../../views/kanri/report1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/kanri/m/report1_html.php');
    }
?>
