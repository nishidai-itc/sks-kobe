<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

  <!-- bootstrap-4.3.1 -->
  <link href="./../bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- 勤務複数検索 -->
  <link rel="stylesheet" href="./../multiple/multiple-select.min.css">
  <script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./../bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>
  <!-- 勤務複数検索 -->
  <script src="./../multiple/multiple-select.min.js"></script>

  <!-- fontawesome -->
  <link href="./../fontawesome-free-5.11.2-web/css/all.min.css" rel="stylesheet">
  <!--<script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-multiselect-widget/3.0.0/jquery.multiselect.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
  <link media="print" rel="stylesheet" href="print.css">


  <title>勤怠管理システム</title>
</head>

<script>
//勤務複数検索
$(function(){
    //$(window).resize(function() {
    //    var width = $(window).width();
    //    if (width <= 1500) {
    //        var text = $('.menu a').text();
    //        $('.menu a').text('メニューへ');
    //    } else {
    //        $('.menu a').text('メニューへ戻る');
    //    }
    //});
    
    $('#kinmu').multipleSelect();
    $('#genba_id').multipleSelect();
    $('#company_id').multipleSelect();
});
function confirm1(no,name) {
  if (!confirm(name + 'さんの項目を削除してもよろしいですか?')) return false;
    location.href = "kinmujokyosyousai.php?act=2&no=" + no;
//  location.href = "shift2.php?act=2&shift_id=" + no + "&shift_id2=" + no;
}

$(function(){
  $("input").on("keydown",function(ev){
    if ((ev.which && ev.which === 13) ||(ev.keyCode && ev.keyCode === 13)){
      return false;
    } else {
      return true;
    }
  });
});

//$(function(){
//    var kana = $('#user_kana').val();
//    
//    $('#user_kana').change(function(){
//        //var kana = "";
//        var kana = $(this).val();
//        if (kana == "") {
//            var kana = "";
//        }
//        //$('#staff_id option[name='+kana+']').remove();
//        $(".staff").each(function(index) {
//          //var name = "";
//          var name = $(this).attr("name");
//          if (name == "ア" || name == "イ" || name == "ウ" || name == "エ" || name == "オ") {
//            var name = "ア";
//          }
//          if (name == "カ" || name == "キ" || name == "ク" || name == "ケ" || name == "コ") {
//            var name = "カ";
//          }
//          if (name == "サ" || name == "シ" || name == "ス" || name == "セ" || name == "ソ") {
//            var name = "サ";
//          }
//          if (name == "タ" || name == "チ" || name == "ツ" || name == "テ" || name == "ト") {
//            var name = "タ";
//          }
//          if (name == "ナ" || name == "ニ" || name == "ヌ" || name == "ネ" || name == "ノ") {
//            var name = "ナ";
//          }
//          if (name == "ハ" || name == "ヒ" || name == "フ" || name == "ヘ" || name == "ホ") {
//            var name = "ハ";
//          }
//          if (name == "マ" || name == "ミ" || name == "ム" || name == "メ" || name == "モ") {
//            var name = "マ";
//          }
//          if (name == "ヤ" || name == "ユ" || name == "ヨ") {
//            var name = "ヤ";
//          }
//          if (name == "ラ" || name == "リ" || name == "ル" || name == "レ" || name == "ロ") {
//            var name = "ラ";
//          }
//          if (name == "ワ" || name == "ヲ" || name == "ン") {
//            var name = "ワ";
//          }
//          var wrap = $(this).parents().attr("class");
//          
//          if(name != kana){  
//              
//            if(wrap !== "wrap"){
//              $(this).wrap("<span class='wrap'>");
//            }
//          }
//          if(name == kana){
//            
//            if(wrap == "wrap"){
//              $(this).unwrap();
//            }
//          }
//          if (kana == "") {
//              $(this).unwrap();
//          }
//        });
//    });
//    
//        $(".staff").each(function(index) {
//          //var name = "";
//          var name = $(this).attr("name");
//          if (name == "ア" || name == "イ" || name == "ウ" || name == "エ" || name == "オ") {
//            var name = "ア";
//          }
//          if (name == "カ" || name == "キ" || name == "ク" || name == "ケ" || name == "コ") {
//            var name = "カ";
//          }
//          if (name == "サ" || name == "シ" || name == "ス" || name == "セ" || name == "ソ") {
//            var name = "サ";
//          }
//          if (name == "タ" || name == "チ" || name == "ツ" || name == "テ" || name == "ト") {
//            var name = "タ";
//          }
//          if (name == "ナ" || name == "ニ" || name == "ヌ" || name == "ネ" || name == "ノ") {
//            var name = "ナ";
//          }
//          if (name == "ハ" || name == "ヒ" || name == "フ" || name == "ヘ" || name == "ホ") {
//            var name = "ハ";
//          }
//          if (name == "マ" || name == "ミ" || name == "ム" || name == "メ" || name == "モ") {
//            var name = "マ";
//          }
//          if (name == "ヤ" || name == "ユ" || name == "ヨ") {
//            var name = "ヤ";
//          }
//          if (name == "ラ" || name == "リ" || name == "ル" || name == "レ" || name == "ロ") {
//            var name = "ラ";
//          }
//          if (name == "ワ" || name == "ヲ" || name == "ン") {
//            var name = "ワ";
//          }
//          var wrap = $(this).parents().attr("class");
//          
//          if(name != kana){  
//              
//            if(wrap !== "wrap"){
//              $(this).wrap("<span class='wrap'>");
//            }
//          }
//          if(name == kana){
//            
//            if(wrap == "wrap"){
//              $(this).unwrap();
//            }
//          }
//          if (kana == "") {
//              $(this).unwrap();
//          }
//        });
//    //});
//});
// チェックボックスのクリック判定
$(function() {
    //$("#user_kana").change( function(){
    //    self.location = "kinmujokyo.php?user_kana="+$('#user_kana').val()+"&startday="+$('#startday').val()+"&endday="+$('#endday').val()+"&genba_id="+$('#genba_id').val()+"&kbn="+$('#kbn').val()+"&staff_id="+$('#staff_id').val()+"&oyako_kbn="+$('.oyako:checked').val();
    //});
  // 全選択ボタンの押下時
  $('#all-checked').on("click", function() {
    $('.teate-checked').prop("checked", $(this).prop("checked"));
  });
});

//ツールチップ
$('[data-toggle="tooltip"]').tooltip();
</script>

<!-- カナ検索絞込み -->
<?php require_once('../../models/common/script.php'); ?>

<script type="text/javascript">
<!--
$(function(){
  $("#genba_id").multiselect();
});
-->
</script>

<style type="text/css" media="print">
.print_pages{
/*A4縦*/
  width: 172mm;
  height: 251mm;
  page-break-after: always;
}
  /*最後のページは改ページを入れない*/
.print_pages:last-child{
    page-break-after: auto;
}
</style>

<style>
.ms-parent {
    padding:0;
}
.ms-choice {
    height:100%;
}
.td1{
    border:1px solid;
    background:#FFDCA5;
}
.td2{
    border:1px solid;
}
.td3{
    border:1px solid;
    background:#ffffa7;
}
.table1 td{
    padding:0;
    white-space: nowrap;
    text-align:center;
}
.table1 input{
    width:100%;
    text-align:center;
}
</style>

<body <?php echo $flg == 1 ? 'class=container' : ''; ?>>

<!--<div class="position-fixed" style="bottom:30px; right:30px; z-index:100; width:200px;"><a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a></div>-->

