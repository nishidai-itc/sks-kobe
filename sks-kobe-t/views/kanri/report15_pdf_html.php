<?php 
    ob_end_clean();

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($report->oup_start_date[0]));
    $w = date("w", $time);
    $weekday1 = $week[$w];

    $time = strtotime(date($report->oup_end_date[0]));
    $w = date("w", $time);
    $weekday2 = $week[$w];

    $kbn[1] = "有";
    $kbn[2] = "無";

require_once('../../tcpdf/tcpdf.php');
require_once('../../fpdf/src/autoload.php');

use setasign\Fpdi\TcpdfFpdi;

$pdf = new TcpdfFpdi();
$pdf->SetMargins(0, 0, 0);
$pdf->SetCellPadding(0);
$pdf->SetAutoPageBreak(false);
$pdf->setPrintHeader(false);    
$pdf->setPrintFooter(false);
$pdf->SetFont('kozminproregular', '', 9);// 日本語フォント

// テンプレート読み込み
$pdf->setSourceFile($common->rootpath.'/pdf/report15.pdf');

// 用紙サイズ
$pdf->AddPage('L', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$y = 14;
$pdf->Text(24, $y, $wnen);     // 年
$pdf->Text(40, $y, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(53, $y, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(67, $y, "(".$weekday1.")");     // 曜日

$pdf->SetFont('kozminproregular', '', 8);// 日本語フォント

$y = 20;
$pdf->Text(89, $y, $staffs[$report->oup_patrol_staff_id1[0]]);      // 巡回者氏名1
$pdf->Text(109, $y, $staffs[$report->oup_patrol_staff_id2[0]]);     // 巡回者氏名2
$pdf->Text(129, $y, $staffs[$report->oup_patrol_staff_id3[0]]);     // 巡回者氏名3
$pdf->Text(149, $y, $staffs[$report->oup_patrol_staff_id4[0]]);     // 巡回者氏名4
$pdf->Text(169, $y, $staffs[$report->oup_patrol_staff_id5[0]]);     // 巡回者氏名5
$pdf->Text(187, $y, $staffs[$report->oup_patrol_staff_id6[0]]);     // 巡回者氏名6
$pdf->Text(205, $y, $staffs[$report->oup_patrol_staff_id7[0]]);     // 巡回者氏名7
$pdf->Text(223, $y, $staffs[$report->oup_patrol_staff_id8[0]]);     // 巡回者氏名8
$pdf->Text(242, $y, $staffs[$report->oup_patrol_staff_id9[0]]);     // 巡回者氏名9
$pdf->Text(260, $y, $staffs[$report->oup_patrol_staff_id10[0]]);    // 巡回者氏名10

$y = 25;
$pdf->Text(89, $y, $staffs[$report->oup_patrol_staff_id_ken1[0]]);      // 巡回者氏名1
$pdf->Text(109, $y, $staffs[$report->oup_patrol_staff_id_ken2[0]]);     // 巡回者氏名2
$pdf->Text(129, $y, $staffs[$report->oup_patrol_staff_id_ken3[0]]);     // 巡回者氏名3
$pdf->Text(149, $y, $staffs[$report->oup_patrol_staff_id_ken4[0]]);     // 巡回者氏名4
$pdf->Text(169, $y, $staffs[$report->oup_patrol_staff_id_ken5[0]]);     // 巡回者氏名5
$pdf->Text(187, $y, $staffs[$report->oup_patrol_staff_id_ken6[0]]);     // 巡回者氏名6
$pdf->Text(205, $y, $staffs[$report->oup_patrol_staff_id_ken7[0]]);     // 巡回者氏名7
$pdf->Text(223, $y, $staffs[$report->oup_patrol_staff_id_ken8[0]]);     // 巡回者氏名8
$pdf->Text(242, $y, $staffs[$report->oup_patrol_staff_id_ken9[0]]);     // 巡回者氏名9
$pdf->Text(260, $y, $staffs[$report->oup_patrol_staff_id_ken10[0]]);    // 巡回者氏名10

$pdf->SetFont('kozminproregular', '', 9);// 日本語フォント

$y = 30;
$pdf->Text(93, $y, $report->oup_patrol_time1[0]);      // 巡回時間1
$pdf->Text(113, $y, $report->oup_patrol_time2[0]);     // 巡回時間2
$pdf->Text(133, $y, $report->oup_patrol_time3[0]);     // 巡回時間3
$pdf->Text(153, $y, $report->oup_patrol_time4[0]);     // 巡回時間4
$pdf->Text(173, $y, $report->oup_patrol_time5[0]);     // 巡回時間5
$pdf->Text(191, $y, $report->oup_patrol_time6[0]);     // 巡回時間6
$pdf->Text(209, $y, $report->oup_patrol_time7[0]);     // 巡回時間7
$pdf->Text(227, $y, $report->oup_patrol_time8[0]);     // 巡回時間8
$pdf->Text(246, $y, $report->oup_patrol_time9[0]);     // 巡回時間9
$pdf->Text(264, $y, $report->oup_patrol_time10[0]);    // 巡回時間10

$y = 35;
$pdf->Text(94, $y, $kbn[$report->oup_sensor_select1[0]]);     // 巡回1
$pdf->Text(114, $y, $kbn[$report->oup_sensor_select2[0]]);     // 巡回2
$pdf->Text(134, $y, $kbn[$report->oup_sensor_select3[0]]);     // 巡回3
$pdf->Text(154, $y, $kbn[$report->oup_sensor_select4[0]]);     // 巡回4
$pdf->Text(175, $y, $kbn[$report->oup_sensor_select5[0]]);     // 巡回4
$pdf->Text(193, $y, $kbn[$report->oup_sensor_select6[0]]);     // 巡回4
$pdf->Text(211, $y, $kbn[$report->oup_sensor_select7[0]]);     // 巡回4
$pdf->Text(229, $y, $kbn[$report->oup_sensor_select8[0]]);     // 巡回4
$pdf->Text(248, $y, $kbn[$report->oup_sensor_select9[0]]);     // 巡回4
$pdf->Text(267, $y, $kbn[$report->oup_sensor_select10[0]]);     // 巡回4

$y = 40;
$pdf->Text(94, $y, $kbn[$report->oup_camera_select1[0]]);     // 巡回1
$pdf->Text(114, $y, $kbn[$report->oup_camera_select2[0]]);     // 巡回1
$pdf->Text(134, $y, $kbn[$report->oup_camera_select3[0]]);     // 巡回1
$pdf->Text(154, $y, $kbn[$report->oup_camera_select4[0]]);     // 巡回1
$pdf->Text(175, $y, $kbn[$report->oup_camera_select5[0]]);     // 巡回1
$pdf->Text(193, $y, $kbn[$report->oup_camera_select6[0]]);     // 巡回1
$pdf->Text(211, $y, $kbn[$report->oup_camera_select7[0]]);     // 巡回1
$pdf->Text(229, $y, $kbn[$report->oup_camera_select8[0]]);     // 巡回1
$pdf->Text(248, $y, $kbn[$report->oup_camera_select9[0]]);     // 巡回1
$pdf->Text(267, $y, $kbn[$report->oup_camera_select10[0]]);     // 巡回1

$pdf->SetFont('kozminproregular', '', 8);// 日本語フォント


$y = 53;
$pdf->Text(89, $y, $staffs[$report->oup_patrol_staff_id11[0]]);      // 巡回者氏名11
$pdf->Text(109, $y, $staffs[$report->oup_patrol_staff_id12[0]]);     // 巡回者氏名12
$pdf->Text(129, $y, $staffs[$report->oup_patrol_staff_id13[0]]);     // 巡回者氏名13
$pdf->Text(149, $y, $staffs[$report->oup_patrol_staff_id14[0]]);     // 巡回者氏名14
$pdf->Text(169, $y, $staffs[$report->oup_patrol_staff_id15[0]]);     // 巡回者氏名15
$pdf->Text(187, $y, $staffs[$report->oup_patrol_staff_id16[0]]);     // 巡回者氏名16
$pdf->Text(205, $y, $staffs[$report->oup_patrol_staff_id17[0]]);     // 巡回者氏名17
$pdf->Text(223, $y, $staffs[$report->oup_patrol_staff_id18[0]]);     // 巡回者氏名18
$pdf->Text(242, $y, $staffs[$report->oup_patrol_staff_id19[0]]);     // 巡回者氏名19
$pdf->Text(260, $y, $staffs[$report->oup_patrol_staff_id20[0]]);     // 巡回者氏名20

$y = 58;
$pdf->Text(89, $y, $staffs[$report->oup_patrol_staff_id_ken11[0]]);      // 巡回者氏名11
$pdf->Text(109, $y, $staffs[$report->oup_patrol_staff_id_ken12[0]]);     // 巡回者氏名12
$pdf->Text(129, $y, $staffs[$report->oup_patrol_staff_id_ken13[0]]);     // 巡回者氏名13
$pdf->Text(149, $y, $staffs[$report->oup_patrol_staff_id_ken14[0]]);     // 巡回者氏名14
$pdf->Text(169, $y, $staffs[$report->oup_patrol_staff_id_ken15[0]]);     // 巡回者氏名15
$pdf->Text(187, $y, $staffs[$report->oup_patrol_staff_id_ken16[0]]);     // 巡回者氏名16
$pdf->Text(205, $y, $staffs[$report->oup_patrol_staff_id_ken17[0]]);     // 巡回者氏名17
$pdf->Text(223, $y, $staffs[$report->oup_patrol_staff_id_ken18[0]]);     // 巡回者氏名18
$pdf->Text(242, $y, $staffs[$report->oup_patrol_staff_id_ken19[0]]);     // 巡回者氏名19
$pdf->Text(260, $y, $staffs[$report->oup_patrol_staff_id_ken20[0]]);     // 巡回者氏名20

$pdf->SetFont('kozminproregular', '', 9);// 日本語フォント

$y = 64;
$pdf->Text(93, $y, $report->oup_patrol_time11[0]);      // 巡回時間11
$pdf->Text(113, $y, $report->oup_patrol_time12[0]);     // 巡回時間12
$pdf->Text(133, $y, $report->oup_patrol_time13[0]);     // 巡回時間13
$pdf->Text(153, $y, $report->oup_patrol_time14[0]);     // 巡回時間14
$pdf->Text(173, $y, $report->oup_patrol_time15[0]);     // 巡回時間15
$pdf->Text(191, $y, $report->oup_patrol_time16[0]);     // 巡回時間16
$pdf->Text(209, $y, $report->oup_patrol_time17[0]);     // 巡回時間17
$pdf->Text(227, $y, $report->oup_patrol_time18[0]);     // 巡回時間18
$pdf->Text(246, $y, $report->oup_patrol_time19[0]);     // 巡回時間19
$pdf->Text(264, $y, $report->oup_patrol_time20[0]);     // 巡回時間20

$y = 69;
$pdf->Text(94, $y, $kbn[$report->oup_sensor_select11[0]]);     // 巡回1
$pdf->Text(114, $y, $kbn[$report->oup_sensor_select12[0]]);     // 巡回2
$pdf->Text(134, $y, $kbn[$report->oup_sensor_select13[0]]);     // 巡回3
$pdf->Text(154, $y, $kbn[$report->oup_sensor_select14[0]]);     // 巡回4
$pdf->Text(175, $y, $kbn[$report->oup_sensor_select15[0]]);     // 巡回4
$pdf->Text(193, $y, $kbn[$report->oup_sensor_select16[0]]);     // 巡回4
$pdf->Text(211, $y, $kbn[$report->oup_sensor_select17[0]]);     // 巡回4
$pdf->Text(229, $y, $kbn[$report->oup_sensor_select18[0]]);     // 巡回4
$pdf->Text(248, $y, $kbn[$report->oup_sensor_select19[0]]);     // 巡回4
$pdf->Text(267, $y, $kbn[$report->oup_sensor_select20[0]]);     // 巡回4

$y = 74;
$pdf->Text(94, $y, $kbn[$report->oup_camera_select11[0]]);     // 巡回1
$pdf->Text(114, $y, $kbn[$report->oup_camera_select12[0]]);     // 巡回1
$pdf->Text(134, $y, $kbn[$report->oup_camera_select13[0]]);     // 巡回1
$pdf->Text(154, $y, $kbn[$report->oup_camera_select14[0]]);     // 巡回1
$pdf->Text(175, $y, $kbn[$report->oup_camera_select15[0]]);     // 巡回1
$pdf->Text(193, $y, $kbn[$report->oup_camera_select16[0]]);     // 巡回1
$pdf->Text(211, $y, $kbn[$report->oup_camera_select17[0]]);     // 巡回1
$pdf->Text(229, $y, $kbn[$report->oup_camera_select18[0]]);     // 巡回1
$pdf->Text(248, $y, $kbn[$report->oup_camera_select19[0]]);     // 巡回1
$pdf->Text(267, $y, $kbn[$report->oup_camera_select20[0]]);     // 巡回1


$pdf->Text(114, 92, $staffs[$report->oup_dis_staff_id[0]]);     // 警備員4
$pdf->Text(114, 97, str_replace("-","/",$report->oup_dis_date[0]));     // 発見日時
$pdf->Text(114, 103, $report->oup_dis_place[0]);     // 発見場所
$pdf->MultiCell(50,30,$report->oup_dis_contents[0],0,'',0,1,114,109);        // 発見内容
$pdf->MultiCell(67,30,$report->oup_etc_contents[0],0,'',0,1,97,148);        // 発見内容

$pdf->MultiCell(70,10,$report->oup_wharf_contents1[0],0,'',0,1,205,93);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents2[0],0,'',0,1,205,104);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents3[0],0,'',0,1,205,116);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents4[0],0,'',0,1,205,128);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents5[0],0,'',0,1,205,139);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents6[0],0,'',0,1,205,150);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents7[0],0,'',0,1,205,162);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_comment[0],0,'',0,1,205,174);                // コメント

if ($_GET["act"] && $_GET["act"] == "mail") {
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/KICTチェックシート_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');

    echo json_encode("KICTチェックシート_".substr($report->oup_no[0],0,8)." ".date("H:i:s"));
    exit;
} else {
    $pdf->Output(sprintf("report2.pdf", time()), 'I');
}

?>
