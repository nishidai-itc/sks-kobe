<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

  <!-- bootstrap-4.3.1 -->
  <link href="./../bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!--<script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>-->
  <script src="./../bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

  <title>勤怠管理システム</title>

  <script>
  $(function() {
    // 勤務時間の変更時
    $('#kinmu').change(function() {
      // 選択されている表示文字列を取り出す
      var kinmuOptionSelected = $('#kinmu option:selected').text();
      if (!kinmuOptionSelected) {
        alert('勤務を選んでください。')
        $('#kinmu').focus()
        return
      }
      var resultText = kinmuOptionSelected.trim();
      resultval = $('#kinmu option:selected').val();

      // 文字を'/'で分割
      var resultText = resultText.split('/'); // 例：["L-12", "日", "07:00 ～ 16:00"]
      var resultval = resultval.split(' ');
      var value = resultval[0];
      // 現場
      if (value != 9999) {
      $('#genbaName').text(resultText[0]);
      }

      // 所定時間
      var resultTime = resultText[2].split(' ');

      // 所定時間 開始
      var planJobanTime = resultTime[0].split(':');
      $('#planJobanTimeHours').val(planJobanTime[0]);
      $('#planJobanTimeMinute').val(planJobanTime[1]);

      // 所定時間 終了
      var planKabanTime = resultTime[2].split(':');
      $('#planKabanTimeHours').val(planKabanTime[0]);
      $('#planKabanTimeMinute').val(planKabanTime[1]);
    });
    
    //初期画面表示の処理
    $(window).load(function(){
      //手入力（残業）
      if ($('#inp_kbn').prop('checked')) {
        $('.inp').prop('disabled',false);
      } else {
        $('.inp').prop('disabled',true);
      }
      
      //上番チェックボックス
      //if ($('#joban_kbn').prop('checked')) {
      //  $('#joban_kbn1').prop('disabled',true);
      //  $('#joban_kbn2').prop('disabled',true);
      //}
      //年休、欠勤チェックボックス
      if ($('#joban_kbn1').prop('checked')) {
        //$('#joban_kbn').prop('disabled',true);
        //$('#kaban_kbn').prop('disabled',true);
        $('#joban_kbn2').prop('disabled',true);
        $('.joban').prop('disabled',true);
        $('.kaban').prop('disabled',true);
      }
      if ($('#joban_kbn2').prop('checked')) {
        //$('#joban_kbn').prop('disabled',true);
        //$('#kaban_kbn').prop('disabled',true);
        $('#joban_kbn1').prop('disabled',true);
        $('.joban').prop('disabled',true);
        $('.kaban').prop('disabled',true);
      }
    });
    
    //手入力変更時の処理（残業）
    $('input[name="inp_kbn"]').change(function(){
      if ($(this).prop('checked')) {
        $('.inp').prop('disabled',false);
      } else {
        $('.inp').prop('disabled',true);
      }
    });
    
    //上番チェックボックス変更時の処理
    //$('input[name="joban_kbn"]').change(function(){
    //  if ($(this).prop('checked')) {
    //    $('#joban_kbn1').prop('disabled',true);
    //    $('#joban_kbn2').prop('disabled',true);
    //  } else {
    //    $('#joban_kbn1').prop('disabled',false);
    //    $('#joban_kbn2').prop('disabled',false);
    //  }
    //});
    //年休チェックボックス変更時の処理
    $('input[name="joban_kbn1"]').change(function(){
      if ($(this).prop('checked')) {
        //$('#joban_kbn').prop('disabled',true);
        //$('#kaban_kbn').prop('disabled',true);
        if ($('#joban_kbn').prop('checked')) {
            $('input[name="joban_kbn"]').val('');
        }
        $('#joban_kbn2').prop('disabled',true);
        $('.joban').prop('disabled',true);
        $('.kaban').prop('disabled',true);
      } else {
        //$('#joban_kbn').prop('disabled',false);
        //$('#kaban_kbn').prop('disabled',false);
        if ($('#joban_kbn').prop('checked')) {
            $('input[name="joban_kbn"]').val('1');
        }
        $('#joban_kbn2').prop('disabled',false);
        $('.joban').prop('disabled',false);
        $('.kaban').prop('disabled',false);
      }
    });
    //欠勤チェックボックス変更時の処理
    $('input[name="joban_kbn2"]').change(function(){
      if ($(this).prop('checked')) {
        //$('#joban_kbn').prop('disabled',true);
        //$('#kaban_kbn').prop('disabled',true);
        if ($('#joban_kbn').prop('checked')) {
            $('input[name="joban_kbn"]').val('');
        }
        $('#joban_kbn1').prop('disabled',true);
        $('.joban').prop('disabled',true);
        $('.kaban').prop('disabled',true);
      } else {
        //$('#joban_kbn').prop('disabled',false);
        //$('#kaban_kbn').prop('disabled',false);
        if ($('#joban_kbn').prop('checked')) {
            $('input[name="joban_kbn"]').val('1');
        }
        $('#joban_kbn1').prop('disabled',false);
        $('.joban').prop('disabled',false);
        $('.kaban').prop('disabled',false);
      }
    });
    
    $(window).load(function(){
    if ($('#renzan_kbn').prop('checked')) {
        $('.inp2').prop('disabled',false);
      } else {
        $('.inp2').prop('disabled',true);
      }
    });
    //手入力変更時の処理（連勤残）
    $('input[name="renzan_kbn"]').change(function(){
      if ($(this).prop('checked')) {
        $('.inp2').prop('disabled',false);
      } else {
        $('.inp2').prop('disabled',true);
      }
    });

    // 更新ボタンクリック処理
    $('.update').click(function(){
      var kinmu = $('#kinmu').val();
      // console.log(kinmu);
      if (!kinmu) {
        alert('勤務を選んでください。');
        $('#kinmu').focus();
        return false;
      }
    });
  });
  </script>

  <style>
  /* 入力欄の調整 */
  /* .input-group-sm>.form-control {
    padding: 0.25rem 0.25rem;
  } */

  .input-form-size {
    width: 8em;
  }

  .input-form-right {
    border-right: 0px;
  }

  .input-form-left {
    border-left: 0px;
  }

  /* 「:」の調整 */
  .input-group-sm>.input-group-prepend>.input-group-text {
    padding: 0;
    background-color: transparent;
    border: 0px solid #ced4da;
    border-top: 1px solid #ced4da;
    border-bottom: 1px solid #ced4da;
  }

  /* 「:」の背景色 (input-group-colonと同じ所に追加) */
  /* .input-group-colon-bg {
    background-color: #e9ecef;
  } */
  </style>
