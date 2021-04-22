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
$pdf->setSourceFile($common->rootpath.'/pdf/report10.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(90, 92, $wnen);     // 年
$pdf->Text(108, 92, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(120, 92, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(137, 92, $weekday1);     // 曜日

$pdf->Text(168, 92, $report->oup_weather1[0]);     // 天候
$pdf->Text(181, 92, $report->oup_weather2[0]);     // 天候

if ($report->oup_marsk_number1[0]=="") { $report->oup_marsk_number1[0] = 0; }
if ($report->oup_marsk_number2[0]=="") { $report->oup_marsk_number2[0] = 0; }
if ($report->oup_marsk_number3[0]=="") { $report->oup_marsk_number3[0] = 0; }
if ($report->oup_marsk_number4[0]=="") { $report->oup_marsk_number4[0] = 0; }

$pdf->SetXY( 85, 118 );
$pdf->Cell(6, 6, $report->oup_marsk_number1[0], 0, 0, "R");     // マースク返バン
$pdf->SetXY( 85, 135 );
$pdf->Cell(6, 6, $report->oup_marsk_number2[0], 0, 0, "R");     // マースク返バン
$pdf->SetXY( 85, 152 );
$pdf->Cell(6, 6, $report->oup_marsk_number3[0], 0, 0, "R");     // マースク返バン
$pdf->SetXY( 85, 169 );
$pdf->Cell(6, 6, $report->oup_marsk_number4[0], 0, 0, "R");     // マースク返バン

if ($report->oup_wait_anumber1[0]=="") { $report->oup_wait_anumber1[0] = 0; }
if ($report->oup_wait_anumber2[0]=="") { $report->oup_wait_anumber2[0] = 0; }
if ($report->oup_wait_anumber3[0]=="") { $report->oup_wait_anumber3[0] = 0; }
if ($report->oup_wait_anumber4[0]=="") { $report->oup_wait_anumber4[0] = 0; }

$pdf->SetXY( 116, 118 );
$pdf->Cell(6, 6, $report->oup_wait_anumber1[0], 0, 0, "R");     // 待機場A
$pdf->SetXY( 116, 135 );
$pdf->Cell(6, 6, $report->oup_wait_anumber2[0], 0, 0, "R");     // 待機場A
$pdf->SetXY( 116, 152 );
$pdf->Cell(6, 6, $report->oup_wait_anumber3[0], 0, 0, "R");     // 待機場A
$pdf->SetXY( 116, 169 );
$pdf->Cell(6, 6, $report->oup_wait_anumber4[0], 0, 0, "R");     // 待機場A

if ($report->oup_wait_bnumber1[0]=="") { $report->oup_wait_bnumber1[0] = 0; }
if ($report->oup_wait_bnumber2[0]=="") { $report->oup_wait_bnumber2[0] = 0; }
if ($report->oup_wait_bnumber3[0]=="") { $report->oup_wait_bnumber3[0] = 0; }
if ($report->oup_wait_bnumber4[0]=="") { $report->oup_wait_bnumber4[0] = 0; }

$pdf->SetXY( 147, 118 );
$pdf->Cell(6, 6, $report->oup_wait_bnumber1[0], 0, 0, "R");     // 待機場B
$pdf->SetXY( 147, 135 );
$pdf->Cell(6, 6, $report->oup_wait_bnumber2[0], 0, 0, "R");     // 待機場B
$pdf->SetXY( 147, 152 );
$pdf->Cell(6, 6, $report->oup_wait_bnumber3[0], 0, 0, "R");     // 待機場B
$pdf->SetXY( 147, 169 );
$pdf->Cell(6, 6, $report->oup_wait_bnumber4[0], 0, 0, "R");     // 待機場B

if ($report->oup_wait_outside1[0]=="") { $report->oup_wait_outside1[0] = 0; }
if ($report->oup_wait_outside2[0]=="") { $report->oup_wait_outside2[0] = 0; }
if ($report->oup_wait_outside3[0]=="") { $report->oup_wait_outside3[0] = 0; }
if ($report->oup_wait_outside4[0]=="") { $report->oup_wait_outside4[0] = 0; }

$pdf->SetXY( 178, 118 );
$pdf->Cell(6, 6, $report->oup_wait_outside1[0], 0, 0, "R");     // 待機場B場外
$pdf->SetXY( 178, 135 );
$pdf->Cell(6, 6, $report->oup_wait_outside2[0], 0, 0, "R");     // 待機場B場外
$pdf->SetXY( 178, 152 );
$pdf->Cell(6, 6, $report->oup_wait_outside3[0], 0, 0, "R");     // 待機場B場外
$pdf->SetXY( 178, 169 );
$pdf->Cell(6, 6, $report->oup_wait_outside4[0], 0, 0, "R");     // 待機場B場外

if ($report->oup_in_port2[0]=="1") {
    $pdf->Circle( 56, 215, 3, 0, 360, "D");     // K-LINE(有)
} else if ($report->oup_in_port2[0]=="2") {
    $pdf->Circle( 68, 215, 3, 0, 360, "D");     // K-LINE(無)
}

if ($report->oup_in_port1[0]=="1") {
    $pdf->Circle( 56, 221, 3, 0, 360, "D");     // MAERSK(有)
} else if ($report->oup_in_port1[0]=="2") {
    $pdf->Circle( 68, 221, 3, 0, 360, "D");     // MAERSK(無)
}

$pdf->Text(143, 214, $report->oup_facter[0]);     // 発生要因

$pdf->MultiCell(130,20,$report->oup_comment[0],0,'',0,1,50,269);    // 備考

// if ($_GET["act"] && $_GET["act"] == "mail") {
//     // $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
//     $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/誘導_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
// } else {
//     $pdf->Output(sprintf("report7.pdf", time()), 'I');
// }
if ($_GET["act2"]) {
    if (($_GET["act2"] == "first" && $_GET["cnt"] == "1") || ($_GET["act2"] == "end" && ($_GET["cnt"] == "2" || $_GET["cnt"] == "3"))) {
        $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/警備報告書（A.B.誘導）_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
    }
} else {
    $pdf->Output(sprintf("report2.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report7.pdf", time()), 'I');
?>
