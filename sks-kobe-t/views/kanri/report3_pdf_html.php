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
$pdf->setSourceFile('/var/www/html/sks-kobe-t/pdf/report3.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
$wnen = intval($wnen) - 2018;
//$pdf->Text(28, 34, $wnen);     // 年
$pdf->Text(28, 34, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(48, 34, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(68, 34, $weekday1);     // 曜日

$pdf->Text(88, 37, $report->oup_weather1[0]);     // 天候
$pdf->Text(98, 37, $report->oup_weather2[0]);     // 天候

$pdf->Text(146, 37, $staffs[$report->oup_staff_id[0]]);     // 記録者

$pdf->Text(22, 60, $report->oup_wk_haiti1[0]);              // 配置1
$pdf->Text(44, 60, $staffs[$report->oup_wk_staff_id1[0]]);  // 氏名
$pdf->Text(90, 60, $report->oup_wk_joban_time1[0]);         // 上番時間
$pdf->Text(120, 60, $report->oup_wk_kaban_time1[0]);        // 下番時間

$pdf->Text(22, 68, $report->oup_wk_haiti2[0]);              // 配置2
$pdf->Text(44, 68, $staffs[$report->oup_wk_staff_id2[0]]);  // 氏名
$pdf->Text(90, 68, $report->oup_wk_joban_time2[0]);         // 上番時間
$pdf->Text(120, 68, $report->oup_wk_kaban_time2[0]);        // 下番時間

$pdf->Text(22, 75, $report->oup_wk_haiti3[0]);              // 配置3
$pdf->Text(44, 75, $staffs[$report->oup_wk_staff_id3[0]]);  // 氏名
$pdf->Text(90, 75, $report->oup_wk_joban_time3[0]);         // 上番時間
$pdf->Text(120, 75, $report->oup_wk_kaban_time3[0]);        // 下番時間

$pdf->Text(22, 82, $report->oup_wk_haiti4[0]);              // 配置4
$pdf->Text(44, 82, $staffs[$report->oup_wk_staff_id4[0]]);  // 氏名
$pdf->Text(90, 82, $report->oup_wk_joban_time4[0]);         // 上番時間
$pdf->Text(120, 82, $report->oup_wk_kaban_time4[0]);        // 下番時間

$pdf->Text(93, 103, $report->oup_wk_detail_time1[0]);                           // 開錠 外周(時間)
$pdf->Text(120, 103, $staffs[$report->oup_wk_detail_staff_id1[0]]);             // 開錠 外周(氏名)
$pdf->MultiCell(48,20,$report->oup_wk_detail_comment1[0],0,'',0,1,146,103);     // 開錠(特記事項)

$pdf->Text(93, 110, $report->oup_wk_detail_time2[0]);                   // 200倉庫(時間)
$pdf->Text(120, 110, $staffs[$report->oup_wk_detail_staff_id2[0]]);     // 200倉庫(氏名)

$pdf->Text(93, 117, $report->oup_wk_detail_time3[0]);                   // 300倉庫(時間)
$pdf->Text(120, 117, $staffs[$report->oup_wk_detail_staff_id3[0]]);     // 300倉庫(氏名)

$pdf->Text(93, 124, $report->oup_wk_detail_time4[0]);                           // 午前巡回 200倉庫1階(時間)
$pdf->Text(120, 124, $staffs[$report->oup_wk_detail_staff_id4[0]]);             // 午前巡回 200倉庫1階(氏名)
$pdf->MultiCell(48,13,$report->oup_wk_detail_comment4[0],0,'',0,1,146,124);     // 午前巡回 200倉庫1階(特記事項)

$pdf->Text(93, 131, $report->oup_wk_detail_time5[0]);                           // 300倉庫北事務所(時間)
$pdf->Text(120, 131, $staffs[$report->oup_wk_detail_staff_id5[0]]);             // 300倉庫北事務所(氏名)
$pdf->MultiCell(48,30,$report->oup_wk_detail_comment6[0],0,'',0,1,146,138);     // 300倉庫北事務所(特記事項)

$pdf->Text(93, 138, $report->oup_wk_detail_time6[0]);                   // 300倉庫車路(時間)
$pdf->Text(120, 138, $staffs[$report->oup_wk_detail_staff_id6[0]]);     // 300倉庫車路(氏名)

$pdf->Text(93, 145, $report->oup_wk_detail_time7[0]);                   // 300倉庫2階(時間)
$pdf->Text(120, 145, $staffs[$report->oup_wk_detail_staff_id7[0]]);     // 300倉庫2階(氏名)

$pdf->Text(93, 152, $report->oup_wk_detail_time8[0]);                   // 300倉庫3階(時間)
$pdf->Text(120, 152, $staffs[$report->oup_wk_detail_staff_id8[0]]);     // 300倉庫3階(氏名)

$pdf->Text(93, 158, $report->oup_wk_detail_time9[0]);                   // 300倉庫4階(時間)
$pdf->Text(120, 158, $staffs[$report->oup_wk_detail_staff_id9[0]]);     // 300倉庫4階(氏名)

$pdf->Text(93, 165, $report->oup_wk_detail_time10[0]);                  // 300倉庫南事務所(時間)
$pdf->Text(120, 165, $staffs[$report->oup_wk_detail_staff_id10[0]]);    // 300倉庫南事務所(氏名)

$pdf->Text(93, 171, $report->oup_wk_detail_time11[0]);                          // 住友倉庫(時間)
$pdf->Text(120, 171, $staffs[$report->oup_wk_detail_staff_id11[0]]);            // 住友倉庫(氏名)
$pdf->MultiCell(48,30,$report->oup_wk_detail_comment12[0],0,'',0,1,146,178);    // 住友倉庫(特記事項)

$pdf->Text(93, 178, $report->oup_wk_detail_time12[0]);                  // 神港作業(時間)
$pdf->Text(120, 178, $staffs[$report->oup_wk_detail_staff_id12[0]]);    // 神港作業(氏名)

$pdf->Text(93, 185, $report->oup_wk_detail_time13[0]);                  // 樽喜梱包(時間)
$pdf->Text(120, 185, $staffs[$report->oup_wk_detail_staff_id13[0]]);    // 樽喜梱包(氏名)

$pdf->Text(93, 192, $report->oup_wk_detail_time14[0]);                  // 全日検(時間)
$pdf->Text(120, 192, $staffs[$report->oup_wk_detail_staff_id14[0]]);    // 全日検(氏名)

$pdf->Text(93, 198, $report->oup_wk_detail_time15[0]);                  // (時間)
$pdf->Text(120, 198, $staffs[$report->oup_wk_detail_staff_id15[0]]);    // (氏名)

$pdf->Text(93, 204, $report->oup_wk_detail_time16[0]);                  // (時間)
$pdf->Text(120, 204, $staffs[$report->oup_wk_detail_staff_id16[0]]);    // (氏名)

$pdf->Text(41, 211, $report->oup_wk_detail_title17[0]);                 // (タイトル)
$pdf->Text(93, 211, $report->oup_wk_detail_time17[0]);                  // (時間)
$pdf->Text(120, 211, $staffs[$report->oup_wk_detail_staff_id17[0]]);    // (氏名)

$pdf->Text(41, 217, $report->oup_wk_detail_title18[0]);                 // (タイトル)
$pdf->Text(93, 217, $report->oup_wk_detail_time18[0]);                  // (時間)
$pdf->Text(120, 217, $staffs[$report->oup_wk_detail_staff_id18[0]]);    // (氏名)

$pdf->Text(93, 224, $report->oup_wk_detail_time19[0]);                          // 200倉庫(時間)
$pdf->Text(120, 224, $staffs[$report->oup_wk_detail_staff_id19[0]]);            // 200倉庫(氏名)
$pdf->MultiCell(48,18,$report->oup_wk_detail_comment19[0],0,'',0,1,146,225);    // 200倉庫(特記事項)

$pdf->Text(93, 231, $report->oup_wk_detail_time20[0]);                  // 300倉庫(時間)
$pdf->Text(120, 231, $staffs[$report->oup_wk_detail_staff_id20[0]]);    // 300倉庫(氏名)

$pdf->Text(93, 238, $report->oup_wk_detail_time21[0]);                  // 外周(時間)
$pdf->Text(120, 238, $staffs[$report->oup_wk_detail_staff_id21[0]]);    // 外周(氏名)

$pdf->Text(20, 258, $report->oup_night_company[0]);                     // 会社名
$pdf->Text(65, 258, $staffs[$report->oup_night_taiin_id[0]]);           // 氏名
$pdf->Text(122, 258, $report->oup_night_exit_time[0]);                  // 退出時間
$pdf->Text(150, 258, $staffs[$report->oup_night_staff_id[0]]);          // SKS対応者


$pdf->Output(sprintf("report13.pdf", time()), 'I');
?>
