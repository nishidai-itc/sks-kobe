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

  <!-- bootstrap4-toggle -->
  <link href="./lib/bootstrap4-toggle-3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="./lib/bootstrap4-toggle-3.6.1/js/bootstrap4-toggle.min.js"></script>

  <!-- floatThead -->
  <script type="text/javascript" src="lib/jquery.floatThead.js"></script>

  <title>勤怠管理システム</title>
</head>

<body>

  <style>
  input[type=button].button,
  input[type=submit].button,
  button.button {
    -webkit-appearance: none;
    -moz-appearance: none;
    border: none;
    font: inherit;
  }

  button[type=submit].button {
    background-color: #0b73da;
  }

  .button {
    display: inline-block;
    padding: .5em 1em;
    border-radius: 4px;
    text-align: center;
    color: #eff;
    background-color: #678;
    cursor: pointer;
  }

  .button:hover {
    background-color: #567;
  }

  .button:disabled {
    cursor: not-allowed;
    opacity: .6;
    color: #def;
  }

  .toggle-buttons {
    display: flex;
  }

  .toggle-buttons.vertical {
    flex-direction: column;
  }

  .toggle-buttons label {
    display: flex;
    position: relative;
  }

  .toggle-buttons [type=radio],
  .toggle-buttons [type=checkbox] {
    -webkit-appearance: none;
    -moz-appearance: none;
    position: absolute;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
  }

  /* appearance: none for IE11 */
  _:-ms-lang(x)::-ms-backdrop,
  .toggle-buttons [type=radio],
  _:-ms-lang(x)::-ms-backdrop,
  .toggle-buttons [type=checkbox] {
    visibility: hidden;
  }

  .toggle-buttons .button {
    z-index: 1;
  }

  .toggle-buttons.vertical .button {
    width: 100%;
  }

  .toggle-buttons:not(.vertical) :not(:first-child) .button {
    border-left: 1px solid #567;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }

  .toggle-buttons:not(.vertical) :not(:last-child) .button {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .toggle-buttons.vertical :not(:first-child) .button {
    border-top: 1px solid #567;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }

  .toggle-buttons.vertical :not(:last-child) .button {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .toggle-buttons :checked+.button {
    background-color: #345;
  }

  .toggle-buttons :disabled+.button {
    cursor: not-allowed;
    opacity: .6;
    color: #def;
  }
  </style>

  <!-- 追加 -->
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
    $('#joban').floatThead();

    // 個別選択
    $('input[id="tujo_checked"]').change(function() {
      if ($(this).prop('checked')) {
        // 時間を切り抜き
        var planJobanTime = $(this).val();
        // var planJobanTimeHour = planJobanTime.substr(0, 2);
        // var planJobanTimeMinute = planJobanTime.substr(3, 2);

        // inputフォームに代入
        // $(this).parent().parent().children('td').find('.joban-time-hour').val(planJobanTimeHour);
        // $(this).parent().parent().children('td').find('.joban-time-minute').val(planJobanTimeMinute);
        $(this).parent().parent().children('td').find('.joban-time').val(planJobanTime);

        // $(this).parent().parent().children('td').find('.joban-time-hour').prop('disabled', true);
        // $(this).parent().parent().children('td').find('.joban-time-minute').prop('disabled', true);
        // $(this).parent().parent().children('td').find('.input-group-colon').addClass('input-group-colon-bg');
        $(this).parent().parent().children('td').find('.joban-time').prop('readonly', true);
      } else {
        // $(this).parent().parent().children('td').find('.joban-time-hour').prop('disabled', false);
        // $(this).parent().parent().children('td').find('.joban-time-minute').prop('disabled', false);
        // $(this).parent().parent().children('td').find('.input-group-colon').removeClass('input-group-colon-bg');
        $(this).parent().parent().children('td').find('.joban-time').prop('readonly', false);
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
          // $(this).parent().parent().children('td').find('.joban-time-hour').val(planJobanTimeHour);
          // $(this).parent().parent().children('td').find('.joban-time-minute').val(planJobanTimeMinute);
          $(this).parent().parent().children('td').find('.joban-time').val(planJobanTime);

          // $(this).parent().parent().children('td').find('.joban-time-hour').prop('disabled', true);
          // $(this).parent().parent().children('td').find('.joban-time-minute').prop('disabled', true);
          // $(this).parent().parent().children('td').find('.input-group-colon').addClass('input-group-colon-bg');
          $(this).parent().parent().children('td').find('.joban-time').prop('readonly', true);
        } else {
          // $(this).parent().parent().children('td').find('.joban-time-hour').prop('disabled', false);
          // $(this).parent().parent().children('td').find('.joban-time-minute').prop('disabled', false);
          // $(this).parent().parent().children('td').find('.input-group-colon').removeClass('input-group-colon-bg');
          $(this).parent().parent().children('td').find('.joban-time').prop('readonly', false);
        }
      });
    });
    
    $("#user_kana").change( function(){
        self.location = "joban1.php?user_kana="+$('#user_kana').val() + "&genba_id="+$('#genba_id').val();
    });
  });
  </script>

  <div class="container">
    <!-- <div class="page-header">
      <h4>上番報告（リーダー用）</h4>
    </div> -->

    <!-- 上番報告 日付 報告者 現場名 -->
    <form method="POST" action="joban1.php">
    <div class="row">
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
            <td class="table-info text-center font-weight-bold" colspan="4">上番報告（リーダー用）</td>
          </tr>
          <tr>
            <td class="table-warning text-center">報告者</td>
            <td><?php echo $staff->oup_m_staff_name[0]; ?></td>
            <td class="table-warning text-center">現場名</td>
            <?php if ($staff->oup_m_staff_auth[0] == 2) { ?>
                <td><?php echo $genba->oup_m_genba_name[0] ?></td>
                <td nowrap bgcolor="#d5d5d5">
                    <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
                </td>
            <?php } else { ?>
                <td bgcolor="#d5d5d5">
                  <select id="genba_id" name="genba_id" class="form-control">
                    <option value=""></option>
                    <?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                    <option value="<?php print($genba->oup_m_genba_id[$i]); ?>" <?php
                    if ($genba_id===$genba->oup_m_genba_id[$i]) {
                        print("selected");
                    } ?>><?php print($genba->oup_m_genba_name[$i]); ?></option>
                    <?php } ?>
                  </select>
                </td>
                <td nowrap bgcolor="#d5d5d5">
                    <button type="submit" class="btn btn-info" role="button" name="search">検索</button>
                </td>
                <td nowrap bgcolor="#d5d5d5">
                    <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
                </td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    </div>
    </form>

    <!-- 追加 -->
    <form method="POST" action="joban1.php">
      <div class="row my-1">
        <div class="col-1">
          <select id="user_kana" class="form-control" name="user_kana">
            <?php for ($i=0;$i<count($user_kana_array);$i++) { ?>
            <option value="<?php print($user_kana_array[$i]); ?>" <?php if ($user_kana == $user_kana_array[$i]) { print("selected"); }?> ><?php print($user_kana_array[$i]); ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-5">
          <select class="form-control" name="add_staff" required>
            <option></option>
            <?php
            for ($i=0;$i<count($search_staff->oup_m_staff_id);$i++) {
                if (is_array($work_mem->oup_t_wk_taiin_id)) {
                    if (in_array($search_staff->oup_m_staff_id[$i], $work_mem->oup_t_wk_taiin_id)) {
                        continue;
                    }
                } ?>
            <option value="<?php print($search_staff->oup_m_staff_id[$i]); ?>">
              <?php print($search_staff->oup_m_staff_name[$i]); ?></option>
            <?php
            } ?>
          </select>
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-success btn-block" role="button">追加</button>
        </div>
      </div>
      <INPUT type="hidden" name="genba_id2" value="<?php print($genba_id); ?>">
    </form>

    <form name="frm" method="POST" action="joban1.php" enctype="multipart/form-data">

      <!-- 表示テーブル -->
      <div class="row">
        <table class="table table-sm table-bordered">
          <!-- <colgroup>
            <col width="20%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="15%">
            <col width="20%">
            <col width="15%">
          </colgroup> -->

          <thead>
            <tr class="text-center">
              <td class="table-warning">現場</td>
              <td class="table-warning">氏名</td>
              <td class="table-warning">勤務<br>(補足文字)</td>
              <td class="table-warning">所定時間</td>
              <td class="table-warning">打刻</td>
              <td class="table-success">
                <label>通常<br><input type="checkbox" name="all" onClick="AllChecked();"></label>
              </td>
              <td class="table-success">上番時刻</td>
              <td class="table-success">休暇</td>
            </tr>
          </thead>

          <tbody>
            <?php for ($i=0;$i<count($work_mem->oup_t_wk_taiin_id);$i++) { 
//              if ($shift->kbn2[$work_mem->oup_t_wk_plan_kbn[$i]] != "年休") {?>

            <tr class="text-center">
              <!-- 現場 -->
              <td>
                <?php print($genba_name[$work_mem->oup_t_wk_genba_id[$i]]); ?>
                
              </td>
              <!-- 氏名 -->
              <td>
                <?php print($staffs[$work_mem->oup_t_wk_taiin_id[$i]]); ?>
                <input type="hidden" name="joban_dakoku[<?php echo $i; ?>]" value="<?php print($work_mem->oup_t_wk_joban_dakoku_time[$i]); ?>">
              </td>
              <!-- 勤務 -->
              <td><?php print($shift->kbn2[$work_mem->oup_t_wk_plan_kbn[$i]]); ?><?php echo $work_mem->oup_t_wk_plan_hosoku[$i] != "" ? "<br>(".$work_mem->oup_t_wk_plan_hosoku[$i].")" : "&nbsp;" ; ?></td>
              <!-- 所定時間 -->
              <td>
                <?php print($work_mem->oup_t_wk_plan_joban_time[$i]); ?><br /><?php print($work_mem->oup_t_wk_plan_kaban_time[$i]); ?>
                <input type="hidden" name="plan_joban[<?php echo $i; ?>]" value="<?php print($work_mem->oup_t_wk_plan_joban_time[$i]); ?>">
              </td>
              <!-- 打刻 -->
              <td><?php print($work_mem->oup_t_wk_joban_dakoku_time[$i]); ?></td>
              <!-- 通常 -->
              <td class="align-middle">
                <input type="checkbox" name="tujo_checked[<?php echo $i; ?>]" id="tujo_checked" 
                  value="<?php print($work_mem->oup_t_wk_plan_joban_time[$i]); ?>">

                <!-- <input type="checkbox" class="form-control" name="joban_kbn[<?php echo $i; ?>]"
                  id="joban_kbn_<?php echo $i; ?>" value="1"> -->
              </td>
              <?php /*                <td><input type="time" class="form-control" name="joban_time[<?php echo $i; ?>]"
              value="<?php if ($work_mem->oup_t_wk_joban_time[$i]=="") { print($work_mem->oup_t_wk_plan_joban_time[$i]); } else { print($work_mem->oup_t_wk_joban_time[$i]); } ?>">
              </td> */ ?>
              <!-- 上番時刻 -->
              <td class="align-middle">
                <input type="time" class="form-control form-control-sm joban-time" name="joban_time[<?php echo $i; ?>]"
                  value="<?php print($work_mem->oup_t_wk_joban_time[$i]); ?>">

                <!-- <?php
                // フォームを分けたバージョン
                if ($work_mem->oup_t_wk_joban_time[$i] == null) {
                    $joban_time = explode(":", $work_mem->oup_t_wk_plan_joban_time[$i]);
                } else {
                    $joban_time = explode(":", $work_mem->oup_t_wk_joban_time[$i]);
                }
                ?>
                <div class="input-group input-group-sm">
                  <input type="number" name="joban_time[<?php echo $i; ?>][0]" class="form-control joban-time-hour input-form-right text-right"
                    aria-label="" value="<?php print($joban_time[0]); ?>" min="0" max="23">
                  <div class="input-group-prepend input-group-colon">
                    <span class="input-group-text">:</span>
                  </div>
                  <input type="number" name="joban_time[<?php echo $i; ?>][1]" class="form-control joban-time-minute input-form-left"
                    aria-label="" value="<?php print($joban_time[1]); ?>" min="0" max="59">
                </div> -->
              </td>
              <!-- 休暇 -->
              <td class="align-middle">
                <!-- <div class="toggle-buttons"><label><input type="radio" name="kyuka[<?php echo $i; ?>]" value="1"><span
                      class="button">休</span></label></div> -->

                <!-- <input type="checkbox" name="kyuka[<?php echo $i; ?>]" value="1"> -->
                <!-- <input type="checkbox" class="form-control" name="joban_kbn[<?php echo $i; ?>]"
                  id="joban_kbn_<?php echo $i; ?>" value="1"> -->

                <select class="form-control form-control-sm" name="kyuka[<?php echo $i; ?>]">
                  <option value=""></option>
                  <option value="4" <?php echo $work_mem->oup_t_wk_joban_kbn[$i] == "4" ? 'selected':'' ; ?>>年休</option>
                  <option value="5" <?php echo $work_mem->oup_t_wk_joban_kbn[$i] == "5" ? 'selected':'' ; ?>>欠勤</option>
                </select>

                <!-- <input type="checkbox" name="kyuka[<?php echo $i; ?>]" autocomplete="off" value="1" data-toggle="toggle"
                  data-onstyle="danger" data-size="sm" data-on="休暇" data-off=" "
                  <?php echo $work_mem->oup_t_wk_joban_kbn[$i] == 4  ? ' checked="checked"': ''; ?>> -->
              </td>
            </tr>
            <INPUT type="hidden" name="wk_no[<?php echo $i; ?>]"
              value="<?php echo $work_mem->oup_t_wk_detail_no[$i]; ?>">
            <INPUT type="hidden" name="plan_time[<?php echo $i; ?>]" id="plan_time<?php echo $i; ?>"
              value="<?php print($work_mem->oup_t_wk_plan_joban_time[$i]); ?>">

            <?php // } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="row">
        <div class="col-6">
          <button type="submit" class="btn btn-success btn-block" role="button">上番報告</button>
        </div>
        <div class="col-6">
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />

      <?php /* アクションフラグ */ ?>
      <INPUT type="hidden" name="act" value="1">

    </form>

  </div>
</body>

</html>