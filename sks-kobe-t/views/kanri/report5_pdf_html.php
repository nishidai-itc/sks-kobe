<?php 
    ob_end_clean();

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($report->oup_start_date[0]));
    $w = date("w", $time);
    $weekday1 = $week[$w];

    $time = strtotime(date($report->oup_end_date[0]));
    $w = date("w", $time);
    $weekday2 = $week[$w];

    $kbn[1] = "泊";
    $kbn[2] = "日";
    $kbn[3] = "夜";
    $kbn[4] = "研";

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
$pdf->setSourceFile('/var/www/html/sks-kobe-t/pdf/report5.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
$wnen = intval($wnen) - 2018;
$pdf->Text(38, 44, $wnen);     // 年
$pdf->Text(47, 44, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(58, 44, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(71, 44, $weekday1);     // 曜日
$pdf->Text(87, 44, substr($report->oup_joban_time[0],0,2));     // 開始時間
$pdf->Text(98, 44, substr($report->oup_joban_time[0],3,2));     // 開始時間

$wnen = substr($report->oup_end_date[0],0,4);
$wnen = intval($wnen) - 2018;
$pdf->Text(38, 51, $wnen);     // 年
$pdf->Text(47, 51, substr($report->oup_end_date[0],5,2));     // 月
$pdf->Text(58, 51, substr($report->oup_end_date[0],8,2));     // 日
$pdf->Text(71, 51, $weekday2);     // 曜日
$pdf->Text(87, 51, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(98, 51, substr($report->oup_kaban_time[0],3,2));     // 終了時間

$pdf->Text(114, 50, $report->oup_weather1[0]);     // 天候
$pdf->Text(120, 50, $report->oup_weather2[0]);     // 天候

$pdf->Text(130, 50, $staffs[$report->oup_staff_id[0]]);     // 報告者

$pdf->Text(35, 72, $report->oup_ship1[0]);                  // 入出港1
$pdf->Text(77, 72, $report->oup_ship_in_port_time1[0]);     // 入出港1
$pdf->Text(108, 72, $report->oup_ship_out_port_time1[0]);   // 入出港1

$pdf->Text(35, 78, $report->oup_ship2[0]);                  // 入出港2
$pdf->Text(77, 78, $report->oup_ship_in_port_time2[0]);     // 入出港2
$pdf->Text(108, 78, $report->oup_ship_out_port_time2[0]);   // 入出港2

$pdf->Text(35, 84, $report->oup_ship3[0]);                  // 入出港3
$pdf->Text(77, 84, $report->oup_ship_in_port_time3[0]);     // 入出港3
$pdf->Text(108, 84, $report->oup_ship_out_port_time3[0]);   // 入出港3

$pdf->Text(35, 90, $report->oup_ship4[0]);                  // 入出港4
$pdf->Text(77, 90, $report->oup_ship_in_port_time4[0]);     // 入出港4
$pdf->Text(108, 90, $report->oup_ship_out_port_time4[0]);   // 入出港4

$pdf->Text(77, 103, $report->oup_picket_joban_time1[0]);    // C-4ゲート立哨
$pdf->Text(108, 103, $report->oup_picket_kaban_time1[0]);   // C-4ゲート立哨

$pdf->Text(77, 110, $report->oup_picket_joban_time2[0]);    // 車サブゲート立哨
$pdf->Text(108, 110, $report->oup_picket_kaban_time2[0]);   // 車サブゲート立哨

$pdf->Text(77, 116, $report->oup_picket_joban_time3[0]);    // 搬入出車両
$pdf->Text(108, 116, $report->oup_picket_kaban_time3[0]);   // 搬入出車両

$pdf->MultiCell(105,30,$report->oup_comment[0],0,'',0,1,22,180);     // 備考

$pdf->Text(133, 77, $report->oup_c2_kbn1[0]);           // C-2-1
$pdf->Text(145, 77, $report->oup_c2_joban_time1[0]);    // C-2-1
$pdf->Text(167, 77, $report->oup_c2_kaban_time1[0]);    // C-2-1

$pdf->Text(133, 84, $report->oup_c2_kbn2[0]);           // C-2-2
$pdf->Text(145, 84, $report->oup_c2_joban_time2[0]);    // C-2-2
$pdf->Text(167, 84, $report->oup_c2_kaban_time2[0]);    // C-2-2

$pdf->Text(133, 103, $report->oup_c3_kbn1[0]);          // C-3-1
$pdf->Text(145, 103, $report->oup_c3_joban_time1[0]);   // C-3-1
$pdf->Text(167, 103, $report->oup_c3_kaban_time1[0]);   // C-3-1

$pdf->Text(133, 110, $report->oup_c3_kbn2[0]);          // C-3-2
$pdf->Text(145, 110, $report->oup_c3_joban_time2[0]);   // C-3-2
$pdf->Text(167, 110, $report->oup_c3_kaban_time2[0]);   // C-3-2

$pdf->Text(133, 129, $report->oup_c4_kbn1[0]);          // C-4-1
$pdf->Text(145, 129, $report->oup_c4_joban_time1[0]);   // C-4-1
$pdf->Text(167, 129, $report->oup_c4_kaban_time1[0]);   // C-4-1

$pdf->Text(133, 136, $report->oup_c4_kbn2[0]);          // C-4-2
$pdf->Text(145, 136, $report->oup_c4_joban_time2[0]);   // C-4-2
$pdf->Text(167, 136, $report->oup_c4_kaban_time2[0]);   // C-4-2

$pdf->Text(133, 155, $report->oup_c5_kbn1[0]);          // C-5-1
$pdf->Text(145, 155, $report->oup_c5_joban_time1[0]);   // C-5-1
$pdf->Text(167, 155, $report->oup_c5_kaban_time1[0]);   // C-5-1

$pdf->Text(133, 162, $report->oup_c5_kbn2[0]);          // C-5-2
$pdf->Text(145, 162, $report->oup_c5_joban_time2[0]);   // C-5-2
$pdf->Text(167, 162, $report->oup_c5_kaban_time2[0]);   // C-5-2

$pdf->Text(133, 181, $report->oup_tonbo_light_kbn1[0]);          // トンボ照明
$pdf->Text(145, 181, $report->oup_tonbo_light_joban_time1[0]);   // トンボ照明
$pdf->Text(167, 181, $report->oup_tonbo_light_kaban_time1[0]);   // トンボ照明

$pdf->Text(133, 187, $report->oup_tonbo_light_kbn2[0]);          // トンボ照明
$pdf->Text(145, 187, $report->oup_tonbo_light_joban_time2[0]);   // トンボ照明
$pdf->Text(167, 187, $report->oup_tonbo_light_kaban_time2[0]);   // トンボ照明

$pdf->Text(133, 199, $report->oup_c5_light_kbn1[0]);          // C5
$pdf->Text(145, 199, $report->oup_c5_light_joban_time1[0]);   // C5
$pdf->Text(167, 199, $report->oup_c5_light_kaban_time1[0]);   // C5

$pdf->Text(133, 206, $report->oup_c5_light_kbn2[0]);          // C5
$pdf->Text(145, 206, $report->oup_c5_light_joban_time2[0]);   // C5
$pdf->Text(167, 206, $report->oup_c5_light_kaban_time2[0]);   // C5

$pdf->Text(29, 216, $report->oup_patrol_time1[0]);   // 巡回1
$pdf->Text(50, 216, $report->oup_patrol_time2[0]);   // 巡回2
$pdf->Text(71, 216, $report->oup_patrol_time3[0]);   // 巡回3
$pdf->Text(92, 216, $report->oup_patrol_time4[0]);   // 巡回4
$pdf->Text(113, 216, $report->oup_patrol_time5[0]);   // 巡回5
$pdf->Text(134, 216, $report->oup_patrol_time6[0]);   // 巡回6
$pdf->Text(155, 216, $report->oup_patrol_time7[0]);   // 巡回7
$pdf->Text(176, 216, $report->oup_patrol_time8[0]);   // 巡回8
$pdf->Text(29, 227, $report->oup_patrol_time9[0]);   // 巡回1
$pdf->Text(50, 227, $report->oup_patrol_time10[0]);   // 巡回2
$pdf->Text(71, 227, $report->oup_patrol_time11[0]);   // 巡回3
$pdf->Text(92, 227, $report->oup_patrol_time12[0]);   // 巡回4
$pdf->Text(113, 227, $report->oup_patrol_time13[0]);   // 巡回5
$pdf->Text(134, 227, $report->oup_patrol_time14[0]);   // 巡回6
$pdf->Text(155, 227, $report->oup_patrol_time15[0]);   // 巡回7
$pdf->Text(176, 227, $report->oup_patrol_time16[0]);   // 巡回8

$pdf->MultiCell(70,25,$report->oup_wk_comment[0],0,'',0,1,24,237);     // 備考

$pdf->SetFont('kozminproregular', '', 10);// 日本語フォント

$pdf->Text(45, 265, $report->oup_wk_admin_end[0]);   // 巡回8
$pdf->Text(85, 265, $report->oup_wk_outsider[0]);   // 巡回8

$pdf->Text(102, 239, $kbn[$report->oup_wk_staff_id1_kbn[0]]);   // 巡回8
$pdf->Text(106, 239, $staffs[$report->oup_wk_staff_id1[0]]);   // 巡回8

$pdf->Text(133, 239, $kbn[$report->oup_wk_staff_id2_kbn[0]]);   // 巡回8
$pdf->Text(137, 239, $staffs[$report->oup_wk_staff_id2[0]]);   // 巡回8

$pdf->Text(165, 239, $kbn[$report->oup_wk_staff_id3_kbn[0]]);   // 巡回8
$pdf->Text(169, 239, $staffs[$report->oup_wk_staff_id3[0]]);   // 巡回8

$pdf->Text(102, 252, $kbn[$report->oup_wk_staff_id4_kbn[0]]);   // 巡回8
$pdf->Text(106, 252, $staffs[$report->oup_wk_staff_id4[0]]);   // 巡回8

$pdf->Text(133, 252, $kbn[$report->oup_wk_staff_id5_kbn[0]]);   // 巡回8
$pdf->Text(137, 252, $staffs[$report->oup_wk_staff_id5[0]]);   // 巡回8

$pdf->Text(165, 252, $kbn[$report->oup_wk_staff_id6_kbn[0]]);   // 巡回8
$pdf->Text(169, 252, $staffs[$report->oup_wk_staff_id6[0]]);   // 巡回8

$pdf->Text(102, 265, $kbn[$report->oup_wk_staff_id7_kbn[0]]);   // 巡回8
$pdf->Text(106, 265, $staffs[$report->oup_wk_staff_id7[0]]);   // 巡回8

$pdf->Text(133, 265, $kbn[$report->oup_wk_staff_id8_kbn[0]]);   // 巡回8
$pdf->Text(137, 265, $staffs[$report->oup_wk_staff_id8[0]]);   // 巡回8

$pdf->Text(165, 265, $kbn[$report->oup_wk_staff_id9_kbn[0]]);   // 巡回8
$pdf->Text(169, 265, $staffs[$report->oup_wk_staff_id9[0]]);   // 巡回8


$pdf->Output(sprintf("report7.pdf", time()), 'I');
?>
