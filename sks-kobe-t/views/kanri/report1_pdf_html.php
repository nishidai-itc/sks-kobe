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
$pdf->SetFont('kozminproregular', '', 11);// 日本語フォント

// テンプレート読み込み
$pdf->setSourceFile($common->rootpath.'/pdf/report1.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
//$wnen = intval($wnen) - 2018;
$pdf->Text(27, 35, $wnen);     // 年
$pdf->Text(43, 35, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(52, 35, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(63, 35, $weekday1);     // 曜日
$pdf->Text(76, 35, substr($report->oup_joban_time[0],0,2));     // 開始時間
$pdf->Text(87, 35, substr($report->oup_joban_time[0],3,2));     // 開始時間

$wnen = substr($report->oup_end_date[0],0,4);
$pdf->Text(27, 41, $wnen);     // 年
$pdf->Text(43, 41, substr($report->oup_end_date[0],5,2));     // 月
$pdf->Text(52, 41, substr($report->oup_end_date[0],8,2));     // 日
$pdf->Text(63, 41, $weekday2);     // 曜日
$pdf->Text(76, 41, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(87, 41, substr($report->oup_kaban_time[0],3,2));     // 終了時間


$pdf->Text(106, 38, $report->oup_weather1[0]);     // 天候
$pdf->Text(113, 38, $report->oup_weather2[0]);     // 天候

$pdf->Text(125, 38, $staffs[$report->oup_staff_id[0]]);     // 担当警備員

$pdf->Text(34, 62, $report->oup_wk_ship1[0]);                   // 入出港船舶
$pdf->Text(115, 62, $report->oup_wk_ship_in_port_time1[0]);     // 入出港船舶
$pdf->Text(150, 62, $report->oup_wk_ship_out_port_time1[0]);    // 入出港船舶

$pdf->Text(34, 68, $report->oup_wk_ship2[0]);                   // 入出港船舶
$pdf->Text(115, 68, $report->oup_wk_ship_in_port_time2[0]);     // 入出港船舶
$pdf->Text(150, 68, $report->oup_wk_ship_out_port_time2[0]);    // 入出港船舶

$pdf->Text(34, 74, $report->oup_wk_ship3[0]);                   // 入出港船舶
$pdf->Text(115, 74, $report->oup_wk_ship_in_port_time3[0]);     // 入出港船舶
$pdf->Text(150, 74, $report->oup_wk_ship_out_port_time3[0]);    // 入出港船舶

$pdf->Text(34, 80, $report->oup_wk_ship4[0]);                   // 入出港船舶
$pdf->Text(115, 80, $report->oup_wk_ship_in_port_time4[0]);     // 入出港船舶
$pdf->Text(150, 80, $report->oup_wk_ship_out_port_time4[0]);    // 入出港船舶

$pdf->Text(34, 86, $report->oup_wk_ship5[0]);                   // 入出港船舶
$pdf->Text(115, 86, $report->oup_wk_ship_in_port_time5[0]);     // 入出港船舶
$pdf->Text(150, 86, $report->oup_wk_ship_out_port_time5[0]);    // 入出港船舶

$pdf->Text(34, 92, $report->oup_wk_ship6[0]);                   // 入出港船舶
$pdf->Text(115, 92, $report->oup_wk_ship_in_port_time6[0]);     // 入出港船舶
$pdf->Text(150, 92, $report->oup_wk_ship_out_port_time6[0]);    // 入出港船舶

$pdf->Text(34, 98, $report->oup_wk_ship7[0]);                   // 入出港船舶
$pdf->Text(115, 98, $report->oup_wk_ship_in_port_time7[0]);     // 入出港船舶
$pdf->Text(150, 98, $report->oup_wk_ship_out_port_time7[0]);    // 入出港船舶

$pdf->Text(34, 104, $report->oup_wk_ship8[0]);                   // 入出港船舶
$pdf->Text(115, 104, $report->oup_wk_ship_in_port_time8[0]);     // 入出港船舶
$pdf->Text(150, 104, $report->oup_wk_ship_out_port_time8[0]);    // 入出港船舶

$pdf->Text(34, 110, $report->oup_wk_ship9[0]);                   // 入出港船舶
$pdf->Text(115, 110, $report->oup_wk_ship_in_port_time9[0]);     // 入出港船舶
$pdf->Text(150, 110, $report->oup_wk_ship_out_port_time9[0]);    // 入出港船舶

$pdf->Text(34, 116, $report->oup_wk_ship10[0]);                   // 入出港船舶
$pdf->Text(115, 116, $report->oup_wk_ship_in_port_time10[0]);     // 入出港船舶
$pdf->Text(150, 116, $report->oup_wk_ship_out_port_time10[0]);    // 入出港船舶

$pdf->Text(60, 122, $report->oup_wk_in_out_start_time[0]);     // 搬入出
$pdf->Text(90, 122, $report->oup_wk_in_out_end_time[0]);     // 搬入出

$pdf->Text(60, 128, $report->oup_wk_joban_time[0]);     // 構内作業
$pdf->Text(90, 128, $report->oup_wk_kaban_time[0]);     // 構内作業

$pdf->Text(170, 122, $report->oup_wk_vp_end_time[0]);     // VP終了

$pdf->Text(170, 128, $report->oup_wk_vp_kaban_time[0]);     // VP作業終了

$pdf->Text(71, 163, $report->oup_koyo_joban_time[0]);     // 甲陽運輸
$pdf->Text(90, 163, $report->oup_koyo_kaban_time[0]);     // 甲陽運輸

$pdf->Text(71, 169, $report->oup_sumii_joban_time[0]);     // 住井運輸
$pdf->Text(90, 169, $report->oup_sumii_kaban_time[0]);     // 住井運輸

$pdf->Text(164, 169, $report->oup_yard_on_time1[0]);        // ヤード照明1
$pdf->Text(184, 169, $report->oup_yard_off_time1[0]);       // ヤード照明1

$pdf->Text(164, 175, $report->oup_yard_on_time2[0]);        // ヤード照明2
$pdf->Text(184, 175, $report->oup_yard_off_time2[0]);       // ヤード照明2

$pdf->Text(71, 175, $report->oup_last_exit1[0]);     // 最終退出者
$pdf->Text(90, 175, $report->oup_last_exit2[0]);     // 最終退出者

$pdf->SetFont('kozminproregular', '', 9);// 日本語フォント
$pdf->Text(64, 187, $report->oup_depo_joban_time[0]);       // 早出①
$pdf->Text(81, 187, $report->oup_depo_kaban_time[0]);       // 早出①
$pdf->SetXY( 93, 187 );
$pdf->Cell(6, 6, $report->oup_depo_num[0], 0, 0, "R");      // 早出①
$pdf->SetXY( 108, 187 );
$pdf->Cell(6, 6, $report->oup_depo_zan[0], 0, 0, "R");      // 早出①

$pdf->Text(64, 193, $report->oup_sort_joban_time[0]);       // 早出②
$pdf->Text(81, 193, $report->oup_sort_kaban_time[0]);       // 早出②
$pdf->SetXY( 93, 193 );
$pdf->Cell(6, 6, $report->oup_sort_num[0], 0, 0, "R");      // 早出②
$pdf->SetXY( 108, 193 );
$pdf->Cell(6, 6, $report->oup_sort_zan[0], 0, 0, "R");      // 早出②

$pdf->Text(64, 199, $report->oup_cy_joban_time[0]);         // CY
$pdf->Text(81, 199, $report->oup_cy_kaban_time[0]);         // CY
$pdf->SetXY( 93, 199 );
$pdf->Cell(6, 6, $report->oup_cy_num[0], 0, 0, "R");        // CY
$pdf->SetXY( 108, 199 );
$pdf->Cell(6, 6, $report->oup_cy_zan[0], 0, 0, "R");        // CY

$pdf->Text(64, 205, $report->oup_exit_joban_time[0]);       // 白出口
$pdf->Text(81, 205, $report->oup_exit_kaban_time[0]);       // 白出口
$pdf->SetXY( 93, 205 );
$pdf->Cell(6, 6, $report->oup_exit_num[0], 0, 0, "R");      // 白出口
$pdf->SetXY( 108, 205 );
$pdf->Cell(6, 6, $report->oup_exit_zan[0], 0, 0, "R");      // 白出口

$pdf->Text(144, 187, $report->oup_vp_joban_time[0]);        // VP作業
$pdf->Text(160, 187, $report->oup_vp_kaban_time[0]);        // VP作業
$pdf->SetXY( 172, 187 );
$pdf->Cell(6, 6, $report->oup_vp_num[0], 0, 0, "R");        // VP作業
$pdf->SetXY( 188, 187 );
$pdf->Cell(6, 6, $report->oup_vp_zan[0], 0, 0, "R");        // VP作業

$pdf->Text(144, 193, $report->oup_midday_joban_time[0]);    // 昼作業
$pdf->Text(160, 193, $report->oup_midday_kaban_time[0]);    // 昼作業
$pdf->SetXY( 172, 193 );
$pdf->Cell(6, 6, $report->oup_midday_num[0], 0, 0, "R");    // 昼作業
$pdf->SetXY( 188, 193 );
$pdf->Cell(6, 6, $report->oup_midday_zan[0], 0, 0, "R");    // 昼作業

$pdf->Text(144, 199, $report->oup_gate_joban_time[0]);      // ゲート延長
$pdf->Text(160, 199, $report->oup_gate_kaban_time[0]);      // ゲート延長
$pdf->SetXY( 172, 199 );
$pdf->Cell(6, 6, $report->oup_gate_num[0], 0, 0, "R");      // ゲート延長
$pdf->SetXY( 188, 199 );
$pdf->Cell(6, 6, $report->oup_gate_zan[0], 0, 0, "R");      // ゲート延長

$pdf->Text(144, 205, $report->oup_mbath_joban_time[0]);     // Mバース
$pdf->Text(160, 205, $report->oup_mbath_kaban_time[0]);     // Mバース
$pdf->SetXY( 172, 205 );
$pdf->Cell(6, 6, $report->oup_mbath_num[0], 0, 0, "R");     // Mバース
$pdf->SetXY( 188, 205 );
$pdf->Cell(6, 6, $report->oup_mbath_zan[0], 0, 0, "R");     // Mバース

$pdf->Text(144, 211, $report->oup_picket_joban_time3[0]);   // 岸壁立哨
$pdf->Text(160, 211, $report->oup_picket_kaban_time3[0]);   // 岸壁立哨
$pdf->SetXY( 172, 211 );
$pdf->Cell(6, 6, $report->oup_picket_num3[0], 0, 0, "R");   // 岸壁立哨
$pdf->SetXY( 188, 211 );
$pdf->Cell(6, 6, $report->oup_picket_zan3[0], 0, 0, "R");   // 岸壁立哨

$pdf->Text(144, 217, $report->oup_picket_joban_time2[0]);   // 岸壁立哨
$pdf->Text(160, 217, $report->oup_picket_kaban_time2[0]);   // 岸壁立哨
$pdf->SetXY( 172, 217 );
$pdf->Cell(6, 6, $report->oup_picket_num2[0], 0, 0, "R");   // 岸壁立哨
$pdf->SetXY( 188, 217 );
$pdf->Cell(6, 6, $report->oup_picket_zan2[0], 0, 0, "R");   // 岸壁立哨

$pdf->Text(64, 211, $report->oup_picket_joban_time1[0]);    // T字立哨
$pdf->Text(81, 211, $report->oup_picket_kaban_time1[0]);    // T字立哨
$pdf->SetXY( 93, 211 );
$pdf->Cell(6, 6, $report->oup_picket_num1[0], 0, 0, "R");   // T字立哨
$pdf->SetXY( 108, 211 );
$pdf->Cell(6, 6, $report->oup_picket_zan1[0], 0, 0, "R");   // T字立哨

$pdf->Text(64, 217, $report->oup_picket_joban_time4[0]);    // 分別立哨
$pdf->Text(81, 217, $report->oup_picket_kaban_time4[0]);    // 分別立哨
$pdf->SetXY( 93, 217 );
$pdf->Cell(6, 6, $report->oup_picket_num4[0], 0, 0, "R");   // 分別立哨
$pdf->SetXY( 108, 217 );
$pdf->Cell(6, 6, $report->oup_picket_zan4[0], 0, 0, "R");   // 分別立哨

$pdf->SetFont('kozminproregular', '', 11);// 日本語フォント
$pdf->MultiCell(155,28,$report->oup_comment[0],0,'',0,1,32,223);     // 備考

$pdf->SetXY( 44, 250 );
$pdf->Cell(6, 6, $report->oup_meterb1[0], 0, 0, "R");       // 水道メーター
$pdf->SetXY( 44, 260 );
$pdf->Cell(6, 6, $report->oup_meterb2[0], 0, 0, "R");       // 水道メーター
$pdf->SetXY( 77, 250 );
$pdf->Cell(6, 6, $report->oup_meterc1[0], 0, 0, "R");       // 水道メーター
$pdf->SetXY( 77, 260 );
$pdf->Cell(6, 6, $report->oup_meterc2[0], 0, 0, "R");       // 水道メーター

$pdf->MultiCell(155,28,$report->oup_wk_comment[0],0,'',0,1,32,270);     // コメント

$pdf->SetFont('kozminproregular', '', 9);// 日本語フォント

$pdf->Text(122, 233, $staffs[$report->oup_wk_staff_id1[0]]);    // 担当警備員
$pdf->Text(117, 229, $report->oup_wk_staff1_zan1[0]);           // 
$pdf->Text(117, 233, $report->oup_wk_staff1_zan2[0]);           // 
if ($report->oup_wk_staff1_zan3[0]=="昼") {
    $report->oup_wk_staff1_zan3[0] = "・";
}
$pdf->Text(138, 229, $report->oup_wk_staff1_zan3[0]);           // 
$pdf->Text(122, 229, $report->oup_wk_staff1_kbn[0]);            // 

$pdf->Text(151, 233, $staffs[$report->oup_wk_staff_id2[0]]);    // 担当警備員
$pdf->Text(146, 229, $report->oup_wk_staff2_zan1[0]);           // 
$pdf->Text(146, 233, $report->oup_wk_staff2_zan2[0]);           // 
if ($report->oup_wk_staff2_zan3[0]=="昼") {
    $report->oup_wk_staff2_zan3[0] = "・";
}
$pdf->Text(167, 229, $report->oup_wk_staff2_zan3[0]);           // 
$pdf->Text(151, 229, $report->oup_wk_staff2_kbn[0]);            // 

$pdf->Text(180, 233, $staffs[$report->oup_wk_staff_id3[0]]);    // 担当警備員
$pdf->Text(175, 229, $report->oup_wk_staff3_zan1[0]);           // 
$pdf->Text(175, 233, $report->oup_wk_staff3_zan2[0]);           // 
if ($report->oup_wk_staff3_zan3[0]=="昼") {
    $report->oup_wk_staff3_zan3[0] = "・";
}
$pdf->Text(196, 229, $report->oup_wk_staff3_zan3[0]);           // 
$pdf->Text(180, 229, $report->oup_wk_staff3_kbn[0]);            // 

$pdf->Text(122, 242, $staffs[$report->oup_wk_staff_id4[0]]);    // 担当警備員
$pdf->Text(117, 238, $report->oup_wk_staff4_zan1[0]);           // 
$pdf->Text(117, 242, $report->oup_wk_staff4_zan2[0]);           // 
if ($report->oup_wk_staff4_zan3[0]=="昼") {
    $report->oup_wk_staff4_zan3[0] = "・";
}
$pdf->Text(138, 238, $report->oup_wk_staff4_zan3[0]);           // 
$pdf->Text(122, 238, $report->oup_wk_staff4_kbn[0]);            // 

$pdf->Text(151, 242, $staffs[$report->oup_wk_staff_id5[0]]);    // 担当警備員
$pdf->Text(146, 238, $report->oup_wk_staff5_zan1[0]);           // 
$pdf->Text(146, 242, $report->oup_wk_staff5_zan2[0]);           // 
if ($report->oup_wk_staff5_zan3[0]=="昼") {
    $report->oup_wk_staff5_zan3[0] = "・";
}
$pdf->Text(167, 238, $report->oup_wk_staff5_zan3[0]);           // 
$pdf->Text(151, 238, $report->oup_wk_staff5_kbn[0]);            // 

$pdf->Text(180, 242, $staffs[$report->oup_wk_staff_id6[0]]);    // 担当警備員
$pdf->Text(175, 238, $report->oup_wk_staff6_zan1[0]);           // 
$pdf->Text(175, 242, $report->oup_wk_staff6_zan2[0]);           // 
if ($report->oup_wk_staff6_zan3[0]=="昼") {
    $report->oup_wk_staff6_zan3[0] = "・";
}
$pdf->Text(196, 238, $report->oup_wk_staff6_zan3[0]);           // 
$pdf->Text(180, 238, $report->oup_wk_staff6_kbn[0]);            // 

$pdf->Text(122, 251, $staffs[$report->oup_wk_staff_id7[0]]);    // 担当警備員
$pdf->Text(117, 247, $report->oup_wk_staff7_zan1[0]);           // 
$pdf->Text(117, 251, $report->oup_wk_staff7_zan2[0]);           // 
if ($report->oup_wk_staff7_zan3[0]=="昼") {
    $report->oup_wk_staff7_zan3[0] = "・";
}
$pdf->Text(138, 247, $report->oup_wk_staff7_zan3[0]);           // 
$pdf->Text(122, 247, $report->oup_wk_staff7_kbn[0]);            // 

$pdf->Text(151, 251, $staffs[$report->oup_wk_staff_id8[0]]);    // 担当警備員
$pdf->Text(146, 247, $report->oup_wk_staff8_zan1[0]);           // 
$pdf->Text(146, 251, $report->oup_wk_staff8_zan2[0]);           // 
if ($report->oup_wk_staff8_zan3[0]=="昼") {
    $report->oup_wk_staff8_zan3[0] = "・";
}
$pdf->Text(167, 247, $report->oup_wk_staff8_zan3[0]);           // 
$pdf->Text(151, 247, $report->oup_wk_staff8_kbn[0]);            // 

$pdf->Text(180, 251, $staffs[$report->oup_wk_staff_id9[0]]);    // 担当警備員
$pdf->Text(175, 247, $report->oup_wk_staff9_zan1[0]);           // 
$pdf->Text(175, 251, $report->oup_wk_staff9_zan2[0]);           // 
if ($report->oup_wk_staff9_zan3[0]=="昼") {
    $report->oup_wk_staff9_zan3[0] = "・";
}
$pdf->Text(196, 247, $report->oup_wk_staff9_zan3[0]);           // 
$pdf->Text(180, 247, $report->oup_wk_staff9_kbn[0]);            // 

$pdf->Text(122, 259, $staffs[$report->oup_wk_staff_id10[0]]);    // 担当警備員
$pdf->Text(117, 255, $report->oup_wk_staff10_zan1[0]);           // 
$pdf->Text(117, 259, $report->oup_wk_staff10_zan2[0]);           // 
if ($report->oup_wk_staff10_zan3[0]=="昼") {
    $report->oup_wk_staff10_zan3[0] = "・";
}
$pdf->Text(138, 255, $report->oup_wk_staff10_zan3[0]);           // 
$pdf->Text(122, 255, $report->oup_wk_staff10_kbn[0]);            // 

$pdf->Text(151, 259, $staffs[$report->oup_wk_staff_id11[0]]);    // 担当警備員
$pdf->Text(146, 255, $report->oup_wk_staff11_zan1[0]);           // 
$pdf->Text(146, 259, $report->oup_wk_staff11_zan2[0]);           // 
if ($report->oup_wk_staff11_zan3[0]=="昼") {
    $report->oup_wk_staff11_zan3[0] = "・";
}
$pdf->Text(167, 255, $report->oup_wk_staff11_zan3[0]);           // 
$pdf->Text(151, 255, $report->oup_wk_staff11_kbn[0]);            // 

$pdf->Text(180, 259, $staffs[$report->oup_wk_staff_id12[0]]);    // 担当警備員
$pdf->Text(175, 255, $report->oup_wk_staff12_zan1[0]);           // 
$pdf->Text(175, 259, $report->oup_wk_staff12_zan2[0]);           // 
if ($report->oup_wk_staff12_zan3[0]=="昼") {
    $report->oup_wk_staff12_zan3[0] = "・";
}
$pdf->Text(196, 255, $report->oup_wk_staff12_zan3[0]);           // 
$pdf->Text(180, 255, $report->oup_wk_staff12_kbn[0]);            // 

$pdf->Text(122, 267, $staffs[$report->oup_wk_staff_id13[0]]);    // 担当警備員
$pdf->Text(117, 263, $report->oup_wk_staff13_zan1[0]);           // 
$pdf->Text(117, 267, $report->oup_wk_staff13_zan2[0]);           // 
if ($report->oup_wk_staff13_zan3[0]=="昼") {
    $report->oup_wk_staff13_zan3[0] = "・";
}
$pdf->Text(138, 263, $report->oup_wk_staff13_zan3[0]);           // 
$pdf->Text(122, 263, $report->oup_wk_staff13_kbn[0]);            // 

$pdf->Text(151, 267, $staffs[$report->oup_wk_staff_id14[0]]);    // 担当警備員
$pdf->Text(146, 263, $report->oup_wk_staff14_zan1[0]);           // 
$pdf->Text(146, 267, $report->oup_wk_staff14_zan2[0]);           // 
if ($report->oup_wk_staff14_zan3[0]=="昼") {
    $report->oup_wk_staff14_zan3[0] = "・";
}
$pdf->Text(167, 263, $report->oup_wk_staff14_zan3[0]);           // 
$pdf->Text(151, 263, $report->oup_wk_staff14_kbn[0]);            // 

$pdf->Text(180, 267, $staffs[$report->oup_wk_staff_id15[0]]);    // 担当警備員
$pdf->Text(175, 263, $report->oup_wk_staff15_zan1[0]);           // 
$pdf->Text(175, 267, $report->oup_wk_staff15_zan2[0]);           // 
if ($report->oup_wk_staff15_zan3[0]=="昼") {
    $report->oup_wk_staff15_zan3[0] = "・";
}
$pdf->Text(196, 263, $report->oup_wk_staff15_zan3[0]);           // 
$pdf->Text(180, 263, $report->oup_wk_staff15_kbn[0]);            // 

$pdf->Text(122, 275, $staffs[$report->oup_wk_staff_id16[0]]);    // 担当警備員
$pdf->Text(117, 271, $report->oup_wk_staff16_zan1[0]);           // 
$pdf->Text(117, 275, $report->oup_wk_staff16_zan2[0]);           // 
if ($report->oup_wk_staff16_zan3[0]=="昼") {
    $report->oup_wk_staff16_zan3[0] = "・";
}
$pdf->Text(138, 271, $report->oup_wk_staff16_zan3[0]);           // 
$pdf->Text(122, 271, $report->oup_wk_staff16_kbn[0]);            // 

$pdf->Text(151, 275, $staffs[$report->oup_wk_staff_id17[0]]);    // 担当警備員
$pdf->Text(146, 271, $report->oup_wk_staff17_zan1[0]);           // 
$pdf->Text(146, 275, $report->oup_wk_staff17_zan2[0]);           // 
if ($report->oup_wk_staff17_zan3[0]=="昼") {
    $report->oup_wk_staff17_zan3[0] = "・";
}
$pdf->Text(167, 271, $report->oup_wk_staff17_zan3[0]);           // 
$pdf->Text(151, 271, $report->oup_wk_staff17_kbn[0]);            // 

$pdf->Text(180, 275, $staffs[$report->oup_wk_staff_id18[0]]);    // 担当警備員
$pdf->Text(175, 271, $report->oup_wk_staff18_zan1[0]);           // 
$pdf->Text(175, 275, $report->oup_wk_staff18_zan2[0]);           // 
if ($report->oup_wk_staff18_zan3[0]=="昼") {
    $report->oup_wk_staff18_zan3[0] = "・";
}
$pdf->Text(196, 271, $report->oup_wk_staff18_zan3[0]);           // 
$pdf->Text(180, 271, $report->oup_wk_staff18_kbn[0]);            // 


if ($report->oup_etc_comment[0] != "") {
    // 2ページ目

    // テンプレート読み込み
    $pdf->setSourceFile($common->rootpath.'/pdf/report1_1.pdf');

    $pdf->AddPage('P', 'A4');
    $pdf->useTemplate($pdf->importPage(1));
    $pdf->SetFont('kozminproregular', '', 11);// 日本語フォント

    // 和暦
    $wnen = substr($report->oup_start_date[0],0,4);
    //$wnen = intval($wnen) - 2018;
    $pdf->Text(27, 35, $wnen);     // 年
    $pdf->Text(43, 35, substr($report->oup_start_date[0],5,2));     // 月
    $pdf->Text(52, 35, substr($report->oup_start_date[0],8,2));     // 日
    $pdf->Text(63, 35, $weekday1);     // 曜日
    $pdf->Text(76, 35, substr($report->oup_joban_time[0],0,2));     // 開始時間
    $pdf->Text(87, 35, substr($report->oup_joban_time[0],3,2));     // 開始時間

    $wnen = substr($report->oup_end_date[0],0,4);
    $pdf->Text(27, 41, $wnen);     // 年
    $pdf->Text(43, 41, substr($report->oup_end_date[0],5,2));     // 月
    $pdf->Text(52, 41, substr($report->oup_end_date[0],8,2));     // 日
    $pdf->Text(63, 41, $weekday2);     // 曜日
    $pdf->Text(76, 41, substr($report->oup_kaban_time[0],0,2));     // 終了時間
    $pdf->Text(87, 41, substr($report->oup_kaban_time[0],3,2));     // 終了時間

    // $pdf->Text(106, 38, $report->oup_weather1[0]);     // 天候
    // $pdf->Text(113, 38, $report->oup_weather2[0]);     // 天候

    $pdf->Text(125, 38, $staffs[$report->oup_staff_id[0]]);     // 担当警備員

    $pdf->SetFontSize(14);
    $pdf->setCellHeightRatio(2.5);
    $pdf->MultiCell(180,50,$report->oup_etc_comment[0],0,'',0,1,16,50);     // コメント
}

if ($_GET["act"] && $_GET["act"] == "mail") {
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,6).".pdf", time()), 'F');

    require_once('../../mailset.php');

    echo json_encode(true);
    exit;
} else {
    $pdf->Output(sprintf("report1.pdf", time()), 'I');
}
?>
