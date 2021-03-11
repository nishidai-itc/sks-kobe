<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
  
  <!-- 勤務複数検索 -->
  <!--<link rel="stylesheet" href="./../multiple/multiple-select.min.css">-->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <?php /*    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script> */ ?>
  <script type="text/javascript" src="../bootstrap/js/jquery.balloon.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
  
  <!-- 勤務複数検索 -->
  <!--<script src="./../multiple/multiple-select.min.js"></script>-->
  
  <title>勤怠管理システム</title>
</head>

<style>
    <?php print($none); ?>
    <?php print($center); ?>
    a.disabled1{pointer-events: none;}
    a.disabled_a{pointer-events: none; padding:0; margin:0;}
/*
    .ms-parent {
        padding:0;
    }
    .ms-choice {
        height:100%;
    }
*/
</style>

<script type="text/javascript">

$(function(){
    //$('#genba_id').multipleSelect();
    
    //ボタン
    var b_val = $('input[name="chk_kbn"]').val();
    //初期表示
    if (b_val == '入力') {
        $('#chk_kbn').val('入力');
    } else {
        $('#chk_kbn').val('選択');
    }
    var nengetu;
    nengetu = $('#nengetu').remove();
        //初期、再読み込み時
        if (b_val == '入力') {
            $('#nengetu_t').attr('type','text');
        } else {
            $('#nen').append(nengetu);
        }
    //ボタンクリック
    $('#chk_kbn').click(function(){
    b_val = $('input[name="chk_kbn"]').val();
        if (b_val == '入力') {
            $('input[name="chk_kbn"]').val('選択');
            $(this).val('選択');
            $('#nengetu_t').attr('type','hidden');
            $('#nen').append(nengetu);
        } else {
            $('input[name="chk_kbn"]').val('入力');
            $(this).val('入力');
            nengetu = $('#nengetu').remove();
            $('#nengetu_t').attr('type','text');
        }
    });
});

function FJS_Location(mode,nengetu){
var genba_id = $('#genba_id').val();
//var nengetu = $('#nengetu').val();
var shift_no = $('#shift_no').val();
    switch(mode) {
        case 1:			// 印刷
            winprint=window.open('kinmuyotei.php?search=&dispctl=1&genba_id=' + genba_id + '&nengetu=' + nengetu,'勤務予定表','width=1000,height=1000,toolbar=0,location=0,directories=0,status=0,menubar=1,scrollbars=1,resizable=1');
            winprint.print(); 
            break;
    }
}

function confirm1(no,taiin_id,name) {
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  
  if (!confirm(name + 'さんの項目を削除してもよろしいですか?')) return false;
  location.href = "kinmuyotei.php?search=&delete1=&wk_no=" + no + "&taiin_id=" + taiin_id + "&genba_id=" + genba_id + "&nengetu=" + nengetu +
    "&shift_no=" + shift_no;
}

function confirm2() {
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  if (!confirm('既に予定確定データがあります、更新してもよろしいですか?')) return false;
  location.href = "kinmuyotei.php?search=&conf=&genba_id=" + genba_id + "&nengetu=" + nengetu;
}

function regist(wk_no, id) {
  var token = $('#token').val();
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  var kensyu = $('#kensyu:checked').val();
  var pos = $(window).scrollTop();
  if (shift_no == "") {
    alert('登録するシフトを選択してください');
  } else {
    location.href = "kinmuyotei.php?search=&regist=&genba_id=" + genba_id + "&nengetu=" + nengetu + "&shift_no=" +
      shift_no + "&wk_no=" + wk_no + "&id=" + id + "&kensyu=" + kensyu + "&pos=" + pos + "&token=" + token;
  }
}

function ins() {
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  var kensyu = $('#kensyu:checked').val();
  var staff_id = $('#staff_id').val();
  if (staff_id == "") {
    alert('登録する隊員を選択してください');
  } else {
    location.href = "kinmuyotei.php?search=&ins=&genba_id=" + genba_id + "&nengetu=" + nengetu + "&shift_no=" +
      shift_no + "&staff_id=" + staff_id + "&kensyu=" + kensyu;
  }
}

