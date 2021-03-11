<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen, projection" />
  <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
  <title>勤怠管理システム</title>
</head>

<style>
.font-small {
  font-size: 0.9rem;
}
</style>

<body>
  <div class="container">
    <div class="page-header">
      <h4>下番報告（個人用）</h4>
    </div>

    <!-- <form name="frm" method="POST" action="login.php"> -->
    <form name="frm" method="POST" action="kaban4.php">
      <input type="hidden" name="kaban_kojin" value="<?php echo $work->oup_t_wk_detail_no[0]; ?>">

      <!-- <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-sm">
            <colgroup>
              <col width="20%">
              <col width="30%">
              <col width="20%">
              <col width="30%">
            </colgroup>

            <tbody>
              <tr class="font-small">
                <td class="table-warning text-center">日付</td>
                <td>
                  <?php print(substr($work->oup_t_wk_plan_date[0], 0, 4)."年".substr($work->oup_t_wk_plan_date[0], 5, 2)."月".substr($work->oup_t_wk_plan_date[0], 8, 2)."日"); ?>(<?php print($week[$w]); ?>)
                </td>
              </tr>

              <tr class="font-small">
                <td class="table-warning text-center">氏名</td>
                <td><?php echo $staff->oup_m_staff_name[0]; ?></td>
                <td class="table-warning text-center">現場名</td>
                <td><?php echo $genba->oup_m_genba_name[0] ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div> -->

      <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-sm">
            <colgroup>
              <col width="40%">
              <col width="60%">
            </colgroup>

            <tbody>
              <tr>
                <td class="table-warning text-center">日付</td>
                <td>
                  <?php print(substr($work->oup_t_wk_plan_date[0], 0, 4)."年".substr($work->oup_t_wk_plan_date[0], 5, 2)."月".substr($work->oup_t_wk_plan_date[0], 8, 2)."日"); ?>(<?php print($week[$w]); ?>)
                </td>
              </tr>

              <tr>
                <td class="table-warning text-center">氏名</td>
                <td><?php echo $staff->oup_m_staff_name[0]; ?></td>
              </tr>

              <tr>
                <td class="table-warning text-center">現場名</td>
                <td><?php echo $genba->oup_m_genba_name[0] ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-sm">
            <colgroup>
              <col width="40%">
              <col width="60%">
            </colgroup>

            <tbody>
              <tr>
                <td class="table-warning text-center">勤務</td>
                <td>
                  <?php print($shift->kbn2[$work->oup_t_wk_plan_kbn[0]]); ?>
                  <?php print($work->oup_t_wk_plan_joban_time[0]); ?> ～
                  <?php print($work->oup_t_wk_plan_kaban_time[0]); ?>
                </td>
              </tr>

              <tr>
                <td class="table-warning text-center">下番打刻</td>
                <td><?php print($work->oup_t_wk_kaban_dakoku_time[0]); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-sm">
            <colgroup>
              <col width="40%">
              <col width="60%">
            </colgroup>

            <tbody>
              <tr>
                <td class="table-success text-center">下番時刻</td>
                <td>
                  <!-- <input type="time" class="form-control form-control-sm" name="kaban_time"
                    value="<?php echo $work->oup_t_wk_kaban_time[0]; ?>"> -->
                  <?php
                  if ($work->oup_t_wk_kaban_time[0] == null) {
                      $kaban_time = explode(":", $work->oup_t_wk_plan_kaban_time[0]);
                  } else {
                      $kaban_time = explode(":", $work->oup_t_wk_kaban_time[0]);
                  }
                  ?>
                  <div class="input-group input-group-sm">
                    <input type="number" name="kaban_time[0]" class="form-control joban-time-hour" aria-label=""
                      value="<?php print($kaban_time[0]); ?>" min="0">
                    <div class="input-group-prepend">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="kaban_time[1]" class="form-control joban-time-minute" aria-label=""
                      value="<?php print($kaban_time[1]); ?>" min="0">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="table-success text-center">昼残時間</td>
                <td>
                  <!-- <select name="daytime_over_time" class="form-control form-control-sm">
                    <?php foreach ($select_daytime as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"
                      <?php echo($key == $work->oup_t_wk_daytime_over_time[0] ? ' selected' : ''); ?>>
                      <?php echo $value; ?></option>
                    <?php } ?>
                  </select> -->

                  <?php $daytime_over_time = explode(":", $work->oup_t_wk_daytime_over_time[0]); ?>
                  <div class="input-group input-group-sm">
                    <input type="number" name="daytime_over_time[0]" class="form-control joban-time-hour" aria-label=""
                      value="<?php print($daytime_over_time[0]); ?>" min="0">
                    <div class="input-group-prepend">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="daytime_over_time[1]" class="form-control joban-time-minute"
                      aria-label="" value="<?php print($daytime_over_time[1]); ?>" min="0">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="table-success text-center">休憩残業時間</td>
                <td>
                  <!-- <input type="time" class="form-control form-control-sm" name="rest_over_time"
                    value="<?php echo $work->oup_t_wk_rest_over_time[0]; ?>"> -->

                  <?php $rest_over_time = explode(":", $work->oup_t_wk_rest_over_time[0]); ?>
                  <div class="input-group input-group-sm">
                    <input type="number" name="rest_over_time[0]" class="form-control joban-time-hour" aria-label=""
                      value="<?php print($rest_over_time[0]); ?>" min="0">
                    <div class="input-group-prepend">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="rest_over_time[1]" class="form-control joban-time-minute" aria-label=""
                      value="<?php print($rest_over_time[1]); ?>" min="0">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="table-success text-center">深夜残業時間</td>
                <td>
                  <!-- <input type="time" class="form-control form-control-sm" name="midnight_over_time"
                    value="<?php echo $work->oup_t_wk_midnight_over_time[0]; ?>"> -->

                  <?php $midnight_over_time = explode(":", $work->oup_t_wk_midnight_over_time[0]); ?>
                  <div class="input-group input-group-sm">
                    <input type="number" name="midnight_over_time[0]" class="form-control joban-time-hour" aria-label=""
                      value="<?php print($midnight_over_time[0]); ?>" min="0">
                    <div class="input-group-prepend">
                      <span class="input-group-text">:</span>
                    </div>
                    <input type="number" name="midnight_over_time[1]" class="form-control joban-time-minute"
                      aria-label="" value="<?php print($midnight_over_time[1]); ?>" min="0">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="table-success text-center">ポスト手当</td>
                <td>
                  <input type="text" class="form-control form-control-sm" name="post_teate"
                    value="<?php echo $work->oup_t_wk_post_teate[0]; ?>">
                </td>
              </tr>
              <tr>
                <td class="table-success text-center">交通費</td>
                <td>
                  <input type="text" class="form-control form-control-sm" name="kotuhi"
                    value="<?php echo $work->oup_t_wk_kotuhi[0]; ?>">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-6">
          <button type="submit" class="btn btn-success btn-block btn-lg" role="button">下番登録</button>
        </div>
        <!-- <div class="col-6">
          <a href="kaban6.php" class="btn btn-success btn-lg btn-block" role="button" aria-pressed="true">通常下番
            (<?php print($work->oup_t_wk_plan_kaban_time[0]); ?>)</a>
        </div> -->
        <div class="col-6">
          <a href="menu.php" class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
    </form>

    <!-- <div class="card" style="padding: 10px;">
        <div class="card-body">
          <h5>下番報告をしてください</h5>
        </div>
      </div>
      <div class="col-12" style="padding: 8px;">
      </div>
      <div class="row">
        <div class="col-12">
          <a href="kaban6.php" class="btn btn-success btn-lg btn-block" role="button" aria-pressed="true">通常下番
            (<?php print($work->oup_t_wk_plan_kaban_time[0]); ?>)</a>
        </div>
        <div class="col-12" style="padding: 8px;">
        </div>
        <div class="col-6">
          <a href="kaban5.html" class="btn btn-warning btn-lg btn-block" role="button" aria-pressed="true">早退</a>
        </div>
        <div class="col-6">
          <a href="kaban5.html" class="btn btn-info btn-lg btn-block" role="button" aria-pressed="true">指示終了</a>
        </div>
        <div class="col-12" style="padding: 8px;">
        </div>
        <div class="col-6">
          <a href="kaban5.html" class="btn btn-info btn-lg btn-block" role="button" aria-pressed="true">残業有</a>
        </div>
      </div>
      <div class="col-12" style="padding: 8px;">
      </div>
      <div class="row">
        <div class="col-12">
          <a href="menu.php" class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br /> -->

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>