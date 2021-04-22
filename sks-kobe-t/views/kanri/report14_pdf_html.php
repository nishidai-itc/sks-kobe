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
$pdf->setSourceFile($common->rootpath.'/pdf/report14.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(87, 99, $wnen);     // 年
$pdf->Text(109, 99, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(125, 99, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(143, 99, $weekday1);     // 曜日

$pdf->Text(176, 99, $report->oup_weather1[0]);     // 天候
$pdf->Text(182, 99, $report->oup_weather2[0]);     // 天候

$pdf->Text(152, 65, $staffs[$report->oup_staff_id1[0]]);     // 担当警備士

$pdf->Text(36, 127, $staffs[$report->oup_wk_staff_id1[0]]);     // 警備員1
$pdf->Text(36, 139, $staffs[$report->oup_wk_staff_id2[0]]);     // 警備員2
$pdf->Text(36, 151, $staffs[$report->oup_wk_staff_id3[0]]);     // 警備員3
$pdf->Text(36, 163, $staffs[$report->oup_wk_staff_id4[0]]);     // 警備員4

$pdf->Text(88, 127, $report->oup_wk_joban_time1[0]);     // 巡回1
$pdf->Text(88, 139, $report->oup_wk_joban_time2[0]);     // 巡回2
$pdf->Text(88, 151, $report->oup_wk_joban_time3[0]);     // 巡回3
$pdf->Text(88, 163, $report->oup_wk_joban_time4[0]);     // 巡回4

$pdf->Text(130, 127, $report->oup_wk_kaban_time1[0]);     // 巡回1
$pdf->Text(130, 139, $report->oup_wk_kaban_time2[0]);     // 巡回2
$pdf->Text(130, 151, $report->oup_wk_kaban_time3[0]);     // 巡回3
$pdf->Text(130, 163, $report->oup_wk_kaban_time4[0]);     // 巡回4

$pdf->Text(175, 127, $report->oup_wk_zan1[0]);     // 巡回1
$pdf->Text(175, 139, $report->oup_wk_zan2[0]);     // 巡回2
$pdf->Text(175, 151, $report->oup_wk_zan3[0]);     // 巡回3
$pdf->Text(175, 163, $report->oup_wk_zan4[0]);     // 巡回4

$pdf->Text(103, 184, $report->oup_picket_joban_time[0]);     // 巡回4
$pdf->Text(158, 184, $report->oup_picket_kaban_time[0]);     // 巡回4

$pdf->MultiCell(100,30,$report->oup_comment[0],0,'',0,1,77,194);        // 特記事項

if ($_GET["act"] && $_GET["act"] == "mail") {
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
} else {
    $pdf->Output(sprintf("report2.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report2.pdf", time()), 'I');
?>
