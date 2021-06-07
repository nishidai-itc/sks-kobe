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
$pdf->Text(24, 29, $wnen);     // 年
$pdf->Text(40, 29, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(53, 29, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(67, 29, "(".$weekday1.")");     // 曜日

$pdf->SetFont('kozminproregular', '', 8);// 日本語フォント

$pdf->Text(89, 34, $staffs[$report->oup_patrol_staff_id1[0]]);     // 巡回者氏名
$pdf->Text(109, 34, $staffs[$report->oup_patrol_staff_id2[0]]);    // 巡回者氏名1
$pdf->Text(129, 34, $staffs[$report->oup_patrol_staff_id3[0]]);     // 巡回者氏名1
$pdf->Text(149, 34, $staffs[$report->oup_patrol_staff_id4[0]]);    // 警備員2
$pdf->Text(169, 34, $staffs[$report->oup_patrol_staff_id5[0]]);     // 警備員2
$pdf->Text(187, 34, $staffs[$report->oup_patrol_staff_id6[0]]);    // 警備員3
$pdf->Text(205, 34, $staffs[$report->oup_patrol_staff_id7[0]]);     // 警備員3
$pdf->Text(223, 34, $staffs[$report->oup_patrol_staff_id8[0]]);    // 警備員4
$pdf->Text(242, 34, $staffs[$report->oup_patrol_staff_id9[0]]);     // 警備員4
$pdf->Text(260, 34, $staffs[$report->oup_patrol_staff_id10[0]]);     // 警備員4

$pdf->SetFont('kozminproregular', '', 9);// 日本語フォント

$pdf->Text(93, 39, $report->oup_patrol_time1[0]);     // 巡回1
$pdf->Text(113, 39, $report->oup_patrol_time2[0]);     // 巡回2
$pdf->Text(133, 39, $report->oup_patrol_time3[0]);     // 巡回3
$pdf->Text(153, 39, $report->oup_patrol_time4[0]);     // 巡回4
$pdf->Text(173, 39, $report->oup_patrol_time5[0]);     // 巡回1
$pdf->Text(191, 39, $report->oup_patrol_time6[0]);     // 巡回2
$pdf->Text(209, 39, $report->oup_patrol_time7[0]);     // 巡回3
$pdf->Text(227, 39, $report->oup_patrol_time8[0]);     // 巡回4
$pdf->Text(246, 39, $report->oup_patrol_time9[0]);     // 巡回4
$pdf->Text(264, 39, $report->oup_patrol_time10[0]);     // 巡回4

$pdf->Text(94, 47, $kbn[$report->oup_sensor_select1[0]]);     // 巡回1
$pdf->Text(114, 47, $kbn[$report->oup_sensor_select2[0]]);     // 巡回2
$pdf->Text(134, 47, $kbn[$report->oup_sensor_select3[0]]);     // 巡回3
$pdf->Text(154, 47, $kbn[$report->oup_sensor_select4[0]]);     // 巡回4
$pdf->Text(175, 47, $kbn[$report->oup_sensor_select5[0]]);     // 巡回4
$pdf->Text(193, 47, $kbn[$report->oup_sensor_select6[0]]);     // 巡回4
$pdf->Text(211, 47, $kbn[$report->oup_sensor_select7[0]]);     // 巡回4
$pdf->Text(229, 47, $kbn[$report->oup_sensor_select8[0]]);     // 巡回4
$pdf->Text(248, 47, $kbn[$report->oup_sensor_select9[0]]);     // 巡回4
$pdf->Text(267, 47, $kbn[$report->oup_sensor_select10[0]]);     // 巡回4

$pdf->Text(94, 52, $kbn[$report->oup_camera_select1[0]]);     // 巡回1
$pdf->Text(114, 52, $kbn[$report->oup_camera_select2[0]]);     // 巡回1
$pdf->Text(134, 52, $kbn[$report->oup_camera_select3[0]]);     // 巡回1
$pdf->Text(154, 52, $kbn[$report->oup_camera_select4[0]]);     // 巡回1
$pdf->Text(175, 52, $kbn[$report->oup_camera_select5[0]]);     // 巡回1
$pdf->Text(193, 52, $kbn[$report->oup_camera_select6[0]]);     // 巡回1
$pdf->Text(211, 52, $kbn[$report->oup_camera_select7[0]]);     // 巡回1
$pdf->Text(229, 52, $kbn[$report->oup_camera_select8[0]]);     // 巡回1
$pdf->Text(248, 52, $kbn[$report->oup_camera_select9[0]]);     // 巡回1
$pdf->Text(267, 52, $kbn[$report->oup_camera_select10[0]]);     // 巡回1

$pdf->Text(114, 68, $staffs[$report->oup_dis_staff_id[0]]);     // 警備員4
$pdf->Text(114, 74, str_replace("-","/",$report->oup_dis_date[0]));     // 発見日時
$pdf->Text(114, 79, $report->oup_dis_place[0]);     // 発見場所
$pdf->MultiCell(50,30,$report->oup_dis_contents[0],0,'',0,1,114,85);        // 発見内容
$pdf->MultiCell(67,30,$report->oup_etc_contents[0],0,'',0,1,97,125);        // 発見内容

$pdf->MultiCell(70,10,$report->oup_wharf_contents1[0],0,'',0,1,205,69);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents2[0],0,'',0,1,205,80);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents3[0],0,'',0,1,205,92);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents4[0],0,'',0,1,205,104);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents5[0],0,'',0,1,205,115);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents6[0],0,'',0,1,205,127);        // 発見内容
$pdf->MultiCell(70,10,$report->oup_wharf_contents7[0],0,'',0,1,205,138);        // 発見内容

if ($_GET["act"] && $_GET["act"] == "mail") {
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/KICTチェックシート_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');

    echo json_encode("KICTチェックシート_".substr($report->oup_no[0],0,8)." ".date("H:i:s"));
    exit;
} else {
    $pdf->Output(sprintf("report2.pdf", time()), 'I');
}

?>
