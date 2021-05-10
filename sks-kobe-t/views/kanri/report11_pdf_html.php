<?php 
    ob_end_clean();

    $week = array("日", "月", "火", "水", "木", "金", "土");
    $time = strtotime(date($report->oup_start_date[0]));
    $w = date("w", $time);
    $weekday1 = $week[$w];

    $time = strtotime(date($report->oup_end_date[0]));
    $w = date("w", $time);
    $weekday2 = $week[$w];

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
$pdf->SetFont('kozminproregular', '', 12);// 日本語フォント

// テンプレート読み込み
$pdf->setSourceFile($common->rootpath.'/pdf/report11.pdf');

// 用紙サイズ
$pdf->AddPage('P', 'A4');
$pdf->useTemplate($pdf->importPage(1));
// フォント設定 - IPA明朝
//$tcpdf_fonts = new TCPDF_FONTS();
//$font = $tcpdf_fonts->addTTFfont('tcpdf/fonts/ipam.ttf');


// 和暦
$wnen = substr($report->oup_start_date[0],0,4);
$wnen = intval($wnen) - 2018;
$pdf->SetFont('kozminproregular', '', 9);// 日本語フォント
$pdf->Text(26, 47, "令和".$wnen);     // 年
$pdf->SetFont('kozminproregular', '', 12);// 日本語フォント
$pdf->Text(44, 46, substr($report->oup_start_date[0],5,2));     // 月
$pdf->Text(58, 46, substr($report->oup_start_date[0],8,2));     // 日
$pdf->Text(73, 46, $weekday1);     // 曜日
$pdf->Text(86, 46, substr($report->oup_joban_time[0],0,2));     // 開始時間
$pdf->Text(97, 46, substr($report->oup_joban_time[0],3,2));     // 開始時間

$wnen = substr($report->oup_end_date[0],0,4);
$wnen = intval($wnen) - 2018;
$pdf->SetFont('kozminproregular', '', 9);// 日本語フォント
$pdf->Text(26, 56, "令和".$wnen);     // 年
$pdf->SetFont('kozminproregular', '', 12);// 日本語フォント
$pdf->Text(44, 55, substr($report->oup_end_date[0],5,2));     // 月
$pdf->Text(58, 55, substr($report->oup_end_date[0],8,2));     // 日
$pdf->Text(73, 55, $weekday2);     // 曜日
$pdf->Text(86, 55, substr($report->oup_kaban_time[0],0,2));     // 終了時間
$pdf->Text(97, 55, substr($report->oup_kaban_time[0],3,2));     // 終了時間

$pdf->Text(113, 52, $report->oup_weather1[0]);     // 天候
$pdf->Text(120, 52, $report->oup_weather2[0]);     // 天候

$pdf->Text(140, 50, $staffs[$report->oup_staff_id[0]]);     // 担当警備員

$pdf->Text(24, 72, $report->oup_patrol_time1[0]);       // 巡回1
$pdf->Text(43, 72, $report->oup_bath1[0]);              // バース1
$pdf->Text(65, 72, $report->oup_sip1[0]);               // 本船名1
$pdf->Text(159, 72, $report->oup_in_port_time1[0]);     // 入港1
$pdf->Text(180, 72, $report->oup_out_port_time1[0]);    // 出港1

$pdf->Text(24, 81, $report->oup_patrol_time2[0]);       // 巡回2
$pdf->Text(43, 81, $report->oup_bath2[0]);              // バース2
$pdf->Text(65, 81, $report->oup_sip2[0]);               // 本船名2
$pdf->Text(159, 81, $report->oup_in_port_time2[0]);     // 入港2
$pdf->Text(180, 81, $report->oup_out_port_time2[0]);    // 出港2

$pdf->Text(24, 90, $report->oup_patrol_time3[0]);       // 巡回3
$pdf->Text(43, 90, $report->oup_bath3[0]);              // バース3
$pdf->Text(65, 90, $report->oup_sip3[0]);               // 本船名3
$pdf->Text(159, 90, $report->oup_in_port_time3[0]);     // 入港3
$pdf->Text(180, 90, $report->oup_out_port_time3[0]);    // 出港3