<section class="print_pages">
  <div class="container">
    <div class="page-header">
    <?php if ($flg == 1) { ?>
        <h4>勤務照会</h4>
    <?php } elseif ($flg == 2) { ?>
      <h4>勤務状況一覧　(総務)　</h4>
    <?php } else { ?>
      <h4>勤務状況一覧</h4>
    <?php } ?>
    </div>

    <form name="frm" method="POST" action="kinmujokyo.php">

    <?php if ($flg == 1) { 
    //勤務照会用
    ?>
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table class="text-nowrap" border="1" style="font-size: 15pt;" bgcolor="#d5d5d5" width=100%>
            <tr>
              <td bgcolor="FFDCA5">氏名</td>
              <td colspan=3 bgcolor="white">
                <?php print("　".$staff2->oup_m_staff_name[0]); ?>
              </td>
            </tr>
            <tr>
              <td bgcolor="FFDCA5">年月</td>
              <td bgcolor="#d5d5d5">
                <select id="nengetu" class="form-control" name="nengetu" style="font-size:20px;">
                  <?php for($i=$start;$i<=$end;$i=date('Ym01', strtotime($i.'+1 month'))) { ?>
                  <option value="<?php echo substr($i,0,6) ?>" <?php echo substr($i,0,6) == $nengetu ? 'selected':"" ?>><?php echo substr($i,0,6) ?></option>
                  <?php } ?>
                </select>
              </td>
              <td width=60>
                <button type="submit" class="btn btn-info" role="button" name="search">検索</button>
              </td>
              <td width=130>
                <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
                <?php } else { ?>
                <a href="../menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
                <?php } ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
      
    <?php } else { 
    //勤務照会以外
    ?>
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table class="text-nowrap" border="1" style="font-size: 10pt; width:1200px" bgcolor="#d5d5d5">
            <tr>
              <td>
                <table class="text-nowrap" style="font-size: 10pt;">
                  <tr>
                    <td bgcolor="#d5d5d5">　日付　<input type="submit" name="prev" value="&lt;" ></td>
                    <td bgcolor="#d5d5d5"><input style="padding:0 0 0 5px; width: 155px"  type="date" size="8" class="form-control" name="startday" id="startday"
                        value="<?php print(substr($startday,0,4)."-".substr($startday,4,2)."-".substr($startday,6,2)); ?>"></td>
                    <td bgcolor="#d5d5d5">　～　</td>
                      <td bgcolor="#d5d5d5"><input style="padding:0 0 0 5px; width: 155px"  type="date" size="8" class="form-control" name="endday" id="endday"
                        value="<?php print(substr($endday,0,4)."-".substr($endday,4,2)."-".substr($endday,6,2)); ?>"></td>
                    <td bgcolor="#d5d5d5"><input type="submit" name="next" value="&gt;" >　現場　
                    <!-- </td>
                    <td> -->
                      <!--<label for="oya"><input type="radio" id="oya" class="oyako" name="oyako_kbn" value="1" <?php if ($oyako_kbn=="1") { print("checked"); } ?>> 親　</label>
                      <label for="ko"><input type="radio" id="ko" class="oyako" name="oyako_kbn" value="2" <?php if ($oyako_kbn=="2") { print("checked"); } ?>> 子　</label>-->
                    </td>
                    <td bgcolor="#d5d5d5">
                      <select style="width: 170px"  id="genba_id" name="genba_id[]" class="form-control" multiple="multiple" size="1">
                      <!--<select style="width: 170px"  id="genba_id" name="genba_id" class="form-control">-->
                            <!--<option value=""></option>-->
                          <?php for ($i=0;$i<count($genba4->oup_m_genba_id);$i++) { ?>
                        <option value="<?php print($genba4->oup_m_genba_id[$i]); ?>" <?php
                        for ($j=0;$j<count($genba_id);$j++) {
                            if ($genba_id[$j]===$genba4->oup_m_genba_id[$i]) {
                                print("selected");
                            }
                        } ?>><?php print($genba4->oup_m_genba_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">
                        &nbsp;&nbsp;<input type="checkbox" id="alone" class="alone" name="alone" value="1" <?php if ($alone=="1") { print("checked"); } ?>>個別
                    </td>
                    <!--<td bgcolor="#d5d5d5">
                    </td>-->

                      <td bgcolor="#d5d5d5">
                      </td>
                      <td bgcolor="#d5d5d5">協力会社</td>
                    <td bgcolor="#d5d5d5" colspan=2>
                      <!--<select style="width: 170px"  id="company_id" name="company_id" class="form-control">-->
                      <select style="width: 170px"  id="company_id" name="company_id[]" class="form-control" multiple="multiple" size="1">
                        <!--<option value=""></option>-->
                        <?php for ($i=0;$i<count($company->oup_m_company_id);$i++) { ?>
                        <option value="<?php print($company->oup_m_company_id[$i]); ?>" <?php
                        for ($j=0;$j<count($company_id);$j++) {
                            if ($company_id[$j]===$company->oup_m_company_id[$i]) {
                                print("selected");
                            }
                        } ?>><?php print($company->oup_m_company_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">
                    </td>
                  </tr>
                  <tr>
<!--                    <td bgcolor="#d5d5d5">
                    </td>
                    <td bgcolor="#d5d5d5">
                    </td>-->
                    <td bgcolor="#d5d5d5">　勤務　</td>
                    
                    <td>
                    <!--<select id="kinmu" name="kinmu" class="form-control form-control-sm">-->
                    <select id="kinmu" name="kinmu[]" class="form-control form-control-sm" multiple="multiple" size="1">
                        <!--<option></option>-->
                        <?php /*
                        for ($i=0; $i<count($shift->oup_m_shift_no); $i++) {
                            // 現場IDから現場名を取得
                            $genba = new Genba; // Genbaクラスの初期化
                            $genba->inp_m_genba_id = $shift->oup_m_shift_genba_id[$i];
                            $genba->getGenba(); ?>
                        
                        <option
                          value="<?php print($shift->oup_m_shift_plan_kbn[$i].','.$shift->oup_m_shift_kaban_time[$i].','.$shift->oup_m_shift_joban_time[$i].','.$shift->oup_m_shift_plan_hosoku[$i].','.$genba->oup_m_genba_id[0]); ?>" <?php
                            if ($genba_id2 == $shift->oup_m_shift_genba_id[$i] && $plan_kbn === $shift->oup_m_shift_plan_kbn[$i] && $plan_kaban_time === $shift->oup_m_shift_kaban_time[$i] && $plan_joban_time === $shift->oup_m_shift_joban_time[$i] && $plan_hosoku === $shift->oup_m_shift_plan_hosoku[$i]) {
                                echo 'selected';
                            } ?>>
                          <?php
                          echo $genba->oup_m_genba_name[0] . '/' . $shift->kbn[$shift->oup_m_shift_plan_kbn[$i]] . $shift->oup_m_shift_plan_hosoku[$i] . "/" . $shift->oup_m_shift_joban_time[$i] . " ～ " . $shift->oup_m_shift_kaban_time[$i];
                          ?>
                        </option>
                    <?php
                    } */ ?>
                        <!--<option value=""></option>-->
                        <?php for ($i=0; $i<count($shift->oup_m_shift_no); $i++) { ?>
                        <option value="<?php print($shift->oup_m_shift_no[$i]); ?>" <?php
                        for ($j=0;$j<count($shift_no);$j++) {
                            if ($shift_no[$j]===$shift->oup_m_shift_no[$i]) {
                                print("selected");
                            }
                        } ?>>
                        <?php if ($shift->oup_m_shift_plan_hosoku[$i] != "") {
                          print($genbas[$shift->oup_m_shift_genba_id[$i]]."/".mb_substr($shift->kbn2[$shift->oup_m_shift_plan_kbn[$i]],0,1).$shift->oup_m_shift_plan_hosoku[$i]."/".substr($shift->oup_m_shift_joban_time[$i],0,5)." ～ ".substr($shift->oup_m_shift_kaban_time[$i],0,5));
                        } else {
                          print($genbas[$shift->oup_m_shift_genba_id[$i]]."/".mb_substr($shift->kbn2[$shift->oup_m_shift_plan_kbn[$i]],0,1)."/".substr($shift->oup_m_shift_joban_time[$i],0,5)." ～ ".substr($shift->oup_m_shift_kaban_time[$i],0,5));
                        } ?>
                        </option>
                        <?php } ?>
                    </select>
                    </td>
                    
                    </td>
                    <td bgcolor="#d5d5d5">　状態　</td>
                    <td bgcolor="#d5d5d5">
                      <select style="width: 100px" id="kbn" name="kbn" class="form-control">
                        <?php foreach ($jk_kbn as $kbn_1 => $kbn_2) {?>
                        <option value="<?php echo $kbn_1; ?>"
                        <?php echo $kbns == $kbn_1 ? 'selected':'' ; ?>>
                        <?php echo $kbn_2; ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">　隊員　</td>
                    <td bgcolor="#d5d5d5">
                      <table>
                        <tr>
                          <td>
                            <select id="user_kana" class="form-control" name="user_kana" style="padding:0; width:60px;">
                              <?php for ($i=0;$i<count($user_kana_array);$i++) { ?>
                                <option value="<?php print($user_kana_array[$i]); ?>" <?php if ($user_kana == $user_kana_array[$i]) { print("selected"); }?> ><?php print($user_kana_array[$i]); ?>
                              <?php } ?>
                            </select>
                          </td>
                          <td>
                            <select style="padding:0; width: 130px" id="staff_id" name="staff_id" class="form-control">
                              <option>
                              <?php for ($i=0;$i<count($staff->oup_m_staff_id);$i++) { ?>
                                <option class="staff" name="<?php print(mb_convert_kana(mb_substr($staff->oup_m_staff_kana[$i],0,1),"K")); ?>"
                                  value="<?php print($staff->oup_m_staff_id[$i]); ?>" <?php
                                  if ($staff_id===$staff->oup_m_staff_id[$i]) {
                                    print("selected");
                                  } ?>><?php print($staff->oup_m_staff_name[$i]); ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td bgcolor="#d5d5d5" style="text-align:center;">G&#10004;</td>
                    <td bgcolor="#d5d5d5">
                        <select style="padding:0; width:50px;" name="gchk_search" class="form-control">
                        <option value="" <?php if ($gchk_search == "") {print("selected");} ?>></option>
                        <option value="0" <?php if ($gchk_search == "0") {print("selected");} ?>>未</option>
                        <option value="1" <?php if ($gchk_search == "1") {print("selected");} ?>>済</option>
                        </select>
                    </td>
                    <td bgcolor="#d5d5d5" style="text-align:center;">　S&#10004;</td>
                    <td bgcolor="#d5d5d5">
                        <select style="padding:0; width:50px;" name="schk_search" class="form-control">
                        <option value="" <?php if ($schk_search == "") {print("selected");} ?>></option>
                        <option value="0" <?php if ($schk_search == "0") {print("selected");} ?>>未</option>
                        <option value="1" <?php if ($schk_search == "1") {print("selected");} ?>>済</option>
                        </select>
                    </td>
                    <!--<td bgcolor="#d5d5d5">　
                    </td>-->
                    <td bgcolor="#d5d5d5">
                      <button type="submit" class="btn btn-info" role="button" name="search">検索</button>
                    </td>
                    <!--<td bgcolor="#d5d5d5">
                    　　　　　　
                    </td>-->
                    <td bgcolor="#d5d5d5">
                      <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                      <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
                      <?php } else { ?>
                      <a href="../menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
                      <?php } ?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
<!--
          <div class="col-12" style="width: 1200px">
            <table class="text-center" border="1">
            <tr>
              <td width="100">下番</td>
              <td width="100" bgcolor="FFDCA5">上番中</td>
              <td width="100" bgcolor="d5d5d5">未</td>
            </tr>
          </table>
        </div>
-->
      </div>
    <?php } ?>

      <br />

      <!-- 一覧 -->
      <div class="row">
        <div class="col-12">
          <table class="text-nowrap" border="1" style="font-size: 10pt;" <?php echo $flg != 1 ? "width=1200" : "width=100%"; ?>>
<?php 
            $ycnt = 0;
            $kcnt = 0;
            $dcnt = 0;
            $scnt = 0;
            $tcnt = 0;
            $jcnt = 0;
?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { 
                        if($i == 0 ){
              ?>
            <thead>
              <tr class="text-center">
              <!-- 上段 -->
              <!-- 勤務照会以外 -->
              <?php if ($flg != 1) { ?>
                <td width="30" rowspan="2" bgcolor="FFDCA5">詳細</td>
                <td width="30" rowspan="2" bgcolor="FFDCA5"><input type="checkbox" id="all-checked"></td>
                <td width="30" rowspan="2" bgcolor="FFDCA5">G<br>&#10004;</td>
                <td width="30" rowspan="2" bgcolor="FFDCA5">S<br>&#10004;</td>
              <?php } ?>
              
                <td width="60" rowspan="2" bgcolor="FFDCA5">日付</td>
                <td width="40" rowspan="2" bgcolor="FFDCA5">曜<br />日</td>
                <td width="85" rowspan="2" bgcolor="FFDCA5">現場</td>
                
              <?php if ($flg != 1) { ?>
                <td width="100" rowspan="2" bgcolor="FFDCA5">氏名</td>
              <?php } ?>
              
                <td width="60" rowspan="2" bgcolor="FFDCA5">勤務</td>
                
              <?php if ($flg == 2) { ?>
                <td width="60" rowspan="2" bgcolor="fff6d9">時給<br>日給</td>
              <?php } ?>
              
              <?php if ($flg != 1 || ($flg == 1 && $post_flg != "false")) { ?>
                <td width="60" rowspan="2" bgcolor="d5d5d5">ﾎﾟｽﾄ</td>
              <?php } ?>
              
                <td width="70" colspan="1" bgcolor="FFDCA5">所定</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">打刻</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">実績</td>
                <td width="70" rowspan="2" bgcolor="FFDCA5">&nbsp;</td>
                <td width="60" rowspan="2" bgcolor="d5d5d5">勤務<br />時間</td>
                
              <?php if ($flg == 1) { ?>
                  <?php if ($syotei_zan_flg != "false") { ?>
                    <td rowspan="2" width="60" bgcolor="d5d5d5">所定残</td>
                  <?php } ?>
                  <?php if ($ht_zan_flg != "false") { ?>
                    <td rowspan="2" width="60" bgcolor="d5d5d5">早出残<br>通常残</td>
                  <?php } ?>
                  <?php if ($daytime_over_time_flg != "false") { ?>
                    <td rowspan="2" width="60" bgcolor="d5d5d5">昼残</td>
                  <?php } ?>
                  <?php if ($rest_over_time_flg != "false") { ?>
                    <td rowspan="2" width="60" bgcolor="d5d5d5">休憩残</td>
                  <?php } ?>
                  <?php if ($midnight_over_time_flg != "false") { ?>
                    <td rowspan="2" width="60" bgcolor="d5d5d5">深夜残</td>
                  <?php } ?>
                  <?php if ($renzan_flg != "false") { ?>
                    <td rowspan="2" width="60" bgcolor="d5d5d5">連勤残</td>
                  <?php } ?>
              <?php } else { ?>
                <td colspan="6" bgcolor="d5d5d5">時間外勤務</td>
              <?php } ?>
              
              <?php if ($flg != 1 || ($flg == 1 && $comment_flg != "false")) { ?>
                <td rowspan="2" bgcolor="FFDCA5">コ<br>メ</td>
              <?php } ?>
                
              <?php if ($flg != 1 || ($flg == 1 && $kotuhi_flg != "false")) { ?>
                <td width="70" rowspan="2" bgcolor="d5d5d5">交通費</td>
              <?php } ?>
                
              <?php if ($flg != 1 && $staff2->oup_m_staff_auth[0]=="1") { ?>
                  <td colspan="5" bgcolor="d5d5d5">手当て</td>
              <?php } elseif ($flg == 1 && $staff2->oup_m_staff_auth[0]=="1") { ?>
                  <?php if ($teate1_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5" rowspan="2"><?php print($teate->oup_m_teate_name[0]); ?></td>
                  <?php } ?>
                  <?php if ($teate2_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5" rowspan="2"><?php print($teate->oup_m_teate_name[1]); ?></td>
                  <?php } ?>
                  <?php if ($teate3_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5" rowspan="2"><?php print($teate->oup_m_teate_name[2]); ?></td>
                  <?php } ?>
                  <?php if ($teate4_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5" rowspan="2"><?php print($teate->oup_m_teate_name[3]); ?></td>
                  <?php } ?>
                  <?php if ($teate5_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5" rowspan="2"><?php print($teate->oup_m_teate_name[4]); ?></td>
                  <?php } ?>
              <?php } else { ?>
                  <!--<td bgcolor="d5d5d5">手当て</td>-->
              <?php } ?>
              
              <!-- 勤務照会以外 -->
              <?php if ($flg != 1) { ?>
				<td width="60" rowspan="2" bgcolor="d5d5d5">&nbsp;</td>
			  <?php } ?>
              </tr>
              
              <!-- 下段 -->
              <tr class="text-center">
                <td width="60" bgcolor="FFDCA5">上番<br>下番</td>
                <td width="60" bgcolor="d5d5d5">上番<br>下番</td>
                <td width="60" bgcolor="d5d5d5">上番<br>下番</td>
                
              <?php if ($flg != 1) { ?>
                <td width="60" bgcolor="d5d5d5">所定残</td>
                <td width="60" bgcolor="d5d5d5">早出残<br>通常残</td>
                <td width="60" bgcolor="d5d5d5">昼残</td>
                <td width="60" bgcolor="d5d5d5">休憩残</td>
                <td width="60" bgcolor="d5d5d5">深夜残</td>
                <td width="60" bgcolor="d5d5d5">連勤残</td>
              <?php } ?>
              
                <!--<td width="60" bgcolor="d5d5d5">ﾎﾟｽﾄ</td>-->
                
              <?php if ($flg != 1 && $staff2->oup_m_staff_auth[0]=="1") { ?>
                  <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[0]); ?></td>
                  <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[1]); ?></td>
                  <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[2]); ?></td>
                  <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[3]); ?></td>
                  <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[4]); ?></td>
              <?php } ?>
              
              </tr>
            </thead>
            
            <?php } elseif($i%10 == 0) { ?>
             <thead>
              <tr class="text-center">
              <!-- 勤務照会以外 -->
              <?php if ($flg != 1) { ?>
                <td width="30" bgcolor="FFDCA5">詳細</td>
                <td width="30" bgcolor="FFDCA5"></td>
                <td width="30" bgcolor="FFDCA5">G<br>&#10004;</td>
                <td width="30" bgcolor="FFDCA5">S<br>&#10004;</td>
              <?php } ?>
              
                <td width="60" bgcolor="FFDCA5">日付</td>
                <td width="40" bgcolor="FFDCA5">曜<br />日</td>
                <td width="85" bgcolor="FFDCA5">現場</td>
                
              <?php if ($flg != 1) { ?>
                <td width="100" bgcolor="FFDCA5">氏名</td>
              <?php } ?>
              
                <td width="60" bgcolor="FFDCA5">勤務</td>
                
              <?php if ($flg == 2) { ?>
                <td width="60" bgcolor="fff6d9">時給<br>日給</td>
              <?php } ?>
              
              <?php if ($flg != 1 || ($flg == 1 && $post_flg != "false")) { ?>
                <td width="60"  bgcolor="d5d5d5">ﾎﾟｽﾄ</td>
              <?php } ?>
              
                <td width="70" colspan="1" bgcolor="FFDCA5">所定</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">打刻</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">実績</td>
                <td width="70" bgcolor="FFDCA5">&nbsp;</td>
                <td width="60" bgcolor="d5d5d5">勤務<br />時間</td>
                
              <?php if ($flg == 1) { ?>
                  <?php if ($syotei_zan_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5">所定残</td>
                  <?php } ?>
                  <?php if ($ht_zan_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5">早出残<br>通常残</td>
                  <?php } ?>
                  <?php if ($daytime_over_time_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5">昼残</td>
                  <?php } ?>
                  <?php if ($rest_over_time_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5">休憩残</td>
                  <?php } ?>
                  <?php if ($midnight_over_time_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5">深夜残</td>
                  <?php } ?>
                  <?php if ($renzan_flg != "false") { ?>
                    <td width="60" bgcolor="d5d5d5">連勤残</td>
                  <?php } ?>
              <?php } else { ?>
                <td width="60" bgcolor="d5d5d5">所定残</td>
                <td width="60" bgcolor="d5d5d5">早出残<br>通常残</td>
                <td width="60" bgcolor="d5d5d5">昼残</td>
                <td width="60" bgcolor="d5d5d5">休憩残</td>
                <td width="60" bgcolor="d5d5d5">深夜残</td>
                <td width="60" bgcolor="d5d5d5">連勤残</td>
              <?php } ?>
              
                <!--
                <td width="60" bgcolor="d5d5d5">所定残</td>
                <td width="60" bgcolor="d5d5d5">早出残<br>通常残</td>
                <td width="60" bgcolor="d5d5d5">昼残</td>
                <td width="60" bgcolor="d5d5d5">休憩残</td>
                <td width="60" bgcolor="d5d5d5">深夜残</td>
                <td width="60" bgcolor="d5d5d5">連勤残</td>
                -->
                
              <?php if ($flg != 1 || ($flg == 1 && $comment_flg != "false")) { ?>
                <td width="60" bgcolor="FFDCA5">コ<br>メ</td>
              <?php } ?>
                
              <?php if ($flg != 1 || ($flg == 1 && $kotuhi_flg != "false")) { ?>
                <td width="70" bgcolor="d5d5d5">交通費</td>
              <?php } ?>
              
                <!--<td width="60" bgcolor="d5d5d5">ﾎﾟｽﾄ</td>-->
                
              <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                <?php if ($flg != 1 || ($teate1_flg != "false")) { ?>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[0]); ?></td>
                <?php } ?>
                <?php if ($flg != 1 || ($teate2_flg != "false")) { ?>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[1]); ?></td>
                <?php } ?>
                <?php if ($flg != 1 || ($teate3_flg != "false")) { ?>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[2]); ?></td>
                <?php } ?>
                <?php if ($flg != 1 || ($teate4_flg != "false")) { ?>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[3]); ?></td>
                <?php } ?>
                <?php if ($flg != 1 || ($teate5_flg != "false")) { ?>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[4]); ?></td>
                <?php } ?>
              <?php } ?>
            
              <!-- 勤務照会以外 -->
              <?php if ($flg != 1) { ?>
			  	<td width="60" bgcolor="d5d5d5">&nbsp;</td>
			  <?php } ?>
              </tr>
             </thead>
              
            <tbody>
              
            <?php } ?>
              
              <?php if ($flg == 2) { ?>
              <tr class="text-center" <?php if ($i == 0 || $i%2 == 0) { print("bgcolor=#fce4d6"); } ?>>
              <?php } else { ?>
              <tr class="text-center" <?php if ($i == 0 || $i%2 == 0) { print("bgcolor=#e1f6fc"); } ?>>
              <?php } ?>
              
              <!-- 勤務照会以外 -->
              <?php if ($flg != 1) { ?>
                <!-- 詳細 -->
                <td>
                <?php if ($flg == 2 || ($flg != 2 && $inp[$wkdetail->oup_t_wk_detail_no[$i]] != 1)) { ?>
                <div id="<?php print($wkdetail->oup_t_wk_detail_no[$i]); ?>">
                  <a href="kinmujokyosyousai.php?no=<?php print($wkdetail->oup_t_wk_detail_no[$i]); ?>">
                    <i class="fas fa-pen"></i>
                  </a>
                </div>
                <?php } ?>
                </td>
                <!-- チェックボックス -->
                <td>
                <?php if ($flg == 2 || ($flg != 2 && $inp[$wkdetail->oup_t_wk_detail_no[$i]] != 1)) { ?>
                  <input name="check_teate[<?php echo $i; ?>]" type="checkbox" class="teate-checked"
                    value="<?php echo $wkdetail->oup_t_wk_detail_no[$i]; ?>">
                <?php } ?>
                </td>
                <!-- Gチェック -->
                <td <?php if ($wkdetail->oup_t_wk_gchk_kbn[$i] == "1") {print("bgcolor=#80FF00");} ?>>
                  <?php if ($wkdetail->oup_t_wk_gchk_kbn[$i] == "1") {
                    print("G");
                  } else {
                    print("");
                  } ?>
                </td>
                <!-- Sチェック -->
                <td <?php if ($wkdetail->oup_t_wk_schk_kbn[$i] == "1") {print("bgcolor=silver");} ?>>
                  <?php if ($wkdetail->oup_t_wk_schk_kbn[$i] == "1") {
                    print("S");
                  } else {
                    print("");
                  } ?>
                </td>
              <?php } ?>
                
                <!-- 日付 -->
                <td>
                  <?php print(substr($wkdetail->oup_t_wk_plan_date[$i], 5, 2)."/".substr($wkdetail->oup_t_wk_plan_date[$i], 8, 2)); ?>
                </td>
                <!-- 曜日 -->
                <?php 
                    $time = strtotime(date($wkdetail->oup_t_wk_plan_date[$i]));
                    $w = date("w", $time);
                ?>
                <td>
                <?php
                if ($week[$w]=="土") {
                        print("<font color=\"blue\">");
                    } elseif ($week[$w]=="日") {
                        print("<font color=\"red\">");
                    } elseif ($holday != "" && strpos($holday,$wkdetail->oup_t_wk_plan_date[$i]) !== false) {
                    //} elseif ($holday != "" && strpos($holday,substr($wkdetail->oup_t_wk_plan_date[$i],8,2)) !== false) {
                        print("<font color=\"red\">");
                    }
                print($week[$w]);
                if (($week[$w]=="土") || ($week[$w]=="日") || ($holday != "" && strpos($holday,$wkdetail->oup_t_wk_plan_date[$i]) !== false)) {
                //if (($week[$w]=="土") || ($week[$w]=="日") || ($holday != "" && strpos($holday,substr($wkdetail->oup_t_wk_plan_date[$i],8,2)) !== false)) {
                    print("</font>");
                }
                ?>
                </td>
                <!-- 現場 -->
                <td><?php print($genbas2[$wkdetail->oup_t_wk_genba_id[$i]]); ?><?php if ($genbas2[$wkdetail->oup_t_wk_genba_id[$i]] != "") { print(' : '); } ?><?php print($genbas[$wkdetail->oup_t_wk_genba_id[$i]]); ?></td>
                
                <?php if ($flg != 1) { ?>
                    <!-- 氏名 -->
                    <td><?php print($staffs[$wkdetail->oup_t_wk_taiin_id[$i]]); ?></td>
                <?php } ?>
                
                <!-- 勤務 -->
                <td bgcolor=<?php if ($wkdetail->oup_t_wk_plan_kensyu[$i] != "") { print("#CCFF99"); }
                elseif ($shift2_color[$wkdetail->oup_t_wk_shift_no[$i]] != "") { print($shift2_color[$wkdetail->oup_t_wk_shift_no[$i]]); }  ?>><?php print(mb_substr($shift->kbn2[$wkdetail->oup_t_wk_plan_kbn[$i]],0,1)); ?><?php print($wkdetail->oup_t_wk_plan_hosoku[$i]); ?></td>
                <!-- 時給、日給 -->
                <?php if ($flg == 2) { ?>
                <td align=right bgcolor=fff6d9>
                <?php echo $shift2_ji[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_hosoku[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]] != 0 ? 
                number_format($shift2_ji[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_hosoku[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]]) : 
                '&nbsp;'; ?>
                <br>
                <?php echo $shift2_ni[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_hosoku[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]] != 0 ? 
                number_format($shift2_ni[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_hosoku[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]]) : 
                '&nbsp;'; ?>
                </td>
                <?php } ?>
                
                <?php if ($flg != 1 || ($flg == 1 && $post_flg != "false")) { ?>
                    <!-- ポスト手当て -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_post_teate[$i]!="0") { 
                            print(number_format($wkdetail->oup_t_wk_post_teate[$i])); 
                            if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                                $post = $post + $wkdetail->oup_t_wk_post_teate[$i];
                            }
                        } 
                    ?>
                    </td>
                <?php } ?>
                
                <!-- 所定時間 -->
                <td>
                  <?php echo $wkdetail->oup_t_wk_plan_joban_time[$i] !== null ? $wkdetail->oup_t_wk_plan_joban_time[$i] : '&nbsp;'; ?>
                  <br>
                  <?php echo $wkdetail->oup_t_wk_plan_kaban_time[$i] !== null ? $wkdetail->oup_t_wk_plan_kaban_time[$i] : '&nbsp;'; ?>
                </td>
                <!-- 打刻 -->
                <td>
                  <?php echo $wkdetail->oup_t_wk_joban_dakoku_time[$i] != "00:00" ? $wkdetail->oup_t_wk_joban_dakoku_time[$i] : '&nbsp;'; ?>
                  <br>
                  <?php echo $wkdetail->oup_t_wk_kaban_dakoku_time[$i] == "00:00" || $wkdetail->oup_t_wk_kaban_dakoku_time[$i] == "" ? '&nbsp;' : $wkdetail->oup_t_wk_kaban_dakoku_time[$i] ?>
                </td>
                <!-- 実績 -->
                <td>
                <?php if ($wkdetail->oup_t_wk_plan_joban_time[$i] < $wkdetail->oup_t_wk_joban_time[$i]) {print("<font color=\"red\">");} else {print("<font color=\"black\">");} ?>
                  <?php echo $wkdetail->oup_t_wk_joban_time[$i] !== null ? $wkdetail->oup_t_wk_joban_time[$i] : '&nbsp;'; ?>
                  <br>
                <?php if (($wkdetail->oup_t_wk_plan_kbn[$i] != 1 && $wkdetail->oup_t_wk_plan_kaban_time[$i] > $wkdetail->oup_t_wk_kaban_time[$i] && $wkdetail->oup_t_wk_joban_time[$i] < $wkdetail->oup_t_wk_kaban_time[$i])
                 || ($wkdetail->oup_t_wk_plan_kbn[$i] == 1 && $wkdetail->oup_t_wk_plan_kaban_time[$i] > $wkdetail->oup_t_wk_kaban_time[$i])
                 || ($wkdetail->oup_t_wk_plan_joban_time[$i] > $wkdetail->oup_t_wk_plan_kaban_time[$i] && ($wkdetail->oup_t_wk_plan_kaban_time[$i] > $wkdetail->oup_t_wk_kaban_time[$i] || 
                 $wkdetail->oup_t_wk_joban_time[$i] < $wkdetail->oup_t_wk_kaban_time[$i]))) {print("<font color=\"red\">");} else {print("<font color=\"black\">");} ?>
                  <?php echo $wkdetail->oup_t_wk_kaban_time[$i] !== null ? $wkdetail->oup_t_wk_kaban_time[$i] : '&nbsp;'; ?>
                <?php print("</font>"); ?>
                </td>
                <!--  -->
                <td <?php if ($wkdetail->oup_t_wk_joban_kbn[$i]==4 || $wkdetail->oup_t_wk_joban_kbn[$i]==5) {print("bgcolor=#ff8080");} ?>>
                  <?php
                  if ($wkdetail->oup_t_wk_kaban_kbn[$i]=="1") {
                      print("下番");
                  } elseif ($wkdetail->oup_t_wk_joban_kbn[$i]=="4") {
                      print("年休");
                  } elseif ($wkdetail->oup_t_wk_joban_kbn[$i]=="5") {
                      print("欠勤");
                  } elseif ($wkdetail->oup_t_wk_joban_kbn[$i]!="") {
                      print("上番中");
                  } else {
                      print("未");
                  } ?>
                </td>
                <!-- 勤務時間 -->
                <td <?php if ($wkdetail->oup_t_wk_inp_kbn[$i]==1) {print("bgcolor=#f7f5bc");} ?>>
                <?php /*
                    $wk00 = ($shift2_rod[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]])*60;
                    if ($wkdetail->oup_t_wk_joban_kbn[$i]=="4") {
                    } else if ($wkdetail->oup_t_wk_joban_kbn[$i]=="5") {
                    } else {
                    if ($wk00!=0) {
//                        print("<br />");
                        if ($wkdetail->oup_t_wk_stminus[$i]=="") {
                            print(sprintf('%02d',($wk00/60)).":".sprintf('%02d',($wk00%60)));
//                            print("&nbsp;");
                            $kj=$kj+$wk00;
                        } else {
                            print("<font color=\"red\">");
//                            print($wkdetail->oup_t_wk_stminus[$i]);
                            $wk01 = $wk00+($wkdetail->oup_t_wk_stminus[$i])*60;
                            print(sprintf('%02d',($wk01/60)).":".sprintf('%02d',($wk01%60)));
                            print("</font>");
                            $kjikyu=$kjikyu+$wk00+($wkdetail->oup_t_wk_stminus[$i]*60);
                            }
                        }
                    }
                */?>
                <?php 
                $jikyu = "";
                $wk00_r = ($shift2_rod[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]]*60);
                $wk00_o = ($shift2_ovr[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]]);
                $wk00_ro = ($wk00_r*60) + ($wk00_o*60);
                $wk00_ro = ($wk00_ro/60).".".sprintf("%02d",($wk00_ro%60));
                if ($wkdetail->oup_t_wk_kinmu_time[$i] != 0.00 && $wkdetail->oup_t_wk_kinmu_time[$i] != "") {
                    if ($wkdetail->oup_t_wk_plan_kbn[$i] == 1) {
                        //if ($wk00_r > $wkdetail->oup_t_wk_kinmu_time[$i] || ($wk00_r > $wkdetail->oup_t_wk_kinmu_time[$i] && $wkdetail->oup_t_wk_hayazan[$i] != "") ||
                        //($wk00_r == $wkdetail->oup_t_wk_kinmu_time[$i] && $wkdetail->oup_t_wk_hayazan[$i] == "" && $wkdetail->oup_t_wk_tuzan[$i] == "")) {
                        //if ($wk00_r > $wkdetail->oup_t_wk_kinmu_time[$i] || ($wk00_r == $wkdetail->oup_t_wk_kinmu_time[$i] && $wkdetail->oup_t_wk_hayazan[$i] != 0)
                        // || ($wk00_r == $wkdetail->oup_t_wk_kinmu_time[$i] && $wkdetail->oup_t_wk_tuzan[$i] != 0)) {
                        if ($wk00_r > $wkdetail->oup_t_wk_kinmu_time[$i]) {
                            if ($wkdetail->oup_t_wk_inp_kbn[$i] != 1) {
                                print("<font color=\"red\">");
                                $jikyu = 1;
                            }
                            if ($wkdetail->oup_t_wk_kaban_time[$i] == "") {
                                print("<font color=\"black\">");
                            }
//                            $kjikyu=$kjikyu+$wkdetail->oup_t_wk_kinmu_time[$i];
                        } else {
//                            $kj=$kj+$wkdetail->oup_t_wk_kinmu_time[$i];
                        }
                        print(sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[$i]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[$i]%60,0,2)));
                        //$kj=$kj+substr($wkdetail->oup_t_wk_kinmu_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_kinmu_time[$i],3,2);
                        print("</font>");
                    } else {
                        if ($wkdetail->oup_t_wk_plan_kbn[$i] == 6) {
                            print("<font color=\"red\">");
//                            $kjikyu=$kjikyu+$wkdetail->oup_t_wk_kinmu_time[$i];
                        //} elseif ($wk00_r > $wkdetail->oup_t_wk_kinmu_time[$i] || ($wkdetail->oup_t_wk_plan_joban_time[$i] < $wkdetail->oup_t_wk_joban_time[$i] && $wkdetail->oup_t_wk_kaban_time[$i] != "")
                        // || ($wkdetail->oup_t_wk_plan_kaban_time[$i] > $wkdetail->oup_t_wk_kaban_time[$i] && $wkdetail->oup_t_wk_joban_time[$i] != "" && $wkdetail->oup_t_wk_joban_time[$i] < $wkdetail->oup_t_wk_kaban_time[$i])) {
                        //} elseif ($wk00_r > $wkdetail->oup_t_wk_kinmu_time[$i] || ($wk00_r == $wkdetail->oup_t_wk_kinmu_time[$i] && $wkdetail->oup_t_wk_hayazan[$i] != 0)
                        // || ($wk00_r == $wkdetail->oup_t_wk_kinmu_time[$i] && $wkdetail->oup_t_wk_tuzan[$i] != 0)) {
                        } elseif ($wk00_r > $wkdetail->oup_t_wk_kinmu_time[$i]) {
                            if ($wkdetail->oup_t_wk_inp_kbn[$i] != 1) {
                                print("<font color=\"red\">");
                                $jikyu = 1;
                            }
                            //if ($wk00_r == $wkdetail->oup_t_wk_kinmu_time[$i] && $wkdetail->oup_t_wk_tuzan[$i] == 0 && $wkdetail->oup_t_wk_hayazan[$i] == 0) {
                            //    print("<font color=\"black\">");
                            //}
                            if ($wkdetail->oup_t_wk_kaban_time[$i] == "") {
                                print("<font color=\"black\">");
                            }
//                            $kjikyu=$kjikyu+$wkdetail->oup_t_wk_kinmu_time[$i];
                        } else {
                            if (strlen($wkdetail->oup_t_wk_kinmu_time[$i]) == 5) {
//                                $kj=$kj+$wkdetail->oup_t_wk_kinmu_time[$i];
                            } else {
//                                $kj=$kj+$wkdetail->oup_t_wk_kinmu_time[$i];
                            }
                        }
                        print(sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[$i]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[$i]%60,0,2)));
                        print("</font>");
                    }
                //区分年休、欠勤
                } elseif ($wkdetail->oup_t_wk_joban_kbn[$i] == "4" || $wkdetail->oup_t_wk_joban_kbn[$i] == "5") {
                    if ($wkdetail->oup_t_wk_kinmu_time[$i] != 0) {
                        print(sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[$i]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[$i]%60,0,2)));
                    } else {
                        
                    }
                //実績なし
                } elseif ($wkdetail->oup_t_wk_joban_time[$i] == "" && $wkdetail->oup_t_wk_kaban_time[$i] == "") {
                    if ($wkdetail->oup_t_wk_plan_kbn[$i] == 6) {
                        
                    } elseif ($wkdetail->oup_t_wk_plan_kbn[$i] == 1 || $wkdetail->oup_t_wk_plan_kbn[$i] == 2 || $wkdetail->oup_t_wk_plan_kbn[$i] == 3) {
                        print(sprintf("%02d",substr($wk00_r/60,0,2)).":".sprintf("%02d",substr($wk00_r%60,0,2)));
//                        $kj=$kj+$wk00_r;
                    }
                }

                ?>
                </td>
                
                <?php if ($flg != 1 || ($flg == 1 && $syotei_zan_flg != "false")) { ?>
                    <!-- 所定残 -->
                    <td <?php if ($wkdetail->oup_t_wk_inp_kbn[$i]==1) {print("bgcolor=#f7f5bc");} ?>>
                    <?php 
                    if ($wkdetail->oup_t_wk_syotei_zan[$i] != 0 && $wkdetail->oup_t_wk_syotei_zan[$i] != "") {
                        print(sprintf("%02d",$wkdetail->oup_t_wk_syotei_zan[$i]/60).":".sprintf("%02d",$wkdetail->oup_t_wk_syotei_zan[$i]%60));
    //                    $syzan = $syzan + $wkdetail->oup_t_wk_syotei_zan[$i];
                    } else {
                        //if ($wk00_o != 0 && ($wkdetail->oup_t_wk_joban_time[$i] == "" || $wkdetail->oup_t_wk_kaban_time[$i] == "")) {
                        //    print(sprintf("%02d",substr($wk00_o,0,1)).":".sprintf("%02d",substr($wk00_o,3,2)));
                        //    $syzan = $syzan + $wk00_o;
                        //} else {
                            echo '&nbsp;';
                        //}
                    }
                    ?>
                    </td>
                <?php } ?>
                
                <?php if ($flg != 1 || ($flg == 1 && $ht_zan_flg != "false")) { ?>
                    <!-- 早出, 通常 -->
                    <td <?php if ($wkdetail->oup_t_wk_inp_kbn[$i]==1) {print("bgcolor=#f7f5bc");} ?>>
                      <?php
                        if ($wkdetail->oup_t_wk_hayazan[$i] != 0 && $wkdetail->oup_t_wk_hayazan[$i] != "") {
                            print(sprintf("%02d",$wkdetail->oup_t_wk_hayazan[$i]/60).":".sprintf("%02d",$wkdetail->oup_t_wk_hayazan[$i]%60));
    //                        $szan = $szan + $wkdetail->oup_t_wk_hayazan[$i];
                        } else {
                            echo '&nbsp;';
                        }
                      ?>
                      <br>
                      <?php
                        if ($wkdetail->oup_t_wk_tuzan[$i] != 0 && $wkdetail->oup_t_wk_tuzan[$i] != "") {
                            print(sprintf("%02d",$wkdetail->oup_t_wk_tuzan[$i]/60).":".sprintf("%02d",$wkdetail->oup_t_wk_tuzan[$i]%60));
    //                        $tzan = $tzan + $wkdetail->oup_t_wk_tuzan[$i];
                        } else {
                            echo '&nbsp;';
                        }
                      //if ($jikyu == 1) {
                      //  if ($wk00_r < $wkdetail->oup_t_wk_kinmu_time[$i]+$wkdetail->oup_t_wk_hayazan[$i]+$wkdetail->oup_t_wk_tuzan[$i]) {
                      //      $jikyu = "";
                      //  }
                      //}
                      ?>
                    </td>
                <?php } ?>
                
                <?php if ($flg != 1 || ($flg == 1 && $daytime_over_time_flg != "false")) { ?>
                    <!-- 昼残残業時間 -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_daytime_over_time[$i]!="00:00") { 
                            print($wkdetail->oup_t_wk_daytime_over_time[$i]); 
    //                        $hzan = $hzan + substr($wkdetail->oup_t_wk_daytime_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_daytime_over_time[$i],3,2);
                        }
                    ?>
                    </td>
                <?php } ?>
                
                <?php if ($flg != 1 || ($flg == 1 && $rest_over_time_flg != "false")) { ?>
                    <!-- 休憩残業時間 -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_rest_over_time[$i]!="00:00") {
                            print($wkdetail->oup_t_wk_rest_over_time[$i]);
    //                        $kzan = $kzan + substr($wkdetail->oup_t_wk_rest_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_rest_over_time[$i],3,2);
                        }
                    ?>
                    </td>
                <?php } ?>
                
                <?php if ($flg != 1 || ($flg == 1 && $midnight_over_time_flg != "false")) { ?>
                    <!-- 深夜残業時間 -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_midnight_over_time[$i]!="00:00") {
                            print($wkdetail->oup_t_wk_midnight_over_time[$i]); 
    //                        $sizan = $sizan + substr($wkdetail->oup_t_wk_midnight_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_midnight_over_time[$i],3,2);
                        } 
                    ?>
                    </td>
                <?php } ?>
                
                <?php if ($flg != 1 || ($flg == 1 && $renzan_flg != "false")) { ?>
                    <!-- 連勤残 -->
                    <td <?php if ($wkdetail->oup_t_wk_renzan_kbn[$i]==1) {print("bgcolor=#f7f5bc");} ?>>
                    <?php 
                        //$wk00 = $wkdetail->oup_t_wk_renzan[$i]*60;
                        if ($wkdetail->oup_t_wk_renzan[$i] != 0) {
                            //$wk00 = sprintf("%02d",substr($wkdetail->oup_t_wk_renzan[$i],0,2))*60+substr($wkdetail->oup_t_wk_renzan[$i],-2);
                            //print(substr($wkdetail->oup_t_wk_renzan[$i],0,2).":".substr($wkdetail->oup_t_wk_renzan[$i],-2));
                            //if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                            //    $rezan = $rezan + $wk00;
                            //}
                            $wk00 = $wkdetail->oup_t_wk_renzan[$i]*60;
                            print(sprintf("%02d",$wk00/60).":".sprintf("%02d",$wk00%60));
                            if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                                $rezan = $rezan + $wk00;
                            }
                        }
                        //if ($wk00!=0) {
                        //    print(sprintf('%02d',($wk00/60)).":".sprintf('%02d',($wk00%60)));
                        //    $rezan = $rezan + $wk00;
                        //}
                    ?>
                    </td>
                <?php } ?>
                
                <?php if ($flg != 1 || ($flg == 1 && $comment_flg != "false")) { ?>
                    <!-- コメント -->
                    <?php
                        if ($wkdetail->oup_t_wk_comment[$i]!="") {
                            print("<td bgcolor=#FFFF80 data-toggle='tooltip' title='".$wkdetail->oup_t_wk_comment[$i]."'>");
                            print("○");
                            print("</td>");
                        } else {
                            print("<td></td>");
                        }
                    ?>
                <?php } ?>
