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
$pdf->setSourceFile($common->rootpath.'/pdf/report7.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = $wnen - 2018;
$pdf->Text(138, 54, $wnen);     // 年
$pdf->Text(158, 54, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(175, 54, substr($report->oup_start_date[0],8,2));     // 日

$pdf->Text(37, 113, $wnen);     // 年
$pdf->Text(57, 113, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(73, 113, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(98, 113, $weekday1);     // 年

$pdf->Text(64, 124, substr($report->oup_joban_time[0],0,2));     // 終了時間
$pdf->Text(85, 124, substr($report->oup_joban_time[0],3,2));     // 終了時間

$pdf->Text(168, 113, $report->oup_weather1[0]);     // 天候
$pdf->Text(179, 113, $report->oup_weather2[0]);     // 天候

$pdf->Text(155, 124, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(173, 124, substr($report->oup_kaban_time[0],3,2));     // 終了時間

$pdf->Text(43, 135, $staffs[$report->oup_staff_id[0]]);     // 作業者

$pdf->Text(110, 255, $staffs[$report->oup_staff_id2[0]]);     // 報告者

if ($_GET["act"] && $_GET["act"] == "mail") {
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
} else {
    $pdf->Output(sprintf("report7.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report7.pdf", time()), 'I');
?>