$pdf->Text(24, 99, $report->oup_patrol_time4[0]);       // 巡回4
$pdf->Text(43, 99, $report->oup_bath4[0]);              // バース4
$pdf->Text(65, 99, $report->oup_sip4[0]);               // 本船名4
$pdf->Text(159, 99, $report->oup_in_port_time4[0]);     // 入港4
$pdf->Text(180, 99, $report->oup_out_port_time4[0]);    // 出港4

$pdf->Text(24, 108, $report->oup_patrol_time5[0]);       // 巡回5
$pdf->Text(43, 108, $report->oup_bath5[0]);              // バース5
$pdf->Text(65, 108, $report->oup_sip5[0]);               // 本船名5
$pdf->Text(159, 108, $report->oup_in_port_time5[0]);     // 入港5
$pdf->Text(180, 108, $report->oup_out_port_time5[0]);    // 出港5

$pdf->Text(24, 116, $report->oup_patrol_time6[0]);       // 巡回6
$pdf->Text(43, 116, $report->oup_bath6[0]);              // バース6
$pdf->Text(65, 116, $report->oup_sip6[0]);               // 本船名6
$pdf->Text(159, 116, $report->oup_in_port_time6[0]);     // 入港6
$pdf->Text(180, 116, $report->oup_out_port_time6[0]);    // 出港6

$pdf->Text(71, 131, $report->oup_front_gate_start_time[0]);     // 正面ゲート
$pdf->Text(91, 131, $report->oup_front_gate_end_time[0]);       // 正面ゲート

$pdf->Text(71, 140, $report->oup_east_gate_start_time[0]);      // 東ゲート
$pdf->Text(91, 140, $report->oup_east_gate_end_time[0]);        // 東ゲート

$pdf->Text(71, 147, $report->oup_west_gate_start_time[0]);      // 西ゲート
$pdf->Text(91, 147, $report->oup_west_gate_end_time[0]);        // 西ゲート

$pdf->Text(50, 166, $report->oup_over_time_num[0]);         // 残業者
$pdf->Text(71, 166, $report->oup_over_start_time[0]);       // 残業者
$pdf->Text(91, 166, $report->oup_over_end_time[0]);         // 残業者
$pdf->MultiCell(58,30,$report->oup_over_time_name[0],0,'',0,1,42,172);     // 残業者


if(strpos($report->oup_yard[0],'作業') !== false){
    $pdf->Circle( 142, 126, 5, 0, 360, "D");     // 作業結果(有)
}
if(strpos($report->oup_yard[0],'常夜') !== false){
    $pdf->Circle( 155, 126, 5, 0, 360, "D");     // 作業結果(有)
}
if(strpos($report->oup_yard[0],'街路') !== false){
    $pdf->Circle( 169, 126, 5, 0, 360, "D");     // 作業結果(有)
}

$pdf->Text(110, 131, $report->oup_yard1_start_time[0]);     // ヤード1
$pdf->Text(136, 131, $report->oup_yard1_end_time[0]);       // ヤード1

$pdf->Text(159, 131, $report->oup_yard2_start_time[0]);     // ヤード2
$pdf->Text(185, 131, $report->oup_yard2_end_time[0]);       // ヤード2

$pdf->Text(121, 150, $report->oup_cam_time[0]);     // カメラ操作状況
$pdf->Text(141, 150, $report->oup_cam_text[0]);     // カメラ操作状況

$pdf->Text(121, 173, $report->oup_fence_time[0]);     // フェンス等の破損状況
$pdf->Text(141, 173, $report->oup_fence_text[0]);     // フェンス等の破損状況

$pdf->MultiCell(65,30,$report->oup_etc_comment1[0],0,'',0,1,42,190);     // 備考

$pdf->MultiCell(65,30,$report->oup_etc_comment2[0],0,'',0,1,109,190);     // 備考

$pdf->SetFont('kozminproregular', '', 10);// 日本語フォント