<!--
                <td><?php print($wkdetail->oup_t_wk_zan[$i]); ?></td>
-->
                <?php if ($flg != 1 || ($flg == 1 && $kotuhi_flg != "false")) { ?>
                    <!-- 交通費 -->
                    <td>
                    <?php /*
                        if ($wkdetail->oup_m_kotuhi_cost[$i]!=0) { 
                            print(number_format($wkdetail->oup_m_kotuhi_cost[$i])); 
                            $kotuhi_cost = $kotuhi_cost + $wkdetail->oup_m_kotuhi_cost[$i];
                        } 
                    */ ?>
                    <?php 
                        if ($wkdetail->oup_t_wk_kotuhi[$i]!=0) { 
                            print(number_format($wkdetail->oup_t_wk_kotuhi[$i]));
                            if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                                $kotuhi = $kotuhi + $wkdetail->oup_t_wk_kotuhi[$i];
                            }
                        } 
                    ?>
                    </td>
                <?php } ?>
                
                <!-- ポスト手当て -->
                <!--<td>
                <?php /*
                    if ($wkdetail->oup_t_wk_post_teate[$i]!="0") { 
                        print(number_format($wkdetail->oup_t_wk_post_teate[$i])); 
                        $post = $post + $wkdetail->oup_t_wk_post_teate[$i];
                    } 
                */ ?>
                </td>-->
                
                <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                
                    <?php if ($flg != 1 || ($flg == 1 && $teate1_flg != "false")) { ?>
                        <!-- 正月手当て -->
                        <td>
                        <?php 
                            if ($wkdetail->oup_t_wk_shogatu_teate[$i]!="0") { 
                                print($wkdetail->oup_t_wk_shogatu_teate[$i]); 
                                if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                                    $teate1 = $teate1 + $wkdetail->oup_t_wk_shogatu_teate[$i];
                                }
                            } 
                            ?>
                        </td>
                    <?php } ?>
                    
                    <?php if ($flg != 1 || ($flg == 1 && $teate2_flg != "false")) { ?>
                        <!-- 夏季手当て -->
                        <td>
                        <?php 
                            if ($wkdetail->oup_t_wk_kaki_teate[$i]!="0") { 
                                print($wkdetail->oup_t_wk_kaki_teate[$i]); 
                                if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                                    $teate2 = $teate2 + $wkdetail->oup_t_wk_kaki_teate[$i];
                                }
                            } ?>
                        </td>
                    <?php } ?>
                    
                    <?php if ($flg != 1 || ($flg == 1 && $teate3_flg != "false")) { ?>
                        <!-- 手当て1 -->
                        <td>
                        <?php 
                            if ($wkdetail->oup_t_wk_etc_teate1[$i]!="0") { 
                                print($wkdetail->oup_t_wk_etc_teate1[$i]); 
                                if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                                    $teate3 = $teate3 + $wkdetail->oup_t_wk_etc_teate1[$i];
                                }
                            } 
                        ?>
                        </td>
                    <?php } ?>
                    
                    <?php if ($flg != 1 || ($flg == 1 && $teate4_flg != "false")) { ?>
                        <!-- 手当て2 -->
                        <td>
                        <?php 
                            if ($wkdetail->oup_t_wk_etc_teate2[$i]!="0") { 
                                print($wkdetail->oup_t_wk_etc_teate2[$i]); 
                                if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                                    $teate4 = $teate4 + $wkdetail->oup_t_wk_etc_teate2[$i];
                                }
                            } 
                        ?>
                        </td>
                    <?php } ?>
                    
                    <?php if ($flg != 1 || ($flg == 1 && $teate5_flg != "false")) { ?>
                        <!-- 手当て3 -->
                        <td>
                        <?php 
                            if ($wkdetail->oup_t_wk_etc_teate3[$i]!="0") { 
                                print($wkdetail->oup_t_wk_etc_teate3[$i]); 
                                if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                                    $teate5 = $teate5 + $wkdetail->oup_t_wk_etc_teate3[$i];
                                }
                            } 
                        ?>
                        </td>
                    <?php } ?>
                        
                <?php } ?>
                
                <!-- 勤務照会以外 -->
                <?php if ($flg != 1) { ?>
                    <td>
                    <?php if ($flg == 2 || ($flg != 2 && $inp[$wkdetail->oup_t_wk_detail_no[$i]] != 1)) { ?>
                    <a href="#" onClick="confirm1(<?php print($wkdetail->oup_t_wk_detail_no[$i]); ?>,'<?php print($staffs[$wkdetail->oup_t_wk_taiin_id[$i]]); ?>');">
                        削</a>
                    <?php } ?>
                    </td>
                <?php } ?>
              </tr>

