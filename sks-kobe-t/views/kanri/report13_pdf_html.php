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
$pdf->setSourceFile($common->rootpath.'/pdf/report13.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(36, 62, $wnen);     // 年
$pdf->Text(54, 62, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(68, 62, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(85, 62, $weekday1);     // 曜日
$pdf->Text(104, 62, substr($report->oup_joban_time[0],0,2));     // 開始時間
$pdf->Text(122, 62, substr($report->oup_joban_time[0],3,2));     // 開始時間

$wnen = substr($report->oup_end_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(36, 71, $wnen);     // 年
$pdf->Text(54, 71, substr($report->oup_end_date[0],5,2));     // 月
$pdf->Text(68, 71, substr($report->oup_end_date[0],8,2));     // 日
$pdf->Text(85, 71, $weekday2);     // 曜日
$pdf->Text(104, 71, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(122, 71, substr($report->oup_kaban_time[0],3,2));     // 終了時間

$pdf->Text(136, 65, $report->oup_weather1[0]);     // 天候
$pdf->Text(142, 65, $report->oup_weather2[0]);     // 天候

$pdf->Text(152, 65, $staffs[$report->oup_staff_id[0]]);     // 担当警備士

$pdf->Text(100, 88, $report->oup_wk_start_time[0]." ～ ".$report->oup_wk_end_time[0]);     // 日本港運
$pdf->Text(100, 130, $report->oup_picket_start_time[0]." ～ ".$report->oup_picket_end_time[0]);     // 日本港運

$pdf->Text(47, 217, $report->oup_patrol_time1[0]);     // 巡回1
$pdf->Text(47, 226, $report->oup_patrol_time2[0]);     // 巡回2
$pdf->Text(47, 235, $report->oup_patrol_time3[0]);     // 巡回3
$pdf->Text(47, 244, $report->oup_patrol_time4[0]);     // 巡回4

$pdf->Text(85, 217, $staffs[$report->oup_wk_staff_id1[0]]);     // 警備員1
$pdf->Text(85, 226, $staffs[$report->oup_wk_staff_id2[0]]);     // 警備員2
$pdf->Text(85, 235, $staffs[$report->oup_wk_staff_id3[0]]);     // 警備員3
$pdf->Text(85, 244, $staffs[$report->oup_wk_staff_id4[0]]);     // 警備員4

$pdf->MultiCell(100,30,$report->oup_comment[0],0,'',0,1,80,158);        // 特記事項
$pdf->MultiCell(60,30,$report->oup_etc_comment[0],0,'',0,1,120,224);    // 備考

if ($_GET["act"] && $_GET["act"] == "mail") {
    // $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/郵船VP_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
} else {
    $pdf->Output(sprintf("report13.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report13.pdf", time()), 'I');
?>
