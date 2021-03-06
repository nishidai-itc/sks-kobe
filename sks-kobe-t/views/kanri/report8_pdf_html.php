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

if (($_GET["act2"] && $_GET["act2"] == "first") || !$_GET["act2"]) {
    $pdf = new TcpdfFpdi();
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetCellPadding(0);
    $pdf->SetAutoPageBreak(false);
    $pdf->setPrintHeader(false);    
    $pdf->setPrintFooter(false);
    $pdf->SetFont('kozminproregular', '', 12);// 日本語フォント
}

// テンプレート読み込み
$pdf->setSourceFile($common->rootpath.'/pdf/report8.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(25, 48, $wnen);     // 年
$pdf->Text(41, 48, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(52, 48, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(66, 48, $weekday1);     // 曜日
$pdf->Text(90, 73, substr($report->oup_wk_start_time[0],0,2));     // 開始時間
$pdf->Text(104, 73, substr($report->oup_wk_start_time[0],3,2));     // 開始時間

$pdf->Text(140, 73, substr($report->oup_wk_end_time[0],0,2));     // 終了時間
$pdf->Text(154, 73, substr($report->oup_wk_end_time[0],3,2));     // 終了時間


$pdf->Text(114, 48, $report->oup_weather1[0]);     // 天候
$pdf->Text(121, 48, $report->oup_weather2[0]);     // 天候

$pdf->Text(132, 48, $staffs[$report->oup_staff_id[0]]);     // 担当警備員

if ($report->oup_result1[0]=="1") {
    $pdf->Circle( 154, 90, 5, 0, 360, "D");     // 作業結果(有)
} else if ($report->oup_result1[0]=="2") {
    $pdf->Circle( 132, 90, 5, 0, 360, "D");     // 作業結果(無)
}

$pdf->Text(31, 216, $staffs[$report->oup_wk_staff_id1[0]]);     // 警備員1
$pdf->Text(72, 216, $staffs[$report->oup_wk_staff_id2[0]]);     // 警備員2
$pdf->Text(114, 216, $staffs[$report->oup_wk_staff_id3[0]]);    // 警備員3
$pdf->Text(156, 216, $staffs[$report->oup_wk_staff_id4[0]]);    // 警備員4
$pdf->Text(31, 227, $staffs[$report->oup_wk_staff_id5[0]]);     // 警備員5
$pdf->Text(72, 227, $staffs[$report->oup_wk_staff_id6[0]]);     // 警備員6
$pdf->Text(114, 227, $staffs[$report->oup_wk_staff_id7[0]]);    // 警備員7
$pdf->Text(156, 227, $staffs[$report->oup_wk_staff_id8[0]]);    // 警備員8

$pdf->MultiCell(165,30,$report->oup_comment[0],0,'',0,1,23,237);     // 備考

// if ($_GET["act"] && $_GET["act"] == "mail") {
//     // $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
//     $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/待機場A_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
// } else {
//     $pdf->Output(sprintf("report2.pdf", time()), 'I');
// }
if ($_GET["act2"]) {
    if (($_GET["act2"] == "first" && $_GET["cnt"] == "1") || ($_GET["act2"] == "end" && ($_GET["cnt"] == "2" || $_GET["cnt"] == "3"))) {
        $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/警備報告書（A.B.誘導） ".$common->dateSeparate(substr($report->oup_no[0],0,8)).".pdf", time()), 'F');
    }
} else {
    $pdf->Output(sprintf("report2.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report2.pdf", time()), 'I');
?>