function del(wk_no) {
  var token = $('#token').val();
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  var kensyu = $('#kensyu:checked').val();
  var pos = $(window).scrollTop();
  location.href = "kinmuyotei.php?search=&delete2=&genba_id=" + genba_id + "&nengetu=" + nengetu + "&shift_no=" +
    shift_no + "&wk_no=" + wk_no + "&pos=" + pos + "&kensyu=" + kensyu + "&token=" + token;
}
</script>

<script>
jQuery(function($) {
  var tableSheet = $('table.sheet');
  var offset = tableSheet.offset();
  $('.fixheader').width(tableSheet.width());

  $(window).scroll(function() {
    if ($(window).scrollTop() > tableSheet.offset().top &&
      $(window).scrollTop() < (tableSheet.offset().top + tableSheet.height())) {
      var fixheaderTop = $(window).scrollTop();
      $('.fixheader').show();
    } else {
      $('.fixheader').hide();
    }
  });

  $(window).resize(function() {
    $('.fixheader').width(tableSheet.width());
  });
  
  //$("#user_kana").change( function(){
  //var genba_id = $('#genba_id').val();
  //    self.location = "kinmuyotei.php?search=&genba_id=" + genba_id + "&user_kana="+$('#user_kana').val() + "&nengetu="+$('#nengetu').val();
  //});
});
</script>

<!-- カナ検索絞込み -->
<?php require_once('../../models/common/script.php'); ?>

