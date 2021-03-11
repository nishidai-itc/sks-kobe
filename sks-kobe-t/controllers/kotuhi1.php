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
    
    //if (isset($_REQUEST["dispctl"])) {
    //    $dispctl = $_REQUEST["dispctl"];
    //}
    //if (isset($_REQUEST["inp_userfile"])) {
    //    $inp_userfile = $_REQUEST["inp_userfile"];
    //}

    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $kotuhi     = new Kotuhi;       // 交通費マスタクラス
    $kotuhi2     = new Kotuhi;       // 交通費マスタクラス
    $kotuhi3     = new Kotuhi;       // 交通費マスタクラス
    $staff      = new Staff;        // 社員マスタクラス
    $staff2      = new Staff;        // 社員マスタクラス
    $genba      = new Genba;        // 現場マスタクラス

    function _mime_content_type($filename) {
        $result = new finfo();
    if (is_resource($result) === true) {
        return $result->file($filename, FILEINFO_MIME_TYPE);
    }
        return false;
    }

    //アップデート処理実行ボタン
    if (isset($_REQUEST["modify"])) {
            if (is_uploaded_file($_FILES["inp_userfile"]["tmp_name"])) {
            //var_dump(mb_detect_order($_FILES["inp_userfile"]["tmp_name"]));
            //exit;
                //CSVファイル以外は実行しない
                if ($_FILES["inp_userfile"]["type"] != "application/vnd.ms-excel") {
                    $alert = "<script type='text/javascript'>alert('CSVファイルでアップロードしてください。');</script>";
                    echo $alert;
                } else {
                
                    $kotuhi3->getKotuhi();
                    if ($kotuhi3->oup_m_kotuhi_no) {
                    // if (count($kotuhi3->oup_m_kotuhi_no) > 0) {
                    //データ全削除
                    $kotuhi3->deleteKotuhi2();
                    }
                    
            //    if ($_FILES['inp_userfile']['type'] !== 'text/csv') {
            //        $alert = "<script type='text/javascript'>alert('CSVファイルをアップロードしてください。');</script>";
            //        echo $alert;
            //    } else {
                    //タイムアウトを回避
                    set_time_limit ( 180 );
                    //$data = $_FILES["inp_userfile"]["tmp_name"];
                    $data = file_get_contents($_FILES["inp_userfile"]["tmp_name"]);
                    if (mb_detect_encoding($data) != "UTF-8") {
                        $date = mb_convert_variables("UTF-8", "SJIS", $data);
                    }
                    //$date = mb_convert_encoding($data,"UTF-8", "SJIS");
                    $temp = tmpfile();
                    
                    fwrite($temp, $data);
                    rewind($temp);
                    //$temp = fopen( $data, "r" );
                    
                    $i=1;
                    while (($arline = fgetcsv($temp, 0, ",")) !== FALSE) {
                        //if ($i==1) {
                        //    $i++;
                        //    continue;
                        //}
                        //金額があるものだけ取り込む
                        if ($arline[5] == 0 || is_null($arline[5])) {
                            $i++;
                            continue;
                        }
                        //for ($j=0;$j<count($arline);$j++) {
                        $kotuhi2->inp_m_kotuhi_staff_id = $arline[0];
                        //$staff2->inp_m_staff_id = $arline[0];
                        //$staff2->getstaff();
                        //$kotuhi2->inp_m_kotuhi_staff_name = $staff2->oup_m_staff_name[0];
                        $kotuhi2->inp_m_kotuhi_staff_name = $arline[1];
                        $kotuhi2->inp_m_kotuhi_place_id = $arline[2];
                        $kotuhi2->inp_m_kotuhi_place = $arline[3];
                        $kotuhi2->inp_m_kotuhi_hosoku = $arline[4];
                        $kotuhi2->inp_m_kotuhi_cost = $arline[5];
                        $kotuhi2->inp_m_kotuhi_kikan = $arline[6];
                        //if (strlen($arline[6]) != 8) {
                        //    if ($msgcnt == "") {
                        //        $msgcnt = $i;
                        //    } else {
                        //        $msgcnt = $msgcnt."、".$i;
                        //    }
                        //    //$msg = $i."行目適用開始日は8桁で入力してください。<br>";
                        //    $i++;
                        //    continue;
                        //}
                        $kotuhi2->inp_m_kotuhi_startday = $arline[7];
                        $kotuhi2->inp_m_kotuhi_created = date("Y:m:d H:i:s");
                        $kotuhi2->inp_m_kotuhi_created_id = $_SESSION["staff_id"];
                        $kotuhi2->insertKotuhi();
                        $i++;
                        //var_dump($arline);
                        //}
                    }
                    //if ($msgcnt != "") {
                    //    $msg = $msgcnt."行目適用開始日は8桁で入力してください。<br>";
                    //    $msgcnt = "";
                    //}
                    fclose( $temp );
                    //$contents = file($_FILES["inp_userfile"]);
                    $alert = "<script type='text/javascript'>location.href = 'kotuhi1.php'; alert('登録が完了しました。');</script>";
                    echo $alert;
                    //header('Location:../controllers/kotuhi1.php');
                }
            //    }
            } else {
                //print("NG");
                $alert = "<script type='text/javascript'>alert('ファイルのアップロードに失敗しました。ファイルが存在するか確認してください。');</script>";
                echo $alert;
            }
    }
    
    // 交通費マスタ 取得 に必要な情報をセット
    //$kotuhi->inp_m_kotuhi_staff_id = $_SESSION["staff_id"];

    // 交通費マスタ 取得
    $kotuhi->inp_join_m_staff = 1;
    $kotuhi->inp_join_m_genba = 1;
    //$kotuhi->inp_order = "order by m_staff.m_staff_kana,m_kotuhi.m_kotuhi_startday,m_kotuhi.m_kotuhi_cost ";
    $kotuhi->inp_order = "order by m_kotuhi_staff_id,m_genba_hyoji_kbn,m_kotuhi_cost ";
    $kotuhi->getKotuhi();
    
    // 社員マスタ 取得
    $staff2->getStaff();
    // 社員マスタ 取得
    $genba->getGenba();
    
    //for ($i=0;$i<count($kotuhi->oup_m_kotuhi_no);$i++) {
    //    if ($kotuhi->oup_m_kotuhi_startday[$i] < 1) {
    //        $kotuhi->oup_m_kotuhi_startday[$i] = "";
    //    }
    //    $staff_name[$staff2->oup_m_staff_id[$i]] = $staff2->oup_m_staff_name[$i];
    //    $genba_name[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    //}
    
    if ($kotuhi->oup_m_kotuhi_no) {
    for ($i=0;$i<count($kotuhi->oup_m_kotuhi_no);$i++) {
        if ($kotuhi->oup_m_kotuhi_startday[$i] == 0) {
            $kotuhi->oup_m_kotuhi_startday[$i] = "";
        }
    }
    }
    //隊員マスタから名前を取得
    for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) {
        $staff_name[$staff2->oup_m_staff_id[$i]] = $staff2->oup_m_staff_name[$i];
    }
    //現場マスタから現場名を取得
    for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
        $genba_name[$genba->oup_m_genba_id[$i]] = $genba->oup_m_genba_name[$i];
    }

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
        require_once('../views/kotuhi1_html.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../views/m/kotuhi1_html.php');
    }
?>