<?php 
                //$cnt_flg = "";
                //if ($wkdetail->oup_t_wk_kinmu_time[$i] < 1 && $shift->kbn2[$wkdetail->oup_t_wk_plan_kbn[$i]] != "年休") {
                //    $cnt_flg = 1;
                //}
                //if ($cnt_flg != 1) {
                //    if ($wkdetail->oup_t_wk_joban_kbn[$i]=="4") {
                //        $ycnt = $ycnt+1;
                //    } else if ($wkdetail->oup_t_wk_joban_kbn[$i]=="5") {
                //        $kcnt = $kcnt+1;
                //    } else {
                //        if ($wkdetail->oup_t_wk_plan_kbn[$i]=="1" && $jikyu == "") {
                //            $dcnt = $dcnt+1;
                //        } else if ($wkdetail->oup_t_wk_plan_kbn[$i]=="2" && $jikyu == "") {
                //            $scnt = $scnt+1;
                //        } else if ($wkdetail->oup_t_wk_plan_kbn[$i]=="3" && $jikyu == "") {
                //            $tcnt = $tcnt+1;
                //        } else if ($wkdetail->oup_t_wk_plan_kbn[$i]=="6" || $jikyu == 1) {
                //            $jcnt = $jcnt+1;
                //        }
                //    }
                //}
                if ($wkdetail->oup_t_wk_joban_kbn[$i]=="4" && $wkdetail->oup_t_wk_plan_date[$i] <= date("Y-m-d")) {
                    $ycnt = $ycnt+1;
                } else if ($wkdetail->oup_t_wk_joban_kbn[$i]=="5" && $wkdetail->oup_t_wk_plan_date[$i] <= date("Y-m-d")) {
                    $kcnt = $kcnt+1;
                } else if ($shift->kbn2[$wkdetail->oup_t_wk_plan_kbn[$i]] == "年休" && $wkdetail->oup_t_wk_plan_date[$i] <= date("Y-m-d")) {
                    $ycnt = $ycnt+1;
                } else {
                    if ($wkdetail->oup_t_wk_joban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                        if ($wkdetail->oup_t_wk_plan_kbn[$i]=="6" || $jikyu == 1) {
                            if ($wkdetail->oup_t_wk_kinmu_time[$i] != 0) {
                                $jcnt = $jcnt+1;
                            }
                            $kjikyu=$kjikyu+$wkdetail->oup_t_wk_kinmu_time[$i];
                            //$kj=$kj+$wkdetail->oup_t_wk_kinmu_time[$i];
                        } else if ($wkdetail->oup_t_wk_plan_kbn[$i]=="1") {
                            if ($wkdetail->oup_t_wk_kinmu_time[$i] != 0) {
                                $dcnt = $dcnt+1;
                            }
                            $kj=$kj+$wkdetail->oup_t_wk_kinmu_time[$i];
                        } else if ($wkdetail->oup_t_wk_plan_kbn[$i]=="2") {
                            if ($wkdetail->oup_t_wk_kinmu_time[$i] != 0) {
                                $scnt = $scnt+1;
                            }
                            $kj=$kj+$wkdetail->oup_t_wk_kinmu_time[$i];
                        } else if ($wkdetail->oup_t_wk_plan_kbn[$i]=="3") {
                            if ($wkdetail->oup_t_wk_kinmu_time[$i] != 0) {
                                $tcnt = $tcnt+1;
                            }
                            $kj=$kj+$wkdetail->oup_t_wk_kinmu_time[$i];
                        } else {
                        
                        }
                        if ($wkdetail->oup_t_wk_syotei_zan[$i] != 0) {
                            $syzan = $syzan + $wkdetail->oup_t_wk_syotei_zan[$i];
                        }
                        if ($wkdetail->oup_t_wk_hayazan[$i] != 0) {
                            $szan = $szan + $wkdetail->oup_t_wk_hayazan[$i];
                        }
                        if ($wkdetail->oup_t_wk_tuzan[$i] != 0) {
                            $tzan = $tzan + $wkdetail->oup_t_wk_tuzan[$i];
                        }
                        if ($wkdetail->oup_t_wk_daytime_over_time[$i]!="00:00") {
                            $hzan = $hzan + substr($wkdetail->oup_t_wk_daytime_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_daytime_over_time[$i],3,2);
                        }
                        if ($wkdetail->oup_t_wk_rest_over_time[$i]!="00:00") {
                            $kzan = $kzan + substr($wkdetail->oup_t_wk_rest_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_rest_over_time[$i],3,2);
                        }
                        if ($wkdetail->oup_t_wk_midnight_over_time[$i]!="00:00") {
                            $sizan = $sizan + substr($wkdetail->oup_t_wk_midnight_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_midnight_over_time[$i],3,2);
                        }
                    }
                }
