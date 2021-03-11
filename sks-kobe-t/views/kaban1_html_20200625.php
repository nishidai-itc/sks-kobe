<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

  <!-- bootstrap-4.3.1 -->
  <script src="./bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <link href="./bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="./bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- floatThead -->
  <script type="text/javascript" src="lib/jquery.floatThead.js"></script>

  <title>勤怠管理システム</title>
</head>

<script language="JavaScript" type="text/javascript">
// 「全て選択」チェックで全てにチェック付く
function AllChecked() {
  var tf = document.frm.all.checked;
  var ElementsCount = document.frm.elements.length; // チェックボックスの数
  for (i = 0; i < ElementsCount; i++) {
    if (document.frm.elements[i].type == 'checkbox' && document.frm.elements[i].name != 'all') {
      document.frm.elements[i].checked = tf; // ON・OFFを切り替え
    }
  }
}

// チェックボックスのクリック判定
$(function() {
  $('#kaban').floatThead();

  // 個別選択
  $('input[id="tujo_checked"]').change(function() {
    if ($(this).prop('checked')) {
      // 時間を切り抜き
      var planJobanTime = $(this).val();
      // var planJobanTimeHour = planJobanTime.substr(0, 2);
      // var planJobanTimeMinute = planJobanTime.substr(3, 2);

      // inputフォームに代入
      // $(this).parent().parent().children('td').find('.kaban-time-hour').val(planJobanTimeHour);
      // $(this).parent().parent().children('td').find('.kaban-time-minute').val(planJobanTimeMinute);
      $(this).parent().parent().children('td').find('.kaban-time').val(planJobanTime);

      // $(this).parent().parent().children('td').find('.kaban-time-hour').prop('disabled', true);
      // $(this).parent().parent().children('td').find('.kaban-time-minute').prop('disabled', true);
      // $(this).parent().parent().children('td').find('.input-group-colon').addClass('input-group-colon-bg');
      $(this).parent().parent().children('td').find('.kaban-time').prop('readonly', true);
    } else {
      // $(this).parent().parent().children('td').find('.kaban-time-hour').prop('disabled', false);
      // $(this).parent().parent().children('td').find('.kaban-time-minute').prop('disabled', false);
      // $(this).parent().parent().children('td').find('.input-group-colon').removeClass('input-group-colon-bg');
      $(this).parent().parent().children('td').find('.kaban-time').prop('readonly', false);
    }
  });

  // 全選択
  $('input[name="all"]').change(function() {
    $('input[id="tujo_checked"]').each(function() {
      if ($(this).prop('checked')) {
        // 時間を切り抜き
        var planJobanTime = $(this).val();
        // var planJobanTimeHour = planJobanTime.substr(0, 2);
        // var planJobanTimeMinute = planJobanTime.substr(3, 2);

        // inputフォームに代入
        // $(this).parent().parent().children('td').find('.kaban-time-hour').val(planJobanTimeHour);
        // $(this).parent().parent().children('td').find('.kaban-time-minute').val(planJobanTimeMinute);
        $(this).parent().parent().children('td').find('.kaban-time').val(planJobanTime);

        // $(this).parent().parent().children('td').find('.kaban-time-hour').prop('disabled', true);
        // $(this).parent().parent().children('td').find('.kaban-time-minute').prop('disabled', true);
        // $(this).parent().parent().children('td').find('.input-group-colon').addClass('input-group-colon-bg');
        $(this).parent().parent().children('td').find('.kaban-time').prop('readonly', true);

      } else {
        // $(this).parent().parent().children('td').find('.kaban-time-hour').prop('disabled', false);
        // $(this).parent().parent().children('td').find('.kaban-time-minute').prop('disabled', false);
        // $(this).parent().parent().children('td').find('.input-group-colon').removeClass('input-group-colon-bg');
        $(this).parent().parent().children('td').find('.kaban-time').prop('readonly', false);
      }
    });
  });
});
</script>

<style>
.table-body-font {
  font-size: 0.9rem;
}

.div-input {
  border: 1px solid #ced4da;
  border-radius: 0.2em;
}

.input-time {
  width: 33px;
  border: 0px;
  height: calc(1.8125rem);
}

/* 入力欄の調整 */
.form-control {
  padding: 0.25rem 0.25rem;
}