<body onload="start()">
  <div class="container-fluid">
  <table class="m-auto">
  <tr>
  <td>
    <div class="page-header">
      <h4>勤務予定表<?php print $dispctl != "" ? "　（印刷用）　" : "" ; ?></h4>
    </div>
    <form name="frm" id="frm" method="POST" action="kinmuyotei.php">
      <input type="hidden" name="scroll_top" value="" class="st">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table style="border-collapse:collapse;">
            <tr>
              <td style="border:1px; border-style: solid;">
                <table>
                  <tr>
                    <td bgcolor="#d5d5d5" nowrap>現場名</td>
                    <td bgcolor="#d5d5d5" width=130>
                    
                      <select id="genba_id" name="genba_id" class="form-control" <?php print($disabled); ?>>
                      <!--<select id="genba_id" name="genba_id[]" class="form-control" <?php print($disabled); ?> multiple="multiple" size="1">-->
                        <option value=""></option>
                        <?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                        <option value="<?php print($genba->oup_m_genba_id[$i]); ?>" <?php
                        /*
                        for ($j=0;$j<count($genba_id);$j++) {
                            if ($genba_id[$j]===$genba->oup_m_genba_id[$i]) {
                                print("selected");
                            }
                        }
                        */
                        if ($genba_id===$genba->oup_m_genba_id[$i]) {
                            print("selected");
                        } ?>><?php print($genba->oup_m_genba_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                      
                    </td>
                    <td bgcolor="#d5d5d5" nowrap>年月　</td>
                    <td bgcolor="d5d5d5" class="p-0" <?php print($display); ?>>
                    <!-- ボタン -->
                    <input type="button" id="chk_kbn" value="">
                    <input type="hidden" name="chk_kbn" value="<?php print($chk_kbn); ?>">
                    </td>
                    <td id="nen" width="150" bgcolor="#d5d5d5">
                    
                      <input type="hidden" class="form-control" id="nengetu_t" name="nengetu" maxlength="6" value="<?php print($nengetu); ?>">
                      <select id="nengetu" class="form-control" name="nengetu" <?php print($disabled); ?>>
                        <?php for($i=$start;$i<=$end;$i=date('Ym01', strtotime($i.'+1 month'))) { ?>
                        <option value="<?php echo substr($i,0,6) ?>" <?php echo substr($i,0,6) == $nengetu ? 'selected':"" ?>><?php echo substr($i,0,6) ?></option>
                        <?php } ?>
                      </select>
                      
                    <!-- <input type="tel" size="6" id="nengetu" name="nengetu" class="form-control"
                    value="<?php print($nengetu); ?>"> -->
                    </td>
                    <td>
                      <label>
                        <input type="checkbox" id="jikan" name="jikan" value="1" <?php print($disabled); ?>> 時間表示　
                      </label>
                    </td>
                    
                    <!-- 印刷表示用 -->
                    <?php if ($dispctl != "") { ?>
                    <?php } else { ?>
                    
                    <td bgcolor="#d5d5d5">
                      <button type="submit" class="btn btn-info btn-block" role="button" name="search">検索</button>
                    </td>
                    
                    <?php } ?>
                    
                  </tr>
                </table>
              </td>
              <td style="border:1px; border-style: solid;">
                <table>
                  <tr>
                    <td>
                      <!-- シフト -->
                      <!--<select id="shift_no" name="shift_no" class="form-control" <?php if ($disabled != "" || $genba_flg != false) {print(disabled);} ?>>-->
                      <select id="shift_no" name="shift_no" class="form-control" <?php if ($disabled != "") {print(disabled);} ?>>
                        <option></option>
                        <?php for ($i=0;$i<count($shift->oup_m_shift_no);$i++) { ?>
                        <option value="<?php print($shift->oup_m_shift_no[$i]); ?>" <?php if ($shift_no===$shift->oup_m_shift_no[$i]) {
                            print("selected");
                        } ?>>
                          <?php print($shift->kbn[$shift->oup_m_shift_plan_kbn[$i]].$shift->oup_m_shift_plan_hosoku[$i]."　".$shift->oup_m_shift_joban_time[$i]." ～ ".$shift->oup_m_shift_kaban_time[$i]); ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>
                    <td>
<?php
    if($_REQUEST['kensyu'] == '1'){ $ken_checked = ' checked = "checked" '; }
?>
                      <label>
                        <input type="checkbox" id="kensyu" name="kensyu" value="1" <?php echo($ken_checked); ?> <?php print($disabled); ?>> <span style="background-color:#CCFF99;">研</span>　
                      </label>
                    </td>
                  </tr>
                </table>
              </td>
              
              <!-- 印刷表示以外 -->
              <?php if ($dispctl == "") { ?>
              
              <td width="50">&nbsp;</td>
              <!--<td ><button type="submit" class="btn btn-info btn-block" role="button" name="print" onClick="FJS_Location(1)">印刷用照会</button></td>-->
              <td ><input type="button" class="btn btn-secondary btn-block" role="button" name="print" value="印刷用照会" onClick="FJS_Location(1,<?php print($nengetu); ?>)"></td>
              <td width="50">&nbsp;</td>
              
              <?php //if ($genba_flg != true) { ?>
              <td ><button type="submit" class="btn btn-info btn-block" role="button" name="copy">前月コピー</button></td>
              <?php //} ?>
              
              <td width="50">&nbsp;</td>
              <td>
              <?php //if ($staff2->oup_m_staff_auth[0]=="1") { ?>
              <?php if ($_SESSION["menu_flg"]=="kanri") { ?>
              <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
              <?php } else { ?>
              <a href="../menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
              <?php } ?>
              </td>
              <?php } ?>
              
            </tr>
          </table>
        </div>
      </div>
      <br />

      <?php
      // 総合計
      $total_dayk1cnt = 0;
      $total_dayk2cnt = 0;
      $total_dayk3cnt = 0;
      $total_result_rodo_time = 0;
      $total_result_over_time = 0;
      ?>
      <?php if (isset($_REQUEST['search'])) { ?>
      <div class="row">
        <div class="col-xs-12 col-md-12">
<?php /* ?>
          <table border="1" class="fixheader"
            style="display: none; position: fixed; top: 0; border-collapse: collapse; table-layout: fixed;">
            <thead>
              <tr class="text-center" bgcolor="FFDCA5">
                <th width="43">&nbsp;</th>
                <th width="43">&nbsp;</th>
                <th width="75"></th>
                <th colspan="31"><?php print($nengetu); ?></th>
                <th colspan="5" rowspan="2">集計</th>
                <th width="24" rowspan="3">&nbsp;</th>
              </tr>
              <tr class="text-center" bgcolor="FFDCA5">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>勤務者</th>
                <?php for ($i=1;$i<=31;$i++) { ?>
                <?php if ($i <= intval($lastday)) { ?>
                <th width="28"><?php print($i); ?></th>
                <?php } else { ?>
                <th width="28">
                  <FONT COLOR="FFDCA5"><?php print($i); ?></FONT>
                </th>
                <?php } ?>
                <?php } ?>
              </tr>
              <tr class="text-center" bgcolor="FFDCA5">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>
                  <!-- <a href="kinmutuika.php?genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-success btn-block" role="button" aria-pressed="true">追加</a> -->
                </th>
                <?php for ($i=1;$i<=31;$i++) { ?>
                <?php if ($i <= intval($lastday)) { ?>
                <?php $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $i); ?>
                <?php $w = date("w", $time); ?>
                <th><?php
                if (($week[$w]=="土") || ($week[$w]=="日")) {
                    print("<font color=\"red\">");
                } ?><?php print($week[$w]); ?><?php if (($week[$w]=="土") || ($week[$w]=="日")) {
                    print("</font>");
                } ?></th>
                <?php } else { ?>
                <th>&nbsp;</th>
                <?php } ?>
                <?php } ?>
                <th width="28">日</th>
                <th width="28">夜</th>
                <th width="28">泊</th>
                <th width="28">実働</th>
                <th width="28">残業</th>
              </tr>
            </thead>
          </table>
<?php */ ?>

          <table border="1" class="sheet m-auto" style="border-collapse: collapse; table-layout: fixed;">
            <thead>
              <tr class="text-center" bgcolor="FFDCA5">
                <th width="161" colspan="4"></th>
                <th colspan="31"><?php print(substr($nengetu,0,4)."年".substr($nengetu,4,2)."月"); ?></th>
                <th colspan="6" rowspan="2">集計</th>
                <th width="24" rowspan="3">&nbsp;</th>
              </tr>
              <tr class="text-center" bgcolor="FFDCA5">
                <th colspan="4">勤務者</th>
                <?php for ($i=1;$i<=31;$i++) { ?>
                <?php if ($i <= intval($lastday)) { ?>
                <th <?php print $dispctl != "" ? 'style="max-width:20px; min-width:20px; font-size:0.8em;"' : 'style="max-width:25px; min-width:25px;"' ; ?>><?php print($i); ?></th>
                <?php } else { ?>
                <th <?php print $dispctl != "" ? 'style="max-width:20px; min-width:20px; font-size:0.8em;"' : 'style="max-width:25px; min-width:25px;"' ; ?>>
                  <FONT COLOR="FFDCA5"><?php print($i); ?></FONT>
                </th>
                <?php } ?>
                <?php } ?>
              </tr>
              <tr class="text-center" bgcolor="FFDCA5">
                <th colspan="4">
                
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
                  <table>
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                  
              <?php } else { ?>
              
                  <?php //if ($genba_flg != false) { ?>
                  <!--<table>
                    <tr>
                      <th></th>
                      <th></th>
                    </tr>
                    <tr>
                      <th colspan="4"></th>
                    </tr>
                  </table>-->
                  <?php //} else { ?>
                  <table>
                    <tr>
                      <th>
                        <select style="padding:0; width:40px;" id="user_kana" class="form-control" name="user_kana">
                          <?php for ($i=0;$i<count($user_kana_array);$i++) { ?>
                          <option value="<?php print($user_kana_array[$i]); ?>" <?php if ($user_kana == $user_kana_array[$i]) { print("selected"); }?> ><?php print($user_kana_array[$i]); ?>
                          <?php } ?>
                        </select>
                      </th>
                      <th>
                        <select style="padding:0; width:100px;" class="form-control" id="staff_id" name="staff_id">
                          <option></option>
                          <?php
                          if (is_array($wk->oup_t_wk_taiin_id)) {
                          for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
                              if (!in_array($staff->oup_m_staff_id[$i], $wk->oup_t_wk_taiin_id)) { ?>
                          <option class="staff" name="<?php print(mb_convert_kana(mb_substr($staff->oup_m_staff_kana[$i],0,1),"K")); ?>"
                           value="<?php print($staff->oup_m_staff_id[$i]); ?>">
                            <?php print($staff->oup_m_staff_name[$i]); ?></option>
                          <?php }
                            }
                          } ?>
                        </select>
                      </th>
                    </tr>
                    <tr>
                      <th colspan="4">
                        <button type="button" class="btn btn-success btn-block" role="button" name="add"
                        onClick="ins()">追加</button>
                      </th>
                    </tr>
                  </table>
                  <?php //} ?>
                  
                  <!--<select class="form-control" id="staff_id" name="staff_id">
                    <option></option>
                    <?php
                    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
                        if (!in_array($staff->oup_m_staff_id[$i], (array)$wk->oup_t_wk_taiin_id)) { ?>
                    <option value="<?php print($staff->oup_m_staff_id[$i]); ?>">
                      <?php print($staff->oup_m_staff_name[$i]); ?></option>
                    <?php }
                    } ?>
                  </select>
                  <a href="kinmutuika.php?genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-success btn-block" role="button" aria-pressed="true">追加</a>
                  <button type="button" class="btn btn-success btn-block" role="button" name="add"
                    onClick="ins()">追加</button>-->
                    
              <?php } ?>
              
                </th>
                <?php for ($i=1;$i<=31;$i++) { ?>
                <?php $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $i); ?>
                <?php $w = date("w", $time); ?>
                <?php if ($i <= intval($lastday)) { ?>
                <th <?php print $dispctl != "" ? 'style="font-size:0.8em;"' : "" ; ?>><?php
                if ($week[$w]=="土") {
                    print("<font color=\"blue\">");
                } elseif ($week[$w]=="日") {
                    print("<font color=\"red\">");
                //祝日は赤色に
                } elseif ($holday != "" && strpos($holday,sprintf("%02d",$i)) !== false) {
                    print("<font color=\"red\">");
                }
                /*if (($week[$w]=="土") || ($week[$w]=="日")) {
                    print("<font color=\"red\">");
                } */?><?php print($week[$w]); ?><?php if (($week[$w]=="土") || ($week[$w]=="日") || ($holday != "" && strpos($holday,sprintf("%02d",$i)) !== false)) {
                    print("</font>");
                } ?></th>
                <?php } else { ?>
                <th <?php print $dispctl != "" ? 'style="font-size:0.8em;"' : "" ; ?>>&nbsp;</th>
                <?php } ?>
                <?php } ?>
                <th width="28">日</th>
                <th width="28">夜</th>
                <th width="28">泊</th>
                <th width="28">年休</th>
                <th width="28">実働</th>
                <th width="28">残業</th>
              </tr>
            </thead>
            <tbody>
              <?php $wk_taiin_id = "" ?>
              <?php for ($i=0;$i<count($wk->oup_t_wk_no);$i++) { ?>


                <?php if (($i!=0) && ($i%10==0)) { ?>
                      <tr class="text-center" bgcolor="FFDCA5">
                        <th colspan="4" rowspan="2"><?php print(substr($nengetu,0,4)."年".substr($nengetu,4,2)."月"); ?></th>
                        <?php for ($j=1;$j<=31;$j++) { ?>
                        <?php if ($j <= intval($lastday)) { ?>
                        <th <?php print $dispctl != "" ? 'style="font-size:0.8em;"' : 'style="max-width:25px; min-width:25px;"' ; ?>><?php print($j); ?></th>
                        <?php } else { ?>
                        <th <?php print $dispctl != "" ? 'style="font-size:0.8em;"' : 'style="max-width:25px; min-width:25px;"' ; ?>>
                          <FONT COLOR="FFDCA5"><?php print($j); ?></FONT>
                        </th>
                        <?php } ?>
                        <?php } ?>
                        <th colspan="6">集計</th>
                        <th rowspan="2">&nbsp;</th>
                      </tr>
                      <tr class="text-center" bgcolor="FFDCA5">
                        <?php for ($j=1;$j<=31;$j++) { ?>
                        <?php $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $j); ?>
                        <?php $w = date("w", $time); ?>
                        <?php if ($j <= intval($lastday)) { ?>
                        <th <?php print $dispctl != "" ? 'style="font-size:0.8em;"' : "" ; ?>><?php
                        if ($week[$w]=="土") {
                            print("<font color=\"blue\">");
                        } elseif ($week[$w]=="日") {
                            print("<font color=\"red\">");
                        //祝日は赤色に
                        } elseif ($holday != "" && strpos($holday,sprintf("%02d",$j)) !== false) {
                            print("<font color=\"red\">");
                        }
                        /*if (($week[$w]=="土") || ($week[$w]=="日")) {
                            print("<font color=\"red\">");
                        } */?><?php print($week[$w]); ?><?php if (($week[$w]=="土") || ($week[$w]=="日") || ($holday != "" && strpos($holday,sprintf("%02d",$j)) !== false)) {
                            print("</font>");
                        } ?></th>
                        <?php } else { ?>
                        <th <?php print $dispctl != "" ? 'style="font-size:0.8em;"' : "" ; ?>>&nbsp;</th>
                        <?php } ?>
                        <?php } ?>
                        <th width="28">日</th>
                        <th width="28">夜</th>
                        <th width="28">泊</th>
                        <th width="28">年休</th>
                        <th width="28">実</th>
                        <th width="28">残</th>
                      </tr>
                <?php } ?>

              <tr class="text-center">
                
                <!-- 印刷表示用 -->
                <?php if ($dispctl != "") { ?>
                <?php } else { ?>
                    <?php //if ($genba_flg != true) { ?>
                        <?php if ($i===0) { ?>
                        <td><a name="#<?php print($wk->oup_t_wk_no[$i]); ?>">&nbsp;</td>
                        <?php } else { ?>
                        <td><a name="#<?php print($wk->oup_t_wk_no[$i]); ?>"><a
                            href="kinmuyotei.php?search=&up=&wk_no=<?php print($wk->oup_t_wk_no[$i]); ?>&genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>"
                            class="btn btn-success btn-block" role="button" aria-pressed="true">↑</a></td>
                        <?php } ?>
                        <?php if ($i===count($wk->oup_t_wk_no)-1) { ?>
                        <td>&nbsp;</td>
                        <?php } else { ?>
                        <td><a
                            href="kinmuyotei.php?search=&down=&wk_no=<?php print($wk->oup_t_wk_no[$i]); ?>&genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>"
                            class="btn btn-success btn-block" role="button" aria-pressed="true">↓</a></td>
                        <?php } ?>
                    <?php //} else { ?>
                        <!--<td colspan=2 nowrap style="font-size:0.9em;"><?php print($genba_name[$wk->oup_t_wk_genba_id[$i]]); ?></td>-->
                    <?php //} ?>
                <?php } ?>
                
                <td <?php print $dispctl != "" ? "colspan=4 nowrap" : "colspan=2" ; ?>>
                  <font size="-1"><a href="kinmunaiyo.html" class="<?php print($disabled_a); ?>"><?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]); ?></a>
                  </font>
                </td>

                <?php
                $dayk1cnt = 0;
                $dayk2cnt = 0;
                $dayk3cnt = 0;
                $dayk4cnt = 0;
                $result_rodo_time = 0;
                $result_over_time = 0;
                ?>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <?php $day = sprintf('%02d', $j); ?>
                <?php if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") { ?>
                <td bgcolor="#CCFF99">

                  <?php } else { ?>
                <td <?php print ($align_center); ?>
                  style="background-color:<?php echo $color[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]; ?>">
                  <?php } ?>
                  <?php if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day] == "") { ?>
                  
                  <!-- 印刷表示 -->
                  <?php if ($dispctl != "") { ?>
                  <!-- 印刷表示以外 -->
                  <?php } else { ?>
                  
                  <a href="#<?php print($wk->oup_t_wk_no[$i]); ?>" onclick="regist(<?php print($wk->oup_t_wk_no[$i]); ?>,<?php print($j); ?>);">－</a>
                  
                  <?php } ?>
                  
                  <input type="hidden" name="wk_no0" value="<?php print($wk_detail_no[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>" >
                  <?php } else { ?>
                  <a name="del" href="#<?php print($wk->oup_t_wk_no[$i]); ?>" <?php if ($gchk[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day] == 1 ||
                  $schk[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day] == 1) {
                    print("class='btn disabled_a' style='color:gray;'");
                  } else { 
                    print("class='$disabled_a'");
                  } ?>
                    onclick="del(<?php print($wk_detail_no[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>);" >
                    <font size="-1">
                      <?php print($shift->kbn[$kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]]); ?><?php print($br); ?>
                      <?php if ($dispctl == "") { ?>
                      <br>
                      <?php } ?>
                      <?php print($hosoku[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>
                    </font>
                  </a>
                  <!-- 上番時間 -->
                  <?php if ($jikan=="1") { ?>
                  <br />
                  <font size="-2">
                    <?php print($jtime[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>
                    <!-- 下番時間 -->
                    <br /><?php print($ktime[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>
                  </font>
                  <?php } ?>
                  <?php
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]==1) {
                        $dayk1cnt = $dayk1cnt+1;
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") {
                            $kcnt1[$j] = $kcnt1[$j]+1;
                        } else {
                            $tcnt1[$j] = $tcnt1[$j]+1;
                        }
                    }
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]==2) {
                        $dayk2cnt = $dayk2cnt+1;
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") {
                            $kcnt2[$j] = $kcnt2[$j]+1;
                        } else {
                            $tcnt2[$j] = $tcnt2[$j]+1;
                        }
                    }
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]==3) {
                        $dayk3cnt = $dayk3cnt+1;
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") {
                            $kcnt3[$j] = $kcnt3[$j]+1;
                        } else {
                            $tcnt3[$j] = $tcnt3[$j]+1;
                        }
                    }
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]==4) {
                      $dayk4cnt = $dayk4cnt+1;
                      if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") {
                          $kcnt4[$j] = $kcnt4[$j]+1;
                      } else {
                          $tcnt4[$j] = $tcnt4[$j]+1;
                      }
                  }

                    $result_rodo_time += $rodo_time[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day];
                    $result_over_time += $over_time[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day];
                  ?>
                  <?php } ?>
                </td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>

                <td <?php print ($align_right); ?>><?php print($dayk2cnt); ?></td>
                <td <?php print ($align_right); ?>><?php print($dayk3cnt); ?></td>
                <td <?php print ($align_right); ?>><?php print($dayk1cnt); ?></td>
                <td <?php print ($align_right); ?>><?php print($dayk4cnt); ?></td>
                <td <?php print ($align_right); ?>><?php print($result_rodo_time + $result_over_time); ?></td>
                <td <?php print ($align_right); ?>><?php print($result_over_time); ?></td>
                <td>
                
                <?php //if ($genba_flg != true) { ?>
                <?php if ($gchk_cnt[$wk->oup_t_wk_taiin_id[$i]] < 1 && $schk_cnt[$wk->oup_t_wk_taiin_id[$i]] < 1) { ?>
                  <a href="#rc<?php print($i); ?>" class="<?php print($disabled_a); ?>" onClick="confirm1(<?php print($wk->oup_t_wk_no[$i]); ?>,'<?php print($wk->oup_t_wk_taiin_id[$i]); ?>','<?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]); ?>' ); ">削</a>
                </td>
                <?php } ?>
                <?php //} ?>
                
              </tr>
              <?php
              // 総合計の集計用
              $total_dayk1cnt += $dayk1cnt;
              $total_dayk2cnt += $dayk2cnt;
              $total_dayk3cnt += $dayk3cnt;
              $total_dayk4cnt += $dayk4cnt;
              $total_result_rodo_time += $result_rodo_time;
              $total_result_over_time += $result_over_time;
              ?>
              <?php } ?>
              <tr>
              
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td <?php print $dispctl != "" ? "colspan=4" : "colspan=2" ; ?>>&nbsp;</td>
                <td></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <td></td>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
              
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td rowspan="4" <?php print $dispctl != "" ? "colspan=3" : "colspan=1" ; ?> width="60">通常計</td>
                <td><?php print($shift->kbn[2]); ?></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt2[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
              
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td><?php print($shift->kbn[3]); ?></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt3[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td><?php print($shift->kbn[1]); ?></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt1[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td><?php print($shift->kbn[4]); ?></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt4[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
              
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td rowspan="4" <?php print $dispctl != "" ? "colspan=3" : "colspan=1" ; ?> width="60">研修計</td>
                <td>日</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($kcnt2[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td>夜</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($kcnt3[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td>泊</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($kcnt1[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td>年</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($kcnt4[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
              
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td rowspan="4" <?php print $dispctl != "" ? "colspan=3" : "colspan=1" ; ?> width="60">総合計</td>
                <td>日</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt2[$j]+$kcnt2[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td><?php echo number_format($total_dayk2cnt); ?></td>
                <td><?php echo number_format($total_dayk3cnt); ?></td>
                <td><?php echo number_format($total_dayk1cnt); ?></td>
                <td><?php echo number_format($total_dayk4cnt); ?></td>
                <td><?php echo number_format($total_result_rodo_time + $total_result_over_time); ?></td>
                <td><?php echo number_format($total_result_over_time); ?></td>
                <td></td>
              </tr>
              <tr>
              
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td>夜</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt3[$j]+$kcnt3[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
              
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td>泊</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt1[$j]+$kcnt1[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
              
              <!-- 印刷表示用 -->
              <?php if ($dispctl != "") { ?>
              
              <?php } else { ?>
              
                <td></td>
                <td></td>
              
              <?php } ?>
              
                <td>年</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt4[$j]+$kcnt4[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br />
      <?php } ?>

      <!-- 印刷表示用 -->
      <?php if ($dispctl != "") { ?>
      <?php } else { ?>
      
      <div class="row">
      
      <?php //if ($genba_flg != true) { ?>
        <div class="col-6">
        <?php if ($wkdetail_conf_flg == 2 && $genba_id != "") { ?>
            <a class="btn btn-success btn-block" role="button" aria-pressed="true" onClick=confirm2() style=color:white;>予定の確定 (確定済)</a>
        <?php } else { ?>
          <a href="kinmuyotei.php?search=&conf=&genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-<?php if ($wkdetail_conf_flg == 1 || $genba_id == "") {print("secondary disabled1");} else {print("success");} ?> btn-block"
           role="button" aria-pressed="true" <?php /*if ($wkdetail_conf_flg == 1) {print("disabled");} */?> >予定の確定<?php if ($wkdetail_conf_flg == 1 && $genba_id != "") {print(" (確定済)");} ?></a>
        <?php } ?>
        </div>
        <div class="col-6">
      <?php //} else { ?>
        <!--<div class="col-12">-->
      <?php //} ?>
        
          <?php //if ($staff2->oup_m_staff_auth[0]=="1") { ?>
          <?php if ($_SESSION["menu_flg"]=="kanri") { ?>
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          <?php } else { ?>
          <a href="../menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          <?php } ?>
        </div>
      </div>
      
      <?php } ?>
      
      <br />
      <input type="hidden" name="token" id="token" value="<?php print($token); ?>">

    </form>

  </td>
  </tr>
  </table>
  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

  <script>
    function start() {
      var pos = <?php echo($_REQUEST['pos']); ?>;
      if(pos > 0) {
        window.scrollTo(0, pos);
      }
    }
  </script>

</body>

</html>