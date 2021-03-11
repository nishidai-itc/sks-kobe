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

<body>
  <div class="container">
    <div class="page-header">
      <h4>上番報告（個人用）</h4>
    </div>

    <form name="frm" method="POST" action="joban3.php">
      <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-sm">
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
                  <?php print(substr($work->oup_t_wk_plan_date[0], 0, 4)."年".substr($work->oup_t_wk_plan_date[0], 5, 2)."月".substr($work->oup_t_wk_plan_date[0], 8, 2)."日"); ?>(<?php print($week[$w]); ?>)
                </td>
              </tr>

              <tr>
                <td class="table-warning text-center">氏名</td>
                <td><?php echo $staff->oup_m_staff_name[0]; ?></td>
                <td class="table-warning text-center">現場名</td>
                <td>
                  <?php echo $genba->oup_m_genba_name[0] ?>（<?php print($shift->kbn2[$work->oup_t_wk_plan_kbn[0]]); ?>）
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-12">
          <table class="table table-bordered table-sm">
            <colgroup>
              <col width="50%">
              <col width="50%">
            </colgroup>

            <tbody>
              <tr>
                <td class="table-warning text-center">勤務</td>
                <td>
                  <?php print(substr($work->oup_t_wk_plan_date[0], 0, 4)."年".substr($work->oup_t_wk_plan_date[0], 5, 2)."月".substr($work->oup_t_wk_plan_date[0], 8, 2)."日"); ?>(<?php print($week[$w]); ?>)
                  <?php print($work->oup_t_wk_plan_joban_time[0]); ?> ～
                  <?php print($work->oup_t_wk_plan_kaban_time[0]); ?></td>
              </tr>

              <tr>
                <td class="table-warning text-center">上番打刻</td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- <div class="row">
          <div class="col-12">
            <table class="table table-bordered table-sm">
              <tr>
                <td width="70" bgcolor="FFDCA5" align="center"><font size="+1">氏名</font></td>
                <td width="170"><font size="+1"><?php echo $staff->oup_m_staff_name[0]; ?></font></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center"><font size="+1">日付</font></td>
                <td><font size="+1"><?php print(substr($work->oup_t_wk_plan_date[0],0,4)."年".substr($work->oup_t_wk_plan_date[0],5,2)."月".substr($work->oup_t_wk_plan_date[0],8,2)."日"); ?>(<?php print($week[$w]); ?>) <?php print($work->oup_t_wk_plan_joban_time[0]); ?> ～ <?php print($work->oup_t_wk_plan_kaban_time[0]); ?></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center"><font size="+1">現場名</font></td>
                <td><font size="+1"><?php echo $genba->oup_m_genba_name[0] ?>（<?php print($shift->kbn2[$work->oup_t_wk_plan_kbn[0]]); ?>）</font></td>
              </tr>
            </table>
          </div>
        </div> -->

      <div class="card" style="padding: 10px;">
        <div class="card-body">
          <h5>出勤した時間を入力します</h5>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-12">
          <input type="time" step="60" id="name" name="joban_time" class="form-control"
            value="<?php print($work->oup_t_wk_plan_joban_time[0]); ?>">
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-6">
          <button type="submit" class="btn btn-success btn-lg btn-block" role="button">上番報告</button>
        </div>
        <div class="col-6">
          <a href="joban3.php" class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />

      <INPUT type="hidden" name="act" value="1">
      <INPUT type="hidden" name="joban_kbn" value="<?php print($inp_joban_kbn); ?>">

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>