.input-group-sm>.form-control {
  padding: 0.25rem 0.25rem;
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

/* 「:」の背景色 (input-group-colonと同じ所に追加)*/
.input-group-colon-bg {
  background-color: #e9ecef;
}
</style>

<body>
  <div class="container">
    <!-- <div class="page-header">
      <h4>下番報告（リーダー用）</h4>
    </div> -->

    <form name="frm" method="POST" action="kaban1.php">

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
                  <?php print(substr(date('Y-m-d'), 0, 4)."年".substr(date('Y-m-d'), 5, 2)."月".substr(date('Y-m-d'), 8, 2)."日"); ?>(<?php print($week[$w]); ?>)
                </td>
                <td class="table-info text-center font-weight-bold" colspan="2">下番報告（リーダー用）</td>
              </tr>

              <tr>
                <td class="table-warning text-center">報告者</td>
                <td><?php echo $staff->oup_m_staff_name[0]; ?></td>
                <td class="table-warning text-center">現場名</td>
                <td>
                  <?php echo $genba->oup_m_genba_name[0]; ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <table class="table table-sm table-bordered text-nowrap">
            <colgroup>
              <col>
              <col>
              <col>
              <col width="32px">
              <col>
              <col>
              <col>
              <col>
              <col>
              <col>
            </colgroup>

            <!-- bgcolor="FFDCA5" -->
            <thead>
              <tr class="text-center">
                <td class="table-warning">氏名<br>(勤務)</td>
                <td class="table-warning">上番<br />下番</td>
                <td class="table-warning">下番<br>打刻</td>
                <td class="table-success">
                  <label>通<br><input type="checkbox" name="all" onClick="AllChecked();"></label>
                </td>
                <td class="table-success">下番時刻</td>
                <td class="table-success">昼残時間</td>
                <td class="table-success">休憩残業<br>時間</td>
                <td class="table-success">深夜残業<br>時間</td>
                <td class="table-success">ポスト<br>手当</td>
                <td class="table-success">交通費</td>
              </tr>
            </thead>

            <tbody class="table-body-font">
              <!-- 前日分 -->
              <?php for ($i=0; $i<count($work_mem2->oup_t_wk_taiin_id); $i++) { 
//                    if ($shift->kbn[$work_mem2->oup_t_wk_plan_kbn[$i]] != "年") {?>
              <tr class="text-center">
                <!-- 氏名 -->
                <td>
                  <?php print($staffs[$work_mem2->oup_t_wk_taiin_id[$i]]); ?><br><?php print(substr($work_mem2->oup_t_wk_plan_date[$i],5,2)."/".substr($work_mem2->oup_t_wk_plan_date[$i],8,2)); ?>(<?php print($shift->kbn[$work_mem2->oup_t_wk_plan_kbn[$i]]); ?>)
                  <input type="hidden" name="kaban_dakoku[<?php echo $i; ?>]" value="<?php print($work_mem2->oup_t_wk_kaban_dakoku_time[$i]); ?>">
                </td>
                <!-- 上番下番 -->
                <td>
                  <?php print($work_mem2->oup_t_wk_plan_joban_time[$i]); ?><br /><?php print($work_mem2->oup_t_wk_plan_kaban_time[$i]); ?>
                </td>
                <!-- 下番打刻 -->
                <td><?php print($work_mem2->oup_t_wk_kaban_dakoku_time[$i]); ?></td>
                <!-- 通常 -->
                <td class="align-middle">
                  <input type="checkbox" name="tujo_checked[<?php echo $i; ?>]" id="tujo_checked" 
                    value="<?php print($work_mem2->oup_t_wk_plan_kaban_time[$i]); ?>">
                  <input type="hidden" name="plan_kaban[<?php echo $i; ?>]" value="<?php print($work_mem2->oup_t_wk_plan_kaban_time[$i]); ?>">
                </td>
                <!-- 下番時刻 -->
                <td class="align-middle">
                  <input type="time" class="form-control form-control-sm kaban-time"
                    name="kaban_time[<?php echo $i; ?>]" value="<?php print($work_mem2->oup_t_wk_kaban_time[$i]); ?>">
                </td>
                <!-- 昼残 -->
                <td class="align-middle">
                  <select class="form-control form-control-sm" name="daytime_over_time[<?php echo $i; ?>]">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $work_mem2->oup_t_wk_daytime_over_time[$i] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>
                <!-- 休憩残業時間 -->
                <td class="align-middle">
                  <select class="form-control form-control-sm" name="rest_over_time[<?php echo $i; ?>]">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $work_mem2->oup_t_wk_rest_over_time[$i] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>
                <!-- 深夜残業時間 -->
                <td class="align-middle">
                  <select class="form-control form-control-sm" name="midnight_over_time[<?php echo $i; ?>]">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $work_mem2->oup_t_wk_midnight_over_time[$i] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>
                <!-- ポスト手当 -->
                <td class="align-middle">
                  <select class="form-control form-control-sm" name="post_teate[<?php echo $i; ?>]">
                    <option value=""></option>
                    <?php for ($j=0;$j<count($postteate->oup_m_post_teate_no);$j++) { ?>
                    <option value="<?php echo $postteate->oup_m_post_teate_post_cost[$j]; ?>"
                      <?php echo $postteate->oup_m_post_teate_post_cost[$j] == $work_mem2->oup_t_wk_post_teate[$i] ? 'selected':'' ; ?>>
                      <?php echo $postteate->oup_m_post_teate_post_cost[$j]; ?>
                    </option>
                    <?php } ?>
                  </select>
                
                  <!-- <input type="number" class="form-control form-control-sm" name="post_teate[<?php echo $i; ?>]"
                    value="<?php print($work_mem2->oup_t_wk_post_teate[$i]); ?>"> -->
                </td>
                <!-- 交通費 -->
                <td class="align-middle">
                  <input type="number" class="form-control form-control-sm" name="kotuhi[<?php echo $i; ?>]"
                    value="<?php print($work_mem2->oup_t_wk_kotuhi[$i]); ?>">
                </td>

                <INPUT type="hidden" name="wk_no[<?php echo $i; ?>]"
                  value="<?php echo $work_mem2->oup_t_wk_detail_no[$i]; ?>">
                <INPUT type="hidden" name="plan_time[<?php echo $i; ?>]"
                  id="plan_time<?php echo $i; ?>"
                  value="<?php print($work_mem2->oup_t_wk_plan_kaban_time[$i]); ?>">
              </tr>
              <?php // } ?>
            <?php } ?>


              <!-- 当日分 -->
              <?php for ($i=0;$i<count($work_mem->oup_t_wk_taiin_id);$i++) {
//                    if ($shift->kbn[$work_mem->oup_t_wk_plan_kbn[$i]] != "年") { ?>
              <tr class="text-center">
                <!-- 氏名 -->
                <td>
                  <?php print($staffs[$work_mem->oup_t_wk_taiin_id[$i]]); ?><br><?php print(substr($work_mem->oup_t_wk_plan_date[$i],5,2)."/".substr($work_mem->oup_t_wk_plan_date[$i],8,2)); ?>(<?php print($shift->kbn[$work_mem->oup_t_wk_plan_kbn[$i]]); ?>)
                  <input type="hidden" name="kaban_dakoku[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]" value="<?php print($work_mem->oup_t_wk_kaban_dakoku_time[$i]); ?>">
                </td>
                <!-- 上番下番 -->
                <td>
                  <?php print($work_mem->oup_t_wk_plan_joban_time[$i]); ?><br /><?php print($work_mem->oup_t_wk_plan_kaban_time[$i]); ?>
                </td>
                <!-- 下番打刻 -->
                <td><?php print($work_mem->oup_t_wk_kaban_dakoku_time[$i]); ?></td>
                <!-- 通常 -->
                <td class="align-middle">
                  	<?php /* 添字番号が当日と重なるので添字に当日の件数をプラス */ ?>
                  <input type="checkbox" name="tujo_checked[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]" id="tujo_checked" 
                    value="<?php print($work_mem->oup_t_wk_plan_kaban_time[$i]); ?>">
                  <!-- <?php
                  if ($work_mem->oup_t_wk_kaban_kbn[$i]=="1") {
                      echo ' checked="checked"';
                  } ?> -->
                  	<?php /* 添字番号が当日と重なるので添字に当日の件数をプラス */ ?>
                  <input type="hidden" name="plan_kaban[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]" value="<?php print($work_mem->oup_t_wk_plan_kaban_time[$i]); ?>">
                </td>
                <!-- 下番時刻 -->
                <td class="align-middle">
                  <!-- <?php
                  // フォームを分ける場合
                  if ($work->oup_t_wk_kaban_time[$i] == null) {
                      $kaban_time = explode(":", $work_mem->oup_t_wk_plan_kaban_time[$i]);
                  } else {
                      $kaban_time = explode(":", $work_mem->oup_t_wk_kaban_time[$i]);
                  }
                  ?>
                  <div class="input-group input-group-sm">
                    <input type="number" name="kaban_time[<?php echo $i; ?>][0]"
                      class="form-control kaban-time-hour input-form-right text-right" aria-label=""
                      value="<?php print($kaban_time[0]); ?>" min="0" max="23">
                    <div class="input-group-prepend input-group-colon">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="kaban_time[<?php echo $i; ?>][1]"
                      class="form-control kaban-time-minute input-form-left" aria-label=""
                      value="<?php print($kaban_time[1]); ?>" min="0" max="59">
                  </div> -->
                  <input type="time" class="form-control form-control-sm kaban-time"
                    name="kaban_time[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]"
                    value="<?php print($work_mem->oup_t_wk_kaban_time[$i]); ?>">
                </td>

                <!-- 昼残 -->
                <td class="align-middle">
                  <!-- <?php $daytime_over_time = explode(":", $work_mem->oup_t_wk_daytime_over_time[$i]); ?>
                  <div class="input-group input-group-sm">
                    <input type="number" name="daytime_over_time[<?php echo $i; ?>][0]"
                      class="form-control input-form-right text-right" aria-label=""
                      value="<?php print($daytime_over_time[0]); ?>" min="0" max="99">
                    <div class="input-group-prepend">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="daytime_over_time[<?php echo $i; ?>][1]"
                      class="form-control input-form-left" aria-label="" value="<?php print($daytime_over_time[1]); ?>"
                      min="0" max="99">
                  </div> -->

                  <select class="form-control form-control-sm"
                    name="daytime_over_time[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $work_mem->oup_t_wk_daytime_over_time[$i] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>

                <!-- 休憩残業時間 -->
                <td class="align-middle">
                  <!-- <?php $rest_over_time = explode(":", $work_mem->oup_t_wk_rest_over_time[$i]); ?>
                  <div class="input-group input-group-sm">
                    <input type="number" name="rest_over_time[<?php echo $i; ?>][0]"
                      class="form-control input-form-right text-right" aria-label=""
                      value="<?php print($rest_over_time[0]); ?>" min="0" max="99">
                    <div class="input-group-prepend">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="rest_over_time[<?php echo $i; ?>][1]"
                      class="form-control input-form-left" aria-label="" value="<?php print($rest_over_time[1]); ?>"
                      min="0" max="99">
                  </div> -->

                  <select class="form-control form-control-sm"
                    name="rest_over_time[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $work_mem->oup_t_wk_rest_over_time[$i] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>

                <!-- 深夜残業時間 -->
                <td class="align-middle">
                  <!-- <?php $midnight_over_time = explode(":", $work_mem->oup_t_wk_midnight_over_time[$i]); ?>
                  <div class="input-group input-group-sm">
                    <input type="number" name="midnight_over_time[<?php echo $i; ?>][0]"
                      class="form-control input-form-right text-right" aria-label=""
                      value="<?php print($midnight_over_time[0]); ?>" min="0" max="99">
                    <div class="input-group-prepend">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="midnight_over_time[<?php echo $i; ?>][1]"
                      class="form-control input-form-left" aria-label="" value="<?php print($midnight_over_time[1]); ?>"
                      min="0" max="99">
                  </div> -->

                  <select class="form-control form-control-sm"
                    name="midnight_over_time[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $work_mem->oup_t_wk_midnight_over_time[$i] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                  </select>
                </td>

                <!-- ポスト手当 -->
                <td class="align-middle">
<?php /* ?>
                  <input type="number" class="form-control form-control-sm"
                    name="post_teate[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]"
                    value="<?php print($work_mem->oup_t_wk_post_teate[$i]); ?>">
<?php */ ?>

                  <select class="form-control form-control-sm" name="post_teate[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]">
                    <option value=""></option>
                    <?php for ($j=0;$j<count($postteate->oup_m_post_teate_no);$j++) { ?>
                    <option value="<?php echo $postteate->oup_m_post_teate_post_cost[$j]; ?>"
                      <?php echo $postteate->oup_m_post_teate_post_cost[$j] == $work_mem->oup_t_wk_post_teate[$i] ? 'selected':'' ; ?>>
                      <?php echo $postteate->oup_m_post_teate_post_cost[$j]; ?>
                    </option>
                    <?php } ?>
                  </select>

                </td>

                <!-- 交通費 -->
                <td class="align-middle">
                  <input type="number" class="form-control form-control-sm"
                    name="kotuhi[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]"
                    value="<?php print($work_mem->oup_t_wk_kotuhi[$i]); ?>">
                </td>
              </tr>

              <INPUT type="hidden" name="wk_no[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]"
                value="<?php echo $work_mem->oup_t_wk_detail_no[$i]; ?>">
              <INPUT type="hidden" name="plan_time[<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>]"
                id="plan_time<?php echo $i + count($work_mem2->oup_t_wk_taiin_id); ?>"
                value="<?php print($work_mem->oup_t_wk_plan_kaban_time[$i]); ?>">

              <?php // } ?>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-6">
          <button type="submit" class="btn btn-success btn-block btn-lg" role="button">下番登録</button>
        </div>
        <div class="col-6">
          <a href="menu.php" class="btn btn-secondary btn-block btn-lg" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />

      <?php /* アクションフラグ */ ?>
      <INPUT type="hidden" name="act" value="1">

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>