<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

  <!-- bootstrap-4.3.1 -->
  <link href="./bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="./bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- floatThead -->
  <script type="text/javascript" src="lib/jquery.floatThead.js"></script>

  <title>勤怠管理システム</title>
</head>

<script type="text/javascript">
<!--
function func() {
  document.frm.submit();
}

function func2(arg1) {
  document.frm.act.value = '2';
  document.frm.work_day.value = arg1;
  document.frm.submit();
}
// 
-->

  // 勤務照会の縦スクロール
  $(function() {
    $('#kinmu-list').floatThead();
  });
</script>

<body>
  <div class="container">
    <div class="page-header">
      <h4>勤務照会</h4>
    </div>

    <form name="frm" method="POST" action="../controllers/recently_list.php">

      <div class="row">
        <div class="col-12">
          <table class="table table-sm table-bordered">
            <tr>
              <td width="130" bgcolor="FFDCA5">氏名</td>
              <td width="300">
                <select name="target_id" id="selection" class="form-control">
                  <?php for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
    if ($staff->oup_m_staff_id[$i] == $target_id) {
        $selected = 'selected';
    } else {
        $selected = '';
    } ?>
                  <option value="<?php echo $staff->oup_m_staff_id[$i]; ?>" <?php echo $selected; ?>>
                    <?php echo $staff->oup_m_staff_name[$i]; ?></option>
                  <?php
} ?>
                </select>
              </td>
            </tr>
            <tr>
              <td width="130" bgcolor="FFDCA5">年月</td>
              <td width="300">
              	<select class="form-control" name="target_ym">
                      <?php for($i=$start;$i<=$end;$i=date('Ym01', strtotime($i.'+1 month'))) { ?>
                      <option value="<?php echo substr($i,0,6) ?>" <?php echo substr($i,0,6) == $target_ym ? 'selected':"" ?>><?php echo substr($i,0,6) ?></option>
                      <?php } ?>
                 </select>
                 <!--<input type="tel" name="target_ym" class="form-control" value="<?php echo $target_ym; ?>">-->
              </td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row my-2">
        <div class="col-6">
          <button type="submit" class="btn btn-success btn-block" role="button" aria-pressed="true">検索</button>
        </div>
        <div class="col-6">
          <!--<a href="../controllers/menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>-->
          <!--3/23-->
          <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
            <a href="kanri/menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          <?php } else { ?>
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          <?php } ?>
          <!--3/23-->
        </div>
      </div>

      <!-- 一覧 -->
      <div class="row my-1">
        <div class="col-12">
          <table class="table table-sm table-bordered" id="kinmu-list">
            <thead>
              <tr class="text-center" bgcolor="FFDCA5">
                <td>日付</td>
                <td>曜</td>
                <td>現場</td>
                <td>勤務</td>
                <td>予定<br>実績</td>
                <td>出勤<br>時間</td>
                <td>退勤<br>時間</td>
              </tr>
            </thead>

            <tbody>
              <?php
            for ($i=0;$i<$lastday;$i++) {
                $outflg = 0;

                $date_w = date('w', strtotime($target_ym.sprintf("%02d", ($i + 1))));
                if ($date_w == 0 || $date_w == 6) {
                    $disp_week = '<font color="red">'.$week[$date_w].'</font>';
                } else {
                    $disp_week = $week[$date_w];
                }

                for ($j=0;$j<count($work->oup_t_wk_detail_no);$j++) {
                    if (($i + 1) == (substr($work->oup_t_wk_plan_date[$j], -2) + 0)) {
                        $outflg = 1; ?>

              <tr class="text-center">
                <td width="50" rowspan="2"><?php echo $i+1; ?>日</td>
                <td width="28" rowspan="2"><?php echo $disp_week; ?></td>
                <td width="100" rowspan="2"><?php echo $genbas[$work->oup_t_wk_genba_id[$j]]; ?></td>
                <td width="70" rowspan="2"><?php echo $shift->kbn2[$work->oup_t_wk_plan_kbn[$j]]; ?></td>
                <td width="30">
                  <div class="text-info">予</div>
                </td>
                <td width="60">
                  <div class="text-info"><?php echo substr($work->oup_t_wk_plan_joban_time[$j], 0, 5); ?></div>
                </td>
                <td width="60">
                  <div class="text-info"><?php echo substr($work->oup_t_wk_plan_kaban_time[$j], 0, 5); ?></div>
                </td>
              </tr>

              <tr class="text-center">
                <td width="30">実</td>
                <?php if ($work->oup_t_wk_joban_kbn[$j] === '4') { ?>
                <td width="120" colspan="2">有給</td>
                <?php } elseif ($work->oup_t_wk_joban_kbn[$j] === '5') { ?>
                <td width="120" colspan="2">欠勤</td>
                <?php } else { ?>
                <td width="60">
                  <div><?php echo substr($work->oup_t_wk_joban_time[$j], 0, 5); ?></div>
                </td>
                <td width="60">
                  <div><?php echo substr($work->oup_t_wk_kaban_time[$j], 0, 5); ?></div>
                </td>
                <?php } ?>
              </tr>

              <?php
                    }
                } ?>
              <?php if ($outflg == 0) { ?>
              <tr class="text-center">
                <td width="50"><?php echo $i+1; ?>日</td>
                <td width="28"><?php echo $disp_week; ?></td>
                <td width="100"></td>
                <td width="70"></td>
                <td width="30"></td>
                <td width="60"></td>
                <td width="60"></td>
              </tr>
              <?php } ?>
              <?php
            } ?>
            </tbody>
          </table>
        </div>
      </div>

      <?php /* アクションフラグ */ ?>
      <INPUT type="hidden" name="act" value="1">
      <INPUT type="hidden" name="work_day" value="">

    </form>

    <div class="row my-1">
      <div class="col-12">
          <!--<button class="btn btn-secondary btn-block" onclick="location.href='../controllers/menu.php'">戻る</button>-->
          <!--3/23-->
          <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
          <button class="btn btn-secondary btn-block" onclick="location.href='kanri/menu.php'">戻る</button>
          <?php } else { ?>
          <button class="btn btn-secondary btn-block" onclick="location.href='menu.php'">戻る</button>
          <!--3/23-->
          <?php } ?>
      </div>
    </div>

  </div>
</body>

</html>