<?php 
    ob_end_clean();

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($report->oup_start_date[0]));
    $w = date("w", $time);
    $weekday1 = $week[$w];

    $time = strtotime(date($report->oup_end_date[0]));
    $w = date("w", $time);
    $weekday2 = $week[$w];

require_once('../../tcpdf/tcpdf.php');
require_once('../../fpdf/src/autoload.php');

use setasign\Fpdi\TcpdfFpdi;

$pdf = new TcpdfFpdi();
$pdf->SetMargins(0, 0, 0);
$pdf->SetCellPadding(0);
$pdf->SetAutoPageBreak(false);
$pdf->setPrintHeader(false);    
$pdf->setPrintFooter(false);
$pdf->SetFont('kozminproregular', '', 12);// 日本語フォント

// テンプレート読み込み
$pdf->setSourceFile($common->rootpath.'/pdf/report6.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
$wnen = intval($wnen) - 2018;
$pdf->Text(34, 59, $wnen);     // 年
$pdf->Text(45, 59, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(57, 59, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(69, 59, $weekday1);     // 曜日
$pdf->Text(86, 59, substr($report->oup_joban_time[0],0,2));     // 開始時間
$pdf->Text(98, 59, substr($report->oup_joban_time[0],3,2));     // 開始時間

$wnen = substr($report->oup_end_date[0],0,4);
$wnen = intval($wnen) - 2018;
$pdf->Text(34, 65, $wnen);     // 年
$pdf->Text(45, 65, substr($report->oup_end_date[0],5,2));     // 月
$pdf->Text(57, 65, substr($report->oup_end_date[0],8,2));     // 日
$pdf->Text(69, 65, $weekday2);     // 曜日
$pdf->Text(86, 65, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(98, 65, substr($report->oup_kaban_time[0],3,2));     // 終了時間

$pdf->Text(114, 63, $report->oup_weather1[0]);     // 天候
$pdf->Text(121, 63, $report->oup_weather2[0]);     // 天候

$pdf->Text(132, 63, $staffs[$report->oup_staff_id[0]]);     // 担当警備員

$pdf->Text(121, 88, $report->oup_wk_start_time1[0]);    // C-5
$pdf->Text(161, 88, $report->oup_wk_end_time1[0]);      // C-5

$pdf->Text(121, 96, $report->oup_wk_start_time2[0]);    // C-5
$pdf->Text(161, 96, $report->oup_wk_end_time2[0]);      // C-5

$pdf->Text(121, 104, $report->oup_wk_start_time3[0]);    // C-5
$pdf->Text(161, 104, $report->oup_wk_end_time3[0]);      // C-5


$pdf->Text(150, 244, $staffs[$report->oup_wk_staff_id1[0]]);     // 警備員1
$pdf->Text(150, 255, $staffs[$report->oup_wk_staff_id2[0]]);     // 警備員2
$pdf->Text(150, 266, $staffs[$report->oup_wk_staff_id3[0]]);    // 警備員3
//$pdf->Text(156, 216, $staffs[$report->oup_wk_staff_id4[0]]);    // 警備員4
//$pdf->Text(31, 227, $staffs[$report->oup_wk_staff_id5[0]]);     // 警備員5
//$pdf->Text(72, 227, $staffs[$report->oup_wk_staff_id6[0]]);     // 警備員6
//$pdf->Text(114, 227, $staffs[$report->oup_wk_staff_id7[0]]);    // 警備員7
//$pdf->Text(156, 227, $staffs[$report->oup_wk_staff_id8[0]]);    // 警備員8

$pdf->Text(100, 244, $report->oup_offwk_count[0]);      // C-5
$pdf->Text(113, 266, $report->oup_outsider[0]);      // C-5

$pdf->MultiCell(64,30,$report->oup_comment[0],0,'',0,1,23,241);     // 備考


$pdf->Output(sprintf("report6.pdf", time()), 'I');
?>