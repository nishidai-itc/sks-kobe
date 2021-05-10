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

    $ken[1] = "研";

require_once('../../tcpdf/tcpdf.php');
require_once('../../fpdf/src/autoload.php');

use setasign\Fpdi\TcpdfFpdi;

$pdf = new TcpdfFpdi();
$pdf->SetMargins(0, 0, 0);
$pdf->SetCellPadding(0);
$pdf->SetAutoPageBreak(false);
$pdf->setPrintHeader(false);    
$pdf->setPrintFooter(false);
$pdf->SetFont('kozminproregular', '', 11);// 日本語フォント

// テンプレート読み込み
$pdf->setSourceFile($common->rootpath.'/pdf/report5.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(32, 35, $wnen);     // 年
$pdf->Text(47, 35, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(58, 35, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(71, 35, $weekday1);     // 曜日
$pdf->Text(87, 35, substr($report->oup_joban_time[0],0,2));     // 開始時間
$pdf->Text(98, 35, substr($report->oup_joban_time[0],3,2));     // 開始時間

$wnen = substr($report->oup_end_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(32, 42, $wnen);     // 年
$pdf->Text(47, 42, substr($report->oup_end_date[0],5,2));     // 月
$pdf->Text(58, 42, substr($report->oup_end_date[0],8,2));     // 日
$pdf->Text(71, 42, $weekday2);     // 曜日
$pdf->Text(87, 42, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(98, 42, substr($report->oup_kaban_time[0],3,2));     // 終了時間

$pdf->Text(114, 41, $report->oup_weather1[0]);     // 天候
$pdf->Text(120, 41, $report->oup_weather2[0]);     // 天候

$pdf->Text(130, 41, $staffs[$report->oup_staff_id[0]]);     // 報告者

$pdf->Text(35, 59, $report->oup_ship1[0]);                  // 入出港1
$pdf->Text(83, 59, $report->oup_ship_in_port_time1[0]);     // 入出港1
$pdf->Text(108, 59, $report->oup_ship_out_port_time1[0]);   // 入出港1

$pdf->Text(35, 65, $report->oup_ship2[0]);                  // 入出港2
$pdf->Text(83, 65, $report->oup_ship_in_port_time2[0]);     // 入出港2
$pdf->Text(108, 65, $report->oup_ship_out_port_time2[0]);   // 入出港2

$pdf->Text(35, 71, $report->oup_ship3[0]);                  // 入出港3
$pdf->Text(83, 71, $report->oup_ship_in_port_time3[0]);     // 入出港3
$pdf->Text(108, 71, $report->oup_ship_out_port_time3[0]);   // 入出港3

$pdf->Text(35, 77, $report->oup_ship4[0]);                  // 入出港4
$pdf->Text(83, 77, $report->oup_ship_in_port_time4[0]);     // 入出港4
$pdf->Text(108, 77, $report->oup_ship_out_port_time4[0]);   // 入出港4

$pdf->Text(35, 82, $report->oup_ship5[0]);                  // 入出港5
$pdf->Text(83, 82, $report->oup_ship_in_port_time5[0]);     // 入出港5
$pdf->Text(108, 82, $report->oup_ship_out_port_time5[0]);   // 入出港5

$pdf->Text(35, 88, $report->oup_ship6[0]);                  // 入出港6
$pdf->Text(83, 88, $report->oup_ship_in_port_time6[0]);     // 入出港6
$pdf->Text(108, 88, $report->oup_ship_out_port_time6[0]);   // 入出港6

$pdf->Text(77, 98, $report->oup_picket_joban_time1[0]);    // C-4ゲート立哨
$pdf->Text(108, 98, $report->oup_picket_kaban_time1[0]);   // C-4ゲート立哨

$pdf->Text(77, 104, $report->oup_picket_joban_time2[0]);    // 車サブゲート立哨
$pdf->Text(108, 104, $report->oup_picket_kaban_time2[0]);   // 車サブゲート立哨

$pdf->Text(77, 110, $report->oup_picket_joban_time3[0]);    // 搬入出車両
$pdf->Text(108, 110, $report->oup_picket_kaban_time3[0]);   // 搬入出車両

$pdf->MultiCell(105,30,$report->oup_comment[0],0,'',0,1,22,180);     // 備考

$pdf->Text(133, 65, $report->oup_c2_kbn1[0]);           // C-2-1
$pdf->Text(145, 65, $report->oup_c2_joban_time1[0]);    // C-2-1
$pdf->Text(167, 65, $report->oup_c2_kaban_time1[0]);    // C-2-1

$pdf->Text(133, 71, $report->oup_c2_kbn2[0]);           // C-2-2
$pdf->Text(145, 71, $report->oup_c2_joban_time2[0]);    // C-2-2
$pdf->Text(167, 71, $report->oup_c2_kaban_time2[0]);    // C-2-2

$pdf->Text(133, 76, $report->oup_c2_kbn3[0]);           // C-2-3
$pdf->Text(145, 76, $report->oup_c2_joban_time3[0]);    // C-2-3
$pdf->Text(167, 76, $report->oup_c2_kaban_time3[0]);    // C-2-3

$pdf->Text(133, 82, $report->oup_c2_kbn4[0]);           // C-2-4
$pdf->Text(145, 82, $report->oup_c2_joban_time4[0]);    // C-2-4
$pdf->Text(167, 82, $report->oup_c2_kaban_time4[0]);    // C-2-4

$pdf->Text(133, 91, $report->oup_c3_kbn1[0]);          // C-3-1
$pdf->Text(145, 91, $report->oup_c3_joban_time1[0]);   // C-3-1
$pdf->Text(167, 91, $report->oup_c3_kaban_time1[0]);   // C-3-1

$pdf->Text(133, 97, $report->oup_c3_kbn2[0]);          // C-3-2
$pdf->Text(145, 97, $report->oup_c3_joban_time2[0]);   // C-3-2
$pdf->Text(167, 97, $report->oup_c3_kaban_time2[0]);   // C-3-2

$pdf->Text(133, 103, $report->oup_c3_kbn3[0]);          // C-3-3
$pdf->Text(145, 103, $report->oup_c3_joban_time3[0]);   // C-3-3
$pdf->Text(167, 103, $report->oup_c3_kaban_time3[0]);   // C-3-3W

$pdf->Text(133, 109, $report->oup_c3_kbn4[0]);          // C-3-4
$pdf->Text(145, 109, $report->oup_c3_joban_time4[0]);   // C-3-4
$pdf->Text(167, 109, $report->oup_c3_kaban_time4[0]);   // C-3-4

$pdf->Text(133, 118, $report->oup_c4_kbn1[0]);          // C-4-1
$pdf->Text(145, 118, $report->oup_c4_joban_time1[0]);   // C-4-1
$pdf->Text(167, 118, $report->oup_c4_kaban_time1[0]);   // C-4-1

$pdf->Text(133, 125, $report->oup_c4_kbn2[0]);          // C-4-2
$pdf->Text(145, 125, $report->oup_c4_joban_time2[0]);   // C-4-2
$pdf->Text(167, 125, $report->oup_c4_kaban_time2[0]);   // C-4-2

$pdf->Text(133, 131, $report->oup_c4_kbn3[0]);          // C-4-3
$pdf->Text(145, 131, $report->oup_c4_joban_time3[0]);   // C-4-3
$pdf->Text(167, 131, $report->oup_c4_kaban_time3[0]);   // C-4-3

$pdf->Text(133, 137, $report->oup_c4_kbn4[0]);          // C-4-4
$pdf->Text(145, 137, $report->oup_c4_joban_time4[0]);   // C-4-4
$pdf->Text(167, 137, $report->oup_c4_kaban_time4[0]);   // C-4-4

$pdf->Text(133, 146, $report->oup_c5_kbn1[0]);          // C-5-1
$pdf->Text(145, 146, $report->oup_c5_joban_time1[0]);   // C-5-1
$pdf->Text(167, 146, $report->oup_c5_kaban_time1[0]);   // C-5-1

$pdf->Text(133, 152, $report->oup_c5_kbn2[0]);          // C-5-2
$pdf->Text(145, 152, $report->oup_c5_joban_time2[0]);   // C-5-2
$pdf->Text(167, 152, $report->oup_c5_kaban_time2[0]);   // C-5-2

$pdf->Text(133, 157, $report->oup_c5_kbn3[0]);          // C-5-3
$pdf->Text(145, 157, $report->oup_c5_joban_time3[0]);   // C-5-3
$pdf->Text(167, 157, $report->oup_c5_kaban_time3[0]);   // C-5-3

$pdf->Text(133, 162, $report->oup_c5_kbn4[0]);          // C-5-4
$pdf->Text(145, 162, $report->oup_c5_joban_time4[0]);   // C-5-4
$pdf->Text(167, 162, $report->oup_c5_kaban_time4[0]);   // C-5-4

$pdf->Text(133, 173, $report->oup_tonbo_light_kbn1[0]);          // トンボ照明
$pdf->Text(145, 173, $report->oup_tonbo_light_joban_time1[0]);   // トンボ照明
$pdf->Text(167, 173, $report->oup_tonbo_light_kaban_time1[0]);   // トンボ照明

$pdf->Text(133, 179, $report->oup_tonbo_light_kbn2[0]);          // トンボ照明
$pdf->Text(145, 179, $report->oup_tonbo_light_joban_time2[0]);   // トンボ照明
$pdf->Text(167, 179, $report->oup_tonbo_light_kaban_time2[0]);   // トンボ照明

$pdf->Text(133, 185, $report->oup_tonbo_light_kbn3[0]);          // トンボ照明
$pdf->Text(145, 185, $report->oup_tonbo_light_joban_time3[0]);   // トンボ照明
$pdf->Text(167, 185, $report->oup_tonbo_light_kaban_time3[0]);   // トンボ照明

$pdf->Text(133, 191, $report->oup_tonbo_light_kbn4[0]);          // トンボ照明
$pdf->Text(145, 191, $report->oup_tonbo_light_joban_time4[0]);   // トンボ照明
$pdf->Text(167, 191, $report->oup_tonbo_light_kaban_time4[0]);   // トンボ照明

$pdf->Text(133, 200, $report->oup_c5_light_kbn1[0]);          // C5
$pdf->Text(145, 200, $report->oup_c5_light_joban_time1[0]);   // C5
$pdf->Text(167, 200, $report->oup_c5_light_kaban_time1[0]);   // C5

$pdf->Text(133, 207, $report->oup_c5_light_kbn2[0]);          // C5
$pdf->Text(145, 207, $report->oup_c5_light_joban_time2[0]);   // C5
$pdf->Text(167, 207, $report->oup_c5_light_kaban_time2[0]);   // C5

$pdf->Text(133, 213, $report->oup_c5_light_kbn3[0]);          // C5
$pdf->Text(145, 213, $report->oup_c5_light_joban_time3[0]);   // C5
$pdf->Text(167, 213, $report->oup_c5_light_kaban_time3[0]);   // C5

$pdf->Text(133, 219, $report->oup_c5_light_kbn4[0]);          // C5
$pdf->Text(145, 219, $report->oup_c5_light_joban_time4[0]);   // C5
$pdf->Text(167, 219, $report->oup_c5_light_kaban_time4[0]);   // C5

$pdf->Text(29, 226, $report->oup_patrol_time1[0]);   // 巡回1
$pdf->Text(50, 226, $report->oup_patrol_time2[0]);   // 巡回2
$pdf->Text(71, 226, $report->oup_patrol_time3[0]);   // 巡回3
$pdf->Text(92, 226, $report->oup_patrol_time4[0]);   // 巡回4
$pdf->Text(113, 226, $report->oup_patrol_time5[0]);   // 巡回5
$pdf->Text(134, 226, $report->oup_patrol_time6[0]);   // 巡回6
$pdf->Text(155, 226, $report->oup_patrol_time7[0]);   // 巡回7
$pdf->Text(176, 226, $report->oup_patrol_time8[0]);   // 巡回8
$pdf->Text(29, 235, $report->oup_patrol_time9[0]);   // 巡回1
$pdf->Text(50, 235, $report->oup_patrol_time10[0]);   // 巡回2
$pdf->Text(71, 235, $report->oup_patrol_time11[0]);   // 巡回3
$pdf->Text(92, 235, $report->oup_patrol_time12[0]);   // 巡回4
$pdf->Text(113, 235, $report->oup_patrol_time13[0]);   // 巡回5
$pdf->Text(134, 235, $report->oup_patrol_time14[0]);   // 巡回6
$pdf->Text(155, 235, $report->oup_patrol_time15[0]);   // 巡回7
$pdf->Text(176, 235, $report->oup_patrol_time16[0]);   // 巡回8

$pdf->MultiCell(70,25,$report->oup_wk_comment[0],0,'',0,1,24,243);     // 備考

$pdf->SetFont('kozminproregular', '', 10);// 日本語フォント

$pdf->Text(45, 271, $report->oup_wk_admin_end[0]);   // 巡回8
$pdf->Text(85, 271, $report->oup_wk_outsider[0]);   // 巡回8

$pdf->Text(102, 244, $kbn[$report->oup_wk_staff_id1_kbn[0]]);   // 巡回8
$pdf->Text(106, 244, $staffs[$report->oup_wk_staff_id1[0]]);   // 巡回8
$pdf->Text(120, 249, $ken[$report->oup_wk_staff_id1_ken[0]]);   // 研

$pdf->Text(133, 244, $kbn[$report->oup_wk_staff_id2_kbn[0]]);   // 巡回8
$pdf->Text(137, 244, $staffs[$report->oup_wk_staff_id2[0]]);   // 巡回8
$pdf->Text(151, 249, $ken[$report->oup_wk_staff_id2_ken[0]]);   // 研

$pdf->Text(165, 244, $kbn[$report->oup_wk_staff_id3_kbn[0]]);   // 巡回8
$pdf->Text(169, 244, $staffs[$report->oup_wk_staff_id3[0]]);   // 巡回8
$pdf->Text(183, 249, $ken[$report->oup_wk_staff_id3_ken[0]]);   // 研

$pdf->Text(102, 257, $kbn[$report->oup_wk_staff_id4_kbn[0]]);   // 巡回8
$pdf->Text(106, 257, $staffs[$report->oup_wk_staff_id4[0]]);   // 巡回8
$pdf->Text(120, 262, $ken[$report->oup_wk_staff_id4_ken[0]]);   // 研

$pdf->Text(133, 257, $kbn[$report->oup_wk_staff_id5_kbn[0]]);   // 巡回8
$pdf->Text(137, 257, $staffs[$report->oup_wk_staff_id5[0]]);   // 巡回8
$pdf->Text(151, 262, $ken[$report->oup_wk_staff_id5_ken[0]]);   // 研

$pdf->Text(165, 257, $kbn[$report->oup_wk_staff_id6_kbn[0]]);   // 巡回8
$pdf->Text(169, 257, $staffs[$report->oup_wk_staff_id6[0]]);   // 巡回8
$pdf->Text(183, 262, $ken[$report->oup_wk_staff_id6_ken[0]]);   // 研

$pdf->Text(102, 269, $kbn[$report->oup_wk_staff_id7_kbn[0]]);   // 巡回8
$pdf->Text(106, 269, $staffs[$report->oup_wk_staff_id7[0]]);   // 巡回8
$pdf->Text(120, 274, $ken[$report->oup_wk_staff_id7_ken[0]]);   // 研

$pdf->Text(133, 269, $kbn[$report->oup_wk_staff_id8_kbn[0]]);   // 巡回8
$pdf->Text(137, 269, $staffs[$report->oup_wk_staff_id8[0]]);   // 巡回8
$pdf->Text(151, 274, $ken[$report->oup_wk_staff_id8_ken[0]]);   // 研

$pdf->Text(165, 269, $kbn[$report->oup_wk_staff_id9_kbn[0]]);   // 巡回8
$pdf->Text(169, 269, $staffs[$report->oup_wk_staff_id9[0]]);   // 巡回8
$pdf->Text(183, 274, $ken[$report->oup_wk_staff_id9_ken[0]]);   // 研

if ($_GET["act"] && $_GET["act"] == "mail") {
    // $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/三菱倉庫C4_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');

    echo json_encode("三菱倉庫C4_".substr($report->oup_no[0],0,8)." ".date("H:i:s"));
    exit;
} else {
    $pdf->Output(sprintf("report5.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report5.pdf", time()), 'I');
?>
