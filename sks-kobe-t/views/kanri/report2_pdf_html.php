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
$pdf->setSourceFile($common->rootpath.'/pdf/report2.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(37, 63, $wnen);     // 年
$pdf->Text(57, 63, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(72, 63, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(88, 63, $weekday1);     // 曜日
$pdf->Text(102, 63, substr($report->oup_joban_time[0],0,2));     // 開始時間
$pdf->Text(116, 63, substr($report->oup_joban_time[0],3,2));     // 開始時間

$pdf->Text(102, 72, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(116, 72, substr($report->oup_kaban_time[0],3,2));     // 終了時間


$pdf->Text(128, 67, $report->oup_weather1[0]);     // 天候
$pdf->Text(135, 67, $report->oup_weather2[0]);     // 天候

$pdf->Text(160, 67, $staffs[$report->oup_staff_id[0]]);     // 担当警備員

$pdf->Text(70, 123, substr($report->oup_wk_end_time[0],0,2));     // 作業終了時刻
$pdf->Text(85, 123, substr($report->oup_wk_end_time[0],3,2));     // 作業終了時刻

$pdf->Text(70, 132, substr($report->oup_flag1_time[0],0,2));     // 安全旗掲揚
$pdf->Text(85, 132, substr($report->oup_flag1_time[0],3,2));     // 安全旗掲揚

$pdf->Text(70, 141, substr($report->oup_flag2_time[0],0,2));     // 安全旗降納
$pdf->Text(85, 141, substr($report->oup_flag2_time[0],3,2));     // 安全旗降納

$pdf->MultiCell(158,30,$report->oup_comment[0],0,'',0,1,38,225);     // 備考

if ($_GET["act"] && $_GET["act"] == "mail") {
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
} else {
    $pdf->Output(sprintf("report2.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report2.pdf", time()), 'I');
?>
