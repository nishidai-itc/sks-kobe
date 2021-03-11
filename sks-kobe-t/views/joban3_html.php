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

    <form name="frm" method="POST" action="login.php">

      <!-- <div class="row">
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
                <td><?php print(substr($work->oup_t_wk_plan_date[0], 0, 4)."年".substr($work->oup_t_wk_plan_date[0], 5, 2)."月".substr($work->oup_t_wk_plan_date[0], 8, 2)."日"); ?>(<?php print($week[$w]); ?>)</td>
              </tr>
              <tr>
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
                <td><?php print(substr($work->oup_t_wk_plan_date[0], 0, 4)."年".substr($work->oup_t_wk_plan_date[0], 5, 2)."月".substr($work->oup_t_wk_plan_date[0], 8, 2)."日"); ?>(<?php print($week[$w]); ?>)</td>
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
                <td class="table-warning text-center">上番打刻</td>
                <td><?php print($work->oup_t_wk_joban_dakoku_time[0]); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- <div class="card" style="padding: 8px;">
        <div class="card-body">
          <h5><?php if ($work->oup_t_wk_joban_kbn[0]=="") {
    print('上番報告をしてください');
} else {
    print("上番報告済みです");
} ?></h5>
        </div>
      </div> -->
      <div class="col-12" style="padding: 8px;">
      </div>
      <div class="row">
        <div class="col-12">
          <a href="joban3.php?act=1&joban_kbn=1" class="btn btn-success btn-lg btn-block" role="button"
            aria-pressed="true">
            <div class="p-4">通常上番 (<?php print($work->oup_t_wk_plan_joban_time[0]); ?>)
            </div>
          </a>
        </div>
        <div class="col-12" style="padding: 8px;">
        </div>
      </div>

      <div class="row">
        <div class="col">
          <a href="joban4.php?joban_kbn=2" class="btn btn-info btn-lg btn-block" role="button"
            aria-pressed="true">早出</a>
        </div>
        <div class="col">
          <a href="joban4.php?joban_kbn=3" class="btn btn-warning btn-lg btn-block" role="button"
            aria-pressed="true">遅刻</a>
        </div>
        <div class="col">
          <a href="joban3.php?act=1&joban_kbn=4" class="btn btn-danger btn-lg btn-block" role="button"
            aria-pressed="true">休暇</a>
        </div>
      </div>
      <div class="col-12" style="padding: 8px;">
      </div>
      <div class="row justify-content-center">
        <div class="col-4">
          <a href="menu.php" class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>