?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <br />

      <table nowrap <?php echo $flg != 1 ? "width=1200" : "width=100%"; ?>>
      <tr>
      <td>
      
      <div class="row">
        <div class="col-12">
          <table>
            <tr>
              <td valign="top">

                <table style="border-collapse:collapse; font-size: 10pt;" cellpadding="4">
                  <tr>
                    <td style="border:1px; border-style: solid solid none solid;" colspan="2" width="100" bgcolor="FFDCA5">合計<?php if ($staff_id!="" || $flg==1) { print("回数"); } else { print("人数"); } ?></td>  <?php /* 上:、右:、下:、左: */ ?>
                    <td style="border:1px solid black" align="right" width="80" colspan="3"><?php print(count($wkdetail->oup_t_wk_detail_no)); ?> <?php if ($staff_id!="" || $flg==1) { print("回"); } else { print("人"); } ?></td>
                  </tr>
                  <tr>
                    <td style="border:1px; border-style: none solid none solid;" bgcolor="FFDCA5">&nbsp;</td>
                    <td style="border:1px solid black" bgcolor="FFDCA5" width="80">泊</td>
                    <td style="border:1px solid black" align="right" width="80"><?php print($dcnt); ?> <?php if ($staff_id!="" || $flg==1) { print("回"); } else { print("人"); } ?></td>
                    <td style="border:1px solid black" bgcolor="FFDCA5" width="80">年休</td>
                    <td style="border:1px solid black" align="right" width="80"><?php print($ycnt); ?> <?php if ($staff_id!="" || $flg==1) { print("回"); } else { print("人"); } ?></td>
                  </tr>
                  <tr>
                    <td style="border:1px; border-style: none solid none solid;" bgcolor="FFDCA5">&nbsp;</td>
                    <td style="border:1px solid black" bgcolor="FFDCA5">日勤</td>
                    <td style="border:1px solid black" align="right"><?php print($scnt); ?> <?php if ($staff_id!="" || $flg==1) { print("回"); } else { print("人"); } ?></td>
                    <td style="border:1px solid black" bgcolor="FFDCA5">欠勤</td>
                    <td style="border:1px solid black" align="right"><?php print($kcnt); ?> <?php if ($staff_id!="" || $flg==1) { print("回"); } else { print("人"); } ?></td>
                    </tr>
                  <tr>
                    <td style="border:1px; border-style: none solid solid solid;" bgcolor="FFDCA5">&nbsp;</td>
                    <td style="border:1px solid black" bgcolor="FFDCA5">夜勤</td>
                    <td style="border:1px solid black" align="right"><?php print($tcnt); ?> <?php if ($staff_id!="" || $flg==1) { print("回"); } else { print("人"); } ?></td>
                    <!--<td style="border:1px solid black" bgcolor="d5d5d5" colspan="2" ></td>-->
                    <td style="border:1px solid black" bgcolor="FFDCA5">時給</td>
                    <td style="border:1px solid black" align="right"><?php print($jcnt); ?> <?php if ($staff_id!="" || $flg==1) { print("回"); } else { print("人"); } ?></td>
                  </tr>
                </table>

              </td>
              <td width="20">　
              </td>
              
            <?php if ($flg == 1) { ?>
            </tr>
            <tr>
              <td height="30">　
              </td>
            </tr>
            <tr>
            <?php } ?>

              <td valign="top">
              <table class="text-nowrap" border="1" style="font-size: 10pt;" cellpadding="4">
                <tr>
                  <td bgcolor="FFDCA5" colspan="9" align="center">合計</td>
                </tr>
                <tr>
                  <td width="60" align="center" bgcolor="FFDCA5">勤務時間</td>
                  <td width="60" align="center" bgcolor="FFDCA5">時給時間</td>
                  <td width="60" align="center" bgcolor="FFDCA5">所定残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">早出残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">通常残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">昼残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">休憩残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">深夜残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">連勤残</td>
                </tr>
                <tr>
                  <td align="center">
                  <?php
                    if ($kj!=0) {
                        print(sprintf('%02d',($kj/60)).":".sprintf('%02d',($kj%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($kjikyu!=0) {
                        print(sprintf('%02d',($kjikyu/60)).":".sprintf('%02d',($kjikyu%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($syzan!=0) {
                        print(sprintf('%02d',($syzan/60)).":".sprintf('%02d',($syzan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($szan!=0) {
                        print(sprintf('%02d',($szan/60)).":".sprintf('%02d',($szan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($tzan!=0) {
                        print(sprintf('%02d',($tzan/60)).":".sprintf('%02d',($tzan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($hzan!=0) {
                        print(sprintf('%02d',($hzan/60)).":".sprintf('%02d',($hzan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($kzan!=0) {
                        print(sprintf('%02d',($kzan/60)).":".sprintf('%02d',($kzan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($sizan!=0) {
                        print(sprintf('%02d',($sizan/60)).":".sprintf('%02d',($sizan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($rezan!=0) {
                        print(sprintf('%02d',($rezan/60)).":".sprintf('%02d',($rezan%60)));
                    }
                  ?>
                  </td>
                </tr>
              </table>
              </td>
              <td width="20">　
              </td>
              
            <?php if ($flg == 1 && $common->judgephone2) { ?>
            </tr>
            <tr>
              <td height="30">　
              </td>
            </tr>
            <tr>
            <?php } ?>

              <td valign="top">
              <table class="text-nowrap" border="1" style="font-size: 10pt;" cellpadding="4">
                <tr>
                  <td bgcolor="FFDCA5" colspan="7" align="center">合計</td>
                </tr>
                <tr>
                  <td width="60" align="center" bgcolor="FFDCA5">交通費</td>
                  <td width="60" align="center" bgcolor="FFDCA5">ﾎﾟｽﾄ</td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[0]); ?></td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[1]); ?></td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[2]); ?></td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[3]); ?></td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[4]); ?></td>
                </tr>
                <tr>
                  <td align="right">
                  <?php /*
                    if ($kotuhi_cost!="") {
                        print(number_format($kotuhi_cost));
                    }
                  */ ?>
                  <?php 
                    if ($kotuhi!="") {
                        print(number_format($kotuhi));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($post!="") {
                        print(number_format($post));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate1!="") {
                        print(number_format($teate1));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate2!="") {
                        print(number_format($teate2));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate3!="") {
                        print(number_format($teate3));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate4!="") {
                        print(number_format($teate4));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate5!="") {
                        print(number_format($teate5));
                    }
                  ?>
                  </td>
                </tr>
              </table>
              </td>

            </tr>
          </table>
        </div>
      </div>
      
      </td>
      </tr>
      </table>
      
      <br />
      
<!-- 総務用　支給合計欄 -->
<?php if ($flg == 2) { ?>
      <?php if ($kyuyo->oup_m_kyuyo_no[0] != "") { ?>
      <div class="row" id="<?php print($kyuyo->oup_m_kyuyo_no[0]); ?>">
      <?php } else { ?>
      <div class="row" id="99999">
      <?php } ?>
        <div class="col-12">
          <?php if ($kyuyo->oup_m_kyuyo_name[0] != "") { ?>
          <table>
              <tr>
                  <!--<td><input type="submit" name="prev2" value="&lt;" ></td>-->
                  
                  <!--<td>
                  <input type="checkbox" 
                  <?php if ($kyuyo->oup_m_kyuyo_kbn[0] == 1) {
                  echo "value='1' checked >手修正(済)";
                  } else {
                  echo "value=''>手修正(未)";
                  } ?>
                  </td>-->
                  
                  <td style="border:1px solid; padding:3px;" bgcolor=ffffa7><?php echo $kyuyo->oup_m_kyuyo_name[0]; ?></td>
                  
                  <!--<td><input type="submit" name="next2" value="&gt;" ></td>-->
                  
                  <?php if ($kyuyo->oup_m_kyuyo_kbn[0] == 1) {
                  echo "<td style='color:red;'>手修正(済)</td>";
                  } else {
                  echo "<td>手修正(未)</td>";
                  } ?>
                  
              </tr>
          </table>
          <?php } ?>
          <table class="table1" style="border-collapse:collapse; font-size: 10pt;" width=1200>
          <?php /* if ($kyuyo->oup_m_kyuyo_name[0] != "") { ?>
            <tr>
                <td style="border:1px solid; padding:3px;" bgcolor=ffffa7><?php echo $kyuyo->oup_m_kyuyo_name[0]; ?></td>
            </tr>
          <?php } */ ?>
            <?php for ($i=0;$i<4;$i++) {
                echo "<tr>";
                if ($i == 0) {
                    echo "<td class='td3' rowspan=4 style='white-space:normal;'>支給欄</td>";
                    echo "<td class='td1'></td>";
                    echo "<td class='td1'>泊①</td>";
                    echo "<td class='td1'>泊②</td>";
                    echo "<td class='td1'>夜勤①</td>";
                    echo "<td class='td1'>夜勤②</td>";
                    echo "<td class='td1'>日勤①</td>";
                    echo "<td class='td1'>日勤②</td>";
                    echo "<td class='td1'>日勤③</td>";
                    echo "<td class='td1'>時間給</td>";
                    echo "<td class='td1'>時間外①</td>";
                    echo "<td class='td1'>時間外②</td>";
                    echo "<td class='td1'>深夜残</td>";
                    for ($j=0;$j<8;$j++) {
                        if ($j != 7) {
                            echo "<td></td>";
                        }
                        elseif ($j == 7) {
                            echo "<td><button type='submit' name='kyuyo' class='btn btn-success btn-block'>登録</button></td>";
                        }
                    }
                    
                } elseif ($i == 1) {
                    echo "<td class='td1'>時間</td>";
                    echo "<td class='td2'><input type='text' name='k1' value='".num_format2($kyuyo->oup_m_kyuyo_k1[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k2' value='".num_format2($kyuyo->oup_m_kyuyo_k2[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k3' value='".num_format2($kyuyo->oup_m_kyuyo_k3[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k4' value='".num_format2($kyuyo->oup_m_kyuyo_k4[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k5' value='".num_format2($kyuyo->oup_m_kyuyo_k5[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k6' value='".num_format2($kyuyo->oup_m_kyuyo_k6[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k7' value='".num_format2($kyuyo->oup_m_kyuyo_k7[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k8' value='".num_format2($kyuyo->oup_m_kyuyo_k8[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k9' value='".num_format2($kyuyo->oup_m_kyuyo_k9[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k10' value='".num_format2($kyuyo->oup_m_kyuyo_k10[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='k11' value='".num_format2($kyuyo->oup_m_kyuyo_k11[0])."'></td>";
                    //for ($j=0;$j<7;$j++) {
                    //    echo "<td></td>";
                    //}
                } elseif ($i == 2) {
                    echo "<td class='td1'>単価</td>";
                    echo "<td class='td2'><input type='text' name='h1' value='".num_format($kyuyo->oup_m_kyuyo_h1[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h2' value='".num_format($kyuyo->oup_m_kyuyo_h2[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h3' value='".num_format($kyuyo->oup_m_kyuyo_h3[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h4' value='".num_format($kyuyo->oup_m_kyuyo_h4[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h5' value='".num_format($kyuyo->oup_m_kyuyo_h5[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h6' value='".num_format($kyuyo->oup_m_kyuyo_h6[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h7' value='".num_format($kyuyo->oup_m_kyuyo_h7[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h8' value='".num_format($kyuyo->oup_m_kyuyo_h8[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h9' value='".num_format($kyuyo->oup_m_kyuyo_h9[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h10' value='".num_format($kyuyo->oup_m_kyuyo_h10[0])."'></td>";
                    echo "<td class='td2'><input type='text' name='h11' value='".num_format($kyuyo->oup_m_kyuyo_h11[0])."'></td>";
                    
                    echo "<td class='td1'>交通費</td>";
                    echo "<td class='td1'>ﾎﾟｽﾄ</td>";
                    echo "<td class='td1'>正月</td>";
                    echo "<td class='td1'>夏季</td>";
                    echo "<td class='td1'>資格手当</td>";
                    echo "<td class='td1'>車代</td>";
                    echo "<td class='td1'>③</td>";
                    echo "<td class='td1'>支給計</td>";
                } elseif ($i == 3) {
                    echo "<td class='td3'>金額</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s1[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s2[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s3[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s4[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s5[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s6[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s7[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s8[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s9[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s10[0])."</td>";
                    echo "<td class='td3'>".num_format($kyuyo->oup_m_kyuyo_s11[0])."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k1[0]*$kyuyo->oup_m_kyuyo_h1[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k2[0]*$kyuyo->oup_m_kyuyo_h2[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k3[0]*$kyuyo->oup_m_kyuyo_h3[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k4[0]*$kyuyo->oup_m_kyuyo_h4[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k5[0]*$kyuyo->oup_m_kyuyo_h5[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k6[0]*$kyuyo->oup_m_kyuyo_h6[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k7[0]*$kyuyo->oup_m_kyuyo_h7[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k8[0]*$kyuyo->oup_m_kyuyo_h8[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k9[0]*$kyuyo->oup_m_kyuyo_h9[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k10[0]*$kyuyo->oup_m_kyuyo_h10[0]))."</td>";
                    //echo "<td class='td3'>".num_format(($kyuyo->oup_m_kyuyo_k11[0]*$kyuyo->oup_m_kyuyo_h11[0]))."</td>";
                    
                    echo "<td name='s13' value='".$kyuyo->oup_m_kyuyo_e13[0]."' class='td3'>".num_format($kyuyo->oup_m_kyuyo_s13[0])."</td>";
                    echo "<td name='s12' value='".$kyuyo->oup_m_kyuyo_e12[0]."' class='td3'>".num_format($kyuyo->oup_m_kyuyo_s12[0])."</td>";
                    echo "<td name='e2' value='".$kyuyo->oup_m_kyuyo_e2[0]."' class='td3'>".num_format($kyuyo->oup_m_kyuyo_e2[0])."</td>";
                    echo "<td name='e3' value='".$kyuyo->oup_m_kyuyo_e3[0]."' class='td3'>".num_format($kyuyo->oup_m_kyuyo_e3[0])."</td>";
                    echo "<td name='e4' value='".$kyuyo->oup_m_kyuyo_e4[0]."' class='td3'>".num_format($kyuyo->oup_m_kyuyo_e4[0])."</td>";
                    echo "<td name='e5' value='".$kyuyo->oup_m_kyuyo_e5[0]."' class='td3'>".num_format($kyuyo->oup_m_kyuyo_e5[0])."</td>";
                    echo "<td name='e6' value='".$kyuyo->oup_m_kyuyo_e6[0]."' class='td3'>".num_format($kyuyo->oup_m_kyuyo_e6[0])."</td>";
                    $total = 0;
                    for ($i=1;$i<14;$i++) {
                        if ($kyuyo->{oup_m_kyuyo_s.$i}[0] != 0) {
                            $total = $total + $kyuyo->{oup_m_kyuyo_s.$i}[0];
                        }
                    }
                    for ($i=2;$i<7;$i++) {
                        if ($kyuyo->{oup_m_kyuyo_e.$i}[0] != 0) {
                            $total = $total + $kyuyo->{oup_m_kyuyo_e.$i}[0];
                        }
                    }
                    echo "<td name='' value='' class='td3'>".num_format($total)."</td>";
                }
                echo "</tr>";
            } ?>
            <input type="hidden" name="kyuyo_no" value="<?php echo $kyuyo->oup_m_kyuyo_no[0]; ?>">
            <!--<input type="hidden" name="kyuyo_k0" value="<?php echo $kyuyo->oup_m_kyuyo_k0[0]; ?>">-->
          </table>
        </div>
      </div>
<?php } ?>

      <br>

<!-- 勤務照会以外 -->
<?php if ($flg != 1 && $staff2->oup_m_staff_auth[0]!="4") { ?>

      <?php if ($staff2->oup_m_staff_auth[0]=="1") { $col1 = 4; $col2 = 5; } else { $col1 = 6; $col2 = 6; } ?>
      
      <table nowrap width=1200>
      <tr>
      <td>
      
      <div class="row">
        <div class="col-<?php print($col1); ?>">
          <table>
            <tr>
              <td>時間外一括登録　</td>
              <td>
                <select name="over_time" class="form-control">
                  <option value="">
                  <option value="daytime">昼残
                  <option value="rest">休憩残
                  <option value="midnight">深夜残
                </select>
              </td>
              <td>
                <select class="form-control form-control" name="input_over">
                  <option value="">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $wkdetail->oup_t_wk_daytime_over_time[0] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-<?php print($col2); ?>">
          <table>
            <tr>
              <td>手当て一括登録　</td>
              <td>
                <select name="select_teate" class="form-control">
                  <option value="">
                  <option value="post_teate">ﾎﾟｽﾄ手当
                  <option value="kotu_teate">交通費
                  <option value="shogatu_teate"><?php print($teate->oup_m_teate_name[0]); ?>
                  <option value="kaki_teate"><?php print($teate->oup_m_teate_name[1]); ?>
                  <option value="etc_teate1"><?php print($teate->oup_m_teate_name[2]); ?>
                  <option value="etc_teate2"><?php print($teate->oup_m_teate_name[3]); ?>
                  <option value="etc_teate3"><?php print($teate->oup_m_teate_name[4]); ?>
                </select>
              </td>
              <td>
                <input type="tel" name="input_teate" size="6" class="form-control" value="">
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
        <div class="col-3">
          <table>
            <tr>
              <td>Gチェック&nbsp;&#10004;&nbsp;</td>
              <td>
                <select name="gchk" class="form-control">
                  <option value="">
                  <option value="2">未
                  <option value="1">済
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <?php } ?>
      </div>
      
      </td>
      </tr>
      
      <br />
      
      <tr height=30>
      <td>
      </td>
      </tr>
      
      <?php if ($staff2->oup_m_staff_auth[0]=="1") { $col1 = 5; $col2 = 4; } else { $col1 = 6; $col2 = 6; } ?>
      
      <tr>
      <td>
      
      <div class="row">
        <div class="col-<?php print($col1); ?>">
          <table>
            <tr>
              <td>上下番一括登録　</td>
              <td>
                <select name="select_kbn" class="form-control">
                  <option value="">
                  <option value="joban">上番
                  <option value="kaban">下番
                </select>
              </td>
              <td>
                <select name="time1" class="form-control">
                  <option value="">
<?php for ($i=0;$i<24;$i++) { ?>
                  <option value="<?php print(sprintf('%02d', $i)); ?>"><?php print(sprintf('%02d', $i)); ?>
<?php } ?>
                </select>
              </td>
              <td>
                :
              </td>
              <td>
                <select name="time2" class="form-control">
                  <option value="">
<?php for ($i=0;$i<60;$i++) { ?>
                  <option value="<?php print(sprintf('%02d', $i)); ?>"><?php print(sprintf('%02d', $i)); ?>
<?php } ?>
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-<?php print($col2); ?>">
          <table>
            <tr>
              <td>年休・欠勤一括登録　</td>
              <td>
                <select name="select_nk" class="form-control">
                  <option value="">
                  <option value="4">年休
                  <option value="5">欠勤
                </select>
              </td>
              <td>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
        <div class="col-3">
          <table>
            <tr>
              <td>Sチェック&nbsp;&#10004;&nbsp;</td>
              <td>
                <select name="schk" class="form-control">
                  <option value="">
                  <option value="2">未
                  <option value="1">済
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <?php } ?>
      </div>
      
      </td>
      </tr>
      </table>
      
<?php } ?>

      <br />

      <table nowrap <?php echo $flg != 1 ? "width=1200" : "width=100%"; ?>>
      <tr>
      <td>
      
      <div class="row">
        <div class="col-12">
          <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          <?php } else { ?>
          <a href="../menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          <?php } ?>
        </div>
      </div>
      
      <?php if ($flg == 2) { ?>
      <div class="row" style="margin-top:30px;">
        <div class="col-12">
          <a href="kinmusyukei.php" class="btn btn-primary btn-block" role="button" aria-pressed="true">給与連携処理（総務)へ</a>
        </div>
      </div>
      <?php } ?>
      
      </td>
      </tr>
      </table>
      
      <br />

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->
</section>
</body>

</html>