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
$pdf->setSourceFile($common->rootpath.'/pdf/report3.pdf');

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
$pdf->Text(23, 34, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(42, 34, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(61, 34, $weekday1);     // 曜日

$pdf->Text(73, 37, $report->oup_weather1[0]);     // 天候
$pdf->Text(82, 37, $report->oup_weather2[0]);     // 天候

$pdf->Text(94, 37, $report->oup_chief[0]);                  // 所長
$pdf->Text(136, 37, $staffs[$report->oup_staff_id[0]]);     // 記録者

$pdf->Text(17, 60, $report->oup_wk_haiti1[0]);              // 配置1
$pdf->Text(36, 60, $staffs[$report->oup_wk_staff_id1[0]]);  // 氏名
$pdf->Text(75, 60, $report->oup_wk_joban_time1[0]);         // 上番時間
$pdf->Text(93, 60, $report->oup_wk_kaban_time1[0]);         // 下番時間

$pdf->Text(17, 68, $report->oup_wk_haiti2[0]);              // 配置2
$pdf->Text(36, 68, $staffs[$report->oup_wk_staff_id2[0]]);  // 氏名
$pdf->Text(75, 68, $report->oup_wk_joban_time2[0]);         // 上番時間
$pdf->Text(93, 68, $report->oup_wk_kaban_time2[0]);         // 下番時間

$pdf->Text(17, 75, $report->oup_wk_haiti3[0]);              // 配置3
$pdf->Text(36, 75, $staffs[$report->oup_wk_staff_id3[0]]);  // 氏名
$pdf->Text(75, 75, $report->oup_wk_joban_time3[0]);         // 上番時間
$pdf->Text(93, 75, $report->oup_wk_kaban_time3[0]);         // 下番時間

$pdf->Text(17, 82, $report->oup_wk_haiti4[0]);              // 配置4
$pdf->Text(36, 82, $staffs[$report->oup_wk_staff_id4[0]]);  // 氏名
$pdf->Text(75, 82, $report->oup_wk_joban_time4[0]);         // 上番時間
$pdf->Text(93, 82, $report->oup_wk_kaban_time4[0]);         // 下番時間

$pdf->Text(17, 89, $report->oup_wk_haiti5[0]);              // 配置5
$pdf->Text(36, 89, $staffs[$report->oup_wk_staff_id5[0]]);  // 氏名
$pdf->Text(75, 89, $report->oup_wk_joban_time5[0]);         // 上番時間
$pdf->Text(93, 89, $report->oup_wk_kaban_time5[0]);         // 下番時間

$pdf->Text(113, 60, $report->oup_wk_haiti6[0]);              // 配置6
$pdf->Text(133, 60, $staffs[$report->oup_wk_staff_id6[0]]);  // 氏名
$pdf->Text(169, 60, $report->oup_wk_joban_time6[0]);         // 上番時間
$pdf->Text(187, 60, $report->oup_wk_kaban_time6[0]);         // 下番時間

$pdf->Text(113, 68, $report->oup_wk_haiti7[0]);              // 配置7
$pdf->Text(133, 68, $staffs[$report->oup_wk_staff_id7[0]]);  // 氏名
$pdf->Text(169, 68, $report->oup_wk_joban_time7[0]);         // 上番時間
$pdf->Text(187, 68, $report->oup_wk_kaban_time7[0]);         // 下番時間

$pdf->Text(113, 75, $report->oup_wk_haiti8[0]);              // 配置8
$pdf->Text(133, 75, $staffs[$report->oup_wk_staff_id8[0]]);  // 氏名
$pdf->Text(169, 75, $report->oup_wk_joban_time8[0]);         // 上番時間
$pdf->Text(187, 75, $report->oup_wk_kaban_time8[0]);         // 下番時間

$pdf->Text(113, 82, $report->oup_wk_haiti9[0]);              // 配置9
$pdf->Text(133, 82, $staffs[$report->oup_wk_staff_id9[0]]);  // 氏名
$pdf->Text(169, 82, $report->oup_wk_joban_time9[0]);         // 上番時間
$pdf->Text(187, 82, $report->oup_wk_kaban_time9[0]);         // 下番時間

$pdf->Text(113, 89, $report->oup_wk_haiti10[0]);              // 配置10
$pdf->Text(133, 89, $staffs[$report->oup_wk_staff_id10[0]]);  // 氏名
$pdf->Text(169, 89, $report->oup_wk_joban_time10[0]);         // 上番時間
$pdf->Text(187, 89, $report->oup_wk_kaban_time10[0]);         // 下番時間

$pdf->Text(83, 110, $report->oup_wk_detail_time1[0]);                           // 開錠 外周(時間)
$pdf->Text(111, 110, $staffs[$report->oup_wk_detail_staff_id1[0]]);             // 開錠 外周(氏名)
$pdf->MultiCell(48,20,$report->oup_wk_detail_comment1[0],0,'',0,1,150,110);     // 開錠(特記事項)

$pdf->Text(83, 117, $report->oup_wk_detail_time2[0]);                   // 200倉庫(時間)
$pdf->Text(111, 117, $staffs[$report->oup_wk_detail_staff_id2[0]]);     // 200倉庫(氏名)

$pdf->Text(83, 124, $report->oup_wk_detail_time3[0]);                   // 300倉庫(時間)
$pdf->Text(111, 124, $staffs[$report->oup_wk_detail_staff_id3[0]]);     // 300倉庫(氏名)

$pdf->Text(83, 131, $report->oup_wk_detail_time4[0]);                           // 午前巡回 200倉庫1階(時間)
$pdf->Text(111, 131, $staffs[$report->oup_wk_detail_staff_id4[0]]);             // 午前巡回 200倉庫1階(氏名)
$pdf->MultiCell(48,13,$report->oup_wk_detail_comment4[0],0,'',0,1,150,131);     // 午前巡回 200倉庫1階(特記事項)

$pdf->Text(83, 138, $report->oup_wk_detail_time5[0]);                           // 300倉庫北事務所(時間)
$pdf->Text(111, 138, $staffs[$report->oup_wk_detail_staff_id5[0]]);             // 300倉庫北事務所(氏名)
$pdf->MultiCell(48,30,$report->oup_wk_detail_comment6[0],0,'',0,1,150,145);     // 300倉庫北事務所(特記事項)

$pdf->Text(83, 145, $report->oup_wk_detail_time6[0]);                   // 300倉庫車路(時間)
$pdf->Text(111, 145, $staffs[$report->oup_wk_detail_staff_id6[0]]);     // 300倉庫車路(氏名)

$pdf->Text(83, 152, $report->oup_wk_detail_time7[0]);                   // 300倉庫2階(時間)
$pdf->Text(111, 152, $staffs[$report->oup_wk_detail_staff_id7[0]]);     // 300倉庫2階(氏名)

$pdf->Text(83, 159, $report->oup_wk_detail_time8[0]);                   // 300倉庫3階(時間)
$pdf->Text(111, 159, $staffs[$report->oup_wk_detail_staff_id8[0]]);     // 300倉庫3階(氏名)

$pdf->Text(83, 165, $report->oup_wk_detail_time9[0]);                   // 300倉庫4階(時間)
$pdf->Text(111, 165, $staffs[$report->oup_wk_detail_staff_id9[0]]);     // 300倉庫4階(氏名)

$pdf->Text(83, 172, $report->oup_wk_detail_time10[0]);                  // 300倉庫南事務所(時間)
$pdf->Text(111, 172, $staffs[$report->oup_wk_detail_staff_id10[0]]);    // 300倉庫南事務所(氏名)

$pdf->Text(83, 178, $report->oup_wk_detail_time11[0]);                          // 住友倉庫(時間)
$pdf->Text(111, 178, $staffs[$report->oup_wk_detail_staff_id11[0]]);            // 住友倉庫(氏名)
$pdf->MultiCell(48,30,$report->oup_wk_detail_comment12[0],0,'',0,1,150,185);    // 住友倉庫(特記事項)

$pdf->Text(83, 185, $report->oup_wk_detail_time12[0]);                  // 神港作業(時間)
$pdf->Text(111, 185, $staffs[$report->oup_wk_detail_staff_id12[0]]);    // 神港作業(氏名)

$pdf->Text(83, 192, $report->oup_wk_detail_time13[0]);                  // 樽喜梱包(時間)
$pdf->Text(111, 192, $staffs[$report->oup_wk_detail_staff_id13[0]]);    // 樽喜梱包(氏名)

$pdf->Text(83, 199, $report->oup_wk_detail_time14[0]);                  // 全日検(時間)
$pdf->Text(111, 199, $staffs[$report->oup_wk_detail_staff_id14[0]]);    // 全日検(氏名)

$pdf->Text(83, 206, $report->oup_wk_detail_time15[0]);                  // 藤原運輸(時間)
$pdf->Text(111, 206, $staffs[$report->oup_wk_detail_staff_id15[0]]);    // 藤原運輸(氏名)

$pdf->Text(83, 212, $report->oup_wk_detail_time16[0]);                  // (時間)
$pdf->Text(111, 212, $staffs[$report->oup_wk_detail_staff_id16[0]]);    // (氏名)

$pdf->Text(35, 218, $report->oup_wk_detail_title17[0]);                 // (タイトル)
$pdf->Text(83, 218, $report->oup_wk_detail_time17[0]);                  // (時間)
$pdf->Text(111, 218, $staffs[$report->oup_wk_detail_staff_id17[0]]);    // (氏名)

$pdf->Text(35, 224, $report->oup_wk_detail_title18[0]);                 // (タイトル)
$pdf->Text(83, 224, $report->oup_wk_detail_time18[0]);                  // (時間)
$pdf->Text(111, 224, $staffs[$report->oup_wk_detail_staff_id18[0]]);    // (氏名)

$pdf->Text(83, 231, $report->oup_wk_detail_time19[0]);                          // 200倉庫(時間)
$pdf->Text(111, 231, $staffs[$report->oup_wk_detail_staff_id19[0]]);            // 200倉庫(氏名)
$pdf->MultiCell(48,18,$report->oup_wk_detail_comment19[0],0,'',0,1,150,232);    // 200倉庫(特記事項)

$pdf->Text(83, 238, $report->oup_wk_detail_time20[0]);                  // 300倉庫(時間)
$pdf->Text(111, 238, $staffs[$report->oup_wk_detail_staff_id20[0]]);    // 300倉庫(氏名)

$pdf->Text(83, 245, $report->oup_wk_detail_time21[0]);                  // 外周(時間)
$pdf->Text(111, 245, $staffs[$report->oup_wk_detail_staff_id21[0]]);    // 外周(氏名)

$pdf->Text(20, 265, $report->oup_night_company[0]);                     // 会社名
$pdf->Text(65, 265, $staffs[$report->oup_night_taiin_id[0]]);           // 氏名
$pdf->Text(122, 265, $report->oup_night_exit_time[0]);                  // 退出時間
$pdf->Text(150, 265, $staffs[$report->oup_night_staff_id[0]]);          // SKS対応者


$pdf->Output(sprintf("report13.pdf", time()), 'I');
?>