$pdf->Text(65, 256, $ken[$report->oup_wk_staff_id1_ken[0]]);    // 警備員1
$pdf->Text(65, 260, $staffs[$report->oup_wk_staff_id1[0]]);     // 警備員1
$pdf->Text(87, 256, $ken[$report->oup_wk_staff_id2_ken[0]]);    // 警備員2
$pdf->Text(87, 260, $staffs[$report->oup_wk_staff_id2[0]]);     // 警備員2
$pdf->Text(109, 256, $ken[$report->oup_wk_staff_id3_ken[0]]);   // 警備員3
$pdf->Text(109, 260, $staffs[$report->oup_wk_staff_id3[0]]);    // 警備員3
$pdf->Text(131, 256, $ken[$report->oup_wk_staff_id4_ken[0]]);   // 警備員4
$pdf->Text(131, 260, $staffs[$report->oup_wk_staff_id4[0]]);    // 警備員4
$pdf->Text(154, 256, $ken[$report->oup_wk_staff_id5_ken[0]]);   // 警備員5
$pdf->Text(154, 260, $staffs[$report->oup_wk_staff_id5[0]]);    // 警備員5
$pdf->Text(177, 256, $ken[$report->oup_wk_staff_id6_ken[0]]);   // 警備員6
$pdf->Text(177, 260, $staffs[$report->oup_wk_staff_id6[0]]);    // 警備員6
$pdf->Text(65, 265, $ken[$report->oup_wk_staff_id7_ken[0]]);    // 警備員7
$pdf->Text(65, 269, $staffs[$report->oup_wk_staff_id7[0]]);     // 警備員7
$pdf->Text(87, 265, $ken[$report->oup_wk_staff_id8_ken[0]]);    // 警備員8
$pdf->Text(87, 269, $staffs[$report->oup_wk_staff_id8[0]]);     // 警備員8
$pdf->Text(109, 265, $ken[$report->oup_wk_staff_id9_ken[0]]);   // 警備員9
$pdf->Text(109, 269, $staffs[$report->oup_wk_staff_id9[0]]);    // 警備員9
$pdf->Text(131, 265, $ken[$report->oup_wk_staff_id10_ken[0]]);  // 警備員10
$pdf->Text(131, 269, $staffs[$report->oup_wk_staff_id10[0]]);   // 警備員10
$pdf->Text(154, 265, $ken[$report->oup_wk_staff_id11_ken[0]]);  // 警備員11
$pdf->Text(154, 269, $staffs[$report->oup_wk_staff_id11[0]]);   // 警備員11
$pdf->Text(177, 265, $ken[$report->oup_wk_staff_id12_ken[0]]);  // 警備員12
$pdf->Text(177, 269, $staffs[$report->oup_wk_staff_id12[0]]);   // 警備員12
$pdf->Text(65, 273, $ken[$report->oup_wk_staff_id13_ken[0]]);   // 警備員13
$pdf->Text(65, 277, $staffs[$report->oup_wk_staff_id13[0]]);    // 警備員13
$pdf->Text(87, 273, $ken[$report->oup_wk_staff_id14_ken[0]]);   // 警備員14
$pdf->Text(87, 277, $staffs[$report->oup_wk_staff_id14[0]]);    // 警備員14
$pdf->Text(109, 273, $ken[$report->oup_wk_staff_id15_ken[0]]);  // 警備員15
$pdf->Text(109, 277, $staffs[$report->oup_wk_staff_id15[0]]);   // 警備員15
$pdf->Text(131, 273, $ken[$report->oup_wk_staff_id16_ken[0]]);  // 警備員16
$pdf->Text(131, 277, $staffs[$report->oup_wk_staff_id16[0]]);   // 警備員16
$pdf->Text(154, 273, $ken[$report->oup_wk_staff_id17_ken[0]]);  // 警備員17
$pdf->Text(154, 277, $staffs[$report->oup_wk_staff_id17[0]]);   // 警備員17
$pdf->Text(177, 273, $ken[$report->oup_wk_staff_id18_ken[0]]);  // 警備員18
$pdf->Text(177, 277, $staffs[$report->oup_wk_staff_id18[0]]);   // 警備員18

if ($_GET["act"] && $_GET["act"] == "mail") {
    // $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/report".$report->oup_table[0]."_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');
    $pdf->Output(sprintf($common->rootpath."/pdf/pdf_file/郵船（警備）_".substr($report->oup_no[0],0,8).".pdf", time()), 'F');

    echo json_encode("郵船（警備）_".substr($report->oup_no[0],0,8)." ".date("H:i:s"));
    exit;
} else {
    $pdf->Output(sprintf("report11.pdf", time()), 'I');
}
// $pdf->Output(sprintf("report11.pdf", time()), 'I');
?>