</head>

<body>
  <!-- container -->
  <div class="container">
    <div class="page-header">
      <h4>勤務状況詳細一覧</h4>
    </div>

    <?php
    // 失敗時
    if ($errmsg != "") { ?>
    <div class="row">
      <div class="col-12">
        <div class="alert alert-danger"><?php print($errmsg); ?></div>
      </div>
    </div>
    <?php } ?>

    <?php
    // 成功時
    if ($successmsg != "") { ?>
    <div class="row">
      <div class="col-12">
        <div class="alert alert-primary"><?php print($successmsg); ?></div>
      </div>
    </div>
    <?php } ?>

    <div class="row">
      <div class="col-12">
        <table class="table table-sm table-bordered">
          <colgroup>
            <col width="10%">
            <col width="40%">
            <col width="10%">
            <col width="40%">
          </colgroup>

          <tbody>
            <tr>
              <td class="table-warning text-center">日付</td>
              <td>
                <?php print(substr($wkdetail->oup_t_wk_plan_date[0], 0, 4)."年".substr($wkdetail->oup_t_wk_plan_date[0], 5, 2)."月".substr($wkdetail->oup_t_wk_plan_date[0], 8, 2)."日"); ?>
                (<?php
                $time = strtotime(date($wkdetail->oup_t_wk_plan_date[0]));
                $w = date("w", $time);
                print($week[$w]); ?>)
              </td>
              <td class="table-info text-center font-weight-bold" colspan="2">勤務状況詳細一覧</td>
            </tr>

            <tr>
              <td class="table-warning text-center">報告者</td>
              <td>
                <?php echo $staff->oup_m_staff_name[0]; ?>
              </td>
              <td class="table-warning text-center">現場名</td>
              <td>
                <div id="genbaName" value="<?php print($wkdetail->oup_t_wk_genba_id[0]); ?>"><?php echo $genba_name; ?></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <form name="frm" method="POST" action="kinmujokyosyousai.php">
      <div class="row">
        <div class="col-12">
          <table class="table table-sm table-bordered">
            <colgroup>
              <col width="20%">
              <col width="20%">
              <col width="60%">
            </colgroup>

            <tbody>
              <?php // 編集する勤務状況?>
              <input type="hidden" name="detail_no" value="<?php echo $wkdetail->oup_t_wk_detail_no[0]; ?>">
              <!-- 勤務 -->
              <tr>
                <td class="table-warning text-center" colspan="2">勤務</td>
                <td>
                  <select id="kinmu" name="kinmu" class="form-control form-control-sm">
                    <option></option>
                    <?php
                    for ($i=0; $i<count($shift->oup_m_shift_no); $i++) {
                        // 現場IDから現場名を取得
                        $genba = new Genba; // Genbaクラスの初期化
                        $genba->inp_m_genba_id = $shift->oup_m_shift_genba_id[$i];
                        $genba->getGenba(); ?>

                    <option
                      value="<?php print($genba->oup_m_genba_id[0] . ' ' . $shift->oup_m_shift_plan_kbn[$i] . ' ' . $shift->oup_m_shift_plan_hosoku[$i].' '.$shift->oup_m_shift_no[$i]); ?>" <?php
                        if (($wkdetail->oup_t_wk_genba_id[0] === $shift->oup_m_shift_genba_id[$i] || $shift->oup_m_shift_genba_id[$i] == 9999) && $wkdetail->oup_t_wk_plan_kbn[0] === $shift->oup_m_shift_plan_kbn[$i] && $wkdetail->oup_t_wk_plan_kaban_time[0] === $shift->oup_m_shift_kaban_time[$i] && $wkdetail->oup_t_wk_plan_hosoku[0] === $shift->oup_m_shift_plan_hosoku[$i]) {
                      echo 'selected';
                  } ?>>
                      <?php
                      echo $genba->oup_m_genba_name[0] . '/' . $shift->kbn[$shift->oup_m_shift_plan_kbn[$i]] . $shift->oup_m_shift_plan_hosoku[$i] . "/" . $shift->oup_m_shift_joban_time[$i] . " ～ " . $shift->oup_m_shift_kaban_time[$i];
                      ?>
                    </option>
                    <?php
                    } ?>
                  </select>
                </td>
              </tr>

              <!-- 所定時間 -->
              <tr>
                <td class="table-warning text-center" rowspan="2">所定時間</td>
                <td class="table-warning text-center">開始</td>
                <td>
                  <?php
                  if ($wkdetail->oup_t_wk_plan_joban_time[0] !== null) {
                      $plan_joban_time = explode(":", $wkdetail->oup_t_wk_plan_joban_time[0]);
                  } else {
                      $plan_joban_time[0] = null;
                      $plan_joban_time[1] = null;
                  }
                  ?>
                  <div class="input-form-size">
                    <div class="input-group input-group-sm">
                      <input type="number" name="plan_joban_time[0]" class="form-control input-form-right text-center"
                        value="<?php print($plan_joban_time[0]); ?>" min="0" max="23" id="planJobanTimeHours">
                      <div class="input-group-prepend input-group-colon">
                        <span class="input-group-text">:</span>
                      </div>
                      <input type="number" name="plan_joban_time[1]" class="form-control input-form-left text-center"
                        value="<?php print($plan_joban_time[1]); ?>" min="0" max="59" id="planJobanTimeMinute">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="table-warning text-center">終了</td>
                <td>
                  <?php
                  if ($wkdetail->oup_t_wk_plan_kaban_time[0] !== null) {
                      $plan_kaban_time = explode(":", $wkdetail->oup_t_wk_plan_kaban_time[0]);
                  } else {
                      $plan_kaban_time[0] = null;
                      $plan_kaban_time[1] = null;
                  }
                  ?>
                  <div class="input-form-size">
                    <div class="input-group input-group-sm">
                      <input type="number" name="plan_kaban_time[0]" class="form-control input-form-right text-center"
                        value="<?php print($plan_kaban_time[0]); ?>" min="0" max="23" id="planKabanTimeHours">
                      <div class="input-group-prepend input-group-colon">
                        <span class="input-group-text">:</span>
                      </div>
                      <input type="number" name="plan_kaban_time[1]" class="form-control input-form-left text-center"
                        value="<?php print($plan_kaban_time[1]); ?>" min="0" max="59" id="planKabanTimeMinute">
                    </div>
                  </div>
                </td>
              </tr>

              <!-- 打刻 -->
              <tr>
                <td class="table-warning text-center" rowspan="2">打刻</td>
                <td class="table-warning text-center">上番
                </td>
                <td>
                  <?php
                  if ($wkdetail->oup_t_wk_joban_dakoku_time[0] !== null) {
                      $joban_dakoku_time = explode(":", $wkdetail->oup_t_wk_joban_dakoku_time[0]);
                  } else {
                      $joban_dakoku_time[0] = null;
                      $joban_dakoku_time[1] = null;
                  }
                  ?>
                  <div class="input-form-size">
                    <div class="input-group input-group-sm">
                      <input type="number" name="joban_dakoku_time[0]" class="form-control input-form-right text-center"
                        value="<?php print($joban_dakoku_time[0]); ?>" min="0" max="23">
                      <div class="input-group-prepend input-group-colon">
                        <span class="input-group-text">:</span>
                      </div>
                      <input type="number" name="joban_dakoku_time[1]" class="form-control input-form-left text-center"
                        value="<?php print($joban_dakoku_time[1]); ?>" min="0" max="59">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="table-warning text-center">下番</td>
                <td>
                  <?php
                  if ($wkdetail->oup_t_wk_kaban_dakoku_time[0] !== null) {
                      $kaban_dakoku_time = explode(":", $wkdetail->oup_t_wk_kaban_dakoku_time[0]);
                  } else {
                      $kaban_dakoku_time[0] = null;
                      $kaban_dakoku_time[1] = null;
                  }
                  ?>
                  <div class="input-form-size">
                    <div class="input-group input-group-sm">
                      <input type="number" name="kaban_dakoku_time[0]" class="form-control input-form-right text-center"
                        value="<?php print($kaban_dakoku_time[0]); ?>" min="0" max="23">
                      <div class="input-group-prepend input-group-colon">
                        <span class="input-group-text">:</span>
                      </div>
                      <input type="number" name="kaban_dakoku_time[1]" class="form-control input-form-left text-center"
                        value="<?php print($kaban_dakoku_time[1]); ?>" min="0" max="59">
                    </div>
                  </div>
                </td>
              </tr>

              <!-- 実績 -->
              <tr>
                <td class="table-warning text-center" rowspan="2">実績</td>
                <td class="table-warning text-center">上番
                   　<input type="checkbox" id="joban_kbn" value="1" <?php if ($wkdetail->oup_t_wk_joban_kbn[0]=="1") { print("checked"); } ?> onclick="return false;"> 済
                   
                   <input type="hidden" name="joban_kbn" value="<?php if ($wkdetail->oup_t_wk_joban_kbn[0]=='1') { print('1'); } ?>">
                   
                  <!--<select name="joban_kbn" id="joban_kbn" class="form_control">
                      <option value="">
                      <option value="1" <?php if ($wkdetail->oup_t_wk_joban_kbn[0]=="1") { print("selected"); } ?>>済
                      <option value="4" <?php if ($wkdetail->oup_t_wk_joban_kbn[0]=="4") { print("selected"); } ?>>年休
                      <option value="5" <?php if ($wkdetail->oup_t_wk_joban_kbn[0]=="5") { print("selected"); } ?>>欠勤
                  </select>-->
                </td>
                <td>
                  <?php
                  if ($wkdetail->oup_t_wk_joban_time[0] !== null) {
                      $joban_time = explode(":", $wkdetail->oup_t_wk_joban_time[0]);
                  } else {
                      $joban_time[0] = null;
                      $joban_time[1] = null;
                  }
                  ?>
                  <div class="input-form-size" <?php if (!$common->judgephone2) {print("style='float:left;'");} ?>>
                    <div class="input-group input-group-sm">
                      <input type="number" name="joban_time[0]" class="joban form-control input-form-right text-center"
                        value="<?php print($joban_time[0]); ?>" min="0" max="23">
                      <div class="input-group-prepend input-group-colon">
                        <span class="input-group-text">:</span>
                      </div>
                      <input type="number" name="joban_time[1]" class="joban form-control input-form-left text-center"
                        value="<?php print($joban_time[1]); ?>" min="0" max="59">
                    </div>
                  </div>
                  
                  <span <?php if (!$common->judgephone2) {print("style='padding:0 30px 0 100px;'");} ?>>
                    <label><input type="checkbox" id="joban_kbn1" name="joban_kbn1" value="4" <?php if ($wkdetail->oup_t_wk_joban_kbn[0]=="4") { print("checked"); } ?> ><font color=red> 年休 </font></label>
                  </span>
                  <span style="padding:0 30px;">
                    <label><input type="checkbox" id="joban_kbn2" name="joban_kbn2" value="5" <?php if ($wkdetail->oup_t_wk_joban_kbn[0]=="5") { print("checked"); } ?> ><font color=red> 欠勤 </font></label>
                  </span>
                  
                </td>
              </tr>
              <tr>
                <td class="table-warning text-center">下番
                    　<input type="checkbox" id="kaban_kbn" name="kaban_kbn" value="1" <?php if ($wkdetail->oup_t_wk_kaban_kbn[0]=="1") { print("checked"); } ?> onclick="return false;"> 済
                </td>
                <td>
                  <?php
                  if ($wkdetail->oup_t_wk_kaban_time[0] !== null) {
                      $kaban_time = explode(":", $wkdetail->oup_t_wk_kaban_time[0]);
                  } else {
                      $kaban_time[0] = null;
                      $kaban_time[1] = null;
                  }
                  ?>
                  <div class="input-form-size">
                    <div class="input-group input-group-sm">
                      <input type="number" name="kaban_time[0]" class="kaban form-control input-form-right text-center"
                        value="<?php print($kaban_time[0]); ?>" min="0" max="23">
                      <div class="input-group-prepend input-group-colon">
                        <span class="input-group-text">:</span>
                      </div>
                      <input type="number" name="kaban_time[1]" class="kaban form-control input-form-left text-center"
                        value="<?php print($kaban_time[1]); ?>" min="0" max="59">
                    </div>
                  </div>
                </td>
              </tr>

              <!-- 交通費 -->
              <tr>
                <td class="table-warning text-center" colspan="2">交通費</td>
                <td><input type="tel" name="kotuhi" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_kotuhi[0]; ?>"></td>
              </tr>

              <!-- 時間外勤務 -->
              <tr>
                <td class="table-warning text-center" rowspan="3">時間外勤務</td>
                <td class="table-warning text-center">昼残</td>
                <td>
                <select class="form-control form-control-sm" name="daytime_over_time">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $wkdetail->oup_t_wk_daytime_over_time[0] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                </select>
                <!-- <input type="time" name="daytime_over_time" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_daytime_over_time[0]; ?>"> -->
                </td>
              </tr>
              <tr>
                <td class="table-warning text-center">休憩残業</td>
                <td>
                <select class="form-control form-control-sm" name="rest_over_time">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $wkdetail->oup_t_wk_rest_over_time[0] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                </select>
                <!-- <input type="time" name="rest_over_time" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_rest_over_time[0]; ?>"> -->
                </td>
              </tr>
              <tr>
                <td class="table-warning text-center">深夜残業</td>
                <td>
