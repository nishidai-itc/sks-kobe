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
$pdf->setSourceFile($common->rootpath.'/pdf/report12.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
$wnen = intval($wnen) - 2018;
$pdf->Text(39, 68, "令和".$wnen);     // 年
$pdf->Text(62, 68, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(77, 68, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(95, 68, $weekday1);     // 曜日

$pdf->Text(116, 68, substr($report->oup_joban_time[0],0,2));     // 開始時間
$pdf->Text(127, 68, substr($report->oup_joban_time[0],3,2));     // 開始時間

$wnen = substr($report->oup_end_date[0],0,4);
$wnen = intval($wnen) - 2018;
$pdf->Text(39, 75, "令和".$wnen);     // 年
$pdf->Text(62, 75, substr($report->oup_end_date[0],5,2));     // 月
$pdf->Text(77, 75, substr($report->oup_end_date[0],8,2));     // 日
$pdf->Text(95, 75, $weekday2);     // 曜日

$pdf->Text(116, 75, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(127, 75, substr($report->oup_kaban_time[0],3,2));     // 終了時間


//$pdf->Text(114, 48, $report->oup_weather1[0]);     // 天候
//$pdf->Text(121, 48, $report->oup_weather2[0]);     // 天候

$pdf->Text(145, 71, $staffs[$report->oup_staff_id[0]]);     // 担当警備員


if ($report->oup_gate1[0]=="1") {
    $pdf->Circle( 63, 114, 5, 0, 360, "D");     // 正面ゲート(全て)
} else if ($report->oup_gate1[0]=="2") {
    $pdf->Circle( 86, 114, 5, 0, 360, "D");     // 正面ゲート(一定の割合)
}

if ($report->oup_gate2[0]=="1") {
    $pdf->Circle( 141, 114, 5, 0, 360, "D");     // 正面ゲート(全て)
} else if ($report->oup_gate2[0]=="2") {
    $pdf->Circle( 164, 114, 5, 0, 360, "D");     // 正面ゲート(一定の割合)
}


$pdf->MultiCell(165,30,$report->oup_comment[0],0,'',0,1,25,127);     // 備考

if ($_GET["act"] && $_GET["act"] == "mail") {
    // $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/郵船（作業）_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');

    echo json_encode("郵船（作業）_".substr($report->oup_no[0],0,8)." ".date("H:i:s"));
    exit;
} else {
    $pdf->Output(sprintf("report2.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report2.pdf", time()), 'I');
?>