<!--
                <select class="form-control form-control-sm" name="midnight_over_time">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $wkdetail->oup_t_wk_midnight_over_time[0] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                </select>
-->
                <!--<input type="time" name="midnight_over_time" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_midnight_over_time[0]; ?>">-->
                
                
                  <?php
                  if ($wkdetail->oup_t_wk_midnight_over_time[0] !== null) {
                      $midnight_over_time = explode(":", $wkdetail->oup_t_wk_midnight_over_time[0]);
                  } else {
                      $midnight_over_time[0] = null;
                      $midnight_over_time[1] = null;
                  }
                  ?>
                  <div class="input-form-size">
                    <div class="input-group input-group-sm">
                      <input type="number" name="midnight_over_time[0]" class="form-control input-form-right text-center"
                        value="<?php print($midnight_over_time[0]); ?>" min="0" max="23">
                      <div class="input-group-prepend input-group-colon">
                        <span class="input-group-text">:</span>
                      </div>
                      <input type="number" name="midnight_over_time[1]" class="form-control input-form-left text-center"
                        value="<?php print($midnight_over_time[1]); ?>" min="0" max="59">
                    </div>
                  </div>
                
                </td>
              </tr>

              <!-- 手当て -->
              <tr>
                <td class="table-warning text-center" rowspan="7">手当て</td>
                <td class="table-warning text-center">ポスト</td>
                <td>
                <select class="form-control form-control-sm" name="post_teate">
                    <option value=""></option>
                    <?php if ($postteate->oup_m_post_teate_no) { ?>
                    <?php for ($i=0;$i<count($postteate->oup_m_post_teate_no);$i++) { ?>
                    <option value="<?php echo $postteate->oup_m_post_teate_post_cost[$i]; ?>"
                      <?php echo $postteate->oup_m_post_teate_post_cost[$i] == $wkdetail->oup_t_wk_post_teate[0] ? 'selected':'' ; ?>>
                      <?php echo $postteate->oup_m_post_teate_post_cost[$i]; ?>
                    </option>
                    <?php } ?>
                    <?php } ?>
                </select>
                <!-- <input type="tel" name="post_teate" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_post_teate[0]; ?>"> -->
                </td>
              </tr>
              <tr>
                <td class="table-warning text-center">正月</td>
                <td><input type="tel" name="shogatu_teate" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_shogatu_teate[0]; ?>"></td>
              </tr>
              <tr>
                <td class="table-warning text-center">夏季</td>
                <td><input type="tel" name="kaki_teate" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_kaki_teate[0]; ?>"></td>
              </tr>
              <tr>
                <td class="table-warning text-center">1</td>
                <td><input type="tel" name="etc_teate1" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_etc_teate1[0]; ?>"></td>
              </tr>
              <tr>
                <td class="table-warning text-center">2</td>
                <td><input type="tel" name="etc_teate2" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_etc_teate2[0]; ?>"></td>
              </tr>
              <tr>
                <td class="table-warning text-center">3</td>
                <td><input type="tel" name="etc_teate3" class="form-control form-control-sm"
                    value="<?php echo $wkdetail->oup_t_wk_etc_teate3[0]; ?>"></td>
              </tr>
            </tbody>
          </table>
          
          <br>
          <table class="table table-sm table-bordered">
            </tbody>
            <!-- 手入力 -->
            <tr>
              <td class="table-warning text-right" rowspan="4" width=250><label>手入力　　　　　<input type="checkbox" name="inp_kbn" id="inp_kbn" value="1" <?php if ($wkdetail->oup_t_wk_inp_kbn[0]=="1") { print("checked"); } ?> ></label></td>
              <td class="table-warning text-center" width=250>勤務時間</td>
              <td>
                <?php 
                if ($wkdetail->oup_t_wk_inp_kbn[0] !== null) {
                    if ($wkdetail->oup_t_wk_kinmu_time[0] == 0) {
                        $kinmu_time[0] = null;
                        $kinmu_time[1] = null;
                    } else {
                        $kinmu_time = sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[0]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[0]%60,0,2));
                        $kinmu_time = explode(":", $kinmu_time);
                    }
                } else {
                    if ($wkdetail->oup_t_wk_kinmu_time[0] != 0 && $wkdetail->oup_t_wk_kinmu_time[0] != "") {
                        $kinmu_time = sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[0]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_kinmu_time[0]%60,0,2));
                        $kinmu_time = explode(":", $kinmu_time);
                    } else {
                        $kinmu_time[0] = null;
                        $kinmu_time[1] = null;
                    }
                }
                ?>
                <div class="input-form-size">
                  <div class="input-group input-group-sm">
                    <input type="number" name="kinmu_time[0]" class="inp form-control input-form-right text-center"
                      value="<?php print($kinmu_time[0]); ?>" min="0" max="23" maxlength="2" id="kinmuTimeHours">
                    <div class="input-group-prepend input-group-colon">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="kinmu_time[1]" class="inp form-control input-form-left text-center"
                      value="<?php print($kinmu_time[1]); ?>" min="0" max="59" id="kinmuTimeMinute">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="table-warning text-center">所定残業</td>
              <td>
                <?php
                if ($wkdetail->oup_t_wk_inp_kbn[0] !== null) {
                    if ($wkdetail->oup_t_wk_syotei_zan[0] == 0) {
                        $syotei_zan[0] = null;
                        $syotei_zan[1] = null;
                    } else {
                        $syotei_zan = sprintf("%02d",substr($wkdetail->oup_t_wk_syotei_zan[0]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_syotei_zan[0]%60,0,2));
                        $syotei_zan = explode(":", $syotei_zan);
                    }
                } else {
                    if ($wkdetail->oup_t_wk_syotei_zan[0] != 0 && $wkdetail->oup_t_wk_syotei_zan[0] != "") {
                        $syotei_zan = sprintf("%02d",substr($wkdetail->oup_t_wk_syotei_zan[0]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_syotei_zan[0]%60,0,2));
                        $syotei_zan = explode(":", $syotei_zan);
                    } else {
                        $syotei_zan[0] = null;
                        $syotei_zan[1] = null;
                    }
                }
                ?>
                <div class="input-form-size">
                  <div class="input-group input-group-sm">
                    <input type="number" name="syotei_zan[0]" class="inp form-control input-form-right text-center"
                      value="<?php print($syotei_zan[0]); ?>" min="0" max="23" id="syotei_zanTimeHours">
                    <div class="input-group-prepend input-group-colon">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="syotei_zan[1]" class="inp form-control input-form-left text-center"
                      value="<?php print($syotei_zan[1]); ?>" min="0" max="59" id="syotei_zanTimeMinute">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="table-warning text-center">早出残業</td>
              <td>
                <?php
                if ($wkdetail->oup_t_wk_inp_kbn[0] !== null) {
                    if ($wkdetail->oup_t_wk_hayazan[0] == 0) {
                        $hayazan[0] = null;
                        $hayazan[1] = null;
                    } else {
                        $hayazan = sprintf("%02d",substr($wkdetail->oup_t_wk_hayazan[0]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_hayazan[0]%60,0,2));
                        $hayazan = explode(":", $hayazan);
                    }
                } else {
                    if ($wkdetail->oup_t_wk_hayazan[0] != 0 && $wkdetail->oup_t_wk_hayazan[0] != "") {
                        $hayazan = sprintf("%02d",substr($wkdetail->oup_t_wk_hayazan[0]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_hayazan[0]%60,0,2));
                        $hayazan = explode(":", $hayazan);
                    } else {
                        $hayazan[0] = null;
                        $hayazan[1] = null;
                    }
                }
                ?>
                <div class="input-form-size">
                  <div class="input-group input-group-sm">
                    <input type="number" name="hayazan[0]" class="inp form-control input-form-right text-center"
                      value="<?php print($hayazan[0]); ?>" min="0" max="23" id="hayazanTimeHours">
                    <div class="input-group-prepend input-group-colon">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="hayazan[1]" class="inp form-control input-form-left text-center"
                      value="<?php print($hayazan[1]); ?>" min="0" max="59" id="hayazanTimeMinute">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="table-warning text-center">通常残業</td>
              <td>
                <?php
                if ($wkdetail->oup_t_wk_inp_kbn[0] !== null) {
                    if ($wkdetail->oup_t_wk_tuzan[0] == 0) {
                        $tuzan[0] = null;
                        $tuzan[1] = null;
                    } else {
                        $tuzan = sprintf("%02d",substr($wkdetail->oup_t_wk_tuzan[0]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_tuzan[0]%60,0,2));
                        $tuzan = explode(":", $tuzan);
                    }
                } else {
                    if ($wkdetail->oup_t_wk_tuzan[0] != 0 && $wkdetail->oup_t_wk_tuzan[0] != "") {
                        $tuzan = sprintf("%02d",substr($wkdetail->oup_t_wk_tuzan[0]/60,0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_tuzan[0]%60,0,2));
                        $tuzan = explode(":", $tuzan);
                    } else {
                        $tuzan[0] = null;
                        $tuzan[1] = null;
                    }
                }
                ?>
                <div class="input-form-size">
                  <div class="input-group input-group-sm">
                    <input type="number" name="tuzan[0]" class="inp form-control input-form-right text-center"
                      value="<?php print($tuzan[0]); ?>" min="0" max="23" id="tuzanTimeHours">
                    <div class="input-group-prepend input-group-colon">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="tuzan[1]" class="inp form-control input-form-left text-center"
                      value="<?php print($tuzan[1]); ?>" min="0" max="59" id="tuzanTimeMinute">
                  </div>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
          
          <table class="table table-sm table-bordered">
            </tbody>
            <!-- 連勤残手入力 -->
            <tr>
              <td class="table-warning text-right" width=250><input type="checkbox" name="renzan_kbn" id="renzan_kbn" value="1" <?php if ($wkdetail->oup_t_wk_renzan_kbn[0]=="1") { print("checked"); } ?> ></td>
              <td class="table-warning text-center" width=250>連勤残</td>
              <td>
                <?php
                if ($wkdetail->oup_t_wk_renzan_kbn[0] !== null) {
                    if ($wkdetail->oup_t_wk_renzan[0] == 0) {
                        $renzan[0] = null;
                        $renzan[1] = null;
                    } else {
                        //$renzan = sprintf("%02d",substr($wkdetail->oup_t_wk_renzan[0],0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_renzan[0],-2));
                        //$renzan = explode(":", $renzan);
                        $renzan = $wkdetail->oup_t_wk_renzan[0]*60;
                        $renzan = sprintf("%02d",$renzan/60).":".sprintf("%02d",$renzan%60);
                        $renzan = explode(":", $renzan);
                    }
                } else {
                    if ($wkdetail->oup_t_wk_renzan[0] != 0 && $wkdetail->oup_t_wk_renzan[0] != "") {
                        //$renzan = sprintf("%02d",substr($wkdetail->oup_t_wk_renzan[0],0,2)).":".sprintf("%02d",substr($wkdetail->oup_t_wk_renzan[0],-2));
                        //$renzan = explode(":", $renzan);
                        $renzan = $wkdetail->oup_t_wk_renzan[0]*60;
                        $renzan = sprintf("%02d",$renzan/60).":".sprintf("%02d",$renzan%60);
                        $renzan = explode(":", $renzan);
                    } else {
                        $renzan[0] = null;
                        $renzan[1] = null;
                    }
                }
                ?>
                <div class="input-form-size">
                  <div class="input-group input-group-sm">
                    <input type="number" name="renzan[0]" class="inp2 form-control input-form-right text-center"
                      value="<?php print($renzan[0]); ?>" min="0" max="23" id="renzanTimeHours">
                    <div class="input-group-prepend input-group-colon">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="renzan[1]" class="inp2 form-control input-form-left text-center"
                      value="<?php print($renzan[1]); ?>" min="0" max="59" id="renzanTimeMinute">
                  </div>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
          
          <table class="table table-sm table-bordered">
            <tr>
              <td class="table-warning text-center" width=10%>コメント</td>
              <td>
                <input type="text" name="comment" class="form-control form-control-sm" value="<?php echo $wkdetail->oup_t_wk_comment[0]; ?>" maxlength="200">
              </td>
            </tr>
          </table>
          
        </div>
      </div>

      <div class="row">
        <div class="col-6">
          <button type="submit" class="btn btn-success btn-block update" name="update" value="1">更新</button>
        </div>
        <div class="col-6">
          <a href="kinmujokyo.php#<?php print($wkdetail->oup_t_wk_detail_no[0]); ?>" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      
    <!-- 日付、勤務体系の現場 -->
    <input type="hidden" name="plan_date" value="<?php print($wkdetail->oup_t_wk_plan_date[0]); ?>">
    <input type="hidden" name="staff" value="<?php print($staff->oup_m_staff_id[0]); ?>">
    </form>
  </div>

  <div class="p-1"></div>

  <!-- footer -->
  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div>

</body>

</html>